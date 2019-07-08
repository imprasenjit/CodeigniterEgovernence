<?php
$dept="pcb";
$form="38";
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
	$com_date=$results["com_date"];$no_worker=$results["no_worker"];$disposal_detail=$results["disposal_detail"];$facilities_detail=$results["facilities_detail"];$is_indus_provided=$results["is_indus_provided"];$adq_system=$results["adq_system"];$is_compliance=$results["is_compliance"];$is_condition=$results["is_condition"];$is_processed=$results["is_processed"];$other_info=$results["other_info"];
	
	if(!empty($results["contact_person"])){
		$contact_person=json_decode($results["contact_person"]);
		$contact_person_name=$contact_person->name;$contact_person_desig=$contact_person->desig;$contact_person_email=$contact_person->email;$contact_person_m_no=$contact_person->m_no;
	}else{
		$contact_person_name="";$contact_person_desig="";$contact_person_email="";$contact_person_m_no="";
	}
	if(!empty($results["const_validate"])){
		$const_validate=json_decode($results["const_validate"]);
		$const_validate_air=$const_validate->air;$const_validate_water=$const_validate->water;$const_validate_valid_date=$const_validate->valid_date;
	}else{
		$const_validate_air="";$const_validate_water="";$const_validate_valid_date="";
	}
	if(!empty($results["plastic_waste"])){
		$plastic_waste=json_decode($results["plastic_waste"]);
		$plastic_waste_name=$plastic_waste->name;$plastic_waste_qty=$plastic_waste->qty;
	}else{
		$plastic_waste_name="";$plastic_waste_qty="";
	}					
}
	
if($is_indus_provided=="Y") $is_indus_provided="YES";
	else $is_indus_provided="NO";
if($is_compliance=="Y") $is_compliance="YES";
	else $is_compliance="NO";
if($is_condition=="Y") $is_condition="YES";
	else $is_condition="NO";
if($is_processed=="Y") $is_processed="YES";
	else $is_processed="NO";
	
$adq_system = wordwrap($adq_system, 40, "<br/>", true);	
		
$form_name=$formFunctions->get_formName($dept,$form);
// $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
</body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
    <div style="text-align:center"><h4>'.$form_name.'</h4></div>
	<br/>
		<table class="table table-bordered table-responsive">
		<tr>
			<td width="50%">1. Name and Address of the unit</td>
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
						<td>Mobile No</td>
						<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2. Contact person with designation,Tel./Fax /email</td>
			<td>
			<table class="table table-bordered table-responsive">
			<tr>
				<td>Full Name</td>										
				<td>'.strtoupper($contact_person_name).'</td>
			</tr>
			<tr>
				<td>Designation</td>
				<td>'.strtoupper($contact_person_desig).'</td>	
			</tr>
			<tr>
				<td>Mobile No.</td>
				<td>'.strtoupper($contact_person_m_no).'</td>	
			</tr>
			<tr>
				<td>Email-Id</td>
				<td>'.$contact_person_email.'</td>	
			</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>3. Date of commencement</td>
			<td>'.strtoupper($com_date).'</td>
		</tr>
		<tr>
			<td>4. No. of workers (including contract labour)</td>
			<td>'.strtoupper($no_worker).'</td>
		</tr>
		<tr>
			<td>5. Consents Validity</td>
			<td>a. Water (Prevention & Control of Pollution) Act, 1974; Valid up to '.strtoupper($const_validate_water).'<br/>
			b. Air (Prevention & Control of Pollution) Act, 1981; Valid up to '.strtoupper($const_validate_air).' <br/>
			c. Authorization; Valid up to '.strtoupper($const_validate_valid_date).'</td>
		</tr>
		<tr>
			<td>6. Manufacturing Process (Please attach a flow diagram of the manufacturing process flow diagram for each product.)</td>
			<td>Uploaded in Upload Section</td>
		</tr>
		<tr>
			<td>7. Manufacturing Process</td>
			<td><table class="table table-bordered table-responsive">
			<tr align="center">
				<td align="center">Sl No</td>
				<td align="center">Product</td>
				<td align="center">Installed capacity</td>			
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td width="50px" align="center">'.strtoupper($row_1["slno"]).'</td>
						<td align="center">'.strtoupper($row_1["product"]).'</td>
						<td align="center">'.strtoupper($row_1["capacity"]).'</td>
				</tr>';
				}$printContents=$printContents.'
   		</table>  </td>
		</tr>
		<tr>
			<td>8.  Waste Management<br/>
			a. Waste generation in processing plastic-waste</td>
			<td>
			<table class="table table-bordered table-responsive">
			<tr align="center">
				<td align="center">Sl No </td>
				<td align="center">Type</td>
			   <td align="center">Category</td>
			   <td align="center">Quantity</td>			
			</tr>';
			
			$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td width="50px" align="center">'.strtoupper($row_2["slno"]).'</td>
						<td align="center">'.strtoupper($row_2["type"]).'</td>
						<td align="center">'.strtoupper($row_2["category"]).'</td>
						<td align="center">'.strtoupper($row_2["qty"]).'</td>
				</tr>';
				}$printContents=$printContents.'
   		</table> 
		</td>
		</tr>
		<tr>
			<td>b. Waste Collection and transportation (attach details)</td>
			<td>Uploaded in Upload Section</td>
		</tr>
		<tr>
			<td>c. Waste Disposal details</td>
			<td><table class="table table-bordered table-responsive">
			<tr align="center">
				<td align="center">Sl No </td>
				<td align="center">Type</td>
			   <td align="center">Category</td>
			   <td align="center">Quantity</td> 
			</tr>';
			
			$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
				while($row_3=$part3->fetch_array()){
				$printContents=$printContents.'
				<tr>
						<td width="50px" align="center">'.strtoupper($row_3["slno"]).'</td>
						<td align="center">'.strtoupper($row_3["type"]).'</td>
						<td align="center">'.strtoupper($row_3["category"]).'</td>
						<td align="center">'.strtoupper($row_3["qty"]).'</td>
				</tr>';
				}$printContents=$printContents.'
   		</table> 
		</td>
		</tr>
		<tr>
			<td>d. Provide details of the disposal facility, whether the facility is authorized by SPCB or PCC</td>
			<td>'.strtoupper($disposal_detail).'</td>
		</tr>
		<tr>
			<td>e. Please attach analysis report of characterization ofwaste generated (including leachate test if applicable)</td>
			<td>Uploaded in Upload Section</td>
		</tr>
		<tr>
			<td>9. Details of plastic waste proposed to be acquired through sale, auction, contract or import, as the case may be, for use as raw material</td>
			<td>(i) Name : '.strtoupper($plastic_waste_name).'<br/>(ii) Quantity required /year : '.strtoupper($plastic_waste_qty).'</td>
		</tr>
		<tr>
			<td>10. Occupational safety and health aspects(Please provide details of facilities)</td>
			<td>'.strtoupper($facilities_detail).'</td>
		</tr>
		<tr>
			<td colspan="2">11.Pollution Control Measures</td>
		</tr>
		<tr>
			<td>(a)Whether the unit has adequate pollution control systems or equipment to meet the standards of emission or effluent. If Yes, please furnish details</td>
			<td>'.strtoupper($is_indus_provided).'<br/>'.strtoupper($adq_system).'</td>
		</tr>
		<tr>
			<td>(b)Whether unit is in compliance with conditions laid down in the said rules.</td>
			<td>'.strtoupper($is_compliance).'</td>
		</tr>
		<tr>
			<td>(c)Whether conditions exist or are likely to exist of the material being handled or processed posing adverse immediate or delayed impacts on the environment.</td>
			<td>'.strtoupper($is_condition).'</td>
		</tr>
		<tr>
			<td>(d)Whether conditions exist (or are likely to exist) of the material being handled or processed by any means capable of yielding another material (e.g. leachate) which may possess eco-toxicity.</td>
			<td>'.strtoupper($is_processed).'</td>
		</tr>
		<tr>
			<td>12. Any other relevant information including fire or accident mitigative measures</td>
			<td>'.strtoupper($other_info).'</td>
		</tr>											
		<tr>
			<td>13. List of enclosures as per rule</td>
			<td>Uploaded in Upload Section</td>
		</tr>';
		
        $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'   
		
		<tr>
			<td>Date : &nbsp;<b>'.date('d-m-Y',strtotime($today)).'</b></td>										
			<td align="right">Signature :&nbsp;<b>'.strtoupper($key_person).'</b></td>
		</tr>
		<tr>
			<td>Place :&nbsp;<b> '.strtoupper($dist).'</b></td>
			<td align="right">Designation :&nbsp;<b>'.strtoupper($status_applicant).'</b></td>
		</tr>
  	</table>';  	
?>