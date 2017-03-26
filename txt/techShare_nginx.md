```
nginx核心配置讲解
nginx与Apache深入对比
nginx如何配置负载均衡
nginx的master/worker工作机制
推荐《深入理解Nginx：模块开发与架构解析》
```

#intro
- ten step learning technique

#what&why

#install

#configure
- syntax
- common block/options
    + `location`
        * match sequence(see doc)
        * prefix location/regex location(see doc)
    + `fasstcgi`
        * fastcgi_split_path_info
        * fastcgi_param
        * fastcgi_pass
        * fastcgi_index
- static server
- reverse proxy
    + fpm+laravel
    + real ip
    + rewrite rule
- load balancer
    + 内置策略
        * 轮询
        * 加权轮询
        * ip hash
    + 外置策略
- web 缓存

#optimization
- system
- configuration

#module

#misc

##nginx & PHP

```
location ~ [^/]\.php(/|$) {
    fastcgi_split_path_info ^(.+?\.php)(/.*)$;
    if (!-f $document_root$fastcgi_script_name) {
        return 404;
    }

    # Mitigate https://httpoxy.org/ vulnerabilities
    fastcgi_param HTTP_PROXY "";

    fastcgi_pass 127.0.0.1:9000;
    fastcgi_index index.php;
    include fastcgi_params;
}
```

##nginx v.s apache

- connection handling architecture
    + apache:
        * mpm_prefork
        * mpm_worker
        * mpm_event
    + nginx:
        * asynchronous, non-blocking, event-driven
        * scale more efficient under limited resource and heavy load

- static content
    + apache:
        * file-based

- dynamic content
    + apache:
        * dynamically loadable modules
        * internal/embeded/simpler
    + nginx;
        * rely on external processor(http, FastCGI, SCGI, uWCGI, memcache)
        * little complicated, but less overhead

- configuration
    + apache:
        * distributed/.htaccess
        * dynamic/flexible
        * handy for shared hosting providers
    + nginx:
        * centeralized
        * faster
        * prevent security misstep

- request to resource mapping
    + apache:
        * see request mainly as filesystem: `Directory`/`Files`
        * also `Alias`/`Location`/regex
    + nginx:
        * see request mainly as URI: `server`/`location`
        * map to filesystem when necessary
        * easily function in both web, mail and proxy server roles

- modules
    + apache:
        * dynamic load/unload
    + nginx:
        * selected and compiled

- supportive
    + apache:
        * more support
    + nginx:
        * growing support

- co-work: nginx before apache, serving static content, proxy pass dynamic to apache