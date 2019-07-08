<?php
$dept="pcb";
$form="8";
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
	if(!empty($results["new_batteries"])){
		$new_batteries=json_decode($results["new_batteries"]);
		$new_batteries_auto=$new_batteries->auto;$new_batteries_ind=$new_batteries->ind;$new_batteries_sold=$new_batteries->sold;	$new_batteries_auto_fw1=$new_batteries_auto->fw1;$new_batteries_auto_fw2=$new_batteries_auto->fw2;				
		$new_batteries_auto_tw1=$new_batteries_auto->tw1;$new_batteries_auto_tw2=$new_batteries_auto->tw2;				
		$new_batteries_ind_ups1=$new_batteries_ind->ups1;$new_batteries_ind_ups2=$new_batteries_ind->ups2;				
		$new_batteries_ind_mp1=$new_batteries_ind->mp1;$new_batteries_ind_mp2=$new_batteries_ind->mp2;
		$new_batteries_ind_sb1=$new_batteries_ind->sb1;$new_batteries_ind_sb2=$new_batteries_ind->sb2;
		$new_batteries_ind_ot1=$new_batteries_ind->ot1;$new_batteries_ind_ot2=$new_batteries_ind->ot2;
		$new_batteries_sold_d1=$new_batteries_sold->d1;$new_batteries_sold_d2=$new_batteries_sold->d2;
		$new_batteries_sold_bc1=$new_batteries_sold->bc1;$new_batteries_sold_bc2=$new_batteries_sold->bc2;				
		$new_batteries_sold_oem1=$new_batteries_sold->oem1;$new_batteries_sold_oem2=$new_batteries_sold->oem2;				
		$new_batteries_sold_r1=$new_batteries_sold->r1;$new_batteries_sold_r2=$new_batteries_sold->r2;	
		$tot_used_batteries=$results["tot_used_batteries"];		
	}else{
		$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";$new_batteries_sold_d1="";$new_batteries_sold_d2="";$new_batteries_sold_bc1="";$new_batteries_sold_bc2="";$new_batteries_sold_oem1="";$new_batteries_sold_oem2="";$new_batteries_sold_r1="";$new_batteries_sold_r2="";
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
		<td width="50%">1. Name and address of the dealer</td>
    	<td width="50%">
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
						<td height="29">Pincode</td>
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
						<td height="29">Email-id</td>
						<td>'.$b_email.'</td>
				</tr>
    		</table>
    	</td>
	</tr>
  	<tr>
    	<td valign="top">2. Name of the authorized person and full address with telephone and fax number</td>
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
        			<td height="29">Pincode</td>
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
    	<td valign="top" colspan="2">3. Number of new batteries sold during the period October-March/ April-September in respect of the following categories :-<br/>
    	 <table class="table table-bordered table-responsive">
			<tr>
        			<td colspan="2"><i>Category :</i></td>
        			<td align="center">(i) No. of Batteries</td>
        			<td align="center">(ii)Approximate weight (in Metric Tones)</td>
      		</tr>
      		<tr>
        			<td rowspan="2">(i) Automotive</td>
					<td>(a) <p style="text-indent:25px">four wheeler</p></td>
        			<td align="center">'.strtoupper($new_batteries_auto_fw1).'</td>
        			<td align="center">'.strtoupper($new_batteries_auto_fw2).'</td>
      		</tr>
      		<tr>
        			<td><div style="text-indent:25px">(b) two wheeler</div></td>
        			<td align="center">'.strtoupper($new_batteries_auto_tw1).'</td>
        			<td align="center">'.strtoupper($new_batteries_auto_tw2).'</td>
      		</tr>

				<tr>
        			<td rowspan="3">(ii) Industrial</td>
					<td>(a)<p style="text-indent:25px"> UPS</p></td>
        			<td align="center">'.strtoupper($new_batteries_ind_ups1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_ups2).'</td>
      		</tr>
      		<tr>
        			<td><div style="text-indent:25px">(b) Motive Power</div></td>
        			<td align="center">'.strtoupper($new_batteries_ind_mp1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_mp2).'</td>
      		</tr>
      		<tr>
        			<td><div style="text-indent:25px">(c) Stand-by</div></td>
        			<td align="center">'.strtoupper($new_batteries_ind_sb1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_sb2).'</td>
      		</tr>	
      		
      		<tr>
        			<td colspan="2">(iii) Others</td>
        			<td align="center">'.strtoupper($new_batteries_ind_ot1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_ot2).'</td>
      		</tr>
      		
      		<tr>
        			<td colspan="4"><i>Number of batteries sold to</i></td>
      		</tr>
      		
      		<tr>
        			<td colspan="2">(i) Dealers</td>
        			<td align="center">'.strtoupper($new_batteries_sold_d1).'</td>
        			<td align="center">'.strtoupper($new_batteries_sold_d2).'</td>
      		</tr>
      		<tr>
        			<td colspan="2">(ii) Bulk consumers</td>
        			<td align="center">'.strtoupper($new_batteries_sold_bc1).'</td>
        			<td align="center">'.strtoupper($new_batteries_sold_bc2).'</td>
      		</tr>
      		<tr>
        			<td colspan="2">(iii) OEM</td>
        			<td align="center">'.strtoupper($new_batteries_sold_oem1).'</td>
        			<td align="center">'.strtoupper($new_batteries_sold_oem2).'</td>
      		</tr>
      		
      		<tr>
        			<td colspan="2">(iv) To any other party</td>
        			<td align="center">'.strtoupper($new_batteries_sold_r1).'</td>
        			<td align="center">'.strtoupper($new_batteries_sold_r2).'</td>
      		</tr>
    		</table>
    		
    	</td>
   </tr>
  	<tr>
  		<td>4. Total numbers of used batteries of different categories as at Sl. No. 3 collected and sent to registered recyclers* / designated collection centers/ manufactures<br/>*Enclose the list of recyclers to whom batteries have been sent for recycling.</td>
		<td>'.strtoupper($tot_used_batteries).'</td>
  	</tr>
	';				
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
    <tr>      
		<td valign="top" >Place :'.strtoupper($dist).'<br/>
		Date : '.strtoupper($results["sub_date"]).'</td>
		<br/>
		<td align="right">'.strtoupper($key_person).'<br/>Signature of the authorized person</td>
    </tr>
    </table>
  ';   
?>