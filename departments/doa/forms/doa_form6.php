<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="6";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
      
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
		if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$results=$p->fetch_array();
				$form_id=$results["form_id"];$stock=$results["stock"];$state=$results["state"];$licence_no=$results["licence_no"];$year=$results["year"];$pesticides=$results["pesticides"];$principals=$results["principals"];
					
				if(!empty($results["sold"])){
					$sold=json_decode($results["sold"]);
					$sold_sn1=$sold->sn1;$sold_sn2=$sold->sn2;$sold_v=$sold->v;$sold_p=$sold->p;$sold_mno=$sold->mno;$sold_d=$sold->d;
				}else{				
					$sold_sn1="";$sold_sn2="";$sold_v="";$sold_d="";$sold_p="";$sold_mno="";
				}	
				if(!empty($results["stored"])){
					$stored=json_decode($results["stored"]);
					$stored_sn1=$stored->sn1;$stored_sn2=$stored->sn2;$stored_v=$stored->v;$stored_p=$stored->p;$stored_mno=$stored->mno;$stored_d=$stored->d;
				}else{				
					$stored_sn1="";$stored_sn2="";$stored_v="";$stored_d="";$stored_p="";$stored_mno="";
				}
				
			}else{		
				$form_id="";$stock="";$state="";$licence_no="";$year="";$pesticides="";$principals="";
				$sold_sn1="";$sold_sn2="";$sold_v="";$sold_d="";$sold_p="";$sold_mno="";
				$stored_sn1="";$stored_sn2="";$stored_v="";$stored_d="";$stored_p="";$stored_mno="";
			}
		}else{			
			$results=$q->fetch_array();
			$form_id=$results["form_id"];$stock=$results["stock"];$state=$results["state"];$licence_no=$results["licence_no"];$year=$results["year"];$pesticides=$results["pesticides"];$principals=$results["principals"];
				
			if(!empty($results["sold"])){
				$sold=json_decode($results["sold"]);
				$sold_sn1=$sold->sn1;$sold_sn2=$sold->sn2;$sold_v=$sold->v;$sold_p=$sold->p;$sold_mno=$sold->mno;$sold_d=$sold->d;
			}else{				
				$sold_sn1="";$sold_sn2="";$sold_v="";$sold_d="";$sold_p="";$sold_mno="";
			}	
			if(!empty($results["stored"])){
				$stored=json_decode($results["stored"]);
				$stored_sn1=$stored->sn1;$stored_sn2=$stored->sn2;$stored_v=$stored->v;$stored_p=$stored->p;$stored_mno=$stored->mno;$stored_d=$stored->d;
			}else{				
				$stored_sn1="";$stored_sn2="";$stored_v="";$stored_d="";$stored_p="";$stored_mno="";
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
									 <td colspan="4" class="form-inline">1. I/We hereby apply for renewal of the license to sell, stock or exhibit for sold or distribute insecticides under the name and style of &nbsp;<input type="text" name="stock" value="<?php echo $stock; ?>" class="form-control text-uppercase"> &nbsp;The license desired to be renewal was granted by the Licensing Authority for the State of&nbsp;<input type="text" name="state" value="<?php echo $state; ?>" class="form-control text-uppercase"> &nbsp;and allotted license No &nbsp;<input type="text" name="licence_no" value="<?php echo $licence_no; ?>" class="form-control text-uppercase"> &nbsp; day of &nbsp; 20<input type="text" name="year" validate="onlyNumbers" maxlength="2" value="<?php echo $year; ?>" class="form-control text-uppercase">.</td>				 
								</tr>
								<tr>
									<td colspan="4">2. The situation of applicant&#39;s premises where the insecticides are will be :</td>
								</tr>
								<tr>
									<td colspan="4"> (a) Premises where insecticides are sold  : </td>
								</tr>
								<tr>
									<td> Street Name 1  :</td>
									<td><input type="text" class="form-control text-uppercase" name="sold[sn1]" value="<?php echo $sold_sn1;?>" /></td>
									<td> Street Name 2 :</td>
									<td><input type="text" class="form-control text-uppercase"  name="sold[sn2]" value="<?php echo $sold_sn2;?>" /></td>
								</tr>
								<tr>
									<td> Village/ Town :</td>
									<td><input type="text" class="form-control text-uppercase"   name="sold[v]" value="<?php echo $sold_v;?>"/></td>
									<td>District :<span class="mandatory_field">*</span></td>
                                    <td><input type="text" class="form-control text-uppercase"   name="sold[d]" id="sold_d" value="<?php echo $sold_d;?>"/></td>
									
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" maxlength="6" validate="pincode" class="form-control text-uppercase"  name="sold[p]" value="<?php echo $sold_p;?>"></td>
									<td>Mobile No. :</td>
									<td><input type="text" maxlength="10" validate="mobileNumber" name="sold[mno]" value="<?php echo $sold_mno; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td colspan="4">  (b) Premises where insecticides are stored : </td>
								</tr>
								<tr>
									<td> Street Name 1  :</td>
									<td><input type="text" class="form-control text-uppercase" name="stored[sn1]" value="<?php echo $stored_sn1;?>" /></td>
									<td> Street Name 2 :</td>
									<td><input type="text" class="form-control text-uppercase" value="<?php echo $stored_sn2;?>" name="stored[sn2]" /></td>
								</tr>
								<tr>
									<td> Village/ Town :</td>
									<td><input type="text" class="form-control text-uppercase"  name="stored[v]" value="<?php echo $stored_v;?>" /></td>
									<td>District :<span class="mandatory_field">*</span></td>
                                    <td><input type="text" class="form-control text-uppercase"  name="stored[d]" id="stored_d" value="<?php echo $stored_d;?>" /></td>
									
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" maxlength="6" validate="pincode" value="<?php echo $stored_p; ?>" class="form-control text-uppercase" name="stored[p]"></td>
									<td>Mobile No. :</td>
									<td><input maxlength="10" validate="mobileNumber" type="text" name="stored[mno]" value="<?php echo $stored_mno; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td colspan="4">3. The insecticides in which I / am / we / are carrying on business and the name of the principals whom I / we represent are as stated below :</td>				
								</tr>								
								<tr>
									<td>(a)Name of Pesticides :</td>
									<td><input type="text" value="<?php echo $pesticides; ?>" class="form-control text-uppercase" name="pesticides"></td>
									<td>(b) Name of Principals :</td>
									<td><input type="text" name="principals" value="<?php echo $principals; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4">Full Name and Address of the applicant in block letters.</td>
								</tr>
								<tr>
									<td width="25%">i. Name of the applicant :</td>
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
									<td><input type="text"  disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
									<td>Mobile No. :</td>
									<td><input type="text" validate="mobileNumber"  disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id :</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td></td>
									<td></td>									
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