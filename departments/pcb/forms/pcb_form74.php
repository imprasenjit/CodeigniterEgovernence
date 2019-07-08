<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="74";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$facilities=$results['facilities'];$prev_auth_num=$results['prev_auth_num'];$prev_auth_dt=$results['prev_auth_dt'];$annual_returns=$results['annual_returns'];
		
		if(!empty($results["contact"])){
			$contact=json_decode($results["contact"]);
			$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;$contact_fax=$contact->fax;$contact_email=$contact->email;
		}else{				
			$contact_desgn="";$contact_tel="";$contact_fax="";$contact_email="";
		}	
		
		if(!empty($results["ewaste"])){
			$ewaste=json_decode($results["ewaste"]);
			$ewaste_generate=$ewaste->generate;$ewaste_refurbish=$ewaste->refurbish;$ewaste_recycle=$ewaste->recycle;$ewaste_dispose=$ewaste->dispose;
		}else{
			$ewaste_generate="";$ewaste_refurbish="";$ewaste_recycle="";$ewaste_dispose="";
		}
		
		if(!empty($results["authorization"])){
			$authorization=json_decode($results["authorization"]);
			if(isset($authorization->a)) $authorization_a=$authorization->a; else $authorization_a="";
			if(isset($authorization->b)) $authorization_b=$authorization->b; else $authorization_b="";
			if(isset($authorization->c)) $authorization_c=$authorization->c; else $authorization_c="";
			if(isset($authorization->d)) $authorization_d=$authorization->d; else $authorization_d="";
		}else{
			$authorization_a="";$authorization_b="";$authorization_c="";$authorization_d="";
		}
	}else{
		$form_id="";$facilities="";$prev_auth_num="";$prev_auth_dt="";$annual_returns="";
		$contact_desgn="";$contact_tel="";$contact_fax="";$contact_email="";
		$ewaste_generate="";$ewaste_refurbish="";$ewaste_recycle="";$ewaste_dispose="";
		$authorization_a="";$authorization_b="";$authorization_c="";$authorization_d="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$facilities=$results['facilities'];$prev_auth_num=$results['prev_auth_num'];$prev_auth_dt=$results['prev_auth_dt'];$annual_returns=$results['annual_returns'];
	
	if(!empty($results["contact"])){
		$contact=json_decode($results["contact"]);
		$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;$contact_fax=$contact->fax;$contact_email=$contact->email;
	}else{				
		$contact_desgn="";$contact_tel="";$contact_fax="";$contact_email="";
	}	
	
	if(!empty($results["ewaste"])){
		$ewaste=json_decode($results["ewaste"]);
		$ewaste_generate=$ewaste->generate;$ewaste_refurbish=$ewaste->refurbish;$ewaste_recycle=$ewaste->recycle;$ewaste_dispose=$ewaste->dispose;
	}else{
		$ewaste_generate="";$ewaste_refurbish="";$ewaste_recycle="";$ewaste_dispose="";
	}
	
	if(!empty($results["authorization"])){
		$authorization=json_decode($results["authorization"]);
		if(isset($authorization->a)) $authorization_a=$authorization->a; else $authorization_a="";
		if(isset($authorization->b)) $authorization_b=$authorization->b; else $authorization_b="";
		if(isset($authorization->c)) $authorization_c=$authorization->c; else $authorization_c="";
		if(isset($authorization->d)) $authorization_d=$authorization->d; else $authorization_d="";
	}else{
		$authorization_a="";$authorization_b="";$authorization_c="";$authorization_d="";
	}
}
?>
<?php require_once "../../requires/header.php";   ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">To, <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Member Secretary,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pollution Control Board</td>
										</tr>
										<tr>
											<td colspan="4">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I / We hereby apply for authorisation/renewal of authorisation under rule 13(2) (i) to 13(2) (viii) and/or 13 (4) (i) of the E-Waste (Management) Rules, 2016 for collection/storage/ transportation/ treatment/ refurbishing/disposal of e-wastes.</td>
										</tr>
										<tr>
											<td width="25%">1. Name of applicant :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $key_person; ?>" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">2. Full address : </td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">3. Details of Contact Person : </td>
										</tr>
										<tr>
											<td>Designation :</td>
											<td><input type="text" class="form-control text-uppercase" name="contact[desgn]" value="<?php echo  $contact_desgn; ?>"></td>
											<td>Telephone No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="contact[tel]" value="<?php echo $contact_tel; ?>"></td>
										</tr>										
										<tr>
											<td>Fax No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="contact[fax]" value="<?php echo $contact_fax; ?>" ></td>
											<td>Email Id : </td>
											<td><input type="email" class="form-control" name="contact[email]" value="<?php echo $contact_email;?>" validate="email" ></td>
										</tr>
										<tr>
										    <td colspan="2">4. Authorisation required for (Please tick mark appropriate activity/ies) : <span class="mandatory_field">*</span></td>
											<td colspan="2">
												<label class="checkbox-inline"><input type="checkbox" <?php if($authorization_a=="G") echo "checked"; ?> name="authorization[a]" value="G">(i) Generation during manufacturing or refurbishing&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($authorization_b=="T") echo "checked"; ?> name="authorization[b]" value="T">(ii) Treatment, if any&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($authorization_c=="C") echo "checked"; ?> name="authorization[c]" value="C">(iii) Collection, Transportation, Storage&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($authorization_d=="R") echo "checked"; ?> name="authorization[d]" value="R"> (iv) Refurbishing&nbsp;&nbsp; </label>
											</td>
										</tr>
										<tr>
										    <td colspan="4">5. E-waste details : </td>
										</tr>
										<tr>
											<td>(a) Total quantity e-waste generated in MT/A :</td>
											<td><input type="text" class="form-control text-uppercase" name="ewaste[generate]" value="<?php echo  $ewaste_generate; ?>"></td>
											<td>(b) Quantity refurbished (applicable to refurbisher):</td>
											<td><input type="text" class="form-control text-uppercase" name="ewaste[refurbish]" value="<?php echo $ewaste_refurbish; ?>"></td>
										</tr>	
										<tr>
											<td>(c) Quantity sent for recycling :</td>
											<td><input type="text" class="form-control text-uppercase" name="ewaste[recycle]" value="<?php echo  $ewaste_recycle; ?>"></td>
											<td>(d) Quantity sent for disposal :</td>
											<td><input type="text" class="form-control text-uppercase" name="ewaste[dispose]" value="<?php echo $ewaste_dispose; ?>"></td>
										</tr>
										<tr>
											<td>6. Details of Facilities for storage/handling/treatment/refurbishing : </td>
											<td><input type="text" class="form-control text-uppercase" name="facilities" value="<?php echo  $facilities; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">7. In case of renewal of authorisation : </td>
										</tr>
										<tr>
											<td>Previous authorisation number : </td>
											<td><input type="text" class="form-control text-uppercase" name="prev_auth_num" value="<?php echo  $prev_auth_num; ?>"></td>
											<td>Previous authorisation date : </td>
											<td><input type="text" class="dob form-control" name="prev_auth_dt" value="<?php echo  $prev_auth_dt; ?>"></td>
										</tr>
										<tr>
											<td>Details of annual returns : </td>
											<td colspan="2"><input type="text" class="form-control text-uppercase" name="annual_returns" value="<?php echo $annual_returns; ?>"></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="2" align="left">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/> Place : <strong><?php echo $dist;?></strong></td>
											<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person)?></strong><br/>(Name : <strong><?php echo $key_person;?></strong>)<br/> (Designation : <strong><?php echo $status_applicant;?></strong>)</td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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