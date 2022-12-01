<?php
	//QR CODE MAKER
		$prevQRData = array("title"=>'qremsystem', "accType"=>'student', "id"=>91);
		$convertedQRData = base64_encode(serialize($prevQRData));
		echo $convertedQRData;
?>