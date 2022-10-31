<?php 

/*
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
*/

//$url = "https://sms.teamssprogram.com/api/create/contact?key=a6cd8649fbb860dfc09471b8eedd0d2a0badb42f";//To create/add contact (POST)
//$url = "https://sms.teamssprogram.com/api/send";//To send message (GET)
$url = "https://sms.teamssprogram.com/api/get/contacts?key=a6cd8649fbb860dfc09471b8eedd0d2a0badb42f";//To get contact (GET)
//use LDAP\Result;


//The data you want to send via POST
/*$fields = [
    "key" => "a6cd8649fbb860dfc09471b8eedd0d2a0badb42f",
    "phone" => "+639495029072",
    //"name" => "Test Ran",
    //"group" => 265
    "message" => "hey this is test messsage from QREMsystem",
    "device" => 150,
    "sim" => 2,
    "priority" => 1
];*/

//url-ify the data for the POST
//$fields_string = http_build_query($fields);

//open connection
/*
$ch = curl_init();


curl_setopt($ch,CURLOPT_URL, $url);
//curl_setopt($ch,CURLOPT_POST, true);
//curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);


curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 



function escapeJsonString($value) { 
    $escapers = array("\'");
    $replacements = array("\\/");
    $result = str_replace($escapers, $replacements, $value);
    return $result;
}
//$result = json_decode(curl_exec($ch),true);
$result = curl_exec($ch);
$content = json_decode($result);
echo "$content->name";

//$curl_response = escapeJsonString($result);
//$curl_response = json_decode($curl_response,true);
//print_r($curl_response);

//print_r($curl_response);


//print_r($value[1]);

/*
$convert = json_encode($value);
print_r($convert['phone']);

//echo $result->phone;
//print_r($result->phone);
//($arr = (object)$result;
foreach($value as $val)
{
    //echo $val->{'phone'};
    //echo json_encode($val);
    print_r($val['phone']);
}*/
//print_r($result);

//curl_close($ch);

$row = '+639495029072';
if(str_contains($row, '+63')==false)
{
    echo 'false <br>';
    echo $phone;
}
else
{
    echo 'true';
}
?>