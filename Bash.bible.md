# See
- Book: Linux Bible E.3
- <Linux.md>
- ~/Scripts/template

# Basic

同一行的多个命令用 `;` 分开

注释以 `#` 开始

用 `echo msg` 显示消息, `echo -n msg` 不换行显示消息

`''` 或 `""` 可以划分一个字符串
`""` 中的变量会被解析, 如 `echo "var is $var"`. 要输出 `$`, 需要转义 `\$`

使用 \`\` (**deprecated**) 或 `$(cmd)` 进行**命令替换**
命令替换会创建子 shell, 使用 `./` 运行命令也会创建子 shell

**重定向**
`cmd > file` 输出覆盖到文件
`cmd >> file` 输出追加到文件
`cmd < file` 将文件内容输入到命令
`cmd << marker` **内联输入重定向**, 无需文件, 直接在命令行输入, marker 标识输入的起始, 如

```
$ wc << EOF
> test string 1
> test string 2
> test string 3
> EOF
    3   9   42
```

使用 `|` **管道**将前一个命令的输入作为后一个命令的输出, 如 `rpm -qa | sort | less`
Linux 会**同时**执行管道中的命令, 不会用到任何中间文件或缓冲区

可以使用以下方式进行数学运算
- `expr` **deprecated**
- `$[opration]`, 只支持整数运算 (+,-,*,/,%)
- 使用 `bc` 如 `var=$(echo "scale=4; $var1 / $var2" | bc)`, 太繁琐
- `bc` 配合内联输入, 浮点运算最好的办法

```sh
var=$(bc << EOF
scale=4
$var1 / $var2
EOF
)
```

`$?` 保存了上次执行命令的**退出状态码**, 惯例状态码如下
    0 成功
    1 未知错误
    2 不适合的 shell 命令
    126 命令不可执行
    127 没找到命令
    128 无效的退出参数
    128+x 与 Linux 信号 x 相关的严重错误
    130 通过 ctrl+c 终止
    255 其他
使用 `exit code` 指定退出状态码, 最大为 255, 大于 255 的会自动模 255

Bash 中不能正常运行的命令不会导致 shell 终止. 默认所有命令的输出都会显示到终端

# Conditional Test

使用 `&&`, `||` 进行**复合条件测试**
if, switch 和 until 中可以**使用多个测试命令**, 只有最后一个的退出状态码决定是否退出


## Basic: `test` / `[ ]`

`test`, `if test condition`
`[ condition ]`, 实际上是 `test` 的别名. 注意 condition 两边的空格是必须的 (不同于整数数学运算 `$[]`)

- 数值比较: `-eq`, `-ge`, `-gt`, `-le`, `-lt`, `-ne`, **只支持整数**
- 字符串比较: `=`, `!=`, `\<`, `\>`, `-n` (长度是否非 0), `-z` (长度是否为 0)
- 文件比较: `-d`, `-e`, `-f`, `-r`, `-s` (存在且非空), `-w`, `-x`, `-O` (属主), `-G` (属组), `-nt` (较新), `-ot` (较旧)

文件比较时, 大于和小于号**必须正确转义**, 否则会被当做重定向
大写字母被认为大于小写字母, 和 `sort` 相反

## Advanced Math: `(())`

除了 test 中的标准运算符, 还支持 `++`, `--`, `!`, `~`, `**`, `<<`, `>>`, `&`, `|`, `&&`, `||`
区别于 test, 相等比较为 `==`, `=` 为赋值, 且无需转义

```sh
var1=10
if (( $var1 ** 2 > 90 )); then
    (( var2 = $var1 ** 2 ))
    echo "The square of $var1 is $var2"
fi
```

## Advanced String: `[[]]`

除了支持 test 的标准字符串比较, 还提供**模式匹配**功能

```sh
if [[ $UERR == r* ]]; then
    echo "Hello $USER"
fi
```


# Choice

if...else

```shell
# 每块命令都会根据命令返回的退出状态码, 为 0 则执行
if cmd; then
    statments
elif cmd; then
    statments
else
    statments
fi
```

switch...case

```sh
case var in
    pattern1 | pattern2) cmd;;
    pattern3) cmd;;
    *) default;;
esac
```

select

```sh
select option in a b c; do
    case $option in
        a) echo "we are done"; break ;; # 记得 break, 否则会一直提醒选项
        *) echo "$option selected"
    esac
done
```

# Loop

for

```sh
# list 中使用 IFS 分隔各项, 注意引号的正确使用
# list 可以为自定义, 如 `a b c`
# 也可以为命令替换, 如 `$(cat file)`
# 也可以为通配符, 支持多个, 如 `/home/.b* /home/.c*`
for var in list; do
    cmd
done
```

for (C 风格)

```sh
# 变量赋值可以有空格
# 条件中的变量引用不用 $ 符
# 迭代算式不用 expr 命令格式
# 可同时使用多个变量, 如 `(( a=1, b=10; a <= 10; a++, b-- ))`
for (( var assign; condition; iteration )); do
    cmd
done
```

while

```sh
while cmd; do
    cmd
done
```

until

```sh
until cmd; do
    cmd
done
```

break / continue

```sh
break n
continue n
```


字段分隔符 **IFS** 默认为空格, 制表或换行符, 使用 `IFS=$'\n'` 可更改, **注意** `$`


# Arguments

Arguments vs. Option vs. Parameter

在使用参数前**一定要检查**其中是否存在数据.

**位置参数** 使用数字
- `$0` 脚本名
- `$1`...`$9` 第 1...9 个参数
- `${10}` 10 以上的必须加 `{}`
`$0` 中可能包含路径, 可用 `$(basename $0)` 提取出脚本名

**特殊参数变量**
- `$#` 参数个数
- `${!#}` 最后一个参数
- `$*` 所有参数 (视为单项)
- `$@` 所有参数 (视为列表)

`shift n` 会将每个参数变量向左移动 n(默认 1) 个位置

## Parsing Option/Parameter

case: 不支持多值的选项, 也不支持合并选项

```sh
while [ -n "$1" ]; do
    case "$1" in
        -a) # 处理选项 -a
        -b) param="$2" # 处理带值的选项 -b
            shift ;;
        --) shift # -- 一般用于表明选项列表结束
            break ;;
         *) # 其他
    esac
    shift
done
```

使用 getopt 格式化: 在脚本前加入 `set -- $(getopt -q ab:cd "$@")`
getopt 不擅长处理带空格和引号的参数值, 如 `-d "foo bar"`

使用 getopts, 注意多了 `s`

```sh
# 处理 Option
while getopts :ab:c opt; do
    case "$opt" in
        # 注意不用 `-a`, 而是 `a`
        a) echo "found -a option" ;;
        b) echo "found -b option with value $OPTARG" ;; # OPTARG 保存选项值
        c) echo "found -c option" ;;
        *) echo "unknown option $opt" ;;
    esac
done

# 处理 Parameter
shift $[ $OPTIND - 1 ] # OPTIND 保存 getopts 正处理的参数位置, 此语句把所有选项都 shift 掉
count=1
for param in "$@"; do
    echo "Parameter $count: $param"
    count=$[ $count + 1 ]
done
```

## Standard Option

`-a` 所有
`-c` 计数
`-d` 目录
`-e` 扩展
`-f` 文件
`-h` 帮助
`-i` 忽略大小写
`-l` 长格式
`-n` 非交互/批处理模式
`-o` 输出文件
`-q` 安静模式
`-s` 安静模式
`-r` 递归
`-v` 详细输出
`-x` 排除
`-y` 默认 yes

# User Input

read

```sh
# 配合 echo
echo -n "Enter name: "
read name

# 使用 -p 指定提示符及变量
read -p "Enter age, year: " age year

# 不指定变量, 则自动保存在 REPLY 中
read -p "Enter anything: "

echo $name, $age, $year, $REPLY

# -t 可以指定超时秒数, 超时则返回非零退出状态码
if read -t 3 -p "Counting down..." input; then
    echo "Get input $input"
else
    echo "Too slow...: $input"
fi

# -n 指定读入多少个字符
read -n1 -p "Do you want to continue [y/n]? " answer

# -s 可隐藏输入
read -s -p "Eneter your password: " pass

# 读取文件
cat file | while read line; do
    echo "Line: $line"
done
```

# Output

## Redirect

Linux 用**文件描述符(FD)**标识每个文件对象
FD 是一个非负整数, 每个进程最多有**9**个FD, Bash 保留了前三个
`0` `STDIN`
`1` `STDOUT`
`2` `STDERR`

`tee file` 将从 STDIN 过来的数据同时发往 STDOUT 和指定的 file
    `-a` 追加, 而非覆盖

重定向到文件
`2> errfile` 重定向错误消息到 `errfile`
`1> outfile` 重定向标准输出到 `outfile`
`&> file`  重定向错误消息和标准输出到 `file`, 错误消息会自动置顶

重定向输出到 FD 时, 必须在 FD 数字前加 $
临时: `echo "error message" >&2`
永久: `exec 2> errfile`, `exec 1> outfile`

重定向输入: `exec 0< infile`

其他 6 个(3~8) FD 均可用作重定向, 可将其分配给文件, 在脚本中使用
使用 `exec 3> fd3file; echo "to fd3" >&3` 创建 FD3
使用 `exec 3>> fd3file` 会**追加写**, 而非覆盖
使用 `exec 3<>fd3file` 可以用一个 FD 对同一个文件读写. 要小心使用
使用 `exec 3>&-` 可以关闭 FD 3

使用 `lsof` 可查看打开的 FD

---

临时重定向输出, 然后恢复默认输出

```sh
exec 3>&1 # FD3 到显示器
exec 1> outfile # STDOUT 到 outfile

echo "to outfile"
echo "to monitor" >&3

exec 1>&3 # 恢复 STDOUT 到显示器

echo "back to normal"
```

临时重定向输如, 然后恢复默认输入

```sh
exec 6<&0 # STDIN 保存在 FD6
exec 0< infile # infile 到 STDIN
exec 0<&6 # 恢复
```

避免错误输出, 也不保存: `2> /dev/null`
快速删除文件内容: `cat /dev/null > file`

## Temp File

`mktemp tmp.XXXXXX` 系统自动创建模板为 tmp.XXXXXX 且文件名唯一的文件, 如 tmp.UfIi13
    `-t` 在临时目录(一般为 /tmp/)中创建
    `-d` 创建目录

# Process Control

使用 `trap cmd signal` 捕获并处理信号

```sh
trap "echo 'trapped ctrl-c'" SIGINT
trap "echo 'done'" EXIT # script done
trap -- SIGINT # remove SIGINT trap
```

# Function

```sh
# 形式 1
function func1 { # 函数名必须唯一, 否则后者覆盖前者
    # 函数的默认退出状态码是其最后一条语句的退出状态码
    # 一般**不要用函数的默认退出状态码**, 你不知道其他命令是否执行成功
    # 可以使用 return 语句, 返回必须是 0~255 的状态码
    echo 'some' # 可以使用 `result=$(name)` 取的函数输出
    return 1 # 可以使用 $? 得到状态码
}

# 形式 2
func2() {
    # 可以通过标准参数环境变量获取传入的参数
    echo $1, $2, $#
    # 可以在函数内访问函数外定义的**全局变量**, 但最好不要这么做
    # 使用 local 可以定义**局部变量**
    local var
}

func2 a b # 通过这种形式传入参数

# 处理数组: 所有元素乘以二
function double {
    local origin
    local new
    local n
    local i
    origin=($(echo "$@")) # 打散: `echo "$@"`, 重组: `($())`
    new=($(echo "$@"))
    n=$[ $# - 1 ] # 遍历
    for (( i = 0; i <= $n; i++ )) {
        new[$i]=$[ ${origin[$i]} * 2 ]
    }
    echo ${new[*]}
}

arr=(1 2 3 4)
result=($(double ${arr[*]}))
echo ${result[*]}
```

可以把函数定义到文件中, 通过 `source` 或 `.` 命令引入, 以便重用功能

# Snippets

- 根据日期和配置文件归档备份

Lesson:
用户变量用的**大写**
告知详细信息, 出错, 进程, 文件行号等等...
用 echo 输出空行分割信息
通过 `$list="$list $new_item"` 加入列表
最后 `exit`


```sh
DATE=$(date +%y%m%d)
FILE=archive$DATE.tar.gz
# 配置文件每行为要归档的文件路径
CONFIG_FILE=/archive/Files_To_Backup
DESTINATION=/archive/$FILE

if [ -f $CONFIG_FILE ]; then
    echo
else
    echo
    echo "$CONFIG_FILE does not exists."
    echo "Backup not completed due to missing Configuration File"
    exit
fi

FILE_NO=1
exec < $CONFIG_FILE
read FILE_NAME
while [ $? -eq 0 ]; do
    if [ -f $FILE_NAME -o -d $FILE_NAME ]; then
        FILE_LIST="$FILE_LIST $FILE_NAME"
    else
        echo
        echo "$FILE_NAME, does not exist."
        echo "It is listed on line $FILE_NO"
        echo "Continuing..."
        echo
    fi
    FILE_NO=$[$FILE_NO + 1]
    read FILE_NAME
done

echo "Starting archive..."
echo
# c create, z zip, f file
tar -czf $DESTINATION $FILE_LIST 2> /dev/null
echo "Archive completed"
echo "Resulting archive file is: $DESTINATION"
echo

exit
```

- 删除用户

Lesson:
通过在函数体外定义变量, 函数体内使用并 unset 变量使用函数
通过函数让脚本语义更明确, 更清爽
英语语法也很重要
注释风格: 块儿, End of
对不同输入的兼容, 如 Yes|yES
重要操作多次询问, 多次确认

```sh
#!/bin/bash
# Delete_User - Automates the 4 steps to remove an account
#
###################################
# Define Functions
###################################
function get_answer {
    unset ANSWER
    ASK_COUNT=0

    while [ -z "$ANSWER" ]; do
        ASK_COUNT=$[ $ASK_COUNT + 1 ]
        case $ASK_COUNT in
            2)
                echo
                echo "Please answer the question."
                echo
                ;;
            3)
                echo
                echo "One last try...please answer the question."
                echo
                ;;
            4)
                echo
                echo "Since you refuse to answer the question..."
                echo "exiting program."
                echo
                exit
                ;;
        esac

        echo

        if [ -n "$LINE2" ]; then
            echo $LINE1
            echo -e $LINE2" \c"
        else
            echo -e $LINE1" \c"
        fi
    done

    unset LINE1
    unset LINE2
} # End of get_answer function

function process_answer {
    case $ANSWER in
        y|Y|YES|Yes|yEs|yeS|YEs|yES)
            ;;
        *)
            echo
            echo $EXIT_LINE1
            echo $EXIT_LINE2
            echo
            exit
            ;;
    esac

    unset EXIT_LINE1
    unset EXIT_LINE2
} # Enf of process_answer function

################# Main  Script ######################
echo "Step #1 - Determine User Account name to Delete"
echo
LINE1="Please enter the username of the user "
LINE2="account you wish to delete from system:"
get_answer
USER_ACCOUNT=$ANSWER

LINE1="Is $USER_ACCOUNT the user account "
LINE2="you wish to delete from the system? [y/n]"
get_answer

EXIT_LINE1="Because the account, $USER_ACCOUNT, is not "
EXIT_LINE2="the one you wish to delete, we are leaving the script..."
process_answer

USER_ACCOUNT_RECORD=$(cat /etc/passwd | grep -w $USER_ACCOUNT)
if [ $? -q 1 ]; then
    echo
    echo "Account, $USER_ACCOUNT, not found. "
    echo "Leaving the script..."
    echo
    exit
fi

echo
echo "I foun this record:"
echo $USER_ACCOUNT_RECORD
LINE1="Is this the correct User Account? [y/n]"
get_answer

EXIT_LINE1="Because the account, $USER_ACCOUNT, is not "
EXIT_LINE2="the one you wish to delete, we are leaving the script..."
process_answer

echo
echo "Step #2 - Find process on system belonging to user account"
echo

ps -u $USER_ACCOUNT >/dev/null
case $? in
1)
    echo "There are no processes for this account currently running."
    echo
    ;;
0)
    echo "$USER_ACCOUNT has the following processes running: "
    echo
    ps -u $USER_ACCOUNT

    LINE1="Would you like me to kill the process(es)? [y/n]"
    get_answer
    case $ANSWER in
    y|Y|YES|yes|Yes|yEs|yeS|YEs|yES)
        echo
        echo "Killing off process(es)..."
        COMMAND_1="ps -u $USER_ACCOUNT --no-heading"
        COMMAND_3="xargs -d \\n /user/bin/sudo /bin/kill -9"
        $COMMAND_1 | gawk '{print $1}' | $COMMAND_3
        echo
        echo "Process(es) killed."
        ;;
    *)
        echo
        echo "Will not kill the process(es)"
        echo
        ;;
    esac
esac

echo
echo "Step #3 - Find files on system belonging to user account"
echo
echo "Creating a report of all files owned by $USER_ACCOUNT."
echo
echo "It is recommended that you backup/archive these files,"
echo "and then do one of two things:"
echo "  1) Delete the files"
echo "  2) Change the files' ownership to a current user account."
echo
echo "Please wait. This may take a while..."

REPORT_DATE=$(date +%y%m%d)
REPORT_FILE=$USER_ACCOUNT"_Files_"$REPORT_DATE".rpt"
find / -user $USER_ACCOUNT > $REPORT_FILE 2>/dev/null
echo
echo "Report is complete."
echo "Name of report:   $REPORT_FILE"
echo "Location of report: $(pwd)"
echo

echo
echo "Step #4 - Remove user account"
echo

LINE1="Remove $USER_ACCOUNT's account from system? [y/n]"
get_answer
EXIT_LINE1="Since you do not wish to remove the user account,"
EXIT_LINE2="$USER_ACCOUNT at this time, exiting the script..."
process_answer

userdel $USER_ACCOUNT
echo
echo "User account, $USER_ACCOUNT, has been removed"
echo

exit
```

- 报告十名大容量目录, 生成报告文件

Lesson:
`exec <` 读取配置文件
`exec >` 生成运行报告
管道连接风格: `|` 放到最后, 然后另起一行

```sh
CHECK_DIRECTORIES=" /var/log /home"
DATE=$(date '+%m%d%y')

exec > disk_space_$DATE.rpt

echo "Top Ten Disk Space Usage"
echo "for $CHECK_DIRECTORIES Directories"

for DIR_CHECK in $CHECK_DIRECTORIES; do
    echo ""
    echo "The $DIR_CHECK Directory:"
    du -S $DIR_CHECK 2>/dev/null |
    sort -rn |
    sed '{11,$D; =}' |
    sed 'N; s/\n/ /' |
    gawk '{print $1 ":" "\t" $2 "\t" $3 "\n"}'
done

exit
```

- 从网站抓取天气信息

Lesson:
使用 `$(which cmd)` 查询程序是否可用
使用 tmpfile

```sh
URL="http://weather.yahoo.com/united-states/illinois/chicago-2379574/"
LYNX=$(which lynx)
TMPFILE=$(mktemp tmpXXXXXX)
$LYNX -dump $URL > $TMPFILE
conditions=$(cat $TMPFILE | sed -n '/IL, United States/{ n; p }')
temp=$(cat $TMPFILE | sed -n -f '/Feels Like/{p}' | awk '{print $4}')
rm -f $TMPFILE
echo "Current conditions: $conditions"
echo The current temp outside is: $temp
```

- 编造借口

```sh
# textbelt not availabel anymore
phone="15369997084"
SMSrelay_url=http://textbelt.com/text
text_message="System Code Red"

curl -s $SMSrelay_url -d \
number=$phone \
-d "message=$text_message" > /dev/null

exit
```
