<?php
$dept="forest";
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
		$fat_name=$results['fat_name'];$is_registered=$results['is_registered'];$is_registered_regno=$results['is_registered_regno'];$no_trees=$results['no_trees'];$post_office=$results['post_office'];
		$other_tree=$results['other_tree'];
		
		if($other_tree=="Y"){
			$other_tree_value="YES";
		}else{
			$other_tree_value="NO";
		}
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
		if(!empty($results["replant"])){
			$replant=json_decode($results["replant"]);
			$replant_no_tree=$replant->no_tree;$replant_dag=$replant->dag;$replant_patta=$replant->patta;$replant_vill=$replant->vill;$replant_mouza=$replant->mouza;$replant_rev_circle=$replant->rev_circle;$replant_dist=$replant->dist;
		}else{
			$replant_no_tree="";$replant_dag="";$replant_patta="";$replant_vill="";$replant_mouza="";$replant_rev_circle="";$replant_dist="";
		}
		if(!empty($results["under_take"])){
			$under_take=json_decode($results["under_take"]);
			$under_take_person=$under_take->person;$under_take_s_o=$under_take->s_o;$under_take_vill=$under_take->vill;$under_take_mouza=$under_take->mouza;$under_take_ps=$under_take->ps;$under_take_dist=$under_take->dist;
		}else{
			$under_take_person="";$under_take_s_o="";$under_take_vill="";$under_take_mouza="";$under_take_ps="";$under_take_dist="";
		}		
		if($is_registered=='Y') $is_registered='YES';
		else $is_registered='NO';
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
		$printContents=$printContents.'<div style="text-align:center">
  			'.$assamSarkarLogo.'<h3>'.$form_name.'</h4>
  		</div>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tr>				
			<td colspan="2">
			To<br/><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Divisional Forest Officer<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($b_block).' Division,<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($b_dist).'<br/><br/>
			
			Sub:
			<strong><u>Permission for operation of trees under C.O.</u></strong><br/><br/>
			Sir,<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>I would request you to kindly accord me the necessary permission to operate the following trees existing in my pattaland. The necessary details of the land and trees along with the required documents are furnished below :</p>
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
						<td>Street Name2 </td>
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
					<tr>
						<td>Phone Number </td>
						<td>'.strtoupper($b_landline_std).' - '.strtoupper($b_landline_no).'</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>'.$email.'</td>
					</tr>
					<tr>
						<td>Post Office</td>
						<td>'.strtoupper($post_office).'</td>
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
								<td>Street Name2 </td>
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
						</table></td>
		</tr>
		<tr>
			<td colspan="2">3. Details of the Pattaland over which the plantation has been raised</td>
		</tr>		
		<tr>
			<td>Dag No</td>
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
		<tr>
			<td>4. Whether the Plantation is registered </td>
			<td>'.strtoupper($is_registered).'</td>
		</tr>
		<tr>
			<td>5. If yes give Registration Certificate number</td>
			<td>'.strtoupper($is_registered_regno).'</td>
		</tr>
		<tr>
			<td>6.(a) Whether any other tree except Aam (Mangifera indica), Jamun (Syzygium cumin), Kathal (Artocarpus integrifolia), Eucalyptus and all popular species of home grown bamboo, Leteku, Paniol and Madhuriam (Psidium guajava) are  standing over the pattalanad ? </td>
			<td>'.strtoupper($other_tree_value).'</td>
		</tr>
		<tr>
			<td colspan="2">6.(b) Details of trees standing over the Pattaland </td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">
				<thead>
					<tr>
						<th width="5%" height="35px" align="center">Tree Sl. No.</th>
						<th width="25%" align="center">Species</th>
						<th width="15%" align="center">Approximate height of the tree in m.</th>
						<th width="20%" align="center">Remarks, if any. </th>
						
					</tr>
				</thead>';						
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					if($part1->num_rows>0){
						while($row_1=$part1->fetch_array()){
							$printContents=$printContents.'
							<tr>
									<td>'.strtoupper($row_1["slno"]).'</td>
									<td>'.strtoupper($row_1["species"]).'</td>
									<td>'.strtoupper($row_1["height"]).'</td>
									<td>'.strtoupper($row_1["remarks"]).'</td>								
							</tr>';
						}
					}
					
					$printContents=$printContents.'
				</table>
			</td>					
		</tr>
		<tr>
			<td>7.No. of trees required to be operated :</td>
			<td>'.strtoupper($no_trees).'</td>
		</tr>
		<tr>
			<td colspan="2">8. Replanting details : </td>
		</tr>
		<tr>
			<td colspan="2">(1) I/ we will replant '.strtoupper($replant_no_tree).' nos. of trees in the plot bearing Dag No. '.strtoupper($replant_dag).' Patta No. '.strtoupper($replant_patta).', Village '.strtoupper($replant_vill).' Mouza '.strtoupper($replant_mouza).' Revenue Circle '.strtoupper($replant_rev_circle).' District '.strtoupper($replant_dist).'.<br/>
			(2) I/ we do not possess area required for replanting and agreed to deposit amount as per CAMPA norms for taking replantation.</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><b><u>Undertaking by the Pattadar / Owner.</u></b></td>
		</tr>
		<tr>
			<td colspan="2">I/We, Sri  '.strtoupper($under_take_person).' S/o '.strtoupper($under_take_s_o).' of '.strtoupper($unit_name).' vill '.strtoupper($under_take_vill).' Mouza '.strtoupper($under_take_mouza).' P.S. '.strtoupper($under_take_ps).' District '.strtoupper($under_take_dist).' state that the information furnished above are correct.</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
						
		<tr>
			<td valign="top"><strong>Signature of the Pattadar with Date:</strong></td>				
			<td>Signature of the Pattadar : &nbsp;  <strong>'.strtoupper($key_person).'</strong><br/>					
				Date : &nbsp;<strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		</tr>		
	</table>';
?>