<?php
$dept="pcb";
$form="42";
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
	$accident_type=$results['accident_type'];$seq_of_events=$results['seq_of_events'];$is_auth_informed=$results['is_auth_informed'];$accident_waste_type=$results['accident_waste_type'];$effects_of_accidents=$results['effects_of_accidents'];$measures_taken=$results['measures_taken'];$steps_taken_all=$results['steps_taken_all'];$steps_taken_prevent=$results['steps_taken_prevent'];
	$is_facilities_details=$results["is_facilities_details"];$is_facilities=$results["is_facilities"];
		
	if($is_auth_informed=='Y') $is_auth_informed="YES";
	else $is_auth_informed="NO";
	if($is_facilities=='Y') $is_facilities="YES";
	else $is_facilities="NO"; 
}

$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

if(!isset($css)){
$printContents='
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
  		<h4>'.$form_name.'</h4>		
  	</div>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tr>
  		     <td valign="top" style="width:50%">1. Date and time of accident.</td>
             <td>'.strtoupper($today).'</td>
        </tr>
		<tr>
  		     <td>2. Type of Accident.</td>
             <td>'.strtoupper($accident_type).'</td>
        </tr>
        <tr>
             <td>3. Sequence of events leading to accident.</td>
             <td>'.strtoupper($seq_of_events).'</td>
  	    </tr>
		<tr>
             <td>4. Has the Authority been informed immediately.</td>
             <td>'.strtoupper($is_auth_informed).'</td>
  	    </tr>
		<tr>
			<td>5. The type of waste involved in accident.</td>
			<td>'.strtoupper($accident_waste_type).'</td>
		</tr>
		<tr>
             <td>6. Assessment of the effects of the accidents on human health and the environment.</td>
             <td>'.strtoupper($effects_of_accidents).'</td>
  	    </tr>
		<tr>
             <td>7. Emergency measures taken.</td>
             <td>'.strtoupper($measures_taken).'</td>
  	    </tr>
		<tr>
             <td>8. Steps taken to alleviate the effects of accidents.</td>
             <td>'.strtoupper($steps_taken_all).'</td>
  	    </tr>
		<tr>
             <td>9. Steps taken to prevent the recurrence of such an accident.</td>
             <td>'.strtoupper($steps_taken_prevent).'</td>
  	    </tr>
		<tr>
				<td>10. Does you facility has an Emergency Control policy?If yes give details.</td>
				<td>'.strtoupper($is_facilities).' &nbsp;&nbsp; '.strtoupper($is_facilities_details).'</td>
		</tr>
		';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 		
        
		<tr>  		
			<td valign="top">Place :<b>'.strtoupper($dist).'</b><br/>
			Date : <b>'.strtoupper($results["sub_date"]).'</b></td>
			<br/>
			<td align="right" ><b>'.strtoupper($key_person).'</b><br/>Signature of the Authorized person</td>
		</tr>
    </table>
  	';
?>
