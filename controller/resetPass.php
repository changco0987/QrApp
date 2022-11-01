<?php
    include_once '../db/connection.php';

    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';
    
    include_once '../db/tb_guardian.php';
    include_once '../model/guardianModel.php';

    session_start();
    if(isset($_POST['submitBtn']))
    {
        if($_POST['accType'] == 'visitor')
        {
            $data = new visitorModel();
            $data->setUsername($_SESSION['username']);

            $result = ReadAccountVisitor($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
                if($row['otp'] == $_POST['otpTb'])
                {
                    $data->setOtp('1');
                    UpdateAccountVisitor($conn,$data);//This will update otp to blank

                    $data->setPassword($_POST['passwordTb']);
        
                    UpdateAccountVisitor($conn,$data);//update the password
        
                    //This will unset the session for 'username' to avoid conflict in log in page
                    unset($_SESSION['username']);
                    session_unset();
                    echo '<script> localStorage.setItem("state",6); window.location = "../pages/visitorLogin.php";</script>';  
                }
                else
                {
                    //incorrect otp code
                    echo '<script> localStorage.setItem("otpMsg",2); window.location = "../pages/resetPass.php";</script>';  
                }
            }


        }
        else if($_POST['accType'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setUsername($_SESSION['username']);

            $result = ReadAccountGuardian($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
                if($row['otp'] == $_POST['otpTb'])
                {
                    $data->setOtp('1');
                    UpdateAccountGuardian($conn,$data);//This will update otp to blank
                    
                    $data->setPassword($_POST['passwordTb']);
        
                    UpdateAccountGuardian($conn,$data);//update the password
        
                    //This will unset the session for 'username' to avoid conflict in log in page
                    unset($_SESSION['username']);
                    session_unset();
                    echo '<script> localStorage.setItem("state",6); window.location = "../pages/guardianLogin.php";</script>';  
                }
                else
                {
                    //incorrect otp code
                    echo '<script> localStorage.setItem("otpMsg",2); window.location = "../pages/resetPass.php";</script>';  
                }
            }
        }
    }
    else
    {
        header("Location: wipedata.php");
    }

?>