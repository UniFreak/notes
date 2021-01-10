# See

- <http://www.phpinternalsbook.com>
- Book: <PHP 7 底层设计与源码实现>

# README THIS first (under source directory)

- README.TESTING 

`make test` see `run-tests.php`

- README.TESTING2 

`php server-tests.php -p /path/to/php-cli` see `server-tests.php`

- README.UNIX-BUILD-SYSTEM

`Makefile.ins` are abandoned
The files which are to be compiled are specified in the `config.m4`
have a look at `acinclude.m4`

# Tools

Autoconf

Make & Makefile

Travis

# ENV

MacOS 11.1

# 编译

## The Book Way

1. `wget http://cn2.php.net/distributions/php-7.1.0.tar.gz`

2. `tar -zxvf php-7.1.0.tar.gz`

3. `cd php-7.1.0`

4. `./configure --prefix=... --enable-fpm`

    ERROR:
    > configure: error: Please specify the install prefix of iconv with --with-iconv=<DIR>

    SEE: <https://stackoverflow.com/questions/24987305/php-configure-error-please-specify-the-install-prefix-of-iconv-with-with-icon>

    TAKE 1 -> no luck
    `./configure --prefix=$(pwd)/output --enable-fpm --with-iconv=$(which iconv)`

    TAKE 2 -> ok
    `./configure --prefix=$(pwd)/output --enable-fpm --with-iconv=$(brew --prefix libiconv)`

5. `make && make install`
    
    ERROR: 
    > ...ZendAccelerator.c:588:8: warning: logical not is only applied to the left hand
      side of this comparison [-Wlogical-not-parentheses]
    > Undefined symbols for architecture x86_64:
    > "_libiconv", referenced from:
    > "_libiconv_close", referenced from:
    > "_libiconv_open", referenced from:
    
    SEE: <https://stackoverflow.com/questions/40167324/php-compile-fails-with-undefined-symbols-for-architecture-x86-64-libiconv-on-ma>

    TAKE 1 -> ok
    1. `vim Makefile`
    2. find EXTRA_LDFALGS and EXTRA_LDFLAGS_PROGRAMS
    3. remove L/Applications/Xcode.app/Contents/Developer/Platforms/MacOSX.platform/Developer/SDKs/MacOSX10.11.sdk/usr/lib 

bin/: 
- php-config: 输出 PHP 编译信息的辅助命令
- phpdbg: 调试平台
- phpize: 用来动态安装扩展

## The phpinternalbook.com Way

Why not use package:

- prebuilt package only contains the resulting binaries, but misses other things that are necessary to compile extensions, e.g. header files
- built with high optimization level, which can make debugging very hard
- will not generate warnings about memory leaks or inconsistent data structures
- don’t enable thread safety

Build Dependencies:
- gcc or some other compiler suite.
- libc-dev, which provides the C standard library, including headers.
- make, which is the build-management tool PHP uses.
- autoconf, which is used to generate the configure script.
- libtool, which helps manage shared libraries.
- bison which is used to generate the PHP parser.
- re2c, which is used to generate the PHP lexer.

Depending on the extensions that you enable during the ./configure stage PHP will need a number of additional libraries. When installing these, check if there is a version of the package ending in -dev or -devel and install them instead. The packages without dev typically do not contain necessary header files.

Install Build Dependencies:
- Ubuntu/Debian: `sudo apt-get build-dep php7`

Let's Build:
1. obtain source code from
    - git repo: Recommend. But doesn’t bundle a configure script, need to generate it using the buildconf script, which makes use of autoconf. does not contain a pregenerated parser, so you’ll also need to have bison installed
    - download an archive from PHP’s download page

    ```sh
    git clone http://git.php.net/repository/php-src.git
    cd php-src
    git checkout PHP-7.0
    ```

2. make a default build

```sh
~/php-src> ./buildconf     # only necessary if building from git
~/php-src> ./configure
~/php-src> make -jN        # for fast build, replace N with cpu core number
```


Build PHP Extensions: <http://www.phpinternalsbook.com/php7/build_system/building_extensions.html>

# GDB: 调试 php 程序

## 调试 php-cli

1. 进入 bin/, `gdb php`: 开始调试

2. `(gdb) b main`: 设置断点

3. `(gdb) r test.php`: 运行文件

4. `(gdb) n`: 下一步

5. `(gdb) p ini_entires `: 打印变量

    如果显示 <value optimized out>, 是因为编译器默认使用 -O2 优化导致:
    1. `vi MakeFile`
    2. 修改 `CFLAGS_CLEAN = ` 这一行, 将 O2 变为 O0
    3. 执行 `make clean && make && make install`
    
6. `(gdb) q`: 退出

## 调试 php-fpm

# VLD 扩展: 查看执行过程的 opcode

## 安装

1. `git clone https://github.com/derickr/vld.git`
2. `cd vld/`
3. `./php-7.1.0/output/bin/phpize `
4. `./configure --with-php-config=php-7.1.0/output/bin/php-config --enable-vld`
5. `make && make install`
6. add `extension=vld` into `php.ini`

## 使用

` ./php -dvld.active=1 vld.php`

配合 dot 绘制调用图:
1. `./php -dvld.active=1 -dvld.save_paths=1 vld.php`
2. `dot -Tpng /tmp/paths.dot -o paths.png`

可用选项如下:
- `vld.active`
- `vld.execute`
- `vld.verbosity`
- `vld.skip_prepend`
- `vld.skip_append`
- `vld.format`
- `vld.col_sep`
- `vld.save_dir`
- `vld.save_paths`
- `vld.dump_paths`

# PHP 源码框架

## 流程

源代码
词法分析 (Re2C) -> Token
语法分析 (Bison, BNF) -> 抽象语法树 AST
编译 -> opcodes
执行 opcodes

使用函数 `token_get_all()` 可查看生成的 token

使用上文的 vld 可查看 opcodes

## 目录

sapi/ 输入输出抽象
    apache2handler/
    cgi-fcgi
    fpm-fcgi
    cli
Zend/ zend 引擎
    内存管理: zend_alloc_*  分级管理: 0 <-small-> 3K <-large-> 4K <-huge-> 2M
    垃圾回收: zend_gc_*
    数组: zend_hash*
main/ 黏合 sapi 和 zend
ext/ 扩展相关, 系列函数都在这里定义
TSRM/ 线程安全资源管理器

# TODO

zend_types.h 中的常量在哪儿定义的?

