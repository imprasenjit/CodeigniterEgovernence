<?php
$dept="factory";
$form="4";
$table_name=getTableName($dept,$form);	
 if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");		
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	}
	
	
	$occupier_name=$key_person;$occupier_sn1=$street_name1;$occupier_sn2=$street_name2;$occupier_vill=$vill;$occupier_dist=$dist;$occupier_pin=$pincode;
	
	$results=$q->fetch_assoc();
	if($q->num_rows>0)////////for empty/////
	{	
		$form_id=$results['form_id'];$license_no=$results['license_no'];
		$cah=$results['cah'];
		$managing_agents=$results['managing_agents'];
		
		$risk_category=$results['risk_category'];
		$risk_category_results=$formFunctions->executeQuery("dicc","SELECT businesstype FROM inspection_category WHERE deptcode ='factory' and id='$risk_category'");
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
			$power_value=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["power"]));
			$power_nature=$power_value->nature;$power_p=$power_value->p;$power_mp=$power_value->mp;
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
		if(!empty($results["occupier"])){
			$occupier=json_decode($results["occupier"]);
			$occupier_name=$occupier->name;$occupier_sn1=$occupier->sn1;$occupier_sn2=$occupier->sn2;$occupier_vill=$occupier->vill;$occupier_dist=$occupier->dist;$occupier_pin=$occupier->pin;
			
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
			<p  style="text-align:center">(Prescribed under Rule 3)</p>
  			<h4>'.$form_name.'</h4>
		</div><br/>
			<table class="table table-bordered table-responsive">				
			<tr>				
				<td>1. Full name of the Factory (with factory licence number if already registered before):</td>
				<td>
					<table>
                        <tr>
							<td width="50%">Name of the Factory</td>
							<td>'.strtoupper($unit_name).'</td>
						</tr>
						<tr>
							<td>License Number</td>
							<td>'.strtoupper($license_no).'</td>
						</tr>
						<tr>
							<td>Legal Entity</td>
							<td>'.strtoupper($legal_entity).'</td>
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
				<td colspan="2">3. Nature of manufacturing process or processes</td>
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
				<td>Name : '.strtoupper($occupier_name).'<br/>Street Name 1 : '.strtoupper($occupier_sn1).'<br/>Street Name 2 : '.strtoupper($occupier_sn2).'<br/>Village/Town : '.strtoupper($occupier_vill).'<br/>District : '.strtoupper($occupier_dist).'<br/>Pincode : '.strtoupper($occupier_pin).'</td>
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
				<table>
					<tr>
						<td>Signature of Occupier</td>
						<td>'.strtoupper($occupier_name).'<br/></td>				
					</tr>	
					<tr>
						<td>Date : </td>
						<td>'.date('d-m-Y',strtotime($results["sub_date"])).'</td>
					</tr>
					<tr>
						<td>Signature of Manager</td>
						<td>'.strtoupper($manager_name).'<br/></td>				
					</tr>	
					<tr>
						<td>Date : </td>
						<td>'.date('d-m-Y',strtotime($results["sub_date"])).'</td>	
					</tr>
				</table>
			</td>
		</tr>
	</table>';
?>  