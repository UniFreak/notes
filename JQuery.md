# Concept

It is very important to make the distinction between jQuery object and native DOM elements. Native DOM methods and properties are not present on the jQuery object, and vice versa.

A callback is a function that is passed as an argument to another function and is executed after its parent function has completed

Scripting languages are regarded to be more productive than general languages because they are optimized for their specific domain

jQuery object methods : Methods called on jQuery selections are in the $.fn namespace, and automatically receive and return the selection as `this`

Core jQuery methods : Methods in the $ namespace are generally utility-type methods, and do not work with selections; they are not automatically passed any arguments, and their return value will vary

Use array notation([]) or .get() to get raw DOM element

When using the `:visible` and `:hidden` pseudo-selectors, __except from `<tr>` element__, jQuery looks to see if the element's physical height and width on the page are both greater than zero, not its CSS visibility or display properties. and elements that have not been added to the DOM will always be considered hidden.

Wherever possible, make selections using IDs, class names, and tag names

The best way to determine if there are any elements is to test the selection's .length property

It's best to avoid traversals that go from one container to another.

As a getter, the .css() method is valuable. However, it should generally be avoided as a setter in production-ready code, because it's generally best to keep presentational information out of JavaScript code. Instead, write CSS rules for classes that describe the various visual states, and then change the class on the element.

Setters affect all elements in a selection. Getters get the requested value only for the first element(except .text()) in the selection; Setters return a jQuery object, allowing you to continue calling jQuery methods on your selection. Getters return whatever they were asked to get, so you can't continue to call jQuery methods on the value returned by the getter.

As of jQuery  1.7, all events are bound via the `on` method, whether you call it directly or whether you use an alias/shortcut method such as `bind` or `click`, which are mapped to the `on` method internally. With this in mind, __it's beneficial to use the `on` method__ because the others are all just syntactic sugar, and utilizing the `on` method is going to result in faster and more consistent code.

Event delegation refers to the process of using event propagation (bubbling) to handle events at a higher level in the DOM than the element on which the event originated. It allows us to attach a single event listener for elements that exist now or in the future. The two main pros of event delegation over binding directly to an element (or set of elements) are performance and the aforementioned event bubbling. Imagine having a large table of 1,000 cells and binding to an event for each cell. We could instead use delegation to listen for events that occur on the parent table and react accordingly.

When utilizing both .preventDefault() and .stopPropagation() simultaneously, you can instead return false to achieve both in a more concise manner, but it's advisable to only return false when both are actually necessary and not just for the sake of terseness. A final note on .stopPropagation() is that when using it in delegated events, the soonest that event bubbling can be stopped is when the event reaches the element that is delegating it.

The event object contains a property called `originalEvent`, which is the event object that the browser itself created.

Event can be a native event defined by the W3C and fired by the browser in response to something such as a user clicking a mouse button or pressing a key. It can also be a custom event, triggered only by code via jQuery's .trigger() or .triggerHandler() methods. Code can also trigger native browser events, which is convenient for simulating user actions.

The `.trigger()` function cannot be used to mimic native browser events, such as clicking on a file input box or an anchor tag. This is because, there is no event handler attached using jQuery's event system that corresponds to these events.  In order to trigger a native browser event, you have to use document.createEventObject for < IE9 and document.createEvent for all other browsers. Don't use `.trigger()` simply to execute specific functions

Whenever possible, you should use classes combined with CSS rules to affect the presentation of elements, and use jQuery only to add and remove those classes

jQuery will not prevent you from cloning(using .clone()) an element with an ID, but you should ensure that you change or remove the cloned element's id attribute before inserting it into the document

The .remove() method should be used to remove elements permanently, as it will also unbind any event handlers attached to the elements(like .replaceWith()) being removed. The .remove() method returns a reference to the removed elements, but if you re-add the removed elements, the removed elements will no longer have events bound to them

If you are going to make a lot of changes to your page's structure using jQuery, it will be more efficient to use .detach() to remove the affected elements, make your changes, and then re-attach the element using one of the insertion methods. Elements removed with .detach() will retain their event handlers

Under the hood, all of the shorthand methods make use of jQuery's .on() method.

When you .trigger() an event, you only trigger event handlers that were bound with JavaScript — you don't trigger the default behavior of the event. For example, if you trigger the click event of an a element, it will not automatically navigate to the href of that element

Except from .trigger(), If the event you want to trigger has a shorthand method (see the table above), you can also trigger the event by simply calling the shorthand method

You can use "namespaced" events when using .on() and .trigger(), like this:
    $( 'li' ).on( 'click.logging', function(){} )
    $( 'li' ).trigger( 'click.logging' )
You can also bind multiple events(seperated with space) at once when using .on()

Whenever an event is triggered, the event handler function receives one argument, an event object that is normalized across browsers

Often, you'll want to prevent the default action of an event; for example, you may want to handle a click on an a element using AJAX, rather than triggering a full page reload. Many developers achieve this by having the event handler return false, but this actually has another side effect: it stops the propagation of the event as well, which can have unintended consequences. The right way to prevent the default behavior of an event is to call the .preventDefault() method of the event object.

Event delegation — binding handlers to high-level elements, and then detecting which low-level element initiated the event. Event delegation has two main benefits. First, it allows us to bind fewer event handlers than we'd have to bind if we were listening to clicks on individual elements, which can be a big performance gain. Second, it allows us to bind to parent elements — such as an unordered list — and know that our event handlers will fire as expected even if the contents of that parent element change.

For security reasons, XHRs to other domains are blocked by the browser. However, certain third-party APIs provide a response formatted as JSONP

$.ajax() (and related convenience methods) returns a jqXHR object — a jQuery XML HTTP Request — which has a host of powerful methods. The jqXHR object is simply a special flavor of a "deferred"

Deferreds provide a means to react to the eventual success or failure of an asynchronous operation, and reduce the need for deeply nested callbacks
# Reference( 1.7 )

## 核心
jQuery 核心函数
    jQuery([sel,[context]])
    jQuery(html,[ownerDoc])
    jQuery(callback)
    jQuery.holdReady(hold) 1.6+
jQuery 对象访问
    each(callback)
    size()
    length
    selector
    context
    get([index])
    index([selector|element])
数据缓存
    data([key],[value])
    removeData([name|list]) 1.7*
    $.data(element,[key],[value])
队列控制
    queue(element,[queueName])
    dequeue([queueName])
    clearQueue([queueName])
插件机制
    jQuery.fn.extend(object)
    jQuery.extend(object)
多库共存
    jQuery.noConflict([ex])
## 属性
属性
    attr(name|pro|key,val|fn)
    removeAttr(name)
    prop(name|pro|key,val|fn) 1.6+
    removeProp(name) 1.6+
CSS 类
    addClass(class|fn)
    removeClass([class|fn])
    toggleClass(class|fn[,sw])
HTML代码/文本/值
    html([val|fn])
    text([val|fn])
    val([val|fn|arr])
## CSS
CSS
    css(name|pro|[,val|fn])
位置
    offset([coordinates])
    position()
    scrollTop([val])
    scrollLeft([val])
尺寸
    heigh([val|fn])
    width([val|fn])
    innerHeight()
    innerWidth()
    outerHeight([soptions])
    outerWidth([options])
## 选择器
基本
    #id
    element
    .class
    *
    selector1,selector2,selectorN
层级
    ancestor descendant
    parent > child
    prev + next
    prev ~ siblings
基本
    :first
    :last
    :not(selector)
    :even
    :odd
    :eq(index)
    :gt(index)
    :lt(index)
    :header
    :animated
    :focus 1.6+
内容
    :contains(text)
    :empty
    :has(selector)
    :parent
可见性
    :hidden
    :visible
属性
    [attribute]
    [attribute=value]
    [attribute!=value]
    [attribute^=value]
    [attribute$=value]
    [attribute*=value]
    [attrSel1][attrSel2][attrSelN]
子元素
    :nth-child
    :first-child
    :last-child
    :only-child
input
    :表单
    :text
    :password
    :radio
    :checkbox
    :submit
    :image
    :reset
    :button
    :file
    :hidden
表单对象属性
    :enabled
    :disabled
    :checked
    :selected
## 文档处理
内部插入
    append(content|fn)
    appendTo(content)
    prepend(content|fn)
    prependTo(content)
外部插入
    after(content|fn)
    before(content|fn)
    insertAfter(content)
    insertBefore(content)
包裹
    wrap(html|ele|fn)
    unwrap()
    wrapall(html|ele)
    wrapInner(html|ele|fn)
替换
    replaceWith(content|fn)
    replaceAll(selector)
删除
    empty()
    remove([expr])
    detach([expr])
复制
    clone([Even[,deepEven]])
## 筛选
过滤
    eq(index|-index)
    first()
    last()
    hasClass(class)
    filter(expr|obj|ele|fn)
    is(expr|obj|ele|fn) 1.6*
    map(callback)
    has(expr|ele)
    not(expr|ele|fn)
    slice(start,[end])
查找
    children([expr])
    closest(expr,[con]|obj|ele) 1.6*
    find(expr|obj|ele) 1.6*
    next([expr])
    nextall([expr])
    nextUntil([exp|ele][,fil]) 1.6*
    offsetParent()
    parent([expr])
    parents([expr])
    parentsUntil([exp|ele][,fil]) 1.6*
    prev([expr])
    prevall([expr])
    prevUntil([exp|ele][,fil]) 1.6*
    siblings([expr])
串联
    add(expr|ele|html|obj[,con])
    andSelf()
    contents()
    end()
## 事件

页面载入
    ready(fn)
事件处理
    on(eve,[sel],[data],fn) 1.7+
    off(eve,[sel],[fn]) 1.7+
    bind(type,[data],fn)
    one(type,[data],fn)
    trigger(type,[data])
    triggerHandler(type, [data])
    unbind(type,[data|fn])
事件委派
    live(type,[data],fn)
    die(type,[fn])
    delegate(sel,[type],[data],fn)
    undelegate([sel,[type],fn])  1.6*
事件切换
    hover([over,]out)
    toggle(fn, fn2, [fn3, fn4, ...])
事件
    blur([[data],fn])
    change([[data],fn])
    click([[data],fn])
    dblclick([[data],fn])
    error([[data],fn])
    focus([[data],fn])
    focusin([data],fn)
    focusout([data],fn)
    keydown([[data],fn])
    keypress([[data],fn])
    keyup([[data],fn])
    mousedown([[data],fn])
    mouseenter([[data],fn])
    mouseleave([[data],fn])
    mousemove([[data],fn])
    mouseout([[data],fn])
    mouseover([[data],fn])
    mouseup([[data],fn])
    resize([[data],fn])
    scroll([[data],fn])
    select([[data],fn])
    submit([[data],fn])
    unload([[data],fn])
## 效果
基本
    show([speed,[easing],[fn]])
    hide([speed,[easing],[fn]])
    toggle([speed],[easing],[fn])
滑动
    slideDown([spe],[eas],[fn])
    slideUp([speed,[easing],[fn]])
    slideToggle([speed],[easing],[fn])
淡入淡出
    fadeIn([speed],[eas],[fn])
    fadeOut([speed],[eas],[fn])
    fadeTo([[spe],opa,[eas],[fn]])
    fadeToggle([speed,[eas],[fn]])
自定义
    animate(param,[spe],[e],[fn])
    stop([cle],[jum]) 1.7*
    delay(duration,[queueName])
设置
    jQuery.fx.off
    jQuery.fx.interval
## ajax
ajax 请求
    $.ajax(url,[settings])
    load(url,[data],[callback])
    $.get(url,[data],[fn],[type])
    $.getJSON(url,[data],[fn])
    $.getScript(url,[callback])
    $.post(url,[data],[fn],[type])
ajax 事件
    ajaxComplete(callback)
    ajaxError(callback)
    ajaxSend(callback)
    ajaxStart(callback)
    ajaxStop(callback)
    ajaxSuccess(callback)
其它
    $.ajaxSetup([options])
    serialize()
    serializearray()
## 工具
浏览器及特性检测
    $.support
    $.browser
    $.browser.version
    $.boxModel
数组和对象操作
    $.each(object,[callback])
    $.extend([d],tgt,obj1,[objN])
    $.grep(array,fn,[invert])
    $.sub()
    $.when(deferreds)
    $.makearray(obj)
    $.map(arr|obj,callback) 1.6*
    $.inarray(val,arr,[from])
    $.toarray()
    $.merge(first,second)
    $.unique(array)
    $.parseJSON(json)
函数操作
    $.noop
    $.proxy(function,context)
测试操作
    $.contains(container,contained)
    $.type(obj)
    $.isarray(obj)
    $.isFunction(obj)
    $.isEmptyObject(obj)
    $.isPlainObject(obj)
    $.isWindow(obj)
    $.isNumeric(value) 1.7+
字符串操作
    $.trim(str)
URL
    $.param(obj,[traditional])
插件编写
    $.error(message)
## Deferred
def.done(donCal,[donCal])
def.fail(failCallbacks)
def.isRejected()
def.isResolved()
def.reject(args)
def.rejectWith(context,[args])
def.resolve(args)
def.resolveWith(context,[args])
def.then(doneCal,failCals) 1.7*
def.promise([type],[target]) 1.6+
def.pipe([donl],[fai],[pro]) 1.7*
def.always(alwCal,[alwCal]) 1.6+
def.notify(args) 1.7+
def.notifyWith(con,[args]) 1.7+
def.progress(proCal) 1.7+
def.state() 1.7+
## Callbacks
cal.add(callbacks) 1.7+
cal.disable() 1.7+
cal.empty() 1.7+
cal.fire(arguments) 1.7+
cal.fired() 1.7+
cal.fireWith([context] [, args]) 1.7+
cal.has(callback) 1.7+
cal.lock() 1.7+
cal.locked() 1.7+
cal.remove(callbacks) 1.7+
$.callbacks(flags) 1.7+

# Notes

You need jQuery UI to animate colors, you can get around this by using css transition
while you are appending a content using jquery it must not contains new line