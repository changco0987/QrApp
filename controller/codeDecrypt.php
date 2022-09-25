<?php
    include_once '../db/connection.php';
    //CRUD
    include_once '../db/tb_visitor.php';
    include_once '../db/tb_guardian.php';
    include_once '../db/tb_student.php';

    //Model
    include_once '../model/visitorModel.php';
    include_once '../model/guardianModel.php';
    include_once '../model/studentModel.php';


    if(isset($_POST['codeInput']))
    {
        $decryptedCode = unserialize(base64_decode($_POST['codeInput']));
        echo json_encode(unserialize(base64_decode($_POST['codeInput'])));
    }
?>