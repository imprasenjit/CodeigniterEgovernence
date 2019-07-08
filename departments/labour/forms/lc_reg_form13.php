<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="13";
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
			$form_id=$results['form_id'];	
			$motor_trns_name=$results['motor_trns_name'];$nature=$results['nature'];$tot_no=$results['tot_no'];$tot_route=$results['tot_route'];$tot_n_motor=$results['tot_n_motor'];$max_workers=$results['max_workers'];$gm_name=$results['gm_name'];$director_name=$results['director_name'];$owners=$results['owners'];
				
			if(!empty($results["mt_address"])){
				$mt_address=json_decode($results["mt_address"]);
				$mt_address_sn1=$mt_address->sn1;$mt_address_sn2=$mt_address->sn2;$mt_address_vill=$mt_address->vill;$mt_address_dist=$mt_address->dist;$mt_address_pin=$mt_address->pin;$mt_address_mob=$mt_address->mob;$mt_address_email=$mt_address->email;
			}else{
				$mt_address_name="";$mt_address_sn1="";$mt_address_sn2="";$mt_address_vill="";$mt_address_dist="";$mt_address_pin="";$mt_address_mob="";$mt_address_email="";
			}		
			if(!empty($results["gm_address"])){
				$gm_address=json_decode($results["gm_address"]);
				$gm_address_sn1=$gm_address->sn1;$gm_address_sn2=$gm_address->sn2;$gm_address_vill=$gm_address->vill;$gm_address_dist=$gm_address->dist;$gm_address_pin=$gm_address->pin;
			}else{
				$gm_address_sn1="";$gm_address_sn2="";$gm_address_vill="";$gm_address_dist="";$gm_address_pin="";
			}
			if(!empty($results["director_address"])){
				$director_address=json_decode($results["director_address"]);
				$director_address_sn1=$director_address->sn1;$director_address_sn2=$director_address->sn2;$director_address_vill=$director_address->vill;$director_address_dist=$director_address->dist;$director_address_pin=$director_address->pin;
			}else{
				$director_address_sn1="";$director_address_sn2="";$director_address_vill="";$director_address_dist="";$director_address_pin="";
			}
		}else{	 
			$form_id="";
			$motor_trns_name="";$nature="";$tot_no="";$tot_route="";$tot_n_motor="";$max_workers="";$gm_name="";$director_name=""; 
			$mt_address_sn1="";$mt_address_sn2="";$mt_address_vill="";$mt_address_dist="";$mt_address_pin="";$mt_address_mob="";$mt_address_email="";
			$gm_address_sn1="";$gm_address_sn2="";$gm_address_vill="";$gm_address_dist="";$gm_address_pin="";
			$director_address_sn1="";$director_address_sn2="";$director_address_vill="";$director_address_dist="";$director_address_pin="";$owners="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$motor_trns_name=$results['motor_trns_name'];$nature=$results['nature'];$tot_no=$results['tot_no'];$tot_route=$results['tot_route'];$tot_n_motor=$results['tot_n_motor'];$max_workers=$results['max_workers'];$gm_name=$results['gm_name'];$director_name=$results['director_name'];$owners=$results['owners'];
			
		if(!empty($results["mt_address"])){
			$mt_address=json_decode($results["mt_address"]);
			$mt_address_sn1=$mt_address->sn1;$mt_address_sn2=$mt_address->sn2;$mt_address_vill=$mt_address->vill;$mt_address_dist=$mt_address->dist;$mt_address_pin=$mt_address->pin;$mt_address_mob=$mt_address->mob;$mt_address_email=$mt_address->email;
		}else{
			$mt_address_name="";$mt_address_sn1="";$mt_address_sn2="";$mt_address_vill="";$mt_address_dist="";$mt_address_pin="";$mt_address_mob="";$mt_address_email="";
		}		
		if(!empty($results["gm_address"])){
			$gm_address=json_decode($results["gm_address"]);
			$gm_address_sn1=$gm_address->sn1;$gm_address_sn2=$gm_address->sn2;$gm_address_vill=$gm_address->vill;$gm_address_dist=$gm_address->dist;$gm_address_pin=$gm_address->pin;
		}else{
			$gm_address_sn1="";$gm_address_sn2="";$gm_address_vill="";$gm_address_dist="";$gm_address_pin="";
		}
		if(!empty($results["director_address"])){
			$director_address=json_decode($results["director_address"]);
			$director_address_sn1=$director_address->sn1;$director_address_sn2=$director_address->sn2;$director_address_vill=$director_address->vill;$director_address_dist=$director_address->dist;$director_address_pin=$director_address->pin;
		}else{
			$director_address_sn1="";$director_address_sn2="";$director_address_vill="";$director_address_dist="";$director_address_pin="";
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
								 <form name="my_form6" id="my_form6" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								 <table class="table table-responsive">
									<tr>
									    <td width="25%">1. Name of motor transport undertaking.</td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" validate="letters" name="motor_trns_name" value="<?php echo $motor_trns_name; ?>"></td>
									    <td width="25%"></td>
									    <td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">2. Full address to which communications relating to the motor transport undertaking should be sent.</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="mt_address[sn1]" value="<?php echo $mt_address_sn1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="mt_address[sn2]" value="<?php echo $mt_address_sn2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="mt_address[vill]" value="<?php echo $mt_address_vill;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase"  name="mt_address[pin]" value="<?php echo $mt_address_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" name="mt_address[mob]" maxlength="10" value="<?php echo $mt_address_mob; ?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="mt_address[email]" validate="email" value="<?php echo $mt_address_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>3. Nature of motor transport service, e.g., City Service, long distance passenger service, long distance freight service.</td>
										<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>
										<td>4. Total number of routes.</td>
										<td><input type="text" class="form-control" name="tot_no" value="<?php echo $tot_no; ?>"></td>
									</tr>
									<tr>
										<td>5. Total route mileage.</td>
										<td><input type="text" class="form-control" name="tot_route" value="<?php echo $tot_route; ?>"></td>
										<td>6. Total number of motor transport vehicles on the last date of the preceding year.</td>
										<td><input type="text" class="form-control" name="tot_n_motor" value="<?php echo $tot_n_motor; ?>"></td>
									</tr>
									<tr>
										<td>7. Maximum number of motor transport workers directored on any day during the preceding year.<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control" name="max_workers" required="required" validate="onlyNumbers" value="<?php echo $max_workers; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">8. Full names and residential address : </td>
									</tr>
									<tr>
										<td colspan="4">(i) Proprietor and partners of the motor transport undertaking in case of a firm not registered under the Companies Act, 1956; or</td>
									</tr>
									<tr>
										<td colspan="4">
										<table  class="table table-responsive">
										<thead>
											<tr >
												<th width="10%">Sl. No.</th>
												<th width="20%">Proprietor and Partners Name</th>
												<th width="10%">Street Name 1</th>
												<th width="10%">Street Name 2</th>
												<th width="10%">Village/Town</th>
												<th width="10%">District</th>
												<th width="10%">Pincode</th>
											</tr>
										</thead>	
										<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
										if($member_results->num_rows==0){
											for($i=1;$i<=count(array($owners));$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count(array($owners)); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->v; ?>" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->d; ?>" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->p; ?>" maxlength="6" validate="pincode" ></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										</td>
										</tr>
										</table></td>
									</tr>
									<tr>
										<td colspan="4">(ii) General manager in case of a public sector undertaking.</td>
									</tr>
									<tr>
									    <td >Full Name</td>
									    <td><input type="text" class="form-control text-uppercase" name="gm_name" value="<?php echo $gm_name; ?>"></td>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="gm_address[sn1]" value="<?php echo $gm_address_sn1; ?>"></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="gm_address[sn2]" value="<?php echo $gm_address_sn2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="gm_address[vill]" value="<?php echo $gm_address_vill; ?>"> </td>
									</tr>
									<tr>
										<td>District</td>
										<td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($gm_address_dist);?>"  placeholder="Enter District" name="gm_address[dist]">    
                                        </td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="gm_address[pin]" value="<?php echo $gm_address_pin; ?>" validate="pincode" maxlength="6"></td>
									</tr>
									<tr>
										<td colspan="4">9. Full name and residential addresses of the Directors in the case of a company registered under the Companies Act, 1956.</td>
									</tr>
									<tr>
									    <td >Full Name</td>
									    <td><input type="text" class="form-control text-uppercase" name="director_name" validate="letters" value="<?php echo $director_name; ?>"></td>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="director_address[sn1]" value="<?php echo $director_address_sn1; ?>"></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="director_address[sn2]" value="<?php echo $director_address_sn2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="director_address[vill]" value="<?php echo $director_address_vill; ?>"></td>
									</tr>
									<tr>
										<td>District</td>
										<td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($director_address_dist);?>"  placeholder="Enter District" name="director_address[dist]">    
                                        </td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="director_address[pin]" validate="pincode" maxlength="6" value="<?php echo $director_address_pin; ?>"></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>