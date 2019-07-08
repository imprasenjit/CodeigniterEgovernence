<?php
$dept="pcb";
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
	$annual_cap=$results["annual_cap"];$qnty_recovd_scrap=$results["qnty_recovd_scrap"];
	if(!empty($results["total_qnty"])){
		$total_qnty=json_decode($results["total_qnty"]);
		$total_qnty_manuf=$total_qnty->manuf;$total_qnty_delears=$total_qnty->delears;$total_qnty_auct=$total_qnty->auct;$total_qnty_source=$total_qnty->source;
	}else{
		$total_qnty_manuf="";$total_qnty_delears="";$total_qnty_auct="";$total_qnty_source="";
	}	
	if(!empty($results["qnty_recved"])){
		$qnty_recved=json_decode($results["qnty_recved"]);
		$qnty_recved_manuf=$qnty_recved->manuf;$qnty_recved_other_agencies=$qnty_recved->other_agencies;
	}else{
		$qnty_recved_manuf="";$qnty_recved_other_agencies="";
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
				<td valign="top" style="width:50%;">1. Name and address of the recycler</td>
    			<td style="width:50%;">
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
		<td valign="top">3. Installed annual capacity to recycle used battery scrap (in MTA)</td>
		<td>'.strtoupper($annual_cap).'</td>
  	</tr>
  	<tr>
    	<td valign="top">4.Total quantity of used battery scrap purchased from / sent for processing during the period from October - March/April - September-</td>
    	<td>
    	   <table class="table table-bordered table-responsive">
      		<tr>
        			<td>(i) Quantity of used batteries sent by / purchased from the manufacturers-</td>
        			<td>'.strtoupper($total_qnty_manuf).'</td>
      		</tr>
      		<tr>
        			<td >(ii) Quantity of used batteries purchased from the dealers-</td>
        			<td >'.strtoupper($total_qnty_delears).'</td>
      		</tr>
      		<tr>
        			<td>(iii) Quantity of used batteries purchased from auctioneers-</td>
        			<td >'.strtoupper($total_qnty_auct).'</td>
      		</tr>
      		<tr>
        			<td >(iv) Quantity of used batteries obtained from any other source-</td>
        			<td >'.strtoupper($total_qnty_source).'</td>
      		</tr>	
    		</table>
    		
    	</td>
   </tr>
   <tr>
  	<td valign="top">5. Quantity of lead recovered from the used battery scrap (in MTA)</td>
  	<td>'.strtoupper($qnty_recovd_scrap).'</td>
  	</tr>
  	
  	<tr>
    	<td valign="top">6.Quantity of received lead sent back to</td>
    	<td>
    	<table class="table table-bordered table-responsive">
      		<tr>
        			<td>(i) The manufacturer of batteries</td>
        			<td>'.strtoupper($qnty_recved_manuf).'</td>
      		</tr>
      		<tr>
        			<td valign="top" style="text-align:justify">(ii) Other agencies * -</td>
        			<td>'.strtoupper($qnty_recved_other_agencies).'<br/></td>
      		</tr>
    	</table>    		
    	</td>
   </tr>';				
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 			
	<tr>      
		<td valign="top">Place :'.strtoupper($dist).'<br/>
		Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
		<td align="right">'.strtoupper($key_person).'<br/>Signature of the Authorized person</td>
	</tr>       
</table> ';
?>