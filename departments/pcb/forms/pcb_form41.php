<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="41";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_plastic_form.php";

		
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results["form_id"];
		$manuf_capacity=$results["manuf_capacity"];$is_reg_dcssi=$results["is_reg_dcssi"];$min_sizes_cb=$results["min_sizes_cb"];$compliance_status=$results["compliance_status"];$water_valid_consent=$results["water_valid_consent"];$air_valid_consent=$results["air_valid_consent"];
			
		if(!empty($results["reg_manufacture"])){
			$reg_manufacture=json_decode($results["reg_manufacture"]);
			if(isset($reg_manufacture->a)) $reg_manufacture_a=$reg_manufacture->a;
			if(isset($reg_manufacture->b)) $reg_manufacture_b=$reg_manufacture->b;
			if(isset($reg_manufacture->c)) $reg_manufacture_c=$reg_manufacture->c;
			if(isset($reg_manufacture->d)) $reg_manufacture_d=$reg_manufacture->d;
		}else	{
			$reg_manufacture_a="";$reg_manufacture_b="";$reg_manufacture_c="";$reg_manufacture_d="";
		}	
		if(!empty($results["old_reg_details"])){
			$old_reg_details=json_decode($results["old_reg_details"]);
			$old_reg_details_no=$old_reg_details->no;$old_reg_details_dt=$old_reg_details->dt;
		}else{
			$old_reg_details_no="";$old_reg_details_dt="";
		}	
		if(!empty($results["proj_invested"])){
			$proj_invested=json_decode($results["proj_invested"]);
			$proj_invested_cap=$proj_invested->cap;$proj_invested_year=$proj_invested->year;
		}else{
			$proj_invested_cap="";$proj_invested_year="";
		}	
		if(!empty($results["solid_waste"])){
			$solid_waste=json_decode($results["solid_waste"]);
			$solid_waste_a=$solid_waste->a;$solid_waste_b=$solid_waste->b;$solid_waste_c=$solid_waste->c;
		}else{
			$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";
		}
	}else{
		$form_id="";$manuf_capacity="";$is_reg_dcssi="";$min_sizes_cb="";$compliance_status="";$water_valid_consent="";$air_valid_consent="";
		$reg_manufacture_a="";$reg_manufacture_b="";$reg_manufacture_c="";$reg_manufacture_d="";$old_reg_details_no="";$old_reg_details_dt="";$proj_invested_cap="";$proj_invested_year="";$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";
	}
}else{			
	$results=$q->fetch_assoc();
	$form_id=$results["form_id"];
	$manuf_capacity=$results["manuf_capacity"];$is_reg_dcssi=$results["is_reg_dcssi"];$min_sizes_cb=$results["min_sizes_cb"];$compliance_status=$results["compliance_status"];$water_valid_consent=$results["water_valid_consent"];$air_valid_consent=$results["air_valid_consent"];
		
	if(!empty($results["reg_manufacture"])){
		$reg_manufacture=json_decode($results["reg_manufacture"]);
		if(isset($reg_manufacture->a)) $reg_manufacture_a=$reg_manufacture->a;
		if(isset($reg_manufacture->b)) $reg_manufacture_b=$reg_manufacture->b;
		if(isset($reg_manufacture->c)) $reg_manufacture_c=$reg_manufacture->c;
		if(isset($reg_manufacture->d)) $reg_manufacture_d=$reg_manufacture->d;
	}else	{
		$reg_manufacture_a="";$reg_manufacture_b="";$reg_manufacture_c="";$reg_manufacture_d="";
	}	
	if(!empty($results["old_reg_details"])){
		$old_reg_details=json_decode($results["old_reg_details"]);
		$old_reg_details_no=$old_reg_details->no;$old_reg_details_dt=$old_reg_details->dt;
	}else{
		$old_reg_details_no="";$old_reg_details_dt="";
	}	
	if(!empty($results["proj_invested"])){
		$proj_invested=json_decode($results["proj_invested"]);
		$proj_invested_cap=$proj_invested->cap;$proj_invested_year=$proj_invested->year;
	}else{
		$proj_invested_cap="";$proj_invested_year="";
	}	
	if(!empty($results["solid_waste"])){
		$solid_waste=json_decode($results["solid_waste"]);
		$solid_waste_a=$solid_waste->a;$solid_waste_b=$solid_waste->b;$solid_waste_c=$solid_waste->c;
	}else{
		$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";
	}	
}
?>
<?php require_once "../../requires/header.php";   ?>
	<?php include ("".$table_name."_Addmore-operation.php"); ?>
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive "> 
								    <tr><td colspan="4" align="center"><b>PART - A<br/>GENERAL</b></td></tr>
									<tr>
										<td colspan="4">1.(a) Name of the unit and location of activity </td>
								    </tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Location :</td>
									     <td width="25%"><input type="text" disabled  value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Address of the unit</td>
									</tr>
									<tr>
									     <td>Name :</td>
									     <td><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
									     <td>Street Name 1 :</td>
									     <td><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2 :</td>
										<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town :</td>
										<td><input type="text" disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District :</td>
										<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
										<td>Pincode :</td>
										<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No :</td>
										<td><input type="text" disabled value="<?php echo $b_mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>Phone No :</td>
										<td><input type="text" disabled value="<?php echo $b_landline_std.-$b_landline_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Email Id :</td>
										<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">(c) Registration required for manufacturing of :</td>
										
									</tr>
									<tr>
									   <td><input type="checkbox"  name="reg_manufacture[a]" value="Carry bag virgin" <?php if(isset($reg_manufacture_a) && $reg_manufacture_a=='Carry bag virgin') echo 'checked'; ?> />(i) Carry bag virgin</td>
							           <td><input type="checkbox" name="reg_manufacture[b]" value="Carry bag recycled" <?php if(isset($reg_manufacture_b) && $reg_manufacture_b=='Carry bag recycled') echo 'checked'; ?> />(ii) Carry bag recycled</td>
							           <td><input type="checkbox" name="reg_manufacture[c]" value="Containers virgin" <?php if(isset($reg_manufacture_c) && $reg_manufacture_c=='Containers virgin') echo 'checked'; ?> />(iii) Containers virgin</td>
							           <td><input type="checkbox" name="reg_manufacture[d]" value="Container recycled" <?php if(isset($reg_manufacture_d) && $reg_manufacture_d=='Container recycled') echo 'checked'; ?> />(iv) Container recycled</td>
									</tr>
									<tr>
									     <td>(d)Manufacturing capacity :</td>
									     <td><input type="text" name="manuf_capacity" value="<?php echo $manuf_capacity; ?>" class="form-control text-uppercase"></td>
									     <td></td>
									     <td></td>
									</tr>
									<tr>
									    <td colspan="4">(e)In case of renewal of Registration previous Registration number and date :</td>
									</tr>
									<tr>
										<td>Registration Number :</td>
									    <td><input type="text" class="form-control text-uppercase" name="old_reg_details[no]" placeholder="Reg. No." value="<?php echo $old_reg_details_no; ?>" /></td>
										<td>Date :</td>
										<td><input type="text" class="dob form-control" name="old_reg_details[dt]"  placeholder="Date" value="<?php echo $old_reg_details_dt; ?>" readonly="readonly" /></td>
									</tr>
									<tr>
										<td colspan="3">2. Is the unit registered with DCSSI or Department of Industries of the State Government/Union Territory Administration? <span class="mandatory_field">*</span></td>
										<td><input type="radio" name="is_reg_dcssi" value="Y" <?php if(isset($is_reg_dcssi) && $is_reg_dcssi=='Y') echo 'checked'; ?> required="required" />&nbsp;Yes &nbsp;&nbsp;&nbsp; <input type="radio" name="is_reg_dcssi" value="N" <?php if(isset($is_reg_dcssi) && $is_reg_dcssi=='N') echo 'checked'; ?> />&nbsp;No</td>
									</tr>
						            <tr>
						                <td valign="top">3.(a) Total capital invested <br/>on the project</td>
						                <td><input type="text" class="form-control text-uppercase" name="proj_invested[cap]" value="<?php echo $proj_invested_cap; ?>" /></td>
						                <td>(b) Year of commencement of<br/> production</td>
						                <td><input type="number" class="form-control text-uppercase" name="proj_invested[year]"  min="1960" max="2020" value="<?php echo $proj_invested_year; ?>" /></td>
					                </tr>			
					                <tr>
						                <td colspan="4">4.(a) List and quantum of products and byproducts.
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
										<tbody>
											<tr>
											   <td align="center" width="10%">Sl No.</td>
											   <td align="center" width="50%">Name</td>
											   <td align="center">Type<span class= "mandatory_field">*</span></td>
											   <td align="center">Quantum</td>
											</tr>
											<?php
									$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
									$num1 = $part1->num_rows;
									if($num1>0){
									  $count=1;
									  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly  id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
											<td><select required="required" id="txtC<?php echo $count;?>" name="txtC<?php echo $count;?>" class="form-control text-uppercase">
												<option value='' >Select Type</option> 
												<option <?php if($row_1["ty_pe"]=="P") echo "selected"; ?> value='P'>Product</option>
												<option <?php if($row_1["ty_pe"]=="B") echo "selected"; ?> value='B'>By-product</option>
											</select></td>
											<td><input value="<?php echo $row_1["quantum"]; ?>" id="txtD<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input  value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
										<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
										<td><select required="required" name="txtC1" id="txtC1" class="form-control text-uppercase">
												<option value='' >Select Type</option>
												<option value='Product' >Product</option>
												<option value='By-product' >By-product</option>
											</select></td>
										<td><input id="txtD1" size="10" class="form-control text-uppercase" name="txtD1"></td>
									</tr>
									<?php } ?>
									</tbody>
									</table>										
									</td>
								</tr>
									<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
									</td>
								</tr>	
									<tr>
					  			        <td colspan="4">(b) List and quantum of raw materials used
									<table name="objectTable2" id="objectTable2" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Raw Materials</td>
										   <td align="center">Quantum</td>
										</tr>
									   <?php
										$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
										$num = $part2->num_rows;
										if($num>0){
										  $count=1;
										  while($row_2=$part2->fetch_array()){	?>
										<tr>
											<td><input readonly  id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_2["raw"]; ?>" id="textB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_2["quantum"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>	
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
										<td><input id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>					
										<td><input  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>
									</tr>
									<?php } ?>
									</tbody>
									</table>
									</td>
								</tr>
									<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore2()" value="">Add More</button>
										<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
									</td>
								</tr> 	
									<tr>
										<td>5. Minimum sizes of carry bags to be  manufactured.(in any case it should not be less than 8" x 12" Inch)</td>
										<td><input type="text" class="form-control text-uppercase" name="min_sizes_cb" value="<?php echo $min_sizes_cb; ?>" /></td>
										<td>6. Status of compliance with rules 5, 6, 7 and 8</td>
										<td><input type="text" class="form-control text-uppercase" name="compliance_status"  value="<?php echo $compliance_status; ?>" /></td>
									</tr>
									<tr>
										<td colspan="4" align="center"><b>PART - B<br/>PERTAINING TO LIQUID EFFLUENT AND GASEOUS EMISSION</b></td>
									</tr>
									<tr>
										<td colspan="3">7.(a) Does the unit have a valid consent under the Water (Prevention and Control of Pollution) Act, 1974 (6 of 1974) <span class="mandatory_field">*</span> <br/>If yes, attach a copy</td>
										<td><input type="radio" name="water_valid_consent" value="Y" <?php if(isset($water_valid_consent) && $water_valid_consent=='Y') echo 'checked'; ?> required="required"  >&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="water_valid_consent" value="N" <?php if(isset($water_valid_consent) && $water_valid_consent=='N') echo 'checked'; ?>>&nbsp;No</td>
									</tr>
									<tr>
										<td colspan="3">(b) Does the unit have a valid consent under the Air (Prevention and Control of Pollution) Act, 1981 (14 of 1981) <span class="mandatory_field">*</span><br/>If yes, attach a copy</td>	
										<td><input type="radio" name="air_valid_consent" value="Y" <?php if(isset($air_valid_consent) && $air_valid_consent=='Y') echo 'checked'; ?> required="required">&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="air_valid_consent" value="N" <?php if(isset($air_valid_consent) && $air_valid_consent=='N') echo 'checked'; ?>>&nbsp;No</td>
								   </tr>
									<tr>
										<td colspan="4" align="center"><b>PART - C<br/>PERTAINTING TO WASTE</b></td> 
									</tr>
									<tr>
										<td colspan="4">8.Solid Wastes :</td>
									</tr>
									<tr>
										<td>(a) Total quantum of generation</td>
										<td><input type="text" class="form-control text-uppercase" name="solid_waste[a]" id="textfield19" placeholder="Quantum" value="<?php echo $solid_waste_a; ?>" /></td>
										<td>(b) Mode of storage within the plant</td>
										<td><input type="text" class="form-control text-uppercase" name="solid_waste[b]" id="textfield20" placeholder="Mode of storage" value="<?php echo $solid_waste_b; ?>" /></td>
									</tr>
									<tr>
										<td>(c) Provision made for disposal</td>	
										<td><input type="text" class="form-control text-uppercase" name="solid_waste[c]"  placeholder="Provision for disposal" value="<?php echo $solid_waste_c; ?>" /></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									   <td align="left">Place : <b><?php echo strtoupper($dist); ?></b><br/>
									   Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
									   <td></td>
									   <td></td>
									   <td align="right">
										Signature: <label><?php  echo strtoupper($key_person) ?></label><br/>
										Designation:<label><?php echo strtoupper($status_applicant) ?></label></td>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>