<?php 
header("Content-type:text/html;charset=utf-8"); 
require("database.php"); 
 
$nowtime=time();

$sql="UPDATE task SET state=-1 WHERE endTime<=$nowtime";
sql_str($sql); 

 // auther：hgz
?>