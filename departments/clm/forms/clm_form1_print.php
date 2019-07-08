<?php 
$dept="clm";
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
	$nature=$results['nature'];$monogram=$results['monogram'];$tools=$results['tools'];$workshop=$results['workshop'];$facilities =$results['facilities'];$elect_energy =$results['elect_energy'];$is_loan_detail =$results['is_loan_detail'];$reg_number =$results['reg_number'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];$is_proposed =$results['is_proposed'];$approval =$results['approval'];$inspection =$results['inspection'];$bankers =$results['bankers'];$total_turnover=$results['total_turnover'];
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
		if(!empty($results["type"]))
		{
			$type=json_decode($results["type"]);
			$type_weight=$type->weight;$type_measures=$type->measures;$type_instrument=$type->instrument;$type_details=$type->details;
		}else{
			$type_weight="";$type_measures="";$type_instrument="";$type_details="";
		}	
		if(!empty($results["persons"]))
		{
			$persons=json_decode($results["persons"]);
			$persons_skill=$persons->skill;$persons_semi_skill=$persons->semi_skill;$persons_unskill=$persons->unskill;$persons_trained=$persons->trained;
		}else{
			$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
		}	
		if($is_applied!='N'){$is_applied='Yes';} else $is_applied='No';
		if($is_proposed=="W"){
			$is_proposed="Within the State";
		} else if ($is_proposed=="O"){
			$is_proposed="Outside the State";
		}else if ($is_proposed=="B"){
			$is_proposed="Both";
		}
		
	}
		
	$tools = wordwrap($results["tools"], 40, "<br/>", true);
	$workshop = wordwrap($results["workshop"], 40, "<br/>", true);
	$is_loan_detail = wordwrap($results["is_loan_detail"], 40, "<br/>", true);
	$approval = wordwrap($results["approval"], 40, "<br/>", true);
	
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
	<div style="text-align:center">'.$assamSarkarLogo.'<h4>'.$form_name.'</h4></div><br/>
     <table class="table table-bordered table-responsive">
  		<tr>  				
			<td valign="top" width="50%">1. Name of the manufacturing concern for which license is desired :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td valign="top">2. Complete address of the concern. Whether premises are owned/rented/ taken on lease/leave licence, duly supported by documents :</td>
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
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">3. Date of Establishment of workshop/factory :</td>
			<td valign="top"> '.date('d-m-Y',strtotime($date_of_commencement)).'</td>
		</tr>
		<tr>
			<td colspan="2">4.  Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
						<tr>
							<td>Sl No.</td>
							<td>Name</td>
							<td>Father &apos;s/Spouse&apos;s Name</td>
							<td>Address</td>
							<td>Pincode</td>
							<td>Contact No</td>
						</tr>';
						$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
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
							$sl++;
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td width="50%">5. The date and current registration number of factory/shop/ establishment/Municipal Trade licence :</td>
			<td width="50%">'.strtoupper($fact_reg_date).','.strtoupper($fact_reg_no).'</td>
		</tr>
		<tr>
			<td>6. Nature of manufacturing activities at present :</td>
			<td>'.strtoupper($nature).'</td>
		</tr>
		<tr>
			<td>7. The type of weights and measures proposed to be manufactured viz :</td>
			<td>(i)Weights : '.strtoupper($type_weight).'<br/>(ii)Measures : '.strtoupper($type_measures).'<br/>(iii)Weighing Instruments : '.strtoupper($type_instrument).'<br/>(iv)Measuring Instruments with details in each case : '.strtoupper($type_details).'</td>
		</tr>
		<tr>
			<td>8. The number of persons employed/proposed to be employed :</td>
			<td>(i)Skilled : '.strtoupper($persons_skill).'<br/>(ii)Semi-skilled: '.strtoupper($persons_semi_skill).'<br/>(iii)Unskilled : '.strtoupper($persons_unskill).'<br/>(iv)Specialist trained in the line : '.strtoupper($persons_trained).'</td>
		</tr>
		<tr>
			<td>9. The monogram or trade mark intended to be Imprinted on weights and measures to be manufactured :</td>
			<td>'.strtoupper($monogram).'</td>
		</tr>
		<tr>
			<td>10. Details of machinery, tools accessories, owned and used for manufacturing weights measures etc :</td>
			<td>'.strtoupper($tools).'</td>
		</tr>
		<tr>
			<td>11. Details of foundry/workshop facilities arranged Whether ownership, long term lease etc :</td>
			<td>'.strtoupper($workshop).'</td>
		</tr>
		<tr>
			<td>12. Facilities of steel casting and hardness testing of vital parts etc or other means :</td>
			<td>'.strtoupper($facilities).'</td>
		</tr>
		<tr>
			<td>13. Availability of electric energy :</td>
			<td>'.strtoupper($elect_energy).'</td>
		</tr>
		<tr>
			<td>14.  Details of loan received from Government or financial Institution. If so, give details. :</td>
			<td>'.strtoupper($is_loan_detail).'</td>
		</tr>
		<tr>
			<td>15. Name of bankers, if any.  : </td>
			<td>'.strtoupper($bankers).'</td>
		</tr>
		<tr>
			<td>16. VAT/Sales Tax Registration Number/CST Number/Professional Tax registration Number/IT Number : </td>
			<td>'.strtoupper($reg_number).'</td>
		</tr>
		<tr>
			<td>Total value of transactions / turnover : </td>
			<td>'.strtoupper($total_turnover).'</td>
		</tr>
		<tr>
			<td>17. Have you applied previously for a manufacture’s  licence? If so, when and with what results?  : </td>
			<td>'.strtoupper($is_applied).'&nbsp;&nbsp;'.strtoupper($is_applied_details).'</td>
		</tr>
		<tr>
			<td>18. (a) Whether the item(s) proposed to be manufactured will be sold within the State or outside the State or both : </td>
			<td>'.strtoupper($is_proposed).'</td>
		</tr>
		<tr>
			<td>(b) Details of Model Approval received from Government of India : </td>
			<td>'.strtoupper($approval).'</td>
		</tr>
		<tr>
			<td>(c) When can you produce for inspection samples of your products which licence is desired? : </td>
			<td>'.strtoupper($inspection).'</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
			<h4>To be certified by the applicant(s)</h4>
			<br/>Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under. <br/> <br/>
			I/ We agree to deposit the Scheduled licence fees with Government as soon as required to do so by the Licencing Authority.<br/><br/> All the information furnished above is true to the best of my/ our knowledge.</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'      
		<tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
			<td align="center">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
		</tr>
	</table>';

?>
