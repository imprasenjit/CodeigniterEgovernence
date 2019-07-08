<?php 
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dic->query("select * from dic_form3 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dic->query("select * from dic_form3 where uain='$uain' and user_id='$swr_id'") or die($dic->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dic->query("select * from dic_form3 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else{
		$q=$dic->query("select * from dic_form3 where user_id='$swr_id' and active='1'") or die($dic->error);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
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
	
	$q=$dic->query("select * from dic_form3 where user_id=$swr_id and active='1'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
	$form_id=$results['form_id'];
	$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];$file7=$results['file7'];$file8=$results['file8'];$file9=$results['file9'];$file10=$results['file10'];$file11=$results['file11'];$file12=$results['file12'];$file13=$results['file13'];
		############### part 1###########
		if(!empty($results["pmt"]))
		{
			$pmt=json_decode($results["pmt"]);
			$pmt_ack_dt=$pmt->ack_dt;$pmt_ack_no=$pmt->ack_no;$pmt_reg_dt=$pmt->reg_dt;$pmt_reg_no=$pmt->reg_no;$pmt_lic_no=$pmt->lic_no;
		}else{
			$pmt_ack_dt="";$pmt_ack_no="";$pmt_lic_no="";$pmt_reg_dt="";$pmt_reg_no="";
		}
		if(!empty($results["fixed_amount"]))
		{
			$fixed_amount=json_decode($results["fixed_amount"]);
			$fixed_amount_land1=$fixed_amount->land1;$fixed_amount_land2=$fixed_amount->land2;$fixed_amount_land3=$fixed_amount->land3;
			$fixed_amount_sd1=$fixed_amount->sd1;$fixed_amount_sd2=$fixed_amount->sd2;$fixed_amount_sd3=$fixed_amount->sd3;$fixed_amount_fact1=$fixed_amount->fact1;$fixed_amount_fact2=$fixed_amount->fact2;$fixed_amount_fact3=$fixed_amount->fact3;$fixed_amount_ob1=$fixed_amount->ob1;$fixed_amount_ob2=$fixed_amount->ob2;$fixed_amount_ob3=$fixed_amount->ob3;
			$fixed_amount_ei1=$fixed_amount->ei1;$fixed_amount_ei2=$fixed_amount->ei2;$fixed_amount_ei3=$fixed_amount->ei3;$fixed_amount_items1=$fixed_amount->items1;$fixed_amount_items2=$fixed_amount->items2;$fixed_amount_items3=$fixed_amount->items3;
			$fixed_amount_exp1=$fixed_amount->exp1;$fixed_amount_exp2=$fixed_amount->exp2;$fixed_amount_exp3=$fixed_amount->exp3;
			$fixed_amount_mis1=$fixed_amount->mis1;$fixed_amount_mis2=$fixed_amount->mis2;$fixed_amount_mis3=$fixed_amount->mis3;
			$fixed_amount_tot1=$fixed_amount->tot1;$fixed_amount_tot2=$fixed_amount->tot2;$fixed_amount_tot3=$fixed_amount->tot3;
		}else{
			$fixed_amount_land1="";$fixed_amount_land2="";$fixed_amount_land3="";
			$fixed_amount_sd1="";$fixed_amount_sd2="";$fixed_amount_sd3="";
			$fixed_amount_fact1="";$fixed_amount_fact2="";$fixed_amount_fact3="";
			$fixed_amount_ob1="";$fixed_amount_ob2="";$fixed_amount_ob3="";
			$fixed_amount_items1="";$fixed_amount_items2="";$fixed_amount_items3="";
			$fixed_amount_ei1="";$fixed_amount_ei2="";$fixed_amount_ei3="";
			$fixed_amount_exp1="";$fixed_amount_exp2="";$fixed_amount_exp3="";
			$fixed_amount_mis1="";$fixed_amount_mis2="";$fixed_amount_mis3="";
			$fixed_amount_tot1="";$fixed_amount_tot2="";$fixed_amount_tot3="";
		}	
		############### End ###########
		############### part 2###########
			
		if(!empty($results["land"]))
		{
			$land=json_decode($results["land"]);
			$land_allot=$land->allot;$land_area=$land->area;$land_dt_lease=$land->dt_lease;$land_dt_poss=$land->dt_poss;$land_dt_pur=$land->dt_pur;$land_dt_reg=$land->dt_reg;$land_period=$land->period;
		}else{
			$land_allot="";$land_area="";$land_dt_lease="";$land_dt_poss="";$land_dt_pur="";$land_dt_reg=""; $land_period="";	
		}		
		if(!empty($results["building"]))
		{
			$building=json_decode($results["building"]);
			$building_area=$building->area;$building_expan=$building->expan;$building_pro_built=$building->pro_built;$building_type=$building->type;
		}else{
			$building_area="";$building_expan="";$building_pro_built="";$building_type="";
		}			
		if(!empty($results["electricity"]))
		{
			$electricity=json_decode($results["electricity"]);
			$electricity_connect=$electricity->connect;$electricity_pro_built=$electricity->pro_built;$electricity_sanc=$electricity->sanc;
		}else{
			$electricity_connect="";$electricity_pro_built="";$electricity_sanc="";
		}		
		if(!empty($results["proposed"]))
		{
			$proposed=json_decode($results["proposed"]);
			$proposed_managerial1=$proposed->managerial1;$proposed_managerial2=$proposed->managerial2;$proposed_managerial3=$proposed->managerial3;
			$proposed_skilled1=$proposed->skilled1;$proposed_skilled2=$proposed->skilled2;$proposed_skilled3=$proposed->skilled3;
			$proposed_semi_skilled1=$proposed->semi_skilled1;$proposed_semi_skilled2=$proposed->semi_skilled2;$proposed_semi_skilled3=$proposed->semi_skilled3;
			
			$proposed_ss1=$proposed->ss1;$proposed_ss2=$proposed->ss2;$proposed_ss3=$proposed->ss3;
			
			$proposed_unskilled1=$proposed->unskilled1;$proposed_unskilled2=$proposed->unskilled2;$proposed_unskilled3=$proposed->unskilled3;
			
			$proposed_others1=$proposed->others1;$proposed_others2=$proposed->others2;$proposed_others3=$proposed->others3;
		}else{
			$proposed_managerial1="";$proposed_managerial2="";$proposed_managerial3="";$proposed_managerial_tot="";
			$proposed_skilled1="";$proposed_skilled2="";$proposed_skilled2="";$proposed_skilled3="";$proposed_skilled_tot="";
			$proposed_semi_skilled1="";$proposed_semi_skilled2="";$proposed_semi_skilled3="";$proposed_semi_skilled_tot="";
			$proposed_ss1="";$proposed_ss2="";$proposed_ss3="";$proposed_ss_tot="";
			$proposed_unskilled1="";$proposed_unskilled2="";$proposed_unskilled3="";$proposed_unskilled_tot="";
			$proposed_others1="";$proposed_others2="";$proposed_others3="";$proposed_others_tot="";
		}
		$fixed_amount_fact3=$fixed_amount_fact1+$fixed_amount_fact2;
		$fixed_amount_sd3=$fixed_amount_sd1+$fixed_amount_sd2;
		$fixed_amount_land3=$fixed_amount_land1+$fixed_amount_land2;
		$fixed_amount_sd3=$fixed_amount_sd1+$fixed_amount_sd2;
		$fixed_amount_fact3=$fixed_amount_fact1+$fixed_amount_fact2;
		$fixed_amount_ob3=$fixed_amount_ob1+$fixed_amount_ob2;
		$fixed_amount_items3=$fixed_amount_items1+$fixed_amount_items2;
		$fixed_amount_ei3=$fixed_amount_ei1+$fixed_amount_ei2;
		$fixed_amount_exp3=$fixed_amount_exp1+$fixed_amount_exp2;
		$fixed_amount_mis3=$fixed_amount_mis1+$fixed_amount_mis2;
		$fixed_amount_tot1=$fixed_amount_land1+$fixed_amount_ei1+$fixed_amount_exp1+$fixed_amount_fact1+$fixed_amount_items1+$fixed_amount_mis1+$fixed_amount_ob1+$fixed_amount_sd1;
		$fixed_amount_tot2=$fixed_amount_land2+$fixed_amount_ei2+$fixed_amount_exp2+$fixed_amount_fact2+$fixed_amount_items2+$fixed_amount_mis2+$fixed_amount_ob2+$fixed_amount_sd2;
		$fixed_amount_tot3=$fixed_amount_land3+$fixed_amount_ei3+$fixed_amount_exp3+$fixed_amount_fact3+$fixed_amount_items3+$fixed_amount_mis3+$fixed_amount_ob3+$fixed_amount_sd3;		 
		 
		$proposed_managerial_tot=$proposed_managerial1+$proposed_managerial2+$proposed_managerial3;
		$proposed_ss_tot=$proposed_ss1+$proposed_ss2+$proposed_ss3;
		$proposed_skilled_tot=$proposed_skilled1+$proposed_skilled2+$proposed_skilled3;
		$proposed_semi_skilled_tot=$proposed_semi_skilled1+$proposed_semi_skilled2+$proposed_semi_skilled3;
		$proposed_unskilled_tot=$proposed_unskilled1+$proposed_unskilled2+$proposed_unskilled3;
		$proposed_others_tot=$proposed_others1+$proposed_others2+$proposed_others3;		
		if($building_type==R){
			$building_type="Rented";
			}else{$building_type="Owned";}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
				$courier_details=json_decode($results["courier_details"]);
				$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}	
     $form_name=$formFunctions->get_formName('dic','3');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 3</title>
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
  			'.$assamSarkarLogo.'<h4>FORM - 1(B)<br/>'.$form_name.'<br/>(For Existing unit undertaking substantial expansion)</h4>
		</div><br/>
      <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
  		<tr>  				
			<td valign="top" width="50%">1. (a) Name of the Industrial unit :</td>
			<td style="width:50%">'.strtoupper($key_person).'</td>
		</tr>
		<tr>
  		<td valign="top">(b) Complete address with telephone No. : </td>
  		<td>
		<table width="99%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
      		<tr>
        			<td width="50%">Street Name 1</td>
        			<td width="50%">'.strtoupper($street_name1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($street_name2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($dist).'</td>
      		</tr>
      		<tr>
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($pincode).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($mobile_no).'</td>
      		</tr>
			
      		<tr>
        			<td>Email-id</td>
        			<td> '.strtoupper($email).'</td>
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
					$results1=$dic->query("select * from dic_form3_members where form_id='$form_id'") or die("Error : ".$dic->error);
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
				</tr>
			</table>
			</td>
	</tr>
	<tr>
			<td>3. Proposed date of commencement of commercial  production of unit after expansion :</td>
			<td> '.strtoupper($date_of_commencement).'</td>
	</tr>
	<tr>
			<td>4.  Whether the industrial unit falls under Manufacturing sector OR Service sector : </td>
			<td> '.strtoupper($business_type).'</td>
	</tr>
	<tr>
			<td colspan="2">5. 5. Details of Registration with the concerned Department :<br/>
			(A). If Manufacturing Sector, please indicate :</td>
	</tr>
	<tr>
			<td>(i) PMT registration no with Date/Acknowledge No./Date of    Entrepreneur Memorandum(EM) Part-1 / Part-2 (if any) of MSME:</td>
			<td> '.strtoupper($pmt_reg_no).' '.strtoupper($pmt_reg_dt).'</td>
	</tr>
	<tr>
			<td>(ii) Acknowledgement No. / Date of Entrepreneur Memorandum (EM) (if any) of DIPP : </td>
			<td>'.strtoupper($pmt_ack_no).' '.strtoupper($pmt_ack_dt).'</td>
	</tr>
	<tr>
			<td>(B) (B) If Service Sector, please indicate requisite  Registration / License No. from the concerned Department (if any)  :</td>
			<td>'.strtoupper($pmt_lic_no).'</td>
	</tr>
	<tr>
			<td colspan="2">6. Particulars / Details of Fixed Capital Investment (in rupees) : 
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
						<th>Sl no.</th>
						<th>Particulars</th>
						<th>Existing Investment</th>
						<th>Additional Investment proposed for expansion</th>
						<th>Total</th>
					</tr>
					<tr>
						<td>a</td>
						<td>Land</td>
						<td>'.strtoupper($fixed_amount_land1).'</td>
						<td>'.strtoupper($fixed_amount_land2).'</td>
						<td>'.strtoupper($fixed_amount_land3).'</td>
					</tr>
					<tr>
						<td>b</td>
						<td>Site Development</td>
						<td>'.strtoupper($fixed_amount_sd1).'</td>
						<td>'.strtoupper($fixed_amount_sd2).'</td>
						<td>'.strtoupper($fixed_amount_sd3).'</td>
					</tr>
					<tr>
						<td>c</td>
						<td colspan="3">Building</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>(i) Factory</td>
						<td>'.strtoupper($fixed_amount_fact1).'</td>
						<td>'.strtoupper($fixed_amount_fact2).'</td>
						<td>'.strtoupper($fixed_amount_fact3).'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>(ii) Office Building</td>
						<td>'.strtoupper($fixed_amount_ob1).'</td>
						<td>'.strtoupper($fixed_amount_ob2).'</td>
						<td>'.strtoupper($fixed_amount_ob3).'</td>
					</tr>
					<tr>
						<td>d</td>
						<td>Plant and Machinery/ Component items</td>
						<td>'.strtoupper($fixed_amount_items1).'</td>
						<td>'.strtoupper($fixed_amount_items2).'</td>
						<td>'.strtoupper($fixed_amount_items3).'</td>
					</tr>
					<tr>
						<td>e</td>
						<td>Electrical Installation</td>
						<td>'.strtoupper($fixed_amount_ei1).'</td>
						<td>'.strtoupper($fixed_amount_ei2).'</td>
						<td>'.strtoupper($fixed_amount_ei3).'</td>
					</tr>
					<tr>
						<td>f</td>
						<td>Preliminary & Preoperative expenses</td>
						<td>'.strtoupper($fixed_amount_exp1).'</td>
						<td>'.strtoupper($fixed_amount_exp2).'</td>
						<td>'.strtoupper($fixed_amount_exp3).'</td>
					</tr>
					<tr>
						<td>g</td>
						<td>Miscellaneous fixed assets</td>
						<td>'.strtoupper($fixed_amount_mis1).'</td>
						<td>'.strtoupper($fixed_amount_mis2).'</td>
						<td>'.strtoupper($fixed_amount_mis3).'</td>
					</tr>
					<tr>
						<td></td>
						<td>Total</td>
						<td>'.strtoupper($fixed_amount_tot1).'</td>
						<td>'.strtoupper($fixed_amount_tot2).'</td>
						<td>'.strtoupper($fixed_amount_tot3).'</td>
					</tr>
				</table>
			</td>
	</tr>
	<tr>
			<td >7. Details of Land and Building : </td>
			<td></td>
	</tr>
	<tr>
			<td>A. Land  :<br/>a) Own Land</td>
			<td>(i) Land area, Revenue village, Dag No. & Patta No. :'.strtoupper($land_area).'<br/>
			(ii) Date of Purchase : '.strtoupper($land_dt_pur).'<br/>(iii) Date of Registration : '.strtoupper($land_dt_reg).'</td>
	</tr>
	<tr>
			<td>b) Land Alloted by Government / Government Agency  :</td>
			<td>(i) Date of allotment / agreement with area of land : '.strtoupper($land_allot).'<br/>(ii) Date of taking over possession : '.strtoupper($land_dt_poss).'</td>
	</tr>
	<tr>
			<td>c) Lease hold land </td>
			<td>(i) Date of Registration of lease deed :'.strtoupper($land_dt_lease).'<br/>(ii) Period of lease :'.strtoupper($land_period).'</td>
	</tr>
	<tr>
			<td>B. Building :</td>
			<td>a) Building Type :'.strtoupper($building_type).'</td>
	</tr>
	<tr>
			<td>b) In case of own building : </td>
			<td>(i)Build up area prior to expansion :'.strtoupper($building_expan).' <br/>(ii) Proposed built up area after expansion :'.strtoupper($building_pro_built).'</td>
	</tr>
	<tr>
			<td>8. Details of electricity utilization : </td>
			<td>(i) Sanctioned load prior to expansion :'.strtoupper($electricity_sanc).'<br/>
			(ii) Connected load prior to expansion :'.strtoupper($electricity_connect).'<br/>
			(iii) Whether requirement of additional load is essential for expansion. If so, the quantum of additional load required/applied for :'.strtoupper($electricity_pro_built).'</td>
	</tr>
	<tr>
			<td colspan="2">9. Production Capacity :
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td align="center" ></td>
				   <td align="center"></td>
				   <td colspan="2" align="center" >Annual installed capacity prior to expansion</td>
				   <td colspan="2" align="center" >Proposed annual installed capacity after expansion</td>
				</tr>
				<tr>
					<td align="center" width="10%" >Sl No</td>
				   <td align="center" width="20%">Name of the Product(s)/Service rendered</td>
				   <td align="center" width="20%">Quantity</td>
				   <td align="center" width="20%">Value in Rupees</td>
				   <td align="center" width="20%">Quantity</td>
				   <td align="center" width="10%">Value in Rupees</td>
				</tr>';				
				$part1=$dic->query("SELECT * FROM dic_form3_t1 WHERE form_id='$form_id'") ;
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td align="center">'.strtoupper($row_1["quantity1"]).'</td>
							<td align="center">'.strtoupper($row_1["rupees1"]).'</td>
							<td align="center">'.strtoupper($row_1["quantity2"]).'</td>
							<td align="center">'.strtoupper($row_1["rupees2"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">10.
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td align="center"></td>
				   <td align="center"></td>
				   <td colspan="2" align="center">Annual requirement prior to expansion</td>
				   <td colspan="2" align="center">Proposed annual requiremen after expansion</td>
				</tr>
				<tr>
					<td align="center" width="10%">Sl No</td>
				   <td align="center" width="20%">Raw Materials</td>
				   <td align="center" width="20%">Quantity</td>
				   <td align="center" width="20%">Value in Rupees</td>
				   <td align="center" width="20%">Quantity</td>
				   <td align="center" width="10%">Value in Rupees</td>
										
				</tr>';				
				$part2=$dic->query("SELECT * FROM dic_form3_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["name"]).'</td>
							<td align="center">'.strtoupper($row_2["quantity1"]).'</td>
							<td align="center">'.strtoupper($row_2["rupees1"]).'</td>
							<td align="center">'.strtoupper($row_2["quantity2"]).'</td>
							<td align="center">'.strtoupper($row_2["rupees2"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">11. Proposed Employment Generation in the unit in various fields of work :
			<table width="99%"  class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">								
			<tr>
				<th width="20%">Sl no  </th>
				<th width="20%">Employment Generation in the unit in various fields of work</th>
				<th width="20%">Prior to expansion</th>
				<th width="20%" >Proposed additional employment for expansion</th>
				<th width="20%">Total</th>
			</tr>
			<tr>
				<td>(a) Managerial :   </td>
				<td align="center"> '.strtoupper($proposed_managerial1).'</td>
				<td align="center"> '.strtoupper($proposed_managerial2).'</td>
				<td align="center"> '.strtoupper($proposed_managerial3).'</td>
				<td align="center"> '.strtoupper($proposed_managerial_tot).'</td>
			</tr>
			<tr>
				<td>(b) Supervisory Staff :</td>
				<td align="center"> '.strtoupper($proposed_ss1).'</td>
				<td align="center"> '.strtoupper($proposed_ss2).'</td>
				<td align="center"> '.strtoupper($proposed_ss3).'</td>
				<td align="center"> '.strtoupper($proposed_ss_tot).'</td>
			</tr>
			<tr>									
				<td>(c) Skilled Worker :   </td>
				<td align="center"> '.strtoupper($proposed_skilled1).'</td>
				<td align="center"> '.strtoupper($proposed_skilled2).'</td>
				<td align="center"> '.strtoupper($proposed_skilled3).'</td>
				<td align="center"> '.strtoupper($proposed_skilled_tot).'</td>
			</tr>
			<tr>
				<td> (d) Semi Skilled Worker :</td>
				<td align="center"> '.strtoupper($proposed_semi_skilled1).'</td>
				<td align="center"> '.strtoupper($proposed_semi_skilled2).'</td>
				<td align="center"> '.strtoupper($proposed_semi_skilled3).'</td>
				<td align="center"> '.strtoupper($proposed_semi_skilled_tot).'</td>
			</tr>								
			<tr>
				<td>(e) Unskilled Worker :   </td>
				<td align="center"> '.strtoupper($proposed_unskilled1).'</td>
				<td align="center"> '.strtoupper($proposed_unskilled2).'</td>
				<td align="center"> '.strtoupper($proposed_unskilled3).'</td>
				<td align="center"> '.strtoupper($proposed_unskilled_tot).'</td>
			</tr>								
			<tr>
				<td>(f) Others :</td>
				<td align="center"> '.strtoupper($proposed_others1).'</td>
				<td align="center"> '.strtoupper($proposed_others2).'</td>
				<td align="center"> '.strtoupper($proposed_others3).'</td>
				<td align="center"> '.strtoupper($proposed_others_tot).'</td>
			</tr>
			</table>
			</td>
	</tr>
	<tr>
		<td>12. Declaration :</td>
		<td></td>
	</tr>
	<tr>
		<td>Name of the Applicant(s) : '.strtoupper($key_person).' </td>
		<td></td>
	</tr>
	';}       
            $printContents=$printContents.'     
        <tr>
			<td> Place : '.strtoupper($dist).'<br/>Date : '.strtoupper($results["sub_date"]).'</td>
			<td align="center">&nbsp;</td>
        </tr>
</table>';
?>

