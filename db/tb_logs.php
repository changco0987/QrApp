<?php
    include_once 'connection.php';
    include_once '../model/logsModel.php';

    $logs = new logsModel();
    function CreateAccountVisitor($conn,$logs)
    {
        //$address = mysqli_real_escape_string($conn,$data->getAddress());
        mysqli_query($conn,"INSERT INTO logstb(activity,creator,ipAdd,dateStamp) values('".$logs->getActivity()."','".$logs->getCreator().
        "','".$logs->getIpAdd()."','".$logs->getDateStamp()."')");
    }

    function ReadAccountVisitor($conn,$logs)
    {
        if($logs->getId()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM logstb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM logstb WHERE id = ".$logs->getId()."");
        }

        return $dbData;
    }

    function UpdateAccountVisitor($conn,$logs)
    {

        //$address = mysqli_real_escape_string($conn,$logs->getAddress());
        mysqli_query($conn,"UPDATE logstb set activity = '".$logs->getActivity()."', creator = '".$logs->getCreator()."', ipApp = '".$logs->getIpAdd()
        .", dateStamp = '".$logs->getDateStamp()."' where id =".$logs->getId());
    }

    function DeleteAccountVisitor($conn,$logs)
    {
        mysqli_query($conn,"DELETE from logstb where id = ".$logs->getId());
    }

?>