<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="25";
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
		$facility_loc=$results["facility_loc"];$import_reason=$results["import_reason"];$details_of_import=$results["details_of_import"];$port_of_entry=$results["port_of_entry"];	
		if(!empty($results["imp_outside_address"])){
			$imp_outside_address=json_decode($results["imp_outside_address"]);
			$imp_outside_address_name=$imp_outside_address->name;$imp_outside_address_st1=$imp_outside_address->st1;$imp_outside_address_st2=$imp_outside_address->st2;$imp_outside_address_vt=$imp_outside_address->vt;$imp_outside_address_dist=$imp_outside_address->dist;$imp_outside_address_pin=$imp_outside_address->pin;$imp_outside_address_mob=$imp_outside_address->mob;$imp_outside_address_email=$imp_outside_address->email;
		}else{
			$imp_outside_address_name="";$imp_outside_address_st1="";$imp_outside_address_st2="";$imp_outside_address_vt="";
			$imp_outside_address_dist="";$imp_outside_address_pin="";$imp_outside_address_mob="";$imp_outside_address_email="";
		}
		if(!empty($results["waste_detail"])){
			$waste_detail=json_decode($results["waste_detail"]);
			$waste_detail_qty=$waste_detail->qty;$waste_detail_basel=$waste_detail->basel;$waste_detail_movement=$waste_detail->movement;$waste_detail_char=$waste_detail->char;$waste_detail_special=$waste_detail->special;				
		}else{
			$waste_detail_qty="";$waste_detail_basel="";$waste_detail_movement="";$waste_detail_char="";$waste_detail_special="";
		}
		if(!empty($results["importer"])){
			$importer=json_decode($results["importer"]);
			$importer_process_detail=$importer->process_detail;$importer_capacity=$importer->capacity;
		}else{
			$importer_process_detail="";$importer_capacity="";
		}
	}else{	 
		$form_id="";
		$facility_loc="";$import_reason="";$details_of_import="";$port_of_entry="";
		$imp_outside_address_name="";$imp_outside_address_st1="";$imp_outside_address_st2="";$imp_outside_address_vt="";
		$imp_outside_address_dist="";$imp_outside_address_pin="";$imp_outside_address_mob="";$imp_outside_address_email="";
		$waste_detail_qty="";$waste_detail_basel="";$waste_detail_movement="";$waste_detail_char="";$waste_detail_special="";
		$importer_process_detail="";$importer_capacity="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];	
	$facility_loc=$results["facility_loc"];$import_reason=$results["import_reason"];$details_of_import=$results["details_of_import"];$port_of_entry=$results["port_of_entry"];	
	if(!empty($results["imp_outside_address"])){
		$imp_outside_address=json_decode($results["imp_outside_address"]);
		$imp_outside_address_name=$imp_outside_address->name;$imp_outside_address_st1=$imp_outside_address->st1;$imp_outside_address_st2=$imp_outside_address->st2;$imp_outside_address_vt=$imp_outside_address->vt;$imp_outside_address_dist=$imp_outside_address->dist;$imp_outside_address_pin=$imp_outside_address->pin;$imp_outside_address_mob=$imp_outside_address->mob;$imp_outside_address_email=$imp_outside_address->email;
	}else{
		$imp_outside_address_name="";$imp_outside_address_st1="";$imp_outside_address_st2="";$imp_outside_address_vt="";
		$imp_outside_address_dist="";$imp_outside_address_pin="";$imp_outside_address_mob="";$imp_outside_address_email="";
	}
	if(!empty($results["waste_detail"])){
		$waste_detail=json_decode($results["waste_detail"]);
		$waste_detail_qty=$waste_detail->qty;$waste_detail_basel=$waste_detail->basel;$waste_detail_movement=$waste_detail->movement;$waste_detail_char=$waste_detail->char;$waste_detail_special=$waste_detail->special;				
	}else{
		$waste_detail_qty="";$waste_detail_basel="";$waste_detail_movement="";$waste_detail_char="";$waste_detail_special="";
	}
	if(!empty($results["importer"])){
		$importer=json_decode($results["importer"]);
		$importer_process_detail=$importer->process_detail;$importer_capacity=$importer->capacity;
	}else{
		$importer_process_detail="";$importer_capacity="";
	}
}
	
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		
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
									<li class="<?php echo $tabbtn2; ?>"><a href="#table3">UNDERTAKING</a></li>	
								</ul>
								<br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">1. Importer or Exporter (name and address) in India:</td>
										</tr>
										<tr>
											 <td width="25%">Name :</td>
											 <td width="25%"><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
											 <td width="25%">Street Name 1 :</td>
											 <td width="25%"><input type="text"  disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Street Name 2 :</td>
											<td><input type="text"  disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
											<td>Village/Town :</td>
											<td><input type="text"  disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>District :</td>
											<td><input type="text" disabled  value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
											<td>Pincode :</td>
											<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td>Mobile No :</td>
											<td><input type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control text-uppercase"></td>
											<td>Phone No :</td>
											<td><input type="text" disabled value="<?php echo $b_landline_std.'-'.$b_landline_no; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Email Id :</td>
											<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control"></td>
											<td>Contact Person :</td>
											<td><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>									
										</tr>
										<tr>
											<td>Facility location/address :</td>
											<td><input type="text"  name="facility_loc" value="<?php echo $facility_loc; ?>" class="form-control text-uppercase"></td>
											<td>Reason for import or export :</td>
											<td><textarea name="import_reason" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $import_reason; ?></textarea>255 Characters Only</td>
										</tr>
										<tr>
											<td colspan="4">2. Importer or exporter (name and address)outside of India :</td>	
										</tr>
										<tr>
											 <td width="25%">Name :</td>
											 <td width="25%"><input type="text" name="imp_outside_address[name]" value="<?php echo $imp_outside_address_name; ?>" class="form-control text-uppercase"></td>
											 <td width="25%">Street Name 1 :</td>
											 <td width="25%"><input type="text" name="imp_outside_address[st1]" value="<?php echo $imp_outside_address_st1; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Street Name 2 :</td>
											<td><input type="text" name="imp_outside_address[st2]" value="<?php echo $imp_outside_address_st2; ?>" class="form-control text-uppercase"></td>
											<td>Village/Town :</td>
											<td><input type="text" name="imp_outside_address[vt]" value="<?php echo $imp_outside_address_vt; ?>"class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>District :</td>
                                            <td>
                                                <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($imp_outside_address_dist);?>"   name="imp_outside_address[dist]">    
                                                </td>
											
											<td>Pincode :</td>
											<td><input type="text" name="imp_outside_address[pin]" maxlength="6" value="<?php echo $imp_outside_address_pin; ?>" class="form-control" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td>Mobile No :</td>
											<td><input type="text" name="imp_outside_address[mob]" validate="mobileNumber" maxlength="10" value="<?php echo $imp_outside_address_mob; ?>" class="form-control text-uppercase"></td>
											<td>Email Id :</td>
											<td><input type="email" name="imp_outside_address[email]" value="<?php echo $imp_outside_address_email; ?>" class="form-control "></td>
										</tr>
										<tr>
											<td colspan="4">3. Details of waste to be imported or exported :</td>
										</tr>
										<tr>								
											<td>(a) Quantity :</td>
											<td><input type="text" name="waste_detail[qty]" value="<?php echo $waste_detail_qty; ?>" class="form-control text-uppercase"></td>
											<td>(b) Basel No. :</td>
											<td><input type="text" name="waste_detail[basel]" value="<?php echo $waste_detail_basel; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>								
											<td>(c) Single/multiple movement :</td>
											<td><input type="text" name="waste_detail[movement]" value="<?php echo $waste_detail_movement; ?>" class="form-control text-uppercase"></td>
											<td>(d) Chemical composition of waste , where applicable :</td>
											<td>Upload later in Upload section</td>
										</tr>
										<tr>								
											<td>(e) Physical characteristics :</td>
											<td><input type="text" name="waste_detail[char]" value="<?php echo $waste_detail_char; ?>" class="form-control text-uppercase"></td>
											<td>(f) Special handling requirements, if applicable :</td>
											<td><input type="text" name="waste_detail[special]" value="<?php echo $waste_detail_special; ?>" class="form-control text-uppercase "></td>
										</tr>
										<tr>								
											<td>4. For Schedule III A hazardous waste whether Prior Informed Consent has been obtained :</td>
											<td>Upload Later in Upload Section</td>
											<td></td>
											<td></td>								
										</tr>
										<tr>								
											<td colspan="4">5. For importer :</td>							
										</tr>
										<tr>								
											<td>(a) Process details along with environmental safeguard measures :</td>
											<td><textarea name="importer[process_detail]" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $importer_process_detail; ?></textarea>255 Characters Only</td>
											<td>(b) Capacity of recycling or co-processing or recovery or utilization :</td>
											<td><input type="text" name="importer[capacity]" value="<?php echo $importer_capacity; ?>" class="form-control text-uppercase"></td>								
										</tr>
										<tr>								
											<td>6. Details of import against the Ministry of Environment, Forest and Climate Change permission in the previous three years :</td>
											<td><textarea name="details_of_import" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $details_of_import; ?></textarea>255 Character Only</td>
											<td>7. Port of entry :</td>
											<td><input type="text" name="port_of_entry" value="<?php echo $port_of_entry; ?>" class="form-control text-uppercase"></td>								
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
											 <td colspan="4" align="center"><u><b>UNDERTAKING</b></u></td>
										</tr>
										<tr>
											<td colspan="4">
												I hereby solemnly undertake that :
												<ul type="(i)">
													<li>The information is complete and correct to the best of my knowledge and legally-enforceable written contractual obligations have been entered into and that my applicable insurance or other financial guarantees are or shall be in force covering the transboundary movement.</li>
													<li>The waste permitted shall be fully insured for transit as well as for any accidental occurrence and its clean-up operation.</li>
													<li>The record of consumption and fate of the imported waste shall be recorded and report sent to the SPCB every quarter.</li>
													<li>The hazardous or other waste which gets generated in our premises by the use of imported hazardous or other wastes in the form of raw material shall be treated and disposed of as per conditions of authorisation.</li>
													<li>I agree to bear the cost of export and mitigation of damages if any.</li>
													<li>I am aware that there are significant penalties for submitting a false certificate/ undertaking/ disobedience of the rules and lawful orders including the possibility of fine and imprisonment.</li>
													<li>The exported wastes shall be taken back, if it is not acceptable to the importer.</li>												
												</ul>											
											 </td>
										</tr>
										<tr>
											<td colspan="4" class="text-center"><input type="checkbox" name="" required>  I Agree</td>
										</tr>
										<tr>
											<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today)); ?></label><br/>
												Place: <label><?php echo strtoupper($dist)?></label>
											</td>
											<td colspan="2" align="right">
											<label><?php echo strtoupper($key_person)?><br/>
											Signature of the Occupier or <br/>Operator of the disposal facility</label> </td>
										</tr>							
										<tr>
											<td class="text-center" colspan="4">
												<a href="<?php echo $table_name; ?>.php?tab=1"type="submit" class="btn btn-primary">Go Back & Edit</a>											
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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