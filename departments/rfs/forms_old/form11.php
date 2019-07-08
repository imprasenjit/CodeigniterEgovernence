<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('rfs','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=society';
		</script>";	
} 
$get_file_name=basename(__FILE__);
include "save_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);

	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$revenue=$row1['revenue'];$mouza=$row1['mouza'];
	
	$Type_of_ownership=$row1['Type_of_ownership'];
	if($Type_of_ownership=="CS"){
		$Name_of_owner=$row1['Name_of_owner'];
		$owners=Array();
		$owners=explode(",",$Name_of_owner);
	}else{
		echo "<script>
				alert('Since you did not fill up the Common Application Form with Legal Entity as Co-operative Society, so you do not have the rights to fill up this form.');
				window.location.href = '".$server_url."user_area/index.php';
		</script>";
	}
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$q=$society->query("select * from society_form2 where user_id='$swr_id' and active='1'");
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 ###EMPTY FORM DETAILS###
		$form_id="";
		$s_po="";$s_ps="";$s_con="";$operation_area="";$s_obj="";$language="";$admn_fee="";$share_value="";	
		$file1="";$file2="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}else{
		$form_id=$results['form_id'];	
		$file1=$results["file1"];$file2=$results["file2"];
		###########part1 starts here##############
		$s_po=$results['s_po'];$s_ps=$results['s_ps'];$s_con=$results['s_con'];$operation_area=$results['operation_area'];$s_obj=$results['s_obj'];$language=$results['language'];$admn_fee=$results['admn_fee'];$share_value=$results['share_value'];
		################Courier details#################
		if(!empty($results["courier_details"])){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}		
	}
	$q1=$society->query("select * from society_form2_members where form_id='$form_id'");
	$results1=$q1->fetch_assoc();
	if($q1->num_rows<1){
		$form_id="";
		$member_address="";$member_fname="";$member_age="";$member_occupation="";$member_partition="";$member_signature="";
	}
	else{
		$form_id=$results1['form_id'];
		$member_address=$results1['member_address'];$member_age=$results1['member_age'];$member_fname=$results1['member_fname'];$member_signature=$results1['member_signature'];$member_fname=$results1['member_fname'];$member_occupation=$results1['member_occupation'];$member_partition=$results1['member_partition'];
	}
	##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";$tabdiv5="";$tabbtn5="";$tabdiv6="";$tabbtn6="";$tabdiv7="";$tabbtn7="";
	if($showtab=="" || $showtab<2 || $showtab>6|| is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==3){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:block;'";$tabbtn3="active";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==4){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:block;'";$tabbtn4="active";$tabdiv5="style='display:none;'";$tabbtn5="";
	}
	if($showtab==5){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:block;'";$tabbtn5="active";
	}
	if($showtab==6){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:block;'";$tabbtn6="active";
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
		.scroll_div{
			height: 300px; // Set this height to the appropriate size
			position: fixed;
			overflow-y: scroll;
			padding: 20px;
			margin: 20px;
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
								   <strong>Form No 4<br/><?php echo $form_name=$cms-> query("select form_name from rfs_form_names  where  form_no='11'")->fetch_object()->form_name; ?></strong>
								  
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									 <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">DETAILS OF THE SOCIETY</a></li>
									   <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PARTNER'S DETAILS</a></li>
									   <li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">UPLOAD</a></li> 
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									 <tr>
                              <td>1. Name of the Society :</td>
                              <td><input type="text" id="soc_name" name="soc_name" class="form-control text-uppercase"   value="<?php if(isset($soc_name))echo $soc_name;?>" pattern="[a-zA-Z0-9\s]{1,}" required="required"/></td>
							     <td>2.Registration:</td>
								  <td><input type="text" id="soc_name" name="soc_name" class="form-control text-uppercase"  value="<?php if(isset($soc_name))echo $soc_name;?>" pattern="[a-zA-Z0-9\s]{1,}" required="required"/></td>
							  </tr>
							  <tr>
							       <td class="half-width">3. Date of Registration :</td>
									<td class="half-width"><input type="text" id"dob" name="farm_es_date"  class="form-control text-uppercase" value="<?php if(isset($est_date)) echo $est_date; ?>" required>
									</td>
									<td class="half-width">4.Date of Establishment: 
									<td class="half-width"><input type="text" id="dob" name="farm_es_date"  class="form-control text-uppercase" value="<?php if(isset($est_date)) echo $est_date; ?>" required>
									</td>
							 </tr>
							 <tr>
							    <td>5. Address of the Society: </td>
					           <td> <span class="soc_alert"></span> </td>
				            </tr>
						    <tr>
						      <td> Mouza :</td><td><input type="text" class="form-control text-uppercase" id="mouza" name="soc_address[mouza]" value="<?php  echo $soc_address_mouza; ?>"/></td>
					   
						      <td>Circle :</td><td><input type="text" class="form-control text-uppercase" id="circle" name="soc_address[circle]" value="<?php  echo $soc_address_circle; ?>"/></td>
					      </tr>
					     <tr>
						    <td> Patta no :</td><td><input type="text" class="form-control text-uppercase" id="patta" name="soc_address[patta]" value="<?php  echo $soc_address_patta; ?>"/></td>
					
						    <td> Dag no :</td><td><input type="text" class="form-control text-uppercase" id="dag" name="soc_address[dag]"  value="<?php  echo $soc_address_dag; ?>"/></td>
				
					    </tr>
					    <tr>
						   <td> Area : </td><td><input type="text" class="form-control text-uppercase" id="area" name="soc_address[area]" value="<?php  echo $soc_address_area; ?>"/></td>
				
					
						   <td> locality : </td><td><input type="text" class="form-control text-uppercase" id="locality" name="soc_address[locality]" value="<?php  echo $soc_address_locality; ?>"/></td>
				
					   </tr>
					   <tr>
						 <td> Village/town/city :</td><td><input type="text" class="form-control text-uppercase" id="village" name="soc_address[village]" value="<?php  echo $soc_address_village; ?>"/></td>
				
					
						 <td> Post Office :</td><td><input type="text"  class="form-control text-uppercase" id="post_office" name="soc_address[po]" value="<?php  echo $soc_address_po; ?>"/></td>
				
					</tr>
					<tr>
						 <td> Police Station :</td><td><input type="text" class="form-control text-uppercase" id="police_station" name="soc_address[ps]" value="<?php  echo $soc_address_ps; ?>"/></td>
				        <td>District</td>
						 <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_dist; ?>" ></td>
					    
				
					</tr>
					<tr>
						 <td>Pin code :</td><td><input type="text" class="form-control text-uppercase" validate="pincode" id="pin" name="soc_address[pin]" maxlength="6" value="<?php  echo $soc_address_pin; ?>"/></td>
				
					</tr>
					

				   </table>
				    <div align="center">
								
					<button type="submit"  style="font-weight:bold" name="save2a" class="btn btn-success">Save and Next</button>
				  </div>	    
				  </form>
				  <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
		   <form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
             <tr>
			    <td colspan="4">6. A list of members of the Executive Committee with their full name(in block letter),address and occupation:</td>
			   </tr>
            <tr>
			 <table class="table table-responsive"> 
			    <thead>
				   <tr>
							<th width="5%" align="center">Sl. No.</th>
							<th width="20%" align="center">Name of the Members</th>
							<th width="20%" align="center">Address</th>
							<th width="20%" align="center">Occupation</th>
							<th width="20%" align="center">Designation</th>
				   </tr>
			    </thead>
				<tbody>	
				<?php 
					$member_results=$rfs->query("select * from society_form2_members where form_id='$form_id'") or die("Error : ".$society->error);
					if($member_results->num_rows==0){
					for($i=1;$i<=count($owners);$i++){ ?>
					<tr>
					<td><?php echo $i; ?></td>
					<td><input type="text" name="member_name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
					<td><input type="text" name="member_fname<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_fname; ?>" /></td>
					<td><input type="text" name="member_address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_address; ?>" /></td>
					<td><input type="text" name="member_occupation<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_occupation; ?>" ></td>
					<td><input type="text" name="member_designation<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_designation; ?>" ></td>
					
					</tr>
					<?php } ?>
				
				
				   