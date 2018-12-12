<?php

//获取项目信息
require 'database.php';
$sql = 'SELECT prjName,publisher,demandPath,prjBegin,prjEnd,hasDone FROM project';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<br> prjName:'.$row['prjName'].' - publisher:'.$row['publisher'].' - demandPath:'.$row['demandPath'].' - prjBegin:'.$row['prjBegin'].' - prjEnd:'.$row['prjEnd'].' - hasDone:'.$row['hasDone'];
    }
} else {
    echo '0 results';
}
