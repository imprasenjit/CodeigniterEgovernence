<?php
$dept="factory";
$form="6";
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

if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$year_ending=$results['year_ending'];$reg_no=$results['reg_no'];$district=$results['district'];
		$sub_division=$results['sub_division'];	$industry_nature=$results['industry_nature'];$is_factory=$results['is_factory'];
		
		if(!empty($results["name"])){
			$name=json_decode($results["name"]);
			$name_occupier=$name->occupier;$name_manager=$name->manager;
		}else{
			$name_occupier="";$name_manager="";
		}
		if(!empty($results["hours1"])){
			$hours1=json_decode($results["hours1"]);
			$hours1_men=$hours1->men;$hours1_women=$hours1->women;$hours1_children=$hours1->children;$hours1_men1=$hours1->men1;$hours1_women1=$hours1->women1;$hours1_children1=$hours1->children1;$hours1_men2=$hours1->men2;$hours1_women2=$hours1->women2;$hours1_children2=$hours1->children2;
		}else{
			$hours1_men="";$hours1_women="";$hours1_children="";$hours1_men1="";$hours1_women1="";$hours1_children1="";;$hours1_men2="";$hours1_women2="";$hours1_children2="";
		}
		
		if(!empty($results["day"])){
			$day=json_decode($results["day"]);
			$day_total=$day->total;$day_men=$day->men;$day_women=$day->women;$day_children=$day->children;
		}else{
			$day_total="";$day_men="";$day_women="";$day_children="";
		}
		
		if(!empty($results["adult"])){
			$adult=json_decode($results["adult"]);
			$adult_men=$adult->men;$adult_women=$adult->women;
		}else{
			$adult_men="";$adult_women="";
		}
		
		if(!empty($results["adole"])){
			$adole=json_decode($results["adole"]);
			$adole_male=$adole->male;$adole_female=$adole->female;
		}else{
			$adole_male="";$adole_female="";
		}
		
		if(!empty($results["children"])){
			$children=json_decode($results["children"]);
			$children_boys=$children->boys;$children_girls=$children->girls;
		}else{
			$children_boys="";$children_girls="";
		}
		
		
		//TAB//
		
		$number_workers=$results['number_workers'];	$is_ambulance=$results['is_ambulance'];
		$is_provided=$results['is_provided'];$departmental=$results['departmental'];$contractor=$results['contractor'];$is_adequate=$results['is_adequate'];$is_creche=$results['is_creche'];$number_acci=$results['number_acci'];$mondays_lost=$results['mondays_lost'];$is_suggestion=$results['is_suggestion'];$num_suggestion=$results['num_suggestion'];$case_prize=$results['case_prize'];
		
		if(!empty($results["hours"])){
			$hours=json_decode($results["hours"]);
			$hours_men2=$hours->men2;$hours_women2=$hours->women2;$hours_children2=$hours->children2;$hours_men3=$hours->men3;$hours_women3=$hours->women3;$hours_children3=$hours->children3;
		}else{
			$hours_men2="";$hours_women2="";$hours_children2="";$hours_men3="";$hours_women3="";$hours_children3="";
		}
		if(!empty($results["number"])){
			$number=json_decode($results["number"]);
			$number_wages=$number->wages;$number_officers=$number->officers;$number_safety=$number->safety;
		}else{
			$number_wages="";$number_officers="";$number_safety="";
		}
		
		if(!empty($results["welfare"])){
			$welfare=json_decode($results["welfare"]);
			$welfare_required=$welfare->required;$welfare_appointed=$welfare->appointed;
		}else{
			$welfare_required="";$welfare_appointed="";
		}
		
		if(!empty($results["accidents"])){
			$accidents=json_decode($results["accidents"]);
			$accidents_fatal=$accidents->fatal;$accidents_nonfatal=$accidents->nonfatal;
		}else{
			$accidents_fatal="";$accidents_nonfatal="";
		}
		
		if(!empty($results["previous"])){
			$previous=json_decode($results["previous"]);
			$previous_acci=$previous->acci;$previous_lost=$previous->lost;
		}else{
			$previous_acci="";$previous_lost="";
		}
		if(!empty($results["thisyr"])){
			$thisyr=json_decode($results["thisyr"]);
			$thisyr_acci=$thisyr->acci;$thisyr_lost=$thisyr->lost;
		}else{
			$thisyr_acci="";$thisyr_lost="";
		}
		
		if(!empty($results["awarded"])){
			$awarded=json_decode($results["awarded"]);
			$awarded_amt=$awarded->amt;$awarded_maxcash=$awarded->maxcash;$awarded_mincash=$awarded->mincash;
		}else{
			$awarded_amt="";$awarded_maxcash="";$awarded_mincash="";
		}
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
	<tr>
            <td>For the year ending 31st December :</td>
            <td>'.strtoupper($year_ending).'</td>
		</tr>
  	    <tr>
            <td width="50%">1. Registration Number of Factory:</td>
            <td> '.strtoupper($reg_no).'</td>
		</tr> 
		<tr>
            <td>2. Name of Factory:</td>
            <td> '.strtoupper($unit_name).'</td>
		</tr>
		<tr>
            <td>3. Name of the Occupier :</td>
            <td> '.strtoupper($name_occupier).'</td>
		</tr>
		<tr>
            <td>4. Name of the Manager :</td>
            <td> '.strtoupper($name_manager).'</td>
		</tr>
		<tr>
            <td>5. District :</td>
            <td> '.strtoupper($district).'</td>
		</tr>
		<tr>
            <td>6. Sub-Division:</td>
            <td> '.strtoupper($sub_division).'</td>
		</tr>
		<tr>
            <td>7. Full postal address of factory :</td>
		</tr>
		<tr>
			<td>ii. Postal address of the applicant :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td >'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$b_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
				<td>8. Nature of Industry   :</td>
				<td>'.strtoupper($industry_nature).'</td>
		</tr>
		<tr>
		      <td colspan="2">Number of workers and particulars of employment :</td>
		</tr>
		<tr>
				<td>9. Number of days worked in the year  :</td>
				<td>'.strtoupper($day_total).'</td>
		</tr>
		<tr>
		      <td colspan="2">10. Number of mandays worked in the year :</td>
		</tr>
		<tr>
				<td>( a ) Men  :</td>
				<td>'.strtoupper($day_men).'</td>
		</tr>
		<tr>
				<td>( b ) Women  :</td>
				<td>'.strtoupper($day_women).'</td>
		</tr>
		<tr>
				<td>( c ) Children  :</td>
				<td>'.strtoupper($day_children).'</td>
		</tr>
		<tr>
		       <td colspan="2">11.Average number of workers employed daily ( See Explanatory note) :</td>
		</tr>
		<tr>
			  <td>( a ) Adults :</td>
		</tr>
		<tr>
				<td>( I ) Men  :</td>
				<td>'.strtoupper($adult_men).'</td>
		</tr>
		<tr>
				<td>( II ) Women  :</td>
				<td>'.strtoupper($adult_women).'</td>
		</tr>
		<tr>
			  <td colspan="2">( b ) Adolescents :</td>
		</tr>
		<tr>
				<td>( I ) Male :</td>
				<td>'.strtoupper($adole_male).'</td>
		</tr>
		<tr>
				<td>( II ) Female :</td>
				<td>'.strtoupper($adole_female).'</td>
		</tr>
		<tr>
				<td colspan="2">( c ) Children :</td>
		</tr>
		<tr>
				<td>( I ) Boys </td>
				<td>'.strtoupper($children_boys).'</td>
		</tr>
		<tr>
				<td>( II ) Girls </td>
				<td>'.strtoupper($children_girls).'</td>
		</tr>
		<tr>
				<td colspan="2">12. Total number of man-hours worked including over-time. :</td>
	    </tr>
		<tr>
				<td>( a ) Men  :</td>
				<td>'.strtoupper($hours1_men).'</td>
		</tr>
		<tr>
				<td>( b ) Women  :</td>
				<td>'.strtoupper($hours1_women).'</td>
		</tr>
		<tr>
				<td>( c ) Children  :</td>
				<td>'.strtoupper($hours1_children).'</td>
		</tr>
		<tr>
			  <td colspan="2">13. Average number of hours worked per week (See explanatory note) :</td>
		</tr>
		<tr>
				<td>( a ) Men  </td>
				<td>'.strtoupper($hours1_men1).'</td>
		</tr>
		<tr>
				<td>( b ) Women  </td>
				<td>'.strtoupper($hours1_women1).'</td>
		</tr>
		<tr>
				<td>( c ) Children  </td>
				<td>'.strtoupper($hours1_children1).'</td>
		</tr>
		<tr>
				<td>14. ( a ) Does the factory carry out any process or operation declared as dangerous under Section 87 ? (See Rule 94)</td>
				<td>'.strtoupper($is_factory).'</td>
		</tr>
		<tr>
			    <td colspan="2">( b ) If so, give the following information.</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
						<td>Sl No.</td>
						<td>Name of the dangerous process or operations carried on</td>
						<td>Average number of persons employed daily in each of the processes or operations given in column 1</td>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["dangerous_process"]).'</td>
							<td>'.strtoupper($row_1["avg_num_person"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
	<tr>
			<td colspan="2">15. Total number of workers employed during the year. :</td>
		</tr>
		<tr>
				<td>( a ) Men  </td>
				<td>'.strtoupper($hours1_men2).'</td>
		</tr>
		<tr>
				<td>( b ) Women  </td>
				<td>'.strtoupper($hours1_women2).'</td>
		</tr>
		<tr>
				<td>( c ) Children  </td>
				<td>'.strtoupper($hours1_children2).'</td>
		</tr>
		<tr>
			    <td colspan="2">16. Number of worker who were entitled to annual leave with wages during the year. :</td>
		</tr>
		<tr>
				<td>( a ) Men  </td>
				<td>'.strtoupper($hours_men2).'</td>
		</tr>
		<tr>
				<td>( b ) Women  </td>
				<td>'.strtoupper($hours_women2).'</td>
		</tr>
		<tr>
				<td>( c ) Children  </td>
				<td>'.strtoupper($hours_children2).'</td>
		</tr>
		<tr>
			    <td colspan="2">17. Number of worker who were granted leave during the year. :</td>
		</tr>
		<tr>
				<td>( a ) Men  </td>
				<td>'.strtoupper($hours_men3).'</td>
		</tr>
		<tr>
				<td>( b ) Women  </td>
				<td>'.strtoupper($hours_women3).'</td>
		</tr>
		<tr>
				<td>( c ) Children  </td>
				<td>'.strtoupper($hours_children3).'</td>
		</tr>
		<tr>
				<td>18.( a ) Number of workers who were discharged or dismissed from the service or quit employment or were superannuated or who died while in service during the year  </td>
				<td>'.strtoupper($number_workers).'</td>
		</tr>
		<tr>
				<td>( b ) Number of such workers in respect of whom wages in lieu of leave were paid   </td>
				<td>'.strtoupper($number_wages).'</td>
		</tr>
		<tr>
				<td>19. ( a ) Number of Safety Officers required to be appointed as per Notification under Section 40-B </td>
				<td>'.strtoupper($number_officers).'</td>
		</tr>
		<tr>
				<td>( b ) Number of Safety Officer appointed  </td>
				<td>'.strtoupper($number_safety).'</td>
		</tr>
		<tr>
				<td>20. Is there an Ambulance Room provided in the factory as required under Section 45 ? </td>
				<td>'.strtoupper($is_ambulance).'</td>
		</tr>
		<tr>
				<td>21. ( a ) Is there a Canteen provided in the factory as required under Section 46 ? </td>
				<td>'.strtoupper($is_provided).'</td>
		</tr>
		<tr>
			  <td colspan="2">( b ) Is the Canteen provided managed/run.</td>
		</tr>
		<tr>
				<td>( I ) Departmentally, or?  </td>
				<td>'.strtoupper($departmental).'</td>
		</tr>
		<tr>
				<td>( ii ) Through a contractor? </td>
				<td>'.strtoupper($contractor).'</td>
		</tr>
		<tr>
				<td>22. ( a ) Are there adequate and suitable Shelters or Rest Rooms Provided in factory required under Section 47 ? </td>
				<td>'.strtoupper($is_adequate).'</td>
		</tr>
		<tr>
				<td>23.Is there a creche provided in the factory as required under Section 48 ?</td>
				<td>'.strtoupper($is_creche).'</td>
		</tr>
		<tr>
				<td>24.( a ) Number of Welfare Officers to be appointed as required under Section 49</td>
				<td>'.strtoupper($welfare_required).'</td>
		</tr>
		<tr>
				<td>( b ) Number of Welfare Officers appointed</td>
				<td>'.strtoupper($welfare_appointed).'</td>
		</tr>
		<tr>
		       <td colspan="2">25. ( a ) Total number of accidents :</td>
		</tr>
		<tr>
				<td>( I ) Fatal</td>
				<td>'.strtoupper($accidents_fatal).'</td>
		</tr>
		<tr>
				<td>( ii ) Non-Fatal</td>
				<td>'.strtoupper($accidents_nonfatal).'</td>
		</tr>
		<tr>
		      <td colspan="2">( b ) Accidents in which workers returned to work during the year to which this relates :</td>
		</tr>
		<tr>
		      <td colspan="2">( I ) Accident (workers injured) occurring during the year in which injured workers returned to work during the same year.</td>
		</tr>
		<tr>
				<td>( a ) Number of accidents</td>
				<td>'.strtoupper($number_acci).'</td>
		</tr>
		<tr>
				<td>( b ) Mondays lost due to accidents</td>
				<td>'.strtoupper($mondays_lost).'</td>
		</tr>
		<tr>
			   <td colspan="2">( ii ) Accidents (Workers injured) occurring in the previous year in which injured workers returned to work during the year to which this return relates.</td>
		</tr>
		<tr>
				<td>( a ) Numbers of accidents</td>
				<td>'.strtoupper($number_acci).'</td>
		</tr>
		<tr>
				<td>( b ) Mondays lost due to accidents</td>
				<td>'.strtoupper($mondays_lost).'</td>
		</tr>
		<tr>
			   <td colspan="2">( c ) Accidents (workers injured) occurring during the year in which injured workers did not return to work during the year to which this return relates.</td>
		</tr>
		<tr>
				<td>( I ) Number of accidents</td>
				<td>'.strtoupper($thisyr_acci).'</td>
		</tr>
		<tr>
				<td>( ii ) Mondays lost due to accidents</td>
				<td>'.strtoupper($thisyr_lost).'</td>
		</tr>
		<tr>
				<td>26. ( a ) Is a Suggestion Scheme in operation in the factory</td>
				<td>'.strtoupper($is_suggestion).'</td>
		</tr>
		<tr>
				<td>( b ) If so, the number of suggestion</td>
				<td>'.strtoupper($num_suggestion).'</td>
		</tr>
		<tr>
				<td>(c ) Amount awarded in case prize during the year </td>
				<td>'.strtoupper($case_prize).'</td>
		</tr>
		<tr>
				<td>( I ) Total amount awarded </td>
				<td>'.strtoupper($awarded_amt).'</td>
		</tr>
		<tr>
				<td>( ii ) Value of the maximum cash prize awarded </td>
				<td>'.strtoupper($awarded_maxcash).'</td>
		</tr>
		<tr>
				<td>( iii ) Value of the minimum cash prize awarded </td>
				<td>'.strtoupper($awarded_mincash).'</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td colspan="2" align="right">Signature of Factory Manager : <strong>'.strtoupper($key_person).'</strong><br/>	
		Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>		
	</tr>
</table>';
?>