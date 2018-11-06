<?php
  header("Content-type:text/html;charset=utf-8");   //洪高泽
  require("database.php");
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];
  $code;

  if($group=="admin"){
    $data=get("administrator","token",$uuid);
    if(!empty($data)){
        $ranuuid=substr(md5(mt_rand(0,1000)),5,16).time();
        set("administrator","token",$uuid,[["token",$ranuuid]]); 
    }                                //退出后随机生成uuid替代防止别人登陆，当登录时再覆盖
  }
  else{
    $data=get("user","token",$uuid);
    if(!empty($data)){
        $ranuuid=substr(md5(mt_rand(0,1000)),5,16).time();
        set("user","token",$uuid,[["token",$ranuuid]]); 
    }                               //退出后随机生成uuid替代防止别人登陆，当登录时再覆盖
  }                                

  $code=empty($data)?0:1;

  echo json_encode(["code"=>$code]);

?>