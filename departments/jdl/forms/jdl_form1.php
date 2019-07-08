<?php  require_once "../../requires/login_session.php"; 

$dept="jdl";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_jdl_form.php";

   
    
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$peti_type="";$peti_is="";$peti_name="";$peti_nm="";$peti_dob="";$peti_nationality="";
			$peti_gender="";$peti_caste="";$peti_father_name="";$peti_mother_name="";$peti_mname="";$peti_address="";$peti_state="";$peti_dist="";$peti_pin="";$peti_occu="";$peti_email="";$peti_mobile="";$law_reg_no="";
			
			//tab 2//
			$resp_type="";$resp_is="";$resp_name="";$resp_age="";$resp_father_name="";$resp_mother_name="";$resp_address="";$resp_state="";$resp_dist="";$resp_pin="";$resp_law_reg_no="";$resp_occu="";$resp_email="";$resp_mobile="";$resp_nationality="";$resp_gender="";$resp_caste="";$hiddenval2="";
		}else{
			$form_id="";
			$peti_type="";$peti_is="";$peti_name="";$peti_nm="";$peti_dob="";$peti_nationality="";
			$peti_gender="";$peti_caste="";$peti_father_name="";$peti_mother_name="";$peti_mname="";$peti_address="";$peti_state="";$peti_dist="";$peti_pin="";$peti_occu="";$peti_email="";$peti_mobile="";$law_reg_no="";
			
			//tab 2//
			$resp_type="";$resp_is="";$resp_name="";$resp_age="";$resp_father_name="";$resp_mother_name="";$resp_address="";$resp_state="";$resp_dist="";$resp_pin="";$resp_law_reg_no="";$resp_occu="";$resp_email="";$resp_mobile="";$resp_nationality="";$resp_gender="";$resp_caste="";$hiddenval2="";
		}	
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
			$peti_type="";$peti_is="";$peti_name="";$peti_dob="";$peti_nationality="";
			$peti_gender="";$peti_caste="";$peti_father_name="";$peti_mother_name="";$peti_address="";$peti_state="";$peti_dist="";$peti_pin="";$peti_occu="";$peti_email="";$peti_mobile="";$law_reg_no="";
			
			//tab 2//
			$resp_type="";$resp_is="";$resp_name="";$resp_age="";$resp_father_name="";$resp_mother_name="";$resp_address="";$resp_state="";$resp_dist="";$resp_pin="";$resp_law_reg_no="";$resp_occu="";$resp_email="";$resp_mobile="";$resp_nationality="";$resp_gender="";$resp_caste="";$hiddenval2="";
			
			
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
    $tabbtn3 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
        $tabbtn3 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
        $tabbtn3 = "";
	}
    if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
	}
	##PHP TAB management ends
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
								<h4 class="text-center">
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">Petitioner Details</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Respondent Details</a></li>
									
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive ">
										
											<tr>
												<td width="25%">Petitioner Type</td>
												<td><select class="form-control text-uppercase" id="peti_type" name="peti_type">
													<option value="" >Select</option>
													<option value="I" <?php if($peti_type=="I") echo "selected";?> >Individual</option>
													<option value="G" <?php if($peti_type=="G") echo "selected";?>>Group</option>
												</select></td>
												<td width="25%">Petitioner is</td>
												<td><select class="form-control text-uppercase" id="peti_is" name="peti_is">
													<option value="" >Select</option>
													<option value="M" <?php if($peti_is=="M") echo "selected";?> >Main</option>
													<option value="O" <?php if($peti_is=="O") echo "selected";?>>Other</option>
													
												</select></td>
											</tr>
											<tr>
												<td>Name</td>
												<td><input type="text" class="form-control text-uppercase" id="peti_name" name="peti_name" value="<?php echo $peti_name;?>"></td>
												<td>Date of Birth</td>
												<td><input type="text" class="dob form-control text-uppercase" id="peti_dob" name="peti_dob" value="<?php echo $peti_dob;?>"></td>
											</tr>
											<tr>
												<td>Nationality</td>
												<td><select class="form-control text-uppercase" id="peti_nationality" name="peti_nationality">
													<option value="" >Select</option>
													<option value="I" <?php if($peti_nationality=="I") echo "selected";?> >Indian</option>
													<option value="O" <?php if($peti_nationality=="O") echo "selected";?>>Other</option>
												</select></td>
												<td>Gender</td>
												<td><select class="form-control text-uppercase" id="peti_gender" name="peti_gender">
													<option value="" >Select</option>
													<option value="M" <?php if($peti_gender=="M") echo "selected";?> >Male</option>
													<option value="F" <?php if($peti_gender=="F") echo "selected";?>>Female</option>
												</select></td>
											</tr>
											<tr>
												<td width="25%">Caste</td>
												<td><select class="form-control text-uppercase" id="peti_caste" name="peti_caste">
													<option value="" >Select</option>
													<option value="H" <?php if($peti_caste=="H") echo "selected";?> >Hindu</option>
													<option value="M" <?php if($peti_caste=="M") echo "selected";?>>Muslim</option>
													<option value="C" <?php if($peti_caste=="C") echo "selected";?> >Christian</option>
													<option value="O" <?php if($peti_caste=="O") echo "selected";?> >Other</option>
													</select>
												</td>
												<td width="25%">Father's name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" id="peti_father_name" name="peti_father_name" value="<?php echo $peti_father_name;?>"></td>
											</tr>
											<tr>
												<td>Mother's Name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  id="peti_mother_name" name="peti_mother_name" value="<?php echo $peti_mother_name;?>"></td>
												<td>Address</td>
												<td><textarea class="form-control text-uppercase" id="peti_address" name="peti_address"><?php echo $peti_address; ?></textarea></td>
											</tr>
											<tr>
												<td>State</td>
												<td><input type="text" class="form-control text-uppercase" id="peti_state" name="peti_state" value="<?php echo $peti_state;?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase"  id="peti_dist" name="peti_dist" value="<?php echo $peti_dist;?>"></td>
											</tr>	
											<tr>
												<td>PIN</td>
												<td><input type="pincode" class="form-control"  id="peti_pin" name="peti_pin" validtae="pincode" maxlength="6" value="<?php echo $peti_pin;?>"></td>
												<td width="25%">Lawer Registration No</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" id="law_reg_no" name="law_reg_no" value="<?php echo $law_reg_no;?>"></td>
											</tr>
											<tr>
												<td>Occupation</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" id="peti_occu" name="peti_occu" value="<?php echo $peti_occu;?>"></td>
												<td>Email ID</td>
												<td width="25%"><input type="email" class="form-control" id="peti_email" name="peti_email" value="<?php echo $peti_email;?>"></td>
											</tr>
											<tr>
												<td width="25%">Mobile No</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" validate="onlyNumber" maxlength="10" id="peti_mobile" name="peti_mobile" value="<?php echo $peti_mobile;?>"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
										<tr>										
											<td class="text-center" colspan="4">
												<button type="button" class="btn btn-primary" onclick="addMorefunction1()" name="save">ADD</button>
												
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
											</td>									
										</tr>
											
										<tr>
											<td colspan="4">
										
										
												<table name="objectTable1" id="objectTable1" class="table table-responsive 	text-center">
													<thead>
													<tr>
														
														<th width="10%">Petitioner Type</th>
														<th width="10%">Petitioner is</th>
														<th width="10%">Name</th>
														<th width="10%">Gender</th>
														<th width="10%">Father's Name</th>
														<th width="10%">Mother's Name</th>
														<th width="10%">Address</th>
														<th width="10%">District</th>
														<th width="10%">Mobile</th>
														<th width="10%">Email</th>
														<th width="5%">Action</th>
													</tr>
													</thead>
													<tbody>
													</tbody>
                                                    
												</table>
												<input type="hidden" id="hiddenval1" name="hiddenval1" value="1"/></div>
											</td>
										  </tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td width="25%">Respondent Type</td>
												<td><select class="form-control text-uppercase" id="resp_type" name="resp_type">
													<option value="" >Select</option>
													<option value="I" <?php if($resp_type=="I") echo "selected";?> >Individual</option>
													<option value="G" <?php if($resp_type=="G") echo "selected";?> >Group</option>
												</select></td>
												<td width="25%">Respondent is</td>
												<td><select class="form-control text-uppercase"  id="resp_is" name="resp_is">
													<option value="" >Select</option>
													<option value="M" <?php if($resp_is=="M") echo "selected";?> >Main</option>
													<option value="O" <?php if($resp_is=="O") echo "selected";?>>Other</option>
													
												</select></td>
											</tr>
											<tr>
												<td>Name</td>
												<td><input type="text" class="form-control text-uppercase" 
												id="resp_name" name="resp_name" value="<?php echo $resp_name;?>"></td>
												<td>Age</td>
												<td><input type="text" class="form-control" id="resp_age" name="resp_age" value="<?php echo $resp_age;?>"></td>
											</tr>
											<tr>
												<td>Nationality</td>
												<td><select class="form-control text-uppercase" id="resp_nationality" name="resp_nationality">
													<option value="" >Select</option>
													<option value="I" <?php if($resp_nationality=="I") echo "selected";?> >Indian</option>
													<option value="O" <?php if($resp_nationality=="O") echo "selected";?>>Other</option>
												</select></td>
												<td>Gender</td>
												<td><select class="form-control text-uppercase" id="resp_gender" name="resp_gender">
													<option value="" >Select</option>
													<option value="M" <?php if($resp_gender=="M") echo "selected";?> >Male</option>
													<option value="F" <?php if($resp_gender=="F") echo "selected";?>>Female</option>
												</select></td>
											</tr>
											<tr>
												<td width="25%">Caste</td>
												<td><select class="form-control text-uppercase" id="resp_caste" name="resp_caste">
													<option value="" >Select</option>
													<option value="H" <?php if($resp_caste=="H") echo "selected";?> >Hindu</option>
													<option value="M" <?php if($resp_caste=="M") echo "selected";?>>Muslim</option>
													<option value="C" <?php if($resp_caste=="C") echo "selected";?> >Christian</option>
													<option value="O" <?php if($resp_caste=="O") echo "selected";?> >Other</option>
													</select>
												</td>
												<td width="25%">Father's name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  id="resp_father_name" name="resp_father_name" value="<?php echo $resp_father_name;?>"></td>
											</tr>
											<tr>
												<td>Mother's Name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  id="resp_mother_name" name="resp_mother_name" value="<?php echo $resp_mother_name;?>"></td>
												<td>Address</td>
												<td><textarea class="form-control text-uppercase" id="resp_address" name="res_address"><?php echo $resp_address; ?></textarea></td>
											</tr>
											<tr>
												<td>State</td>
												<td><input type="text" class="form-control text-uppercase" id="resp_state" name="resp_state" value="<?php echo $resp_state;?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase"  id="resp_dist" name="resp_dist" value="<?php echo $resp_dist;?>"></td>
											</tr>	
											<tr>
												<td>PIN</td>
												<td><input type="pincode" class="form-control"  id="resp_pin" name="resp_pin" validtae="pincode" maxlength="6" value="<?php echo $resp_pin;?>"></td>
												<td width="25%">Lawer Registration No</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" id="resp_law_reg_no" name="resp_law_reg_no" value="<?php echo $resp_law_reg_no;?>"></td>
											</tr>
											<tr>
												<td>Occupation</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" id="resp_occu" name="resp_occu" value="<?php echo $resp_occu;?>"></td>
												<td>Email ID</td>
												<td width="25%"><input type="email" class="form-control"  id="resp_email" name="resp_email" value="<?php echo $resp_email;?>"></td>
											</tr>
											<tr>
												<td width="25%">Mobile No</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" validtae="mobileNumber" maxlength="10" id="resp_mobile" name="resp_mobile" value="<?php echo $resp_mobile;?>"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td>Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b> <br/> Place : <label><?php echo strtoupper($dist);?> </label></td>
												<td></td><td></td>
												<td align="right"><label><b><?php echo strtoupper($key_person); ?></b></label><br/>Signature of the Applicant</td>	
											</tr>
											<tr><td class="text-center" colspan="4"></td></tr>
											<tr>										
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
													<button type="button" class="btn btn-primary" onclick="addMorefunction2()" name="save">ADD</button>
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
												</td>									
											</tr>
								
								          
										  <tr>
											<td colspan="4">
												<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
													<thead>
													<tr>
														
														<th width="10%">Respondent Type</th>
														<th width="10%">Name</th>
														<th width="5%">Gender</th>
														<th width="10%">Father's Name</th>
														<th width="10%">Mother's Name</th>
														<th width="10%">Address</th>
														<th width="10%">District</th>
														<th width="10%">Mobile</th>
														<th width="10%">Email</th>
														<th width="10%">State</th>
														<th width="10%">Action</th>
													</tr>
													</thead>
													<tbody>
													</tbody>													
												</table>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="hiddenval2"/></div>
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

var index = 1;
function addMorefunction1(){
	var peti_type_value;
	var peti_is_value;
	var peti_gender_value;
	var peti_nationality;
	
	var peti_type = $( "#peti_type option:selected" ).val();
	if(peti_type=="I") peti_type_value = "Individual";	else peti_type_value = "Group";
	
	var peti_is = $( "#peti_is option:selected" ).val();
	if(peti_is=="M") peti_is_value = "Main";	else peti_is_value = "Other";
	
	var peti_gender = $( "#peti_gender option:selected" ).val();
	if(peti_gender=="M") peti_gender_value = "Male";	else peti_gender_value = "Female";
	
	var peti_nationality = $( "#peti_nationality option:selected" ).val();
	if(peti_nationality=="I") peti_nationality_value = "Indian";	else peti_nationality_value = "Other";
	
	var peti_caste = $( "#peti_caste option:selected" ).val();
	if(peti_caste=="H") peti_caste_value = "Hindu";	else if(peti_caste=="M")  peti_caste_value = "Muslim";
	else if(peti_caste=="C") peti_caste_value = "Christian";	else peti_caste_value = "Other";
	
    var peti_name = $( "#peti_name" ).val();
	var peti_gender = $( "#peti_gender" ).val();
	var peti_father_name = $( "#peti_father_name" ).val();
	var peti_mother_name = $( "#peti_mother_name" ).val();
	var peti_address = $( "#peti_address" ).val();
	var peti_dist = $( "#peti_dist" ).val();
	var peti_mobile = $( "#peti_mobile" ).val();
	
	var peti_email = $( "#peti_email" ).val();
	var peti_dob = $( "#peti_dob" ).val();
	var peti_nationality = $( "#peti_nationality" ).val();
	var peti_caste = $( "#peti_caste" ).val();
	var peti_pin = $( "#peti_pin" ).val();
	var law_reg_no = $( "#law_reg_no" ).val();
	var peti_state = $( "#peti_state" ).val();
	var peti_occu = $( "#peti_occu" ).val();
	
	
	$('#objectTable1').append('<tr id="row'+index+'"><td><input type="hidden" name="peti_dob'+index+'" value="'+peti_dob+'"/><input type="hidden" name="peti_nationality'+index+'" value="'+peti_nationality+'"/><input type="hidden" name="peti_caste'+index+'" value="'+peti_caste+'"/><input type="hidden" name="peti_pin'+index+'" value="'+peti_pin+'"/><input type="hidden" name="law_reg_no'+index+'" value="'+law_reg_no+'"/><input type="hidden" name="peti_state'+index+'" value="'+peti_state+'"/><input type="hidden" name="peti_occu'+index+'" value="'+peti_occu+'"/><input type="hidden" name="peti_type'+index+'" value="'+peti_type+'"/>'+peti_type_value+'</td><td><input type="hidden" name="peti_is'+index+'" value="'+peti_is+'"/>'+peti_is_value+'</td><td><input type="hidden" name="peti_name'+index+'" value="'+peti_name+'"/>'+peti_name+'</td><td><input type="hidden" name="peti_gender'+index+'" value="'+peti_gender+'"/>'+peti_gender_value+'</td><td><input type="hidden" name="peti_father_name'+index+'" value="'+peti_father_name+'"/>'+peti_father_name+'</td><td><input type="hidden" name="peti_mother_name'+index+'" value="'+peti_mother_name+'"/>'+peti_mother_name+'</td><td><input type="hidden" name="peti_address'+index+'" value="'+peti_address+'"/>'+peti_address+'</td><td><input type="hidden" name="peti_dist'+index+'" value="'+peti_dist+'"/>'+peti_dist+'</td><td><input type="hidden" name="peti_mobile'+index+'" value="'+peti_mobile+'"/>'+peti_mobile+'</td><td><input type="hidden" name="peti_email'+index+'" value="'+peti_email+'"/>'+peti_email+'</td><td><button type="button" onclick="deleteRow1(this.value)" class="btn btn-danger btn-xs" value="'+index+'">Delete</button></td></tr>');
	index++;
	document.getElementById("hiddenval1").value=index;
	
	
}

function deleteRow1(row_id){
	//var value = $(this).val();
	alert(row_id);
	//$('table#objectTable1 tr#'+row_id).remove();
	document.getElementById("objectTable1").deleteRow(row_id);
		index--;
		document.getElementById("hiddenval1").value=index;
}


var index2 = 1;
function addMorefunction2(){

	var resp_type_value;
	var resp_is_value;
	var resp_caste_value;	
	var resp_gender_value;
	var resp_nationality_value;
	
	var resp_type = $( "#resp_type option:selected" ).val();
	if(resp_type=="I") resp_type_value = "Individual";	else resp_type_value = "Group";
	
	var resp_is = $( "#resp_is option:selected" ).val();
	if(resp_is=="M") resp_is_value = "Main";	else resp_is_value = "Other";
	
	var resp_gender = $( "#resp_gender option:selected" ).val();
	if(resp_gender=="M") resp_gender_value = "Male";	else resp_gender_value = "Female";
	
	var resp_nationality = $( "#resp_nationality option:selected" ).val();
	if(resp_nationality=="I") resp_nationality_value = "Indian";	else resp_nationality_value = "Other";
	
    var resp_caste = $( "#resp_caste option:selected" ).val();
	if(resp_caste=="H") resp_caste_value = "Hindu";	else if(resp_caste=="M")  resp_caste_value = "Muslim";
	else if(resp_caste=="C") resp_caste_value = "Christian";	else resp_caste_value = "Other";
   
   
	var resp_type = $( "#resp_type" ).val();
	var resp_father_name = $( "#resp_father_name" ).val();
	var resp_mother_name = $( "#resp_mother_name" ).val();
	var resp_address = $( "#resp_address" ).val();
	var resp_dist = $( "#resp_dist" ).val();
	var resp_mobile = $( "#resp_mobile" ).val();
	var resp_email = $( "#resp_email" ).val();
	var resp_state = $( "#resp_state" ).val();	
	var resp_name = $( "#resp_name" ).val();
	var resp_gender = $( "#resp_gender" ).val();
	
	var resp_is = $( "#resp_is" ).val();
	var resp_age = $( "#resp_age" ).val();
	var resp_nationality = $( "#resp_nationality" ).val();
	var resp_caste = $( "#resp_caste" ).val();
	var resp_pin = $( "#resp_pin" ).val();
	var resp_law_reg_no = $( "#resp_law_reg_no" ).val();
	var resp_occu = $( "#resp_occu" ).val();
	
	
	$('#objectTable2').append('<tr id="row'+index2+'"><td><input type="hidden" name="resp_is'+index2+'" value="'+resp_is+'"/><input type="hidden" name="resp_age'+index2+'" value="'+resp_age+'"/><input type="hidden" name="resp_nationality'+index2+'" value="'+resp_nationality+'"/><input type="hidden" name="resp_caste'+index2+'" value="'+resp_caste+'"/><input type="hidden" name="resp_pin'+index2+'" value="'+resp_pin+'"/><input type="hidden" name="resp_law_reg_no'+index2+'" value="'+resp_law_reg_no+'"/><input type="hidden" name="resp_occu'+index2+'" value="'+resp_occu+'"/><input type="hidden" name="resp_type'+index2+'" value="'+resp_type+'"/>'+resp_type_value+'</td><td><input type="hidden" name="resp_name'+index2+'" value="'+resp_name+'"/>'+resp_name+'</td><td><input type="hidden" name="resp_gender'+index2+'" value="'+resp_gender+'"/>'+resp_gender_value+'</td><td><input type="hidden" name="resp_father_name'+index2+'" value="'+resp_father_name+'"/>'+resp_father_name+'</td><td><input type="hidden" name="resp_mother_name'+index2+'" value="'+resp_mother_name+'"/>'+resp_mother_name+'</td><td><input type="hidden" name="resp_address'+index2+'" value="'+resp_address+'"/>'+resp_address+'</td><td><input type="hidden" name="resp_dist'+index2+'" value="'+resp_dist+'"/>'+resp_dist+'</td><td><input type="hidden" name="resp_mobile'+index2+'" value="'+resp_mobile+'"/>'+resp_mobile+'</td><td><input type="hidden" name="resp_email'+index2+'" value="'+resp_email+'"/>'+resp_email+'</td><td><input type="hidden" name="resp_state'+index2+'" value="'+resp_state+'"/>'+resp_state+'</td><td><button type="button" onclick="deleteRow2(this.value)" class="btn btn-danger btn-xs" value="'+index2+'">Delete</button></td></tr>');
	index2++;
	document.getElementById("hiddenval2").value=index2;
	
}
function deleteRow2(row_id){
	//var value = $(this).val();
	alert(row_id);
	//$('table#objectTable1 tr#'+row_id).remove();
	document.getElementById("objectTable2").deleteRow(row_id);
		index2--;
		document.getElementById("hiddenval2").value=index2;
}

    <?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	$('.dob2').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
</script>