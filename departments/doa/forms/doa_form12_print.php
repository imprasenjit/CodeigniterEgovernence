<?php
 $dept="doa";
 $form="12";
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
		$form_id=$results["form_id"];$is_applicant=$results["is_applicant"];$type_f_pest=$results["type_f_pest"];$is_trade=$results["is_trade"];$trade_particulars=$results["trade_particulars"];$situation=$results["situation"];$pest_control=$results["pest_control"];$full_particular=$results["full_particular"];$tech_person=$results["tech_person"];$contact_no=$results["contact_no"];$name=$results["name"];$father_name=$results["father_name"];$vill=$results["vill"];$operation=$results["operation"];$po=$results["po"];$quali=$results["quali"];$report_year=$results["report_year"];		
		
		if($results["is_applicant"]=="Y"){
			$is_applicant="YES";
		}else{
			$is_applicant="NO";
			$type_f_pest=" ";			
		}
		if($results["is_trade"]=="Y"){
			$is_trade="YES";
		}else{
			$is_trade="NO";
			$trade_particulars=" ";			
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
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	    
  	    <tr>
            <td colspan="2">
				<p>To,</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;State of Assam<br/><br/></p>
			</td>
		</tr>
		<tr>
			<td width="50%">1. i. Full name of the applicant:</td>
			<td >'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>ii. Address of the applicant</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
				<td>2. Is the applicant a new comer</td>		
				<td>'.strtoupper($is_applicant).'</td>		
		</tr>   
		<tr>
				<td>(a) If Yes the type of Pest control operation in which the applicant prepared to deal.</td>		
				<td>'.strtoupper($type_f_pest).'</td>		
		</tr>   
		<tr>
				<td>3. If the applicant has been in the trade</td>		
				<td>'.strtoupper($is_trade).'</td>		
		</tr>   
		<tr>
				<td>(a) Give full particulars</td>		
				<td>'.strtoupper($trade_particulars).'</td>		
		</tr>   
		<tr>
				<td>4. Situation of the operator&#39;s premises and area of operation.</td>		
				<td>'.strtoupper($situation).'</td>		
		</tr>   
		
		<tr>
				<td> 5. The type of pest control operation</td>
				<td>'.strtoupper($pest_control).'</td>
		</tr>
		<tr>
				<td>6. Full particulars of licence issued by other State Govt.if any, in their area.</td>
				<td>'.strtoupper($full_particular).' </td>
		</tr>
		<tr>
				<td>7. Name of the Technical Person/ Technical Expert who will be service the operation and expectance certificate.</td>
				<td>'.strtoupper($tech_person).'</td>
		</tr>
		<tr>
				<td>8. Contact No.</td>
				<td>'.strtoupper($contact_no).'</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><b>PROFORMA –I</b></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><u>TO WHOM IT MAY CONCERN</u></td>
		</tr>
		<tr>
			<td colspan="2" >
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; This is to certified that, &nbsp;'.strtoupper($name).'&nbsp; Son of &nbsp; '.strtoupper($father_name).' &nbsp; Vill- &nbsp; '.strtoupper($vill).'&nbsp; do hereby undertake the responsibility of supervising the commercial pest control operation of &nbsp;'.strtoupper($operation).'&nbsp; P.O. &nbsp; '.strtoupper($po).' &nbsp; for a period of two years subject to the issue of commercial pest control operation&#39;s license from the Licensing authority of Assam.<br/><br/>
			
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Further, I declare that I am not an employee to the Central/State/Semi Govt. organization and shall no under supervise ship to any other firm during the period.
			</td>
		</tr>
		<tr>
				<td>Signature of "Technical Expert"<br/>(Full name and Qualification)</td>
				<td>'.strtoupper($quali).'</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><b>PROFORMA –II</b></td>
		</tr>
		<tr>
				<td colspan="2">Annual report of commercial pest control operation for the year &nbsp;'.strtoupper($report_year).'</td>
		</tr>
		<tr>
			<td colspan="2">Particulars of trade articles in which the applicant wants to carry on business as a :</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr align="center" >
				<th  align="center">Slno</th>
				<th  align="center">Name of firm</th>
				<th  align="center">Stock position of different equipments</th>
				<th  align="center">Stock of safety equipments</th>
				<th  align="center">No of operator engaged</th>
				<th  align="center">Detail of the job done if any during the period.</th>
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["position"]).'</td>
						<td>'.strtoupper($row_1["safety"]).'</td>
						<td>'.strtoupper($row_1["operator"]).'</td>
						<td>'.strtoupper($row_1["job_done"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> </td>
		</tr>	
		<tr>
				<td colspan="2">Declaration<br/>
					I declare that the information given above is true to the best of my knowledge and belief and no part there if is false.</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
        $printContents=$printContents.' 
		<tr>
			<td>DATE<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
			PLACE<strong> :</strong> '.strtoupper($dist).' </td>
			<td align="right">SIGNATURE OF THE APPLICANT <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>	
	</table>
	
		';
?>