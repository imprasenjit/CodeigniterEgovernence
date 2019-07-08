<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="63";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$auth_num=$results['auth_num'];$auth_date=$results['auth_date'];$validity=$results['validity'];
	}else{
		$form_id="";$auth_num="";$auth_date="";$validity="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$auth_num=$results['auth_num'];$auth_date=$results['auth_date'];$validity=$results['validity'];
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4"><b><u>Ref</u></b> : Your application for Grant of Extended Producer Responsibility - Authorisation for following Electrical & Electronic Equipment under E-Waste (Management) Rules, 2016</td>
										</tr>
										<tr>
											<td width="25%">1. Number of Authorisation : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="auth_num" value="<?php echo $auth_num;?>" ></td>
											<td width="25%">2. Authorisation Date : </td>
											<td width="25%"><input type="text" class="dob form-control" name="auth_date" value="<?php echo $auth_date;?>" ></td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">3.  M/S &nbsp;<input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $unit_name; ?>">&nbsp;&nbsp;is hereby granted Extended Producer Responsibility - Authorisation based on : <br/>
											(a) overall Extended Producer Responsibility plan <br/>
											(b) proposed target for collection of e-waste
											</td>
										</tr>	
										<tr class="form-inline">
											<td colspan="4">4. The Authorisation shall be valid for a period of &nbsp;<input type="text" class="form-control text-uppercase" name="validity" value="<?php echo $validity;?>" validate="onlyNumbers">&nbsp;&nbsp;years from date of issue with following conditions: <br/>
											(i) you shall strictly follow the approved Extended Producer Responsibility plan, a copy of which is enclosed herewith;<br/>
											(ii) you shall ensure that collection mechanism or centre are set up or designated as per the details given in the Extended Producer Responsibility plan. Information on collection mechanism/centre including the state-wise setup should be provided;<br/>
											(iii) you shall ensure that all the collected e-waste is channelised to authorised dismantler or recycler designated as per the details. Information on authorised dismantler or recycler designated state-wise should be provided;<br/>
											(iv) you shall maintain records, in Form-2 of these Rules, of e-waste and make such records available for scrutiny by Central Pollution Control Board; <br/>
											(v) you shall file annual returns in Form-3 to the Central Pollution Control Board on or before 30th day of June following the financial year to which that returns relates; <br/>
											(vi) General Terms & Conditions of the Authorisation:
											<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a) The authorisation shall comply with provisions of the Environment (Protection) Act, 1986 and the Rules made there under;
											<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b) The authorisation or its renewal shall be produced for inspection at the request of an officer authorised by the Central Pollution Control Board; 
											<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; c) Any change in the approved Extended Producer Responsibility plan should be informed to Central Pollution Control Board on which decision shall be communicated by Central Pollution Control Board within sixty days;
											<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; d) It is the duty of the authorised person to take prior permission of the concerned State Pollution Control Boards and Central Pollution Control Board to close down the facility;
											<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; e) An application for the renewal of authorisation shall be made as laid down in sub-rule (vi) of rule of 13(1) the E-Waste (Management) Rules, 2016;
											<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; f) The Board reserves right to cancel/amend/revoke the authorisation at any time as per the Policy of the Board or Government.</td>
										</tr>
										<tr>
											<td colspan="4" align="right">Authorized signatory : <strong><?php echo strtoupper($key_person)?></strong><br/>Designation : <strong><?php echo $status_applicant;?></strong></td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>