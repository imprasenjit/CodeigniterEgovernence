<?php if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$power->query("select * from power_form1 where user_id='$swr_id' and form_id='$form_id'") or die($power->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$power->query("select * from power_form1 where uain='$uain' and user_id='$swr_id'") or die($power->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$power->query("select * from power_form1 where user_id='$swr_id' and form_id='$form_id'") or die($power->error);		
	}else{
		$q=$power->query("select * from power_form1 where user_id='$swr_id' and active='1'") or die($power->error);
	}
	if(isset($css)){
		$email=$mysqli->query("select email from users where id='$applicant_id'")->fetch_object()->email;
	}else{
		$email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
	}	
	$row1=$row1=$formFunctions->fetch_swr($swr_id);	
		
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$w_l=$row1['w_l'];$sector_classes_b=$row1['sector_classes_b'];
		if($w_l=="O") $w_l="Own";
		else if($w_l=="R") $w_l="Rented";
		else if($w_l=="L") $w_l="Leased";
		else $w_l="";
		$sector_classes_b=get_sector_classes_b_value($sector_classes_b);
		$from=$key_person."<br/>Designation : ".$status_applicant."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$landline_std."-".$landline_no."<br/>E-mail ID : ".$email;
		
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
		$results=$q->fetch_assoc();
	
		$form_id=$results['form_id'];			
		$uain=$results["uain"];
		$required_power=$results["required_power"];
		$service_requested=$results["service_requested"];
		
		if($service_requested=="P"){
			$service_requested="New Connection(Permanent)";
		}else{
			$service_requested="New Connection(Temporary)";
		}
		
		$file1=$results["file1"];$file2=$results["file2"];
		$consumer_category=$results["consumer_category"];
		
		$exist_con_no=$results["exist_con_no"];$esd=$results["esd"];$request_load=$results["request_load"];
		$mouza_no=$results["mouza_no"];$dag_no=$results["dag_no"];
		
		if(!empty($results["billing"])){
			$billing=json_decode($results["billing"]);
			$billing_sn1=$billing->sn1;$billing_sn2=$billing->sn2;$billing_town=$billing->town;$billing_d=$billing->d;$billing_pin=$billing->pin;$billing_mobile=$billing->mobile;
		}else{
			$billing_sn1="";$billing_sn2="";$billing_town="";$billing_po="";$billing_d="";$billing_pin="";$billing_mobile="";
		}
		if(!empty($results["contract_demand"])){
			$contract_demand=json_decode($results["contract_demand"]);
			$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
		}else{
			$contract_demand_num="";$contract_demand_unit="";
		}
					
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>View Challan</a>";		
		}else{
			$payment_mode="ONLINE";
		}	
			if(!isset($css)){
				$val1=$formFunctions->get_uploadFile($results["file1"]);
				$val2=$formFunctions->get_uploadFile($results["file2"]);
			}else{
				$val1=$formFunctions->get_useruploadFile($results["file1"],$applicant_id);
				$val2=$formFunctions->get_useruploadFile($results["file2"],$applicant_id);
			}
$form_name=$formFunctions->get_formName('power','1');
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 1</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:10px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'
  			<h4>'.$form_name.'</h4>
		</div><br/>
<table width="99%" border="1" class="table table-bordered table-responsive"  style="margin:0px auto;border-collapse: collapse">
		
        <tr>
            <th colspan="4" style="text-align:left;height:40px">General Information</th>
        </tr>
		<tbody>
        <tr>
            <td colspan="2">Required Power (in KW) :</td>
            <td colspan="2">'.strtoupper($required_power).' KW</td>
        </tr>
        <tr>
            <td width="25%">Consumer Category :</td>
            <td width="25%">'.strtoupper($consumer_category).'</td>
            <td width="25%">Service Requested :</td>
            <td width="25%">'.strtoupper($service_requested).'</td>
        </tr>
        <tr>
            <td>Company Name :</td>
            <td>'.strtoupper($unit_name).'</td>
            <td>Name of the Applicant :</td>
            <td>'.strtoupper($key_person).'</td>
        </tr>
        <tr>
           <th colspan="4" style="text-align:left;height:40px">Address of the Applicant</th>
        </tr>
        <tr>
            <td>House No/ Plot No. :</td>
            <td>'.strtoupper($street_name1).'</td>
            <td>Road :</td>
            <td>'.strtoupper($street_name2).'</td>
        </tr>
        <tr>
            <td> Town/Village:</td>
            <td>'.strtoupper($vill).'</td>
            <td>District: </td>
            <td>'.strtoupper($dist).'</td>
        </tr>
        <tr>
            <td>Pincode :</td>
            <td>'.strtoupper($pincode).'</td>
            <td>Mobile No. :</td>
            <td>'.strtoupper($mobile_no).'</td>
        </tr>
        <tr>
            <th colspan="4" style="text-align:left;height:40px">Address of the enterprise at which supply is required </th>
        </tr>
        <tr>
            <td>House No/ Plot No. :</td>
            <td>'.strtoupper($b_street_name1).'</td>
            <td>Road :</td>
            <td>'.strtoupper($b_street_name2).'</td>
        </tr>
        <tr>
            <td> Town/Village:</td>
            <td>'.strtoupper($b_vill).'</td>
            <td>District: </td>
            <td>'.strtoupper($b_dist).'</td>
        </tr>
        <tr>
            <td >Pincode :</td>
            <td>'.strtoupper($b_pincode).'</td>
            <td>Mobile No. :</td>
            <td>'.strtoupper($b_mobile_no).'</td>
        </tr>
        <tr>
            <td> Existing/ Nearest Consumer Number :</td>
            <td>'.strtoupper($exist_con_no).'</td>
            <td>Electrical Sub Division</td>
            <td>'.strtoupper($esd).'</td>
        </tr>  
        <tr>
            <th colspan="4" style="text-align:left;height:40px">Billing Details</th>
        </tr>
   
        <tr>
            <td>Street name 1 : </td>
            <td>'.strtoupper($billing_sn1).'</td>
            <td>Street name 2 : </td>
            <td>'.strtoupper($billing_sn2).'</td>
        </tr>
        <tr>
            <td style=""> Town/Village :</td>
            <td>'.strtoupper($billing_town).'</td>
            <td style=""> District :</td>
            <td>'.strtoupper($billing_d).'</td>
        </tr>
        <tr>
            <td >Pincode :</td>
            <td>'.strtoupper($billing_pin).'</td>
            <td >Mobile No. :</td>
            <td>'.strtoupper($billing_mobile).'</td>
        </tr> 
		          
        <tr>
            <td style="">Type of Premises :</td>
            <td>'.strtoupper($w_l).'</td>
            <td></td>
            <td></td>
        </tr>
		<tr>
            <td>Mouza No. :</td>
            <td>'.strtoupper($mouza_no).'</td>
            <td> Dag No. :</td>
            <td>'.strtoupper($dag_no).'</td>
        </tr> 		
        
		<tr>
			 <th colspan="4" style="text-align:left;height:40px"><Font color="red"><b>List of documents to be enclosed.</b></font> </th>
		</tr>
		<tr>
			  <td colspan="2">1. For proof of Ownership/Occupancy, Land record details from Land Revenue Department or ownership/occupancy records from Municipal Corporation or Development Authority or Gaon Panchayat is required.</td>
			  <td colspan="2">'.$val1.'</td>
		</tr>					
		<tr>
			  <td colspan="2">2. Electrical Test Reports from valid Electrical contractor would required in the case of all applicants.</td>
			  <td colspan="2">'.$val2.'</td>
		</tr>';	
	if($results["payment_mode"]!=NULL){ 
		$printContents=$printContents.'<tr>		    
		<td colspan="2">
			<table border="0" width="100%">
			<tr><td height="45px" colspan="2">Payment Details :</td></tr>
			<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
			if($results["payment_mode"]==0)
			{
				$printContents=$printContents.'<tr><td width="50%">Application Fee Challan Reciept :</td>
					<td>'.$offline_challan.'</td></tr>';
				}else{
					$printContents=$printContents.$formFunctions->online_payment_details($uain);
				}
				$printContents=$printContents.'</table>		
			</td>
		  </tr>';
		  }
	$printContents=$printContents.' 
		<tr>
			<td colspan="2">Signatures and Dates:</td>
			<td colspan="2"><table width="99%">
				<tr>
					<td>Signature of Applicant : &nbsp; '.strtoupper($key_person).'<br/></td>				
				</tr>	
				<tr>
					<td width="60%">Date : '.date("d-m-Y",strtotime($results["sub_date"])).'</td>
					
				</tr>
				</table>
			</td>
		</tr>
    </tbody>
</table>';
?>