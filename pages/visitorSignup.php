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


    <!--My CSS and JS-->
    <!--link type="text/css" rel="stylesheet" href="../css/signup.css"/-->
    <!--script src="../javascript/index.js"></script-->
    <style>
        body{
    background-color: #3466AA;
    font-family: "Bahnschrift", Times, serif;
}

.containerForm{
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: 450px;
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
        height: 475px;
        width: 400px;
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
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        height: 475px;
        width: 385px;
        padding: 20px;
        text-align: center;
        border-radius: 15px;
        box-shadow: -1px 1px 20px 6px black;
    }
}


@media screen and (max-width: 360px) {

    .containerForm {
        background-color: #f1f1f1; /* Fallback color */
        color: black;
        font-weight: bold;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        height: 475px;
        width: 350px;
        padding: 20px;
        text-align: center;
        border-radius: 15px;
        box-shadow: -1px 1px 20px 6px black;
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
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        height: 475px;
        width: 320px;
        padding: 20px;
        text-align: center;
        border-radius: 0px;
        box-shadow: none;
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
                        <input type="hidden" name="accType" value="visitor">
                        <div class="form-group">
                            <center>
                                <h1>Sign up</h1>
                            </center>
                            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-2 mt-2">
                                    <input type="text" class="form-control no-border" id="fnameTb" name="fnameTb" placeholder="First name" maxlength="50" required>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-2 mt-2">
                                    <input type="text" class="form-control" id="lnameTb" name="lnameTb" placeholder="Last name" maxlength="50" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input type="text" class="form-control" id="usernameTb" name="usernameTb" placeholder="Username" maxlength="20" required>
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
                                    <input type="email" class="form-control no-border" id="emailTb" name="emailTb" placeholder="Email" maxlength="80" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
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
    <div class="row">
        <footer class=" text-center text-lg-end fixed-bottom">
            <div class="d-flex justify-content-center p-3" style="background-color:#9C9C9C;">
                <h5><u><a class="text-secondary px-2" href="../page/signup.php" target="_blank">Contacts</a></u></h5>
                <h5><u><a class="text-secondary px-2" href="../page/signup.php" target="_blank">School History</a></u></h5>
                <h5><u><a class="text-secondary px-2" href="../page/signup.php" target="_blank">About</a></u></h5>
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