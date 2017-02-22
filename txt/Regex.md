# 概念
- 构造正则表达式的方法和创建数学表达式的方法一样.也就是用多种元字符与操作符将小的表达式结合在一起来创建更大的表达式.正则表达式的组件可以是单个的字符、字符集合、字符范围、字符间的选择或者所有这些组件的任意组合

- 贪婪模式:尽可能多的匹配文字
- 懒惰模式:尽可能少的匹配所搜索的字符串

- 使用替换(`|`)时,顺序是很重要的,匹配替换时,将会从左到右地测试每个分枝条件,如果满足了某个分枝的话,就不会去管其它的替换条件了

- 对一个正则表达式模式或部分模式两边添加圆括号将导致相关匹配存储到一个临时缓冲区中, 所捕获的每个子匹配都按照在正则表达式模式中从左至右所遇到的内容存储
- 存储子匹配的缓冲区编号从 1 开始, 连续编号直至最大 99 个子表达式.
- 每个缓冲区都可以使用 `\n` 访问, 其中 `n` 为一个标识特定缓冲区的一位或两位十进制数

- 零宽 : 就是它并不在匹配的结果字符中占据空间.例如 `\w`, `\s` 就会占据一个或几个空间, 依匹配的字符长度决定.而像 `^`, `$` 这种对应的首末位置, 不占据空间, 零宽就是属于这一类
- 断言 : 就是判断的条件.
- 正/负预测 : 是指断言中要求满足的情况. "正" 表示要满足exp,  "负" 表示要不满足exp的.
- 先行/后行 : 是指被匹配的字符串在前面/后面, 零宽断言跟在后面/前面.即串的后/前一部分是否满足断言.

# 语法

## 定界符

除了字母, 数字, 正斜线, 空白符都可为定界符,在JS中默认为 / /

## 注释

`#`

## 修饰符

- `i`                执行对大小写不敏感的匹配.
- `g`                执行全局匹配（查找所有匹配而非在找到第一个匹配后停止）.
- `m`                执行多行匹配.

## 元字符
- `\`               转义
- `|`               可选分支
- `\a`              报警字符
- `\e`              escape
- `\cX`             由 `X` 指定的控制字符, 如 `\cM` 匹配一个 `Ctrl+M`
- `\G`              
- `\p{name}`        
- `.`               除了换行和行结束符以外的任一字符
- `\w`              单词字符(a-zA-z0-9_)
- `\W`              非单词字符
- `\d`              数字
- `\D`              非数字字符
- `\s`              空白(\n\r\t\f)字符
- `\S`              非空白字符
- `\b`              单词边界
- `\B`              非单词边界
- `\0`              NUL字符
- `\n`              换行符
- `\f`              换页符
- `\r`              回车符
- `\t`              制表符
- `\v`              垂直制表符
- `\O`              八进制字符
- `\0nn`            以八进制数 `nn` 规定的字符
- `\xnn`            以十六进制数 `nn` 规定的字符
- `\unnnn`          以十六进制数 `nnnn` 规定的 Unicode 字符

## 方括号

方括号用于查找某个范围内的字符：

- `[abc]`           查找方括号之间的任何字符
- `[^abc]`          查找任何不在方括号之间的字符. `^` 必须在`[]`里第一个字符前
- `[0-9]`           查找任何从 0 至 9 的数字
- `[a-z]`           查找任何从小写 a 到小写 z 的字符
- `[A-Z]`           查找任何从大写 A 到大写 Z 的字符
- `[A-z]`           查找任何从大写 A 到小写 z 的字符

## 捕获(用 `\<num>` 或 `\<name>` 向后引用)
- `(exp)`           匹配 exp 并捕获(从左到,只数小括号)文本到自动命名的组里
- `(?<name>exp) | (?'name'exp)`     匹配 exp 并捕获文本到名称为 name 的组里, 并压入堆栈
- `(?:exp)`                         匹配 exp 不捕获匹配的文本
- `(?'-name')`                      弹出最后压入堆栈名为 name 的捕获内容, 如果堆栈本来为空, 则本分组的匹配失败
- `(?(group)yes|no)`                如果堆栈上存在名为 name 的捕获内容的话, 继续匹配yes部分的表达式, 否则继续匹配no部分

## 限定符(在限定符后加 `?` 转化为懒惰模式)
- `+`               至少一个
- `*`               零个或多个
- `?`               零个或一个
- `{X}`             X 个
- `{X,Y}`           X 到 Y 个
- `{X,}`            至少 X 个

## 定位符(不能对定位符使用限定限定符)
- `(?=exp)`     零宽先行断言      后面是 exp 的位置
- `(?<=exp)`    零宽后行断言      前面是 exp 的位置
(?!exp)     零宽负向先行断言    后面不是 exp 的位置 (如果没有后缀表达式, - 试图匹配总是失败)
- `(?<!exp)`    零宽负向后行断言    前面不是 exp 的位置
- `^`                               字符串开始位置, 或行首(多行模式下)
- `$`                               字符串结束位置, 或行尾(多行模式下)
- `\A`                              字符串开始位置
- `\Z`                              字符串结束位置
- `\b`                              单词边界
- `\B`                              非单词边界
- `\<`                              单词开始位置
- `\>`                              单词结束位置

## 平衡组

    \(                              #普通字符 "("   
        (                           #分组构造, 用来限定量词 "*" 修饰范围  
            (?<Open>\()             #命名捕获组, 遇到开括弧 "Open" 计数加1  
            |                       #分支结构  
            (?<-Open>\))            #狭义平衡组, 遇到闭括弧 "Open" 计数减1  
            |                       #分支结构  
            [^()]+                  #非括弧的其它任意字符  
        )*                          #以上子串出现0次或任意多次  
        (?(Open)(?!))               #判断是否还有 "Open" , 有则说明不配对, 什么都不匹配  
    \)                              #普通闭括弧

# 常用模式
- E-mail:
    + `\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b`
    + `/^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/`
- Username: `^[a-zA-Z0-9_-]{3,15}$`
- Password: `/^[a-z0-9_-]{6,18}$/`
- IP: `((2[0-4]\d|25[0-5]|[01]?\d\d?)\.){3}(2[0-4]\d|25[0-5]|[01]?\d\d?)`
- URL: `/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/`
- HTML tag: `/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/`
- Duplicate items: `((?<!\d)\d+(?=,))(?=.*\1)`