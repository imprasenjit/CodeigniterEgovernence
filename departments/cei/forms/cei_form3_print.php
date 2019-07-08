<?php 
$dept="cei";
$form="3";
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
		########## Part A ###############
		$use_of_building=$results['use_of_building'];
		$builder_name=$results["builder_name"];
		$owner_name=$results["owner_name"];
		if(!empty($results["builder_address"])){
			$builder_address=json_decode($results["builder_address"]);
			$builder_address_sn1=$builder_address->sn1;$builder_address_sn2=$builder_address->sn2;$builder_address_vt=$builder_address->vt;$builder_address_d=$builder_address->d;$builder_address_p=$builder_address->p;$builder_address_m_no=$builder_address->m_no;$builder_address_p_no=$builder_address->p_no;
		}else{
			$builder_address_sn1="";$builder_address_sn2="";$builder_address_vt="";$builder_address_d="";$builder_address_p="";$builder_address_m_no="";$builder_address_p_no="";
		}	
		if(!empty($results["owner_address"])){
			$owner_address=json_decode($results["owner_address"]);
			$owner_address_sn1=$owner_address->sn1;$owner_address_sn2=$owner_address->sn2;$owner_address_vt=$owner_address->vt;$owner_address_d=$owner_address->d;$owner_address_p=$owner_address->p;$owner_address_m_no=$owner_address->m_no;$owner_address_p_no=$owner_address->p_no;
		}else{
			$owner_address_sn1="";$owner_address_sn2="";$owner_address_vt="";$owner_address_d="";$owner_address_p="";$owner_address_m_no="";$owner_address_p_no="";
		}	
		if(!empty($results["mb_address"]))
		{
			$mb_address=json_decode($results["mb_address"]);
			$mb_address_sn1=$mb_address->sn1;$mb_address_sn2=$mb_address->sn2;$mb_address_vt=$mb_address->vt;$mb_address_d=$mb_address->d;$mb_address_p=$mb_address->p;$mb_address_m_no=$mb_address->m_no;$mb_address_p_no=$mb_address->p_no;
		}else{
			$mb_address_sn1="";$mb_address_sn2="";$mb_address_vt="";$mb_address_d="";$mb_address_p="";$mb_address_m_no="";$mb_address_p_no="";
		}	
		if(!empty($results["particular"]))
		{
			$particular=json_decode($results["particular"]);
			$particular_area=$particular->area;;$particular_no=$particular->no;$particular_tot_floor=$particular->tot_floor;$particular_tot_height=$particular->tot_height;$particular_type=$particular->type;
		}else{
			$particular_area="";$particular_no="";$particular_tot_floor="";$particular_tot_height="";$particular_type="";
		}	
		########## Part B ###############
		$is_applied=$results["is_applied"];
		if(!empty($results["elect_inst"]))
		{
			$elect_inst=json_decode($results["elect_inst"]);
			$elect_inst_cables=$elect_inst->cables;	
			$elect_inst_cables_flr=$elect_inst_cables->flr;$elect_inst_cables_pipes=$elect_inst_cables->pipes;	$elect_inst_building=$elect_inst->building;$elect_inst_type=$elect_inst->type;$elect_inst_devices=$elect_inst->devices;$elect_inst_vol_sup=$elect_inst->vol_sup;
		}else{
			$elect_inst_cables_flr="";$elect_inst_cables_pipes=""; 
			$elect_inst_building="";$elect_inst_devices="";$elect_inst_type="";$elect_inst_vol_sup="";
		}
		if(!empty($results["control_room"]))
		{
			$control_room=json_decode($results["control_room"]);
			$control_room_constt=$control_room->constt;$control_room_door=$control_room->door;$control_room_equip=$control_room->equip;$control_room_size=$control_room->size;
		}else{
			$control_room_constt="";$control_room_door="";$control_room_equip="";$control_room_size="";
		}
		########## Part C ###############
		$name_contractor=$results["name_contractor"];
		$is_generator=$results["is_generator"];$is_generator_plan=$results["is_generator_plan"];$is_generator_plan1=$results["is_generator_plan1"];$is_generator_plan2=$results["is_generator_plan2"];
		if(!empty($results["contractor_address"]))
		{
			$contractor_address=json_decode($results["contractor_address"]);
			$contractor_address_sn1=$contractor_address->sn1;$contractor_address_sn2=$contractor_address->sn2;$contractor_address_vt=$contractor_address->vt;$contractor_address_d=$contractor_address->d;$contractor_address_p=$contractor_address->p;$contractor_address_mob=$contractor_address->mob;$contractor_address_cert_no=$contractor_address->cert_no;$contractor_address_compet=$contractor_address->compet;$contractor_address_super=$contractor_address->super;$contractor_address_lic_no=$contractor_address->lic_no;$contractor_address_valid=$contractor_address->valid;
		}else{
			$contractor_address_sn1="";$contractor_address_sn2="";$contractor_address_vt="";$contractor_address_d="";$contractor_address_p="";$contractor_address_mob="";$contractor_address_cert_no="";$contractor_address_compet="";$contractor_address_super="";$contractor_address_valid="";$contractor_address_lic_no="";
		}
		$is_generator=($is_generator=="Y")?'YES':'NO';
		$is_generator_plan=($is_generator_plan=="Y")?'YES':'NO';
		$is_generator_plan1=($is_generator_plan1=="Y")?'YES':'NO';
		$is_generator_plan2=($is_generator_plan2=="Y")?'YES':'NO';
		$is_applied=($is_applied=="Y")?'YES':'NO';
      
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
						<td colspan="2">To<br/>
					       The Chief Electrical Inspector-cum-Adviser, Assam,<br/>Guwahati- 781003.<br/>
						(Through the Senior Electrical Inspector, Zone -  '.strtoupper($dist).',Govt. of Assam)</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;I/We propose to apply to the supplier (i.e. APDCL/DISCOM) for commencement of supply of Electricity to the Multistoried Buildings (of height more than 15 Meters) particulars of which given below. I/We hereby request you to accord necessary approval as required under Regulation 36 of the Central Electricity Authority (measures relating to safety & electric supply) Regulations, 2010). The particulars of the Building and Electrical Installation of the Building furnished below:-</td>
					</tr>
				
  		<tr>  				
			<td valign="top">1.(a) Name of applicant:</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top">(b) Occupation/designation/status:</td>
			<td>'.strtoupper($status_applicant).'</td>
		</tr>
  	<tr>
    	<td valign="top">(c) Full Postal Address & Phone No.:</td>
    	<td style="width:50%">
    	<table class="table table-bordered table-responsive">
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
  		<td valign="top">2. Builder of the multistoried building with postal address and details of the owner(s).(Details to be furnished in a separate sheet):</td>
  		<td>Builder address:
		<table class="table table-bordered table-responsive">
      		<tr>
				<td>Builder&apos;s Name</td>
				<td>'.strtoupper($builder_name).'</td>
			</tr>
			<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($builder_address_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($builder_address_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($builder_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($builder_address_d).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($builder_address_p).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($builder_address_m_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($builder_address_p_no).'</td>
      		</tr>
    		</table>
			Owner address:
		<table class="table table-bordered table-responsive">
      		<tr>
				<td>Owner&apos;s Name</td>
				<td>'.strtoupper($owner_name).'</td>
			</tr>
			<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($owner_address_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($owner_address_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($owner_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($owner_address_d).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($owner_address_p).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($owner_address_m_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($owner_address_p_no).'</td>
      		</tr>
    		</table>
		</td>
  	</tr>
  	<tr>
  		<td valign="top">3. Location of the multistoried building with full postal address of the premise :</td>
  		<td valign="top">
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($mb_address_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($mb_address_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($mb_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($mb_address_d).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($mb_address_p).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($mb_address_m_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($mb_address_p_no).'</td>
      		</tr>
    		</table></td>
  	</tr>
	<tr>
		<td colspan="2">4. Particulars of the Building:</td>
	</tr>
	<tr>
		<td>4.1 Type</td>
		<td>'.strtoupper($particular_type).'</td>
	</tr>
	<tr>
		<td>4.2 Area per floor</td>
		<td>'.strtoupper($particular_area).'</td>
	</tr>
	<tr>
		<td>4.3 Numbers of stories</td>
		<td>'.strtoupper($particular_no).'</td>
	</tr>
	<tr>
		<td>4.4 Total floor area</td>
		<td>'.strtoupper($particular_tot_floor).'</td>
	</tr>
	<tr>
		<td>4.5 Total height of the Building from ground level</td>
		<td>'.strtoupper($particular_tot_height).'</td>
	</tr>
	<tr>
		<td>4.6 Certified copy of approved drawing and NOC to construct the building and completion certificate to be enclosed.</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>5. Purpose of use of the building :</td>
		<td>'.strtoupper($use_of_building).'</td>
	</tr>
	<tr>
		<td colspan="2">6. Particulars of Electrical Installation</td>
	</tr>
	<tr>
		<td>6.1 Voltage of supply :</td>
		<td>'.strtoupper($elect_inst_vol_sup).'</td>
	</tr>
	<tr>
		<td>6.2 Connected load with break up of lighting, powers and others type of load in annexed sheet. :</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>6.3 Distribution System details:<br/>(A single line diagram clearly indicating all devices, controls, connection, with all ratings and specification to be furnished. Load in each sub-circuit to be shown. In case of individual flats/ units having similar connections and electrical loads, details of one unit of each type only need to be furnished).</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>6.4 Type of wiring :</td>
		<td>'.strtoupper($elect_inst_type).'</td>
	</tr>
	<tr>
		<td colspan="2">6.5 Method of drawing cables and type of ducts used for electrical cables. :</td>
	</tr>
	<tr>
		<td>6.5.1 Whether any other pipes/cable laid in the same duct used for electrical cables? </td>
		<td>'.strtoupper($elect_inst_cables_pipes).'</td>
	</tr>
	<tr>
		<td>6.5.2 Have adequate fire barriers provided which crossing the floors by cables? Give details</td>
		<td>'.strtoupper($elect_inst_cables_flr).'</td>
	</tr>
	<tr>
		<td>6.6 Type, size, make and specification of different wires/cables used in the building (details may be furnished as an Annexure)</td>
		<td>'.strtoupper($elect_inst_building).'</td>
	</tr>
	
	<tr>
		<td>6.7 Type, size, specification and make of major control devices used(details may be furnished as an Annexure)</td>
		<td>'.strtoupper($elect_inst_devices).'</td>
	</tr>
	
	<tr>
		<td>6.8 Connected/ sanctioned/applied Loads. Has the APDCL/DISCOM sanctioned electrical load for the building. If yes, a copy of the same to be furnished.</td>
		<td>'.strtoupper($is_applied).' </td>
	</tr>
	
	<tr>
		<td colspan="2">7. Lay out Plan </td>
	</tr>
	<tr>
		<td>7.1 Physical layout plan indicating the position of the transformer, panels, generator, route of all OH line/cables with dimensions/clearances. </td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>7.2 Position of Main Control Room/Breakers/MCCBs/MCB, DB & electrical cable ducts and layout of main cable(s). </td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td colspan="2">8. Details of the main control room </td>
	</tr>
	<tr>
		<td>8.1 Size</td>
		<td>'.strtoupper($control_room_size).' </td>
	</tr>
	<tr>
		<td>8.2 Construction</td>
		<td>'.strtoupper($control_room_constt).' </td>
	</tr>
	<tr>
		<td>8.3 Construction of doors and windows</td>
		<td>'.strtoupper($control_room_door).' </td>
	</tr>
	<tr>
		<td>8.4 A layout of equipment and devices in the control room may be furnished with all distances and clearances.</td>
		<td>'.strtoupper($control_room_equip).' </td>
	</tr>
	<tr>
		<td colspan="2">9. Details of main panel(s) </td>
	</tr>
	<tr>
		<td>9.1 A single line diagram of the main panel(s) indicating all connections and control/protective and metering equipment/devices with ratings and specifications.</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>9.2 A front view of the panel(s) indicating all equipment/devices.</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>9.3 A Test Report of the panel duly signed by the Electrical Supervisor of the manufacturer who has manufactured the electrical panel(s).</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>10. Details of earthing (A layout of earthing of the main panel and other equipment to be furnished in the diagram required under 7.4 above.)</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>11.(a) Has any generator been installed?</td>
		<td>'.strtoupper($is_generator).' </td>
	</tr>
	<tr>
		<td>(b) If no, any plan to install a generator?</td>
		<td>'.strtoupper($is_generator_plan).' </td>
	</tr>
	<tr>
		<td>12.(a) Has any lift been installed?</td>
		<td>'.strtoupper($is_generator_plan1).' </td>
	</tr>
	<tr>
		<td>(b) If no, any plan to install a lift?In case a lift is installed or being installed, separate application to be submitted as per lift Acts & rules of Assam.</td>
		<td>'.strtoupper($is_generator_plan2).' </td>
	</tr>
	
	<tr>
		<td>13. Has lightning protection been provided:?Detailed diagram of lightening protection to be provided separately.</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>14. Furnish details of fire protection/fire alarm system provided. NOC of state fire department to be furnished.</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td>15. Testing <br/>A detailed test report with circuit wise insulation resistance and details of earth resistance test to be furnished. (Separately for each section, each panel and each unit/conductor).</td>
		<td>Uploaded</td>
	</tr>
	<tr>
		<td colspan="2">16. The Electrical wiring and installation works carried out by</td>
	</tr>
	<tr>
		<td>Name of Electrical Contractor</td>
		<td>'.strtoupper($name_contractor).' </td>
	</tr>
	<tr>
		<td>Address</td>
		<td><table class="table table-bordered table-responsive">
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($contractor_address_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($contractor_address_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($contractor_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($contractor_address_d).'</td>
      		</tr>
      		<tr>
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($contractor_address_p).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($contractor_address_mob).'</td>
      		</tr>
    		</table></td>
	</tr>
	<tr>
		<td>License No. and Class :</td>
		<td>'.strtoupper($contractor_address_lic_no).'</td>
	</tr>
	<tr>
		<td>Valid upto :</td>
		<td>'.strtoupper($contractor_address_valid).'</td>
	</tr>
	<tr>
		<td>Name of Electrical Supervisor:</td>
		<td>'.strtoupper($contractor_address_super).'</td>
	</tr>
	<tr>
		<td>Certificate No. :</td>
		<td>'.strtoupper($contractor_address_cert_no).'</td>
	</tr>
	<tr>
		<td>Details of competency (Parts qualified):</td>
		<td>'.strtoupper($contractor_address_compet).'</td>
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
    </tbody>
</table>';
?>