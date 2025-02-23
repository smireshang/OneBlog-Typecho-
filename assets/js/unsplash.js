/**
 * Updated: 2025-02-22
 * Author: ©彼岸临窗 oneblogx.com
 */
 
let clickCount = 0;
let firstClickTime = null;
let customLoadingIndex = null;

document.getElementById('updateBtn').addEventListener('click', async function() {
    const now = new Date().getTime();

    if (!firstClickTime || now - firstClickTime > 60000) {
        // 重置计数器和时间
        firstClickTime = now;
        clickCount = 0;
    }

    clickCount++;

    if (clickCount > 10) {
        layer.msg('操作过于频繁，请稍后再试。', {icon: 2});
        return;
    }

    // 显示自定义加载框
    customLoadingIndex = layer.open({
        type: 1,
        content: '<div class="customLoading"><div class="loader"></div><p style="font-size: 14px;margin-top: 20px;">正在同步，请稍候...</p></div>',
        closeBtn: 0,
        shadeClose: false,
        shade: 0.5,
        skin: 'layui-layer-loader',
        title: false, // 不显示标题栏
        area: ['200px', '110px'], // 自适应宽高
    });

    try {
        let response = await fetch("?sync=1");
            layer.close(customLoadingIndex);
        if (response.ok) {
            let text = await response.text();
            var title;
            if (text.indexOf('请求超时') !== -1) {
                title = '⏳️&nbsp请求超时';
            } else if (text.indexOf('系统发生错误') !== -1) {
                title = '❌&nbsp;错误';    
            } else {
                title = '💡&nbsp;同步完成';
            } 
            layer.alert(text, {
                skin: 'layui-layer-custom',
                title: title,
                closeBtn: 1,
                move: false, // 禁用弹框移动
                end: function() { // 弹框关闭时的回调
                    refreshPhotos();
                }
            });
        } else {
            layer.msg('系统发生错误，请稍后再试。', {icon: 2});
        }
    } catch (error) {
        layer.close(customLoadingIndex); // 发生错误时关闭自定义加载框
        layer.msg('系统发生错误，请稍后再试。', {icon: 2});
    }
});

async function refreshPhotos() {
    try {
        let response = await fetch("?refresh=1");
        if (response.ok) {
            let newPhotos = await response.text();
            document.getElementById('photos').innerHTML = newPhotos;
        } else {
            console.error('Failed to refresh photos');
        }
    } catch (error) {
        console.error('Error refreshing photos:', error);
    }
}