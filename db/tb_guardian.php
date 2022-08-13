<?php
    include_once 'connection.php';
    include_once '../model/guardianModel.php';

    $data = new guardianModel();
    function CreateAccountGuardian($conn,$data)
    {
        mysqli_query($conn,"INSERT INTO guardiantb(username,password,firstname,lastname,email,studentId,qr_ExDate,status) values('".$data->getUsername()."','".$data->getPassword().
        "','".$data->getFirstname()."','".$data->getLastname()."','".$data->getEmail()."','".$data->getStudentId()."','".$data->getQr_ExDate()."','".$data->getStatus()."')");
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
        mysqli_query($conn,"UPDATE guardiantb set username ='".$data->getUsername()."', password ='".$data->getPassword()."', firstname ='". $data->getFirstname()
        ."', lastname ='".$data->getLastname(). "', email ='". $data->getEmail(). "', studentId = '". $data->getStudentId(). "', qr_ExDate ='". $data->getQr_ExDate()."', status = '".
        $data->getStatus()."' where id = ". $data->getId());
    }

    function DeleteAccountGuardian($conn,$data)
    {
        mysqli_query($conn,"DELETE from guardiantb where id = ".$data->getId());
    }

?>