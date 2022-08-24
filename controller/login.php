<?php
    include_once '../db/connection.php';
    include_once '../db/tb_guardian.php';//tb_guardian.php
    include_once '../model/guardianModel.php';//guardianModel.php

    
    include_once '../db/tb_visitor.php';//tb_visitor.php
    include_once '../model/visitorModel.php';//visitorModel.php

    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i:s a');

    //This will be used by 2 page the visitor and guardian login
    if(isset($_POST['accType']))
    {
        if($_POST['accType'] == 'visitor')
        {
            $data = new visitorModel();
            $data->setUsername($_POST['usernameTb']);
            $data->setPassword($_POST['passwordTb']);

            $result = ReadAccountVisitor($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
               //to check if the username and password is match
               if($row['password']==$data->getPassword())
               {          
                    session_start();
                    $_SESSION['accType'] = $_POST['accType'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $_POST['passwordTb'];

                    //to format the datetime
                    $formattedDate1 = strtotime($row['qr_ExDate']);
                    $formattedDate2 = strtotime($currentDateTime);

                    //to check if the qr(datetime) is expired
                    if($row['qr_ExDate']!==null && $formattedDate1 > $formattedDate2)
                    {
                         $_SESSION['qr_ExDate'] = $row['qr_ExDate'];
                         //echo 'not null';
                    }
                    else
                    {
                         $_SESSION['qr_ExDate'] = null;
                         //echo 'null '.$row['qr_ExDate'];
                    }
                    

                    //$_SESSION['qr_ExDate'] = $row['qr_ExDate'];
                    header("Location: ../pages/userDashboard.php");
                    exit;
               }
               else
               {
                    //Throws back to the login page and show "Incorrect password"
                    echo '<script> localStorage.setItem("state",1); window.location = "../pages/visitorLogin.php";</script>';
               }
            }

          //Throws back to the login page and show "This account is not existed"
          echo '<script> localStorage.setItem("state",2); window.location = "../pages/visitorLogin.php";</script>';
          exit;
           
        }
        else if($_POST['accType'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setUsername($_POST['usernameTb']);
            $data->setPassword($_POST['passwordTb']);

            $result = ReadAccountGuardian($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
               //to check if the username and password is match
               if($row['password']==$data->getPassword())
               {          
                    session_start();
                    $_SESSION['accType'] = $_POST['accType'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $_POST['passwordTb'];


                    //to format the datetime
                    $formattedDate1 = strtotime($row['qr_ExDate']);
                    $formattedDate2 = strtotime($currentDateTime);

                    //to check if the qr(datetime) is expired
                    if($row['qr_ExDate']!==null && $formattedDate1 > $formattedDate2)
                    {
                         $_SESSION['qr_ExDate'] = $row['qr_ExDate'];
                         //echo 'not null';
                    }
                    else
                    {
                         $_SESSION['qr_ExDate'] = null;
                         //echo 'null '.$row['qr_ExDate'];
                    }
                    
                    //$_SESSION['qr_ExDate'] = $row['qr_ExDate'];
                    header("Location: ../pages/userDashboard.php");
                    exit;
               }
               else
               {
                    //Throws back to the login page and show "Incorrect password"
                    echo '<script> localStorage.setItem("state",1); window.location = "../pages/guardianLogin.php";</script>';
               }
            }

           //Throws back to the login page and show "This account is not existed"
          echo '<script> localStorage.setItem("state",2); window.location = "../pages/guardianLogin.php";</script>';
          exit;
    
        }
    }
    else
    {
        echo 'Error encountered in getting the element named="accType"';
    }

    //This will fix the format from mysql to php
    function formatDatetime($datetime)
     {
          $newDate = new DateTime($datetime);
          
          return $newDate->format('Y-m-d h:i:s a');
    }





?>