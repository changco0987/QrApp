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

                if(isset($_POST['record']))
                {
                    header("location: ../admin/record_faculty.php?firstname=".$row['firstname']);
                }
                else
                {
                    header("location: ../admin/admin_faculty.php?firstname=".$row['firstname']);
                }
                exit;
            }

            if(strtolower($row['lastname']) == strtolower($_POST['searchName']) ||
               str_contains(strtolower($row['lastname']),strtolower($_POST['searchName'])))
            {

                if(isset($_POST['record']))
                {
                    header("location: ../admin/record_faculty.php?lastname=".$row['lastname']);
                }
                else
                {
                    header("location: ../admin/admin_faculty.php?lastname=".$row['lastname']);
                }
                exit;
            }
        }

        if(isset($_POST['record']))
        {
            header("location: ../admin/record_faculty.php?Empty");
            exit;
        }
        else
        {
            header("location: ../admin/admin_faculty.php?Empty");
            exit;
        }
    }
    echo 'Error!';

       
    

?>