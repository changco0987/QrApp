<?php
    include_once '../db/connection.php';
    include_once '../db/tb_announcement.php';
    include_once '../model/announcementModel.php';

    $event = new announcementModel();
    $event->setId($_POST['rowId']);
    $result = ReadEvent($conn,$event);
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
                    <form action="../controller/editAnnouncement.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                        <!--Changes the hidden input depending on the report type example: headcount, growth etc-->
                        <input type="hidden" id="rowId" name="rowId" value="<?php echo $_POST['rowId'];?>">
                        <input type="hidden" id="typeTb" name="typeTb" value="<?php echo $row['type'];?>">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <label class="d-flex align-items-start" for="contentTb">Heading</label>
                                <input type="text" class="form-control form-control-sm" id="headingTb" name="headingTb" placeholder="Heading" maxlength="50" required value="<?php echo $row['heading'];?>">
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <label class="d-flex align-items-start" for="contentTb">Content</label>
                                <textarea type="text" class="form-control form-control-sm" id="contentTb" name="contentTb" placeholder="Elaborate the context max of 500 letters" maxlength="500"style="height: 125px;"><?php echo $row['content'];?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <img src="../upload/events/<?php echo $row['imageName'];?>" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 10px;" id="userImg">
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
                                <input class="form-control" type="date" id="dateTb" name="dateTb" required  value="<?php echo $row['date'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mr-2">Submit Changes</button>
                            <a type="button" class="btn btn-warning" href="../admin/dashboard.php">Cancel</a>
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