<?php
$dept="pcb";
$form="52";
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
		$from_year=$results["from_year"];$to_year=$results["to_year"];
		$uain=$results['uain'];
		$reference_uain=$results["reference_uain"];
		$prev_capital_investment=$results["prev_capital_investment"];
		$prev_cto_order_no="";$prev_cto_order_no=$results["prev_cto_order_no"];$prev_cto_order_date=$results["prev_cto_order_date"];$prev_cto_order_validity_date=$results["prev_cto_order_validity_date"];
		$capital_investment=$results["capital_investment"];
		
		if($prev_cto_order_date!="") $prev_cto_order_date=date("d-m-Y",strtotime($prev_cto_order_date));  else $prev_cto_order_date="";
		if($prev_cto_order_validity_date!="") $prev_cto_order_validity_date=date("d-m-Y",strtotime($prev_cto_order_validity_date));  else $prev_cto_order_validity_date="";
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
</div>
<table class="table table-bordered table-responsive">
	<!--
	<tr>
   	    <td colspan="2" style="padding:10px 5px 5px 10px"><p><font size="18px">Guidelines for applying under Self Certification Scheme for auto renewal of "Consent to Operate" :</font>
		<br/>
		<hr/>
		<br/>
		<ol>
			<li>The auto-renewal of consent will be applicable when there is no increase in overall production capacity and also, in pollution load.</li>
			<li>This scheme is applicable, only in case if there is marginal increase (upto max 10%) in the capital investment which is due to infrastructure development, clean technology, pollution control system and better production management, without increase in production or pollution load, the industry shall submit corresponding fees for Consent to Establish and also difference in consent to operate fees since the blocks year the capital investment is made on pro-rata basis.</li>
			<li>In case, if there is increase in Capital investment by over 10% then the application for grant of renewal of Consent under Auto-renewal Policy will not be considered. The industry needs to apply in prescribed application form.</li>
			<li>In case, if the capital investment is decreased, then the application for grant of renewal of Consent under Auto-renewal Policy will not be considered. The industry needs to apply in prescribed application form.</li>
			<li>For the Auto-renewal, industry shall submit format of Self-Certification {Annexure A) on compliance of earlier Consent conditions duly signed by person authorised by Companys Board and shall submit the copy of the said Resolution (Annexure C) along with the prescribed fees at PCBA HO/ROs and, also industry shall submit Commitment towards compliance of the Consent conditions &amp; the Environmental Laws in prescribed format (Annexure-B).</li>
			<li>The format of self-certification by industries is encfosed as Annexure A will be avaflable in the Boards website. The industry shall submit this format along with the prescribed fees either at PCBA Head Office or respective Regional Offices(ROs) or through online under EoDB web portal. ln case, the application is submitted at ROs, ROs shall ensure that the same shall be forwarded within 7 days along with details of fees paid. The renewal will be reflected in the EoDB web portal within 15 days.</li>
			<li>Following conditions shall be incorporated in the Consent while granting renewal under Auto- renewal Policy :<br/>
			a). This Consent is issued under the auto renewal consent policy of the Board vide letter No..............dtd. ............. as per Self -certificate submitted by Mr. ....................................(Designation ...................)&nbsp;&nbsp;authorized signatory.
			<br/>
			b). &quot;The Pollution Control Board, Assam reserves the rights to revoke the Consent any time for any violation.&quot;
			<br/>
			c) The applicant shall inform the Board in each financial year about the change in Capital Investment of the industry. In case, if the Capital Investment is increased by an amount upto 10% then Industry shall make payment of the corresponding fees for Consent to Establish and also difference in Consent to Operate fees for the corresponding block year. In case, if there is increase in Capital Investment by over 10% then the industry shall submit a fresh application in prescribed form.
			
			</li>
		</ol>
		</p></td>  	
    </tr>
    -->
	<tr>
		<td colspan="2"><p>To,<br/> The Member Secretary,<br/> Regional Officer<br/> Pollution Control Board, Assam.<br/><br/>
		<b>Sub : Self Certification of Compliances for Auto-renewal of Consent to Operate.<br/>
		Ref : Consent issued by the Board vide letter No '.strtoupper($prev_cto_order_no).' dtd. '.strtoupper($prev_cto_order_date).' valid upto '.strtoupper($prev_cto_order_validity_date).'</b><br/></p></td> 
	</tr>
	<tr>
		<td colspan="2">		
			<p align="justify">
			Sir,<br/> We are submitting our Consent renewal application along with the necessary fees for the same. We wish to apply for the auto-renewal of our existing Consent referred above. We undertake the following : <br/><br/>		
			1. We have obtained a valid "Consent to Operate" from the Pollution Control Board, Assam vide above referred letter and copy of the same is enclosed. The present details of the manufacturing	process and all other information as required under the prescribed Consent application form are same as per the earlier Consent application submitted for above referred Consent and therefore the same may be considered for present application.
			<br/><br/>2. The Capital investment of the industry, as per the earlier Consent granted by Pollution Control Board, Assam vide above referred Consent was Rs. '.$prev_capital_investment.' Lakh. The Capital investment for the proposed Consent auto-renewal is Rs. '.$capital_investment.' Lakh.<br/>
			(The change in Capital investment, if any, is only due to investments in infrastructure development, clean technology; pollution control systems and better production management. There is no increase in production or pollution load than as referred in the earlier granted Consent. We are submitting corresponding fees for Consent to establish and also, difference in "Consent to Operate"	fees since the block year the Capital investment is made on pro-rata basis, duly supported by the Chartered Accountants Certificate to that effect).
			<br/><br/>3. The production or manufacturing was as per the Consented limits during the validity period of the earlier Consent for which renewal has been applied.
			<br/><br/>4. We are complying with the earlier conditions of Consent granted vide above reference.
			<br/><br/>5. We undertake to comply with any further condition which may stipulated by PCBA in future and also, undertake to pay all the charges/fees in future.
			<br/><br/>6. I am duly authorised by the company to submit this self-certification along with application for Auto Renewal. In case of any misleading information/concealment of material facts or wrong	information revealed by the Board, the consent will be liable to be revoked and the company will be	liable for further necessary legal action. A copy of the commitment letter about the authenticity of the information provided is true and correct to the best of my knowledge and belief and as per record of the company is submitted separately for which the undersigned is fully responsible being authorised signatory.
			<br/><br/>7. The above self certificate is true and correct to the best of my knowledge and belief and I have personally verified the above contents by perusal of all the documents available with the company. An affidavit in the support of self certification on the basis of personal verification of compliance of the conditions stipulated in Consent is enclosed for which, I  for authenticity thereof.<br/>It is requested to issue the auto-renewal of the Consent.<br/>
		</p>		
		</td>
	</tr>
	<tr>
			<td width="50%">For the year</td>
			<td>From &nbsp;&nbsp;'.strtoupper($from_year).' &nbsp;&nbsp;To&nbsp;&nbsp; '.strtoupper($to_year).'</td>
	</tr>
    <tr>
		<td>Your previous UAIN (if any)</td>
		<td>'.$reference_uain.'</td>
	</tr>	
   ';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
	<tr>
		<td colspan="2">This is to clarify that the above particulars are true to the best of my knowledge.</td>
	</tr>
	<br>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td>Date: '.strtoupper($results["sub_date"]).'<br/><br/> Place: '.strtoupper($dist).'</td>
				<td align="right" >'.strtoupper($key_person).'<br/>Signature of the Applicant </td>
			</tr>
		</table>
		</td>
    </tr>
</table>';
?>