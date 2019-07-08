<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="24";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$examination_test=$results['examination_test'];$class_of_certificate=$results['class_of_certificate'];$applicant_name=$results['applicant_name'];$place=$results['place'];$applicant_dob=$results['applicant_dob'];$citizen=$results['citizen'];$nationality=$results['nationality'];$technical_qualication=$results['technical_qualication'];$regd_no_competency=$results['regd_no_competency'];$regd_no_permit=$results['regd_no_permit'];$details_of_past=$results['details_of_past'];$centre=$results['centre'];	$language=$results['language'];$candidate_for=$results['candidate_for'];	
			$present_addr_dist=$results['present_addr_dist'];	
			
			if(!empty($results["home_address"]))
			{
				$home_address=json_decode($results["home_address"]);
				$home_address_st1=$home_address->st1;$home_address_st2=$home_address->st2;$home_address_vt=$home_address->vt;$home_address_dist=$home_address->dist;$home_address_pin=$home_address->pin;$home_address_mob=$home_address->mob;$home_address_email=$home_address->email;
			}else{
				$home_address_st1="";$home_address_st2="";$home_address_vt="";$home_address_dist="";$home_address_pin="";$home_address_mob="";$home_address_email="";
			}
			if(!empty($results["present_addr"])){
				$present_addr=json_decode($results["present_addr"]);
				$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;$present_addr_email=$present_addr->email;
			}else{
				$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
			}
			if(!empty($results["issue_certificate"])){
				$issue_certificate=json_decode($results["issue_certificate"]);
				$issue_certificate_regd_no=$issue_certificate->regd_no;$issue_certificate_dte=$issue_certificate->dte;
			}else{
				$issue_certificate_regd_no="";$issue_certificate_dte="";
			}
			
		}else{
			$form_id="";
			$examination_test="";$class_of_certificate="";$applicant_name="";$place="";$applicant_dob="";$citizen="";$nationality="";$technical_qualication="";$regd_no_competency="";$regd_no_permit="";$details_of_past="";$centre="";$language="";$candidate_for="";
			$home_address_st1="";$home_address_st2="";$home_address_vt="";$home_address_dist="";$home_address_pin="";$home_address_mob="";$home_address_email="";
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
			$issue_certificate_regd_no="";$issue_certificate_dte="";	
		}

	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$examination_test=$results['examination_test'];$class_of_certificate=$results['class_of_certificate'];$applicant_name=$results['applicant_name'];$place=$results['place'];$applicant_dob=$results['applicant_dob'];$citizen=$results['citizen'];$nationality=$results['nationality'];$technical_qualication=$results['technical_qualication'];$regd_no_competency=$results['regd_no_competency'];$regd_no_permit=$results['regd_no_permit'];$details_of_past=$results['details_of_past'];$centre=$results['centre'];	$language=$results['language'];$candidate_for=$results['candidate_for'];	
		$present_addr_dist=$results['present_addr_dist'];	
		
		if(!empty($results["home_address"]))
		{
			$home_address=json_decode($results["home_address"]);
			$home_address_st1=$home_address->st1;$home_address_st2=$home_address->st2;$home_address_vt=$home_address->vt;$home_address_dist=$home_address->dist;$home_address_pin=$home_address->pin;$home_address_mob=$home_address->mob;$home_address_email=$home_address->email;
		}else{
			$home_address_st1="";$home_address_st2="";$home_address_vt="";$home_address_dist="";$home_address_pin="";$home_address_mob="";$home_address_email="";
		}
		if(!empty($results["present_addr"])){
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;$present_addr_email=$present_addr->email;
		}else{
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}
		if(!empty($results["issue_certificate"])){
			$issue_certificate=json_decode($results["issue_certificate"]);
			$issue_certificate_regd_no=$issue_certificate->regd_no;$issue_certificate_dte=$issue_certificate->dte;
		}else{
			$issue_certificate_regd_no="";$issue_certificate_dte="";
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
										<td width="25%">1. Examination  test  for  which  the  candidate proposes to appear. </td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="examination_test"  value="<?php echo $examination_test; ?>" ></td>
										<td width="25%">2. Class of certificate of competency permit for which he is a candidate. </td>
										<td width="25%"><input type="text" r class="form-control text-uppercase" name="class_of_certificate" value="<?php echo $class_of_certificate; ?>"></td>
									</tr>
									<tr>
										<td>3. Name of applicant (in block letters)</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant_name" validate="letters" value="<?php echo $applicant_name; ?>"></td>
										<td> </td>
										<td></td>								
									</tr>
									<tr>
										<td colspan="4">4. Place  and  date  of  birth  (certificate  showing age shall be attached)</td>
									</tr>
									<tr>
										<td>Place </td>
										<td><input type="text" class="form-control text-uppercase" name="place" value="<?php echo $place; ?>"></td>	
										<td>Date  of  birth   </td>
										<td><input type="text" class="dob form-control text-uppercase" name="applicant_dob"   value="<?php echo $applicant_dob; ?>"></td>	
									</tr>
									<tr>
										<td colspan="4">5. Home address in full</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="home_address[st1]"   value="<?php echo $home_address_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="home_address[st2]"  value="<?php echo $home_address_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="home_address[vt]"  value="<?php echo $home_address_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($home_address_dist);?>"   name="home_address[dist]">    
                                        </td>
																		
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="home_address[pin]" value="<?php echo $home_address_pin; ?>" validate="pincode" maxlength="6"></td>	
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase"name="home_address[mob]"  value="<?php echo $home_address_mob; ?>" maxlength="10" validate="mobileNumber"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control"  name="home_address[email]" validate="jsonObj" value="<?php echo  $home_address_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">6. Present address in full</td>
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
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($present_addr_dist);?>"   name="present_addr_dist">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[pin]"  value="<?php echo $present_addr_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[mob]" value="<?php echo $present_addr_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" name="present_addr[email]" value="<?php echo  $present_addr_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
										<td>7. (a) Are you a citizen of India if so, how?</td>
										<td><input type="text" class="form-control text-uppercase" name="citizen"  value="<?php echo  $citizen; ?>"></td>
										<td>(b) Name & Nationality of your father</td>
										<td><input type="text" class="form-control text-uppercase" name="nationality"  value="<?php echo  $nationality; ?>"></td>										
									</tr>
									<tr>
										<td colspan="4">8. Details of qualification (attested copies of certificates are to be enclosed and for the purpose of following columns (a) (b) (c) (d) Extra sheet may be annexed to this form if space is not found adequate) 
									</tr>
									<tr>
										<td>a) Academic & technical qualification</td>
										<td><input type="text" class="form-control text-uppercase" name="technical_qualication"  value="<?php echo  $technical_qualication; ?>"></td>
										<td>b) Regd.  No.  of  certificate  of  competency  (if    any)    issued by the electrical Licensing Board Assam. </td>
										<td><input type="text" class="form-control text-uppercase" name="regd_no_competency"  value="<?php echo  $regd_no_competency; ?>"></td>
									</tr>
									<tr>
										<td>c) Regd.  No.  of  Permit  (if  any  issued  by the Electrical Licensing Board, Assam.) </td>
										<td><input type="text" class="form-control text-uppercase" name="regd_no_permit"  value="<?php echo  $regd_no_permit; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">d) Regd.   No.   and   date   of  issue   of  the Certificate  of competency/permit issued by other authority, if any (state name of issuing authority)</td>
									</tr>
									<tr>
										<td> Regd. No. </td>
										<td><input type="text" class="form-control text-uppercase" name="issue_certificate[regd_no]"  value="<?php echo  $issue_certificate_regd_no; ?>"></td>
										<td> Date </td>
										<td><input type="text" class="dob form-control text-uppercase" name="issue_certificate[dte]"  value="<?php echo  $issue_certificate_dte; ?>"></td>
									</tr>
									<tr>
										<td>9. Details  of  past  and  present  service  (date  of commencement   and   termination   of   each appointment  to  be  given,  if  necessary,  extra sheet may be annexed to this form</td>
										<td><input type="text" class="form-control text-uppercase" name="details_of_past"  value="<?php echo  $details_of_past; ?>"></td>
										<td>10. Centre  of  Examination  desired  centers  are Guwahati/Jorhat/ Silchar/ Dibrugarh/ Tezpur.  </td>
										<td><select name="centre" class="form-control text-uppercase">
												<option value="Guwahati" class="form-control text-uppercase" <?php if(isset($centre) && $centre=="Guwahati") echo 'selected'; ?>>Guwahati</option>
												<option value="Jorhat"  class="form-control text-uppercase" <?php if(isset($centre) && $centre=="Jorhat") echo 'selected'; ?>>Jorhat</option>
												<option value="Silchar" class="form-control text-uppercase" <?php if(isset($centre) && $centre=="Silchar") echo 'selected'; ?>>Silchar</option>
												<option value="Dibrugarh" class="form-control text-uppercase" <?php if(isset($centre) && $centre=="Dibrugarh") echo 'selected'; ?>>Dibrugarh</option>
												<option value="Tezpur" class="form-control text-uppercase" <?php if(isset($centre) && $centre=="Tezpur") echo 'selected'; ?>>Tezpur</option>
					                      </select>
					                  </td>
									</tr>									
									<tr>
										<td>11. Language  in  which  candidate  desires  to  be examined </td>
										<td><select name="language" class="form-control text-uppercase">
						                    <option value="Assamese" class="form-control text-uppercase" <?php if(isset($language) && $language=="Assamese") echo 'selected'; ?>>Assamese</option>
						                    <option value="Bengali"  class="form-control text-uppercase" <?php if(isset($language) && $language=="Bengali") echo 'selected'; ?>>Bengali</option>
						                    <option value="English" class="form-control text-uppercase" <?php if(isset($language) && $language=="English") echo 'selected'; ?>>English</option>
					                      </select>
					                  </td>
										<td></td>
										<td></td>
									</tr>	
									<tr>
										<td colspan="4">I am  a  candidate  for  <input type="text" class="form-control1 text-uppercase" name="candidate_for"  value="<?php echo  $candidate_for; ?>">examination  and  test  and  the facts stated above are true to the best of my knowledge and belief. In case of any false statement I shall be liable for any action the Board may deem fit and proper.<br/><br/>
										
										</td>
									</tr>
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($applicant_name) ?></label><br/>
										 Full Signature of the Applicant</td>
									</tr>									
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
    $("input").prop('required',true);
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>