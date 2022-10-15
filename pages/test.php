<?php 

    date_default_timezone_set('Asia/Manila');
    //$date = strtotime("+12H", strtotime("2022-08-14 01:30:33"));
    //echo date("Y-m-d h:i a", $date);


    $date = new DateTime("2022-08-14 01:30");
    $date->add(new DateInterval('PT12H'));
    echo $date->format('Y-m-d h:i a') . "\n";  //it i will give you 10:00:00

    $date2 = date('Y-m-d h:i a');
    //echo $date2."da";
    if($date<$date2)
    {
        echo 'oo';
    }
    else
    {
        echo 'hindi';
    }
    $localIP = getHostByName(getHostName());


?>