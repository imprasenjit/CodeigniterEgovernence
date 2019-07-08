<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="15";
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
			
			//TAB 1
			$manager_name=$results['manager_name'];$registration_no=$results['registration_no'];$reg_year=$results['reg_year'];$nature_of_business=$results['nature_of_business'];
			
			
			if(!empty($results["manager_address"])){
				$manager_address=json_decode($results["manager_address"]);
				$manager_address_sn1=$manager_address->sn1;$manager_address_sn2=$manager_address->sn2;$manager_address_vt=$manager_address->vt;$manager_address_d=$manager_address->d;$manager_address_p=$manager_address->p;$manager_address_mno=$manager_address->mno;
			}else{
				$manager_address_sn1="";$manager_address_sn2="";$manager_address_vt="";$manager_address_d="";$manager_address_p="";$manager_address_mno="";
			}
			
			
			if(!empty($results["type_of_worker"])){
					$type_of_worker=json_decode($results["type_of_worker"]);
					$type_of_worker_direct1=$type_of_worker->direct1;$type_of_worker_direct2=$type_of_worker->direct2;$type_of_worker_direct3=$type_of_worker->direct3;
					
					//$type_of_worker_direct4=$type_of_worker->direct4;
					$type_of_worker_direct5=$type_of_worker->direct5;$type_of_worker_direct6=$type_of_worker->direct6;
					
					//$type_of_worker_casual1=$type_of_worker->casual1;$type_of_worker_casual2=$type_of_worker->casual2;$type_of_worker_casual3=$type_of_worker->casual3;
					//$type_of_worker_casual4=$type_of_worker->casual4;
					//$type_of_worker_casual5=$type_of_worker->casual5;$type_of_worker_casual6=$type_of_worker->casual6;
					
					$type_of_worker_through_contractor1=$type_of_worker->through_contractor1;$type_of_worker_through_contractor2=$type_of_worker->through_contractor2;$type_of_worker_through_contractor3=$type_of_worker->through_contractor3;//$type_of_worker_through_contractor4=$type_of_worker->through_contractor4;
					
					$type_of_worker_through_contractor5=$type_of_worker->through_contractor5;$type_of_worker_through_contractor6=$type_of_worker->through_contractor6;
					
				}else{
					$type_of_worker_direct1="";$type_of_worker_direct2="";$type_of_worker_direct3="";$type_of_worker_direct4="";$type_of_worker_direct5="";$type_of_worker_direct6="";
					
					$type_of_worker_casual1="";$type_of_worker_casual2="";$type_of_worker_casual3="";$type_of_worker_casual4="";$type_of_worker_casual5="";$type_of_worker_casual6="";
					
					$type_of_worker_through_contractor1="";$type_of_worker_through_contractor2="";$type_of_worker_through_contractor3="";$type_of_worker_through_contractor4="";$type_of_worker_through_contractor5="";$type_of_worker_through_contractor6="";
					
					$type_of_worker_tot1="";$type_of_worker_tot2="";$type_of_worker_tot3="";$type_of_worker_tot4="";$type_of_worker_tot5="";$type_of_worker_tot6="";
				}
			
			//TAB 2
			$no_of_days=$results['no_of_days'];$no_of_mandays=$results['no_of_mandays'];
			$max_no_employees=$results['max_no_employees'];$average_employees=$results['average_employees'];$service_card_no=$results['service_card_no'];
			
			$total_wages_a=$results['total_wages_a'];$total_wages_b=$results['total_wages_b'];$total_fine_a=$results['total_fine_a'];$total_fine_b=$results['total_fine_b'];$total_deduction_a=$results['total_deduction_a'];$total_deduction_b=$results['total_deduction_b'];
			
			
			$percentage_bonus=$results['percentage_bonus'];$eligible_beneficiaries=$results['eligible_beneficiaries'];$amount_bonus_paid=$results['amount_bonus_paid'];$payment_date=$results['payment_date'];$reasons=$results['reasons'];
			
			//TAB 3
			$nature=$results['nature'];$details_furnished=$results['details_furnished'];$annual_return=$results['annual_return'];$duration_contract=$results['duration_contract'];$avg_no_contract=$results['avg_no_contract'];
			
			$is_canteen=$results['is_canteen'];$is_rest_room=$results['is_rest_room'];$is_drinking_water=$results['is_drinking_water'];$is_creche=$results['is_creche'];$is_first_aid=$results['is_first_aid'];
				
			if(!empty($results["total"])){
				$total=json_decode($results["total"]);
				$total_no=$total->no;$total_man=$total->man;$total_day=$total->day;$total_worker=$total->worker;
			}else{
				$total_no="";$total_man="";$total_day="";$total_worker="";
			}		
			if(!empty($results["details"])){
				$details=json_decode($results["details"]);
				$details_a=$details->a;$details_b=$details->b;$details_c=$details->c;$details_d=$details->d;$details_e=$details->e;
			}else{
				$details_a="";$details_b="";$details_c="";$details_d="";$details_e="";
			}
			if(!empty($results["total_calculation"])){
				$total_calculation=json_decode($results["total_calculation"]);
				$total_calculation_a=$total_calculation->a;$total_calculation_b=$total_calculation->b;$total_calculation_c=$total_calculation->c;$total_calculation_d=$total_calculation->d;
				$total_calculation_e=$total_calculation->e;$total_calculation_f=$total_calculation->f;$total_calculation_tot1=$total_calculation->tot1;$total_calculation_tot2=$total_calculation->tot2;$total_calculation_tot3=$total_calculation->tot3;
			}else{
				$total_calculation_a="";$total_calculation_b="";$total_calculation_c="";$total_calculation_d="";$total_calculation_e="";$total_calculation_f="";$total_calculation_tot1="";$total_calculation_tot2="";$total_calculation_tot3="";
			}
			
			
			
		}else{
			
			//TAB 1
			$manager_name="";$registration_no="";$reg_year=""; $nature_of_business="";  
			
			$manager_address_sn1="";$manager_address_sn2="";$manager_address_vt="";$manager_address_d="";$manager_address_p="";$manager_address_mno="";
			
			$type_of_worker_direct1="";$type_of_worker_direct2="";$type_of_worker_direct3="";$type_of_worker_direct4="";$type_of_worker_direct5="";$type_of_worker_direct6="";
					
			$type_of_worker_casual1="";$type_of_worker_casual2="";$type_of_worker_casual3="";$type_of_worker_casual4="";$type_of_worker_casual5="";$type_of_worker_casual6="";
					
			$type_of_worker_through_contractor1="";$type_of_worker_through_contractor2="";$type_of_worker_through_contractor3="";$type_of_worker_through_contractor4="";$type_of_worker_through_contractor5="";$type_of_worker_through_contractor6="";
					
			$type_of_worker_tot1="";$type_of_worker_tot2="";$type_of_worker_tot3="";$type_of_worker_tot4="";$type_of_worker_tot5="";$type_of_worker_tot6="";
			
			//TAB 2
			$no_of_days="";$no_of_mandays="";$max_no_employees=""; $average_employees="";$service_card_no="";
			
			$total_wages_a="";$total_wages_b="";$total_fine_a="";$total_fine_b="";$total_deduction_a="";$total_deduction_b="";
			
			$percentage_bonus="";$eligible_beneficiaries="";$amount_bonus_paid="";$payment_date="";$reasons="";
			
			//TAB 3
			$nature="";$details_furnished="";$annual_return="";$duration_contract="";$avg_no_contract="";
			$total_no="";$total_man="";$total_day="";$total_worker="";
			$details_a="";$details_b="";$details_c="";$details_d="";$details_e="";
			$total_calculation_a="";$total_calculation_b="";$total_calculation_c="";$total_calculation_d="";$total_calculation_e="";$total_calculation_f="";$total_calculation_tot1="";$total_calculation_tot2="";$total_calculation_tot3="";
			$is_canteen="";$is_rest_room="";$is_drinking_water="";$is_creche="";$is_first_aid="";
			
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		
		//TAB 1
		$manager_name=$results['manager_name'];$registration_no=$results['registration_no'];$reg_year=$results['reg_year'];$nature_of_business=$results['nature_of_business'];
		
			if(!empty($results["manager_address"])){
				$manager_address=json_decode($results["manager_address"]);
				$manager_address_sn1=$manager_address->sn1;$manager_address_sn2=$manager_address->sn2;$manager_address_vt=$manager_address->vt;$manager_address_d=$manager_address->d;$manager_address_p=$manager_address->p;$manager_address_mno=$manager_address->mno;
			}else{
				$manager_address_sn1="";$manager_address_sn2="";$manager_address_vt="";$manager_address_d="";$manager_address_p="";$manager_address_mno="";
			}
		
			if(!empty($results["type_of_worker"])){
					$type_of_worker=json_decode($results["type_of_worker"]);
					$type_of_worker_direct1=$type_of_worker->direct1;$type_of_worker_direct2=$type_of_worker->direct2;$type_of_worker_direct3=$type_of_worker->direct3;
					//$type_of_worker_direct4=$type_of_worker->direct4;
					
					$type_of_worker_direct5=$type_of_worker->direct5;$type_of_worker_direct6=$type_of_worker->direct6;
					
					$type_of_worker_casual1=$type_of_worker->casual1;$type_of_worker_casual2=$type_of_worker->casual2;$type_of_worker_casual3=$type_of_worker->casual3;
					
					//$type_of_worker_casual4=$type_of_worker->casual4;
					$type_of_worker_casual5=$type_of_worker->casual5;$type_of_worker_casual6=$type_of_worker->casual6;
					
					$type_of_worker_through_contractor1=$type_of_worker->through_contractor1;$type_of_worker_through_contractor2=$type_of_worker->through_contractor2;$type_of_worker_through_contractor3=$type_of_worker->through_contractor3;//$type_of_worker_through_contractor4=$type_of_worker->through_contractor4;
					$type_of_worker_through_contractor5=$type_of_worker->through_contractor5;$type_of_worker_through_contractor6=$type_of_worker->through_contractor6;
					
			}else{
					$type_of_worker_direct1="";$type_of_worker_direct2="";$type_of_worker_direct3="";$type_of_worker_direct4="";$type_of_worker_direct5="";$type_of_worker_direct6="";
					
					$type_of_worker_casual1="";$type_of_worker_casual2="";$type_of_worker_casual3="";$type_of_worker_casual4="";$type_of_worker_casual5="";$type_of_worker_casual6="";
					
					$type_of_worker_through_contractor1="";$type_of_worker_through_contractor2="";$type_of_worker_through_contractor3="";$type_of_worker_through_contractor4="";$type_of_worker_through_contractor5="";$type_of_worker_through_contractor6="";
					
					$type_of_worker_tot1="";$type_of_worker_tot2="";$type_of_worker_tot3="";$type_of_worker_tot4="";$type_of_worker_tot5="";$type_of_worker_tot6="";
			}
		
		//TAB 2
		$no_of_days=$results['no_of_days'];$no_of_mandays=$results['no_of_mandays'];
		$max_no_employees=$results['max_no_employees'];$average_employees=$results['average_employees'];$service_card_no=$results['service_card_no'];
		
		$total_wages_a=$results['total_wages_a'];$total_wages_b=$results['total_wages_b'];$total_fine_a=$results['total_fine_a'];$total_fine_b=$results['total_fine_b'];$total_deduction_a=$results['total_deduction_a'];$total_deduction_b=$results['total_deduction_b'];
		
		$percentage_bonus=$results['percentage_bonus'];$eligible_beneficiaries=$results['eligible_beneficiaries'];$amount_bonus_paid=$results['amount_bonus_paid'];$payment_date=$results['payment_date'];$reasons=$results['reasons'];
		
		//TAB 3
		$nature=$results['nature'];$details_furnished=$results['details_furnished'];$annual_return=$results['annual_return'];$duration_contract=$results['duration_contract'];$avg_no_contract=$results['avg_no_contract'];
			
		$is_canteen=$results['is_canteen'];$is_rest_room=$results['is_rest_room'];$is_drinking_water=$results['is_drinking_water'];$is_creche=$results['is_creche'];$is_first_aid=$results['is_first_aid'];
				
			if(!empty($results["total"])){
				$total=json_decode($results["total"]);
				$total_no=$total->no;$total_man=$total->man;$total_day=$total->day;$total_worker=$total->worker;
			}else{
				$total_no="";$total_man="";$total_day="";$total_worker="";
			}		
			if(!empty($results["details"])){
				$details=json_decode($results["details"]);
				$details_a=$details->a;$details_b=$details->b;$details_c=$details->c;$details_d=$details->d;$details_e=$details->e;
			}else{
				$details_a="";$details_b="";$details_c="";$details_d="";$details_e="";
			}
			if(!empty($results["total_calculation"])){
				$total_calculation=json_decode($results["total_calculation"]);
				$total_calculation_a=$total_calculation->a;$total_calculation_b=$total_calculation->b;$total_calculation_c=$total_calculation->c;$total_calculation_d=$total_calculation->d;
				$total_calculation_e=$total_calculation->e;$total_calculation_f=$total_calculation->f;
			}else{
				$total_calculation_a="";$total_calculation_b="";$total_calculation_c="";$total_calculation_d="";$total_calculation_e="";$total_calculation_f="";$total_calculation_tot1="";$total_calculation_tot2="";$total_calculation_tot3="";
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
								  <li class="<?php echo $tabbtn1; ?>"><a requiredhref="#table1">Part 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a requiredhref="#table2">Part 2</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a requiredhref="#table3">Part 3</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								 <form name="my_form15" id="my_form15" class="submit1" method="post" ction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									
									<tr>
										<td colspan="4">1. Name and address of establishment</td>
									</tr>
									<tr>
									    <td width="25%">Full Name</td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
									    <td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>"> </td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"></td>
										<td>Mobile Number</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">2. Name and Residential address of the employer / occupier / contractor</td>
									</tr>
									<tr>
									    <td width="25%">Name </td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
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
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">3. Name and Residential address of the Manager/Person/ responsible for supervision or control of the establishment</td>
									</tr>
									<tr>
									    <td >Full Name</td>
									    <td><input type="text" class="form-control text-uppercase" name="manager_name" validate="letters" value="<?php echo $manager_name; ?>"></td>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[sn1]" value="<?php echo $manager_address_sn1; ?>"></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[sn2]" value="<?php echo $manager_address_sn2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[vt]" value="<?php echo $manager_address_vt; ?>"></td>
									</tr>
									<tr>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[d]" value="<?php echo $manager_address_d; ?>"></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[p]" validate="pincode" maxlength="6" value="<?php echo $manager_address_p; ?>"></td>
									</tr>
									<tr>
										<td>Contact Number</td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[mno]" value="<?php echo $manager_address_mno; ?>" maxlength="10" validate="mobileNumber"></td>
									</tr>
									<tr>
										<td colspan="4">4. Registration no./license no. and year of commencement of business.</td>
									</tr>
									<tr>
										<td>Registration no./license no.</td>
										<td><input type="text" required class="form-control text-uppercase" name="registration_no" value="<?php echo $registration_no; ?>"></td>
										<td>Year</td>
										<td><input type="text" required class="form-control text-uppercase" name="reg_year" value="<?php echo $reg_year; ?>" maxlength="4" validate="onlyNumbers"></td>
									</tr>
									<tr>
									    <td >5. Nature of business activity carried on in establishment</td>
									    <td><input type="text" class="form-control text-uppercase" name="nature_of_business" value="<?php echo $nature_of_business; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">6. Details of employees employed by the establishment.</td>
									</tr>
									
									<tr>
										<td colspan="4">
										<table class="table table-bordered table-responsive">
											<thead>
												<tr>
														<th>Sl no.</th>
														<th>Type of worker</th>
														<th>Unskilled</th>
														<th>Semiskilled</th>
														<th>Skilled</th>
														<th>Total</th>
														<th>Male</th>
														<th>Female</th>
													
												</tr>
											</thead>
											<tr>
													<td>1.</td>
													<td>Direct</td>
													<td><input type="text" class="form-control text-uppercase calculatea category_total1" name="type_of_worker[direct1]" validate="onlyNumbers" value="<?php echo $type_of_worker_direct1; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculateb category_total1" name="type_of_worker[direct2]" validate="onlyNumbers"value="<?php echo $type_of_worker_direct2; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculatec category_total1" name="type_of_worker[direct3]" validate="onlyNumbers"value="<?php echo $type_of_worker_direct3; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculated" name="type_of_worker[direct4]" id="category_total1" disabled validate="onlyNumbers" value="<?php echo $type_of_worker_direct4 = ((int)$type_of_worker_direct1 + (int)$type_of_worker_direct2 + (int)$type_of_worker_direct3); ?>"></td>
													
													<td><input type="text" class="form-control text-uppercase calculatee" name="type_of_worker[direct5]" validate="onlyNumbers" value="<?php echo $type_of_worker_direct5; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculatef" name="type_of_worker[direct6]" validate="onlyNumbers"value="<?php echo $type_of_worker_direct6; ?>"></td>
											</tr>
											<tr>
													<td>2.</td>
													<td>Casual/Temporary</td>
													<td><input type="text" class="form-control text-uppercase calculatea category_total2" name="type_of_worker[casual1]" validate="onlyNumbers" value="<?php echo $type_of_worker_casual1; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculateb category_total2" name="type_of_worker[casual2]" validate="onlyNumbers"value="<?php echo $type_of_worker_casual2; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculatec category_total2" name="type_of_worker[casual3]" validate="onlyNumbers"value="<?php echo $type_of_worker_casual3; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculated" name="type_of_worker[casual4]" id="category_total2"  disabled validate="onlyNumbers" value="<?php echo $type_of_worker_casual4 = ((int)$type_of_worker_casual1 + (int)$type_of_worker_casual2 + (int)$type_of_worker_casual3); ?>"></td>
													
													<td><input type="text" class="form-control text-uppercase calculatee" name="type_of_worker[casual5]" validate="onlyNumbers" value="<?php echo $type_of_worker_casual5; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculatef" name="type_of_worker[casual6]" validate="onlyNumbers"value="<?php echo $type_of_worker_casual6; ?>"></td>
											</tr>
												
											<tr>
													<td>3.</td>
													<td>Through Contractor</td>
													<td><input type="text" class="form-control text-uppercase calculatea category_total3" name="type_of_worker[through_contractor1]" validate="onlyNumbers" value="<?php echo $type_of_worker_through_contractor1; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculateb category_total3" name="type_of_worker[through_contractor2]" validate="onlyNumbers"value="<?php echo $type_of_worker_through_contractor2; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculatec category_total3" name="type_of_worker[through_contractor3]" validate="onlyNumbers"value="<?php echo $type_of_worker_through_contractor3; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculated" name="type_of_worker[through_contractor4]" id="category_total3" disabled validate="onlyNumbers" value="<?php echo $type_of_worker_through_contractor4 = ((int)$type_of_worker_through_contractor1 + (int)$type_of_worker_through_contractor2 + (int)$type_of_worker_through_contractor3); ?>"></td>
													
													<td><input type="text" class="form-control text-uppercase calculatee" name="type_of_worker[through_contractor5]" validate="onlyNumbers" value="<?php echo $type_of_worker_through_contractor5; ?>"></td>
													<td><input type="text" class="form-control text-uppercase calculatef" name="type_of_worker[through_contractor6]" validate="onlyNumbers"value="<?php echo $type_of_worker_through_contractor6; ?>"></td>
													
											</tr>
												
											<tr>
													<td>4.</td>
													<td>Total</td>
													<td><input  type="text" class="form-control text-uppercase" id="total_calculatea" name="type_of_worker[tot1]" disabled="disabled" value="<?php echo $type_of_worker_tot1 = ((int)  $type_of_worker_direct1 + (int)$type_of_worker_casual1 + (int)$type_of_worker_through_contractor1); ?>"></td>
													<td><input  type="text" class="form-control text-uppercase" id="total_calculateb" name="type_of_worker[tot2]" disabled="disabled" value="<?php echo $type_of_worker_tot2 = ((int)$type_of_worker_direct2 + (int)$type_of_worker_casual2 + (int)$type_of_worker_through_contractor2); ?>"></td>
													<td><input  type="text" class="form-control text-uppercase" id="total_calculatec" name="type_of_worker[tot3]" disabled="disabled" value="<?php echo $type_of_worker_tot3 = ((int)$type_of_worker_direct3 + (int)$type_of_worker_casual3 + (int)$type_of_worker_through_contractor3); ?>"></td>
													<td><input  type="text" class="form-control text-uppercase" id="total_calculated" name="type_of_worker[tot4]" disabled="disabled" value="<?php echo $type_of_worker_tot4 = ((int)$type_of_worker_direct4 + (int)$type_of_worker_casual4 + (int)$type_of_worker_through_contractor4); ?>"></td>
													<td><input  type="text" class="form-control text-uppercase" id="total_calculatee" name="type_of_worker[tot5]" disabled="disabled" value="<?php echo $type_of_worker_tot5 = ((int)$type_of_worker_direct5 + (int)$type_of_worker_casual5 + (int)$type_of_worker_through_contractor5); ?>"></td>
													<td><input  type="text" class="form-control text-uppercase" id="total_calculatef" name="type_of_worker[tot6]" disabled="disabled" value="<?php echo $type_of_worker_tot6 = ((int)$type_of_worker_direct6 + (int)$type_of_worker_casual6 + (int)$type_of_worker_through_contractor6); ?>"></td>
													
											</tr>
										</table>
										</td>
									</tr>
									
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
										</td>
									</tr>
								</table>
							</form>
							</div>
							<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="my_form15" id="my_form15" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table  class="table table-responsive">
									
									<tr>
										<td align="center" colspan="4"><b>PART A</b></td>
									</tr>
									<tr>
										<td colspan="4">My establishment covered under the Payment of Wages Act, 1936. Minimum Wages Act, 1948, Assam Shops &amp; Establishment Act, 1971 and the States Rules made thereunder and all workers/office staff are paid wages/overtime wages as admissible and prescribed by the Government of Assam. I have maintain all the registers and records as required under the law.<br/><br/></td>
									</tr>
									
									<tr>
										<td width="25%">1. No. of days the Shop / Establishment worked in the year</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="no_of_days"  value="<?php echo $no_of_days; ?>" validate="onlyNumbers" ></td>
										<td width="25%">2. No. of mandays work in the year</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="no_of_mandays"  value="<?php echo $no_of_mandays; ?>" validate="onlyNumbers" ></td>
									</tr>
									<tr>
										<td>3. Maximum no. of employees employed in any day in the year</td>
										<td><input type="text" class="form-control text-uppercase" name="max_no_employees"  value="<?php echo $max_no_employees; ?>" validate="onlyNumbers" ></td>
										<td>4. No. of Average employees employed in the year</td>
										<td><input type="text" class="form-control text-uppercase" name="average_employees"  value="<?php echo $average_employees; ?>" validate="onlyNumbers" ></td>
									</tr>
									<tr>
										<td>5. No. of service cards issued for applicable</td>
										<td><input type="text" class="form-control text-uppercase" name="service_card_no"  value="<?php echo $service_card_no; ?>" validate="onlyNumbers" ></td>
										
									</tr>
									<tr>
										<td colspan="4">
											<table class="table table-responsive table-bordered">
												<tr>
													<td></td>
													<td align="center">Male</td>
													<td align="center">Female</td>
													
												</tr>
												<tr>
													<td>1. Total wages paid category wise</td>
													<td><input type="text" class="form-control text-uppercase" name="total_wages_a"  value="<?php echo $total_wages_a; ?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
													<td><input type="text" class="form-control text-uppercase" name="total_wages_b" value="<?php echo $total_wages_b; ?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
												</tr>
												<tr>
													<td>2. Total fine imposed (if any)</td>
													<td><input type="text" class="form-control text-uppercase" name="total_fine_a"  value="<?php echo $total_fine_a; ?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
													<td><input type="text" class="form-control text-uppercase" name="total_fine_b"  value="<?php echo $total_fine_b; ?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
												</tr>
												<tr>
													<td>3. Total deduction (if any)</td>
													<td><input type="text" class="form-control text-uppercase" name="total_deduction_a"  value="<?php echo $total_deduction_a; ?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
													<td><input type="text" class="form-control text-uppercase" name="total_deduction_b"  value="<?php echo $total_deduction_b; ?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
												</tr>
										</table></td>
									</tr>
									<tr>
										<td colspan="4" align="center"><strong>Part B</strong></td>
									</tr>
									<tr>
										<td colspan="4"><b>The Part A and Part B information to be furnished if the maximum number of employees employed on any day during the year under report exceed 5 (Five)</b></td>
									</tr>
									<tr>
										<td colspan="4">My Establishment is covered under the Payment of Bonus Act, 1965 and workers are paid Bonus. I have maintained records and registers as per the Act.</td>
									</tr>
								    <tr>
										<td>Percentage of Bonus paid :</td>
										<td><input type="text" class="form-control text-uppercase" name="percentage_bonus" value="<?php echo $percentage_bonus; ?>"></td>
										<td>No. of eligible beneficiaries :</td>
										<td><input type="text" class="form-control text-uppercase" name="eligible_beneficiaries" value="<?php echo $eligible_beneficiaries; ?>"></td>
									</tr>
									<tr>
										<td>Total amount of Bonus paid :</td>
										<td><input type="text" class="form-control" validate="onlyNumbers" name="amount_bonus_paid" value="<?php echo $amount_bonus_paid; ?>"></td>
										<td>Date of payment:</td>
										<td><input type="text" class="dob form-control" name="payment_date" value="<?php echo $payment_date; ?>"></td>
									</tr>
									<tr>
										<td>If Bonus no paid (Reasons thereof) :</td>
										<td><textarea class="form-control text-uppercase" name="reasons" ><?php echo $reasons; ?></textarea></td>
										<td></td>
										<td></td>
									</tr>	
									
									<tr>
										<td class="text-center" colspan="4">
											<a href="labour_form<?php echo $form;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
						                   <button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>
									</tr>
								</table>
							</form>
							</div>
							<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="my_form15" id="my_form15" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table  class="table table-responsive">
									 <tr>
										<td colspan="4" align="center"><strong>Part C</strong></td>
									</tr>
								   <tr>
									  <td colspan="4"><b>Part A, B and C are to be furnished if the Establishment has employed more than 9 (nine) no. of contract labour on any day during the year under report. (Details to be provided by the Principal Employer)</b></td>
									</tr>
									<tr>
									  <td colspan="4">My Establishment is covered under the Contract Labour (Regulation &amp; Abolition) Act, 1970 and the State Rules made thereunder and the workers are paid wages and overtime wages as prescribed by Govt. of Assam. I have maintained the records and registers as per the Act.</td>
									</tr>
									<tr>
										<td colspan="4">1. Name and postal address of the contractor</td>
									</tr>
									<tr>
									    <td width="25%">Name </td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
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
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>2. Nature of work/operation of the contractor</td>
										<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>
										<td>3. Total No. of days during the year on whivh contract labour was employed</td>
										<td><input type="text" class="form-control" validate="onlyNumbers" name="total[no]" value="<?php echo $total_no; ?>"></td>
									</tr>
									<tr>
										<td>4. Total No. of mandays worked during the year by the contract labour</td>
										<td><input type="text" class="form-control" validate="onlyNumbers" name="total[man]" value="<?php echo $total_man; ?>"></td>
										<td>5. Total No. of days during the year in which direct labour was employed</td>
										<td><input type="text" class="form-control" validate="onlyNumbers" name="total[day]" value="<?php echo $total_day; ?>"></td>
									</tr>
									<tr>
										<td>6. Total No. mandays worked by the direct labour.</td>
										<td><input type="text" class="form-control"  validate="onlyNumbers" name="total[worker]"  value="<?php echo $total_worker; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">7. Change if any in the management of establishment, its location or any particulars furnished to the Registering Officer in the application for the registration (Details may be furnished with date of changes)</td>
										<td><textarea class="form-control text-uppercase" name="details_furnished"  ><?php echo $details_furnished; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="4"><b>(Note :- In case the no. of contractors are more than 1 (One), the details of each contractors may be furnished in same columns in separate sheets)</b></td>
									</tr>
									<tr>
									    <td colspan="3">8. Annual Return to be submitted by the Contractor(s) :</td>
									    <td><input type="text" class="form-control text-uppercase" name="annual_return"  value="<?php echo $annual_return; ?>"></td>
									    <td></td>
										<td></td>
									</tr>
									<tr>
									   <td><b>Employing more than 9 (Nine) workers.</b></td>
										<td></td>
									</tr>
									<tr>
									    <td>9. Duration of contract (Number of days work during the year) :</td>
									    <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="duration_contract"  value="<?php echo $duration_contract; ?>"></td>
									    <td>10. Average No. of Contract labour worked in any day during the year :</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="avg_no_contract" value="<?php echo $avg_no_contract; ?>"></td>
									</tr>
									<tr>										
										<td>11. Details of </td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
												<td colspan="4">
												 <table class="table table-responsive table-bordered">
													<tr>
													  <td>a. Working hours</td>
													  <td>b. Overtime work</td>
													  <td>c. Weekly holiday</td>
													  <td>d. Spread over</td>
													  <td>e. Weekly holiday paid or not</td>
													</tr>
													<tr>
													  <td><input type="text" class="form-control text-uppercase" name="details[a]" value="<?php echo $details_a; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="details[b]" value="<?php echo $details_b; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="details[c]" value="<?php echo $details_c; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="details[d]" value="<?php echo $details_d; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="details[e]" value="<?php echo $details_e; ?>" /></td>
													</tr>
												  </table>
												</td>
									</tr>
									<tr>
											<td colspan="4">
												 <table class="table table-responsive table-bordered">
													<tr>
	                                             <td></td>
													  <td align="center">Male</td>
													  <td align="center">Female</td>
													  <td align="center">Total</td>
													</tr>
													<tr>
													  <td>12. No. of mandays work during the year</td>
													  <td><input type="text" class="form-control text-uppercase fixedCapitala" name="total_calculation[a]" validate="onlyNumbers" value="<?php echo $total_calculation_a; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase fixedCapitala" name="total_calculation[b]" validate="onlyNumbers"  value="<?php echo $total_calculation_b; ?>" /></td>
													   <td><input  type="text" class="form-control text-uppercase" id="amount_fixedCapitala" name="total_calculation[tot1]" disabled="disabled" value="<?php echo $total_calculation_tot1 = ((int)$total_calculation_a + (int)$total_calculation_b); ?>"></td>
													</tr>
													<tr>
													  <td>13. Amount of wages paid</td>
													 <td><input type="text" class="form-control text-uppercase fixedCapitalb" name="total_calculation[c]" validate="onlyNumbers" value="<?php echo $total_calculation_c; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase fixedCapitalb" name="total_calculation[d]" validate="onlyNumbers" value="<?php echo $total_calculation_d; ?>" /></td>
													  <td><input  type="text" class="form-control text-uppercase" id="amount_fixedCapitalb" name="total_calculation[tot2]" disabled="disabled" value="<?php echo $total_calculation_tot2 = ((int)$total_calculation_c + (int)$total_calculation_d); ?>"></td>
													</tr>
													<tr>
													  <td>14. Amount of deduction from wages</td>
													  <td><input type="text" class="form-control text-uppercase  fixedCapitalc" name="total_calculation[e]" validate="onlyNumbers" value="<?php echo $total_calculation_e; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase fixedCapitalc" name="total_calculation[f]" validate="onlyNumbers" value="<?php echo $total_calculation_f; ?>" /></td>
													  <td><input  type="text" class="form-control text-uppercase" id="amount_fixedCapitalc" name="total_calculation[tot3]" disabled="disabled" value="<?php echo $total_calculation_tot3 = ((int)$total_calculation_e + (int)$total_calculation_f); ?>"></td>
													</tr>
												  </table>
											</td>
									 </tr>
									 <tr>										
										<td colspan="4">15. The following has been provided :</td>
										<td></td>
									</tr>
									<tr>
									    <td>Canteen</td>
									    <td>
											 <label class="radio-inline"><input type="radio" name="is_canteen"  value="Y" <?php if($is_canteen=='Y') echo 'checked'; ?> > Yes </label>
											<label class="radio-inline"><input type="radio" name="is_canteen" value="N" <?php if($is_canteen=='N') echo 'checked'; ?> checked />&nbsp;No </label></td>
										</td>
									    <td>Rest Room</td>
									    <td>
											 <label class="radio-inline"><input type="radio" name="is_rest_room"  value="Y" <?php if($is_rest_room=='Y') echo 'checked'; ?> > Yes </label>
											<label class="radio-inline"><input type="radio" name="is_rest_room" value="N" <?php if($is_rest_room=='N') echo 'checked'; ?> checked />&nbsp;No </label></td>
										
									</tr>
									<tr>
									    <td>Drinking water</td>
									    <td>
											 <label class="radio-inline"><input type="radio" name="is_drinking_water"  value="Y" <?php if($is_drinking_water=='Y') echo 'checked'; ?> > Yes </label>
											<label class="radio-inline"><input type="radio" name="is_drinking_water" value="N" <?php if($is_drinking_water=='N') echo 'checked'; ?> checked />&nbsp;No </label></td>
									    <td>Creche</td>
									    <td>
											 <label class="radio-inline"><input type="radio" name="is_creche"  value="Y" <?php if($is_creche=='Y') echo 'checked'; ?> > Yes </label>
											<label class="radio-inline"><input type="radio" name="is_creche" value="N" <?php if($is_creche=='N') echo 'checked'; ?> checked />&nbsp;No </label></td>
									</tr>
									<tr>
									    <td>First Aid</td>
									    <td>
											 <label class="radio-inline"><input type="radio" name="is_first_aid"  value="Y" <?php if($is_first_aid=='Y') echo 'checked'; ?> > Yes </label>
											<label class="radio-inline"><input type="radio" name="is_first_aid" value="N" <?php if($is_first_aid=='N') echo 'checked'; ?> checked />&nbsp;No </label></td>
										</td>
									</tr>
									<tr>										
										<td colspan="4"><b>Explanatory Note :-</b></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">1. The average no. of workers employed daily should be calculated by dividing the figures of mandays worked by no. of days work in the year. For seasonal establishment the average no. of workers employed during the working season and off season should be given separately.</td>
									</tr>
									<tr>
									    <td colspan="4">2. Mandays work should be the aggregate no. of attendance of the workers covered under the Act, in all working days in reckoning attendance by the temporary as well as permanent workers employed should be counted and all employees should be included whether they are employed direct or under contractors.</td>
									</tr>
									
									
									<tr>
										<td colspan="2" class="form-inline text-uppercase">Date : <label><?php echo date('d-m-Y',strtotime($today)); ?></label><br/>
										Place : <label><?php echo $dist; ?></label> <br/><br/></td>
										<td colspan="2" class="form-inline text-uppercase" align="right">
											<label><?php echo $key_person; ?></label><br/>Signature of the Applicant (Contractor)<br/>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="labour_form<?php echo $form;?>.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>c" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save and Next</button>
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
	$('.calculatea').on('change', function(){
		var sum = 0;
		
		$('.calculatea').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#total_calculatea').val(sum);
		});
	});
	$('.calculateb').on('change', function(){
		var sum = 0;
		
		$('.calculateb').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#total_calculateb').val(sum);
		});
	});
	$('.calculatec').on('change', function(){
		var sum = 0;
		
		$('.calculatec').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#total_calculatec').val(sum);
		});
	});
	$('.calculated').on('change', function(){
		var sum = 0;
		
		$('.calculated').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#total_calculated').val(sum);
		});
	});
	$('.calculatee').on('change', function(){
		var sum = 0;
		
		$('.calculatee').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#total_calculatee').val(sum);
		});
	});
	$('.calculatef').on('change', function(){
		var sum = 0;
		
		$('.calculatef').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#total_calculatef').val(sum);
		});
	});
	
	
	
	$('.category_total1').on('change', function(){
		var sum = 0;
		
		$('.category_total1').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#category_total1').val(sum);
		});
		var amount_total5_sum = 0;
		$('.calculated').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				amount_total5_sum = amount_total5_sum + parseInt($(this).val());
			}
			$('#total_calculated').val(amount_total5_sum);
		});
	});
	$('.category_total2').on('change', function(){
		var sum = 0;
		
		$('.category_total2').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#category_total2').val(sum);
		});
		var amount_total5_sum = 0;
		$('.calculated').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				amount_total5_sum = amount_total5_sum + parseInt($(this).val());
			}
			$('#total_calculated').val(amount_total5_sum);
		});
	});
	$('.category_total3').on('change', function(){
		var sum = 0;
		
		$('.category_total3').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#category_total3').val(sum);
		});
		var amount_total5_sum = 0;
		$('.calculated').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				amount_total5_sum = amount_total5_sum + parseInt($(this).val());
			}
			$('#total_calculated').val(amount_total5_sum);
		});
	});
	
	
	
	$('.fixedCapitala').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitala').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitala').val(sum);
		});
	});
	$('.fixedCapitalb').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitalb').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitalb').val(sum);
		});
	});
	$('.fixedCapitalc').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitalc').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitalc').val(sum);
		});
	});
	
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>