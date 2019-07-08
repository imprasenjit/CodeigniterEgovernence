`<?php 
$dept="cei";
$form="12";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
	}
    
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$is_lift_esc=$results['is_lift_esc'];
		$auth_person=$results['auth_person'];$auth_no=$results['auth_no'];
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'
			<h4> '.$form_name.'</h4>
		</div><br/>
      <table class="table table-bordered table-responsive">
  		';
		if($is_lift_esc=="L"){
			$printContents=$printContents.'
			<tr>  				
				<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby declare and undertake to complete the work of erection of lift for which permission to install may be granted under the Assam Lifts and Escalators Act, 2006. We also undertake the responsibility to see that works of lift installation is inspected by the Inspector of Lifts and Escalators and defects pointed out by him are duly complied with. The lift installed by us shall be handed over to the respective owner after the license to use the lift is issued under section 4.</td>
			</tr>
		';
		}else{
			$printContents=$printContents.'
				<tr>  				
					<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby declare and undertake to complete the work of erection of escalator for which permission to install may be granted under the Assam Lifts and Escalators Act, 2006. We also undertake the responsibility to see that works of escalator installation is inspected by the Inspector of Lifts and Escalators and defects pointed out by him are duly complied with. The escalator installed by us shall be handed over to the respective owner after the license to use the escalator is issued under section 4.</td>
				</tr>
			';
		}
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		<tr>
			<td> Date : <b>'.date('d-m-Y',strtotime(($results["sub_date"]))).'</b></td>
			<td align="right">Name of the authorized person : <b>'.strtoupper($auth_person).'</b><br/>
								Authorization number : <b>'.strtoupper($auth_no).'</b>
			</td>
		</tr>
</table>';

?>
