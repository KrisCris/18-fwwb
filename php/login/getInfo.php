<?php
//edited by hpc
//查表，用户名 和 公司
//test：
$companies = ["test1","test2","test3"];
$usernames = ["WRF_test","HPC_test"];

echo json_encode(["companies"=>$companies,"usernames"=>$usernames]);