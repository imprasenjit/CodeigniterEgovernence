<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dic','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=dic';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=2&dept=dic';
		</script>";
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
	
	$q=$dic->query("select * from dic_form2 where user_id='$swr_id'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";
		$power="";$raw_meterial="";$total_investment="";
		##### Part A #######
		$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
		##### Part B #######
		$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_tot="";
		$proposed_managerial="";$proposed_skilled="";$proposed_unskilled="";$proposed_semi_skilled="";$proposed_ss="";$proposed_others=""; 
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}else{
		$form_id=$results['form_id'];	
		$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];
		$power=$results['power'];$raw_meterial=$results['raw_meterial'];$total_investment=$results['total_investment'];
		##### Part A #######
		if(!empty($results["ack"])){
			$ack=json_decode($results["ack"]);
			$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_lic_no=$ack->lic_no;
		}else{
			$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
		}
		##### Part B #######
		
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
			$fixed_amount_land=$fixed_amount->land;$fixed_amount_site_dev=$fixed_amount->site_dev;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";
		}
		if(!empty($results["proposed"])){
			$proposed=json_decode($results["proposed"]);
			$proposed_managerial=$proposed->managerial;
			$proposed_skilled=$proposed->skilled;$proposed_semi_skilled=$proposed->semi_skilled;$proposed_unskilled=$proposed->unskilled;$proposed_ss=$proposed->ss;
			$proposed_others=$proposed->others;
		}else{
			$proposed_managerial="";$proposed_skilled="";$proposed_unskilled="";$proposed_semi_skilled="";$proposed_ss="";$proposed_others="";
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
	<?php include ("dic_form2_Addmore-operation.php"); ?> <!-- File handles 'Addmore' Operation -->
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
									<strong>FORM - 1(A)<br/><?php echo $form_name=$formFunctions->get_formName('dic','2'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PART II</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">Upload Section</a></li>
								</ul>
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
										<td colspan=4>(b) Name(s), address(es), of the Proprietor / Partners /           Directors of Board of Directors / Secretary and  President of the Cooperative Society : </td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable2" id="objectTable2" class="table table-responsive">
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
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
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
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
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
										<td>3. Proposed date of commencement of commercial production of unit :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $date_of_commencement;?>"></td>
										<td>4. Whether the industrial unit falls under Manufacturing sector OR Service sector :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $business_type; ?>"></td>
									</tr>	
									<tr>
										<td colspan="4">5. Details of Registration with the concerned Department<br>(A). If Manufacturing Sector, please indicate :</td>
									<tr>
									<tr>
										<td colspan="4">  (i) Acknowledgement No. / Date of Entrepreneur Memorandum (EM), Part-1 (if any) of MSME :</td>
									</tr>
									<tr>
										<td>Acknowledgement No.</td>
										<td><input type="text" class="form-control text-uppercase"  name="ack[pm_no]" value="<?php echo $ack_pm_no;?>"></td>
										<td>Date of Entrepreneur Memorandum (EM):</td>
										<td><input type="text" class="dob form-control text-uppercase"  name="ack[pm_dt]" value="<?php echo $ack_pm_dt;?>"></td>
									</tr>
									<tr>
										<td colspan="4">   (ii) Acknowledgement No. / Date of Industrial Entrepreneur Memorandum (EM) (if any) of DIPP :</td>
									</tr>
									<tr>
										<td>Acknowledgement No. :</td>
										<td><input type="text" class=" form-control text-uppercase" name="ack[ind_no]" requried="required" value="<?php echo $ack_ind_no;?>"></td>
										<td>Date of Industrial Entrepreneur Memorandum (EM) :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="ack[ind_dt]" requried="required" value="<?php echo $ack_ind_dt;?>"></td>
				 					</tr>	
									<tr>
										<td colspan="3">(B) If Service Sector, please indicate requisite Registration / License No. from the concerned  Department (if any)  : </td>
										<td><input type="text" class="form-control text-uppercase" name="ack[lic_no]" value="<?php echo $ack_lic_no;?>"></td>
									</tr>																	
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save2a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
										<td colspan="4">6. Particulars / Details of Fixed Capital Investment proposed    (Amount in Rs.) : </td>
									</tr>
									<tr>
										<td> (a) Land :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[land]" value="<?php echo $fixed_amount_land;?>"></td>
										<td>(b) Site Development :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[site_dev]" value="<?php echo $fixed_amount_site_dev;?>"></td>
									</tr>
									<tr>
										<td colspan="4"><b>(c) Building</b></td>
									</tr>
									<tr>
										<td>(i) Factory Building :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[fb]" value="<?php echo$fixed_amount_fb;?>"></td>
										<td>(ii) Office Building :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[ob]" value="<?php echo $fixed_amount_ob;?>"></td>
									</tr>
									<tr>
										<td>(d) Plant and Machinery / Component / Items : </td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[pm]" value="<?php echo $fixed_amount_pm;?>" ></td>
										<td>(e) Electrical Installation :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[ei]" value="<?php echo $fixed_amount_ei;?>" ></td>
									</tr>
									<tr>
										<td>(f) Preliminary & pre-operative expenses : </td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[pe]" value="<?php echo $fixed_amount_pe;?>" ></td>
										<td> (g) Miscellaneous fixed assets :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[m]" value="<?php echo $fixed_amount_m;?>" ></td>
									</tr>
									<tr>
										<td>Total : </td>
										<td><input  type="text" class="form-control text-uppercase" id="fixed_amount_total"  name="total_investment" value="<?php echo $total_investment;?>" ></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>7. Proposed requirement of Power / Electricity (KW/MW) : </td>
										<td><input  type="text" class="form-control text-uppercase"  name="power" value="<?php echo $power;?>" ></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">8. Annual Production Capacity proposed :</td>
									</tr>
								<tr>
									<td colspan="4"> 
									<table name="objectTable1" id="objectTable1" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Name of the Product(s)/Services rendered</td>
										   <td align="center">Quantity</td>
										   <td align="center">Value in Rupees</td>
										</tr>
									   <?php
										$part1=$dic->query("SELECT * FROM dic_form2_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
										  $count=1;
										  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["quantity"]; ?>" id="txtC<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtC<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["rupees"]; ?>" validate="onlyNumbers" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1" size="1"></td>
										<td><input id="txtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtB1"></td>
										<td><input  id="txtC1" size="20" class="form-control text-uppercase"  name="txtC1"></td>					
										<td><input  id="txtD1" size="20" class="form-control text-uppercase"  name="txtD1"></td>
									</tr>
									<?php } ?>
									<tbody>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
									</td>
								</tr>								
								<tr>
									<td>9. Name(s) of Raw Materials used :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="raw_meterial"  value="<?php echo $raw_meterial;?>"></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>								
								<tr>
									<td colspan="4">10. Proposed Employment Generation in the unit in various fields of work</td>
								</tr>								
								<tr>
									<td>(a) Managerial :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[managerial]"  value="<?php echo $proposed_managerial;?>"></td>
									<td>(b) Supervisory Staff :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[ss]" value="<?php echo $proposed_ss;?>"></td>
								</tr>								
								<tr>
									<td>(c) Skilled Worker :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[skilled]"  value="<?php echo $proposed_skilled;?>"></td>
									<td> (d) Semi Skilled Worker :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[semi_skilled]" value="<?php echo $proposed_semi_skilled;?>"></td>
								</tr>								
								<tr>
									<td>(e) Unskilled Worker :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[unskilled]"  value="<?php echo $proposed_unskilled;?>"></td>
									<td>(f) Others :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[others]" value="<?php echo $proposed_others;?>"></td>
								</tr>
								<tr>
									<td>11. Name of the Applicant(s) :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $key_person;?>"></td>
									<td> &nbsp;</td>
									<td>&nbsp;</td>
								</tr>
									<tr>
										<td > Place :<label><?php echo $dist;?></label> <br/> Date :<b><?php echo $today; ?></b></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>																					
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save2b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
									i. Registration Certificate under Companies Act<br/>ii. Memorandum of Article of Association<br/>iii. Names and address of the Directors with their PAN number<br/> (b) In case of Partnership Firm<br/>i. Deed of Partnership<br/> ii. Name and address of the Partners with their PAN number<br/>iii. General Power of Attorney<br/>    (c) In case of Co-operative Society<br/> i. Registration Certificate<br/> ii. Article of memorandum of Association<br/>iii. Resolution of the General Body Meeting for registration of the unit</td>
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
									<td>  (a) EM Part-1, Part-2 / IEM / LOI / IL (if any)</td>
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
									<td>Mandatory 'No Objection Certificate' from local body / any other authrity. (e.g Pollution Control Board etc.)</td>
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
									<td> Sanction letter of term loan / working capital loan, if any, from Bank/Financial Institution concerned</td>
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
									<td> Certificate of Mandatory / Obligatory registration / approval from the concerned Department as applicable (in the case of Service sector units)</td>
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
									<td> Any other document that may be required as per direction of State Government/Directorate of Industries.</td>
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
									<td class="text-center" colspan="4">
										<a href="dic_form2.php?tab=2"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success" name="save2c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
									</td>							
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
	
	$('.addTotal').on('change', function(){
		var sum = 0;
		$('.addTotal').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#fixed_amount_total').val(sum);
		});
	});
	/* ----------------------------------------------------- */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>