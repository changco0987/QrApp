<?php
    include_once '../db/connection.php';
    include_once '../db/tb_faculty.php';
    include_once '../model/facultyModel.php';

    $imgPath = '../upload/faculty/';
    $tempFilename = '';
    $fileExtension = pathinfo($_FILES['fileTb']['name'],PATHINFO_EXTENSION);

    session_start();
    if(isset($_SESSION['adminNameTb']))
    {
        $data = new facultyModel();
        $data->setId($_POST['idTb']);
        $data->setFirstname($_POST['fnameTb']);
        $data->setLastname($_POST['lnameTb']);
        $data->setContact_number($_POST['contactNumTb']);
        $data->setDepartment($_POST['departmentTb']);

        
        if($_FILES['fileTb']['name']!="")
        {
            $data->setImageName('staff'.rand(982,13100). "." .$fileExtension);
            $uploadedFile = $_FILES['fileTb']['tmp_name'];
            copy($uploadedFile,$imgPath.$data->getImageName());//This will move the uploaded file into file directory (web)
        }
        else
        {
            $data->setImageName($_POST['imageName']);
        }

        UpdateFaculty($conn,$data);
        echo '<script> localStorage.setItem("staffMsg",1); window.location = "../admin/admin_faculty.php";</script>';//success message
    }
    else
    {
        header("Location: ../admin.php");
    }

?>