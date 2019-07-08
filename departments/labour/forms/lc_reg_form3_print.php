<?php
$dept="labour";
$form="3";
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
		$form_id=$results["form_id"];$father_name=$results["father_name"];$nature_work=$results["nature_work"];$max_workers=$results["max_workers"];
				
		if(!empty($results["manager"])){				
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_p=$manager->p;				
		}else{
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
		}	
		if(!empty($results["contractor"])){				
			$contractor=json_decode($results["contractor"]);
			$contractor_nwm=$contractor->nwm;$contractor_d=$contractor->d;$contractor_d2=$contractor->d2;				
		}else{
			$contractor_nwm="";$contractor_d="";$contractor_d2="";
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
</div>  <br/>
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
		<td>2. Postal address of factory</td>
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
		<td>3. Full name and address of the Principal Employer (furnish father&apos;s name in the case of individuals).</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Full Name </td>
					<td>'.strtoupper($key_person).'</td>
				</tr>
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
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr><td colspan="7" height="40px">4. Names and address of the Directors/particular Partners (in case of companies and firms).</td></tr>
					<tr><td width="100px">Sl No.</td>
						<td>Full Name</td>
						<td>Street Name 1</td>
						<td>Street Name 2</td>
						<td>Town/Vill</td>
						<td>District</td>
						<td>Pin Code</td>
					</tr>
			</thead>
		<tbody>';
		$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
		while($row_1=$part1->fetch_array()){
		$printContents=$printContents.'
			<tr>
				<td>'.strtoupper($row_1["field1"]).'</td>
				<td>'.strtoupper($row_1["field2"]).'</td>
				<td>'.strtoupper($row_1["field3"]).'</td>
				<td>'.strtoupper($row_1["field4"]).'</td>
				<td>'.strtoupper($row_1["field5"]).'</td>
				<td>'.strtoupper($row_1["field6"]).'</td>
				<td>'.strtoupper($row_1["field7"]).'</td>
				</tr>';
		}
		$printContents=$printContents.'
		</tbody>
		</table>
		</td>					  
	</tr>
	<tr>
		<td>5.	Full name and address of the Manager or person responsible for the supervision and Control of the establishment.</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Full Name </td>
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
					<td>'.strtoupper($manager_p).'</td>
		
				</tr>  
			</table>
		</td>
	</tr>  		
	<tr>
		<td>6. Nature of work. </td>
		<td>'.strtoupper($nature_work).'</td>
	</tr>
	<tr>
		<td colspan="2">7.	Particulars of Contractors and migrant workman  </td>
	</tr> 		
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr><td colspan="7" height="40px">(a)	Names and addresses of Contractors. </td></tr>
				<tr><td width="100px">Sl No.</td>
					<td>Full Name</td>
					<td>Street Name 1</td>
					<td>Street Name 2</td>
					<td>Town/Vill</td>
					<td>District</td>
					<td>Pin Code</td>
				</tr>
			</thead>
		<tbody>';

		$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
		while($row_2=$part2->fetch_array()){
		$printContents=$printContents.'
			<tr>
				<td>'.strtoupper($row_2["field1"]).'</td>
				<td>'.strtoupper($row_2["field2"]).'</td>
				<td>'.strtoupper($row_2["field3"]).'</td>
				<td>'.strtoupper($row_2["field4"]).'</td>
				<td>'.strtoupper($row_2["field5"]).'</td>
				<td>'.strtoupper($row_2["field6"]).'</td>
				<td>'.strtoupper($row_2["field7"]).'</td>
				</tr>';
		}
		$printContents=$printContents.'
		</tbody>
		</table>			
		</td>
	</tr>
	 <tr>
		<td>(b) Nature of work for which migrant workmen are to be recruited or are employed.</td>
		<td>'.strtoupper($contractor_nwm).'</td>
	</tr> 
	<tr>
		<td>(c) Maximum number of migrant workmen to be employed on and day through each Contractor.</td>
		<td>'.strtoupper($max_workers).'</td>
	</tr> 
	<tr>
		<td>(d) Date of commencement of work under each Contractor. </td>
		<td>'.strtoupper($contractor_d).'</td>
	</tr> 
	<tr>
		<td>(e) Estimated date of termination of employment of migrant 	workmen under each Contractor.</td>
		<td>'.strtoupper($contractor_d2).'</td>
	</tr>';

	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'
	
	<tr>
	
		<td>Signature of Principal Employment  :</td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td>Date : </td>
		<td> '.strtoupper($results["sub_date"]).'</td>
	</tr> 
</table>';
?>