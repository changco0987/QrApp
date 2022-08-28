<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        header("Location: userDashboard.php");
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


    <script src="../javascript/linked.js"></script>
    <link rel="stylesheet" href="../css/login.css">

    <link rel="icon" href="../asset/icon.png">
    <title>Entrance Monitoring sys - Login</title>
</head>
<body>

    <div class="row myRow mt-5 pt-5 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-5 py-5">
            <div class="container">
                <div class="d-flex justify-content-center my-4">
                    <form action="../controller/login.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="accType" value="guardian">
                        <div class="form-group">
                            <center>
                            <h2>Log in as guardian</h2>

                            </center>
                            <hr style="height:2px; border-width:0;background-color: #3466AA">
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input type="text" class="form-control" id="usernameTb" name="usernameTb" placeholder="Username" maxlength="20" required style="width: 300px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input type="password" class="form-control" id="passwordTb" name="passwordTb" placeholder="Password" minlength="8" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <button type="submit" class="form-control btn" id="submitBtn" style="background-color: #3466AA; color:white;">Login</button>
                                    <small>Don't have any account? <a class="text-primary" href="guardianSignup.php">Just Click here</a></small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Alert message container-->
    <div id="alertBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:block ;">
        <strong id="errorMsg">Holy guacamole!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- Alert message container-->
    <div id="successBox" class="alert alert-success alert-dismissible fade show" role="alert" style="display:block;">
        <strong id="successMsg"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
    
</body>

    <!--alert message script-->
    <script>
        document.getElementById('successBox').style.display = 'none';
        document.getElementById('alertBox').style.display = 'none';
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
            document.getElementById('successMsg').innerHTML = "Account Created Successfully!";
            console.log("okay");
        }

        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        localStorage.setItem('state',0);
    </script>
</html>