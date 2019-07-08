<?php  require_once "../../requires/login_session.php"; 
$dept="forest";
$form="3";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";
   
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc(); 
			$form_id=$results['form_id'];$police_station=$results['police_station'];$raw_mat=$results['raw_mat'];	
			$industry=$results['industry'];$location=$results['location'];$legal_stat=$results['legal_stat'];
			$capital=$results['capital'];$capacity=$results['capacity'];$source=$results['source'];$ratio=$results['ratio'];$regular=$results['regular'];$daily=$results['daily'];
			$investment=$results['investment'];$power=$results['power'];$offense=$results['offense'];
			$other_details=$results['other_details'];$license_fee=$results['license_fee'];$wood_type=$results['wood_type'];
		}else{
			$form_id="";$police_station="";$raw_mat="";
			$industry="";
			$location="";$legal_stat="";$capital="";
			$capacity="";$source="";$ratio="";$regular="";$daily="";
			$investment="";$power="";$offense="";$other_details="";$license_fee="";$wood_type="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];$police_station=$results['police_station'];$raw_mat=$results['raw_mat'];	
		$industry=$results['industry'];$location=$results['location'];$legal_stat=$results['legal_stat'];
		$capital=$results['capital'];$capacity=$results['capacity'];$source=$results['source'];$ratio=$results['ratio'];$regular=$results['regular'];$daily=$results['daily'];
		$investment=$results['investment'];$power=$results['power'];$offense=$results['offense'];
		$other_details=$results['other_details'];$license_fee=$results['license_fee'];$wood_type=$results['wood_type'];
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
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr>
												<td colspan="4" class="form-inline">To,<br/>
												&emsp;&emsp;The Conservator of Forests<br/>
												&emsp;&emsp;<input type="text" disabled value="<?php echo $b_dist; ?>" class="text-uppercase"><br/>
												&emsp;&emsp;<input type="text" disabled value="<?php echo $circle; ?>" class="text-uppercase"> Circle,<br/>
												&emsp;&emsp;&emsp;(Through the Divisional Forest Officer, <input type="text" disabled  value="<?php echo $b_block; ?>" class=" text-uppercase"> Division) <br/><br/>
												</td>
											</tr>
											<tr>
												<td colspan="4" class="form-inline">Sir,<br/>
												&emsp;&emsp;I/We Shri <?php echo strtoupper($key_person); ?> inhabitant(s) of <?php echo $from; ?>  under <input type="text" value="<?php echo $police_station; ?>" name="police_station" class="form-control text-uppercase"> Police Station, <?php echo strtoupper($dist); ?> District grant of licence for setting up of a wood-based industry as mentioned below using <input type="text" name="raw_mat" value="<?php echo $raw_mat; ?>" class="form-control text-uppercase">as raw material. The particulars of the wood based industry are given herein below:
												</td>										
											</tr> 
											<tr>
												<td width="25%">1. a) Name of the Wood-based industry :</td>
												<td width="25%"><input type="text" name="industry" value="<?php echo $industry; ?>"  class="form-control text-uppercase"></td>
												<td width="25%"> b) Type of Wood-based industry :</td>
												<td width="25%">
													<select required class="form-control text-uppercase" name="wood_type" id="type" value="<?php echo $wood_type; ?>">
													<option value="A" <?php if($wood_type=='A') echo 'selected';?>>Saw Mill</option>
													<option value="B" <?php if($wood_type=='B') echo 'selected';?>>Match Splint</option>
													<option value="C" <?php if($wood_type=='C') echo 'selected';?>>Katha</option>
													<option value="D" <?php if($wood_type=='D') echo 'selected';?>>Agarwood Oil Manufacturing</option>
													<option value="E" <?php if($wood_type=='E') echo 'selected';?>>Extracting unit</option>
													<option value="F" <?php if($wood_type=='F') echo 'selected';?>>Veneer</option>
													<option value="G" <?php if($wood_type=='G') echo 'selected';?>>Plywood Mill</option>
													<option value="H" <?php if($wood_type=='H') echo 'selected';?>>Hardboard</option>
													<option value="I" <?php if($wood_type=='I') echo 'selected';?>>Particle Board</option>
													<option value="J" <?php if( $wood_type=='J') echo 'selected';?>>Match Manufacturing Unit </option>
													<option value="K" <?php if($wood_type=='K') echo 'selected';?>>Other wood based industry</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>2. Location &amp; name of the industrial estate where the wood-based industry is proposed to be established and details of area etc.</td>
												<td><textarea name="location" class="form-control text-uppercase" id="location" validate="textarea" ><?php echo $location; ?></textarea></td>
												<td width="25%">3. Legal status (whether ownership of Private Limited Company)</td>
												<td width="25%"><input type="text" name="legal_stat" value="<?php echo $legal_stat; ?>"  class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>4. Whether a Limited Company/ Partnership/ Proprietorship business and the relationship of the applicant(s) with such Company or Partnership or Proprietorship business</td>
												<td colspan="2"><input type="text" value="<?php echo $Type_of_ownership; ?>" class="form-control" disabled="disabled"/></td>
												<td>Upload later in upload section</td>
											</tr>
											<tr>
												<td>5. Capital Value:</td>
												<td><input type="text" name="capital" value="<?php echo $capital; ?>"  class="form-control text-uppercase"></td>
												<td>6. Rated capacity (volume of timber etc.) per year in cu.m.</td>
												<td><input type="text" name="capacity" value="<?php echo $capacity; ?>"  class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td width="25%">7. Expected source/ sources of raw materials</td>
												<td width="25%"><textarea name="source" class="form-control text-uppercase" id="source" validate="textarea" ><?php echo $source; ?></textarea></td>
												<td width="25%">8. Expected conversion ratio from raw material</td>
												<td width="25%"><input type="text" name="ratio" value="<?php echo $ratio; ?>"  class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>9. Employment:</td>
											</tr>
											<tr>
												<td width="25%">(a) Strength of regular employees : </td>
												<td width="25%"><input type="text" name="regular" value="<?php echo $regular; ?>"  class="form-control text-uppercase"></td>
												<td width="25%">(b) Strength of daily workers</td>
												<td width="25%"><input type="text" name="daily" value="<?php echo $daily; ?>"  class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td width="25%">10. Source of capital investment</td>
												<td width="25%"><input type="text" name="investment" value="<?php echo $investment; ?>"  class="form-control text-uppercase"></td>
												<td width="25%">11. Source of power</td>
												<td width="25%"><input type="text" name="power" value="<?php echo $power; ?>"  class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td width="25%">12. Whether convicted or penalized in any Criminal/Forest offence case.</td>
												<td width="25%"><textarea name="offense" class="form-control text-uppercase" id="offense"  validate="offense" ><?php echo $offense; ?></textarea></td>
												<td width="25%">13. Whether processing any other wood based industry in the State, if yes, details thereof.</td>
												<td width="25%"><textarea name="other_details" class="form-control text-uppercase" id="other_details"  validate="textarea" ><?php echo $other_details; ?></textarea></td>
											</tr>
											<tr>
												<td>
													Place :&nbsp;<b><strong><?php echo strtoupper($dist); ?></strong></b><br/>
													Date :&nbsp;<b><strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></b> 
												</td>
												<td></td>
												<td></td>
												<td align="right"><strong><?php echo strtoupper($key_person); ?></strong><br/>Signature(s) of the applicant(s) </td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">Save & Next</button>
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
	/* ----------------------------------------------------- */	
	<?php if($is_registered == 'N' || $is_registered == '') echo "$('#is_registered_id').hide();"; ?>
	$('input[name="is_registered"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_registered_id').hide();
		else
			$('#is_registered_id').show();
	});

	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>