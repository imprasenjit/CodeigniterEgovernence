<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('dmedu','2');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=dmedu';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=2&dept=dmedu';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=2';</script>";
}else{
	$showtab="";
}

$get_file_name=basename(__FILE__);	
include "save_form2.php";
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

		$q=$dmedu->query("select * from dmedu_form2 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";$constitution="";$objectives="";
			$reg_number="";$reg_dt="";
			$permission_number="";$permission_issue="";$permission_dt="";
			$affliation_name="";$affliation_dt="";$affliation_number="";
			$banker_name="";$banker_sn1="";$banker_sn2="";$banker_v="";$banker_d="";$banker_phn_no="";$banker_p="";
			$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];$constitution=$results["constitution"];$objectives=$results["objectives"];
			$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];
			if(!empty($results["reg"])){
				$reg=json_decode($results["reg"]);
				$reg_number=$reg->number;$reg_dt=$reg->dt;
			}else{				
				$reg_number="";$reg_dt="";
			}			
			if(!empty($results["permission"])){
				$permission=json_decode($results["permission"]);
				$permission_number=$permission->number;$permission_issue=$permission->issue;$permission_dt=$permission->dt;
			}else{				
				$permission_number="";$permission_issue="";$permission_dt="";
			}
			if(!empty($results["affliation"])){
				$affliation=json_decode($results["affliation"]);
				$affliation_name=$affliation->name;$affliation_dt=$affliation->dt;$affliation_number=$affliation->number;
			}else{				
				$affliation_name="";$affliation_dt="";$affliation_number="";
			}				
			if(!empty($results["banker"])){
				$banker=json_decode($results["banker"]);
				$banker_name=$banker->name;$banker_sn1=$banker->sn1;$banker_sn2=$banker->sn2;$banker_v=$banker->v;$banker_d=$banker->d;$banker_phn_no=$banker->phn_no;$banker_p=$banker->p;
			}else{				
				$banker_name="";$banker_sn1="";$banker_sn2="";$banker_v="";$banker_d="";$banker_phn_no="";$banker_p="";
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
<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
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
									<strong>Form-II<br/><br/><?php echo $form_name=$formFunctions->get_formName('dmedu','2'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Upload Section</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1.Name of the Applicant</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"/></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">2. Address</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
											<td>Street Name2:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>" ></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $email; ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="4">3. Registered Office</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
											<td>Street Name2:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$b_mobile_no; ?>"></td>
										</tr>
										<tr>
										    <td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $b_email; ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
										    <td>4. Constitution</td>
											<td><select class="form-control text-uppercase" name="constitution">
											<option value="disabled">Please Select</option>
											<option value="University" <?php if($constitution=="University") echo "selected";?> >University</option>
											<option value="State Government" <?php if($constitution=="State Government") echo "selected";?>>State Government</option>
											<option value="Union Territories" <?php if($constitution=="Union Territories") echo "selected";?>>Union Territories</option>
											<option value="Autonomous Body" <?php if($constitution=="Autonomous Body") echo "selected";?>>Autonomous Body</option>
											<option value="Society" <?php if($constitution=="Society") echo "selected";?>>Society</option>
											<option value="Trust" <?php if($constitution=="Trust") echo "selected";?>>Trust</option>
											</select></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
										    <td colspan="4">5. Registration / Incorporation</td>
										</tr>
										<tr>
										    <td >Number</td>
											<td><input type="text" class="form-control text-uppercase" name="reg[number]" value="<?php echo  $reg_number; ?>"></td>
											<td>Date</td>
											<td><input type="text" class="dob form-control text-uppercase" name="reg[dt]" value="<?php echo  $reg_dt; ?>"></td>
										</tr>
										<tr>
										    <td >6. Objectives</td>
											<td><input type="text" class="form-control text-uppercase"  name="objectives" value="<?php echo  $objectives; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">7. Letter of essentiality/permission from the state government/union territory</td>
										</tr>
										<tr>
											<td width="25%">Number </td>
											<td><input type="text" class="form-control text-uppercase" name="permission[number]" value="<?php echo  $permission_number; ?>"></td>
											<td >Date </td>
											<td ><input type="text" class="dob text-uppercase form-control"  name="permission[dt]" value="<?php echo  $permission_dt; ?>"></td>
										</tr>
										<tr>
											<td >Issuing authority </td>
											<td ><input type="text" class="text-uppercase form-control"  name="permission[issue]" value="<?php echo  $permission_issue; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">8. Letter of University Affliation </td>
										</tr >
										<tr>
											<td width="25%">Number </td>
											<td><input type="text" class="form-control text-uppercase" name="affliation[number]" value="<?php echo  $affliation_number; ?>"></td>
											<td >Date </td>
											<td><input type="text" class="dob form-control text-uppercase" name="affliation[dt]" value="<?php echo  $affliation_dt; ?>"></td>
										</tr>
										<tr>
											<td >Name of the Institution </td>
											<td><input type="text" class="form-control text-uppercase" name="affliation[name]" value="<?php echo  $affliation_name; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">9. Bankers</td>
										</tr>
										<tr>
											<td>Name</td>
											<td><input type="text" class="form-control text-uppercase" name="banker[name]" value="<?php echo $banker_name; ?>"></td>
											<td>Street Name1</td>
											<td><input type="text" class=" form-control text-uppercase" name="banker[sn1]" value="<?php echo $banker_sn1; ?>"></td>
										</tr>
										<tr>
											<td>Street Name2</td>
											<td><input type="text" class="form-control text-uppercase" name="banker[sn2]" value="<?php echo $banker_sn2; ?>"></td>
											<td>Village</td>
											<td><input type="text" class=" form-control text-uppercase" name="banker[v]" value="<?php echo $banker_v; ?>"></td>
										</tr>
										<tr>
											<td>District</td>
											<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
										<select name="banker[d]" class="form-control text-uppercase"><?php
											while($dstrows=$dstresult->fetch_object()) { 
												if(isset($banker_d) && ($banker_d==$dstrows->district)) $s='selected'; else $s=''; ?>
												<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
											<?php } ?>					
										</select></td>
											<td>Contact No</td>
											<td><input type="text" class="form-control text-uppercase" name="banker[phn_no]" validate="mobileNumber" maxlength="10" value="<?php echo $banker_phn_no; ?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="banker[p]" value="<?php echo $banker_p; ?>" maxlength="6" validate="pincode"></td>
											<td></td>
											<td></td>
										</tr>					
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" name="save2" class="btn btn-success submit1">Save and Next</button>
											</td>
											<td></td>
										</tr>
									</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
								<tr>
									<td colspan="5">Documents to be enclosed <span class="mandatory_field">*</span> <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
								</tr>
								<tr>
									<td width="50%">A copy of Certified Copy of Bye Laws/ Memorandum and Articles of Association/Trust Deed etc.</td>
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
									<td>A copy of Certified Copy of Certificates of Registration /Incorporation. </td>
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
									<td>A copy of  Annual Reports and Audited Balance Sheets for the last 3 years.</td>
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
									<td>A copy of Certified Copy of the Title Deeds of the total  available land as a proof of ownership.</td>
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
									<td> A copy of Certified Copy of the Zoning plans of the available sites, indicating their land use.</td>
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
									<td> A copy of Proof of attachment with Medical College Hospital or 100 bed-ed General Hospital.</td>
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
                                            <?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
								</tr>
								<tr>
									<td> A copy of Certified Copy of the essentially certificate by the respective State Government / Union Territory Administration.</td>
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
									<td> A copy of Certified copy of the Letter of Affiliation issued by a recognize University.</td>
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
									<td> A copy of Authorization Latter addressed to the Bankers of the Applicant authorising the Central Government / Dental Council of India to make independent inquiries regarding the financial track record of the applicant.</td>
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
									<td class="text-center" colspan="5">
										<a type="button" href="dmedu_form2.php?tab=2" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="submit2" class="btn btn-success">Save and Next</button>
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
	/* ----------------------------------------------------- */
	$('#Year, #Year2').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */	
	function calculateAge()
	{
		var dob = new Date(y,m.d);
		alert();
		dob.setFullYear(y, m-1, d);
		
		var today = new Date();
		today.setFullYear(today.getFullYear());
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		return age;
	}

	function date_of_birth(obj){
		
		var str2=$('#'+obj).val();
		var str3 = str2.replace('-','');
		var str = str3.replace('-','');
		
		var day=Number(str.substr(0,2));		
		var month=Number(str.substr(2,2))-1;
		var year=Number(str.substr(4,4));
		
		var today=new Date();
		var age=today.getFullYear()-year;
		
		
		if((today.getMonth()< month) || (today.getMonth()==month && today.getDate()<day))
		{
			age--;
		}
		if(age<18)
		{
			alert('Your age must be greater than 18 to fill up this form');
			$('#owner_age').val('');
			$('.dob').val('');
			
		}
		else
		{
			$('#owner_age').val(age);
			
		}	
	}
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
		$("#myform2 :input,select").prop("disabled", true);
	<?php } ?>
	
	$('#is_comm_act_b').attr('readonly','readonly');
	<?php if($is_comm_act_a == 'Y') echo "$('#is_comm_act_b').removeAttr('readonly','readonly');"; ?>
	$('.is_comm_act_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_comm_act_b').removeAttr('readonly','readonly');
		}else{
			$('#is_comm_act_b').attr('readonly','readonly');
			$('#is_comm_act_b').val('');
		}			
	});
	$('#is_inst_estd_b').attr('readonly','readonly');
	<?php if($is_inst_estd_a == 'Y') echo "$('#is_inst_estd_b').removeAttr('readonly','readonly');"; ?>
	$('.is_inst_estd_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_inst_estd_b').removeAttr('readonly','readonly');
		}else{
			$('#is_inst_estd_b').attr('readonly','readonly');
			$('#is_inst_estd_b').val('');
		}			
	});
	$('#inst_loc_b').attr('readonly','readonly');
	<?php if($inst_loc_b!=""){  ?>
				$('#inst_loc_b').removeAttr('readonly','readonly');
	<?php } ?>
		
	//$('input:select[name="inst_loc_a"]').onchange();
	$('#inst_loc_a').change(function(){
		if ($(this).val() == "R") {
			$('#inst_loc_b').removeAttr('readonly');
		}else{
			$('#inst_loc_b').attr('readonly','readonly');  
		}	
	});	
</script>
</body>
</html>