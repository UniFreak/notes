概述
    SVG:Scalable Vector Graphics
    SVG 是使用 XML 来描述二维图形和绘图程序的语言
    SVG 图像中的文本是可选的, 同时也是可搜索的, 很适合制作地图
    通过 <embed> <object> 或 <iframe> 把 SVG 嵌入 HTML
    由于绘制路径的复杂性, 因此强烈建议您使用 SVG 编辑器来创建复杂的图形
文档标签结构
    <?xml version="1.0" standalone="no"?>

    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
    "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

    <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <!-- 滤镜和渐变(线性, 放射)必须在 defs 内定义 --/>
        <defs>
            <filter></filter>
            <linearGradient>
                <stop/>
            </linearGradient>
            <radialGradient>
                <stop/>
            </radialGradient>
        </defs>

        <!-- 预定义形状 --/>
        <rect/>
        <circle/>
        <ellipse/>
        <line/>
        <polyline/>
        <polygon/>
        <path/>
    </svg>
属性
    id
    style
    width 	heigth

    x   y   rx  ry
    r   cx  cy
    x1  y1  x2  y2
    point
    d   定义 path 中的路径命令

    opacity
    stroke
    stroke-width
    stroke-opacity
    fill
    fill-opacity
    stop-color
    stop-opacity
    offset
    filter:url()
路径命令(大写表示绝对定位，小写表示相对定位)
    M:	moveto
    L:	lineto
    H:	horizontal lineto
    V:	vertical lineto
    C:	curveto
    S:	smooth curveto
    Q:	quadratic Belzier curve
    T:	smooth quadratic Belzier curveto
    A:	elliptical Arc
    Z:	closepath
滤镜/渐变
    feBlend
    feColorMatrix
    feComponentTransfer
    feComposite
    feConvolveMatrix
    feDiffuseLighting
    feDisplacementMap
    feFlood
    feGaussianBlur
    feImage
    feMerge
    feMorphology
    feOffset
    feSpecularLighting
    feTile
    feTurbulence
    feDistantLight
    fePointLight
    feSpotLight

    linearGradient
    radialGradient
元素参考
    a                   定义超链接
    altGlyph            允许对象性文字进行控制，来呈现特殊的字符数据（例如，音乐符号或亚洲的文字）
    altGlyphDef         定义一系列象性符号的替换（例如，音乐符号或者亚洲文字）
    altGlyphItem        定义一系列候选的象性符号的替换
    animate             随时间动态改变属性
    animateColor        规定随时间进行的颜色转换
    animateMotion       使元素沿着动作路径移动
    animateTransform    对元素进行动态的属性转换
    circle              定义圆
    clipPath
    color-profile       规定颜色配置描述
    cursor              定义独立于平台的光标
    definition          src 定义单独的字体定义源
    defs                被引用元素的容器
    desc                对 SVG 中的元素的纯文本描述 - 并不作为图形的一部分来显示 用户代理会将其显示为工具提示
    ellipse             定义椭圆
    feBlend             SVG 滤镜, 使用不同的混合模式把两个对象合成在一起
    feColorMatrix       SVG 滤镜, 应用matrix转换
    feComponentTransfer SVG 滤镜, 执行数据的 component-wise 重映射
    feComposite         SVG 滤镜,
    feConvolveMatrix    SVG 滤镜,
    feDiffuseLighting   SVG 滤镜,
    feDisplacementMap   SVG 滤镜,
    feDistantLight      SVG 滤镜,  Defines a light source
    feFlood             SVG 滤镜,
    feFuncA             SVG 滤镜, feComponentTransfer 的子元素
    feFuncB             SVG 滤镜, feComponentTransfer 的子元素
    feFuncG             SVG 滤镜, feComponentTransfer 的子元素
    feFuncR             SVG 滤镜, feComponentTransfer 的子元素
    feGaussianBlur      SVG 滤镜, 对图像执行高斯模糊
    feImage             SVG 滤镜,
    feMerge             SVG 滤镜, 创建累积而上的图像
    feMergeNode         SVG 滤镜, feMerge的子元素
    feMorphology        SVG 滤镜,  对源图形执行"fattening" 或者 "thinning"
    feOffset            SVG 滤镜, 相对与图形的当前位置来移动图像
    fePointLight        SVG 滤镜,
    feSpecularLighting  SVG 滤镜,
    feSpotLight         SVG 滤镜,
    feTile              SVG 滤镜,
    feTurbulence        SVG 滤镜,
    filter              滤镜效果的容器
    font                定义字体
    font-face           描述某字体的特点
    font-face-format
    font-face-name
    font-face-src
    font-face-uri
    foreignObject
    g                   用于把相关元素进行组合的容器元素
    glyph               为给定的象形符号定义图形
    glyphRef            定义要使用的可能的象形符号
    hkern
    image
    line                定义线条
    linearGradient      定义线性渐变
    marker
    mask
    metadata            规定元数据
    missing-glyph
    mpath
    path                定义路径
    pattern
    polygon             定义由一系列连接的直线组成的封闭形状
    polyline            定义一系列连接的直线
    radialGradient      定义放射形的渐变
    rect                定义矩形
    script              脚本容器 （例如ECMAScript）
    set                 为指定持续时间的属性设置值
    stop
    style               可使样式表直接嵌入SVG内容内部
    svg                 定义SVG文档片断
    switch
    symbol
    text
    textPath
    title               对 SVG 中的元素的纯文本描述 - 并不作为图形的一部分来显示 用户代理会将其显示为工具提示
    tref
    tspan
    use
    view
    vkern