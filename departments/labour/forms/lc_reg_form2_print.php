<?php
$dept="labour";
$form="2";
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
		$nature_work=$results["nature_work"];$father_name=$results["father_name"];  $max_workers=$results["max_workers"];$nature_w_emp=$results["nature_w_emp"];        
		if(!empty($results["manager"])){
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_pin=$manager->pin;            
		}else{
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
		}   
    }
    $nature_work = wordwrap($results["nature_work"], 40, "<br/>", true);
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
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div><br/>
<table class="table table-bordered table-responsive">
	<tr>
		<td width="50%"> 1.(a) Name of the Establishment</td>
		<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>
		<td>(b) Location of the Establishment </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Street Name 1 </td>
					<td>'.strtoupper($b_street_name1).'</td>
				</tr>
				<tr>
					<td>Street Name 2 </td>
					<td>'.strtoupper($b_street_name2).'</td>
				</tr>
				<tr>
					<td>Vilage/Town </td>
					<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($b_dist).'</td>
				</tr>
				<tr>
					<td>Pin Code </td>
					<td>'.strtoupper($b_pincode).'</td>
				</tr>
			</table>
		</td>
	</tr>    
	<tr>
		<td>2. Postal address of the Establishment(Alternate Address) </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Street Name 1 </td>
					<td>'.strtoupper($street_name1).'</td>
				</tr>
				<tr>
					<td>Street Name 2 </td>
					<td>'.strtoupper($street_name2).'</td>
				</tr>
				<tr>
					<td>Vilage/Town </td>
					<td>'.strtoupper($vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($dist).'</td>
				</tr>
				<tr>
					<td>Pin Code </td>
					<td>'.strtoupper($pincode).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>3. Full name and address of the Principal Employer (furnish father&apos;s name in the case of individuals). </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Father&apos;s Name </td>
					<td>'.strtoupper($father_name).'</td>
				</tr>
				<tr>
					<td>Street Name 1 </td>
					<td>'.strtoupper($street_name1).'</td>
				</tr>
				<tr>
					<td>Street Name 2 </td>
					<td>'.strtoupper($street_name2).'</td>
				</tr>
				<tr>
					<td>Vilage/Town </td>
					<td>'.strtoupper($vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($dist).'</td>
				</tr>
				<tr>
                    <td>Pin Code </td>
					<td>'.strtoupper($pincode).'</td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td>4.	Full name and address of the Manager or person responsible for the supervision and Control of the establishment. </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Full Name</td>
					<td>'.strtoupper($manager_name).'</td>
				</tr>
				<tr>
					<td>Street Name 1 </td>
				   <td>'.strtoupper($manager_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2 </td>
					<td>'.strtoupper($manager_sn2).'</td>
				</tr>
				<tr>
					<td>Vilage/Town </td>
					<td>'.strtoupper($manager_v).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($manager_d).'</td>
				</tr>
				<tr>
					<td>Pin Code </td>
					<td>'.strtoupper($manager_pin).'</td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr>
		<td>5. Nature of work carried on in the Establishment. </td>
		<td>'.strtoupper($nature_work).'</td>
	</tr>
	 <tr>
		<td>6. Nature of work in which contract labour is employed or is to be employed. </td>
		<td>'.strtoupper($nature_w_emp).'</td>
	</tr>
	 <tr>
		<td>7. Maximum no. of Contract Labour to be employed in the Establishment on any day (through all the contractors).</td>
		<td>'.strtoupper($max_workers).'</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
        		    
	<tr>
		<td>Signature of Principal Employment  :</td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td>Date : </td>
		<td> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
	</tr> 
 </table>';
?>