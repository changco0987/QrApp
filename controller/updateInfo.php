<?php
    include_once '../db/connection.php';
    include_once '../db/tb_guardian.php';//tb_guardian.php
    include_once '../model/guardianModel.php';//guardianModel.php
 
    include_once '../db/tb_visitor.php';//tb_visitor.php
    include_once '../model/visitorModel.php';//visitorModel.php

    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i:s a');
    session_start();
    $imgPath = '../upload/';
    $tempFilename = '';
    $fileExtension = pathinfo($_FILES['fileTb']['name'],PATHINFO_EXTENSION);

    //This will be used by 2 page the visitor and guardian login
    if(isset($_POST['accType']))
    {
        if($_POST['accType'] == 'visitor')
        {
            $data = new visitorModel();
            $data->setId($_POST['idTb']);
            $data->setUsername($_POST['usernameTb']);
            $data->setPassword($_POST['passwordTb']);
            
            //this will check the username if already used
            $read = ReadAccountVisitor($conn,$data);
            $row = mysqli_num_rows($read);


            if($row>0 && $_SESSION['username']!==$data->getUsername())
            {
                //Throws back to the signup page and show "This account is already existed"
                echo '<script> localStorage.setItem("state",1); window.location = "../pages/accSettings.php";</script>';
            }
            else
            {
               if(checkSpaces($data->getUsername(),$data->getPassword()) == false)
               {
                    $data->setFirstname($_POST['fnameTb']);
                    $data->setLastname($_POST['lnameTb']);
                    $data->setAddress($_POST['addressTb']);
                    $data->setContact_number($_POST['contactTb']);
                    $data->setStatus($_POST['statusTb']);

                    if($_FILES['fileTb']['name']!="")
                    {
                        $data->setImageName($_POST['usernameTb'].$_SESSION['accType']. "." .$fileExtension);
                        $uploadedFile = $_FILES['fileTb']['tmp_name'];
                        copy($uploadedFile,$imgPath.$data->getImageName());//This will move the uploaded file into file directory (web)
                    }

                    UpdateAccountVisitor($conn,$data);
                    
                    $_SESSION['username'] = $data->getUsername();  
                    $_SESSION['password'] = $_POST['passwordTb'];  
                    echo '<script> localStorage.setItem("state",4); window.location = "../pages/userDashboard.php";</script>';  
               }
               else
               {
                    //Throws back to the signup page and show an error saying, spaces is illegal
                    echo '<script> localStorage.setItem("state",2); window.location = "../pages/accSettings.php";</script>';    
               }
          

            }
        }
        else if($_POST['accType'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setId($_POST['idTb']);
            $data->setUsername($_POST['usernameTb']);
            $data->setPassword($_POST['passwordTb']);
            
            //this will check the username if already used
            $read = ReadAccountGuardian($conn,$data);
            $row = mysqli_num_rows($read);

            if($row>0 && $_SESSION['username']!==$data->getUsername())
            {
                //Throws back to the signup page and show "This account is already existed"
                echo '<script> localStorage.setItem("state",1); window.location = "../pages/accSettings.php";</script>';
            }
            else
            {
                if(checkSpaces($data->getUsername(),$data->getPassword()) == false)
                {
                    $data->setFirstname($_POST['fnameTb']);
                    $data->setLastname($_POST['lnameTb']);
                    $data->setAddress($_POST['addressTb']);
                    $data->setContact_number($_POST['contactTb']);
                    $data->setStudentId($_POST['studentidTb']);
                    $data->setStatus($_POST['statusTb']);
                    if(isset($_POST['notifCheckbox']))
                    {
                        $data->setNotification($_POST['notifCheckbox']);
                    }
                    else
                    {
                        $data->setNotification('false');
                    }

                    
                    if($_FILES['fileTb']['name']!="")
                    {
                        $data->setImageName($_POST['usernameTb'].$_SESSION['accType']. "." .$fileExtension);
                        $uploadedFile = $_FILES['fileTb']['tmp_name'];
                        copy($uploadedFile,$imgPath.$data->getImageName());//This will move the uploaded file into file directory (web)
                    }
                    
                    UpdateAccountGuardian($conn,$data);
                    $_SESSION['username'] = $data->getUsername();
                    $_SESSION['password'] = $_POST['passwordTb'];
                    echo '<script> localStorage.setItem("state",4); window.location = "../pages/userDashboard.php";</script>';      
                }
                else
                {
                    //Throws back to the signup page and show an error saying, spaces is illegal
                    echo '<script> localStorage.setItem("state",2); window.location = "../pages/accSettings.php";</script>';    
                }
            }
    
        }
    }
    else
    {
        echo 'Error encountered in getting the element named="accType"';
    }


    //To check if there is spaces included in user input
    function checkSpaces($username,$password)
    {
        if ($username == trim($username) && str_contains($username, ' ')) 
        {
            return true;
        }        

        if ($password == trim($password) && str_contains($password, ' ')) 
        {
            return true;
        }  


        return false;
    }






?>