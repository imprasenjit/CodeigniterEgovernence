<?php
$dept="pcb";
$form="7";
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
	$total_batt_impt=$results["total_batt_impt"];$used_batteries=$results["used_batteries"];
	$form_id=$results['form_id'];
	if(!empty($results["new_batteries"])){
		$new_batteries=json_decode($results["new_batteries"]);
		$new_batteries_auto=$new_batteries->auto;$new_batteries_ind=$new_batteries->ind;$new_batteries_sold=$new_batteries->sold;
		$new_batteries_auto_fw1=$new_batteries_auto->fw1;$new_batteries_auto_fw2=$new_batteries_auto->fw2;
		$new_batteries_auto_tw1=$new_batteries_auto->tw1;$new_batteries_auto_tw2=$new_batteries_auto->tw2;
		$new_batteries_ind_ups1=$new_batteries_ind->ups1;$new_batteries_ind_ups2=$new_batteries_ind->ups2;
		$new_batteries_ind_mp1=$new_batteries_ind->mp1;$new_batteries_ind_mp2=$new_batteries_ind->mp2;
		$new_batteries_ind_sb1=$new_batteries_ind->sb1;$new_batteries_ind_sb2=$new_batteries_ind->sb2;
		$new_batteries_ind_ot1=$new_batteries_ind->ot1;$new_batteries_ind_ot2=$new_batteries_ind->ot2;
		$new_batteries_sold_d1=$new_batteries_sold->d1;$new_batteries_sold_d2=$new_batteries_sold->d2;
		$new_batteries_sold_bc1=$new_batteries_sold->bc1;$new_batteries_sold_bc2=$new_batteries_sold->bc2;
		$new_batteries_sold_oem1=$new_batteries_sold->oem1;$new_batteries_sold_oem2=$new_batteries_sold->oem2;
		$new_batteries_sold_r1=$new_batteries_sold->r1;$new_batteries_sold_r2=$new_batteries_sold->r2;
	}else{
		$new_batteries_auto_fw1="";$new_batteries_auto_fw2="";$new_batteries_auto_tw1="";$new_batteries_auto_tw2="";$new_batteries_ind_ups1="";$new_batteries_ind_ups2="";$new_batteries_ind_mp1="";$new_batteries_ind_mp2="";$new_batteries_ind_sb1="";$new_batteries_ind_sb2="";$new_batteries_ind_ot1="";$new_batteries_ind_ot2="";$new_batteries_sold_d1="";$new_batteries_sold_d2="";$new_batteries_sold_bc1="";$new_batteries_sold_bc2="";$new_batteries_sold_oem1="";$new_batteries_sold_oem2="";$new_batteries_sold_r1="";$new_batteries_sold_r2="";
	}			
	if(!empty($results["collection_center"])){
		$collection_center=json_decode($results["collection_center"]);
		$collection_center_name=$collection_center->name;$collection_center_s1=$collection_center->s1;$collection_center_s2=$collection_center->s2;$collection_center_vt=$collection_center->vt;$collection_center_d=$collection_center->d;$collection_center_pin=$collection_center->pin;$collection_center_mob_no=$collection_center->mob_no;$collection_center_ph_std=$collection_center->ph_std;$collection_center_ph_no=$collection_center->ph_no;
	}else{
		$collection_center_name="";$collection_center_s1="";$collection_center_s2="";$collection_center_vt="";$collection_center_d="";$collection_center_pin="";$collection_center_mob_no="";$collection_center_ph_std="";$collection_center_ph_no="";
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
  			<td valign="top" style="width:50%">1. Name and address of the	Importer</td>
    		<td style="width:50%">
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
        			<td>Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).''.strtoupper($b_landline_no).'</td>
      		</tr>
      		
      		<tr>
        			<td>Email-id</td>
        			<td>'.$b_email.'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
  	<tr>
    	<td valign="top">2. Name and address of the authorized person with telephone and fax number</td>
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
		<td valign="top">3. Number of batteries imported during the period from October to March and April to September</td>
		<td>'.strtoupper($total_batt_impt).'</td>
  	</tr>
  	<tr>
    	<td colspan="2">4.Total number of new batteries sold during the period October-March/ April-September in respect of the following category :-<br/>
		<table class="table table-bordered table-responsive">
           
      		<tr align="center">
        			<td><i>Category:</i></td>
        			<td>(i) No. of Batteries</td>
        			<td>(ii)Approximate weight (in Metric Tones)</td>
      		</tr>
      		<tr>
        			<td>(i) Automotive<br/><p style="text-indent:25px">(a) four wheeler</p></td>
        			<td align="center">'.strtoupper($new_batteries_auto_fw1).'</td>
        			<td align="center">'.strtoupper($new_batteries_auto_fw2).'</td>
      		</tr>
      		<tr>
        			<td><div style="text-indent:25px">(b) two wheeler</div></td>
        			<td align="center">'.strtoupper($new_batteries_auto_tw1).'</td>
        			<td align="center">'.strtoupper($new_batteries_auto_tw2).'</td>
      		</tr>

				<tr>
        			<td>(ii) Industrial<br/><p style="text-indent:25px">(a) UPS</p></td>
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
        			<td>(iii) Others</td>
        			<td align="center">'.strtoupper($new_batteries_ind_ot1).'</td>
        			<td align="center">'.strtoupper($new_batteries_ind_ot2).'</td>
      		</tr>
      		
      		<tr>
        			<td colspan="3"><i>Number of batteries sold to</i></td>
      		</tr>
      		
      		<tr>
        			<td>(i) Dealers</td>
        			<td align="center">'.strtoupper($new_batteries_sold_d1).'</td>
        			<td align="center">'.strtoupper($new_batteries_sold_d2).'</td>
      		</tr>
      		<tr>
        			<td>(ii) Bulk consumers</td>
        			<td align="center">'.strtoupper($new_batteries_sold_bc1).'</td>
        			<td align="center">'.strtoupper($new_batteries_sold_bc2).'</td>
      		</tr>
      		<tr>
        			<td>(iii) OEM</td>
        			<td align="center">'.strtoupper($new_batteries_sold_oem1).'</td>
        			<td align="center">'.strtoupper($new_batteries_sold_oem2).'</td>
      		</tr>
      		<tr>
        			<td>(iv) Any other party for replacement</td>
        			<td align="center">'.strtoupper($new_batteries_sold_r1).'</td>
        			<td align="center">'.strtoupper($new_batteries_sold_r2).'</td>
      		</tr>
    		</table>
    	</td>
   </tr>
   <tr>
  		<td valign="top">5. Name and full address of the designated collection center</td>
  		<td>
  		<table class="table table-bordered table-responsive">
          
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($collection_center_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($collection_center_s1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($collection_center_s2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($collection_center_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($collection_center_d).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($collection_center_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($collection_center_mob_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($collection_center_ph_std).' - '.strtoupper($collection_center_ph_no).'</td>
      		</tr>
    		</table>
    		</td>
  	</tr>
  	<tr>
  		<td valign="top">6. Total numbers of used batteries of different categories as at Sl. No. 3 collected and sent to registered recyclers <br/> *Enclose a complete list.</td>
  		<td>'.strtoupper($results["used_batteries"]).'</td>
  	</tr>
	';				
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
              
     <tr>
  		<td valign="top">Place :'.strtoupper($dist).'<br/>
  		Date : '.strtoupper($results["sub_date"]).'</td>
  		<td align="right">'.strtoupper($key_person).' <br/>
		Signature of the authorized person</td>
  	</tr>
  	</table>';
?>