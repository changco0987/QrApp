<?php
    include_once '../db/connection.php';
    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';

    $imgPath = '../upload/students/';
    $tempFilename = '';
    $fileExtension = pathinfo($_FILES['fileTb']['name'],PATHINFO_EXTENSION);

    session_start();
    if(isset($_SESSION['adminNameTb']))
    {
        $student = new studentModel();
        $student->setId($_POST['idTb']);
        $student->setFirstname($_POST['fnameTb']);
        $student->setLastname($_POST['lnameTb']);
        $student->setLastname($_POST['mnameTb']);
        $student->setGender($_POST['genderRb']);
        $student->setAge($_POST['ageTb']);
        $student->setAddress($_POST['addressTb']);
        $student->setContact_number($_POST['contactNumTb']);
        $student->setStudentId($_POST['studentIdTb']);
        $student->setCourse($_POST['courseTb']);
        $student->setSection($_POST['sectionTb']);
        $student->setYear($_POST['yearTb']);
        $student->setGuardianName($_POST['guardianNameTb']);
        $student->setGuardianNum($_POST['guardianNumTb']);

        
        if($_FILES['fileTb']['name']!="")
        {
            $student->setImageName('student'.rand(982,13100). "." .$fileExtension);
            $uploadedFile = $_FILES['fileTb']['tmp_name'];
            copy($uploadedFile,$imgPath.$student->getImageName());//This will move the uploaded file into file directory (web)
        }
        else
        {
            $data->setImageName($_POST['imageName']);
        }

        UpdateStudent($conn,$student);
        echo '<script> localStorage.setItem("studentMsg",4); window.location = "../admin/admin_students.php";</script>';//success message
    }
    else
    {
        header("Location: ../admin.php");
    }

?>