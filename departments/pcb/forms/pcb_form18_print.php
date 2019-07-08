<?php
$dept="pcb";
$form="18";
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
	$product=$results['product']; $add_info=$results['add_info'];$local_agency=$results['local_agency'];
				
	if(!empty($results["nodal_off"])){
		$nodal_off=json_decode($results["nodal_off"]);
		$nodal_off_name=$nodal_off->name;$nodal_off_desig=$nodal_off->desig;
	}else{
		$nodal_off_name="";$nodal_off_desig="";
	}
	
	if(!empty($results["auth_req"])){
			$auth_req=json_decode($results["auth_req"]);
			if(isset($auth_req->a)) $auth_req_a=$auth_req->a;else $auth_req_a="";
			if(isset($auth_req->b)) $auth_req_b=$auth_req->b;else $auth_req_b="";
			if(isset($auth_req->c)) $auth_req_c=$auth_req->c;else $auth_req_c="";
			if(isset($auth_req->d)) $auth_req_d=$auth_req->d;else $auth_req_d="";
		}else{
			$auth_req_a="";$auth_req_b="";$auth_req_c="";$auth_req_d="";
		}
	//AUTHORIZATION CHECKMARKS///
	$auth_req_values="";
	
	if($auth_req_a=='WP') $auth_req_values=$auth_req_values. '<span class="tickmark">&#10004;</span> Waste Processing &nbsp;&nbsp;&nbsp;&nbsp;';
	if($auth_req_b=='R') $auth_req_values=$auth_req_values. '<span class="tickmark">&#10004;</span> Recycling &nbsp;&nbsp;&nbsp;&nbsp;';
	if($auth_req_c=='T') $auth_req_values=$auth_req_values. '<span class="tickmark">&#10004;</span> Treatment &nbsp;&nbsp;&nbsp;&nbsp;';
	if($auth_req_d=='DL') $auth_req_values=$auth_req_values. '<span class="tickmark">&#10004;</span> Disposal at landfill &nbsp;&nbsp;&nbsp;&nbsp;';

	if(!empty($results["quantity"])){
		$quantity=json_decode($results["quantity"]);
		$quantity_q1=$quantity->q1;$quantity_q2=$quantity->q2;$quantity_q3=$quantity->q3;
	}else{
		$quantity_q1="";$quantity_q2="";$quantity_q3="";
	}
	if(!empty($results["measure"])){
		$measure=json_decode($results["measure"]);
		$measure_a=$measure->a;$measure_b=$measure->b;
	}else{
		$measure_a="";$measure_b="";
	}
	if(!empty($results["disposal"])){
		$disposal=json_decode($results["disposal"]);
		$disposal_a=$disposal->a;$disposal_b=$disposal->b;$disposal_c=$disposal->c;$disposal_d=$disposal->d;$disposal_e=$disposal->e;
	}else{
		$disposal_a="";$disposal_b="";$disposal_c="";$disposal_d="";$disposal_e="";
	}		 
}

$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

if(!isset($css)){

$printContents='
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
    <div style="text-align:center"><h4>'.$form_name.'</h4><br/>  		
  	</div>
		<table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2">To,</td> 
			</tr>
			<tr>
				<td colspan="2">The Member Secretary,<br/>State Pollution Control Board or Pollution Control Committee<br/> of&emsp;'.strtoupper($dist).'</td> 
			</tr>
			<tr>
				<td colspan="2">Sir,</td>
			</tr>
			<tr>
				<td colspan="2">&emsp;I/We  hereby  apply  for  authorisation  under  the Solid  Waste  Management Rules,  2016  for  processing, recycling, treatment and disposal of solid waste. </td>
			</tr>
  		    <tr>
                <td valign="top">1. Name of the local body/agency appointed by them/ operator of facility  : '.strtoupper($local_agency).'</td>
                <td>
                <table class="table table-bordered table-responsive">
                <tr>
                    <td>2. Correspondence address :</td>
                    <td></td>
                </tr>
                <tr>
                    <td >Street Name 1</td>
                    <td>'.strtoupper($b_street_name1).'</td>
                </tr>
                <tr>
                    <td>Street Name 2</td>   
                    <td>'.strtoupper($b_street_name2).'</td>
                </tr>
                <tr>
                    <td>Village/Town</td>
                    <td >'.strtoupper($b_vill).'</td>
                </tr>
                <tr>
                    <td>District</td>
                    <td >'.strtoupper($b_dist).'</td>
                </tr>
                <tr>
                    <td>Pincode</td>
                    <td >'.strtoupper($b_pincode).'</td>
                </tr>
                <tr>
                    <td>Mobile No</td>
                    <td>'.strtoupper($b_mobile_no).'</td>
                </tr>
                
                <tr>
                    <td>Email Id</td>
                    <td>'.$b_email.'</td>
                </tr>
                </table>
            </td>
        </tr>
		<tr>
			<td colspan="2">3. Nodal Officer & designation(Officer authorised by the local body or agency responsible for operation of processing/ treatment  or disposal facility) </td>
		</tr>
		 <tr>
  		     <td>Name :</td>
             <td>'.strtoupper($nodal_off_name).'</td>
        </tr>
        <tr>
             <td>Designation :</td>
             <td>'.strtoupper($nodal_off_desig).'</td>
  	    </tr>
		<tr>
			<td>4. Authorisation required for setting up and operation of the facility.</td>
			<td>' . $auth_req_values . '</td>
		</tr>
		<tr>
			<td colspan="2">5. Processing/recycling/treatment of solid waste</td>
		</tr>
		<tr>
			<td colspan="2">(i) Total quantity of waste to be processed per day</td>
		</tr>
		<tr>
             <td>Quantity of waste to be recycled :</td>
             <td>'.strtoupper($quantity_q1).'</td>
  	    </tr>
		<tr>
             <td>Quantity of waste to be treated :</td>
             <td>'.strtoupper($quantity_q2).'</td>
  	    </tr>
		<tr>
             <td>Quantity of waste to be disposed into landfill :</td>
             <td>'.strtoupper($quantity_q3).'</td>
  	    </tr>
		<tr>
             <td>(ii) Utilisation programme for waste processed (Product utilisation) :</td>
             <td>'.strtoupper($product).'</td>
  	    </tr>
		<tr>
             <td>(iii) Measures to be taken for prevention and control of environmental pollution :</td>
             <td>'.strtoupper($measure_a).'</td>
  	    </tr>
		<tr>
             <td>(iv) Measures to be taken for safety of workers working in the plant :</td>
             <td>'.strtoupper($measure_b).'</td>
  	    </tr>
		<tr>
			<td colspan="2">6. Disposal of solid waste</td>
		</tr>
		<tr>
             <td>Number of sites identified :</td>
             <td>'.strtoupper($disposal_a).'</td>
  	    </tr>
		<tr>
             <td>Quantity of waste to be disposed per day :</td>
             <td>'.strtoupper($disposal_b).'</td>
  	    </tr>
		<tr>
             <td>Details of existing site under operation :</td>
             <td>'.strtoupper($disposal_c).'</td>
  	    </tr>
		<tr>
             <td>Methodology and operational details of landfilling :</td>
             <td>'.strtoupper($disposal_d).'</td>
  	    </tr>
		<tr>
             <td>Measures taken to check environmental pollution :</td>
             <td>'.strtoupper($disposal_e).'</td>
  	    </tr>
		<tr>
             <td>7. Any other information :</td>
             <td>'.strtoupper($add_info).'</td>
  	    </tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'  
          
  	 <tr>  		
  		<td valign="top">Place :<b>'.strtoupper($dist).'</b><br/>
  		Date : <b>'.strtoupper($results["sub_date"]).'</b></td>
  		<br/>
  		<td align="right" ><b>'.strtoupper($key_person).'</b><br/>Signature of the Authorized person</td>
    </tr>
    </table>
  	';
?>
