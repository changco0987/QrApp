<?php
    include_once 'connection.php';
    include_once '../model/studentModel.php';

    $student = new studentModel();
    function CreateStudent($conn,$student)
    {
        $address = mysqli_real_escape_string($conn,$student->getAddress());
        mysqli_query($conn,"INSERT INTO studentstb(studentId, firstname, lastname, middlename, course, section, year, age, gender, address, contact_number, imageName, status, guardianName, guardianNum)
        values('".$student->getStudentId()."','".$student->getFirstname()."','".$student->getLastname()."','".$student->getMiddlename()."','".$student->getCourse()."','"
        .$student->getSection()."','".$student->getYear()."',".$student->getAge().",'".$student->getGender()."','".$address."','"
        .$student->getContact_number()."','".$student->getImageName()."','".$student->getStatus()."','".$student->getGuardianName()."','".$student->getGuardianNum()."')");
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
        if($student->getStatus()!=null)
        {
            mysqli_query($conn,"UPDATE studentstb set status ='".$student->getStatus()."' where id = ". $student->getId());
        }
        else
        {
            $address = mysqli_real_escape_string($conn,$student->getAddress());
            mysqli_query($conn,"UPDATE studentstb set studentId = '".$student->getStudentId()."', firstname = '".$student->getFirstname()."', lastname = '".$student->getLastname().
            "', middlename = '".$student->getMiddlename()."', course = '".$student->getCourse()."', section = '".$student->getSection()."', year = '".$student->getYear().
            "', age = ".$student->getAge().", gender = '".$student->getGender()."', address = '".$address."', imageName = '".$student->getImageName().
            "', guardianName = '".$student->getGuardianName()."', guardianNum = '".$student->getGuardianNum()."' where id = ". $student->getId());
        }
    }

    function DeleteStudent($conn,$student)
    {
        mysqli_query($conn,"DELETE from studentstb where id = ".$student->getId());
    }

?>