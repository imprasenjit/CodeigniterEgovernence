<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="4";

$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$total_grant=$results["total_grant"];$max_workers=$results["max_workers"];
		}else{	
			$form_id="";$total_grant="";$max_workers="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$total_grant=$results["total_grant"];$max_workers=$results["max_workers"];
	}
?>
<?php require_once "../../requires/header.php";   ?>
	<?php include "lc_reg_form".$form."_Addmore-operation.php" ?>
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td width="25%">1. Name of the Plantation</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $unit_name; ?>" disabled></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">2. Full address to which communication relating to the plantation should be sent</td>
									</tr>
									<tr>
										<td >Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control" disabled value="<?php echo $b_pincode; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>3. Total grant of the plantation in hectares (hectares of land used or intended to be used or intended to be used for the purposes of plantation)<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" placeholder="Please enter numeric approximate value " name="total_grant" validate="onlyNumbers" required="required" value="<?php echo $total_grant; ?>" ></td>
										<td>4. Maximum number of workers (Permanent, <br/>temporary, casual, taken together) employed <br/>on any day during the preceding calendar year.:<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control" name="max_workers" required="required" value="<?php echo $max_workers; ?>" validate="onlyNumbers" ></td>
									</tr>
									<tr>
										<td colspan="4">5. Full name(s) and residential address(es) of the--<br/>(i)Proprietor's of the plantation in case it is not registered under the Companies Act, 1956.</td>
								    </tr>
									<tr>
									    <td colspan="4">  
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
										<tbody>
											<tr>
												<td width="5%" align="center">Sl. No.</td>
												<td width="15%" align="center" >Full Name</td>
												<td width="15%" align="center">Street Name 1</td>
												<td width="15%" align="center">Street Name 2</td>
												<td width="15%" align="center">Town/Vill</td>
												<td width="15%" align="center">District</td>
												<td width="10%" align="center">Pin Code</td>
											</tr>
			<?php 

				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				$num = $part1->num_rows;
				if($num>0){
					$count=1;
					while($row_1=$part1->fetch_array())
					{
					?>	<tr>

							<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["field1"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>

							<td><input value="<?php echo $row_1["field2"]; ?>" validate="letters" id="txtB<?php echo $count;?>"  class="form-control text-uppercase" size="15" name="txtB<?php echo $count;?>"></td>

							<td><input value="<?php echo $row_1["field3"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="15"></td>
							
							<td><input value="<?php echo $row_1["field4"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="15"></td>

							<td><input value="<?php echo $row_1["field5"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="15"></td>

							<td><input value="<?php echo $row_1["field6"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"  size="10"></td>
							
							<td><input value="<?php echo $row_1["field7"]; ?>"  title="Enter 6 Digit Pin Code" id="txtA<?php echo $count;?>" validate="pincode" maxlength="6" class="form-control text-uppercase" name="txtG<?php echo $count;?>" size="5" ></td>

							</tr>
					<?php 
					$count++;}
				}
				else 
				{
					?>
					<tr>
							<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>

							<td><input id="txtB1" size="20" validate="letters" class="form-control text-uppercase" name="txtB1"></td>					

							<td><input  id="txtC1" size="15" class="form-control text-uppercase"  name="txtC1"></td>

							<td><input id="txtD1" size="15" class="form-control text-uppercase" name="txtD1"></td>

							<td><input id="txtE1" size="15" class="form-control text-uppercase" name="txtE1"></td>

							<td><input id="txtF1"  size="15" class="form-control text-uppercase" name="txtF1"></td>
							
							<td><input id="txtG1" size="5" class="form-control text-uppercase" validate="pincode" maxlength="6" title="Enter 6 Digit Pin Code" name="txtG1"></td>
					</tr>
				<?php } ?>
						<tbody>
				</table>
			    </td>
			</tr>
				<tr>
					<td colspan="4">
						
						<button type="button" class="btn btn-default pull-right" href="#" onClick="mydelfunction4()" value="">Delete</button>
						<button type="button" class="btn btn-default pull-right" href="#" onClick="addmore1()" value="">Add More</button>
						<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
					</td>
				</tr>	
				<tr>
					<td colspan="4">(ii) Partner's of the plantation in case it is not registered under the Companies Act, 1956. :</td>
				</tr>
				<tr>
					<td colspan="4">  
					<table name="objectTable2" id="objectTable2" class="table table-responsive">
						<tbody>
					
											<tr>
												<td width="5%" align="center">Sl. No.</td>
												<td width="15%" align="center" >Full Name</td>
												<td width="15%" align="center">Street Name 1</td>
												<td width="15%" align="center">Street Name 2</td>
												<td width="15%" align="center">Town/Vill</td>
												<td width="15%" align="center">District</td>
												<td width="10%" align="center">Pin Code</td>
											</tr>
											<?php 
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				$num = $part2->num_rows;
				if($num>0){
					$count=1;
					while($row_2=$part2->fetch_array())
					{	?>
					<tr>
						<td><input readonly="readonly" id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["field1"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>

						<td><input value="<?php echo $row_2["field2"]; ?>" id="txttB<?php echo $count;?>"  class="form-control text-uppercase" size="20" validate="letters" name="txttB<?php echo $count;?>"></td>

						<td><input value="<?php echo $row_2["field3"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" name="txttC<?php echo $count;?>" size="15"></td>
						
						<td><input value="<?php echo $row_2["field4"]; ?>" id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="15"></td>

						<td><input value="<?php echo $row_2["field5"]; ?>" id="txttE<?php echo $count;?>" class="form-control text-uppercase" name="txttE<?php echo $count;?>" size="10"></td>

						<td><input value="<?php echo $row_2["field6"]; ?>" id="txttF<?php echo $count;?>" class="form-control text-uppercase" name="txttF<?php echo $count;?>"  size="10"></td>
						
						<td><input value="<?php echo $row_2["field7"]; ?>" class="form-control text-uppercase" validate="pincode" maxlength="6" title="Enter 6 Digit Pin Code" id="txttG<?php echo $count;?>"  name="txttG<?php echo $count;?>" size="5" ></td>

					</tr>
					<?php $count++;
					}
				}
				else 
					{?>
					<tr>
							<td><input value="1" readonly="readonly" id="txttA1" size="1" class="form-control text-uppercase"  name="txttA1"></td>

							<td><input id="txttB1" size="20" validate="letters"   class="form-control text-uppercase" name="txttB1"></td>					

							<td><input  id="txttC1" size="15" class="form-control text-uppercase" name="txttC1"></td>

							<td><input id="txttD1" size="15" class="form-control text-uppercase"  name="txttD1"></td>

							<td><input id="txttE1" size="10" class="form-control text-uppercase" name="txttE1"></td>

							<td><input id="txttF1" class="form-control text-uppercase" size="10"  name="txttF1"></td>
							
							<td><input id="txttG1" class="form-control text-uppercase"size="10"  validate="pincode" maxlength="6" title="Enter 6 Digit Pin Code" name="txttG1"></td>
					</tr>
				<?php } ?>
				<tbody>
				</table>
			    </td>
			</tr>
			<tr>
				<td colspan="4">
						
					<button type="button" class="btn btn-default pull-right" href="#" onClick="mydelfunction5()" value="">Delete</button>
					<button type="button" class="btn btn-default pull-right" href="#" onClick="addmore2()" value="">Add More</button>
					<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
				</td>
			</tr>
																		
			<tr>
				<td colspan="4"> 6. Full name and residential address (es) of the Directors in the case of a Company registered under the Companies Act, 1956.</td>
			</tr>
			<tr>
			    <td colspan="4">  
				<table name="objectTable3" id="objectTable3" class="table table-responsive">
				<tbody>
											<tr>
												<td width="5%" align="center">Sl. No.</td>
												<td width="15%" align="center" >Full Name</td>
												<td width="15%" align="center">Street Name 1</td>
												<td width="15%" align="center">Street Name 2</td>
												<td width="15%" align="center">Town/Vill</td>
												<td width="15%" align="center">District</td>
												<td width="10%" align="center">Pin Code</td>
											</tr>
											<?php 

				$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
				$num = $part3->num_rows;
				if($num>0){
					$count=1;
					while($row_3=$part3->fetch_array())
					{	
					?>
							<tr>
							<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["field1"]; ?>" name="textA<?php echo $count;?>" size="1"></td>

							<td><input value="<?php echo $row_3["field2"]; ?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" size="20"  validate="letters" name="textB<?php echo $count;?>"></td>

							<td><input value="<?php echo $row_3["field3"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="15"></td>
							
							<td><input value="<?php echo $row_3["field4"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="15"></td>

							<td><input value="<?php echo $row_3["field5"]; ?>" id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" size="10"></td>

							<td><input value="<?php echo $row_3["field6"]; ?>" id="textF<?php echo $count;?>" class="form-control text-uppercase" name="textF<?php echo $count;?>"  size="10"></td>
							
							<td><input value="<?php echo $row_3["field7"]; ?>" class="form-control text-uppercase" validate="pincode" maxlength="6" title="Enter 6 Digit Pin Code" id="textA<?php echo $count;?>"  name="textG<?php echo $count;?>" size="5" ></td>

							</tr>
					<?php $count++;
					}
				}
				else 
				{?>
					<tr>
							<td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>

							<td><input id="textB1" size="20" validate="letters"   class="form-control text-uppercase" name="textB1"></td>					

							<td><input  id="textC1" size="15" class="form-control text-uppercase" name="textC1"></td>

							<td><input id="textD1" size="15" class="form-control text-uppercase" name="textD1"></td>

							<td><input id="textE1" size="10" class="form-control text-uppercase" name="textE1"></td>

							<td><input id="textF1"  size="10" class="form-control text-uppercase" name="textF1"></td>
							
							<td><input id="textG1" size="5" class="form-control" validate="pincode" maxlength="6" title="Enter 6 Digit Pin Code" name="textG1"></td>
					</tr>
				<?php } ?>
					<tbody>
				</table>
			    </td>
			    </tr>
			    <tr>
				<td colspan="4">
						
					<button type="button" class="btn btn-default pull-right" href="#" onClick="mydelfunction6()" value="">Delete</button>
					<button type="button" class="btn btn-default pull-right" href="#" onClick="addmore3()" value="">Add More</button>
					<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/>
				</td>
			</tr>
									
									
			<tr>
				<td colspan="4">7. Full name and address(es) of the Chief Executives or General Manager of the Plantation in the Public Sector  </td>
			</tr>
			<tr>
			    <td colspan="4">  
				    <table name="objectTable4" id="objectTable4" class="table table-responsive">
				    <tbody>
											<tr>
												<td width="5%" align="center">Sl. No.</td>
												<td width="15%" align="center" >Full Name</td>
												<td width="15%" align="center">Street Name 1</td>
												<td width="15%" align="center">Street Name 2</td>
												<td width="15%" align="center">Town/Vill</td>
												<td width="15%" align="center">District</td>
												<td width="10%" align="center">Pin Code</td>
											</tr>
											<?php 
				$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
				$num = $part4->num_rows;
				if($num>0){
					$count=1;
					while($row_4=$part4->fetch_array())
					{?>
							<tr>

							<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["field1"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>

							<td><input value="<?php echo $row_4["field2"]; ?>" id="texttB<?php echo $count;?>" class="form-control text-uppercase" size="20" validate="letters" name="texttB<?php echo $count;?>"></td>

							<td><input value="<?php echo $row_4["field3"]; ?>" id="texttC<?php echo $count;?>" class="form-control text-uppercase" name="texttC<?php echo $count;?>" size="15"></td>
							
							<td><input value="<?php echo $row_4["field4"]; ?>" id="texttD<?php echo $count;?>" class="form-control text-uppercase" name="texttD<?php echo $count;?>" size="15"></td>

							<td><input value="<?php echo $row_4["field5"]; ?>" id="texttE<?php echo $count;?>" class="form-control text-uppercase" name="texttE<?php echo $count;?>" size="10"></td>

							<td><input value="<?php echo $row_4["field6"]; ?>" id="texttF<?php echo $count;?>" class="form-control text-uppercase" name="texttF<?php echo $count;?>"  size="10"></td>
							
							<td><input value="<?php echo $row_4["field7"]; ?>" class="form-control text-uppercase" validate="pincode" maxlength="6" title="Enter 6 Digit Pin Code" id="texttA<?php echo $count;?>"  name="texttG<?php echo $count;?>" size="5" ></td>

							</tr>	
					<?php $count++;
					}
				}else 
				{?>
					<tr>
							<td><input value="1" readonly="readonly" id="texttA1" size="1" class="form-control text-uppercase" name="texttA1"></td>

							<td><input id="texttB1" size="20" validate="letters" class="form-control text-uppercase"name="texttB1"></td>					

							<td><input  id="texttC1" size="15" class="form-control text-uppercase"  name="texttC1"></td>

							<td><input id="texttD1" size="15" class="form-control text-uppercase" name="texttD1"></td>

							<td><input id="texttE1" size="10" class="form-control text-uppercase" name="texttE1"></td>

							<td><input id="texttF1"  size="10" class="form-control text-uppercase" name="texttF1"></td>
							
							<td><input id="texttG1" size="5" class="form-control text-uppercase" validate="pincode" maxlength="6" title="Enter 6 Digit Pin Code" name="texttG1"></td>

					</tr>
				<?php } ?>
					<tbody>
				</table>
			    </td>
			    </tr>
			    <tr>
				<td colspan="4">
						
					<button type="button" class="btn btn-default pull-right" href="#" onClick="mydelfunction7()" value="">Delete</button>
					<button type="button" class="btn btn-default pull-right" href="#" onClick="addmore4()" value="">Add More</button>
					<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/>
				</td>
			</tr>
					<tr>
						<td><br/><br/>Date : <label class=" text-uppercase" ><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
						<td></td>
						<td></td>
						<td align="center"><br/><br/>Signature of the Applicant : <label class=" text-uppercase" ><?php echo strtoupper($key_person); ?></label><br/>
						<label class="text-uppercase" ><?php echo $status_applicant; ?></label></td>
					</tr>
					<tr>
						<td class="text-center" colspan="4">
							<button type="submit" name="save<?php echo $form;?>" class="btn btn-success submit1">Save and Next</button>
						</td>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
