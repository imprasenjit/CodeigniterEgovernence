<?php
$dept="fcs";
$form="1";
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
		$form_id=$results["form_id"];
		$father_name=$results["father_name"];$age=$results["age"];$caste=$results["caste"];$business_p_s=$results["business_p_s"];$name_lic=$results["name_lic"];$is_lic_prev=$results["is_lic_prev"];$trading=$results["trading"];$stocks=$results["stocks"];$suspension=$results["suspension"];
			if(!empty($results["licence"])){
				$licence=json_decode($results["licence"]);
				$licence_name=$licence->name;$licence_number=$licence->number;
			}else{				
				$licence_name="";$licence_number="";
			}				
			if(!empty($results["address"])){
				$address=json_decode($results["address"]);
				$address_s1=$address->s1;$address_s2=$address->s2;$address_d=$address->d;$address_p=$address->p;
			}else{				
				$address_s1="";$address_s2="";$address_d="";$address_p="";
			}	
		if($results["is_lic_prev"]=="Y"){
			$is_lic_prev="YES";
		}else{
			$is_lic_prev="NO";
			$licence_name="N/A";
			$licence_number="N/A";
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
  			'.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	    <tr>
            <td colspan="2">
                <p>TO</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Licensing Authority<br/><br/></p>
			</td>
		</tr>
  	    <tr>
            <td colspan="2">
				<p>Sir,</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby apply for the grant of license under the Assam Public Distribution Articles Order 1982. The required particulars are given here under:<br/><br/></p>
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top">1. Applicants particulars :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Name </td>
						<td >'.strtoupper($key_person).'</td>
					</tr>
					<tr>
						<td>S/O </td>
						<td>'.strtoupper($father_name).'</td>
					</tr>
					<tr>
						<td>Age </td>
						<td>'.strtoupper($age).'</td>
					</tr>
					<tr>
						<td>Caste </td>
						<td>'.strtoupper($caste).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">2. Residential address of the applicant  :</td>
			<td>
				<table class="table table-bordered table-responsive">
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
				<td>3. Name/Style which licence is required </td>		
				<td>'.strtoupper($name_lic).'</td>		
		</tr>   
		<tr>
				<td valign="top" >4. Situation of applications place of business  :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">a) House/ Shop No </td>
						<td >'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>b) Market </td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>c) Village/ Town </td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>d) P/S </td>
						<td>'.strtoupper($business_p_s).'</td>
					</tr>
				</table></td>
		</tr>
		<tr>
				<td colspan="2">5. Name of partners, if any of the firm:
				<table class="table table-bordered table-responsive">
						<tr>
							<th width="10%">Sl No.</th>
							<th width="20%">Name</th>
							<th width="20%">Fathers Name</th>
							<th width="10%">Age</th>
							<th width="10%">Address</th>
							<th width="20%">Contact No</th>
						</tr>';
						$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
						$sl=1;
						while($rows=$results1->fetch_object()){
							$printContents=$printContents.'
							<tr>
								<td>'.$sl.'</td>
								<td>'.strtoupper($rows->name).'</td>
								<td>'.strtoupper($rows->fat_name).'</td>
								<td>'.strtoupper($rows->age).'</td>
								<td>'.strtoupper($rows->address).'</td>
								<td>'.strtoupper($rows->contact).'</td>
							</tr>';
							$sl++;
						}
						$printContents=$printContents.'
				</table></td>
		</tr> 
		<tr>
				<td colspan="2">6. Particulars of trade articles in which the applicant wants to carry on business as a :
				<table class="table table-bordered table-responsive">
			<tr align="center" >
				<th width="5%" align="center">Slno</th>
				<th width="25%" align="center">As a wholesaler</th>
				<th width="20%" align="center">As a Importer</th>
				<th width="25%" align="center"> As a Retailer</th>
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["wholesaler"]).'</td>
						<td>'.strtoupper($row_1["impoter"]).'</td>
						<td>'.strtoupper($row_1["retailer"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> </td>
		</tr>
		<tr>
				<td>7. Did the applicants previously held a license appointment on appointment retailed for which license has now been applied for, if so given details of previous appointment. :</td>
				<td>'.strtoupper($is_lic_prev).' <br/>
				i) Name of trade articles (s) : '.strtoupper($licence_name).'<br/>
				ii)  Licence no : '.strtoupper($licence_number).'
				</td>
		</tr>
		<tr>
				<td>8. How long has the applicants been trading in the trade Articles for which the license has been applied for? :</td>
				<td>'.strtoupper($trading).' </td>
		</tr>
		<tr>
				<td>9. Particulars regarding stocks of Trade Articles in possession on date or application.  :</td>
				<td>'.strtoupper($stocks).'</td>
		</tr>
		<tr>
				<td>10. Particulars of suspension of cancellation of the appointment as a Retailer and under the Assam Food Staff (Distribution Control) Order 1982 during the last 3 years. :</td>
				<td>'.strtoupper($suspension).'</td>
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