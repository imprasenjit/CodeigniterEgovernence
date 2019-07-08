<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="18";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form2.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();	
		$form_id=$results["form_id"];
		$serial_no=$results['serial_no'];$child=$results['child'];$department=$results['department'];$name_child=$results['name_child'];$child_serial=$results['child_serial'];$father_name=$results['father_name'];$entry_dt=$results['entry_dt'];$discharge_dt=$results['discharge_dt'];$service_year=$results['service_year'];$is_leave=$results['is_leave'];$balance=$results['balance'];$remarks=$results['remarks'];
		
		if(!empty($results["payment"])){
			$payment=json_decode($results["payment"]);			
			$payment_amount=$payment->amount;$payment_dt=$payment->dt;
		}else{
			$payment_amount="";$payment_dt="";
		}
		if(!empty($results["period"])){
			$period=json_decode($results["period"]);			
			$period_from=$period->from;$period_to=$period->to;
		}else{
			$period_from="";$period_to="";
		}
		if(!empty($results["wage"])){
			$wage=json_decode($results["wage"]);			
			$wage_earn=$wage->earn;$wage_days=$wage->days;
		}else{
			$wage_earn="";$wage_days="";
		}
		if(!empty($results["days"])){
			$days=json_decode($results["days"]);
			$days_a=$days->a;$days_b=$days->b;$days_c=$days->c;$days_d=$days->d;$days_e=$days->e;
		}else{
			$days_a="";$days_b="";$days_c="";$days_d="";$days_e="";
		}	
		if(!empty($results["credit"])){
			$credit=json_decode($results["credit"]);
			$credit_a=$credit->a;$credit_b=$credit->b;$credit_c=$credit->c;
		}else{
			$credit_a="";$credit_b="";$credit_c="";
		}	
		if(!empty($results["leaves"])){
			$leaves=json_decode($results["leaves"]);			
			$leaves_from=$leaves->from;$leaves_to=$leaves->to;
		}else{
			$leaves_from="";$leaves_to="";
		}	
		if(!empty($results["rate"])){
			$rate=json_decode($results["rate"]);
			$rate_a=$rate->a;$rate_b=$rate->b;$rate_c=$rate->c;
		}else{
			$rate_a="";$rate_b="";$rate_c="";
		}
	}else{
		$form_id="";
		$serial_no="";$father_name="";$child="";$department="";$name_child="";$child_serial="";$entry_dt="";$discharge_dt="";$service_year="";$is_leave="";$balance="";$remarks="";
		$payment_amount="";$payment_dt="";
		$period_from="";$period_to="";
		$wage_earn="";$wage_days="";
		$days_a="";$days_b="";$days_c="";$days_d="";$days_e="";
		$credit_a="";$credit_b="";$credit_c="";
		$leaves_from="";$leaves_to="";
		$rate_a="";$rate_b="";$rate_c="";		
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$serial_no=$results['serial_no'];$child=$results['child'];$department=$results['department'];$name_child=$results['name_child'];$child_serial=$results['child_serial'];$father_name=$results['father_name'];$entry_dt=$results['entry_dt'];$discharge_dt=$results['discharge_dt'];$service_year=$results['service_year'];$is_leave=$results['is_leave'];$balance=$results['balance'];$remarks=$results['remarks'];
	
	if(!empty($results["payment"])){
		$payment=json_decode($results["payment"]);			
		$payment_amount=$payment->amount;$payment_dt=$payment->dt;
	}else{
		$payment_amount="";$payment_dt="";
	}
	if(!empty($results["period"])){
		$period=json_decode($results["period"]);			
		$period_from=$period->from;$period_to=$period->to;
	}else{
		$period_from="";$period_to="";
	}
	if(!empty($results["wage"])){
		$wage=json_decode($results["wage"]);			
		$wage_earn=$wage->earn;$wage_days=$wage->days;
	}else{
		$wage_earn="";$wage_days="";
	}
	if(!empty($results["days"])){
		$days=json_decode($results["days"]);
		$days_a=$days->a;$days_b=$days->b;$days_c=$days->c;$days_d=$days->d;$days_e=$days->e;
	}else{
		$days_a="";$days_b="";$days_c="";$days_d="";$days_e="";
	}	
	if(!empty($results["credit"])){
		$credit=json_decode($results["credit"]);
		$credit_a=$credit->a;$credit_b=$credit->b;$credit_c=$credit->c;
	}else{
		$credit_a="";$credit_b="";$credit_c="";
	}	
	if(!empty($results["leaves"])){
		$leaves=json_decode($results["leaves"]);			
		$leaves_from=$leaves->from;$leaves_to=$leaves->to;
	}else{
		$leaves_from="";$leaves_to="";
	}	
	if(!empty($results["rate"])){
		$rate=json_decode($results["rate"]);
		$rate_a=$rate->a;$rate_b=$rate->b;$rate_c=$rate->c;
	}else{
		$rate_a="";$rate_b="";$rate_c="";
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">Serial No. : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="serial_no" value="<?php echo $serial_no; ?>"></td>
											<td width="25%">Adult/Child : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="child" value="<?php echo $child; ?>"></td>	
										</tr>
										<tr>
											<td>Department : </td>
											<td><input type="text" class="form-control text-uppercase" name="department" value="<?php echo $department; ?>"></td>
											<td>Name : </td>
											<td><input type="text" class="form-control text-uppercase" name="name_child" value="<?php echo $name_child; ?>"></td>
										</tr>
										<tr>
											<td>Serial No. in the Adult/Child workers : </td>
											<td><input type="text" class="form-control text-uppercase" name="child_serial" value="<?php echo $child_serial; ?>"></td>
											<td>Father's Name : </td>
											<td><input type="text" class="form-control text-uppercase" name="father_name" value="<?php echo $father_name; ?>"></td>
										</tr>
										<tr>
											<td>Date of entry into service : </td>
											<td><input type="date" class="dob form-control" name="entry_dt" value="<?php echo $entry_dt; ?>"></td>
											<td>Date of discharge : </td>
											<td><input type="date" class="dob form-control" name="discharge_dt" value="<?php echo $discharge_dt; ?>"></td>
										</tr>
										<tr>
											<td>Name of factory : </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>Date and amount of payment made in lieu of leave due : </td>
											<td><input type="date" class="dob form-control" name="payment[dt]" value="<?php echo $payment_dt; ?>" placeholder="DATE"></td>
											<td><input type="text" class="form-control text-uppercase" name="payment[amount]" value="<?php echo $payment_amount; ?>" placeholder="Amount"></td>
											<td></td>
										</tr>
										<tr>
											<td>1. Calendar year of service : </td>
											<td><input type="text" class="form-control text-uppercase" name="service_year" value="<?php echo $service_year; ?>" validate="onlyNumbers" maxlength="4"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="2">2. Wage period or periods during one month immediately preceeding leave : </td>
											<td><input type="date" class="dob form-control" name="period[from]" value="<?php echo $period_from; ?>" placeholder="FROM"></td>
											<td><input type="date" class="dob form-control" name="period[to]" value="<?php echo $period_to; ?>" placeholder="TO"></td>
										</tr>
										<tr>
											<td colspan="2">3. Wages earned during the wage period in point 2 and the number of days worked during the period : </td>
											<td><input type="text" class="form-control text-uppercase" name="wage[earn]" value="<?php echo $wage_earn; ?>" placeholder="Wages Earned"></td>
											<td><input type="text" class="form-control text-uppercase" name="wage[days]" value="<?php echo $wage_days; ?>" placeholder="No. Of days"></td>
										</tr>
										<tr>
											<td colspan="4" class="text-bold">No. of days worked during calendar year : <span class="mandatory_field"> *</span></td>
										</tr>
										<tr>
											<td>4. Number of days work perfomed : </td>
											<td><input type="text" name="days[a]" value="<?php echo $days_a; ?>" class="form-control text-uppercase days_sum" validate="onlyNumbers" required="required" ></td>
											<td>5. Number of days of layoff : </td>
											<td><input type="text" name="days[b]" value="<?php echo $days_b; ?>" class="form-control text-uppercase days_sum" validate="onlyNumbers" required="required" ></td>
										</tr>
										<tr>
											<td>6. Number of days of maternity leave : </td>
											<td><input type="text" name="days[c]" value="<?php echo $days_c; ?>" class="form-control text-uppercase days_sum" validate="onlyNumbers" required="required" ></td>
											<td>7. Number of days of leave enjoyed : </td>
											<td><input type="text" name="days[d]" value="<?php echo $days_d; ?>" class="form-control text-uppercase days_sum" validate="onlyNumbers" required="required" ></td>
										</tr>
										<tr>
											<td><strong>8. TOTAL</strong></td>
											<td><input type="text" name="days[e]" id="days_values_total" value="<?php echo $days_e; ?>" class="form-control text-uppercase" readonly="readonly"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4" class="text-bold">Leave to Credit : <span class="mandatory_field"> *</span></td>
										</tr>
										<tr>
											<td>9. Balance of leave from preceeding year : </td>
											<td><input type="text" name="credit[a]" value="<?php echo $credit_a; ?>" class="form-control text-uppercase credit_sum" validate="onlyNumbers" required="required" ></td>
											<td>10. Leave earned during the year mentioned in point 1 : </td>
											<td><input type="text" name="credit[b]" value="<?php echo $credit_b; ?>" class="form-control text-uppercase credit_sum" validate="onlyNumbers" required="required" ></td>
										</tr>
										<tr>
											<td><strong>11. TOTAL</strong></td>
											<td><input type="text" name="credit[c]" id="credit_values_total" value="<?php echo $credit_c; ?>" class="form-control text-uppercase" readonly="readonly"></td>
											<td colspan="2"></td>
										</tr>										
										<tr>
											<td colspan="2">12. Whether leave in accordance with schemes under Section 9 (8) was refused : </td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" name="is_leave" value="Y"  <?php if(isset($is_leave) && $is_leave=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" value="N"  name="is_leave" <?php if(isset($is_leave) && ($is_leave=='N' || $is_leave=='')) echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td>13. Leave enjoyed : </td>
											<td><input type="date" class="dob form-control" name="leaves[from]" value="<?php echo $leaves_from; ?>" placeholder="FROM"></td>
											<td><input type="date" class="dob form-control" name="leaves[to]" value="<?php echo $leaves_to; ?>" placeholder="TO"></td>
											<td></td>
										</tr>
										<tr>
											<td>14. Balance of leave to credit : </td>
											<td><input type="text" class="form-control text-uppercase" name="balance" value="<?php echo $balance; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>15. Normal rate of wages : </td>
											<td><input type="text" name="rate[a]" value="<?php echo $rate_a; ?>" class="form-control text-uppercase rate_sum" validate="onlyNumbers" required="required" ></td>
											<td>16. Cash equivalent of advantage accruing through concessional sale of foodgrains and other articles : </td>
											<td><input type="text" name="rate[b]" value="<?php echo $rate_b; ?>" class="form-control text-uppercase rate_sum" validate="onlyNumbers" required="required" ></td>
										</tr>
										<tr>
											<td>17. Rate of wages for the leave period : </td>
											<td><input type="text" name="rate[c]" id="rate_values_total" value="<?php echo $rate_c; ?>" class="form-control text-uppercase" readonly="readonly"></td>
											<td colspan="2"></td>
										</tr>										
										<tr>
											<td>18. Remarks : </td>
											<td><input type="text" class="form-control text-uppercase" name="remarks" value="<?php echo $remarks; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature : <strong><?php echo $key_person; ?></strong></td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save the form ?')" >Save & Next</button>
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
	/* ----------------------------------------- */	
	$('.days_sum').on('change', function(){
		var sum = 0;
		$('.days_sum').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#days_values_total').val(sum);
		});
	});
	/* ----------------------------------------- */	
	$('.credit_sum').on('change', function(){
		var sum = 0;
		$('.credit_sum').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#credit_values_total').val(sum);
		});
	});
	/* ----------------------------------------- */	
	$('.rate_sum').on('change', function(){
		var sum = 0;
		$('.rate_sum').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#rate_values_total').val(sum);
		});
	});
</script>