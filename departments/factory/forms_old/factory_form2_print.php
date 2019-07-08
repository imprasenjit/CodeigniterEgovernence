<?php
$dept="factory";
$form="2";
$table_name=$formFunctions->getTableName($dept,$form);	
 if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$factory->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($factory->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$factory->query("select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") or die($factory->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$factory->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($factory->error);		
	}else{
		$q=$factory->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($factory->error);
	}
	if(isset($css)){
		$email=$mysqli->query("select email from users where id='$applicant_id'")->fetch_object()->email;
	}else{
		$email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
	}	
	$row1=$row1=$formFunctions->fetch_swr($swr_id);	
	$name_of_owner=$row1['Name_of_owner'];	
	$owners=Array();
	$owners=explode(",",$name_of_owner);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$owner_type=$row1['Type_of_ownership'];
	
	$get_l_o_business=get_legal_entity($owner_type);
	$l_o_business_values=Array();
	$l_o_business_values=explode("/",$get_l_o_business);
	$legal_entity=$l_o_business_values[0];
	
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."<br/>Vill/Town : ".strtoupper($vill).",<br/>District : ".strtoupper($dist)."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$b_landline_std."-".$b_landline_no."<br/>E-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."<br/>Vill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."<br/>Pin Code : ".$b_pincode."<br/>Mobile Number : +91 ".$b_mobile_no."<br/>Phone Number : ".$b_landline_std."-".$b_landline_no;
	$corr_unit_details="Street Name : ".strtoupper($b_street_name3)."  ".strtoupper($b_street_name4)."<br/>Vill/Town : ".strtoupper($b_vill2)." , ".strtoupper($b_dist2)."<br/>Pin Code : ".$b_pincode2;
	
	if($q->num_rows>0)////////for empty/////
	{	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$cah=$results['cah'];
		$managing_agents=$results['managing_agents'];
		
		$risk_category=$results['risk_category'];
		$risk_category_results=$mysqli->query("SELECT businesstype FROM inspection_category WHERE deptcode ='factory' and id='$risk_category'") or die($mysqli->error);
		if($risk_category_results->num_rows>0){
			$risk_category=$risk_category_results->fetch_object()->businesstype;
		}
		
		
		if(!empty($results["communication_address"])){
			$communication_address=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["communication_address"]));
			$communication_address_str1=$communication_address->str1;$communication_address_str2=$communication_address->str2;$communication_address_vill=$communication_address->vill;$communication_address_dist=$communication_address->dist;$communication_address_pin=$communication_address->pin;$communication_address_m_no=$communication_address->m_no;$communication_address_p_no=$communication_address->p_no;$communication_address_email=$communication_address->email;
		}else{
			$communication_address_str1="";$communication_address_str2="";$communication_address_vill="";$communication_address_dist="";$communication_address_pin="";$communication_address_m_no="";$communication_address_p_no="";$communication_address_email="";
		}
		if(!empty($results["manuf_process"])){
			$manuf_process=json_decode($results["manuf_process"]);
			$manuf_process_carried=$manuf_process->carried;$manuf_process_car_fac=$manuf_process->car_fac;$manuf_process_nat_fac=$manuf_process->nat_fac;
		}else{
			$manuf_process_carried="";$manuf_process_car_fac="";$manuf_process_nat_fac="";
		}
		
		if(!empty($results["manuf_prod"])){
			$manuf_prod=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["manuf_prod"]));
			$manuf_prod_nv=$manuf_prod->nv;$manuf_prod_max_emp=$manuf_prod->max_emp;
			$manuf_prod_max_emp1=$manuf_prod->max_emp1;$manuf_prod_max_emp2=$manuf_prod->max_emp2;
		}else{
			$manuf_prod_nv="";$manuf_prod_max_emp="";$manuf_prod_max_emp1="";$manuf_prod_max_emp2="";
		}
		if(!empty($results["power"])){
			$power=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["power"]));
			$power_nature=$power->nature;$power_p=$power->p;$power_mp=$power->mp;
		}else{
			$power_nature="";$power_p="";$power_mp="";
		}
		if(!empty($results["manager"])){
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_p=$manager->p;
		}else{
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
		}
		
		
		if(!empty($results["owner"])){
			$owner=json_decode($results["owner"]);
			$owner_name=$owner->name;$owner_sn1=$owner->sn1;$owner_sn2=$owner->sn2;$owner_vill=$owner->vill;$owner_dist=$owner->dist;$owner_pin=$owner->pin;
		}else{
			$owner_name="";$owner_sn1="";$owner_sn2="";$owner_vill="";$owner_dist="";$owner_pin="";
		}
		if(!empty($results["ref_no"])){
			$ref_no=json_decode($results["ref_no"]);
			$ref_no_approval1=$ref_no->approval1;$ref_no_approval2=$ref_no->approval2;
		}else{
			$ref_no_approval2="";$ref_no_approval1="";
		}
		
	}
	
	if($manuf_process_nat_fac=='PGS'){
		$manuf_process_nat_fac_name='POWER GENERATING STATION';$inhp='In K.W';
	}elseif($manuf_process_nat_fac=='ES'){
		$manuf_process_nat_fac_name='ELECTRICAL SUBSTATTION';$inhp='In K.W';
	}else{
		$manuf_process_nat_fac_name='OTHER';$inhp='In H.P';
	}
	
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
  			<h4>'.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">			
			<tr>				
				<td width="50%">1. Full name of the Factory (with factory licence number if already registered before):</td>
				<td width="50%">
					<table width="100%" >
						<tr>
							<td width="50%">Name of the Factory</td>
							<td width="50%">'.strtoupper($unit_name).'</td>
						</tr>
						<tr>
							<td width="50%">Legal Entity</td>
							<td width="50%">'.strtoupper($legal_entity).'</td>
						</tr>	 
					</table>
				</td>
			</tr>
			<tr>
				<td>2 (a) Full postal address and situation of the factory</td>
				<td>Street Name 1 : '.strtoupper($b_street_name1).'<br/>Street Name 2 : '.strtoupper($b_street_name2).'<br/>Vill/Town : '.strtoupper($b_vill).'<br/>District : '.strtoupper($b_dist).'<br/>Pincode : '.strtoupper($b_pincode).'<br/>Mobile No : '.strtoupper($b_mobile_no).'<br/>Phone No : '.$b_landline_std." - ".$b_landline_no.'</td>
			</tr>
			<tr>
				<td>(b) Full address to which communication relating to the factory should be made</td>
				<td>Street Name 1 : '.strtoupper($communication_address_str1).'<br/>Street Name 2 : '.strtoupper($communication_address_str2).'<br/>Vill/Town : '.strtoupper($communication_address_vill).'<br/>District : '.strtoupper($communication_address_dist).'<br/>Pincode : '.strtoupper($communication_address_pin).'<br/>Mobile No : '.strtoupper($communication_address_m_no).'<br/>Phone No : '.$communication_address_p_no.'<br/>Email ID : '.$communication_address_email.'</td>
			</tr>
			<tr>
				<td colspan="2" height="40px" valign="center">3. Nature of manufacturing process or processes</td>
			</tr>
			<tr>
				<td>(a) Carried on in the factory during the last 12 months (in the factories already in existence)</td>
				<td>'.strtoupper($manuf_process_carried).'</td>
			</tr>
			<tr>
				<td>(b) To be carried on in the factory during the next 12 months (in the case of all factories)</td>
				<td>'.strtoupper($manuf_process_car_fac).'</td>
			</tr>
			<tr>
				<td>(C) Nature of the factory</td>
				<td>'.strtoupper($manuf_process_nat_fac_name).'</td>
			</tr>
			<tr>
				<td>4. Names and values or principal products manufactured during the last 12 months</td>
				<td>'.strtoupper($manuf_prod_nv).'</td>
			</tr>
			<tr>
				<td>5.(i) Maximum number of workers proposed to be employed on any day during the year</td>
				<td>'.strtoupper($manuf_prod_max_emp).'</td>
			</tr>
			<tr>
				<td>(ii) Maximum number of workers employed on any one day during the last 12 months</td>
				<td>'.strtoupper($manuf_prod_max_emp1).'</td>
			</tr>
			<tr>
				<td>(iii) Number of workers to be ordinarily employed in the factory</td>
				<td>'.strtoupper($manuf_prod_max_emp2).'</td>
			</tr>
			<tr>
				<td>6. (i) Nature and total amount of power ('.$inhp.') installed or proposed to be installed</td>
				<td>Nature : '.strtoupper($power_nature).'<br/>Power : '.strtoupper($power_p).'</td>
			</tr>
			<tr>
				<td>(ii) Maximum amount of power ('.$inhp.') proposed to be used</td>
				<td>'.strtoupper($power_mp).'</td>
			</tr>
			<tr>
				<td>Risk Category</td>
                <td>'.strtoupper($risk_category).'</td>				
			</tr>
			<tr>
				<td> 7. Full name and residential address of the person who shall be the manager of the factory for the purpose of the Act</td>
				<td>Name : '.strtoupper($manager_name).'<br/>Street Name 1 : '.strtoupper($manager_sn1).'<br/>Street Name 2 : '.strtoupper($manager_sn2).'<br/>Vill/Town : '.strtoupper($manager_v).'<br/>District : '.strtoupper($manager_d).'<br/>Pincode : '.strtoupper($manager_p).'</td>
			</tr>
			<tr>
				<td> 8. Full name and residential address of occupier:</td>
				<td>Name : '.strtoupper($key_person).'<br/>Street Name 1 : '.strtoupper($street_name1).'<br/>Street Name 2 : '.strtoupper($street_name2).'<br/>Village/Town : '.strtoupper($vill).'<br/>District : '.strtoupper($dist).'<br/>Pincode : '.strtoupper($pincode).'</td>
			</tr>
			<tr>
				<td>(i) The proprietor of the factory in case of private firm/proprietory concern</td>
				<td>';
				
				if($owner_type=="PR"){ 
					$printContents=$printContents . strtoupper($name_of_owner);
				}
				$printContents=$printContents . '</td>
			</tr>
			<tr>
				<td>(ii) Directors in case of a public limited company/firm</td>
				<td>';
				
				if($owner_type=="PBLC" || $owner_type=="PTLC" || $owner_type=="PP" || $owner_type=="LLP" || $owner_type=="SOC" || $owner_type=="CS"){
					$printContents=$printContents . strtoupper($name_of_owner);
				}
				$printContents=$printContents . '</td>
			</tr>
			<tr>
				<td>(iii) Where a managing agent has been appointed the name of Managing Agents and Directors thereof</td>
				<td>'.strtoupper($managing_agents).'</td>
			</tr>	
			<tr>
				<td>(iv) Share-holders in case of a private company whereas Managing Agents have been appointed</td>
				<td>As per annexure attached.</td>
			</tr>	
			<tr>
				<td>(v) The Chief Administrative Head in case of a Govt. or local Fund Factory </td>
				<td>';
				
				if($owner_type=="HUF" || $owner_type=="PSU"){
					$printContents=$printContents . 'Name : '.strtoupper($owners[0]).'<br/>Designation : '.strtoupper($cah);
				}
				$printContents=$printContents . '</td>
			</tr>
			<tr>
				<td>9. Full name and address of the owner of the premises of building (including precincts thereof) referred to section 93</td>
				<td>Name : '.strtoupper($owner_name).'<br/>Street Name 1 : '.strtoupper($owner_sn1).'<br/>Street Name 2 : '.strtoupper($owner_sn2).'<br/>Village/Town : '.strtoupper($owner_vill).'<br/>District : '.strtoupper($owner_dist).'<br/>Pincode : '.strtoupper($owner_pin).'</td>
			</tr>
			<tr>
				<td colspan="2">10. In the case of a factory constructed or extended after the  date of the commencement of the rules</td>
			</tr>
			<tr>
				<td >(a) Reference number and date of approval of the plans for site where for old or new building and for construction or extension of factory by the State Govt. Chief Inspector</td>
				<td>'.strtoupper($ref_no_approval1).'</td>
			</tr>
			<tr>
				<td >(b) Reference number and date of approval of the arrangement if any, made or the disposal of trade waste and effluent and the name of the authority granting such approval</td>
				<td>'.strtoupper($ref_no_approval2).'</td>
			</tr>
			';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			<tr>
				<td>Signatures and Date</td>
				<td>
					<tr>
						<td>Signature of Occupier</td>
						<td>'.strtoupper($key_person).'<br/></td>				
					</tr>	
					<tr>
						<td width="60%">Date : </td>
						<td>'.date('d-m-Y',strtotime($results["sub_date"])).'</td>
					</tr>
					<tr>
						<td>Signature of Manager</td>
						<td>'.strtoupper($manager_name).'<br/></td>				
					</tr>	
					<tr>
						<td width="60%">Date : </td>
						<td>'.date('d-m-Y',strtotime($results["sub_date"])).'</td>	
					</tr>
				</table>
			</td>
		</tr>
	</table>';
?>  