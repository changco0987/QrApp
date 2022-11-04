<?php
    $dbserver = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "systemDb";

    $conn = mysqli_connect($dbserver,$dbusername,$dbpassword,$dbname);

    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
      }
      //echo "Connected successfully";

?>