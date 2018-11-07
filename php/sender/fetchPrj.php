<?php 
header("Content-type:text/html;charset=utf-8");
require("../database.php"); 

$state=$_POST["state"]; 
$projects=array();
$imgSource="";
$percentage="";
$begin="";
$end="";
$projectId="";
$code=0;
$msg=1;

$prj=get("project","state",$state);

if(!empty($prj)){
    $code=1;
    foreach($prj as $project){
        $msg=1;
        $percentage=0;
        $projectId=$project["id"];
        $begin=$project["prjBegin"];
        $end=$project["prjEnd"];
        $imgSource=$project["img"];
        $taskList=get("task","prjId",$projectId);
        if($state==1){
            $percentage="100%";
        }
        else if(empty($taskList)){
            $msg=0;
            $percentage="0%";
        }
        else{
            $count=count($taskList);
            $successNum=0;
            foreach($taskList as $task){
                if($task["state"]==1){
                    $successNum++;
                }
            }
            $percentage=round(($successNum/$count*100),2)."%";
        }
        $prj=array(
            "msg"=>$msg,      //0为没有数据
            "projectId"=>$projectId,
            "begin"=>$begin,
            "end"=>$end,
            "imgSource"=>$imgSource,
            "percentage"=>$percentage
        );
        array_push($projects,$prj);

    }
    
}
$data=array(
    "code"=>$code,                             //0为没项目，1为有项目
    "projects"=>$projects
);

echo json_encode($data,JSON_UNESCAPED_UNICODE);
 // auther：hgz

?>