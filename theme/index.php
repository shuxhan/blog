<?php
/**
 * Han 一款基于 typecho 程序的简约风双栏博客主题，专注于写作，抛弃了一切臃肿的功能，单纯为写作而存在。
 * 
 * @package Han
 * @author 子舒(shuxhan)
 * @version 1.0.0
 * @link https://shuxhan.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
?>

<div class="layui-container">
    <div class="layui-row layui-col-space15 main">
        <div class="layui-col-md9 layui-col-lg9">
            <?php while($this->next()): ?>
                <div class="title-article list-card">
                    <h1>
                        <a href="<?php $this->permalink() ?>">
                            <?php $this->sticky();$this->title() ?>
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
        </div>
        
        <?php $this->need('sidebar.php'); ?>

    </div>
</div>

<?php $this->need('footer.php'); ?>

