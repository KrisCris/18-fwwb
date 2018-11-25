<?php 
header("Content-type:text/html;charset=utf-8");
require("../database.php"); 
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
$worker=array();
$pieChartData=array();
$table=array();

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
                $user=get("user","id",$each["userId"]);
                    // $worker=array(
                    //     "name"=>$user[0]["name"],
                    //     "name"=>$user[0]["name"],
                    //     "name"=>$user[0]["name"],
                    // );
                $company=get("company","id",$user[0]["company"]);
                $sql="SELECT * FROM task WHERE state=0 AND state=2 AND ".$each["userId"];
                $taskNum=sql_str($sql);
                $taskNum=count($taskNum);
                $busy=$taskNum>=1?1:0;
                // $currentTask=get("task","userId",$user[0]["id"]);
                $people=array(
                    "name"=>$user[0]["name"],
                    "currentTask"=>$each["taskName"],
                    "taskId"=>$each["id"],
                    "state"=>$each["state"],
                    "busy"=>$busy,
                    "company"=>$company[0]["companyName"]
                );
                array_push($worker,$people);
                if($each["state"]==2){
                    $censorNum++;
                    
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
                    $task=array(
                        "Name"=>$each["taskName"],
                        "id"=>$each["id"],
                        "startTime"=>$each["startTime"],
                        "endTime"=>$each["endTime"],
                        "worker"=>$user[0]["name"],
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
        $table=array(
            "censorTasks"=>$censorTasks,
            "delayTasks"=>$delayTasks,
            "worker"=>$worker
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
                "url"=>"taskList.html?prjId=".$prjId."&state=-1"
            ),
            array(
                "value"=>$ongoNum,
                "name"=>"进行中",
                "url"=>"taskList.html?prjId=".$prjId."&state=0"
            ),
            array(
                "value"=>$censorNum,
                "name"=>"待审核",
                "url"=>"taskList.html?prjId=".$prjId."&state=2"
            ),
            array(
                "value"=>$receiveNum,
                "name"=>"待接包",
                "url"=>"taskList.html?prjId=".$prjId."&state=3"
            ),
            array(
                "value"=>$finishNum,
                "name"=>"已完成",
                "url"=>"taskList.html?prjId=".$prjId."&state=1"
            )
        );
    }
    else{
        $table=array(
            "censorTasks"=>$censorTasks,
            "delayTasks"=>$delayTasks,
            "worker"=>$worker
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
                "url"=>"taskList.html?prjId=".$prjId."&state=-1"
            ),
            array(
                "value"=>$ongoNum,
                "name"=>"进行中",
                "url"=>"taskList.html?prjId=".$prjId."&state=0"
            ),
            array(
                "value"=>$censorNum,
                "name"=>"待审核",
                "url"=>"taskList.html?prjId=".$prjId."&state=2"
            ),
            array(
                "value"=>$receiveNum,
                "name"=>"待接包",
                "url"=>"taskList.html?prjId=".$prjId."&state=3"
            ),
            array(
                "value"=>$finishNum,
                "name"=>"已完成",
                "url"=>"taskList.html?prjId=".$prjId."&state=1"
            )
        );
    }
}

$data=array(
    "code"=>$code,
    "title"=>$project[0]["prjName"],
    "taskNum"=>$taskNum,
    "table"=>$table,
    "pieChartData"=>$pieChartData
);

 
echo $json=json_encode($data,JSON_UNESCAPED_UNICODE);   
 // auther：hgz

?>