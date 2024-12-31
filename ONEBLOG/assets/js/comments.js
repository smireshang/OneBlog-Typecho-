/**无限加载点击后加载**/

document.addEventListener('DOMContentLoaded', function() {
    var loadMoreButton = document.getElementById('load-more-comments');
    if (loadMoreButton) {
        // 当按钮被点击时执行的函数
        loadMoreButton.addEventListener('click', function() {
            var nextPageUrl = document.querySelector('.page-navigator .next a').getAttribute('href');
            if (nextPageUrl) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', nextPageUrl, true);
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = xhr.responseText;
                        var newComments = tempDiv.querySelector('.comment-list').innerHTML;
                        document.querySelector('.comment-list').insertAdjacentHTML('beforeend', newComments);
                        var newNav = tempDiv.querySelector('.page-navigator').innerHTML;
                        document.querySelector('.page-navigator').innerHTML = newNav;
                        
                        // 检查是否还有下一页评论
                        var nextLink = tempDiv.querySelector('.page-navigator .next a');
                        if (!nextLink) {
                            // 如果没有下一页评论，将加载按钮替换为提示信息
                            loadMoreButton.style.display = 'none';
                            document.getElementById('no-more-comments').style.display = 'block';
                        }
                    } else {
                        console.error('Request failed: ' + xhr.statusText);
                    }
                };
                xhr.onerror = function() {
                    console.error('Request failed');
                };
                xhr.send();
            } else {
                // 如果没有下一页链接，将加载按钮替换为提示信息
                loadMoreButton.style.display = 'none';
                document.getElementById('no-more-comments').style.display = 'block';
            }
        });
    }
});
