form action为空时, 默认是本页面php代码执行
setsession() 和setcookie() 必须位于 <html> 标签之前

基于 Unix 的系统使用 \n 作为行结束字符, 基于 Windows 的系统使用 \r\n 作为行结束字符, 基于 Macintosh 的系统使用 \r 作为行结束字符

urlencode() VS rawurlencode()
    两个都是把除  -_.  之外的所有非字母数字字符都将被替换成百分号 (%) 后跟两位十六进制数, 唯一不同是 urlencode 把空格替换成 +, 而 rawurlencode 把空格替换成 %20
    rawurlencode 兼容性更强
    urlencode 适合用于编码 url 路径部分(?之前); rawurlencode 适合编码请求字符串部分

htmlspecialchars() VS htmlentities()
    htmlspecialchars 将 < > " & 转换为对应的实体 (&lt; &gt; &amp; &quot;)
    htmlentities() 将所有有对应实体的字符转换为对应实体

strip_tags() VS nl2br()

Hash 算法
    MD5     // not recommended
    SHA-1       // theory say could be hacked
    SHA-2(SHA-256, SHA-512)
    Whirlpool, Tiger,AES
    Blowfish    // recommended
Hash 函数
    md5()
    sha1()
    hash()
    crypt()
    salt()

- 除非打开 output buffering, header() 之前不能有任何输出
- 可以在 php.ini 里打开 output buffering, 也可以用 ob_start() 在页面级打开( 参见 ob_end_flush(),
  ob_get_contents(), ob_end_clean() )
- header() 和 ob_start() 之前不能有任何输出
- One mistake that is easy to make with the Location header is not calling exit directly afterwards (you
  may not always want to do this, but usually you do). The reason this is a mistake is that the PHP code of
  the page continues to execute even though the user has gone to a new location. In the best case, this
  uses system resources unnecessarily. In the worst case, you may perform tasks that you never meant to
- you must never trust request headers for information that is important to the security of your site

epoch time === unix timestamp

Cache Strategy
    1. Code level (variable, static variable)
        Pro: independent of any external extensions
        Con: not shared between PHP processes; difficult to invalidate
    2. OpCode Cache (APC)
        Pro: persist between multiple requests
        Con: not distributed
    3. Memory Cache (Memcached, Redis)
        Pro: distributed;
        Con: slower than APC
    4. In-memory database tables (MySql Memory engine)
    5. File/Output Cache (Ob, serialize)
    6. Query cache
    7. Apache cache


=============== Coding Standard ===============
- 4 *space*, not tab
- Line at most 75-85 characters
- One space between control keywords(if,else,for,while,switch...)
- No space between function name,opening parenthesis and the first parameter; space between commas and each parameter; no space between the last parameter and closing parenthesis and the semicolon
- Always use curly braces
- Always attempt to return a meaningful value from a function if one is appropriate

=============== Coodie ===============
// if $a is false then set it to 'default'
$a = $a || 'default';

// you can do things with += and + like this:
$a += $a + 1;

function $increment(){
    static $var = 0;
    $var ++;
    return $var;
}
$a =& increment();
increment()
$a ++;
echo $a;

/**
 * test if $date is a valid date string
 * @return {boolean}
 */
function validateDate($date) {
    return $date == date('Y-m-d', strtotime($date));
}

/**
 * same as foreach($products as $option => $value) { }
 */
while (list($option, $value) = each($products)) { }

/**
 * psr code indentation style
 */
$ary = array(
    'key1' => 'value1',
    'key2' => 'value2',
    ...
);

$var = explode(',', $ary)[idx];

Random String
    1.substr(md5(rand()), 0, 20)
    2.substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30)

return $this at the end of method will make this method chainable

set utf8 header
    header('Content-Type: text/html; charset=utf-8');

/**
 * complicate array merging
 */
$ary1 = array(
    array(
        'sn' => '123',
        'name' => 'whatever',
        ),
    array(
        'sn' => '234',
        'name' => 'whatever',
        ),
    );
$ary2 = array(
    array(
        'sn' => '234',
        'gender' => 'female',
        ),
    array(
        'sn' => '123',
        'gender' => 'male',
        ),
    );
$res = [];
foreach (array_merge($ary1, $ary2) as $a) {
    $res[$a['sn']] = (isset($res[$a['sn']])) ? array_merge($res[$a['sn']], $a) : $a;
}

/**
 * in case of error when foreaching
 */
if(!is_array($models))
    $models=array($models);
foreach($models as $model) { //... }

=============== best practice ===============
declare variable before using them
?typehint everywhere, user assertions for scalars
use === instead of ==
use bracket to make your operator precedence more clear

- use the built-in password hashing functions to hash and compare passwords, it
  also salts your password for you
- favor PDO
- use only <?php ?> and <?= ?> tags
- use spl_autoload_register(), not autoload() to autoload your classes
- favor `define()` instead of `const` to define constant
- caching PHP opcode(APC)
- If you need a distributed cache, use the Memcached client library. Otherwise, use APCu
- serve PHP from a web-server use PHP-FPM
- use PHPMailer instead of built-in mail() function to send mail
- use filter_var() to validate email address
- UTF8
    - use the mb_* functions whenever you operate on a Unicode string
    - use the mb_internal_encoding() function at the top of every PHP script you
      write (or at the top of your global include script), and the mb_http_output()
      function right after it if your script is outputting to a browser
    - always explicitly indicate UTF-8 when given the option. For example, htmlentities()
    - always URL encode all of your filenames before writing them
    - make sure your database and tables are all set to the utf8mb4 character set
      and collation, and that you use the utf8mb4 character set in the PDO connection string
    - In your HTML, include the charset meta tag in your page’s <head> tag
- always use the DateTime class for creating, comparing, changing, and displaying dates in PHP
- when testing the return value of a function that can return either 0 or boolean
  false, like strpos(), always use === and !==
====================== TinyThings =======================
array_search() only return key name when the *whole* value match the needle
foreach 开始执行时, 数组内部的指针会自动指向第一个单元, 不需要手动 reset
shuffle() 将删除原有的键名, 赋与新的键名, 而不是仅仅将键名重新排序
you can't remove elements with array_walk()
json_encode() considers an array with non-sequential non-numeric keys as an object
json_decode() can convert object json str to assoc array if you pass the second param as true to it
you can convert object to assoc array simply by doing type casting (object)
In json object, keys must be quoted
In json, quote mark must be " , not '
`echo isset($default) ? : ''` == `echo isset($default) ? $default : ''`

====================== Confusion =======================
1. 子类会继承父类的静态属性和方法吗?
A. NO
2. 子类会继承父类的私有属性和方法吗?
A. NO
3. null/none-zero is ?
A. int(0)
4. */0 is ?
A. bool(false)
5. is array(array()) empty?
A. no, it contain a empty array, so it's not empty!
6. is `!emtpy($var)` enough or have to do `isset($var) && !empty($var)`
A. `!emtpy($var)` is enough.
   `!empty($var)` is semantically equivalent to `(isset($var) && $var)`

====================== Advised: =======================
1. you don't have keys named 'foo1' and 'foo2' - use an array
2. Structuring your data right in the first place can help a lot
3. When there's no `else`, I prefer to explicitly halt at the top, so people don't have to scan ahead to see whether there's an else clause

====================== Learned =======================
1. SQL 和 数据结构 和 设计模式 应该深入掌握
2. 如果明明只有一个文件定义了某个函数, 却报 `can not redecalre function` 错误, 那么肯定是 include/require
   了多次这个文件
3. 如果彻底找不到某个变量在哪里定义的, 想想是不是 extract() 生成的. 想想是不是由某个 handler 函数生成/改变的. 想想是不是可变变量生成的. 想想是不是 $GLOBAL[$foo] 生成的
4. 如果想知道某个变量是干什么用的, 就去看它在哪里定义, 在哪里怎么使用的
5. 如果想知道一个系统的流程是怎么走的, 就去看传过去的 get, post(command, action, flag, type...)
   是如何标识不同的请求, 转向不同的处理的
6. 各种字符(单引号, 双引号, 反斜杠)的源(db, html, js, eval()...)的转换非常容易引起问题
7. after a query, always check if query result available before using it
8. Use utf8_encode() and utf8_decode() to work with texts in ISO-8859-1 encoding or Iconv for other encodings
9. strpos() 可能返回位置 0, 所以不要直接用 strpos() 的结果作为判断条件
10. if a function is for testing, use `is...` as its function name like: isBigger, isGood, isValidUTF8String
11. if you directly echoing html out in php, remember to set the correct encoding, like:
        exit('<script charset="utf-8">alert()</script>');
12. if you echoed something out before, then you can't redirect using header() after then
13. when debugging `header already sent` error, remember, even whitespace after ?> tag can be the problem
14. when making a recursive function, remember there must be two thing:1. a base case to return, 2. an accumulator to save result
15. use var_dump() to get error reporting's bitmask value
16. recreate session id without manipulation of cookie:
    http://www.hiteshagrawal.com/php/generate-unique-sessionid-in-php/
17. 写 api 时, 传来的参数检查对于程序运行和 debug 都非常重要, 不要忽略
18. in_array('15445{1}2488', array(15445)); will result in true, becuase '15445{1}2488' is first converted to integer 15445
19. 进入 php cli interactive 模式: `php -a`
20. 在循环中, 要特别注意某个变量是不是要在循环完后 unset, 以免影响下次循环
21. be very careful when you run `rm -rf ...` in php!
22. cookie data, like any user input date, can be harmful and you should sanitize it
23. 如果一个域名没有注册, 但是你知道服务器的 ip, 此时想访问指定用户 user 的 web 目录, 可以使用这种格式:
        http://1.2.3.4/~user/       (会自动进入 web 目录, 所以不用再额外指定 www)
24. Learning SPL is the key to true mastery of PHP
25. BECAUSE functions like substr() and strtoupper() expect precisely one byte per character, and will corrupt a multibyte string. Instead, you should use the multibyte equivalents of these functions, such as mb_strtoupper() instead of strtoupper(), mb_ereg_match() rather than ereg_match(), and mb_strlen() rather than strlen(). The parameters required for these functions are the same as their original, except that most accept an optional extra parameter to force specific encoding. see php.ini:mbstring.func_overload
26. `$a <= $b <= $c` won't don what you expected to do, use `$a <= $b && $b <= $c` instead
27. 禁用 `register_globals`, 禁用 `magic_quotes`
28. user isset() and is_array() when tring to use a variable as array , like `echo $ary[1]` or `foreach($notAry as ...)`
29. 如果 IE 展示中文下载名为乱码, 试试将名字 urlencode() 一下
30. 如果你不懂某些代码如何运作, 就不要轻易改动
31. There is no reason to ever use empty() on a declared variable; When you use isset() on an array
    key, like isset($array['key']), it will evaluate to "false" if the key exists but has the value
    null! Test for index existence with array_key_exists(). Put another way, use isset() if you want
    to type if ($value !== null) but are testing something that may not be declared. Use empty() if
    you want to type if (!$value) but you are testing something that may not be declared.
32. avoid using foreach-by-reference. If you do use it, unset the reference after the loop:
33. 如果报 'class not exits' 错误, 而你检查遍(namespace, 文件名, 类名...)也没找出原因, 可能是因为那个类文件有语法错误

====================== Quote in IRC =======================
rager:
- honestly, there's rarely a reason you must use global/static
- once things are no longer dependent on the data you hand them but also data they have to retrieve
  from global state, you cannot actually reliably reason about application behavior
- but you can often use global state as a short-cut to getting things done, especially when you have
  architectural problems that there isn't time to fix

Unopoo:
- if I don't define the child class' own constructor, it will inherite its parent class, and when instantiating the *child* class, it find its parent's constructor, so, $this is its parent then.

- (function(a){code}(A)) in js means pass A as a and run code once only

__adrian:
- It's *not* a code smell if strategy class need context class' info, it *is* if it goes out and tries to get that info on its

Sharaal:
- vcs focused on the code, deploy focused to use the code with an environment to have a running system

laszlof:
- CGI is a method of passing HTTP requests off to various processors(mod_php, php-fpm etc.)

Naktibalda:
- busy sites don't use gc

fleetfox:
- if you don't want to use whole framework, use composer and packagist to get components you want
- you don't use sessions for apis in general, rest api should not be statefull
- unless it's factory method or namespacing for "pure" function there is little reason to make something static

sorabji:
- doing an sql query in a recursive function is questionable

pppingme:
- the best ways to do it is to either define your host name as a varialbe, and reference that variable in your code, or make everythign relative (so full url's are never used)

- Unopoo: can I do a ? : operation when concatenating a string?
- AndreasLutro: yes, but put it in parenthesis or you're going to run into issues of operator precedence

Alphos:
- the way php handles functions usually is to find all function definitions, create the corresponding functions, then run the rest of the script. when you define a function conditionnally, you pull it out of that first step, and it gets defined IF the condition is true WHEN it reaches the condition ; it is then unavailable for anything that calls it before it's defined
- never to define functions conditionally

TML:
-  just avoid changing variables in-place
-  You shouldn't pass the enums, constants or magic numbers value to/from the API, you should pass the meaningful value like 'Female'.  The API should document stable values that you can map against


<UniFreak> should I make it a rule that always put api call in try catch block?
<AcidReign> UniFreak: no, you try/catch for a reason
<fleetfox> UniFreak: only if you want to handle the exception

<UniFreak> seems kinda easy convert between octal/hexadecimal to binary
<pragma-> that's the only meaningful conversion.
<pragma-> it is pointless to convert octal or hex to each other or to decimal.

<googleguy> Let PHP only provide the _data_ part by adding a <script></script> to the bottom of your php templates with the needed variables.

<jbafford>
returning [] would imply that whatever query or request you made can return an array of results, but there was no results to return
false would imply that there was a *failure* doing whatever was requested (though an exception might also be appropriate as well)
<tw2113> if you get to do php7, return type hints would be the answer to go with

=============== Understand ===============
Interface
    - is a special type of entity in Object Oriented Programming (OOP) which defines a *contract*
      between a *client* and a *server* class
    - When you want to name an interface you must think of the *client* and forget about the
      implementation
Setter & Getter
    - with setter & getter, it allows for divergence between data usage and data source,  for filters and
      validators etc

=============== Methodology ===============
You must always consider your business carefully

==================== Pitfalls&Tricks ====================
// wrong
if (strpos('testing', 'test')) { // found at position 0, interpreted as false, not as expected
    // code...
}
// right
if (strpos('testing', 'test') !== false) {
    // code...
}

$a = true ? '8' : (true ? '7' : 6); 和
$a = true ? '8' : true ? '7' : 6; 并不一样
使用三目运算符一定要注意小括号!!


/**
 * - use concatenation operator instead of concatenating assignment operator
 * - ident when concatenation use a new line
 */
// bad
$a = 'multi-line example';
$a.= "\n";
$a.= 'of what not to do';
// good
$a = 'multi-line example'
    . "\n"
    . 'of what to do';

// wrong
($a == 5) ? return true : return false;
// corrent
return ($a == 5) ? true : false;

/**
 * you don't need ternary operator to return boolean value
 * this is true for all operators(===, !==, !=, ==, etc)
 */
// not good
return ($a == 3) ? true : false;
// more concise
return $a == 3;

null['abc'] 并不会报 undefined index 错误