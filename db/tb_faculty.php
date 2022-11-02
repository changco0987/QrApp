<?php
    include_once 'connection.php';
    include_once '../model/facultyModel.php';

    $data = new facultyModel();
    function CreateFaculty($conn,$data)
    {
        mysqli_query($conn,"INSERT INTO facultytb(firstname,lastname,imageName,department,status) values('".$data->getFirstname()."','".$data->getLastname().
        "','".$data->getDepartment()."','".$data->getImageName()."','".$data->getStatus()."')");
    }

    function ReadFaculty($conn,$data)
    {
        if($data->getFirstname()!=null && $data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM facultytb WHERE firstname = '".$data->getFirstname()."'");
        }
        else if($data->getLastname()!=null && $data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM facultytb WHERE lastname = '".$data->getLastname()."'");
        }
        else if($data->getId()!=null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM facultytb WHERE id = ".$data->getId());
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM facultytb");
        }

        return $dbData;
    }

    function UpdateFaculty($conn,$data)
    {
      if($data->getDtrId()!=null)
        {
            //To time-in and time-out
            mysqli_query($conn,"UPDATE facultytb set gateStat ='".$data->getGateStat()."', dtrId = '".$data->getDtrId()."' where id = '".$data->getId()."'");
        }
        else if($data->getStatus() != null)
        {
            //To update status (locked, unlocked)
            mysqli_query($conn,"UPDATE facultytb SET status ='".$data->getStatus()."' WHERE id =".$data->getId());
        }
        else
        {

            //$address = mysqli_real_escape_string($conn,$data->getAddress());
            mysqli_query($conn,"UPDATE facultytb set firstname ='". $data->getFirstname()
            ."', lastname ='".$data->getLastname(). "', department ='". $data->getDepartment()."', imageName = '".$data->getImageName()."' where id = ". $data->getId());
        }
    }

    function DeleteFaculty($conn,$data)
    {
        mysqli_query($conn,"DELETE from facultytb where id = ".$data->getId());
    }

?>