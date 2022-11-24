<?php
    include_once '../db/connection.php';

    include_once '../model/adminModel.php';
    include_once '../db/tb_admin.php';

    include_once '../model/visitorModel.php';
    include_once '../db/tb_visitor.php';

    include_once '../model/dtrModel.php';
    include_once '../db/tb_dtr.php';

    include_once '../model/qrsettingsModel.php';
    include_once '../db/tb_qrsettings.php';
    //This will check if the user is truely login
    session_start();
    if(!isset($_SESSION['adminNameTb']))
    {
        header("Location: ../admin.php");
    }
    /*
    date_default_timezone_set('Asia/Manila');

    $row = array();

    if($_SESSION['accType'] == 'visitor')
    {
        $data = new visitorModel();
        $data->setUsername($_SESSION['username']);

        $result = ReadAccountVisitor($conn,$data);
        $row =  mysqli_fetch_assoc($result);
    }
    else if($_SESSION['accType'] == 'guardian')
    {
        $data = new guardianModel();
        $data->setUsername($_SESSION['username']);
        
        $result = ReadAccountGuardian($conn,$data);
        $row =  mysqli_fetch_assoc($result);
    }
    
    date_default_timezone_set('Asia/Manila');
    */
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
    
    <!--Chart.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js" integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA==" crossorigin="anonymous"></script>
    
    <!--My CSS and JS-->
    <!--link type="text/css" rel="stylesheet" href="../css/index.css"/-->
    <script src="../javascript/linked.js"></script>
    <!-- Custom fonts for this template-->
    <link rel="icon" href="../asset/qr.png">
    <title>Admin Dashboard</title>
<style>
body {
  background-color: #e1eeff;
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #3466AA;
  position: fixed;
  height: 100%;
  overflow: auto;
}

#adminTitle{
  font-weight: bolder;
  color: #82B7DC;
  text-shadow: 1px 1px #1C1C1C;
}

#pageTitle{
  font-weight: bold;
  color: #F1F1F1;
  text-shadow: 1px 1px #1C1C1C;
}

#btnLabel{
  font-weight: bold;
  color: #1C1C1C;
  text-shadow: 1px 1px #F1F1F1;
}

.sidebar a {
  display: block;
  color: #F1F1F1;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #114084;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #82B7DC;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

label{
  font-size: 12px;
  color: #234471;
  font-weight: bolder;
}

#collapseUtilities, #collapseMaintenance, #collapseHealthRecord{
  background-color:#234471 ;
}

.collapseBtn{
  color:whitesmoke;
  background-color: #3466AA;
  width: 150px;
}
.collapseBtn:hover {
  background-color:#114084;
}
  
#qrcode{
  position: absolute;
  z-index: -2%;
  visibility: hidden;
}
@media print{
    body * {
        visibility: hidden;
    }
    #qrcode * {
        visibility: visible;
        width: 800px;
        height: 800px;
    }
}

th{
  border: 1px solid #d9d9d9;
  font-size: 14px;
}
td{
  font-size: 13px;
}

#genderTitle {
  background-image: linear-gradient(#b6d1fa, #fcb1c1);
  border-radius: 10px; 
  box-shadow: -1px 1px 20px 6px #d9d9d9; 
  color:whitesmoke; 
  height:max-content;
  text-shadow: 1px 1px black;
}

#maleContainer {
  background-color: #b6d1fa; 
  border-radius: 10px; 
  box-shadow: -1px 1px 20px 6px #d9d9d9; 
  color: rgb(54, 162, 235); 
  height: 130px;
  text-shadow: 1px 1px black;
}

#femaleContainer {
  background-color: #fcb1c1; 
  border-radius: 10px; 
  box-shadow: -1px 1px 20px 6px #d9d9d9; 
  color: rgb(255, 99, 132); 
  height: 130px;
  text-shadow: 1px 1px black;
}

#genderContainer {
  background-color: whitesmoke;
  border-radius: 10px; 
  box-shadow: -1px 1px 20px 6px #d9d9d9; 
  color: rgb(54, 162, 235); 
  text-shadow: 1px 1px black;
  height: 272px;
}

#activeStudHead {
  background-color: #114084;
  border-radius: 10px; 
  box-shadow: -1px 1px 20px 6px #d9d9d9; 
  color: #97bdf0;
  height: 130px;
  text-shadow: 1px 1px #d2e1fa;
  font-weight:bolder;
}

#insideHead {
  background-color: #97bdf0; 
  border-radius: 10px; 
  box-shadow: -1px 1px 20px 6px #d9d9d9; 
  color:#114084; 
  height: 78px;
  text-shadow: 1px 1px black;
  font-weight:bolder;
}
      
</style>

  <script>
    var studentName = "";

    var male = 0;
    var female = 0;

    var lockedData = 0;
    var unlockedData = 0;

    var inside = 0;
    var outside = 0;
    //The qr generator function
    var qrcode = undefined;
    function generateQRCode(value)
    {
        if(qrcode === undefined)
        {
            qrcode = new QRCode(document.getElementById('qrcode'), value);
            console.log(value);
        }
        else
        {
            qrcode.clear();
            qrcode.makeCode(value);
        }
    }

  </script>

</head>
<body>
          
<!-- Alert message container-->
<div id="successBox" class="alert alert-success alert-dismissible fade show" role="alert" style="position:absolute; display:none; z-index: 1;">
    <strong id="successMsg"></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
    
<!-- Alert message container-->
<div id="failBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute; display:none; z-index: 1;">
    <strong id="failMsg"></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<div class="sidebar">
  <h3 class="d-flex justify-content-center mx-auto px-auto mt-2 pt-1" id="adminTitle">Admin Panel</h2>
  <a class="mt-1" href="dashboard.php"><i class="bi bi-megaphone-fill mr-1"></i> Announcements</a>
  <a type="button" class="mt-1" href="#maintenance" data-toggle="collapse" data-target="#collapseMaintenance" aria-expanded="true" aria-controls="collapseMaintenance"><i class="bi bi-wrench-adjustable mr-1"></i> Account Maintenance</a>
    <div id="collapseMaintenance" class="collapse my-1" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" >
        <div class="py-2 collapse-inner rounded mx-4">
            <h6 class="collapse-header" style="font-size: 13px;"></h6>

              <!--input type="hidden" name="departmentName" value=""-->
              <button type="button" onclick="gotoAdminStudent()" class="collapse-item btn btn-sm my-1 collapseBtn">Students</button><br>

              <button type="button" onclick="gotoAdminFaculty()" class="collapse-item btn btn-sm my-1 collapseBtn">Faculty/Staff</button><br>
              
              <button type="button" onclick="gotoAdminVisitor()" class="collapse-item btn btn-sm my-1 collapseBtn">Visitors</button><br>
          
              <button type="button" onclick="gotoAdminGuardian()" class="collapse-item btn btn-sm my-1 collapseBtn">Guardians</button><br>
      
        </div>
    </div>
    <!--Health Record button-->
  <a type="button" class="active mt-1" href="#healthRecord" data-toggle="collapse" data-target="#collapseHealthRecord" aria-expanded="true" aria-controls="collapseHealthRecord"><i class="bi bi-card-checklist mr-1"></i> Health Records</a>
    <div id="collapseHealthRecord" class="collapse my-1" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" >
        <div class="py-2 collapse-inner rounded mx-4">
            <h6 class="collapse-header" style="font-size: 13px;"></h6>

              <!--input type="hidden" name="departmentName" value=""-->
              <button type="button" onclick="gotoRecordStudent()" class="collapse-item btn btn-sm my-1 collapseBtn">Students</button><br>

              <button type="button" onclick="gotoRecordFaculty()" class="collapse-item btn btn-sm my-1 collapseBtn">Faculty/Staff</button><br>
              
              <button type="button" onclick="gotoRecordVisitor()" class="collapse-item btn btn-sm my-1 collapseBtn">Visitors</button><br>
          
              <button type="button" onclick="gotoRecordGuardian()" class="collapse-item btn btn-sm my-1 collapseBtn">Guardians</button><br>
      
        </div>
    </div>

  <a type="button" class=" mt-1" href="#about" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities"><i class="bi bi-tools mr-1"></i> Utilities</a>
    <div id="collapseUtilities" class="collapse my-1" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" >
        <div class="py-2 collapse-inner rounded mx-4">
            <h6 class="collapse-header" style="font-size: 13px;"></h6>
              <button type="button" onclick="gotoLogs()" class="collapse-item btn btn-sm my-1 collapseBtn">Logs</button><br>
              
              <button type="button" onclick="" class="collapse-item btn btn-sm my-1 collapseBtn" data-toggle="modal" data-target="#DevTool">Dev tool</button>
         
              <button type="button" class="collpase-item btn btn-sm my-1 collapseBtn" data-toggle="modal" data-target="#qrSett">QR Settings</button>
              <!--input type="hidden" name="departmentName" value=""-->
              <button type="submit" class="collapse-item btn btn-sm my-1 collapseBtn" data-toggle="modal" data-target="#ChangePass">Change Password</button><br>
      
        </div>
    </div>
</div>
<div class="content">
  <!--Header of the page-->
  <div class="row">
    <div class="col-sm-10 col-xs-10 col-md-10 col-lg-10 col-xl-11" style="background-color: #4e82c9;">
      <h3 class="d-flex justify-content-center mt-2 pt-1" id="pageTitle" >Health Records - Visitor</h3>
    </div>
    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 col-xl-1" style="background-color: #4e82c9;">
      <div class="w-100 d-flex justify-content-end">
          <a type="button" class="btn d-flex justify-content-start mt-2 mb-1 pt-1 btn-danger"  href="../controller/adminWipeData.php"><i class="bi bi-power mr-2"></i></span>Logout</a>
      </div>
    </div>
  </div>

  <!-- QR pass container -->
  <div class="pb-3 mb-3 pt-1 mt-1" id="qrcode"></div>

  <!--This is where the body content start-->

  <div class="row my-3 no-gutters" style="background-color:#F1F1F1; border-radius: 10px; box-shadow: -1px 1px 20px 6px #d9d9d9;">
    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-2 pl-3 pr-2 my-2 py-2">        
    <!--h6 class="pr-2" id="btnLabel">Types: </h6-->
    </div>

    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-6 pl-3 pr-1 my-2 py-2">
    </div>

    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-4 pl-3 pr-2 my-2 py-2 d-flex justify-content-end h-100 mx-auto my-auto">
      <form action="../controller/searchAccount.php" method="post" enctype="multipart/form-data">
        <div class="input-group">
          <input type="hidden" name="accType" value="visitor">
            <input type="hidden" name="record" value="recordPage">
          <input type="text" name="searchName" id="searchName" class="form-control no-border form-control-sm" placeholder="Type by Name or Surname">
          <button type="submit" class="btn btn-sm d-flex justify-content-start" style="background-color:#3466AA; color:whitesmoke;"><i class="bi bi-search"></i></button>
        </div>
      </form>
    </div>
  </div>


  <!--Table row-->
  <div class="row my-3 no-gutters mx-auto" style="background-color:#F1F1F1; border-radius: 10px; box-shadow: -1px 1px 20px 6px #d9d9d9;">
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 my-2 py-2">        

      <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive" style="height: 750px;">
        <table class="table table-striped table-hover table-md text-justify mb-0" style="border-radius: 10px;" id="1">
          <!--caption id="tbCaption"></caption-->
          <thead class="text-light" style="background-color:#234471;">
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Temperature</th>
                  <th scope="col">Time-in/Scan time attempt</th>
                  <th scope="col">Time-out</th>
              </tr>
          </thead>
          <tbody>
              <?php
                  $data = new visitorModel();
                  $dtr = new dtrModel();
                  if(isset($_SESSION["accountFname"]) && $_SESSION['accountFname'] != '')
                  {
                    $data->setFirstname($_SESSION["accountFname"]);
                    $_SESSION['accountFname'] = '';
                    unset($_SESSION['accountFname']);
                  }
                  else if(isset($_SESSION["accountLname"]) && $_SESSION['accountLname'] != '')
                  {
                    $data->setLastname($_SESSION["accountLname"]);
                    $_SESSION['accountLname'] = '';
                    unset($_SESSION['accountLname']);
                    session_unset();
                  }

                  $dtrData = ReadDtr($conn,$dtr);
                  $rowCount = 1;
                  $changeColor = 0;//This is to change the color
                  while($dtrRow = mysqli_fetch_assoc($dtrData))
                  {
                    if($dtrRow['accType'] == 'visitor')
                    {

                      $data->setId($dtrRow['dataId']);
                      $result = ReadAccountVisitor($conn,$data);
                      while($row = mysqli_fetch_assoc($result))
                      {
                        //This where the QR data was collected
                        $prevQRData = array("title"=>'qremsystem', "accType"=>'visitor', "id"=>$row['id']);
                        $convertedQRData = base64_encode(serialize($prevQRData));
    
                        if($changeColor==0)
                        {
                          ?>
                            <tr style="background-color:#82B7DC;">
                          <?php
                          $changeColor++;
                        }                   
                        else if($changeColor==1)
                        {
                          ?>
                            <tr style="background-color:#6aa9d5;">
                          <?php
                          $changeColor=0;
                        }
                          ?>
                              <td><?php echo $rowCount;?></td>
                              <td><?php echo $row['firstname'].' '.$row['lastname'];?></td>
                              <td><?php echo $dtrRow['temperature'];?></td><!-- Temperature -->
                              <td><?php echo $dtrRow['time_in'];?></td>
                              <td><?php echo $dtrRow['time_out'];?></td>
                          </tr>
                          <?php
                          $rowCount++;
    
                      }
                    }
                  }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

  
    <!--Modal for adding student-->
    <div class="modal fade" id="addAnnouncement" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" style="background-color: #e9e9e9; border-radius: 15px;">
              <div class="modal-header">
                  <h5 class="modal-title font-weight-bold" id="addAnnouncementLongTitle">Add Student Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="../controller/addStudent.php" method="POST" enctype="multipart/form-data">
                    <!--input type="hidden" id="typeTb" name="typeTb" value="event"-->
                    <center>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <img src="../asset/user.png" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 50%;" id="userImg">
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
                              <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="fnameTb">First name</label>
                                  <input type="text" class="form-control no-border form-control-sm" id="fnameTb" name="fnameTb" placeholder="Ex. Marie" maxlength="50" required>
                              </div>
                              <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="lnameTb">Middle name</label> 
                                  <input type="text" class="form-control form-control-sm" id="mnameTb" name="mnameTb" placeholder="Ex. Jimenez" maxlength="50" required>
                              </div>
                              <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="lnameTb">Last name</label> 
                                  <input type="text" class="form-control form-control-sm" id="lnameTb" name="lnameTb" placeholder="Ex. Cruz" maxlength="50" required>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
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
                              </div>
                              <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                  <label class="d-flex align-items-start" for="ageTb">Age</label> 
                                  <input type="number" class="form-control form-control-sm" id="ageTb" name="ageTb" placeholder="Ex. 21" required>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="row pb-2">
                          <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contactNumTb">Address</label>
                              <input type="text" class="form-control form-control-sm" id="addressTb" name="addressTb" placeholder="Ex. 2123 home st." maxlength="100" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row pb-2">
                          <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contactNumTb">Contact Number</label>
                              <input type="number" class="form-control form-control-sm" id="contactNumTb" name="contactNumTb" placeholder="Ex. 092X-XXX-XXXX" minlength="11" maxlength="11" required>
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
                              <input type="text" class="form-control form-control-sm" id="guardianNameTb" name="guardianNameTb" placeholder="Ex. Joselita C. Jimenez" maxlength="100" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row pb-2">
                          <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contentTb">Guardian Number</label>
                              <input type="number" class="form-control form-control-sm" id="guardianNumTb" name="guardianNumTb" placeholder="Ex. 092X-XXX-XXXX" minlength="11" maxlength="11" required>
                          </div>
                        </div>
                      </div>
                    </div>


                    <!-- Student School Info -->
                    <div class="mx-2 px-2" style="background-color: #f9f9f9; border-radius:10px;">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                              <label class="d-flex align-items-start" for="contentTb">Student ID</label>
                              <input type="text" class="form-control form-control-sm" id="studentIdTb" name="studentIdTb" placeholder="Ex. 012-3456-7890" maxlength="50" required>
                          </div>
                          <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                              <label class="d-flex align-items-start" for="contentTb">School name</label>
                              <input type="text" class="form-control form-control-sm" id="schoolTb" name="schoolTb" placeholder="Ex. STI College BALAYAN" maxlength="150" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="row pb-2">
                              <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="courseTb">Course</label>
                                  <input type="text" class="form-control no-border form-control-sm" id="courseTb" name="courseTb" placeholder="Ex. BSIT" maxlength="50" required>
                              </div>
                              <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="sectionTb">Section</label> 
                                  <input type="text" class="form-control form-control-sm" id="sectionTb" name="sectionTb" placeholder="Ex. ICT101" maxlength="20" required>
                              </div>
                              <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                  <label class="d-flex align-items-start" for="yearTb">Year Level</label> 
                                  <input type="text" class="form-control form-control-sm" id="yearTb" name="yearTb" placeholder="Ex. 1st" maxlength="20" required>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                  </form>
              </div>
          </div>
      </div>
    </div>


    <!-- Modal for Utilities->Change Password -->
    <div class="modal fade" id="ChangePass" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title font-weight-bold" id="addAnnouncementLongTitle">Change Admin Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="../controller/adminUpdate.php" method="POST" enctype="multipart/form-data">
                    <?php 
                      $admin = new adminModel();
                      $admin->setUsername($_SESSION['adminNameTb']);
                      $result = ReadAdmin($conn,$admin);

                      while($row = mysqli_fetch_assoc($result))
                      {
                        ?>
                          <input type="hidden" name="idTb" value="<?php echo $row['id'];?>">
                        <?php
                      }
                    ?>
                    <div class="form-group">
                      <div class="row pt-1 mt-1">
                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                            <label class="d-flex align-items-start" for="contentTb">Current Password</label>
                            <input type="password" class="form-control form-control-sm" id="oldPassTb" name="oldPassTb" placeholder="" maxlength="50" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row pt-1 mt-1">
                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                            <label class="d-flex align-items-start" for="contentTb">New Password</label>
                            <input type="password" class="form-control form-control-sm" id="newPassTb" name="newPassTb" placeholder="" maxlength="50" required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
    </div>

    
    <!-- Modal for Utilities->Dev Tools -->
    <div class="modal fade" id="DevTool" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" style="background-color:lightsalmon;">
              <div class="modal-header">
                  <h5 class="modal-title font-weight-bold" id="addAnnouncementLongTitle">Developer Tool</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body d-flex flex-column text-center">
                <div class="row mt-1">
                  <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                      <a type="button" href="https://files.000webhost.com/" target="_blank" class="btn btn-danger"><i class="bi bi-folder"></i> File Manager</a>
                  </div>
                </div>
                <div class="row mt-1">
                  <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                      <a type="button" href="https://databases-auth.000webhost.com/index.php" target="_blank" class="btn btn-warning"><i class="bi bi-filetype-php"></i> phpMyAdmin</a>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>


    <script>
  var qrLockStat = '';
</script>
    
    <!-- Modal for Utilities->QR settings -->
    <div class="modal fade" id="qrSett" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document"style="width:max-content;">
          <div class="modal-content" style="background-color:#d9d9d9;">
              <div class="modal-header">
                  <h5 class="modal-title font-weight-bold" id="addAnnouncementLongTitle">QR Settings</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body d-flex flex-column">
                <?php
                  $qr = new qrsettingsModel();
                  $result = ReadQrSetting($conn,$qr);
                  $row = mysqli_fetch_assoc($result);
                ?>

                <div class="row my-2">
                  <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
                    <form action="" method="post">
                      <label for="qrExpiryTb" style="font-size: 0.73rem;">Change QR Expiry hours:</label><br>
                      <small class="text-success">Current: <?php echo $row['expiryHrs'];?>Hrs before qr expire</small>
                      <div class="input-group d-flex justify-content-start">
                        <input type="hidden" name="idTb" id="qrIdTb" value="<?php echo $row['id'];?>">
                        <input type="number" name="qrExpiryTb" id="qrExpiryTb" class="form-control no-border form-control-sm mr-1">
                        <button type="submit" class="btn btn-success btn-sm" name="submitQrSett" id="submitQrSett" onclick="submitForm();"><i class="bi bi-hourglass-split"></i> Change</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="row mt-2">
                  <form action="" method="post">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                      <input type="hidden" name="qrStatId" id="qrStatId" value="<?php echo $row['id'];?>">
                      <?php
                        if($row['qrStatus']=='unlock')
                        {
                          ?>
                            <script> qrLockStat = 'unlock';//because this is the current value while the button below is not click yet </script>
                            <input type="hidden" name="qrStatTb" id="qrStatTb" value="lock">
                          <?php
                        }
                        else
                        {
                          ?>
                            <script> qrLockStat = 'lock';//because this is the current value while the button below is not click yet </script>
                            <input type="hidden" name="qrStatTb" id="qrStatTb" value="unlock">
                          <?php
                        }
                      ?>
                        <button type="submit" name="submitQrStat" id="submitQrStat" class="btn btn-danger btn-sm" onclick="submitFormLock();"><i class="bi bi-shield-lock-fill"></i> Lock all QR</button>
                    </div>
                  </form>
                  <label for="qrStatTb" id="qrStatLabel" class="text-primary"></label>
                  <script> $('#qrStatLabel').html('All QR code is '+qrLockStat);</script>
                </div>
              </div>
          </div>
      </div>
    </div>
</body>
<script>

  
        //To submit the form without reloading it
        function submitForm() 
        {
            var http = new XMLHttpRequest();
            http.open("POST", "../controller/changeSett.php", true);
            http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            //This is the form input fields data
            var params = "submitQrSett=" + document.getElementById("submitQrSett").value+"&qrExpiryTb=" + document.getElementById("qrExpiryTb").value+"&qrIdTb=" + document.getElementById('qrIdTb').value; // probably use document.getElementById(...).value
            http.send(params);
            http.onload = function() 
            {
                var data = http.responseText;
                //returnDate();
                console.log(JSON.parse(data));
            }
        }

        
  
        //To submit the form without reloading it
        function submitFormLock() 
        {
            var http = new XMLHttpRequest();
            http.open("POST", "../controller/lockAllQr.php", true);
            http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            //This is the form input fields data
            var params = "qrStatId=" + document.getElementById("qrStatId").value+"&qrStatTb=" + document.getElementById("qrStatTb").value+"&submitQrStat=" + document.getElementById('submitQrStat').value; // probably use document.getElementById(...).value
            http.send(params);
            http.onload = function() 
            {
                var data = http.responseText;
                //returnDate();
                console.log(data);
            }
        }
                        


var ctx = document.getElementById("pie1").getContext('2d');
var dataStat = [lockedData,unlockedData];
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Locked','Unlocked'],
        datasets: [{
            label: 'Status',
            data: dataStat,
            backgroundColor: [
                '#EE4B2B',
                '#50C878',
                '#8b0000',
                '#234471',
                '#AEC6CF',
                '#0000FF',
                '#FF00FF',
                '#00FFFF',
                '#ffa500',
                '#9400d3',
                '#808080',
                '#00ffff',
                '#8fbc8f',
                '#1e90ff'

            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Account Status',
                fontSize: 300
            },
            legend:{
                position: 'bottom'
            }
        }
    }
});

var ctx2 = document.getElementById("barGender").getContext('2d');
var genderData = [male,female];
                        var mybar = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: ['Male','Female'],
                                datasets: [{
                                    label: 'Count',
                                    data: genderData,
                                    backgroundColor: [
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 99, 132)',
                                        '#8b0000',
                                        '#234471',
                                        '#0000FF',
                                        '#FF00FF',
                                        '#00FFFF',
                                        '#ffa500',
                                        '#9400d3',
                                        '#808080',
                                        '#00ffff',
                                        '#8fbc8f',
                                        '#1e90ff'

                                    ],
                                    tension: 0.4,
                                    fill: false,
                                    spanGaps: true
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Head Count',
                                        fontSize: 300
                                    },
                                    legend:{
                                        display: false
                                    }
                                }
                            }
                        });


                        
var ctx3 = document.getElementById("barStat").getContext('2d');
var gateData = [inside,outside];
                        var mybar = new Chart(ctx3, {
                            type: 'bar',
                            data: {
                                labels: ['Inside','Outside'],
                                datasets: [{
                                    label: 'Count',
                                    data: gateData,
                                    backgroundColor: [
                                        '#EE4B2B',
                                        '#50C878',
                                        '#8b0000',
                                        '#234471',
                                        '#0000FF',
                                        '#FF00FF',
                                        '#00FFFF',
                                        '#ffa500',
                                        '#9400d3',
                                        '#808080',
                                        '#00ffff',
                                        '#8fbc8f',
                                        '#1e90ff'

                                    ],
                                    tension: 0.4,
                                    fill: false,
                                    spanGaps: true
                                }]
                            },
                            options: {
                              indexAxis: 'y',
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'In campus student count',
                                        fontSize: 300
                                    },
                                    legend:{
                                        display: false
                                    }
                                }
                            }
                        });

    //Edit

    /*To submit the form without reloading it
    function openEdit()
    {
      var http = new XMLHttpRequest();
      http.open("POST", "../controller/editAnnouncement.php", true);
      http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      //This is the form input fields data
      var params = "rowId=" + document.getElementById("rowId").value; // probably use document.getElementById(...).value
      http.send(params);
      http.onload = function()
      { 
          var data = http.responseText;
          console.log(data);
          $('#editAnnouncement').modal();
      }
    }
    */

    document.getElementById('successBox').style.display = 'none';
    var successSignal = localStorage.getItem('studentMsg');

    if(successSignal==1)
    {
        //if password or username is incorrect
        document.getElementById('successBox').style.display = 'block';
        document.getElementById('successMsg').innerHTML = "Data Added Successfully!";
        console.log("okay");

    }
    else if(successSignal==2)
    {
        //if password doesn't matched
        document.getElementById('successBox').style.display = 'block';
        document.getElementById('successMsg').innerHTML = "Changed Status Successfully";
        console.log("okay");
    }
    else if(successSignal==3)
    {
        //if password doesn't matched
        document.getElementById('failBox').style.display = 'block';
        document.getElementById('failMsg').innerHTML = "Data Removed Successfully";
        console.log("okay");
    }
    else if(successSignal==4)
    {
        //if password doesn't matched
        document.getElementById('successBox').style.display = 'block';
        document.getElementById('successMsg').innerHTML = "Information Successfully saved!";
        console.log("okay");
    }

    //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
    localStorage.setItem('studentMsg',0);
    
    //this will make a image preview before it was uploaded
    fileTb.onchange = evt => {
    const [file] = fileTb.files
    if (file) {
        userImg.src = URL.createObjectURL(file)
    }
    }
</script>
</html>
