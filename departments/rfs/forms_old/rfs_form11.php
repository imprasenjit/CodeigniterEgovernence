<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('rfs','11');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=11&dept=rfs';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=11&dept=rfs';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_form_test.php";
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
		$q=$rfs->query("select * from rfs_form11 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();

		if($q->num_rows<1){	 ###EMPTY FORM DETAILS###
			$form_id="";$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";
		}else{		
			$form_id=$results['form_id'];$post_office=$results['post_office'];$police_station=$results['police_station'];$reg_date=$results['reg_date'];
			$reg_no=$results['reg_no'];		
			$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];	
			################Courier details#################	
		}
	}else{
		$form_id="";$post_office="";$police_station="";$reg_date="";$reg_no="";
		
		$q=$rfs->query("select * from rfs_form11 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();

		if($q->num_rows>0){		
			$form_id=$results['form_id'];$post_office=$results['post_office'];$police_station=$results['police_station'];$reg_date=$results['reg_date'];
			$reg_no=$results['reg_no'];	
			$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];
		}		
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
									<strong>Form No 7<br/><?php echo $form_name=$cms-> query("select form_name from rfs_form_names  where  form_no='11'")->fetch_object()->form_name; ?></strong>
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
							       <td class="25%">3. Date of Registration :</td>
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
				
					</tr>
					<tr>
					    <td>Mobile No. :</td>
					    <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
			
                  </tr>
				    <tr>
					   <td>Email ID :</td>
					  <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_email; ?>" ></td>
					
					   
					</tr>
			
					
					<tr>
					  <td class="text-center" colspan="4">				
					  <button type="submit" class="btn btn-success" name="save14" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
					  </td>
				   
				  </tr>

				  </table>			
				  </form>
				  </div>
			
						
						
	
			 <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
		    <form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
		    <tr>
			  <td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
			</tr>
					
			
		          <tr>
					<td width="50%">Registration Certificate:</td>
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
		    <td>An application for approval of amendment of Memorandum of Association and constitution of the society.  </td>
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
				 <td>A copy of notice regarding special meeting for the proposed amendments is to be issued to all members of the society  10 days before the special meeting:
						
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
					<td>The proposal amendments shall have to be agreed to by the votes of three-fifth of the members in proxy .</td>
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
					<td>The proposed amendments  shall have to be confirmed by votes of three-fifth of the members present at a second special meeting convened by the governing body at an interval of one month after the former meeting </td>
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
					 <td>Present Rules and Regulation of the society : </td>
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
					<td class="text-center" colspan="4">
						<a href="rfs_form11.php?tab=2" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success" name="submit11" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
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
								 
								