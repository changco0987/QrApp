<?php
    include_once '../db/connection.php';
    include_once '../db/tb_qrsettings.php';
    include_once '../model/qrsettingsModel.php';
    
    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';


    session_start();
    if(isset($_POST['submitQrStat']))
    {
        $qr = new qrsettingsModel();
        $qr->setId($_POST['qrStatId']);
        $qr->setQrStatus($_POST['qrStatTb']);

        UpdateQrSetting($conn,$qr);

        //create log
        $log->setActivity('Locked all QR code');
        $log->setIpAdd();
        $log->setAccType('Administrator');
        $log->setCreator($_SESSION['adminNameTb']);
    
        CreateLog($conn,$log);
    }

?>