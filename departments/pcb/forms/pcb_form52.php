<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="52";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form_auto_renewal.php";

		
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		 $results=$p->fetch_assoc();
		 $form_id=$results["form_id"];
		 $from_year=$results["from_year"];$to_year=$results["to_year"];
		 $reference_uain=$results["reference_uain"];
		 $prev_capital_investment=$results["prev_capital_investment"];
		 $capital_investment=$results["capital_investment"];$prev_cto_order_no=$results["prev_cto_order_no"];$prev_cto_order_date=$results["prev_cto_order_date"];$prev_cto_order_validity_date=$results["prev_cto_order_validity_date"];
	}else{	 
		$form_id="";
		$from_year="";$to_year="";
		$prev_capital_investment="";$capital_investment="";$reference_uain="";$prev_cto_order_date="";$prev_cto_order_validity_date="";$prev_cto_order_no="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results["form_id"];
	$from_year=$results["from_year"];$to_year=$results["to_year"];
	$reference_uain=$results["reference_uain"];
	$prev_capital_investment=$results["prev_capital_investment"];
	$prev_cto_order_no="";$prev_cto_order_no=$results["prev_cto_order_no"];$prev_cto_order_date=$results["prev_cto_order_date"];$prev_cto_order_validity_date=$results["prev_cto_order_validity_date"];
	$capital_investment=$results["capital_investment"];
}
			
    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	
	if ($showtab == "" || $showtab < 2 || $showtab > 4 || is_numeric($showtab) == false) {
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part II</a></li>
							</ul>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">									
									<tr>
										 <td colspan="4"><p class="text-success">Guidelines for applying under Self Certification Scheme for auto renewal of 'Consent to Operate' :</p></td>
									</tr>
									<tr>
									   <td colspan="4">1. The auto-renewal of consent will be applicable when there is no increase in overall production capacity and also, in pollution load.</td>
									</tr>
									<tr>
										<td colspan="4">2. This scheme is applicable, only in case if there is marginal increase (upto max 10%) in the capital investment which is due to infrastructure development, clean technology, pollution control system and better production management, without increase in production or pollution load, the industry shall submit corresponding fees for Consent to Establish and also difference in consent to operate fees since the blocks year the capital investment is made on pro-rata basis.</td>
									</tr>
									<tr>
										<td colspan="4">3. In case, if there is increase in Capital investment by over 10% then the application for grant of renewal of Consent under Auto-renewal Policy will not be considered. The industry needs to apply in prescribed application form.</td>
									</tr>
									<tr>
										<td colspan="4">4. In case, if the capital investment is decreased, then the application for grant of renewal of Consent under Auto-renewal Policy will not be considered. The industry needs to apply in prescribed application form.</td>
									</tr>
									<tr>
										<td colspan="4">5. For the Auto-renewal, industry shall submit format of Self-Certification {Annexure 'A') on
										compliance of earlier Consent conditions duly signed by person authorised by Company's Board and
										shall submit the copy of the said Resolution (Annexure 'C') along with the prescribed fees at PCBA
										HO/ROs and, also industry shall submit Commitment towards compliance of the Consent conditions
										&amp; the Environmental Laws in prescribed format (Annexure-B ).</td>
									</tr>									
									<tr>
										<td colspan="4">6. The format of self-certification by industries is encfosed as Annexure 'A' will be avaflable in the Board's website. The industry shall submit this format along with the prescribed fees either at
										PCBA Head Office or respective Regional Offices(ROs) or through online under EoDB web portal. ln
										case, the application is submitted at ROs, ROs shall ensure that the same shall be forwarded within 7
										days along with details of fees paid. The renewal will be reflected in the EoDB web portal within 15
										days. </td>
									</tr>
									<tr>
									   <td colspan="4">7. Following condition shall be incorporated in the Consent while granting renewal under Auto- renewal Policy:</td>
									</tr>
									<tr class="form-inline">
										<td colspan="4">a)&quot;This Consent is issued under the auto renewal consent policy of the Board vide letter No. ...................... dtd. .......... as per Self -certificate submitted by Mr. ....................... (Designation ..........................) authorized signatory."</td>
									</tr>
									<tr>
										<td colspan="4">b)&quot;The Pollution Control Board, Assam reserves the rights to revoke the Consent any time for any violation.&quot;</td>
									</tr>
									<tr>
										<td colspan="4">c) The applicant shall inform the Board in each financial year about the change in Capital Investment of the industry. In case, if the Capital Investment is increased by an amount upto 10%
										then Industry shall make payment of the corresponding fees for Consent to Establish and also
										difference in Consent to Operate fees for the corresponding block year. In case, if there is increase in
										Capital Investment by over 10% then the industry shall submit a fresh application in prescribed form.</td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=2" type="button" class="btn btn-success"> Save and Next </a>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td width="25%">For the year </td>
										<td width="25%">From&nbsp;&nbsp;
												<select name="from_year" class="dob_year form-control">
												<?php if($from_year!=""){ echo '<option selected value="'.$from_year.'">'.$from_year.'</option>'; } ?>
												</select>
										</td>
										<td width="25%">To&nbsp;&nbsp;
												<select name="to_year" class="dob_year form-control">
												<?php if($to_year!=""){ echo '<option selected value="'.$to_year.'">'.$to_year.'</option>'; } ?>
												</select>
										</td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>Your pr<evious UAIN (if any)</td>
										
                                        <td><input type="text" class="form-control text-uppercase" name="reference_uain" value="" ></td>
										
										
										<td>CTO Order No. </td>
										<td><input type="text" class="form-control text-uppercase" name="prev_cto_order_no" value="<?php echo $prev_cto_order_no; ?>" ></td>
									</tr>
									<tr>										
										<td>Dated</td>
										<td><input type="text" class="form-control text-uppercase dobindia" name="prev_cto_order_date" value="<?php if($prev_cto_order_date!="") echo date("d-m-Y",strtotime($prev_cto_order_date)); ?>" ></td>
										<td>Valid Upto</td>
										<td><input type="text" class="form-control text-uppercase dobindia" name="prev_cto_order_validity_date" value="<?php if($prev_cto_order_validity_date!="") echo date("d-m-Y",strtotime($prev_cto_order_validity_date)); ?>" ></td>
									</tr>
									<tr>
										<td colspan="4">Sir,<br/> We are submitting our Consent renewal application along with the necessary fees for the same. We wish to apply for the auto-renewal of our existing Consent referred above. We undertake the following :</td>
									</tr>
									<tr>
										<td colspan="4">1. We have obtained a valid 'Consent to Operate' from the Pollution Control Board, Assam vide above referred letter and copy of the same is enclosed. The present details of the manufacturing process and all other information as required under the prescribed Consent application form are same as per the earlier Consent application submitted for above referred Consent and therefore the same may be considered for present application.</td>
									</tr>
									<tr class="form-inline">
										<td colspan="4">2. The Capital investment of the industry, as per the earlier Consent granted by Pollution Control Board, Assam vide above referred Consent was Rs <input type="text"  class="form-control text-uppercase" name="prev_capital_investment" value="<?php echo $prev_capital_investment;?>"> Lakh. The Capital investment for the proposed Consent auto-renewal is Rs<input type="text"  class="form-control text-uppercase" name="capital_investment" value="<?php echo $capital_investment;?>">Lakh.</td>
									</tr>
									<tr>
										<td colspan="4">(The change in Capital investment, if any, is only due to investments in infrastructure development,clean technology; pollution control systems and better production management. There is no increase in production or pollution load than as referred in the earlier granted Consent. We are
										submitting corresponding fees for Consent to establish and also, difference in 'Consent to Operate' fees since the block year the Capital investment is made on pro-rata basis, duly supported by the Chartered Accountants Certificate to that effect).</td>
									</tr>
									<tr>
										<td colspan="4">3. The production or manufacturing was as per the Consented limits during the validity period of the earlier Consent for which renewal has been applied</td>
									</tr>
									<tr>												
										<td colspan="4">4. We are complying with the earlier conditions of Consent granted vide above reference.</td>
									</tr>
									<tr>												
										<td colspan="4">5. We undertake to comply with any further condition which may stipulated by PCBA in future and also, undertake to pay all the charges/fees in future.</td>
									</tr>
									<tr>												
										<td colspan="4">6. I am duly authorised by the company to submit this self-certification along with application for Auto Renewal. In case of any misleading information/concealment of material facts or wrong information revealed by the Board, the consent will be liable to be revoked and the company will be liable for further necessary legal action. A copy of the commitment letter about the authenticity of the information provided is true and correct to the best of my knowledge and belief and as per record of the company is submitted separately for which the undersigned is fully responsible being authorised signatory.</td>
									</tr>
									<tr>												
										<td colspan="4">7. The above self certificate is true and correct to the best of my knowledge and belief and I have personally verified the above contents by perusal of all the documents available with the company. An affidavit in the support of self certification on the basis of personal verification of compliance of the conditions stipulated in Consent is enclosed for which, I  for authenticity thereof.<br/>It is requested to issue the auto-renewal of the Consent</td>
									</tr>
									<tr>
									   <td>Date :</td>
										<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
										<td>Signature of applicant :</td>
										<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php" type="button" class="btn btn-primary">Go Back &amp; Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
  <!-- /.content-wrapper -->
   <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>