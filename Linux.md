# See
- Book: Linux 命令行与 Shell 脚本编程大全, E.3

# Concepts

Linux 可分为四部分

- Linux 内核

    5 个启动**运行级**: 1 级单用户, 3 级有网络, 5 级有图形界面

    Linux 将硬件设备当成特殊文件, 即 **设备文件**, 分为字符型, 块和网络三种
    网络设备文件中的**回环设备**允许 Linux 使用常见的网络编程协议同自身通信
    与设备的所有通信都通过设备**节点文件**完成

- GNU 工具

    包括 GNU coretiles 软件包, 用于处理文件, 操作文本和管理进程
    以及各种 shell, 如 bash, ash, korn, tcsh, zsh

- 图形化桌面环境

    X.org, KDE, GNOME, Unity, Xfce

- 应用软件

---

完整的 Linux 包即**发行版**, 如 Slackware, Red Hat, Gedora, Gentoo, OpenSUSE, Debian,
CentOS, Ubuntu, PCLinuxOS, Mint, dyne:bolic, Puppy Linux, Knoppix, PCLinuxOS, Slax...

---

命令行参数可分为三种风格
- Unix 风格, 有单破折线
- BSD 风格, 无破折线
- GNU 风格, 双破折线的长参数

---

学习 Linux 不在于记住所有命令行参数, 而是记住那些常用的

# Get Help

命令怎么使用? `man command`
忘记了命令名? `man -k keyword`
指定内容区域? `man [section_no chapter_name] command`

man page 有以下内容区域:

    1: User Commands
    2: System Calls
    3: LIbrary functions
    4: Devices
    5: File formats
    6: Games and Amusements
    7: Conventions and Miscellany
    8: System Administration and Priviledged Commands
    9: Linux kernel documentation
    L: Local
    N: TCL Commands

info

-help / --help 选项

# File System

## Concepts

inode: 用于标识文件系统中的每一个对象

## 常见目录及文件

```
~/.bash_profile
~/.bash_login
~/.bash_logout
~/.profile
~/.bashrc
~/.bash_history

/dev/null 空设备

/
/bin
/boot
    grub
/dev
    /disk persistent device 2s
/etc
    init.d  sysconfig
    /passwd 帐号
    /shadow 密码
    /group 用户组
    /fstab 分区自动载入配置文件
    /issue 终端登录消息配置文件
    /motd message of today 配置文件
    /sysconfig/i18n     语系配置文件
    /profile
    /bashrc
    /profile.d/*.sh
    /man.config man 查找路径配置
    /updatedb.conf locate 用的 updatedb 配置文件
/home
/lib
    modules
/mnt
opt
/proc
    /stat system statistics
    /uptime system uptime
    /partitions disk statistics (for pre kernelv2.5 that have been patched)
    /diskstats disks statistics (for post kernelv2.5)
    /self/mountstats statistics for network filesystems
/root
/sbin
/srv
/sys statistics for block devices (kernelv2.5)
/tmp
/usr
    bin     X11R6       share   local
/var
    log     lib     spool   run
```

特殊目录/文件

. 本目录
.. 上级目录
~ 家目录
- 原目录
.+文件名 隐藏目录/文件

## 模式匹配
?: 一个字符
*: 多个字符
[a-i]: 范围
[!a]: 排除

## 常用命令

`cd`
`pwd`
`ls`
    `-F` 区分目录和文件
    `-a` 显示隐藏文件
    `-R` 递归输出子目录
    `-d` 只列出目录
    `-l` 输出每个文件更多信息
`touch` 创建新文件, 或改变文件修改时间
    `-a` 改变文件访问时间
`cp`
    `-i` 询问
    `-R` 递归
`ln` 创建硬链接
    `-s` 创建软连接, **千万别创建软连接的软连接**
`mv`
`rm`
    `-i` 询问
    `-f` 强制
`mkdir`
    `-p` 带上子目录
`rmdir`
    `-i` 询问
    `-r` 递归
    `-f` 强制
`tree`
`file`
`cat`
    `-n` 所有行行号
    `-b` 非空行行号
    `-T` 排除制表符
`more`
`less`
`tail`
    `-n 行数`
`head`
    `-n 行数`

## 文件属性

权限

r   可读(4)
w   可写(2)
x   可执行(1), 如果是目录则决定是否可进入
SUID    set uid : 在执行时, 暂时具有该程序拥有者的权限(4)
SGID    set gid : 在执行时, 暂时具有该程序用户组的权限(2)
SBit    Sticky Bit : 只有文件拥有者和 root 可以删除该文件(1)
-   无权限

---

时间

mtime           modify time
ctime           change time
atime           access time

---

类型

d               文件夹
-               文件
l               链接
c               串设备
b               块设备
s               套接字
p               管道(FIFO, pipe)

0               标准输入 stdin (键盘)
1               标准输出 stdout (屏幕)
2               标准错误 stderr

---

常见压缩格式
.Z              compress 压缩
.bz2            bzip2 压缩
.gz             gzip 压缩
.tar                tar 打包
.tar.gz         tar 打包然后 gzip 压缩

---

柱面*磁头*扇区*512字节=磁盘容量
磁盘分区信息存储在 MBR 里面
MBR 最多可以记录四条分区, 所以一个磁盘最多能分4个分区(主分区或扩展分区)
扇区是磁盘的最小存储单位(512字节); 逻辑块是文件系统指定的最小存储单位
ext2 文件系统将文件分为两部分存放: 属性放在 inode 中, 内容放在块区域中
读取文件过程:
    1. 通过一层层目录获取文件相关的关联数据
    2. 到对应的 inode 获取文件属性以及文件内容数据所在快
    3 .到对应块区域获取文件内容
元数据存储在
    超级块(SuperBlock): 即分区中的一个逻辑块, 记录本分区信息. 包括:
        块与 inode 的总量和使用量, 大小
        文件系统载入时间, 最后写入时间, 最后一次磁盘检验时间等
        有效位(已载入为0, 未载入为1)
    块位图 : 记录块是否可用
    inode 位图 : 记录 inode 是否可用
数据存储在
    inode 表是每个 inode 的数据存放区
    数据块(Data Block) 是每个块的数据存放区
载入点就是该文件系统的入口
连接文件
    硬连接 : 在某个目录下的块多写入一个关联数据, 所以不占用 inode 与磁盘空间
    符号链接 : 相当于快捷方式, 是个独立文件, 会占用 inode 与块

# Process

## Concept

进程之间通过**进程信号**通信
1 HUP 挂起 (可能的话就停止)
2 INT 中断
3 QUIT 结束
9 KILL 无条件终止
11 SEGV 段错误
15 TERM 尽可能终止
17 STOP 无条件停止, 但不终止
18 TSTP 停止或暂停, 继续在后台运行 (ctrl+z)
19 CONT 在 STOP 或 TSTP 后恢复执行

## Commands

`ps`
    `-e` 所有
    `-f` 额外信息
    `-l` 更多信息
    `--forest` 层级信息
`top`
`kill pid` 不支持指定进程名
    `-s sig_no`
`killall` 支持指定进程名, 如 `http*`


## 属性

UID: 启动进程的用户 ID
USER: 启动进程的用户名
PID: 进程 ID
PPID: 父进程 ID
C/CPU: CPU 利用率
STIME: 启动时间
TTY: 终端设备
TIME/TIME+: 累计 CPU 时间
CMD/COMMAND: 命令
F: 系统标记 ?
S/STAT: 状态
    O: 运行
    D: 可中断的休眠状态
    S: 休眠
    R: 等待运行
    Z: 僵化 (父进程无响应)
    T: 跟踪或停止
PP/PRI: 优先级 (越大越低)
NI: 谦让度
ADDR: 内存地址
MEM: 占用内存
VSZ/VIRT: 所占虚拟内存
RSS/RES: 所占物理内存
SHR: 共享内存
SZ: 换出时所需交换空间大小
WCHAN: 休眠的内核函数地址

# Admin

`mount device directory`
    `-t type` 类型
    `-o option` 选项: `ro`, `rw`, `user`, `check=no`, `loop`
`umount [device|directory]`
`df` 磁盘剩余空间
    `-h` 易读展示
`du` 磁盘使用情况
    `-c` 所有文件总大小
    `-h` 易读展示
    `-s` 统计信息
`lsof` 显示使用设备的进程

`sort`
    `-n` 按整数值排序
    `-g` 按浮点值排序, 支持科学计数法
    `-M` 按月排序
    `-b` 忽略起始空白
    `-c` 检查是否排序
    `-i` 忽略不可打印字符
    `-o` 结果写出到文件
    `-r` 反序
    `-d` 仅考虑空白和字符, 不考虑特殊字符
    `-f` 忽略大小写
    `-t sep` 指定字段分隔符
    `-k from_no [to_no]` 指定排序字段
`grep pattern [file]`
    `-v` 反向搜索
    `-n` 显示行号
    `-c` 显示匹配行数
    `-e pattern` 指定多个模式
`egrep` 支持 POSIX 扩展正则
`fgrep` 通过文件读入匹配模式

`gzip file`
`bzip2`
`zip`
`gzcat`
`gunzip `
`compress`
`tar function [option] file...`
    function
        `-A` concat,`-c` create, `-d` diff/delete, `-r` append
        `-t` list, `-u` update, `-x` extract
    `-C dir` 切换到目录
    `-f file` 输出到文件或设备
    `-j` 输出重定向到 bzip2
    `-z` 输出重定向到 gzip
    `-p` 保留所有文件权限


# Command
;               连续命令
|               管道
>               导出
>>              追加导出
&               后台执行
&&              成功则执行
||              失败则执行
\               转义/断行
``              先执行的命令
()              子 shell
[]              字符组合
{}              命令区块组合


!!              重复上次命令
!$              重复上次命令的参数
!num          执行第 num 条历史命令
!search       搜索历史命令开头为 search 并执行

man             查找 man 帮助
    k               通过关键字查找
apropos, man -k 查找 whatis 帮助
whatis, man -f      查找 whatis 帮助
info                查找 info 帮助
help
which

date            当前日期和时间
cal             本月日历
uptime          运行时长
w               在线用户
whoami          自己用户名
finger          用户信息
uname           内核信息
df              磁盘使用信息
du              目录空间信息
free            内存/交换区使用信息
vmstat          show system process, memory, swap, I/O and CPU statistics
iostat          CPU 和硬盘 IO 数据
mpstat          multiprocessor usage
lsof            list open files
lscpu           cpu info
pmap            process memory usage
sar             collect, report or save sytem activity information
netstat         网络状态
ss              TCP/UDP network and socket information
iptraf          IP LAN Monitor
tcpdump     detailed network traffic analysis
strace          trace system call and signals
/procfile system


chkconfig       检查系统服务运行级别
service         启动或关闭服务

ifconfig        网络接口配置
iwconfig        无线配置
setup           运行配置
whois           域名信息
dig             dns 信息
wget            下载

ssh             运行 ssh

cd              进入目录
pwd             显示当前工作目录
ln              链接
mkdir           创建文件夹
rmdir           删除文件夹
ls              列出文件列表
ll              ls -l 别名
cp              复制
mv              移动/重命名
rm              删除
basename        获取路径中的文件名
dirname         获取路径中的目录名
chgrp           更改文件所属用户组
chown           更改权限
disown
cat             由第一行开始显示文件内容
tac             有最后一行开始显示文件内容
nl              带行号的显示文件内容
more            逐页显示
less            比 more 强大, 可以前翻页
head            显示文件前几行
tail            显示文件后几行
od              以二进制方式读取文件内容
touch           创建文件或修改文件时间属性
umask           指定默认文件权限掩码
chattr          设置文件隐藏属性
lsattr          显示文件隐藏属性
file            获取文件类型
stat            获取文件详情
which           定位可执行文件/命令
whereis     寻找特定文件
locate          定位文件
find            查找文件
    -maxdepth
    -mindepth
    -not, !
    -inum
    -user
    -group
    -name
    -iname
    -type
    -empty
    -perm
    -mtime
    -atime
    -cmin
    -mmin
    -amin
    -size
    -exec
echo            显示一行文本
grep            查找文件内容
    -i, --ignore-case
    -v, --invert-match
    -w, --word-regexp
    -x, --line-regexp
    -A NUM, --after-context=NUM
    -B NUM, --before_context=NUM
    -C NUM, --context=NUM
    -c, --count
    -n, --line-number
    -r,  --recursive
    -l, --files-with-matches
    -L, --files-without-matches
    -o, --only-matching

df              磁盘信息
du              磁盘用量信息
ln              创建连接文件
fdisk           分区
mkfs            格式化磁盘
mke2fs          格式化磁盘为 ext2/ext3 格式
mkswap      格式化为 swap 格式
swapon      启动 swap
swapoff     关闭 swap
mkbootdisk  制作启动软盘
fdformat        软盘低级格式化
fsck            检查/修正磁盘错误
    如发现任何错误文件, 会放入 lost+found 目录
    必须卸载分区后再执行此命令
badblocks       检查坏轨
sync            将异步的内存数据写入硬盘
mount           挂载分区
umount      卸载分区
mknod           修改磁盘信息(卷标, 日志等)
e2label         修改卷标
tune2fs         转换文件系统/读取超级块内容/修改卷标
hdparm      修改磁盘高级参数
    一般最多用来启动 DMA 模式, 不要随意用其修改参数, 除非你知道自己在做什么

compress        压缩/解压
gzip            压缩/解压
gcat            读取压缩文件内容
bzip2           压缩/解压
bzcat           读取压缩文件内容
tar             打包/压缩/解压文件
dd              读取设备内容并备份成文件
cpio            适合备份使用

useradd         增加或更改用户

yum             包管理
make            编译

curl            传输一个 url

ps              查看活动进程
jobs            显示作业
nohup           运行一个关机免疫进程
top             查看正在运行的进程
kill            清除指定进程
killall         清除指定进程树
bg              查看背景进程
fg              转到前景进程

unix2dos
dos2unix

init                初始化
shutdown        关机
halt            同上
reboot          重启
startx          开启图形界面

type            查看命令类型/查找命令
echo            获取变量
export          转换为环境变量
source          读取到环境变量
env             列出所有环境变量
set             列出所有变量(环境+自定义)/设置输入输出环境

cut             剪切命令输出
grep            搜索命令输出
sort            排序命令输出
wc              计算命令输出数据
uniq            去除重复的命令输出

locale          显示支持的语系
alias           设置命令别名
unalias         取消命令别名
history         显示历史命令
compgen         显示可用命令

ulimit          限制用户资源使用


# Viriable

# Problem
忘记 root 密码
    进入单人维护模式, 运行 passwd 命令
扇区错乱
    运行 fsck 命令
etc/fstab 配置错误而无法正常启动
    mount -n -o remount,rw /

# Snippets
find 'word' recusively in file:
    find . -type f -exec grep -l "word" {} +
    find -name '*.php' -exec grep 'word' {} +
    grep 'word' * -r .
find files whose last modified time is more recentely than a.php
    find -newer a.php
check out the distribution version
    cat /etc/*-release
    uname -a
check the memory info
    cat /proc/meminfo
    vmstat
    top
see connected ftp user:
    pure-ftpwho
back up web
    - use tar
        tar -czf /where/you/want/to/save.tar.gz /path/to/your/web
    - use rsync
        ...
back up database
    mysqldump  dbName-u user -p pwd | gzip > /where/you/want/to/save.gz
cp and change all *.php to *.m.php
    for script in *.php;
        do cp -- "$script" "${script%.php}.m.php";
    done
after adding a alias into /root/.bashrc, let the alias take effect immediately:
    source /root/.bashrc
configure ssh from host(win7) to vbox centOS
    1. create new port forwarding rule in vbox->setting->network->port forwarding
        name:ssh, host port:3022, guest port 22
    2. in putty, ssh to root@127.0.0.1:3022
display largest size file/folder:
    ls -lSh | head -20
show folder/file size in current folder
    du -sh --max-depth 1
list group
    cat /etc/group
run httpd, mysqld at startup
    chkconfig --level 235 httpd on
    chkconfig --level 2345 mysqld on
open port for httpd
    iptables -I INPUT 5 -i eth1 -p tcp --dport 80 -m state --state NEW,ESTABLISHED -j ACCEPT
    service iptables save
solve `this account is currently not available` error when su apache
    @/etc/passwd:
    change apache's shell from /sbin/nologin to /bin/bash
tar
    tar -czvf       // tar and zip
    tar -xzvf       // untar and unzip
    tar -xzvkf      // untar and unzip, without override existing files
    tar -tf         // see the tarball file list
change prompt color:
    `export PS1="\e[0;36m[\u@\h \W]\$\e[m"`


# jargon to be explained
device header row
zombie
load average
memory leak
waiting for run time
uninterruptible sleep
paging
block IO
traps
forks, vfork, clone system calls
slab, objects
slabinfo
buffers, caches
swap in, swap out
nice, renice, nice pripority
si, so, bi, bo, in, cs
user time, nice time, system time, stolen time

# Quote on IRC
synapt:
    - technically www.neejolie.fr and neejolie.fr could have different IP addresses because www.* is nothing but a subdomain record

# Coodie:
- find out whether port 80 is in use: `sudo lsof -i:80 | grep LISTEN`
