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

// 删除一个职位
if(isset($_GET['del_job'])){
    $job_id = $_GET['del_job'];
    $sql = "DELETE FROM job_table WHERE id = '{$job_id}'";
    $res = $db->execute($sql);
    echo 'ok';
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

// 获取一个职位详情
if(isset($_GET['job_show'])){
    $job_id = $_GET['job_show'];
    $sql = "SELECT * FROM job_table WHERE id = '{$job_id}'";
    $res = $db->getOne($sql);
    echo json_encode($res);
}

// 投递一个简历
if(isset($_GET['send_resume'])){
    $job_id = addslashes($_GET['job_id']);
    $u_name = addslashes($_GET['u_name']);
    $u_mate = addslashes($_GET['u_mate']);
    $u_birthday = addslashes($_GET['u_birthday']);
    $u_tel = addslashes($_GET['u_tel']);
    $u_email = addslashes($_GET['u_email']);
    $u_school = addslashes($_GET['u_school']);
    $u_major = addslashes($_GET['u_major']);
    $u_education = addslashes($_GET['u_education']);
    $u_info = addslashes($_GET['u_info']);
    $sql = "INSERT INTO send_resume (
        job_id,
        u_name,
        u_mate,
        u_tel,
        u_email,
        u_birthday,
        u_school,
        u_major,
        u_education,
        u_info
        ) VALUES (
        '{$job_id}',
        '{$u_name}',
        '{$u_mate}',
        '{$u_tel}',
        '{$u_email}',
        '{$u_birthday}',
        '{$u_school}',
        '{$u_major}',
        '{$u_education}',
        '{$u_info}')";
    $res = $db->execute($sql);
    echo 'ok';
}

// 生成图片
if(isset($_POST['resume_png'])){
    // header('Content-type:text/html;charset=utf-8');
    $job_id = $_POST['job_id'];
    $resume_png = $_POST['resume_png'];
    $u_name = addslashes($_POST['u_name']);
    $u_tel = addslashes($_POST['u_tel']);

    if (strstr($resume_png,",")){
        $resume_png = explode(',',$resume_png);
        $resume_png = $resume_png[1];
    }

    $resume_name = $u_name."-".rand(10,100)."-".$u_tel;

    // 名字+电话号码
    $new_file = "../down/jobs/".$resume_name.".png";

    if (file_put_contents($new_file, base64_decode($resume_png))){
        // 投递计数
        $sql = "UPDATE job_table SET receive_num = receive_num + 1 WHERE id='{$job_id}'";
        $res = $db->execute($sql);
        // 简历名录
        $sql = "INSERT INTO resume_table (job_id, resume_name) VALUES ('{$job_id}', '{$resume_name}')";
        $res = $db->execute($sql);
        echo 'ok';
    }

}

// 下载简历
if(isset($_GET['down_resume'])){
    $down_resume = $_GET['down_resume'];
    $job_ids = '';
    foreach($down_resume as $val){
        $job_ids = $job_ids.'\''.$val.'\',';
    }
    $job_ids = trim($job_ids, ',');

    $sql = "SELECT resume_name FROM resume_table WHERE job_id in ($job_ids)";
    $res = $db->getAll($sql);

    $fileList = array();

    foreach($res as $val){
        array_push($fileList, "../down/jobs/".$val['resume_name'].".png");
    }
 
    $filename = "../down/download.zip"; // 压缩包所在的位置路径
 
    $zip = new ZipArchive();
    $zip->open($filename,ZipArchive::CREATE);   //打开压缩包
    foreach($fileList as $file){
        $zip->addFile($file,basename($file));   //向压缩包中添加文件
    }
    $zip->close();  //关闭压缩包

    echo "ok";
}

// 下载简历person
if(isset($_GET['down_resume_person'])){
    $down_resume = $_GET['down_resume_person'];

    $fileList = array();
    foreach($down_resume as $val){
        array_push($fileList, "../down/jobs/".$val.".png");
    }
 
    $filename = "../down/person.zip"; // 压缩包所在的位置路径
 
    $zip = new ZipArchive();
    $zip->open($filename,ZipArchive::CREATE);   //打开压缩包
    foreach($fileList as $file){
        $zip->addFile($file,basename($file));   //向压缩包中添加文件
    }
    $zip->close();  //关闭压缩包

    echo "ok";
}


// 所有简历查看
if(isset($_GET['view_resume'])){
    $sql = "SELECT t1.resume_name AS resume_name,t2.job_name AS job_name,t2.job_type AS job_type FROM resume_table t1,job_table t2 WHERE t1.job_id = t2.id";
    $res = $db->getAll($sql);
    echo json_encode($res);
}

// 简历预览
if(isset($_GET['preview'])){
    $resume_name = addslashes($_GET['preview']);
    echo '<div style="margin:0 auto;width: 730px;"><img src="../down/jobs/'.$resume_name.'.png" /></div>';
}

// 下载简历表格
// if(isset($_GET['down_resume_xlsx'])){
//     $down_resume = $_GET['down_resume_xlsx'];
//     $items = '';
//     foreach($down_resume AS $val){
//         $items = $items.'\''.$val.'\',';
//     }
//     $items = trim($items,',');
//     echo $items;
// }