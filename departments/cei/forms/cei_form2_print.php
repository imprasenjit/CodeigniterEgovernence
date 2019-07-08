<?php
$dept="cei";
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
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;		
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	}
	
	if($q->num_rows>0){	 
	    $results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$father_name=$results['father_name'];$name_of_person=$results['name_of_person'];$applicant_relation=$results['applicant_relation'];$class_of_license=$results['class_of_license'];$particular_details=$results['particular_details'];
		
		if($class_of_license==1) $class_of_license="Class I"; 
		else if($class_of_license==2) $class_of_license="Class II (for building Wiring)"; 
		else if($class_of_license==3) $class_of_license="Class II (for installations upto 650 Volts)"; 
		else if($class_of_license==4) $class_of_license="Special Class";
		else $class_of_license="";
		
		if(!empty($results["present_addr"]))
		{
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;;$present_addr_email=$present_addr->email;
		}else{
			$present_addr_name="";$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}	
		
		$form_name=$formFunctions->get_formName($dept,$form);
		$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	}
	
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form '.$form.'</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'
			<h4>'.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">			
			<tr>				
				<td width="50%">1. Name of the Applicant </td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>				
				<td>2.Father’s Name </td>
				<td>'.strtoupper($father_name).'</td>
			</tr>
			<tr>
				<td>3. Present Address </td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($present_addr_st1).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($present_addr_st2).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($present_addr_vt).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($present_addr_dist).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($present_addr_pin).'</td>
					</tr>
					<tr>
						<td>Mobile No</td>
						<td>'.strtoupper('+91'.$present_addr_mob).'</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>'.$present_addr_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>4. Permanent Address of Applicant </td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Phone No</td>
						<td>'.strtoupper($landline_std." - ".$landline_no).'</td>
					</tr>
					<tr>
						<td>Mobile No</td>
						<td>'.strtoupper('+91'.$mobile_no).'</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>'.$email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>5. Name of the person or firm on whose favour the license is sought</td>
				<td>'.strtoupper($name_of_person).'</td>
			</tr>
			<tr>
				<td>6. Relationship of the applicant with the person or firm referred to in column 5 above and the capacity to file the application</td>
				<td>'.strtoupper($applicant_relation).'</td>
			</tr>
			<tr>
				<td>7. Business Address of the person of the firm referred to in column 5 above</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No</td>
						<td>'.strtoupper('+91'.$b_mobile_no).'</td>
					</tr>
					<tr>
						<td>Phone No</td>
						<td>'.strtoupper($b_landline_std.'-'.$b_landline_no).'</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>'.$b_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">8. In case of partnership, names and detail particulars of the partners (additional sheets may be annexed if necessary)</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">			
					<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Name</th>
						<th>Permanent Address</th>
						<th>Age</th>
						<th>Details of interest</th>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
							while($row_1=$part1->fetch_array()){
							$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["sl_no"]).'</td>
								<td>'.strtoupper($row_1["name"]).'</td>
								<td>'.strtoupper($row_1["permanent_address"]).'</td>
								<td>'.strtoupper($row_1["age"]).'</td>
								<td>'.strtoupper($row_1["detail"]).'</td>
							</tr>';
							}$printContents=$printContents.'
					</table>
				</td>
			</tr>
			
			<tr>
				<td>9. Class of license applied for (Class I/II/Spl. Class)</td>
				<td>'.strtoupper($class_of_license).'</td>
			</tr>
			<tr>
				<td>10. If any contractors license already been granted, detail particulars thereof.</td>
				<td>'.strtoupper($particular_details).'</td>
			</tr>
			<tr>
					<td colspan="2">11. Details of Supervisor and Workman under full time and part time employment<br/>
					(Additional sheets may be annexed if necessary)</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">			
					<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Name</th>
						<th>Permanent Address</th>
						<th>Date of Joining </th>
						<th>Class(Parts)</th>
						<th>Date of Issue</th>
						<th>Date of Expiry</th>
						<th>Whether fulltime</th>
					</tr>
					</thead>';					
						$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
							while($row_1=$part2->fetch_array()){
							$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["sl_no"]).'</td>
								<td>'.strtoupper($row_1["name"]).'</td>
								<td>'.strtoupper($row_1["permanent_address"]).'</td>
								<td>'.strtoupper($row_1["joining_date"]).'</td>
								<td>'.strtoupper($row_1["class"]).'</td>
								<td>'.strtoupper($row_1["issue_date"]).'</td>
								<td>'.strtoupper($row_1["expiry_date"]).'</td>
								<td>'.strtoupper($row_1["fulltime"]).'</td>
							</tr>';
							}$printContents=$printContents.'
					</table>
				</td>
			</tr>
							
			<tr>
				  <td colspan="2">12. Details of Testing instruments and other apparatus in possession:-</td>	  
			</tr>	
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">			
					<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Name of instrument </th>
						<th>Makers Name </th>
						<th>Capacity thereof  </th>
						<th>Year of Manufactur</th>
						<th>Sl. No. of instrument </th>
						<th>Quantitative no. thereof </th>
					</tr>
					
					</thead>';					
						$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
							while($row_1=$part2->fetch_array()){
							$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["sl_no"]).'</td>
								<td>'.strtoupper($row_1["name"]).'</td>
								<td>'.strtoupper($row_1["makers_name"]).'</td>
								<td>'.strtoupper($row_1["capacity"]).'</td>
								<td>'.strtoupper($row_1["year"]).'</td>
								<td>'.strtoupper($row_1["ins_no"]).'</td>
								<td>'.strtoupper($row_1["quantitative"]).'</td>
							</tr>';
							}$printContents=$printContents.'
					</table>
				</td>
			</tr>
			';			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			<tr>
				<td>Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b><br/>
				Place: <b>'.strtoupper($dist).' </b></td>						
				<td align="right"> <b>'.strtoupper($key_person).'</b><br/>Signature of Applicant</td>				
			</tr>			
		</table>';

?>