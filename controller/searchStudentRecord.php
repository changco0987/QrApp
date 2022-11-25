<?php
    include_once '../db/connection.php';
    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';

    include_once '../db/tb_dtr.php';
    include_once '../model/dtrModel.php';
    
    $search = $_GET['search'];
  
    $student = new studentModel();
    $dtr = new dtrModel();

    $dtrData = ReadDtr($conn,$dtr);
    $rowCount = 1;
    $changeColor = 0;//This is to change the color

    $findings = "";
    while($dtrRow = mysqli_fetch_assoc($dtrData))
    {
        if($dtrRow['accType'] == 'student')
        {
            
            $student->setId($dtrRow['dataId']);
            $result = ReadStudent($conn,$student);
            while($row = mysqli_fetch_assoc($result))
            {
                if(strtolower($row['firstname']) == strtolower($search) ||
                    str_contains(strtolower($row['firstname']),strtolower($search)))
                {

                    if($changeColor==0)
                    {
                        $findings = $findings. "<tr style='background-color:#82B7DC;'>";
                        
                        $changeColor++;
                    }                   
                    else if($changeColor==1)
                    {
                        $findings = $findings. "<tr style='background-color:#6aa9d5;'>";
                        
                        $changeColor=0;
                    }
                        $findings = $findings. "<td>$rowCount</td>".
                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                            "<td>".$dtrRow['temperature']."</td>".
                            "<td>".$dtrRow['time_in']."</td>".
                            "<td>".$dtrRow['time_out']."</td>".
                        "</tr>";
                        $rowCount++;
                }
                else if(strtolower($row['lastname']) == strtolower($search) ||
                    str_contains(strtolower($row['lastname']),strtolower($search)))
                {

                    if($changeColor==0)
                    {
                        $findings = $findings. "<tr style='background-color:#82B7DC;'>";
                        
                        $changeColor++;
                    }                   
                    else if($changeColor==1)
                    {
                        $findings = $findings. "<tr style='background-color:#6aa9d5;'>";
                        
                        $changeColor=0;
                    }
                        $findings = $findings. "<td>$rowCount</td>".
                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                            "<td>".$dtrRow['temperature']."</td>".
                            "<td>".$dtrRow['time_in']."</td>".
                            "<td>".$dtrRow['time_out']."</td>".
                        "</tr>";
                        $rowCount++;
                }

            }
        }
    }

    $response = $findings;
    echo $response;

       
    

?>