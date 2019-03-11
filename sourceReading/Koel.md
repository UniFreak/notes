# info
- laravel version: 5.4
- controller 中直接调用 Model, 使用关联关系
- 把 Trait 放到 app\trait\ 下
- usage of SPL

# interest
- what does `koel:init` do?
- what does `php artisan serve` do?
- `cache()` is laravel's or koel's? how to use?
- idea: use request like in `Http\Requests`
- how to config routes to use `\Routes` folder?
- JWTauth?
- 如何使用 service provider 的
- 理解其 route 设置, 如何把 restful 和 controller 结合起来的

# question
- 如何找到对应的渲染视图的? 如主页
- app\service 和 app\provider 什么区别和联系?

# learned
- symfony/finder
    + 配置使用位运算符+类常量
    + fluent api
    + 先使用各种方法设置规则
    + 最后使用 in() 方法, 匹配满足规则的文件
    + 应用场景: 信审路由?
- 把领域类也放到 Model 下, 如 File
- 数据表定义的主键名不一定要是 ID, 如 settings 表的 key
- 主键也不一定要是 integer, 如 songs 表的 id 是哈希值

# coodie
- `$client = $client ?: new Client();`
