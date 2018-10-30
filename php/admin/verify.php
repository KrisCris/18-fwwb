<?php

//按下通过按钮之后审核通过
require 'database.php';
set('user', 'id', $_GET['id'], '[isCenscored,1]');
json_encode([code => 1]);
