<?php
    include_once '../db/connection.php';

    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';

    include_once '../db/tb_guardian.php';
    include_once '../model/guardianModel.php';

    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';
    
    $imgPath = '../upload/';
    $tempFilename = '';
    $fileExtension = pathinfo($_FILES['fileTb']['name'],PATHINFO_EXTENSION);

    $log = new logsModel();
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
                echo '<script> localStorage.setItem("visitorMsg",2); window.location = "../admin/admin_visitor.php";</script>';   
                //header("location: ../admin/admin_visitor.php?fail");
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

                    if($_FILES['fileTb']['name']!="")
                    {
                        $data->setImageName($_POST['usernameTb'].$_POST['accType']. "." .$fileExtension);
                        $uploadedFile = $_FILES['fileTb']['tmp_name'];
                        copy($uploadedFile,$imgPath.$data->getImageName());//This will move the uploaded file into file directory (web)
                    }
                    
                    //create log
                    $log->setActivity('added account Type: '.$_POST['accType'].', username: '.$_POST['usernameTb']);
                    $log->setIpAdd();
                    $log->setAccType($_SESSION['accType']);
                    $log->setCreator($_SESSION['username']);

                    CreateLog($conn,$log);

                    CreateAccountVisitor($conn,$data); 
                    echo '<script> localStorage.setItem("visitorMsg",1); window.location = "../admin/admin_visitor.php";</script>';   
                    exit();
                    //header("location: ../admin/admin_visitor.php?success");
               }
               else
               {
                    //Throws back to the signup page and show an error saying, spaces is illegal
                    echo '<script> localStorage.setItem("visitorMsg",3); window.location = "../admin/admin_visitor.php";</script>';    
                   //header("location: ../admin/admin_visitor.php?fail");
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
                echo '<script> localStorage.setItem("guardianMsg",2); window.location = "../admin/admin_guardian.php";</script>';   
                //header("location: ../admin/admin_visitor.php?fail");
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

                    if($_FILES['fileTb']['name']!="")
                    {
                        $data->setImageName($_POST['usernameTb'].$_POST['accType']. "." .$fileExtension);
                        $uploadedFile = $_FILES['fileTb']['tmp_name'];
                        copy($uploadedFile,$imgPath.$data->getImageName());//This will move the uploaded file into file directory (web)
                    }

                    
                    //create log
                    $log->setActivity('added account Type: '.$_POST['accType'].', username: '.$_POST['usernameTb']);
                    $log->setIpAdd();
                    $log->setAccType($_SESSION['accType']);
                    $log->setCreator($_SESSION['username']);

                    CreateLog($conn,$log);
                    
                    CreateAccountGuardian($conn,$data); 
                    echo '<script> localStorage.setItem("guardianMsg",1); window.location = "../admin/admin_guardian.php";</script>';   

                    //header("location: ../admin/admin_guardian.php?success");
                    exit;
               }
               else
               {
                    //Throws back to the signup page and show an error saying, spaces is illegal
                    echo '<script> localStorage.setItem("guardianMsg",3); window.location = "../admin/admin_guardian.php";</script>';    
                   //header("location: ../admin/admin_visitor.php?fail");
               }
          

            }

        }
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