<?php
    header("Content-type:text/html;charset=utf-8");
    require("../database.php");
    $mail=$_POST["mail"];
    $phone=$_POST["phone"];
    $identificationNum=$_POST["identificationNum"];

    $data_mail=get("user","mail",$mail);
    $data_phone=get("user","phone",$phone);

    $data=get("user","identificationNum",$identificationNum);
    $data_admin=get("administrator","identificationNum",$identificationNum);
    
    if(!empty($data)||!empty($data_admin)){
        $data_identificationNum=1;
    }
    else{
        $data_identificationNum=0;
    }

    $has_mail=empty($data_mail)?0:1;
    $has_phone=empty($data_phone)?0:1;
    $has_identificationNum=empty($data_identificationNum)?0:1;

    echo json_encode(array(
        "mail"=>$has_mail,
        "phone"=>$has_phone,
        "identificationNum"=>$has_identificationNum
    ));
?>