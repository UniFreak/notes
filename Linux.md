# See
- Book: Linux Bible E.3
- <Bash.*.md>

# 基本概念

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

常见标准选项
- `-a` 所有
- `-c` 计数
- `-d` 目录
- `-e` 扩展
- `-f` 文件
- `-h` 帮助
- `-i` 忽略大小写
- `-l` 长格式
- `-n` 非交互/批处理模式
- `-o` 输出文件
- `-q` 安静模式
- `-s` 安静模式
- `-r` 递归
- `-v` 详细输出
- `-x` 排除
- `-y` 默认 yes

---

学习 Linux 不在于记住所有命令行参数, 而是记住那些常用的

# Get Help

命令一般都有 `-help` / `--help` 选项

`man [section_no] command`
    `-k keyword`
`apropos`
`whatis`
`info`

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

# 文件系统

**扇区** 是磁盘的最小存储单位(512字节), **逻辑块** 是文件系统指定的最小存储单位.
磁盘分区信息存储在 **MBR** 里面. MBR 最多可以记录四条分区, 所以一个磁盘最多能分4个分区 (主分区或扩展分区)

**分区** 用于容纳文件系统, **主分区** 可以被文件系统直接格式化, **扩展分区** 只能容纳其他 **逻辑分区**
通过 **格式化** 分区创建不同的文件系统
通过 **挂载** 将格式化好的文件系统挂载到虚拟目录下的某个 **挂载点**
`/etc/fstab` 定义了系统启动时自动挂载的文件系统

读取文件过程:
1. 通过一层层目录获取文件相关的关联数据
2. 到对应的 inode 获取文件属性以及文件内容数据所在快
3. 到对应块区域获取文件内容

元数据存储在
- **超级块** (SuperBlock): 即分区中的一个逻辑块, 记录本分区信息. 包括:
    块与 inode 的总量和使用量, 大小
    文件系统载入时间, 最后写入时间, 最后一次磁盘检验时间等
    有效位(已载入为0, 未载入为1)
- 块位图: 记录块是否可用
- inode 位图: 记录 inode 是否可用

数据存储在
- inode 表是每个 inode 的数据存放区
- **数据块** (Data Block) 是每个块的数据存放区

**载入点** 就是该文件系统的入口

基本文件系统
- ext
    通过在物理设备中的**索引节点表**中的**索引节点**维护**虚拟目录**中文件的信息
    通过索引节点号唯一标识文件
- ext2
    通过按组分配磁盘块减轻碎片化, 因容易在系统崩溃或断电时损坏而臭名昭著

日志文件系统
    将更改写入临时文件 (journal), 成功写入到存储设备和索引节点后删除日志条目
    有三个保护等级
    - 数据模式: 安全, 慢,
    - 有序模式: 折中
    - 回写模式: 不安全, 快
- ext3: 基本的日志功能; 缺少压缩和加密功能
- ext4: **区段**技术, 节省索引节点表空间; 块预分配技术
- Reiser: 回写; 尾部压缩技术; 在线调整大小
- JFS: 有序; 区段
- XFS: 回写; 在线调整大小

**写时复制(COW)文件系统**
    日志式的另一种选择. 修改过的数据放入另一位置, 不覆盖当前数据
- ZFS: 没有 GPL 许可 -> OpenZFS
- Btrfs: B 树; 动态调整大小

使用 **逻辑卷管理器(LVM)** 可以将另一个硬盘上的分区加入已有文件系统, 动态添加存储空间
硬盘称为 **物理卷(PV)**, 多个物理卷形成一个 **卷组(VG)**. LVM 将 VG 视为一个物理硬盘
**逻辑卷(LV)** 则提供创建文件系统的分区环境, Linux 将 LV 视为物理分区

使用逻辑卷一般步骤:
1. 使用 fdisk t 命令, 转换物理分区为物理卷区段
2. 使用 pvcreate, 用分区创建实际的物理卷
3. 使用 vgcreate, 从物理卷创建一个或多个卷组
4. 使用 lvcreate, 创建逻辑卷
5. 创建所需的文件系统

## 常用命令

管理文件系统

`fdisk` 分区工具
`partprob` 或 `hdparm` 重新读取分区表
`mkefs`  格式化 ext
`mke2fs` 格式化 ext2
`mkfs.ext3` 格式化 ext3
`mkfs.ext4` 格式化 ext4
`mkreiserfs` 格式化 ReiserFS
`jfs_mkfs` 格式化 JFS
`mkfs.xfs` 格式化 XFS
`mkfs.zfs` 格式化 ZFS
`mkfs.btrfs` 格式化 Btrfs
`fsck options fs` 检查修复, 只能检查未挂载的文件系统

管理逻辑卷

`pvcreate` 创建 pv
`pvdisplay` 查看 pv
`vgcreate` 创建 vg
`vgdisplay` 查看 vg
`vgchange` 激活/禁用 vg
`vgremove` 删除 vg
`vgextend` 扩展 vg
`vgreduce` 减小 vg
`lvcreate` 创建 lv
`lvdisplay` 查看已有 lv
`lvextend` 扩展 lv
`lvreduce` 减小 lv

# 目录及文件

`inode`: 用于标识文件系统中的每一个对象

硬链接 VS 软链接:
    硬连接:
        在某个目录下的块多写入一个关联数据, 所以不占用 `inode` 与磁盘空间.
        硬链接实际上是指向原文件 `inode` 的指针, 本身不会产生新的 `inode`, 只是会增加结点连接数 (引用计数).
        只要结点链接数不为 0, 文件就存在
        通过 `ls -l` 可查看到, 两个文件的 `inode` 一样
    符号链接:
        可理解为 Windows 的快捷方式, 是个独立文件, 会占用 `inode` 与块, 其内容即为原文件路径指针.
        通过 `ls -l` 可查看到, 两个文件的 `inode` 不一样
        **千万别创建软链接的软链接**

别忘了可以将多个参数结合起来, 如 `ls -alF`, 这样更容易记忆.

Shell 命令参数经常有相同含义, 如 `-r` 代表递归, `-F` 代表强制, `-i` 代表交互询问等等

擅长使用 tab 自动补全, 可以减少误输入

时间
- mtime           modify time
- ctime           change time
- atime           access time

`0` 标准输入 stdin (键盘)
`1` 标准输出 stdout (屏幕)
`2` 标准错误 stderr

文件类型
- `-` 文件
- `d` 目录
- `l` 链接
- `c` 串设备
- `b` 块设备
- `s` 套接字
- `n` 网络设备
- `p` 管道(FIFO, pipe)

常见压缩格式
- `.Z`              compress 压缩
- `.bz2`            bzip2 压缩
- `.gz`             gzip 压缩
- `.tar`            tar 打包
- `.tar.gz`         tar 打包然后 gzip 压缩

常见文件和目录

```
~/.bash_logout

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

特殊文件和目录

- `.` 本目录
- `..` 上级目录
- `~` 家目录
- `-` 原目录
- `.+文件名` 隐藏目录/文件

## 模式匹配

- `?`: 一个字符
- `*`: 多个字符
- `[a-i]`: 范围
- `[!a]`: 排除

用于 `ls` 过滤: `ls -l my_scr[ai]pt`

## 常用命令

遍历目录

`cd`
`pwd`

列表

`ls`
    `-F` 区分目录和文件
    `-a` 显示隐藏文件
    `-R` 递归输出子目录
    `-d` 只列出目录
    `-l` 输出每个文件更多信息
`tree`

处理文件

`touch` 创建新文件, 或改变文件修改时间
    `-a` 改变文件访问时间
`cp`
    `-i` 询问
    `-R` 递归

`ln` 创建硬链接
    `-s` 创建软链接
`mv`
`rm`
    `-i` 询问 (使用 rm 时, 总是加上 `-i` 是个好习惯)
    `-f` 强制
`mkdir`
    `-p` 带上子目录
`rmdir`
    `-i` 询问
    `-r` 递归
    `-f` 强制

查看文件内容

`file`: 类型
`cat`
    `-n` 显示所有行行号
    `-b` 仅显示非空行行号
    `-T` 排除制表符
`tac` 反序显示
`more`
`less`
`tail`
    `-n 行数` 或 `-行数`
`head`
    `-n 行数` 或 `-行数`

# 程序/进程管理

进程之间通过**进程信号**通信

- 1 SIGHUP 挂起 (可能的话就停止)
- 2 SIGINT 中断 (ctrl+c)
- 3 SIGQUIT 结束
- 9 SIGKILL 无条件终止
- 11 SIGSEGV 段错误
- 15 SIGTERM 尽可能终止
- 17 SIGSTOP 无条件停止, 但不终止
- 18 SIGTSTP 停止或暂停, 继续在后台运行 (ctrl+z)
- 19 SIGCONT 在 STOP 或 TSTP 后恢复执行

常见输出属性

- `UID` 启动进程的用户 ID
- `USER` 启动进程的用户名
- `PID` 进程 ID
- `PPID` 父进程 ID
- `C/CPU` CPU 利用率
- `STIME` 启动时间
- `TTY` 终端设备
- `TIME/TIME+` 累计 CPU 时间
- `CMD/COMMAND` 启动命令
- `F` 系统标记
- `S/STAT` 状态
    + `O` 运行
    + `D` 可中断的休眠状态
    + `S` 休眠
    + `R` 等待运行
    + `Z` 僵化 (父进程无响应)
    + `T` 跟踪或停止
- `PP/PRI` 优先级 (越大越低)
- `NI` 谦让度
- `ADDR` 内存地址
- `MEM` 占用内存
- `VSZ/VIRT` 所占虚拟内存
- `RSS/RES` 所占物理内存
- `SHR` 共享内存
- `SZ` 换出时所需交换空间大小
- `WCHAN` 休眠的内核函数地址

## 命令

监测程序

`ps`
    `-e` 所有
    `-f` 额外信息
    `-l` 更多信息
    `--forest` 层级信息 (在 Mac 上则需用 `pstree`)
`top`: 实时显示
`kill pid`: 不支持指定进程名
    `-s <信号>`
`killall`: 支持指定进程名, 如 `http*`

# 作业管理

通过在命令后加 `&` 将命令置入**后台模式**, 如 `sleep 3000&`.
也可以将进程列表置入后台模式, 如 `(pwd; cd /etc)&`
后台运行的程序依然会输出 STDERR 和 STDOUT 到显示器, 最好进行重定向以避免杂乱输出
若终端会话退出, 后台进程也会随之退出; 可以使用 `nohop cmd` 避免, `nohop` 运行的命令会输出到 `nohop.out`

`jobs` 当前处理中的作业
    `-l` 显示 PID 和作业号
    `-p` 只列出 PID
    `-r` 只运行中的
    `-s` 只已停止的
`bg jobno`
`fg jobno`
`nice -n num cmd` 指定谦让度运行命令
`renice -n num -p PID` 调整谦让度
`at [-f script] time` 定时执行
    `-M` 屏蔽输出
`atq` 查看作业队列
`atrm` 删除作业队列中的作业
`crontab` 管理定期执行作业
`anacron` 管理定期作业 (能感知作业错过, 并尽快执行)

# 磁盘管理

`mount device directory>`
- `-t type` 类型
- `-a` 挂载 `/etc/fstab` 文件中指定的所有文件系统
- `-f` 模拟挂载
- `-F` 和 -a 一起使用时, 会同时挂在所有文件系统
- `-v` 详细模式
- `-n` 挂载, 但不注册到 /etc/mtab 已挂在设备文件中
- `-s` 忽略该文件系统不支持的挂载选项
- `-r` 挂载为只读
- `-w` 挂在为读写 (默认)
- `-L` label 指定 label
- `-U` 指定 UUID
- `-o option` 选项: `ro`, `rw`, `user`, `check=no`, `loop`

`umount [device|directory]`

`df` 磁盘剩余空间
    `-h` 易读展示
`du` 磁盘使用情况
    `-c` 所有文件总大小
    `-h` 易读展示
    `-s` 统计信息
`lsof` 显示使用设备的进程

处理数据文件

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
    `-t sep` 指定字段分隔符. 如 `-t : -k 3` 按 : 分割字段, 并按第三个字段排序
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
    function:
        `-A` 追加 tar 文件
        `-c` 创建
        `-d` 查异/删除
        `-r` 追加文件
        `-t` 列出 tar 文件内容
        `-u` 追加比 tar 文件内同名文件的新文件
        `-x` 提取
    `-C dir` 切换到目录
    `-f file` 输出到文件或设备
    `-j` 输出重定向到 bzip2
    `-z` 输出重定向到 gzip
    `-p` 保留所有文件权限

# Shell

登录系统时启动的 shell 即 **登录 shell**, 登录 shell 启动时, 会查找并运行下列文件
1. `/etc/profile` 主启动文件, 影响每个用户
2. `/etc/profile.d` 大部分与特定应用有关
3. 按照顺序查找 `~/.bash_profile`, `~/.bash_login`, `~/.profile` **其一**运行, 并忽略其他

**交互 shell** 指用户通过运行 `bash` 生成的 shell. `etc/passwd` 中定义了默认的交互 Shell. 交互 shell 启动时, 会运行 `~/.bashrc`.

**非交互 shell** 指系统执行 shell 脚本时用的 shell. 非交互 shell 启动时, 会检查 `BASH_ENV` 变量中定义的 **启动文件**

`/bin/sh` 是 **系统默认 shell**, 用于需要在启动时使用的系统 shell 脚本

运行 **外部命令** 时, 会创建 (fork) 一个子进程. 外部命令通常位于 `/bin`, `usr/bin`,
`/sbin`, `/usr/sbin` 中. **内部命令** 则不需要, 它们已经和 Shell 编译成一体

## 子 Shell

多个命令可以写在一行, 通过 `;` 分割, 这称为 **命令列表**, 如 `pwd; ls; cd /etc`.
如果用括号包住, 则为 **进程列表**, 进程列表会通过创建 **子 shell** 执行.
可以通过嵌套括号创建多层子 shell, 如 `(pwd; cd /etc; (echo $BASH_SUBSHELL))`
生成子 shell 时, 只有部分父进程的环境被复制到子 shell 环境中.
`$BASH_SUBSHELL` 保存了子 shell 的个数.

**协程 (coproc)** 会在后台生成一个子 shell, 并在其中执行命令

脚本中经常使用子 shell 进行多进程处理, 但是会拖慢速度.

常见子 Shell 应用模式
- 配合后台模式 (使用 &): 将繁重任务的进程列表置入后台模式
- 使用协程 (coproc), 它会自动创建子 Shell 并置入后台模式
- 结合协程和进程列表:

## 常用命令

`coproc` 生成协程

`which`

`type` 命令类型 (区分外部命令, 内部命令等)
- `-a` 查看不同实现

`history`
- `-a` 写入文件 (历史命令存于内存, 默认在退出时写入 `~/.bash_history`)
历史命令存于 `~/.bash_history` 中, `$HISTSIZE` 定义了其大小. 可以使用下面命令操作:
- `!!` 重复上次命令
- `!$` 重复上次命令的参数
- `!num` 执行第 num 条历史命令
- `!start` 搜索历史命令开头为 start 并执行

`alias`: 命令别名. 别名仅在他所被定义的 shell 进程中有效
`-p` 查看可用别名

# 环境变量

**全局变量** 对所有 shell 会话和子 shell 都可见, **局部变量** 只对创建它的 shell 可见.

**用户自定义变量**:
变量名区分大小写, 全局和局部变量一般全部大写, 用户自定义变量最好全用小写
通过 `变量名=值` 设置变量, 注意等号两遍**没有空格**
通过 `export` 可导出到局部变量到全局环境中, 通过 `unset` 删除

环境变量持久换:
- 全局变量: 最好放在 `/etc/profile.d` 目录中创建的一个以 `.sh` 结尾的文件中
- 个人用户变量: 一般放在 `.bashrc` 中
- 非交互 shell 的用户变量: 除非 `BASH_ENV` 指向的是 `.bashrc`, 否则应该放在别的地方

子 shell 无法继承父 shell 的局部变量
修改或删除子 shell 中的全局变量 **不会** 影响其父 shell 中的值
- 即使用 `export` 也不能修改全局变量的值
- 即使用 `unset` 也不能删除全局变量

## 预定义变量

Bourne 变量

|变量|描述|
|------|------|
|CDPATH|冒号分割的目录列表, 作为 cd 命令的搜索路径|
|HOME|当前用户的主目录|
|IFS|用来将文本字符串分割成字段的一系列字符|
|MAIL|当前用户收件箱的文件名|
|MAILPATH|冒号分割的当前用户收件箱的文件名列表|
|OPTARG|getopts 命令处理的最后一个选项参数值|
|OPTIND|getopts 命令处理的最后一个选项参数的索引号|
|PATH|查找命令的目录列表, 冒号分割|
|PS1|主提示符|
|PS2|次提示符|

Bash Shell 变量

|变量|描述|
|------|------|
|BASH|当前 shell 实例的全路径名|
|bash_aliases|含有当前已设置别名的关联数组|
|BASH_ARGC|传入子函数或脚本的参数总数的数组变量|
|bash_argv||
|BASH_CMDS||
|BASH_COMMAND||
|BASH_ENV||
|BASH_EXECUTION_STRING||
|BASH_LINENO||
|BASH_REMATCH||
|BASH_SOURCE||
|BASH_SUBSHELL||
|BASH_VERSINFO||
|BASH_VERSION||
|BASH_XTRACEFD||
|BASHOPTS||
|BASHPID||
|COLUMNS||
|COMP_CWORD||
|COMP_LINE||
|COMP_POINT||
|COMP_KEY||
|COMP_TYPE||
|COMP_WORDBREAKS||
|COMP_WORDS||
|COMPREPLY||
|COPROC||
|DIRSTACK||
|EMACS||
|ENV||
|EUID||
|FCEDIT||
|FIGNORE||
|FUNCNAME||
|FUNCNEST||
|GLOBIGNORE||
|GROUPS||
|HISTCHARS||
|HISTCMD||
|HISTCONTROL||
|HISTFILE||
|HISTFILESIZE||
|HISTTIMEFORMAT||
|HISTIGNORE||
|HISTSIZE||
|HOSTFILE||
|HOSTNAME||
|HOSTTYPE||
|IGNOREEOF||
|INPUTRC||
|LANG||
|LC_ALL||
|LC_COLLATE||
|LC_CTYPE||
|LC_MESSAGES||
|LC_NUMERIC||
|LINENO||
|LINES||
|MACHTYPE||
|MAPFILE||
|MAILCHECK||
|OLDPWD||
|OPTERR||
|OSTYPE||
|PIPESTATUS||
|POSIXLY_CORRECT||
|PPID||
|PROMPT_COMMAND||
|PROMPT_DIRTRIM||
|PS3||
|PS4||
|PWD||
|RANDOM||
|READLINE_LINE||
|READLINE_POINT||
|REPLY||
|SECONDS||
|SHELL||
|SHELLOPTS||
|SHLVL||
|TIMEFORMAT||
|TMOUT||
|TMPDIR||
|UID||

引用变量 @?
- `$`, 如 `echo $myvar`
- `${var:=foo}`
- `${var:=foo}`
- `${var:?foo}`
- `${var:+foo}`
- `${var:offset:length}`

## 常用命令

`printenv [env]` 打印全部或指定全局变量
`env` 打印全部全局变量
`echo $env` 打印变量
`set` 打印全部局部, 全局和用户自定义变量
`unset` 删除环境变量
`export` 导出局部变量为全局变量

## Array

通过 `变量名=(值 值 值...)` 设置数组变量

使用
- 某一项 `${arr[索引]}`
- 所有项 `${arr[*]}`
- 数组长度 `${#arr[*]}` 或 `${#arr[@]}`
- 某一项长度 `${#arr[索引]}`
- 所有索引 `${!arr[*]}` 或 `${!arr[@]}`

关联数组:

```sh
declar -A arr
arr=([a]=b [c]=d)
```

# 用户管理和权限

**系统账户** 不是真的 **用户账户**, 而是各种服务进程访问资源用的特殊账户. 运行在后台的服务都需要
用一个系统用户账户登录到系统上. Linux 为系统账户预留了 500 以下的 UID 值和 GID 值.

`/etc/passwd` 账户信息, 格式 `名:密码x:UID:GID:备注:主目录:shell`
`/etc/shadow` 密码信息, 格式 `名:密码:过期天:改密天:强制改密天:提醒天:禁用天:被禁日:预留`
`/etc/group` 组信息, 格式 `名:密码:GID:用户列表`

三组权限级别: 属主, 属组, 其他

权限符

`r` 可读 4
`w` 可写 2
`x` 可执行 1, 是目录则决定是否可进入
`-` 无权限 0

`SUID` 4 set uid, 程序以属主权限运行
`SGID` 2 set gid, 对文件来说, 以文件属组权限运行; 对目录来说, 在目录中创建的新文件会以目录默认属组为新文件默认数组
`SBit` 1 sticky bit, 进程结束后文件还驻留在内存中. 只有属主和 root 可删除该文件

权限 (rwx) 和 SUID+SGID+SBIT 都可以用三个二进制位或一个八进制位表示

SGID 对文件共享非常重要. 如果要共享一个目录:
1. 用 mkdir 创建这个目录
2. 用 chgrp 将目录的默认属组改成包含所有需要共享文件的用户的组
3. 将目录的 SGID 置位, 保证新建文件都用目录的默认属组作为默认属组
4. 所有组成员都需要把它们的 umask 值设置成文件对数组成员可写, 如 002

一个级别的权限可通过三个二进制表示: `r`,`w`,`x`:  1; `-`: 0. 如 `r-w` -> `101`
或一个八进制表示, 如 `r-w` ->`101` -> `5`
文件的全权限为 666, 目录的全权限为 777
默认权限=全权限-权限掩码

## 常用命令

用户

`finger` 查看用户信息
`useradd` 添加用户
    `-D` 显示或更改默认值
    `-m` 使用默认值
    `-c comment`
    `-d home_idr`
    `-e expire_date`
    `-f inactive_days`
    `-g intitial_group`
    `-G group...`
    `-k` 必须和 -m 一起使用, 将 `/etc/skel` 目录内容复制到用户 HOME 目录
    `-m` 创建用户主目录
    `-M` 不创建用户主目录
    `-n` 创建与用户登录名同名的新组
    `-r` 创建系统账户
    `-p passwd` 指定默认密码
    `-s shell` 指定默认登录 shell
    `-u uid` 指定 UID
`userdel`
    `-r` 删除主目录
`usermod`
    `-l` 登录名
    `-L` 锁定
    `-p` 密码
    `-U` 解锁
    `-g` 默认组
    `-G group user` 添加到组
`passwd`
    `-e` 强制改密
`chpasswd` 通过文件改密
`chsh` 改 shell
`chfn` 修改 finger 信息
`chage` 改有效期
    `-d` 改密后天数
    `-E` 过期日期
    `-I` 锁定前天数
    `-m` 改密期限天数
    `-W` 改密前提醒天数
`groupadd`
`groupmod`

权限

`umask` 查看或设置权限掩码
`chmod options mode file` 更改文件权限
    在符号模式下指定权限: `[ugoa] [+-=] [rwxXstugo...]`
    u 用户, g 组, o 其他, a 所有
    + 增加, - 移出, = 置为
    X: 如果对象是目录或者它已有执行权限, 赋予执行权限
    s: 运行时重新设置 UID 或 GID
    t: 保留文件或目录
    u: 设置为跟属主一样
    g: 设置为跟属组一样
    o: 设置为跟其他一样
    `-R` 递归修改
`chown options owner[.group] file` 更改所属关系
    `-R` 递归修改
    `-h` 修改符号链接文件
`chgrp group file`  更改文件默认属组

# 软件包管理

软件包存储于 **仓库/源** 中, 通过 **PMS** 即包管理工具与其通信进行软件安装更新等
某包的 **依赖** 可能被另一个包的安装覆盖掉, 产生 **损坏的依赖关系 broken dependency**

Debian 家族(Ubuntu, Linux Mint) 用 dpkg/apt(核心), aptitude(前端工具)
仓库配置于 `/etc/apt/sources.list`, 格式: `deb/deb-src address dist_name pkg_types`
- deb 已编译程序源
- deb-src 源代码源
- address 仓库地址
- dist_name 仓库发行版版本名称, 如 trusty
- pkg_types 所包含的包类型, 如 main, restricted, universe, partner

`aptitude`
    `show pkg`
    `search pkg`
    `install pkg`
    `safe-upgrade`
    `full-upgrade`
    `dist-upgrade`
    `remove` 删除包
    `purge` 删除包, 数据和配置
`dpkg`
    `-L pkg` 列出软件安装的全部文件
    `--search file` 查找文件属于哪个软件包

---

RedHat 家族用 rpm(核心), 及以下前端工具
- Red Hat, Fedora: yum
- Mandriva: urpm
- openSUSE: zypper
仓库配置于 `/etc/yum.repos.d/`

`yum`
    `list installed|updates` 列出已安装|需更新包
    `list pkg` 包信息
    `provides file` 查找文件属于哪个包
    `install pkg` 安装
    `localinstall file.rpm` 本地(下载之后)安装
    `update [pkg`] 更新
    `remove pkg` 删除包
    `erase pkg` 删除包, 数据和配置
    `clean all` 清理
    `deplist pkg` 显示依赖关系
    `repolist` 查看当前源

---

源码安装一般步骤
1. 下载源码文件, 如 `pkg.tar.gz`
2. 解压: `tar -zxvf pkg.tar.gz`
3. `cd pkg`
4. 参阅 README/AAAREADME
5. 配置并检查编译器和依赖关系: `./configure`
6. 编译, 链接, 构建二进制文件: `make`
7. 将可执行文件移到常用位置: `make install`

# 其他命令

date            当前日期和时间
cal             本月日历
uptime          运行时长
w               在线用户
whoami          自己用户名
uname           内核信息
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
tcpdump         detailed network traffic analysis
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
mknod           修改磁盘信息(卷标, 日志等)
e2label         修改卷标
tune2fs         转换文件系统/读取超级块内容/修改卷标
hdparm      修改磁盘高级参数
    一般最多用来启动 DMA 模式, 不要随意用其修改参数, 除非你知道自己在做什么

dd              读取设备内容并备份成文件
cpio            适合备份使用

yum             包管理
make            编译

curl            传输一个 url

nohup           运行一个关机免疫进程
bg              查看背景进程
fg              转到前景进程

unix2dos
dos2unix

init                初始化
shutdown        关机
halt            同上
reboot          重启
startx          开启图形界面

export          转换为环境变量
source          读取到环境变量

cut             剪切命令输出
wc              计算命令输出数据
uniq            去除重复的命令输出

locale          显示支持的语系
unalias         取消命令别名
compgen         显示可用命令

ulimit          限制用户资源使用


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

find out whether port 80 is in use: `sudo lsof -i:80 | grep LISTEN`


忘记 root 密码

    进入单人维护模式, 运行 `passwd` 命令

扇区错乱

    运行 `fsck` 命令
`etc/fstab` 配置错误而无法正常启动
    `mount -n -o remount,rw /`

broken dependency

    1. try `yum clean all`
    2. then `yum update`
    3. then `yum deplist pkg` and install

sync (backup) folder

    rsync -aE --delete source_folder/ dest_folder/