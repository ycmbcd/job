<?php
session_start();

require_once("./access.php");
require_once("./pdo/PdoMySQL.class.php");
$db = new PdoMySQL();

// 查询部门
if(isset($_GET['get_type'])){
    $sql = "SELECT * FROM job_type ORDER BY id DESC";
    $res = $db->getAll($sql);
    echo json_encode($res);
}


// 添加一个部门
if(isset($_GET['add_type'])){
    $add_type = addslashes($_GET['add_type']);
    $sql = "SELECT 1 FROM job_type WHERE job_type = '{$add_type}'";
    $res = $db->getOne($sql);
    if(empty($res)){
        $sql = "INSERT INTO job_type (job_type) VALUES ('{$add_type}')";
        $res = $db->execute($sql);
        echo 'ok';
    }else{
        echo 'has';
    }
}

