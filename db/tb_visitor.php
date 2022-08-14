<?php
    include_once 'connection.php';
    include_once '../model/visitorModel.php';

    $data = new visitorModel();
    function CreateAccountVisitor($conn,$data)
    {
        mysqli_query($conn,"INSERT INTO visitortb(username,password,firstname,lastname,email,status) values('".$data->getUsername()."','".$data->getPassword().
        "','".$data->getFirstname()."','".$data->getLastname()."','".$data->getEmail()."','".$data->getStatus()."')");
    }

    function ReadAccountVisitor($conn,$data)
    {
        if($data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitortb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitortb WHERE username = '".$data->getUsername()."'");
        }

        return $dbData;
    }

    function UpdateAccountVisitor($conn,$data)
    {

        if($data->getQr_ExDate()==null)
        {
            mysqli_query($conn,"UPDATE visitortb set username ='".$data->getUsername()."', password ='".$data->getPassword()."', firstname ='". $data->getFirstname()
            ."', lastname ='".$data->getLastname(). "', email ='". $data->getEmail() ."', status = '".$data->getStatus()."' where id = ". $data->getId());
        }
        else
        {
            mysqli_query($conn,"UPDATE visitortb set qr_ExDate ='".$data->getQr_ExDate()."' where username = '".$data->getUsername()."'");
        }
    }

    function DeleteAccountVisitor($conn,$data)
    {
        mysqli_query($conn,"DELETE from visitortb where id = ".$data->getId());
    }

?>