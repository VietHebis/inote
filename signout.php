<?php

// Include database, session, general info
require_once 'core/init.php';
// Xoá session
$session->del();
// Trở về trang chủ
header('Location: index.php');

?>