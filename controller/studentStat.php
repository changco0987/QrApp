<?php
    include_once '../db/connection.php';
    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';

    session_start();

    if(isset($_SESSION['adminNameTb']))
    {
        $student = new studentModel();
        $student->setId($_POST['idTb']);
        $student->setStatus($_POST['statusTb']);

        UpdateStudent($conn,$student);
        echo '<script> localStorage.setItem("studentMsg",2); window.location = "../admin/admin_students.php";</script>';//success message
    }
    else
    {
        header("Location: ../admin.php");
    }


?>