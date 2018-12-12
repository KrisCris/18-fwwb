<?php
header("Content-type:text/html;charset=utf-8");
require "../database.php";

// function Directory($dir)
// {
//     return is_dir($dir) or Directory(dirname($dir)) and mkdir($dir, 0777);
// }

$name = $_POST["name"];
$username = $_POST["username"];
$password = $_POST["password"];
$phone = $_POST["phone"];
$company = $_POST["company"];
$mail = $_POST["mail"];
$group;
$identificationNum = $_POST["identification"];
$workPath=NULL;
// $facialData = $_POST["facialData"];
$imgname=array();
$tmp = array();
// for($i=0;$i<5;$i++){
//     $imgname[$i] = $_FILES['facialData[]'][$i]['name'];                   //文件名
//     $tmp[$i] = $_FILES['facialData[]'][$i]['tmp_name'];                   //文件...
// }
for($i=0;$i<5;$i++){
    $imgname[$i] = $_FILES['facialData'.$i]['name'];                   //文件名
    $tmp[$i] = $_FILES['facialData' . $i]['tmp_name'];                   //文件...
}

$msg = "";
$code = 0;
if ($company == -1) {
    $group = 1;
} else {
    $group = 2;
}

$array = array(array("name", $name), array("username", $username), array("password", $password), array("phone", $phone), array("company", $company), array("mail", $mail), array("userGroup", $group), array("identificationNum", $identificationNum)); //, array("facialData", $facialData)

$data = get("user", "username", $username);
$data_admin = get("administrator", "username", $username);
if (!empty($data) || !empty($data_admin)) {
    $code = 0;
    $msg = "failed";
} else {
    $sql = "SELECT MAX(id) AS LargestId FROM user";
    $userMax = sql_str($sql);
    $maxId = $userMax[0]["LargestId"] + 1;
    $pathFile = "../../files/user/";
    // $isbuilt = Directory($pathFile); //创建多级目录
    // if ($isbuilt) {
    // $workFile = $pathFile . $maxId . $imgname;
    for ($i = 0; $i < 5; $i++){
        $workFile = $pathFile . $maxId ."No". $i .".tmp";
        $myfile = fopen($workFile, "w"); //创建多及目录文件                         2步骤
        if (move_uploaded_file($tmp[$i], $workFile)) { //将传入文件导入该文件中
        // $code = 1;  
        }
        fclose($myfile);

        $im = imagecreatefrompng($workFile);
        $workFile1 = str_replace('tmp', 'bmp', $workFile);
        imagebmp1($im, $workFile1, 24);
        $workPath .= $workFile1 . ";";
    }
    $workPath= substr($workPath, 0, strlen($workPath) - 1);
    $facialPath = array("facialData", $workPath);
    array_push($array, $facialPath);
    add("user", $array); //如果不存在于任意一张表中，则插入user表中
    $code = 1;
    $msg = "success";
    // }
    // $facialPath = array("facialData", $workFile);
    // array_push($array, $facialPath);
    // add("user", $array); //如果不存在于任意一张表中，则插入user表中
    // $code = 1;
    // $msg = "success";
}

$json = json_encode(array(
    "code" => $code,
    "msg" => $msg,
));
echo $json;
