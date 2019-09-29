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

// 删除一个部门
if(isset($_GET['del_type'])){
    $del_type = $_GET['del_type'];
    $sql = "DELETE FROM job_type WHERE job_type = '{$del_type}'";
    $res = $db->execute($sql);
    echo 'ok';
}

// 修改一个部门
if(isset($_GET['change_type'])){
    $change_type = $_GET['change_type'];
    $change_new_type = addslashes($_GET['change_new_type']);
    $sql = "UPDATE job_type SET job_type = '{$change_new_type}' WHERE job_type = '{$change_type}'";
    $res = $db->execute($sql);
    echo 'ok';
}