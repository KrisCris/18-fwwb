<?php 
header("Content-type:text/html;charset=utf-8");
require("database.php"); 
function newstripos($str, $find, $count, $offset=0)   //查找一个字符在字符串中第几次出现
{
    $pos = stripos($str, $find, $offset);
    $count--;
    if ($count > 0 && $pos !== FALSE)
    {
        $pos = newstripos($str, $find ,$count, $pos+1);
    }
    return $pos;
}

$taskId=$_POST["taskId"]; 
$data=array();
$workInfo=array();
$taskName=NULL;
$description=NULL;
$code=-1;
$state=NULL;
$downloadPath=NULL;
$project=array();
$projectName=NULL;
$projectDescription=NULL;
$projectFile=NULL;
$projectFileName=NULL;

$task=get("task","id",$taskId);

if(!empty($task)){
    $code=1;
    $prj=get("project","id",$task[0]["prjId"]);
    if(!empty($prj)){
        $projectName=$prj[0]["prjName"];
        $projectDescription=$prj[0]["description"];
        $projectFile=$prj[0]["demandPath"];

        $endPoint=strripos($projectFile,"/")+1;
        // echo $endPoint;
        // $projectFile=str_replace ("\\","/",$projectFile);
        // array_push($skillarray,$each['Field']);
        // $task[0]["workInfo"]["downloadPath"]=$task[0]["workFile"];
        $projectFile=(string)($projectFile);
        $projectFileName= substr($projectFile, $endPoint);

        $project=array(
            "projectName"=>$projectName,
            "projectDescription"=>$projectDescription,
            "projectFile"=>$projectFile,
            "projectFileName"=>$projectFileName,
        );
    }
    $taskName=$task[0]["taskName"]; 
    // $workFile_self=$task[0]["workFile"];             //数据库中原有目录名称字符串
    // $workDescription_self=$task[0]["workDescription"];       //数据库中原有描写名称字符串
    $description=$task[0]["description"];
    $state=$task[0]["state"];
    // if(!empty($workFile_self)){
    //     $code=1;
    //     $filearray=explode(";",$workFile_self);   //数据库中文件字符串转成数组
    //     $descriptionarray=explode(";",$workDescription_self);    //数据库中描写字符串转成数组
    //     $count=0;
    //     foreach($filearray as $each){
    //         $lastslash=newstripos($each,"/",8);
    //         $workDescription=$descriptionarray[$count];
    //         $workFileName=substr( $each,$lastslash+1);
    //         $eacharray=array(
    //             "downloadPath"=>$each,                       //路径
    //             "workFileName"=>$workFileName,               //文件名
    //             "workDescription"=>$workDescription          //文件描述
    //         );
    //         array_push($workInfo,$eacharray);
    //         $count++;
    //     }

    // }
    // $endPoint=strripos($task[0]["workFile"],"/")+1;
    // $workFileName= substr($task[0]["workFile"], $endPoint,strlen($projectFile)-1);
    // $workDescription=$task[0]["workDescription"];
    // $workInfo=array(
    //     "downloadPath"=>(string)($task[0]["workFile"]),                       //路径
    //     "workFileName"=>$workFileName,               //文件名
    //     "workDescription"=>$workDescription 
    // );
    $endPoint=strripos($task[0]["descriptionFile"],"/")+1;
    $workFileName= substr($task[0]["descriptionFile"], $endPoint);
    $workDescription=$task[0]["description"];
    $downloadPath=$task[0]["descriptionFile"];
    $workInfo=array(array(
        "downloadPath"=>$downloadPath,                       //路径
        "workFileName"=>$workFileName,               //文件名
        "workDescription"=>$workDescription 
    ));
}
$data=array(
    "code"=>$code,                             //-1为不存在，0为没数据，1为有数据
    "workInfo"=>$workInfo,
    "taskName"=>$taskName,                     //任务名
    "description"=>$description,                //任务说明，发包写的
    "state"=>$state,
    "project"=>$project
);

echo json_encode($data,JSON_UNESCAPED_UNICODE);
 // auther：hgz

?>