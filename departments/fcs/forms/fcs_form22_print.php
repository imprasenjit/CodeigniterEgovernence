<?php
$dept="fcs";
$form="22";
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
		$form_id=$results["form_id"];$auth_address=$results["auth_address"];$license_no=$results["license_no"];$expiry_date=$results["expiry_date"];$license_stands=$results["license_stands"];$renewal_desired=$results["renewal_desired"];$details_action=$results["details_action"];
        if(!empty($results["address"])){
            $address=json_decode($results["address"]);
            $address_s1=$address->s1;$address_s2=$address->s2;$address_d=$address->d;$address_p=$address->p;
        }else{				
            $address_s1="";$address_s2="";$address_d="";$address_p="";
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
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	    <tr>
            <td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td colspan="2">
						<p>To</p>
							<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Licensing Authority</b></p>
						<br/>
						<p>Sir,</p>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, hereby apply for renewal of my license no. <b>'.strtoupper($license_no).'</b>&nbsp; issued under the Assam Trade Article (Licensing &amp; Control) Order, 1982. The required Particulars are given hereunder -<br/><br/></p>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td valign="top">1. Date on which the license expired</td>
			<td>'.strtoupper($expiry_date).'</td>
		</tr>
		<tr>
			<td valign="top">2. Name in which license stands</td>
			<td >'.strtoupper($license_stands).'</td>
		</tr>
		<tr>
			<td>3. For how many years the renewal is desired</td>	
			<td>'.strtoupper($renewal_desired).'</td>				
		</tr>   
		<tr>
			<td>4. Details of the action, if any taken against the last three years for contravention of an order issued under Essential Commodities Act 1955</td>
			<td>'.strtoupper($details_action).'</td>
		</tr>
		<tr>
				<td colspan="2">5. Particulars of trade articles in which the applicant wants to carry on business as a 
				<table class="table table-bordered table-responsive">
                    <tr>
                        <th>Slno</th>
                        <th>As a wholesaler</th>
                        <th>As a Importer</th>
                        <th> As a Retailer</th>
                    </tr>';
                    
                    $part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
                    while($row_1=$part1->fetch_array()){
                    $printContents=$printContents.'
                    <tr>
                            <td>'.strtoupper($row_1["slno"]).'</td>
                            <td>'.strtoupper($row_1["wholesaler"]).'</td>
                            <td>'.strtoupper($row_1["impoter"]).'</td>
                            <td>'.strtoupper($row_1["retailer"]).'</td>
                    </tr>';
                    }$printContents=$printContents.'
                </table> </td>
		</tr>
		<tr>
        <td>6. Complete address (with House no. market etc.) of godowns or place where trade articles for which licence has been applied will be stored </td>
				<td>a) Village/ Town : '.strtoupper($address_s1).'<br/>
				b) P.S : '.strtoupper($address_s2).'<br/>
				c) District : '.strtoupper($address_d).'<br/>
				d) Pincode : '.strtoupper($address_p).'<br/>
				</td>
		</tr>
		<tr>
			<td colspan="2">I, <b>'.strtoupper($key_person).'</b> hereby declare that the particulars mentioned are correct to the best of my knowledge and nothing has been cancelled there in.</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td>Signature of Proprietor/Partner <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>	
	</table>
	';
?>