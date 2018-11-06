<?php
  header("Content-type:text/html;charset=utf-8");
  require("database.php");
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];
  $category=$_POST["category"];
  $value=$_POST["value"];
  $code=0;

  if($group=="admin"){                                                       //第一级分别是否为管理员
    $data=get("administrator","token",$uuid);                                //然后查看是否存在
    $exist=(!empty($data))?1:0;
    if($exist&&($category=="mail"||$category=="phone")){                     //第二级在用户存在情况下限定category类型
        set("administrator", "token", $uuid, [[$category,$value]]);          //修改并返回code为1
        $code=1;
    }
  }
  else{
    $data=get("user","token",$uuid);
    $exist=(!empty($data))?1:0;
    if($exist&&($category=="mail"||$category=="phone")){
      set("user", "token", $uuid,[[$category,$value]]);
      $code=1;                                                             
    }
  }


  echo json_encode(["code"=>$code],JSON_UNESCAPED_UNICODE);
// auther：hgz
?>
