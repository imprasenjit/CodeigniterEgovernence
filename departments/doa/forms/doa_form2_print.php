<?php
 $dept="doa";
 $form="2";
 $table_name=getTableName($dept,$form);	
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from  ".$table_name."  where uain='$uain' and user_id='$swr_id'") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from  ".$table_name."  where user_id='$swr_id' and form_id='$form_id'") ;
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from  ".$table_name."  where user_id='$swr_id' and active='1'") ;
	}

	if($q->num_rows>0)
	{	
        $results=$q->fetch_assoc();		
		$form_id=$results["form_id"];$is_registration=$results["is_registration"];$is_registration_details=$results["is_registration_details"];$is_facilities=$results["is_facilities"];$is_facilities_details=$results["is_facilities_details"];$father_name=$results["father_name"];$capacity=$results["capacity"];$virtue=$results["virtue"];
				
		if($results["is_registration"]=="Y"){
			$is_registration="YES";
		}else{
			$is_registration="NO";
		}		
		if($results["is_facilities"]=="Y"){
			$is_facilities="YES";
		}else{
			$is_facilities="NO";
		}	
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
            <td >1. i. Name of the applicant :</td>
            <td width="50%">Place : '.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>ii. Address of the applicant : </td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td >'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($street_name2).'</td>
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
						<td>PIN Code </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>iii. Status  of the applicant  :</td>
			<td >'.strtoupper($status_applicant).'</td>
		</tr>  
		<tr>
				<td valign="top" >2. Address of the premises where the manufacturing activity will be done  :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td >'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
					</tr>
				</table></td>
		</tr>
		<tr>
				<td>3. Name of the insecticides with their registration number and date for which manufacturing license is applied: (enclose copies of certificates of registration duly signed by the applicant). : </td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr align="center" >
						<th align="center">Slno</th>
						<th align="center">Name of Insecticide</th>
						<th align="center">Registration No.</th>
						<th align="center"> Date</th>
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
					</table> </td>
		</tr>
		<tr>
				<td>4. Whether any registration is provisional.if so give particulars? :</td>
				<td>'.strtoupper($is_registration).'  '.strtoupper($is_registration_details).'</td>
		</tr>
		<tr>
				<td>5. Details of full time expert staff connected with the manufacture and testing  of the insecticides in the above unit :</td>
				<td><table class="table table-bordered table-responsive">
					<tr align="center" >
						<th align="center">Slno</th>
						<th align="center">Name</th>
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
					</table></td>
		</tr>
		<tr>
				<td>6. Whether all the facilities required under Chapter VIII of the rules have been provided.Give full details in a separate sheet  :</td>
				<td>'.strtoupper($is_facilities).' '.strtoupper($is_facilities_details).'</td>
		</tr>
		<tr>
				<td colspan="2"><strong>Verification</strong><br/><br/>I &nbsp;'.strtoupper($key_person).' &nbsp;s/o&nbsp;'.strtoupper($key_person).' &nbsp; do hereby solemnly verify that to the best of my knowledge and belief the information given in the application and the annexure and statements accompanying it is correct and complete.</td>
		</tr>
		<tr>
				<td colspan="2">I further declare that I am making this application in my capacity as &nbsp;'.strtoupper($key_person).' &nbsp;&nbsp; and that I am competent to make this application and verify it by virtue of  &nbsp;&nbsp;'.strtoupper($key_person).' &nbsp;&nbsp; a photo/attested copy of which is enclosed herewith.</td>
		</tr>';

		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">Signature of Proprietor/Partner <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	';
?>