<?php
$dept="pcb";
$form="41";
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
	$manuf_capacity=$results["manuf_capacity"];$is_reg_dcssi=$results["is_reg_dcssi"];$min_sizes_cb=$results["min_sizes_cb"];$compliance_status=$results["compliance_status"];$water_valid_consent=$results["water_valid_consent"];$air_valid_consent=$results["air_valid_consent"];
				
	if(!empty($results["reg_manufacture"])){
		$reg_manufacture=json_decode($results["reg_manufacture"]);
		if(isset($reg_manufacture->a)) $reg_manufacture_a=$reg_manufacture->a ."<br/>"; else $reg_manufacture_a="";
		if(isset($reg_manufacture->b)) $reg_manufacture_b=$reg_manufacture->b ."<br/>"; else $reg_manufacture_b="";
		if(isset($reg_manufacture->c)) $reg_manufacture_c=$reg_manufacture->c ."<br/>"; else $reg_manufacture_c="";
		if(isset($reg_manufacture->d)) $reg_manufacture_d=$reg_manufacture->d ."<br/>"; else $reg_manufacture_d="";
	}else{
		$reg_manufacture_a="";$reg_manufacture_b="";$reg_manufacture_c="";$reg_manufacture_d="";
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
    <div style="text-align:center"><h4>'.$form_name.'</h4></div>
  	<div class="container">
	  <table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
					<tr>
						<td colspan="2">From, <br/>
						'.strtoupper($status_applicant).'<br/>'.strtoupper($street_name1).','.strtoupper($street_name2).'<br/>'.strtoupper($vill).','.strtoupper($dist).'<br/>'.strtoupper($pincode).'</td>
					</tr>		
					<tr>
						<td colspan="2">To,<br/> The Member Secretary,<br/>Pollution Control Board, Assam<br/> <u>Bamunimaidam, Guwahati-21.</u></td>
					</tr>	
				</table>
				</td>
			</tr>		
			<tr>
				<td colspan="2">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/we hereby apply for registration under rule 10 of the Plastic Manufacture, Sale and Usage Rules, 1999.
				</td>
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
        			    <td >Pincode</td>
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
    	        <td>(c)Registration required for manufacturing of:</td>
    	        <td>
    		        '.strtoupper($reg_manufacture_a).'
    		        '.strtoupper($reg_manufacture_b).'
    		        '.strtoupper($reg_manufacture_c).'
    		        '.strtoupper($reg_manufacture_d).'
    	        </td>
  	        </tr>
  	        <tr>
    	        <td>(d) Manufacturing capacity</td>
    	        <td>'.strtoupper($manuf_capacity).'</td>
  	        </tr>
	        <tr>
    	        <td>(e) In case of renewal of Registration previous Registration number and date</td>
    	        <td>
    		        Reg. No. : '.strtoupper($old_reg_details_no).'<br/>
    		        Date : '.strtoupper($old_reg_details_dt).'
    	        </td>
  	        </tr>	  	
  	        <tr>
    	        <td>2. Is the unit registered with DCSSI or Department of Industries of the State Government/Union Territory Administration?</td>
    	        <td>'.strtoupper($is_reg_dcssi).'</td>
  	        </tr>	
  	       
  	        <tr>
    	        <td>3.(a)Total capital invested on the project</td>
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
					   <td align="center">Sl No.</td>
					   <td align="center">Name</td>
					   <td align="center">Type</td>
					   <td align="center">Quantum</td>
					</tr>';
					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
							if($row_1["ty_pe"]=="P"){
								$ty_pe="Product";
							}else if($row_1["ty_pe"]=="B"){
								$ty_pe="By-product";
							}else{
								$ty_pe="";
							}
						$printContents=$printContents.'
						<tr align="center">
								<td align="center">'.strtoupper($row_1["slno"]).'</td>
								<td align="center">'.strtoupper($row_1["name"]).'</td>
								<td align="center">'.strtoupper($ty_pe).'</td>
								<td align="center">'.strtoupper($row_1["quantum"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
				</td>
	        </tr>
	        <tr>
    	        <td>(b) List and quantum of raw materials used</td>
				<td>
    	       <table class="table table-bordered table-responsive">
					<tr>
						<td align="center">Sl No</td>
						<td align="center">Raw Materials</td>
						<td align="center">Quantum</td>
					</tr>';
					
					$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
						while($row_2=$part2->fetch_array()){
						$printContents=$printContents.'
						<tr align="center">
								<td width="50px" align="center">'.strtoupper($row_2["slno"]).'</td>
								<td align="center">'.strtoupper($row_2["raw"]).'</td>
								<td align="center">'.strtoupper($row_2["quantum"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
				</td>
  	        </tr>  	       
  	        <tr>
    	        <td>5. Minimum sizes of carry bags to be manufactured. (in any case it should not be less than 8" x 12" Inch)</td>
    	        <td>'.strtoupper($min_sizes_cb).'</td>
    	    </tr>
    	    <tr>
    	        <td>6. Status of compliance with rules 5, 6, 7 and 8</td>
    	        <td>'.strtoupper($compliance_status).'</td>
  	        </tr>
  	        <tr>
  	            <td colspan="2"><b>PART - B<br/>PERTAINING TO LIQUID EFFLUENT AND GASEOUS EMISSION</b></td>
            </tr> 
            <tr>
		        <td>7.(a) Does the unit have a valid consent under the Water (Prevention and Control of pcb) Act, 1974 (6 of 1974). If yes, attach a copy</td>	
		        <td>'.strtoupper($water_valid_consent).'</td>
	        </tr>
	        <tr>
		        <td>(b) Does the unit have a valid consent under the Air (Prevention and Control of pcb) Act, 1981 (14 of 1981). If yes, attach a copy</td>	
		        <td>'.strtoupper($air_valid_consent).'</td>
	        </tr>
            <tr>
                <td colspan="2" style="text-align: center"><b>PART - C<br/>PERTAINTING TO WASTE</b></td> 
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
	        </tr> ';
			
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