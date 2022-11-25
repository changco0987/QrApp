<?php
    include_once '../db/connection.php';
    //CRUD
    include_once '../db/tb_visitor.php';
    include_once '../db/tb_guardian.php';
    include_once '../db/tb_student.php';
    include_once '../db/tb_faculty.php';
    include_once '../db/tb_dtr.php';

    //Model
    include_once '../model/visitorModel.php';
    include_once '../model/guardianModel.php';
    include_once '../model/studentModel.php';
    include_once '../model/facultyModel.php';
    include_once '../model/dtrModel.php';

    //sms API
    include_once '../API/apiData.php';
    include_once 'smsAPI.php';


    session_start();
    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i:s a');
    if(isset($_POST['tempInput']))
    {
        
        $responsedata = '';

        if($_SESSION['accType'] == 'visitor')
        {
            $responsedata = 'ok';
            $data = new visitorModel();
            $data->setUsername($_SESSION['username']);

            //To input in dtr
            $dtr = new dtrModel();
            $dtr->setDataId($_SESSION['id']);
            $dtr->setAccType('visitor');
            $dtr->setTemperature($_POST['tempInput']);
            $dtr->setTime_in($currentDateTime. '(Attempt)');
            CreateDtr($conn,$dtr);

        }
        else if($_SESSION['accType'] == 'guardian')
        {
            $responsedata = 'ok';
            $data = new guardianModel();
            $data->setUsername($_SESSION['username']);
            
            //To input in dtr
            $dtr = new dtrModel();
            $dtr->setDataId($_SESSION['id']);
            $dtr->setAccType('guardian');
            $dtr->setTemperature($_POST['tempInput']);
            $dtr->setTime_in($currentDateTime. '(Attempt)');
            CreateDtr($conn,$dtr);
        }
        else if($_SESSION['accType'] == 'student')
        {
            $responsedata = 'ok';
            $data = new studentModel();
            $data->setId($_SESSION['id']);
            
            //To input in dtr
            $dtr = new dtrModel();
            $dtr->setDataId($_SESSION['id']);
            $dtr->setAccType('student');
            $dtr->setTemperature($_POST['tempInput']);
            $dtr->setTime_in($currentDateTime. '(Attempt)');
            CreateDtr($conn,$dtr);
        }
        else if($_SESSION['accType'] == 'faculty')
        {
            $responsedata = 'ok';
            $data = new facultyModel();
            $data->setId($_SESSION['id']);
            
            //To input in dtr
            $dtr = new dtrModel();
            $dtr->setDataId($_SESSION['id']);
            $dtr->setAccType('faculty');
            $dtr->setTemperature($_POST['tempInput']);
            $dtr->setTime_in($currentDateTime. '(Attempt)');
            CreateDtr($conn,$dtr);
        }
        else
        {
            //This will occur if the qr is not created by the system
            echo 'error';
            exit;
        }
        echo $responsedata;
        exit;

    }



?>