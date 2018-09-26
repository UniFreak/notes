XSL: EXtensible Stylesheet Language
发展 XSL 的起因是由于对基于 XML 的样式表语言的需求

=============== XSLT===============
XSLT: XSL Transform, 使用 XPath 查找节点并应用样式, 用于转换 XML 文档
XSL 样式表本身也是一个 XML 文档, 因此它总是由 XML 声明起始
声明:
	<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"> 
	或 <xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

元素参考
	apply-imports		应用来自导入样式表中的模版规则
	apply-templates	向当前元素或当前元素的子元素应用模板
		select 	mode
	attribute 			向元素添加属性
		name 	namespace
	attribute-set 		创建命名的属性集
		name	use-attribute-sets
	call-template 		调用一个指定的模板
		name
	choose 			与<when>以及<otherwise>协同使用, 来表达多重条件测试
		use-attribute-sets
	comment 			在结果树中创建注释节点
	copy 				创建当前节点的一个备份( 无子节点及属性 )
		use-attribute-sets
	copy-of 			创建当前节点的一个备份( 带有子节点及属性 )
		select
	decimal-format 	定义当通过 format-number() 函数把数字转换为字符串时, 所要使用的字符和符号
		name	dcima-separator	grouping-separator	infinity		nimus-sign	NaN	percent		per-mille	zero-digit	digit	pattern-separator
	element 			在输出文档中创建一个元素节点
		name 	namespace		use-attribute-sets
	fallback 			假如处理器不支持某个XSLT元素, 规定一段备用代码来运行
	for-each 			遍历指定的节点集中的每个节点
		select
	if 					包含一个模板, 仅当某个指定的条件成立时应用此模板
		test
	import 				用于把一个样式表中的内容倒入另一个样式表中
		href
	include 			把一个样式表中的内容包含到另一个样式表中
		href
	key 				声明一个命名的键
		name	match	use
	message 			向输出写一条消息( 用于错误报告 )
		terminate
	namespace-alias 	把样式表中的命名空间替换为输出中不同的命名空间
		stylesheet-prefix	result-prefix
	number 			测定当前节点的整数位置, 并对数字进行格式化
		count	level	from	value	format	lang	letter-value		grouping-separator	grouping-size
	otherwise 			规定 <choose> 元素的默认动作
	output 				定义输出文档的格式
		method	version		encoding	omit-xml-declaration	standalone		doctype-public		doctype-system	cdata-section-elements	indent	media-type
	param 				声明一个局部或全局参数
		name 	select
	preserve-space 	用于定义保留空白的元素
		elements
	processing-instruction 生成处理指令节点
		name
	sort 				对结果进行排序
		select	lang	data-type	order	case-order
	strip-space 		定义应当删除空白字符的元素
		elements
	stylesheet 			定义样式表的根元素
		version		extension-element-prefixes	exclude-result-prefixes	id
	template 			当指定的节点被匹配时所应用的规则
		name	match	mode	pripority
	text 				通过样式表生成文本节点
		disable-output-escaping
	transform 			定义样式表的根元素
		version		extension-element-prefixes	exclude-result-prefixes	id
	value-of 			提取选定节点的值
		select	disable-output-escaping
	variable 			声明局部或者全局的变量
		name	select
	when 				规定 <choose> 元素的动作
		test
	with-param 		规定需被传入某个模板的参数的值
		name select
内建函数参考
	current() 			返回当前节点作为唯一成员的节点集 
	document() 		用于访问外部 XML 文档中的节点 
	element-available()	检测 XSLT 处理器是否支持指定的元素 
	format-number() 	把数字转换为字符串 
	function-available()检测 XSLT 处理器是否支持指定的函数 
	generate-id() 		返回唯一标识指定节点的字符串值 
	key() 				检索以前使用 <xsl:key> 语句标记的元素 
	node-set  			将树转换为节点集产生的节点集总是包含单个节点并且是树的根节点 
	system-property() 	返回系统属性的值 
	unparsed-entity-uri()返回未解析实体的 URI 

=============== XSL-FO ===============
XSL-FO: 用于格式化 XML 文档


=============== XPath ===============
XPath 用于在 XML 文档中导航
XPath 使用路径表达式来选取 XML 文档中的节点或者节点集
XPath 表达式是 XQuery 和 XPointer 的基础
XPath 有七种类型的节点: 元素 属性 文本 命名空间 处理指令 注释 文档节点(根节点)

- the most important kind of expression in XPath is a location path. A location path consists of a sequence of location steps. Each location step has three components:
	an axis
	a node test
	zero or more predicates
- To select the first node selected by the expression A//B/*, write (A//B/*)[1].
- Index values in XPath predicates (technically, 'proximity positions' of XPath node sets) start from 1
- XPath 1.0 defines four data types: node-sets (sets of nodes with no intrinsic order), strings, numbers and booleans

step: 
	Axis:Node-test[Predicts]
path expression: 
	step/step/...

Operator
	/				 		从根节点选取
	//				 		从匹配选择的当前节点选择文档中的节点, 而不考虑它们的位置
	[]						

	| 						计算两个节点集

	+ 						加法
	- 						减法
	* 						乘法
	div 					除法
	mod 					求余

	= 						等于
	!= 						不等于
	< 						小于
	<= 						小于或等于
	> 						大于
	>= 						大于或等于

	or 						或
	and 					与
	not()
Wildcard
	.				 		选取当前节点
	..				 		选取当前节点的父节点
	@*						任何属性节点
	* 						任何节点
	node()					任何类型节点
Axis:indicate navigation direction within the tree representation of the XML document
	ancestor						选取当前节点的所有先辈 (父、祖父等) 
	ancestor-or-self 				选取当前节点的所有先辈 (父、祖父等) 以及当前节点本身
	attribute				@		选取当前节点的所有属性
	child				 			选取当前节点的所有子元素
	descendant						选取当前节点的所有后代元素 (子、孙等) 
	descendant-or-self 		//		选取当前节点的所有后代元素 (子、孙等) 以及当前节点本身
	following						选取文档中当前节点的结束标签之后的所有节点
	following-sibling				选取当前节点之后的所有同级节点
	namespace						选取当前节点的所有命名空间节点
	parent				 	..		选取当前节点的父节点
	preceding						选取文档中当前节点的开始标签之前的所有节点
	preceding-sibling 				选取当前节点之前的所有同级节点
	self				 	.		选取当前节点
Node test:may consist of specific node names or more general expressions
	comment()						finds an XML comment node
	text()							finds a node of type text
	processing-instruction()		finds XML ?processing instructions?
	node()							finds any node at all
Predicts: written in square brackets, used to filter node-set
	[1]						第一个
	[last()]				最后一个
	[last()-1]				倒数第二个
	[position()-3]			前两个
	[@lang]					所有有 lang 属性的
	[@lang='en']			所有 lang 属性为 en 的
	[price>35]				price 元素值大于 35 的

函数参考
	存取
		fn:node-name(node)
		fn:nilled(node)
		fn:data(item.item,...)
		fn:base-uri()
		fn:base-uri(node)
		fn:document-uri(node)
	错误和跟踪
		fn:error()
		fn:error(error)
		fn:error(error,description)
		fn:error(error,description,error-object)
	数值
		fn:number(arg)
		fn:abs(num)
		fn:ceiling(num)
		fn:floor(num)
		fn:round(num)
		fn:round-half-to-even()
	字符串		 
		fn:string(arg)
		fn:codepoints-to-string(int,int,...)
		fn:string-to-codepoints(string)
		fn:codepoint-equal(comp1,comp2)
		fn:compare(comp1,comp2)
		fn:compare(comp1,comp2,collation)
		fn:concat(string,string,...)
		fn:string-join((string,string,...),sep)
		fn:substring(string,start,len)
		fn:substring(string,start)
		fn:string-length()
		fn:normalize-space()
		fn:upper-case(string)
		fn:lower-case(string)
		fn:translate(string1,string2,string3)
		fn:escape-uri(stringURI,esc-res)
		fn:contains(string1,string2)
		fn:starts-with(string1,string2)
		fn:ends-with(string1,string2)
		fn:substring-before(string1,string2)
		fn:substring-after(string1,string2)
		fn:matches(string,pattern)
		fn:replace(string,pattern,replace)
		fn:tokenize(string,pattern)
	AnyURI
		fn:resolve-uri(relative,base)
	布尔
		fn:boolean(arg)
		fn:not(arg)
		fn:true()
		fn:false()
	时间和日期
		fn:dateTime(date,time)
		fn:years-from-duration(datetimedur)
		fn:months-from-duration(datetimedur)
		fn:days-from-duration(datetimedur)
		fn:hours-from-duration(datetimedur)
		fn:minutes-from-duration(datetimedur)
		fn:seconds-from-duration(datetimedur)
		fn:year-from-dateTime(datetime)
		fn:month-from-dateTime(datetime)
		fn:day-from-dateTime(datetime)
		fn:hours-from-dateTime(datetime)
		fn:minutes-from-dateTime(datetime)
		fn:seconds-from-dateTime(datetime)
		fn:timezone-from-dateTime(datetime)
		fn:year-from-date(date)
		fn:month-from-date(date)
		fn:day-from-date(date)
		fn:timezone-from-date(date)
		fn:hours-from-time(time)
		fn:minutes-from-time(time)
		fn:seconds-from-time(time)
		fn:timezone-from-time(time)
		fn:adjust-dateTime-to-timezone(datetime,timezone)
		fn:adjust-date-to-timezone(date,timezone)
		fn:adjust-time-to-timezone(time,timezone)
	QNames
		fn:QName()
		fn:local-name-from-QName()
		fn:namespace-uri-from-QName()
		fn:namespace-uri-for-prefix()
		fn:in-scope-prefixes()
		fn:resolve-QName()
	节点
		fn:name()
		fn:name(nodeset)
		fn:local-name(nodeset)
		fn:namespace-uri(nodeset)
		fn:root()
		fn:root(node)
		一般
			fn:index-of((item,item,...),searchitem)
			fn:remove((item,item,...),position)
			fn:empty(item,item,...)
			fn:exists(item,item,...)
			fn:distinct-values((item,item,...),collation)
			fn:insert-before((item,item,...),pos,inserts)
			fn:reverse((item,item,...))
			fn:subsequence((item,item,...),start,len)
			fn:unordered((item,item,...))
		测试序列容量
			fn:zero-or-one(item,item,...)
			fn:one-or-more(item,item,...)
			fn:exactly-one(item,item,...)
		Equals, Union, Intersection and Except 
			fn:deep-equal(param1,param2,collation)
		合计
			fn:count((item,item,...))
			fn:avg((arg,arg,...)) 
			fn:max((arg,arg,...)) 
			fn:min((arg,arg,...))
			fn:sum(arg,arg,...)
		生成序列
			fn:id((string,string,...),node)
			fn:idref((string,string,...),node)
			fn:doc(URI)
			fn:doc-available(URI)
			fn:collection()
			fn:collection(string)
	上下文
		fn:position()
		fn:last()
		fn:current-dateTime()
		fn:current-date()
		fn:current-time()
		fn:implicit-timezone()
		fn:default-collation()
		fn:static-base-uri()