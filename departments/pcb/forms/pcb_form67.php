<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="67";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form_new1.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$address_authority=$results['address_authority'];$appeal_made=$results['appeal_made'];$sought_for=$results['sought_for'];
		
	}else{
		$form_id="";$address_authority="";$appeal_made="";$sought_for="";
		
	}
}else{
	    $results=$q->fetch_assoc();
	    $form_id=$results['form_id'];
		$address_authority=$results['address_authority'];$appeal_made=$results['appeal_made'];$sought_for=$results['sought_for'];
		
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
										<td colspan="2">1.Name and address of the person making the appeal  </td>
									</tr>
									<tr>
										<td>Name of the person</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $key_person; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
										<tr>
											<td width="25%">2. Number, date of order and address of the authority which passed the order, against which appeal is being made</td>
											<td><textarea class="form-control text-uppercase" name="address_authority"><?php echo $address_authority;?></textarea></td>
											
											<td width="25%">3.Ground on which the appeal is being made  </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="appeal_made" value="<?php echo $appeal_made;?>" ></td>
											
										</tr>
										<tr>
											<td width="25%">4.Relief sought for </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="sought_for" value="<?php echo $sought_for;?>" ></td>
											
											<td width="25%">List of enclosures other than the order referred in point 2 against which the appeal is being filed.</td>
											<td width="25%">Upload later in upload section</td>
										</tr>
										
										<tr>
											<td colspan="2" align="left"><br/> Date :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right"><br/> Signature :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong></td>
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