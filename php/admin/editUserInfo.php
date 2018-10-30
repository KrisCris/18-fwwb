<?php

//修改用户信息
require 'database.php';
set('user', 'id', $_GET['id'], [['name', $_GET['name']], ['username', $_GET['username']], ['password', $_GET['password']], ['facialData', $_GET['facial']], ['company', $_GET['company']], ['mail', $_GET['mail']], ['phone', $_GET['phone']], ['isCensored', $_GET['is']], ['token', $_GET['token']], ['userGroup', $_GET['group']], ['identificationNum', $_GET['identification']]]);
json_encode([code => 1]);
