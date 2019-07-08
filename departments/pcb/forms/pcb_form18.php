<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="18";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_sw_form.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$product=$results['product']; $add_info=$results['add_info'];$local_agency=$results['local_agency'];
			
		if(!empty($results["nodal_off"])){
			$nodal_off=json_decode($results["nodal_off"]);
			$nodal_off_name=$nodal_off->name;$nodal_off_desig=$nodal_off->desig;
		}else{
			$nodal_off_name="";$nodal_off_desig="";
		}
		if(!empty($results["auth_req"])){
			$auth_req=json_decode($results["auth_req"]);
			if(isset($auth_req->a)) $auth_req_a=$auth_req->a;
			if(isset($auth_req->b)) $auth_req_b=$auth_req->b;
			if(isset($auth_req->c)) $auth_req_c=$auth_req->c;
			if(isset($auth_req->d)) $auth_req_d=$auth_req->d;
		}else{
			$auth_req_a="";$auth_req_b="";$auth_req_c="";$auth_req_d="";
		}
		if(!empty($results["quantity"])){
			$quantity=json_decode($results["quantity"]);
			$quantity_q1=$quantity->q1;$quantity_q2=$quantity->q2;$quantity_q3=$quantity->q3;
		}else{
			$quantity_q1="";$quantity_q2="";$quantity_q3="";
		}
		if(!empty($results["measure"])){
			$measure=json_decode($results["measure"]);
			$measure_a=$measure->a;$measure_b=$measure->b;
		}else{
			$measure_a="";$measure_b="";
		}
		if(!empty($results["disposal"])){
			$disposal=json_decode($results["disposal"]);
			$disposal_a=$disposal->a;$disposal_b=$disposal->b;$disposal_c=$disposal->c;$disposal_d=$disposal->d;$disposal_e=$disposal->e;
		}else{
			$disposal_a="";$disposal_b="";$disposal_c="";$disposal_d="";$disposal_e="";
		}			
	}else{
		$product="";$add_info="";$local_agency="";
		$nodal_off_name="";$nodal_off_desig="";
		$auth_req_a="";$auth_req_b="";$auth_req_c="";$auth_req_d="";
		$quantity_q1="";$quantity_q2="";$quantity_q3="";
		$measure_a="";$measure_b="";
		$disposal_a="";$disposal_b="";$disposal_c="";$disposal_d="";$disposal_e="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$product=$results['product']; $add_info=$results['add_info'];$local_agency=$results['local_agency'];
		
	if(!empty($results["nodal_off"])){
		$nodal_off=json_decode($results["nodal_off"]);
		$nodal_off_name=$nodal_off->name;$nodal_off_desig=$nodal_off->desig;
	}else{
		$nodal_off_name="";$nodal_off_desig="";
	}
	if(!empty($results["auth_req"])){
		$auth_req=json_decode($results["auth_req"]);
		if(isset($auth_req->a)) $auth_req_a=$auth_req->a;
		if(isset($auth_req->b)) $auth_req_b=$auth_req->b;
		if(isset($auth_req->c)) $auth_req_c=$auth_req->c;
		if(isset($auth_req->d)) $auth_req_d=$auth_req->d;
	}else{
		$auth_req_a="";$auth_req_b="";$auth_req_c="";$auth_req_d="";
	}
	if(!empty($results["quantity"])){
		$quantity=json_decode($results["quantity"]);
		$quantity_q1=$quantity->q1;$quantity_q2=$quantity->q2;$quantity_q3=$quantity->q3;
	}else{
		$quantity_q1="";$quantity_q2="";$quantity_q3="";
	}
	if(!empty($results["measure"])){
		$measure=json_decode($results["measure"]);
		$measure_a=$measure->a;$measure_b=$measure->b;
	}else{
		$measure_a="";$measure_b="";
	}
	if(!empty($results["disposal"])){
		$disposal=json_decode($results["disposal"]);
		$disposal_a=$disposal->a;$disposal_b=$disposal->b;$disposal_c=$disposal->c;$disposal_d=$disposal->d;$disposal_e=$disposal->e;
	}else{
		$disposal_a="";$disposal_b="";$disposal_c="";$disposal_d="";$disposal_e="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>	
							</div>
							<div class="panel-body">
							   <div id="table1" class="tab-pane" role="tabpanel">
                            <form name="myform1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td colspan="4">To,</td> 
									</tr>
									<tr>
										<td colspan="4" class="form-inline">The Member Secretary,<br/>State Pollution Control Board or Pollution Control Committee<br/> of&emsp;<input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $dist;?>"></td> 
									</tr>
									<tr>
										<td colspan="4">Sir,</td>
									</tr>
									<tr>
										<td colspan="4">&emsp;I/We  hereby  apply  for  authorisation  under  the Solid  Waste  Management Rules,  2016  for  processing, recycling, treatment and disposal of solid waste. </td>
									</tr>
									<tr>
										<td colspan="3">1. Name of the local body/agency appointed by them/ operator of facility :</td>
										<td ><input type="text" class="form-control text-uppercase" name="local_agency" value="<?php echo $local_agency;?>"></td>  
									</tr>
									<tr>
										<td colspan="4">2. Correspondence address :</td>
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
		                             <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
		                             <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
										<td>Mobile</td>
		                             <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>										
										<td>Email-id</td>
		                            <td><input type="text" class="form-control" disabled="disabled" value="<?php  echo $b_email;?>"></td>
									</tr>
									<tr>
										<td colspan="4">3. Nodal Officer & designation(Officer authorised by the local body or agency responsible for operation of processing/ treatment  or disposal facility)<span class="mandatory_field">*</span> </td>
									</tr>
									<tr>
										<td>Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="nodal_off[name]" value="<?php echo $nodal_off_name;?>" validate="letters" required="required"></td>
										<td>Designation :</td>
										<td><input type="text" class="form-control text-uppercase" name="nodal_off[desig]" value="<?php echo $nodal_off_desig;?>" required="required"></td>
									</tr>
									<tr>
										<td colspan="4">4. Authorisation required for setting up and operation of the facility.</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="auth_req[a]" <?php if(isset($auth_req_a) && $auth_req_a=='WP') echo 'checked'; ?>  value="WP" >Waste Processing </td>
							           <td><input type="checkbox" <?php if(isset($auth_req_b) && $auth_req_b=='R') echo 'checked'; ?> value="R" id="" name="auth_req[b]"> Recycling </td>
							           <td><input type="checkbox" <?php if(isset($auth_req_c) && $auth_req_c=='T') echo 'checked'; ?> value="T" id="" name="auth_req[c]"> Treatment</td>
							           <td><input type="checkbox" <?php if(isset($auth_req_d) && $auth_req_d=='DL') echo 'checked'; ?> value="DL" id="" name="auth_req[d]"> Disposal at landfill</td>
									</tr>
									<tr>
										<td colspan="4">5. Processing/recycling/treatment of solid waste</td>
									</tr>
									<tr>
										<td colspan="4">(i) Total quantity of waste to be processed per day</td>
									</tr>
									<tr>
										<td>Quantity of waste to be recycled :</td>
										<td><input type="text" class="form-control text-uppercase" name="quantity[q1]"value="<?php echo $quantity_q1;?>" validate="onlyNumbers" /></td>
										<td>Quantity of waste to be treated :</td>
										<td><input type="text" class="form-control text-uppercase" name="quantity[q2]" value="<?php echo $quantity_q2;?>" validate="onlyNumbers" /></td>
									</tr>
									<tr>
										<td>Quantity of waste to be disposed into landfill :</td>
										<td><input type="text" class="form-control text-uppercase" name="quantity[q3]"value="<?php echo $quantity_q3;?>" validate="onlyNumbers" /></td>
										<td> </td>
										<td></td>
									</tr>
									<tr>
										<td >(ii) Utilisation programme for waste processed (Product utilisation) :</td>
										<td><input type="text" class="form-control text-uppercase" name="product" value="<?php echo $product;?>"></td>
										<td >(iii) Measures to be taken for prevention and control of environmental pollution :</td>
										<td><input type="text" class="form-control text-uppercase" name="measure[a]" value="<?php echo $measure_a;?>" ></td>
									</tr>							
									<tr>										
										<td >(iv) Measures to be taken for safety of workers working in the plant : </td>
										<td><input type="text" class="form-control text-uppercase" name="measure[b]"value="<?php echo $measure_b;?>"></td>
									</tr>								
									<tr>
										<td colspan="4">6. Disposal of solid waste</td>
									</tr>
									<tr>
										<td>Number of sites identified :</td>
										<td><input type="text" class="form-control text-uppercase" name="disposal[a]"value="<?php echo $disposal_a;?>" validate="onlyNumbers" ></td>
										<td>Quantity of waste to be disposed per day :</td>
										<td><input type="text" class="form-control text-uppercase" name="disposal[b]"value="<?php echo $disposal_b;?>" validate="onlyNumbers" ></td>
									</tr>
									<tr>										
										<td>Details of existing site under operation :</td>
										<td><input type="text" class="form-control text-uppercase" name="disposal[c]" value="<?php echo $disposal_c;?>"></td>
										<td>Methodology and operational details of landfilling :</td>
										<td><input type="text" class="form-control text-uppercase" name="disposal[d]" value="<?php echo $disposal_d;?>"></td>
									</tr>
									<tr>
										<td>Measures taken to check environmental pollution :</td>
										<td><input type="text" class="form-control text-uppercase" name="disposal[e]"value="<?php echo $disposal_e;?>"></td>
										<td>7. Any other information :</td>
										<td><textarea class="form-control text-uppercase" name="add_info" validate="textarea" ><?php echo $add_info;?></textarea></td>
									</tr>
									<tr>
										<td>
										   Date: &emsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong>
										   <br/>
										   Place: &emsp;<strong><?php echo strtoupper($dist)?></strong></td>
										<td></td>
										<td></td>
										<td align="right">Signature :&emsp; <strong><?php echo strtoupper($key_person); ?></strong><br/>
										Designation :&emsp;<strong> <?php echo strtoupper($status_applicant); ?></strong><br/> </td>
									</tr>									
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>