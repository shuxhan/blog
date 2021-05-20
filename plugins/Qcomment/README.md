# Qcomment

专注于QQ推送，博客评论实时通知到QQ，基于Typecho博客评论，进行QQ推送的一个小插件。

## 使用方法

- 插件目录名字必须为 `Qcomment` 。
- 把 `Qcomment` 整个目录拷贝到 `Typecho` 安装路径的 `/usr/plugins` 下面
- 登录 `Typecho` 后台，启用插件，进行插件设置。
- 目前支持推送功能：评论QQ推送。
- 推送日志记录。

## 使用须知

当前插件需要使用`file_get_contents`函数，有些集成环境会关闭`allow_url_fopen`，需要把这个设置为`On`。

*宝塔面板用户请忽略，已默认开启。*

## 数据库适配

- 支持Pdo_Mysql
- 支持Pdo_SQLite

## 推送服务

[QQ推送--Qmsg酱](https://qmsg.zendee.cn)

## 其它

有 `bug` 直接提 `issue`

或者

[博客留言](https://shuxhan.com/comments)

## License

[LICENSE](LICENSE)

## other

如果觉得好用的话，可以点个 star 支持一下作者，三克油。