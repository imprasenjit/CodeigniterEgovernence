<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="32";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form1.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	   if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$results=$p->fetch_array();
				$form_id=$results["form_id"];
				
				//tab1
				if(!empty($results["godown_add"])){
					$godown_add=json_decode($results["godown_add"]);
					$godown_add_st1=$godown_add->st1;$godown_add_st2=$godown_add->st2;$godown_add_vil=$godown_add->vil;$godown_add_dist=$godown_add->dist;$godown_add_pin=$godown_add->pin;$$godown_add_mno=$godown_add->mno;$$godown_add_email=$godown_add->email;
				}else{				
					$godown_add_st1="";$godown_add_st2="";$godown_add_vil="";$godown_add_dist="";$godown_add_pin="";$godown_add_mno="";$godown_add_email="";
				}
				
				$licence_number=$results["licence_number"];$date_of_fertilizer=$results["date_of_fertilizer"];
				
				if(!empty($results["address_change"])){
					$address_change=json_decode($results["address_change"]);
					if(isset($address_change->a)) $address_change_a=$address_change->a; else $address_change_a="";
					if(isset($address_change->b)) $address_change_b=$address_change->b; else $address_change_b="";
				}else{
					$address_change_a="";$address_change_b="";
				}
				
				//tab2
				$existing_office_add=$results["existing_office_add"];$new_office_add=$results["new_office_add"];
				$existing_godown_add=$results["existing_godown_add"];$new_godown_add=$results["new_godown_add"];
				$is_affidavit=$results["is_affidavit"];
				
			}else{
				$form_id="";
				//tab1
				$godown_add_st1="";$godown_add_st2="";$godown_add_vil="";$godown_add_dist="";$godown_add_pin="";$godown_add_mno="";$godown_add_email="";
				
				$licence_number="";$date_of_fertilizer="";
				
				$address_change_a="";$address_change_b="";
				
				//tab2
				$existing_office_add="";$new_office_add="";
				$existing_godown_add="";$new_godown_add="";
				$is_affidavit="";
			}
	}else{			
			$results=$q->fetch_array();
			$form_id=$results["form_id"];
			//tab1
				if(!empty($results["godown_add"])){
					$godown_add=json_decode($results["godown_add"]);
					$godown_add_st1=$godown_add->st1;$godown_add_st2=$godown_add->st2;$godown_add_vil=$godown_add->vil;$godown_add_dist=$godown_add->dist;$godown_add_pin=$godown_add->pin;$godown_add_mno=$godown_add->mno;$godown_add_email=$godown_add->email;
				}else{				
					$godown_add_st1="";$godown_add_st2="";$godown_add_vil="";$godown_add_dist="";$godown_add_pin="";$godown_add_mno="";$godown_add_email="";
				}
			
			$licence_number=$results["licence_number"];$date_of_fertilizer=$results["date_of_fertilizer"];
			
				if(!empty($results["address_change"])){
					$address_change=json_decode($results["address_change"]);
					if(isset($address_change->a)) $address_change_a=$address_change->a; else $address_change_a="";
					if(isset($address_change->b)) $address_change_b=$address_change->b; else $address_change_b="";
			
				}else{
					$address_change_a="";$address_change_b="";
				}
			
			//tab2
			$existing_office_add=$results["existing_office_add"];$new_office_add=$results["new_office_add"];
			$existing_godown_add=$results["existing_godown_add"];$new_godown_add=$results["new_godown_add"];
			$is_affidavit=$results["is_affidavit"];
	}
	
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
	}
	##PHP TAB management ends
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
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a  href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
							</ul>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
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
										<td width="25%">1. Name of the applicant :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
										<td width="25%"></td>
										<td width="25%"></td>		
									</tr>
									<tr>
										 <td colspan="4">Address of the applicant : </td>				 
									</tr>
									<tr>
										<td width="25%">Street name 1 :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
										<td width="25%">Street name 2 :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>	
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
										<td>District :</td>
										<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pincode :</td>
										<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
										<td>Mobile No. :</td>
										<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>E-mail id :</td>
										<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
										<td></td>
										<td></td>									
									</tr>
									<tr>
										 <td colspan="4">2. Registered Office Address :</td>				 
									</tr>
									<tr>
										<td width="25%">Street name 1 :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
										<td width="25%">Street name 2 :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>	
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" disabled value="<?php echo $b_vill; ?>" class="form-control text-uppercase"></td>
										<td>District :</td>
										<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pincode :</td>
										<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control text-uppercase"></td>
										<td>Mobile No. :</td>
										<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>E-mail id :</td>
										<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control"></td>
										<td></td>
										<td></td>									
									</tr>
									<tr>
										 <td colspan="4">3. Godown Address :</td>				 
									</tr>
									<tr>
										<td width="25%">Street name 1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="godown_add[st1]" value="<?php echo $godown_add_st1; ?>" ></td>
										<td width="25%">Street name 2 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="godown_add[st2]" value="<?php echo $godown_add_st2; ?>" ></td>	
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="godown_add[vil]" value="<?php echo $godown_add_vil; ?>" ></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" name="godown_add[dist]" value="<?php echo $godown_add_dist; ?>" ></td>
									</tr>
									<tr>
										<td>Pincode :</td>
										<td><input type="text" name="godown_add[pin]" value="<?php echo $godown_add_pin; ?>" class="form-control" validate="pincode" maxlength="6"></td>
										<td>Mobile No. :</td>
										<td><input validate="onlyNumbers" type="text" name="godown_add[mno]" value="<?php echo $godown_add_mno; ?>" class="form-control" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>E-mail id :</td>
										<td><input type="email" name="godown_add[email]" value="<?php echo $godown_add_email; ?>" class="form-control"></td>
										<td></td>
										<td></td>									
									</tr>
									<tr>
										<td colspan="4">4. Existing Valid Seed License No. & Dated :</td>
									</tr>
									<tr>
										<td>Licence number :</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $licence_number;?>" name="licence_number" /></td>
										<td>Date :</td>
										<td><input type="text" class="dob form-control text-uppercase" value="<?php echo $date_of_fertilizer;?>" name="date_of_fertilizer" /></td>
									</tr>
									<tr>
										<td>5. Which address to change :</td>
										<td colspan="3">
											<label class="checkbox-inline"><input type="checkbox" <?php if($address_change_a=="O") echo "checked"; ?> name="address_change[a]" value="O">Office&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><br/>
											<label class="checkbox-inline"><input type="checkbox" <?php if($address_change_b=="G") echo "checked"; ?> name="address_change[b]" value="G">Godown&nbsp;&nbsp;</label>
										</td>
									</tr>
									
										<tr>
											<td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save and Go to the Next Part" onclick="return confirm('Do you want to save the form ?')">Save and Next</button>
											</td>
										</tr>
									</table>
								</form>
								</div>
								
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive table-bordered">
										<tr>
											<td colspan="4">6. For Office Address Change :</td>
										</tr>
										<tr>
											<td width="25%">Existing office Address  :</td>
											<td width="25%"><textarea class="form-control text-uppercase" name="existing_office_add" validate="textarea"><?php echo $existing_office_add;?></textarea></td>
											<td width="25%">New Office Address :</td>
											<td width="25%"><textarea class="form-control text-uppercase" name="new_office_add" validate="textarea"><?php echo $new_office_add;?></textarea></td>
										</tr>
										
										<tr>
												<td colspan="4">7. For Godown Address Change :</td>
										</tr>
										<tr>
												<td>Existing Godown Address  :</td>
												<td><textarea class="form-control text-uppercase" name="existing_godown_add" validate="textarea"><?php echo $existing_godown_add;?></textarea></td>
												<td>New Godown Address :</td>
												<td><textarea class="form-control text-uppercase" name="new_godown_add" validate="textarea"><?php echo $new_godown_add;?></textarea></td>
										</tr>
										<tr>
											<td>8. Court Affidavit of address change submitted :</td>
											<td><label class="radio-inline"><input type="radio" name="is_affidavit" class="is_affidavit" value="Y"  <?php if(isset($is_affidavit) && $is_affidavit=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_affidavit"  value="N"  name="is_affidavit" <?php if(isset($is_affidavit) && ($is_affidavit=='N' || $is_affidavit=='')) echo 'checked'; ?>/> No</label></td>
										</tr>
										
									<tr>
											<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b>
											<br/>Place : <b><label><?php echo strtoupper($dist) ?></label></b>
											</td>
											<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>Signature of applicant</td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
		
</script>