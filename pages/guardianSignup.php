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
    <!--link type="text/css" rel="stylesheet" href="../css/signup.css"/-->
    <!--script src="../javascript/index.js"></script-->
    <style>
        body{
    background-color: #3466AA;
    font-family: Comic Sans MS, Comic Sans;
}
label{
    font-size: 12px;
    color: #234471;
}

.containerForm{
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: 715px;
    width: 650px;
    padding: 20px;
    text-align: center;
    border-radius: 15px;
    box-shadow: -1px 1px 20px 6px black;
    
}

.myRow{
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translateX(-50%) translateY(-30%);
}

.form-control{
    border: 0;
}


@media screen and (max-height: 850px) {

.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: 700px;
    width: 400px;
    padding: 20px;
    text-align: center;
    border-radius: 15px;
    box-shadow: -1px 1px 20px 6px black;
}
}

@media screen and (max-width: 650px) {

.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translateX(-50%) translateY(-35%);
    height: 750px;
    width: 385px;
    padding: 20px;
    text-align: center;
    border-radius: 15px;
    box-shadow: -1px 1px 20px 6px black;
}
}

@media screen and (max-width: 450px) {

.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translateX(-50%) translateY(-35%);
    height: 790px;
    width: 385px;
    padding: 20px;
    text-align: center;
    border-radius: 15px;
    box-shadow: -1px 1px 20px 6px black;
}
}


@media screen and (max-width: 360px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translateX(-50%) translateY(-35%);
    height: 890px;
    width: 350px;
    padding: 20px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}


@media screen and (max-width: 320px) {
body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translateX(-50%) translateY(-25%);
    height: 970px;
    width: 320px;
    padding: 35px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
footer * {
    font-size: 12px;
}

}
    </style>

    <link rel="icon" href="../asset/icon.png">
    <title>Entrance Monitoring sys - Sign up</title>
</head>
<body>
    <div class="row myRow mt-5 pt-5 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-5 py-5">
            <div class="containerForm">
                <div class="d-flex justify-content-center">
                    <form action="../controller/signup.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="accType" value="guardian">
                        <div class="form-group mt-1 pt-1">
                            <center>
                                <h1>Sign up <small style="font-size: 20px; font-weight:bold; color:#3466AA;">as guardian</small></h1>
                            </center>
                            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-2 mt-2">
                                    <label class="d-flex align-items-start" for="fnameTb">First name</label>
                                    <input type="text" class="form-control no-border" id="fnameTb" name="fnameTb" placeholder="Ex. Marie" maxlength="50" required>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-2 mt-2">
                                    <label class="d-flex align-items-start" for="lnameTb">Last name</label> 
                                    <input type="text" class="form-control" id="lnameTb" name="lnameTb" placeholder="Ex. Cruz" maxlength="50" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="usernameTb">Username</label>
                                    <input type="text" class="form-control" id="usernameTb" name="usernameTb" placeholder="Ex. Marie0123" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="passwordTb">Password</label>
                                    <input type="password" class="form-control" id="passwordTb" name="passwordTb" placeholder="Ex. CMarie123" minlength="8" maxlength="20" required>
                                    <small class="d-flex align-items-start" style="color:red;">Use at least 8 or up to 15 characters for your password </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="addressTb">Address</label>
                                    <input type="text" class="form-control no-border" id="addressTb" name="addressTb" placeholder="Ex. 2123 home st." maxlength="90" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="contactTb">Contact Number</label>
                                    <input type="text" class="form-control no-border" id="contactTb" name="contactTb" placeholder="Ex. 0912345678901" maxlength="11" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="studentidTb">Student ID</label>
                                    <input type="text" class="form-control no-border" id="studentidTb" name="studentidTb" placeholder="Ex. 012-3456-7890" maxlength="80" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-check-inline" id="notifDiv">
                            <div class="row ">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input class="form-check-input no-border" name="notifCheckbox" type="checkbox" value="<?php echo $row['notification'];?>" id="notifCheckbox">
                                    <label class="form-check-label" for="notifCheckbox">Do you want to recieve sms notification?</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row pb-5 mb-5">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <button type="submit" class="form-control btn" id="submitBtn" style="background-color: #3466AA; color:white;">Submit</button>
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
            <h5 style="background-color:#E78F14;"><a href="https://www.facebook.com/batangas.sti.edu/" target="_blank" class="mx-2" style="background-color:#E78F14;"><i class="bi bi-facebook" style="background-color:#E78F14;"></i></a></h5>
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
</body>
    <!--alert message script-->
    <script>
        document.getElementById('alertBox').style.display = 'none';
        var successSignal = localStorage.getItem('state');

        if(successSignal==1)
        {
            //if incorrect password
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Username is already existed';
            console.log("okay");

        }
        else if(successSignal==2)
        {
            //if email is already taken
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'You cannot use white spaces';
            console.log("okay");
        }
        else if(successSignal==3)
        {
            //if password doesn't matched
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "Password doesn't match!";
            console.log("okay");
        }

        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        localStorage.setItem('state',0);
    </script>
</html>