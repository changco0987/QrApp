<?php
    include_once '../db/connection.php';
    include_once '../db/tb_announcement.php';
    include_once '../model/announcementModel.php';

    $imgPath = '../upload/events/';
    $tempFilename = '';
    $fileExtension = pathinfo($_FILES['fileTb']['name'],PATHINFO_EXTENSION);



    
    if(isset($_POST['rowId']))
    {
        $event = new announcementModel();
        $event->setId($_POST['rowId']);
        $event->setHeading($_POST['headingTb']);
        $event->setContent($_POST['contentTb']);
        $event->setDate($_POST['dateTb']);
        $event->setDateTo($_POST['dateToTb']);
        



        if($_FILES['fileTb']['name']!="")
        {
            $event->setImageName('photo'.rand(982,13100). "." .$fileExtension);
            $uploadedFile = $_FILES['fileTb']['tmp_name'];
            copy($uploadedFile,$imgPath.$event->getImageName());//This will move the uploaded file into file directory (web)
        }

        UpdateEvent($conn,$event);

        //header('Location: ../admin/dashboard.php');
        if($_POST['typeTb']=='event')
        {
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("state",3); window.location = "../admin/dashboard.php";</script>';//success message
        }
        else if($_POST['typeTb']=='holiday')
        {
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("state",3); window.location = "../admin/dashboardHoliday.php";</script>';//success message
        }
        else if($_POST['typeTb']=='exam')
        {
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("state",3); window.location = "../admin/dashboardExam.php";</script>';//success message
        }
        else if($_POST['typeTb']=='enrollment')
        {
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("state",3); window.location = "../admin/dashboardEnrollment.php";</script>';//success message
        }

        

        
        
    }
    else
    {
        echo 'Error encountered in getting the element named="rowId" please contact to system administrator';
    }


?>