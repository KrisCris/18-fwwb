<?php
//"receiver.id"
// receiver.username"></td>
// <td v-text="receiver.name"></td>
// <td v-text="receiver.phone"></td>
// <td v-text="receiver.mail"></td>
// <td v-text="receiver.company">


//洪高泽

header("Content-type:text/html;charset=utf-8");
require("../database.php");
$sql="SELECT id,username,name,phone,mail,company FROM user WHERE userGroup=2";
$data=sql_str($sql);
echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>