<?php
$dept="doa";
$form="26";
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

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'");
if($q->num_rows>0){	
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	##### part 1 ######	
	$name_concern=$results["name_concern"];
	$relevant_detail=$results["relevant_detail"];
	$is_renewal=$results["is_renewal"];
	if($is_renewal=='Y') $is_renewal="YES";
	else $is_renewal="NO";
		
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
	
	if(!empty($results["manufac_importer"])){
		$manufac_importer=json_decode($results["manufac_importer"]);
		if(isset($manufac_importer->a)) $manufac_importer_a=$manufac_importer->a; else $manufac_importer_a="";
		if(isset($manufac_importer->b)) $manufac_importer_b=$manufac_importer->b; else $manufac_importer_b="";
		if(isset($manufac_importer->c)) $manufac_importer_c=$manufac_importer->c; else $manufac_importer_c="";
		if(isset($manufac_importer->d)) $manufac_importer_d=$manufac_importer->d; else $manufac_importer_d="";
		if(isset($manufac_importer->e)) $manufac_importer_e=$manufac_importer->e; else $manufac_importer_e="";
	}else{
		$manufac_importer_a="";$manufac_importer_b="";$manufac_importer_c="";$manufac_importer_d="";$manufac_importer_e="";
	}
	//manufac_importer//  
	$manufac_importer_values="";
	if($manufac_importer_a=="M") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Manufacturer';
	if($manufac_importer_b=="I") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Importer';
	if($manufac_importer_c=="P") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Pool Handling Agency';
	if($manufac_importer_d=="W") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Wholesale Dealer';
	if($manufac_importer_e=="R") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Retail Dealer';
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
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div></br>
<table class="table table-bordered table-responsive">
	<tr>  				
		<td colspan="2">1. Details of the application :</td>
	</tr>
	<tr>  				
		<td width="50%">(a) Name of the applicant :</td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>  				
		<td>(b) Name of the concern :</td>
		<td>'.strtoupper($name_concern).'</td>
	</tr>
	<tr>
		<td>(c) Postal address of the applicant :</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Street name 1 </td>
					<td>'.strtoupper($street_name1).'</td>
				</tr>
				<tr>
					<td>Street name 2 </td>
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
					<td>'.$pincode.'</td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>+91 - '.$mobile_no.'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td> '.$email.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">2. Place of business (Please give full address ) : </td>
	</tr>
	<tr>
		<td> (i) For sale  :</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Street name 1 </td>
					<td>'.strtoupper($sale_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($sale_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($sale_v).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($sale_d).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>+91 - '.$sale_p.'</td>
				</tr>
				<tr>
					<td>Mobile No.</td>
					<td> '.$sale_mno.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>(ii) For Storage :</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Street name 1 </td>
					<td>'.strtoupper($storage_sn1).'</td>
				</tr>
				<tr>
					<td>Street name 2 </td>
					<td>'.strtoupper($storage_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($storage_v).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($storage_d).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.$storage_p.'</td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>+91 - '.$storage_mno.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>3. Whether the application is for :</td>
		<td>'.strtoupper($manufac_importer_values).'</td>
	</tr>
	<tr>
		<td colspan="2">4. Details of fertilizer and their source in Form "O"  :
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center"><b>Sl. No.</b></td>
					<td align="center"><b>Name of fertilizers</b></td>
					<td align="center"><b>Whether certificate of source in Form "O" is attached</b></td>
				</tr>';
				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["fertilizer"]).'</td>
							<td>'.strtoupper($row_1["is_certificate"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
		</td>
	</tr>
	<tr>
		<td>5. Whether the intimation is for an authorization letter or a renewal thereof. <br/>  (Note: In case the intimation is for renewal of authorization letter, the acknowledgement in Form A2 should be submitted for necessary endorsement thereon.) : </td>
		<td>'.strtoupper($is_renewal).'</td>
	</tr>
	<tr>
		<td>6. Any other relevant information. :</td>
		<td>'.strtoupper($relevant_detail).'</td>
	</tr>
	<tr>
		<td colspan="2">I have read the terms and conditions of eligibility for submission of Memorandum of intimation and undertake that the same will be complied by me and in token of the same. I have signed the same and is enclosed herewith.</td>
	</tr>
	<tr>
		<td>
			Date<strong> : </strong> '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
			Place<strong> : </strong> '.strtoupper($dist).' 
		</td>
		<td align="right">Signature of the Applicant<strong> : </strong>&nbsp;'.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><b><u>TERMS AND CONDITIONS OF AUTHORISATION</u></b></td>
	</tr>
	<tr>
		<td colspan="2">
		<ol>
			<li>I shall comply with the provisions of Fertilizer(Control) Order, 1985 and the notification issued there under for the time being in force.</li>
			<li>I shall from time to time report to the Notified Authority and inform about change in the premises of the sale depot and godowns attached to sale depot.</li>
			<li>I shall also submit in time all the returns as may be prescribed by the State Government.</li>
			<li>I shall not sell fertilizers for Industrial use.</li>
			<li>I shall file a separate Memorandum of Intimation for, where the storage point is located outside the area jurisdiction of the Notified Authority where the sale depot is located.</li>
			<li>I shall file a separate Memorandum of Intimation for each place when the business of selling fertilisers is intended to be carried on at more than one place.</li>
			<li>I shall file separate Memorandum of Intimation If I carry on the business of fertilisers both as retail and wholesale dealer.</li>
			<li>I confirm that my previous Certificate of Registration or Authorisation is not under suspension or cancellation or debarred from selling of fertilisers.</li>
		</ol>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><b><u>DECLARATION</u></b></td>
	</tr>
	<tr>
		<td colspan="2">
			I/We declare that the information given above is true to the best of my/our knowledge and belief and no part thereof is false or no material information has been concealed.
		</td>
	</tr>
	';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td>
			Date<strong> : </strong> '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
			Place<strong> : </strong> '.strtoupper($dist).' 
		</td>
		<td align="right">Signature of the Applicant(s)<strong> : </strong>&nbsp;'.strtoupper($key_person).'</td>
	</tr>
</table>
';
?>  