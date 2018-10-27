<?php
  header("Content-type:text/html;charset=utf-8");
  require("database.php");
  $type=$_POST["type"];
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];
  $password=$_POST["password"];
  $newPassword=$_POST["newPassword"];
  $code=0;  //code默认为0

  if($type!="password"&&$type!="facialData"){                                      //如果type类型不是password或者是facialData类型便默认为是恶意攻击，返回code为1，结束php
    echo json_encode($code,JSON_UNESCAPED_UNICODE);
    exit();
  }

  else if($group=="admin"){                                                        //第一级分别是否为管理员
    $data=get("administrator","token",$uuid);
    $exist=(!empty($data))?1:0;                                                    //然后查看是否存在
    if($exist){
        if($data[0]["password"]==$password){                                       //第三级比较密码是否正确，正确插入修改并返回code为1
            set("administrator", "token", $uuid, [[$type,$newPassword]]);
            $code=1;
        }
    }
  }
  else{
    $data=get("user","token",$uuid);
    $exist=(!empty($data))?1:0;
    if($exist){                           
        if($data[0]["password"]==$password){
            set("user", "token", $uuid,[[$type,$newPassword]]);
            $code=1;
        }
    }
  }


  echo json_encode(["code"=>$code],JSON_UNESCAPED_UNICODE);

?>