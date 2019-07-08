<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="5";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ;
	
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$ref=$results['ref'];$year_no=$results['year_no'];$ref_date=$results['ref_date'];$work_done=$results['work_done'];$contractor_reg =$results['contractor_reg'];$class_of_contract =$results['class_of_contract'];$con_valid_dt =$results['con_valid_dt'];$sup_name =$results['sup_name'];$sup_reg =$results['sup_reg'];$workman_name =$results['workman_name'];$workman_reg =$results['workman_reg'];$work_details =$results['work_details'];$expected_com_date =$results['expected_com_date'];$expected_sub_date =$results['expected_sub_date'];	
			if(!empty($results["work_address"]))
			{
				$work_address=json_decode($results["work_address"]);
				$work_address_st1=$work_address->st1;;$work_address_st2=$work_address->st2;$work_address_vt=$work_address->vt;$work_address_dist=$work_address->dist;$work_address_pin=$work_address->pin;$work_address_mob=$work_address->mob;;$work_address_em=$work_address->em;
			}
			else
			{
				$work_address_st1="";$work_address_st2="";$work_address_vt="";$work_address_dist="";$work_address_pin="";$work_address_mob="";$work_address_email="";
			}		
				
		}else{
			$form_id="";
			$ref="";$year_no="";$ref_date="";$work_done="";$contractor_reg="";$class_of_contract="";$con_valid_dt="";$sup_name="";$sup_reg="";$workman_name="";$workman_reg="";$work_details="";$expected_com_date="";$expected_sub_date="";
			$work_address_st1="";$work_address_st2="";$work_address_vt="";$work_address_dist="";$work_address_pin="";$work_address_mob="";$work_address_em="";	
		}
	
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$ref=$results['ref'];$year_no=$results['year_no'];$ref_date=$results['ref_date'];$work_done=$results['work_done'];$contractor_reg =$results['contractor_reg'];$class_of_contract =$results['class_of_contract'];$con_valid_dt =$results['con_valid_dt'];$sup_name =$results['sup_name'];$sup_reg =$results['sup_reg'];$workman_name =$results['workman_name'];$workman_reg =$results['workman_reg'];$work_details =$results['work_details'];$expected_com_date =$results['expected_com_date'];$expected_sub_date =$results['expected_sub_date'];	
		if(!empty($results["work_address"]))
		{
			$work_address=json_decode($results["work_address"]);
			$work_address_st1=$work_address->st1;;$work_address_st2=$work_address->st2;$work_address_vt=$work_address->vt;$work_address_dist=$work_address->dist;$work_address_pin=$work_address->pin;$work_address_mob=$work_address->mob;;$work_address_em=$work_address->em;
		}
		else
		{
			$work_address_st1="";$work_address_st2="";$work_address_vt="";$work_address_dist="";$work_address_pin="";$work_address_mob="";$work_address_email="";
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
							   <br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">								
									<tr>
										<td colspan="4">
											REF:&nbsp;&nbsp;<input type="text" class="form-control1 text-uppercase"  name="ref" validate="specialChar" value="<?php echo $ref; ?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YEAR/SL. NO:&nbsp;&nbsp;<input type="text" class="form-control1 text-uppercase"  name="year_no" maxlength="4" validate="onlyNumbers" value="<?php echo $year_no; ?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATE :&nbsp;&nbsp;<input type="text" class="dob form-control1 text-uppercase" name="ref_date" value="<?php echo $ref_date; ?>">
										</td>
									</tr>
									<tr>
										<td width="25%">1. Work to be done by:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="work_done" validate="letters" value="<?php echo $work_done; ?>"></td>
										<td width="25%">2. Registration no. of the contractors license :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="contractor_reg" validate="specialChar" value="<?php echo $contractor_reg; ?>" ></td>
									</tr>
									<tr>
										<td>3. Class of contractors license :</td>
										<td><input type="text" class="form-control text-uppercase" name="class_of_contract" validate="specialChar" value="<?php echo $class_of_contract; ?>"></td>
										<td>4. Valid up-to:</td>
										<td><input type="text" class="dob form-control text-uppercase"  name="con_valid_dt" validate="specialChar" value="<?php echo $con_valid_dt; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">5. Name of the supervisor with registration no. of the certificates of competancy  :</td>
									</tr>
									<tr>
										<td>(a) Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="sup_name" validate="letters" value="<?php echo $sup_name; ?>"></td>
										<td>(b) Registration no.:</td>
										<td><input type="text" class="form-control text-uppercase" name="sup_reg" validate="specialChar" value="<?php echo $sup_reg; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">6. Name(s) of the workmen with registration no. of the permit :</td>
									</tr>
									<tr>
										<td>(a) Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="workman_name" validate="letters" value="<?php echo $workman_name; ?>"></td>
										<td>(b) Registration no.:</td>
										<td><input type="text" class="form-control text-uppercase" name="workman_reg" validate="specialChar" value="<?php echo $workman_reg; ?>"></td>
									</tr>
									<tr>
									    <td colspan="4">7. Full address of the place where the work is going to be done :</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="work_address[st1]" validate="specialChar" value="<?php echo $work_address_st1; ?>" ></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="work_address[st2]" validate="specialChar" value="<?php echo $work_address_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="work_address[vt]" validate="specialChar" value="<?php echo $work_address_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($work_address_dist);?>"   name="work_address[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="work_address[pin]" value="<?php echo $work_address_pin; ?>" maxlength="6" validate="pincode"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="work_address[mob]" value="<?php echo $work_address_mob; ?>" maxlength="10" validate="mobileNumber"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" validate="jsonObj" name="work_address[em]" value="<?php echo $work_address_em; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>8. Details description of the work going to be done (attached electrical drawing herewith) :</td>
										<td><textarea class="form-control text-uppercase" validate="specialChar" name="work_details" ><?php echo $work_details; ?></textarea>255 Characters Only</td>
										<td></td>
										<td></td>
									</tr>
								
									<tr>
										<td>9. Expected date of completion of the work :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="expected_com_date" value="<?php echo $expected_com_date; ?>"></td>
										<td>10. Date of submission of this notice  :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="expected_sub_date" value="<?php echo $expected_sub_date; ?>"  ></td>
									</tr>
									<tr>
										<td colspan="2">Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/> 
														Place : <strong><?php echo strtoupper($dist)?></strong>
										</td>										
										<td colspan="2" align="right"><strong><?php echo strtoupper($key_person)?></strong><br/>Signature of contractor
										</td>  
									</tr>																
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
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
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>