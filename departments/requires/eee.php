<?php
/* ob_start();
$ciIndex = $_SERVER['DOCUMENT_ROOT'].'/eodbci/index.php';
require_once($ciIndex);
ob_end_clean();
$ci = & get_instance();

require_once ($_SERVER['DOCUMENT_ROOT'].'/eodbci/departments/db_config/DbConnect.php');
$dbconnect = new DbConnect(); */

$this->load->helper("department");
$this->load->helper("get_uain_details");
//$this->load->helper("formname");

$this->load->model('forms/common/Form_details_model');
$this->load->model('eodbfunctions/GetDistrict_model');	
$db = $this->load->database();	
		
	$test=Array();
	$test=explode("/",$token); 
	if($test==false){
			echo "<script>
					alert('Invalid UAIN/UBIN !!');
					window.location.href = '/eodbci/';
				</script>";
			
	}else if($this->uri->segment(4)!=NULL){
		$token=$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8).'/'.$this->uri->segment(9);
		// echo $token; die();
		 
		$secondPart=$test[1];
		if(strlen($secondPart)==10){
			
			$ubinSection="";
			$ubin=$token;
			$unit_details = $this->unit_model->getunit("ubin", $ubin);
			
				if($unit_details == NULL){
					header("Location: /eodbci/users/");
					exit;
				}
			
				//var_dump($row);die();
				$unit_name=$unit_details->unit_name;
					$b_mobile_no=$unit_details->mobile_no;
					$b_email=$unit_details->email_id;
					$b_landline_std=$unit_details->landline_std;
					$b_landline_no=$unit_details->landline_no;
					$key_person=$unit_details->app_name;
					$status_applicant=$unit_details->app_designation;
					$mobile_no=$unit_details->app_mobile_no;
					$email=$unit_details->app_email;
					$unit_type=$unit_details->unit_type;
					$date_of_commencement=$unit_details->dateofcommencement;
					
					$address=$unit_details->address;
					$app_addressid=$unit_details->app_addressid;
					
					$business_type=$unit_details->business_type;
					$unit_id=$unit_details->unit_id;
					$caf_id=$unit_details->caf_id;
				
				$caf_details = $this->caf_model->getCaf($caf_id);
					$owner=$caf_details->owner_names;
					$pan=$caf_details->pan;
					$pan_name=$caf_details->pan_name;
					$legal_entity=$caf_details->entity_id;
					$cin_llpin=$caf_details->cin_llpin;
					$legal_entity_name=$caf_details->entp_name;
					$address_applicant=$caf_details->app_address;
				
				$address_details = $this->address_model->get($app_addressid);
					$b_street_name1=$address_details->house_no;
					$b_street_name2=$address_details->street;
					$b_vill=$address_details->village;
					$b_dist=$address_details->dist;
					$b_block=$address_details->block;
					$b_pincode=$address_details->pin;
					$b_state=$address_details->state;
						
				$address_details1 = $this->address_model->get($address);
					$street_name1=$address_details1->house_no;
					$street_name2=$address_details1->street;
					$vill=$address_details1->village;
					$dist=$address_details1->dist;
					$block=$address_details1->block;
					$pincode=$address_details1->pin;
					$state=$address_details1->state;
			
		}else{
			
			$uainSection="";
			$uain=$token;
			$dept=get_uainDept($uain);
			$form=get_uainForm($uain);
			if($dept==false || $form==false){
				echo "<script>
						alert('Invalid UAIN/UBIN !!');
						window.location.href = '/eodbci/';
					</script>";
					
			}
			
			$dept_name_array = get_deptName($dept);
			$dept_id = $dept_name_array["dept_id"];
			
			//$form_name_row = $this->forms_model->get_formname($dept_id,$form);
			//$form_name = $form_name_row->sub_dept;
			 
			/************************************* TRACK APPLICATION **************************************/
			$table=getTableName($dept,$form);
			$form_details_status = $this->ovs_model->get_form_details($uain,$table,$dept);
			
			
			if($form_details_status){ 
				
				$save_mode=$form_details_status->save_mode;
				$is_viewed=$form_details_status->is_viewed;
				$received_date=$form_details_status->received_date;
				$sub_date=$form_details_status->sub_date;
				$form_id=$form_details_status->form_id;
				$active=$form_details_status->active;
				$swr_id=$form_details_status->user_id;
				
				$unit_master_det = $this->ovs_model->getunitdetails($swr_id);
				
				
				if($unit_master_det == NULL){
					echo "<script>
							alert('Invalid UAIN/UBIN !!');
							window.location.href = '/eodbci/';
						</script>";
				}
				$unit_name=$unit_master_det->unit_name;
				$ubin=$unit_master_det->ubin;
				$b_mobile_no=$unit_master_det->landline_no;
				$mobile_no=$unit_master_det->mobile_no;
				$email=$unit_master_det->email_id;
			
				
				if($active==0){
					
					$process_table_det = $this->ovs_model->getprocessdetails($table,$dept,$form_id);
					if($process_table_det != NULL){ 
						echo "<script>							
							window.location.href = '../getcertificate.php?token=".$uain."';
						</script>";
						exit();
					}
				}
				
				$process_details = $this->ovs_model->getprocessrows($table,$dept,$form_id);
				
				//var_dump($process_details);die();
				//$query="select * from ".$table."_process where form_id='$form_id' ORDER BY p_id ASC";
				//$trackResults=$formFunctions->executeQuery($dept,$query);
				if(($process_details==false || $process_details==NULL)) $msg="This UAIN is invalid. Please enter a valid UAIN !!!";
			}else{
				echo "<script>
						alert('This UAIN is invalid. Please enter a valid UAIN !!!');
						window.location.href = '/eodbci/';
					</script>";
					//redirect(site_url("Home"));
					exit();
			}
			
			
	
		}
			
	}else{
			
		$secondPart=$test[1];
		if(strlen($secondPart)==10){
			
			$ubinSection="";
			$ubin=$token;
			$unit_details = $this->unit_model->getunit("ubin", $ubin);
			
				if($unit_details == NULL){
					header("Location: /eodbci/users/");
					exit;
				}
			
				//var_dump($row);die();
				$unit_name=$unit_details->unit_name;
					$b_mobile_no=$unit_details->mobile_no;
					$b_email=$unit_details->email_id;
					$b_landline_std=$unit_details->landline_std;
					$b_landline_no=$unit_details->landline_no;
					$key_person=$unit_details->app_name;
					$status_applicant=$unit_details->app_designation;
					$mobile_no=$unit_details->app_mobile_no;
					$email=$unit_details->app_email;
					$unit_type=$unit_details->unit_type;
					$date_of_commencement=$unit_details->dateofcommencement;
					
					$address=$unit_details->address;
					$app_addressid=$unit_details->app_addressid;
					
					$business_type=$unit_details->business_type;
					$unit_id=$unit_details->unit_id;
					$caf_id=$unit_details->caf_id;
				
				$caf_details = $this->caf_model->getCaf($caf_id);
					$owner=$caf_details->owner_names;
					$pan=$caf_details->pan;
					$pan_name=$caf_details->pan_name;
					$legal_entity=$caf_details->entity_id;
					$cin_llpin=$caf_details->cin_llpin;
					$legal_entity_name=$caf_details->entp_name;
					$address_applicant=$caf_details->app_address;
				
				$address_details = $this->address_model->get($app_addressid);
					$b_street_name1=$address_details->house_no;
					$b_street_name2=$address_details->street;
					$b_vill=$address_details->village;
					$b_dist=$address_details->dist;
					$b_block=$address_details->block;
					$b_pincode=$address_details->pin;
					$b_state=$address_details->state;
						
				$address_details1 = $this->address_model->get($address);
					$street_name1=$address_details1->house_no;
					$street_name2=$address_details1->street;
					$vill=$address_details1->village;
					$dist=$address_details1->dist;
					$block=$address_details1->block;
					$pincode=$address_details1->pin;
					$state=$address_details1->state;
			
		}else{
			
			$uainSection="";
			$uain=$token;
			$dept=get_uainDept($uain);
			$form=get_uainForm($uain);
			if($dept==false || $form==false){
				echo "<script>
						alert('Invalid UAIN/UBIN !!');
						window.location.href = '/eodbci/';
					</script>";
					
			}
			
			$dept_name_array = get_deptName($dept);
			$dept_id = $dept_name_array["dept_id"];
			
			//$form_name_row = $this->forms_model->get_formname($dept_id,$form);
			//$form_name = $form_name_row->sub_dept;
			 
			/************************************* TRACK APPLICATION **************************************/
			$table=getTableName($dept,$form);
			$form_details_status = $this->ovs_model->get_form_details($uain,$table,$dept);
			
			
			if($form_details_status){ 
				
				$save_mode=$form_details_status->save_mode;
				$is_viewed=$form_details_status->is_viewed;
				$received_date=$form_details_status->received_date;
				$sub_date=$form_details_status->sub_date;
				$form_id=$form_details_status->form_id;
				$active=$form_details_status->active;
				$swr_id=$form_details_status->user_id;
				
				$unit_master_det = $this->ovs_model->getunitdetails($swr_id);
				
				
				if($unit_master_det == NULL){
					echo "<script>
							alert('Invalid UAIN/UBIN !!');
							window.location.href = '/eodbci/';
						</script>";
				}
				$unit_name=$unit_master_det->unit_name;
				$ubin=$unit_master_det->ubin;
				$b_mobile_no=$unit_master_det->landline_no;
				$mobile_no=$unit_master_det->mobile_no;
				$email=$unit_master_det->email_id;
			
				
				if($active==0){
					
					$process_table_det = $this->ovs_model->getprocessdetails($table,$dept,$form_id);
					if($process_table_det != NULL){ 
						echo "<script>							
							window.location.href = '../getcertificate.php?token=".$uain."';
						</script>";
						exit();
					}
				}
				
				$process_details = $this->ovs_model->getprocessrows($table,$dept,$form_id);
				
				//var_dump($process_details);die();
				//$query="select * from ".$table."_process where form_id='$form_id' ORDER BY p_id ASC";
				//$trackResults=$formFunctions->executeQuery($dept,$query);
				if(($process_details==false || $process_details==NULL)) $msg="This UAIN is invalid. Please enter a valid UAIN !!!";
			}else{
				echo "<script>
						alert('This UAIN is invalid. Please enter a valid UAIN !!!');
						window.location.href = '/eodbci/';
					</script>";
					//redirect(site_url("Home"));
					exit();
			}
			
			
	
		}
			
			
			
		}
		
		
		
		


?>

<!DOCTYPE html>
<html>

<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<br/><br/><br/><br/><br/><br/>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-success">
				<div class="box-header heading_pages">
					<h2 class="box-title text-bold">Online Verification System</h2>
				</div>
				<br/>
				<div class="box-body">
					<div class="well well-sm" style="background-color:lightblue">
						<p class="text-bold" style="font-weight:bold"> Name of the Enterprise : <span style="font-size:18px"><?php echo strtoupper($unit_name); ?></span><br/>
						Unique Business Identification Number (UBIN) : <span style="font-size:18px"><?php echo strtoupper($ubin); ?></span><br/>
						Contact No : <span style="font-size:18px"><?php echo "+91 ".$mobile_no . ", +91 " .$b_mobile_no; ?></span><br/>
						Email : <span style="font-size:18px"><?php echo $email; ?></span><br/>
						</p>
					</div>
			<?php if(isset($ubinSection)){ ?>
			<br/>
			<section class="content">
			<div class="box box-primary">
				<div class="row">
					<div class="col-md-6">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="panel panel-primary">
								<div class="panel-heading" role="tab" id="headingOne">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><h4 style="color:#fff" class="text-center panel-title">				
											View Business Details						
									</h4></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="panel panel-primary">
								<div class="panel-heading" role="tab" id="headingTwo">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><h4 style="color:#fff" class="text-center panel-title">View Applications </h4></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12" id="printcontent" style="width: 100%;">
										<table class="table table-responsive table-bordered">
											<tr>
												<td>1. Legal Entity of the Business or Constitution of Business  </td>
												<td><?php echo strtoupper($legal_entity_name); ?></td>														
											</tr>
											<tr>
												<td>2. (a) Sector of Operation  </td>
												<td> </td>														
											</tr>
											<tr>
												<td>&nbsp;&nbsp;&nbsp; (b) Type of Business  </td>
												<td><?php echo strtoupper($business_type); ?></td>														
											</tr>
											<?php 
											if($legal_entity=="H"){
													$printContents=$printContents.'
													<tr>
														<td colspan="3">3. For Hindu Unvided Family</td>
													</tr>
													<tr>
														<td>Name of the karta</td>
														<td>'.strtoupper($owners[0]).'</td>
													</tr>
													<tr>
														<td>Name of the other members</td>
														<td>
														<table>';							
																		for($i=1; $i < count($owners); $i++) {
																	$printContents=$printContents.'
																	<tr>
																		<td>'.strtoupper($owners[$i]).'</td>								
																	</tr>';
																	} 
																$printContents=$printContents.'
														</table>
														</td>
													</tr>
												';
												}else if($legal_entity=="PSU"){
													$printContents=$printContents.'
													<tr>
														<td colspan="3">3. For Public Sector Undertaking</td>
													</tr>
													<tr>
														<td>Name of the Chief Managing Director</td>
														<td>'.strtoupper($owners[0]).'</td>
													</tr>
													<tr>
														<td>Name of the other Directors</td>
														<td>
																<table>';							
																		for($i=1; $i < count($owners); $i++) {
																	$printContents=$printContents.'
																	<tr>
																		<td>'.strtoupper($owners[$i]).'</td>								
																	</tr>';
																	} 
																$printContents=$printContents.'
																</table>
														</td>
													</tr>';
												}else if($legal_entity=="PP" || $legal_entity=="LLP"){
													$printContents=$printContents.'
													<tr>
														<td valign="top" >3. (a) Name of the Partners  : </td>
														<td>'.strtoupper($owner).'</td>
													</tr>';
													if($legal_entity=="LLP"){
													$printContents=$printContents.'	
													<tr>
														<td valign="top"> LLPIN of the Enterprise : </td>
														<td width="50%">'.strtoupper($cin_llpin).'</td>
													</tr>
													';
													}
												}else if($legal_entity=="PTLC" || $legal_entity=="PBLC"){
													$printContents=$printContents.'
												<tr>
													<td valign="top" >3. (a) Name of the Directors  : </td>
													<td>'. strtoupper($owner).'</td>
												</tr>
												<tr>
													<td valign="top"> CIN of the Enterprise : </td>
													<td width="50%">'.strtoupper($cin_llpin).'</td>
												</tr>
												';
												}else{
													$printContents=$printContents.'
													<tr>
													<td valign="top" >3. (a) Name of the '.strtoupper($legal_entity_name).'  : </td>
													<td width="50%">'.strtoupper($owner).'</td>
												</tr>';
												}
												$printContents=$printContents.'
												<tr>
													<td valign="top">&nbsp;&nbsp;&nbsp; (b) Income Tax Permanent Account Number(PAN) of the Enterprise : </td>
													<td width="50%">'.strtoupper($pan).'</td>			
												</tr>
												<tr>
													<td valign="top">&nbsp;&nbsp;&nbsp; (c) Name as on PAN Card of the Enterprise/Proprietor : </td>
													<td width="50%">'.strtoupper($pan_name).'</td>			
												</tr>';
											
												if($legal_entity=="PTLC" || $legal_entity=="PBLC" ){				
													$printContents=$printContents.'<tr>
													<td valign="top"> (c) CIN of the Company : </td>
													<td width="50%">'.strtoupper($cin_llpin).'</td>
													</tr>';
												} 
												$printContents=$printContents.'
		
												<tr>
													<td valign="top" >               4. (a) Type of unit for which CAF is being filled :          </td>
													<td>				'.strtoupper($unit_type).'            </td>
												</tr>
															
												<tr>
													<td valign="top">            (b) Address of the unit for which CAF is being filled :        </td>
													<td >
														<table width="100%" style="border:none">
															<tbody>
																<tr>
																	<td width="30%">Street name 1 :</td>
																	<td>'.strtoupper($b_street_name1).'</td>
																</tr>
																<tr>
																	<td>Street name 2 :</td>
																    <td>'.strtoupper($b_street_name2).'</td>
																</tr>
																<tr>
																	<td>Town/Vill :</td>
																	<td>'.strtoupper($b_vill).'</td>
																</tr>
																<tr>
																	<td>District :</td>
																	<td>'.strtoupper($b_dist).'</td>
																</tr>
																<tr>
																	<td>Block/Word No. :</td>
																	<td>'.strtoupper($b_block).'</td>
																	
																</tr>
																<tr>
																	<td>Pin Code :</td>
																	<td>'.strtoupper($b_pincode).'</td>
																</tr>
															</tbody>
														</table>
												 </td>
												</tr>
												<tr>
													<td valign="top">               5. Location of the Enterprise/Registered Office :             </td>
													<td >
														<table width="100%" style="border:none">
															<tbody>
																<tr>
																	<td width="30%">Street name 1 :</td>
																	<td>'.strtoupper($street_name1).'</td>
																</tr>
																<tr>
																	<td>Street name 2 :</td>
																    <td>'.strtoupper($street_name2).'</td>
																</tr>
																<tr>
																	<td>Town/Vill :</td>
																	<td>'.strtoupper($vill).'</td>
																</tr>
																<tr>
																	<td>District :</td>
																	<td>'.strtoupper($dist).'</td>
																</tr>
																<tr>
																	<td>State :</td>
																	<td>'.strtoupper($block).'</td>
																</tr>
																<tr>
																	<td>Pin Code :</td>
																	<td>'.strtoupper($pincode).'</td>
																	
																</tr>
															</tbody>
														</table>
												 </td>
												</tr>
												
												
												<tr>
													<td valign="top">6.(a) Landline No.           </td>
													<td width="50%">'.strtoupper($b_landline_std).'-'.strtoupper($b_landline_no).'</td>
											
												</tr>
												<tr>
													<td valign="top">&nbsp; (b) Mobile No.           </td>
													<td width="50%">+91 '.strtoupper($b_mobile_no).'</td>
											
												</tr>
												
												<tr>
													<td valign="top">&nbsp; (c) Email-ID.      </td>
													<td width="50%">'.strtoupper($b_email).'</td>
													
												</tr>
												<tr>
													<td valign="top">7.(a) Name of the Applicant/Authorised Person :       </td>
													<td width="50%">'.strtoupper($key_person).'</td>
												</tr>
												<tr>
													<td valign="top">&nbsp;&nbsp; (b) Designation of the Applicant :  </td>
													<td width="50%">'.strtoupper($status_applicant).'</td>
												</tr>
												<tr>
													<td valign="top">&nbsp;&nbsp; (c) Address of the Applicant</td>
													<td width="50%">'.strtoupper($address_applicant).'</td>
													
												</tr>
												';
												echo $printContents;
												?>
										</table>									
									</div>
								</div>				
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
							<table class="table table-responsive table-bordered">
							<thead>
								<tr><th>Sl. No.</th><th>UAIN</th><th>Department</th><th>Form Name</th><th>Operation</th></tr>
							</thead>
							<tbody>
							<?php 
							$application_details = $this->caf_model->getApplication($unit_id);
							$sl=1;
							if($application_details != NULL){
								foreach ($application_details as $app) {
									$uain=$app->uain; 
								    $dept=get_uainDept($uain);
									$dept_name_array = get_deptName($dept);
									$dept_name = $dept_name_array["dept_name"];
									$dept_id = $dept_name_array["dept_id"];
									$form=get_uainForm($uain);
									$form_name_row=$this->forms_model->get_formname($dept_id,$form);
									$form_name = $form_name_row->service_name;
								?>
								
									<tr>
										<td><?php echo $sl; ?></td>
										<td><?php echo $uain; ?></td>
										<td><?php echo $dept_name; ?></td>
										<td><?php echo $form_name; ?></td>
										<td><?php echo "<a href='onlineverification?token=".$uain."' target='_blank' class='btn btn-warning btn-sm'>View Status</a>"; ?></td>
									</tr>
							<?php $sl++;
								}
							}
							if($sl==1){
								echo "<tr><td colspan='6' class='danger text-center'>No records found !!!</tr>";
							}
							?>
							</tbody>
							</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			</section>
			<?php }else if(isset($uainSection)){  ?>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12" id="printcontent" style="width: 100%;">
							<table class="table table-responsive table-bordered">
								<thead>
									<tr>
										<th colspan="5" class="text-center success"><?php if(!empty($msg)) echo $msg; else echo "Form History for UAIN : <span class='text-primary'>".$token."</span>"; ?></th>
									</tr>
								</thead>
								<tbody>									
									<tr>
										<th>ACTION</th>
										<th>OFFICE DETAILS</th>
										<th>REMARKS/REASONS</th>
										<th>Uploaded File</th>
										<th>DATE</th>
									</tr>
									<?php if($save_mode=="C"){  ?>
									<tr class="success">
										<td colspan="5" align="center">
										
										<?php 
										if($received_date!=""){ ?>
										Application is successfully submitted on date  <?php echo date("d-m-Y",strtotime($sub_date));?> .</td>	
									<?php }else{ ?>
										Application is successfully submitted on date  <?php echo date("d-m-Y",strtotime($sub_date));?> but the courier is not yet delivered to the concerned department.
									<?php } 	?>	
									
										</td>		
									</tr>
									<?php }else if($save_mode=="P"){ ?>
									<tr class="warning">
										<td colspan="5">Application form is not yet submitted. Payment is not done. Please go to your dashboard and click on "My Applications" => "Incomplete Applications" and then pay the fees. </td>		
									</tr>
									<?php }else if($save_mode=="F"){ ?>
									<tr class="alert">
										<td colspan="5">Application formis not yet submitted. Please go to your dashboard and click on "My Applications" => "Incomplete Applications" and then enter the courier details and submit the application form. </td>		
									</tr>
									<?php }else if($is_viewed=="R"){ 
									$percent="10";?>
									<tr>
										<td>Application is viewed by FACILITATOR</td>								
										<td></td>								
										<td></td>								
										<td></td>								
										<td><button type="button" class="btn btn-block btn-primary"><?php echo date("D, d-M-Y, g:i a", strtotime($received_date)); ?></button></td>
									</tr>
									<?php }else { } ?>
									<?php //while($rows=$trackResults->fetch_object()){
										
									if($process_details != NULL){
										foreach($process_details as $rows) {
										$i = 0;	
										$process_type=$rows->process_type;
										$remark=$rows->remark;
										$p_user_id=$rows->user_id;
										$file_path=$rows->file_path;
										$p_date=$rows->p_date;
										$doi=$rows->doi;
										$date1=date("D, d-M-Y, g:i a", strtotime($p_date) );
										
										$utypeQuery = $this->ovs_model->getuserrows($p_user_id,$dept);
										//$utypeQuery =$utypeQuery_row;
										//var_dump($utypeQuery);
										$user_name=$utypeQuery->user_name;
										$utype_id=$utypeQuery->utype;
										$udesig=$utypeQuery->udesig;
										$office_id=$utypeQuery->office_id;
										
										$officeQuery = $this->ovs_model->getofficesrows($office_id,$dept);
										
										$office_name=$officeQuery->office_name;
										$office_street1=$officeQuery->street1;
										$office_street2=$officeQuery->street2;
										$office_city=$officeQuery->city;
										$office_district=$officeQuery->district;
										$office_pin=$officeQuery->pin;
										
										$td2=$office_name . "<br/>" .$office_street1. " , " .$office_street2 . " , ". $office_city. " , " .$office_district. " , ". $office_pin;
										$td2=strtoupper($td2);
										
										
										$utypeName_row = $this->ovs_model->get_utypeName($utype_id,$dept);
										$utypeName=$utypeName_row->utype_name;
										if($process_type=="F"){
											$remark="";
											if(isset($rows->forward_to)){
												$forward_to=$rows->forward_to;
												
												$forward_toQuery = $this->ovs_model->get_UserNameDet($forward_to,$dept);
												
												if($forward_toQuery){
													$forward_user_name=$row->user_name;
													$forward_udesig=$row->udesig;
												}else{
													$forward_user_name="";
													$forward_udesig="";
												}
												$td1="Forwarded by ".strtoupper($user_name) . ", ". $udesig ." to ". strtoupper($forward_user_name) . ", " . $forward_udesig;
											}else{
												$td1="Forwarded by ".strtoupper($utypeName);
											}
											
											$btnType="btn-success";
											$percent="50";
										}else if($process_type=="A"){
											$remark="";
											$td1="Approved by ".strtoupper($utypeName);	
											$btnType="btn-success";
											$percent="70";
										}else if($process_type=="I"){
											$remark="";
											$td1="Certificate is Issued by ".strtoupper($utypeName);
											$btnType="btn-success";
											$percent="90";
											$file_path="../getcertificate/".$file_path;
										}else if($process_type=="C"){
											$remark="";
											$td1="Certificate is uploaded by ".strtoupper($utypeName);
											$btnType="btn-success";
											$percent="100";
										}else if($process_type=="R"){
											$td1="Rejected by ".strtoupper($utypeName);
											$btnType="btn-danger";
										}else if($process_type=="V"){
											$td1="Scheduled verification on ".date("d-m-Y",strtotime($doi))." by ".strtoupper($utypeName);									
											$btnType="btn-info";
											$percent="40";
										}else if($process_type=="UVR"){
											if($dept=="fire"){												
												$td1="Recommendations uploaded by ".strtoupper($utypeName);
											}else{
												$td1="Verification Report Uploaded by ".strtoupper($utypeName);
											}
											$btnType="btn-info";
											$percent="40";
										}else if($process_type=="Q"){
											$td1="Query sent by ".strtoupper($utypeName);
											$btnType="btn-warning";
											$percent="40";
											$messages=explode("//",$remark);
											//$query_type=$messages[0];
											$query_id=$remark=$messages[1];
											
											$remark = $this->ovs_model->get_Msg($remark);
											
											//$remark=$dbconnect->executeQuery("select msg from queries where query_id='$remark'")->fetch_object()->msg;
										}else if($process_type=="Y"){
											$td1="Report Recorded by ".strtoupper($utypeName);
											$btnType="btn-success";
											$percent="100";
										}else{}
										?>
											<tr>
												<td><?php echo $td1; ?></td>
												<td><?php echo $td2; ?></td>
												<td><?php echo $remark; ?></td>
												<td>
												<?php 
												if($process_type=="C" || $process_type=="I"){
													echo "<a href='../getcertificate.php?token=".$uain."' target='_blank'>Download Certificate</a>";
												}else if($process_type=="UVR" && $dept=="pcb" && !empty($file_path) && !is_numeric($file_path)){
													echo "<a href='../admin_locker/".$dept."/".$file_path."' target='_blank'>Download</a>";
												}else if($process_type=="UVR" && $dept=="pcb" && !empty($file_path) && is_numeric($file_path)){
													echo "<a target='_blank' href='../admin/departments/".$dept."/inspection_report_print.php?form=".$form."&report_id=".$file_path."' target='_blank'>Download</a>";
												}else{
													if(!empty($file_path)){
														echo "<a href='../admin_locker/".$dept."/".$file_path."' target='_blank'>Download</a>";
													}else{
														echo "No file uploaded";
													}
												}
												?>
												</td>
												<td style="width:20%"><button type="button" class="btn btn-block <?php echo $btnType;?>"><?php echo $date1;?></button></td>
											</tr>
										<?php 
											if($process_type=="Q"){
												
												$query_answered = $this->ovs_model->get_AllMsg($p_date,$query_id);
												
												//$query_answered=$dbconnect->executeQuery("select * from queries where status='1' and (q_date='$p_date' || query_id='$query_id')");
												if($query_answered){
													$query_id=$query_answered->query_id;
													$a_date=$query_answered->a_date;
													$td1="Query replied by the applicant";
													$btnType="btn-success";
													$answer_date=date("D, d-M-Y, g:i a", strtotime($a_date) );
													?>
													<tr>
														<td><?php echo $td1; ?></td>
														<td></td>
														<td></td>
														<td></td>
														<td style="width:20%"><button type="button" class="btn btn-block <?php echo $btnType;?>"><?php echo $answer_date;?></button></td>
													</tr>
													<?php
												}
											}
										$i++;
										} 
										
									} ?>						
								</tbody>
							</table>									
						</div>
					</div>				
				</div>
			<?php }else{ } ?>
			</div>	  
			</div>
		</div>
	</div>
</div>
</body>
</html>
<br/><br/><br/><br/>	
<script>
$(function () {
	$('[data-toggle="popover"]').popover()
});	
</script>
<noscript><meta http-equiv="refresh" content="0; url=<?php echo $server_url;?>noscript.html" /></noscript>
