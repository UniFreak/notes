#安装
- install dependencies
    + `apt-get install libxml2 libxml2-dev`
    + `apt-get install libcurl4-openssl-dev pkg-config`
    + apt-get:
        * `apt-get install libldb-dev libldap2-dev &&`
        * `ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so &&`
        * `ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so`
    + yum:
        * `yum install -y openldap-devel &&`
        * `cp -frp /usr/lib64/libldap* /usr/lib &&`


- `cd /tmp &&`
- `wget http://am1.php.net/distributions/php-5.6.17.tar.bz2 &&` 或
- `wget http://jp2.php.net/distributions/php-5.6.17.tar.bz2 &&`
- `tar xvf php-5.6.17.tar.bz2 &&`
- `cd php-5.6.17 &&`
- 
    ```
    ./configure 
    --enable-fpm 
    --with-mysql 
    --with-ldap
    --with-openssl
    --enable-mbstring
    ```

- `make && make install`

- `cp php.ini-development /usr/local/php/php.ini`
- `cp /usr/local/etc/php-fpm.conf.default /usr/local/etc/php-fpm.conf`
- `cp sapi/fpm/php-fpm /usr/local/bin`
- edit php-fpm.conf: change `user=www-data`, and `group=www-data`

- `/usr/local/bin/php-fpm`


#特点

##安全模式

__Note__:已于 5.3 废弃, 5.4 移除

- 配置指令
    + safe_mode: 当前脚本的拥有者是否和将被操作的文件的拥有者相匹配
    + safe_mode_gid: 放宽到 GID 比较
    + safe_mode_include_dir: 从此目录及其子目录包含文件时越过 UID/GID 检查
    + safe_mode_exec_dir: 程序执行函数将拒绝启动不在此目录中的程序
    + safe_mode_allowed_env_vars: 用户只能改变那些名字具有在这里提供的前缀的环境变量
    + safe_mode_protected_env_vars: 用户不能用 putenv() 来改变这些环境变量
- 影响的__常用__函数
    + UID 检查: move_uploaded_file(), chdir(), fopen(), mkdir(), rmdir() ...
    + 禁用: dl(), shell_exec(), backtick operator, set_time_limit() ...
    + 限制: putenv(), exec(), system(), passthru() ...

## 垃圾回收机制

- 引用计数
- 回收周期
- 性能

## 上传

- 确保表单 `enctype="multipart/form-data"`
- 最好加上 `<input type="hidden" name="MAX_FILE_SIZE" value="30000" />`
- 可以同时上传多个文件, 只需使用数组式的提交语法: `<input name="userfile[]" type="file" />`
- 文件上传后, 信心保存在 $_FILES 中
    + name: 原名称
    + type: 类型
    + size: 大小(字节)
    + tmp_name: 服务端临时文件名, 由 upload_tmp_dir 选项决定
    + error: 错误代码
        * UPLOAD_ERROR_OK: 0 :上传成功
        * UPLOAD_ERROR_INI_SIZE: 1 :　大小超过了　upload_max_filesize 选项限制
        * UPLOAD_ERROR_FORM_SIZE: 2 : 大小超过了 MAX_FILE_SIZE 设置的值
        * UPLOAD_ERROR_PARTIAL: 3 : 只有部分被上传
        * UPLOAD_ERROR_NO_FILE: 4 : 没有文件被上传
        * UPLOAD_ERR_NO_TMP_DIR: 6 : 找不到临时文件夹
        * UPLOAD_ERR_CANT_WRITE: 7 : 文件写入失败
- MAX_FILE_SIZE, upload_max_filesize, post_max_size, memory_limit, max_execution_time 都可能影响大文件上传
- 不要将普通的输入字段和文件上传的字段混用同一个表单变量
- PHP 也支持 PUT 方法的文件上传
- 相关函数
    + is_uploaded_file()
    + move_uploaded_file()
