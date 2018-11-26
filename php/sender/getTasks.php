<?php  
header("Content-type:text/html;charset=utf-8"); 
date_default_timezone_set('Asia/Shanghai');  
require("../taskStateCheck.php");  
 
$uuid=$_POST["uuid"];  
$group=$_POST["group"]; 
$state=$_POST["state"]; 
$code=0;  
$taskArr=array(); 
 
$user=get("user","token",$uuid);    
if(!empty($user)){ 
    $sql="SELECT id FROM project WHERE publisherId=".$user[0]['id']; 
    $projectId=sql_str($sql); 
    $nameArr=array(); 
    $taskList=array(); 
    foreach($projectId as $each){ 
        $sql="SELECT task.taskName,task.id,task.startTime,task.endTime,task.securityLevel,task.state,project.prjName,task.userId FROM task INNER JOIN project WHERE task.prjId=project.id AND task.state=".$state." AND project.id=".$each['id']." ORDER BY task.endTime"; 
        $tasks=sql_str($sql); 
        if(!empty($tasks)){ 
            $count=0; 
            foreach($tasks as $each){ 
                if($each["userId"]!=NULL){
                    $sql="SELECT name FROM user WHERE id=".$each["userId"]; 
                    $getName=sql_str($sql); 
                    $tasks[$count]["receiver"]=$getName[0]["name"];
                }

                else{
                    $tasks[$count]["receiver"]="";
                }
                $count++; 
            } 
            // array_push($taskArr,$tasks); 
             
            $taskArr = array_merge($taskArr,$tasks);  
        } 
    } 
     
    $code=1; 
}  
$json=array( 
    "tasks"=>$taskArr, 
    "code"=>$code 
);    
 
echo json_encode($json,JSON_UNESCAPED_UNICODE);  
 // auther：hgz 
?> 
