<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 

$uuid=$_POST["uuid"];
$taskId=$_POST["taskId"];
$change=array();
$acceptSuccess=NULL;
$data=NULL;
$msg=NULL;

$user=get("user","token",$uuid);
$userId=$user[0]["id"];
$task=get("task","id",$taskId);
if(!empty($task)){
    if($task[0]["state"]==3){
        $change=array(array("state",0),array("userId",$userId));
        $change_success=set("task","id",$taskId,$change);
        $acceptSuccess=true;
        $msg="成功领取任务！";
    }
    else if($task[0]["state"]==0){
        $acceptSuccess=false;
        $msg="该任务已被领取！";
    }
    else if($task[0]["state"]==-1){
        $acceptSuccess=false;
        $msg="该任务已过期！";
    }
    $data=array(
        "acceptSuccess"=>$acceptSuccess,
        "msg"=>$msg
    );
}

echo json_encode($data,JSON_UNESCAPED_UNICODE);
 // auther：hgz
?>