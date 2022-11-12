<?php
    include_once '../db/connection.php';
    include_once '../db/tb_qrsettings.php';
    include_once '../model/qrsettingsModel.php';

    if(isset($_POST['submitQrSett']))
    {
        $qr = new qrsettingsModel();
        $qr->setId($_POST['qrIdTb']);
        $qr->setExpiryHrs($_POST['qrExpiryTb']);

        UpdateQrSetting($conn,$qr);

        echo 'Success';

    }
    else
    {
        header("location: ../admin.php");
    }

?>