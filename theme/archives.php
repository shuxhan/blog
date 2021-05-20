<?php
/**
 * 文章归档
 *
 * @package custom
 */
?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


<div class="layui-container">
    <div class="layui-row layui-col-space15 main">
        
        <div class="layui-col-md9 layui-col-lg9">
            <div class="archives">
                <div class="title-page">
                    <h3><i class="layui-icon">&#xe653;</i> Article archive</h3>
                    <p><?php $stat = Typecho_Widget::widget('Widget_Stat'); _e('目前共计 <em>%s</em> 篇日志，共 <em>%s</em> 条评论，加油啊~',$stat->PublishedPostsNum, $stat->PublishedCommentsNum); ?></p>
                </div>
                <ul class="layui-timeline">
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 m 月')->to($archives); ?>
                    <?php while($archives->next()): ?>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content">
                            <h3 class="layui-timeline-title"><a href="<?php $archives->permalink(); ?>"><?php $archives->date(); ?></a></h3>
                            <?php 
                                $year = $archives->year;
                                $month = $archives->month;
                                $nextYear = $month == 12 ? $year+ 1 : $year;
                                $nextMonth = $month == 12 ? 1 : $month+1;
                                $contents = $this->db->fetchAll($this->select()
                                ->where('table.contents.status = ?', 'publish')
                                ->where('table.contents.created >= ?', strtotime("$year-$month"))
                                ->where('table.contents.created < ?', strtotime("$nextYear-$nextMonth"))
                                ->where('table.contents.type = ?', 'post')
                                ->order('table.contents.created', Typecho_Db::SORT_DESC), array($this, 'push'));
                                //var_dump($contents);
                                foreach ($contents as $content) {
                                    echo "<p><a href='$content[permalink]' title='$content[title]'>$content[title]</a></p>";
                                }
                            ?>
                            
                        </div>
                    </li>
                    <?php endwhile; ?>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                        <div class="layui-timeline-title">开始</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <?php $this->need('sidebar.php'); ?>

    </div>
</div>

<?php $this->need('footer.php'); ?>