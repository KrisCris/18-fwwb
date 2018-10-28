<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
$companyName=$_POST["companyName"]; 
$regDate=$_POST["regDate"]; 
$responsiblePerson=$_POST["responsiblePerson"]; 
$address=$_POST["address"]; 
$contact=$_POST["contact"]; 
 
$code=0; 
 
$array=array(array("companyName",$companyName),array("regDate",$regDate),array("responsiblePerson",$responsiblePerson),array("address",$address),array("contact",$contact)); 
 
$data=get("company","companyName",$companyName);      //通过对比公司名称来判断是否重复输入
 
if(!empty($data)){ 
    $code=0; 
} 
 
else{ 
    add("company",$array);   
    $code=1; 
} 
 
$json=json_encode(array( 
    "code"=>$code,   
)); 
echo $json; 
 
?>