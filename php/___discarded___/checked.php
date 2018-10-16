<?php

$checked=$_POST[""];
// $name=$_POST["name"];
// $userName=$_POST["userName"];
// $password=$_POST["password"];
// $gender=$_POST[""];
// $phoneNUm=$_POST["phoneNum"];
// $company=$_POST[""];
// $eMail=$_POST["eMail"];

header("Content-type:text/html;charset=utf-8");

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("my_db", $con);

if($checked==true){
    $sql="INSERT INTO user() VALUE()";
    try{
        if (!mysql_query($a,$b)){
            throw new Exception("上传表单失败！");
        }
        $sql="DELETE FROM adiministrators WHERE name=''";
        try{
            if (!mysql_query($a,$b)){
                throw new Exception("删除失败！");
            }
        }
        catch(Exception $e){
            echo $e.getMessage();
        }
    }
    catch(Exception $ex){
        echo $ex.getMessage();
    }
}
if($checked==false){
    $sql="DELETE FROM adiministrators WHERE name=''";
    try{
        if (!mysql_query($a,$b)){
            throw new Exception("删除失败！");
        }
    }
    catch(Exception $e){
        echo $e.getMessage();
    }
}

// function catchmiss($a,$b){
//     if (!mysql_query($a,$b))
//     {
//       die('Error: ' . mysql_error());
//     }
//     mysql_query($a,$b);
// }

mysql_close($con)
?>