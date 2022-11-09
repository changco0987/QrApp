<?php
    include_once '../db/connection.php';
    include_once '../db/tb_faculty.php';
    include_once '../model/facultyModel.php';

    session_start();

    if(isset($_POST['searchName']))
    {
        $data = new facultyModel();
        $result = ReadFaculty($conn,$data);

        while($row = mysqli_fetch_assoc($result))
        {
            if(strtolower($row['firstname']) == strtolower($_POST['searchName']) ||
               str_contains(strtolower($row['firstname']),strtolower($_POST['searchName'])))
            {
                //$_SESSION['Fname'] = $row['firstname'];
                header("location: ../admin/admin_faculty.php?firstname=".$row['firstname']);
                exit;
            }

            if(strtolower($row['lastname']) == strtolower($_POST['searchName']) ||
               str_contains(strtolower($row['lastname']),strtolower($_POST['searchName'])))
            {
                //$_SESSION['Lname'] = $row['lastname'];
                header("location: ../admin/admin_faculty.php?lastname=".$row['lastname']);
                exit;
            }
        }
        header("location: ../admin/admin_faculty.php?Empty");
        exit;
    }
    echo 'Error!';

       
    

?>