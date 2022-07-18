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
    <link href="../css/index.css" rel="stylesheet"/>
    <!--script src="../javascript/index.js"></script-->
    <title>Document</title>
</head>
<body>
    <div class="row no-gutters">
        <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block" src="../asset/b.jpg" alt="First slide">
                        <div class="carousel-caption">
                            <h4>Announcement 1</h4>
                            <p>...</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-responsive" src="../asset/b.jpg" alt="Second slide">
                        <div class="carousel-caption">
                            <h4>Announcement 2</h4>
                            <p class="text-justify">adssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block" src="../asset/b.jpg" alt="Third slide">
                        <div class="carousel-caption">
                            <h4>Announcement 3</h4>
                            <p>...</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4" style="background-color:gray;">
            <div class="row no-gutters d-flex pt-5 mt-5">
                <div class="col-sm-12 col-xs-12 col-md-12 pt-5 mt-5 ">
                    <h1 class="text-center">Choose one below</h1>
                </div>
            </div>

            <div class="row no-gutters d-flex justify-content-center pt-5 mt-5">
                <div class="col-sm-12 col-xs-12 col-md-12 pt-5 mt-5 d-flex justify-content-between">
                    <button type="button" class="btn btn-lg  mx-5 " style="width: 200px; background-color:#3466AA; color:white;">Visitor</button>
                    <button type="button" class="btn btn-lg  mx-5 " style="width: 200px; background-color:#114084; color:white;">Guardian</button>
                </div>
            </div>

            <div class="row no-gutters pt-5 mt-5">
                <div class="d-flex justify-content-center col-sm-12 col-xs-12 col-md-12 pt-5 mt-5">
                    <h5><a class="text-primary" href="../page/signup.php">Just click here</a> to learn more.</h5>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>