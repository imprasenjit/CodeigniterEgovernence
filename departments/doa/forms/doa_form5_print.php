<?php
 $dept="doa";
 $form="5";
 $table_name=getTableName($dept,$form);	
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from  ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from  ".$table_name." where uain='$uain' and user_id='$swr_id'");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from  ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from  ".$table_name." where user_id='$swr_id' and active='1'");
	}

	if($q->num_rows>0)
	{
        $results=$q->fetch_assoc();		
		$form_id=$results["form_id"];$categories=$results["categories"];$day=$results["day"];$year=$results["year"];$licence_no=$results["licence_no"];$licence_dt=$results["licence_dt"];$cat_operation=$results["cat_operation"];$expert_staff=$results["expert_staff"];$insecticides=$results["insecticides"];$stocking=$results["stocking"];$is_grant=$results["is_grant"];$other=$results["other"];$father_name=$results["father_name"];
			
			if(!empty($results["address"])){
				$address=json_decode($results["address"]);
				$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_v=$address->v;$address_d=$address->d;$address_p=$address->p;$address_mno=$address->mno;
			}else{				
				$address_sn1="";$address_sn2="";$address_d="";$address_p="";$address_v="";$address_mno="";
			}	
		
		  if($is_grant=="Y"){ 
			$is_grant="YES"; 
		  }elseif($is_grant=="N"){
			$is_grant="NO";		
	       }else{
			  $is_grant="";	
		   }
	}
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'
  			<h4>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	   <tr>
            <td colspan="2" >To<br/><br/>The Licensing Authority</td>
		</tr>
  	   <tr>
            <td colspan="2">1. I/We hereby apply for renewal of the licence to stock and use restricted insecticides for categories I, II and III, under the name and style of &nbsp;'.strtoupper($categories).'&nbsp;The licence desired to be renewed was granted the Licensing Authority and alloted License No.'.strtoupper($licence_no).'&nbsp;on the &nbsp;'.strtoupper($licence_dt).'&nbsp;&nbsp;day of&nbsp;&nbsp;'.strtoupper($day).'&nbsp;&nbsp; 20'.strtoupper($year).'.</td>
		</tr>
		<tr>
			<td colspan="2">2. State the, if any, in :</td>
		</tr>
		<tr>
			<td width="50%">(a) Category of operation :</td><td width="50%">'.strtoupper($cat_operation).'</td>
		</tr>
		<tr>
			<td>(b) Expert staff :</td><td width="50%">'.strtoupper($expert_staff).'</td>
		</tr>
		<tr>
			<td>(c) Restricted insecticides used :</td><td width="50%">'.strtoupper($insecticides).'</td>
		</tr>
		<tr>
			<td>(d) Premises of stocking :</td><td width="50%">'.strtoupper($stocking).'</td>
		</tr>
		<tr>
			<td>(e) Address including branch officers :  </td>
			<td><table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">Street Name 1  :</td>
						<td >'.strtoupper($address_sn1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 : </td>
						<td>'.strtoupper($address_sn2).'</td>
					</tr>
					<tr>
						<td>Village/ Town : </td>
						<td>'.strtoupper($address_v).'</td>
					</tr>
					<tr>
						<td>District : </td>
						<td>'.strtoupper($address_d).'</td>
					</tr>
					<tr>
						<td>Pincode : </td>
						<td>'.strtoupper($address_p).'</td>
					</tr>
					<tr>
						<td>Mobile No. : </td>
						<td>'.strtoupper($address_mno).'</td>
					</tr>
				</table>
            </td>
        </tr>
		<tr>
			<td>(f) Whether any new branch / unit has been opened after grant or renewal of license :</td>
			<td>'.strtoupper($is_grant).'</td>
		</tr>
		<tr>
			<td>(g) Any other change : </td>
			<td>'.strtoupper($other).'</td>
		</tr> 
		<tr>
				<td colspan="2"><strong>VERIFICATION</strong><br/><br/>I &nbsp;'.strtoupper($key_person).'&nbsp;S/O&nbsp;'.strtoupper($father_name).'&nbsp;do hereby solemnly verify that to the best of my knowledge and belief the information given in the application and the annexures and statements accompanying it is correct and complete.</td>
		</tr>
		<tr>
			<td colspan="2" >I further declare that I am making this application in my capacity as &nbsp;'.strtoupper($status_applicant).'&nbsp;(Designation) and that I am competent to make this application and verify it, by virtue of a photo/attested copy which has already been submitted.</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
        $printContents=$printContents.' 
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">Signature of Applicant <strong> :</strong>&nbsp;'.strtoupper($key_person).'<br/>Contact No.:&nbsp;'.strtoupper($mobile_no).'</td>
		</tr>
	</table>
	';
?>