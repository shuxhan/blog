<?php
/**
 * @author shuxhan <shuxhan@163.com>
 * @link https://shuxhan.com
 */

class Qcomment_Action extends Typecho_Widget implements Widget_Interface_Do
{
    public function action()
    {
        // TODO: Implement action() method.
    }

    public static function officialAccount()
    {
        $options = Helper::options();

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET["echostr"];


        $token = $options->plugin('Qcomment')->officialAccountToken;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            echo $echostr;
        } else {
            echo false;
        }
    }
}