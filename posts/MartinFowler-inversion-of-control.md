InversionOfControl
26 June 2005

Inversion of Control is a common phenomenon that you come across when extending frameworks. Indeed it's often seen as a defining characteristic of a framework.
在使用框架的时候, 经常会遇到 '控制倒转', 它也的确是框架的一个典型特征.


Let's consider a simple example. Imagine I'm writing a program to get some information from a user and I'm using a command line enquiry. I might do it something like this
举个简单的例子, 假如我正在写一个命令行程序, 用于获取用户信息. 我可能会这样做:

  #ruby
  puts 'What is your name?'
  name = gets
  process_name(name)
  puts 'What is your quest?'
  quest = gets
  process_quest(quest)

In this interaction, my code is in control: it decides when to ask questions, when to read responses, and when to process those results.
在这样的交互中, 我的代码处于控制地位: 它决定什么时候询问用户, 什么时候读取用户响应, 什么时候去处理响应.

However if I were were to use a windowing system to do something like this, I would do it by configuring a window.
但是, 如果是在图形界面中做同样的事情的话, 我会配置一个视窗:

  require 'tk'
  root = TkRoot.new()
  name_label = TkLabel.new() {text "What is Your Name?"}
  name_label.pack
  name = TkEntry.new(root).pack
  name.bind("FocusOut") {process_name(name)}
  quest_label = TkLabel.new() {text "What is Your Quest?"}
  quest_label.pack
  quest = TkEntry.new(root).pack
  quest.bind("FocusOut") {process_quest(quest)}
  Tk.mainloop()

There's a big difference now in the flow of control between these programs - in particular the control of when the process_name and process_quest methods are called. In the command line form I control when these methods are called, but in the window example I don't. Instead I hand control over to the windowing system (with the Tk.mainloop command). It then decides when to call my methods, based on the bindings I made when creating the form. The control is inverted - it calls me rather me calling the framework. This phenomenon is Inversion of Control (also known as the Hollywood Principle - "Don't call us, we'll call you").
可以发现这两种方式有一个重要的区别: 它们的控制流不同 - 尤其是对 `process_name` 和 `process_quest` 这两个方法在何时被调用的控制上. 在命令行的程序里, 我自己控制这些方法合适被调用, 但是在图形界面中则不是这样. 我把控制权交给了视窗系统(Tk.mainloop 命令). 然后它根据我创建表单时的绑定关系来决定合适调用我的方法. 控制权被倒转了 - 框架来调用我而不是我去调用框架了. 这个现象就是 '控制倒转' (也被称为 '好莱坞法则' - '不要打电话(调用)给我们, 我们会给你打').


>>One important characteristic of a framework is that the methods defined by the user to tailor the framework will often be called from within the framework itself, rather than from the user's application code. The framework often plays the role of the main program in coordinating and sequencing application activity. This inversion of control gives frameworks the power to serve as extensible skeletons. The methods supplied by the user tailor the generic algorithms defined in the framework for a particular application.
>>对于框架来说, 一个重要的特性就是, 扩展框架的用户代码经常被框架自身在内部调用, 而非用户应用代码. 框架经常扮演着协调并同步应用活动的主程序. '控制倒转' 让框架有能力作为一个可扩展的骨架提供服务, 而用户则通过自己写的方法去修改和定制框架已有的功能.

-- Ralph Johnson and Brian Foote

Inversion of Control is a key part of what makes a framework different to a library. A library is essentially a set of functions that you can call, these days usually organized into classes. Each call does some work and returns control to the client.
'控制倒转' 是区分框架和库的关键所在. 一个库基本上就是你可以调用的一系列方法(一般被组织进类里面). 每个方法在被调用时做一些事情然后把控制权移交给客户代码.

A framework embodies some abstract design, with more behavior built in. In 
order to use it you need to insert your behavior into various places in the framework either by subclassing or by plugging in your own classes. The framework's code then calls your code at these points.
而框架则包含了更多的抽象设计, 有更多的内置行为. 使用框架, 你得通过子类继承或者插入自己的类, 以把你想要的行为放到框架中的各个地方, 然后框架负责适时调用你的代码.

There are various ways you can plug your code in to be called. In the ruby example above, we invoke a bind method on the text entry field that passes an event name and a Lambda as an argument. Whenever the text entry box detects the event, it calls the code in the closure. Using closures like this is very convenient, but many languages don't support them.
有很多方式可以插入你自己的代码. 在上面的 Ruby 示例中, 我们使用 text entry field 的 bind 方法, 给其传入一个事件名称和一个匿名函数. 每当 text entry box 检测到该事件时, 就会调用匿名函数中的代码. 像这样使用匿名函数很方便, 但可以很多语言都不支持这种方式.

Another way to do this is to have the framework define events and have the client code subscribe to these events. .NET is a good example of a platform that has language features to allow people to declare events on widgets. You can then bind a method to the event by using a delegate.
另一种方式是, 由框架定义事件, 并让客户端代码订阅这些事件. .NET 是该方式的一个很好的例子, 它允许我们在 widgets 上声明事件, 然后我们便可以通过委托来绑定一个方法到某个事件.

The above approaches (they are really the same) work well for single cases, but sometimes you want to combine several required method calls in a single unit of extension. In this case the framework can define an interface that a client code must implement for the relevant calls.
上面两种方式(实际上两个并无实质区别)对于特定案例来说能很好的工作, 但有时候, 你希望能在单个扩展中组合调用多个方法. 对于这种情况, 框架可以为这些相关调用定义一个接口, 让客户端代码去实现.

EJBs are a good example of this style of inversion of control. When you develop a session bean, you can implement various methods that are called by the EJB container at various lifecyle points. For example the Session Bean interface defines ejbRemove, ejbPassivate (stored to secondary storage), and ejbActivate (restored from passive state). You don't get to control when these methods are called, just what they do. The container calls us, we don't call it.
EJB 即是如此. 你在开发一个 session bean 的时候, 可以实现很多方法让 EJB 容器在各个生命周期点调用. 比如, Session Bean 接口定义了 ejbRemove, ejbPassivate(存储到二级存储), 和 ejbActivate(从钝态恢复). 你只能控制他们做什么, 但无法控制何时去做. 容器调用我们, 而非反之.

These are complicated cases of inversion of control, but you run into this effect in much simpler situations. A template method is a good example: the super-class defines the flow of control, subclasses extend this overriding methods or implementing abstract methods to do the extension. So in JUnit, the framework code calls setUp and tearDown methods for you to create and clean up your text fixture. It does the calling, your code reacts - so again control is inverted.
上述都是比较复杂的 '控制倒转' 情景, 但是你也可能在更简单的情境中遇到 '控制倒转'. 模板方法即为一例: 超类定义控制流, 子类通过覆写或实现抽象方法来扩展超类. 比如在 JUnit 中, 框架去调用 setUp 和 tearDown 方法, 为你创建或者清理文本夹具. 框架去调用, 你的代码去响应 - 控制再次被倒转了.

There is some confusion these days over the meaning of inversion of control due to the rise of IoC containers; some people confuse the general principle here with the specific styles of inversion of control (such as dependency injection) that these containers use. The name is somewhat confusing (and ironic) since IoC containers are generally regarded as a competitor to EJB, yet EJB uses inversion of control just as much (if not more).
随着 IoC 容器的兴起, 现在出现了很多对 '控制倒转' 的误解: 有些人把这里所讲的一般原则和某种容器的特殊实现(如依赖注入)相混淆. 名字本身也有些混淆视听(和令人啼笑皆非), 因为 IoC 一般被当做 EJB 的竞争对手, 然而 EJB 本身实际上也用了很多(或更多) '控制倒转'.

Etymology: As far as I can tell, the term Inversion of Control first came to light in Johnson and Foote's paper Designing Reusable Classes, published by the Journal of Object-Oriented Programming in 1988. The paper is one of those that's aged well - it's well worth a read now over fifteen years later. They think they got the term from somewhere else, but can't remember what. The term then insinuated itself into the object-oriented community and appears in the Gang of Four book. The more colorful synonym 'Hollywood Principle' seems to originate in a paper by Richard Sweet on Mesa in 1983. In a list of design goals he writes: "Don't call us, we'll call you (Hollywood's Law): A tool should arrange for Tajo to notify it when the user wishes to communicate some event to the tool, rather than adopt an 'ask the user for a command and execute it' model." John Vlissides wrote a column for C++ report that provides a good explanation of the concept under the 'Hollywood Principle' moniker. (Thanks to Brian Foote and Ralph Johnson for helping me with the Etymology.)
语源: 我能记起最早的 '控制倒转' 的出处是 Johnson 和 Foote 在 1988 年出版于 <<The Journal of Object-Oriented Programming>> 的一篇论文. 它正是那种历久弥新的论文之一 - 即使十五年之后的今天也值得一读. 他们觉得自己是从别的地方借用了这个名词(但是忘了具体哪里了). 之后 '控制倒转' 便潜入面向对象社区, 出现在 GoF 的书中. 至于更有趣的 '好莱坞法则' 则貌似发源于 Richard Sweet 在 1983 年发表于 Mesa 杂志的一篇文章. 在某个设计目标列表中他写道: "不要打电话给我们, 我们会给你打 (好莱坞法则): 如果用户想要针对某个事件和工具进行交流, Tajo 会去通知工具, 工具只要做好准备就行. 而非去实现一种类似 '询问用户意图然后执行' 的模型." John Vlissider 也在为 C++ 写的一篇报道中很好的解释了 '好莱坞法则' 背后的概念. (感谢 Brian Foote 和 Ralph Johnson 为此词源提供的帮助.)