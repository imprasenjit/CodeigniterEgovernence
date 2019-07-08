<?php 
$dept="cei";
$form="26";
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
		$supplier_name=$results["supplier_name"];	
		$name_trans_line=$results["name_trans_line"];$primary_sub_stn=$results["primary_sub_stn"];$secondary_sub_stn=$results["secondary_sub_stn"];$capacity=$results["capacity"];$sub_stn_type=$results["sub_stn_type"];
		if(!empty($results["supplier_address"])){
			$supplier_address=json_decode($results["supplier_address"]);
			$supplier_address_sn1=$supplier_address->sn1;$supplier_address_sn2=$supplier_address->sn2;$supplier_address_vt=$supplier_address->vt;$supplier_address_d=$supplier_address->d;$supplier_address_p=$supplier_address->p;$supplier_address_m_no=$supplier_address->m_no;
		}else{
			$supplier_address_sn1="";$supplier_address_sn2="";$supplier_address_vt="";$supplier_address_d="";$supplier_address_p="";$supplier_address_m_no="";
		}
		if(!empty($results["sub_stn"]))
		{
			$sub_stn=json_decode($results["sub_stn"]);
			$sub_stn_identification=$sub_stn->identification;$sub_stn_name=$sub_stn->name;$sub_stn_purpose=$sub_stn->purpose;$sub_stn_renovat=$sub_stn->renovat;$sub_stn_loc=$sub_stn->loc;$sub_stn_dist=$sub_stn->dist;	$sub_stn_sn1=$sub_stn->sn1;	$sub_stn_sn2=$sub_stn->sn2;$sub_stn_vt=$sub_stn->vt;$sub_stn_p=$sub_stn->p;	$sub_stn_m_no=$sub_stn->m_no;	$sub_stn_p_no=$sub_stn->p_no;			
		}else{			
			$sub_stn_identification="";$sub_stn_name="";$sub_stn_purpose="";$sub_stn_renovat="";
			$sub_stn_loc="";$sub_stn_dist="";$sub_stn_sn1="";$sub_stn_sn2="";$sub_stn_vt="";$sub_stn_p="";
			$sub_stn_m_no="";$sub_stn_p_no="";
			
		}
		########## Part B ###############

		if(!empty($results["specification"]))
		{
			$specification=json_decode($results["specification"]);
            if(isset($specification->type))  $specification_type=$specification->type; else $specification_type=""; 
            if(isset($specification->make))  $specification_make=$specification->make; else $specification_make=""; 
            if(isset($specification->conf))  $specification_conf=$specification->conf; else $specification_conf=""; 
            if(isset($specification->slno))  $specification_slno=$specification->slno; else $specification_slno=""; 
            if(isset($specification->rating))  $specification_rating=$specification->rating; else $specification_rating=""; 
            if(isset($specification->volt_hv))  $specification_volt_hv=$specification->volt_hv; else $specification_volt_hv=""; 
            if(isset($specification->volt_lv))  $specification_volt_lv=$specification->volt_lv; else $specification_volt_lv=""; 
            if(isset($specification->cur_rating_hv))  $specification_cur_rating_hv=$specification->cur_rating_hv; else $specification_cur_rating_hv=""; 
            if(isset($specification->cur_rating_lv))  $specification_cur_rating_lv=$specification->cur_rating_lv; else $specification_cur_rating_lv=""; 
            if(isset($specification->per))  $specification_per=$specification->per; else $specification_per=""; 
            if(isset($specification->tot_cap))  $specification_tot_cap=$specification->tot_cap; else $specification_tot_cap=""; 
            if(isset($specification->strength))  $specification_strength=$specification->strength; else $specification_strength=""; 
            if(isset($specification->strength_at))  $specification_strength_at=$specification->strength_at; else $specification_strength_at=""; 
			
		}else{
			$specification_type="";$specification_make="";$specification_conf="";$specification_slno="";
			$specification_rating="";$specification_volt_hv="";$specification_volt_lv="";$specification_cur_rating_hv="";$specification_cur_rating_lv="";$specification_per="";
			$specification_tot_cap="";$specification_strength="";$specification_strength_at="";
		}
		if(!empty($results["in_test_res"]))
		{
			$in_test_res=json_decode($results["in_test_res"]);
			$in_test_res_a=$in_test_res->a;
			$in_test_res_b=$in_test_res->b;	
			$in_test_res_c=$in_test_res->c;
		}else{
			$in_test_res_a="";$in_test_res_b="";$in_test_res_c="";
		}
		if(!empty($results["cont_test_res"]))
		{
			$cont_test_res=json_decode($results["cont_test_res"]);
			$cont_test_res_b=$cont_test_res->b;	
			$cont_test_res_c=$cont_test_res->c;
			$cont_test_res_d=$cont_test_res->d;	
			$cont_test_res_e=$cont_test_res->e;
		}else{
			$cont_test_res_b="";$cont_test_res_c="";$cont_test_res_d="";$cont_test_res_e="";
		}
		if(!empty($results["insulation"]))
		{
			$insulation=json_decode($results["insulation"]);
			$insulation_volt_rat_high=$insulation->volt_rat_high;$insulation_volt_rat_low=$insulation->volt_rat_low;$insulation_make_high=$insulation->make_high;$insulation_make_low=$insulation->make_low;$insulation_slno_high=$insulation->slno_high;$insulation_slno_low=$insulation->slno_low;
		}else{
			$insulation_volt_rat_high="";$insulation_volt_rat_low="";$insulation_make_high="";		$insulation_make_low="";$insulation_slno_high="";$insulation_slno_low="";		
		}
		########## Part C ###############
		$pad_mounted=$results["pad_mounted"];$fencing_height=$results["fencing_height"];$indoor_sub_stn=$results["indoor_sub_stn"];$sub_stn_filled=$results["sub_stn_filled"];
		$cond_arr=$results["cond_arr"];$l_arrestors=$results["l_arrestors"];
		if(!empty($results["protection"]))
		{
			$protection=json_decode($results["protection"]);
			$protection_HV=$protection->HV;$protection_LV=$protection->LV;
			
		}else{
			$protection_HV="";$protection_LV="";	
		}		
		if(!empty($results["spec"]))
		{
			$spec=json_decode($results["spec"]);
			$spec_HV=$spec->HV;$spec_LV=$spec->LV;
			
		}else{
			$spec_HV="";$spec_LV="";
		}
		
		#### Part D #####
		$type_LA=$results["type_LA"];$pro_earthed=$results["pro_earthed"];									
		$sub_stn_provision=$results["sub_stn_provision"];$sub_stn_equip=$results["sub_stn_equip"];									
		$furnish_det=$results["furnish_det"];									
		$s_provision=$results["s_provision"];									
		$name_person=$results["name_person"];				
		
		if(!empty($results["testing"]))
		{
			$testing=json_decode($results["testing"]);
			$testing_a=$testing->a;$testing_b=$testing->b;$testing_c=$testing->c;
			
		}else{
			$testing_a="";$testing_b="";$testing_c="";
		}
		#### Part D #####
		$type_LA=$results["type_LA"];$pro_earthed=$results["pro_earthed"];									
		$sub_stn_provision=$results["sub_stn_provision"];$sub_stn_equip=$results["sub_stn_equip"];									
		$furnish_det=$results["furnish_det"];									
		$s_provision=$results["s_provision"];									
		$name_person=$results["name_person"];									
		if(!empty($results["testing"]))
		{
			$testing=json_decode($results["testing"]);
			$testing_a=$testing->a;$testing_b=$testing->b;$testing_c=$testing->c;
			
		}else{
			$testing_a="";$testing_b="";$testing_c="";
		}
		
		#### Part E #####
		
		$cond_arr=($cond_arr=="Y")?'YES':'NO';	
		$l_arrestors=($l_arrestors=="Y")?'YES':'NO';	
		
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
			<td colspan="2">
				<table class="table table-bordered table-responsive">
				
				</table>
			</td>
		</tr>
  		<tr>  				
			<td valign="top">1.(a) Name of applicant:</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
	
  	<tr>
    	<td valign="top">(b) Full Postal Address & Phone No.:</td>
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
  		<td valign="top" colspan="2">2. Name and address of supplier :</td>
    </tr>
	<tr>
		<td>Supplier name :</td>
		<td>'.strtoupper($supplier_name).'</td>
	</tr>
	<tr>
    	<td valign="top">Supplier address :</td>
    	<td style="width:50%">
    	<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($supplier_address_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($supplier_address_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($supplier_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($supplier_address_d).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($supplier_address_p).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($supplier_address_m_no).'</td>
      		</tr>
      		
    		</table>
    	</td>
	</tr>
	
  	<tr>
  		<td>3. Name / identification of the transmission line / feeder supplying power to the sub-station / installation :</td>
      	<td>'.strtoupper($name_trans_line).'</td>
  	</tr>
	<tr>
		<td colspan="2">4.1 Voltage of the sub-station :</td>
	</tr>
	<tr>
		<td>Primary(in <b> KV</b>) :</td>
		<td>'.strtoupper($primary_sub_stn).'</td>
		
	</tr>
	<tr>
		<td>Secondary(in <b> KV</b>) :</td>
		<td>'.strtoupper($secondary_sub_stn).'</td>
	</tr>
	<tr>
		<td>4.2 Capacity of Transformer(in <b> KVA/MVA</b>) :</br>(In case more than one transformer and/or equipment are installed a detailed list is required to be submitted in Annexure II B)</td>
		<td>'.strtoupper($capacity).'</td>
	</tr>
	
	<tr>
		<td>5. Type of sub-station, Indoor/Outdoor Platform mounted /Pole mounted etc.(To specify) :</td>
		<td>'.strtoupper($sub_stn_type).'</td>
	</tr>
	<tr>
		<td >6. Identification of the sub-station :</td>
		<td>'.strtoupper($sub_stn_identification).'</td>
	</tr>
	<tr>
		<td>6.1 Name of the Sub-station :</td>
		<td>'.strtoupper($sub_stn_name).'</td>
	</tr>
	<tr>
		<td>6.2 Purpose & type of load to be supplied. :</td>
		<td>'.strtoupper($sub_stn_purpose).'</td>
	</tr>
	<tr>
		<td>6.3 New/ renovation/ augmentation work :</td>
		<td>'.strtoupper($sub_stn_renovat).'</td>
	</tr>
	<tr>
		<td>6.4 Location of the Sub-station :</td>
		<td>'.strtoupper($sub_stn_loc).'</td>
	</tr>
	<tr>
		<td>6.4.1 District :</td>
		<td>'.strtoupper($sub_stn_dist).'</td>
	</tr>
	
	<tr>
    	<td valign="top" >6.4.2 Full address of the Sub-station :</td>
    	<td style="width:50%">
    	<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($sub_stn_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($sub_stn_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($sub_stn_vt).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($sub_stn_p).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($sub_stn_m_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($sub_stn_p_no).'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
	
	<tr>
		<td colspan="2">7. Specification of the transformer : </td>
	</tr>
	<tr>
		<td>7.1 Type :</td>
		<td>'.strtoupper($specification_type).' </td>
	</tr>
	<tr>
		<td>7.2 Make :</td>
		<td>'.strtoupper($specification_make).' </td>
	</tr>
	<tr>
		<td>7.3 Winding configuration :</td>
		<td>'.strtoupper($specification_conf).' </td>
	</tr>
	<tr>
		<td>7.4 Serial number :</td>
		<td>'.strtoupper($specification_slno).' </td>
	</tr>
	<tr>
		<td>7.5 Rating/ Capacity :</td>
		<td>'.strtoupper($specification_rating).' </td>
	</tr>
	<tr>
		<td>7.6 Voltage at no load :</td>
		<td>HV : '.strtoupper($specification_volt_hv).'<br/>
		LV : '.strtoupper($specification_volt_lv).'</td>
	</tr>
	<tr>
		<td>7.7 Current rating :</td>
		<td>HV : '.strtoupper($specification_cur_rating_hv).'<br/>
		LV : '.strtoupper($specification_cur_rating_lv).'</td>
	</tr>
	<tr>
		<td>7.8 Percentage impedance :</td>
		<td>'.strtoupper($specification_per).' </td>
	</tr>
	<tr>
		<td>7.9 Total Oil Capacity :</td>
		<td>'.strtoupper($specification_tot_cap).' </td>
	</tr>
	<tr>
		<td>7.10. Di-electric strength of oil used(in KV) :</td>
		<td>'.strtoupper($specification_strength). ' at(mm gap) ' .strtoupper($specification_strength_at).'</td>
	</tr>
	
	
	<tr>
		<td colspan="2">7.11 Insulation test results</td>
	</tr>
	<tr>
		<td>7.11.1 Between HV&LV :</td>
		<td>'.strtoupper($in_test_res_a).' </td>
	</tr>
	<tr>
		<td>7.11.2 Between HV& Earth :</td>
		<td>'.strtoupper($in_test_res_b).' </td>
	</tr>
	<tr>
		<td>7.11.3 Between LV& Earth :</td>
		<td>'.strtoupper($in_test_res_c).' </td>
	</tr>
	<tr>
		<td colspan="2">7.12 Continuity Test Results (L.V. Side with neutral earth connected) :</td>
	</tr>
	<tr>
		<td>7.12.1 Between Neutral & Earth :</td>
		<td>'.strtoupper($cont_test_res_b).' </td>
	</tr>
	<tr>
		<td>7.12.2 Phase 1 and Earth :</td>
		<td>'.strtoupper($cont_test_res_c).' </td>
	</tr>
	<tr>
		<td>7.12.3 Phase 2 and Earth :</td>
		<td>'.strtoupper($cont_test_res_d).' </td>
	</tr>
	<tr>
		<td>7.12.4 Phase 3 and Earth :</td>
		<td>'.strtoupper($cont_test_res_e).' </td>
	</tr>
	<tr>
		<td >7.13. Details of insulation tester used :</td>
		<td>
		<table class="table table-bordered table-responsive">
			<tr>
				<th colspan="2">High Voltage Test (7.11.1 to 7.11.3)</th>
				<th colspan="2">Low Voltage Test (7.12)</th>
			</tr>
			<tr>
				<td>a)High Voltage rating :</td>
				<td>'.strtoupper($insulation_volt_rat_high).' </td>
				<td>a)Low Voltage rating :</td>
				<td>'.strtoupper($insulation_volt_rat_low).' </td>
			</tr>
			<tr>
				<td>b)High Make :</td>
				<td>'.strtoupper($insulation_make_high).' </td>
				<td>b)Low Make :</td>
				<td>'.strtoupper($insulation_make_low).' </td>
			</tr>
			<tr>
				<td>c)High Serial No :</td>
				<td>'.strtoupper($insulation_slno_high).' </td>
				<td>c)Low Serial No :</td>
				<td>'.strtoupper($insulation_slno_low).' </td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td colspan="2">(Details about each equipment is to be furnished in Annexure II B in case more than one transformer or other equipment are installed)</td>
	</tr>
	<tr>
		<td colspan="2">8. Type of protections used :</td>
	</tr>
	<tr>
		<td>a) HV side :</td>
		<td>'.strtoupper($protection_HV).' </td>
	</tr>
	<tr>
		<td>b) LV side :</td>
		<td>'.strtoupper($protection_LV).' </td>
	</tr>
	<tr><td colspan="2">(In case circuit breakers are used, details should be submitted in Annexure-II A & II B)</td></tr>
	<tr>
		<td colspan="2">9. Size and specification of conductors / cables :</td>
	</tr>
	<tr>
		<td>a) HV side :</td>
		<td>'.strtoupper($spec_HV).' </td>
	</tr>
	<tr>
		<td>b) LV side :</td>
		<td>'.strtoupper($spec_LV).' </td>
	</tr>
	
	<tr>
		<td>10. Indicate type of platform constructed for pad mounted sub-station :</td>
		<td>'.strtoupper($pad_mounted).'</td>
	</tr>
	
	<tr>
		<td>11. Incase of out door Sub-station :</br>(Except pole mounted Sub-station)<br/>Indicate if efficiently protected fencing is used as per Regulation 33 with type and mention the height of the fencing :</td>
		<td>'.strtoupper($fencing_height).' </td>
	</tr>
	<tr>
		<td>12. In case of indoor Sub-station; if proper soak pits are provided for drainage of oil which may leak, to prevent spreading of accidental fire as per provision of Regulation 44.Details of such arrangements, if any :</td>
		<td>'.strtoupper($indoor_sub_stn).' </td>
	</tr>
	<tr>
		<td>13. Mention if cable trench inside the Sub-stations are filled with sand or similar non-inflammable materials or covered with non-flammable slabs. :</td>
		<td>'.strtoupper($sub_stn_filled).' </td>
	</tr>
	<tr>
		<td>14. Are the conductors and apparatus are so arranged that they may be made dead in section and work carried out in each section by authorized person without any danger ?</td>
		<td>'.strtoupper($cond_arr).' </td>
	</tr>
	
	<tr>
		<td>15. Have lightning arrestors been provided ?</td>
		<td>'.strtoupper($l_arrestors).' </td>
	</tr>
	<tr>
		<td>15(a). Type of LA used & K.A.rating :</td>
		<td>'.strtoupper($type_LA).' </td>
	</tr>
	<tr>
		<td>15(b). Have these been properly earthed?</td>
		<td>'.strtoupper($pro_earthed).' </td>
	</tr>
	<tr>
		<td>16. Whether any provision is made to protect the sub-station from direct lightning stroke. If so, furnish details of such protection. :</td>
		<td>'.strtoupper($sub_stn_provision).' </td>
	</tr>
	<tr>
		<td>17. Have all the equipments in the sub-station been earthed as per provision of Regulation 41, 42 & 48 of the CEA Regulations, 2010? Furnish details of earthing in Annexure-I along with drawing showing details of earth electrodes and manner. :</td>
		<td>'.strtoupper($sub_stn_equip).' </td>
	</tr>
	
	<tr>
		<td>18. Furnish details about arrangements made/ equipment provided to control fire in the electrical equipments. :</td>
		<td>'.strtoupper($furnish_det).'</td>
	</tr>
	<tr>
		<td>19. Has suitable provisions been made for immediate and automatic discharge of every static condensers on disconnection as required vide Regulation 51 of the CEA Regulations, 2010. :</td>
		<td>'.strtoupper($s_provision).'</td>
	</tr>
	<tr>
		<td>20. Name of person/ agency that will be responsible for operation and maintenance of the sub-station with authority/competency. :</td>
		<td>'.strtoupper($name_person).'</td>
	</tr>
	<tr>
		<td colspan="2">21. Installation and testing done :<br/>(Cancel item which are not applicable)</td>
	</tr>
	<tr>
		<td>21.1 By the supplier as a departmental work. :</td>
		<td>'.strtoupper($testing_a).'</td>
	</tr>
	<tr>
		<td>21.2 By the Contractor engaged by supplier :</td>
		<td>'.strtoupper($testing_b).'</td>
	</tr>
	<tr>
		<td>21.3 By the Contractor engaged by the owner/consumer/occupier. :</td>
		<td>'.strtoupper($testing_c).'</td>
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