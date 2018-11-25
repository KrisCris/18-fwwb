<?php 
header("Content-type:text/html;charset=utf-8"); 
date_default_timezone_set('Asia/Shanghai');
require("database.php"); 
 
$nowtime=time();

$sql="UPDATE task SET state=-1 WHERE endTime<=$nowtime AND state!=1";       //更新过期的
sql_str($sql); 

// $sql="UPDATE task SET state=3 WHERE state=0 AND userId is null";       //没人接的任务state置为3
// sql_str($sql); 
 // auther：hgz
?>