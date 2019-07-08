<?php
 $dept="doa";
 $form="22";
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
	
   $q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'");
   
	if($q->num_rows>0)
	 {	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		##### part 1 ######	
	    $name_concern=$results["name_concern"];
		$relevant_detail=$results["relevant_detail"];
		$is_renewal=$results["is_renewal"];
		$fertilizer_type=$results["fertilizer_type"];
		if($fertilizer_type=="G"){
			$fertilizer_type_name="General";
		}else{
			$fertilizer_type_name="Others - (Physical/ Granulated /Special mixture of Fertilizers/Organic fertliser /Bio-Fertilizer)";
		}
		if($is_renewal=='Y') $is_renewal="YES";
		else $is_renewal="NO";
		
		
		if(!empty($results["manufac_importer"])){
			$manufac_importer=json_decode($results["manufac_importer"]);
			if(isset($manufac_importer->a)) $manufac_importer_a=$manufac_importer->a; else $manufac_importer_a="";
			if(isset($manufac_importer->b)) $manufac_importer_b=$manufac_importer->b; else $manufac_importer_b="";
			if(isset($manufac_importer->c)) $manufac_importer_c=$manufac_importer->c; else $manufac_importer_c="";
			if(isset($manufac_importer->d)) $manufac_importer_d=$manufac_importer->d; else $manufac_importer_d="";
			if(isset($manufac_importer->e)) $manufac_importer_e=$manufac_importer->e; else $manufac_importer_e="";
		}else{
			$manufac_importer_a="";$manufac_importer_b="";$manufac_importer_c="";$manufac_importer_d="";$manufac_importer_e="";
		}
		
      //manufac_importer//
	  
		$manufac_importer_values="";
		if($manufac_importer_a=="M") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Manufacturer';
		if($manufac_importer_b=="I") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Importer';
		if($manufac_importer_c=="P") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Pool Handling Agency';
		if($manufac_importer_d=="W") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Wholesale Dealer';
		if($manufac_importer_e=="R") $manufac_importer_values=$manufac_importer_values. '<span class="tickmark">&#10004;</span> Retail Dealer';
		
		
		if(!empty($results["sale"])){
			$sale=json_decode($results["sale"]);
			$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_d=$sale->d;$sale_p=$sale->p;$sale_mno=$sale->mno;
		}else{
			$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
		}
		if(!empty($results["storage"])){
			$storage=json_decode($results["storage"]);
			$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_d=$storage->d;$storage_p=$storage->p;$storage_mno=$storage->mno;
		}else{
			$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
		}
		
	 }

$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'
  			<h4>'.$form_name.'</h4>
	</div></br></br></br></br>
	
<table class="table table-bordered table-responsive">
	<tr>
		<td colspan="2"><p>To,<br/>The Registering Authority,<br/> Government of Assam</p></td>
	</tr>
	<tr>  				
		<td>Type of Fertilizer :</td>
		<td>'.strtoupper($fertilizer_type_name).'</td>
	</tr>
	';
	
	if($fertilizer_type=="G"){		
		$printContents=$printContents.'
			
			
			<tr>  				
				<td colspan="2">1. Details of the application :</td>
			</tr>
			
			<tr>  				
				<td width="50%">(a) Name of the applicant :</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>  				
				<td>(b) Name of the concern :</td>
				<td>'.strtoupper($name_concern).'</td>
			</tr>
			<tr>
				<td valign="top">(c) Address of the applicant :</td>
					<td><table class="table table-bordered table-responsive">
						<tr>
							<td>Street name 1 </td>
							<td>'.strtoupper($street_name1).'</td>
						</tr>
						<tr>
							<td>Street name 2 </td>
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
							<td>'.$pincode.'</td>
						</tr>
						<tr>
							<td>Mobile</td>
							<td>+91 - '.$mobile_no.'</td>
						</tr>
						<tr>
							<td>Email-id</td>
							<td> '.$email.'</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<td colspan="2">2. Place of business (Please give full address ) : </td>
			</tr>
			<tr>
					<td valign="top"> i. For sale  :</td>
					   <td><table class="table table-bordered table-responsive">
						<tr>
							<td>Street name 1 </td>
							<td>'.strtoupper($sale_sn1).'</td>
						</tr>
						<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($sale_sn2).'</td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($sale_v).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($sale_d).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>+91 - '.$sale_p.'</td>
						</tr>
						<tr>
							<td>Mobile No.</td>
							<td> '.$sale_mno.'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top"> ii. For Storage :</td>
					<td><table class="table table-bordered table-responsive">
						<tr>
							<td>Street name 1 </td>
							<td>'.strtoupper($storage_sn1).'</td>
						</tr>
						<tr>
							<td>Street name 2 </td>
							<td>'.strtoupper($storage_sn2).'</td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($storage_v).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($storage_d).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>'.$storage_p.'</td>
						</tr>
						<tr>
							<td>Mobile</td>
							<td>+91 - '.$storage_mno.'</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<td>3. Whether the application is for -  :</td>
				<td>'.strtoupper($manufac_importer_values).'</td>
			</tr>
		 <tr>
			<td colspan="2">4. Details of fertilizer and their source in Form "O"  :
				<table class="table table-bordered table-responsive">
					<tr>
						<td  align="center">Sl. No.</td>
						<td  align="center">Name of fertilizer</td>
						<td  align="center">Whether certificate of source in Form O is attached</td>
					</tr>';
					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr align="center">
								<td align="center">'.strtoupper($row_1["slno"]).'</td>
								<td>'.strtoupper($row_1["fertilizer"]).'</td>
								<td>'.strtoupper($row_1["is_certificate"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table> 
				</td>
			</tr>
			<tr>
				<td>5. Whether the intimation is for an authorization letter or a renewal thereof . ( Note: In case the intimation is for renewal of authorization letter, the acknowledgment in From A2 should submitted for necessary endorsement thereon.) :</td>
				<td>'.strtoupper($is_renewal).'</td>
			</tr>
			<tr>
				<td>6. Any other relevant information. :</td>
				<td>'.strtoupper($relevant_detail).'</td>
			</tr>';
	}else{ 
		$q2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_part1 where form_id='$form_id'");
	    if($q2->num_rows>0){
			$results2=$q2->fetch_assoc();
			$form_id=$results2['form_id'];
			$is_micro_nutrient=$results2["is_micro_nutrient"];
			$period_validity=$results2["period_validity"];$is_applicant=$results2["is_applicant"];
			$is_corner=$results2["is_corner"];
			
			
			if($is_applicant=='Y') $is_applicant="YES";
		    else $is_applicant="NO";
			
			if($is_corner=='Y') $is_corner="YES";
		    else $is_corner="NO";
			
			if(!empty($results2["particulars"])){
				$particulars=json_decode($results2["particulars"]);
				$particulars_speci=$particulars->speci;$particulars_certi=$particulars->certi;
			}else{
				$particulars_speci="";$particulars_certi="";
			}
			if(!empty($results2["applicant"])){
				$applicant=json_decode($results2["applicant"]);
				$applicant_quantity1=$applicant->quantity1;$applicant_quantity2=$applicant->quantity2;$applicant_quantity3=$applicant->quantity3;$applicant_situation=$applicant->situation;
			}else{
				$applicant_quantity1="";$applicant_quantity2="";$applicant_quantity3="";$applicant_situation="";
			}
			if(!empty($results2["fertilisers"])){
				$fertilisers=json_decode($results2["fertilisers"]);
				$fertilisers_nm=$fertilisers->nm;$fertilisers_sn1=$fertilisers->sn1;$fertilisers_sn2=$fertilisers->sn2;$fertilisers_v=$fertilisers->v;$fertilisers_d=$fertilisers->d;$fertilisers_p=$fertilisers->p;$fertilisers_mno=$fertilisers->mno;
			}else{
				$fertilisers_nm="";$fertilisers_sn1="";$fertilisers_sn2="";$fertilisers_v="";$fertilisers_d="";$fertilisers_p="";$fertilisers_mno="";
			}
		}
		
		$printContents=$printContents.'			
			
			<tr>
				<td width="50%">1. i. Name of the applicant :</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td>ii. Address of the applicant :</td>
					<td><table class="table table-bordered table-responsive">
						<tr>
							<td>Street name 1 :</td>
							<td>'.strtoupper($street_name1).'</td>
						</tr>
						<tr>
							<td>Street name 2 </td>
							<td>'.strtoupper($street_name2).'</td>
						</tr>
						<tr>
							<td>Village/Town :</td>
							<td>'.strtoupper($vill).'</td>
						</tr>
						<tr>
							<td>District :</td>
							<td>'.strtoupper($dist).'</td>
						</tr>
						<tr>
							<td>Pincode :</td>
							<td>'.$pincode.'</td>
						</tr>
						<tr>
							<td>Mobile No :</td>
							<td>'.$mobile_no.'</td>
						</tr>
						<tr>
							<td>Email :</td>
							<td>'.$email.'</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<td>(2) Does applicant possess the qualification prescribed by the state Government under sub -clause (1) of clause 14 of the Fertiliser (Control) Order 1985.</td>
				<td>'.strtoupper($is_applicant).'</td>
			</tr>
			<tr>
				<td>(3). Is the applicant a new corner? (yes or no)</td>
				<td>'.strtoupper($is_corner).'</td>
			</tr>
			<tr>
				<td>(4). Situation of the applicant&#39;s premises where physical/ granulated/ special mixture of fentilisers organic fertiliser/ biofertiliser will be prepared </td>
				<td>'.strtoupper($applicant_situation).'</td>
			</tr>
			
			<tr>
				<td>(5) Full particulars regarding specifications of the physical/ granulated /special mixture of fertilisers/organic fertliser /biofertiliser for which in the certificate is required and the raw materials used in making the mixtur:</td>
				<td>'.strtoupper($particulars_speci).'</td>
			</tr>
			<tr>
				<td>(6). Full particulars of any other certificate of manufacture , if any issued by any other Registering Authority </td>
				<td>'.strtoupper($particulars_certi).'</td>
			</tr>
			<tr>
				<td>(7). How long has the applicant been carrying on the business of preparing physical/granulated/special mixture of fertilisers/ organic fertiliser /bio fertiliser / mixture of micro nutrient fertilisers?</td>
				<td>'.strtoupper($is_micro_nutrient).'</td>
			</tr>
			<tr>
				<td>(8). Quantities of each physical /granulated /special mixture of fertilisers mixture of fertilisers mixture of micro nutrient fertilisers/ organic fertilisers/ biofertilisers(in tonnes) in any /our possession on the date of the application and held at different addresses noted against each </td>
				<td>'.strtoupper($applicant_quantity1).'</td>
			</tr>
			
			<tr>
				<td>9.(i) If the applicant has been carrying on the business of preparing physical /granulated/special mixtures of fertilisers/mixture of microelectronic fertilisers /organic fertilisers/ mixture of particulars of such mixtures handled the period and the place (s) of which the mixing of fetilisers was done</td>
				<td>'.strtoupper($applicant_quantity2).'</td>
			</tr>
			<tr>
				<td>(ii) Also give the quantities of physical/granulated/ special mixture of fertiliser /organic fertiliser/biofertiliser handled during the past calendar years</td>
				<td>'.strtoupper($applicant_quantity3).'</td>
			</tr>
			<tr>
				<td>10. If the application is for indicate briefly why the original certificate could not be acted on within the period of its validity</td>
				<td>'.strtoupper($period_validity).'</td>
			</tr>
			<tr><td colspan="2">11.In case of special mixture of fertilisers (Name and address of the person requiring the special mixture of fertilisers) :</td></tr>
			<tr>
				<td>i. Name of the person  :</td>
				<td>'.strtoupper($fertilisers_nm).'</td>
			</tr>
			<tr>
				<td>ii. Address of the person :</td>
					<td><table class="table table-bordered table-responsive">
						<tr>
							<td>Street Name 1  :</td>
							<td>'.strtoupper($fertilisers_sn1).'</td>
						</tr>
						<tr>
							<td>Street Name 2 </td>
							<td>'.strtoupper($fertilisers_sn2).'</td>
						</tr>
						<tr>
							<td>Village/Town : :/Town</td>
							<td>'.strtoupper($fertilisers_v).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($fertilisers_d).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>'.$fertilisers_p.'</td>
						</tr>
						<tr>
							<td>Mobile No.</td>
							<td>'.$fertilisers_mno.'</td>
						</tr>
					</table>
				</td>
			</tr>';
	}
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		<tr>
			<td>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
			Place<strong> :</strong> '.strtoupper($dist).' </td>
			<td align="right">Signature of the Applicant<strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
	</table>
	';

?>  