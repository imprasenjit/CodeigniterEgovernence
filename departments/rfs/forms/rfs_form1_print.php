<?php 
$dept="rfs";
$form="1";
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
		$firm_duration=$results["firm_duration"];$business_nature=$results["business_nature"];$po_name=$results["po_name"];$ps_name=$results["ps_name"];$is_different=$results["is_different"];$o_land_type=$results["o_land_type"];
			
		if($firm_duration=='U') $firm_duration="Unlimited";
		else  $firm_duration="Limited";
		if($is_different=='Y') $is_different="YES";
		else  $is_different="NO";
		if($o_land_type=='O') $o_land_type="Owned Premises";
		else if($o_land_type=='L') $o_land_type="Leased Premises";
		else $o_land_type="Rented Premises";
		if(!empty($results["other_address"])){
			$other_address=json_decode($results["other_address"]);
			$other_address_mouza=$other_address->mouza;$other_address_circle=$other_address->circle;$other_address_patta_no=$other_address->patta_no;$other_address_dag_no=$other_address->dag_no;$other_address_dag_no=$other_address->dag_no;$other_address_area_no=$other_address->area_no;$other_address_loc=$other_address->loc;$other_address_vill=$other_address->vill;$other_address_po=$other_address->po;$other_address_ps=$other_address->ps;$other_address_dist=$other_address->dist;$other_address_pincode=$other_address->pincode;
		}else{
			$other_address_mouza="";$other_address_circle="";$other_address_patta_no="";$other_address_dag_no="";$other_address_area_no="";$other_address_loc="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
		}
		if(!empty($results["reg_deed"])){
			$reg_deed=json_decode($results["reg_deed"]);
			$reg_deed_no=$reg_deed->no;$reg_deed_dte=$reg_deed->dte;$reg_deed_place=$reg_deed->place;
		}else{
			$reg_deed_no="";$reg_deed_dte="";$reg_deed_place="";
		}	
		if(!empty($results["tax"])){
			$tax=json_decode($results["tax"]);
			$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
		}else{
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
	}
	$q1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
	$results1=$q1->fetch_assoc();
	if($q1->num_rows>0){
		$form_id=$results1['form_id'];
		$member_address=$results1['member_address'];$date_f_joining=$results1['date_f_joining'];$upload_photo=$results1['upload_photo'];$upload_signature=$results1['upload_signature'];$upload_pan=$results1['upload_pan'];
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
				<td valign="top">1. Name of the Proposed Firm</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>  				
				<td valign="top">2. Nature of Business </td>
				<td>'.strtoupper($business_nature).'</td>
			</tr>
			<tr>  				
				<td valign="top">3. PAN </td>
				<td>'.strtoupper($pan_no).'</td>
			</tr>
			<tr>  				
				<td valign="top">4. Duration of the Firm </td>
				<td>'.strtoupper($firm_duration).'</td>
			</tr>
			<tr>  				
				<td valign="top">5.(a) Date of Establishment </td>
				<td>'.strtoupper($date_of_commencement).'</td>
			</tr>
			<tr>
				<td valign="top">5. Principle place of the proposed firm </td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
							<td>Own Land/Leased/Rented Premises</td>
							<td>'.strtoupper($land_type).'</td>
					</tr>
					<tr>
							<td>Mouza </td>
							<td>'.strtoupper($mouza).'</td>
					</tr>
					<tr>
							<td>Circle</td>
							<td>'.strtoupper($circle).'</td>
					</tr>
					<tr>
							<td>Patta No.</td>
							<td>'.strtoupper($patta_no).'</td>
					</tr>
					<tr>
							<td>Dag No.</td>
							<td>'.strtoupper($dag_no).'</td>
					</tr>
					<tr>
							<td>Area</td>
							<td>'.strtoupper($area).'</td>
					</tr>
					<tr>
							<td>Village/Town/City </td>
							<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
							<td>Post Office </td>
							<td>'.strtoupper($po_name).'</td>
					</tr>
					<tr>
							<td>Police Station</td>
							<td>'.strtoupper($ps_name).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
							<td>Pin Code </td>
							<td>'.strtoupper($b_pincode).'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">6. Does the proposed firm carry out its business in any other place apart from the registered office ? </td>
				<td>'.strtoupper($is_different).'</td>
			</tr>
			';
			if($is_different=="YES"){
			$printContents=$printContents.'	
			<tr>
				<td valign="top" >Address</td>
				<td >
				<table class="table table-bordered table-responsive">
					<tr>
							<td>Own Land/Leased/Rented Premises</td>
							<td>'.strtoupper($o_land_type).'</td>
					</tr>
					<tr>
							<td>Mouza </td>
							<td>'.strtoupper($other_address_mouza).'</td>
					</tr>
					<tr>
							<td>Circle</td>
							<td>'.strtoupper($other_address_circle).'</td>
					</tr>
					<tr>
							<td>Patta No.</td>
							<td>'.strtoupper($other_address_patta_no).'</td>
					</tr>
					<tr>
							<td>Dag No.</td>
							<td>'.strtoupper($other_address_dag_no).'</td>
					</tr>
					<tr>
							<td>Area</td>
							<td>'.strtoupper($other_address_area_no).'</td>
					</tr>
					<tr>
							<td>Locality </td>
							<td>'.strtoupper($other_address_loc).'</td>
					</tr>
					<tr>
							<td>Village/Town/City </td>
							<td>'.strtoupper($other_address_vill).'</td>
					</tr>
					<tr>
							<td>Post Office </td>
							<td>'.strtoupper($other_address_po).'</td>
					</tr>
					<tr>
							<td>Police Station</td>
							<td>'.strtoupper($other_address_ps).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($other_address_dist).'</td>
					</tr>
					<tr>
							<td>Pin Code </td>
							<td>'.strtoupper($other_address_pincode).'</td>
					</tr>
					</table>
				</td>
			</tr>';
			}$printContents=$printContents.'
			<tr>
				<td colspan="2">7. Name in full and permanent address of all the partners of the firm alongwith the date of joining, their passport size photograph and scanned copy of signature of each partner:</td>
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
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_object()){
						
						if($rows->date_f_joining !="" && $rows->date_f_joining !="0000-00-00") $date_of_joining=date("d-m-Y",strtotime($rows->date_f_joining));
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
				<td colspan="2">8. Registered Deed of Partnership </td>
			</tr>
			<tr>
					<td>Deed No.</td>
					<td>'.strtoupper($reg_deed_no).'</td>
			</tr>
			<tr>
					<td>Date </td>
					<td> '.strtoupper($reg_deed_dte).'</td>
			</tr>
			<tr>
					<td>Place of Deed Registration  </td>
					<td> '.strtoupper($reg_deed_place).'</td>
			</tr>
			<tr>
				<td colspan="2">9. Certificate of Sales Tax and Income Tax</td>
			</tr>
			<tr>
					<td>Certificate No.</td>
					<td> '.strtoupper($tax_certificate_no).'</td>
			</tr>
			<tr>
					<td>Issued by</td>
					<td> '.strtoupper($tax_certificate_issue).'</td>
			</tr>
			<tr>
					<td>Date of Issue</td>
					<td> '.strtoupper($tax_issuedate).'</td>
			</tr>';
		
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