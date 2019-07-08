<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="12";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_bt_form.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$used_batt_scrap=$results["used_batt_scrap"];	
		if(!empty($results["num_used_batt"])){
			$num_used_batt=json_decode($results["num_used_batt"]);
			$num_used_batt_avail_batt=$num_used_batt->avail_batt;$num_used_batt_tot_tonnage=$num_used_batt->tot_tonnage;
		}else{
			$num_used_batt_avail_batt="";$num_used_batt_tot_tonnage="";
		}	
		if(!empty($results["num_auct_batteries"])){
			$num_auct_batteries=json_decode($results["num_auct_batteries"]);
			$num_auct_batteries_auc_batt=$num_auct_batteries->auc_batt;$num_auct_batteries_auc_tonnage=$num_auct_batteries->auc_tonnage;
		}else{
			$num_auct_batteries_auc_batt="";$num_auct_batteries_auc_tonnage="";
		}	
	}else{ 
	    $form_id="";
		$num_used_batt_avail_batt="";$num_used_batt_tot_tonnage="";		
		$num_auct_batteries_auc_batt="";$num_auct_batteries_auc_tonnage="";
		$used_batt_scrap="";		
	}
}else{		
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$used_batt_scrap=$results["used_batt_scrap"];			
	if(!empty($results["num_used_batt"])){
		$num_used_batt=json_decode($results["num_used_batt"]);
		$num_used_batt_avail_batt=$num_used_batt->avail_batt;$num_used_batt_tot_tonnage=$num_used_batt->tot_tonnage;
	}else{
		$num_used_batt_avail_batt="";$num_used_batt_tot_tonnage="";
	}	
	if(!empty($results["num_auct_batteries"])){
		$num_auct_batteries=json_decode($results["num_auct_batteries"]);
		$num_auct_batteries_auc_batt=$num_auct_batteries->auc_batt;$num_auct_batteries_auc_tonnage=$num_auct_batteries->auc_tonnage;
	}else{
		$num_auct_batteries_auc_batt="";$num_auct_batteries_auc_tonnage="";
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
                            <form name="myform1" id="myformBT9" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. Name and Address of the Auctioner </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name;?>"> </td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
										<td>Mobile</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>
										<td>Phone Number</td>
		                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_landline_std.'-'.$b_landline_no;?>"></td>
										<td>Email-id</td>
		                            <td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. Name of the Authorized person and full address with telephone </td>
									</tr>
									<tr>
										<td>Full Name</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person?>"></td>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1?>"></td>
									</tr>
									<tr>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill;?>"></td>
									</tr>
									<tr>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist;?>"></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode;?>"></td>
									</tr>
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no;?>"></td>
										<td>Landline No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $landline_std.'-'.$landline_no;?>"></td>
									</tr>
									<tr>
										<td>Email-id</td>
		                             <td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email;?>"></td>
										<td></td>
		                             <td></td>
									</tr>
									<tr>
										<td >3. Number of used batteries and total Tonnage (of MT) available during the period from October-March and April-September</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" placeholder="Number of used batteries" name="num_used_batt[avail_batt]"  required="required" value="<?php echo $num_used_batt_avail_batt; ?>"></td>
										<td></td>
										<td><input type="text" class="form-control text-uppercase" placeholder="Total tonnage"  required="required" name="num_used_batt[tot_tonnage]" value="<?php echo $num_used_batt_tot_tonnage; ?>"></td>
									</tr>
									<tr>
										<td>4. Source of the used battery scrap</td>
										<td><input type="text" class="form-control text-uppercase" name="used_batt_scrap" value="<?php echo $used_batt_scrap; ?>"></td>
									    <td></td>
									    <td></td>
									</tr>
									<tr>
										<td>5. Number  of  used  batteries  and  total  Tonnage  (of  MT)  auctioned  during  the  period  from  October-March  and  April-September </td>				
										<td><input type="text" class="form-control text-uppercase" placeholder="Number of used batteries" name="num_auct_batteries[auc_batt]" validate="onlyNumbers" required="required"value="<?php  echo $num_auct_batteries_auc_batt; ?>"></td>
										<td></td>
										<td><input type="text" class="form-control text-uppercase"  validate="onlyNumbers" placeholder="Total tonnage" name="num_auct_batteries[auc_tonnage]" required="required" value="<?php  echo $num_auct_batteries_auc_tonnage; ?>"></td>
									</tr>
									<tr>
										<td colspan="2">6. Number of used batteries and total Tonnage (of MT) sent to the registered recyclers<br/></td>
										<td colspan="2">Uplaod later in upload section</td>
									</tr>
									<tr>
										<td>Place</td>
										<td><label><?php echo strtoupper($dist); ?></label></td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td>Date</td>
										<td><label><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
										<td>Signature of the authorized person</td>
										<td><label class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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