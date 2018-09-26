XML 被设计用来传输和存储数据, HTML 被设计用来显示数据

第一行是 XML 声明, 下一行是 XML 根元素
所有 XML 元素都须有关闭标签, 且大小写敏感
声明不属于 XML 本身的组成部分, 它不是 XML 元素, 也不需要关闭标签
XML 文档必须包含根元素
XML 的属性值必须加引号
尽量使用元素来描述数据, 而仅仅使用属性来提供与数据无关的信息(比如元数据)
<!-- 注释 -->
<![CDATA[
	CDATA (Unparsed Character Data) 不会被 xml 解析器解析
]]>

声明
	<?xml version="1.0" encoding="UTF-8"?>
加载 CSS 样式
	<?xml-stylesheet type="text/css" href="sample.css"?>
加载 XSLT 样式
	<?xml-stylesheet type="text/xsl" href="sample.xsl"?>

解决命名冲突
	使用前缀
		如: 	<h:table></h:table> 和 <f:table></f:table>
	使用命名空间
		如: 	<h:table xmlns:h="http://www.w3.org/TR/html4/"> 和
			<f:table xmlns:f="http://www.w3school.com.cn/furniture">

相关技术
	XHTML 		更严格更纯净的基于 XML 的 HTML 版本
	XML DOM 		访问和操作 XML 的标准文档模型
	XSL
		XSLT 		把 XML 转换为其他格式, 比如 HTML 
		XSL-FO 	用于格式化 XML 文档的语言 
		XPath 		用于在 XML 文档中导航的语言 
	XQuery 		基于 XML 的用于查询 XML 数据的语言 
	DTD 			用于定义 XML 文档中的合法元素的标准 
	XSD 			XML Schema, 基于 XML 的 DTD 替代物
	XLink 			在 XML 文档中创建超级链接的语言
	XPointer 		允许 XLink 超级链接指向 XML 文档中更多具体的部分
	XForms 		使用 XML 定义表单数据
	SOAP 			允许应用程序在 HTTP 之上交换信息的基于 XML 的协议
	WSDL 			用于描述网络服务的基于 XML 的语言
	RDF 			用于描述网络资源的基于 XML 的语言
	RSS 			聚合新闻以及类新闻站点内容的格式
	WAP 			用于在无线设备上 (比如移动电话) 显示内容的一种基于 XML 的语言
	SMIL 			描述视听呈现的语言
	SVG 			使用 XML 格式定义图形