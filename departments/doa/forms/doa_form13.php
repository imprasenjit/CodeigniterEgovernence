<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="13";
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
		    $form_id=$results["form_id"];$is_convicted=$results["is_convicted"];$is_convicted_details=$results["is_convicted_details"];$seeds_detail=$results["seeds_detail"];
			
			if(!empty($results["sale"])){
				$sale=json_decode($results["sale"]);
				$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_p=$sale->p;$sale_mno=$sale->mno;$sale_d=$sale->d;
			}else{				
				$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
			}	
			if(!empty($results["storage"])){
				$storage=json_decode($results["storage"]);
				$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_p=$storage->p;$storage_mno=$storage->mno;$storage_d=$storage->d;
			}else{				
				$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
			}
		}else{
			$form_id="";$is_convicted="";$is_convicted_details="";$seeds_detail="";
			$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
			$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
		}
	}else{			
			$results=$q->fetch_array();
			$form_id=$results["form_id"];$is_convicted=$results["is_convicted"];$is_convicted_details=$results["is_convicted_details"];$seeds_detail=$results["seeds_detail"];
			
			if(!empty($results["sale"])){
				$sale=json_decode($results["sale"]);
				$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_p=$sale->p;$sale_mno=$sale->mno;$sale_d=$sale->d;
			}else{				
				$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
			}	
			if(!empty($results["storage"])){
				$storage=json_decode($results["storage"]);
				$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_p=$storage->p;$storage_mno=$storage->mno;$storage_d=$storage->d;
			}else{				
				$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
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
										<td width="25%">The Registering Authority<br/>Government of Assam</td>
										<td width="25%"></td>
										<td width="25%">Place :</td>
										<td width="25%"><label disabled class="form-control text-uppercase" ><?php echo $dist; ?></label></td>								
									</tr>
									<tr>
										<td width="25%">1. i. Name of the applicant :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
										<td width="25%"></td>
										<td width="25%"></td>		
									</tr>
									<tr>
										 <td colspan="4">ii. Postal address of the applicant :  	</td>				 
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
										<td colspan="4">2. Place of business (please give the accurate address) : </td>
									</tr>
									<tr>
										<td colspan="4"> i. For sale  : </td>
									</tr>
									<tr>
										<td> Street Name 1  :</td>
										<td><input type="text" class="form-control text-uppercase" name="sale[sn1]" value="<?php echo $sale_sn1;?>" /></td>
										<td> Street Name 2 :</td>
										<td><input type="text" class="form-control text-uppercase"  name="sale[sn2]" value="<?php echo $sale_sn2;?>" /></td>
									</tr>
									<tr>
										<td> Village/ Town :</td>
										<td><input type="text" class="form-control text-uppercase"   name="sale[v]" value="<?php echo $sale_v;?>"/></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td><input type="text" class="form-control text-uppercase"   name="sale[d]" id="sale_d" value="<?php echo $sale_d;?>"/></td>
										
									</tr>
									<tr>
										<td>Pincode :</td>
										<td><input type="text" class="form-control text-uppercase"  name="sale[p]" validate="pincode" maxlength="6" value="<?php echo $sale_p;?>"></td>
										<td>Mobile No. :</td>
										<td><input type="text" name="sale[mno]" validate="mobileNumber" maxlength="10" value="<?php echo $sale_mno; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td colspan="4">  ii. For Storage : </td>
									</tr>
									<tr>
										<td> Street Name 1  :</td>
										<td><input type="text" class="form-control text-uppercase" name="storage[sn1]" value="<?php echo $storage_sn1;?>" /></td>
										<td> Street Name 2 :</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $storage_sn2;?>" name="storage[sn2]" /></td>
									</tr>
									<tr>
										<td> Village/ Town :</td>
										<td><input type="text" class="form-control text-uppercase"  name="storage[v]" value="<?php echo $storage_v;?>" /></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td><input type="text" class="form-control text-uppercase"  name="storage[d]" id="storage_d" value="<?php echo $storage_d;?>" /></td>
										
									</tr>
									<tr>
										<td>Pincode :</td>
										<td><input type="text" validate="pincode" maxlength="6" value="<?php echo $storage_p; ?>" class="form-control text-uppercase" name="storage[p]"></td>
										<td>Mobile No. :</td>
										<td><input validate="mobileNumber" maxlength="10"   type="text" name="storage[mno]" value="<?php echo $storage_mno; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>3. Select the appropriate category of business :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $Type_of_ownership;?>"></td>
										<td></td>
										<td width="25%"> </td>
									</tr>
									<tr>
									 <td colspan="4">4. Name and Address of the Proprietor/Partner/Manager/Karta  :</td> 
								</tr>
								<tr>
									<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr>
												<th>Sl. No.</th>
												<th>Name</th>
												<th>Address</th>
												<th>Contact No</th>
											</tr>
										</thead>	
											<?php 
											$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$doa->error);					
											if($member_results->num_rows==0){
												for($i=1;$i<=count($owners);$i++){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
													<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" ></td>
													<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" value="" ></td>
												</tr>
												<?php } ?>
												<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
											<?php }else{
													$i=1;
											while($rows=$member_results->fetch_object()){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
													<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" ></td>
													<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" value="<?php echo $rows->contact; ?>" /></td>
												</tr>
											<?php $i++;
											} ?>
												<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
											<?php } ?>									
										</table>
									</td>
								</tr>
									<tr>
										<td width="25%">5. Was the applicant ever convicted under the essential commodities Act. 1955 (10 of 1955) or any order issued under during the last three years preceding the date of  application.</td>
										<td><label class="radio-inline"><input type="radio" name="is_convicted" class="is_convicted" value="Y"  <?php if(isset($is_convicted) && $is_convicted=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" class="is_convicted"  value="N"  name="is_convicted" <?php if(isset($is_convicted) && ($is_convicted=='N' || $is_convicted=='')) echo 'checked'; ?>/> No</label></td>
										<td width="25%">if yes,  Give Details  :</td>
										<td><input  type="text" name="is_convicted_details" id="is_convicted_details" value="<?php echo $is_convicted_details; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>6. Give the details of seeds to be handled :</td>
										<td><textarea class="form-control text-uppercase" name="seeds_detail"><?php echo $seeds_detail;?></textarea></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									   <td>Place:</td>
										<td><label disabled class="form-control text-uppercase" ><?php echo $dist; ?></label></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
									   <td>Date:</td>
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
	
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
$('#is_convicted_details').attr('readonly','readonly');
	<?php if($is_convicted == 'Y') echo "$('#is_convicted_details').removeAttr('readonly','readonly');"; ?>
	$('.is_convicted').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_convicted_details').removeAttr('readonly','readonly');
		}else{
			$('#is_convicted_details').attr('readonly','readonly');
			$('#is_convicted_details').val('');
		}			
	});
	
</script>