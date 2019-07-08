<?php 
	require_once "../../../conf/dbconnect.php";
	
	
	
	$data=array("code" =>14004,
	"userid"=>"pcb",
	"tin"=>"kkk/sss/sss/sss/lop",
	"challanNo"=>1452445,
	"deptName"=>"LABD",
	"taxType"=>"LABD1",
	"totAmt"=>20.00
	);
	
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	CURLOPT_CONNECTTIMEOUT =>20,
	CURLOPT_POST => 1,	
	CURLOPT_CERTINFO => true,
	CURLOPT_SSL_VERIFYPEER => true,
	CURLOPT_SSL_VERIFYHOST => 0,
	CURLOPT_HEADER => 0,
	CURLOPT_PORT => 443,
	CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_URL => 'https://treasury.assam.gov.in/TreasuryEpay/EpayService',
    CURLOPT_REFERER    =>"https://easeofdoingbusinessinassam.in",
	CURLOPT_VERBOSE => true,
    CURLOPT_POSTFIELDS => http_build_query($data),
	CURLOPT_RETURNTRANSFER => 1
	));
	// Send the request & save response to $resp
	$resp=curl_exec($curl);
	// Close request to clear up some resources
	if(!curl_exec($curl)){
		die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
	}
	echo $resp;
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
	//echo $status;
	curl_close($curl);
	
	
?> 