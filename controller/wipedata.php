<?php
    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';    

    date_default_timezone_set('Asia/Manila'); 
    session_start();

    //This will check if the session is set to avoid error
    if(isset($_SESSION['accType']) && isset($_SESSION['username']))
    {
        $log = new logsModel();
    
    
        //create log
        $log->setActivity('Sign-out');
        $log->setIpAdd();
        $log->setAccType($_SESSION['accType']);
        $log->setCreator($_SESSION['username']);
    
        CreateLog($conn,$log);
    }
    
    $helper = array_keys($_SESSION);
    foreach ($helper as $key)
    {
        unset($_SESSION[$key]);
    } 
    session_unset();
    header('Location: ../index.php');
?>