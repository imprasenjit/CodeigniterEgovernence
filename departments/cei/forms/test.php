<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('cei','25');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=25dept=cei';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=25&dept=cei';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}

$get_file_name=basename(__FILE__);
include "save25.php";
	$q=$cei->query("select * from cei_form25 where user_id='$swr_id'") or die($cei->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		########## Part A ###############
		
		$Voltage="";$Location="";$point_from_pt="";$point_to_pt="";$pur_constructed="";$Length="";
		$Quantum="";$length_Spans="";$Type_conductor="";$size_conductor="";$Type_Support="";$Materials="";$t_Supports="";
		$Type_Insulators="";$Type_Cross="";$Cross_size="";$acr_street="";$a_street="";$Elsewhere="";$clearance_v="";
		$clearance_h="";$clearance_g="";
		
		########## Part B ###############
		$Where_conductors="";$Cradle_guard="";$Mention_voltage="";$Horizontal ="";$Vertical="";$Has_guard="";$angle_crossing="";
		$overhead_line="";$necessary_clearance="";
		
		
		########## Part C ###############
		$ph_earth =""; $phas_ph="";$voltage_Insulation="";$type_size_guard="";$earth_wire="";$earth_wire_ear="";$metallic_supports="";$continuous_earth_wire="";$intervals_earth_wire="";$metallic_supports="";$permanently_earthed="";$overhead_line="";
		$Specifications="";$Make="";$protection="";$Normal_setting="";$anti_climbing="";$lightning_a="";$lightning_b="";$lightning_c="";$lightning_d="";$lightning_e="";
		
	
		
	}else{
		
		$form_id=$results['form_id'];
		
      ########## Part A ###############
				
		$Voltage=$results['Voltage'];$Location=$results['Location'];$point_from_pt=$results['point_from_pt'];$point_to_dt=$results['point_to_dt'];$pur_constructed=$results['pur_constructed'];$Length=$results['Length'];$Quantum=$results['Quantum'];
		$Type_conductor=$results['Type_conductor'];$size_conductor=$results['size_conductor'];
		$Type_Support=$results['Type_Support'];$Materials=$results['Materials'];$t_Supports=$results['t_Supports'];
		$Type_Insulators=$results['Type_Insulators'];
		$Type_Cross=$results['Type_Cross'];$Cross_size=$results["Cross_size"];$acr_street=$results["acr_street"];$a_street=$results["a_street"];$Elsewhere=$results["Elsewhere"];
		if(!empty($results["point"])){
				$point=json_decode($results["point"]);
				$point_from_pt=$point->from_pt;$point_to_pt=$point->to_pt;
			}else{				
				$point_from_pt="";$point_to_pt="";
			}
            if(!empty($results["clearance"])){
				$clearance=json_decode($results["clearance"]);
				$clearance_v=$clearance->v;$clearance_h=$clearance->h;$clearance_g=$clearance->g;
			}else{				
				$clearance_v="";$clearance_h="";$clearance_g="";
			}				
		
		########## Part B ###############
		
		$Where_conductors=$results["Where_conductors"];$Cradle_guard=$results["Cradle_guard"];$Mention_voltage=$results[" Mention_voltage"];$Horizontal=$results["Horizontal"];$Vertical=$results["Vertical"];$Has_guard=$results["Has_guard"];
		$angle_crossing=$results["angle_crossing"];$overhead_line=$results["overhead_line"];$necessary_clearance=$results["necessary_clearance"];
		
		########## Part C ###############
		$voltage_Insulation=$results["voltage_Insulation"];$type_size_guard=$results["type_size_guard"];$earth_wire=$results["earth_wire"];$earth_wire_ear=$results["earth_wire_ear"];$ph_earth =$results["ph_earth"];$phas_ph =$results["phas_ph"];
	    $necessary_clearance=$results["necessary_clearance"];$continuous_earth_wire=$results["continuous_earth_wire"];
		$intervals_earth_wire=$results["intervals_earth_wire"];$metallic_supports=$results["metallic_supports"];$permanently_earthed=$results["permanently_earthed"];$overhead_line=$results["overhead_line"];
		$Make=$results["Make"];$Specifications=$results["Specifications"];$protection=$results["protection"];$Normal_setting=$results["Normal_setting"];$anti_climbing=$results["anti_climbing"];
		
		if(!empty($results["lightning"]))
		{
			$lightning=json_decode($results["lightning"]);
			$lightning_a=$lightning->a;$lightning_b=$lightning->b;$lightning_c=$lightning->c;$lightning_d=$lightning->d;$lightning_e=$lightning->e;
		}else{
			$lightning_a="";$lightning_b="";$lightning_c="";$lightning_d="";$lightning_e="";
		}
		if(!empty($results["present_addr"])){
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;$present_addr_email=$present_addr->email;
		}else{
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}
		if(!empty($results["issue_certificate"])){
			$issue_certificate=json_decode($results["issue_certificate"]);
			$issue_certificate_regd_no=$issue_certificate->regd_no;$issue_certificate_dte=$issue_certificate->dte;
		}else{
			$issue_certificate_regd_no="";$issue_certificate_dte="";
		}
		if(!empty($results["challan"])){
			$challan=json_decode($results["challan"]);
			$challan_no=$challan->no;$challan_dated=$challan->dated;$challan_rupees=$challan->rupees;$challan_rs_word=$challan->rs_word;$challan_bank=$challan->bank;
		}else{
			$challan_no="";$challan_dated="";$challan_rupees="";$challan_rs_word="";$challan_bank="";
		}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}
	
##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";$tabbtn7="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";$tabbtn7="";
	}
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";$tabbtn7="";
	}
	if($showtab==7){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="active";
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
		.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control text-uppercase{
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
	<?php include ("form1_addmore.php"); ?>
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
									<strong>SCHEDULE-I - APPLICATION FORM FOR CONSENT/AUTHORISATION</strong><br/>
									<p class="text-center" style="font-size:0.8em;">Common Application for Consent under  Water (Prevention and Control of Pollution) Act, 1974,  Air (Prevention and Control of Pollution) Act, 1981) and <br/>authorisation under  Hazardous Wastes (Management and Handling) Rules, 1989, as amended</p>
								</h4>	
							</div>
							
							
							
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a href="#table4">Part 4</a></li>
									<li class="<?php echo $tabbtn5; ?>"><a href="#table5">Part 5</a></li>
									<li class="<?php echo $tabbtn6; ?>"><a href="#table6">Part 6</a></li>
									<li class="<?php echo $tabbtn7; ?>"><a href="#table7">Part 7</a></li>
									<li class="<?php echo $tabbtn8; ?>"><a href="#table8">Upload Section</a></li>
									<li class="<?php echo $tabbtn10; ?>"><a href="#table10">Payment Section</a></li>
								</ul>
								<br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										
										<input type="hidden" value="<?php echo $enterprise_category; ?>" name="enterprise_category" class="form-control text-uppercase">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">From : <?php echo strtoupper($from);?></td>
											</tr>
											<tr>
												<td colspan="4">Sir,<br/>I / We hereby apply for *<br/>
												(i) Consent to Establish of consent under section 25 and 26 of the Water (Prevention and Control of Pollution) Act, 1974, as amended.<br/>
												(ii) Consent to establish of consent under Section 21 of the Air (Prevention and Control of Pollution) Act, 1981, as amended.<br/>
												(iii) Authorisation under rule 5 of the Hazardous Wastes (Management and Handling) Rules, 1989, as amended in connection with my / our existing / proposed / altered / additional manufacturing / processing activity from the premises as per the details given below.<br/></td>
											</tr>
											<tr>
												<td><b>Part A : General	</b></td>
											</tr>
											<tr>
												<td colspan="4">1. Name, Designation and Address with telephone,  e-mail of the Applicant :</td>
											</tr>
											<tr>
												<td width="25%">Name</td>
												<td width="25%"><input type="text"  value="<?php echo strtoupper($key_person);?>" class="form-control text-uppercase" disabled></td>
												<td width="25%">Designation</td>
												<td width="25%"><input type="text"  value="<?php echo strtoupper($status_applicant);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text"  value="<?php echo strtoupper($street_name1);?>" class="form-control text-uppercase" disabled></td>
												<td>Street Name 2</td>
												<td><input type="text"  value="<?php echo strtoupper($street_name2);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text"  value="<?php echo strtoupper($vill);?>" class="form-control text-uppercase" disabled></td>
												<td>District</td>
												<td><input type="text"  value="<?php echo strtoupper($dist);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text"  value="<?php echo strtoupper($pincode);?>" class="form-control text-uppercase" disabled></td>
												<td>Mobile</td>
												<td><input type="text"  value="<?php echo "+91 ".strtoupper($mobile_no);?>" class="dob form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Phone Number</td>
												<td><input type="text"  value="<?php echo strtoupper($landline_std)." - ".strtoupper($landline_no);?>" class="form-control text-uppercase" disabled></td>
												<td>Email-id</td>
												<td><input type="text"  value="<?php echo $email;?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td colspan="4">2. (a) Name and location of the industrial unit / premises for which the application is made. (Give revenue Survey Number /plot number, name of Taluka and District also telephone)</td>
											</tr>
											<tr>
												<td>Name</td>
												<td><input type="text"  value="<?php echo strtoupper($unit_name);?>" class="form-control text-uppercase" disabled></td>
												<td>Street Name 1</td>
												<td><input type="text"  value="<?php echo strtoupper($b_street_name1);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Street Name 2</td>
												<td><input type="text"  value="<?php echo strtoupper($b_street_name2);?>" class="form-control text-uppercase" disabled></td>
												<td>Village/Town</td>
												<td><input type="text"  value="<?php echo strtoupper($b_vill);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>												
												<td>District</td>
												<td><input type="text"  value="<?php echo strtoupper($b_dist);?>" class="form-control text-uppercase" disabled></td>
												<td>Pincode</td>
												<td><input type="text"  value="<?php echo strtoupper($b_pincode);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>												
												<td>Mobile</td>
												<td><input type="text"   value="<?php echo "+91 ".strtoupper($b_mobile_no);?>" class="form-control text-uppercase" disabled></td>
												<td>Phone Number</td>
												<td><input type="text"  value="<?php echo strtoupper($b_landline_std)." - ".strtoupper($b_landline_no);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>												
												<td>Email-id</td>
												<td><input type="text" value="<?php echo $b_email;?>" class="form-control" disabled></td>
												<td>Revenue Survey Number /<br/> Plot Number<span class="mandatory_field">*</span></td></td>
												<td><input type="text" class="form-control text-uppercase" name="revenue_survey_no" placeholder="Revenue Survey Number / Plot Number" value="<?php echo strtoupper($revenue_survey_no);?>" required="required"></td>											
											</tr>
											<tr>
												<td colspan="4">(b) Details of the planning permission obtained from the local body / Town and Country Planning authority / metropolitan development authority / designate authority</td>
											</tr>
											<tr>												
												<td>Permission Reference No. </td>
												<td><input type="text"  name="plan_details[prn]" value="<?php echo strtoupper($plan_details_prn);?>" placeholder="Permission Reference No." class="form-control text-uppercase" ></td>
												<td>Date <span class="mandatory_field">*</span></td></td>
												<td><input type="datetime" name="plan_details[dt]" value="<?php if($plan_details_dt!="0000-00-00" && $plan_details_dt!="") echo date('d-m-Y',strtotime($plan_details_dt));else echo "";?>" placeholder="DD-MM-YYYY" class="dobindia form-control text-uppercase" readonly required="required"></td>				
											</tr>
											<tr>												
												<td>Issuing Authority </td>
												<td><input type="text"  name="plan_details[ia]" value="<?php echo strtoupper($plan_details_ia);?>" placeholder="Name of Issuing Authority" class="form-control text-uppercase" ></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>				
											</tr>
											<tr>		

												<td>Upload File</td>
												<td width="30%">
													<select trigger="FileModal" id="file1" class="form-control">                                            
														<option value="0" selected="selected"><?php echo uploadinfo($plan_details_upload); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
													<input type="hidden" name="plan_details[upload]" id="mfile1" value="<?php echo $plan_details_upload !== '' ? $plan_details_upload : ''; ?>" />
												</td>
												<td width="20%" id="tdfile1">
													<?php if($plan_details_upload!="" && $plan_details_upload!="SC" && $plan_details_upload!="NA"){ echo '<a href="'.$upload.$plan_details_upload.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
												
											</tr>
											<tr>
												<td colspan="4">(c) Name of the local body under whose jurisdiction the unit is located and name of the licence issuing authority</td>
											</tr>
											<tr>
												<td>Local Body Name</td>
												<td><input type="text" class="form-control text-uppercase"  value="<?php echo strtoupper($lb_name);?>" placeholder="Name of the local body" name="lb_name"></td>
												<td>Licence Issuing Authority</td>
												<td><input type="text" class="form-control text-uppercase"  value="<?php echo strtoupper($lb_auth_name);?>" placeholder="Licence Issuing Authority" name="lb_auth_name"></td>
											</tr>
											
											<tr>
												<td colspan="4">3. Names, addresses with telephone of Managing Director/Managing Partner and officer responsible for matters connected with pollution control and / or hazardous waste disposal.</td>
											</tr>
											<tr>
												<td>Name</td>
												<td><input type="text" class="form-control text-uppercase" validate="letters" value="<?php echo strtoupper($md_name);?>" placeholder="Name of Officer" name="md_name"></td>
												<td>Designation</td>
												<td><input type="text" class="form-control text-uppercase"  value="<?php echo strtoupper($m_desig);?>" placeholder="Designation" name="md_address[desig]"></td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase"   value="<?php echo strtoupper($m_sn1);?>" placeholder="Street Name 1" name="md_address[st1]"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase"  value="<?php echo strtoupper($m_sn2);?>" placeholder="Street Name 2" name="md_address[st2]"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase"  value="<?php echo strtoupper($m_v);?>" placeholder="Village/Town" name="md_address[vill]"></td>
												<td>District</td>
												<td>
													<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
													<select name="md_address[dist]" id="" class="form-control text-uppercase" ><?php
														while($dstrows=$dstresult->fetch_object()) { 
															if(isset($m_d) && ($m_d==$dstrows->district)) $s='selected'; else $s=''; ?>
															<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
														<?php } ?>					
													</select>
												</td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($m_p);?>" validate="pincode" maxlength="6" placeholder="Enter 6 digit pincode" name="md_address[pin]"></td>
												<td>Mobile Number</td>
												<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" value="<?php echo strtoupper($m_m);?>"  placeholder="Enter 10 digit mobile number" name="md_address[mn]"></td>
											</tr>
											<tr>
												<td>Phone Number</td>
												<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo strtoupper($m_phn);?>" maxlength="13"  placeholder="Phone Number" name="md_address[phn]"></td>
												<td>Email-id</td>
												<td><input type="email" class="form-control" value="<?php echo $m_e;?>" placeholder="e.g : example@gmail.com" name="md_address[email]"></td>
											</tr>
											<tr>
												<td colspan="2">4. (a) Are you registered as a small-scale industrial unit ?</td>
												<td colspan="2">
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_registered=="Y" || $is_registered=="") echo "checked"; ?> id="inlineRadio1" name="is_registered"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_registered=="N") echo "checked"; ?> id="inlineRadio1" name="is_registered"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="4">(b) If yes, give the number and date of registration.</td>
											</tr>
											<tr>
												<td> Registration Number</td>
												<td><input type="text" class="is_registered form-control text-uppercase" name="reg_no"  placeholder="Registration Number" value="<?php echo $reg_no; ?>" <?php if($is_registered=='N') echo 'disabled'; ?> ></td>
												<td>Date of Registration</td>
												<td><input type="text" name="reg_date" class="is_registered dobindia form-control text-uppercase" value="<?php if($reg_date!="0000-00-00" && $reg_date!="") echo date('d-m-Y',strtotime($reg_date));else echo "";?>" placeholder="DD-MM-YYYY" readonly <?php if($is_registered=='N') echo 'disabled'; ?> ></td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">&nbsp;</td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">
													<button type="submit" name="save1a"  class="btn btn-success text-bold submit1">Save and Next</button>
												</td>												
											</tr>
										</table>
										</form>
									</div>
									<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="2">5. Gross capital investment of the unit without depreciation till the date of application(Cost of building, land,plant and machinery)<span class="mandatory_field"> *</span></td></td>
												<td><input type="text" class="form-control text-uppercase" name="investment_cost[a]" placeholder="Gross capital investment" date-toogle="tooltip" title="Numbers Only" validate="onlyNumbers" value="<?php echo $investment_cost_a;?>"></td>
												<td><select name="investment_cost[b]" required="required" class="form-control text-uppercase" >
														<option value="">Please Select</option>
														<option <?php if($investment_cost_b=="C") echo "selected"; ?> value="C">In Crore</option>
														<option <?php if($investment_cost_b=="L") echo "selected"; ?> value="L">In Lakhs</option>
													</select>
												</td>									
											</tr>
											<tr>
												<td colspan="4">(To be supported by an affidavit, Annual Report or certificate from a Chartered Accountant.For proposed unit(s), give estimated figure)</td>
											</tr>
											<tr>
												<td>Upload File</td>
												<td width="30%">
													<select trigger="FileModal" id="file4" class="form-control">                                            
														<option value="0" selected="selected"><?php echo uploadinfo($investment_certificate); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
													<input type="hidden" name="investment_certificate" id="mfile4" value="<?php echo $investment_certificate !== '' ? $investment_certificate : ''; ?>" />
												</td>
												<td width="20%" id="tdfile4">
													<?php if($investment_certificate!="" && $investment_certificate!="SC" && $investment_certificate!="NA"){ echo '<a href="'.$upload.$investment_certificate.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
												
											</tr>
											<tr >
												<td colspan="4">6. If the site is located near sea-shore / river bank / other water bodies; indicate the distance and the name of the water body, if any</td>
											</tr>
											<tr>
												<td>Distance<span class="mandatory_field"> *</span></td></td>
												<td>
												<input type="text" name="site_distance[a]" validate="decimal" value="<?php echo $site_distance_a;?>" placeholder="Distance" date-toogle="tooltip" title="Number with 2 digits after decimal point" class="form-control text-uppercase">
													<select name="site_distance[b]" required="required" class="form-control text-uppercase">
														<option value="">Choose a Unit</option>
														<option value="F" <?php if($site_distance_b=="F") echo "selected"; ?>>Feet</option>
														<option value="M" <?php if($site_distance_b=="M") echo "selected"; ?>>Meter</option>
														<option value="K" <?php if($site_distance_b=="K") echo "selected"; ?>>Kilo Meter</option>
													</select>
												</td>
												<td>Name of the water body</td>
												<td><input type="text" name="wb_name" placeholder="Name of the water body"  value="<?php echo $wb_name?>" class="form-control text-uppercase"></td>										
											</tr>
											<tr>
												<td colspan="2">7. Does the location satisfy the requirements under relevant Central / State Govt. <br/>notifications such as Coastal Regulation Zone, Notification on Ecologically Fragile Area,<br/> Industrial location policy, etc. If so, give details.<span class="mandatory_field"> *</span></td></td>
												<td>
													<select required="required" name="loc_feedback_select" class="form-control">
														<option value="">Please Select</option>
														<option <?php if(!empty($loc_feedback)) echo "selected"; ?> value="A">Applicable</option>
														<option value="N">Not Applicable</option>
													</select>
												</td>								
												<td><textarea class="form-control text-uppercase" <?php if(empty($loc_feedback)) echo "readonly='readonly'"; ?> placeholder="Details" name="loc_feedback" id="loc_feedback"><?php echo $loc_feedback; ?></textarea></td>								
											</tr>
											<tr>
												<td colspan="2">8. If the site is situated in notified industrial estate </td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_situated=="Y" || $is_situated=="") echo "checked"; ?> id="inlineRadio1" name="is_situated"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_situated=="N") echo "checked"; ?> id="inlineRadio1" name="is_situated"> No </label></td>
											</tr>
											<tr>
												<td colspan="2">a) whether effluent collection, treatment and disposal system has been provided by the authority</td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_provided=="Y" || $is_provided=="") echo "checked"; ?> id="inlineRadio1" name="is_provided"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_provided=="N") echo "checked"; ?> id="inlineRadio1" name="is_provided"> No </label></td>
											</tr>
											<tr>
												<td colspan="2">(b) will the applicant utilise the system, if provided</td>
												<td colspan="2"><input type="text" id="is_provided_yes" name="is_use" value="<?php echo $is_use;?>" class="form-control text-uppercase"  ></td>	
											</tr>
											<tr>
												<td>c) if not provided, details of proposed arrangement.</td>
												
												
										<td width="30%">
											<select trigger="FileModal" id="file2" class="form-control text-uppercase file2">                                            
												<option value="0" selected="selected"><?php echo uploadinfo($is_not_details); ?></option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
												<option value="4">Send by Courier</option>
												<option value="3">Not Applicable</option>
											</select>
										<input type="hidden" name="is_not_details" id="mfile2" value="<?php echo $is_not_details !== '' ? $is_not_details : ''; ?>" />
									</td>
									<td width="20%" id="tdfile2">
												<?php if($is_not_details!="" && $is_not_details!="SC" && $is_not_details!="NA"){ echo '<a href="'.$upload.$is_not_details.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
									</td>
												
												
											</tr>
											<tr>
												<td colspan="2" rowspan="3">9. Total plot area, built-up area and area available for the use of treated sewage / trade effluent<span class="mandatory_field"> *</span></td></td>
												<td><input type="text" name="total_area[pa]" validate="decimal" value="<?php echo $total_area_pa;?>" class="form-control text-uppercase" placeholder="Plot Area"/></td>
												<td>
													<select name="total_area[pau]" required="required" class="form-control text-uppercase">
														<option value="">Choose a Unit</option>
														<option value="F" <?php if($total_area_pau=="F") echo "selected"; ?>>Square Feet</option>
														<option value="M" <?php if($total_area_pau=="M") echo "selected"; ?>>Square Meter</option>
													</select>
												</td>
											</tr>
											<tr>		
												<td><input type="text" name="total_area[ba]" validate="decimal" value="<?php echo $total_area_ba;?>" class="form-control text-uppercase" placeholder="Build-up Area"/></td>
												<td>
													<select name="total_area[bau]" required="required" class="form-control text-uppercase">
														<option>Choose a Unit</option>
														<option value="F" <?php if($total_area_bau=="F") echo "selected"; ?>>Square Feet</option>
														<option value="M" <?php if($total_area_bau=="M") echo "selected"; ?>>Square Meter</option>
													</select>
												</td>
											</tr>
											<tr>
												<td><input type="text" name="total_area[sa]" validate="decimal" value="<?php echo $total_area_sa;?>" class="form-control text-uppercase" placeholder="Area for Treated Sewage"/></td>	
												<td>
													<select name="total_area[sau]" required="required" class="form-control text-uppercase">
														<option value="">Choose a Unit</option>
														<option value="F" <?php if($total_area_sau=="F") echo "selected"; ?>>Square Feet</option>
														<option value="M" <?php if($total_area_sau=="M") echo "selected"; ?>>Square Meter</option>
													</select>
												</td>										
											</tr>
											<tr >										
												<td colspan="2">10. Month and year of proposed commissioning of the unit<span class="mandatory_field"> *</span></td></td>
												<td><select name="commission_my[m]" required="required" class="form-control text-uppercase">
														<option value="" >Please select a month</option>
														<option value='January' <?php if($commission_my_m=='January') echo "selected"; ?> >January</option>
														<option value='February' <?php if($commission_my_m=='February') echo "selected"; ?> >February</option>
														<option value='March' <?php if($commission_my_m=='March') echo "selected"; ?> >March</option>
														<option value='April' <?php if($commission_my_m=='April') echo "selected"; ?> >April</option>
														<option value='May' <?php if($commission_my_m=='May') echo "selected"; ?> >May</option>
														<option value='June' <?php if($commission_my_m=='June') echo "selected"; ?> >June</option>
														<option value='July' <?php if($commission_my_m=='July') echo "selected"; ?> >July</option>
														<option value='August' <?php if($commission_my_m=='August') echo "selected"; ?> >August</option>
														<option value='September' <?php if($commission_my_m=='September') echo "selected"; ?> >September</option>
														<option value='October' <?php if($commission_my_m=='October') echo "selected"; ?> >October</option>
														<option value='November' <?php if($commission_my_m=='November') echo "selected"; ?> >November</option>
														<option value='December' <?php if($commission_my_m=='December') echo "selected"; ?> >December</option>												
													</select></td>
												<td>
													<select required="required" name="commission_my[y]" class="form-control text-uppercase">
														<option value="">Please select a year</option>
														<?php for($i=1947;$i<2050;$i++){ ?>
															<option <?php if($commission_my_y==$i) echo "selected"; ?> value="<?php echo $i;?>"><?php echo $i;?></option>
														<?php } ?>
													</select>
												</td>										
											</tr>
											<tr>
												<td colspan="2">11. Number of workers and office staff.</td>
												<td ><input type="number" class="form-control text-uppercase"   value="<?php echo $staff_nos; ?>"  name="staff_nos" /></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="3">12.(a) Do you have a residential colony within the premises in respect of which the present application is made ?</td>
												<td>
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_res_colony=="Y" || $is_res_colony=="") echo "checked"; ?> name="is_res_colony"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_res_colony=="N") echo "checked"; ?> name="is_res_colony"> No </label>
												</td>
											</tr>									
											<tr>
												<td colspan="2">(b) If yes, please state population staying</td>
												<td colspan="2"><input type="text" id="field12b" <?php if($is_res_colony=="N") echo "disabled"; ?> class="form-control text-uppercase" name="colony_details[pop]" value="<?php echo $colony_details_pop; ?>" placeholder="Population" /></td>
											</tr>									
											<tr>
												<td colspan="2">(c) Indicate its location and distance with reference to plant site.</td>
												<td><input type="text" id="field12c1" name="colony_details[loc]"  value="<?php echo $colony_details_loc; ?>" class="form-control text-uppercase" <?php if($is_res_colony=="N") echo "disabled"; ?> placeholder="LOCATION" /></td>
												<td><input type="text" id="field12c2" name="colony_details[dis]"  value="<?php echo $colony_details_dis; ?>" class="form-control text-uppercase" <?php if($is_res_colony=="N") echo "disabled"; ?> placeholder="DISTANCE" /></td>
											</tr>
											<tr>
												<td colspan="4">
													13. List of products and by-products manufactured in tonnes / month,kl / month or numbers / month (Give figure corresponding to maximum installed production capacity)
												</td>
											</tr>
											<tr>
											<td colspan="4">
												<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
													<thead>
													<tr>
														<th>Sl No.</th>
														<th>Name</th>
														<th>Type<span class="mandatory_field"> *</span></td></th>
														<th>Quantity</th>
														<th>Units<span class="mandatory_field"> *</span></td></th>	
													</tr>
													</thead>
													<?php
													$part1=$pcb->query("select * from pcb_form1_products where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["name"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txtB<?php echo $count;?>" placeholder="Name of product" class="form-control text-uppercase"; name="txtB<?php echo $count;?>"></td>
														<td>
														<select required="required" id="txtC<?php echo $count;?>" name="txtC<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option <?php if($row_1["product_type"]=="P") echo "selected"; ?> value='P' >Product</option>
															<option <?php if($row_1["product_type"]=="B") echo "selected"; ?> value='B' >By-product</option>
														</select>
														</td>				
														<td><input value="<?php echo $row_1["qty"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase"; name="txtD<?php echo $count;?>" placeholder="Quantity"  title="Numbers only"></td>
														<td>
														<select required="required" id="txtE<?php echo $count;?>" name="txtE<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option <?php if($row_1["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
															<option <?php if($row_1["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
															<option <?php if($row_1["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
														</select></td>
													</tr>	
													<?php $count++; 
													} 
													}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input id="txtB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase" placeholder="Name of product" name="txtB1"></td>					
														<td><select required="required" id="txtC1" name="txtC1" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option value='P' >Product</option>
															<option value='B' >By-product</option>
														</select></td>
														<td><input id="txtD1" class="form-control text-uppercase"  name="txtD1" placeholder="Quantity"  title="Numbers only"></td>
														<td>														
														<select required="required" id="txtE1" name="txtE1" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option value='T' >in tonnes / month</option>
															<option value='K' >in kl / month</option>
															<option value='N' >in numbers / month</option>
														</select>
														</td>
													</tr>
													<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
											</tr>
											<tr>
												<td colspan="4">14. List of raw materials and process chemicals with annual consumption corresponding to above stated production figures, in tonnes / month or kl / month or numbers / month.</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable2" class="table table-responsive table-bordered " id="objectTable2" >
													<thead>
													<tr>
														<th>Sl No.</th>
														<th>Name</th>
														<th>Type<span class="mandatory_field"> *</span></td></th>
														<th>Quantity</th>
														<th>Units<span class="mandatory_field"> *</span></td></th>
													</tr>
													</thead>
													<?php
														$part1=$pcb->query("select * from pcb_form1_materials where form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
														 <tr>
															<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input value="<?php echo $row_1["name"]; ?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>" placeholder="Raw materials/process chemicals"></td>
															<td>
															<select required="required" id="textC<?php echo $count;?>" name="textC<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option <?php if($row_1["material_type"]=="R") echo "selected"; ?> value='R' >Raw material</option>
															<option <?php if($row_1["material_type"]=="C") echo "selected"; ?> value='C' >Process chemical</option>
														</select></td>				
															<td><input value="<?php echo $row_1["qty"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="15" placeholder="Quantity"></td>
															<td><select required="required" id="textE<?php echo $count;?>" name="textE<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option <?php if($row_1["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
															<option <?php if($row_1["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
															<option <?php if($row_1["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
														</select></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
													  <td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
													  <td><input id="textB1" size="20" class="form-control text-uppercase" name="textB1" placeholder="Raw materials/process chemicals"></td>					
													  <td><select required="required" id="textC1" name="textC1" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option value='R' >Raw material</option>
															<option value='C' >Process chemical</option>
														</select>
														</td>
													  <td><input id="textD1" size="15" class="form-control text-uppercase" name="textD1" placeholder="Quantity"></td>
													  <td><select required="required" id="textE1" name="textE1" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option value='T' >in tonnes / month</option>
															<option value='K' >in kl / month</option>
															<option value='N' >in numbers / month</option>
														</select></td>
													</tr>
													<?php } ?>
												</table>
												<button type="button" href="#" onclick="mydelfunction2()" value="" class="btn btn-default pull-right">Delete</button>
												<button type="button" onclick="addMorefunction2()" class="btn btn-default pull-right" value="">Add More</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></td>
											</tr>
											<tr>
												<td colspan="4">15. Description of process of manufacture for each of the products showing input, output, quality and quantity of solid, liquid and gaseous wastes, if any from each unit process. (To be supported by flow sheet and / or material balance and water balance sheet).</td>
											</tr>
											<tr>
												<td>Upload File</td>
												<td width="30%">
											<select trigger="FileModal" id="file3" class="form-control">                                            
												<option value="0" selected="selected"><?php echo uploadinfo($process_desc); ?></option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
												<option value="4">Send by Courier</option>
												<option value="3">Not Applicable</option>
											</select>
										<input type="hidden" name="process_desc" id="mfile3" value="<?php echo $process_desc !== '' ? $process_desc : ''; ?>" />
										</td>
										<td width="20%" id="tdfile3">
													<?php if($process_desc!="" && $process_desc!="SC" && $process_desc!="NA"){ echo '<a href="'.$upload.$process_desc.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
											</tr>
											
											<tr>
												<td class="text-center" colspan="4">
													<a href="form1.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save1b" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>	
									<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
										<form name="myform1" class="myform1 submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4"><strong>Part B : Waste water aspects</strong></td>
											</tr>
											<tr>
												<td colspan="4">16. Water consumption for different uses (in m3 / day)</td>
											</tr>
											<tr>
												<td style="width:25%">(i) Industrial cooling, spraying - in mine pits or boiler feeds.<span class="mandatory_field"> *</span></td></td>
												<td style="width:25%"><input type="text" validate="decimal" required="required" name="wc_values[a]" placeholder="example : 23.00" title="Please enter a decimal value" value="<?php echo $wc_values_a; ?>" class="form-control text-uppercase wc_sum"></td>
												<td style="width:25%">(ii) Domestic purpose</td>
												<td style="width:25%"><input type="text" validate="decimal" name="wc_values[b]"  value="<?php echo $wc_values_b; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class=" form-control text-uppercase wc_sum"></td>
											</tr>
											<tr>
												<td >(iii) Processing whereby water gets polluted and the pollutants are easily biodegradable</td>
												<td><input type="text" validate="decimal" name="wc_values[c]" value="<?php echo $wc_values_c; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class="form-control text-uppercase wc_sum"></td>
												<td>(iv) Processing whereby water gets polluted and the pollutants are not easily bio-degradable and are toxic</td>
												<td><input type="text" validate="decimal" name="wc_values[d]" value="<?php echo $wc_values_d; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class=" form-control text-uppercase wc_sum"></td>
											</tr>
											<tr>
												<td >(v) Others such as agriculture, gardening etc. (specify)</td>
												<td><input type="text" validate="decimal" name="wc_values[e]" value="<?php echo $wc_values_e; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class="form-control text-uppercase wc_sum"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td ><strong>TOTAL</strong></td>
												<td><input type="text" name="wc_values[f]" id="wc_values_total" readonly="readonly" value="<?php echo $wc_values_f; ?>" class="form-control text-uppercase"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td rowspan="3" colspan="2">17. Source of water supply. Name of authority granting permission if applicable and quantity permitted </td>
												<td>Source of water supply</td>
												<td><input type="text" name="water_source[a]" placeholder="Source of water supply" value="<?php echo $water_source_a;?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Name of authority granting permission if applicable</td>
												<td><input type="text" name="water_source[b]"  value="<?php echo $water_source_b;?>" placeholder="Name of authority" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Quantity permitted (in m3/day)</td>
												<td><input type="text" name="water_source[c]"  value="<?php echo $water_source_c;?>" placeholder="Quantity permitted" title=" Valid number with 2 digits after decimal point" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="4">18. Quantity of waste water (effluent) generated (in m3 / day) </td>
											</tr>
											<tr>
												<td>(i) Domestic </td>
												<td><input type="text" name="ww_qty[a]" value="<?php echo $ww_qty_a;?>"  title="Please enter a decimal value" class="form-control text-uppercase"></td>
												<td>(ii) Industrial</td>
												<td><input type="text" name="ww_qty[b]"  value="<?php echo $ww_qty_b;?>"  title="Please enter a decimal value" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>(iii) Process </td>
												<td><input type="text" name="ww_qty[c]"  value="<?php echo $ww_qty_c;?>"  title="Please enter a decimal value" class="form-control text-uppercase"></td>
												<td>(iv) Washings </td>
												<td><input type="text" name="ww_qty[d]"  value="<?php echo $ww_qty_d;?>"  title="Please enter a decimal value" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>(v) Boiler Blowdown </td>
												<td><input type="text" name="ww_qty[e]"  value="<?php echo $ww_qty_e;?>"  title="Please enter a decimal value" class="form-control text-uppercase"></td>
												<td>(vi) Cooling water blowdown </td>
												<td><input type="text" name="ww_qty[f]"  value="<?php echo $ww_qty_f;?>" title="Please enter a decimal value" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>(vii) DM Plant / Softening Plant washings</td>
												<td><input type="text" name="ww_qty[g]"  value="<?php echo $ww_qty_g;?>"  title="Please enter a decimal value" class="form-control text-uppercase"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="2">19. Water budget calculations accounting for difference between water consumption and effluent generated. :</td>
												<td><input type="text" name="budget_calc[a]"  value="<?php echo $budget_calc_a; ?>" placeholder="Water budget calculation" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Upload File</td>
												
												<td width="30%">
											<select trigger="FileModal" id="file5" class="form-control">                                            
												<option value="0" selected="selected"><?php echo uploadinfo($budget_calc_b); ?></option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
												<option value="4">Send by Courier</option>
												<option value="3">Not Applicable</option>
											</select>
													<input type="hidden" name="budget_calc[b]" id="mfile5" value="<?php echo $budget_calc_b !== '' ? $budget_calc_b : ''; ?>" />
										</td>
										<td width="20%" id="tdfile5">
													<?php if($budget_calc_b!="" && $budget_calc_b!="SC" && $budget_calc_b!="NA"){ echo '<a href="'.$upload.$budget_calc_b.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
												
											</tr>
									
											<tr>
												<td colspan="2">20. Present treatment of sewage / canteen effluent (Give sizes / capacities of treatment units).	</td>
												<td colspan="2"><input type="text" name="sewage_treatment"  value="<?php echo $sewage_treatment; ?>" placeholder="sizes / capacities of treatment units" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="form1.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save1c" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
										<form name="myform1" class="myform1 submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">21. Present treatment of trade effluent (Give sizes / capacities of treatment units). (A schematic diagram of the treatment scheme with inlet / outlet characteristics of each unit operation / process is to be provided. Include details of residue management system (ETP sludges)) </td>
											</tr>
											<tr>
												<td>Upload File</td>
												<td width="30%">
														<select trigger="FileModal" id="file6" class="form-control">                                            
															<option value="0" selected="selected"><?php echo uploadinfo($trade_treatment); ?></option>
															<option value="1">From E-Locker</option>
															<option value="2">From PC</option>
															<option value="4">Send by Courier</option>
															<option value="3">Not Applicable</option>
														</select>
															<input type="hidden" name="trade_treatment" id="mfile6" value="<?php echo $trade_treatment !== '' ? $trade_treatment : ''; ?>" />
												</td>
												<td width="20%" id="tdfile6">
															<?php if($trade_treatment!="" && $trade_treatment!="SC" && $trade_treatment!="NA"){ echo '<a href="'.$upload.$trade_treatment.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td>22. (a) Are sewage and trade effluents mixed together ? </td>
												<td><label class="radio-inline"><input type="radio" <?php if($is_mixed=="Y") echo "checked"; ?> value="Y" id="inlineRadio1" name="is_mixed" required="required"> Yes </label>
													<label class="radio-inline"><input type="radio" <?php if($is_mixed=="N" || $is_mixed=="") echo "checked"; ?> value="N" id="inlineRadio1" name="is_mixed"> No </label></td>
												<td>(b) If yes, state at which stage - whether  <br/>before, intermittently or after treatment.</td>
												<td><input type="text" name="yes_detail" <?php if($is_mixed=="N" || $is_mixed=="") echo "disabled='disabled'"; ?> id="yes_detail" value="<?php echo $yes_detail; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td style="width:25%">23. Capacity of treated effluent sump. Guard Pond if any.</td>
												<td style="width:25%"><label class="radio-inline"><input type="radio" <?php if($sump_capacity!=NULL) echo "checked"; ?> value="Y" id="inlineRadio1" name="sump_capacity_radio"> Yes </label>
													<label class="radio-inline"><input type="radio" <?php if($sump_capacity==NULL) echo "checked"; ?> value="N" id="inlineRadio1" name="sump_capacity_radio"> No </label></td>
												
												<td style="width:25%"><input type="text" name="sump_capacity[a]" value="<?php echo $sump_capacity_a; ?>" <?php if($sump_capacity==NULL) echo "disabled='disabled'"; ?>  class="form-control text-uppercase sump_capacity"></td>
												<td style="width:25%"><input type="text" name="sump_capacity[b]" placeholder="Quantity in m3/day" value="<?php echo $sump_capacity_b; ?>" <?php if($sump_capacity==NULL) echo "disabled='disabled'"; ?> class="form-control text-uppercase sump_capacity"></td>
											</tr>
											<tr>
												<td colspan="4">24. Mode of disposal of treated effluents, with respective quantity, in m3 / day</td>
											</tr>
											<tr>
												<td>(i) into stream / river (Name of river)</td>
												<td><input type="text" name="disposal_mode[a]"  placeholder="Mode of disposal" value="<?php echo $disposal_mode_a; ?>" class="form-control text-uppercase"><input type="text" placeholder="Name of river" name="disposal_mode[b]" value="<?php echo $disposal_mode_b; ?>" class="form-control text-uppercase">	</td>
												
												<td>(ii) into creek / estuary (Name of creek/estuary)</td>
												<td><input type="text" name="disposal_mode[c]"  placeholder="Mode of disposal" value="<?php echo $disposal_mode_c; ?>" class="form-control text-uppercase"><input type="text" placeholder="Name of creek/ estuary" name="disposal_mode[d]" value="<?php echo $disposal_mode_d; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>(iii) into sea (Name of sea)</td>
												<td><input type="text" name="disposal_mode[e]"  placeholder="Mode of disposal" value="<?php echo $disposal_mode_e; ?>" class="form-control text-uppercase"><input type="text" placeholder="Name of sea" name="disposal_mode[f]" value="<?php echo $disposal_mode_f; ?>" class="form-control text-uppercase"></td>
												
												<td>(iv) into drain / sewer (Owner of sewer) </td>
												<td><input type="text" name="disposal_mode[g]"  placeholder="Mode of disposal" value="<?php echo $disposal_mode_g; ?>" class="form-control text-uppercase"><input type="text" placeholder="Owner of sewer" name="disposal_mode[h]" value="<?php echo $disposal_mode_h; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="3">(v) On land for irrigation on owned land / lease land. Specify cropped area.</td>
												<td><input type="text" name="disposal_mode[i]"  value="<?php echo $disposal_mode_i; ?>" placeholder="Cropped Area in sq. meters" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="3">(vi) Quantity of treated effluent reused / recycled,in m3 / day Provide a location map of disposal arrangement indicating the outlet (s) for sampling in upload section</td>
												<td><input type="text" name="disposal_mode[j]" placeholder="Quantity" value="<?php echo $disposal_mode_j; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="3">(vii) Provide a location map of disposal arrangement indicating the outlet(s) for sampling.</td>
												<td>(Upload Later in Upload Section)</td>
											</tr>
											<tr>
												<td colspan="2" rowspan="3">25. (a) Quality of untreated / treated effluents (Specify pH and concentration of SS, BOD, COD and specific pollutants relevant to the industry. TDS to be reported</td>
												<td><input type="text" name="effluents_quality[a]" validate="onlyNumbers" value="<?php echo $effluents_quality_a;?>" placeholder="pH" class="form-control text-uppercase"></td>
												<td><input type="text" name="effluents_quality[b]"  value="<?php echo $effluents_quality_b;?>" placeholder="Concentration of Suspended Solid" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td><input type="text" name="effluents_quality[c]" value="<?php echo $effluents_quality_c;?>" placeholder="Biochemical Oxygen Demand" class="form-control text-uppercase"></td>
												<td><input type="text" name="effluents_quality[d]"value="<?php echo $effluents_quality_d;?>" placeholder="Chemical Oxygen Demand" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td><input type="text" name="effluents_quality[e]"  value="<?php echo $effluents_quality_e;?>" placeholder="Specific Pollutants" class="form-control text-uppercase"></td>
												<td><input type="text" name="effluents_quality[f]"  value="<?php echo $effluents_quality_f;?>" placeholder="Total Disolved Solids" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="4">(b) Enclose a copy of the latest report of analysis from the laboratory approved by State Board / Committee / Central Board / Central Government in the Ministry of Environment & Forests. For proposed unit furnish expected characteristics of the untreated / treated effluent. </td>
											</tr>
											<tr>
												<td>Upload File</td>
												
													
													
													<td width="30%">
													<select trigger="FileModal" id="file7" class="form-control">                                            
														<option value="0" selected="selected"><?php echo uploadinfo($laboratory_report); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
														<input type="hidden" name="laboratory_report" id="mfile7" value="<?php echo $laboratory_report !== '' ? $laboratory_report : ''; ?>" />
											</td>
											<td width="20%" id="tdfile7">
														<?php if($laboratory_report!="" && $laboratory_report!="SC" && $laboratory_report!="NA"){ echo '<a href="'.$upload.$laboratory_report.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
											</td>
													
													
													
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="form1.php?tab=3" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save1d" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4"><strong>Part - C : Air emission aspects</strong></td>
											</tr>
											<tr>
												<td colspan="4">26. Fuel consumption</td>
											</tr>
											<tr>
												<td colspan="4">
												 <table class="table table-responsive table-bordered">
													<tr>
														<td></td>
													  <td>Coal</td>
													  <td>LSHS</td>
													  <td>Furnace Oil</td>
													  <td>Natural gas</td>
													  <td>Others (Specify) <input type="text" class="form-control text-uppercase" name="fc[ot][sp1]" value="<?php echo $fc_ot_sp1; ?>" /></td>
													</tr>
													<tr>
													  <td>Fuel consumption (TPD / KLD)</td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][cl]" value="<?php echo $fc_tpd_cl; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][ls]" value="<?php echo $fc_tpd_ls; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][fo]" value="<?php echo $fc_tpd_fo; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][ng]" value="<?php echo $fc_tpd_ng; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][ot]" value="<?php echo $fc_tpd_ot; ?>" placeholder="Example: 23.00" title="Please enter a decimal value"  validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Calorific value</td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][cl]" value="<?php echo $fc_cv_cl; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][ls]" value="<?php echo $fc_cv_ls; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][fo]" value="<?php echo $fc_cv_fo; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][ng]" value="<?php echo $fc_cv_ng; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][ot]" value="<?php echo $fc_cv_ot; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													</tr>
													<tr>
													  <td><p>Ash content % </p></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][cl]" value="<?php echo $fc_ac_cl; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][ls]" value="<?php echo $fc_ac_ls; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][fo]" value="<?php echo $fc_ac_fo; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][ng]" value="<?php echo $fc_ac_ng; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][ot]" value="<?php echo $fc_ac_ot; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal"/></td>
													</tr>
													<tr>
													  <td><p>Sulphur content % </p></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][cl]" value="<?php echo $fc_sc_cl; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][ls]" value="<?php echo $fc_sc_ls; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][fo]" value="<?php echo $fc_sc_fo; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][ng]" value="<?php echo $fc_sc_ng; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][ot]" value="<?php echo $fc_sc_ot; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Other  (specify) <input type="text" class="form-control text-uppercase" name="fc[ot][sp2]" value="<?php echo $fc_ot_sp2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][cl]" value="<?php echo $fc_ot_cl; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][ls]" value="<?php echo $fc_ot_ls; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][fo]" value="<?php echo $fc_ot_fo; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][ng]" value="<?php echo $fc_ot_ng; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][ot]" value="<?php echo $fc_ot_ot; ?>" placeholder="Example: 23.00" title="Please enter a decimal value" validate="decimal" /></td>
													</tr>
												  </table>
												</td>
											</tr>
											<tr>
												<td colspan="4">27. (A) Details  of stack (process &amp; fuel stacks)</td>
											</tr>
											<tr>
												<td colspan="4">
												<table  class="table table-responsive table-bordered">        
													<tr>
													  <td style="width:200px;">Stack  number (s) </td>
													  <td align="center">1</td>
													  <td align="center">2</td>
													  <td align="center">3</td>
													  <td align="center">4</td>
													</tr>
													<tr>
													  <td>Attached  to</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[at][sn1]" id="textfield112" value="<?php echo $sd_at_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[at][sn2]" id="textfield113" value="<?php echo $sd_at_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[at][sn3]" id="textfield114" value="<?php echo $sd_at_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[at][sn4]" id="textfield115" value="<?php echo $sd_at_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Capacity </td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ca][sn1]" id="textfield116" value="<?php echo $sd_ca_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ca][sn2]" id="textfield117" value="<?php echo $sd_ca_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ca][sn3]" id="textfield118" value="<?php echo $sd_ca_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ca][sn4]" id="textfield119" value="<?php echo $sd_ca_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Fuel type</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ft][sn1]" id="textfield120" value="<?php echo $sd_ft_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ft][sn2]" id="textfield121" value="<?php echo $sd_ft_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ft][sn3]" id="textfield122" value="<?php echo $sd_ft_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ft][sn4]" id="textfield123" value="<?php echo $sd_ft_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Fuel quantity (TPD / KLD)</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[fq][sn1]" id="textfield124" value="<?php echo $sd_fq_sn1; ?>" placeholder="in TPD / KLD" title="Please enter a decimal value"  /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[fq][sn2]" id="textfield125" value="<?php echo $sd_fq_sn2; ?>" placeholder="in TPD / KLD" title="Please enter a decimal value"  /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[fq][sn3]" id="textfield126" value="<?php echo $sd_fq_sn3; ?>"placeholder="in TPD / KLD" title="Please enter a decimal value" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[fq][sn4]" id="textfield127" value="<?php echo $sd_fq_sn4; ?>"placeholder="in TPD / KLD" title="Please enter a decimal value"  /></td>
													</tr>
													<tr>
													  <td>Material  of construction</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[mc][sn1]" id="textfield128" placeholder="Material" value="<?php echo $sd_mc_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[mc][sn2]" id="textfield129" placeholder="Material" value="<?php echo $sd_mc_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[mc][sn3]" id="textfield130" placeholder="Material" value="<?php echo $sd_mc_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[mc][sn4]" id="textfield131" placeholder="Material" value="<?php echo $sd_mc_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Shape (round / rectangular)</td>
													  <td><select name="sd[sh][sn1]" class="form-control text-uppercase">
															<option value="">Please Select</option>
															<option <?php if($sd_sh_sn1=="RO") echo "selected"; ?> value="RO">Round</option>
															<option <?php if($sd_sh_sn1=="RE") echo "selected"; ?> value="RE">Rectangular</option>
													  </select></td>
													  <td><select name="sd[sh][sn2]" class="form-control text-uppercase">
															<option value="">Please Select</option>	
															<option <?php if($sd_sh_sn2=="RO") echo "selected"; ?> value="RO">Round</option>
															<option <?php if($sd_sh_sn2=="RE") echo "selected"; ?> value="RE">Rectangular</option>
													  </select></td>
													  <td><select name="sd[sh][sn3]" class="form-control text-uppercase">
															<option value="">Please Select</option>
															<option <?php if($sd_sh_sn3=="RO") echo "selected"; ?> value="RO">Round</option>
															<option <?php if($sd_sh_sn3=="RE") echo "selected"; ?> value="RE">Rectangular</option>
													  </select></td>
													  <td><select name="sd[sh][sn4]" class="form-control text-uppercase">
															<option value="">Please Select</option>
															<option <?php if($sd_sh_sn4=="RO") echo "selected"; ?> value="RO">Round</option>
															<option <?php if($sd_sh_sn4=="RE") echo "selected"; ?> value="RE">Rectangular</option>
													  </select></td>
													</tr>
													<tr>
													  <td>Height,  m (above ground level) </td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gl][sn1]" id="textfield136" value="<?php echo $sd_gl_sn1; ?>" placeholder="in meters" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gl][sn2]" id="textfield137" value="<?php echo $sd_gl_sn2; ?>" placeholder="in meters" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gl][sn3]" id="textfield138" value="<?php echo $sd_gl_sn3; ?>" placeholder="in meters" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gl][sn4]" id="textfield139" value="<?php echo $sd_gl_sn4; ?>" placeholder="in meters" title="Please enter a decimal value" validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Diameter / size, in meters </td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ds][sn1]" id="textfield140" value="<?php echo $sd_ds_sn1; ?>" placeholder="in meters" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ds][sn2]" id="textfield141" value="<?php echo $sd_ds_sn2; ?>" placeholder="in meters" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ds][sn3]" id="textfield142" value="<?php echo $sd_ds_sn3; ?>"  placeholder="in meters" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ds][sn4]" id="textfield143" value="<?php echo $sd_ds_sn4; ?>" placeholder="in meters" title="Please enter a decimal value" validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Gas quantity, Nm3 /  hr</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gq][sn1]" id="textfield144" value="<?php echo $sd_gq_sn1; ?>" placeholder="in Nm3" title="Please enter a decimal value"   /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gq][sn2]" id="textfield145" value="<?php echo $sd_gq_sn2; ?>" placeholder="in Nm3" title="Please enter a decimal value"  /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gq][sn3]" id="textfield146" value="<?php echo $sd_gq_sn3; ?>"  placeholder="in Nm3" title="Please enter a decimal value" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gq][sn4]" id="textfield147" value="<?php echo $sd_gq_sn4; ?>" placeholder="in Nm3" title="Please enter a decimal value" /></td>
													</tr>
													<tr>
													  <td>Gas temperature, (<sup>0</sup>C) </td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gt][sn1]" id="textfield148" value="<?php echo $sd_gt_sn1; ?>" onchange="number(this.id)" placeholder="in degree celsius" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gt][sn2]" id="textfield149" value="<?php echo $sd_gt_sn2; ?>" onchange="number(this.id)" placeholder="in degree celsius" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gt][sn3]" id="textfield150" value="<?php echo $sd_gt_sn3; ?>" onchange="number(this.id)" placeholder="in degree celsius" title="Please enter a decimal value" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gt][sn4]" id="textfield151" value="<?php echo $sd_gt_sn4; ?>" onchange="number(this.id)" placeholder="in degree celsius" title="Please enter a decimal value" validate="decimal"/></td>
													</tr>
													<tr>
													  <td>Exit gas velocity, m / sec</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gv][sn1]" id="textfield152" value="<?php echo $sd_gv_sn1; ?>" placeholder="in m / sec" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gv][sn2]" id="textfield153" value="<?php echo $sd_gv_sn2; ?>" placeholder="in m / sec" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gv][sn3]" id="textfield154" value="<?php echo $sd_gv_sn3; ?>"placeholder="in m / sec" title="Please enter a decimal value" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gv][sn4]" id="textfield155" value="<?php echo $sd_gv_sn4; ?>" placeholder="in m / sec" title="Please enter a decimal value" validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Control equipment preceding the stack</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ce][sn1]" id="textfield156" value="<?php echo $sd_ce_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ce][sn2]" id="textfield157" value="<?php echo $sd_ce_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ce][sn3]" id="textfield158" value="<?php echo $sd_ce_sn3; ?>" /></td>
													  <td><input type="text"  class="form-control text-uppercase" name="sd[ce][sn4]" id="textfield159" value="<?php echo $sd_ce_sn4; ?>" /></td>
													</tr>													
												  </table>
												  </td>
											</tr>
											<tr>
												 <td colspan="4">Attach specifications including residue management systems of each of the control equipment indicating inlet / outlet concentrations of relevant pollutants)</td>
											</tr>
											<tr>
												<td>Upload File</td>
												
													
													<td width="30%">
													<select trigger="FileModal" id="file8" class="form-control">                                            
														<option value="0" selected="selected"><?php echo uploadinfo($spec_residue_report); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
																<input type="hidden" name="spec_residue_report" id="mfile8" value="<?php echo $spec_residue_report !== '' ? $spec_residue_report : ''; ?>" />
													</td>
													<td width="20%" id="tdfile8">
																<?php if($spec_residue_report!="" && $spec_residue_report!="SC" && $spec_residue_report!="NA"){ echo '<a href="'.$upload.$spec_residue_report.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
													</td>
													
											</tr>
											<tr>
												<td  style="width:75%" colspan="3">(B) Whether any release of odoriferous compounds such as Mercaptans, Phorate etc. are coming out</td>
												<td><label class="radio-inline"><input type="radio" <?php if($is_odoriferous=="Y") echo "checked"; ?> value="Y" name="is_odoriferous" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_odoriferous=="N") echo "checked"; ?> name="is_odoriferous"> No </label></td>
											</tr>
											<tr>
												<td  style="width:75%" colspan="3">28. Do you have adequate facility for collection of samples of emissions in the form of port holes, platform, ladder etc. as per Central Board Publication "Emission Regulations Part-III"(December 1985)<font color="red"><span class="mandatory_field"> *</span></td></font></td></td>
												<td>
												<label class="radio-inline"><input type="radio" value="Y" <?php if($is_adq_facility=="Y") echo "checked"; ?> id="inlineRadio1" name="is_adq_facility" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_adq_facility=="N") echo "checked"; ?> id="inlineRadio1" name="is_adq_facility"> No </label>
												<label class="radio-inline"><input type="radio" value="NA" <?php if($is_adq_facility=="NA") echo "checked"; ?> id="inlineRadio1" name="is_adq_facility"> Not Applicable </label></td>
											</tr>
											<tr>
												<td colspan="4">29. Quality of treated flue gas emissions and process emissions.(Specify concentration of criteria pollutants and industry / process-specific pollutants stack-wise.) Enclose a copy of the latest report of analysis from the approved laboratory by State Board / Central Board / Central Government in the Ministry of Environment and Forests. For proposed units furnish the expected characteristics of the emission.</td>
											</tr>
											<tr>
												<td>Upload File</td>
												<td width="30%">
													<select trigger="FileModal" id="file9" class="form-control">                                            
														<option value="0" selected="selected"><?php echo uploadinfo($gas_quality); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
														<input type="hidden" name="gas_quality" id="mfile9" value="<?php echo $gas_quality !== '' ? $gas_quality : ''; ?>" />
													</td>
													<td width="20%" id="tdfile9">
														<?php if($gas_quality!="" && $gas_quality!="SC" && $gas_quality!="NA"){ echo '<a href="'.$upload.$gas_quality.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
													</td>
			
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="form1.php?tab=4" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save1e" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table6" class="tab-pane <?php echo $tabbtn6; ?>" role="tabpanel">
										<form name="myform1" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
										<table class="table table-responsive">
											<tr>
												<td colspan="4"><strong>Part - D : Hazardous waste aspects</strong></td>
											</tr>
											<tr>
												<td colspan="3" rowspan="2">30. (a) Whether the unit is generating hazardous  waste as defined in the Hazardous Waste (Management and handling)  Rules, 1989, as amended.<span class="mandatory_field"> *</span></td></td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_hazardous=="Y") echo "checked";?> id="inlineRadio1" name="is_hazardous" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_hazardous=="N") echo "checked";?> id="inlineRadio1" name="is_hazardous"> No </label></td>
											</tr>
											<tr>
												<td><input type="text" value="<?php if($is_hazardous=="Y") echo $haz_cat_no; else "";?>" <?php if($is_hazardous=="" || $is_hazardous=="N") echo "disabled='disabled'";?> name="haz_cat_no" id="haz_cat_no" placeholder="Category Number" class="form-control text-uppercase"/></td>
											</tr>									
											<tr>
												<td>31. Authorization required for</td>
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_a=="C") echo "checked"; ?> name="auth_req[a]" value="C">Collection &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_b=="R") echo "checked"; ?> name="auth_req[b]" value="R">Reception &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_c=="TM") echo "checked"; ?> name="auth_req[c]" value="TM">Treatment &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_d=="TP") echo "checked"; ?> name="auth_req[d]" value="TP">Transport &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_e=="S") echo "checked"; ?> name="auth_req[e]" value="S">Storage &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_f=="D") echo "checked"; ?> name="auth_req[f]" value="D">Disposal of the hazardous waste</label>
												</td>
											</tr>
											<tr>
												<td colspan="2">32. Quantity of hazardous waste generated (kg / day)  or (mt / month)</td>
												<td colspan="2"><input type="text" name="haz_qty" value="<?php echo $haz_qty;?>" placeholder="Quantity of hazardous waste"  class="form-control text-uppercase"/></td>
											</tr>
											<tr>
												<td colspan="4">33. Characteristics of the hazardous waste(s). Specify concentration of relevant pollutants. (Enclose a copy of the latest report of analysis from the laboratory approved by 'State Board/Central Board/ Central Government in the Ministry of Environment and Forests ). For proposed units furnish expected characteristics.</td>
											</tr>
											<tr>
												<td style="width:25%">Upload File</td>
												
												
												<td width="30%">
												<select trigger="FileModal" id="file10" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($haz_character); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
													<input type="hidden" name="haz_character" id="mfile10" value="<?php echo $haz_character !== '' ? $haz_character : ''; ?>" />
												</td>
												<td width="20%" id="tdfile10">
													<?php if($haz_character!="" && $haz_character!="SC" && $haz_character!="NA"){ echo '<a href="'.$upload.$haz_character.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
												
											</tr>
											<tr>
												<td colspan="2">34. Mode of storage (intermediate or final) (describe area, location and methodology)</td>
												<td colspan="2"><input type="text" name="storage_mode" value="<?php echo $storage_mode; ?>" placeholder="describe area, location and methodology" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="2">35. Present treatment of hazardous waste,  if any(give type and capacity of treatment units)</td>
												<td colspan="2"><input type="text" name="haz_pres_treatment" value="<?php echo $haz_pres_treatment; ?>" placeholder="type and capacity of treatment units" class="form-control text-uppercase">	</td>
											</tr>
											<tr>
												<td colspan="4">36. Quantity of hazardous waste disposed</td>
											</tr>
											<tr>
												<td >(i) Within the factory</td>
												<td><input type="text" name="haz_qty_dispose[a]" id="textfield176" value="<?php echo $haz_qty_dispose_a; ?>" placeholder="Quantity of hazardous waste" class="form-control text-uppercase"></td>
												<td >(ii) Outside the factory (Specify location and enclose copies of agreement)	</td>
												<td><input type="text" name="haz_qty_dispose[b]" id="textfield176" value="<?php echo $haz_qty_dispose_b; ?>" placeholder="Quantity of hazardous waste" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="4">(iii) Through sale (Enclose documentary proof and copies of agreement) </td>												
											</tr>
											<tr>
												<td style="width:25%">Upload File</td>
												<td width="30%">
													<select trigger="FileModal" id="file11" class="form-control">                                            
														<option value="0" selected="selected"><?php echo uploadinfo($haz_qty_dispose_c); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
														<input type="hidden" name="haz_qty_dispose[c]" id="mfile11" value="<?php echo $haz_qty_dispose_c !== '' ? $haz_qty_dispose_c : ''; ?>" />
													</td>
													<td width="20%" id="tdfile11">
														<?php if($haz_qty_dispose_c!="" && $haz_qty_dispose_c!="SC" && $haz_qty_dispose_c!="NA"){ echo '<a href="'.$upload.$haz_qty_dispose_c.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
													</td>
											</tr>
											
		
											
											<tr>
												<td >(iv) Outside State / Union Territory , if yes particulars of (i) & (iii) above	</td>
												<td><input type="text" name="haz_qty_dispose[d]" value="<?php echo $haz_qty_dispose_d; ?>" class="form-control text-uppercase">	</td>
												<td >(v) Other (specify)</td>
												<td><input type="text" name="haz_qty_dispose[e]" value="<?php echo $haz_qty_dispose_e; ?>" class="form-control text-uppercase">	</td>
											</tr>
											<tr>
												<td class="text-center" colspan="5">
													<a href="form1.php?tab=5" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save1f" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table7" class="tab-pane <?php echo $tabbtn7; ?>" role="tabpanel">
										<form name="myform1" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4"><strong>Part - E : Additional information</strong></td>
											</tr>
											<tr>
												<td  colspan="2">37. (a) Do you have any proposals to upgrade the present system for treatment and disposal of effluent/ emission and / or hazardous waste<span class="mandatory_field"> *</span></td></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_sys_upg=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_sys_upg" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_sys_upg=='N' || $is_sys_upg=='') echo 'checked'; ?> id="inlineRadio1" name="is_sys_upg"> No </label></td>
											</tr>
											<tr>
												<td  colspan="2">37. (b) If yes, give the details with time-schedule for the implementation and approximate expenditure to be incurred on it.</td>
												<td colspan="2"><textarea type="text"  name="sys_upg_details" id="sys_upg_details" <?php if($is_sys_upg == 'N' || $is_sys_upg == '' ) echo 'disabled="disabled"'; ?> placeholder="details with time-schedule" class="form-control text-uppercase"/><?php echo $sys_upg_details; ?></textarea></td>
											</tr>	
											<tr>
												<td colspan="4">38. Capital and recurring (O & M) expenditure on various aspects of environment protection such as effluent, emission ,hazardous waste, solid waste, tree plantation, monitoring, date acquisition etc. (give figures separately for items implemented / to be implemented).</td>
											</tr>
											<tr>
												<td style="width:25%">Upload File</td>
												
												<td width="30%">
												<select trigger="FileModal" id="file12" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($om_expens); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
													<input type="hidden" name="om_expens" id="mfile12" value="<?php echo $om_expens !== '' ? $om_expens : ''; ?>" />
												</td>
												<td width="20%" id="tdfile12">
													<?php if($om_expens!="" && $om_expens!="SC" && $om_expens!="NA"){ echo '<a href="'.$upload.$om_expens.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
												
												
											</tr>											
											<tr>
												<td colspan="4">39. To which of the pollution control equipment, separate meters for recording consumption of electric energy are installed ?</td>
											</tr> 											
											<tr>
												<td colspan="4">
													<table class="table table-bordered table-responsive">
														<thead>
															<tr>
																<th>Pollution Control Equipment</th>
																<th>Emission/Effluent Type</th>
																<th>Seperate Meters are installed ?<span class="mandatory_field"> *</span></td></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><?php echo $sd_ce_sn1; ?></td>
																<td><input type="text" name="to_which[a]" value="<?php echo $to_which_a; ?>" placeholder="Emission/Effluent Type" class="form-control text-uppercase"></td>
																<td>
																	<label class="radio-inline"><input type="radio" value="Y" <?php if($to_which_b=="Y") echo "checked"; ?> id="inlineRadio1" name="to_which[b]" required="required"> Yes </label>
																	<label class="radio-inline"><input type="radio" value="N" <?php if($to_which_b=="N") echo "checked"; ?> id="inlineRadio1" name="to_which[b]"> No </label>
																</td>
															</tr>
															<tr>
																<td><?php echo $sd_ce_sn2; ?></td>
																<td><input type="text" name="to_which[c]" value="<?php echo $to_which_c; ?>" placeholder="Emission/Effluent Type" class="form-control text-uppercase"></td>
																<td>
																	<label class="radio-inline"><input type="radio" value="Y" <?php if($to_which_d=="Y") echo "checked"; ?> id="inlineRadio1" name="to_which[d]" required="required"> Yes </label>
																	<label class="radio-inline"><input type="radio" value="N" <?php if($to_which_d=="N") echo "checked"; ?> id="inlineRadio1" name="to_which[d]"> No </label>
																</td>
															</tr>
															<tr>
																<td><?php echo $sd_ce_sn3; ?></td>
																<td><input type="text" name="to_which[e]" value="<?php echo $to_which_e; ?>" placeholder="Emission/Effluent Type" class="form-control text-uppercase"></td>
																<td>
																	<label class="radio-inline"><input type="radio" value="Y" <?php if($to_which_f=="Y") echo "checked"; ?> id="inlineRadio1" name="to_which[f]" required="required"> Yes </label>
																	<label class="radio-inline"><input type="radio" value="N" <?php if($to_which_f=="N") echo "checked"; ?> id="inlineRadio1" name="to_which[f]"> No </label>
																</td>
															</tr>
															<tr>
																<td><?php echo $sd_ce_sn4; ?></td>
																<td><input type="text" name="to_which[g]" value="<?php echo $to_which_g; ?>" placeholder="Emission/Effluent Type" class="form-control text-uppercase"></td>
																<td>
																	<label class="radio-inline"><input type="radio" value="Y" <?php if($to_which_h=="Y") echo "checked"; ?> id="inlineRadio1" name="to_which[h]" required="required"> Yes </label>
																	<label class="radio-inline"><input type="radio" value="N" <?php if($to_which_h=="N") echo "checked"; ?> id="inlineRadio1" name="to_which[h]"> No </label>
																</td>
															</tr>
														</tbody>														
													</table>
												</td>
											</tr> 
											<tr>
												<td rowspan="4" colspan="2">40. Which of the pollution control items are connected to D.G. set (captive power source) to ensure their running in the event of normal power failure ?<span class="mandatory_field"> *</span></td></td>
												<td><?php echo $sd_ce_sn1; ?></td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($dgset_items_a=="Y") echo "checked"; ?> id="inlineRadio1" name="dgset_items[a]" required="required"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($dgset_items_a=="N" || $dgset_items_a=="") echo "checked"; ?> id="inlineRadio1" name="dgset_items[a]"> No </label>
												</td>
											</tr>
											<tr>
												<td><?php echo $sd_ce_sn2; ?></td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($dgset_items_b=="Y") echo "checked"; ?> id="inlineRadio1" name="dgset_items[b]" > Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($dgset_items_b=="N" || $dgset_items_b=="") echo "checked"; ?> id="inlineRadio1" name="dgset_items[b]"> No </label>
												</td>
											</tr>
											<tr>
												<td><?php echo $sd_ce_sn3; ?></td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($dgset_items_c=="Y") echo "checked"; ?> id="inlineRadio1" name="dgset_items[c]"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($dgset_items_c=="N" || $dgset_items_c=="") echo "checked"; ?> id="inlineRadio1" name="dgset_items[c]"> No </label>
												</td>
											</tr>
											<tr>
												<td><?php echo $sd_ce_sn4; ?></td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($dgset_items_d=="Y") echo "checked"; ?> id="inlineRadio1" name="dgset_items[d]"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($dgset_items_d=="N" || $dgset_items_d=="") echo "checked"; ?> id="inlineRadio1" name="dgset_items[d]"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="2">41. Nature, quantity and method of disposal of non-hazardous solid waste generated separately from the process of manufacture and waste treatment.(Give details of area / capacity available in applicant's land)</td>
												<td colspan="2"><input type="text" name="nonhaz_details" value="<?php echo $nonhaz_details; ?>" class="form-control text-uppercase"/></td>
											</tr>
											<tr>
												<td colspan="2" >42. Hazardous Chemicals - Give details of chemicals and quantities handled and stored.</td>
												<td colspan="2" ><input type="text" name="haz_chemicals" value="<?php echo $haz_chemicals; ?>" placeholder="details of chemicals and quantities" class="form-control text-uppercase"/></td>
											</tr>
											<tr>
												<td colspan="2">(i) Is the unit a Major Accident Hazard unit  as per MSIHC Rules ?<span class="mandatory_field"> *</span></td></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_a == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[a]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_a == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[a]"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="2">(ii) Is the unit an isolated storage as  defined under the MSIHC Rules ?<span class="mandatory_field"> *</span></td></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_b == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[b]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_b == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[b]"> No </label></td>
											</tr>
											<tr> 
												<td colspan="2">(iii) Indicate status of compliance of Rules 5, 7, 10, 11, 1 2, 13 and 18 of the MSIHC Rules.</td>
												<td colspan="2"><input type="text" name="haz_chemicals_details[c]" value="<?php echo $haz_chemicals_details_c; ?>" class="form-control text-uppercase"/></td>
											</tr>
											<tr>
												<td colspan="2">(iv) Has approval of site been obtained from the concerned authority ?<span class="mandatory_field"> *</span></td></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_d == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[d]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_d == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[d]"> No </label>
												</td>
											</tr>
											<tr>
												<td>(v) Has the unit prepared an Off-site Emergency Plan ?<span class="mandatory_field"> *</span></td> </td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_e == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[e]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_e == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[e]"> No </label></td>
												<td>Is it updated ?<span class="mandatory_field"> *</span></td> </td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_f == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[f]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_f == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[f]"> No </label></td>
											</tr>
											<tr>
												<td colspan="2">(vi) Has information on imports of chemicals been provided to the concerned authority ?<span class="mandatory_field"> *</span></td></td>
												<td ><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_g == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[g]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_g == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[g]"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="2">(vii) Does the unit posses a policy  under the PLI Act?<span class="mandatory_field"> *</span></td></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_h == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[h]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_h == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[h]"> No </label></td>
											</tr>
											<tr>
												<td colspan="4">43. Brief details of tree plantation / green belt development within applicant's premises (in hectares).</td>
											</tr>
											<tr>
												<td style="width:25%">Upload File</td>
												
												
												<td width="30%">
												<select trigger="FileModal" id="file13" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($tree_plant); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
														<input type="hidden" name="tree_plant" id="mfile13" value="<?php echo $tree_plant !== '' ? $tree_plant : ''; ?>" />
											</td>
											<td width="20%" id="tdfile13">
														<?php if($tree_plant!="" && $tree_plant!="SC" && $tree_plant!="NA"){ echo '<a href="'.$upload.$tree_plant.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
											</td>
											</tr>
											<tr>
												<td colspan="4">44. Information of schemes for waste minimisation, resource recovery and recycling - implemented and to be implemented, separately.</td>
											</tr>
											<tr>
												<td style="width:25%">Upload File</td>
												
												<td width="30%">
												<select trigger="FileModal" id="file14" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($scheme_info); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
													<input type="hidden" name="scheme_info" id="mfile14" value="<?php echo $scheme_info !== '' ? $scheme_info : ''; ?>" />
												</td>
													<td width="20%" id="tdfile14">
													<?php if($scheme_info!="" && $scheme_info!="SC" && $scheme_info!="NA"){ echo '<a href="'.$upload.$scheme_info.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
												
											</tr>
											<tr>
												<td colspan="3">45. (a) The applicant shall indicate whether industry comes under Public Hearing, if so, the relevant documents such as EIA, EMP, Risk Analysis etc. shall be submitted, if so, the relevant documents enclosed shall be indicated accordingly</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($public_hearing_doc != 'N' && $public_hearing_doc != '') echo 'checked'; ?> id="inlineRadio1" name="public_hearing_doc"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($public_hearing_doc == 'N' || $public_hearing_doc == '') echo 'checked'; ?> id="inlineRadio1" name="public_hearing_doc"> No </label></td>
											</tr>
											<tr id="public_hearing_doc_id">
												<td style="width:25%">Upload File</td>
												
												<td width="30%">
												<select trigger="FileModal" id="file15" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($public_hearing_doc); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
													<input type="hidden" name="public_hearing_doc" id="mfile15" value="<?php echo $public_hearing_doc !== '' ? $public_hearing_doc : ''; ?>" />
												</td>
													<td width="20%" id="tdfile15">
													<?php if($public_hearing_doc!="" && $public_hearing_doc!="SC" && $public_hearing_doc!="NA"){ echo '<a href="'.$upload.$public_hearing_doc.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
												
												
											<!---<td style="width:25%"><select trigger="FileModal" id="file15" class="form-control text-uppercase file15" <?php if($public_hearing_doc!="" || $public_hearing_doc=="SC" || $public_hearing_doc=="NA") echo "disabled='disabled'"; ?>>
															<option value="0" selected="selected">Select</option>
															<option value="1">From E-Locker</option>
															<option value="2">From PC</option>
														</select>
													<input type="hidden" name="public_hearing_doc" value="<?php if($public_hearing_doc!="") echo $public_hearing_doc; ?>" id="mfile15" value=""/>					
												</td>
												<td style="width:25%" id="mfile15-chiranjit"><?php if($public_hearing_doc!="" && $public_hearing_doc!="SC" && $public_hearing_doc!="NA"){ echo '<a href="'.$upload.$public_hearing_doc.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file15" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
												<td style="width:25%"><input type="CheckBox" id="O1" class="file15" name="O1" <?php if($public_hearing_doc=="NA") echo "checked"; ?>  value='O1' <?php if($public_hearing_doc!="" && $public_hearing_doc!="NA") echo "disabled"; ?> onClick="checkData(this)"/>&nbsp;Not Applicable&nbsp;&nbsp; <input type="CheckBox" id="O2" class="file15 cd" name="O2" <?php if($public_hearing_doc=="SC") echo "checked"; ?> value='O2' <?php if($public_hearing_doc!="" && $public_hearing_doc!="SC") echo "disabled"; ?> onClick="checkData(this)"/>&nbsp;Send By Courier</td> --->
											</tr> 
											<tr>
												<td colspan="2">(b) Any other additional information that  the applicant desires to give.</td>
												<td colspan="2"><input type="text" name="other_info" value="<?php echo $other_info; ?>" class="form-control text-uppercase">	</td>
												<td ></td> 
												<td></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="form1.php?tab=6" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save1g" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table8" class="tab-pane <?php echo $tabbtn8; ?>" role="tabpanel">										
									<form name="myform1" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
										<table class="table table-responsive table-bordered">
											<tr>
												<td style="width:40%">Land documents such as Sale deed, Jamabandi, Type Map, Non-encumbrance Certificate and Revenue Clearance Certificate of the proposed plot.( if the plot is rented/lease hold then in addition to the above documents Rent deed/ Lease deed should be submitted) or Allotment letter of designated authority for the site of project, if located in the designated industrial area/ industrial estate.</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file16" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file16); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile16" id="mfile16" value="<?php echo $file16 !== '' ? $file16 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile16">
                                            <?php if($file16!="" && $file16!="SC" && $file16!="NA"){ echo '<a href="'.$upload.$file16.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td>Project Report containing the detailed Environment Management Plan.</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file17" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file17); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile17" id="mfile17" value="<?php echo $file17 !== '' ? $file17 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile17">
                                            <?php if($file17!="" && $file17!="SC" && $file17!="NA"){ echo '<a href="'.$upload.$file17.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td>Site plan prepared by Competent Engineer.</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file18" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file18); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile18" id="mfile18" value="<?php echo $file18 !== '' ? $file18 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile18">
                                            <?php if($file18!="" && $file18!="SC" && $file18!="NA"){ echo '<a href="'.$upload.$file18.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td>Layout plan showing location of the <br/>(a) Units/Stack/Chimney/Emission points<br/>(b) Drainage and final disposal for liquid effluent.<br/>(c)	Solid waste collection/storage/disposal facility<br/>(d) demarcation of open area in the industry premises and green belt within the compound with dimensions.</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file19" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file19); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile19" id="mfile19" value="<?php echo $file19 !== '' ? $file19 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile19">
                                            <?php if($file19!="" && $file19!="SC" && $file19!="NA"){ echo '<a href="'.$upload.$file19.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td>Non-agricultural land certificate from circle officer if the land is classified as agriculture land.</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file20" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file20); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile20" id="mfile20" value="<?php echo $file20 !== '' ? $file20 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile20">
                                            <?php if($file20!="" && $file20!="SC" && $file20!="NA"){ echo '<a href="'.$upload.$file20.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td>Copy of article and memorandum of Association/Partnership deed/deed of Attorney (except Proprietorship Firm.)</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file21" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file21); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile21" id="mfile21" value="<?php echo $file21 !== '' ? $file21 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile21">
                                            <?php if($file21!="" && $file21!="SC" && $file21!="NA"){ echo '<a href="'.$upload.$file21.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td>Registration Certificate of DICC.</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file22" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file22); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile22" id="mfile22" value="<?php echo $file22 !== '' ? $file22 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile22">
                                            <?php if($file22!="" && $file22!="SC" && $file22!="NA"){ echo '<a href="'.$upload.$file22.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td>Consent fees in favour of Member Secretary, Pollution Control Board, Assam payable through online banking/credit card/debit card, based on the investment of the project as per latest notification.</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file23" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file23); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile23" id="mfile23" value="<?php echo $file23 !== '' ? $file23 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile23">
                                            <?php if($file23!="" && $file23!="SC" && $file23!="NA"){ echo '<a href="'.$upload.$file23.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td>Environmental Clearance Certificate(EC) if the proposed industry is requried to obtain prior EC from MoEF & CC/SEIAA as per EIA Notification 2006 in force.</td>
												<td width="30%">
                                            <select trigger="FileModal" id="file24" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file24); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile24" id="mfile24" value="<?php echo $file24 !== '' ? $file24 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile24">
                                            <?php if($file24!="" && $file24!="SC" && $file24!="NA"){ echo '<a href="'.$upload.$file24.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
											</tr>
											<tr>
												<td class="text-center" colspan="5">
													<a href="form1.php?tab=7" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save1h" class="btn btn-success text-bold submit1">Submit</button>
												</td>
											</tr>
										</table>
										</form>
									</div>	
									<div id="table10" class="tab-pane <?php echo $tabbtn10; ?>" role="tabpanel">
									<form name="myform1" id="" method="post" class="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
										<table  id=""  class="table table-responsive" >
										<tr>
											<td>
												<div class="row">
													<div class="col-md-8 col-md-offset-2">
														<div class="form-inline">
															<strong>Select your mode of payment &nbsp; &nbsp; &nbsp;</strong>
															<input type="radio" name="payment_mode" value="1"> Online Payment &nbsp;&nbsp;&nbsp;
															<input type="radio" name="payment_mode" value="0"> Offline Payment
														</div>
													</div>
												</div>
												<br>
												<div id="offlinePayDetials">
													<div class="row">
														<div class="col-md-6 col-md-offset-4">
														<?php 
														if($check==3){
															$tableName=$formFunctions->getTableName("pcb","1");
															
															$results=$pcb->query("select investment_cost from ".$tableName." where user_id='$swr_id' and active='1'") or die($pcb->error);
															if($results->num_rows>0){
																$row=$results->fetch_assoc();
																if(!empty($row["investment_cost"])){
																	$investment_cost=json_decode($row["investment_cost"]);
																	$investment_cost_a=$investment_cost->a;$investment_cost_b=$investment_cost->b;
																	
																	
																	$investment_cost_b=($investment_cost_b=="C")?'0000000':'00000';
																	$investment_cost=$investment_cost_a.$investment_cost_b;															
																	
																	
																	$fees_results=$pcb->query("select * from cte_fees_schedule where min_invest<$investment_cost and max_invest>=$investment_cost") or die($pcb->error);
																	if($fees_results->num_rows>0){
																		$fees_details=$fees_results->fetch_object();
																		$reg_fees=$fees_details->fee;
																	}else{
																		$results=$pcb->query("update ".$tableName." set save_mode='D' where user_id='$swr_id' and active='1'") or die($pcb->error);
																		echo "<script>
																			alert('Please enter the total investment cost in the application form.');
																			window.location.href = '".$server_url."departments/pcb/forms/form1.php?tab=2';
																		</script>";
																		exit();
																	}
																	
																	
																	
																}else{
																	$results=$pcb->query("update ".$tableName." set save_mode='D' where user_id='$swr_id' and active='1'") or die($pcb->error);
																	echo "<script>
																			alert('Please enter the total investment cost in the application form.');
																			window.location.href = '".$server_url."departments/pcb/forms/form1.php?tab=2';
																	</script>";
																	exit();
																}
															}else{
																$results=$pcb->query("update ".$tableName." set save_mode='D' where user_id='$swr_id' and active='1'") or die($pcb->error);
																echo "<script>
																		alert('Please enter the total investment cost in the application form.');
																		window.location.href = '".$server_url."departments/pcb/forms/form1.php?tab=2';
																</script>";
																exit();
															}
														}
															
														
														?>
															<strong>Application Fee Payment Reciept ( <i class="fa fa-1x fa-inr"></i> <?php echo $reg_fees; ?> )</strong>
															<p>	Bank Name : STATE BANK OF INDIA , SBI, NEW GUWAHATI BRANCH<br/>
																Bank Account No. : 10566990077<br/>
																Entity Name : POLLUTION CONTROL BOARD, ASSAM<br/>
																RTGS IFSC Code : SBIN0000221<br/>
																NEFT IFSC Code : SBIN0000221
															</p>
															<div class="uploadfieldtrick">
																<b>Upload Pay-Challan :</b>
																<input type="button" upload="file" class="file" id="file" value="Browse">
																<input type="hidden" name="offline_challan" value="" id="mfile" readonly="readonly"/>
																<span id="tdfile">No File Selected</span>
															</div>
														</div>
													</div>
												</div>
												<br><br>
											</td>
											</tr>
											<tr>
											<td class="text-center">
												<a type="button" href="form1.php?tab=9" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="submit1" class="btn btn-success">Submit</button>
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
	$('input[name="is_res_colony"]').on('change', function(){
		if($(this).val() == 'N')
			$('#field12b, #field12c1, #field12c2, #field12c3').attr('disabled', 'disabled');
		else
			$('#field12b, #field12c1, #field12c2, #field12c3').removeAttr('disabled');
	});
	$('input[name="is_registered"]').on('change', function(){
		if($(this).val() == 'N')
			$('.is_registered').attr('disabled', 'disabled');
		else
			$('.is_registered').removeAttr('disabled');
	}); 
	$('input[name="is_hazardous"]').on('change', function(){
		if($(this).val() == 'N')
			$('#haz_cat_no').attr('disabled', 'disabled');
		else
			$('#haz_cat_no').removeAttr('disabled');
	});
	$('input[name="is_mixed"]').on('change', function(){
		if($(this).val() == 'N')
			$('#yes_detail').attr('disabled', 'disabled');
		else
			$('#yes_detail').removeAttr('disabled');
	});
	$('input[name="sump_capacity_radio"]').on('change', function(){
		if($(this).val() == 'N')
			$('.sump_capacity').attr('disabled', 'disabled');
		else
			$('.sump_capacity').removeAttr('disabled');
	}); 
	$('input[name="is_sys_upg"]').on('change', function(){
		if($(this).val() == 'N')
			$('#sys_upg_details').attr('disabled', 'disabled');
		else
			$('#sys_upg_details').removeAttr('disabled');
	});
	<?php if($public_hearing_doc == 'N' || $public_hearing_doc == '') echo "$('#public_hearing_doc_id').hide();"; ?>
	$('input[name="public_hearing_doc"]').on('change', function(){
		if($(this).val() == 'N')
			$('#public_hearing_doc_id').hide();
		else
			$('#public_hearing_doc_id').show();
	});
	<?php if($is_provided=="N"){ ?>
	$('#is_provided_yes').attr('disabled', 'disabled');
	<?php } ?>
	$('.file2').attr('disabled', 'disabled');
	$('input[name="is_provided"]').on('change', function(){
		if($(this).val() == 'N'){
			$('.file2').removeAttr('disabled');
			$('#is_provided_yes').removeAttr('disabled');
			$('#is_provided_yes').attr('disabled', 'disabled');			
		}else{
			$('#is_provided_yes').removeAttr('disabled');
			$('.file2').removeAttr('disabled');
			$('.file2').attr('disabled', 'disabled');
		}
	});
	$('select[name="loc_feedback_select"]').on('change', function(){
		if($(this).val() == 'N'){
			$('#loc_feedback').removeAttr('readonly');
			$('#loc_feedback').val('');
			$('#loc_feedback').attr('readonly', 'readonly');			
		}else{
			$('#loc_feedback').removeAttr('readonly');
		}			
	});
	$('.wc_sum').on('change', function(){
		var sum = 0;
		$('.wc_sum').each(function(){			
			if(!isNaN(parseFloat($(this).val()))){
				sum = sum + parseFloat($(this).val());
			}
			$('#wc_values_total').val(sum.toFixed(2));
		});
	});
	
	/* --------------addmore Operation---------------- */
	var field13Index = 1;
	$('#addMoreF13').on('click', function(){
		field13Index++;
		$('.multiRowF13').last().after('<tr class="multiRow"><td><input type="text" placeholder="Name" class="form-control text-uppercase"></td><td><input type="text" name="'+field13Index+'"placeholder="Quantity" class="form-control text-uppercase"></td><td><select class="form-control text-uppercase"><option>Choose a Unit</option><option>Tonnes per/month</option><option>Kilo Litre per/month </option><option>Numbers per/month </option></select></td></tr>');
	});
	var field14Index = 1;
	$('#addMoreF14').on('click', function(){
		field14Index++;
		$('.multiRowF14').last().after('<tr class="multiRow"><td><input type="text" placeholder="Name" class="form-control text-uppercase"></td><td><input type="text" name="'+field14Index+'"placeholder="Quantity" class="form-control text-uppercase"></td><td><select class="form-control text-uppercase"><option>Choose a Unit</option><option>Tonnes per/month</option><option>Kilo Litre per/month </option><option>Numbers per/month </option></select></td></tr>');
	});
	
	/* ------------------------------------------------------ */
	/********* PAYMENT SECTION HIDE SHOW ***********/
	$('#offlinePayDetials').hide();
	$(document).ready(function(){
		$('input[name="payment_mode"]').on('change', function(){
			if($(this).val() == 0){						
				$('#offlinePayDetials').show("fast");						
			}else{
				$('#offlinePayDetials').hide("slow");
			}	
			
		});
	});
	<?php if($check!=0 && $check!=4){ ?>
		$(".myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
</body>
</html>