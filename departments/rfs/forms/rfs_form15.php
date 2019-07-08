<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="15";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include("save_form.php");
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$specimen=$results["specimen"];$post_office=$results["post_office"];$police_station=$results["police_station"];$photo_president=$results["photo_president"];$photo_secretary=$results["photo_secretary"];$date_general_meeting=$results["date_general_meeting"];
			
			if(!empty($results["bank_detail"])){
				$bank_detail=json_decode($results["bank_detail"]);
				$bank_detail_no=$bank_detail->no;$bank_detail_bank=$bank_detail->bank;$bank_detail_branch=$bank_detail->branch;
                $bank_detail_type=$bank_detail->type;$bank_detail_holding=$bank_detail->holding;
			}else{
				$bank_detail_no="";$bank_detail_bank="";$bank_detail_branch="";$bank_detail_type="";$bank_detail_holding="";
			}
		}else{
			$form_id="";
			$specimen="";$post_office="";$police_station="";
			$bank_detail_no="";$bank_detail_bank="";$bank_detail_branch="";$bank_detail_type="";$bank_detail_holding="";
			$photo_president="";$photo_secretary="";$date_general_meeting="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$specimen=$results["specimen"];$post_office=$results["post_office"];$police_station=$results["police_station"];$photo_president=$results["photo_president"];$photo_secretary=$results["photo_secretary"];$date_general_meeting=$results["date_general_meeting"];
		
		if(!empty($results["bank_detail"])){
			$bank_detail=json_decode($results["bank_detail"]);
			$bank_detail_no=$bank_detail->no;$bank_detail_bank=$bank_detail->bank;$bank_detail_branch=$bank_detail->branch;$bank_detail_type=$bank_detail->type;$bank_detail_holding=$bank_detail->holding;
		}else{
			$bank_detail_no="";$bank_detail_bank="";$bank_detail_branch="";$bank_detail_type="";$bank_detail_holding="";
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
	<?php include ("".$table_name."_addmore.php"); ?>
</head>
	<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
    <div class="wrapper">
	<?php require_once "../../requires/header.php";   ?>
	<?php require '../../../user_area/includes/aside.php'; ?>
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
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. Name of the Society</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $unit_name;?>"></td>
										<td colspan="2"></td>
										
									</tr>
									<tr>
										<td>2. The specimen signatures of all the executive members have been witnessed by</td>
										<td><input type="text" class="form-control text-uppercase" name="specimen"  value="<?php echo $specimen;?>"></td>
										<td>3. Date of Establishment</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?=date('d-m-Y',strtotime($date_of_commencement))?>"  ></td>
									</tr>
									<tr>
										<td colspan="4">4. Address of the Society</td>
									</tr>
									<tr>
										<td>Mouza </td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $mouza; ?>"/></td>
										<td>Circle</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $circle; ?>"/></td>
									</tr>
									<tr>
										<td>Patta No. </td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $patta_no; ?>"/></td>
										<td>Dag No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $dag_no; ?>"/></td>
									</tr>
									<tr>
										<td>Area</td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $area; ?>"/></td>
										<td>Locality  </td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $b_street_name2; ?>"/></td>
									</tr>
									<tr>
										<td>Village/town/city </td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_vill; ?>"/></td>
										<td>Post Office </td>
										<td><input type="text"  class="form-control text-uppercase" id="post_office" name="post_office" value="<?php  echo $post_office; ?>"/></td>
									</tr>
									<tr> 
										<td>Police Station </td>
										<td><input type="text" class="form-control text-uppercase" id="police_station" name="police_station" value="<?php  echo $police_station; ?>"/></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_dist; ?>"/></td>
									</tr>
									<tr>
										<td>Pin code </td>
										 <td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" disabled value="<?php  echo $b_pincode; ?>" ></td>
										 <td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
									</tr>
									<tr>
										<td>Email ID</td>
										<td><input type="text" class="form-control" disabled value="<?php  echo $b_email; ?>"/></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">5. A list of members of the Executive Committee with their full name (in block letter), address and occupation.</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable2" id="objectTable2" class="text-center table table-responsive table-bordered">
										<thead>
										<tr>
											<th>Sl No.</th>
											<th>Name of the Members</th>
											<th>Address</th>
											<th>Occupation</th>
											<th>Designation</th>
										</tr>
										</thead>
												<?php
												$part2=$formFunctions->executeQuery($dept,"select * from rfs_form".$form."_members where form_id='$form_id'");
												$num2 = $part2->num_rows;
												if($num2>0){
												$count=1;
												while($row_2=$part2->fetch_array()){?>
												<tr>
													<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["sl_no"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
													<td><input type="text" id="txxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["member_name"]; ?>" name="txxtB<?php echo $count;?>" ></td>
													<td><input type="text" value="<?php echo $row_2["member_address"]; ?>"  id="txxtC<?php echo $count;?>" class="form-control text-uppercase" name="txxtC<?php echo $count;?>"></td>
													<td><input type="text" value="<?php echo $row_2["member_occupation"]; ?>" id="txxtD<?php echo $count;?>" class="form-control text-uppercase" name="txxtD<?php echo $count;?>"  ></td>
													<td><input type="text" value="<?php echo $row_2["member_designation"]; ?>" id="txxtE<?php echo $count;?>" class="form-control text-uppercase" name="txxtE<?php echo $count;?>"  ></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" readonly value="1" id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
													<td><input type="text" id="txxtB1"  class="form-control text-uppercase" name="txxtB1"></td>
													<td><input type="text" id="txxtC1"  class="form-control text-uppercase" name="txxtC1"></td>					
													<td><input type="text" id="txxtD1" class="form-control text-uppercase" name="txxtD1" ></td>
													<td><input type="text" id="txxtE1" class="form-control text-uppercase" name="txxtE1" ></td>
												</tr>
												<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
										<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
										<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td colspan="4">6. A statement showing the details of grant receipt from Central Government/State Government and other agencies during the preceding 3 years from the date of renewal application.</td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" class="table table-responsive table-bordered text-center" id="objectTable1" >
												<thead>
												<tr>
													<th width="5%">Sl No.</th>
													<th>Sanction letter no.</th>
													<th>Sanction Date</th>
													<th>Name of the scheme</th>
													<th>Objectives of the scheme</th>
													<th>Fund releasing authority</th>	
													<th>Opening balance</th>	
													<th>Amount sanctioned during the year</th>	
													<th>Amount released during the preceding 3 years</th>	
													<th>Total available fund</th>	
													<th>Total expenditure incurred during the preceding 3 years</th>	
													<th>Remarks</th>	
												</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
												$count=1;
												while($row_1=$part1->fetch_array()){	?>
												<tr>
													<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
													<td><input type="text" id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["letter_no"]; ?>" name="txtB<?php echo $count;?>" ></td>
													<td><input type="text" value="<?php echo $row_1["letter_date"]; ?>"  id="txtC<?php echo $count;?>" class="dob form-control text-uppercase" name="txtC<?php echo $count;?>"></td>
													<td><input type="text" value="<?php echo $row_1["scheme_name"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"  ></td>
													<td><input type="text" value="<?php echo $row_1["obj_of_scheme"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"  ></td>
													<td><input type="text" value="<?php echo $row_1["fund_release"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"  ></td>
													<td><input type="text" value="<?php echo $row_1["opening_balance"]; ?>" id="txtG<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>" ></td>
													<td><input type="text" value="<?php echo $row_1["amount_sanc"]; ?>" id="txtH<?php echo $count;?>" class="form-control text-uppercase" name="txtH<?php echo $count;?>" validate="onlyNumbers"></td>
													<td><input type="text" value="<?php echo $row_1["amount_release"]; ?>" id="txtI<?php echo $count;?>" class="form-control text-uppercase" name="txtI<?php echo $count;?>" validate="onlyNumbers"></td>
													<td><input type="text" value="<?php echo $row_1["total_fund"]; ?>" id="txtJ<?php echo $count;?>" class="form-control text-uppercase" name="txtJ<?php echo $count;?>" validate="onlyNumbers"></td>
													<td><input type="text" value="<?php echo $row_1["total_exp"]; ?>" id="txtK<?php echo $count;?>" class="form-control text-uppercase" name="txtK<?php echo $count;?>" validate="onlyNumbers"></td>
													<td><input type="text" value="<?php echo $row_1["remarks"]; ?>" id="txtL<?php echo $count;?>" class="form-control text-uppercase" name="txtL<?php echo $count;?>" ></td>
													
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" readonly value="1" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
													<td><input type="text" id="txtB1"  class="form-control text-uppercase" name="txtB1"></td>
													<td><input type="text" id="txtC1"  class="dob form-control text-uppercase" name="txtC1"></td>					
													<td><input type="text" id="txtD1" class="form-control text-uppercase" name="txtD1" ></td>
													<td><input type="text" id="txtE1" class="form-control text-uppercase" name="txtE1" ></td>
													<td><input type="text" id="txtF1" class="form-control text-uppercase" name="txtF1" ></td>
													<td><input type="text" id="txtG1" class="form-control text-uppercase" name="txtG1" ></td>
													<td><input type="text" id="txtH1" class="form-control text-uppercase" name="txtH1" validate="onlyNumbers"></td>
													<td><input type="text" id="txtI1" class="form-control text-uppercase" name="txtI1" validate="onlyNumbers"></td>
													<td><input type="text" id="txtJ1" class="form-control text-uppercase" name="txtJ1" validate="onlyNumbers"></td>
													<td><input type="text" id="txtK1"  class="form-control text-uppercase" name="txtK1" validate="onlyNumbers"></td>
													<td><input type="text" id="txtL1" class="form-control text-uppercase" name="txtL1" ></td>
												</tr>
												<?php } ?>
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>									
									</tr>
									<!---<tr>
										<td colspan="4">8. Bank Details </td>
									</tr>
									<tr>
										<td>Account No.<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="bank_detail[no]" value="<?php echo $bank_detail_no; ?>" required/></td>
										<td>Bank<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="bank_detail[bank]" value="<?php echo $bank_detail_bank; ?>" required ></td>
									</tr>
									<tr>
										<td>Branch<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="bank_detail[branch]" value="<?php echo $bank_detail_branch; ?>" required ></td>
										<td>Type of Account</td>
										<td><select name="bank_detail[type]" class="form-control text-uppercase">
												<option value="">Please Select</option>
												<option value="Saving" class="form-control text-uppercase" <?php if(isset($bank_detail_type) && $bank_detail_type=="Saving") echo 'selected'; ?>>Saving</option>
												<option value="Current" class="form-control text-uppercase" <?php if(isset($bank_detail_type) && $bank_detail_type=="Current") echo 'selected'; ?>>Current</option>
											</select>
					                  </td>
									</tr>
									<tr>
										<td>Holding account</td>
										<td><select name="bank_detail[holding]" class="form-control text-uppercase">
												<option value="">Please Select</option>
												<option value="Individual" class="form-control text-uppercase" <?php if(isset($bank_detail_holding) && $bank_detail_holding=="Individual") echo 'selected'; ?>>Individual</option>
												<option value="Joint" class="form-control text-uppercase" <?php if(isset($bank_detail_holding) && $bank_detail_holding=="Joint") echo 'selected'; ?>>Joint</option>
											</select>
					                  </td>
										<td></td>
										<td></td>
									</tr> --->
									<tr>
										<td colspan="4">7. Photographs of the President & Secretary: </td>
									</tr>
									<tr>
										<td>(a) President</td>
										<td>
											<input type="button" upload="file" class="file btn btn-info" id="file15" value="Browse">
											<input type="hidden" name="photo_president" value="<?php echo $photo_president; ?>" id="mfile15" readonly="readonly" />
											<span id="tdfile15"><?php if($photo_president=="") echo "No File Selected"; else echo '&nbsp;&nbsp;&nbsp;<a href="'.$upload.$photo_president.'" target="_blank"> View </a>'; ?> </span>
										</td>
										<td>(b) Secretary</td>
										<td>
											<input type="button" upload="file" class="file btn btn-info" id="file16" value="Browse">
											<input type="hidden" name="photo_secretary" value="<?php echo $photo_secretary; ?>" id="mfile16" readonly="readonly" />
											<span id="tdfile16"><?php if($photo_secretary=="") echo "No File Selected"; else echo '&nbsp;&nbsp;&nbsp;<a href="'.$upload.$photo_secretary.'" target="_blank"> View </a>'; ?> </span>
										</td>
									</tr>
									<tr>
										<td>8. Date of general meeting : </td>
										<td>
											<input class="dobindia form-control" name="date_general_meeting" value="<?=($date_general_meeting)? date('d-m-Y',strtotime($date_general_meeting)) : "" ?>"/>
										</td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today));?></strong><br/>
											Place : <strong><?php echo strtoupper($dist);?></strong></td>
										<td align="right" colspan="2">
											<b><?php echo strtoupper($key_person)?></b><br/>
												Signature of the Applicant               
										</td>
									</tr>
									<tr>
										<td colspan="4" class="text-center">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> Save & Next </button></td>
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

	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>

</body>	  
</html>