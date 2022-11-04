<?php
    include_once '../db/connection.php';
    include_once '../db/tb_announcement.php';
    include_once '../model/announcementModel.php';


    if(isset($_POST['idTb']))
    {
        $event = new announcementModel();
        $event->setId($_POST['idTb']);

        DeleteEvent($conn,$event);
        if($_POST['typeTb']=='event')
        {
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("state",3); window.location = "../admin/dashboard.php";</script>';//success message
            exit;
        }
        else if($_POST['typeTb']=='holiday')
        {
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("state",3); window.location = "../admin/dashboardHoliday.php";</script>';//success message
            exit;
        }
        else if($_POST['typeTb']=='exam')
        {
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("state",3); window.location = "../admin/dashboardExam.php";</script>';//success message
            exit;
        }
        else if($_POST['typeTb']=='enrollment')
        {
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("state",3); window.location = "../admin/dashboardEnrollment.php";</script>';//success message
            exit;
        }
    }
    else
    {
        //this will occur incase an error posting idTb
        echo '<script> window.location = "../admin/dashboard.php";</script>';
        exit;
    }
?>