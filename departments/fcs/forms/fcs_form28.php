<?php  require_once "../../requires/login_session.php";
$dept="fcs";
$form="28";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
           $results=$p->fetch_array();
		   $form_id=$results["form_id"];$auth_address=$results["auth_address"];$license_no=$results["license_no"];$expiry_date=$results["expiry_date"];$license_stands=$results["license_stands"];$renewal_desired=$results["renewal_desired"];$details_action=$results["details_action"];
		}else{   
			$form_id="";$auth_address="";$license_no="";$expiry_date="";$license_stands="";$renewal_desired="";$details_action="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_address=$results["auth_address"];$license_no=$results["license_no"];$expiry_date=$results["expiry_date"];$license_stands=$results["license_stands"];$renewal_desired=$results["renewal_desired"];$details_action=$results["details_action"];
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
								<tr>
									<td colspan="4" class="form-inline">
									To
									<br/>The Licensing Authority<br/>
																	
								</tr>
								<tr>
									<td colspan="4" class="form-inline">Sir,<br/>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I,<?php echo $key_person; ?> hereby apply for renewal of my license no. &nbsp; <input type="text" name="license_no" value="<?php echo $license_no; ?>" class="form-control text-uppercase">&nbsp; issued to me under the Assam Public Distribution of Articles Order, 1982. The required particulars are given below-</td>
								</tr>
								<tr>
									<td width="25%">1. Date on which the licence expire</td>
									<td width="25%"><input type="text" name="expiry_date" value="<?php echo $expiry_date; ?>" class="dob form-control text-uppercase" readonly="readonly"></td>
									<td width="25%">2. Name in which licence stands</td>
									<td width="25%"><input type="text" name="license_stands"  value="<?php echo $license_stands; ?>" class="form-control text-uppercase"></td>		
								</tr>
								<tr>
									<td width="25%">3. For how many years the renewal is desired</td>
									<td width="25%"><input type="text" class="form-control text-uppercase"  name="renewal_desired" validate="onlyNumbers" value="<?php echo $renewal_desired;?>"/></td>
									<td width="25%">4. Details of the action, if any taken against the licensee during the last 3 (three) years for contravention of an order issued under the Essential Commodities Act, 1953.</td>
									<td width="25%"><input type="text" name="details_action" value="<?php echo $details_action; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">I Shri <input type="text" class="form-control" disabled value="<?php echo strtoupper($key_person); ?>" > hereby declare that the particulars mentioned above are correct and true to best of my knowledge and belief, nothing has been concealed therein.</td>
								</tr>
								<tr>
								   <td>Date:</td>
									<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
									<td>Signature of the Authorised Signatory</td>
									<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
								</tr>
								<tr>									
									<td class="text-center" colspan="4">
										<button type="submit" name="save<?php echo $form;?>" class="btn btn-success submit1">Save & Next</button>
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
	
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
</script>