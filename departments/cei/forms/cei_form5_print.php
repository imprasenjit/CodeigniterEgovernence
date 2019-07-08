<?php 
$dept="cei";
$form="5";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	}
	
	if($q->num_rows>0){
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
		$ref=$results['ref'];$year_no=$results['year_no'];$ref_date=$results['ref_date'];$work_done=$results['work_done'];$contractor_reg =$results['contractor_reg'];$class_of_contract =$results['class_of_contract'];$con_valid_dt =$results['con_valid_dt'];$sup_name =$results['sup_name'];$sup_reg =$results['sup_reg'];$workman_name =$results['workman_name'];$workman_reg =$results['sup_reg'];$expected_com_date =$results['expected_com_date'];$expected_sub_date =$results['expected_sub_date'];	
		if(!empty($results["work_address"]))
		{
			$work_address=json_decode($results["work_address"]);
			$work_address_st1=$work_address->st1;;$work_address_st2=$work_address->st2;$work_address_vt=$work_address->vt;$work_address_dist=$work_address->dist;$work_address_pin=$work_address->pin;$work_address_mob=$work_address->mob;;$work_address_em=$work_address->em;
		}
		else
		{
			$work_address_st1="";$work_address_st2="";$work_address_vt="";$work_address_dist="";$work_address_pin="";$work_address_mob="";$work_address_email="";
		}		
		
    }
	$work_details = wordwrap($results["work_details"], 40, "<br/>", true);
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
		$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
	$printContents=$printContents.'
	<div style="text-align:center">
		'.$assamSarkarLogo.'
		<h4>'.$form_name.'</h4>
	</div><br/>
    <table class="table table-bordered table-responsive">
  	<tr>  	
		<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr>
				<td valign="top" >REF:&nbsp;'.strtoupper($ref).'</td>
				<td valign="top">YEAR/SL. NO:&nbsp;'.strtoupper($year_no).'</td>
				<td valign="top">DATE :&nbsp;'.strtoupper($ref_date).'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top" width="50%">1. Work to be done by:</td>
		<td>'.strtoupper($work_done).'</td>
	</tr>
  	<tr>
    	<td valign="top" >2. Registration no. of the contractors license :</td>
    	<td >'.strtoupper($contractor_reg).'</td>
	</tr>
  	<tr>
    	<td valign="top" >3. Class of contractors license :</td>
    	<td >'.strtoupper($class_of_contract).'</td>
	</tr>
  	<tr>
    	<td valign="top" >4. Valid up-to:</td>
    	<td >'.strtoupper($con_valid_dt).'</td>
	</tr>
	<tr>
		<td colspan="2" >5. Name of the supervisor with registration no. of the certificates of competancy  :</td>
	</tr>
	<tr>
		<td>(a) Name :</td>
		<td>'.strtoupper($sup_name).'</td>
	</tr>
	<tr>
		<td>(b) Registration no.:</td>
		<td>'.strtoupper($sup_reg).'</td>
	</tr>
	<tr>
		<td colspan="2">6. Name(s) of the workmen with registration no. of the permit :</td>
	</tr>
	<tr>
		<td>(a) Name:</td>
		<td>'.strtoupper($workman_name).'</td>
	</tr>
	<tr>
		<td>(b) Registration no.:</td>
		<td>'.strtoupper($workman_reg).'</td>
	</tr>
	<tr>
		<td width="50%" valign="top">7. Full address of the place where the work is going to be done :</td>
		<td width="50%">
		<table class="table table-bordered table-responsive">
		<tr>
			<td width="50%">Street Name1 </td>
			<td>'.strtoupper($work_address_st1).'</td>
		</tr>
		<tr>
			<td>Street Name2 </td>
			<td>'.strtoupper($work_address_st2).'</td>
		</tr>
		<tr>
			<td>Village </td>
			<td>'.strtoupper($work_address_vt).'</td>
		</tr>
		<tr>
			<td>District </td>
			<td>'.strtoupper($work_address_dist).'</td>
		</tr>
		<tr>
			<td>Pincode </td>
			<td>'.strtoupper($work_address_pin).'</td>
		</tr>
		<tr>
			<td>Mobile No. </td>
			<td>'.strtoupper($work_address_mob).'</td>
		</tr>
		<tr>
			<td>Email_id </td>
			<td>'.($work_address_em).'</td>
		</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td >8. Details description of the work going to be done (attached electrical drawing herewith) :</td>
		<td>'.strtoupper($work_details).'</td>
	</tr>
	<tr>
		<td >9. Expected date of completion of the work :</td>
		<td>'.strtoupper($expected_com_date).'</td>
	</tr>
	<tr>
		<td >10. Date of submission of this notice :</td>
		<td>'.strtoupper($expected_sub_date).'</td>
	</tr>
	';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'  
        <tr>
			<td> Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b><br/>Place : <b>'.strtoupper($dist).'</b></td>
			<td align="right"><b> '.strtoupper($key_person).'</b><br/>	Signature of contractor</td>
        </tr>
</table>';
?>