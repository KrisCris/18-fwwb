<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
function Directory( $dir ){  
    return  is_dir ( $dir ) or Directory(dirname( $dir )) and  mkdir ( $dir , 0777);
}

$uuid=$_POST["uuid"]; 
$taskId=$_POST["taskId"]; 
$workDescription=$_POST["workDescription"]; 
// $descriptionFile=$_POST["descriptionFile"]; 
$imgname = $_FILES['workFile']['name'];                   //文件名
$tmp = $_FILES['workFile']['tmp_name'];                   //文件...
$code=0;
$task=array();

$user=get("user","token",$uuid);
$sql="SELECT * FROM task WHERE id=".$taskId;
$task=sql_str($sql);
if(!empty($task)){
    $code=1;
    $sql="SELECT prjName,publisherId FROM project WHERE id=".$task[0]["prjId"];
    $prj=sql_str($sql);
    $prjName=$prj[0]["prjName"];
    $taskName=$task[0]["taskName"];
    $receiverName=$user[0]["name"];
    // $sql="SELECT name FROM user WHERE id=".$task[0]["userId"];
    // $user=sql_str($sql);
    $pathFile="../../files/prj/".$prjName."/".$taskName."/"."receiver/".$receiverName."/"; 
    $isbuilt=Directory($pathFile);              //创建多级目录
    if($isbuilt){
        $workFile=$pathFile.$imgname;
        $myfile = fopen($workFile, "w");     //创建多及目录文件                         2步骤
        if(move_uploaded_file($tmp,$workFile)){  //将传入文件导入该文件中
            $code=1;
        }else{
        }
    }
    $resetArr=array(array("workDescription",$workDescription),array("workFile",$workFile),array("state",2),array("userId",$user[0]["id"]));
    $reset=set("task","id",$taskId,$resetArr);
}


echo json_encode(array(
    "code"=>$code,
));
 
?>
