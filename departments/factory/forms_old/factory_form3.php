<?php  require_once "../../requires/login_session.php"; 
$get_file_name=basename(__FILE__);
/* $factory_form1_rows=$factory->query("select form_id,file1,file2,file3,file4,courier_details from factory_form1 where user_id='$swr_id' and active='1'");
if($factory_form1_rows->num_rows>0){
	$factory_form1_values=$factory_form1_rows->fetch_array();
	$form_id=$factory_form1_values["form_id"];
	$cdfile1=$factory_form1_values["file1"];$cdfile2=$factory_form1_values["file2"];$cdfile3=$factory_form1_values["file3"];$cdfile4=$factory_form1_values["file4"];
}else{
	echo "<script>
			alert('Something went wrong .. Please try again !!!');
			window.location.href = 'factory_form1.php';
		</script>";
} */

$factory_form1_rows=$factory->query("select form_id from factory_form1 where user_id='$swr_id' and active='1'");
if($factory_form1_rows->num_rows>0){
	$factory_form1_values=$factory_form1_rows->fetch_array();
	$form_id=$factory_form1_values["form_id"];
}else{
	echo "<script>
			alert('Something went wrong .. Please try again !!!');
			window.location.href = 'factory_form1.php';
		</script>";
} 
include "save_form.php";
		$email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		
		$from=$key_person."<br/>Designation : ".$status_applicant."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$landline_std."-".$landline_no."<br/>E-mail ID : ".$email;
		
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
		$q=$factory->query("select * from factory_form3 where form_id='$form_id'") or die($factory->error);
		$results=$q->fetch_assoc();
		if($q->num_rows<1)
		{	 		
			$ownership_data_sno="";$ownership_data_is_classified="";$ownership_data_is_proposed="";$ownership_data_local_auth="";
			$site_plan_monument="";$site_plan_unit="";$site_plan_source="";$site_plan_distance="";$site_plan_transmission="";$site_plan_soil="";			
			$project_report_summary="";$project_report_status="";$project_report_status_o="";$project_report_no="";$project_report_housing="";			
			$org_structure_area="";$org_structure_measures="";			
			$other_info="";			
			$communication_link_details="";$communication_link_facility="";
			$supply_p_amt="";$supply_w_amt="";$supply_p_unit="";$supply_w_unit="";$supply_p_src="";$supply_w_src="";			
			$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";$file11="";$file12="";	
		}else{
			$form_id=$results['form_id'];$other_info=$results['other_info'];	
			
			if(!empty($results["ownership_data"])){
				$ownership_data=json_decode($results["ownership_data"]);
				$ownership_data_sno=$ownership_data->sno;$ownership_data_is_classified=$ownership_data->is_classified;$ownership_data_is_proposed=$ownership_data->is_proposed;$ownership_data_local_auth=$ownership_data->local_auth;
			}else{
				$ownership_data_sno="";$ownership_data_is_classified="";$ownership_data_is_proposed="";$ownership_data_local_auth="";
			}
			if(!empty($results["site_plan"])){
				$site_plan=json_decode($results["site_plan"]);
				if(isset($site_plan->monument)) $site_plan_monument=$site_plan->monument; else $site_plan_monument="";
				if(isset($site_plan->unit)) $site_plan_unit=$site_plan->unit; else $site_plan_unit="";
				if(isset($site_plan->source)) $site_plan_source=$site_plan->source; else $site_plan_source="";
				if(isset($site_plan->distance)) $site_plan_distance=$site_plan->distance; else $site_plan_distance="";
				if(isset($site_plan->transmission)) $site_plan_transmission=$site_plan->transmission; else $site_plan_transmission="";
				if(isset($site_plan->soil)) $site_plan_soil=$site_plan->soil; else $site_plan_soil="";
			}else{
				$site_plan_monument="";$site_plan_unit="";$site_plan_source="";$site_plan_distance="";$site_plan_transmission="";$site_plan_soil="";
			}
			if(!empty($results["project_report"])){
				$project_report=json_decode($results["project_report"]);
				if(isset($project_report->summary)) $project_report_summary=$project_report->summary;
				if(isset($project_report->status)) $project_report_status=$project_report->status;
				if(isset($project_report->no)) $project_report_no=$project_report->no;
				if(isset($project_report->housing)) $project_report_housing=$project_report->housing;	
			}else{
				$project_report_summary="";$project_report_status="";$project_report_no="";$project_report_housing="";
			}

			if(!empty($results["supply"])){
				$supply=json_decode($results["supply"]);
				$supply_p_amt=$supply->p_amt;$supply_w_amt=$supply->w_amt;$supply_p_unit=$supply->p_unit;$supply_w_unit=$supply->w_unit;$supply_p_src=$supply->p_src;$supply_w_src=$supply->w_src;
			}else{
				$supply_p_amt="";$supply_w_amt="";$supply_p_unit="";$supply_w_unit="";$supply_p_src="";$supply_w_src="";
			}	
			if(!empty($results["org_structure"])){
				$org_structure=json_decode($results["org_structure"]);
				$org_structure_area=$org_structure->area;$org_structure_measures=$org_structure->measures;
			}else{
				$org_structure_area="";$org_structure_measures="";
			}	
			if(!empty($results["comm_link"])){
				$communication_link=json_decode($results["comm_link"]);
				$communication_link_details=$communication_link->details;
				$communication_link_facility=$communication_link->facility;
			}else{
				$communication_link_details="";$communication_link_facility="";
			}
			$q2=$factory->query("select * from factory_form3_upload where form_id=$form_id") or die($factory->error);
			$results2=$q2->fetch_assoc();
			if($q2->num_rows>0){
				$file1=$results2["file1"];$file2=$results2["file2"];$file3=$results2["file3"];$file4=$results2["file4"];$file5=$results2["file5"];$file6=$results2["file6"];$file7=$results2["file7"];$file8=$results2["file8"];$file9=$results2["file9"];$file10=$results2["file10"];$file11=$results2["file11"];$file12=$results2["file12"];
			}else{
				$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";$file11="";$file12="";
			}
		}
		##PHP TAB management
		$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
		$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
		if($showtab=="" || $showtab<2 || $showtab>3 || is_numeric($showtab)==false){
			$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
			$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
		}
		if($showtab==2){
			$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
			$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
		}
		if($showtab==3){
			$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
			$tabdiv3="style='display:block;'";$tabbtn3="active";$tabdiv4="style='display:none;'";$tabbtn4="";
		}
		##PHP TAB management ends
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
	</style>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center" >
									<br/><strong><?php echo $form_name=$formFunctions->get_formName('factory','3')?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li  class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								  <li  class="<?php echo $tabbtn3; ?>"><a href="#table3">Upload Section</a></li>
								  
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myformFT3A" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4"><strong>1. Full Name and Address of the Applicant :</strong></td>
									</tr>
									
									<tr>
										<td width="25%">Name:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $key_person; ?>"></td>
										<td width="25%">Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
									</tr>
									<tr>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
										<td>Village/Town: </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
									</tr>
									<tr>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
									</tr>
									<tr>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
									</tr>
									<tr>
                                       <td colspan="4"><strong>2. Site ownership data :</strong></td>
									   
									</tr>
									<tr>
									    <td>2.1. Revenue details of site such as Survey No :</td>
									    <td><input type="text" class="form-control text-uppercase" name="ownership_data[sno]" value="<?php echo $ownership_data_sno; ?>"></td>
									   <td>2.2. Whether the site is classified as forest and if so whether approval of the central Govt. under Sec. 5 of the Indian Forest Act, 1927 has been taken :</td>
										<td><input type="text" class="form-control text-uppercase" name="ownership_data[is_classified]" value="<?php echo $ownership_data_is_classified; ?>"></td>
									</tr>
									<tr>
									   <td>2.3. Whether the proposed site attracts the provisions of section 3(2) (V) of the E.P.Act,1986, if so that nature of the restrictions : 
									   </td>
									   <td><input type="text" class="form-control text-uppercase" name="ownership_data[is_proposed]" value="<?php echo $ownership_data_is_proposed; ?>"></td>
										<td>2.4. Local authority under whose jurisdiction the site is located : </td>
										<td><input type="text" class="form-control text-uppercase" name="ownership_data[local_auth]" value="<?php echo $ownership_data_local_auth; ?>"></td>
									</tr>
									<tr>
									     <td colspan="4"><strong>3. Site Plan :</strong></td>
									</tr>
									<tr>
								
										<td colspan="2">3.1. Site plan with clear identification of boundaries & total area proposed to be occupied & showing the following details nearby the proposed site :</td>
										<td colspan="2">Please upload the document in upload section.</td>
									</tr>
									<tr>
									    <td >a) Historical monument, if any, in the vicinity :</td>
									    <td>
											<label class="radio-inline"><input type="radio" value="Y" name="site_plan[monument]" <?php if($site_plan_monument=='Y') echo 'checked'; ?> />&nbsp;YES</label>
											<label class="radio-inline"><input type="radio" value="N" name="site_plan[monument]" <?php if($site_plan_monument=='N' || $site_plan_monument=='') echo 'checked'; ?> >&nbsp;NO</label><br/>
										</td>
									    <td>b) Names of neighboring manufacturing units & human habitats, Educational & training institutions, patrol installations storages of LPG & other hazardous substances in the vicinity & their distances from the proposed unit :</td>
									    <td><textarea  validate="textarea" class="form-control text-uppercase" name="site_plan[unit]" ><?php echo $site_plan_unit; ?></textarea></td>
									</tr>
									<tr>
									    <td>c) Water sources(rivers, streams, canals, <br/>dams, water filtration plants etc.) in the vicinity :</td>
									    <td><textarea validate="textarea" class="form-control text-uppercase" name="site_plan[source]" ><?php echo $site_plan_source; ?></textarea></td>
										<td>d) Nearest hospitals, fire-stations, civil <br/>defense stations & police stations & their distances :</td>
										<td><textarea validate="textarea" class="form-control text-uppercase" name="site_plan[distance]"><?php echo $site_plan_distance; ?></textarea></td>
									</tr>
									<tr>
							  		    <td>e) High tension electrical transmission line, pipe lines for water ,oil, gas or sewerage, railway lines, roads, stations, jetties & other similar installations : </td>
									    <td><textarea validate="textarea" class="form-control text-uppercase" name="site_plan[transmission]"><?php echo $site_plan_transmission; ?></textarea></td>
										<td>3.2. Details of soil conditions & depth at <br/>which hard strata obtained :</td>
										<td><textarea validate="textarea" class="form-control text-uppercase" name="site_plan[soil]"><?php echo $site_plan_soil; ?></textarea></td>
									</tr>
									<tr>
									   <td>3.3. Contour map of the area showing nearby hillocks & difference in levels :</td>
										<td>Please upload the document in upload section.</td>
									    <td>3.4. Plot plan of the factory showing the entry & exit Points, roads, within water drains, etc :</td>
									    <td>Please upload the document in upload section.</td>
									</tr>
									<tr>
									    <td colspan="4"><strong>4. Project Report.</strong></td>
									</tr>
									<tr>
									    <td >4.1. A summary of the salient features of the project :</td>
									    <td><textarea validate="textarea" class="form-control text-uppercase" name="project_report[summary]" ><?php echo $project_report_summary; ?></textarea></td>
									    <td >4.2. Status of the organization (Govt.<br/> Semi Govt. Public or private etc.) :<span class="mandatory_field">*</span>  </td>
									    <td>
										   <select class="form-control text-uppercase" required="required" id="pr_status" name="project_report[status]">
												<option value="">Select Status</option>
								                <option value="G" <?php if($project_report_status=="G") echo "selected";?>>Govt.</option>
								                <option value="SG" <?php if($project_report_status=="SG") echo "selected";?>>Semi Govt.</option>
								                <option value="P" <?php if($project_report_status=="P") echo "selected";?>>Public.</option>
								                <option value="PR" <?php if($project_report_status=="PR") echo "selected";?>>Private.</option>
								                <option value="O" <?php if($project_report_status!="" && $project_report_status!="G" && $project_report_status!="SG" && $project_report_status!="P" && $project_report_status!="PR" ) echo "selected";?>>Other</option><br/>
								                <input id="f91" name="project_report[status]"  style="text-transform: uppercase; font-size:14px;" maxlength="255" size="30" value="<?php if($project_report_status!="" && $project_report_status!="G" && $project_report_status!="SG" && $project_report_status!="P" && $project_report_status!="PR" ) echo $project_report_status; ?>"/>
											</select>
									</tr>
									<tr>
									    <td>4.3. Maximum number of persons likely to be working in the factory :</td>
									    <td><input type="text" class="form-control text-uppercase" name="project_report[no]" validate="onlyNumbers" value="<?php echo $project_report_no; ?>"/></td>
										<td></td>
									    <td></td>
									</tr>
									<tr>
									    <td colspan="4">4.4. Maximum amount of power & water requirements & sources of their supply :</td>									   
									</tr>
									<tr>
									<td colspan="4">
									<table>
										<tr>
											<td style="width:10%">Power :</td>
											<td style="width:20%"><input type="text" validate="onlyNumbers" class="form-control" name="supply[p_amt]" value="<?php echo $supply_p_amt; ?>"/> </td>
											<td style="width:10%;padding-left:20px">Units </td>
											<td style="width:20%">
												 <select name="supply[p_unit]" class="form-control text-uppercase">
												 <option value="K" <?php if($supply_p_unit=="K" || $supply_p_unit=="") echo "selected"?>>KW</option>
												 <option value="H" <?php if($supply_p_unit=="H") echo "selected"?>>HP</option>
												 </select>
											</td>
											<td style="width:20%;padding-left:20px">Source :</td>
											<td style="width:20%">
											   <select name="supply[p_src]" class="form-control text-uppercase">
												   <option value="S" <?php if($supply_p_src=="S" || $supply_p_src=="") echo "selected"?>>State Electricity Authority</option>
												   <option value="SG" <?php if($supply_p_src=="SG") echo "selected"?>>Self Generation</option>
												   <option value="FG" <?php if($supply_p_src=="FG") echo "selected"?>>From Grid</option>
											   </select>
											</td style="width:20%">
										</tr>
									</table>
									</td>
									</tr>
									<tr>
									<td colspan="4">
									<table>
										<tr>
											<td style="width:10%">Water :</td>
											<td style="width:20%"><input type="text" validate="onlyNumbers" class="form-control text-uppercase"  name="supply[w_amt]"  value="<?php echo $supply_w_amt; ?>"/></td>
											<td style="width:10%;padding-left:20px">Units </td>
											<td style="width:20%">
												<select name="supply[w_unit]" class="form-control text-uppercase">
										       <option value="KL" <?php if($supply_w_unit=="KL" || $supply_w_unit=="") echo "selected"?>>KL</option>
										       <option value="L" <?php if($supply_w_unit=="L") echo "selected"?>>L</option>
												</select>
											</td>
											<td style="width:20%;padding-left:20px">Source :</td>
											<td style="width:20%">
											   <select name="supply[w_src]" class="form-control text-uppercase">
										         <option value="R" <?php if($supply_w_src=="R" || $supply_w_src=="") echo "selected"?>>River/Stream/Canal</option>
										         <option value="GW" <?php if($supply_w_src=="GW") echo "selected"?>>Ground Water</option>
										         <option value="MS" <?php if($supply_w_src=="MS") echo "selected"?>>Municipal Supply</option>
												  <option value="M" <?php if($supply_w_src=="M") echo "selected"?>>Mined</option>
										    </select>
											</td style="width:20%">
										</tr>
									</table>
									</td>
									</tr>
									<tr>
									     <td>4.5. Block diagram of the buildings & <br/>installations, in the proposed supply :</td>
									     <td>Please upload the document in upload section.</td>
									    <td >4.6. Details of housing colony, hospital, <br/>school & other infrastructural facilities proposed :</td>
									    <td><textarea validate="textarea" class="form-control text-uppercase" max-length="255" name="project_report[housing]"><?php echo $project_report_housing; ?></textarea></td>
									    
									    
									</tr>
									<tr>
									    <td>5. Organisation structure of the proposed<br/> manufacturing Unit/Factory :</td>
									    <td>Please upload the document in upload section.</td>
									    <td >5.1 Organisation diagrams of proposed enterprise in general-Health, Safety & Environment protection departments & their linkages to operation & technical department :</td>
									    <td >Please upload the document in upload section.</td>
										
									</tr>
									<tr>
									    <td >5.2. Proposed Health & Safety Policy : </td>
									    <td>Please upload the document in upload section.</td>
									    <td>5.3. Area allocated for treatment of wastes & affluent :</td>
									    <td><input type="text" class="form-control text-uppercase" name="org_structure[area]" value="<?php echo $org_structure_area; ?>"></td>
										
									</tr>
									<tr>
									    <td>5.4. Percentage outlay on safety, health & environment protection measures :</td>
									    <td><input type="text" class="form-control text-uppercase" name="org_structure[measures]" value="<?php echo $org_structure_measures;?>" /></td>
									</tr>
									<tr>
										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save3a" title="Save it, if you want to complete it later and Go to next part" rel="tooltip" onclick="return confirm('Do you want to save..?')" />Save and Next</button>
										</td>
										
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
		                        <form name="myform1" id="myformFT3B" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
								
									<tr>
									     <td colspan="4"><strong>6. Meterogical data relating to the site.</strong> </td>
									</tr>
									<tr>
									    <td colspan="2">6.1. Average, Minimum & maximum Temperature-humidity-wind velocities during the previous ten years :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
										
									</tr>
									<tr>
									    <td colspan="2">6.2. Seasonal variations of wind direction :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
										
									</tr>
									<tr>
									    <td colspan="2">6.3. High water level reached during the floods in the area recorded so far : </td>
									    <td colspan="2">Please upload the document in upload section.</td>
									</tr>
									<tr>
									   <td colspan="4"><strong>7. Communication Links.</strong> </td>
									     
									</tr>
									<tr>
								
										<td colspan="2">7.1. Availability of telephone/telex wireless & other communication facilities for outside communication :</td>
										<td><input type="text" class="form-control text-uppercase" name="comm_link[details]" value="<?php echo $communication_link_details; ?>"></td>
										
									</tr>
									<tr>
									    <td colspan="2">7.2. Internal communication facilities proposed :</td>
									    <td><input type="text" class="form-control text-uppercase" name="comm_link[facility]"  value="<?php echo $communication_link_facility; ?>"></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4"><strong>8.Manufacturing process information :</strong> </td>
									
									</tr>
									<tr>
									    <td colspan="2">8.1. Process flow diagram :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									</tr>
									<tr>
									    <td colspan="2">8.2. Brief write up on process & technology :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">8.3. Critical process parameters such as pressure build-up, temperature rise & run-way reactions :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">8.4. Different aspects critical to the process having safety implications, such as ingress of moisture <br/>or water, contact with incompatible substances, sudden power failure : </td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">8.5. Highlights of the building safety pollution control devices or measures/incorporated in the <br/>manufacturing process :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="4"><strong>9. Information of Hazardous Materials.</strong> </td>
									
									</tr>
									<tr>
									    <td colspan="2">9.1. Raw materials, intermediates, products & by products & their quantities (enclose Material safety <br/>data sheet in respect of each hazardous such stances) :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									</tr>
									<tr>
									    <td colspan="2">9.2. Main & intermediate shortages proposed for raw materials/intermediates/products/by-products<br/>(Maximum quantities to be stored at any time) : </td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">9.3. Transportation methods to be used for materials in flow & out flow, their quantities & likely <br/>routes to be followed :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">9.4. Measures proposed for handling of materials, internal & external transportation & disposal <br/>(packing & forwarding of finished products :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									
									<tr>
									   <td colspan="4"><strong>10. Information of Dispersal/Disposal of wastes & Pollutant.</strong></td>
									</tr>
									<tr>
									    <td colspan="2">10.1. Major pollutants(Gas, liquid, solid, their characteristics & quantities (average & at peak load) :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">10.2. Quality & Quantity of solid wastes generated, method of their treatment & disposal : </td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">10.3. Air, water and soil pollutions problems anticipated & the proposed measures to control the same,<br/> including treatment & disposal of affluent :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									   <td colspan="4"><strong>11. Process Hazards information.</strong></td>
									</tr>
									<tr>
									    <td colspan="2">11.1. Enclose a copy of the report on environmental impact assessment :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">11.2. Enclose a copy of the report on Risk Assessment study :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">11.3. Published (open or classified) reports, if any, on accident situations/occupational health hazards <br/>of similar plants elsewhere (within or outside the country) :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									   <td colspan="4"><strong>12. Information of proposed safety & occupational health Measures :</strong></td>
									</tr>
									<tr>
									    <td colspan="2">12.1. Details of fire fighting facilities & minimum quantity or water, CO2 or other fire fighting measures <br/>needed to meet the emergencies :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">12.2. Details of in house medical facilities proposed :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									   <td colspan="4"><strong>13. Information of Emergency.</strong></td>
									</tr>
									<tr>
									    <td colspan="2">13.1. Outside Emergency Plan :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">13.2. Proposed arrangements, if any for mutual aid scheme with the group of neighboring factories :</td>
									    <td colspan="2">Please upload the document in upload section.</td>
									    
									</tr>
									<tr>
									    <td colspan="2">14. Any other relevant information :</td>
									    <td colspan="2"><textarea class="form-control text-uppercase" name="other_info" ><?php echo $other_info; ?></textarea></td>
									 </tr>
									<tr>
									    <td colspan="4">Signature and Dates </td>
									</tr>
									<tr>
									     <td>Signature of Occupier :</td>
									     <td><label><input type="text" class="form-control" value="<?php echo strtoupper($key_person) ?>" disabled></label></td>
									     <td>Date : </td>
										 <td><?php echo date('d-m-Y', strtotime($today)); ?></td>
									</tr>								
									<tr>										
										<td class="text-center" colspan="4">
										    <a type="button" class="btn btn-primary text-bold" href="factory_form3.php?tab=1" >Go Back & Edit</a>
											<button type="submit" class="btn btn-success text-bold submit1" name="save3b" onclick="return confirm('Do you really want to save the form ?')">Save and Next</button>
										</td>										
									</tr>
								</table>
								</form>
								</div>
				<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
				<form name="fileUpload" class="submit1" id="factory3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				<table id="" class="table table-responsive">
				<tr>
					<td colspan="5">Documents to be enclosed<span class="mandatory_field">*</span><br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
				</tr>
					<tr>
						<td width="50%">Site plan.(as stated in 3.1)</td>
						
						
						<td width="30%">
                                            <select trigger="FileModal" id="file1" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile1" id="mfile1" value="<?php echo $file1 !== '' ? $file1 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile1">
                                            <?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
						
					</tr>
					<tr>
						<td>Contour map of the area showing nearby hillocks & difference in levels.</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file2" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file2); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile2" id="mfile2" value="<?php echo $file2 !== '' ? $file2 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile2">
                                            <?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Plot plan of the factory showing the entry & exit Points, roads, within water drains, etc.</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file3" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file3); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile3" id="mfile3" value="<?php echo $file3 !== '' ? $file3 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile3">
                                            <?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Block diagram of the buildings & installations, in the proposed supply and Organisation structure with diagrams (as stated in 4.5, 5, 5.1 and 5.2) </td>
						<td width="30%">
                                            <select trigger="FileModal" id="file4" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file4); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile4" id="mfile4" value="<?php echo $file4 !== '' ? $file4 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile4">
                                            <?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Materrogical data relating to the site .(as stated in 6.1, 6.2 and 6.3)</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file5" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file5); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile5" id="mfile5" value="<?php echo $file5 !== '' ? $file5 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile5">
                                            <?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
					     <td>Manufacturing Process Information.(as stated in 8.1, 8.2, 8.3, 8.4 and 8.5)</td>
					      <td width="30%">
                                            <select trigger="FileModal" id="file6" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file6); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile6" id="mfile6" value="<?php echo $file6 !== '' ? $file6 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile6">
                                            <?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Information of Hazardous Materials.(as stated in 9.1, 9.2, 9.3 and 9.4) </td>
						 <td width="30%">
                                            <select trigger="FileModal" id="file7" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file7); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile7" id="mfile7" value="<?php echo $file7 !== '' ? $file7 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile7">
                                            <?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Information of Dispersal/Disposal of wastes and Pollutant.(as stated in 10.1, 10.2 and 10.3)</td>
						 <td width="30%">
                                            <select trigger="FileModal" id="file8" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file8); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile8" id="mfile8" value="<?php echo $file8 !== '' ? $file8 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile8">
                                            <?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Process Hazards Information (as stated in 11.1, 11.2 and 11.3)</td>
						 <td width="30%">
                                            <select trigger="FileModal" id="file9" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file9); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile9" id="mfile9" value="<?php echo $file9 !== '' ? $file9 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile9">
                                            <?php if($file9!="" && $file9!="SC" && $file9!="NA"){ echo '<a href="'.$upload.$file9.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Information of proposed safety and occupational health measures (as stated in 12.1 and 12.2).</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file10" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file10); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile10" id="mfile10" value="<?php echo $file10 !== '' ? $file10 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile10">
                                            <?php if($file10!="" && $file10!="SC" && $file10!="NA"){ echo '<a href="'.$upload.$file10.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Information of Emergency.(as stated in 13.1 and 13.2)</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file11" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file11); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile11" id="mfile11" value="<?php echo $file11 !== '' ? $file11 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile11">
                                            <?php if($file11!="" && $file11!="SC" && $file11!="NA"){ echo '<a href="'.$upload.$file11.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					<tr>
						<td>Enclose Any other copy of relevant information.</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file12" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file12); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile12" id="mfile12" value="<?php echo $file12 !== '' ? $file12 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile12">
                                            <?php if($file12!="" && $file12!="SC" && $file12!="NA"){ echo '<a href="'.$upload.$file12.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
					</tr>
					
					<tr>
						<td class="text-center" colspan="5">
							<a href="factory_form3.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
							<button type="submit" class="btn btn-success text-bold submit1" name="submit3" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">FINAL SUBMIT</button>
						</td>
						
					</tr>
					
				</table>
				</form>
				</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/*--------------------------------------------------------*/
	<?php if($project_report_status=="" || $project_report_status=="G" || $project_report_status=="SG" || $project_report_status=="P" || $project_report_status=="PR" ){?>
	$('#f91').hide();
	$('#f91').attr('disabled', 'disabled');
	<?php } ?>
	$('#pr_status').on('change', function(){
		if($('#pr_status option[value="O"]:checked').length == 1){
			$('#f91').show();
			$('#f91').removeAttr('disabled');
		}else{
			$('#f91').hide();
			$('#f91').attr('disabled', 'disabled');
		}
	});
	/* ---------------------upload S/C click operation-------------------- */

	/* ------------------------------------------------------ */
</script>
</body>
</html>