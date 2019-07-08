<?php
$dept="labour";
$form="7";
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
	
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Email : ".$email;
	
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$owner_type=$row1['Type_of_ownership'];$date_of_commencement=$row1['date_of_commencement'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($q->num_rows>0){
			$results=$q->fetch_assoc();
			$form_id=$results["form_id"];$fa_sp_name=$results["fa_sp_name"];$dob_con=$results["dob_con"];$age_con=$results["age_con"];$type_of_business=$results["type_of_business"];
			$cont_offence=$results["cont_offence"];$dob3=$results["dob3"];$work_con=$results["work_con"];$enclosed_cert=$results["enclosed_cert"];$max_workers=$results["max_workers"];
					
			if(!empty($results["manager"])){				
				$manager=json_decode($results["manager"]);
				$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;//error 
				$manager_p=$manager->p;				
			}else{
				$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
			}
			if(!empty($results["mig_workmen"])){				
				$mig_workmen=json_decode($results["mig_workmen"]);
				$mig_workmen_a=$mig_workmen->a;$mig_workmen_b=$mig_workmen->b;
			}else{
				$mig_workmen_a="";$mig_workmen_b="";
			}	
	}
	$mig_workmen_b= wordwrap($mig_workmen_b, 40, "<br/>", true);
	$cont_offence = wordwrap($cont_offence, 40, "<br/>", true);
	$work_con = wordwrap($work_con, 40, "<br/>", true);  
	
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
	<br/>
  	<div style="text-align:center">
  	    '.$assamSarkarLogo.'<h4 align="center">'.$form_name.'</h4>
    </div>
		<br>
            <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
         
                <tr>
                    <td width="50%" rowspan="9" valign="top">1. Name and address of the contractor (including his father&apos;s/husband&apos;s name in case of individuals) </td>
					<td width="25%">Full Name </td>
                    <td width="25%">'.strtoupper($key_person).'</td>
                </tr>
				<tr>
                                <td>Father&apos;s Name </td>
                                <td>'.strtoupper($fa_sp_name).'</td>
                </tr>
				<tr>
                                <td>Street Name 1 </td>
                                <td>'.strtoupper($street_name1).'</td>
                </tr>
				<tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($street_name2).'</td>
                </tr>
                <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($vill).'</td>
                </tr>
                <tr>
                                <td>District </td>
                                <td>'.strtoupper($dist).'</td>
                </tr>
                <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($pincode).'</td>
                </tr>
				<tr>
					<td>Mobile No.</td>
					<td>'.$mobile_no.'</td>
				</tr>
				<tr>
					<td>Email ID</td>
					<td>'.$email.'</td>
				</tr>
                <tr>
                    <td  valign="top">2. Date of birth and age (in case of individual) </td>
                    <td>Date : '.strtoupper($dob_con).'</td>
                    <td>Age : '.strtoupper($age_con).'</td>
                </tr> 
				<tr>
				<td colspan="3" height="40px"><b>3.	Particulars of establishment where migrant workmen are to be employed 		</b>	</td>
				</tr>
				<tr>
                    <td  rowspan="6" valign="top"> (a) Name and address of the establishment </td>
					<td >Full Name </td>
                    <td>'.strtoupper($unit_name).'</td>
                </tr>				
				<tr>
                                <td>Street Name 1 </td>
                                <td>'.strtoupper($b_street_name1).'</td>
                </tr>
				<tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($b_street_name2).'</td>
                </tr>
                <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($b_vill).'</td>
                </tr>
                <tr>
                                <td>District </td>
                                <td>'.strtoupper($b_dist).'</td>
                </tr>
                <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($b_pincode).'</td>
                </tr>
				<tr>
                    <td  valign="top">(b) Type of business, industry, manufacture or occupation, which is carried on in the establishment </td>
                    <td colspan="2">'.strtoupper($type_of_business).'</td>
                </tr> 
			
				<tr>
                    <td  rowspan="6" valign="top"> (c) Full name and address of the Principal Employer </td>
					<td >Full Name </td>
                    <td >'.strtoupper($key_person).'</td>
                </tr>				
				<tr>
                                <td>Street Name 1 </td>
                                <td>'.strtoupper($street_name1).'</td>
                </tr>
				<tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($street_name2).'</td>
                </tr>
                <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($vill).'</td>
                </tr>
                <tr>
                                <td>District </td>
                                <td>'.strtoupper($dist).'</td>
                </tr>
                <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($pincode).'</td>
                </tr>
				<tr>
				<td colspan="3" height="40px" ><b>4. Particulars of migrant workmen </b></td>
				</tr>
				<tr>
                    <td  valign="top">(a) Nature of work in which migrant workmen are employed or are to be employed in the establishment </td>
                    <td colspan="2">'.strtoupper($mig_workmen_a).'</td>
                </tr>
				<tr>
                    <td  valign="top">(b) Duration of the proposed contract work (give particulars of proposed date of commencing and ending) </td>
                    <td colspan="2">'.strtoupper($mig_workmen_b).'</td>
                </tr>
				<tr>
                    <td  rowspan="6" valign="top"> (c) Name and address of the agent or manager of the contractor at the work site and exact location of the work site </td>
					<td >Full Name </td>
                    <td >'.strtoupper($manager_name).'</td>
                </tr>				
				<tr>
                                <td>Street Name 1 </td>
                                <td>'.strtoupper($manager_sn1).'</td>
                </tr>
				<tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($manager_sn2).'</td>
                </tr>
                <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($manager_v).'</td>
                </tr>
                <tr>
                                <td>District </td>
                                <td>'.strtoupper($manager_d).'</td>
                </tr>
                <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($manager_p).'</td>
                </tr>
				<tr>
                    <td  valign="top">(d) Maximum number of migrant workmen proposed to be employed in the establishment on any date </td>
                    <td colspan="2">'.strtoupper($max_workers).'</td>
                </tr>
		<tr>
		<td colspan="3">
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<thead>
		<tr><td colspan="7" height="40px"><strong>(e) Names and address of the Directors/Partners in case of companies and firms </strong></td></tr>
		<tr><td>Sl No.</td>
		<td>Full Name</td>
		<td>Street Name 1</td>
		<td>Street Name 2</td>
		<td>Town/Vill</td>
		<td>District</td>
		<td>Pin Code</td>
		</tr></thead>	
		<tbody>';		
		$part1=$labour->query("SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
		while($row_1=$part1->fetch_array()){
		$printContents=$printContents.'
			<tr>
				<td>'.strtoupper($row_1["field1"]).'</td>
				<td>'.strtoupper($row_1["field2"]).'</td>
				<td>'.strtoupper($row_1["field3"]).'</td>
				<td>'.strtoupper($row_1["field4"]).'</td>
				<td>'.strtoupper($row_1["field5"]).'</td>
				<td>'.strtoupper($row_1["field6"]).'</td>
				<td>'.strtoupper($row_1["field7"]).'</td>
				</tr>';
		}
		$printContents=$printContents.'
		</tbody>
		</table>
			</td>                              
		</tr>
		
		<tr>
		<td colspan="3">		
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<thead>
		<tr><td colspan="7" height="40px"><strong>(f)	Name(s) and address (es) of the person (s) in-charge of and responsible to the Company/firm for the conduct of the business of the company/firm, as the case may be.</strong></td></tr>
		<tr><td>Sl No.</td>
		<td>Full Name</td>
		<td>Street Name 1</td>
		<td>Street Name 2</td>
		<td>Town/Vill</td>
		<td>District</td>
		<td>Pin Code</td>
		</tr></thead>
		<tbody>';		
		$part1=$labour->query("SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
		while($row_1=$part1->fetch_array()){
		$printContents=$printContents.'
			<tr>
				<td>'.strtoupper($row_1["field1"]).'</td>
				<td>'.strtoupper($row_1["field2"]).'</td>
				<td>'.strtoupper($row_1["field3"]).'</td>
				<td>'.strtoupper($row_1["field4"]).'</td>
				<td>'.strtoupper($row_1["field5"]).'</td>
				<td>'.strtoupper($row_1["field6"]).'</td>
				<td>'.strtoupper($row_1["field7"]).'</td>
			</tr>';
		}
		$printContents=$printContents.'
		</tbody>
		</table>					
		</td>
        </tr>	
		<tr>
				<td  valign="top">5. Whether the contractor was convicted of any offence within the preceding five years. If so, give details </td>
                <td colspan="2">'.strtoupper($cont_offence).'</td>
        </tr>
				<tr>
                    <td  valign="top">6. Whether there was any order against the contractor revoking or suspending licence or forfeiting security deposits in respect of an earlier contract, if so, the date of such order </td>
                    <td colspan="2">'.strtoupper($dob3).'</td>
                </tr>
				<tr>
                    <td  valign="top">7. Whether the Contractor has worked in any other establishment within the past five years. If so, give details of the principal employer establishment and nature of work </td>
                    <td colspan="2">'.strtoupper($work_con).'</td>
                </tr>
				<tr>
                    <td  valign="top">8. Whether a certificate by the principal employer in Form-VI is enclosed </td>
                    <td colspan="2">'.strtoupper($enclosed_cert).'</td>
                </tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			
            <tr>
				<td width="50%">Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
				<td align="center" colspan="2">'.strtoupper($key_person).'</td>
		   </tr>  
		   <tr>
				<td>Place : '.strtoupper($vill).'</td>
				<td colspan="2" align="center">Signature of the Applicant (Contractor)</td>
		   </tr> 
	
</table>';
?>