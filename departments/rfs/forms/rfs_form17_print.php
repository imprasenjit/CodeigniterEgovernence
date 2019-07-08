<?php 
$dept="rfs";
$form="17";
$table_name=$formFunctions->getTableName($dept,$form);

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
		$form_id=$results["form_id"];
		$firm_duration=$results["firm_duration"];$regn_no=$results["regn_no"];$business_details=$results["business_details"];$is_different=$results["is_different"];$nature_busi=$results["nature_busi"];
		
		if($is_different=="Y"){
			$is_different="Yes";
		}else{
			$is_different="No";
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">
			<tr>  				
				<td>1.Regn. No </td>
				<td>'.strtoupper($regn_no).'</td>
			</tr>
			<tr>  				
				<td>2.Nature of business </td>
				<td>'.strtoupper($nature_busi).'</td>
			</tr>
			<tr>  				
				<td>3.Name of the firm</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>  				
				<td>4.Date of Establishment </td>
				<td>'.strtoupper($date_of_commencement).'</td>
			</tr>
			<tr>  				
				<td>5. Duration of the Firm </td>
				<td>'.strtoupper($firm_duration).'</td>
			</tr>
			<tr>  				
				<td>6. PAN card </td>
				<td>'.strtoupper($pan_no).'</td>
			</tr>
			<tr>  				
				<td>7. Principle place of business of the firm</td>
				<td>'.strtoupper($business_details).'</td>
			</tr>
			<tr>
				<td>8. Does the proposed firm carry out its business in any other place apart from the registered office?</td>
				<td>'.strtoupper($is_different).'</td>
			</tr>
			<tr>
				<td colspan="2">9. Changes in the constitution of the firm	 </td>
			</tr>
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
					   <tr>
						<th>Sl No.</th>
						<th>Full Name of partners</th>
						<th>Permanent Address</th>
						<th>Date of Joining</th>
						<th>Upload Photo</th>
						<th>Upload Signature</th>
						<th>Upload PAN</th>
					 </tr>
					</thead>
					<tbody>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_object()){
						
						if($rows->date_of_joining !="" && $rows->date_of_joining !="0000-00-00") $date_of_joining=date("d-m-Y",strtotime($rows->date_of_joining));
						else $date_of_joining="";
						
						if($rows->upload_photo !="") $upload_photo='<img style="padding:5px" width="110" height="140" src="'.$server_url.'departments/rfs/forms/upload/'.$rows->upload_photo .'"/>';
						else $upload_photo="";
						
						if($rows->upload_signature !="") $upload_signature='<img style="padding:5px" width="200" height="60" src="'.$server_url.'departments/rfs/forms/upload/'.$rows->upload_signature .'"/>';
						else $upload_signature="";
						
						if($rows->upload_pan !="") $upload_pan='<a href="'.$upload.$rows->upload_pan .'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View </a>';
						else $upload_pan="";
						
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows->member_name).'</td>
							<td>'.strtoupper($rows->member_address).'</td>
							<td>'.$date_of_joining.'</td>
							<td>'.$upload_photo .'</td>
							<td>'.$upload_signature .'</td>
							<td>'.$upload_pan.'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'</tbody>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">10.Alteration in the name of the firm or in the location of the Pricipal place of business thereof</td>
			</tr>
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
					<tr>
						<th></th>
						<th colspan="2"><h4><b>Name of the firm	</h4></b></th>
						<th colspan="5"><h4><b>Principal place of business	</h4></b></th>
					</tr>
					<tr>
						<th>Sl No.</th>
						<th>Date of alteration</th>
						<th>Former Name</th>
						<th>Present Name</th>
						<th>Former Address</th>
						<th>Present Address</th>
					</tr>
					';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_object()){
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.$rows->date_alteration.'</td>
							<td>'.strtoupper($rows->former_name).'</td>
							<td>'.strtoupper($rows->present_name).'</td>
							<td>'.strtoupper($rows->former_address).'</td>
							<td>'.strtoupper($rows->present_address).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
				</table>
				</td>
			</tr>
			
			
			 ';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
			
			<tr>
				<td width="50%"> Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
				<td align="right">
					<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
				</td>
			</tr>
		</table>
		';
?>