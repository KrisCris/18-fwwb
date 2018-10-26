<?php
  header("Content-type:text/html;charset=utf-8");
  require("database.php");
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];
  $img="";
  $name="";
  $username="";
  $company="";
  $phone="";
  $mail="";

  if($group=="admin"){                                      //第一级分别是否为管理员
    $data=get("administrator","token",$uuid);               //然后查看是否存在
    if(!empty($data)){                                      //第二级在存在的情况下传出所需参数
        $img=$data[0]["facialData"];
        $name=$data[0]["name"];
        $username=$data[0]["username"];
        // $company=$data[0]["company"];
        $phone=$data[0]["phone"];
        $mail=$data[0]["mail"];    
    }
  }

  else{
    $data=get("user","token",$uuid);
    if(!empty($data)&&$data[0]["userGroup"]==$group){       //第二级多查一下组别是否正常
        $img=$data[0]["facialData"];
        $name=$data[0]["name"];
        $username=$data[0]["username"];
        $company=$data[0]["company"];
        $phone=$data[0]["phone"];
        $mail=$data[0]["mail"];    
    }
  }


  echo json_encode(array(
      "img"=>$img,
      "name"=>$name,
      "username"=>$username,
      "company"=>$company,
      "phone"=>$phone,
      "mail"=>$mail
  ),JSON_UNESCAPED_UNICODE);

?>