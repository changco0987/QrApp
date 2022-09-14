<?php
    include 'db/connection.php';
    include 'model/announcementModel.php';
    include 'db/index_announcement.php';
    
    $event = new announcementModel();
    $result1 = ReadEvent($conn,$event);
    $result2 = ReadEvent($conn,$event);
    $rowCount = 0;
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
    <!--Bootstrap icon--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!--My CSS and JS-->
    <link type="text/css" rel="stylesheet" href="css/index.css"/>
    <script src="javascript/linked.js"></script>

    <style>
    img{
        width: 100%; 
        height: 874px;
    }
        
@media screen and (max-height: 850px) {

    img{  
   height: 500px;
}
}

@media screen and (max-width: 650px) {

    img{  
   height: 500px;
}
}

@media screen and (max-width: 450px) {

    img{  
   height: 330px;
}
}


@media screen and (max-width: 360px) {
    
    img{  
   height: 500px;
}
}


@media screen and (max-width: 320px) {

    img{  
   height: 500px;
}

}
    </style>


    <link rel="icon" href="asset/qr.png">
    <title>Entrance Monitoring sys - Home page</title>
</head>
<body>

    <div class="row no-gutters">
        <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                        while($row = mysqli_fetch_assoc($result1))
                        {
                            if($row['isShow']==1)
                            {
                                if($rowCount==0)
                                {
                                    ?>
                                    
                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $rowCount;?>" class="active"></li>
                                        
                                    <?php
                                    $rowCount++;
                                }
                                else
                                {
                                    ?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $rowCount;?>"></li>
                                    <?php
                                }
                            }
                            
                        }
                        $rowCount=0;
                    
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                        while($row = mysqli_fetch_assoc($result2))
                        {
                            if($row['isShow']==1)
                            {
                                if($rowCount==0)
                                {
                                    if($row['imageName']==null)
                                    {
                                        ?>
                                            <div class="carousel-item active">
                                                <img class="d-block" src="asset/sti.jpg" alt="<?php echo $rowCount. 'slide';?>">
                                                <div class="carousel-caption">
                                                    <h4 id="announceHead1"><?php echo $row['heading'];?></h4>
                                                    <p id="context1" class="text-justify"><?php echo $row['content'];?></p>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <div class="carousel-item active">
                                                <img class="d-block" src="upload/events/<?php echo $row['imageName'];?>" alt="<?php echo $rowCount. 'slide';?>">
                                                <div class="carousel-caption">
                                                    <h4 id="announceHead1"><?php echo $row['heading'];?></h4>
                                                    <p id="context1" class="text-justify"><?php echo $row['content'];?></p>
                                                </div>
                                            </div>
                                        <?php
                                    }

                                    $rowCount++;
                                }
                                else
                                {
                                    if($row['imageName']==null)
                                    {
                                        ?>
                                            <div class="carousel-item">
                                                <img class="d-block" src="asset/sti.jpg" alt="<?php echo $rowCount. 'slide';?>">
                                                <div class="carousel-caption">
                                                    <h4 id="announceHead1"><?php echo $row['heading'];?></h4>
                                                    <p id="context1" class="text-justify"><?php echo $row['content'];?></p>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <div class="carousel-item">
                                                <img class="d-block" src="upload/events/<?php echo $row['imageName'];?>" alt="<?php echo $rowCount. 'slide';?>" >
                                                <div class="carousel-caption">
                                                    <h4 id="announceHead1"><?php echo $row['heading'];?></h4>
                                                    <p id="context1" class="text-justify"><?php echo $row['content'];?></p>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                 
                                    $rowCount++;
                                }
                            }
                            
                        }
                        $rowCount=0;
                    
                    ?>
              
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

        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 px-2 py-5">
            <div class="container pagination-centered text-center mx-auto pt-5 mt-5" style="background-color: #F1F1F1; border-radius: 15px; box-shadow: -2px 2px 18px 4px black;">
                <div class="row no-gutters d-flex">
                    <div class="col-sm-12 col-xs-12 col-md-12">
                        <h1 id="pageTitle" class="pt-2 mt-2">QR Entrance Monitoring System</h1>
                    </div>
                </div>
                <div class="row no-gutters d-flex justify-content-center mb-5 px-2 mx-2 pt-5 mt-5">
                    <div class="col-sm-12 col-xs-12 col-md-12 pt-2 mt-2 d-flex">
                        <h5 class="ml-2 pl-2 ">Identify yourself as:</h5>
                    </div>
                    <!--Visitor and Guardian Button to login-->
                    <div class="col-sm-12 col-xs-12 col-md-12 pt-2 mt-2 d-flex justify-content-center">
                        <a type="button" class="btn btn-lg mx-auto pl-3" id="myBtn" style="width: 150px; background-color: #3466AA; color:white;" href="pages/visitorLogin.php">Visitor</a>
                        <a type="button" class="btn btn-lg mx-auto pr-3" id="myBtn" style="width: 150px; background-color:#114084; color:white;" href="pages/guardianLogin.php">Guardian</a>
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
        <div class="d-flex justify-content-center p-3" style="background-color: #E78F14;">
            <h5 style="background-color:#E78F14;"><a href="https://www.facebook.com/balayan.sti.edu/" target="_blank" class="mx-2" style="background-color:#E78F14;"><i class="bi bi-facebook" style="background-color:#E78F14;"></i></a></h5>
            <h5 style="background-color:#E78F14;"><a href="mailto:richardjohn.encarnacion@batangas.sti.edu" target="_blank" class="mx-2"><i class="bi bi-envelope-fill" style="background-color:#E78F14;"></i></a></h5>
            <h5 style="background-color:#E78F14;"><a href="https://maps.google.com/?q=STI College - Batangas, 865 National Road, Batangas, 4200 Batangas" target="_blank" class="mx-2"><i class="bi bi-geo-alt-fill" style="background-color:#E78F14;"></i></a></h5>
            <h5 style="background-color:#E78F14;"><a href="https://www.sti.edu/campuses-details.asp?campus_id=BAT" target="_blank" class="mx-2"><i class="bi bi-info-square-fill" style="background-color:#E78F14;"></i></a></h5>
        </div>
    </footer>
    </div>

</body>
</html>