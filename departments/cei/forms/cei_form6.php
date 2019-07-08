<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="6";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ;// For reccuring form fill ups
	
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$lift_details=$results['lift_details'];$num_of_lift=$results['num_of_lift'];$rated_speed=$results['rated_speed'];$travel_dist=$results['travel_dist'];$control_method =$results['control_method'];$machine_details =$results['machine_details'];$counter_details =$results['counter_details'];$car_frame =$results['car_frame'];$weight_clearence =$results['weight_clearence'];$locking_arrange =$results['locking_arrange'];$emergency_details =$results['emergency_details'];$lifting_beam =$results['lifting_beam'];$speed_governor =$results['speed_governor'];$retiring_details =$results['retiring_details'];$safety_details =$results['safety_details'];$sheave_details =$results['sheave_details'];$rope_details =$results['rope_details'];$head_room_dist =$results['head_room_dist'];$travel_distance =$results['travel_distance'];$car_clearence =$results['car_clearence'];$alarm_system =$results['alarm_system'];$detail_of_earthing =$results['detail_of_earthing'];$emergency_signal =$results['emergency_signal'];$detail_of_dimen =$results['detail_of_dimen'];$power_details =$results['power_details'];$construction_details =$results['construction_details'];$commencement_dt =$results['commencement_dt'];$completion_dt =$results['completion_dt'];	
			
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["premise_addr"]))
			{
				$premise_addr=json_decode($results["premise_addr"]);
				$premise_addr_st1=$premise_addr->st1;$premise_addr_st2=$premise_addr->st2;$premise_addr_vt=$premise_addr->vt;$premise_addr_dist=$premise_addr->dist;$premise_addr_pin=$premise_addr->pin;$premise_addr_mob=$premise_addr->mob;$premise_addr_email=$premise_addr->email;
			}else{
				$premise_addr_st1="";$premise_addr_st2="";$premise_addr_vt="";$premise_addr_dist="";$premise_addr_pin="";$premise_addr_mob="";$premise_addr_email="";
			}	
			if(!empty($results["install_person"]))
			{
				$install_person=json_decode($results["install_person"]);
				$install_person_name=$install_person->name;$install_person_st1=$install_person->st1;$install_person_st2=$install_person->st2;$install_person_vt=$install_person->vt;$install_person_dist=$install_person->dist;$install_person_pin=$install_person->pin;$install_person_mob=$install_person->mob;$install_person_email=$install_person->email;
			}else{
				$install_person_name="";$install_person_st1="";$install_person_st2="";$install_person_vt="";$install_person_dist="";$install_person_pin="";$install_person_mob="";$install_person_email="";
			}	
			if(!empty($results["makers_addr"]))
			{
				$makers_addr=json_decode($results["makers_addr"]);
				$makers_addr_name=$makers_addr->name;$makers_addr_st1=$makers_addr->st1;$makers_addr_st2=$makers_addr->st2;$makers_addr_vt=$makers_addr->vt;$makers_addr_dist=$makers_addr->dist;$makers_addr_pin=$makers_addr->pin;$makers_addr_mob=$makers_addr->mob;$makers_addr_email=$makers_addr->email;
			}else{
				$makers_addr_name="";$makers_addr_st1="";$makers_addr_st2="";$makers_addr_vt="";$makers_addr_dist="";$makers_addr_pin="";$makers_addr_mob="";$makers_addr_email="";
			}	
			if(!empty($results["related_load"]))
			{
				$related_load=json_decode($results["related_load"]);
				$related_load_no=$related_load->no;$related_load_kg=$related_load->kg;
			}
			else
			{
				$related_load_no="";$related_load_kg="";
			}	
			
		}else{
			$form_id="";
			$lift_details="";$num_of_lift="";$rated_speed="";$travel_dist="";$control_method="";$machine_details="";$counter_details="";$car_frame="";$weight_clearence="";$locking_arrange="";$emergency_details="";$lifting_beam="";$speed_governor="";$retiring_details="";$safety_details="";$sheave_details="";$rope_details="";$head_room_dist="";$travel_distance="";$car_clearence="";$alarm_system="";$detail_of_earthing="";$emergency_signal="";$detail_of_dimen="";$power_details="";$construction_details="";$commencement_dt="";$completion_dt="";
			$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			$premise_addr_st1="";$premise_addr_st2="";$premise_addr_vt="";$premise_addr_dist="";$premise_addr_pin="";$premise_addr_mob="";$premise_addr_email="";
			$install_person_name="";$install_person_st1="";$install_person_st2="";$install_person_vt="";$install_person_dist="";$install_person_pin="";$install_person_mob="";$install_person_email="";
			$makers_addr_name="";$makers_addr_st1="";$makers_addr_st2="";$makers_addr_vt="";$makers_addr_dist="";$makers_addr_pin="";$makers_addr_mob="";$makers_addr_email="";
			$related_load_no="";$related_load_kg="";
			
		}
		
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$lift_details=$results['lift_details'];$num_of_lift=$results['num_of_lift'];$rated_speed=$results['rated_speed'];$travel_dist=$results['travel_dist'];$control_method =$results['control_method'];$machine_details =$results['machine_details'];$counter_details =$results['counter_details'];$car_frame =$results['car_frame'];$weight_clearence =$results['weight_clearence'];$locking_arrange =$results['locking_arrange'];$emergency_details =$results['emergency_details'];$lifting_beam =$results['lifting_beam'];$speed_governor =$results['speed_governor'];$retiring_details =$results['retiring_details'];$safety_details =$results['safety_details'];$sheave_details =$results['sheave_details'];$rope_details =$results['rope_details'];$head_room_dist =$results['head_room_dist'];$travel_distance =$results['travel_distance'];$car_clearence =$results['car_clearence'];$alarm_system =$results['alarm_system'];$detail_of_earthing =$results['detail_of_earthing'];$emergency_signal =$results['emergency_signal'];$detail_of_dimen =$results['detail_of_dimen'];$power_details =$results['power_details'];$construction_details =$results['construction_details'];$commencement_dt =$results['commencement_dt'];$completion_dt =$results['completion_dt'];	
			
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["premise_addr"]))
			{
				$premise_addr=json_decode($results["premise_addr"]);
				$premise_addr_st1=$premise_addr->st1;$premise_addr_st2=$premise_addr->st2;$premise_addr_vt=$premise_addr->vt;$premise_addr_dist=$premise_addr->dist;$premise_addr_pin=$premise_addr->pin;$premise_addr_mob=$premise_addr->mob;$premise_addr_email=$premise_addr->email;
			}else{
				$premise_addr_st1="";$premise_addr_st2="";$premise_addr_vt="";$premise_addr_dist="";$premise_addr_pin="";$premise_addr_mob="";$premise_addr_email="";
			}	
			if(!empty($results["install_person"]))
			{
				$install_person=json_decode($results["install_person"]);
				$install_person_name=$install_person->name;$install_person_st1=$install_person->st1;$install_person_st2=$install_person->st2;$install_person_vt=$install_person->vt;$install_person_dist=$install_person->dist;$install_person_pin=$install_person->pin;$install_person_mob=$install_person->mob;$install_person_email=$install_person->email;
			}else{
				$install_person_name="";$install_person_st1="";$install_person_st2="";$install_person_vt="";$install_person_dist="";$install_person_pin="";$install_person_mob="";$install_person_email="";
			}	
			if(!empty($results["makers_addr"]))
			{
				$makers_addr=json_decode($results["makers_addr"]);
				$makers_addr_name=$makers_addr->name;$makers_addr_st1=$makers_addr->st1;$makers_addr_st2=$makers_addr->st2;$makers_addr_vt=$makers_addr->vt;$makers_addr_dist=$makers_addr->dist;$makers_addr_pin=$makers_addr->pin;$makers_addr_mob=$makers_addr->mob;$makers_addr_email=$makers_addr->email;
			}else{
				$makers_addr_name="";$makers_addr_st1="";$makers_addr_st2="";$makers_addr_vt="";$makers_addr_dist="";$makers_addr_pin="";$makers_addr_mob="";$makers_addr_email="";
			}	
			if(!empty($results["related_load"]))
			{
				$related_load=json_decode($results["related_load"]);
				$related_load_no=$related_load->no;$related_load_kg=$related_load->kg;
			}
			else
			{
				$related_load_no="";$related_load_kg="";
			}	
		}else{
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];	
			$lift_details=$results['lift_details'];$num_of_lift=$results['num_of_lift'];$rated_speed=$results['rated_speed'];$travel_dist=$results['travel_dist'];$control_method =$results['control_method'];$machine_details =$results['machine_details'];$counter_details =$results['counter_details'];$car_frame =$results['car_frame'];$weight_clearence =$results['weight_clearence'];$locking_arrange =$results['locking_arrange'];$emergency_details =$results['emergency_details'];$lifting_beam =$results['lifting_beam'];$speed_governor =$results['speed_governor'];$retiring_details =$results['retiring_details'];$safety_details =$results['safety_details'];$sheave_details =$results['sheave_details'];$rope_details =$results['rope_details'];$head_room_dist =$results['head_room_dist'];$travel_distance =$results['travel_distance'];$car_clearence =$results['car_clearence'];$alarm_system =$results['alarm_system'];$detail_of_earthing =$results['detail_of_earthing'];$emergency_signal =$results['emergency_signal'];$detail_of_dimen =$results['detail_of_dimen'];$power_details =$results['power_details'];$construction_details =$results['construction_details'];$commencement_dt =$results['commencement_dt'];$completion_dt =$results['completion_dt'];	
			
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["premise_addr"]))
			{
				$premise_addr=json_decode($results["premise_addr"]);
				$premise_addr_st1=$premise_addr->st1;$premise_addr_st2=$premise_addr->st2;$premise_addr_vt=$premise_addr->vt;$premise_addr_dist=$premise_addr->dist;$premise_addr_pin=$premise_addr->pin;$premise_addr_mob=$premise_addr->mob;$premise_addr_email=$premise_addr->email;
			}else{
				$premise_addr_st1="";$premise_addr_st2="";$premise_addr_vt="";$premise_addr_dist="";$premise_addr_pin="";$premise_addr_mob="";$premise_addr_email="";
			}	
			if(!empty($results["install_person"]))
			{
				$install_person=json_decode($results["install_person"]);
				$install_person_name=$install_person->name;$install_person_st1=$install_person->st1;$install_person_st2=$install_person->st2;$install_person_vt=$install_person->vt;$install_person_dist=$install_person->dist;$install_person_pin=$install_person->pin;$install_person_mob=$install_person->mob;$install_person_email=$install_person->email;
			}else{
				$install_person_name="";$install_person_st1="";$install_person_st2="";$install_person_vt="";$install_person_dist="";$install_person_pin="";$install_person_mob="";$install_person_email="";
			}	
			if(!empty($results["makers_addr"]))
			{
				$makers_addr=json_decode($results["makers_addr"]);
				$makers_addr_name=$makers_addr->name;$makers_addr_st1=$makers_addr->st1;$makers_addr_st2=$makers_addr->st2;$makers_addr_vt=$makers_addr->vt;$makers_addr_dist=$makers_addr->dist;$makers_addr_pin=$makers_addr->pin;$makers_addr_mob=$makers_addr->mob;$makers_addr_email=$makers_addr->email;
			}else{
				$makers_addr_name="";$makers_addr_st1="";$makers_addr_st2="";$makers_addr_vt="";$makers_addr_dist="";$makers_addr_pin="";$makers_addr_mob="";$makers_addr_email="";
			}	
			if(!empty($results["related_load"]))
			{
				$related_load=json_decode($results["related_load"]);
				$related_load_no=$related_load->no;$related_load_kg=$related_load->kg;
			}
			else
			{
				$related_load_no="";$related_load_kg="";
			}	
		}	
			
		
				
	}
	

    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
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
									    <td colspan="4">1. Full name and permanent address of the owner/applicant.   </td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $key_person; ?>" ></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
										<td>Email Id:</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>" validate="email"></td>
									</tr>
									<tr>
									    <td colspan="4">2. Name and address of the local agent of owner, if any. (appointed under section 14):</td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   name="local_agent[name]" value="<?php echo $local_agent_name; ?>" validate="letters"></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[st1]"  value="<?php echo $local_agent_st1; ?>"></td>
										<td>Street Name2 :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[st2]"  value="<?php echo $local_agent_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[vt]"  value="<?php echo $local_agent_vt; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[dist]"  value="<?php echo $local_agent_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[pin]"  value="<?php echo $local_agent_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[mob]" value="<?php echo $local_agent_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id :</td>
										<td><input type="email" class="form-control" validate="jsonObj" name="local_agent[email]" value="<?php echo  $local_agent_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">3. Address of the premises where the lift is to be installed or additions or alterations are proposed</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="premise_addr[st1]"  value="<?php echo $premise_addr_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="premise_addr[st2]"   value="<?php echo $premise_addr_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="premise_addr[vt]"  value="<?php echo $premise_addr_vt; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" name="premise_addr[dist]"  value="<?php echo $premise_addr_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="premise_addr[pin]"  value="<?php echo $premise_addr_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" name="premise_addr[mob]" value="<?php echo $premise_addr_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id :</td>
										<td><input type="email" class="form-control" validate="jsonObj" name="premise_addr[email]" value="<?php echo  $premise_addr_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">4. Where a lift has been previously erected and a license has been granted (Details to be given) </td>
										<td><textarea class="form-control text-uppercase" name="lift_details" maxlength="255" ><?php echo  $lift_details; ?></textarea></td>			
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
										<td colspan="4">5. Name and address of the person (authorized under section 13) who will install the lift or make additions or alterations   </td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   name="install_person[name]" value="<?php echo $install_person_name; ?>"  validate="letters"></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[st1]"  value="<?php echo $install_person_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[st2]"   value="<?php echo $install_person_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[vt]"  value="<?php echo $install_person_vt; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[dist]"  value="<?php echo $install_person_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[pin]"  value="<?php echo $install_person_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[mob]" value="<?php echo $install_person_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" validate="jsonObj" name="install_person[email]" value="<?php echo  $install_person_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">6. Maker’s name and address</td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   name="makers_addr[name]" validate="letters" value="<?php echo $makers_addr_name; ?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[st1]"  value="<?php echo $makers_addr_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[st2]"   value="<?php echo $makers_addr_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[vt]"  value="<?php echo $install_person_vt; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[dist]"  value="<?php echo $makers_addr_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[pin]"  value="<?php echo $makers_addr_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[mob]" value="<?php echo $makers_addr_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id :</td>
										<td><input type="email" class="form-control" validate="jsonObj" name="makers_addr[email]" value="<?php echo  $makers_addr_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>7. Number of lift required </td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="num_of_lift"   value="<?php echo  $num_of_lift; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">8. Rated Load</td>
									</tr>
									<tr>
										<td>(a) Number of persons </td>
										<td><input type="text" class="form-control text-uppercase" name="related_load[no]"  validate="onlyNumbers" value="<?php echo  $related_load_no; ?>"></td>
										<td>(b) Kilograms </td>
										<td><input type="text" class="form-control text-uppercase" name="related_load[kg]"  validate="decimal" value="<?php echo  $related_load_kg; ?>"></td>
									</tr>	
									<tr>
										<td>9. Rated speed (meter per second) <span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="rated_speed"  value="<?php echo  $rated_speed; ?>" validate="decimal" required="required"> </td>
										<td>10. Travel in meters</td>
										<td><input type="text" class="form-control text-uppercase" name="travel_dist"  value="<?php echo  $travel_dist; ?>"></td>
									</tr>
									<tr>
										<td width="25%">11. Method of control </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="control_method"   value="<?php echo  $control_method; ?>"></td>
										<td width="25%">12. Position and details of machine room</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="machine_details" maxlength="255" ><?php echo  $machine_details; ?></textarea></td>
									</tr>
									<tr>
										<td width="25%">13. Position and details of counter weight.</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="counter_details" maxlength="255" ><?php echo  $counter_details; ?></textarea></td>
										<td width="25%">14. Details of car frame, platform, internal size of car </td>
										<td ><textarea class="form-control text-uppercase" name="car_frame" maxlength="255" ><?php echo  $car_frame; ?></textarea></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="cei_form6.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save and Next</button>
										</td>					
									</tr>		
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">	
									
									<tr>
										<td width="25%">15. Details of bottom and top counter weight clearance</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="weight_clearence" maxlength="255" ><?php echo  $weight_clearence; ?></textarea> </td>
										<td width="25%">16.  Details of car and landing doors with its opening device and locking arrangements.     </td>
										<td width="25%"><textarea class="form-control text-uppercase" name="locking_arrange" maxlength="255" ><?php echo  $locking_arrange; ?></textarea></td>
									</tr>
									<tr>
										<td width="25%">17. Details of emergency stop switch, floor leveling switch, floor selectors and car gate switch.     </td>
										<td width="25%"><textarea class="form-control text-uppercase" name="emergency_details"maxlength="255" ><?php echo  $emergency_details; ?></textarea></td>
										<td width="25%">18. Details of lift pit, lift well enclosure and lifting beam  </td>
										<td width="25%"><textarea class="form-control text-uppercase" name="lifting_beam" maxlength="255" ><?php echo  $lifting_beam; ?></textarea></td>
									</tr>
									
									<tr>
										<td >19. Details of over speed governor.</td>
										<td ><textarea class="form-control text-uppercase" name="speed_governor" maxlength="255" ><?php echo  $speed_governor; ?></textarea></td>
										<td>20. Details of retiring cam/retiring ram. </td>
										<td ><textarea class="form-control text-uppercase" name="retiring_details" maxlength="255" ><?php echo  $retiring_details; ?></textarea></td>
									</tr>
									<tr>
										<td>21.Details of safety gear.       </td>
										<td><textarea class="form-control text-uppercase" name="safety_details" maxlength="255" ><?php echo  $safety_details; ?></textarea></td>
										<td>22. Details of sheave and diverter pulley.  </td>
										<td ><textarea class="form-control text-uppercase" name="sheave_details" maxlength="255" ><?php echo  $sheave_details; ?></textarea></td>
									</tr>
									<tr>
										<td>23.Details of slack rope switch.</td>
										<td><textarea class="form-control text-uppercase" name="rope_details" maxlength="255" ><?php echo  $rope_details; ?></textarea></td>
										<td>24. Distance of total head room.   </td>
										<td ><input type="text" class="form-control text-uppercase" name="head_room_dist"  value="<?php echo  $head_room_dist; ?>"></td>
									</tr>
									<tr>
										<td>25.Travel distance </td>
										<td><input type="text" class="form-control text-uppercase" name="travel_distance"  value="<?php echo  $travel_distance; ?>"></td>
										<td>26. Details of bottom and top car clearance.</td>
										<td ><textarea class="form-control text-uppercase" name="car_clearence" maxlength="255" ><?php echo  $car_clearence; ?></textarea></td>
									</tr>
									<tr>
										<td>27.Details of alarm system </td>
										<td><textarea class="form-control text-uppercase" name="alarm_system" maxlength="255" ><?php echo  $alarm_system; ?></textarea></td>
										<td>28. Details of earthing   </td>
										<td><textarea class="form-control text-uppercase" name="detail_of_earthing" maxlength="255" ><?php echo  $detail_of_earthing; ?></textarea></td>
									</tr>
									<tr>
										<td>29. Details of emergency signal or telephone.  </td>
										<td><textarea class="form-control text-uppercase" name="emergency_signal" maxlength="255" ><?php echo  $emergency_signal; ?></textarea></td>
										<td>30. Details of lift well dimensions.  </td>
										<td ><textarea class="form-control text-uppercase" name="detail_of_dimen" maxlength="255" ><?php echo  $detail_of_dimen; ?></textarea></td>
									</tr>
									<tr>
										<td>31. Details of power and lighting cables to half way points in lift well.</td>
										<td><textarea class="form-control text-uppercase" name="power_details" maxlength="255" ><?php echo  $power_details; ?></textarea></td>
										<td>32. Details of the construction of the overhead arrangement with the weight and sizes of the beams.</td>
										<td ><textarea class="form-control text-uppercase" name="construction_details" maxlength="255" ><?php echo  $construction_details; ?></textarea></td>
									</tr>
									<tr>
										<td>33. Proposed date for commencement of work </td>
										<td><input type="text" class="dob form-control text-uppercase" name="commencement_dt"  value="<?php echo  $commencement_dt; ?>"></td>
										<td>34. Proposed date for completion of work.</td>
										<td ><input type="text" class="dob form-control text-uppercase" name="completion_dt"  value="<?php echo  $completion_dt; ?>"></td>
									</tr>
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>
										 Signature of the applicant</td>
									</tr>	
									<tr>
										<td class="text-center" colspan="4">
											<a href="cei_form6.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>	
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
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>