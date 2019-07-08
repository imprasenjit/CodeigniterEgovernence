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
if((isset($_GET['Agency']) && !empty($_GET['Agency'])) && (isset($_GET['Name_of_the_infrastructure_with_location']) && !empty($_GET['Name_of_the_infrastructure_with_location'])) && (isset($_GET['District']) && !empty($_GET['District']))){
	$_SESSION["authority"] = $authority = $_GET['Agency'];
	$_SESSION["indus_land"] = $indus_land = $_GET['Name_of_the_infrastructure_with_location'];
	$_SESSION["District"] = $dicc_district = $_GET['District'];
}elseif(isset($_SESSION["authority"]) && isset($_SESSION["indus_land"]) && isset($_SESSION["District"])){	
	$authority = $_SESSION["authority"];
	$indus_land = $_SESSION["indus_land"];
	$dicc_district = $_SESSION["District"];
}else{	
	echo "<script>	
				alert('Please select a available plot area.');
				window.location.href = '".$server_url."homepage/landbank.php';
		</script>";
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
		$actual_area="";$lic_no="";$lic_date="";$item_name="";$production_capacity="";$prod_export="";$civil_works="";$plant_n_machinery="";$other_fixed_assets="";$actual_prod_area="";$godown="";$other_services="";$power_req="";$water_req="";$if_any="";$PI_indicate="";
		$file1="";$file2="";$file3="";$file4="";$file5="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	else{
		$form_id=$results['form_id'];	
		if(isset($_SESSION["authority"])){
			$authority = $_SESSION["authority"];
		}else{			
			$authority=$results["authority"];
		}
		if($authority=="DICC"){
			if(isset($_SESSION["District"])){
				$dicc_district = $_SESSION["District"];
			}else{
				$dicc_district=$results["District"];
			}
		}else{
			$dicc_district="";
		}
		if(isset($_SESSION["indus_land"])){
			$indus_land = $_SESSION["indus_land"];
		}else{
			$indus_land=$results["indus_land"];
		}
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
	if($authority=="AIDC"){
		$authority_name = "Assam Industrial Development Corporation Limited";
	}elseif($authority=="AIIDC"){
		$authority_name = "Assam Industrial Infrastructure Development Corporation Limited";
	}elseif($authority=="ASIDC"){
		$authority_name = "Assam Small Industries Development Corporation Limited";
	}elseif($authority=="DICC"){
		$authority_name = "District Industries & Commerce Center";
	}else{
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
								<form name="myform10" id="myformFT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">District : <span class="mandatory_field">*</span></td>
										<td width="25%">												
											<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC") OR die("Error : ".$mysqli->error); ?>
												<select name="dicc_district" id="dicc_district"   class="form-control text-uppercase" required="required">
													<option value=""><?php  if($dicc_district!=""){ echo strtoupper($dicc_district);}else{ echo "Select District";} ?></option>
													<?php while($rows_dist=$dstresult->fetch_object()) {
														if(isset($dicc_district) && ($dicc_district==$rows_dist->district)){
															$s='selected'; 
														}else{
															$s='';
														}  ?>
														<option value="<?php echo $rows_dist->district; ?>" <?php echo $s;?>><?php echo $rows_dist->district; ?></option>
													<?php }		?>
												</select>											
											<input type="hidden" class="form-control text-uppercase" name="dicc_district" value="<?=strtoupper($dicc_district);?>" readonly="readonly">
										</td>
										<td width="25%">Industrial land available at : <span class="mandatory_field">*</span></td>
										<td width="25%">
											<input class="form-control text-uppercase" type="text" name="indus_land" value="<?=strtoupper($indus_land);?>" readonly="readonly">
										</td>
									</tr>
									<tr>										
										<td width="25%">Authority : <span class="mandatory_field">*</span></td>
										<td width="25%">
											<input type="text" class="form-control text-uppercase" name="authority_name" value="<?=strtoupper($authority_name);?>" readonly="readonly">
											<input type="hidden" class="form-control text-uppercase" name="authority" value="<?=strtoupper($authority);?>" readonly="readonly">
										</td>
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
										<td width="25%">2. Actual area applied for (in terms of sqmeter) :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="actual_area" value="<?php echo $actual_area; ?>" ></td>
										<td width="25%">3. Name of the Industrial Unit :</td>
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
										<td width="25%"><input class="dobindia form-control text-uppercase" type="text" name="lic_date" value="<?php if($lic_date!="0000-00-00" && $lic_date!="") echo date("d-m-Y",strtotime($lic_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td width="25%">8. Name of Item/s of manufacture :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="item_name" value="<?php echo $item_name; ?>" validate="letters"></td>
										<td width="25%">9. Proposed Annual Installed Capacity of Production in MT (item-wise) :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="production_capacity" value="<?php echo $production_capacity; ?>"></td>
									</tr>
									<tr>
										<td width="25%">10. Proposed export of product (in terms of MT) :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="prod_export" value="<?php echo $prod_export; ?>" validate="decimal"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td  colspan="4">11. Proposed investment (Rs. in lakh)</td>										
									</tr>
									<tr>
										<td width="25%">(a) Civil works :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="civil_works" value="<?php echo $civil_works; ?>" validate="onlyNumbers"></td>
										<td width="25%">(b) Plant &amp; Machinery :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="plant_n_machinery" value="<?php echo $plant_n_machinery; ?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td width="25%">(c) Other fixed assets :</td>
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
										<td width="25%">14. If there any effluent problem:<span class="mandatory_field">*</span></td>
										<td width="25%">
											<label class="radio-inline"><input type="radio" required="required" name="if_any" value="Y"  <?php if(isset($if_any) && $if_any=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="if_any"  value="N"  <?php if(isset($if_any) && $if_any=='N') echo 'checked'; ?>/> No</label>
										</td>
										<td width="25%">15. If yes , Please indicate with 50 words:</td>
										<td width="25%"><textarea name="PI_indicate"  id="PI_indicate" class="form-control text-uppercase"  ><?php echo $PI_indicate; ?></textarea></td>
									</tr>
									<tr>
										<td>Date : <label><b><?php echo date('d-m-Y',strtotime($today));?></b></label><br/>
										Place : <label><b><?=strtoupper($dist);?></b></label></td>
										<td></td>
										<td></td>
										<td align="right"><label><b><?php echo strtoupper($key_person); ?></b></label><br/>Signature of the Applicant</td>
									</tr>
									<tr>
										<td colspan="4" align="center">
										<button type="submit" name="save10" class="btn btn-success submit1" title="Save it and go to the next part">Save & Next</button></td>
									</tr>
								</table>
								</form>
								</div>
              <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
				<form name="fileUpload" id="dic1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				<table id="" class="table table-responsive">	
				<tr>
					<td colspan="5">Documents to be enclosed<span class="mandatory_field">*</span> <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
				</tr>
				<tr>
					<td width="50%">Copy EM-I/EM- II/IEM/ Industrial License as applicable.</td>
					
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
					<td>A copy of Project Report.</td>
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
					<td>Company Registration with Article of Memorandum of Association/Partnership deed as applicable.</td>
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
					<td>Plant layout indicating the area for installation of machinery, space for raw	
					material/finished products, generator set, utility services, etc.</td>
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
					<td>Last three years balance sheets in case of existing unit.</td>
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
					<td class="text-center" colspan="5">
						<a href="dic_form10.php?tab=1" class="btn btn-primary">Go Back & Edit</a>	
						<button type="submit" class="btn btn-success submit1" name="submit10" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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