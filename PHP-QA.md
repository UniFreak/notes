# JSON 数据不能被解析
看字符串并没有 JSON 语法错误, 但是用 json_decode() 解析出来是 NULL

可能是 JSON 串前面带了 BOM 头. 解决方法
- (服务端)找出 BOM 头是哪个文件输出的, 确保文件使用 UTF8 无 BOM 编码. 或者
- (服务端)在 echo JSON 串之前, 使用 ob_end_clean() 摒除之前所有输出
- (客户端)手工使用 substr() 把 3 个 BOM 字节删除

see: http://www.cnblogs.com/zqphp/p/4885473.html

# GD created image not display as expected