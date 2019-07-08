<?php  require_once "../../requires/login_session.php";

$check=$formFunctions->is_already_registered('rfs','7');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=7&dept=rfs';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=7&dept=rfs';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_form_test.php";

   
    $dataStat=0;   //set $dataStat=1 if data needs to be updated else keep it default as $dataStat=0
	$iscomplete=0;//Save mode D than 

	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$Type_of_ownership=$row1['Type_of_ownership'];
	$pan=$row1['pan_doc'];
	if($Type_of_ownership=="PP"){
		$Name_of_owner=$row1['Name_of_owner'];
		$owners=Array();
		$owners=explode(",",$Name_of_owner);
	} 
	$sector_classes_b=$row1['sector_classes_b'];
	$sector_classes_b=get_sector_classes_b_value($sector_classes_b);
	
	$date_of_commencement=$row1['date_of_commencement'];
	$unit_name=$row1['Name'];$pan_no=$row1['pan_no'];
	
    $email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$pattano=$row1['pattano'];$dagno=$row1['dagno'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$revenue=$row1['revenue'];$mouza=$row1['mouza'];
    $date_of_commencement=$row1['date_of_commencement'];
	
	$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
	if($previous_details->num_rows>0){
		$prev_results=$previous_details->fetch_assoc();
		
		$reg_no=$prev_results->uain;$reg_date=$prev_results->upload_date;$unit_name=$prev_results->soc_name;$soc_address=$prev_results->soc_address;
		
		if(!empty($soc_address)){
			$soc_address=json_decode($row1['soc_address']);
			$mouza=$soc_address->mouza;$revenue=$soc_address->circle;$pattano=$soc_address->patta;$dagno=$soc_address->dag;$street_name1=$soc_address->area;$street_name2=$soc_address->locality;
			$b_vill=$soc_address->village;$b_dist=$soc_address->dist;$b_pincode=$soc_address->pin;
			$police_station=$soc_address->ps;$post_office=$soc_address->po;			
		}else{
			$soc_address_mouza="";$soc_address_circle="";$pattano="";$soc_address_dag="";$soc_address_area="";$soc_address_locality="";
			$soc_address_village="";$soc_address_dist="";$soc_address_pin="";$soc_address_ps="";$soc_address_po="";	
		}
	
		$q=$rfs->query("select * from rfs_form7 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();

		if($q->num_rows<1){	 ###EMPTY FORM DETAILS###
			$form_id="";$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";
		}else{		
			$form_id=$results['form_id'];$post_office=$results['post_office'];$police_station=$results['police_station'];$reg_date=$results['reg_date'];$obj_rural=$results['obj_rural'];
			$reg_no=$results['reg_no'];	$propsociety=$results['propsociety'];$obj_woman=$results['obj_woman'];$obj_health=$results['obj_health'];$obj_education=$results['obj_education'];	$obj_science=$results['obj_science'];$obj_arts=$results['obj_arts'];$obj_sports=$results['obj_sports'];$obj_env=$results['obj_env'];$obj_other=$results['obj_other'];
			$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];
			
		}
	}else{
		$form_id="";$post_office="";$police_station="";$reg_date="";$reg_no="";$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$propsociety="";$name="";$registration="";$dateofregistration="";$dateofestablisment="";$b_mouza="";
		$b_circle="";$b_patta="";$b_dag="";$b_area="";$b_locality="";$b_village="";$b_postoffice="";$b_policestation="";$b_district="";$b_pincode1=""; $b_mobile ="";  
		
		$q=$rfs->query("select * from rfs_form7 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();

		if($q->num_rows>0){		
			$form_id=$results['form_id'];$post_office=$results['post_office'];$police_station=$results['police_station'];$reg_date=$results['reg_date'];$obj_rural=$results['obj_rural'];
			$form_id=$results['form_id'];$post_office=$results['post_office'];$police_station=$results['police_station'];$reg_date=$results['reg_date'];$obj_rural=$results['obj_rural'];
			$obj_woman=$results['obj_woman'];$obj_health=$results['obj_health'];$obj_education=$results['obj_education'];	$obj_science=$results['obj_science'];$obj_arts=$results['obj_arts'];$obj_sports=$results['obj_sports'];$obj_env=$results['obj_env'];$obj_other=$results['obj_other'];
			$reg_no=$results['reg_no'];$propsociety=$results['propsociety'];	
			$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];
		}		
	}
	
	##PHP TAB management	
   if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";
	if($showtab=="" || $showtab<1 || $showtab>4|| is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";
		
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";
		
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";
		
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
									<strong>Form No 7<br/><?php echo $form_name=$cms-> query("select form_name from rfs_form_names  where  form_no='7'")->fetch_object()->form_name; ?></strong>
								</h4>	
							    </div>
							<div class="panel-body">
							<ul class="nav nav-pills">
									  <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">DETAILS OF THE SOCIETY</a></li>
									  
									   <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">Pa</a></li>
									   <li class="<?php echo $tabbtn3;?>"><a data-toggle="tab" href="#table3">P</a></li>
									   <li class="<?php echo $tabbtn4;?>"><a data-toggle="tab" href="#table4">Pa</a></li>
									   <li class="<?php echo $tabbtn5;?>"><a data-toggle="tab" href="#table5">Pa</a></li>
									</ul>
									<br>
							<div class="tab-content">
							<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
						   <form name="myform1" id="myform1" method="post" action="<?php echo    htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			 		      
                         <table class="table table-responsive">
						      <tr>
                              <td width="25%">1.  Name of the Society :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
                              
							     <td width="25%">2. Registration No :</td>
								  <td width="25%"><input type="text"  class="form-control text-uppercase class_disable" name="reg_no" value="<?php echo $reg_no; ?>" <?php if(empty($reg_no)) echo "required";?>  ></td>
							  </tr>
							  <tr>
							       <td class="25%">3. Date of Registration:</td>
									<td class="25%"><input type="text" id="dob" name="reg_date"  class="form-control text-uppercase class_disable" value="<?php echo $reg_date; ?>" <?php if(empty($reg_date)) echo "required";?>></td>
									<td class="half-width">4. Date of Establishment :<td class="half-width"><input type="text" name="farm_es_date"  class="form-control text-uppercase" value="<?php if(isset($date_of_commencement)) echo $date_of_commencement; ?>" disabled>
									</td>
							 </tr>
							 <tr>
							    <td>5. Address of the Society : </td>
					           <td> <span class="soc_alert"></span> </td>
				            </tr>
						    <tr>
						      <td> Mouza :</td><td><input type="text"  class="form-control" disabled value="<?php echo $mouza; ?>" ></td>
					   
						      <td>Circle :</td>
							   <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $revenue; ?>" ></td>
					       </tr>
					      <tr>
						    <td> Patta no :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $pattano; ?>" ></td>
					
						    <td> Dag no :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>" ></td> 
				
					    </tr>
					    <tr>
						   <td> Area : </td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_street_name1; ?>" ></td>
				
					
						   <td> Locality : </td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo 	$b_street_name2; ?>" ></td>
				
					   </tr>
					   <tr>
						 <td> Village :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>" ></td>
				
					
						 <td> Post Office :</td><td><input type="text"  class="form-control text-uppercase" id="post_office" name="post_office" value="<?php  echo $post_office; ?>"/></td>
				
					</tr>
					<tr>
						 <td> Police Station :</td><td><input type="text" class="form-control text-uppercase" id="police_station" name="police_station" value="<?php  echo $police_station; ?>"/></td>
				
					    <td>District</td>
						 <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_dist; ?>" ></td>
								
					</tr>
					<tr>
						 <td>Pin code :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_pincode; ?>" ></td>
						 </td>
				
			
					    <td>Mobile No. :</td>
					    <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
			       </tr>
                  
			       <tr>
					   <td>Email ID :</td>
					  <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_email; ?>" ></td>
					
					   
			
			       <tr>
				   <td>Memorandum of Association</td>
			       <td> <span class="soc_alert"></span> </td>
				   
			      </tr> 
				   <table class="table table-responsive">
						      <tr>
                              <td width="25%">1.  Name of the Society :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $name="";?>" >
								 </td>
                              
							     <td width="25%">2. Registration No :</td>
								  <td width="25%"><input type="text"  class="form-control text-uppercase class_disable" name="reg_no" value="<?php echo $registration; ?>" <?php if(empty($reg_no)) echo "required";?>  ></td>
							  </tr>
							  <tr>
							       <td class="25%">3. Date of Registration:</td>
									<td class="25%"><input type="text" id="dob" name="reg_date"  class="form-control text-uppercase class_disable" value="<?php echo $dateofregistration; ?>" <?php if(empty($dateofregistration)) echo "required";?>></td>
									
									<td class="half-width">4. Date of Establishment :<td class="half-width"><input type="text" name="farm_es_date"  class="form-control text-uppercase" value="<?php if(isset($dateofestablisment)) echo $$dateofestablisment; ?>" disabled>
									</td>
							 </tr>
							 <tr>
							    <td>5. Address of the Society : </td>
					           <td> <span class="soc_alert"></span> </td>
				            </tr>
						    <tr>
						      <td> Mouza :</td><td><input type="text"  class="form-control text-uppercase" name="society_mouza" value="<?php echo $b_mouza; ?>" ></td>
					   
						      <td>Circle :</td>
							   <td><input type="text"  class="form-control text-uppercase" name="society_mouza" value="<?php echo $b_circle; ?>" ></td>
					       </tr>
					      <tr>
						    <td> Patta no :</td><td><input type="text"  class="form-control text-uppercase" name="patta" value="<?php echo $b_patta; ?>" ></td>
					
						    <td> Dag no :</td><td><input type="text"  class="form-control text-uppercase" name="dag" value="<?php echo $b_dag; ?>" ></td> 
				
					    </tr>
					    <tr>
						   <td> Area : </td><td><input type="text"  class="form-control text-uppercase" name="area" value="<?php echo $b_area; ?>" ></td>
				
					
						   <td> Locality : </td><td><input type="text"  class="form-control text-uppercase" name="locality" value="<?php echo 	$b_locality; ?>" ></td>
				
					   </tr>
					   <tr>
						 <td> Village :</td><td><input type="text"  class="form-control text-uppercase"  name="village" value="<?php echo $b_village; ?>" ></td>
				
					
						 <td> Post Office :</td><td><input type="text"  class="form-control text-uppercase" id="post_office" name="post_office" value="<?php  echo $b_postoffice; ?>"/></td>
				
					</tr>
					<tr>
						 <td> Police Station :</td><td><input type="text" class="form-control text-uppercase" id="police_station" name="police_station" value="<?php  echo $b_policestation; ?>"/></td>
				
					    <td>District</td>
						 <td><input type="text"  class="form-control text-uppercase" name="district" value="<?php echo $b_district; ?>" ></td>
								
					</tr>
					<tr>
						 <td>Pin code :</td><td><input type="text"  class="form-control text-uppercase" name="pincode" value="<?php echo $b_pincode1; ?>" ></td>
						 </td>
				
			
					    <td>Mobile No. :</td>
					    <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile; ?>"/></td>
			       </tr>
				   
                  <tr>
						<td colspan="4"><b>   3. The Objects for which the Society is established are :</b></td>
					</tr>
					<tr>
						 <td> 1) Rural Development :</td>
						 <td><input type="text" id="rural_dev" class="form-control text-uppercase" name="rural_dev" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_rural)){echo $obj_rural;} ?>" required /></td>
					    
						 <td>2) Health :</td>
						 <td><input type="text" id="health" name="health" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_health)){echo $obj_health;} ?>" required /></td>
					</tr>
					<tr>
						 <td> 3) Women & Child Welfare  :</td>
						 <td><input type="text" id="w_c_welfare" name="w_c_welfare" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_woman)){echo $obj_woman;} ?>" required /></td>
					
						 <td> 4) Education :</td>
						 <td><input type="text" id="education" name="education" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_education)){echo $obj_education;} ?>" required /></td>
				
					</tr>
					<tr>
						 <td>5) Science & Technology : </td>
						 <td><input type="text" id="s_techno" name="s_techno" class="form-control text-uppercase"  pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_science)){echo $obj_science;} ?>" required/></td>
				
					
						 <td>6) Art & Culture : </td>
						 <td><input type="text" id="art_cul" name="art_cul" class="form-control text-uppercase"  pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_arts)){echo $obj_arts;} ?>" required/></td>
				
					</tr>
					<tr>
						 <td> 7) Sports:</td>
						 <td><input type="text" id="sports" name="sports" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_sports)){echo $obj_sports;} ?>" required/></td>
				
					
						 <td>8) Agriculture:</td>
						 <td><input type="text" id="agriculture" name="agriculture" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_agri)){echo $obj_agri;} ?>" required /></td>
				
					</tr>
					<tr>
						 <td>9) Environment:</td>
						 <td><input type="text" id="environment" name="environment" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_env)){echo $obj_env;} ?>" required /></td>
				
					
						 <td>10) others: </td>
						 <td><input type="text" id="others" name="others" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_other)){echo $obj_other;} ?>" required /></td>
				
					</tr>
					</table>
									    
							<div align="center">
								
								<button type="submit"  style="font-weight:bold" name="save7" class="btn btn-success">Save and Next</button>
							</div>	    
								</form>
							</div>
					<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
						<form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    
				          
				  
				                   <tr>
										<td colspan="4">
										<table id="" class="text-center table table-responsive table-bordered">
										<thead>
										<tr>
											<th>Sl No.</th>
											<th>Name of applicant</th>
											<th>Address</th>
											<th>Age</th>
											<th>Phone No.</th>
											<th>Signature</th>
										</tr>
										</thead>
										<tbody>
										
										<?php 
										$member_results=$society->query("select * from society_form1_members where form_id='$form_id'") or die("Error : ".$society->error);
										if($member_results->num_rows==0){
											        for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="member_name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="member_address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_address; ?>" /></td>
												<td><input type="text" name="member_age<?php echo $i;?>" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $member_age; ?>" /></td>
												<td><input type="text" name="member_phone<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_phone; ?>" maxlength="10" validate="mobileNumber" ></td>
												<td><input type="text" name="member_signature<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_signature; ?>" /></td>
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
												<td><input type="text" name="member_age<?php echo $i;?>" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $rows->member_age; ?>" /></td>
												<td><input type="text" name="member_phone<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->member_phone; ?>" maxlength="10" validate="mobileNumber" ></td>
												<td><input type="text" name="member_signature<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->member_signature; ?>" /></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>
 										
										</tbody>
										</table>
										</td>
									</tr>
							
									
									 <tr>
										<td class="text-center" colspan="4">				
											<button type="submit" class="btn btn-success" name="save1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
							 </div>
				<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
						<form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"> 
							
			<b> 4. We the undersigned are desirous of forming a society in pursuance of this Memorandum of Association</b>
			<table id=""  class="table table-responsive">
				<thead>
						<td>S.NO</td>
						<td>Name</td>
						  <td>Scanned copy of signatures of the member of  the society <br/>in full</td>
						  <td>Address</td>
							<td>Occupation</td>
							<td>Designation</td>
					</thead>
					<tbody>
					
							<?php
				if($memberCount>0){
					$upload1="upload/";
                   
					$moreindex1=count($partner); 
					for($m=1;$m<=count($partner);$m++){					
	                    $p="p$m";
						
						?>
						
						<tr id="<?php echo ($m);?>">
						<td width="5%"><?php echo ($m); ?></td>
						<td>
						<input type="hidden" name="" value="<?php  ?>"/>
						<input type="text" validate="specialChar" class="form-control text-uppercase"name="partner[<?php echo $m; ?>][pname]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['pname']; ?>" required/>
						</td>

						<td>
							 <span id="photo50"><div class="cropme" style="width: 70px; height: 30px; display: none;" id="<?php echo "s".$p;?>"><img src="../../../images/ajax-loader.gif" alt="loading"></div>
							 <div class="cropme" style="width: 40px; height: 0px;" id="<?php echo "e".$p;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('<?php echo $p ?>')">Edit</span>
							</div><span id="<?php echo"v".$p; ?>" style="float: left;"><a href="<?php echo $upload1.$partner[$m]['photo'];?>" target="_blank" ><i class="fa fa-file-text" aria-hidden="true"></i> View</a></span>
						      </span>
							<input type="hidden" id="<?php echo "f".$p;?>" name="partner[<?php echo $m;?>][photo]" value="<?php echo $partner[$m]['photo'];?>">
						</td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[<?php echo $m; ?>][paddr]" value="<?php echo $partner[$m]['paddr']; ?>" required/></td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[<?php echo $m; ?>][poccupation]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['poccupation'];  ?>" required/></td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[<?php echo $m; ?>][pdesig]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['pdesig']; ?>" required/></td>
						}
						
					</tr>
						
				<?php
					
					}
				}else{ 
                  $moreindex1=1;
						
				echo ""
				?>
					<tr>
						<td width="5%">1</td>
						<td>
						
						<input type="text" class="form-control text-uppercase" name="partner[1][pname]" pattern="[a-zA-Z_/.\s]+$" required/>
						</td>
						<td><span id="photo50"><div class="cropme" style="width: 70px; height: 30px;" id="sp1" >
									  <input type="button" onclick="crop_test('p1')"  name="upload1" id="test"  class="btn btn-primary"  value="upload"  />
						
									  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep1" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p1')">Edit</span>
									  
									  </div>
									  <span id="vp1" style="float: left;" ></span>
									  <input type="hidden"  id="fp1"  required="required" name="partner[1][photo]" />
						            	</span>
							
						</td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[1][paddr]" required/></td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[1][poccupation]" pattern="[a-zA-Z_/.\s]+$" required/></td>
						<td ><input type="text" class="form-control text-uppercase"name="partner[1][pdesig]" pattern="[a-zA-Z_/.\s]+$" id=""required /></td>
						</tr>
						
				<?php  } ?>
				 <?php ?>
				         <tr id="sunil" colspan="6">&nbsp;</tr>
					</tbody>
				</table>	
				<table>
					<tr>
						<td><a class="memberBtn" jsTag="more1">Add More</a></td>
						
						<td>
						<input id="indexval_validation1" type="hidden" name="indexval_validation1" value="<?php echo $moreindex1; ?>">
						&nbsp;&nbsp;<td style="display:none;" id="del_last1"><a   class="memberBtn"  jsTag="deleteLast1">Delete</a></td>
                    </tr>
									
					</table>
				<tr>
				<td colspan="6">
				 <p> * The witness will be a person not member of this Society. He must be either a Local D.C., Addl. D.C., S.D.O. (sadar) or Circle Officer, BDO, Executive Magistrate,<br>* Atleast seven signatures are required</p>	
				</td>
				</tr>		
				</td></tr></table>
				<table>
                <tr>
                    <td>Date of Establishment:-</td>
                    <td><input type="text" class="date_picker form-control" name="est_date" readonly="readonly" value="<?php if(isset($est_date)){echo $est_date;} ?>" required /></td>
                    
                </tr>
                
                </table>
               	<div align="center">
								<a type="button" href="form2.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save2b" class="btn btn-success">Save and Next</button>
									</div>	    
				</form>
			</div>
			
				<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
	<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<table class="table-responsive">		
					<tr>
                    <td colspan="3">5. MEMBERSHIP: </td>
                     </tr>

                     <tr>
                      <td>(a) Qualification to become Members:- </td>
                       <td>
                          <textarea id="memb_qualifiction" name="memb_qualification" rows="5" cols="100" class="form-control text-uppercase" required><?php if(isset($mem_qualification)){echo $mem_qualification;} ?> </textarea></br>
                          </td>
                           
                         <td>(b) Subscription,Donation etc.:- </td>
                           <td>
                           <textarea id="sub_donation" name="sub_donation" rows="5" cols="100" class="form-control text-uppercase" required="required"><?php if(isset($mem_donation)){echo $mem_donation;} ?></textarea>
                                    </br>
                            </td>
                         </tr>
                          <tr>
                           <td>(c) Collection of Fund:- </td>
                            <td>
                                    <textarea id="fund_collection" name="fund_collection" rows="5" cols="100" class="form-control text-uppercase" required="required"><?php if(isset($mem_fund)){echo $mem_fund;} ?></textarea></br>
                           </td>
                           
                            <td>(d) Control of Fund:- </td>
                             <td>
                                    <textarea id="fund_control" name="fund_control" rows="5" cols="100" class="form-control text-uppercase" required="required"><?php if(isset($mem_fund_control)){echo $mem_fund_control;} ?></textarea></br>
                             </td>
                          </tr>
                       
                <tr>
                    <td>6. Procedure of the General Meeting: (How many times in a year the General Meeting will be held) </td>
                       <td> <textarea id="meeting_proc" name="meeting_proc" rows="5" cols="100" class="form-control text-uppercase" required="required"><?php if(isset($meeting_proc)){echo $meeting_proc;} ?></textarea></br>
                    </td>
               
                    <td>7. Quorum of the General Meeting:-</td><td>
                        <textarea id="meeting_quorum" name="meeting_quorum" rows="5" cols="100" class="form-control text-uppercase"  required="required"><?php if(isset($meeting_quorum)){echo $meeting_quorum;} ?></textarea></br>
                    </td>
                </tr>
                <tr>
                    <td>8. Election procedure of the Executive Committee/ Governing body/Managing Committee:-</td><td>
                        <textarea id="election_proc" name="election_proc" rows="5" cols="100" class="form-control text-uppercase"  required="required"><?php if(isset($election_proc)){echo $election_proc;} ?></textarea></br></br>                    
                    </td>
                
                    <td>9. Short description of the Executive body:-(This <br/>description must tally with the list given in the item 4 of Memorandum copy)</td><td>
                        <textarea id="executive_body" name="executive_body" rows="5" cols="100" class="form-control text-uppercase" required><?php if(isset($eb_desc)){echo $eb_desc;} ?></textarea></br></br>                  
                    </td>
                </tr>
                <tr>
                    <td>10. The term of the Executive body:</td><td>
                        <textarea id="executive_body_term" name="executive_body_term" rows="5" cols="100" class="form-control text-uppercase"  required="required"><?php if(isset($eb_term)){echo $eb_term;} ?></textarea> </br></br>                  
                    </td>
                
                    <td>11. Procedure of Re-election of the members of the Executive body:-</td><td>
                        <textarea id="executive_body_reelection" name="executive_body_reelection" rows="5" cols="100" class="form-control text-uppercase"  required="required" ><?php if(isset($reelect_proc)){echo $reelect_proc;} ?></textarea></br></br>                  
                    </td>
                </tr>
                <tr>
                    <td>12. Procedure of the meeting of the Executive body:-(How many times <br/>in a year or month the meeting of the Executive body will be held)
                    </td>
                    <td>
                        <textarea id="executive_body_proc" name="executive_body_proc" rows="5" cols="100" class="form-control text-uppercase"  required="required"><?php if(isset($eb_meeting)){echo $eb_meeting;} ?></textarea></br></br>
                    </td>
                
                    <td>13. Quorum of the meeting of the Executive body:- (How many of the members of the executive body requires to be present to form quorum of the meeting of the executive body)</td><td>
                        <input type="text" id="executive_body_quorum"  class="form-control text-uppercase"  name="executive_body_quorum" value="<?php if(isset($eb_quorum)){echo $eb_quorum;} ?>"  required="required"/>
                    </td>
                </tr>
                <tr>
                    <td>14. Expulsion of undesirable member:- Any member who goes against<br/> the Rules and Regulation of the organization may be expelled from the organization.</td>
					<td><input type="text" id="Expulsion_u_member"  class="form-control text-uppercase" name="Expulsion_u_member" value="<?php if(isset($mem_expulsion)){echo $mem_expulsion;} ?>"  required="required"/></td>
              
                    <td>15. Auditor: A qualified Auditor will be appointed by the Executive body who shall audit the accounts of the society at least once in a year and Annual Audit Report will be submitted to the Registrar of Societies Regulatory.</td>
					<td><input type="text" id="auditor_name" class="form-control text-uppercase" name="auditor_name" value="<?php if(isset($auditor)){echo $auditor;} ?>"  required="required"/></td>
                </tr>
                <tr>
                    <td>16. Legal Procedure:- According to the provision laid down <br/>in the section 6 of the societies Registration Act-XXI of 1980, the Society may sue or <br/>may be used in the name of the President and Secretary of the Society.</td>
					<td><input type="text" id="legel_procedure" class="form-control text-uppercase" name="legel_procedure" value="<?php if(isset($legal_proc)){echo $legal_proc;} ?>"  required="required"/></td>
					
               
                    <td>17. Dissolution:- If necessary, the Society may be dissolved<br/> and the properties remained after dissolution may be handed over according to the <br/>provision laid down in the Section 13 and 14 of the Societies Registration Act-XXI of 1860.</td>
                    <td>
					<input type="text" id="dissolution"  class="form-control text-uppercase" name="dissolution" value="<?php if(isset($dissolution)){echo $dissolution;} ?>"  required="required"/></td>
                </tr>
				
				
			<tr><td>	18. General Meeting </td></tr>

                <tr><td>Date of holding the meeting :</td>
                <td><input type="text" name="gm_meeting[dh]" class="date_picker form-control text-uppercase" value="<?php echo $gm_meeting_dh; ?>"  required /></td>
                <td>Place of meeting :</td>
                <td><input type="text" class="form-control text-uppercase"  name="gm_meeting[pm]" value="<?php echo $gm_meeting_pm; ?> " required /></td>
                </tr>
                <tr>
                <td>Number of public present:</td>
                <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="gm_meeting[np]" value="<?php echo $gm_meeting_np; ?>" required />
                </td>
                </tr>
               
                </table>		 
               	<div align="center">
								<a type="button" href="form2.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save2c" class="btn btn-success">Save and Next</button>
									</div>	    
				</form>
			</div>
			<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<table  id=""  class="table table-responsive" >										
								<tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
								<tr>
					<td width="50%"> 1. Scanned copy of Witness paper in Memorandum of Association at item no. 5:</td>
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
					<td>2. Photocopy of Registration Certificate </td>
      
					<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
					<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="B1"  class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>3. A notice is to be issued to all members of executive body to hold the meeting to get the certified copy of the documents of the society ten days before the proposed meeting . A copy of the same shall be sent to the Registrar:
					</td>
					<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
					<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="C1" class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>4.  2(two) sets of Memorandum of Association and Rules and Regulations of the society. 
					</td>
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
					<td>6. Treasury Challan</td>
					<td><select trigger="FileModal" class="file5" id="file5" <?php if($file6!="" || $file5=="SC" || $file5=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile5" value="<?php if($file5!="") echo $file5; ?>" id="mfile5" readonly="readonly"/></td>
					<td width="20%" id="mfile5-chiranjit"><?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					
				</tr>
				
				
				<tr>
					<td class="text-center" colspan="4">
						<a href="rfs_form7.php?tab=4" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success" name="submit2" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
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
          
				  
				 
		  
			    
		 <?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>
<?php require"../../../departments/rfs/includes/rfs_js.php";?>


<link rel="stylesheet" type="text/css" href="../crop_image/css/style.css" />
    <link rel="stylesheet" type="text/css" href="../crop_image/css/style-example.css" />
    <link rel="stylesheet" type="text/css" href="../crop_image/css/jquery.Jcrop.css" />

    <!-- Js files-->
    <script type="text/javascript" src="../crop_image/scripts/jquery-1.10.2.11min.js"></script>
    <script type="text/javascript" src="../crop_image/scripts/jquery.Jcrop.js"></script>
    <script type="text/javascript" src="../crop_image/scripts/jquery.SimpleCropper.js"></script>
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

/* ----------------------------------------------------- */
<?php 
$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
if($previous_details->num_rows>0){ ?>
	$('.class_disable').attr('disabled');
<?php } ?>		
</script>

        </body>
</html>
								 
								