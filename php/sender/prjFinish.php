<?php 
header("Content-type:text/html;charset=utf-8");
require("../database.php"); 

$prjId=$_POST["prjId"]; 
$code=0;

$prj=get("project","id",$prjId);

if(!empty($prj)){  
    $code=1;
    // $change=array("state",1);
    // set("project","id",$prjId,$change);
    $sql="UPDATE project SET state=1 WHERE id=".$prjId;    //set函数出错了？
    sql_str($sql);
}
$data=array(
    "code"=>$code,                             //0为没项目，1为有项目
);

echo json_encode($data,JSON_UNESCAPED_UNICODE);
 // auther：hgz

?>