<?php 
$dept="ayush";
$form="2";
$table_name=getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
    $form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($ayush->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") or die($ayush->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($ayush->error);
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($ayush->error);
	}
   
	$row1=$row1=$formFunctions->fetch_swr($swr_id);	
    $Name_of_owner=$row1['Name_of_owner'];
    $owners=Array();
    $owners=explode(",",$Name_of_owner);
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$dec1=$results['dec1'];
		//tab2//
		if(!empty($results["premises_convicted"])){
			$premises_convicted=json_decode($results["premises_convicted"]);
			$premises_convicted_a=$premises_convicted->a;
		}else{
			$premises_convicted_a="";
		}
		
		if($premises_convicted_a=="p_act1"){
			$premises_convicted_a="(a) Drugs Act, 1940.";
		}else if($premises_convicted_a=="p_act2"){
		   $premises_convicted_a="(b) Dangerous Drugs.";
	    }else if($premises_convicted_a=="p_act3"){
			$premises_convicted_a="(c) The Poisons";
	    }else if($premises_convicted_a=="p_act4"){
			$premises_convicted_a="(d) The Pharmacy";
		}else if($premises_convicted_a=="p_act5"){
			$premises_convicted_a="(e) Any other Act.";
		}else{
			$premises_convicted_a="";
		}
		if(!empty($results["licensing_authority"])){
			$licensing_authority=json_decode($results["licensing_authority"]);
			$licensing_authority_b=$licensing_authority->b;
		}else{
			$licensing_authority_b="";
		}
		
		if($licensing_authority_b=="Restaurant"){
			$licensing_authority_b="(a) Restaurant.";
		}else if($licensing_authority_b=="Grocer"){
		   $licensing_authority_b="(b) Grocer.";
	    }else if($licensing_authority_b=="Panbidi_shop"){
			$licensing_authority_b="(c) Panbidi shop";
	    }else if($licensing_authority_b=="General_Marchant"){
			$licensing_authority_b="(d) General Marchant.";
		}else if($licensing_authority_b=="Drug_Stores"){
			$licensing_authority_b="(e) Drug Stores.";
		}else if($licensing_authority_b=="Chemist_and_Druggist"){
			$licensing_authority_b="(f) Chemist and Druggist.";
		}else if($licensing_authority_b=="Despensing_Chemist"){
			$licensing_authority_b="(g) Despensing Chemist ?";
		}else if($licensing_authority_b=="Distributing_Agency"){
			$licensing_authority_b="(h) Distributing Agency ?";
		}else if($licensing_authority_b=="Importer"){
			$licensing_authority_b="(j) Importer ?";
		}else{
			$licensing_authority_b="";
		}
		
		$business_carried=$results["business_carried"];$is_engaged=$results["is_engaged"];$is_engaged_det=$results["is_engaged_det"];$business_crri=$results["business_crri"];$license_yr=$results["license_yr"];$licenses_granted=$results["licenses_granted"];$is_rejected=$results["is_rejected"];$is_rejected_det=$results["is_rejected_det"];$is_selling_goods=$results["is_selling_goods"];$is_spirituous_medicinal=$results["is_spirituous_medicinal"];$is_spirituous_medicinal_det=$results["is_spirituous_medicinal_det"];$is_license_previously=$results["is_license_previously"];$is_license_previously_det=$results["is_license_previously_det"];$is_agent_distributor=$results["is_agent_distributor"];$rooms_storage=$results["rooms_storage"];$floor_area=$results["floor_area"];$room_sketch=$results["room_sketch"];$is_license=$results["is_license"];$is_agent_distributor_det=$results["is_agent_distributor_det"];
		
		if($is_license=="F"){
		  $is_license="FRESH";
		}else{
		  $is_license="RENEWAL";
		}
		
		if($is_rejected=="Y"){
		  $is_rejected="YES";
		}else{
		  $is_rejected="NO";
		}
		
		if($is_selling_goods=="Y"){
		  $is_selling_goods="YES";
		}else{
		  $is_selling_goods="NO";
		}
		
		if($is_spirituous_medicinal=="Y"){
		  $is_spirituous_medicinal="YES";
		}else{
		  $is_spirituous_medicinal="NO";
		}
		
		if($is_engaged=="Y"){
		  $is_engaged="YES";
		}else{
		  $is_engaged="NO";
		}
		
		if($is_license_previously=="Y"){
		  $is_license_previously="YES";
		}else{
		  $is_license_previously="NO";
		}
		
		if($is_agent_distributor=="Y"){
		  $is_agent_distributor="YES";
		}else{
		  $is_agent_distributor="NO";
		}
		
		//tab3//
		if(!empty($results["drugs_stocked"])){
			$drugs_stocked=json_decode($results["drugs_stocked"]);
			$drugs_stocked_p=$drugs_stocked->p;$drugs_stocked_inj=$drugs_stocked->inj;$drugs_stocked_oral=$drugs_stocked->oral;$drugs_stocked_hous=$drugs_stocked->hous;$drugs_stocked_spirit=$drugs_stocked->spirit;
		}else{
			$drugs_stocked_p="";$drugs_stocked_inj="";$drugs_stocked_oral="";$drugs_stocked_hous="";$drugs_stocked_spirit="";
		}
		$spirits_village=$results["spirits_village"];$spirits_medicinal=$results["spirits_medicinal"];$hours_business=$results["hours_business"];$trade_association=$results["trade_association"];$educational_qualifications=$results["educational_qualifications"];
    }

	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
   if(!isset($css)){
	$printContents='<!DOCTYPE html>
	<html lang="en">
	<head>
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4> '.$form_name.'</h4>
		</div><br/>
      <table class="table table-bordered table-responsive">
  		<tr>  				
			<td colspan="2">
			1. I/We <b>'.strtoupper($Name_of_owner).' </b>
			of <b>'.strtoupper($unit_name).'</b>&nbsp;,Hereby apply for the grant/renewal of a license to manufacture Ayurvedic (including Siddha) or Unani drugs on the premises situated at <b>'.strtoupper($unit_details).'</b>.
			</td>
		</tr>

		<tr>
			<td colspan="2">2. Name of Drugs to be manufactured.</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">	
							<thead>
							<tr>												
								<td width="20%">Sl No.</td>
								<td width="40%">Name</td>
								<td width="40%">Details</td>
								
							</tr>
							</thead>';					
								$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
								while($row_1=$part1->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_1["slno"]).'</td>
									<td>'.strtoupper($row_1["drugs_name"]).'</td>
									<td>'.strtoupper($row_1["drugs_det"]).'</td>
								</tr>';
								}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		
		<tr>
			<td colspan="2">3. Names, Qualification and Experience of technical staff employed for manufacture and testing of Ayurvedic (including Siddha) or Unani Drugs. </td>
		</tr>
		<tr>
			<td colspan="2">
					<table class="table table-bordered table-responsive">	
							<thead>
							<tr>												
									<th width="10%">Sl. No.</th>
									<th width="30%">Name</th>
								    <th width="30">Qualification</th>
									<th width="30%">Experience</th>
									
								
				            </tr>
							</thead>';					
								$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
								while($row_2=$part2->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_2["slno"]).'</td>
									<td>'.strtoupper($row_2["name"]).'</td>
									<td>'.strtoupper($row_2["qualification"]).'</td>
									<td>'.strtoupper($row_2["experience"]).'</td>
									
								</tr>';
								}$printContents=$printContents.'
					</table>
			</td>
		</tr>
		<tr>
				<td colspan="2" height="50px"><font color="red"><b>Declaration.</b></font></td>
		</tr>	
		
		<tr>
			<td colspan="2">
			1.<b>'.strtoupper($key_person).','.strtoupper($status_applicant).' </b>
			 hereby declare that the words “Ayurvedic/Unani/Proprietary medicine” shall be printed prominently one each label of Ayurvedic/Unani Medicine which will be manufactured by M/S.  <b>'.strtoupper($unit_name).'</b>
			</td>
					
		</tr>					
		<tr>
			<td colspan="2">
			  2. Certified that there is no resemblance of the product of M/S. <b>'.strtoupper($unit_name).' </b> <br/>
			  b. <b>'.strtoupper($dec1).'</b> With other drugs of any system of medicine and there is no drug in the market with the same name and also does not bear any resemblance to any other brand name.
			</td>
					
		</tr>		
		<tr>
			<td colspan="2">
			   3. Certified that I will abide by the D & C Act., 1940 and D & C Rules 1945 and I will not violate the DMR & objectionable Advertisement Act. 1954 ad I follow G.M.P. Guidelines.
			</td>
					
		</tr>		
		<tr>
			<td colspan="2">
			   4. Certified that , the information given in this application is true and correct to the best of my knowledge and I have not furnished my false information with a view to obtain Ayurvedic/Unani drug manufacturing license.
			</td>
					
		</tr>
        <tr>
		  <td>1. Names of all partners of Directors, products,etc and full residential address of each :-</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th width="5%">Sl. No.</th>
							<th width="25%">Partners/Directors Name</th>
							<th width="20%">Street Name 1</th>
							<th width="15%">Street Name 2</th>
							<th width="15%">Village/Town</th>
							<th width="10%">District</th>
							<th width="10%">Pincode</th>
						</tr>
					</thead>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$ayush->error);
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
					<tr align="center">
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->name).'</td>
						<td>'.strtoupper($rows->sn1).'</td>
						<td>'.strtoupper($rows->sn2).'</td>
						<td>'.strtoupper($rows->vill).'</td>
						<td>'.strtoupper($rows->dist).'</td>
						<td>'.strtoupper($rows->pin).'</td>
					</tr>';
						$sl++;
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
	
		<tr>
			<td valign="top"> 2. What are the educational qualifications of the applicant (b) person in-charge of the premises for which license is applied for.  </td>
			<td>'.strtoupper($educational_qualifications).'  </td>
		</tr>
		<tr>
			<td valign="top">3. What are the business carried on by the applicant within last three years ? </td>
			<td>'.strtoupper($business_carried).'    </td>
		</tr>
		<tr>
			<td valign="top">4. Has the applicant ever engaged himself or on behalf of any other person in selling drugs any time prior to this application ? If so dates together with necessary documentary evidence may be supplied. </td>
			<td >'.strtoupper($is_engaged).'  &nbsp;&nbsp; '.strtoupper($is_engaged_det).' </td>
		</tr>
		<tr>
			<td valign="top">5. What other business is carried on by the applicant at present ? </td>
			<td>'.strtoupper($business_crri).'</td>
		</tr>							
		<tr>
			<td>6. Is the application for fresh license or renewal? </td>									
			<td>'.strtoupper($is_license).'</td>
		</tr>  							
		<tr>
			<td>7. Year in which license was first granted :</td>
			<td>'.strtoupper($license_yr).'</td>
		</tr>   							
		<tr>
			<td>8. Particulars of licenses granted License No.from date of issue Drugs Rules.</td>	
			<td>'.strtoupper($licenses_granted).'</td>
		</tr>   							
		<tr>
			<td>9. Was the application ever rejected or license previously cancelled or surrendered ? If so what reason ?</td>	
			<td>'.strtoupper($is_rejected).' &nbsp;&nbsp;  '.strtoupper($is_rejected_det).'</td>
		</tr>    							
		<tr>
			<td>10. Was the applicant ever warned for selling goods which were not of standard quality ?</td>	
			<td>'.strtoupper($is_selling_goods).' </td>
		</tr>     							
		<tr>
		  <td>11. Was the applicant or any person employed by him on these premises ever convicted and sentenced under :</td>	
		  <td>'.strtoupper($premises_convicted_a).'</td>
		</tr>  	
		     							
		<tr>
			<td>12.(A) Has the applicant ever imported spirituous Medicinal or toilet preparations from other states ? If so a statement of the names of the manufacturers.</td>	
			<td>'.strtoupper($is_spirituous_medicinal).' &nbsp;&nbsp; '.strtoupper($is_spirituous_medicinal_det).' </td>
		</tr>      							
		<tr>
			<td>(B) Was the application ever rejected or license previously cancelled or surrendered ? If so what reason ?  </td>	
			<td>'.strtoupper($is_license_previously).' &nbsp;&nbsp;  '.strtoupper($is_license_previously_det).' </td>
		</tr>      							
		<tr>
			<td>13. Is the applicant an agent or distributor of any drug manufacturing concern ?</td>	
			<td>'.strtoupper($is_agent_distributor).' &nbsp;&nbsp; '.strtoupper($is_agent_distributor_det).' </td>
		</tr>     							
		<tr>
			<td colspan="2">The applicant shall inform the Licensing Authority if the agency is terminated any time during which the license in force.</td>	
		</tr>      							
		<tr>
			<td>14. Is the Firm or Company :</td>	
			<td>'.strtoupper($licensing_authority_b).' </td>
		</tr>       							
		<tr>
			<td>15.(a) The applicant has in all rooms for storage and sale of drugs:</td>	
			<td>'.strtoupper($rooms_storage).' </td>
		</tr>       							
		<tr>
			<td>(b).The floor area in square feet of each room for storage and sale of drugs :</td>	
			<td>'.strtoupper($floor_area).' </td>
		</tr>      							
		<tr>
			<td>(c).The floor area in square feet of each room must be given with a sketch.</td>	
			<td>'.strtoupper($room_sketch).' </td>
		</tr>    							
		<tr>
			<td colspan="2"><strong><u>16. The applicant does/does not stocker sell drugs at any other premises for which this application is applied for:-</u></strong></td>
		</tr>
		<tr>
			<td colspan="2">
					<table class="table table-bordered table-responsive">	
							<thead>
							<tr>												
									<th width="10%">Sl. No.</th>
									<th width="30%">Address 1</th>
								    <th width="30">Address 2</th>
									<th width="30%">Address 3</th>
									
								
				            </tr>
							</thead>';					
								$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
								while($row_3=$part3->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_3["slno"]).'</td>
									<td>'.strtoupper($row_3["address_1"]).'</td>
									<td>'.strtoupper($row_3["address_2"]).'</td>
									<td>'.strtoupper($row_3["address_3"]).'</td>
									
								</tr>';
								}$printContents=$printContents.'
					</table>
			</td>
		</tr>
		<tr>
			<td>17. What class of drugs are stocked sold or distributed :-</td>	
		</tr> 
		
        <tr>
			<td>(a) Poisons.</td>	
			<td>'.strtoupper($drugs_stocked_p).' </td>
		</tr>
 		<tr>
			<td>(b) Injections.</td>	
			<td>'.strtoupper($drugs_stocked_inj).' </td>
		</tr>
		<tr>
			<td>(c) Oral vitamin Products.</td>	
			<td>'.strtoupper($drugs_stocked_oral).' </td>
		</tr>
		<tr>
			<td>(d) Household remedies.</td>	
			<td>'.strtoupper($drugs_stocked_hous).' </td>
		</tr>
		<tr>
			<td>(e) Tinctures and other Spirituous Preparations.</td>	
			<td>'.strtoupper($drugs_stocked_spirit).' </td>
		</tr>
		<tr>
			<td colspan="2"><strong><u>18. The applicant deals in the following class of commodities only besides drugs on these premises viz. :-</u></strong></td>
		</tr>
		<tr>
			<td colspan="2">
					<table class="table table-bordered table-responsive">	
							<thead>
							<tr>												
									<th width="30%">Sl. No.</th>
									<th width="60%">Class of commodities </th>
				            </tr>
							</thead>';					
								$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
								while($row_4=$part4->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_4["slno"]).'</td>
									<td>'.strtoupper($row_4["class_commo"]).'</td>
								</tr>';
								}$printContents=$printContents.'
					</table>
			</td>
		</tr>
		<tr>
			<td>19. The applicant was/was not dealing in Spirits/Wine/Country Liquor prior to introductions of Prohibition Act. In the applicants Village or town.  </td>	
			<td>'.strtoupper($spirits_village).' </td>
		</tr>      							
		<tr>
			<td>20. The applicant will deal/will not deal in any spirituous Medicinal or toilet preparations which are liable to be misused for other that bona-fide medicinal purposes.</td>	
			<td>'.strtoupper($spirits_medicinal).'</td>
		</tr>     							    							
		<tr>
			<td>21. Hours of business and working day.</td>	
			<td>'.strtoupper($hours_business).' </td>
		</tr>       							
		<tr>
			<td>22. Name of the trade or professional Association of which applicant is a member and the date of commencement of membership.</td>	
			<td>'.strtoupper($trade_association).' </td>
		</tr>       							 		
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td width="50%"> Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
			<td align="right"><b>'.strtoupper($key_person).'</b><br/>Signature of the Applicant</td>
        </tr>
    </tbody>
</table>';

?>

