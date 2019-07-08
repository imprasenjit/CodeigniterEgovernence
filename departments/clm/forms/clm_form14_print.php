<?php
$dept="clm";
$form="14";
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
                  '.$assamSarkarLogo.'
                <h4>'.$form_name.'</h4><br/>
       </div> 
            <table class="table table-bordered table-responsive">
                <tr>
					<td>
						<table class="table table-bordered table-responsive">
							<tr>
								<td>To
								<br/>The Controller of Legal Metrology, Assam,<br/>R.K. Mission Road, Ulubari,<br/>Guwahati-781007
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table class="table table-bordered table-responsive">
				<tr >
                    <td> 1. (a) Name of the owner of the Dispensing Units: </td>
                    <td>'.strtoupper($key_person).'</td>
                </tr>
                <tr>
					<td width="50%" valign="top">(b) Address of the owner of the Dispensing Units:</td>
					<td>
						<table class="table table-bordered table-responsive">
							<tr>
								<td>Street Name 1</td>
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
								<td>Mobile</td>
								<td>+91 - '.strtoupper($mobile_no).'</td>
							</tr>
						</table>
					</td>
				</tr>
                 <tr>
                    <td width="50%">2. (a) Name of the Firm:</td>
                    <td >'.strtoupper($unit_name).'</td>
                </tr>
				<tr>
					<td valign="top" width="50%">(b) Address of the Firm:</td>
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
								<td>+91 - '.strtoupper($b_mobile_no).'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">3. Details of the New Dispensing Units:</td>
				</tr>
				<tr>
					<td colspan="2">
						<table class="table table-bordered table-responsive">		
							<thead>
							<tr>												
								<td>Sl No.</td>
								<td>Make</td>
								<td>Model No</td>
								<td>Sl. No. of D.U</td>
							</tr>
							</thead>';					
								$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
								while($row_1=$part1->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_1["sl_no"]).'</td>
									<td>'.strtoupper($row_1["make"]).'</td>
									<td>'.strtoupper($row_1["model_no"]).'</td>
									<td>'.strtoupper($row_1["sl_f_du"]).'</td>
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">4. Details of the Old Dispensing Units(in case of replacement):</td>
				</tr>
				<tr>
					<td colspan="2">
						<table class="table table-bordered table-responsive">		
							<thead>
							<tr>												
								<td>Sl No.</td>
								<td>Make</td>
								<td>Model No</td>
								<td>Sl. No. of D.U</td>
							</tr>
							</thead>';					
								$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
								while($row_2=$part2->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_2["sl_no"]).'</td>
									<td>'.strtoupper($row_2["make"]).'</td>
									<td>'.strtoupper($row_2["model_no"]).'</td>
									<td>'.strtoupper($row_2["sl_f_du"]).'</td>
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
				</tr>';
				
				$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
				$printContents=$printContents.'   
				<tr>
					<td> Place : '.strtoupper($dist).'<br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
					<td align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
				</tr>
		</table>';

?>