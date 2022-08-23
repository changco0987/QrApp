<?php
    include_once '../db/connection.php';
    include_once '../db/tb_guardian.php';//tb_guardian.php
    include_once '../model/guardianModel.php';//guardianModel.php

    
    include_once '../db/tb_visitor.php';//tb_visitor.php
    include_once '../model/visitorModel.php';//visitorModel.php

    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i a');

    //This will be used by 2 page the visitor and guardian login

        if($_POST['accTypeTb'] == 'visitor')
        {
            $data = new visitorModel();
            $data->setUsername($_POST['usernameTb']);
            
            //This will compute the expiry date it will add +12hrs to current date
            $date = new DateTime($_POST['qr_ExDateTb']);
            $date->add(new DateInterval('PT12H'));
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
            $date->add(new DateInterval('PT12H'));
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

                UpdateAccountGuardian($conn,$data);
                $qrData = array("title"=>$_SESSION['title'], "accType"=>$_SESSION['accType'], "username"=>$_SESSION['username'], "qr_ExDate"=>$_SESSION['qr_ExDate']);
                echo json_encode(base64_encode(serialize($qrData)));
                exit;

            }
            
    
        }
  


   


?>