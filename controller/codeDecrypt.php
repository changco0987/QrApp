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
            if($currentDateTime < $row['qr_ExDate']  || $row['qr_ExDate']==null)
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

        }
        else
        {
            //This will occur if the qr is not created by the system
            echo 'error';
            exit;
        }
        echo json_encode($responseData);
    }
?>