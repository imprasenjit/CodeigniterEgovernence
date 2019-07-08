<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ; // For reccuring form fill ups
	
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$applicant_dob=$results['applicant_dob'];$general_edu=$results['general_edu'];$total_period=$results['total_period'];$apprentice_period=$results['apprentice_period'];	
			
			if(!empty($results["father"])){
				$father=json_decode($results["father"]);
				$father_name=$father->name;$father_st1=$father->st1;$father_st2=$father->st2;$father_vt=$father->vt;$father_dist=$father->dist;$father_pin=$father->pin;$father_mob=$father->mob;$father_email=$father->email;
			}else{
				$father_name="";$father_st1="";$father_st2="";$father_vt="";$father_dist="";$father_pin="";$father_mob="";$father_email="";
			}	
			if(!empty($results["present_addr"])){
				$present_addr=json_decode($results["present_addr"]);
				$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;$present_addr_email=$present_addr->email;
			}else{
				$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
			}
		
		}else{
			$form_id="";
			$applicant_dob="";$general_edu="";$total_period="";$apprentice_period="";
			$father_name="";$father_st1="";$father_st2="";$father_vt="";$father_dist="";$father_pin="";$father_mob="";$father_email="";
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}
		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$applicant_dob=$results['applicant_dob'];$general_edu=$results['general_edu'];$total_period=$results['total_period'];$apprentice_period=$results['apprentice_period'];	
		
		if(!empty($results["father"])){
			$father=json_decode($results["father"]);
			$father_name=$father->name;$father_st1=$father->st1;$father_st2=$father->st2;$father_vt=$father->vt;$father_dist=$father->dist;$father_pin=$father->pin;$father_mob=$father->mob;$father_email=$father->email;
		}else{
			$father_name="";$father_st1="";$father_st2="";$father_vt="";$father_dist="";$father_pin="";$father_mob="";$father_email="";
		}	
		if(!empty($results["present_addr"])){
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;$present_addr_email=$present_addr->email;
		}else{
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}
		
	}
	
    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
	}
	##PHP TAB management ends
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
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">									
									<tr>
										<td width="25%">1. Name of the Applicant:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly"  value="<?php echo $key_person; ?>" ></td>
										<td width="25%">2. Date of Birth<br/>(as per School Certificate) :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="applicant_dob" value="<?php echo $applicant_dob; ?>"></td>
									</tr>
									<tr>
									    <td colspan="4">3. Father’s Name & Address :</td>
									</tr>
									<tr>
										<td>Father Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="father[name]" validate="letters" value="<?php echo $father_name; ?>"></td>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="father[st1]"   value="<?php echo $father_st1; ?>"></td>								
									</tr>
									<tr>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="father[st2]"  value="<?php echo $father_st2; ?>" ></td>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="father[vt]"  value="<?php echo $father_vt; ?>"></td>										
									</tr>
									<tr>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($father_dist);?>"   name="father[dist]">    
                                        </td>
										
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="father[pin]" value="<?php echo $father_pin; ?>" validate="pincode" maxlength="6"></td>										
									</tr>
									<tr>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase"name="father[mob]"  value="<?php echo $father_mob; ?>" maxlength="10" validate="onlyNumbers"></td>
										<td>Email Id:</td>
										<td><input type="email" class="form-control"  name="father[email]" validate="jsonObj" value="<?php echo  $father_email; ?>"></td>
									</tr>
									<tr>
									    <td colspan="4">4. Present Address of Applicant  :</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase"  name="present_addr[st1]" value="<?php echo $present_addr_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[st2]"  value="<?php echo $present_addr_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[vt]"  value="<?php echo $present_addr_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($present_addr_dist);?>"   name="present_addr[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[pin]"  value="<?php echo $present_addr_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[mob]" value="<?php echo $present_addr_mob; ?>" validate="onlyNumbers" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" name="present_addr[email]" validate="jsonObj" value="<?php echo  $present_addr_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">5. Permanent Address of Applicant :</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
										<td>Email Id:</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
									</tr>
									<tr>
										<td>6. General educational qualification:</td>
										<td><input type="text" class="form-control text-uppercase" name="general_edu"  value="<?php echo  $general_edu; ?>"></td>
										<td>7. Total period of experience:</td>
										<td><input type="text" class="form-control text-uppercase" name="total_period"  value="<?php echo  $total_period; ?>"></td>										
									</tr>
									<tr>
										<td>8. Period served as apprentice :</td>
										<td><input type="text" class="form-control text-uppercase" name="apprentice_period"  value="<?php echo  $apprentice_period; ?>"></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>
										 Full Signature of the Applicant</td>
									</tr>									
									<tr>										
									<td class="text-center" colspan="4">
									<button  type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
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
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
<script type="text/javascript">
$(window).ready(function() {
	$(".loader").fadeOut("slow");
})
</script>