<?php
    include_once 'connection.php';
    include_once '../model/dtrModel.php';

    $dtr = new dtrModel();
    function CreateDtr($conn,$dtr)
    {
        mysqli_query($conn,"INSERT INTO dtr(dataId, temperature, accType, time_in) values('".$dtr->getDataId()."','".$dtr->getTemperature()."','".$dtr->getAccType()."','".$dtr->getTime_in()."')");
        $id = mysqli_insert_id($conn);
        return $id;
    }

    function ReadDtr($conn,$dtr)
    {
        if($dtr->getDataId()!=null)
        {
            //to get all data in this table
            $dbData = mysqli_query($conn,"SELECT * FROM dtr WHERE dataId = ".$dtr->getDataId());
        }
        else if($dtr->getAccType()!= null && $dtr->getId()==null)
        {
            //to get data using AccType
            $dbData = mysqli_query($conn,"SELECT * FROM dtr WHERE accType = '".$dtr->getAccType()."'");
        }
        else if($dtr->getId()==null)
        {
            //to get all data in this table
            $dbData = mysqli_query($conn,"SELECT * FROM dtr");
        }
        else
        {
            //to get data using id
            $dbData = mysqli_query($conn,"SELECT * FROM dtr WHERE id = ".$dtr->getId());
        }

        return $dbData;
    }

    function UpdateDtr($conn,$dtr)
    {
        mysqli_query($conn,"UPDATE dtr set time_out ='".$dtr->getTime_out()."' where id = ". $dtr->getId());
    }

    function DeleteDtr($conn,$dtr)
    {
        mysqli_query($conn,"DELETE from dtr where id = ".$dtr->getId());
    }

?>