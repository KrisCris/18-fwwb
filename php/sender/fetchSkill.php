<?php 
header("Content-type:text/html;charset=utf-8"); 
require("../database.php"); 

$sql="SHOW FULL COLUMNS FROM skill";
$skills=sql_str($sql); 
$code=0;
$data=array();
$skillarray=array();
// echo json_encode($skills,JSON_UNESCAPED_UNICODE);
$skilllen=count($skills);
for($i=1;$i<$skilllen;$i++){
    array_push($skillarray,$skills[$i]['Field']);
}
// foreach($skills as $each){
//     if($each['Field']=="userId"){
//     }
//     else{
//         array_push($skillarray,$each['Field']);
//     }
// }
if(!empty($skillarray)){
    $code=1;
    $data=array(
        "code"=>$code,                             
        "skills"=>$skillarray
    );    
}

echo json_encode($data,JSON_UNESCAPED_UNICODE);
 // auther：hgz
?>