<?php
    include_once 'connection.php';
    include_once '../model/qrsettingsModel.php';

    $qr = new qrsettingsModel();
    function CreateQrSetting($conn,$qr)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d h:i:s a');
        //$address = mysqli_real_escape_string($conn,$data->getAddress());
        mysqli_query($conn,"INSERT INTO qrsettingstb(expiryHrs, qrStatus) values(".$qr->getExpiryHrs().",'".$qr->getQrStatus()."')");
    }

    function ReadQrSetting($conn,$qr)
    {
        if($qr->getExpiryHrs()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM qrsettingstb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM qrsettingstb WHERE expiryHrs = ".$qr->getExpiryHrs());
        }

        return $dbData;
    }

    function UpdateQrSetting($conn,$qr)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d h:i:s a');

        if($qr->getExpiryHrs())
        {
            mysqli_query($conn,"UPDATE qrsettingstb set expiryHrs = ".$qr->getExpiryHrs()." where id =".$qr->getId());
        }
        else
        {
            mysqli_query($conn,"UPDATE qrsettingstb set qrStatus = '".$qr->getQrStatus()."' where id =".$qr->getId());
        }
        //$address = mysqli_real_escape_string($conn,$logs->getAddress());
    }

    function DeleteQrSetting($conn,$qr)
    {
        mysqli_query($conn,"DELETE from qrsettingstb where id = ".$qr->getId());
    }

?>