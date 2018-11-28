<?php

header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 

$sql="SHOW FULL COLUMNS FROM skill";
$skills=sql_str($sql);
$count=count($skills); 
$skillArr=array();
$skillCatch=array();
$skillSet=array();
$uuid=$_POST["uuid"];
$user=get("user","token",$uuid);
if(!empty($skills)){
    for($i=1;$i<$count;$i++){
        array_push($skillArr,$skills[$i]["Field"]);
    }
    if(!empty($skillArr)){
        $count=0;
        foreach($skillArr as $each){
            $skillCatch[$skillArr[$count]]=$_POST[$skillArr[$count]];
            $count++;
        }
    } 
    for($i=0;$i<$count;$i++){
        $task=array($skillArr[$i],$skillCatch[$skillArr[$i]]);
        array_push($skillSet,$task);
        $hasId=get("skill","userId",$user[0]["id"]);
        if($hasId){
            set("skill","userId",$user[0]["id"],$skillSet);
        }
        else{
            $id=array("userId",$user[0]["id"]);
            array_push($skillSet,$id);
            add("skill",$skillSet);
        }
    }
}
 
echo json_encode($skillSet,JSON_UNESCAPED_UNICODE);
 // auther：hgz
?>
