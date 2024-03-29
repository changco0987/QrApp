<?php
    include_once '../db/connection.php';
    include_once '../db/tb_guardian.php';//tb_guardian.php
    include_once '../model/guardianModel.php';//guardianModel.php

    
    include_once '../db/tb_visitor.php';//tb_visitor.php
    include_once '../model/visitorModel.php';//visitorModel.php
    
    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';    

    include_once '../db/tb_qrsettings.php';
    include_once '../model/qrsettingsModel.php';    

    date_default_timezone_set('Asia/Manila'); 
    $log = new logsModel();

    $currentDateTime = date('Y-m-d h:i a');

    $qr = new qrsettingsModel();
    $qrResult = ReadQrSetting($conn,$qr);
    $qrData = mysqli_fetch_assoc($qrResult);

    //This will be used by 2 page the visitor and guardian login

        if($_POST['accTypeTb'] == 'visitor')
        {
            $data = new visitorModel();
            $data->setUsername($_POST['usernameTb']);
            
            //This will compute the expiry date it will add +12hrs to current date
            $date = new DateTime($_POST['qr_ExDateTb']);
            $date->add(new DateInterval('PT'.$qrData['expiryHrs'].'H'));
            $expiryDate = $date->format('Y-m-d h:i:s a');
            $data->setQr_ExDate($expiryDate);

            $result = ReadAccountVisitor($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
        
                session_start();
                $_SESSION['title'] = 'qremsystem';
                $_SESSION['accType'] = $_POST['accTypeTb'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['qr_ExDate'] = $data->getQr_ExDate();

                                
                //create log
                $log->setActivity('Generated new QR pass');
                $log->setIpAdd();
                $log->setAccType($_SESSION['accType']);
                $log->setCreator($_SESSION['username']);

                CreateLog($conn,$log);

                UpdateAccountVisitor($conn,$data);
                $qrData = array("title"=>$_SESSION['title'], "accType"=>$_SESSION['accType'], "username"=>$_SESSION['username'], "qr_ExDate"=>$_SESSION['qr_ExDate']);
                echo json_encode(base64_encode(serialize($qrData)));

            }

          //Throws back to the login page and show "This account is not existed"
          //echo '<script> localStorage.setItem("state",1); window.location = "../pages/visitorLogin.php";</script>';
          exit;
           
        }
        else if($_POST['accTypeTb'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setUsername($_POST['usernameTb']);

            //This will compute the expiry date it will add +12hrs to current date
            $date = new DateTime($_POST['qr_ExDateTb']);
            $date->add(new DateInterval('PT'.$qrData['expiryHrs'].'H'));
            $expiryDate = $date->format('Y-m-d h:i:s a');
            $data->setQr_ExDate($expiryDate);

            $result = ReadAccountGuardian($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
                session_start();
                $_SESSION['title'] = 'qremsystem';
                $_SESSION['accType'] = $_POST['accTypeTb'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['qr_ExDate'] = $data->getQr_ExDate();
                                                
                //create log
                $log->setActivity('Generated new QR pass');
                $log->setIpAdd();
                $log->setAccType($_SESSION['accType']);
                $log->setCreator($_SESSION['username']);

                CreateLog($conn,$log);

                UpdateAccountGuardian($conn,$data);
                $qrData = array("title"=>$_SESSION['title'], "accType"=>$_SESSION['accType'], "username"=>$_SESSION['username'], "qr_ExDate"=>$_SESSION['qr_ExDate']);
                echo json_encode(base64_encode(serialize($qrData)));
                exit;

            }
            
    
        }
  


   


?>