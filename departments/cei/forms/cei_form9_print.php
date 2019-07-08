<?php
$dept="cei";
$form="9";
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
		$escalator_detail=$results['escalator_detail'];$rated_speed=$results['rated_speed'];$rated_load=$results['rated_load'];$num_of_person=$results['num_of_person'];$angle_of_incline =$results['angle_of_incline'];$wd_of_escalator =$results['wd_of_escalator'];$vertical_rise =$results['vertical_rise'];$drive_claim =$results['drive_claim'];$cons_detail =$results['cons_detail'];$commencement_dt =$results['commencement_dt'];$completion_dt =$results['completion_dt'];
		
		if(!empty($results["local_agent"]))
		{
			$local_agent=json_decode($results["local_agent"]);
			$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
		}else{
			$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
		}
		if(!empty($results["escalator_install"]))
		{
			$escalator_install=json_decode($results["escalator_install"]);
			$escalator_install_st1=$escalator_install->st1;$escalator_install_st2=$escalator_install->st2;$escalator_install_vt=$escalator_install->vt;$escalator_install_dist=$escalator_install->dist;$escalator_install_pin=$escalator_install->pin;$escalator_install_mob=$escalator_install->mob;$escalator_install_email=$escalator_install->email;
		}else{
			$escalator_install_name="";$escalator_install_st1="";$escalator_install_st2="";$escalator_install_vt="";$escalator_install_dist="";$escalator_install_pin="";$escalator_install_mob="";$escalator_install_email="";
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
		$escalator_detail=wordwrap($escalator_detail,40,"<br>",true);
		$cons_detail=wordwrap($cons_detail,40,"<br>",true);
		
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UIAN : '.strtoupper($results["uain"]).'</p>';
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
        			<td >Street Name 1</td>
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
    		</table></td>
  	</tr>
  	<tr>
  		<td>3.  Address of the premises  where the escalator is to be installed or  additions or alternations are proposed.</td>
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($escalator_install_st1).'</td>
      		</tr>
      		<tr>
        			<td >Street Name 2</td>
        			<td>'.strtoupper($escalator_install_st2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($escalator_install_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($escalator_install_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($escalator_install_pin).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($escalator_install_mob).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td>'.$escalator_install_email.'</td>
      		</tr>
    		</table></td>
  	</tr>
	<tr>
		<td >4. Whether  an  escalator  has  been  previously  erected  and  a  licence  has  been  granted (Details to be given) :</td>
		<td >'.strtoupper($escalator_detail).'</td>
	</tr>
	<tr>
		<td >5. Name  and  address  of  the  person  (authorized  under  section  13)  who  will  install  the escalator or make additions or alterations:-</td>
		<td >
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
    		</table></td>
	</tr>
	<tr>
		<td >6. Maker’s name and address</td>
		<td >
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
    		</table></td>
	</tr>
	<tr>
		<td >7. The rated speed of the escalator(meter per second) :</td>
		<td>'.strtoupper($rated_speed).'</td>
	</tr>
	<tr>
		<td >8. The rated load of the escalator in Kilograms :</td>
		<td>'.strtoupper($rated_load).'</td>
	</tr>
	<tr>
		<td >9. The maximum number of persons which the escalator can carry :</td>
		<td>'.strtoupper($num_of_person).'</td>
	</tr>
	<tr>
		<td >10. The angle of inclination of the escalator with the horizontal :</td>
		<td>'.strtoupper($angle_of_incline).'</td>
	</tr>
	<tr>
		<td >11. The width of escalator :</td>
		<td>'.strtoupper($wd_of_escalator).'</td>
	</tr>
	<tr>
		<td >12. The vertical rise of the escalator. :</td>
		<td>'.strtoupper($vertical_rise).'</td>
	</tr>
	<tr>
		<td >13. The  number, description,  weight  and  size  main  drive  chain,  handrail  drive  chain  and governor drive claim :</td>
		<td>'.strtoupper($drive_claim).'</td>
	</tr>
	<tr>
		<td >14.  Details  of  construction  of  the  stresses  and  step  treads  together  with  the  weight  and size of all structural members and supporting beams in connection therewith. :</td>
		<td>'.strtoupper($cons_detail).'</td>
	</tr>
	<tr>
		<td >15. Proposed date of commencement of work :</td>
		<td>'.strtoupper($commencement_dt).'</td>
	</tr>
	<tr>
		<td>16. Proposed date of completion of work :  </td>
		<td>'.strtoupper($completion_dt).'</td>
	</tr>
	';
	
    $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'
	
	<tr>
		<td> Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
		<td align="right"><b>'.strtoupper($key_person).'</b><br/>
			Signature of the applicant
		</td>
	</tr>
</table>';

?>
