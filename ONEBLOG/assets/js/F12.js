
document.body.oncopy = function() {layer.msg('复制失败：系统检测到您未经授权！');};
document.oncopy = function (event){
if(window.event){
event = window.event;
}try{
var the = event.srcElement;
if(!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
return false;
}
return true;
}catch (e){
return false;
}
}

document.onkeydown = function(){ //屏蔽F12
    if(window.event && window.event.keyCode == 1.3) {
        layer.msg("系统检测到您的非正常阅读行为，请立即停止！");
        event.keyCode=0;
        event.returnValue=false;
    }
(function noDebuger() {
    function testDebuger() {
        var d = new Date();
        debugger;
        if (new Date() - d > 10) {
            document.body.innerHTML = '<div style="width: 100%;height: 50px;font-size: 20px;text-align: center;font-weight: bold;position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">系统检测到您的非正常阅读行为，请<a href="/" target="_blank" style="color:#4285f4;">返回首页</a>正常阅览！</div>';
            return true;
        }
        return false;
    }
    function start() {
        while (testDebuger()) {
            testDebuger();
        }
    }
    if (!testDebuger()) {
        window.onblur = function () {
            setTimeout(function () {
                start();
            }, 500)
        }
    }else {
        start();
    }
})();
}    


document.oncontextmenu = function (event){ //屏蔽右键
if(window.event){
event = window.event;
}try{
var the = event.srcElement;
if (!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
return false;
}
return true;
}catch (e){
return false;
}
}
