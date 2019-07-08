<?php
$dept="labour";
$form="4";
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
			$total_grant=$results["total_grant"];$max_workers=$results["max_workers"];
					
			if(!empty($results["plantation"])){				
				$plantation=json_decode($results["plantation"]);
				$plantation_name=$plantation->name;$plantation_sn1=$plantation->sn1;$plantation_sn2=$plantation->sn2;$plantation_vill=$plantation->vill;$plantation_dist=$plantation->dist;$plantation_pin=$plantation->pin;				
			}else{
				$plantation_name="";$plantation_sn1="";$plantation_sn2="";$plantation_vill="";$plantation_dist="";$plantation_pin="";
			}
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
          
		<br>
            <table class="table table-bordered table-responsive">
               
				<tr>
                    <td width="50%"> 1.	Name of the Plantation </td>
                    <td>'.strtoupper($unit_name).'</td>
                </tr>
				<tr>
					<td>2. Full address to which communication relating to the plantation should be sent</td>
					<td>
						<table class="table table-bordered table-responsive">
							<tr>
                                <td>Street Name 1 </td>
								<td>'.strtoupper($b_street_name1).'</td>
							</tr>
							<tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($b_street_name2).'</td>
							</tr>
							<tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($b_vill).'</td>
							</tr>
							<tr>
								<td>District </td>
								<td>'.strtoupper($b_dist).'</td>
							</tr>
							<tr>
								<td>Pin Code </td>
								<td>'.strtoupper($b_pincode).'</td>
							</tr>
						</table>
					</td>
				</tr>  
				     
                <tr>
                    <td>3.	Total grant of the plantation in hectares. </td>
                    <td>'.strtoupper($total_grant).'</td>
                </tr> 
				<tr>
                    <td>4. Maximum number of workers (Permanent, temporary, casual, taken together) employed on any day during the preceding calendar year.</td>
                    <td>'.strtoupper($max_workers).'</td>
                </tr> 
				
				<tr>
					<td colspan="2">5.	Full name(s) and residential address(es) of the--</td>
				</tr>
				<tr><td colspan="2">(i)Proprietor&apos;s of the plantation in case it is not registered under the Companies Act, 1956. </td></tr>
				<tr>
                    <td colspan="2">
					<table class="table table-bordered table-responsive">
					<thead>
						
						<tr><td align="center">Sl No.</td>
						<td align="center">Full Name</td>
						<td align="center">Street Name 1</td>
						<td align="center">Street Name 2</td>
						<td align="center">Town/Vill</td>
						<td align="center">District</td>
						<td align="center">Pin Code</td>
						</tr>
					</thead>
		
		
					<tbody>';
		
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["field1"]).'</td>
							<td>'.strtoupper($row_1["field2"]).'</td>
							<td>'.strtoupper($row_1["field3"]).'</td>
							<td>'.strtoupper($row_1["field4"]).'</td>
							<td>'.strtoupper($row_1["field5"]).'</td>
							<td>'.strtoupper($row_1["field6"]).'</td>
							<td>'.strtoupper($row_1["field7"]).'</td>
							</tr>';
					}
					$printContents=$printContents.'
				</tbody>
				</table>
				</td>
            </tr>
			<tr><td colspan="2">(ii) Partner&apos;s  of the plantation in case it is not registered under the Companies Act, 1956. </td></tr>
			<tr>
                <td colspan="2">
					<table class="table table-bordered table-responsive">
						<thead>
							
								<tr><td align="center">Sl No.</td>
								<td align="center">Full Name</td>
								<td align="center">Street Name 1</td>
								<td align="center">Street Name 2</td>
								<td align="center">Town/Vill</td>
								<td align="center">District</td>
								<td align="center">Pin Code</td>
							</tr>
						</thead>
					<tbody>';
		
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["field1"]).'</td>
								<td>'.strtoupper($row_1["field2"]).'</td>
								<td>'.strtoupper($row_1["field3"]).'</td>
								<td>'.strtoupper($row_1["field4"]).'</td>
								<td>'.strtoupper($row_1["field5"]).'</td>
								<td>'.strtoupper($row_1["field6"]).'</td>
								<td>'.strtoupper($row_1["field7"]).'</td>
								</tr>';
						}
						$printContents=$printContents.'
					</tbody>
					</table>
				</td>
            </tr>
			<tr><td colspan="2">6. Full name and residential address (es) of the Directors in the case of a Company registered under the Companies Act, 1956.</td></tr>
			<tr>
			    <td colspan="2">
					<table class="table table-bordered table-responsive">
						<thead>
							
								<tr><td align="center">Sl No.</td>
								<td align="center">Full Name</td>
								<td align="center">Street Name 1</td>
								<td align="center">Street Name 2</td>
								<td align="center">Town/Vill</td>
								<td align="center">District</td>
								<td align="center">Pin Code</td>
							</tr>
						</thead>
					<tbody>';
			
						$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
						while($row_3=$part3->fetch_array()){
						$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_3["field1"]).'</td>
								<td>'.strtoupper($row_3["field2"]).'</td>
								<td>'.strtoupper($row_3["field3"]).'</td>
								<td>'.strtoupper($row_3["field4"]).'</td>
								<td>'.strtoupper($row_3["field5"]).'</td>
								<td>'.strtoupper($row_3["field6"]).'</td>
								<td>'.strtoupper($row_3["field7"]).'</td>
								</tr>';
						}
						$printContents=$printContents.'
					</tbody>
					</table>
				</td>
			</tr>
			<tr>
						<td colspan="2">7.   Full name and address(es) of the Chief Executives or General Manager of the Plantation in the Public Sector </td>
			</tr>
			<tr>
                <td colspan="2">
				<table class="table table-bordered table-responsive">
				<thead>
					
							<tr><td align="center">Sl No.</td>
							<td align="center">Full Name</td>
							<td align="center">Street Name 1</td>
							<td align="center">Street Name 2</td>
							<td align="center">Town/Vill</td>
							<td align="center">District</td>
							<td align="center">Pin Code</td>
					</tr>
					</thead>
				<tbody>';
		
						$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
						while($row_4=$part4->fetch_array()){
						$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_4["field1"]).'</td>
								<td>'.strtoupper($row_4["field2"]).'</td>
								<td>'.strtoupper($row_4["field3"]).'</td>
								<td>'.strtoupper($row_4["field4"]).'</td>
								<td>'.strtoupper($row_4["field5"]).'</td>
								<td>'.strtoupper($row_4["field6"]).'</td>
								<td>'.strtoupper($row_4["field7"]).'</td>
							</tr>';
						}
						$printContents=$printContents.'
					</tbody>
					</table>
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
			<td>Signature of the Applicant :</td>
			<td align="right">'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>Date :</td>
			<td align="right">'.date('d-m-y',(strtotime($results["sub_date"]))).'</td>
		</tr> 
	  </table>';
?>


