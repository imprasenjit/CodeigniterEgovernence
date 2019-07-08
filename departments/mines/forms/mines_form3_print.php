<?php
$dept="mines";
$form="3";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and active='1' and form_id=form_id");
}
	
	
	
	
	if($q->num_rows >0){
	$results=$q->fetch_array();
          $form_id=$results["form_id"];
		  $profession=$results["profession"];$p_renewal=$results["p_renewal"];$Reasons_pros_lic=$results["Reasons_pros_lic"];$arrr_renewal=$results["arrr_renewal"];$area_renewal=$results["area_renewal"];$nature=$results["nature"];$is_residential=$results["is_residential"];$is_renewal=$results["is_renewal"];$prospecting_lic=$results["prospecting_lic"];	
			
		  if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}				
			if(!empty($results["clearance"])){
				$clearance=json_decode($results["clearance"]);
				$clearance_dt=$clearance->dt;$clearance_num=$clearance->num;
			}else{				
				$clearance_dt="";$clearance_num="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}				
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
			}
      
        $is_residential=($is_residential=="Y")?'YES':'NO';	
        $is_renewal=($is_renewal=="W")?'Whole area':'Part of the area </label></td>';			
		
	}
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form '.$form.'</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
		<br>
		<table class="table table-bordered table-responsive">
		<tbody>			
      <tr>  				
			<td colspan="2">To<br/>Through<br/>	</td>
		</tr>		
		<tr>  				
			<td colspan="2">Sir,</td>
		</tr>		
		<tr>  				
			<td colspan="2">I/We request that a reconnaissance permit under the Mineral Concession Rules, 1960 be granted to me/us.</td>
		</tr>		
		<tr>  				
			<td colspan="2">The required particulars are given below :-</td>
		</tr>
		<tr>  				
			<td valign="top" width="50%">1. Name of the applicant with complete address. :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">Name</td> 
						<td>'.strtoupper($key_person).'</td>
				</tr>
				<tr>
						<td width="50%">Street Name 1</td>
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
						<td>+91 - '.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
						<td>Email-id</td>
						<td>'.$email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top" > 2. Is the applicant a private individual/private company/public company/firm or association?: </td>     
			<td>'.strtoupper($Type_of_ownership).'  </td>
		</tr>
		<tr>
			<td valign="top" colspan="2"> 3. In case applicant is : </td>
		</tr>
		<tr>
			<td valign="top"> (a) an individual, his nationality :         </td>
			<td>'.strtoupper($applicant_nation).'  </td>
		</tr>
		<tr>
			<td valign="top"> (b) a company, an attested copy of the certificate of registration of the company shall be enclosed :           </td>
			<td>'.strtoupper($applicant_reg_number).'    </td>
		</tr>
		<tr>
			<td valign="top"> (c) firm or association, the nationality of all the Partners of the firm or members of the association :          </td>
			<td >'.strtoupper($applicant_firm_asso).'</td>
		</tr>		
				<tr>
					<td valign="top" > 4. Profession or nature of business of applicant  : </td>
					<td>'.strtoupper($profession).'  </td>
				</tr>
				
				<tr>
			     <td>5. No. and date of the valid clearance certificate of payment of mining dues(copy attached):</td>									
			    <td>'.strtoupper($clearance_num).' '.strtoupper($clearance_dt).'</td>
		</tr> 
				<tr>
					<td valign="top">  6.(a) Particulars of the prospecting licence of which renewal is desired. : </td>
					<td>'.strtoupper($prospecting_lic).'  </td>
				</tr>
				<tr>
					<td valign="top">(b) Details of previous renewal/renewals granted, if any.:  </td>
					<td>'.strtoupper($p_renewal).'</td>
				</tr>
				<tr>
					<td valign="top"> 7. Reasons in detail for asking for renewal of prospecting license along with a report on the prospecting already done.:  </td>
					<td >'.strtoupper($Reasons_pros_lic).'</td>
				</tr>
				<tr>
			        <td>8. Period for which the reconnaissance permit is required : </td>	
			        <td>'.strtoupper($period_from_dt). 'To' .strtoupper($period_to_dt).'</td>
		        </tr>    							
				<tr>
					<td>9. Whether renewal is desired for the whole or part of the area held under prospecting license.:</td>
                      <td>'.strtoupper($is_renewal).'</td>					
				</tr>  	
                <tr>
				   <td>(a) The area applied for renewal:</td>
				   <td >'.strtoupper($arrr_renewal).'</td>
				</tr>
				 <tr>
				   <td>(b) Description of the area applied for renewal (description should be adequate for the purpose of demarcating the plot).</td>
				   <td >'.strtoupper($area_renewal).'</td>
				</tr>
				<tr>
					<td>10. Does the applicant continue to have the surface rights over the areas of the land for which he requires renewal of the prospecting license</td>
					 <td >'.strtoupper($is_residential).'</td>
				</tr>   							
					
		<tr>
			<td colspan="2">11. Particulars of the areas mineral-wise within the jurisdiction of the State Government for which the applicant or any person joint in interest with him :</td>	
		</tr>  		
		<tr>
			<td>1. Already holds under reconnaissance permit :</td>	
			<td>'.strtoupper($particulars_a).' </td>
		</tr>      							
		<tr>
			<td>2. Has already applied for but not granted :</td>	
			<td>'.strtoupper($particulars_b).' </td>
		</tr>      							
		<tr>
			<td>3. Being applied for simultaneously :</td>	
			<td>'.strtoupper($particulars_c).' </td>
		</tr>     										
		<tr>
			<td>12. Any other particulars which the applicant may wish to furnish:</td>
			<td>'.strtoupper($nature).' </td>
		</tr>  	
		';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
			
			<tr>
				<td colspan="2"><br/>&nbsp;&nbsp;I/We do hereby declare that the particulars furnished above are correct and am/are ready to furnish any other details, including accurate plans as may be required by you.</td>				
			</tr>	
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="center"> Yours faithfully,<br/>Signature of Applicant :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>	
			<tr>
				<td>Place : <strong>'.strtoupper($dist).'</strong></td>						
				<td align="center"> Designation :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>						
		</table>';
?>

