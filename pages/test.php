<?php 

    date_default_timezone_set('Asia/Manila');
    //$date = strtotime("+12 h", strtotime("2022-08-14 01:30:33"));
    //echo date("Y-m-d h:i a", $date);


    $date = new DateTime("2022-08-14 01:30:33");
    $date->add(new DateInterval('PT12H'));
    $date->format('Y-m-d h:i a') . "\n";  //it i will give you 10:00:00

    $date2 = date('Y-m-d h:i a');
    if($date<$date2)
    {
        echo 'oo';
    }
    else
    {
        echo 'hindi';
    }
?>