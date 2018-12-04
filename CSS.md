# Guideline
- remember, there is browser default style exist
- understanding the structure of HTML is crucial to write efficient CSS
- avoid embeded style when possible
- avoid * selector and !important declaration when possible
- don't use inline style
- if you find yourself writing descendant selectors with three or more selector,  revising your strategy
- put a color pallete at top of your stylesheet
- let the normal document flow do the majority layout
- know how to write *efficient* CSS
    + use meaningful id and class
    + use consistent HTML structure
    + use embeded style mainly to overwrite external style, don't use inline style
    + use inheritance instead writing same rule for every element

# Best Practice
- Create HTML first
- Dont use style property when naming ID%Class ,like 'left' or 'right'
    If you must return to your HTML to change the presentation (or styling) of the - page, you're doing it wrong
- Use a reset css
- 顺序:位置>大小>文字>背景>其他
- 使用缩写
- 去掉小数点前的"0"
- 不建议用"_"
- 不要随意使用ID
- 注释
- Compress your code
- Don't just wrap a DIV around it
- Hack less
- Avoid extra selectors
- OOCSS
- Use validator
- Name classes/IDs based on function, not appearance
Build and test your CSS in the most advanced browser available before testing in - others, not after
- Remember “LoVe/HAte” linking
- When in doubt, validate

# Concepts
- reference: external, embeded,inline
- /* comment */
- browser read CSS selector from right to left
- wherever the CSS rule is found, the last founded always win
- when style rules conflict:
    + cascade: the last founded rule win. so if you put your external css link after embeded style, your external css link will win
    + inheritance: child rules accumulate parent's
    + selector specificity: bigger win. id: 100, class: 10, element: 1
    + `!important`: it always win
- browser rendering engine
    + Trident IE
    + Presto Opera
    + Gecko Firefox
    + WebKit Chrome, Safari
- general font family: serif sans-serif monospace cursive fantasy
- unit
    + absolute: in, cm, mm, pt,  pc
    + relative: 
        * em: when using em to define font-size, it's relative to parent's font-size. when using em to define other non-font-size, it's relative to self font-size
        * ex:  based on the 'x-height' of a font
        * px:  pixel
        * gd
        * rem root em, relative to the root unit(body, html)'s font size
        * vw
        * vh
        * vm
        * ch
        * %   relative to parent
- Box model
    - containing block = content block + margin
    - content block = left border + left padding + width + padding + right border
    - background expand to border(so padding is included)
    - if element over-constrain, self's margin and container's padding will sacrifice until overflow happen(over-constrain mean the block too large to fit in the outter element)
    - if a property is not declared, don't assume the value is 0
    - elements often  have default margins that you need to account for
    - whenever two vertical margin *touch*, they collapse to the bigger margin(so can set border or padding to prevent them from touch so that they dont collapse)
- Position
    + normal: the normal document flow
    + position: static
    + position: relative. element can now move *relatively to its own normal document position*, 
            other elements still think it's in its normal document position
    + floating: 
        elements are removed(above) from normal document flow, move left or right as far it as can
        although normal elements don't see floating elements when positioning, but their text do see and will wrap themself around floating elements
        float will cause container collapse and column collapse
            - solve container collapse
                1. add a element with `clear: both` at the bottom in the container
                2. set container `overflow: hidden`
                3. float container as well
                4. use clearfix technique
                    .clearfix:before, .clearfix:after {
                        content: '';
                        display: table;
                    }
                    .clearfix:after {
                        clear: both;
                    }
                    /* For IE 6/7 (trigger hasLayout) */
                    .clearfix {
                      zoom:1;
                    }
    absolute
        removed from(above) normal document flow
        other elements don't think it exists
        can be clipped(using clip property)

        position: absolute
            element can now move *relatively to its nearest _posistioned_ container or document root*
        position: fixed
            element can now move *relatively to the viewport*

    z-index and stacking order(bottom to top)
        1. the background and borders of the element forming the stacking context
        2. any child stacked elements with a negative z-index
        3. elements in normal flow
        4. non-positioned floats
        5. any child stacked elements with a z-index of zero auto
        6. any child stacked elements with a positive z-index value, lowest to highest
Layout
    Fixed
    Fluid
        when calculating percentage of content width, you calculate with container's total width
        when calculating percentage of margin and padding, you calculate with container's content width
        to make asset(image, video) fluid:
            - set a percentage width
    Responsive
        by using meta viewport and media query
Vendor prefix
    -ms-        Microsoft
    -moz-       Mozilla
    -o-         Opera
    -khtml-     Konqueror
    -webkit-    WebKit
Browser inconsistency
    Avoid hacks whenever possible
    Try to avoid conditions that trigger the browser error
    To do that, you have to be familiar with rendering error and what trigger them(www.positioniseverything.net)
    Place all IE-specific code in a seperate style sheet
    Serve these IE-specific code through conditional comments
选择器
    .class                      类
    #id                         id
    *                           通配符

    [attribute]                 属性
    [attribute=value]           属性值等于
    [attribute~=value]          属性值包含,针对用多个空格分隔的属性
    [attribute|=value]          属性值包含,针对用多个连字号分隔的属性,如lang
    [attribute*=value]          属性值包含
    [attribute^=value]          属性值以value开头
    [attribute$=value]          属性值以value结束

    element                     标签
    element,element             组
    element element             后代
    element>element             子
    element+element             相邻兄弟
    element1~element2           前有element1的所有同级element2

    :link                       链接到一个 url(而不是自身) 的 a 元素
    :visited
    :hover
    :active
    :target                     被激活的链接到自身的 a 元素
    顺序有影响, 记忆诀窍: love(link, visited) hate(hover active)

    :first-of-type
    :last-of-type
    :only-of-type
    :nth-of-type(n)

    :first-child
    :last-child
    :only-child
    :nth-child(n)
    :nth-last-child(n)

    :first-line
    :first-letter
    :before
    :after

    :root
    :empty

    :focus
    :enabled
    :disabled
    :checked

    :not(selector)
    ::selection                     被用户选取
属性
    CSS2
        Box
            border
                border-color
                border-style
                border-width

                border-bottom
                    border-bottom-color
                    border-bottom-style
                    border-bottom-width
                border-left
                    border-left-color
                    border-left-style
                    border-left-width
                border-right
                    border-right-color
                    border-right-style
                    border-right-width
                border-top
                    border-top-color
                    border-top-style
                    border-top-width
            padding
                padding-bottom
                padding-left
                padding-right
                padding-top
            margin
                margin-bottom
                margin-left
                margin-right
                margin-top
            outline
                outline-color
                outline-style
                outline-width
            height
            min-height
            max-height
            width
            min-width
            max-width
            border:5px solid red;
        Position
            display
            visibility
            position
            z-index
            float
            overflow
            clear
            clip
            cursor
            vertical-align
            top
            right
            bottom
            left
        Background
            background
                background-color
                background-image
                background-repeat
                background-attachment
                background-position
                    * how percentage value like '25% 50%' work:
                        1. find the point at 25% 50% of the background image
                        2. find the point at 25% 50% of the container element
                        3. move the point in the image to overlay on the point in the container element
            background: #f00 url("i/1.jpg") no-repeat fixed center;
        Font
            font
                font-family
                font-size
                    available keywords value: xx-large xx-small x-large x-small large small medium
                font-size-adjust
                font-stretch
                font-style
                font-variant
                font-weight
            font:italic bold 12px/30px arial,sans-serif;
        Text
            color
            direction
            letter-spacing
            line-height
            text-align
            text-decoration
            text-indent
            text-shadow
            text-transform
            unicode-bidi
            white-space
            word-spacing
        List
            list-style
                list-style-image
                list-style-position
                list-style-type:[none|disc|circle|square|decimal|decimal-leading-zero|lower-roman
                                |upper-roman|lower-alpha|upper-alpha|lower-greek|lower-latin
                                |upper-latin|hebrew|armenian|georgian|cjk-ideographic|hiragana
                                |katakana|hiragana-iroha|katakana-iroha]
            list-style:square inside url("i/2.jpg");
        Table
            border-collapse
            border-spacing
            caption-side
            empty-cells
            table-layout

        Content Generation
            content
            counter-increment
            counter-reset
            quotes
    CSS3
        User-Interface
            appearance
            box-sizing
            icon
            nav-down
            nav-index
            nav-left
            nav-right
            nav-up
            outline-offset
            resize
        Box
            border-image
                border-image-outset
                border-image-repeat
                border-image-slice
                border-image-source
                border-image-width
            border-radius
                border-bottom-left-radius
                border-bottom-right-radius
                border-top-left-radius
                border-top-right-radius
                *you can use value like 30px/20px
            box-shadow
            box-decoration-break
            overflow-x
            overflow-y
            overflow-style
            rotation
            rotation-point
        Color
            color-profile
            opacity
            rendering-intent
        Background
            background-clip
            background-origin
            background-size
        Flexible Box
            box-align
            box-direction
            box-flex
            box-flex-group
            box-lines
            box-ordinal-group
            box-orient
            box-pack
        Grid
            grid-columns
            grid-rows
        Column
            columns
                column-count
                column-width
            column-fill
            column-gap
            column-rule
            column-rule-color
            column-rule-style
            column-rule-width
            column-span
        Text
            hanging-punctuation
            punctuation-trim
            text-align-last
            text-emphasis
            text-justify
            text-outline
            text-overflow
            text-shadow
            text-wrap
            word-break
            word-wrap
        Hyperlink
            target
                target-name
                target-new
                target-position
        Animation
            @keyframes
            animation
                animation-name
                animation-duration
                animation-timing-function
                animation-delay
                animation-iteration-count
                animation-direction
                animation-fill-mode
            animation-play-state
        Transform
            transform
            transform-origin
            transform-style
            perspective
            perspective-origin
            backface-visibility
        Transition
            transition
                transition-property
                transition-duration
                transition-timing-function
                transition-delay
    Vendor-specific
        IE
            zoom
            filter
            behavior
@-Rules
    @charset "encoding"
    @import {<URI|String>} [<media type>, ...]
    @media <media type>, ... {  }
        <media type>: all braille embossed handheld print projection screen speech tty tv
    @page
    @font-face {
        font-family:
        src:
        font-weight:
        font-style:
    }
    @namespace [prefix] URI
Media query
    syntax
        [not | only] <mediaType> [and (<filter>)] [and (<filter>)] ...
        <mediaType>: all braille embossed handheld print projection screen speech tty tv
        <filter>:
            (max|min)
                color color-index
                device-aspect-ratio
                device-height device-width
                grid scan
                height width
                monochrome
                resolution orientation
    可用地方
        @media
            @media only screen and (max-device-width:480px) { }
        @import
            @import url("screen.css") screen;
        link tag
            <link rel="stylesheet" type="text/css" href="viewable.css" media="screen, projection">
flex layout:
    attribute and value
        for flex  container
            display: flex | inline-flex
            flex-direction:row | row-reverse | column | column-reverse
            flex-wrap: nowrap | wrap | wrap-reverse
            flex-flow: <'flex-direction'> || <'flex-wrap'>
            justify-content: flex-start | flex-end | center | space-between | space-around
            align-items: flex-start | flex-end | center | stretch | baseline
            align-content: flex-start | flex-end | flex-center | space-between | space-around | stretch
        for flex items
            order: <integer>
            flex-grow: <number>
            flex-shrink: <number>
            flex-basis: <length> | auto
            flex: none | [<'flex-grow'><'flex-shrink'>? || <'flex-basis'>]
            align-self: auto | flex-start | flex-end | center | baseline | stretch
    note
        float, clear,verticle-align have no effect on a flex item
CSS Trick
    equal column height: http://vanseodesign.com/css/equal-height-columns/
    居中
        行内元素（文本、图片）: text-align:center
        块级元素：margin:0 auto;
            唯一的问题是，当浏览器窗口比元素的宽度还要窄时，浏览器会显示一个水平滚动条来容纳页面
            在这种情况下使用 max-width 替代 width 可以使浏览器更好地处理小窗口的情况
Compatibility Hack
    1.CSS属性前缀法
        - + * _ # \0 \9\0 !important
        -       IE6
        \9      IE6/IE7/IE8/IE9/IE10
        \0          IE8/IE9/IE10
        \9\0    IE9/IE10
    2.选择器前缀法
        *       IE6
        *+      IE7
    3.IE条件注释法
        <!--[if gte/lte/gt/lt/! IE] versonNum> ... <![endif]-->
命名范例
    ID:
    header      content/container   footer  nav     sidebar     column  wrapper     left/right/center   breadCrumb
    loginbar    logo    banner      main    hot         news    download    subnav      menu
    submenu     search  friendlink  footer  copyright           scroll      content     tags    list
    msg         tips    title       joinus  guide   service         register    status      vote    partner
    文件:
    master      module  base    layout  themes  columns font    forms   mend    print
总结
    1.如果让z-index生效, 必须设置position属性
    3.p不能包含列表, 用div代替
    4.text-overflow:ellipsis只作用于单行文本,起作用的条件:
        overflow: hidden;
        width: <number> | max-width: <number>;
    5.更改下拉列表图标(让select的width大于父元素,父元素overflow:hidden)
        .customselect {
            width: 80px;
            overflow: hidden;
           border:1px solid;
           background: url("images/downArrow.png") no-repeat right;
        }
        .customselect select {
           width: 100px;
           border:none;
          -moz-appearance: none;
           -webkit-appearance: none;
           appearance: none;
        }
    6.IE7 display:inline-block hack
        *display: inline;     /* for IE7*/
        zoom:1;              /* for IE7*/
    7.One of the main uses for zoom has been to ensure that an element has a layout
    8.IE6 only support :hover on <a>
    9.把 display 设置成 none 不会保留元素本该显示的空间，但是 `visibility:hidden` 会