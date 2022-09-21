<?php
    include_once 'connection.php';
    include_once '../model/announcementModel.php';

    $event = new announcementModel();
    function CreateEvent($conn,$event)
    {
        $content = mysqli_real_escape_string($conn,$event->getContent());
        mysqli_query($conn,"INSERT INTO announcementtb(heading,content,imageName,type,date) values('".$event->getHeading()."','".$content.
        "','".$event->getImageName()."','".$event->getType()."','".$event->getDate()."')");
    }

    function ReadEvent($conn,$event)
    {
        if($event->getId()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM announcementtb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM announcementtb where id = ".$event->getId());
        }

        return $dbData;
    }

    function UpdateEvent($conn,$event)
    {
        if($event->getIsShow()==null && $event->getImageName()!=null)
        {
            $content = mysqli_real_escape_string($conn,$event->getContent());
            mysqli_query($conn,"UPDATE announcementtb set heading = '".$event->getHeading()."', content = '".$content.
            "', imageName = '".$event->getImageName()."', date='".$event->getDate()."' where id = ". $event->getId());
        }
        else if($event->getIsShow()==null)
        {
            $content = mysqli_real_escape_string($conn,$event->getContent());
            mysqli_query($conn,"UPDATE announcementtb set heading = '".$event->getHeading()."', content = '".$content.
            "', date='".$event->getDate()."' where id = ". $event->getId());
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