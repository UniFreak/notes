# see
- #bash channel topics
- <https://wiki.bash-hackers.org/scripting/tutoriallist>
- <http://mywiki.wooledge.org/BashGuide>

# Concepts

BASH: Bourne Again Shell

merely a layer between system function calls and the user

Almost everything is a string: We need to be sure everything that needs to be separated is separated properly, and everything that needs to stay together stays together properly

Types of commands:
- alias: a word mapped to string, only useful as simple textual shortcuts
- functions: a name mapped to a set of commands, more powerful alias
- builtins: functions already provided, like `[]`
- keywords: like builtin, but with special parsing rule apply to them, like `[[ ]]`
- executable/external/application:

# Get Help

be familiar with
- `man`
- `aprops` = `man -k`
- `whatis` = `man -f`
- `help`
- `type`: `type -a bash` print all bash executable in PATH

to find out built-in commands: `man bash`

# Basic

Command pattern: `command options... -- arguments...`

Options traditionally end with `--` (optinal): `tar -x -f archive.tar -v -- file1 file2 file3`
- standalone, presente or not: `-x`
- with arguments: `-f archive.tar`

Arguments are seperated by whitespace

The amount of whitespace between arguments does not matter

Quotes (`"` or `'`) group everything inside them into a single argument

You should be very well aware of how expansion works

# Script

Typical interpreter directive / shebang / hashbang (see <https://unix.stackexchange.com/a/29620>)
- `#!/bin/bash`
- `#!/usr/bin/env bash`

Typical header:

```bash
#!/usr/bin/env bash
# scriptname - a short explanation of the scripts purpose.
#
# Copyright (C) <date> <name>...
#
# scriptname [option] [argument] ...
```

run:
- `bash myscript`
- or: `chmod +x myscript` and `./myscript`

to use a directory to hold your scripts:
1. mkdir: `$ mkdir -p "$HOME/bin"`
2. modify PATH: `$ echo 'PATH="$HOME/bin:$PATH"' >> "$HOME/.bashrc"`
3. source: `$ source "$HOME/.bashrc"`

# Handle Options/Arguments

see <http://mywiki.wooledge.org/BashFAQ/035>

Manually, best:

```bash
#!/bin/sh
# POSIX

die() {
    printf '%s\n' "$1" >&2
    exit 1
}

# Initialize all the option variables.
# This ensures we are not contaminated by variables from the environment.
file=
verbose=0

while :; do
    case $1 in
        -h|-\?|--help)
            show_help    # Display a usage synopsis.
            exit
            ;;
        -f|--file)       # Takes an option argument; ensure it has been specified.
            if [ "$2" ]; then
                file=$2
                shift
            else
                die 'ERROR: "--file" requires a non-empty option argument.'
            fi
            ;;
        --file=?*)
            file=${1#*=} # Delete everything up to "=" and assign the remainder.
            ;;
        --file=)         # Handle the case of an empty --file=
            die 'ERROR: "--file" requires a non-empty option argument.'
            ;;
        -v|--verbose)
            verbose=$((verbose + 1))  # Each -v adds 1 to verbosity.
            ;;
        --)              # End of all options.
            shift
            break
            ;;
        -?*)
            printf 'WARN: Unknown option (ignored): %s\n' "$1" >&2
            ;;
        *)               # Default case: No more options, so break out of the loop.
            break
    esac

    shift
done

# if --file was provided, open it for writing, else duplicate stdout
if [ "$file" ]; then
    exec 3> "$file"
else
    exec 3>&1
fi

# Rest of the program here.
# If there are input files (for example) that follow the options, they
# will remain in the "$@" positional parameters.

# NOTE:
# does not handle single-letter options concatenated together (like -xvf)
# Fancy option processing is only desirable if you are releasing the program for general use
```

getopts: only use it if you need concatenated options

# Special Chars

`$`: expansion
- parameter: `${var}` or `$var`
- command substitution: `$(command)`
- arithmetic: `$((expression))`

quotes:
- `' '`: no expansion, ignore escape `\`
- `" "`: with expansion

...

# Parameters

Two flavour:
- variables: user defined
- special parameters: read-only, preset by BASH

## Varialbes:

assign: `identifier=data`
- no space around `=`
- identifier can begin with letter/underscore, can contain letter/digit/underscore

expansion/substitution: `$identifier`

## Special Parameters:

- `$0`: script name/path
- `$1`, `$2`, `${10}` etc: positional parameter, contain passed-in arguments
- `$*`: string of all positional parameter
- `$@`: list of all positional parameter
- `$#`: number of positional parameter
- `$?`: exit code of most recently completed foreground command
- `$$`: PID of current shell
- `$!`: PID of most recently executed background command
- `$_`: last argument of last command

## Concatenate

- `var=$var1$var2`: command
- `var="$var1 - $var2"`: with whitespace
- `var=${var1}xyzzy` or `var="$var1"xyzzy`: diambiguate with `{}` or `""`
- `logname="log.$(date +%Y-%m-%d)"`: command substitute
- `string="$string more data here"`: reassign
- `var=( "${arr1[@]}" "${arr2[@]}" )`: array


# 注释

- 单行: `#` 代表注释 如： `# 这是一行注释`
- 多行注释:

把输入重定义到前面的命令, 但是 `:` 是空命令, 所以就相当于注释了

如果注释中有反引号的命令就会报错. 反引号部分没被注释掉, 例如 ab=`ls -l abc`就不会被注释掉.

```
:<<BLOCK
　　....注释内容
BLOCK
```

# 变量定义
- NOTE:
    + 变量赋值时等号左右不允许有空格
    + 定义变量时不需要 `$`, 但读取时需要
    + 输出不存在变量时, 只输出空值, 不报错
    + 单引号不解析变量
    + 在字符串中, 建议变量加上 `{}` 如 `${name}`
    + 定义字符串, 可以没有 `''` 或 `""`
    + 拼接字符串时, 不需要加上任何辅助符号, 直接拼接
    + `:` 表示分隔符
    + ``` 执行一条命令
- 赋值
    + 直接赋值 `name=elson`
    + 使用命令返回值赋值, 例如：用 pwd 命令获取当前路径, 并赋值
        * 方式1：`pathNow=`pwd``
        * 方式2：`pathNow=$(pwd)`
    + 用已有的变量赋值到新变量 `pathNow2=$pathNow`

# 变量输出

```
name=elson
echo my name is $name    #my name is elson
echo my name is ${name}  #my name is elson   推荐方式
echo my name is '$name'  #my name is $name   这一个得注意
echo my name is "$name"  #my name is elson
```

# 变量释放

```
unset name
echo $name
```

# 读取输入变量
-
```
read first second third         #暂停程序执行, 输入参数
echo "U input string1:$first"
echo "U input string2:$second"
echo "U input string3:$third"
```

-
```
read -p "U input string1:" first
echo "U input string1:$first"
```

- `echo "U input string1:$1"`   #./t3.sh sky miny  sky就是$1, miny是$2

# 数学计算

```sh
value1=`expr $a + $b + $c`
echo $value1                   #输出60

value1=`expr $c \* $a`         #*表示任意字符
echo $value1                   #输出300

echo $(($a + $b))              #输出30
```


# if

利用if编写一个只允许给定一个参数的shell文件: `vim if01.sh`

内容：

```sh
#!/bin/sh

if [ $# -eq 0 ]
then
  echo "Too few"
  exit 1
elif [ $# -gt 1 ]
then
  echo "Too many"
  exit 1
else
  echo "well"
fi
```

保存并退出, 赋予if01.sh文件可执行权限: `chmod +x ./if01.sh`

分别三种情况执行：

- `./if01.sh`              输出 Too few
- `./if01.sh elson`        输出 well
- `./if01.sh elson 24`     输出 Too many

- `-eq` (==) -比较两个参数相等
- `-ne` (!=) —比较两个参数是否不相等
- `-lt` (\<) —参数1是否小于参数2
- `-le`  —参数1是否小于等于参数2
- `-gt` (\>) —参数1是否大于参数2
- `-ge`  —参数1是否大于等于参数2

- `-r file`           用户可读
- `-w file`           用户可写
- `-x file`           用户可执行
- `-f file`           文件为正规文件
- `-d file`           文件为目录
- `-c file`           文件为字符特殊文件
- `-b file`           文件为块特殊文件
- `-s file`           文件大小非 0
- `-t file`           文件描述符(默认为1)指定的设备为终端
- `-n 变量`            变量有值

# for

```sh
for day in Saturday Tuesday Sunday
do
    echo "The day is : ${day}"
done
```

# case

```sh
echo "Please select ..."
echo "A) Copy"
echo "B) Delete"
echo "C) Backup"

read op
case $op in
A)
    echo "select A"
;;
B)
    echo "select B"
;;
C)
    echo "select C"
;;
*)
    echo "invalide select"
esac
```

# while

```sh
    num=3
    while [ $num -gt 0 ]
    do
        echo $num
        num=`expr $num - 1`
    done
```

特殊的shift:

```sh
num=1
while [ $# -gt 0 ]
do
    echo '$num='${num} ', $#='$# ', $1='${1}
    num=`expr $num + 1`
    shift                         # 参数列表往左移一位
                                  # sky jim lamson elson->左移->jim lamson elson
done
```

运行: `./while.sh david elson lamson`

# 函数定义

```sh
source 脚本名    #加载程序source 文件名
#example1 elson lamson 写在函数会报错, 因为函数并未定义
example1()
{
    name1=david
    echo '$name='${name1}

    echo '$arg1='${1}
    echo '$arg2='${2}
}
```

# 函数返回值

```sh
example2()
{
    echo $1
    return 9  #return的只能是一个整数
}
```

调用函数:

```sh
f=example2
echo $f #结果：example2
```

```sh
    f=example2 5 #报错
```

```sh
f=$(example2 5) #正确调用
echo $?  # 9, $?此时可以输出上一个函数返回的值, 但必须要写在函数调用后的下一句
echo $f  # 5, 输出函数在中间输出的值, 有多个值则输出多个, 以空格分隔
```

# exit

exit 0：完全退出
exit 1：退出本程序, 只退出执行中的shell文件

# expansion (by order)

- brace expansion
- tilde expansion
- parameter
- variable and arithmetic expansion and
- command substitution (done in a left-to-right fashion)
- word splitting
- pathname expansion

# Debug
- `set -o xtrace`
- see <https://www.shellcheck.net/>

# Best practice

- Avoid `.sh` file name extension
- Don't use `#!/bin/sh`, it's `bash`, not `sh`
- Always quote sentences or strings that belong together
- Just use function to run repeat commands
- Put double quotes around every parameter expansion
- if you need a regular expression, you'll be using awk(1), sed(1), or grep(1) instead of Bash
- DO NOT USE `ls`'s output for anything, Globs are much more simple AND correct
- double-quote every expansion
- Use single quotes when protecting complex strings
-