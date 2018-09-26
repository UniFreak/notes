==================== NOTES ====================
don't use smarty

=============== 配置 ===============
	require('Smarty.class.php'); 		// 引入库文件

	$smarty = new Smarty;				// 实例化 Smarty 对象

	$smarty->template_dir = '';			// 指定模板目录
	$smarty->compile_dir = '';			// 指定编译目录
	$smarty->config_dir = '';			// 指定配置目录
	$smarty->cache_dir = '';			// 指定缓存目录

	$smarty->assign('name','Ned');		// 传递参数

	$smarty->display('index.tpl');		// 指定显示模板

=============== 模板设计(*.tpl) ===============
默认定界符		{ }

注释			{* *}

变量(要输出一个变量,只要用定界符将它括起来就可以)
	从PHP中分配的变量, 需在前加 $ 符号
		用 . 或 [] 来引用关联数组中的变量			{$arr['name']} 或 {$arr.name}
		用 [] 来引用索引数组的的变量				{$arr[0]}
		用 -> 来引用对象属性						{$obj->attr}
	从配置文件读取的变量(只有在它们被加载(使用 {config_load} 函数)以后才能使用)
		用 # 包含									{#varname#}
		用保留变量 $smarty.config.*					{$smarty.config.varname}
	保留变量
		{$smarty.request.*}
		{$smarty.get.*}
		{$smarty.post.*}
		{$smarty.cookies.*}
		{$smarty.server.*}
		{$smarty.env.*}
		{$smarty.session.*}
		{$samrty.config.*}							已加载的配置变量
		{$smarty.const.*}							PHP 常量
		{$smarty.capture}							{capture}...{/capture} 捕获的内容
		{$smarty.section.<sectionName>.<varName>}	{section} 属性
			varName 包括
				index				当前循环的索引, 从 0 开始, 受 start, step, max 影响
				index_prev			上一个循环索引值
				index_next			下一个循环索引值
				iteration/rowname	当前循环的次数, 不受 start, step, max 影响
				first				是否是第一次执行
				last				是否是最后一次执行
				loop				上一次循环时的索引值
				show				是否设定为显示该循环
				total				循环总次数
		{$smarty.foreach.<foreachName>.<varName>}	{foreach} 属性
			varName 包括
				iteration 			当前循环次数
				first 				是否是第一次执行
				last 				是否是最后一次执行
				show				是否显示该循环
				total				循环总次数
		{$smarty.template}							模板名
		{$smarty.now}								当前时间戳

变量调节器:{变量|调节器:参数1:参数2:...}
	|upper														大写
	|lower														小写
	|capitalize													首字大写
	|count_characters[:true|false]								字符计数:是否算空格
	|count_paragraphs											段落计数
	|count_sentences											句子计数
	|count_words												词语计数
	|cat[:"<string>"]											连接字符串:要连接到变量后的字符串
	|data_format[:"<data format>"]								格式化日期:格式
	|string_format:"<sprintfFormat>"							格式化字符串:格式
	|default[:"<default value>"]								设置默认值:默认值
	|escape[:html|htmlall|url|quotes|hex|hexentity|javascript]	编码:格式
	|indent[:<indentNum>[:<indentWith>]]						缩进:缩进数:缩进单位
	|nl2br														换行符替换成 <br />
	|replace:"<regex>":"<replaceWith>"							简单替换:被替换的字符串:替换为
	|regex_replace:"<regExp>":"<replaceWith>"					正则替换:正则:替换为
	|spacify[:"<spacifyWith>"]									插空:插入为
	|strip[:"<stripWith>"]										去除多余空格:替换为
	|strip_tags													去除 html 标签(包括内容)
	|truncate[:<num>[:"<truncateWith>"[:true|false]]]			截取:字符数:追加为:是否精确到字符
	|wordwrap[:<num>[:"<wrapWith>"[:true|false]]]				行宽约束:宽度值:约束字符:是否精确到字符

	对于同一个变量,你可以从左到右使用"|"组合多个修改器

函数语法
	{funcname attr1="val" attr2="val"}

	在模板里无论是内建函数还是自定义函数都有相同的语法.
	内建函数将在smarty内部工作,例如 {if} , {section} and {strip} .他们不能被修改.
	自定义函数通过插件机制起作用,它们是附加函数. 只要你喜欢,可以随意修改.

属性语法
	smarty函数的属性很像HTML中的属性.
	静态数值,变量,布尔值不需要加引号,但是字符串建议使用引号.
	Smarty可以识别嵌入在双引号中的变量，只要此变量只包含数字、字母、下划线和中括号[].对于其他的符号（句号、对象相关的，等等）此变量必须用两个'`'包住
	数学运算可以直接应用到变量

内建函数
	捕获模板输出
	{capture name=<varName>}{/capture}
		name: 捕获后的内容存储到的变量

	配置文件中加载变量
	{config_load file="<filename>" [section="<sectionName>"[ scope="local|parent|global"[ global="true|false"]]]}
		file: 待包含的配置文件的名称
		section: 配置文件中待加载部分的名称
		scope: 加载数据的作用域，取值必须为local, parent 或 global
		global: 说明加载的变量是否全局可见

	循环数组
	{foreach from=$arr [name=<foreachName> [key=<keyName>]] item=<itemName>}
	[{foreachelse}]
	{/foreach}
		from: 待循环数组的名称
		item: 当前处理元素的变量名称
		key: 当前处理元素的键名
		name: 该循环的名称, 用于访问该循环

	包含模板
	{include file="<filepath>" [assign="varName" [var ...]]}
		varName: 用于保存待包含模板的输出, 这样待包含模板的输出就不会直接显示
		var: 传递给待包含模板的本地参数, 只在待包含模板中有效

	包含 php 脚本
	{include_php file="<filepath>" [once=[true|false]] assign="varName"}
		file: 待包含 php 文件的名称
		once: 是否只包含一次
		assign: 该属性指定一个变量保存待包含 php 文件的输出

	插入函数，但是 insert 所包含的内容不会被缓存
	{insert name="<funcName>" [assign="varName"] [script="fileName"] [var...]}
		name: 插入函数的名称
		assign: 该属性指定一个变量保存待插入函数输出
		script: 插入函数前需要先包含的php脚本名称
		var...: 传递给待插入函数的本地参数

	条件判断
	{if} {elseif} {else} {/if}
		条件修饰词:eq、ne、neq、gt、lt、lte、le、gte、ge、is even、is odd、is not even、is not odd、not、mod、div by、even by、odd by、==、!=、>、<、<=、>=
		使用这些修饰词时必须和变量或常量用空格格开.

	输出"{"
	{ldelim}

	输出"}"
	{rdelim}

	直接显示
	{literal} {/literal}

	嵌入 php
	{php} {/php}

	遍历数组
	{section name=<sectionName> loop=<$varName> [start=<integer>[step=<integer>[max=<integer>[show=true|false]]]]}
	[{sectionelse}]
	{/section}
		name: 该循环的名称
		loop: 决定循环次数的变量名称
		start: 循环执行的初始位置
		step: 循环的步长
		max: 最大执行次数
		show: 是否显示该循环

	去除首尾空格和回车
	{strip} {/strip}

自定义函数
	为模板变量赋值
	{assign var="<varName>" value="<varValue>"}
		var: 变量名
		value: 变量值


	输出一个记数过程
	{counter [name=<counterName>] [start=<integer>] [skip=<integer>] [direction=up|down] [print=true|false] [assign=$<varName>]}
		name: 计数器的名称
		start: 记数器初始值
		skip: 记数器步长
		direction: 记数器方向
		print: 是否输出值
		assign: 输出值将被赋给模板变量的名称

	轮转使用一组值
	{cycle values=["value1,value2,..."|<arrName>] [name=<cycleName>] [print=true|false] [assign=<varName>]}
		name: 轮转的名称
		values: 待轮转的值, 可以是用逗号分隔的列表(请查看 delimiter 属性)或一个包含多值的数组
		print: 是否输出值
		advance: 是否使用下一个值(为 false 时使用当前值)
		delimiter: 指出 values 属性中使用的分隔符, 默认是逗号
		assign: 输出值将被赋给模板变量的名称

	输出调试信息
	{debug output=html|javascript}
		output: 输出类型

	按处理模板的方式计算取得变量的值, 该特性可用于在配置文件中的标签/变量中嵌入其它模板标签/变量.
	{eval var=<varName> [assign=<varName>]}
		var: 待求值的变量(或字符串)
		assign: 输出值将被赋给模板变量的名称

	获取本地文件系统, HTTP 或 FTP 文件内容
	{fetch file=<filepath> [assign=<varName>]}
		file: 待请求的文件，http或ftp方式
		assign: 输出值将被赋给模板变量的名称

	创建复选按钮组
	{html_checkboxes}
		name: 复选按钮组的名称
		values: 包含复选按钮组值的数组
		output: 包含复选按钮组显示值的数组
		selected: 已选定的元素或元素数组
		options: 包含值和显示的关联数组
		seperator: 分隔每个复选按钮的字符串
		labels: 是否为每个复选按钮添加 <label> 标签

	创建图像
	{html_image}
		file: 图象文件的名称或路径
		border: 图象边框大小
		height: 图象高度
		width: 图象宽度
		basedir: 图象文件位置的相对路径
		alt: alt 信息
		href: 图象链接

	创建选项组
	{html_options}
		values: 下拉列表各元素值的数组
		output: 下拉列表各元素显示值的数组
		selected: 已选定的元素或元素数组
		options: 包含值和显示的关联数组
		name: 下拉菜单的名称

	创建单选按钮组
	{html_radios}
		name: 单选按钮列表的名称
		values: 包含单选按钮值的数组
		output: 包含单选按钮显示值的数组
		checked: 已选定的元素
		options: 包含值和显示的关联数组
		separator: 分隔每个单选按钮的字符串

	创建日期下拉菜单
	{html_select_date}
		prefix: 变量名称前缀
		time: UNIX时间戳或年-月-日 使用时间类型(data/time)
		start_year: 下拉列表中第一个年份, 或与当前年份的相对值(正/负 几年)
		end_year: 下拉列表中最后一个年份, 或与当前年份的相对值(正/负 几年)
		display_days: 是否显示天
		display_months: 是否显示月
		display_years: 是否显示年
		month_format:月份的表示方法(strftime)
		day_format: 天显示的格式(sprintf)
		day_value_format: 天的表示方法(sprintf)
		year_as_text: 是否以文本方式显示年份
		reverse_years: 逆序显示年份
		field_array: 如果指定了名称, 选定的区域将以[Day],[Year],[Month]的形式返回给PHP(待考)
		day_size: 如果给定, 为标签添加大小属性
		month_size: 如果给定, 为标签添加大小属性
		year_size: 如果给定, 为标签添加大小属性
		all_extra: 如果给定, 为所有标签添加附加属性
		day_extra: 如果给定, 为标签添加附加属性
		month_extra: 如果给定, 为标签添加附加属性
		year_extra: 如果给定, 为标签添加附加属性
		field_order: 显示区域的顺序
		field_separator: 各区域间输出的分隔字符串
		month_value_format: 月份值的strftime表示方法, 默认为 %m

	创建时间下拉菜单
	{html_select_time}
		prefix: 变量名称前缀
		time: 使用时间类型(data/time)
		display_hours: 是否显示小时
		display_minutes: 是否显示分钟
		display_seconds: 是否显示秒
		display_meridian: 是否显示正午界(上午/下午)
		use_24_hours: 是否使用24小时制
		minute_interval: 分钟下拉列表的间隔
		second_interval: 秒钟下拉列表的间隔
		field_array: 输出值到该值指定的数组
		all_extra: 如果给定, 为标签添加附加属性
		hour_extra: 如果给定, 为标签添加附加属性
		minute_extra: 如果给定, 为标签添加附加属性
		second_extra: 如果给定, 为标签添加附加属性
		meridian_extra: 如果给定, 为标签添加附加属性

	将数组中的数据填充到 HTML 表格中
	{html_table}
		loop: 待遍历的数组
		cols: 表格的列数目
		table_attr: 表格的属性
		tr_attr: 行标签属性(或轮转数组)
		td_attr: 列标签属性(或轮转数组)
		trailpad: 最后一行附加的数据(如果有的话)
		hdir: 行的对齐方式, 可能的值为 left 或 right
		vdir: 列的对齐方式, 可能的值为 up 或 down

	进行数学表达式运算
	{math}
		equation: 待执行的表达式
		format: 结果的格式(遵从sprintf函数)
		var: 表达式变量值
		assign: 输出值将被赋给模板变量的名称
		[var ...]: 表达式变量值

	生成电子邮件链接
	{mailto}
		address: 电子邮件地址
		text: 邮件链接上显示的文本, 默认为电子邮件地址
		encode: none, hex或javascript
		cc: 邮件抄送地址, 多条地址信息以逗号分隔
		bcc: 邮件暗送地址, 多条地址信息以逗号分隔
		subject: 邮件主题
		newsgroups: 发送到新闻组的地址, 多条地址信息以逗号分隔
		followupto: 追踪地址信息, 多条信息以逗号分隔
		extra: 其它需要传递给链接的信息, 如css样式

	创建帮助窗口或工具提示
		{popup_init}

	创建javascript弹出窗口
	{popup}

	格式化文本
	{textformat}
		style: 预处理风格
		indent: 单行缩进的字符数目
		indent_first: 首行缩进的字符数目
		indent_char: 填充缩进区域的字符(或字符串)
		wrap: 单行长度, 超过该长度自动折行
		wrap_char: 折行使用的字符(或字符串), 被附加在行尾
		wrap_cut: 如果设置为真, 换行时不考虑换行点所在位置是否为完整单词, 直接换行. 反之将在单词的边界处换行.
		assign: 输出值将被赋给模板变量的名称


配置文件语法
	# global variables
	pageTitle = "Main Menu"
	bodyBgColor = #000000
	tableBgColor = #000000
	rowBgColor = #00ff00

	[Customer]
	pageTitle = "Customer Info"

	[Login]
	pageTitle = "Login"
	focus = "username"
	Intro = """This is a value that spans more
	 than one line. you must enclose
				it in triple quotes."""

	# hidden section
	[.Database]
	host=my.domain.com
	db=ADDRESSBOOK
	user=php-user
	pass=foobar

================ 模板程序(*.php) ===============
常量
	SMARTY_DIR
变量
	$template_dir 						模板目录变量
	$compile_dir 						编译目录变量
	$config_dir 						配置目录变量
	$plugins_dir 						插件目录变量
	$debugging 							调试变量
	$debug_tpl[							调试模板变]
	$debugging_ctrl 					调试控制变量
	$global_assign 						全局配置变量
	$undefined 							未定义变量
	$autoload_filters 					自动加载过滤器变量
	$compile_check 						编译检查变量
	$force_compile 						强迫编译变量
	$caching 							缓存变量
	$cache_dir 							缓存目录变量
	$cache_lifetime 					缓存生存时间变量
	$cache_handler_func 				缓存处理函数变量
	$cache_modified_check 				缓存修正检查变量
	$config_overwrite 					配置覆盖变量
	$config_booleanize 					配置布尔化变量
	$config_read_hidden 				配置读取隐藏变量
	$config_fix_newlines 				配置固定换行符变量
	$default_template_handle r_func 	默认模板处理函数变量
	$php_handling 						PHP处理变量
	$security 							安全变量
	$secure_dir 						安全目录变量
	$security_settings 					安全配置变量
	$trusted_dir 						信任目录变量
	$left_delimiter 					左结束符变量
	$right_delimiter 					右结束符变量
	$compiler_class 					编译类变量
	$request_vars_order 				变量顺序变量
	$request_use_auto_globals 			自动全局变量
	$compile_id 						编译ID变量
	$use_sub_dirs 						子目录变量
	$default_modifiers 					默认修正器变量
	$default_resource_type 				默认源类型变量
方法
	append 								添加
	append_by_ref 						引用添加
	assign 								赋值
	assign_by_ref 						引用赋值
	clear_all_assign 					清除所有赋值
	clear_all_cache 					清除所有缓存
	clear_assign 						清除赋值
	clear_cache 						清除缓存
	clear_compiled_tpl 					清除已编译模板
	clear_config 						清除配置
	config_load 						加载配置
	display 							显示
	fetch 								取得输出的内容
	get_config_vars 					取配置变量的值
	get_registered_object 				取得已注册的对象
	get_template_vars 					取得模板变量的值
	is_cached 							是否已被缓存
	load_filter 						加载过滤器
	register_block 						注册一个块
	register_compiler_function 			注册编译函数
	register_function 					注册函数
	register_modifier 					注册修饰器
	register_object 					注册对象
	register_outputfilter 				注册输出过滤器
	register_postfilter 				注册提交过滤器
	register_prefilter 					注册预过滤器
	register_resource 					注册资源
	trigger_error 						触发错误
	template_exists 					模板是否存在
	unregister_block 					注销一个块
	unregister_compiler_function 		注销编译函数
	unregister_function 				注销函数
	unregister_modifier 				注销修饰器
	unregister_object 					注销对象
	unregister_outputfilter 			注销输出过滤器
	unregister_postfilter 				注销提交过滤器
	unregister_prefilter 				注销预过滤器
	unregister_resource 				注销资源
缓存
高级
插件


