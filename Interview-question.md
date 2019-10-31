# See
- <https://www.kancloud.cn/daniu945/php/408810>
- <https://juejin.im/post/5c870297f265da2dd0527c8c>

# General
1. 经历
2. 入行原因
3. 对上个公司的评价, 为什么离职
3. 长远打算(架构师)
4. 得意之作
5. 项目的用户量, PV, 吞吐量, 难点和解决方法

# Tech

# TODO

简述三大范式

DDOS

跨域: jsonp

单点登录的实现

`$_POST`, `$_RAW_POST_DATA`, `input://`

架构设计

框架设计

静态化设计

瓶颈分析

分表

数据库设计

主从复制

late binding

closure

name space & auto-loading

site scraping

cli-php

date time

实现
- 无极分类
- 分页
- 权限管理
- 登录注册
- 表单校验
- 验证码
- 文件上传
- 数据安全检查
- 留言板
- 静态化
- 下拉菜单选择文章分类

对 PDO 的了解

# 单引号 vs 双引号

single: 解析变量, double: 不解析

single is NOT faster:

If you are defining a single string and not trying to concatenate values or anything complicated, then either a single or double quoted string will be entirely identical. Neither are quicker.

If you are concatenating multiple strings of any type, or interpolate values into a double quoted string, then the results can vary. If you are working with a small number of values, concatenation is minutely faster. With a lot of values, interpolating is minutely faster

# 多表查询 vs 复合查询 vs 联合查询 vs 关联查询

多表查询: 从多个表中查询

复合查询: 使用多个查询条件(AND | OR)

联合查询: 使用 UNION 关键字

关联查询: 使用 JOIN 关键字
- 外连接:左连接, 右连接
- 内连接
- 自连接

# select 子句顺序

select -> from -> where -> group by -> having -> order by -> limit

# 编写 SQL

现有表 article(id,title,content), comment(id,article_id,content), 查询数据库得到下列格式的列表, 按照回复数量从高到低排序

文章id 文章title 回复数量

```sql
SELECT a.id,a.title,a.hits,COUNT(c.article_id) AS comment_total
FROM article AS a LEFT JOIN comment AS c
ON a.id=c.article_id GROUP BY a.id ORDER BY comment_total DESC;
```

# Sql 注入和防范

Sql 注入: 利用用户提交表单, url参数等形式提交 sql 语句改变原本语句执行, 从而获非取法信息, 甚至篡改数据, 执行系统级命令等

防范:
1. 应用程序永远不要使用数据库所有者或超级用户帐号来连接数据库, 因为这些帐号可以执行任意的操作; 应该为程序的每个方面创建不同的数据库帐号, 并赋予对数据库对象的极有限的权限
2. 永远不要信任外界输入的数据, 特别是来自于客户端的, 包括选择框, 表单隐藏域和 cookie, 确保每一个从客户端提交的变量都经过适当的检查确定为自己期望的格式(使用 `is_numeric()`, `settype()`, `sprintf()` 等函数), 并且使用数据库特定的敏感字符转义函数把用户提交上来的非数字数据进行转义(使用 `mysql_excape_string()`, `addslash()`, `str_replace()` 等)
3. 尽力不要把所有的事务逻辑都用 web 应用程序( 即用户的脚本)来实现, 最好用视图(view), 触发器 (trigger)或者规则 (rule) 在数据库层面完成 (@?)
4. 使用预编译语句 (prepared statement)

# PHP 全拼是什么

PHP: Hypertext Preprocessor

# 如何发送一个 Ajax 请求

- 原生: 见 sandbox/js/ajax
- jQuery
    1.  .load(URL, data, callback)
    2.  $.get(URL, callback)
    3.  $.post(URL, data, callback)
    4.  $.ajax({
            type: "",
            url: "",
            data: "",
            success: function(){}
        })

# GET vs POST

GET
- 请求的数据会附在 URL 之后, 以 ? 分割 URL 和传输数据, 参数之间以 & 相连
- 数据量限制由 URL 长度(由浏览器决定, HTTP 规范没有对 URL 进行长度限制)决定
- 安全性相对较低
POST
- 把提交的数据则放置在是 HTTP HEADER 内传送到 action 属性所指的 URL 地址
- HTTP 也没有对 POST 进行长度限制, 决定其最大长度的是服务器处理能力和配置值
- 安全相对较高

GET data can exist in a POST request, because it is simply part of the URL being requested and doesn't rely on the request method

# `rawurlencode()`/`rawurldecode()` vs `urlencode()`/`urldecode()`

Raw is binary safe. This means that if you want to transfer binary data over the web, you should use raw

# 如何加快页面加载速度

前端:

- 代码优化(减少冗余, 优化算法)
- 减少 HTTP 请求(合并脚本, css等; 使用sprint)
- 使用 CDN
- 在 .htcaccess 中使用 Expires Header, 缓存文件到客户机器
- Gzip压缩文档 (js, css, 图片)
- 代码位置调整 (js 置底, css 置顶)
- 结构, 样式, 行为分离
- 避免重定向

PHP:

- 代码优化
- 缓存
    + 数据缓存: memcache, adodb 等
    + php缓存: eaccelerator, apc, phpa, xcache
    + 模板缓存(静态化): smarty 等
    + 反向代理 web 缓存: Nginx, souid, mod_proxy
- 压缩
- 负载均衡

硬件

# 负载均衡

就是将负载(工作任务)进行平衡, 分摊到多个操作单元上进行执行, 从而共同完成工作任务
分为 软件/硬件/本地/全局 四种实现方式

# `echo`, `print`, `print_r`, `var_dump`, `var_export` 的区别

下两个是语言结构, 可不用括号传参, 也不能被可变函数调用

- `echo`: 可用 ',' 同时输出多个变量; 比 print 快一点; 不返回, 所以不能用于表达式中
- `print`: 不能用 ',' 同时输出多个变量; 比 echo 慢一点; 总是返回 1, 所以能用于表达式中

下面的是函数, 必须要括号传参, 可以被可变函数调用

- `printf`: 输出格式化后的字符串; 第一个参数定义格式(用%b,%c,%d...占位), 其他参数为代替占位符的变量
- `print_r`: 打印关于变量的易于理解的信息; 只能输出一个变量;
    第二个参数用于决定是否返回字符串
- `var_dump`: 相较于 print_r, 会打印变量类型等更多详细信息, 多用于调试, 可一次输出多个变量

# 什么是模板技术

模板技术是为了实现美工与程序的分离, 更利于两个分工合作

一般可以用三个文档来实现, 比如 getnews.php 用来获取数据, 由程序员维护, shownews.php 用来展示数据, 由美工来维护, listnews.php(include getnews,include shownews, str_replace替换标签变量) 用来连接两者; 大致也对应于 MVC 模型的三个模块

# Smarty 优点

smarty 是 一个 php 模板引擎

smarty 优点:

速度: 相对于其它的模板引擎技术而言的可获得最大速度的提高

编译型: 在运行时要编译成一个非模板技术的PHP文件, 这个文件采用了PHP与HTML混合的方式, 在下一次访问模板时将WEB请求直接转换到这个文件中, 而不再进行模板重新编译(在源程序没有改动的情况下)

缓存技术: 将用户最终看到的 HTML  文件缓存成一个静态的 HTML 页, 当设定 smarty 的 cache 属性为 true 时, 在 smarty 设定的 cachetime 期内将用户的 WEB 请求直接转换到这个静态的 HTML 文件中来, 这相当于调用一个静态的 HTML 文件

插件技术: smarty可以自定义插件, 插件实际就是一些自定义的函数.

使用if/elseif/else/endif. 非常方便的对模板进行格式重排

# Smarty 缺点

不适合小项目使用, 会丧失 php 快速开发的特性

不适合在实时更新(股票)的项目中使用

因为多一层东西, 所以肯定比原生代码要浪费内存和 cpu 执行时间

# 对 MVC 的认识

M(odel), V(iew), C(ontroller)

优势: 分散关注, 松散耦合, 逻辑复用, 标准定义, 使同一个程序可以使用不同的表现形式

# 值传递和引用传递的区别, 用于什么情况

值传递: 将值传递给目标变量, 会为目标变量开辟新的内存空间, 修改目标变量不会改变原变量

引用传递: 将地址传递给目标变量, 是目标变量和原变量指向同一个内存空间, 可以理解为别名, 改变目标变量的值原变量也会改变

如果程序比较大, 引用同一个对象的变量比较多并且希望用完该对象后手工清除它, 建议用 `&` 方式, 然后用 `$var = null` 的方式清除; 对于大数组的传递, 建议用 `&` 方式, 毕竟节省内存空间使用

用途: 变量引用传递, 函数引用传参, 函数引用返回, 对象默认即为引用传递(see php-syntax.md)

# 如何验证邮箱

- 使用内置函数: `filter_var($email, FILTER_VALIDATE_EMAIL);` (推荐)
- 使用第三方库
- 使用正则

```php
function checkEmail($str) {
    $pattern = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
    return preg_match($pattern, $str);
}
```

# 显示当前脚本路径

1.echo $_SERVER['REQUEST_URI'];
2.echo $_SERVER['SCRIPT_FILENAME'].'?'.$_SERVER['QUERY_STRING'];

# `error_reporting()` 可以设定的错误报告级别

- 0
- E_NOTICE
- E_WARNING
- E_PARSE
- E_ERROR
- E_ALL | -1

# 设置自增属性的列必须是

主键或者加 UNIQUE 索引

# 如何解决大流量问题

硬件: 升级
软件配置: 防盗链, 缓存, 控制大文件下载, 主从分离
php 代码: 静态化

# 什么是面向过程, 面向对象, 为什么使用, 特点

面向过程就是分析出解决问题所需要的步骤, 然后用函数把这些步骤一步一步实现, 使用的时候一个一个依次调用就可以了;

面向对象是把构成问题事务分解成各个对象, 建立对象的目的不是为了完成一个步骤, 而是为了描叙某个事物在整个解决问题的步骤中的行为, 将现实世界抽象成对象, 将他们的关系抽象成继承, 类等;

对象的数据抽象为属性, 对象的操作抽象为方法

OO 特点: 重用性, 灵活性, 扩展性; 封装, 继承, 多态

# `include`, `include_once`, `require`, `require_once`

require VS include:

1. 如果引用文件找不到或者引用时出错, `require()` 会产生错误并中止程序运行; 而 `include()` 会产生警告并忽略错误, 继续执行
2. `require()` 不能在循环体中根据条件的不同而包含不同的文件. `require()` 语句只会在第一次执行时调用它所包含的文件中的内容替换本身这条语句, 当再次被执行时只能执行第一次所包含的语句. 但是 `include()` 语句可以在循环体中来包含不同的文件
3. `require()` 函数不进行计算, 在条件控制语句中, 即使条件为假, 被引用文件也要包含进来(当然不会执行被引用的文件了), 增加系统负担; 而 `include()` 要进行计算, 在条件控制语句中, 如果条件为假, 被引用文件不会包含进来, 仅在条件为真时才包含

require VS require_once / include VS include_once:

_once 会检查是否已经包含, 如果包含过了则不再进行包含, 即只包含一次

# 常用 http 状态代码

- 200         OK
- 301         moved permanently
- 304         not modified
- 400         Bad Request
- 401         Unauthorized
- 402         Payment Required
- 403         Forbidden
- 404         Not Found

# mysql 取得当前时间和格式化日期函数

`now()`, `date_format()`

# 版本控制工具

git, svn(subversion), cvs

# 不用第三个变量, 把两个变量的值交换

```php
$a=1111;
$b=2222;
$b=explode("|",$a."|".$b);
$a=$b[1];
$b=$b[0];
```

或

`list($a, $b) = array($b, $a);`

# 编写正则取出 value 值 (<input value='text' />)

`(?<=value=")|(?<=value=')[^\"\'.]*`

# 输出昨天此刻时间

1. `echo date("Y-m-d H:i:s",strtotime("-1 day"));`
2. `echo date('Y-n-j H:i:s', time()-60*60*24);`

# 写出两种连接数据库的方法

```php
mysql_connect("主机名","用户名","密码");
mysql_select_db("数据库名");
```

或

`$pdo=new PDO(mysql:host="主机名",dbname="数据库名","用户名","密码");`

# 实现字符串反转

`strrev()`

或

```php
$str = 'test';
for($i = 1; $i <= strlen($str); $i++) {
    echo substr($str, -1, 1);
}
```

# 实现中文字符串截取无乱码

按字来切分字符:

```php
mb_substr('中文乱码问题的解决方法', 0, 7, 'utf-8'); // 中文乱码问题的
```

或按字节来切分字符

```php
mb_strcut('中文乱码问题的解决方法', 0, 7, 'utf-8'); // 输出：中文乱
```

# 获取服务器 ip

`$serverip = gethostbyname($_SERVER['SERVER_ADDR']);`

# 获取客户端 ip

```php
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
```

# 取得 `baidu.com/index.html` 的内容

`file_get_content($url)`

# 写正则

找到一个字符串中所有大写的字母, 并在它后面加上匹配到它时的次数
比如 " A c B d e F G " 变成 " A1 c B2 d e F3 G4 "

```php
$str = 'A bcD eFG hHi J 12%I';
$pattern = '/[A-Z]/';
function replace($matches) {
    static $i=1;
    $matches[0] = $matches[0].$i;
    $i++;
    return $matches[0];
}
echo preg_replace_callback($pattern, 'replace', $str);
```

# JS 重定向页面

1. `window.location.href = 'url';`
2. `window.location.assign('url');`

# `mysql_fetch_row()` VS `mysql_fetch_assoc` VS `mysql_fetch_array()`

- row : 返回一行作为枚举数组
- assoc : 返回一行作为关联数组
- array : 返回一行作为枚举或关联数组, 或兼有

# 如何获取图像大小

- `getimagesize()`
- `imagesx()`
- `imagesy()`

# 写出下面程序的输出

```php
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
```

```
1
11
7
1
```

# 实现防止表单重复提交

- 使用 js, 第一次提交后就禁用提交按钮
- 使用 js, 利用 onsubmit 事件处理程序取消后续的表单提交操作
- 使用 Session 存取 token 在后端检查是否重复提交
- 使用 PRG(Post->Redirect(303)->Get) 模式

# 运行下面的代码, $text 的值是多少? strlen($text)又会返回什么结果?

```php
$text = 'John ';
$text[10] = 'Doe';
```

上面代码执行完毕后 $text = "John D"(John后面会有连续的5个空格), strlen($text)会返回 11

$text[10] = "Doe"给某个字符串具体的某个位置具体字符时候, 实际只会把 D 赋给$text. 虽然 $text 才开始只有 5 个字符长度, 但是 php 会默认填充空格. 这和别的语言有些差别

# 执行下面代码 `$x` 会变成什么值呢?

```php
$x = NULL;

if ('0xFF' == 255) {
    $x = (int)'0xFF';
}
```

实际的运行结果是 $x=0 而不是255.

首先 'oxFF' == 255 我们好判断, 会进行转换将 16 进制数字转换成 10 进制数字, 0xff -> 255.

PHP 使用 is_numeric_string 判断字符串是否包含十六进制数字然后进行转换.

但是 `$x = (int)'0xFF';` 是否也会变成 255 呢? 显然不是, 将一个字符串进行强制类型转换实际上用的是 `convert_to_long`, 它实际上是将字符串从左向右进行转换, 遇到非数字字符则停止. 因此0xFF到x就停止了. 所以 $x=0

# 写一个函数, 尽可能高效的, 从一个标准 url 里取出文件的扩展名

例如: `http://www.phpddt.com/abc/de/fg.php?id=1` 需要取出 php 或 .php

```php
$url = "http://www.phpddt.com/abc/de/fg.php?id=1";
$path = parse_url($url);
echo pathinfo($path['path'],PATHINFO_EXTENSION);
```

# 写一个函数, 能够遍历一个文件夹下的所有文件和子文件夹

```php
function deepScan($path, &$level = 0) {
    static $prevIsDir = false; //  上次递归是否是目录
    if (is_dir($path)) {
        $indent = str_repeat("\t", $level);
        $dir = opendir($path);
        while (($file = readdir($dir)) != false) {
            if ($file != '.' && $file != '..') {
                echo "{$indent}{$file}\n";
                if (is_dir($subDir = ($path . '/' . $file))) {
                    ++$level;
                    deepScan($subDir, $level);
                    $prevIsDir = true;
                } else if ($prevIsDir) { // 上次递归是目录, 且本次非目录
                    --$level;            // 层级减一
                    $prevIsDir = false;
                }
            }
        }
    }
}
```

# 编写函数实现无极限分类

```php
function tree($arr, $pid = 0, $level = 0) {
    static $list = array();
    foreach ($arr as $v) {
        if ($v['parent_id'] == $pid) {
            $v['level'] = $level;
            $list[] = $v;
            tree($arr, $v['cat_id'], $level+1);
        }
    }
    return $list;
}
```

# 获取用户输入参数的三个方法

- argc, argv
- `getopt()`
- `fwrite(STDOUT, 'Enter your name'); name = fget(STDIN);`

# posix 和 perl 标准的正则表达式区别

# Safe_mode 打开后哪些地方受限

# 测试 php 性能和 mysql 数据库性能的工具, 和找出瓶颈的方法

# 常见的SSO(单点登陆)方案

# Makefile的基本格式, gcc 编译, 连接的命令,-O0 和-O3区别

# gdb,strace,valgrind的基本使用

# echo 8%(-3) 输出什么

2

# 给你 256M 的内存, 对 10G 的文件进行排序(文件每行 1 个数字), 如何实现?

# 对 10G 的文件进行查找如何实现?

# 统计 10G 文件每个关键字出现的次数如何实现?

# 一个 10G 的表,你用 php 程序统计某个字段出现的次数, 思路是?

# 应对高访问量和突发访问量(秒杀, 抢票, 12306): 服务器架构/数据存储

# nginx 配置一下 rewrite 指定到某个具体路径?

# 多线程和多进程的区别为?

# hash 碰撞原理为? 如何进行修复?

# 假如两个单链表相交, 写一个最优算法计算交点位置, 说思路也可以?

# 不优化前提下, apache 一般最大连接数为? nginx 一般最大连接数为?

# mysql 每秒 insert ? select ? update ? delete?

# nginx 设置缓存 js、css、图片等信息, 缓存的实现原理是?

# 如何提高缓存命中率? 如何对缓存进行颗粒化?

# php 的内存回收机制是?

# 用 javascript 写一个函数, 删除数组中重复的元素

```js
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
```

# 以下结果为真的表达式

A. null instanceof Object
B. null === undefined
C. null == undefined
D. NaN == NaN

C

# 以下可以获取 foo 对象 att 属性值的是(A, C, E):

A. foo.att
B. foo("att")
C. foo["att"]
D. foo{"att"}
E. foo{"a" + "t" + "t"}

A C E

# 列举三种添加事件的方法

- HTML: `<img onclick="alert('hello');"`
- DOM0: `img.click(function() {})`
- DOM2: `img.addEventListener("click", function() {});`
- IE: `img.attachEvent("onclick", function() {}); `

# 写出三种产生一个 image 标签的方法

- `var img = new Image()`
- `var img = document.createElement("image")`
- `img.innerHTML = "<img src='xxx.jpg' />"`

# 使用 JS 让网页前进或后退

- `history.go(1)`, `history.back()`
- `history.go(-1)`, `history.forward()`

# 实现中文截取无乱码

- 使用 `mb_substr()`
- 自定义函数

```php
function substrUtf8($str, $start, $length = null) {
    return implode("", array_slice(
        preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY)));
}
```

# 实现中文字符数计数

- 使用 `mb_strlen()`
- 自定义函数

```php
function strlenUtf8($str) {
    return count(preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY));
}
```

# 用最少代码定义一个求三个数中最大值的函数

```php
function max($a, $b, $c) {
    return $a > $b ? ($a > $c ? $a : $c) : ($b > $c ? $b : $c);
}
```

# 将 1234567890 转换为 1,234,567,890 每三位用逗号分隔的形式

- 使用内置 `number_format()` 或 `money_format()`
- 自定义函数

```php
    function sep($str) {
        $str = strrev($str); // 0987654321
        $str = chunk_split($str, 3, ','); // 098,765,432,1,
        $str = strrev($str); // ,1,234,567,890
        $str = ltrim($str, ','); // 1,234,567,890
        return $str;
    }
```

# `echo count("abc");` 输出什么

输出 1

count():
- 计算数组中的哦单元数目
- 对象中(必须已经实现 spl Countable::count() 方法) count() 方法返回的数值
- null 则返回 0
- 任何其他类型(包括没有实现 Countable 接口的对象)都返回 1

# 写五个获取一个全路径的文件扩展名的函数

```php
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
```

# `in_array('01', array('1'));` 是 true 还是 false

true

# 下面程序输出

```php
$a = 'hello';
$b = &$a;
unset($b);
$b = 'world';
var_dump($a);
```

hello

# 下面程序输出

```php
$test = 'aaaaaa';
$abc = &$test;
unset($test);
echo $abc;
```

'aaaaaa'

# 写一个函数, 将 open_door 转换为 OpenDoor

```php
function ul2Camel($str) {
    $arr = explode('_', $str);
    $arr = array_map('ucfirst', $arr);
    return implode('', $arr);
}
```

# 以下程序 $val 的值为(array(2, 3, 7), 参见手册)

$val = max('string', array(2, 3, 7), 42);

# 输出北京时间, 格式为 yyyy-mm-dd hh:mm:ss

```php
date_default_timezone_set('PRC');
echo date('Y-m-d H:i:s', time());
```

# 简述 GBK, GB2312, BIG5, GB18030

- GBK2312 支持汉字较少
- GBK 比 GBK2312 汉字更为丰富, 简体中文一般使用 GBK
- GB18030 比 GBK2312 增加一些少数民族汉字
- 繁体中文一般使用 BIG5

# 下面程序输出

```php
$count = 5;
function getCount() {
    static $count = 0;
    return $count++;
}
echo $count;
++$count;
echo getCount();
echo getCount();
```

501

# 下面程序输出

```php
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
```

51 @?

# 下面程序可行吗

```
    <?php
    class Foo{
    ?>
    <?php
        function bar() {}
    }
    ?>
```

不可行, 因为不同于函数, 类定义必须在同一个 <?php ?> 内

# 如何备份 mysql 数据库

- `mysqldump -u username -p password database table > singleTable.sql`
- `mysqldump -u username -p password database table1 table2 ... > multiTable.sql`
- `mysqldump -u username -p password database > allTable.sql`
- `mysqldump -u username -p password -B database > database.sql`

# MySQL 的 char 和 varchar 有何区别

char 长度固定, varchar 长度不固定

当插入的字符串超出长度时:
- 严格模式: 拒绝插入并提示错误信息
- 宽松模式: 截取然后插入

当插如的字符串不够长度时:
- char: 不足处用空格填满
- varchar: 插入多少就保存多少

存储容量不同
- char: 最多 255 个, 和编码无关
- varchar: 最多 65532 个字符, 和编码有关.
  其最大有效长度最大行大小和字符集确定
  varchar 存字符串时, 第一个字节为空, 还需两个字节存放字符串长度, 此时有效长度为 65535-1-2=65532. 此时, 如果字符集为单字节, 如 Latin1, 最多能存放 65532 个字符; 如果是双字节, 如 GBK, 最多能存放 65532/2 = 32766 个字符; 如果是三字节, 如 UTF8, 最多能存放 65532/3 = 21844 个字符.

char 效率更高, 但没有 varchar 灵活

注意: char 和 varchar 后面的长度表示字符个数, 而非字节数

# 若一个表定义为 `create table t1 (c1 int, c2 char(30), c3 varchar(N)) charset=utf8;` 则 N 的最大值为多少?

(65535(行大小)-1(空字节)-2(长度字节)-4(c1)-30*3(c2)) / 3

# IP 应如何保存

存为整形, 可以使用 php 或 mysql 提供的函数将 IP 转换为整形
- php: ip2long(); long2ip()
- mysql: inet_aton(); inet_ntoa()

# 用 php 获取 mySQL 中下一个自增长 id

- 使用 show table status, 然后获取 auto_increment 的值
- 使用 select max(id) + 1 from table
- 如果是刚插入记录, 可以使用 last_insert_id() + 1

# PHP 访问数据库有哪几步

1. 连接数据库服务器
2. 选择数据库
3. 设置字符集
4. 执行 sql 语句
5. 处理结果集
6. 关闭结果集, 释放资源
7. 关闭数据库连接

# 如何确保 MySQL 正确保存 UTF8 数据

1. 确保数据表是 utf8
2. 确保 .php 文件是 utf8
3. 执行 set names utf8
4. 对于不是 utf8 编码的文本, 使用 iconv() 转码成 utf8 再保存到数据库
5. 确保 html 是 utf8
    - `<meta http-equiv="Content-type" value="text/html;charset=utf8" />`
    - `header("content-type:text/html;charset=utf8");`

# 打开 safe mode 会影响哪些函数

move_uploaded_file(), chdir(), fopen(), mkdir(), rmdir(), dl(), shell_exec(), backtick operator, set_time_limit(), putenv(), exec(), system(), passthru()...

# 写一段 PHP 代码, 确保多个进程写入文件成功

```php
$fp = fopen('lock.txt', 'w+');
if (flock($fp, LOCK_EX)) {
    fwrite($fp, 'content');
    flock($fp, LOCK_UN);
} else {
    echo 'file is locked';
}
fclose($fp);
```

# 写一个函数, 能计算两个文件的相对路径, 如 a/b/12/34/c.php 相对于 /a/b/c/d/e.php 的路径是 ../../c/d

```php
function relativePath($a, $b) {
    $a = explode('/', dirname($a));
    $b = explode('/', dirname($b));
    for ($i = 0, $len = count($b);  $i < $len; $i++) {
        if ($a[$i] != $b[$i]) {
            break;
        }
    }
    if ($i < $len) {
        $ret = array_fill(0, $len-$i, '..');
    }
    $ret = array_merge($ret, array_slice($a, $i));
    return implode('/', $ret);
}
```

# 获取 http://baidu.com/index.html 的内容

```php
$fh = fopen('http://baidu.com/index.html', 'rb');
$content = stream_get_contents($fh);
fclose($fh);
echo $content;
```

或

`echo file_get_contents('http://baidu.com/index.html');`

# GD 库是做什么的

PHP 内置的处理或生成图片的 api, 通常用于生成缩略图或加水印或生成表报

# 使用 PHP 实现页面跳转

- `header('Location:b.php');`
- `header('refresh:3; url=b.php');`
- `echo '<meta http-equiv="refresh" content="0;url=b.php" />'`

# 如何去除文件中的 HTML 标签

- 使用内置函数: `strip_tags()`
- 自定义函数

```php
function stripHTMLTags($str) {
    $pattern = '/<(.+?)[\s]*\/?[\s]*>';
    return preg_replace($pattern, '', $str);
}
```

# 如何验证一个字符串是否是有效的日期

```php
function validateDate($date) {
    return $date == date('Y-m-d', strtotime($date));
}
```

# 说几个模板引擎

smarty, twig, blade, volt, mustache, Plates

# 使对象可以像数组一样进行 foreach 循环

实现 Iterator 接口

```php
class Cls implements Iterator
{
    private $container = array(
        'okay',
        'yeah',
        'I do'
        );

    public function rewind()
    {
        reset($this->container);
    }

    public function current()
    {
        return current($this->container);
    }

    public function next()
    {
        return next($this->container);
    }

    public function valid()
    {
        return ($this->current() !== false);
    }

    public function key()
    {
        return key($this->container);
    }
}
```

# 用 PHP 实现双向队列

```php
class Deque
{
    private $container = array();

    public function addFirst($item)
    {
        return array_unshift($this->container, $item);
    }

    public function removeFirst()
    {
        return array_shift($this->container);
    }

    public function addLast($item)
    {
        return array_push($this->container);
    }

    public function removeLast()
    {
        return array_pop($this->container);
    }
}
```

# 对数组 [10, 2, 36, 25, 5] 进行排序

冒泡排序

```php
function bubbleImprovedSort($arr) {
    $len = count($arr);
    for($i = 0; $i < $len; $i ++) {
        $noswap = true; // 用于指示是否还需要继续判断, 默认不需要
        for($j = $len - 1; $j > $i; $j --) {
            if ($arr [$j] > $arr [$j - 1]) {
                $tmp = $arr [$j - 1];
                $arr [$j - 1] = $arr [$j];
                $arr [$j] = $tmp;
                $noswap = false; // 如果做出了排序更改, 则设为需要再判断
            }
        }
        if ($noswap) { // 检查是否需要继续判断, 否则返回数组
            return $arr;
        }
    }
}
bubbleImprovedSort([10, 2, 36, 25, 5]);
```

快速排序

```php
function partition(&$arr, $low, $high)
{
    $pivot = $arr[$low];
    while ($low < $high) {
        while ($low < $high && $arr[$high] >= $pivot) {
            $high--;
        }
        $arr[$low] = $arr[$high];

        while ($low < $high && $arr[$low] <= $pivot) {
            $low++;
        }
        $arr[$high] = $arr[$low];

    }
    $arr[$low] = $pivot;
    print_r($arr);
    return $low;
}

function quickSort(&$arr, $low, $high)
{
    if ($low < $high) {
        $pivot = partition($arr, $low, $high);
        quickSort($arr, $low, $pivot-1);
        quickSort($arr, $pivot+1, $high);
    }
}

$arr = [2, 5, 8, 3, 10, 1, 8, 7, 6];
quickSort($arr, 0, count($arr) - 1);
```

# 描述顺序查找和二分查找

顺序查找顺序表

```php
function seqSearch($array, $val)
{
    $array[] = $val;

    $i = 0;
    while ($array[$i] != $val) {
        $i++;
    }

    if ($i < (count($array)-1)) {
        return $i;
    }
    return -1;
}
```

二分查找有序表

```php
function binSearch($arr, $val)
{
    $low = 0;
    $high = count($arr) - 1;
    while ($low <= $high) {
        $mid = (int) ($low + $high) / 2;
        if ($val == $arr[$mid]) {
            return $mid;
        } else if ($val < $arr[$mid]) {
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }
    return 0;
}
```

# 给出约瑟夫问题的函数定义

```php
function josephus($n,$k){
    if($n ==1)
        return 1;
    else
        return (josephus($n-1,$k)+$k-1) % $n+1;
}
```

# 写出常用的 Linux 命令

top, ps, mv, find, df, cat, chmod, chgrp, grep, wc, ifconfig, ...

# 获取文件行数

`wc -l filename`

# 输入文件的最后 5 行到另一个文件

`tail -n 5 file1 >> file2`

# 说几个常用协议的简称, 有什么缩写以及端口

- SMTP: Simple Mail Transfer Protocal
- POP3: Post Office Protocal 3
- HTTP: HypterText Transfer Protocal: 80
- HTTPS: 443
- FTP: File Transfer Protocal: 21
- DNS: Domain Name System and Domain Name Service Protocal
- SSH: Secure Shell: 22
- telnet: 23

# 如何检查 PHP 脚本执行效率和 SQL 效率

- PHP: 启用 xdebug 配合 WinCacheGrind 分析
- MySQL: 启用 slow query log, 配合 EXPLAIN 语句分析

# 程序运行后, $a 和 $b 的值?

```php
$arr = [1, 2, 3];
unset($arr[0]);
list($a, $b) = $arr;
```

$a = NULL, $b = 2

unset($arr[0]) 之后, $arr[0] 值不再存在, list 报 undefined index, 依旧从 0 开始由左向右依次赋值

# 程序运行后, 输出什么?

```php
$count = 5;
function get_count() {
    static $count = 0;
    return $count++;
}
++$count;
get_count();
echo get_count();
```

输出 1, 如果函数改为 `return ++$count;` 则输出 2

# PHP 各框架比较

yaf, phalcon 都是用 C 写的 PHP 扩展, 性能因此比 PHP 框架高.

yaf 是超轻量级的 c 级别裸框架, 只集成了基本的视图和路由控制

而 phalcon 几乎完整的实现了其他 PHP 框架的功能特点, 在性能和功能上做了一个比较好的平衡, 但是门槛较高

laravel 和 Yii2 都使用 composer

laravel 优雅规范现代, 最流行, 强大的 ORM 和封装功能, 牺牲一些性能

ci 轻量, 无需额外命令行或软件, 大量类库, 门槛低

# PHP 各框架自动加载机制

- CI  <https://stackoverflow.com/questions/22249541/codeigniter-autoload-specific-classes>

通过配置文件 `application/config/autoload.php` 配置全局加载的类. 也可以通过此文件配置为通过 composer 自动加载机制加载

可以在 controller 中使用 `$this->load` 动态加载类

- Yaf <https://www.php.net/manual/zh/class.yaf-loader.php>

通过 `Yaf_Loader ` 类自动全局注册 `yaf.library` 配置的路径中的类. 也可以通过 `Yaf_Loader::registerLocalNameSpace()` 注册本地类前缀

支持 PSR0 (pear) 和 PSR4 两种, 支持自动通过类后缀识别是否是 MVC 类并从对应目录加载类

- Phalcon <https://docs.phalconphp.com/3.4/zh-cn/loader>

使用 `Palcon\Loader` 类

```php
// Creates the autoloader
$loader = new Loader();

// 1. Register some namespaces -> PSR4
$loader->registerNamespaces(['Name\Space'    => 'vendor/name/space']);
// 2. Register some directories, not recommended in terms of performance
$loader->registerDirs(['library/MyComponent']);
// 3. Register some classes, not recommended, can be very cumbersome
$loader->registerClasses(['Example\Base' => 'vendor/example/adapters/Example/BaseClass.php']);
// 4. Register some classes, useful for including files that only have functions
$loader->registerFiles(['functions.php', 'arrayFunctions.php']);

// Register autoloader
$loader->register();
```

- ThinkPHP <https://www.kancloud.cn/thinkphp/thinkphp5-guide/90114>

使用 `\think\Loader`

默认自动根据命名空间, 按如下顺序依次加载
1. 优先检测是否存在注册过的根命名空间 (通过 `::addNamespace('org',MY_PATH.'org/')` 注册)
2. 检测composer自动加载的类库
3. 然后检测核心目录（LIB_PATH）下是否存在根命名空间的对应子目录
4. 检测是否应用类库(APP_PATH)命名空间
5. 检测扩展类库目录（EXTEND_PATH）下是否存在根命名空间对应的子目录

也可以通过 `::addMap('think\Log',LIB_PATH.'think\Log.php')` 指定文件映射

以及通过 `::import('org.util.array')` 手动加载

- Yii, Laravel: 使用 composer 自动加载

# 常用排序算法

see <https://github.com/m9rco/algorithm-php/tree/master/src/Sort>

# 字符串相乘

> 给定两个以字符串型时表示的非负整数 num1, num2, 返回 num1, num2 的乘积, 他们的乘积也表示为字符串形式.
> 如输入 num1 = "123", num2 = "456", 输出 "56088"

see <https://blog.csdn.net/m0_38027358/article/details/74276057>

```php
function multiply($a, $b) {
    // 反转字符串
    $a = strrev($a);
    $b = strrev($b);

    // 建立temp变量
    $arr = array();
    for ($i=0; $i < (strlen($a) + strlen($b)); $i++) {
        $arr[$i] = '0';
    }

    // 依次相乘叠加, 得出各个数位值
    for ($i = 0; $i < strlen($a); $i++) {
        for($j = 0; $j < strlen($b); $j++) {
            $arr[$i+$j] = $arr[$i+$j] + ($a[$i] * $b[$j]) % 10;  // 当前之和
            $arr[$i+$j+1] = $arr[$i+$j+1] + floor(($a[$i] * $b[$j]) / 10);  // 进位之和
        }
    }
    // print_r($arr); die;

    // 再次相乘叠加, 把各个数位上大于或等于 10 的值进位到高一位
    for ($i = 0; $i < count($arr) - 1; $i++) {
        $arr[$i+1] = $arr[$i+1] + intval($arr[$i]/10);   // 进高位
        $arr[$i] = $arr[$i]%10;                        // 当前位余留
    }
    // print_r($arr); die;

    // 去除高位无用的 0
    $result = implode('', array_reverse($arr));
    return ltrim($result, '0');
}

echo multiply("456", "123");
```

# 计算存水量

> 约定 n 个非负整数表示每个宽度为 1 的柱子的高度图, 就散按此排列的柱子, 下雨之后能接多少雨水
> 如 [0, 1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1] 输出 6

```php
function capacity($posts) {
    // 找出所有端点柱子索引
    $peaks = [];
    for ($i = 0; $i < count($posts); $i++) {
        $higherLeft = $higherRight = false;
        if (! isset($posts[$i-1]) || $posts[$i] >= $posts[$i-1]) {
            $higherLeft = true;
        }
        if (! isset($posts[$i+1]) || $posts[$i] >= $posts[$i+1]) {
            $higherRight = true;
        }
        if ($higherLeft && $higherRight) {
            array_push($peaks, $i);
        }
    }

    // 遍历所有端点柱之间的洼地柱, 计算并累加其容量
    $capacity = 0;
    foreach ($peaks as $peak) {
        if (count($peaks) == 1) {
            break;
        }

        list($left, $right) = $peaks;
        $bottleNeck = min($posts[$left], $posts[$right]); // 瓶颈柱高
        for ($i = $left + 1; $i < $right; $i++) {
            $capacity += $bottleNeck - $posts[$i];
        }
        array_shift($peaks);
    }

    return $capacity;
}

echo capacity([0, 1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1]);
```

# Redis 集中数据结构

- string 字符串
- list 列表
- set 集合
- hash 散列
- zset 有序集合

# Redis 各数据类型内部存储

see <https://www.jianshu.com/p/f09480c05e42>

Link

implemented via Linked Lists
- pro: adding element performed in constant time
- con: accessing element not so fast -> use sorted list

Hash

# 如何优化数据库

see <https://juejin.im/post/5c2c53396fb9a04a053fc7fe>

设计

- 三大范式与适度反范式
- 选择适当的字段类型
- 选择适当的存储引擎
- 适当建立索引(create index) - 经常作为查询条件,区分度高的字段
- 适当使用外键
- 水平 | 垂直划分表

SQL 语句
- 使用 explain/慢日志工具分析
- 使用 limit, 避免 select *,
- 使用连接查询 (JOIN) 替代子查询 (SUBQUERY)
- 使用存储过程
- 使用联合 (UNION) 替代手动创建临时表
- 尽量少使用 LIKE 关键字和通配符

数据库配置

- 主从复制, 读写分离
- 负载均衡
- 分区

硬件/操作系统

# session vs cookie

Session 工作原理: Session 储存于服务器端( 默认以文件方式存储 session ),  并通过 session id 标识这个 session

Cookie 工作原理: Cookie 存储于客户端, 通过页面 HTTP 头传给 php 页面并自动生成为 $_COOKIE 超全局数组. Cookie 可分为非持久(内存) Cookie 和持久(硬盘) Cookie 两种

联系: Session 在默认情况下是使用客户端的 Cookie 来保存 session id 的, 所以当客户端的 Cookie 出现问题的时候就会影响 session 了. 但是 Session 不一定必须依赖 Cookie, 当客户端的 Cookie 被禁用或出现问题时, PHP会自动把 session id 附着在 URL 中, 这样再通过 session id 就能跨页使用 session 变量了. 但这种附着也是有一定条件的, 即 php.ini 中的 session.use_trans_sid = 1 或者编译时打开打开了--enable-trans-sid 选项

# 简述 session 生存时间机制

`session.gc_maxlifetime` 配置决定 session 数据过多久之后会被当做垃圾, 以便被垃圾回收器回收

`session.gc_probability` 和 `session.gc_divisor` 配置共同决定当 `session_start()` 时, 垃圾回收器运行的概率

当 `session.save_handler` 为默认的 `file` 时, session 文件是否过期是由 mtime(modified time) 决定, 而非 atime(accessed time), 这会导致 session 文件由于长期没更新而使垃圾回收器过早回收依然有效的 session 数据

`session.cookie_lifttime` 决定 cookie 的过期时间, 由于 session 生存时间应该由服务器端决定, 所以这个参数实际上用处不大

最好的方案是自己实现 session 过期机制:

```php
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
                                     // this update mtime, too. prevent
                                     // gc collector from gc session
                                     // prematurely
```

相关函数:
- `session_save_path()`
- `session_set_cookie_params()`

# 修改 session 生存时间

可以通过修改 `php.ini` 文件:

确保 `session.gc_maxlifetime` 与 `session.cookie_lifetime` 一致, 同时确认 `session.use_cookies = 1`

也可以用程式控制:

```php
$savePath = "./session_save_dir/";
$lifeTime = 24 * 3600;
session_save_path($savePath);
session_set_cookie_params($lifeTime);
session_start();
```

# 如何实现多服务器共享 session

使用 mySQL 数据库存储并共享 session 数据

# 大型网站中 Session 方面应注意什么

如果使用默认的 file session_headler 的话, 会非常影响大访问量网站的性能. 考虑适用数据库来存储 session 数据

# PHP 代码优化

see <https://learnku.com/articles/4685/php-application-performance-tuning-guide>

# 使用 Php 写一个查找两个数组不同元素的功能

```php
$a = [1, 3, 5, 'a', 'c'];
$b = [3, 4, 'b', 'a'];

function diff($a, $b) {
    $result = [];
    foreach ($a as $needle) {
        foreach ($b as $search) {
            if ($needle == $search) {
                continue 2;
            }
        }
        array_push($result, $needle);
    }
    return $result;
}

var_dump(diff($a, $b));
```

# 下载图片文件到本地

```php
$imageUrl = 'https://www.baidu.com/img/bd_logo1.png';

// 1. fopen()
$f0 = fopen('./f0', "wb");
$image = fopen($imageUrl, "rb");
while ($chunk = fread($image, 1024)) {
    fwrite($f0, $chunk, 1024);
}
fclose($image);
fclose($f0);

// 2. file_get_contents()
$f1 = fopen('./f1', 'wb');
$image = file_get_contents($imageUrl);
fwrite($f1, $image);
fclose($f1);

// 3. stream_get_contents()
$f2 = fopen('./f2', 'wb');
$image = stream_get_contents(fopen($imageUrl, 'rb'));
fwrite($f2, $image);
fclose($f2);

// 4. curl
$ch = curl_init($imageUrl);
$f3 = fopen('./f3', 'wb');
curl_setopt($ch, CURLOPT_FILE, $f3);
curl_exec($ch);
curl_close($ch);
fclose($f3);

// 5. gd
$f4 = fopen('./f4', 'wb');
$image = imagecreatefrompng($imageUrl);
imagepng($image, $f4);
fclose($f4);
```