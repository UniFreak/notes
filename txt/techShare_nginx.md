```
安装配置nginx+php
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