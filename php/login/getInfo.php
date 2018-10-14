<?php

header("Content-type:text/html;charset=utf-8");

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("my_db", $con);

$result = mysql_query("SELECT * FROM adiministrators");

while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
    $data[]=$row;
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

echo decodeUnicode(json_encode($data));

mysql_close($con)
?>