﻿DOM:文档对象模型
三个部分:核心DOM,  XML DOM,  HTML DOM
在Web开发中, 既能使用XML DOM定义的属性和方法, 也能使用HTML DOM扩展的属性和方法

文本总是存储在文本节点中

# XML DOM

XML DOM是用于获取、更改、添加或删除XML元素的标准

创建XML文档对象
	IE: new ActiveXObject("Microsoft.XMLDOM")
	其他: document.implementation.createDocument("","",null)
创建XMLHttpRequest对象
	IE: new ActiveXObject("Microsoft.XMLHTTP")
	其他: new XMLHttpRequest()
加载XML文档
	load("")
从文字加载XML文档
	IE: loadXML()
	其他: parseFromString(txt,"text/xml")

PCDATA : Parsed Character Data(被解析的字符数据)
CDATA : Unparsed Character Data
Firefox以及其他一些浏览器会把空的空白或换行作为文本节点来处理,而IE不会这样
虽然所有的对象均能继承用于处理父节点和子节点的属性和方法,但是并不是所有的对象都拥有父节点或子节点.例如,文本节点不能拥有子节点,所以向类似的节点添加子节点就会导致 DOM 错误

节点类型
	namedConstant 						nodeType 					nodeName 				nodeValue

	ELEMENT_NODE						1(Element)					element name 			null
	ATTRIBUTE_NODE						2(Attr)						attribute name 			attribute value
	TEXT_NODE							3(Text)						#text 					node content
	CDATA_SECTION_NODE				4(CDATASection)			#cdata-section 			node content
	ENTITY_REFERENCE_NODE				5(EntityReference)			entity reference name 	null
	ENTITY_NODE							6(Entity)					entity name 			null
	PROCESSING_INSTRUCTION_NODE		7(ProcessingInstruction)	target 					node content
	COMMENT_NODE						8(Comment)				#comment 				comment text
	DOCUMENT_NODE						9(Document)				#document 			null
	DOCUMENT_TYPE_NODE				10(DocumentType)			doctype name 			null
	DOCUMENT_FRAGMENT_NODE		11(DocumentFragment) 	#document fragment 	null
	NOTATION_NODE						12(Notation)				notation name 			null
CSSRule类型
	类型 							对应接口
	CSSRule.STYLE_RULE			CSSStyleRule
	CSSRule.MEDIA_RULE			CSSMediaRule
	CSSRule.FONT_FACE_RULE		CSSFontFaceRule
	CSSRule.PAGE_RULE			CSSPageRule
	CSSRule.IMPORT_RULE			CSSImportRule
	CSSRule.CHARSET_RULE		CSSCharsetRule
	CSSRule.UNKNOWN_RULE		CSSUnknownRule

对象参考
Node
	baseURI		namespaceURI		localName	prefix		ownerDocument	textContent
	childNodes	firstChild	lastChild	parentNode	previousSibling	nextSibling
	nodeName		nodeType	nodeValue

	appendChild()	cloneNode()	removeChild()	replaceChild()	insertBefore()
	compareDocumentPosition()	getFeature()	getUserData()	setUserData()	normalize()
	hasAttributes()	hasChildNodes()
	isDefaultNamespace()	isEqualNode()	isSameNode()	isSupported()
	lookupNamespaceURI()	lookupPrefix()
CharacterData (Text和Comment节点的超接口)
	data 	length

	appendData()	deleteData()	insertData()	replaceData()	substringData()
Element (继承Node)
	attributes 		tagName

	dispatchEvent()
	getAttribute()	getAttributeNS()	getAttributeNode()	getAttributeNodeNS()
	getElementsByTagName()	getElementsByTagNameNS()
	hasAttribute()	hasAttributeNS()
	removeAttribute()	removeAttributeNS()	removeAttributeNode()
	setAttribute()	setAttributeNS()	setAttributeNode()	setAttributeNodeNS()
Attr (继承Node, 没有父节点, 也不被认为是Element的子节点)
	isId	name	ownerElement	prefix	specified	value
Text (继承Node和CharacterData)
	isElementContentWhitespace 	wholeText

	replaceWholeText() 	splitText()
CDATASection(继承Text)
ProcessingInstr
	data target
Comment(继承Node和CharacterData)
Document
	childNodes	firstChild	lastChild
	nodeName		nodeType	nodeValue
	async	domConfig		doctype	documentElement	documentURI
	implementation	inputEncoding		strictErrorChecking
	xmlEncoding	xmlStandalone	xmlVersion
	styleSheets

	createAttribute()	createAttributeNS()		createCDATASection()		createComment()	createDocumentFragment()	createEvent()	createElement()		createElementNS()		createEntityReference()		createExpression()	createProcessingInstruction()	createRange()		createTextNode()
	getElementById()	getElementsByTagName()	getElementsByTagNameNS()
	adoptNode()	importNode()	renameNode()
	evaluate()	loadXML()	normalizeDocument()
DocumentType
	每个文档均有一个DOCTYPE属性,此属性的值可为null,也可是一个DocumentType对象

	Document.doctype返回一个DocumentType对象
	entities		internalSubset		name	notations	systemId
CSS2Properties
	表示一组 CSS 样式属性及其值
	<HTMLElement>.style是可读可写的CSS2Properties对象,<Window>.getComputedStyle()返回只读的CSS2Properties对象

	cssText
	<所有浏览器支持的CSS属性(连字符->第一字符大写;float->cssFloat)>
CSSRule
	cssText 	parentRule 	parentStyleSheet 	type
CSSStyleRule
	selectorText 	style
CSSStyleSheet (document.styleSheets返回该对象)
	cssRules 	disabled	href	media 	ownerNode
	ownerRule 	parentStyleSheet  	title 	type

	addRule() 	deleteRule() 	inserRule() removeRule()
DOMException
	INDEX_SIZE_ERR
	DOMSTRING_SIZE_ERR
	HIERARCHY_REQUEST_ERR
	WRONG_DOCUMENT_ERR
	INVALID_CHARACTER_ERR
	NO_DATA_ALLOWED_ERR
	NO_MODIFICATION_ALLOWED_ERR
	NOT_FOUND_ERR
	NOT_SUPPORTED_ERR
	INUSE_ATTRIBUTE_ERR
	INVALID_STATE_ERR
	SYNTAX_ERR
	INVALID_MODIFICATION_ERR
	NAMESPACE_ERR
	INVALID_ACCESS_ERR

	当不正当使用DOM属性或方法时,会抛出该对象

	code
RangeException
	BAD_BOUNDARYPOINTERS_ERR
	INVALID_NODE_TYPE_ERR

	code
Implementation
	存放不专属任何特定Document对象,而对DOM实现来说是“全局性”的方法
	document.implementation返回该对象

	createDocument()	createDocumentType()
	getFeature()	hasFeature()
DOMParser
	该对象解析XML并返回一个Document对象

	parseFromString(text, contentType)
Event
	在标准事件模型中,Event对象传递给事件句柄函数,Event 的各种子接口定义了额外的属性
	在IE事件模型中,它被存储在 Window 对象的 event 属性中,只有一种类型的 Event 对象

	标准:bubbles	cancelable	currentTarget	eventPhase	target	timeStamp	type
	IE:cancelBubble	fromElement	keyCode	offsetX	returnValue	srcElement	toElement	x,y

	initEvent()	preventDefault()	stopPropagation()
Range(表示文档的连续范围区域,如用户在浏览器窗口中用鼠标拖动选中的区域)
	START_TO_START	START_TO_END		END_TO_END	END_TO_START

	collapsed	commonAncestorContainer
	startContainer		startOffset
	endContainer		endOffset

	cloneContents()	deleteContents()	extractContents()	surroundContents()
	cloneRange()	collapse()	compareBoundaryPoints()	toString()	detach()
	insertNode()	selectNode()	selectNodeContents()
	setEnd()	setEndAfter()	setEndBefore()
	setStart()	setStartAfter()	setStartBefore()
XMLHttpRequest
	readyState 		//0:Unintialized 1:Open 2:Sent 3:Reciving 4:Loaded
	status 		//200:OK 404:not found
	statusText
	responseText 	responseXML

	open()	send()	abort()
	getResponseHeader()	getAllResponseHeaders()
	setRequestHeader()

	onreadystatechange
XMLSerializer(序列化为未解析的XML标记的一个字符串)
	serializeToString()
XPathExpression
	evaluate()
XPathResult
	ANY_TYPE	NUMBER_TYPE	STRING_TYPE	BOOLEAN_TYPE
	UNORDERED_NODE_ITERATOR_TYPE		ORDERED_NODE_ITERATOR_TYPE
	UNORDERED_NODE_SNAPSHOT_TYPE		ORDERED_NODE_SNAPSHOT_TYPE
	ANY_UNORDERED_NODE_TYPE		FIRST_ORDERED_NODE_TYPE

	booleanValue	numberValue	stringValue	singleNodeValue
	invalidIteratorState		resultType	snapshotLength

	iterateNext() 	snapshotItem()
XSLTProcessor
	clearParameters()	getParameter()	removeParameter()	setParameter()
	transformToDocument()	transformToFragment()
	importStylesheet()	reset()
NodeList
	length

	item()
NamedNodeMap
	length

	item()
	getNamedItem()	getNamedItemNS()
	removeNamedItem()	removeNamedItemNS()
	setNamedItem()	setNamedItemNS()
HTMLDocument (继承Document, 参见 HTML DOM >> Document)
HTMLElement (继承 Element, 参见 HTML DOM >> Element)
HTMLCollection (继承NodeList)
	namedItem()

# HTML DOM

HTML DOM是关于如何获取、修改、添加或删除HTML元素的标准

Document (HTML文档) document.
	all[]	anchors[]	applets[]	forms[]		images[]	links[]

	body	cookie	domain	lastModified	referrer		title	URL

	getElementById()	getElementsByName()	getElementsByTagName()
	open()	close()
	write()	writeIn()
Element (HTML元素)
	nodeType 					//1元素 2属性 3文本 8注释 9文档
	nodeName					//1标签名 2属性名 3#text 9#document
	nodeValue					//1undefined/null  2属性值 3文本本身
	parentNode
	childNodes	firstChild	lastChild
	previousSibling	nextSibling
	clientHeight	clientWidth
	offsetHeight	offsetWidth	offsetLeft	offsetParent	offsetTop
	scrollHeight	scrollLeft	scrollTop	scrollWidth
	innerHTML		attributes	style	className
	accessKey		dir		id 		lang	title
	namespaceURI
	ownerDocument
	tabIndex
	tagName
	textContent

	appendChild()	cloneNode()	insertBefore()
	getAttribute()	getAttributeNode()	getElementsByTagName()	getFeature()	getUserData()
	hasAttribute()	hasAttributes()	hasChildNodes()
	removeAttribute()	removeAttributeNode()		removeChild()	replaceChild()
	setAttribute()	setAttributeNode()	setIdAttribute()	setIdAttributeNode()	setUserData()
	isDefaultNamespace()	isEqualNode()	isSameNode()	isSupported()
	compareDocumentPosition()	normalize()	toString
NodeList (节点列表)
	length

	item()
Attr (HTML属性) attr. 		//DOM 4中, Attr对象不再从Node继承
 	isId 	name 	value 	specified
NamedNodeMap (元素属性节点无序集合) nodemap.
	length
	getNamedItem() 	item() 	removeNamedItem() 	setNamedItem()
Event
	Handlers
		onmousedown 	onmousemove 	onmouseout 	onmouseup
		onclick 	ondblclick		onkeydown 	onkeypress 	onkeyup
		onreset 	onsubmit 		onchange
		onload 	onunload		onabort	onerror
		onblur 		onfocus 		onresize 	onselect
	Mouse/Key
		button 		altKey 		ctrlKey	 	metaKey 	shiftKey
		clientX 	clientY 		screenX 	screenY
		relatedTarget
	DOM2标准属性
		bubbles 	cancelable 	currentTarget 	eventPhase target 	timeStamp 	type
	DOM2标准方法
		initEvent() 	preventDefault() 	stopPropagation()
其他对象未列出