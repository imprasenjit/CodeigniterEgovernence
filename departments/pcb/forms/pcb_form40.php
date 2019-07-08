<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="40";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_plastic_form.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$capacity=$results["capacity"];$tecno=$results["tecno"];$quantity=$results["quantity"];$qty_sent=$results["qty_sent"];		$form_id=$results['form_id'];
		if(!empty($results["officer"])){
			$officer=json_decode($results["officer"]);
			$officer_name=$officer->name;$officer_std_no=$officer->std_no;$officer_land_no=$officer->land_no;$officer_mob_no=$officer->mob_no;$officer_email=$officer->email;
		}else{
			$officer_name="";$officer_std_no="";$officer_land_no="";$officer_mob_no="";$officer_email="";
		}
		if(!empty($results["qty_p_w"])){
			$qty_p_w=json_decode($results["qty_p_w"]);
			$qty_p_w_recycled=$qty_p_w->recycled;$qty_p_w_processed=$qty_p_w->processed;$qty_p_w_used=$qty_p_w->used;
		}else{
			$qty_p_w_recycled="";$qty_p_w_processed="";$qty_p_w_used="";
		}
		if(!empty($results["facility"])){
			$facility=json_decode($results["facility"]);
			$facility_s1=$facility->s1;$facility_s2=$facility->s2;$facility_vt=$facility->vt;$facility_d=$facility->d;$facility_pin=$facility->pin;$facility_mob_no=$facility->mob_no;$facility_ph_std=$facility->ph_std;$facility_ph_no=$facility->ph_no;
		}else{
			$facility_s1="";$facility_s2="";$facility_vt="";$facility_d="";$facility_pin="";$facility_mob_no="";$facility_ph_std="";$facility_ph_no="";$facility_email="";
		}
	}else{				
		$capacity="";$tecno="";$quantity="";$qty_sent="";
		$officer_name="";$officer_std_no="";$officer_land_no="";$officer_mob_no="";$officer_email="";
		$qty_p_w_recycled="";$qty_p_w_processed="";$qty_p_w_used="";
		$facility_s1="";$facility_s2="";$facility_vt="";$facility_d="";$facility_pin="";$facility_mob_no="";$facility_ph_std="";$facility_ph_no="";
	}
}else{		
	$results=$q->fetch_assoc();
	$capacity=$results["capacity"];$tecno=$results["tecno"];$quantity=$results["quantity"];$qty_sent=$results["qty_sent"];			
	$form_id=$results['form_id'];
	if(!empty($results["officer"])){
		$officer=json_decode($results["officer"]);
		$officer_name=$officer->name;$officer_std_no=$officer->std_no;$officer_land_no=$officer->land_no;$officer_mob_no=$officer->mob_no;$officer_email=$officer->email;
	}else{
		$officer_name="";$officer_std_no="";$officer_land_no="";$officer_mob_no="";$officer_email="";
	}
	if(!empty($results["qty_p_w"])){
		$qty_p_w=json_decode($results["qty_p_w"]);
		$qty_p_w_recycled=$qty_p_w->recycled;$qty_p_w_processed=$qty_p_w->processed;$qty_p_w_used=$qty_p_w->used;
	}else{
		$qty_p_w_recycled="";$qty_p_w_processed="";$qty_p_w_used="";
	}
	if(!empty($results["facility"])){
		$facility=json_decode($results["facility"]);
		$facility_s1=$facility->s1;$facility_s2=$facility->s2;$facility_vt=$facility->vt;$facility_d=$facility->d;$facility_pin=$facility->pin;$facility_mob_no=$facility->mob_no;$facility_ph_std=$facility->ph_std;$facility_ph_no=$facility->ph_no;
	}else{
		$facility_s1="";$facility_s2="";$facility_vt="";$facility_d="";$facility_pin="";$facility_mob_no="";$facility_ph_std="";$facility_ph_no="";$facility_email="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>	
							</div>
							<div class="panel-body">
                            <div id="table1" class="tab-pane" role="tabpanel">
                            <form name="myform1" id="myformBT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td  colspan="2">1. Name and Address of operator of the facility </td>
										<td width="25%">Name</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person;?>"></td>
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
		                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill;?>"></td>
										<td>District</td>
		                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
		                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode;?>"></td>
										<td>Mobile_no</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. Name of officer in-charge of the facility (Telephone/Mobile/ E-mail)<span class= "mandatory_field">*</span></td>
									</tr>
									<tr>
										<td>Name Officer In-charge</td>										
										<td><input type="text" class="form-control text-uppercase" name="officer[name]" required="required" value="<?php echo $officer_name;?>"></td>
										<td>Telephone Number</td>
										<td ><div class="input-group"><input type="text" style="width:60px" class="form-control text-uppercase" validate="onlyNumbers" maxlength="5" pattern="[0-9]{3,5}" name="officer[std_no]" value="<?php echo $officer_std_no;?>"/><input type="text"  class="form-control text-uppercase" maxlength="8" validate="onlyNumbers"  style="width:185px" name="officer[land_no]" value="<?php echo $officer_land_no;?>" /></div></td>			
									</tr>
									<tr>
										<td>Mobile</td>										
										<td><input type="text" class="form-control text-uppercase"  name="officer[mob_no]" required="required" maxlength="10" validate="mobileNumber"  value="<?php echo $officer_mob_no;?>"></td>
										<td>E-mail</td>
										<td ><input type="email" class="form-control"  name="officer[email]" value="<?php echo $officer_email;?>"></td>
									</tr>
									<tr>
										<td >3. Capacity</td>
										<td><input type="text" class="form-control text-uppercase" name="capacity" value="<?php echo $capacity;?>"></td>
										<td width="25%">4. Technologies used for management of plastic waste<br/></td>
										<td><input type="text" class="form-control text-uppercase" name="tecno" value="<?php echo $tecno;?>"/></td>
									</tr>
									<tr>
										<td colspan="3">5. Quantity of plastic waste received during the year being reported upon along with the source</td>
										<td><input type="text" class="form-control text-uppercase" name="quantity" validate="onlyNumbers" value="<?php echo $quantity;?>"></td>
									</tr>
									<tr>
										<td colspan="4">6. Quantity of plastic waste processed (in tons):</td>
									</tr>
									<tr>
										<td >(i) Plastic waste recycled(in tons)</td>
										<td><input type="text" class="form-control text-uppercase" name="qty_p_w[recycled]" validate="onlyNumbers" value="<?php echo $qty_p_w_recycled;?>"/></td>
										<td width="25%">(ii) Plastic waste processed (in tons)</td>
										<td><input type="text" class="form-control text-uppercase"name="qty_p_w[processed]" validate="onlyNumbers" value="<?php echo $qty_p_w_processed;?>"/></td>
									</tr>
									<tr>
										<td >(iii) Used (in tons)</td>
										<td><input type="text" class="form-control text-uppercase" name="qty_p_w[used]" validate="onlyNumbers" value="<?php echo $qty_p_w_used;?>"/></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">7. Quantity of inert or rejects sent for final disposal to landfill sites</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="qty_sent" value="<?php echo $qty_sent;?>"/></td>
									</tr>
									<tr>
										<td colspan="4">8. Details of land fill facility to which inert or rejects were sent for final disposal<span class= "mandatory_field">*</span></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" name="facility[s1]" class="form-control text-uppercase" required="required" value="<?php echo $facility_s1; ?>" /></td>
										<td>Street Name 2</td>
										<td><input type="text" name="facility[s2]" class="form-control text-uppercase"  value="<?php echo $facility_s2; ?>" /></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" name="facility[vt]"  class="form-control text-uppercase" required="required" value="<?php echo $facility_vt; ?>" /></td>
										<td>District</td>
                                        <td><input type="text" name="facility[d]"  class="form-control text-uppercase" required="required" value="<?php echo $facility_d; ?>" /></td>
										
									</tr>
									<tr>									
										<td height="29">Pincode</td>
										<td><input type="text" name="facility[pin]" maxlength="6" validate="pincode"  value="<?php echo $facility_pin; ?>" class="form-control text-uppercase" /></td>
										<td>Mobile</td>
										<td><input type="text" name="facility[mob_no]" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" required="required" value="<?php echo $facility_mob_no; ?>" /></td>
									</tr>
									<tr>
										<td>Phone Number</td>
										<td ><div class="input-group"><input type="text" name="facility[ph_std]" style="width:60px" class="form-control text-uppercase" maxlength="5" pattern="[0-9]{3,5}" validate="onlyNumbers" value="<?php echo $facility_ph_std; ?>" /><input type="text" name="facility[ph_no]" class="form-control text-uppercase" validate="onlyNumbers" maxlength="8" style="width:185px" value="<?php echo $facility_ph_no; ?>" /></div></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2" >9. Attach status of compliance to environmental conditions, if any specified during grant of Consent or registration<span class= "mandatory_field">*</span></td>
										<td colspan="2">Upload later in upload section</td>
									</tr>
									<tr>
										<td>Date</td>
										<td><label><?php echo date('d-m-Y',strtotime($today)); ?></label></td><td align="right">Signature of the Operator</td>
										<td align="right"><label class="text-uppercase"><?php echo strtoupper($key_person); ?></label></td>
									</tr>
									<tr>
										<td>Place</td>
										<td><label><?php echo strtoupper($dist); ?></label></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
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
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>