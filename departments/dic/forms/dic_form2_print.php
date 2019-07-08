<?php 
$dept="dic";
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
		$power=$results['power'];$raw_meterial=$results['raw_meterial'];
		##### Part A #######
		if(!empty($results["ack"])){
			$ack=json_decode($results["ack"]);
			$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_lic_no=$ack->lic_no;
		}else{
			$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
		}
		if($ack_pm_dt!="" && $ack_pm_dt!="0000-00-00"){
			$ack_pm_dt = date('d-m-Y',strtotime($ack_pm_dt));
		}else{
			$ack_pm_dt="";
		}
		if($ack_ind_dt!="" && $ack_ind_dt!="0000-00-00"){
			$ack_ind_dt = date('d-m-Y',strtotime($ack_ind_dt));
		}else{
			$ack_ind_dt="";
		}
		##### Part B #######
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
			$fixed_amount_land=$fixed_amount->land;$fixed_amount_site_dev=$fixed_amount->site_dev;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_tot="";$fixed_amount_ei="";
		}	
		if(!empty($results["proposed"])){
			$proposed=json_decode($results["proposed"]);
			$proposed_managerial=$proposed->managerial;$proposed_skilled=$proposed->skilled;$proposed_semi_skilled=$proposed->semi_skilled;$proposed_unskilled=$proposed->unskilled;$proposed_ss=$proposed->ss;$proposed_others=$proposed->others;
		}else{
			$proposed_managerial="";$proposed_skilled="";$proposed_unskilled="";$proposed_semi_skilled="";$proposed_ss="";$proposed_others="";
		}
		
	}
	$fixed_amount_tot="";$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";
	
    $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
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
			<td valign="top">1. (a) Name of the Industrial unit :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
  		<td valign="top">(b) Complete address with telephone No. : </td>
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
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td> '.$b_email.'</td>
      		</tr>
    		</table>
		</td>
	</tr>
	<tr>
  		<td valign="top">2. (a) Constitution of the unit  </td>
  		<td>'.strtoupper($Type_of_ownership).'</td>
  	</tr>
	<tr>
			<td colspan="2">(b) Name(s), address(es), of the Proprietor / Partners / Directors of Board of Directors / Secretary and  President of the Cooperative Society :
				<table class="table table-bordered table-responsive">
					<tr>
						<th>Sl. No.</th>
						<th>Partners/Directors Name</th>
						<th >Street Name 1</th>
						<th>Street Name 2</th>
						<th>Village/Town</th>
						<th>District</th>
						<th>Pincode</th>
					</tr>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_object()){
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows->name).'</td>
							<td>'.strtoupper($rows->sn1).'</td>
							<td>'.strtoupper($rows->sn2).'</td>
							<td>'.strtoupper($rows->v).'</td>
							<td>'.strtoupper($rows->d).'</td>
							<td>'.strtoupper($rows->p).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
				</table>
			</td>
	</tr>
	<tr>
			<td>3. Proposed date of commencement of commercial production of unit : </td>
			<td> '.date('d-m-Y',strtotime($date_of_commencement)).'</td>
	</tr>
	<tr>
			<td>4. Whether the industrial unit falls under Manufacturing sector OR Service sector  : </td>
			<td> '.strtoupper($business_type).'</td>
	</tr>
	<tr>
			<td colspan="2">5. Details of Registration with the concerned Department<br>(A) If Manufacturing Sector, please indicate : </td>
	</tr>
	<tr>
			<td>(i) Acknowledgement No. / Date of Entrepreneur Memorandum (EM), Part-1 (if any) of MSME : </td>
			<td> '.strtoupper($ack_pm_no).' '.strtoupper($ack_pm_dt).'</td>
	</tr>
	<tr>
			<td>(ii) Acknowledgement No. / Date of Industrial Entrepreneur Memorandum (EM) (if any) of DIPP : </td>
			<td>'.strtoupper($ack_ind_no).' '.strtoupper($ack_ind_dt).'</td>
	</tr>
	<tr>
			<td>(B) If Service Sector, please indicate requisite Registration / License No. from the concerned  Department (if any)  : </td>
			<td>'.strtoupper($ack_lic_no).'</td>
	</tr>
	<tr>
			<td colspan="2">6. Particulars / Details of Fixed Capital Investment proposed    (Amount in Rs.) : </td>
	</tr>
	<tr>
			<td>(a) Land : </td>
			<td>'.strtoupper($fixed_amount_land).'</td>
	</tr>
	<tr>
			<td>(b) Site Development  :</td>
			<td>'.strtoupper($fixed_amount_site_dev).'</td>
	</tr>
	<tr>
			<td valign="top">(c) Building :</td>
			<td>(i) Factory Building: '.strtoupper($fixed_amount_fb).'<br/>(ii) Office Building : '.strtoupper($fixed_amount_ob).'</td>
	</tr>
	<tr>
			<td>(d) Plant and Machinery / Component / Items :</td>
			<td>'.strtoupper($fixed_amount_pm).'</td>
	</tr>
	<tr>
			<td>(e) Electrical Installation :</td>
			<td>'.strtoupper($fixed_amount_ei).'</td>
	</tr>
	<tr>
			<td>(f) Preliminary & pre-operative expenses : </td>
			<td>'.strtoupper($fixed_amount_pe).'</td>
	</tr>
	<tr>
			<td>(g) Miscellaneous fixed assets : </td>
			<td>'.strtoupper($fixed_amount_m).'</td>
	</tr>
	<tr>
			<td>Total : </td>
			<td>'.strtoupper($fixed_amount_tot).'</td>
	</tr>
	<tr>
			<td>7. Proposed requirement of Power / Electricity (KW/MW) :</td>
			<td>'.strtoupper($power).'</td>
	</tr>
	<tr>
			<td colspan="2">8. Annual Production Capacity proposed :
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl No</td>
					<td align="center">Name of the Product(s)/Services rendered</td>
					<td align="center">Quantity</td>
					<td align="center">Value in Rupees</td>
				</tr>';
				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["quantity"]).'</td>
							<td>'.strtoupper($row_1["rupees"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td>9. Name(s) of Raw Materials used :  </td>
			<td> '.strtoupper($raw_meterial).'</td>
	</tr>
	<tr>
			<td valign="top">10. Proposed Employment Generation in the unit in various fields of work :</td>
			<td>(a) Managerial : '.strtoupper($proposed_managerial).'<br/>(b) Supervisory Staff : '.strtoupper($proposed_ss).'<br/>(c) Skilled Worker : '.strtoupper($proposed_skilled).'<br/>(d) Semi Skilled Worker : '.strtoupper($proposed_semi_skilled).'<br/>(e) Unskilled Worker : '.strtoupper($proposed_unskilled).'<br/>(f) Others : '.strtoupper($proposed_others).'</td>
	</tr>
	<tr>
		<td>11. Name of the Applicant(s) :</td>
		<td>'.strtoupper($Name_of_owner).'</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
	
	<tr>
		<td><label>Date : <b>'.date('d-m-Y',strtotime($today)).'</b> <br/> Place : '.strtoupper($dist).'</label></td>
		<td align="right"><label><b>'.strtoupper($key_person).'</b></label><br/>Signature of the Applicant</td>	
	</tr>
</table>';
?>