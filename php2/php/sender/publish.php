<?php 
header("Content-type:text/html;charset=utf-8");
require("../database.php"); 
function Directory( $dir ){  
    return  is_dir ( $dir ) or Directory(dirname( $dir )) and  mkdir ( $dir , 0777);
}


// formData.append("file",file);
// formData.append("description",that.description);
// formData.append("title",that.title);
// formData.append("startTime",that.bd);
// formData.append("endTime",that.ed);
// formData.append("img",that.img);
// formData.append("uuid",that.uuid); 
// $taskId=$_POST["taskId"]; 

$title=$_POST["title"]; 
$startTime=$_POST["startTime"]/1000; 
$endTime=$_POST["endTime"]/1000; 
$description=$_POST["description"]; 
$img=$_POST["img"]; 
$uuid=$_POST["uuid"];
$hasFile=$_POST["hasFile"];
if($hasFile){
    $imgname = $_FILES['file']['name'];                   //文件名
    $tmp = $_FILES['file']['tmp_name'];                   //文件...
}
$code=0;
$exist=0;
$prjId=NULL;


$user=get("user","token",$uuid);
$userId=$user[0]["id"];
$pathFile="../../files/prj/".$title."/"."sender/".$user[0]["name"]."/";   //多级目录
$isbuilt=Directory($pathFile);              //创建多级目录
if($isbuilt){
    $code=1;
    if($hasFile){
        $workFile=$pathFile.$imgname;      //文件路径
        $myfile = fopen($workFile, "w");     //创建多及目录文件                         2步骤
        if(move_uploaded_file($tmp,$workFile)){  //将传入文件导入该文件中       
        }else{
        }
    }
    else{
        $workFile=$pathFile;
    }
    $array=array(array("description",$description),array("prjBegin",$startTime),array("prjEnd",$endTime),array("img",$img),array("demandPath",$workFile),array("prjName",$title),array("publisherId",$userId));
    add("project",$array);
    $sql="SELECT MAX(id) AS LargestId FROM project";
    $prjId=sql_str($sql);
    $prjId=$prjId[0]["LargestId"];
}
 
echo $json=json_encode(array( 
    "code"=>$code,
    "prjId"=>$prjId,
));   
 // auther：hgz

?>