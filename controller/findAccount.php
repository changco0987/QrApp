<?php
    include_once '../db/connection.php';
    
    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';
    
    include_once '../db/tb_guardian.php';
    include_once '../model/guardianModel.php';

    //sms API
    include_once '../API/apiData.php';
    include_once 'smsAPI.php';


    if(isset($_POST['submitBtn']))
    {
        //This will identify the account type
        if($_POST['accType'] == 'visitor')
        {
            $data = new visitorModel();
            $data->setUsername($_post['usernameTb']);
            $result = ReadAccountVisitor($conn,$data);

            while($row = mysqli_fetch_assoc($result))
            {
                //The message sent to mobile number
                $otp = rand(11111111, 99999999);
                $message = "The OTP code for your QREM system reset password request is: ".$otp;
 
                $phone = $row['contact_number'];
                                
                //this will check if the guardian number is at the format +63
                if(str_contains($row['contact_number'], '+63')==false)
                {
                    $phone =  substr_replace($row['contact_number'],'+63',0,1);
                }

                sendMessage($ch,$key,$device,$sim,$priority,$phone,$message);//This will send the sms notification to the student guardian
            }

        }
        else if($_POST['accType'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setUsername($_post['usernameTb']);
            $result = ReadAccountGuardian($conn,$data);
        }
    }
    else
    {
        header("Location: ../index.php");
    }


?>