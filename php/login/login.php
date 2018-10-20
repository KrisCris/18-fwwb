<?php
header("Content-type:text/html;charset=utf-8");
require("../database.php");
date_default_timezone_set('prc');
$username=$_POST["username"];
$password=$_POST["password"];

$data=get("user","username",$username);
$data_admin=get("administrator","username",$username);

$code=0;
$code_admin=0;
$msg="";
$datamsg=null;

//查找user和administrator两张表，是否存在该用户
//没有则返回0，failed
//否则判断在那张表中，重置token，并返回1，success
if(empty($data)&&empty($data_admin)){
    $code=0;
    $code_admin=0;
    $msg="failed";
}
else if(!empty($data_admin)){
    $code_admin=($data_admin[0]['password']==$password)?1:0;
    if($code_admin==1){
        $msg="success";
        $data_admin[0]['token']=substr(md5(mt_rand(0,1000)),5,16).time();
        set("administrator","username",$username,[["token",$data_admin[0]['token']]]); 
        $datamsg=array(
            "group"=>null,
            "token"=>$data_admin[0]['token']
        );
    }
    else{
        $msg="failed";
    }
}
else{
    $code=($data[0]['password']==$password)?1:0;    
    $isCensored=$data[0]['isCensored']; 
    if($code==1){ 
        if($isCensored==1){
            $msg="success";
            $data[0]['token']=substr(md5(mt_rand(0,1000)),5,16).time();
            set("user","username",$username,[["token",$data[0]['token']]]);
            $datamsg=array(
                "group"=>$data[0]['userGroup'],
                "token"=>$data[0]['token']
            );
        }
        else if($isCensored==0){
            $code=-1;
            $msg="failed";
        }
        else if($isCensored==-1){
            $code=-2;
            $msg="failed";
        }
    }
    else{
        $msg="failed";
    }
    
}
$code=$code+$code_admin;
echo json_encode(array(
    "code"=>$code,
    "msg"=>$msg,
    "data"=>$datamsg
));

?>