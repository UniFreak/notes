为什么选择 Nginx:
- 更快
- 高扩展
    模块化, http 过滤器模块
    模块嵌入到二进制文件中执行, 也很快
    高流量网站倾向于开发定制模块
- 高可靠
- 低内存消耗
- 单机支持 10 万以上并发连接
- 热部署: 不间断服务升级 nginx 可执行文件
- BSD 许可

编译安装 nginx
1. 依赖: gcc, pcre, zlib, openssl
2. 准备目录: 源码, 中间文件, 部署, 日志
3. linux 内核参数优化: sysctl.conf
4. 获取源码: nginx.org/en/download.html
5. 编译安装

    ./configre
    make
    make install

nginx 命令使用
- 启动
    - 指定配置文件 -c <conf>
    - 指定安装目录 -p <dir>
    - 指定全局配置项 -g "<config>"
- 测试 -t
- 显示版本 -v
- 显示编译参数 -V
- 发信号
    - 重读配置
        - -s reload
        - kill -s SIGHUP <master pid>
    - 停止
        - -s stop
        - kill -s SIGTERM <pid>
        - kill -s SIGINT <pid>
    - 优雅停止
        - -s quit
        - kill -s SIGQUIT <pid>
        - kill -s SIGWINCH <pid>
- 平滑升级
    1. 通知运行中的旧版本准备升级 kill -s SIGUSR2 <master pid>
    2. 启动新版本 nginx
    3. 优雅关闭旧版本

## 配置语法

```
user nobody;

# 配置项
worker_process 8;
error_log /var/log/nginx/error.log error;

# 注释
# pid   logs/nginx.pid

# 块配置项
events {
    use epoll;
    worker_connections 50000;
}

http {
    include mime.types;
    defualt_type application/octec-stream;

    # $模块变量
    # 如果值中包含语法符号, 比如空格, 则需用单引号或双引号括住
    log_format main '$remote_addr [$time_local] "$request" '
    # 通用单位: k, m, ms, s, m, h, d, w, M, y
    access_log logs/access.log main buffer=32k;
}
```

配置冲突的解决, 可用值, 可用单位, 可用变量, 都取决于模块如何解析. 大部分模块必须在读取
了某个配置项后才会在运行时启动, 比如 http{} 配置了 ngx_http_module 才会启用.

# 配置项

基本配置: 其他模块依赖的配置项

用于调试:
daemon on|off; 守护进程形式? off 主要用于 gdb 调试
msater_process on|off; master/worker 方式? off 用于调试
error_log /path/file level; level: debug|info|notice|warn|error|crit|alert|emerg
debug_point [stop|abort]; 错误时是否 coredump
event {
    # 仅在请求来自 IP 时输出 debug 消息. 用于定位高并发请求下才会发生的问题
    debug_connectioin [IP|CIDR];
}
worker_rlimit_core size; coredump 大小
working_directory path; coredump 生成目录

正常运行
env VAR|VAR=VALUE; 设置操作系统环境变量
include /path/file; 包含其他配置文件
pid path/file; pid 文件路径
user username [groupname]; worker 进程用户或用户组
worker_rlimit_nofile limit; worker 可以打开的最大句柄描述符个数
worker_rlimit_sigpending limit; 限制信号队列

性能
worker_process number; worker 个数
worker_cpu_affinity cpumask [cpumask...] 绑定 worker 到制定 cpu 内核
ssl_engine device; ssl 硬件加速
worker_priortiy nice; worker nice 优先级

## 反向代理配置

反向代理: Nginx VS Squid
squid 一边接受请求, 一边转发上游
nginx 把请求先完整接收到所在服务器的硬盘或内存中, 再转发上游
    pro: 减低上游负载
    con: 延长请求处理时间

均匀分布请求

```
upstream backend {
    # ip_hash; # 使用 ip_hash 可让同一用户落到固定一台上游中, 不可以 weight 并用
    server backedn1.example.com     weight=5;
    server backedn2.example.com     max_fails=3 fail_timeout=30s;
    server unix/tmp/backend3        down; # down 标识暂时不可用
}

server {
    location / {
        proxy_pass http://backend;
    }
}