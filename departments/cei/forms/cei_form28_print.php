<?php 
$dept="cei";
$form="28";
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
		$manager_name=$results['manager_name'];$location_details=$results['location_details'];$is_apdcl=$results['is_apdcl'];$connected_load=$results['connected_load'];$sanction_load=$results['sanction_load'];$name_authority=$results['name_authority'];$sanction_dt=$results['sanction_dt'];$ref_sanction=$results['ref_sanction'];$sub_division=$results['sub_division'];$e_division=$results['e_division'];$proposed_load=$results['proposed_load'];$interlock_changeover=$results['interlock_changeover'];$isolated_mode=$results['isolated_mode'];$protection_generator=$results['protection_generator'];$designation_competency=$results['designation_competency'];$is_installation=$results['is_installation'];	$is_installation_details=$results['is_installation_details'];$contractor_person=$results['contractor_person'];
		
		if(!empty($results["generator"]))
		{
			$generator=json_decode($results["generator"]);
			$generator_m=$generator->m;$generator_l=$generator->l;
		}else{
			$generator_m="";$generator_l="";
		}
		if(!empty($results["other_speci"])){
			$other_speci=json_decode($results["other_speci"]);
			if(isset($other_speci->a)) $other_speci_a=$other_speci->a; else $other_speci_a="";
			if(isset($other_speci->b)) $other_speci_b=$other_speci->b; else $other_speci_b="";
			if(isset($other_speci->c)) $other_speci_c=$other_speci->c; else $other_speci_c="";
			
		}else{
			$other_speci_a="";$other_speci_b="";$other_speci_c="";
			 
		}
         
        $other_speci_values="";		
		if($other_speci_a=="P") $other_speci_values=$other_speci_values. '<span class="tickmark">&#10004;</span>Power Point';
		if($other_speci_b=="R") $other_speci_values=$other_speci_values. '<span class="tickmark">&#10004;</span> Rectifier';
		if($other_speci_c=="F") $other_speci_values=$other_speci_values. '<span class="tickmark">&#10004;</span> Fire alarm';
		 
		if(!empty($results["installation"])){
				$installation=json_decode($results["installation"]);
				$installation_edate=$installation->edate;$installation_cdate=$installation->cdate;$installation_commdate=$installation->commdate;
			}else{
				$installation_edate="";$installation_cdate="";$installation_commdate="";
			}
		
		
		$is_apdcl=($is_apdcl=="Y")?'YES':'NO';
		$is_installation=($is_installation=="Y")?'YES':'NO';
		
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
		</div><br/>
      <table class="table table-bordered table-responsive">
	   <tr>
    	  <td colspan="2">1. Details of the Applicant:</td>
	  </tr>
       <tr>
    	<td valign="top">(b) Full Postal Address & Phone No.:</td>
    	<td style="width:50%">
    	   <table class="table table-bordered table-responsive">
		    <tr>
				<td>Name  :</td>
				<td>'.strtoupper($key_person).'</td>
		   </tr>
		   <tr>
				<td>Manager/Executive or Officer-in-Charge :</td>
				<td>'.strtoupper($manager_name).'</td>
		   </tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($street_name1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($street_name2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($pincode).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($landline_std).'&nbsp;-&nbsp;'.strtoupper($landline_no).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td>'.$email.'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
	<tr>
			<td>Location or the proposed location of D. G. set(s) with full Postal Address </td>
			<td>'.strtoupper($location_details).'</td>
	</tr>
	<tr>
			<td colspan="2">3. Detail of Generator(s)  </td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">			
				<thead>
				<tr>
					<th width="20%">Sl. No.</th>
					<th width="20">Capacity(KW/KVA)</th>
					<th width="20%">Rated Voltage in volts </th>
					<th width="10%">Make and Serial Number</th>
					<th width="10%"></th>
					<th width="20">Make and Serial Number of Generating Set.</th>
				</tr>
				<tr>
					<th width="20%"></th>
					<th width="20"></th>
					<th width="20%"></th>
					<th width="10%">Alternator</th>
					<th width="10%">Engine</th>
					<th width="20"></th>
				</tr>
				</thead>';					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_2=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_2["sl_no"]).'</td>
							<td>'.strtoupper($row_2["capacity"]).'</td>
							<td>'.strtoupper($row_2["voltage"]).'</td>
							<td>'.strtoupper($row_2["alternator"]).'</td>
							<td>'.strtoupper($row_2["engine"]).'</td>
							<td>'.strtoupper($row_2["serial_no"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		
         <tr>
        			<td>4. Whether supply from APDCL/ Discom is available : </td>
        			<td>'.strtoupper($is_apdcl).'</td>
         </tr>
		';
		 if($is_apdcl=="YES"){
			$printContents=$printContents.'
		
      		<tr>
        		<td>4.1 Total Connected Load : </td>
        		<td>'.strtoupper($connected_load).'</td>
      		</tr>
	    <tr>
		   <td>4.2 Total Sanction Load :</td>
		   <td>'.strtoupper($sanction_load).'</td>
	    </tr>
		<tr>
		<td colspan="2">4.3 Date and reference of sanction(with name of authority which sanctioned) : : </td>
	</tr>
	<tr>
		<td>Name of Authority </td>
		<td>'.strtoupper($name_authority).'</td>
	</tr>
	<tr>
		<td>Date </td>
		<td>'.strtoupper($sanction_dt).'</td>
	</tr>
	<tr>
		<td>Reference of sanction </td>
		<td>'.strtoupper($ref_sanction).'</td>
	</tr>
	<tr>
		<td colspan="2">4.4 Name of Electrical  </td>
	</tr>
	<tr>
		<td>a) Sub-Division </td>
		<td>'.strtoupper($sub_division).'</td>
	</tr>
	<tr>
		<td>b) Division </td>
		<td>'.strtoupper($e_division).'</td>
	</tr>
	<tr>
		<td>4.5 Total proposed load to be supplied from the generator(s)</td>
		<td>'.strtoupper($proposed_load).'</td>
	</tr>
	<tr>
		<td>4.6 Details of interlock/changeover arrangement provided to prevent accidental paralleling of the generator with the supply system of Grid. </td>
		<td>'.strtoupper($interlock_changeover).'</td>
	</tr>';
   }
 $printContents=$printContents.'
	<tr>
		<td colspan="2">5. Details of Load proposed to be supplied from the generator(s) </td>
	</tr>
	<tr>
		<td>5.1 Motor (AC) </td>
		<td>'.strtoupper($generator_m).'</td>
	</tr>
	<tr>
		<td>5.2 Light and Fans </td>
	    <td>'.strtoupper($generator_l).' </td>
	</tr>
	<tr>
		<td>5.3 Other (to be specified) </td>
		<td>'.strtoupper($other_speci_values).' </td>
	</tr>
	<tr>
		<td colspan="2">6. Submit the following Drawings in duplicate   </td>
	</tr>
	<tr>
		<td>6.1 Single Line Diagram of the installation </td>
		<td>Upload later in upload section</td>
	</tr>
	<tr>
		<td>6.2 Physical layout drawing</td>
		<td>Upload later in upload section </td>
	</tr>
	<tr>
		<td>6.3 Earthing arrangement drawing </td>
		<td>Upload later in upload section</td>
	</tr>
	<tr>
		<td colspan="2">Note: In the single line diagram, changeover arrangement/interlock arrangement to avoidaccidental connection of two different sources of supply need to be clearly shown with rating of all devices/equipment.</td>
	</tr>
	<tr>
		<td>7.A Indicate if the generators (in case more then one generator will be installed) will run in parallel or isolated mode. </td>
		<td>'.strtoupper($isolated_mode).' </td>
	</tr>
	<tr>
		<td>7.B Protection used for generator(s) </td>
		<td>'.strtoupper($protection_generator).' </td>
	</tr>
	<tr>
		<td>8.1   Expected date of starting the installation work </td>
		<td>'.strtoupper($installation_edate).' </td>
	</tr>
	<tr>
		<td>8.2 Expected date of completion of work </td>
		<td>'.strtoupper($installation_cdate).' </td>
	</tr>
	<tr>
		<td>8.3 Expected date of commissioning </td>
		<td>'.strtoupper($installation_commdate).' </td>
	</tr>
	<tr>
		 <td colspan="2">In cases installation are already completed detailed test reports will have to be submitted.</td>
    </tr>
	<tr>
			<td>9. Name of the contractor person through which the Electrical works connected with the installation is proposed to be done.</td>
			<td>'.strtoupper($contractor_person).'</td>
	</tr>
	<tr>
			<td>10. Name of the person who will be authorised to operate the generator and electrical system connected to the generator, with designation and competency.</td>
			<td>'.strtoupper($designation_competency).'</td>
	</tr>
	<tr>
			<td>11. Is the matter of installation of Generator intimated to the Supplier ? If so, if any directive/guidelines received from them. </td>
			<td>'.strtoupper($is_installation).' &nbsp; '.strtoupper($is_installation_details).'  </td>
	</tr>
	
	
	';
	
    $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.' 	
        <tr>
			<td> Date :<b> '.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
			<td align="right">	Signature : &nbsp; &nbsp;<b> '.strtoupper($key_person).'</b><br/>
				Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>'.strtoupper($key_person).'</b>
			</td>
        </tr>
</table>';

?>