<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
 
$uuid=$_POST["uuid"];
$user=get("user","token",$uuid);
$newSkill=array();
$userIdArr=array("userId",$user[0]["id"]);
array_push($newSkill,$userIdArr);

$sql="SHOW FULL COLUMNS FROM skill";
$skills=sql_str($sql); 
$code=0;
$data=array();
$skillarray=array();
foreach($skills as $each){
    array_push($skillarray,$each['Field']);
}

foreach($skillarray as $each){
    $value=isset($_POST[$each])?$_POST[$each]:0;
    $skillArr=array($each,$value);
    array_push($newSkill,$skillArr);
}

$skillSearch=get("skill","userId",$user[0]["id"]);
if(!empty($skillSearch)){
    set("skill","userId",$user[0]["id"],$newSkill);
}

else{
    add("skill",$newSkill);
}

$data=array(
    "code"=>$code
);
echo json_encode($data,JSON_UNESCAPED_UNICODE);  
 // auther：hgz
?>