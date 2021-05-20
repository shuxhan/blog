<?php
/**
 * @author shuxhan <shuxhan@163.com>
 */

require_once 'Service.php';

class QQService extends Service
{
    public function __handler($active, $comment, $plugin)
    {
        try {
            $isPushBlogger = $plugin->isPushBlogger;
            if ($comment['authorId'] == 1 && $isPushBlogger == 1) return false;

            $qqApiUrl = $plugin->qqApiUrl;
            $receiveQq = $plugin->receiveQq;

            if (empty($qqApiUrl) || empty($receiveQq)) throw new \Exception('缺少Qmsg酱配置参数');

            $title = $active->title;
            $author = $comment['author'];
            $email = $comment['mail'];
            $link = $active->permalink;
            $context = $comment['text'];
            $date = new Typecho_Date(Typecho_Date::gmtTime());
            $time = $date->format('Y年m月d日 H:i:s');
      
            
            if(substr($context,0,26)=='{!{data:image/webp;base64,'){
                     $context = '#图片消息';
            }

            $template =  $time . PHP_EOL
                . '文章：' . $title . PHP_EOL
                . '评论人：' . $author . PHP_EOL
                . '评论内容：' . '【' . $context . '】' . PHP_EOL
                . PHP_EOL
                . '链接：' . $link . '#comment-' . $comment['coid'] . PHP_EOL
                . '邮箱：' . $email . PHP_EOL
                . 'IP地址：' . $comment['ip'];
                

            $params = [
                'qq' => $receiveQq,
                'msg' => $template
            ];

            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($params)
                ]
            ]);

            $result = file_get_contents($qqApiUrl, false, $context);
            self::logger(__CLASS__, $receiveQq, $params, $result);
        } catch (\Exception $exception) {
            self::logger(__CLASS__, '', '', '', $exception->getMessage());
        }
    }


}