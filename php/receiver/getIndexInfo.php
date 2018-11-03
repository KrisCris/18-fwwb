<?php 
header("Content-type:text/html;charset=utf-8");  
require("../taskStateCheck.php"); 

$uuid=$_POST["uuid"]; 
$group=$_POST["group"];
$code=0; 
$checktime=strtotime("+3 day");
$data=get("user","token",$uuid);      

if(!empty($data)){ 
    $name=$data[0]["name"];
    $portrait=$data[0]["portrait"];
    $sql="SELECT task.taskName,task.startTime,task.endTime,task.securityLevel,task.state,project.prjName,task.id FROM task INNER JOIN project WHERE task.prjId=project.id AND task.endTime<=".$checktime." AND task.userId=".$data[0]['id']." ORDER BY task.endTime";
    $personaltask=sql_str($sql);

    if(!empty($personaltask)){
        $code=1;
        $checkNum=0;
        $recentNum=0;
        $delayNum=0;
        foreach($personaltask as $each){
            if($each["state"]==2){
                $checkNum++;
            }
            else if($each["state"]==-1){
                $delayNum++;
            }
            else if($each["state"]==0){
                $recentNum++;
            }
        }
    }
} 
 
else{ 
} 
 
if($code==1){
    $json=json_encode(array( 
        "code"=>$code,
        "tasks"=>$personaltask,
        "name"=>$name,
        "portrait"=>$portrait,
        "checkNum"=>$checkNum,
        "delayNum"=>$delayNum,
        "recentNum"=>$recentNum
    ),JSON_UNESCAPED_UNICODE); 
}
else{
    $json=json_encode(array( 
        "code"=>$code,
    ));  
}
echo $json; 
 // auther：hgz
?>
