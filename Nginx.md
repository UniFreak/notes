# SEE
- <http://aosabook.org/en/nginx.html>

# Architecture

![Architecture](img/nginx_architecture.png)

## Code: core and module
Core: foundation, reverse proxy, network protocols, run-time environment
Module
- Upper: `http`, `mail`
- Functional:
    + event
    + phase handler
    + output filter (header, body)
    + variable handler (like `geo`, `map`)
    + protocals
    + upstream
    + load balancer

## Request Process

nginx processes connections through a pipeline, or chain, of modules.
A typical HTTP request processing cycle looks like the following.

1. Client sends HTTP request.
2. nginx core chooses the appropriate phase handler based on the configured location matching the request. There are six phase: server rewrite, location, location rewrite, access control, try_files, log
3. If configured to do so, a load balancer picks an upstream server for proxying.
4. Phase handler does its job and passes each output buffer to the first filter
5. First filter passes the output to the second filter.
6. Second filter passes the output to third (and so on).
7. Final response is sent to the client.

With subrequests nginx can return the results from a different URL than the one the client originally requested

## Workers Model

`master process` read the conf file and determine how many `worker process` is spawn
Connections are processed in a highly efficient run-loop in a limited number of single-threaded processes called workers
each worker nginx can handle many thousands of concurrent connections and requests per second
worker code includes the core and the functional modules
resource controlling mechanisms are isolated within single-threaded worker processes

## Process Roles

a single master process and several worker processes. There are also a couple of special purpose processes, specifically a cache loader and cache manager
primarily use shared-memory mechanisms for inter-process communication

# Compile From Source Installation

via repository:

```shell
yum install epel-release
yun install nginx
```

compile:

1. install dependency
    - yum: gcc, gcc-c++, pcre, pcre-devel, zlib, zlib-devel, openssl, openssl-devel
    - apt: gcc, g++, libpcre3, libpcre3-dev, zlib1g, zlib1g-dev, libssl, libssl-dev
2. download source from nginx.org(http://nginx.org/download/nginx-1.10.3.tar.gz)
3. `tar -zxvf <file>`
4. `cd <untared folder>`
5. `./configure`
6. `make`
7. `make intall`
8. 常用编译参数解释...

# Dir and Files

- nginx path prefix: `/usr/local/nginx`
- nginx binary file: `/usr/local/nginx/sbin/nginx`
- nginx modules path: `/usr/local/nginx/modules`
- nginx configuration prefix: `/usr/local/nginx/conf`
- nginx configuration file: `/usr/local/nginx/conf/nginx.conf`
- nginx pid file: `/usr/local/nginx/logs/nginx.pid`
- nginx error log file: `/usr/local/nginx/logs/error.log`
- nginx http access log file: `/usr/local/nginx/logs/access.log`
- path: `/etc/nginx`
- log: `/var/log/nginx` or `/usr/local/nginx/logs`
- conf: `/user/local/nginx/conf` or `/etc/nginx` or `/usr/local/etc/nginx`

# Command Options

```
-?,-h         : this help
-v            : show version and exit
-V            : show version and configure options then exit
-t            : test configuration and exit
-T            : test configuration, dump it and exit
-q            : suppress non-error messages during configuration testing
-s signal     : send signal to a master process: stop, quit, reopen, reload
-p prefix     : set prefix path (default: NONE)
-c filename   : set configuration file (default: conf/nginx.conf)
-g directives : set global directives out of configuration file
```

# Config

configuration change will be applied after reload/restart

## Units

ms  milliseconds
s   seconds
m   minutes
h   hours
d   days
w   weeks
M   months, 30 days
y   years, 365 days

## Concepts

syntax, formatting and definitions follow a so-called C-style convention

Variable typically calculated only once and cached for the lifetime of a particular request

- variable, embeded variable
- context never overlap: `main`, `http`, `server`, `upstream`, `location`, `mail`
- simple directive: `<name> <modifier> <param> <param>...;`
- block directive: `<context> <param>... {}`, block directives can be nested
- directives in the top level is in `main` context
- common block directives are: `http -> server -> locatioin`

## Common Directives

under `server` or `location`, `location [ = | ~ | ~* | ^~ ] uri {...}`

location directive search order:
1. Exact matches (`=`), if matches search stops
2. Prefix matches (longest match win)
3. If matched prefix string have `^~` modifier, then searching stops, else
4. Regex matches (`~*` case-insensitive, `~` case-sensitive, longest match win)

under `server`, `server_name naem ...`

server name search order:
1. exact name
2. longest wildcard name starting with an asterisk, e.g. `*.example.org`
3. longest wildcard name ending with an asterisk, e.g. `mail.*`
4. first matching regular expression (in order of appearance in a configuration file)

## Common Tasks

nginx.conf:

```ini
# comment start with #
user  nobody;               # which user the worker process run as
worker_processes  1;        # how many worker process to spawn
error_log  logs/error.log;  # error log file path
pid        logs/nginx.pid;  # what pid file the master process use

events {
    # event context config affect connection processing
    # how many connections a worker process handles
    worker_connections  1024;
}

# server use this mime type to extension map, to determine the `Content-Type`
# response header, if no mimetype map found, defualt to `octet-stream` type,
# basically means download it
include       mime.types;

default_type  application/octet-stream;

log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                  '$status $body_bytes_sent "$http_referer" '
                  '"$http_user_agent" "$http_x_forwarded_for"';

# log access in logs/access.log with `main` log format defined above
access_log  logs/access.log  main;

sendfile        on;
# tcp_nopush     on;

keepalive_timeout  65;

# gzip  on;

include /etc/nginx/conf.d/*.conf;
```

serving static content:

```ini
server {
    # `/` is the prefix compared with the URI from the request
    location / {
        root /data/www;
    }

    # the longer prefix has the higher URI matching priority
    location /images/ {
        root /data;
    }
}
```

setting up proxy server:

```ini
# the proxied server
server {
    listen 8080;       # listen on the port 8080, default is 80
    root /data/up1;    # map all request to the `/data/up1` directory

    location / {
    }
}

# the proxy server: use `proxy_pass protocal://name:port`
server {
    location / {
        proxy_pass http://localhost:8080;
        # similer *_pass are: fascgi_pass / uwsgi_pass / scgi_pass / memcached_pass / grpc_pass
    }

    # regex should be preceded with `~`. regex has the second highest priority
    location ~ \.(gif|jpg|png)$ {
        root /data/images;
    }
}
```

setting up FastCGI proxying

```ini
# use `fastcgi_pass` instead of `proxy_pass` to set up fastcgi server
server {
    location / {
        fastcgi_pass    localhost:9000;
        # parameters passed to FastCGI server
        fastcgi_param   SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param   QUERY_STRING    $query_string;
    }

    location ~\.(gif|jpg|png)$ {
        root /data/images;
    }
}
```

## Load balancing

use `upstream` for HTTP, `stream` for TCP or UDP

supported load balancing mechanisms
- round-robin (default)
- `least_conn` least connections
- `least_time` least-time
- `hash` generic hash
- `random`
- `ip_hash`

# Module dev
1. code
2. compile
    - define a `config` file
    - edit `ngx.modules.c`

# Optimization

- Linux 内核参数优化(p9)
    1. 修改 `/etc/sysctl.conf`
    2. 执行 `sysctl -p` 生效
    3. 常用参数解释...

# Best Practice

Use `include` to orgnize config files

# Q&A

- `proxy_pass` VS `fastcgi_pass`

- how to know if nginx is currently running?

use `service nginx status` or `ps auxww | grep nginx`

- what does `server name bucket size` do?

see https://gist.github.com/muhammadghazali/6c2b8c80d5528e3118613746e0041263