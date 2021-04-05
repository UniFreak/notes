# Serving Static Content

```
server {                                # define new context to listen for
    listen 80 default_server;           # listen on port 80, as default
    server_name www.example.com         # hostname

    location / {                        # config based on path /: match all request
        # where to look for static file
        root /usr/share/nginx/html;     # root: will append URI prefix if provided
        # alias /usr/share/nginx/html;  # alias: will not append
        index index.html index.htm;     # default file
    }
}
```

# HTTP Load Banlancing

```
upstream backend {
    # load balancing methods can be
    # - default is round robin
    # - least_conn: least connection
    # - least_time:
    # - hash: generic hash. define a ash with some text, variables of the request
              or runtime, or both. distribute load by produce a hash for current
              request and place it against upstream servers. useful when you know
              which upstream most likely have data cache
    # - random:
    # - ip_hash: use client IP as hash. useful to bind client with its session
    least_conn;

    server 10.10.12.45:80     weight=1; # can be IP
    server app.example.com:80 weight=2; # or Unix socket
                                        # or FQDN
}
server {
    location / {
        proxy_pass http://backend;
    }
}
```

# TCP Loading Banlancing

```
# should use a stream.conf.d folder and include it inside nginx.conf stream block

# stream module let you define upstream pools of servers and config a listening server
stream {
    upstream mysql_read {
        server read1.example.com:3306 weight=5;
        server read2.example.com:3306;
        server 10.10.12.34:3306     backup; # active | down
    }
    server {
        listen 3306;
        proxy_pass mysql_read;
    }
}
```

# UDP Load Balancing

```
stream {
    upstream ntp {
        server ntp1.example.com:123 weight=2;
        server ntp2.example.com:123;
    }
    server {
        listen 123 udp; # note udp parameter
        proxy_pass ntp;
    }
}
```

```
stream {
    server {
        # if the service you're load balancing over requires multiple packets to be
        # sent back and forth between client and server, you can specify `reuseport`
        # useful for OpenVPN, VoIP, DTLS...
        listen 1195 udp reuseport;
        proxy_pass 127.0.0.1:1194;
    }
}
```

# Passive Health Checks

upstream backend {
    server backedn1.example.com:1234 max_fail=3 fail_timeout=3s;
}

# Slow Start

upstream {
    zone backend 64k;
    # ramp up connection number over 20 seconds
    server server1.example.com slow_start=20s;
}

# A/B Testing
