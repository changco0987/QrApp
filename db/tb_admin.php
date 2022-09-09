<?php
    include_once 'connection.php';
    include_once '../model/adminModel.php';

    $data = new adminModel();
    function CreateAdmin($conn,$data)
    {
        mysqli_query($conn,"INSERT INTO admintb(username,password) values('".$data->getUsername()."','".$data->getPassword()."')");
    }

    function ReadAdmin($conn,$data)
    {
        if($data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM admintb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM admintb WHERE username = '".$data->getUsername()."'");
        }

        return $dbData;
    }

    function UpdateAdmin($conn,$data)
    {
        mysqli_query($conn,"UPDATE admintb set username ='".$data->getUsername()."', password ='".$data->getPassword()."' where id = ". $data->getId());
    }

    function DeleteAdmin($conn,$data)
    {
        mysqli_query($conn,"DELETE from admintb where id = ".$data->getId());
    }

?>