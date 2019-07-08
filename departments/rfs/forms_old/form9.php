<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('society','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=society';
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
	
	$q=$society->query("select * from society_form1 where user_id='$swr_id' and active='1'");
	$results=$q->fetch_assoc();

	if($q->num_rows<1){	 ###EMPTY FORM DETAILS###
		$form_id="";
		$s_po="";$s_ps="";$s_con="";$proposed_area="";$s_obj="";
	}else{
		$form_id=$results['form_id'];
		$s_po=$results['s_po'];$s_ps=$results['s_ps'];$s_con=$results['s_con'];$proposed_area=$results['proposed_area'];$s_obj=$results['s_obj'];		
	}
	$q1=$society->query("select * from society_form1_members where form_id='$form_id'");
	$results1=$q1->fetch_assoc();
	if($q1->num_rows<1){
		$form_id="";
		$member_address="";$member_age="";$member_phone="";$member_signature="";
	}
	else{
		$form_id=$results1['form_id'];
		$member_address=$results1['member_address'];$member_age=$results1['member_age'];$member_phone=$results1['member_phone'];$member_signature=$results1['member_signature'];
	}
	
	##PHP TAB management	
   if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	$tabbtn1="";$tabbtn2="";
	if($showtab=="" || $showtab<1 || $showtab>2|| is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";
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
									<strong>Form No 2<br/><?php echo $form_name=$cms-> query("select form_name from rfs_form_names  where  form_no='9'")->fetch_object()->form_name; ?></strong>
								</h4>	
							    </div>
							<div class="panel-body">
							<ul class="nav nav-pills">
									  <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">DETAILS OF THE SOCIETY</a></li>
									   <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">UPLOAD</a></li>
									  
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
				
					   
						   <td> Locality : </td><td><input type="text"  class="form-control text-uppercase"  value="<?php echo 	$b_street_name2; ?>" ></td>
				
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
					
					</tr> 
				   	 
                
                  <tr>
					  <td class="text-center" colspan="4">				
					  <button type="submit" class="btn btn-success" name="save12" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
					  </td>
				   
				   </tr>
				  

				  </table>			
				  </form>
				  </div>
				  <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
		   <form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
             <tr>
			    <td colspan="4">6. A list of members of the Executive Committee with their full name(in block letter),address and occupation:</td>
			   </tr>
            <tr>
			<table id=""  class="table table-responsive">
				     <thead>
						    <td>S.NO</td>
						    <td>Name</td>
						 
						    <td>Address</td>
							<td>Occupation</td>
							<td>Designation</td>
					</thead>
					<tbody>
					
				<?php
				if($memberCount>0){
					
                   
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
						 <tr>
									   <td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#" onclick="mydelfunction4()" value="">Delete</button>
											 <button type="button"  class="btn btn-default pull-right" onclick="addmore()" value="">Add More</button>	
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</td>
									</tr>	
									
					</table>
			<tr>
			<td>
			<b>7.A statement showing the details of grant receipt from Central Government and other agencies during the preceding 3 years from the date of renewal application.</b></td></tr>
			<tr>
				<td colspan="3">
				<table id="" class="text-center table table-responsive table-bordered">
		
			      <thead>
						<tr>
							<td>Sanction letter no. and date</td>
							<td> Name of the Scheme</td>
							<td> Objectives of the Scheme</td>
							<td>Fund realising authority</td>
							<td>Opening Balance</td>
							<td>Amount sanctioned during the year</td>
							<td>Amount released during the preceding 3 years</td>
							<td>Total available fund</td>
							<td>Total expenditure incurred during the preceding 3 years</td>
							<td>Remarks</td>
							
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
           
  
                           <div align="center">
								<a type="button" href="form2.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save2b" class="btn btn-success">Save and Next</button>
	     </div>	  	
		 </form>
		 </div>
		 <div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			            <table  id=""  class="table table-responsive" >
				             <tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
					
			
		     <tr>
					<td width="50%"> 1. Registration Certificate:</td>
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
		    <td>2. Copy of the Resolution of the General Body meeting for renewal of the society and signature of all the members present in the meeting
		    </td>
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
				 <td>3. Certificate of authentication signed by three members  of the outgoing executive members
						
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
					<td>4.Copy of resolution of the AGM for the above mentioned information at Item No. 1,10 & 11 is submitted within 14 days from the date of Annual General Meeting (AGM)of the society.</td>
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
					<td>5. Latest Annual Balance Sheet from C.A. </td>
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
					<td>6. Latest Audit Report from C.A.</td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file6" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file6" name="D1" <?php if($file6=="NA") echo "checked"; ?> <?php if($file6!="" && $file6!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file6 cd" name="D2" <?php if($file6=="SC") echo "checked"; ?> <?php if($file6!="" && $file6!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>7.Utilisation Certificate of fund from Govt./Semi Govt./any institution :</td>
					<td><select trigger="FileModal" class="file7" id="file7" <?php if($file7!="" || $file7=="SC" || $file7=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file7!="") echo $file7; ?>" id="mfile7" readonly="readonly"/></td>
					<td width="20%" id="mfile7-chiranjit"><?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file7" name="D1" <?php if($file7=="NA") echo "checked"; ?> <?php if($file7!="" && $file7!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file7 cd" name="D2" <?php if($file7=="SC") echo "checked"; ?> <?php if($file7!="" && $file7!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>8.Utilisation Certificate of fund (with proof)Proof certificate of the amount apend from total amount: </td>
					<td><select trigger="FileModal" class="file8" id="file8" <?php if($file8!="" || $file8=="SC" || $file8=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile8" value="<?php if($file8!="") echo $file8; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file8" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file8" name="D1" <?php if($file8=="NA") echo "checked"; ?> <?php if($file8!="" && $file8!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file8 cd" name="D2" <?php if($file8=="SC") echo "checked"; ?> <?php if($file8!="" && $file8!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>9.All the new executive members in the presence of DC/ADC/SDO/RCO/Executive Magistrate/BDO of the concerned district/Sub-division/Revenue Circle who has signed on the paper with full name in Block letter,date and designation in token of his/her having witnessed the same. : </td>
					<td><select trigger="FileModal" class="file9" id="file9" <?php if($file9!="" || $file9=="SC" || $file9=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile9" value="<?php if($file9!="") echo $file9; ?>" id="mfile9" readonly="readonly"/></td>
					<td width="20%" id="mfile9-chiranjit"><?php if($file9!="" && $file9!="SC" && $file9!="NA"){ echo '<a href="'.$upload.$file9.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file9 onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file9" name="D1" <?php if($file9=="NA") echo "checked"; ?> <?php if($file9!="" && $file9!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file9 cd" name="D2" <?php if($file9=="SC") echo "checked"; ?> <?php if($file9!="" && $file9!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>10.Activity Report of the society for the last three year from the date of renewal obtain from the DC/SDO of the concerned district/Sub Division : </td>
					<td><select trigger="FileModal" class="file10" id="file10" <?php if($file10!="" || $file10=="SC" || $file10=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile10" value="<?php if($file6!="") echo $file10; ?>" id="mfile10" readonly="readonly"/></td>
					<td width="20%" id="mfile10-chiranjit"><?php if($file10!="" && $file10!="SC" && $file10!="NA"){ echo '<a href="'.$upload.$file10.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file10" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file10" name="D1" <?php if($file10=="NA") echo "checked"; ?> <?php if($file10!="" && $file10!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file10 cd" name="D2" <?php if($file10=="SC") echo "checked"; ?> <?php if($file10!="" && $file10!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>11.Bank Pass Book : </td>
					<td><select trigger="FileModal" class="file11" id="file11" <?php if($file11!="" || $file11=="SC" || $file11=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile11" value="<?php if($file11!="") echo $file11; ?>" id="mfile11" readonly="readonly"/></td>
					<td width="20%" id="mfile11-chiranjit"><?php if($file11!="" && $file11!="SC" && $file11!="NA"){ echo '<a href="'.$upload.$file11.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file11" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file11" name="D1" <?php if($file11=="NA") echo "checked"; ?> <?php if($file11!="" && $file11!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file11 cd" name="D2" <?php if($file11=="SC") echo "checked"; ?> <?php if($file11!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
				<td>12.Land document of the office of the society.If not Land Agreement/Affidavit from the house owner  : </td>
					<td><select trigger="FileModal" class="file12" id="file12" <?php if($file12!="" || $file12=="SC" || $file12=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile12" value="<?php if($file12!="") echo $file12; ?>" id="mfile12" readonly="readonly"/></td>
					<td width="20%" id="mfile12-chiranjit"><?php if($file12!="" && $file12!="SC" && $file12!="NA"){ echo '<a href="'.$upload.$file12.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file12" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file12" name="D1" <?php if($file12=="NA") echo "checked"; ?> <?php if($file12!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file12 cd" name="D2" <?php if($file12=="SC") echo "checked"; ?> <?php if($file12!="" && $file12!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
		      
				<tr>
				<td>13.An affidavit regarding non-violation of section 4 and 4(A)(1),4(A)2 4(B)(1) under S.R. Act XXI of 1860  : </td>
					<td><select trigger="FileModal" class="file13" id="file13" <?php if($file13!="" || $file13="SC" || $file13=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile13" value="<?php if($file13!="") echo $file13; ?>" id="mfile13" readonly="readonly"/></td>
					<td width="20%" id="mfile13-chiranjit"><?php if($file13!="" && $file13!="SC" && $file13!="NA"){ echo '<a href="'.$upload.$file13.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file13" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file13" name="D1" <?php if($file13=="NA") echo "checked"; ?> <?php if($file13!="" && $file13!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file13 cd" name="D2" <?php if($file13=="SC") echo "checked"; ?> <?php if($file13!="" && $file13!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				

		     <tr>
					<td class="text-center" colspan="4">
						<a href="form9.php?tab=4" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success" name="submit2" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
					</td>
					</tr>
		  </form>
		  </div>
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
<?php require 'rfs_js.php'; ?>

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
								 
								