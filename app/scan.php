<?php
    include_once '../db/connection.php';

    include_once '../model/visitorModel.php';
    include_once '../db/tb_visitor.php';

    include_once '../model/guardianModel.php';
    include_once '../db/tb_guardian.php';
    
    include_once '../model/studentModel.php';
    include_once '../db/tb_student.php';
    
    include_once '../model/logsModel.php';
    include_once '../db/tb_logs.php';

    //This will check if the user is truely login
    session_start();
    /*
    if(!isset($_SESSION['username']))
    {
        header("Location: ../index.php");
    }*/
    
    date_default_timezone_set('Asia/Manila');

    $row = array();

    /*
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
    */
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
    <!--Bootstrap icon--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <!-- QR code javascript -->
    <script src="../javascript/qrcode.min.js"></script>

    <!-- My CSS-->
    <link type="text/css" rel="stylesheet" href="../css/userDashboard.css">
    <style>
        .my-custom-scrollbar {
        position: relative;
        height: 200px;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
                
        @media screen and (max-height: 850px) {

        #accHistoryModal {

            font-size: 12px;
        }
        }

        @media screen and (max-width: 650px) {

            #accHistoryModal {

                font-size: 12px;
            }
        }

        @media screen and (max-width: 450px) {

            #accHistoryModal {

                font-size: 12px;
            }
        }


        @media screen and (max-width: 360px) {

            #accHistoryModal {

                font-size: 12px;
            }
        }


        @media screen and (max-width: 320px) {

            #accHistoryModal {

                font-size: 12px;
            }

        }

        
  @media print{
    body * {
        visibility: hidden;
    }
    #qrcode * {
        visibility: visible;
        width: 800px;
        height: 800px;
    }
}

#codeInput{
    width: 30;
    height: 10;
    outline:none!important;
    border:0;
    outline:0;
    
}
    </style>
    <script>
    /*
    outline:none!important;
    border:0;
    outline:0;
    */
        //The qr generator function
        var qrcode = undefined;
        function generateQRCode(value)
        {
            if(qrcode === undefined)
            {
                qrcode = new QRCode(document.getElementById('qrcode'), value);
                $('#qrcode').show();
                $('#printBtn').show();
                returnDate();
                console.log(value);
            }
            else
            {
                qrcode.clear();
                qrcode.makeCode(value);
            }
        }

        //To submit the form without reloading it
        function submitForm(qrValue) {
            var http = new XMLHttpRequest();
            http.open("POST", "../controller/codeDecrypt.php", true);
            http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            //This is the form input fields data
            var params = "codeInput="+qrValue; // probably use document.getElementById(...).value
            $('#noQR').hide();
            http.send(params);
            http.onload = function() {
                var data = http.responseText;
                //returnDate();
                console.log(data);
                //console.log(params);
            }
        }

        //To get the user qr expiry date
        function returnDate(){
            //var dateData = '<?php //echo $_SESSION['accType']; ?>';
            //var username = '<?php //echo $_SESSION['username']; ?>';
            //alert('return sent'+ dateData);
            $.ajax({
                type: "POST",
                url: "../controller/getDate.php",
                data: {accTypeTb: dateData, usernameTb: username},
                dataType:'text', //or HTML, JSON, etc.
                success: function(response){
                    //alert(response);
                $('#qrIndicator').html(response);
                    //echo what the server sent back...
                }
            });
        }
        
    </script>

    <link rel="icon" href="../asset/qr.png">
    <title>Entrance Monitoring sys - Dashboard</title>
</head>
<body>
        
    <!-- Alert message container-->
    <div id="successBox" class="alert alert-success alert-dismissible fade show" role="alert" style="display:block;">
        <strong id="successMsg"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
    <div class="row myRow mt-4 pt-4 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-4 py-4">
            <div class="container d-flex justify-content-center">
                <div>
                    <div class="form-group">
                        <small id="qrIndicator"></small>
                        <div id="printBtn">
                            <button type="button" class="form-control btn d-flex justify-content-end" onclick="window.print();" style="width:max-content; font-size:smaller; background-color:#3466AA; color:white;"><i class="bi bi-printer-fill mr-2"></i>Print</button>
                        </div>
                        <input id="codeInput" oninput="clearVal()" onchange="getVal()" onblur="this.focus()" autofocus/> 
                    </div>
                </div>
            </div>
        </div>
    </div>  






</body>
<!--alert message script-->
<script>
    /*
$(function() {
   $('#codeInput').keypress(function(event) {
       event.preventDefault();
       return false;
   });
});
*/ 
        //This will clear all keyboard inputs and filter it out
        function clearVal()
        {
            /*
            var inputVal = $("#codeInput").val();
            var result = inputVal.includes('=');
            if(!result)
            {
                $("#codeInput").val('');
            }
            */
        }    

        //This will get the qr input
        function getVal()
        {
            var inputVal = $("#codeInput").val();
            console.log(inputVal);
            submitForm(inputVal);
            $("#codeInput").val('');
        }

        document.getElementById('successBox').style.display = 'none';
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
            document.getElementById('successMsg').innerHTML = "Information Successfully saved!";
            console.log("okay");
        }

        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        localStorage.setItem('state',0);
    </script>
</html>