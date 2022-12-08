<?php

    session_start();
    if(isset($_SESSION['adminNameTb']))
    {
        header('location: admin/dashboard.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Offline Bootstrap -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"-->
    <!-- JavaScript Bundle with Popper -->
    <!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script-->
    <!--Bootstrap icon--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <!-- QR code javascript -->
    <script src="javascript/qrcode.min.js"></script>

    <!-- My CSS-->
    <link type="text/css" rel="stylesheet" href="css/userDashboard.css">
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
    </style>

    <link rel="icon" href="asset/qr.png">
    <title>Entrance Monitoring sys - Dashboard</title>
</head>
<body>
    
    <!-- Image and text Header-->
    <nav class="navbar navbar-light" style="background-color: #114084;">
        <a class="navbar-brand" href="#" style="font-weight:bold; color: whitesmoke; text-shadow: 1px 1px #1C1C1C;">
        <img src="asset/qr.png" width="40" height="40" class="d-inline-block align-top" alt="">
            QR <small style="color: whitesmoke; text-shadow: 1px 1px #1C1C1C;">Entrance Monitoring System</small>
        </a>
     </nav>
        
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
                    <form action="controller/adminLogin.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <center>

                            <h1 id="adminTitle">Admin Panel</h1>

                            </center>
                            <hr style="height:1px; border-width:0;background-color:lightgray">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="adminNameTb">Username</label>
                                    <input type="text" class="form-control" id="adminNameTb" name="adminNameTb" placeholder="" minlength="5" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="adminPasswordTb">Password</label>
                                    <input type="password" class="form-control" id="adminPasswordTb" name="adminPasswordTb" placeholder="" minlength="8" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <button type="submit" class="form-control btn" id="submitBtn">Login</button>
                                </div>
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
            document.getElementById('successMsg').innerHTML = "Admin active login reached to its maximum count!";
            console.log("okay");
        }

        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        localStorage.setItem('state',0);
        
    </script>
</html>

