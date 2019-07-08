<?php
$dept="dic";
$form="10";
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
		$authority=$results["authority"];
		if($authority=="AIDC"){
			$authority_name = "Assam Industrial Development Corporation Limited";
		}elseif($authority=="AIIDC"){
			$authority_name = "Assam Industrial Infrastructure Development Corporation Limited";
		}elseif($authority=="ASIDC"){
			$authority_name = "Assam Small Industries Development Corporation Limited";
		}elseif($authority=="DICC"){
			$authority_name = "District Industries & Commerce Center";
		}else{
            $authority_name ="";
		}	
		$dicc_district_id=$results["dicc_district_id"];
		$select_district="SELECT dist_name FROM districts WHERE dist_id='$dicc_district_id'";
		$exec_select_district=$formFunctions->executeQuery("dicc",$select_district);
		if($exec_select_district->num_rows>0){
			$row_district=$exec_select_district->fetch_array();
			$dicc_district=$row_district["dist_name"];
		}else{
			$dicc_district="";
		}
		if($dicc_district!=""){
			$auth_with_dist = $authority_name.", ".$dicc_district;
		}else{
			$auth_with_dist = $authority_name;
		}
		$indus_land=$results["indus_land"];$actual_area=$results["actual_area"];$lic_no=$results["lic_no"];
		$lic_date=$results["lic_date"];
		if($lic_date!="" && $lic_date!="0000-00-00"){
			$lic_date = date('d-m-Y',strtotime($lic_date));
		}else{
			$lic_date="";
		}
		$item_name=$results["item_name"];$production_capacity=$results["production_capacity"];$prod_export=$results["prod_export"];$civil_works=$results["civil_works"];$plant_n_machinery=$results["plant_n_machinery"];
		$other_fixed_assets=$results["other_fixed_assets"];$actual_prod_area=$results["actual_prod_area"];
		$godown=$results["godown"];$other_services=$results["other_services"];$power_req=$results["power_req"];$water_req=$results["water_req"];$if_any=$results["if_any"];$PI_indicate=$results["PI_indicate"];
		if($if_any=="Y") $if_any="YES";
		else if($if_any=="N") $if_any="NO";
		else $if_any="";
	}
	$PI_indicate = wordwrap($PI_indicate, 50, "<br/>", true);		
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
if(!isset($css)){
$printContents='<!DOCTYPE html>
<html lang="en">
<head>
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
          '.$assamSarkarLogo.'<br/><h4>'.$form_name.'</h4>
    </div><br/> 
    <table class="table table-bordered table-responsive">  
		<tr>
			<td valign="middle" style="height:40px;width:50%">  Authority : </td>
			<td>'.strtoupper($auth_with_dist).'</td>
		</tr>
		<tr>
			<td valign="middle" style="height:40px;width:50%">  Industrial land available at : </td>
			<td>'.strtoupper($indus_land).'</td>
		</tr>
		<tr>
			<td valign="top">1. Location of land/Shed applied for (Actual name of the industrial property as mentioned):</td>
			<td>
				<table class="table table-bordered table-responsive"> 
					<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
							<td>Vill/Town</td>
							<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
							<td height="29">Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
							<td>Mobile</td>
							<td>+91'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
							<td>Phone Number</td>
							<td>'.strtoupper($b_landline_std).' '.strtoupper($b_landline_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2. Actual area applied for (in terms of sq mt)</td>
			<td>'.strtoupper($actual_area).'</td>
		</tr>
		<tr>
			<td>3. Name of the Industrial Unit</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td style="width:50%" valign="top">4. Address for communication :</td>
			<td>
				<table class="table table-bordered table-responsive"> 
					<tr>
							<td>Street Name1</td>
							<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
							<td>Vill/Town</td>
							<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
							<td>Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>5. Constitution of the Industrial unit :</td>
			<td>'.strtoupper($Type_of_ownership).'</td>
		</tr>
		<tr>
			<td>6. Name of the Proprietor/Partner/Board of Directors :</td>
			<td>'.strtoupper($owner_names).'</td>
		</tr>
		<tr>
			<td>7. (a) EM-I/EM- II/IEM/Industrial Licence no :</td>
			<td>'.strtoupper($lic_no).'</td>
		</tr>
		<tr>
			<td style="text-indent:14px;"> (b) Licence date :</td>
			<td>'.strtoupper($lic_date).'</td>
		</tr>
		<tr>
			<td>8. Name of Item/s of manufacture:</td>
			<td>'.strtoupper($item_name).'</td>
		</tr>
		<tr>
			<td>9. Proposed Annual Installed Capacity of Production in MT (item-wise) :</td>
			<td>'.strtoupper($production_capacity).'</td>
		</tr>
		<tr>
			<td>10. Proposed export of product (in terms of MT) :</td>
			<td>'.strtoupper($prod_export).'</td>
		</tr>
		<tr>
			<td colspan="2">11. Proposed investment (Rs. in lakh)</td>
		</tr>
		<tr>
			<td style="text-indent:14px;">(a) Civil works :</td>
			<td>'.strtoupper($civil_works).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(b) Plant &amp; Machinery :</td>
			<td>'.strtoupper($plant_n_machinery).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(c) Other fixed assets :</td>
			<td>'.strtoupper($other_fixed_assets).'</td>
		</tr>
		<tr>
			<td colspan="2">12. Requirement of Land (sq ft)</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(a) For actual production area ( sq ft) :</td>
			<td>'.strtoupper($actual_prod_area).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(b) For Godown ( sq ft) :</td>
			<td>'.strtoupper($godown).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(c) Other utility services ( in sq ft ) :</td>
			<td>'.strtoupper($other_services).'</td>
		</tr>
		<tr>
			<td colspan="2">13. Other amenities</td>
		</tr>
		<tr>
			<td style="text-indent:14px;">(a) Requirement of Power (HP) :</td>
			<td>'.strtoupper($power_req).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(b) Annual requirement of Water (in KL) :</td>
			<td>'.strtoupper($water_req).'</td>
		</tr>
		<tr>
			<td>14. If there any effluent problem :</td>
			<td>'.strtoupper($if_any).'</td>
		</tr>';
		if($if_any=="YES"){
		$printContents=$printContents.'
			<tr>
				<td>15. If yes , Please indicate with 50 words :</td>
				<td>'.strtoupper($PI_indicate).'</td>
			</tr>
		';
		}
		$printContents=$printContents.'
        ';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
		<tr>
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
               </td>
        </tr>        
	</table>';
?>