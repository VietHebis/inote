<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/classes/Session.php';

// khởi tạo object DB
$db = new DB();
// Kết nối db
$db->connect();

// Khởi tạo session

$session = new Session();
// start session
$session->start();
//get session
$user = $session->get();
//set default timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');
$date_current = '';
$date_current = date('Y-m-d H:i:s');

if ($user)
{
    $sql = "select * from users where username = '$user'";
    $data_user = $db->fetch_assoc($sql,1);
}