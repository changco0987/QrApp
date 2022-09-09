<?php
    include_once '../db/connection.php';
    include_once '../db/tb_admin.php';
    include_once '../model/adminModel.php';

    if(isset($_POST['adminNameTb']))
    {
        $data = new adminModel();
        $data->setUsername($_POST['adminNameTb']);
        $data->setPassword($_POST['adminPasswordTb']);
        $result = ReadAdmin($conn,$data);//This is will be the container of the admin data
        
        while($row = mysqli_fetch_assoc($result))
        {

            if($row['username']==$data->getUsername() && $row['password']==$data->getPassword())
            {
                header("Location: ../admin/dashboard.php");
            }
            else
            {
                //Throws back to the login page and show "Username or Password is incorrect"
               echo '<script> localStorage.setItem("state",1); window.location = "../admin.php";</script>';
               exit;
            }

        }

        //Throws back to the login page and show "This account is not existed"
       echo '<script> localStorage.setItem("state",2); window.location = "../admin.php";</script>';
       exit;



    }
    else
    {
        header("Location: ../admin.php");
    }

?>