<?php

//洪高泽

header("Content-type:text/html;charset=utf-8");
require("../database.php");
$publisherList=$_POST["publisherList"];
$code=0;

$allPublisher=sql_str("SELECT id FROM user WHERE userGroup=1");
$publisherIdArray=array();
foreach($allPublisher as $each){
    array_push($publisherIdArray,$each["id"]);
}
foreach($publisherList as $each){
    if(in_array($each,$publisherIdArray)){
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