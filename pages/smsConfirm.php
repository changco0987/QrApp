<?php
    include_once '../db/connection.php';

    include_once '../db/tb_visitor.php';
    include_once '../model/visitorModel.php';
    
    include_once '../db/tb_guardian.php';
    include_once '../model/guardianModel.php';
    //sms API
    include_once '../API/apiData.php';
    include_once '../controller/smsAPI.php';
    session_start();

    
    date_default_timezone_set('Asia/Manila');

    if(!isset($_POST['submitBtn']))
    {
        header('Location: ../index.php');
    }
    else
    {
        //The message sent to mobile number
        $otp = rand(11111111, 99999999);
        $message = "The OTP code for your QR Code Based health Monitoring system is: ".$otp;


                        
        //this will check if the guardian number is at the format +63
        if(str_contains($_POST['contactTb'], '+63')==false)
        {
            $phone =  substr_replace($_POST['contactTb'],'+63',0,1);//this will replace the 0 in the start of the number and replace with +63
        }
        else
        {
            $phone = $_POST['contactTb'];
        }
        sendMessage($ch,$key,$device,$sim,$priority,$phone,$message);//This will send the sms notification to the student 
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Offline Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    
    <script type="text/javascript" src="../bootstrap/js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"-->
    <!-- JavaScript Bundle with Popper -->
    <!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script-->
    <!--Bootstrap icon--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">


    <script src="../javascript/linked.js"></script>
    <link rel="stylesheet" href="../css/login.css">

    <style>
 

 label{
    font-size: 12px;
    color: #234471;
    font-weight: bold;
}


 @media screen and (max-height: 850px) {

.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 15px;
    box-shadow: -1px 1px 20px 6px black;
}
}

@media screen and (max-width: 650px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

@media screen and (max-width: 450px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}


@media screen and (max-width: 360px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: 890px;
    width: 350px;
    padding: 20px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S8+ */
@media screen and (max-width: 375px) {
body{  
    background-color: #f1f1f1;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
footer * {
    font-size: 17px;
}

}  

/* S9 */
@media screen and (max-width: 320px) {
body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
footer * {
    font-size: 17px;
}

}
    </style>
    <link rel="icon" href="../asset/qr.png">
    <title>Entrance Monitoring sys - Confirm Number</title>
</head>
<body>
    <!-- Image and text Header-->
    <nav class="navbar navbar-light" style="background-color: #114084;">
        <a class="navbar-brand" href="#" style="font-weight:bold; color: whitesmoke; text-shadow: 1px 1px #1C1C1C;">
        <img src="../asset/qr.png" width="40" height="40" class="d-inline-block align-top" alt="">
            QR <small style="color: whitesmoke; text-shadow: 1px 1px #1C1C1C;">Entrance Monitoring System</small>
        </a>
     </nav>
    


    <div class="row myRow mt-5 pt-5 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-5 py-5">
            <div class="container">
                <div class="d-flex justify-content-center my-4 py-1">
                    <form action="../controller/signup.php" method="post" enctype="multipart/form-data">
                            
                        <input type="hidden" name="otp" value="<?php echo $otp;?>">


                        <input type="hidden" name="accType" value="<?php echo $_POST['accType'];?>">
                        <input type="hidden" name="fnameTb" value="<?php echo $_POST['fnameTb'];?>">
                        <input type="hidden" name="lnameTb" value="<?php echo $_POST['lnameTb'];?>">
                        <input type="hidden" name="usernameTb" value="<?php echo $_POST['usernameTb'];?>">
                        <input type="hidden" name="passwordTb" value="<?php echo $_POST['passwordTb'];?>">
                        <input type="hidden" name="addressTb" value="<?php echo $_POST['addressTb'];?>">
                        <input type="hidden" name="contactTb" value="<?php echo $_POST['contactTb'];?>">
                        <?php
                            if($_POST['accType'] == 'guardian')
                            {
                                ?>
                                    <input type="hidden" name="studentidTb" value="<?php echo $_POST['studentidTb'];?>">
                                    <input type="hidden" name="notifCheckbox" value="<?php echo $_POST['notifCheckbox'];?>">
                                <?php
                            }
                        ?>
                        <div class="form-group">
                            <center>
                            <h2>Enter your OTP</h2>
                            </center>
                            <hr style="height:2px; border-width:0;background-color: #3466AA">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="otpTb">OTP code</label>
                                    <input type="text" class="form-control form-control-sm" id="otpTb" name="otpTb" placeholder="Ex. 12345678" minlength="8" maxlength="8" required>
                                    <small style="color:red; font-size:12px;">Never share your OTP nor inputting in other web sites</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <button type="submit" class="form-control btn btn-sm" name="submitBtn" id="submitBtn" style="background-color: #3466AA; color:white;">Continue</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Footer Section-->
    <div class="row no-gutters">
    <footer class=" text-center text-lg-end fixed-bottom">
        <div class="d-flex justify-content-center p-3" style="background-color: #E78F14;">
            <h5 style="background-color:#E78F14;"><a href="https://www.facebook.com/balayan.sti.edu/" target="_blank" class="mx-2" style="background-color:#E78F14;"><i class="bi bi-facebook" style="background-color:#E78F14;"></i></a></h5>
            <h5 style="background-color:#E78F14;"><a href="mailto:richardjohn.encarnacion@batangas.sti.edu" target="_blank" class="mx-2"><i class="bi bi-envelope-fill" style="background-color:#E78F14;"></i></a></h5>
            <h5 style="background-color:#E78F14;"><a href="https://maps.google.com/?q=STI College - Batangas, 865 National Road, Batangas, 4200 Batangas" target="_blank" class="mx-2"><i class="bi bi-geo-alt-fill" style="background-color:#E78F14;"></i></a></h5>
            <h5 style="background-color:#E78F14;"><a href="https://www.sti.edu/campuses-details.asp?campus_id=BAT" target="_blank" class="mx-2"><i class="bi bi-info-square-fill" style="background-color:#E78F14;"></i></a></h5>
        </div>
    </footer>
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
        var successSignal = localStorage.getItem('otpMsg');

        if(successSignal==1)
        {
            //if incorrect password
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Username does not exist!';
            console.log("okay");

        }
        else if(successSignal==2)
        {
            //if email is already taken
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Sorry, this account does not exist';
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
        else if(successSignal==5)
        {
            //if the account is locked
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "This account is locked, please contact the admin";
            console.log("okay");
        }

        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        localStorage.setItem('otpMsg',0);
    </script>
</html>
