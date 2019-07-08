<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('land','4');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=land';
		</script>";	
} 
else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=4&dept=land';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=4';</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_land_form.php";

	    $email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$revenue=$row1['revenue'];$pattano=$row1['pattano'];$dagno=$row1['dagno'];$pan_no=$row1['pan_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
		$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		$q=$land->query("select * from land_form4 where user_id=$swr_id") or die($land->error);
		
		if($q->num_rows<1)////////for empty/////
		{	 
			$father_name="";$sp_name=""; $adhar_no="";$police_station="";$post_office="";$land_circle="";$land_mouza="";$revenue_vill="";$land_pattano="";$land_area=""; 
		
			$file1="";$file2="";$file3="";
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
		else////////////for Not empty///////
		{
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];

			$father_name=$results["father_name"];$sp_name=$results["sp_name"];$adhar_no=$results["adhar_no"];$police_station=$results["police_station"];$post_office=$results["post_office"];$land_circle=$results["land_circle"];$land_mouza=$results["land_mouza"];$revenue_vill=$results["revenue_vill"];$land_pattano=$results["land_pattano"];$land_area=$results["land_area"];

                    
			$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];
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
									<strong><?php echo $form_name=$cms->query("select form_name from land_form_names where form_no='4'")->fetch_object()->form_name; ?></strong>
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
								<form name="myform1" id="landComF2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
								    <tr>
										<td colspan="4"><strong>Applicant&apos;s Details</strong></td>
									</tr>
									<tr>
										<td > Applicant&apos;s Name </td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $key_person; ?>"></td>
										<td> Mobile Number</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Father&apos;s Name</td>
										<td><input type="text" validate="letters" name="father_name" class="form-control text-uppercase" required value="<?php echo $father_name; ?>"></td>
										<td>Spouse Name</td>
										<td><input type="text" validate="letters" name="sp_name" class="form-control text-uppercase" required value="<?php echo $sp_name; ?>"></td>
									</tr>
									<tr>
										<td>Mail Id</td>
										<td><input type="text" class="form-control " disabled value="<?php echo $email; ?>"></td>
										<td>Pan Number</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $pan_no; ?>"></td>
									</tr>
									<tr>
										<td>Aadhar card Number</td>
										<td><input type="text" name="adhar_no" class="form-control text-uppercase"  value="<?php echo $adhar_no; ?>"></td>
									</tr>
									<tr>
										<td colspan="4"><strong>Enterprise's Address</strong></td>
									</tr>
									<tr>
									    <td>Street Name1</td>
									    <td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1; ?>" ></td>
									    <td>Street Name2</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_street_name2; ?>" /></td>
									</tr>
									<tr>
									    <td>State</td>
									    <td><input type="text"  class="form-control text-uppercase" disabled value="Assam" ></td>
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
										<td colspan="4"><strong>Land Details</strong></td>
									</tr>
									<tr>
										<td>Circle Name (of land)</td>
										<td><input type="text" required name="land_circle" class="form-control text-uppercase" value="<?php echo $land_circle; ?>"></td>
										<td>Mouza (of land)</td>
										<td><input type="text" required name="land_mouza" class="form-control text-uppercase"  value="<?php echo $land_mouza; ?>"></td>
									</tr>
									<tr>
										<td>Revenue Village/Town</td>
										<td><input type="text" required name="revenue_vill" class="form-control text-uppercase"  value="<?php echo $revenue_vill; ?>"></td>
										<td>Patta No</td>
										<td><input type="text" required name="land_pattano"class="form-control text-uppercase" r value="<?php echo $land_pattano; ?>"></td>
									</tr>
									<tr>
										<td>Area of Land</td>
										<td><input type="text" required name="land_area"class="form-control text-uppercase"  value="<?php echo $land_area; ?>"></td>
										<td></td>
										<td></td>

									</tr>									
									
									
									<tr>
									    <td>Date<br/><label><?php echo date('d-m-Y', strtotime($today)); ?></label>
										</td>
										<td></td>
										<td></td>
										<td >Signature of the Applicant<br/>
										<label><?php echo strtoupper($key_person); ?></label></td>
										
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save4" class="btn btn-success submit1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
				<tr>
					<td width="50%">Up to date Land Revenue Receipt (Khajana Receipt).</td>
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
					<td>Copy of Land deed.</td>
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
					<td>Any other Document.</td>
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
					<td class="text-center" colspan="5">
						<a href="land_form2.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>										
						<button type="submit" class="btn btn-success submit1" name="submit4" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	/* ---------------------upload S/C click operation-------------------- */
	
	
	/* ------------------------------------------------------ */
</script>
</body>
</html>