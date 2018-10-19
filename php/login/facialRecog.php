<?php
require("../facialRecog.php");
$facialData = $_POST['facialData'];
$username = $_POST['username'];
//去数据库里查询username的facialdata,存在dbFace里，用面部识别函数比对
$dbFace = [];
if(facialRecog($dbFace,$facialData))
{
    echo json_encode(["code"=>"1"]);
}
?>