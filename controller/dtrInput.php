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
            $responsedata = $_POST['tempInput'];
            $data = new visitorModel();
            $data->setUsername($_SESSION['username']);

            if($_SESSION['gateStat'] == 'out' || $_SESSION['gateStat'] == null)
            {

                //Going in/enter
                //log to DTR
                $dtr = new dtrModel();
                $dtr->setDataId($_SESSION['id']);
                $dtr->setAccType('visitor');
                $dtr->setTemperature($_POST['tempInput']);
                $dtr->setTime_in($currentDateTime);

                //This will update the userside dtr Log
                $data->setGateStat('in');
                $data->setDtrId(CreateDtr($conn,$dtr));
                UpdateAccountVisitor($conn,$data);
            }
            else
            {
                //this is not used to codeDecrypt 'out' is being used

                //Going out/Exit
                //log to DTR
                $dtr = new dtrModel();
                $data->setUsername($_SESSION['username']);
                $dtr->setTime_out($currentDateTime);
                UpdateDtr($conn,$dtr);

                //This will update the userside dtr Log
                $data->setGateStat('out');
                $data->setDtrId($_SESSION['dtrId']);//To make the UpdateStudent 1st condition valid
                UpdateAccountVisitor($conn,$data);
            }
        }
        else if($_SESSION['accType'] == 'guardian')
        {
            $responsedata = $_POST['tempInput'];
            $data = new guardianModel();
            $data->setUsername($_SESSION['username']);

            if($_SESSION['gateStat'] == 'out' || $_SESSION['gateStat'] == null)
            {

                //Going in/enter
                //log to DTR
                $dtr = new dtrModel();
                $dtr->setDataId($_SESSION['id']);
                $dtr->setAccType('guardian');
                $dtr->setTemperature($_POST['tempInput']);
                $dtr->setTime_in($currentDateTime);

                //This will update the userside dtr Log
                $data->setGateStat('in');
                $data->setDtrId(CreateDtr($conn,$dtr));
                UpdateAccountGuardian($conn,$data);
            }
            else
            {
                //this is not used to codeDecrypt 'out' is being used

                //Going out/Exit
                //log to DTR
                $dtr = new dtrModel();
                $data->setUsername($_SESSION['username']);
                $dtr->setTime_out($currentDateTime);
                UpdateDtr($conn,$dtr);

                //This will update the userside dtr Log
                $data->setGateStat('out');
                $data->setDtrId($_SESSION['dtrId']);//To make the UpdateStudent 1st condition valid
                UpdateAccountGuardian($conn,$data);
            }

        }
        else if($_SESSION['accType'] == 'student')
        {
            $responsedata = $_POST['tempInput'];
            $data = new studentModel();
            $data->setId($_SESSION['id']);

            if($_SESSION['gateStat'] == 'out' || $_SESSION['gateStat'] == null)
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
                
                //This will get the guardian details to check if the guardian has turned the notif on or off
                $guardian = new guardianModel();
                $result = ReadAccountGuardian($conn,$guardian);
                
                while($guardianRow = mysqli_fetch_assoc($result))
                {
                    $guardianName = $guardianRow['firstname'].' '.$guardianRow['lastname'];
                    //this will find the guardian name
                    if(strtolower($guardianName) == strtolower($row['guardianName']))
                    {
                        //This will check if the guardian notification is on or off to send an sms
                        if($guardianRow['notification'] == true)
                        {
                            //The message sent to guardian
                            $message = "Dear parent, your child entered to campus at ".date("M d, Y h:i a", strtotime($dtr->getTime_in()));
                            
                            $phone = $guardianRow['guardianNum'];

                            //this will check if the guardian number is at the format +63
                            if(str_contains($guardianRow['guardianNum'], '+63')==false)
                            {
                                $phone =  substr_replace($guardianRow['guardianNum'],'+63',0,1);//this will replace the 0 in the start of the number and replace with +63
                            }
    
                            //Removed temporarily to avoid while on QR scanning testing
                            sendMessage($ch,$key,$device,$sim,$priority,$phone,$message);//This will send the sms notification to the student guardian
                        }
                    }
                }

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
        else if($_SESSION['accType'] == 'faculty')
        {
            $responsedata = $_POST['tempInput'];
            $data = new facultyModel();
            $data->setId($_SESSION['id']);

            if($_SESSION['gateStat'] == 'out' || $_SESSION['gateStat'] == null)
            {

                //Going in/enter
                //log to DTR
                $dtr = new dtrModel();
                $dtr->setDataId($_SESSION['id']);
                $dtr->setAccType('faculty');
                $dtr->setTemperature($_POST['tempInput']);
                $dtr->setTime_in($currentDateTime);

                //This will update the userside dtr Log
                $data->setGateStat('in');
                $data->setDtrId(CreateDtr($conn,$dtr));
                UpdateFaculty($conn,$data);
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
                UpdateFaculty($conn,$data);
            }

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