#软件臭味

##闻起来

- 僵化性: 它比我想象的要复杂!
- 脆弱性: 谁知道还有这儿的事儿!
- 牢固性: 难以分离重用
- 粘滞性: 这是最快的方式!
    + 软件
    + 环境
- 不必要的复杂性: YAGNI!
- 不必要的重复: 看起来很像, 改起来费死劲 --> 忽略了抽象
- 晦涩性: 这是我写的? --> 站在阅读者角度

##原因

- 需求变更
- 设计缺陷

##应对

- 接受事实: 应对需求变更是我们的职责
- 抓住变更机会, 改进设计应对**此类**变更 --> 问题: 排期
- 改进设计: 设计原则: SOLID & 设计模式(later)
- 不要说稍后, 也不用预先设计, Just in time

#SOLID

- 名称

##SRP

- 就一个类而言, 仅有一个引起它变化的原因(即职责)
- 示例: Modem & 业务操作通过持久化动作来实现
    + 客户 A 必须要包含不必要的针对客户 B 的职责代码
    + 客户 B 改变 -> 服务类改变 -> 客户 A 也要被迫改变
- 相关: 测试驱动开发, FACADE, PROXY
- 问题: 如何识别职责并确定是否应该分开: 依赖于应用的变化方式

##OCP

- 软件实体(类, 模块, 函数等)应该是可以扩展的, 但是不可以修改的
- 目的: 在不腐败设计的情况下扩展行为(通过增加新代码, 而非改动现有代码)
- 反面示例: 新信审入口
    + 到处找 if/else: 参数校验, 银行卡支持性, 活跃性校验, 任务分配规则...
    + 有些甚至连 if/else 都没有
- 实现: **关键是抽象**
    + 抽象基类: closed for modification
    + 实现类: open for extension
    + 模式: 
        * STRATEGY(通过委托封装上下文敏感算法):@see:sandbox
        * TEMPLATE METHOD(通过继承):@see:newcar/usedcarCheckcontoller
        * 表驱动法:@see:credit/config/dict:capital
- 问题: 导致变化的原因不止一个维度, 如何选择应当对哪个维度封闭?
    + 如: 导致任务分配规则变化的可能不止入口, 还可能是四要素匹配了哪些规则等
    + 经验 -> 既要熟知设计, 又要熟知领域 -> 常失败
    + fool me once, shame on you; fool me twice, shame on me
    + -> 刺激变化
        * 测试
        * 短周期迭代开发
        * 及早开发特性
        * 频繁发布
        * ...


##LSP

- 子类型必须能够替换掉他们的基类型
- 目的: 创建正确的继承层次, 保证 OCP
- 示例: is-a 经典坑: Rectangle&Square
    + 浪费的成员变量(实例很多时会形成性能问题) -> 暂不考虑
    + 不合适的 Square 操作: 设置宽/高分开 -> 代码修复
    + 真: 自相容不代表和用户程序相容
    + 契约不再有效, 没有能被信任的服务
    + 导致 RTTI(也是违反 LSP 的明显症状), 必须单独考虑每个子类, 增加复杂性
    + 违反 OCP
- 实现
    + is-a 应该从行为方式角度看
    + 基于契约设计(DBC):前置后置:宽进严出|弱进强出
    + 单元测试      
    + 父子变兄弟 | 父子变子父
- 相关: OCP: 正是子类的可替换性, 才使得使用基类类型的客户无需修改即可被扩展

##DIP

- a.高层模块不应该依赖于低层模块， 二者都应该依赖于抽象; 
- b.抽象不应该依赖于细节, 细节应该依赖于抽象
- 关于 **倒置**: 传统/结构化 vs 良好/OO
- 目的: 
    + 低层改动不影响高层
    + 重用高层
- 实现: 可以应用于任何存在一个类向另一个类 *发送消息* 的地方
    + 依赖倒置
    + 接口所有权倒置, Don't call use, we'll call you
    + 依赖止于抽象 -> 过于绝对
        * 任何变量都不应该持有一个指向具体类的指针或者引用
        * 任何类都不应该从具体类派生
        * 任何方法都不应该覆写他的任何基类中的已经实现了的方法

> with the Hollywood principle, we allow low-level components to hook 
> themselves into a system, but the high-level components determines **when**
> they are needed and **how**, In other words, the high-level components give
> the low-level componenets a "dont call us, we'll call you" treatment

> 如果程序的依赖关系是倒置的, 它就是面向对象的设计
> 如果程序的依赖关系不是倒置的, 他就是过程化的设计

- 示例
    + Button/Lamp(依赖注入到类变量)
    + 框架设计(validator, directive, ...)
- 问题:
    + 是否意味着低层的重用性降低?
- 相关: 
    + DI(依赖注入): https://en.wikipedia.org/wiki/Dependency_injection
    + DI Container(依赖注入容器, @laravel:service container)
    + IoC(控制反转): https://en.wikipedia.org/wiki/Inversion_of_control

##ISP

- 不应该强迫客户依赖于他们不用的方法
- 违反恶果
    + 接口污染:因为一个子类加的接口强迫其他不需要的子类被污染 -> 胖接口
    + 违反 LSP
    + 客户反作用力: 变更的代价无法预测
- 目的: 分离必须在一起实现的接口
- 实现:
    + 使用委托(适配器) -> 性能问题
    + 多重继承 
- 示例: Timer&Door

#总结
- 关于需求变更
- 关于测试驱动
- 关于间接性(设计/性能):小到一行代码, 大到服务器架构
    + 抽象
    + 隔离变更

>计算机科学中的大多数问题都可以通过增加一层间接性来解决. -->
>大多数性能问题都可以通过去除一层间接性来解决

- 关于应用到实际工作
    + 理念和现状
    + 实践/规范/执行力
