<?php
    include_once '../db/connection.php';
    include_once '../db/tb_student.php';
    include_once '../model/studentModel.php';

    $event = new studentModel();
    $event->setId($_POST['idTb']);
    $result = ReadStudent($conn,$event);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Bootstrap icon--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <!-- QR code javascript -->
    <script src="../javascript/qrcode.min.js"></script>

    <!-- My CSS-->
    <link type="text/css" rel="stylesheet" href="../css/userDashboard.css">
    <style>
        .container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
        }
        
        #adminTitle{
            font-weight: bolder;
            color: #3466AA;
            text-shadow: 1px 1px #1C1C1C;
        }
        label{
            color: #3466AA;
        }
        #submitBtn{
            color: #F1F1F1;
            background-color: #3466AA;
        }
        label{
        font-size: 12px;
        color: #234471;
        font-weight: bolder;
        }
    </style>

    <link rel="icon" href="asset/qr.png">
    <title>Entrance Monitoring sys - Dashboard</title>
</head>
<body>
        
    <!-- Alert message container-->
    <div id="successBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:block;">
        <strong id="successMsg"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                <div class=" d-flex justify-content-center h-100">
                <form action="../controller/editStudent.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="idTb" name="idTb" value="<?php echo $row['id'];?>">
                    <center>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <?php
                                if($row['imageName']==null)
                                {
                                    ?>
                                        <img src="../asset/user.png" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 50%;" id="userImg">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <img src="../upload/students/<?php echo $row['imageName'];?>" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 50%;" id="userImg">
                                    <?php
                                }
                              ?>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <div class="custom-file" style="width:fit-content;">
                                  <input type="file" accept=".jpg, .png, .jpeg" class="custom-file-input" id="fileTb" name="fileTb">
                                  <label class="custom-file-label text-left mt-2 pt-2" for="fileTb">Upload Photo</label>
                              </div>
                            </div>
                        </div>
                    </div>
                    </center>
                    <!-- Student Personal Info -->
                    <div class="mx-2 px-2" style="background-color: #f9f9f9; border-radius:10px;">
                      <div class="form-group">
                          <div class="row">
                              <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                  <label class="d-flex align-items-start" for="fnameTb">First name</label>
                                  <input type="text" class="form-control no-border form-control-sm" id="fnameTb" name="fnameTb" placeholder="Ex. Marie" maxlength="50" required value="<?php echo $row['firstname'];?>">
                              </div>
                              <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="lnameTb">Middle name</label> 
                                  <input type="text" class="form-control form-control-sm" id="mnameTb" name="mnameTb" placeholder="Ex. Jimenez" maxlength="50" required value="<?php echo $row['middlename'];?>">
                              </div>
                              <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                  <label class="d-flex align-items-start" for="lnameTb">Last name</label> 
                                  <input type="text" class="form-control form-control-sm" id="lnameTb" name="lnameTb" placeholder="Ex. Cruz" maxlength="50" required value="<?php echo $row['lastname'];?>">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                <?php 
                                    //This is to identify the user data gender 
                                    if($row['gender']=='male')
                                    {
                                        ?>
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                    <label for="">Gender</label>
                                                </div>
                                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="genderRb" id="maleRadio" value="Male" checked>
                                                        <label class="form-check-label" for="maleRadio">
                                                            male
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="genderRb" id="femaleRadio" value="Female">
                                                        <label class="form-check-label" for="femaleRadio">
                                                            female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                    <label for="">Gender</label>
                                                </div>
                                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="genderRb" id="maleRadio" value="Male">
                                                        <label class="form-check-label" for="maleRadio">
                                                            male
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="genderRb" id="femaleRadio" value="Female" checked>
                                                        <label class="form-check-label" for="femaleRadio">
                                                            female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                ?>
                                  
                              </div>
                              <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                  <label class="d-flex align-items-start" for="ageTb">Age</label> 
                                  <input type="number" class="form-control form-control-sm" id="ageTb" name="ageTb" placeholder="Ex. 21" required value="<?php echo $row['age'];?>">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="row pb-2">
                          <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contactNumTb">Address</label>
                              <input type="text" class="form-control form-control-sm" id="addressTb" name="addressTb" placeholder="Ex. 2123 home st." maxlength="100" required value="<?php echo $row['address'];?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row pb-2">
                          <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contactNumTb">Contact Number</label>
                              <input type="number" class="form-control form-control-sm" id="contactNumTb" name="contactNumTb" placeholder="Ex. 092X-XXX-XXXX" minlength="11" maxlength="11" required value="<?php echo $row['contact_number'];?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Guardian Info -->
                    <div class="mx-2 px-2" style="background-color: #f9f9f9; border-radius:10px;">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contentTb">Guardian Name</label>
                              <input type="text" class="form-control form-control-sm" id="guardianNameTb" name="guardianNameTb" placeholder="Ex. Joselita C. Jimenez" maxlength="100" required value="<?php echo $row['guardianName'];?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row pb-2">
                          <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contentTb">Guardian Number</label>
                              <input type="number" class="form-control form-control-sm" id="guardianNumTb" name="guardianNumTb" placeholder="Ex. 092X-XXX-XXXX" minlength="11" maxlength="11" required value="<?php echo $row['guardianNum'];?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Student School Info -->
                    <div class="mx-2 px-2" style="background-color: #f9f9f9; border-radius:10px;">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contentTb">Student ID</label>
                              <input type="text" class="form-control form-control-sm" id="studentIdTb" name="studentIdTb" placeholder="Ex. 012-3456-7890" maxlength="50" required value="<?php echo $row['studentId'];?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="row pb-2">
                              <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="courseTb">Course</label>
                                  <input type="text" class="form-control no-border form-control-sm" id="courseTb" name="courseTb" placeholder="Ex. BSIT" maxlength="50" required value="<?php echo $row['course'];?>">
                              </div>
                              <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="sectionTb">Section</label> 
                                  <input type="text" class="form-control form-control-sm" id="sectionTb" name="sectionTb" placeholder="Ex. ICT101" maxlength="20" required value="<?php echo $row['section'];?>">
                              </div>
                              <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="yearTb">Year Level</label> 
                                  <input type="text" class="form-control form-control-sm" id="yearTb" name="yearTb" placeholder="Ex. 1st" maxlength="20" required value="<?php echo $row['year'];?>">
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="button" class="btn btn-warning" href="../admin/admin_students.php">Cancel</a>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>





</body>
<!--alert message script-->
<script>
        document.getElementById('successBox').style.display = 'none';
        var successSignal = localStorage.getItem('state');
/*
        if(successSignal==1)
        {
            //if password or username is incorrect
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('successMsg').innerHTML = "Username or password is incorrect";
            console.log("okay");

        }
        else if(successSignal==2)
        {
            //if password doesn't matched
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('successMsg').innerHTML = "This username doesn't exist";
            console.log("okay");
        }
        else if(successSignal==3)
        {
            //if password doesn't matched
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('successMsg').innerHTML = "Information Successfully saved!";
            console.log("okay");
        }
        else if(successSignal==4)
        {
            //if password doesn't matched
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('successMsg').innerHTML = "Information Successfully saved!";
            console.log("okay");
        }
*/
        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        localStorage.setItem('state',0);

        //this will make a image preview before it was uploaded
        fileTb.onchange = evt => {
        const [file] = fileTb.files
        if (file) {
            userImg.src = URL.createObjectURL(file)
        }
        }
    </script>
</html>