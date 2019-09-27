<?php
session_start();

require_once("./access.php");
require_once("./pdo/PdoMySQL.class.php");
$db = new PdoMySQL();

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

//退出
if(isset($_GET['logout'])){
	session_destroy();
	
	echo "bye";
}
