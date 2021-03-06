# Quirks
- install old php & package(php56, php56-xdebug...): https://stackoverflow.com/questions/49649693/install-php-extension-for-php-5-6-on-osx-with-deprecated-homebrew-php

# Apps

## Daily

- QQ
- Chrome
- XChat
- Xunlei
- PDF reader
- PS
- office for Mac

## Efficency

- typora
- MollyGuard
- Keyboard Meastro
- Launchbar

## Cli Env

- Starship
- z
- tldr

`brew install inetutils` install ftp, telnet, ...

# dev utils
- @see: http://www.josebrowne.com/open/from-windows-to-mac-dev
- sublimeText: @see SublimeText.md
- brew install cask meld
- Postman
- Docker 化开发环境
- CI
- Python 调试
- nodejs
- git with git-completion.bash

# php

1. tag homebrew/php
2. brew install php56 php71
3. switch: brew unlink php56 && brew link php71 or vice versa

# xdebug

pass

# traps

## related knowledge
config:
- dns
- extra_hosts
- network_mode

## 1

```sh
The following packages have unmet dependencies:
 libfreetype6-dev : Depends: zlib1g-dev but it is not going to be installed or
                             libz-dev
 libpng12-dev : Depends: zlib1g-dev but it is not going to be installed
E: Unable to correct problems, you have held broken packages.
```

while

```sh
apt-get update     && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev     && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/     && docker-php-ext-install gd     && :    && apt-get install -y libicu-dev     && docker-php-ext-install intl     && :    && apt-get install -y libxml2-dev     && apt-get install -y libxslt-dev     && docker-php-ext-install soap     && docker-php-ext-install xsl     && docker-php-ext-install xmlrpc     && docker-php-ext-install wddx     && :    && apt-get install -y libbz2-dev     && docker-php-ext-install bz2     && :    && docker-php-ext-install zip     && docker-php-ext-install pcntl     && docker-php-ext-install pdo_mysql     && docker-php-ext-install mysqli     && docker-php-ext-install mbstring     && docker-php-ext-install exif     && docker-php-ext-install bcmath     && docker-php-ext-install calendar     && docker-php-ext-install sockets     && docker-php-ext-install gettext     && docker-php-ext-install shmop     && docker-php-ext-install sysvmsg     && docker-php-ext-install sysvsem     && docker-php-ext-install sysvshm     && docker-php-ext-install opcache
```

search result:

- https://askubuntu.com/questions/720361/cant-install-libpng-dev
- https://stackoverflow.com/questions/26220957/how-can-i-inspect-the-file-system-of-a-failed-docker-build

try fix:
- `apt-get install --reinstall libpng12-0=1.2.50-2+deb8u3`

no luck:

fix: source.list is misconfiged to use jessie, while container is Debian/stretch

## 2.

error:

```sh
ERROR: Service 'php' failed to build: The command '/bin/sh -c pecl install redis-3.1.4     && docker-php-ext-enable redis     && :    && pecl install xdebug-2.5.5     && docker-php-ext-enable xdebug     && :    && apt-get install -y libmagickwand-dev     && pecl install imagick-3.4.3     && docker-php-ext-enable imagick     && :    && apt-get install -y libmemcached-dev zlib1g-dev     && pecl install memcached-2.2.0     && docker-php-ext-enable memcached' returned a non-zero code: 1
```

reason: GFW

fix: use vpn

other options: (https://github.com/yeszao/dnmp/issues/10)
- install from source
- pecl install <localPackage>

## 3.

```
E: Failed to fetch http://deb.debian.org/debian/dists/stretch/InRelease  Clearsigned file isn't valid, got 'NOSPLIT' (does the network require authentication?)
E: Failed to fetch http://security.debian.org/debian-security/dists/stretch/updates/InRelease  Clearsigned file isn't valid, got 'NOSPLIT' (does the network require authentication?)
E: Failed to fetch http://deb.debian.org/debian/dists/stretch-updates/InRelease  Clearsigned file isn't valid, got 'NOSPLIT' (does the network require authentication?)
E: Failed to fetch http://deb.debian.org/debian/dists/buster/InRelease  Clearsigned file isn't valid, got 'NOSPLIT' (does the network require authentication?)
E: Failed to fetch http://security.debian.org/debian-security/dists/buster/updates/InRelease  Clearsigned file isn't valid, got 'NOSPLIT' (does the network require authentication?)
E: Failed to fetch http://deb.debian.org/debian/dists/buster-updates/InRelease  Clearsigned file isn't valid, got 'NOSPLIT' (does the network require authentication?)
E: Some index files failed to download. They have been ignored, or old ones used instead.
```

- use AnyConnect VPN, even if you are in company
- use correct source.list -> mirror.163 (php7:jessie, php56:stretch)

## 3.1

运维迁云, 导致公司内部不能连接 AnyConnect

## 4.

```
The following packages have unmet dependencies:
 libfreetype6-dev : Depends: zlib1g-dev but it is not going to be installed or
                             libz-dev
 libpng12-dev : Depends: zlib1g-dev but it is not going to be installed
```

- `RUN apt-get upgrade -y` after `RUN apt-get update`
- insert `zlib1g zlib1g-dev` after `run apt-get install -y`

## 5.

```
downloading xdebug-2.5.5.tgz ...
Starting to download xdebug-2.5.5.tgz (279,491 bytes)
.........................................................done: 279,491 bytes
76 source files, building
running: phpize
Configuring for:
PHP Api Version:         20170718
Zend Module Api No:      20170718
Zend Extension Api No:   320170718
building in /tmp/pear/temp/pear-build-defaultuserh4pr3S/xdebug-2.5.5
running: /tmp/pear/temp/xdebug/configure --with-php-config=/usr/local/bin/php-config
....
checking whether to enable Xdebug support... yes, shared
checking Check for supported PHP versions... configure: error: not supported. Need a PHP version >= 5.5.0 and < 7.2.0 (found 7.2.15)
ERROR: `/tmp/pear/temp/xdebug/configure --with-php-config=/usr/local/bin/php-config' failed
```

- change `pecl install xdebug-2.5.5` to `pecl install xdebug`

## 6.

```
pecl/memcached requires PHP (version >= 5.2.0, version <= 6.0.0, excluded versions: 6.0.0), installed version is 7.2.15
No valid packages found
install failed
```

- change `pecl install memcached-2.2.0` to `pecl install memcached`

## xdebug not work:

this work:

in docker's xdebug.ini:

see:
- <https://stackoverflow.com/questions/38311482/integrating-docker-with-xdebug-and-sublime-text-on-php-environment#>
-

```ini
zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20131226/xdebug.so
xdebug.remote_enable=on
xdebug.remote_host=192.168.91.150
xdebug.idekey=xdbg
xdebug.remote_cookie_expire_time=36000
xdebug.remote_connect_back=0
xdebug.remote_autostart=1
xdebug.remote_port=9000
```

and sublime's xdebug extension setting:

```json
    path_mapping : {
        "/var/www/html/": "/Users/fanghao/Projects/",
    },
```

but ip may change

this will also work: `xdebug.remote_host=192.168.65.2`
so I can use `getent hosts host.docker.internal | awk '{ print $1 }'` to get ip
see: <https://docs.docker.com/docker-for-mac/networking/#use-cases-and-workarounds>

then change the xdebug config

other traps:

- error while installing php extension: remember to trim \
- error while `run pecl install`: use a vpn(like xin)
- xdebug not working unless in company network, even with vpn @?
- domain not working in browser unless in company network, even with vpn @?
- **notice this**
    + in company docker subnet: 172.16.24.0/24, xdebug remote_host=172.16.24.2
    + in home 192.168.65.0/24, xdebug remote_host=192.168.65.2
    + try configure only path_mappin of `Project` dir and make sure workspace folder dragged from `Project dir`
- postman respond to api call fine, but site can not be access via browser: no response --> turn off all vpns

## 运维迁云导致 docker 内部不能访问云 mysql 服务器
