# 前端
创建XMLHttpRequest对象

    现代浏览器 ? xmlhttp = new XMLHttpRequest : xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

发送请求

    xmlhttp.open("GET/POST","file_path","true/false")
    xmlhttp.send()
        true ? 在open之前编写onreadystatechange函数

处理响应

    onreadystatechange函数 ? 在onreadystatechange函数里编写 : 在send()后编写
    responseText | responseXML ?

# Sample

    function showCustomer(str) {
    var xmlhttp;
    if (str=="")    {
        document.getElementById("txtHint").innerHTML="";
        return;
        }
    if (window.XMLHttpRequest)  {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
    else {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    xmlhttp.onreadystatechange=function()   {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
        }
    xmlhttp.open("GET","getcustomer.asp?q="+str,true);
    xmlhttp.send();
    }

# 后台
接收请求
处理数据
返回响应