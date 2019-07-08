<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dic','8');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=8&dept=dic';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=8&dept=dic';
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
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$l_o_business=$row1['Type_of_ownership'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="promotersship Firm";$l_o_business_name="promoterss";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability promotersship";$l_o_business_name="promoterss";
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
	$q=$dic->query("select * from dic_form8 where user_id='$swr_id'") or die($dci->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){
		$form_id="";
		###### PART I #####
		$claim_period_form="";$claim_period_to="";$item_of_product="";$promoters_name="";
		$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		$promoters_address_st1="";$promoters_address_st2="";$promoters_address_vt="";$promoters_address_dist="";$promoters_address_pin="";$promoters_address_mob="";
		###### PART II #####
		$date_of_comm="";$date_of_service="";$cert_no="";$cert_date="";$period_from="";$period_to="";
		$new_unit_sanction="";$new_unit_dt="";$new_unit_load="";$new_unit_sl_no="";$new_unit_initial_meter="";
		$exist_unit_power="";$exist_unit_load="";$exist_unit_tot_load="";$exist_unit_sl_no="";$exist_unit_initial_meter="";$exist_unit_last_meter="";
		$percentage_of_increase="";$mothly_statement="";
	}else{
		$form_id=$results['form_id'];
		###### PART I #####
		$claim_period_form=$results['claim_period_form'];$claim_period_to=$results['claim_period_to'];$item_of_product=$results['item_of_product'];$promoters_name=$results['promoters_name'];
		if(!empty($results["office_address"])){
			$office_address=json_decode($results["office_address"]);
			$office_address_st1=$office_address->st1;$office_address_st2=$office_address->st2;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
		}else{
			$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		}
		if(!empty($results["promoters_address"])){
			$promoters_address=json_decode($results["promoters_address"]);
			$promoters_address_st1=$promoters_address->st1;$promoters_address_st2=$promoters_address->st2;$promoters_address_vt=$promoters_address->vt;$promoters_address_dist=$promoters_address->dist;$promoters_address_pin=$promoters_address->pin;$promoters_address_mob=$promoters_address->mob;
		}else{
			$promoters_address_st1="";$promoters_address_st2="";$promoters_address_vt="";$promoters_address_dist="";$promoters_address_pin="";$promoters_address_mob="";$promoters_address_email="";
		}
		###### PART II #####
		$date_of_comm=$results['date_of_comm'];$date_of_service=$results['date_of_service'];$cert_no=$results['cert_no'];$cert_date=$results['cert_date'];$period_from=$results['period_from'];$period_to=$results['period_to'];$mothly_statement=$results['mothly_statement'];$percentage_of_increase=$results['percentage_of_increase'];
		if(!empty($results["new_unit"])){
			$new_unit=json_decode($results["new_unit"]);
			$new_unit_sanction=$new_unit->sanction;$new_unit_dt=$new_unit->dt;$new_unit_load=$new_unit->load;$new_unit_sl_no=$new_unit->sl_no;$new_unit_initial_meter=$new_unit->initial_meter;
		}else{
			$new_unit_sanction="";$new_unit_dt="";$new_unit_load="";$new_unit_sl_no="";$new_unit_initial_meter="";
		}
		if(!empty($results["exist_unit"])){
			$exist_unit=json_decode($results["exist_unit"]);
			$exist_unit_power=$exist_unit->power;$exist_unit_load=$exist_unit->load;$exist_unit_tot_load=$exist_unit->tot_load;$exist_unit_sl_no=$exist_unit->sl_no;$exist_unit_initial_meter=$exist_unit->initial_meter;$exist_unit_last_meter=$exist_unit->last_meter;
		}else{
			$exist_unit_power="";$exist_unit_load="";$exist_unit_tot_load="";$exist_unit_sl_no="";$exist_unit_initial_meter="";$exist_unit_last_meter="";
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
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==7){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="active";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==8){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="active";$tabbtn9="";
	}
	if($showtab==9){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn10="active";
	}
	if($showtab==10){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";$tabbtn10="active";
	}
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
								<h4 class="text-center"><strong><?php echo $form_name=$formFunctions->get_formName('dic','8'); ?></strong></h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td>1. Name of the Unit : </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td>PAN</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $pan_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(a). Address of the Factory :  </td>					
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
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Address of the Office :   </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="office_address[st1]" required="required" value="<?php echo $office_address_st1;?>" validate="specialchar"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="office_address[st2]" value="<?php echo $office_address_st2;?>" validate="specialchar"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[vt]" value="<?php echo $office_address_vt;?>" validate="specialchar"></td>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="office_address[dist]"" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($office_address_dist) && ($office_address_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[pin]" value="<?php echo $office_address_pin;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[mob]" value="<?php echo $office_address_mob;?>" validate="mobileNumber" maxlength="10"></td>
									</tr>	
									<tr>
										<td>d) E-Mail ID</td>
										<td><input type="email" class="form-control" name="office_address[email]" value="<?php echo $office_address_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">2. Period of Claim :</td>
									</tr>
									<tr>
										<td>From </td>
										<td width="25%"> <input type="text" class="form-control text-uppercase dob" required="required" name="claim_period_form" value="<?php echo $claim_period_form;?>" readonly="readonly"></td>
										<td> To </td>
										<td><input type="text" class="form-control text-uppercase dob3" required="required" name="claim_period_to" value="<?php echo $claim_period_to;?>" readonly="readonly"></td>
									</tr>
									<tr>
										<td>3.Name & Address of the promoter(s)* :</td>
									</tr>
									<tr>
										<td width="25%">(a)Name</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="promoters_name" validate="letters" value="<?php echo $promoters_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									<tr>
										<td colspan="4">(b)Address </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="promoters_address[st1]" value="<?php echo $promoters_address_st1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="promoters_address[st2]" value="<?php echo $promoters_address_st2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="promoters_address[vt]" value="<?php echo $promoters_address_vt;?>"></td>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="promoters_address[dist]"" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($promoters_address_dist) && ($promoters_address_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="promoters_address[pin]" value="<?php echo $promoters_address_pin;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="promoters_address[mob]" validate="mobileNumber" maxlength="10" value="<?php echo $promoters_address_mob;?>"></td>
									</tr>
										
									</tr>
									
									<tr>
										<td>4. Items of production/service rendered:  </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="item_of_product" value="<?php echo $item_of_product; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save8a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>									
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">	
									<tr>
										<td width="25">5. (a) Date of commencement of commercial production/ service ( initial) :  </td>
										<td width="25"><input type="text" class="form-control text-uppercase dob" required="required" name="date_of_comm" value="<?php echo $date_of_comm;?>" readonly="readonly"></td>			
										<td width="25">(b)Date of commencement of production or service after substantial expansion/declaring :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase dob" required="required" name="date_of_service" value="<?php echo $date_of_service;?>" readonly="readonly"></td>	
									</tr>
									<tr>
										<td colspan="4">6. No and date of Eligibility certificate*:</td>
									</tr>
									<tr>
										<td> No:   </td>
										<td width="25%"> <input type="text" class="form-control text-uppercase" required="required" name="cert_no" value="<?php echo $cert_no;?>"></td>
										<td>Date</td>
										<td><input type="text" class="dob form-control text-uppercase" required="required" name="cert_date" value="<?php echo $cert_date;?>" readonly="readonly"></td>
									</tr>
									<tr>        
										<td colspan="4">7. Period of eligibility for availing power subsidy as per EC*:</td>
									</tr>
									<tr>
										<td>From </td>
										<td width="25%"><input type="text" class="form-control text-uppercase dob" required="required" name="period_from" value="<?php echo $period_from;?>" readonly="readonly"></td>
										<td>To</td>
										<td><input type="text" class="form-control text-uppercase dob3" required="required" name="period_to" value="<?php echo $period_to;?>" readonly="readonly"></td>
										
									</tr>	 
									<tr>
										<td colspan="4"> 8.Details of power connection in case of New unit:</td>
									</tr>
									
									<tr>
										<td  colspan="4">(a) Total Electrical power sanctioned and date of sanctioned:</td>
									</tr>
										<tr>
										<td width="25%">Sanction</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="new_unit[sanction]" value="<?php echo $new_unit_sanction;?>"></td>
										<td width="25%">Date</td>
										<td width="25%"> <input type="text" class="form-control text-uppercase dob" required="required" name="new_unit[dt]" value="<?php echo $new_unit_dt; ?>" readonly="readonly"></td>
									</tr>
									<tr>									
										<td width="25%">(b) Total electrical load connected:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="new_unit[load]" value="<?php echo $new_unit_load;?>"></td>									
										<td width="25%">(c)Sl no of energy meter(s) allotted:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="new_unit[sl_no]" value="<?php echo $new_unit_sl_no;?>"></td>
									
									<tr>
										<td width="25%">(d) Initial energy meter reading</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="new_unit[initial_meter]" value="<?php echo $new_unit_initial_meter;?>"></td>
									</tr>
									<tr>
										<td colspan="4">9.Details of power connection in case of existing unit undertaking substantial expansion/sick unit</td>
									</tr>
									<tr>
										<td width="25%">(a) Additional electrical power sanctioned by ASEB , if any:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[power]" value="<?php echo $exist_unit_power;?>"></td>		
										<td width="25%">(b) Additional electrical load connected:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required"  name="exist_unit[load]" value="<?php echo $exist_unit_load;?>"></td>
									</tr>
									<tr>
										<td width="25%">(c) Total electrical load connected:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[tot_load]" value="<?php echo $exist_unit_tot_load;?>"></td>
										<td width="25%">(d) Sl no of energy meter(s) allotted by ASEB for additional Power connection provided:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[sl_no]" value="<?php echo $exist_unit_sl_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">(e) Initial meter reading of the new energy meter provided:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[initial_meter]" value="<?php echo $exist_unit_initial_meter;?>"></td>
									
										<td width="25%">(f) Last meter reading prior to substantial expansion/declaring as a sick etc:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[last_meter]" value="<?php echo $exist_unit_last_meter;?>"></td>
									</tr>
									<tr>
										<td colspan="4">10.Statement showing the monthly electricity consumption:</br>
										    ( to be submitted separately as per guidelines mentioned earlier) </td>
									</tr>
									<tr>												
										<td>Upload File:</td>
										<td>
										<select trigger="FileModal" id="file1" class="form-control text-uppercase file1" <?php if($mothly_statement!="" || $mothly_statement=="SC" || $mothly_statement=="NA") echo "disabled='disabled'"; ?>>
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mothly_statement" value="<?php if($mothly_statement!="") echo $mothly_statement; ?>" id="mfile1" value=""/>					
										</td>
										<td id="mfile1-chiranjit"><?php if($mothly_statement!="" && $mothly_statement!="SC" && $mothly_statement!="NA"){ echo '<a href="'.$upload.$mothly_statement.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($mothly_statement=="NA") echo "checked"; ?>  value='A1' <?php if($mothly_statement!="" && $mothly_statement!="NA") echo "disabled"; ?> onClick="checkData(this)"/>&nbsp;Not Applicable&nbsp;&nbsp; <input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($mothly_statement=="SC") echo "checked"; ?> value='A2' <?php if($mothly_statement!="" && $mothly_statement!="SC") echo "disabled"; ?> onClick="checkData(this)"/>&nbsp;Send By Courier</td>				
									</tr>
									<tr>
										<td width="25%">11.Percentage of Increase in fixed capital investment as per EC:
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required"  name="percentage_of_increase" value="<?php echo $percentage_of_increase;?>"></td>
										<td></td>
										<td></td>										
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="dic_form8.php?tab=1" type="button" class=" btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success" name="save8b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
									<tr>
				
										<td>Date : <label><?php echo date('d-m-Y',strtotime($today));?></label></td>
										<td></td>
										<td></td>
										<td align="right"> <label><?php echo strtoupper($key_person) ?></label><br/>
										Signature of the applicant</td>
									</tr>
										
										
								
								</table>
								</form>
								</div>
						
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
</script>
</body>
</html>