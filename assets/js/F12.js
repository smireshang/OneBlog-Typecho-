/**
 * Version: 3.4
 * Updated: 2025-02-18
 * Author: ©彼岸临窗 oneblogx.com
 */
 
document.addEventListener('DOMContentLoaded', function () {
    // 禁用复制功能
    if (disableCopy && !isLinksPage) {
        document.body.oncopy = function () {
            layer.msg('抱歉，本站内容不允许复制！');
            return false;
        };
    } else if (isLinksPage) {
        // 友链页面允许复制
        document.body.oncopy = function () {
            layer.msg('复制成功！');
        };
    }

    // 禁用右键菜单
    if (disableRightClick) {
        document.oncontextmenu = function (event) {
            layer.msg('右键菜单已禁用！');
            return false;
        };
    }

    // 禁用 F12 调试功能
    if (disableF12) {
        document.onkeydown = function (event) {
            // 检测 F12 按键
            if (event.keyCode === 123) {
                event.preventDefault();
                layer.msg('系统检测到异常，3秒后跳转至首页');
                setTimeout(function () {
                    window.location.href = "/"; // 3秒后跳转至首页
                }, 3000);
                return false;
            }

            // 检测 Ctrl+Shift+I (开发者工具)
            if (event.ctrlKey && event.shiftKey && event.keyCode === 73) {
                event.preventDefault();
                layer.msg('系统检测到异常，3秒后跳转至首页');
                setTimeout(function () {
                    window.location.href = "/"; // 3秒后跳转至首页
                }, 3000);
                return false;
            }

            // 检测 Ctrl+U (查看页面源代码)
            if (event.ctrlKey && event.keyCode === 85) {
                event.preventDefault();
                layer.msg('系统检测到异常，3秒后跳转至首页');
                setTimeout(function () {
                    window.location.href = "/"; // 3秒后跳转至首页
                }, 3000);
                return false;
            }
        };
    }
});