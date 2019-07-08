<?php 
$dept="labour";
$form="1";
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
	
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Email : ".$email;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$owner_type=$row1['Type_of_ownership'];$date_of_commencement=$row1['date_of_commencement'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);

	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$manager_name=$results["manager_name"];$max_workers=$results["max_workers"];$estab_category=$results["estab_category"];
		if($estab_category!=""){
			$estab_category_query="select shops_category from payment_details_forms_1_9 where shops_category_id='$estab_category'";
			$estab_category_query_results=$formFunctions->executeQuery($dept,$estab_category_query);
			if($estab_category_query_results->num_rows>0){
				$estab_category=$estab_category_query_results->fetch_object()->shops_category;
			}
		}
		if(!empty($results["situation"])){				
			$situation=json_decode($results["situation"]);
			$situation_office=$situation->office;$situation_storeroom=$situation->storeroom;$situation_godown=$situation->godown;$situation_warehouse=$situation->warehouse;				
		}else{
			$situation_office="";$situation_storeroom="";$situation_godown="";$situation_warehouse="";
		}
		if(!empty($results["manager_address"])){				
			$manager_address=json_decode($results["manager_address"]);
			$m_street_name1=$manager_address->sn1;$m_street_name2=$manager_address->sn2;$m_vill=$manager_address->vill;$m_dist=$manager_address->dist;$m_pin=$manager_address->pin;				
		}else{
			$m_street_name1="";$m_street_name2="";$m_vill="";$m_dist="";$m_pin="";
		}
	}
	$sub_date=$results["sub_date"];
	$situation_office= wordwrap($situation_office, 40, "<br/>", true);
	$situation_storeroom= wordwrap($situation_storeroom, 40, "<br/>", true);
	$situation_warehouse= wordwrap($situation_warehouse, 40, "<br/>", true);
	$situation_godown= wordwrap($situation_godown, 40, "<br/>", true);
	
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
	</div>        
	<br><br>
	<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tr>
			<td colspan="2">
				<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="0">
					<tr>
						<td colspan="2" valign="top">To <br/><br/>The Inspector of Shops and Establishments<br/></td>
					</tr>  
					<tr>
						<td colspan="2">
							<p>Sir, </p>
							<p align="justify" style="text-indent: 50px;">
								I beg to apply for registration of my establishment for the period of twelve months from '.date("d-m-Y",strtotime($sub_date)).' to '.date("d-m-Y", strtotime(date($sub_date) . " + 365 days")).' as required under section 36 of the Assam Shops and Establishments Act, 1971 and the Rules framed thereunder.
							</p>
							 <p align="justify" style="text-indent: 50px;">
								The required particulars in regard to the establishment are furnished herein below in the form prescribed for the purpose in Duplicate.
							</p>
							<p>&nbsp;</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tr>
            <td valign="top">Name of Establishment, if any </td>
            <td width="50%">'.strtoupper($unit_name).'</td>
	    </tr>
		<tr>
            <td valign="top">Postal Address and exact location of the Establishment </td>
            <td>
                <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                        <tr>
                            <td width="30%">Street name 1 </td>
                            <td>'.strtoupper($b_street_name1).'</td>
                        </tr>
                        <tr>
                            <td>Street name 2 </td>
                            <td>'.strtoupper($b_street_name2).'</td>
                        </tr>
                        <tr>
                            <td>Town/Vill </td>
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
            <td>Situation of Office, store-room, godown, warehouse or work place, if any, attached to the establishment but situated inpremises different from those of the establishment   </td>
            <td>
               <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                    <tbody>
                        <tr>
                            <td width="30%">(a) Office </td>
                            <td>'.strtoupper($situation_office).'</td>
                        </tr>
                        <tr>
                            <td>(b) Store Room </td>
                            <td>'.strtoupper($situation_storeroom).'</td>
                        </tr>
                        <tr>
                            <td>(c) Godown  </td>
                            <td>'.strtoupper($situation_godown).'</td>
                        </tr>
						<tr>
                            <td>(d)  Warehouse  or Work Place </td>
                            <td>'.strtoupper($situation_warehouse).'</td>
                        </tr>
                    </tbody>
                </table>
			</td>
        </tr>
		<tr>
            <td valign="top" width="50%">Name of the Employer </td>
            <td width="50%">'.strtoupper($key_person).'</td>			
        </tr>
		<tr>
            <td valign="top">Residential address of the Employer </td>
            <td >
                <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                    <tbody>
                        <tr>
                            <td width="30%">Street name 1 </td>
                            <td>'.strtoupper($street_name1).'</td>
                        </tr>
                        <tr>
                            <td>Street name 2 </td>
                            <td>'.strtoupper($street_name2).'</td>
                        </tr>
                        <tr>
                            <td>Town/Vill </td>
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
                    </tbody>
                </table>
			</td>
        </tr>
		<tr>
            <td valign="top">Name of the Manager/Agent/other person acting in the general management, if any, and his address:  </td>
            <td>
                <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                    <tbody>
                        <tr>
                            <td width="30%">Full Name </td>
                            <td>'.strtoupper($results["manager_name"]).'</td>
                        </tr>
						<tr>
                            <td width="30%">Street name 1 </td>
                            <td>'.strtoupper($m_street_name1).'</td>
                        </tr>
                        <tr>
                            <td>Street name 2 </td>
							<td>'.strtoupper($m_street_name2).'</td>
                        </tr>
                        <tr>
                            <td>Town/Vill </td>
                            <td>'.strtoupper($m_vill).'</td>
                        </tr>
						<tr>
                            <td>District </td>
                            <td>'.strtoupper($m_dist).'</td>
                        </tr>
						<tr>
                            <td>Pin Code </td>
                            <td>'.strtoupper($m_pin).'</td>
                        </tr>
                    </tbody>
                </table>
			</td>
        </tr>
	</table>';
	if($owner_type=="PP" || $owner_type=="LLP"){ 
		$printContents=$printContents.'
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<thead>
				<tr><td colspan="7" height="40px"><strong>Name of partners and their residential addresses (if it is a partnership concern) :</strong></td></tr>
				<tr><td>Sl No.</td>
				<td>Full Name</td>
				<td>Street Name 1</td>
				<td>Street Name 2</td>
				<td>Town/Vill</td>
				<td>District</td>
				<td>Pin Code</td>
				</tr>
			</thead>
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
		</table>';
		}
		if($owner_type=="PTLC" || $owner_type=="PBLC"){ 
			$printContents=$printContents.'
			<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<thead>
					<tr><td colspan="7" height="40px"><strong>Names and residential addresses of Directors (if it is a case of limited company) :</strong></td></tr>
					<tr><td>Sl No.</td>
					<td>Full Name</td>
					<td>Street Name 1</td>
					<td>Street Name 2</td>
					<td>Town/Vill</td>
					<td>District</td>
					<td>Pin Code</td>
					</tr>
				</thead>
				<tbody>';
					$part2=$labour->query("SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_2["field1"]).'</td>
							<td>'.strtoupper($row_2["field2"]).'</td>
							<td>'.strtoupper($row_2["field3"]).'</td>
							<td>'.strtoupper($row_2["field4"]).'</td>
							<td>'.strtoupper($row_2["field5"]).'</td>
							<td>'.strtoupper($row_2["field6"]).'</td>
							<td>'.strtoupper($row_2["field7"]).'</td>
						</tr>';
					}
					$printContents=$printContents.'
				</tbody>
			</table>';
			}
			$printContents=$printContents.'
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<tr>
				<td valign="top" width="50%">Category of establishment : </td>
				<td width="50%">'.strtoupper($estab_category).'</td>
			</tr>
			<tr>
				<td>Total No. of Employees : </td>
				<td>'.strtoupper($max_workers).'</td>
			</tr>
			<tr>
				<td valign="top" width="50%">Nature of business </td>
				<td width="50%">'.strtoupper($business_type).'</td>
			</tr>
			<tr>
				<td valign="top" width="50%">Date of commencement of business </td>
				<td width="50%">'.strtoupper($date_of_commencement).'</td>
			</tr>
		</table>
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<thead>
				<tr><td colspan="5" height="40px"><strong>Name of members of the employer&#39;s family employed in the establishment and residing with and wholly dependent upon him :</strong></td></tr>
				<tr>
					<td>Sl No.</td>
					<td>Full Name</td>
					<td>Relationship</td>
					<td>Male/Female</td>
					<td>Adult/Child</td>
				</tr>
			</thead>
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
					</tr>';
				}
				$printContents=$printContents.'
			</tbody>
		</table>
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<thead>
				<tr><td colspan="5" height="40px"><strong>Total Number of Permanent Employees :</strong></td></tr>
				<tr><td>Sl No.</td>
				<td>Full Name</td>
				<td>Relationship</td>
				<td>Male/Female</td>
				<td>Adult/Child</td>
				</tr>
			</thead>
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
				</tr>';
			}
			$printContents=$printContents.'
			</tbody>
		</table>
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<thead>
				<tr><td colspan="5" height="40px"><strong>Total Number of Temporary or Casual Employees :</strong></td></tr>
				<tr><td>Sl No.</td>
				<td>Full Name</td>
				<td>Relationship</td>
				<td>Male/Female</td>
				<td>Adult/Child</td>
				</tr>
			</thead>
			<tbody>';
			$part5=$labour->query("SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
			while($row_5=$part5->fetch_array()){
			$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($row_5["field1"]).'</td>
					<td>'.strtoupper($row_5["field2"]).'</td>
					<td>'.strtoupper($row_5["field3"]).'</td>
					<td>'.strtoupper($row_5["field4"]).'</td>
					<td>'.strtoupper($row_5["field5"]).'</td>
				</tr>';
			}
			$printContents=$printContents.'
			</tbody>
		</table>
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<thead>
				<tr><td colspan="5" height="40px"><strong>Total Number of Learner Probationer Employees :</strong></td></tr>
				<tr><td>Sl No.</td>
				<td>Full Name</td>
				<td>Relationship</td>
				<td>Male/Female</td>
				<td>Adult/Child</td>
				</tr>
			</thead>
			<tbody>';
			$part6=$labour->query("SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
			while($row_6=$part6->fetch_array()){
			$printContents=$printContents.'
			<tr>
				<td>'.strtoupper($row_6["field1"]).'</td>
				<td>'.strtoupper($row_6["field2"]).'</td>
				<td>'.strtoupper($row_6["field3"]).'</td>
				<td>'.strtoupper($row_6["field4"]).'</td>
				<td>'.strtoupper($row_6["field5"]).'</td>
			</tr>';
		}
		$printContents=$printContents.'
			</tbody>
		</table>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
		
		<table border="1" width="100%" style="margin:0px auto;border-collapse: collapse" class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
				<td align="right" >Signature of the Employer : '.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td>Place : '.strtoupper($dist).'</td>
				<td align="right">Designation : '.strtoupper($status_applicant).'</td>
			</tr> 
		</table>';
?>