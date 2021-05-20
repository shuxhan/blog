<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 留言加@
function getPermalinkFromCoid($coid) {
	$db = Typecho_Db::get();
	$row = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
	if (empty($row)) return '';
	return '<a href="#comment-'.$coid.'">@'.$row['author'].'</a>';
}

// 主题设置
function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 可以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
}

// 字数统计
function  art_count ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    echo mb_strlen($text,'UTF-8');
}

// 当前在线人数
function online_users() {
    $filename='online.txt'; //数据文件
    $cookiename='Nanlon_OnLineCount'; //Cookie名称
    $onlinetime=30; //在线有效时间
    $online=file($filename); 
    $nowtime=$_SERVER['REQUEST_TIME']; 
    $nowonline=array(); 
    foreach($online as $line){ 
        $row=explode('|',$line); 
        $sesstime=trim($row[1]); 
        if(($nowtime - $sesstime)<=$onlinetime){
            $nowonline[$row[0]]=$sesstime;
        } 
    } 
    if(isset($_COOKIE[$cookiename])){
        $uid=$_COOKIE[$cookiename]; 
    }else{
        $vid=0;
        do{
            $vid++; 
            $uid='U'.$vid; 
        }while(array_key_exists($uid,$nowonline)); 
        setcookie($cookiename,$uid); 
    } 
    $nowonline[$uid]=$nowtime;
    $total_online=count($nowonline); 
    if($fp=@fopen($filename,'w')){ 
        if(flock($fp,LOCK_EX)){ 
            rewind($fp); 
            foreach($nowonline as $fuid=>$ftime){ 
                $fline=$fuid.'|'.$ftime."\n"; 
                @fputs($fp,$fline); 
            } 
            flock($fp,LOCK_UN); 
            fclose($fp); 
        } 
    } 
    echo "在线人数：$total_online"; 
} 
//加载耗时
function timer_start() {
    global $timestart;
    $mtime     = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime     = explode( ' ', microtime() );
    $timeend   = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision );
    $r         = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    if ( $display ) {
        echo "加载耗时：$r";
    }
    return "加载耗时：$r";
}  
    

// 访问量统计
function theAllViews(){
    $db = Typecho_Db::get();
    $row = $db->fetchAll('SELECT SUM(VIEWS) FROM `typecho_contents`');
        echo '访问量：',number_format($row[0]['SUM(VIEWS)']);
} 

// 最热文章调用
function getHotComments($limit = 10){
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post')
        ->limit($limit)
        ->order('commentsNum', Typecho_Db::SORT_DESC)
    );
    if($result){
        foreach($result as $val){
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
            $post_title = htmlspecialchars($val['title']);
            $permalink = $val['permalink'];
            echo '<li><a href="'.$permalink.'" title="'.$post_title.'" target="_blank">'.$post_title.'</a></li>';
        }
    }
}

