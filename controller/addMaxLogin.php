<?php
    include_once '../db/connection.php';
    include_once '../db/tb_admin.php';
    include_once '../model/adminModel.php';

    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';

    session_start();

    $log = new logsModel();
    if(isset($_SESSION['adminNameTb']))
    {
        if($_POST['addLoginTb'] <= 0)
        {
            echo '<script> localStorage.setItem("signalLogs",2); window.location = "../admin/admin_logs.php";</script>';
            exit;
        }
        else
        {
            $data = new adminModel();
            $data->setId($_POST['idTb']);
            $data->setLoginCount($_POST['addLoginTb']);
            UpdateAdmin($conn,$data);
                
            //create log
            $log->setActivity('changed max login to '.$_POST['addLoginTb']);
            $log->setIpAdd();
            $log->setAccType('Administrator');
            $log->setCreator($_SESSION['adminNameTb']);
        
            CreateLog($conn,$log);
            echo '<script> localStorage.setItem("signalLogs",1); window.location = "../admin/admin_logs.php";</script>';
            exit;
        }


    }
    else
    {
        header("Location: ../admin.php");
    }

?>