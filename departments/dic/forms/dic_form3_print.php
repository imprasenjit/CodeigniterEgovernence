<?php 
$dept="dic";
$form="3";
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
	
		############### part 1###########
		if(!empty($results["pmt"]))
		{
			$pmt=json_decode($results["pmt"]);
			$pmt_ack_dt=$pmt->ack_dt;$pmt_ack_no=$pmt->ack_no;$pmt_reg_dt=$pmt->reg_dt;$pmt_reg_no=$pmt->reg_no;$pmt_lic_no=$pmt->lic_no;
		}else{
			$pmt_ack_dt="";$pmt_ack_no="";$pmt_lic_no="";$pmt_reg_dt="";$pmt_reg_no="";
		}
		if($pmt_ack_dt!="" && $pmt_ack_dt!="0000-00-00"){
			$pmt_ack_dt = date('d-m-Y',strtotime($pmt_ack_dt));
		}else{
			$pmt_ack_dt="";
		}
		if($pmt_reg_dt!="" && $pmt_reg_dt!="0000-00-00"){
			$pmt_reg_dt = date('d-m-Y',strtotime($pmt_reg_dt));
		}else{
			$pmt_reg_dt="";
		}
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
			
			$fixed_amount_land1=$fixed_amount->land1;$fixed_amount_land2=$fixed_amount->land2;
			
			$fixed_amount_sd1=$fixed_amount->sd1;$fixed_amount_sd2=$fixed_amount->sd2;
			
			$fixed_amount_fact1=$fixed_amount->fact1;$fixed_amount_fact2=$fixed_amount->fact2;
			
			$fixed_amount_ob1=$fixed_amount->ob1;$fixed_amount_ob2=$fixed_amount->ob2;
			
			$fixed_amount_ei1=$fixed_amount->ei1;$fixed_amount_ei2=$fixed_amount->ei2;
			
			$fixed_amount_items1=$fixed_amount->items1;$fixed_amount_items2=$fixed_amount->items2;
			
			$fixed_amount_exp1=$fixed_amount->exp1;$fixed_amount_exp2=$fixed_amount->exp2;
			
			$fixed_amount_mis1=$fixed_amount->mis1;$fixed_amount_mis2=$fixed_amount->mis2;
			
		}else{
			$fixed_amount_land1="";$fixed_amount_land2="";$fixed_amount_land3="";
			$fixed_amount_sd1="";$fixed_amount_sd2="";$fixed_amount_sd3="";
			$fixed_amount_fact1="";$fixed_amount_fact2="";$fixed_amount_fact3="";
			$fixed_amount_ob1="";$fixed_amount_ob2="";$fixed_amount_ob3="";
			$fixed_amount_items1="";$fixed_amount_items2="";$fixed_amount_items3="";
			$fixed_amount_ei1="";$fixed_amount_ei2="";$fixed_amount_ei3="";
			$fixed_amount_exp1="";$fixed_amount_exp2="";$fixed_amount_exp3="";
			$fixed_amount_mis1="";$fixed_amount_mis2="";$fixed_amount_mis3="";
			$fixed_amount_tot1="";
		}
		############### End ###########
		############### part 2###########
			
		if(!empty($results["land"]))
		{
			$land=json_decode($results["land"]);
			$land_allot=$land->allot;$land_area=$land->area;$land_rev=$land->rev;$land_dag=$land->dag;$land_patta=$land->patta;$land_dt_lease=$land->dt_lease;$land_dt_poss=$land->dt_poss;$land_dt_pur=$land->dt_pur;$land_dt_reg=$land->dt_reg;$land_period=$land->period;
		}else{
			$land_allot="";$land_area="";$land_rev="";$land_dag="";$land_patta="";$land_dt_lease="";$land_dt_poss="";$land_dt_pur="";$land_dt_reg=""; $land_period="";	
		}
		if($land_dt_pur!="" && $land_dt_pur!="0000-00-00"){
			$land_dt_pur = date('d-m-Y',strtotime($land_dt_pur));
		}else{
			$land_dt_pur="";
		}
		if($land_dt_reg!="" && $land_dt_reg!="0000-00-00"){
			$land_dt_reg = date('d-m-Y',strtotime($land_dt_reg));
		}else{
			$land_dt_reg="";
		}
		if($land_allot!="" && $land_allot!="0000-00-00"){
			$land_allot = date('d-m-Y',strtotime($land_allot));
		}else{
			$land_allot="";
		}	
		if($land_dt_poss!="" && $land_dt_poss!="0000-00-00"){
			$land_dt_poss = date('d-m-Y',strtotime($land_dt_poss));
		}else{
			$land_dt_poss="";
		}		
		if($land_dt_lease!="" && $land_dt_lease!="0000-00-00"){
			$land_dt_lease = date('d-m-Y',strtotime($land_dt_lease));
		}else{
			$land_dt_lease="";
		}		
		if(!empty($results["building"]))
		{
			$building=json_decode($results["building"]);
			$building_expan=$building->expan;$building_pro_built=$building->pro_built;$building_type=$building->type;
		}else{
			$building_expan="";$building_pro_built="";$building_type="";
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
		if($building_type=='R'){
			$building_type="Rented";
			}else{$building_type="Owned";}
		
	}
    
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
			<td style="width:50%">'.strtoupper($unit_name).'</td>
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
        			<td>Block</td>
        			<td>'.strtoupper($b_block).'</td>
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
						<th>Street Name 1</th>
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
			<td>3. Proposed date of commencement of commercial  production of unit after expansion :</td>
			<td> '.date('d-m-Y',strtotime($date_of_commencement)).'</td>
	</tr>
	<tr>
			<td>4.  Whether the industrial unit falls under Manufacturing sector OR Service sector : </td>
			<td> '.strtoupper($business_type).'</td>
	</tr>
	<tr>
			<td colspan="2">5. Details of Registration with the concerned Department :<br/>
			(A). If Manufacturing Sector, please indicate :</td>
	</tr>
	<tr>
			<td>(i) PMT registration no with Date/Acknowledge No./Date of    Entrepreneur Memorandum(EM) Part-1 / Part-2 (if any) of MSME:</td>
			<td> Registration No : '.strtoupper($pmt_reg_no).'<br/>
			Registration Date : '.strtoupper($pmt_reg_dt).'</td>
	</tr>
	<tr>
			<td>(ii) Acknowledgement No. / Date of Entrepreneur Memorandum (EM) (if any) of DIPP : </td>
			<td>Registration No : '.strtoupper($pmt_ack_no).'<br/>
			Registration Date : '.strtoupper($pmt_ack_dt).'</td>
	</tr>
	<tr>
			<td>(B) If Service Sector, please indicate requisite  Registration / License No. from the concerned Department (if any)  :</td>
			<td>'.strtoupper($pmt_lic_no).'</td>
	</tr>
	<tr>
			<td colspan="2">6. Particulars / Details of Fixed Capital Investment (in rupees) : 
			<table class="table table-bordered table-responsive">
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
			<td colspan="2">7. Details of Land and Building : </td>
	</tr>
	<tr>
			<td valign="top">A. Land  :<br/>a) Own Land</td>
			<td>(i) Land area : '.strtoupper($land_area).'<br/>
			Revenue village : '.strtoupper($land_rev).'<br/>
			Dag No. : '.strtoupper($land_dag).'<br/>
			Patta No. : '.strtoupper($land_patta).'<br/>
			(ii) Date of Purchase : '.strtoupper($land_dt_pur).'<br/>(iii) Date of Registration : '.strtoupper($land_dt_reg).'</td>
	</tr>
	<tr>
			<td valign="top">b) Land Alloted by Government / Government Agency  :</td>
			<td>(i) Date of allotment / agreement with area of land : '.strtoupper($land_allot).'<br/>(ii) Date of taking over possession : '.strtoupper($land_dt_poss).'</td>
	</tr>
	<tr>
			<td valign="top">c) Lease hold land </td>
			<td>(i) Date of Registration of lease deed :'.strtoupper($land_dt_lease).'<br/>(ii) Period of lease :'.strtoupper($land_period).'</td>
	</tr>
	<tr>
			<td>B. Building :</td>
			<td valign="top">a) Building Type :'.strtoupper($building_type).'</td>
	</tr>
	<tr>
			<td>b) In case of own building : </td>
			<td>(i)Build up area prior to expansion :'.strtoupper($building_expan).' <br/>(ii) Proposed built up area after expansion :'.strtoupper($building_pro_built).'</td>
	</tr>
	<tr>
			<td valign="top">8. Details of electricity utilization : </td>
			<td>(i) Sanctioned load prior to expansion :'.strtoupper($electricity_sanc).'<br/>
			(ii) Connected load prior to expansion :'.strtoupper($electricity_connect).'<br/>
			(iii) Whether requirement of additional load is essential for expansion. If so, the quantum of additional load required/applied for :'.strtoupper($electricity_pro_built).'</td>
	</tr>
	<tr>
			<td colspan="2">9. Production Capacity :
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center" ></td>
				   <td align="center"></td>
				   <td colspan="2" align="center" >Annual installed capacity prior to expansion</td>
				   <td colspan="2" align="center" >Proposed annual installed capacity after expansion</td>
				</tr>
				<tr>
					<td align="center" >Sl No</td>
				   <td align="center">Name of the Product(s)/Service rendered</td>
				   <td align="center">Quantity</td>
				   <td align="center">Value in Rupees</td>
				   <td align="center">Quantity</td>
				   <td align="center">Value in Rupees</td>
				</tr>';				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'") ;
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
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center"></td>
				   <td align="center"></td>
				   <td colspan="2" align="center">Annual requirement prior to expansion</td>
				   <td colspan="2" align="center">Proposed annual requiremen after expansion</td>
				</tr>
				<tr>
					<td align="center">Sl No</td>
				   <td align="center">Raw Materials</td>
				   <td align="center">Quantity</td>
				   <td align="center">Value in Rupees</td>
				   <td align="center">Quantity</td>
				   <td align="center">Value in Rupees</td>
										
				</tr>';				
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
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
			<table width="100%"  class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">								
			<tr>
				<th>Sl no  </th>
				<th>Employment Generation in the unit in various fields of work</th>
				<th>Prior to expansion</th>
				<th >Proposed additional employment for expansion</th>
				<th>Total</th>
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
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
	<tr>
		<td> Place : '.strtoupper($dist).'<br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
		<td align="right">'.strtoupper($key_person).' <br/>Name of the Applicant </td>
	</tr>
</table>';
?>