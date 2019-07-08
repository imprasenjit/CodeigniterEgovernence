<?php 
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dic->query("select * from dic_form2 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dic->query("select * from dic_form2 where uain='$uain' and user_id='$swr_id'") or die($dic->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dic->query("select * from dic_form2 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else{
		$q=$dic->query("select * from dic_form2 where user_id='$swr_id' and active='1'") or die($dic->error);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$l_o_business=$row1['Type_of_ownership'];$date_of_commencement=$row1['date_of_commencement'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative Society";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Association of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	$sn1="";$sn2="";$v="";$d="";$p="";
	$q=$dic->query("select * from dic_form2 where user_id=$swr_id and active='1'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
	$form_id=$results['form_id'];
	$power=$results['power'];$raw_meterial=$results['raw_meterial'];
		##### Part A #######
		if(!empty($results["ack"]))
		{
			$ack=json_decode($results["ack"]);
			$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_lic_no=$ack->lic_no;
		}else{
			$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
		}
		##### Part B #######
		if(!empty($results["fixed_amount"]))
		{
			$fixed_amount=json_decode($results["fixed_amount"]);
			$fixed_amount_land=$fixed_amount->land;$fixed_amount_site_dev=$fixed_amount->site_dev;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;$fixed_amount_tot=$fixed_amount->tot;
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_tot="";$fixed_amount_ei="";
		}	
		if(!empty($results["proposed"]))
		{
			$proposed=json_decode($results["proposed"]);
			$proposed_managerial=$proposed->manegerial;$proposed_skilled=$proposed->skilled;$proposed_semi_skilled=$proposed->semi_skilled;$proposed_unskilled=$proposed->unskilled;$proposed_ss=$proposed->ss;$proposed_others=$proposed->other;
		}else{
			$proposed_managerial="";$proposed_skilled="";$proposed_unskilled="";$proposed_semi_skilled="";$proposed_ss="";$proposed_others="";
		}		
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
		$fixed_amount_tot=$fixed_amount_ei+$fixed_amount_fb+$$fixed_amount_land+$fixed_amount_m+$fixed_amount_ob+$fixed_amount_pe+$fixed_amount_pm+$fixed_amount_site_dev;
     $form_name=$formFunctions->get_formName('dic','2');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 2</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
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
  			'.$assamSarkarLogo.'<h4>Form- LM-1<br/><br/>'.$form_name.'</h4>
		</div><br/>
      <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
  		<tr>  				
			<td valign="top" width="50%">1. (a) Name of the Industrial unit :</td>
			<td style="width:50%">'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
  		<td valign="top">(b) Complete address with telephone No. : </td>
  		<td>
		<table width="99%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
      		<tr>
        			<td width="50%">Street Name 1</td>
        			<td width="50%">'.strtoupper($b_street_name1).'</td>
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
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td> '.strtoupper($b_email).'</td>
      		</tr>
    		</table>
		</td>
	</tr>
	<tr>
  		<td valign="top">2. (a) Constitution of the unit  </td>
  		<td>
		<table width="99%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
      		<tr>
        			<td width="50%">Street Name 1</td>
        			<td width="50%">'.strtoupper($b_street_name1).'</td>
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
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($b_mobile_no).'</td>
      		</tr>
			
      		<tr>
        			<td>Email-id</td>
        			<td> '.strtoupper($b_email).'</td>
      		</tr>
    		</table>
		</td>
  	</tr>
	<tr>
			<td colspan="2">(b) Name(s), address(es), of the Proprietor / Partners / Directors of Board of Directors / Secretary and  President of the Cooperative Society :
				<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
						<th width="10%">Sl. No.</th>
						<th width="20%">Partners/Directors Name</th>
						<th width="10%" >Street Name 1</th>
						<th width="10%">Street Name 2</th>
						<th width="10%">Village/Town</th>
						<th width="10%">District</th>
						<th width="10%">Pincode</th>
					</tr>';
					$results1=$dic->query("select * from dic_form2_members where form_id='$form_id'") or die("Error : ".$dic->error);
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
					$printContents=$printContents.'</td>
				</table>
			</td>
	</tr>
	<tr>
			<td>3. Proposed date of commencement of commercial production of unit : </td>
			<td> '.strtoupper($date_of_commencement).'</td>
	</tr>
	<tr>
			<td>4. Whether the industrial unit falls under Manufacturing sector OR Service sector  : </td>
			<td> '.strtoupper($business_type).'</td>
	</tr>
	<tr>
			<td colspan="2">5. Details of Registration with the concerned Department<br>(A). If Manufacturing Sector, please indicate : </td>
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
			<td>6. Particulars / Details of Fixed Capital Investment proposed    (Amount in Rs.) : </td>
			<td></td>
	</tr>
	<tr>
			<td>(a) Land : </td>
			<td>'.strtoupper($fixed_amount_land).'</td>
	</tr>
	<tr>
			<td>(b) Site Development  :</td>
			<td>'.strtoupper($fixed_amount_land).'</td>
	</tr>
	<tr>
			<td>(c) Building :</td>
			<td>(i) Factory Building: '.strtoupper($fixed_amount_land).'<br/>(ii) Office Building : '.strtoupper($fixed_amount_ob).'</td>
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
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td align="center">Sl No</td>
					<td align="center">Name of the Product(s)/Services rendered</td>
					<td align="center">Quantity</td>
					<td align="center">Value in Rupees</td>
				</tr>';
				
				$part1=$dic->query("SELECT * FROM dic_form2_t1 WHERE form_id='$form_id'");
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
			<td>10. Proposed Employment Generation in the unit in various fields of work :</td>
			<td>(a) Managerial : '.strtoupper($proposed_managerial).'<br/>(b) Supervisory Staff : '.strtoupper($proposed_ss).'<br/>(c) Skilled Worker : '.strtoupper($proposed_skilled).'<br/>(d) Semi Skilled Worker : '.strtoupper($proposed_semi_skilled).'<br/>(e) Unskilled Worker : '.strtoupper($proposed_unskilled).'<br/>(f) Others : '.strtoupper($proposed_others).'</td>
	</tr>
	<tr>
		<td>11. Name of the Applicant(s) :</td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	';}       
            $printContents=$printContents.'     
        <tr>
			<td> Place : '.strtoupper($dist).'<br/>Date : '.strtoupper($results["sub_date"]).'</td>
			<td align="center">&nbsp;</td>
        </tr>
</table>';
?>

