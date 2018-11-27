<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
$taskId=$_POST["taskId"]; 
$state=NULL;
$code=0;
$task=array();

$sql="SELECT taskName,workDescription,state,workFile FROM task WHERE id=".$taskId;
$task=sql_str($sql);
if(!empty($task)){
    $code=1;
    $endPoint=strripos($task[0]["workFile"],"/")+1;
    // echo $endPoint;
    $task[0]["workFile"]=str_replace ("\\","/",$task[0]["workFile"]);
    // array_push($skillarray,$each['Field']);
    // $task[0]["workInfo"]["downloadPath"]=$task[0]["workFile"];
    $task[0]["workInfo"]["downloadPath"]=(string)($task[0]["workFile"]);
    $task[0]["workInfo"]["workFileName"]= substr($task[0]["workFile"], $endPoint,strlen($task[0]["workFile"])-1);
    $state=$task[0]["state"];
}


echo json_encode(array(
    "code"=>$code,
    "task"=>$task,
    "state"=>$state
));
 
?>
