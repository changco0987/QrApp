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
    <link type="text/css" rel="stylesheet" href="css/index.css"/>
    <script src="javascript/linked.js"></script>

    <link rel="icon" href="asset/icon.png">
    <title>Entrance Monitoring sys - Home page</title>
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
                        <img class="d-block" src="asset/pic1.jpg" alt="First slide" style="width: 100%; height: 874px;">
                        <div class="carousel-caption">
                            <h4 id="announceHead1">Announcement!</h4>
                            <p id="context1" class="text-justify">For writers, a random sentence can help them get their creative juices flowing. Since the topic of the sentence is completely unknown, it forces the writer to be creative when the sentence appears. There are a number of different ways a writer can use the random sentence for creativity. The most common way to use the sentence is to begin a story. Another option is to include it somewhere in the story. A much more difficult challenge is to use it to end a story. In any of these cases, it forces the writer to think creatively since they have no idea what sentence will appear from the tool.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-responsive" src="asset/sti.jpg" alt="Second slide" style="width: 100%; height: 874px;">
                        <div class="carousel-caption">
                            <h4 id="announceHead2">Important</h4>
                            <p id="context2" class="text-justify">If you're visiting this page, you're likely here because you're searching for a random sentence. Sometimes a random word just isn't enough, and that is where the random sentence generator comes into play. By inputting the desired number, you can make a list of as many random sentences as you want or need. Producing random sentences can be helpful in a number of different ways.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-responsive" src="asset/pic3.jpeg" alt="Third slide" style="width: 100%; height: 874px;">
                        <div class="carousel-caption">
                            <h4 id="announceHead3">Announcement 3</h4>
                            <p id="context3" class="text-justify">...</p>
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

        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 px-2 py-5" style="background-color: #3466AA;">
            <div class="container pagination-centered text-center mx-auto pt-5 mt-5" style="background-color: #F1F1F1; border-radius: 20px; box-shadow: -2px 2px 18px 4px black;">
                <div class="row no-gutters d-flex">
                    <div class="col-sm-12 col-xs-12 col-md-12">
                        <h1 class="pt-2 mt-2">Entrance Monitoring System</h1>
                    </div>
                </div>
                <div class="row no-gutters d-flex justify-content-center mb-5 px-2 mx-2 pt-5 mt-5">
                    <div class="col-sm-12 col-xs-12 col-md-12 pt-2 mt-2 d-flex">
                        <h5 class="ml-2 pl-2 ">Identify yourself as:</h5>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-12 pt-2 mt-2 d-flex justify-content-center">
                        <button type="button" class="btn btn-lg mx-auto pl-3" id="myBtn" style="width: 150px; background-color: #3466AA; color:white;" onclick="gotoVisitorLogin()">Visitor</button>
                        <button type="button" class="btn btn-lg mx-auto pr-3" style="width: 150px; background-color:#114084; color:white;" onclick="gotoGuardianLogin()">Guardian</button>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-12 pt-2 mt-2 pb-4 mb-5 d-flex justify-content-center">


                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--Footer Section-->
    <div class="row no-gutters">
    <footer class=" text-center text-lg-end fixed-bottom">
        <div class="d-flex justify-content-center p-3" style="background-color:#9C9C9C;">
            <h5><u><a class="text-secondary px-2" href="page/signup.php" target="_blank">Contacts</a></u></h5>
            <h5><u><a class="text-secondary px-2" href="page/signup.php" target="_blank">School History</a></u></h5>
            <h5><u><a class="text-secondary px-2" href="page/signup.php" target="_blank">About</a></u></h5>
        </div>
    </footer>
    </div>

</body>
</html>