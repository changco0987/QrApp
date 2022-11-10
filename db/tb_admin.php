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
        if($data->getId()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM admintb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM admintb WHERE id = ".$data->getId());
        }

        return $dbData;
    }

    function UpdateAdmin($conn,$data)
    {
        if($data->getLoginCount()!=null)
        {
            mysqli_query($conn,"UPDATE admintb set loginCount =".$data->getLoginCount());
        }
        else if($data->getUsername()==null)
        {
            mysqli_query($conn,"UPDATE admintb set activeLogin =".$data->getActiveLogin());
        }
        else
        {
            mysqli_query($conn,"UPDATE admintb set username ='".$data->getUsername()."', password ='".$data->getPassword()."' where id = ". $data->getId());
        }
    }

    function DeleteAdmin($conn,$data)
    {
        mysqli_query($conn,"DELETE from admintb where id = ".$data->getId());
    }

?>