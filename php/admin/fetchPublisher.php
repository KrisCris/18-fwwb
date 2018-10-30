<?php

//获取用户信息
require 'database.php';
$sql = 'SELECT name,username,password,facialData,company,mail,phone,token,userGroup,identificationNum FROM user';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<br> name:'.$row['id'].' - username:'.$row['username'].' - password:'.$row['password'].' - facialData:'.$row['facialData'].' - company:'.$row['company'].' - mail:'.$row['mail'].' - phone:'.$row['phone'].' - token:'.$row['token'].' - userGroup:'.$row['userGroup'].' - identificationNum:'.$row['identificatinoNum'];
    }
} else {
    echo '0 results';
}
