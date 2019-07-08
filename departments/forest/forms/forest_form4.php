<?php  require_once "../../requires/login_session.php";
$dept="forest";
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
			$form_id=$results['form_id'];
			
			$ref_uain=$results['ref_uain'];$hiddenval=$results['hiddenval'];
			$permit_no=$results['permit_no'];$permit_date=$results['permit_date'];$locality_whence_collected=$results['locality_whence_collected'];$transported_place=$results['transported_place'];$destination=$results['destination'];$transport_route=$results['transport_route'];$transport_date=$results['transport_date'];$expire_date=$results['expire_date'];
			
		}else{
			$form_id="";
			$ref_uain="";$hiddenval="";
			$permit_no="";$permit_date="";$locality_whence_collected="";
			$transported_place="";$destination="";$transport_route="";
			$transport_date="";$expire_date="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$ref_uain=$results['ref_uain'];$hiddenval=$results['hiddenval'];
		$permit_no=$results['permit_no'];$permit_date=$results['permit_date'];$locality_whence_collected=$results['locality_whence_collected'];$transported_place=$results['transported_place'];$destination=$results['destination'];$transport_route=$results['transport_route'];$transport_date=$results['transport_date'];$expire_date=$results['expire_date'];
		
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td>Choose the UAIN of the Certificate of Origin :</td>
										<td>
											<select name="ref_uain" id="ref_uain" onchange="select_ref_uain()" class="form-control text-uppercase" required>
												<option value="">Please Select</option>
												<?php
												if($ref_uain!=""){?>
													<option value="<?=strtoupper($ref_uain)?>" selected ><?=strtoupper($ref_uain)?></option>		
												<?php				
												}
													$query_reg_form="SELECT uain FROM forest_form2 a, forest_form2_process b WHERE a.user_id='$swr_id' AND b.form_id=a.form_id AND (b.process_type='I' OR b.process_type='C') AND a.active='0' GROUP BY uain";
													$exec_query_reg_form=$formFunctions->executeQuery("forest",$query_reg_form);
													while($reg_res=$exec_query_reg_form->fetch_object()){
												?>
												<option value="<?=strtoupper($reg_res->uain)?>"><?=strtoupper($reg_res->uain)?></option>
												<?php } 
												?>
											</select>
									</td>
										<td colspan="2" align="right"></td>
									</tr>
									<tr>
										<td colspan="4">1. Name and residence of the Passholder :</td>
									</tr>
									<tr>
										<td width="25%">Name</td>
										<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
										<td>Street Name 2</td>
										<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
										<td>District</td>
										<td><input type="text" disabled value="<?php echo $dist; ?>"  class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
										<td>Mobile</td>
										<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>Phone Number</td>
										<td><input type="text" disabled value="<?php echo $b_landline_std.'-'.$b_landline_no; ?>" class="form-control"></td>
										<td>Email id</td>
										<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td colspan="4">2. Number and date of permit or Certificate of Origin :</td>
									</tr>
									<tr>
										<td>Number</td>
										<td><input type="text" name="permit_no"  value="<?php echo $permit_no; ?>" class="form-control text-uppercase"></td>
										<td>Date</td>
										<td><input type="text" name="permit_date"  value="<?php echo $permit_date; ?>" class="dobindia form-control text-uppercase"></td>
									</tr>
									
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
													<thead>
														<tr>
															<th width="5%" align="center">Sl. No.</th>
															<th width="20%" align="center">Kind of forest produce</th>
															<th width="15%" align="center">Number of pieces packages or bundles</th>
															<th width="15%" align="center">Measurement Cubic consents or weight</th>
															<th width="15%" align="center">Marks hammar or Other</th>
															<th width="15%" align="center">Rate</th>
															<th width="15%" align="center">Amount Paid</th>
														</tr>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tbody>
													<tr>
														
														<td><input id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>"  name="txtA<?php echo $count;?>" size="1" readonly="readonly"></td>
														
														<td><input value="<?php echo $row_1["forest_produce"]; ?>" class="form-control text-uppercase" id="txtB<?php echo $count;?>" style="text-transform: uppercase;" size="15" name="txtB<?php echo $count;?>"></td>
														
														<td><input value="<?php echo $row_1["no_of_pieces"]; ?>" class="form-control text-uppercase" id="txtC<?php echo $count;?>" style="text-transform: uppercase;" size="15" name="txtC<?php echo $count;?>"></td>
														
														<td><input value="<?php echo $row_1["measurement"]; ?>" class="form-control text-uppercase" id="txtD<?php echo $count;?>" style="text-transform: uppercase;" size="15" name="txtD<?php echo $count;?>"></td>
														
														<td><input value="<?php echo $row_1["marks_hammar"]; ?>" class="form-control text-uppercase" id="txtE<?php echo $count;?>" style="text-transform: uppercase;" size="15" name="txtE<?php echo $count;?>"></td>
														
														<td><input value="<?php echo $row_1["rate"]; ?>" class="form-control text-uppercase" id="txtF<?php echo $count;?>" style="text-transform: uppercase;" size="15" name="txtF<?php echo $count;?>"></td>
														
														<td><input value="<?php echo $row_1["amt_paid"]; ?>" class="form-control text-uppercase" id="txtG<?php echo $count;?>" style="text-transform: uppercase;" size="15" name="txtG<?php echo $count;?>"></td>
														
														
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														
														<td><input value="1" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="15" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="15" class="form-control text-uppercase" name="txtC1"></td>
														<td><input id="txtD1" size="15" class="form-control text-uppercase" name="txtD1"></td>
														<td><input id="txtE1" size="15" class="form-control text-uppercase" name="txtE1"></td>
														<td><input id="txtF1" size="15" class="form-control text-uppercase" name="txtF1"></td>
														<td><input  id="txtG1" size="15" class="form-control text-uppercase" name="txtG1"></td>
													</tr>
													<?php } ?>
													</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#" onclick="mydelfunction4()" value="">Delete</button>
											<button type="button"  class="btn btn-default pull-right" onclick="addmore()" value="">Add More</button>	
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</td>
									</tr>
									
									<tr>
										<td>3. Locality Whence collected :</td>
										<td><input type="text" name="locality_whence_collected"  value="<?php echo $locality_whence_collected; ?>" class="form-control text-uppercase"></td>
										<td>4. Place From which to be transported :</td>
										<td><input type="text" name="transported_place"  value="<?php echo $transported_place; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>5. Destination :</td>
										<td><input type="text" name="destination"  value="<?php echo $destination; ?>" class="form-control text-uppercase"></td>
										<td>6. Route Of Transport :</td>
										<td><input type="text" name="transport_route"  value="<?php echo $transport_route; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>7. Date of transportation :</td>
										<td><input type="text" name="transport_date"  value="<?php echo $transport_date; ?>" class="dobindia form-control"></td>
										<td>8. Date of Expiry :</td>
										<td><input type="text" name="expire_date"  value="<?php echo $expire_date; ?>" class="dobindia form-control" ></td>                              
									</tr>
									<tr>
										<td colspan="4">Signature of the Passholder with Date :</td>
									</tr>
									<tr>
										<td>Date :</td>
										<td><label class="text-uppercase"><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
										<td>Signature of the Passholder :</td>
										<td> <label class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="submit_tp" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">Submit</button>
										</td>
									</tr>
								</table>
								</form>
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
	/* ---------------------upload S/C click operation-------------------- */
	
	function select_ref_uain(){
		 if($("#ref_uain").val()==false){
			alert("Please select the reference UAIN !");
			$("#ref_uain").focus();
			return ;			
		}else{
			var ref_uain = $("#ref_uain").val();
		}
        
		$.ajax({
            type: "POST",
            url: "transit_pass_tree_details.php",
            data: { ref_uain: ref_uain},
            beforeSend:function(){
                $("#tree_details").html("<img src='../../../images/loading.gif' style='width:200px; height:150px; margin:250px auto'>");
            },
            success:function(data){
                $("#tree_details").html(data);
				$('table.search-table').tableSearch({
					searchText:'Search Table',
					searchPlaceHolder:'SEARCH HERE',
					divStyle:'float:right'
				});
            }
        });
	 }
		
	
</script>
