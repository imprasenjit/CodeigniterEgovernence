<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dic','10');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=10&dept=dic';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=10&dept=dic';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_dic_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$l_o_business=$row1['Type_of_ownership'];$Name_of_owner=$row1['Name_of_owner'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_pincode2=$row1['b_pincode2'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative Society";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Association of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$q=$dic->query("select * from dic_form10 where  user_id='$swr_id' and active='1'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	//Empty Table
		$indus_land="";$actual_area="";$lic_no="";$lic_date="";$item_name="";$production_capacity="";$prod_export="";$civil_works="";$plant_n_machinery="";$other_fixed_assets="";$actual_prod_area="";$godown="";$other_services="";$power_req="";$water_req="";$if_any="";$PI_indicate="";
		$file1="";$file2="";$file3="";$file4="";$file5="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	else{
		$form_id=$results['form_id'];	
		$indus_land=$results["indus_land"];
		$actual_area=$results["actual_area"];
		$lic_no=$results["lic_no"];
		$lic_date=$results["lic_date"];
		$item_name=$results["item_name"];
		$production_capacity=$results["production_capacity"];
		$prod_export=$results["prod_export"];
		$civil_works=$results["civil_works"];
		$plant_n_machinery=$results["plant_n_machinery"];
		$other_fixed_assets=$results["other_fixed_assets"];
		$actual_prod_area=$results["actual_prod_area"];
		$godown=$results["godown"];
		$other_services=$results["other_services"];
		$power_req=$results["power_req"];
		$water_req=$results["water_req"];
		$if_any=$results["if_any"];
		$PI_indicate=$results["PI_indicate"];
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];
				
	}
	##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName('dic','10'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
							    <ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">Upload Section</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform10" id="myformFT1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									
									<tr>
										<td width="25%">Industrial land available at:</td>
										<td width="25%">
											<select required="required" class="form-control text-uppercase" name="indus_land" required>
												<option value="" class="form-control text-uppercase">Please select any one option</option>
												<option value="Industrial Growth Centre , Matia, Goalpara" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="Industrial Growth Centre , Matia, Goalpara") echo 'selected'; ?>>Industrial Growth Centre , Matia, Goalpara</option>
												<option value="Industrial Growth Centre, Balipara, Sonitpur" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="Industrial Growth Centre, Balipara, Sonitpur") echo 'selected'; ?>>Industrial Growth Centre, Balipara, Sonitpur</option>
												<option value="IIDC Dimow, Sivasagar" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IIDC Dimow, Sivasagar") echo 'selected'; ?>>IIDC Dimow, Sivasagar</option>
												<option value="IIDC Dalgaon, Darrang" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IIDC Dalgaon, Darrang") echo 'selected'; ?>>IIDC Dalgaon, Darrang</option>
												<option value="IIDC Bhomoraguri/Naltali, Nagaon" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IIDC Bhomoraguri/Naltali, Nagaon") echo 'selected'; ?>>IIDC Bhomoraguri/Naltali, Nagaon</option>
												<option value="IIDC Malinibeel, Cachar" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IIDC Malinibeel, Cachar") echo 'selected'; ?>>IIDC Malinibeel, Cachar</option>
												<option value="IIDC Titabor, Jorhat" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IIDC Titabor, Jorhat") echo 'selected'; ?>>IIDC Titabor, Jorhat</option>
												<option value="IIDC Silapathar, Dhemaji" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IIDC Silapathar, Dhemaji") echo 'selected'; ?>>IIDC Silapathar, Dhemaji</option>
												<option value="IIDC Tihu, Nalbari" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IIDC Tihu, Nalbari") echo 'selected'; ?>>IIDC Tihu, Nalbari</option>
												<option value="Plastic Park, Tinsukia" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="Plastic Park, Tinsukia") echo 'selected'; ?>>Plastic Park, Tinsukia</option>
												<option value="ID Pathsala, Barpeta" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="ID Pathsala, Barpeta") echo 'selected'; ?>>ID Pathsala, Barpeta</option>
												<option value="Food Processing Park, Chaygaon, Kamrup" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="Food Processing Park, Chaygaon, Kamrup") echo 'selected'; ?>>Food Processing Park, Chaygaon, Kamrup</option>
												<option value="Industrial area, Dolabari, Tezpur, Sonitpu" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="Industrial area, Dolabari, Tezpur, Sonitpu") echo 'selected'; ?>>Industrial area, Dolabari, Tezpur, Sonitpu</option>
												<option value="IID Banderdewa, Lakhimpur" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IID Banderdewa, Lakhimpur") echo 'selected'; ?>>IID Banderdewa, Lakhimpur</option>
												<option value="IID Serfunguri, Kokrajhar" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IID Serfunguri, Kokrajhar") echo 'selected'; ?>>IID Serfunguri, Kokrajhar</option>
												<option value="IID Parbatipur, Tinsukia" class="form-control text-uppercase" <?php if(isset($indus_land) && $indus_land=="IID Parbatipur, Tinsukia") echo 'selected'; ?>>IID Parbatipur, Tinsukia</option>
										  </select>
									  </td>
									  <td width="25%"></td>
									  <td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">1. Location of land/Shed applied for (Actual name of the industrial property as mentioned):</td>
									</td>
									</tr>
									<tr>
										<td width="25%">Street Name1:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name1	; ?>" disabled></td>
										<td width="25%">Street Name2:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name2	; ?>" disabled></td>
									</tr>
									<tr>
										<td width="25%">Vill/Town:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_vill; ?>" disabled></td>
										<td width="25%">District:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_dist; ?>" disabled></td>
									</tr>
									<tr>
										<td width="25%">PIN Code:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_pincode; ?>" disabled></td>
										<td width="25%">Mobile No:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_mobile_no; ?>" disabled></td>
									</tr>
									<tr>
										<td width="25%">Phone Number:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_landline_std."-".$b_landline_no; ?>" disabled></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">2. Actual area applied for (in terms of sqmeter/ft):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="actual_area" value="<?php echo $actual_area; ?>" validate="decimal"></td>
										<td width="25%">3. Name of the Industrial Unit:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $unit_name; ?>" disabled></td>
									</tr>
									<tr>
										<td colspan="4">4. Address for communication</td>								
									</tr>
									<tr>
										<td width="25%">Street Name 1:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name3; ?>"disabled></td>
										<td width="25%">Street Name 2:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name4; ?>"disabled></td>
									</tr>
									<tr>
										<td width="25%">Vill/Town:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_vill2; ?>"disabled></td>
										<td width="25%">District:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_dist2; ?>"disabled></td>
									</tr>
									<tr>
										<td width="25%">PIN Code</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_pincode2; ?>" disabled></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									
									<tr>
										<td width="25%">5. Constitution of the Industrial unit:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $l_o_business_val; ?>" disabled></td>
										<td width="25%">6. Name of the Proprietor/Partner/Board of Directors:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $Name_of_owner; ?>" disabled></td>
									</tr>
									<tr>
										<td width="25%">7. (a)EM-I/EM- II/IEM/Industrial Licence no:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="lic_no" value="<?php echo $lic_no; ?>" ></td>
										<td width="25%"> (b)Licence date:</td>
										<td width="25%"><input class="dob form-control text-uppercase" type="text" name="lic_date" value="<?php echo $lic_date; ?>" readonly="readonly"></td>
									</tr>
									<tr>
										<td width="25%">8. Name of Item/s of manufacture:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="item_name" value="<?php echo $item_name; ?>" validate="letters"></td>
										<td width="25%">9. Proposed Annual Installed Capacity of Production in MT (item-wise):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="production_capacity" value="<?php echo $production_capacity; ?>"></td>
									</tr>
									<tr>
										<td width="25%">10. Proposed export of product (in terms of MT):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="prod_export" value="<?php echo $prod_export; ?>" validate="decimal"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td  colspan="4">11. Proposed investment (Rs. in lakh)</td>
										
									</tr>
									<tr>
										<td width="25%">(a) Civil works:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="civil_works" value="<?php echo $civil_works; ?>" validate="onlyNumbers"></td>
										<td width="25%">(b) Plant &amp; Machinery:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="plant_n_machinery" value="<?php echo $plant_n_machinery; ?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td width="25%">(c) Other fixed assets:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="other_fixed_assets" value="<?php echo $other_fixed_assets; ?>" validate="onlyNumbers"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">12. Requirement of Land (sq ft)</td>
									</tr>
									<tr>
										<td width="25%">(a) For actual production area ( sq ft):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="actual_prod_area" value="<?php echo $actual_prod_area; ?>" validate="decimal" validate="decimal"></td>
										<td width="25%">(b) For Godown ( sq ft):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="godown" value="<?php echo $godown; ?>" validate="decimal"></td>
									</tr>
									<tr>
										<td width="25%">(c) Other utility services ( sq ft):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="other_services" value="<?php echo $other_services; ?>" validate="decimal"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">13. Other amenities</td>
										
									</tr>
									<tr>
										<td width="25%">(a) Requirement of Power (HP):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="power_req" value="<?php echo $power_req; ?>" validate="decimal"></td>
										<td width="25%">(b) Annual requirement of Water (in KL):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="water_req" value="<?php echo $water_req; ?>" validate="decimal"></td>
									</tr>
									<tr>
										<td width="25%">14. If there any effluent problem:</td>
										<td width="25%">
											<label class="radio-inline"><input type="radio" required="required" name="if_any" value="Y"  <?php if(isset($if_any) && $if_any=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="if_any"  value="N"  <?php if(isset($if_any) && $if_any=='N') echo 'checked'; ?>/> No</label>
										</td>
										<td width="25%">15. If yes , Pl indicate with 50 words:</td>
										<td width="25%"><textarea name="PI_indicate"  id="PI_indicate" class="form-control text-uppercase"  ><?php echo $PI_indicate; ?></textarea></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td align="right"><label><b><?php echo strtoupper($key_person); ?></b></label><br/>Signature of the Applicant</td>
									</tr>
									<tr>
										<td colspan="4" align="center">
										<button type="submit" name="save10" class="btn btn-success" title="Save it and go to the next part">Save & Next</button></td>
									</tr>
								</table>
								</form>
								</div>
              <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
				<form name="fileUpload" id="dic1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				<table id="" class="table table-responsive">	
				<tr>
					<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
				</tr>
				<tr>
					<td width="50%">Copy EM-I/EM- II/IEM/ Industrial License as applicable.</td>
					<td width="10%">
					<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
						<option value="0" selected="selected">Select</option>
						<option value="1">From E-Locker</option>
						<option value="2">From PC</option>
					</select>
					<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
					</td>
					<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</td>
					<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</td>	
				</tr>
				<tr>
					<td>A copy of Project Report.</td>
					<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
					<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo 'No File Selected'; } ?></td>
					<td><input type="CheckBox" id="B1" class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</td>
					<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</td>
				</tr>
				<tr>
					<td>Company Registration with Article of Memorandum of Association/Partnership deed as applicable.</td>
					<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
					<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="C1"  class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</td>
					<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</td>
				</tr>
				<tr>
					<td>Plant layout indicating the area for installation of machinery, space for raw	
					material/finished products, generator set, utility services, etc.</td>
					<td><select trigger="FileModal" class="file4" id="file4" <?php if($file4!="" || $file4=="SC" || $file4=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile4" value="<?php if($file4!="") echo $file4; ?>" id="mfile4" readonly="readonly"/></td>
					<td width="20%" id="mfile4-chiranjit"><?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file4" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</td>
				</tr>
				<tr> 
					<td>Last three years balance sheets in case of existing unit.</td>
					<td><select trigger="FileModal" class="file5" id="file5" <?php if($file5!="" || $file5=="SC" || $file5=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile5" value="<?php if($file5!="") echo $file5; ?>" id="mfile5" readonly="readonly"/></td>
					<td width="20%" id="mfile5-chiranjit"><?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="E1" class="file5" name="E1" <?php if($file5=="NA") echo "checked"; ?> <?php if($file5!="" && $file5!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</td>
					<td><input type="CheckBox" id="E2" class="file5 cd" name="E2" <?php if($file5=="SC") echo "checked"; ?> <?php if($file5!="" && $file5!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</td>
				</tr>
				<tr>
					<td class="text-center" colspan="5">
						<a href="dic_form10.php?tab=1" class="btn btn-primary">Go Back & Edit</a>	
						<button type="submit" class="btn btn-success" name="submit10" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
					</td>
					
				</tr>
				
			</table>
			</form>
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
	<?php if($if_any=="N"){ ?>
		$('#PI_indicate').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="if_any"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#PI_indicate').removeAttr('disabled', 'disabled');			
		}else{
			$('#PI_indicate').attr('disabled', 'disabled');			
		}
	});
	
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>