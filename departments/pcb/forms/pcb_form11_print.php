<?php
$dept="pcb";
$form="11";
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
	$no_used_batt=$results['no_used_batt'];
	if(!empty($results["new_batteries"])){
		$new_batteries=json_decode($results["new_batteries"]);
		$new_batteries_auto=$new_batteries->auto;$new_batteries_ind=$new_batteries->ind;
		$new_batteries_auto_fw1=$new_batteries_auto->fw1;$new_batteries_auto_fw2=$new_batteries_auto->fw2;
		$new_batteries_auto_tw1=$new_batteries_auto->tw1;$new_batteries_auto_tw2=$new_batteries_auto->tw2;
		$new_batteries_ind_ups1=$new_batteries_ind->ups1;$new_batteries_ind_ups2=$new_batteries_ind->ups2;
		$new_batteries_ind_mp1=$new_batteries_ind->mp1;$new_batteries_ind_mp2=$new_batteries_ind->mp2;
		$new_batteries_ind_sb1=$new_batteries_ind->sb1;$new_batteries_ind_sb2=$new_batteries_ind->sb2;
		$new_batteries_ind_ot1=$new_batteries_ind->ot1;$new_batteries_ind_ot2=$new_batteries_ind->ot2;
	}else{
		$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";
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
        '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
    </div><br/>
      <table class="table table-bordered table-responsive">
  		 <tr>
   			<td width="50%">1.Name and address of the bulk consumer</td>
    		<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($b_street_name1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($b_street_name2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
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
      		<tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).'&nbsp;'.strtoupper($b_landline_no).'</td>
      		</tr>
      		
      		<tr>
        			<td>Email-id</td>
        			<td>'.$b_email.'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
  	<tr>
    	<td valign="top">2. Name of the Authorized person and full address with telephone</td>
    	<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($key_person).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($street_name1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($street_name2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($pincode).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_no).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td>'.$email.'</td>
      		</tr>
    		</table>
    	</td>
  	</tr>
  	<tr>
    	<td colspan="2">3. Number of new batteries of different categories purchased from the manufacturer/ importer/ dealer/ or any other agency during October-March and April- September<br/>
    <table class="table table-bordered table-responsive">
			<tr align="center">
        			<td colspan="2" align="center"><i>Category:</i></td>
					
        			<td>(i) No. of Batteries</td>
        			<td>(ii)Approximate weight (in Metric Tones)</td>
      		</tr>
      		<tr>
        			<td rowspan="2" width="100px">(i) Automotive</td>
					<td><p>(a) Four Wheeler</p></td>
        			<td align="center">'.strtoupper($new_batteries_auto_fw1).'</td>
        			<td align="center">'.strtoupper($new_batteries_auto_fw2).'</td>
      		</tr>
      		<tr>
        			<td><div>(b) Two Wheeler</div></td>
        			<td align="center">'.strtoupper($new_batteries_auto_tw1).'</td>
        			<td align="center">'.strtoupper($new_batteries_auto_tw2).'</td>
      		</tr>

				<tr>
        			<td rowspan="3">(ii) Industrial</td>
					<td><p>(a) UPS</p></td>
        			<td align="center">'.strtoupper($new_batteries_ind_ups1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_ups2).'</td>
      		</tr>
      		<tr>
        			<td><div>(b) Motive Power</div></td>
        			<td align="center">'.strtoupper($new_batteries_ind_mp1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_mp2).'</td>
      		</tr>
      		<tr>
        			<td><div>(c) Stand-By</div></td>
        			<td align="center">'.strtoupper($new_batteries_ind_sb1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_sb2).'</td>
      		</tr>	      		
      		<tr>
        			<td colspan="2">(iii) Others</td>
        			<td align="center">'.strtoupper($new_batteries_ind_ot1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_ot2).'</td>
      		</tr>
    		</table>    		
    	</td>
   </tr>
  	<tr>
  		<td valign="top">4. Number of used batteries of categories mentioned in Sl. No. 3 and Tonnage of scrap sent to manufacturer/dealer/importer/registered recycler/or any other agency to whom the used batteries scraped was sent.</td>
  		<td>'.strtoupper($no_used_batt).'<br/></td>
  	</tr>
	';
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'     
	
	<tr>
		<td valign="top">Place :'.strtoupper($dist).'<br/>
		Date : '.strtoupper($results["sub_date"]).'</td>
		<td align="right">'.strtoupper($key_person).'<br/>Signature of the Authorized person</td>
	</tr>
</table>';
?>