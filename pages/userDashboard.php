<?php

    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: ../index.php");
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

    <!-- QR code javascript -->
    <script src="../javascript/qrcode.min.js"></script>

    <!-- My CSS-->
    <link type="text/css" rel="stylesheet" href="../css/userDashboard.css">
    <script>

        //The qr generator function
        var qrcode = undefined;
        function generateQRCode(value)
        {
            if(qrcode === undefined)
            {
                qrcode = new QRCode(document.getElementById('qrcode'), value);
                //console.log(value);
            }
            else
            {
                qrcode.clear();
                qrcode.makeCode(value);
            }
        }

        function submitForm() {
            var http = new XMLHttpRequest();
            http.open("POST", "../controller/createQR.php", true);
            http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            //This is the form input fields data
            var params = "titleTb=" + document.getElementById("titleTb").value+"&accTypeTb=" + document.getElementById("accTypeTb").value+"&usernameTb=" + document.getElementById("usernameTb").value+"&qr_ExDateTb=" + document.getElementById("qr_ExDateTb").value; // probably use document.getElementById(...).value

            http.send(params);
            http.onload = function() {
                var data = http.responseText;
                generateQRCode(data);
                console.log(data);
            }
        }
    </script>

    <link rel="icon" href="../asset/icon.png">
    <title>Dashboard</title>
</head>
<body>
    
<div class="row myRow mt-4 pt-4 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-4 py-4">
            <div class="container d-flex justify-content-center">
                <div>
                    <div class="form-group">
                        <center>
                            <div class="py-3 my-3" id="qrcode"></div>
                            <?php
                                                                
                                //This will get/generate the default qr code for the user if the user somehow have a previous qr code

                                if($_SESSION['qr_ExDate']!=null)
                                {
                                    $prevQRData = array("title"=>'qremsystem', "accType"=>$_SESSION['accType'], "username"=>$_SESSION['username'], "qr_ExDate"=>$_SESSION['qr_ExDate']);
                                    $convertedQRData = json_encode(base64_encode(serialize($prevQRData)));
                                    ?>
                                        <script>
                                            var data = <?php echo $convertedQRData;?>;
                                            console.log(data);
                                            generateQRCode(data);
                                        </script>
                                    <?php

                                }
                                else
                                {
                                    //This means there is no previous qr generated for user
                                    ?>
                                        <img src="../asset/noQr.png" class="rounded img-fluid img-thumbnail h-50 w-50">
                                    <?php
                                }
                            
                            ?>
                            <!-- Name of the user (visitor or guardian)-->
                            <h2 id="usernameLb" name="usernameLb"><?php echo $_SESSION['username'];?></h2>

                        </center>
                        <hr style="height:2px; border-width:0;background-color: #3466AA">
                    </div>
                    <div class="form-group">
                        <div class="row pt-2 mt-2">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <input type="hidden" name="titleTb" id="titleTb" value="qremsystem">
                                <input type="hidden" name="accTypeTb" id="accTypeTb" value="<?php echo $_SESSION['accType']; ?>">
                                <input type="hidden" name="usernameTb" id="usernameTb" value="<?php echo $_SESSION['username']; ?>">
                                <input type="hidden" name="qr_ExDateTb" id="qr_ExDateTb" value="<?php echo date('Y-m-d h:i a'); ?>">
                                <button type="submit" class="btn-success form-control btn" id="submitBtn" onclick="submitForm()">Generate QR code</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <form action="pages/accSettings.php" method="post" enctype="multipart/form-data">
                                    <button type="submit" class="form-control btn" id="submitBtn" style="background-color: #3466AA; color:white;">Account Settings</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-1 mt-1">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <a type="button" class="btn-danger form-control btn" id="submitBtn" href="../controller/wipedata.php">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>