<?php
$dept="pcb";
$form="55";
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
	$form_id=$results["form_id"];$manuf_capacity=$results["manuf_capacity"];$is_reg_dcssi=$results["is_reg_dcssi"];$water_valid_consent=$results["water_valid_consent"];$air_valid_consent=$results["air_valid_consent"];$is_compliance=$results["is_compliance"];$plastic_wastes=$results["plastic_wastes"];
	if(!empty($results["reg_manufacture"])){
		$reg_manufacture=json_decode($results["reg_manufacture"]);
		if(isset($reg_manufacture->a)) $reg_manufacture_a=$reg_manufacture->a; else  $reg_manufacture_a="";
		if(isset($reg_manufacture->b)) $reg_manufacture_b=$reg_manufacture->b; else  $reg_manufacture_b="";
		if(isset($reg_manufacture->c)) $reg_manufacture_c=$reg_manufacture->c; else  $reg_manufacture_c="";
	}else{
		$reg_manufacture_a="";$reg_manufacture_b="";$reg_manufacture_c="";
	}	
	if(!empty($results["old_reg_details"])){
		$old_reg_details=json_decode($results["old_reg_details"]);
		$old_reg_details_no=$old_reg_details->no;$old_reg_details_dt=$old_reg_details->dt;
	}else{
		$old_reg_details_no="";$old_reg_details_dt="";
	}
	if(!empty($results["proj_invested"])){
		$proj_invested=json_decode($results["proj_invested"]);
		$proj_invested_cap=$proj_invested->cap;$proj_invested_year=$proj_invested->year;
	}else{
		$proj_invested_cap="";$proj_invested_year="";
	}				
	if(!empty($results["solid_waste"])){
		$solid_waste=json_decode($results["solid_waste"]);
		$solid_waste_a=$solid_waste->a;$solid_waste_b=$solid_waste->b;$solid_waste_c=$solid_waste->c;
	}else{
		$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";
	}	
	/////////Brand owners///////////
	$is_reg_dis=$results["is_reg_dis"];$tot_capital_b=$results["tot_capital_b"];$year_comm_b=$results["year_comm_b"];$water_valid_radio=$results["water_valid_radio"];$air_valid_radio=$results["air_valid_radio"];$plastic_wastes1=$results["plastic_wastes1"];
	if(!empty($results["old_reg_details1"])){
		$old_reg_details1=json_decode($results["old_reg_details1"]);
		$old_reg_details1_no=$old_reg_details1->no;$old_reg_details1_dt=$old_reg_details1->dt;
	}else{
		$old_reg_details1_no="";$old_reg_details1_dt="";
	}	
	if(!empty($results["solid_wasteb"])){
		$solid_wasteb=json_decode($results["solid_wasteb"]);
		$solid_wasteb_a=$solid_wasteb->a;$solid_wasteb_b=$solid_wasteb->b;$solid_wasteb_c=$solid_wasteb->c;
	}else{
		$solid_wasteb_a="";$solid_wasteb_b="";$solid_wasteb_c="";
	}
			
	if($is_compliance=="Y") $is_compliance="YES";
	else $is_compliance="NO";		
	
	if($is_reg_dcssi=="Y") {
		$is_reg_dcssi="YES";
	}else{
		$is_reg_dcssi="NO";	
	} 
	if($water_valid_consent=="Y"){
		 $water_valid_consent="YES";
	}else{
		 $water_valid_consent="NO";	
	}
	if($air_valid_consent=="Y"){
		$air_valid_consent="YES";
	}else{
		$air_valid_consent="NO";
	} 
	if($is_reg_dis=="Y"){
		$is_reg_dis="YES";
	}else{
		 $is_reg_dis="NO";
	}
	if($water_valid_radio=="Y"){
		$water_valid_radio="YES";				
	}else{
		$water_valid_radio="NO";
	} 
	if($air_valid_radio=="Y"){
		$air_valid_radio="YES";
	}else{
		$air_valid_radio="NO";
	} 
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
    }$printContents=$printContents.'
    <div style="text-align:center"><h4>'.$form_name.'</h4> </div><br/>
	<table class="table table-bordered table-responsive">	
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
					<tr>
						<td colspan="2">From, <br/>'.strtoupper($status_applicant).'<br/>'.strtoupper($street_name1).', '.strtoupper($street_name2).'<br/>'.strtoupper($vill).', '.strtoupper($dist).'<br/>'.strtoupper($pincode).'<br/></td>
					</tr>		
					<tr>
						<td colspan="2">To,<br/>The Member Secretary,<br/>Pollution Control Board, Assam<br/><u>Bamunimaidam, Guwahati-21.</u></td>
					</tr>	
				</table>
				</td>
			</tr>		
			<tr>
				<td colspan="2">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/we hereby apply for registration under rule 10 of the Plastic Manufacture, Sale and Usage Rules, 1999.</td>
			</tr>
		    <tr>
                <td colspan="2"><b>I. Producer</b></td>
            </tr> 
			<tr>
                <td colspan="2"><b>Part - A : General</b></td>
            </tr>
	        <tr>
		        <td>1.(a) Name of the unit and location of activity</td>
		        <td>Name : '.strtoupper($unit_name).'<br/>Location : '.strtoupper($b_dist).'</td>
	        </tr>
		    <tr>
		        <td>(b) Address of the unit</td>
                <td>
					<table class="table table-bordered table-responsive">
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
							<td>+91 '.strtoupper($b_mobile_no).'</td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td>'.strtoupper($b_landline_std).'&nbsp;'.strtoupper($b_landline_no).'</td>
						</tr>
						<tr>
							<td>Email ID</td>
							<td>'.$b_email.'</td>
						</tr>
					</table>
    	        </td>
	        </tr> 
		
			<tr>
    	        <td>(c)Registration required for manufacturing of :</td>
    	        <td>
    		        '.strtoupper($reg_manufacture_a).'
    		        '.strtoupper($reg_manufacture_b).'
    		        '.strtoupper($reg_manufacture_c).'
    	        </td>
  	        </tr>
			<tr>
    	        <td>(d)Manufacturing Capacity:</td>
    	        <td>'.strtoupper($manuf_capacity).' </td>
  	        </tr>
			<tr>
    	        <td>(e)In case of renewal of Registration previous Registration number and date</td>
  	        </tr>
			<tr>
    	        <td>Registration Number :</td>
    	        <td>'.strtoupper($old_reg_details_no).' </td>
  	        </tr>
			<tr>
    	        <td>Date :</td>
    	        <td>'.strtoupper($old_reg_details_dt).' </td>
  	        </tr>
  	        <tr>
				<td>2. Is the unit registered with DCSSI or Department of Industries of the State Government/Union Territory Administration?</td>
    	        <td>'.strtoupper($is_reg_dcssi).'</td>
  	        </tr>
	        <tr>
				<td>3. (a) Total capital invested on the project</td>
    	        <td>'.strtoupper($proj_invested_cap).'</td>
			</tr>
	        <tr>
				<td>(b) Year of commencement of production</td>
    	        <td>'.strtoupper($proj_invested_year).'</td>
  	        </tr>	  	
  	        <tr>
		        <td>4.(a) List and quantum of products and byproducts.</td>	
		        <td>
				<table class="table table-bordered table-responsive">
					<tr>
					   <td>Sl No.</td>
					   <td>Name</td>
					   <td>Type</td>
					   <td>Quantum</td>
					</tr>';	
					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["type"]).'</td>
							<td>'.strtoupper($row_1["quantum"]).'</td>
						</tr>';
					}
					$printContents=$printContents.'
				</table>
				</td>
	        </tr>
	        <tr>
    	        <td>(b) List and quantum of raw materials used</td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Sl No</td>
						<td>Raw Materials</td>
						<td>Quantum</td>
					</tr>';
					
					$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
						$printContents=$printContents.'
						<tr>
								<td>'.strtoupper($row_2["slno"]).'</td>
								<td>'.strtoupper($row_2["raw"]).'</td>
								<td>'.strtoupper($row_2["quantum"]).'</td>
						</tr>';
					}
					$printContents=$printContents.'
				</table>
				</td>
  	        </tr> 
             <tr>
    	        <td>5.Furnish a flow diagram of manufacturing process showing input and output in terms of products and waste generated including for captive power generation and water.</td>
    	        <td>Upload later in upload section</td>
    	    </tr>			
  	        <tr>
    	        <td>6. Status of compliance with these rules- Thickness – fifty micron</td>
    	        <td>'.strtoupper($is_compliance).'</td>
    	    </tr>
  	        <tr>
  	            <td colspan="2"><b>PART - B<br/>PERTAINING TO LIQUID EFFLUENT AND GASEOUS EMISSION</b></td>
            </tr> 
            <tr>
		        <td>7.(a) Does the unit have a valid consent under the Water (Prevention and Control of pcb) Act, 1974 (6 of 1974) <br/>If yes, attach a copy</td>	
		        <td>'.strtoupper($water_valid_consent).'</td>
	        </tr>
	        <tr>
		        <td>(b) Does the unit have a valid consent under the Air (Prevention and Control of pcb) Act, 1981 (14 of 1981)<br/>If yes, attach a copy</td>	
		        <td>'.strtoupper($air_valid_consent).'</td>
	        </tr>
            <tr>
                <td colspan="2"><b>PART - C<br/>PERTAINTING TO WASTE</b></td> 
            </tr>
	        <tr>
		        <td colspan="2">8. Solid Wastes :</td>
	        </tr>
	        <tr>
		        <td>(a) Total quantum of generation</td>
		        <td>'.strtoupper($solid_waste_a).'</td>
	        </tr>
	        <tr>
		       <td>(b) Mode of storage within the plant</td>	
		       <td>'.strtoupper($solid_waste_b).'</td>
	        </tr>
	        <tr>
		        <td>(c) Provision made for disposal</td>	
		        <td>'.strtoupper($solid_waste_c).'</td>
	        </tr>
			 <tr>
    	        <td>9. List of person supplying plastic to be used as raw material to manufacture carry bags or plastic sheet of like or multilayered packaging</td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Sl No</td>
						<td>Name</td>
						<td>Address Details</td>
					</tr>';
					
					$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
					while($row_5=$part5->fetch_array()){
						$printContents=$printContents.'
						<tr>
								<td>'.strtoupper($row_5["slno"]).'</td>
								<td>'.strtoupper($row_5["name12"]).'</td>
								<td>'.strtoupper($row_5["address12"]).'</td>
						</tr>';
					}
					$printContents=$printContents.'
				</table>
				</td>
  	        </tr> 
			  
			  <tr>
    	        <td>10.List of personnel or Brand Owners to whom the products will be supplied :</td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Sl No</td>
						<td>Nmae</td>
						<td>Address Details</td>
					</tr>';
					
					$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
					while($row_6=$part6->fetch_array()){
						$printContents=$printContents.'
						<tr>
								<td>'.strtoupper($row_6["slno"]).'</td>
								<td>'.strtoupper($row_6["name1"]).'</td>
								<td>'.strtoupper($row_6["address1"]).'</td>
						</tr>';
					}
					$printContents=$printContents.'
				</table>
				</td>
  	        </tr>  
			 <tr>
		        <td>11.Action plan on collecting back the plastic wastes:</td>	
		        <td>'.strtoupper($plastic_wastes).'</td>
	        </tr> 
			
			<tr>
                <td colspan="2"><b>II Brand Owners :</b></td>
            </tr> 
			<tr>
                <td colspan="2"><b>Part - A : General</b></td>
            </tr>
	        <tr>
		        <td>1.1.Name, Address and Contact number</td>
		        <td>Name : '.strtoupper($unit_name).'</td>
		    </tr>
		    <tr>
		        <td>(b) Address of the unit</td>
                <td>
    		    <table class="table table-bordered table-responsive">
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
        			    <td>+91 '.strtoupper($b_mobile_no).'</td>
      		        </tr>
      		        <tr>
        			    <td>Phone Number</td>
        			    <td>'.strtoupper($b_landline_std).'&nbsp;'.strtoupper($b_landline_no).'</td>
      		        </tr>
    		    </table>
    	        </td>
	        </tr>
			<tr>
    	        <td>(e)In case of renewal of Registration previous Registration number and date</td>
  	        </tr>
			<tr>
    	        <td>Registration Number :</td>
    	        <td>'.strtoupper($old_reg_details1_no).' </td>
  	        </tr>
			<tr>
    	        <td>Date :</td>
    	        <td>'.strtoupper($old_reg_details1_dt).' </td>
  	        </tr>
  	        <tr>
				<td>2. Is the unit registered with DCSSI or Department of Industries of the State Government/Union Territory Administration?If Yes, attach a copy.</td>
    	        <td>'.strtoupper($is_reg_dis).'</td>
  	        </tr>
	        <tr>
				<td>3. (a) Total capital invested on the project</td>
    	        <td>'.strtoupper($tot_capital_b).'</td>
	        </tr>
            <tr>
				<td>(b) Year of commencement of production</td>
    	        <td>'.strtoupper($year_comm_b).'</td>
  	        </tr>	  	
  	         <tr>
		        <td>4.(a) List and quantum of products and byproducts.</td>	
		        <td>
				<table class="table table-bordered table-responsive">
					<tr>
					   <td>Sl No.</td>
					   <td>Name</td>
					   <td>Type</td>
					   <td>Quantum</td>
					</tr>';
					
					$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
					while($row_3=$part3->fetch_array()){
						$printContents=$printContents.'
						<tr>
								<td>'.strtoupper($row_3["slno"]).'</td>
								<td>'.strtoupper($row_3["name"]).'</td>
								<td>'.strtoupper($row_3["type"]).'</td>
								<td>'.strtoupper($row_3["quantum"]).'</td>
						</tr>';
					}
					$printContents=$printContents.'
				</table>
				</td>
	        </tr>
	        <tr>
    	        <td>(b) List and quantum of raw materials used</td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Sl No</td>
						<td>Raw Materials</td>
						<td>Quantum</td>
					</tr>';
					
					$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
					while($row_4=$part4->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_4["slno"]).'</td>
							<td>'.strtoupper($row_4["raw"]).'</td>
							<td>'.strtoupper($row_4["quantum"]).'</td>
						</tr>';
					}
					$printContents=$printContents.'
				</table>
				</td>
  	        </tr>
  	        <tr>
  	            <td colspan="2"><b>PART - B<br/>PERTAINING TO LIQUID EFFLUENT AND GASEOUS EMISSION</b></td>
            </tr> 
            <tr>
		        <td>5. Does the unit have a valid consent under the Water (Prevention and Control of pcb) Act, 1974 (6 of 1974). If yes, attach a copy</td>	
		        <td>'.strtoupper($water_valid_radio).'</td>
	        </tr>
	        <tr>
		        <td>6. Does the unit have a valid consent under the Air (Prevention and Control of pcb) Act, 1981 (14 of 1981). If yes, attach a copy</td>	
		        <td>'.strtoupper($air_valid_radio).'</td>
	        </tr>
            <tr>
                <td colspan="2"><b>PART - C<br/>PERTAINTING TO WASTE</b></td> 
            </tr>
	        <tr>
		        <td colspan="2">7. Solid Wastes :</td>
	        </tr>
	        <tr>
		        <td>(a) Total quantum of generation</td>
		        <td>'.strtoupper($solid_wasteb_a).'</td>
	        </tr>
	        <tr>
		       <td>(b) Mode of storage within the plant</td>	
		       <td>'.strtoupper($solid_wasteb_b).'</td>
	        </tr>
	        <tr>
		        <td>(c) Provision made for disposal</td>	
		        <td>'.strtoupper($solid_wasteb_c).'</td>
	        </tr>
			<tr>
    	        <td>8.List of person supplying plastic material </td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Sl No</td>
						<td>Name</td>
						<td>Address Details</td>
					</tr>';
					
					$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
					while($row_7=$part7->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_7["slno"]).'</td>
							<td>'.strtoupper($row_7["name2"]).'</td>
							<td>'.strtoupper($row_7["address2"]).'</td>
						</tr>';
					}
					$printContents=$printContents.'
				</table>
				</td>
  	        </tr>
			<tr>
		        <td>9.Action plan on collecting back the plastic wastes :</td>	
		        <td>'.strtoupper($plastic_wastes1).'</td>
	        </tr>
	        ';
			
            $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
		
	        <tr>
	           <td colspan="2">
		       <table class="table table-bordered table-responsive">
			   <tr>
			        <td>Place: <label>'.strtoupper($dist).'</label><br/> Date : <label>'.strtoupper($results["sub_date"]).'</label></td>
			        <td align="right">
				      Signature : <label>'.strtoupper($key_person).'</label><br/>
				      Name : <label>'.strtoupper($key_person).'</label><br/>
				      Designation : <label>'.strtoupper($status_applicant).'</label></td>
			    </tr>
		        </table>
	            </td>
	        </tr>
	</table>
	';
?>