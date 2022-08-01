<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <!--My CSS and JS-->
    <link type="text/css" rel="stylesheet" href="../css/signup.css"/>
    <!--script src="../javascript/index.js"></script-->

    <link rel="icon" href="../asset/icon.png">
    <title>Entrance Monitoring sys - Sign up</title>
</head>
<body>
    <div class="row myRow mt-5 pt-5 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-5 py-5">
            <div class="container px-2 mx-auto">
                <div class="d-flex justify-content-center">
                    <form action="" method="post">
                        <div class="form-group">
                            <h1>Sign up</h1>
                            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6  pt-2 mt-2">
                                    <input type="text" class="form-control no-border" id="fnameTb" name="fnameTb" placeholder="First name" maxlength="50" required>
                                </div>
                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6 pt-2 mt-2">
                                    <input type="text" class="form-control" id="lnameTb" name="lnameTb" placeholder="Last name" maxlength="50" required>
                                </div>
                            </div>
                            <div class="row pt-2 mt-2">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input type="text" class="form-control" id="usernameTb" name="usernameTb" placeholder="Username" maxlength="20" required>
                                </div>
                            </div>
                            <div class="row pt-2 mt-2">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input type="password" class="form-control" id="passwordTb" name="passwordTb" placeholder="Password" minlength="8" maxlength="20" required>
                                </div>
                            </div>
                            <div class="row pt-2 mt-2">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input type="email" class="form-control no-border" id="emailTb" name="emailTb" placeholder="Email" maxlength="80" required>
                                </div>
                            </div>
                            <div class="row pt-2 mt-2">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <button type="submit" class="form-control btn btn-primary" id="submitBtn">Submit</button>
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
</body>
</html>