<?php
$dept="mines";
$form="16";
$table_name=getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and active='1' and form_id=form_id");
}
	
	
	//$get_array_legal_entity_values=get_legal_entity($l_o_business);
	
	
	if($q->num_rows > 0){
	$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$brick_category=$results["brick_category"];$area_applied=$results["area_applied"];$status_land=$results["status_land"];$brick_quantity=$results["brick_quantity"];$advance_amount=$results["advance_amount"];$secu_rity=$results["secu_rity"];
			 
			if(!empty($results["brick_location"])){
				$brick_location=json_decode($results["brick_location"]);
				$brick_location_a=$brick_location->a;$brick_location_b=$brick_location->b;$brick_location_d=$brick_location->d;
			}else{				
				$brick_location_a="";$brick_location_b="";$brick_location_d="";
			}				
			if(!empty($results["brick_earth"])){
				$brick_earth=json_decode($results["brick_earth"]);
				$brick_earth_a=$brick_earth->a;$brick_earth_b=$brick_earth->b;
			}else{				
				$brick_earth_a="";$brick_earth_b="";
			}
        
	}
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form '.$form.'</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
		<br>
		<table class="table table-bordered table-responsive">
		<tbody>			
 	
		<tr>  				
			<td colspan="2">Dear Sir,</td>
		</tr>		
		<tr>  				
			<td colspan="2">Undersigned intends to install a brick Kiln or is the owner of &nbsp;&nbsp; '.strtoupper($unit_name).'&nbsp;,&nbsp; '.strtoupper($unit_details).'&nbsp; and for manufacturing of the bricks requires the minor mineral namely "Brick Earth".</td>
		</tr>		
		<tr>  				
			<td colspan="2">1. The Details of the area for which permission is being sought, is given as under:- :</td>
		</tr>
		<tr>  				
			<td valign="top" width="50%">a)Location of Brick Kiln :</td>
			<td>
			<table class="table table-bordered table-responsive">

				<tr>
						<td width="50%">Village</td>
						<td>'.strtoupper($brick_location_a).'</td>
				</tr>
				<tr>
						<td>Sub-division :</td>
						<td>'.strtoupper($brick_location_b).'</td>
				</tr>
				<tr>
						<td>District :</td>
						<td>'.strtoupper($brick_location_d).'</td>
				</tr>
				
				</table>
			</td>
		</tr>
		<tr>  				
			<td>b) Category of the Brick Kiln :</td>
			<td>'.strtoupper($brick_category).'</td>
		</tr>
		<tr>  				
			<td colspan="2">c) Extent of the land from which brick earth is to be excavated :</td>
		</tr>
		<tr>  				
			<td valign="top" width="50%"></td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">Dag No. :</td> 
						<td>'.strtoupper($brick_earth_a).'</td>
				</tr>
				<tr>
						<td width="50%">Patta no :</td>
						<td>'.strtoupper($brick_earth_b).'</td>
				</tr>
				</table>
			</td>
			</tr>
			<tr>
					<td valign="top">d) Lay out plan of the area applied for permit :</td>
					<td>'.strtoupper($area_applied).'</td>
			</tr>		
			<tr>
					<td valign="top">e) Existing status of the land as compared to general ground level of the area :</td>
					<td>'.strtoupper($status_land).'  </td>
			</tr>
				
			<tr>
			    <td>f) Quantity of brick kiln required to be removed :</td>									
			    <td>'.strtoupper($brick_quantity).'</td>
		    </tr> 
			<tr>
				<td valign="top">g) Advance amount of permit fee/royalty :</td>
				<td>'.strtoupper($advance_amount).'  </td>
		</tr>
		<tr>
				<td valign="top">h) Security (refundable) : </td>
				<td>'.strtoupper($secu_rity).'</td>
		</tr>
		<tr>
			<td colspan="2"> 2. Applicant further submits that :  </td>
			
		</tr>
		<tr>
			<td colspan="2">i) Royalty at the rates prescribed under First Schedule to the Assam Minor Mineral Concession Rules, 2012 shall be paid for the brick earth to be removed from the area under permit. </td>	
			
		</tr>    							
		<tr>
			<td colspan="2">ii)Area is free from Plantation or is not forest land.</td>
					
		</tr>  	
		<tr>
		   <td colspan="2">iii)Digging of the earth at the site is otherwise not prohibited by any court of law or any authority.</td>
		</tr>
		<tr>
		   <td colspan="2">iv) Brick earth will be used only for manufacturing of bricks.</td>
		</tr>
		<tr>
			<td colspan="2">v) He will abide by all relevant provision for excavation of earth.</td>
			
		</tr>   							
		<tr>
			<td colspan="2">vi)A compensation has been settled with land owner mutually and a copy of the agreement signed between the applicant and the land owner qua mutual settlement of the compensation attached (in case land is owned by the applicant himself , the proof thereof ). </td>	
		</tr>		
		<tr>
			<td colspan="2">vii)In case of renewal of permit copy of last permit, along with proof of payment towards applicable permit money or royalty.</td>	
		</tr>';			
		
			$formFunctions->print_upload_payment_details($results);
		    $printContents=$printContents.'
			
			<tr>
				<td colspan="2"><br/>&nbsp;&nbsp;I/We do hereby declare that the particulars furnished above are correct and am/are ready to furnish any other details, including accurate plans as may be required by you.</td>				
			</tr>	
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="center"> Yours faithfully,<br/>Signature of Applicant :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>	
			<tr>
				<td>Place : <strong>'.strtoupper($dist).'</strong></td>						
				<td align="center"> Designation :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>						
		</table>';
?>

