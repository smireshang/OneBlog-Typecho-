/**
 * Version: 3.4.1
 * Updated: 2025-02-19
 * Author: ©彼岸临窗 oneblogx.com
 */

/**无限加载**/
document.addEventListener('DOMContentLoaded', function () {
    var isLoading = false; 
    var noMoreComments = false; 
    function loadMoreComments() {
        if (isLoading || noMoreComments) return;
        var nextPageUrl = document.querySelector('.page-navigator .next a')?.getAttribute('href');
        if (!nextPageUrl) {
            noMoreComments = true; 
            document.getElementById('no-more').style.display = 'block'; 
            return;
        }
        isLoading = true;
        var loadingSpinner = document.getElementById('loading-spinner');
        loadingSpinner.style.display = 'flex';
        setTimeout(function () {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', nextPageUrl, true);
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = xhr.responseText;
                    var newComments = tempDiv.querySelector('.comment-list').innerHTML;
                    document.querySelector('.comment-list').insertAdjacentHTML('beforeend', newComments);
                    var newNav = tempDiv.querySelector('.page-navigator').innerHTML;
                    document.querySelector('.page-navigator').innerHTML = newNav;
                    var nextLink = tempDiv.querySelector('.page-navigator .next a');
                    if (!nextLink) {
                        noMoreComments = true; 
                        document.getElementById('no-more').style.display = 'block'; 
                    }
                } else {
                    console.error('Request failed: ' + xhr.statusText);
                }
                isLoading = false; 
                loadingSpinner.style.display = 'none'; 
            };
            xhr.onerror = function () {
                console.error('Request failed');
                isLoading = false;
                loadingSpinner.style.display = 'none'; 
            };
            xhr.send();
        }, 500 ); // 延迟0.5秒
    }
    window.addEventListener('scroll', function () {
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
        var clientHeight = document.documentElement.clientHeight || document.body.clientHeight;
        if (scrollTop + clientHeight >= scrollHeight - 200) { 
            loadMoreComments();
        }
    });
    var initialNextPageUrl = document.querySelector('.page-navigator .next a')?.getAttribute('href');
    if (!initialNextPageUrl) {
        noMoreComments = true; 
        document.getElementById('no-more').style.display = 'block'; 
    }
});