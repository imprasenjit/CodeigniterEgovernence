<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('clm','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=clm';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=clm';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
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
	
	$q=$clm->query("select * from clm_form1 where user_id='$swr_id'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$nature="";$monogram="";$tools="";$workshop="";$facilities="";$elect_energy="";$is_loan_detail="";$bankers="";$reg_number="";$is_applied="";$is_applied_details="";$is_proposed="";$approval="";$inspection="";
		$fact_reg_date="";$fact_reg_no="";
		$type_weight="";$type_measures="";$type_instrument="";$type_details="";
		$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	else{
		$form_id=$results['form_id'];	
		$nature=$results['nature'];$monogram=$results['monogram'];$tools=$results['tools'];$workshop=$results['workshop'];$facilities =$results['facilities'];$elect_energy =$results['elect_energy'];$is_loan_detail =$results['is_loan_detail'];$reg_number =$results['reg_number'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];$is_proposed =$results['is_proposed'];$approval =$results['approval'];$inspection =$results['inspection'];$bankers =$results['bankers'];
		if(!empty($results["fact"]))
		{
			$fact=json_decode($results["fact"]);
			$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
		}else{
			$fact_reg_date="";$fact_reg_no="";
		}
		if(!empty($results["type"]))
		{
			$type=json_decode($results["type"]);
			$type_weight=$type->weight;$type_measures=$type->measures;$type_instrument=$type->instrument;$type_details=$type->details;
		}else{
			$type_weight="";$type_measures="";$type_instrument="";$type_details="";
		}	
		if(!empty($results["persons"]))
		{
			$persons=json_decode($results["persons"]);
			$persons_skill=$persons->skill;$persons_semi_skill=$persons->semi_skill;$persons_unskill=$persons->unskill;$persons_trained=$persons->trained;
		}else{
			$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
		}		
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}

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
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
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
									
									<strong>Pollution Control Board, Assam

										Head Office/ Regional Office......................<br/>INSPECTION REPORT OF INDUSTRIES/ UNITS<br/><?php echo $form_name=$formFunctions->get_formName('clm','1'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									
									<tr>
										<td colspan="4">1. Name and complete postal address of the industry : </td>					
									</tr>
									<tr>
										<td colspan="4">(a) Name of the industry :</td>
                                   <td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name;?>"></td>										
									</tr>
									<tr>
										<td colspan="4">(b) Postal address of the industry: </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
									</tr>	
									
									<tr>
										<td colspan="4">2. Contact person with Tel/ Fax/ E-mail:</td>					
									</tr>
									<tr>
										
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" required="required" value="<?php echo $b_mobile_no;?>"></td>
				
										<td>Fax</td>
										<td><input type="number" class="form-control text-uppercase" required="required" value="<?php echo $b_mobile_no;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" required="required" value="<?php echo $b_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>3. Date of visit:</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase"  value="<?php echo $date_of_commencement;?>"></td>
										
									</tr>
									<tr>
										<td >4.Name of official visiting the Unit:</td>
										<td><input type="text" class="form-control" required="required" value="<?php echo $b_email;?>"></td>
									</tr>
									<tr>
										<td colspan="3">5. Information about the Unit:</td>
									</tr>
		
									<tr>
										<td colspan="4"> 5.1 Source of Water</td>					
									</tr>
									<tr>
										<td width="25%">a)Drinking</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">b)Other uses</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>5.2 Details of raw materials used</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_vill;?>"></td>
										<td>5.3 Details of products with capacity</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>5.4 Details designed capacity</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_pincode;?>"></td>
										<td>5.5 About manufacturing process</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_mobile_no;?>"></td>
									</tr>	
									<tr>
										<td colspan="4"> 6. Water Consumption:</td>					
									</tr>
									<tr>
										<td width="25%">6.1 Quantity of effluent treated and disposed</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">6.2 Details of outfall point</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>6.3 Details of receiving source</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_vill;?>"></td>
										<td>6.4 Status of ETP</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>6.5 Name of treatment units in the system</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_pincode;?>"></td>
										<td>6.6 Adequacy of ETP (Adequate / Not Adequate)</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_mobile_no;?>"></td>
									</tr>	
									<tr>
										<td>6.7 Operational status of ETP</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_vill;?>"></td>
										<td>6.8 Status of Consent order under Water Act, 1974</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td colspan="4"> 7.0 Status of Emission Control System (ECS):</td>					
									</tr>
									<tr>
										<td width="25%">7.1 Name and functioning of emission control system (ECS)</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">7.2 Provision for Stack Monitoring arrangement</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>7.3 Adequacy of the ECS (Adequate/Not adequate)</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_vill;?>"></td>
										<td>7.4 Operational Status</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>7.5 Status of Consent under Air Act,1981</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_pincode;?>"></td>
									</tr>
									<tr>
										<td colspan="4"> 8.0 Hazardous Waste Disposal:</td>					
									</tr>
									<tr>
										<td width="25%">8.1 Daily generation, treatment,storage facilities & recovery</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">8.2 Type of Disposal facility</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>8.3 Status of Authorization under the Hazardous waste (Management & Handling) Rule, 1989</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_vill;?>"></td>
										<td>8.4 Status of On-site Emergency Plan & its submission to PCBA</td>
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>8.5 Status of Safety Report</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_pincode;?>"></td>
										<td>8.6 Implementation of Public Liability Insurance Act. </td>           
										<td><input type="text" class="form-control text-uppercase"  value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>9. Applicability of Bio-Medical Waste Rules, 1998</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_pincode;?>"></td>
									</tr>
									<tr>
										<td>10. Status of Water Cess Act:</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_pincode;?>"></td>
									</tr>
									<tr>
										<td>11. Overall observation:</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_pincode;?>"></td>
									</tr>
								<tr>
										<td>12. Recommendations in respect of specific actions to be taken by PCBA against the Unit in regard to Pollution Control measures mentioned above:</td>
										<td><input type="number" class="form-control text-uppercase" value="<?php echo $b_pincode;?>"></td>
									</tr>
								<tr>
									<td>Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
									   Place: <label><?php echo strtoupper($dist); ?></label></td>
									<td></td>
									<td></td>
									<td align="right"><label>Signature: <?php echo strtoupper($key_person) ?></label><br/><label>Designation: <?php echo strtoupper($status_applicant) ?></label></td>
								</tr>
								
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	<?php if($is_applied=="N"){ ?>
	$('#is_applied_details').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_applied"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_applied_details').attr('disabled', 'disabled');
		else
			$('#is_applied_details').removeAttr('disabled');
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>