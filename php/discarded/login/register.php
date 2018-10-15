<?php
header("Content-type:text/html;charset=utf-8");
$name=$_POST["name"];
$userName=$_POST["userName"];
$password=$_POST["password"];
// $gender=$_POST[""];
$phoneNUm=$_POST["phoneNum"];
$company=$_POST["company"];
$eMail=$_POST["mail"];
$con = mysql_connect("localhost","root","root");
$issuccess="success";
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("my_db", $con);

$sql='INSET INTO adiministrators (name,userName,password,phoneNUm,company,eMail) VALUE($name,$userName,$password,$phoneNUm,$company,$eMail)'; 

try{
  if (!mysql_query($sql,$con)){
    throw new Exception("你已提交注册申请！");
  }
}
catch(Exception $e){
  $errMsg=$e->getMessage();
  $issuccess="failed";
}

// if (!mysql_query($sql,$con))
//   {
//   die('Error: ' . mysql_error());
//   }
function decodeUnicode($str)
    {
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
    }
$json=decodeUnicode(json_encode(array(
    "status" => $issuccess,
    "errMsg" => $errMsg
)));
echo $json;
mysql_close($con)
?>