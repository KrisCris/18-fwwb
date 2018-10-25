<?php

$id = $_POST['personId'];
$passed = $_POST['hasPass'];
//很多东西都忘光了总之先连带着思路作为注释一起打出来也不知道对不对
require '../database.php';
    //如果按了通过按钮就会使是否通过的变量为true顺带向数据库返回一个值
    if ($passed) {
        set('user', 'id', 'personId', '[isCenscored,1]');
    }
    //如果按了不通过就会使是否通过的变量为false顺带向数据库返回另一个值
    if (!$passed) {
        set('user', 'id', 'personId', '[isCenscored,-1]');
    }
