<?php
    include_once '../db/connection.php';
    //CRUD
    include_once '../db/tb_visitor.php';
    include_once '../db/tb_guardian.php';
    include_once '../db/tb_student.php';

    //Model
    include_once '../model/visitorModel.php';
    include_once '../model/guardianModel.php';
    include_once '../model/studentModel.php';


    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i:s a');
    if(isset($_POST['codeInput']))
    {
        $decryptedCode = unserialize(base64_decode($_POST['codeInput']));
        $responseData = array();

        //Check on where the QR code belong
        if($decryptedCode['accType']=='visitor')
        {

        }
        else if($decryptedCode['accType']=='guardian')
        {
            $data = new guardianModel();
            $data->setUsername($decryptedCode['username']);
            $result = ReadAccountGuardian($conn,$data);

            $row = mysqli_fetch_assoc($result);

            //This will check if the qr code is already expired
            if($currentDateTime > $row['qr_ExDate'] || $row['qr_ExDate']==null)
            {
                $responseData = array("name"=>$row['firstname'].' '.$row['lastname'],
                                               "username"=>$row['username'],
                                               "imageName"=>$row['imageName'],
                                               "accType"=>'guardian',
                                               "contact"=>$row['contact_number'],
                                               "address"=>$row['address']);
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