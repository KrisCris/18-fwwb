<?php

    header("Content-type:text/html;charset=utf-8");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $issuccess="success";
    $errMsg="";
    $con = mysqli_connect("localhost","root","910189033");
    if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }

    mysqli_select_db("cs_db", $con);

    $sql='SELECT * FROM user WHERE (username=$username AND password=$password)'; 
    
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
                throw new Exception("用户名或密码错误！");
            }
        }
        catch(Exception $e){
            throw new Exception("用户名或密码错误！");
        }
    }
    catch(Exception $e){
        $errMsg=$e->getMessage();
        $issuccess="failed";
    }

    function decodeUnicode($str)
    {
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
    }


    // if (!mysql_query($sql,$con))
    //   {
    //   die('Error: ' . mysql_error());
    //   }
    $json=decodeUnicode(json_encode(array(
        "status" => $issuccess,
        "errMsg" => $errMsg
    )));
    echo $json;
    mysql_close($con)
?>