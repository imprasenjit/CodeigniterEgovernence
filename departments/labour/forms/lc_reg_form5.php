<?php  require_once "../../requires/login_session.php";
$dept="labour";
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
			$form_id=$results['form_id'];	
			$father_name=$results["father_name"];$nature_work=$results["nature_work"];	$max_workers=$results["max_workers"];$commencement_date=$results["commencement_date"];	$completion_date=$results["completion_date"];$b_street_name1=$results["b_street_name1"]; 		
			
			if(!empty($results["manager"])){
				$manager=json_decode($results["manager"]);
				$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_pin=$manager->pin;			
			}else{
				$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
			}
		}else{
			$father_name="";$nature_work="";$max_workers="";$commencement_date="";$completion_date="";$b_street_name1="";
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$father_name=$results["father_name"];$nature_work=$results["nature_work"];	$max_workers=$results["max_workers"];$commencement_date=$results["commencement_date"];	$completion_date=$results["completion_date"];$b_street_name1=$results["b_street_name1"]; 		
		
		if(!empty($results["manager"])){
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_pin=$manager->pin;			
		}else{
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
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
								<form name="myform1" id="" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table  class="table table-responsive">
									<tr>
										<td width="25%">1.(a) Name of The Establishment </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $unit_name; ?>" disabled="disabled"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Location of The Establishment where building or other construction work is to be carried on </td>
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
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="4">2. Postal address of the Establishment.
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
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>" ></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>" id="pincode2"></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="4">3. Full name and Permanent address of the Establishment (furnish father's name in the case of individuals) </td>
									</tr>
									
									<tr>
										<td>Full Name</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
										<td>Father Name<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" validate="letters" name="father_name" value="<?php echo $father_name; ?>" required="required"></td>
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
										<td colspan="4">4. Full name and address of the Manager or person responsible for the supervision and control of the Establishment   </td>
									</tr>
									
									<tr>
										<td>Full Name<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="manager[name]" validate="letters" value="<?php echo $manager_name; ?>"required="required"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									
									<tr>
										<td>Street Name 1<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $manager_sn1; ?>" name="manager[sn1]" required="required"></td>
										<td>Street Name 2<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="manager[sn2]" value="<?php echo $manager_sn2; ?>"required></td>
									</tr>
									<tr>
										<td>Village/Town<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="manager[v]" value="<?php echo $manager_v; ?>" required></td>
										<td>District</td>
										<td>
										
                                          <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($manager_d);?>"  placeholder="Enter District" name="manager[d]"">    
								        </td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $manager_pin; ?>" validate="pincode" maxlength="6" name="manager[pin]"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
										<td>5. Nature of building or other construction work carried/is to be carried on in the Establishment</td>
										<td><textarea class="form-control text-uppercase" name="nature_work"><?php echo $nature_work; ?></textarea></td>
										<td>6. Maximum number of building workers to be employed on any day <span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="max_workers" required="required" value="<?php echo $max_workers; ?>"/></td>
									</tr>
									<tr>
										<td>7. Estimated date of commencement of building or the other construction work </td>
										<td><input type="datetime" class="dob form-control text-uppercase" placeholder="DD/MM/YYYY" name="commencement_date"  value="<?php echo $commencement_date; ?>"></td>
										<td>8. Estimated date of completion of the building or other construction work</td>
										<td><input type="datetime" class="dob form-control text-uppercase" placeholder="DD/MM/YYYY" name="completion_date"  value="<?php echo $completion_date; ?>"></td>
									</tr>
									
									<tr>
										<td>Date : <label><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
										<td></td>
										<td></td>
										<td align="right">Signature of the Principal Employer : <label><?php echo strtoupper($key_person); ?></label> </td>
										
									</tr>
									<tr>
										
										<td class="text-center" colspan="4">
											<button type="submit"  value="SAVE & NEXT" name="save<?php echo $form;?>" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" class="btn btn-success submit1">Save and Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
