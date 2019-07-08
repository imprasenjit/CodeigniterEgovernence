<?php
$dept="clm";
$form="8";
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
		$form_id=$results["form_id"];$details_f_pack=$results['details_f_pack'];$imp_country=$results['imp_country'];
	
		if(!empty($results["warehouse_addr"]))
		{
			$warehouse_addr=json_decode($results["warehouse_addr"]);
			$warehouse_addr_sn1=$warehouse_addr->sn1;$warehouse_addr_sn2=$warehouse_addr->sn2;$warehouse_addr_v=$warehouse_addr->v;$warehouse_addr_d=$warehouse_addr->d;$warehouse_addr_p=$warehouse_addr->p;$warehouse_addr_m=$warehouse_addr->m;$warehouse_addr_e=$warehouse_addr->e;
		}else{
			$warehouse_addr_sn1="";$warehouse_addr_sn2="";$warehouse_addr_v="";$warehouse_addr_d="";$warehouse_addr_p="";$warehouse_addr_m="";$warehouse_addr_e="";
		}
		
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
			<p  style="text-align:center">[Under Rule 27 of the Legal Metrology(Packaged Commodities) Rules,2011]</p>
			<p  style="text-align:center">Importer is an Individual, Company or Firm whose name figures in the bill of Lading/Importer documents as Importer.</p>
		</div>
		<br/>
            <table class="table table-bordered table-responsive">
			<tr>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>To,<br/>The Controller of Legal Metrology, Assam,<br/>
								R.K. Mission Road, Ulubari,<br/>
								Guwahati-781007</td>
						</tr>
					</table>
				</td>
			</tr>
			</table>
			<table class="table table-bordered table-responsive">
                <tr>
					<td width="50%" valign="top">1. Name and address of the Importer:</td>
					<td>
						<table class="table table-bordered table-responsive">
							<tr>
								<td>Full Name </td>
								<td>'.strtoupper($key_person).'</td>
							</tr>
							<tr>
								<td>Street Name 1 </td>
								<td>'.strtoupper($street_name1).'</td>
							</tr>
							<tr>
								<td>Street Name 2 </td>
								<td>'.strtoupper($street_name2).'</td>
							</tr>
							<tr>
								<td>Vilage/Town </td>
								<td>'.strtoupper($vill).'</td>
							</tr>
							<tr>
								<td>District </td>
								<td>'.strtoupper($dist).'</td>
							</tr>
							<tr>
								<td>Pincode </td>
								<td>'.strtoupper($pincode).'</td>
							</tr>
							<tr>
								<td>Mobile No. </td>
								<td>'.strtoupper($mobile_no).'</td>
							</tr>
							<tr>
								<td>E-Mail ID </td>
								<td>'.$email.'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="50%" valign="top">(a)Registered office Address: </td>
					<td>
						<table class="table table-bordered table-responsive">
							<tr>
								<td>Office Name </td>
								<td>'.strtoupper($unit_name).'</td>
							</tr>
							<tr>
								<td>Street Name 1 </td>
								<td>'.strtoupper($b_street_name1).'</td>
							</tr>
							<tr>
								<td>Street Name 2 </td>
								<td>'.strtoupper($b_street_name2).'</td>
							</tr>
							<tr>
								<td>Vilage/Town </td>
								<td>'.strtoupper($b_vill).'</td>
							</tr>
							<tr>
								<td>District </td>
								<td>'.strtoupper($b_dist).'</td>
							</tr>
							<tr>
								<td>Pincode </td>
								<td>'.strtoupper($b_pincode).'</td>
							</tr>
						</table>
					</td>
				</tr>
			
			<tr>
				<td width="50%" valign="top">(b) Address of Warehouse where the goods are imported and kept:</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Street Name 1 </td>
							<td>'.strtoupper($warehouse_addr_sn1).'</td>
						</tr>
						<tr>
							<td>Street Name 2 </td>
							<td>'.strtoupper($warehouse_addr_sn2).'</td>
						</tr>
						<tr>
							<td>Vilage/Town </td>
							<td>'.strtoupper($warehouse_addr_v).'</td>
						</tr>
						<tr>
							<td>District </td>
							<td>'.strtoupper($warehouse_addr_d).'</td>
						</tr>
						<tr>
							<td>Pincode </td>
							<td>'.strtoupper($warehouse_addr_p).'</td>
						</tr>
						<tr>
							<td>Mobile No. </td>
							<td>'.strtoupper($warehouse_addr_m).'</td>
						</tr>
						<tr>
							<td>Email Id</td>
							<td>'.$warehouse_addr_e.'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">2. Name and address of the Director of the firm etc.:</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">
							<tr>
								<td>Sl No.</td>
								<td>Name</td>
								<td>Family Name</td>
								<td>Address</td>
								<td>Pincode</td>
								<td>Contact No</td>
							</tr>';
							$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
								<tr>
									<td>'.$sl.'</td>
									<td>'.strtoupper($rows->name).'</td>
									<td>'.strtoupper($rows->family_name).'</td>
									<td>'.strtoupper($rows->address).'</td>
									<td>'.strtoupper($rows->mem_pincode).'</td>
									<td>'.strtoupper($rows->contact).'</td>
								</tr>';
								$sl++;
							}
							$printContents=$printContents.'
					</table>
				</td>
			</tr>
			<tr>
				<td>3.i) Details of Packaged Commodities being/to be imported: </td>
				<td>'.strtoupper($details_f_pack).'</td>
			</tr>
			<tr>
				<td>ii) Name of the Country from where import is made:</td>
				<td>'.strtoupper($imp_country).'</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><b><u>DECLARATION</u></b></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;&nbsp;&nbsp;&nbspI/WE hereby declare that the package manufactured/packed will comply the various provision of the legal metrology(Packaged Commodities) Rule, 2011.</td>
			</tr>';
			
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 	     
        <tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
			<td align="center">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
        </tr>
</table>';

?>



