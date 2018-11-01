<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
$uuid=$_POST["uuid"]; 
$usermsg=get("user","token",$uuid);

if(!empty($usermsg)){
    $id=$usermsg[0]["id"];
    $userskill=get("skill","userID",$id);
    if(!empty($userskill)){
        echo json_encode($userskill);
    }
} 
 
?>