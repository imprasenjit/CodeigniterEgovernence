<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('land','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=land';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=2&dept=land';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=1';</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_land_form.php";
	    
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$revenue=$row1['revenue'];$pattano=$row1['pattano'];$dagno=$row1['dagno'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$land->query("select * from land_form2 where user_id=$swr_id") or die($land->error);
	
	if($q->num_rows<1){	 
		$father_name="";$state="";$police_station="";$post_office="";$pattadar_name="";$pattadar_fname="";$is_ownership="";$area_land=""; $p_date="";$total_land="";$add_info="";$remarks="";
		
		$file1="";$file2="";$file3="";$file4="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];

		$father_name=$results["father_name"];$police_station=$results["police_station"];$post_office=$results["post_office"];$pattadar_name=$results["pattadar_name"];$pattadar_fname=$results["pattadar_fname"];$is_ownership=$results["is_ownership"];$area_land=$results["area_land"];$p_date=$results["p_date"];$total_land=$results["total_land"];$add_info=$results["add_info"];$remarks=$results["remarks"];

				
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		     }
	
		
	}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==3){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:block;'";$tabbtn3="active";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	 
	##PHP TAB management ends
	
?>
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
									<strong><?php echo $form_name=$cms->query("select form_name from land_form_names where form_no='2'")->fetch_object()->form_name; ?></strong>
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
								<form name="myform1" class="submit1" id="landComF2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td > Applicant&apos;s Name </td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $key_person; ?>"></td>
										<td> Mobile Number</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $mobile_no; ?>"></td>
									</tr>
								
									<tr>
										<td>Father&apos;s Name</td>
										<td><input type="text" validate="letters" name="father_name" class="form-control text-uppercase" required value="<?php echo $father_name; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4"><strong>Address Details</strong></td>
									</tr>
									<tr>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name2; ?>"></td>
									</tr>
									<tr>
									    <td>State</td>
									    <td><input type="text" name="state" class="form-control text-uppercase" disabled value="Assam" ></td>
									    <td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_dist; ?>" /></td>
									</tr>
									<tr>
										
										<td>Sub-Division</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_block; ?>" /></td>
										<td>Circle Office</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $revenue; ?>" /></td>
										
									</tr>
									<tr>
									    
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>"></td>
										<td>Police Station</td>
										<td><input type="text" name="police_station" class="form-control text-uppercase" required value="<?php echo $police_station; ?>"/> </td>
										
									</tr>
									<tr>
									    <td>Post Office</td>
										<td><input type="text" name="post_office" class="form-control text-uppercase" required value="<?php echo $post_office; ?>"/> </td>
									    <td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode; ?>"/> </td>
										
									</tr>									
									<tr>
										<td colspan="4"><strong>Other Details</strong></td>
									</tr>
									<tr>
										<td>Patta No</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $pattano; ?>"></td>
										<td>Dag No</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>"></td>
									</tr>
									<tr>
										<td>Pattadar Name</td>
										<td><input type="text" validate="letters" name="pattadar_name" class="form-control text-uppercase" required value="<?php echo $pattadar_name; ?>"></td>
										<td>Pattadar Father Name</td>
										<td><input type="text" validate="letters" name="pattadar_fname"class="form-control text-uppercase" required value="<?php echo $pattadar_fname; ?>"></td>
									</tr>
									<tr>
										<td>Ownership got through</td>
										<td colspan="3">
											<label class="radio-inline"><input type="radio" id="inlineRadio1" value="D" name="is_ownership" <?php if($is_ownership=='D') echo 'checked'; ?>> Deed Mutation (Gift/Sale/Others) </label>
											<label class="radio-inline"><input type="radio" id="inlineRadio1"  value="I" name="is_ownership" <?php if($is_ownership=='I' || $is_ownership=='') echo 'checked'; ?>> Inheritance Mutation </label>
										</td>
									</tr>									
									
									<tr>
										<td> Area of Land (in sq. meter)</td>
										<td><input type="text" class="form-control text-uppercase" name="area_land" validate="decimal" value="<?php echo $area_land; ?>"></td>
										<td>Date of Possession </td>
										<td><input type="text" id="dob" class="dob form-control " requried  name="p_date" value="<?php echo date('Y-m-d', strtotime($p_date)); ?>"></td>
									</tr>
									<tr>
										<td>Total land of Applicant<br/> (in sq. meter)</td>
										<td><input type="text" class="form-control text-uppercase" name="total_land" validate="decimal" value="<?php echo $total_land; ?>"></td>
										<td>Additional Information</td>
										<td><textarea class="form-control text-uppercase"  maxlength="255" validate="textarea"  name="add_info" required><?php echo $add_info; ?></textarea>255 Characters Only</td>
									</tr>
									<tr> 
										<td>Remarks</td>
										<td><textarea class="form-control text-uppercase" name="remarks"validate="textarea" required maxlength="255"><?php echo $remarks; ?></textarea>255 Characters Only</td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
									    <td>Date : <?php echo date('d-m-Y', strtotime($today)); ?><br/>
											Place : <?php echo strtoupper($dist); ?>
										</td>
										<td></td>
										<td></td>
										<td><label><?php echo strtoupper($key_person); ?></label><br/>Signature of the Applicant</td>
										
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save2" class="btn btn-success submit1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
        <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
        <form name="fileUpload" id="lc_reg2_upload" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
			<table id="" class="table table-responsive">	
				<tr>
					<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
				</tr>
				<?php if($is_ownership=="D"){ ?>
				<tr>
					<td width="40%">Affidavit (self-declaration) along with numbers of legal heir of the deceased.</td>
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
					<td>Upto date Khajana ( Land revenue) Receipt.</td>
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
                                            <?php if($file2!="" && $file2!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td>A Declaration as per Assam ceiling Act 1956 in Affidavit.</td>
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
					<td>Scan copy of filled up downloadable eForm with Court fee stamp.</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file4" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file4s); ?></option>
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
				<?php }else{ ?>
				<tr>
					<td width="40%">Affidavit (self-declaration) along with numbers of legal heir of the deceased and Legal heir Certificate</td>
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
					<td>Affidavit stating that “The land has not been sold or mortgage earlier”</td>
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
					<td>Upto date Khajana ( Land revenue) Receipt.</td>
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
					<td>Scan copy of filled up downloadable e-Form with Court fee stamp.</td>
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
				<?php } ?>
				
				<tr>
					<td class="text-center" colspan="5">
						<a href="land_form2.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>										
						<button type="submit" class="btn btn-success submit1" name="submit2" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
    
	var incd=<?php if(!empty($parties)) echo count($parties); else echo "1"; ?>;
    $('#add_pp_more').click(function(){		
		$('table[id="pp_more"] tr:last-of-type').after('<tr id="row'+incd+'"><td><div class="input-group"><input class="form-control text-uppercase" id="extrafield'+incd+'" type="text" class="added_input" pattern="[a-zA-Z\\s]+" name="parties[]"><div class="input-group-addon"><span onclick="removeRow('+incd+')" class="removeRow"><i style="cursor:pointer" class="fa fa-times" aria-hidden="true"></i></span></div></div></td></tr>');
		incd++;
    });
	function removeRow(value){
		$('tr[id="row'+value+'"]').remove();
	}
	$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab6"]').on('click', function(){
		$('#tab6').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab7"]').on('click', function(){
		$('#tab7').css('display', 'table');
		$('#tab1, #tab2, #tab3,  #tab4, #tab5, #tab6, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab8"]').on('click', function(){
		$('#tab8').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab9').css('display', 'none');
	});
	$('a[href="#tab9"]').on('click', function(){
		$('#tab9').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8').css('display', 'none');
	});
	/* ----------------------------------------------------- */
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
</script>
</body>
</html>