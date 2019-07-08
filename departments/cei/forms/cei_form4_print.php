<?php	
$dept="cei";
$form="4";
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
		$father_name=$results['father_name'];$name_of_license=$results['name_of_license'];$applicant_relation=$results['applicant_relation'];$dt_of_renew=$results['dt_of_renew'];$dt_of_validity=$results['dt_of_validity'];$any_other_info=$results['any_other_info'];$license_detail_reg=$results['license_detail_reg'];$license_detail_clas=$results['license_detail_clas'];
		if($license_detail_clas=="1"){
			$license_detail_clas="Class I";
		}else if($license_detail_clas=="2"){
			$license_detail_clas="Class II(for building Wiring)";
		}else if($license_detail_clas=="3"){
			$license_detail_clas="Class II(for installation upto 650 Volts)";
		}else if($license_detail_clas=="4"){
			$license_detail_clas="Special Class";
		}
		
		if(!empty($results["present_addr"]))
		{
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;;$present_addr_email=$present_addr->email;
		}
		else
		{
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}
		#####PartII####
		if(!empty($results["superviror_detail"]))
		{
			$superviror_detail=json_decode($results["superviror_detail"]);
			$superviror_detail_name=$superviror_detail->name;$superviror_detail_reg=$superviror_detail->reg;$superviror_detail_clas=$superviror_detail->clas;$superviror_detail_valid=$superviror_detail->valid;$superviror_detail_from=$superviror_detail->from;$superviror_detail_to=$superviror_detail->to;
		}
		else
		{
			$superviror_detail_name="";$superviror_detail_reg="";$superviror_detail_clas="";$superviror_detail_valid="";$superviror_detail_from="";$superviror_detail_to="";
		}
		#####PartIII####
		$year_to=$results['year_to'];$year_from=$results['year_from'];
		if(!empty($results["work_return"]))
		{
			$work_return=json_decode($results["work_return"]);
			$work_return_name=$work_return->name;$work_return_reg=$work_return->reg;$work_return_clas=$work_return->clas;$work_return_valid=$work_return->valid;$work_return_from=$work_return->from;$work_return_to=$work_return->to;
		}
		else
		{
			$work_return_name="";$work_return_reg="";$work_return_clas="";$work_return_valid="";$work_return_from="";$work_return_to="";
		}		
		
	}
	
	$any_other_info = wordwrap($results["any_other_info"], 40, "<br/>", true);
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
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
				<td>1. Name of the Applicant :</td>
				<td >'.strtoupper($key_person).'</td>
			</tr>
			<tr>				
				<td>2. Father&apos;s Name :</td>
				<td>'.strtoupper($father_name).'</td>
			</tr>
			<tr>
				<td>3. Present Address :</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1</td>
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
				<td>4. Name of the license</td>
				<td>'.strtoupper($name_of_license).'</td>
			</tr>
			<tr>
				<td>5. Registration no. and class of the license</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>(a) Registration no. </td>
							<td>'.strtoupper($license_detail_reg).'</td>
						</tr>
						<tr>
							<td>(b) Class of the license</td>
							<td>'.strtoupper($license_detail_clas).'</td>									
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>6. Relationship of the applicant with the licensee and the capacity to file the application :</td>
				<td>'.strtoupper($applicant_relation).'</td>									
			</tr>
			<tr>
				<td>7. Business address of the licensee :</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
                      <td >Street Name 1</td>
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
						<td>Phone No:</td>
						<td>'.strtoupper($b_landline_std.'-'.$b_landline_no).'</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td>'.$b_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>8.(a) Date of the last renewal:</td>
				<td>'.strtoupper($dt_of_renew).'</td>
			</tr>
			<tr>
				<td>(b) Date of validity:</td>
				<td>'.strtoupper($dt_of_validity).'</td>									
			</tr>
			<tr>
				<td>9. Any other information</td>
				<td>'.strtoupper($any_other_info).'</td>									
			</tr>
			<tr>
				<td colspan="2" align="center"><b>DETAILS OF SUPERVISORS, WORKMEN AND APPERNTICES AS ON:</b></td>
			</tr>
			<tr>
				<td>1. Name of the contractor</td>
				<td>'.strtoupper($superviror_detail_name).'</td>
			</tr>
			<tr>
				<td>2. Registration no. of the license</td>
				<td>'.strtoupper($superviror_detail_reg).'</td>	
			</tr>
			<tr>
				<td>3. Class of the license</td>
				<td>'.strtoupper($superviror_detail_clas).'</td>
			</tr>
			<tr>
				<td>4. License valid up-to</td>
				<td>'.strtoupper($superviror_detail_valid).'</td>	
			</tr>
			<tr>
				<td>5. Period of return</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>From </td>
							<td>'.strtoupper($superviror_detail_from).'</td>
						</tr>
						<tr>
							<td>To </td>
							<td>'.strtoupper($superviror_detail_to).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">6. Details of the supervisors, workmen and apprentice during the period of return </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">			
					<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Name</th>
						<th>Designation </th>
						<th>Supervisor </th>
						<th>Workmen </th>
						<th>Apprentice</th>
						<th>Registration no. of permit/certificate</th>
						<th>Parts qualified </th>
						<th>Date of validity  </th>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_enclosure4 WHERE form_id='$form_id'");
							while($row_1=$part1->fetch_array()){
							$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["sl_no"]).'</td>
								<td>'.strtoupper($row_1["name"]).'</td>
								<td>'.strtoupper($row_1["desig"]).'</td>
								<td>'.strtoupper($row_1["supervisor"]).'</td>
								<td>'.strtoupper($row_1["workman"]).'</td>
								<td>'.strtoupper($row_1["apprentice"]).'</td>
								<td>'.strtoupper($row_1["reg_no"]).'</td>
								<td>'.strtoupper($row_1["parts"]).'</td>
								<td>'.strtoupper($row_1["dt_of_val"]).'</td>
							</tr>';
							}$printContents=$printContents.'
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><b>RETURN OF WORKS FOR THE YEAR &nbsp;&nbsp;'.strtoupper($year_to).'&nbsp;&nbsp;-&nbsp;&nbsp;'.strtoupper($year_from).'</b></td>
			</tr>
			<tr>
				<td>1. Name of the contractor</td>
				<td>'.strtoupper($work_return_name).'</td>
			</tr>
			<tr>
				<td>2. Registration no. of the license</td>
				<td>'.strtoupper($work_return_reg).'</td>	
			</tr>
			<tr>
				<td>3. Class of the license</td>
				<td>'.strtoupper($work_return_clas).'</td>
			</tr>
			<tr>
				<td>4. License valid up-to</td>
				<td>'.strtoupper($work_return_valid).'</td>	
			</tr>
			<tr>
				<td>5. Period of return</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>From </td>
							<td>'.strtoupper($work_return_from).'</td>
						</tr>
						<tr>
							<td>To </td>
							<td>'.strtoupper($work_return_to).'</td>
						</tr>
					</table>
				</td>
			</tr>			
			<tr>
				<td colspan="2">6. Details of works and staff alloted therefore </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">			
					<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Referrence no. of FORM-C </th>
						<th>Name & description of the work with address </th>
						<th>Name of the entrusted with regd. no. of the certificates of competency  </th>
						<th>Name of the workmen entrusted with regd. no. of the permits </th>
						<th>Name of the apprentices deployed </th>
						<th>Date of completion  </th>
						<th>Reference & date of test report</th>
						<th>Report submitted to  </th>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_enclosure5 WHERE form_id='$form_id'");
							while($row_1=$part1->fetch_array()){
							$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["sl_no"]).'</td>
								<td>'.strtoupper($row_1["ref_no"]).'</td>
								<td>'.strtoupper($row_1["address"]).'</td>
								<td>'.strtoupper($row_1["certificate"]).'</td>
								<td>'.strtoupper($row_1["workman"]).'</td>
								<td>'.strtoupper($row_1["apprentice"]).'</td>
								<td>'.strtoupper($row_1["dt_of_com"]).'</td>
								<td>'.strtoupper($row_1["test_report"]).'</td>
								<td>'.strtoupper($row_1["report"]).'</td>
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
				<td align="right"> <strong>'.strtoupper($key_person).'</strong><br/>Signature of the Contractor</td>				
			</tr>	
		</table>';
?>