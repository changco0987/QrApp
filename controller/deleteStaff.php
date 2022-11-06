<?php
    include_once '../db/connection.php';
    include_once '../db/tb_faculty.php';
    include_once '../model/facultyModel.php';


    if(isset($_POST['idTb']))
    {
        $data = new facultyModel();
        $data->setId($_POST['idTb']);

        DeleteFaculty($conn,$data);

        //header('Location: ../admin/dashboard.php');
        echo '<script> localStorage.setItem("staffMsg",4); window.location = "../admin/admin_faculty.php";</script>';//success message
   
    }
    else
    {
        //this will occur incase an error posting idTb
        echo '<script> window.location = "../admin.php";</script>';
    }
?>