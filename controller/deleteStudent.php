<?php
    include_once '../db/connection.php';
    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';
    
    include_once '../db/tb_logs.php';
    include_once '../model/logsModel.php';


    $log = new logsModel();
    if(isset($_POST['idTb']))
    {
        $student = new studentModel();
        $student->setId($_POST['idTb']);

        //this will read the selected data that the user wants to be deleted
        $read = ReadStudent($conn,$student);

        
        //create log
        $log->setActivity('deleted student named: '.$read['firstname'].' '.$read['lastname']);
        $log->setIpAdd();
        $log->setAccType('Administrator');
        $log->setCreator($row['username']);
    
        CreateLog($conn,$log);

        DeleteStudent($conn,$student);

        //header('Location: ../admin/dashboard.php');
        echo '<script> localStorage.setItem("studentMsg",3); window.location = "../admin/admin_students.php";</script>';//success message
   
    }
    else
    {
        //this will occur incase an error posting idTb
        echo '<script> window.location = "../admin.php";</script>';
    }
?>