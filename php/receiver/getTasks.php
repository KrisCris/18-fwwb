<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 

$uuid=$_POST["uuid"]; 
$group=$_POST["group"];
$state=$_POST["state"];
$code=0; 

$data=get("user","token",$uuid);      

if(!empty($data)){ 
    $sql="SELECT task.taskName,task.startTime,task.endTime,task.securityLevel,task.state,project.prjName,task.id FROM task INNER JOIN project WHERE task.prjId=project.id AND task.state=".$state." AND task.userId=".$data[0]['id']." ORDER BY task.endTime";
    $personaltask=sql_str($sql);
    $code=1;
} 
 
else{ 
} 
 
if($code==1){
    $json=json_encode(array( 
        "code"=>$code,
        "tasks"=>$personaltask,
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
