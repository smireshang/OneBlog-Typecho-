/**无限加载**/
document.addEventListener('DOMContentLoaded', function () {
    var isLoading = false; // 防止重复加载
    var noMoreComments = false; // 是否还有更多评论

    function loadMoreComments() {
        if (isLoading || noMoreComments) return; // 如果正在加载或没有更多评论，直接返回

        var nextPageUrl = document.querySelector('.page-navigator .next a')?.getAttribute('href');
        if (!nextPageUrl) {
            noMoreComments = true; // 没有下一页链接，标记为没有更多评论
            document.getElementById('no-more').style.display = 'block'; // 显示提示
            return;
        }

        isLoading = true; // 标记为正在加载

        var xhr = new XMLHttpRequest();
        xhr.open('GET', nextPageUrl, true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = xhr.responseText;

                // 插入新评论
                var newComments = tempDiv.querySelector('.comment-list').innerHTML;
                document.querySelector('.comment-list').insertAdjacentHTML('beforeend', newComments);

                // 更新分页导航
                var newNav = tempDiv.querySelector('.page-navigator').innerHTML;
                document.querySelector('.page-navigator').innerHTML = newNav;

                // 检查是否还有下一页评论
                var nextLink = tempDiv.querySelector('.page-navigator .next a');
                if (!nextLink) {
                    noMoreComments = true; // 没有下一页链接，标记为没有更多评论
                    document.getElementById('no-more').style.display = 'block'; // 显示提示
                }
            } else {
                console.error('Request failed: ' + xhr.statusText);
            }
            isLoading = false; // 加载完成
        };
        xhr.onerror = function () {
            console.error('Request failed');
            isLoading = false; // 加载完成
        };
        xhr.send();
    }

    // 监听滚动事件
    window.addEventListener('scroll', function () {
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
        var clientHeight = document.documentElement.clientHeight || document.body.clientHeight;

        // 判断是否滚动到底部
        if (scrollTop + clientHeight >= scrollHeight - 100) { // 距离底部 100px 时触发
            loadMoreComments();
        }
    });

    // 初始加载并检查是否需要显示“END”
    var initialNextPageUrl = document.querySelector('.page-navigator .next a')?.getAttribute('href');
    if (!initialNextPageUrl) {
        noMoreComments = true; // 没有下一页链接，标记为没有更多评论
        document.getElementById('no-more').style.display = 'block'; // 显示提示
    }
});