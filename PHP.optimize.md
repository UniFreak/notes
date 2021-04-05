# Configuration Tuning

## PHP-FPM

nginx 把请求转发给 php-fpm 进程处理. fpm 再把请求交给某个 PHP 子进程处理.

php-fpm 用于管理 PHP 进程池. 会创建一个主进程, 控制何时以及如何把 HTTP 请求转发给一个或多个子进程.
每个进程可以处理 10, 50, 100, 500 或更多的 HTTP 请求.


配置文件: /etc/php5/fpm/php-fpm.conf

全局配置

    在 1 分钟之内
    emergecy_restart_interval = 1m
    如果有 10 个进程失效, 则优雅重启
    emergency_restart_threshold = 10

进程池配置 [Pool Definitions]

    一般通过 include=/etc/php-fpm.d/*.conf 引入进程池定义文件. 默认是 www.conf
    每个进程池的配置文件开头都是 [进程池名称], 如默认进程池配置文件中的 [www]

    最好以单独非跟用户运行各个进程池. 这样可以使用 top 或 ps aux 识别每个 php 应用的进程池
    user=deploy

    group=deploy

    listen=127.0.0.1:9000

    listen.allowed_clients=127.0.0.1

    给定任何时间点, 池中最多能有多少个进程.
    你应该测试你的应用, 确定每个进程需要多少内存, 然后把这个值设为设备可用内存能容纳的进程总数.
    大多数进程需要 5~15MB. 假设有 512MB 内存, 可设置为 512MB/10MB=51 个进程
    pm.max_children=51

    启动时进程池中立即可用的进程数. 建议设置为 2 或 3, 以等待一开始的请求进入
    pm.start_servers=3

    空闲时进程池中可以存在的数量最小值. 一般和 start_servers 一样
    pm.min_spare_servers=2

    空闲时最大数量. 一般比最小值稍大一些
    pm.max_spare_servers=4

    回收进程前, 每个进程最多能处理的请求数量.
    这个设置有助于避免 PHP 扩展或库因编写拙劣而导致不断内存泄露.
    建议 1000, 你应该测试并调整
    pm.max_requests=1000

    请求处理时间超过 5 秒, 则
    reqeust_sloglog_timeout=5s
    把请求的回溯信息写入指定的 slowlog 日志
    slowlog=/path/to/slowlog.log

重启生效
    service php5-fpm restart

## PHP.ini

PHP Iniscan <https://github.com/psecio/iniscan> 可以检查最佳实践
Apache Bench 和 Seige 可以用来做压测

### 内存配置

问题
- 一共有能分配多少给 PHP? 考虑其他进程
- 单个 PHP 进程平局消耗多少内存? top, memory_get_peak_usage()
- 能负担多少 FPM 进程? see #PHP-FPM
- 有足够的系统资源吗? 压测工具

### Zend OPcache

编译时:
    `--enable-opache`

`php.ini`:
    `zend_extension=/path/to/opcache.so`
    必须先加载 opcache, 后加载 xdebug

确认: `phpinfo()`

配置:

    是否检查脚本内容更新, 以失效缓存
    生产环境中设为 0: 察觉不到脚本更新, 必须手动清空
    opcache.validate_timestamps = 1

    过多久 (秒, 0:永不) 则检查脚本是否更新
    opcache.revalidate_freq = 0

    为操作码分配的内存量 (MB). 根据代码量, 小则 16, 大则 64
    opcache.memory_consumption = 64

    驻留字符串 (解释器内部用到的) 默认隔离在进程中. 这个设置可以使多个进程共享
    opcache.interned_strings_buffer = 16

    一定要比应用中的文件数大
    opcache.max_accelerated_files = 4000

    设为 1 就行
    opcache.fast_shutdown = 1

### 文件上传

如果允许文件上传, 为了安全应该禁止上传功能

### 最长执行时间

耗时任务应使用异步队列

### 处理会话

默认文件存储会话会拖慢程序, 可使用 memcache 或 redis

session.save_handler='memcached'
session.save_path='127.0.0.2:11211'

### 缓冲输出

使用缓冲输出可以 deliver content to your visitor's browser in fewer pieces, faster

output_buffering=4096 // 确保是 8 的倍数
implicit_flush=false

### 真实路径缓存

缓存文件真实路径, 避免包含文件时搜索包含路径.

如何确定:
设为特别大的值, 如 256k.
然后在脚本末尾加上 print_r(realpath_cache_size()) 得到真实大小
然后设置为这个值
realpath_cache_size=64k

# Profiling

基准测试工具从外部测试性能
分析器从内部
- Xdebug + CacheGrind: 只应该在开发环境用
- XHProf + XHGUI: 可以在生产环境用

## Xdebug

配置

    xdebug.profiler_enable=0
    xdebug.profiler_enable_trigger=1 // 使用 URL 参数 XDEBUG_PROFILE=1 触发
    xdebug.profiler_output_dir=/path/to/profiler/results

触发
分析: qcachegrind

## XHProf

see <https://blog.engineyard.com/profiling-with-xhprof-xhgui-part-1>

-> PHP7: tideways_xhprof