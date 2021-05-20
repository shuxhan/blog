<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="layui-container">
    <div class="layui-row layui-col-space15 main">
        <div class="map">
            <span class="layui-breadcrumb">
                <a><cite>
                    <?php $this->archiveTitle(array(
                        'category'  =>  _t('分类 %s 下的文章'),
                        'search'    =>  _t('包含关键字 %s 的文章'),
                        'tag'       =>  _t('标签 %s 下的文章'),
                        'author'    =>  _t('%s 发布的文章')
                    ), '', ''); ?>
                </cite></a>
            </span>
        </div>
        <div class="layui-col-md9 layui-col-lg9">
            <?php if ($this->have()): ?>
            <?php while($this->next()): ?>
                <div class="title-article list-card">
                    <h1>
                        <a href="<?php $this->permalink() ?>">
                            <?php $this->title() ?>
                        </a>
                        
                    </h1> 
                    <p><?php $this->excerpt(120, '...'); ?></p>
                    <div class="title-msg index-title-msg">
                        <span class="title-tags">
                            <?php _e(' &nbsp;&nbsp;'); ?><?php $this->tags('&nbsp;&nbsp;', true, 'none'); ?>
                        </span>
                        <span><i class="layui-icon">&#xe63a;</i> <?php $this->commentsNum('%d'); ?>条</span>
                        <span><?php $this->date('Y-m-d'); ?> </span>
                        <!--<span class="title-category"><?php $this->Category(', ', true, 'none'); ?></span>-->
                    </div>
                </div>
            <?php endwhile; ?>
            <div class="page-navigator">
                <?php $this->pageNav('«', '»', 1, '...', array('wrapTag' => 'div', 'wrapClass' => 'layui-laypage layui-laypage-molv', 'itemTag' => '', 'currentClass' => 'current', )); ?>
            </div>
            <?php else: ?>
                <div class="post">
                    <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
                </div>
            <?php endif; ?>
        </div>
        
        <?php $this->need('sidebar.php'); ?>

    </div>
</div>

<?php $this->need('footer.php'); ?>