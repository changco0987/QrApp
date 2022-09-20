<?php
    include_once 'connection.php';
    include_once '../model/studentModel.php';

    $student = new studentModel();
    function CreateStudent($conn,$student)
    {
        $address = mysqli_real_escape_string($conn,$student->getAddress());
        mysqli_query($conn,"INSERT INTO studentstb(studentId, firstname, lastname, course, section, year, age, gender, address, imageName, status)
        values('".$student->getStudentId()."','".$student->getFirstname()."','".$student->getLastname()."','".$student->getCourse()."','"
        .$student->getSection()."','".$student->getYear()."',".$student->getAge().",'".$student->getGender()."','".$address."','"
        .$student->getImageName()."','".$student->getStatus()."')");
    }

    function ReadStudent($conn,$student)
    {
        if($student->getId()==null)
        {
            $dbData = mysqli_query($conn,"SELECT * FROM studentstb");
        }
        else
        {
            $dbData = mysqli_query($conn,"SELECT * FROM studentstb where id = ".$student->getId());
        }

        return $dbData;
    }

    function UpdateStudent($conn,$student)
    {
        $address = mysqli_real_escape_string($conn,$student->getAddress());
        if($student->getQr_ExDate()==null)
        {
            mysqli_query($conn,"UPDATE studentstb set studentId = '".$student->getStudentId()."', firstname = '".$student->getFirstname()."', lastname = '".$student->getLastname().
            "', course = '".$student->getCourse()."', section = '".$student->getSection()."', year = '".$student->getYear()."', age = ".$student->getAge().", gender = '".$student->getGender().
            "', address = '".$address."', imageName = '".$student->getImageName()."', status = '".$student->getStatus()."' where id = ". $student->getId());
        }
        else
        {
            mysqli_query($conn,"UPDATE studentstb set qr_ExDate ='".$student->getQr_ExDate()."' where id = ". $student->getId());
        }
    }

    function DeleteStudent($conn,$student)
    {
        mysqli_query($conn,"DELETE from studentstb where id = ".$student->getId());
    }

?>