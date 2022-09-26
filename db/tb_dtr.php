<?php
    include_once 'connection.php';
    include_once '../model/dtrModel.php';

    $dtr = new dtrModel();
    function CreateDtr($conn,$dtr)
    {
        mysqli_query($conn,"INSERT INTO dtr(dataId, accType, time_in) values('".$dtr->getDataId()."','".$dtr->getAccType()."','".$dtr->getTime_in()."')");
        $id = mysqli_insert_id($conn);
        return $id;
    }

    function ReadDtr($conn,$dtr)
    {
        if($dtr->getId()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM dtr");
        }
        else
        {
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