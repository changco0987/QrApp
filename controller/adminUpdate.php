<?php
    include_once '../db/connection.php';
    include_once '../db/tb_admin.php';
    include_once '../model/adminModel.php';

    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';

    session_start();

    $log = new logsModel();
    if(isset($_SESSION['adminNameTb']))
    {
        $data = new adminModel();
        $data->setId($_POST['idTb']);
        $data->setPassword($_POST['oldPassTb']);
        $result = ReadAdmin($conn,$data);//This is will be the container of the admin data
        
        while($row = mysqli_fetch_assoc($result))
        {
            //This will authenticate if the old password is correct if its equal to password that queried
            if($row['password'] == $data->getPassword())
            {
                $data->setId($row['id']);
                $data->setUsername($row['username']);
                $data->setPassword($_POST['newPassTb']);
                UpdateAdmin($conn,$data);

                $_SESSION['adminNameTb'] = $row['username'];
                
                
                //create log
                $log->setActivity('changed admin password');
                $log->setIpAdd();
                $log->setAccType('Administrator');
                $log->setCreator($_SESSION['adminNameTb']);
            
                CreateLog($conn,$log);
                echo '<script> localStorage.setItem("signal",1); window.location = "../admin/dashboard.php";</script>';
                exit;
            }
            else
            {
                //Throws back to the login page and show "Username or Password is incorrect"
               echo '<script> localStorage.setItem("signal",2); window.location = "../admin/dashboard.php";</script>';
               exit;
            }

        }

        //Throws back to the login page and show "This account is not existed"
       echo '<script> localStorage.setItem("signal",3); window.location = "../admin/dashboard.php";</script>';
       exit;



    }
    else
    {
        header("Location: ../admin.php");
    }

?>