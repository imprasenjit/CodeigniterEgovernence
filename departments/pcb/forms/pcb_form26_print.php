<?php
$dept="pcb";
$form="26";
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
		$applicant_ref_no=$results["applicant_ref_no"];$im_ex_country=$results["im_ex_country"];$spec_hndl_req=$results["spec_hndl_req"];$ship_date=$results["ship_date"];$total_qn=$results["total_qn"];$trans_means=$results["trans_means"];$transfer_date=$results["transfer_date"];$rep_sign=$results["rep_sign"];$export_date=$results["export_date"];$exporter_sign=$results["exporter_sign"];$exporter_name2=$results["exporter_name2"];$received_by=$results["received_by"];$quantity_rcvd=$results["quantity_rcvd"];$rcvd_date=$results["rcvd_date"];$importer_name=$results["importer_name"];$importer_sign=$results["importer_sign"];$recovery_method=$results["recovery_method"];$r_code=$results["r_code"];$employed_tech=$results["employed_tech"];$importer_sign2=$results["importer_sign2"];$import_date2=$results["import_date2"];
		
		if(!empty($results["exporter"])){
			$exporter=json_decode($results["exporter"]);
			$exporter_name=$exporter->name;$exporter_sn1=$exporter->sn1;$exporter_sn2=$exporter->sn2;$exporter_vt=$exporter->vt;$exporter_dist=$exporter->dist;$exporter_pin=$exporter->pin;$exporter_mob=$exporter->mob;$exporter_email=$exporter->email;$exporter_cp=$exporter->cp;
		}else{
			$exporter_name="";$exporter_sn1="";$exporter_sn2="";$exporter_vt="";$exporter_dist="";$exporter_pin="";$exporter_mob="";$exporter_email="";$exporter_cp="";
		}
		if(!empty($results["generator"])){
			$generator=json_decode($results["generator"]);
			$generator_name=$generator->name;$generator_sn1=$generator->sn1;$generator_sn2=$generator->sn2;$generator_vt=$generator->vt;$generator_dist=$generator->dist;$generator_pin=$generator->pin;$generator_mob=$generator->mob;$generator_email=$generator->email;$generator_cp=$generator->cp;$generator_sg=$generator->sg;
		}else{
			$generator_name="";$generator_sn1="";$generator_sn2="";$generator_vt="";$generator_dist="";$generator_pin="";$generator_mob="";$generator_email="";$generator_cp="";$generator_sg="";
		}
		if(!empty($results["trader"])){
			$trader=json_decode($results["trader"]);
			$trader_name=$trader->name;$trader_sn1=$trader->sn1;$trader_sn2=$trader->sn2;$trader_vt=$trader->vt;$trader_dist=$trader->dist;$trader_pin=$trader->pin;$trader_mob=$trader->mob;$trader_email=$trader->email;$trader_cp=$trader->cp;
		}else{
			$trader_name="";$trader_sn1="";$trader_sn2="";$trader_vt="";$trader_dist="";$trader_pin="";$trader_mob="";$trader_email="";$trader_cp="";
		}
		if(!empty($results["actual"])){
			$actual=json_decode($results["actual"]);
			$actual_name=$actual->name;$actual_sn1=$actual->sn1;$actual_sn2=$actual->sn2;$actual_vt=$actual->vt;$actual_dist=$actual->dist;$actual_pin=$actual->pin;$actual_mob=$actual->mob;$actual_email=$actual->email;
		}else{
			$actual_name="";$actual_sn1="";$actual_sn2="";$actual_vt="";$actual_dist="";$actual_pin="";$actual_mob="";$actual_email="";
		}
		if(!empty($results["waste"])){
			$waste=json_decode($results["waste"]);
			$waste_qn=$waste->qn;$waste_phychar=$waste->phychar;$waste_bn=$waste->bn;$waste_ship_name=$waste->ship_name;$waste_cls=$waste->cls;$waste_no=$waste->no;$waste_hnum=$waste->hnum;$waste_ynum=$waste->ynum;$waste_itc=$waste->itc;$waste_customs=$waste->customs;$waste_other=$waste->other;
		}else{
			$waste_qn="";$waste_phychar="";$waste_bn="";$waste_ship_name="";$waste_cls="";$waste_no="";$waste_hnum="";$waste_ynum="";$waste_itc="";$waste_customs="";$waste_other="";
		}
		if(!empty($results["receiver"])){
			$receiver=json_decode($results["receiver"]);
			$receiver_authtype=$receiver->authtype;$receiver_no=$receiver->no;
		}else{
			$receiver_authtype="";$receiver_no="";
		}
		if(!empty($results["transporter"])){
			$transporter=json_decode($results["transporter"]);
			$transporter_name=$transporter->name;$transporter_sn1=$transporter->sn1;$transporter_sn2=$transporter->sn2;$transporter_vt=$transporter->vt;$transporter_dist=$transporter->dist;$transporter_pin=$transporter->pin;$transporter_mob=$transporter->mob;$transporter_email=$transporter->email;$transporter_cp=$transporter->cp;$transporter_regno=$transporter->regno;
		}else{
			$transporter_name="";$transporter_sn1="";$transporter_sn2="";$transporter_vt="";$transporter_dist="";$transporter_pin="";$transporter_mob="";$transporter_email="";$transporter_cp="";$transporter_regno="";
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
    }
    $printContents=$printContents.'
    <div style="text-align:center">
		<h4>'.$form_name.'</h4>
    </div><br/> 
   <table class="table table-bordered table-responsive">  
	<tr>		
        <td valign="top" width="50%">1.Exporter (Name and Address) :</td>
        <td width="50%">
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($exporter_name).'</td>
      		</tr>
			<tr>
					<td>Street Name 1</td>
        			<td>'.strtoupper($exporter_sn1).'</td>
			</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($exporter_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Vill/Town</td>
        			<td>'.strtoupper($exporter_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($exporter_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($exporter_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($exporter_mob).'</td>
      		</tr>
			<tr>
					<td>Email ID</td>
					<td>'.$exporter_email.'</td>
			</tr>
			<tr>
					<td>Contact Person</td>
					<td>'.strtoupper($exporter_cp).'</td>
			</tr>
    		</table>
    	</td>
	</tr>
	<tr>
        <td valign="top" >2. Generator(s) of the waste (Name and Address) :</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($generator_name).'</td>
      		</tr>
			<tr>
					<td>Street Name 1</td>
        			<td>'.strtoupper($generator_sn1).'</td>
			</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($generator_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Vill/Town</td>
        			<td>'.strtoupper($generator_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($generator_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($generator_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($generator_mob).'</td>
      		</tr>
			<tr>
					<td>Email ID</td>
					<td>'.$generator_email.'</td>
			</tr>
			<tr>
					<td>Contact Person</td>
					<td>'.strtoupper($generator_cp).'</td>
			</tr>
			<tr>
				<td>Site of generation</td>
				<td>'.strtoupper($generator_sg).'</td>
			</tr>
    		</table>
    	</td>
	</tr>	
	<tr>
        <td valign="top" >3.Importer or Actual user (Name and Address) :</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
			<tr>
					<td>Street Name 1</td>
        			<td>'.strtoupper($b_street_name1).'</td>
			</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($b_street_name2).'</td>
      		</tr>
      		<tr>
        			<td>Vill/Town</td>
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
        			<td>+91'.strtoupper($b_mobile_no).'</td>
      		</tr>
			<tr>
					<td>Email ID</td>
					<td>'.$b_email.'</td>
			</tr>
			<tr>
					<td>Contact Person</td>
					<td>'.strtoupper($key_person).'</td>
			</tr>
    		</table>
    	</td>
	</tr>
	<tr>
        <td valign="top" >4.i) Trader (Name and Address) :</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($trader_name).'</td>
      		</tr>
			<tr>
					<td>Street Name 1</td>
        			<td>'.strtoupper($trader_sn1).'</td>
			</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($trader_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Vill/Town</td>
        			<td>'.strtoupper($trader_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($trader_dist).'</td>
      		</tr>
      		<tr>
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($trader_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($trader_mob).'</td>
      		</tr>
			<tr>
					<td>Email ID</td>
					<td>'.$trader_email.'</td>
			</tr>
			<tr>
					<td>Contact Person</td>
					<td>'.strtoupper($trader_cp).'</td>
			</tr>
    		</table>
    	</td>
	</tr>
	<tr>
        <td valign="top" style="text-indent:14px;" width="50%">(ii) Details of actual user (Name, Address, Telephone and email) :</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($actual_name).'</td>
      		</tr>
			<tr>
					<td>Street Name 1</td>
        			<td>'.strtoupper($actual_sn1).'</td>
			</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($actual_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Vill/Town</td>
        			<td>'.strtoupper($actual_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($actual_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($actual_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($actual_mob).'</td>
      		</tr>
			<tr>
					<td>Email ID</td>
					<td>'.$actual_email.'</td>
			</tr>
    		</table>
    	</td>
	</tr>
	<tr>
		<td >5. Corresponding to applicant Ref. No., If any:</td>
		<td >'.strtoupper($applicant_ref_no).'</td>
	</tr>
	<tr>
		<td >6. Bill of lading :</td>
		<td >Document is attached</td>
	</tr>
	<tr>
		<td >7.Country of import/export:</td>
		<td >'.strtoupper($im_ex_country).'</td>
	</tr>
	<tr>
		<td colspan="2">8. General description of waste:</td>
	</tr>
	<tr>
		<td width="50%" style="text-indent:14px;">(a) Quantity:</td>
		<td >'.strtoupper($waste_qn).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(b) Physical characteristics:</td>
		<td >'.strtoupper($waste_phychar).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(c) Chemical composition of waste , where applicable:</td>
		<td >Document is attached</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(d) Basel No.:</td>
		<td >'.strtoupper($waste_bn).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(e) UN Shipping name:</td>
		<td >'.strtoupper($waste_ship_name).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(f) UN Class:</td>
		<td >'.strtoupper($waste_cls).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(g) UN No:</td>
		<td >'.strtoupper($waste_no).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(h) H Number:</td>
		<td >'.strtoupper($waste_hnum).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(i) Y Number:</td>
		<td >'.strtoupper($waste_ynum).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(j) ITC (HS):</td>
		<td >'.strtoupper($waste_itc).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(k) Customs Code (H.S.):</td>
		<td >'.strtoupper($waste_customs).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(l) Other (specify):</td>
		<td >'.strtoupper($waste_other).'</td>
	</tr>
	<tr>
		<td >9.(a)Type of packages::</td>
		<td >'.strtoupper($receiver_authtype).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(b)Number:</td>
		<td >'.strtoupper($receiver_no).'</td>
	</tr>
	<tr>
		<td >10. Special handling requirements including emergency provision in case of accidents:</td>
		<td >'.strtoupper($spec_hndl_req).'</td>
	</tr>
	<tr>
		<td colspan="2">11. Movement subject to single/multiple consignment<br/>In case of multiple movement-</td>
		
	</tr>
	<tr>
		<td style="text-indent:14px;">(a) Expected dates of each shipment or expected frequency of the shipments:</td>
		<td >'.strtoupper($ship_date).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(b) Estimated total quantity and quantities for each individual shipment:</td>
		<td >'.strtoupper($total_qn).'</td>
	</tr>
	<tr>
        <td valign="top" >12. (a)Transporter of waste (Name and Address):</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($transporter_name).'</td>
      		</tr>
			<tr>
					<td>Street Name 1</td>
        			<td>'.strtoupper($transporter_sn1).'</td>
			</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($transporter_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Vill/Town</td>
        			<td>'.strtoupper($transporter_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($transporter_dist).'</td>
      		</tr>
      		<tr>
        			<td >Pincode</td>
        			<td>'.strtoupper($transporter_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($transporter_mob).'</td>
      		</tr>
			<tr>
					<td>Email ID</td>
					<td>'.$transporter_email.'</td>
			</tr>
			<tr>
					<td>Contact person</td>
					<td>'.strtoupper($transporter_cp).'</td>
			</tr>
			<tr>
				<td >Registration number:</td>
				<td >'.strtoupper($transporter_regno).'</td>
			</tr>
    		</table>
    	</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(b) Means of transport (road, rail, inland waterway, sea, air):</td>
		<td >'.strtoupper($trans_means).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(c) Date of Transfer:</td>
		<td >'.strtoupper($transfer_date).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(d) Signature of Carrier’s representative:</td>
		<td >'.strtoupper($rep_sign).'</td>
	</tr>
	<tr>
		<td colspan="2">13.<b>Exporter’s declaration for hazardous and other waste:</b></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:justify;">I certify that the information in Sl. Nos. 1 to 12 above are complete and correct to my best knowledge. I also certify that legally-enforceable written contractual obligations have been entered into and are in force covering the transboundary movement regulations/rules.</td>
	</tr>
	<tr>
		<td>Date: <br/>
		Signature: <br/>
		Name: <br/></td>
		<td >'.strtoupper($export_date).'<br/>
		'.strtoupper($exporter_sign).'<br/>
		'.strtoupper($exporter_name2).'<br/>
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>TO BE COMPLETED BY IMPORTER (ACTUAL USER OR TRADER)</b></td>
	</tr>
	<tr>
		<td >14.(a)Shipment received by importer/ actual user/trader</td>
		<td >'.strtoupper($received_by).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(b)Quantity received :<br/>
		Date:<br/>
		Name:<br/>
		Signature:<br/>
		</td>
		<td >'.strtoupper($quantity_rcvd).' Kg/litres<br/>
		'.strtoupper($rcvd_date).'<br/>
		'.strtoupper($importer_name).'<br/>
		'.strtoupper($importer_sign).'<br/>
		</td>
	</tr>
	<tr>
		<td >15.(a)Methods of recovery:</td>
		<td >'.strtoupper($recovery_method).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(b) R code*:</td>
		<td >'.strtoupper($r_code).'</td>
	</tr>
	<tr>
		<td style="text-indent:14px;">(c)Technology employed :</td>
		<td >'.strtoupper($employed_tech).'</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:justify;">16. I certify that nothing other than declared goods covered as per these rules is intended to be imported in the above referred consignment and will be recycled /utilized.</td>
	</tr>
	<tr>
		<td>Signature: <br/>
		Date: </td>
		<td>'.strtoupper($importer_sign2).'<br/>
		'.strtoupper($import_date2).'
		</td>
	</tr>
	<tr>
		<td >17.Specific conditions on consenting to the movement if applicable.</td>
		<td >Document is attached</td>
	</tr>
	';              
        $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
	<tr>
		<td width="50%">Date:<b>'.date('d-m-Y',strtotime($today)).'</b><br/>
		Place:<b>'.strtoupper($dist).'</b>
		</td>
		<td align="right">
			Signature:<b>'.strtoupper($key_person).'</b><br/>
			Designation:<b>'.strtoupper($status_applicant).'</b>            
	   </td>
	</tr>  
</table>';
?>