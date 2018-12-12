<?php
    header("Content-type:text/html;charset=utf-8");
    require("database.php");
    $sql="SELECT * FROM company";
    $data=sql_str($sql);
    echo json_encode($data);
    // auther：hgz
?>
