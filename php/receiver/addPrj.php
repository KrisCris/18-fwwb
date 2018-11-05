<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
$uuid=$_POST["uuid"]; 
$php=$_POST["php"]; 
$vue=$_POST["vue"]; 
$usermsg=get("user","token",$uuid);
$code=0;

if(!empty($usermsg)){
    $id=$usermsg[0]["id"];
    $userskill=get("skill","userId",$id);
    if(empty($userskill)){
        $skillarray=array(array("userId",$id),array("php",$php),array("vue",$vue));
        add("skill",$skillarray);
        $code=1;
    }
}
echo json_encode(array(
    "code"=>$code,
));
 
?>