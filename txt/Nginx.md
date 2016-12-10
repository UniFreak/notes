#Installation

via repository:

    yum install epel-release
    yun install nginx

#defaut dirs/files

- path: `/etc/nginx`
- log: `/var/log/nginx` or `/usr/local/nginx/logs`
- conf: `/user/local/nginx/conf` or `/etc/nginx` or `/usr/local/etc/nginx`

    configuration change will be applied after reload/restart
    
#Nginx architecture

`master process` read the conf file and determine how many `worker process` is spawn

request are processed by worker process

#Command

##options
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
    
#general usage

    + main: nginx.conf

    ```
    # comment start with #
    # simple directive is like: `<name> <param> <param>;`
    # block directive is like: `<context> {<simpleDirectives>}` block directives can be nested
    # common block directives are:
    # - http -> server -> locatioin
    # - events
    
    user  nobody;               # which user the worker process run as 
    worker_processes  1;        # how many worder process to spawn
    error_log  logs/error.log;  # error log file path
    pid        logs/nginx.pid;  # what pid file the master process use

    events {
        # how many connections a workder process handles
        worker_connections  1024;
    }

    include       mime.types;  # server use this mime type to extension map,
                               # to determine the `Content-Type` response
                               # header
    # if no mimetype map found, defualt to `octet-stream` type, basically 
    # means download it
    default_type  application/octet-stream;

    log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for"';

    # log access in logs/access.log with `main` log format defined above
    access_log  logs/access.log  main;

    sendfile        on;
    #tcp_nopush     on;

    #keepalive_timeout  0;
    keepalive_timeout  65;

    #gzip  on;

    include /etc/nginx/conf.d/*.conf;

    ```
    
    + serving static content
    
    ```
    server {
        location / {           # `/` is the prefix compared with the URI from the request
            root /data/www;
        }
        
        location /images/ {    # the longer prefix has the higher URI matching priority
            root /data;
        }
    }
    ```
    
    + setting up proxy server
    
    ```
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
        }
        
        location ~\.(gif|jpg|png)$ {  # regex should be preceded with `~`. regex has the second highest priority
            root /data/images;
        }
    }
    ```
    
    + setting up FastCGI proxying
    
    ```
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

#load balancing

three load balancing mechanisms are supported:

- round-robin (default)
- least-connected
- ip-hash





