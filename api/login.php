<?php
session_start();

require_once("./access.php");
require_once("./pdo/PdoMySQL.class.php");
$db = new PdoMySQL();

// 登录
if(isset($_GET['login'])){
    $pwd = $_GET['login'];
    $sql = "SELECT u_pwd FROM admin_job WHERE id = 1";
    $res = $db->getOne($sql);
    if($pwd == $res['u_pwd']){
        $_SESSION['admin_status'] = 'ing';
        echo 'go';
    }else{
        echo 'ban';
    }
}

// 检测登录状态
if(isset($_GET['check_login'])){
    // 部署
    // echo $_SESSION['admin_status'];
    echo 'ing';
    // if($_SESSION['admin_status'] == 'ing'){
    //     echo 'ing';
    // }else{
    //     echo 'ban';
    // }
}

// 退出
if(isset($_GET['logout'])){
	session_destroy();
	
	echo "bye";
}

// 修改密码
if(isset($_GET['change_pwd'])){
    $n_pwd = addslashes($_GET['change_pwd']);
    $o_pwd = addslashes($_GET['o_pwd']);
    // 查询原始密码是否正确
    $sql = "SELECT u_pwd FROM admin_job WHERE id = 1";
    $res = $db->getOne($sql);
    $pwd = $res['u_pwd'];
    if($o_pwd == $pwd){
        $sql = "UPDATE admin_job SET u_pwd = '{$n_pwd}' WHERE id = 1";
        $res = $db->execute($sql);
        echo 'ok';
    }else{
        echo 'ban';
    }
}