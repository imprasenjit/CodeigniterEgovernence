<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('land','5');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=land';
		</script>";	
} 
else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=5&dept=land';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=5';</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_land_form.php";
	    
		$row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$pan_no=$row1['pan_no'];$revenue=$row1['revenue'];$mouza=$row1['mouza'];$pattano=$row1['pattano'];$unit_name=$row1['Name'];$dagno=$row1['dagno'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
		$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		$father_name="";$adhar_crd="";$name_seller="";$adhar_crd="";$gp="";$name_intender="";$buyer="";$sold_village="";$sold_mouza="";$sold_patta="";$sold_dag="";$sold_area="";$sold_class="";$purpose_sale="";$rate_biga="";$total_value="";	
		$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";$area_land="";
		$q=$land->query("select * from land_form5 where user_id='$swr_id' and active='1'") or die($land->error);
		
		if($q->num_rows<1){	
            $father_name ="";$adhar_crd ="";$name_seller = ""; $name_intender ="";
			$buyer ="";$sold_village ="";$sold_mouza ="";$sold_patta ="";$sold_dag ="";
			$sold_area ="";$sold_class ="";$purpose_sale ="";$rate_biga ="";$total_value ="";$file1 ="";$file2 ="";$file3 ="";$file4 ="";$file5 ="";$file6 ="";$file7 ="";$file8 ="";$file9 ="";$file10 ="";	
		}else{
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];	
			$father_name=$results["father_name"];$adhar_crd=$results["adhar_crd"];$name_seller=$results["name_seller"];$adhar_crd=$results["adhar_crd"];$gp=$results["gp"];$name_intender=$results["name_intender"];$buyer=$results["buyer"];$sold_village=$results["sold_village"];$sold_mouza=$results["sold_mouza"];$sold_patta=$results["sold_patta"];$sold_dag=$results["sold_dag"];$sold_area=$results["sold_area"];$sold_class=$results["sold_class"];$purpose_sale=$results["purpose_sale"];$rate_biga=$results["rate_biga"];$total_value=$results["total_value"];$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];$file10=$results["file10"];
		}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";
	if($showtab=="" || $showtab<2 || $showtab>3 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";
	}
	if($showtab==3){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:block;'";$tabbtn3="active";
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
									<strong><?php echo $form_name=$cms->query("select form_name from land_form_names where form_no='5'")->fetch_object()->form_name; ?></strong>
								</h4>		
							</div> 
							<div class="panel-body">
							<ul class="nav nav-pills">
							   <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
							    <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
							    <li class="<?php echo $tabbtn3; ?>"><a href="#table3">Upload Section</a></li>
							</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="landComF2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
								<tr>
                                       <td><b>Applicant&apos;s Details</b>
                                    </td>
                                    </tr>
									<tr>
										<td > Applicant&apos;s Name </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
										<td> Mobile Number</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
									</tr>
								<tr>
										<td>Name of Seller/Donor/Lessee</td>
										<td><input type="text" class="form-control text-uppercase"  name="name_seller" validate="letters" required value="<?php echo $name_seller;?>"></td>
										
									
										<td>Father&apos;s Name</td>
										<td><input type="text" class="form-control text-uppercase"  name="father_name" validate="letters" required value="<?php echo $father_name;?>"></td>
										</tr>
									<tr>
										<td>Mail Id </td>
										<td><input type="text" class="form-control"  disabled="disabled" required value="<?php echo $b_email; ?>"></td>
									
										<td>Pan Number</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" required value="<?php echo $pan_no;?>"></td>
										</tr>
									<tr>
										<td>Aadhar card Number </td>
										<td><input type="text" class="form-control text-uppercase" name="adhar_crd" required value="<?php echo $adhar_crd;?>"></td>
									</tr>
									<tr>
										<td colspan="4"><b>Address Details</b></td>
									</tr>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>"></td>
									</tr>
									<tr>
									    <td>State</td>
									    <td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="ASSAM" /></td>
									    <td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_dist; ?>" /></td>
									</tr>
									<tr>
									    <td>Sub-division</td>
									    <td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_block; ?>" /></td>
									    <td>Circle office</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $revenue; ?>" /></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>"></td>		
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"/> </td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td>Mouza </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mouza; ?>"></td>
										<td>Ward </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block; ?>"></td>
									</tr>										
									<tr>
										
										<td>GP(Gaon Panchayat)</td>
										<td><input type="text" class="form-control text-uppercase" name="gp" value="<?php echo $gp;?>"></td>
									</tr>					 					
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save5a" class="btn btn-success submit1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="landComF2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">				 					
									<tr>
										<td colspan="4"><b>Other Details</b></td>
										<tr>
										<td>Name of Intending Buyer/Receiver</td>
										<td><input type="text" class="form-control text-uppercase"  name="name_intender" validate="specialChar" required  value="<?php echo $name_intender;?>"></td>
										
									
										<td>Buyer/Doner Father Name</td>
										<td><input type="text" class="form-control text-uppercase"  name="buyer" validate="specialChar" required value="<?php echo $buyer;?>"></td>
										</tr>
									</tr>
									    <td>Sold land village/ward</td>
										<td><input type="text" class="form-control text-uppercase" name="sold_village"  value="<?php echo $sold_village?>"></td>
										<td>Sold land mouza</td>
										<td><input type="text" class="form-control text-uppercase" name="sold_mouza" value="<?php echo $sold_mouza;?>"></td>
									</tr>
									<tr>
									    <td>Sold land patta</td>
									    <td><input type="text" class="form-control text-uppercase" name="sold_patta"  value="<?php echo $sold_patta;?>" /></td>
									    <td>Sold land dag no.</td>
										<td><input type="text" class="form-control text-uppercase" name="sold_dag"  value="<?php echo $sold_dag;?>" /></td>
									</tr>
									<tr>
									    <td>Sold land Area</td>
									    <td><input type="text" class="form-control text-uppercase" name="sold_area"  value="<?php echo $sold_area;?>" /></td>
									    <td>Sold land class</td>
										<td><input type="text" class="form-control text-uppercase"  name="sold_class" value="<?php echo $sold_class;?>" /></td>
									</tr>
									<tr>
										<td>Purpose of sale/Transfer of land</td>
										<td><input type="text" class="form-control text-uppercase" name="purpose_sale" value="<?php echo $purpose_sale;?>"></td>
										<td>Rate per bigha</td>
										<td><input type="text" class="form-control text-uppercase" name="rate_biga" value="<?php echo $rate_biga;?>"/> </td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td>Total value of land proposed to be sold </td>
										<td><input type="text" class="form-control text-uppercase" name="total_value" value="<?php echo $total_value;?>"></td>	
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
										<a href="land_form5.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>
											<button type="submit" name="save5b" class="btn btn-success submit1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
        <div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
        <form name="fileUpload" id="lc_reg2_upload" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
			<table id="" class="table table-responsive">	
				<tr>
					<td colspan="5"><b>Documents to be enclosed</b> <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
				</tr>
				<tr>
					<td width="50%">1. Affidavit of seller and purchaser in prescribed format..</td>
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
					<td>2. Passport size photograph of Seller.</td>
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
					<td>3. Passport size photograph of Purchaser.</td>
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
					<td>4. NOC from co-pattadars along with signed copy Photo ID proof.</td>
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
					<td>5. Certified copy of Jamabandi.</td>
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
					<td>6. Copy of Chitha of concerned Dag in case if share of seller is not mentioned.</td>
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
					<td>7. Up to date Land Revenue Receipt.</td>
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
					<td>8. Certified copy of Electoral Roll with linkage document.</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file8" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file8); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile8" id="mfile8" value="<?php echo $file8 !== '' ? $file1 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile8">
                                            <?php if($file8!="" && $file8!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td>9. Trace Map.</td>
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
					<td>10. Signed photocopy of expectant of Power of Attorney wherever Power of Attorney is submitted.</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file10" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file10); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile10" id="mfile10" value="<?php echo $file10 !== '' ? $file10 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile10">
                                            <?php if($file10!="" && $file10!="SC" && $file10!="NA"){ echo '<a href="'.$upload.$file10.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>

				
				
				<tr>
					<td class="text-center" colspan="5">
						<a href="land_form5.php?tab=2"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>										
						<button type="submit" class="btn btn-success submit1" name="submit5" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	
	/* ---------------------upload S/C click operation-------------------- */
	

	/* ------------------------------------------------------ */
</script>
</body>
</html>