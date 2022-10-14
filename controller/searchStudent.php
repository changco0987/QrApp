<?php
    include_once '../db/connection.php';
    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';

    session_start();

    if(isset($_POST['searchName']))
    {
        $student = new studentModel();
        $result = ReadStudent($conn,$student);

        while($row = mysqli_fetch_assoc($result))
        {
            if(strtolower($row['firstname']) == strtolower($_POST['searchName']) ||
               str_contains(strtolower($row['firstname']),strtolower($_POST['searchName'])))
            {
               $_SESSION['studentFname'] = $row['firstname'];
                header("location: ../admin/admin_students.php?Firstname=".$row['firstname']);
                exit;
            }

            if(strtolower($row['lastname']) == strtolower($_POST['searchName']) ||
               str_contains(strtolower($row['lastname']),strtolower($_POST['searchName'])))
            {
                $_SESSION['studentLname'] = $row['lastname'];
                header("location: ../admin/admin_students.php?Lastname=".$row['lastname']);
                exit;
            }
        }
        header("location: ../admin/admin_students.php?Empty");
        exit;
    }
    echo 'Error!';

       
    

?>