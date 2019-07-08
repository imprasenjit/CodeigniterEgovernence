<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="3";
$table_name=$formFunctions->getTableName($dept,$form);

$check=$formFunctions->is_already_registered($dept,$form);
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=".$dept."';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=".$form."&dept=".$dept."';
		</script>";
}else if($check==3){
	echo "<script>
			window.location.href = '".$server_url."departments/requires/payment_section.php?form=".$form."&dept=".$dept."';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_form.php";
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and active='1'");

	if($q->num_rows<1){ ################ Empty Form Details #################		
		$form_id="";$father_name="";$nature_work="";
		$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
		$contractor_nwm="";$max_workers="";$contractor_d="";$contractor_d2="";
		//$treasury_name="";$treasury_amt="";$treasury_d3="";
	}else{ ############ Not Empty Form Details #############
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$father_name=$results["father_name"];$nature_work=$results["nature_work"];$max_workers=$results["max_workers"];
				
		if(!empty($results["manager"])){				
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_p=$manager->p;				
		}else{
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
		}	
		if(!empty($results["contractor"])){				
			$contractor=json_decode($results["contractor"]);
			$contractor_nwm=$contractor->nwm;$contractor_d=$contractor->d;$contractor_d2=$contractor->d2;				
		}else{
			$contractor_nwm="";$contractor_d="";$contractor_d2="";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
	</style>
	<?php include "lc_reg_form".$form."_Addmore-operation.php" ?> <!-- File handles 'Addmore' Operation -->
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
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
										<td  width="25%">1. (a) Name of Establishment, if any </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $unit_name; ?>" disabled></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Location of The Establishment </td>
									</tr>
									<tr>
										<td>Street Name 1</td>
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
										<td><input type="text" class="form-control" maxlength="6" disabled value="<?php echo $b_pincode; ?>"></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="4">2. Postal address of the Establishment(Alternate Address) </td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name3; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php echo $b_street_name4; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill2; ?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist2; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control" disabled value="<?php echo $b_pincode2; ?>" ></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="4">3. Full name and address of the Principal Employer (furnish father's name in the case of individuals) </td>
									</tr>
									<tr>
										<td>Full Name</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $key_person; ?>"></td>
										<td>Father Name</td>
										<td><input type="text" class="form-control text-uppercase" name="father_name" value="<?php echo $father_name; ?>"></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $vill; ?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control" maxlength="6" disabled value="<?php echo $pincode; ?>" ></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="4">4. Names and address of the Directors/particular Partners (in case of companies and firms).</td>
									</tr>
									<tr>
									<td colspan="4">  
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center" width="5%">Sl. No.</td>
												<td align="center" width="20%">Full Name</td>
												<td align="center" width="15%">Street Name 1</td>
												<td align="center" width="15%">Street Name 2</td>
												<td align="center" width="15%">Town/Vill</td>
												<td align="center" width="15%">District</td>
												<td align="center" width="15%">Pin Code</td>
											<?php 
				$part1=$labour->query("SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				$num = $part1->num_rows;
				if($num>0){
					$count=1;
					while($row_1=$part1->fetch_array())
					{?>	
						<tr>

							<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["field1"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>

							<td><input value="<?php echo $row_1["field2"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" size="20" validate="letters" name="txtB<?php echo $count;?>"></td>

							<td><input value="<?php echo $row_1["field3"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="15"></td>
							
							<td><input value="<?php echo $row_1["field4"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="15"></td>

							<td><input value="<?php echo $row_1["field5"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="15"></td>

							<td><input value="<?php echo $row_1["field6"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"  size="15"></td>
							
							<td><input value="<?php echo $row_1["field7"]; ?>"   title="Enter 6 Digit Pin Code" id="txtG<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>"validate="pincode"  maxlength="6" size="15" ></td>

							</tr>
						<?php 
					$count++;}
				}
				else 
				{?>
					<tr>
							<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>

							<td><input id="txtB1" size="20" validate="letters" class="form-control text-uppercase" name="txtB1"></td>					

							<td><input  id="txtC1" size="15" class="form-control text-uppercase"  name="txtC1"></td>

							<td><input id="txtD1" size="15" class="form-control text-uppercase" name="txtD1"></td>

							<td><input id="txtE1" size="15" class="form-control text-uppercase" name="txtE1"></td>

							<td><input id="txtF1" size="15" class="form-control text-uppercase" name="txtF1"></td>
							
							<td><input id="txtG1" size="15" class="form-control text-uppercase" validate="pincode"  maxlength="6"  title="Enter 6 Digit Pin Code" name="txtG1"></td>
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
										<td colspan="4">5. Full name and Address of the Manager or person responsible for the supervision and Control of the establishment. :</td>
									</tr>
									<tr>
										<td>Full Name<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="manager[name]" validate="letters" value="<?php echo $manager_name; ?>" required ></td>
										<td>Street Name 1<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" validate="jsonObj" value="<?php echo $manager_sn1; ?>" name="manager[sn1]"  required ></td>
									</tr>
									
									<tr>
										<td>Street Name 2<span class="mandatory_field">*</span></td>
										<td><input type="text" validate="jsonObj" class="form-control text-uppercase" name="manager[sn2]" value="<?php echo $manager_sn2; ?>" required></td>
										<td>Village/Town<span class="mandatory_field">*</span></td>
										<td><input type="text" validate="jsonObj" class="form-control text-uppercase" name="manager[v]" value="<?php echo $manager_v; ?>"  required></td>
									</tr>
									<tr>
										<td>District</td>
										<td>
										<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
							<select name="manager[d]" id="m_dist" validate="jsonObj" class="form-control text-uppercase"><?php
								while($dstrows=$dstresult->fetch_object()) { 
								if($manager_d==$dstrows->district) $s='selected'; else $s=''; ?>
								<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							<?php } ?>					
							</select>
							</td>
										<td>Pincode<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control" name="manager[p]" validate="pincode" maxlength="6"  placeholder="Enter 6 digit Pin Code" title="Enter 6 digit Pin Code" value="<?php echo $manager_p; ?>" validate="pincode" required></td>
									</tr>
									<tr>
										<td>6. Nature of work :</td>
										<td><textarea class="form-control text-uppercase" maxlength="255" validate="textarea" name="nature_work"> <?php echo $nature_work?></textarea></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">7. Particulars of Contractors and migrant workman- <br/>
										(a) Names and addresses of Contractors.
										</td>
									</tr>
									<tr>
									<td colspan="4">
										<table name="objectTable2" id="objectTable2" class="table table-responsive">
							              <tbody>
											<tr>
												<td align="center" width="5%">Sl. No.</td>
												<td align="center" width="20%">Full Name</td>
												<td align="center" width="15%">Street Name 1</td>
												<td align="center" width="15%">Street Name 2</td>
												<td align="center" width="15%">Town/Vill</td>
												<td align="center" width="15%">District</td>
												<td align="center" width="15%">Pin Code</td>
											</tr>
											<?php 
				$part2=$labour->query("SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				$num = $part2->num_rows;
				if($num>0)
				{
					$count=1;
					while($row_2=$part2->fetch_array())
					{?>
						<tr>
							<td><input readonly="readonly" id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["field1"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>

							<td><input type="text" value="<?php echo $row_2["field2"]; ?>" id="txttB<?php echo $count;?>"  class="form-control text-uppercase" size="20" validate="letters"  name="txttB<?php echo $count;?>"></td>

							<td><input type="text" value="<?php echo $row_2["field3"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" name="txttC<?php echo $count;?>" size="15"></td>
							
							<td><input type="text" value="<?php echo $row_2["field4"]; ?>" id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="15"></td>

							<td><input type="text" value="<?php echo $row_2["field5"]; ?>" id="txttE<?php echo $count;?>" class="form-control text-uppercase" name="txttE<?php echo $count;?>" size="15"></td>

							<td><input type="text" value="<?php echo $row_2["field6"]; ?>" id="txttF<?php echo $count;?>" class="form-control text-uppercase" name="txttF<?php echo $count;?>"  size="15"></td>
							
							<td><input type="text" value="<?php echo $row_2["field7"]; ?>"title="Enter 6 Digit Pin Code" id="txttG<?php echo $count;?>" class="form-control text-uppercase" name="txttG<?php echo $count;?>"validate="pincode"  maxlength="6"  size="15" ></td>

							</tr><?php 
					$count++;
					}
				}
				else 
				{
					?>
					<tr>
							<td><input value="1" readonly="readonly" id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>

							<td><input type="text" id="txttB1" size="20" validate="letters" class="form-control text-uppercase" name="txttB1"></td>					

							<td><input type="text" id="txttC1" size="15" class="form-control text-uppercase" name="txttC1"></td>

							<td><input type="text" id="txttD1" size="15" class="form-control text-uppercase" name="txttD1"></td>

							<td><input type="text" id="txttE1" size="15" class="form-control text-uppercase" name="txttE1"></td>

							<td><input type="text" id="txttF1"  size="15" class="form-control text-uppercase" name="txttF1"></td>
							
							<td><input type="text" id="txttG1" size="15" class="form-control text-uppercase" validate="pincode"  maxlength="6" title="Enter 6 Digit Pin Code" name="txttG1"></td>
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
						<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval; ?>"/>
					</td>
				</tr>
									<tr>
										<td>(b) Nature of work for which migrant workmen are<br/> to be recruited or are employed.:</td>
										<td><input type="text" validate="jsonObj" class="form-control text-uppercase" name="contractor[nwm]" value="<?php echo $contractor_nwm; ?>" ></td>
										<td>(c) Maximum number of migrant workmen <br/>to be employed on any day through each Contractor.:<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" required="required" name="max_workers" value="<?php echo $max_workers; ?>"></td>
									</tr>
									<tr>
										<td>(d) Date of commencement of work under each Contractor.:</td>
										<td><input type="datetime" class="dob form-control" name="contractor[d]" value="<?php echo $contractor_d; ?>">
										</td>
										<td>(e) Estimated date of termination of <br/>employment of migrant workmen under <br/>each Contractor.:
										</td>
										<td><input type="datetime" class="dob form-control" placeholder="DD/MM/YYYY" name="contractor[d2]" value="<?php echo $contractor_d2; ?>">
										</td>
									</tr>
									<!--<tr>
										<td colspan="4">8. Particulars of treasury Receipt or the crossed Postal Order enclose : </td>
									</tr>
									<tr>
										<td> Name of the treasury:</td>
										<td><input type="text" class="form-control text-uppercase" name="treasury[name]" title="No special characters are allowed except Dot"  value="<?php echo $treasury_name; ?>"></td>
										<td>Amount:</td>
										<td><input type="text" class="form-control" value="<?php echo $treasury_amt; ?>" validate="decimal" name="treasury[amt]" ></td>										
									</tr>
									<tr>
										<td>Date:<br/><br/><br/><br/></td>
										<td><input type="datetime"  class="dob form-control" placeholder="DD/MM/YYYY" name="treasury[d3]"  value="<?php echo $treasury_d3; ?>"></td>
										<td></td>											
										<td></td>											
									</tr>-->
									<tr>
										<td > Date : <label class="text-uppercase"><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
										<td></td>
										<td></td>
										<td align="right">Signature of the Principal Employer : <label class="text-uppercase"><?php echo strtoupper($key_person); ?></label> </td>
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
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
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
</script>
</body>
</html>