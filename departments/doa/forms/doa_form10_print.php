<?php
$dept="doa";
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
		$form_id=$results["form_id"];$auth_desig=$results["auth_desig"];$place=$results["place"];$state=$results["state"];$concern=$results["concern"];$is_intimate=$results["is_intimate"];$other=$results["other"];
		
		if(!empty($results["sale"])){
			$sale=json_decode($results["sale"]);
			$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_d=$sale->d;$sale_p=$sale->p;$sale_mno=$sale->mno;
		}else{				
			$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
		}	
		if(!empty($results["storage"])){
			$storage=json_decode($results["storage"]);
			$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_d=$storage->d;$storage_p=$storage->p;$storage_mno=$storage->mno;
		}else{				
			$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
		}
		
		if($is_intimate=='Y') $is_intimate="YES";
		else $is_intimate="NO";
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
            <td width="50%">1. Details of the Notified Authority to whom applicant is submitted </td>
			<td >Designation of Notified Authority :&nbsp;'.strtoupper($auth_desig).'<br/>
				Place :&nbsp;'.strtoupper($place).'<br/>
				State of :&nbsp;'.strtoupper($state).'<br/>
			</td>
		</tr>
		<tr>
			<td colspan="2">2. Details of the applicant:</td>
		</tr>
		<tr>
			<td>a. Name of the applicant</td>
			<td >'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>b. Name of the concern</td>
			<td >'.strtoupper($concern).'</td>
		</tr>
		<tr>
			<td >c. Postal address with telephone number</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td >Street name 1 </td>
						<td >'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">3. Place of business (Please give full address)</td>
		</tr>
		<tr>
			<td > i. For sale  :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td >Street name 1 </td>
						<td >'.strtoupper($sale_sn1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($sale_sn2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($sale_v).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($sale_d).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($sale_p).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($sale_mno).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td > ii. For Storage :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td >Street name 1 </td>
						<td >'.strtoupper($storage_sn1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($storage_sn2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($storage_v).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($storage_d).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($storage_p).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($storage_mno).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">4. Details of fertilizer and their source in Form "O"</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr align="center" >
				<th>Slno</th>
				<th>Name of fertilizer</th>
				<th>Whether certificate of source in Form "O" is attached</th>
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["firm"]).'</td>
						<td>'.strtoupper($row_1["stock"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> </td>
		</tr>	
		<tr>
				<td>5. Whether the intimation is for an authorization letter or a renewal thereof. (Note: In case the intimation is for renewal of authorization letter, the acknowledgement in Form A2 should be submitted for necessary endorsement their on).</td>
				<td>'.strtoupper($is_intimate).'</td>
		</tr>
		<tr>
				<td>6. Any other relevant information</td>
				<td>'.strtoupper($other).'</td>
		</tr>'
		;
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
        $printContents=$printContents.' 
		<tr>
			<td colspan="2">
				I have read terms and conditions of eligibility for submission of memorandum of intimation and undertake the same will be accompanied by me and in token of the same; I have signed the same and is enclosed herewith.
			</td>
		</tr>
		<tr>
			<td>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
			Place<strong> :</strong> '.strtoupper($dist).' </td>
			<td align="right">Signature of the Applicant<strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>			
	</table>	
		';
?>