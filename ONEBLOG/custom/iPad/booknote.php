<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <!--自定义评论函数-->
    <!--评论列表开始-->
    <?php if ($comments->have()): ?>
    <?php function threadedComments($comments, $options) {
            $commentClass = '';
            if ($comments->authorId) {
                    if ($comments->authorId == $comments->ownerId) {
                        $commentClass .= ' comment-by-author';
                    } else {
                        $commentClass .= ' comment-by-user';
                    }
                }
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="book-list">
        <div id="<?php $comments->theId(); ?>">
            <div class="book-content">
                <div class="book-note-content">
                    <?php $comments->content(); ?>
                </div>
                <div class="comment-book-info">
                    <span><?php $comments->date('Y年m月d日'); ?></span>
                </div>
            </div>
        </div>
    </li>
    <?php } ?>

    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('', ''); ?>
    
    
    <?php
        // 获取当前页面的文章 CID
        $cid = $this->cid;
        // 查询当前页面的评论总数
        $comment_count = $this->db->fetchRow($this->db->select('COUNT(*) AS count')->from('table.comments')
            ->where('cid = ?', $cid)
            ->where('status = ?', 'approved'))['count'];
            
        if($comment_count > 6)://注意 这里的数字一定要与主题设置中分页显示的评论数一致，换言之 如果评论数有下一页 则显示加载更多按钮?>
        
        <!-- 添加一个按钮用来加载下一页评论 -->
        <div class="center">
            <button id="load-more-comments">
                <svg t="1712389642749" class="comment-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="9075" id="mx_n_1712389642752" width="20" height="20"><path d="M674.133333 878.933333l-98.133333-102.4c128-17.066667 230.4-123.733333 230.4-251.733333 0-123.733333-93.866667-230.4-217.6-251.733333l-89.6-89.6h38.4c196.266667 0 354.133333 153.6 354.133333 341.333333 0 128-76.8 243.2-183.466666 298.666667v85.333333l-34.133334-29.866667z m-93.866666-17.066666c-12.8 0-29.866667 4.266667-46.933334 4.266666-196.266667 0-354.133333-153.6-354.133333-341.333333 0-128 76.8-243.2 183.466667-298.666667V128l55.466666 55.466667 85.333334 85.333333c-132.266667 12.8-234.666667 123.733333-234.666667 256 0 128 98.133333 234.666667 226.133333 251.733333l85.333334 85.333334z" fill="#ff342b" p-id="9076"></path></svg>
                <span class="comment-lable">点击查看更多</span>
            </button>
        </div>
        <?php endif; ?>
        <!-- 添加一个用于显示提示信息的元素 -->
        <div class="center">
            <div id="no-more-comments" style="display: none;">— 已显示全部读书笔记 —</div>
         </div>
    
    
    
    
    <?php endif; ?>

    <!--评论列表end-->
    
    
    
    
    <!--评论输入框-->
    
    <?php
    // 获取当前用户信息
    $user = Typecho_Widget::widget('Widget_User');
    
    // 检查用户是否已登录
    if ($user->hasLogin()) {
        // 检查是否允许评论
        if ($this->allow('comment')) {
            // 获取当前用户的组信息
            $currGroup = get_object_vars($this->user)['row']['group'];
            
            // 检查用户组是否为 administrator
            if ($currGroup == "administrator") {?>
            
                <div id="<?php $this->respondId(); ?>" class="respond">
                    <div class="cancel-comment-reply">
                    <?php $comments->cancelReply(); ?>
                    </div>
                	<h3 id="response"><?php _e('▋ 读书笔记'); ?></h3>
                	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                        <div class="clearfix">
                            <div class="comment-textarea">
                                 <textarea rows="2" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
                            </div>
                            <div class="comment-submit">
                                 <div class="submit-left" id="comment-book"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-zhuyidapx"></use></svg></div>
                                 <div class="submit-right"><button type="submit" class="submit"><?php _e('写笔记'); ?></button></div>
                            </div>
                            
                        </div>
                	</form>
                </div>

    <?php } } } ?>
    
</div>
