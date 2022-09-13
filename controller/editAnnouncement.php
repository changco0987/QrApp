<?php
    include_once '../db/connection.php';
    include_once '../db/tb_announcement.php';
    include_once '../model/announcementModel.php';

    session_unset($_SESSION['rowId']);
    $_SESSION['rowId'] = $_POST['rowId'];

    echo json_encode($_SESSION['rowId']);

?>