人总是喜欢折腾不满足于现状，就比如我，已经完成了一个博客，但是作为一个前端，我想把博客数据通过接口形式导出，然后可以在别的地方比如小程序，进行调用，或者在后台管理系统中进行展示等等。

这里我得到了我一个朋友的帮助 --- [繁星](https://www.moeor.com)。通过对数据库的折腾，我们总结出了这个整洁的配置。

只需要在你的站点里面新建一个文件 `api.php`, 然后把下面这些配置文件复制进去，然后在最前面写上你的数据库配置，账户，密码，名称等参数即可。

例如我把文件放在了 121.196.166.173 下面，最后的接口链接就是 [http:://121.196.166.173/api.php](http:://121.196.166.173/api.php) ，感兴趣的可以点进去看一下接口格式，然后在前端就可以随意调用这些啦！

是不是很简单呢！可以在评论区留下你的看法。

```php

<?php


header('Content-Type:application/json; charset=utf-8');
header("Access-Control-Allow-Origin:*");

$servername = "localhost";
$username = "username";  // 数据库账户
$password = "password"; // 数据库密码
$dbname = "dbname"; // 数据库名

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "select title,text,created,modified,views,typecho_contents.slug as link ,group_concat(typecho_metas.slug) tags from typecho_contents left join typecho_relationships  on typecho_contents.cid = typecho_relationships.cid left join typecho_metas on
typecho_relationships.mid=typecho_metas.mid where typecho_contents.type='post' group by title
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        
    $data[]=$row;
    
    }
    
    $json = json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);//把数据转换为JSON数据.
    
    
    exit($json) ;

} else {
    echo "未查询到结果！";
}

$conn->close();

```
