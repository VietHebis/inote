<?php
class Session
{
    public function send($user)
    {
        $_SESSION['user'] = $user;
    }

    public function start()
    {
        session_start();
    }

    public function get()
    {
        $user = isset($_SESSION['user']) ?  $_SESSION['user'] : '';
        return $user ;
    }

    public function del()
    {
        session_destroy();
    }
}