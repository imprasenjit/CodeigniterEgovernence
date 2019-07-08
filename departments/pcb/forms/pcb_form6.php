<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="6";
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
        $form_id=$results["form_id"];		
		$import_process=$results["import_process"];
	}else{	
        $form_id="";	
		$import_process="";		
	}
}else{			
	$results=$q->fetch_assoc();
	$form_id=$results["form_id"];	
	$import_process=$results["import_process"];
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
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<form name="myform1" id="myformBT3" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table  class="table table-responsive form-inline">
								    <tr>
								    	<td colspan="4">To<br/>
								    	The Member Secretary,<br/>
								    	State Pollution Control Board</td>
								    </tr>
									<tr>
										<td colspan="4">1. I &emsp;<input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"> &emsp;of &emsp;<input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"> &emsp;hereby submit that I am the process of importing &emsp;<input type="text" class="form-control text-uppercase" name="import_process" required="required" value="<?php echo $import_process; ?>" /> &emsp;(MT) of new lead acid batteries.</td>
										
									</tr>
									<tr>
				                        <td style="text-align:justify;" colspan="4">2. I undertake that I shall collect back the used batteries as per the schedule prescribed by the Government from time to time in lieu of the new batteries imported and sold, and shall send these only to the registered recyclers. I further undertake that I shall submit half-yearly returns as per item (iii) of rule 6 to the State Board and abide by their directions, if any.<br/></td>
  			                        </tr>  
									<tr>
										<td>Place</td>
										<td><?php echo $dist; ?></td>
										<td align="right"><label id="signature" name="signature" class="text-uppercase"><?php echo $key_person; ?></label></td>
										<td></td>										
									</tr>
									<tr>
										<td>Date</td>
										<td><?php echo $today; ?></td>
										<td align="right" width="60%">Signature of the Importer</td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save & Next</button>
										</td>
										<td></td>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>