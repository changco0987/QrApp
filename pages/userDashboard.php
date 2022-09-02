<?php
    include_once '../db/connection.php';

    include_once '../model/visitorModel.php';
    include_once '../db/tb_visitor.php';

    include_once '../model/guardianModel.php';
    include_once '../db/tb_guardian.php';
    
    include_once '../model/logsModel.php';
    include_once '../db/tb_logs.php';

    //This will check if the user is truely login
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: ../index.php");
    }
    
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
        .my-custom-scrollbar {
        position: relative;
        height: 200px;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
                
        @media screen and (max-height: 850px) {

        #accHistoryModal {

            font-size: 12px;
        }
        }

        @media screen and (max-width: 650px) {

            #accHistoryModal {

                font-size: 12px;
            }
        }

        @media screen and (max-width: 450px) {

            #accHistoryModal {

                font-size: 12px;
            }
        }


        @media screen and (max-width: 360px) {

            #accHistoryModal {

                font-size: 12px;
            }
        }


        @media screen and (max-width: 320px) {

            #accHistoryModal {

                font-size: 12px;
            }

        }
    </style>
    <script>

        //The qr generator function
        var qrcode = undefined;
        function generateQRCode(value)
        {
            if(qrcode === undefined)
            {
                qrcode = new QRCode(document.getElementById('qrcode'), value);
                $('#qrcode').show();
                returnDate();
                console.log(value);
            }
            else
            {
                qrcode.clear();
                qrcode.makeCode(value);
            }
        }

        //To submit the form without reloading it
        function submitForm() {
            var http = new XMLHttpRequest();
            http.open("POST", "../controller/createQR.php", true);
            http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            //This is the form input fields data
            var params = "titleTb=" + document.getElementById("titleTb").value+"&accTypeTb=" + document.getElementById("accTypeTb").value+"&usernameTb=" + document.getElementById("usernameTb").value+"&qr_ExDateTb=" + document.getElementById("qr_ExDateTb").value; // probably use document.getElementById(...).value
            $('#noQR').hide();
            http.send(params);
            http.onload = function() {
                var data = http.responseText;
                returnDate();
                generateQRCode(data);
                //console.log(params);
            }
        }

        //To get the user qr expiry date
        function returnDate(){
            var dateData = '<?php echo $_SESSION['accType']; ?>';
            var username = '<?php echo $_SESSION['username']; ?>';
            //alert('return sent'+ dateData);
            $.ajax({
                type: "POST",
                url: "../controller/getDate.php",
                data: {accTypeTb: dateData, usernameTb: username},
                dataType:'text', //or HTML, JSON, etc.
                success: function(response){
                    //alert(response);
                $('#qrIndicator').html(response);
                    //echo what the server sent back...
                }
            });
        }

    </script>

    <link rel="icon" href="../asset/icon.png">
    <title>Entrance Monitoring sys - Dashboard</title>
</head>
<body>
        
    <!-- Alert message container-->
    <div id="successBox" class="alert alert-success alert-dismissible fade show" role="alert" style="display:block;">
        <strong id="successMsg"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
<div class="row myRow mt-4 pt-4 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-4 py-4">
            <div class="container d-flex justify-content-center">
                <div>
                    <div class="form-group">
                        <center>
                            <small id="qrIndicator"></small>
                            <div class="py-3 my-3" id="qrcode"></div>
                            <?php
                                                                
                                //This will get/generate the default qr code for the user if the user somehow have a previous qr code

                                if($_SESSION['qr_ExDate']!==null)
                                {
                                    $prevQRData = array("title"=>'qremsystem', "accType"=>$_SESSION['accType'], "username"=>$_SESSION['username'], "qr_ExDate"=>$_SESSION['qr_ExDate']);
                                    $convertedQRData = base64_encode(serialize($prevQRData));
                                    ?>
                                        <script>
                                            var data = <?php echo json_encode($convertedQRData);?>;
                                            generateQRCode(data);
                                        </script>
                                    <?php

                                }
                                else
                                {
                                    //This means there is no previous qr generated for user
                                    ?>
                                        <div style="height: 256px; width: 256px; border-radius: 10px; border: solid white; background-color: whitesmoke;" id="noQR"></div>
                                        <script>
                                            $('#qrIndicator').html('Your QR is already expired');
                                            $('#qrcode').hide();
                                        </script>
                                    <?php
                                }
                            
                            ?>
                            <!-- Name of the user (visitor or guardian)-->
                            <h2 id="usernameLb" name="usernameLb"><?php echo $_SESSION['username'];?></h2>

                        </center>
                        <hr style="height:1px; border-width:0;background-color: #3466AA">
                    </div>
                    <div class="form-group">
                        <div class="row pt-2 mt-2">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <input type="hidden" name="titleTb" id="titleTb" value="qremsystem">
                                <input type="hidden" name="accTypeTb" id="accTypeTb" value="<?php echo $_SESSION['accType']; ?>">
                                <input type="hidden" name="usernameTb" id="usernameTb" value="<?php echo $_SESSION['username']; ?>">
                                <input type="hidden" name="qr_ExDateTb" id="qr_ExDateTb" value="<?php echo date('Y-m-d h:i:s a'); ?>">
                                <button type="submit" class="btn-success form-control btn d-flex justify-content-center" id="submitBtn" onclick="submitForm()"><i class="bi bi bi-qr-code mr-2"></i>Generate QR code</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <button type="button" class="form-control btn  d-flex justify-content-center" data-toggle="modal" data-target="#accSettModal" id="submitBtn" style="background-color: #3466AA; color:white;"><i class="bi bi bi-sliders mr-2"></i>Account Settings</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <a type="button" class="btn-danger form-control btn d-flex justify-content-center" id="submitBtn" href="../controller/wipedata.php"><i class="bi bi-box-arrow-left mr-2"></i>Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Account Settings Modal -->
    <div class="modal fade" id="accSettModal" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accSettModalLongTitle">Account Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row pt-1 mt-1">
                        <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                            <form action="accSettings.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <button type="submit" class="form-control btn  d-flex justify-content-center"  data-toggle="modal" data-target="#accSettModal" id="submitBtn1" style="background-color: #3466AA; color:white;"><i class="bi bi-pencil-square mr-2"></i>Change Info</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="hidden" id="accType" name="accType" value="<?php echo $_SESSION['accType'];?>">
                                <input type="hidden" id="usernameTb" name="usernameTb" value="<?php echo $_SESSION['username'];?>">
                                <button type="button" class="form-control btn btn-warning d-flex justify-content-center" data-toggle="modal" data-target="#accHistoryModal" id="submitBtn2"><i class="bi bi-clock-history mr-2"></i>Log in History</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account History Modal -->
    <div class="modal fade" id="accHistoryModal" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accSettModalLongTitle">Account History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row pt-1 mt-1">
                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-striped table-bordered table-hover table-sm text-justify  mb-0" id="<?php echo $value;?>">
                                        <caption id="tbCaption"></caption>
                                        <thead class="bg-primary text-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Activity</th>
                                                <th class="text-center" scope="col">Time and Date</th>
                                                <th class="text-center" scope="col">IP Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $log = new logsModel();
                                                $log->setCreator($_SESSION['username']);
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
            </div>
        </div>
    </div>



</body>
<!--alert message script-->
<script>
        document.getElementById('successBox').style.display = 'none';
        var successSignal = localStorage.getItem('state');

        if(successSignal==1)
        {
            //if incorrect password
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Incorrect password please try again';
            console.log("okay");

        }
        else if(successSignal==2)
        {
            //if email is already taken
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Sorry, this account is not existing';
            console.log("okay");
        }
        else if(successSignal==3)
        {
            //if password doesn't matched
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "Password doesn't match!";
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
        localStorage.setItem('state',0);
    </script>
</html>