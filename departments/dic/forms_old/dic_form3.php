<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dic','3');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=dic';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=3&dept=dic';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_dic_form.php";
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
	$q=$dic->query("select * from dic_form3 where user_id='$swr_id'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		############### part 1###########
		$pmt_ack_dt="";$pmt_ack_no="";$pmt_lic_no="";$pmt_reg_dt="";$pmt_reg_no="";
		$fixed_amount_land1="";$fixed_amount_land2="";$fixed_amount_land3="";
		$fixed_amount_sd1="";$fixed_amount_sd2="";$fixed_amount_sd3="";
		$fixed_amount_fact1="";$fixed_amount_fact2="";$fixed_amount_fact3="";
		$fixed_amount_ob1="";$fixed_amount_ob2="";$fixed_amount_ob3="";
		$fixed_amount_items1="";$fixed_amount_items2="";$fixed_amount_items3="";
		$fixed_amount_ei1="";$fixed_amount_ei2="";$fixed_amount_ei3="";
		$fixed_amount_exp1="";$fixed_amount_exp2="";$fixed_amount_exp3="";
		$fixed_amount_mis1="";$fixed_amount_mis2="";$fixed_amount_mis3="";
		$fixed_amount_tot1="";$fixed_amount_tot2="";$fixed_amount_tot3="";
		############### End ###########
		############### part 2###########
		$land_allot="";$land_area="";$land_dt_lease="";$land_dt_poss="";$land_dt_pur="";$land_dt_reg=""; $land_period="";
		$building_area="";$building_expan="";$building_pro_built="";$building_type="";
		$electricity_connect="";$electricity_pro_built="";$electricity_sanc="";
		$electricity_connect="";$electricity_pro_built="";$electricity_sanc="";
		$proposed_managerial1="";$proposed_managerial2="";$proposed_managerial3="";$proposed_managerial_tot="";
		$proposed_skilled1="";$proposed_skilled2="";$proposed_skilled2="";$proposed_skilled3="";$proposed_skilled_tot="";
		$proposed_semi_skilled1="";$proposed_semi_skilled2="";$proposed_semi_skilled3="";$proposed_semi_skilled_tot="";
		$proposed_ss1="";$proposed_ss2="";$proposed_ss3="";$proposed_ss_tot="";
		$proposed_unskilled1="";$proposed_unskilled2="";$proposed_unskilled3="";$proposed_unskilled_tot="";
		$proposed_others1="";$proposed_others2="";$proposed_others3="";$proposed_others_tot="";
	
		//ciurier details
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		//file uploads			
		$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";$file11="";$file12="";$file13="";
	}else{
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
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
				$courier_details=json_decode($results["courier_details"]);
				$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}	
		
	}
	##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==3){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:block;'";$tabbtn3="active";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
##PHP TAB management ends
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
		}
	</style>
	<?php include ("dic_form3_Addmore-operation.php"); ?> <!-- File handles 'Addmore' Operation -->
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center" >
									<strong>FORM - 1(B)<br/><?php echo $form_name=$formFunctions->get_formName('dic','3'); ?><br/>(For Existing unit undertaking substantial expansion)</strong>
								</h4>	
							</div>
							<div class="panel-body">
							<div class="panel-body">
							    <ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PART II</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">Upload Section</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td >1. (a) Name of the Industrial unit :</td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4"> (b) Complete address with telephone No. :  </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Block</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block;?>"></td>
										<td>Pincode</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
									</tr>	
									<tr>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
									</tr>				
									</tr>
									<tr>
										<td width="25%">2. (a) Constitution of the unit</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $l_o_business_val;?>"></td>
										<td width="25%">&nbsp;</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td colspan=4>(b) Name(s), address(es), of the Proprietor / Partners /    Directors of Board of Directors / Secretary and  President of the Cooperative Society : </td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive">
										<thead>
											<tr >
												<th width="10%">Sl. No.</th>
												<th width="20%">Partners/Directors Name</th>
												<th width="10%" >Street Name 1</th>
												<th width="10%">Street Name 2</th>
												<th width="10%">Village/Town</th>
												<th width="10%">District</th>
												<th width="10%">Pincode</th>
											</tr>
										</thead>	
											<?php 
										$member_results=$dic->query("select * from dic_form2_members where form_id='$form_id'") or die("Error : ".$dic->error);
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" validate="letters" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" validate="letters" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" validate="specialChar" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" validate="specialChar" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->v; ?>" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->d; ?>" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->p; ?>" maxlength="6" validate="pincode" ></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										</td>
										</tr>
										</table></td>
									</tr>
									<tr>
										<td>3. Proposed date of commencement of commercial  production of unit after expansion :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $date_of_commencement;?>"></td>
										<td>4. Whether the industrial unit falls under Manufacturing sector OR Service sector :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $business_type; ?>"></td>
									</tr>	
									<tr>
										<td colspan="4">5. Details of Registration with the concerned Department :</td>
									<tr>
									<tr>
										<td colspan="4">(A). If Manufacturing Sector, please indicate :</td>
									<tr>
									<tr>
										<td colspan="4">  (i) PMT registration no with Date/Acknowledge No./Date of    Entrepreneur Memorandum(EM) Part-1 / Part-2 (if any) of MSME:</td>
									</tr>
									<tr>
										<td>Registration No.-</td>
										<td><input type="text" class="form-control text-uppercase"  name="pmt[reg_no]" value="<?php echo $pmt_reg_no;?>"></td>
										<td>Registration Date-</td>
										<td><input type="text" class="dob form-control text-uppercase"  name="pmt[reg_dt]" value="<?php echo $pmt_reg_dt;?>"></td>
									<tr>
										<td colspan="4">  (ii) Acknowledgement No. / Date of Entrepreneur Memorandum (EM) (if any) of DIPP :</td>
									</tr>
										<td>Registration No.-</td>
										<td><input type="text" class="form-control text-uppercase"  name="pmt[ack_no]" value="<?php echo $pmt_ack_no;?>"></td>
										<td>Registration Date-</td>
										<td><input type="text" class="dob form-control text-uppercase"  name="pmt[ack_dt]" value="<?php echo $pmt_ack_dt;?>"></td>
									</tr>	
									<tr>
										<td colspan="3">(B) If Service Sector, please indicate requisite  Registration / License No. from the concerned Department (if any)  : </td>
										<td><input type="text" class="form-control text-uppercase" name="pmt[lic_no]" value="<?php echo $pmt_lic_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">6. Particulars / Details of Fixed Capital Investment (in rupees) : 
										<table class="table table-responsive">
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
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[land1]" value="<?php echo $fixed_amount_land1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[land2]" value="<?php echo $fixed_amount_land2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $fixed_amount_land3=$fixed_amount_land1+$fixed_amount_land2;?>"></td>
											</tr>
											<tr>
												<td>b</td>
												<td>Site Development</td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[sd1]" value="<?php echo $fixed_amount_sd1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[sd2]" value="<?php echo $fixed_amount_sd2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $fixed_amount_sd3=$fixed_amount_sd1+$fixed_amount_sd2;?>"></td>
											</tr>
											<tr>
												<td>c</td>
												<td colspan="3">Building</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>(i) Factory</td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[fact1]" value="<?php echo $fixed_amount_fact1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[fact2]" value="<?php echo $fixed_amount_fact2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $fixed_amount_fact3=$fixed_amount_fact1+$fixed_amount_fact2;?>"></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>(ii) Office Building</td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[ob1]" value="<?php echo $fixed_amount_ob1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[ob2]" value="<?php echo $fixed_amount_ob2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $fixed_amount_ob3=$fixed_amount_ob1+$fixed_amount_ob2;?>"></td>
											</tr>
											<tr>
												<td>d</td>
												<td>Plant and Machinery/ Component items</td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[items1]" value="<?php echo $fixed_amount_items1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[items2]" value="<?php echo $fixed_amount_items2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $fixed_amount_items3=$fixed_amount_items1+$fixed_amount_items2;?>"></td>
											</tr>
											<tr>
												<td>e</td>
												<td>Electrical Installation</td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[ei1]" value="<?php echo $fixed_amount_ei1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[ei2]" value="<?php echo $fixed_amount_ei2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $fixed_amount_ei3=$fixed_amount_ei1+$fixed_amount_ei2;?>"></td>
											</tr>
											<tr>
												<td>f</td>
												<td>Preliminary & Preoperative expenses</td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[exp1]" value="<?php echo $fixed_amount_exp1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[exp2]" value="<?php echo $fixed_amount_exp2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $fixed_amount_exp3=$fixed_amount_exp1+$fixed_amount_exp2;?>"></td>
											</tr>
											<tr>
												<td>g</td>
												<td>Miscellaneous fixed assets</td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[mis1]" value="<?php echo $fixed_amount_mis1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="fixed_amount[mis2]" value="<?php echo $fixed_amount_mis2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled"  value="<?php echo $fixed_amount_mis3=$fixed_amount_mis1+$fixed_amount_mis2;?>"></td>
											</tr>
											<tr>
												<td></td>
												<td>Total</td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $fixed_amount_tot1=$fixed_amount_land1+$fixed_amount_ei1+$fixed_amount_exp1+$fixed_amount_fact1+$fixed_amount_items1+$fixed_amount_mis1+$fixed_amount_ob1+$fixed_amount_sd1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $fixed_amount_tot2=$fixed_amount_land2+$fixed_amount_ei2+$fixed_amount_exp2+$fixed_amount_fact2+$fixed_amount_items2+$fixed_amount_mis2+$fixed_amount_ob2+$fixed_amount_sd2;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $fixed_amount_tot3=$fixed_amount_land3+$fixed_amount_ei3+$fixed_amount_exp3+$fixed_amount_fact3+$fixed_amount_items3+$fixed_amount_mis3+$fixed_amount_ob3+$fixed_amount_sd3;?>"></td>
											</tr>
										</table></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save3a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="fileUpload" id="myform1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">		
									<tr>
										<td colspan="4">7. Details of Land and Building :<td>
									</tr>
									<tr>
										<td colspan="4">A. Land:</td>
									</tr>
									<tr>
										<td colspan="4">a) Own Land </td>
									</tr>
									<tr>
										<td width="25%">(i) Land area, Revenue village, Dag No. & Patta No.</td>
										<td width="25%"><input  type="text" class="form-control text-uppercase"  name="land[area]" value="<?php echo $land_area;?>"></td>
										<td width="25%">(ii) Date of Purchase</td>
										<td width="25%"><input  type="text" class=" dob form-control text-uppercase"  name="land[dt_pur]" value="<?php echo $land_dt_pur;?>"></td>
									</tr>
									<tr>
										<td>(iii) Date of Registration</td>
										<td><input  type="text" class=" dob form-control text-uppercase"  name="land[dt_reg]" value="<?php echo $land_dt_reg;?>"></td>
										<td >&nbsp;<td>
										<td >&nbsp;<td>
									</tr>
									<tr>
										<td colspan="4">b) Land Alloted by Government / Government Agency  </td>
									</tr>
									<tr>
										<td>(i) Date of allotment / agreement with area of land :</td>
										<td><input  type="text" class="dob form-control text-uppercase"  name="land[allot]" value="<?php echo $land_allot;?>"></td>
										<td>(ii) Date of taking over possession:</td>
										<td><input  type="text" class=" dob form-control text-uppercase"  name="land[dt_poss]" value="<?php echo $land_dt_poss;?>"></td>
									</tr>
									<tr>
										<td colspan="4">c) Lease hold land  </td>
									</tr>
									<tr>
										<td>(i) Date of Registration of lease deed :</td>
										<td><input  type="text" class="dob form-control text-uppercase"  name="land[dt_lease]" value="<?php echo $land_dt_lease;?>"></td>
										<td>(ii) Period of lease  :</td>
										<td><input  type="text" class=" form-control text-uppercase"  name="land[period]" validate="onlyNumbers" value="<?php echo $land_period;?>"></td>
									</tr>
									
									<tr>
										<td colspan="4">B. Building</td>
									</tr>
									<tr>
										<td>a) Building Type :</td>
										<td><select class="form-control text-uppercase" name="building[type]">
											<option value=" " >Select</option>
											<option value="R" <?php if($building_type=="R") echo "selected";?> >Rented</option>
											<option value="O" <?php if($building_type=="O") echo "selected";?>>Owned</option>
										</select></td>
										<td></td>
										<td></td>
									</tr>
									<tr> 
										<td colspan="4">b) In case of own building :</td>
									</tr>
									<tr>
										<td>(i)Build up area prior to expansion:</td>
										<td><input  type="text" class="form-control text-uppercase"  name="building[expan]" value="<?php echo $building_expan;?>"></td>
										<td>(ii) Proposed built up area after expansion :</td>
										<td><input  type="text" class=" form-control text-uppercase"  name="building[pro_built]" value="<?php echo $building_pro_built;?>"></td>
									</tr>
									<tr>
										<td colspan="4">8. Details of electricity utilization :</td>
									</tr>
									<tr>
										<td>(i) Sanctioned load prior to expansion :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="electricity[sanc]" value="<?php echo $electricity_sanc;?>"></td>
										<td>(ii) Connected load prior to expansion :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="electricity[connect]" value="<?php echo $electricity_connect;?>"></td>
									</tr>
									<tr>
										<td colspan="3">(iii) Whether requirement of additional load is essential for expansion. If so, the quantum of additional load required/applied for.</td>
										<td><input  type="text" class="form-control text-uppercase"  name="electricity[pro_built]" value="<?php echo $electricity_pro_built;?>"></td>
									</tr>
									<tr>
										<td colspan="4">9. Production Capacity : 
									<table name="objectTable1" id="objectTable1" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center" ></td>
										   <td align="center"></td>
										   <td colspan="2" align="center" >Annual installed capacity prior to expansion</td>
										   <td colspan="2" align="center" >Proposed annual installed capacity after expansion</td>
										</tr>
										<tr>
											<td align="center" >Sl No</td>
										   <td align="center">Name of the Product(s)/Service rendered</td>
										   <td align="center" >Quantity</td>
										   <td align="center" >Value in Rupees</td>
										   <td align="center" >Quantity</td>
										   <td align="center" >Value in Rupees</td>
										</tr>
									   <?php
										$part1=$dic->query("SELECT * FROM dic_form3_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
										  $count=1;
										  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["quantity1"]; ?>" validate="onlyNumbers" validate="onlyNumbers" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>
											<td><input value="<?php echo $row_1["rupees1"]; ?>" validate="onlyNumbers" id="txtD<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtD<?php echo $count;?>"></td>				
											<td><input value="<?php echo $row_1["quantity2"]; ?>" validate="onlyNumbers" id="txtE<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtE<?php echo $count;?>"></td>				
											<td><input value="<?php echo $row_1["rupees2"]; ?>" validate="onlyNumbers" id="txtF<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtF<?php echo $count;?>"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
										<td><input id="txtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtB1"></td>					
										<td><input  id="txtC1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txtC1"></td>
										<td><input id="txtD1" size="20" validate="specialChar" validate="onlyNumbers" class="form-control text-uppercase" name="txtD1"></td>			
										<td><input id="txtE1" size="20" validate="specialChar"  validate="onlyNumbers" class="form-control text-uppercase" name="txtE1"></td>			
										<td><input id="txtF1" size="20" validate="specialChar"  validate="onlyNumbers" class="form-control text-uppercase" name="txtF1"></td>			
									</tr>
									<?php } ?>
									<tbody>
									</table></td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
									</td>
								</tr>								
								<tr>
									<td colspan="4">10.
									<table name="objectTable2" id="objectTable2" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center"></td>
										   <td align="center"></td>
										   <td colspan="2" align="center">Annual requirement prior to expansion</td>
										   <td colspan="2" align="center">Proposed annual requiremen after expansion</td>
										</tr>
										<tr>
											<td align="center" >Sl No</td>
										   <td align="center">Raw Materials</td>
										   <td align="center" >Quantity</td>
										   <td align="center" >Value in Rupees</td>
										   <td align="center" >Quantity</td>
										   <td align="center" >Value in Rupees</td>
										</tr>
									   <?php
										$part2=$dic->query("SELECT * FROM dic_form3_t2 WHERE form_id='$form_id'");
										$num2 = $part2->num_rows;
										if($num2>0){
										  $count=1;
										  while($row_2=$part2->fetch_array()){	?>
										<tr>
											<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_2["name"]; ?>" id="textB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_2["quantity1"]; ?>" validate="onlyNumbers" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>
											<td><input value="<?php echo $row_2["rupees1"]; ?>" validate="onlyNumbers" id="textD<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textD<?php echo $count;?>"></td>				
											<td><input value="<?php echo $row_2["quantity2"]; ?>" validate="onlyNumbers" id="textE<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textE<?php echo $count;?>"></td>				
											<td><input value="<?php echo $row_2["rupees2"]; ?>" validate="onlyNumbers" id="textF<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textF<?php echo $count;?>"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
										<td><input id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>					
										<td><input  id="textC1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="textC1"></td>
										<td><input id="textD1" size="20" validate="specialChar" validate="onlyNumbers" class="form-control text-uppercase" name="textD1"></td>			
										<td><input id="textE1" size="20" validate="specialChar"  validate="onlyNumbers" class="form-control text-uppercase" name="textE1"></td>			
										<td><input id="textF1" size="20" validate="specialChar" validate="onlyNumbers" class="form-control text-uppercase" name="textF1"></td>			
									</tr>
									<?php } ?>
									<tbody>
									</table></td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore2()" value="">Add More</button>
										<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
									</td>
								</tr>
								<tr>
									<td colspan="4">11. Proposed Employment Generation in the unit in various fields of work :
								<table class="table table-responsive">									
									<tr>
										<td width="20%" align="center">Sl no  </td>
										<td width="20%" align="center">Employment Generation in the unit in various fields of work</td>
										<td width="20%" align="center">Prior to expansion</td>
										<td width="20%" align="center">Proposed additional employment for expansion</td>
										<td width="20%" align="center">Total</td>
									</tr>
									<tr>
										<td>(a) Managerial :   </td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[managerial1]"  value="<?php echo $proposed_managerial1;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[managerial2]"  value="<?php echo $proposed_managerial2;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[managerial3]"  value="<?php echo $proposed_managerial3;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"   disabled="disabled" value="<?php echo $proposed_managerial_tot=$proposed_managerial1+$proposed_managerial2+$proposed_managerial3;?>"></td>
									</tr>
									<tr>
										<td>(b) Supervisory Staff :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[ss1]" value="<?php echo $proposed_ss1;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[ss2]"  value="<?php echo $proposed_ss2;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[ss3]"  value="<?php echo $proposed_ss3;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $proposed_ss_tot=$proposed_ss1+$proposed_ss2+$proposed_ss3;?>"></td>
									</tr>
									<tr>									
										<td>(c) Skilled Worker :   </td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[skilled1]"  value="<?php echo $proposed_skilled1;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[skilled2]"  value="<?php echo $proposed_skilled2;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[skilled3]"  value="<?php echo $proposed_skilled3;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $proposed_skilled_tot=$proposed_skilled1+$proposed_skilled2+$proposed_skilled3;?>"></td>
									</tr>
									<tr>
										<td> (d) Semi Skilled Worker :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[semi_skilled1]" value="<?php echo $proposed_semi_skilled1;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[semi_skilled2]"  value="<?php echo $proposed_semi_skilled2;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[semi_skilled3]"  value="<?php echo $proposed_semi_skilled3;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $proposed_semi_skilled_tot=$proposed_semi_skilled1+$proposed_semi_skilled2+$proposed_semi_skilled3;?>"></td>
									</tr>								
									<tr>
										<td>(e) Unskilled Worker :   </td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[unskilled1]"  value="<?php echo $proposed_unskilled1;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[unskilled2]"  value="<?php echo $proposed_unskilled2;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[unskilled3]"  value="<?php echo $proposed_unskilled3;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"   disabled="disabled" value="<?php echo $proposed_unskilled_tot=$proposed_unskilled1+$proposed_unskilled2+$proposed_unskilled3;?>"></td>
									</tr>								
									<tr>
										<td>(f) Others :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[others1]" value="<?php echo $proposed_others1;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[others2]"  value="<?php echo $proposed_others2;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  name="proposed[others3]"  value="<?php echo $proposed_others3;?>"></td>
										<td><input  type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $proposed_others_tot=$proposed_others1+$proposed_others2+$proposed_others3;?>"></td>
									</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">12. Declaration</td>
								</tr>
								<tr>
									<td>Name of the Applicant(s) :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $key_person;?>"></td>
									<td> &nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td >Place :<label class="text-uppercase"><?php echo $dist;?></label> <br/> Date :<b><?php echo $today; ?></b></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>																					
								<tr>										
									<td class="text-center" colspan="4">
										<a href="dic_form3.php?tab=1"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>
										<button type="submit" class="btn btn-success" name="save3b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
									</td>									
								</tr>
							</table>
							</form>
						</div>
						<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
						<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
						<table class="table table-responsive">
							<tr>
									<td colspan="4">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>							
								<tr>
									<td colspan="5"> Constitution of the unit.</td>
								<tr>
									<td>(a) In case of Private Limited / Public Limited Company<br/>
									i. Registration Certificate under Companies Act<br/>ii. Memorandum of Article of Association<br/>iii. Names and address of the Directors with their PAN number<br/> (b) In case of Partnership Firm<br/>i. Deed of Partnership<br/> ii. General Power of Attorney<br/>iii. Names & address of the Partners with their PAN number<br/>    (c) In case of Co-operative Society<br/> i. Registration Certificate from the Jt. Register of Co-operative Society<br/> ii. Resolution of the General Body for registration of the unit<br/>iii. Article of memorandum of Association</td>
									<td width="10%">
									<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
									</td>
									<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
									<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td colspan="4"> Registration</td>									
								</tr>
								<tr>
									<td> (a) Permanent (PMT) registration/Entrepreneurs Memorandum (EM) Part-2 / IEM / LOI / IL (wherever applicable)</td>
									<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?> >
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
									<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo 'No File Selected'; } ?></td>
									<td><input type="CheckBox" id="B1" class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td> (b) Certificate of Mandatory/Obligatory registration/approval from the concerned department as applicable. (in case of service sector unit)</td>
									<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
									<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="C1"  class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file2!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td> Project Report</td>
									<td><select trigger="FileModal" class="file4" id="file4" <?php if($file4!="" || $file4=="SC" || $file4=="NA") echo "disabled='disabled'"; ?> >
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile4" value="<?php if($file4!="") echo $file4; ?>" id="mfile4" readonly="readonly"/></td>
									<td width="20%" id="mfile4-chiranjit"><?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file4" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td> Mandatory No Objection Certificate from local body/authority (e.g Pollution Control Board etc)</td>
									<td><select trigger="FileModal" class="file5" id="file5" <?php if($file5!="" || $file5=="SC" || $file5=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile5" value="<?php if($file5!="") echo $file5; ?>" id="mfile5" readonly="readonly"/></td>
									<td width="20%" id="mfile5-chiranjit"><?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="E1" class="file5" name="E1" <?php if($file5=="NA") echo "checked"; ?> <?php if($file5!="" && $file5!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="E2" class="file5 cd" name="E2" <?php if($file5=="SC") echo "checked"; ?> <?php if($file5!="" && $file5!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td> Term loan sanction letter from Bank/Financial Institution</td>
									<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
									<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file6" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="F1" class="file6" name="F1" <?php if($file6=="NA") echo "checked"; ?> <?php if($file6!="" && $file6!="NA") echo "disabled='disabled'"; ?> value='F1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="F2" class="file6 cd" name="F2" <?php if($file6=="SC") echo "checked"; ?> <?php if($file6!="" && $file6!="SC") echo "disabled='disabled'"; ?> value='F2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td> Land & Building (existing)<br/>(a) In case of own land<br/> Purchase deed/gift deed/any other document to establish the ownership<br/>(b) In case of Industrial land alloted by any Government Agency<br/>i. Deed of agreement<br/>ii. Uptodate rent receipt<br/>(c) In case of Industrial land alloted by any Government Agency<br/>i. Deed of agreement<br/> ii. Uptodate rent receipt<br/>(d) In case of leasehold land from a private owner<br/> i. Registered Lease deed<br/> (e) In case of Government land/plot alloted by Government<br/> i. Allotment letter and trace map<br/>ii. Premium payment receipt</td>
									<td><select trigger="FileModal" class="file7" id="file7" <?php if($file7!="" || $file7=="SC" || $file7=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile7" value="<?php if($file7!="") echo $file7; ?>" id="mfile7" readonly="readonly"/></td>
									<td width="20%" id="mfile7-chiranjit"><?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="G1" class="file7" name="G1" <?php if($file7=="NA") echo "checked"; ?> <?php if($file7!="" && $file7!="NA") echo "disabled='disabled'"; ?> value='F1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="G2" class="file7 cd" name="G2" <?php if($file7=="SC") echo "checked"; ?> <?php if($file7!="" && $file7!="SC") echo "disabled='disabled'"; ?> value='F2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td> Power sanction letter from State Electricity Board/Competent authority</td>
									<td><select trigger="FileModal" class="file8" id="file8" <?php if($file8!="" || $file8=="SC" || $file8=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile8" value="<?php if($file8!="") echo $file8; ?>" id="mfile8" readonly="readonly"/></td>
									<td width="20%" id="mfile8-chiranjit"><?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="H1" class="file8" name="H1" <?php if($file8=="NA") echo "checked"; ?> <?php if($file8!="" && $file8!="NA") echo "disabled='disabled'"; ?> value='H1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="H2" class="file8 cd" name="H2" <?php if($file8=="SC") echo "checked"; ?> <?php if($file8!="" && $file8!="SC") echo "disabled='disabled'"; ?> value='H2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td>NOC / Consent for operation from Pollution Control Board</td>
									<td><select trigger="FileModal" class="file9" id="file9" <?php if($file9!="" || $file9=="SC" || $file9=="NA") echo "disabled='disabled'"; ?>>
											<option value="0" selected="selected">Select</option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
										</select>
									<input type="hidden" name="mfile9" value="<?php if($file9!="") echo $file9; ?>" id="mfile9" readonly="readonly"/></td>
									<td width="20%" id="mfile9-chiranjit"><?php if($file9!="" && $file9!="SC" && $file9!="NA"){ echo '<a href="'.$upload.$file9.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file9" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="I1" class="file9" name="I1" <?php if($file9=="NA") echo "checked"; ?> <?php if($file9!="" && $file9!="NA") echo "disabled='disabled'"; ?> value='I1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="I2" class="file9 cd" name="I2" <?php if($file9=="SC") echo "checked"; ?> <?php if($file9!="" && $file9!="SC") echo "disabled='disabled'"; ?> value='I2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td>List of employees with name, address and designation</td>
									<td><select trigger="FileModal" class="file10" id="file10" <?php if($file10!="" || $file10=="SC" || $file10=="NA") echo "disabled='disabled'"; ?>>
											<option value="0" selected="selected">Select</option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
										</select>
									<input type="hidden" name="mfile10" value="<?php if($file10!="") echo $file10; ?>" id="mfile10" readonly="readonly"/></td>
									<td width="20%" id="mfile10-chiranjit"><?php if($file10!="" && $file10!="SC" && $file10!="NA"){ echo '<a href="'.$upload.$file10.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file10" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="J1" class="file10" name="J1" <?php if($file10=="NA") echo "checked"; ?> <?php if($file10!="" && $file10!="NA") echo "disabled='disabled'"; ?> value='J1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="J2" class="file10 cd" name="J2" <?php if($file10=="SC") echo "checked"; ?> <?php if($file10!="" && $file10!="SC") echo "disabled='disabled'"; ?> value='J2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td>Audited Balance sheet for the last three accounting years</td>
									<td><select trigger="FileModal" class="file11" id="file11" <?php if($file11!="" || $file11=="SC" || $file11=="NA") echo "disabled='disabled'"; ?>>
											<option value="0" selected="selected">Select</option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
										</select>
									<input type="hidden" name="mfile11" value="<?php if($file11!="") echo $file11; ?>" id="mfile11" readonly="readonly"/></td>
									<td width="20%" id="mfile11-chiranjit"><?php if($file11!="" && $file11!="SC" && $file11!="NA"){ echo '<a href="'.$upload.$file11.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file11" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="K1" class="file11" name="K1" <?php if($file11=="NA") echo "checked"; ?> <?php if($file11!="" && $file11!="NA") echo "disabled='disabled'"; ?> value='K1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="K2" class="file11 cd" name="K2" <?php if($file11=="SC") echo "checked"; ?> <?php if($file11!="" && $file11!="SC") echo "disabled='disabled'"; ?> value='K2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td>Tea Board Registration Certificate (in case of Tea Factories)</td>
									<td><select trigger="FileModal" class="file12" id="file12" <?php if($file12!="" || $file12=="SC" || $file12=="NA") echo "disabled='disabled'"; ?>>
											<option value="0" selected="selected">Select</option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
										</select>
									<input type="hidden" name="mfile12" value="<?php if($file12!="") echo $file12; ?>" id="mfile12" readonly="readonly"/></td>
									<td width="20%" id="mfile12-chiranjit"><?php if($file12!="" && $file12!="SC" && $file12!="NA"){ echo '<a href="'.$upload.$file12.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file12" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="L1" class="file12" name="L1" <?php if($file12=="NA") echo "checked"; ?> <?php if($file12!="" && $file12!="NA") echo "disabled='disabled'"; ?> value='L1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="L2" class="file12 cd" name="L2" <?php if($file12=="SC") echo "checked"; ?> <?php if($file12!="" && $file12!="SC") echo "disabled='disabled'"; ?> value='L2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td>Any other document that may be required as per directions of State Government / Directorate of Industries & Commerce</td>
									<td><select trigger="FileModal" class="file13" id="file13" <?php if($file13!="" || $file13=="SC" || $file13=="NA") echo "disabled='disabled'"; ?>>
											<option value="0" selected="selected">Select</option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
										</select>
									<input type="hidden" name="mfile13" value="<?php if($file13!="") echo $file13; ?>" id="mfile13" readonly="readonly"/></td>
									<td width="20%" id="mfile13-chiranjit"><?php if($file13!="" && $file13!="SC" && $file13!="NA"){ echo '<a href="'.$upload.$file13.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file13" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="M1" class="file13" name="M1" <?php if($file13=="NA") echo "checked"; ?> <?php if($file13!="" && $file13!="NA") echo "disabled='disabled'"; ?> value='M1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="M2" class="file13 cd" name="M2" <?php if($file13=="SC") echo "checked"; ?> <?php if($file13!="" && $file13!="SC") echo "disabled='disabled'"; ?> value='M2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>							
									<td class="text-center" colspan="4">
										<a href="dic_form3.php?tab=2"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success" name="save3c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
									</td>							
								</tr>
						</table>
			
					</div>
				</div>
			</div>
		</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>