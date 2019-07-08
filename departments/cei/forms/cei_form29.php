<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="29";

$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$year=$results['year'];$reg_no=$results['reg_no'];$class=$results['class'];$lic_valid_upto=$results['lic_valid_upto'];$from_date=$results['from_date'];$to_date=$results['to_date'];			
		}else{
			$form_id="";
			$year="";$reg_no="";$class="";$lic_valid_upto="";$from_date="";$to_date="";			
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$year=$results['year'];$reg_no=$results['reg_no'];$class=$results['class'];$lic_valid_upto=$results['lic_valid_upto'];$from_date=$results['from_date'];$to_date=$results['to_date'];
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
	<?php include ("".$table_name."_addmore.php"); ?>
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
							<ul class="nav nav-pills">
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">								
									
									<tr>
										<td width="25%"> 1.For the year :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="year" value="<?php echo $year; ?>"></td>
									</tr>
									<tr>
										<td width="25%">2.Name of the Contractor (IN BLOCK CAPITAL LETTERS) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
										<td width="25%">3.Registration. No of License:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_no" value="<?php echo $reg_no; ?>"></td>
									</tr>
									<tr>
										<td width="25%">4.Class OF License :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="class" value="<?php echo $class; ?>"></td>
										<td width="25%">5.License valid up to :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="lic_valid_upto" value="<?php echo $lic_valid_upto; ?>"></td>
									</tr>
									<tr>
										<td>6.Period Of Return : </td>
									</tr>
									<tr>
										<td>From</td>
										<td><input type="text" class="dob form-control text-uppercase" name="from_date" value="<?php echo $from_date; ?>"></td>
										<td>To</td>
										<td><input type="text" class="dob form-control text-uppercase" name="to_date" value="<?php echo $to_date; ?>" ></td>
									</tr>
									<tr>
										<td colspan="4">7.Details of works and staff alloted therefore :</td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No</th>
													<th width="10">Reference No. of Form-C </th>
													<th width="15%">Name & Description of the work with address </th>
													<th width="15%">Name of the supervisors entrusted with Regd. No. OF certificates of competency </th>
													<th width="15%">Name of the entrusted with REGD. NO. of the permits  </th>
													<th width="10">Name of the APPRENTICES DEPLOYED </th>
													<th width="10">Date of completion  </th>
													<th width="10">Reference & Date of TEST REPORT  </th>
													<th width="10">Report submitted to </th>
												</tr>
												</thead>
												<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input type="text"  id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["ref_no"]; ?>" name="txtB<?php echo $count;?>" size="20"></td>
														<td><input type="text" value="<?php echo $row_1["name_address"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>			
														<td><input type="text" value="<?php echo $row_1["name_supervisor"]; ?>" id="txtD<?php echo $count;?>"  class="form-control text-uppercase" name="txtD<?php echo $count;?>"   size="10"></td>
														<td><input type="text" value="<?php echo $row_1["nm_entrusted"]; ?>" id="txtE<?php echo $count;?>"  name="txtE<?php echo $count;?>" class="form-control text-uppercase"></td>
														<td><input type="text" value="<?php echo $row_1["nm_apprecentice"]; ?>" id="txtF<?php echo $count;?>"  name="txtF<?php echo $count;?>" class="form-control text-uppercase"></td>
														<td><input type="text" value="<?php echo $row_1["date_completion"]; ?>" id="txtG<?php echo $count;?>"  name="txtG<?php echo $count;?>" class="dob form-control"></td>
														<td><input type="text" value="<?php echo $row_1["reference_test_report"]; ?>" id="txtH<?php echo $count;?>"  name="txtH<?php echo $count;?>" class="form-control text-uppercase"></td>
														<td><input type="text" value="<?php echo $row_1["report_sub"]; ?>" id="txtI<?php echo $count;?>"  name="txtI<?php echo $count;?>" class="form-control text-uppercase"></td>
														
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text"  readonly value="1" id="txtA1" size="1"  class="form-control text-uppercase"  name="txtA1"></td>
														<td><input  type="text" id="txtB1"  class="form-control text-uppercase" name="txtB1"></td>
														<td><input type="text" id="txtC1" title="No special characters are allowed except Dot"   class="form-control text-uppercase" name="txtC1" size="20"></td>					
														<td><input type="text"  id="txtD1"  class="form-control text-uppercase" name="txtD1"  size="20"></td>
														<td><input type="text" id="txtE1"  class="form-control text-uppercase" name="txtE1"  size="10"></td>
														<td><input type="text" id="txtF1"  class="form-control text-uppercase" name="txtF1"  size="10"></td>
														<td><input type="text" id="txtG1"  class="dob form-control" name="txtG1"  size="10"></td>
														<td><input type="text" id="txtH1"  class="form-control text-uppercase" name="txtH1"  size="10"></td>
														<td><input type="text" id="txtI1"  class="form-control text-uppercase" name="txtI1"  size="10"></td>
														
														
													</tr>
													<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b><br/>Place : <b><?php echo date('d-m-Y',strtotime($today));?></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>
										Signature of the contractor</td>
									</tr>
									
									
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
    $('#is_apdcl_yes').css('display','table');	 
	<?php if($is_apdcl == 'N' || $is_apdcl == '') echo "$('#is_apdcl_yes').css('display','none');"; ?>
	
	$('input[name="is_apdcl"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_apdcl_yes').css('display','table');			
		}else{
			$('#is_apdcl_yes').css('display','none');			
		}
	});
	$('#is_installation_details').attr('readonly','readonly');
	<?php if($is_installation == 'Y') echo "$('#is_installation_details').removeAttr('readonly','readonly');"; ?>
	$('.is_installation').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_installation_details').removeAttr('readonly','readonly');
		}else{
			$('#is_installation_details').attr('readonly','readonly');
			$('#is_installation_details').val('');
		}			
	});
	
	/* ----------------------------------------------------- */
	// /* ---------------------upload S/C click operation-------------------- */
	// <?php if($check!=0 && $check!=4){ ?>
		// $("#myform1 :input,select").prop("disabled", true);
	// <?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
</script>