<?php
    include_once '../db/connection.php';

    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';

    include_once '../db/tb_guardian.php';
    include_once '../model/guardianModel.php';


    
    if(isset($_POST['accType']))
    {
        if($_POST['accType']=='visitor')
        {
            $data = new visitorModel();
            $data->setId($_POST['idTb']);
            $data->setStatus($_POST['statusTb']);
    
            UpdateAccountVisitor($conn,$data);
            echo '<script> localStorage.setItem("visitorMsg",1); window.location = "../admin/admin_visitor.php";</script>';//success message
        }
        else if($_POST['accType']=='guardian')
        {
            $data = new guardianModel();
            $data->setId($_POST['idTb']);
            $data->setStatus($_POST['statusTb']);
    
            UpdateAccountGuardian($conn,$data);
            echo '<script> localStorage.setItem("guardianMsg",1); window.location = "../admin/admin_guardian.php";</script>';//success message
        }
    }
    else
    {
        header("Location: ../admin.php");
    }
?>