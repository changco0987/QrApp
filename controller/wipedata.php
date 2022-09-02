<?php
    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';    

    date_default_timezone_set('Asia/Manila'); 
    session_start();

    $log = new logsModel();


    //create log
    $log->setActivity('Sign-out');
    $log->setIpAdd();
    $log->setCreator($_SESSION['username']);

    CreateLog($conn,$log);
    
    $helper = array_keys($_SESSION);
    foreach ($helper as $key)
    {
        unset($_SESSION[$key]);
    } 
    session_unset();
    header('Location: ../index.php');
?>