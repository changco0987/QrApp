<?php
    include_once '../db/connection.php';
    include_once '../db/tb_guardian.php';//tb_guardian.php
    include_once '../model/guardianModel.php';//guardianModel.php
 
    include_once '../db/tb_visitor.php';//tb_visitor.php
    include_once '../model/visitorModel.php';//visitorModel.php

    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';

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
                
                //This will tell the system that the update is made in the admin page
                if(isset($_POST['adminReq']))
                {
                    echo '<script> localStorage.setItem("visitorMsg",4); window.location = "../admin/editVisitor.php";</script>';  
                    exit();
                }
                else
                {
                    echo '<script> localStorage.setItem("state",1); window.location = "../pages/accSettings.php";</script>';  

                }
            }
            else
            {
               if(checkSpaces($data->getUsername()) == false)
               {
                    $data->setFirstname($_POST['fnameTb']);
                    $data->setLastname($_POST['lnameTb']);
                    $data->setAddress($_POST['addressTb']);
                    $data->setContact_number($_POST['contactTb']);

                    if($_FILES['fileTb']['name'] != "")
                    {
                        $data->setImageName($_POST['usernameTb'].$_SESSION['accType']. "." .$fileExtension);
                        $uploadedFile = $_FILES['fileTb']['tmp_name'];
                        copy($uploadedFile,$imgPath.$data->getImageName());//This will move the uploaded file into file directory (web)
                    }
                    else
                    {
                        $data->setImageName($_POST['imageName']);
                    }

                    UpdateAccountVisitor($conn,$data);
                    

                    //This will tell the system that the update is made in the admin page
                    if(isset($_POST['adminReq']))
                    {
                        //this is the success message
                        echo '<script> localStorage.setItem("visitorMsg",1); window.location = "../admin/admin_visitor.php";</script>';  
                        exit();
                    }
                    else
                    {
                        $_SESSION['username'] = $data->getUsername();  
                        $_SESSION['password'] = $_POST['passwordTb'];  
                        echo '<script> localStorage.setItem("state",4); window.location = "../pages/userDashboard.php";</script>';  

                    }
               }
               else
               {
                    //Throws back to the signup page and show an error saying, spaces is illegal

                    //This will tell the system that the update is made in the admin page
                    if(isset($_POST['adminReq']))
                    {
                        echo '<script> localStorage.setItem("visitorMsg",4); window.location = "../admin/editVisitor.php";</script>';  
                    }
                    else
                    {
                        echo '<script> localStorage.setItem("state",2); window.location = "../pages/accSettings.php";</script>';  

                    }
               }
          

            }
        }
        else if($_POST['accType'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setId($_POST['idTb']);
            $data->setUsername($_POST['usernameTb']);

            if($_POST['passwordTb']!='')
            {
                $data->setPassword($_POST['passwordTb']);
            }
            
            //this will check the username if already used
            $read = ReadAccountGuardian($conn,$data);
            $row = mysqli_num_rows($read);

            if($row>0 && $_SESSION['username']!==$data->getUsername())
            {
                //Throws back to the signup page and show "This account is already existed"
                if(isset($_POST['adminReq']))
                {
                    echo '<script> localStorage.setItem("guardianMsg",4); window.location = "../admin/editGuardian.php";</script>';  
                }
                else
                {
                    echo '<script> localStorage.setItem("state",1); window.location = "../pages/accSettings.php";</script>';

                }
                
            }
            else
            {
                if(checkSpaces($data->getUsername()) == false)
                {
                    //this will check the studentid existance 
                    $studentId = str_replace(' ', '', $_POST['studentidTb']);//to remove all spaces in the inputted studentid
                    $student = new studentModel();
                    $result = ReadStudent($conn,$student);

                    while($studentDbRow = mysqli_fetch_assoc($result))
                    {
                        $rowStudentId = str_replace(' ', '', $studentDbRow['studentId']);//to remove all spaces in the retrieved studentid
                        
                        if(strtolower($studentId) == strtolower($rowStudentId))
                        {
                            //This will occur when the student id is existed in the database
                            $data->setFirstname($_POST['fnameTb']);
                            $data->setLastname($_POST['lnameTb']);
                            $data->setAddress($_POST['addressTb']);
                            $data->setContact_number($_POST['contactTb']);
                            $data->setStudentId($_POST['studentidTb']);
        
                            /* Removed the notif function
                            if(isset($_POST['notifCheckbox']))
                            {
                                $data->setNotification($_POST['notifCheckbox']);
                            }
                            else
                            {
                                $data->setNotification('false');
                            }
                            */
        
                            
                            if($_FILES['fileTb']['name']!="")
                            {
                                $data->setImageName($_POST['usernameTb'].$_SESSION['accType']. "." .$fileExtension);
                                $uploadedFile = $_FILES['fileTb']['tmp_name'];
                                copy($uploadedFile,$imgPath.$data->getImageName());//This will move the uploaded file into file directory (web)
                            }
                            else
                            {
                                $data->setImageName($_POST['imageName']);
                            }
                            
                            UpdateAccountGuardian($conn,$data);
        
                            //This will tell the system that the update is made in the admin page
                            if(isset($_POST['adminReq']))
                            {
                                unset($_SESSION['username']);
                                //This will occur if the changes was successfully
                                echo '<script> localStorage.setItem("guardianMsg",1); window.location = "../admin/admin_guardian.php";</script>';  
                                //echo $data->getPassword();
                                exit();
                            }
                            else
                            {
                                $_SESSION['username'] = $data->getUsername();
                                $_SESSION['password'] = $_POST['passwordTb'];
                                echo '<script> localStorage.setItem("state",4); window.location = "../pages/userDashboard.php";</script>';      
                            }
                        }
                    }
        
                    //This will tell the system that the update is made in the admin page
                    if(isset($_POST['adminReq']))
                    {
                        //This will return the studentid doesn't exist message
                        echo '<script> localStorage.setItem("guardianMsg",5); window.location = "../admin/editGuardian.php";</script>';  
                        exit;
                    }
                    else
                    {
                        //This will return the studentid doesn't exist message
                        echo '<script> localStorage.setItem("state",5); window.location = "../pages/accSettings.php";</script>';  
                        exit;
                    }

                    
                }
                else
                {
                    //Throws back to the signup page and show an error saying, spaces is illegal
                    //This will tell the system that the update is made in the admin page
                    if(isset($_POST['adminReq']))
                    {
                        echo '<script> localStorage.setItem("guardianMsg",4); window.location = "../admin/editGuardian.php";</script>';  
                    }
                    else
                    {
                        echo '<script> localStorage.setItem("state",2); window.location = "../pages/accSettings.php";</script>';    

                    }
                }
            }
    
        }
    }
    else
    {
        echo 'Error encountered in getting the element named="accType"';
    }


    //To check if there is spaces included in user input
    function checkSpaces($username)
    {
        if ($username == trim($username) && str_contains($username, ' ')) 
        {
            return true;
        }        



        return false;
    }






?>