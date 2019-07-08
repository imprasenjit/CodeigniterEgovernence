<?php
$dept="labour";
$form="15";
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
		
		//TAB 1
		$manager_name=$results['manager_name'];$registration_no=$results['registration_no'];$reg_year=$results['reg_year'];$nature_of_business=$results['nature_of_business'];
		
			if(!empty($results["manager_address"])){
				$manager_address=json_decode($results["manager_address"]);
				$manager_address_sn1=$manager_address->sn1;$manager_address_sn2=$manager_address->sn2;$manager_address_vt=$manager_address->vt;$manager_address_d=$manager_address->d;$manager_address_p=$manager_address->p;$manager_address_mno=$manager_address->mno;
			}else{
				$manager_address_sn1="";$manager_address_sn2="";$manager_address_vt="";$manager_address_d="";$manager_address_p="";$manager_address_mno="";
			}
		
			if(!empty($results["type_of_worker"])){
					$type_of_worker=json_decode($results["type_of_worker"]);
					$type_of_worker_direct1=$type_of_worker->direct1;$type_of_worker_direct2=$type_of_worker->direct2;$type_of_worker_direct3=$type_of_worker->direct3;
					//$type_of_worker_direct4=$type_of_worker->direct4;
					
					$type_of_worker_direct5=$type_of_worker->direct5;$type_of_worker_direct6=$type_of_worker->direct6;
					
					$type_of_worker_casual1=$type_of_worker->casual1;$type_of_worker_casual2=$type_of_worker->casual2;$type_of_worker_casual3=$type_of_worker->casual3;
					
					//$type_of_worker_casual4=$type_of_worker->casual4;
					$type_of_worker_casual5=$type_of_worker->casual5;$type_of_worker_casual6=$type_of_worker->casual6;
					
					$type_of_worker_through_contractor1=$type_of_worker->through_contractor1;$type_of_worker_through_contractor2=$type_of_worker->through_contractor2;$type_of_worker_through_contractor3=$type_of_worker->through_contractor3;//$type_of_worker_through_contractor4=$type_of_worker->through_contractor4;
					$type_of_worker_through_contractor5=$type_of_worker->through_contractor5;$type_of_worker_through_contractor6=$type_of_worker->through_contractor6;
					
			}else{
					$type_of_worker_direct1="";$type_of_worker_direct2="";$type_of_worker_direct3="";$type_of_worker_direct4="";$type_of_worker_direct5="";$type_of_worker_direct6="";
					
					$type_of_worker_casual1="";$type_of_worker_casual2="";$type_of_worker_casual3="";$type_of_worker_casual4="";$type_of_worker_casual5="";$type_of_worker_casual6="";
					
					$type_of_worker_through_contractor1="";$type_of_worker_through_contractor2="";$type_of_worker_through_contractor3="";$type_of_worker_through_contractor4="";$type_of_worker_through_contractor5="";$type_of_worker_through_contractor6="";
					
					$type_of_worker_tot1="";$type_of_worker_tot2="";$type_of_worker_tot3="";$type_of_worker_tot4="";$type_of_worker_tot5="";$type_of_worker_tot6="";
			}
			$type_of_worker_direct4=$type_of_worker_direct1+$type_of_worker_direct2+$type_of_worker_direct3;
			$type_of_worker_casual4=$type_of_worker_casual1+$type_of_worker_casual2+$type_of_worker_casual3;
			$type_of_worker_through_contractor4=$type_of_worker_through_contractor1+$type_of_worker_through_contractor2+$type_of_worker_through_contractor3;
			
			$type_of_worker_tot1=$type_of_worker_direct1+$type_of_worker_casual1+$type_of_worker_through_contractor1;
			$type_of_worker_tot2=$type_of_worker_direct2+$type_of_worker_casual2+$type_of_worker_through_contractor2;
		    $type_of_worker_tot3=$type_of_worker_direct3+$type_of_worker_casual3+$type_of_worker_through_contractor3;
			$type_of_worker_tot4=$type_of_worker_direct4+$type_of_worker_casual4+$type_of_worker_through_contractor4;
			$type_of_worker_tot5=$type_of_worker_direct5+$type_of_worker_casual5+$type_of_worker_through_contractor5;
			$type_of_worker_tot6=$type_of_worker_direct6+$type_of_worker_casual6+$type_of_worker_through_contractor6;
		//TAB 2
		$no_of_days=$results['no_of_days'];$no_of_mandays=$results['no_of_mandays'];
		$max_no_employees=$results['max_no_employees'];$average_employees=$results['average_employees'];$service_card_no=$results['service_card_no'];
		
		$total_wages_a=$results['total_wages_a'];$total_wages_b=$results['total_wages_b'];$total_fine_a=$results['total_fine_a'];$total_fine_b=$results['total_fine_b'];$total_deduction_a=$results['total_deduction_a'];$total_deduction_b=$results['total_deduction_b'];
		
		$percentage_bonus=$results['percentage_bonus'];$eligible_beneficiaries=$results['eligible_beneficiaries'];$amount_bonus_paid=$results['amount_bonus_paid'];$payment_date=$results['payment_date'];$reasons=$results['reasons'];
		
		//TAB 3
		$nature=$results['nature'];$details_furnished=$results['details_furnished'];$annual_return=$results['annual_return'];$duration_contract=$results['duration_contract'];$avg_no_contract=$results['avg_no_contract'];
			
		$is_canteen=$results['is_canteen'];$is_rest_room=$results['is_rest_room'];$is_drinking_water=$results['is_drinking_water'];$is_creche=$results['is_creche'];$is_first_aid=$results['is_first_aid'];
				
			if(!empty($results["total"])){
				$total=json_decode($results["total"]);
				$total_no=$total->no;$total_man=$total->man;$total_day=$total->day;$total_worker=$total->worker;
			}else{
				$total_no="";$total_man="";$total_day="";$total_worker="";
			}		
			if(!empty($results["details"])){
				$details=json_decode($results["details"]);
				$details_a=$details->a;$details_b=$details->b;$details_c=$details->c;$details_d=$details->d;$details_e=$details->e;
			}else{
				$details_a="";$details_b="";$details_c="";$details_d="";$details_e="";
			}
			if(!empty($results["total_calculation"])){
				$total_calculation=json_decode($results["total_calculation"]);
				$total_calculation_a=$total_calculation->a;$total_calculation_b=$total_calculation->b;$total_calculation_c=$total_calculation->c;$total_calculation_d=$total_calculation->d;
				$total_calculation_e=$total_calculation->e;$total_calculation_f=$total_calculation->f;
			}else{
				$total_calculation_a="";$total_calculation_b="";$total_calculation_c="";$total_calculation_d="";$total_calculation_e="";$total_calculation_f="";$total_calculation_tot1="";$total_calculation_tot2="";$total_calculation_tot3="";
			}

           $total_calculation_tot1=$total_calculation_a+$total_calculation_b;
		   $total_calculation_tot2=$total_calculation_c+$total_calculation_d;
		   $total_calculation_tot3=$total_calculation_e+$total_calculation_f;
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
	
  	<div style="text-align:center"><br/><br/>
  	    '.$assamSarkarLogo.'<h4 align="center">'.$form_name.'</h4>
    </div>
	
      <table class="table table-bordered table-responsive">
	    <tr>  		
   	      <td width="50%">1. Name and address of establishment </td>
    	  <td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td> Full Name</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1 </td>
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
        			<td>E-Mail ID</td>
        			<td>'.$b_email.'</td>
      		 </tr>      		
    		</table>
    	 </td>
  	    </tr>
		<tr>  		
   	     <td>2. Name and Residential address of the employer / occupier / contractor</td>
    	  <td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1 </td>
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
        			<td>E-Mail ID</td>
        			<td>'.$email.'</td>
      		 </tr>      		
    		</table>
    	 </td>
  	    </tr>
		<tr>  		
   	     <td>3. Name and Residential address of the Manager/Person/ responsible for supervision or control of the establishment</td>
    	  <td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($manager_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1 </td>
        			<td>'.strtoupper($manager_address_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($manager_address_sn2).'</td>
      		</tr>      		
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($manager_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($manager_address_d).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($manager_address_p).'</td>
      		</tr>
			<tr>
        			<td>E-Mail ID</td>
        			<td>'.strtoupper($manager_address_mno).'</td>
      		 </tr>      		
    		</table>
    	 </td>
  	    </tr>
		<tr>
				<td colspan="2">4. Registration no./license no. and year of commencement of business.</td>
		</tr>
		<tr>
				<td>Registration no./license no. </td>
				<td>'.strtoupper($registration_no).'</td>
		</tr>
		<tr>
				<td>Year </td>
				<td>'.strtoupper($reg_year).'</td>
		</tr>
		<tr>
				<td>5. Nature of business activity carried on in establishment </td>
				<td>'.strtoupper($nature_of_business).'</td>
		</tr>
	    <tr>
			<td colspan="2">6. Details of employees employed by the establishment</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
					<tr>
						<th  class="text-center">Sl no.</th>
						<th  class="text-center">Type of worker</th>
						<th  class="text-center">Unskilled</th>
						<th  class="text-center">Semiskilled</th>
						<th  class="text-center">Skilled</th>
						<th  class="text-center">Total</th>
						<th  class="text-center">Male</th>
						<th  class="text-center">Female</th>
					</tr>
					</thead>
					<tr>
						<td>1</td>
						<td>Direct</td>
						<td>'.strtoupper($type_of_worker_direct1).'</td>
						<td>'.strtoupper($type_of_worker_direct2).'</td>
						<td>'.strtoupper($type_of_worker_direct3).'</td>
						<td>'.strtoupper($type_of_worker_direct4).'</td>
						<td>'.strtoupper($type_of_worker_direct5).'</td>
						<td>'.strtoupper($type_of_worker_direct6).'</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Casual/Temporary </td>
						<td>'.strtoupper($type_of_worker_casual1).'</td>
						<td>'.strtoupper($type_of_worker_casual2).'</td>
						<td>'.strtoupper($type_of_worker_casual3).'</td>
						<td>'.strtoupper($type_of_worker_casual4).'</td>
						<td>'.strtoupper($type_of_worker_casual5).'</td>
						<td>'.strtoupper($type_of_worker_casual6).'</td>
					</tr>
					<tr>
						<td>3  </td>
						<td>Through ContractorThrough Contractor</td>
						<td>'.strtoupper($type_of_worker_through_contractor1).'</td>
						<td>'.strtoupper($type_of_worker_through_contractor2).'</td>
						<td>'.strtoupper($type_of_worker_through_contractor3).'</td>
						<td>'.strtoupper($type_of_worker_through_contractor4).'</td>
						<td>'.strtoupper($type_of_worker_through_contractor5).'</td>
						<td>'.strtoupper($type_of_worker_through_contractor6).'</td>
					</tr>
					<tr>
						<td>4</td>
						<td>Total</td>
						<td>'.strtoupper($type_of_worker_tot1).'</td>
						<td>'.strtoupper($type_of_worker_tot2).'</td>
						<td>'.strtoupper($type_of_worker_tot3).'</td>
						<td>'.strtoupper($type_of_worker_tot4).'</td>
						<td>'.strtoupper($type_of_worker_tot5).'</td>
						<td>'.strtoupper($type_of_worker_tot6).'</td>
					</tr>
				</table>
				</td>
		</tr>
		<tr>
		   <td colspan="2" align="center"><b>Part A</b></td>
		</tr>
		<tr>
			  <td colspan="2">My establishment covered under the Payment of Wages Act, 1936. Minimum Wages Act, 1948, Assam Shops &amp; Establishment Act, 1971 and the States Rules made thereunder and all workers/office staff are paid wages/overtime wages as admissible and prescribed by the Government of Assam. I have maintain all the registers and records as required under the law.</td>
		</tr>
		<tr>
			  <td>1. No. of days the Shop / Establishment worked in the year</td>
			  <td>'.strtoupper($no_of_days).'</td>
		</tr>
		<tr>
		     <td>2. No. of mandays work in the year </td>
		     <td>'.strtoupper($no_of_mandays).'</td>
		</tr>
		<tr>
			  <td>3. Maximum no. of employees employed in any day in the year</td>
			  <td>'.strtoupper($max_no_employees).'</td>
		</tr>
		<tr>
		     <td>4. No. of Average employees employed in the year</td>
		     <td>'.strtoupper($average_employees).'</td>
		</tr>
		<tr>
		     <td>5. No. of service cards issued for applicable</td>
		     <td>'.strtoupper($service_card_no).'</td>
		</tr>
		<tr>
			<td colspan="2">6. Details of employees employed by the establishment</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
					<tr>
						<th  class="text-center"></th>
						<th  class="text-center">Male</th>
						<th  class="text-center">Female</th>
					</tr>
					</thead>
					<tr>
						
						<td>1. Total wages paid category wise</td>
						<td>'.strtoupper($total_wages_a).'</td>
						<td>'.strtoupper($total_wages_b).'</td>
					</tr>
					<tr>
						<td>2. Total fine imposed (if any)</td>
						<td>'.strtoupper($total_fine_a).'</td>
						<td>'.strtoupper($total_fine_b).'</td>
					</tr>
					<tr>
						<td>3. Total deduction (if any)</td>
						<td>'.strtoupper($total_deduction_a).'</td>
						<td>'.strtoupper($total_deduction_b).'</td>
					</tr>
				</table>
				</td>
		 </tr>
		<tr>
		   <td colspan="2" align="center"><b>Part B</b></td>
		</tr>
		<tr>
			<td colspan="2">The Part A and Part B information to be furnished if the maximum number of employees employed on any day during the year under report exceed 5 (Five).<br/>My Establishment is covered under the Payment of Bonus Act, 1965 and workers are paid Bonus. I have maintained records and registers as per the Act.</td>
		</tr>
        <tr>
					  <td>Percentage of Bonus paid </td>
					  <td>'.strtoupper($percentage_bonus).'</td>
		</tr>
		<tr>
					  <td>No. of eligible beneficiaries </td>
					  <td>'.strtoupper($eligible_beneficiaries).'</td>
		</tr>
		<tr>
					   <td>Total amount of Bonus paid  </td>
					   <td>'.strtoupper($amount_bonus_paid).'</td>
		</tr>
		<tr>
					  <td>Date of payment </td>
					  <td>'.strtoupper($payment_date).'</td>
		</tr>
		<tr>
					  <td>If Bonus no paid (Reasons thereof) </td>
					  <td>'.strtoupper($reasons).'</td>
		</tr>
		<tr>
		   <td colspan="2" align="center"><b>Part C</b></td>
		</tr>
		<tr>
			<td colspan="2">Part A, B and C are to be furnished if the Establishment has employed more than 9 (nine) no. of contract labour on any day during the year under report.(Details to be provided by the Principal Employer).<br/>My Establishment is covered under the Contract Labour (Regulation &amp; Abolition) Act, 1970 and the State Rules made thereunder and the workers are paid wages and overtime wages as prescribed by Govt. of Assam. I have maintained the records and registers as per the Act.</td>
		</tr>
        <tr>  		
   	      <td width="50%">1. Name and postal address of the contractor </td>
    	  <td>
    		<table class="table table-bordered table-responsive">
                <tr>
							   <td>Name </td>
							   <td>'.strtoupper($key_person).'</td>
				</tr>				
				<tr>
								<td>Street Name 1</td>
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
							   <td>E-Mail ID</td>
							   <td>'.$email.'</td>
                </tr>      		
    		</table>
    	 </td>
  	    </tr>
		
		<tr>
                    <td>2.Nature of work/operation of the contractor </td>
                    <td>'.strtoupper($nature).'</td>
		</tr> 
		<tr>
					<td>3. Total No. of days during the year on whivh contract labour was employed.</td>
					<td>'.strtoupper($total_no).'</td>
		</tr> 
		<tr>
					<td>4. Total No. of mandays worked during the year by the contract labour.</td>
					<td>'.strtoupper($total_man).'</td>
		</tr> 				
		<tr>
					<td>5. Total No. of days during the year in which direct labour was employed. </td>
					<td>'.strtoupper($total_day).'</td>
		</tr>
		<tr>
					<td>6. Total No. mandays worked by the direct labour. </td>
					<td>'.strtoupper($total_worker).'</td>
		</tr>
		<tr>
					<td>7. Change if any in the management of establishment, its location or any particulars furnished to the Registering Officer in the application for the registration (Details may be furnished with date of changes).</td>
					<td>'.strtoupper($details_furnished).'</td>
		</tr>
		<tr>
					<td colspan="2">(Note :- In case the no. of contractors are more than 1 (One), the details of each contractors may be furnished in same columns in separate sheets)</td>
		</tr>
		<tr>
					<td>8. Annual Return to be submitted by the Contractor(s).</td>
					<td>'.strtoupper($annual_return).'</td>
		</tr>
		<tr>
		            <td colspan="2">Employing more than 9 (Nine) workers.</td>
		</tr>
		<tr>
			       <td>9. Duration of contract (Number of days work during the year). </td>
			       <td>'.strtoupper($duration_contract).'</td>
		</tr>
		<tr>
			      <td>10. Average No. of Contract labour worked in any day during the year</td>
			      <td>'.strtoupper($avg_no_contract).'</td>
		</tr>
		<tr>
			<td colspan="2">11. Details of </td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
					<tr>
						<th  class="text-center">a. Working hours</th>
						<th  class="text-center">b. Overtime work</th>
						<th  class="text-center">c. Weekly holiday</th>
						<th  class="text-center">d. Spread over</th>
						<th  class="text-center">e. Weekly holiday paid or not</th>
					</tr>
					</thead>
					<tr>
						<td>'.strtoupper($details_a).'</td>
						<td>'.strtoupper($details_b).'</td>
						<td>'.strtoupper($details_c).'</td>
						<td>'.strtoupper($details_d).'</td>
						<td>'.strtoupper($details_e).'</td>
					</tr>
				</table>
				</td>
		 </tr>
		 <tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
					<tr>
						<th  class="text-center">Male</th>
						<th  class="text-center">Female</th>
						<th  class="text-center">Total</th>
					</tr>
					</thead>
					<tr>
						<td>12. No. of mandays work during the year</td>
						<td>'.strtoupper($total_calculation_a).'</td>
						<td>'.strtoupper($total_calculation_b).'</td>
						<td>'.strtoupper($total_calculation_tot1).'</td>
					</tr>
					<tr>
						<td>13. Amount of wages paid</td>
						<td>'.strtoupper($total_calculation_c).'</td>
						<td>'.strtoupper($total_calculation_d).'</td>
						<td>'.strtoupper($total_calculation_tot2).'</td>
					</tr>
					<tr>
						<td>14. Amount of deduction from wages</td>
						<td>'.strtoupper($total_calculation_e).'</td>
						<td>'.strtoupper($total_calculation_f).'</td>
						<td>'.strtoupper($total_calculation_tot3).'</td>
					</tr>
				</table>
				</td>
		 </tr>
		 <tr>
		          <td colspan="2">15. The following has been provided </td>
		</tr>
		<tr>
			      <td>Canteen</td>
			      <td>'.strtoupper($duration_contract).'</td>
		</tr>
		<tr>
			      <td>Rest Room</td>
			      <td>'.strtoupper($avg_no_contract).'</td>
		</tr>
		<tr>
			      <td>Drinking water</td>
			      <td>'.strtoupper($avg_no_contract).'</td>
		</tr>
		<tr>
			      <td>Creche</td>
			      <td>'.strtoupper($avg_no_contract).'</td>
		</tr>
		<tr>
			      <td>First Aid</td>
			      <td>'.strtoupper($avg_no_contract).'</td>
		</tr>
		<tr>
			      <td colspan="2"><b>Explanatory Note :-</b></td>
		</tr>
		<tr>
			      <td colspan="2">1. The average no. of workers employed daily should be calculated by dividing the figures of mandays worked by no. of days work in the year. For seasonal establishment the average no. of workers employed during the working season and off season should be given separately.<br/>2. Mandays work should be the aggregate no. of attendance of the workers covered under the Act, in all working days in reckoning attendance by the temporary as well as permanent workers employed should be counted and all employees should be included whether they are employed direct or under contractors.</td>
		</tr>
		<tr>
		<td colspan="2">I, Mr./Mrs/Miss '.strtoupper($key_person).' hereby, certify that I am the occupier/employer/contractor/of the establishment whose identification and general details are as follows:<br/>
		I, hereby certify that the complete of compliance of following labour laws and annual information of my enterprise during the year ................. is as under :- <br/>
		<ol>
			<li>Payment of Wages Act,1936 and the rules made there under as amended from time to time.</li>
			<li>Minimum Wages Act, 1948 and the rules made there under as amended from time to time.</li>
			<li>Contract Labour (Regulation &amp; Abolition) Act, 1970 and rules made there under as amended form time to time.</li>
			<li>Maternity Benefit Act, 1961 and rules made there under as amended from time to time.</li>
			<li>Payment of Bonus Act, 1965 and Rules made there under as amended from time to time.</li>
			<li>Payment of Gratuity Act, 1972 and rules made there under as amended from time to time.</li>
			<li>The Equal Remuneration Act, 1976 and rules made there under as amended from time to time.</li>
			<li>Industrial Employment (Standing Orders) Act, 1976 and rules made there under as amended from time to time.</li>
			<li>Assam Shops and Establishment Act, 1971 and rules made there under as amended from time to time.</li>
			<li>The Building and Other Construction (RE&amp;CS) Act, 1996 and rules made there under as amended from time to time.</li>
			<li>The Interstate Migrant Workers (RE&amp;CS) Act, 1979 1996 and rules made there under as amended from time to time.</li>
			<li>The Child Labour (Prohibition &amp; Regulation) Act, 1986 and rules made there under as amended from time to time.</li>
			<li>The Plantations Labour Act, 1951 and rules made there under as amended from time to time.</li>
			<li>The Sales Promotion Employees Act, 1979 and rules made there under as amended from time to time.</li>
			<li>The Beedi &amp; Cigar Workers (Regulation of Employment and Condition of Service) Act, 1979 and rules made there under as amended from time to time.</li>
			<li>The Motor Transport Workers Act, 1961 and rules made there under as amended from time to time.</li>
			<li>The Sexual Harassment of Women at Work Place (Prevention, Prohibition and Redressal) Act, 2013 and rules made there under as amended from time to time.</li>
			<li>The Bonded Labour System (Abolition) Act, 1976 and rules made there under as amended from time to time.</li>
		</ol>
		</td>
      </tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				';
				$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
				
				$printContents=$printContents.'
			</table>
			</td>
		</tr>
	    <tr>
			<td>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="center">'.strtoupper($key_person).'</td>
	   </tr>  
       <tr>
			<td>Place : '.strtoupper($dist).'</td>
			<td align="center">Signature of the Applicant (Contractor)</td>
	   </tr>  
	
</table>';
?>