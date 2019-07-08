<?php
$dept="pcb";
$form="6";
$table_name=$formFunctions->getTableName($dept,$form);

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
	$form_id=$results["form_id"];	
	$import_process=$results["import_process"];
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
          <i style="font-size:14px;">(To be submitted by importer of new lead acid batteries)</i>
        </div><br/>
   <table class="table table-bordered table-responsive">
        <tr>        
        <td colspan="2">To<br/><br/>
              <p style="text-indent:50px">The Member Secretary,</p>
              <p style="text-indent:50px">State Pollution Control Board</p>
        <br/><br/>        
        </td>        
        </tr>
        <tr>
          <td style="text-align:justify;" colspan="2">1. I &nbsp;'.strtoupper($key_person).' &nbsp; of &nbsp; '.strtoupper($unit_name).' &nbsp; hereby submit that I am the process of importing  &nbsp;'.strtoupper($import_process).' &nbsp;(MT) of new lead acid batteries.</td>
        </tr>
        <tr>
        <td style="text-align:justify;" colspan="2">I undertake that I shall collect back the used batteries as per the schedule prescribed by the Government from time to time in lieu of the new batteries imported and sold, and shall send these only to the registered recyclers. I further undertake that I shall submit half-yearly returns as per item (iii) of rule 6 to the State Board and abide by their directions, if any.</td>
        </tr>
        ';				
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
	<tr>		
    <td valign="top">Place :'.strtoupper($dist).'<br/>
      Date : '.strtoupper($results["sub_date"]).'</td>
      <br/>
      <td align="right">'.strtoupper($key_person).'<br/>Signature of the Importer</td>
    </tr>
    </table>
    ';
?>