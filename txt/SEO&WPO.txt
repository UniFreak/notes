============== Resource ===============
online: 
	https://developers.google.com/web/fundamentals/performance/
	http://wenku.baidu.com/view/125e2f68011ca300a6c39069.html?re=view
	http://www.blogjava.net/BlueDavy/archive/2008/09/03/226749.html

book: <<high performance web sites>> by Steve Souder

============== Utiles ===============
gtmetrix.com
webpagetest.org
webkaka.com
Chrome's developer tool (network timeline audit)
Google PageSpeed
	rules: developers.google.com/speed/docs/insights/rules
	plugin: developers.google.com/speed/pagespeed/
	apache module: developers.google.com/speed/pagespeed/module
Yahoo Yslow
	rules: https://developer.yahoo.com/performance/rules.html
	plugin: http://chrome-plugin.com/yslow.crx

============== Summary ===============
session data management

reduce HTTP request
	image map
	CSS sprite
	inline image(suit for very small img that only used for this page once)
	reduce unnecessary redirection
	persist http connection

reduce DNS lookup
	use `keep-alive`
	reduce domain name

URL beautify

reduce duplicate code/file

handle ETag carefully

use multi-line CDN

use chach
	data cache: memcache, redis
	php cache: eaccelerator, apc, phpa, xcache
	query cache: prepared statement,query cache
	front/reverse web cache: Nginx, squid, mod_proxy
	template cache(staticize): smarty
	page fragment cache: ESI
	http cache(expiry)
		normal request
		ajax request

	note:缓存失效算法

数据库优化
	设计
		三大范式与适度反范式
		选择适当的字段类型
		选择适当的存储引擎
		适当建立索引(create index) - 经常作为查询条件,区分度高的字段
		适当使用外键
		分库, 分表(水平|垂直)
	SQL 语句
		使用 explain/慢日志工具分析
		使用 limit, 避免 select *,
		使用连接查询 (JOIN) 替代子查询 (SUBQUERY)
		使用存储过程
		使用联合 (UNION) 替代手动创建临时表
		尽量少使用 LIKE 关键字和通配符
	数据库配置
		主从复制, 读写分离
		负载均衡
		分区
	硬件/操作系统
	
use compression
	gZip
	js/css file

outside file reference
	load css file earlier
	load js script later

seperate js&css file from html, and set a longer expiry

code efficiency
	html & css & js:reduce reflow & repaint
		reduce DOM node(our site's index is 2126!)
		use class to change element's style
		use dynamic iframe or friendly iframe

		add node:use documentFragment
		modify node:clone->mofify->replace
		reduce use of [offset|scrollTop|client][Top|Left|Width|Height] & getComputedStyle
		avoid too large tranverse
		use event delegation
	php
		...

use other php processor instead of mod_php, like php-fpm(php fastCGI process manager)
consider lighthttpd, nginx

Tricks
	see if a image is from cache by looking at chrome developer's tool's network tab's size column