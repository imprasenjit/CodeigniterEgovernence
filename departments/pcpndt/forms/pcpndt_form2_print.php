<?php
$dept="pcpndt";
$form="2";
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
		$form_id=$results["form_id"];
		
		$facilities_avail=$results["facilities_avail"];
		$state_details=$results["state_details"];$fees_description=$results["fees_description"];
		
		if($fees_description=="1") $fees_description="GCC/G.Lab/GC/USC Clinic/Imaging Clinic/IVF Clinic";
		else $fees_description="Institute,Hospital,Nurse Home or any place providing jointly the services of GCC/G.Lab/GC/USG CLinic Imaging Centre or any combinations thereof";
		
		if(!empty($results["facility_type"])){
			$facility_type=json_decode($results["facility_type"]);
			if(isset($facility_type->a)) $facility_type_a=$facility_type->a; else $facility_type_a="";
			if(isset($facility_type->b)) $facility_type_b=$facility_type->b; else $facility_type_b="";
			if(isset($facility_type->c)) $facility_type_c=$facility_type->c; else $facility_type_c="";
			if(isset($facility_type->d)) $facility_type_d=$facility_type->d; else $facility_type_d="";
			if(isset($facility_type->e)) $facility_type_e=$facility_type->e; else $facility_type_e="";
		}else{
			$facility_type_a="";$facility_type_b="";$facility_type_c="";$facility_type_d="";$facility_type_e="";
		}
		
      //facility_type//
		$facility_type_values="";
	  
		if($facility_type_a=="Genetic Counselling Center") $facility_type_values=$facility_type_values. '<span class="tickmark">&#10004;</span> Genetic Counselling Center ';
		if($facility_type_b=="Genetic Laboratory") $facility_type_values=$facility_type_values. '<span class="tickmark">&#10004;</span> Genetic Laboratory ';
		if($facility_type_c=="Genetic Clinic") $facility_type_values=$facility_type_values. '<span class="tickmark">&#10004;</span> Genetic Clinic ';
		if($facility_type_d=="Ultrasound Clinic") $facility_type_values=$facility_type_values. '<span class="tickmark">&#10004;</span> Ultrasound Clinic ';
		if($facility_type_e=="Imaging Centre") $facility_type_values=$facility_type_values. '<span class="tickmark">&#10004;</span> Imaging Centre ';	
			
		if(!empty($results["type_of"])){
			$type_of=json_decode($results["type_of"]);
			$type_of_institution=$type_of->institution;
		}else{
			$type_of_institution="";
		}
			
			
		if(!empty($results["specific_invasive"])){
				$specific_invasive=json_decode($results["specific_invasive"]);
				if(isset($specific_invasive->a)) $specific_invasive_a=$specific_invasive->a; else $specific_invasive_a="";
				if(isset($specific_invasive->b)) $specific_invasive_b=$specific_invasive->b; else $specific_invasive_b="";
				if(isset($specific_invasive->c)) $specific_invasive_c=$specific_invasive->c; else $specific_invasive_c="";
				if(isset($specific_invasive->d)) $specific_invasive_d=$specific_invasive->d; else $specific_invasive_d="";
				if(isset($specific_invasive->e)) $specific_invasive_e=$specific_invasive->e; else $specific_invasive_e="";
		}else{
				$specific_invasive_a="";$specific_invasive_b="";$specific_invasive_c="";$specific_invasive_d="";$specific_invasive_e="";
		}
		//specific_invasive//
		$specific_invasive_values="";
	  
		if($specific_invasive_a=="Amnocentesis") $specific_invasive_values=$specific_invasive_values. '<span class="tickmark">&#10004;</span> Amnocentesis ';
		if($specific_invasive_b=="Chorionic Villi Aspiration") $specific_invasive_values=$specific_invasive_values. '<span class="tickmark">&#10004;</span> Chorionic Villi Aspiration ';
		if($specific_invasive_c=="Chromosomal") $specific_invasive_values=$specific_invasive_values. '<span class="tickmark">&#10004;</span> Chromosomal ';
		if($specific_invasive_d=="Biochemical") $specific_invasive_values=$specific_invasive_values. '<span class="tickmark">&#10004;</span> Biochemical ';
		if($specific_invasive_e=="Molecular Studies") $specific_invasive_values=$specific_invasive_values. '<span class="tickmark">&#10004;</span> Molecular Studies ';	
			
		if(!empty($results["specific_non_invasive"])){
				$specific_non_invasive=json_decode($results["specific_non_invasive"]);
				if(isset($specific_non_invasive->a)) $specific_non_invasive_a=$specific_non_invasive->a; else $specific_non_invasive_a="";				
		}else{
				$specific_non_invasive_a="";				 
		}
		//specific_non_invasive//
		$specific_non_invasive_values="";
	  
		if($specific_non_invasive_a=="Ultrasonography") $specific_non_invasive_values=$specific_non_invasive_values. '<span class="tickmark">&#10004;</span> Ultrasonography ';			
		if(!empty($results["test_facility"])){
			$test_facility=json_decode($results["test_facility"]);
			if(isset($test_facility->a)) $test_facility_a=$test_facility->a; else $test_facility_a="";
			if(isset($test_facility->b)) $test_facility_b=$test_facility->b; else $test_facility_b="";
			if(isset($test_facility->c)) $test_facility_c=$test_facility->c; else $test_facility_c="";
			if(isset($test_facility->d)) $test_facility_d=$test_facility->d; else $test_facility_d="";
			if(isset($test_facility->e)) $test_facility_e=$test_facility->e; else $test_facility_e="";
			if(isset($test_facility->f)) $test_facility_f=$test_facility->f; else $test_facility_f="";
		}else{
				$test_facility_a="";$test_facility_b="";$test_facility_c="";$test_facility_d="";$test_facility_e="";$test_facility_f="";				 
		}
		//test_facility//
		$test_facility_values="";
	  
		if($test_facility_a=="Ultrasound") $test_facility_values=$test_facility_values. '<span class="tickmark">&#10004;</span> Ultrasound ';
		if($test_facility_b=="Amniocentesis") $test_facility_values=$test_facility_values. '<span class="tickmark">&#10004;</span> Amniocentesis ';
		if($test_facility_c=="Chorionic Villi Aspiration") $test_facility_values=$test_facility_values. '<span class="tickmark">&#10004;</span> Chorionic Villi Aspiration ';
		if($test_facility_d=="Foetoscopy") $test_facility_values=$test_facility_values. '<span class="tickmark">&#10004;</span> Foetoscopy ';
		if($test_facility_e=="Foetal Biopsy") $test_facility_values=$test_facility_values. '<span class="tickmark">&#10004;</span> Foetal Biopsy ';		
		if($test_facility_f=="Cordocentesis") $test_facility_values=$test_facility_values. '<span class="tickmark">&#10004;</span> Cordocentesis ';		
						
		if(!empty($results["lab_facility"])){
				$lab_facility=json_decode($results["lab_facility"]);
				if(isset($lab_facility->a)) $lab_facility_a=$lab_facility->a; else $lab_facility_a="";
				if(isset($lab_facility->b)) $lab_facility_b=$lab_facility->b; else $lab_facility_b="";
				if(isset($lab_facility->c)) $lab_facility_c=$lab_facility->c; else $lab_facility_c="";				
		}else{
				$lab_facility_a="";$lab_facility_b="";$lab_facility_c="";				 
		}
		//lab_facility//
		$lab_facility_values="";
	  
		if($lab_facility_a=="Chromosomal Studies") $lab_facility_values=$lab_facility_values. '<span class="tickmark">&#10004;</span> Chromosomal Studies ';
		if($lab_facility_b=="Biochemical Studies") $lab_facility_values=$lab_facility_values. '<span class="tickmark">&#10004;</span> Biochemical Studies ';
		if($lab_facility_c=="Molecular Studies") $lab_facility_values=$lab_facility_values. '<span class="tickmark">&#10004;</span> Molecular Studies ';
		
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
		</div><br/> 
  	<table class="table table-bordered table-responsive">
			      

					<tr>
							<td  width="50%">1.Name of the Applicant.</td>
							<td>'.strtoupper($key_person).'</td>
					</tr>
					<tr>
						<td valign="top">2. Address of the applicant.</td>
						<td>
							<table class="table table-bordered table-responsive">
							    
								<tr>
									<td>Street name 1 :</td>
									<td>'.strtoupper($street_name1).'</td>
								</tr>
								<tr>
									<td>Street name 2 :</td>
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
									<td>'.strtoupper($pincode).'</td>
								</tr>
								<tr>
									<td>Email-ID :</td>
									<td>'.$email.'</td>
								</tr>
								
							</table>
						</td>
					</tr>
					<tr>
						<td>Option Selected: </td>
						<td>'.strtoupper($fees_description).'</td>
					</tr>
					<tr>
						    <td>3. Type of facility to be registered </td>
						    <td>'.strtoupper($facility_type_values).'</td>
					</tr>
					<tr>
						<td colspan="2">4. Full name and address/ addresses of Genetic Counselling Center/ Genetic Laboratory/Genetic Clinic/Ultrasound Clinic/ Imaging Centre with Telephone/ Fax namber(s)/ Telegraphic/telex/E-mail address(s).</td>
				   </tr>
				   <tr>
						<td colspan="2">
						<table class="table table-bordered table-responsive">			
							<thead>
							<tr>												
								<td width="25%">Sl No.</td>
								<td width="25%">Name</td>
								<td width="25%">Address</td>
								<td width="25%">Contact No.</td>
							</tr>
							</thead>';					
								$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
								while($row_1=$part1->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_1["slno"]).'</td>
									<td>'.strtoupper($row_1["name"]).'</td>
									<td>'.strtoupper($row_1["address"]).'</td>
									<td>'.strtoupper($row_1["contact_no"]).'</td>
								</tr>';
								}$printContents=$printContents.'
						</table>
						</td>
				  </tr>
					
					<tr>
							<td>5. Type of ownership of Organisation (individual ownership/partnership/company/ cooperative/any other to be specified). </td>
							<td>'.strtoupper($Type_of_ownership).'</td> 
					</tr>
					<tr>
							<td>6. Type of Institution</td>
							<td>'.strtoupper($type_of_institution).'</td> 
					</tr>
					<tr>
							<td>7. Specific pre-natal diagnostic procedures/ tests for which approval is sought (a) Invasive : </td>
							<td>'.strtoupper($specific_invasive_values).'</td> 
					</tr>
					<tr>
							<td>(b) Non-Invasive</td>
							<td>'.strtoupper($specific_non_invasive_values).'</td> 
					</tr>
					<tr>
							<td>8. (a) Facilities available in the Counselling Centre. </td>
							<td>'.strtoupper($facilities_avail).'</td> 
					</tr>
					<tr>
							<td>(b) Whether facilities are or would be available in the Laboratory/ Clinic for the following tests.</td>
							<td>'.strtoupper($test_facility_values).'</td> 
					</tr>
					<tr>
							<td>Whether facilities are available in rhe Laboratory/Clinic for the following.</td>
							<td>'.strtoupper($lab_facility_values).'</td> 
					</tr>
					<tr>
							<td>11. State whether the Genetic Counselling Centre/ Genetic Laboratory/ Genetic Clinic/ultrasound clinic/imaging centre qualifies for registration in terms of requirements laid down in Rule 3].</td>
							<td>'.strtoupper($state_details).'</td> 
					</tr>
					';
					
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
		<tr>
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
               </td>
        </tr>        
	</table>';
?>
				  
				