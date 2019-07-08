<?php
$dept="labour";
$form="3";
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
    $row1=$row1=$formFunctions->fetch_swr($swr_id);
        
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$father_name=$results["father_name"];$nature_work=$results["nature_work"];$max_workers=$results["max_workers"];
				
		if(!empty($results["manager"])){				
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_p=$manager->p;				
		}else{
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_p="";
		}	
		if(!empty($results["contractor"])){				
			$contractor=json_decode($results["contractor"]);
			$contractor_nwm=$contractor->nwm;$contractor_d=$contractor->d;$contractor_d2=$contractor->d2;				
		}else{
			$contractor_nwm="";$contractor_d="";$contractor_d2="";
		}
		/*if(!empty($results["treasury"])){				
			$treasury=json_decode($results["treasury"]);
			$treasury_name=$treasury->name;$treasury_amt=$treasury->amt;$treasury_d3=$treasury->d3;				
		}else{
			$treasury_name="";$treasury_amt="";$treasury_d3="";
		}*/	
	}
	$nature_work = wordwrap($results["nature_work"], 40, "<br/>", true);
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
    <div style="text-align:center">
		'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
	</div>  <br/>
            <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
        
                <tr>
                    <td> 1.(a) Name of the Establishment</td>
                    <td colspan="2">'.strtoupper($unit_name).'</td>
                </tr>
                <tr>
                    <td width="50%" rowspan="5" valign="top"> &nbsp;&nbsp;&nbsp;(b) Location of the Establishment :</td>
					<td width="25%">Street Name 1 </td>
                    <td width="25%">'.strtoupper($b_street_name1).'</td>
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
                    <td valign="top" rowspan="5">2. Postal address of factory</td>
                  
                                <td>Street Name 1 </td>
                                <td>'.strtoupper($b_street_name3).'</td>
                </tr>
                <tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($b_street_name4).'</td>
                </tr>
                <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($b_vill2).'</td>
                </tr>
                <tr>
                                <td>District </td>
                                <td>'.strtoupper($b_dist2).'</td>
                </tr>
                <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($b_pincode2).'</td>
                </tr>
				

				<tr>
                    <td valign="top" rowspan="7">3. Full name and address of the Principal Employer (furnish father&apos;s name in the case of individuals).</td>
					<td>Full Name </td>
                    <td>'.strtoupper($key_person).'</td>
                </tr>
				<tr>
                                <td>Father&apos;s Name </td>
                                <td>'.strtoupper($father_name).'</td>
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
                                <td colspan="3">
								<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<thead>
		<tr><td colspan="7" height="40px">4. Names and address of the Directors/particular Partners (in case of companies and firms).</td></tr>
		<tr><td width="100px">Sl No.</td>
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
                    <td valign="top" rowspan="6">5.	Full name and address of the Manager or person responsible for the supervision and Control of the establishment. </td>
                 
                                <td>Full Name </td>
                                <td>'.strtoupper($manager_name).'</td>
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
                    <td  valign="top">6. Nature of work. </td>
                    <td colspan="2">'.strtoupper($nature_work).'</td>
                </tr>
                 <tr>
                    <td  valign="top" colspan="3" height="40px">7.	Particulars of Contractors and migrant workman  </td>
                </tr>  
				
				<tr>
                    <td colspan="3">
					
					<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<thead>
		<tr><td colspan="7" height="40px">(a)	Names and addresses of Contractors. </td></tr>
		<tr><td width="100px">Sl No.</td>
		<td>Full Name</td>
		<td>Street Name 1</td>
		<td>Street Name 2</td>
		<td>Town/Vill</td>
		<td>District</td>
		<td>Pin Code</td>
		</tr></thead>
		
		
		<tbody>';
		
		$part2=$labour->query("SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
		while($row_2=$part2->fetch_array()){
		$printContents=$printContents.'
			<tr>
				<td>'.strtoupper($row_2["field1"]).'</td>
				<td>'.strtoupper($row_2["field2"]).'</td>
				<td>'.strtoupper($row_2["field3"]).'</td>
				<td>'.strtoupper($row_2["field4"]).'</td>
				<td>'.strtoupper($row_2["field5"]).'</td>
				<td>'.strtoupper($row_2["field6"]).'</td>
				<td>'.strtoupper($row_2["field7"]).'</td>
				</tr>';
		}
		$printContents=$printContents.'
		</tbody>
		</table>
					
		</td>
		</tr>
		 <tr>
			<td  valign="top">(b) Nature of work for which migrant workmen are to be recruited or are employed.</td>
			<td colspan="2">'.strtoupper($contractor_nwm).'</td>
		</tr> 
		<tr>
			<td  valign="top">(c) Maximum number of migrant workmen to be employed on and day through each Contractor.</td>
			<td colspan="2">'.strtoupper($max_workers).'</td>
		</tr> 
		<tr>
			<td  valign="top">(d) Date of commencement of work under each Contractor. </td>
			<td colspan="2">'.strtoupper($contractor_d).'</td>
		</tr> 
		<tr>
			<td  valign="top">(e) Estimated date of termination of employment of migrant 	workmen under each Contractor.</td>
			<td colspan="2">'.strtoupper($contractor_d2).'</td>
		</tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
            
        <tr>
			<td valign="top" rowspan="2">Signatures and Dates:  </td>
            <td width="35%">Signature of Principal Employment  :</td>
            <td>'.strtoupper($key_person).'</td>
        </tr>
        <tr>
            <td>Date : </td>
            <td> '.strtoupper($results["sub_date"]).'</td>
        </tr> 
</tbody>
</table>';
?>