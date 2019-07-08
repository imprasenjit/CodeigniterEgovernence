<?php
 $dept="doa";
 $form="4";
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

	if($q->num_rows>0)
	{	
        $results=$q->fetch_assoc();
		$form_id=$results["form_id"];$is_corner=$results["is_corner"];$is_corner_details=$results["is_corner_details"];$insecticides=$results["insecticides"];$particulars=$results["particulars"];
				
			if(!empty($results["sold"])){
				$sold=json_decode($results["sold"]);
				$sold_sn1=$sold->sn1;$sold_sn2=$sold->sn2;$sold_v=$sold->v;$sold_p=$sold->p;$sold_mno=$sold->mno;$sold_d=$sold->d;
			}else{				
				$sold_sn1="";$sold_sn2="";$sold_v="";$sold_d="";$sold_p="";$sold_mno="";
			}	
			if(!empty($results["stored"])){
				$stored=json_decode($results["stored"]);
				$stored_sn1=$stored->sn1;$stored_sn2=$stored->sn2;$stored_v=$stored->v;$stored_p=$stored->p;$stored_mno=$stored->mno;$stored_d=$stored->d;
			}else{				
				$stored_sn1="";$stored_sn2="";$stored_v="";$stored_d="";$stored_p="";$stored_mno="";
			}	
			
		if($results["is_corner"]=="Y"){
			$is_corner="YES";
		}else{
			$is_corner="NO";
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
            <td colspan="2" >To<br/><br/>The Licensing Authority,<br/>State of Assam <br/>The Director of Agriculture, Assam, Khanapara, Guwahati-22</td>
		</tr>
  	   <tr>
            <td width="50%">1. Full name and address of the applicant :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Name </td>
						<td >'.strtoupper($key_person).'</td>
					</tr>
					<tr>
						<td>Street name 1 </td>
						<td >'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2. Is the applicant a new corner? :</td>
			<td >'.strtoupper($is_corner).'</td>
		</tr> 
		<tr>
			<td>3. If yes, the names of the principals, if any, whom he represent. :</td>
			<td >'.strtoupper($is_corner_details).'</td>
		</tr>
		<tr>
				<td colspan="2">4. I enclose a certificate from the principals whom I represent or whom I intend to represent and the source/ sources from which insecticides will be obtained.</td>
		</tr>  
		<tr>
				<td valign="top" colspan="2" >5. Situation of the dealer&apos;s premises where the insecticides will be (a) stored: and (b) sold  :</td>
		</tr>
		<tr>
				<td valign="top" > (a). Stored  :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1  :</td>
						<td >'.strtoupper($stored_sn1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 : </td>
						<td>'.strtoupper($stored_sn2).'</td>
					</tr>
					<tr>
						<td>Village/ Town : </td>
						<td>'.strtoupper($stored_v).'</td>
					</tr>
					<tr>
						<td>District : </td>
						<td>'.strtoupper($stored_d).'</td>
					</tr>
					<tr>
						<td>Pincode : </td>
						<td>'.strtoupper($stored_p).'</td>
					</tr>
					<tr>
						<td>Mobile No. : </td>
						<td>'.strtoupper($stored_mno).'</td>
					</tr>
				</table></td>
		</tr>
		<tr>
				<td valign="top" > (b). Sold :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1  :</td>
						<td >'.strtoupper($sold_sn1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 : </td>
						<td>'.strtoupper($sold_sn2).'</td>
					</tr>
					<tr>
						<td>Village/ Town : </td>
						<td>'.strtoupper($sold_v).'</td>
					</tr>
					<tr>
						<td>District : </td>
						<td>'.strtoupper($sold_d).'</td>
					</tr>
					<tr>
						<td>Pincode : </td>
						<td>'.strtoupper($sold_p).'</td>
					</tr>
					<tr>
						<td>Mobile No. : </td>
						<td>'.strtoupper($sold_mno).'</td>
					</tr>
				</table></td>
		</tr>
		<tr>
				<td >6. The names of insecticides in which the applicant desires to carry on business. : </td>
				<td>'.strtoupper($insecticides).'</td>
		</tr>
		<tr>
				<td>7. Full particulars of licenses issued in his name by other State Governments, if any in their areas. :</td>
				<td>'.strtoupper($particulars).' </td>
		</tr>
		<tr>
				<td colspan="2">8.Declaration :</td>
		</tr>
		<tr>
				<td colspan="2">(a) I/ We declare that the information given above is true to my/ our knowledge and belief, and no part thereof is false.</td>
		</tr>
		<tr>
				<td colspan="2">(b) I/ We carefully have read the terms and conditions of the license and agree to abide by them.</td>
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