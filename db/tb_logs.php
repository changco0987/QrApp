<?php
    include_once 'connection.php';
    include_once '../model/logsModel.php';

    $logs = new logsModel();
    function CreateLog($conn,$logs)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d h:i:s a');
        //$address = mysqli_real_escape_string($conn,$data->getAddress());
        mysqli_query($conn,"INSERT INTO logstb(activity,creator,ipAdd,accType,dateStamp) values('".$logs->getActivity()."','".$logs->getCreator().
        "','".$logs->getIpAdd()."','".$logs->getAccType()."','".$date."')");
    }

    function ReadLog($conn,$logs)
    {
        if($logs->getCreator()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM logstb ORDER BY id DESC");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM logstb WHERE creator = '".$logs->getCreator()."' ORDER BY id DESC");
        }

        return $dbData;
    }

    function UpdateLog($conn,$logs)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d h:i:s a');
        //$address = mysqli_real_escape_string($conn,$logs->getAddress());
        mysqli_query($conn,"UPDATE logstb set activity = '".$logs->getActivity()."', creator = '".$logs->getCreator()."', ipApp = '".$logs->getIpAdd()
        ."', accType = '".$logs->getAccType()."', dateStamp = '".$date."' where id =".$logs->getId());
    }

    function DeleteLog($conn,$logs)
    {
        mysqli_query($conn,"DELETE from logstb where id = ".$logs->getId());
    }

?>