<?php

// //按下通过按钮之后审核通过
// require 'database.php';
// set('user', 'id', $_POST['id'], '[isCenscored,1]');
// json_encode([code => 1]);

header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
$id=$_POST["id"]; 
$hasPass=$_POST["hasPass"];
$data=NULL;
 
$pass=array(array("isCensored",1)); 
// $user=get("user","id",$id);
$sql="SELECT user.name,user.phone,user.mail,company.companyName,user.id FROM user LEFT JOIN company ON user.company=company.id WHERE user.id=".$id;
$user=sql_str($sql);
if(!empty($user)){
    $data=$user[0];
    if($hasPass){
        set("user","id",$id,$pass);
    }
    else{
        del("user","id",$id);
    }
}
 
echo json_encode($data,JSON_UNESCAPED_UNICODE);
 // auther：hgz
?>
