JScript and Javascript is identical
when not to use javascript: when any other technology could be used instead
always use semicolon at the end of statement
always put script in seperated file, and load it just before </body> tag
JSON string's key must be quoted with "

Use 'feature detect' rather than browser sniffing


数据类型
    弱类型,但是使用变量时，好的编码习惯是始终存放相同类型的值
    String Number Boolean Array Object Undefined Null
    用关键字"new"声明变量类型
    用 typeof 检查数据类型
        typeof myFunction;      // "function"
        typeof myObject;        // "object"
        typeof myArray;         // "object" -- Careful!
        typeof myString;        // "string"
        typeof myNumber;        // "number"
        typeof null;            // "object" -- Careful!
        typeof undefined;       // "undefined"
        typeof meh;             // "undefined" -- undefined variable.
        typeof myRegExp;        // "function" or "object" depending on environment.
    基本类型:大小固定, 值保存在栈内存, 按值访问
        Undefined   Null    Boolean     Number  String
    引用类型:大小不固定, 值保存在堆内存, 地址保存在栈内存, 按引用访问
        Object  Array   Date    RegExp  Function
    基本包装类型:自动创建的引用类型, 只存在于一行代码的执行瞬间, 不能在运行时添加属性或方法
        Boolean Number  String
    内置对象:不依赖宿主, 不必显式实例化(已自动实例化了)
        Global  Math
    转换
        成字符串:toStirng()
            //Number 类型的toString()方法比较特殊,它有两种模式,即默认模式和基模式
            [1, 2, 3].toString() 结果为 "1, 2, 3"
        成数字:parseInt() parseFloat()
            //如果字符串的第一个字符不能被转换为数字则返回NaN
        强制转换:Boolean()或`!!`     Number()或`/1`   String()或`+""`
    真假表
        False:
            false
            ""          // An empty string.
            NaN         // JavaScript's "not-a-number" variable.
            null
            undefined   // Be careful -- undefined can be redefined!
            0           // The number zero.
        True:
            // Everything else evaluates to true, some examples:
            "0"
            "any string"
            []          // An empty array.
            {}          // An empty object.
            1           // Any non-zero number.
变量
    变量名能以字母, $和_(不推荐)开头
    用"var"关键字声明变量,虽然可以不用声明就直接使用变量(自动创建为全局变量),但是不推荐这么做
    用逗号(,)分隔一条声明语句中的多个变量
    如果重新声明 JavaScript 变量，该变量的值不会丢失
    JavaScript 变量均为对象. 当声明一个变量时，就创建了一个新的对象
    变量可以存在两种类型的值，即原始值和引用值
        原始值(原始类型):存储在栈（stack）中的简单数据段，也就是说，它们的值直接存储在变量访问的位置.
        引用值(引用类型):存储在堆（heap）中的对象，也就是说，存储在变量处的值是一个指针（point），指向存储对象的内存处.引用类型通常叫做类(class)也就是说,遇到引用值,所处理的就是对象
运算符
    算术  (+, -, *, /, %, ++, --, unary - , unary +)
            //+:如果只有一个运算数是字符串,把另一个运算数转换成字符串
    赋值  (=, *=, /=, %=, +=, -=, <<=, >>=, >>>=, &=, ^=, |=)
    位    (&, |, ^, ~, <<, >>, >>>)
    比较  (==, !=, ===, !==, >, >=, <, <=)
            //含NaN的关系运算符都要返回false,NaN不等于NaN
    逻辑  (&&, ||, !)   //使用&&和||运算符时,必须记住它们的简便计算特性
    字符串(+, +=)
    成员  (object.property, object['property'])    //用于访问对象属性
    条件  (condition ? ifTrue : ifFalse)
    逗号  (,)
操作符
    + , -           //正号负号, 对字符串取正或负将会把字符串转换为数字
    delete          //删除对以前*开发者*定义的对象属性或方法的引用
    function
    get
    in              //判断是否能通过对象访问某属性(无论是在实例中还是在原型中):'name' in Person1
    typeof
    instanceof
        //instanceof运算符与typeof运算符相似,用于识别正在处理的对象的类型.与 typeof方法不同的是,instanceof方法要求开发者明确地确认对象为某特定类型
    let
    new
    set
    this        //用在对象的方法中,关键字this总是指向调用该方法的对象
                //使用this,即可在不同对象实例里重用同一个函数
    void        //对任何值返回undefined,通常用于避免输出不应该输出的值
    yield
注释
    //
    /* */
语句
    分支
        if
        if ... else
        if ... else if ... else
        switch
    循环
        for(){ }
        for( in ) { } // 遍历数组或对象
        while() { }
        do{ }while();
        break:跳出循环
        continue:中断循环
            //break 和 continue 语句仅仅是能够跳出代码块的语句,continue 语句(带有或不带标签引用)只能用在循环中.break 语句(不带标签引用),只能用在循环或 switch 中
        <labelname>:标签
            //通过标签引用,break 语句可用于跳出任何 JavaScript 代码块.与break和continue联合使用的有标签语句非常强大,不过过度使用它们会给调试代码带来麻烦
        with (<对象>) {语句}
            // 为一个或一组语句指定默认对象
            // with 语句是运行缓慢的代码块,最好避免使用它
错误处理
    throw   创建自定义错误
    try     测试代码块的错误
    catch   处理错误
    finally 无论是否有异常抛出, finally语句都会执行
执行上下文
    全局上下文
    进入函数时有对应的函数上下文:
    运行 eval() 时, 除了 eval 上下文, 还会有一个额外的调用上下文

    一个上下文可以激活另一个上下文(比如函数 A 调用函数 B), 他们分别被称为 caller 和 callee. 这种实现方式是栈, 我们可以称之为上下文堆栈
    可以把执行上下文抽象为一个对象, 其中的属性(上下文状态)用来追踪关联代码的执行进度, 包括
        变量对象(VO), 用于存储被定义在上下文中的变量, 函数声明(注意, 函数表达式不在其中)
            在全局上下文中, 变量对象也是全局对象自身
            在函数上下文中, 变量对象被表示为活动对象(AO), 还额外包含 arguments 对象和形参
                arguments.length
                arguments.callee
                arguments[0]
        作用域链, 一个对象列表, 用以检索上下文代码中出现的标识符(变量, 函数, 参数名称)
            一个作用域链通常包括父级变量对象, 函数自身变量对象和活动对象
            with 和 catch 语句会在执行期间动态加入其他对象到作用域链(如 with对象)
            作用域链 = 活动对象 + [[Scope]]
            [[Scope]] 在函数*创建*时存储保存其父函数的作用域链 -- 即 JS 使用静态作用域, 该函数在未来被调用时就是在这个[[Scope]]中查询标志符. 理解这个对于理解闭包至关重要
        this
            this 是执行上下文环境的一个属性, 而不是某个变量对象的属性, 这意味着
            this 不需要一个类似搜寻变量的过程
            this 是进入上下文时确定, 在一个函数代码中, 这个值在每一次完全不同
            this 不是变量, 不能被赋值, 所以在运行代码时是不变的

            在一个函数上下文中, this由调用者提供, 由调用函数的方式来决定
            错误言论: this 值取决于函数如何定义, 如果它是全局函数, this设置为全局对象, 如果函数是一个对象的方法, this将总是指向这个对象

    执行上下文的处理过程
        进入执行上下文
            函数的所有形参(如果我们是在函数执行上下文中)
                由名称和对应值组成的一个变量对象的属性被创建；没有传递对应参数的话，那么由名称和undefined值组成的一种变量对象的属性也将被创建。
            所有函数声明(FunctionDeclaration, FD)
                由名称和对应值（函数对象(function-object)）组成一个变量对象的属性被创建; 如果变量对象已经存在相同名称的属性, 则完全替换这个属性
            所有变量声明(var, VariableDeclaration)
                由名称和对应值（undefined）组成一个变量对象的属性被创建; 如果变量名称跟已经声明的形式参数或函数相同, 则变量声明不会干扰已经存在的这类属性
        代码执行
            为 undefined 赋相应值

    当前 ECMAScript 规范指出独立作用域只能通过 "函数(function)" 代码类型的执行上下文创建. 也就是说, 相对于C/C++来说, ECMAScript 里的 for 循环并不能创建一个局部的上下文
函数
    有三种方式声明函数
        函数声明(FD)
            有一个特定的名称
            在源码中的位置: 要么处于程序级, 要么处于其它函数的主体中(不要把 FD 放到条件表达式里)
            在进入上下文阶段创建(声明可以放在调用之后)
            影响变量对象
            以下面的方式声明
                function funName() {}

            不要把函数声明放到条件语句里
        函数表达式(FE)
            在源码中须*出现在表达式*的位置(如赋值, 分组, 一元..., 参考下面的 IIFE)
            有可选的名称(有的话即为命名函数表达式(NFE))
            不会影响变量对象(不能通过命名函数表达式的名称在函数声明之前调用它, 也不能在声明之后调用它)
            在代码执行阶段创建(以 var a = function(){} 形式进行的声明必须在调用之前)

            命名函数表达式的名字, 只在新定义的函数作用域内有效(多用于方便调试)
        函数构造器
            new Function();

    IIFE:Immediately-Invoked Function Expression (
        (function() {})();
        (function() {}());
        !function() {}()
        new function() {}   // or
        new function() {}() // need parens if passing arguments

    keep function short, and generic, and fail gracefully(means do error checking)
    函数实际上是功能完整的对象,函数名只是指向函数对象的引用值,行为就像其他对象一样.甚至可以使两个变量指向同一个函数,或把函数作为参数传递给另一个函数
    函数内部声明的变量(使用var)是局部变量,只能在函数内部访问它
    在函数外声明的变量是全局变量，网页上的所有脚本和函数都能访问它
    如果你在一个函数内定义的变量没有用 var 声明, 这个变量会自动变成全局变量

    函数总会返回一个值, 如果没有指定, 则返回 undefined
    如果函数以在前面加上 new 前缀的形式来调用, 且返回值不是一个对象, 则返回 this(该新对象)
    如果声明了两个函数名相同的函数, 后一个函数就会覆盖前一个函数
    Function 的 .length 保存传递给的参数数量, .valueOf() 和 .toString() 返回源代码

    作用域链本质上是一个指向变量对象的指针列表, 它只 引用但不实际包含变量对象
    执行环境
    变量对象
    活动对象

    闭包
        定义
            闭包是指有权访问另一个函数作用域中的变量的函数. 创建闭包的常见方式, 就是在一个函数内部创建另一个函数

        经典问题(最后值)
        this
        IE9- 内存泄露问题

        闭包比其他函数会占用更多的内存(因为其包含对父函数活动对象的引用, 导致父函数活动对象即使在父函数执行完毕后仍不被回收)

    块级作用域(私有作用域)

    私有成员, 私有变量
    特权方法
    静态私有变量
    模块模式
    增强的模块模式
对象
    JavaScript 中的所有事物都是对象, 拥有属性和方法
    对象只是带有属性和方法的特殊数据类型,方法只不过是附加在对象上的函数
    JavaScript基于prototype,而不是基于类的
    即使类并不真正存在,我们也把对象定义叫做类,,从功能上说,两者是等价的
    面向对象语言需要向开发者提供四种基本能力:封装,聚集,继承,多态
    不能访问对象的物理表示,只能访问对象的引用,每次创建对象，存储在变量中的都是该对象的引用，而不是对象本身
    每用完一个对象后,就将其废除,来释放内存,这是个好习惯,废除对象
        对象名 = null;
    如果一个对象有两个或更多引用,则要正确废除该对象,必须将其所有引用都设置为null
    所谓绑定(binding),即把对象的接口与对象实例结合在一起的方法,ECMAScript中的所有变量都采用晚绑定
    分类
        本地对象:
            Object Function Array String Boolean Number Date RegExp Error EvalError RangeError ReferenceError SyntaxError TypeError URIError
        内置对象(每个内置对象都是本地对象)
            Global Math
        宿主对象(所有BOM和DOM对象都是宿主对象)
    作用域(变量与函数的可访问范围)
        公用作用域        对象属性可以从对象外部访问
        私有作用域        对象属性只能在对象内部访问
        受保护作用域      私有,但能被其子类访问
        ECMAScript没有静态作用域,只存在一种作用域 - 公用作用域
    既可以用 . 来引用属性或方法, 如 Car.color, 亦可以用 [] 来引用, 如 Car['displayInfo'](). 后者在当不知道具体要使用哪个属性或方法时有用
    构造函数, 原型和实例
        每个构造函数都有一个原型对象(.prototype)
        原型对象都包含一个指向构造函数的指针(.constructor)
        而实例都包含一个指向原型对象的内部指针(.__proto__)

        如果一个对象的 prototype 没有显示的声明过或定义过, 那么 __proto__ 的指向 object.prototype, 而object.prototype 也会有一个 __proto__, 这个就是原型链的终点了, 被设置为null
        除了创建对象, 构造函数还会自动为创建的新对象设置了 __proto__（指向构造函数的　.prototype）
    原型链
        假如我们让原型对象等于另一个类型的实例, 此时原型对象将包含一个指向另一个原型的指针
        相应的, 另一个原型中也包含着一个指向另一个构造函数的指针
        假如另一个原型又是另一个类型的实例, 如此层层递进, 就构成了实例与原型的链条, 即所谓原型链
    原型搜索机制
        实例 -> 原型 -> 上一原型 -> 上上一原型 -> ... -> Object原型
    使用 .hasOwnProperty() 来判断某个属性或方法是直接隶属于某个对象的实例(true)还是这个对象的原型(false)
    通过联合使用 .hasOwnProperty() 和 in 操作符, 可以断定某属性到底存在于实例中还是原型中

    对象或类的创建
        1.原始方式
            var oCar = new Object;
                oCar.color = "blue";
                oCar.doors = 4;
                oCar.mpg = 25;
                oCar.showColor = function() {
                    alert(this.color);
            };
        =>需要创建多个car的实例?
        2.工厂方式
            function createCar() {
                //原始方式代码包含进createCar函数
                var oTempCar = new Object;
                oTempCar.color = "blue";
                oTempCar.doors = 4;
                oTempCar.mpg = 25;
                oTempCar.showColor = function() {
                        alert(this.color);
                };
                return oTempCar;      //返回对象作为函数值
            }
            var oCar1 = createCar();
            var oCar2 = createCar();
            =>需要实例具有不同属性?
            为函数传递参数
            function createCar(sColor,iDoors,iMpg) {
                var oTempCar = new Object;
                oTempCar.color = sColor;
                oTempCar.doors = iDoors;
                oTempCar.mpg = iMpg;
                oTempCar.showColor = function() {
                    alert(this.color);
                };
                return oTempCar;
            }
            var oCar1 = createCar("red",4,23);
            var oCar2 = createCar("blue",3,25);
            oCar1.showColor();
            oCar2.showColor();
            =>不想每次实例化对象都要创建一次方法showColor()?
            工厂函数外定义对象的方法
            function showColor() {
                alert(this.color);
            }
            function createCar(sColor,iDoors,iMpg) {
                var oTempCar = new Object;
                oTempCar.color = sColor;
                oTempCar.doors = iDoors;
                oTempCar.mpg = iMpg;
                oTempCar.showColor = showColor;
                return oTempCar;
            }
            var oCar1 = createCar("red",4,23);
            var oCar2 = createCar("blue",3,25);
            oCar1.showColor();
            oCar2.showColor();
        =>看上去不像用new操作符实例化对象那样规范?
        3.自定义构造函数方式(内部不创建返回对象, 使用 this 关键字, 可以使用 new 关键字实例化)
            function Car(sColor,iDoors,iMpg) {
                //使用new运算符构造函数时,在执行第一行代码前先创建一个对象,只有用this才能访问该对象
                this.color = sColor;
                this.doors = iDoors;
                this.mpg = iMpg;
                this.showColor = function() {
                    alert(this.color);
                };
            }
            var oCar1 = new Car("red",4,23);
            var oCar2 = new Car("blue",3,25);
        =>依然存在重复创建showColor()方法的问题?
        4.原型方式
            //首先定义构造函数(Car),其中无任何代码
            function Car() {
            }
            //给Car的prototype属性添加属性去定义Car对象的属性
            Car.prototype.color = "blue";
            Car.prototype.doors = 4;
            Car.prototype.mpg = 25;
            Car.prototype.showColor = function() {
                 alert(this.color);
            };
            var oCar1 = new Car();
            var oCar2 = new Car();
            //还能用instanceof运算符检查给定变量指向的对象的类型
            alert(oCar1 instanceof Car);    //输出 "true"
            =>太多的 .prototype?
            function Car() {
            }
            Car.prototype {
                color: "blue",
                door: 4,
                mpg: 25,
                showColor = function() {
                    alert(this.color);
                }
            }
            var oCar1 = new Car();
            var oCar2 = new Car();
            =>prototype 的 constructor 属性不再指向 Car, 而是 Object 了?
            function Car() {
            }
            Car.prototype {
                constructor: Car,
                color: "blue",
                door: 4,
                mpg: 25,
                driver = ['Mike', 'Jack'],
                showColor = function() {
                    alert(this.color);
                }
            }
            var oCar1 = new Car();
            var oCar2 = new Car();
        =>  a.不能通过给构造函数传递参数来初始化属性的值?
            b.原型属性指向的是引用类型值(Array, Object...)时, 此属性会被所有实例共享(添加新 driver 会改变所有实例)
        5.构造&原型混合方式
            //用构造函数定义对象的所有非函数属性,解决a.
            function Car(sColor,iDoors,iMpg) {
                this.color = sColor;
                this.doors = iDoors;
                this.mpg = iMpg;
                this.drivers = new Array("Mike","John");
            }
            //用原型方式定义对象的函数属性(方法),解决b.
            Car.prototype.showColor = function() {
                alert(this.color);
            };
            var oCar1 = new Car("red",4,23);
            var oCar2 = new Car("blue",3,25);
            oCar1.drivers.push("Bill");
            alert(oCar1.drivers);   //输出 "Mike,John,Bill"
            alert(oCar2.drivers);   //输出 "Mike,John"
        =>形式上不够封装(属性和方法定义在不同的代码块中)?
        6.动态原型方式
            //与混合方式唯一的区别是赋予对象方法的位置
            function Car(sColor,iDoors,iMpg) {
                this.color = sColor;
                this.doors = iDoors;
                this.mpg = iMpg;
                this.drivers = new Array("Mike","John");

                if (typeof Car._initialized == "undefined") {
                    Car.prototype.showColor = function() {
                        alert(this.color);
                    };
                    Car._initialized = true;
                }
            }
        =>变通方式
        7.混合工厂方式(避免使用)
            //起来与工厂函数非常相似,但使用new运算符，使它看起来像真正的构造函数
            function Car() {
              var oTempCar = new Object;
              oTempCar.color = "blue";
              oTempCar.doors = 4;
              oTempCar.mpg = 25;
              oTempCar.showColor = function() {
                alert(this.color);
              };
              return oTempCar;
            }
        =>不能通过 instanceof 操作符来确定对象类型
    继承机制
        实现继承机制可以从要继承的基类入手.所有开发者定义的类都可作为基类.出于安全原因,本地类和宿主类不能作为基类
        你可能想创建一个不能直接使用的基类,它只是用于给子类提供通用的函数.在这种情况下,基类被看作抽象类
        原型链方法
            function ClassA() {
            }

            ClassA.prototype.color = "blue";
            ClassA.prototype.sayColor = function () {
                alert(this.color);
            };

            function ClassB() {
            }

            //要确保调用的ClassA构造函数没有任何参数
            ClassB.prototype = new ClassA();

            //所有新属性和新方法都必须在prototype被定义后定义
            ClassB.prototype.name = "";
            ClassB.prototype.sayName = function () {
                alert(this.name);
        => a. 原型属性指向的是引用类型值(Array, Object...)时, 此属性会被所有实例共享
           b. 不应使用字面量形式创建原型方法(.prototype={}), 这样会切断原型链(指向 Object 实例)
           c. 如果给超类的构造函数传参(ClassB.prototype = new ClassA(param)), 会影响所有子类实例
           d. 不支持多重继承
        借用构造函数/伪造对象/经典继承(在子类型构造函数内部调用超类型构造函数)
            function Super(name) {
                this.colors = ['red', 'blue', 'green'];
                this.name = name;

                this.sayColors = function() {
                    alert(this.colors);
                }
            }

            function Sub(name, age) {
                // 继承 Super, 亦可传参
                Super.call(this, name); // 解决 c

                // 子类属性
                this.age = age;
            }

            var sub1 = new Sub('Jack');
            var sub2 = new Sub('Mike');
            sub1.colors.push('black');  // 不会影响 sub2, 解决 a
        => e. 每实例化一次, 都要定义一次 sayColors, 缺少函数复用
           f. 在超类原型中定义的方法, 对子类型而言不可见
        组合继承/伪经典继承(组合原型链和借用构造函数, 最常用的继承模式)
            function Super(name) {
                this.name = name;
                this.colors = ['red', 'blue', 'green'];
            }

            Super.prototype.sayColors = function() {
                alert(this.colors);
            }

            function Sub(name, age) {
                // 借用构造函数实现对实例属性的继承
                Super.call(this, name); // 第二次调用 Super()

                this.age = age;
            }

            // 使用原型链实现对原型属性或方法的继承, 解决 e, f
            Sub.prototype = new Super(); // 第一次调用 Super()
            Sub.prototype.constructor = Sub;
            // Sub 的方法
            Sub.prototype.sayAge = function() {
                alert(this.age);
            }
        => g. 调用了两次 Super 的构造函数, 结果是每个 Sub 实例的实例和原型中有重复的 name 和 colors 属性
        原型式继承: 不必创建构造函数, 适用于只想让一个对象类似于另一个对象的情况
            1.
            function object(o) { // 相当于对 o 进行一次浅复制
                function F();
                F.prototype = o;
                return new F();
            }

            var person = {
                name: 'Nick',
                friends: ['Shely', 'Court', 'Van']
            };

            var anotherPerson = object(person);
            // 进行必要的修改
            anotherPerson.name = 'Greg';
            anotherPerson.friends.push('Bob');

            2. ECMAscript5(IE9+, FF4+, Safari5+, Opera12+, Chrome): 使用 Object.create()
            var person = {
                name: 'Nick',
                friends: ['Shely', 'Court', 'Van']
            };

            var anotherPerson = Object.create(person, {
                name: {
                    value: 'Greg'
                }
            });
            anotherPerson.friends.push('Bob');
        => 有和原型一样的缺点
        寄生式继承: 创建一个仅用于封装继承过程的函数, 函数用于增强并返回对象
            function object(o) { // 相当于对 o 进行一次浅复制
                function F();
                F.prototype = o;
                return new F();
            }

            function createAnother(original) {
                var clone = object(original);
                clone.sayHi = function() {
                    alert ('hi');
                };
                return clone;
            }

            var person = {
                name: 'Nick',
                friends: ['Shelby', 'Court', 'Van']
            };
            var anotherPerson = createAnother(person);
            anotherPerson.sayHi();
        => 有和借用构造函数一样的缺点
        寄生组合式继承: 组合寄生式继承和组合集成, 开发人员认为的最理想的继承范式
            function object(o) { // 相当于对 o 进行一次浅复制
                function F();
                F.prototype = o;
                return new F();
            }

            function inheritPrototype(subConst, superConst) {
                var prototype = object(superConst.prototype);
                prototype.constructor = subConst;
                subConst.prototype = prototype;
            }

            function Super(name) {
                this.name = name;
                this.colors = ['red', 'blue', 'green'];
            }

            Super.prototype.sayName = function() {
                alert(this.name);
            };

            function Sub(name, age) {
                Super.call(this, name);

                this.age = age;
            }

            // 解决 g
            inheritPrototype(Sub, Super);

            Sub.prototype.sayAge = function() {
                alert(this.age);
            }

参考(*:experimental !:not-standardized)
    Global
        全局对象是预定义的对象，作为JavaScript的全局函数和全局属性的占位符。通过使用全局对象，可以访问所有其他所有预定义的对象、函数和属性。全局对象不是任何对象的属性，所以它没有名称
        全局属性和函数可用于所有内建的 JavaScript 对象
        在客户端JavaScript中,全局对象就是Window对象

        对象字面量: { myCar:"saturn", getCar:Cartype('honda'), special:sales }

        .Infinity
        .java
        .NaN
        .Packages
        .undefined

        .decodeURI()
        .decodeURIComponent()
        .encodeURI()
        .encodeURIComponent()
        .escape()
        .eval()
        .getClass()
        .isFinite()
        .isNaN()
        .Number()
        .parseFloat(字符串)
        .parseInt(字符串,基)
        //上面两种方法,只有对String类型调用这些方法,它们才能正确运行;对其他类型返回的都是NaN
        .String()
        .unescape()
    Object
        ECMAScript 中的所有对象都由这个对象继承而来,Object 对象中的所有属性和方法都会出现在其他对象中

        person = new Object();
            person.firstname = "bill";
            person.lastname = "gates"
        person = {firstname:"bill", lastname:"gates"} //对象字面量
        function person(firstname, lastname) {
            this.firstname = firstname;
            this.lastname = lastname;
            }


        .constructor
        .prototype
        .hasOwnProperty()
        .isPrototypeOf()
        .propertyIsEnumerable
        .toString()
        .valueOf()

        Object.length
        Object.prototype
        Object.prototype.constructor

        Object.create()
        Object.defineProperty()
        Object.freeze()
        Object.getOwnPropertyDescriptor()
        Object.getOwnPropertyNames()
        Object.getPrototypeOf()
        Object.isExtensible()
        Object.isFrozen()
        Object.isSealed()
        Object.keys()
        Object.preventExtensions()
        Object.seal()
        Object.prototype.hasOwnProperty()
        Object.prototype.isPrototypeOf()
        Object.prototype.propertyIsEnumerable()
        Object.prototype.toLocaleString()
        Object.prototype.toString()
        Object.prototype.valueOf()
    Array
        数组对象用来在单独的变量名中存储一系列的值
        数组中可以存储互不相同的数据类型

        // CREATE
        // There is an important distinction to be made between 1 and 2: if just a single numeric item is passed in, the array constructor will assume its length to be that value
        // 1:
        var cars = new Array(2)
            car[0] = "Saab"
            car[1] = "Volvo"
        // 2:
        var cars = new Array("Saab","Volvo")
        // 3:
        var caars = ["Saab","Volvo"]        //数组字面量(推荐)

        Array.length
        Array.prototype

       *Array.from()
        Array.isArray()
       *Array.of()
        Array.prototype.concat()
       *Array.prototype.contains()
       *Array.prototype.copyWithin()
       *Array.prototype.entries()
        Array.prototype.every()
       *Array.prototype.fill()
        Array.prototype.filter()
       *Array.prototype.find()
       *Array.prototype.findIndex()
        Array.prototype.forEach()
        Array.prototype.indexOf()
        Array.prototype.join()
       *Array.prototype.keys()
        Array.prototype.lastIndexOf()
        Array.prototype.map()
        Array.prototype.pop()
        Array.prototype.push()
        Array.prototype.reduce()
        Array.prototype.reduceRight()
        Array.prototype.reverse()
        Array.prototype.shift()
        Array.prototype.slice()
        Array.prototype.some()
        Array.prototype.sort()
        Array.prototype.splice()
        Array.prototype.toLocaleString()
       !Array.prototype.toSource()
        Array.prototype.toString()
        Array.prototype.unshift()
    Boolean
        可以将Boolean对象理解为一个产生逻辑值的对象包装器,用于将非逻辑值转换为逻辑值
        如果逻辑对象无初始值或者其值为 0,-0,null,"",false,undefined或者NaN,那么对象的值为 false.否则,其值为true(即使当自变量为字符串"false"时)
        你应该了解 Boolean 对象的可用性，不过最好还是使用 Boolean 原始值

        new Boolean(value);         //构造函数
        Boolean(value);             //转换函数

        布尔字面量: true和false

        .toSource()
    Date
        表示月份的参数介于 0 到 11 之间, 也就是说，如果希望把月设置为 8 月，则参数应该是 7
        如果增加天数会改变月份或者年份，那么日期对象会自动完成这种转换
        日期对象也可用于比较两个日期

        new Date();

        Date.now()
        Date.parse()
        Date.UTC()
        Date.prototype.parse()
        Date.prototype.getTimezoneOffset()
        Date.prototype.getFullYear()
        Date.prototype.getTime()
        Date.prototype.getYear()
        Date.prototype.getMonth()
        Date.prototype.getDate()
        Date.prototype.getDay()
        Date.prototype.getHours()
        Date.prototype.getMinutes()
        Date.prototype.getSeconds()
        Date.prototype.getMilliseconds()
        Date.prototype.getUTCFullYear()
        Date.prototype.getUTCMonth()
        Date.prototype.getUTCDate()
        Date.prototype.getUTCDay()
        Date.prototype.getUTCHours()
        Date.prototype.getUTCMinutes()
        Date.prototype.getUTCSeconds()
        Date.prototype.getUTCMilliseconds()
        Date.prototype.setTime()
        Date.prototype.setFullYear()
        Date.prototype.setYear()
        Date.prototype.setMonth()
        Date.prototype.setDate()
        Date.prototype.setHours()
        Date.prototype.setMinutes()
        Date.prototype.setSeconds()
        Date.prototype.setMilliseconds()
        Date.prototype.setUTCFullYear()
        Date.prototype.setUTCMonth()
        Date.prototype.setUTCDate()
        Date.prototype.setUTCHours()
        Date.prototype.setUTCMinutes()
        Date.prototype.setUTCSeconds()
        Date.prototype.setUTCMilliseconds()
        Date.prototype.toSource()
        Date.prototype.toTimeString()
        Date.prototype.toDateString()
        Date.prototype.toISOString()
        Date.prototype.toJSON()
        Date.prototype.toGMTString()
        Date.prototype.toUTCString()
        Date.prototype.toTimeString()
        Date.prototype.toLocaleString()
        Date.prototype.toLocaleTimeString()
        Date.prototype.toLocaleDateString()
    Math
        Math对象并不像Date和String那样是对象的类，因此没有构造函数 Math()，像 Math.sin() 这样的函数只是函数，不是某个对象的方法。您无需创建它，通过把Math作为对象使用就可以调用其所有属性和方法

        Math.E
        Math.LN2
        Math.LN10
        Math.LOG2E
        Math.LOG10E
        Math.PI
        Math.SQRT1_2
        Math.SQRT2

        Math.abs(x)
        Math.acos(x)
        Math.asin(x)
        Math.atan(x)
        Math.atan2(y,x)
        Math.ceil(x)
        Math.cos(x)
        Math.exp(x)
        Math.floor(x)
        Math.log(x)
        Math.max(x,y)
        Math.min(x,y)
        Math.pow(x,y)
        Math.random()
        Math.round(x)
        Math.sin(x)
        Math.sqrt(x)
        Math.tan(x)
        Math.toSource()
    Number
        JavaScript 只有一种数字类型,所有数字都存储为根为 10 的 64 位（8 比特），浮点数
        整数（不使用小数点或指数计数法）最多为 15 位,小数的最大位数是 17，但是浮点运算并不总是 100% 准确
        以0开头的数字被解释称八进制, 以0x开头的数字被解释称十六进制
        当Number()和运算符new一起作为构造函数使用时，它返回一个新创建的*Number对象*,如果不用 new 运算符，把 Number() 作为一个函数来调用，它将把自己的参数转换成一个原始的数值，并且返回这个*值*(如果转换失败,则返回 NaN)
        应该少用这种对象,尽量用数字的原始表示

        var myNum=new Number(value);
        var myNum=Number(value);

        整数字面量:015,  0x112,  -77...
        浮点字面量:3.1415, -3.1E3,  .1e12...

        Number.MAX_VALUE
        Number.MIN_VALUE
        Number.NaN                                  //NaN!=NaN,出于此,不推荐使用NaN值本身.函数isNaN()会做得相当好,不能用于计算
        Number.NEGATIVE_INFINITY                //值为Infinity,不能用于计算
        Number.POSITIVE_INFINITY                //值为-Infinity,不能用于计算

        Number.prototype.toLocaleString()
        Number.prototype.toFixed()
        Number.prototype.toExponential()
        Number.prototype.toPrecision()
    String
        当 String(s) 和运算符new一起作为构造函数使用时,它返回一个新创建的String对象,存放的是字符串 s 或 s 的字符串表示.当不用 new 运算符调用String(),它只把s转换成原始的字符串,并返回转换后的值
        JavaScript 的字符串是不可变的(immutable)String类定义的方法都不能改变字符串的内容.像String.toUpperCase()这样的方法,返回的是全新的字符串,而不是修改原始字符串
        String对象的所有属性和方法都可应用于String原始值上,因为它们是伪对象
        可以使用 s[0] 这种形式访问索引在 0 位置的字符

        字符串字面量:'foo' "bar" ...
        字符字面量: \n \t \b \r \f \\ \' \" \0nnn \xnn \unnnn

        String.prototype.length

        String.formCharCode()
        String.prototype.anchor()
        String.prototype.big()
        String.prototype.blink()
        String.prototype.bold()
        String.prototype.fixed()
        String.prototype.fontcolor()
        String.prototype.fontsize()
        String.prototype.italics()
        String.prototype.link()
        String.prototype.small()
        String.prototype.strike()
        String.prototype.sub()
        String.prototype.sup()
        String.prototype.charAt()
        String.prototype.charCodeAt()
        String.prototype.concat()   //使用"+"运算符来进行字符串的连接运算通常会更简便一些
        String.prototype.trim()
        String.prototype.fromCharCode()
        String.prototype.indexOf(searchvalue,fromindex)
        String.prototype.lastIndexOf()
        String.prototype.localeCompare()
        String.prototype.match(searchvalue/regexp)
        String.prototype.replace(regexp/substr.replacement)
        String.prototype.search(regexp)
        String.prototype.slice(start,end)
        String.prototype.split(separator.howmany)
        String.prototype.substr(start,length)
        String.prototype.substring(start,stop)
        String.prototype.toLocaleLowerCase()
        String.prototype.toLocaleUpperCase()
        String.prototype.toLowerCase()
        String.prototype.toUpperCase()
    RegExp (Ecmascript 不支持后行断言(?<=exp), 但是支持先行断言)
        /pattern/switchs            // 直接量语法
        new RegExp(pattern, g/i/m)  // 用于动态生成正则表达式的时候

        RegExp.prototype.global
        RegExp.prototype.ignoreCase
        RegExp.prototype.lastIndex
        RegExp.prototype.multiline
        RegExp.prototype.source

        RegExp.prototype.compile()
        RegExp.prototype.exec()
        RegExp.prototype.test()
    Function
        尽管可以使用Function构造函数创建函数,但最好不要使用它,因为用它定义函数比用传统方式要慢得多.不过,所有函数都应看作Function类的实例

        function fun_name() { }
        var fun_name = new function(arg1, arg2, ... , fun_body)

        .arguments
        .caller
        .this

        Function.prototype.call()
        Function.prototype.apply()
        Function.prototype.bind()
    JSON
        .parse()
        .stringify()
    关键字
        break case catch continue default delete do else finally for function if in
        instanceof new return switch this throw try typeof var void while with
    保留字
        abstract boolean byte char class const debugger double enum export extends final float
        goto implements import int interface long native package private protected public short
        static super synchronized throws transient volatile

语言特性&注意
    大小写敏感, 解释而非编译运行, //单行注释, /*多行注释*/
    通常的做法是把函数放入 <head> 部分中，或者放在页面底部。这样就可以把它们安置到同一处位置，不会干扰页面的内容
    如果在文档已完成加载后执行 document.write()，整个 HTML 页面将被覆盖
    微软支持通过 JavaScript 创建 Windows 8 app
    ECMA-262 把术语类型（type）定义为值的一个集合，每种原始类型定义了它包含的值的范围及其字面量表示形式
    为什么 typeof 运算符对于 null 值会返回 "Object"。这实际上是 JavaScript 最初实现中的一个错误，然后被 ECMAScript 沿用了。现在，null 被认为是对象的占位符，从而解释了这一矛盾，但从技术上来说，它仍然是原始值
    值 undefined 并不同于未定义的值.虽然typeof 运算符并不真正区分这两种值, 但是如果用除typeof之外的其他运算符的话, 会引起错误.
    值 undefined 实际上是从值 null 派生来的，因此 ECMAScript 把它们定义为相等的, 尽管这两个值相等，但它们的含义不同.undefined是声明了变量但未对其初始化时赋予该变量的值,null则用于表示尚未存在的对象

==================== quotes from IRC ====================
liharb:
    nothing in JS has methods. JS only has function-valued properties.

even though the term “class” is introduced into JavaScript, it still utilizes prototype-based inheritance under the hood

