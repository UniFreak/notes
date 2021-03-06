when talking about html5, here we mean html5 new tags, css3 properties and new javascript APIs, basically, cool new web stuff

# GUIDELINE:
avoid id as possible as you can
use div only if there is not better suitable tag available
section or div?
    the contents is thematically related(typically have a header)? --> use section
    you wanna wrap is for targetting style? --> use div
carefully create your document outline using sectioning tag and heading tag

# SIMPLIFIED:
simplified many tag's attributes, like:
    <!DOCTYPE html>
    <style></style>
no ending / required for self-closing tag
attribute's value does *not* required to be quoted
most closing tag, or even wrapping tag like <head> is not required, modern browser is smart enough to add it by itself(but I don't think )

# DOC STRUCTURE

    <!doctype html>
    <html>
    <head lang="en">
        <meta charset="utf-8"/>
        <title></title>
    </head>
    <body>
    </body>
    </html>

# CONTENT MODEL
Metadata content
    base command link meta noscript script style title
Flow content
    a abbr address article aside audio b bdi bdo blockquote br button canvas cite code command
    datalist del details dfn div dl em embed fieldset figure footer form h1 h2 h3 h4 h5 h6 header
    hr i iframe img input ins kbd keygen label map mark math menu meter nav noscript object
    ol output p pre progress q ruby s samp script section select small span strong sub sup svg
    table textarea time u ul var video wbr text
    area(if it is a descendant of a map element)
    style(if the scoped attribute is present)
Sectioning content
    article aside nav section
Heading content
    h1 h2 h3 h4 h5 h6
Phrasing content
    abbr audio b bdi bdo br button canvas cite code command datalist dfn em embed i iframe img
    input kbd keygen label mark math meter noscript object output progress q ruby s samp script
    select small span strong sub sup svg textarea time u var video wbr text
    a del ins map(if it contain only phrasing content)
Embedded content
    audio canvas embed iframe img math object svg video
Interactive content
    a button details embed iframe keygen label select textarea
    audio video(if the control attributes is present)
    img object(if the usemap attribute is present)
    input(if the type attribute is not in the hidden state)
    menu(if the type attribute is in the toolbar state)
    area(if it is a descendant of a map element)

# SECTIONING ROOT

have their own outline, but do not contribute to the outlines of their ancestors
blockquote body fieldset figure td

# HTML5 Shim

    <<!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

# COMPATIBILITY
FEATURE DETECTION
    manually:

        <script>
            if (!!'placeholder' in document.createElement('input')) {
                // support placeholder attribute in input tag
            }

            var i = document.createElement('input');
            i.setAttribute('type', 'email');
            if (i.type === 'email') {
                // support email type input
            }

            if (!!document.createElement('canvas').getContext) {
                // support canvas
            }

            if (!!document.createElement('video').canPlayType) {
                // support video
            }

            if (!!document.createElement('audio').canPlayType) {
                // support video
            }

            try { // put in try block to avoid err
                if ('localStorage' in window && window.localStorage !== null) {
                    // support local storage
                }
            } catch (e) {
                // don't support local storage
            }

            if (!!navigator.geolocation) {
                // support geolocation
            }
        </script>

    use Modernizr: modernizr.com

# POLYFILL

    https://github.com/Modernizr/Modernizr/wiki/HTML5-Cross-browser-Polyfills
    use modernizr-load to load script asynchronously

# API

history
    .pushState()
    .popState()
localStorage
    .setItem()
    .getItem()
    .removeItem()
    .clear()
    storage

Audio/Video
    addTextTrack()      向音频/视频添加新的文本轨道
    canPlayType()       检测浏览器是否能播放指定的音频/视频类型
    load()              重新加载音频/视频元素
    play()              开始播放音频/视频
    pause()             暂停当前播放的音频/视频
    ---
    audioTracks         返回表示可用音轨的 AudioTrackList 对象
    autoplay            设置或返回是否在加载完成后随即播放音频/视频
    buffered            返回表示音频/视频已缓冲部分的 TimeRanges 对象
    controller          返回表示音频/视频当前媒体控制器的 MediaController 对象
    controls            设置或返回音频/视频是否显示控件（比如播放/暂停等）
    crossOrigin         设置或返回音频/视频的 CORS 设置
    currentSrc          返回当前音频/视频的 URL
    currentTime         设置或返回音频/视频中的当前播放位置（以秒计）
    defaultMuted        设置或返回音频/视频默认是否静音
    defaultPlaybackRate 设置或返回音频/视频的默认播放速度
    duration            返回当前音频/视频的长度（以秒计）
    ended               返回音频/视频的播放是否已结束
    error               返回表示音频/视频错误状态的 MediaError 对象
    loop                设置或返回音频/视频是否应在结束时重新播放
    mediaGroup          设置或返回音频/视频所属的组合（用于连接多个音频/视频元素）
    muted               设置或返回音频/视频是否静音
    networkState        返回音频/视频的当前网络状态
    paused              设置或返回音频/视频是否暂停
    playbackRate        设置或返回音频/视频播放的速度
    played              返回表示音频/视频已播放部分的 TimeRanges 对象
    preload             设置或返回音频/视频是否应该在页面加载后进行加载
    readyState          返回音频/视频当前的就绪状态
    seekable            返回表示音频/视频可寻址部分的 TimeRanges 对象
    seeking             返回用户是否正在音频/视频中进行查找
    src                 设置或返回音频/视频元素的当前来源
    startDate           返回表示当前时间偏移的 Date 对象
    textTracks          返回表示可用文本轨道的 TextTrackList 对象
    videoTracks         返回表示可用视频轨道的 VideoTrackList 对象
    volume              设置或返回音频/视频的音量
    ---
    abort               当音频/视频的加载已放弃时
    canplay             当浏览器可以播放音频/视频时
    canplaythrough      当浏览器可在不因缓冲而停顿的情况下进行播放时
    durationchange      当音频/视频的时长已更改时
    emptied             当目前的播放列表为空时
    ended               当目前的播放列表已结束时
    error               当在音频/视频加载期间发生错误时
    loadeddata          当浏览器已加载音频/视频的当前帧时
    loadedmetadata      当浏览器已加载音频/视频的元数据时
    loadstart           当浏览器开始查找音频/视频时
    pause               当音频/视频已暂停时
    play                当音频/视频已开始或不再暂停时
    playing             当音频/视频在已因缓冲而暂停或停止后已就绪时
    progress            当浏览器正在下载音频/视频时
    ratechange          当音频/视频的播放速度已更改时
    seeked              当用户已移动/跳跃到音频/视频中的新位置时
    seeking             当用户开始移动/跳跃到音频/视频中的新位置时
    stalled             当浏览器尝试获取媒体数据，但数据不可用时
    suspend             当浏览器刻意不获取媒体数据时
    timeupdate          当目前的播放位置已更改时
    volumechange        当音量已更改时
    waiting             当视频由于需要缓冲下一帧而停止

Canvas
    fillStyle               设置或返回用于填充绘画的颜色、渐变或模式
    strokeStyle             设置或返回用于笔触的颜色、渐变或模式
    shadowColor             设置或返回用于阴影的颜色
    shadowBlur              设置或返回用于阴影的模糊级别
    shadowOffsetX           设置或返回阴影距形状的水平距离
    shadowOffsetY           设置或返回阴影距形状的垂直距离
    ---
    lineCap                 设置或返回线条的结束端点样式
    lineJoin                设置或返回两条线相交时，所创建的拐角类型
    lineWidth               设置或返回当前的线条宽度
    miterLimit              设置或返回最大斜接长度
    ---
    font                    设置或返回文本内容的当前字体属性
    textAlign               设置或返回文本内容的当前对齐方式
    textBaseline            设置或返回在绘制文本时使用的当前文本基线
    ---
    width                   返回 ImageData 对象的宽度
    height                  返回 ImageData 对象的高度
    data                    返回一个对象，其包含指定的 ImageData 对象的图像数据
    ---
    createLinearGradient()  创建线性渐变（用在画布内容上）
    createPattern()         在指定的方向上重复指定的元素
    createRadialGradient()  创建放射状/环形的渐变（用在画布内容上）
    addColorStop()          规定渐变对象中的颜色和停止位置
    ---
    rect()                  创建矩形
    fillRect()              绘制“被填充”的矩形
    strokeRect()            绘制矩形（无填充）
    clearRect()             在给定的矩形内清除指定的像素
    ---
    fill()                  填充当前绘图（路径）
    stroke()                绘制已定义的路径
    beginPath()             起始一条路径，或重置当前路径
    moveTo()                把路径移动到画布中的指定点，不创建线条
    closePath()             创建从当前点回到起始点的路径
    lineTo()                添加一个新点，然后在画布中创建从该点到最后指定点的线条
    clip()                  从原始画布剪切任意形状和尺寸的区域
    quadraticCurveTo()      创建二次贝塞尔曲线
    bezierCurveTo()         创建三次方贝塞尔曲线
    arc()                   创建弧/曲线（用于创建圆形或部分圆）
    arcTo()                 创建两切线之间的弧/曲线
    isPointInPath()         如果指定的点位于当前路径中，则返回 true，否则返回 false
    ---
    scale()                 缩放当前绘图至更大或更小
    rotate()                旋转当前绘图
    translate()             重新映射画布上的 (0,0) 位置
    transform()             替换绘图的当前转换矩阵
    setTransform()          将当前转换重置为单位矩阵。然后运行 transform()
    ---
    fillText()              在画布上绘制“被填充的”文本
    strokeText()            在画布上绘制文本（无填充）
    measureText()           返回包含指定文本宽度的对象
    ---
    drawImage()             向画布上绘制图像、画布或视频
    ---
    createImageData()       创建新的、空白的 ImageData 对象
    getImageData()          返回 ImageData 对象，该对象为画布上指定的矩形复制像素数据
    putImageData()          把图像数据（从指定的 ImageData 对象）放回画布上
    ---
    globalAlpha             设置或返回绘图的当前 alpha 或透明值
    globalCompositeOperation设置或返回新图像如何绘制到已有的图像上
    ---
    save()                  保存当前环境的状态
    restore()               返回之前保存过的路径状态和属性
    createEvent()
    getContext()
    toDataURL()