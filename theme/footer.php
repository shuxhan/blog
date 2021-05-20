<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="footer">
    <div class="layui-col-md12 t-copy">
        <span class="layui-breadcrumb">
            <a style="color:#333 !important" href="https://shuxhan.com/sitemap.xml">Sitemap&nbsp;&nbsp;</a>
            <span>
                <?php echo online_users() ?>
                <?php echo timer_stop();?>
            </span>
           
            <span>&nbsp;<?php echo theAllViews();?></span>
            
            <div style="padding:10px 0;">
                <span>&copy; 2020 - <?php echo date('Y'); ?>&nbsp;<?php $this->options->title() ?> </span>&nbsp;
                <a href="https://beian.miit.gov.cn/" target="_blank"><span>浙ICP备2021002261号-1</span>	</a>
                <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=33010802011426">
                    <span style="margin: 0px 0px 0px 5px;">浙公网安备 33010802011426号</span>
                </a>
            </div>
        </span>
    </div>
</div>

<a id="gotop">Scroll to top</a>

<?php $this->footer(); ?>
<script src="<?php $this->options->themeUrl('js/main.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/gh/Tokinx/Lately@master/lately.js"></script>
<script>
    Lately({
        'target' : '.lately-a,.lately-b,.lately-c'
    })
</script>
</body>
</html>
