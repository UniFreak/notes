# BAK
Granularity
    never store calculated data, you should be able to caculate it using current stored data
Naming
    underscore or camelCase are all fine, just be consistent
    singular or plural table name are all fine, just be consistent
    prefix or non-prefix table name are all fine, just be consistent
    PK can be simply id or somethingId, just be consistent(I chose simply id)
Normalizng
    1st Normal Form
        make sure there is primary key
        and don't have multiple value inside one column
    2nd Normal Form
        ???
    3rd Normal Form
        move transitive dependency into seperate table
        and associate it with original table using table key
Relationship
    foreign key benefits? integrity
    foreign key must be set on unique or primary key values

    one to many(foreign key)
    many to many(junction table & foreign key)
Workflow
    write down use case
    identify the nouns(sometime verbs)
    identify the relationships
    create the tables

# 命名
- 尽可能短
- 直观，尽可能正确和具有描述性
- 保持一致性
- 避免使用 SQL 和数据库引擎特定的关键字作为名字
- 建立命名约定

# 列长
- 一般而言，考虑到安全和性能，数据库中限制文本列的长度是好的，但有时这个做法可能没有必要或者不方便
- 不同的数据库对待文本限制可能会有差异
- 使用英语以外的语言时永远记住编码

# 索引
- 经常检查运行时间长的查询，或许可以用上EXPLAIN功能；大多数现代数据库都有该功能
- 在创建索引时：
    +　记住它们不会一直被用到；数据库如果计算出使用索引所耗费的时间长于全表扫描或其它操作时，将不会使用索引
    +　记住使用索引带来的代价是——在被索引的表上INSERT和DELETE会变慢
    +　如果需要索引请考虑非默认类型的索引；如果你的索引工作得不是很好，请查阅数据库手册
- 有时候你需要优化查询，而不是模型
- 不是每一个性能问题都可以通过创建一个索引来解决；有很多其它解决性能问题的方式
    + 各个应用层的缓存
    + 调优数据库参数和缓冲区大小
    + 调优数据库连接池大小或者线程池大小
    + 调整数据库事务隔离级别
    + 在夜间安排批量删除，避免不必要的锁表

# 应对大数据量
- 你的客户必须使用业务、领域特定的知识，预估预期你将处理的数据库中的数据量
- 分离频繁更新和频繁读取的数据
- 对重量级、更新少的数据考虑使用应用级别的缓存

# 时区
- 检查你的数据库中日期和时间数据类型的细节
- 用UTC的方式存储日期与时间
- 处理好时区问题需要数据库和应用代码直接的合作。确保你理解了数据库驱动的细节

# 审计跟踪
- 考虑哪个数据重要到需要跟踪修改/版本化
- 考虑风险和成本之间的平衡；记住帕雷托定律指出大约80%的影响来自20%的原因；不要在不太可能的事故场景中保护你的数据，关注那些可能发生的场景
- 数据库中的表可以有创建和更新时间戳，及所创建/修改行的用户标示。 完整的审计日志可以用触发器或者其它对正在使用的数据库管理系统有效的机制来实现。一些审计日志可以存储在单独的数据库以确保无法修改和删除
- 数据能够防止数据丢失，通过：
    + 不删除它，而是打上一个被删除的标记
    + 版本化修改

# 排序
- 在单一语言的应用中，初始化数据库总是要用合适的区域设置，
在多语言应用中，用默认的区域设置初始化数据库，在每一个需要排序的地方决定在SQL查询中该使用哪种排序规则
- 也许你应当使用针对当前用户的排序规则
- 有时你可能希望使用特定于被浏览数据的语言
- 如果可以，应用排序规则到列和表

