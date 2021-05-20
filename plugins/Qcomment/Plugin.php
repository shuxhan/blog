<?php
/**
 * 博客评论实时通知到QQ
 *
 * @package Qcomment
 * @author shuxhan
 * @version 1.0.0
 * @link https://github.com/shuxhan/Qcomment
 * @blog https://shuxhan.com
 */

require 'lib/QQService.php';

class Qcomment_Plugin implements Typecho_Plugin_Interface
{
    protected static $comment;
    protected static $active;

    /**
     * @return string|void
     * @throws Typecho_Db_Exception
     */
    public static function activate()
    {
        self::addTable();
        Typecho_Plugin::factory('Widget_Feedback')->comment = [__CLASS__, 'pushServiceReady'];
        Typecho_Plugin::factory('Widget_Feedback')->finishComment = [__CLASS__, 'pushServiceGo'];

        Helper::addRoute('QcommentAction','/Qcomment/officialAccount','Qcomment_Action','officialAccount');

        Helper::addPanel(1, 'Qcomment/Logs.php', 'Qcomment日志', 'Qcomment日志', 'administrator');
        return _t('Qcommentt插件启用成功');
    }


    /**
     * @throws Typecho_Db_Exception
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
        Helper::removeRoute('QcommentAction');
        Helper::removePanel(1, 'Qcomment/Logs.php');
        if (Helper::options()->plugin('Qcomment')->isDelete == 1) {
            self::removeTable();
        }
    }

    /**
     * @throws Typecho_Db_Exception
     */
    private static function addTable()
    {
        $db = Typecho_Db::get();

        $sql = self::getSql($db, 'install');

        $db->query($sql);
    }

    /**
     * @param $db
     * @param string $path
     * @return string|string[]
     */
    private static function getSql($db, $path = 'install')
    {
        $adapter = $db->getAdapterName();
        $prefix = $db->getPrefix();

        if ($adapter === 'Pdo_Mysql' || $adapter === 'Mysql' || $adapter === 'Mysqli') {
            $sqlTemplate = file_get_contents(__DIR__ . '/sql/' . $path . '/Mysql.sql');
        }

        if ($adapter === 'Pdo_SQLite') {
            $sqlTemplate = file_get_contents(__DIR__ . '/sql/' . $path . '/SQLite.sql');
        }

        if ($adapter === 'Pdo_Pgsql') {
            $sqlTemplate = file_get_contents(__DIR__ . '/sql/' . $path . '/Pgsql.sql');
        }

        if (empty($sqlTemplate)) throw new \Exception('暂不支持你的数据库');

        $sql = str_replace('{prefix}', $prefix, $sqlTemplate);
        return $sql;
    }

    /**
     * @return string
     * @throws Typecho_Db_Exception
     */
    private static function removeTable()
    {
        $db = Typecho_Db::get();
        $sql = self::getSql($db, 'uninstall');
        try {
            $db->query($sql, Typecho_Db::WRITE);
        } catch (Typecho_Exception $e) {
            return "删除Qcomment日志表失败！";
        }
        return "删除Qcomment日志表成功！";
    }

    /**
     * @param Typecho_Widget_Helper_Form $form
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $serviceTitle = new Typecho_Widget_Helper_Layout('div', array('class=' => 'typecho-page-title'));
        $serviceTitle->html('<h2>推送服务配置</h2>');
        $form->addItem($serviceTitle);

        $services = new Typecho_Widget_Helper_Form_Element_Checkbox('services', [
            "QQService" => _t('Qmsg酱')
        ], 'services', _t('确认是否选择Qmsg酱'), _t('插件作者：<a href="https://shuxhan.com">shuxhan</a>'));
        $form->addInput($services->addRule('required', _t('必须选择一项推送服务')));


        $isPushBlogger = new Typecho_Widget_Helper_Form_Element_Radio('isPushBlogger', [
            1 => '是',
            0 => '否'
        ], 0, _t('当评论者为博主本人不推送'), _t('如果选择“是”，博主本人写的评论将不推送'));
        $form->addInput($isPushBlogger);

        $isDelete = new Typecho_Widget_Helper_Form_Element_Radio('isDelete', [0 => '不删除', 1 => '删除'], 1, _t('卸载是否删除数据表'));
        $form->addInput($isDelete);

        self::qqService($form);
    }

    /**
     * Qmsg酱配置面板
     * @param Typecho_Widget_Helper_Form $form
     */
    private static function qqService(Typecho_Widget_Helper_Form $form)
    {
        $qqServiceTitle = new Typecho_Widget_Helper_Layout('div', ['class=' => 'typecho-page-title']);
        $qqServiceTitle->html('<h2>QQ消息推送--Qmsg酱配置</h2>');
        $form->addItem($qqServiceTitle);

        $qqApiUrl = new Typecho_Widget_Helper_Form_Element_Text('qqApiUrl', NULL, NULL, _t('Qmsg酱接口'), _t("当选择Qmsg酱必须填写,格式为：https://qmsg.zendee.cn/send/您的KEY"));
        $form->addInput($qqApiUrl);

        $receiveQq = new Typecho_Widget_Helper_Form_Element_Text('receiveQq', NULL, NULL, _t('接收消息的QQ，可以添加多个，以英文逗号分割'), _t("当选择Qmsg酱必须填写（指定的QQ必须在您的QQ号列表中）"));
        $form->addInput($receiveQq);
    }


    /**
     * @param Typecho_Widget_Helper_Form $form
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
        // TODO: Implement personalConfig() method.
    }


    public static function pushServiceReady($comment, $active)
    {
        self::$comment = $comment;
        self::$active = $active;

        return $comment;
    }

    public static function pushServiceGo($comment)
    {
        $options = Helper::options();
        $plugin = $options->plugin('Qcomment');

        $services = $plugin->services;

        if (!$services || $services == 'services') return false;


        self::$comment['coid'] = $comment->coid;

        /** @var QQService $service */
        foreach ($services as $service) call_user_func([$service, '__handler'], self::$active, self::$comment, $plugin);
    }
}