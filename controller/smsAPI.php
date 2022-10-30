<?php 
include_once '../API/apiData.php';

//(GET)
function sendMessage($ch,$key,$device,$sim,$priority,$phone,$message)
{
    curl_setopt($ch,CURLOPT_URL, "https://sms.teamssprogram.com/api/send?key=".$key."&phone=".$phone."&message=".$message."&devive=".$device."&sim=".$sim."&priority=".$priority);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch,CURLOPT_HTTPGET, true); 

    $result = curl_exec($ch);
    if($result == false)
    {
        die("cURL Error: ".curl_error($ch));
        return false;
    }
    else
    {
        return true;
    }
}


//(POST)
function addContact($ch,$phone,$name)
{
    $url = "https://sms.teamssprogram.com/api/create/contact?key=a6cd8649fbb860dfc09471b8eedd0d2a0badb42f";//To create/add contact (POST)

    $fields = [
        "phone" => $phone,
        "name" => $name,
        "group" => 265
    ];
    
    //url-ify the data for the POST
    $fields_string = http_build_query($fields);
    
    //open connection
    $ch = curl_init();
    
    
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    
    
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    
    $result = curl_exec($ch);
    if($result == false)
    {
        die("cURL Error: ".curl_error($ch));
        return false;
    }
    else
    {
        return true;
    }

}


//(GET)
function readContact($ch)
{
    $url = "https://sms.teamssprogram.com/api/get/contacts?key=a6cd8649fbb860dfc09471b8eedd0d2a0badb42f";//To get contact (GET)
}


//url-ify the data for the POST




//curl_setopt($ch,CURLOPT_POST, true);
//curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);





//curl_close($ch);

?>