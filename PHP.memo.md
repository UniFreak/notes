# Q & A
子类会继承父类的静态属性和方法吗? NO

子类会继承父类的私有属性和方法吗? NO

null/none-zero is ? int(0)

*/0 is ? bool(true)

is array(array()) empty? NO, it contain a empty array, so it's not empty!

is `!emtpy($var)` enough or have to do `isset($var) && !empty($var)`? enough

is_null(0): false
0 == null: true

# Traps

## Bitwise operation

Bit shifting in PHP is arithmetic

If both operands for the &, |, ^ and ~ operators are strings, then the operation will be performed on the ASCII values of the characters that make up the strings and the result will be a string. In all other cases, both operands will be converted to integers and the result will be an integer

Both operands and the result for the << and >> operators are always treated as integers

## JSON 数据不能被解析
看字符串并没有 JSON 语法错误, 但是用 `json_decode()` 解析出来是 NULL

可能是 JSON 串前面带了 BOM 头. 解决方法
- (服务端)找出 BOM 头是哪个文件输出的, 确保文件使用 UTF8 无 BOM 编码. 或者
- (服务端)在 echo JSON 串之前, 使用 ob_end_clean() 摒除之前所有输出
- (客户端)手工使用 substr() 把 3 个 BOM 字节删除

see: http://www.cnblogs.com/zqphp/p/4885473.html

## Type

`(bool) "false"` or `boolval("false")` or `settype("false", 'bool')`: true

`is_int('42')` false
`is_numeric('42')` true

## File

`feof()` will read in a null value at last
`fgets()`  will implicitly move file pointer next line

# Misc

`null['abc']` 并不会报 undefined index 错误. 而是返回 `NULL`

Interface is a special type of entity in Object Oriented Programming (OOP) which defines a *contract* between a *client* and a *server* class. When you want to name an interface you must think of the *client* and forget about the implementation

setter & getter, it allows for divergence between data usage and data source,  for filters and validators etc

如果明明只有一个文件定义了某个函数, 却报 `can not redecalre function` 错误, 那么肯定是 include/require
   了多次这个文件

如果彻底找不到某个变量在哪里定义的, 想想是不是 extract() 生成的. 想想是不是由某个 handler 函数生成/改变的. 想想是不是可变变量生成的. 想想是不是 $GLOBAL[$foo] 生成的

各种字符(单引号, 双引号, 反斜杠)的源(db, html, js, eval()...)的转换非常容易引起问题

Use `utf8_encode()` and `utf8_decode()` to work with texts in ISO-8859-1 encoding or `Iconv` for other encodings

`strpos()` 可能返回位置 0, 所以不要直接用 strpos() 的结果作为判断条件

if you directly echoing html out in php, remember to set the correct encoding, like:
`exit('<script charset="utf-8">alert()</script>');`

when debugging `header already sent` error, remember, even whitespace after ?> tag can be the problem

when making a recursive function, remember there must be two thing:
1. a base case to return
2. 2. an accumulator to save result

use `var_dump()` to get error reporting's bitmask value

recreate session id without manipulation of cookie: see <http://www.hiteshagrawal.com/php/generate-unique-sessionid-in-php/>

写 api 时, 传来的参数检查对于程序运行和 debug 都非常重要, 不要忽略

in_array('15445{1}2488', array(15445)); will result in true, becuase '15445{1}2488' is first converted to integer 15445

进入 php cli interactive 模式: `php -a`

在循环中, 要特别注意某个变量是不是要在循环完后 unset, 以免影响下次循环

be very careful when you run `rm -rf ...` in php!

cookie data, like any user input date, can be harmful and you should sanitize it

Learning SPL is the key to true mastery of PHP

functions like `substr()` and `strtoupper()` expect precisely one byte per character, and will corrupt a multibyte string. Instead, you should use the multibyte equivalents of these functions, such as `mb_strtoupper()` instead of `strtoupper()`, `mb_ereg_match()` rather than `ereg_match()`, and `mb_strlen()` rather than `strlen()`. The parameters required for these functions are the same as their original, except that most accept an optional extra parameter to force specific encoding. see php.ini:mbstring.func_overload

`$a <= $b <= $c` won't do what you expected to do, use `$a <= $b && $b <= $c` instead

禁用 `register_globals`, 禁用 `magic_quotes`

user `isset()` and `is_array()` when tring to use a variable as array , like `echo $ary[1]` or `foreach($notAry as ...)`

如果 IE 展示中文下载名为乱码, 试试将名字 `urlencode()` 一下

如果你不懂某些代码如何运作, 就不要轻易改动

There is no reason to ever use empty() on a declared variable; When you use isset() on an array
key, like isset($array['key']), it will evaluate to "false" if the key exists but has the value
null! Test for index existence with array_key_exists(). Put another way, use isset() if you want
to type if ($value !== null) but are testing something that may not be declared. Use empty() if
you want to type if (!$value) but you are testing something that may not be declared.

avoid using foreach-by-reference. If you do use it, unset the reference after the loop

如果报 'class not exits' 错误, 而你检查遍(namespace, 文件名, 类名...)也没找出原因, 可能是因为那个类文件有语法错误

永远不要相信浮点数结果精确到了最后一位，也永远不要比较两个浮点数是否相等, 可以考虑使用 `bc` 或 `gmp`

form action 为空时, 默认是本页面 php 代码执行

`setsession()` 和 `setcookie()` 必须位于 <html> 标签之前

行结束符
- Unix  `\n`
- Windows  `\r\n`
- Macintosh  `\r`

`urlencode()` vs `rawurlencode()`
- 同: 把除  `-_.`  之外的所有非字母数字字符都将被替换成百分号 (%) 后跟两位十六进制数
- 异: `urlencode()` 把空格替换成 +, 而 `rawurlencode()` 把空格替换成 %20
- `rawurlencode()` 兼容性更强
- `urlencode()` 适合用于编码 url 路径部分(?之前)
- `rawurlencode()` 适合编码请求字符串部分

`htmlspecialchars()` vs `htmlentities()`
- `htmlspecialchars()` 默认只将 `<` `>` `"` `&` 四个转换为对应的实体 (&lt; &gt; &amp; &quot;)
- `htmlentities()` 将__所有__有对应实体的字符转换为对应实体
- 可以使用 `get_html_translation_table()` 查看它们默认的转换映射表

`strip_tags()` VS `nl2br()`
- `strip_tags()` 去掉所有的 HTML 或 PHP 标签
- `nl2br()` 把换行符替换为 `<br />' 或 '<br>`

Hash 算法:
- MD5         // not recommended
- SHA-1       // theory say could be hacked
- SHA-2(SHA-256, SHA-512)
- Whirlpool, Tiger,AES
- Blowfish    // recommended

Hash 函数
- `md5()`
- `sha1()`
- `hash()`
- `crypt()`
- `salt()`

除非打开 output buffering, `header()` 之前不能有任何输出

`ob_start()` 之前不能有任何输出

可以在 `php.ini` 里打开 output buffering, 也可以用 `ob_start()` 在页面级打开(参见 `ob_end_flush()`,
  `ob_get_contents()`, `ob_end_clean()`)

One mistake that is easy to make with the Location header is not calling exit directly afterwards (you may not always want to do this, but usually you do). The reason this is a mistake is that the PHP code of the page continues to execute even though the user has gone to a new location. In the best case, this uses system resources unnecessarily. In the worst case, you may perform tasks that you never meant to

you must never trust request headers for information that is important to the security of your site

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

`array_search()` only return key name when the *whole* value match the needle

`foreach` 开始执行时, 数组内部的指针会自动指向第一个单元, 不需要手动 reset

`shuffle()` 将删除原有的键名, 赋与新的键名, 而不是仅仅将键名重新排序

you can't remove elements with `array_walk()`

`json_encode()` considers an array with non-sequential non-numeric keys as an object

`json_decode()` can convert object json str to assoc array if you pass the second param as true to it

you can convert object to assoc array simply by doing type casting `(object)`

In json object, keys must be quoted, and quote mark must be " , not '

`echo isset($default) ? : ''` == `echo isset($default) ? $default : ''`

# IRC

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


On try catch in api
<UniFreak> should I make it a rule that always put api call in try catch block?
<AcidReign> UniFreak: no, you try/catch for a reason
<fleetfox> UniFreak: only if you want to handle the exception

On numeric base conversion
<UniFreak> seems kinda easy convert between octal/hexadecimal to binary
<pragma-> that's the only meaningful conversion.
<pragma-> it is pointless to convert octal or hex to each other or to decimal.

<googleguy> Let PHP only provide the _data_ part by adding a <script></script> to the bottom of your php templates with the needed variables.

<jbafford>
returning [] would imply that whatever query or request you made can return an array of results, but there was no results to return
false would imply that there was a *failure* doing whatever was requested (though an exception might also be appropriate as well)
<tw2113> if you get to do php7, return type hints would be the answer to go with