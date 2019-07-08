<?php
$dept="labour";
$form="12";
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
		

	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$motor_trns_name=$results['motor_trns_name'];$nature=$results['nature'];$tot_no=$results['tot_no'];$tot_route=$results['tot_route'];$tot_n_motor=$results['tot_n_motor'];$max_workers=$results['max_workers'];$gm_name=$results['gm_name'];$director_name=$results['director_name'];
			
		if(!empty($results["mt_address"])){
			$mt_address=json_decode($results["mt_address"]);
			$mt_address_sn1=$mt_address->sn1;$mt_address_sn2=$mt_address->sn2;$mt_address_vill=$mt_address->vill;$mt_address_dist=$mt_address->dist;$mt_address_pin=$mt_address->pin;$mt_address_mob=$mt_address->mob;$mt_address_email=$mt_address->email;
		}else{
			$mt_address_name="";$mt_address_sn1="";$mt_address_sn2="";$mt_address_vill="";$mt_address_dist="";$mt_address_pin="";$mt_address_mob="";$mt_address_email="";
		}		
		if(!empty($results["gm_address"])){
			$gm_address=json_decode($results["gm_address"]);
			$gm_address_sn1=$gm_address->sn1;$gm_address_sn2=$gm_address->sn2;$gm_address_vill=$gm_address->vill;$gm_address_dist=$gm_address->dist;$gm_address_pin=$gm_address->pin;
		}else{
			$gm_address_sn1="";$gm_address_sn2="";$gm_address_vill="";$gm_address_dist="";$gm_address_pin="";
		}
		if(!empty($results["director_address"])){
			$director_address=json_decode($results["director_address"]);
			$director_address_sn1=$director_address->sn1;$director_address_sn2=$director_address->sn2;$director_address_vill=$director_address->vill;$director_address_dist=$director_address->dist;$director_address_pin=$director_address->pin;
		}else{
			$director_address_sn1="";$director_address_sn2="";$director_address_vill="";$director_address_dist="";$director_address_pin="";
		}
	}
	
    $form_name=$formFunctions->get_formName($dept,$form);    
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form '.$form.'</title>
<style>
input, textarea { 
  text-transform: uppercase;
}
.header{
  width: 100%;
  height: 130px;
  font-weight: bold;
}
.main_body {
  height: 700px;
  width: 100%;
}
#form1 table {
  vertical-align: middle;
}
table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
</head>
<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
<div style="text-align:center">
		'.$assamSarkarLogo.'<h4>'.$form_name.'</h4><br/>
</div> 
<table class="table table-bordered table-responsive">
	<tr>
		<td width="50%">1. Name of motor transport undertaking.</td>
		<td>'.strtoupper($motor_trns_name).'</td>
	</tr>
	<tr>
		<td>2. Full address to which communications relating to the motor transport undertaking should be sent.</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($mt_address_sn1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($mt_address_sn2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($mt_address_vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($mt_address_dist).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($mt_address_pin).'</td>
				</tr>
				<tr>
						<td>Mobile</td>
						<td>+91&nbsp;'.strtoupper($mt_address_mob).'</td>
				</tr>
				<tr>
						<td>E-mail ID</td>
						<td>'.$mt_address_email.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>3. Nature of motor transport service, e.g., City Service, long distance passenger service, long distance freight service. </td>
		<td>'.strtoupper($nature).'</td>
	</tr>
	<tr>
		<td>4. Total number of routes.</td>
		<td>'.strtoupper($tot_no).'</td>
	</tr> 
	<tr>
		<td>5. Total route mileage.</td>
		<td>'.strtoupper($tot_route).'</td>
	</tr>
	<tr>
		<td>6. Total number of motor transport vehicles on the last date of the preceding year.</td>
		<td>'.strtoupper($tot_n_motor).'</td>
	</tr>
	<tr>
		<td>7. Maximum number of motor transport workers directored on any day during the preceding year.</td>
		<td>'.strtoupper($max_workers).'</td>
	</tr>
	<tr>
		<td colspan="2">8. Full names and residential address</td>
	</tr>
	<tr>
		<td colspan="2">(i) Proprietor and partners of the motor transport undertaking in case of a firm not registered under the Companies Act, 1956;</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<th width="10%">Sl. No.</th>
					<th width="20%">Partners/Directors Name</th>
					<th width="10%">Street Name 1</th>
					<th width="10%">Street Name 2</th>
					<th width="10%">Village/Town</th>
					<th width="10%">District</th>
					<th width="10%">Pincode</th>
				</tr>';
				$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$labour->error);
				$sl=1;
				while($rows=$results1->fetch_object()){
					$printContents=$printContents.'
					<tr>
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->name).'</td>
						<td>'.strtoupper($rows->sn1).'</td>
						<td>'.strtoupper($rows->sn2).'</td>
						<td>'.strtoupper($rows->v).'</td>
						<td>'.strtoupper($rows->d).'</td>
						<td>'.strtoupper($rows->p).'</td>
					</tr>';
					$sl++;
				}
				$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td>(ii) General manager in case of a public sector undertaking.</td>
		<td><table class="table table-bordered table-responsive">
			<tr>
					<td>Full Name</td>
					<td>'.strtoupper($gm_name).'</td>
			</tr>
			<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($gm_address_sn1).'</td>
			</tr>
			<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($gm_address_sn2).'</td>
			</tr>
			<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($gm_address_vill).'</td>
			</tr>
			<tr>
					<td>District</td>
					<td>'.strtoupper($gm_address_dist).'</td>
			</tr>
			<tr>
					<td>Pincode</td>
					<td>'.strtoupper($gm_address_pin).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>9. Full name and residential addresses of the Directors in the case of a company registered under the Companies Act, 1956.</td>
		<td><table class="table table-bordered table-responsive">
			<tr>
					<td>Full Name</td>
					<td>'.strtoupper($director_name).'</td>
			</tr>
			<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($director_address_sn1).'</td>
			</tr>
			<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($director_address_sn2).'</td>
			</tr>
			<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($director_address_vill).'</td>
			</tr>
			<tr>
					<td>District</td>
					<td>'.strtoupper($director_address_dist).'</td>
			</tr>
			<tr>
					<td>Pincode</td>
					<td>'.strtoupper($director_address_pin).'</td>
			</tr>
		</table>
		</td>
	</tr>';

	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.' 
	
			<tr>
				<td>Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
				<td>Signature of the employer: '.strtoupper($key_person).' </td>
			</tr>
			
</table>';
?>