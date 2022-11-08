<?php
    include_once '../db/connection.php';
    //CRUD
    include_once '../db/tb_visitor.php';
    include_once '../db/tb_guardian.php';
    include_once '../db/tb_student.php';
    include_once '../db/tb_dtr.php';

    //Model
    include_once '../model/visitorModel.php';
    include_once '../model/guardianModel.php';
    include_once '../model/studentModel.php';
    include_once '../model/dtrModel.php';

    //sms API
    //include_once '../API/apiData.php';
    //include_once 'smsAPI.php';


    session_start();
    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i:s a');
    if(isset($_POST['tempInput']))
    {
        $responseData = '';

        if($_SESSION['accType'] == 'visitor')
        {

        }
        else if($_SESSION['accType'] == 'guardian')
        {

        }
        else if($_SESSION['accType'] == 'student')
        {
            $responsedata = $_POST['tempInput'];
            $data = new studentModel();
            $data->setId($_SESSION['id']);

            if($_SESSION['gateStat'] == 'out'||$_SESSION['gateStat'] == null)
            {

                //Going in/enter
                //log to DTR
                $dtr = new dtrModel();
                $dtr->setDataId($_SESSION['id']);
                $dtr->setAccType('student');
                $dtr->setTemperature($_POST['tempInput']);
                $dtr->setTime_in($currentDateTime);

                //This will update the userside dtr Log
                $data->setGateStat('in');
                $data->setDtrId(CreateDtr($conn,$dtr));
                UpdateStudent($conn,$data);
            }
            else
            {

                //Going out/Exit
                //log to DTR
                $dtr = new dtrModel();
                $dtr->setId($_SESSION['dtrId']);
                $dtr->setTime_out($currentDateTime);
                UpdateDtr($conn,$dtr);

                //This will update the userside dtr Log
                $data->setGateStat('out');
                $data->setDtrId($_SESSION['dtrId']);//To make the UpdateStudent 1st condition valid
                UpdateStudent($conn,$data);
            }

        }
        else
        {
            //This will occur if the qr is not created by the system
            echo 'error';
            exit;
        }
        
        echo json_encode($responseData);
        exit;
    }
?>