<?php
/**
 * 标签云
 *
 * @package custom
 */
?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


<div class="layui-container">
    <div class="layui-row layui-col-space15 main">
        
        <div class="layui-col-md9 layui-col-lg9">
            <div class="archives archives-tags">
                <div class="title-page">
                    <h3><i class="layui-icon">&#xe653;</i> Tag Cloud</h3>
                    <!--<p><?php $stat = Typecho_Widget::widget('Widget_Stat'); _e('博客共计 <em>%s</em> 个标签! ',$stat->PublishedTagNum); ?></p>-->
                </div>
                <div class="tags-content">
                    <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
                    <?php while($tags->next()): ?>
                        <a class="layui-btn layui-btn-xs layui-btn-primary" href="<?php $tags->permalink(); ?>" title='<?php $tags->name(); ?>'><?php $tags->name(); ?></a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        
        <?php $this->need('sidebar.php'); ?>

    </div>
</div>

<?php $this->need('footer.php'); ?>