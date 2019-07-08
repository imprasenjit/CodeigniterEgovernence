<?php
$dept="pcb";
$form="51";
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
		//$uain=$results["uain"];
		$from_year=$results["from_year"];$to_year=$results["to_year"];
		$reference_uain=$results["reference_uain"];$prev_cte_order_no=$results["prev_cte_order_no"];$prev_cte_order_date=$results["prev_cte_order_date"];$pre_status=$results["pre_status"];$reason_renewal=$results["reason_renewal"];

		$comm_name=$results["comm_name"];$comm_st1=$results["comm_st1"];$comm_st2=$results["comm_st2"];$comm_vill=$results["comm_vill"];$comm_dist=$results["comm_dist"];$comm_pincode=$results["comm_pincode"];$comm_mobile_no=$results["comm_mobile_no"];$comm_email=$results["comm_email"];
		
		if($prev_cte_order_date!="") $prev_cte_order_date=date("d-m-Y",strtotime($prev_cte_order_date));
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
   	    <td colspan="2" style="padding:10px 5px 5px 10px"><p><font size="18px">Guidelines for applying under Self Certification Scheme for auto renewal of "Consent to Establish" :</font>
		<br/>
		<hr/>
		<br/>
		<ol>
			<li>The ROs/ Head Office shall extend the validity period of CTE to the industries on receipt of the following from the proponent:<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(i) Requisition letter in the format from the industry directly to the Authority who has issued the said CTE order(i.e. RO/HO).<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ii) Copy of valid CTE order and EC order (in case of project covered under EIA Notification).<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(iii) The progress of construction of the project including installation and construction of Air/Water Pollution Control Systems along with the photographs.<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(iv) Reasons for extension of validity of CTE order and time required to complete the project.<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(v) Longitude and latitude of the site.	</li>
			<li>In order to simplify the procedure, a standard format for &#39;Application for Auto Renewal of CTE order is attached for information. There is no need for the inspection report of the site by the Regional Office for extension of CTE validity period.</li>
			<li>The CTE order shall not be Auto extended for the projects which have not started construction of the project (Construction wall/ security room shall not be considered) during the validity period and applied for extension after expiry of the order.</li>
			<li>The CTE order shall be extended for a period as requested by the industry not more that 5 years.In case of projects covered under EIA Notification , the auto extension shall be till validity of EC Order.</li>
			<li>The issuing authority has to issue order extending the validity of CTE order for 5 years within a period of one week.</li>
			
		</ol>
		</p></td>  	
    </tr>
    -->
	<tr>
		<td colspan="2"><p>To,<br/> The Member Secretary,<br/> Regional Officer<br/> Pollution Control Board, Assam.<br/><br/>
		<b>Sub : Request for Auto-Renewal of CTE order-reg.<br/>
		Ref : CTE order No '.strtoupper($prev_cte_order_no).' dtd '.strtoupper($prev_cte_order_date).'</b></p></td> 
	</tr>
	<tr>
		<td colspan="2"><p>Sir,<br/>&nbsp;With reference to above, it is requested to extend the validity of above CTE order for another 5 Years. The particulars of our industry are as following : </p></td>
	</tr>
	<tr>
			<td width="50%">For the year</td>
			<td>From &nbsp;&nbsp;'.strtoupper($from_year).' &nbsp;&nbsp;To&nbsp;&nbsp; '.strtoupper($to_year).'</td>
	</tr>
	<tr>
		<td>Your previous UAIN (if any)</td>
		<td>'.$reference_uain.'</td>
	</tr>
	
   	<tr>  		
   	    <td>1. Name and location of the industry :</td>
    	<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td> Name of the industry :</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1 </td>
        			<td>'.strtoupper($b_street_name1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($b_street_name2).'</td>
      		</tr>      		
      		<tr>
        			<td>Village/Town</td>
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
    		</table>
    	</td>
  	</tr>  	
	<tr> 	
   	    <td>2. Address to communicate the order : </td>
    	<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td> Full Name</td>
        			<td>'.strtoupper($comm_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1 </td>
        			<td>'.strtoupper($comm_st1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($comm_st2).'</td>
      		</tr>      		
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($comm_vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($comm_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($comm_pincode).'</td>
      		</tr>  
      		<tr>
        			<td>Mobile No.</td>
        			<td>'.strtoupper($comm_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Email</td>
        			<td>'.($comm_email).'</td>
      		</tr>      		
    		</table>
    	</td>
  	</tr>
	<tr>
  		<td>3. Present status of the project :</td>
   	     <td>'.strtoupper($pre_status).'</td>
   	</tr>
   	<tr>
        <td>4. Reasons for renewal : </td>
        <td>'.strtoupper($reason_renewal).'</td>
     </tr>
    
   ';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'
	
	<tr>
		<td colspan="2">This is to clarify that the above particulars are true to the best of my knowledge.</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td>Date: '.strtoupper($results["sub_date"]).'<br/>Place: '.strtoupper($dist).'</td>
				<td align="right" >'.strtoupper($key_person).'<br/>Signature of the Applicant </td>
			</tr>
		</table>
		</td>
    </tr>
    </table>';
?>