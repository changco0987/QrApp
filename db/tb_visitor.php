<?php
    include_once 'connection.php';
    include_once '../model/visitorModel.php';


    $data = new visitorModel();
    function CreateAccountVisitor($conn,$data)
    {
        mysqli_query($conn,"INSERT INTO visitorTb(username,password,firstname,lastname,email,qr_ExDate,status,) values('".$data->getUsername()."','".$data->getPassword().
        "','".$data->getFirstname()."','".$data->getLastname()."','".$data->getEmail()."','".$data->getQr_ExDate()."','".$data->getStatus()."')");
    }

    function ReadAccountVisitor($conn,$data)
    {
        if($data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitorTb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitorTb WHERE id = ".$data->getUsername());
        }

        return $dbData;
    }

    function UpdateAccountVisitor($conn,$data)
    {
        mysqli_query($conn,"UPDATE visitorTb set username ='".$data->getUsername()."', password ='".$data->getPassword()."', firstname ='". $data->getFirstname()
        ."', lastname ='".$data->getLastname(). "', email ='". $data->getEmail() ."', qr_ExDate ='". $data->getQr_ExDate()."', status = '".
        $data->getStatus()."' where id = ". $data->getId());
    }

    function DeleteAccountVisitor($conn,$data)
    {
        mysqli_query($conn,"DELETE from visitorTb where id = ".$data->getId());
    }

?>