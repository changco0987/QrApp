<?php
    include_once '../db/connection.php';
    
    include_once '../db/tb_admin.php';
    include_once '../model/adminModel.php';    

    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';    

    date_default_timezone_set('Asia/Manila'); 
    session_start();

    //This will check if the session is set to avoid error
    if(isset($_SESSION['adminNameTb']))
    {
        $log = new logsModel();
    
    
        //create log
        $log->setActivity('Sign-out');
        $log->setIpAdd();
        $log->setAccType('Administrator');
        $log->setCreator($_SESSION['adminNameTb']);
    
        CreateLog($conn,$log);
    }
    //to reduce the activeLogin by 1
    $data = new adminModel();
    $result = ReadAdmin($conn,$data);

    $row = mysqli_fetch_assoc($result);

    $active = $row['activeLogin'];
    if($active!=0)
    {
        $active--;
    }
    $data->setActiveLogin($active);
    UpdateAdmin($conn,$data);

   

    $helper = array_keys($_SESSION);
    foreach ($helper as $key)
    {
        unset($_SESSION[$key]);
    } 
    session_unset();
    header('Location: ../admin.php');
?>