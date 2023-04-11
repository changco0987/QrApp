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
    if(!isset($_SESSION['adminNameTb']))
    {
        header("Location: ../admin.php");
    }
    
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

#codeInput, #timeInInput{
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

#inTxt, #outTxt, #errorTxt, #tempTxt, #tempInput, #timeInInput{
    display: none;
}

#noPicture, #userPicture{
    display: none;
}
    </style>
    <script>
    </script>

    <link rel="icon" href="../asset/qr.png">
    <title>Entrance Monitoring sys - Scanner App (Exit)</title>
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
            <div class="container">
                <div style="min-width:max-content;">
                    <center>
                        <img id="qrPicture" src="../asset/qrScan.png" class="mx-auto text-center border border-dark" alt="" style="width:250px;height: 250px;">
                        <h2 id="scanLb" class="mx-auto text-center">Please scan your QR code</h2>
                    </center>
                    <div class="row">
                        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 my-4 py-4">
                            <div class="text-center">
                                <img id="userPicture" class="border border-dark" alt="" style="width:300px;height: 300px;">
                                <img id="noPicture" src="../asset/user.png" class="border border-dark" alt="" style="width:300px;height: 300px;">
                                <h6 id="typeLb" style="font-size:13px; color:red;" class="mt-1"></h6>
                            </div>
                        </div>

                        
                        <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8 my-4 py-4">
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
                        </div>

                    </div>
                    <input id="codeInput" onchange="getVal()" onblur="this.focus()" autofocus/> 


                    <input type="number" id="tempInput" oninput="clearVal()" onchange="getTemp()" onblur="this.focus()" step="0.01" min="-999" max="999" autofocus/> 


                    <input id="timeInInput" oninput="clearVal()" onchange="getTimeIn()" onblur="this.focus()" autofocus/> 

                </div>
            </div>
        </div>
    </div>  






</body>
<!--alert message script-->
<script>
    
    const url = new URL(window.location.href);
    url.searchParams.delete('temp');
    window.history.replaceState(null, null, url); // or pushState
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
                if(clearVal()==false)
                {
                    var http = new XMLHttpRequest();
                    if(tempValue > 37.50)
                    {
                        console.log('failed');
                        http.open("POST", "../controller/inputTemp.php", true);
                    }
                    else
                    {
                        console.log('success');
                        http.open("POST", "../controller/dtrInput.php", true);
                    }
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
                            $('#errorTxt').html('Inputted Temp error!');
                            const myTimeout = setTimeout(revokeView, 5000);
                        }
                        else if(data=='ok')
                        {
                            const myTimeout = setTimeout(revokeView, 4000);
                        }
                        else
                        {
                            //console.log(data);
                            showTimeIn(data);
                            console.log(data);
                        }
                        //returnDate();
                        //console.log(params);
                    }
                }
                else
                {
                    $("#tempInput").html('');
                }
            }
            catch(err)
            {
                //this will reload the page if an error has occur
                location.reload();
            }
        }

        function showTimeIn(temp)
        {
            $('#inTxt').show();
            const myTimeout = setTimeout(revokeView, 5000);

        }

        /*
        //This is for the sensor when entering the gate
        function detectTimeIn(timeinInput)
        {
            try
            {
                var http = new XMLHttpRequest();
                http.open("POST", "../controller/dtrInput.php", true);
                http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                //This is the form input fields data
                var params = "timeinInput="+timeinInput; // probably use document.getElementById(...).value
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

        */

        //To submit the form without reloading it
        function submitForm(qrValue) 
        {
            try
            {
                var http = new XMLHttpRequest();
                http.open("POST", "../controller/exit_codeDecrypt.php", true);
                http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                //This is the form input fields data
                var params = "codeInput="+qrValue; // probably use document.getElementById(...).value
                http.send(params);
                http.onload = function() 
                {
                    var data = http.responseText;
                    //console.log(data);
                    if(data=='expired')
                    {
                        $('#errorTxt').show();
                        $('#errorTxt').html('QR already expired');
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    else if(data=='Lock' || data=='Locked')
                    {
                        $('#errorTxt').show();
                        $('#errorTxt').html('QR is locked please contact the admin');
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    else if(data=='error')
                    {
                        $('#errorTxt').show();
                        $('#errorTxt').html('The QR is not belong to the system');
                        const myTimeout = setTimeout(revokeView, 5000);
                    }
                    else if(data=='invalid_status')
                    {
                        //This will only trigger if the QR status is set to go outside/exit
                        console.log('QR status: Entering');
                        const myTimeout = setTimeout(revokeView, 2000);
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
                    //To check if the user is "in or out"
                    if(arrVal.state == 'in')
                    {
                    }
                    else
                    {
                        var audio = new Audio('Dtmf-6.wav');
                        audio.play();
                        console.log(arrVal.state);
                        const myTimeout = setTimeout(revokeView, 1000);
                    }
                    //const myTimeout = setTimeout(revokeView, 5000);
                    console.log(arrVal.accType);

                }
                else if(arrVal.accType=='guardian')
                {
                    //To check if the user is "in or out"
                    if(arrVal.state == 'in')
                    {

                    }
                    else
                    {
                        
                        var audio = new Audio('Dtmf-6.wav');
                        audio.play();
                        console.log(arrVal.state);
                        const myTimeout = setTimeout(revokeView, 1000);
                    }
                    //const myTimeout = setTimeout(revokeView, 5000);
                    //console.log(arrVal.accType);

                }
                else if(arrVal.accType=='student')
                {
                    //To check if the user is "in or out"
                    if(arrVal.state == 'in')
                    {
                        
                    }
                    else
                    {
                        var audio = new Audio('Dtmf-6.wav');
                        audio.play();
                        console.log(arrVal.state);
                        const myTimeout = setTimeout(revokeView, 1000);
                    }
                    //const myTimeout = setTimeout(revokeView, 5000);
                    //console.log(arrVal.accType);
                }
                else if(arrVal.accType=='faculty')
                {
                    //To check if the user is "in or out"
                    if(arrVal.state == 'in')
                    {
                        
                    }
                    else
                    {
                        var audio = new Audio('Dtmf-6.wav');
                        audio.play();
                        console.log(arrVal.state);
                        const myTimeout = setTimeout(revokeView, 1000);
                    }

                    //const myTimeout = setTimeout(revokeView, 10000);
                    //console.log(arrVal.accType);
                }
            
        }

        //This method will turn the display back to normal state
        function revokeView()
        {
            //document.getElementById("userPicture").src = '../asset/qrScan.png';
            $('#qrPicture').show();
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
            $('#userPicture').hide();
            $('#noPicture').hide();
            $('#deptLb').html('');
            $('#deptLb').hide();

            $('#tempTxt').html('Temp: ');
            $('#tempTxt').hide();
            $('#tempInput').blur();
            $('#tempInput').hide();

            $('#codeInput').show();//qr input
            $('#codeInput').focus();//qr input

            
            url.searchParams.delete('temp');
            window.history.replaceState(null, null, url); // or pushState
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
         
            var inputVal = $("#tempInput").val();
            if(inputVal.includes('E'))
            {
                $("#tempInput").val('');
                return true;
            }
            /*
                var result = inputVal.includes('E');
                if(result)
                {
                    $("#tempInput").val('');
                    return true;
                }
            */
            return false;
        }    
        
        //This will get the qr input
        function getVal()
        {
            var inputVal = $("#codeInput").val();
	        inputVal = inputVal.replaceAll('"','');
            console.log('QR data: '+inputVal);
            submitForm(inputVal);
            $("#codeInput").val('');
            $('#codeInput').blur();
        }

        var inputTempVal = 0;
        //For temp input
        function getTemp()
        {
            inputTempVal = $("#tempInput").val();
            console.log('Temp data: '+inputTempVal);
            
            if(clearVal()==false)
            {
                var length = inputTempVal.length;
                if(length>5)
                {
                    $("#tempInput").val('');
                }
                else if(length>1)
                {
                    
                    if(inputTempVal>37.50)
                    {
                        console.log('High temp');
                        $('#tempTxt').html("Temp: "+inputTempVal+"°C high temperature");

                        //This will show the error message before reseting all display
                        $('#errorTxt').show();
                        $('#errorTxt').html('Please Try again later');
                        $("#tempInput").val('');  
                        $('#tempInput').blur();//To prevent from inputting another value

                        //to forge the get url
                        url.searchParams.set('temp', inputTempVal);
                        window.history.replaceState(null, null, url); // or pushState
                        

                        submitTemp(inputTempVal);

                        //window.history.replaceState(null, null, "?temp="+inputTempVal);

                    }
                    else
                    {
                        /*
                            if(inputTempVal<=36)
                            {
                                //this will show the inputted temp and hide the temp input field
                                console.log('not high');
                                $('#tempTxt').html("Temp: "+36+"°C normal temperature");
                                url.searchParams.set('temp', 36);
                            }
                        */
                        //this will show the inputted temp and hide the temp input field
                        console.log('not high');
                        $('#tempTxt').html("Temp: "+inputTempVal+"°C normal temperature");
                        url.searchParams.set('temp', inputTempVal);
                    

                        window.history.replaceState(null, null, url); // or pushState
                        //This will play the audio after the temp scan
                        var audio = new Audio('Dtmf-5.wav');
                        audio.play();

                        $("#tempInput").val('');  
                        $('#tempInput').blur();
                        $('#tempInput').hide();

                        //This will occur after the temp input 
                        $('#timeInInput').show();//this will show the temp input to input the user temp
                        $('#timeInInput').focus();
                    }
                }
            }
            else
            {
                $("#tempInput").val('');
            }

            //const myTimeout = setTimeout(revokeView, 2000);

        }

        //For sensor detection
        function getTimeIn()
        {
            var timeinInput = $('#timeInInput').val();
            console.log('time-in input: '+timeinInput);

            if(timeinInput==1)
            {
                submitTemp(inputTempVal);
                //detectTimeIn(timeinInput);
                $("#timeInInput").val(''); 
                $('#timeInInput').blur();
                $('#timeInInput').hide();
                var audio = new Audio('Dtmf-9.wav');
                audio.play();
            }
            else
            {
                console.log('wrong sensor input');
                $("#timeInInput").val(''); 
            }

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