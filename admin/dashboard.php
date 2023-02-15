<?php
    include_once '../db/connection.php';

    include_once '../model/adminModel.php';
    include_once '../db/tb_admin.php';

    include_once '../model/announcementModel.php';
    include_once '../db/tb_announcement.php';

    include_once '../model/qrsettingsModel.php';
    include_once '../db/tb_qrsettings.php';

    //This will check if the user is truely login
    date_default_timezone_set('Asia/Manila'); 
    $currentDateTime = date('Y-m-d h:i:s a');
    
    session_start();
    
    if($_SESSION['expiryDate'] <= $currentDateTime)
    {      
      $data = new adminModel();             
      $date = new DateTime($currentDateTime);
      $date->add(new DateInterval('PT24H'));
      $expiryDate = $date->format('Y-m-d h:i:s a');
      $data->setSessionExpiry($expiryDate);
            
      $data->setActiveLogin(0);
      UpdateAdmin($conn,$data);

      
      unset($_SESSION['adminNameTb']);
      session_unset();
        
    }
    

    
    if(!isset($_SESSION['adminNameTb']))
    {
        header("Location: ../admin.php");
        exit;
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

    <!--script src="https://code.jquery.com/jquery-1.8.3.min.js"></script-->
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
td{
  font-size: 14px;
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
</style>

</head>
<body>
          
<!-- Alert message container-->
<div id="successBox" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
    <strong id="successMsg"></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
    
<!-- Alert message container-->
<div id="failBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
    <strong id="failMsg"></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<div class="sidebar">
  <h3 class="d-flex justify-content-center mx-auto px-auto mt-2 pt-1" id="adminTitle">Admin Panel</h2>
  <a class="active mt-1" href="#home"><i class="bi bi-megaphone-fill mr-1"></i> Announcements</a>
  <a type="button" class=" mt-1" href="#maintenance" data-toggle="collapse" data-target="#collapseMaintenance" aria-expanded="true" aria-controls="collapseMaintenance"><i class="bi bi-wrench-adjustable mr-1"></i> Account Maintenance</a>
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
  <a type="button" class="mt-1" href="#healthRecord" data-toggle="collapse" data-target="#collapseHealthRecord" aria-expanded="true" aria-controls="collapseHealthRecord"><i class="bi bi-card-checklist mr-1"></i> Health Records</a>
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
              
              <button type="button" onclick="gotoScanner()" class="collapse-item btn btn-sm my-1 collapseBtn">Scanner App</button><br>
              
              <button type="button" onclick="gotoExitScanner()" class="collapse-item btn btn-sm my-1 collapseBtn">Exit Scanner App</button><br>
              
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
      <h3 class="d-flex justify-content-center mt-2 pt-1" id="pageTitle" >Announcements and Event Control</h3>
    </div>
    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 col-xl-1" style="background-color: #4e82c9;">
      <div class="w-100 d-flex justify-content-end">
          <a type="button" class="btn d-flex justify-content-start mt-2 mb-1 pt-1 btn-danger"  href="../controller/adminWipeData.php"><i class="bi bi-power mr-2"></i></span>Logout</a>
      </div>
    </div>
  </div>

  <!--This is where the body content start-->
  <div class="row my-3 no-gutters" style="background-color:#F1F1F1; border-radius: 10px; box-shadow: -1px 1px 20px 6px #d9d9d9;">
    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-2 pl-3 pr-2  mx-auto my-auto py-2">        
        <!--h6 class="pr-2" id="btnLabel">Types: </h6-->
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-calendar-event mr-1"></i>Events
        </button>
        <div class="dropdown-menu" style="border-radius: 15px;">
            <a class="dropdown-item active" href="../admin/dashboard.php"><i class="bi bi-calendar-event mr-1"></i>Events</a>
            <a class="dropdown-item" href="../admin/dashboardHoliday.php"><i class="bi bi-flag-fill mr-1"></i>Holidays</a>
            <a class="dropdown-item" href="../admin/dashboardExam.php"><i class="bi bi-pencil-fill mr-1"></i>Examination Schedule</a>
            <a class="dropdown-item" href="../admin/dashboardEnrollment.php"><i class="bi bi-calendar-check-fill mr-1"></i>Enrollment</a>
        </div>
    </div>

    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-7 pl-3 pr-2 my-2 py-2 text-center">
      <h2 style="font-weight:bolder; font-size:45px; color:#4e82c9; text-shadow: 1px 1px #234471;">Event view</h2>
    </div>

    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-3 pl-3 pr-2 my-2 py-2 d-flex justify-content-end h-100 mx-auto my-auto">
          <button type="button" class="btn d-flex justify-content-start btn-primary" href="../controller/adminWipeData.php" style="background-color:#3466AA;" data-toggle="modal" data-target="#addAnnouncement"><i class="bi bi-plus-square mr-2"></i>Add</button>
    </div>
  </div>

  <!--Table row-->
  <div class="row my-3 no-gutters" style="background-color:#F1F1F1; border-radius: 10px; box-shadow: -1px 1px 20px 6px #d9d9d9;">
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-2 my-2 py-2">        

      <div  class="table-wrapper-scroll-y my-custom-scrollbar table-responsive" style="height: 750px;">
        <table class="table table-striped table-bordered table-hover table-sm text-justify mb-0" style="border-radius: 10px;" id="1">
          <caption id="tbCaption"></caption>
          <thead class="text-light" style="background-color:#234471;">
              <tr>
                  <th scope="col">#</th>
                  <th scope="col" class="text-center" >Heading</th>
                  <th scope="col" class="text-center" >Content</th>
                  <th scope="col" class="text-center" >Image</th>
                  <th scope="col" class="text-center" >Date</th>
                  <th scope="col" class="text-center" >Status</th>
                  <th colspan="3" class="text-center" scope="col">Actions</th><!-- Edit button and Delete button-->
              </tr>
          </thead>
          <tbody>
              <?php
                  $event = new announcementModel();
                  $result = ReadEvent($conn,$event);
                  $rowCount = 1;
                  while($row = mysqli_fetch_assoc($result))
                  {

                    if($row['type']=='event')
                    {
                      ?>
                        <tr style="background-color:#82B7DC;">
                            <td><?php echo $rowCount;?></td>
                            <td><?php echo $row['heading'];?></td>
                            <td><?php echo $row['content'];?></td>
                            <td class="text-center">
                              <?php
                                  //This will assign the image name to the image html element and if null, it will not show anything
                                  if($row['imageName']==null)
                                  {
                                      ?>
                                          <!--img src="../asset/user.png" width="60" height="60" class="d-inline-block align-top img-fluid border border-dark" alt="" style="border-radius: 50%;"-->
                                      <?php
                                  }
                                  else
                                  {
                                      ?>
                                        <img src="../upload/events/<?php echo $row['imageName'];?>" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 10px;">
                                      <?php
                                  }
                              ?>
                            </td>
                            <td><?php echo date("M d, Y ", strtotime($row['date']));?></td>
                            
                            <?php
                              //This is to check the current status of event data if its already shown or not
                              if($row['isShow']==0)
                              {
                                ?>
                                  <!-- Status -->
                                  <td>Unpublished</td>

                                  <!--Publish Button-->
                                  <td id="<?php echo $row['id'];?>">
                                    <form action="../controller/publish.php" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="typeTb" id="typeTb" value="event">
                                      <input type="hidden" name="idTb" id="idTb" value="<?php echo $row['id'];?>">
                                      <input type="hidden" name="publishTb" id="publishTb" value="1">
                                      <button type="submit" class="btn btn-sm d-flex justify-content-start btn-success"><i class="bi bi-paperclip mr-1"></i>Publish</button>
                                    </form>
                                  </td>
                                <?php
                              } 
                              else
                              {
                                ?>
                                  <!-- Status -->
                                  <td>Published</td>

                                  <!--Publish Button-->
                                  <td id="<?php echo $row['id'];?>">
                                    <form action="../controller/publish.php" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="typeTb" id="typeTb" value="event">
                                      <input type="hidden" name="idTb" id="idTb" value="<?php echo $row['id'];?>">
                                      <input type="hidden" name="publishTb" id="publishTb" value="false">
                                      <button type="submit" class="btn btn-sm d-flex justify-content-start btn-secondary"><i class="bi bi-x-circle mr-1"></i>Unpublish</button>
                                    </form>
                                  </td>
                                <?php
                              }
                            ?>

                            <!--Edit Button-->
                            <td id="<?php echo $row['id'];?>">
                              <form action="../admin/editAnnouncement.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="rowId" id="rowId" value="<?php echo $row['id'];?>">
                                <button type="submit" class="btn btn-sm d-flex justify-content-start btn-warning" name="submitEdit"><i class="bi bi-pencil-square mr-1"></i>Edit</button>
                              </form>
                            </td>

                            <!--Delete Button-->
                            <td id="<?php echo $row['id'];?>">
                              <form action="../controller/deleteAnnouncement.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="typeTb" id="typeTb" value="event">
                                <input type="hidden" name="idTb" id="idTb" value="<?php echo $row['id'];?>">
                                <button type="submit" class="btn btn-sm d-flex justify-content-start btn-danger"><i class="bi bi-trash mr-1"></i>Delete</button>
                              </form>
                            </td>
                        </tr>
                      <?php
                      $rowCount++;
                    }

                  }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

  
    <!--Modal for adding announcement-->
    <div class="modal fade" id="addAnnouncement" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" style="background-color: #e9e9e9; border-radius: 15px;">
              <div class="modal-header">
                  <h5 class="modal-title font-weight-bold" id="addAnnouncementLongTitle">Add Event</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="../controller/addAnnouncement.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <!--Changes the hidden input depending on the report type example: headcount, growth etc-->
                      <input type="hidden" id="typeTb" name="typeTb" value="event">
                      <div class="row pt-1 mt-1">
                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                            <label class="d-flex align-items-start" for="contentTb">Heading</label>
                            <input type="text" class="form-control form-control-sm" id="headingTb" name="headingTb" placeholder="Heading" maxlength="50" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label class="d-flex align-items-start" for="contentTb">Content</label>
                              <textarea type="text" class="form-control form-control-sm" id="contentTb" name="contentTb" placeholder="Elaborate the context max of 255 letters" maxlength="255"style="height: 125px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <img src="../asset/emptyPicture.png" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 10px;" id="userImg">
                            </div>
                            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                              <div class="custom-file" style="width:fit-content;">
                                  <input type="file" accept=".jpg, .png, .jpeg" class="custom-file-input" id="fileTb" name="fileTb">
                                  <label class="custom-file-label text-left mt-2 pt-2" for="fileTb">Upload Photo</label>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                              <label id="dateLb" for="dateTb" >Choose Event Date</label>
                              <input class="form-control" type="date" id="dateTb" name="dateTb" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Event</button>
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
    var successSignal = localStorage.getItem('signal');

    if(successSignal==1)
    {
        //if password or username is incorrect
        document.getElementById('successBox').style.display = 'block';
        document.getElementById('successMsg').innerHTML = "Password Changed Successfully";
        console.log("okay");

    }
    else if(successSignal==2)
    {
        //if password doesn't matched
        document.getElementById('failBox').style.display = 'block';
        document.getElementById('failMsg').innerHTML = "Incorrect Password";
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

    //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
    localStorage.setItem('signal',0);
    
    //this will make a image preview before it was uploaded
    fileTb.onchange = evt => {
    const [file] = fileTb.files
    if (file) {
        userImg.src = URL.createObjectURL(file)
    }
    }
    
</script>
</html>

<?php
    exit;
?>