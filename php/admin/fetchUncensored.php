<?php
require("../database.php");
$data=get("user","isCensored","0");
$info=[];
foreach($data as $_person){
    $person=[];
    $company=[];
    $companyInfo=[];
    array_push($person,$_person['username']);
    array_push($person,$_person['name']);
    array_push($person,$_person['phone']);
    array_push($person,$_person['mail']);
    $companyInfo = get("company","id",$_person['company']);
    $company = $companyInfo[0]["companyName"];
    array_push($person,$company);
    array_push($info,$person);
}
echo json_encode($info);
?>