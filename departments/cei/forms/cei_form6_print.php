<?php 
$dept="cei";
$form="6";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id' ORDER BY form_id DESC LIMIT 1");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1");
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1");
	}
	
	if($q->num_rows>0){
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
			;$premise_addr_st1="";$premise_addr_st2="";$premise_addr_vt="";$premise_addr_dist="";$premise_addr_pin="";$premise_addr_mob="";$premise_addr_email="";
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
		}else{
			$related_load_no="";$related_load_kg="";
		}
		
		$lift_details = wordwrap($lift_details, 40, "<br/>", true);	
		$machine_details = wordwrap($machine_details, 40, "<br/>", true);	
		$counter_details = wordwrap($counter_details, 40, "<br/>", true);	
		$car_frame = wordwrap($car_frame, 40, "<br/>", true);	
		$weight_clearence = wordwrap($weight_clearence, 40, "<br/>", true);	
		$locking_arrange = wordwrap($locking_arrange, 40, "<br/>", true);	
		$emergency_details = wordwrap($emergency_details, 40, "<br/>", true);	
		$lifting_beam = wordwrap($lifting_beam, 40, "<br/>", true);	
		$speed_governor = wordwrap($speed_governor, 40, "<br/>", true);	
		$retiring_details = wordwrap($retiring_details, 40, "<br/>", true);	
		$safety_details = wordwrap($safety_details, 40, "<br/>", true);	
		$sheave_details = wordwrap($sheave_details, 40, "<br/>", true);	
		$rope_details = wordwrap($rope_details, 40, "<br/>", true);	
		$car_clearence = wordwrap($car_clearence, 40, "<br/>", true);	
		$alarm_system = wordwrap($alarm_system, 40, "<br/>", true);	
		$detail_of_earthing = wordwrap($detail_of_earthing, 40, "<br/>", true);	
		$emergency_signal = wordwrap($emergency_signal, 40, "<br/>", true);	
		$detail_of_dimen = wordwrap($detail_of_dimen, 40, "<br/>", true);	
		$power_details = wordwrap($power_details, 40, "<br/>", true);	
		$construction_details = wordwrap($construction_details, 40, "<br/>", true);
		
		$form_name=$formFunctions->get_formName($dept,$form);
		$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	}
	if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form '.$form.'</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
			'.$assamSarkarLogo.'
			<h4> '.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">
		<tr>  				
			<td>1. Full name and permanent address of the owner/applicant.:</td>
            <td style="width:50%">
            <table class="table table-bordered table-responsive">
			<tr>
					<td> Name</td>
					<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($street_name1).'</td>
			</tr>
			<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($street_name2).'</td>
			</tr>
			<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($vill).'</td>
			</tr>
			<tr>
					<td>District</td>
					<td>'.strtoupper($dist).'</td>
			</tr>
			<tr>
					<td>Pincode</td>
					<td>'.strtoupper($pincode).'</td>
			</tr>
			
			<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($mobile_no).'</td>
			</tr>
			<tr>
					<td>Phone Number</td>
					<td>'.strtoupper($landline_std).'&nbsp;-&nbsp;'.strtoupper($landline_no).'</td>
			</tr>
			<tr>
					<td>Email-id</td>
					<td>'.$email.'</td>
			</tr>
			</table>
		</td>
	</tr>
   <tr>
		<td>2. Name and address of the local agent of owner, if any. (appointed under section 14):</td>
		<td>
		<table class="table table-bordered table-responsive">
			<tr>
					<td>Name </td>
					<td>'.strtoupper($local_agent_name).'</td>
			</tr>
			<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($local_agent_st1).'</td>
			</tr>
			<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($local_agent_st2).'</td>
			</tr>
			<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($local_agent_vt).'</td>
			</tr>
			<tr>
					<td>District</td>
					<td>'.strtoupper($local_agent_dist).'</td>
			</tr>
			<tr>
					<td>Pincode</td>
					<td>'.strtoupper($local_agent_pin).'</td>
			</tr>
			
			<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($local_agent_mob).'</td>
			</tr>
			<tr>
					<td>Email-id</td>
					<td>'.$local_agent_email.'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>3. Address of the premises where the lift is to be installed or additions or alterations are proposed :</td>
		<td>
		<table class="table table-bordered table-responsive">
			<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($premise_addr_st1).'</td>
			</tr>
			<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($premise_addr_st2).'</td>
			</tr>
			<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($premise_addr_vt).'</td>
			</tr>
			<tr>
					<td>District</td>
					<td>'.strtoupper($premise_addr_dist).'</td>
			</tr>
			<tr>
					<td>Pincode</td>
					<td>'.strtoupper($premise_addr_pin).'</td>
			</tr>
			
			<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($premise_addr_mob).'</td>
			</tr>
			<tr>
					<td>Email-id</td>
					<td>'.$premise_addr_email.'</td>
			</tr>
			</table>
            </td>
	</tr>
	<tr>
		<td>4. Where a lift has been previously erected and a license has been granted (Details to be given) :</td>
		<td>'.strtoupper($lift_details).'</td>
	</tr>
	<tr>
		<td>5. Name and address of the person (authorized under section 13) who will install the lift or make additions or alterations :</td>
		<td>
		<table class="table table-bordered table-responsive">
			<tr>
					<td>Name</td>
					<td>'.strtoupper($install_person_name).'</td>
			</tr>
			<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($install_person_st1).'</td>
			</tr>
			<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($install_person_st2).'</td>
			</tr>
			<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($install_person_vt).'</td>
			</tr>
			<tr>
					<td>District</td>
					<td>'.strtoupper($install_person_dist).'</td>
			</tr>
			<tr>
					<td>Pincode</td>
					<td>'.strtoupper($install_person_pin).'</td>
			</tr>
			
			<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($install_person_pin).'</td>
			</tr>
			<tr>
					<td>Email-id</td>
					<td>'.$install_person_email.'</td>
			</tr>
			</table>
            </td>
	</tr>
	<tr>
		<td>6. Maker’s name and address :  </td>
		<td>
		<table class="table table-bordered table-responsive">
			<tr>
					<td>Name</td>
					<td>'.strtoupper($makers_addr_name).'</td>
			</tr>
			<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($makers_addr_st1).'</td>
			</tr>
			<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($makers_addr_st2).'</td>
			</tr>
			<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($makers_addr_vt).'</td>
			</tr>
			<tr>
					<td>District</td>
					<td>'.strtoupper($makers_addr_dist).'</td>
			</tr>
			<tr>
					<td>Pincode</td>
					<td>'.strtoupper($makers_addr_pin).'</td>
			</tr>
			
			<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($makers_addr_mob).'</td>
			</tr>
			<tr>
					<td>Email-id</td>
					<td>'.$makers_addr_email.'</td>
			</tr>
			</table>
            </td>
	</tr>
	<tr>
		<td>7. Number of lift required :</td>
		<td>'.strtoupper($num_of_lift).'</td>
	</tr>
	<tr>
		<td>8. Rated Load:</td>
		<td>(a) Number of persons :'.strtoupper($related_load_no).'<br/>
		(b) Kilograms :'.strtoupper($related_load_kg).'<br/>
		</td>
	</tr>
	<tr>
		<td>9. Rated speed (meter per second) :</td>
		<td>'.strtoupper($rated_speed).'</td>
	</tr>
	<tr>
		<td>10. Travel in meters :</td>
		<td>'.strtoupper($travel_dist).'</td>
	</tr>
	<tr>
		<td>11. Method of control :</td>
		<td>'.strtoupper($control_method).'</td>
	</tr>
	<tr>
		<td>12. Position and details of machine room :</td>
		<td>'.strtoupper($machine_details).'</td>
	</tr>
	<tr>
		<td>13. Position and details of counter weight :</td>
		<td>'.strtoupper($counter_details).'</td>
	</tr>
	<tr>
		<td>14. Details of car frame, platform, internal size of car :</td>
		<td>'.strtoupper($car_frame).'</td>
	</tr>
	<tr>
		<td>15. Details of bottom and top counter weight clearance :</td>
		<td>'.strtoupper($weight_clearence).'</td>
	</tr>
	<tr>
		<td>16.  Details of car and landing doors with its opening device and locking arrangements :  </td>
		<td>'.strtoupper($locking_arrange).'</td>
	</tr>
	<tr>
		<td>17. Details of emergency stop switch, floor leveling switch, floor selectors and car gate switch: </td>
		<td>'.strtoupper($emergency_details).'</td>
	</tr>
	<tr>
		<td>18. Details of lift pit, lift well enclosure and lifting beam :</td>
		<td>'.strtoupper($lifting_beam).'</td>
	</tr>
	<tr>
		<td>19. Details of over speed governor :</td>
		<td>'.strtoupper($speed_governor).'</td>
	</tr>
	<tr>
		<td>20. Details of retiring cam/retiring ram :</td>
		<td>'.strtoupper($retiring_details).'</td>
	</tr>
	<tr>
		<td>21.Details of safety gear : </td>
		<td>'.strtoupper($safety_details).' </td>
	</tr>
	<tr>
		<td>22. Details of sheave and diverter pulley : </td>
		<td>'.strtoupper($sheave_details).' </td>
	</tr>
	<tr>
		<td>23.Details of slack rope switch :</td>
		<td>'.strtoupper($rope_details).' </td>
	</tr>
	<tr>
		<td>24. Distance of total head room :</td>
		<td>'.strtoupper($head_room_dist).' </td>
	</tr>
	<tr>
		<td>25.Travel distance :</td>
		<td>'.strtoupper($travel_distance).' </td>
	</tr>
	<tr>
		<td>26. Details of bottom and top car clearance :</td>
		<td>'.strtoupper($car_clearence).' </td>
	</tr>
	<tr>
		<td>27.Details of alarm system :</td>
		<td>'.strtoupper($alarm_system).' </td>
	</tr>
	<tr>
		<td>28. Details of earthing :</td>
		<td>'.strtoupper($detail_of_earthing).' </td>
	</tr>
	<tr>
		<td>29. Details of emergency signal or telephone :</td>
		<td>'.strtoupper($emergency_signal).' </td>
	</tr>
	<tr>
		<td>30. Details of lift well dimensions</td>
		<td>'.strtoupper($detail_of_dimen).' </td>
	</tr>
	<tr>
		<td>31. Details of power and lighting cables to half way points in lift well :</td>
		<td>'.strtoupper($power_details).' </td>
	</tr>
	<tr>
		<td>32. Details of the construction of the overhead arrangement with the weight and sizes of the beams. :</td>
		<td>'.strtoupper($construction_details).' </td>
	</tr>
	<tr>
		<td>33. Proposed date for commencement of work :</td>
		<td>'.strtoupper($commencement_dt).' </td>
	</tr>
	<tr>
		<td>34. Proposed date for completion of work :</td>
		<td>'.strtoupper($completion_dt).' </td>
	</tr>
	';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.' 
	<tr>
		<td> Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
		<td align="right">	<b>'.strtoupper($key_person).'</b><br/>
			Signature of the applicant
		</td>
	</tr>
	</tbody>
</table>';

?>
