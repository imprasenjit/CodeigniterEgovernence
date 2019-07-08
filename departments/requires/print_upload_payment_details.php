<?php 	

if(!empty($results["uploaded_documents"])){
	
	$printContents=$printContents.'
	<tr>
		<td colspan="2" height="50px"><h4>List of doucments to be enclosed/submitted :</h4></td>
	</tr>';
	
	$uploaded_documents_json=$results["uploaded_documents"];
	$uploaded_documents=json_decode($uploaded_documents_json,true);
	$sl=1;
	foreach ($uploaded_documents["documents"] as $key=>$values) {
		 if(!isset($css)){
			$file_value=$formFunctions->get_uploadFile($values[1]);
		}else{
			$file_value=$formFunctions->get_useruploadFile($values[1],$applicant_id);
		}
		$printContents=$printContents.'

		<tr>
			<td>'.$values[0].'</td>
			<td>'.$file_value.'</td>
		</tr>';
	}
}

if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
	
	$courier_details=json_decode($results["courier_details"]);
	$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
	
	 $printContents=$printContents.'
	 <tr>
		<td colspan="2" height="50px"><h4>Courier Details :</h4></td>
	</tr>
	<tr>
		<td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td>
	</tr>
	<tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
	<tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
	';              
}    
if($results["payment_mode"]==0){
	$payment_mode="OFFLINE";
	$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Download Challan/DD</a>";		
}else{
	$payment_mode="ONLINE";
}
if($results["payment_mode"]!=NULL){ 
$printContents=$printContents.'<tr>		    
<td colspan="2">
	<table border="1" width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse">
	<tr><td height="50px" colspan="2"><h4>Payment Details :</h4></td></tr>
	<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
	if($results["payment_mode"]==0)
	{
		$printContents=$printContents.'
		<tr>
			<td width="50%" valign="top">Demand Draft/Payment Reciept :</td>
			<td>'.$offline_challan.'<br/><br/>'.
			$formFunctions->offline_payment_details($results["uain"]) . '</td>
		</tr>';
	}else{
		$printContents=$printContents.$formFunctions->online_payment_details($results["uain"]);
	}
	$printContents=$printContents.'</table>		
	</td>
  </tr>';
}
?>