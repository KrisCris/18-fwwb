<?php


//增加参数函数返回一个NULL表示提交成功，返回"你已提交注册申请！"表示新增重复，已经插入，可以用errMsg接收
//输入格式：表名、人名、用户名、密码、手机号码、公司、email、是否为真设置为“”,经过管理员认证后将之变为true
function add_parameter($db,$name,$userName,$password,$phoneNUm,$company,$eMail){
    $con = mysql_connect("localhost","root","root");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_select_db('my_db', $con);
    $sql='INSET INTO '.$db.' (name,userName,password,phoneNUm,company,eMail,istrue) VALUE($name,$userName,$password,$phoneNUm,$company,$eMail,"")'; 
    try{
        if (!mysql_query($sql,$con)){
          throw new Exception("你已提交注册申请！");
        }
        else{
            return array(
                "status" => "success",
                "errMsg" => NULL,
            );
        }
    }
    catch(Exception $e){
        return array(
            "status" => "failed",
            "errMsg" => $e->getMessage(),
        );
    }
    
}
//通过输入表名和用户名来找到这个user，检验其是否存在，存在则删除，返回一个array包含状态和错误信息
function remove_parameter($db,$username){
    $con = mysql_connect("localhost","root","root");
    if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }

    mysql_select_db('my_db', $con);

    $sql='SELECT * FROM adiministrators WHERE username=$username'; 
    
    try{
        try{
            if (!mysql_query($sql,$con)){
                throw new Exception("系统出错！");
            }
        }
        catch(Exception $e){
            throw new Exception("系统出错！");
        }
        $result=mysql_query($sql,$con);
        while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
            $data[]=$row;
        }
        try{
            if (!isset($data)){
                throw new Exception("不存在该用户！");
            }
            else{
                $sql='DELETE * FROM '.$db.' WHERE username=$username';
                return array(
                    "status" => "success",
                    "errMsg" => NULL,
                );
            }
        }
        catch(Exception $e){
            throw new Exception("不存在该用户！");
        }
    }
    catch(Exception $e){
        return array(
            "status" => "failed",
            "errMsg" => $e->getMessage(),
            "data" => NULL,
        );
    }
    
}



//通过输入表名，用户名，修改位置，修改值-》修改人员属性，返回一个array包含是否成功的状态和错误信息
function revise_parameter($db,$username,$attribute,$value){
    $con = mysql_connect("localhost","root","root");
    if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }

    mysql_select_db('my_db', $con);

    $sql='SELECT * FROM '.$db.' WHERE username=$username'; 
    try{
        try{
            if (!mysql_query($sql,$con)){
                throw new Exception("系统出错！");
            }
        }
        catch(Exception $e){
            throw new Exception("系统出错！");
        }
        $result=mysql_query($sql,$con);
        while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
            $data[]=$row;
        }
        try{
            if (!isset($data)){
                throw new Exception("不存在该用户！");
            }
            else{ 
                $sql='UPDATE '.$db.' SET '.$attribute.'='.$value.' WHERE username='.$username;
                return array(
                    "status" => "success",
                    "errMsg" => NULL,
                );
            }
        }
        catch(Exception $e){
            throw new Exception("不存在该用户！");
        }
    }
    catch(Exception $e){
        return array(
            "status" => "failed",
            "errMsg" => $e->getMessage(),
            "data" => NULL,
        );
    }
    
}



//通过输入表名，用户名。返回一个array,包含所查询人物的属性
function check_parameter($db,$username){
    $con = mysql_connect("localhost","root","root");
    if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }

    mysql_select_db('my_db', $con);

    $sql='SELECT * FROM '.$db.' WHERE username=$username'; 
    
    try{
        try{
            if (!mysql_query($sql,$con)){
                throw new Exception("系统出错！");
            }
        }
        catch(Exception $e){
            throw new Exception("系统出错！");
        }
        $result=mysql_query($sql,$con);
        while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
            $data[]=$row;
        }
        try{
            if (!isset($data)){
                throw new Exception("不存在该用户！");
            }
            else{
                return array(
                    "status" => "success",
                    "errMsg" => NULL,
                    "data" => $data,
                );
            }
        }
        catch(Exception $e){
            throw new Exception("不存在该用户！");
        }
    }
    catch(Exception $e){
        return array(
            "status" => "failed",
            "errMsg" => $e->getMessage(),
            "data" => NULL,
        );
    }
    
}



//防止乱码生成的代码，使用方式:
//头部加header("Content-type:text/html;charset=utf-8");

// $json=decodeUnicode(json_encode(array(
//     "status" => $issuccess,
//     "errMsg" => $errMsg
// )));
function decodeUnicode($str)
{
return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
    create_function(
        '$matches',
        'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
    ),
    $str);
}
?>