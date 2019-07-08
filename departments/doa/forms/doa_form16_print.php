<?php
 $dept="doa";
 $form="16";
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
        
		$form_id=$results["form_id"];$concern=$results["concern"];$loc=$results["loc"];$total_pesticides=$results["total_pesticides"];$license=$results["license"];$declaration=$results["declaration"];$father=$results["father"];$designation=$results["designation"];$photo=$results["photo"];
	}else{
		$concern="";$loc="";$total_pesticides="";$license="";$declaration="";$father="";
	}
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'
  			<h4>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	   
	   
  	    <tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp; I/We &nbsp;'.strtoupper($concern).'&nbsp;of&nbsp; '.strtoupper($unit_name).'&nbsp;&nbsp;hereby apply for the renewal of the license to  manufacture insecticides on the premises  situated at&nbsp;'.strtoupper($loc).'&nbsp;(License No. date to be given ).</td>
		</tr>
		<tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;The other details regarding the manufacture of the insecticides continue to remain the same.</td>
		</tr>
		<tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Particulars of the license is enclosed herewith:</td>
			<td>'.strtoupper($license).'</td>
		</tr>
		<tr>
				<td>Total No. of Pesticides</td>
				<td>'.strtoupper($total_pesticides).'</td>
		</tr>
		<tr>
		  
			<td colspan="2" height="50px"><b>VERIFICATION </b></td>
		
		</tr>
		<tr>
		   <td colspan="2">I &nbsp;'.strtoupper($declaration).'&nbsp;&nbsp;S/O &nbsp;&nbsp;'.strtoupper($father).'&nbsp;&nbsp;do hereby solemnly verify that what is stated above is true and correct to the best of my knowledge and belief.I further declare that I am making this application in my capacity as&nbsp;'.strtoupper($designation).'&nbsp;(designation)&nbsp;and that I am competent to make this application and verify it,by virtue of&nbsp;'.strtoupper($photo).'.</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
        $printContents=$printContents.'
 		<tr>
			<td>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place<strong> :</strong> '.strtoupper($dist).'</td>
			<td align="right">Signature with Seal<strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	';
?>  