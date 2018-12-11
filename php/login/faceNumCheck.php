<?php
header("Content-type:text/html;charset=utf-8");
//检测是否只有一个人脸
require("../bmp24Change.php");
$imgname = $_FILES['face']['name']; //文件名
$tmp = $_FILES['face']['tmp_name']; //文件...
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
// print_r($result);
// print_r($value);
echo json_encode(array(
    "code" => $value,
));