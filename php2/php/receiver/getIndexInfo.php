<?php
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
require "../taskStateCheck.php";

$uuid = $_POST["uuid"];
$group = $_POST["group"];
$code = 0;
$checktime = strtotime("+3 day");
$data = get("user", "token", $uuid);
$checkNum = 0;
$recentNum = 0;
$delayNum = 0;
$acceptTasks = array();
$idArr = null;
$hasId = null;

if (!empty($data)) {
    $code = 1;
    $name = $data[0]["name"];
    $portrait = $data[0]["portrait"];
    $sql = "SELECT task.taskName,task.startTime,task.endTime,task.securityLevel,task.state,project.prjName,task.id FROM task INNER JOIN project WHERE task.prjId=project.id AND task.endTime<=" . $checktime . " AND task.userId=" . $data[0]['id'] . " ORDER BY task.endTime";
    $personaltask = sql_str($sql);
    $sql = "SELECT * FROM task WHERE userId=" . $data[0]['id'];
    $userTasks = sql_str($sql);
    if (!empty($userTasks)) {
        foreach ($userTasks as $each) {
            if ($each["state"] == 2) {
                $checkNum++;
            } else if ($each["state"] == -1) {
                $delayNum++;
            }
            // else if($each["state"]==0){
            //     $recentNum++;
            // }
        }
    }

    $sql = "SELECT task.taskName,task.startTime,task.endTime,task.securityLevel,task.state,project.prjName,task.id FROM task INNER JOIN project WHERE task.prjId=project.id AND task.endTime<=" . $checktime . " AND task.state!=1 AND task.userId=" . $data[0]['id'] . " ORDER BY task.endTime";
    $personaltask = sql_str($sql);

    if (!empty($personaltask)) {
        $recentNum = count($personaltask);
    }

    $sql = "SELECT taskName,endTime,id,userId FROM task WHERE state=3 ORDER BY task.endTime";
    $bechecked = sql_str($sql);
    foreach ($bechecked as $each) {
        $userIdStr = $each["userId"];
        $userIdStr = substr($userIdStr, 0, strlen($userIdStr) - 1);
        if (!empty($userIdStr)) {
            $idArr = explode("*", $userIdStr);
            if (in_array($data[0]["id"], $idArr)) {
                $task = array(
                    "taskName" => $each["taskName"],
                    "endTime" => $each["endTime"],
                    "id" => $each["id"],
                );
                array_push($acceptTasks, $task);
            }
        }
    }
} else {
}

if ($code == 1) {
    $json = json_encode(array(
        "code" => $code,
        "tasks" => $personaltask,
        "name" => $name,
        "acceptTasks" => $acceptTasks,
        "portrait" => $portrait,
        "checkNum" => $checkNum,
        "delayNum" => $delayNum,
        "recentNum" => $recentNum,
    ), JSON_UNESCAPED_UNICODE);
} else {
    $json = json_encode(array(
        "code" => $code,
    ));
}
echo $json;
// auther：hgz
