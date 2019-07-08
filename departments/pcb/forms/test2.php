<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('pcb','51');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=51&dept=pcb';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=51&dept=pcb';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = '".$server_url."departments/pcb/forms/payment_section.php?token=51';</script>";
}else{
	$showtab="";
}


$get_file_name=basename(__FILE__);
include "save_form51.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$enterprise_category=$row1['Category_o_Enterprise'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$date_of_commencement=$row1['date_of_commencement'];
	$business_type=$row1["sector_classes_b"];	
	$l_o_business=$row1['Type_of_ownership'];
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner); 
	
	switch($l_o_business){
			case "IN": $l_o_business_val="Individual ";
			break;
			case "PC": $l_o_business_val="Proprietary concern ";
			break;
			case "PF": $l_o_business_val="Partnership firm ";
			break;
			case "JC": $l_o_business_val="Joint family concern ";
			break;
			case "PLC": $l_o_business_val="Private Limited Company ";
			break;
			case "PL": $l_o_business_val="Public Limited Company ";
			break;
			case "GC": $l_o_business_val="Government Company ";
			break;
			case "F": $l_o_business_val="Foreign Company";
			break;
			default : $l_o_business_val="Any other Association or Body";
			break;
		}
	
	 $q=$pcb->query("select * from pcb_form51 where user_id='$swr_id' and active='1'") or die($pcb->error);
	 $results=$q->fetch_assoc();
	 if($q->num_rows<1){			
		$form_id="";$natio_nality="";$survey_no="";$land_premises="";
		$khasra_no="";$approximate_date="";$expected_date="";$total_no_employee="";$total_no_employee="";$is_licence="";
		$is_licence_details="";$person_authorised="";$licence_annual_capacity="";$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";$wc_values_f="";$person_upload="";
		
		$water_source="";$dome_stic="";$indus_trial="";$effluents_upload="";$quality_of_effluent="";$monitoring_arrangemen="";$is_treatment_plant="";$details_upload="";
		
		/******** PART 2*********************/
		$sold_wastes_a="";$sold_wastes_b="";$sold_wastes_c="";$sold_wastes_d="";
		
        $file1="";$file2="";$file3="";
		
		}else{	
		
		$form_id=$results["form_id"];$land_premises=$results["land_premises"];
		$natio_nality=$results["natio_nality"];$survey_no=$results["survey_no"];$khasra_no=$results["khasra_no"];$approximate_date=$results["approximate_date"];$expected_date=$results["expected_date"];$total_no_employee=$results["total_no_employee"];$is_licence=$results["is_licence"];  $is_licence_details=$results["is_licence_details"];$person_authorised=$results["person_authorised"];$licence_annual_capacity=$results["licence_annual_capacity"];
		
		$dome_stic=$results["dome_stic"];$indus_trial=$results["indus_trial"];$quality_of_effluent=$results["quality_of_effluent"];$monitoring_arrangemen=$results["monitoring_arrangemen"];$is_treatment_plant=$results["is_treatment_plant"];$details_upload=$results["details_upload"];$person_upload=$results["person_upload"];$effluents_upload=$results["effluents_upload"];
		
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];
		
		if(!empty($results["wc_values"])){
			$wc_values=json_decode($results["wc_values"]);
			$wc_values_a=$wc_values->a;$wc_values_b=$wc_values->b;$wc_values_c=$wc_values->c;$wc_values_d=$wc_values->d;$wc_values_e=$wc_values->e;$wc_values_f=$wc_values->f;
		}else{
			$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";$wc_values_f="";
		}
		
		if(!empty($results["sold_wastes"])){
			$sold_wastes=json_decode($results["sold_wastes"]);
			$sold_wastes_a=$sold_wastes->a;$sold_wastes_b=$sold_wastes->b;$sold_wastes_c=$sold_wastes->c;$sold_wastes_d=$sold_wastes->d;
		}else{
			$sold_wastes_a="";$sold_wastes_b="";$sold_wastes_c="";$sold_wastes_d="";
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
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	if($showtab=="" || $showtab<2 || $showtab>9 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==7){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="active";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==8){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="active";$tabbtn9="";
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
									<strong><?php echo $form_name=$cms->query("select form_name from pcb_form_names where form_no='51'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table8">Upload Section</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr class="form-inline">
											<td colspan="4">To The Member Secretary, Central Pollution Control Board.</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sir, I/We hereby apply for Consent/Renewal of Consent under section 25 of the Water (Prevention and Control of Pollution) Act, 1974 (6 of 1974) for establishing or taking any steps for establishment of Industry/operation process or any treatment/disposal system to bring into use any new/altered outlet for discharge of *sewage/trade effluent* to continue to discharge* sewage/trade effluent* from land/premises owned by <input type="text" class="form-control text-uppercase" name="land_premises" value="<?php echo $land_premises;?>" >.</td>
										</tr>
										<tr>
											<td colspan="4">The other relevant details are below:- </td>
										</tr>
										<tr>
											<td width="25%">Full Name of the applicant:</td>
											<td width="25%"><input type="text" value="<?php echo strtoupper($key_person);?>" class="form-control text-uppercase" disabled></td>
											<td width="25%">2. Nationality of the applicant :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"name="natio_nality" value="<?php echo  $natio_nality; ?>"></td>
										</tr>
										<tr>
											<td>3. Select the appropriate category of business :</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $l_o_business_val;?>" ></td>
											<td></td>
											<td></td>
										</tr>
								    <tr>
									     <td colspan="4">4. Name, Address and Telephone Nos. of Applicant. :  </td>
								    </tr>
								    <tr>
									  <td colspan="4">
									  <table  class="table table-responsive">
									  <thead>
									  <tr>
										  <th width="5%">Sl. No.</th>
										  <th width="25%">Partners/Directors Name</th>
										  <th width="20%">Street Name 1</th>
										  <th width="15%">Street Name 2</th>
										  <th width="15%">Village/Town</th>
										  <th width="10%">District</th>
										  <th width="10%">Pincode</th>
									</tr>
									</thead>	
										<?php 
										$member_results=$pcb->query("select * from pcb_form51_members where form_id='$form_id'") or die("Error : ".$pcb->error);
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>

											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->vill; ?>" /></td>
												<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->dist; ?>" /></td>
												<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pin; ?>" maxlength="6" validate="pincode" ></td>
												
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>	
										</td>
										
										</table>
							       </tr>
									<tr>
										<td colspan="4">5. Address of the Industry :</td>
									</tr>
									<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name2; ?>"></td>
									 </tr>
									 <tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
											<td>Survey No :</td>
											<td><input type="text" class="form-control text-uppercase"  name="survey_no" value="<?php echo  $survey_no; ?>" ></td>
										</tr>
										<tr>
											<td>Khasra No :</td>
											<td><input type="text" class="form-control text-uppercase" name="khasra_no" value="<?php echo  $khasra_no; ?>"></td>
                                        <td></td>
										    <td></td>
									   </tr>		
										<tr>
											<td colspan="4">6. Details of commissioning etc.:- </td>
										</tr>
										 <tr>
												<td>(a) Approximate date of proposed commissioning of work.:</td>
												<td><input type="text" class="dob form-control text-uppercase" name="approximate_date" value="<?php echo $approximate_date;?>" ></td>
												<td>(b) Expected date of production: </td>
												<td><input type="text" class="dob form-control text-uppercase" name="expected_date" value="<?php echo $expected_date;?>" ></td>
											</tr>
											<tr>
												<td colspan="3">7. Total number of employee expected to employed. :</td>
												<td><input type="text" class="form-control text-uppercase" name="total_no_employee" value="<?php echo $total_no_employee;?>" ></td>
											</tr>
											<tr>
												<td colspan="3">8.  Details  of  licence,  if  any  obtained  under  the  provisions  of  Industrial  Development Regulations Act, 1951.</td>
												<td>
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_licence=="Y" || $is_licence=="") echo "checked"; ?> name="is_licence"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_licence=="N") echo "checked"; ?> name="is_licence"> No </label>
												</td>
											</tr>									
											<tr>
												<td colspan="2">(b) If yes, please give details.</td>
												<td colspan="2"><input type="text" id="field12b" <?php if($is_licence=="N") echo " "; ?> class="form-control text-uppercase" name="is_licence_details" value="<?php echo $is_licence_details; ?>" /></td>
											</tr>	
											
											<tr>
												<td>9.  Name  of  the  person  authorised  to  sign  this  form  (the  original  authorisation  except  in  the case of individual proprietary concern is to be enclosed).  </td>
												<td><input type="text" class="form-control text-uppercase" name="person_authorised" value="<?php echo $person_authorised;?>" ></td>
											</tr>
											<tr>
												<td>Upload File</td>
												<td width="30%">
											   <select trigger="FileModal" id="filea" class="form-control">                                            
												<option value="0" selected="selected"><?php echo uploadinfo($person_upload); ?></option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
												<option value="4">Send by Courier</option>
												<option value="3">Not Applicable</option>
											</select>
										    <input type="hidden" name="person_upload" id="mfilea" value="<?php echo $person_upload !== '' ? $person_upload : ''; ?>" />
										</td>
										  <td width="20%" id="tdfilea">
													<?php if($person_upload!="" && $person_upload!="SC" && $person_upload!="NA"){ echo '<a href="'.$upload.$person_upload.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										  </td>
										</tr>
                                    <tr>
												<td>10. Licence Annual Capacity of the Factory/Industry.:</td>
												<td><input type="text" class="form-control text-uppercase" name="licence_annual_capacity" value="<?php echo $licence_annual_capacity;?>" ></td>
											</tr>
									       <tr>
												<td>11.  State  daily  quantity  of  water  in  kilolitres  utilised  and  its  source  (domestic/industrial process boiler Cooling others).</td>
											</tr>
											<tr>
												<td style="width:25%">(i) Industrial process</td>
												<td style="width:25%"><input type="text" validate="decimal" required="required" name="wc_values[a]" placeholder="example : 23.00" title="Please enter a decimal value" value="<?php echo $wc_values_a; ?>" class="form-control text-uppercase wc_sum"></td>
												<td style="width:25%">(ii) Domestic purpose</td>
												<td style="width:25%"><input type="text" validate="decimal" name="wc_values[b]"  value="<?php echo $wc_values_b; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class=" form-control text-uppercase wc_sum"></td>
											</tr>
											<tr>
												<td style="width:25%">(iii) Boiler</td>
												<td style="width:25%"><input type="text" validate="decimal" required="required" name="wc_values[c]" placeholder="example : 23.00" title="Please enter a decimal value" value="<?php echo $wc_values_c; ?>" class="form-control text-uppercase wc_sum"></td>
												<td style="width:25%">(iv) Cooling </td>
												<td style="width:25%"><input type="text" validate="decimal" name="wc_values[d]"  value="<?php echo $wc_values_d; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class=" form-control text-uppercase wc_sum"></td>
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
											   <td colspan="2">12. (a)  State  the  daily  maximum  quantity  of  effluents  quantity  and  mode  of  disposal (sewer  or  drains  or  river).  Also  attach  analysis  report  of  the  effluents. Type  of effluent quantity in kilolitres Mode of disposal.</td> 
											</tr>
											<tr>
											   <td>(i) Domestic :</td>
											   <td><input type="text" class="form-control text-uppercase" name="dome_stic" value="<?php echo  $dome_stic; ?>"></td>
											   <td>(ii) Industrial.:</td>
											   <td><input type="text" class="form-control text-uppercase" name="indus_trial" value="<?php echo  $indus_trial; ?>" ></td>
										    </tr>
											<tr>
											    <td>Attach  analysis  report  of  the  effluents.</td>
											</tr>
											<tr>
											   <td>Upload File</td>
											   <td width="30%">
											    <select trigger="FileModal" id="fileb" class="form-control">                                            
												<option value="0" selected="selected"><?php echo uploadinfo($effluents_upload); ?></option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
												<option value="4">Send by Courier</option>
												<option value="3">Not Applicable</option>
											</select>
										<input type="hidden" name="effluents_upload" id="mfileb" value="<?php echo $effluents_upload !== '' ? $effluents_upload : ''; ?>" />
										</td>
										<td width="20%" id="tdfileb">
													<?php if($effluents_upload!="" && $effluents_upload!="SC" && $effluents_upload!="NA"){ echo '<a href="'.$upload.$effluents_upload.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
										</tr>
										    <tr>
											   <td>(b) Quality of effluent currently being the discharged or expected to be discharged. :</td>
											   <td><input type="text" class="form-control text-uppercase" name="quality_of_effluent" value="<?php echo  $quality_of_effluent; ?>"></td>
											   <td>(c) What monitoring arrangement is currently there or proposed.:</td>
											   <td><input type="text" class="form-control text-uppercase" name="monitoring_arrangemen" value="<?php echo  $monitoring_arrangemen; ?>"	></td>
										    </tr>
										    <tr>
												<td colspan="2">13.  State  whether  you  have  any  treatment  plant  for  industrial,  domestic  or  combined effluents. </td>
												<td>
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_treatment_plant=="Y" || $is_treatment_plant=="") echo "checked"; ?> name="is_treatment_plant"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_treatment_plant=="N") echo "checked"; ?> name="is_treatment_plant"> No </label>
												</td>
											</tr>									
											<tr>
												<td colspan="2">If yes attach the description of the process of treatment in brief. Attach information on the quality of treated effluent vis-a-vis the standards.  </td>
											</tr>
											<tr>
											   <td colspan="2">Upload File</td>
											   <td width="30%">
											    <select trigger="FileModal" id="filec" class="form-control">                                            
												<option value="0" selected="selected"><?php echo uploadinfo($details_upload); ?></option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
												<option value="4">Send by Courier</option>
												<option value="3">Not Applicable</option>
											</select>
										<input type="hidden" name="details_upload" id="mfilec" value="<?php echo $details_upload !== '' ? $details_upload : ''; ?>" />
										</td>
										<td width="20%" id="tdfilec">
													<?php if($details_upload!="" && $details_upload!="SC" && $details_upload!="NA"){ echo '<a href="'.$upload.$details_upload.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
										</tr>	
										<tr>												
												<td class="text-center" colspan="4">&nbsp;</td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">
													<button type="submit" name="save51a"  class="btn btn-success text-bold submit1">Save and Next</button>
												</td>												
											</tr>
										</table>
										</form>
									</div>
									<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td>14. State details of sold wastes generated in the process or during waste treatment. </td>
											</tr>
											<tr>
											   <td>Description </td>
												<td><input type="text" name="sold_wastes[a]"  value="<?php echo $sold_wastes_a;?>" class="form-control text-uppercase"></td>
												<td>Quantity </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="sold_wastes[b]" value="<?php echo $sold_wastes_b;?>" ></td>
											</tr> 
											<tr>
											   <td>Method </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="sold_wastes[c]" value="<?php echo $sold_wastes_c;?>" ></td>
												<td>Method of disposal </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="sold_wastes[d]"  value="<?php echo $sold_wastes_d;?>" ></td>
											</tr>
											<tr>
												<td colspan="4">15.  I/We  further  declare  that  the  information  furnished  above  is  correct  to  the  best  of  my/our knowledge.  </td>
											</tr>
											<tr>
												<td colspan="4">16.  I/We  hereby  submit  that  in  case  of  change  either  of  the  point  of  discharge  or  the quantity of discharge  or its quality a  fresh application for CONSENT shall be  made and until such CONSENT is granted no change shall be made.    </td>
											</tr>
											<tr>
												<td colspan="4">17.  I/We  hereby  agree  to  submit  to  the  Central  Board  an  application  for  renewal  of consent  one  month  in  advance  of  the  date  of  expiry  of  the  consented  period  for outlet/discharge if to be continued thereafter.  </td>
											</tr>
											<tr>
												<td colspan="4">18. I/We, undertake to furnish any other information within one month or its being called by the Central Board.  </td>
											</tr>
										   <tr>												
												<td class="text-center" colspan="4">&nbsp;</td>
											</tr>
											<tr>										
										<td class="text-center" colspan="4">
											<a href="pcb_form51.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save51b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>								
							</table>
							</form>
							</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">					
									<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
										<table class="table table-responsive table-bordered">
											<tr>
												<td style="width:40%">Attach the list of raw materials and chemicals used per month. <span class="mandatory_field">*</span></td>
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
												<td style="width:40%">Attach the description of the process of treatment plant for industrial, domestic or combined effluents. <span class="mandatory_field">*</span></td>
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
                                            <?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                                         </td>
										</tr>
										<tr>
												<td style="width:40%">Attach information on the quality of treated effluent vis-a-vis the standards. <span class="mandatory_field">*</span></td>
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
									    <td class="text-center" colspan="5">
										 <a href="pcb_form51.php?tab=2"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>	
										 <button type="submit" class="btn btn-success submit1" name="submit51" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
			$('#is_provided_yes').val('');			
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