<?php
    include_once '../db/connection.php';
    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';
    

    
    $search = $_GET['search'];
  
    $student = new studentModel();
    
    $result = ReadStudent($conn,$student);
    $findings = "";
    $count = 1;
    while($row = mysqli_fetch_assoc($result))
    {
        $prevQRData = array("title"=>'qremsystem', "accType"=>'student', "id"=>$row['id']);
        $convertedQRData = base64_encode(serialize($prevQRData));
        if(strtolower($row['firstname']) == strtolower($search) ||
            str_contains(strtolower($row['firstname']),strtolower($search)))
        {
            if($row['imageName']!==null && $row['imageName']!=='')
            {
                if($row['status']=='locked')
                {
                  
                   $findings = $findings. "<tr style='background-color:#e9808d;'>";
                  
                }
                else
                {
                  
                    $findings = $findings. "<tr style='background-color:#82B7DC;'>";
                  
                }

                $findings = $findings.      "<td>".$count."</td>".
                                            "<td><img src='../upload/students/". $row['imageName']."' width='60' height='60' class='d-inline-block align-top border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                            "<td>".$row['studentId']."</td>".
                                            "<td>".$row['course']." - ".$row['section']." - ".$row['year']."</td>".
                                            "<td>".$row['gender']."</td>".
                                            "<td>".$row['contact_number']."</td>".
                                            "<td>".$row['address']."</td>".
                                            "<td>".$row['guardianName']."</td>".
                                            "<td>".$row['guardianNum']."</td>".
                                            "<td>".$row['school']."</td>".
                                            "<td id='".$row['id']."'>".
                                                "<button type='button' class='btn btn-sm d-flex justify-content-start' style='background-color:#3466AA; color:white; font-size: 13px;' id='".$convertedQRData."' onclick='generateQRCode(this.id); window.print();'><i class='bi bi-printer-fill mr-1'></i>Print QR</button>".
                                            "</td>";

              
            }
            else
            {
                
                $findings = $findings.      "<td>".$count."</td>".
                                            "<td><img src='../asset/user.png' width='60' height='60' class='d-inline-block align-top img-fluid border border-dark' alt='' style='border-radius: 50%;'><</td>".
                                            
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                            "<td>".$row['studentId']."</td>".
                                            "<td>".$row['course']." - ".$row['section']." - ".$row['year']."</td>".
                                            "<td>".$row['gender']."</td>".
                                            "<td>".$row['contact_number']."</td>".
                                            "<td>".$row['address']."</td>".
                                            "<td>".$row['guardianName']."</td>".
                                            "<td>".$row['guardianNum']."</td>".
                                            "<td>".$row['school']."</td>".
                                            "<td id='".$row['id']."'>".
                                                "<button type='button' class='btn btn-sm d-flex justify-content-start' style='background-color:#3466AA; color:white; font-size: 13px;' id='".$convertedQRData."' onclick='generateQRCode(this.id); window.print();'><i class='bi bi-printer-fill mr-1'></i>Print QR</button>".
                                            "</td>";

            }

            
            if($row['status']=='unlocked')
            {
                //status button -unlocked
                $findings = $findings. "<script>unlockedData++;</script>".
                                        "<td id='".$row['id']."'>".
                                            "<form action='../controller/studentStat.php' method='POST' enctype='multipart/form-data'>".
                                                "<input type='hidden' name='idTb' id='status1IdTb".$row['id']."' value='".$row['id']."'>".
                                                "<input type='hidden' name='statusTb' id='status1Tb".$row['id']."' value='locked'>".
                                                "<button type='submit' class='btn btn-sm d-flex justify-content-start' style='background-color: #ca3635; color: white; font-size: 13px;'><i class='bi bi-lock-fill mr-1'></i>Lock</button>".
                                            "</form>".
                                        "</td>".
                                        //Edit Button
                                        "<td id='".$row['id']."'>".
                                          "<form action='../admin/editStudent.php' method='POST' enctype='multipart/form-data'>".
                                            "<input type='hidden' name='idTb' id='editIdTb".$row['id']."' value='".$row['id']."'>".
                                            "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-warning' name='submitEdit' style='font-size: 13px;'><i class='bi bi-pencil-square mr-1'></i>Edit</button>".
                                          "</form>".
                                        "</td>".
            
                                        //Delete Button
                                        "<td id='".$row['id']."'>".
                                          "<form action='../controller/deleteStudent.php' method='POST' enctype='multipart/form-data'>".
                                            "<input type='hidden' name='idTb' id="."deleteIdTb".$row['id']."' value'=".$row['id']."'>".
                                            "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-danger' style='font-size: 13px;'><i class='bi bi-trash mr-1'></i>Delete</button>".
                                          "</form>".
                                        "</td>".
                                    "</tr>";
                

            } 
            else
            {
                //status button -locked
                $findings = $findings. "<script>lockedData++;</script>".
                                        "<td id='".$row['id']."'>".
                                            "<form action='../controller/studentStat.php' method='POST' enctype='multipart/form-data'>".
                                                "<input type='hidden' name='idTb' id='status1IdTb".$row['id']."' value='".$row['id']."'>".
                                                "<input type='hidden' name='statusTb' id='status1Tb".$row['id']."' value='unlocked'>".
                                                "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-success' style='font-size: 13px;'><i class='bi bi-unlock-fill mr-1'></i>Unlock</button>".
                                            "</form>".
                                        "</td>".
                                        //Edit Button
                                        "<td id='".$row['id']."'>".
                                          "<form action='../admin/editStudent.php' method='POST' enctype='multipart/form-data'>".
                                            "<input type='hidden' name='idTb' id='editIdTb".$row['id']."' value='".$row['id']."'>".
                                            "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-warning' name='submitEdit' style='font-size: 13px;'><i class='bi bi-pencil-square mr-1'></i>Edit</button>".
                                          "</form>".
                                        "</td>".
            
                                        //Delete Button
                                        "<td id='".$row['id']."'>".
                                          "<form action='../controller/deleteStudent.php' method='POST' enctype='multipart/form-data'>".
                                            "<input type='hidden' name='idTb' id="."deleteIdTb".$row['id']." value=".$row['id'].">".
                                            "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-danger' style='font-size: 13px;'><i class='bi bi-trash mr-1'></i>Delete</button>".
                                          "</form>".
                                        "</td>".
                                    "</tr>";
     
            }
            $count++;
        }
        else if(strtolower($row['lastname']) == strtolower($search) ||
            str_contains(strtolower($row['lastname']),strtolower($search)))
        {
            if($row['imageName']!==null && $row['imageName']!=='')
            {
                if($row['status']=='locked')
                {
                  
                   $findings = $findings. "<tr style='background-color:#e9808d;'>";
                  
                }
                else
                {
                  
                    $findings = $findings. "<tr style='background-color:#82B7DC;'>";
                  
                }
                $findings = $findings.      "<td>".$count."</td>".
                                            "<td><img src='../upload/students/". $row['imageName']."' width='60' height='60' class='d-inline-block align-top border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                            "<td>".$row['studentId']."</td>".
                                            "<td>".$row['course']." - ".$row['section']." - ".$row['year']."</td>".
                                            "<td>".$row['gender']."</td>".
                                            "<td>".$row['contact_number']."</td>".
                                            "<td>".$row['address']."</td>".
                                            "<td>".$row['guardianName']."</td>".
                                            "<td>".$row['guardianNum']."</td>".
                                            "<td>".$row['school']."</td>".
                                            "<td id='".$row['id']."'>".
                                                "<button type='button' class='btn btn-sm d-flex justify-content-start' style='background-color:#3466AA; color:white; font-size: 13px;' id='".$convertedQRData."' onclick='generateQRCode(this.id); window.print();'><i class='bi bi-printer-fill mr-1'></i>Print QR</button>".
                                            "</td>";

              
            }
            else
            {
                
                $findings = $findings.      "<td>".$count."</td>".
                                            "<td><img src='../asset/user.png' width='60' height='60' class='d-inline-block align-top img-fluid border border-dark' alt='' style='border-radius: 50%;'><</td>".
                                            
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                            "<td>".$row['studentId']."</td>".
                                            "<td>".$row['course']." - ".$row['section']." - ".$row['year']."</td>".
                                            "<td>".$row['gender']."</td>".
                                            "<td>".$row['contact_number']."</td>".
                                            "<td>".$row['address']."</td>".
                                            "<td>".$row['guardianName']."</td>".
                                            "<td>".$row['guardianNum']."</td>".
                                            "<td>".$row['school']."</td>".
                                            "<td id='".$row['id']."'>".
                                                "<button type='button' class='btn btn-sm d-flex justify-content-start' style='background-color:#3466AA; color:white; font-size: 13px;' id='".$convertedQRData."' onclick='generateQRCode(this.id); window.print();'><i class='bi bi-printer-fill mr-1'></i>Print QR</button>".
                                            "</td>";

            }

            
            if($row['status']=='unlocked')
            {
                //status button -unlocked
                $findings = $findings. "<script>unlockedData++;</script>".
                                        "<td id=".$row['id'].">".
                                            "<form action='../controller/studentStat.php' method='POST' enctype='multipart/form-data'>".
                                                "<input type='hidden' name='idTb' id='status1IdTb".$row['id']."' 'value=".$row['id']."'>".
                                                "<input type='hidden' name='statusTb' id='status1Tb".$row['id']."' value='locked'>".
                                                "<button type='submit' class='btn btn-sm d-flex justify-content-start' style='background-color: #ca3635; color: white; font-size: 13px;'><i class='bi bi-lock-fill mr-1'></i>Lock</button>".
                                            "</form>".
                                        "</td>".
                                        //Edit Button
                                        "<td id=".$row['id'].">".
                                          "<form action='../admin/editStudent.php' method='POST' enctype='multipart/form-data'>".
                                            "<input type='hidden' name='idTb' id='editIdTb".$row['id']."' value='".$row['id']."'>".
                                            "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-warning' name='submitEdit' style='font-size: 13px;'><i class='bi bi-pencil-square mr-1'></i>Edit</button>".
                                          "</form>".
                                        "</td>".
            
                                        //Delete Button
                                        "<td id=".$row['id'].">".
                                          "<form action='../controller/deleteStudent.php' method='POST' enctype='multipart/form-data'>".
                                            "<input type='hidden' name='idTb' id='deleteIdTb".$row['id']."' value='".$row['id']."'>".
                                            "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-danger' style='font-size: 13px;'><i class='bi bi-trash mr-1'></i>Delete</button>".
                                          "</form>".
                                        "</td>".
                                    "</tr>";
                

            } 
            else
            {
                //status button -locked
                $findings = $findings. "<script>lockedData++;</script>".
                                        "<td id=".$row['id'].">".
                                            "<form action='../controller/studentStat.php' method='POST' enctype='multipart/form-data'>".
                                                "<input type='hidden' name='idTb' id='status1IdTb".$row['id']."' value='".$row['id']."'>".
                                                "<input type='hidden' name='statusTb' id='status1Tb".$row['id']."' value='unlocked'>".
                                                "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-success' style='font-size: 13px;'><i class='bi bi-unlock-fill mr-1'></i>Unlock</button>".
                                            "</form>".
                                        "</td>".
                                        //Edit Button
                                        "<td id=".$row['id'].">".
                                          "<form action='../admin/editStudent.php' method='POST' enctype='multipart/form-data'>".
                                            "<input type='hidden' name='idTb' id='editIdTb".$row['id']."' value='".$row['id']."'>".
                                            "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-warning' name='submitEdit' style='font-size: 13px;'><i class='bi bi-pencil-square mr-1'></i>Edit</button>".
                                          "</form>".
                                        "</td>".
            
                                        //Delete Button
                                        "<td id=".$row['id'].">".
                                          "<form action='../controller/deleteStudent.php' method='POST' enctype='multipart/form-data'>".
                                            "<input type='hidden' name='idTb' id='deleteIdTb".$row['id']."' value='".$row['id']."'>".
                                            "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-danger' style='font-size: 13px;'><i class='bi bi-trash mr-1'></i>Delete</button>".
                                          "</form>".
                                        "</td>".
                                    "</tr>";
     
            }
            $count++;
        }
    }

    $response = $findings;
    echo $response;

       
    

?>