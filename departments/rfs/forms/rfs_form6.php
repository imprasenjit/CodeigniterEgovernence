<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="6";
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
			$fathers_name=$results["fathers_name"];$post_office=$results["post_office"];$police_station=$results["police_station"];
			
			if(!empty($results['registration_deed'])){
				$registration_deed=json_decode($results['registration_deed']);
				$registration_deed_no=$registration_deed->no;$registration_deed_dte=$registration_deed->dte;$registration_deed_place=$registration_deed->place;
			}else{
				$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
			}
			if(!empty($results['rectification_reg'])){
				$rectification_reg=json_decode($results['rectification_reg']);
				$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
			}else{
				$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
			}
			#### PART II####
			if(!empty($results["tax"])){
				$tax=json_decode($results["tax"]);
				$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
			}else{
				$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
			}
		}else{
			$form_id="";
			#####PART I #####
			$fathers_name="";$post_office="";$police_station="";
			$address_locality="";$address_vill="";$address_po="";$address_ps="";$address_dist="";$address_pincode="";$address_mobile="";$address_email="";
			$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
			##### PART II ####
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$fathers_name=$results["fathers_name"];$post_office=$results["post_office"];$police_station=$results["police_station"];
		
		if(!empty($results['registration_deed'])){
			$registration_deed=json_decode($results['registration_deed']);
			$registration_deed_no=$registration_deed->no;$registration_deed_dte=$registration_deed->dte;$registration_deed_place=$registration_deed->place;
		}else{
			$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
		}
		if(!empty($results['rectification_reg'])){
			$rectification_reg=json_decode($results['rectification_reg']);
			$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
		}else{
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
		}
		#### PART II####
		if(!empty($results["tax"])){
			$tax=json_decode($results["tax"]);
			$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
		}else{
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
	}
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
	</style>
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td width="25%">1. Name of the applicant</td>
											<td width="25%"><input  class="form-control text-uppercase" disabled  value="<?php echo $key_person;?>"></td>
											<td width="25%">2. Father’s name</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="fathers_name"  value="<?php echo $fathers_name;?>" validate="letters" ></td>
										</tr>
										<tr>
											<td colspan="4">3. Address</td>
										</tr>
										<tr>
											<td>Locality  </td>
											<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $b_street_name2; ?>"/></td>
											<td>Village/town/city </td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_vill; ?>"/></td>
										</tr>
										<tr>
											<td>Post Office </td>
											<td><input type="text"  class="form-control text-uppercase" id="post_office" name="post_office" value="<?php  echo $post_office; ?>"/></td>
											<td>Police Station </td>
											<td><input type="text" class="form-control text-uppercase" id="police_station" name="police_station" value="<?php  echo $police_station; ?>"/></td>
										</tr>
										<tr>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_dist; ?>"/></td>
											<td>Pin code </td>
											 <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_pincode; ?>" ></td>
										</tr>
										<tr>
											<td>Mobile No.</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
											<td>Email ID</td>
											<td><input type="text" class="form-control" disabled value="<?php  echo $b_email; ?>"/></td>
										</tr>
										<tr>
											<td colspan="4">4. Registration Deed of Partnership</td>
										</tr>
										<tr>
											 <td>Deed No.<span class="mandatory_field">*</span></td>
											 <td><input type="text"  class="form-control text-uppercase" name="registration_deed[no]"  value="<?php echo $registration_deed_no; ?>" required /></td>
											 <td>Date<span class="mandatory_field">*</span></td>
											 <td><input type="text"  name="registration_deed[dte]" class="dob form-control text-uppercase" value="<?php echo $registration_deed_dte; ?>" required /></td>
										</tr>
										<tr>
											 <td>Place of Deed Registration<span class="mandatory_field">*</span></td>
											 <td><input type="text"  class="form-control text-uppercase"  name="registration_deed[place]" value="<?php echo $registration_deed_place; ?>" required /></td>
											 <td></td>
											 <td></td>
										</tr>
										<tr>
											<td colspan="4">5. Rectification Registration Deed of Partnership</td>
										</tr>
										<tr>
											 <td>Deed No.<span class="mandatory_field">*</span></td>
											 <td><input type="text"  class="form-control text-uppercase" name="rectification_reg[no]"  value="<?php echo $rectification_reg_no; ?>" required /></td>
											 <td>Date<span class="mandatory_field">*</span></td>
											 <td><input type="text"  name="rectification_reg[dte]" class="dob form-control text-uppercase"  value="<?php echo $rectification_reg_dte; ?>" required /></td>
										</tr>
										<tr>
											 <td>Place of Deed Registration<span class="mandatory_field">*</span></td>
											 <td><input type="text"  name="rectification_reg[place]" class="form-control text-uppercase"  value="<?php echo $rectification_reg_place; ?>" required /></td>
											 <td></td>
											 <td></td>
										</tr>
										<tr>
											<td colspan="4">6. Certificate of Sales Tax or Income Tax</td>
										</tr>
										<tr>
											<td width="25%">Certificate No. :</td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="tax[certificate_no]" value="<?php echo $tax_certificate_no; ?>" ></td>
											<td width="25%">Issued by</td>
											<td width="25%"><input type="text"  name="tax[certificate_issue]" class="form-control text-uppercase"  value="<?php echo $tax_certificate_issue; ?>" ></td>
										</tr>
										<tr>
											<td>Date of Issue</td>
											<td><input type="text"  class="dob form-control text-uppercase"  name="tax[issuedate]" value="<?php echo $tax_issuedate; ?>"  ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
										<tr>
											<td colspan="2">Date : <strong><?php echo $today;?></strong><br/>
												Place : <strong><?php echo strtoupper($dist);?></strong></td>
											<td align="right" colspan="2">
												<b><?php echo strtoupper($key_person)?></b><br/>
													Signature of the Applicant               
											</td>
										</tr>
										<tr>
											<td align="center" colspan="4">
												<button type="submit"  style="font-weight:bold" name="save<?php echo $form;?>" class="btn btn-success submit1">Save and Next</button>
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
	 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
</body>
</html>