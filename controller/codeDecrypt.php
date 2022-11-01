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
    include_once '../API/apiData.php';
    include_once 'smsAPI.php';


    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i:s a');
    if(isset($_POST['codeInput']))
    {
        $decryptedCode = unserialize(base64_decode($_POST['codeInput']));
        $responseData = array();

        //Check on where the QR code belong
        if($decryptedCode['accType']=='visitor')
        {
            $data = new visitorModel();
            $data->setUsername($decryptedCode['username']);
            $result = ReadAccountVisitor($conn,$data);

            $row = mysqli_fetch_assoc($result);
            //This will check if the qr code is already expired
            if($currentDateTime < $row['qr_ExDate'] || $row['qr_ExDate']==null)
            {   

                if($row['gateStat'] == 'out'||$row['gateStat'] == null)
                {
                    $responseData = array("name"=>$row['firstname'].' '.$row['lastname'],
                                            "username"=>$row['username'],
                                            "imageName"=>$row['imageName'],
                                            "accType"=>'visitor',
                                            "contact"=>$row['contact_number'],
                                            "address"=>$row['address'],
                                            "time"=>$currentDateTime,
                                            "state"=>'in');
                    //Going in/enter
                    //log to DTR
                    $dtr = new dtrModel();
                    $dtr->setDataId($row['id']);
                    $dtr->setAccType('visitor');
                    $dtr->setTime_in($currentDateTime);

                    //This will update the userside dtr Log
                    $data->setGateStat('in');
                    $data->setDtrId(CreateDtr($conn,$dtr));
                    UpdateAccountVisitor($conn,$data);
                    
                }
                else
                {
                    $responseData = array("name"=>$row['firstname'].' '.$row['lastname'],
                                            "username"=>$row['username'],
                                            "imageName"=>$row['imageName'],
                                            "accType"=>'visitor',
                                            "contact"=>$row['contact_number'],
                                            "address"=>$row['address'],
                                            "time"=>$currentDateTime,
                                            "state"=>'out');
                    //Going out/Exit
                    //log to DTR
                    $dtr = new dtrModel();
                    $dtr->setId($row['dtrId']);
                    $dtr->setTime_out($currentDateTime);
                    UpdateDtr($conn,$dtr);

                    //This will update the userside dtr Log
                    $data->setGateStat('out');
                    $data->setDtrId($row['dtrId']);//To make the UpdateAccountGuardian 1st condition valid
                    UpdateAccountVisitor($conn,$data);
                }
                

            }
            else
            {
                echo 'expired';
                exit;
            }
            
        }
        else if($decryptedCode['accType']=='guardian')
        {
            $data = new guardianModel();
            $data->setUsername($decryptedCode['username']);
            $result = ReadAccountGuardian($conn,$data);

            $row = mysqli_fetch_assoc($result);
            //This will check if the qr code is already expired
            if($currentDateTime < $row['qr_ExDate']  || $row['qr_ExDate']==null)
            {   

                if($row['gateStat'] == 'out'||$row['gateStat'] == null)
                {
                    $responseData = array("name"=>$row['firstname'].' '.$row['lastname'],
                                                   "username"=>$row['username'],
                                                   "imageName"=>$row['imageName'],
                                                   "accType"=>'guardian',
                                                   "contact"=>$row['contact_number'],
                                                   "address"=>$row['address'],
                                                   "time"=>$currentDateTime,
                                                   "state"=>'in');
                    //Going in/enter
                    //log to DTR
                    $dtr = new dtrModel();
                    $dtr->setDataId($row['id']);
                    $dtr->setAccType('guardian');
                    $dtr->setTime_in($currentDateTime);

                    //This will update the userside dtr Log
                    $data->setGateStat('in');
                    $data->setDtrId(CreateDtr($conn,$dtr));
                    UpdateAccountGuardian($conn,$data);
                    
                }
                else
                {
                    $responseData = array("name"=>$row['firstname'].' '.$row['lastname'],
                                                   "username"=>$row['username'],
                                                   "imageName"=>$row['imageName'],
                                                   "accType"=>'guardian',
                                                   "contact"=>$row['contact_number'],
                                                   "address"=>$row['address'],
                                                   "time"=>$currentDateTime,
                                                   "state"=>'out');
                    //Going out/Exit
                    //log to DTR
                    $dtr = new dtrModel();
                    $dtr->setId($row['dtrId']);
                    $dtr->setTime_out($currentDateTime);
                    UpdateDtr($conn,$dtr);

                    //This will update the userside dtr Log
                    $data->setGateStat('out');
                    $data->setDtrId($row['dtrId']);//To make the UpdateAccountGuardian 1st condition valid
                    UpdateAccountGuardian($conn,$data);
                }
                

            }
            else
            {
                echo 'expired';
                exit;
            }
            
        }
        else if($decryptedCode['accType']=='student')
        {
            $data = new studentModel();
            $data->setId($decryptedCode['id']);
            $result = ReadStudent($conn,$data);

            $row = mysqli_fetch_assoc($result);
            //This will check if the qr code is already expired
            if($row['status']=='unlocked')
            {   

                if($row['gateStat'] == 'out'||$row['gateStat'] == null)
                {
                    $responseData = array("name"=>$row['firstname'].' '.$row['middlename'].' '.$row['lastname'],
                                                   "course"=>$row['course'].' '.$row['year'].' - '.$row['section'],
                                                   "imageName"=>$row['imageName'],
                                                   "accType"=>'student',
                                                   "contact"=>$row['contact_number'],
                                                   "address"=>$row['address'],
                                                   "guardianName"=>$row['guardianName'],
                                                   "time"=>$currentDateTime,
                                                   "state"=>'in');
                    //Going in/enter
                    //log to DTR
                    $dtr = new dtrModel();
                    $dtr->setDataId($row['id']);
                    $dtr->setAccType('student');
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
                                
                                $phone = $row['guardianNum'];

                                //this will check if the guardian number is at the format +63
                                if(str_contains($row['guardianNum'], '+63')==false)
                                {
                                    $phone =  substr_replace($row['guardianNum'],'+63',0,1);
                                }
        
                                sendMessage($ch,$key,$device,$sim,$priority,$phone,$message);//This will send the sms notification to the student guardian
                            }
                        }
                    }
                    UpdateStudent($conn,$data);
                    
                }
                else
                {
                    $responseData = array("name"=>$row['firstname'].' '.$row['middlename'].' '.$row['lastname'],
                                                   "course"=>$row['course'].' '.$row['year'].' - '.$row['section'],
                                                   "imageName"=>$row['imageName'],
                                                   "accType"=>'student',
                                                   "contact"=>$row['contact_number'],
                                                   "address"=>$row['address'],
                                                   "guardianName"=>$row['guardianName'],
                                                   "time"=>$currentDateTime,
                                                   "state"=>'out');
                    //Going out/Exit
                    //log to DTR
                    $dtr = new dtrModel();
                    $dtr->setId($row['dtrId']);
                    $dtr->setTime_out($currentDateTime);
                    UpdateDtr($conn,$dtr);

                    //This will update the userside dtr Log
                    $data->setGateStat('out');
                    $data->setDtrId($row['dtrId']);//To make the UpdateAccountGuardian 1st condition valid

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
                                $message = "Dear parent, your child has left the campus at ".date("M d, Y h:i a", strtotime($dtr->getTime_out()));
                                
                                $phone = $row['guardianNum'];
                                
                                //this will check if the guardian number is at the format +63
                                if(str_contains($row['guardianNum'], '+63')==false)
                                {
                                    $phone =  substr_replace($row['guardianNum'],'+63',0,1);
                                }
        
                                sendMessage($ch,$key,$device,$sim,$priority,$phone,$message);//This will send the sms notification to the student guardian
                            }
                        }
                    }

                    UpdateStudent($conn,$data);
                }
                

            }
            else
            {
                echo 'Locked';
                exit;
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