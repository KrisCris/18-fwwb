<?php
header("Content-type:text/html;charset=utf-8");
require("../database.php");
$companyList=$_POST["companyList"];

$companyList=explode(",",$companyList);           //输入字符串吧，“1,2,3,4” 我在php中通过逗号进行分割放入array数组中
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

?>