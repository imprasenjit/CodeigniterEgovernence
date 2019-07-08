<?php 
$dept="cei";
$form="22";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	}
	
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];				
		##### PartI ####
		$accident_datetime=$results['accident_datetime'];$accident_place=$results['accident_place'];$victim_designation=$results['victim_designation'];;$victim_sex=$results['victim_sex'];$brief_desc=$results['brief_desc'];$work_on =$results['work_on'];$s1 =$results['s1'];$reg_no =$results['reg_no'];$auth_no =$results['auth_no'];$auth_person_name =$results['auth_person_name'];
		if($victim_sex=='M'){
			$victim_sex="MALE";
		}else{
			$victim_sex="FEMALE";
		}
		if(!empty($results["victim"])){
			$victim=json_decode($results["victim"]);
			$victim_address=$victim->address;
			$victim_name=$victim->name;$victim_fname=$victim->fname;$victim_age=$victim->age;$victim_fatal=$victim->fatal;
			$victim_address_st1=$victim_address->st1;$victim_address_st2=$victim_address->st2;$victim_address_vt=$victim_address->vt;$victim_address_dist=$victim_address->dist;$victim_address_pin=$victim_address->pin;$victim_address_mob=$victim_address->mob;$victim_address_em=$victim_address->em;
		}else{
			$victim_name="";$victim_fname="";$victim_age="";$victim_fatal="";
			$victim_address_st1="";$victim_address_st2="";$victim_address_vt="";$victim_address_dist="";$victim_address_pin="";$victim_address_mob="";$victim_address_em="";
		}
		### Part II	###	
		$other_injuries=$results["other_injuries"];$postmortem=$results["postmortem"];$detail_cause=$results["detail_cause"];$action_taken=$results["action_taken"];$is_notified=$results["is_notified"];$notified_details=$results["notified_details"];$steps_taken=$results["steps_taken"];$any_remarks=$results["any_remarks"];
		if($is_notified=='Y'){
			$is_notified="YES";
		}else{
			$is_notified="NO";
			$notified_details="N/A";
		}
		if(!empty($results["auth_address"])){
			$auth_address=json_decode($results["auth_address"]);
			$auth_address_st1=$auth_address->st1;$auth_address_st2=$auth_address->st2;$auth_address_vt=$auth_address->vt;$auth_address_dist=$auth_address->dist;$auth_address_pin=$auth_address->pin;$auth_address_mob=$auth_address->mob;$auth_address_email=$auth_address->email;
		}else{
			$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
		}
		if(!empty($results["assisting_p"])){
			$assisting_p=json_decode($results["assisting_p"]);
			$assisting_p_name=$assisting_p->name;$assisting_p_desig=$assisting_p->desig;
		}else{
			$assisting_p_name="";$assisting_p_desig="";
		}
		if(!empty($results["supervising_p"])){
			$supervising_p=json_decode($results["supervising_p"]);
			$supervising_p_name=$supervising_p->name;$supervising_p_desig=$supervising_p->desig;
		}else{
			$supervising_p_name="";$supervising_p_desig="";
		}
		if(!empty($results["witness"])){
			$witness=json_decode($results["witness"]);
			$witness_name=$witness->name;$witness_desig=$witness->desig;
		}else{
			$witness_name="";$witness_desig="";
		}	
		
    }
	$brief_desc=wordwrap($brief_desc,40,"<br/>",true);
	$other_injuries=wordwrap($other_injuries,40,"<br/>",true);
	$postmortem=wordwrap($postmortem,40,"<br/>",true);
	$detail_cause=wordwrap($detail_cause,40,"<br/>",true);
	$action_taken=wordwrap($action_taken,40,"<br/>",true);
	$notified_details=wordwrap($notified_details,40,"<br/>",true);
	$steps_taken=wordwrap($steps_taken,40,"<br/>",true);
	$any_remarks=wordwrap($any_remarks,40,"<br/>",true);
	
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
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
				<td valign="top">1. Date of accident</td>
				<td>'.strtoupper($accident_datetime).'</td>
			</tr>
			<tr>
				<td valign="top">2. Place of accident</td>
				<td>'.strtoupper($accident_place).'</td>
			</tr>
			<tr>
				<td valign="top">3. Name of owner</td>
				<td>'.strtoupper($owner_names).'</td>
			</tr>
			<tr>
            <td valign="top" colspan="2">4. Details of victim</td>
			</tr>
			<tr>
				<td valign="top">(a) Name</td>
				<td>'.strtoupper($victim_name).'</td>
			</tr>
			<tr>
				<td valign="top">(b) Father’s name </td>
				<td> '.strtoupper($victim_fname).'</td>
			</tr>
			<tr>
				<td valign="top">(c) Sex of victim </td>
				<td>'.strtoupper($victim_sex).'</td>
			</tr>
			<tr>  				
				<td valign="top">(d) Full postal address</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($victim_address_st1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($victim_address_st2).'</td>
					</tr>
					<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($victim_address_vt).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($victim_address_dist).'</td>
					</tr>
					<tr>
							<td>Pincode</td>
							<td>'.strtoupper($victim_address_pin).'</td>
					</tr>					
					<tr>
							<td>Mobile</td>
							<td>+91 - '.strtoupper($victim_address_mob).'</td>
					</tr>
					<tr>
							<td>Email-id</td>
							<td>'.$victim_address_em.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">(e) Approximate age </td>
				<td>'.strtoupper($victim_age).'</td>
			</tr>
			<tr>
				<td valign="top">e) Fatal/non fatal </td>
				<td>'.strtoupper($victim_fatal).'</td>
			</tr>
			<tr>
				<td colspan="2">5. In case the victim is an employee of the person authorized under section 13</td>
			</tr>
			<tr>
				<td valign="top">(a) Designation of such person</td>
				<td>'.strtoupper($victim_designation).'</td>
			</tr>
			<tr>
				<td valign="top">(b) Brief description of the job undertaken </td>
				<td>'.strtoupper($brief_desc).'</td>
			</tr>
			<tr>
				<td valign="top">(c) Whether such person was allowed to work on the job</td>
				<td>'.strtoupper($work_on).'</td>
			</tr>
			<tr>
				<td valign="top">6. Type of the lift/escalator</td>
				<td>'.strtoupper($s1).'</td>
			</tr>
			<tr>
				<td colspan="2">7.  Registration  number  of  the  licence  of lift/escalator  along  with  the  name,  address  and authorization  number  of  the  authorized  person  by  whom  the  lift/escalator  is  erected  or maintained. </td>			
			</tr>
			<tr>
				<td valign="top">(a) Registration Number   </td>
				<td>'.strtoupper($reg_no).'</td>
			</tr>
			<tr>
				<td valign="top">(b) Authorization Number  </td>
				<td>'.strtoupper($auth_no).'</td>
			</tr>
			<tr>
				<td valign="top">(c)Name  </td>
				<td>'.strtoupper($auth_person_name).'</td>
			</tr>
			<tr>  				
				<td valign="top">(d) Address</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($auth_address_st1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($auth_address_st2).'</td>
					</tr>
					<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($auth_address_vt).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($auth_address_dist).'</td>
					</tr>
					<tr>
							<td>Pincode</td>
							<td>'.strtoupper($auth_address_pin).'</td>
					</tr>					
					<tr>
							<td>Mobile</td>
							<td>+91 - '.strtoupper($auth_address_mob).'</td>
					</tr>
					<tr>
							<td>Email-id</td>
							<td>'.$auth_address_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">8. (a) Describe fully the nature and extent of injuries, e.g. fatal/disablement (permanent or temporary) of any portion of the body or burns or other injuries. </td>
				<td>'.strtoupper($other_injuries).'</td>
			</tr>
			<tr>
				<td valign="top">(b) In case of fatal accident, was the postmortem performed? </td>
				<td>'.strtoupper($postmortem).'</td>
			</tr>
			<tr>
				<td valign="top">9. Detailed causes leading to the accident. </td>
				<td>'.strtoupper($detail_cause).'</td>
			</tr>
			<tr>
				<td valign="top">10.  Action  taken  regarding  first-aid,  medical  attendance  etc.  immediately  after  the occurrence of the accident (give details) </td>
				<td>'.strtoupper($action_taken).'</td>
			</tr>
			<tr>
				<td valign="top">11. (a) Whether  the  District  Magistrate  and  Police  Station  concerned  have  been  notified  of the accident </td>
				<td>'.strtoupper($is_notified).'</td>
			</tr>
			<tr>
				<td valign="top">(b)If so, give details </td>
				<td>'.strtoupper($notified_details).'</td>
			</tr>
			<tr>
				<td valign="top">12.  Steps  taken  to  preserve  the  evidence  in  connection  with  the  accident  to  the  extent possible  </td>
				<td>'.strtoupper($steps_taken).'</td>
			</tr>
			<tr>
				<td colspan="2">13.(a) Name and designation of the person assisting the person killed or injured. </td>
			</tr>
			<tr>
				<td valign="top">(a) Name </td>
				<td>'.strtoupper($assisting_p_name).'</td>
			</tr>
			<tr>
				<td valign="top">(b)Designation</td>
				<td>'.strtoupper($assisting_p_desig).'</td>
			</tr>
			<tr>
            <td colspan="2">13.(b) Name and designation of the person supervising the person killed or injured. </td>
			</tr>
			<tr>
				<td valign="top">(a) Name </td>
				<td>'.strtoupper($supervising_p_name).'</td>
			</tr>
			<tr>
				<td valign="top">(b)Designation</td>
				<td>'.strtoupper($supervising_p_desig).'</td>
			</tr>
			<tr>
				<td colspan="2">14. Name and designation of the persons present at and witnessed the accident </td>
			</tr>
			<tr>
				<td valign="top">(a) Name </td>
				<td>'.strtoupper($witness_name).'</td>
			</tr>
			<tr>
				<td valign="top">(b)Designation</td>
				<td>'.strtoupper($witness_desig).'</td>
			</tr>
			<tr>
				<td>15. Any other information/remarks </td>
				<td>'.strtoupper($any_remarks).'</td>
			</tr>
			';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 	
			<tr>
				<td valign="top"> Date : &nbsp;<b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
				<td valign="top" align="right">Signature:&nbsp;<b>'.strtoupper($key_person).'</b><br/>
											Name:&nbsp;<b>'.strtoupper($key_person).'</b><br/>
											Designation:&nbsp;<b>'.strtoupper($status_applicant).'</b></td>
			</tr>   			
		</table>';
	
?>

