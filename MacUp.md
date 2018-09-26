# common utils
- QQ
- Chrome
- XChat
- Xunlei
- PDF reader
- PS
- typora
- office for Mac

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

# debug

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
