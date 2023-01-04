<?php
    include_once '../db/connection.php';

    include_once '../model/visitorModel.php';
    include_once '../db/tb_visitor.php';

    include_once '../model/guardianModel.php';
    include_once '../db/tb_guardian.php';
    
    include_once '../model/logsModel.php';
    include_once '../db/tb_logs.php';

    //This will check if the user is truely login
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: ../index.php");
    }
    
    date_default_timezone_set('Asia/Manila');

    $row = array();

    if($_SESSION['accType'] == 'visitor')
    {
        $data = new visitorModel();
        $data->setUsername($_SESSION['username']);

        $result = ReadAccountVisitor($conn,$data);
        $row =  mysqli_fetch_assoc($result);
    }
    else if($_SESSION['accType'] == 'guardian')
    {
        $data = new guardianModel();
        $data->setUsername($_SESSION['username']);
        
        $result = ReadAccountGuardian($conn,$data);
        $row =  mysqli_fetch_assoc($result);
    }


?>
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
    height: 600px;
    width: 650px;
    padding: 20px;
    text-align: center;
    border-radius: 15px;
    box-shadow: none;
    
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
    top: 45%;
    left: 50%;
    transform: translateX(-50%) translateY(-45%);
    height: 700px;
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
    <link rel="icon" href="../asset/qr.png">
    <title>Health Monitoring sys - Account History</title>
</head>
<body>
<div class="row myRow mt-5 pt-5 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 my-5 py-5">
            <div class="containerForm">
                <div class="d-flex justify-content-center">
                <div class="row mx-auto">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-1 py-1">
                                <h2>Account History</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-1 py-1">
                                <table class="table table-striped table-bordered table-hover table-sm text-justify" id="<?php echo $_SESSION['username'];?>">
                                        <caption id="tbCaption"></caption>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Activity</th>
                                                <th class="text-center" scope="col">Time and Date</th>
                                                <th class="text-center" scope="col">IP Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $log = new logsModel();
                                                $log->setCreator($_SESSION['username']);
                                                $result = ReadLog($conn,$log);
                                                $rowCount = 1;
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    ?>
                                                    
                                                        <tr>
                                                            <td><?php echo $rowCount;?></td>
                                                            <td><?php echo $row['activity'];?></td>
                                                            <td><?php echo date("M d, Y h:i a", strtotime($row['dateStamp']));?></td>
                                                            <td><?php echo $row['ipAdd'];?></td>
                                                        </tr>
                                                    <?php
                                                    $rowCount++;

                                                }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-1 py-1">
                                
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
        
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                                    
                            </div>
                        </div>
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