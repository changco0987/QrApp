<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"-->
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
    height: max-content;
    width: 650px;
    padding: 20px;
    text-align: center;
    border-radius: 15px;
    box-shadow: -1px 1px 20px 6px black;
    
}

.myRow{
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translateX(-50%) translateY(-40%);
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
    top: 45%;
    left: 50%;
    transform: translateX(-50%) translateY(-45%);
    height: max-content;
    width: 385px;
    padding: 15px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

@media screen and (max-width: 650px) {
    body{  
    background-color: #f1f1f1;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translateX(-50%) translateY(-40%);
    height: max-content;
    width: 385px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}
/* S20 Ultra */
@media screen and (max-width: 450px) {

.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translateX(-50%) translateY(-30%);
    height: max-content;
    width: 385px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}


/* S8+ */
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
    height: max-content;
    width: 350px;
    padding: 20px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S9 */
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
    height: max-content;
    width: 320px;
    padding: 35px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
footer * {
    font-size: 17px;
}
#smsNotifLbl{
    font-size: 11px;
}

}
    </style>

    <link rel="icon" href="../asset/qr.png">
    <title>Health Monitoring sys - Sign up</title>
</head>
<body>


    <!-- Image and text Header-->
    <nav class="navbar navbar-light" style="background-color: #114084;">
        <a class="navbar-brand" href="#" style="font-weight:bold; color: whitesmoke; text-shadow: 1px 1px #1C1C1C;">
        <img src="../asset/qr.png" width="40" height="40" class="d-inline-block align-top" alt="">
            QR <small style="color: whitesmoke; text-shadow: 1px 1px #1C1C1C;">Code Based Health Monitoring System</small>
        </a>
     </nav>
    <div class="row myRow mt-xl-5 pt-xl-5 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-5 py-5">
            <div class="containerForm">
                <div class="d-flex justify-content-center">
                    <form action="../pages/smsConfirm.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="accType" value="guardian">
                        <div class="form-group">
                            <center>
                                <h1>Sign up <small style="font-size: 20px; font-weight:bold; color:#3466AA;">as guardian</small></h1>
                            </center>
                            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-1 mt-1">
                                    <label class="d-flex align-items-start" for="fnameTb">First name</label>
                                    <input type="text" class="form-control no-border" id="fnameTb" name="fnameTb" placeholder="Ex. Marie" maxlength="50" required>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-1 mt-1">
                                    <label class="d-flex align-items-start" for="lnameTb">Last name</label> 
                                    <input type="text" class="form-control form-control-sm" id="lnameTb" name="lnameTb" placeholder="Ex. Cruz" maxlength="50" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="usernameTb">Username</label>
                                    <input type="text" class="form-control form-control-sm" id="usernameTb" name="usernameTb" placeholder="Ex. Marie0123" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                    <label class="d-flex align-items-start" for="passwordTb">Password</label>
                                    <input type="password" class="form-control form-control-sm" id="passwordTb" name="passwordTb" placeholder="Ex. CMarie123" minlength="8" maxlength="20" required>
                                    <div class="d-flex">
                                        <input type="checkbox" class="mb-2 mr-1" name="showPass" id="showPass">
                                        <small><label for="showPass">Show password</label></small>
                                    </div>

                                    <small class="d-flex align-items-start" style="color:red;">Use at least 8 or up to 15 characters for your password </small>
                                </div>

                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                    <label class="d-flex align-items-start" for="passwordTb">Confirm Password</label>
                                    <input type="password" class="form-control form-control-sm" id="confirmPasswordTb" name="confirmPasswordTb" placeholder="Repeat your password" minlength="8" maxlength="20" required>
                                    <div class="d-flex">
                                        <input type="checkbox" class="mb-2 mr-1" name="showConfirmPass" id="showConfirmPass">
                                        <small><label for="showConfirmPass">Show password</label></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="addressTb">Address</label>
                                    <input type="text" class="form-control form-control-sm no-border" id="addressTb" name="addressTb" placeholder="Ex. 2123 home st." maxlength="90" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="contactTb">Contact Number</label>
                                    <input type="text" class="form-control form-control-sm no-border" id="contactTb" name="contactTb" placeholder="Ex. 092X-XXX-XXXX" maxlength="11" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="studentidTb">Student ID</label>
                                    <input type="text" class="form-control form-control-sm no-border" id="studentidTb" name="studentidTb" placeholder="Ex. 012-3456-7890" maxlength="80" required>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="notifCheckbox" name="notifCheckbox">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Do you want to recieve SMS notification?
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row py-2 my-2 pb-md-0 mb-md-0 pb-sm-5 mb-sm-5">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <button type="submit" class="form-control form-control-sm btn" id="submitBtn" name="submitBtn" style="background-color: #3466AA; color:white;">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4 mb-4 pb-sm-0 mb-sm-0 mx-auto">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 pb-md-1 mb-md-1 pb-sm-5 mb-sm-5 ">
                                <!-- Spacing -->
                                <input type="text" style="display:none">
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
</body>
    <!--alert message script-->
    <script>
        //To show password
        const input = document.querySelector("#passwordTb");
        $('#showPass').click(function(){

            if (input.getAttribute("type") === "password")
            {
                input.setAttribute("type", "text");
            }
            else
            {
                input.setAttribute("type", "password");
            }
        });

        //To show confirm password
        const input2 = document.querySelector("#confirmPasswordTb");
        $('#showConfirmPass').click(function(){

            if (input2.getAttribute("type") === "password")
            {
                input2.setAttribute("type", "text");
            }
            else
            {
                input2.setAttribute("type", "password");
            }
        });
        
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
        else if(successSignal==4)
        {
            //if password doesn't matched
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "This StudentID doesn't exist";
            console.log("okay");
        }
        else if(successSignal==5)
        {
            //if password doesn't matched
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "Password doesn't match, please check carefully and try again";
            console.log("okay");
        }
        else if(successSignal==8)
        {
            //if password doesn't matched
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "Incorrect OTP, please try again";
            console.log("okay");
        }

        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        localStorage.setItem('state',0);
    </script>
</html>