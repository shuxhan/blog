<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="layui-container">
    <div class="layui-row layui-col-space15 main">
        <div class="map">
            <span class="layui-breadcrumb">
                <a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
                <?php $this->category(','); ?>
                <a><cite>正文</cite></a>
            </span>
        </div>
        <div class="layui-col-md9 layui-col-lg9">
            <div class="title-article title-article-title">
                <div class="post-title-h1">
                    
                        <h1><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
                    
                </div>
                <div class="title-msg">
                    <span>发布于 <?php $this->date('Y-m-d'); ?> </span>
                    <span><?php $this->Category(', ', true, 'none'); ?></span>
                    <span><i class="layui-icon">&#xe63a;</i> <?php $this->commentsNum('%d'); ?>条</span>
                </div>
            </div>
            <!--正文-->
            <div class="text" itemprop="articleBody">
                <?php $this->content(); ?>
                <!--点赞-->
                <center>
                    <?php AnotherLike_Plugin::theLike(); ?>
                </center>
                
            </div>
            
            <!--标签-->
            <div class="tags-text">
                <i class="layui-icon">&#xe66e; </i><?php _e(' &nbsp;&nbsp;'); ?><?php $this->tags('&nbsp;&nbsp;', true, 'none'); ?>
            </div>
            <!--版权信息-->
            <div class="copy-text">
                <div>
                    <p>本文最后更新时间为&nbsp;&nbsp;<span style="color:#000;text-decoration:underline;"><?php echo date('Y-m-d H:i:s' , $this->modified); ?></span>&nbsp;&nbsp;(<span class="lately-c"><?php echo date('Y-m-d H:i:s' , $this->modified); ?></span>)，如果资源无效请在评论区留言。</p>
                    <p>若无特殊说明，本站所有文章均为博主原创，如若转载，注明出处与链接即可。</p>
                    <p class="hidden-xs">本文首次发布：<a href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a> </p>
                </div>
            </div>
            <div class="page-text">
                <div>
                    <span class="layui-badge layui-bg-gray">上一篇</span>
                    <?php $this->thePrev('%s','没有了'); ?>
                </div>
                <div>
                    <span class="layui-badge layui-bg-gray">下一篇</span>
                    <?php $this->theNext('%s','没有了'); ?>
                </div>
            </div>
            <!--评论-->
            <div class="comment-text layui-form">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>
        
        <?php $this->need('sidebar.php'); ?>

    </div>
</div>

<?php $this->need('footer.php'); ?>

