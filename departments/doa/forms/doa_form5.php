<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="5";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$categories=$results["categories"];$day=$results["day"];$year=$results["year"];$licence_no=$results["licence_no"];$licence_dt=$results["licence_dt"];$cat_operation=$results["cat_operation"];$expert_staff=$results["expert_staff"];$insecticides=$results["insecticides"];$stocking=$results["stocking"];$is_grant=$results["is_grant"];$other=$results["other"];$father_name=$results["father_name"];
			
			if(!empty($results["address"])){
				$address=json_decode($results["address"]);
				$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_v=$address->v;$address_d=$address->d;$address_p=$address->p;$address_mno=$address->mno;
			}else{				
				$address_sn1="";$address_sn2="";$address_d="";$address_p="";$address_v="";$address_mno="";
			}
			
		}else{	
			$form_id="";$categories="";$day="";$year="";$licence_no="";$licence_dt="";$cat_operation="";$expert_staff="";$insecticides="";$stocking="";$is_grant="";$other="";$father_name="";
			$address_sn1="";$address_sn2="";$address_d="";$address_p="";$address_v="";$address_mno="";
		}
	}else{			
			$results=$q->fetch_array();
			$form_id=$results["form_id"];$categories=$results["categories"];$day=$results["day"];$year=$results["year"];$licence_no=$results["licence_no"];$licence_dt=$results["licence_dt"];$cat_operation=$results["cat_operation"];$expert_staff=$results["expert_staff"];$insecticides=$results["insecticides"];$stocking=$results["stocking"];$is_grant=$results["is_grant"];$other=$results["other"];$father_name=$results["father_name"];
			
			if(!empty($results["address"])){
				$address=json_decode($results["address"]);
				$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_v=$address->v;$address_d=$address->d;$address_p=$address->p;$address_mno=$address->mno;
			}else{				
				$address_sn1="";$address_sn2="";$address_d="";$address_p="";$address_v="";$address_mno="";
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							  
							<div id="table1" class="tab-pane" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
								<tr>
									<td colspan="4">To<br/>
									&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority ,<br/><br/>
									 <select class="form-control" style="width:300px" name="office_id" required>
                                        <option value="">Please Select</option>
										<?php
										$rows = $formFunctions->getOffices($dept);
                                        foreach($rows as $key => $values ){
											if($values["id"]!=6 && $values["id"]!=1){
												$jurisdiction = $values["jurisdiction"];
												$jurisdiction_array = explode(",",$jurisdiction); 
												//print_r($jurisdiction_array);echo "<br/><br/>";
												if(in_array(strtoupper($b_dist),$jurisdiction_array)){
													$address = $values["street1"]." ".$values["street2"].", ".$values["district"]." - ".$values["pin"];
													echo '<option value="'.$values["id"].'">'.$values["office_name"].', '.$address.'</option>';
												}												
											}												
										}
										?>											
									</select>
									<br/></td>
								</tr>
								<tr>
									 <td colspan="4" class="form-inline">1. I/We hereby apply for renewal of the licence to stock and use restricted insecticides for categories I, II and III, under the name and style of &nbsp;<input type="text" name="categories" value="<?php echo $categories; ?>" class="form-control text-uppercase"> &nbsp;The licence desired to be renewed was granted the Licensing Authority and alloted License No. &nbsp;<input type="text" name="licence_no" value="<?php echo $licence_no; ?>" class="form-control text-uppercase"> &nbsp;on the &nbsp;<input type="text" name="licence_dt" value="<?php echo $licence_dt; ?>" class="dob form-control text-uppercase"> &nbsp; day of &nbsp;<input type="text" name="day" value="<?php echo $day; ?>" class="form-control text-uppercase"> &nbsp; 20<input type="text" name="year" value="<?php echo $year; ?>" maxlength="2" validate="onlyNumbers" class="form-control text-uppercase">.</td>				 
								</tr>
								<tr>
									<td colspan="4">2. State the, if any, in :</td>
								</tr>
								<tr>
									<td width="25%">(a) Category of operation :</td>
									<td width="25%"><input type="text" name="cat_operation" value="<?php echo $cat_operation; ?>" class="form-control text-uppercase"></td>
									<td width="25%">(b) Expert staff :</td>
									<td width="25%"><input type="text" name="expert_staff" value="<?php echo $expert_staff; ?>" class="form-control text-uppercase"></td>	
								</tr>
								<tr>
									<td>(c) Restricted insecticides used :</td>
									<td><input type="text" name="insecticides" value="<?php echo $insecticides; ?>" class="form-control text-uppercase"></td>
									<td>(d) Premises of stocking :</td>
									<td><input type="text" name="stocking" value="<?php echo $stocking; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4">(e) Address including branch officers :</td>
								</tr>
								<tr>
									<td> Street Name 1  :</td>
									<td><input type="text" class="form-control text-uppercase" name="address[sn1]" value="<?php echo $address_sn1;?>" /></td>
									<td> Street Name 2 :</td>
									<td><input type="text" class="form-control text-uppercase"  name="address[sn2]" value="<?php echo $address_sn2;?>" /></td>
								</tr>
								<tr>
									<td> Village/ Town :</td>
									<td><input type="text" class="form-control text-uppercase"   name="address[v]" value="<?php echo $address_v;?>"/></td>
									<td>District :<span class="mandatory_field">*</span></td>
                                    <td><input type="text" class="form-control text-uppercase"   name="address[d]" id="address_d" value="<?php echo $address_d;?>"/></td>
									
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6"  name="address[p]" value="<?php echo $address_p;?>"></td>
									<td>Mobile No. :</td>
									<td><input validate="mobileNumber"  maxlength="10" type="text" name="address[mno]" value="<?php echo $address_mno; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>(f) Whether any new branch / unit has been opened after grant or renewal of license :</td>
									<td><label class="radio-inline"><input type="radio" name="is_grant" class="is_grant" value="Y"  <?php if(isset($is_grant) && $is_grant=='Y') echo 'checked'; ?> />Yes</label>
									<label class="radio-inline"><input type="radio" class="is_grant"  value="N"  name="is_grant" <?php if(isset($is_grant) && ($is_grant=='N' || $is_grant=='')) echo 'checked'; ?>/> No</label></td>
									<td>(g) Any other change :</td>
									<td><input type="text" name="other" value="<?php echo $other; ?>" class="form-control text-uppercase"></td>					
								</tr>
								<tr>
									<td colspan="4">VERIFICATION</td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline text-uppercase"> I &nbsp;<input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase">&nbsp;S/O&nbsp;<input type="text" name="father_name" value="<?php echo $father_name; ?>" class="form-control text-uppercase">&nbsp;do hereby solemnly verify that to the best of my knowledge and belief the information given in the application and the annexures and statements accompanying it is correct and complete.</td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">I further declare that I am making this application in my capacity as &nbsp;<input type="text" disabled value="<?php echo $status_applicant; ?>" class="form-control">&nbsp;(Designation) and that I am competent to make this application and verify it, by virtue of a photo/attested copy which has already been submitted.</td>
								</tr>
								<tr>
								   <td>Place :</td>
									<td><label disabled class="form-control text-uppercase" ><?php echo $dist; ?></label></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
								   <td>Date :</td>
									<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
									<td>Signature of applicant :</td>
									<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
								</tr>
								<tr>
										<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
$('#is_registration_details').attr('readonly','readonly');
	<?php if($is_registration == 'Y') echo "$('#is_registration_details').removeAttr('readonly','readonly');"; ?>
	$('.is_registration').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_registration_details').removeAttr('readonly','readonly');
		}else{
			$('#is_registration_details').attr('readonly','readonly');
			$('#is_registration_details').val('');
		}			
	});
	/* ----------------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------------- */
</script>