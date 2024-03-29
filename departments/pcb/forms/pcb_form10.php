<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="10";
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
		$annual_cap=$results["annual_cap"];$qnty_recovd_scrap=$results["qnty_recovd_scrap"];
		if(!empty($results["total_qnty"])){
			$total_qnty=json_decode($results["total_qnty"]);
			$total_qnty_manuf=$total_qnty->manuf;$total_qnty_delears=$total_qnty->delears;$total_qnty_auct=$total_qnty->auct;$total_qnty_source=$total_qnty->source;
		}else{
			$total_qnty_manuf="";$total_qnty_delears="";$total_qnty_auct="";$total_qnty_source="";
		}	
		if(!empty($results["qnty_recved"])){
			$qnty_recved=json_decode($results["qnty_recved"]);
			$qnty_recved_manuf=$qnty_recved->manuf;$qnty_recved_other_agencies=$qnty_recved->other_agencies;
		}else{
			$qnty_recved_manuf="";$qnty_recved_other_agencies="";
		}	
	}else{
         $form_id="";		
		$annual_cap="";$qnty_recovd_scrap="";					
		$total_qnty_manuf="";$total_qnty_delears="";$total_qnty_auct="";$total_qnty_source="";			
		$qnty_recved_manuf="";$qnty_recved_other_agencies="";					
	}
}else{
	$results=$q->fetch_assoc();	
	$form_id=$results['form_id'];
	$annual_cap=$results["annual_cap"];$qnty_recovd_scrap=$results["qnty_recovd_scrap"];
	if(!empty($results["total_qnty"])){
		$total_qnty=json_decode($results["total_qnty"]);
		$total_qnty_manuf=$total_qnty->manuf;$total_qnty_delears=$total_qnty->delears;$total_qnty_auct=$total_qnty->auct;$total_qnty_source=$total_qnty->source;
	}else{
		$total_qnty_manuf="";$total_qnty_delears="";$total_qnty_auct="";$total_qnty_source="";
	}	
	if(!empty($results["qnty_recved"])){
		$qnty_recved=json_decode($results["qnty_recved"]);
		$qnty_recved_manuf=$qnty_recved->manuf;$qnty_recved_other_agencies=$qnty_recved->other_agencies;
	}else{
		$qnty_recved_manuf="";$qnty_recved_other_agencies="";
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
                            <form name="myform1" id="myformBT5" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%">1.Name and address of the recycler </td>
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
										<td colspan="4">2. Name of the Authorized person and full address with telephone</td>
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
										<td colspan="3">3. Installed annual capacity to recycle used battery scrap (in MTA) :</td>
										<td><input type="text" class="form-control text-uppercase" name="annual_cap" required="required" value="<?php echo $annual_cap; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">4. Total quantity of used battery scrap purchased from / sent for processing during the period from October - March/April - September-</td>
									</tr>
									<tr>
										<td colspan="3">(i) Quantity of used batteries sent by / purchased from the manufacturers-</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_qnty[manuf]" required="required" value="<?php echo $total_qnty_manuf; ?>"></td>
									</tr>
									<tr>
										<td colspan="3">(ii) Quantity of used batteries purchased from the dealers-</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_qnty[delears]" required="required" value="<?php echo $total_qnty_delears; ?>"></td>
									</tr>
									<tr>
										<td colspan="3">(iii) Quantity of used batteries purchased from auctioneers-</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_qnty[auct]" value="<?php echo $total_qnty_auct; ?>"></td>
									</tr>
									<tr>
										<td colspan="3">(iv) Quantity of used batteries obtained from any other source-</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_qnty[source]" value="<?php echo $total_qnty_source; ?>"></td>
									</tr>
									<tr>
										<td colspan="3">5. Quantity of lead recovered from the used battery scrap (in MTA)</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers"  name="qnty_recovd_scrap" value="<?php echo $qnty_recovd_scrap; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">6. Quantity of received lead sent back to</td>
									</tr>
									<tr>
										<td>(i) the manufacturer of batteries</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="qnty_recved[manuf]" value="<?php echo $qnty_recved_manuf; ?>"></td>
										<td>(ii) other agencies * -</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="qnty_recved[other_agencies]" value="<?php echo $qnty_recved_other_agencies; ?>"></td>
									</tr>
									<tr>
										<td>Place</td>
										<td><label><?php echo strtoupper($dist); ?></label></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Date</td>
										<td><label><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
										<td>Signature of the authorized person</td>
										<td><label class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
										</td>
										<td></td>
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