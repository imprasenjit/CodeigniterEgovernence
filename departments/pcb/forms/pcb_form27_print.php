<?php
$dept="pcb";
$form="27";
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
		$trader_name=$results["trader_name"];$trader_st1=$results["trader_st1"];$trader_st2=$results["trader_st2"];$trader_vill=$results["trader_vill"];$trader_dist =$results["trader_dist"];$trader_pincode =$results["trader_pincode"];$trader_mobile_no =$results["trader_mobile_no"];$trader_phone_no =$results["trader_phone_no"];$trader_email =$results["trader_email"];$export_code =$results["export_code"];$desc_n_quant_imported =$results["desc_n_quant_imported"];$storage_details =$results["storage_details"];

		$desc_n_quant_imported = wordwrap($desc_n_quant_imported, 50, "<br/>", true);
		$storage_details = wordwrap($storage_details, 50, "<br/>", true);
	}

$form_name=$formFunctions->get_formName($dept,$form);
//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

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
        <h4>'.$form_name.'</h4>
	</div><br/> 
   <table class="table table-bordered table-responsive">  
    <tr>
        <td valign="top" style="width:50%">1. Name and address of trader with Telephone, Fax Number and e-mail:</td>
        <td width="50%">
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($trader_name).'</td>
      		</tr>
			<tr>
					<td>Street Name 1</td>
        			<td>'.strtoupper($trader_st1).'</td>
			</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($trader_st2).'</td>
      		</tr>
      		<tr>
        			<td>Vill/Town</td>
        			<td>'.strtoupper($trader_vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($trader_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($trader_pincode).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($trader_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.$trader_phone_no.'</td>
      		</tr>
			<tr>
					<td>Email ID</td>
					<td>'.$trader_email.'</td>
			</tr>
    		</table>
    	</td>
	</tr>
	<tr>
		<td valign="top">2. TIN/VAT Number/Import/ Export Code:</td>
		<td>'.strtoupper($export_code).'</td>
	</tr>
	<tr>
		<td valign="top">3. Description and quantity of other waste to be imported:</td>
		<td>'.strtoupper($desc_n_quant_imported).'</td>
	</tr>
	<tr>
		<td valign="top">4. Details of storage, if any :</td>
		<td>'.strtoupper($storage_details).'</td>
	</tr>
	<tr>
        <td valign="top">5. Names and address of authorised actual user (s):</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name </td>
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
        			<td>Vill/Town</td>
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
        			<td>Mobile No</td>
        			<td>+91'.$mobile_no.'</td>
      		</tr>
			<tr>
        			<td>Phone No</td>
        			<td>'.$landline_std.'-'.$landline_no.'</td>
      		</tr>
			<tr>
        			<td>Email Id</td>
        			<td>'.$email.'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
	';				
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
	<tr>
		<td>Date: <label>'.date('d-m-Y',strtotime($today)).'</label><br/>
			Place: <label>'.strtoupper($dist).'</label></td>
		<td align="right">
			<b>'.strtoupper($key_person).'</b><br/>
				Signature of the Authorised person              
		</td>
	</tr>        
</table>';
?>