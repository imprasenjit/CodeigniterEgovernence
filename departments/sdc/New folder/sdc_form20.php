<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('sdc','20');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=20&dept=sdc';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=20&dept=sdc';	</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=20';</script>";
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
		$q=$sdc->query("select * from sdc_form20 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";$edu_qualification="";$incharge="";$business_past="";$is_engaged="";$is_engaged_detail="";$business_present="";$is_license="";$lic_granted="";$particulars_license="";$is_warned="";$is_act1940="";$is_act1930="";$is_act1919="";$is_act1948="";$other_act="";$is_imported="";$statement="";$is_distributor="";$distributor="";$firm_cat="";$area_room="";$classes_drug="";$commodities="";$liquor="";$hours_days="";
			$premises_sn1="";$premises_sn2="";$premises_vt="";$premises_dist="";$premises_pin="";$premises_mobile="";
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];$edu_qualification=$results["edu_qualification"];$incharge=$results["incharge"];$business_past=$results["business_past"];$is_engaged=$results["is_engaged"];$is_engaged_detail=$results["is_engaged_detail"];$business_present=$results["business_present"];$is_license=$results["is_license"];$lic_granted=$results["lic_granted"];$particulars_license=$results["particulars_license"];$is_warned=$results["is_warned"];$is_act1940=$results["is_act1940"];$is_act1930=$results["is_act1930"];$is_act1919=$results["is_act1919"];$is_act1948=$results["is_act1948"];$other_act=$results["other_act"];$is_imported=$results["is_imported"];$statement=$results["statement"];$is_distributor=$results["is_distributor"];$distributor=$results["distributor"];$firm_cat=$results["firm_cat"];$area_room=$results["area_room"];$classes_drug=$results["classes_drug"];$commodities=$results["commodities"];$liquor=$results["liquor"];$hours_days=$results["hours_days"];
			if(!empty($results["premises"])){
				$premises=json_decode($results["premises"]);
				$premises_sn1=$premises->sn1;$premises_sn2=$premises->sn2;$premises_vt=$premises->vt;$premises_dist=$premises->dist;$premises_pin=$premises->pin;$premises_mobile=$premises->mobile;
			}else{				
				$premises_sn1="";$premises_sn2="";$premises_vt="";$premises_dist="";$premises_pin="";$premises_mobile="";
			}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}	
	$q1=$sdc->query("select * from sdc_form20_members where form_id='$form_id'");
	$results1=$q1->fetch_array();
	if($q1->num_rows<1){
		$form_id="";
		$address="";$pincode="";$contact="";
	}
	else{
		$form_id=$results1['form_id'];
		$address=$results1['address'];$pincode=$results1['pincode'];$contact=$results1['contact'];
		}
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
									<?php echo $form_name=$cms->query("select form_name from sdc_form_names where form_no='20'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part 2</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr class="form-inline">
											<td colspan="4">1. Name of all partners or Directors, Proprietors etc. and full residential address of each :</td> 
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
										$member_results=$sdc->query("select * from sdc_form20_members where form_id='$form_id'") or die("Error : ".$sdc->error);
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
											<td width="25%">2.(a) What are the educational qualifications of the applicant :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="edu_qualification" value="<?php echo $edu_qualification;?>"/></td>
											<td width="25%">(b) Persons in-charge of the premises for which license is applied for :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="incharge" value="<?php echo $incharge;?>"/></td>
										</tr>	
										<tr>
											<td>3. What are the business carried on by the applicant within the last three years ?:</td>
											<td><input type="text" class="form-control text-uppercase" name="business_past" value="<?php echo $business_past;?>"/></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>	
										<tr>
											<td>4. Has the applicant ever engaged himself or on behalf of any other person in selling drugs any time prior to this application? :</td>
											<td>
											<label class="radio-inline"><input type="radio" name="is_engaged" class="is_engaged" value="Y"  <?php if(isset($is_engaged) && $is_engaged=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_engaged"  value="N"  name="is_engaged" <?php if(isset($is_engaged) && ($is_engaged=='N' || $is_engaged=='')) echo 'checked'; ?>/> No</label>
											</td>
											<td>If  yes, what  would  be  the  mode of  transport  facility  for  students? </td>
											<td><input  type="text" name="is_engaged_detail" id="is_engaged_detail" value="<?php echo $is_engaged_detail; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>5. What other business is carried on by the applicant at present ? :</td>
											<td><input type="text" class="form-control text-uppercase" name="business_present" value="<?php echo $business_present;?>"/></td>
											<td>6. Is the application for fresh license or renewal ? :</td>
											<td><label class="radio-inline"><input type="radio" name="is_license" id="is_license" value="Y"  <?php if(isset($is_license) && $is_license=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_license"  value="N"  id="is_license" <?php if(isset($is_license) && $is_license=='N') echo 'checked'; ?> /> No</label></td>		
										</tr>
										<tr>
											<td>7. Year in which license was first granted. :</td>
											<td><input type="text" class="form-control text-uppercase" name="lic_granted" value="<?php echo $lic_granted;?>"/></td>
											<td>8. Particulars of licences granted. :</td>
											<td><textarea class="form-control text-uppercase" name="particulars_license"><?php echo $particulars_license; ?></textarea></td>			
										</tr>
										<tr>
											<td>9. Was the applicant ever warned for selling goods which are not of standard quality? :</td>
											<td><label class="radio-inline"><input type="radio" name="is_warned" id="is_warned" value="Y"  <?php if(isset($is_warned) && $is_warned=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_warned"  value="N"  id="is_warned" <?php if(isset($is_warned) && $is_warned=='N') echo 'checked'; ?> /> No</label></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>											
										</tr>
										<tr>
											<td colspan="4">10. Was the applicant or any person at present employed by him on these premises ever convicted and sentenced under :</td>											
										</tr>										
										<tr>
											<td>(a)  Drug Act, 1940 :</td>
											<td><label class="radio-inline"><input type="radio" name="is_act1940" id="is_act1940" value="Y"  <?php if(isset($is_act1940) && $is_act1940=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_act1940"  value="N"  id="is_act1940" <?php if(isset($is_act1940) && $is_act1940=='N') echo 'checked'; ?> /> No</label></td>
											<td>(b)  Dangerous Act, 1930 :</td>
											<td><label class="radio-inline"><input type="radio" name="is_act1930" id="is_act1930" value="Y"  <?php if(isset($is_act1930) && $is_act1930=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_act1930"  value="N"  id="is_act1930" <?php if(isset($is_act1930) && $is_act1930=='N') echo 'checked'; ?> /> No</label></td>		
										</tr>										
										<tr>
											<td>(c)  The Poisons Act, 1919 :</td>
											<td><label class="radio-inline"><input type="radio" name="is_act1919" id="is_act1919" value="Y"  <?php if(isset($is_act1919) && $is_act1919=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_act1919"  value="N"  id="is_act1919" <?php if(isset($is_act1919) && $is_warned=='N') echo 'checked'; ?> /> No</label></td>	
											<td>(d)  The Pharmacy Act, 1948 :</td>
											<td><label class="radio-inline"><input type="radio" name="is_act1948" id="is_act1948" value="Y"  <?php if(isset($is_act1948) && $is_act1948=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_act1948"  value="N"  id="is_act1948" <?php if(isset($is_act1948) && $is_warned=='N') echo 'checked'; ?> /> No</label></td>			
										</tr>									
										<tr>
											<td>(e)  Any other Act. :</td>
											<td><input type="text" class="form-control text-uppercase" name="other_act" value="<?php echo $other_act;?>"/></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>											
										</tr>
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" name="save20a" class="btn btn-success">Save and Next</button>
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
											<td colspan="3">11. Has the applicant ever imported Spirituous Medicinal of Toilet Preparations from other States ? :</td>
											<td width="25%">
											<label class="radio-inline"><input type="radio" name="is_imported" value="Y" <?php if(isset($is_imported) && ($is_imported=='Y' || $is_imported=='')) echo 'checked'; ?> id="is_imported"/> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_imported" value="N" <?php if(isset($is_imported) && $is_imported=='N') echo 'checked="checked"'; ?> id="is_imported"  /> No</label></td>
										</tr>								
										<tr>
											<td colspan="3"> If so, a statement of the names of the manufacturers,  Spirituous preparations their quantities and dates on which imported during the last year should be given in a separate sheet of paper duly signed and dated by the applicant and/or has the applicant ever dealt in spirituous Medicinal preparations or toilet preparations manufactured by Manufacturers within this State ? :</td>
											<td><textarea class="form-control text-uppercase" name="statement" id="statement"><?php echo $statement;?></textarea></td>
										</tr>								
										<tr>
											<td width="25%">12. Is the applicant an agent or distributor of any drug manufacturing concern? :</td>
											<td width="25%"><label class="radio-inline"><input type="radio" name="is_distributor" class="is_distributor" value="Y"  <?php if(isset($is_distributor) && $is_distributor=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_distributor"  value="N"  class="is_distributor" <?php if(isset($is_distributor) && $is_distributor=='N') echo 'checked'; ?> /> No</label></td>
											<td width="25%">If so, the area of distribution and the date of  appointment should be stated with full particulars.The applicant shall inform the Licensing Authority if the agency is terminated any time during which the license is in force. :</td>
											<td width="25%"><textarea class="form-control text-uppercase" name="distributor" id="distributor"><?php echo $distributor;?></textarea></td>		
										</tr>								
										<tr>
											<td>13. Is the firm of company a  :</td>
											<td><select class="form-control text-uppercase" name="firm_cat">
											<option value="disabled">Please Select</option>
											<option value="R" <?php if($firm_cat=="R") echo "selected";?> >Restaurant</option>
											<option value="G" <?php if($firm_cat=="G") echo "selected";?>>Grocer</option>
											<option value="PS" <?php if($firm_cat=="PS") echo "selected";?>>Panbidi shop</option>
											<option value="GM" <?php if($firm_cat=="GM") echo "selected";?>>General Merchant</option>
											<option value="DS" <?php if($firm_cat=="DS") echo "selected";?>>Drug Stores</option>
											</select></td>
											<td>&nbsp;</td>											
											<td>&nbsp;</td>											
										</tr>							
										<tr>
											<td colspan="4" class="form-inline">14. The applicant has in full<input type="text" class="form-control text-uppercase" name="area_room" value="<?php echo $area_room;?>"/>rooms for storage and sale of drugs. The floor area in square feet of each room must be  given with a sketch. The applicant is/is not a legal tenant or a Licensee there of. Necessary documents should be enclosed. </td>
										</tr>						
										<tr>
											<td colspan="4">15. The applicant does/does not stock or sell drugs at any other premises for which this applicant is applied for  or the address of the other premises are : </td>
										</tr>
										<tr>					
										   <td>Street Name 1</td>
										   <td><input type="text"  validate="specialChar" required class="form-control text-uppercase" name="premises[sn1]" value="<?php  echo $premises_sn1; ?>" /></td>
											<td>Street Name 2</td>
											<td><input type="text" validate="specialChar" class="form-control text-uppercase" name="premises[sn2]" value="<?php echo $premises_sn2; ?>" /></td>
										</tr>
										<tr>
										   <td>Village/Town</td>
										   <td><input type="text"  name="premises[vt]" class="form-control text-uppercase" value="<?php  echo $premises_vt; ?>"/></td>
										   <td>District</td>
										   <td>
										   <?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
											<select name="premises[dist]"  class="form-control text-uppercase"><?php
											while($dstrows=$dstresult->fetch_object()) { 
											if(isset($premises_dist) && ($premises_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
											<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>> <?php echo $dstrows->district; ?></option>
										   <?php } ?>					
											</select>
											</td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text"  class="form-control text-uppercase" validate="pincode" name="premises[pin]"  maxlength="6" value="<?php  echo $premises_pin; ?>" /></td>
											<td>Mobile</td>
											<td><input type="text" class="form-control" validate="onlyNumbers" name="premises[mobile]" value="<?php echo $premises_mobile;?>" maxlength="10"/></div></td>
										</tr>												
										<tr>
											<td >16. What classes of drugs are stocked, sold or distributed : </td>
											<td><select class="form-control text-uppercase" name="classes_drug">
											<option value="disabled">Please Select</option>
											<option value="P" <?php if($classes_drug=="P") echo "selected";?> >Poisons</option>
											<option value="I" <?php if($classes_drug=="I") echo "selected";?>>Injections</option>
											<option value="O" <?php if($classes_drug=="O") echo "selected";?>>Oral Vitamin Products</option>
											<option value="HM" <?php if($classes_drug=="HM") echo "selected";?>>Household medicines</option>
											<option value="T" <?php if($classes_drug=="T") echo "selected";?>>Tincture and other spirituous preparations</option>
											</select></td>
											<td >17. The applicant deals in the following class of commodities only besides drugs on these premises viz. : </td>
											<td><textarea class="form-control " name="commodities"><?php echo $commodities;?></textarea> </td>
										</tr>				
										<tr>
											<td >18. The applicant was/was not dealing in Spirits/Wine/ Country Liquor prior to the introduction of the : </td>
											<td><textarea class="form-control" name="liquor"><?php echo $liquor;?></textarea> </td>
											<td >19. Hours of business and working days : </td>
											<td><input type="text" class="form-control text-uppercase" name="hours_days" value="<?php echo $hours_days;?>"/></td>
										</tr>			
										<tr>
											<td colspan="4">20. Name of the trade or professional Association of which the applicant is a member and the date of commencement of memberships : </td>
										</tr>			
										<tr>
											<td >Name :</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>"/></td>
											<td >Date of commencement : </td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $date_of_commencement;?>"/></td>
										</tr>
										<tr>
											<td>Date :</td>
											<td><label ><?php echo $today;?></label></td>
											<td>Signature of the Applicant:</td>
											<td><label><?php echo strtoupper($key_person)?></label></td>
										</tr>	  
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<a type="button" href="sdc_form20.php?tab=1" class="btn btn-primary avoid_me">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="save20b" class="btn btn-success">Save and Next</button>
											</td>
											<td></td>
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

$('#is_engaged_detail').attr('readonly','readonly');
	<?php if($is_engaged == 'Y') echo "$('#is_engaged_detail').removeAttr('readonly','readonly');"; ?>
	$('.is_engaged').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_engaged_detail').removeAttr('readonly','readonly');
		}else{
			$('#is_engaged_detail').attr('readonly','readonly');
			$('#is_engaged_detail').val('');
		}			
	});
$('#distributor').attr('readonly','readonly');
	<?php if($is_distributor == 'Y') echo "$('#distributor').removeAttr('readonly','readonly');"; ?>
	$('.is_distributor').on('change', function(){
		if($(this).val() == 'Y'){
			$('#distributor').removeAttr('readonly','readonly');
		}else{
			$('#distributor').attr('readonly','readonly');
			$('#distributor').val('');
		}			
	});
$('#statement').attr('readonly','readonly');
	<?php if($is_imported == 'Y') echo "$('#statement').removeAttr('readonly','readonly');"; ?>
	$('input:radio[name=is_imported]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#statement').removeAttr('readonly','readonly');
		}else{
			$('#statement').attr('readonly','readonly');
			$('#statement').val('');
		}			
	});
</script>
</body>
</html>