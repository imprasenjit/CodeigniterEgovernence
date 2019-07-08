<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="72";
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
		$facility_name=$results['facility_name'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$info=$results['info'];
		
		if(!empty($results["corr_add"])){
			$corr_add=json_decode($results["corr_add"]);
			$corr_add_sn1=$corr_add->sn1;$corr_add_sn2=$corr_add->sn2;$corr_add_vill=$corr_add->vill;$corr_add_dist=$corr_add->dist;$corr_add_pin=$corr_add->pin;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;$corr_add_email=$corr_add->email;
		}else{				
			$corr_add_sn1="";$corr_add_sn2="";$corr_add_vill="";$corr_add_dist="";$corr_add_pin="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
		}
		
		if(!empty($results["waste"])){
			$waste=json_decode($results["waste"]);
			$waste_recycle=$waste->recycle;$waste_treat=$waste->treat;$waste_dispose=$waste->dispose;$waste_utilisation=$waste->utilisation;$waste_leachate_qty=$waste->leachate_qty;$waste_leachate_tech=$waste->leachate_tech;$waste_prevent=$waste->prevent;$waste_safety=$waste->safety;$waste_details=$waste->details;
		}else{				
			$waste_recycle="";$waste_treat="";$waste_dispose="";$waste_utilisation="";$waste_leachate_qty="";$waste_leachate_tech="";$waste_prevent="";$waste_safety="";$waste_details="";
		}
		        
		if(!empty($results["disposal"])){
			$disposal=json_decode($results["disposal"]);
			$disposal_sites=$disposal->sites;$disposal_qty=$disposal->qty;$disposal_criteria=$disposal->criteria;$disposal_operation=$disposal->operation;$disposal_methodology=$disposal->methodology;$disposal_measures=$disposal->measures;
		}else{				
			$disposal_sites="";$disposal_qty="";$disposal_criteria="";$disposal_operation="";$disposal_methodology="";$disposal_measures="";
		}
		
		if(!empty($results["authorization"])){
			$authorization=json_decode($results["authorization"]);
			if(isset($authorization->a)) $authorization_a=$authorization->a; else $authorization_a="";
			if(isset($authorization->b)) $authorization_b=$authorization->b; else $authorization_b="";
			if(isset($authorization->c)) $authorization_c=$authorization->c; else $authorization_c="";
			if(isset($authorization->d)) $authorization_d=$authorization->d; else $authorization_d="";
		}else{
			$authorization_a="";$authorization_b="";$authorization_c="";$authorization_d="";
		}
	}else{
		$form_id="";$facility_name="";$officer_name="";$officer_desgn="";$info="";
		$corr_add_sn1="";$corr_add_sn2="";$corr_add_vill="";$corr_add_dist="";$corr_add_pin="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
		$waste_recycle="";$waste_treat="";$waste_dispose="";$waste_utilisation="";$waste_leachate_qty="";$waste_leachate_tech="";$waste_prevent="";$waste_safety="";$waste_details="";
		$disposal_sites="";$disposal_qty="";$disposal_criteria="";$disposal_operation="";$disposal_methodology="";$disposal_measures="";
		$authorization_a="";$authorization_b="";$authorization_c="";$authorization_d="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$facility_name=$results['facility_name'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$info=$results['info'];
		
	if(!empty($results["corr_add"])){
		$corr_add=json_decode($results["corr_add"]);
		$corr_add_sn1=$corr_add->sn1;$corr_add_sn2=$corr_add->sn2;$corr_add_vill=$corr_add->vill;$corr_add_dist=$corr_add->dist;$corr_add_pin=$corr_add->pin;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;$corr_add_email=$corr_add->email;
	}else{				
		$corr_add_sn1="";$corr_add_sn2="";$corr_add_vill="";$corr_add_dist="";$corr_add_pin="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
	}
	
	if(!empty($results["waste"])){
		$waste=json_decode($results["waste"]);
		$waste_recycle=$waste->recycle;$waste_treat=$waste->treat;$waste_dispose=$waste->dispose;$waste_utilisation=$waste->utilisation;$waste_leachate_qty=$waste->leachate_qty;$waste_leachate_tech=$waste->leachate_tech;$waste_prevent=$waste->prevent;$waste_safety=$waste->safety;$waste_details=$waste->details;
	}else{				
		$waste_recycle="";$waste_treat="";$waste_dispose="";$waste_utilisation="";$waste_leachate_qty="";$waste_leachate_tech="";$waste_prevent="";$waste_safety="";$waste_details="";
	}
	        
	if(!empty($results["disposal"])){
		$disposal=json_decode($results["disposal"]);
		$disposal_sites=$disposal->sites;$disposal_qty=$disposal->qty;$disposal_criteria=$disposal->criteria;$disposal_operation=$disposal->operation;$disposal_methodology=$disposal->methodology;$disposal_measures=$disposal->measures;
	}else{				
		$disposal_sites="";$disposal_qty="";$disposal_criteria="";$disposal_operation="";$disposal_methodology="";$disposal_measures="";
	}
	
	if(!empty($results["authorization"])){
		$authorization=json_decode($results["authorization"]);
		if(isset($authorization->a)) $authorization_a=$authorization->a; else $authorization_a="";
		if(isset($authorization->b)) $authorization_b=$authorization->b; else $authorization_b="";
		if(isset($authorization->c)) $authorization_c=$authorization->c; else $authorization_c="";
		if(isset($authorization->d)) $authorization_d=$authorization->d; else $authorization_d="";
	}else{
		$authorization_a="";$authorization_b="";$authorization_c="";$authorization_d="";
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
											<td colspan="4">To, <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Member Secretary,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;State Pollution Control Board or Pollution Control Committee</td>
										</tr>
										<tr>
											<td colspan="4">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We hereby apply for authorisation under the Solid Waste Management Rules, 2016 for processing, recycling, treatment and disposal of solid waste.</td>
										</tr>
										<tr>
											<td width="25%">1. Name of the local body/agency appointed by them/ operator of facility :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="facility_name" value="<?php echo $facility_name; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">3. Correspondence address : </td>									
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="corr_add[sn1]" value="<?php echo $corr_add_sn1; ?>"></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="corr_add[sn2]" value="<?php echo $corr_add_sn2; ?>"></td>
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
											<td>Email Id : </td>
											<td><input type="email" class="form-control" name="corr_add[email]" value="<?php echo $corr_add_email;?>" validate="email" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="2">3. Nodal Officer and designation (Officer authorised by the local body or agency responsible for operation of processing/ treatment or disposal facility) : </td>
											<td><input type="text" class="form-control text-uppercase" name="officer_name" value="<?php echo $officer_name; ?>" placeholder="Name" ></td>
											<td><input type="text" class="form-control text-uppercase" name="officer_desgn" value="<?php echo $officer_desgn; ?>" placeholder="Designation" ></td>
										</tr>
										<tr>
										    <td colspan="2">4. Authorisation required for setting up and operation of the facility (Please tick mark) : <span class="mandatory_field">*</span></td>
											<td colspan="2">
												<label class="checkbox-inline"><input type="checkbox" <?php if($authorization_a=="W") echo "checked"; ?> name="authorization[a]" value="W">Waste Processing&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($authorization_b=="T") echo "checked"; ?> name="authorization[b]" value="T">Treatment&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($authorization_c=="R") echo "checked"; ?> name="authorization[c]" value="R">Recycling&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($authorization_d=="D") echo "checked"; ?> name="authorization[d]" value="D">Disposal at landfill&nbsp;&nbsp; </label>
											</td>
										</tr>
										<tr>
											<td colspan="4">5. Processing/recycling/treatment of solid waste : </td>			
										</tr>
										<tr>
											<td colspan="4">(i) Total Quantity of waste to be processed per day : </td>			
										</tr>
										<tr>
											<td>Quantity of waste to be recycled : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[recycle]" value="<?php echo $waste_recycle; ?>"></td>
											<td>Quantity of waste to be treated : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[treat]" value="<?php echo $waste_treat; ?>"></td>
										</tr>
										<tr>
											<td>Quantity of waste to be disposed into landfill : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[dispose]" value="<?php echo $waste_dispose; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>(ii)Utilisation programme for waste processed (Product utilisation) : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[utilisation]" value="<?php echo $waste_utilisation; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">(iii)Methodology for disposal (attach details) : </td>			
										</tr>
										<tr>
											<td>Quantity of leachate : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[leachate_qty]" value="<?php echo $waste_leachate_qty; ?>"></td>
											<td>Treatment technology for leachate : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[leachate_tech]" value="<?php echo $waste_leachate_tech; ?>"></td>
										</tr>
										<tr>
											<td>(iv)Measures to be taken for prevention and control of environmental pollution : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[prevent]" value="<?php echo $waste_prevent; ?>"></td>
											<td>(v)Measures to be taken for safety of workers working in the plant : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[safety]" value="<?php echo $waste_safety; ?>"></td>
										</tr>
										<tr>
											<td>(vi)Details on solid waste processing/recycling/ treatment/disposal facility (to be attached) : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste[details]" value="<?php echo $waste_details; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">6. Disposal of solid waste : </td>			
										</tr>
										<tr>
											<td>(a) Number of sites identified : </td>
											<td><input type="text" class="form-control text-uppercase" name="disposal[sites]" value="<?php echo $disposal_sites; ?>"></td>
											<td>(b) Quantity of waste to be disposed per day : </td>
											<td><input type="text" class="form-control text-uppercase" name="disposal[qty]" value="<?php echo $disposal_qty; ?>"></td>
										</tr>
										<tr>
											<td>(c) Details of methodology or criteria followed for site selection : </td>
											<td><input type="text" class="form-control text-uppercase" name="disposal[criteria]" value="<?php echo $disposal_criteria; ?>"></td>
											<td>(d) Details of existing site under operation : </td>
											<td><input type="text" class="form-control text-uppercase" name="disposal[operation]" value="<?php echo $disposal_operation; ?>"></td>
										</tr>
										<tr>
											<td>(e) Methodology and operational details of landfilling : </td>
											<td><input type="text" class="form-control text-uppercase" name="disposal[methodology]" value="<?php echo $disposal_methodology; ?>"></td>
											<td>(f) Measures taken to check environmental pollution : </td>
											<td><input type="text" class="form-control text-uppercase" name="disposal[measures]" value="<?php echo $disposal_measures; ?>"></td>
										</tr>
										<tr>
											<td>7. Any other information : </td>
											<td colspan="2"><input type="text" class="form-control text-uppercase" name="info" value="<?php echo $info; ?>"></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="2" align="left">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/> Place : <strong><?php echo $dist;?></strong></td>
											<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person)?></strong><br/>Designation : <strong><?php echo $status_applicant;?></strong></td>
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