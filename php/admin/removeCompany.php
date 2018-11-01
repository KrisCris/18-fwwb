<?php
header("Content-type:text/html;charset=utf-8");
require("../database.php");
$companyList=$_POST["companyList"];

$allCompany=sql_str("SELECT id FROM company");
$companyIdArray=array();
foreach($allCompany as $each){
    array_push($companyIdArray,$each["id"]);
}
foreach($companyList as $each){
    $code=1;
    if(in_array($each,$companyIdArray)){
        del("company","id",$each);
    }
    else{
        $code=0;
    }
}

echo $json=json_encode(array(
    "code"=>$code,  
));
// auther：hgz
?>
