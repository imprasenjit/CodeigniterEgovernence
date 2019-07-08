<?php
 $dept="doa";
 $form="14";
 $table_name=getTableName($dept,$form);	
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	}


	if($q->num_rows>0){	
        $results=$q->fetch_assoc();
		$form_id=$results["form_id"];$business=$results["business"];$licence_state=$results["licence_state"];$licence_no=$results["licence_no"];$day=$results["day"];$year=$results["year"];$licence_bearing_no=$results["licence_bearing_no"];$situated=$results["situated"];$renewed=$results["renewed"];
		
	
	}
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form '.$form.'</title>
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
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>				
	</head>
	<body>';
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'
  			<h4>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	   
  	   <tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/we hereby apply for renewal of the Licence to carry on the business of dealer in seeds under the and style of Shri/ M/s&nbsp;'.strtoupper($business).'&nbsp;The licence, desired to be renewed, was granted by the Licensing Authority for the State of'.strtoupper($licence_state).'&nbsp;and allotted Licence No&nbsp;'.strtoupper($licence_no).'&nbsp;&nbsp;on the day of &nbsp;&nbsp;'.strtoupper($day).'&nbsp;&nbsp; 20'.strtoupper($year).'.</td>
		</tr>
		<tr>
			<td width="50%">Full name and address of the applicant (s): </td>
			<td><table class="table table-bordered table-responsive">
					<tr>
						<td>1.i. Name of the applicant:</td>
						<td >'.strtoupper($key_person).'</td>
					</tr>
					<tr>
					    <td colspan="2">ii.Postal address of the applicant:</td>
					</tr>
					<tr>
						<td>Street Name 1 : </td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 : </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town : </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District : </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>Pincode : </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. : </td>
						<td>'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-mail id : </td>
						<td>'.$email.'</td>
					</tr>
					
				</table>
				</td>
		</tr>
		<tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Certified that the Licence bearing No.&nbsp;'.strtoupper($licence_bearing_no).'&nbsp;granted on to carry on the business of a dealer in seeds at the premises situated'.strtoupper($situated).'&nbsp;s hereby renewed up to &nbsp;'.strtoupper($renewed).'&nbsp;&nbsp;unless previously canceled or suspended under the provisions of the Seeds(Control) Order, 1983.</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
        $printContents=$printContents.' 
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">Signature of Applicant <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	
		';
?>  