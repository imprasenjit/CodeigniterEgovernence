<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="77";
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
		$owner_name=$results['owner_name'];$occupier_name=$results['occupier_name'];		
	}else{
		$form_id="";$owner_name="";$occupier_name="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$owner_name=$results['owner_name'];$occupier_name=$results['occupier_name'];
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
											<td colspan="4">To, <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Member Secretary,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Central Pollution Control Board</td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We hereby apply for CONSENT/RENEWAL OF CONSENT under Section 21 of the Air (Prevention and Control of Pollution) Act, 1981 (14 of 1981) to bring into use a new/altered *stack for the discharge of emission/to begin to make new discharge of emission/to continue to discharge emission* from stack in industry owned by <input type="text" class="form-control text-uppercase" name="owner_name" value="<?php echo $owner_name; ?>" ></td>
										</tr>
										<tr>
											<td width="25%">1. Name of Owner/Occupier :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="occupier_name" value="<?php echo $occupier_name; ?>" ></td>
											<td width="25%">2. Name of Unit :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $unit_name; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">3. Address of Unit : </td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no; ?>"></td>
										</tr>
										<tr>
											<td colspan="4" align="right">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
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