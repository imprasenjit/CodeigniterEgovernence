<?php
$dept="pcb";
$form="66";
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
		$date_acci=$results['date_acci'];$event_seq=$results['event_seq'];$type_construction=$results['type_construction'];$effects_accidents=$results['effects_accidents'];$emergency_measure=$results['emergency_measure'];$desg=$results['desg'];
		
		if(!empty($results["steps"])){
				$steps=json_decode($results["steps"]);
				$steps_effects=$steps->effects;$steps_recurrence=$steps->recurrence;
		}else{
				$steps_effects="";$steps_recurrence="";
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
	</div>  <br/>
             <table class="table table-bordered table-responsive">
                <tr>
                    <td width="50%"> 1.Date and Time of Accident  </td>
                    <td>'.strtoupper($date_acci).'</td>
                </tr>
				
                <tr>
                    <td>2.Sequence of events leading to accidents </td>
                    <td>'.nl2br(strtoupper($results["event_seq"])).'</td>
                </tr>
                 <tr>
                    <td>3.The type of construction and demolition waste involved in accident </td>
                    <td>'.strtoupper($type_construction).'</td>
                </tr>
                 <tr>
                    <td>4. Assessment of the effects of the accidents
						a. on traffic, drainage system and the environment </td>
                    <td>'.strtoupper($effects_accidents).'</td>
                </tr>
                 <tr>
                    <td>5.Emergency measures taken</td>
                    <td>'.strtoupper($emergency_measure).'</td>
                </tr>
				<tr>
                    <td>6.Steps taken to alleviate the effects
											a. of accidents</td>
                    <td>'.strtoupper($steps_effects).'</td>
                </tr>
				<tr>
                    <td>7.The steps take to prevent the recurrence of such an accident</td>
                    <td>'.strtoupper($steps_recurrence).'</td>
                </tr>
				';
             
						
				$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
				
				$printContents=$printContents.'
				
       
        <tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
				<tr>
					<td>Place : '.strtoupper($dist).'<br/> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
					<td align="right">Yours faithfully,<br/>
						Name : '.strtoupper($key_person).'<br/>
						Designation : '.strtoupper($status_applicant).'
					</td>
			</tr>
		</table>	
	</td>
    </tr>      
</table>
 ';
?>