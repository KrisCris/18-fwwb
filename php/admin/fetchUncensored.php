<?php
header("Content-type:text/html;charset=utf-8");
require("../database.php");
$sql="SELECT user.name,user.phone,user.mail,company.companyName,user.id FROM user LEFT JOIN company ON user.company=company.id WHERE user.isCensored=0";
$data=sql_str($sql);
echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>