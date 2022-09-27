<?php

	$url = "https://test.oppwa.com/v1/checkouts";
	$data = "entityId=8ac7a4ca826e2c0d0182782fec5a31b6" .
                "&amount=92.00" .
                "&currency=SAR" .
                "&paymentType=DB";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   'Authorization:Bearer OGFjN2E0Y2E4MjZlMmMwZDAxODI3ODJmNTg0ZDMxYjF8M2FtOUVkWFNzdA=='));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);

	return $responseData;
?>
