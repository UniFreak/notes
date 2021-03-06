# @httpd.conf:add PHP modual to Apache
LoadModual php5_module C:/php/php5apache2_4.dll
AddType application/x-httpd-php .php
PHPIniDir C:/php

# @httpd.conf:change document root dir
DocumentRoot "C:/sites"
<Directory "C:/sites">
...
# @httpd-vhosts.conf
<VirtualHost _default:80>
DocumentRoot "C:/sites"
...

# @httpd.conf:disable indexing
<Directory "C:/sites">
Options Indexes FollowSymLinks # delete `Indexes`
...

# @httpd.conf:add error page
ErrorDocument 404 /missing.html

# @httpd-vhosts.conf:add virtual host
<VirtualHost *:80>
...
# @.../etc/hosts
127.0.0.1 yourdomain.com

# @httpd-conf:enable directory-level configure
<Directory "C:/sites">
	AllowOverrid None # change `None` to `All`
...

# @httpd-conf:specify what can be override
<Directory "C:/sites">
	AllowOverrideList ErrorDocument
...

# @.htaccess:change access rule
<RequireAll>
	Requrie all granted # first allow all
	Requrie not ip 127.0.0.1 # then deny 127.0.0.1
</RequireAll>
<RequrieAny></RequrieAny>
<RequireNone></RequrieNone>

# @cmd:create a basic auth
htpasswd -c C:\htpasswds\.htpasswd username
# @.htaccess
<RequrieAny>
	AuthType Basic
	AuthName "Devsite"
	AuthUserFile C:\htpasswds\.htpasswd
	Require valid-user
</RequrieAny>

# @cmd:create a ssl certification
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout C:\certs\devsite.key -out C:\certs\devsite.crt
# @httpd.conf:load sni conf file
<IfModule ssl_module>
	Include conf/extra/httpd-sni.conf
</IfModule ssl_module>
# @httpd-sni.conf:fill out the ssl info
<VirtualHost *:443>
	ServerAdmin admin@devsite.com
	DocumentRoot "C:/sites/devsite"
	ServerName devsite
	ErrorLog "logs/ssl-devsite.log"
	CustomLog "logs/ssl-devsite.log" common
	SSLEngine On
	SSLCertificateFile C:/certs/devsite.crt
	SSLCertificateKeyFile C:/certs/devsite.key
</VirtualHost>

# @cmd:create a digest auth(ssl requried)
htdigest -c C:\htdigests\.htdigest Devsite Client
# @httpd.conf:load digest moduel
LoadModule auto_degist modules/mod_auth_digest.so
# @.htaccess
<RequireAny>
	AuthType Digest
	AuthName "Devsite"
	AuthUserFile C:/htdigest/.htdigest
	Require valid-user
	AuthDigestDomain Devsite
</RequireAny>
# @httpd-sni.conf
<VirtualHost *:443>
	ServerAdmin admin@devsite.com
	DocumentRoot "C:/sites/devsite"
	ServerName devsite
	ErrorLog "logs/ssl-devsite.log"
	CustomLog "logs/ssl-devsite.log" common
	SSLEngine On
	SSLCertificateFile C:/certs/devsite.crt
	SSLCertificateKeyFile C:/certs/devsite.key
	<Directory "C:/sites/devsite">
		AllowOverride AuthConfig
	</Directory>
</VirtualHost>

# @httpd.conf:load URL rewrite module
LoadModule rewrite_module modules/mod_rewrite.so
# @httpd.conf:enable URL rewrite
AllowOverride FileInfo
# @httpd-sni.conf:enable URL rewirte
AllowOverrid FileInfo
# @.htaccess:config URL rewrite
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}


# @httpd.conf&httpd-sni.conf:allow overrid
AllowOverride All
# @httpd.conf:load deflate(gzip), header, expires(cache) modules
LoadModule deflate_module modules/mod_deflate.so
LoadModule header_module modules/mod_header.so
LoadModule expires_module modules/mod_expires.so
# @.htaccess:enable gzip
SetOutputFilter DEFLATE
SetEnvIfNoCase Request_URI .(?:gif|jpe?g|png)$ no-gzip
<IfModule mod_expires.c>
	ExpiresActive On
	ExpiresDefault "access plus 1 seconds"
	ExpiresByType text/html "access plus 1 seconds"
	ExpiresByType image/jpeg "access plus 120 minutes"
</IfModule>


# Apache

安装配置

加载 php 模块

    httpd.conf : LoadModule php5_module "<php_path>/php5apache2.dll"

指定需要解析为 php 的文件后缀名

    httpd.conf : AddType application/x-httpd-php .php .phtml

指定 php.ini 路径

    httpd.conf : PHPIniDir "<php.ini_path>/php.ini "

添加 index.php 到目录索引中

    <IfModule dir_module>
        DirectoryIndex index.php index.html index.htm
    </IfModule>

配置语法

    #   注释
    \   续行
    使用正斜杠 (/) 分隔目录总是不会错的
    指令不区分大小写
    指令的参数区分大小写

常用全局指令

    Alias               实际路径                    别名
    ServerRoot          Apache目录
    Listen              [地址:]端口 [协议]
    LoadModule      模块名称        模块路径
    User                用户名 | #-用户id
    Group               用户组名
    ServerAdmin     管理员邮箱地址
    ServerName      服务器域名
    DocumentRoot        网站文件路径
    DirectoryIndex      目录默认访问页面(如 index.html)
    ErrorLog            错误日志路径
    CustomLog       访问日志路径
    DefaulType          默认文档类型
    AddType             要被解析成的应用类型      文件扩展名
    Include             要包含的文件路径

常用容器(容器可以嵌套)

    <IfDefine></IfDefine>
    <IfModule></IfModule>
    <IfVersion></IfVersion>
    <Directory></Directory>
    <DirectoryMatch></DirectoryMatch>
    <Files></Files>
    <FilesMatch></FilesMatch>
    <Location></Location>
    <LocationMatch></LocationMatch>
    <VirtualHost></VirtualHost>

容器指令

    Option Indexes          // 允许索引目录
    Option FollowSymLinks   // 允许访问链接文件
    Order Allow,Deny            // 先允许, 后拒绝
    AllowOverride   all | none  // 允许 all | none 重写
    Allow From all          // 允许所有访问
    Deny From all               // 拒绝所有访问