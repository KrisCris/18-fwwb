<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 
function Directory( $dir ){  
    return  is_dir ( $dir ) or Directory(dirname( $dir )) and  mkdir ( $dir , 0777);
}

$taskId=$_POST["taskId"]; 
$description=$_POST["description"]; 
// $descriptionFile=$_POST["descriptionFile"]; 
$imgname = $_FILES['descriptionFile']['name'];                   //文件名
$tmp = $_FILES['descriptionFile']['tmp_name'];                   //文件...
$code=0;
$task=array();

if($imgname==NULL){
    echo $json=json_encode(array( 
        "code"=>$code,
    ));
    exit();   
}

$sql="SELECT * FROM task WHERE id=".$taskId;
$task=sql_str($sql);
if(!empty($task)){
    $code=1;
    $sql="SELECT prjName,publisherId FROM project WHERE id=".$task[0]["prjId"];
    $prj=sql_str($sql);
    $prjName=$prj[0]["prjName"];
    $taskName=$task[0]["taskName"];
    $sql="SELECT name FROM user WHERE id=".$prj[0]["publisherId"];
    $sender=sql_str($sql);
    $senderName=$sender[0]["name"];
    // $sql="SELECT name FROM user WHERE id=".$task[0]["userId"];
    // $user=sql_str($sql);
    $pathFile="../../files/prj/".$prjName."/".$taskName."/"."sender/".$senderName."/"; 
    $isbuilt=Directory($pathFile);              //创建多级目录
    if($isbuilt){
        $descriptionFile=$pathFile.$imgname;
        $myfile = fopen($descriptionFile, "w");     //创建多及目录文件                         2步骤
        if(move_uploaded_file($tmp,$descriptionFile)){  //将传入文件导入该文件中
            $code=1;
        }else{
        }
    }
    $resetArr=array(array("description",$description),array("descriptionFile",$descriptionFile),array("state",0));
    $reset=set("task","id",$taskId,$resetArr);
}


echo json_encode(array(
    "code"=>$code,
));
 
?>
