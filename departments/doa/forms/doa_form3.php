<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="3";
$ci->load->helper('get_uain_details');
$table_name=getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") or
		die($doa->error);
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$licence_no=$results["licence_no"];$licence_dt=$results["licence_dt"];$father_name=$results["father_name"];$virtue=$results["virtue"];
			
		}else{	
			$form_id="";$licence_no="";$licence_dt="";$father_name="";$virtue="";
		}
	}else{	
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$licence_no=$results["licence_no"];$licence_dt=$results["licence_dt"];$father_name=$results["father_name"];$virtue=$results["virtue"];
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
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
								<tr>
									<td colspan="4">To<br/>
									&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority ,<br/><br/>
									 <select class="form-control" style="width:300px" name="office_id" required>
                                        <option value="">Please Select</option>
										<?php
										$rows = $formFunctions->getOffices($dept);
                                        foreach($rows as $key => $values ){
											if($values["id"]!=6 && $values["id"]!=1){
												$jurisdiction = $values["jurisdiction"];
												$jurisdiction_array = explode(",",$jurisdiction); 
												//print_r($jurisdiction_array);echo "<br/><br/>";
												if(in_array(strtoupper($b_dist),$jurisdiction_array)){
													$address = $values["street1"]." ".$values["street2"].", ".$values["district"]." - ".$values["pin"];
													echo '<option value="'.$values["id"].'">'.$values["office_name"].', '.$address.'</option>';
												}												
											}												
										}
										?>											
									</select>
									<br/></td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">1. I / We  &nbsp;<input  type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"> &nbsp;of &nbsp;<input  type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase">&nbsp; hereby apply for the renewal of the licence to manufacture insecticides on the premises situated at&nbsp;<input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase">&nbsp;&nbsp;<input type="text" name="licence_no" value="<?php echo $licence_no; ?>" class="form-control text-uppercase" placeholder="Licence No.">&nbsp; <input type="text" name="licence_dt" value="<?php echo $licence_dt; ?>" class="dob form-control text-uppercase" placeholder="Licence Date">&nbsp; (Licence No. and date to be given).</td>	
								</tr>
								<tr>
									 <td colspan="4">2. The other details regarding the manufacture of the insecticides continue to remain the same. 	</td>				 
								</tr>
								<tr>
									<td colspan="4"><strong>Verification:</strong></td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">I &nbsp;<input  type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"> &nbsp;s/o &nbsp;<input  type="text" name="father_name" value="<?php echo $father_name; ?>" class="form-control text-uppercase">&nbsp; do hereby solemnly verify that what is stated above is true and correct to the best of my knowledge and belief.</td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">I further declare that I am making this application in my capacity as &nbsp;<input  type="text" disabled value="<?php echo $status_applicant; ?>" class="form-control text-uppercase"> &nbsp;(designation) and that I am competent to make this application and verify it, by virtue of  &nbsp;<input  type="text" name="virtue" value="<?php echo $virtue; ?>" class="form-control text-uppercase"> &nbsp; a photo / attested copy of which is enclosed.</td>
								</tr>
								<tr>
								   <td>Place :</td>
									<td><label disabled class="form-control text-uppercase" ><?php echo $dist; ?></label></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
								   <td>Date :</td>
									<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
									<td>Signature of applicant :</td>
									<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">
									<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	
$('#is_registration_details').attr('readonly','readonly');
	<?php if($is_registration == 'Y') echo "$('#is_registration_details').removeAttr('readonly','readonly');"; ?>
	$('.is_registration').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_registration_details').removeAttr('readonly','readonly');
		}else{
			$('#is_registration_details').attr('readonly','readonly');
			$('#is_registration_details').val('');
		}			
	});
	/* ----------------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------------- */
</script>