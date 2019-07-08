<?php
$dept="gmc";
$form="15";
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
		$form_id=$results["form_id"];$house_number=$results["house_number"];$situ_road=$results["situ_road"];$of=$results["of"];$area_ward=$results["area_ward"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$rev_village=$results["rev_village"];$mouza=$results["mouza"];$signed=$results["signed"];$regis_no=$results["regis_no"];$no_floors=$results["no_floors"];

		  if(!empty($results["provision"])){
				$provision=json_decode($results["provision"]);
				if(isset($provision->a)) $provision_a=$provision->a; else $provision_a="";
				if(isset($provision->b)) $provision_b=$provision->b; else $provision_b="";
			}else{
				$provision_a="";$provision_b="";
				 
			}
			
	  $provision_values="";		
		if($provision_a=="V") $provision_values=$provision_values. '<span class="tickmark">&#10004;</span>Vertical extension';
		if($provision_b=="H") $provision_values=$provision_values. '<span class="tickmark">&#10004;</span>Horizontal extension';
		
			if(!empty($results["total"])){
				$total=json_decode($results["total"]);
				$total_plot=$total->plot;$total_north=$total->north;$total_south=$total->south;$total_east=$total->east;$total_west=$total->west;
			}else{
				$total_plot="";$total_north="";$total_south="";$total_east="";$total_west="";
			}
			
			if(!empty($results["appli"])){
				$appli=json_decode($results["appli"]);
                if(isset($appli->nm)) $appli_nm=$appli->nm; else $appli_nm="";
                if(isset($appli->father)) $appli_father=$appli->father; else $appli_father="";
                if(isset($appli->mother)) $appli_mother=$appli->mother; else $appli_mother="";
                if(isset($appli->address)) $appli_address=$appli->address; else $appli_address="";
                if(isset($appli->mob)) $appli_mob=$appli->mob; else $appli_mob="";
                if(isset($appli->pan)) $appli_pan=$appli->pan; else $appli_pan="";
                if(isset($appli->sign)) $appli_sign=$appli->sign; else $appli_sign="";
				
			}else{
				$appli_nm="";$appli_father="";$appli_mother="";$appli_address="";$appli_mob="";$appli_pan="";$appli_sign="";
			}
		/*	if($build_use=="S"){
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
			}*/
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
				<td colspan="2">To,<br/>
				The Commissioner,<br/>Guwahati Municipal Corporation,<br/>Panbazar, Guwahati.</td>
			</tr>
			<tr>
				<td colspan="2">Sir,<br/>I/We hereby give notice that I intend to erect/re-erect or to make alteration in the House No&nbsp;&nbsp;'.strtoupper($house_number).'&nbsp;&nbsp;situated at Road &nbsp;&nbsp;'.strtoupper($situ_road).'&nbsp;&nbsp;of &nbsp;&nbsp;'.strtoupper($of).'&nbsp;&nbsp; area of Ward No'.strtoupper($area_ward).'&nbsp;&nbsp;&nbsp;&nbsp;in Dag No&nbsp;&nbsp;'.strtoupper($dag_no).'&nbsp;&nbsp;Patta No&nbsp;&nbsp;'.strtoupper($patta_no).'&nbsp;&nbsp;of Revenue Village&nbsp;&nbsp;'.strtoupper($rev_village).'&nbsp;&nbsp;Mouza&nbsp;&nbsp;'.strtoupper($mouza).'&nbsp;&nbsp;and in accordance with the Building Byelaws of Guwahati and I forward herewith, the following plans and specifications duly signed by me and &nbsp;&nbsp;'.strtoupper($signed).'&nbsp;&nbsp;(Name in block letters)of the Registered Technical Personal, Registration No.&nbsp;&nbsp;'.strtoupper($regis_no).'&nbsp;&nbsp;who have prepared the plans, statements/documents.</td>
			</tr>
			 <tr>
				<td colspan="2">The schedule of the land is also given below :</td>
			 </tr>
			<tr>
				<td>(a) Total plot area :</td>
				<td>'.strtoupper($total_plot).'</td>
			</tr>
		 <tr>
			<td valign="top"> (b) Name of owners of adjoining land : </td>
			<td>
			 <table class="table table-bordered table-responsive">
			
				<tr>
					<td width="50%">North :</td>
					<td>'.strtoupper($total_north).'</td>
				</tr>
				<tr>
					<td>South :</td>
					<td>'.strtoupper($total_south).'</td>
				</tr>
				<tr>
					<td>East :</td>
					<td>'.strtoupper($total_east).'</td>
				</tr>
				<tr>
					<td>West :</td>
					<td>'.strtoupper($total_west).'</td>
				</tr>
				
			  </table>
			 </td>
			</tr>
			<tr>
				<td>(c) Is there any future provision for</td>
			    <td>'.strtoupper($provision_values).'</td>
			</tr>
			<tr>
				<td>(iii) If yes No. of floors</td>
				<td>'.strtoupper($no_floors).'</td>
			</tr>
            <tr>
				<td>Name of the Applicant (in block letters):</td>
				<td>'.strtoupper($appli_nm).'</td>
			</tr>
			<tr>
				<td>Father/Husband Name :</td>
				<td>'.strtoupper($appli_father).'</td>
			</tr>
            <tr>			
				<td>Mother Name :</td>
				<td>'.strtoupper($appli_mother).'</td>
			</tr>
			<tr>			
				<td>Postal Address of Applicant </td>
				<td>'.strtoupper($appli_address).'</td>
			</tr>
			<tr>			
				<td>Phone No / Mobile No </td>
				<td>'.strtoupper($appli_mob).'</td>
			</tr>
			<tr>			
				<td>PAN No.</td>
				<td>'.strtoupper($appli_pan).'</td>
			</tr>
			<tr>
				<td colspan="4">I request that the construction may be approved and permission accorded to me to execute the work. I hereby also declare that contents of the above application and the enclosures are true and correct to my/our knowledge. No part of it is false and nothing has been concealed there from.</td>
			</tr>
			
			';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
			
			  
				  
					 
							<tr>
							    <td>Signature of the Applicant : '.strtoupper($appli_sign).'</td>
								<td align="right">  Date : '.date('d-m-Y',strtotime($results["sub_date"])).' </td>
							</tr>
																			
						
			
		</tbody>
	</table>';
?>