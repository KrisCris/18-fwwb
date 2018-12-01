<?php
  header("Content-type:text/html;charset=utf-8");
  require("database.php");
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];
  $portrait="";
  $name="";
  $username="";
  $company="";
  $phone="";
  $mail="";
  //hpc新增加
  $skills=[];//这个人会的skill
  $allSkills=[];//表里全部skill

  if($group=="admin"){                                      //第一级分别是否为管理员
    $data=get("administrator","token",$uuid);               //然后查看是否存在
    if(!empty($data)){                                      //第二级在存在的情况下传出所需参数
        $portrait=$data[0]["portrait"];
        $name=$data[0]["name"];
        $username=$data[0]["username"];
        // $company=$data[0]["company"];
        $phone=$data[0]["phone"];
        $mail=$data[0]["mail"];    
    }
  }

  else{
    $data=get("user","token",$uuid);
    if($group==2){
      $sql="SHOW FULL COLUMNS FROM skill";
      $skills=sql_str($sql); 
      $skilllen=count($skills);
      for($i=1;$i<$skilllen;$i++){
          array_push($allSkills,$skills[$i]['Field']);
      }
      $userSkill=get("skill","userId",$data[0]["id"]);
      if(!empty($userSkill)){
        $skills=array_keys($userSkill[0],"1");
      }
      else{
        $skills=[];
      }
    }
  
    if(!empty($data)){       //第二级多查一下组别是否正常
        $portrait=$data[0]["portrait"];
        $name=$data[0]["name"];
        $username=$data[0]["username"];
        $company=$data[0]["company"];
        $phone=$data[0]["phone"];
        $mail=$data[0]["mail"];    
    }
  }


  echo json_encode(array(
      "portrait"=>$portrait,
      "name"=>$name,
      "username"=>$username,
      "company"=>$company,
      "phone"=>$phone,
      "mail"=>$mail,
      "skills"=>$skills,
      "allSkills"=>$allSkills
  ),JSON_UNESCAPED_UNICODE);

?>