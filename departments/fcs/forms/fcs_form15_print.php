<?php
$dept="fcs";
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


	if($q->num_rows>0){				
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$auth_address=$results["auth_address"];$license_no=$results["license_no"];$expiry_date=$results["expiry_date"];$license_stands=$results["license_stands"];$renewal_desired=$results["renewal_desired"];$details_action=$results["details_action"];
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
  			'.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	    <tr>
            <td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td colspan="2">
							<p>To<br/>&nbsp;&nbsp;The Licensing Authority<br/></p><br/>
					
						<p>Sir,</p>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, '.strtoupper($key_person).' hereby apply for renewal of my license no.<b> '.strtoupper($license_no).'</b> &nbsp; 
						issued to me under the Assam Public Distribution of Articles Order, 1982. The required particulars are given below -<br/><br/></p>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td valign="top">1. Date on which the licence expire</td>
			<td>'.strtoupper($expiry_date).'</td>
		</tr>
		<tr>
			<td valign="top">2. Name in which licence stands</td>
			<td >'.strtoupper($license_stands).'</td>
		</tr>
		<tr>
			<td>3. For how many years the renewal is desired</td>	
			<td>'.strtoupper($renewal_desired).'</td>				
		</tr>   
		<tr>
			<td>4. Details of the action, if any taken against the licensee during the last 3 (three) years for contravention of an order issued under the Essential Commodities Act, 1953.</td>
			<td>'.strtoupper($details_action).'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td colspan="2">I <b>'.strtoupper($key_person).'</b> hereby declare that the particulars mentioned above are correct and true to best of my knowledge and belief, nothing has been concealed therein.</td>
		</tr>
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td>Signature of Proprietor/Partner <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	';
?>