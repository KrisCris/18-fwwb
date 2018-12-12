<?php 
header("Content-type:text/html;charset=utf-8");
require("../database.php"); 
$type=$_POST["type"];
$code=0;
if($type==0){
    $startTime=$_POST["startTime"];
} 
else if($type==1){
    $endTime=$_POST["endTime"];
}
$taskId=$_POST["taskId"];
$uuid=$_POST["uuid"];
$user=get("user","token",$uuid);
if(!empty($user)){
    $userId=$user[0]["id"];
    if($type==0){
        $change=array(array("begin",$startTime),array("userId",$userId),array("taskId",$taskId));
        add("workinfo",$change);
        $code=1;
    }
    else if($type==1){
        $sql="UPDATE workinfo SET end=$endTime WHERE taskId=$taskId AND userId=$userId AND end is null";
        sql_str($sql);
        $code=1;
    }
}
echo json_encode(
    array(
        "code"=>$code
    )
);
 // auther：hgz

?>