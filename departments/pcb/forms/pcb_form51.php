<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="51";
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
		$form_id=$results['form_id'];
		$from_year=$results["from_year"];$to_year=$results["to_year"];
		$reference_uain=$results["reference_uain"];$prev_cte_order_no=$results["prev_cte_order_no"];$prev_cte_order_date=$results["prev_cte_order_date"];$pre_status=$results["pre_status"];$reason_renewal=$results["reason_renewal"];
		$comm_name=$results["comm_name"];$comm_st1=$results["comm_st1"];$comm_st2=$results["comm_st2"];$comm_vill=$results["comm_vill"];$comm_dist=$results["comm_dist"];$comm_pincode=$results["comm_pincode"];$comm_mobile_no=$results["comm_mobile_no"];$comm_email=$results["comm_email"];
	}else{	 
		$form_id="";
		$from_year="";$to_year="";
		$reference_uain="";$prev_cte_order_no="";$prev_cte_order_date="";$pre_status="";$reason_renewal="";
		$comm_name=$key_person;$comm_st1=$street_name1;$comm_st2=$street_name2;$comm_vill=$vill;$comm_dist=$dist;$comm_pincode=$pincode;$comm_mobile_no=$mobile_no;$comm_email=$email;
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$from_year=$results["from_year"];$to_year=$results["to_year"];
	$reference_uain=$results["reference_uain"];$prev_cte_order_no=$results["prev_cte_order_no"];$prev_cte_order_date=$results["prev_cte_order_date"];$pre_status=$results["pre_status"];$reason_renewal=$results["reason_renewal"];
	$comm_name=$results["comm_name"];$comm_st1=$results["comm_st1"];$comm_st2=$results["comm_st2"];$comm_vill=$results["comm_vill"];$comm_dist=$results["comm_dist"];$comm_pincode=$results["comm_pincode"];$comm_mobile_no=$results["comm_mobile_no"];$comm_email=$results["comm_email"];
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
									   <td colspan="4"><p class="text-success">Guidelines for applying under Self Certification Scheme for auto renewal of 'Consent to Establish' :</p></td>
									</tr>
									<tr>
										<td colspan="4">1) The ROs/ Head Office shall extend the validity period of CTE to the industries on receipt of the following from the proponent:</td>
									</tr>
									<tr>
										<td colspan="4">&nbsp;&nbsp;(i) Requisition letter in the format from the industry directly to the Authority who has issued the said CTE order (i.e. RO/HO).</td>
									</tr>
									<tr>
										<td colspan="4">&nbsp;&nbsp;(ii) Copy of valid CTE order and EC order (in case of project covered under EIA Notification).</td>
									</tr>
									<tr>
										<td colspan="4">&nbsp;&nbsp;(iii) The progress of construction of the project including installation and construction of Air/Water Pollution Control Systems along with the photographs.</td>
									</tr>
									
									<tr>
										<td colspan="4">&nbsp;&nbsp;(iv) Reasons for extension of validity of CTE order and time required to complete the project. </td>
									</tr>
									<tr>
									   <td colspan="4">&nbsp;&nbsp;(v) Longitude and latitude of the site.</td>
									</tr>
									<tr>
										<td colspan="4">2) In order to simplify the procedure, a standard format for &#39;Application for Auto Renewal of CTE order&#39; is attached for information. There is no need for the inspection report of the site by the Regional Office for extension of CTE validity period.</td>
									</tr>
									<tr>
										<td colspan="4">3) The CTE order shall not be Auto extended for the projects which have not started construction of the project (Construction wall/ security room shall not be considered) during the validity period and applied for extension after expiry of the order.</td>
									</tr>
									<tr>
										<td colspan="4">4) The CTE order shall be extended for a period as requested by the industry not more that 5 years.In case of projects covered under EIA Notification , the auto extension shall be till validity of EC Order.</td>
									</tr>
									<tr>
										<td colspan="4">5) The issuing authority has to issue order extending the validity of CTE order for 5 years within a period of one week.</td>
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
										<td>Your previous UAIN (if any)</td>
										
                                        <td><input type="text" class="form-control text-uppercase" name="reference_uain" value="" ></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>CTE Order No. </td>
										<td><input type="text" class="form-control text-uppercase" name="prev_cte_order_no" value="<?php echo $prev_cte_order_no; ?>" ></td>
										<td>Dated</td>
										<td><input type="text" class="form-control text-uppercase dobindia" name="prev_cte_order_date" value="<?php if($prev_cte_order_date!="") echo date("d-m-Y",strtotime($prev_cte_order_date)); ?>" ></td>
									</tr>
									<tr>
										<td colspan="4">1. Name and location of the industry :</td>
									</tr>
									<tr>
										<td>Name of the industry :</td>
										<td><input type="text"  value="<?php echo strtoupper($unit_name);?>" class="form-control text-uppercase" disabled></td>
										<td>Street Name 1</td>
										<td><input type="text"  value="<?php echo strtoupper($b_street_name1);?>" class="form-control text-uppercase" disabled></td>
									</tr>
									<tr>
										<td>Street Name 2</td>
										<td><input type="text"  value="<?php echo strtoupper($b_street_name2);?>" class="form-control text-uppercase" disabled></td>
										<td>Village/Town</td>
										<td><input type="text"  value="<?php echo strtoupper($b_vill);?>" class="form-control text-uppercase" disabled></td>
									</tr>
									<tr>												
										<td>District</td>
										<td><input type="text"  value="<?php echo strtoupper($b_dist);?>" class="form-control text-uppercase" disabled></td>
										<td>Pincode</td>
										<td><input type="text"  value="<?php echo strtoupper($b_pincode);?>" class="form-control text-uppercase" disabled></td>
									</tr>
									<tr>												
										<td>Mobile</td>
										<td><input type="text"   value="<?php echo "+91 ".strtoupper($b_mobile_no);?>" class="form-control text-uppercase" disabled></td>
										<td>Phone Number</td>
										<td><input type="text"  value="<?php echo strtoupper($b_landline_std)." - ".strtoupper($b_landline_no);?>" class="form-control text-uppercase" disabled></td>
									</tr>
									<tr>												
										<td>Email-id</td>
										<td><input type="text" value="<?php echo $b_email;?>" class="form-control" disabled></td>
								   </tr>
									<tr>
										<td colspan="4">2. Address to communicate the order</td>
									</tr>
									<tr>
									   <td>Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="comm_name" value="<?php echo $comm_name;?>"></td>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="comm_st1" value="<?php echo $comm_st1;?>"></td>
									</tr>
									<tr>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="comm_st2" value="<?php echo $comm_st2;?>"></td>
										<td>Village/Town</td>
		                            <td><input type="text" class="form-control text-uppercase" name="comm_vill" value="<?php echo $comm_vill;?>"></td>
									</tr>
									<tr>
										<td>District</td>
		                            <td><input type="text" class="form-control text-uppercase" name="comm_dist" value="<?php echo $comm_dist;?>"></td>
										<td>Pincode</td>
		                            <td><input type="text" class="form-control text-uppercase" name="comm_pincode" value="<?php echo $comm_pincode;?>" maxlength="6"></td>
									</tr>
									<tr>
										<td>Mobile_no</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="comm_mobile_no" value="<?php echo $comm_mobile_no;?>"></td>
									   <td>Email Id</td>
										<td><input  type="email" class="form-control" validate="email" name="comm_email" value="<?php echo $comm_email;?>"></td>
									</tr>									
									<tr>
										<td>3. Present status of the project :</td>
										<td><textarea class="form-control text-uppercase" name="pre_status"><?php echo $pre_status;?></textarea></td>
										<td>4. Reasons for renewal :</td>
										<td><textarea class="form-control text-uppercase" name="reason_renewal"><?php echo $reason_renewal;?></textarea></td>
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
		$(".#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
