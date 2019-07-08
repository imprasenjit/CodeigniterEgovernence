<?php  require_once "../../requires/login_session.php";

$dept="pcb";
$form="70";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form_new1.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$issuance_dt=$results['issuance_dt'];$ref_no=$results['ref_no'];$description_management=$results['description_management'];$environmental_dt=$results['environmental_dt'];
		
		
		 if(!empty($results["facility"])){
				$facility=json_decode($results["facility"]);
				$facility_nm=$facility->nm;$facility_st1=$facility->st1;$facility_st2=$facility->st2;$facility_vill=$facility->vill;$facility_dist=$facility->dist;$facility_pin=$facility->pin;$facility_mob=$facility->mob;$facility_email=$facility->email;
		  }else{
				$facility_nm="";$facility_st1="";$facility_st2="";$facility_vill="";$facility_dist="";$facility_pin="";$facility_mob="";$facility_email="";
         }
		
	}else{
		$form_id="";$issuance_dt="";$ref_no="";$description_management="";$environmental_dt="";$facility_nm="";$facility_st1="";$facility_st2="";$facility_vill="";$facility_dist="";$facility_pin="";$facility_mob="";$facility_email="";
	}
}else{
	    $results=$q->fetch_assoc();
	    $form_id=$results['form_id'];
		$issuance_dt=$results['issuance_dt'];$ref_no=$results['ref_no'];$description_management=$results['description_management'];$environmental_dt=$results['environmental_dt'];
		
		
		 if(!empty($results["facility"])){
				$facility=json_decode($results["facility"]);
				$facility_nm=$facility->nm;$facility_st1=$facility->st1;$facility_st2=$facility->st2;$facility_vill=$facility->vill;$facility_dist=$facility->dist;$facility_pin=$facility->pin;$facility_mob=$facility->mob;$facility_email=$facility->email;
		  }else{
				$facility_nm="";$facility_st1="";$facility_st2="";$facility_vill="";$facility_dist="";$facility_pin="";$facility_mob="";$facility_email="";
         }
   } 
?>
<?php require_once "../../requires/header.php";   ?>
  <?php include ("".$table_name."_addmore.php"); ?>
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
										<td width="25%">1.Name and address of the facility </td>
									</tr>
									<tr>
										<td>Name of the facility</td>
										<td><input type="text" class="form-control" name="facility[nm]" value="<?php echo $facility_nm; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control" name="facility[st1]" value="<?php echo $facility_st1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control" name="facility[st2]" value="<?php echo $facility_st2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control" name="facility[vill]" value="<?php echo $facility_vill; ?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control" name="facility[dist]" value="<?php echo $facility_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control" name="facility[pin]" validate="pincode" maxlength="6" value="<?php echo $facility_pin; ?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control" name="facility[mob]" validate="mobileNumber" maxlength="10" value="<?php echo $facility_mob; ?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="facility[email]" validate="email" value="<?php echo $facility_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
											<td width="25%">2.Date of issuance of authorisation and its reference number </td>
											<td width="25%"></td>
											<td width="25%"></td>
											<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Date of issuance</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="issuance_dt" value="<?php echo $issuance_dt;?>" ></td>
										<td width="25%">Reference number</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ref_no" value="<?php echo $ref_no;?>" ></td>
									</tr>
									<tr> 
									   <td>3. Description of hazardous and other wastes handled (Generated or Received) :</td>
									</tr>
								   <tr>
									<td colspan="4"><b>(a) For indigenous :</b>
									<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
										<tr>
											<th width="10%">Slno</th>
											<th width="20%">Date</th>
											<th width="20%">Type of waste with category as per Schedules I, II and III of these rules</th>
											<th width="15%">Total quantity (MetricTonnes)</th>
											<th width="20%">Method of Storage</th>
											<th width="15%">Destined to or received from</th>
										</tr>
										<?php
										$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
											$count=1;
											while($row_1=$part1->fetch_array()){	?>
											<tr>
												<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
												<td><input id="txtB<?php echo $count;?>" class="dob form-control text-uppercase" value="<?php echo $row_1["date"]; ?>"  name="txtB<?php echo $count;?>" size="10"></td>
												<td><input value="<?php echo $row_1["waste_category"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_1["tot_quantity"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_1["method_storage"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_1["received"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtF<?php echo $count;?>"></td>
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
											<td><input id="txtB1" size="10"  class="dob form-control text-uppercase" name="txtB1"></td>
											<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>
											<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>
											<td><input id="txtE1" size="10"   class="form-control text-uppercase" name="txtE1"></td>
											<td><input id="txtF1" size="10"   class="form-control text-uppercase" name="txtF1"></td>
										</tr>
										<?php } ?>														
									</table>
									 <div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
									 <button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
									 <input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
									</td>
								   </tr>
								   <tr>
									<td colspan="4"><b>(b) For imported waste :</b>
									<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center" >
										<tr>
											<th width="10%">Slno</th>
											<th width="20%">Date</th>
											<th width="20%">Type of waste with category as per Schedules I, II and III of these rules</th>
											<th width="15%">Total quantity (MetricTonnes)</th>
											<th width="20%">Method of Storage</th>
											<th width="15%">Destined to or received from</th>
										</tr>
										<?php
										$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
										$num2 = $part2->num_rows;
										if($num2>0){
											$count=1;
											while($row_2=$part2->fetch_array()){	?>
											<tr>
												<td><input readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
												<td><input id="txxtB<?php echo $count;?>" class="dob form-control text-uppercase" value="<?php echo $row_2["date"]; ?>"  name="txxtB<?php echo $count;?>" size="10"></td>
												<td><input value="<?php echo $row_2["waste_category"]; ?>" id="txxtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txxtC<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_2["tot_quantity"]; ?>" id="txxtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txxtD<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_2["method_storage"]; ?>" id="txxtE<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txxtE<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_2["received"]; ?>" id="txxtF<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txxtF<?php echo $count;?>"></td>
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" id="txxtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txxtA1"></td>
											<td><input id="txxtB1" size="10"  class="dob form-control text-uppercase" name="txxtB1"></td>
											<td><input id="txxtC1" size="10"   class="form-control text-uppercase" name="txxtC1"></td>
											<td><input id="txxtD1" size="10"   class="form-control text-uppercase" name="txxtD1"></td>
											<td><input id="txxtE1" size="10"   class="form-control text-uppercase" name="txxtE1"></td>
											<td><input id="txxtF1" size="10"   class="form-control text-uppercase" name="txxtF1"></td>
										</tr>
										<?php } ?>														
									</table>
									 <div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
									 <button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
									 <input type="hidden" id="hiddenval1" name="hiddenval1" value="<?php echo $hiddenval1; ?>"/></div>
									</td>
								   </tr>
									<tr>
										<td width="25%">4. Date wise description of management of hazardous and other wastes including products sent and to whom in case of recyclers or pre-processor or utiliser:</td>
										<td><textarea class="form-control text-uppercase" name="description_management"><?php echo $description_management;?></textarea></td>
										<td width="25%">5. Date of environmental monitoring (as per authorisation or guidelines of Central Pollution Control Board):</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="environmental_dt" value="<?php echo $environmental_dt;?>" ></td>
									</tr>
									<tr>
										<td colspan="2" align="left"><br/> Date :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
										<td colspan="2" align="right"><br/> Signature of the Applicant :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>