<?php
 
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
require("../taskStateCheck.php");

$nowtime=time();

$sql="UPDATE project SET state=-1 WHERE prjEnd<=$nowtime AND state!=1 AND state!=2";       //更新过期的
sql_str($sql); 

function Directory( $dir ){  
    return  is_dir ( $dir ) or Directory(dirname( $dir )) and  mkdir ( $dir , 0777);
}

$prjId=$_POST["prjId"]; 
$code=0;
$data=array();
$totalNum=0;
$receiveNum=0;
$censorNum=0;
$delayNum=0;
$overNum=0;
$ongoNum=0;
$finishNum=0;
$taskNum=array();
$censorTasks=array();
$delayTasks=array();
$workers=array();
$pieChartData=array();
$table=array();
$peopleIdList=array();

$project=get("project","id",$prjId);
if(!empty($project)){
    $code=1;
    $title=$project[0]["prjName"];
    $tasks=get("task","prjId",$prjId);
    // echo $json=json_encode($tasks,JSON_UNESCAPED_UNICODE);   
    $totalNum=count($tasks);
    if(!empty($tasks)){
        foreach($tasks as $each){
            if($each["state"]==3){
                $receiveNum++;
            }
            else{
                // $user=get("user","id",$each["userId"]);
                //     // $workers=array(
                //     //     "name"=>$user[0]["name"],
                //     //     "name"=>$user[0]["name"],
                //     //     "name"=>$user[0]["name"],
                //     // );
                // $company=get("company","id",$user[0]["company"]);
                // $sql="SELECT * FROM task WHERE state=0 AND state=2 AND ".$each["userId"];
                // $taskNum=sql_str($sql);
                // $taskNum=count($taskNum);
                // $busy=$taskNum>=2?1:0;
                             // $currentTask=get("task","userId",$user[0]["id"]);
                if($each["userId"]!=NULL){
                    if(!empty($peopleIdList)){
                        if(in_array($each["userId"],$peopleIdList)){
                        }
                        else{
                            array_push($peopleIdList,$each["userId"]);
                            // $people=array(
                            //     "name"=>$user[0]["name"],
                            //     "currentTask"=>$each["taskName"],
                            //     "taskId"=>$each["id"],
                            //     "state"=>$each["state"],
                            //     "busy"=>$busy,
                            //     "company"=>$company[0]["companyName"]
                            // );
                            // array_push($workers,$people);
                        }
                    }
                    else if(empty($peopleIdList)){
                        array_push($peopleIdList,$each["userId"]);
                        // $people=array(
                        //     "name"=>$user[0]["name"],
                        //     "currentTask"=>$each["taskName"],
                        //     "taskId"=>$each["id"],
                        //     "state"=>$each["state"],
                        //     "busy"=>$busy,
                        //     "company"=>$company[0]["companyName"]
                        // );
                        // array_push($workers,$people);
                    }
                }
                if($each["state"]==2){
                    $censorNum++;
                    $user=get("user","id",$each["userId"]);
                    $task=array(
                        "Name"=>$each["taskName"],
                        "id"=>$each["id"],
                        "startTime"=>$each["startTime"],
                        "endTime"=>$each["endTime"],
                        "worker"=>$user[0]["name"],
                    );
                    array_push($censorTasks,$task);
                }
                else if($each["state"]==-1){
                    $delayNum++;
                    $user=get("user","id",$each["userId"]);
                    $userName=!(empty($user[0]["name"]))?$user[0]["name"]:"无人接包";
                    $task=array(
                        "Name"=>$each["taskName"],
                        "id"=>$each["id"],
                        "startTime"=>$each["startTime"],
                        "endTime"=>$each["endTime"],
                        "worker"=>$userName,
                    );
                    array_push($delayTasks,$task);
                }
                else if($each["state"]==0){
                    $ongoNum++;
                }
                else if($each["state"]==1){
                    $finishNum++;
                }
            } 
        }
        foreach($peopleIdList as $each){
            $sql="SELECT taskName,id FROM task WHERE userId=".$each." ORDER BY startTime";
            $signalTasks=sql_str($sql);
            $currentWork=$signalTasks[0]["taskName"];
            $sql="SELECT * FROM workinfo WHERE begin is not null AND end is null AND userId=".$each;
            $isworking=sql_str($sql);
            $state=!(empty($isworking))?"工作中":"未工作";
            $user=get("user","id",$each);
                    // $workers=array(
                    //     "name"=>$user[0]["name"],
                    //     "name"=>$user[0]["name"],
                    //     "name"=>$user[0]["name"],
                    // );
            $company=get("company","id",$user[0]["company"]);
            $sql="SELECT * FROM task WHERE state=0 AND state=2 AND ".$each;
            $taskNum=sql_str($sql);
            $taskNum=count($taskNum);
            $busy=$taskNum>=2?1:0;
            $people=array(
                "name"=>$user[0]["name"],
                "currentTask"=>$currentWork,
                "taskId"=>$signalTasks[0]["id"],
                "state"=>$state,
                "busy"=>$busy,
                "company"=>$company[0]["companyName"]
            );
            array_push($workers,$people);
        }
        // echo $json=json_encode($peopleIdList,JSON_UNESCAPED_UNICODE);   
        $table=array(
            "censorTasks"=>$censorTasks,
            "delayTasks"=>$delayTasks,
            "workers"=>$workers
        );
        $taskNum=array(
            "totalNum"=>$totalNum,
            "receiveNum"=>$receiveNum,
            "censorNum"=>$censorNum,
            "delayNum"=>$delayNum
        );
        $pieChartData=array(
            array(
                "value"=>$delayNum,
                "name"=>"延期",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=-1")
            ),
            array(
                "value"=>$ongoNum,
                "name"=>"进行中",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=0")
            ),
            array(
                "value"=>$censorNum,
                "name"=>"待审核",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=2")
            ),
            array(
                "value"=>$receiveNum,
                "name"=>"待接包",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=3")
            ),
            array(
                "value"=>$finishNum,
                "name"=>"已完成",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=1")
            )
        );
    }
    else{
        $table=array(
            "censorTasks"=>$censorTasks,
            "delayTasks"=>$delayTasks,
            "workers"=>$workers
        );
        $taskNum=array(
            "totalNum"=>$totalNum,
            "receiveNum"=>$receiveNum,
            "censorNum"=>$censorNum,
            "delayNum"=>$delayNum
        );
        $pieChartData=array(
            array(
                "value"=>$delayNum,
                "name"=>"延期",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=-1")
            ),
            array(
                "value"=>$ongoNum,
                "name"=>"进行中",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=0")
            ),
            array(
                "value"=>$censorNum,
                "name"=>"待审核",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=2")
            ),
            array(
                "value"=>$receiveNum,
                "name"=>"待接包",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=3")
            ),
            array(
                "value"=>$finishNum,
                "name"=>"已完成",
                "url"=>(string)("taskList.html?prjId=".$prjId."&state=1")
            )
        );
    }
}
$title=(isset($project[0]["prjName"]))?$project[0]["prjName"]:NULL;
$data=array(
    "code"=>$code,
    "title"=>$title,
    "taskNum"=>$taskNum,
    "table"=>$table,
    "pieChartData"=>$pieChartData
);

 
echo $json=json_encode($data,JSON_UNESCAPED_UNICODE);   
 // auther：hgz

?>