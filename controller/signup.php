<?php
    include_once '../db/connection.php';
    include_once '../db/tb_guardian.php';//tb_guardian.php
    include_once '../model/guardianModel.php';//guardianModel.php

    
    include_once '../db/tb_visitor.php';//tb_visitor.php
    include_once '../model/visitorModel.php';//visitorModel.php

    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';



    //This will be used by 2 page the visitor and guardian signup
    if(isset($_POST['accType']))
    {
        if($_POST['accType'] == 'visitor')
        {
            $data = new visitorModel();
            $data->setUsername($_POST['usernameTb']);
            $data->setPassword($_POST['passwordTb']);
            //this will check the username if already used
            $read = ReadAccountVisitor($conn,$data);
            $row = mysqli_num_rows($read);

            if($row>0)
            {
                //Throws back to the signup page and show "This account is already existed"
                echo '<script> localStorage.setItem("state",1); window.location = "../pages/visitorSignup.php";</script>';
            }
            else
            {
                if(checkSpaces($data->getUsername(),$data->getPassword()) == false)
                {
                    $data->setFirstname($_POST['fnameTb']);
                    $data->setLastname($_POST['lnameTb']);
                    $data->setAddress($_POST['addressTb']);
                    $data->setContact_number($_POST['contactTb']);
                    $data->setStatus('unlock');

                    CreateAccountVisitor($conn,$data);
                    echo '<script> localStorage.setItem("state",4); window.location = "../pages/visitorLogin.php";</script>';   
                    exit;
                }
                else
                {
                    //Throws back to the signup page and show an error saying, spaces is illegal
                    echo '<script> localStorage.setItem("state",2); window.location = "../pages/visitorSignup.php";</script>';    
                }
            }
        }
        else if($_POST['accType'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setUsername($_POST['usernameTb']);
            $data->setPassword($_POST['passwordTb']);

            //this will check the username if already used
            $read = ReadAccountGuardian($conn,$data);
            $row = mysqli_num_rows($read);

            if($row>0)
            {
                //Throws back to the signup page and show "This account is already existed"
                echo '<script> localStorage.setItem("state",1); window.location = "../pages/guardianSignup.php";</script>';
            }
            else
            {
                if(checkSpaces($data->getUsername(),$data->getPassword()) == false)
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
                            $data->setStatus('unlock');

                            
                            if(isset($_POST['notifCheckbox']))
                            {
                                $data->setNotification($_POST['notifCheckbox']);
                            }
                            else
                            {
                                $data->setNotification('false');
                            }
                            
        
                            CreateAccountGuardian($conn,$data);
                            echo '<script> localStorage.setItem("state",4); window.location = "../pages/guardianLogin.php";</script>';  
                            exit;
                        }
                    }

                    //This will return the studentid doesn't exist message
                    echo '<script> localStorage.setItem("state",4); window.location = "../pages/guardianSignup.php";</script>';  
                    exit;
                    
                }
                else
                {
                    //Throws back to the signup page and show an error saying, spaces is illegal
                    echo '<script> localStorage.setItem("state",2); window.location = "../pages/guardianSignup.php";</script>';    
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