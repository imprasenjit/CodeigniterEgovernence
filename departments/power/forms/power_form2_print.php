<?php
$dept="power";
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
		$form_id=$results["form_id"];
		$b_str_name1=$results["b_str_name1"];$b_str_name2=$results["b_str_name2"];$applicant_name=$results["applicant_name"];$str_name1=$results["str_name1"];$str_name2=$results["str_name2"];
		$organization_name=$results["organization_name"];
		$contact_no=$results["contact_no"];
		$appli_email=$results["appli_email"];$appli_postofice=$results["appli_postofice"];$premises_postofc=$results["premises_postofc"];
		$situated_area=$results["situated_area"];$constructed_land=$results["constructed_land"];$height_tower=$results["height_tower"];$is_dedicated=$results["is_dedicated"];$dedicated_details=$results["dedicated_details"];$is_owner=$results["is_owner"];$is_co_owner=$results["is_co_owner"];$is_lease=$results["is_lease"];$is_legal=$results["is_legal"];$is_electricity=$results["is_electricity"];$details_electricity=$results["details_electricity"];
		
		if(!empty($results["billing"])){
			$billing=json_decode($results["billing"]);
			$billing_sn1=$billing->sn1;$billing_sn2=$billing->sn2;$billing_town=$billing->town;$billing_d=$billing->d;$billing_pin=$billing->pin;$billing_mobile=$billing->mobile;
		}else{
			$billing_sn1="";$billing_sn2="";$billing_town="";$billing_po="";$billing_d="";$billing_pin="";$billing_mobile="";
		}
		
			
	$permanent_disconnection=$results["permanent_disconnection"];	
	if(!empty($results["permanent_disconnection"])){
		$permanent_disconnection=json_decode($results["permanent_disconnection"]);
		$permanent_disconnection_a=$permanent_disconnection->a;$permanent_disconnection_b=$permanent_disconnection->b;
		$permanent_disconnection=$permanent_disconnection_a." <br/> ".$permanent_disconnection_b;
	}else{
		$permanent_disconnection="";
	}
	if($permanent_disconnection==""){
		$permanent_disconnection="N/A";
	}	
			
		
		if(!empty($results["contract_demand"])){
			$contract_demand=json_decode($results["contract_demand"]);
			$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
		}else{
			$contract_demand_num="";$contract_demand_unit="";
		}
		
		//TAB2//
		$is_connection=$results["is_connection"];$details_connection=$results["details_connection"];$esd=$results["esd"];$approx_distance=$results["approx_distance"];$proposed_distance=$results["proposed_distance"];$road_crossing=$results["road_crossing"];$nos_road=$results["nos_road"];$is_road_crossing=$results["is_road_crossing"];$details_crossing=$results["details_crossing"];
		
		if($is_owner=="Y"){
	  $is_owner="YES";
	  }else if($is_owner=="N"){
		$is_owner="NO";
	  }else{
		 $is_owner="";
	  }
	  
	  if($is_co_owner=="Y"){
	  $is_co_owner="YES";
	  }else if($is_co_owner=="N"){
		$is_co_owner="NO";
	  }else{
		 $is_co_owner="";
	  }
	  
	  if($is_lease=="Y"){
	  $is_lease="YES";
	  }else if($is_lease=="N"){
		$is_lease="NO";
	  }else{
		 $is_lease="";
	  }
	  
	  if($is_legal=="Y"){
	  $is_legal="YES";
	  }else if($is_legal=="N"){
		$is_legal="NO";
	  }else{
		 $is_legal="";
	  }
	  
	  if($is_electricity=="Y"){
	  $is_electricity="YES";
	  }else if($is_electricity=="N"){
		$is_electricity="NO";
	  }else{
		 $is_electricity="";
	  }
	  
	  if($is_connection=="Y"){
	  $is_connection="YES";
	  }else if($is_connection=="N"){
		$is_connection="NO";
	  }else{
		 $is_connection="";
	  }
	  
	  if($is_road_crossing=="Y"){
	  $is_road_crossing="YES";
	  }else if($is_road_crossing=="N"){
		$is_road_crossing="NO";
	  }else{
		 $is_road_crossing="";
	  }
	  
	  if($is_dedicated=="Y"){
	  $is_dedicated="YES";
	  }else if($is_dedicated=="N"){
		$is_dedicated="NO";
	  }else{
		 $is_dedicated="";
	  }
	  
	  if($road_crossing=="Y"){
	  $road_crossing="YES";
	  }else if($road_crossing=="N"){
		$road_crossing="NO";
	  }else{
		 $road_crossing="";
	  }
		
	}
					
$form_name=$formFunctions->get_formName($dept,$form);
//$dept_name=$formFunctions->get_deptName($dept);
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
			table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}
		</style>
	</head>
	<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<div style="text-align:center"><br/><br/>
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div><br/>
	<table class="table table-bordered table-responsive">
        <tr>
			<td width="50%">1.Name of the applicant (In block letter)</td>
			<td width="50%">'.strtoupper($applicant_name).'</td>
		</tr>
		<tr>
			<td>2.Name of the organization (with designation of the applicant)</td>
			<td>'.strtoupper($organization_name).'</td>
		</tr>
       <tr>
			<td>3. Contact no</td>
			<td>'.strtoupper($contact_no).'</td>
		</tr>
		<tr>
			<td>4. Email ID</td>
			<td>'.$appli_email.'</td>
		</tr>
        <tr>
			<td colspan="2">5. Address for correspondence and sending bills </td>
		</tr>
		<tr>
		   <td><strong>Address of the Applicant </strong></td>
		   <td>
    	   <table class="table table-bordered table-responsive">
				<tr>
					<td>House No/ Plot No. </td>
					<td>'.strtoupper($street_name1).'</td>
				</tr>
				<tr>
					<td>Road </td>
					<td>'.strtoupper($street_name2).'</td>
				</tr>
			   <tr>
					<td>Lane</td>
					<td>'.strtoupper($str_name1).'</td>
				</tr>
				<tr>
					<td>Area/Colony </td>
					<td>'.strtoupper($str_name2).'</td>
				</tr>
			   <tr>
					<td>Town/Village </td>
					<td>'.strtoupper($vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($dist).'</td>
				</tr>
				<tr>
					<td> Pin Code </td>
					<td>'.strtoupper($pincode).'</td>
				</tr>
				<tr>
					<td>Mobile No. </td>
					<td>'.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
					<td>Post office</td>
					<td>'.strtoupper($appli_postofice).'</td>
				</tr>
			</table>
			</td>
		</tr>
        <tr>
		   <td>6. Address of the premises where service connection is applied for </td>
		   <td>
    	   <table class="table table-bordered table-responsive">
		     <tr>
			  <td>House No/ Plot No. </td>
			  <td>'.strtoupper($b_street_name1).'</td>
			</tr>
			<tr>
				<td>Road </td>
				<td>'.strtoupper($b_street_name2).'</td>
			</tr>
			<tr>
				<td>Lane</td>
				<td>'.strtoupper($b_str_name1).'</td>
			</tr>
			<tr>
				<td>Area/Colony </td>
				<td>'.strtoupper($b_str_name2).'</td>
			</tr>
		   <tr>
				<td>Town/Village </td>
				<td>'.strtoupper($b_vill).'</td>
			</tr>
			<tr>
				<td>District </td>
				<td>'.strtoupper($b_dist).'</td>
			</tr>
			<tr>
				<td> Pin Code </td>
				<td>'.strtoupper($b_pincode).'</td>
			</tr>
			<tr>
				<td>Mobile No. </td>
				<td>'.strtoupper($b_mobile_no).'</td>
			</tr>
			<tr>
				<td>Post office</td>
				<td>'.strtoupper($premises_postofc).'</td>
			</tr>
           </table>
		  </td>
        </tr>		 
        <tr>
			<td>7. Premises is situated in plain/hilly area </td>
			<td>'.strtoupper($situated_area).'</td>
        </tr>
		<tr>
			<td>8. Premises is constructed at (Myadi land/Govt. land) </td>
			<td>'.strtoupper($constructed_land).'</td>
        </tr>
		<tr>
			<td colspan="2">9. Structural details </td>
		</tr>
        <tr>
			<td>Height of the tower </td>
			<td>'.strtoupper($height_tower).'</td>
		</tr>
		<tr>
			<td colspan="2">10. Please give details of the existing connections of the premises where the connection is applied for </td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>
						<th>Slno</th>
						<th>Consumer name</th>
						<th>Consumer number</th>
						<th>Category</th>
						<th>Load</th>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["consumer_name"]).'</td>
							<td>'.strtoupper($row_1["consumer_number"]).'</td>
							<td>'.strtoupper($row_1["category"]).'</td>
							<td>'.strtoupper($row_1["current_load"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
        <tr>
			<td>11. Whether there is any dedicated 11/0.440 KV sub-station at the premises?</td>
            <td>'.strtoupper($is_dedicated).'</td>
		</tr>
		<tr>
		    <td>12. If yes, capacity of the existing 11/0.440 KV sub-station at the premises.?</td>
            <td>'.strtoupper($dedicated_details).'</td>
        </tr>
        <tr>
            <td>13. Whether the applicant is the owner of the premises?</td>
            <td>'.strtoupper($is_owner).'</td>
		</tr>
        <tr>
			<td colspan="2">14. If the applicant is not the owner/sole owner of the premises,</td>
		</tr>
        <tr>
			<td>(i) Whether the owner/co owner will provide NOC?</td>
			<td>'.strtoupper($is_co_owner).'</td>
		</tr>  
		<tr>
		    <td>(ii) Is there any lease agreement with the owner?</td>
			<td>'.strtoupper($is_lease).'</td>
		</tr> 
		<tr>
			<td>(iii) Whether there is any legal dispute with the owner?</td>
			<td>'.strtoupper($is_legal).'</td>
		</tr> 
		<tr>
            <td>15. If there is any permanent disconnection due to non-payment in the land or premises?<br/>If yes, please give details of the permanently disconnected connection(s)</td>
            <td>'.strtoupper($permanent_disconnection).'</td>
		</tr>
		
		<tr>
			<td>16. Is there any electricity due outstanding in Licensee’s area of operation in the applicant’s name?</td>
            <td>'.strtoupper($is_electricity).'</td>
        </tr>
		<tr>
			<td>17. Any electricity dues outstanding for the premises for which connection applied for</td>
            <td>'.strtoupper($is_connection).'</td>
        </tr>
		<tr>
			<td>18. Name of the electrical sub-division </td>
            <td>'.strtoupper($esd).'</td>
        </tr>
		<tr>
			<td>19. Approximate distance of the nearest 33/11KV sub-station from the premises in meters along the right of way </td>
            <td>'.strtoupper($approx_distance).'</td>
        </tr>
		<tr>
			<td>20. Proposed distance of the nearest 11KV line (from where the spur line can be constructed) from the premises in meters along the right of way </td>
            <td>'.strtoupper($proposed_distance).'</td>
        </tr>
		<tr>
			<td>21. Whether road crossing is required along the right of way?  Required/Not required </td>
            <td>'.strtoupper($road_crossing).'</td>
        </tr>
		<tr>
			<td>22. If required, nos. of road crossings</td>
            <td>'.strtoupper($nos_road).'</td>
        </tr>
		<tr>
			<td>21. Whether road crossing is required along the right of way?  Required/Not required</td>
            <td>'.strtoupper($is_road_crossing).'</td>
        </tr>
		<tr>
			<td>If yes, nos. of HT crossing</td>
            <td>'.strtoupper($details_crossing).'</td>
        </tr>
		<tr>
		   <td colspan="2">&nbsp;&nbsp;I/we declare that the information given above is true to the best of my/our knowledge and belief. I/we will provide right of way for laying 11 KV line and service connection wire/cable.</td>
		</tr>
		<tr>
		   <td colspan="2">&nbsp;&nbsp;If any information furnished above is found wrong, the licensee will be at liberty to stop or discontinue the service connection procedure.</td>
		</tr>
		';
		
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
		
	
			<tr>
				<td>Date  : &nbsp; '.date("d-m-Y",strtotime($results["sub_date"])).'</td>
				<td align="right">Signature of Applicant : &nbsp; '.strtoupper($key_person).'</td>				
			</tr>	
			
    </tbody>
</table>';
?>