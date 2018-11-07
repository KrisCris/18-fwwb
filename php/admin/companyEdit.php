<?php

//修改公司信息
require 'database.php';
set('company', 'id', $_POST['id'], [['companyName', $_POST['companyname']], ['regDate', $_POST['regDate']], ['responsiblePerson', $_POST['responsible']], ['address', $_POST['address']], ['contact', $_POST['contact']]]);
json_encode([code => 1]);
