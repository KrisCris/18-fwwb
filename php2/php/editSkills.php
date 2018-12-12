<?php
  header("Content-type:text/html;charset=utf-8");
  require("database.php");
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];//2
  $addSkills=$_POST["addSkills"];//新的skill，需要创建新的字段，并把这个人的这些字段设置为1
  $newSkills=$_POST["newSkills"];//此人选的全部skill，更新一遍这个人的数据就行。
  ////addSkills[0]==""时不增加addSkills内容到数据库
  $skillArr=array();
  $clearArr=array();
  $data=array();
  $code=0;
  $hasId=NULL;
 
  $user=get("user","token",$uuid);
  if(empty($user)){
    $data=array(
      "code"=>$code
    );
    echo json_encode($data);  
    exit();
  }
  $code=1;
  if($addSkills[0]==""){
  }
  else{
    foreach($addSkills as $each){ 
      if(!empty($each)){
          $sql="ALTER TABLE skill ADD"." ".$each." "."varchar(255) NOT NULL"; 
          sql_str($sql); 
          $skill=array($each,"1");
          array_push($skillArr,$skill); 
      }
    } 
  }
  foreach($newSkills as $each){ 
    if(!empty($each)){
        $skill=array($each,"1");
        array_push($skillArr,$skill); 
    }
  } 
  $hasId=get("skill","userId",$user[0]["id"]);
  if(!empty($hasId)){
    $sql="SHOW FULL COLUMNS FROM skill";
    $skills=sql_str($sql);
    $count=count($skills);
    for($i=1;$i<$count;$i++){
      $skillkey_value=array($skills[$i]["Field"],"0");
      array_push($clearArr,$skillkey_value);
    }
    set("skill","userId",$user[0]["id"],$clearArr);
    set("skill","userId",$user[0]["id"],$skillArr);
  }
  else{
    $id=array("userId",$user[0]["id"]);
    array_push($skillArr,$id);
    add("skill",$skillArr);
  }
  $data=array(
    "code"=>$code
  );
  echo json_encode($data); 
  ?>