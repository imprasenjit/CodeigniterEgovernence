<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('dsedu','1');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=dsedu';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=dsedu';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=1';</script>";
}else{
	$showtab="";
}

$get_file_name=basename(__FILE__);	
include "save_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner); 
		$q=$dsedu->query("select * from dsedu_form1 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";$is_="";$edu_proposed="";$inst_location="";$measure_land="";$land_status="";$instutition_names="";$proposed_scheme="";$is_residential="";$capacity="";$academic="";$ins_name="";$funds="";$fee_structure="";$finan_status="";$project_cost="";$time_frame="";$dist2="";$pin2="";$parking="";
			$is_registration_a="";$is_registration_b="";
			$is_nonResidential_a="";$is_nonResidential_b="";
			$semi_residential_a="";$semi_residential_b="";
			$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];$edu_proposed=$results["edu_proposed"];$inst_location=$results["inst_location"];$measure_land=$results["measure_land"];$land_status=$results["land_status"];$instutition_names=$results["instutition_names"];$proposed_scheme=$results["proposed_scheme"];$capacity=$results["capacity"];$academic=$results["academic"];$time_frame=$results["time_frame"];$ins_name=$results["ins_name"];	$fee_structure=$results["fee_structure"];$finan_status=$results["finan_status"];$project_cost=$results["project_cost"];$funds=$results["funds"];$is_residential=$results["is_residential"];$is_registration=$results["is_registration"];	
			$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];
			if(!empty($results["is_nonResidential"])){
				$is_nonResidential=json_decode($results["is_nonResidential"]);
				$is_nonResidential_a=$is_nonResidential->a;$is_nonResidential_b=$is_nonResidential->b;
			}else{				
				$is_nonResidential_a="";$is_nonResidential_b="";
			}				
			if(!empty($results["semi_residential"])){
				$semi_residential=json_decode($results["semi_residential"]);
				$semi_residential_a=$semi_residential->a;$semi_residential_b=$semi_residential->b;
			}else{				
				$semi_residential_a="";$semi_residential_b="";
			}	
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}	
	}
	$q1=$dsedu->query("select * from dsedu_form1_members where form_id='$form_id'");
	$results1=$q1->fetch_array();
	if($q1->num_rows<1){
		$form_id="";
		$address="";$pincode="";$contact="";
	}
	else{
		$form_id=$results1['form_id'];
		$address=$results1['address'];$pincode=$results1['pincode'];$contact=$results1['contact'];
	}
		##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
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
<div id="gif"></div>
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$cms->query("select form_name from dsedu_form_names where form_no='1'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part 2</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a  href="javascript:void(0)">Upload Section</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="3">1. Name of the Organization/ Individual/Group of individuals/ Society/ Trust</td>
											<td ><input validate="specialChar" type="text" value="<?php echo $unit_name; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td colspan="4">2. Full Postal Address with Pin code and contact telephone No</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name1; ?>"	></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">3. Name of Members of the organization	with postal address and contact with postal address and contact the telephone No.  </td>
										</tr>
										<tr>
											<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr >
												<th>Sl. No.</th>
												<th>Name</th>
												<th>Address</th>
												<th>Pincode</th>
												<th>Contact No</th>
											</tr>
										</thead>	
											<?php 
											$member_results=$dsedu->query("select * from dsedu_form1_members where form_id='$form_id'") or die("Error : ".$dsedu->error);		
											if($member_results->num_rows==0){
												for($i=1;$i<=count($owners);$i++){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
													<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="" ></td>
													<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="10" value="" ></td>
												</tr>
												<?php } ?>
												<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
											<?php }else{
													$i=1;
											while($rows=$member_results->fetch_object()){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
													<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="<?php echo $rows->address; ?>" /></td>
													<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pincode; ?>" maxlength="6" validate="pincode" ></td>
													<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="10" value="<?php echo $rows->contact; ?>" /></td>
												</tr>
											<?php $i++;
											} ?>
												<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
											<?php } ?>									
											</td>
											</tr>
											</table></td>
										</tr>
										<tr>
											<td colspan="3">4. Whether registered under the Registration  of  Societies  Act 1860. (Copies of audited accounts	for last 3 years are to be enclosed).If yes?  Please enclose  a   copy  of  the  Registration Certificate.</td>
											<td><label class="radio-inline"><input type="radio" name="is_registration" class="is_registration" value="Y"  <?php if(isset($is_registration) && $is_registration=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_registration"  value="N"  name="is_registration" <?php if(isset($is_registration) && $is_registration=='N') echo 'checked'; ?> checked /> No</label></td>
										</tr>
										<tr>
											<td>5. Proposed name of the Education Institution to be established.</td>
											<td><input validate="letters" type="text" name="ins_name" value="<?php echo $ins_name; ?>" class="form-control text-uppercase"></td>
											<td>6.Stage(s) of Education  proposed to be imparted?</td>
											<td><select class="form-control text-uppercase" name="edu_proposed" >
											<option value="disabled">Please Select</option>
											<option value="P" <?php if($edu_proposed=="P") echo "selected";?> >Primary</option>
											<option value="M" <?php if($edu_proposed=="M") echo "selected";?>>Middle</option>
											<option value="S" <?php if($edu_proposed=="S") echo "selected";?>>Secondary</option>
											<option value="HS" <?php if($edu_proposed=="HS") echo "selected";?>>Higher Secondary</option>
											</select></td>
										</tr>
										<tr>
											<td>7. Location of the proposed institution</td>
											<td><select class="form-control text-uppercase" name="inst_location">
											<option value="disabled">Please Select</option>
											<option value="R" <?php if($inst_location=="R") echo "selected";?>>Rural</option>
											<option value="SU" <?php if($inst_location=="SU") echo "selected";?>>Semi Urban</option>
											<option value="U" <?php if($inst_location=="U") echo "selected";?>>Urban</option>
											</select></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">8. Names of same category of institutions of the  neighbouring  area  of  the  proposed institution  within  a radius of 1 km  in case of Primary, 3 km in case of Middle, 5 km in case of Secondary and 10 km in case of  Higher  Secondary  level ofinstitutions (including all govt. prov. and non govt. institutions)</td>
											<td><input  type="text" value="<?php echo $instutition_names; ?>" name="instutition_names" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>9. Measurement of the land in possession</td>
											<td><input type="text" name="measure_land" value="<?php echo $measure_land; ?>" class="form-control text-uppercase" ></td>
											<td>10. Status of land (Myadi patta/ Annual patta/  Govt. allotment/  Lease) under occupation. (copies of land documentto be attached)</td>
											<td><input type="text" name="land_status" value="<?php echo $land_status; ?>" class="form-control text-uppercase"></td>
										</tr>															
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" name="save1a" class="btn btn-success">Save and Next</button>
											</td>
											<td></td>
										</tr>
									</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">11. In case of lease holder, the copy of the lease document is to be attached.</td>
											<td width="25%">Document to be attached</td>
											<td width="25%">12. Proposed Scheme of management for establishment  of  the  Educational institution  for  which  permission is sought for.</td>
											<td width="25%"><input type="text" name="proposed_scheme" value="<?php echo $proposed_scheme; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>13. What would be the intake capacity? (class-wise)</td>
											<td><input type="text" name="capacity" validate="onlyNumbers" value="<?php echo $capacity; ?>" class="form-control text-uppercase"></td>
											<td>14. Whether  it  would  be  completely residential?</td>
											<td><label class="radio-inline"><input type="radio" name="is_residential" id="is_residential" value="Y"  <?php if(isset($is_residential) && $is_residential=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_residential"  value="N"  id="is_residential" <?php if(isset($is_residential) && $is_residential=='N') echo 'checked'; ?> /> No</label></td>
										</tr>
										<tr>
											<td>15. Whether it would be non-residential?</td>
											<td>
											<label class="radio-inline"><input type="radio" name="is_nonResidential[a]" class="is_nonResidential_a" value="Y"  <?php if(isset($is_nonResidential_a) && $is_nonResidential_a=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_nonResidential_a"  value="N"  name="is_nonResidential[a]" <?php if(isset($is_nonResidential_a) && ($is_nonResidential_a=='N' || $is_nonResidential_a=='')) echo 'checked'; ?>/> No</label>
											</td>
											<td>If  yes, what  would  be  the  mode of  transport  facility  for  students? </td>
											<td><input  type="text" name="is_nonResidential[b]" id="is_nonResidential_b" value="<?php echo $is_nonResidential_b; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>16. Whether it would be semi residential? </td>		
											<td>
											<label class="radio-inline"><input type="radio" name="semi_residential[a]" class="semi_residential_a" value="Y"  <?php if(isset($semi_residential_a) && $semi_residential_a=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="semi_residential_a"  value="N"  name="semi_residential[a]" <?php if(isset($semi_residential_a) && ($semi_residential_a=='N' || $semi_residential_a=='')) echo 'checked'; ?>  /> No</label>
											</td>
											<td>If yes, please furnish No. & Date of such permission (a copy of permission letter to be enclosed)</td>
											<td><input  type="text" name="semi_residential[b]" id="semi_residential_b" value="<?php echo $semi_residential_b; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>17.	Copy of the Plan and estimate of the proposed  buildings  and   other infrastructures. (Indicate the number of classroom and other infrastructures to be constructed initially).</td>
											<td>Document to be attached</td>
											<td>18.	What is the time frame for completion of the proposed construction?</td>
											<td><input type="text" name="time_frame" value="<?php echo $time_frame; ?>" class="time form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td>19.	From  which  academic  session, the	class(s) will  be  started?</td>
											<td><input type="text" name="academic" value="<?php echo $academic; ?>" class="form-control text-uppercase" ></td>
											<td>20.	What would be the project cost? (Itemwise estimate is to be attached)</td>
											<td><input type="text" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $project_cost; ?>" name="project_cost" ></td>
										</tr>
										<tr>
											<td>21.	Probable sources of funds</td>
											<td><input type="text" class="form-control text-uppercase" name="funds" value="<?php echo $funds; ?>"></td>
											<td>22.	What would be the maximum  probable	fee structure? (Item-wise and year-wise	breakup  per  student per  class is to be furnished)</td>
											<td><input type="text" validate="onlyNumbers" class="form-control text-uppercase" name="fee_structure" value="<?php echo $fee_structure; ?>" ></td>
										</tr>
										<tr>
											<td>23.	What  is  the  present financial  status? (documents in support are to be attached)</td>
											<td><input type="text" class="form-control text-uppercase" name="finan_status" value="<?php echo $finan_status; ?>" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>Date :</td>
											<td><label ><?php echo $today;?></label></td>
											<td>Signature of Authorized Signatory</td>
											<td><strong><?php echo strtoupper($key_person)?></strong></td>
										</tr>	  
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<a type="button" href="dsedu_form1.php?tab=1" class="btn btn-primary avoid_me">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="save1b" class="btn btn-success">Save and Next</button>
											</td>
											<td></td>
										</tr>
									</table>
								</form>
								</div>
					<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
					<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
					<table class="table table-responsive">			
					<tr>
						<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
					</tr>
					<tr>
						<td width="50%"> Copy of the Memorandum of Association and Rules of the organization.</td>
						<td width="10%">
						<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
								<option value="0" selected="selected">Select</option>
								<option value="1">From E-Locker</option>
								<option value="2">From PC</option>
							</select>
						<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
						</td>
						<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
						<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
						<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
					</tr>
					<tr>
						<td>Copy  of  the  Registration Certificate. (Copies of audited accounts for last 3 years are to be enclosed)</td>
						<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?> >
								<option value="0" selected="selected">Select</option>
								<option value="1">From E-Locker</option>
								<option value="2">From PC</option>
							</select>
						<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
						<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo 'No File Selected'; } ?></td>
						<td><input type="CheckBox" id="B1" class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
						<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
					</tr>
					<tr>
						<td>Copy of land document. </td>
						<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?>>
								<option value="0" selected="selected">Select</option>
								<option value="1">From E-Locker</option>
								<option value="2">From PC</option>
							</select>
						<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
						<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
						<td><input type="CheckBox" id="C1"  class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
						<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
					</tr>
					<tr>
						<td>Copy of the lease document.</td>
						<td><select trigger="FileModal" class="file4" id="file4" <?php if($file4!="" || $file4=="SC" || $file4=="NA") echo "disabled='disabled'"; ?> >
								<option value="0" selected="selected">Select</option>
								<option value="1">From E-Locker</option>
								<option value="2">From PC</option>
							</select>
						<input type="hidden" name="mfile4" value="<?php if($file4!="") echo $file4; ?>" id="mfile4" readonly="readonly"/></td>
						<td width="20%" id="mfile4-chiranjit"><?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file4" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
						<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
						<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>					
					</tr>   
					<tr>
						<td>Project cost(Item-wise estimate).  </td>
						<td><select trigger="FileModal" class="file5" id="file5" <?php if($file5!="" || $file5=="SC" || $file5=="NA") echo "disabled='disabled'"; ?>>
								<option value="0" selected="selected">Select</option>
								<option value="1">From E-Locker</option>
								<option value="2">From PC</option>
							</select>
						<input type="hidden" name="mfile5" value="<?php if($file5!="") echo $file5; ?>" id="mfile5" readonly="readonly"/></td>
						<td width="20%" id="mfile5-chiranjit"><?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
						<td><input type="CheckBox" id="E1" class="file5" name="E1" <?php if($file5=="NA") echo "checked"; ?> <?php if($file5!="" && $file5!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</input></td>
						<td><input type="CheckBox" id="E2" class="file5 cd" name="E2" <?php if($file5=="SC") echo "checked"; ?> <?php if($file5!="" && $file5!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</input></td>
					</tr>
					<tr>
						<td>Present financial  status.</td>
						<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
								<option value="0" selected="selected">Select</option>
								<option value="1">From E-Locker</option>
								<option value="2">From PC</option>
							</select>
						<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
						<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file6" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
						<td><input type="CheckBox" id="F1" class="file6" name="F1" <?php if($file6=="NA") echo "checked"; ?> <?php if($file6!="" && $file6!="NA") echo "disabled='disabled'"; ?> value='F1' onClick="checkData(this)">N/A</input></td>
						<td><input type="CheckBox" id="F2" class="file6 cd" name="F2" <?php if($file6=="SC") echo "checked"; ?> <?php if($file6!="" && $file6!="SC") echo "disabled='disabled'"; ?> value='F2' onClick="checkData(this)">S/C</input></td>
					</tr>									
									<tr>
									<td class="text-center" colspan="5">
										<a type="button" href="dsedu_form1.php?tab=2" class="btn btn-primary avoid_me">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="submit1" class="btn btn-success">Save and Next</button>
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
	  <?php require '../../../user_area/includes/footer.php'; 	?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>

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
	
	/* ------------------------------------------------------ */
	
	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
/*$('#is_registration_b').attr('readonly','readonly');
	<?php if($is_registration_a == 'Y') echo "$('#is_registration_b').removeAttr('readonly','readonly');"; ?>
	$('.is_registration_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_registration_b').removeAttr('readonly','readonly');
		}else{
			$('#is_registration_b').attr('readonly','readonly');
		}			
	});*/
$('#is_nonResidential_b').attr('readonly','readonly');
	<?php if($is_nonResidential_a == 'Y') echo "$('#is_nonResidential_b').removeAttr('readonly','readonly');"; ?>
	$('.is_nonResidential_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_nonResidential_b').removeAttr('readonly','readonly');
		}else{
			$('#is_nonResidential_b').attr('readonly','readonly');
			$('#is_nonResidential_b').val('');
		}			
	});
	
$('#semi_residential_b').attr('readonly','readonly');
	<?php if($semi_residential_a == 'Y') echo "$('#semi_residential_b').removeAttr('readonly','readonly');"; ?>
	$('.semi_residential_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#semi_residential_b').removeAttr('readonly','readonly');
		}else{
			$('#semi_residential_b').attr('readonly','readonly');
			$('#semi_residential_b').val('');
		}			
	});
</script>
</body>
</html>