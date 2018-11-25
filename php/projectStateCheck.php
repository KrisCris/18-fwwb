<?php 
header("Content-type:text/html;charset=utf-8"); 
date_default_timezone_set('Asia/Shanghai');
require("database.php"); 
 
$nowtime=time();

$sql="UPDATE project SET state=-1 WHERE prjEnd<=$nowtime AND state!=1";       //更新过期的
sql_str($sql); 

 // auther：hgz
?>