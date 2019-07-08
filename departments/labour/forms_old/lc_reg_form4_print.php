<?php
$dept="labour";
$form="4";
$table_name=$formFunctions->getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($labour->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$labour->query("select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") or die($labour->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($labour->error);
	}else{
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($labour->error);
	}
	    $email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
		
		$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
		
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
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
</style>
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
            <table border="1" width="100%" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive">
               
				<tr>
                    <td> 1.	Name of the Plantation </td>
                    <td colspan="2" width="50%">'.strtoupper($unit_name).'</td>
                </tr>
                <tr>
                    <td width="50%" rowspan="5" valign="top">2. Full address to which communication relating to the plantation should be sent </td>
					<td width="25%">Street Name 1 </td>
                    <td width="25%">'.strtoupper($b_street_name1).'</td>
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
                       
                   <tr>
                    <td valign="top">3.	Total grant of the plantation in hectares. </td>
                    <td colspan="2">'.strtoupper($total_grant).'</td>
                </tr> 
				<tr>
                    <td valign="top">4. Maximum number of workers (Permanent, temporary, casual, taken together) employed on any day during the preceding calendar year.</td>
                    <td colspan="2">'.strtoupper($max_workers).'</td>
                </tr> 
				
				<tr>
			<td colspan="3" valign="top">5.	Full name(s) and residential address(es) of the--</td>
		</tr>
				<tr>
                                <td colspan="3">
								<table width="100%" align="center" style="margin:0px auto;" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive" border="1">
		<thead>
		<tr><td colspan="7" height="40px">(i)Proprietor&apos;s of the plantation in case it is not registered under the Companies Act, 1956. </td></tr>
		<tr><td align="center">Sl No.</td>
		<td align="center">Full Name</td>
		<td align="center">Street Name 1</td>
		<td align="center">Street Name 2</td>
		<td align="center">Town/Vill</td>
		<td align="center">District</td>
		<td align="center">Pin Code</td>
		</tr></thead>
		
		
		<tbody>';
		
		$part1=$labour->query("SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
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
				<tr>
                    <td colspan="3">
					
					<table width="100%" align="center" style="margin:0px auto;" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive" border="1">
		<thead>
		<tr><td colspan="7" height="40px">(ii) Partner&apos;s  of the plantation in case it is not registered under the Companies Act, 1956. </td></tr>
		<tr><td align="center">Sl No.</td>
		<td align="center">Full Name</td>
		<td align="center">Street Name 1</td>
		<td align="center">Street Name 2</td>
		<td align="center">Town/Vill</td>
		<td align="center">District</td>
		<td align="center">Pin Code</td>
		</tr></thead>
		
		
		<tbody>';
		
		$part1=$labour->query("SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
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
			
				<tr>
          <td colspan="3">
		<table width="100%" align="center" style="margin:0px auto;" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive" border="1">
		<thead>
		<tr><td colspan="7" height="40px">6. Full name and residential address (es) of the Directors in the case of a Company registered under the Companies Act, 1956.</td></tr>
		<tr><td align="center">Sl No.</td>
		<td align="center">Full Name</td>
		<td align="center">Street Name 1</td>
		<td align="center">Street Name 2</td>
		<td align="center">Town/Vill</td>
		<td align="center">District</td>
		<td align="center">Pin Code</td>
		</tr></thead>
		
		
		<tbody>';
		
		$part3=$labour->query("SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
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
                    <td colspan="3">
					
					<table width="100%" align="center" style="margin:0px auto;" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive" border="1">
		<thead>
		<tr>
			<td colspan="7" height="40px">7.   Full name and address(es) of the Chief Executives or General Manager of the Plantation in the Public Sector </td></tr>
		<tr><td align="center">Sl No.</td>
		<td align="center">Full Name</td>
		<td align="center">Street Name 1</td>
		<td align="center">Street Name 2</td>
		<td align="center">Town/Vill</td>
		<td align="center">District</td>
		<td align="center">Pin Code</td>
		</tr></thead>
		
		
		<tbody>';
		
		$part4=$labour->query("SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
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
        </tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
		 
		<tr>
			<td rowspan="2" width="40%" valign="top">Signature and Date :  </td>
			<td width="30%">Signature of the Applicant :</td>
			<td width="30%">'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>Date :</td>
			<td>'.date('d-m-y',(strtotime($results["sub_date"]))).'</td>
		</tr> 
	  </table>';
?>


