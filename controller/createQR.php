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
            $data->setQr_ExDate($_POST['qr_ExDateTb']);

            $result = ReadAccountVisitor($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
        
                session_start();
                $_SESSION['title'] = 'qremsystem';
                $_SESSION['accTypeTb'] = $_POST['accTypeTb'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['qr_ExDate'] = $row['qr_ExDate'];

                //to check if the qr is expired
                if($row['qr_ExDate']!=null && $row['qr_ExDate'] > $currentDateTime)
                {
                        $_SESSION['qr_ExDate'] = $row['qr_ExDate'];
                }
                else
                {
                        $_SESSION['qr_ExDate'] = null;
                }
                $qrData = array("title"=>$_SESSION['title'], "accType"=>$_SESSION['accTypeTb'], "username"=>$_SESSION['username'], "qr_ExDate"=>$_SESSION['qr_ExDate']);
                echo json_encode(base64_encode(serialize($qrData)));
                exit;

            }

          //Throws back to the login page and show "This account is not existed"
          //echo '<script> localStorage.setItem("state",1); window.location = "../pages/visitorLogin.php";</script>';
          exit;
           
        }
        else if($_POST['accTypeTb'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setUsername($_POST['usernameTb']);
            $data->setPassword($_POST['passwordTb']);

            $result = ReadAccountGuardian($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
        
                session_start();
                $_SESSION['title'] = 'qremsystem';
                $_SESSION['accTypeTb'] = $_POST['accTypeTb'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['qr_ExDate'] = $row['qr_ExDate'];

                //to check if the qr is expired
                if($row['qr_ExDate']!=null && $row['qr_ExDate'] > $currentDateTime)
                {
                        $_SESSION['qr_ExDate'] = $row['qr_ExDate'];
                }
                else
                {
                        $_SESSION['qr_ExDate'] = null;
                }
                $qrData = array("title"=>$_SESSION['title'], "accType"=>$_SESSION['accTypeTb'], "username"=>$_SESSION['username'], "qr_ExDate"=>$_SESSION['qr_ExDate']);
                echo json_encode(base64_encode(serialize($qrData)));
                exit;

            }
            
    
        }
  


   


?>