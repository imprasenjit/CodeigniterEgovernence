<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="4";
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
		$form_id=$results['form_id'];$used_bat=$results['used_bat'];
		$submitted_by=$results['submitted_by'];
		$submitted_by_array=Array();
		$submitted_by_array=explode(",", $submitted_by);
		if(in_array("M",$submitted_by_array)) $submitted_by_a="M";
		if(in_array("A",$submitted_by_array)) $submitted_by_b="A";
		if(in_array("R",$submitted_by_array)) $submitted_by_c="R";
			
		if(!empty($results["total_no_batteries"])){			
			$total_no_batteries=json_decode($results["total_no_batteries"]);
			$total_no_batteries_auto=$total_no_batteries->auto;$total_no_batteries_ind=$total_no_batteries->ind;$total_no_batteries_sold=$total_no_batteries->sold;
			$total_no_batteries_auto_fw1=$total_no_batteries_auto->fw1;$total_no_batteries_auto_fw2=$total_no_batteries_auto->fw2;
			$total_no_batteries_auto_tw1=$total_no_batteries_auto->tw1;$total_no_batteries_auto_tw2=$total_no_batteries_auto->tw2;
			$total_no_batteries_ind_ups1=$total_no_batteries_ind->ups1;$total_no_batteries_ind_ups2=$total_no_batteries_ind->ups2;
			$total_no_batteries_ind_mp1=$total_no_batteries_ind->mp1;$total_no_batteries_ind_mp2=$total_no_batteries_ind->mp2;
			$total_no_batteries_ind_sb1=$total_no_batteries_ind->sb1;$total_no_batteries_ind_sb2=$total_no_batteries_ind->sb2;
			$total_no_batteries_ind_ot1=$total_no_batteries_ind->ot1;$total_no_batteries_ind_ot2=$total_no_batteries_ind->ot2;
			$total_no_batteries_sold_d1=$total_no_batteries_sold->d1;$total_no_batteries_sold_d2=$total_no_batteries_sold->d2;
			$total_no_batteries_sold_bc1=$total_no_batteries_sold->bc1;$total_no_batteries_sold_bc2=$total_no_batteries_sold->bc2;
			$total_no_batteries_sold_oem1=$total_no_batteries_sold->oem1;$total_no_batteries_sold_oem2=$total_no_batteries_sold->oem2;
			$total_no_batteries_sold_any1=$total_no_batteries_sold->any1;$total_no_batteries_sold_any2=$total_no_batteries_sold->any2;
		}else{
			$total_no_batteries_auto_fw1="";$total_no_batteries_auto_fw2="";$total_no_batteries_auto_tw1="";$total_no_batteries_auto_tw2="";$total_no_batteries_ind_ups1="";$total_no_batteries_ind_ups2="";$total_no_batteries_ind_mp1="";$total_no_batteries_ind_mp2="";$total_no_batteries_ind_sb1="";$total_no_batteries_ind_sb2="";$total_no_batteries_ind_ot1="";$total_no_batteries_ind_ot2="";$total_no_batteries_sold_d1="";$total_no_batteries_sold_d2="";$total_no_batteries_sold_bc1="";$total_no_batteries_sold_bc2="";$total_no_batteries_sold_oem1="";$total_no_batteries_sold_oem2="";$total_no_batteries_sold_any1="";$total_no_batteries_sold_any2="";
		}			
		if(!empty($results["collection_center"])){
			$collection_center=json_decode($results["collection_center"]);
			$collection_center_name=$collection_center->name;$collection_center_s1=$collection_center->s1;$collection_center_s2=$collection_center->s2;$collection_center_vt=$collection_center->vt;$collection_center_d=$collection_center->d;$collection_center_pin=$collection_center->pin;$collection_center_mob_no=$collection_center->mob_no;$collection_center_ph_std=$collection_center->ph_std;$collection_center_ph_no=$collection_center->ph_no;
		}else{
			$collection_center_name="";$collection_center_s1="";$collection_center_s2="";$collection_center_vt="";$collection_center_d="";$collection_center_pin="";$collection_center_mob_no="";$collection_center_ph_std="";$collection_center_ph_no="";
		}
	}else{
        $form_id="";		
		$used_bat="";$total_no_batteries_auto_fw1="";$total_no_batteries_auto_fw2="";$total_no_batteries_auto_tw1="";$total_no_batteries_auto_tw2="";$total_no_batteries_ind_ups1="";$total_no_batteries_ind_ups2="";$total_no_batteries_ind_mp1="";$total_no_batteries_ind_mp2="";$total_no_batteries_ind_sb1="";$total_no_batteries_ind_sb2="";$total_no_batteries_ind_ot1="";$total_no_batteries_ind_ot2="";$total_no_batteries_sold_d1="";$total_no_batteries_sold_d2="";$total_no_batteries_sold_bc1="";$total_no_batteries_sold_bc2="";$total_no_batteries_sold_oem1="";$total_no_batteries_sold_oem2="";$total_no_batteries_sold_any1="";$total_no_batteries_sold_any2="";
		$collection_center_name="";$collection_center_s1="";$collection_center_s2="";$collection_center_vt="";$collection_center_d="";$collection_center_pin="";$collection_center_mob_no="";$collection_center_ph_std="";$collection_center_ph_no="";
	}		
}else{	
	$results=$q->fetch_assoc();		
	$form_id=$results['form_id'];$used_bat=$results['used_bat'];
	$submitted_by=$results['submitted_by'];
	$submitted_by_array=Array();
	$submitted_by_array=explode(",", $submitted_by);
	if(in_array("M",$submitted_by_array)) $submitted_by_a="M";
	if(in_array("A",$submitted_by_array)) $submitted_by_b="A";
	if(in_array("R",$submitted_by_array)) $submitted_by_c="R";
		
	if(!empty($results["total_no_batteries"])){			
		$total_no_batteries=json_decode($results["total_no_batteries"]);
		$total_no_batteries_auto=$total_no_batteries->auto;$total_no_batteries_ind=$total_no_batteries->ind;$total_no_batteries_sold=$total_no_batteries->sold;
		$total_no_batteries_auto_fw1=$total_no_batteries_auto->fw1;$total_no_batteries_auto_fw2=$total_no_batteries_auto->fw2;
		$total_no_batteries_auto_tw1=$total_no_batteries_auto->tw1;$total_no_batteries_auto_tw2=$total_no_batteries_auto->tw2;
		$total_no_batteries_ind_ups1=$total_no_batteries_ind->ups1;$total_no_batteries_ind_ups2=$total_no_batteries_ind->ups2;
		$total_no_batteries_ind_mp1=$total_no_batteries_ind->mp1;$total_no_batteries_ind_mp2=$total_no_batteries_ind->mp2;
		$total_no_batteries_ind_sb1=$total_no_batteries_ind->sb1;$total_no_batteries_ind_sb2=$total_no_batteries_ind->sb2;
		$total_no_batteries_ind_ot1=$total_no_batteries_ind->ot1;$total_no_batteries_ind_ot2=$total_no_batteries_ind->ot2;
		$total_no_batteries_sold_d1=$total_no_batteries_sold->d1;$total_no_batteries_sold_d2=$total_no_batteries_sold->d2;
		$total_no_batteries_sold_bc1=$total_no_batteries_sold->bc1;$total_no_batteries_sold_bc2=$total_no_batteries_sold->bc2;
		$total_no_batteries_sold_oem1=$total_no_batteries_sold->oem1;$total_no_batteries_sold_oem2=$total_no_batteries_sold->oem2;
		$total_no_batteries_sold_any1=$total_no_batteries_sold->any1;$total_no_batteries_sold_any2=$total_no_batteries_sold->any2;
	}else{
		$total_no_batteries_auto_fw1="";$total_no_batteries_auto_fw2="";$total_no_batteries_auto_tw1="";$total_no_batteries_auto_tw2="";$total_no_batteries_ind_ups1="";$total_no_batteries_ind_ups2="";$total_no_batteries_ind_mp1="";$total_no_batteries_ind_mp2="";$total_no_batteries_ind_sb1="";$total_no_batteries_ind_sb2="";$total_no_batteries_ind_ot1="";$total_no_batteries_ind_ot2="";$total_no_batteries_sold_d1="";$total_no_batteries_sold_d2="";$total_no_batteries_sold_bc1="";$total_no_batteries_sold_bc2="";$total_no_batteries_sold_oem1="";$total_no_batteries_sold_oem2="";$total_no_batteries_sold_any1="";$total_no_batteries_sold_any2="";
	}			
	if(!empty($results["collection_center"])){
		$collection_center=json_decode($results["collection_center"]);
		$collection_center_name=$collection_center->name;$collection_center_s1=$collection_center->s1;$collection_center_s2=$collection_center->s2;$collection_center_vt=$collection_center->vt;$collection_center_d=$collection_center->d;$collection_center_pin=$collection_center->pin;$collection_center_mob_no=$collection_center->mob_no;$collection_center_ph_std=$collection_center->ph_std;$collection_center_ph_no=$collection_center->ph_no;
	}else{
		$collection_center_name="";$collection_center_s1="";$collection_center_s2="";$collection_center_vt="";$collection_center_d="";$collection_center_pin="";$collection_center_mob_no="";$collection_center_ph_std="";$collection_center_ph_no="";
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
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">								
							   <div id="table1" class="tab-pane" role="tabpanel">
                            <form name="myform1" id="myformBT1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="20%">1. Name and address of the </td>
										<td width="20%"> <label class="radio-inline"><input type="checkbox" name="submitted_by[]"  <?php if(isset($submitted_by_a) && $submitted_by_a=='M') echo 'checked'; ?>  value="M" > Manufacturer </label></td>
										<td width="20%"><label class="radio-inline"><input type="checkbox" <?php if(isset($submitted_by_b) && $submitted_by_b=='A') echo 'checked'; ?> value="A" id="" name="submitted_by[]"> Assembler </label></td>
										<td width="20%"><label class="radio-inline"><input type="checkbox" <?php if(isset($submitted_by_c) && $submitted_by_c=='R') echo 'checked'; ?> value="R" id="" name="submitted_by[]"> Reconditioner </label></td>
									</tr>
									<tr>
										<td>Name</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name;?>"></td>
										<td></td>
										<td></td>
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
		                             <td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. Name of the authorized person and complete address with telephone </td>
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
										<td colspan="4">3. Total number of new batteries sold during the period October-March/ April-September in respect of the following category :</td>
									</tr>
									<tr>
										<td>Category:</td>
										<td></td>
										<td>(i) No. of Batteries</td>
										<td>(ii)Approximate weight (in Metric Tones)</td>
									</tr>
									<tr>
										<td>(i) Automotive</td>
										<td colspan="3"></td>
									</tr>
									<tr>
										<td></td>
										<td>(a) four wheeler</td>
										<td><input type="text" class="form-control text-uppercase " validate="onlyNumbers" name="total_no_batteries[auto][fw1]" value="<?php echo $total_no_batteries_auto_fw1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[auto][fw2]" value="<?php echo $total_no_batteries_auto_fw2; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>(b) two wheeler</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers"  name="total_no_batteries[auto][tw1]" value="<?php echo $total_no_batteries_auto_tw1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[auto][tw2]" value="<?php  echo $total_no_batteries_auto_tw2; ?>"></td>
									</tr>									
									<tr>
										<td>(ii) Industrial</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td>(a) UPS</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_no_batteries[ind][ups1]" value="<?php echo $total_no_batteries_ind_ups1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[ind][ups2]" value="<?php echo $total_no_batteries_ind_ups2; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>(b) Motive Power</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_no_batteries[ind][mp1]" value="<?php echo $total_no_batteries_ind_mp1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[ind][mp2]" value="<?php  echo $total_no_batteries_ind_mp2; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>(c) Stand-by</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_no_batteries[ind][sb1]" value="<?php echo $total_no_batteries_ind_sb1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[ind][sb2]" value="<?php  echo $total_no_batteries_ind_sb2; ?>"></td>
									</tr>
									<tr>
										<td>(iii) Others (inverters, etc)</td>
										<td></td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_no_batteries[ind][ot1]" value="<?php echo $total_no_batteries_ind_ot1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[ind][ot2]" value="<?php echo $total_no_batteries_ind_ot2; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">Number of batteries sold to</td>
									</tr>
									<tr>
										<td></td>
										<td>(i) Dealers</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_no_batteries[sold][d1]" value="<?php echo $total_no_batteries_sold_d1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[sold][d2]" value="<?php echo $total_no_batteries_sold_d2; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>(ii) Bulk consumers</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_no_batteries[sold][bc1]" value="<?php echo $total_no_batteries_sold_bc1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[sold][bc2]" value="<?php echo $total_no_batteries_sold_bc2; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>(iii) OEM</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_no_batteries[sold][oem1]" value="<?php echo $total_no_batteries_sold_oem1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[sold][oem2]" value="<?php echo $total_no_batteries_sold_oem2; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>(iv) Any other party for replacement should be indicated separately</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_no_batteries[sold][any1]" value="<?php echo $total_no_batteries_sold_any1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="total_no_batteries[sold][any2]" value="<?php echo $total_no_batteries_sold_any2; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">4. Name and full address of the designated collection centers</td>
									</tr>
									<tr>
										<td>Name</td>
										<td><input type="text" class="form-control text-uppercase" name="collection_center[name]"  value="<?php  echo $collection_center_name; ?>" required="required" /></td>
										<td>Street Name 1</td>
										<td><input type="text" name="collection_center[s1]" class="form-control text-uppercase" required="required" value="<?php echo $collection_center_s1; ?>" /></td>
									</tr>
									<tr>
										<td>Street Name 2</td>
										<td><input type="text" name="collection_center[s2]" class="form-control text-uppercase"  value="<?php echo $collection_center_s2; ?>" /></td>
										<td>Village/Town<span style="color:#ff0000;">*</span></td>
										<td><input type="text" name="collection_center[vt]"  class="form-control text-uppercase" required="required" value="<?php echo $collection_center_vt; ?>" /></td>
									</tr>
									<tr>
										<td>District</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($collection_center_d);?>"   name="collection_center[d]">    
                                        </td>
                                        <td height="29">Pincode</td>
										<td><input type="text" name="collection_center[pin]" maxlength="6" validate="pincode" required="required" value="<?php echo $collection_center_pin; ?>" class="form-control text-uppercase" /></td>
									</tr>
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" name="collection_center[mob_no]" class="form-control text-uppercase" maxlength="10" validate="mobileNumber" required="required" value="<?php echo $collection_center_mob_no; ?>" /></td>
										<td>Phone No.</td>
										<td ><div class="input-group"><input type="text" name="collection_center[ph_std]" style="width:60px" class="form-control text-uppercase" validate="onlyNumbers" maxlength="5" pattern="[0-9]{3,5}" value="<?php echo $collection_center_ph_std; ?>" /><input type="text" name="collection_center[ph_no]" class="form-control text-uppercase" maxlength="8" validate="onlyNumbers" style="width:180px" value="<?php echo $collection_center_ph_no; ?>" /></div></td>
									</tr>					
									<tr>
										<td colspan="3">5. Total numbers of used batteries of different categories as at Sl. No. 3 collected and sent to registered recyclers *<br/> Enclose the list of recyclers to whom batteries have been sent for recycling.</td>
										<td><input type="text" id="totalNumber" name="used_bat" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $used_bat; ?>" /></td>
									</tr>
									<tr>
										<td>Place</td>
										<td><label><?php echo strtoupper($dist); ?></label></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Date</td>
										<td><label><?php echo date('d-m-Y', strtotime($today)); ?></label></td>
										<td>Signature of the authorized person</td>
										<td><label class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save ?')">Save & Next</button>
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