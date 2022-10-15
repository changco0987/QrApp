<?php
    include_once '../db/connection.php';
    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';


    
    if(isset($_POST['accType']))
    {
        if($_POST['accType']=='visitor')
        {
            $student = new visitorModel();
            $student->setId($_POST['idTb']);
            $student->setStatus($_POST['statusTb']);
    
            UpdateAccountVisitor($conn,$student);
            echo '<script> localStorage.setItem("visitorMsg",1); window.location = "../admin/admin_visitor.php";</script>';//success message
        }
        else if($_POST['accType']=='guardian')
        {


        }
    }
    else
    {
        header("Location: ../admin.php");
    }
?>