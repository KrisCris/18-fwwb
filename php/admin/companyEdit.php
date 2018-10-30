<?php

//修改公司信息
require 'database.php';
set('company', 'id', $_GET['id'], [['companyName', $_GET['companyname']], ['regDate', $_GET['regDate']], ['responsiblePerson', $_GET['responsible']], ['address', $_GET['address']], ['contact', $_GET['contact']]]);
json_encode([code => 1]);
