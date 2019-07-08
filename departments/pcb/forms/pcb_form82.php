<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="82";
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
		$scheme_details=$results['scheme_details'];$scheme_list=$results['scheme_list'];$budget=$results['budget'];$programme=$results['programme'];$is_comply=$results['is_comply'];
		if(!empty($results["producer"])){
			$producer=json_decode($results["producer"]);
			$producer_name=$producer->name;$producer_sn1=$producer->sn1;$producer_sn2=$producer->sn2;$producer_vill=$producer->vill;$producer_dist=$producer->dist;$producer_pin=$producer->pin;$producer_mobile=$producer->mobile;$producer_phone=$producer->phone;$producer_email=$producer->email;$producer_other=$producer->other;
		}else{				
			$producer_name="";$producer_sn1="";$producer_sn2="";$producer_vill="";$producer_dist="";$producer_pin="";$producer_mobile="";$producer_phone="";$producer_email="";$producer_other="";
		}			
		if(!empty($results["auth"])){
			$auth=json_decode($results["auth"]);
			$auth_name=$auth->name;$auth_sn1=$auth->sn1;$auth_sn2=$auth->sn2;$auth_vill=$auth->vill;$auth_dist=$auth->dist;$auth_pin=$auth->pin;$auth_mobile=$auth->mobile;$auth_fax=$auth->fax;$auth_email=$auth->email;
		}else{				
			$auth_name="";$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pin="";$auth_mobile="";$auth_fax="";$auth_email="";
		}			
		if(!empty($results["organization"])){
			$organization=json_decode($results["organization"]);
			$organization_name=$organization->name;$organization_sn1=$organization->sn1;$organization_sn2=$organization->sn2;$organization_vill=$organization->vill;$organization_dist=$organization->dist;$organization_pin=$organization->pin;$organization_mobile=$organization->mobile;$organization_fax=$organization->fax;$organization_email=$organization->email;
		}else{				
			$organization_name="";$organization_sn1="";$organization_sn2="";$organization_vill="";$organization_dist="";$organization_pin="";$organization_mobile="";$organization_fax="";$organization_email="";
		}					
	}else{
		$form_id="";	
		$scheme_details="";$scheme_list="";$budget="";$programme="";$is_comply="";		
		$producer_name="";$producer_sn1="";$producer_sn2="";$producer_vill="";$producer_dist="";$producer_pin="";$producer_mobile="";$producer_phone="";$producer_email="";$producer_other="";
		$auth_name="";$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pin="";$auth_mobile="";$auth_fax="";$auth_email="";
		$organization_name="";$organization_sn1="";$organization_sn2="";$organization_vill="";$organization_dist="";$organization_pin="";$organization_mobile="";$organization_fax="";$organization_email="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$scheme_details=$results['scheme_details'];$scheme_list=$results['scheme_list'];$budget=$results['budget'];$programme=$results['programme'];$is_comply=$results['is_comply'];
	if(!empty($results["producer"])){
		$producer=json_decode($results["producer"]);
		$producer_name=$producer->name;$producer_sn1=$producer->sn1;$producer_sn2=$producer->sn2;$producer_vill=$producer->vill;$producer_dist=$producer->dist;$producer_pin=$producer->pin;$producer_mobile=$producer->mobile;$producer_phone=$producer->phone;$producer_email=$producer->email;$producer_other=$producer->other;
	}else{				
		$producer_name="";$producer_sn1="";$producer_sn2="";$producer_vill="";$producer_dist="";$producer_pin="";$producer_mobile="";$producer_phone="";$producer_email="";$producer_other="";
	}			
	if(!empty($results["auth"])){
		$auth=json_decode($results["auth"]);
		$auth_name=$auth->name;$auth_sn1=$auth->sn1;$auth_sn2=$auth->sn2;$auth_vill=$auth->vill;$auth_dist=$auth->dist;$auth_pin=$auth->pin;$auth_mobile=$auth->mobile;$auth_fax=$auth->fax;$auth_email=$auth->email;
	}else{				
		$auth_name="";$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pin="";$auth_mobile="";$auth_fax="";$auth_email="";
	}			
	if(!empty($results["organization"])){
		$organization=json_decode($results["organization"]);
		$organization_name=$organization->name;$organization_sn1=$organization->sn1;$organization_sn2=$organization->sn2;$organization_vill=$organization->vill;$organization_dist=$organization->dist;$organization_pin=$organization->pin;$organization_mobile=$organization->mobile;$organization_fax=$organization->fax;$organization_email=$organization->email;
	}else{				
		$organization_name="";$organization_sn1="";$organization_sn2="";$organization_vill="";$organization_dist="";$organization_pin="";$organization_mobile="";$organization_fax="";$organization_email="";
	}
}
?>

<?php require_once "../../requires/header.php";   ?>
  <?php include ("".$table_name."_addmore.php"); ?>
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
								<form name="myform1" id="myform1" class="submit1" method="post" compliance="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">											
										<tr>
											<td width="25%">1. (a) Name of Producer : </td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="producer[name]" value="<?php echo $producer_name;?>"></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">1. (b) Full address along with telephone numbers, e-mail and other contact details of Producer (It should be the place from where sale in entire country is being managed) : </td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text" class="form-control text-uppercase" name="producer[sn1]" value="<?php echo $producer_sn1;?>"></td>
											<td>Street Name 2</td>
											<td><input type="text" class="form-control text-uppercase" name="producer[sn2]" value="<?php echo $producer_sn2;?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="producer[vill]" value="<?php echo $producer_vill;?>"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" name="producer[dist]" value="<?php echo $producer_dist;?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="producer[pin]" value="<?php echo $producer_pin;?>" validate="pincode" maxlength="6"></td>
											<td>Mobile</td>
											<td><input type="text" class="form-control text-uppercase" name="producer[mobile]" value="<?php echo $producer_mobile;?>" validate="mobileNumber" maxlength="10"></td>
										</tr>
										<tr>
											<td>Phone Number</td>
											<td><input type="text" class="form-control text-uppercase" name="producer[phone]" value="<?php echo $producer_phone;?>"></td>
											<td>Email-id</td>
											<td><input type="email" class="form-control" name="producer[email]" value="<?php echo $producer_email;?>"></td>
										</tr>
										<tr>
											<td>Other details</td>
											<td><input type="text" class="form-control text-uppercase" name="producer[other]" value="<?php echo $producer_other;?>"></td>
											<td colspan="2"></td>
										</tr>	
										<tr>
											<td>2. (a) Name of the Authorised Person : </td>
											<td><input type="text"  class="form-control text-uppercase" name="auth[name]" value="<?php echo $auth_name;?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">2. (b) Full address of the Authorised Person with e-mail, telephone and fax number : </td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[sn1]" value="<?php echo $auth_sn1;?>"></td>
											<td>Street Name 2</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[sn2]" value="<?php echo $auth_sn2;?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[vill]" value="<?php echo $auth_vill;?>"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[dist]" value="<?php echo $auth_dist;?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[pin]" value="<?php echo $auth_pin;?>" validate="pincode" maxlength="6"></td>
											<td>Mobile</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[mobile]" value="<?php echo $auth_mobile;?>" validate="mobileNumber" maxlength="10"></td>
										</tr>
										<tr>
											<td>Fax Number</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[fax]" value="<?php echo $auth_fax;?>"></td>
											<td>Email-id</td>
											<td><input type="email" class="form-control" name="auth[email]" value="<?php echo $auth_email;?>"></td>
										</tr>
										<tr>
											<td colspan="4">3. Name, address and contact details of Producer Responsibility Organisation, if any with full address, e-mail, telephone and fax number, if engaged for implementing the Extended Producer Responsibility : </td>
										</tr>
										<tr>
											<td>Name : </td>
											<td><input type="text"  class="form-control text-uppercase" name="organization[name]" value="<?php echo $organization_name;?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text" class="form-control text-uppercase" name="organization[sn1]" value="<?php echo $organization_sn1;?>"></td>
											<td>Street Name 2</td>
											<td><input type="text" class="form-control text-uppercase" name="organization[sn2]" value="<?php echo $organization_sn2;?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="organization[vill]" value="<?php echo $organization_vill;?>"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" name="organization[dist]" value="<?php echo $organization_dist;?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="organization[pin]" value="<?php echo $organization_pin;?>" validate="pincode" maxlength="6"></td>
											<td>Mobile</td>
											<td><input type="text" class="form-control text-uppercase" name="organization[mobile]" value="<?php echo $organization_mobile;?>" validate="mobileNumber" maxlength="10"></td>
										</tr>
										<tr>
											<td>Fax Number</td>
											<td><input type="text" class="form-control text-uppercase" name="organization[fax]" value="<?php echo $organization_fax;?>"></td>
											<td>Email-id</td>
											<td><input type="email" class="form-control" name="organization[email]" value="<?php echo $organization_email;?>"></td>
										</tr>										
										<tr>
											<td colspan="4">4. Details of electrical and electronic equipment placed on market year-wise during previous 10 years as given below : </td>
										</tr>									
										<tr>
											<td colspan="4">5. Estimated generation of Electrical and Electronic Equipment waste item-wise and estimated collection target for the forthcoming year  including those being generated from their service centres, as given below : </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" class="table table-responsive table-bordered text-center" id="objectTable1" >
												<thead>
													<tr>
														<th rowspan="2">Sl. No. </th>
														<th rowspan="2">Item </th>
														<th colspan="2">Estimated waste electrical and electronic equipment generation </th>
														<th colspan="2">Targeted collection </th>
													</tr>
													<tr>
														<th>Number </th>
														<th>Weight </th>
														<th>Number </th>
														<th>Weight </th>
													</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
													<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>									
													<td><input value="<?php echo $row_1["item"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" name="txtB<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_1["num1"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" ></td>
													<td><input value="<?php echo $row_1["weight1"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_1["num2"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_1["weight2"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
													<td><input id="txtB1" class="form-control text-uppercase" name="txtB1"></td>					
													<td><input id="txtC1" class="form-control text-uppercase" name="txtC1"></td>	
													<td><input id="txtD1" class="form-control text-uppercase" name="txtD1"></td>
													<td><input id="txtE1" class="form-control text-uppercase" name="txtE1"></td>
													<td><input id="txtF1" class="form-control text-uppercase" name="txtF1"></td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>									
										</tr>
										<tr>
											<td colspan="4">6. Extended Producer Responsibility Plans : </td>
										</tr>
										<tr>
											<td colspan="3">(a) Please provide details of your overall scheme to fulfil Extended Producer Responsibility obligations including targets. This should comprise of general scheme of collection of used/waste Electrical and Electronic Equipment from the Electrical and Electronic Equipment placed on the market earlier such as through dealers and collection centres, Producer Responsibility Organisation, through buy-back arrangement, exchange scheme, Deposit Refund Scheme, etc. whether directly or through any authorised agency and channelising the items so collected to authorised recyclers : </td>
											<td><textarea class="form-control text-uppercase" name="scheme_details"><?php echo $scheme_details; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="2">(b) Provide the list with addresses along with agreement copies with dealers, collection centres, recyclers, Treatment, Storage and Disposal Facility, etc. under your scheme : </td>
											<td colspan="2"><textarea class="form-control text-uppercase" name="scheme_list"><?php echo $scheme_list; ?></textarea></td>
										</tr>
										<tr>
											<td>7. Estimated budget for Extended Producer Responsibility and allied initiatives to create consumer awareness : </td>
											<td><input type="text" class="form-control text-uppercase" name="budget" value="<?php echo $budget;?>"></td>
											<td>8. Details of proposed awareness programmes : </td>
											<td colspan="2"><textarea class="form-control text-uppercase" name="programme"><?php echo $programme; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="4">9. Details for Reduction of Hazardous Substances compliance (to be filled if applicable) : </td>
										</tr>
										<tr>
											<td colspan="3">(a) Whether the Electrical and Electronic Equipment placed on market complies with the rule 16 (1) limits with respect to lead, mercury, cadmium, hexavalent chromium, polybrominated biphenyls and polybrominateddiphenyl ethers : </td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_comply" value="Y"  <?php if(isset($is_comply) && $is_comply=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" value="N"  name="is_comply" <?php if(isset($is_comply) && ($is_comply=='N' || $is_comply=='')) echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td colspan="3">(b)Provide the technical documents (Supplier declarations, Materials declarations/Analytical reports) as evidence that the Reduction of Hazardous Substances (RoHS) provisions are complied by the product based on standard EN 50581 of EU : </td>
											<td>Upload later in upload section </td>
										</tr>										
										<tr>
											<td colspan="2" align="left">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Authorized Signature : <strong><?php echo strtoupper($key_person)?></strong></td>
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