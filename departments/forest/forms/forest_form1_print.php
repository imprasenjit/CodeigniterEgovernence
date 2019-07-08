<?php
$dept="forest";
$form="1";
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
		$fat_name=$results['fat_name'];
			
		if(!empty($results["fat_address"])){
			$fat_address=json_decode($results["fat_address"]);
			$fat_address_s1=$fat_address->s1;$fat_address_s2=$fat_address->s2;$fat_address_v=$fat_address->v;$fat_address_d=$fat_address->d;$fat_address_pin=$fat_address->pin;
		}else{
			$fat_address_s1="";$fat_address_s2="";$fat_address_v="";$fat_address_d="";$fat_address_pin="";
		}
		if(!empty($results["patt_details"])){
			$patt_details=json_decode($results["patt_details"]);
			$patt_details_dag_no=$patt_details->dag_no;$patt_details_mouza=$patt_details->mouza;$patt_details_patta_no=$patt_details->patta_no;$patt_details_rc=$patt_details->rc;$patt_details_area_plot=$patt_details->area_plot;$patt_details_nature=$patt_details->nature;$patt_details_year_patta=$patt_details->year_patta;
		}else{
			$patt_details_dag_no="";$patt_details_mouza="";$patt_details_patta_no="";$patt_details_rc="";$patt_details_area_plot="";$patt_details_nature="";$patt_details_year_patta="";
		}
		if(!empty($results["details_plantation"])){
			$details_plantation=json_decode($results["details_plantation"]);
			$details_plantation_area=$details_plantation->area;$details_plantation_avg_girth=$details_plantation->avg_girth;$details_plantation_avg_height=$details_plantation->avg_height;$details_plantation_bound_desc=$details_plantation->bound_desc;$details_plantation_year=$details_plantation->year;
		}else{
			$details_plantation_area="";$details_plantation_avg_girth="";$details_plantation_avg_height="";$details_plantation_bound_desc="";$details_plantation_year="";
		}
		if($patt_details_nature=='A') $patt_details_nature='ANNUAL';
		elseif($patt_details_nature=='P') $patt_details_nature='PERIODIC';
		else $patt_details_nature='SPECIAL GRANT';
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
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
	<div style="text-align:center">
  			'.$assamSarkarLogo.'<h3>'.$form_name.'</h3>
  	</div>
	<table class="table table-bordered table-responsive">
		<tr>				
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td colspan="2">To,<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Divisional Forest Officer<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($b_block).' Division,<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($b_dist).'<br/><br/>
					
					Sub:
					<strong><u>Request for Registration of Plantation raised on my/our non-forest land.</u></strong><br/><br/>
					Sir,<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We would request you to kindly register the plantation of trees raised on my/our Pattaland. The details of the land and plantation along with the required documents are furnished below
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td valign="top">1. Name and address of the Pattadar</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Name </td>
						<td>'.strtoupper($key_person).'</td>
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
						<td>Village/Town </td>
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
					<tr>
						<td>Mobile No</td>
						<td>'.strtoupper($mobile_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">2. Father&apos;s name and address</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Father&apos;s Name </td>
						<td>'.strtoupper($fat_name).'</td>
					</tr>
					<tr>
						<td>Street Name 1 </td>
						<td>'.strtoupper($fat_address_s1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 </td>
						<td>'.strtoupper($fat_address_s2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($fat_address_v).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($fat_address_d).'</td>
					</tr>
					<tr>
						<td>Pin Code </td>
						<td>'.strtoupper($fat_address_pin).'</td>
					</tr>									
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">3. Details of the Pattaland over which the plantation has been raised <br/><br/></td>
		</tr>
		<tr>
			<td colspan="2">					
				<table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">Dag No</td>
						<td>'.strtoupper($patt_details_dag_no).'</td>
					</tr>
					<tr>
						<td>Patta No</td>
						<td>'.strtoupper($patt_details_patta_no).'</td>
					</tr>
					<tr>
						<td>Mouza</td>
						<td>'.strtoupper($patt_details_mouza).'</td>
					</tr>
					<tr>
						<td>Revenue Circle</td>
						<td>'.strtoupper($patt_details_rc).'</td>
					</tr>
					<tr>
						<td>Area of Plot(in Bigha or Hect)</td>
						<td>'.strtoupper($patt_details_area_plot).'</td>
					</tr>
					<tr>
						<td>Year of issue of Patta</td>
						<td>'.strtoupper($patt_details_year_patta).'</td>
					</tr>
					<tr>
						<td>Nature of Patta(Annual/Periodic/Special grant)</td>
						<td>'.strtoupper($patt_details_nature).'</td>
					</tr>
				</table>				
			</td>
		</tr>
		<tr>
			<td colspan="2">4.Details of the Plantation</td>
		</tr>
		<tr>
			<td colspan="2"> 
				<table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">(a) Years of Creation</td>
						<td>'.strtoupper($details_plantation_year).'</td>
					</tr>
					<tr>
						<td>(b) Area</td>
						<td>'.strtoupper($details_plantation_area).'</td>
					</tr>
					<tr>
						<td colspan="2">(c) Species wise no. of trees planted</td>
					</tr>
					<tr>
						<td colspan="2">
							<table class="table table-bordered table-responsive">
							<thead>
								<tr>
									<th width="5%" height="35px" align="center">Sl. No.</th>
									<th width="25%" align="center">Name of the Species (Locale/Botanical)</th>
									<th width="20%" align="center">Approximate Spacing</th>
									<th width="20%" align="center">No. of trees planted</th>						
								</tr>
							</thead>';						
							$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
							if($part1->num_rows>0){
								while($row_1=$part1->fetch_array()){
									$printContents=$printContents.'
									<tr>
										<td>'.strtoupper($row_1["slno"]).'</td>
										<td>'.strtoupper($row_1["species"]).'</td>
										<td>'.strtoupper($row_1["spacing"]).'</td>
										<td>'.strtoupper($row_1["trees"]).'</td>									
									</tr>';
								}
							}
							
							$printContents=$printContents.'
							</table>
						</td>
					</tr>
					<tr>
						<td>(d) Average Height</td>
						<td>'.strtoupper($details_plantation_avg_height).'</td>
					</tr>
					<tr>
						<td>(e) Average girth</td>
						<td>'.strtoupper($details_plantation_avg_girth).'</td>
					</tr>
					<tr>
						<td>(f) Boundary description of the plantation area:</td>
						<td>'.strtoupper($details_plantation_bound_desc).'</td>
					</tr>
				</table>
			</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 		
					
		<tr>
			<td valign="top"><strong>Signature of the Pattadar with Date:</strong></td>				
			<td>Signature of the Pattadar : &nbsp;  <strong>'.strtoupper($key_person).'</strong><br/>					
				Date : &nbsp;<strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		</tr>	
	</table>
';
?>

