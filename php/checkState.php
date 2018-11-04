<?php
  header("Content-type:text/html;charset=utf-8");
  require("database.php");
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];
  $code=0;

  if($group=="admin"){
    $data=get("administrator","token",$uuid);
    $code=empty($data)?0:1;
  }
  else{
    $data=get("user","token",$uuid);
    if(!empty($data)){
      if($data[0]["userGroup"]==$group){
        $code=1;
      }
    }
  }

  echo json_encode(["code"=>$code]);
// auther：hgz
?>
