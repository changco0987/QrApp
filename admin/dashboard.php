<?php
    include_once '../db/connection.php';

    include_once '../model/adminModel.php';
    include_once '../db/tb_admin.php';

    include_once '../model/logsModel.php';
    include_once '../db/tb_logs.php';

    include_once '../model/announcementModel.php';
    include_once '../db/tb_announcement.php';

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

    <!--My CSS and JS-->
    <!--link type="text/css" rel="stylesheet" href="../css/index.css"/>
    <script src="javascript/linked.js"></script-->
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
</style>
</head>
<body>

<div class="sidebar">
  <h3 class="d-flex justify-content-center mx-auto px-auto mt-2 pt-1" id="adminTitle">Admin Panel</h2>
  <a class="active mt-1" href="#home"><i class="bi bi-megaphone-fill mr-1"></i> Announcements</a>
  <a class=" mt-1" href="#news"><i class="bi bi-wrench-adjustable mr-1"></i> Account Maintenance</a>
  <a class=" mt-1" href="#contact"><i class="bi bi-card-checklist mr-1"></i> Health Records</a>
  <a class=" mt-1" href="#about"><i class="bi bi-tools mr-1"></i> Utilities</a>
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
    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-2 pl-3 pr-2 my-2 py-2">        
        <!--h6 class="pr-2" id="btnLabel">Types: </h6-->
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-calendar-event mr-1"></i>Events
        </button>
        <div class="dropdown-menu" style="border-radius: 15px;">
            <a class="dropdown-item active" href="../pages/reporthc.php"><i class="bi bi-calendar-event mr-1"></i>Events</a>
            <a class="dropdown-item" href="../pages/report1.php"><i class="bi bi-flag-fill mr-1"></i>Holidays</a>
            <a class="dropdown-item" href="../pages/deploymentReport.php"><i class="bi bi-pencil-fill mr-1"></i>Examination Schedule</a>
            <a class="dropdown-item" href="../pages/reportGrowth.php"><i class="bi bi-calendar-check-fill mr-1"></i>Enrollment</a>
        </div>
    </div>

    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-2 pl-3 pr-2 my-2 py-2">
    </div>

    <div class="col-sm-4 col-xs-2 col-md-4 col-lg-2 col-xl-8 pl-3 pr-2 my-2 py-2 d-flex justify-content-end h-100 mx-auto my-auto">
          <button type="button" class="btn d-flex justify-content-start btn-primary" href="../controller/adminWipeData.php" style="background-color:#3466AA;"><i class="bi bi-plus-square mr-2"></i>Add Announcement</button>
    </div>
  </div>

  <!--Table row-->
  <div class="row my-3 no-gutters" style="background-color:#F1F1F1; border-radius: 10px; box-shadow: -1px 1px 20px 6px #d9d9d9;">
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-2 my-2 py-2">        

      <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-striped table-bordered table-hover table-sm text-justify mb-0" style="border-radius: 10px;" id="1">
                <caption id="tbCaption"></caption>
                <thead class="bg-primary text-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Content</th>
                        <th scope="col">Image</th>
                        <th scope="col">Publish</th>
                        <th scope="col">Date</th>
                        <th colspan="2" class="text-center" scope="col">Actions</th><!-- Edit button and Delete button-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $log = new logsModel();
                        $result = ReadLog($conn,$log);
                        $rowCount = 1;
                        while($row = mysqli_fetch_assoc($result))
                        {
                                
                                ?>
                                
                                    <tr class="table-primary">
                                        <td><?php echo $rowCount;?></td>
                                        <td><?php echo $row['activity'];?></td>
                                        <td><?php echo date("M d, Y h:i a", strtotime($row['dateStamp']));?></td>
                                        <td><?php echo $row['ipAdd'];?></td>
                                        <td><?php echo date("M d, Y h:i a", strtotime($row['dateStamp']));?></td>
                                        <td><?php echo $row['ipAdd'];?></td>
                                        <td><?php echo date("M d, Y h:i a", strtotime($row['dateStamp']));?></td>
                                        <td><?php echo $row['ipAdd'];?></td>
                                    </tr>
                                <?php
                                $rowCount++;
                            
                            

                        }
                    ?>
                </tbody>
        </table>
      </div>

    </div>


  </div>
</div>

</body>
</html>
