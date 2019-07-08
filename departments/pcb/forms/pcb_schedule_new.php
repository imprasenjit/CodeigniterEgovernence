<?php  
require_once "../../requires/login_session.php"; 
include "save_form.php";

$applied="";$commission_date="";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
	</style>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
<div class="wrapper">
  <?php require '../../../user_area/includes/header.php'; ?>
  <?php require '../../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../includes/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myformBT5" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
									<table class="table table-responsive">
										<tr>
											<td width="25%"> Have you applied online in Pollution Control Board before?</td>
											<td width="25%">
												<label class="radio-inline"><input type="radio" name="applied"/>Yes &emsp;&emsp;</label>
												<label class="radio-inline"><input type="radio" name="applied"/> No</label>
											</td> 
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td width="25%"> You want to apply for?</td>
											<td width="25%">
												<select class="form-control" style="width:300px" id="application_forms">
													<option value="">Please select</option>
													<?php 
													$form_tables="1,2,3,47,48,49,50,51,52,53,54,55,56,57,58,59,60";
													$form_tables_array=Array();
													$form_tables_array=explode(",",$form_tables);
													
													for($i=0;$i<sizeof($form_tables_array);$i++){
														$form=$form_tables_array[$i];
														$form_name=$formFunctions->get_formName("pcb",$form);
														if($form_name!=""){
															echo '<option value="'. $form .'">'.$form_name.'</option>';
														}
														
													}
													?>
												</select>
											</td> 
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td width="25%">Date of commission :</td>
											<td width="25%"><input type="text" class=" dob form-control" name="commission_date" value="" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="button" class="btn btn-primary"  name="consent_fees" id="consent_fees" title="Submit" rel="tooltip">Calculate Consent Fees</button>
												<button type="submit" class="btn btn-success submit1"  name="submit" title="Submit" rel="tooltip" onclick="return confirm('Do you want to submit ?')">Submit</button>
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
<?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#consent_fees').on('click', function(){
		alert("asd");		
	});
	/* ------------------------------------------------------ */	
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	
</script>
</body>
</html>