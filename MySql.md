SQL指结构化查询语言
除了SQL标准之外,大部分SQL数据库程序都拥有它们自己的私有扩展
SQL对大小写不敏感
RDBMS指的是关系型数据库管理系统
某些数据库软件要求必须使用分号
可以把SQL分为两个部分:数据操作语言(DML)和数据定义语言(DDL)
由SQL查询程序获得的结果被存放在一个结果集中
SQL使用单引号来环绕文本值

# 注释

-- 注释
/*注释*/

# 程序

mysqld                                  MySQL服务器
mysqld_safe, mysql.server, mysqld_multi 服务器启动脚本
mysql_install_db                        初始化数据目录和初始数据库

mysql                                   用于交互式或以批处理模式执行SQL语句
mysqladmin                              用于管理功能的客户程序
mysqlcheck                              执行表维护操作
mysqldump, mysqlhotcopy                 负责数据库备份
mysqlimport                             导入数据文件
mysqlshow                               显示信息数据库和表的相关信息

myisamchk                               执行表维护操作
myisampack                              产生压缩, 只读的表
mysqlbinlog                             处理二进制日志文件的实用工具
perror                                  显示错误代码的含义

# 概念

三大范式
- 列不可再分
- 行不可再分
- 表不可再分

字符集(CHARACTER SET): 是一套符号和编码

校对规则(COLLATION): 是在字符集内用于比较字符的一套规则
- _ci                     大小写不敏感
- _cs                     大小写敏感
- _bin                    二元

数据词典|系统目录: 即元数据, 关于数据的数据. INFORMATION_SCHEMA 提供了访问数据库元数据的方式

表空间: 从物理上说数据库的数据被存放在数据文件中, 而从逻辑上说是被存放在表空间中的

表格式
- 静态: 固定长度列, 记录位于固定位置, 快, 容易缓存和重建, 比动态需要更多磁盘空间
- 动态: 可变长度列, 更多碎片, 更难重建, 更少磁盘空间, 要经常用optimize table 命令或优化工具来进行碎片整理

锁
- 表级锁
- 行级锁

存储引擎|表类型

    It is crucial to understand each storage engine features and choose the most appropriate one for your tables to maximize the performance of the database

- MYISAM: 非事务表, 支持表锁定, 支持全文查询fulltext, 搜索速度快, 记录表行数, 但写入速度慢, 不支持外键. 多用于频繁查询, 数据量要求不高的数据表中, 最大 256TB.
    + .frm: 表定义文件
    + .MYD: 数据文件
    + .MYI: 索引文件
- MERGE | MRG_MyISAM: MyISAM变种, 非事务表, 将一系列等同的MyISAM表以逻辑方式组合在一起, 并作为1个对象引用它们. 适合于数据仓储等VLDB环境
- INNODB|BDB(Berkeley DB): 事务表, InnoDB支持行锁定, BDB支持页锁定,  支持外键等高级数据库功能, CPU效率最高, 不支持全文搜索, 搜索速度相对较慢, 不记录行数. 多用于安全性高, 数据量大的数据表中, 最大 64TB
- MEMORY|HEAP: 非事务表, 数据记录在内存中, 写入及查询速度最快. 但由于使用内存, 根本无法长期保存, 而且可以保存的数据量也不能太高. 通常用于临时记录数据, 可以即用即弃的数据表中, 如密钥验证记录密钥等.
- EXAMPLE: 存根引擎, 它不做什么. 你可以用这个引擎创建表, 但没有数据被存储于其中或从其中检索,这个引擎的目的是作为MySQL源代码中的一个例子,用来演示如何开始编写一个新存储引擎
- NDB Cluster: 事务表, 被MySQL Cluster用来实现分割到多台计算机上的表的存储引擎, 适合于具有高性能查找要求的应用程序
- ARCHIVE: 被用来无索引地, 非常小地覆盖存储的大量数据. 适合于很少引用的历史、归档、或安全审计信息的存储和检索
- CSV: 存储引擎把数据以逗号分隔的格式存储在文本文件中, 不支持索引, 便于和第三方软件(excel)共享数据
- BLACKHOLE: 就像“黑洞”一样, 它接收数据但丢弃它而不是存储它. 取回总是返回空集, 不允许索引
- FEDERATED: 存储引擎把数据存在远程数据库中, 不允许索引. 适合于分布式环境或数据集市环境

分区表: 表的不同部分在不同的位置被存储为单独的表
- RANGE 基于属于一个给定连续区间的列值, 把多行分配给分区
- LIST 类似于按RANGE分区, 区别在于LIST分区是基于列值匹配一个离散值集合中的某个值来进行选择
- HASH 基于用户定义的表达式的返回值来进行选择的分区, 该表达式使用将要插入到表中的这些行的列值进行计算
- KEYS 类似于按HASH分区, 区别在于KEY分区只支持计算一列或多列, 且MySQL服务器提供其自身的哈希函数

约束(CONSTRAINT): 约束主要完成对数据的检验，保证数据库数据的完整性
- NOT NULL                非空, 确保当前列的值不为空值
- UNIQUE                  唯一, 确保数据的唯一性
- PRIMARY KEY             主键, 相当于唯一约束+非空约束的组合
- PRIMARY KEY
- CHECK                   检查, MySql 可以使用 CHECK 约束, 但没有任何效果
- DEFAULT                 缺省, 用于向列中插入默认值

列级约束: 用于创建单列约束, 包括上述全部六种
表级约束: 用于创建单列或多列约束, 只包括上述四种: UNIQUE, PRIMARY KEY, FOREIGN KEY, CHECK

索引(INDEX)

    可在创建表, 修改表是创建, 或用 create index 直接创建
    只要搜索条件中, 包含涉及到索引的字段(组合), sql语句会自动的选用索引
    首先寻找与搜素条件最匹配的索引, 若没有, 按照搜索条件的顺序选用最匹配的索引
    大多数MySQL索引在 B 树中存储, 只是 SPATIAL 类型的索引使用R-树, 并且 MEMORY 表还支持 hash 索引
    每个查询语句, 最多使用一个索引( 如果 where 已经使用了索引, order by 便不会使用)
    NULL会导致索引形同虚设, 所以在设计表结构时应避免NULL 的存在
    索引能大大的加快查询速度, 同时会大大的降低写入(need to insert or update index values as well)的速度, 还会增加存储空间
    indexes are also type of tables, which keep primary key or index field and a pointer to each record into the actual table


    索引按包含的列数可分为
        单列索引: 一个索引只包含单个列, 一个表可以有多个单列索引, 但 mysql 只会用到他认为最有效率的那 *一* 个
        组合|联合索引: 一个索引包含多个列, 相当于创建了多个"最左前缀"的多个组合索引
    也可按类型分为
        INDEX               普通, 速度在三者中最慢, 但是几乎没有任何限制
        UNIQUE              唯一, 速度仅次于主键, 涉及到的字段(组合)值必须唯一
        PRIMARY             主键, 在所有类型的索引速度最快. 每个数据表最多有一个, 涉及到主键的字段(组合)值必须唯一
        FULLTEXT            全文, 主要用于模糊搜索. 表类型必须是 myisam, 涉及字段类型必须是字符型
        SPATIAL             地理信息, 主要用于地理信息搜索. 涉及字段类型必须是地理信息型

    会用到索引情况
        不以 _ 或 % 开头的 LIKE
        <, <=, =, >, >=, BETWEEN, IN
    索引失效的情况
        以 _ 或 % 开头的 LIKE
        <>, not in, !=, is null
        进行函数运算
        使用 OR
        存了数值的字符串类型字段
        在JOIN操作中, 在主键和外键的数据类型不相同

SEQUENCE
    A set of integers 1, 2, 3, ... that are generated in order on demand
    Sequences are frequently used in databases because many applications require each row in a table to contain a unique value and sequences provide an easy way to generate them

视图(VIEW)
    视图是从一个或几个基本表(或视图)导出的虚表, 数据库只存放视图的定义, 而不存放视图对应的数据. 这些数据仍存放在原来的基本表中. 所以基本表中的数据发生变化, 从视图中查询出的数据也就随之改变了
    视图对重构数据库提供了一定程度的逻辑独立性
    视图能够对机密数据提供安全保护
    适当的利用视图可以更清晰地表达查询

TEMPORARAY TABLE
    will be deleted when the current client session terminates

存储程序
    被存储在服务器中的一套SQL语句

# 列类型

数值

    BIT
    TINYINT | BOOL,BOOLEAN          1       -128~127 | 0~255
    SMALLINT                        2       -32768~32767 | 0~65535
    MEDIUMINT                       3       -8388608~8388607 | 0~16777215
    INT | INTEGER                   4       -2147483648~2147483647 | 0~4294967295
    BIGINT                          8       -9223372036854775808~9223372036854775807 | 0~18446744073709551615

    FLOAT                           4       ±1.75494351E-38 | ±3.402823466E+38
    DOUBLE|DOUBLE PRECISION         8       ±2.2250738585072014E-308 |
    DECIMAL|DEC|FIEXED|NUMERIC

日期和时间

    DATE                            3
    DATETIME                        8
    TIMESTAMP                       4
    TIME                            3
    YEAR                            1

字符串

    CHAR                                    255(字符)
    VARCHAR                                 65535

    BINARY
    VARBINARY

    BLOB(BinaryLargeOBject)                 65535
    TINYBLOB
    MEDIUMBLOB                              16777215
    LONGBLOB                                4294967295

    TINYTEXT                                255
    TEXT                                    65535
    MEDIUMTEXT                              16777215
    LONGTEXT                                4294967295

    ENUM                                    65535(成员)
    SET                                     64(成员)

在任何情况下均应使用最精确的类型

# 操作符

优先级(从高到低)

    :=
    ||, OR, XOR
    &&, AND
    NOT
    BETWEEN, CASE, WHEN, THEN, ELSE
    =, <=>, >=, >, <=, <, <>, !=, IS, LIKE, REGEXP, IN
    *   (where LIKE is used, REGEXP can be used, too)
    |
    &
    <<, >>
    -, +
    *, /, DIV, %, MOD
    ^
    - (一元减号), ~ (一元比特反转)
    !
    BINARY, COLLATE

<=> : 和=执行相同的比较, 不过在两个操作码均为NULL时其所得值为1而不为NULL, 而当一个操作码为NULL时, 其所得值为0而不为NULL

DIV : 整除

# 通配符

通配符必须与 LIKE 运算符一起使用
- %                   一个或多个字符
- _                   一个字符
- [charlist]          字符列中任一字符
- [^charlist]         不是字符列中的任一字符

# 函数

比较

    GREATEST()
    LEAST()
    COALESCE()
    ISNULL()
    INTERVAL()

流程控制

    IF(expr1,expr2,expr3)
        if expr1=true, return expr2, else return expr3
    IFNULL(expr1,expr2)
    NULLIF(expr1,expr2)

字符串

    ASCII(str)
    BIN(N)
    BIT_LENGTH(str)
    CHAR(N,... [USING charset])
    CHAR_LENGTH(str) | CHARACTER_LENGTH(str)
    COMPRESS(string_to_compress)
    UNCOMPRESS(string_to_uncompress)
    CONCAT(str1,str2,...)
    CONCAT_WS(separator,str1,str2,...)
    CONV(N,from_base,to_base)
    ELT(N,str1,str2,str3,...)
    FIELD(str,str1,str2,str3,...)
    EXPORT_SET(bits,on,off[,separator[,number_of_bits]])
    FIND_IN_SET(str,strlist)
    FORMAT(X,D)
    HEX(N_or_S)
    UNCOMPRESSED_LENGTH(compressed_string)
    INSERT(str,pos,len,newstr)
    INSTR(str,substr)
    LCASE(str) | LOWER(str)
    UCASE(str) | UPPER(str)
    LEFT(str,len)
    RIGHT(str,len)
    LPAD(str,len,padstr)
    RPAD(str,len,padstr)
    LTRIM(str)
    RTRIM(str)
    LENGTH(str) | OCTET_LENGTH(str)
    LOAD_FILE(file_name)
    LOCATE(substr,str) , LOCATE(substr,str,pos)
    MAKE_SET(bits,str1,str2,...)
    MID(str,pos,len) | SUBSTRING(str,pos,len)
    OCT(N)
    ORD(str)
    POSITION(substr IN str) | LOCATE(substr,str)
    QUOTE(str)
    REPEAT(str,count)
    REPLACE(str,from_str,to_str)
    REVERSE(str)
    SOUNDEX(str)
    SPACE(N)
    SUBSTRING(str,pos), SUBSTRING(str FROM pos), SUBSTRING(str,pos,len), SUBSTRING(str FROM pos FOR len)
    SUBSTRING_INDEX(str,delim,count)
    TRIM([{BOTH | LEADING | TRAILING} [remstr] FROM] str), TRIM(remstr FROM] str)

数值:

日期和时间:

    ADDDATE(date,INTERVAL expr type) | ADDDATE(expr,days)
    DATE_ADD(date,INTERVAL expr type)
    SUBDATE(date,INTERVAL expr type) | SUBDATE(expr,days)
    DATE_SUB(date,INTERVAL expr type)
    ADDTIME(expr,expr2)
    SUBTIME(expr,expr2)
    TIMESTAMPADD(interval,int_expr,datetime_expr)
    PERIOD_ADD(P,N)

    GET_FORMAT(DATE|TIME|DATETIME, 'EUR'|'USA'|'JIS'|'ISO'|'INTERNAL')
    DATE_FORMAT(date,format)
    TIME_FORMAT(time,format)
    CONVERT_TZ(dt,from_tz,to_tz)
    FROM_DAYS(N)
    FROM_UNIXTIME(unix_timestamp) | FROM_UNIXTIME(unix_timestamp,format)
    MAKEDATE(year,dayofyear)
    MAKETIME(hour,minute,second)
    SEC_TO_TIME(seconds)
    STR_TO_DATE(str,format)
    TIME_TO_SEC(time)
    TO_DAYS(date)

    CURDATE() | CURRENT_DATE
    CURTIME() | CURRENT_TIME
    CURRENT_TIMESTAMP | CURRENT_TIMESTAMP | LOCALTIME | LOCALTIME() | LOCALTIMESTAMP | LOCALTIMESTAMP() | NOW()
    LAST_DAY(date)

    DATEDIFF(expr,expr2)
    PERIOD_DIFF(P1,P2)
    TIMEDIFF(expr,expr2)
    TIMESTAMPDIFF(interval,datetime_expr1,datetime_expr2)

    EXTRACT(type FROM date)
    MICROSECOND(expr)
    SECOND(time)
    MINUTE(time)
    HOUR(time)
    DAYOFMONTH() | DAY()
    DAYOFWEEK(date)
    DAYOFYEAR(date)
    TIME(expr)
    MONTH(date)
    MONTHNAME(date)
    QUARTER(date)
    YEAR(date)
    DATE(expr)
    TIMESTAMP(expr) / TIMESTAMP(expr,expr2)

    SYSDATE()
    UNIX_TIMESTAMP(), UNIX_TIMESTAMP(date)
    UTC_DATE | UTC_DATE()
    UTC_TIME | UTC_TIME()
    UTC_TIMESTAMP | UTC_TIMESTAMP()
    WEEK(date[,mode])
    WEEKDAY(date)
    WEEKOFYEAR(date)
    YEARWEEK(date), YEARWEEK(date,start)

其他:

# SQL 语句语法

## 数据定义(DDL)

ALTER DATABASE

    ALTER {DATABASE | SCHEMA} [db_name]
        alter_specification [, alter_specification] ...

    alter_specification:
        [DEFAULT] CHARACTER SET charset_name
      | [DEFAULT] COLLATE collation_name

ALTER TABLE

    ALTER [IGNORE] TABLE tbl_name
        alter_specification [, alter_specification] ...

    alter_specification:
        ADD [COLUMN] column_definition [FIRST | AFTER col_name ]
      | ADD [COLUMN] (column_definition,...)
      | ADD INDEX [index_name] [index_type] (index_col_name,...)
      | ADD [CONSTRAINT [symbol]]
            PRIMARY KEY [index_type] (index_col_name,...)
      | ADD [CONSTRAINT [symbol]]
            UNIQUE [index_name] [index_type] (index_col_name,...)
      | ADD [FULLTEXT|SPATIAL] [index_name] (index_col_name,...)
      | ADD [CONSTRAINT [symbol]]
            FOREIGN KEY [index_name] (index_col_name,...)
            [reference_definition]
      // 设置或删除列的默认值. 该操作会直接修改 .frm 文件而不涉及表数据, 所以这个操作非常快
      | ALTER [COLUMN] col_name {SET DEFAULT literal | DROP DEFAULT}
      // 列的重命名, 列类型的变更以及列位置的移动.
      | CHANGE [COLUMN] old_col_name column_definition
            [FIRST|AFTER col_name]
      // 除了列的重命名之外, 他干的活和 CHANGE COLUMN 是一样的
      | MODIFY [COLUMN] column_definition [FIRST | AFTER col_name]
      | DROP [COLUMN] col_name
      | DROP PRIMARY KEY
      | DROP INDEX index_name
      | DROP FOREIGN KEY fk_symbol
      | DISABLE KEYS
      | ENABLE KEYS
      | RENAME [TO] new_tbl_name
      | ORDER BY col_name
      | CONVERT TO CHARACTER SET charset_name [COLLATE collation_name]
      | [DEFAULT] CHARACTER SET charset_name [COLLATE collation_name]
      | DISCARD TABLESPACE
      | IMPORT TABLESPACE
      | table_options
      | partition_options
      | ADD PARTITION partition_definition
      | DROP PARTITION partition_names
      | COALESCE PARTITION number
      | REORGANIZE PARTITION partition_names INTO (partition_definitions)
      | ANALYZE PARTITION partition_names
      | CHECK PARTITION partition_names
      | OPTIMIZE PARTITION partition_names
      | REBUILD PARTITION partition_names
      | REPAIR PARTITION partition_names

ALTER VIEW

    ALTER [ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
        VIEW view_name [(column_list)]
        AS select_statement
        [WITH [CASCADED | LOCAL] CHECK OPTION]

CREATE DATABASE

    CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name
        [create_specification [, create_specification] ...]

    create_specification:
        [DEFAULT] CHARACTER SET charset_name
      | [DEFAULT] COLLATE collation_name

CREATE INDEX

    CREATE [UNIQUE|FULLTEXT|SPATIAL] INDEX index_name
        [USING index_type]
        ON tbl_name (index_col_name,...)

    // 如果是字段是CHAR, VARCHAR类型, length 可以小于字段实际长度; 如果是 BLOB 和 TEXT 类型必须指定 length
    index_col_name:
        col_name [(length)] [ASC | DESC]

CREATE TABLE

    CREATE [TEMPORARY] TABLE [IF NOT EXISTS] [db_name.]tbl_name
        [(create_definition,...)]
        [table_options] [select_statement]

    CREATE [TEMPORARY] TABLE [IF NOT EXISTS] [db_name.]tbl_name
        [(] LIKE old_tbl_name [)];

    create_definition:
        column_definition
      | [CONSTRAINT [symbol]] PRIMARY KEY [index_type] (index_col_name,...)
      | KEY [index_name] [index_type] (index_col_name,...)
      | INDEX [index_name] [index_type] (index_col_name,...)
      | [CONSTRAINT [symbol]] UNIQUE [INDEX]
            [index_name] [index_type] (index_col_name,...)
      | [FULLTEXT|SPATIAL] [INDEX] [index_name] (index_col_name,...)
      | [CONSTRAINT [symbol]] FOREIGN KEY
            [index_name] (index_col_name,...) [reference_definition]
      | CHECK (expr)

    column_definition:
        col_name type [NOT NULL | NULL] [DEFAULT default_value]
            [AUTO_INCREMENT] [UNIQUE [KEY] | [PRIMARY] KEY]
            [COMMENT 'string'] [reference_definition]

    // DEFAULT: 默认值必须为一个常数, 不能为一个函数或一个表达式.
    // 有一种情况例外: 可以对 TIMESTAMP 列指定 CURRENT_TIMESTAMP 为默认值
    // AUTO_INCREMENT : 设置自增属性的列必须是主键或者加 UNIQUE 索引

    type:
        TINYINT[(length)] [UNSIGNED] [ZEROFILL]
      | SMALLINT[(length)] [UNSIGNED] [ZEROFILL]
      | MEDIUMINT[(length)] [UNSIGNED] [ZEROFILL]
      | INT[(length)] [UNSIGNED] [ZEROFILL]
      | INTEGER[(length)] [UNSIGNED] [ZEROFILL]
      | BIGINT[(length)] [UNSIGNED] [ZEROFILL]
      | REAL[(length,decimals)] [UNSIGNED] [ZEROFILL]
      | DOUBLE[(length,decimals)] [UNSIGNED] [ZEROFILL]
      | FLOAT[(length,decimals)] [UNSIGNED] [ZEROFILL]
      | DECIMAL(length,decimals) [UNSIGNED] [ZEROFILL]
      | NUMERIC(length,decimals) [UNSIGNED] [ZEROFILL]
      | DATE
      | TIME
      | TIMESTAMP
      | DATETIME
      | CHAR(length) [BINARY | ASCII | UNICODE]
      | VARCHAR(length) [BINARY]
      | TINYBLOB
      | BLOB
      | MEDIUMBLOB
      | LONGBLOB
      | TINYTEXT [BINARY]
      | TEXT [BINARY]
      | MEDIUMTEXT [BINARY]
      | LONGTEXT [BINARY]
      | ENUM(value1,value2,value3,...)
      | SET(value1,value2,value3,...)
      | spatial_type

    index_col_name:
        col_name [(length)] [ASC | DESC]

    reference_definition:
        REFERENCES tbl_name [(index_col_name,...)]
                   [MATCH FULL | MATCH PARTIAL | MATCH SIMPLE]
                   [ON DELETE reference_option]
                   [ON UPDATE reference_option]

    reference_option:
        RESTRICT | CASCADE | SET NULL | NO ACTION

    table_options: table_option [table_option] ...

    table_option:
        {ENGINE|TYPE} = engine_name
      | AUTO_INCREMENT = value
      | AVG_ROW_LENGTH = value
      | [DEFAULT] CHARACTER SET charset_name [COLLATE collation_name]
      | CHECKSUM = {0 | 1}
      | COMMENT = 'string'
      | CONNECTION = 'connect_string'
      | MAX_ROWS = value
      | MIN_ROWS = value
      | PACK_KEYS = {0 | 1 | DEFAULT}
      | PASSWORD = 'string'
      | DELAY_KEY_WRITE = {0 | 1}
      | ROW_FORMAT = {DEFAULT|DYNAMIC|FIXED|COMPRESSED|REDUNDANT|COMPACT}
      | UNION = (tbl_name[,tbl_name]...)
      | INSERT_METHOD = { NO | FIRST | LAST }
      | DATA DIRECTORY = 'absolute path to directory'
      | INDEX DIRECTORY = 'absolute path to directory'

    partition_options:
        PARTITION BY
               [LINEAR] HASH(expr)
            |  [LINEAR] KEY(column_list)
            |  RANGE(expr)
            |  LIST(column_list)
        [PARTITIONS num]
        [  SUBPARTITION BY
               [LINEAR] HASH(expr)
             | [LINEAR] KEY(column_list)
          [SUBPARTITIONS(num)]
        ]
        [(partition_definition), [(partition_definition)], ...]

    partition_definition:
        PARTITION partition_name
            [VALUES {
                      LESS THAN (expr) | MAXVALUE
                    | IN (value_list) }]
            [[STORAGE] ENGINE [=] engine-name]
            [COMMENT [=] 'comment_text' ]
            [DATA DIRECTORY [=] 'data_dir']
            [INDEX DIRECTORY [=] 'index_dir']
            [MAX_ROWS [=] max_number_of_rows]
            [MIN_ROWS [=] min_number_of_rows]
            [TABLESPACE [=] (tablespace_name)]
            [NODEGROUP [=] node_group_id]
            [(subpartition_definition), [(subpartition_definition)], ...]

    subpartition_definition:
        SUBPARTITION logical_name
            [[STORAGE] ENGINE [=] engine-name]
            [COMMENT [=] 'comment_text' ]
            [DATA DIRECTORY [=] 'data_dir']
            [INDEX DIRECTORY [=] 'index_dir']
            [MAX_ROWS [=] max_number_of_rows]
            [MIN_ROWS [=] min_number_of_rows]
            [TABLESPACE [=] (tablespace_name)]
            [NODEGROUP [=] node_group_id]

    select_statement:
        [IGNORE | REPLACE] [AS] SELECT ...   (Some legal select statement)


CREATE VIEW

    CREATE [OR REPLACE] [ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
        VIEW view_name [(column_list)]
        AS select_statement
        [WITH [CASCADED | LOCAL] CHECK OPTION]

CREATE TRIGGER

    CREATE TRIGGER trigger_name trigger_time trigger_event
        ON tbl_name FOR EACH ROW trigger_stmt

RENAME TABLE

DROP DATABASE

    DROP {DATABASE | SCHEMA} [IF EXISTS] db_name

DROP INDEX

    DROP INDEX index_name ON tbl_name

DROP TABLE

    DROP [TEMPORARY] TABLE [IF EXISTS]
        tbl_name [, tbl_name] ...
        [RESTRICT | CASCADE]

DROP VIEW

    DROP VIEW [IF EXISTS]
        view_name [, view_name] ...
        [RESTRICT | CASCADE]

DROP TRIGGER

    DROP TRIGGER
        DROP TRIGGER [schema_name.]trigger_name

## 数据操作(DML)

JOIN 语法 (用于 SELECT 语句的 table_references 部分和多表 DELETE 和 UPDATE 语句)

包括以下几种 join 类型
- Inner Join : A 交 B
- Outter Join
    + Left Outter Join :  (A 交 B) 并 A     // B 中没有匹配则用 NULL 值代替
    + Right Outter Join :  (A 交 B) 并 B        // A 中没有匹配则用 NULL 值代替
    + Full Join : (A 交 B) 并 A 并 B         // A 或 B 中没有匹配则用 NULL 值代替
- Cross Join : A 与 B 的笛卡尔积                // 条件语句只能是 WHERE

    table_references:
        table_reference [, table_reference] …

    table_reference:
        table_factor
      | join_table

    table_factor:
        tbl_name [[AS] alias]
            [{USE|IGNORE|FORCE} INDEX (key_list)]
      | ( table_references )
      | { OJ table_reference LEFT OUTER JOIN table_reference
            ON conditional_expr }       // 用于为同时存在于两个表中的所有列进行命名

    join_table:
        table_reference [INNER | CROSS] JOIN table_factor [join_condition]
      | table_reference STRAIGHT_JOIN table_factor
      | table_reference STRAIGHT_JOIN table_factor ON condition
      | table_reference LEFT [OUTER] JOIN table_reference join_condition
      | table_reference NATURAL [LEFT [OUTER]] JOIN table_factor
      | table_reference RIGHT [OUTER] JOIN table_reference join_condition
      | table_reference NATURAL [RIGHT [OUTER]] JOIN table_factor

    join_condition:
        ON conditional_expr
      | USING (column_list)

UNION语法

    SELECT ...
    UNION [ALL | DISTINCT]
    SELECT ...
    [UNION [ALL | DISTINCT]
    SELECT ...]

Subquery语法

    标量 (返回单一值)
        ANY / SOME : 对于子查询返回的 *任一* 数值, 结果为 true 则返回 true
        IN / =ANY : 对于子查询返回的 *所有* 数值, 结果为 true 则返回 true
        NOT IN / <>ALL :
    行 (返回一个单一行)
        () / ROW() : 行构造符
        EXISTS / NOT EXISTS : 如果一个子查询返回任何的行, 则为 true/false
    表

    包含 NULL 值的表和空表为"边缘情况", 当编写子查询代码时, 都要考虑您是否把这两种可能性计算在内

SELECT

    SELECT
        [ALL | DISTINCT | DISTINCTROW ]
          [HIGH_PRIORITY]
          [STRAIGHT_JOIN]
          [SQL_SMALL_RESULT] [SQL_BIG_RESULT] [SQL_BUFFER_RESULT]
          [SQL_CACHE | SQL_NO_CACHE] [SQL_CALC_FOUND_ROWS]
        select_expr, ...
        [INTO OUTFILE 'file_name' export_options
          | INTO DUMPFILE 'file_name']
        [FROM table_references
        [WHERE where_definition]    // 不允许在子句里面使用统计函数
        [GROUP BY {col_name | expr | position}
          [ASC | DESC], ... [WITH ROLLUP]]
        [HAVING where_definition]   // 筛选查询结果, 语法同 WHERE 子句
        [ORDER BY {col_name | expr | position}
          [ASC | DESC] , ...]
        [LIMIT {[offset,] row_count | row_count OFFSET offset}]
        [PROCEDURE procedure_name(argument_list)]
        [FOR UPDATE | LOCK IN SHARE MODE]]

INSERT

    INSERT [LOW_PRIORITY | DELAYED | HIGH_PRIORITY] [IGNORE]
        [INTO] tbl_name [(col_name,...)]
        VALUES ({expr | DEFAULT},...),(...),...
        [ ON DUPLICATE KEY UPDATE col_name=expr, ... ]

    INSERT [LOW_PRIORITY | DELAYED | HIGH_PRIORITY] [IGNORE]
        [INTO] tbl_name
        SET col_name={expr | DEFAULT}, ...
        [ ON DUPLICATE KEY UPDATE col_name=expr, ... ]

    INSERT [LOW_PRIORITY | HIGH_PRIORITY] [IGNORE]
        [INTO] tbl_name [(col_name,...)]
        SELECT ...
        [ ON DUPLICATE KEY UPDATE col_name=expr, ... ]

REPLACE

    REPLACE [LOW_PRIORITY | DELAYED]
        [INTO] tbl_name [(col_name,...)]
        VALUES ({expr | DEFAULT},...),(...),...

    REPLACE [LOW_PRIORITY | DELAYED]
        [INTO] tbl_name
        SET col_name={expr | DEFAULT}, ...

    REPLACE [LOW_PRIORITY | DELAYED]
        [INTO] tbl_name [(col_name,...)]
        SELECT ...

UPDATE

    单表语法
    UPDATE [LOW_PRIORITY] [IGNORE] tbl_name
        SET col_name1=expr1 [, col_name2=expr2 ...]
        [WHERE where_definition]
        [ORDER BY ...]
        [LIMIT row_count]

    多表语法
    UPDATE [LOW_PRIORITY] [IGNORE] table_references
        SET col_name1=expr1 [, col_name2=expr2 ...]
        [WHERE where_definition]

DELETE

    单表语法
    DELETE [LOW_PRIORITY] [QUICK] [IGNORE] FROM tbl_name
        [WHERE where_definition]
        [ORDER BY ...]
        [LIMIT row_count]

    多表语法:
    DELETE [LOW_PRIORITY] [QUICK] [IGNORE]
        tbl_name[.*] [, tbl_name[.*] ...]
        FROM table_references
        [WHERE where_definition]
    或
    DELETE [LOW_PRIORITY] [QUICK] [IGNORE]
        FROM tbl_name[.*] [, tbl_name[.*] ...]
        USING table_references
        [WHERE where_definition]

DO

    DO expr [, expr] ...

HANDLER
    HANDLER tbl_name OPEN [ AS alias ]
    HANDLER tbl_name READ index_name { = | >= | <= | < } (value1,value2,...)
        [ WHERE where_condition ] [LIMIT ... ]
    HANDLER tbl_name READ index_name { FIRST | NEXT | PREV | LAST }
        [ WHERE where_condition ] [LIMIT ... ]
    HANDLER tbl_name READ { FIRST | NEXT }
        [ WHERE where_condition ] [LIMIT ... ]
    HANDLER tbl_name CLOSE

LOAD DATA INFILE

    LOAD DATA [LOW_PRIORITY | CONCURRENT] [LOCAL] INFILE 'file_name.txt'
        [REPLACE | IGNORE]
        INTO TABLE tbl_name
        [FIELDS
            [TERMINATED BY 'string']
            [[OPTIONALLY] ENCLOSED BY 'char']
            [ESCAPED BY 'char' ]
        ]
        [LINES
            [STARTING BY 'string']
            [TERMINATED BY 'string']
        ]
        [IGNORE number LINES]
        [(col_name_or_user_var,...)]
        [SET col_name = expr,...)]

TRUNCATE

    TRUNCATE [TABLE] tbl_name

## 实用工具

    {DESCRIBE | DESC} tbl_name [col_name | wild]
    USE db_name

## 事务处理和锁定

    START TRANSACTION | BEGIN [WORK]
    COMMIT [WORK] [AND [NO] CHAIN] [[NO] RELEASE]
    ROLLBACK [WORK] [AND [NO] CHAIN] [[NO] RELEASE]
    SET AUTOCOMMIT = {0 | 1}
    SAVEPOINT identifier
    ROLLBACK [WORK] TO SAVEPOINT identifier
    RELEASE SAVEPOINT identifier
    LOCK TABLES
        tbl_name [AS alias] {READ [LOCAL] | [LOW_PRIORITY] WRITE}
        [, tbl_name [AS alias] {READ [LOCAL] | [LOW_PRIORITY] WRITE}] ...
    UNLOCK TABLES
    SET [GLOBAL | SESSION] TRANSACTION ISOLATION LEVEL
    { READ UNCOMMITTED | READ COMMITTED | REPEATABLE READ | SERIALIZABLE }

    XA {START|BEGIN} xid [JOIN|RESUME]
    XA END xid [SUSPEND [FOR MIGRATE]]
    XA PREPARE xid
    XA COMMIT xid [ONE PHASE]
    XA ROLLBACK xid
    XA RECOVER

## 数据库管理
账户管理

    CREATE USER user [IDENTIFIED BY [PASSWORD] 'password']
        [, user [IDENTIFIED BY [PASSWORD] 'password']] ...
    DROP USER user [, user] ...
    GRANT priv_type [(column_list)] [, priv_type [(column_list)]] ...
        ON [object_type] {tbl_name | * | *.* | db_name.*}
        TO user [IDENTIFIED BY [PASSWORD] 'password']
            [, user [IDENTIFIED BY [PASSWORD] 'password']] ...
        [REQUIRE
            NONE |
            [{SSL| X509}]
            [CIPHER 'cipher' [AND]]
            [ISSUER 'issuer' [AND]]
            [SUBJECT 'subject']]
        [WITH with_option [with_option] ...]

        object_type =
            TABLE
          | FUNCTION
          | PROCEDURE

        with_option =
            GRANT OPTION
          | MAX_QUERIES_PER_HOUR count
          | MAX_UPDATES_PER_HOUR count
          | MAX_CONNECTIONS_PER_HOUR count
          | MAX_USER_CONNECTIONS count

        priv_type =
            ALL [PRIVILEGES]
          | ALTER
          | ALTER ROUTINE
          | CREATE
          | CREATE ROUTINE
          | CREATE TEMPORARY TABLES
          | CREATE USER
          | CREATE VIEW
          | DELETE
          | DROP
          | EXECUTE
          | FILE
          | INDEX
          | INSERT
          | LOCK TABLES
          | PROCESS
          | REFERENCES
          | RELOAD
          | REPLICATION CLIENT
          | REPLICATION SLAVE
          | SELECT
          | SHOW DATABASES
          | SHOW VIEW
          | SHUTDOWN
          | SUPER
          | UPDATE
          | USAGE
          | GRANT OPTION
    REVOKE priv_type [(column_list)] [, priv_type [(column_list)]] ...
        ON [object_type] {tbl_name | * | *.* | db_name.*}
        FROM user [, user] ...
    REVOKE ALL PRIVILEGES, GRANT OPTION FROM user [, user] ...
    RENAME USER old_user TO new_user
        [, old_user TO new_user] ...
    SET PASSWORD = PASSWORD('some password')
    SET PASSWORD FOR user = PASSWORD('some password')

表维护

    ANALYZE [LOCAL | NO_WRITE_TO_BINLOG] TABLE tbl_name [, tbl_name] ...
    BACKUP TABLE tbl_name [, tbl_name] ... TO '/path/to/backup/directory'
    CHECK TABLE tbl_name [, tbl_name] ... [option] ...
        option = {QUICK | FAST | MEDIUM | EXTENDED | CHANGED}
    CHECKSUM TABLE tbl_name [, tbl_name] ... [ QUICK | EXTENDED ]
    OPTIMIZE [LOCAL | NO_WRITE_TO_BINLOG] TABLE tbl_name [, tbl_name] ...
    REPAIR [LOCAL | NO_WRITE_TO_BINLOG] TABLE
        tbl_name [, tbl_name] ... [QUICK] [EXTENDED] [USE_FRM]
    RESTORE TABLE tbl_name [, tbl_name] ... FROM '/path/to/backup/directory'

SET

    SET variable_assignment [, variable_assignment] ...

    variable_assignment:
          user_var_name = expr
        | [GLOBAL | SESSION] system_var_name = expr
        | @@[global. | session.]system_var_name = expr

    user_var_name:
          AUTOCOMMIT = {0 | 1}
        | BIG_TABLES = {0 | 1}
        | CHARACTER SET {charset_name | DEFAULT}
        | FOREIGN_KEY_CHECKS = {0 | 1}
        | IDENTITY = value
        | INSERT_ID = value
        | LAST_INSERT_ID = value
        | NAMES {'charset_name' | DEFAULT}
        | ONE_SHOT
        | SQL_NOTES = {0 | 1}
        | SQL_AUTO_IS_NULL = {0 | 1}
        | SQL_BIG_SELECTS = {0 | 1}
        | SQL_BUFFER_RESULT = {0 | 1}
        | SQL_LOG_BIN = {0 | 1}
        | SQL_LOG_OFF = {0 | 1}
        | SQL_LOG_UPDATE = {0 | 1}
        | SQL_QUOTE_SHOW_CREATE = {0 | 1} | SQL_SAFE_UPDATES = {0 | 1}
        | SQL_SELECT_LIMIT = {value | DEFAULT}
        | SQL_WARNINGS = {0 | 1}
        | TIMESTAMP = {timestamp_value | DEFAULT}
        | UNIQUE_CHECKS = {0 | 1}

SHOW

    SHOW [FULL] COLUMNS FROM tbl_name [FROM db_name] [LIKE 'pattern']
    SHOW CHARACTER SET [LIKE 'pattern']
    SHOW COLLATION [LIKE 'pattern']
    SHOW CREATE DATABASE db_name
    SHOW CREATE TABLE tbl_name
    SHOW DATABASES [LIKE 'pattern']
    SHOW ENGINE engine_name {LOGS | STATUS }
    SHOW [STORAGE] ENGINES
    SHOW ERRORS [LIMIT [offset,] row_count]
    SHOW GRANTS FOR user
    SHOW INDEX FROM tbl_name [FROM db_name]
    SHOW PRIVILEGES
    SHOW [FULL] PROCESSLIST
    SHOW [GLOBAL | SESSION] STATUS [LIKE 'pattern']
    SHOW TABLE STATUS [FROM db_name] [LIKE 'pattern']
    SHOW [OPEN] TABLES [FROM db_name] [LIKE 'pattern']
    SHOW TRIGGERS
    SHOW [GLOBAL | SESSION] VARIABLES [LIKE 'pattern']
    SHOW WARNINGS [LIMIT [offset,] row_count]
    SHOW BINLOG EVENTS
    SHOW MASTER LOGS
    SHOW MASTER STATUS
    SHOW SLAVE HOSTS
    SHOW SLAVE STATUS

其他
    CACHE INDEX
      tbl_index_list [, tbl_index_list] ...
      IN key_cache_name

        tbl_index_list:
          tbl_name [[INDEX|KEY] (index_name[, index_name] ...)]
    LOAD INDEX INTO CACHE
      tbl_index_list [, tbl_index_list] ...

        tbl_index_list:
          tbl_name
            [[INDEX|KEY] (index_name[, index_name] ...)]
            [IGNORE LEAVES]
    FLUSH [LOCAL | NO_WRITE_TO_BINLOG] flush_option [, flush_option] ...

        flush_option:
          HOSTS
        | DES_KEY_FILE
        | LOGS
        | PRIVILEGES
        | QUERY CACHE
        | STATUS
        | {TABLE | TABLES} [tbl_name [, tbl_name] ...]
        | TABLES WITH READ LOCK
        | USER_RESOURCES
    KILL [CONNECTION | QUERY] thread_id
    RESET reset_option [, reset_option] ...

        reset_option:
          MASTER
        | QUERY CACHE
        | SLAVE

复制语句

    PURGE {MASTER | BINARY} LOGS TO 'log_name'
    PURGE {MASTER | BINARY} LOGS BEFORE 'date'
    CHANGE MASTER TO master_def [, master_def] ...

    master_def:
          MASTER_HOST = 'host_name'
        | MASTER_USER = 'user_name'
        | MASTER_PASSWORD = 'password'
        | MASTER_PORT = port_num
        | MASTER_CONNECT_RETRY = count
        | MASTER_LOG_FILE = 'master_log_name'
        | MASTER_LOG_POS = master_log_pos
        | RELAY_LOG_FILE = 'relay_log_name'
        | RELAY_LOG_POS = relay_log_pos
        | MASTER_SSL = {0|1}
        | MASTER_SSL_CA = 'ca_file_name'
        | MASTER_SSL_CAPATH = 'ca_directory_name'
        | MASTER_SSL_CERT = 'cert_file_name'
        | MASTER_SSL_KEY = 'key_file_name'
        | MASTER_SSL_CIPHER = 'cipher_list'

    LOAD DATA FROM MASTER
    LOAD TABLE tbl_name FROM MASTER
    SELECT MASTER_POS_WAIT('master_log_file', master_log_pos)
    START SLAVE [thread_type [, thread_type] ... ]
    START SLAVE [SQL_THREAD] UNTIL
        MASTER_LOG_FILE = 'log_name', MASTER_LOG_POS = log_pos
    START SLAVE [SQL_THREAD] UNTIL
        RELAY_LOG_FILE = 'log_name', RELAY_LOG_POS = log_pos

        thread_type: IO_THREAD | SQL_THREAD
    STOP SLAVE [thread_type [, thread_type] ... ]

预处理语句

    PREPARE stmt_name FROM preparable_stmt;
    EXECUTE stmt_name [USING @var_name [, @var_name] ...];
    {DEALLOCATE | DROP} PREPARE stmt_name;

# mysql 命令行

?         (\?) Synonym for `help'.
clear     (\c) Clear the current input statement.
connect   (\r) Reconnect to the server. Optional arguments are db and host.
delimiter (\d) Set statement delimiter.
edit      (\e) Edit command with $EDITOR.
ego       (\G) Send command to mysql server, display result vertically.
exit      (\q) Exit mysql. Same as quit.
go        (\g) Send command to mysql server.
help      (\h) Display this help.
nopager   (\n) Disable pager, print to stdout.
notee     (\t) Don't write into outfile.
pager     (\P) Set PAGER [to_pager]. Print the query results via PAGER.
print     (\p) Print current command.
prompt    (\R) Change your mysql prompt.
quit      (\q) Quit mysql.
rehash    (\#) Rebuild completion hash.
source    (\.) Execute an SQL script file. Takes a file name as an argument.
status    (\s) Get status information from the server.
system    (\!) Execute a system shell command.
tee       (\T) Set outfile [to_outfile]. Append everything into given outfile.
use       (\u) Use another database. Takes database name as argument.
charset   (\C) Switch to another charset. Might be needed for processing binlog with multi-byte charsets.
warnings  (\W) Show warnings after every statement.
nowarning (\w) Don't show warnings after every statement.

# 数据库管理

备份: SQL级别表备份
1. 参见 FLUSH
2. 参加 SELECT INTO ... OUTFILE
3. 参见 BACKUP TABLE          // 只能用于 myISAM 表(不推荐)

# 优化

有 WHERE 子句的话, 往往会先生成两个表行数乘积的行(笛卡尔积)的数据表然后才根据 WHERE 条件从中选择, 所以能用 ON 代替最好用 ON 代替 WHERE
使用 explain/慢日志工具分析
使用 limit, 避免 select *,
使用连接查询 (JOIN) 替代子查询 (SUBQUERY)
使用存储过程
使用联合 (UNION) 替代手动创建临时表
尽量少使用 LIKE 关键字和通配符
表定义中避免允许 NULL


# 经验

查找不为空的条件是 IS NOT NULL, 不要忘了 IS
SELECT a.col,b.col FROM table1 a, table1 b WHERE a.col=b.col 和 SELECT a.col,b.col FROM table1 a INNER JOIN table1 b ON a.col=b.co 是一回事, 都是 self-join 查询
IN() is not a valid condition, it must *NOT be empty*
`mysql` 有个 `--i-am-a-dummy` 选项, 会阻止你执行任何不带 where 条件的 update 和 delete

# Recipe

select multiple count:

    SELECT sum(type=1) as type1count,
            sum(type=2) as type2count,
            sum(type=3) as type3count
    FROM xushi_fhwrongbag
    GROUP BY account

renumbering an existing sequence

    # 1: drop the sequence column
    ALTER TABLE insect DROP id;
    # 2: add it back
    ALTER TABLE insect
        ADD id INT UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
        ADD PRIMARY KEY (id);

show full columns from <table_name>