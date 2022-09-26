<?php
    include_once 'connection.php';
    include_once '../model/visitorModel.php';

    $data = new visitorModel();
    function CreateAccountVisitor($conn,$data)
    {
        $address = mysqli_real_escape_string($conn,$data->getAddress());
        mysqli_query($conn,"INSERT INTO visitortb(username,password,firstname,lastname,address,contact_number,imageName,status) values('".$data->getUsername()."','".$data->getPassword().
        "','".$data->getFirstname()."','".$data->getLastname()."','".$address."','".$data->getContact_number()."','".$data->getImageName()."','".$data->getStatus()."')");
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
        if($data->getDtrId()!=null)
        {
            mysqli_query($conn,"UPDATE visitortb set gateStat ='".$data->getGateStat()."', dtrId = '".$data->getDtrId()."' where username = '".$data->getUsername()."'");
        }
        else if($data->getQr_ExDate()==null)
        {

            $address = mysqli_real_escape_string($conn,$data->getAddress());
            mysqli_query($conn,"UPDATE visitortb set username ='".$data->getUsername()."', password ='".$data->getPassword()."', firstname ='". $data->getFirstname()
            ."', lastname ='".$data->getLastname(). "', address ='". $address. "',contact_number ='". $data->getContact_number().
            "', imageName = '".$data->getImageName()."', status = '".$data->getStatus()."' where id = ". $data->getId());
            

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