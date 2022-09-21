<?php
    include_once '../db/connection.php';
    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';


    if(isset($_POST['idTb']))
    {
        $student = new studentModel();
        $student->setId($_POST['idTb']);

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