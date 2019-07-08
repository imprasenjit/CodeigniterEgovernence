<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="7";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include("save_form.php");

	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
			$soc_reg_no=$results["soc_reg_no"];
			$date_of_registration=$results["date_of_registration"];$post_office=$results["post_office"];$police_station=$results["police_station"];$date_of_estab=$results["date_of_estab"];$operation_area=$results["operation_area"];
			
			if(!empty($results['society'])){
				$society=json_decode($results['society']);
				$society_name=$society->name;$society_mouza=$society->mouza;$society_circle=$society->circle;$society_patta_no=$society->patta_no;$society_dag_no=$society->dag_no;$society_area=$society->area;$society_locality=$society->locality;$society_vill=$society->vill;$society_post_office=$society->post_office;$society_police_station=$society->police_station;$society_dist=$society->dist;$society_pincode=$society->pincode;
			}else{
				$society_name="";$society_mouza="";$society_circle="";$society_patta_no="";$society_dag_no="";$society_area="";$society_locality="";$society_vill="";$society_post_office="";$society_police_station="";$society_dist="";$society_pincode="";
			}
			if(!empty($results['rectification_reg'])){
				$rectification_reg=json_decode($results['rectification_reg']);
				$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
			}else{
				$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
			}
			#### PART II####
			if(!empty($results["objects"])){
				$objects=json_decode($results["objects"]);
				if(isset($objects->rural)) $objects_rural=$objects->rural;
				else $objects_rural="";
				if(isset($objects->health)) $objects_health=$objects->health;
				else $objects_health="";
				if(isset($objects->women)) $objects_women=$objects->women;
				else $objects_womenr="";				
				if(isset($objects->education)) $objects_education=$objects->education;
				else $objects_education="";
				if(isset($objects->science)) $objects_science=$objects->science;
				else $objects_science="";
				if(isset($objects->art)) $objects_art=$objects->art;
				else $objects_art="";
				if(isset($objects->sports)) $objects_sports=$objects->sports;
				else $objects_sports="";
				if(isset($objects->agriculture)) $objects_agriculture=$objects->agriculture;
				else $objects_agriculture="";
				if(isset($objects->environment)) $objects_environment=$objects->environment;
				else $objects_environment="";
				if(isset($objects->others)) $objects_others=$objects->others;
				else $objects_others="";
			}else{
				$objects_rural="";$objects_health="";$objects_women="";$objects_womenr="";$objects_education="";$objects_science="";$objects_art="";$objects_sports="";$objects_agriculture="";$objects_environment="";$objects_others="";
			}	
			if(!empty($results["objects_of_society"])){
				$objects_of_society=json_decode($results["objects_of_society"]);
				$objects_of_society_rural=$objects_of_society->rural;$objects_of_society_health=$objects_of_society->health;$objects_of_society_women=$objects_of_society->women;$objects_of_society_education=$objects_of_society->education;$objects_of_society_science=$objects_of_society->science;$objects_of_society_art=$objects_of_society->art;$objects_of_society_sports=$objects_of_society->sports;$objects_of_society_agri=$objects_of_society->agri;$objects_of_society_env=$objects_of_society->env;$objects_of_society_other=$objects_of_society->other;
			}else{
				$objects_of_society_rural="";$objects_of_society_health="";$objects_of_society_women="";$objects_of_society_education="";$objects_of_society_science="";$objects_of_society_art="";$objects_of_society_sports="";$objects_of_society_agri="";$objects_of_society_env="";$objects_of_society_other="";
			}
			###### PART III #####
			$proced=$results["proced"];$quorum=$results["quorum"];$election=$results["election"];$short_desc=$results["short_desc"];$term=$results["term"];$re_election=$results["re_election"];$procedure_f_meet=$results["procedure_f_meet"];$quorum_f_meet=$results["quorum_f_meet"];$expulsion=$results["expulsion"];$auditor=$results["auditor"];$legal_procedure=$results["legal_procedure"];$dissolution=$results["dissolution"];
			if(!empty($results["members"])){
				$members=json_decode($results["members"]);
				$members_qualification=$members->qualification;$members_subscription=$members->subscription;$members_collection=$members->collection;$members_control=$members->control;
			}else{
				$members_qualification="";$members_subscription="";$members_collection="";$members_control="";
			}
			if(!empty($results["general_meeting"])){
				$general_meeting=json_decode($results["general_meeting"]);
				$general_meeting_dte=$general_meeting->dte;$general_meeting_place=$general_meeting->place;$general_meeting_number=$general_meeting->number;
			}else{
				$general_meeting_dte="";$general_meeting_place="";$general_meeting_number="";
			}
		}else{
			$form_id="";
			#####PART I #####
			$soc_reg_no="";
			$date_of_registration="";$post_office="";$police_station="";$date_of_estab="";$operation_area="";
			$society_name="";$society_mouza="";$society_circle="";$society_patta_no="";$society_dag_no="";$society_area="";$society_locality="";$society_vill="";$society_post_office="";$society_police_station="";$society_dist="";$society_pincode="";
			##### PART II ####
			$objects_rural="";$objects_health="";$objects_womenr="";$objects_womenr="";$objects_education="";$objects_science="";$objects_art="";$objects_sports="";$objects_agriculture="";$objects_environment="";$objects_others="";
			$objects_of_society_rural="";$objects_of_society_health="";$objects_of_society_women="";$objects_of_society_education="";$objects_of_society_science="";$objects_of_society_art="";$objects_of_society_sports="";$objects_of_society_agri="";$objects_of_society_env="";$objects_of_society_other="";
			###### PART III #####
			$proced="";$quorum="";$election="";$short_desc="";$term="";$re_election="";$procedure_f_meet="";$quorum_f_meet="";$expulsion="";$auditor="";$legal_procedure="";$dissolution="";
			$members_qualification="";$members_subscription="";$members_collection="";$members_control="";
			$general_meeting_dte="";$general_meeting_place="";$general_meeting_number="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$soc_reg_no=$results["soc_reg_no"];
		$date_of_registration=$results["date_of_registration"];$post_office=$results["post_office"];$police_station=$results["police_station"];$date_of_estab=$results["date_of_estab"];$operation_area=$results["operation_area"];
		
		if(!empty($results['society'])){
			$society=json_decode($results['society']);
			$society_name=$society->name;$society_mouza=$society->mouza;$society_circle=$society->circle;$society_patta_no=$society->patta_no;$society_dag_no=$society->dag_no;$society_area=$society->area;$society_locality=$society->locality;$society_vill=$society->vill;$society_post_office=$society->post_office;$society_police_station=$society->police_station;$society_dist=$society->dist;$society_pincode=$society->pincode;
		}else{
			$society_name="";$society_mouza="";$society_circle="";$society_patta_no="";$society_dag_no="";$society_area="";$society_locality="";$society_vill="";$society_post_office="";$society_police_station="";$society_dist="";$society_pincode="";
		}
		if(!empty($results['rectification_reg'])){
			$rectification_reg=json_decode($results['rectification_reg']);
			$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
		}else{
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
		}
		#### PART II####
		if(!empty($results["objects"])){
			$objects=json_decode($results["objects"]);
			if(isset($objects->rural)) $objects_rural=$objects->rural;
			else $objects_rural="";
			if(isset($objects->health)) $objects_health=$objects->health;
			else $objects_health="";
			if(isset($objects->women)) $objects_women=$objects->women;
			else $objects_womenr="";				
			if(isset($objects->education)) $objects_education=$objects->education;
			else $objects_education="";
			if(isset($objects->science)) $objects_science=$objects->science;
			else $objects_science="";
			if(isset($objects->art)) $objects_art=$objects->art;
			else $objects_art="";
			if(isset($objects->sports)) $objects_sports=$objects->sports;
			else $objects_sports="";
			if(isset($objects->agriculture)) $objects_agriculture=$objects->agriculture;
			else $objects_agriculture="";
			if(isset($objects->environment)) $objects_environment=$objects->environment;
			else $objects_environment="";
			if(isset($objects->others)) $objects_others=$objects->others;
			else $objects_others="";
		}else{
			$objects_rural="";$objects_health="";$objects_women="";$objects_womenr="";$objects_education="";$objects_science="";$objects_art="";$objects_sports="";$objects_agriculture="";$objects_environment="";$objects_others="";
		}	
		if(!empty($results["objects_of_society"])){
			$objects_of_society=json_decode($results["objects_of_society"]);
			$objects_of_society_rural=$objects_of_society->rural;$objects_of_society_health=$objects_of_society->health;$objects_of_society_women=$objects_of_society->women;$objects_of_society_education=$objects_of_society->education;$objects_of_society_science=$objects_of_society->science;$objects_of_society_art=$objects_of_society->art;$objects_of_society_sports=$objects_of_society->sports;$objects_of_society_agri=$objects_of_society->agri;$objects_of_society_env=$objects_of_society->env;$objects_of_society_other=$objects_of_society->other;
		}else{
			$objects_of_society_rural="";$objects_of_society_health="";$objects_of_society_women="";$objects_of_society_education="";$objects_of_society_science="";$objects_of_society_art="";$objects_of_society_sports="";$objects_of_society_agri="";$objects_of_society_env="";$objects_of_society_other="";
		}
		###### PART III #####
		$proced=$results["proced"];$quorum=$results["quorum"];$election=$results["election"];$short_desc=$results["short_desc"];$term=$results["term"];$re_election=$results["re_election"];$procedure_f_meet=$results["procedure_f_meet"];$quorum_f_meet=$results["quorum_f_meet"];$expulsion=$results["expulsion"];$auditor=$results["auditor"];$legal_procedure=$results["legal_procedure"];$dissolution=$results["dissolution"];
		if(!empty($results["members"])){
			$members=json_decode($results["members"]);
			$members_qualification=$members->qualification;$members_subscription=$members->subscription;$members_collection=$members->collection;$members_control=$members->control;
		}else{
			$members_qualification="";$members_subscription="";$members_collection="";$members_control="";
		}
		if(!empty($results["general_meeting"])){
			$general_meeting=json_decode($results["general_meeting"]);
			$general_meeting_dte=$general_meeting->dte;$general_meeting_place=$general_meeting->place;$general_meeting_number=$general_meeting->number;
		}else{
			$general_meeting_dte="";$general_meeting_place="";$general_meeting_number="";
		}
	}
	
	##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	$tabbtn1="";$tabbtn2="";$tabbtn3=""; 
	if($showtab=="" || $showtab<2 || $showtab>6 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3=""; 
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3=""; 
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active"; 
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
	<?php include ("".$table_name."_addmore.php"); ?>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
<div id="loader" class="loader" style="display:none;"></div>
<div class="wrapper">
<?php require_once "../../requires/header.php";   ?>
<?php require '../../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PART II</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">PART III</a></li>
							</ul><br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive">
										<tr>
											<td width="25%">1. Name of the Society</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $unit_name;?>"></td>
											<td width="25%">2. Registration No.</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="soc_reg_no" value="<?php echo $soc_reg_no;?>"  ></td>
										</tr>
										<tr>
											<td width="25%">3. Date of Registration</td>
											<td width="25%"><input type="date" class="dob form-control text-uppercase" name="date_of_registration"  value="<?php echo $date_of_registration;?>"></td>
											<td width="25%">4. Date of Establishment</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $date_of_commencement;?>"  ></td>
										</tr>
										<tr>
											<td colspan="4">5. Address of the Society</td>
										</tr>
										<tr>
											<td>Mouza </td>
											<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $mouza; ?>"/></td>
											<td>Circle</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $circle; ?>"/></td>
										</tr>
										<tr>
											<td>Patta No. </td>
											<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $patta_no; ?>"/></td>
											<td>Dag No.</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $dag_no; ?>"/></td>
										</tr>
										<tr>
											<td>Area</td>
											<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $area; ?>"/></td>
											<td>Locality  </td>
											<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $b_street_name2; ?>"/></td>
										</tr>
										<tr>
											<td>Village/town/city </td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_vill; ?>"/></td>
											<td>Post Office </td>
											<td><input type="text"  class="form-control text-uppercase" id="post_office" name="post_office" value="<?php  echo $post_office; ?>"/></td>
										</tr>
										<tr> 
											<td>Police Station </td>
											<td><input type="text" class="form-control text-uppercase" id="police_station" name="police_station" value="<?php  echo $police_station; ?>"/></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_dist; ?>"/></td>
										</tr>
										<tr>
											<td>Pin code </td>
											 <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_pincode; ?>" ></td>
											 <td>Mobile No.</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
										</tr>
										<tr>
											<td>Email ID</td>
											<td><input type="text" class="form-control" disabled value="<?php  echo $b_email; ?>"/></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">6. Memorandum of Association</td>
										</tr>
										<tr>
											 <td>6.1 Name of the Society<span class="mandatory_field">*</span></td>
											 <td><input type="text"  class="form-control text-uppercase" name="society[name]"  value="<?php echo $society_name; ?>" required /></td>
											 <td></td>
											 <td></td>
										</tr>
										<tr>
											<td colspan="4">6.2 Address of the Society </td>
										</tr>
										<tr>
											<td>Mouza </td>
											<td><input type="text" class="form-control text-uppercase"  name="society[mouza]" value="<?php  echo $society_mouza; ?>"/></td>
											<td>Circle</td>
											<td><input type="text" class="form-control text-uppercase" name="society[circle]" value="<?php  echo $society_circle; ?>"/></td>
										</tr>
										<tr>
											<td>Patta No. </td>
											<td><input type="text" class="form-control text-uppercase"  name="society[patta_no]" value="<?php  echo $society_patta_no; ?>"/></td>
											<td>Dag No.</td>
											<td><input type="text" class="form-control text-uppercase" name="society[dag_no]" value="<?php  echo $society_dag_no; ?>"/></td>
										</tr>
										<tr>
											<td>Area</td>
											<td><input type="text" class="form-control text-uppercase"  name="society[area]" value="<?php  echo $society_area; ?>"/></td>
											<td>Locality  </td>
											<td><input type="text" class="form-control text-uppercase" name="society[locality]" value="<?php  echo $society_locality; ?>"/></td>
										</tr>
										<tr>
											<td>Village/town/city </td>
											<td><input type="text" class="form-control text-uppercase" name="society[vill]" value="<?php  echo $society_vill; ?>"/></td>
											<td>Post Office </td>
											<td><input type="text"  class="form-control text-uppercase"  name="society[post_office]" value="<?php  echo $society_post_office; ?>"/></td>
										</tr>
										<tr>
											<td>Police Station </td>
											<td><input type="text" class="form-control text-uppercase"  name="society[police_station]" value="<?php  echo $society_police_station; ?>"/></td>
											<td>District<span class="mandatory_field">*</span></td>
                                             <td><input type="text" name="society[dist]" id="dist1"  class="form-control text-uppercase is_different_yes_class" value="<?php  echo $society_dist; ?>"></td>
											
										</tr>
										<tr>
											<td>Pin code </td>
											<td><input type="text" class="form-control text-uppercase" name="society[pincode]" value="<?php  echo $society_pincode; ?>" maxlength="6" validate="pincode"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td align="center" colspan="4">
												<button type="submit"  style="font-weight:bold" name="save<?php echo $form;?>a" class="btn btn-success submit1">Save and Next</button>
											</td>
										</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform" id="myform21" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id=""  class="table table-responsive">
										<tr>
											<td colspan="4">6.3 The objects for which the Society is established are</td>
										</tr>
										<tr>								
											<td width="25%"><input type="checkbox" name="objects[rural]" value="Rural Development" <?php if(isset($objects_rural) && $objects_rural=='Rural Development') echo 'checked'; ?>>Rural Development </td>
											<td width="25%"><input type="checkbox" name="objects[health]" value="Health" <?php if(isset($objects_health) && $objects_health=='Health') echo 'checked'; ?>> Health </td>
											<td width="25%"><input type="checkbox" name="objects[women]" value="Women & Child Welfare" <?php if(isset($objects_women) && $objects_women=='Women & Child Welfare') echo 'checked'; ?>> Women & Child Welfare</td>
											<td width="25%"><input type="checkbox" name="objects[education]" value="Education" <?php if(isset($objects_education) && $objects_education=='Education') echo 'checked'; ?>> Education </td>
										</tr>
										<tr>								
											<td><input type="checkbox" name="objects[science]" value="Science & Technology" <?php if(isset($objects_science) && $objects_science=='Science & Technology') echo 'checked'; ?>>Science & Technology </td>
											<td><input type="checkbox" name="objects[art]" value="Art & Culture" <?php if(isset($objects_art) && $objects_art=='Art & Culture') echo 'checked'; ?>> Art & Culture </td>
											<td><input type="checkbox" name="objects[sports]" value="Sports" <?php if(isset($objects_sports) && $objects_sports=='Sports') echo 'checked'; ?>> Sports</td>
											<td><input type="checkbox" name="objects[agriculture]" value="Agriculture" <?php if(isset($objects_agriculture) && $objects_agriculture=='Agriculture') echo 'checked'; ?>> Agriculture </td>
										</tr>
										<tr>								
											<td><input type="checkbox" name="objects[environment]" value="Environment" <?php if(isset($objects_environment) && $objects_environment=='Environment') echo 'checked'; ?>>Environment </td>
											<td><input type="checkbox" name="objects[others]" value="Others" <?php if(isset($objects_others) && $objects_others=='Others') echo 'checked'; ?>> Others </td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">6.4  The name, address and designation of the present members of the Executive Committee or Governing Body.</td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable2" id="objectTable2" class="text-center table table-responsive table-bordered">
											<thead>
											<tr>
												<th>Sl No.</th>
												<th>Name of the Members</th>
												<th>Address</th>
												<th>Occupation</th>
												<th>Designation</th>
											</tr>
											</thead>
													<?php
													$part2=$formFunctions->executeQuery($dept,"select * from rfs_form".$form."_t2 where form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
													$count=1;
													while($row_2=$part2->fetch_array()){?>
													<tr>
														<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["sl_no"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
														<td><input type="text" id="txxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["member_name"]; ?>" name="txxtB<?php echo $count;?>" ></td>
														<td><input type="text" value="<?php echo $row_2["member_address"]; ?>"  id="txxtC<?php echo $count;?>" class="form-control text-uppercase" name="txxtC<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_2["member_occupation"]; ?>" id="txxtD<?php echo $count;?>" class="form-control text-uppercase" name="txxtD<?php echo $count;?>"  ></td>
														<td><input type="text" value="<?php echo $row_2["member_designation"]; ?>" id="txxtE<?php echo $count;?>" class="form-control text-uppercase" name="txxtE<?php echo $count;?>"  ></td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text" readonly value="1" id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
														<td><input type="text" id="txxtB1"  class="form-control text-uppercase" name="txxtB1"></td>
														<td><input type="text" id="txxtC1"  class="form-control text-uppercase" name="txxtC1"></td>					
														<td><input type="text" id="txxtD1" class="form-control text-uppercase" name="txxtD1" ></td>
														<td><input type="text" id="txxtE1" class="form-control text-uppercase" name="txxtE1" ></td>
													</tr>
													<?php } ?>
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4">6.5  We the undersigned are desirous of forming a society in pursuance of the Memorandum of Association.</td>
										</tr>
										<tr>
											<td colspan="4">
												<table name="objectTable1" class=" table table-responsive table-bordered text-center "id="objectTable1" >
													<thead>
													<tr>
														<th>Sl. No.</th>
														<th>Nmae of the members of the society in full</th>
														<th>Address</th>
														<th>Occupation</th>
														<th>Designation</th>
													</tr>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input type="text" id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["signature"]; ?>" name="txtB<?php echo $count;?>" ></td>
														<td><input type="text" value="<?php echo $row_1["address"]; ?>"  id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_1["occupation"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"  ></td>
														<td><input type="text" value="<?php echo $row_1["designation"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"  ></td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text" readonly value="1" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
														<td><input type="text" id="txtB1"  class="form-control text-uppercase" name="txtB1"></td>
														<td><input type="text" id="txtC1"  class="form-control text-uppercase" name="txtC1"></td>					
														<td><input type="text" id="txtD1" class="form-control text-uppercase" name="txtD1" ></td>
														<td><input type="text" id="txtE1" class="form-control text-uppercase" name="txtE1" ></td>
													</tr>
													<?php } ?>
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>									
										</tr>
										<tr>
											<td>6.6 Date of Establishment</td>
											<td><input type="text" class="dob form-control text-uppercase" name="date_of_estab" value="<?php  echo $date_of_estab; ?>" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">7. Rules and Regulation of the society</td>
										</tr>
										<tr>
											<td>7.1 Area of operation</td>
											<td><input type="text" class="form-control text-uppercase" name="operation_area" value="<?php  echo $operation_area; ?>" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">7.2 Objects: The objects of the Society should be written elaborately</td>
										</tr>
										<tr>
											<td>(a) Rural Development</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[rural]" ><?php  echo $objects_of_society_rural; ?></textarea></td>
											<td>(b) Health</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[health]" ><?php  echo $objects_of_society_health; ?></textarea></td>
										</tr>
										<tr>
											<td>(c) Women & Child Welfare</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[women]" ><?php  echo $objects_of_society_women; ?></textarea></td>
											<td>(d) Education</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[education]" ><?php  echo $objects_of_society_education; ?></textarea></td>
										</tr>
										<tr>
											<td>(e) Science & Technology</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[science]" ><?php  echo $objects_of_society_science; ?></textarea></td>
											<td>(f) Art & Culture</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[art]" ><?php  echo $objects_of_society_art; ?></textarea></td>
										</tr>
										<tr>
											<td>(g) Sports</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[sports]" ><?php  echo $objects_of_society_sports; ?></textarea></td>
											<td>(h) Agriculture</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[agri]" ><?php  echo $objects_of_society_agri; ?></textarea></td>
										</tr>
										<tr>
											<td>(i) Environment</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[env]" ><?php  echo $objects_of_society_env; ?></textarea></td>
											<td>(j) Others</td>
											<td><textarea class="form-control text-uppercase" name="objects_of_society[other]" ><?php  echo $objects_of_society_other; ?></textarea></td>
										</tr>
										<tr>
											<td class="text-center" colspan="4">
												<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> Save & Next</button>
											</td>
										</tr>
										</table>
									</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform" id="myform21" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id=""  class="table table-responsive">
										<tr>
											<td colspan="4">7.3 Members</td>
										</tr>
										<tr>
											<td width="25%">(a) Qualification to become Members</td>
											<td width="25%"><textarea class="form-control text-uppercase" name="members[qualification]" ><?php  echo $members_qualification; ?></textarea></td>
											<td width="25%">(b) Subscription, Donation etc.</td>
											<td width="25%"><textarea class="form-control text-uppercase" name="members[subscription]" ><?php  echo $members_subscription; ?></textarea></td>
										</tr>
										<tr>
											<td>(c) Collection of Fund</td>
											<td><textarea class="form-control text-uppercase" name="members[collection]" ><?php  echo $members_collection; ?></textarea></td>
											<td>(d) Control of Fund</td>
											<td><textarea class="form-control text-uppercase" name="members[control]" ><?php  echo $members_control; ?></textarea></td>
										</tr>
										<tr>
											<td>7.4 Procedure of the General Meeting (How many times in a year General Meeting will be held)</td>
											<td><input type="text" class="form-control text-uppercase" name="proced" value="<?php  echo $proced; ?>" ></td>
											<td>7.5 Quorum of the General Meeting (How many times of the total members of the General Body are required to be present to form quorum of the General body meeting.</td>
											<td><input type="text" class="form-control text-uppercase" name="quorum" value="<?php  echo $quorum; ?>" ></td>
										</tr>
										<tr>
											<td>7.6 Election procedure of the Executive Committee/Governing Body/Managing Committee</td>
											<td><input type="text" class="form-control text-uppercase" name="election" value="<?php  echo $election; ?>" ></td>
											<td>7.7 Short description of the Executive Body. (This description must tally with the list given in the item no. 4.4 of the Memorandum of Association.</td>
											<td><input type="text" class="form-control text-uppercase" name="short_desc" value="<?php  echo $short_desc; ?>" ></td>
										</tr>
										<tr>
											<td>7.8 The term of the Executive Committee</td>
											<td><input type="text" class="form-control text-uppercase" name="term" value="<?php  echo $term; ?>" ></td>
											<td>7.9 Procedure of the Re-election of the members of the Executive Committee</td>
											<td><input type="text" class="form-control text-uppercase" name="re_election" value="<?php  echo $re_election; ?>" ></td>
										</tr>
										<tr>
											<td>7.10 Procedure of the meeting of the Executive Committee. (How many times in a year or month the meeting of the Executive body will be held)</td>
											<td><input type="text" class="form-control text-uppercase" name="procedure_f_meet" value="<?php  echo $procedure_f_meet; ?>" ></td>
											<td>7.11 Quorum of the Meeting of the Executive Committee. (How many of the members of the Executive Body required to be present to form Quorum of the meeting of the Executive Body)</td>
											<td><input type="text" class="form-control text-uppercase" name="quorum_f_meet" value="<?php  echo $quorum_f_meet; ?>" ></td>
										</tr>
										<tr>
											<td>7.12 Expulsion of undesirable member</td>
											<td><input type="text" class="form-control text-uppercase" name="expulsion" value="<?php  echo $expulsion; ?>" ></td>
											<td>7.13 Auditor</td>
											<td><input type="text" class="form-control text-uppercase" name="auditor" value="<?php  echo $auditor; ?>" ></td>
										</tr>
										<tr>
											<td>7.14 Legal Procedure</td>
											<td><input type="text" class="form-control text-uppercase" name="legal_procedure" value="<?php  echo $legal_procedure; ?>" ></td>
											<td>7.15 Dissolution</td>
											<td><input type="text" class="form-control text-uppercase" name="dissolution" value="<?php  echo $dissolution; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">8. General Meeting</td>
										</tr>
										<tr>
											<td>Date of holding the meeting<span class="mandatory_field">*</span></td>
											<td><input type="text" class="dob form-control text-uppercase" name="general_meeting[dte]" value="<?php echo $general_meeting_dte; ?>" required/></td>
											<td>Place of meeting<span class="mandatory_field">*</span></td>
											<td><input type="text" class=" form-control text-uppercase" name="general_meeting[place]" value="<?php echo $general_meeting_place; ?>" required ></td>
										</tr>
										<tr>
											<td>Number of public present<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase" name="general_meeting[number]" value="<?php echo $general_meeting_number; ?>" required/></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td class="text-center" colspan="4">
												<a href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>c" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> Save & Next</button>
											</td>
										</tr>
										<tr>
											<td colspan="2">Date : <strong><?php echo $today;?></strong><br/>
												Place : <strong><?php echo strtoupper($dist);?></strong></td>
											<td align="right" colspan="2">
												<b><?php echo strtoupper($key_person)?></b><br/>
													Signature of the Applicant               
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
	 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
</body>
</html>