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
    width: 0;
    height: 0;
    outline:none!important;
    border:0;
    outline:0;
    
}
h6{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-weight:900;
  color: #1C1C1C;
}

#inTxt, #outTxt, #errorTxt, #tempTxt, #tempInput{
    display: none;
}

#noPicture{
    display: none;
}
    </style>
    <script>
    </script>

    <link rel="icon" href="../asset/qr.png">
    <title>Entrance Monitoring sys - Dashboard</title>
</head>
<body>
    
    <!-- Image and text Header-->
    <nav class="navbar navbar-light" style="background-color: #114084;">
        <a class="navbar-brand" href="#" style="font-weight:bold; color: whitesmoke; text-shadow: 1px 1px #1C1C1C;">
        <img src="../asset/qr.png" width="40" height="40" class="d-inline-block align-top" alt="">
            QR <small style="color: whitesmoke; text-shadow: 1px 1px #1C1C1C;">Entrance Monitoring System</small>
        </a>
     </nav>
        
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
                <div style="min-width:max-content;">
                    <center>
                        <img id="userPicture" src="../asset/qrScan.png" class="mx-auto text-center border border-dark" alt="" style="width:250px;height: 250px;">
                        <img id="noPicture" src="../asset/user.png" class="mx-auto text-center border border-dark" alt="" style="width:250px;height: 250px;">
                        <h6 id="typeLb" style="font-size:13px; color:red;" class="mt-1"></h6>
                    </center>
                    <h2 id="scanLb" class="mx-auto text-center">Scan Here</h2>
                    <h3 id="nameLb" class="mt-2" style=" font-weight:bold;"></h3>
                    <h4 id="deptLb"></h4>
                    <h4 id="courseLb"></h4>
                    <h4 id="contactLb"></h4>
                    <h4 id="addressLb"></h4>
                    <h4 id="guardianLb"></h4>
                    <h2 id="tempTxt" style="color:red; font-weight:bold;">Temp: </h2>
                    <h4 id="timeLb" class="text-success"></h4>
                    <h2 id="inTxt" class="text-center" style="color:green; font-weight:bold;"><i class="bi bi-check2-circle mr-1"></i>Time-in</h2>
                    <h2 id="outTxt" class="text-center" style="color:green; font-weight:bold;"><i class="bi bi-check2-circle mr-1"></i>Time-out</h2>
                    <h2 id="errorTxt" class="text-center" style="color:red; font-weight:bold;"><i class="bbi bi-exclamation-diamond-fill mr-1"></i></h2>
                    <input id="codeInput" oninput="clearVal()" onchange="getVal()" onblur="this.focus()" autofocus/> 
                    <input id="tempInput" oninput="clearVal()" onchange="getTemp()" onblur="this.focus()" maxlength="10" autofocus/> 
                </div>
            </div>
        </div>
    </div>  






</body>
<!--alert message script-->
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
                returnDate();
                //console.log(value);
            }
            else
            {
                qrcode.clear();
                qrcode.makeCode(value);
            }
        }

        
        //To submit the form without reloading it
        function submitTemp(tempValue) 
        {
            try
            {
                var http = new XMLHttpRequest();
                http.open("POST", "../controller/dtrInput.php", true);
                http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                //This is the form input fields data
                var params = "tempInput="+tempValue; // probably use document.getElementById(...).value
                http.send(params);
                http.onload = function() 
                {
                    var data = http.responseText;
                    if(data=='error')
                    {
                        $('#errorTxt').show();
                        $('#errorTxt').html('The QR is not belong to the system');
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    else
                    {
                        //console.log(data);
                        showTemp(data);
                        console.log(data);
                    }
                    //returnDate();
                    //console.log(params);
                }
            }
            catch(err)
            {
                //this will reload the page if an error has occur
                location.reload();
            }
        }

        function showTemp(temp)
        {
            $('#tempTxt').html("Temp: "+temp);
            $('#tempInput').blur();
            $('#tempInput').hide();
            const myTimeout = setTimeout(revokeView, 5000);

        }


        //To submit the form without reloading it
        function submitForm(qrValue) 
        {
            try
            {
                var http = new XMLHttpRequest();
                http.open("POST", "../controller/codeDecrypt.php", true);
                http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                //This is the form input fields data
                var params = "codeInput="+qrValue; // probably use document.getElementById(...).value
                http.send(params);
                http.onload = function() 
                {
                    var data = http.responseText;
                    if(data=='expired')
                    {
                        $('#errorTxt').show();
                        $('#errorTxt').html('QR already expired');
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    else if(data=='error')
                    {
                        $('#errorTxt').show();
                        $('#errorTxt').html('The QR is not belong to the system');
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    else
                    {
                        //console.log(data);
                        getType(JSON.parse(data));
                    }
                    //returnDate();
                    //console.log(params);
                }
            }
            catch(err)
            {
                //this will reload the page if an error has occur
                location.reload();
            }
        }

        
        //To identify the accType
        function getType(arrVal)
        {
            $('#codeInput').hide();//this will hide the code input to avoid inputting qr value after scanning something

            /*for(var key in arrVal)
            {
            }*/
                if(arrVal.accType=='visitor')
                {
                    if(arrVal.imageName!=null && arrVal.imageName ===" ")
                    {
                        console.log(arrVal.imageName);
                        document.getElementById("userPicture").src = '../upload/'+arrVal.imageName;
                    }
                    else
                    {
                        $('#userPicture').hide();
                        $('#noPicture').show();
                    }
                    //console.log(arrVal.imageName);
                    document.getElementById("scanLb").style.display = "none";

                    $('#nameLb').html('Name: '+arrVal.name);
                    $('#typeLb').html('('+arrVal.accType+')');
                    $('#contactLb').html('Contact #: '+arrVal.contact);
                    $('#addressLb').html('Address: '+arrVal.address);
                    //To check if the user is "in or out"
                    if(arrVal.state == 'in')
                    {
                        $('#tempTxt').show();//This is the temperature value/data container to display
                        $('#timeLb').html('Time: '+arrVal.time);
                        $('#inTxt').show();
                        //This will only show in the entry
                        $('#tempInput').show();//this will show the temp input to input the user temp
                        $('#tempInput').focus();
                    }
                    else
                    {
                        $('#timeLb').html('Time: '+arrVal.time);
                        $('#outTxt').show();
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    //const myTimeout = setTimeout(revokeView, 5000);
                    console.log(arrVal.accType);

                }
                else if(arrVal.accType=='guardian')
                {
                    if(arrVal.imageName!=null && arrVal.imageName ===" ")
                    {
                        document.getElementById("userPicture").src = '../upload/'+arrVal.imageName;
                    }
                    else
                    {
                        $('#userPicture').hide();
                        $('#noPicture').show();
                    }
                    document.getElementById("scanLb").style.display = "none";

                    $('#nameLb').html('Name: '+arrVal.name);
                    $('#typeLb').html('('+arrVal.accType+')');
                    $('#contactLb').html('Contact #: '+arrVal.contact);
                    $('#addressLb').html('Address: '+arrVal.address);
                    //To check if the user is "in or out"
                    if(arrVal.state == 'in')
                    {
                        $('#tempTxt').show();//This is the temperature value/data container to display
                        $('#timeLb').html('Time: '+arrVal.time);
                        $('#inTxt').show();

                        //This will only show in the entry
                        $('#tempInput').show();//this will show the temp input to input the user temp
                        $('#tempInput').focus();
                    }
                    else
                    {
                        $('#timeLb').html('Time: '+arrVal.time);
                        $('#outTxt').show();
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    //const myTimeout = setTimeout(revokeView, 5000);
                    //console.log(arrVal.accType);

                }
                else if(arrVal.accType=='student')
                {
                    
                    if(arrVal.imageName && arrVal.imageName ===" ")
                    {
                        document.getElementById("userPicture").src = '../upload/students/'+arrVal.imageName;
                    }
                    else
                    {
                        $('#userPicture').hide();
                        $('#noPicture').show();
                    }
                    //console.log(arrVal.imageName);
                    document.getElementById("scanLb").style.display = "none";

                    $('#nameLb').html('Name: '+arrVal.name);
                    $('#typeLb').html('('+arrVal.accType+')');
                    $('#courseLb').html("Course y/s: "+arrVal.course);
                    $('#contactLb').html('Contact #: '+arrVal.contact);
                    $('#addressLb').html('Address: '+arrVal.address);
                    $('#guardianLb').html("Parent's Name: "+arrVal.guardianName);
                    //To check if the user is "in or out"
                    if(arrVal.state == 'in')
                    {
                        $('#tempTxt').show();//This is the temperature value/data container to display
                        $('#timeLb').html('Time: '+arrVal.time);
                        $('#inTxt').show();
                        //This will only show in the entry
                        $('#tempInput').show();//this will show the temp input to input the user temp
                        $('#tempInput').focus();
                        
                    }
                    else
                    {
                        $('#timeLb').html('Time: '+arrVal.time);
                        $('#outTxt').show();
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    //const myTimeout = setTimeout(revokeView, 5000);
                    //console.log(arrVal.accType);
                }
                else if(arrVal.accType=='faculty')
                {
                    
                    if(arrVal.imageName && arrVal.imageName ===" ")
                    {
                        document.getElementById("userPicture").src = '../upload/faculty/'+arrVal.imageName;
                    }
                    else
                    {
                        $('#userPicture').hide();
                        $('#noPicture').show();
                    }
                    //console.log(arrVal.imageName);
                    document.getElementById("scanLb").style.display = "none";

                    $('#nameLb').html('Name: '+arrVal.name);
                    $('#typeLb').html('('+arrVal.accType+')');
                    $('#deptLb').html("Dept: "+arrVal.dept);
                    $('#contactLb').html('Contact #: '+arrVal.contact);

                    //To check if the user is "in or out"
                    if(arrVal.state == 'in')
                    {
                        $('#tempTxt').show();//This is the temperature value/data container to display
                        $('#timeLb').html('Time: '+arrVal.time);
                        $('#inTxt').show();
                        //This will only show in the entry
                        $('#tempInput').show();//this will show the temp input to input the user temp
                        $('#tempInput').focus();
                        
                    }
                    else
                    {
                        $('#timeLb').html('Time: '+arrVal.time);
                        $('#outTxt').show();
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    //const myTimeout = setTimeout(revokeView, 5000);
                    //console.log(arrVal.accType);
                }
            
        }

        //This method will turn the display back to normal state
        function revokeView()
        {
            document.getElementById("userPicture").src = '../asset/qrScan.png';
            $('#scanLb').show();

            $('#nameLb').html('');
            $('#typeLb').html('');
            $('#courseLb').html('');
            $('#contactLb').html('');
            $('#addressLb').html('');
            $('#guardianLb').html('');
            $('#timeLb').html('');
            $('#inTxt').hide();
            $('#outTxt').hide();
            $('#errorTxt').hide();
            $('#userPicture').show();
            $('#noPicture').hide();
            $('#deptLb').html('');
            $('#deptLb').hide();

            $('#tempTxt').html('');
            $('#tempTxt').hide();

            $('#codeInput').show();
            $('#codeInput').focus();

            $('#tempInput').blur();
            $('#tempInput').hide();
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
            console.log('QR data: '+inputVal);
            submitForm(inputVal);
            $("#codeInput").val('');
            $('#codeInput').blur();
        }

        function getTemp()
        {
            var inputVal = $("#tempInput").val();
            console.log('Temp data: '+inputVal);
            submitTemp(inputVal);
            $("#tempInput").val('');  
        }

        document.getElementById('successBox').style.display = 'none';
        var successSignal = localStorage.getItem('state');

        if(successSignal==1)
        {
            //if incorrect password
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Incorrect password please try again';
            //console.log("okay");

        }
        else if(successSignal==2)
        {
            //if email is already taken
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Sorry, this account is not existing';
            //console.log("okay");
        }
        else if(successSignal==3)
        {
            //if password doesn't matched
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "Password doesn't match!";
            //console.log("okay");
        }
        else if(successSignal==4)
        {
            //if password doesn't matched
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('successMsg').innerHTML = "Information Successfully saved!";
            //console.log("okay");
        }

        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        localStorage.setItem('state',0);
    </script>
</html>