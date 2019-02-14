# Array

array()						 		创建数组
array_change_key_case()				返回其键均为大写或小写的数组
array_chunk()						把一个数组分割为新的数组块
array_combine()						通过合并两个数组来创建一个新数组
array_count_values()				用于统计数组中所有值出现的次数
array_diff()						返回两个数组的差集数组
array_diff_assoc()					比较键名和键值，并返回两个数组的差集数组
array_diff_key()					比较键名，并返回两个数组的差集数组
array_diff_uassoc()					通过用户提供的回调函数做索引检查来计算数组的差集
array_diff_ukey()					用回调函数对键名比较计算数组的差集
array_fill()						用给定的值填充数组
array_filter()						用回调函数过滤数组中的元素
array_flip()						交换数组中的键和值
array_intersect()					计算数组的交集
array_intersect_assoc()				比较键名和键值，并返回两个数组的交集数组
array_intersect_key()				使用键名比较计算数组的交集
array_intersect_uassoc()			带索引检查计算数组的交集，用回调函数比较索引
array_intersect_ukey()				用回调函数比较键名来计算数组的交集
array_key_exists()					检查给定的键名或索引是否存在于数组中
array_keys()						返回数组中所有的键名
array_map()							将回调函数作用到给定数组的单元上
array_merge()						把一个或多个数组合并为一个数组
array_merge_recursive()				递归地合并一个或多个数组
array_multisort()					对多个数组或多维数组进行排序
array_pad()						 	用值将数组填补到指定长度
array_pop()						 	将数组最后一个单元弹出（出栈）
array_product()						计算数组中所有值的乘积
array_push()						将一个或多个单元（元素）压入数组的末尾（入栈）
array_rand()						从数组中随机选出一个或多个元素，并返回
array_reduce()						用回调函数迭代地将数组简化为单一的值
array_reverse()						将原数组中的元素顺序翻转，创建新的数组并返回
array_search()						在数组中搜索给定的值，如果成功则返回相应的键名
array_shift()						删除数组中的第一个元素，并返回被删除元素的值
array_slice()						在数组中根据条件取出一段值，并返回
array_splice()						把数组中的一部分去掉并用其它值取代
array_sum()							计算数组中所有值的和
array_udiff()						用回调函数比较数据来计算数组的差集
array_udiff_assoc()					带索引检查计算数组的差集，用回调函数比较数据
array_udiff_uassoc()				带索引检查计算数组的差集，用回调函数比较数据和索引
array_uintersect()					计算数组的交集，用回调函数比较数据
array_uintersect_assoc()			带索引检查计算数组的交集，用回调函数比较数据
array_uintersect_uassoc()			带索引检查计算数组的交集，用回调函数比较数据和索引
array_unique()						删除数组中重复的值
array_unshift()						在数组开头插入一个或多个元素
array_values()						返回数组中所有的值
array_walk()						对数组中的每个成员应用用户函数
array_walk_recursive()				对数组中的每个成员递归地应用用户函数
arsort()						 	对数组进行逆向排序并保持索引关系
asort()						 		对数组进行排序并保持索引关系
compact()						 	建立一个数组，包括变量名和它们的值
count()						 		计算数组中的元素数目或对象中的属性个数
current()							返回数组中的当前元素
each()							 	返回数组中当前的键／值对并将数组指针向前移动一步
end()							 	将数组的内部指针指向最后一个元素
extract()							从数组中将变量导入到当前的符号表
in_array()							检查数组中是否存在指定的值
key()							 	从关联数组中取得键名
krsort()							对数组按照键名逆向排序
ksort()							 	对数组按照键名排序
list()							 	把数组中的值赋给一些变量
natcasesort()						用“自然排序”算法对数组进行不区分大小写字母的排序
natsort()							用“自然排序”算法对数组排序
next()						 		将数组中的内部指针向前移动一位
pos()						 		current() 的别名
prev()						 		将数组的内部指针倒回一位
range()						 		建立一个包含指定范围的元素的数组
reset()						 		将数组的内部指针指向第一个元素
rsort()						 		对数组逆向排序
shuffle()							把数组中的元素按随机顺序重新排列
sizeof()							count() 的别名
sort()								对数组排序
uasort()							使用用户自定义的比较函数对数组中的值进行排序并保持索引关联
uksort()							使用用户自定义的比较函数对数组中的键名进行排序
usort()						 		使用用户自定义的比较函数对数组中的值进行排序

# String

addcslashes() 						在指定的字符前添加反斜杠
addslashes() 						在指定的预定义字符前添加反斜杠
bin2hex() 							把 ASCII 字符的字符串转换为十六进制值
chop() 								rtrim() 的别名
chr() 								从指定的 ASCII 值返回字符
chunk_split() 						把字符串分割为一连串更小的部分
convert_cyr_string() 				把字符由一种 Cyrillic 字符转换成另一种
convert_uudecode() 					对 uuencode 编码的字符串进行解码
convert_uuencode() 					使用 uuencode 算法对字符串进行编码
count_chars() 						返回字符串所用字符的信息
crc32() 							计算一个字符串的 32-bit CRC
crypt() 							单向的字符串加密法 (hashing)
echo() 								输出字符串
explode() 							把字符串打散为数组
fprintf() 							把格式化的字符串写到指定的输出流
get_html_translation_table() 		返回翻译表
hebrev() 							把希伯来文本从右至左的流转换为左至右的流
hebrevc() 							同上，同时把(\n) 转为 <br />
html_entity_decode() 				把 HTML 实体转换为字符
htmlentities() 						把字符转换为 HTML 实体
htmlspecialchars_decode() 			把一些预定义的 HTML 实体转换为字符
htmlspecialchars() 					把一些预定义的字符转换为 HTML 实体
implode() 							把数组元素组合为一个字符串
join() 								implode() 的别名
levenshtein() 						返回两个字符串之间的 Levenshtein 距离
localeconv() 						返回包含本地数字及货币信息格式的数组
ltrim() 							从字符串左侧删除空格或其他预定义字符
md5() 								计算字符串的 MD5 散列
md5_file() 							计算文件的 MD5 散列
metaphone() 						计算字符串的 metaphone 键
money_format() 						把字符串格式化为货币字符串
nl_langinfo() 						返回指定的本地信息
nl2br() 							在字符串中的每个新行之前插入 HTML 换行符
number_format() 					通过千位分组来格式化数字
ord() 								返回字符串第一个字符的 ASCII 值
parse_str() 						把查询字符串解析到变量中
print() 							输出一个或多个字符串
printf() 							输出格式化的字符串
quoted_printable_decode() 			解码 quoted-printable 字符串
quotemeta() 						在字符串中某些预定义的字符前添加反斜杠
rtrim() 							从字符串的末端开始删除空白字符或其他预定义字符
setlocale() 						设置地区信息（地域信息）
sha1() 								计算字符串的 SHA-1 散列
sha1_file() 						计算文件的 SHA-1 散列
similar_text() 						计算两个字符串的匹配字符的数目
soundex() 							计算字符串的 soundex 键
sprintf() 							把格式化的字符串写写入一个变量中
sscanf() 							根据指定的格式解析来自一个字符串的输入
str_ireplace() 						替换字符串中的一些字符。(对大小写不敏感)
str_pad() 							把字符串填充为新的长度
str_repeat() 						把字符串重复指定的次数
str_replace() 						替换字符串中的一些字符。(对大小写敏感)
str_rot13() 						对字符串执行 ROT13 编码
str_shuffle() 						随机地打乱字符串中的所有字符
str_split() 						把字符串分割到数组中
str_word_count() 					计算字符串中的单词数
strcasecmp() 						比较两个字符串。(对大小写不敏感)
strchr() 							搜索字符串在另一字符串中的第一次出现。strstr() 的别
strcmp() 							比较两个字符串。(对大小写敏感)
strcoll() 							比较两个字符串（根据本地设置）
strcspn() 							返回在找到任何指定的字符之前，在字符串查找的字符数
strip_tags() 						剥去 HTML、XML 以及 PHP 的标签
stripcslashes() 					删除由 addcslashes() 函数添加的反斜杠
stripslashes() 						删除由 addslashes() 函数添加的反斜杠
stripos() 							返回字符串在另一字符串中第一次出现的位置(大小写不敏感)
stristr() 							查找字符串在另一字符串中第一次出现的位置(大小写不敏感)
strlen() 							返回字符串的长度
strnatcasecmp() 					使用一种“自然”算法来比较两个字符串(对大小写不敏感)
strnatcmp() 						使用一种“自然”算法来比较两个字符串(对大小写敏感)
strncasecmp() 						前 n 个字符的字符串比较(对大小写不敏感)
strncmp() 							前 n 个字符的字符串比较(对大小写敏感)
strpbrk() 							在字符串中搜索指定字符中的任意一个
strpos() 							返回字符串在另一字符串中首次出现的位置(对大小写敏感)
strrchr() 							查找字符串在另一个字符串中最后一次出现的位置
strrev() 							反转字符串
strripos() 							查找字符串在另一字符串中最后出现的位置(对大小写不敏感)
strrpos() 							查找字符串在另一字符串中最后出现的位置(对大小写敏感)
strspn() 							返回在字符串中包含的特定字符的数目
strstr() 							搜索字符串在另一字符串中的首次出现(对大小写敏感)
strtok() 							把字符串分割为更小的字符串
strtolower() 						把字符串转换为小写
strtoupper() 						把字符串转换为大写
strtr() 							转换字符串中特定的字符
substr() 							返回字符串的一部分
substr_compare() 					从指定的开始长度比较两个字符串
substr_count() 						计算子串在字符串中出现的次数
substr_replace() 					把字符串的一部分替换为另一个字符串
trim() 								从字符串的两端删除空白字符和其他预定义字符
ucfirst() 							把字符串中的首字符转换为大写
ucwords() 							把字符串中每个单词的首字符转换为大写
vfprintf() 							把格式化的字符串写到指定的输出流
vprintf() 							输出格式化的字符串
vsprintf() 							把格式化字符串写入变量中
wordwrap() 							按照指定长度对字符串进行折行处理


# Calendar

cal_days_in_month() 				针对指定的年份和日历，返回一个月中的天数
cal_from_jd() 						把儒略日计数转换为指定日历的日期
cal_info() 							返回有关给定日历的信息
cal_to_jd() 						把日期转换为儒略日计数
easter_date() 						返回指定年份的复活节午夜的 Unix 时间戳
easter_days() 						返回指定年份的复活节与 3 月 21 日之间的天数
FrenchToJD() 						将法国共和历法转换成为儒略日计数
GregorianToJD() 					将格利高里历法转换成为儒略日计数
JDDayOfWeek() 						返回日期在周几
JDMonthName() 						返回月的名称
JDToFrench() 						把儒略日计数转换为法国共和国历法
JDToGregorian() 					把儒略日计数转换为格利高里历法
jdtojewish() 						把儒略日计数转换为犹太历法
JDToJulian() 						把儒略日计数转换为儒略历
jdtounix() 							把儒略日计数转换为 Unix 时间戳
JewishToJD() 						把犹太历法转换为儒略日计数
JulianToJD() 						把儒略历转换为儒略日计数
unixtojd() 							把 Unix 时间戳转换为儒略日计数

# Date/Time

checkdate() 						验证格利高里日期
date_default_timezone_get() 		返回默认时区
date_default_timezone_set() 		设置默认时区
date_sunrise() 						返回给定的日期与地点的日出时间
date_sunset() 						返回给定的日期与地点的日落时间
date() 								格式化本地时间／日期
getdate() 							返回日期／时间信息
gettimeofday() 						返回当前时间信息
gmdate() 							格式化 GMT/UTC 日期/时间
gmmktime() 							取得 GMT 日期的 UNIX 时间戳
gmstrftime() 						根据本地区域设置格式化 GMT/UTC 时间／日期
idate() 							将本地时间/日期格式化为整
localtime() 						返回本地时间
microtime() 						返回当前时间的微秒数
mktime() 							返回一个日期的 Unix 时间戳
strftime() 							根据区域设置格式化本地时间／日期
strptime() 							解析由 strftime 生成的日期／时间
strtotime() 						将任何英文文本的日期或时间描述解析为 Unix 时间戳
time() 								返回当前时间的 Unix 时间戳

# Directory

chdir() 							改变当前的目录
chroot() 							改变当前进程的根目录
dir() 								打开一个目录句柄，并返回一个对象
closedir() 							关闭目录句柄
getcwd() 							返回当前目录
opendir() 							打开目录句柄
readdir() 							返回目录句柄中的条目
rewinddir() 						重置目录句柄
scandir() 							列出指定路径中的文件和目录

# Error/Logging

debug_backtrace() 					生成 backtrace
debug_print_backtrace() 			输出 backtrace
error_get_last() 					获得最后发生的错误
error_log() 						向服务器错误记录、文件或远程目标发送一个错误
error_reporting() 					规定报告哪个错误
restore_error_handler() 			恢复之前的错误处理程序
restore_exception_handler() 		恢复之前的异常处理程序
set_error_handler() 				设置用户自定义的错误处理函数
set_exception_handler() 			设置用户自定义的异常处理函数
trigger_error() 					创建用户自定义的错误消息
user_error() 						trigger_error() 的别名

# Filesystem

basename() 							返回路径中的文件名部分
chgrp() 							改变文件组
chmod() 							改变文件模式
chown() 							改变文件所有者
clearstatcache() 					清除文件状态缓存
copy() 								复制文件
delete() 							参见 unlink() 或 unset	()
dirname() 							返回路径中的目录名称部分
disk_free_space() 					返回目录的可用空间
disk_total_space() 					返回一个目录的磁盘总容量
diskfreespace() 					disk_free_space() 	的别名
fclose() 							关闭打开的文件
feof() 								测试文件指针是否到了文件结束的位置
fflush() 							向打开的文件输出缓冲内容
fgetc() 							从打开的文件中返回字符
fgetcsv() 							从打开的文件中解析一行，校验 CSV 	字段
fgets() 							从打开的文件中返回一行
fgetss() 							从打开的文件中读取一行并过滤掉 HTML 和 PHP 标记
file() 								把文件读入一个数组中
file_exists() 						检查文件或目录是否存在
file_get_contents() 				将文件读入字符串
file_put_contents 					将字符串写入文件。
fileatime() 						返回文件的上次访问时间
filectime() 						返回文件的上次改变时间
filegroup() 						返回文件的组 	ID
fileinode() 						返回文件的 inode 	编号
filemtime() 						返回文件的上次修改时间
fileowner() 						文件的 user ID 	（所有者）
fileperms() 						返回文件的权限
filesize() 							返回文件大小
filetype() 							返回文件类型
flock() 							锁定或释放文件
fnmatch() 							根据指定的模式来匹配文件名或字符串
fopen() 							打开一个文件或 	URL
fpassthru() 						从打开的文件中读数据，直到 	EOF，并向输出缓冲写结果
fputcsv() 							将行格式化为 CSV 	并写入一个打开的文件中
fputs() 							fwrite() 	的别名
fread() 							读取打开的文件
fscanf() 							根据指定的格式对输入进行解析
fseek() 							在打开的文件中定位
fstat() 							返回关于一个打开的文件的信息
ftell() 							返回文件指针的读/	写位
ftruncate() 						将文件截断到指定的长度
fwrite() 							写入文件
glob() 								返回一个包含匹配指定模式的文件名/	目录的数组
is_dir() 							判断指定的文件名是否是一个目录
is_executable() 					判断文件是否可执行
is_file() 							判断指定文件是否为常规的文件
is_link() 							判断指定的文件是否是连接
is_readable() 						判断文件是否可读
is_uploaded_file() 					判断文件是否是通过 HTTP POST 	上传的
is_writable() 						判断文件是否可写
is_writeable() 						is_writable() 	的别名
link() 								创建一个硬连接
linkinfo() 							返回有关一个硬连接的信息
lstat() 							返回关于文件或符号连接的信息
mkdir() 							创建目录
move_uploaded_file() 				将上传的文件移动到新位置
parse_ini_file() 					解析一个配置文件
pathinfo() 							返回关于文件路径的信息
pclose() 							关闭有 popen() 	打开的进程
popen() 							打开一个进程
readfile() 							读取一个文件，并输出到输出缓冲
readlink() 							返回符号连接的目标
realpath() 							返回绝对路径名
rename() 							重名名文件或目录
rewind() 							倒回文件指针的位置
rmdir() 							删除空的目录
set_file_buffer() 					设置已打开文件的缓冲大小
stat() 								返回关于文件的信息
symlink() 							创建符号连接
tempnam() 							创建唯一的临时文件
tmpfile() 							建立临时文件
touch() 							设置文件的访问和修改时间
umask() 							改变文件的文件权限
unlink() 							删除文件

# Filter

filter_has_var() 					检查是否存在指定输入类型的变量
filter_id() 						返回指定过滤器的 ID 号
filter_input() 						从脚本外部获取输入，并进行过滤
filter_input_array() 				从脚本外部获取多项输入，并进行过滤
filter_list() 						返回包含所有得到支持的过滤器的一个数组
filter_var_array() 					获取多项变量，并进行过滤
filter_var() 						获取一个变量，并进行过滤

# FTP

ftp_alloc() 						为要上传到 FTP 服务器的文件分配空间
ftp_cdup() 							把当前目录改变为 FTP 服务器上的父目录
ftp_chdir() 						改变 FTP 服务器上的当前目录
ftp_chmod() 						通过 FTP 设置文件上的权限
ftp_close() 						关闭 FTP 连接
ftp_connect() 						打开 FTP 连接
ftp_delete() 						删除 FTP 服务器上的文件
ftp_exec() 							在 FTP 上执行一个程序/命令
ftp_fget() 							从 FTP 服务器上下载一个文件并保存到本地一个已经打开的文件中
ftp_fput() 							上传一个已打开的文件，并在 FTP 服务器上把它保存为一个文件
ftp_get_option() 					返回当前 FTP 连接的各种不同的选项设置
ftp_get() 							从 FTP 服务器下载文件
ftp_login() 						登录 FTP 服务器
ftp_mdtm() 							返回指定文件的最后修改时间
ftp_mkdir() 						在 FTP 服务器创建一个新目录
ftp_nb_continue() 					连续获取／发送文件 (non-blocking)
ftp_nb_fget() 						从FTP服务器上下载文件并保存到本地已经打开的文件中(non-blocking)
ftp_nb_fput() 						上传已打开的文件，并在FTP服务器上把它保存为文件(non-blocking)
ftp_nb_get() 						从 FTP 服务器下载文件 (non-blocking)
ftp_nb_put() 						把文件上传到服务器 (non-blocking)
ftp_nlist() 						返回指定目录的文件列表
ftp_pasv() 							返回当前 FTP 被动模式是否打开
ftp_put() 							把文件上传到服务器
ftp_pwd() 							返回当前目录名称
ftp_quit() 							ftp_close() 的别名
ftp_raw() 							向 FTP 服务器发送一个 raw 命令
ftp_rawlist() 						返回指定目录中文件的详细列表
ftp_rename() 						重命名 FTP 服务器上的文件或目录
ftp_rmdir() 						删除 FTP 服务器上的目录
ftp_set_option() 					设置各种 FTP 运行时选项
ftp_site() 							向服务器发送 SITE 命令
ftp_size() 							返回指定文件的大小
ftp_ssl_connect() 					打开一个安全的 SSL-FTP 连接
ftp_systype() 						返回远程 FTP 服务器的系统类型标识符

# HTTP

header() 							向客户端发送原始的 HTTP 报头
headers_list() 						返回已发送的（或待发送的）响应头部的一个列表
headers_sent() 						检查 HTTP 报头是否发送/已发送到何处
setcookie() 						向客户端发送一个 HTTP cookie
setrawcookie() 						不对 cookie 值进行 URL 编码，发送一个 HTTP cookie

# LibXML

libxml_clear_errors() 				清空 libxml 错误缓冲
libxml_get_errors() 				检索错误数组
libxml_get_last_error() 			从 libxml 检索最后的错误
libxml_set_streams_context() 		libxml 文档加载或写入设置流环境
libxml_use_internal_errors() 		libxml 错误，允许用户按需读取错误信息

# Mail

ezmlm_hash() 						计算 EZMLM 邮件列表系统所需的散列值
mail() 								允许您从脚本中直接发送电子邮件

# Math

abs() 								绝对值
acos() 								反余弦
acosh() 							反双曲余弦
asin() 								反正弦
asinh() 							反双曲正弦
atan() 								反正切
atan2() 							两个参数的反正切
atanh() 							反双曲正切
base_convert() 						在任意进制之间转换数字
bindec() 							把二进制转换为十进制
ceil() 								向上舍入为最接近的整数
cos() 								余弦
cosh() 								双曲余弦
decbin() 							把十进制转换为二进制
dechex() 							把十进制转换为十六进制
decoct() 							把十进制转换为八进制
deg2rad() 							将角度转换为弧度
exp() 								返回 Ex 的值
expm1() 							返回 Ex - 1 的值
floor() 							向下舍入为最接近的整数
fmod() 								返回除法的浮点数余数
getrandmax() 						显示随机数最大的可能值
hexdec() 							把十六进制转换为十进制
hypot() 							计算直角三角形的斜边长度
is_finite() 						判断是否为有限值
is_infinite() 						判断是否为无限值
is_nan() 							判断是否为合法数值
lcg_value() 						返回范围为 (0, 1) 的一个伪随机数
log() 								自然对数
log10() 							10 为底的对数
log1p() 							log(1 + number)
max() 								返回最大值
min() 								返回最小值
mt_getrandmax() 					显示随机数的最大可能值
mt_rand() 							使用 Mersenne Twister 算法返回随机整数
mt_srand() 							播种 Mersenne Twister 随机数生成器
octdec() 							把八进制转换为十进制
pi() 								返回圆周率的值
pow() 								返回 x 的 y 次方
rad2deg() 							把弧度数转换为角度数
rand() 								返回随机整数
round() 							对浮点数进行四舍五入
sin() 								正弦
sinh() 								双曲正弦
sqrt() 								平方根
srand() 							播下随机数发生器种子
tan() 								正切
tanh() 								双曲正切

# MySql

mysql_affected_rows() 				取得前一次 MySQL 操作所影响的记录行数
mysql_client_encoding() 			返回当前连接的字符集的名
mysql_close() 						关闭非持久的 MySQL 连接
mysql_connect() 					打开非持久的 MySQL 连接
mysql_data_seek() 					移动记录指针
mysql_db_name() 					从对 mysql_list_dbs() 的调用返回数据库名称
mysql_errno() 						返回上一个 MySQL 操作中的错误信息的数字编码
mysql_error() 						返回上一个 MySQL 操作产生的文本错误信息
mysql_fetch_array() 				从结果集中取得一行作为关联数组，或数字数组，或二者兼有
mysql_fetch_assoc() 				从结果集中取得一行作为关联数组
mysql_fetch_field() 				从结果集中取得列信息并作为对象返回
mysql_fetch_lengths() 				取得结果集中每个字段的内容的长度
mysql_fetch_object() 				从结果集中取得一行作为对象
mysql_fetch_row() 					从结果集中取得一行作为数字数组
mysql_field_flags() 				从结果中取得和指定字段关联的标志
mysql_field_len() 					返回指定字段的长度
mysql_field_name() 					取得结果中指定字段的字段名
mysql_field_seek() 					将结果集中的指针设定为指定的字段偏移量
mysql_field_table() 				取得指定字段所在的表名
mysql_field_type() 					取得结果集中指定字段的类型
mysql_free_result() 				释放结果内存
mysql_get_client_info() 			取得 MySQL 客户端信息
mysql_get_host_info() 				取得 MySQL 主机信息
mysql_get_proto_info() 				MySQL 协议信息
mysql_get_server_info() 			MySQL 服务器信息
mysql_info() 						取得最近一条查询的信息
mysql_insert_id() 					取得上一步 INSERT 操作产生的 ID
mysql_list_dbs() 					列出 MySQL 服务器中所有的数据库
mysql_list_processes() 				列出 MySQL 进程
mysql_num_fields() 					取得结果集中字段的数目
mysql_num_rows() 					取得结果集中行的数目
mysql_pconnect() 					打开一个到 MySQL 服务器的持久连接
mysql_ping() 						Ping 一个服务器连接，如果没有连接则重新连接
mysql_query() 						发送一条 MySQL 查询
mysql_real_escape_string() 			转义 SQL 语句中使用的字符串中的特殊字符
mysql_result() 						取得结果数据
mysql_select_db() 					选择 MySQL 数据库
mysql_stat() 						取得当前系统状态
mysql_thread_id() 					返回当前线程的 ID
mysql_unbuffered_query() 			向 MySQL 发送一条 SQL 查询（不获取 / 缓存结果）

# DOMDocument

DOMDocument extends DOMNode {
	/* 属性 */
	readonly public string $actualEncoding ;
	readonly public DOMConfiguration $config ;
	readonly public DOMDocumentType $doctype ;
	readonly public DOMElement $documentElement ;
	public string $documentURI ;
	public string $encoding ;
	public bool $formatOutput ;
	readonly public DOMImplementation $implementation ;
	public bool $preserveWhiteSpace = true ;
	public bool $recover ;
	public bool $resolveExternals ;
	public bool $standalone ;
	public bool $strictErrorChecking = true ;
	public bool $substituteEntities ;
	public bool $validateOnParse = false ;
	public string $version ;
	readonly public string $xmlEncoding ;
	public bool $xmlStandalone ;
	public string $xmlVersion ;
	/* 方法 */
	__construct ([ string $version [, string $encoding ]] )
	DOMAttr createAttribute ( string $name )
	DOMAttr createAttributeNS ( string $namespaceURI , string $qualifiedName )
	DOMCDATASection createCDATASection ( string $data )
	DOMComment createComment ( string $data )
	DOMDocumentFragment createDocumentFragment ( void )
	DOMElement createElement ( string $name [, string $value ] )
	DOMElement createElementNS ( string $namespaceURI , string $qualifiedName [, string $value ] )
	DOMEntityReference createEntityReference ( string $name )
	DOMProcessingInstruction createProcessingInstruction ( string $target [, string $data ] )
	DOMText createTextNode ( string $content )
	DOMElement getElementById ( string $elementId )
	DOMNodeList getElementsByTagName ( string $name )
	DOMNodeList getElementsByTagNameNS ( string $namespaceURI , string $localName )
	DOMNode importNode ( DOMNode $importedNode [, bool $deep ] )
	mixed load ( string $filename [, int $options = 0 ] )
	bool loadHTML ( string $source )
	bool loadHTMLFile ( string $filename )
	mixed loadXML ( string $source [, int $options = 0 ] )
	void normalizeDocument ( void )
	bool registerNodeClass ( string $baseclass , string $extendedclass )
	bool relaxNGValidate ( string $filename )
	bool relaxNGValidateSource ( string $source )
	int save ( string $filename [, int $options ] )
	string saveHTML ([ DOMNode $node = NULL ] )
	int saveHTMLFile ( string $filename )
	string saveXML ([ DOMNode $node [, int $options ]] )
	bool schemaValidate ( string $filename )
	bool schemaValidateSource ( string $source )
	bool validate ( void )
	int xinclude ([ int $options ] )
	/* 继承的方法 */
	public DOMNode DOMNode::appendChild ( DOMNode $newnode )
	public string DOMNode::C14N ([ bool $exclusive [, bool $with_comments [, array $xpath [, array $ns_prefixes ]]]] )
	public int DOMNode::C14NFile ( string $uri [, bool $exclusive [, bool $with_comments [, array $xpath [, array $ns_prefixes ]]]] )
	public DOMNode DOMNode::cloneNode ([ bool $deep ] )
	public int DOMNode::getLineNo ( void )
	public string DOMNode::getNodePath ( void )
	public bool DOMNode::hasAttributes ( void )
	public bool DOMNode::hasChildNodes ( void )
	public DOMNode DOMNode::insertBefore ( DOMNode $newnode [, DOMNode $refnode ] )
	public bool DOMNode::isDefaultNamespace ( string $namespaceURI )
	public bool DOMNode::isSameNode ( DOMNode $node )
	public bool DOMNode::isSupported ( string $feature , string $version )
	public string DOMNode::lookupNamespaceURI ( string $prefix )
	public string DOMNode::lookupPrefix ( string $namespaceURI )
	public void DOMNode::normalize ( void )
	public DOMNode DOMNode::removeChild ( DOMNode $oldnode )
	public DOMNode DOMNode::replaceChild ( DOMNode $newnode , DOMNode $oldnode )
}

# DOMXPath

DOMXPath {
	/* 属性 */
	public DOMDocument $document ;
	/* 方法 */
	public __construct ( DOMDocument $doc )
	public mixed evaluate ( string $expression [, DOMNode $contextnode [, bool $registerNodeNS = true ]] )
	public DOMNodeList query ( string $expression [, DOMNode $contextnode [, bool $registerNodeNS = true ]] )
	public bool registerNamespace ( string $prefix , string $namespaceURI )
	public void registerPhpFunctions ([ mixed $restrict ] )
}

# SimpleXML

SimpleXMLElement implements Traversable {
	/* 方法 */
	final public __construct ( string $data [, int $options = 0 [, bool $data_is_url = false [, string $ns = "" [, bool $is_prefix = false ]]]] )
	public void addAttribute ( string $name [, string $value [, string $namespace ]] )
	public SimpleXMLElement addChild ( string $name [, string $value [, string $namespace ]] )
	public mixed asXML ([ string $filename ] )
	public SimpleXMLElement attributes ([ string $ns = NULL [, bool $is_prefix = false ]] )
	public SimpleXMLElement children ([ string $ns [, bool $is_prefix = false ]] )
	public int count ( void )
	public array getDocNamespaces ([ bool $recursive = false ] )
	public string getName ( void )
	public array getNamespaces ([ bool $recursive = false ] )
	public bool registerXPathNamespace ( string $prefix , string $ns )
	public array xpath ( string $path )
}

SimpleXMLIterator extends SimpleXMLElement implements RecursiveIterator , Traversable , Iterator , Countable {
	/* 方法 */
	public mixed current ( void )
	SimpleXMLIterator getChildren ( void )
	bool hasChildren ( void )
	mixed key ( void )
	void next ( void )
	void rewind ( void )
	bool valid ( void )
	/* 继承的方法 */
	参上
}

simplexml_import_dom				Get a SimpleXMLElement object from a DOM node.
simplexml_load_file				 	Interprets an XML file into an object
simplexml_load_string				Interprets a string of XML into an object

# XML Parser

utf8_decode() 							把 UTF-8 字符串解码为 ISO-8859-1
utf8_encode() 							把 ISO-8859-1 字符串编码为 UTF-8
xml_error_string() 						获取 XML 解析器的错误描述
xml_get_current_byte_index() 			获取 XML 解析器的当前字节索引
xml_get_current_column_number() 		获取 XML 解析器的当前列号
xml_get_current_line_number() 			获取 XML 解析器的当前行号
xml_get_error_code() 					获取 XML 解析器错误代码
xml_parse() 							解析 XML 文档
xml_parse_into_struct() 				把 XML 数据解析到数组中
xml_parser_create_ns() 					创建带有命名空间支持的 XML 解析器
xml_parser_create() 					创建 XML 解析器
xml_parser_free() 						XML 解析器
xml_parser_get_option() 				从 XML 解析器获取选项设置信息
xml_parser_set_option() 				为 XML 解析进行选项设置
xml_set_character_data_handler() 		建立字符数据处理器
xml_set_default_handler() 				建立默认的数据处理器
xml_set_element_handler() 				建立起始和终止元素处理器
xml_set_end_namespace_decl_handler()	建立终止命名空间声明处理器
xml_set_external_entity_ref_handler() 	建立外部实体处理器
xml_set_notation_decl_handler() 		建立注释声明处理器
xml_set_object() 						在对象中使用 XML 解析器
xml_set_processing_instruction_handler()建立处理指令（PI）处理器
xml_set_start_namespace_decl_handler() 	建立起始命名空间声明处理器
xml_set_unparsed_entity_decl_handler() 	建立未解析实体定义声明处理器

# XMLWriter

endAttribute()							End attribute
endCData()								End current CDATA
endComment()							Create end comment
endDocument()						End current document
endDTDAttlist()						End current DTD AttList
endDTDElement()						End current DTD element
endDTDEntity()							End current DTD Entity
endDTD()								End current DTD
endElement()							End current element
endPI()									End current PI
flush()									Flush current buffer
fullEndElement()						End current element
openMemory()							Create new xmlwriter using memory for string output
openURI()								Create new xmlwriter using source uri for output
outputMemory()						Returns current buffer
setIndentString()						Set string used for indenting
setIndent()								Toggle indentation on/off
startAttributeNS()						Create start namespaced attribute
startAttribute()							Create start attribute
startCData()							Create start CDATA tag
startComment()						Create start comment
startDocument()						Create document tag
startDTDAttlist()						Create start DTD AttList
startDTDElement()						Create start DTD element
startDTDEntity()						Create start DTD Entity
startDTD()								Create start DTD tag
startElementNS()						Create start namespaced element tag
startElement()							Create start element tag
startPI()								Create start PI tag
text()									Write text
writeAttributeNS()						Write full namespaced attribute
writeAttribute()						Write full attribute
writeCData()							Write full CDATA tag
writeComment()						Write full comment tag
writeDTDAttlist()						Write full DTD AttList tag
writeDTDElement()						Write full DTD element tag
writeDTDEntity()						Write full DTD Entity tag
writeDTD()								Write full DTD tag
writeElementNS()						Write full namespaced element tag
writeElement()							Write full element tag
writePI()								Writes a PI
writeRaw()								Write a raw XML text

# Zip

zip_close() 							ZIP 文件
zip_entry_close() 						关闭 ZIP 文件中的一个项目
zip_entry_compressedsize() 				返回 ZIP 文件中的一个项目的被压缩尺寸
zip_entry_compressionmethod() 			返回 ZIP 文件中的一个项目的压缩方法
zip_entry_filesize() 					返回 ZIP 文件中的一个项目的实际文件尺寸
zip_entry_name() 						返回 ZIP 文件中的一个项目的名称
zip_entry_open() 						打开 ZIP 文件中的一个项目以供读取
zip_entry_read() 						读取 ZIP 文件中的一个打开的项目
zip_open() 								打开 ZIP 文件
zip_read() 								读取 ZIP 文件中的下一个项目

# PDO

PDO  {
	__construct ( string $dsn [, string $username [, string $password [, array $driver_options ]]] )
	bool beginTransaction ( void )
	bool commit ( void )
	mixed errorCode ( void )
	array errorInfo ( void )
	int exec ( string $statement )
	mixed getAttribute ( int $attribute )
	array getAvailableDrivers ( void )
	bool inTransaction ( void )
	string lastInsertId ([ string $name = NULL ] )
	PDOStatement prepare ( string $statement [, array $driver_options = array() ] )
	PDOStatement query ( string $statement )
	string quote ( string $string [, int $parameter_type = PDO::PARAM_STR ] )
	bool rollBack ( void )
	bool setAttribute ( int $attribute , mixed $value )
}
PDOStatement  implements Traversable  {
	readonlystring $PDOStatement->queryString;

	bool PDOStatement::bindColumn ( mixed $column , mixed &$param [, int $type [, int $maxlen [, mixed $driverdata ]]] )
	bool PDOStatement::bindParam ( mixed $parameter , mixed &$variable [, int $data_type = PDO::PARAM_STR [, int $length [, mixed $driver_options ]]] )
	bool PDOStatement::bindValue ( mixed $parameter , mixed $value [, int $data_type = PDO::PARAM_STR ] )
	bool PDOStatement::closeCursor ( void )
	int PDOStatement::columnCount ( void )
	bool PDOStatement::debugDumpParams ( void )
	string PDOStatement::errorCode ( void )
	array PDOStatement::errorInfo ( void )
	bool PDOStatement::execute ([ array $input_parameters ] )
	mixed PDOStatement::fetch ([ int $fetch_style = PDO::FETCH_BOTH [, int $cursor_orientation = PDO::FETCH_ORI_NEXT [, int $cursor_offset = 0 ]]] )
	array PDOStatement::fetchAll ([ int $fetch_style = PDO::FETCH_BOTH [, mixed $fetch_argument [, array $ctor_args = array() ]]] )
	string PDOStatement::fetchColumn ([ int $column_number = 0 ] )
	mixed PDOStatement::fetchObject ([ string $class_name = "stdClass" [, array $ctor_args ]] )
	mixed PDOStatement::getAttribute ( int $attribute )
	array PDOStatement::getColumnMeta ( int $column )
	bool PDOStatement::nextRowset ( void )
	int PDOStatement::rowCount ( void )
	bool PDOStatement::setAttribute ( int $attribute , mixed $value )
	bool PDOStatement::setFetchMode ( int $mode )
}

# Mysqli

MySQLi {
	/* 属性 */
	int $mysqli->affected_rows;
	string $mysqli->client_info;
	int $mysqli->client_version;
	string $mysqli->connect_errno;
	string $mysqli->connect_error;
	int $errno;
	array $mysqli->error_list;
	string $mysqli->error;
	int $mysqli->field_count;
	int $mysqli->client_version;
	string $mysqli->host_info;
	string $mysqli->protocol_version;
	string $mysqli->server_info;
	int $mysqli->server_version;
	string $mysqli->info;
	mixed $mysqli->insert_id;
	string $mysqli->sqlstate;
	int $mysqli->thread_id;
	int $mysqli->warning_count;
	/* 方法 */
	int mysqli_affected_rows ( mysqli $link )
	bool mysqli::autocommit ( bool $mode )
	bool mysqli::change_user ( string $user , string $password , string $database )
	string mysqli::character_set_name ( void )
	string mysqli_get_client_info ( mysqli $link )
	int mysqli_get_client_version ( mysqli $link )
	bool mysqli::close ( void )
	bool mysqli::commit ( void )
	int mysqli_connect_errno ( void )
	string mysqli_connect_error ( void )
	mysqli mysqli_connect ([ string $host = ini_get("mysqli.default_host") [, string $username = ini_get("mysqli.default_user") [, string $passwd = ini_get("mysqli.default_pw") [, string $dbname = "" [, int $port = ini_get("mysqli.default_port") [, string $socket = ini_get("mysqli.default_socket") ]]]]]] )
	bool mysqli::debug ( string $message )
	void mysqli::disable_reads_from_master ( void )
	bool mysqli::dump_debug_info ( void )
	int mysqli_errno ( mysqli $link )
	array mysqli_error_list ( mysqli $link )
	string mysqli_error ( mysqli $link )
	int mysqli_field_count ( mysqli $link )
	object mysqli::get_charset ( void )
	string mysqli::get_client_info ( void )
	array mysqli_get_client_stats ( void )
	int mysqli_get_client_version ( mysqli $link )
	bool mysqli::get_connection_stats ( void )
	string mysqli_get_host_info ( mysqli $link )
	int mysqli_get_proto_info ( mysqli $link )
	string mysqli_get_server_info ( mysqli $link )
	int mysqli_get_server_version ( mysqli $link )
	mysqli_warning mysqli::get_warnings ( void )
	string mysqli_info ( mysqli $link )
	mysqli mysqli::init ( void )
	mixed mysqli_insert_id ( mysqli $link )
	bool mysqli::kill ( int $processid )
	bool mysqli::more_results ( void )
	bool mysqli::multi_query ( string $query )
	bool mysqli::next_result ( void )
	bool mysqli::options ( int $option , mixed $value )
	bool mysqli::ping ( void )
	public int mysqli::poll ( array &$read , array &$error , array &$reject , int $sec [, int $usec ] )
	mysqli_stmt mysqli::prepare ( string $query )
	mixed mysqli::query ( string $query [, int $resultmode = MYSQLI_STORE_RESULT ] )
	bool mysqli::real_connect ([ string $host [, string $username [, string $passwd [, string $dbname [, int $port [, string $socket [, int $flags ]]]]]]] )
	string mysqli::escape_string ( string $escapestr )
	bool mysqli::real_query ( string $query )
	public mysqli_result mysqli::reap_async_query ( void )
	public bool mysqli::refresh ( int $options )
	bool mysqli::rollback ( void )
	int mysqli::rpl_query_type ( string $query )
	bool mysqli::select_db ( string $dbname )
	bool mysqli::send_query ( string $query )
	bool mysqli::set_charset ( string $charset )
	void mysqli_set_local_infile_default ( mysqli $link )
	bool mysqli::set_local_infile_handler ( mysqli $link , callable $read_func )
	string mysqli_sqlstate ( mysqli $link )
	bool mysqli::ssl_set ( string $key , string $cert , string $ca , string $capath , string $cipher )
	string mysqli::stat ( void )
	mysqli_stmt mysqli::stmt_init ( void )
	mysqli_result mysqli::store_result ( void )
	int mysqli_thread_id ( mysqli $link )
	bool mysqli_thread_safe ( void )
	mysqli_result mysqli::use_result ( void )
	int mysqli_warning_count ( mysqli $link )
}


# Memcache

Memcache {
	bool add ( string $key , mixed $var [, int $flag [, int $expire ]] )
	bool addServer ( string $host [, int $port = 11211 [, bool $persistent [, int $weight [, int $timeout [, int $retry_interval [, bool $status [, callback $failure_callback [, int $timeoutms ]]]]]]]] )
	bool close ( void )
	bool connect ( string $host [, int $port [, int $timeout ]] )
	int decrement ( string $key [, int $value = 1 ] )
	bool delete ( string $key [, int $timeout ] )
	bool flush ( void )
	string get ( string $key [, int &$flags ] )
	array getExtendedStats ([ string $type [, int $slabid [, int $limit = 100 ]]] )
	int getServerStatus ( string $host [, int $port = 11211 ] )
	array getStats ([ string $type [, int $slabid [, int $limit = 100 ]]] )
	string getVersion ( void )
	int increment ( string $key [, int $value = 1 ] )
	bool pconnect ( string $host [, int $port [, int $timeout ]] )
	bool replace ( string $key , mixed $var [, int $flag [, int $expire ]] )
	bool set ( string $key , mixed $var [, int $flag [, int $expire ]] )
	bool setCompressThreshold ( int $threshold [, float $min_savings ] )
	bool setServerParams ( string $host [, int $port = 11211 [, int $timeout [, int $retry_interval = false [, bool $status [, callback $failure_callback ]]]]] )
}

# Program Execution

escapeshellarg 		Escape a string to be used as a shell argument
escapeshellcmd 		Escape shell metacharacters
exec 					Execute an external program
passthru 				Execute an external program and display raw output
proc_close 				Close a process opened by proc_open and return the exit code of that process
proc_get_status 		Get information about a process opened by proc_open
proc_nice 				Change the priority of the current process
proc_open 				Execute a command and open file pointers for input/output
proc_terminate 		Kills a process opened by proc_open
shell_exec 				Execute command via shell and return the complete output as a string
system 					Execute an external program and display the output

# cURL

curl_close						关闭一个cURL会话
curl_copy_handle				复制一个cURL句柄和它的所有选项
curl_errno						返回最后一次的错误号
curl_error						返回一个保护当前会话最近一次错误的字符串
curl_exec						执行一个cURL会话
curl_getinfo					获取一个cURL连接资源句柄的信息
curl_init						初始化一个cURL会话
curl_multi_add_handle			向curl批处理会话中添加单独的curl句柄
curl_multi_close				关闭一组cURL句柄
curl_multi_exec					解析一个cURL批处理句柄
curl_multi_getcontent			如果设置了CURLOPT_RETURNTRANSFER，则返回获取的输出的文本流
curl_multi_info_read			获取当前解析的cURL的相关传输信息
curl_multi_init					返回一个新cURL批处理句柄
curl_multi_remove_handle		移除curl批处理句柄资源中的某个句柄资源
curl_multi_select				等待所有cURL批处理中的活动连接
curl_setopt_array				为cURL传输会话批量设置选项
curl_setopt						设置一个cURL传输选项
curl_version					获取cURL版本信息

预定义常量
	Option:
		BOOLEAN
			CURLOPT_AUTOREFERER
			CURLOPT_BINARYTRANSFER
			CURLOPT_COOKIESESSION
			CURLOPT_CRLF
			CURLOPT_DNS_USE_GLOBAL_CACHE
			CURLOPT_FAILONERROR
			CURLOPT_FILETIME
			CURLOPT_FOLLOWLOCATION
			CURLOPT_FORBID_REUSE
			CURLOPT_FRESH_CONNECT
			CURLOPT_FTP_USE_EPRT
			CURLOPT_FTP_USE_EPSV
			CURLOPT_FTPAPPEND
			CURLOPT_FTPASCII
			CURLOPT_FTPLISTONLY
			CURLOPT_HEADER
			CURLINFO_HEADER_OUT
			CURLOPT_HTTPGET
			CURLOPT_HTTPPROXYTUNNEL
			CURLOPT_MUTE
			CURLOPT_NETRC
			CURLOPT_NOBODY
			CURLOPT_NOPROGRESS
			CURLOPT_NOSIGNAL
			CURLOPT_POST
			CURLOPT_PUT
			CURLOPT_RETURNTRANSFER
			CURLOPT_SSL_VERIFYPEER
			CURLOPT_TRANSFERTEXT
			CURLOPT_UNRESTRICTED_AUTH
			CURLOPT_UPLOAD
			CURLOPT_VERBOSE
		INTEGER
			CURLOPT_BUFFERSIZE
			CURLOPT_CLOSEPOLICY
			CURLOPT_CONNECTTIMEOUT
			CURLOPT_CONNECTTIMEOUT_MS
			CURLOPT_DNS_CACHE_TIMEOUT
			CURLOPT_FTPSSLAUTH
			CURLOPT_HTTP_VERSION
			CURLOPT_HTTPAUTH
			CURLOPT_INFILESIZE
			CURLOPT_LOW_SPEED_LIMIT
			CURLOPT_LOW_SPEED_TIME
			CURLOPT_MAXCONNECTS
			CURLOPT_MAXREDIRS
			CURLOPT_PORT
			CURLOPT_PROTOCOLS
			CURLOPT_PROXYAUTH
			CURLOPT_PROXYPORT
			CURLOPT_PROXYTYPE
			CURLOPT_REDIR_PROTOCOLS
			CURLOPT_RESUME_FROM
			CURLOPT_SSL_VERIFYHOST
			CURLOPT_SSLVERSION
			CURLOPT_TIMECONDITION
			CURLOPT_TIMEOUT
			CURLOPT_TIMEOUT_MS
			CURLOPT_TIMEVALUE
		STRING
			CURLOPT_CAINFO
			CURLOPT_CAPATH
			CURLOPT_COOKIE
			CURLOPT_COOKIEFILE
			CURLOPT_COOKIEJAR
			CURLOPT_CUSTOMREQUEST
			CURLOPT_EGDSOCKET
			CURLOPT_ENCODING
			CURLOPT_FTPPORT
			CURLOPT_INTERFACE
			CURLOPT_KRB4LEVEL
			CURLOPT_POSTFIELDS
			CURLOPT_PROXY
			CURLOPT_PROXYUSERPWD
			CURLOPT_RANDOM_FILE
			CURLOPT_RANGE
			CURLOPT_REFERER
			CURLOPT_SSL_CIPHER_LIST
			CURLOPT_SSLCERT
			CURLOPT_SSLCERTPASSWD
			CURLOPT_SSLCERTTYPE
			CURLOPT_SSLENGINE
			CURLOPT_SSLENGINE_DEFAULT
			CURLOPT_SSLKEY
			CURLOPT_SSLKEYPASSWD
			CURLOPT_SSLKEYTYPE
			CURLOPT_URL
			CURLOPT_USERAGENT
			CURLOPT_USERPWD
		ARRAY
			CURLOPT_HTTP200ALIASES
			CURLOPT_HTTPHEADER
			CURLOPT_POSTQUOTE
			CURLOPT_QUOTE
		RESOURCE
			CURLOPT_FILE
			CURLOPT_INFILE
			CURLOPT_STDERR
			CURLOPT_WRITEHEADER
		CALLBACK
			CURLOPT_HEADERFUNCTION
			CURLOPT_PASSWDFUNCTION
			CURLOPT_PROGRESSFUNCTION
			CURLOPT_READFUNCTION
			CURLOPT_WRITEFUNCTION





