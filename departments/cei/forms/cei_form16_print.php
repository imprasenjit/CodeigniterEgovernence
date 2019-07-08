<?php 
$dept="cei";
$form="16";
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
		$install_at=$results['install_at'];$install_lift=$results['install_lift'];
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
  		<tr>  				
			<td colspan="2">
			To,<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Inspector of Lift and Escalators,<br/><br/>
			Sub : Renewal of working license for the escalator installed at &nbsp;<b>'.strtoupper($install_at).'</b> <br/><br/>
			Sir,<br/><br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With reference to the above, it is stated that the working license in respect of escalator installed &nbsp;<b>'.strtoupper($install_lift).'</b>&nbsp; is sent herewith for renewal thereof as required under section 6 of the Assam Lifts and Escalators Act, 2006 and it is requested to return the same after renewal.<br/><br/>
			<br/> </td>
		</tr>
		';
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		<tr >
			<td> Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
			<td align="right"><b>'.strtoupper($key_person).'</b><br/>Signature of the owner</td>
        </tr>
    </tbody>
</table>';

?>

