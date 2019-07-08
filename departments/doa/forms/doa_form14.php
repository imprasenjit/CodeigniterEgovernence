<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="14";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form1.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	   if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$results=$p->fetch_array();	
				$form_id=$results["form_id"];$business=$results["business"];$licence_state=$results["licence_state"];$licence_no=$results["licence_no"];$day=$results["day"];$year=$results["year"];$licence_bearing_no=$results["licence_bearing_no"];$situated=$results["situated"];$renewed=$results["renewed"];
			}else{
				$form_id="";$business="";$licence_state="";$licence_no="";
				$day="";$year="";
				$licence_bearing_no=""; $situated="";$renewed="";
			}
		}else{	
            $results=$q->fetch_array();		
			$form_id=$results["form_id"];$business=$results["business"];$licence_state=$results["licence_state"];$licence_no=$results["licence_no"];$day=$results["day"];$year=$results["year"];$licence_bearing_no=$results["licence_bearing_no"];$situated=$results["situated"];$renewed=$results["renewed"];
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
									 <td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/we hereby apply for renewal of the Licence to carry on the business of dealer in seeds under the and style of Shri/ M/s&nbsp;<input type="text" name="business" value="<?php echo $business; ?>" class="form-control text-uppercase"> &nbsp;The licence, desired to be renewed, was granted by the Licensing Authority for the State of<input type="text" name="licence_state" value="<?php echo $licence_state; ?>" class="form-control text-uppercase">and allotted Licence No<input type="text" name="licence_no" value="<?php echo $licence_no; ?>" class="form-control text-uppercase"> &nbsp;on the day of &nbsp;<input type="text" name="day" value="<?php echo $day; ?>" class="form-control text-uppercase"> &nbsp; 20<input type="text" name="year" validate="onlyNumbers" maxlength="2" value="<?php echo $year; ?>" class="form-control text-uppercase">.</td>				 
								</tr>
								<tr>
								   <td>Full name and address of the applicant (s)</td>
							   </tr>
								<tr>
									<td width="25%">1. i. Name of the applicant :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									<td width="25%"></td>
									<td width="25%"></td>		
								</tr>
								<tr>
									 <td colspan="4">ii. Postal address of the applicant :  	</td>				 
								</tr>
								<tr>
									<td width="25%">Street name 1 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									<td width="25%">Street name 2 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>	
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
									<td>District :</td>
									<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
									<td>Mobile No. :</td>
									<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id :</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td></td>
									<td></td>									
								</tr>
								<tr>
								    <td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Certified that the Licence bearing No.<input type="text" name="licence_bearing_no" value="<?php echo $licence_bearing_no; ?>" class="form-control text-uppercase"> granted on to carry on the business of a dealer in seeds at the premises situated<input type="text" name="situated" value="<?php echo $situated;?>" class="form-control text-uppercase" >is hereby renewed up to <input type="text" name="renewed" value="<?php  echo $renewed; ?>" class=" dob form-control text-uppercase" >unless previously canceled or suspended under the provisions of the Seeds(Control) Order, 1983.</td>
                            </tr>
								<tr>
								   <td>Place:</td>
									<td><label disabled class="form-control text-uppercase" ><?php echo $dist; ?></label></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
								   <td>Date:</td>
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
	
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
$('#is_convicted_details').attr('readonly','readonly');
	<?php if($is_convicted == 'Y') echo "$('#is_convicted_details').removeAttr('readonly','readonly');"; ?>
	$('.is_convicted').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_convicted_details').removeAttr('readonly','readonly');
		}else{
			$('#is_convicted_details').attr('readonly','readonly');
			$('#is_convicted_details').val('');
		}			
	});	
</script>