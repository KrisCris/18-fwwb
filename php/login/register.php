<?php
header("Content-type:text/html;charset=utf-8");
require("../database.php");
$name=$_POST["name"];
$username=$_POST["username"];
$password=$_POST["password"];
$phone=$_POST["phone"];
$company=$_POST["company"];
$mail=$_POST["mail"];
$group;
$identificationNum=$_POST["identificationNum"];
$facialData=$_POST["facialData"];
$msg="";
$code=0;
if($company == -1)  $group = 1;
else    $group = 2;
$array=array(array("name",$name),array("username",$username),array("password",$password),array("phone",$phone),array("company",$company),array("mail",$mail),array("userGroup",$group),array("identificationNum",$identificationNum),array("facialData",$facialData));

$data=get("user","username",$username);
$data_admin=get("administrator","username",$username);
if(!empty($data)||!empty($data_admin)){
    $code=-2;
    $msg="failed";
}

else{
    add("user",$array);  //如果不存在于任意一张表中，则插入user表中
    $code=1;
    $msg="success";
}

$json=json_encode(array(
    "code"=>$code,  
    "msg" => $msg,
));
echo $json;

?>