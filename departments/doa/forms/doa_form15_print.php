<?php
 $dept="doa";
 $form="15";
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

	if($q->num_rows>0)
	{	
        $results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$pr_name1=$results["pr_name1"];$pr_name2=$results["pr_name2"];$pr_vill=$results["pr_vill"];$pr_dist=$results["pr_dist"];$pr_pincode=$results["pr_pincode"];$pr_mobile_no=$results["pr_mobile_no"];$pr_email=$results["pr_email"];
			
	    $is_provisional_details=$results["is_provisional_details"];$is_provisional=$results["is_provisional"];$is_facilities_details=$results["is_facilities_details"];$is_facilities=$results["is_facilities"];
		$total_pesticides=$results["total_pesticides"];
		$son_of=$results["son_of"];$capacity=$results["capacity"];$competent=$results["competent"];
		
		$i_verification=$results["i_verification"];
		
		if($is_provisional=='P') $is_provisional="PROVISIONAL";
		else $is_provisional="REGULAR";
		
		if($is_facilities=='Y') $is_facilities="YES";
		else $is_facilities="NO";
		
	}
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	}else{
    $printContents='';
	}	
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
	</div><br/> 
	
  	<table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2">1. Name, address and e-mail address of the applicant </td>
		</tr>
		<tr>
			<td>Name of the applicant :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td width="50%">Address of the applicant :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 :</td>
						<td >'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 :</td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town :</td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>Pincode :</td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td> Mobile No. :</td>
						<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-mail id :</td>
						<td> '.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="50%">2. Address of the manufacturing premises </td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td >'.strtoupper($pr_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($pr_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($pr_vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($pr_dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($pr_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td>+91&nbsp;'.strtoupper($pr_mobile_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">4. (a)Name of the insecticides with their registration number and date for which manufacturing license is applied</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr align="center" >
				<th align="center">Slno</th>
				<th align="center">Name of the insecticides</th>
				<th align="center">Insecticide Registration No</th>
				<th  align="center">Date</th>
			</tr>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["reg_no"]).'</td>
						<td>'.strtoupper($row_1["date"]).'</td>
				</tr>';
						}$printContents=$printContents.'
				</table>
				</td>
		</tr> 
		<tr>
		    <td>(b) Whether the registration is provisional or regular</td>
			<td>'.strtoupper($is_provisional).' &nbsp;&nbsp;&nbsp;&nbsp; '.strtoupper($is_provisional_details).'</td>
		</tr>
		<tr>
			<td colspan="2">(c) Details of full time expert staff engaged in the manufacture and testing of the insecticide in the above unit</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr align="center">
				<th align="center">Slno</th>
				<th align="center">Name and Designation</th>
				<th align="center">Qualification</th>
				<th align="center">Experience</th>
			</tr>';
			
			$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["name"]).'</td>
						<td>'.strtoupper($row_2["qualification"]).'</td>
						<td>'.strtoupper($row_2["experience"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> 
			</td>
		</tr>	
		<tr>
				<td>(d)Whether details of facilities for manufacture of the insecticide including infrastructure and those mentioned in Chapter VIII of the Insecticides Rules, 1971, have been provided : (Enclose complete details in a separate sheet duly signed by the applicant)</td>
				<td>'.strtoupper($is_facilities).' &nbsp;&nbsp; '.strtoupper($is_facilities_details).'</td>
		</tr>
		<tr>
				<td>Total No. of Pesticides</td>
				<td>'.strtoupper($total_pesticides).'</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><b>Verification</b></td>
		</tr>
		
		<tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I&nbsp;<b>'.strtoupper($i_verification).'</b>&nbsp;S/O  <b>'.strtoupper($son_of).' </b>&nbsp;do hereby solemnly verify that the information given in the application and the annexures and statements accompanying it is correct and complete to the best of my knowledge and belief and that nothing has been concealed. I clearly understand that this license is liable to be cancelled, if any information, or part thereof, is found to be wrong, fake or false at any stage or any condition of license is violated.<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I declare that we have adequate space and facilities to stock insecticides, manufactured by us so as to maintain their quality on shelf and shall not supply to any distributor or dealer or person who does not have adequate space and facilities to stock them so as to maintain their quality on shelf under every circumstances.
			<br/><br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I further declare that I am making this application in my capacity as&nbsp; <b>'.strtoupper($capacity).' </b>&nbsp;and that I am competent to make this application and verify it by virtue of  <b>'.strtoupper($competent).' </b>&nbsp;a photo/attested copy of which is enclosed herewith.
			</td>
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