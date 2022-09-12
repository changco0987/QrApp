<?php
    include_once 'connection.php';
    include_once '../model/announcementModel.php';

    $event = new announcementModel();
    function CreateEvent($conn,$event)
    {
        mysqli_query($conn,"INSERT INTO announcementtb(heading,content,imageName,type,date) values('".$event->getHeading()."','".$event->getContent().
        "','".$event->getImageName()."','".$event->getType()."','".$event->getDate()."')");
    }

    function ReadEvent($conn,$event)
    {
        $dbData = mysqli_query($conn,"SELECT * FROM announcementtb");

        return $dbData;
    }

    function UpdateEvent($conn,$event)
    {
        if($event->getIsShow()==null)
        {
            mysqli_query($conn,"UPDATE announcementtb set heading = '".$event->getHeading()."', content = '".$event->getContent().
            "', imageName = '".$event->getImageName()."', type = '".$event->getType()."' date=".$event->getDate()."' where id = ". $event->getId());
        }
        else
        {
            mysqli_query($conn,"UPDATE announcementtb set isShow = ".$event->getIsShow()." where id = ". $event->getId());
        }
    }

    function DeleteEvent($conn,$event)
    {
        mysqli_query($conn,"DELETE from announcementtb where id = ".$event->getId());
    }

?>