---
title: typecho评论通知到QQ的插件
date: 2021/04/26 17:45:00
updated: 2021/04/26 21:15:42
author: 子舒
categories: 
  - 编程技术
tags: 
  - 博客
  - 插件
---


**下载地址**

* github仓库: [https://github.com/shuxhan/Qcomment](https://github.com/shuxhan/Qcomment)
* gitee仓库: [https://gitee.com/shuxhan/Qcomment](https://gitee.com/shuxhan/Qcomment)
* 如果觉得仓库下载速度太慢，可以[点击直接下载](https://pan.shuxhan.com/down.php/51dae9f5817f5a3d0497181b9e740c25.zip)

---

简单说一下，这个插件是基于 qmsg酱 开发的 typecho 插件，目的是在博客收到评论时可以通过QQ提醒博主。

之前我只使用了邮件推送，但是不知道为什么，我的网易邮箱总是不能及时提醒我，手机权限也打开了，找不到原因，索性另外开辟一条道路，然后就找到了类似的插件，但是都很臃肿，里面写的东西很复杂。

我就想自己精简一下，把主要的功能剔除出去，只留下了QQ提醒，而我目前就在使用这款插件。

当有人在博客留言时，我就会收到下面这种信息,

```html
标题：留言
IP地址：xxx.xx.xx.xxx
评论人：shuxhan
邮箱：shuxhan@163.com
评论内容：123
链接：https://shuxhan.com/comments#comment-62
```

如图：

![](https://cdn.jsdelivr.net/gh/shuxhan/pic-cdn@76e54511e561d6dd4e18434150a8c47015e59838/2021/04/26/f34a1dfea3058a703e0f575c5000ddab.png)

如果想更改收到的信息格式可以在 `/Qcomment/lib/QQService.php` 文件的 `31行` 注释掉不想收到的信息。

```js
 $template = '标题：' . $title . PHP_EOL
  . 'IP地址：' . $comment['ip'] . PHP_EOL
  . '评论人：' . $author . PHP_EOL
  . '邮箱：' . $email . PHP_EOL
  . '评论内容：' . $context . PHP_EOL
  . '链接：' . $link . '#comment-' . $comment['coid'];
```

其他具体使用方法，都已经详细写在了上面的链接里，使用前可以阅读。



