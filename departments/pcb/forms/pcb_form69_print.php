<?php
$dept="pcb";
$form="69";
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
		$reporting_period=$results['reporting_period'];$name_city=$results['name_city'];$city_population=$results['city_population'];$area_kilometer=$results['area_kilometer'];$summmechanisms=$results['summmechanisms'];
		$details_manpower=$results['details_manpower'];$details_contractor=$results['details_contractor'];$is_difficulties=$results['is_difficulties'];$is_prepared=$results['is_prepared'];$facilities_validity=$results['facilities_validity'];$facility2_valid=$results['facility2_valid'];$details_difficulties=$results['details_difficulties'];
		
		if(!empty($results["nmaddress"])){
				$nmaddress=json_decode($results["nmaddress"]);
				$nmaddress_name=$nmaddress->name;$nmaddress_address=$nmaddress->address;
		}else{
				$nmaddress_name="";$nmaddress_address="";
         }
		 if(!empty($results["totalnum"])){
				$totalnum=json_decode($results["totalnum"]);
				$totalnum_wards=$totalnum->wards;$totalnum_area=$totalnum->area;$totalnum_door=$totalnum->door;$totalnum_commercial=$totalnum->commercial;$totalnum_institutions=$totalnum->institutions;
		  }else{
				$totalnum_wards="";$totalnum_area="";$totalnum_door="";$totalnum_commercial="";$totalnum_institutions="";
          }
		  
		 if(!empty($results["quantity"])){
				$quantity=json_decode($results["quantity"]);
				$quantity_generated=$quantity->generated;$quantity_collected=$quantity->collected;$quantity_channelized=$quantity->channelized;$quantity_rejects=$quantity->rejects;
			}else{
				$quantity_generated="";$quantity_collected="";$quantity_channelized="";$quantity_rejects="";
            }
		  
		  if(!empty($results["facilities"])){
				$facilities=json_decode($results["facilities"]);
				$facilities_name=$facilities->name;$facilities_address=$facilities->address;$facilities_capacity=$facilities->capacity;$facilities_technology=$facilities->technology;$facilities_regnum=$facilities->regnum;
			}else{
				$facilities_name="";$facilities_address="";$facilities_capacity="";$facilities_technology="";$facilities_regnum="";
            }
		  
		  if(!empty($results["facility2"])){
				$facility2=json_decode($results["facility2"]);
				$facility2_nm=$facility2->nm;$facility2_add=$facility2->add;$facility2_capa=$facility2->capa;$facility2_techno=$facility2->techno;$facility2_reg=$facility2->reg;
		  }else{
				$facility2_nm="";$facility2_add="";$facility2_capa="";$facility2_techno="";$facility2_reg="";
          }
		  
		  
		  if($is_difficulties=="Y")
			$is_difficulties="Yes";
		 else 
			$is_difficulties="No";
		
		if($is_prepared=="Y")
			$is_prepared="Yes";
		 else 
			$is_prepared="No";
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
	</div>  <br/>
             <table class="table table-bordered table-responsive">
                <tr>
                    <td width="50%">Period of Reporting </td>
                    <td>'.strtoupper($reporting_period).'</td>
                </tr>
				
                <tr>
                    <td>1. Name of the City or Town and State</td>
					<td>'.strtoupper($name_city).'</td>
                </tr>
                 <tr>
                    <td>2. Population  </td>
                    <td>'.strtoupper($city_population).'</td>
                </tr>
                 <tr>
                    <td>3. Area in sq. Kilometres </td>
                    <td>'.strtoupper($area_kilometer).'</td>
                </tr>
                 <tr>
                    <td colspan="2">4. Name & Address of Local body</td>
                </tr>
				<tr>
                    <td>Name</td>
                    <td>'.strtoupper($nmaddress_name).'</td>
                </tr>
				<tr>
                    <td>Address of Local body</td>
                    <td>'.strtoupper($nmaddress_address).'</td>
                </tr>
				<tr>
                    <td>5. Total Numbers of the wards in the area under jurisdiction</td>
                    <td>'.strtoupper($totalnum_wards).'</td>
                </tr>
				<tr>
                    <td>6. Total Numbers of Households in the area under jurisdiction</td>
                    <td>'.strtoupper($totalnum_area).'</td>
                </tr
				><tr>
                    <td>7. Number of households covered by door to door collection</td>
                    <td>'.strtoupper($totalnum_door).'</td>
                </tr>
				<tr>
                    <td colspan="2">8. Total number of commercial establishments and Institutions in the area under jurisdiction</td>
                </tr>
				<tr>
                    <td>Commercial establishments</td>
                    <td>'.strtoupper($totalnum_commercial).'</td>
                </tr>
				<tr>
                    <td>Institutions</td>
                    <td>'.strtoupper($totalnum_institutions).'</td>
                </tr>
				<tr>
                    <td>9. Summary of the mechanisms put in place for management of plastic waste in the area under jurisdiction along with the details of agencies involved in door to door collection</td>
                    <td>'.strtoupper($summmechanisms).'</td>
                </tr>
				<tr>
                    <td>10. Quantity of Plastic Waste generated during the year from area under jurisdiction (in tons)</td>
                    <td>'.strtoupper($quantity_generated).'</td>
                </tr>
				<tr>
                    <td>11. Quantity of Plastic Waste collected during the year from area under jurisdiction (in tons)</td>
                    <td>'.strtoupper($quantity_collected).'</td>
                </tr>
				<tr>
                    <td>12. Quantity of plastic waste channelized for recycling during the year (in tons)</td>
                    <td>'.strtoupper($quantity_channelized).'</td>
                </tr>
				<tr>
                    <td>13. Quantity of inert or rejects sent to landfill sites during the year (in tons) </td>
                    <td>'.strtoupper($quantity_rejects).'</td>
                </tr>
				<tr>
                    <td colspan="2">14. Details of each of facilities used for processing and disposal of plastic waste <br/>Facility-I </td>
                </tr>
				<tr>
                    <td>i) Name of operator</td>
					<td>'.strtoupper($facilities_name).'</td>
                </tr>
				<tr>
                    <td>ii) Address with Telephone Number or Mobile</td>
					<td>'.strtoupper($facilities_address).'</td>
                </tr>
				<tr>
                    <td>iii) Capacity</td>
					<td>'.strtoupper($facilities_capacity).'</td>
                </tr>
				<tr>
                    <td>iv) Technology Used</td>
					<td>'.strtoupper($facilities_technology).'</td>
                </tr>
				<tr>
                    <td>v) Registration Number</td>
					<td>'.strtoupper($facilities_regnum).'</td>
                </tr>
				<tr>
                    <td>vi) Validity of Registration (up to)</td>
					<td>'.strtoupper($facilities_validity).'</td>
                </tr>
		        <tr>
			       <td colspan="2">
				   <table class="table table-bordered table-responsive">		
				   <thead>
					<tr>
						<th width="5%">Sl. No.</th>
						<th>Name of the SPC B or PCC</th>
						<th>Estimated Plastic Waste generation Tons Per Annum</th>
						<th colspan="3">No. of registered Plastic Manufacturing or Recycling (including multilayer, compostable) units. </th>
						<th>No. of Unregistered plastic manufacturing Recycling units.</th>
						<th>Details of Plastic Waste Management</th>
						<th>Partial or complete ban on usages of Plastic Carry Bags (through Executive Order)</th>
						<th>Status of Marking Labelling on carry bags complied</th>
						<th>Explicit Pricing of carry bags</th>
						<th>Details of the meeting of State Level Advisory Body (SLA) along with its recommendations on Implementation </th>
						<th>No. of violations and action taken on noncompliance of provisions of these Rules<br/>and Number of Municipal Authority or Gram Panchayat under jurisdiction and Submission of Annual Report to CPCB</th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th>Plastic units</th>
						<th>Compostable Plastic Units</th>
						<th>Multilayer Plastic units</th>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name_spc"]).'</td>
							<td>'.strtoupper($row_1["estimated_plastic"]).'</td>
							<td>'.strtoupper($row_1["plastic_units"]).'</td>
							<td>'.strtoupper($row_1["compostable_plastic"]).'</td>
							<td>'.strtoupper($row_1["multilayer_plastic"]).'</td>
							<td>'.strtoupper($row_1["no_unregistered"]).'</td>
							<td>'.strtoupper($row_1["waste_management"]).'</td>
							<td>'.strtoupper($row_1["complete_ban_usages"]).'</td>
							<td>'.strtoupper($row_1["status_marking"]).'</td>
							<td>'.strtoupper($row_1["explicit"]).'</td>
							<td>'.strtoupper($row_1["details_meeting"]).'</td>
							<td>'.strtoupper($row_1["no_violations"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">Facility-II</td>
		</tr>
		<tr>
			<td>i) Name of operator</td>
			<td>'.strtoupper($facility2_nm).'</td>
		</tr>
		<tr>
			<td>ii) Address with Telephone Number or Mobile</td>
			<td>'.strtoupper($facility2_add).'</td>
		</tr>
		<tr>
			<td>iii) Capacity </td>
			<td>'.strtoupper($facility2_capa).'</td>
		</tr>
		<tr>
			<td>iv) Technology Used</td>
			<td>'.strtoupper($facility2_techno).'</td>
		</tr>
		<tr>
			<td>v) Registration Number</td>
			<td>'.strtoupper($facility2_reg).'</td>
		</tr>
		<tr>
			<td>vi) Validity of Registration (up to)</td>
			<td>'.strtoupper($facility2_valid).'</td>
		</tr>
		<tr>
			<td>19. Give details of: Local body’s own manpower deployed for collection including street sweeping,secondary storage, transportation, processing and disposal of waste</td>
			<td>'.strtoupper($details_manpower).'</td>
		</tr>
		<tr>
			<td>20. Give details of: Contractor or concessionaire’s manpower deployed for collection including street sweeping, secondary storage, transportation, processing and disposal of waste</td>
			<td>'.strtoupper($details_contractor).'</td>
		</tr>
		<tr>
			<td>21. Mention briefly, the difficulties being experienced by the local body in complying with provisions of these rules including the financial constrains, if any</td>
			<td>'.strtoupper($is_difficulties).' &nbsp;&nbsp; '.strtoupper($details_difficulties).'   </td>
		</tr>
		<tr>
			<td>22. Whether an Action Plan has been prepared for improving solid waste management practices in the city? If yes (attach copy) Date of revision </td>
			<td>'.strtoupper($is_prepared).'</td>
		</tr>
		';
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			
			$printContents=$printContents.'
				
       
         <tr>
			<td> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		    <td  align="right">Signature :'.strtoupper($key_person).'</td>
		</tr>
		
	  </table>';
?>