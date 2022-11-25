<?php
    include_once '../db/connection.php';
    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';
    

    
    $search = $_GET['search'];
  
    $data = new visitorModel();
    
    $result = ReadAccountVisitor($conn,$data);
    $findings = "";
    $count = 1;
    while($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['firstname']) == strtolower($search) ||
            str_contains(strtolower($row['firstname']),strtolower($search)))
        {
            if($row['status']=='lock')
            {
              
                $findings = $findings. "<tr style='background-color:#e9808d;'>";
              
            }
            else
            {
              
                $findings = $findings. "<tr style='background-color:#82B7DC;'>";
              
            }

            if($row['imageName']!==null && $row['imageName']!=='')
            {

                $findings = $findings.      "<td>".$count."</td>".
                                            "<td><img src='../upload/". $row['imageName']."' width='60' height='60' class='d-inline-block align-top border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                            "<td>".$row['username']."</td>".
                                            "<td>".$row['address']."</td>".
                                            "<td>".$row['contact_number']."</td>".
                                            "<td>".$row['status']."</td>";

              
            }
            else
            {
                
                $findings = $findings.      "<td>".$count."</td>".
                                            "<td><img src='../asset/user.png' width='60' height='60' class='d-inline-block align-top img-fluid border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                            "<td>".$row['username']."</td>".
                                            "<td>".$row['address']."</td>".
                                            "<td>".$row['contact_number']."</td>".
                                            "<td>".$row['status']."</td>";

            }

            
            if($row['status']=='unlock')
            {
                //status button -unlocked
                $findings = $findings. "<script>unlockedData++;</script>".
                                        "<td id='".$row['id']."'>".
                                            "<form action='../controller/accountStat.php' method='POST' enctype='multipart/form-data'>".
                                                "<input type='hidden' name='accType' id='accType' value='visitor'>".
                                                "<input type='hidden' name='idTb' id='status1IdTb".$row['id']."' value='".$row['id']."'>".
                                                "<input type='hidden' name='statusTb' id='status1Tb".$row['id']."' value='lock'>".
                                                "<button type='submit' class='btn btn-sm d-flex justify-content-start' style='background-color: #ca3635; color: white; font-size: 13px;'><i class='bi bi-lock-fill mr-1'></i>Lock</button>".
                                            "</form>".
                                        "</td>";
                

            } 
            else
            {
                //status button -locked
                $findings = $findings. "<script>lockedData++;</script>".
                                        "<td id='".$row['id']."'>".
                                            "<form action='../controller/accountStat.php' method='POST' enctype='multipart/form-data'>".
                                                "<input type='hidden' name='accType' id='accType' value='visitor'>".
                                                "<input type='hidden' name='idTb' id='status1IdTb".$row['id']."' value='".$row['id']."'>".
                                                "<input type='hidden' name='statusTb' id='status1Tb".$row['id']."' value='unlock'>".
                                                "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-success' style='font-size: 13px;'><i class='bi bi-unlock-fill mr-1'></i>Unlock</button>".
                                            "</form>".
                                        "</td>";
     
            }

                                    //Edit Button
            $findings = $findings . "<td id='".$row['id']."'>".
                                    "<form action='../admin/editVisitor.php' method='POST' enctype='multipart/form-data'>".
                                        "<input type='hidden' name='accType' id='accType' value='guardian'>".
                                        "<input type='hidden' name='usernameTb' id='editIdTb".$row['username']."' value='". $row['username']."'>".
                                        "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-warning' name='submitEdit' style='font-size: 13px;'><i class='bi bi-pencil-square mr-1'></i>Edit</button>".
                                    "</form>".
                                    "</td>".

                                    //Delete Button
                                    "<td id='".$row['id']."'>".
                                    "<form action='../controller/deleteAccount.php' method='POST' enctype='multipart/form-data'>".
                                        "<input type='hidden' name='accType' id='accType' value='visitor'>".
                                        "<input type='hidden' name='idTb' id="."deleteIdTb".$row['id']." value=".$row['id'].">".
                                        "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-danger' style='font-size: 13px;'><i class='bi bi-trash mr-1'></i>Delete</button>".
                                    "</form>".
                                    "</td>".
                                "</tr>";
            $count++;
        }
        else if(strtolower($row['lastname']) == strtolower($search) ||
            str_contains(strtolower($row['lastname']),strtolower($search)))
        {
            if($row['status']=='lock')
            {
              
                $findings = $findings. "<tr style='background-color:#e9808d;'>";
              
            }
            else
            {
              
                $findings = $findings. "<tr style='background-color:#82B7DC;'>";
              
            }

            if($row['imageName']!==null && $row['imageName']!=='')
            {

                $findings = $findings.      "<td>".$count."</td>".
                                            "<td><img src='../upload/". $row['imageName']."' width='60' height='60' class='d-inline-block align-top border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                            "<td>".$row['username']."</td>".
                                            "<td>".$row['address']."</td>".
                                            "<td>".$row['contact_number']."</td>".
                                            "<td>".$row['status']."</td>";

              
            }
            else
            {
                
                $findings = $findings.      "<td>".$count."</td>".
                                            "<td><img src='../asset/user.png' width='60' height='60' class='d-inline-block align-top img-fluid border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                            "<td>".$row['username']."</td>".
                                            "<td>".$row['address']."</td>".
                                            "<td>".$row['contact_number']."</td>".
                                            "<td>".$row['status']."</td>";

            }

            
            if($row['status']=='unlock')
            {
                //status button -unlocked
                $findings = $findings. "<script>unlockedData++;</script>".
                                        "<td id='".$row['id']."'>".
                                            "<form action='../controller/accountStat.php' method='POST' enctype='multipart/form-data'>".
                                                "<input type='hidden' name='accType' id='accType' value='visitor'>".
                                                "<input type='hidden' name='idTb' id='status1IdTb".$row['id']."' value='".$row['id']."'>".
                                                "<input type='hidden' name='statusTb' id='status1Tb".$row['id']."' value='lock'>".
                                                "<button type='submit' class='btn btn-sm d-flex justify-content-start' style='background-color: #ca3635; color: white; font-size: 13px;'><i class='bi bi-lock-fill mr-1'></i>Lock</button>".
                                            "</form>".
                                        "</td>";
                

            } 
            else
            {
                //status button -locked
                $findings = $findings. "<script>lockedData++;</script>".
                                        "<td id='".$row['id']."'>".
                                            "<form action='../controller/accountStat.php' method='POST' enctype='multipart/form-data'>".
                                                "<input type='hidden' name='accType' id='accType' value='visitor'>".
                                                "<input type='hidden' name='idTb' id='status1IdTb".$row['id']."' value='".$row['id']."'>".
                                                "<input type='hidden' name='statusTb' id='status1Tb".$row['id']."' value='unlock'>".
                                                "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-success' style='font-size: 13px;'><i class='bi bi-unlock-fill mr-1'></i>Unlock</button>".
                                            "</form>".
                                        "</td>";
     
            }

                                    //Edit Button
            $findings = $findings . "<td id='".$row['id']."'>".
                                    "<form action='../admin/editVisitor.php' method='POST' enctype='multipart/form-data'>".
                                        "<input type='hidden' name='accType' id='accType' value='visitor'>".
                                        "<input type='hidden' name='usernameTb' id='editIdTb".$row['username']."' value='". $row['username']."'>".
                                        "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-warning' name='submitEdit' style='font-size: 13px;'><i class='bi bi-pencil-square mr-1'></i>Edit</button>".
                                    "</form>".
                                    "</td>".

                                    //Delete Button
                                    "<td id='".$row['id']."'>".
                                    "<form action='../controller/deleteAccount.php' method='POST' enctype='multipart/form-data'>".
                                        "<input type='hidden' name='accType' id='accType' value='visitor'>".
                                        "<input type='hidden' name='idTb' id="."deleteIdTb".$row['id']." value=".$row['id'].">".
                                        "<button type='submit' class='btn btn-sm d-flex justify-content-start btn-danger' style='font-size: 13px;'><i class='bi bi-trash mr-1'></i>Delete</button>".
                                    "</form>".
                                    "</td>".
                                "</tr>";
            $count++;
        }
    }

    $response = $findings;
    echo $response;

       
    

?>