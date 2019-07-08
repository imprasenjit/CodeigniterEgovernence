<?php
$dept="gmc";
$form="6";
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
	
		
		if($q->num_rows > 0){
			$results=$q->fetch_array();
			$form_id=$results["form_id"];$father_name=$results["father_name"];$road_name=$results["road_name"];$cons_year=$results["cons_year"];$w_pipe=$results["w_pipe"];$build_use=$results["build_use"];$l_area=$results["l_area"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$l_vill=$results["l_vill"];$mouza=$results["mouza"];$hold_no=$results["hold_no"];$old_arv=$results["old_arv"];$b_owner_name=$results["b_owner_name"];
			if(!empty($results["plinth"])){
				$plinth=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["plinth"]));
                if(isset($plinth->base)) $plinth_base=$plinth->base; else $plinth_base="";
                if(isset($plinth->muzzl)) $plinth_muzzl=$plinth->muzzl; else $plinth_muzzl="";
                if(isset($plinth->ground)) $plinth_ground=$plinth->ground; else $plinth_ground="";
                if(isset($plinth->first)) $plinth_first=$plinth->first; else $plinth_first="";
                if(isset($plinth->sec)) $plinth_sec=$plinth->sec; else $plinth_sec="";
                if(isset($plinth->third)) $plinth_third=$plinth->third; else $plinth_third="";
                if(isset($plinth->forth)) $plinth_forth=$plinth->forth; else $plinth_forth="";
                if(isset($plinth->fifth)) $plinth_fifth=$plinth->fifth; else $plinth_fifth="";
				
			}else{
				$plinth_base="";$plinth_muzzl="";$plinth_ground="";$plinth_first="";$plinth_sec="";$plinth_third="";$plinth_forth="";$plinth_fifth="";
			}
			if($build_use=="S"){
				$build_use="Self used Residence";
			}elseif($build_use=="R"){
				$build_use="Rented for residence";
			}elseif($build_use="C"){
				$build_use="Commercial use";
			}
			if($w_pipe=="Y"){
				$w_pipe="YES";
			}elseif($w_pipe=="N"){
				$$w_pipe="NO";
			}
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
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h2 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h2>
		<br/>
		<table class="table table-bordered table-responsive">
		<tbody>	
			<tr>
				<td>1. Name of the owners</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td>2. Father&apos;/ Husband&apos;s name</td>
				<td>'.strtoupper($father_name).'</td>
			</tr>
			<tr>
				<td>3.(a) Ward No.</td>
				<td>'.strtoupper($gmc_zone).'</td>
			</tr>
			<tr>
				<td>(b) House No.(If any)</td>
				<td>'.strtoupper($b_street_name1).'</td>
			</tr>
			<tr>
				<td>4. Name of the road</td>
				<td>'.strtoupper($road_name).'</td>
			</tr>
			<tr>
				<td valign="top">5. Plinth area of the building, (Floor wise area in case of multi storied buildings) </td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td width="50%">i. Basement Floor</td>
							<td>'.strtoupper($plinth_base).'</td>
						</tr>
						<tr>
							<td>ii. Muzzling Floor</td>
							<td>'.strtoupper($plinth_muzzl).'</td>
						</tr>
						<tr>
							<td>iii. Ground Floor</td>
							<td>'.strtoupper($plinth_ground).'</td>
						</tr>
						<tr>
							<td>iv. First Floor</td>
							<td>'.strtoupper($plinth_first).'</td>
						</tr>
						<tr>
							<td>v. 2 nd Floor</td>
							<td>'.strtoupper($plinth_sec).'</td>
						</tr>
						<tr>
							<td>vi. 3 rd Floor</td>
							<td>'.strtoupper($plinth_third).'</td>
						</tr>
						<tr>
							<td>vii. 4 Th Floor</td>
							<td>'.strtoupper($plinth_forth).'</td>
						</tr>
						<tr>
							<td>viii. 5 Th Floor</td>
							<td>'.strtoupper($plinth_fifth).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>6. Year of Construction</td>
				<td>'.$cons_year.'</td>
			</tr>
			<tr>
				<td>7.Water Pipe Connection</td>
				<td>'.strtoupper($w_pipe).'</td>
			</tr>
			<tr>
				<td>8. Use of the building</td>
				<td>'.strtoupper($build_use).'</td>
			</tr>
			<tr>
				<td>9. Area of Land</td>
				<td>'.strtoupper($l_area).'</td>
			</tr>
			<tr>
				<td>Dag No.</td>
				<td>'.strtoupper($dag_no).'</td>
			</tr>
			<tr>
				<td>Patta No.</td>
				<td>'.strtoupper($patta_no).'</td>
			</tr>
			<tr>
				<td>Village</td>
				<td>'.strtoupper($l_vill).'</td>
			</tr>
			<tr>
				<td>Mouza</td>
				<td>'.strtoupper($mouza).'</td>
			</tr>
			
			<tr>
				<td valign="top">10. No. Of Holdings if any</td>
				<td>(a) Holding No. :  '.strtoupper($hold_no).' <br/>
					(b) Old A.R.V.  :  '.strtoupper($old_arv).' <br/>
					(c) Name of the Owner of the Holding : '.strtoupper($b_owner_name).'
				</td>
			</tr>

			<tr>
				<td colspan="2">I, '.strtoupper($key_person).' submitting the above information to the Corporation,as required under section 163 of the Guwahati Municipal Corporation Act. 1969 and I certify that above particulars furnished by me is true to the best of my knowledge and belief.</td>
			</tr>';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
			
			<tr>
				<td style="width:40%" valign="top">        Signatures and Dates :           </td>
				<td style="width:60%">
					<table class="table table-bordered table-responsive">
						<tbody>
							<tr>
								<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).' </td>
								<td></td>
							</tr>
							<tr>
								<td>Signature of the Owner of the Holdings: </td>
								<td>'.strtoupper($key_person).'</td>
							</tr>	
							<tr>
								<td>Contact No:</td>
								<td>'.$mobile_no.'</td>
							</tr>												
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>';
?>