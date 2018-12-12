<?php

//获取进行中项目信息
require 'database.php';
get('project', 'hasDone', '0');
json_encode([code => 1]);
