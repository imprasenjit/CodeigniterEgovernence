<?php
$dept="pcb";
$form="4";
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
	$form_id=$results['form_id'];$used_bat=$results['used_bat'];
	$submitted_by=$results['submitted_by'];
	$submitted_by_array=Array();
	$submitted_by_array=explode(",", $submitted_by);
	if(in_array("M",$submitted_by_array)) $submitted_by_a="Manufacture"; else $submitted_by_a="";
	if(in_array("A",$submitted_by_array)) $submitted_by_b="Assembler"; else $submitted_by_b="";
	if(in_array("R",$submitted_by_array)) $submitted_by_c="Reconditioner"; else $submitted_by_c="";
	if($submitted_by_a!="" && $submitted_by_b=="" && $submitted_by_c=="") $unit_type_value=$submitted_by_a;
	if($submitted_by_a=="" && $submitted_by_b!="" && $submitted_by_c=="") $unit_type_value=$submitted_by_b;
	if($submitted_by_a=="" && $submitted_by_b=="" && $submitted_by_c!="") $unit_type_value=$submitted_by_c;

	if($submitted_by_a!="" && $submitted_by_b!="" && $submitted_by_c=="") $unit_type_value=$submitted_by_a." , ".$submitted_by_b;
	if($submitted_by_a=="" && $submitted_by_b!="" && $submitted_by_c!="") $unit_type_value=$submitted_by_b." , ".$submitted_by_c;
	if($submitted_by_a!="" && $submitted_by_b=="" && $submitted_by_c!="") $unit_type_value=$submitted_by_a." , ".$submitted_by_c;
	if($submitted_by_a!="" && $submitted_by_b!="" && $submitted_by_c!="") $unit_type_value=$submitted_by_a." , ".$submitted_by_b." , ".$submitted_by_c;
		
	if(!empty($results["total_no_batteries"])){			
		$total_no_batteries=json_decode($results["total_no_batteries"]);
		$total_no_batteries_auto=$total_no_batteries->auto;$total_no_batteries_ind=$total_no_batteries->ind;$total_no_batteries_sold=$total_no_batteries->sold;
		$total_no_batteries_auto_fw1=$total_no_batteries_auto->fw1;$total_no_batteries_auto_fw2=$total_no_batteries_auto->fw2;
		$total_no_batteries_auto_tw1=$total_no_batteries_auto->tw1;$total_no_batteries_auto_tw2=$total_no_batteries_auto->tw2;
		$total_no_batteries_ind_ups1=$total_no_batteries_ind->ups1;$total_no_batteries_ind_ups2=$total_no_batteries_ind->ups2;
		$total_no_batteries_ind_mp1=$total_no_batteries_ind->mp1;$total_no_batteries_ind_mp2=$total_no_batteries_ind->mp2;
		$total_no_batteries_ind_sb1=$total_no_batteries_ind->sb1;$total_no_batteries_ind_sb2=$total_no_batteries_ind->sb2;
		$total_no_batteries_ind_ot1=$total_no_batteries_ind->ot1;$total_no_batteries_ind_ot2=$total_no_batteries_ind->ot2;
		$total_no_batteries_sold_d1=$total_no_batteries_sold->d1;$total_no_batteries_sold_d2=$total_no_batteries_sold->d2;
		$total_no_batteries_sold_bc1=$total_no_batteries_sold->bc1;$total_no_batteries_sold_bc2=$total_no_batteries_sold->bc2;
		$total_no_batteries_sold_oem1=$total_no_batteries_sold->oem1;$total_no_batteries_sold_oem2=$total_no_batteries_sold->oem2;
		$total_no_batteries_sold_any1=$total_no_batteries_sold->any1;$total_no_batteries_sold_any2=$total_no_batteries_sold->any2;
	}else{
		$total_no_batteries_auto_fw1="";$total_no_batteries_auto_fw2="";$total_no_batteries_auto_tw1="";$total_no_batteries_auto_tw2="";$total_no_batteries_ind_ups1="";$total_no_batteries_ind_ups2="";$total_no_batteries_ind_mp1="";$total_no_batteries_ind_mp2="";$total_no_batteries_ind_sb1="";$total_no_batteries_ind_sb2="";$total_no_batteries_ind_ot1="";$total_no_batteries_ind_ot2="";$total_no_batteries_sold_d1="";$total_no_batteries_sold_d2="";$total_no_batteries_sold_bc1="";$total_no_batteries_sold_bc2="";$total_no_batteries_sold_oem1="";$total_no_batteries_sold_oem2="";$total_no_batteries_sold_any1="";$total_no_batteries_sold_any2="";
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
			<td>1. Name and address of the	'.strtoupper($unit_type_value).'</td>
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
							<td>'.strtoupper($b_landline_std).'&nbsp;'.strtoupper($b_landline_no).'</td>
					</tr>
					
					<tr>
							<td>Email-id</td>
							<td>'.$b_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">2. Name of the authorized person and complete address with telephone and fax number</td>
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
							<td>Mobile No.</td>
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
		<td valign="top">3. Total number of new batteries sold during the period October-March/ April-September in respect of the following category :</td>
		<td>
			<table class="table table-bordered table-responsive">
      		<tr align="center">
        			<td><i>Category:</i></td>
        			<td>(i) No. of Batteries</td>
        			<td>(ii)Approximate weight (in Metric Tones)</td>
      		</tr>
      		<tr>
        			<td colspan="3">(i) Automotive<br/></td>
			</tr>
			<tr>
					<td><p style="text-indent:25px">(a) four wheeler</p></td>
        			<td align="center">'.strtoupper($total_no_batteries_auto_fw1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_auto_fw2).'</td>
      		</tr>
      		<tr>
        			<td><div style="text-indent:25px">(b) two wheeler</div></td>
        			<td align="center">'.strtoupper($total_no_batteries_auto_tw1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_auto_tw2).'</td>
      		</tr>

			<tr>
        			<td colspan="3">(ii) Industrial<br/></td>
			</tr>
			<tr>
					<td><p style="text-indent:25px">(a) UPS</p></td>
        			<td align="center">'.strtoupper($total_no_batteries_ind_ups1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_ind_ups2).'</td>
      		</tr>
      		<tr>
        			<td><div style="text-indent:25px">(b) Motive Power</div></td>
        			<td align="center">'.strtoupper($total_no_batteries_ind_mp1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_ind_mp2).'</td>
      		</tr>
      		<tr>
        			<td><div style="text-indent:25px">(c) Stand-by</div></td>
        			<td align="center">'.strtoupper($total_no_batteries_ind_sb1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_ind_sb2).'</td>
      		</tr>	
      		
      		<tr>
        			<td>(iii) Others (inverters, etc)</td>
        			<td align="center">'.strtoupper($total_no_batteries_ind_ot1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_ind_ot2).'</td>
      		</tr>
      	  </table>
    	</td>
   </tr>	
			
	<tr>
		<td valign="top">(i)Number of batteries sold to</td>
		<td>
			<table class="table table-bordered table-responsive">
      		
      		<tr>
        			<td>(i) Dealers</td>
        			<td align="center">'.strtoupper($total_no_batteries_sold_d1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_sold_d2).'</td>
      		</tr>
      		<tr>
        			<td>(ii) Bulk consumers</td>
        			<td align="center">'.strtoupper($total_no_batteries_sold_bc1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_sold_bc2).'</td>
      		</tr>
      		<tr>
        			<td>(iii) OEM</td>
        			<td align="center">'.strtoupper($total_no_batteries_sold_oem1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_sold_oem2).'</td>
      		</tr>
      		
      		<tr>
        			<td>(iv) Any other party for replacement should be indicated separately</td>
        			<td align="center">'.strtoupper($total_no_batteries_sold_any1).'</td>
        			<td align="center">'.strtoupper($total_no_batteries_sold_any2).'</td>
      		</tr>
    		</table>
    		
    	</td>
   </tr>
   
   <tr>
  		<td valign="top">4. Name and full address of the designated collection centers</td>
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
        			<td>'.strtoupper($collection_center_ph_std).'&nbsp;'.strtoupper($collection_center_ph_no).'</td>
      		</tr>
    		</table>
    		</td>
  	</tr>
	<tr>
		<td>5. Total numbers of used batteries of different categories as at Sl. No. 3 collected and sent to registered recyclers.</td>
		<td>'.strtoupper($used_bat).'</td>
	</tr>
	';				
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
		<tr>
			<td>Place: '.strtoupper($dist).'<br/><br/> Date : '.strtoupper($results["sub_date"]).'</td>
			<td align="right">Yours faithfully,<br/><br/>
				Signature : &nbsp; &nbsp; '.strtoupper($key_person).'<br/>
				Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.strtoupper($key_person).'<br/>
				Designation : &nbsp;'.strtoupper($status_applicant).'
			</td>
        </tr>
    </tbody>
</table>';
?>