<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 

// username: that.username,
// name: that.name,
// phone: that.phone,
// mail: that.mail,

//洪高泽

$username=$_POST["username"];                  
$name=$_POST["name"]; 
$phone=$_POST["phone"]; 
$mail=$_POST["mail"]; 
$isCensored=1;
$company=-1;
$userGroup=1;
$password=111111;                             //默认密码6个1
 
$code=0; 
 
$array=array(array("company",$company),array("username",$username),array("name",$name),array("phone",$phone),array("mail",$mail),array("password",$password),array("isCensored",$isCensored),array("userGroup",$userGroup)); 
 
$data=get("user","username",$username);      //通过用户名验证是否重复
$data_admin=get("administrator","username",$username); 

if(!empty($data)||!empty($data_admin)){ 
    $code=0; 
} 
 
else{ 
    add("user",$array);   
    $code=1; 
} 
 
$json=json_encode(array( 
    "code"=>$code,   
)); 
echo $json; 
 
?>