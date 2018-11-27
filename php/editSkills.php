<?php
  header("Content-type:text/html;charset=utf-8");
  require("database.php");
  $uuid=$_POST["uuid"];
  $group=$_POST["group"];//2
  $addSkills=$_POST["addSkills"];//新的skill，需要创建新的字段，并把这个人的这些字段设置为1
  $newSkills=$_POST["newSkills"];//此人选的全部skill，更新一遍这个人的数据就行。
  ////addSkills[0]==""时不增加addSkills内容到数据库
 
  ?>