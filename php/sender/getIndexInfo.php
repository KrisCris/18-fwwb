<?php   
header("Content-type:text/html;charset=utf-8");  
date_default_timezone_set('Asia/Shanghai');   
require("../taskStateCheck.php");   
  
$uuid=$_POST["uuid"];   
$group=$_POST["group"];  
$code=0;  
$portrait=NULL; 
$name=NULL; 
$checkNum=0; 
$delayNum=0; 
$workingNum=0; 
$acceptNum=0; 
$number=array(); 
$chart=array(); 
$pendingTasks=array(); 
$delayTasks=array(); 
$taskArr=array();
  
$user=get("user","token",$uuid);     
if(!empty($user)){
    $code=1;  
    $portrait=$user[0]["portrait"];
    $name=$user[0]["name"];
    $sql="SELECT id FROM project WHERE publisherId=".$user[0]['id']; 
    $projectId=sql_str($sql); 
    foreach($projectId as $each){ 
        $sql="SELECT * FROM task WHERE task.prjId=".$each['id']." ORDER BY task.endTime"; 
        $tasks=sql_str($sql); 
        if(!empty($tasks)){ 
            // $count=0; 
            // foreach($tasks as $each){ 
            //     if($each["userId"]!=NULL){
            //         $sql="SELECT name FROM user WHERE id=".$each["userId"]; 
            //         $getName=sql_str($sql); 
            //         $tasks[$count]["receiver"]=$getName[0]["name"];
            //     }

            //     else{
            //         $tasks[$count]["receiver"]="";
            //     }
            //     $count++; 
            // } 
            // // array_push($taskArr,$tasks); 
             
            $taskArr = array_merge($taskArr,$tasks);  
        } 
    } 
    foreach($taskArr as $each){
        if($each["state"]==2){
            $checkNum++;
        }
        else if($each["state"]==-1){
            $project=get("project","id",$each["prjId"]);
            $receiver=get("user","id",$each["userId"]);
            // $receiver=isset($receiver[0]["name"])?$receiver[0]["name"]:"无人接包";
            // $receiver=(!empty($each["userId"]))?$receiver[0]["name"]:"无人接包";
            if(strpos($each["userId"], '*')==false&&!empty($each["userId"])){
                $receiver=$each["userId"];
            }
            else{
                $receiver="无人接包";
            }
            $task=array(
                "taskName"=>$each["taskName"],
                "id"=>$each["id"],
                "prjName"=>$project[0]["prjName"],
                "worker"=>$receiver
            );
            array_push($delayTasks,$task);
            $delayNum++;
        }
        else if($each["state"]==0){
            $workingNum++;
        }
        else if($each["state"]==1){
            $acceptNum++;
        }
        else if($each["state"]==3){
            $project=get("project","id",$each["prjId"]);
            $task=array(
                "taskName"=>$each["taskName"],
                "id"=>$each["id"],
                "prjName"=>$project[0]["prjName"],
                "endTime"=>$each["endTime"]
            );
            array_push($pendingTasks,$task);
        }
    }
    $number=array(
        "checkNum"=>$checkNum,
        "delayNum"=>$delayNum,
        "workingNum"=>$workingNum
    );
    $chart=array(
        "pendingTasks"=>$pendingTasks,
        "delayTasks"=>$delayTasks,
    );
}   
$json=array(   
    "code"=>$code,  
    "number"=>$number, 
    "chart"=>$chart, 
    "acceptNum"=>$acceptNum,
    "name"=>$name,
    "portrait"=>$portrait
);     
  
echo json_encode($json,JSON_UNESCAPED_UNICODE);   
 // auther：hgz  
?>  
