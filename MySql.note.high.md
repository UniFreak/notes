# See
- 示例代码: <http://www.highperfmysql.com>

# 基准测试

## 策略

Mysql 可能不是瓶颈 -> 整体, 集成式: 应用整体, 包括 Web 服务器, 应用代码, 网络和数据库等

快速, Schema/查询比较, 具体问题 -> 单组件式

### 指标

选择对客户来说重要的指标:
- 吞吐量
- 响应时间/延迟 -> percentile
- 并发性: 不是为了测试应用能达到的并发度, 而是在不同并发下的性能
- 可扩展性

## 方法

错误方式: 应努力接近真实场景
- 和真实不匹配 -> 数据集, 数据分布, 单/多用户, 用户行为, 重复的查询, 配置
- 忽略了 -> 错误日志, 系统预热
- 时间太短: 应足够长, 否则所花的时间都是浪费

### 设计和规划

标准基准测试: TPC (不适合 OLTP)
专用基准测试:
- 集成式: http 请求, 查询日志

规划记录: 测试数据, 配置步骤, 如何测量和分析结果 (经常需要写一些脚本), 预热方案, 等

### 收集信息

先收集原始数据, 然后基于此进行分析和过滤
- CPU 使用率: uptime
- 磁盘 IO
- 网络流量
- SHOW GLOBAL STATUS / SHOW ENGINE INNODB STATUS / SHOW FULL PREOCESSLIST

### 分析结果

Makefile/shell/PHP/Perl

SHOW GLOBAL STATUS -> awk -> gnuplot

## 工具

除非现有工具不行, 不要自己开发

### 集成式

ab: 针对单个 URL 压力测试
http_load: 多个 URL 随机选择测试
jMeter: 加载其他应用并测试性能. 复杂的多

### 单组件式

mysqlslap: 模拟服务器负载, 输出计时信息
MySQL Benchmark Suite (sql-bench): 单线程, 用于测试查询执行速度, 比较不同引擎或配置
Super Smack: 压力测试和敷在生成
Database Test Suite: 类似某些工业标准测试工具集, 如 TPC
Percona's TPCC-MySQL Tool: 类似 TPC-C. 用于评估大压力下 MySQL 行为
sysbench: 多线程系统压测. 全能测试工具, 支持 MySQL, OS 和硬件测试 @todo: oltp, fileio

MySQL BENCHMARK() 函数不适合做真正测试

# 性能剖析: 时间花到了哪儿

性能优化: 在一定的负载下尽可能降低响应时间.

只测量需要优化的活动

时间分为执行和等待两部分, 确认哪些子任务是优化的目标 <- 正是剖析的用武之地
两种类型的剖析:
- 基于执行时间的分析: 什么任务执行时间最长
- 基于等待时间的分析: 什么地方被阻塞时间最长

两个步骤
1. 测试任务花费的时间
2. 对结果排序统计, 找出重要任务

量化支持: 可用的测量点 -> 从外部测量系统 -> 靠谱的猜测

## 剖析应用

建议在所有项目中到包含性能剖析代码. 尽量测量可以测量的一切.

可能的瓶颈: 外部资源调用 / 大量数据处理 / 循环中的昂贵操作 / 低效算法

工具: NewRelic


### PHP
xhprof: 轻量, 可扩展. 函数剖析, 耗时排序
xdebug / valgrind / cachegrind ...: 更低层
IfP: 更关注数据库调用

## 剖析 SQL 查询

先剖析整个数据库, 找出压力来源; 然后对查询单独剖析, 分析子任务响应时间

剖析服务器负载
- 慢日志查询: 开销最低, 精度最高的测量查询时间的工具. 但可能消耗磁盘空间 -> 日志轮转工具
- 抓取 TCP 网络包: tcpdump -> pt-query-digest @todo

剖析单条查询
- SHOW STATUS: 返回一些计数器, 有用, 但不是真正的剖析工具
- SHOW PROFILE:

    ````sh
    mysql> set profiling = 1;
    mysql> (run some sql...)
    mysql> show profiles; # 查看所有剖析记录
    mysql> show profile for query 1; # 查看单条详细记录
    mysql> select ... from information_schema.profiling ... ; # 从系统表中按需检索
    ```

- 慢日志查询
- Performance Schema

## 诊断间歇性问题

尽量不要通过试错方式来解决问题.

### 弄清是单条查询还是服务器问题

- SHOW GLOBAL STATUS
- SHOW PROCESSLIST / INFORMATION_SCHEMA.PREOCESSLIST 表 / innotop
- 慢日志查询

理解发现的问题: gnuplot / R 绘图

### 捕获诊断数据

诊断触发器: 收集数据并根据阈值识别问题 pt-stalk

服务器内部诊断: oprofile, strace
等待分析: gdb 堆栈跟踪, pt-pmp

收集数据: pt-collect

解释结果数据: 问题是否发生, 是否有明显跳跃变化. pt-mysql-summary, pt-summary, pt-sift

# Schema 与数据类型优化

see: <<Begining Database Design>>

## 数据类型

越小, 越简单越好 (内置), 避免 NULL (更难优化)

先确定大类型: 数字, 字符串, 时间...然后确定具体类型

### 整形

类型: (tiny/small/medium/ . /big)int
字节:  8    16    24     32  64

int(11) 对大多数应用无意义, 11 只是规定了交互工具显示字符的个数

标识列最好使用自增整数. 应该用无符号整形存 ip

### 实数

不只是为了存小数, 可以用 decimal 存储比 biginit 还大的整数, 但如果数据量大, 可考虑用 bigint
代替 decimal

MySQL 既支持精确类型又支持不精确类型
- float 4 / double 8: 近似浮点运算, 更快, 空间消耗更小
- decimal: 存储精确小数, 精确运算

建议不要指定精度.

### 字符串

二进制字符串 VS 常规字符串:
- 存储的字节码而非字符
- 没有排序规则或字符集
- 填充用 \0 而非空格
- 检索时不会去掉填充值
- 比较时, 大小写敏感, 因为进行的是字节数值比较所以也更快

varchar: 变长
    需要多 1~2 字节记录字符串长度 (如果长度<=255 则 1, 否则 2):
    对于 latin1 字符集, varchar(10) 需要 11 字节, varchar(1000) 需要 1002 个
    Pro: 省空间, 对性能也有帮助
    Con: 如果 update 导致变长, 需要额外工作
    For: 字串最大长度比平均长度大很多, 更新少, 使用了 UTF8 等复杂字符集或每个字符都使用不同
         字节数进行存储
char: 定长, 空格填充
    For: 字串短或长度比较一致 (这种情况空间也更小), 经常变更 (不易产生碎片)
varbinary binary
(tiny/small/medium/long)(blob/text)

MySQL 把每个 blob 和 text 当做独立对象处理

用 enum 代替字符串: 空间更小, 但关联可能更慢

    关联                  QPS
    -------------------------------
    varchar varchar      2.6
    varchar enum         1.7
    enum varchar         1.8
    enum enum            3.5


### 日期和时间

能存储的最小时间粒度为秒 -> 使用 bigint 存储微秒级别时间戳, 或用 double 存储秒之后的小数部分

datetime: 1001~9999 年, 8 字节, 精度秒
timestamp: 1970~2038 年, 4 字节, 显示依赖于时区

推荐 timestamp, 空间效率高. 不推荐用整数保存时间戳, 不方便处理

### 位数据

技术上来说都是字符串类型. 用于存储一个或多个 true/false

bit: 最大 64 位
    应谨慎使用 -> 想用 1 bit 存储 true/false, 可以创建一个可以为 null 的 char(0), null
    则 false, 空字符串则 true
set: 昂贵的 alter table

用整数列包装位进行按位操作:

    ```sh
    mysql> set @can_read := 1 << 0,
         >     @can_write := 1 << 1,
         >     @can_delete := 2 << 2;
    mysql> create table acl (
         >   perms tinyint unsigned not null default 0
        );
    mysql> insert into acl(perms) values(@can_read + @can_write);
    ```

## 陷阱

太多的列, 太多的关联 (单个查询 <12 个表), 全能的枚举

非此发明的 NULL. 确实需要表示未知时, 不要害怕使用 NULL

## 范式和反范式

范式
    Pro:
    很少或没有重复数据 -> 更新快, 更少需要 distinct/group by
    表更小, 能放到内存, 执行快
    Con: 通常需要关联
反范式:
    最常见的方法是复制或者缓存, 可以使用触发器更新缓存值. 例如缓存表或汇总表

# 索引优化

索引能减少扫描的数据量, 避免排序和临时表, 将随机 i/o 变为顺序 i/o

## 类型

B-Tree
    值都是按顺序 (由 create table 定义) 存储, 叶子也到根距离相同
        -> 加快访问速度, 适合范围查找, 排序
    因为只能高效使用索引最左前缀列, 如果索引包含多列, 顺序就很重要.
    For: 全键值, 键值范围, 最左键前缀, 以及覆盖索引查找操作
    Not: 不是最左前缀, 跳过索引列, 如果查询中有某个列的范围查询, 则其右边所有列都无法使用索引
哈希索引
    只有精确匹配所有列的查询才有效. 只适用特定场合, 但性能提升显著
    InnoDB 有 自适用哈希索引; 也可创建自定义哈希索引
    Con: 需要维护哈希值, 可用触发器实现; 需要处理哈希冲突
空间数据索引 (R-Tree)
    MyISAM 支持, 用作地理数据存储, 从所有维度 (无需前缀查询) 索引数据
    Con: MySQL 的 GIS 不完善, 大部分人不用这个特性.
全文索引
    适用于 match against 操作, 而非普通 where 条件操作

## 高性能索引策略

### 独立的列

始终将索引列单独放在比较符号一侧

### 前缀索引 & 后缀索引

如果需要索引很长的字符串, 可以考虑前缀(后缀)索引, 使索引更小更快.
Con: 无法做 order by 和 group by, 也无法做覆盖扫描

    ```sh
    mysql> alter table sakila.city_demo add key (city(7)); # 7 个长度的前缀索引
    ```

合适的前缀长度: 足够长以保证较高的选择性, 不要太长以节约空间. 考虑最坏情况下的选择性

后缀索引类似, 可以把字串反转后存储并基于此建立前缀索引, 用触发器维护

### 多列索引

在多个列上建立独立的单列索引大部分情况不能改善性能
-> MySQL 索引合并策略: 同时扫描两个单列索引, 然后合并结果

### 选择合适的索引列顺序

正确的顺序取决于: 使用索引的查询, 满足排序和分组需要, 选择性, 特殊/最坏情况

### InnoDB 聚簇索引

聚簇索引: 将数据行存放在索引的叶子页中. 一个表只能有一个
Pro: 相关数据保存在一起, 减少磁盘 i/o
     数据访问更快
     使用覆盖索引扫描的查询可以直接用页结点中的主键值
Con: 插入速度严重依赖于插入顺序
     更新代价高, 需将每个被更新的行移动到新位置
     插入和更新导致的 "页分裂" 占用更多空间
     可能导致全表扫描变慢
     二级索引 (非聚簇索引) 占用更大空间, 访问它需两次索引查找

最好避免随机的聚簇索引
如果没有什么数据需要聚集, 可以定义一个代理键作为主键 (如 id)
尽可能按主键顺序插入数据, 尽可能使用单调递增的聚簇键的值插入新行

### 覆盖索引

覆盖索引: 一个索引包含(覆盖)所有需要查询的字段的值, 只能用 B-Tree 索引做覆盖索引

### 索引扫描做排序

生成有序结果的两种方式: 通过排序操作; 或者按索引顺序扫描.

如果 explain 的 type 为 index, 则说明使用了索引扫描做排序.
必须满足条件: order by 子句的顺序和列的排序方向完全一致, 引用的字段全部为第一个表, 满足最左前缀 (除非前导列为常量)

以下不满足

```sql
# 两种不同的排序方向, 但索引列都是正序排序
... order by inventory_id desc, customer_id asc;
# 引用了不在索引中的列
... order by inventory_id, staff_id;
# where 和 order by 中的列无法组合成索引的最左前缀
... where rental_date='2005-05-25' order by customer_id;
# 第一列是范围条件
... where rental_date > '2005-05-25' order by inventory_id, customer_id;
# 多个等于条件, 对于排序来说也是一种范围查询
... where rental_date = '2005-05-25' and inventory_id in (1,2) order by customer_id;
```

### MyISAM 压缩 (前缀压缩) 索引

### 冗余和重复索引

应该尽量扩展已有索引而非创建新索引. 索引越多插入/更新/删除越慢.

重复索引: 相同列上相同顺序相同类型的索引. 应该避免
冗余索引: 创建了索引 (A, B), 在创建 (A) 就是冗余.
    但有时候处于性能也需要冗余索引
应删除未使用的索引

## 案例学习

使用索引来排序还是先检索数据再排序.
哪些列拥有很多不同的值 (选择性高)
那些列在 where 中出现的最频繁
还要考虑配合查询优化
常见的 where 条件有哪些
如何为一些生僻的搜索条件设计索引?
尽可能将需要范围查询的列放到索引后面
对于选择性低的列可以增加特殊索引来做排序

```sql
# 因为需扫描需要丢弃的数据, 无论如何创建查询, 这种查询都是个严重问题
# 延迟关联, 反范式, 预先计算, 缓存可能是解决它的仅有策略
select <cols> from profiles where sex='M' order by rating limit 100000, 10;
```

## 维护索引和表

# 查询优化

查询, 索引和库表结构优化需要齐头并进一个不落

了解查询的生命周期, 时间消耗情况对于优化意义很大

## 优化数据访问 (数据访问层)

查询性能低下的原因

访问的数据太多
- 查询不需要的记录 -> LIMIT
- 多表关联时返回全部列
- 总是取出全部列 (SELECT *)
- 重复查询相同数据

扫描额外记录 (检查慢日志查询找出扫描行数过多的查询). 扫描和返回的行数一般在 1:1~10:1 之间
访问类型 (explain 的 type) 慢到块
- all:全表扫描
- index:索引扫描
- range:范围扫描
- eq_ref:唯一索引查询
- const,system:常数引用
使用 WHERE 条件的方式, 慢到快 (explain.extra)
- using where: 从数据表中过滤
- using index: 索引覆盖扫描. 从索引中过滤
- 在索引中使用 where
优化
- 需要用的列都放到索引 -> 使用索引覆盖扫描
- 改变库表结构 (如汇总表)
- 重写复杂查询

## 重构查询 (应用层, 拆分复杂查询)

MySQL 的连接很轻量级, "数据库尽量完成更多工作" 的建议并不适用

- 切分查询

    ```sql
    row_affected = 0
    do {
        rows_affected = do_query(
            'delete from messages where created<date_sub(now(), interval 3 month)
            limit 10000')
    } while row_affected > 0
    ```

- 分解关联查询 (缓存效率高, 减少锁竞争, 减少冗余记录的查询, 应用层做关联更易扩展)

    ```sql
    select * form tag where tag='mysql';
    select * from tag_post where tag_id=1234;
    select * from post where post.id in (123,456,567,9098,8904);
    ```

## 查询执行基础

查询过程:
1. 客户端发送查询给服务器 (通信协议)
2. 服务器检查缓存, 未命中则
3. 解析 SQL, 预处理, 再由优化器生成执行计划
4. 调用存储引擎 API 执行缓存
5. 返回结果给客户端

### 通信协议

客户端和服务器通信协议时 "半双工" 的 (不能同时发送消息)
Pro: 简单快速
Con:
无法进行流量控制, 必须接受完整消息才能响应

连接 MySQL 的库函数 (PHP mysql_*()) 一般是获得全部结果 (mysql_query()) 缓存到内存中
除非使用 mysql_unbuffered_query()

### 查询缓存

通过对大小写敏感的哈希查找实现. 即使查询和缓存中的查询有一个字节不同, 也匹配不到缓存.

### 优化器

预测执行计划的成本, 选择最小的. 很多原因会导致选择错误的执行计划.

优化器的优化策略包括
- 静态优化: 分析解析树进行优化. 可认为 "编译时优化"
- 动态优化: 上下文相关, 如 WHERE 条件取值. 每次查询是都重新评估. 可认为 "运行时优化"

能处理的优化类型
- 重新定义关联表的顺序
- 将外连接转换成内连接
- 等价变换: (a<b AND b=c) AND a=5 --> b>5 AND b=c AND a=5
- 优化 COUNT(), MIN(), MAX() 为常数 (explain: Select tables optimized away)
- 预估并转换为常数表达式

`show status like 'Last_query_cost'` 可查看当前查询的成本





# 附录

SHOW PROCESSLIST 状态
Sleep: 等待客户端发送新请求
Query: 正在查询或正将结果发送给客户端
Locked: 等待表锁 (InnoDB 的行锁不体现在这里)
Analyzing and statistics: 收集存储引擎统计信息, 生成执行计划
Copying to tmp table [on disk]: 将结果集复制到临时表 (GROUP BY, 文件排序, UNION)
Sorting Result: 排序结果集
Sending Data: 多个状态之间 (注意不单指给客户端) 传送数据

