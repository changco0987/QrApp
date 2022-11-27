<?php
    include_once '../db/connection.php';
    include_once '../db/tb_admin.php';
    include_once '../model/adminModel.php';
    
    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';    

    date_default_timezone_set('Asia/Manila'); 

    $currentDateTime = date('Y-m-d h:i a');

    if(isset($_POST['adminNameTb']))
    {
        $data = new adminModel();
        $data->setUsername($_POST['adminNameTb']);
        $data->setPassword($_POST['adminPasswordTb']);
        $result = ReadAdmin($conn,$data);//This is will be the container of the admin data
        
        $log = new logsModel();
        while($row = mysqli_fetch_assoc($result))
        {

            if($row['username']==$data->getUsername() && $row['password']==$data->getPassword())
            {
   
                if($row['sessionExpiry']==null || $row['sessionExpiry'] <= $currentDateTime)
                {                   
                    $date = new DateTime($currentDateTime);
                    $date->add(new DateInterval('PT24H'));
                    $expiryDate = $date->format('Y-m-d h:i:s a');
                    $data->setSessionExpiry($expiryDate);
                }

                if($row['loginCount'] > $row['activeLogin'])
                {
                    $active = $row['activeLogin'];
                    $active++;
                    $data->setUsername(null);//this will set to null intentionally for updating activeLogin
                    $data->setActiveLogin($active);
                    UpdateAdmin($conn,$data);

                    //create log
                    $log->setActivity('log-in');
                    $log->setIpAdd();
                    $log->setAccType('Administrator');
                    $log->setCreator($row['username']);
                
                    CreateLog($conn,$log);

                    session_start();
                    $_SESSION['adminNameTb'] = $row['username'];
                    header("Location: ../admin/dashboard.php");
                    exit;
                }

                //Throws back to the login page and show "Admin active login reached to its maximum count"
                echo '<script> localStorage.setItem("state",4); window.location = "../admin.php";</script>';
                exit;

            }
            else
            {
                //create log
                $log->setActivity('log-in attempt: incorrect password');
                $log->setIpAdd();
                $log->setAccType('Administrator');
                $log->setCreator($row['username']);
            
                CreateLog($conn,$log);
                //Throws back to the login page and show "Username or Password is incorrect"
                echo '<script> localStorage.setItem("state",1); window.location = "../admin.php";</script>';
                exit;
            }

        }

        
        //create log
        $log->setActivity('log-in attempt: incorrect username and password');
        $log->setIpAdd();
        $log->setAccType('Administrator');
        $log->setCreator('Unknown');
    
        CreateLog($conn,$log);
        //Throws back to the login page and show "This account is not existed"
       echo '<script> localStorage.setItem("state",2); window.location = "../admin.php";</script>';
       exit;



    }
    else
    {
        header("Location: ../admin.php");
    }

?>