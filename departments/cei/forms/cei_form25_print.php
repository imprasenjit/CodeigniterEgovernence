<?php 
$dept="cei";
$form="25";
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
		$Voltage=$results["Voltage"];$Location=$results["Location"];$pur_constructed=$results["pur_constructed"];$length=$results["length"];$Quantum=$results["Quantum"];$no_Spans=$results["no_Spans"];$length_Spans=$results["length_Spans"];$max_len_Spans=$results["max_len_Spans"];
	    $Type_conductor=$results["Type_conductor"];$size_conductor=$results["size_conductor"];
		$Type_Support=$results["Type_Support"];$Materials=$results["Materials"];$t_Supports=$results["t_Supports"];
		
		$Type_Cross=$results["Type_Cross"];$Cross_size=$results["Cross_size"];$acr_street=$results["acr_street"];$a_street=$results["a_street"];$Elsewhere=$results["Elsewhere"];$point_from_pt=$results["point_from_pt"];$point_to_pt=$results["point_to_pt"];
		
		   
		if(!empty($results["type_insulator"])){
			$type_insulator=json_decode($results["type_insulator"]);
			if(isset($type_insulator->pin)) $type_insulator_pin=$type_insulator->pin; else $type_insulator_pin="";
			if(isset($type_insulator->disc)) $type_insulator_disc=$type_insulator->disc; else $type_insulator_disc="";
			if(isset($type_insulator->poly)) $type_insulator_poly=$type_insulator->poly; else $type_insulator_poly="";
		}else{
			$type_insulator_pin="";$type_insulator_disc="";$type_insulator_poly="";
		}
		$type_insulator_value="";
		if($type_insulator_pin=="P"){
			$type_insulator_value="Pin";
		}else{			
			$type_insulator_value="";
		}
		if($type_insulator_disc=="D"){
			$type_insulator_value=$type_insulator_value.", Disc";
		}else{			
			$type_insulator_value=$type_insulator_value;
		}
		if($type_insulator_poly=="PY"){
			$type_insulator_value=$type_insulator_value.", Poly";
		}else{			
			$type_insulator_value=$type_insulator_value;
		}
		$type_insulator_value=trim($type_insulator_value,", ");
		  if(!empty($results["clearance"])){
				$clearance=json_decode($results["clearance"]);
				$clearance_a=$clearance->a;$clearance_b=$clearance->b;$clearance_c=$clearance->c;
			}else{				
				$clearance_a="";$clearance_b="";$clearance_c="";
			}	
				
		
		########## Part B ###############
		
		$leak_volt=$results["leak_volt"];$is_cradle_g=$results["is_cradle_g"];$menti_vol=$results["menti_vol"];$h_izontal=$results["h_izontal"];$v_ertical=$results["v_ertical"];$is_h_guard=$results["is_h_guard"];
		$angle_crossing=$results["angle_crossing"];$overhead_line=$results["overhead_line"];
		
		#### Part C #####
		
			$voltage_Insulation=$results["voltage_Insulation"];$type_size_guard=$results["type_size_guard"];$is_continuous=$results["is_continuous"];$intervals_earth_wire=$results["intervals_earth_wire"];$metallic_supports=$results["metallic_supports"];$permanently_earthed=$results["permanently_earthed"];$overhead_line_electricity=$results["overhead_line_electricity"];
		    $Make=$results["Make"];$Specifications=$results["Specifications"];$protection=$results["protection"];$Normal_setting=$results["Normal_setting"];
			
			
	    if(!empty($results["phase_earth"])){
		$pe=json_decode($results["phase_earth"]);
			
		$pe_ea=$pe->ea;$pe_ph=$pe->ph;
		$pe_ea_s1=$pe_ea->s1;$pe_ea_s2=$pe_ea->s2;$pe_ea_s3=$pe_ea->s3;
	    $pe_ph_s1=$pe_ph->s1;$pe_ph_s2=$pe_ph->s2;$pe_ph_s3=$pe_ph->s3;
		}else{
		$pe_ea_s1="";$pe_ea_s2="";$pe_ea_s3="";
		$pe_ph_s1="";$pe_ph_s2="";$pe_ph_s3="";
		}
		########## Part D ###############
		
		$anti_climbing=$results["anti_climbing"];$in_location=$results["in_location"];$gang_switches=$results["gang_switches"];$is_gang_switches=$results["is_gang_switches"];$is_caution=$results["is_caution"];$efficiently_earthed=$results["efficiently_earthed"];$is_isolator=$results["is_isolator"];
		if(!empty($results["lightning"]))
		{
			$lightning=json_decode($results["lightning"]);
			$lightning_a=$lightning->a;$lightning_b=$lightning->b;$lightning_c=$lightning->c;$lightning_d=$lightning->d;$lightning_e=$lightning->e;
		}else{
			$lightning_a="";$lightning_b="";$lightning_c="";$lightning_d="";$lightning_e="";
		}
		
		
		$is_cradle_g=($is_cradle_g=="Y")?'YES':'NO';
		$is_continuous=($is_continuous=="Y")?'YES':'NO';
		$is_h_guard=($is_h_guard=="Y")?'YES':'NO';
		$is_isolator=($is_isolator=="Y")?'YES':'NO';
		$is_caution=($is_caution=="Y")?'YES':'NO';
		$is_gang_switches=($is_gang_switches=="Y")?'YES':'NO';
		
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
    	<td colspan="2">1. This Test Report is to be submitted in duplicate.:</td>
    </tr>
            
    
      		<tr>
        			<td>1.1  Voltage of line :</td>
        			<td>'.strtoupper($Voltage).'</td>
      		</tr>
      		<tr>
        			<td>1.2  Location:</td>
        			<td>'.strtoupper($Location).'</td>
      		</tr>
      		<tr>  				
			       <td>1.3 From (Starting point) To (Termination point) :</td>
			       <td>'.strtoupper($point_from_pt). ' To ' .strtoupper($point_to_pt).'</td>
		    </tr>
      		<tr>
        			<td>1.4 Purpose for which the line is constructed </td>
        			<td>'.strtoupper($pur_constructed).'</td>
      		</tr>
      		<tr>
        			<td>1.5  length of line in kilometer</td>
        			<td>'.strtoupper($length).'</td>
      		</tr>
			
      		<tr>
        			<td>1.6  Quantum of power proposed to be transmitted</td>
        			<td>'.strtoupper($Quantum).'</td>
      		</tr>
    		
    	
    <tr>
  		<td colspan="2">2. Details of Spans of the line :</td>
    </tr>
	
            <tr>
        			<td>2.1 Total No. of Spans </td>
        			<td>'.strtoupper($no_Spans).'</td>
            </tr>
      		<tr>
        			<td>2.2 Average length of Spans </td>
        			<td>'.strtoupper($length_Spans).'</td>
      		</tr>
      		<tr>
        			<td >2.3 Maximum length of Spans </td>
        			<td>'.strtoupper($max_len_Spans).'</td>
      		</tr>
      		<tr>
        			<td colspan="2">3. Type and size of conductor used :</td>
      		</tr>
      		<tr>
        			<td>Type :</td>
        			<td>'.strtoupper($Type_conductor).'</td>
      		</tr>
			<tr>
        			<td>size :</td>
        			<td>'.strtoupper($size_conductor).'</td>
      		</tr>
  	        <tr>
        			<td colspan="2">4. A. Type of Support used and Materials :</td>
      		</tr>
      		<tr>
        			<td>Type of Support :</td>
        			<td>'.strtoupper($Type_Support).'</td>
      		</tr>
			<tr>
        			<td>Materials :</td>
        			<td>'.strtoupper($Materials).'</td>
      		</tr>
	    <tr>
		    <td>B. Total No. of Supports: </td>
		    <td>'.strtoupper($t_Supports).'</td>
	    </tr>
	    <tr>
    	      <td valign="top">5. Type of Insulators used :</td>
    	      <td>'.strtoupper($type_insulator_value).' </td>
  	    </tr>
	    <tr>
  		     <td colspan="2">6. Type of Cross arms used with size :</td>
        </tr>
	
            <tr>
        			<td>Type of Cross </td>
        			<td>'.strtoupper($Type_Cross).'</td>
            </tr>
      		<tr>
        			<td>Size  </td>
        			<td>'.strtoupper($Cross_size).'</td>
      		</tr>
	    <tr>
  		     <td colspan="2">7. Clearance between ground and the lowest conductor (Regulation 58):</td>
        </tr>
	
            <tr>
        			<td>7.1 Across a street </td>
        			<td>'.strtoupper($acr_street).'</td>
            </tr>
      		<tr>
        		<td>7.2 Along a street </td>
        		<td>'.strtoupper($a_street).'</td>
      		</tr>
            <tr>
               <td>7.3 Elsewhere:</td>
               <td>'.strtoupper($Elsewhere).'</td>
            </tr>
	<tr>
		<td colspan="2">8. Clearance from nearby building, if any (Regulations 61) </td>
	</tr>
	<tr>
		<td>8.1 Minimum vertical clearance above highest part of such building :</td>
		<td>'.strtoupper($clearance_a).'</td>
	</tr>
	<tr>
		<td>8.2 Minimum horizontal clearance between nearest conductor & any part of such building. :</td>
		<td>'.strtoupper($clearance_b).'</td>
	</tr>
	<tr>
		<td>8.3 If proper guarding provided in case of 9.1 above :</td>
		<td>'.strtoupper($clearance_c).'</td>
	</tr>
	<tr>
		<td>9. Where conductors forming parts of system of different voltage are erected on the same support,has adequate provision been made to guard against the danger from the lower voltage system being charged above the normal working voltage by leaking from or contact with higher voltag system ? (Regulation 62) :</td>
		<td>'.strtoupper($leak_volt).'</td>
	</tr>
	<tr>
		<td>9.1 Has Cradle guard been provided ?</td>
		<td>'.strtoupper($is_cradle_g).'</td>
	</tr>
	<tr>
		<td colspan="2">10. Where overhead lines cross or are in proximity of each other, have they been suitably protected to guard against possibility of their coming into contact with each other (Regulation 69) :</td>
	</tr>
	<tr>
		<td>10.1 Mention the voltage of the other line in the vicinity</td>
		<td>'.strtoupper($menti_vol).'</td>
	</tr>
	<tr>
		<td colspan="2">10.2 What are the minimum clearance between such lines :</td>
	</tr>
	<tr>
		<td>(a) Horizontal</td>
	    <td>'.strtoupper($h_izontal).' </td>
	</tr>
	<tr>
		<td>(b)Vertical.</td>
		<td>'.strtoupper($v_ertical).' </td>
	</tr>
	<tr>
		<td>10.3 Has guard been provided :  </td>
		<td>'.strtoupper($is_h_guard).' </td>
	</tr>
	<tr>
		<td>10.4 In case two lines are crossing, what is the angle of crossing. : </td>
		<td>'.strtoupper($angle_crossing).' </td>
	</tr>
	<tr>
		<td>11. Where an overhead line is crossing or is in the proximity of any telecommunication line, has theoverhead line is protected in the manner laid down in the code of practice of power and telecommuni-cation co-ordination committee (Regulation 69) </td>
		<td>'.strtoupper($overhead_line).' </td>
	</tr>
  <tr>
    <td colspan="2">12. Insulation resistance of the line. :<br/><br/>
      <table class="table table-bordered table-responsive">
        
        <tr>
          <td style="width:200px;"></td>
          <td align="center">(a)</td>
          <td align="center">(b)</td>
          <td align="center">(c)</td>
        </tr>
        <tr>
          <td>12.1 Phase to earth</td>
          <td>'.strtoupper($pe_ea_s1).'</td>
          <td>'.strtoupper($pe_ea_s2).'</td>
          <td>'.strtoupper($pe_ea_s3).'</td>
        </tr>
        <tr>
          <td>12.2 Phase to phase </td>
          <td>'.strtoupper($pe_ph_s1).'</td>
          <td>'.strtoupper($pe_ph_s2).'</td>
          <td>'.strtoupper($pe_ph_s3).'</td>
		 </tr>
        </table>
      
      </td>
      
    </tr>
	<tr>
		<td>12.3 Mention voltage of Insulation Tester used.</td>
		<td>'.strtoupper($voltage_Insulation).' </td>
	</tr>
	<tr>
		<td>13. What is the type & size of guard wire used? (Details of earthing is to be furnished in the Annexure - I).</td>
		<td>'.strtoupper($type_size_guard).' </td>
	</tr>
	<tr>
		<td colspan="2">14. If all the supports of overhead line and metallic fittings attached thereto are permanently & efficiently earthed (Regulation 72) :</td>
	</tr>
	<tr>
		<td>14.1  Is continuous earth wire provided :.</td>
		<td>'.strtoupper($is_continuous).' </td>
	</tr>
	<tr>
		<td>14.2  If so at what intervals earth wire is earthed :</td>
		<td>'.strtoupper($intervals_earth_wire).' </td>
	</tr>
	<tr>
		<td>14.3 If no earth wire is used, whether metallic supports of all individual poles are earthed?(Details of earthing is to be furnished in the Annexure): </td>
		<td>'.strtoupper($metallic_supports).' </td>
	</tr>
	<tr>
		<td>15. Are stay wires are permanently earthed (Regulation 72) Mention the minimum height at which guy insulator is used</td>
		<td>'.strtoupper($permanently_earthed).' </td>
	</tr>
	<tr>
  		 <td>16. Has the overhead line been suitably protected with device for rendering the line electricity harmless in case it breaks (Regulation 73) ? And its location.</td>
        <td>'.strtoupper($overhead_line_electricity).'</td>
    </tr>
	
            <tr>
        			<td colspan="2">16.1 Give details of such device used.</td>
            </tr>
      		<tr>
        			<td>(a) Make</td>
        			<td>'.strtoupper($Make).'</td>
      		</tr>
      		<tr>
        			<td>(b)Specifications (Rating)</td>
        			<td>'.strtoupper($Specifications).'</td>
      		</tr>
      		<tr>
        			<td> (d) Normal setting  </td>
        			<td>'.strtoupper($Normal_setting).'</td>
      		</tr>
      		<tr>
        			<td>17. Whether anti-climbing devices have been provided for each support (Regulation 73) ?</td>
        			<td>'.strtoupper($anti_climbing).'</td>
      		</tr>
			<tr>
        			<td colspan="2">18. Has the overhead line been provided with efficient means for diverting electrical surge due to lightning (Regulation 74):</td>
            </tr>
      		<tr>
        			<td>18.1 What type of lightning arrester used & K.A.</td>
        			<td>'.strtoupper($lightning_a).'</td>
      		</tr>
      		<tr>
        			<td>18.2 Location of lightning arrester </td>
        			<td>'.strtoupper($lightning_b).'</td>
      		</tr>
      		<tr>
        			<td> 18.3 Has the lightning arrester been efficiently earthed to an independent electrode/System? </td>
        			<td>'.strtoupper($lightning_c).'</td>
      		</tr>
			<tr>
        			<td>18.4 Number of electrode used for earthing the lightning arrester system (Details of earthing is to be furnished in the Annexure-I  </td>
        			<td>'.strtoupper($lightning_d).'</td>
      		</tr>
			<tr>
        			<td>18.5 Is the lightning arrester earthing system connected to any other earthing system ? </td>
        			<td>'.strtoupper($lightning_e).'</td>
      		</tr>
	<tr>
		<td>19. Has any gang operated switch/isolator been provided any where ?</td>
		<td>'.strtoupper($is_isolator).' </td>
	</tr>
	<tr>
		<td>19.1 Indicate location(s) of the same</td>
		<td>'.strtoupper($in_location).' </td>
	</tr>
	<tr>
		<td>19.2 Mention rating of each gang switches</td>
		<td>'.strtoupper($gang_switches).' </td>
	</tr>
	<tr>
		<td>19.3 Are all gang switches efficiently earthed ? (Details of earthing to be provided in the Annexure -I)</td>
		<td>'.strtoupper($is_gang_switches).' </td>
	</tr>
	<tr>
		<td>19.4 State whether an insulated or efficiently earthed platform for the operator is provided?(Details of earthing, if any, is to be provided in the Annexure-I) </td>
		<td>'.strtoupper($efficiently_earthed).' </td>
	</tr>
	<tr>
		<td>20. Have caution notice boards been provided at each support (Regulations 18) ? </td>
		<td>'.strtoupper($is_caution).' </td>
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