<?php

//修改用户信息
require 'database.php';
set('user', 'id', $_POST['id'], [['name', $_POST['name']], ['username', $_POST['username']], ['password', $_POST['password']], ['facialData', $_POST['facial']], ['company', $_POST['company']], ['mail', $_POST['mail']], ['phone', $_POST['phone']], ['isCensored', $_POST['is']], ['token', $_POST['token']], ['userGroup', $_POST['group']], ['identificationNum', $_POST['identification']]]);
json_encode([code => 1]);
