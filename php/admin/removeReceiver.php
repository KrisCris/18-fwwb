<?php

//洪高泽

header("Content-type:text/html;charset=utf-8");
require("../database.php");
$receiverList=$_POST["receiverList"];
$code=0;

$allReceiver=sql_str("SELECT id FROM user WHERE userGroup=2");
$receiverIdArray=array();
foreach($allReceiver as $each){
    array_push($receiverIdArray,$each["id"]);
}
foreach($receiverList as $each){
    if(in_array($each,$receiverIdArray)){
        del("user","id",$each);
        $code=1;
    }
    else{
        $code=0;
    }
}

echo $json=json_encode(array(
    "code"=>$code,  
));


?>