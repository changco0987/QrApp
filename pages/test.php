<?php
	//QR CODE MAKER
		$prevQRData = array("title"=>'qremsystem', "accType"=>'student', "id"=>91);
		$convertedQRData = base64_encode(serialize($prevQRData));
		echo $convertedQRData;
?>

<script>
	var data = '34';
	if(typeof data == 'string')
	{
		console.log(typeof data+'asda');
	}
	else
	{
		
	console.log('wala');
	}
	data = data.replaceAll('"','');
	console.log(data);

</script>