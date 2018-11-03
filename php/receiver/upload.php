<?php 
header("Content-type:text/html;charset=utf-8");
require("../database.php"); 
function Directory( $dir ){  
    return  is_dir ( $dir ) or Directory(dirname( $dir )) and  mkdir ( $dir , 0777);
}

$taskId=$_POST["taskId"]; 
$descriptionFile=$_POST["description"]; 
$imgname = $_FILES['file']['name'];
$tmp = $_FILES['file']['tmp_name'];
$code=0;

$task=get("task","id",$taskId);
if(!empty($task)){
    $user=get("user","id",$task[0]["userId"]);
    $prj=get("project","id",$task[0]["prjId"]);
    $workFile=$task[0]["workFile"];
    $descriptionFile_self=$task[0]["descriptionFile"];
    if(!empty($prj)){
        $prjName=$prj[0]["prjName"];
        $taskName=$task[0]["taskName"];
        $pathFile="../../files/prj/".$prjName."/".$taskName."/"."receiver/".$user[0]["name"]."/";
        $isbuilt=Directory($pathFile);

        if($isbuilt){
            $path=$pathFile.$imgname;
            $myfile = fopen($path, "w");
            if(move_uploaded_file($tmp,$path)){
                $code=1;
            }else{
            }
            if($workFile==NULL){
            }
            else{
                $descriptionFile=$descriptionFile_self.";".$descriptionFile;
                $path=$workFile.";".$path;
            }
            set("task","id",$taskId,array(array("descriptionFile",$descriptionFile),array("workFile",$path)));
        }
    }
}
 
echo $json=json_encode(array( 
    "code"=>$code,
));   
 // auther：hgz

?>