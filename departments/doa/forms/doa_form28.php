<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="28";
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
				$form_id=$results["form_id"];
			}else{
				 $form_id="";
			}
		}else{	
			$results=$q->fetch_array();
			$form_id=$results["form_id"];				
	    }
?>
<?php require_once "../../requires/header.php";   ?>
	<?php include ("".$table_name."_Addmore.php"); ?>
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
											<td colspan="4">1. Name , address and status Of the applicant :</td>
										</tr>
										<tr>
											<td width="25%">Name of the applicant :</td>
											<td width="25%"><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">Address of the applicant :</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>2.Status of the Applicant :</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $status_applicant; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">3. Address of the premises where the manufacturing activity will be done :</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name1; ?>"	></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $b_email; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td colspan="4">4. Name of the insecticides with their registration number and date for which manufacturing license is applied:</td>
										</tr>
										<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
												<tr>
													<th width="10%">Slno</th>
													<th width="30%">Name of the insecticides</th>
													<th width="30%">Registration number</th>
													<th width="30%">Date Of Registration</th>
													
												</tr>
												<?php
												$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name_insecticides"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
														<td><input type="text" value="<?php echo $row_1["reg_number"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>" ></td>
														<td><input type="text" value="<?php echo $row_1["reg_date"]; ?>" id="txtD<?php echo $count;?>" class="dob form-control text-uppercase" size="10" name="txtD<?php echo $count;?>" ></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
													<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
													<td><input type="text" id="txtC1" size="10" class="form-control text-uppercase" name="txtC1" ></td>
													<td><input type="text" id="txtD1" size="10" class="dob form-control text-uppercase" name="txtD1" ></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
									<tr>
											<td colspan="3">Date :<label ><?php echo $today;?></label><br/>
											Place :<label><?php echo $dist;?></label></td>
											<td>Signature of the Applicant : <strong><?php echo strtoupper($key_person)?></strong></td>
											<td></td>
										</tr>					
									<tr>
										<td class="text-center" colspan="4">	
										 <button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Save and Next</button>
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
	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
	
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	
	$('#is_nonResidential_b').attr('readonly','readonly');
		<?php if($is_nonResidential_a == 'Y') echo "$('#is_nonResidential_b').removeAttr('readonly','readonly');"; ?>
		$('.is_nonResidential_a').on('change', function(){
			if($(this).val() == 'Y'){
				$('#is_nonResidential_b').removeAttr('readonly','readonly');
			}else{
				$('#is_nonResidential_b').attr('readonly','readonly');
				$('#is_nonResidential_b').val('');
			}			
		});
		
	$('#semi_residential_b').attr('readonly','readonly');
		<?php if($semi_residential_a == 'Y') echo "$('#semi_residential_b').removeAttr('readonly','readonly');"; ?>
		$('.semi_residential_a').on('change', function(){
			if($(this).val() == 'Y'){
				$('#semi_residential_b').removeAttr('readonly','readonly');
			}else{
				$('#semi_residential_b').attr('readonly','readonly');
				$('#semi_residential_b').val('');
			}			
		});
</script>