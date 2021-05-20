<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
    <link rel="shortcut icon" href="https://img.shuxhan.com/favicon.png">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('layui/css/layui.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/comments.css'); ?>"> <!--评论-->
    <!--暗色系主题-->
    <!--<link rel="stylesheet" href="<?php $this->options->themeUrl('css/dark.css'); ?>"> -->
    <!--明亮主题-->
    <!--<link rel="stylesheet" href="<?php $this->options->themeUrl('css/light.css'); ?>"> -->
    <script src="<?php $this->options->themeUrl('layui/layui.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/jquery3.6.0.js'); ?>"></script>
    <!--百度统计代码-->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?8516e418a4e3ac3474b3c13bdb4687e7";
            var s = document.getElementsByTagName("script")[0]; 
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

</head>
<body>
<div class="layui-header header">
    <div class="layui-main">
        <!--<?php if ($this->options->logoUrl): ?>-->
        <!--    <a class="logo" href="<?php $this->options->siteUrl(); ?>">-->
        <!--        <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />-->
        <!--    </a>-->
        <!--<?php else: ?>-->
            <a class="logo" href="<?php $this->options->siteUrl(); ?>">子舒</a>
            
        <!--<?php endif; ?>-->
        
        
        <ul class="layui-nav">
            <li class="header-home layui-nav-item layui-hide-xs <?php if($this->is('index')): ?>layui-this<?php endif; ?>">
                <a href="<?php $this->options->siteUrl(); ?>"><?php _e('Home'); ?></a> 
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
            <li class="layui-nav-item layui-hide-xs <?php if($this->is('page', $pages->slug)): ?>layui-this<?php endif; ?>">
                <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a> 
            </li>
            <?php endwhile; ?>
            
            
        </ul>
    </div>
</div>