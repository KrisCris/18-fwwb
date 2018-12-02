<?php  
header("Content-type:text/html;charset=utf-8");  
require("../database.php");  
function Directory( $dir ){   
    return  is_dir ( $dir ) or Directory(dirname( $dir )) and  mkdir ( $dir , 0777); 
} 
 
$uuid=$_POST["uuid"];  
$skill=$_POST["skill"];  
$newSkill=$_POST["newSkill"];  
$description=$_POST["description"];  
$securityLevel=$_POST["securityLevel"];  
$title=$_POST["title"];  
$prjId=$_POST["prjId"]; 
$startTime=$_POST["startTime"]; 
$endTime=$_POST["endTime"]; 
// $imgname = $_FILES['file']['name'];                   //文件名 
// $tmp = $_FILES['file']['tmp_name'];                   //文件... 
$hasFile=$_POST["hasFile"];
if($hasFile){
    $imgname = $_FILES['file']['name'];                   //文件名
    $tmp = $_FILES['file']['tmp_name'];                   //文件...
}
$data=array(); 
$code=0; 
$exist=0; 
$taskId=NULL;
 
$user=get("user","token",$uuid);  
$project=get("project","id",$prjId);                 //查找有无这个工程 
if(empty($project)||empty($user)){ 
    echo $json=json_encode(array(  
        "code"=>$code, 
    )); 
    exit();                                         //没有结束脚本 
} 
else if(!empty($project)){ 
    if($project[0]["publisherId"]!=$user[0]["id"]){     //检验任务id与工程是否匹配，不匹配结束脚本 
        echo $json=json_encode(array(  
            "code"=>$code, 
        )); 
        exit();   
    } 
    else{ 
        $prjName=$project[0]["prjName"]; 
        $sql="SELECT taskName FROM task WHERE prjId=$prjId"; 
        $taskName=sql_str($sql);  
        $taskList=array(); 
        // echo $json=json_encode($taskName); 
        foreach($taskName as $each){ 
            array_push($taskList,$each["taskName"]); 
        } 
        if(in_array($title,$taskList)){ 
            $code=-1;                                  //-1表示该文件名已存在 
            echo $json=json_encode(array(  
                "code"=>$code, 
            )); 
            exit();   
        } 
        else{ 
            $pathFile="../../files/prj/".$prjName."/".$title."/"."sender/";   //多级目录 
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
                $skills=implode("*", $skill); 
                if($newSkill[0]!=""){ 
                    foreach($newSkill as $each){ 
                        if(!empty($each)){
                            $sql="ALTER TABLE skill ADD"." ".$each." "."varchar(255) NOT NULL"; 
                            sql_str($sql);  
                        }
                    } 
                    $newSkills=implode("*", $newSkill); 
                    $skills.="*".$newSkills; 
                }
                $skillsArr=explode("*",$skills);
                $check="userId is not null ";
                foreach($skillsArr as $each){
                    $check.="AND `$each`=1 ";
                } 
                $sql="SELECT userId FROM skill WHERE ".$check;
                $userIdArr=sql_str($sql);
                $userIdStr=NULL;
                if(!empty($userIdArr)){
                    foreach($userIdArr as $each){
                        $userIdStr.=$each["userId"]."*";
                        // echo $each["userId"];
                    }
                    $userIdStr= substr($userIdStr, 0, strlen($userIdStr));//useless
                }
                $newtask=array(array("prjId",$prjId),array("startTime",$startTime),array("endTime",$endTime),array("taskName",$title),array("workDescription",$description),array("workFile",$workFile),array("text",$skills),array("securityLevel",$securityLevel),array("state",3),array("userId",$userIdStr)); 
                add("task",$newtask);
                $sql="SELECT MAX(id) AS LargestId FROM task";
                $addtask=sql_str($sql);
                $taskId=$addtask[0]["LargestId"];
            } 
        } 
    } 
} 
                   
 
$data=array( 
    "code"=>$code, 
    "taskId"=>$taskId
); 
echo json_encode($data,JSON_UNESCAPED_UNICODE); 
 // auther：hgz 
?>
