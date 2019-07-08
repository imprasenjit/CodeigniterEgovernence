<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="11";
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
		$no_used_batt=$results["no_used_batt"];
		$form_id=$results['form_id'];
		if(!empty($results["new_batteries"])){
			$new_batteries=json_decode($results["new_batteries"]);
			$new_batteries_auto=$new_batteries->auto;$new_batteries_ind=$new_batteries->ind;
			$new_batteries_auto_fw1=$new_batteries_auto->fw1;$new_batteries_auto_fw2=$new_batteries_auto->fw2;
			$new_batteries_auto_tw1=$new_batteries_auto->tw1;$new_batteries_auto_tw2=$new_batteries_auto->tw2;
			$new_batteries_ind_ups1=$new_batteries_ind->ups1;$new_batteries_ind_ups2=$new_batteries_ind->ups2;
			$new_batteries_ind_mp1=$new_batteries_ind->mp1;$new_batteries_ind_mp2=$new_batteries_ind->mp2;
			$new_batteries_ind_sb1=$new_batteries_ind->sb1;$new_batteries_ind_sb2=$new_batteries_ind->sb2;
			$new_batteries_ind_ot1=$new_batteries_ind->ot1;$new_batteries_ind_ot2=$new_batteries_ind->ot2;
		}else{
			$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";
		}
	}else{
        $form_id="";		
		$no_used_batt="";
		$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";$new_batteries_sold_d1="";$new_batteries_sold_d2="";$new_batteries_sold_bc1="";$new_batteries_sold_bc2="";$new_batteries_sold_oem1="";$new_batteries_sold_oem2="";$new_batteries_sold_r1="";$new_batteries_sold_r2="";		
	}
}else{		
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$no_used_batt=$results["no_used_batt"];
	
	if(!empty($results["new_batteries"])){
		$new_batteries=json_decode($results["new_batteries"]);
		$new_batteries_auto=$new_batteries->auto;$new_batteries_ind=$new_batteries->ind;
		$new_batteries_auto_fw1=$new_batteries_auto->fw1;$new_batteries_auto_fw2=$new_batteries_auto->fw2;
		$new_batteries_auto_tw1=$new_batteries_auto->tw1;$new_batteries_auto_tw2=$new_batteries_auto->tw2;
		$new_batteries_ind_ups1=$new_batteries_ind->ups1;$new_batteries_ind_ups2=$new_batteries_ind->ups2;
		$new_batteries_ind_mp1=$new_batteries_ind->mp1;$new_batteries_ind_mp2=$new_batteries_ind->mp2;
		$new_batteries_ind_sb1=$new_batteries_ind->sb1;$new_batteries_ind_sb2=$new_batteries_ind->sb2;
		$new_batteries_ind_ot1=$new_batteries_ind->ot1;$new_batteries_ind_ot2=$new_batteries_ind->ot2;
	}else{
		$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";
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
                            <form name="myform1" class="submit1" id="myformBT8" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%">1.Name and address of the bulk consumer </td>
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
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $pincode;?>"></td>
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
										<td colspan="4">3. Number of new batteries of different categories purchased from the manufacturer/ importer/ dealer/ or any other agency during October-March and April- September :</td>
									</tr>
									<tr>
										<td width="25%">Category:</td>
										<td width="25%">(i) No. of Batteries</td>
										<td width="25%">(ii)Approximate weight (in Metric Tones)</td>
										<td></td>
									</tr>
									<tr>
										<td>(i) Automotive</td>
										<td></td>
										<td></td>
										<td></td>
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
										<td>(ii) Industrial</td>
										<td></td>
										<td></td>
										<td></td>
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
										<td>(iii) Others </td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="new_batteries[ind][ot1]" value="<?php echo $new_batteries_ind_ot1; ?>"></td>
										<td><input type="text" class="form-control text-uppercase" name="new_batteries[ind][ot2]" value="<?php echo $new_batteries_ind_ot2; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">4. Number of used batteries of categories mentioned in Sl. No. 3 and Tonnage of scrap sent to manufacturer/dealer/importer/registered recycler/or any other agency to whom the used batteries scraped was sent.</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_used_batt" value="<?php echo $no_used_batt; ?>"  /></td>
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
