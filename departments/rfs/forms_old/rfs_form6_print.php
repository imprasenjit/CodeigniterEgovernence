<?php if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$rfs->query("select * from rfs_form6 where user_id='$swr_id' and form_id='$form_id'") or die($rfs->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$rfs->query("select * from rfs_form6 where uain='$uain' and user_id='$swr_id'") or die($rfs->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$rfs->query("select * from rfs_form6 where user_id='$swr_id' and form_id='$form_id'") or die($rfs->error);		
	}else{
		$q=$rfs->query("select * from rfs_form16 where user_id='$swr_id' and active='1'") or die($rfs->error);
	}
	if(isset($css)){
		$email=$mysqli->query("select email from users where id='$applicant_id'")->fetch_object()->email;
	}else{
		$email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
	}	
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$pattano=$row1['pattano'];$dagno=$row1['dagno'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$revenue=$row1['revenue'];$mouza=$row1['mouza'];
    $date_of_commencement=$row1['date_of_commencement'];
	
	$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
	if($previous_details->num_rows>0){
		$prev_results=$previous_details->fetch_assoc();
		$reg_no=$prev_results->uain;$reg_date=$prev_results->upload_date;$unit_name=$prev_results->soc_name;$soc_address=$prev_results->soc_address;
		
		if(!empty($soc_address)){
			$soc_address=json_decode($row1['soc_address']);
			$mouza=$soc_address->mouza;$revenue=$soc_address->circle;$pattano=$soc_address->patta;$dagno=$soc_address->dag;$street_name1=$soc_address->area;$street_name2=$soc_address->locality;
			$b_vill=$soc_address->village;$b_dist=$soc_address->dist;$b_pincode=$soc_address->pin;
			$police_station=$soc_address->ps;$post_office=$soc_address->po;			
		}else{
			$soc_address_mouza="";$soc_address_circle="";$pattano="";$soc_address_dag="";$soc_address_area="";$soc_address_locality="";
			$soc_address_village="";$soc_address_dist="";$soc_address_pin="";$soc_address_ps="";$soc_address_po="";	
		}
		$q=$rfs->query("select * from rfs_form6 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();

		if($q->num_rows<1){	 ###EMPTY FORM DETAILS###
			$form_id="";$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";$file11="";
		}else{		
			$form_id=$results['form_id'];$post_office=$results['post_office'];$police_station=$results['police_station'];$reg_date=$results['reg_date'];
			$reg_no=$results['reg_no'];	$propsociety=$results['$propsociety'];	
			$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];$file7=$results['file7'];$file8=$results['file8'];$file9=$results['file9'];
		$file10=$results['file10'];$file11=$results['file11'];
		}
	}else{
		$uain="";$reg_date="";
		
		$q=$rfs->query("select * from rfs_form6 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();

		if($q->num_rows<1){	 ###EMPTY FORM DETAILS###
			$form_id="";$post_office="";$police_station="";
		}else{		
			$form_id=$results['form_id'];$post_office=$results['post_office'];$police_station=$results['police_station'];$reg_date=$results['reg_date'];
			$reg_no=$results['reg_no'];	$uain=$results['uain'];	
			$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$propsociety=$results['$propsociety'];	$file6=$results['file6'];$file7=$results['file7'];$file8=$results['file8'];$file9=$results['file9'];
		$file10=$results['file10'];$file11=$results['file11'];
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
				$courier_details=json_decode($results["courier_details"]);
				$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
		}		
	}
		
	if(!isset($css)){
		$val1=$formFunctions->get_uploadFile($file1);
		$val2=$formFunctions->get_uploadFile($file2);
		$val3=$formFunctions->get_uploadFile($file3);
		$val4=$formFunctions->get_uploadFile($file4);
		$val5=$formFunctions->get_uploadFile($file5);
		$val6=$formFunctions->get_uploadFile($file6);
		$val7=$formFunctions->get_uploadFile($file7);
		$val8=$formFunctions->get_uploadFile($file8);
		$val9=$formFunctions->get_uploadFile($file9);
		$val10=$formFunctions->get_uploadFile($file10);
		$val11=$formFunctions->get_uploadFile($file11);
		
	
	}else{
		$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
		$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
		$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
		$val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
		$val5=$formFunctions->get_useruploadFile($file5,$applicant_id);
	    $val6=$formFunctions->get_useruploadFile($file6,$applicant_id);
		$val7=$formFunctions->get_useruploadFile($file7,$applicant_id);
		$val8=$formFunctions->get_useruploadFile($file8,$applicant_id);
		$val9=$formFunctions->get_useruploadFile($file9,$applicant_id);
		$val10=$formFunctions->get_useruploadFile($file10,$applicant_id);
		$val11=$formFunctions->get_useruploadFile($file11,$applicant_id);
	}	
	$form_name=$formFunctions->get_formName('rfs','6');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	
	
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 2</title>
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>Form No 7</h4>
  			<h4>'.$form_name.'</h4>
		</div><br/>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >			
			<tr>				
				<td width="50%">1. Name of the Applicant</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>
				<td>2. Fathers Name: </td>
				<td>'.strtoupper($father).'</td>
			</tr>
			
			<tr>
				<td colspan="2" height="40px" valign="center">5. Address of the Society </td>
			</tr>
			
			<tr>
				<td>Locality</td>
				<td>'.strtoupper($b_street_name2).'</td>
			</tr>
			<tr>
				<td>Village</td>
				<td>'.strtoupper($b_vill).'</td>
			</tr>
			<tr>
				<td>Post Office</td>
				<td>'.strtoupper($post_office).'</td>
			</tr>
			<tr>
				<td>Police Station</td>
				<td>'.strtoupper($police_station).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($b_dist).'</td>
			</tr>
			<tr>
				<td>Pin code </td>
				<td>'.strtoupper($b_pincode).'</td>
			</tr>
			<tr>
				<td>Mobile No.</td>
				<td>'.strtoupper($b_mobile_no).'</td>
			</tr>
			<tr>
				<td>Email ID</td>
				<td>'.$b_email.'</td>
			</tr>
			<tr>
				<td>Deed No.</td>
				<td>'.strtoupper($deed).'</td>
			</tr>
			<tr>
				<td>Date:</td>
				<td>'.strtoupper($Date:).'</td>
			</tr>
			<tr>
				<td>Place of Deed Registration:</td>
				<td>'.strtoupper($place_deed).'</td>
			</tr>
			<tr>
				<td>Deed No.</td>
				<td>'.strtoupper($deed1).'</td>
			</tr>
			<tr>
				<td>Date:</td>
				<td>'.strtoupper($Date1).'</td>
			</tr>
			<tr>
				<td>Place of Deed Registration:</td>
				<td>'.strtoupper($place_deed1).'</td>
			</tr>
			
			
		<tr>
				<td colspan="2" height="50px"><b>Checklist of the Documents</b></td>
		</tr>
			<tr>
				<td>1. Registration Certificate.</td>
				<td>'.$val1.'</td> 
			</tr>
			<tr>
				<td>2. Form No. VII signed by the partners and witnessed by either a Judicial Magistrate or a Chartered Accountant .  </td>
				<td>'.$val2.'</td> 
			</tr>
			<tr>
				<td>3. Certified copy of Registration Deed of Partnership:</td>
				<td>'.$val3.'</td> 
			</tr>
			<tr>
				<td>4.Certified copy of Registration Deed of Rectification.</td>
				<td>'.$val4.'</td> 
			</tr>
			<tr>
				<td>5. Land document of Principal Place of business.If not 
					Land Agreement/Affidavit from the house owner:</td>
				<td>'.$val5.'</td> 
			</tr>;
			<tr>
				<td>6.Land document of any other places of business.If not 
					Land Agreement/Affidavit from the house owner:</td>
				<td>'.$val6.'</td> 
			</tr>
			<tr>
				<td>7.Trade license,obtainable from the Municipal Corporation/Municipal Board/Town Committee of Goan Panchayat: </td>
				<td>'.$val7.'</td> 
			</tr>
			<tr>
				<td>8.Pan Card :</td>
				<td>'.$val8.'</td> 
			</tr>
			<tr>
				<td>9.General Index Register Number(GIR number):</td>
				<td>'.$val9.'</td> 
			</tr>
			<tr>
				<td>10.Sales Tax or Income Tax :</td>
				<td>'.$val10.'</td> 
			</tr>
			
			<tr>
				<td>11.Treasury Challan :</td>
				<td>'.$val11.'</td> 
			</tr>'
			
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$printContents=$printContents.'
		<tr>		   
		<td colspan="2">
			<table border="0" width="100%">
				<tr><td height="45px" colspan="2">Courier Details.</td></tr>
				<tr><td width="40%">Name of Courier Service </td><td width="60%">'.strtoupper($courier_details_cn).'</td></tr>
				<tr><td width="40%">Ref. No. / Consignment No. </td><td width="60%">'.strtoupper($courier_details_rn).'</td></tr>
				<tr><td width="40%">Dispatch Date </td><td width="60%">'.strtoupper($courier_details_dt).'</td></tr>
			</table>
		</td>
		</tr>';
		}	
			
			$printContents=$printContents.'<tr>
				<td>Signatures and Date</td>
				<td>
				<table width="99%">
					<tr>
						<td>Signature of the Applicant</td>
						<td>'.strtoupper($key_person).'<br/></td>				
					</tr>	
					<tr>
						<td width="40%">Date</td><td> '.strtoupper($results["sub_date"]).'</td>
						
					</tr>
				</table>
			</td>
		</tr>
	</table>

';
?>

  