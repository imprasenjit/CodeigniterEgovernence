<?php  
require_once "../../requires/login_session.php"; 

$dept="sdc";

//$form_no="sdc_retention"

//$retention_form_no=array('27','28','29','30','31','33','34');
if(isset($_GET["form_no"])){
	$_SESSION["form_no"]=$form_no=$_GET["form_no"];
}else{
	if(isset($_SESSION["form_no"])){
		$form_no=$_SESSION["form_no"];
	}else{
		echo "<script>
			alert('Invalid page access !!!');
			window.location.href = '../../../user_area/';
		</script>";	
	}
	
} 
$form=$form_no;
$table_name=$formFunctions->getTableName($dept,$form);
include "save_form.php";

$row1=$row1=$formFunctions->fetch_swr($swr_id);
$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];

$Name_of_owner=$row1['Name_of_owner'];
$owners=Array();
$owners=explode(",",$Name_of_owner);
$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$drug_licence_no=$results["drug_licence_no"];$issue_dt=$results["issue_dt"];$expiry_dt=$results["expiry_dt"];$mfg_chemist=$results["mfg_chemist"];$testing_chemist=$results["testing_chemist"];
		}else{
			$form_id="";$drug_licence_no="";$issue_dt="";$expiry_dt="";$mfg_chemist="";$testing_chemist="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$drug_licence_no=$results["drug_licence_no"];$issue_dt=$results["issue_dt"];$expiry_dt=$results["expiry_dt"];$mfg_chemist=$results["mfg_chemist"];$testing_chemist=$results["testing_chemist"];
	}
	
$applications=$formFunctions->executeQuery("mysqli","select * from applications where swr_id='$swr_id'");
$uain_applied=Array();

/*switch ($form) {
    case "27" :
        $lic_for_form1="for Form 20B";
        $lic_for_form2="for Form 21B";
        break;
    case "28" :
        $lic_for_form1="for Form 20";
        $lic_for_form2="for Form 21";
        break;
    case "31" :
        $lic_for_form1="for Form 20A";
        $lic_for_form2="for Form 21A";
        break;
    default:
        $lic_for_form1="";
        $lic_for_form2="";
} */

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
							<h4 class="text-center text-bold" >
								<strong><?php echo $form_name=$formFunctions->get_formName("sdc",$form_no);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myformBT5" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
									<table class="table table-responsive">
										<tr>
											<td width="25%"> 1. Name of the Enterprise </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $unit_name;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td colspan="4">2. Address of the Enterprise </td>
										</tr>
										<tr>
											<td width="25%"> Street Name 1</td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_street_name1;?>" disabled="disabled"></td>
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_street_name2;?>" disabled="disabled"></td>
									    </tr>
										<tr>
											<td> Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_vill;?>" disabled="disabled"></td>
											<td> District</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_dist;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase"  name="onbehalf" id="onbehalf"  value="<?php echo $b_pincode;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>3. Name of the Proprietor/Partners/Directors:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" name="Name_of_owner"  value="<?php echo $Name_of_owner;?>" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">4.Name & address of the Applicant:</td>
										</tr>
										<tr> 
											<td width="25%">Applicant's Name</td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $key_person;?>" disabled="disabled"></td>
											<td width="25%">Street Name 1</td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $street_name1;?>" disabled="disabled"></td>
										</tr>
										<tr>
										    <td width="25%">Street Name 2</td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $street_name2;?>" disabled="disabled"></td>
											<td> Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $vill;?>" disabled="disabled"></td>
										</tr>
										<tr>
										    <td> District</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $dist;?>" disabled="disabled"></td>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase"  name="onbehalf" id="onbehalf"  value="<?php echo $pincode;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>5.Drugs Licence Number :</td>
											<td><input type="text" class="form-control text-uppercase" name="drug_licence_no"  value="<?php echo $drug_licence_no;?>" ></td>
										</tr>
										<tr>
										  <td colspan="4">6.Date of issue and Date of Expiry:</td>
										</tr>
										<tr>
										    <td>Date of issue :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="issue_dt"  value="<?php echo $issue_dt;?>" ></td>
										    <td>Date of Expiry :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="expiry_dt"  value="<?php echo $expiry_dt;?>" ></td>
										</tr>
										<tr>
										    <td>7.Name of approved Mfg. Chemist :</td>
											<td><input type="text" class="form-control text-uppercase" name="mfg_chemist"  value="<?php echo $mfg_chemist;?>" ></td>
										    <td>8.Name of approved Testing Chemist :</td>
											<td><input type="text" class="form-control text-uppercase" name="testing_chemist"  value="<?php echo $testing_chemist;?>" ></td>
										</tr>
										<tr>
											<td>Date :</td>
											<td><label><?php echo $today;?></label></td>
											<td>Signature :</td>
											<td><label><?php echo strtoupper($key_person)?></label></td>
										</tr>							
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" name="save_sdc_retention_manufacture" class="btn btn-success">Submit</button>
											</td>
											<td></td>
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
	$('#received_ctecto_row').hide();
	$('#previous_ctecto_row').hide();
	$('#uain_row').hide();
	$('#commission_date_row').hide();
	//alert("1");
	var applied_answer="<?=$applied;?>";
	//alert(applied_answer);
	if(applied_answer=="Y"){
		$('#received_ctecto_row').hide();
		$('#previous_ctecto_row').show();
		$('#uain_row').show();
		$('#commission_date_row').hide();
	}else{			
		$('#received_ctecto_row').show();
		$('#previous_ctecto_row').hide();
		$('#uain_row').hide();
		$('#commission_date_row').hide();
	}
	
	$("input:radio[name='received']").change(function(){
		var received_answer = $(this).val(); 
		if(received_answer=="Y"){
			$('#previous_ctecto_row').show();			
			$('#commission_date_row').hide();			
		}else{		
			$('#uain_row').hide();
			$('#previous_ctecto_row').hide();
			$('#commission_date_row').show();
		}
	});
	$('#consent_fees').on('click', function(){
		alert("asd");		
	});
	
	
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	

</script>
</body>
</html>