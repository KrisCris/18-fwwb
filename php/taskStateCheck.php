<?php 
header("Content-type:text/html;charset=utf-8"); 
date_default_timezone_set('Asia/Shanghai');
require("database.php"); 
 
$nowtime=time();

$sql="UPDATE task SET state=-1 WHERE endTime<=$nowtime";
sql_str($sql); 

 // auther：hgz
?>