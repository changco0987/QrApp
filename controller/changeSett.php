<?php
    include_once '../db/connection.php';
    include_once '../db/tb_qrsettings.php';
    include_once '../model/qrsettingsModel.php';
    
    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';

    $log = new logsModel();
    session_start();
    if(isset($_POST['submitQrSett']))
    {
        $qr = new qrsettingsModel();
        $qr->setId($_POST['qrIdTb']);
        $qr->setExpiryHrs($_POST['qrExpiryTb']);
                
        //create log
        $log->setActivity('changed QR expiry allotted time to '.$_POST['qrExpiryTb']);
        $log->setIpAdd();
        $log->setAccType('Administrator');
        $log->setCreator($_SESSION['adminNameTb']);
    
        CreateLog($conn,$log);
        UpdateQrSetting($conn,$qr);

        echo 'Success';

    }
    else
    {
        header("location: ../admin.php");
    }

?>