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
        // $catemsg='"'.$category.'"';
        set("administrator", "token", $uuid, [[$category,$value]]);          //修改并返回code为1
        $code=1;
    }
  }
  else{
    $data=get("user","token",$uuid);
    $exist=(!empty($data))?1:0;
    if($exist){                                                             //第二级确定用户是否存在
        $hasgroup=($data[0]["userGroup"]==$group)?1:0;
        if($hasgroup&&($category=="mail"||$category=="phone")){             //第三级多查一下组别是否正常以及限定category类型
            set("user", "token", $uuid,[[$category,$value]]);
            $code=1;
        }
    }
  }


  echo json_encode($code,JSON_UNESCAPED_UNICODE);

?>