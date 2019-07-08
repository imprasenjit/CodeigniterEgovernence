<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="13";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_ew_form.php";

		
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			
			$contact_person_name=$results['contact_person_name'];
			$contact_person_desig=$results['contact_person_desig'];$details_facilities=$results['details_facilities'];
			
			if(!empty($results["contact_person_add"])){
				$contact_person_add=json_decode($results["contact_person_add"]);
				$contact_person_add_sn1=$contact_person_add->sn1;
				$contact_person_add_sn2=$contact_person_add->sn2;
				$contact_person_add_vill=$contact_person_add->vill;
				$contact_person_add_dist=$contact_person_add->dist;
				$contact_person_add_pin=$contact_person_add->pin;
				$contact_person_add_mno=$contact_person_add->mno;
				$contact_person_add_email=$contact_person_add->email;
			}else{
				$contact_person_add_sn1="";$contact_person_add_sn2="";$contact_person_add_vill="";$contact_person_add_dist="";$contact_person_add_pin="";$contact_person_add_mno="";$contact_person_add_email="";
			}	
			
			if(!empty($results["auth_req"])){
				$auth_req=json_decode($results["auth_req"]);
				if(isset($auth_req->gen))	$auth_req_gen=$auth_req->gen;
				else $auth_req_gen="";
				if(isset($auth_req->col))	$auth_req_col=$auth_req->col;
				else $auth_req_col="";
				if(isset($auth_req->dism))	$auth_req_dism=$auth_req->dism;
				else $auth_req_dism="";
				if(isset($auth_req->rec))	$auth_req_rec=$auth_req->rec;
				else $auth_req_rec="";
			}else{
				$auth_req_gen="";$auth_req_col="";$auth_req_dism="";$auth_req_rec="";
			}	
			if(!empty($results["ew_details"])){
				$ew_details=json_decode($results["ew_details"]);
				$ew_details_qty1=$ew_details->qty1;$ew_details_qty2=$ew_details->qty2;$ew_details_qty3=$ew_details->qty3;$ew_details_qty4=$ew_details->qty4;
			}else{
				$ew_details_qty1="";$ew_details_qty2="";$ew_details_qty3="";$ew_details_qty4="";
			}
			
			if(!empty($results["ren_auth"])){
				$ren_auth=json_decode($results["ren_auth"]);
				$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
				$ren_auth_details=$ren_auth->details;
			}else{
				$ren_auth_no="";$ren_auth_dt="";$ren_auth_details="";
			}	
			
			
		}else{	
		    $form_id="";
			$contact_person_name="";$contact_person_desig="";$details_facilities="";
			$contact_person_add_sn1="";$contact_person_add_sn2="";$contact_person_add_vill="";$contact_person_add_dist="";$contact_person_add_pin="";$contact_person_add_mno="";$contact_person_add_email="";
			$auth_req_gen="";$auth_req_col="";$auth_req_dism="";$auth_req_rec="";
			$ew_details_qty1="";$ew_details_qty2="";$ew_details_qty3="";$ew_details_qty4="";
			$ren_auth_no="";$ren_auth_dt="";$ren_auth_details="";
			
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];			
			$contact_person_name=$results['contact_person_name'];
			$contact_person_desig=$results['contact_person_desig'];$details_facilities=$results['details_facilities'];
			
			if(!empty($results["contact_person_add"])){
				$contact_person_add=json_decode($results["contact_person_add"]);
				$contact_person_add_sn1=$contact_person_add->sn1;
				$contact_person_add_sn2=$contact_person_add->sn2;
				$contact_person_add_vill=$contact_person_add->vill;
				$contact_person_add_dist=$contact_person_add->dist;
				$contact_person_add_pin=$contact_person_add->pin;
				$contact_person_add_mno=$contact_person_add->mno;
				$contact_person_add_email=$contact_person_add->email;
			}else{
				$contact_person_add_sn1="";$contact_person_add_sn2="";$contact_person_add_vill="";$contact_person_add_dist="";$contact_person_add_pin="";$contact_person_add_mno="";$contact_person_add_email="";
			}	
			
			if(!empty($results["auth_req"])){
				$auth_req=json_decode($results["auth_req"]);
				if(isset($auth_req->gen))	$auth_req_gen=$auth_req->gen;
				else $auth_req_gen="";
				if(isset($auth_req->col))	$auth_req_col=$auth_req->col;
				else $auth_req_col="";
				if(isset($auth_req->dism))	$auth_req_dism=$auth_req->dism;
				else $auth_req_dism="";
				if(isset($auth_req->rec))	$auth_req_rec=$auth_req->rec;
				else $auth_req_rec="";
			}else{
				$auth_req_gen="";$auth_req_col="";$auth_req_dism="";$auth_req_rec="";
			}	
			if(!empty($results["ew_details"])){
				$ew_details=json_decode($results["ew_details"]);
				$ew_details_qty1=$ew_details->qty1;$ew_details_qty2=$ew_details->qty2;$ew_details_qty3=$ew_details->qty3;$ew_details_qty4=$ew_details->qty4;
			}else{
				$ew_details_qty1="";$ew_details_qty2="";$ew_details_qty3="";$ew_details_qty4="";
			}
			
			if(!empty($results["ren_auth"])){
				$ren_auth=json_decode($results["ren_auth"]);
				$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
				$ren_auth_details=$ren_auth->details;
			}else{
				$ren_auth_no="";$ren_auth_dt="";$ren_auth_details="";
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
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
									<tr>
										<td width="25%">To :</td>
										<td width="25%">The Member Secretary,<br/>Pollution Control Board, Assam<br/>Bamunimaidam, Guwahati-21.
								       </td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td colspan="4">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/we hereby apply for authorization/renewal of authorization under rule 11(2) and 11(6) of the E-wastes (Management and Handling) Rules, 2011 for collection/storage/transport/ treatment/disposal of e-wastes. </td>
									</tr>
									
									<tr>
									    <td colspan="4">1. Name and full address, telephone nos. e-mail and other contact details of the unit</td>
										
									</tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
									     <td>Street Name 1 :</td>
									     <td><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town :</td>
										<td><input type="text" disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District :</td>
										<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
										<td>Pincode :</td>
										<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No :</td>
										<td><input type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>Phone No :</td>
										<td><input type="text" disabled value="<?php echo $b_landline_std.$b_landline_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Email Id :</td>
										<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
									    <td colspan="4">2. Contact Person with designation and contact details such as telephone Nos, Fax. No. and E-mail</td>
									</tr>
									<tr>
									     <td width="25%">Contact Person Name :</td>
									     <td><input type="text" value="<?php echo $contact_person_name; ?>" class="form-control text-uppercase" name="contact_person_name"></td>
										 <td width="25%">Designation :</td>
									     <td><input type="text" value="<?php echo $contact_person_desig; ?>" class="form-control text-uppercase" name="contact_person_desig"></td>
									</tr>
									<tr>
									    <td>Street Name 1 :</td>
									    <td><input type="text" value="<?php echo $contact_person_add_sn1; ?>" class="form-control text-uppercase" name="contact_person_add[sn1]"></td>
										<td>Street Name 2 :</td>
										<td><input type="text" value="<?php echo $contact_person_add_sn2; ?>" class="form-control text-uppercase" name="contact_person_add[sn2]"></td>
									</tr>
									<tr>
									   <td>Village/Town :</td>
										<td><input type="text" value="<?php echo $contact_person_add_vill; ?>"class="form-control text-uppercase" name="contact_person_add[vill]"></td>
										<td>District :</td>
										<td><input type="text" value="<?php echo $contact_person_add_dist; ?>" class="form-control text-uppercase" name="contact_person_add[dist]"></td>
									</tr>
									<tr>
									    <td>Pincode :</td>
										<td><input type="text" value="<?php echo $contact_person_add_pin; ?>" class="form-control" name="contact_person_add[pin]" validate="pincode" maxlength="6"></td>
										<td>Mobile No :</td>
										<td><input type="text" value="<?php echo $contact_person_add_mno; ?>" class="form-control text-uppercase" name="contact_person_add[mno]" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
									    <td>Email Id :</td>
										<td><input type="email" value="<?php echo $contact_person_add_email; ?>" class="form-control" name="contact_person_add[email]"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
									    <td colspan="4">3. Authorization required for (Please tick mark appropriate activity/ies*)</td>
									</tr>
									<tr>
									     <td><input type="checkbox" name="auth_req[gen]" value="Generation during manufacturing or refurbishing" <?php if(isset($auth_req_gen) && $auth_req_gen=='Generation during manufacturing or refurbishing') echo 'checked'; ?>> Generation during manufacturing or refurbishing</input></td>
							            <td><input type="checkbox" name="auth_req[col]" value="Treatment" <?php if(isset($auth_req_col) && $auth_req_col=='Treatment') echo 'checked'; ?>> Treatment, if any</input></td>
							            <td><input type="checkbox" name="auth_req[dism]" value="Collection, Transportation, Storage" <?php if(isset($auth_req_dism) && $auth_req_dism=='Collection, Transportation, Storage') echo 'checked'; ?>> Collection, Transportation, Storage</input></td>
							            <td><input type="checkbox" name="auth_req[rec]" value="Refurbishing" <?php if(isset($auth_req_rec) && $auth_req_rec=='Refurbishing') echo 'checked'; ?>> Refurbishing</input>
						                </td>
									</tr>
										<tr>
									    <td colspan="4">4. E-waste details</td>
									</tr>
									<tr>
										<td>(a) Total quantity e-waste generated in MT/A :</td>
										<td><input type="text" class="form-control text-uppercase" validate="specialChar" name="ew_details[qty1]"  value="<?php echo $ew_details_qty1; ?>" /></td>
										<td>(b) Quantity refurbished (applicable to refurbisher) :</td>
							            <td><input type="text" class="form-control text-uppercase" validate="specialChar" name="ew_details[qty2]" value="<?php echo $ew_details_qty2; ?>" /></td>
									</tr>
									<tr>
                                     <td>(c) Quantity sent for recycling :</td>
							            <td><input type="text" class="form-control text-uppercase" validate="specialChar" name="ew_details[qty3]" value="<?php echo $ew_details_qty3; ?>" /></td>
							            <td>(d) Quantity sent for disposal :</td>
							            <td><input type="text" class="form-control text-uppercase" validate="specialChar" name="ew_details[qty4]"  value="<?php echo $ew_details_qty4; ?>" /></td>		
									</tr>
									
									
									<tr>
									    <td colspan="3">5. Details of Facilities for storage/handling/treatment/refurbishing </td>
									    <td><input type="text" class="form-control text-uppercase" validate="specialChar" name="details_facilities"  value="<?php echo $details_facilities; ?>" /></td>
									    
									</tr>
									<tr>
									     <td colspan="4">6. In case of renewal of authorisation previous authorisation no. and date and details of annual returns</td>
									</tr>
									<tr>
										<td>Authorization No. :</td>
									     <td><input type="text" class="form-control text-uppercase" name="ren_auth[no]"  placeholder="Authorization no." value="<?php echo $ren_auth_no; ?>" /></td>
										 <td>Authorization Date :</td>
									     <td><input type="text" class="dob form-control " name="ren_auth[dt]"  placeholder="Authorization date" value="<?php echo $ren_auth_dt; ?>" readonly /></td>
									     <td></td>     
									</tr>
									<tr>
									   <td>Details of annual returns :</td>
									    <td><input type="text" class="form-control text-uppercase" name="ren_auth[details]" value="<?php  echo $ren_auth_details; ?>" /></td>
									</tr>
									
									
									<tr>
										<td colspan="2">Place: <label><?php echo strtoupper($dist) ;?></label><br/>Date:<label><?php echo date('d-m-Y',strtotime($today)); ?></label>
										</td>									    
										<td colspan="2" align="right">Signature :  <label><?php echo strtoupper($key_person); ?></label><br/>(Name) :  <label class="text-uppercase"><?php echo $key_person ;?></label><br/>Designation : <label class="text-uppercase"><?php echo $status_applicant ;?></label></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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