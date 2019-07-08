<?php
$dept="pcb";
$form="40";
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
	$capacity=$results["capacity"];$tecno=$results["tecno"];$quantity=$results["quantity"];$qty_sent=$results["qty_sent"];
	$form_id=$results['form_id'];
	if(!empty($results["officer"])){
		$officer=json_decode($results["officer"]);
		$officer_name=$officer->name;$officer_std_no=$officer->std_no;$officer_land_no=$officer->land_no;$officer_mob_no=$officer->mob_no;$officer_email=$officer->email;
	}else{
		$officer_name="";$officer_std_no="";$officer_land_no="";$officer_mob_no="";$officer_mob_no="";
	}
	if(!empty($results["qty_p_w"])){
		$qty_p_w=json_decode($results["qty_p_w"]);
		$qty_p_w_recycled=$qty_p_w->recycled;$qty_p_w_processed=$qty_p_w->processed;$qty_p_w_used=$qty_p_w->used;
	}else{
		$qty_p_w_recycled="";$qty_p_w_processed="";$qty_p_w_used="";
	}
	if(!empty($results["facility"])){
		$facility=json_decode($results["facility"]);
		$facility_s1=$facility->s1;$facility_s2=$facility->s2;$facility_vt=$facility->vt;$facility_d=$facility->d;$facility_pin=$facility->pin;$facility_mob_no=$facility->mob_no;$facility_ph_std=$facility->ph_std;$facility_ph_no=$facility->ph_no;
	}else{
		$facility_s1="";$facility_s2="";$facility_vt="";$facility_d="";$facility_pin="";$facility_mob_no="";$facility_ph_std="";$facility_ph_no="";
	}		
}
 $form_name=$formFunctions->get_formName($dept,$form);
// $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
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
			<td colspan="2" align="center"><b>Period of Reporting</b></td>
		</tr>	
		<tr>
			<td>1. Name and Address of operator of the facility</td>
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
						<td>Mobile No</td>
						<td>'.strtoupper($mobile_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2. Name of officer in-charge of the facility (Telephone/Mobile/E-mail)</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr>
					<td>Name Officer In-charge</td>										
					<td>'.strtoupper($officer_name).'</td>
				</tr>
				<tr>
					<td>Telephone Number</td>
					<td >'.strtoupper($officer_std_no).'-'.strtoupper($officer_land_no).'</td>	
				</tr>
				<tr>
					<td>Mobile</td>										
					<td>'.strtoupper($officer_mob_no).'</td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td>'.$officer_email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>3. Capacity</td>
			<td>'.strtoupper($capacity).'</td>
		</tr>
		<tr>
			<td>4. Technologies used for management of plastic waste</td>
			<td>'.strtoupper($tecno).'</td>
		</tr>
		<tr>
			<td>5. Quantity of plastic waste received during the year being reported upon along with the source</td>
			<td>'.strtoupper($quantity).'</td>
		</tr>
		<tr>
			<td>6. Quantity of plastic waste processed (in tons)</td>
			<td>(i) Plastic waste recycled(in tons) :'.strtoupper($qty_p_w_recycled).'<br/>
				(ii) Plastic waste processed (in tons): '.strtoupper($qty_p_w_processed).'<br/>
				(iii) Used (in tons) : '.strtoupper($qty_p_w_used).'
			</td>
		</tr>
		<tr>
			<td>7. Quantity of inert or rejects sent for final disposal to landfill sites</td>
			<td>'.strtoupper($qty_sent).'</td>
		</tr>
		<tr>
			<td>8. Details of land fill facility to which inert or rejects were sent for final disposal</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($facility_s1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($facility_s2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($facility_vt).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($facility_d).'</td>
				</tr>
				<tr>									
					<td>Pincode</td>
					<td>'.strtoupper($facility_pin).'</td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>'.strtoupper($facility_mob_no).'</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td>'.strtoupper($facility_ph_std).'-'.strtoupper($facility_ph_no).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>9. Attach status of compliance to environmental conditions, if any specified during grant of Consent or registration</td>
			<td >Document is attached</td>
		</tr>';

		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
		<tr>
			<td>Date :<b> '.date('d-m-Y',strtotime($today)).'</b><br/>
			Place : <b>'.strtoupper($dist).'</b></td>										
			<td align="right">Signature of the Operator :<b>'.strtoupper($key_person).'</b></td>
		</tr>
  	</table>';  