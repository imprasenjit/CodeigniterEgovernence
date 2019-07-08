<?php
$dept="labour";
$form="6";
$table_name=$formFunctions->getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($labour->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$labour->query("select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") or die($labour->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($labour->error);
	}else{
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($labour->error);
	}
    
    $email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$sector_classes_b=$row1['sector_classes_b'];
	$business_type=get_sector_classes_b_value($sector_classes_b);
	
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
   
    if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$fa_sp_name=$results['fa_sp_name'];$employer_name=$results['employer_name'];$dob_con=$results['dob_con'];$age_con=$results['age_con'];
		$max_workers=$results['max_workers'];$is_contractor_convict=$results['is_contractor_convict'];
		$is_contractor_revok=$results['is_contractor_revok'];$is_contractor_work=$results['is_contractor_work'];$is_cert_enclose=$results['is_cert_enclose'];
		if(!empty($results["contract_labour"])){
			$contract_labour=json_decode($results["contract_labour"]);
			$contract_labour_a=$contract_labour->a;$contract_labour_b=$contract_labour->b;
		}else{
			$contract_labour_a="";$contract_labour_b="";
		}		
		if(!empty($results["manager_address"])){
			$manager_address=json_decode($results["manager_address"]);
			$manager_address_name=$manager_address->name;$manager_address_sn1=$manager_address->sn1;$manager_address_sn2=$manager_address->sn2;$manager_address_vt=$manager_address->vt;$manager_address_dist=$manager_address->dist;$manager_address_pin=$manager_address->pin;
		}else{
			$manager_address_name="";$manager_address_sn1="";$manager_address_sn2="";$manager_address_vt="";$manager_address_dist="";$manager_address_pin="";
		}		
		if(!empty($results["employ_address"])){
			$employ_address=json_decode($results["employ_address"]);
			$employ_address_sn1=$employ_address->sn1;$employ_address_sn2=$employ_address->sn2;$employ_address_vt=$employ_address->vt;$employ_address_d=$employ_address->d;$employ_address_p=$employ_address->p;
		}else{
			$employ_address_sn1="";$employ_address_sn2="";$employ_address_vt="";$employ_address_d="";$employ_address_p="";
		}
		
		if($is_cert_enclose=="Y") $is_cert_enclose="YES";
		else $is_cert_enclose="NO";
	}
	
	$contract_labour_b= wordwrap($contract_labour_b, 40, "<br/>", true);
	$is_contractor_convict= wordwrap($is_contractor_convict, 40, "<br/>", true);
	$is_contractor_work= wordwrap($is_contractor_work, 40, "<br/>", true);
	
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
</style>
</head>
<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
<div style="text-align:center"><br/><br/>
  '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div>
 <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
  	<tr>
        <td width="50%" valign="top"> 1.Name and address of the contractor (including his father&apos;/husband&apos; name in case of individuals) </td>
        <td width="50%">
    		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
      		<tr>
        			<td width="50%">Full Name</td>
        			<td>'.strtoupper($key_person).'</td>
      		</tr>
      		<tr>
        			<td>Father/Spouse Name</td>
        			<td>'.strtoupper($fa_sp_name).'</td>
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
        			<td>E-MAIL ID</td>
        			<td>'.$email.'</td>
      		</tr>
      		
    		</table>
    	</td>
	</tr>
	
	
  	<tr>
  		
    	<td valign="top">2. Date of birth and age (in case of individual) </td>
    	<td>(a) Date :'.strtoupper($dob_con).' &nbsp;(b) Age :'.strtoupper($age_con).'</td>
    		
   </tr>
   <tr>
      <td colspan="2" valign="top">3.Particulars of establishment where migrant workmen are to be employed </td>
      
   </tr>
   	<tr>
  		
   	    <td width="50%" valign="top">(a) Name and address of the establishment </td>
    	<td>
    		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
      		<tr>
        			<td width="50%"> Full Name</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1 </td>
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
      		
    		</table>
    	</td>
  	</tr>
  	
  	
  	<tr>
  		
   	  <td valign="top">(b) Type of business, industry, manufacture or occupation, which is carried on in the establishment </td>
    	<td>'.strtoupper($business_type).'</td>
  	</tr>

	<tr>
  		
   	    <td valign="top">(c) Full name and address of the Principal Employer </td>
    	<td>
    		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
      		<tr>
        			<td width="50%"> Full Name</td>
        			<td>'.strtoupper($employer_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1 </td>
        			<td>'.strtoupper($employ_address_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($employ_address_sn2).'</td>
      		</tr>
      		
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($employ_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($employ_address_d).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($employ_address_p).'</td>
      		</tr>
      		
    		</table>
    	</td>
  	</tr>
  	

	<tr>
	     <td colspan="2" valign="top">4. Particulars of contract labour </td>
     </tr>

	<tr>
  		<td valign="top">(a) Nature of work in which contract labour is employed or is to be employed in the establishment </td>
   	     <td>'.strtoupper($contract_labour_a).'</td>

   	</tr>
   	<tr>
        <td>(b) Duration of the proposed contract work (give particulars of proposed date of commencing and ending) </td>
        <td>'.strtoupper($contract_labour_b).'</td>
        
     </tr>
     <tr>
        <td>(c) Name and Address of the Agent or Manager of Contractor at the work site </td>
        <td>
    		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
      		<tr>
        			<td width="50%"> Full Name</td>
        			<td>'.strtoupper($manager_address_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1 </td>
        			<td>'.strtoupper($manager_address_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($manager_address_sn2).'</td>
      		</tr>
      		
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($manager_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($manager_address_dist).'</td>
      		</tr>
      		<tr>
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($manager_address_pin).'</td>
      		</tr>
      		
    		</table>
    	</td>
    </tr>
    <tr>
        <td>(d) Maximum No. of contract labour proposed to be employed in the establishment on any date. </td>
        <td>'.strtoupper($max_workers).'</td>
    </tr>
  	<tr>
   	    <td valign="top">5.	Whether the contractor was convicted of any offence within the preceding five years. If so, give details.</td>
    	<td>'.strtoupper($is_contractor_convict).'</td>
  	</tr>
  	
  	<tr>
  		
   	     <td valign="top">6.	Whether there was any order against the contractor revoking or suspending licence or forfeiting security deposit in respect of an earlier contract. If so, the date of such order. </td>
   	     <td>'.strtoupper($is_contractor_revok).'</td>
    	
    </tr>
    <tr>
         <td>7. Whether the contractor has worked in any other establishment within the past five years. If so, give details of the Principal Employer, establishments and nature of work. </td>
     
        	<td>'.strtoupper($is_contractor_work).'</td>
     </tr>
     <tr>
            <td>8. Whether a certificate by the Principal Employer in Form V is enclosed. </td>
        	<td>'.strtoupper($is_cert_enclose).'</td>

    </tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
 
		<tr>
		    <td colspan="2"><p>Declaration : I  hereby  declare  that  the  details  given  above  are  correct  to  the best of my knowledge and belief.</p></td>
		</tr>
		<br>
    
	<tr>
		<td colspan="2">
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="0">
			<tr>
				<td align="left" width="60%">Date: '.strtoupper($results["sub_date"]).'<br/><br/> Place: '.strtoupper($dist).'</td>
				<td width="40%" align="center" >'.strtoupper($key_person).'<br/>
						Signature of the Applicant<br/>(Contractor)  </td>
			</tr>
		</table>
		</td>
    </tr>
	
    </table>';
?>