<?php
    include_once '../db/connection.php';
    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';


    if(isset($_POST['idTb']))
    {
        if($_POST['accType'] == 'visitor')
        {
            $student = new visitorModel();
            $student->setId($_POST['idTb']);
    
            DeleteAccountVisitor($conn,$student);
    
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("visitorMsg",4); window.location = "../admin/admin_visitor.php";</script>';//success message
        }
        else if($_POST['accType'] == 'guardian')
        {

        }
   
    }
    else
    {
        //this will occur incase an error posting idTb
        echo '<script> window.location = "../admin.php";</script>';
    }
?>