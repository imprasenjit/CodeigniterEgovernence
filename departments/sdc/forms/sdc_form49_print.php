<?php
$dept="sdc";
$form="49";
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

	if($q->num_rows > 0){
		$results=$q->fetch_array();	
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$crude_drugs=$results["crude_drugs"];$mech_cont=$results["mech_cont"];$sur_dressing=$results["sur_dressing"];$chromatography=$results["chromatography"];$disinfectants=$results["disinfectants"];$other_drugs=$results["other_drugs"];$products=$results["products"];$antibiotics=$results["antibiotics"];$vitamins=$results["vitamins"];$parental=$results["parental"];$suture=$results["suture"];$test_animal=$results["test_animal"];$microbiological=$results["microbiological"];$homoeopathic=$results["homoeopathic"];$photometer=$results["photometer"];$cosmetics=$results["cosmetics"];$testing=$results["testing"];$drugs=$results["drugs"];$prev_apprv_no=$results["prev_apprv_no"];
		if($results["prev_issue_date"]!="" || $results["prev_issue_date"]!='00-00-0000' || $results["prev_issue_date"]!='0000-00-00'){
			$prev_issue_date=date('d-m-Y',strtotime($results["prev_issue_date"]));
		}else{
			$prev_issue_date="";
		}
	}		
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
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
		<tr>
			<td colspan="2">1.I/We  &nbsp;'.strtoupper($auth_person).'&nbsp; of &nbsp;'.strtoupper($unit_name).'&nbsp; hereby apply for the grant or renewal of approval for carrying out tests of identity, purity, quality and strength on the following categories of drugs/items of cosmetics or raw materials used in the manufacture thereof on behalf of licensees for manufacture for sale of drugs/cosmetics.</td>
		</tr>
		<tr>
			<td colspan="2">2.Categories of drugs, items of cosmetics :</td>
		</tr>
		<tr>
			<td colspan="2">(a)  Drugs other than those specified in Schedules C and C(1)  and also excluding Homoeopathic Drugs  :</td>
		</tr>
		<tr>
			<td width="50%">1.Crude vegetable drugs. :</td>
			<td width="50%">'.strtoupper($crude_drugs).'</td>
		</tr>
		<tr>
			<td width="50%">2.Mechanical contraceptives :</td>
			<td width="50%">'.strtoupper($mech_cont).'</td>
		</tr>
		<tr>
			<td width="50%">3.Surgical dressings :</td>
			<td width="50%">'.strtoupper($sur_dressing).'</td>
		</tr>
		<tr>
			<td width="50%">4.Drugs requiring the use ultraviolet/Intra Red Spectro- photometer or Chromatography :</td>
			<td width="50%">'.strtoupper($chromatography).'</td>
		</tr>
		<tr>
			<td width="50%">5.Disinfectants :</td>
			<td width="50%">'.strtoupper($disinfectants).'</td>
		</tr>
		<tr>
			<td width="50%">6.Other drugs :</td>
			<td width="50%">'.strtoupper($other_drugs).'</td>
		</tr>
		<tr>
			<td colspan="2">(b)  Drugs specified in Schedules C and C(1)</td>
		</tr>
		<tr>
			<td width="50%">1.Sera, Vaccines, Antigens, Toxins, Antitoxins, Toxoids, Bacteriophages and similar Immunological Products. :</td>
			<td width="50%">'.strtoupper($products).'</td>
		</tr>
		<tr>
			<td width="50%">2.Antibiotics :</td>
			<td width="50%">'.strtoupper($antibiotics).'</td>
		</tr>
		<tr>
			<td width="50%">3.Vitamins :</td>
			<td width="50%">'.strtoupper($vitamins).'</td>
		</tr>
		<tr>
			<td width="50%">4.Parenteral preparations :</td>
			<td width="50%">'.strtoupper($parental).'</td>
		</tr>
		<tr>
			<td width="50%">5.Sterilised surgical ligature/suture :</td>
			<td width="50%">'.strtoupper($suture).'</td>
		</tr>
		<tr>
			<td width="50%">6. Drugs requiring the use of animals for the test :</td>
			<td width="50%">'.strtoupper($test_animal).'</td>
		</tr>
		<tr>
			<td width="50%">7. Drugs requiring microbiological tests. :</td>
			<td width="50%">'.strtoupper($microbiological).'</td>
		</tr>
		<tr>
			<td width="50%">8. Drugs requiring the use of Ultraviolet/Infra Red Spectro-photometer or Chromatography :</td>
			<td width="50%">'.strtoupper($photometer).'</td>
		</tr>
		<tr>
			<td width="50%">9. Other drugs:</td>
			<td width="50%">'.strtoupper($drugs).'</td>
		</tr>
		<tr>
			<td width="50%">(c)  Homoeopathic drugs. :</td>
			<td width="50%">'.strtoupper($homoeopathic).'</td>
		</tr>
		<tr>
			<td width="50%">(d)  Cosmetics. :</td>
			<td width="50%">'.strtoupper($cosmetics).'</td>
		</tr>
		<tr>
			<td colspan="2">3. Names, qualifications and experience of expert staff employed for testing and the person-incharge of testing. :</td>
		</tr>
		<tr>
			<td colspan="2"><table class="table table-bordered table-responsive">
			<tr align="center">
				<td align="center">Sl No </td>
				<td align="center"> Name </td>
				<td align="center">Qualification</td>
				<td align="center">Experience</td>			
				<td align="center">Person-Incharge</td>			
			</tr>';
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["qualification"]).'</td>
						<td>'.strtoupper($row_1["experience"]).'</td>
						<td>'.strtoupper($row_1["incharge"]).'</td>
				</tr>';
				}$printContents=$printContents.'
   		</table>   	</td>
		</tr>
		<tr>
			<td >4.  List of testing equipment provided. </td>
			<td width="50%">'.strtoupper($testing).'</td>
		</tr>
		<tr >
			<td colspan="2">5. I/We enclose a plan of the testing premises showing the location and area of the different sections thereof.</td>
		</tr>	
		<tr>
			<td>Approval No.</td>
			<td>'.strtoupper($prev_apprv_no).'</td>
		</tr>
		<tr>
			<td>Issue date</td>
			<td>'.strtoupper($prev_issue_date).'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'	
					
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="center"> Signature :<strong>'.strtoupper($key_person).'</strong><br/> 
			Designation :<strong>'.strtoupper($status_applicant).'</strong><br/> </td>				
		</tr>						
	</table>';
?>
