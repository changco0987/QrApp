<?php
    include_once 'connection.php';
    include_once '../model/visitorModel.php';

    $data = new visitorModel();
    function CreateAccountVisitor($conn,$data)
    {
        $address = mysqli_real_escape_string($conn,$data->getAddress());
        mysqli_query($conn,"INSERT INTO visitortb(username,password,firstname,lastname,address,contact_number,imageName,status) values('".$data->getUsername()."','".$data->getPassword().
        "','".$data->getFirstname()."','".$data->getLastname()."','".$address."','".$data->getContact_number()."','".$data->getImageName()."','".$data->getStatus()."')");
    }

    function ReadAccountVisitor($conn,$data)
    {
        if($data->getFirstname()!=null && $data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitortb WHERE firstname = '".$data->getFirstname()."'");
        }
        else if($data->getLastname()!=null && $data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitortb WHERE lastname = '".$data->getLastname()."'");
        }
        else if($data->getUsername()!=null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitortb WHERE username = '".$data->getUsername()."'");
        }
        else if($data->getId()!=null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitortb WHERE id = ".$data->getId());
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM visitortb ORDER BY firstname ASC");
        }

        return $dbData;
    }

    function UpdateAccountVisitor($conn,$data)
    {
        if($data->getPassword()!=null && $data->getStatus()==null)
        {
            mysqli_query($conn,"UPDATE visitortb set password ='".$data->getPassword()."' where username = '".$data->getUsername()."'");
        }
        else if($data->getOtp()!=null)
        {
            mysqli_query($conn,"UPDATE visitortb set otp ='".$data->getOtp()."' where username = '".$data->getUsername()."'");
        }
        else if($data->getDtrId()!=null)
        {
            mysqli_query($conn,"UPDATE visitortb set gateStat ='".$data->getGateStat()."', dtrId = '".$data->getDtrId()."' where username = '".$data->getUsername()."'");
        }
        else if($data->getStatus() != null)
        {
            mysqli_query($conn,"UPDATE visitortb SET status ='".$data->getStatus()."' WHERE id =".$data->getId());
        }
        else if($data->getQr_ExDate()==null)
        {

            //to filter if the password is changed
            if($data->getPassword()==null)
            {

                $address = mysqli_real_escape_string($conn,$data->getAddress());
                mysqli_query($conn,"UPDATE visitortb set username ='".$data->getUsername()."', firstname ='". $data->getFirstname()
                ."', lastname ='".$data->getLastname(). "', address ='". $address. "',contact_number ='". $data->getContact_number().
                "', imageName = '".$data->getImageName()."' where id = ". $data->getId());
            }
            else
            {

                $address = mysqli_real_escape_string($conn,$data->getAddress());
                mysqli_query($conn,"UPDATE visitortb set username ='".$data->getUsername()."', password ='".$data->getPassword()."', firstname ='". $data->getFirstname()
                ."', lastname ='".$data->getLastname(). "', address ='". $address. "', contact_number ='". $data->getContact_number().
                "', imageName = '".$data->getImageName()."' where id = ". $data->getId());
            }
            

        }
        else
        {
            mysqli_query($conn,"UPDATE visitortb set qr_ExDate ='".$data->getQr_ExDate()."' where username = '".$data->getUsername()."'");
        }
    }

    function DeleteAccountVisitor($conn,$data)
    {
        mysqli_query($conn,"DELETE from visitortb where id = ".$data->getId());
    }

?>