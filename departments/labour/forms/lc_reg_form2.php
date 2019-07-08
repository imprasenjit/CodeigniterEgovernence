<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="2";
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
			$nature_work=$results["nature_work"];$father_name=$results["father_name"];	$max_workers=$results["max_workers"];$nature_w_emp=$results["nature_w_emp"];
			if(!empty($results["manager"])){				
				$manager=json_decode($results["manager"]);
				$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_pin=$manager->pin;				
			}else{
				$$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
			}
		}else{ 
			$nature_work="";$father_name="";$max_workers="";$nature_w_emp="";
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
			
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$nature_work=$results["nature_work"];$father_name=$results["father_name"];	$max_workers=$results["max_workers"];$nature_w_emp=$results["nature_w_emp"];
		if(!empty($results["manager"])){				
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_pin=$manager->pin;				
		}else{
			$$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
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
									<form name="myform1" id="labourComF2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr>
												<td width="25%">1. (a) Name of Establishment, if any </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td colspan="4">(b) Location of The Establishment </td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_dist; ?>" /></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"/> </td>
												<td></td>
												<td></td>
											</tr>									
											<tr>
												<td colspan="4">2. Postal address of the Establishment(Alternate Address) </td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
												<td></td>
												<td></td>
											</tr>									
											<tr>
												<td colspan="4">3. Full name and address of the Principal Employer (furnish father's name in the case of individuals) </td>
											</tr>
											<tr>
												<td>Full Name</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
												<td>Father Name</td>
												<td><input type="text" class="form-control text-uppercase" validate="letters" name="father_name" value="<?php echo $father_name;?>"></td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
												<td></td>
												<td></td>
											</tr>									
											<tr>
												<td colspan="4">4. Full name and Address of the Manager or person responsible for the supervision and Control of the establishment.   </td>
											</tr>
											<tr>
												<td>Full Name</td>
												<td><input type="text" class="form-control text-uppercase" name="manager[name]" value="<?php echo $manager_name; ?>" validate="letters"></td>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" name="manager[sn1]"  value="<?php echo $manager_sn1; ?>"></td>
											</tr>
											<tr>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" name="manager[sn2]" value="<?php echo $manager_sn2; ?>" ></td>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" name="manager[v]" value="<?php echo $manager_v; ?>"></td>
											</tr>
											<tr>
												<td>District</td>
												<td>
                                                <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($manager_d);?>"  placeholder="Enter District" name="manager[d]">    
                                                </td>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" id="manager_pin" name="manager[pin]"  value="<?php echo $manager_pin; ?>" ></td>
											</tr>
											<tr>
												<td>5. Nature of work carried on in the Establishment </td>
												<td><textarea class="form-control text-uppercase" name="nature_work" maxlength="255" validate="letters"  validate="textarea"><?php echo $nature_work; ?> </textarea></td>
												<td>6. Nature of work in which contract labour is employed or is to be employed </td>
												<td><textarea class="form-control text-uppercase"  validate="textarea" validate="letters" name="nature_w_emp"><?php echo $nature_w_emp; ?></textarea></td>
											</tr>
											<tr>
												<td colspan="3">7. Maximum no. of Contract Labour to be employed in the Establishment on any day (through all the contractors)<span class="mandatory_field">*</span></td>
												<td><input type="text" class="form-control text-uppercase" required="required" validate="onlyNumbers" name="max_workers" value="<?php echo $max_workers; ?>"></td>
											</tr>
											
											<tr>
												<td>Submission Date:</td>
												<td><label class="text-uppercase"><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
												<td>Signature of the Principal Employer:</td>
												<td ><label class="text-uppercase"><?php echo $key_person; ?></label></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<button type="submit" name="save<?php echo $form;?>" class="btn btn-success submit1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	</div>
	<!-- ./wrapper -->
<script>
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
</body>
</html>