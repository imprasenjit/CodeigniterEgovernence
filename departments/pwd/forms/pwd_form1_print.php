<?php
$dept="pwd";
$form="1";
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
		$form_id=$results['form_id'];	
		$uni_identification_no=$results['uni_identification_no'];
		
		if(!empty($results["road_details"])){
			$road_details=json_decode($results["road_details"]);
			$road_details_road_name=$road_details->road_name;$road_details_vill=$road_details->vill;$road_details_mouza=$road_details->mouza;$road_details_revenue_circle=$road_details->revenue_circle;$road_details_dist=$road_details->dist;
		}else{
			$road_details_road_name="";$road_details_vill="";$road_details_mouza="";$road_details_revenue_circle="";
			$road_details_dist="";
		}
		
		$road_width=$results['road_width'];$overhead_type=$results['overhead_type'];$license_no=$results['license_no'];$licensee_name=$results['licensee_name'];
		
		if(!empty($results["cost_of_cutting"])){
			$cost_of_cutting=json_decode($results["cost_of_cutting"]);
			$cost_of_cutting_rep=$cost_of_cutting->rep;
		}else{
			$cost_of_cutting_rep="";
		}
		if($cost_of_cutting_rep=="factory_owner"){
			$cost_of_cutting_rep_value="Factory Owner";
		}elseif($cost_of_cutting_rep=="industries_department"){
			$cost_of_cutting_rep_value="Industries Department (in case of Industrial Areas)";
		}else{
			$cost_of_cutting_rep_value="";
		}
		if(!empty($results["permission"])){
			$permission=json_decode($results["permission"]);
			if(isset($permission->a)) $permission_a=$permission->a; else $permission_a="";
			if(isset($permission->b)) $permission_b=$permission->b; else $permission_b="";
			
		}else{
			$permission_a="";$permission_b="";
		}
		
      //permission//
		$permission_values="";
	  
		if($permission_a=="D") $permission_values=$permission_values. '<span class="tickmark">&#10004;</span> Draw overhead lines&nbsp;&nbsp;&nbsp;&nbsp;';
		if($permission_b=="C") $permission_values=$permission_values. '<span class="tickmark">&#10004;</span> Cutting of road for underground cable(s)&nbsp;&nbsp;&nbsp;&nbsp;';	
		
	}
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
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2"><b>ENTERPRISE DETAILS </b></td>
			</tr>
			<tr>				
				<td width="50%">1. Name of the Enterprise :</td>
				<td  width="50%">'.strtoupper($unit_name).'</td>
			</tr>
			<tr>				
				<td width="50%">2. Unique Business Identification Number :</td>
				<td  width="50%">'.strtoupper($uni_identification_no).'</td>
			</tr>
			
			<tr>
						<td width="50%" valign="top">3. Address of the Registered Office of the Enterprise :</td>
						<td width="50%">
							<table class="table table-bordered table-responsive">
							    
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
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($pincode).'</td>
								</tr>
								<tr>
									<td width="50%">Mobile No :</td>
									<td>'.strtoupper($mobile_no).'</td>
								</tr>
							</table>
						</td>
			</tr>
			<tr>
						<td width="50%" valign="top">4. Address of the Unit (in relation to which Right Way is sought) :</td>
						<td width="50%">
							<table class="table table-bordered table-responsive">
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
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($b_pincode).'</td>
								</tr>
								<tr>
									<td width="50%">Mobile No. :</td>
									<td>'.strtoupper($b_mobile_no).'</td>
								</tr>
								
							</table>
						</td>
			</tr>
			<tr>
				<td colspan="2"><b>APPLICANT DETAILS </b></td>
									     
			</tr>
			<tr>
				<td>1. Name of the Proprietor / Authorized Partner / Authorized Director :</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td>2.  Designation of the Applicant :</td>
				<td>'.strtoupper($status_applicant).'</td>
			</tr>
			<tr>
							<td width="50%" valign="top">3. Address of the Applicant  :</td>
							<td width="50%">
							<table class="table table-bordered table-responsive">
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
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($b_pincode).'</td>
								</tr>
								
								
							</table>
							</td>
					</tr>
			<tr>
				<td width="50%">4. Mobile No. :</td>
				<td>'.strtoupper($b_mobile_no).'</td>
			</tr>
			<tr>
				<td width="50%">5. Email ID of the Applicant :</td>
				<td>'.$email.'</td>
			</tr>
			<tr>
				<td colspan="2"><b>OTHER DETAILS </b></td>
			</tr>
			<tr>
				<td width="50%">1. "Right of Way" Permission to :</td>
				<td>' . $permission_values . '</td>
			</tr>
			<tr>
			<td colspan="2">2. Details of the road :
				<table class="table table-bordered table-responsive">
					<thead>
						
					</thead>
					<tbody>
						<tr>
							<td>1.</td>
							<td>Road Name  /  Road No</td>
							<td>'.strtoupper($road_details_road_name).'</td>
						</tr>
						<tr>
							<td>2.</td>
							<td>Village   /  Ward No.</td>
							<td>'.strtoupper($road_details_vill).'</td>
						</tr>
						<tr>
							<td>3.</td>
							<td>Mouza</td>
							<td>'.strtoupper($road_details_mouza).'</td>
						</tr>
						<tr>
							<td>4.</td>
							<td>Revenue Circle</td>
							<td>'.strtoupper($road_details_revenue_circle).'</td>
						</tr>
						<tr>
							<td>5.</td>
							<td>District</td>
							<td>'.strtoupper($road_details_dist).'</td>
						</tr>
						</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>3. Width of the road :</td>
			<td>'.strtoupper($road_width).'</td>
		</tr>	
		<tr>
			<td>4. Type of Overhead Line / Underground Cable / laid :</td>
			<td>'.strtoupper($overhead_type).'</td>
		</tr>	
		<tr>
			<td colspan="2">5. License No. and name of Licensee Contractor to be engaged for road cutting :</td>
		</tr>
		<tr>
			<td>License No. :</td>
			<td>'.strtoupper($license_no).'</td>
		</tr>
		<tr>
			<td>Name of Licensee Contractor :</td>
			<td>'.strtoupper($licensee_name).'</td>
		</tr>
		<tr>
			<td>6. Cost of cutting & repairing to be borne by  :</td>
			<td>'.strtoupper($cost_of_cutting_rep_value).'</td>
		</tr>		
			
		<tr>
            <td colspan="2" align="center"><strong>Undertaking</strong></td> 
        </tr>
			<tr>
				<td colspan="2">We hereby declare that the above furnished information furnished by us is true to our knowledge and any loss suffered due to granting of right of way will be borne by the applicant.</td>
			</tr>
			';
			
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		<tr>
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
               </td>
        </tr>        
	</table>';
?>