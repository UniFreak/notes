IE6 BUG 汇总

1.  li在IE中底部3像素的BUG
    解决方案：在<li>上加float:left；即可解决

2.  IE6中奇数宽高的BUG。
    解决方案：就是将外部相对定位的div宽度改成偶数。高度也是一样的。

3.  IE6文字溢出BUG

    引发这种BUG有几个条件
        1.是注释引起的,删除所有注释即可.
        2.hidden的input直接放在form下.
        3.display为none的div也有可能引发此bug.
        4.可以通过外面再包一次DIV解决
        由注释造成文字溢出，属于IE6的BUG，溢出文字的字数=注释的条数*2-1，这里的字数在中文或英文数字时都成立。注释坐在位置与溢出位置、区块的浮动以及文字区块的固定宽度有必然联系。

    解决办法：
        不放置注释。最简单、最快捷的解决方法；
        注释不要放置于2个浮动的区块之间；
        将文字区块包含在新的<div></div>之间，如：<div style=”float:right;width:400px”><div>↓这就是多出来的那只猪</div></div>；
        去除文字区块的固定宽度，与3有相似之处；
        在后面加一个<br />或者空格；（不推荐）
        使用IE注释格式，如：<!–[if !IE]>Put your commentary in here…<![endif]–>
        给盒子加position:relative;属性

4. 样式中文注释后引发失效。

    满足下面条件就会引起 注释下面的样式不起作用：
        1. css有中文注释        2. css为ANSI编码
        3. html为utf-8编码

    解决方法：
        1. 去掉中文注释，用英文注释
        2. 统一css 和 html 的编码
        建议采用第二种解决方法
        ps： css为uft-8  html 为ANSI 不会出现失效的情况。

5.li在IE中底部空行的BUG

    IE6中列表的常见问题出现在当某个 li 中的内容是一个 display: block 的锚点(anchor)时。在这种情况下，列表元素之间的空格将不会被忽略而且通常会显示成额外的一行夹在每个 li 之间。一种避免这种竖直方向多余空白的解决方法是赋予这些锚点 layout。这样还有一个好处就是可以让整个锚点的矩形区域都可以响应鼠标点击。

    解决方法：
    1. 在li a 样式中加入zoom:1；
    2. 在li 样式中加入display:inline ；
    3. 将<li>标签写成一行；
    4. 在li a 样式中加入width:100%或者一个宽度值；
    建议采用第4二种解决方法

7. 父级使用padding后子元素绝对定位的BUG。在父层使用position:relative;和padding（当然0值除外）后，ie6中层的定位起始坐标是从padding后的位置算起，而其他则从层的真实位置算起，而非被padding改变后的那个位置。这点造成使用position:absolute进行层定位时ie6与其他浏览器的表现不一样。
    解决方法：
    给外层加宽度或zoom:1

8.display:none引起的3像素的BUG
    解决方案1：
        将最后一个div加一个margin-right:-3px。
        如：<divstyle="display: none; "></div><divstyle="background:green; width:10px; float:left; height:300px;margin-right:-3px"></div>
    解决方案2：
        将display: none的div换一个形式隐藏。
        如：<divstyle="position:absolute; visibility: hidden "></div>

9. IE6的图片3px问题
IE 6 中 ，DIV 使用背景图片（或直接插入图片在DIV中）的时候，在图片的下端会出现一条空白间隔，经测量，刚好是 3px .
    解决：
        IE6默认字号是12pt，默认行高是normal。
        1. 给DIV加上：font-size: 0px;
        2. 设置img为“display:block;”。
        3. 即设置图片的vertical-align属性为“top，text-top，bottom，text-bottom”也可以解决。
        4.设置图片的浮动属性，“#sub img {float:left;}”。
        5.取消图片标签和其父对象的最后一个结束标签之间的空格，这种方法适用范围比较窄，只限于父对象中只包含一个图片对象，而且和父对象的结束标签之间不能有任何空隙。

10. IE6双倍浮动BUG
    解决：
        解决办法是加上display:inline;

11 .IE6的著名3px BUG（断头台bug）：
两个层，一个浮动，一个不浮动，把浮动的一个放在不浮动层中，你会发现两个之间有点间隙，宽度为3px。这个问题是最让人头疼的问题了。
    解决方法：
        1、所有的层都浮动 把右边那个层也设置成浮动层就可以消除这可恶的3px间隔
        2、给左边的层，应用margin-right:-3px;，同样可解决IE 3px bug。

12. Ie6图片导致行距无效
    解决方法：对和文字相连接的img、input、textarea、select、object等元素加以属性 margin: (所属line-height-自身高度)/2px 0）

13. IE6使用滤镜使PNG图片透明后，容器内链接失效的问题。
    解决方法是为链接定义一个相对定位属性。position:relative

14. 禁用文本框中文输入法的通用方法。<div>验证码<input type="text" style="ime-mode:disabled"/></div>          IE可以用ime-mode:disabled，firefox3也开始支持IE的这一私有属性
        对于其他不支持的浏览器可以用如下方法模拟
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh">
        <head profile="http://www.w3.org/2000/08/w3c-synd/#">
        <meta http-equiv="content-language" content="zh-cn" />
        <meta http-equiv="content-type" content="text/html;charset=gb2312" />
        <title>blueidea</title>
        <style type="text/css">
        /*<![CDATA[*/
        input,textarea {
            width:300px;
            height:20px;
            border:1px solid
            }
        textarea {
            height:150px
            }
        #pw {
            opacity:0;
            display:block;
            position:relative;
            margin-top:-24px
            }
        #tt,#pw {
            width:100px
            }
        /*]]>*/
        </style>
        </head>
        <body>
        <table>
            <tr>
                <td>标题</td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>内容</td>
                <td><textarea></textarea></td>
            </tr>
            <tr>
                <td>验证码</td>
                <td><input type="text" id="tt"/><input type="password" id="pw"/></td>
            </tr>
        </table>
        <script type="text/javascript">
        // <![CDATA[
        var ee = document.getElementById('pw');
        ee.onkeyup = function p() {
            document.getElementById('tt').value = ee.value;
        }
        // ]]>
        </script>
        </body>
        </html>

IE6 supports PNG images. What it doesn't support (and what the hacks are for) is alpha transparancy in PNG images
