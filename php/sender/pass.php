<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../taskStateCheck.php"); 
 
// $state=$_POST["state"];
$taskId=$_POST["taskId"];
$star=$_POST["star"];
$code=0;

$task=get("task","id",$taskId);
$user=get("user","id",$task[0]["userId"]);
$workCount=$user[0]["workCount"]+1;
// ((float)(($user[0]["workCount"]*$user[0]["star"]+$star))/$workCount)
$newStar=round(($user[0]["workCount"]*$user[0]["star"]+$star)/$workCount,1);
$fresh=array(array("workCount",$workCount),array("star",$newStar));
set("user","id",$task[0]["userId"],$fresh);
$changestate=array(array("state",1));
set("task","id",$taskId,$changestate);
$code=1;

$data=array(
    "code"=>$code,                             
);

echo json_encode($data,JSON_UNESCAPED_UNICODE);
 // auther：hgz
?>