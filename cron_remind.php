<?php
/**
 * Created by PhpStorm.
 * User: viettran
 * Date: 9/12/18
 * Time: 5:31 PM
 */
require_once 'classes/DB.php';
// khởi tạo object DB
$db = new DB();
// Kết nối db
$db->connect();
//Import the PHPMailer class into the global namespace
//use PHPMailer\PHPMailer\PHPMailer;

date_default_timezone_set('Asia/Ho_Chi_Minh');
$date_current = '';
$date_current = date('Y-m-d H:i:s');

////Send Mail
//function _sendmail($email = '' ,$name = '', $subject = '',$content = '')
//{
//
////SMTP needs accurate times, and the PHP time zone MUST be set
////This should be done in your php.ini, but this is how to do it if you don't have access to that
//    require '../vendor/autoload.php';
////Create a new PHPMailer instance
//    $mail = new PHPMailer;
////Tell PHPMailer to use SMTP
//    $mail->isSMTP();
////Enable SMTP debugging
//// 0 = off (for production use)
//// 1 = client messages
//// 2 = client and server messages
//    $mail->SMTPDebug = 2;
////Set the hostname of the mail server
//    $mail->Host = 'mail.example.com';
////Set the SMTP port number - likely to be 25, 465 or 587
//    $mail->Port = 587;
////Whether to use SMTP authentication
//    $mail->SMTPAuth = true;
////Username to use for SMTP authentication
//    $mail->Username = 'viet.tranquoc@digitel.com.vn';
////Password to use for SMTP authentication
//    $mail->Password = '0906570205';
////Set who the message is to be sent from
//    $mail->setFrom('Remindc@hebis.vn', 'Remind');
////Set an alternative reply-to address
//    $mail->addReplyTo('viet.tranquoc@digitel.com.vn', 'Viet Tran');
////Set who the message is to be sent to
//    $mail->addAddress($email, $name);
////Set the subject line
//    $mail->Subject = $subject;
////Read an HTML message body from an external file, convert referenced images to embedded,
////convert HTML into a basic plain-text alternative body
//    $mail->msgHTML($content);
//
////send the message, check for errors
//    if (!$mail->send()) {
//        echo 'Mailer Error: ' . $mail->ErrorInfo;
//    } else {
//        echo 'Message sent!';
//    }
//}

$sql = "SELECT * FROM notes LEFT JOIN users ON notes.user_id = users.id_user WHERE remind = 1"; // Lay thong tin remind
$data = $db->fetch_assoc($sql,0);
//foreach ($data as $d){
//    echo $d['date_remind'];
//}
// Lap
if (!$data)
{
    $sql_monitor_mail = "INSERT INTO monitor_mail VALUES (
            '',
            0,
            '$date_current',
            '',
            '',
            ''
        )";
    $db->query($sql_monitor_mail);
    exit();
}
foreach ($data as $d)
{
    //$created = $d['date_created'];
    $email = $d['username'];
    $name = preg_replace('/@[^,]+/', '', $email);
    $subject = $d['title'];
    $created = $d['date_remind'];
    $content = 'Hi <i>'.$name.'</i> Bạn có 1 ghi chú vào lúc: <b>'.$created.'</b> Nội dung là: <u>'.$d["body"].'</u>';
    $user_id = $d['user_id'];
    $id_note = $d['id_note'];
    //echo $content;die();
    $min_created = substr($created,14,2);
    $min_current = substr($date_current,14,2);
    $hour_created = substr($created,11,2);
    $hour_current = substr($date_current,11,2);
    $day_created = substr($created,8,2);
    $day_current = substr($date_current,8,2);
    $month_created = substr($created,5,2);
    $month_current = substr($date_current,5,2);
    $year_created = substr($created,0,4);
    $year_current = substr($date_current,0,4);
    //echo $current.'<br>';
    //echo $created.'<br>';
    $min =  $min_created - $min_current;
    $hour = $hour_current - $hour_created;
    $day = $day_current - $day_created;
    $month = $month_current - $month_created;
    $year = $year_current - $year_created;
    if ($min <= 20 && $hour <= 1 &&  $day == 0 && $month == 0 &&  $year == 0)
    {
        $db->_sendmail($email,$name,$subject,$content);
        $sql_edit_note = "UPDATE notes SET
           remind = 0,
           date_remind = null 
            WHERE user_id = '$user_id' AND id_note = '$id_note'
        ";
        // Thực thi truy vấn
        $db->query($sql_edit_note);
        $sql_monitor_mail = "INSERT INTO monitor_mail VALUES (
            '',
            1,
            '$date_current',
            '$subject',
            '$content',
            '$email'
        )";
        $db->query($sql_monitor_mail);
    }
    else
    {
        echo 'Wrong Day !';
        return false;
    }

}

echo 'Sent Remind ! <br>';
// Giải phóng kết nối
$db->close_connect();
exit();
//$db->_sendmail('viettran1301@gmail.com','Viet Tran','Test 01','Day la bai test 01 ');

