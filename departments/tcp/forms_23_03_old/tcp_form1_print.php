<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$tcp->query("select * from tcp_form1 where user_id='$swr_id' and form_id='$form_id'") or die($tcp->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$tcp->query("select * from tcp_form1 where uain='$uain' and user_id='$swr_id'") or die($tcp->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$tcp->query("select * from tcp_form1 where user_id='$swr_id' and form_id='$form_id'") or die($tcp->error);
	}else{
		$q=$tcp->query("select * from tcp_form1 where user_id='$swr_id' and active='1'") or die($tcp->error);
	}

	$email=$formFunctions->get_usermail($swr_id);
  $row1=$row1=$formFunctions->fetch_swr($swr_id);
  
  $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$pan_no=$row1['pan_no'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
  $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$pan_no=$row1['pan_no'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
  $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
  
  $from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
  
  $unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		  $q=$tcp->query("select * from tcp_form1 where user_id='$swr_id' and active='1'") or die($tcp->error);
         $results=$q->fetch_assoc();
		if($q->num_rows>0)
		{			
		$app_cat=$results["app_cat"];$fm_name=$results["fm_name"];$spouse_nm=$results["spouse_nm"];$own_name=$results["own_name"];$j_own_name=$results["j_own_name"];$vill_revenue=$results["vill_revenue"];$locality=$results["locality"];$land_use=$results["land_use"];$road_name=$results["road_name"];$road_width=$results["road_width"];$build_cat=$results["build_cat"];$prop_use=$results["prop_use"];$plot_area=$results["plot_area"];$build_area=$results["build_area"];$con_type=$results["con_type"];$no_of_floor=$results["no_of_floor"];$total_area=$results["total_area"];$b_wall=$results["b_wall"];$length=$results["length"];$height=$results["height"];$is_v_ext=$results["is_v_ext"];$v_no_floor=$results["v_no_floor"];$is_h_ext=$results["is_h_ext"];$h_no_floor=$results["h_no_floor"];$reg_no=$results["reg_no"];$rtp_name=$results["rtp_name"];$tp_mobile_no=$results["tp_mobile_no"];$tp_email=$results["tp_email"];$reg_fees=$results["reg_fees"];
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];
		if($results["app_cat"]=='NB'){
			$app_cat="New Building";
		}elseif($results["app_cat"]=='RE'){
			$app_cat="Re Erect";
		}elseif($results["app_cat"]=='MA'){
			$app_cat="Material Alteration";
		}
		if($is_v_ext=="Y"){
			$is_v_ext="YES";
			$v_no_floor=$results["v_no_floor"];
		}else{
			$is_v_ext="NO";
			$v_no_floor="";
		}
		if($is_h_ext=="Y"){
			$is_h_ext="YES";
			$h_no_floor=$results["h_no_floor"];
		}else{
			$is_h_ext="NO";
			$h_no_floor="";
		}
		if(!empty($results["prop"])){
			$prop=json_decode($results["prop"]);
			$prop_house_no=$prop->house_no;$prop_new_dagno=$prop->new_dagno;$prop_old_dagno=$prop->old_dagno;$prop_pattano=$prop->pattano;$prop_mouza=$prop->mouza;$prop_wardno=$prop->wardno;$prop_panchayat=$prop->panchayat;$prop_zone=$prop->zone;
		}else{				
			$prop_house_no="";$prop_new_dagno="";$prop_old_dagno="";$prop_pattano="";$prop_mouza="";$prop_wardno="";$prop_panchayat="";$prop_zone="";
		}
		if(!empty($results["adjoin"])){
			$adjoin=json_decode($results["adjoin"]);
			$adjoin_north=$adjoin->north;$adjoin_south=$adjoin->south;$adjoin_east=$adjoin->east;$adjoin_west=$adjoin->west;
		}else{				
			$adjoin_north="";$adjoin_south="";$adjoin_east="";$adjoin_west="";
		}
		if(!empty($results["margin"])){
			$margin=json_decode($results["margin"]);
			$margin_north=$margin->north;$margin_south=$margin->south;$margin_east=$margin->east;$margin_west=$margin->west;
		}else{				
			$margin_north="";$margin_south="";$margin_east="";$margin_west="";
		}
		if(!empty($results["canti"])){
			$canti=json_decode($results["canti"]);
			$canti_north=$canti->north;$canti_south=$canti->south;$canti_east=$canti->east;$canti_west=$canti->west;
		}else{				
			$canti_north="";$canti_south="";$canti_east="";$canti_west="";
		}
		if(!empty($results["park_no"])){
			$park_no=json_decode($results["park_no"]);
			$park_no_base=$park_no->base;$park_no_grnd=$park_no->grnd;$park_no_open=$park_no->open;
		}else{				
			$park_no_base="";$park_no_grnd="";$park_no_open="";
		}
		if(!empty($results["park_area"])){
			$park_area=json_decode($results["park_area"]);
			$park_area_base=$park_area->base;$park_area_grnd=$park_area->grnd;$park_area_open=$park_area->open;
		}else{				
			$park_area_base="";$park_area_grnd="";$park_area_open="";
		}
		if(!empty($results["area"])){
			$area=json_decode($results["area"]);
			$area_grnd=$area->grnd;$area_first=$area->first;$area_second=$area->second;$area_thrid=$area->thrid;$area_fourth=$area->fourth;$area_fifth=$area->fifth;$area_sixth=$area->sixth;$area_sevnth=$area->sevnth;$area_eight=$area->eight;
		}else{				
			$area_grnd="";$area_first="";$area_second="";$area_thrid="";$area_fourth="";$area_fifth="";$area_sixth="";$area_sevnth="";$area_eight="";
		}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$courier_details=json_decode($results["courier_details"]);
		$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
		 if(!isset($css)){
			$val1=$formFunctions->get_uploadFile($file1);
			$val2=$formFunctions->get_uploadFile($file2);
			$val3=$formFunctions->get_uploadFile($file3);
			$val4=$formFunctions->get_uploadFile($file4);
			$val5=$formFunctions->get_uploadFile($file5);
			$val6=$formFunctions->get_uploadFile($file6);
			$val7=$formFunctions->get_uploadFile($file7);
			$val8=$formFunctions->get_uploadFile($file8);
			$val9=$formFunctions->get_uploadFile($file9);
			
		}else{
			$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
			$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
			$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
			$val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
			$val5=$formFunctions->get_useruploadFile($file5,$applicant_id);
			$val6=$formFunctions->get_useruploadFile($file6,$applicant_id);
			$val7=$formFunctions->get_useruploadFile($file7,$applicant_id);
			$val8=$formFunctions->get_useruploadFile($file8,$applicant_id);
			$val9=$formFunctions->get_useruploadFile($file9,$applicant_id);
		}
	}
	if($results["payment_mode"]==0){
		$payment_mode="OFFLINE";
		$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
	}else{
		$payment_mode="ONLINE";
	}
	 $form_name=$cms->query("select form_name from tcp_form_names where form_no='1'")->fetch_object()->form_name; 
	 $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form 1</title>
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
</style>
</head>
<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
	<br/><br/>
    <div style="text-align:center">
        '.$assamSarkarLogo.'<h4>FORM 1</h4>
        <h4>'.$form_name.'</h4>
	</div>
	<br/><br/>
	<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tr>
			<td colspan="2" align="center"><b>Applicant Information</b></td>
		</tr>
		<tr>
			<td width="50%">Application Category :</td>
			<td>'.strtoupper($app_cat).'</td>
		</tr>
		<tr>
			<td valign="top" width="50%">1. Name and address of the applicant</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
						<td width="50%">Name</td>
						<td>'.strtoupper($key_person).'</td>
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
							<td>+91-&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
							<td>Email-id</td>
							<td>'.$email.'</td>
					</tr>
				
					<tr>
							<td>Pan No</td>
							<td>'.strtoupper($pan_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			  <td>3. Father/Mother name :</td>
			  <td>'.strtoupper($fm_name).'</td>
		</tr>
		<tr>
			  <td>4. Spouse Name :</td>
			  <td>'.strtoupper($spouse_nm).'</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><b>Details of Proposed Site</b></td>
		</tr>
		<tr>
				<td width="50%">1. Name of the Owner of the Land:</td>
				<td>'.strtoupper($own_name).'</td>
		</tr>
		<tr>
				<td>2. Name of the Joint Owner :</td>
				<td>'.strtoupper($j_own_name).'</td>
		</tr>
		<tr>
			<td valign="top">3. Address of the Proposed Site :</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
							<td width="50%">House/Plotno</td>
							<td>'.strtoupper($prop_house_no).'</td>
					</tr>
					<tr>
							<td>Dag no(New)</td>
							<td>'.strtoupper($prop_new_dagno).'</td>
					</tr>
					<tr>
							<td>Dag no(Old)</td>
							<td>'.strtoupper($prop_old_dagno).'</td>
					</tr>
					<tr>
							<td>Patta no</td>
							<td>'.strtoupper($prop_pattano).'</td>
					</tr>
					<tr>
							<td >Mouza</td>
							<td>'.strtoupper($prop_mouza).'</td>
					</tr>
					<tr>
							<td>Ward no</td>
							<td>'.strtoupper($prop_wardno).'</td>
							
					</tr>
					<tr>
							<td>Municipality/Gaon Panchayat Name</td>
							<td>'.strtoupper($prop_panchayat).'</td>
							
					</tr>
					<tr>
							<td>Zone</td>
							<td>'.strtoupper($prop_zone).'</td>
					</tr>
					<tr>
							<td>Revenue Village</td>
							<td>'.strtoupper($vill_revenue).'</td>
					</tr>
					<tr>
							<td>Locality</td>
							<td>'.strtoupper($locality).'</td>
					</tr>
					<tr>
							<td>Land Use</td>
							<td>'.strtoupper($land_use).'</td>
					</tr>
					<tr>
							<td>Road/Street Name </td>
							<td>'.strtoupper($road_name).'</td>
					</tr>
					<tr>
							<td>Width of the Road</td>
							<td>'.strtoupper($road_width).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="50%">4. Name of owners of adjoining Land:</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
						<td width="50%">North</td>
						<td>'.strtoupper($adjoin_north).'</td>
					</tr>
					<tr>
						<td>South</td>
						<td>'.strtoupper($adjoin_south).'</td>
					</tr>
					<tr>
						<td>East</td>
						<td>'.strtoupper($adjoin_east).'</td>
					</tr>
					<tr>
						<td>West</td>
						<td>'.strtoupper($adjoin_west).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2"><b>Details of Building Plan</b></td>
		</tr>
		<tr>
			<td>1. Building Category :</td>
			<td>'.strtoupper($build_cat).'</td>
		</tr>
		<tr>
			<td>2. Proposed Use :</td>
			<td>'.strtoupper($prop_use).'</td>
		</tr>
		<tr>
			<td>3. Total plot area (in sq. meter) :</td>
			<td>'.strtoupper($plot_area).'</td>
		</tr>
		<tr>
			<td>4. Document/Building Area (in sq. meter) :</td>
			<td>'.strtoupper($build_area).'</td>
		</tr>
		<tr>
			<td>5. Type of Construction: :</td>
			<td>'.strtoupper($con_type).'</td>
		</tr>
		<tr>
			<td>6. No. of Floors:</td>
			<td>'.strtoupper($no_of_floor).'</td>
		</tr>
		<tr>
			<td width="50%" valign="top">7. Margin Set back :</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
						<td width="50%">North</td>
						<td>'.strtoupper($margin_north).'</td>
					</tr>
					<tr>
						<td>South</td>
						<td>'.strtoupper($margin_south).'</td>
					</tr>
					<tr>
						<td>East</td>
						<td>'.strtoupper($margin_east).'</td>
					</tr>
					<tr>
						<td>West</td>
						<td>'.strtoupper($margin_west).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top">8. Cantilever :</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
						<td width="50%">North</td>
						<td>'.strtoupper($canti_north).'</td>
					</tr>
					<tr>
						<td>South</td>
						<td>'.strtoupper($canti_south).'</td>
					</tr>
					<tr>
						<td>East</td>
						<td>'.strtoupper($canti_east).'</td>
					</tr>
					<tr>
						<td>West</td>
						<td>'.strtoupper($canti_west).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">9.Parking Details :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
					   <th width="30%">Area</th>
					   <th width="35%">Total No.</th>
					   <th width="35%">Total Area.(in sq mtrs)</th>
					</tr>
					 <tr>
						<td>Basement</td>
						<td>'.strtoupper($park_no_base).'</td>
						<td>'.strtoupper($park_area_base).'</td>
					</tr>
					<tr>
						<td>Ground</td>
						<td>'.strtoupper($park_no_grnd).'</td>
						<td>'.strtoupper($park_area_grnd).'</td>
					</tr>
					<tr>
						<td>Open</td>
						<td>'.strtoupper($park_no_open).'</td>
						<td>'.strtoupper($park_area_open).'</td>
					</tr>
				</table>
			</td>
		<tr>
		<tr>
			<td colspan="2">10. Area of Floors:</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					 <tr>
						<th width="18%">Floor</th>
						<th width="16%">Area(in Sq mtr.)</th>
						<th width="18%">Floor</th>
						<th width="16%">Area(in Sq mtr.)</th>
						<th width="16%">Floor </th>
						<th width="16%">Area(in Sq mtr)</th>
					</tr>
					<tr>
						<td>Ground</td>
						<td>'.strtoupper($area_grnd).'</td>
						<td>Third</td>
						<td>'.strtoupper($area_thrid).'</td>
						<td>Sixth</td>
						<td>'.strtoupper($area_sixth).'</td>
				   </tr>
					<tr>
					   <td>First</td>
					   <td>'.strtoupper($area_first).'</td>
					   <td>Fourth</td>
					   <td>'.strtoupper($area_fourth).'</td>
					   <td>Seventh</td>
					   <td>'.strtoupper($area_sevnth).'</td>
				   </tr>
				   <tr>
					  <td>Second</td>
					  <td>'.strtoupper($area_second).'</td>
					  <td>Fifth</td>
					  <td>'.strtoupper($area_fifth).'</td>
					  <td>Eight</td>
					  <td>'.strtoupper($area_eight).'</td>
				  </tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>11. Total Area in Sq Mtr: </td>
			<td>'.strtoupper($total_area).'</td>
		</tr>
		<tr>
			<td>12. Boundary Wall Details(in mtrs) : </td>
			<td>'.strtoupper($b_wall).'</td>
		</tr>
		<tr>
			<td style="text-indent:14px;">(a)Length : </td>
			<td>'.strtoupper($length).'</td>
		</tr>
		<tr>
			<td style="text-indent:14px;">(b)Height : </td>
			<td>'.strtoupper($height).'</td>
		</tr>
		<tr>
			<td valign="top">13. Is there any future provision for :</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
						<td  width="50%">(i) Vertical extension</td>
						<td>'.strtoupper($is_v_ext).'</td>
					</tr>
					<tr>
						<td>No. of floors</td>
						<td>'.strtoupper($v_no_floor).'</td>
					</tr>
					<tr>
						<td>(ii) Horizontal extension</td>
						<td>'.strtoupper($is_h_ext).'</td>
					</tr>
					<tr>
						<td>No. of floors</td>
						<td>'.strtoupper($h_no_floor).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">14.Name and details of RTP:</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr>
						<td width="50%">Registration No.</td>
						<td>'.strtoupper($reg_no).'</td>
					</tr>
					<tr>
							<td>Name of RTP</td>
							<td>'.strtoupper($rtp_name).'</td>
					</tr>
					<tr>
						 <td>Mobile No.</td>
						  <td>+91&nbsp;'.strtoupper($tp_mobile_no).'</td>
					</tr>
					<tr>
						 <td>Email Id</td>
						 <td>'.$tp_email.'</td>
					</tr>
					<tr>
						 <td>Fees to be paid</td>
						 <td>Rs.'.strtoupper($reg_fees).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			 <td align="center" colspan="2"><u><b>Declaration</b></u></td>
		</tr>
		<tr>
			 <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;I/We hereby give notice that I intend to erect/re-erect or to make alteration in the House the details as given above which is in accordance with the Building Byelaws of Assamand I/We forward herewith,the following plans and specifications duly signed by me and Registered Technical person duly appointed by us, who have prepared the plans, statements/documents(as applicable).I/We request that the construction may be approved and permission accorded to me to execute the work.I hereby also declare that the contents of the above application and the enclosures are true and correct to my /our knowledge.No part of it is false and nothing has been concealed there form.<br/>I agree.....</td>
		</tr>
		<tr>
			<td>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">'.strtoupper($key_person).'<br/>Name of the applicant</td>
		</tr>
		<tr>
			<td colspan="2" height="50px"><font color="red">Checklist of the Documents</font><br/>
			*NA - Not Applicable<br/>
			*SC - Send By Courier</td>
		</tr>
		<tr>
			<td>1. A copy of site plan and building plan as required by building bye laws,ASSAM,and drawn by Technical Personal registered in MB/TC:</td>
			<td>'.$val1.'</td> 
		</tr>
		<tr>
			<td>2.Photostat Copy of land document (Such as land deed,Mutation order or Patta).The photocopy is to be self- attested :  </td>
			<td>'.$val2.'</td> 
		</tr>
		<tr>
			<td>3.Structural Certificate(as per building bye laws of 2006 )issued by Technical/Personal/Group Agency Registered in MB/TC.: </td>
			<td>'.$val3.'</td> 
		</tr>
		<tr>
			<td>4.Service Plan for building when it is above 12:00 m high .:</td>
			<td>'.$val4.'</td> 
		</tr>
		<tr>
			<td>5. 5. For boundary wall permission; an undertaking through affidavit shall be required particularly for road side wall.</td>
			<td>'.$val5.'</td> 
		</tr>
		<tr>
			<td>6. Key Plan of the Location:</td>
			<td>'.$val6.'</td> 
		</tr>
		<tr>
			<td>7.Soil Test report(Geo-Technical Report)in case of building above 12.00m high:</td>
			<td>'.$val7.'</td> 
		</tr>
		<tr>
			<td>8. Trace Map.:</td>
			<td>'.$val8.'</td> 
		</tr>
		<tr>
			<td>9. Receipt copy of up to date property tax.:</td>
			<td>'.$val8.'</td> 
		</tr>';
	
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$printContents=$printContents.'
		<tr>		   
		<td colspan="2">
			<table border="1" width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse">
				<tr><td height="45px" colspan="2">Courier Details.</td></tr>
				<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
				<tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
				<tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
			</table>
		</td>
		</tr>';
		}
		if($results["payment_mode"]!=NULL){ 
		$printContents=$printContents.'
			<tr>		    
				<td colspan="2">
					<table border="1" align="center" style="margin:0px auto;border-collapse: collapse" class="table table-bordered table-responsive" width="100%">
						<tr><td height="45px" colspan="2">Payment Details :</td></tr>
						
						<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
						if($results["payment_mode"]==0){
							$printContents=$printContents.'
							<tr><td width="50%">Application Fee Challan Reciept :</td><td>'.$offline_challan.'</td></tr>';
						}
						$printContents=$printContents.'
					</table>			
				</td>
			</tr>';
		}
		$printContents=$printContents.'
		<tr>
			<td colspan="2">Signatures and Date</td>
		</tr>
		<tr>
			<td colspan="2">
				<table table border="1" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" width="100%">
					<tr>
						<td width="50%">Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
						<td align="right">'.strtoupper($key_person).'<br/>Name of the applicant</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
?>
	
            			
							   
			