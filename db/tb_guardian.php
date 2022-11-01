<?php
    include_once 'connection.php';
    include_once '../model/guardianModel.php';

    $data = new guardianModel();
    function CreateAccountGuardian($conn,$data)
    {
        $address = mysqli_real_escape_string($conn,$data->getAddress());
        mysqli_query($conn,"INSERT INTO guardiantb(username,password,firstname,lastname,address,contact_number,studentId,imageName,status) values('".$data->getUsername()."','".$data->getPassword().
        "','".$data->getFirstname()."','".$data->getLastname()."','".$address."','".$data->getContact_number()."','".$data->getStudentId()."','".$data->getImageName().
        "','".$data->getStatus()."')");
    }

    function ReadAccountGuardian($conn,$data)
    {
        
        if($data->getFirstname()!=null && $data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM guardiantb WHERE firstname = '".$data->getFirstname()."'");
        }
        else if($data->getLastname()!=null && $data->getUsername()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM guardiantb WHERE lastname = '".$data->getLastname()."'");
        }
        else if($data->getUsername()!=null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM guardiantb WHERE username = '".$data->getUsername()."'");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM guardiantb");
        }

        return $dbData;
    }

    function UpdateAccountGuardian($conn,$data)
    {
        if($data->getOtp()!=null)
        {
            mysqli_query($conn,"UPDATE guardiantb set otp ='".$data->getOtp()."' where username = '".$data->getUsername()."'");
        }
        else if($data->getDtrId()!=null)
        {
            mysqli_query($conn,"UPDATE guardiantb set gateStat ='".$data->getGateStat()."', dtrId = '".$data->getDtrId()."' where username = '".$data->getUsername()."'");
        }
        else if($data->getStatus() != null)
        {
            mysqli_query($conn,"UPDATE guardiantb SET status ='".$data->getStatus()."' WHERE id =".$data->getId());
        }
        else if($data->getQr_ExDate()==null)
        {

            //to filter if the password is changed
            if($data->getPassword()==null)
            {
                $address = mysqli_real_escape_string($conn,$data->getAddress());
                mysqli_query($conn,"UPDATE guardiantb set username ='".$data->getUsername()."', firstname ='". $data->getFirstname()
                ."', lastname ='".$data->getLastname(). "', address ='". $address. "',contact_number ='". $data->getContact_number(). "', studentId = '". $data->getStudentId(). 
                "', imageName = '".$data->getImageName()."' where id = ". $data->getId());
            }
            else
            {
                $address = mysqli_real_escape_string($conn,$data->getAddress());
                mysqli_query($conn,"UPDATE guardiantb set username ='".$data->getUsername()."', password ='".$data->getPassword()."', firstname ='". $data->getFirstname()
                ."', lastname ='".$data->getLastname(). "', address ='". $address. "',contact_number ='". $data->getContact_number(). "', studentId = '". $data->getStudentId(). 
                "', imageName = '".$data->getImageName()."' where id = ". $data->getId());
            }
        


        }
        else
        {
            mysqli_query($conn,"UPDATE guardiantb set qr_ExDate ='".$data->getQr_ExDate()."' where username = '".$data->getUsername()."'");
        }

    }

    function DeleteAccountGuardian($conn,$data)
    {
        mysqli_query($conn,"DELETE from guardiantb where id = ".$data->getId());
    }

?>