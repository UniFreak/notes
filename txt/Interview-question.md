#General
1. 经历
2. 入行原因
3. 对上个公司的评价, 为什么离职
3. 长远打算(架构师)
4. 得意之作
5. 项目的用户量, PV, 吞吐量, 难点和解决方法

#Tech
跨域
jsonp
validate email(be smart: http://www.ex-parrot.com/~pdw/Mail-RFC822-Address.html)
分表
数据库设计
主从复制
late binding
single quote vs double quote
    single: 解析变量
    double: 不解析
    myth: single is faster?
        wrong:
        If you are defining a single string and not trying to concatenate values or anything complicated, then either a single or double quoted string will be entirely identical. Neither are quicker.
        If you are concatenating multiple strings of any type, or interpolate values into a double quoted string, then the results can vary. If you are working with a small number of values, concatenation is minutely faster. With a lot of values, interpolating is minutely faster
closure
name space & auto-loading
site scraping
cli-php
date time
前后台数据交互方法
    前台 -> 后台: post, get, cookie
    后台 -> 前台:
        同一个页面, 直接 echo
        不同页面, 可用 Ajax+json

Ajax实现
    原生
        创建对象:
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
        打开请求:
            xmlhttp.open("GET","test1.txt",true);
        头信息  :
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        发送请求:
            xmlhttp.send("fname=Bill&lname=Gates");
        监视状态 & 接收数据
            xmlhttp.onreadystatechange=function()
              {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
                }
              }
    Jquery
        1.  .load(URL, data, callback)
        2.  $.get(URL, callback)
        3.  $.post(URL, data, callback)
        4.  $.ajax({
                type: "",
                url: "",
                data: "",
                success: function(){}
            })

无极分类实现
分页实现
权限管理实现
登录注册实现
表单校验实现
验证码实现
文件上传实现
数据安全检查实现
留言板实现
静态化实现
对 PDO 的了解

多表查询 复合查询 联合查询 关联查询
    多表查询: 从多个表中查询
    复合查询: 使用多个查询条件(AND | OR)
    联合查询: 使用 UNION 关键字
    关联查询: 使用 JOIN 关键字
        外连接
            左连接
            右连接
        内连接
        内连接
        自连接

select 子句顺序
    select -> from -> where -> group by -> having -> order by -> limit

如何选取第21行的记录
    select * from table order by field limit 1 offset 20

现有表 article(id,title,content), comment(id,article_id,content), 查询数据库得到下列格式的列表, 按照回复数量从高到低排序
文章id 文章title 回复数量
    SELECT a.id,a.title,a.hits,COUNT(c.article_id) AS comment_total
    FROM article AS a LEFT JOIN comment AS c
    ON a.id=c.article_id GROUP BY a.id ORDER BY comment_total DESC;

Sql 注入和防范
    Sql注入: 利用用户提交表单, url参数等形式提交 sql 语句改变原本语句执行, 从而获非取法信息, 甚至篡改数据, 执行系统级命令等
    防范
        1. 应用程序永远不要使用数据库所有者或超级用户帐号来连接数据库, 因为这些帐号可以执行任意的操作; 应该为程序的每个方面创建不同的数据库帐号, 并赋予对数据库对象的极有限的权限
        2. 永远不要信任外界输入的数据, 特别是来自于客户端的, 包括选择框, 表单隐藏域和 cookie, 确保每一个从客户端提交的变量都经过适当的检查确定为自己期望的格式(使用 is_numeric, settype(), sprintf() 等函数), 并且使用数据库特定的敏感字符转义函数把用户提交上来的非数字数据进行转义(使用 mysql_excape_string(), addslash(), str_replace() 等)
        3. 尽力不要把所有的事务逻辑都用 web 应用程序( 即用户的脚本)来实现, 最好用视图(view)、触发器 (trigger)或者规则 (rule) 在数据库层面完成

DDOS
PHP:Hypertext Preprocessor

linux文件排序, 剩余空间, 控制权限
    ll -rt
    fdisk -l
    chmod
    chown
session vs cookie , cookie 禁了session 为什么不能用
    Session 工作原理
        Session 储存于服务器端( 默认以文件方式存储 session ),  并通过 session id 标识这个 session
    Cookie 工作原理
        Cookie 存储于客户端, 通过页面 HTTP 头传给 php 页面并自动生成为 $_COOKIE 超全局数组
        Cookie 可分为非持久(内存) Cookie 和持久(硬盘) Cookie 两种
    联系
        Session 在默认情况下是使用客户端的 Cookie 来保存 session id 的, 所以当客户端的 Cookie 出现问题的时候就会影响 session 了. 但是 Session 不一定必须依赖 Cookie, 当客户端的 Cookie 被禁用或出现问题时, PHP会自动把 session id 附着在 URL 中, 这样再通过 session id 就能跨页使用 session 变量了. 但这种附着也是有一定条件的, 即 php.ini 中的 session.use_trans_sid = 1 或者编译时打开打开了--enable-trans-sid 选项

GET 与 POST 的区别
    GET
        - 请求的数据会附在 URL 之后, 以 ? 分割 URL 和传输数据, 参数之间以 & 相连
        - 数据量限制由 URL 长度(由浏览器决定, HTTP 规范没有对 URL 进行长度限制)决定
        - 安全性相对较低
    POST
        - 把提交的数据则放置在是 HTTP HEADER 内传送到 action 属性所指的 URL 地址
        - HTTP 也没有对 POST 进行长度限制, 决定其最大长度的是服务器处理能力和配置值
        - 安全相对较高
    - GET data can exist in a POST request, because it is simply part of the URL being requested and doesn't rely on the request method

rawurlencode()/rawurldecode() VS urlencode()/urldecode()
    raw is binary safe
    it means that if you want to transfer binary data over the web, you should use raw

如何加快页面加载速度
    前端
        代码优化(减少冗余, 优化算法)
        减少 HTTP 请求(合并脚本, css等; 使用sprint)
        使用 CDN
        在 .htcaccess 中使用 Expires Header, 缓存文件到客户机器
        Gzip压缩文档 (js, css, 图片)
        代码位置调整 (js 置底, css 置顶)
        结构, 样式, 行为分离
        避免重定向
    PHP
        代码优化
        缓存
            数据缓存: memcache, adodb 等
            php缓存: eaccelerator, apc, phpa, xcache
            模板缓存(静态化): smarty 等
            方向代理 web 缓存: Nginx, souid, mod_proxy
        压缩
        负载均衡
    数据库优化(参下)
    硬件

如何优化数据库
    设计
        三大范式与适度反范式
        选择适当的字段类型
        选择适当的存储引擎
        适当建立索引(create index) - 经常作为查询条件,区分度高的字段
        适当使用外键
        水平 | 垂直划分表
    SQL 语句
        使用 explain/慢日志工具分析
        使用 limit, 避免 select *,
        使用连接查询 (JOIN) 替代子查询 (SUBQUERY)
        使用存储过程
        使用联合 (UNION) 替代手动创建临时表
        尽量少使用 LIKE 关键字和通配符
    数据库配置
        主从复制, 读写分离
        负载均衡
        分区
    硬件/操作系统

负载均衡
    就是将负载(工作任务)进行平衡, 分摊到多个操作单元上进行执行, 从而共同完成工作任务
    分 软件/硬件/本地/全局 四种实现方式

echo, print, print_r, var_dump, var_export 的区别
    下两个是语言结构, 可不用括号传参, 也不能被可变函数调用

    - `echo`: 可用 ',' 同时输出多个变量; 比 print 快一点; 不返回, 所以不能用于表达式中
    - `print`: 不能用 ',' 同时输出多个变量; 比 echo 慢一点; 总是返回 1, 所以能用于表达式中

    下面的是函数, 必须要括号传参, 可以被可变函数调用
    - `printf`: 输出格式化后的字符串; 第一个参数定义格式(用%b,%c,%d...占位), 其他参数为代替占位符的变量
    - `print_r`: 打印关于变量的易于理解的信息; 只能输出一个变量; 
        第二个参数用于决定是否返回字符串
    - `var_dump`: 相较于 print_r, 会打印变量类型等更多详细信息, 多用于调试, 可一次输出多个变量

什么是模板技术, 什么是 smarty, smarty 优缺点
    模板技术是为了实现美工与程序的分离, 更利于两个分工合作; 一般可以用三个文档来实现, 比如 getnews.php 用来获取数据, 由程序员维护, shownews.php 用来展示数据, 由美工来维护, listnews.php(include getnews,include shownews, str_replace替换标签变量) 用来连接两者; 大致也对应于 MVC 模型的三个模块

    smarty: 一个 php 模板引擎
    smarty优点
        速度: 相对于其它的模板引擎技术而言的可获得最大速度的提高

        编译型: 在运行时要编译成一个非模板技术的PHP文件, 这个文件采用了PHP与HTML混合的方式, 在下一次访问模板时将WEB请求直接转换到这个文件中, 而不再进行模板重新编译(在源程序没有改动的情况下)

        缓存技术: 将用户最终看到的HTML文件缓存成一个静态的HTML页, 当设定smarty的cache属性为true时, 在smarty设定的cachetime期内将用户的WEB请求直接转换到这个静态的HTML文件中来, 这相当于调用一个静态的HTML文件

        插件技术: smarty可以自定义插件, 插件实际就是一些自定义的函数。

        使用if/elseif/else/endif. 非常方便的对模板进行格式重排
    smarty缺点
        不适合小项目使用, 会丧失 php 快速开发的特性

        不适合在实时更新(股票)的项目中使用

        因为多一层东西, 所以肯定比原生代码要浪费内存和 cpu 执行时间

对 MVC 的认识
    M(odel), V(iew), C(ontroller)
    优势: 分散关注, 松散耦合, 逻辑复用, 标准定义, 使同一个程序可以使用不同的表现形式

值传递和引用传递的区别, 用于什么情况

    值传递
        将值传递给目标变量, 会为目标变量开辟新的内存空间, 修改目标变量不会改变原变量
    引用传递
        将地址传递给目标变量, 是目标变量和原变量指向同一个内存空间, 可以理解为别名, 改变目标变量的值原变量也会改变

        如果程序比较大, 引用同一个对象的变量比较多并且希望用完该对象后手工清除它, 建议用 "&" 方式, 然后用 $var = null 的方式清除; 对于大数组的传递, 建议用 "&" 方式, 毕竟节省内存空间使用

        用途: 变量引用传递, 函数引用传参, 函数引用返回, 对象默认即为引用传递(see php-syntax.md)

设计一个简易问答网站
    拓展
    1.提问人, 回答人
    2.论坛样式, 主楼为提问, 其余为回答
    3.可对回复点赞
    4.个人信息统计, 如提问数, 回答数
    要求
    1.可在此需求上拓展
    2.按功能模块划分(可绘草图)
    3.描述主要的功能逻辑
    4.主要的数据样式
    5.所需开发环境和工具

    表设计
        user
            id
            name
            email
        question
            id
            uid
            create_time
        answer
            id
            uid
            qid
            like
            create_time

实现存整形的一维数组从大到小排序, 并说明如何改善执行效率(不能使用 php 函数)
    // 冒泡排序
    function bubbleImprovedSort($arr) {
        $len = count($arr);
        for($i = 0; $i < $len; $i ++) {
            $noswap = true;                         // 用于指示是否还需要继续判断, 默认不需要
            for($j = $len - 1; $j > $i; $j --) {
                if ($arr [$j] > $arr [$j - 1]) {
                    $tmp = $arr [$j - 1];
                    $arr [$j - 1] = $arr [$j];
                    $arr [$j] = $tmp;
                    $noswap = false;                // 如果做出了排序更改, 则设为需要再判断
                }
            }
            if ($noswap) {                          // 检查是否需要继续判断, 否则返回数组
                return $arr;
            }
        }
    }

写一个邮箱验证函数
    function checkEmail($str) {
        $pattern = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
        return preg_match($pattern, $str);
    }

显示当前脚本路径
    1.echo $_SERVER['REQUEST_URI'];
    2.echo $_SERVER['SCRIPT_FILENAME'].'?'.$_SERVER['QUERY_STRING'];

error_reporting() 可以设定的错误报告级别
    0
    E_NOTICE
    E_WARNING
    E_PARSE
    E_ERROR
    E_ALL | -1

设置自增属性的列必须是
    主键或者加UNIQUE索引

如何解决大流量问题
    硬件：升级
    软件配置: 防盗链, 缓存, 控制大文件下载, 主从分离
    php 代码: 静态化

什么是面向过程, 面向对象, 为什么使用, 特点
    面向过程就是分析出解决问题所需要的步骤，然后用函数把这些步骤一步一步实现，使用的时候一个一个依次调用就可以了; 面向对象是把构成问题事务分解成各个对象，建立对象的目的不是为了完成一个步骤，而是为了描叙某个事物在整个解决问题的步骤中的行为 , 将现实世界抽象成对象, 将他们的关系抽象成继承, 类等; 对象的数据抽象为属性, 对象的操作抽象为方法
    重用性, 灵活性, 扩展性
    封装, 继承, 多态

include include_once require require_once
    require VS include
        1. 如果引用文件找不到或者引用时出错, require() 会产生错误并中止程序运行; 而include()会产生警告并忽略错误, 继续执行
        2. require() 不能在循环体中根据条件的不同而包含不同的文件. require()语句只会在第一次执行时调用它所包含的文件中的内容替换本身这条语句, 当再次被执行时只能执行第一次所包含的语句. 但是include()语句可以在循环体中来包含不同的文件
        3. require() 函数不进行计算, 在条件控制语句中, 即使条件为假, 被引用文件也要包含进来(当然不会执行被引用的文件了), 增加系统负担; 而include()要进行计算, 在条件控制语句中, 如果条件为假, 被引用文件不会包含进来, 仅在条件为真时才包含
    require VS require_once / include VS include_once
        _once 会检查是否已经包含, 如果包含过了则不再进行包含, 即只包含一次

常用 http 状态代码
    200         OK
    400         Bad Request
    401         Unauthorized
    402         Payment Required
    403         Forbidden
    404         Not Found

mysql 取得当前时间和格式化日期函数
    now(), date_format()

版本控制工具
    git, svn(subversion), cvs

不用第三个变量，把两个变量的值交换

    $a=1111;
    $b=2222;
    $b=explode("|",$a."|".$b);
    $a=$b[1];
    $b=$b[0];

    或

    list($a, $b) = array($b, $a);

编写正则取出 value 值 (<input value='text' />)
    (?<=value=")|(?<=value=')[^\"\'.]*

输出昨天此刻时间
    1. echo date("Y-m-d H:i:s",strtotime("-1 day"));
    2. echo date('Y-n-j H:i:s', time()-60*60*24);

写出两种连接数据库的方法
    mysql_connect("主机名","用户名","密码")；
            mysql_select_db("数据库名");
    或
    $pdo=new PDO(mysql:host="主机名",dbname="数据库名","用户名","密码");

实现字符串反转
    1.  strrev()
    2.  $str = 'test';
        for($i = 1; $i <= strlen($str); $i++) {
            echo substr($str, -1, 1);
        }

实现中文字符串截取无乱码
    1.mb_substr('中文乱码问题的解决方法', 0, 7, 'utf-8');          //按字来切分字符 输出：中文乱码问题的
    2.mb_strcut('中文乱码问题的解决方法', 0, 7, 'utf-8');          //按字节来切分字符 输出：中文乱

获取服务器 ip
    $serverip = gethostbyname($_SERVER['SERVER_ADDR']);

获取客户端 ip
    function getIp(){
          if (isset($_SERVER)){
                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                     $arr = explode(',', $_SERVER["HTTP_X_FORWARDED_FOR"]);
                /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                  foreach ($arr AS $ip) {
                        $ip = trim($ip);
                        if ($ip != 'unknown') {
                               $realip = $ip;
                               break;
                        }
                  }
              } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
                    $realip = $_SERVER["HTTP_CLIENT_IP"];
              } else {
                  $realip = $_SERVER["REMOTE_ADDR"];
              }
          } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                    $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                    $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
         }
         return $realip;
    }

修改 session 生存时间
    修改php.ini文件
        session.gc_maxlifetime，与session.cookie_lifetime一致，同时确认session.use_cookies = 1。
    也可以用程式控制
        $savePath = "./session_save_dir/";
        $lifeTime = 24 * 3600;
        session_save_path($savePath);
        session_set_cookie_params($lifeTime);
        session_start();

取得 baidu.com/index.html 的内容
    file_get_content($url)

用正则实现:找到一个字符串中所有大写的字母, 并在它后面加上匹配到它时的次数? 比如 " A c B d e F G " 变成 " A1 c B2 d e F3 G4 "
    $str = 'A bcD eFG hHi J 12%I';
    $pattern = '/[A-Z]/';
    function replace($matches) {
        static $i=1;
        $matches[0] = $matches[0].$i;
        $i++;
        return $matches[0];
    }
    echo preg_replace_callback($pattern, 'replace', $str);

JS 重定向页面
    1. window.location.href = 'url';
    2. window.location.assign('url');

mysql_fetch_row() VS mysql_fetch_assoc VS mysql_fetch_array()
    row : 返回一行作为枚举数组
    assoc : 返回一行作为关联数组
    array : 返回一行作为枚举或关联数组, 或兼有

实现下拉菜单选择文章分类

如何获取图像大小
    getimagesize()
    imagesx()
    imagesy()

写出下面程序的输出
    $x = 5;
    echo $x;
    echo "\n";
    echo $x+++$x++;
    echo "\n";
    echo $x;
    echo "\n";
    echo $x---$x--;
    echo "\n";
    echo $x;

    1
    11
    7
    1

实现防止表单重复提交
    使用 JS 检查是否重复提交
    使用 JS 禁用提交按钮
    使用 Session 存取 token 在后端检查是否重复提交

运行下面的代码，$text 的值是多少？strlen($text)又会返回什么结果？

    $text = 'John ';
    $text[10] = 'Doe';

    上面代码执行完毕后 $text = "John D"(John后面会有连续的5个空格)
    strlen($text)会返回11

    $text[10] = "Doe"给某个字符串具体的某个位置具体字符时候，实际只会把D赋给$text. 虽然$text才开始只有5个自负长度，但是php会默认填充空格。这和别的语言有些差别。

执行下面代码$x会变成什么值呢？
    $x = NULL;

    if ('0xFF' == 255) {
        $x = (int)'0xFF';
    }

    实际的运行结果是$x=0而不是255.

    首先'oxFF' == 255我们好判断，会进行转换将16进制数字转换成10进制数字，0xff -> 255.

    PHP使用is_numeric_string 判断字符串是否包含十六进制数字然后进行转换。

    但是$x = (int)'0xFF';是否也会变成255呢？显然不是，将一个字符串进行强制类型转换实际上用的是convert_to_long,它实际上是将字符串从左向右进行转换，遇到非数字字符则停止。因此0xFF到x就停止了。所以$x=0

写一个函数，尽可能高效的，从一个标准 url 里取出文件的扩展名
    例如: http://www.phpddt.com/abc/de/fg.php?id=1 需要取出 php 或 .php

    $url = "http://www.phpddt.com/abc/de/fg.php?id=1";
    $path = parse_url($url);
    echo pathinfo($path['path'],PATHINFO_EXTENSION);


写一个函数，能够遍历一个文件夹下的所有文件和子文件夹


无限极分类的实现

获取用户输入参数的三个方法
- argc, argv
- getopt()
- fwrite(STDOUT, 'Enter your name'); name = fget(STDIN);

posix和perl标准的正则表达式区别

Safe_mode 打开后哪些地方受限

请介绍 Session 的原理, 大型网站中Session方面应注意什么

测试php性能和mysql数据库性能的工具,和找出瓶颈的方法

常见的SSO(单点登陆)方案

Makefile的基本格式，gcc 编译，连接的命令,-O0 和-O3区别

gdb,strace,valgrind的基本使用

echo 8%(-3) 输出: 2

给你256M的内存,对10G的文件进行排序(文件每行1个数字),如何实现？

对10G的文件进行查找如何实现？

统计10G文件每个关键字出现的次数如何实现？

一个10G的表,你用php程序统计某个字段出现的次数,思路是?

应对高访问量和突发访问量(秒杀, 抢票, 12306): 服务器架构/数据存储

多服务器共享 session

nginx配置一下rewrite指定到某个具体路径?

多线程和多进程的区别为?

hash碰撞原理为? 如何进行修复?

假如两个单链表相交,写一个最优算法计算交点位置,说思路也可以?

不优化前提下,apache一般最大连接数为? nginx一般最大连接数为? mysql 每秒insert ? select ? update ? delete?

nginx设置缓存js、css、图片等信息,缓存的实现原理是?

如何提高缓存命中率? 如何对缓存进行颗粒化?

php的内存回收机制是?

用 javascript 写一个函数, 删除数组中重复的元素

    function arrayUnique(arr) {
        var len = arr.length;
        var ret = arr;
        for (var i = 0; i < len - 1; i++) {
            for (var j = i + 1; j < len; j++) {
                if (ret[j] == arr[i]) {
                    ret.splice(j, 1);
                }
            }
        }
        return ret;
    }

以下结果为真的表达式(C):
    
A. null instanceof Object
B. null === undefined
C. null == undefined
D. NaN == NaN

以下可以获取 foo 对象 att 属性值的是(A, C, E):

A. foo.att
B. foo("att")
C. foo["att"]
D. foo{"att"}
E. foo{"a" + "t" + "t"}

列举三种添加事件的方法

- HTML: `<img onclick="alert('hello');"`
- DOM0: `img.click(function() {})`
- DOM2: `img.addEventListener("click", function() {});`
- IE: `img.attachEvent("onclick", function() {}); `

写出三种产生一个 image 标签的方法

- `var img = new Image()`
- `var img = document.createElement("image")`
- `img.innerHTML = "<img src='xxx.jpg' />"`

使用 JS 让网页前进或后退

- history.go(1); history.back()
- history.go(-1); history.forward()

实现中文截取无乱码

- 使用 `mb_substr()`
- 自定义函数
    
    function substrUtf8($str, $start, $length = null) {
        return implode("", array_slice(
            preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY)));
    }

实现中文字符数计数

- 使用 `mb_strlen()`
- 自定义函数

    function strlenUtf8($str) {
        return count(preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY));
    }

用最少代码定义一个求三个数中最大值的函数

    function max($a, $b, $c) {
        return $a > $b ? ($a > $c ? $a : $c) : ($b > $c ? $b : $c);
    }


将 1234567890 转换为 1,234,567,890 每三位用逗号分隔的形式

- 使用内置 `number_format()` 或 `money_format()`
- 自定义函数
    
    function sep($str) {
        $str = strrev($str); // 0987654321
        $str = chunk_split($str, 3, ','); // 098,765,432,1,
        $str = strrev($str); // ,1,234,567,890
        $str = ltrim($str, ','); // 1,234,567,890
        return $str;
    }

`echo count("abc");` 输出什么

    输出 1
    
    count(): 
    - 计算数组中的哦单元数目
    - 对象中(必须已经实现 spl Countable::count() 方法) count() 方法返回的数值
    - null 则返回 0
    - 任何其他类型(包括没有实现 Countable 接口的对象)都返回 1

写五个获取一个全路径的文件扩展名的函数

    function getExt1($path) {
        return strrchr($path, '.');
    }

    function getExt2($path) {
        return substr($path, strrpos($path, '.'));
    }

    function getExt3($path) {
        $pathInfos = pathinfo($path);
        return $pathInfos['extension'];
    }

    function getExt4($path) {
        $arr = explode('.', $path);
        return $arr[count($arr) - 1];
    }

    function getExt5($path) {
        $pattern = '/^[^\.]+\.([\w]+)$/';
        return preg_replace($pattern, '${1}', basename($path));
    }

`in_array('01', array('1'));` 是 true 还是 false

    true

下面程序输出
    $a = 'hello';
    $b = &$a;
    unset($b);
    $b = 'world';
    var_dump($a);

    hello

下面程序输出
    $test = 'aaaaaa';
    $abc = &$test;
    unset($test);
    echo $abc;

    'aaaaaa'

写一个函数, 将 open_door 转换为 OpenDoor

    function ul2Camel($str) {
        $arr = explode('_', $str);
        $arr = array_map('ucfirst', $arr);
        return implode('', $arr);
    }

以下程序 $val 的值为(array(2, 3, 7), 参见手册)
    $val = max('string', array(2, 3, 7), 42);

输出北京时间, 格式为 yyyy-mm-dd hh:mm:ss

    date_default_timezone_set('PRC');
    echo date('Y-m-d H:i:s', time());

简述 GBK, GB2312, BIG5, GB18030

- GBK2312 支持汉字较少
- GBK 比 GBK2312 汉字更为丰富, 简体中文一般使用 GBK
- GB18030 比 GBK2312 增加一些少数民族汉字
- 繁体中文一般使用 BIG5

下面程序输出
    $count = 5;
    function getCount() {
        static $count = 0;
        return $count++;
    }
    echo $count;
    ++$count;
    echo getCount();
    echo getCount();

    501

下面程序输出
    $GLOBALS['var1'] = 5;
    $var2 = 1;
    function getVal() {
        global $val2;
        $var1 = 0;
        return $val2++;
    }
    getVal();
    echo $var1;
    echo $var2;

    51 @?

下面程序可行吗
    <?php
    class Foo{
    ?>
    <?php
        function bar() {}
    }
    ?>

    不可行, 因为不同于函数, 类定义必须在同一个 <?php ?> 内

如何备份 mysql 数据库

- `mysqldump -u username -p password database table > singleTable.sql`
- `mysqldump -u username -p password database table1 table2 ... > multiTable.sql`
- `mysqldump -u username -p password database > allTable.sql`
- `mysqldump -u username -p password -B database > database.sql`

MySQL 的 char 和 varchar 有何区别

    1. 定长和变长
    char 长度固定, varchar 长度不固定
    当插入的字符串超出长度时:
    - 严格模式: 拒绝插入并提示错误信息
    - 宽松模式: 截取然后插入
    当插如的字符串不够长度时:
    - char: 不足处用空格填满
    - varchar: 插入多少就保存多少
    2. 存储容量不同
    - char: 最多 255 个, 和编码无关
    - varchar: 最多 65532 个字符, 和编码有关. 
      其最大有效长度最大行大小和字符集确定
      varchar 存字符串时, 第一个字节为空, 还需两个字节存放字符串长度, 此时有效长度为 65535-1-2=65532. 此时, 如果字符集为单字节, 如 Latin1, 最多能存放 65532 个字符; 如果是双字节, 如 GBK, 最多能存放 65532/2 = 32766 个字符; 如果是三字节, 如 UTF8, 最多能存放 65532/3 = 21844 个字符.
    3. 注意: char 和 varchar 后面的长度表示字符个数, 而非字节数
    4. char 效率更高, 但没有 varchar 灵活

若一个表定义为
    create table t1 (c1 int, c2 char(30), c3 varchar(N)) charset=utf8;
则 N 的最大值为多少

    (65535(行大小)-1(空字节)-2(长度字节)-4(c1)-30*3(c2)) / 3

IP 应如何保存

    存为整形, 可以使用 php 或 mysql 提供的函数将 IP 转换为整形
    - php: ip2long(); long2ip()
    - mysql: inet_aton(); inet_ntoa()

用 php 获取 mySQL 中下一个自增长 id

- 使用 show table status, 然后获取 auto_increment 的值
- 使用 select max(id) + 1 from table
- 如果是刚插入记录, 可以使用 last_insert_id() + 1

PHP 访问数据库有哪几部

1. 连接数据库服务器
2. 选择数据库
3. 设置字符集
4. 执行 sql 语句
5. 处理结果集
6. 关闭结果集, 释放资源
7. 关闭数据库连接

如何确保 MySQL 正确保存 UTF8 数据

1. 确保数据表是 utf8
2. 确保 .php 文件是 utf8
3. 执行 set names utf8
4. 对于不是 utf8 编码的文本, 使用 iconv() 转码成 utf8 再保存到数据库


