<?php 
header("Content-type:text/html;charset=utf-8");
require("../database.php"); 
$taskId = $_POST["taskId"];

$prj= [];
$task = [];
$work = [];

$split="";
$code = 0;

$taskLog = get("task","id",$taskId);
if(!empty($taskLog)){
    $prjLog = get("project","id",$taskLog[0]["prjId"]);
    if(!empty($prjLog)){
        $split = explode("/",$prjLog[0]["demandPath"]);
        $prj["prjName"] = $prjLog[0]["prjName"];
        $prj["prjDescription"] = $prjLog[0]["description"];
        $prj["prjFile"] = $prjLog[0]["demandPath"];
        $prj["prjFileName"] = $split[count($split)-1];

        $split = explode("/",$taskLog[0]["descriptionFile"]);
        $task["taskName"] = $taskLog[0]["taskName"];
        $task["taskDescription"] = $taskLog[0]["description"];
        $task["skills"] = explode("*",$taskLog[0]["text"]);
        $task["taskFile"] = $taskLog[0]["descriptionFile"];
        $task["taskFileName"] = $split[count($split)-1];
        $task["state"] = $taskLog[0]["state"];

        $split = explode("/",$taskLog[0]["workFile"]);
        $work["workDescription"] = $taskLog[0]["workDescription"];
        $work["workFile"] = $taskLog[0]["workFile"];
        $work["workFileName"] = $split[count($split)-1];

        $code = 1;
    }
}
echo json_encode(["code"=>$code,"prj"=>$prj,"task"=>$task,"work"=>$work]);
?>