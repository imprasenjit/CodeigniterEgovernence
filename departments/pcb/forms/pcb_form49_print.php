<?php
$dept="pcb";
$form="49";
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
	$land_premises=$results["land_premises"];
	$natio_nality=$results["natio_nality"];/*$l_o_business_val=$results["l_o_business_val"];*/$survey_no=$results["survey_no"];$khasra_no=$results["khasra_no"];$approximate_date=$results["approximate_date"];$expected_date=$results["expected_date"];$total_no_employee=$results["total_no_employee"];$is_licence=$results["is_licence"];  $is_licence_details=$results["is_licence_details"];$person_authorised=$results["person_authorised"];$licence_annual_capacity=$results["licence_annual_capacity"];
	$dome_stic=$results["dome_stic"];$indus_trial=$results["indus_trial"];$quality_of_effluent=$results["quality_of_effluent"];$monitoring_arrangemen=$results["monitoring_arrangemen"];$is_treatment_plant=$results["is_treatment_plant"];$investment_cost=$results["investment_cost"];
	
	if(!empty($results["wc_values"])){
		$wc_values=json_decode($results["wc_values"]);
		$wc_values_a=$wc_values->a;$wc_values_b=$wc_values->b;$wc_values_c=$wc_values->c;$wc_values_d=$wc_values->d;$wc_values_e=$wc_values->e;
	}else{
		$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";
	}
	if(!empty($results["sold_wastes"])){
		$sold_wastes=json_decode($results["sold_wastes"]);
		$sold_wastes_a=$sold_wastes->a;$sold_wastes_b=$sold_wastes->b;$sold_wastes_c=$sold_wastes->c;$sold_wastes_d=$sold_wastes->d;
	}else{
		$sold_wastes_a="";$sold_wastes_b="";$sold_wastes_c="";$sold_wastes_d="";
	}
	if($is_licence=="Y") $is_licence="YES";
	    else $is_licence="NO";
	if($is_treatment_plant=="Y") $is_treatment_plant="YES";
	    else $is_treatment_plant="NO";
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
        '.$assamSarkarLogo.'<h4><h4>'.$form_name.'</h4>
	</div><br/>
	<table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2">To,<br/> The Member Secretary, Central Pollution Control Board.</td>
		</tr>
		<tr>
			<td colspan="2">Sir,<br/> I/We hereby apply for Consent/Renewal of Consent under section 25 of the Water (Prevention and Control of Pollution) Act, 1974 (6 of 1974) for establishing or taking any steps for establishment of Industry/operation process or any treatment/disposal system to bring into use any new/altered outlet for discharge of *sewage/trade effluent* to continue to discharge* sewage/trade effluent* from land/premises owned by  '.strtoupper($land_premises).'</td>			
		</tr>
		<tr>
			<td colspan="2">1. Name, Designation and Address with telephone,e-mail of the Applicant :</td>
		</tr>
		<tr>
			<td width="50%">1. Full Name of the applicant</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>2. Nationality of the applicant</td>
			<td>'.strtoupper($natio_nality).'</td>
		</tr>
		<tr>
			<td>3. Select the appropriate category of business :</td>
			<td>'.strtoupper($l_o_business_val).'</td>
		</tr>
		<tr>
			<td colspan="2">4. Name, Address and Telephone Nos. of Applicant.</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th width="5%">Sl. No.</th>
							<th width="25%">Partners/Directors Name</th>
							<th width="20%">Street Name 1</th>
							<th width="15%">Street Name 2</th>
							<th width="15%">Village/Town</th>
							<th width="10%">District</th>
							<th width="10%">Pincode</th>
						</tr>
					</thead>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
					<tr align="center">
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->name).'</td>
						<td>'.strtoupper($rows->sn1).'</td>
						<td>'.strtoupper($rows->sn2).'</td>
						<td>'.strtoupper($rows->vill).'</td>
						<td>'.strtoupper($rows->dist).'</td>
						<td>'.strtoupper($rows->pin).'</td>
					</tr>';
						$sl++;
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td>5. Address of the Industry </td>
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
						<td>Vill/Town</td>
						<td>'.strtoupper($vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($dist).'</td>
				</tr>
				<tr>
						<td >Pincode</td>
						<td>'.strtoupper($pincode).'</td>
				</tr>
				<tr>
						<td>Mobile</td>
						<td>+91'.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
						<td>Email Id</td>
						<td>'.$email.'</td>
				</tr>
				<tr>
						<td>Survey No </td>
						<td>'.$survey_no.'</td>
				</tr>
				<tr>
						<td>Khasra No </td>
						<td>'.$khasra_no.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">6. Details of commissioning etc.:- </td>
		</tr>
		<tr>
			<td>(a) Approximate date of proposed commissioning of work.</td>
			<td>'.strtoupper($approximate_date).'</td>
		</tr>
		<tr>
			<td>(b) Expected date of production.</td>
			<td>'.strtoupper($expected_date).'</td>
		</tr>
		<tr>
			<td>Gross capital investment of the unit without depreciation till the date of application(Cost of building, land,plant and machinery)</td>
			<td>Rs. '.strtoupper($investment_cost).'.00</td>							
		</tr>
		<tr>
			<td>7. Total number of employee expected to employed.</td>
			<td>'.strtoupper($total_no_employee).'</td>
		</tr>
		<tr>
			<td>8.  Details  of  licence,  if  any  obtained  under  the  provisions  of  Industrial  Development Regulations Act, 1951.</td>
			<td>'.strtoupper($is_licence).'</td>
		</tr>
		<tr>
			<td>(b) If yes, please give details.</td>
			<td>'.strtoupper($is_licence_details).'</td>
		</tr>
		<tr>
			<td>9.  Name  of  the  person  authorised  to  sign  this  form  (the  original  authorisation  except  in  the case of individual proprietary concern is to be enclosed).</td>
			<td>'.strtoupper($person_authorised).'</td>
		</tr>
		<tr>
			<td>10. Licence Annual Capacity of the Factory/Industry.</td>
			<td>'.strtoupper($licence_annual_capacity).'</td>
		</tr>
		
		<tr>
		    <td>11.  State  daily  quantity  of  water  in  kilolitres  utilised  and  its  source  (domestic/industrial process boiler Cooling others) :</td>
			<td>
				<table class="table table-bordered table-responsive"> 
				<tr>
						<td>(i) Industrial process</td>
						<td>'.strtoupper($wc_values_a).'</td>
				</tr>
				<tr>
						<td>(ii) Domestic purpose</td>
						<td>'.strtoupper($wc_values_b).'</td>
				</tr>
				<tr>
						<td>(iii) Boiler</td>
						<td>'.strtoupper($wc_values_c).'</td>
				</tr>
				<tr>
						<td>(iv) Cooling</td>
						<td>'.strtoupper($wc_values_d).'</td>
				</tr>
				<tr>
						<td>(v) Others such as agriculture, gardening etc. (specify)</td>
						<td>'.strtoupper($wc_values_e).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr> 
			<td colspan="2">12. (a)  State  the  daily  maximum  quantity  of  effluents  quantity  and  mode  of  disposal (sewer  or  drains  or  river).  Also  attach  analysis  report  of  the  effluents. Type  of effluent quantity in kilolitres Mode of disposal.</td> 
		</tr>
		<tr>
			<td>(i) Domestic</td>
			<td>'.strtoupper($dome_stic).'</td>
		</tr>
		<tr>
			<td>(ii) Industrial</td>
			<td>'.strtoupper($indus_trial).'</td>
		</tr>
		<tr> 
			<td colspan="2">Attach  analysis  report  of  the  effluents.</td> 
		</tr>
		<tr>
			<td>(b) Quality of effluent currently being the discharged or expected to be discharged .</td>
			<td>'.strtoupper($quality_of_effluent).'</td>
		</tr>
		<tr>
			<td>(c) What monitoring arrangement is currently there or proposed .</td>
			<td>'.strtoupper($monitoring_arrangemen).'</td>
		</tr>
		<tr>
			<td>13.  State  whether  you  have  any  treatment  plant  for  industrial,  domestic  or  combined effluents .</td>
			<td>'.strtoupper($is_treatment_plant).'</td>
		</tr>
		<tr>
			<td>14. State details of sold wastes generated in the process or during waste treatment :</td>
			<td>
				<table class="table table-bordered table-responsive"> 
				<tr>
						<td>Description</td>
						<td>'.strtoupper($sold_wastes_a).'</td>
				</tr>
				<tr>
						<td>Quantity</td>
						<td>'.strtoupper($sold_wastes_b).'</td>
				</tr>
				<tr>
						<td>Method </td>
						<td>'.strtoupper($sold_wastes_c).'</td>
				</tr>
				<tr>
						<td>Method of disposal</td>
						<td>'.strtoupper($sold_wastes_d).'</td>
				</tr>				
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">15.  I/We  further  declare  that  the  information  furnished  above  is  correct  to  the  best  of  my/our knowledge.  </td>
		</tr>
		<tr>
			<td colspan="4">16.  I/We  hereby  submit  that  in  case  of  change  either  of  the  point  of  discharge  or  the quantity of discharge  or its quality a  fresh application for CONSENT shall be  made and until such CONSENT is granted no change shall be made.    </td>
		</tr>
		<tr>
			<td colspan="4">17.  I/We  hereby  agree  to  submit  to  the  Central  Board  an  application  for  renewal  of consent  one  month  in  advance  of  the  date  of  expiry  of  the  consented  period  for outlet/discharge if to be continued thereafter.  </td>
		</tr>
		<tr>
			<td colspan="4">18. I/We, undertake to furnish any other information within one month or its being called by the Central Board.  </td>
		</tr>
		';				
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Place : '.strtoupper($dist).'<br/> Date : '.$today.'</td>
					<td align="right">Yours faithfully,<br/>
						Name : '.strtoupper($key_person).'<br/>
						Designation : '.strtoupper($status_applicant).'
					</td>
				</tr>
			</table>	
			</td>
		</tr>      
</table>
 ';
?>