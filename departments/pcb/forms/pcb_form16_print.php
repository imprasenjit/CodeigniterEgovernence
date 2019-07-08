<?php
$dept="pcb";
$form="16";
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
	//PART I
	$dt_of_comm=$results["dt_of_comm"];$no_of_workers=$results["no_of_workers"];$auth_val=$results["auth_val"];
	//PART II
	$treatment_storage=$results["treatment_storage"];
	//PART III
	$is_indus_provided=$results['is_indus_provided'];$adq_system=$results['adq_system'];$is_indus_compli=$results['is_indus_compli'];
		
	if(!empty($results["consent_val"])){
		$consent_val=json_decode($results["consent_val"]);
		$consent_val_water=$consent_val->water;$consent_val_air=$consent_val->air;		
	}else{
		$consent_val_water="";$consent_val_air="";
	}	
	if(!empty($results["pro_manufac"])){
		$pro_manufac=json_decode($results["pro_manufac"]);
		$pro_manufac_year1=$pro_manufac->year1;$pro_manufac_prod1=$pro_manufac->prod1;$pro_manufac_qty1=$pro_manufac->qty1;$pro_manufac_year2=$pro_manufac->year2;$pro_manufac_prod2=$pro_manufac->prod2;$pro_manufac_qty2=$pro_manufac->qty2;
		$pro_manufac_year3=$pro_manufac->year3;$pro_manufac_prod3=$pro_manufac->prod3;$pro_manufac_qty3=$pro_manufac->qty3;
	}else{
		$pro_manufac_year1="";$pro_manufac_prod1="";$pro_manufac_qty1="";$pro_manufac_year2="";$pro_manufac_prod2="";$pro_manufac_qty2="";$pro_manufac_year3="";$pro_manufac_prod3="";$pro_manufac_qty3="";
	}	
	if(!empty($results["raw_mat_con"])){
		$raw_mat_con=json_decode($results["raw_mat_con"]);
		$raw_mat_con_year1=$raw_mat_con->year1;$raw_mat_con_prod1=$raw_mat_con->prod1;$raw_mat_con_qty1=$raw_mat_con->qty1;$raw_mat_con_year2=$raw_mat_con->year2;$raw_mat_con_prod2=$raw_mat_con->prod2;$raw_mat_con_qty2=$raw_mat_con->qty2;$raw_mat_con_year3=$raw_mat_con->year3;$raw_mat_con_prod3=$raw_mat_con->prod3;$raw_mat_con_qty3=$raw_mat_con->qty3;
	}else{
		$raw_mat_con_year1="";$raw_mat_con_prod1="";$raw_mat_con_qty1="";$raw_mat_con_year2="";$raw_mat_con_prod2="";$raw_mat_con_qty2="";$raw_mat_con_year3="";$raw_mat_con_prod3="";$raw_mat_con_qty3="";
	}	
	//Part II
	if(!empty($results["water_cs"])){
		$water_cs=json_decode($results["water_cs"]);
		$water_cs_i1=$water_cs->i1;$water_cs_d1=$water_cs->d1;$water_cs_cess=$water_cs->cess;$water_cs_waste_water=$water_cs->waste_water;$water_cs_i2=$water_cs->i2;$water_cs_d2=$water_cs->d2;$water_cs_qty=$water_cs->qty;$water_cs_an=$water_cs->an;
	}else{
		$water_cs_i1="";$water_cs_d1="";$total_qty_r_typ="";$water_cs_cess="";$water_cs_waste_water="";$water_cs_i2="";$water_cs_d2="";$water_cs_qty="";$water_cs_an="";
	}		
	//partIII
	if(!empty($results["any_other_info"])){
		$any_other_info=json_decode($results["any_other_info"]);
		$any_other_info_a=$any_other_info->a;$any_other_info_b=$any_other_info->b;
	}else{
		$any_other_info_a="";$any_other_info_b="";
	}	
			
	if($is_indus_provided=="Y") $is_indus_provided="YES";
		else $is_indus_provided="NO";
	if($is_indus_compli=="Y") $is_indus_compli="YES";
		else $is_indus_compli="NO";
	$adq_system = wordwrap($adq_system, 40, "<br/>", true);		
}

$form_name=$formFunctions->get_formName($dept,$form);
//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
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
        <p  style="text-align:center"></p>
        <h4>'.$form_name.'</h4>
    </div><br/>
	<div class="container"><br/>
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
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).'&nbsp;'.strtoupper($b_landline_no).'</td>
				</tr>      		
				</table>
			</td>
		</tr>
		<tr>
  		   	<td>2. Contact person with designation, Tel./Fax</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr>
        			<td>Name</td>
        			<td>'.strtoupper($key_person).'</td>
				</tr>
				<tr>
        			<td>Designation</td>
        			<td>'.strtoupper($status_applicant).'</td>
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
        			<td>+91'.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($landline_std).''.strtoupper($landline_no).'</td>
				</tr>
				</table>
			</td>
		</tr>
  		<tr>
			<td>3. Date of Commissioning</td>
			<td>'.strtoupper($dt_of_comm).'</td>
		</tr>
		<tr>
			<td>4. No. of workers (including contract labour)</td>
			<td>'.strtoupper($no_of_workers).'</td>
		</tr>
		<tr>		
			<td>5. Consents Validity</td>
			<td>a. Water (Prevention & Control of Pollution) Act, 1974;Valid up to '.strtoupper($consent_val_water).'<br/>
				b. Air (Prevention & Control of Pollution) Act, 1981;Valid up to '.strtoupper($consent_val_air).'</td>
		</tr>	
		<tr>
			<td>6. Authorization validity</td>
			<td>E-wastes (Management and Handling) Rules, 2011;Valid up to '.strtoupper($auth_val).'</td>
		</tr>
		<tr>
			<td>7. Manufacturing Process</td>
			<td>Document is Attached</td>
		</tr>
		<tr>
			<td>8. Products and Installed capacity of production in (MTA)</td>
			<td>
			<table class="table table-bordered table-responsive">
			<tr>
			   <td align="center">Products</td>
			   <td align="center">Installed capacity (MTA)</td>
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["product"]).'</td>
						<td>'.strtoupper($row_1["capacity"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table>   
		</td>
		</tr>
		<tr>
			<td>9. Products manufactured during the last three years (as applicable)</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr align="center">
        			<td>Year</td>
        			<td>Product</td>
        			<td>Quantity</td>
				</tr>';
				
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_2["year"]).'</td>
							<td>'.strtoupper($row_2["product"]).'</td>
							<td>'.strtoupper($row_2["qty"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>  
			</td>
		</tr>
    	<tr>
  		   	<td>10. Raw material consumption during the last three years (as applicable)</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr align="center">
        			<td>Year</td>
        			<td>Product</td>
        			<td>Quantity</td>
				</tr>';
				
				$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
					while($row_3=$part3->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_3["year"]).'</td>
							<td>'.strtoupper($row_3["product"]).'</td>
							<td>'.strtoupper($row_3["qty"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>  
			</td>
		</tr>
  		<tr>
		   	<td>11. Water consumption</td>
			<td>Industrial : '.strtoupper($water_cs_i1).' m<sup>3</sup>/day<br/>
			Domestic : '.strtoupper($water_cs_d1).' m<sup>3</sup>/day</td>
		</tr>
		<tr>	
			<td>Water Cess paid up to (if applicable)</td>
			<td>'.strtoupper($water_cs_cess).'</td>
		</tr>
		<tr>
			<td>Waste water generation as per consent</td>
			<td>'.strtoupper($water_cs_waste_water).'m<sup>3</sup>/day</td>
		</tr>
		<tr>
			<td>Actual (avg., of last 3 months)</td>
			<td> Industrial :'.strtoupper($water_cs_i2).' m<sup>3</sup>/day<br/>
			Domestic :'.strtoupper($water_cs_d2).' m<sup>3</sup>/day</td>
		</tr>
		<tr>
			<td>Waste water treatment (provide flow diagram of the treatment scheme)</td>
			<td>Industrial : Document attached<br/>Domestic : Document attached<br/></td>
		</tr>
		<tr>
		   	<td rowspan="2">Waste water discharge</td>
			<td>Quantity '.strtoupper($water_cs_qty).' m<sup>3</sup>/day</td>
		</tr>
  	  	<tr>
		  	<td>'.strtoupper($water_cs_an).' <br/>Analysis of treated waste water for pH, BOD,
			COD, SS, O&G, <br/>any other parameter stipulated by SPCB/SPCC (attach details)</td>
		</tr>
		<tr>
			<td colspan="2">12. Air Pollution Control</td>
	  	</tr>  	
  		<tr>
			<td>a. Provide flow diagram for emission control system(s) installed for each process unit, utilities etc.</td>
			<td>Document attached</td>
		</tr>
		<tr>
			<td>b. Details for facilities provided for control of fugitive emission due to material handling, process, utilities etc.</td>
			<td>Document attached</td>
		</tr>
		<tr>
			<td>c. Fuel consumption</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr align="center">
					<td>Sl. No</td>
					<td>Fuel</td>
					<td>Qty per day/month</td>
				</tr>';
				
				$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
					while($row_4=$part4->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_4["slno"]).'</td>
							<td>'.strtoupper($row_4["fuel"]).'</td>
							<td>'.strtoupper($row_4["quantity"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>  
			</td>
		</tr>
		<tr>
			<td>d. Stack emission monitoring</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr align="center">
					<td>Sl. No</td>
					<td>Stack attached to</td>
					<td>Emission (SPM, SO<sub>2</sub> ,NOx , Pb etc.)mg/Nm<sup>3</sup></td>
				</tr>';
				
				$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
					while($row_5=$part5->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_5["slno"]).'</td>
							<td>'.strtoupper($row_5["stack"]).'</td>
							<td>'.strtoupper($row_5["emission"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>  
    	</td>
		</tr>
		<tr>
			<td>e. Ambient air quality</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr align="center">
					<td>Sl. No</td>
					<td>Location Results ug/m<sup>3</sup></td>
					<td>Parameters (SPM, SO<sub>2</sub> ,NOx , Pb etc.)ug/m<sup>3</sup></td>
				</tr>';
				
				$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
					while($row_6=$part6->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_6["slno"]).'</td>
							<td>'.strtoupper($row_6["location"]).'</td>
							<td>'.strtoupper($row_6["parameter"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>  
			</td>
		</tr>
		<tr>
			<td colspan="2">13. Waste Management:</td>
		</tr>  	
		<tr>
			<td>a. Waste generation in processing e-waste</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr align="center">
					<td>Sl No.</td>
					<td>Type</td>
					<td>Category</td>
					<td>Qty</td>
				</tr>';
				
				$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
					while($row_7=$part7->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_7["slno"]).'</td>
							<td>'.strtoupper($row_7["type"]).'</td>
							<td>'.strtoupper($row_7["category"]).'</td>
							<td>'.strtoupper($row_7["qty"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>  
			</td>
		</tr>
		<tr>
			<td>b. Waste Collection and transportation (attach details)</td>
			<td>Document attached</td>		
		</tr>
		<tr>
			<td>c. Provide details of disposal of residue</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr align="center">
					<td>S No.</td>
					<td>Type</td>
					<td>Category</td>
					<td>Qty</td>
				</tr>';
				
				$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
					while($row_8=$part8->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_8["slno"]).'</td>
							<td>'.strtoupper($row_8["type"]).'</td>
							<td>'.strtoupper($row_8["category"]).'</td>
							<td>'.strtoupper($row_8["qty"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>  
			</td>
		</tr>
		<tr>
			<td>d. Name of Treatment Storage and Disposal Facility utilized for</td>
			<td>'.strtoupper($treatment_storage).'</td>
		</tr>
		<tr>
			<td>e. Please attach analysis report of characterization of hazardous waste generated (including leachate test if applicable)</td>
			<td>Document attached</td>
		</tr>
 		<tr>  
			<td colspan="2">14. Details of e-waste proposed to be procured through sale, contract or import, as the case may be, for use as raw material
			<table class="table table-bordered table-responsive">
				<tr align="center">
					<td>Sl No.</td>
					<td>Name</td>
					<td>Quantity required/year</td>
					<td>Basel Convention Number</td>
				</tr>';
				
				$part9=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t9 WHERE form_id='$form_id'");
					while($row_9=$part9->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_9["slno"]).'</td>
							<td>'.strtoupper($row_9["name"]).'</td>
							<td>'.strtoupper($row_9["qty"]).'</td>
							<td>'.strtoupper($row_9["baselno"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>			
		</tr>
		<tr>
			<td>15. Occupational safety and health aspects</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td  colspan="2">16.Remarks</td>
		</tr> 
		<tr>
			<td>Whether industry has provided adequate pollution control system / equipment to meet the standards of emission / effluent. If Yes, please furnish details</td>
			<td colspan="2">'.strtoupper($is_indus_provided).'<br/>
			<br/>'.strtoupper($adq_system).'
			</td>	
		</tr> 
		<tr>
			<td>Whether industry is in compliance with conditions laid down in the Authorization</td>
			<td colspan="2">'.strtoupper($is_indus_compli).'</td>
		</tr>
		<tr>
			<td rowspan="2" >17.Any Other Information of relevance:</td>
		</tr>
		<tr>
			<td>i) '.strtoupper($any_other_info_a).' <br/>
			ii)'.strtoupper($any_other_info_b).'</td>
		</tr>';				
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 	

		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr>  		
  		<td valign="top">Place : <b>'.strtoupper($dist).'</b><br/>
  		Date : <b>'.strtoupper($results["sub_date"]).'</b></td>
  		<br/>
  		<td align="right" ><b>'.strtoupper($key_person).'</b><br/>Signature of the Authorized person</td>
        </tr>
			</table>
			</td>
		</tr>  	
    </table>
  	';  	
?>