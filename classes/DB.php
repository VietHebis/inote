<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
class DB
{
    //  declare private config
    private $hotsname = 'localhost',
            $username = 'root',
            $password = 'vi$t1995',
            $dbname   = 'inote';

    // declare var connect
    public $cn = '',
           $rs = '';

    // Function connect
    public function connect()
    {
         $this->cn = mysqli_connect($this->hotsname,$this->username,$this->password,$this->dbname);
         mysqli_set_charset($this->cn, "utf8");
    }
    // Dis connect
    public function close_connect()
    {
        if ($this->cn)
        {
            mysqli_close($this->cn);
        }
    }
    // Query
    public function query($sql = '')
    {
        if ($this->cn)
        {
            mysqli_query($this->cn,$sql);
        }
    }
    // Num row
    public function num_rows($sql ='')
    {
        if ($this->cn)
        {
            $query = mysqli_query($this->cn,$sql);
            $row = mysqli_num_rows($query);
            return $row;
        }
    }
    public function fetch_assoc($sql = '',$type)
    {
        if ($this->cn)
        {
            $query = mysqli_query($this->cn,$sql);
            $data = [];
            if ($type == 0)
            {
                while ($row = mysqli_fetch_assoc($query))
                {
                    $data[] = $row;
                }
                return $data;
            }
            elseif ($type == 1)
            {
                $data = mysqli_fetch_assoc($query);
                return $data;
            }
        }
    }

    public function real_escape_string($string)
    {
        if ($this->cn)
        {
            $string = mysqli_real_escape_string($this->cn, $string);
        }
        else
        {
            $string = $string;
        }
        return $string;
    }

    //lấy id vừa insert
    public function insert_id()
    {
        if ($this->cn)
        {
            return mysqli_insert_id($this->cn);
        }
    }

    //Send Mail
    function _sendmail($email = '' ,$name = '', $subject = '',$content = '')
    {

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
        //require '../vendor/autoload.php';
//Create a new PHPMailer instance
        $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
        $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 2;
//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 587;
//Whether to use SMTP authentication
        $mail->SMTPAuth = true;
//Username to use for SMTP authentication
        $mail->Username = 'viet.tranquoc@digitel.com.vn';
//Password to use for SMTP authentication
        $mail->Password = 'vi$t1995';

        $mail->CharSet = 'utf-8';
//Set who the message is to be sent from
        $mail->setFrom('Remind@hebis.vn', 'Remind');
//Set an alternative reply-to address
        $mail->addReplyTo('viet.tranquoc@digitel.com.vn', 'Viet Tran');
//Set who the message is to be sent to
        $mail->addAddress($email, $name);
//Set the subject line
        $mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
        $mail->msgHTML($content);

//send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
}