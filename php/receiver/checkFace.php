<?php
header("Content-type:text/html;charset=utf-8");
//检测是否只有一个人脸
require("../bmp24Change.php");
require("../database.php");

$uuid = $_POST["uuid"];

$imgname = $_FILES['facialData']['name'];                   //文件名
$tmp = $_FILES['facialData']['tmp_name'];                   //文件...
$code=0;
$checkSucess=0;
$faceCheckArr=array();
$user=get("user","token",$uuid);
if(!empty($user)){
    $pathFile = "../../files/user/sample/";
    $workFile = $pathFile . $imgname;
    $myfile = fopen($workFile, "w"); //创建多及目录文件                         2步骤
    if (move_uploaded_file($tmp, $workFile)) {
    }
    fclose($myfile);
    $im = imagecreatefrompng($workFile);
    $workFile1 = str_replace('png', 'bmp', $workFile);
    imagebmp1($im, $workFile1, 24);
    $command = '..\..\exec\facialRecog\regFace.exe ' . $workFile1;
            // $result = passthru($command);
    $value = exec($command, $array, $var); //执行命令
    if ($value == 1) {
        $faceCheckPath = $user[0]["facialData"];
        $faceCheckArr=explode(";", $faceCheckPath);
        foreach($faceCheckArr as $each){
            $command = '..\..\exec\facialRecog\facialRecog.exe ' . $each . ' ' . $workFile1;
                // $result = passthru($command);
            $value = exec($command, $array, $var); //执行命令
            if ($value > 0.7) {
                $checkSucess = 1;
                break;
            }
        }
        // $command = '..\face\facialRecog.exe ' . $faceCheckPath . ' ' . $workFile1;
        //         // $result = passthru($command);
        // $value = exec($command, $array, $var); //执行命令
        // if ($value > 0.7) {
        //     $checkSucess = 1;
        // }
        if ($checkSucess) {
            // $msg = "success";
            // $data[0]['token'] = substr(md5(mt_rand(0, 1000)), 5, 16) . time();
            // set("administrator", "username", $username, [["token", $data[0]['token']]]);
            // $datamsg = array(
            //     "group" => "admin",
            //     "token" => $data[0]['token']
            // );
            $code=1;
        } else {
            $code = 0;
        }

    }
    else{
        $code=2;
    }
}
echo json_encode(array(
    "code" => $code,   //1识别成功 2人脸数目不对 0人脸识别失败
));