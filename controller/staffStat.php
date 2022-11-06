<?php
    include_once '../db/connection.php';
    include_once '../db/tb_faculty.php';
    include_once '../model/facultyModel.php';

    session_start();

    if(isset($_SESSION['adminNameTb']))
    {
        $data = new facultyModel();
        $data->setId($_POST['idTb']);
        $data->setStatus($_POST['statusTb']);

        UpdateFaculty($conn,$data);
        echo '<script> localStorage.setItem("staffMsg",1); window.location = "../admin/admin_faculty.php";</script>';//success message
    }
    else
    {
        header("Location: ../admin.php");
    }


?>