<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
$taskId=$_POST["taskId"]; 
$state=NULL;
$code=0;
$task=array();
//
$workInfo=[];
$originInfo=[];
$taskInfo=[];

$sql="SELECT * FROM task WHERE id=".$taskId;
$task=sql_str($sql);
if(!empty($task)){
    $code=1;
    //
    // $endPoint=strripos($task[0]["workFile"],"/")+1;
    // $endPoint_desctiptionFile = strripos($task[0]["descriptionFile"],"/")+1; //hpc
    // // echo $endPoint;
    // $task[0]["workFile"]=str_replace ("\\","/",$task[0]["workFile"]);
    // $task[0]["descriptionFile"]=str_replace ("\\","/",$task[0]["descriptionFile"]);//hpc
    // // array_push($skillarray,$each['Field']);
    // // $task[0]["workInfo"]["downloadPath"]=$task[0]["workFile"];
    // $task[0]["workInfo"]["downloadPath"]=(string)($task[0]["workFile"]);
    // $task[0]["workInfo"]["workFileName"]= substr($task[0]["workFile"], $endPoint,strlen($task[0]["workFile"])-1);

    // $task[0]["descriptionInfo"]["downloadPath"]=(string)($task[0]["descriptionFile"]);//hpc
    // $task[0]["descriptionInfo"]["descriptionFileName"]= substr($task[0]["descriptionFile"], $endPoint,strlen($task[0]["descriptionFile"])-1);//hpc
    
    // $state=$task[0]["state"];

    // hpc，上面乱七八糟什么鬼东西
    $workInfo["workDescription"] = $task[0]["workDescription"];
    $workInfo["workFile"] = $task[0]["workFile"];
    $splitWorkFile = explode("/",$task[0]["workFile"]);
    $workInfo["fileName"] = $splitWorkFile[count($splitWorkFile)-1];
    $originInfo["description"] = $task[0]["description"];
    $originInfo["descriptionFile"] = $task[0]["descriptionFile"];
    $splitDesFile = explode("/",$task[0]["descriptionFile"]);
    $originInfo["fileName"] = $splitDesFile[count($splitDesFile)-1];
    $taskInfo["taskName"] = $task[0]["taskName"];
    $taskInfo["state"] = $task[0]["state"];
    $taskInfo["securityLevel"] = $task[0]["securityLevel"];
    $taskInfo["skills"]=explode("*",$task[0]["text"]);



}


echo json_encode(array(
    "workInfo"=>$workInfo,
    "originInfo"=>$originInfo,
    "taskInfo"=>$taskInfo,
));
 
?>
