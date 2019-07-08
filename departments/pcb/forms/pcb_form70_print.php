<?php
$dept="pcb";
$form="70";
$table_name=getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and active='1' and form_id=form_id");
}
	
	
	if($q->num_rows > 0){
        $results=$q->fetch_array();		
		$form_id=$results['form_id'];
		$issuance_dt=$results['issuance_dt'];$ref_no=$results['ref_no'];$description_management=$results['description_management'];$environmental_dt=$results['environmental_dt'];
		
		
		 if(!empty($results["facility"])){
				$facility=json_decode($results["facility"]);
				$facility_nm=$facility->nm;$facility_st1=$facility->st1;$facility_st2=$facility->st2;$facility_vill=$facility->vill;$facility_dist=$facility->dist;$facility_pin=$facility->pin;$facility_mob=$facility->mob;$facility_email=$facility->email;
		  }else{
				$facility_nm="";$facility_st1="";$facility_st2="";$facility_vill="";$facility_dist="";$facility_pin="";$facility_mob="";$facility_email="";
         }	
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
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
		<br>
		<table class="table table-bordered table-responsive">
		<tbody>			
				
		
		<tr>  				
			<td width="50%">1.Name and address of the facility :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">Name of the facility</td> 
						<td>'.strtoupper($facility_nm).'</td>
				</tr>
				<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($facility_st1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($facility_st2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($facility_vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($facility_dist).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($facility_pin).'</td>
				</tr>
				
				<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($facility_mob).'</td>
				</tr>
				<tr>
						<td>Email-id</td>
						<td>'.$facility_email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"> 2.Date of issuance of authorisation and its reference number</td>
		</tr>
		<tr>
			<td>Date of issuance </td>
			<td>'.strtoupper($issuance_dt).'  </td>
		</tr>
		<tr>
			<td>Reference number</td>
			<td>'.strtoupper($ref_no).'    </td>
		</tr>					
		<tr>
			<td colspan="2">3. Description of hazardous and other wastes handled (Generated or Received)</td>
        </tr>
        <tr>		
			<td colspan="2"><b>(a) For indigenous </b>
			<table class="table table-bordered table-responsive">
			<tr>
				<th>Slno</th>
				<th>Date</th>
				<th>Type of waste with category as per Schedules I, II and III of these rules</th>
				<th>Total quantity (MetricTonnes)</th>
				<th>Method of Storage</th>
				<th>Destined to or received from</th>
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.$row_1["date"].'</td>
						<td>'.strtoupper($row_1["waste_category"]).'</td>
						<td>'.strtoupper($row_1["tot_quantity"]).'</td>
						<td>'.strtoupper($row_1["method_storage"]).'</td>
						<td>'.strtoupper($row_1["received"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table>  </td>
		</tr>
		<tr>		
			<td colspan="2"><b>(b) For imported waste </b>
			<table class="table table-bordered table-responsive">
			<tr>
				<th>Slno</th>
				<th>Date</th>
				<th>Type of waste with category as per Schedules I, II and III of these rules</th>
				<th>Total quantity (MetricTonnes)</th>
				<th>Method of Storage</th>
				<th>Destined to or received from</th>
			</tr>';
			
			$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.$row_2["date"].'</td>
						<td>'.strtoupper($row_2["waste_category"]).'</td>
						<td>'.strtoupper($row_2["tot_quantity"]).'</td>
						<td>'.strtoupper($row_2["method_storage"]).'</td>
						<td>'.strtoupper($row_2["received"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table>  </td>
		</tr>  							
		<tr>
			<td>4. Date wise description of management of hazardous and other wastes including products sent and to whom in case of recyclers or pre-processor or utiliser</td>	
			<td>'.strtoupper($description_management).' </td>
		</tr>      							
		<tr>
			<td>5. Date of environmental monitoring (as per authorisation or guidelines of Central Pollution Control Board)</td>	
			<td>'.strtoupper($environmental_dt).' </td>
		</tr> 				
		
		';	
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
			
				
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="right">Signature of Applicant :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>	
			<tr>
				<td>Place : <strong>'.strtoupper($dist).'</strong></td>						
				<td align="right"> Designation :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>						
		</table>';
		
?>

