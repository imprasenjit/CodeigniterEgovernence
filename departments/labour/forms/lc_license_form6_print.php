<?php
$dept="labour";
$form="6";
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
		$fa_sp_name=$results['fa_sp_name'];$employer_name=$results['employer_name'];$dob_con=$results['dob_con'];$age_con=$results['age_con'];		
		$num_of_cert_reg=$results["num_of_cert_reg"];$date_of_cert_reg=$results["date_of_cert_reg"];		
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
<div style="text-align:center"><br/><br/>
  '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div>
 <table class="table table-bordered table-responsive">
  	<tr>
        <td width="50%"> 1.Name and address of the contractor (including his father&apos;/husband&apos; name in case of individuals) </td>
        <td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Full Name</td>
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
  		
    	<td>2. Date of birth and age (in case of individual) </td>
    	<td>(a) Date :'.strtoupper($dob_con).' &nbsp;(b) Age :'.strtoupper($age_con).'</td>
    		
	</tr>
	<tr>
		<td colspan="2">3.Particulars of establishment where migrant workmen are to be employed </td>      
	</tr>
   	<tr>  		
   	    <td>(a) Name and address of the establishment </td>
    	<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td> Full Name</td>
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
		<td>(b) Type of business, industry, manufacture or occupation, which is carried on in the establishment </td>
    	<td>'.strtoupper($business_type).'</td>
  	</tr>	
	<tr>
		<td colspan="2">(c)Number and date of certificate of registration of the establishment under the Act</td>
	</tr>
	<tr>
		<td>Number </td>
		<td>'.strtoupper($num_of_cert_reg).'</td>
	</tr> 
	<tr>
		<td>Date</td>
		<td>'.strtoupper($date_of_cert_reg).'</td>
	</tr> 
	<tr> 		
   	    <td>(d) Full name and address of the Principal Employer </td>
    	<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td> Full Name</td>
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
	     <td colspan="2">4. Particulars of contract labour </td>
    </tr>
	<tr>
		<td>(a) Nature of work in which contract labour is employed or is to be employed in the establishment </td>
		<td>'.strtoupper($contract_labour_a).'</td>
   	</tr>
   	<tr>
        <td>(b) Duration of the proposed contract work (give particulars of proposed date of commencing and ending) </td>
        <td>'.strtoupper($contract_labour_b).'</td>
	</tr>
	<tr>
        <td>(c) Name and Address of the Agent or Manager of Contractor at the work site </td>
        <td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td> Full Name</td>
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
   	    <td>5.	Whether the contractor was convicted of any offence within the preceding five years. If so, give details.</td>
    	<td>'.strtoupper($is_contractor_convict).'</td>
  	</tr> 	
  	<tr>  		
   	     <td>6.	Whether there was any order against the contractor revoking or suspending licence or forfeiting security deposit in respect of an earlier contract. If so, the date of such order. </td>
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
		<td colspan="2">Declaration : I  hereby  declare  that  the  details  given  above  are  correct  to  the best of my knowledge and belief.</td>
	</tr>	
	<tr>
		<td>Date: '.strtoupper($results["sub_date"]).'<br/><br/> Place: '.strtoupper($dist).'</td>
		<td align="center">'.strtoupper($key_person).'<br/>
			Signature of the Applicant<br/>(Contractor)  </td>
	</tr>     		
</table>';
?>