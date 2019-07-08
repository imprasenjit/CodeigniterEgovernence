<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="22";
$table_name=$formFunctions->getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_hw_form.php";

$email=$formFunctions->get_usermail($swr_id);
$row1=$formFunctions->fetch_swr($swr_id);
$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
$from=$key_person."\nAddress : ".$street_name1." ".$street_name2."\nVill/Town : ".$vill.",".$dist."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nE-mail ID : ".$email;
$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
$q=$doa->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($doa->error);
if($q->num_rows<1){	 
	$p=$doa->query("select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") or die($doa->error);
	if($p->num_rows>0){
		$results=$p->fetch_assoc();	
		$form_id=$results['form_id'];
		####### PART I #######
		$year_of_comm=$results['year_of_comm'];
		if(!empty($results["occupier_add"])){
			$occupier_add=json_decode($results["occupier_add"]);
			$occupier_add_name=$occupier_add->name;$occupier_add_desig=$occupier_add->desig;$occupier_add_mob_no=$occupier_add->mob_no;$occupier_add_email=$occupier_add->email;
		}else{
			$occupier_add_name="";$occupier_add_desig="";$occupier_add_mob_no="";$occupier_add_email="";
		}
		if(!empty($results["auth_req"])){
			$auth_req=json_decode($results["auth_req"]);
			if(isset($auth_req->gen)) $auth_req_gen=$auth_req->gen;
			else $auth_req_gen="";
			if(isset($auth_req->col)) $auth_req_col=$auth_req->col;
			else $auth_req_col="";
			if(isset($auth_req->str)) $auth_req_str=$auth_req->str;
			else $auth_req_str="";				
			if(isset($auth_req->transport)) $auth_req_transport=$auth_req->transport;
			else $auth_req_transport="";
			if(isset($auth_req->recept)) $auth_req_recept=$auth_req->recept;
			else $auth_req_recept="";
			if(isset($auth_req->reuse)) $auth_req_reuse=$auth_req->reuse;
			else $auth_req_reuse="";
			if(isset($auth_req->recycle)) $auth_req_recycle=$auth_req->recycle;
			else $auth_req_recycle="";
			if(isset($auth_req->rec)) $auth_req_rec=$auth_req->rec;
			else $auth_req_rec="";
			if(isset($auth_req->pre)) $auth_req_pre=$auth_req->pre;
			else $auth_req_pre="";
			if(isset($auth_req->co)) $auth_req_co=$auth_req->co;
			else $auth_req_co="";
			if(isset($auth_req->uti)) $auth_req_uti=$auth_req->uti;
			else $auth_req_uti="";
			if(isset($auth_req->treat)) $auth_req_treat=$auth_req->treat;
			else $auth_req_treat="";
			if(isset($auth_req->disp)) $auth_req_disp=$auth_req->disp;
			else $auth_req_disp="";
			if(isset($auth_req->inci)) $auth_req_inci=$auth_req->inci;
			else $auth_req_inci="";
		}else{
			$auth_req_gen="";$auth_req_col="";$auth_req_str="";$auth_req_transport="";$auth_req_recept="";$auth_req_reuse="";$auth_req_recycle="";$auth_req_rec="";$auth_req_pre="";$auth_req_co="";$auth_req_uti="";$auth_req_treat="";$auth_req_disp="";$auth_req_inci="";
		}	
		if(!empty($results["ren_auth"])){
			$ren_auth=json_decode($results["ren_auth"]);
			$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
		}else{
			$ren_auth_no="";$ren_auth_dt="";
		}		
		if(!empty($results["ind_work"])){
			$ind_work=json_decode($results["ind_work"]);
			if(isset($ind_work->one)) $ind_work_one=$ind_work->one;
			else $ind_work_one="";
			if(isset($ind_work->two)) $ind_work_two=$ind_work->two;
			else $ind_work_two="";
			if(isset($ind_work->clock)) $ind_work_clock=$ind_work->clock;
			else $ind_work_clock="";				
		}else{
			$ind_work_one="";$ind_work_two="";$ind_work_clock="";
		}
		##### PART II ######
		$is_generator=$results['is_generator'];$env_details=$results['env_details'];
		if(!empty($results["mode_of_manage"])){
			$mode_of_manage=json_decode($results["mode_of_manage"]);
			$mode_of_manage_cap=$mode_of_manage->cap;$mode_of_manage_plant=$mode_of_manage->plant;$mode_of_manage_waste=$mode_of_manage->waste;$mode_of_manage_arrange=$mode_of_manage->arrange;
		}else{
			$mode_of_manage_cap="";$mode_of_manage_plant="";$mode_of_manage_waste="";$mode_of_manage_arrange="";
		}			
		##### PART III ######
		$is_operator=$results['is_operator'];$incineration=$results['incineration'];$leachate=$results['leachate'];$fire_system=$results['fire_system'];$trans_arrangement=$results['trans_arrangement'];$facility_detail=$results['facility_detail'];		
		##### PART IV ######
		$is_recycler=$results['is_recycler'];$storage_detail=$results['storage_detail'];$process_desc=$results['process_desc'];$pcs_detail=$results['pcs_detail'];$health_details=$results['health_details'];$doa_guidelines=$results['doa_guidelines'];$trans_arrange=$results['trans_arrange'];
		
		if(!empty($results["ins_capacity"])){
			$ins_capacity=json_decode($results["ins_capacity"]);
			$ins_capacity_qty=$ins_capacity->qty;$ins_capacity_unit=$ins_capacity->unit;
		}else{
			$ins_capacity_qty="";$ins_capacity_unit="";
		}
	}else{		
		$form_id=""; 
		###### PARTI ######
		$year_of_comm="";
		$occupier_add_name="";$occupier_add_desig="";$occupier_add_mob_no="";$occupier_add_email="";			
		$auth_req_gen="";$auth_req_col="";$auth_req_str="";$auth_req_transport="";$auth_req_recept="";$auth_req_reuse="";$auth_req_recycle="";$auth_req_rec="";$auth_req_pre="";$auth_req_co="";$auth_req_uti="";$auth_req_treat="";$auth_req_disp="";$auth_req_inci="";
		$ren_auth_no="";$ren_auth_dt="";	
		$ind_work_one="";$ind_work_two="";$ind_work_clock="";
		###### PARTII ######
		$is_generator="";
		$mode_of_manage_cap="";$mode_of_manage_plant="";$mode_of_manage_waste="";$mode_of_manage_arrange="";
		###### PARTIII ######
		$is_operator="";$incineration="";$leachate="";$fire_system="";$trans_arrangement="";$facility_detail="";
		###### PARTIV ######
		$is_recycler="";$storage_detail="";$process_desc="";$pcs_detail="";$health_details="";$doa_guidelines="";$trans_arrange=""; 
		$ins_capacity_qty="";$ins_capacity_unit="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	####### PART I #######
	$year_of_comm=$results['year_of_comm'];
	if(!empty($results["occupier_add"])){
		$occupier_add=json_decode($results["occupier_add"]);
		$occupier_add_name=$occupier_add->name;$occupier_add_desig=$occupier_add->desig;$occupier_add_mob_no=$occupier_add->mob_no;$occupier_add_email=$occupier_add->email;
	}else{
		$occupier_add_name="";$occupier_add_desig="";$occupier_add_mob_no="";$occupier_add_email="";
	}
	if(!empty($results["auth_req"])){
		$auth_req=json_decode($results["auth_req"]);
		if(isset($auth_req->gen)) $auth_req_gen=$auth_req->gen;
		else $auth_req_gen="";
		if(isset($auth_req->col)) $auth_req_col=$auth_req->col;
		else $auth_req_col="";
		if(isset($auth_req->str)) $auth_req_str=$auth_req->str;
		else $auth_req_str="";				
		if(isset($auth_req->transport)) $auth_req_transport=$auth_req->transport;
		else $auth_req_transport="";
		if(isset($auth_req->recept)) $auth_req_recept=$auth_req->recept;
		else $auth_req_recept="";
		if(isset($auth_req->reuse)) $auth_req_reuse=$auth_req->reuse;
		else $auth_req_reuse="";
		if(isset($auth_req->recycle)) $auth_req_recycle=$auth_req->recycle;
		else $auth_req_recycle="";
		if(isset($auth_req->rec)) $auth_req_rec=$auth_req->rec;
		else $auth_req_rec="";
		if(isset($auth_req->pre)) $auth_req_pre=$auth_req->pre;
		else $auth_req_pre="";
		if(isset($auth_req->co)) $auth_req_co=$auth_req->co;
		else $auth_req_co="";
		if(isset($auth_req->uti)) $auth_req_uti=$auth_req->uti;
		else $auth_req_uti="";
		if(isset($auth_req->treat)) $auth_req_treat=$auth_req->treat;
		else $auth_req_treat="";
		if(isset($auth_req->disp)) $auth_req_disp=$auth_req->disp;
		else $auth_req_disp="";
		if(isset($auth_req->inci)) $auth_req_inci=$auth_req->inci;
		else $auth_req_inci="";
	}else{
		$auth_req_gen="";$auth_req_col="";$auth_req_str="";$auth_req_transport="";$auth_req_recept="";$auth_req_reuse="";$auth_req_recycle="";$auth_req_rec="";$auth_req_pre="";$auth_req_co="";$auth_req_uti="";$auth_req_treat="";$auth_req_disp="";$auth_req_inci="";
	}	
	if(!empty($results["ren_auth"])){
		$ren_auth=json_decode($results["ren_auth"]);
		$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
	}else{
		$ren_auth_no="";$ren_auth_dt="";
	}		
	if(!empty($results["ind_work"])){
		$ind_work=json_decode($results["ind_work"]);
		if(isset($ind_work->one)) $ind_work_one=$ind_work->one;
		else $ind_work_one="";
		if(isset($ind_work->two)) $ind_work_two=$ind_work->two;
		else $ind_work_two="";
		if(isset($ind_work->clock)) $ind_work_clock=$ind_work->clock;
		else $ind_work_clock="";				
	}else{
		$ind_work_one="";$ind_work_two="";$ind_work_clock="";
	}
	##### PART II ######
	$is_generator=$results['is_generator'];$env_details=$results['env_details'];
	if(!empty($results["mode_of_manage"])){
		$mode_of_manage=json_decode($results["mode_of_manage"]);
		$mode_of_manage_cap=$mode_of_manage->cap;$mode_of_manage_plant=$mode_of_manage->plant;$mode_of_manage_waste=$mode_of_manage->waste;$mode_of_manage_arrange=$mode_of_manage->arrange;
	}else{
		$mode_of_manage_cap="";$mode_of_manage_plant="";$mode_of_manage_waste="";$mode_of_manage_arrange="";
	}			
	##### PART III ######
	$is_operator=$results['is_operator'];$incineration=$results['incineration'];$leachate=$results['leachate'];$fire_system=$results['fire_system'];$trans_arrangement=$results['trans_arrangement'];$facility_detail=$results['facility_detail'];		
	##### PART IV ######
	$is_recycler=$results['is_recycler'];$storage_detail=$results['storage_detail'];$process_desc=$results['process_desc'];$pcs_detail=$results['pcs_detail'];$health_details=$results['health_details'];$doa_guidelines=$results['doa_guidelines'];$trans_arrange=$results['trans_arrange'];
	
	if(!empty($results["ins_capacity"])){
		$ins_capacity=json_decode($results["ins_capacity"]);
		$ins_capacity_qty=$ins_capacity->qty;$ins_capacity_unit=$ins_capacity->unit;
	}else{
		$ins_capacity_qty="";$ins_capacity_unit="";
	}
}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
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
	if($showtab==4){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:block;'";$tabbtn4="active";
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
		.popover{
		max-width: 100%; /* Max Width of the popover (depending on the container!) */
}
	</style>
	<?php include ("".$table_name."_addmore.php"); ?>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
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
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
										<tr>
											 <td colspan="4"><p><h4 class="text-center"><strong></strong></h4></p></td>
										</tr>
										<tr>
											
											<td align="center">
												<label class="radio-inline"><input type="radio" name="is_generator" value="Y"  <?php if(isset($is_generator) && $is_generator=='Y') echo 'checked'; ?> required="required" /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_generator"  value="N"  <?php if(isset($is_generator) && $is_generator=='N') echo 'checked'; ?>/> No</label></td>
										</tr>
									</table>
									<table id="is_generator_yes" class="table table-responsive">
										<tr>
											<td colspan="4">1. (a) Products and by-products manufactured (names and product wise quantity per annum): </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable3" class=" table table-responsive table-bordered text-center "id="objectTable3" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Name</th>
													<th>Type</th>
													<th>Quantity</th>
													<th>Units</th>	
												</tr>
												</thead>
												<?php
												$part3=$doa->query("select * from ".$table_name."_t3 where form_id='$form_id'");
												$num3 = $part3->num_rows;
												if($num3>0){
												$count=1;
												while($row_3=$part3->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="txxtA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_3["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_3["name"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txxtB<?php echo $count;?>" class="form-control text-uppercase"; name="txxtB<?php echo $count;?>"></td>
													<td>
													<select id="txxtC<?php echo $count;?>" name="txxtC<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option <?php if($row_3["product_type"]=="P") echo "selected"; ?> value='P' >Product</option>
														<option <?php if($row_3["product_type"]=="B") echo "selected"; ?> value='B' >By-product</option>
													</select>
													</td>				
													<td><input value="<?php echo $row_3["qty"]; ?>" id="txxtD<?php echo $count;?>" class="form-control text-uppercase"; name="txxtD<?php echo $count;?>" validate="onlyNumbers"></td>
													<td>
													<select id="txxtE<?php echo $count;?>" name="txxtE<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option <?php if($row_3["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
														<option <?php if($row_3["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
														<option <?php if($row_3["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="txxtA1" size="1" class="form-control text-uppercase"; name="txxtA1"></td>
													<td><input id="txxtB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="txxtB1"></td>					
													<td><select id="txxtC1" name="txxtC1" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option value='P' >Product</option>
														<option value='B' >By-product</option>
													</select></td>
													<td><input id="txxtD1" class="form-control text-uppercase"; name="txxtD1" validate="onlyNumbers"></td>
													<td>														
													<select  id="txxtE1" name="txxtE1" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option value='T' >in tonnes / month</option>
														<option value='K' >in kl / month</option>
														<option value='N' >in numbers / month</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction3()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
											</td>									
										</tr>
										<tr>
											<td colspan="3">(b) Process description including process flow sheet indicating inputs and outputs (raw materials, chemicals, products, by-products, wastes, emissions, waste water etc.) </td>
											<td>Upload later in upload section</td>
										</tr>									
										<tr>
											<td colspan="4">(c) Characteristics (waste-wise) and Quantity of waste generation per annum</td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable4" class=" table table-responsive table-bordered text-center "id="objectTable4" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Particulars of Waste</th>
													<th>Characteristics</th>
													<th>Quantity</th>
													<th>Units</th>	
												</tr>
												</thead>
												<?php
												$part4=$doa->query("select * from ".$table_name."_t4 where form_id='$form_id'");
												$num4 = $part4->num_rows;
												if($num4>0){
												$count=1;
												while($row_4=$part4->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_4["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_4["particulars"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="textB<?php echo $count;?>" class="form-control text-uppercase"; name="textB<?php echo $count;?>"></td>
													<td>
													<input value="<?php echo $row_4["characteristics"]; ?>" id="textC<?php echo $count;?>" name="textC<?php echo $count;?>" class="form-control text-uppercase">
													</td>					
													<td><input value="<?php echo $row_4["qty"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase"; name="textD<?php echo $count;?>" validate="onlyNumbers"></td>
													<td>
													<select  id="textE<?php echo $count;?>" name="textE<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option <?php if($row_4["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
														<option <?php if($row_4["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
														<option <?php if($row_4["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase"; name="textA1"></td>
													<td><input id="textB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="textB1"></td>					
													<td><input id="textC1" name="textC1" class="form-control text-uppercase"></td>
													<td><input id="textD1" class="form-control text-uppercase" name="textD1" validate="onlyNumbers"></td>
													<td>														
													<select id="textE1" name="textE1" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option value='T' >in tonnes / month</option>
														<option value='K' >in kl / month</option>
														<option value='N' >in numbers / month</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction4()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
											</td>									
										</tr>
										<tr>
											<td colspan="4">(d) Mode of management of (c) above: </td>
										</tr>
										<tr>
											<td width="25%">i. Capacity and mode of secured storage within the plant:</td>
											<td width="25%"><textarea name="mode_of_manage[cap]"  class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $mode_of_manage_cap; ?></textarea>255 Characters Only</td>
											<td width="25%">ii. Utilisation within the plant (provide details):</td>
											<td width="25%"><textarea type="text" name="mode_of_manage[plant]" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $mode_of_manage_plant; ?></textarea>255 Characters Only</td>
										</tr>									
										<tr>
										   <td>iii. If not utilised within the plant, please provide details of what is done with this waste: </td>
										   <td><textarea name="mode_of_manage[waste]" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $mode_of_manage_waste; ?></textarea>255 Characters Only</td>
										   <td>iv. Arrangement for transportation to actual users/ TSDF: </td>
										   <td><textarea name="mode_of_manage[arrange]" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $mode_of_manage_arrange; ?></textarea>255 Characters Only</td>									   
										</tr>
										<tr>
											<td>(e) Details of the environmental safeguards and environmental facilities provided for safe handling of all the wastes at point (c) above:</td>
											<td><textarea name="env_details" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $env_details; ?></textarea >255 characters Only</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">2. Hazardous and other wastes generated as per these rules from storage of hazardous chemicals as defined under the Manufacture, Storage and Import of Hazardous Chemicals Rules, 1989 </td>					
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable5" class=" table table-responsive table-bordered text-center "id="objectTable5" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Particulars</th>
													<th>Nature</th>
													<th>Quantity</th>
													<th>Units</th>	
												</tr>
												</thead>
												<?php
												$part5=$doa->query("select * from ".$table_name."_t5 where form_id='$form_id'");
												$num5 = $part5->num_rows;
												if($num5>0){
												$count=1;
												while($row_5=$part5->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="text1A<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_5["slno"]; ?>" name="text1A<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_5["particulars"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="text1B<?php echo $count;?>" class="form-control text-uppercase"; name="text1B<?php echo $count;?>"></td>
													<td>
													<select id="text1C<?php echo $count;?>" name="text1C<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option <?php if($row_5["nature_type"]=="HW") echo "selected"; ?> value='HW' >Hazardous Waste</option>
														<option <?php if($row_5["nature_type"]=="OW") echo "selected"; ?> value='OW' >Other Waste</option>
													</select>
													</td>				
													<td><input value="<?php echo $row_5["qty"]; ?>" id="text1D<?php echo $count;?>" class="form-control text-uppercase"; name="text1D<?php echo $count;?>" validate="onlyNumbers"></td>
													<td>
													<select  id="text1E<?php echo $count;?>" name="text1E<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option <?php if($row_5["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
														<option <?php if($row_5["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
														<option <?php if($row_5["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="text1A1" size="1" class="form-control text-uppercase"; name="text1A1"></td>
													<td><input id="text1B1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="text1B1"></td>					
													<td><select  id="text1C1" name="text1C1" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option value='HW' >Hazardous Waste</option>
														<option value='OW' >Other Waste</option>
													</select></td>
													<td><input id="text1D1" class="form-control text-uppercase" name="text1D1" validate="onlyNumbers"></td>
													<td>														
													<select id="text1E1" name="text1E1" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option value='T' >in tonnes / month</option>
														<option value='K' >in kl / month</option>
														<option value='N' >in numbers / month</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction5()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
											</td>									
										</tr>
									</table>
									<table id="" class="table table-responsive">	
										<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>										
									</tr>
									</table>
									</form>
								</div>
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
	<?php if($doa_guidelines == 'N' || $doa_guidelines == '') echo "$('#prov_report_id').hide();"; ?>
	$('input[name="doa_guidelines"]').on('change', function(){
		if($(this).val() == 'N')
			$('#prov_report_id').hide();
		else
			$('#prov_report_id').show();
	});
	/* ----------------------------------------------------- */
	$('#is_generator_yes').css('display','table');	 
	<?php if($is_generator == 'N' || $is_generator == '') echo "$('#is_generator_yes').css('display','none');"; ?>
	
	$('input[name="is_generator"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_generator_yes').css('display','table');			
		}else{
			$('#is_generator_yes').css('display','none');			
		}
	});
	$('#is_operator_yes').css('display','table');	 
	<?php if($is_operator == 'N' || $is_operator == '') echo "$('#is_operator_yes').css('display','none');"; ?>
	
	$('input[name="is_operator"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_operator_yes').css('display','table');			
		}else{
			$('#is_operator_yes').css('display','none');			
		}
	});
	$('#is_recycler_yes').css('display','table');	 
	<?php if($is_recycler == 'N' || $is_recycler == '') echo "$('#is_recycler_yes').css('display','none');"; ?>
	
	$('input[name="is_recycler"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_recycler_yes').css('display','table');			
		}else{
			$('#is_recycler_yes').css('display','none');			
		}
	});
	/* ------------------------------------------------------ */
	$(document).ready(function(){
    $('[data-toggle="popover"]').popover({html:true});   
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('#Year').on('click', function(){
		var i, d = new Date();
		d.getFullYear();
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-15; i<d.getFullYear()+15; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
</body>
</html>