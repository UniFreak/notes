# concept
- don't support JOINS
- don't support transaction
- store JSON documents
- schemaless

- default storage path: /data/db
- `mongo` is a V8 JS enviroment, you can run any jS code that v8 can run in it

# usage

## install

## start server
- `mongod`

## connect

- `mongodb://[username:password@]host1[:port1][,host2[:port2],...[,hostN[:portN]]][/[database][?options]]`
- 可用 options
    + replicaSet=name
    + slaveOk=true
    + safe=true
    + w=n
    + wtimeoutMS=ms
    + fsync=true
    + journal=true
    + connectTimeoutMS=ms
    + socketTimeoutMS=ms

# DB manipulation
- `use <dbname>`: 创建/使用 
- `db`: 查询当前
- `show dbs`: 查看所有
- `db.dropDatabase()`: 删除

# Collection manipulation
- `db.<colname>.insert(<doc>)`: 插入 
- `db.<colname>.save(<doc>)`: 插入 
- `db.<colname>.find()`: 查找 
- `db.<colname>.update(<query>, <update>, {<options>})`: 查找
    + `upsert`: 是否不存在就插入
    + `multi`: 是否更新所有查得级别
    + `writeConcern`: 异常级别 
- `db.<colname>.remove(<query>, {<options>})`: 删除 
    + `justOne`: 是否只限制一个
    + `writeConcern`
- `db.<colname>.drop()`: 删除

# Aggregate

## Aggregate()

- `db.<colname>.aggregate(<aggregateOpration>)`
- 如: 
    ```
    db.mycol.aggregate([{$group : {_id : "$by_user", num_tutorial : {$sum : 1}}}])
    ```
- 常用操作: 可指定多个操作, 做类似管道的处理
    + `$project`: 修改输入文档的结构。可以用来重命名、增加或删除域，也可以用于创建计算结果以及嵌套文档 
    + `$match`: 用于过滤数据，只输出符合条件的文档 $match使用MongoDB的标准查询操作 
    + `$limit`: 用来限制MongoDB聚合管道返回的文档数 
    + `$skip`: 在聚合管道中跳过指定数量的文档，并返回余下的文档 
    + `$unwind`: 将文档中的某一个数组类型字段拆分成多条，每条包含数组中的一个值 
    + `$group`: 将集合中的文档分组，可用于统计结果 
    + `$sort`: 将输入文档排序后输出 
    + `$geoNear`: 输出接近某一地理位置的有序文档 
- 常用表达式
    + `$sum`:  计算总和
    + `$avg`:  计算平均值
    + `$min`:  获取集合中所有文档对应值得最小值
    + `$max`:  获取集合中所有文档对应值得最大值
    + `$push`: 在结果文档中插入值到一个数组中
    + `$addToSet`: 在结果文档中插入值到一个数组中，但不创建副本
    + `$first`:根据资源文档的排序获取第一个文档数据
    + `$last`: 根据资源文档的排序获取最后一个文档数据

## mapReduce()
- 基本语法:
    ```
    db.<colname>.mapReduce(
       function() {emit(key,value);},  //map 函数
       function(key,values) {return reduceFunction},   //reduce 函数
       {
          out: collection,
          query: document,
          sort: document,
          limit: number
       }
    )
    ```

# index
- `db.<colname>.ensureIndex({<key>:1}, <options>)`: 创建
- 可用 options
    + `background`: 以后台方式
    + `unique`: 是否唯一
    + `name`:  名称
    + `dropDups`: 是否删除重复记录
    + `sparse`: 对文档中不存在的字段数据不启用索引
    + `expireAfterSeconds`: 集合的生存时间。
    + `v`: 版本号
    + `weights`: 权重值
    + `default_language`: 决定文本索引停用词及词干和词器的规则
    + `language_override`:  指定文本索引包含在文档中的字段名

# shards
# replicas
# security
# storage