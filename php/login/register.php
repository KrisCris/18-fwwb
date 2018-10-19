<?php
header("Content-type:text/html;charset=utf-8");
require("../database.php");
$name=$_POST["name"];
$username=$_POST["username"];
$password=$_POST["password"];
$phone=$_POST["phone"];
$company=$_POST["company"];
$mail=$_POST["mail"];
$userGroup=$_POST["group"];
$identificationNum=$_POST["identificationNum"];
$facialData=$_POST["facialData"];
$msg="";
$code=0;
$datamsg=null;

// $array[][]=[["name",$name],["username",$username],["password",$password],["phone",$phone],["company",$company],["mail",$mail]]; 这样子会报错的
$array=array(array("name",$name),array("username",$username),array("password",$password),array("phone",$phone),array("company",$company),array("mail",$mail),array("userGroup",$userGroup),array("identificationNum",$identificationNum),array("facialData",$facialData));

$data=get("user","identificationNum",$identificationNum);
$data_admin=get("administrator","identificationNum",$identificationNum);

if(!empty($data)||!empty($data_admin)){
    $json=json_encode(array(
        "code"=> -1,  
        "msg" => "failed",
    ));
    echo $json;
    exit();
}

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