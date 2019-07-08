<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="24";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_hw_form.php";

		
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();	
		$form_id=$results['form_id'];	
		$production =$results["production"];$is_generator =$results["is_generator"];$total_waste =$results["total_waste"];$disposal =$results["disposal"];$recycler =$results["recycler"];$others =$results["others"];$utilised =$results["utilised"];$storage =$results["storage"];$is_operator =$results["is_operator"];$total_quantity =$results["total_quantity"];$Stock_quantity =$results["Stock_quantity"];$quantity_treated =$results["quantity_treated"];$quantity_disposed =$results["quantity_disposed"];$incinerated_q =$results["incinerated_q"];$processed_q =$results["processed_q"];$storage_q =$results["storage_q"];$is_recycler =$results["is_recycler"];$dom_src =$results["dom_src"];$imported =$results["imported"];$stock_q_begin =$results["stock_q_begin"];$recycled_q =$results["recycled_q"];$dispatched_q =$results["dispatched_q"];$waste_q_gen =$results["waste_q_gen"];$disposed_q =$results["disposed_q"];$re_exported_q =$results["re_exported_q"];$storage_q_recyle =$results["storage_q_recyle"];
		
		if(!empty($results["ren_auth"])){
			$ren_auth=json_decode($results["ren_auth"]);
			$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
		}else{
			$ren_auth_no="";$ren_auth_dt="";
		}
	}else{	 
		$form_id="";$production="";$is_generator="";$total_waste="";$disposal="";$recycler="";$others="";$utilised="";$storage="";$is_operator="";$total_quantity="";$Stock_quantity="";$quantity_treated="";$quantity_disposed="";$incinerated_q="";$processed_q="";$storage_q="";$is_recycler="";$dom_src="";$imported="";$stock_q_begin="";$recycled_q="";$dispatched_q="";$waste_q_gen="";$disposed_q="";$re_exported_q="";$storage_q_recyle="";
		$ren_auth_no="";$ren_auth_dt="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];	
	$production =$results["production"];$is_generator =$results["is_generator"];$total_waste =$results["total_waste"];$disposal =$results["disposal"];$recycler =$results["recycler"];$others =$results["others"];$utilised =$results["utilised"];$storage =$results["storage"];$is_operator =$results["is_operator"];$total_quantity =$results["total_quantity"];$Stock_quantity =$results["Stock_quantity"];$quantity_treated =$results["quantity_treated"];$quantity_disposed =$results["quantity_disposed"];$incinerated_q =$results["incinerated_q"];$processed_q =$results["processed_q"];$storage_q =$results["storage_q"];$is_recycler =$results["is_recycler"];$dom_src =$results["dom_src"];$imported =$results["imported"];$stock_q_begin =$results["stock_q_begin"];$recycled_q =$results["recycled_q"];$dispatched_q =$results["dispatched_q"];$waste_q_gen =$results["waste_q_gen"];$disposed_q =$results["disposed_q"];$re_exported_q =$results["re_exported_q"];$storage_q_recyle =$results["storage_q_recyle"];
	
	if(!empty($results["ren_auth"])){
		$ren_auth=json_decode($results["ren_auth"]);
		$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
	}else{
		$ren_auth_no="";$ren_auth_dt="";
	}
}
	
	
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
		
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
		
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
		
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
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>	
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>	
									<li class="<?php echo $tabbtn4; ?>"><a href="#table4">PART IV</a></li>	
								</ul>
								<br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">1. Name and address of facility:</td>
										</tr>
										<tr>
											 <td width="25%">Name :</td>
											 <td width="25%"><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
											 <td width="25%">Street Name 1:</td>
											 <td width="25%"><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Street Name 2:</td>
											<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
											<td>Village/Town:</td>
											<td><input type="text" disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>District:</td>
											<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
											<td>Pincode:</td>
											<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td>Mobile No:</td>
											<td><input type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control text-uppercase"></td>
											<td>Phone No:</td>
											<td><input type="text" disabled value="<?php echo $b_landline_std.'-'.$b_landline_no; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">2. Authorisation No. and Date of issue:</td>
										</tr>
										<tr>
											<td>Authorization No:</td>
											<td><input type="text" name="ren_auth[no]" placeholder="AUTHORIZATION NO" value="<?php echo $ren_auth_no; ?>" class="form-control text-uppercase"></td>
											<td>Date of issue:</td>
											<td><input type="datetime"  name="ren_auth[dt]" value="<?php echo $ren_auth_dt; ?>" class="dob form-control" placeholder="DD/MM/YYYY"></td>									
										</tr>
										<tr>
											<td colspan="4">3. Name of the authorised person and full address with telephone, fax number and e-mail:</td>	
										</tr>
										<tr>
											 <td width="25%">Name :</td>
											 <td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
											 <td width="25%">Street Name 1:</td>
											 <td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Street Name 2:</td>
											<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
											<td>Village/Town:</td>
											<td><input type="text" disabled value="<?php echo $vill; ?>"class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>District:</td>
											<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
											<td>Pincode:</td>
											<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td>Mobile No:</td>
											<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control text-uppercase"></td>
											<td>Phone No:</td>
											<td><input type="text" disabled value="<?php echo $landline_std.'-'.$landline_no; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control "></td>
											<td></td>
											<td></td>
										</tr>
										<tr>								
											<td colspan="3">4. Production during the year (product wise), wherever applicable</td>
											<td><textarea name="production"  id="production" class="form-control text-uppercase" validate="textarea"  maxlength="255"><?php echo $production; ?></textarea>255 Characters only</td>
											<td></td>
											<td></td>									
										</tr>
										<tr>										
											<td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
											</td>										
										</tr>
									</table>
									</form>
									</div>
									<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											 <td colspan="4"><p><h4 class="text-center" ><strong>Part A. To be filled by hazardous waste generators</strong></h4></p></td>
										</tr>
										<tr>
											<td colspan="2">Are You a Generator of Hazardous Waste?</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" name="is_generator" value="Y"  <?php if(isset($is_generator) && $is_generator=='Y') echo 'checked'; ?> required="required" /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_generator"  value="N"  <?php if(isset($is_generator) && $is_generator=='N') echo 'checked'; ?>/> No</label></td>
										</tr>
									</table>
									<table id="is_generator_yes" class="table table-responsive">
										<tr>								
											<td width="25%">1. Total quantity of waste generated category wise</td>
											<td width="25%"><textarea name="total_waste"  id="total_waste" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $total_waste; ?></textarea>255 Characters only</td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											 <td colspan="4">2. Quantity dispatched</td>
										</tr>
										<tr>								
											<td>(i) To disposal facility</td>
											<td><input type="text" name="disposal" value="<?php echo $disposal; ?>" class="form-control text-uppercase"></td>
											<td>(ii) To recycler or co-processors or pre-processor</td>
											<td><input type="text" name="recycler" value="<?php echo $recycler; ?>" class="form-control text-uppercase "></td>								
										</tr>
										<tr>								
											<td>(iii) Others</td>
											<td><input type="text" name="others" value="<?php echo $others; ?>" class="form-control text-uppercase "></td>
											<td></td>
											<td></td>								
										</tr>
										<tr>								
											<td>3. Quantity utilised in-house, if any :</td>
											<td><input type="text" name="utilised" value="<?php echo $utilised; ?>" class="form-control text-uppercase"></td>
											<td>4. Quantity in storage at the end of the year :</td>
											<td><input type="text" name="storage" value="<?php echo $storage; ?>" class="form-control text-uppercase"></td>								
										</tr>
									</table>	
									<table id="" class="table table-responsive">
										<tr>										
											<td class="text-center" colspan="4">
												<a href="<?php echo $table_name; ?>.php?tab=1" type="submit" class="btn btn-primary">Go Back & Edit</a>
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
											</td>
											
										</tr>
									</table>
									</form>
									</div>
								 <div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">								
										<tr>
											 <td colspan="4"><h4 class="text-center" ><strong>Part B. To be filled by Treatment, storage and disposal facility operators</strong></h4></td>
										</tr>
										<tr>
											<td colspan="2">Are you a Treatment, storage and disposal facility operators?</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" required name="is_operator" value="Y"  <?php if(isset($is_operator) && $is_operator=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" required name="is_operator"  value="N"  <?php if(isset($is_operator) && $is_operator=='N') echo 'checked'; ?>/> No</label></td>
										</tr>
									</table>
									<table id="is_operator_yes" class="table table-responsive">
										<tr>
											<td width="25%">9. Total quantity received:</td>
											<td width="25%"><input type="text" name="total_quantity" value="<?php echo $total_quantity; ?>" class="form-control text-uppercase"></td>
											<td width="25%">10. Quantity in stock at the beginning of the year:</td>
											<td width="25%"><input type="text" name="Stock_quantity" value="<?php echo $Stock_quantity; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>11. Quantity treated:</td>
											<td><input type="text" name="quantity_treated"  value="<?php echo $quantity_treated; ?>"class="form-control text-uppercase"></td>
											<td>12. Quantity disposed in landfills as such and after treatment:</td>
											<td width="25%"><input type="text" name="quantity_disposed" value="<?php echo $quantity_disposed; ?>" class="form-control text-uppercase"></td>
										</tr>
										
										<tr>
										   <td>13. Quantity incinerated (if applicable):</td>
										   <td><input type="text" name="incinerated_q" value="<?php echo $incinerated_q; ?>" class="form-control text-uppercase"></td>
										   <td>14. Quantity processed other than specified above:</td>
										   <td><input type="text" name="processed_q" value="<?php echo $processed_q; ?>" class="form-control text-uppercase"></td>									   
										</tr>
										<tr>
											<td>15. Quantity in storage at the end of the year </td>
											<td><input type="text" name="storage_q" value="<?php echo $storage_q; ?>" class="form-control text-uppercase"></td>
											<td></td>
											<td></td>
										</tr>
									</table>
									<table id="" class="table table-responsive">
										<tr>										
											<td class="text-center" colspan="4">
												<a href="<?php echo $table_name; ?>.php?tab=2" type="submit" class="btn btn-primary">Go Back & Edit</a>
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
											</td>										
										</tr>
									</table>
									</form>
									</div>
									<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											 <td colspan="4"><p><h4 class="text-center" ><strong>Part C. To be filled by recyclers or co-processors or other users</strong></h4></p></td>
										</tr>
										<tr>
											<td colspan="2">Are you a recyclers or pre-processors or co-processors or users of hazardous or other wastes?</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" required name="is_recycler" value="Y"  <?php if(isset($is_recycler) && $is_recycler=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" required name="is_recycler"  value="N"  <?php if(isset($is_recycler) && $is_recycler=='N') echo 'checked'; ?>/> No</label></td>
										</tr>
									</table>
									<table id="is_recycler_yes" class="table table-responsive">									
										<tr>
											<td colspan="4">16. Quantity of waste received during the year : </td>		
										</tr>									
										<tr>
											<td width="25%">(i) Domestic sources </td>
											<td width="25%"><input type="text" name="dom_src" value="<?php echo $dom_src; ?>" class="form-control text-uppercase"></td>
											<td width="25%">(ii) Imported (if applicable) </td>
											<td width="25%"><input type="text" name="imported" value="<?php echo $imported; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>17. Quantity in stock at the beginning of the year:</td>
											<td><input type="text" name="stock_q_begin" value="<?php echo $stock_q_begin; ?>" class="form-control text-uppercase"></td>
											<td>18. Quantity recycled or co-processed or used:</td>
											<td><input type="text" name="recycled_q" value="<?php echo $recycled_q; ?>" class="form-control text-uppercase"></td>
																				
										</tr>
										<tr>
											<td>19. Quantity of products dispatched (wherever applicable):</td>
											<td><input type="text" name="dispatched_q" value="<?php echo $dispatched_q; ?>" class="form-control text-uppercase"></td>
											<td>20. Quantity of waste generated</td>
											<td><input type="text" name="waste_q_gen" value="<?php echo $waste_q_gen; ?>" class="form-control text-uppercase"></td>
																				
										</tr>
										<tr>
											<td>21. Quantity of waste disposed : </td>
											<td><input type="text" name="disposed_q" value="<?php echo $disposed_q; ?>" class="form-control text-uppercase"></td>
											<td>22. Quantity re-exported (wherever applicable):</td>
											<td><input type="text" name="re_exported_q" value="<?php echo $re_exported_q; ?>" class="form-control text-uppercase"></td>
																				
										</tr>
										<tr>
											<td>23. Quantity in storage at the end of the year:</td>
											<td><input type="text" name="storage_q_recyle" value="<?php echo $storage_q_recyle; ?>" class="form-control text-uppercase"></td>
											<td></td>
											<td></td>											
										</tr>
									</table>
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today)); ?></label><br/>
															Place: <label><?php echo strtoupper($dist)?></label>
											</td>
											<td colspan="2" align="right"><label><?php echo strtoupper($key_person)?></label><br/>
											Signature of the Occupier or <br/>Operator of the disposal facility </td>
																						
										</tr>						
										<tr>
											<td class="text-center" colspan="4">
												<a href="<?php echo $table_name; ?>.php?tab=3" type="submit" class="btn btn-primary">Go Back & Edit</a>											
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>d" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">Save and Next</button>
											</td>										
										</tr>
									</table>
									</form>
									</div>
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
	$('#is_generator_yes').css('display','table');	 
	<?php if($is_generator == 'N' || $is_generator == '') echo "$('#is_generator_yes').css('display','none');"; ?>
	
	$('input[name="is_generator"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_generator_yes').css('display','table');			
		}else{
			$('#is_generator_yes').css('display','none');			
		}
	});
	$('#is_operator_yes').css('display','table');	 
	<?php if($is_operator == 'N' || $is_operator == '') echo "$('#is_operator_yes').css('display','none');"; ?>
	
	$('input[name="is_operator"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_operator_yes').css('display','table');			
		}else{
			$('#is_operator_yes').css('display','none');			
		}
	});
	$('#is_recycler_yes').css('display','table');	 
	<?php if($is_recycler == 'N' || $is_recycler == '') echo "$('#is_recycler_yes').css('display','none');"; ?>
	
	$('input[name="is_recycler"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_recycler_yes').css('display','table');			
		}else{
			$('#is_recycler_yes').css('display','none');			
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