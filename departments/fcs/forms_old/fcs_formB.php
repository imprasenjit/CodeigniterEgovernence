<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('fcs','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=fcs';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=2&dept=fcs';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=2';</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
 
include "save_form.php";
$email=$formFunctions->get_usermail($swr_id);
$row1=$formFunctions->fetch_swr($swr_id);

$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];

$from=$key_person."<br/>Designation : ".$status_applicant."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$landline_std."-".$landline_no."<br/>E-mail ID : ".$email;

$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
$q=$fcs->query("select * from fcs_form2 where user_id='$swr_id' and active='1'") or die("Error :".$fcs->error);
$results=$q->fetch_assoc();
if($q->num_rows<1){	 
	$stock_point="";$lice_type="";
	$supplier_n="";$supplier_s1="";$supplier_s2="";$supplier_d="";$supplier_v="";$supplier_p="";$supplier_mno="";$supplier_s1="";
	
}else{
	$form_id=$results['form_id'];
	$stock_point=$results['stock_point'];$lice_type=$results['lice_type'];
	if(!empty($results["supplier"])){
		$supplier=json_decode($results["supplier"]);
		$supplier_n=$supplier->n;$supplier_s1=$supplier->s1;$supplier_s2=$supplier->s2;$supplier_d=$supplier->d;$supplier_v=$supplier->v;$supplier_p=$supplier->p;$supplier_mno=$supplier->mno;
	}else{
		$supplier_n="";$supplier_s1="";$supplier_s2="";$supplier_d="";$supplier_v="";$supplier_p="";$supplier_mno="";$supplier_s1="";
	}
}

##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName('fcs','2');?></strong>
								</h4>	
							</div>
						   <div class="panel-body">
							<div class="tab-content">
							<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
							<form name="myform2" class="submit1" id="myform2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							
							<table  class="table table-responsive">	
								<tr>
									<td width="25%">1. FULL NAME OF THE APPLICANT :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									<td width="25%"></td>
									<td width="25%"></td>
								</tr>
								<tr>
									     <td colspan="4"> 2. ADDRESS IN FULL :</td>
								</tr>
								<tr>
									<td>Street name 1 :</td>
									<td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									<td>Street name 2 :</td>
									<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
								    <td>Village/Town :</td>
								    <td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
								    <td>District :</td>
								    <td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
								    <td>Pin code :</td>
								    <td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
								    <td>Mobile No. :</td>
								    <td><input  type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id:</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
                                    <td colspan="4">3. LOCATION OF THE PLACE (S) OF  BUSINESS/ADDRESS :</td>
								</tr>
								<tr>
									<td width="25%">Street Name1 :</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
									<td width="25%">Street Name2:</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_street_name2; ?>"></td>
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_vill; ?>"></td>
									<td>District :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_dist; ?>"></td>
								</tr>
								<tr>
									<td>Pin Code :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_pincode; ?>"></td>
									<td>Mobile No:</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$b_mobile_no; ?>"></td>
								</tr>
								<tr>
								   <td>4. NAME OF COMPANY/ COMPANIES WHOSE PRODUCT IS BEING TRADE :</td>
								   <td><input type="text" disabled name="unit_name" value="<?php echo $unit_name; ?>" 	class="form-control text-uppercase"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="4">5. NAME OF SUPPLIER AND ADDRESS IN FULL :</td>
								</tr>
								<tr>								
									<td>Name :</td>
									<td><input type="text" class="form-control text-uppercase" name="supplier[n]" value="<?php echo $supplier_n; ?>"  required="required"/></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>								
									<td>Street Name 1:</td>
									<td><input type="text" class="form-control text-uppercase" name="supplier[s1]" value="<?php echo $supplier_s1; ?>"  required="required"/></td>
									<td>Street Name 2 :</td>
									<td><input type="text" class="form-control text-uppercase" name="supplier[s2]" value="<?php echo $supplier_s2; ?>"  required="required"></td>
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" class="form-control text-uppercase" name="supplier[v]" value="<?php echo $supplier_v; ?>"  required="required"></td>
									<td>District :</td>
									<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
									   <select name="supplier[d]" id="supplier_d" required class="form-control text-uppercase">
									   <option value="">Choose a district</option>
									   <?php
											  while($dstrows=$dstresult->fetch_object()) { 
											 if($supplier_d==$dstrows->district) $s='selected'; else $s=''; ?>
											  <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
										<?php } ?>					
									</select></td>
								</tr>
								<tr>
									<td>Pin Code :</td>
									<td><input type="text" class="form-control text-uppercase" required name="supplier[p]" validate="pincode" maxlength="6" value="<?php echo $supplier_p; ?>"></td>
									<td>Mobile No. :</td>
									<td><input type="text" class="form-control text-uppercase" required="required" name="supplier[mno]" validate="onlyNumbers" maxlength="10" value="<?php echo $supplier_mno; ?>"></td>
								</tr>
								<tr>
									<td> MENTION HERE THE NAME OF THE STOCK POINT :</td>
									<td><input type="text" class="form-control text-uppercase" required name="stock_point"  value="<?php echo $stock_point; ?>"></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
								   <td>6. LICENCE TYPE :</td>
								   <td colspan="2"><label class="radio-inline"><input type="radio" name="lice_type" value="NL"  <?php if(isset($lice_type) && $lice_type=='NL' || $lice_type=='') echo 'checked'; ?> /> NEW LICENCE</label>&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="lice_type" value="R"  <?php if(isset($lice_type) && $lice_type=='R') echo 'checked'; ?> /> RENEWAL</label>&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="lice_type" value="O"  <?php if(isset($lice_type) && $lice_type=='O') echo 'checked'; ?> /> Other Type</label></td>		   
								   <td><input type="text" name="lice_type_other" class="form-control text-uppercase"  placeholder="Other Type"   value="<?php if(isset($lice_type) && $lice_type!='R' && $lice_type!='NL' && $lice_type!='') echo $lice_type; ?>"></td>			   
								</tr>
									<tr >
									   <td>Date:</td>
									   <td class="text-uppercase"><strong><?php echo date('d-m-Y',strtotime($today));?></strong></td>
									   <td>Signature of the Authorised Signatory:</td>
									   <td class="text-uppercase"><strong><?php echo $key_person; ?></strong></td>
									</tr>
									<tr >
									   <td>Place:</td>
										<td class="text-uppercase"><strong><?php echo $dist; ?></strong></td>
									   <td>&nbsp;</td>
									   <td >&nbsp;</td>
									</tr>
									<tr>
									    <td class="text-center" colspan="4">
											<button type="submit" name="save2" class="btn btn-success submit1">Save & Next </button>
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
	$('#resid').hide();
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	$('input[name="lice_type_other"]').attr("readonly","readonly");	
	$('input[name="lice_type"]').on('change', function(){
		if($(this).val() == 'O'){
			$('input[name="lice_type_other"]').removeAttr("readonly","readonly");			
		}else{
			$('input[name="lice_type_other"]').attr("readonly","readonly");		
			$('input[name="lice_type_other"]').val('');		
		}		
	});
	$('input[name="fcs_owner"]').on('change', function(){
		if($(this).val() != 'undefined')
		$('input[name="signature"]').val($(this).val());			
	});
	$('#heat').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
		   $(this).append($('<option />').val(i).html(i));
		}
	});
	/* ----------------------------------------------------- */

	
</script>
</body>
</html>