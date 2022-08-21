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
            

            $result = ReadAccountVisitor($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
        
                echo json_encode('Expires on: '.date("m-d-Y g:i A", strtotime($row['qr_ExDate'])), JSON_HEX_TAG);

            }

          //Throws back to the login page and show "This account is not existed"
          //echo '<script> localStorage.setItem("state",1); window.location = "../pages/visitorLogin.php";</script>';
          exit;
           
        }
        else if($_POST['accTypeTb'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setUsername($_POST['usernameTb']);


            $result = ReadAccountGuardian($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
        
                echo json_encode('Expires on: '.date("m/d/Y g:i A", strtotime($row['qr_ExDate'])));

            }
            
    
        }
  


   


?>