<?php
$dept="pcb";
$form="54";
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
			$contact_person_name=$results['contact_person_name'];
			$contact_person_desig=$results['contact_person_desig'];$details_facilities=$results['details_facilities'];
			
			if(!empty($results["contact_person_add"])){
				$contact_person_add=json_decode($results["contact_person_add"]);
				$contact_person_add_sn1=$contact_person_add->sn1;
				$contact_person_add_sn2=$contact_person_add->sn2;
				$contact_person_add_vill=$contact_person_add->vill;
				$contact_person_add_dist=$contact_person_add->dist;
				$contact_person_add_pin=$contact_person_add->pin;
				$contact_person_add_mno=$contact_person_add->mno;
				$contact_person_add_email=$contact_person_add->email;
			}else{
				$contact_person_add_sn1="";$contact_person_add_sn2="";$contact_person_add_vill="";$contact_person_add_dist="";$contact_person_add_pin="";$contact_person_add_mno="";$contact_person_add_email="";
			}	
			
			if(!empty($results["auth_req"])){
				$auth_req=json_decode($results["auth_req"]);
				if(isset($auth_req->gen))	$auth_req_gen=$auth_req->gen;
				else $auth_req_gen="";
				if(isset($auth_req->col))	$auth_req_col=$auth_req->col;
				else $auth_req_col="";
				if(isset($auth_req->dism))	$auth_req_dism=$auth_req->dism;
				else $auth_req_dism="";
				if(isset($auth_req->rec))	$auth_req_rec=$auth_req->rec;
				else $auth_req_rec="";
			}else{
				$auth_req_gen="";$auth_req_col="";$auth_req_dism="";$auth_req_rec="";
			}	
			if(!empty($results["ew_details"])){
				$ew_details=json_decode($results["ew_details"]);
				$ew_details_qty1=$ew_details->qty1;$ew_details_qty2=$ew_details->qty2;$ew_details_qty3=$ew_details->qty3;$ew_details_qty4=$ew_details->qty4;
			}else{
				$ew_details_qty1="";$ew_details_qty2="";$ew_details_qty3="";$ew_details_qty4="";
			}
			
			if(!empty($results["ren_auth"])){
				$ren_auth=json_decode($results["ren_auth"]);
				$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
				$ren_auth_details=$ren_auth->details;
			}else{
				$ren_auth_no="";$ren_auth_dt="";$ren_auth_details="";
			}	
	}

$form_name=$formFunctions->get_formName($dept,$form);
//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
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
        <h4>'.$form_name.'</h4>
    </div><br/>

    <table class="table table-bordered table-responsive">
	<tr>
        <td valign="top">To
		<br>The Member Secretary,<br/>Pollution Control Board, Assam<br/><u>Bamunimaidam, Guwahati-21.</u>
			<br><br>
			Sir,<br>
            I/we hereby apply for authorization/renewal of authorization under rule 11(2) and 11(6) of the E-wastes (Management and Handling) Rules, 2011 for collection/storage/transport/ treatment/disposal of e-wastes.</td>
	</tr>
	</table>

    <table class="table table-bordered table-responsive">  
    <tr>
        <td valign="top">1. Name and full address, telephone nos. e-mail and other contact details of the unit :</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
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
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).' '.strtoupper($b_landline_no).'</td>
      		</tr>
      		
      		<tr>
        			<td>Email-id</td>
        			<td>'.$b_email.'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
	<tr>
        <td valign="top">2. Contact Person with designation and contact details such as telephone Nos, Fax. No. and E-mail :</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>contact_person_name</td>
        			<td>'.strtoupper($contact_person_name).'</td>
      		</tr>
      		<tr>
        			<td>Designation</td>
        			<td>'.strtoupper($contact_person_desig).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($contact_person_add_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($contact_person_add_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($contact_person_add_vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($contact_person_add_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>+91'.strtoupper($contact_person_add_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile No</td>
        			<td>'.strtoupper($contact_person_add_mno).'</td>
      		</tr>
      		
      		<tr>
        			<td>Email-id</td>
        			<td>'.$contact_person_add_email.'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
	
  	<tr>
    	<td valign="top" style="text-indent:14px">3. Authorization required for (Please tick mark appropriate activity/ies*)
        </td>
    	<td>
            '.strtoupper($auth_req_gen).'<br/>
            '.strtoupper($auth_req_col).'<br/>
            '.strtoupper($auth_req_dism).'<br/>
            '.strtoupper($auth_req_rec).'<br/>
    	</td>
  	</tr>
	<tr>
		<td valign="top">4. E-waste details :</td>
		<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
                    <td>(a) Total quantity e-waste generated in MT/A  :</td>
                    <td>'.strtoupper($ew_details_qty1).'</td>
      		</tr>
      		<tr>
        			<td>(b) Quantity refurbished (applicable to refurbisher) :</td>
        			<td>'.strtoupper($ew_details_qty2).'</td>
      		</tr>
      		<tr>
        			<td>(c) Quantity sent for recycling :</td>
        			<td>'.strtoupper($ew_details_qty3).'</td>
      		</tr>
      		<tr>
        			<td>(d) Quantity sent for disposal :</td>
        			<td>'.strtoupper($ew_details_qty4).'</td>
      		</tr>
      		</table>
    	</td>
	</tr>
	<tr>
        <td>5. Details of Facilities for storage/handling/treatment/refurbishing :</td>
        <td>'.strtoupper($details_facilities).'</td>
    </tr>
	<tr>
		<td colspan="2">6. In case of renewal of authorisation previous authorisation no. and date and details of annual returns :</td>
	</tr>
	<tr>
        <td>Authorization No.</td>
        <td>'.strtoupper($ren_auth_no).'</td>
    </tr>
	<tr>
        <td>Authorization Date </td>
        <td>'.strtoupper($ren_auth_dt).'</td>
    </tr>
	<tr>
        <td>Details of annual returns </td>
        <td>'.strtoupper($ren_auth_details).'</td>
    </tr>
	';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'     
		
		<tr>
            <td>Place: <b>'.strtoupper($dist).'</b><br/> Date : <b>'.strtoupper($results["sub_date"]).'</b></td>
            <td align="right">
                Signature : <b>'.strtoupper($key_person).'</b><br/>
                (Name) : <b>'.strtoupper($key_person).'</b><br/>
                Designation : <b>'.strtoupper($status_applicant).'</b>
			</td>
        </tr>        
   
	</table>';	
?>