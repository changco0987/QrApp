<?php
    include_once '../db/connection.php';

    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';

    include_once '../db/tb_guardian.php';
    include_once '../model/guardianModel.php';


    if(isset($_POST['idTb']))
    {
        if($_POST['accType'] == 'visitor')
        {
            $data = new visitorModel();
            $data->setId($_POST['idTb']);
    
            DeleteAccountVisitor($conn,$data);
    
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("visitorMsg",4); window.location = "../admin/admin_visitor.php";</script>';//success message
        }
        else if($_POST['accType'] == 'guardian')
        {
            $data = new guardianModel();
            $data->setId($_POST['idTb']);
    
            DeleteAccountGuardian($conn,$data);
    
            //header('Location: ../admin/dashboard.php');
            echo '<script> localStorage.setItem("guardianMsg",4); window.location = "../admin/admin_guardian.php";</script>';//success message
        }
   
    }
    else
    {
        //this will occur incase an error posting idTb
        echo '<script> window.location = "../admin.php";</script>';
    }
?>