<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include("save_form.php");


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results["form_id"];
		$firm_duration=$results["firm_duration"];$business_nature=$results["business_nature"];$po_name=$results["po_name"];$ps_name=$results["ps_name"];$is_different=$results["is_different"];$o_land_type=$results["o_land_type"];
		if(!empty($results["other_address"])){
			$other_address=json_decode($results["other_address"]);
			$other_address_mouza=$other_address->mouza;$other_address_circle=$other_address->circle;$other_address_patta_no=$other_address->patta_no;$other_address_dag_no=$other_address->dag_no;$other_address_dag_no=$other_address->dag_no;$other_address_area_no=$other_address->area_no;$other_address_loc=$other_address->loc;$other_address_vill=$other_address->vill;$other_address_po=$other_address->po;$other_address_ps=$other_address->ps;$other_address_dist=$other_address->dist;$other_address_pincode=$other_address->pincode;
		}else{
			$other_address_mouza="";$other_address_circle="";$other_address_patta_no="";$other_address_dag_no="";$other_address_area_no="";$other_address_loc="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
		}
		if(!empty($results["reg_deed"])){
			$reg_deed=json_decode($results["reg_deed"]);
			$reg_deed_no=$reg_deed->no;$reg_deed_dte=$reg_deed->dte;$reg_deed_place=$reg_deed->place;
		}else{
			$reg_deed_no="";$reg_deed_dte="";$reg_deed_place="";
		}
		if(!empty($results["tax"])){
			$tax=json_decode($results["tax"]);
			$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
		}else{
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
	}else{
		$form_id="";
		$firm_duration="";$business_nature="";$po_name="";$ps_name="";$is_different="";$o_land_type="";
		$other_address_mouza="";$other_address_circle="";$other_address_patta_no="";$other_address_dag_no="";$other_address_area_no="";$other_address_loc="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
		$reg_deed_no="";$reg_deed_dte="";$reg_deed_place="";
		$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results["form_id"];
	$firm_duration=$results["firm_duration"];$business_nature=$results["business_nature"];$po_name=$results["po_name"];$ps_name=$results["ps_name"];$is_different=$results["is_different"];$o_land_type=$results["o_land_type"];
	if(!empty($results["other_address"])){
		$other_address=json_decode($results["other_address"]);
		$other_address_mouza=$other_address->mouza;$other_address_circle=$other_address->circle;$other_address_patta_no=$other_address->patta_no;$other_address_dag_no=$other_address->dag_no;$other_address_dag_no=$other_address->dag_no;$other_address_area_no=$other_address->area_no;$other_address_loc=$other_address->loc;$other_address_vill=$other_address->vill;$other_address_po=$other_address->po;$other_address_ps=$other_address->ps;$other_address_dist=$other_address->dist;$other_address_pincode=$other_address->pincode;
	}else{
		$other_address_mouza="";$other_address_circle="";$other_address_patta_no="";$other_address_dag_no="";$other_address_area_no="";$other_address_loc="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
	}
	if(!empty($results["reg_deed"])){
		$reg_deed=json_decode($results["reg_deed"]);
		$reg_deed_no=$reg_deed->no;$reg_deed_dte=$reg_deed->dte;$reg_deed_place=$reg_deed->place;
	}else{
		$reg_deed_no="";$reg_deed_dte="";$reg_deed_place="";
	}
	if(!empty($results["tax"])){
		$tax=json_decode($results["tax"]);
		$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
	}else{
		$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
	}
}
/*$q1=$formFunctions->executeQuery($dept,"select * from rfs_form1_members where form_id='$form_id'");
$results1=$q1->fetch_assoc();
if($q1->num_rows<1){
	$form_id="";
	$member_address="";$date_f_joining="";$upload_photo="";$upload_signature="";$upload_pan="";
}else{
	$form_id=$results1['form_id'];
	$member_address=$results1['member_address'];$date_f_joining=$results1['date_f_joining'];$upload_photo=$results1['upload_photo'];$upload_signature=$results1['upload_signature'];$upload_pan=$results1['upload_pan'];
}*/

##PHP TAB management
$showtab=isset($_GET['tab'])?$_GET['tab']:"";
$tabbtn1="";$tabbtn2="";$tabbtn3=""; 
if($showtab=="" || $showtab<2 || $showtab>6 || is_numeric($showtab)==false){
	$tabbtn1="active";$tabbtn2="";$tabbtn3=""; 
}
if($showtab==2){
	$tabbtn1="";$tabbtn2="active";$tabbtn3=""; 
}
if($showtab==3){
	$tabbtn1="";$tabbtn2="";$tabbtn3="active"; 
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
	<link href="../css/croppie.css" rel="stylesheet" type="text/css" />
	<style>
		/* Over writes AdminLTE form styles */
		p {
			text-align: justify;
		}
		
		.form-control:focus {
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)
	   }
		
	   .form-control {
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
	</style>
	<?php include ("".$table_name."_addmore.php"); ?>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
<div id="loader" class="loader" style="display:none;"></div>
<div class="wrapper">
	<?php require_once "../../requires/header.php";   ?>
	<?php require '../../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center">
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PART II</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">PART III</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr>
												<td width="25%">1. Name of the Proposed Firm :</td>
												<td width="25%"><input type="text" name="firm_name" class="form-control text-uppercase" value="<?php echo $unit_name;?>" disabled="disabled" /></td>
												<td width="25%">2. Nature of Business (as per Partnership Deed):</td>
												<td width="25%"><textarea class="form-control text-uppercase" name="business_nature"><?php echo $business_nature; ?></textarea></td>
											</tr>
											<tr>
												<td>3. PAN :</td>
												<td><input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no" maxlength="10" value="<?php  echo $pan_no; ?>" disabled="disabled"></td>
												<td>4. Duration of the Firm :<span class="mandatory_field">*</span></td>
												<td>
											  <select name="firm_duration" class="form-control text-uppercase" id="suni" required="true">
													<option value="">Please Select</option>
													<option  value="U" <?php if(isset($firm_duration)&& $firm_duration=='U') echo "selected"; ?>>UNLIMITED </option>
													<option  value="L" <?php if(isset($firm_duration)&& $firm_duration=='L') echo "selected"; ?>>LIMITED</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>5.Date of Establishment :<span class="mandatory_field">*</span></td>
												<td><input type="text" name="farm_es_date" class="form-control text-uppercase dob" disabled="disabled" value="<?php if(isset($date_of_commencement)) echo date("d-m-Y",strtotime($date_of_commencement)); ?>" required></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">5. Principle place of the proposed firm</td>
											</tr>
											<tr>
												<td width="25%">Own Land/Leased/Rented Premises</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $land_type; ?>" disabled="disabled" /></td>
												<td width="25%">Mouza </td>
												<td width="25%"><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php  echo $mouza; ?>"></td>
											</tr>
											<tr>
												<td>Circle </td>
												<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php  echo $circle; ?>"></td>
												<td>Patta No. </td>
												<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php echo $patta_no; ?>"></td>
											</tr>
											<tr>
												<td>Dag No. </td>
												<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php  echo $dag_no; ?>"></td>
												<td>Area </td>
												<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php if(isset($area) && $area!='FA') echo $area; ?>" required></td>
											</tr>
											<tr>
												<td>Village/Town/City </td>
												<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php  echo $b_vill; ?>"></td>
												<td>Post Office<span class="mandatory_field">*</span> </td>
												<td><input type="text" name="po_name" class="form-control text-uppercase" value="<?php  echo $po_name; ?>" required="required" /></td>
											</tr>
											<tr>
												<td>Police Station<span class="mandatory_field">*</span> </td>
												<td><input type="text" name="ps_name" class="form-control text-uppercase" value="<?php echo $ps_name; ?>" required="required"></td>
												<td>District </td>
												<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_dist; ?>" disabled="disabled"></td>
											</tr>
											<tr>
												<td>Pin Code </td>
												<td><input type="text" disabled="disabled" class="form-control text-uppercase" validate="pincode" maxlength="6" value="<?php echo $b_pincode; ?>" /></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="3">6. Does the proposed firm carry out its business in any other place apart from the registered office ?<span class="mandatory_field">*</span></td>
												<td><label class="radio-inline"><input type="radio" name="is_different" value="Y"  <?php if(isset($is_different) && $is_different=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_different"  value="N"  <?php if(isset($is_different) && $is_different=='N') echo 'checked'; ?>/> No</label>
												</td>
											</tr>
										</table>
										<table id="is_different_yes" class="table table-bordered table-responsive">
											<tr>
												<td width="25%">Own Land/leased/rented premises</td>
												<td width="25%">
												<select class="form-control text-uppercase is_different_yes_class" name="o_land_type" id="o_land_type">
												<option value="">Please Select</option>
												<option <?php if(isset($o_land_type)&& $o_land_type=='O') echo "selected"; ?> value="O">Owned Premises</option>
												<option <?php if(isset($o_land_type)&& $o_land_type=='L') echo "selected"; ?> value="L">Leased Premises</option>
												<option <?php if(isset($o_land_type)&& $o_land_type=='R') echo "selected"; ?> value="R">Rented Premises</option>
												</select>
										  </td>
												<td width="25%"></td>
												<td width="25%"></td>
									   </tr>
											<tr>
												<td>Mouza </td>
												<td><input type="text" name="other_address[mouza]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_mouza; ?>"></td>
												<td>Circle </td>
												<td><input type="text" name="other_address[circle]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_circle; ?>"></td>
											</tr>
											<tr>
												<td>Patta No. </td>
												<td><input type="text" name="other_address[patta_no]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_patta_no; ?>"></td>
												<td>Dag No. </td>
												<td><input type="text" name="other_address[dag_no]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_dag_no; ?>"></td>
											</tr>
											<tr>
												<td>Area </td>
												<td><input type="text" name="other_address[area_no]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_area_no; ?>"></td>
												<td>Locality </td>
												<td><input type="text" name="other_address[loc]" class="form-control text-uppercase is_different_yes_class" value="<?php echo $other_address_loc; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town/City </td>
												<td><input type="text" name="other_address[vill]" class="form-control text-uppercase is_different_yes_class" value="<?php echo $other_address_vill; ?>"></td>
												<td>Post Office </td>
												<td><input type="text" name="other_address[po]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_po; ?>"></td>
											</tr>
											<tr>
												<td>Police Station </td>
												<td><input type="text" name="other_address[ps]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_ps; ?>"></td>
												<td>District</td>
                                                <td><input type="text" name="other_address[dist]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_dist; ?>"></td>
												
                                            </tr>
											<tr>
												<td>Pin Code </td>
												<td><input type="text" class="form-control text-uppercase is_different_yes_class" name="other_address[pincode]" validate="pincode" maxlength="6" value="<?php echo $other_address_pincode ?>"></td>
												<td></td>
												<td></td>
											</tr>
										</table>
										<table class=" table table-responsive table-bordered">
											<tr>
												<td class="text-center" colspan="4">
													<button type="submit" name="save<?php echo $form;?>a" class="btn btn-success submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">7. Name in full and permanent address of all the partners of the firm alongwith the date of joining, their passport size photograph and scanned copy of signature of each partner : <span class="mandatory_field">*</span></td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable1" id="objectTable1" class="text-center table table-responsive table-bordered">
												   <thead>
														<tr>
															<th width="5%">Sl No.</th>
															<th>Full Name of partners</th>
															<th>Permanent Address</th>
															<th>Date of Joining</th>
															<th>Upload Photo</th>
															<th>Upload Signature</th>
															<th>Upload PAN</th>
														</tr>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
													$num1 = $part1->num_rows;
													if($num1==0){ 
														for($gumo=1; $gumo<8; $gumo++){ ?>
														<tr>
															<td><input type="text" readonly id="txxtA<?=$gumo;?>" class="form-control text-uppercase" value="<?=$gumo;?>" name="txxtA<?=$gumo;?>" size="1"></td>
															<td><input type="text" id="txxtB<?=$gumo;?>" class="form-control text-uppercase" value="" name="txxtB<?=$gumo;?>" ></td>
															<td><input type="text" value=""  id="txxtC<?=$gumo;?>" class="form-control text-uppercase" name="txxtC<?=$gumo;?>"></td>
															<td><input type="text" value="" id="txxtD<?=$gumo;?>" class="dob form-control text-uppercase" name="txxtD<?=$gumo;?>"  ></td>
															<td>
																<span></span>
																<a href="#!" class="btn btn-info myphoto" data-width="160" data-height="200" data-name="member-photo<?=$gumo;?>" >Upload</a>
															</td>
															<td>
																<span></span>
																<a href="#!" class="btn btn-info mysign" data-width="360" data-height="120" data-name="member-sign<?=$gumo;?>">Upload</a>
															</td>
															<td>
																<input type="button" upload="file" class="file btn btn-info" id="fl<?=$gumo;?>" required="required" value="Browse">
																<input type="hidden" name="upload_pan<?=$gumo;?>" value="" id="mfl<?=$gumo;?>" readonly="readonly" />
																<span id="tdfl<?=$gumo;?>">No File Selected</span>
															</td>
														</tr>
													<?php }		?>
													<?php
													}else{	
														$count=1;
														while($rows=$part1->fetch_object()){
															if($rows->upload_photo == ""){
																$upload_photo="";
																$photo_base64="";
															}else{
																$upload_photo=$rows->upload_photo;
																$photo_path = $server_url. 'departments/rfs/forms/upload/'.$rows->upload_photo;
																$photo_data = file_get_contents($photo_path);
																$photo_base64 = 'data:image/png;base64,' . base64_encode($photo_data);
															}
															if($rows->upload_signature == ""){
																$upload_signature="";
																$sign_base64="";
															}else{
																$upload_signature=$rows->upload_signature;
																$sign_path = $server_url. 'departments/rfs/forms/upload/'.$upload_signature;
																$sign_data = file_get_contents($sign_path);
																$sign_base64 = 'data:image/png;base64,' . base64_encode($sign_data);
															}														 
														?>
														<tr>
															<td><input type="text" readonly value="<?=$count;?>" id="txxtA" size="1" class="form-control text-uppercase" name="txxtA<?=$count;?>"></td>
															<td><input type="text" id="txxtB<?=$count;?>" value="<?php echo strtoupper($rows->member_name);?>" class="form-control text-uppercase" name="txxtB<?=$count;?>"></td>
															<td><input type="text" id="txxtC<?=$count;?>" value="<?php echo strtoupper($rows->member_address);?>" class="form-control text-uppercase" name="txxtC<?=$count;?>"></td>					
															<td><input type="text" value="<?php echo strtoupper($rows->date_f_joining);?>" id="txxtD<?=$count;?>" class="dob form-control text-uppercase" name="txxtD<?=$count;?>" ></td>
															<td>
															<?php if($count<8){ ?>
																<span><input type="hidden" name="member-photo<?php echo $count;?>" value="<?php echo $photo_base64; ?>"><img width="160" height="200" src="upload/<?php echo $upload_photo; ?>"/><br><br></span>
																<a href="#!" class="btn btn-info myphoto" data-width="160" data-height="200" data-name="member-photo<?php echo $count;?>" >Upload</a>
															<?php } ?>																
															</td>
															<td>
															<?php if($count<8){ ?>
																<span><input type="hidden" name="member-sign<?php echo $count;?>" value="<?php echo $sign_base64; ?>"><img width="360" height="120" src="upload/<?php echo $upload_signature; ?>"/><br><br></span>
																<a href="#!" class="btn btn-info mysign" data-width="360" data-height="120" data-name="member-sign<?php echo $count;?>">Upload</a>
															<?php } ?>																
															</td>
															<td>
															<?php if($count<8){ ?>
																<input type="button" upload="file" class="file btn btn-info" id="fl<?php echo $count;?>" value="Browse">
															<input type="hidden" name="upload_pan<?php echo $count;?>" value="<?php echo $rows->upload_pan; ?>" id="mfl<?php echo $count;?>" readonly="readonly" />
															<span id="tdfl<?php echo $count;?>"><?php if($rows->upload_pan =="") echo "No File Selected"; else echo '<a href="'. $upload.$rows->upload_pan .'" class="btn btn-success" target="_blank"> View </a>'; ?> </span>
															<?php } ?>
															</td>
														</tr>
														<?php  $count++;
														}														 
														?>
													<?php } ?>
												</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												   <button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												   <input type="hidden" id="hiddenval1" name="hiddenval1" value="<?php echo $hiddenval1; ?>"/></div> 
												</td>
											</tr>
											<tr>
												<td align="center" colspan="4">
												<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
												<button type="submit" name="save<?php echo $form;?>b" class="btn btn-success submit1">Save and Next</button></td>
											</tr>
										</table>
									</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" class="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">8. Registered Deed of Partnership </td>
											</tr>
											<tr>
												<td width="25%">Deed No.<span class="mandatory_field">*</span></td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_deed[no]" value="<?php echo $reg_deed_no; ?>" required/></td>
												<td width="25%">Date<span class="mandatory_field">*</span> </td>
												<td width="25%"><input type="text" class="dob form-control text-uppercase" name="reg_deed[dte]" value="<?php  echo $reg_deed_dte; ?>" required/></td>
											</tr>
											<tr>
												<td>Place of Deed Registration<span class="mandatory_field">*</span> </td>
												<td><input type="text" class="form-control text-uppercase" name="reg_deed[place]" value="<?php  echo $reg_deed_place; ?>" required /></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">9. Certificate of Sales Tax and Income Tax</td>
											</tr>
											<tr>
												<td>Certificate No. </td>
												<td><input type='text' class="form-control text-uppercase" name="tax[certificate_no]" value="<?php echo $tax_certificate_no; ?>"></td>
												<td>Issued by</td>
												<td><input type='text' name="tax[certificate_issue]" class="form-control text-uppercase" value="<?php echo $tax_certificate_issue; ?>"></td>
											</tr>
											<tr>
												<td>Date of Issue</td>
												<td><input type='text' class="dob form-control text-uppercase" name="tax[issuedate]" value="<?php echo $tax_issuedate; ?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="2">Date : <strong><?php echo $today;?></strong><br/>Place : <strong><?php echo strtoupper($dist);?></strong></td>
												<td align="right" colspan="2"><b><?php echo strtoupper($key_person)?></b> <br/> Signature of the Applicant</td>
											</tr>
											<tr>
												<td align="center" colspan="4">
													<a type="button" href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>c" class="btn btn-success submit1">Save and Next</button>
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
	<div class="modal fade" tabindex="-1" role="dialog" id="myModal-photo">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Upload Photo</h4>
				</div>
				<div class="modal-body" style="height:500px;">
					<div class="col-md-12" >
						<div class="upload-demo-wrap">
							<div id="upload-demo"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				   <a class="btn file-btn btn-danger">
						<span>Browse Photo</span>
						<input type="file" id="upload" value="Choose a file" accept="image/*">
				   </a>       
					<a href="#!" class="btn btn-primary result">Submit</a>       
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
</div>
<!-- ./wrapper -->

<script src="../js/croppie.min.js" type="text/javascript"></script>
<script>
	$('#is_different_yes').css('display', 'none');
	$('.is_different_yes_class').attr('required', 'required');
	<?php if($is_different == 'N' || $is_different == ''){ ?>
	$('#is_different_yes').css('display', 'none');
	$('.is_different_yes_class').removeAttr('required', 'required');
	<?php } ?>

	$('input[name="is_different"]').on('change', function() {
		if ($(this).val() == 'Y') {
			$('#is_different_yes').css('display', 'table');
			$('.is_different_yes_class').attr('required', 'required');
		} else {
			$('#is_different_yes').css('display', 'none');
			$('.is_different_yes_class').removeAttr('required', 'required');
		}
	});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
<script>
	// window.onload = function(e){ 
	var img,width,height;
	$('.myphoto').click(function(){
		//alert("asd");
		width=$(this).attr("data-width");
		height=$(this).attr("data-height");
		$('#upload-demo').empty();
		$('#myModal-photo').modal('show');
		img=$(this);
		$uploadCrop = $('#upload-demo').croppie({
			viewport: {
				width: width,
				height: height							
			},
			boundary: {
				width: 350,
				height:350
			}			
		});
	});
	$('.mysign').click(function(){
		width=$(this).attr("data-width");
		height=$(this).attr("data-height");
		$('#upload-demo').empty();
		$('#myModal-photo').modal('show');
		img=$(this);
		$uploadCrop = $('#upload-demo').croppie({
			viewport: {
				width: width,
				height: height								
			},
			boundary: {
				width: 400,
				height:400
			}			
		});
	});
	$('#myModal-photo').on('shown.bs.modal', function () {
	  
	});
	var $uploadCrop;
	function readFile(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('.upload-demo').addClass('ready');
				$uploadCrop.croppie('bind', {
					url: e.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});	            	
			}	            
			reader.readAsDataURL(input.files[0]);
		}
		else {
			swal("Sorry - you're browser doesn't support the FileReader API");
		}
	}
		
	$('#upload').on('change', function () { readFile(this); });
	$('.result').on('click', function (ev) {
		$uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (resp) {
			$('#myModal-photo').modal('hide');
			$('.cr-image').attr('src','');
			$("#upload").val('');
			img.parent().children('span').empty();
			img.parent().children('span').append('<input type="hidden" name="'+img.attr('data-name')+'" value="'+resp+'"> <img src="'+resp+'"><br><br>');			
		});
	});	
//}          
</script>
