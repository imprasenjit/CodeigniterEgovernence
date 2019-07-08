<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="61";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$agency_name=$results['agency_name'];$municipal_auth=$results['municipal_auth'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$applied_auth=$results['applied_auth'];
		
		if(!empty($results["corr_add"])){
			$corr_add=json_decode($results["corr_add"]);
			$corr_add_sn1=$corr_add->sn1;$corr_add_sn2=$corr_add->sn2;$corr_add_vill=$corr_add->vill;$corr_add_dist=$corr_add->dist;$corr_add_pin=$corr_add->pin;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;
		}else{				
			$corr_add_sn1="";$corr_add_sn2="";$corr_add_vill="";$corr_add_dist="";$corr_add_pin="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";
		}	
		
		if(!empty($results["proposal"])){
			$proposal=json_decode($results["proposal"]);
			$proposal_loc=$proposal->loc;$proposal_site_qty=$proposal->site_qty;$proposal_comp=$proposal->comp;$proposal_tech=$proposal->tech;$proposal_qty=$proposal->qty;$proposal_clearance=$proposal->clearance;$proposal_points=$proposal->points;
		}else{				
			$proposal_loc="";$proposal_site_qty="";$proposal_comp="";$proposal_tech="";$proposal_qty="";$proposal_clearance="";$proposal_points="";
		}
		
		if(!empty($results["plan"])){
			$plan=json_decode($results["plan"]);
			$plan_amount=$plan->amount;$plan_disposal=$plan->disposal;$plan_prevent=$plan->prevent;$plan_invest=$plan->invest;$plan_safety=$plan->safety;
		}else{				
			$plan_amount="";$plan_disposal="";$plan_prevent="";$plan_invest="";$plan_safety="";
		}		
	}else{
		$form_id="";$agency_name="";$municipal_auth="";$officer_name="";$officer_desgn="";$applied_auth="";
		$corr_add_sn1="";$corr_add_sn2="";$corr_add_vill="";$corr_add_dist="";$corr_add_pin="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$proposal_loc="";$proposal_site_qty="";$proposal_comp="";$proposal_tech="";$proposal_qty="";$proposal_clearance="";$proposal_points="";$plan_amount="";$plan_disposal="";$plan_prevent="";$plan_invest="";$plan_safety="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$agency_name=$results['agency_name'];$municipal_auth=$results['municipal_auth'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$applied_auth=$results['applied_auth'];
		
	if(!empty($results["corr_add"])){
		$corr_add=json_decode($results["corr_add"]);
		$corr_add_sn1=$corr_add->sn1;$corr_add_sn2=$corr_add->sn2;$corr_add_vill=$corr_add->vill;$corr_add_dist=$corr_add->dist;$corr_add_pin=$corr_add->pin;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;
	}else{				
		$corr_add_sn1="";$corr_add_sn2="";$corr_add_vill="";$corr_add_dist="";$corr_add_pin="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";
	}	
	
	if(!empty($results["proposal"])){
		$proposal=json_decode($results["proposal"]);
		$proposal_loc=$proposal->loc;$proposal_site_qty=$proposal->site_qty;$proposal_comp=$proposal->comp;$proposal_tech=$proposal->tech;$proposal_qty=$proposal->qty;$proposal_clearance=$proposal->clearance;$proposal_points=$proposal->points;
	}else{				
		$proposal_loc="";$proposal_site_qty="";$proposal_comp="";$proposal_tech="";$proposal_qty="";$proposal_clearance="";$proposal_points="";
	}
	
	if(!empty($results["plan"])){
		$plan=json_decode($results["plan"]);
		$plan_amount=$plan->amount;$plan_disposal=$plan->disposal;$plan_prevent=$plan->prevent;$plan_invest=$plan->invest;$plan_safety=$plan->safety;
	}else{				
		$plan_amount="";$plan_disposal="";$plan_prevent="";$plan_invest="";$plan_safety="";
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
											<td colspan="4">To, <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Member Secretary</td>
										</tr>
										<tr>
											<td width="25%">1. Name of the local authority or Name of the agency : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="agency_name" value="<?php echo $agency_name;?>" ></td>
											<td width="25%">2. Appointed by the municipal authority : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="municipal_auth" value="<?php echo $municipal_auth;?>" ></td>
										</tr>
										<tr>
											<td colspan="4">3. Correspondence address : </td>									
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[sn1]" value="<?php echo $corr_add_sn1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[sn2]" value="<?php echo $corr_add_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[vill]" value="<?php echo $corr_add_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[dist]" value="<?php echo $corr_add_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[pin]" validate="pincode" maxlength="6" value="<?php echo $corr_add_pin; ?>" ></td>
											<td>Mobile No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $corr_add_mobile; ?>" ></td>
										</tr>
										<tr>
											<td>Telephone No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[tel]" value="<?php echo $corr_add_tel; ?>" ></td>
											<td>Fax No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[fax]" value="<?php echo $corr_add_fax; ?>" ></td>
										</tr>
										<tr>
											<td colspan="2">4. Nodal Officer and designation (Officer authorized by the competent authority or agency responsible for operation of processing or recycling or disposal facility) : </td>
											<td><input type="text" class="form-control text-uppercase" name="officer_name" value="<?php echo $officer_name; ?>" placeholder="Name" ></td>
											<td><input type="text" class="form-control text-uppercase" name="officer_desgn" value="<?php echo $officer_desgn; ?>" placeholder="Designation" ></td>
										</tr>
										<tr>
											<td colspan="2">5. Authorisation applied for (Setting up of processing or recycling facility of construction and demolition waste) : </td>
											<td colspan="2"><input type="text" class="form-control text-uppercase" name="applied_auth" value="<?php echo $applied_auth; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">6. Detailed proposal of construction and demolition waste processing or recycling facility to include the following : </td>				
										</tr>
										<tr>
											<td colspan="2">(a) Location of site approved and allotted by the Competent Authority : </td>
											<td><input type="text" class="form-control text-uppercase" name="proposal[loc]" value="<?php echo $proposal_loc; ?>" ></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="2">(b) Average quantity (in tons per day) and composition of construction and demolition waste to be handled at the specific site : </td>
											<td><input type="text" class="form-control text-uppercase" name="proposal[site_qty]" value="<?php echo $proposal_site_qty; ?>" validate="decimal" placeholder="Quantity (in tons per day)"></td>
											<td><input type="text" class="form-control text-uppercase" name="proposal[comp]" value="<?php echo $proposal_comp; ?>" placeholder="Composition" ></td>
										</tr>
										<tr>
											<td>(c) Details of construction and demolition waste processing or recycling technology to be used : </td>
											<td><input type="text" class="form-control text-uppercase" name="proposal[tech]" value="<?php echo $proposal_tech; ?>"></td>
											<td>(d) Quantity of construction and demolition waste to be processed per day : </td>
											<td><input type="text" class="form-control text-uppercase" name="proposal[qty]" value="<?php echo $proposal_qty; ?>"></td>
										</tr>
										<tr>
											<td>(e) Site clearance from Prescribed Authority : </td>
											<td><input type="text" class="form-control text-uppercase" name="proposal[clearance]" value="<?php echo $proposal_clearance; ?>"></td>
											<td>(f) Salient points of agreement between competent authority or local authority and operating agency (attach relevant document) : </td>
											<td><input type="text" class="form-control text-uppercase" name="proposal[points]" value="<?php echo $proposal_points; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">7. Plan for utilization of recycled product : </td>				
										</tr>
										<tr>
											<td colspan="2">(a) Expected amount of process rejects and plan for its disposal (e.g., sanitary landfill for solid waste) : </td>
											<td><input type="text" class="form-control text-uppercase" name="plan[amount]" value="<?php echo $plan_amount; ?>" placeholder="Amount"></td>
											<td><input type="text" class="form-control text-uppercase" name="plan[disposal]" value="<?php echo $plan_disposal; ?>" placeholder="Plan for disposal"></td>
										</tr>
										<tr>
											<td>(b) Measures to be taken for prevention and control of environmental pollution : </td>
											<td><input type="text" class="form-control text-uppercase" name="plan[prevent]" value="<?php echo $plan_prevent; ?>"></td>
											<td>(c) Investment on project and expected returns : </td>
											<td><input type="text" class="form-control text-uppercase" name="plan[invest]" value="<?php echo $plan_invest; ?>"></td>
										</tr>
										<tr>
											<td colspan="2">(d) Measures to be taken for safety of workers working in the processing or recycling plant : </td>
											<td><input type="text" class="form-control text-uppercase" name="plan[safety]" value="<?php echo $plan_safety; ?>"></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="2" align="left"><br/> Date :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right"><br/> Signature :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong></td>
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