<?php
$dept="pcb";
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
	$used_batt_scrap=$results["used_batt_scrap"];			
	if(!empty($results["num_used_batt"])){
		$num_used_batt=json_decode($results["num_used_batt"]);
		$num_used_batt_avail_batt=$num_used_batt->avail_batt;$num_used_batt_tot_tonnage=$num_used_batt->tot_tonnage;
	}else{
		$num_used_batt_avail_batt="";$num_used_batt_tot_tonnage="";
	}	
	if(!empty($results["num_auct_batteries"])){
		$num_auct_batteries=json_decode($results["num_auct_batteries"]);
		$num_auct_batteries_auc_batt=$num_auct_batteries->auc_batt;$num_auct_batteries_auc_tonnage=$num_auct_batteries->auc_tonnage;
	}else{
		$num_auct_batteries_auc_batt="";$num_auct_batteries_auc_tonnage="";
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
				<td width="50%">1. Name and address of the auctioneer</td>
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
        			<td>'.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_std).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td>'.$email.'</td>
      		</tr>
    		</table>
    	</td>
  	</tr>
  	<tr>
    	<td valign="top">3. Number of used batteries and total Tonnage (of MT) available during the period from October-March and April-September</td>
    	<td>Number of batteries : '.strtoupper($num_used_batt_avail_batt).'<br/>
    	Total tonnage : '.strtoupper($num_used_batt_tot_tonnage).'</td>
   </tr>
   	<tr>
    	<td valign="top">4. Source of the used battery scrap</td>
    	<td>'.strtoupper($used_batt_scrap).'</td>
    </tr>
   	<tr>
    	<td valign="top">5.Number  of  used  batteries  and  total  Tonnage  (of  MT)  auctioned  during  the  period  from  October-March  and  April-September </td>
    	<td>Number of batteries : '.strtoupper($num_auct_batteries_auc_batt).'<br/>
    	Total tonnage : '.strtoupper($num_auct_batteries_auc_tonnage).'</td>
   </tr>
  	<tr>
  		<td valign="top">6. Number of used batteries and total Tonnage (of MT) sent to the registered recyclers. </td>
  		<td>Uplaod in upload section</td>
  	</tr> 
	';
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'     
	
        <tr>
			<td valign="top">Place :'.strtoupper($dist).'<br/>Date : '.strtoupper($results["sub_date"]).'</td>
			<td align="right">'.strtoupper($key_person).'<br/>Signature of the Authorized person</td>
		</tr>
    </table>';
?>