<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="3";

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
		}else{		
			$form_id="";$father_name="";$nature_work="";
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
			$contractor_nwm="";$max_workers="";$contractor_d="";$contractor_d2="";
		}
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
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php echo $street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $vill; ?>"></td>
										<td>District<td>
                                        <td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $dist; ?>"></td>
									</tr>
							         <tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control" disabled value="<?php echo $pincode; ?>" ></td>
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
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
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
										
                            <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($manager_d);?>"  placeholder="Enter District" name="manager[d]">    
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
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
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
