<?php 
$dept="cei";
$form="13";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
	}
    
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];$letter_no=$results['letter_no'];$letter_dt=$results['letter_dt'];$completed_on=$results['completed_on'];	
		$type_of_lift=$results['type_of_lift'];$rated_speed=$results['rated_speed'];$rated_load=$results['rated_load'];$total_lift_weight=$results['total_lift_weight'];$counter_weight =$results['counter_weight'];$suspension_rope =$results['suspension_rope'];$pit_depth =$results['pit_depth'];$travel =$results['travel'];$head_room =$results['head_room'];$auth_person =$results['auth_person'];$auth_no =$results['auth_no'];
		if(!empty($results["local_agent"]))
		{
			$local_agent=json_decode($results["local_agent"]);
			$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
		}else{
			$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
		}
		if(!empty($results["premise_address"]))
		{
			$premise_address=json_decode($results["premise_address"]);
			$premise_address_st1=$premise_address->st1;$premise_address_st2=$premise_address->st2;$premise_address_vt=$premise_address->vt;$premise_address_dist=$premise_address->dist;$premise_address_pin=$premise_address->pin;$premise_address_mob=$premise_address->mob;$premise_address_email=$premise_address->email;
		}else{
			$premise_address_st1="";$premise_address_st2="";$premise_address_vt="";$premise_address_dist="";$premise_address_pin="";$premise_address_mob="";$premise_address_email="";
		}	
		if(!empty($results["auth_address"]))
		{
			$auth_address=json_decode($results["auth_address"]);
			$auth_address_name=$auth_address->name;$auth_address_st1=$auth_address->st1;$auth_address_st2=$auth_address->st2;$auth_address_vt=$auth_address->vt;$auth_address_dist=$auth_address->dist;$auth_address_pin=$auth_address->pin;$auth_address_mob=$auth_address->mob;$auth_address_email=$auth_address->email;
		}
		else
		{
			$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
		}
		
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
				<td colspan="2">To,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Inspector of Lift and Escalators,<br/><br/>
				Sub : Installation of Lift at '.strtoupper($unit_name).'<br/><br/>	
				Dear Sir,<br/><br/>								
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With reference to letter No.- <b>'.strtoupper($letter_no).'</b>&nbsp; dated - <b>'.date('d-m-Y',strtotime($letter_dt)).'</b> &nbsp;of your office granting permission to install a Lift at the above mentioned premises, I/We have to state that the work of installation of the Lift has been completed on <b>'.date('d-m-Y',strtotime($completed_on)).'</b>.<br/> 
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We therefore request that a license for operating the Lift may be granted. <br/>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The work of erection of the Lift has been carried out in accordance with the provisions of the Assam Lifts and Escalators Rules, 2010. <br/>
				</td>  
			</tr>
	   
  		<tr>  				
			<td valign="top">1. Full name and address of the applicant :</td>
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
  		<td valign="top">2. Name and address of the local agent, if any :</td>
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
  		<td valign="top">3.Address of the premises where the lift has been erected together with the name of the owner thereof :</td>
  		<td valign="top">
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($premise_address_st1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($premise_address_st2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($premise_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($premise_address_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($premise_address_pin).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($premise_address_mob).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td>'.$premise_address_email.'</td>
      		</tr>
    		</table></td>
  	</tr>
	<tr>
		<td valign="top">4. Name and address of the person (authorized under section 13) who is going to maintain the lift. :</td>
		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($auth_address_name).'</td>
      		</tr>
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
    		</table></td>
	</tr>
	<tr>
		<td valign="top">5. Type of lift :</td>
		<td>'.strtoupper($type_of_lift).'</td>
	</tr>
	<tr>
		<td valign="top">6. The rated load of the lift (in Kilograms):</td>
		<td>'.strtoupper($rated_load).'</td>
	</tr>
	<tr>
		<td valign="top">7. The rated speed of the lift (meters/second) :</td>
		<td>'.strtoupper($rated_speed).'</td>
	</tr>
	<tr>
		<td valign="top">8. The total weight of the lift car including the rated load : </td>
		<td>'.strtoupper($total_lift_weight).'<br/>
		</td>
	</tr>
	<tr>
		<td valign="top">9. The total weight of the counterweight :</td>
		<td>'.strtoupper($counter_weight).'</td>
	</tr>
	<tr>
		<td valign="top">10. The number, description, weight and size of the suspension ropes :</td>
		<td>'.strtoupper($suspension_rope).'</td>
	</tr>
	<tr>
		<td valign="top">11. The pit depth :</td>
		<td>'.strtoupper($pit_depth).'</td>
	</tr>
	<tr>
		<td valign="top">12. Travel and the number of floors served :</td>
		<td>'.strtoupper($travel).'</td>
	</tr>
	<tr>
		<td valign="top">13. The total head room :</td>
		<td>'.strtoupper($head_room).'</td>
	</tr>
	';
       
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.' 	  
   <tr>
		<td> Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b><br/>
					Authorization number : <b>'.strtoupper($auth_no).'</b><br/>
					Name of the authorized person : <b>'.strtoupper($auth_person).'</b>
					</td>
		<td align="right"><b>'.strtoupper($key_person).'<br/></b>Signature of the applicant
		</td>
	</tr>
</table>';
?>