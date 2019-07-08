<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="7";
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
		$total_batt_impt=$results["total_batt_impt"];$used_batteries=$results["used_batteries"];
		$form_id=$results['form_id'];
       
		if(!empty($results["new_batteries"])){
			$new_batteries=json_decode($results["new_batteries"]);
			$new_batteries_auto=$new_batteries->auto;$new_batteries_ind=$new_batteries->ind;$new_batteries_sold=$new_batteries->sold;
			$new_batteries_auto_fw1=$new_batteries_auto->fw1;$new_batteries_auto_fw2=$new_batteries_auto->fw2;
			$new_batteries_auto_tw1=$new_batteries_auto->tw1;$new_batteries_auto_tw2=$new_batteries_auto->tw2;
			$new_batteries_ind_ups1=$new_batteries_ind->ups1;$new_batteries_ind_ups2=$new_batteries_ind->ups2;
			$new_batteries_ind_mp1=$new_batteries_ind->mp1;$new_batteries_ind_mp2=$new_batteries_ind->mp2;
			$new_batteries_ind_sb1=$new_batteries_ind->sb1;$new_batteries_ind_sb2=$new_batteries_ind->sb2;
			$new_batteries_ind_ot1=$new_batteries_ind->ot1;$new_batteries_ind_ot2=$new_batteries_ind->ot2;
			$new_batteries_sold_d1=$new_batteries_sold->d1;$new_batteries_sold_d2=$new_batteries_sold->d2;
			$new_batteries_sold_bc1=$new_batteries_sold->bc1;$new_batteries_sold_bc2=$new_batteries_sold->bc2;
			$new_batteries_sold_oem1=$new_batteries_sold->oem1;$new_batteries_sold_oem2=$new_batteries_sold->oem2;
			$new_batteries_sold_r1=$new_batteries_sold->r1;$new_batteries_sold_r2=$new_batteries_sold->r2;
		}else{
			$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";$new_batteries_sold_d1="";$new_batteries_sold_d2="";$new_batteries_sold_bc1="";$new_batteries_sold_bc2="";$new_batteries_sold_oem1="";$new_batteries_sold_oem2="";$new_batteries_sold_r1="";$new_batteries_sold_r2="";
		}			
		if(!empty($results["collection_center"])){
			$collection_center=json_decode($results["collection_center"]);
			$collection_center_name=$collection_center->name;$collection_center_s1=$collection_center->s1;$collection_center_s2=$collection_center->s2;$collection_center_vt=$collection_center->vt;$collection_center_d=$collection_center->d;$collection_center_pin=$collection_center->pin;$collection_center_mob_no=$collection_center->mob_no;$collection_center_ph_std=$collection_center->ph_std;$collection_center_ph_no=$collection_center->ph_no;
		}else{
			$collection_center_name="";$collection_center_s1="";$collection_center_s2="";$collection_center_vt="";$collection_center_d="";$collection_center_pin="";$collection_center_mob_no="";$collection_center_ph_std="";$collection_center_ph_no="";
		}	
	}else{
        $form_id="";		
		$total_batt_impt="";$used_batteries="";
		$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";$new_batteries_sold_d1="";$new_batteries_sold_d2="";$new_batteries_sold_bc1="";$new_batteries_sold_bc2="";$new_batteries_sold_oem1="";$new_batteries_sold_oem2="";$new_batteries_sold_r1="";$new_batteries_sold_r2="";
		$collection_center_name="";$collection_center_s1="";$collection_center_s2="";$collection_center_vt="";$collection_center_d="";$collection_center_pin="";$collection_center_mob_no="";$collection_center_ph_std="";$collection_center_ph_no="";		
	}
}else{		
	$results=$q->fetch_assoc();
	$total_batt_impt=$results["total_batt_impt"];$used_batteries=$results["used_batteries"];
	$form_id=$results['form_id'];
    
	if(!empty($results["new_batteries"])){
		$new_batteries=json_decode($results["new_batteries"]);
		$new_batteries_auto=$new_batteries->auto;$new_batteries_ind=$new_batteries->ind;$new_batteries_sold=$new_batteries->sold;
		$new_batteries_auto_fw1=$new_batteries_auto->fw1;$new_batteries_auto_fw2=$new_batteries_auto->fw2;
		$new_batteries_auto_tw1=$new_batteries_auto->tw1;$new_batteries_auto_tw2=$new_batteries_auto->tw2;
		$new_batteries_ind_ups1=$new_batteries_ind->ups1;$new_batteries_ind_ups2=$new_batteries_ind->ups2;
		$new_batteries_ind_mp1=$new_batteries_ind->mp1;$new_batteries_ind_mp2=$new_batteries_ind->mp2;
		$new_batteries_ind_sb1=$new_batteries_ind->sb1;$new_batteries_ind_sb2=$new_batteries_ind->sb2;
		$new_batteries_ind_ot1=$new_batteries_ind->ot1;$new_batteries_ind_ot2=$new_batteries_ind->ot2;
		$new_batteries_sold_d1=$new_batteries_sold->d1;$new_batteries_sold_d2=$new_batteries_sold->d2;
		$new_batteries_sold_bc1=$new_batteries_sold->bc1;$new_batteries_sold_bc2=$new_batteries_sold->bc2;
		$new_batteries_sold_oem1=$new_batteries_sold->oem1;$new_batteries_sold_oem2=$new_batteries_sold->oem2;
		$new_batteries_sold_r1=$new_batteries_sold->r1;$new_batteries_sold_r2=$new_batteries_sold->r2;
	}else{
		$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";$new_batteries_sold_d1="";$new_batteries_sold_d2="";$new_batteries_sold_bc1="";$new_batteries_sold_bc2="";$new_batteries_sold_oem1="";$new_batteries_sold_oem2="";$new_batteries_sold_r1="";$new_batteries_sold_r2="";
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
								<div  class="tab-pane" role="tabpanel">
                            <form name="myform1" id="myformBT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. Name and address of the Importer </td>
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
		                                <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_landline_std.'-'.$landline_no;?>"></td>
										<td>Email-id</td>
		                                <td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. Name and address of the authorized person with telephone</td>
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
										<td colspan="3">3. Number of batteries imported during the period from October to March and April to September</td>
		                                <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_batt_impt" value="<?php echo$total_batt_impt; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">4. Total number of new batteries sold during the period October-March/ April-September in respect of the following category :</td>
									</tr>
									<tr>
										<td>Category:</td>
										<td>(i) No. of Batteries</td>
										<td>(ii)Approximate weight (in Metric Tones)</td>									
										<td></td>
									</tr>
									<tr>
										<td colspan="4">(i) Automotive</td>
									</tr>
									<tr>
										<td>(a) four wheeler</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[auto][fw1]" value="<?php echo $new_batteries_auto_fw1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[auto][fw2]" value="<?php echo $new_batteries_auto_fw2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td>(b) two wheeler</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers"  name="new_batteries[auto][tw1]" value="<?php echo $new_batteries_auto_tw1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[auto][tw2]" value="<?php  echo $new_batteries_auto_tw2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">(ii) Industrial</td>
									</tr>
									<tr>
										<td>(a) UPS</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[ind][ups1]" value="<?php echo $new_batteries_ind_ups1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[ind][ups2]" value="<?php echo $new_batteries_ind_ups2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td>(b) Motive Power</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[ind][mp1]" value="<?php echo $new_batteries_ind_mp1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[ind][mp2]" value="<?php  echo $new_batteries_ind_mp2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td>(c) Stand-by</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[ind][sb1]" value="<?php echo $new_batteries_ind_sb1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[ind][sb2]" value="<?php  echo $new_batteries_ind_sb2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td>(iii) Others (inverters, etc)</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[ind][ot1]" value="<?php echo $new_batteries_ind_ot1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[ind][ot2]" value="<?php echo $new_batteries_ind_ot2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">Number of batteries sold to</td>
									</tr>
									<tr>
										<td>(i) Dealers</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[sold][d1]" value="<?php echo $new_batteries_sold_d1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[sold][d2]" value="<?php echo $new_batteries_sold_d2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td>(ii) Bulk consumers</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[sold][bc1]" value="<?php echo $new_batteries_sold_bc1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[sold][bc2]" value="<?php echo $new_batteries_sold_bc2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td>(iii) OEM</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[sold][oem1]" value="<?php echo $new_batteries_sold_oem1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[sold][oem2]" value="<?php echo $new_batteries_sold_oem2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td>(iv) Any other party for replacement</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[sold][r1]" value="<?php echo $new_batteries_sold_r1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[sold][r2]" value="<?php echo $new_batteries_sold_r2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">5. Name and full address of the designated collection centers</td>
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
															
										<td>Pincode</td>
										<td><input type="text" name="collection_center[pin]" validate="pincode" required="required" maxlength="6" validate="onlyNumbers" value="<?php echo $collection_center_pin; ?>" class="form-control text-uppercase" /></td>
									</tr>
									<tr>
										<td>Mobile</td>
										<td><input type="text" name="collection_center[mob_no]" class="form-control text-uppercase" validate="mobileNumber" required="required" maxlength="10" value="<?php echo $collection_center_mob_no; ?>" /></td>
										<td>Phone Number</td>
										<td ><div class="input-group"><input type="text" name="collection_center[ph_std]" maxlength="5" pattern="[0-9]{3,5}" validate="onlyNumbers" style="width:60px" class="form-control text-uppercase" value="<?php echo $collection_center_ph_std; ?>" /><input type="text" name="collection_center[ph_no]" class="form-control text-uppercase" maxlength="8" validate="onlyNumbers" style="width:160px" value="<?php echo $collection_center_ph_no; ?>" /></div></td>
									</tr>					
									<tr>
										<td colspan="3">6. Total numbers of used batteries of different categories as at Sl. No. 3 collected and sent to registered recyclers*<br/>**Enclose a complete list.</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="used_batteries" value="<?php echo $used_batteries; ?>"  /></td>
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
											<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save & Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>