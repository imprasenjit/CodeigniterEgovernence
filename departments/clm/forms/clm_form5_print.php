<?php
$dept="clm";
$form="5";
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
            $form_id=$results['form_id'];$repairer_lic=$results["repairer_lic"];$tl_reg_no=$results["tl_reg_no"];
			$tl_date=$results["tl_date"];$total_turnover =$results['total_turnover'];
			if($tl_date!="" && $tl_date!="0000-00-00"){
				$tl_date = date('d-m-Y',strtotime($tl_date));
			}else{
				$tl_date="";
			}	
			$it_reg_no=$results["it_reg_no"];$op_area=$results["op_area"];$hav_u=$results["hav_u"];$stamp_details=$results["stamp_details"];$state=$results["state"];
			
			if($results["any_change"]=="Y"){
				$any_change="YES";
			}elseif($results["any_change"]=="N"){
				$any_change="NO";
			}
			if($results["hav_u"]=="Y"){
				$hav_u="YES";
			}elseif($results["hav_u"]=="N"){
				$hav_u="NO";
			}
			if(!empty($results['type_wm'])){
				$type_wm=json_decode($results['type_wm']);
				$type_wm_w=$type_wm->w;$type_wm_m=$type_wm->m;$type_wm_wi=$type_wm->wi;$type_wm_mi=$type_wm->mi;
			}else{
				$type_wm_w="";$type_wm_m="";$type_wm_wi="";$type_wm_mi="";
			}
			
    }
    $stamp_details = wordwrap($results["stamp_details"], 40, "<br/>", true);
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
    <div style="text-align:center">'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
        </div>
		<br/>
           <table class="table table-bordered table-responsive">
                <tr>
                    <td width="50%">1. (a) Name of the repairing concern/ person seeking renewal of license :</td>
                    <td>'.strtoupper($key_person).'</td>
                </tr>
                <tr>
                    <td width="50%" valign="top">(b) Address of the repairing concern/ person seeking renewal of license :</td>
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
					<td>2. Repairer&apos;s License Number :</td>
					<td>'.strtoupper($repairer_lic).'</td>
				</tr>
				<tr>
					<td colspan="2">3. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company :</td>
				</tr>
                <tr>
					<td colspan="2">
						<table class="table table-bordered table-responsive">
								<tr>
									<td>Sl No.</td>
									<td>Name</td>
									<td>Father&apos;s/Spouse&apos;s Name</td>
									<td>Address</td>
									<td>Pincode</td>
									<td>Contact No</td>
								</tr>';
								$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$clm->error);
								$sl=1;
								while($rows=$results1->fetch_object()){
									$printContents=$printContents.'
									<tr>
										<td>'.$sl.'</td>
										<td>'.strtoupper($rows->name).'</td>
										<td>'.strtoupper($rows->family_name).'</td>
										<td>'.strtoupper($rows->address).'</td>
										<td>'.strtoupper($rows->pincode).'</td>
										<td>'.strtoupper($rows->contact).'</td>
									</tr>';
									$sl++;
								}
								$printContents=$printContents.'
						</table>
					</td>
				</tr>
				<tr>
					<td>4. (a) Registration number of current shop/establishment/ Municipal Trade License : </td>
					<td>'.strtoupper($tl_reg_no).'</td>
				</tr>
				<tr>
					<td>(b) Date of current shop/establishment/ Municipal Trade License : </td>
					<td>'.strtoupper($tl_date).'</td>
				</tr>
				<tr>
					<td>5. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax : </td>
					<td>'.strtoupper($it_reg_no).'</td>
				</tr>
				<tr>
					<td>Total value of transactions / turnover :</td>
					<td>'.strtoupper($total_turnover).'</td>
				</tr>
				<tr>
					<td>6.(a) The type of weights and measures repaired as per license granted: </td>
					<td>(i)Weights : '.strtoupper($type_wm_w).'<br/>(ii)Measures : '.strtoupper($type_wm_m).'<br/>(iii)Weighing Instruments : '.strtoupper($type_wm_wi).'<br/>(iv)Measuring Instruments with details in each case : '.strtoupper($type_wm_mi).'</td>
				</tr>
				<tr>
					<td>(b) Do you propose any change? </td>
					<td>'.strtoupper($any_change).'</td>
				</tr>
				<tr>
					<td>7. Area in which you are operating : </td>
					<td>'.strtoupper($op_area).'</td>
				</tr>
				<tr>
					<td>8. Have you sufficient stock of loan/test weights, etc. : </td>
					<td>'.strtoupper($hav_u).'</td>
				</tr>
				<tr>
					<td>9. Please give details with particulars of stamping : </td>
					<td>'.strtoupper($stamp_details).'</td>
				</tr>
							
				<tr>
					<td colspan="2"><center><b>To be certified by the applicant(s)</b></center></td>
				</tr>
				<tr>
					<td colspan="2">Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state '.strtoupper($state).' .Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under.
					All the information furnished above is true to the best of my/ our knowledge.</td>
				</tr>
			';
			
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
        <tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
			<td align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
        </tr>
</table>';

?>


