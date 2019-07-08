<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="7";
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
			$fa_sp_name=$results["fa_sp_name"];$dob_con=$results["dob_con"];$age_con=$results["age_con"];$type_of_business=$results["type_of_business"];
			
			$num_of_cert_reg=$results["num_of_cert_reg"];$date_of_cert_reg=$results["date_of_cert_reg"];
			
			$cont_offence=$results["cont_offence"];$dob3=$results["dob3"];$work_con=$results["work_con"];$enclosed_cert=$results["enclosed_cert"];$max_workers=$results["max_workers"];	
	
			if(!empty($results["manager"])){				
				$manager=json_decode($results["manager"]);
				$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d; 
				$manager_p=$manager->p;				
			}else{
				$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
			}
			
			if(!empty($results["mig_workmen"])){				
				$mig_workmen=json_decode($results["mig_workmen"]);
				$mig_workmen_a=$mig_workmen->a;$mig_workmen_b=$mig_workmen->b;
			}else{
				$mig_workmen_a="";$mig_workmen_b="";
			}			
		}else{
			$form_id="";$fa_sp_name="";$dob_con="";$age_con="";$type_of_business="";
			$num_of_cert_reg="";$date_of_cert_reg="";
			
			$cont_offence="";$dob3="";$work_con="";$enclosed_cert="";
			$employ_name="";$employ_sn1="";$employ_sn2="";$employ_v="";$employ_d="";$employ_p="";
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
			$mig_workmen_a="";$mig_workmen_b="";$max_workers="";	
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$fa_sp_name=$results["fa_sp_name"];$dob_con=$results["dob_con"];$age_con=$results["age_con"];$type_of_business=$results["type_of_business"];
		
		$num_of_cert_reg=$results["num_of_cert_reg"];$date_of_cert_reg=$results["date_of_cert_reg"];
		
		$cont_offence=$results["cont_offence"];$dob3=$results["dob3"];$work_con=$results["work_con"];$enclosed_cert=$results["enclosed_cert"];$max_workers=$results["max_workers"];	

		if(!empty($results["manager"])){				
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d; 
			$manager_p=$manager->p;				
		}else{
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
		}
		
		if(!empty($results["mig_workmen"])){				
			$mig_workmen=json_decode($results["mig_workmen"]);
			$mig_workmen_a=$mig_workmen->a;$mig_workmen_b=$mig_workmen->b;
		}else{
			$mig_workmen_a="";$mig_workmen_b="";
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
	<?php include ("lc_license_form".$form."_Addmore-operation.php"); ?>
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
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
								</ul>
								<br>
							<div class="tab-content">
							<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="my_form7" id="my_form7" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td colspan="4">1. Name and address of the contractor (including his father's/husband's name in case of individuals) </td>
									</tr>
									<tr>
										<td width="25%">Full Name</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $key_person; ?>" disabled="disabled"></td>
										<td width="25%">Father's/Spouse's Name<span class="mandatory_field">*</span></td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="letters" name="fa_sp_name" id="fa_sp_name" value="<?php echo $fa_sp_name; ?>" required></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">2. Date of birth and age (in case of individual) </td>
									</tr>
									<tr>
										<td >(a) Date:</td>
										<td><input type="datetime" id="dob" class="form-control text-uppercase" placeholder="DD/MM/YYYY" name="dob_con" onchange="date_of_birth(this.id)" value="<?php echo $dob_con; ?>"></td>
										<td>(b) Age:</td>
										<td><input type="text" class="form-control text-uppercase" id="owner_age" name="age_con"  value="<?php echo $age_con; ?>" validate="onlyNumbers" readonly="readonly"/></td>
									</tr>
									<tr>
										<td colspan="4">3. Particulars of establishment where migrant workmen are to be employed</td>
									</tr>
									<tr>
										<td colspan="4">(a) Name and address of the establishment </td>
									</tr>
									<tr>
										<td >Full Name</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>" ></td>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>" ></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>" ></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>" ></td>
									</tr>
									<tr>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>" ></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>" ></td>
									</tr>
									<tr>
										<td colspan="3">(b) Type of business, industry, manufacture or occupation, which is carried on in the establishment </td>
										<td><input type="text" class="form-control text-uppercase" name="type_of_business" value="<?php echo $type_of_business; ?>" requried></td>
									</tr>	
									<tr>
										<td colspan="4">(c)Number and date of certificate of registration of the establishment under the Act</td>
									</tr>
									<tr>
										<td>Number</td>
										<td><input type="text" required class="form-control text-uppercase" name="num_of_cert_reg" value="<?php echo $num_of_cert_reg; ?>"></td>
										<td>Date</td>
										<td><input type="text" required class="dobindia form-control" name="date_of_cert_reg" value="<?php echo $date_of_cert_reg; ?>"></td>
									</tr>
									
									
									<tr>
										<td colspan="4">(d) Full name and address of the Principal Employer </td>
									</tr>
									<tr>
										<td >Full Name</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
									</tr>
									<tr>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
										<td>Pincode</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" value="SAVE & NEXT" name="save<?php echo $form;?>a" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="my_form7" id="my_form7" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table  class="table table-responsive">
									<tr>
										<td colspan="4">4. Particulars of contract labour </td>
									</tr>
									<tr>
										<td width="25%">(a) Nature of work in which migrant workmen are employed or are to be employed in the establishment </td>
										<td width="25%"><textarea class="form-control text-uppercase" name="mig_workmen[a]"><?php echo $mig_workmen_a; ?></textarea></td>
										<td width="25%">(b) Duration of the proposed contract work (give particulars of proposed date of commencing and ending)</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="mig_workmen[b]"><?php echo $mig_workmen_b; ?></textarea></td>			
									</tr>
									<tr>
										<td colspan="4">(c) Name and address of the agent or manager of the contractor at the work site and exact location of the work site <span class="mandatory_field">*</span></td>
									</tr>
									<tr>
										<td>Full Name</td>
										<td><input type="text" class="form-control text-uppercase" name="manager[name]" validate="letters" value="<?php echo $manager_name; ?>" required></td>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $manager_sn1; ?>" name="manager[sn1]"  required></td>
									</tr>
									<tr>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="manager[sn2]" value="<?php echo $manager_sn2; ?>" required></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase"  name="manager[v]" value="<?php echo $manager_v; ?>" required ></td>
									</tr>
									<tr>
										<td>District</td>
										<td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($manager_d);?>"  placeholder="Enter District" name="manager[d]">    
                                        </td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" validate="pincode" name="manager[p]" value="<?php echo $manager_p; ?>" validate="pincode" maxlength="6" required ></td>
									</tr>
									<tr>
										<td colspan="3">(d) Maximum number of migrant workmen proposed to be employed in the establishment <br/>on any date.<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="max_workers" value="<?php echo $max_workers; ?>" required> </td>
									</tr>
									<tr>
										<td colspan="4">(e) Names and address of the Directors/Partners in case of companies and firms </td>
									</tr>
									<tr>
										<td colspan="4"> 
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
										<tbody>
											<tr>
												<td >Sl. No.</td>
												<td >Full Name</td>
												<td >Street Name 1</td>
												<td >Street Name 2</td>
												<td >Town/Vill</td>
												<td >District</td>
												<td >Pin Code</td>
											</tr>
											<?php
										$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
										$count=1;
										while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_1["field1"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input type="text" value="<?php echo $row_1["field2"]; ?>" validate="letters" id="txtB<?php echo $count;?>" class="form-control text-uppercase"; size="20" name="txtB<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_1["field3"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase"; name="txtC<?php echo $count;?>" size="15"></td>				
											<td><input type="text" value="<?php echo $row_1["field4"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase"; name="txtD<?php echo $count;?>" size="15"></td>
											<td><input type="text" value="<?php echo $row_1["field5"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase"; name="txtE<?php echo $count;?>" size="10"></td>
											<td><input type="text" value="<?php echo $row_1["field6"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase"; name="txtF<?php echo $count;?>"  size="10"></td>			
											<td><input type="text" value="<?php echo $row_1["field7"]; ?>"  maxlength="6" validate="pincode"  title="Enter 6 Digit Pin Code" id="txtA<?php echo $count;?>" class="form-control text-uppercase"; name="txtG<?php echo $count;?>" size="5" ></td>
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
											<td><input type="text" id="txtB1" size="20" validate="letters" class="form-control text-uppercase"; name="txtB1"></td>					
											<td><input type="text" id="txtC1" size="15" class="form-control text-uppercase";  name="txtC1"></td>
											<td><input type="text" id="txtD1" size="15" class="form-control text-uppercase"; name="txtD1"></td>
											<td><input type="text" id="txtE1" size="10" class="form-control text-uppercase"; name="txtE1"></td>
											<td><input type="text" id="txtF1"  size="10" class="form-control text-uppercase"; name="txtF1"></td>
											<td><input type="text" id="txtG1" size="5" class="form-control text-uppercase"; pattern="[0-9]{6,6}"  maxlength="6" validate="pincode"  title="Enter 6 Digit Pin Code" name="txtG1"></td>
										</tr>
										<?php } ?>
									<tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											
											<button type="button" class="btn btn-default pull-right" href="#" onclick="mydelfunction1()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onclick="addMorefunction1()" value="">Add More</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</td>
									</tr>
									<tr>
										<td colspan="4">(f) Name(s) and address (es) of the person (s) in-charge of and responsible to the Company/firm for the conduct of the business of the company/firm, as the case may be. </td>
									</tr>
									<tr>
										<td colspan="4"> 
										<table name="objectTable2" id="objectTable2" class="table table-responsive">
										<tbody>
											<tr>
												<td >Sl. No.</td>
												<td >Full Name</td>
												<td >Street Name 1</td>
												<td >Street Name 2</td>
												<td >Town/Vill</td>
												<td >District</td>
												<td >Pin Code</td>
											</tr>
											<?php
											$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
											$num2 = $part2->num_rows;
											if($num2>0){
											  $count=1;
											  while($row_1=$part2->fetch_array()){	?>
											 <tr>
												<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["field1"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
												<td><input type="text" value="<?php echo $row_1["field2"]; ?>" validate="letters" id="textB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_1["field3"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="15"></td>				
												<td><input type="text" value="<?php echo $row_1["field4"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="15"></td>
												<td><input type="text" value="<?php echo $row_1["field5"]; ?>" id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" size="10"></td>
												<td><input type="text" value="<?php echo $row_1["field6"]; ?>" id="textF<?php echo $count;?>" class="form-control text-uppercase" name="textF<?php echo $count;?>"  size="10"></td>			
												<td><input type="text" value="<?php echo $row_1["field7"]; ?>" id="textA<?php echo $count;?>" class="form-control text-uppercase"  maxlength="6" validate="pincode"  name="textG<?php echo $count;?>" size="5" ></td>
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
										  <td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
										  <td><input type="text" id="textB1" size="20" validate="letters" class="form-control text-uppercase" name="textB1"></td>					
										  <td><input type="text" id="textC1" size="15" class="form-control text-uppercase"  name="textC1"></td>
										  <td><input type="text" id="textD1" size="15" class="form-control text-uppercase" name="textD1"></td>
										  <td><input type="text" id="textE1" size="10" class="form-control text-uppercase" name="textE1"></td>
										  <td><input type="text" id="textF1"  size="10" class="form-control text-uppercase" name="textF1"></td>
										  <td><input type="text" id="textG1" size="5" maxlength="6" validate="pincode"  class="form-control text-uppercase" name="textG1"></td>
										</tr>
										<?php } ?>
									<tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMorefunction2()" value="">Add More</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="lc_license_form<?php echo $form; ?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" value="SAVE & NEXT" name="save<?php echo $form;?>b"  title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="my_form7" id="my_form7" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table  class="table table-responsive">									
									<tr>
										<td colspan="3">5. Whether the contractor was convicted of any offence within the preceding five years. If so, give details</td>
										<td ><textarea class="form-control text-uppercase" maxlength="255" name="cont_offence" validate="textarea"><?php echo $cont_offence; ?></textarea>255 Characters </td>
									</tr>		
									<tr>
										<td colspan="3">6. Whether there was any order against the contractor revoking or suspending licence or forfeiting security deposits in respect of an earlier contract, if so, the date of such order</td>
										<td><input type="text" class="form-control text-uppercase" name="dob3"  value="<?php echo $dob3; ?>"/></td>			
									</tr>
									<tr>
										<td  colspan="3">7. Whether the Contractor has worked in any other establishment within the past five years. If so, give details of the principal employer establishment and nature of work </td>
										<td ><textarea class="form-control text-uppercase" maxlength="255" name="work_con" validate="textarea"><?php echo $work_con; ?></textarea>255 characters</td>
									   
									</tr>
									<tr>
										<td colspan="3">8. Whether a certificate by the principal employer in Form-VI is enclosed</td>
										<td><input type="text" class="form-control text-uppercase" name="enclosed_cert" value="<?php echo $enclosed_cert; ?>"/></td>
										
									</tr>
									<tr>
										<td class="form-inline">Date :&nbsp;<?php echo date('d-m-Y',strtotime($today)); ?><br/>
										Place :&nbsp;<label id="name" name="name"><?php echo strtoupper($dist); ?></label><br/></td>
										<td></td>
										<td></td>
										<td  > 
											<label><?php echo strtoupper($key_person); ?></label><br>Signature of the Applicant (Contractor)<br/>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
										<a href="lc_license_form<?php echo $form; ?>.php?tab=2" class="btn btn-primary">Go Back & Edit</a>&nbsp;
											<button type="submit" class="btn btn-success submit1" value="SAVE & NEXT" name="save<?php echo $form;?>c" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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
	function date_of_birth(obj){
		var str2=$('#'+obj).val();
		var str3 = str2.replace('-','');
		var str = str3.replace('-','');
		var day=Number(str.substr(0,2));		
		var month=Number(str.substr(2,2))-1;
		var year=Number(str.substr(4,4));
		var today=new Date();
		var age=today.getFullYear()-year;
		
		if((today.getMonth()< month) || (today.getMonth()==month && today.getDate()<day)){
			age--;
		}
		if(age<18){
			alert('Your age must be greater than 18 to fill up this form');
			$('#owner_age').val('');
			$('#dob').val('');		
		}else{
			$('#owner_age').val(age);		
		}	
	}
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>