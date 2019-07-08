<?php require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('rfs','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=rfs';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=rfs';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=1';</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include("save_form.php");
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	$land_type=$row1['w_l'];$mouza=$row1['mouza'];$patta_no=$row1['pattano'];$dag_no=$row1['dagno'];$pan_doc=$row1['pan_doc'];
	;$circle=$row1['revenue'];$area=$b_street_name3." ,".$b_street_name4;
	
	if($land_type=='O') $land_type="Owned Premises";
	else if($land_type=='L') $land_type="Leased Premises";
	else $land_type="Rented Premises";
	
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$sector_classes_b=$row1['sector_classes_b'];
	$sector_classes_b=get_sector_classes_b_value($sector_classes_b);
	$l_o_business=$row1['Type_of_ownership'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative rfs";$l_o_business_name="Members";
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
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	
	$q=$rfs->query("select * from rfs_form1 where user_id='$swr_id' and active='1' ") or die($rfs->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	
		$form_id="";
		$firm_duration="";$firm_date_expiry="";$po_name="";$ps_name="";$is_different="";$o_land_type="";
		$other_address_mouza="";$other_address_circle="";$other_address_patta_no="";$other_address_dag_no="";$other_address_area_no="";$other_address_loc="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
		$reg_deed_no="";$reg_deed_dte="";$reg_deed_place="";
		$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		$treasury_challan_no="";$treasury_challan_date="";$treasury_challan_branch="";
		$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";
	
	}else{
		$form_id=$results["form_id"];
		$firm_duration=$results["firm_duration"];$firm_date_expiry=$results["firm_date_expiry"];$po_name=$results["po_name"];$ps_name=$results["ps_name"];$is_different=$results["is_different"];$o_land_type=$results["o_land_type"];
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];$file10=$results["file10"];
		if(!empty($results["other_address"])){
			$other_address=json_decode($results["other_address"]);
			$other_address_mouza=$other_address->mouza;$other_address_circle=$other_address->circle;$other_address_patta_no=$other_address->patta_no;$other_address_dag_no=$other_address->dag_no;$other_address_dag_no=$other_address->dag_no;$other_address_area_no=$other_address->area_no;$other_address_loc=$other_address->loc;$other_address_vill=$other_address->vill;$other_address_po=$other_address->po;$other_address_ps=$other_address->ps;$other_address_dist=$other_address->dist;$other_address_pincode=$other_address->pincode;
		}else{
			$other_address_mouza="";$other_address_circle="";$other_address_patta_no="";$other_address_dag_no="";$other_address_area_no="";$other_address_loc="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
		}
		if(!empty($results["reg_deed"])){
			$reg_deed=json_decode($results["reg_deed"]);
			$reg_deed_no=$reg_deed->no;$reg_deed_dte=$reg_deed->dte;$reg_deed_place=$reg_deed->place;
		}else{
			$reg_deed_no="";$reg_deed_dte="";$reg_deed_place="";
		}	
		if(!empty($results["tax"])){
			$tax=json_decode($results["tax"]);
			$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
		}else{
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
		if(!empty($results["treasury"])){
			$treasury=json_decode($results["treasury"]);
			$treasury_challan_no=$treasury->challan_no;$treasury_challan_date=$treasury->challan_date;$treasury_challan_branch=$treasury->challan_branch;
		}else{
			$treasury_challan_no="";$treasury_challan_date="";$treasury_challan_branch="";
		}	
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}
	$q1=$rfs->query("select * from rfs_form1_members where form_id='$form_id'");
	$results1=$q1->fetch_assoc();
	if($q1->num_rows<1){
		$form_id="";
		$member_address="";$date_f_joining="";$upload_photo="";$upload_signature="";$upload_pan="";
	}
	else{
		$form_id=$results1['form_id'];
		$member_address=$results1['member_address'];$date_f_joining=$results1['date_f_joining'];$upload_photo=$results1['upload_photo'];$upload_signature=$results1['upload_signature'];$upload_pan=$results1['upload_pan'];
	}
	##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>6 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";
	}
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";
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
									<strong><?php echo $form_name=$cms->query("select form_name from rfs_form_names where form_no='1'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a  href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a  href="#table3">PART III</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a  href="#table4">Upload Section</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. Name of the Proposed Firm :</td>
										<td width="25%"><input type="text"  name="firm_name" class="form-control text-uppercase" value="<?php echo $unit_name;?>" disabled="disabled"/></td>
										<td width="25%">2. Nature of Business  :</td>
										<td width="25%"><input type="text"  name="business_nature" class="form-control text-uppercase" value="<?php  echo $sector_classes_b; ?>" disabled="disabled"/></td>
									</tr>
									<tr>
										<td>3. PAN :</td>
										<td><input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no" maxlength="10" value="<?php  echo $pan_no; ?>"  disabled="disabled"></td>
										<td>4. Duration of the Firm :</td>
										<td>
											<select  name="firm_duration" class="form-control text-uppercase" id="suni" required="true">
												<option value="">Please Select</option>
												<option  value="U" <?php if(isset($firm_duration)&& $firm_duration=='U') echo "selected"; ?>>UNLIMITED </option>
												<option  value="L" <?php if(isset($firm_duration)&& $firm_duration=='L') echo "selected"; ?>>LIMITED</option>	
											</select>
										</td>
									</tr>
									<tr>
										<td>5.(a) Date of Establishment :</td>
										<td><input type="text" id="dob" name="farm_es_date"  class="form-control text-uppercase" disabled="disabled" value="<?php if(isset($date_of_commencement)) echo date("d-m-Y",strtotime($date_of_commencement)); ?>" required></td>								
										<td>(b) Date of Expiry of the firm :</td>
										<td><input type="text" required class="dob form-control"  name="firm_date_expiry"  value="<?php  echo $firm_date_expiry; ?>"></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">5. Principle place of the proposed firm</td>
									</tr>
									<tr>
										<td width="25%">Own Land/Leased/Rented Premises</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $land_type; ?>" disabled="disabled"/></td>
										<td width="25%">Mouza </td>
										<td width="25%"><input type="text"  disabled="disabled" class="form-control text-uppercase" value="<?php  echo $mouza; ?>" ></td>
									</tr>
									<tr>
										<td>Circle </td>
										<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php  echo $circle; ?>" >
										<td>Patta No. </td>
										<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php echo $patta_no; ?>" ></td>
									</tr>
									<tr>
										<td>Dag No. </td>
										<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php  echo $dag_no; ?>" ></td>
										<td>Area </td>
										<td><input type="text" disabled="disabled"  class="form-control text-uppercase" value="<?php if(isset($area) && $area!='FA') echo $area; ?>" required ></td>
									</tr>
									<tr>
										<td>Village/Town/City </td>
										<td><input type="text" disabled="disabled"  class="form-control text-uppercase" value="<?php  echo $b_vill; ?>" ></td>
										<td>Post Office </td>
										<td><input type="text" name="po_name"  class="form-control text-uppercase" value="<?php  echo $po_name; ?>" required="required" /></td>
									</tr>
									<tr>
										<td>Police Station </td>
										<td><input type="text" name="ps_name" class="form-control text-uppercase" value="<?php echo $ps_name; ?>" required="required" ></td>
										<td>District </td>
										<td><input type="text"  class="form-control text-uppercase" value="<?php echo $b_dist; ?>" disabled="disabled"></td>
									</tr>
									<tr>
										<td>Pin Code </td>
										<td><input type="text" disabled="disabled" class="form-control text-uppercase" value="<?php echo $b_pincode; ?>"  /></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">6. Does the proposed firm carry out its business in any other place apart from the registered office ?</td>
										<td><label class="radio-inline"><input type="radio" name="is_different" value="Y"  <?php if(isset($is_different) && $is_different=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_different"  value="N"  <?php if(isset($is_different) && $is_different=='N') echo 'checked'; ?>/> No</label>
										</td>
									</tr>
								</table>
								<table id="is_different_yes" class="table-bordered table responsive">
									<tr>
										<td width="25%">Own Land/leased/rented premises</td>
										<td width="25%"><select  class="form-control text-uppercase is_different_yes_class" name="o_land_type" id="o_land_type" >
											<option value="">Please Select</option>
											<option <?php if(isset($o_land_type)&& $o_land_type=='O') echo "selected"; ?> value="O">Owned Premises</option>
											<option <?php if(isset($o_land_type)&& $o_land_type=='L') echo "selected"; ?> value="L">Leased Premises</option>
											<option <?php if(isset($o_land_type)&& $o_land_type=='R') echo "selected"; ?> value="R">Rented Premises</option>
											</select>
										</td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>Mouza </td>
										<td><input type="text" name="other_address[mouza]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_mouza; ?>" ></td>
										<td>Circle </td>
										<td><input type="text" name="other_address[circle]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_circle; ?>"  ></td>
									</tr>
									<tr>
										<td>Patta No. </td>
										<td><input type="text" name="other_address[patta_no]"  class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_patta_no; ?>"  ></td>
										<td>Dag No. </td>
										<td><input type="text" name="other_address[dag_no]"  class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_dag_no; ?>"  ></td>
									</tr>
									<tr>
										<td>Area </td>
										<td><input type="text" name="other_address[area_no]"  class="form-control text-uppercase is_different_yes_class"  value="<?php  echo $other_address_area_no; ?>">
										<td>Locality </td>
										<td><input type="text" name="other_address[loc]"  class="form-control text-uppercase is_different_yes_class" value="<?php echo $other_address_loc; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town/City </td>
										<td><input type="text" name="other_address[vill]"  class="form-control text-uppercase is_different_yes_class" value="<?php echo $other_address_vill; ?>"></td>
										<td>Post Office </td>
										<td><input type="text" name="other_address[po]"  class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_po; ?>"   ></td>
									</tr>
									<tr>
										<td>Police Station </td>
										<td><input type="text" name="other_address[ps]"  class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_ps; ?>"   ></td>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="other_address[dist]" class="form-control text-uppercase is_different_yes_class"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($other_address_dist) && ($other_address_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pin Code </td>
										<td><input type="text" class="form-control text-uppercase is_different_yes_class" name="other_address[pincode]" value="<?php echo $other_address_pincode ?>" ></td>
										<td></td>
										<td></td>
									</tr>
								</table>
								<table class=" table table-responsive table-bordered">
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit"  name="save1a" class="btn btn-success">Save and Next</button>
										</td>										
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">7. Name in full and permanent address of all the partners of the firm alongwith the date of joining, their passport size photograph and scanned copy of signature of each partner:</td>
									</tr>
									<tr>
										<td colspan="4">
										<table id="" class="text-center table table-responsive table-bordered">
										<thead>
										<tr>
											<th>Sl No.</th>
											<th>Full Name of partners</th>
											<th>Permanent Address</th>
											<th>Date of Joining</th>
											<th>Upload Photo</th>
											<th>Upload Signature</th>
											<th>Upload PAN</th>
										</tr>
										</thead>
										<?php 
										$member_results=$rfs->query("select * from rfs_form1_members where form_id='$form_id'") or die("Error : ".$rfs->error);
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="member_name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="member_address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_address; ?>" /></td>
												<td><input type="text" name="date_f_joining<?php echo $i;?>"  class="dob form-control text-uppercase" value="<?php echo $date_f_joining; ?>" /></td>
												<td><input type="text" name="upload_photo<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $upload_photo; ?>" ></td>
												<td><input type="text" name="upload_signature<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $upload_signature; ?>" ></td>
												<td><input type="text" name="upload_pan<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $upload_pan; ?>" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="member_name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->member_name; ?>" /></td>
												<td><input type="text" name="member_address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->member_address; ?>" /></td>
												<td><input type="text" name="date_f_joining<?php echo $i;?>" class="dob form-control text-uppercase" value="<?php echo $rows->date_f_joining; ?>" /></td>
												<td><input type="text" name="upload_photo<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->upload_photo; ?>"  /></td>
												<td><input type="text" name="upload_signature<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->upload_signature; ?>" /></td>
												<td><input type="text" name="upload_pan<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->upload_pan; ?>" /></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>
										</table>
										</td>
									</tr>
									<tr>					
										<td align="center" colspan="4">
											<a type="button" href="rfs_form1.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit"  name="save1b" class="btn btn-success">Save and Next</button></td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id=""  class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">8. Registered Deed of Partnership </td>
									</tr>
									<tr>
										<td width="25%">Deed No. </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_deed[no]"  value="<?php echo $reg_deed_no; ?>" required/>
										<td width="25%">Date </td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase"  name="reg_deed[dte]" value="<?php  echo $reg_deed_dte; ?>" required/>
									</tr>
									<tr>
										<td>Place of Deed Registration </td>
										<td><input type="text" class="form-control text-uppercase" name="reg_deed[place]"  value="<?php  echo $reg_deed_place; ?>" required /></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="4">9. Certificate of Sales Tax and Income Tax</td>
									</tr>
									<tr>
										<td>Certificate No. :</td>
										<td><input type='text'  class="form-control text-uppercase" name="tax[certificate_no]" value="<?php echo $tax_certificate_no; ?>" ></td>
										<td>Issued by</td>
										<td><input type='text'  name="tax[certificate_issue]" class="form-control text-uppercase"  value="<?php echo $tax_certificate_issue; ?>" ></td>
									</tr>
									<tr>
										<td>Date of Issue</td>
										<td><input type='text'  class="dob form-control text-uppercase"  name="tax[issuedate]" value="<?php echo $tax_issuedate; ?>"  ></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">10. Treasury Challan</td>
									</tr>
									<tr>
										<td>No.</td>
										<td><input type="text" class="form-control text-uppercase" name="treasury[challan_no]" value="<?php echo $treasury_challan_no; ?>" required/></td>
										<td>Date</td>
										<td><input type="text" class="dob form-control text-uppercase" name="treasury[challan_date]" value="<?php echo $treasury_challan_date; ?>" required ></td>
									</tr>
									<tr>
										
										<td>Branch</td>
										<td><input type="text" class="form-control text-uppercase" name="treasury[challan_branch]" value="<?php echo $treasury_challan_branch; ?>" required ></td>
										<td>Amount</td>
										<td colspan="2"><input type="text" class="form-control text-uppercase"  value="Rs 50/-" readonly  required/></td>
									</tr>
									<tr>
										<td colspan="2">Date : <strong><?php echo $today;?></strong><br/>
											Place : <strong><?php echo strtoupper($dist);?></strong></td>
										<td align="right" colspan="2">
											<b><?php echo strtoupper($key_person)?></b><br/>
												Signature of the Applicant</td>
									</tr>
									<tr>
										<td align="center" colspan="4">
										<a type="button" href="rfs_form1.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
										<button type="submit"  name="save1c" class="btn btn-success">Save and Next</button></td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
								<form name="myform1" id="myform5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table  id=""  class="table table-responsive" >										
									<tr>
										<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
									</tr>
									<tr>
										<td width="50%">   Filled in Form No. I and witnessed by either a jurfsial Magistrate or a Chartered Accountant </td>
										<td width="10%">
										<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>  >
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
										<td>Cerified copy of Registered Deed of Partnership</td>
										<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?>>
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
										<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td><input type="CheckBox" id="B1"  class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</td>
										<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</td>
									</tr>
									<tr>
										<td>Land Document (Jamabandi / Mutation Order / Registered Sale deed/Govt allotment order) for office accomodation of the principal place of business.</td>
										<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?> >
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
										<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td><input type="CheckBox" id="C1" class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</td>
										<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</td>
									</tr>
									<tr>
										<td>	If not Land Lease Agreement/Affidavit from the house owner if does not have own land for principal place of business </td>
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
										<td> Land Document (Jamabandi / Mutation Order / Registered Sale deed/Govt allotment order) for office accomodation of any other place of business.</td>
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
										<td>If not Land Lease Agreement/Affidavit from the house owner if does not have own land for any other place of business.</td>
										<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
										<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file6" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td><input type="CheckBox" id="F1" class="file6" name="F1" <?php if($file6=="NA") echo "checked"; ?> <?php if($file6!="" && $file6!="NA") echo "disabled='disabled'"; ?> value='F1' onClick="checkData(this)">N/A</td>
										<td><input type="CheckBox" id="F2" class="file6 cd" name="F2" <?php if($file6=="SC") echo "checked"; ?> <?php if($file6!="" && $file6!="SC") echo "disabled='disabled'"; ?> value='F2' onClick="checkData(this)">S/C</td>
									</tr>
									<tr>
										<td> Trade License obtained from the Municipal Corporation/ Municipal Board / Town commitee or Gaon Panchayat</td>
										<td><select trigger="FileModal" class="file7" id="file7" <?php if($file7!="" || $file7=="SC" || $file7=="NA") echo "disabled='disabled'"; ?>>
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile7" value="<?php if($file7!="") echo $file7; ?>" id="mfile7" required="required"/></td>
										<td width="20%" id="mfile7-chiranjit"><?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td><input type="CheckBox" id="G1" class="file7" name="G1" <?php if($file7=="NA") echo "checked"; ?> <?php if($file7!="" && $file7!="NA") echo "disabled='disabled'"; ?> value='G1' onClick="checkData(this)">N/A</input></td>
										<td><input type="CheckBox" id="G2" class="file7 cd" name="G2" <?php if($file7=="SC") echo "checked"; ?> <?php if($file7!="" && $file7!="SC") echo "disabled='disabled'"; ?> value='G2' onClick="checkData(this)">S/C</input></td>
									</tr>
									<tr>
										<td>PAN Card of the firm</td>
										<td><a href="<?php echo $upload.$pan_doc;?>" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Sales Tax and Income Tax</td>
										<td><select trigger="FileModal" class="file8" id="file8" <?php if($file8!="" || $file8=="SC" || $file8=="NA") echo "disabled='disabled'"; ?> >
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile8" value="<?php if($file8!="") echo $file8; ?>" id="mfile8" readonly="readonly"/></td>
										<td width="20%" id="mfile8-chiranjit"><?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file8" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td><input type="CheckBox" id="H1" class="file8" name="H1" <?php if($file8=="NA") echo "checked"; ?> <?php if($file8!="" && $file8!="NA") echo "disabled='disabled'"; ?> value='H1' onClick="checkData(this)">N/A</input></td>
										<td><input type="CheckBox" id="H2" class="file8 cd" name="H2" <?php if($file8=="SC") echo "checked"; ?> <?php if($file8!="" && $file8!="SC") echo "disabled='disabled'"; ?> value='H2' onClick="checkData(this)">S/C</input></td>
									</tr>
									<tr>
										<td> If not Affidavit of the same </td>
										<td><select trigger="FileModal" class="file9" id="file9" <?php if($file9!="" || $file9=="SC" || $file9=="NA") echo "disabled='disabled'"; ?> >
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile9" value="<?php if($file9!="") echo $file9; ?>" id="mfile9" readonly="readonly"/></td>
										<td width="20%" id="mfile9-chiranjit"><?php if($file9!="" && $file9!="SC" && $file9!="NA"){ echo '<a href="'.$upload.$file9.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file9" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td><input type="CheckBox" id="I1" class="file9" name="I1" <?php if($file9=="NA") echo "checked"; ?> <?php if($file9!="" && $file9!="NA") echo "disabled='disabled'"; ?> value='I1' onClick="checkData(this)">N/A</input></td>
										<td><input type="CheckBox" id="I2" class="file9 cd" name="I2" <?php if($file9=="SC") echo "checked"; ?> <?php if($file9!="" && $file9!="SC") echo "disabled='disabled'"; ?> value='I2' onClick="checkData(this)">S/C</td>
									</tr>
									<tr>
										<td class="text-center" colspan="5">
											<a href="rfs_form1.php?tab=3" type="button" class="btn btn-primary">Go Back & Edit</a>										
											<button type="submit" class="btn btn-success" name="submit1" title="Save it and fill up the form later and Go to the Next Part" > SUBMIT</button>
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
<?php require '../../../user_area/includes/js.php'; ?>
<script>
	
	$('#tab2, #tab3, #tab4').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3').css('display', 'none');
	});

  /*------------------------------------------------*/
$('#is_different_yes').css('display','table');	
$('.is_different_yes_class').attr('required','required'); 
	<?php if($is_different == 'N' || $is_different == ''){ ?>
		$('#is_different_yes').css('display','none');
		$('.is_different_yes_class').removeAttr('required','required');
	<?php } ?>
		
	
	$('input[name="is_different"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_different_yes').css('display','table');			
			$('.is_different_yes_class').attr('required','required');			
		}else{
			$('#is_different_yes').css('display','none');			
			$('.is_different_yes_class').removeAttr('required','required');			
		}
	});
  /*------------------------------------------------*/

/* ----------------------------------------------------- */

</script>
</body>
</html>