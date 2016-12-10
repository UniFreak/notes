#shell文件头

因为 shell 有多种, 所以编写 shell 要注明文件头： `#!/bin/sh`

- b-shell
- c-shell
- z-shell

#注释

- 单行: `#` 代表注释 如： `#这是一行注释`
- 多行注释:

把输入重定义到前面的命令, 但是 `:` 是空命令, 所以就相当于注释了

如果注释中有反引号的命令就会报错. 反引号部分没被注释掉, 例如 ab=`ls -l abc`就不会被注释掉.
```
:<<BLOCK
　　....注释内容
BLOCK
```

#变量定义
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

#变量输出

```
name=elson
echo my name is $name    #my name is elson
echo my name is ${name}  #my name is elson   推荐方式
echo my name is '$name'  #my name is $name   这一个得注意
echo my name is "$name"  #my name is elson
```

#变量释放

```
unset name
echo $name
```

#读取输入变量
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

#数学计算
-
```
value1=`expr $a + $b + $c`
echo $value1                   #输出60

value1=`expr $c \* $a`         #*表示任意字符
echo $value1                   #输出300
```

- `echo $(($a + $b))`              #输出30

#特殊变量
- 当前命令 `$0` 或 `${0}`: `echo "The command is ${0}"`
- 当前命令接受的参数个数 `$#` 或 `${#}`, `read` 的输入, 不算入`$#`
- `$?` 最近的状态码（上一条指令）,一般情况下, 直接输出 `$?`, 值为 `0`, 表示程序执行正常, 其他值表示程序错误；如果 `$?` 写在函数后面, 输出的是函数的返回值

#if

    利用if编写一个只允许给定一个参数的shell文件
    vim if01.sh

    内容：
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

    保存并退出, 赋予if01.sh文件可执行权限
    chmod +x ./if01.sh
    分别三种情况执行：
    ./if01.sh              #输出 Too few
    ./if01.sh elson        #输出 well
    ./if01.sh elson 24     #输出 Too many

-eq(==) -比较两个参数相等
-ne(!=) —比较两个参数是否不相等
-lt(\<) —参数1是否小于参数2
-le —参数1是否小于等于参数2
-gt(\>) —参数1是否大于参数2
-ge —参数1是否大于等于参数2

-r file　　　　　用户可读
-w file　　　　　用户可写
-x file　　　　　用户可执行
-f file　　　　　文件为正规文件
-d file　　　　　文件为目录
-c file　　　　　文件为字符特殊文件
-b file　　　　　文件为块特殊文件
-s file　　　　　文件大小非 0
-t file　　　　　文件描述符(默认为1)指定的设备为终端
-n 变量            变量有值

#.for语句
    for day in Saturday Tuesday Sunday
    do
        echo "The day is : ${day}"
    done

#.case语句
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

#.while语句

    12.1.代码1
        num=3
        while [ $num -gt 0 ]
        do
            echo $num
            num=`expr $num - 1`
        done

    12.2.代码2, 特殊的shift
        num=1
        while [ $# -gt 0 ]
        do
            echo '$num='${num} ', $#='$# ', $1='${1}
            num=`expr $num + 1`
            shift                         # 参数列表往左移一位
                                          # sky jim lamson elson->左移->jim lamson elson
        done

        ./while.sh david elson lamson

#.1.函数定义
    #source 脚本名    //载入上个计算程序脚本
    #example1 elson lamson 写在函数会报错, 因为函数并未定义
    example1()
    {
        name1=david
        echo '$name='${name1}

        echo '$arg1='${1}
        echo '$arg2='${2}
    }

    调用函数
    example1 elson lamson

    source fun02.sh #加载程序source 文件名

#.2.函数返回值
    example2()
    {
        echo $1
        return 9  #return的只能是一个整数
    }

    调用函数
    1、
    f=example2
    echo $f #结果：example2
    2、
    f=example2 5 #报错
    3、
    f=$(example2 5) #正确调用
    echo $?  # 9, $?此时可以输出上一个函数返回的值, 但必须要写在函数调用后的下一句
    echo $f  # 5, 输出函数在中间输出的值, 有多个值则输出多个, 以空格分隔

 #exit
exit 0：完全退出
exit 1：退出本程序, 只退出执行中的shell文件