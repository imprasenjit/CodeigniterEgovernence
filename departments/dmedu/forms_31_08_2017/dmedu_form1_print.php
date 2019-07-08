<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dmedu->query("select * from dmedu_form1 where user_id='$swr_id' and form_id='$form_id'") or die($dmedu->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dmedu->query("select * from dmedu_form1 where uain='$uain' and user_id='$swr_id'") or die($dmedu->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dmedu->query("select * from dmedu_form1 where user_id='$swr_id' and form_id='$form_id'") or die($dmedu->error);
	}else{
		$q=$dmedu->query("select * from dmedu_form1 where user_id='$swr_id' and active='1'") or die($dmedu->error);
	}

	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];
	
	$from=$key_person."<br/>Designation : ".$status_applicant."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;

	
	$q=$dmedu->query("select * from dmedu_form1 where user_id='$swr_id' and active='1'") or die("Error :".$dmedu->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0)
	{					
		$form_id=$results['form_id'];
		
		#### Part A #####
		
			$father_name=$results["father_name"];$completion_date=$results["completion_date"];
		    $registration=$results["registration"];								
		
		#### Part B #####
		$file1=$results["file1"];$file2=$results["file2"];
		if(!isset($css)){
            
			$val1=$formFunctions->get_uploadFile($file1);
			$val2=$formFunctions->get_uploadFile($file2);
		 }else{
            $val1=$formFunctions->get_useruploadFile($file1,$applicant_id);         
            $val2=$formFunctions->get_useruploadFile($file2,$applicant_id);     
		
		 }
		
		 
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
		 
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
    }
	$form_name=$formFunctions->get_formName('dmedu','1');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Form 3</title>
	<style>
	input, textarea { 
	text-transform: uppercase;
	}
	.header{
	width: 100%;
	height: 130px;
	font-weight: bold;
	}
	.main_body {
	height: 700px;
	width: 100%;
	}
	#form1 table {
	vertical-align: middle;
	}
	</style>
	</head>
	<body>';       
	}else{
    $printContents='';
	}	

	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>FORM NO. - I</h4>
  			<h4>'.$form_name.'</h4>
		</div><br/> 
  	<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >
			      

					<tr>
							<td width="50%">1.Full Name(in block letters):</td>
							<td width="50%">'.strtoupper($key_person).'</td>
					</tr>
					<tr>
							<td width="50%">2.Fathers Name:</td>
							<td width="50%">'.strtoupper($father_name).'</td>
					</tr>
					<tr>
							<td width="50%" valign="top">3.Present Address :</td>
							<td width="50%">
							<table border="0" width="100%">
							    
								<tr>
									<td width="50%">Street name 1 :</td>
									<td>'.strtoupper($street_name1).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 2 :</td>
									<td>'.strtoupper($street_name2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($vill).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($dist).'</td>
								</tr>
								<tr>
									<td width="50%">PIN Code :</td>
									<td>'.strtoupper($pincode).'</td>
								</tr>
								
								
								
							</table>
							</td>
					</tr>
					<tr>
							<td width="50%" valign="top">4.Permanent Address :</td>
							<td width="50%">
							<table border="0" width="100%">
							    
								<tr>
									<td width="50%">Street name 1 :</td>
									<td>'.strtoupper($b_street_name1).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 2 :</td>
									<td>'.strtoupper($b_street_name2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($b_vill).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($b_dist).'</td>
								</tr>
								<tr>
									<td width="50%">PIN Code :</td>
									<td>'.strtoupper($b_pincode).'</td>
								</tr>
								
								
								
							</table>
							</td>
					</tr>
					<tr>
					<td colspan="2">5. Qualifications and dates there of(to be supported by certificates in original) :</td>
				   </tr>
				   <tr>
					<td colspan="2">
						<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
							<thead>
							<tr>												
								<td width="25%">Sl No.</td>
								<td width="25%">Qualification</td>
								<td width="25%">Date</td>
								
							</tr>
							</thead>';					
								$part1=$dmedu->query("SELECT * FROM dmedu_form1_t1 WHERE form_id='$form_id'");
								while($row_1=$part1->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_1["slno"]).'</td>
									<td>'.strtoupper($row_1["qualification"]).'</td>
									<td>'.strtoupper($row_1["pass_date"]).'</td>
									
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
				  </tr>
				  
					<tr>
						    <td width="50%">6.Date of completion of Internship. :</td>
						    <td>'.date("d-m-Y",strtotime($completion_date)).'</td>
					</tr>
					<tr>
					      <td width="50%">7.  Provisional Registration No. :</td>
						    <td>'.strtoupper($registration).'</td> 
					</tr>
					<tr>
					<td colspan="2" height="50px"><font color="red"><b>Declaration.</b></font></td>
					</tr>	
		
					<tr>
					<td colspan="2">
						1.&nbsp;&nbsp;I solemnly pledge myself to consecrate my life to the service of humanity.
					</td>
					
				</tr>					
				<tr>
				<td colspan="2">
					 2.&nbsp;&nbsp;I will give to my teachers the respect and gratitude which is their due.
				</td>
					
				</tr>		
				<tr>
				<td colspan="2">
					3.&nbsp;&nbsp;I will practise my profession with consciense and dignity.
				</td>
					
				</tr>		
				<tr>
				<td colspan="2">
					4.&nbsp;&nbsp;The health of my patient will be my first consideration.
				</td>
					
				</tr>	
                <tr>
				<td colspan="2">
					5.&nbsp;&nbsp;I will respect the secrets,which are confided in me.
				</td>
					
				</tr>
                <tr>
				<td colspan="2">
					6.&nbsp;&nbsp;I will maintain by all means in my power,the honour and noble traditions of medical profession as laid down in the medical ethics.
				</td>
					
				</tr>
                <tr>
				<td colspan="2">
					7.&nbsp;&nbsp;My collegues will be my brothers.
				</td>
					
				</tr>
                <tr>
				<td colspan="2">
					8.&nbsp;&nbsp;I will not considerations of religion,nationality,race,party politics or social standing to intervene between my duty and my patient.
				</td>
					
				</tr>	
                <tr>
				<td colspan="2">
					9.&nbsp;&nbsp;I will maintain the utmost respect for human life from the time of conception.
				</td>
					
				</tr>	
                <tr>
				<td colspan="2">
					10.&nbsp;&nbsp;Even under threat,I will not use my medical knowledge contrary to the law of humanity:I make these promises solemnly,freely and upon my honour.
				</td>
					
				</tr>
                <tr>
					<td colspan="2" height="50px"><font color="red"><b>List of documents to be enclosed.</b></font></td>
				</tr>					
				<tr>
					<td>i. Qualifications:.</td>
					<td>'.$val1.'</td>
					
				</tr>					
				<tr>
				  <td>ii. Passport size Photograph in duplicate duly attested:</td>
				  <td>'.$val2.'</td>
				</tr>			
				';
				
				if(!empty($results["courier_details"]) && $results["courier_details"] != 1){
				$printContents=$printContents.'
				<tr>		   
				<td colspan="2">
					<table border="1" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" width="100%">
						<tr><td height="45px" colspan="2"><b>Courier Details.</b></td></tr>
						<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
						<tr><td width="50%">Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
						<tr><td width="50%">Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
					</table>
				</td>
				</tr>
				';				
				}
		if($results["payment_mode"]!=NULL){ 
		$printContents=$printContents.'<tr>		    
		<td colspan="2">
			<table border="0" width="100%">
			<tr><td height="45px" colspan="2">Payment Details :</td></tr>
			<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
			if($results["payment_mode"]==0)
			{
				$printContents=$printContents.'
				<tr>
					<td width="50%" valign="top">Demand Draft/Payment Reciept :</td>
					<td>'.$offline_challan.'<br/><br/>'.
					$formFunctions->offline_payment_details($uain) . '</td>
				</tr>';
			}else{
				$printContents=$printContents.$formFunctions->online_payment_details($results["uain"]);
			}
			$printContents=$printContents.'</table>		
			</td>
		  </tr>';
		  }
			$printContents=$printContents.' 
			<tr>
				<td valign="top" rowspan="2">
				<br/>Signature of owner : '.strtoupper($key_person).'
				</td>
				<td>Address : '.strtoupper($street_name1).'</td>
			</tr>
           
		</table>
	
';
?>
				  
				