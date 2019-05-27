# Mac Local LNMP

## PHP

multiple version:

install:

php56: `brew install php56`
php72: `brew unlink php56` -> `brew install php71`

config: change port 9000 to 9056 and 9071

php56: `/usr/local/etc/php/5.6/php-fpm.conf`
php71: `/usr/local/etc/php/7.1/php-fpm.d/www.conf` <-- **NOTE www.conf**

start fpm
php56: `/usr/local/Cellar/php56/5.6.**/sbin/php56-fpm start`
php71: `/usr/local/Cellar/php70/7.1.**/sbin/php70-fpm start`

kill all fpm: `sudo killall php-fpm`

## Nginx

install: `brew install nginx`

config: `/usr/local/etc/nginx/nginx.conf`

start: `nginx` then visit `http://localhost:8080`

## Traps

1. erp use php56 keep nginx 502 -> temparary use 71
2. logger cannot create log files -> create the dir and make it 777

# Docker see <macUp.md>