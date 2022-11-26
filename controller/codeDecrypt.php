<?php
    include_once '../db/connection.php';
    //CRUD
    include_once '../db/tb_visitor.php';
    include_once '../db/tb_guardian.php';
    include_once '../db/tb_student.php';
    include_once '../db/tb_faculty.php';
    include_once '../db/tb_dtr.php';
    include_once '../db/tb_qrsettings.php';

    //Model
    include_once '../model/visitorModel.php';
    include_once '../model/guardianModel.php';
    include_once '../model/studentModel.php';
    include_once '../model/facultyModel.php';
    include_once '../model/dtrModel.php';
    include_once '../model/qrsettingsModel.php';

    //sms API
    include_once '../API/apiData.php';
    include_once 'smsAPI.php';

    session_start();

    //This will get the qr retriction status
    $qr = new qrsettingsModel();
    $qrResult = ReadQrSetting($conn,$qr);
    $qrData = mysqli_fetch_assoc($qrResult);

    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i:s a');
    if(isset($_POST['codeInput']))
    {
        if(base64_encode(base64_decode($_POST['codeInput'], true)) === $_POST['codeInput'])
        {
            $decryptedCode = unserialize(base64_decode($_POST['codeInput']));
            $responseData = array();
        }
        else
        {
            echo 'error';
            exit;
        }


        //Check on where the QR code belong
        if($decryptedCode['accType']=='visitor')
        {
            $data = new visitorModel();
            $data->setUsername($decryptedCode['username']);
            $result = ReadAccountVisitor($conn,$data);

            $row = mysqli_fetch_assoc($result);
            //This will check if the qr code is already expired
            if($row['status']=='unlock' && $qrData['qrStatus']=='unlock')
            {
                //to format the datetime
                $formattedDate1 = strtotime($row['qr_ExDate']);
                $formattedDate2 = strtotime($currentDateTime);
                //This will check if the qr code is already expired
                if($row['qr_ExDate']!==null && $formattedDate1 > $formattedDate2)
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
                                                
                        $_SESSION['gateStat'] = $row['gateStat'];
                        $_SESSION['accType'] = 'visitor';
                        $_SESSION['username'] = $row['username'];
    
                        /*
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
                        */
                        
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
                                                
                        $_SESSION['gateStat'] = $row['gateStat'];
                        $_SESSION['accType'] = 'visitor';
                        $_SESSION['username'] = $row['username'];
    
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
            else
            {
                echo json_encode('Locked');
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
            if($row['status']=='unlock' && $qrData['qrStatus']=='unlock')
            {  
                //to format the datetime
                $formattedDate1 = strtotime($row['qr_ExDate']);
                $formattedDate2 = strtotime($currentDateTime);
                //This will check if the qr code is already expired
                if($row['qr_ExDate']!==null && $formattedDate1 > $formattedDate2)
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
                                                       
                        $_SESSION['gateStat'] = $row['gateStat'];
                        $_SESSION['accType'] = 'guardian';
                        $_SESSION['username'] = $row['username'];
    
                        /*
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
                        */
                        
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
                                                       
                        $_SESSION['gateStat'] = $row['gateStat'];
                        $_SESSION['accType'] = 'guardian';
                        $_SESSION['username'] = $row['username'];
    
                        
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
            else
            {
                echo json_encode('Locked');
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
            if($row['status']=='unlocked' && $qrData['qrStatus']=='unlock')
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

                    $_SESSION['gateStat'] = $row['gateStat'];
                    $_SESSION['accType'] = 'student';
                    $_SESSION['id'] = $row['id'];
                
                    /*
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
                                    $phone =  substr_replace($row['guardianNum'],'+63',0,1);//this will replace the 0 in the start of the number and replace with +63
                                }
        
                                //Removed temporarily to avoid while on QR scanning testing
                                //sendMessage($ch,$key,$device,$sim,$priority,$phone,$message);//This will send the sms notification to the student guardian
                            }
                        }
                    }
                    UpdateStudent($conn,$data);
                    */
                    
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
                                                   
                    $_SESSION['dtrId'] = $row['dtrId'];
                    $_SESSION['gateStat'] = $row['gateStat'];
                    $_SESSION['accType'] = 'student';
                    $_SESSION['id'] = $row['id'];
                    
                    //Going out/Exit
                    //log to DTR
                    $dtr = new dtrModel();
                    $dtr->setId($row['dtrId']);
                    $dtr->setTime_out($currentDateTime);
                    UpdateDtr($conn,$dtr);

                    //This will update the userside dtr Log
                    $data->setGateStat('out');
                    $data->setDtrId($row['dtrId']);//To make the UpdateStudent 1st condition valid

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
                                
                                $phone = $guardianRow['contact_number'];
                                
                                //this will check if the guardian number is at the format +63
                                if(str_contains($guardianRow['contact_number'], '+63')==false)
                                {
                                    $phone =  substr_replace($guardianRow['contact_number'],'+63',0,1);//this will replace the 0 in the start of the number and replace with +63
                                }
        
                                //Removed temporarily to avoid while on QR scanning testing
                                sendMessage($ch,$key,$device,$sim,$priority,$phone,$message);//This will send the sms notification to the student guardian
                            }
                        }
                    }

                    UpdateStudent($conn,$data);
                    
                }
                

            }
            else
            {
                echo json_encode('Locked');
                exit;
            }
        }
        else if($decryptedCode['accType']=='faculty')
        {
            $data = new facultyModel();
            $data->setId($decryptedCode['id']);
            $result = ReadFaculty($conn,$data);

            $row = mysqli_fetch_assoc($result);
            //This will check if the qr code is already expired
            if($row['status']=='unlock' && $qrData['qrStatus']=='unlock')
            {   

                if($row['gateStat'] == 'out'||$row['gateStat'] == null)
                {
                    $responseData = array("name"=>$row['firstname'].' '.$row['lastname'],
                                                   "imageName"=>$row['imageName'],
                                                   "accType"=>'faculty',
                                                   "contact"=>$row['contact_number'],
                                                   "dept"=>$row['department'],
                                                   "time"=>$currentDateTime,
                                                   "state"=>'in');

                    $_SESSION['gateStat'] = $row['gateStat'];
                    $_SESSION['accType'] = 'faculty';
                    $_SESSION['id'] = $row['id'];

                    /*
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
                                    $phone =  substr_replace($row['guardianNum'],'+63',0,1);//this will replace the 0 in the start of the number and replace with +63
                                }
        
                                //Removed temporarily to avoid while on QR scanning testing
                                //sendMessage($ch,$key,$device,$sim,$priority,$phone,$message);//This will send the sms notification to the student guardian
                            }
                        }
                    }
                    UpdateStudent($conn,$data);
                    */
                    
                }
                else
                {
                    $responseData = array("name"=>$row['firstname'].' '.$row['lastname'],
                                                   "imageName"=>$row['imageName'],
                                                   "accType"=>'faculty',
                                                   "contact"=>$row['contact_number'],
                                                   "dept"=>$row['department'],
                                                   "time"=>$currentDateTime,
                                                   "state"=>'out');
                                                   
                    $_SESSION['dtrId'] = $row['dtrId'];
                    $_SESSION['gateStat'] = $row['gateStat'];
                    $_SESSION['accType'] = 'faculty';
                    $_SESSION['id'] = $row['id'];
                     
                    //Going out/Exit
                    //log to DTR
                    $dtr = new dtrModel();
                    $dtr->setId($row['dtrId']);
                    $dtr->setTime_out($currentDateTime);
                    UpdateDtr($conn,$dtr);

                    //This will update the userside dtr Log
                    $data->setGateStat('out');
                    $data->setDtrId($row['dtrId']);//To make the UpdateAccountGuardian 1st condition valid
                    UpdateFaculty($conn,$data);
                
                }
                

            }
            else
            {
                echo json_encode('Locked');
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