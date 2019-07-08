<?php  require_once "../../requires/login_session.php";
$dept="tcp";
$form="6";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_tcp_form.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];
			$ref_uain=$results["ref_uain"];$ownername=$results["ownername"];$location=$results["location"];$submit_dt=$results["submit_dt"];$receive_dt=$results["receive_dt"];$engineer=$results["engineer"];$engineer_address=$results["engineer_address"];$development_name=$results["development_name"];$development_address=$results["development_address"];$drawings=$results["drawings"];$p_plot_no=$results["p_plot_no"];$p_block_no=$results["p_block_no"];
		}else{
			$form_id="";
			$ref_uain="";$ownername="";$location="";$submit_dt="";$receive_dt="";$officer_name="";$add_line1="";$add_line2="";$engineer="";$engineer_address="";$development_name="";$development_address="";$drawings="";$p_plot_no="";$p_block_no="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
		$ref_uain=$results["ref_uain"];$ownername=$results["ownername"];$location=$results["location"];$submit_dt=$results["submit_dt"];$receive_dt=$results["receive_dt"];$engineer=$results["engineer"];$engineer_address=$results["engineer_address"];$development_name=$results["development_name"];$development_address=$results["development_address"];$drawings=$results["drawings"];$p_plot_no=$results["p_plot_no"];$p_block_no=$results["p_block_no"];
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
										<?php $reference_uains=$formFunctions->executeQuery($dept,"select a.uain from tcp_form1 a,tcp_form1_process b where a.user_id='$swr_id' and b.form_id=a.form_id and b.process_type='I'");
										if($reference_uains->num_rows>0){ ?>
											<td width="25%">Please select the Reference UAIN for which you want to submit the progress report : </td>
											<td width="25%">
											<select name="ref_uain" class="form-control">
												<?php echo '<option value="">Please select</option>';
												while($rows=$reference_uains->fetch_object()){
													if($ref_uain=$rows->uain){
														echo '<option selected value="' . $rows->uain . '">'. $rows->uain .'</option>';
													}else{
														echo '<option value="' . $rows->uain . '">'. $rows->uain .'</option>';
													}
												} ?>
											</select>
											</td>										
										<?php   }else{ ?>
											<td width="25%">Please Enter the Reference No. for which you want to submit the progress report : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="ref_uain" id="ref_uain" value="<?php echo $ref_uain;?>"></td>
										<?php   }	?>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td>Owner's Name :</td>
											<td><input type="text"  class="form-control text-uppercase" name="ownername" value="<?php echo $ownername;?>"></td>
											<td>Location of the proposed site :</td>
											<td><textarea type="text"  class="form-control text-uppercase" name="location" ><?php echo $location;?></textarea></td>
										</tr>
										<tr>
											<td>Plot No. </td>
											<td><input type="text"  class="form-control text-uppercase" name="p_plot_no" value="<?php echo $p_plot_no;?>"></td>
											<td>Block No.</td>
											<td><input type="text"  class="form-control text-uppercase" name="p_block_no" value="<?php echo $p_block_no;?>"></td>
										</tr>
										<tr>
											<td>Submitted on :</td>
											<td><input type="text"  class="dob form-control text-uppercase" name="submit_dt" value="<?php echo $submit_dt;?>"></td>
											<td>Received on :</td>
											<td><input type="text"  class="dob form-control text-uppercase" name="receive_dt" value="<?php echo $receive_dt;?>"></td>
										</tr>
									</table>
									<table class="table table-responsive">								
										<tr>
											<td colspan="4" class="form-inline">
												Sir<br/>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The work of erection/re-erection of building as per approved plan is completed under the Supervision of Architect/Construction Engineer who have given the completion certificate which is enclosed herewith.<br/>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We declare that the work is executed as per the provisions of the Act and Development Control Regulations and to our satisfaction. We declare that the construction is to be used for &nbsp;<input type="text"  class="form-control text-uppercase" name="drawings"  value="<?php echo $drawings;?>">&nbsp;the purpose as per approved plan and it shall not be changed without obtaining written permission.<br/>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby declare that the plan as per the building erected has been submitted and approved. We have transferred the area of parking space provided as per approved plan to an individual/association before for occupancy certificate.<br/>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Any subsequent change from the completion drawings shall be our responsibility.
											</td>
										</tr>
										<tr>
											<td colspan="4">Yours faithfully,<br/>
										</tr>
										<tr>
											<td>Name of Developer / Builder (Developer's / Builder's Signature) </td>
											<td><input type="text"  class=" form-control text-uppercase" name="engineer" validate="letters" value="<?php echo $engineer;?>"></td>
											<td>Address of the Construction Engineer on Record </td>
											<td><textarea class="form-control text-uppercase" name="engineer_address"><?php echo $engineer_address;?></textarea></td>
										</tr>
										<tr>
											<td>Name of Owner(Signature of the Owner) </td>
											<td><input type="text"  class=" form-control text-uppercase" name="development_name" validate="letters" value="<?php echo $development_name; ?>"></td>
											<td>Address of the Owner/Development/Builder </td>
											<td><textarea class="form-control text-uppercase" name="development_address"><?php echo $development_address; ?></textarea></td>
										</tr>
										<tr>
											<td>Date : <strong><?=date('d-m-Y',strtotime($today));?></strong></td>
											<td></td>
											<td></td>
											<td align="right">Signature Of the Applicant : <strong><?php echo strtoupper($key_person);?></strong></td>
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
		</section>
	</div>
  <!-- /.content-wrapper -->
  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
