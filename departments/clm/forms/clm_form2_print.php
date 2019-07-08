<?php
$dept="clm";
$form="2";
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
	$is_lease_doc=$results['is_lease_doc'];$area=$results['area'];$previous=$results['previous'];$machinery=$results['machinery'];$elect_energy =$results['elect_energy'];$sufficient =$results['sufficient'];$reg_number =$results['reg_number'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];$total_turnover=$results['total_turnover'];
		if(!empty($results["fact"]))
		{
			$fact=json_decode($results["fact"]);
			$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
		}else{
			$fact_reg_date="";$fact_reg_no="";
		}
		if($fact_reg_date!="" && $fact_reg_date!="0000-00-00"){
			$fact_reg_date = date('d-m-Y',strtotime($fact_reg_date));
		}else{
			$fact_reg_date="";
		}	
		if(!empty($results["persons"]))
		{
			$persons=json_decode($results["persons"]);
			$persons_skill=$persons->skill;$persons_semi_skill=$persons->semi_skill;$persons_unskill=$persons->unskill;$persons_trained=$persons->trained;
		}else{
			$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
		}		
		if($is_applied!='N'){$is_applied='Yes';} else $is_applied='No';
		if($is_lease_doc=="O"){
			$is_lease_doc="Owned";
		} else if ($is_lease_doc=="R"){
			$is_lease_doc="Rented";
		}else if ($is_lease_doc=="T"){
			$is_lease_doc="Taken on lease";
		}
		if(!empty($results["weights_measure"]))
		{
			$weights_measure=json_decode($results["weights_measure"]);
			$weights_measure_w=$weights_measure->w;$weights_measure_m=$weights_measure->m;$weights_measure_wi=$weights_measure->wi;$weights_measure_mi=$weights_measure->mi;
		}else{
			$weights_measure_w="";$weights_measure_m="";$weights_measure_wi="";$weights_measure_mi="";
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
		<div style="text-align:center">'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
     <table class="table table-bordered table-responsive">
  		<tr>  				
			<td valign="top" width="50%">1. Name of the manufacturing concern seeking the license :</td>
    	<td style="width:50%">'.strtoupper($unit_name).'</td>
	</tr>
   <tr>
  		<td valign="top">2. Complete address of the workshop. :</td>
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td width="50%">Street Name 1</td>
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
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td>'.$b_email.'</td>
      		</tr>
    		</table></td>
  	</tr>
  	<tr>
  		<td valign="top">3. (a) Whether premises are owned /rented / taken on lease duly supported by documents :</td>
  		<td valign="top"> '.strtoupper($is_lease_doc).'</td>
  	</tr>
  	<tr>
  		<td valign="top">(b) Date of Establishment :</td>
  		<td valign="top"> '.date('d-m-Y',strtotime($date_of_commencement)).'</td>
  	</tr>
	<tr>
		<td colspan="2" >4. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
				<tr>
					<td>Sl No.</td>
					<td>Name</td>
					<td>Family Name</td>
					<td>Address</td>
					<td>Pincode</td>
					<td>Contact No</td>
				</tr>';
				$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$clm->error);
				$sl=1;
				while($rows=$results1->fetch_object()){
					$printContents=$printContents.'
					<tr>
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->name).'</td>
						<td>'.strtoupper($rows->family_name).'</td>
						<td>'.strtoupper($rows->address).'</td>
						<td>'.strtoupper($rows->pincode).'</td>
						<td>'.strtoupper($rows->contact).'</td>
					</tr>';
					$sl++;}	
				$printContents=$printContents.'
			</table>
			</td>
		</tr>
	<tr>
		<td>5. Number and date of shop/ establishment/ current Municipal Trade Licence. :</td>
		<td>'.strtoupper($fact_reg_date).'&nbsp;'.strtoupper($fact_reg_no).'</td>
	</tr>
	<tr>
		<td>6. Professional Tax/ IT Tax registration Number etc if any :</td>
		<td>'.strtoupper($reg_number).'</td>
	</tr>
	<tr>
	   <td>Total value of transactions / turnover :</td>
	   <td>'.strtoupper($total_turnover).'</td>
	</tr>
	<tr>
		<td>7. The type of weights and measures proposed to be repaired. :</td>
		<td>(i)Weights : '.strtoupper($weights_measure_w).'<br/>(ii)Measures : '.strtoupper($weights_measure_m).'<br/>(iii)Weighing Instruments : '.strtoupper($weights_measure_wi).'<br/>(iv)Measuring Instruments with details in each case : '.strtoupper($weights_measure_mi).'</td>
	</tr>
	<tr>
		<td>8. Area in which you wish to operate. :</td>
		<td>'.strtoupper($area).'</td>
	</tr>
	<tr>
		<td>9. Previous experience in the line :</td>
		<td>'.strtoupper($previous).'</td>
	</tr>
	<tr>
		<td>10. The number of persons employed/proposed to be employed :</td>
		<td>(i)Skilled : '.strtoupper($persons_skill).'<br/>(ii)Semi-skilled: '.strtoupper($persons_semi_skill).'<br/>(iii)Unskilled : '.strtoupper($persons_unskill).'<br/>(iv)Specialist trained in the line : '.strtoupper($persons_trained).'</td>
	</tr>
	<tr>
		<td>11. Details of machinery/ tools/ accessories available :</td>
		<td>'.strtoupper($machinery).'</td>
	</tr>
	<tr>
		<td>12. Availability of electric energy :</td>
		<td>'.strtoupper($elect_energy).'</td>
	</tr>
	<tr>
		<td>13. Have you sufficient stock of loan/test weights, etc.Give details. :</td>
		<td>'.strtoupper($sufficient).'</td>
	</tr>
	<tr>
		<td>14. Have you applied previously for a repairer’s licence.If, so When and with what results? </td>
		<td>'.strtoupper($is_applied).' '.strtoupper($is_applied_details).'</td>
	</tr>
			
	<tr >
		<td colspan="2" align="center">
  		<h4>To be certified by the applicant(s)</h4>
		<p style="float:left;"><br/>Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under. <br/> <br/>
		I/ We agree to deposit the Scheduled licence fees with Government as soon as required to do so by the Licencing Authority.
		<br/><br/> All the information furnished above is true to the best of my/ our knowledge.<br/><br/></p>
		
		</td>
	</tr>
	';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'  
        <tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
			<td align="center">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
        </tr>
</table>';

?>
