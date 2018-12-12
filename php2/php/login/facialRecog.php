<?php
require("../database.php");
require("../facialRecog.php");
require("../bmp24Change.php");
// $facialData = $_POST['facialData'];
$imgname = $_FILES['facialData']['name'];                   //文件名
$tmp = $_FILES['facialData']['tmp_name'];    
$username = $_POST['username'];
//去数据库里查询username的facialdata,存在dbFace里，用面部识别函数比对
$facialDataArr=array();
$checkSucess=0;
$code=0;


$user=get("user","username", $username);
// $user_admin = get("administrator", "username", $username);
if(empty($user)){
    $code = -1;
    echo json_encode(array(
        "code" => $code
    ));
    exit();
}
$facialDataList= $user[0]["facialData"];
$facialDataArr=explode(";", $facialDataList);
$pathFile = "../../files/user/";
$workFile = $pathFile . $imgname;
$myfile = fopen($workFile, "w"); //创建多及目录文件                         2步骤
if (move_uploaded_file($tmp, $workFile)) { //将传入文件导入该文件中
        // $code = 1;  
}
fclose($myfile);

$im = imagecreatefrompng($workFile);
$workFile1 = str_replace('png', 'bmp', $workFile);
imagebmp1($im, $workFile1, 24);
$command = '..\..\exec\facialRecog\regFace.exe ' . $workFile1;
// $result = passthru($command);
$value = exec($command, $array, $var); //执行命令
if($value==1){
    foreach ($facialDataArr as $each) {
        $command = '..\..\exec\facialRecog\facialRecog.exe ' . $each . ' ' . $workFile1;
                // $result = passthru($command);
        $value = exec($command, $array, $var); //执行命令
        if ($value > 0.7) {
            $checkSucess = 1;
        }
        if ($checkSucess) {
            $code = 1;
            break;
        }
    }
}
else if($value==2){
    $code = 2;
}
echo json_encode(array(
    "code" => $code
));
// $dbFace = [];
// if(facialRecog($dbFace,$facialData))
// {
//     echo json_encode(["code"=>"1"]);
// }
?>