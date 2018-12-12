<?php 
header("Content-type:text/html;charset=utf-8");
require("../database.php"); 
function Directory( $dir ){  
    return  is_dir ( $dir ) or Directory(dirname( $dir )) and  mkdir ( $dir , 0777);
}

$taskId=$_POST["taskId"]; 
$workDescription=$_POST["workDescription"]; 
$imgname = $_FILES['file']['name'];                   //文件名
$tmp = $_FILES['file']['tmp_name'];                   //文件...
$code=0;
$exist=0;

if($imgname==NULL){
    echo $json=json_encode(array( 
        "code"=>$code,
    ));
    exit();   
}

$task=get("task","id",$taskId);
if(!empty($task)){
    $user=get("user","id",$task[0]["userId"]);       //查找接包人员表单
    $prj=get("project","id",$task[0]["prjId"]);      //查找项目表单
    $workFile_self=$task[0]["workFile"];             //数据库中原有目录名称
    $workDescription_self=$task[0]["workDescription"];     //数据库中原有描写
    if(!empty($prj)){
        $prjName=$prj[0]["prjName"];                    //获取项目名称
        $taskName=$task[0]["taskName"];                 //获取任务名称
        $pathFile="../../files/prj/".$prjName."/".$taskName."/"."receiver/".$user[0]["name"]."/";   //多级目录
        $isbuilt=Directory($pathFile);              //创建多级目录
        if($isbuilt){
            $workFile=$pathFile.$imgname;      //文件路径
            if($workFile_self==NULL){
                $workDescription_self=$workDescription;                                      //1步骤 ：覆盖
                $workFile_self=$workFile;
                $myfile = fopen($workFile, "w");     //创建多及目录文件                         2步骤
                if(move_uploaded_file($tmp,$workFile)){  //将传入文件导入该文件中
                    $code=1;
                }else{
                }
            }
            else{
                $filearray=explode(";",$workFile_self);   //有数据取出编成数组与传入比对
                foreach($filearray as $each){
                    if($each==$workFile){               
                        $exist=1;                        //比对成功$exist=1
                    }
                }
                if($exist==0){
                    $myfile = fopen($workFile, "w");           //比对不成功                 重复2步骤
                    if(move_uploaded_file($tmp,$workFile)){
                        $code=1;
                    }else{
                    }
                    $workDescription_self=$workDescription_self.";".$workDescription;    //对比不成功           3步骤原有数据连接传入数据
                    $workFile_self=$workFile_self.";".$workFile;
                }
                else if($exist==1){                     //比对成功则不操作
                    $code=0;
                }
            }
            set("task","id",$taskId,array(array("workDescription",$workDescription_self),array("workFile",$workFile_self)));
        }
    }
}
 
echo $json=json_encode(array( 
    "code"=>$code,
));   
 // auther：hgz

?>