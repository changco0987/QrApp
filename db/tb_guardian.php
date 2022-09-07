<?php
    include_once 'connection.php';
    include_once '../model/guardianModel.php';

    $data = new guardianModel();
    function CreateAccountGuardian($conn,$data)
    {
        $address = mysqli_real_escape_string($conn,$data->getAddress());
        mysqli_query($conn,"INSERT INTO guardiantb(username,password,firstname,lastname,address,contact_number,studentId,imageName,status,notification) values('".$data->getUsername()."','".$data->getPassword().
        "','".$data->getFirstname()."','".$data->getLastname()."','".$address."','".$data->getContact_number()."','".$data->getStudentId()."','".$data->getStatus().
        "','".$data->getImageName()."',".$data->getNotification().")");
    }

    function ReadAccountGuardian($conn,$data)
    {
        if($data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM guardiantb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM guardiantb WHERE username = '".$data->getUsername()."'");
        }

        return $dbData;
    }

    function UpdateAccountGuardian($conn,$data)
    {
        if($data->getQr_ExDate()==null)
        {

            $address = mysqli_real_escape_string($conn,$data->getAddress());
            mysqli_query($conn,"UPDATE guardiantb set username ='".$data->getUsername()."', password ='".$data->getPassword()."', firstname ='". $data->getFirstname()
            ."', lastname ='".$data->getLastname(). "', address ='". $address. "',contact_number ='". $data->getContact_number(). "', studentId = '". $data->getStudentId(). 
            "', imageName = '".$data->getImageName()."', status = '".$data->getStatus()."', notification = ".$data->getNotification()." where id = ". $data->getId());
        


        }
        else
        {
            mysqli_query($conn,"UPDATE guardiantb set qr_ExDate ='".$data->getQr_ExDate()."' where username = '".$data->getUsername()."'");
        }

    }

    function DeleteAccountGuardian($conn,$data)
    {
        mysqli_query($conn,"DELETE from guardiantb where id = ".$data->getId());
    }

?>