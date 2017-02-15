#install on cygwin
1. `cd /tmp`
2. `wget https://phar.phpunit.de/phpunit.phar`
3. `chmod a+x phpunit.phar`
4. `cp phpunit.phar /bin/phpunit`
5. `where phpunit`
6. get output path like `C:\cygwin64\bin\phpunit`
7. `alias phpunit="php C:/cygwin64/bin/phpunit"` __note__: `\` changed to `/`