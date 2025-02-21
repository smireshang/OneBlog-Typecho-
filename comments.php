<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <!--自定义评论函数-->
    <!--评论输入框-->

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
    	<h3 id="response"><?php _e('<svg class="icon" aria-hidden="true"><use xlink:href="#icon-guestwrite"></use></svg>发表留言'); ?></h3>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
        <?php if ($this->user->hasLogin() && isset($this->user->group) && $this->user->group == "administrator"): ?>
        <?php else: ?>
            <div class="comment-author-info">
                <div class="comment-md-3">
                    <label for="author"><?php _e('称呼'); ?><span class="required">*</span></label>
                    <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
                </div>	    
                <div class="comment-md-3">
                    <label for="mail"<?php if ($this->options->commentsRequireMail): ?><?php endif; ?>><?php _e('邮箱'); ?><span class="required">*</span></label>
                    <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                </div>	
                <div class="comment-md-3 comment-url">
                    <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?></label>
                    <input type="url" name="url" id="url" class="text" placeholder="<?php _e('https://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                </div>
            </div>
        <?php endif; ?>
            <div class="clearfix">
                <div class="comment-textarea">
                    <textarea placeholder="请输入留言内容..." rows="3" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
                </div>
                <div class="comment-submit">
                    <div class="submit-left">
                        <i id="emoji-btn" class="iconfont icon-emoji"></i>
                        <div id="emoji-picker" class="emoji-picker" style="display:none;">
                            <div class="emoji-categories">
                                <button type="button" class="emoji-category" data-category="emotion">表情</button>
                                <button type="button" class="emoji-category" data-category="special">特殊</button>
                                <button type="button" class="emoji-category" data-category="kaomoji">颜文字</button>
                            </div>
                            <div class="emoji-container">
                                <!-- 表情图标会动态加载到这里 -->
                            </div>
                        </div>
                    </div>
                    <div class="submit-right">
                        <button type="submit" class="submit"><?php _e('提交审核'); ?></button>
                    </div>
                </div>
            </div>
    	</form>
    </div>
    <?php endif; ?>
     <!--评论列表开始-->
    <?php if ($comments->have()): ?>
    <div class="inline"></div>
	<h3><?php $this->commentsNum(_t('<svg class="icon" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg>暂无留言'), _t('<svg class="icon" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg>读者留言<span>1</span>'), _t('<svg class="icon" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg>读者留言<span>%d</span>')); ?></h3>
    <?php function threadedComments($comments, $options) {
            $commentClass = '';
            if ($comments->authorId) {
                    if ($comments->authorId == $comments->ownerId) {
                        $commentClass .= ' comment-by-author';
                    } else {
                        $commentClass .= ' comment-by-user';
                    }
                }
            $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="animated fadeIn comment-body<?php if ($comments->levels > 0) { echo ' comment-child';$comments->levelsAlt(' comment-level-odd', ' comment-level-even');} else {echo ' comment-parent';}
        $comments->alt(' comment-odd', ' comment-even');
        echo $commentClass;
        ?>">
        <div id="<?php $comments->theId(); ?>">
            <div class="comment-author">
                <?php $email=$comments->mail; $imgUrl = getGravatar($email);echo '<img class="avatar" src="'.$imgUrl.'" width="31px" height="31px">'; ?>
                <div class="comment-info">
                    <div class="fn">
                        <?php $comments->author(); ?>
                        <?php dengji($comments->mail);?>
                        <?php if ($comments->status === "waiting") : ?>
                            <em class="waiting">（审核中...）</em>
                        <?php endif; ?>
                    </div>
                    <div class="comment-info-bottom">
                        <span><?php $comments->date('Y-m-d H:i'); ?></span>
                        <span class="comment-reply"><?php $comments->reply(); ?></span>       
                    </div>
                </div>
            </div>
            <?php if ($comments->status === "waiting") : ?>
                 <div class="p-waiting"><?php echo parseEmojis($comments->content); ?><span>[提示] 该评论已提交审核，审核通过前此评论仅自己可见。</span></div>
            <?php else: ?>
                <?php echo parseEmojis($comments->content); ?><p>
            <?php endif; ?>
        </div>
        <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
        <?php } ?>
    </li>
    <?php } ?>

    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('', ''); ?>
        
    <div id="loading-spinner" style="display: none;">
        <div class="spinner"></div>加载中...
    </div>
    <div class="end" id="no-more" style="display: none;">END</div>
    <?php else:?>
    <div class="end" id="no-more" style="display: none;">END</div>
    <?php endif; ?>
    
    <!--评论列表end-->
</div>
