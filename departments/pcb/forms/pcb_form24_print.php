<?php
$dept="pcb";
$form="24";
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
	
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where  user_id='$swr_id' and active='1'");
if($q->num_rows>0){
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];	
	$production =$results["production"];$is_generator =$results["is_generator"];$total_waste =$results["total_waste"];$disposal =$results["disposal"];$recycler =$results["recycler"];$others =$results["others"];$utilised =$results["utilised"];$storage =$results["storage"];$is_operator =$results["is_operator"];$total_quantity =$results["total_quantity"];$Stock_quantity =$results["Stock_quantity"];$quantity_treated =$results["quantity_treated"];$quantity_disposed =$results["quantity_disposed"];$incinerated_q =$results["incinerated_q"];$processed_q =$results["processed_q"];$storage_q =$results["storage_q"];$is_recycler =$results["is_recycler"];$dom_src =$results["dom_src"];$imported =$results["imported"];$stock_q_begin =$results["stock_q_begin"];$recycled_q =$results["recycled_q"];$dispatched_q =$results["dispatched_q"];$waste_q_gen =$results["waste_q_gen"];$disposed_q =$results["disposed_q"];$re_exported_q =$results["re_exported_q"];$storage_q_recyle =$results["storage_q_recyle"];
	
	if(!empty($results["ren_auth"])){
		$ren_auth=json_decode($results["ren_auth"]);
		$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
	}else{
		$ren_auth_no="";$ren_auth_dt="";
	}
	if($is_generator=="Y") $is_generator="YES";
		else $is_generator="NO";
	if($is_operator=="Y") $is_operator="YES";
		else $is_operator="NO";
	if($is_recycler=="Y") $is_recycler="YES";
		else $is_recycler="NO";
	$production = wordwrap($production, 50, "<br/>", true);
	$total_waste = wordwrap($total_waste, 50, "<br/>", true);
}

$form_name=$formFunctions->get_formName($dept,$form);
//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form I'.$form.'</title>
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
        <td valign="top" style="width:50%">1. Name and address of facility :</td>
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
        			<td>Vill/Town</td>
        			<td>'.strtoupper($b_vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($b_dist).'</td>
      		</tr>
      		<tr>
        			<td height="29">Pincode</td>
        			<td>'.$b_pincode.'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.$b_mobile_no.'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.$b_landline_std.' '.$b_landline_no.'</td>
      		</tr>
			<tr>
					<td>Email ID</td>
					<td>'.$b_email.'</td>
			</tr>
    		</table>
    	</td>
	</tr>
  	<tr>
		<td valign="top" colspan="2">2. Authorisation No. and Date of issue:</td>
  	</tr>
	<tr>
		<td>(a) Authorization No:</td>
		<td>'.strtoupper($ren_auth_no).'</td>
	</tr>
	<tr>
		<td>(b) Date of issue:</td>
		<td>'.$ren_auth_dt.'</td>
	</tr>
	
	<tr>
        <td valign="top" style="width:50%">3. Name of the authorised person and full address with telephone, fax number and e-mail:</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td >Name </td>
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
        			<td >Email Id</td>
        			<td>'.$email.'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
  	<tr>
    	<td valign="top">4. Production during the year (product wise), wherever applicable:</td>
    	<td>
            '.strtoupper($production).'<br/>
    	</td>
  	</tr>
	<tr>
		<td colspan="2" style="text-align:center;"><b>Part A. To be filled by hazardous waste generators</b></td>
	</tr>
	<tr>
		<td>Are you a Generator of Hazardous Waste?</td>
		<td>'.strtoupper($is_generator).'</td>
	</tr>
	';
	if($is_generator=="YES"){
		$printContents=$printContents.'
  	<tr>
    	<td valign="top">1. Total quantity of waste generated category wise:</td>
    	<td>'.strtoupper($total_waste).'</td>
  	</tr>
    <tr>
        <td valign="top" colspan="2">2. Quantity dispatched:</td>
  	</tr>
	<tr>
        <td valign="top">(i) To disposal facility:</td>
    	<td>'.strtoupper($disposal).'</td>
  	</tr>
    <tr>
    	<td valign="top">(ii) To recycler or co-processors or pre-processor:</td>
    	<td>'.strtoupper($recycler).'</td>
  	</tr>
	<tr>
    	<td valign="top" >(iii) Others:</td>
    	<td>'.strtoupper($others).'</td>
  	</tr>
	<tr>
    	<td valign="top">3. Quantity utilised in-house, if any :</td>
    	<td>'.strtoupper($utilised).'</td>
  	</tr>
	<tr>
    	<td valign="top">4. Quantity in storage at the end of the year :</td>
    	<td>'.strtoupper($storage).'</td>
  	</tr>';
			}
			$printContents=$printContents.'
	<tr>
		<td colspan="2" style="text-align:center;"><b>Part B. To be filled by Treatment, storage and disposal facility operators</b></td>
	</tr>
	<tr>
		<td>Are you a Treatment, storage and disposal facility operators?</td>
		<td>'.strtoupper($is_operator).'</td>
	</tr>
	';
	if($is_operator=="YES"){
		$printContents=$printContents.'
	<tr>
    	<td valign="top">1. Total quantity received :</td>
    	<td>'.strtoupper($total_quantity).'</td>
  	</tr>
	<tr>
    	<td valign="top">2. Quantity in stock at the beginning of the year :</td>
    	<td>'.strtoupper($Stock_quantity).'</td>
  	</tr>
	<tr>
    	<td valign="top">3. Quantity treated :</td>
    	<td>'.strtoupper($quantity_treated).'</td>
  	</tr>
	<tr>
    	<td valign="top">4. Quantity disposed in landfills as such and after treatment :</td>
    	<td>'.strtoupper($quantity_disposed).'</td>
  	</tr>
	<tr>
    	<td valign="top">5. Quantity incinerated (if applicable) :</td>
    	<td>'.strtoupper($incinerated_q).'</td>
  	</tr>
	<tr>
    	<td valign="top">6. Quantity processed other than specified above :</td>
    	<td>'.strtoupper($processed_q).'</td>
  	</tr>
	<tr>
    	<td valign="top">7. Quantity in storage at the end of the year :</td>
    	<td>'.strtoupper($storage_q).'</td>
  	</tr>';
			}
			$printContents=$printContents.'
	<tr>
		<td colspan="2" style="text-align:center;"><b>Part C. To be filled by recyclers or co-processors or other users</b></td>
	</tr>
	<tr>
		<td>Are you a recyclers or co-processors or other users?</td>
		<td>'.strtoupper($is_recycler).'</td>
	</tr>
	';
	if($is_recycler=="YES"){
		$printContents=$printContents.'
    <tr>
    	<td valign="top" colspan="2">1. Quantity of waste received during the year :</td>
  	</tr>
  	 <tr>
    	<td valign="top" >(i) Domestic sources :</td>
		<td>'.strtoupper($dom_src).'</td>
  	</tr>
	 <tr>
    	<td valign="top" >(ii) Imported (if applicable) :</td>
		<td>'.strtoupper($imported).'</td>
  	</tr>
	 <tr>
    	<td valign="top">2. Quantity in stock at the beginning of the year :</td>
		<td>'.strtoupper($stock_q_begin).'</td>
  	</tr>
    <tr>
    	<td valign="top">3. Quantity recycled or co-processed or used :</td>
		<td>'.strtoupper($recycled_q).'</td>
  	</tr>
  	 <tr>
    	<td valign="top">4. Quantity of products dispatched (wherever applicable) :</td>
		<td>'.strtoupper($dispatched_q).'</td>
  	</tr>
	 <tr>
    	<td valign="top">5. Quantity of waste generated :</td>
		<td>'.strtoupper($waste_q_gen).'</td>
  	</tr>
	 <tr>
    	<td valign="top">6. Quantity of waste disposed :</td>
		<td>'.strtoupper($disposed_q).'</td>
  	</tr>
	<tr>
		<td valign="top">7. Quantity re-exported (wherever applicable) :</td>
		<td>'.strtoupper($re_exported_q).'</td>
	</tr>
	<tr>
    	<td valign="top">8. Quantity in storage at the end of the year :</td>
		<td>'.strtoupper($storage_q_recyle).'</td>
  	</tr>';		
	}
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
	<tr>
		<td>Date: <label>'.date('d-m-Y',strtotime($today)).'</label><br/>
			Place: <label>'.strtoupper($dist).'</label></td>
		<td align="right">
			<b>'.strtoupper($key_person).'</b><br/>
				Signature of the Occupier or <br/>Operator of the disposal facility               
		   </td>
	</tr>        
    </tbody>
	</table>';
?>