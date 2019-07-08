<?php
if(!isset($get_file_name)){
  ob_start();
  require_once "../includes/login_session.php";
}
  
    $row1=$formFunctions->fetch_swr($swr_id);
    //$email=$formFunctions->get_usermail($swr_id);
  $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
  $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
  $b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
  $from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
  $unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
  $q=$formFunctions->executeQuery($dept,"select * from pcb_form12 where user_id=$swr_id and active='1'");
  $results=$q->fetch_assoc();
  if($q->num_rows>0){		
			$form_id=$results['form_id'];$product=$results['product'];$add_info=$results['add_info'];
							
			if(!empty($results["nodal_off"]))
			{
				$nodal_off=json_decode($results["nodal_off"]);
				$nodal_off_name=$nodal_off->name;$nodal_off_desig=$nodal_off->desig;
			}else{
				$nodal_off_name="";$nodal_off_desig="";
			}
			if(!empty($results["auth_req"]))
			{
				$auth_req=json_decode($results["auth_req"]);
				if(isset($auth_req->a)) $auth_req_a=$auth_req->a;
				if(isset($auth_req->b)) $auth_req_b=$auth_req->b;
				if(isset($auth_req->c)) $auth_req_c=$auth_req->c;
				if(isset($auth_req->d)) $auth_req_d=$auth_req->d;
			}
			else
			{
				$auth_req_a="";$auth_req_b="";$auth_req_c="";$auth_req_d="";
			}
			if(!empty($results["quantity"]))
			{
				$quantity=json_decode($results["quantity"]);
				$quantity_q1=$quantity->q1;$quantity_q2=$quantity->q2;$quantity_q3=$quantity->q3;
			}else{
				$quantity_q1="";$quantity_q2="";$quantity_q3="";
			}
			if(!empty($results["measure"]))
			{
				$measure=json_decode($results["measure"]);
				$measure_a=$measure->a;$measure_b=$measure->b;
			}else{
				$measure_a="";$measure_b="";
			}
			if(!empty($results["disposal"]))
			{
				$disposal=json_decode($results["disposal"]);
				$disposal_a=$disposal->a;$disposal_b=$disposal->b;$disposal_c=$disposal->c;$disposal_d=$disposal->d;
			}else{
				$disposal_a="";$disposal_b="";$disposal_c="";$disposal_d="";
			}
    }	
	if(!empty($results["auth_req"])){
			$auth_req=json_decode($results["auth_req"]);
			if(isset($auth_req->a)) $auth_req_value="Waste Processing"; else $auth_req_value="";
			if(isset($auth_req->b)) $auth_req_value=$auth_req_value." , Recycling";
			if(isset($auth_req->c)) $auth_req_value=$auth_req_value." , Treatment";
			if(isset($auth_req->d)) $auth_req_value=$auth_req_value." , Disposal at landfill";
		}else{
			$auth_req_value="";
		}	
 $file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];$file7=$results['file7'];$file8=$results['file8'];$file9=$results['file9'];
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
        }
        if(!empty($results["courier_details"])){
            $courier_details=json_decode($results["courier_details"]);
            $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
        }else{
            $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
        }
    
    $form_name=$cms->query("select form_name from pcb_form_names where form_no='18'")->fetch_object()->form_name; 

if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form VII</title>
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
        <h4>FORM – I </h4>
        <p  style="text-align:center"> [see rule  15 (y) 16 (1) (c), 21(3) ] </p>
        <h4>'.$form_name.'</h4>
        </div><br/>
      <table class="table table-bordered table-responsive">
		<tr>
			<td colspan="3">To</td>
		</tr>
		<tr>
			<td colspan="3">The Member Secretary,<br/>State Pollution Control Board or Pollution Control Committee<br/> of&emsp;'.strtoupper($dist).'</td>
		</tr>
		<tr>
			<td colspan="3">Sir,</td>
		</tr>
		<tr>
			<td colspan="3">I/We  hereby  apply  for  authorisation  under  the  Solid  Waste  Management    Rules,  2016  for  processing, recycling, treatment and disposal of solid waste. </td>
		</tr>
		<tr>
  			<td valign="top" style="width:20px;">1.</td>
   			<td valign="top" style="width:400px;">Name of the local body/agency appointed by them/ operator of facility</td>
    		<td>'.strtoupper($local_agency).'</td>
		</tr>
		<tr>
  			<td valign="top" style="width:20px;">2.</td>
   			<td valign="top" style="width:400px;">Correspondence address</td>
    		<td><table class="table table-bordered table-responsive">
				<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($b_street_name3).'</td>
				</tr>
				<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($b_street_name4).'</td>
				</tr>
				<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($b_vill2).'</td>
				</tr>
				<tr>
        			<td>District</td>
        			<td>'.strtoupper($b_dist2).'</td>
				</tr>
				<tr>
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($b_pincode2).'</td>
				</tr>
				<tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).'&nbsp;'.strtoupper($b_landline_no).'</td>
				</tr>
				<tr>
        			<td height="29">Email-id</td>
        			<td>'.strtoupper($b_email).'</td>
				</tr>
    		</table>
    	</td>
	</tr>
  	<tr>
  		<td valign="top">3.</td>
    	<td valign="top">Nodal Officer & designation(Officer authorised by the local body or agency responsible for operation of processing/ treatment  or disposal facility)</td>
    	<td>
    		<table width="99%" border="1" style="border-collapse: collapse">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($nodal_off_name).'</td>
      		</tr>
      		<tr>
        			<td>Designation</td>
        			<td>'.strtoupper($nodal_off_desig).'</td>
      		</tr>
    		</table>
    	</td>
  	</tr>  
  	<tr>
  		<td valign="top">4.</td>
    	<td valign="top"Authorisation required for setting up and operation of the facility </td>
    	<td>Number of batteries :'.strtoupper($auth_req_).'<br/>
    	Total tonnage :'.strtoupper($num_used_batt_tot_tonnage).'</td>
   </tr>
   
   
   	<tr>
  		<td valign="top" >5.</td>
    	<td valign="top">Attach copies of the Documents</td>
    	<td><table width="99%" border="1" style="border-collapse: collapse">
			<tr>
				<td>Site clearance (local body)</td>
				<td>Upload Section</td>
			</tr>
			<tr>
				<td>Proof of Environmental Clearance </td>
				<td>Upload Section</td>
			</tr>
			<tr>
				<td>Consent for establishment </td>
				<td>Upload Section</td>
			</tr>
			<tr>
				<td>Agreement between municipal  authority and operating agency </td>
				<td>Upload Section</td>
			</tr>
			<tr>
				<td>Investment on the project and expected return</td>
				<td>Upload Section</td>
			</tr>
		</table>
		</td>
	</tr>
  	<tr>
  		<td valign="top">6.</td>
  		<td valign="top" colspan="2">Processing/recycling/treatment of solid waste
		<table class="table table-bordered table-responsive">
			<tr>
				<td>(i) Total quantity of waste to be processed per day</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Quantity of waste to be recycled</td>
				<td>'.strtoupper($quantity_q1).'</td>
			</tr>
			<tr>
				<td>Quantity of waste to be treated</td>
				<td>'.strtoupper($quantity_q2).'</td>
			</tr>
			<tr>
				<td>Quantity of waste to be disposed into landfill</td>
				<td>'.strtoupper($quantity_q3).'</td>
			</tr>
			<tr>
				<td>(ii) Utilisation programme for waste processed (Product utilisation)</td>
				<td>'.strtoupper($product).'</td>
			</tr>
			<tr>
				<td>(iii) Methodology for disposal (attach details)</td>
				<td>'.strtoupper($product).'</td>
			</tr>
			<tr>
				<td>Quantity of leachate </td>
				<td>Upload Section</td>
			</tr>
			<tr>
				<td>Treatment technology for leachate </td>
				<td>Upload Section</td>
			</tr>
			<tr>
				<td>(iv) Measures to be taken for prevention and control of environmental pollution </td>
				<td>'.strtoupper($measure_a).'</td>
			</tr>
			<tr>
				<td>(v) Measures to be taken for safety of workers  working in the plant </td>
				<td>'.strtoupper($measure_a).'</td>
			</tr>
			<tr>
				<td>(iii)Details on solid waste processing/recycling/ treatment/disposal facility (to be attached) </td>
				<td>Attach File</td>
			</tr>
		</table>
		</td>
  	</tr>
	<tr>
		<td>7.</td>
		<td>Disposal of solid waste</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Number of sites identified </td>
		<td>'.strtoupper($disposal_a).'</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Quantity of waste to be disposed per day </td>
		<td>'.strtoupper($disposal_b).'</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Details of methodology or criteria followed for site selection (attach) </td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Details of existing site under operation</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Methodology and operational details of landfilling </td>
		<td>'.strtoupper($disposal_c).'</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Measures taken to check environmental pollution</td>
		<td>'.strtoupper($disposal_d).'</td>
	</tr>
	<tr>
		<td>8. </td>
		<td>Any other information</td>
		<td>'.strtoupper($add_info).'</td>
	</tr>
    <tr>
    <td colspan="3">
  	<table class="table table-bordered table-responsive">
        <tbody>
        <tr>
        <td colspan="2">
        <table border="0" width="100%">
        <tr><td colspan="2"><b>Checklists---  * NA - Not Applicable   * SM - Submit Manually later</b></td></tr>
        <tr><td>Site clearance (local body).</td><td >'.$val1.'</td></tr>
        <tr><td>Proof of Environmental Clearance.</td><td >'.$val2.'</td></tr>
        <tr><td>Consent for establishment.</td><td >'.$val3.'</td></tr>
        <tr><td>Agreement between municipal  authority and operating agency .</td><td >'.$val4.'</td></tr>
        <tr><td>Investment on the project and expected return.</td><td >'.$val5.'</td></tr>
        <tr><td>Methodology for disposal (attach details)</td><td >&nbsp;</td></tr>
        <tr><td>Quantity of leachate. </td><td >'.$val6.'</td></tr>
        <tr><td>Treatment technology for leachate.</td><td >'.$val7.'</td></tr>
        <tr><td>Details on solid waste processing/recycling/ treatment/disposal facility </td><td >'.$val8.'</td></tr>
        <tr><td>Details of methodology or criteria followed for site selection</td><td >'.$val9.'</td></tr>';
    $printContents=$printContents.'</table>         
    </td>
  </tr>';

            if(!empty($results["courier_details"])){
            $printContents=$printContents.'
            <tr>           
            <td colspan="2">
                <table border="0" width="100%" class="table table-bordered table-responsive">
                    <tr><td height="45px" colspan="2">Courier Details.</td></tr>
                    <tr><td width="40%">Name of Courier Service </td><td width="60%">'.strtoupper($courier_details_cn).'</td></tr>
                    <tr><td width="40%">Ref. No. / Consignment No. </td><td width="60%">'.strtoupper($courier_details_rn).'</td></tr>
                    <tr><td width="40%">Dispatch Date </td><td width="60%">'.strtoupper($courier_details_dt).'</td></tr>
                </table>
            </td>
            </tr>
            ';              
            }       
            $printContents=$printContents.'     
        <tr>
            <td style="width:60%">
            <table class="table table-bordered table-responsive">
			<tr>
				<td valign="top">Date : '.strtoupper($results["sub_date"]).' <br/>Place :'.strtoupper($dist).'</td>
				<br/>
				<td align="right">Signature :'.strtoupper($key_person).'<br/>Designation :'.strtoupper($status_applicant).'</td>
			</tr>
			</table>
			</td>
		</tr>
    </table>
  </body>
  </html>';
if(!isset($get_file_name))
{   
    $mypdf="pcb_form18".$swr_id.".pdf";
    ob_end_clean();
    include("../../mpdf60/mpdf.php"); 
    $mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->list_indent_first_level = 0;
    $mpdf->WriteHTML($printContents);         
    $mpdf->Output($mypdf,'I');

  $pcb->close();
}
?>