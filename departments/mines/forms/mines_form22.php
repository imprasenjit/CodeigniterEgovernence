<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="22";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form2.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$father_name=$results["father_name"];$partner_name=$results["partner_name"];$partner_add=$results["partner_add"];$place_of_business=$results["place_of_business"];$financial_status=$results["financial_status"];$purpose=$results["purpose"];$mineral_name=$results["mineral_name"];$procured_name=$results["procured_name"];$procured_add=$results["procured_add"];
			
		if(!empty($results["period"])){
			$period=json_decode($results["period"]);
			$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
		}else{				
			$period_from_dt="";$period_to_dt="";
		}		 
	}else{
		$form_id="";
		$father_name="";$partner_name="";$partner_add="";$place_of_business="";$financial_status="";$purpose="";$mineral_name="";$procured_name="";$procured_add="";$period_from_dt="";$period_to_dt="";
	} 
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$father_name=$results["father_name"];$partner_name=$results["partner_name"];$partner_add=$results["partner_add"];$place_of_business=$results["place_of_business"];$financial_status=$results["financial_status"];$purpose=$results["purpose"];$mineral_name=$results["mineral_name"];$procured_name=$results["procured_name"];$procured_add=$results["procured_add"];
			
	if(!empty($results["period"])){
		$period=json_decode($results["period"]);
		$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
	}else{				
		$period_from_dt="";$period_to_dt="";
	}
}
?>

<?php require_once "../../requires/header.php";   ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1. Name of applicant (in full) :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $key_person; ?>" ></td>
											<td width="25%">2. Profession :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $status_applicant; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">3. Full Address :</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>										
										<tr>
											<td>4. Father's name (in full) :</td>
											<td><input type="text" class="form-control text-uppercase" name="father_name" value="<?php echo  $father_name; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4"> a) In case of firm, give name and address of partners and person holding powers of attorney to act on behalf of the firm
										</tr>
										<tr>
											<td>Name :</td>
											<td><input type="text" class="form-control text-uppercase" name="partner_name" value="<?php echo $partner_name; ?>"></td>
											<td>Address :</td>
											<td><textarea class="form-control text-uppercase" name="partner_add" ><?php echo $partner_add; ?></textarea></td>
										</tr>
										<tr>
											<td>5. Specific place or places of business :</td>
											<td><input type="text" class="form-control text-uppercase" name="place_of_business"  value="<?php echo $place_of_business; ?>" ></td>
											<td>6. Financial status with details of person (i.e. property annual payment of Income Tax and any other relevant evidence regarding financial status) :</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_status"  value="<?php echo $financial_status; ?>" ></td>
										</tr>
										<tr>
											<td>7. Specific purpose for which Registration is applied for (Processing/ Storing/ Selling/ Trading) :</td>
											<td colspan="2" align="center">
											<label class="radio-inline"><input type="radio" name="purpose"  value="P" <?php if(isset($purpose) && ($purpose=='P' || $purpose=='')) echo 'checked'; ?> required="required"/> Processing</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" name="purpose"  value="S"  <?php if(isset($purpose) && $purpose=='S') echo 'checked'; ?>/> Storing</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" name="purpose"  value="SE"  <?php if(isset($purpose) && $purpose=='SE') echo 'checked'; ?>/> Selling</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" name="purpose"  value="T"  <?php if(isset($purpose) && $purpose=='T') echo 'checked'; ?>/> Trading</label></td>
										</tr>
										<tr>
											<td>8. Name of mineral/ Ore for which registration is required :</td>
											<td><input type="text" class="form-control text-uppercase" name="mineral_name"  value="<?php echo $mineral_name; ?>" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">9. Name and address of person/ firm from whom the mineral/ ore will be purchased/ procured :</td>											
										</tr>
										<tr>
											<td>Name :</td>
											<td><input type="text" class="form-control text-uppercase" name="procured_name" value="<?php echo $procured_name; ?>"></td>
											<td>Address :</td>
											<td><textarea class="form-control text-uppercase" name="procured_add" ><?php echo $procured_add; ?></textarea></td>
										</tr>
										<tr>
											<td>10. Period for which registration is required :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[from_dt]" placeholder="From" value="<?php echo $period_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[to_dt]" placeholder="To" value="<?php echo $period_to_dt; ?>"></td>
										</tr>											
										<tr>
											<td colspan="4"><center><b>Declaration</b></center><br/>I/We hereby declare that I/ we have read and understood all the provisions of the 'The Assam Mineral Dealer's Rule, 2017' made there under and the conditions of the registrations and I/ we agree to abide by the same.</td>
										</tr>
										<tr>
											<td colspan="4" align="right">Signature of the Applicant&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong><br/></td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>