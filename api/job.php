<?php
session_start();

require_once("./access.php");
require_once("./pdo/PdoMySQL.class.php");
$db = new PdoMySQL();
// 生成目录
function make_dir($dir){
    mkdir ($dir, 0755, true);
    chmod ($dir, 0755);
}

// 添加一个职位
if(isset($_GET['add_job'])){
    $job_type = addslashes($_GET['job_type']);
    $job_name = addslashes($_GET['job_name']);
    $need_num = addslashes($_GET['need_num']);
    $job_info = addslashes($_GET['job_info']);
    // 查询是否存在职位名
    $sql = "SELECT 1 FROM job_table WHERE job_name = '{$job_name}' AND job_type = '{$job_type}'";
    $res = $db->getOne($sql);
    if(empty($res)){
        // 查询 type_id
        $sql = "SELECT id FROM job_type WHERE job_type = '{$job_type}'";
        $res = $db->getOne($sql);
        $job_type_id = $res['id'];
        $sql = "INSERT INTO job_table (job_type_id,job_type,job_name,need_num,job_info) VALUES ('{$job_type_id}','{$job_type}','{$job_name}','{$need_num}','{$job_info}')";
        $res = $db->execute($sql);
        // 查询 job_id
        $sql = "SELECT id FROM job_table WHERE job_name = '{$job_name}' AND job_type = '{$job_type}'";
        $res = $db->getOne($sql);
        $job_id = $res['id'];
        // 新建职位id文件夹
        make_dir('../down/jobs/'.$job_id);
        echo 'ok';
    }else{
        echo 'has';
    }
}

// 获取所有职位
if(isset($_GET['get_jobs'])){
    $sql = "SELECT * FROM job_table ORDER BY id DESC";
    $res = $db->getAll($sql);
    echo json_encode($res);
}