<?php
//edited by hpc, dev by yyz
//查
//不论get几个都是数组，所以get 1个的时候要index=0
//$table 表名，$label 字段名，$value 查询用的值
function get($table,$label="",$value=""){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("127.0.0.1","root","910189033","cs_db");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $statement="";

    if($label=="" && $value=="")$statement = "SELECT * FROM $table";
    else{
        $statement = "SELECT * FROM $table WHERE $label = '$value'";
    }
    $result = $con->query($statement);
    if($result->num_rows<=0)return [];

    $data=[];
    while($row = $result->fetch_assoc()){
        array_push($data,$row);
    }
    return $data;

}
//这个函数可以让你自定义query的内容。。。
//比如
// SELECT
// consumed_order.order_id,
// service_order.order_id,
// service_order.job_number
// FROM
// consumed_order
// INNER JOIN technician ON technician.job_number = service_order.job_number ,
// skill
// INNER JOIN service_order ON consumed_order.order_id = service_order.order_id
// WHERE
// consumed_order.ID <> null

function sql_str($sql){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("127.0.0.1","root","910189033","cs_db");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $result = $con->query($sql);
    if(strpos($sql,"DELETE")!== false||strpos($sql,"UPDATE")!== false){
    }
    else{
        if($result->num_rows<=0)return [];
        $data=[];
        while($row = $result->fetch_assoc()){
            array_push($data,$row);
        }
        return $data;
    }
  
}

function sql_get($sql){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("127.0.0.1","root","910189033","cs_db");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $result = $con->query($sql);
    while($row = $result->fetch_assoc()){
        array_push($data,$row);
    }
    return $data;

}


function sql_alt($table,$action,$label,$else){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("127.0.0.1","root","910189033","cs_db");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $statement="ALTER TABLE $table $action $label $else";
    $result = $con->query($statement);
    
}

//改
// $change 改变的内容
function set($table,$label,$value,$change){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("127.0.0.1","root","910189033","cs_db");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $item = get($table,$label,$value);
    foreach($change as $each){
        $lb = $each[0];
        $vl = $each[1];
        $statement = "UPDATE $table SET $lb='$vl' WHERE $label= '$value'";
        $con->query($statement);
    }
}
//增
/**
 * 向数据库里添加记录，array为二维数组，形如
 * [     [字段，值],[字段，值],[字段，值],[字段，值]    ]
 * 这个应该是array(array(字段，值),array(字段，值),array(字段，值),array(字段，值))吧！
 * 
 */
function add($table,$array){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("127.0.0.1","root","910189033","cs_db");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $statement = "INSERT INTO $table (";
    foreach($array as $two){
        $statement.=$two[0].", ";
    }
    $statement = substr($statement, 0, strlen($statement)-2);
    $statement.=") VALUES (";
    foreach($array as $two){
        $statement.="'".$two[1]."', ";
    }
    $statement = substr($statement, 0, strlen($statement)-2);
    $statement.=")";
    $con->query($statement);
}

//删
function del($table,$label,$value){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("127.0.0.1","root","910189033","cs_db");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    $statement = "DELETE FROM $table WHERE $label = '$value'";
    $con->query($statement);
}
//      别删了！！！！！！！！暂时用不到
// function get_limit($table,$index=0,$label="",$value=""){
//     static $con = null;
//     if(!$con)
//         $con = mysqli_connect("127.0.0.1","root","910189033","cs_db");
//     if (!$con)
//     {
//         die('Could not connect: ' . mysql_error());
//     }
//     $statement="";

//     if($label=="" && $value=="")$statement = "SELECT * FROM $table LIMIT $index,20";
//     else{
//         $statement = "SELECT * FROM $table WHERE $label = '$value'";
//     }
//     $result = $con->query($statement);
//     if($result->num_rows<=0)return [];

//     $data=[];
//     while($row = $result->fetch_assoc()){
//         array_push($data,$row);
//     }
//     return $data;

// }




?>