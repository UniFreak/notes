# See
- <https://www.lagou.com/lgeduarticle/31785.html>
- <https://www.jb51.net/it/692943.html>
- <https://blog.csdn.net/mengziwudao/article/details/99456399?utm_medium=distribute.pc_relevant_download.none-task-blog-baidujs-2.nonecase&depth_1-utm_source=distribute.pc_relevant_download.none-task-blog-baidujs-2.nonecase>
- <http://www.cnrencai.com/bishi/timu/3255.html>

# 单选

- innoDB redo undo log: <https://blog.csdn.net/qq_22857107/article/details/98761035>
- 全文搜索: <https://blog.csdn.net/bbirdsky/article/details/45368897>

$_REQUEST 变量默认情况下包含了 $_GET，$_POST 和 $_COOKIE 的数组。

1.有多少种日志 redo/undo 2.日志的存放形式 redo：在页修改的时候，先写到redo log buffer 里面，然后写到redo log 的文件系统缓存里面(fwrite)，然后再同步到磁盘文件（fsync）。 Undo：在MySQL5.5之前，undo只能存放在ibdata*文件里面，5.6之后，可以通过设置innodb_undo_tablespaces参数把undo log存放在ibdata*之外。 3.事务是如何通过日志来实现的，说得越深入越好。 因为事务在修改页时，要先记undo，在记undo之前要记undo的redo，然后修改数据页，再记数据页修改的redo。Redo（里面包括undo的修改）一定要比数据页先持久化到磁盘。当事务需要回滚时，因为有undo，可以把数据页回滚到前镜像的状态，崩溃恢复时，如果redo log中事务没有对应的commit记录，那么需要用undo把该事务的修改回滚到事务开始之前。如果有commit记录，就用redo前滚到该事务完成时并提交掉。

题目中，至少有一人能破译密码和三人都不能破译密码是对立事件。 所以至少有一人能译出的概率=1－三人都没译出的概率=1－(1－1/5)(1－1/3)(1－1/4)=1－2/5=3/5

在TCP/IP协议栈中，ARP协议的作用是由IP地址查找对应的MAC地址，RARP协议的作用正好相反，是由MAC地址查找对应的IP地址。

A：重放攻击指攻击者发送一个目的主机已接收过的包，来达到欺骗系统的目的，主要用于身份认证过程，破坏认证的正确性。重放攻击可以由发起者，也可以由拦截并重发该数据的地方进行。

B：Smurf攻击是一种病毒攻击，结合使用IP欺骗和ICMP回复方法使大量网络传输充斥目标系统，引起目标系统拒绝为正常系统进行服务。Smurf攻击通过使用将回复地址设置成网络的广播地址的ICMP应答请求数据包，来淹没受害主机，最终导致该网络的所有主机都对此ICMP应答请求做出回复，导致网络阻塞。更复杂的将源地址改为第三方的受害者，最终导致第三方崩溃。

C：字典攻击是在破解密码或密钥时，逐一尝试用户自定义词典中的可能密码的攻击方式。与暴力破解的区别是，暴力破解会逐一尝试所有可能的组合密码，而字典攻击会使用一个预先定义好的单词列表。

D：中间人攻击是一种间接的入侵攻击，这种攻击模式是通过各种技术手段将受入侵者控制的一台计算机虚拟放置在网络连接中的两台通信计算机之间，这台计算机称为“中间人”。通过拦截正常的网络通信数据，并进行数据篡改和嗅探，而通信的双方毫不知情。

14.下面有关内核线程和用户线程说法错误的是？
A、用户线程因<br>I/O 而处于等待状态时，整个进程就会被调度程序切换为等待状态，其他线程得不到运行的机会
B、内核线程只运行在内核态，不受用户态上下文的影响
C、用户线程和内核线程的调度都需要经过内核态
D、内核线程有利于发挥多处理器的并发优势，但却占用了更多的系统开支
参考答案：C
答案解析：用户线程不需要，不然golang就没有存在的意义了。
see: <https://www.jianshu.com/p/5a4fc2729c17>

静态链表: <https://www.jianshu.com/p/b003c4475ed1>

18.在HMM中,如果已知观察序列和产生观察序列的状态序列,那么可用以下哪种方法直接进行参数估计()
A、EM算法
B、维特比算法
C、前向后向算法
D、极大似然估计
参考答案：D
答案解析：注意：观察序列和产生观察序列的状态序列已知

21.安全威胁是产生安全事件的______。
A、内因
B、外因
C、根本原因
D、不相关因素
参考答案：B
答案解析：安全威胁是产生安全事件的外因

24下列关于文件的选项中，错误的是？
A、在linux中，一切几乎都是文件，目录也是文件
B、每个文件都要有一个“inode”数据
C、ext3文件系统和XFS文件系统文件名最长都是255字节
D、ext3文件系统和XFS文件系统的单个文件大小都是取决于块的尺寸
参考答案：D
答案解析：ext3文件系统单个文件最大：16GB-64T(取决于块尺寸) XFS文件系统单个文件最大：8exbibytes减1字节

25.以下命令描述正确的是？
du -s * | sort -nr | head
A、当前目录下个文件或目录的大小
B、对当前目录文件进行排序
C、读取占用空间最大的文件夹
D、显示前10个占用空间最大的文件或目录
参考答案：D
答案解析：du命令是对文件和目录磁盘使用的空间的查看 -s或--summarize 仅显示总计只列出最后加总的值 |sort -nr 按数值从大到小排序 |head命令一般显示前10个文件

27.PHP的Swoole扩展特点，说法错误的是？
A、Accept线程，解决Accept性能瓶颈和惊群问题
B、多进程，可以更好地利用多核
C、提供了全异步和半同步半异步2种模式
D、处理高并发IO的部分用异步模式
参考答案：B
答案解析：不是多进程，而多IO线程，可以更好地利用多核
Swool: <https://www.swoole.co.uk/docs>

# 多选
1.下面哪些命令是bash的内置命令？
A、history
B、cd
C、echo
D、cat
参考答案：A,B,C
答案解析：history,cd,echo是内置bash命令，此类命令查看帮助时需要用help 命令

2.关于Memcache与Redis的说法正确的有？
A、Memcache单个key（变量）存放的数据有2M的限制, Redis单个key（变量）存放的数据有1GB的限制
B、Memcache存储数据的类型都是String类型，Redis数据类型比较丰富:String、List、Set、Sortedset、Hash
C、Memcache可以使用多核（多线程），而Redis只是支持单线程
D、Memcache服务器突然断电，则全部数据就会丢失； 而Redis有持久化功能，可以把数据随时存储在磁盘上
参考答案：B,C,D
答案解析：
Memcache
该产品本身特别是数据在内存里边的存储，如果服务器突然断电，则全部数据就会丢失
单个key（变量）存放的数据有1M的限制
存储数据的类型都是String字符串类型
本身没有持久化功能
可以使用多核（多线程）
Redis
数据类型比较丰富:String、List、Set、Sortedset、Hash
有持久化功能，可以把数据随时存储在磁盘上
本身有一定的计算功能
单个key（变量）存放的数据有1GB的限制

# 编程

```php
// 替换 meta 标签中的编码
$html = "<meta http-equiv='Content-Type' content='text/html; charset=gbk'>";
$pattern = "/<meta\s+http-equiv=(\'|\")?Content-Type(\'|\")?\s+content=(\'|\")text\/html;\s+charset=(.*)(\'|\")>/i";
$replacement = "<meta http-equiv='Content-Type' content='text/html; charset=big5'>";
$result = preg_replace($pattern, $replacement, $html);
echo htmlspecialchars($result);
```

```php
// 两个文件相对路径
$a = '/a/b/c/d/e.php';
$b = '/a/b/13/34/c.php';
echo getRelativePath($a, $b); //"../../12/34/"
function getRelativePath($a,$b){
    $a2array = explode('/', $a);
    $b2array = explode('/', $b);
    $relativePath   = '';
    for( $i = 1; $i <= count($b2array)-2; $i++ ) {
        $relativePath .= $a2array[$i] == $b2array[$i] ? '../' : $b2array[$i].'/';
    }
    return $relativePath;
}
```

```php
// 从 URL 中提取扩展名
$url = "//www.jb51.net/abc/de/fg.php?id=1";
$path = parse_url($url);
echo pathinfo($path['path'], PATHINFO_EXTENSION);  //php
```

```php
// 遍历目录文件
function listDir($dir = '.'){
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if($file == '.' || $file == '..'){
                    continue;
                }
                if(is_dir($sub_dir = realpath($dir.'/'.$file))){
                    echo 'FILE in PATH:'.$dir.':'.$file.'<br>';
                    listDir($sub_dir);
                }else{
                    echo 'FILE:'.$file.'<br>';
                }
            }
            closedir($handle);
        }
}
listDir('.');
```

1、给你四个坐标点，判断它们能不能组成一个矩形，如判断([0,0],[0,1],[1,1],[1,0])能组成一个矩形。

勾股定理，矩形是对角线相等的四边形。只要任意三点不在一条直线上，任选一点，求这一点到另外三点的长度的平方,两个短的之和如果等于最长的，那么这就是矩形。


```c
// 寻找单链表的环

// 单链表的结点类
class LNode{
    //为了简化访问单链表,结点中的数据项的访问权限都设为public
    public int data;
    public LNode next;
}

class LinkListUtli {
    //当单链表中没有环时返回null，有环时返回环的入口结点
    public static LNode searchEntranceNode(LNode L)
    {
        LNode slow=L;//p表示从头结点开始每次往后走一步的指针
        LNode fast=L;//q表示从头结点开始每次往后走两步的指针
        while(fast !=null && fast.next !=null)
        {
            if(slow==fast) break;//p与q相等，单链表有环
            slow = slow.next;
            fast = fast.next.next;
        }
        if(fast == null || fast.next == null) return null;
        // 重新遍历，寻找环的入口点
        slow = L;
        while(slow!=fast)
        {
            slow = slow.next;
            fast = fast.next;
        }
        return slow;
    }
}
```

```php
// 获取页面中所有图片

function download_images($article_url = '', $image_path = 'tmp'){
    // 获取文章类容
    $content = file_get_contents($article_url);

    // 利用正则表达式得到图片链接
    $reg_tag = '/<img.*?\"([^\"]*(jpg|bmp|jpeg|gif|png)).*?>/';
    $ret = preg_match_all($reg_tag, $content, $match_result);
    $pic_url_array = array_unique($match_result1[1]);

    // 创建路径
    $dir = getcwd() . DIRECTORY_SEPARATOR .$image_path;
    mkdir(iconv("UTF-8", "GBK", $dir), 0777, true);

    foreach($pic_url_array as $pic_url){
        // 获取文件信息
        $ch = curl_init($pic_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $fileInfo = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
        curl_close($ch);

        // 获取图片文件后缀
        $ext = strrchr($pic_url, '.');
        $filename = $dir . '/' . uniqid() . $ext;

        // 保存图片信息到文件
        $local_file = fopen($filename, 'w');
        if(false !== $local_file){
            if( false !== fwrite($local_file, $filecontent) ){
                fclose($local_file);
            }
        }
    }
}
```

8、从扑克牌中随机抽5张牌，判断是不是一个顺子，即这5张牌是连续的
这个问题有个关键点，扑克牌，1-13 不能再多了。这就很简单了。用PHP来做，定义一个数组分别存着1到13,拿出一个，置空一个，最后看下 这五个置空的 是不是连续的。这种情况不考虑抽出的顺序。
