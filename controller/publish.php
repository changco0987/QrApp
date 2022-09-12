<?php
    include_once '../db/connection.php';
    include_once '../db/tb_announcement.php';
    include_once '../model/announcementModel.php';


    $event = new announcementModel();

    if(isset($_POST['idTb']))
    {
        $event->setId($_POST['idTb']);
        $event->setIsShow($_POST['publishTb']);

        UpdateEvent($conn,$event);
        echo '<script> localStorage.setItem("state",2); window.location = "../admin/dashboard.php";</script>';//success message
    }

?>