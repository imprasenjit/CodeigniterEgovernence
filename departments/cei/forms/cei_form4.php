<?php  require_once "../../requires/login_session.php";
$dept="cei";
$form="4";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ;
	
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$father_name=$results['father_name'];$name_of_license=$results['name_of_license'];$applicant_relation=$results['applicant_relation'];$dt_of_renew=$results['dt_of_renew'];$dt_of_validity=$results['dt_of_validity'];$any_other_info=$results['any_other_info'];$license_detail_reg=$results['license_detail_reg'];$license_detail_clas=$results['license_detail_clas'];	
			if(!empty($results["present_addr"]))
			{
				$present_addr=json_decode($results["present_addr"]);
				$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;$present_addr_email=$present_addr->email;
			}
			else
			{
				$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
			}
			#####PartII####
			if(!empty($results["superviror_detail"]))
			{
				$superviror_detail=json_decode($results["superviror_detail"]);
				$superviror_detail_name=$superviror_detail->name;$superviror_detail_reg=$superviror_detail->reg;$superviror_detail_clas=$superviror_detail->clas;$superviror_detail_valid=$superviror_detail->valid;$superviror_detail_from=$superviror_detail->from;$superviror_detail_to=$superviror_detail->to;
			}
			else
			{
				$superviror_detail_name="";$superviror_detail_reg="";$superviror_detail_clas="";$superviror_detail_valid="";$superviror_detail_from="";$superviror_detail_to="";
			}
			#####PartIII####
			$year_to=$results['year_to'];$year_from=$results['year_from'];
			if(!empty($results["work_return"]))
			{
				$work_return=json_decode($results["work_return"]);
				$work_return_name=$work_return->name;$work_return_reg=$work_return->reg;$work_return_clas=$work_return->clas;$work_return_valid=$work_return->valid;$work_return_from=$work_return->from;$work_return_to=$work_return->to;
			}
			else
			{
				$work_return_name="";$work_return_reg="";$work_return_clas="";$work_return_valid="";$work_return_from="";$work_return_to="";
			}
			
		}else{
			$form_id="";
			###PartI####
			$father_name="";$name_of_license="";$applicant_relation="";$dt_of_renew="";$dt_of_validity="";$any_other_info="";$license_detail_reg="";$license_detail_clas="";		
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
			
			#####PartII####
			$superviror_detail_name="";$superviror_detail_reg="";$superviror_detail_clas="";$superviror_detail_valid="";$superviror_detail_from="";$superviror_detail_to="";
			####Part III####
			$year_to="";$year_from="";
			$work_return_name="";$work_return_reg="";$work_return_clas="";$work_return_valid="";$work_return_from="";$work_return_to="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$father_name=$results['father_name'];$name_of_license=$results['name_of_license'];$applicant_relation=$results['applicant_relation'];$dt_of_renew=$results['dt_of_renew'];$dt_of_validity=$results['dt_of_validity'];$any_other_info=$results['any_other_info'];$license_detail_reg=$results['license_detail_reg'];$license_detail_clas=$results['license_detail_clas'];	
		if(!empty($results["present_addr"]))
		{
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;$present_addr_email=$present_addr->email;
		}
		else
		{
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}
		#####PartII####
		if(!empty($results["superviror_detail"]))
		{
			$superviror_detail=json_decode($results["superviror_detail"]);
			$superviror_detail_name=$superviror_detail->name;$superviror_detail_reg=$superviror_detail->reg;$superviror_detail_clas=$superviror_detail->clas;$superviror_detail_valid=$superviror_detail->valid;$superviror_detail_from=$superviror_detail->from;$superviror_detail_to=$superviror_detail->to;
		}
		else
		{
			$superviror_detail_name="";$superviror_detail_reg="";$superviror_detail_clas="";$superviror_detail_valid="";$superviror_detail_from="";$superviror_detail_to="";
		}
		#####PartIII####
		$year_to=$results['year_to'];$year_from=$results['year_from'];
		if(!empty($results["work_return"]))
		{
			$work_return=json_decode($results["work_return"]);
			$work_return_name=$work_return->name;$work_return_reg=$work_return->reg;$work_return_clas=$work_return->clas;$work_return_valid=$work_return->valid;$work_return_from=$work_return->from;$work_return_to=$work_return->to;
		}
		else
		{
			$work_return_name="";$work_return_reg="";$work_return_clas="";$work_return_valid="";$work_return_from="";$work_return_to="";
		}
		
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
	<?php include ("cei_form4_addmore.php"); ?>
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
							    <ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">									
									<tr>
										<td width="25%">1. Name of the Applicant:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly" validate="jsonObj" value="<?php echo $key_person; ?>" ></td>
										<td width="25%">2. Father&apos;s Name:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="father_name" validate="letters" value="<?php echo $father_name; ?>"></td>
									</tr>
									<tr>
									    <td colspan="4">3. Present Address:</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[st1]"  value="<?php echo $present_addr_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[st2]"  value="<?php echo $present_addr_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[vt]"  value="<?php echo $present_addr_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($present_addr_dist);?>"   name="present_addr[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[pin]"  value="<?php echo $present_addr_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[mob]"  value="<?php echo $present_addr_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" name="present_addr[email]" validate="jsonObj" value="<?php echo  $present_addr_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>4. Name of the license </td>
										<td><input type="text" class="form-control text-uppercase" name="name_of_license"  value="<?php echo  $name_of_license; ?>"></td>
										<td></td>
										<td></td>										
									</tr>
									<tr>
										<td colspan="4">5. Registration no. and class of the license</td>
									</tr>
									<tr>
										<td>(a) Registration no.: </td>
										<td><input type="text" class="form-control text-uppercase" name="license_detail_reg"  value="<?php echo  $license_detail_reg; ?>"></td>
										<td>(b) Class of the license<span class="mandatory_field">*</span></td></td></td>
										<td><select class="form-control" name="license_detail_clas" required="required" >
												<option value="">Please select one class</option>
												<option <?php if($license_detail_clas==1) echo "selected"; ?> value="1">Class I</option>
												<option <?php if($license_detail_clas==2) echo "selected"; ?> value="2">Class II (for building Wiring)</option>
												<option <?php if($license_detail_clas==3) echo "selected"; ?> value="3">Class II (for installations upto 650 Volts)</option>
												<option <?php if($license_detail_clas==4) echo "selected"; ?> value="4">Special Class</option>
											</select></td>										
									</tr>
									<tr>
										<td>6. Relationship of the applicant with the licensee and the capacity to file the application :</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant_relation"  value="<?php echo  $applicant_relation; ?>"></td>
										<td></td>
										<td></td>										
									</tr>
									<tr>
										<td colspan="4">7. Business address of the licensee</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly"  value="<?php echo $b_street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly"  value="<?php echo $b_street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly"  value="<?php echo $b_vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly"  value="<?php echo $b_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_pincode; ?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_landline_std." - ".$b_landline_no; ?>"></td>
										<td>Email Id:</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" validate="jsonObj"value="<?php echo  $b_email; ?>"></td>
									</tr>
									<tr>
										<td>8.(a) Date of the last renewal:</td>
										<td><input type="text" class="dob form-control text-uppercase" name="dt_of_renew"  value="<?php echo  $dt_of_renew; ?>" readonly="readonly"></td>
										<td>(b) Date of validity</td>
										<td><input type="text" class="dob form-control text-uppercase" name="dt_of_validity"  value="<?php echo  $dt_of_validity; ?>" readonly="readonly"></td>										
									</tr>
									<tr>
										<td>9. Any other information</td>
										<td><textarea  class="form-control text-uppercase"  name="any_other_info" maxlength="255"><?php echo  $any_other_info; ?></textarea>255 Characters Only</td>
										<td></td>
										<td></td>										
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4" align="center"><b>DETAILS OF SUPERVISORS, WORKMEN AND APPERNTICES AS ON </b></td>
									</tr>
									<tr>
										<td>1. Name of the contractor</td>
										<td><input type="text" class="form-control text-uppercase" name="superviror_detail[name]" validate="letters" value="<?php echo  $superviror_detail_name; ?>"></td>
										<td>2. Registration no. of the license</td>
										<td><input type="text" class="form-control text-uppercase" name="superviror_detail[reg]"   value="<?php echo  $superviror_detail_reg; ?>"></td>	
									</tr>
									<tr>
										<td>3. Class of the license</td>
										<td><input type="text" class="form-control text-uppercase" name="superviror_detail[clas]"  value="<?php echo  $superviror_detail_clas; ?>"></td>
										<td>4. License valid up-to</td>
										<td><input type="text" class="dob form-control text-uppercase" name="superviror_detail[valid]"   value="<?php echo  $superviror_detail_valid; ?>"></td>	
									</tr>
									<tr>
										<td colspan="4">5. Period of return</td>
									</tr>
									<tr>
										<td>From:</td>
										<td> <input type="text" class="dob form-control text-uppercase" name="superviror_detail[from]"  value="<?php echo  $superviror_detail_from; ?>"> </td>
										<td>To:</td>
										<td><input type="text" class="dob form-control text-uppercase" name="superviror_detail[to]"  value="<?php echo  $superviror_detail_to; ?>"></td>	
									</tr>
									<tr>
										<td colspan="4">6. Details of the supervisors, workmen and apprentice during the period of return </td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="15">Name</th>
													<th width="20%">Designation </th>
													<th width="10%">Supervisor </th>
													<th width="10">Workmen </th>
													<th width="10">Apprentice</th>
													<th width="10">Registration no. of permit/certificate</th>
													<th width="10">Parts qualified </th>
													<th width="10">Date of validity  </th>
												</tr>
												</thead>
												<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_enclosure4 where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input type="text"  id="txtB<?php echo $count;?>" class="form-control text-uppercase" validate="letters" value="<?php echo $row_1["name"]; ?>" name="txtB<?php echo $count;?>" size="20"></td>
														<td><input type="text" value="<?php echo $row_1["desig"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>			
														<td><input type="text" value="<?php echo $row_1["supervisor"]; ?>" id="txtD<?php echo $count;?>"  class="form-control text-uppercase" name="txtD<?php echo $count;?>"   size="10"></td>
														<td><input type="text" value="<?php echo $row_1["workman"]; ?>" id="txtE<?php echo $count;?>"  name="txtE<?php echo $count;?>" class="form-control text-uppercase">
														<td><input type="text" value="<?php echo $row_1["apprentice"]; ?>" id="txtF<?php echo $count;?>"  name="txtF<?php echo $count;?>" class="form-control text-uppercase">
														<td><input type="text" value="<?php echo $row_1["reg_no"]; ?>" id="txtG<?php echo $count;?>"  name="txtG<?php echo $count;?>" class="form-control text-uppercase">
														<td><input type="text" value="<?php echo $row_1["parts"]; ?>" id="txtH<?php echo $count;?>" name="txtH<?php echo $count;?>"  class="form-control text-uppercase">
														<td><input  type="text" value="<?php echo $row_1["dt_of_val"]; ?>" id="txtI<?php echo $count;?>" name="txtI<?php echo $count;?>" class=" dob form-control text-uppercase" size="10">
														</td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text"  readonly value="1" id="txtA1" size="1"  class="form-control text-uppercase"  name="txtA1"></td>
														<td><input  type="text" id="txtB1"  class="form-control text-uppercase" validate="letters" name="txtB1"></td>
														<td><input type="text" id="txtC1" title="No special characters are allowed except Dot"   class="form-control text-uppercase" name="txtC1" size="20"></td>					
														<td><input type="text"  id="txtD1"  class="form-control text-uppercase" name="txtD1"  size="20"></td>
														<td><input type="text" id="txtE1"  class="form-control text-uppercase" name="txtE1"  size="10"></td>
														<td><input type="text" id="txtF1"  class="form-control text-uppercase" name="txtF1"  size="10"></td>
														<td><input type="text" id="txtG1"  class="form-control text-uppercase" name="txtG1"  size="10"></td>
														<td><input type="text"  id="txtH1"  class="form-control text-uppercase" name="txtH1"  size="10"></td>
														<td><input type="text" id="txtI1" class="dob form-control text-uppercase" name="txtI1"  size="10"></td>
													</tr>
													<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>														
									<tr>
										<td class="text-center" colspan="4">
											<a href="cei_form4.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>					
									</tr>				
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
									<tr>
										<td colspan="4" align="center"><b>RETURN OF WORKS FOR THE YEAR &nbsp;&nbsp;&nbsp;<input type="number"  name="year_to" class="form-control1 text-uppercase"  value="<?php echo $year_to?>">&nbsp;-&nbsp;<input type="number"  class="form-control1 text-uppercase" name="year_from" value="<?php echo $year_from?>"> </b> </td>
									</tr>
									<tr>
										<td>1. Name of the contractor</td>
										<td><input type="text" class="form-control text-uppercase" name="work_return[name]" validate="letters"  value="<?php echo  $work_return_name; ?>"></td>
										<td>2. Registration no. of the license</td>
										<td><input type="text" class="form-control text-uppercase" name="work_return[reg]"   value="<?php echo  $work_return_reg; ?>"></td>	
									</tr>
									<tr>
										<td>3. Class of the license</td>
										<td><input type="text" class="form-control text-uppercase" name="work_return[clas]"  value="<?php echo  $work_return_clas; ?>"></td>
										<td>4. License valid up-to</td>
										<td><input type="text" class="dob form-control text-uppercase" name="work_return[valid]"   value="<?php echo  $work_return_valid; ?>"></td>	
									</tr>
									<tr>
										<td colspan="4">5. Period of return</td>
									</tr>
									<tr>
										<td>From:</td>
										<td><input type="text" class="dob form-control text-uppercase" name="work_return[from]"  value="<?php echo $work_return_from; ?>"> </td>
										<td>To:</td>
										<td><input type="text" class="dob form-control text-uppercase" name="work_return[to]"  value="<?php echo  $work_return_to; ?>"></td>	
									</tr>
									<tr>
										<td colspan="4">6. Details of works and staff alloted therefore </td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="15">Referrence no. of FORM-C </th>
													<th width="20%">Name & description of the work with address </th>
													<th width="10%">Name of the entrusted with regd. no. of the certificates of competency  </th>
													<th width="10">Name of the workmen entrusted with regd. no. of the permits </th>
													<th width="10">Name of the apprentices deployed </th>
													<th width="10">Date of completion  </th>
													<th width="10">Reference & date of test report</th>
													<th width="10">Report submitted to  </th>
												</tr>
												</thead>
												<?php
													$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_enclosure5 where form_id='$form_id'");
													$num2= $part2->num_rows;
													if($num2>0){
													$count=1;
													while($row_1=$part2->fetch_array()){	?>
													<tr>
														<td><input text="type" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["sl_no"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
														<td><input type="text" id="txxtB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["ref_no"]; ?>" name="txxtB<?php echo $count;?>" size="20"></td>
														<td><input type="text" value="<?php echo $row_1["address"]; ?>" id="txxtC<?php echo $count;?>"  class="form-control text-uppercase" name="txxtC<?php echo $count;?>"></td>			
														<td><input type="text" value="<?php echo $row_1["certificate"]; ?>" id="txxtD<?php echo $count;?>"  class="form-control text-uppercase" name="txxtD<?php echo $count;?>"  ></td>
														<td><input type="text" value="<?php echo $row_1["workman"]; ?>"  id="txxtE<?php echo $count;?>" name="txxtE<?php echo $count;?>" class="form-control text-uppercase">
														<td><input type="text" value="<?php echo $row_1["apprentice"]; ?>" id="txxtF<?php echo $count;?>" name="txxtF<?php echo $count;?>"  class="form-control text-uppercase">
														<td><input type="text" value="<?php echo $row_1["dt_of_com"]; ?>"  id="txxtG<?php echo $count;?>" name="txxtG<?php echo $count;?>" class="dob form-control text-uppercase">
														<td><input  type="text" value="<?php echo $row_1["test_report"]; ?>" id="txxtH<?php echo $count;?>" name="txxtH<?php echo $count;?>" class="form-control text-uppercase">
														<td><input type="text" value="<?php echo $row_1["report"]; ?>"  id="txxtI<?php echo $count;?>" name="txxtI<?php echo $count;?>" class="form-control text-uppercase">
														</td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input  type="text" readonly value="1"  id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
														<td><input  type="text"id="txxtB1"  class="form-control text-uppercase"  name="txxtB1"></td>
														<td><input type="text" id="txxtC1"   class="form-control text-uppercase" name="txxtC1"></td>					
														<td><input type="text" id="txxtD1"  class="form-control text-uppercase" name="txxtD1"></td>
														<td><input type="text" id="txxtE1"  class="form-control text-uppercase" name="txxtE1"></td>
														<td><input type="text" id="txxtF1"  class="form-control text-uppercase" name="txxtF1"></td>
														<td><input type="text" id="txxtG1"  class="dob form-control text-uppercase" name="txxtG1"></td>
														<td><input type="text" id="txxtH1"  class="form-control text-uppercase" name="txxtH1"></td>
														<td><input type="text" id="txxtI1"  class="form-control text-uppercase" name="txxtI1"></td>
													</tr>
													<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td>Date :<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/>
											Place:<strong><?php echo strtoupper($dist)?></strong></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="right"><strong><?php echo strtoupper($key_person)?></strong><br/>Signature of the contractor</td>
									</tr>									
									<tr>
										<td class="text-center" colspan="4">
											<a href="cei_form4.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
										</td>					
									</tr>	
							</table>
							</form>
							</div>
							
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
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
</script>