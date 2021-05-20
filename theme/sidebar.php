<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="sidebar layui-col-md3 layui-col-lg3">
    
     <div class="component">
        <form class="layui-form" id="search" method="post" action="<?php $this->options->siteUrl(); ?>/search" role="search">
            <div class="layui-inline input">
                <input autocomplete="off" type="text" id="s" name="s" class="layui-input" required lay-verify="required" placeholder="<?php _e('Keywords'); ?>" />
            </div>
            <div class="layui-inline">
                <button class="layui-btn layui-btn-sm layui-btn-primary"><i class="layui-icon">&#xe615;</i></button>
            </div>
        </form>
    </div>
    
    <div class="tags sidebar-1">
        <h3 class="title-sidebar">Announcement</h3>
        <div>
            <p>路漫漫其修远兮，吾将上下而求索！记录了我的编程之旅和生活感悟。</p>
        </div>
    </div>
    
    <div class="column">
        <h3 class="title-sidebar"><?php _e('Category'); ?></h3>
        <ul class="layui-row layui-col-space5">
            <?php $this->widget('Widget_Metas_Category_List')
               ->parse('<li class="layui-col-md12 layui-col-xs6"><a href="{permalink}"><i class="layui-icon">&#xe63c;</i> {name}<span class="layui-badge layui-bg-gray">{count}</span></a></li>'); ?>
        </ul>
    </div>
    
    <div class="tags sidebar-2">
        <h3 class="title-sidebar">Hot</h3>
        <div>
            <?php getHotComments('6');?>
        </div>
    </div>
    
    
    <div class="tags sidebar-2">
        <h3 class="title-sidebar">New</h3>
        <div>
            <?php
                $this->widget('Widget_Contents_Post_Recent','pageSize=6')->to($recent);
                if($recent->have()):
                while($recent->next()):
                ?>
                <li><a href="<?php $recent->permalink();?>"><?php $recent->title();?></a></li>
                <?php endwhile; endif;?>
        </div>
    </div>
    
    <!--目录-->
    <div id="mulu"></div>
    
</div>