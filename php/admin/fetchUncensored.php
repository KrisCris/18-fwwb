<?php
require("../database.php");
$sql="SELECT user.name,user.phone,user.mail,company.companyName,user.id FROM user INNER JOIN company ON user.company=company.id WHERE user.isCensored=0";
$data=sql_str($sql);
echo json_encode($data);
?>