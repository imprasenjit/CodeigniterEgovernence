<?php  require_once "../../requires/login_session.php";
$dept="clm";
$form="7";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") or die($clm->error);
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
		    $form_id=$results["form_id"];
			$brnch_nm=$results["brnch_nm"];$commodities=$results["commodities"];$cst_no=$results["cst_no"];
			if(!empty($results["fac"])){
				$fac=json_decode($results["fac"]);
				$fac_name=$fac->name;$fac_strt_name1=$fac->strt_name1;$fac_strt_name2=$fac->strt_name2;$fac_vill=$fac->vill;$fac_dist=$fac->dist;$fac_pincode=$fac->pincode;
			}else{
				$fac_name="";$fac_strt_name1="";$fac_strt_name2="";$fac_vill="";$fac_dist="";$fac_pincode="";
			}
		}else{		
			$form_id="";
			$fac_name="";$fac_strt_name1="";$fac_strt_name2="";$fac_vill="";$fac_dist="";$fac_pincode="";
			$brnch_nm="";$commodities="";$cst_no="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$brnch_nm=$results["brnch_nm"];$commodities=$results["commodities"];$cst_no=$results["cst_no"];
		if(!empty($results["fac"])){
			$fac=json_decode($results["fac"]);
			$fac_name=$fac->name;$fac_strt_name1=$fac->strt_name1;$fac_strt_name2=$fac->strt_name2;$fac_vill=$fac->vill;$fac_dist=$fac->dist;$fac_pincode=$fac->pincode;
		}else{
			$fac_name="";$fac_strt_name1="";$fac_strt_name2="";$fac_vill="";$fac_dist="";$fac_pincode="";
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
						</br>
							<div id="table1" class="tab-pane" role="tabpanel">
							<form name="my_form7" id="my_form7" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive">


								 <tr>
									<td width="25%">1. (a) Name of the Firm: </td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>" ></td>
									<td width="25%">1. (b) Name of the Applicant:</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>" /></td>
								</tr>
								<tr>
									<td colspan="4">2. Complete address of the Applicannt/Firm: </td>
								</tr>
								<tr>
									<td>Street Name 1</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
									<td>Street Name 2</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
								</tr>
								<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $vill; ?>"></td>
									<td>District</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
								</tr>
								<tr>
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
									<td>Mobile No.</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
								</tr>	
								<tr>
									<td>Phone No.</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $landline_std; ?> - <?php echo $landline_no; ?>"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">3. Registered office address: </td>
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
									<td>Block</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block; ?>"></td>
								</tr>
								<tr>
									<td>District</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"></td>
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"></td>
								</tr>
								<tr>
									<td colspan="4">4. Location of the factory: </td>
								</tr>
								
								<tr>
									<td width="25%">Factory Name</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="fac[name]" validate="letters" value="<?php echo $fac_name; ?>"></td>
									<td>Street Name 1</td>
									<td><input type="text" class="form-control text-uppercase"  name="fac[strt_name1]" value="<?php echo $fac_strt_name1; ?>"></td>
								</tr>
								<tr>
									<td>Street Name 2</td>
									<td><input type="text" class="form-control text-uppercase" name="fac[strt_name2]" value="<?php echo $fac_strt_name2; ?>"></td>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" name="fac[vill]" value="<?php echo $fac_vill; ?>"></td>
								</tr>
								<tr>
									
									<td>District<span class="mandatory_field">*</span></td>
                                    <td><input type="text" class="form-control text-uppercase" name="fac[dist]" id="fac_dist" value="<?php echo $fac_dist; ?>"></td>
									
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6"name="fac[pincode]" value="<?php echo $fac_pincode; ?>"></td>
								</tr>
								<tr>
									<td width="25%">5. Branches, if any :</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="brnch_nm" value="<?php echo $brnch_nm; ?>" ></td>
									<td width="25%"></td>
									<td width="25%"></td>
								</tr>
								<td colspan="4">6. Name(s) of the Proprietor/Partners/Occupier :</td>
								<tr>
										<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr >
												<th>Sl. No.</th>
												<th>Name</th>
												<th>Father's/Spouse's Name</th>
												<th>Address</th>
												<th>Pincode</th>
												<th>Contact No</th>
											</tr>
										</thead>	
											<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$clm->error);
										
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="<?php echo $rows->family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pincode; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="<?php echo $rows->contact; ?>" /></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										</td>
										</tr>
										</table></td>
									</tr>
								<tr>
									<td width="25%">7. Commodity(ies) intended to Pre-pack : </td>
									<td><input type="text" class="form-control text-uppercase" name="commodities"  value="<?php echo $commodities; ?>" ></td>
								
									<td width="25%">8. CST no./AGST no/MLT no. </td>
									<td><input type="text" class="form-control text-uppercase" name="cst_no" value="<?php echo $cst_no; ?>" ></td>
								</tr>
								<tr>
									<td colspan="4" align="center"><b><u>DECLARATION</u></b></td>
								</tr>
								<tr>
									<td colspan="4">  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I/we hereby declare that the packages manufactured/packed will comply the various provisions of the Legal Metrology (Packaged Commodities) Rule, 2011.</td>
								</tr>
								<tr>
									<td>Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
									Place: <label><?php echo strtoupper($dist); ?></label></td>
									<td></td>
									<td></td>
									<td align="right"> Signature: <label><?php echo strtoupper($key_person) ?></label><br/>Designation: <label><?php echo strtoupper($status_applicant) ?></label></td>
								</tr>
								<tr>
										
										<td class="text-center" colspan="4">
											<button type="submit"  value="SAVE & NEXT" name="save<?php echo $form; ?>" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" class="btn btn-success submit1">Save and Next</button>
										</td>
								</tr>
							</table>
							</form>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>