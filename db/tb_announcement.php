<?php
    include_once 'connection.php';
    include_once '../model/announcementModel.php';

    $event = new announcementModel();
    function CreateEvent($conn,$event)
    {
        mysqli_query($conn,"INSERT INTO announcementtb(heading,content,imageName,isShow,type) values('".$event->getHeading()."','".$event->getContent().
        "','".$event->getImageName()."',".$event->getIsShow().",'".$event->getType()."')");
    }

    function ReadEvent($conn,$event)
    {
        $dbData = mysqli_query($conn,"SELECT * FROM announcementtb");

        return $dbData;
    }

    function UpdateEvent($conn,$event)
    {
        mysqli_query($conn,"UPDATE announcementtb set heading = '".$event->getHeading()."', content = '".$event->getContent().
        "', imageName = '".$event->getImageName()."', isShow = ".$event->getIsShow().", type = '".$event->getType()."' where id = ". $event->getId());
    }

    function DeleteEvent($conn,$event)
    {
        mysqli_query($conn,"DELETE from announcementtb where id = ".$event->getId());
    }

?>