<?php
    include_once '../db/connection.php';

    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';
    
    include_once '../db/tb_guardian.php';
    include_once '../model/guardianModel.php';

    session_start();

    if(isset($_POST['searchName']))
    {
        if($_POST['accType'] == 'visitor')
        {
            $data = new visitorModel();
            $result = ReadAccountVisitor($conn,$data);
    
            while($row = mysqli_fetch_assoc($result))
            {
                if(strtolower($row['firstname']) == strtolower($_POST['searchName']) ||
                   str_contains(strtolower($row['firstname']),strtolower($_POST['searchName'])))
                {
                   $_SESSION['accountFname'] = $row['firstname'];
                    header("location: ../admin/admin_visitor.php?Firstname=".$row['firstname']);
                    exit;
                }
    
                if(strtolower($row['lastname']) == strtolower($_POST['searchName']) ||
                   str_contains(strtolower($row['lastname']),strtolower($_POST['searchName'])))
                {
                    $_SESSION['accountLname'] = $row['lastname'];
                    header("location: ../admin/admin_visitor.php?Lastname=".$row['lastname']);
                    exit;
                }
            }
            header("location: ../admin/admin_visitor.php?Empty");
            exit;
        }
        else if($_POST['accType'] == 'guardian')
        {
            $data = new guardianModel();
            $result = ReadAccountGuardian($conn,$data);
    
            while($row = mysqli_fetch_assoc($result))
            {
                if(strtolower($row['firstname']) == strtolower($_POST['searchName']) ||
                   str_contains(strtolower($row['firstname']),strtolower($_POST['searchName'])))
                {
                   $_SESSION['accountFname'] = $row['firstname'];
                    header("location: ../admin/admin_guardian.php?Firstname=".$row['firstname']);
                    exit;
                }
    
                if(strtolower($row['lastname']) == strtolower($_POST['searchName']) ||
                   str_contains(strtolower($row['lastname']),strtolower($_POST['searchName'])))
                {
                    $_SESSION['accountLname'] = $row['lastname'];
                    header("location: ../admin/admin_guardian.php?Lastname=".$row['lastname']);
                    exit;
                }
            }
            header("location: ../admin/admin_guardian.php?Empty");
            exit;
        }
        
    }
    echo 'Error!';
?>