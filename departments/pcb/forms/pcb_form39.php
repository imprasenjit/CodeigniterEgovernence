<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="39";
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
		$is_unit_registered=$results["is_unit_registered"];		
		$form_id=$results['form_id'];	
		if(!empty($results["project"])){
			$project=json_decode($results["project"]);
			$project_tot_cap=$project->tot_cap;$project_year=$project->year;
		}else{
			$project_tot_cap="";$project_year="";
		}
	}else{
		$form_id="";		
		$is_unit_registered="";
		$project_tot_cap="";$project_year="";			
	}
}else{	
	$results=$q->fetch_assoc();
	$is_unit_registered=$results["is_unit_registered"];		
	$form_id=$results['form_id'];
	if(!empty($results["project"])){
		$project=json_decode($results["project"]);
		$project_tot_cap=$project->tot_cap;$project_year=$project->year;
	}else{
		$project_tot_cap="";$project_year="";
	}				
}
?>
<?php require_once "../../requires/header.php";   ?>
    <?php include ("".$table_name."_Addmore-operation.php"); ?>
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong><br/>[See rules 13(4)]
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myformBT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td  colspan="4">1.(a) Name and location of the unit </td>
									</tr>
									<tr>
										<td width="25%">Name</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name;?>"></td>
										<td width="25%">Location</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Address of the unit</td>
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
										<td>Mobile No</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>
										<td colspan="3">2. Is the unit registered with the DIC or DCSSI of the State Government or Union Territory? If yes, attach a copy.<span class= "mandatory_field">*</span></td>
										<td><label class="radio-inline"><input type="radio" name="is_unit_registered" value="Y"  <?php if(isset($is_unit_registered) && $is_unit_registered=='Y') echo 'checked'; ?> required="required"/> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_unit_registered"  value="N" <?php if(isset($is_unit_registered) && $is_unit_registered=='N' && $is_unit_registered=='') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td>3.(a) Total capital invested on the project</td>
										<td><input type="text" class="form-control text-uppercase" name="project[tot_cap]" value="<?php echo $project_tot_cap;?>"></td>
										<td>(b) Year of commencement of production</td>
										<td><input type="text" class="form-control text-uppercase" name="project[year]" validate="onlyNumbers" min="1960" max="2020"  value="<?php echo $project_year;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(c) List of producers and quantum of raw materials supplied to producers
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
										<tbody>
											<tr>
											   <td align="center" width="5%">Sl No.</td>
											   <td align="center" width="50%">Producers</td>
											   <td align="center">Quantum</td>
											</tr>
											<?php
											$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
											$num1 = $part1->num_rows;
											if($num1>0){
											  $count=1;
											  while($row_1=$part1->fetch_array()){	?>
												<tr>
													<td><input readonly  id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
													<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["producers"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
													<td><input value="<?php echo $row_1["quantum"]; ?>" id="txtC<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input  value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
												<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
												<td><input id="txtC1" size="10" class="form-control text-uppercase" name="txtC1"></td>
											</tr>
											<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</td>
									</tr>
									<tr>
										<td>Date</td>
										<td><label><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
										<td align="right">Signature of the authorized person</td>
										<td align="right"><label class="text-uppercase"><?php echo strtoupper($key_person); ?></label></td>
									</tr>
									<tr>
										<td>Place</td>
										<td><label><?php echo strtoupper($dist); ?></label></td>
										<td align="right">Designation</td>
										<td align="right"><label> <?php echo strtoupper($status_applicant);?></label></td>
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
	$('#is_unit_registered_upload').show();
	<?php if($is_unit_registered == 'N' || $is_unit_registered == '') echo "$('#is_unit_registered_upload').hide();"; ?>
	$('input[name="is_unit_registered"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_unit_registered_upload').hide();
		else
			$('#is_unit_registered_upload').show();
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>