gawk 能提供一个类编程环境来修改和重新组织文件中的数据

`gawk options program file`, 可以指定**多个**数据文件
    `-F fs` 字段分隔符
    `-f file` 程序文件
    `-v var=value` 定义变量 (BEGIN 之前可用)
    `-mf N` 最大字段数
    `-mr N` 最大行数
    `-W keyword` 兼容模式或警告等级

**gawk 程序脚本**放到单引号中, 用 `{}` 包含一段**脚本区域**
使用 `;` 分割多个命令
可以写到一行: `gawk '{print "hello"}'`
也可以分开多行

```sh
gawk '{
print "hello"
print "world"
}'
```

`-f file` 可以指定从文件中读取程序, 文件中的命令无需分号结尾

在文本行中, 每个**数据字段**都是通过**字段分隔符**划分的. `-F` 可以指定分隔符, 如 `gawk -F:`

# 变量

引用时, **不用 `$` 符号**
区分大小写, 不能以数字开头
文本值**必须用双引号**括起来 `"string"`
数字 `42`

## 内建变量

- 字段和记录分隔符
`FIELDWIDTHS` 又空格分割的一列数字, 定义了每个数据字段的宽度. **一旦设置之后就不能变**
`FS` 输入字段分隔符. 默认空白符
`RS` 输入记录分隔符. 默认换行, 即每一行作为一个处理单元
`OFS` 输出字段分隔符. 默认空格
`ORS` 输出记录分隔符. 默认换行

- 数据变量
`ARGC` 命令行参数个数. **gawk 不把程序脚本当做命令行参数一部分**
`ARGIND` 当前文件在 ARGV 中的位置
`ARGV`  命令行参数数组
`CONVFMT` 数字转换格式, 默认 %.6 g
`ENVIRON` 环境变量关联数组
`ERRNO` 读取或关闭输入文件发生错误时的系统错误号
`FILENAME` 输入数据文件名
`IGNORECASE` 是否忽略大小写
`NF` 数据文件字段总数
`FNR` **当前数据文件**中已处理过的记录数, 处理每个数据文件时被重置
`NR` 已处理过的记录**总数**
`OFMT` 数字输出格式, 默认 %.6 g
`RLENGTH` match 函数匹配的子字符串长度
`RSTART` match 函数匹配的子字符串起始位置

- 数据字段变量
gawk 自动给一行中的每个**数据字段**分配一个变量
    $0 整个行
    $n n 为数字, 第 n 个数据字段

## 自定义变量

`var="value"` / `var=42`

可以在命令行上赋值, 影响脚本文件中的值, 如 `gawk -f script n=3 file`, 则 script 中的 n 值为 3
但是这个值**在 BEGIN 中不可用**, 可以使用 `-v` 选项, 在 BEGIN 之前设定变量 `gawk -v n=3 -f script file`

## 数组

赋值: `arr[1] = "value1"`, `arr["foo"] = "bar"`
删除: `delete arr[1]`

遍历: `for (var in arr) { }`
`var` 存储的是**索引**, 而非值. 返回**顺序不确定**

# 匹配模式

匹配模式可以过滤数据记录, 只对匹配的记录进行操作: `pattern{ operation }`

## 正则

`/regex/` gawk 支持 BRE 和 ERE. 正则会对记录中**所有**数据字段进行匹配, **包括字段分隔符**

## 匹配操作符

将正则限定在记录中**特定数据字段**

`$n ~ /regex/` **过滤出**第 n 个字段匹配 regex 的所有记录
`$n !~ /regex/` **过滤掉**第 n 个字段匹配 regex 的所有记录

## 数学表达式

`$n == $m`
`$n >= $m`
`$n <= $m`
`$n > $m`
`$n < $m`

也可以对文本数据使用, 但**表达式必须完全匹配**

## 特殊

可以指定脚本**在何时运行**: 关键字+脚本区域
`BEGIN {}` 处理数据前运行 {} 中脚本
`{}` 处理数据
`END {}` 处理数据后运行 {} 中脚本

# 结构化命令

## if...else

```sh
# else 可选
gawk '{if ($1 > 20) print $1}' file

# 单行带 else
gawk '{if ($1 > 20) print $1; else print $1 / 2}' file

# else if, 多行, 嵌套
gawk '{
    if ($1 > 20) {
        print $1 * 2
    } else if ($1 > 10) {
        if ($1 < 15) {
            print $1 * 3
        } else {
            print $1 / 2
        }
    }
}' file
```

## while / do...while / for

```sh
# 支持 break, continue

# while
gawk '{
    total = 0
    i = 1
    while (i < 4) {
        total += $i
        if (i == 2)
            break
        i++
    }
    print total
}' file

# do...while
gawk '{
    total = 0
    i = 1
    do {
        total += $i
        i++
    } while (total < 150)
    print total
}' file

# for
gawk '{
    total = 0
    for (i = 1; i < 4; i++) {
        total += $i
    }
    print total
}'
```

# 打印

`printf "format-string", var1, var2...`
format string: `%[modifer]control-letter`
modifier: width, precision, alginment `%-5.1`
control letter: `c`, `d`, `i`, `e`, `f`, `g`, `o`, `s`, `x`, `X`

# 函数

## 内置

- Math
`atan2(x, y)`
`cos(x)`
`exp(x)`
`int(x)`
`log(x)`
`rand()`
`sin(x)`
`sqrt(x)`
`srand(x`)

- Bit Op
`and(x, y)`
`compl(x)`
`lshift(x, count)`
`or(x, y)`
`rshift(x, count)`
`xor(x, y)`

- String
`asort(s [,d])`
`asorti(s [,d])`
`gensub(r, s, h [,t])`
`gsub(r, s [,t])`
`index(s, t)`
`length([s])`
`match(s, r [,a])`
`split(s, a [,r])`
`sprintf(fmt, vars)`
`sub(r, s [,t])`
`substr(s, i [,n])`
`tolower(s)`
`toupper(s`)

- Time
`mktime(datespec)`
`strftime(fmt [, timestamp])`
`systime()`

## 自定义

必须定义在所有代码块(包括 BEGIN)之前

```sh
function name([vars]) {
    statements
}
```

可以将函数集中定义在一个文件中, 然后以 `-f` 选项引入: `gawk -f funclib -f script file`

# Snippets

假设文件 `scores.txt` 保存了两个队的三场比分

```txt
Rich Blum,team1,100,115,95
Barbara Blum,team1,110,115,110
Christine Bresnahan,team2,120,115,118
Time Bresnahan,team2,125,112,116
```

以下脚本将计算两队总分和平均分

```sh
for team in $(gawk -F, '{print $2}' scores.txt | uniq); do
    gawk -v team=$team 'BEGIN{FS=","; total=0} {
        if ($2==team) {
            total += $3 + $4 + $5;
        }
    }
    END {
        avg = total / 6;
        print "Total for", team, "is", total, ", the average is", avg
    }' scores.txt
done
```