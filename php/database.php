<?php
//edited by hpc, dev by yyz
//查
//不论get几个都是数组，所以get 1个的时候要index=0
//$table 表名，$label 字段名，$value 查询用的值
function get($table,$label="",$value=""){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("localhost","root","910189033","cs_db");
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
//改
// $change 改变的内容
function set($table,$label,$value,$change){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("localhost","root","910189033","cs_db");
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
 * 
 */
function add($table,$array){
    static $con = null;
    if(!$con)
        $con = mysqli_connect("localhost","root","910189033","cs_db");
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
        $con = mysqli_connect("localhost","root","910189033","cs_db");
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
//         $con = mysqli_connect("localhost","root","910189033","cs_db");
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