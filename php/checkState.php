<?php
  header("Content-type:text/html;charset=utf-8");
  require("database.php");
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];
  $code;

  if($group==null){
    $data=get("administrator","token",$uuid);
  }
  else{
    $data=get("user","token",$uuid);
  }

  $code=empty($data)?0:1;

  echo json_encode(["code"=>$code]);

?>