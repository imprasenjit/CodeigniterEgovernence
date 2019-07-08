 <?php  require_once "../../requires/login_session.php";
$dept="gmc";
$form="5";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";
	
	if(strtoupper($b_dist)!="KAMRUP METROPOLITAN"){ 
		echo "<script>
				alert('Since your business is not situated in Kamrup Metropolitan so you are not allowed to fill up the application form under Guwahati Municipal Corporation.');
				window.location.href = '".$server_url."user_area/';
		</script>";	
	}
    

	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows>0){	
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$holding_no=$results["holding_no"];$power=$results["power"];$is_business_started=$results["is_business_started"];
	}else{	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$holding_no=$results["holding_no"];$power=$results["power"];$is_business_started=$results["is_business_started"];
		}else{
			$form_id="";
			$holding_no="";$power="";$is_business_started="";
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
									<table class="table table-responsive">
										<tr>
											<td>1. (a) Name of the Applicant </td>
											<td><input type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled="disabled"/></td>				
											<td>(b) Designation of the Applicant</td>				
											<td><input type="text" value="<?php echo $status_applicant; ?>" class="form-control text-uppercase" disabled="disabled"/></td>				
										</tr>										
										<tr>
											<td colspan="4">
												(c) Address of the Applicant <font class="compulsory">*</font>
											</td>
										</tr>
										<tr>
											<td>House No./Building Name </td>
											<td><input type="text" value="<?php echo $street_name1; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>Street/Locality</td>
											<td><input type="text" value="<?php echo $street_name2; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" value="<?php echo $vill; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>District</td>
											<td><input type="text" value="<?php echo $dist; ?>" class="form-control text-uppercase" disabled="disabled"/></td>											
										</tr>
										<tr>
											<td>State</td>
											<td><input type="text" value="<?php echo $block; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>Pin Code </td>
											<td><input type="text" value="<?php echo $pincode; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>(d) Landline No. of the Applicant</td>
											<td><input type="text" value="<?php echo $landline_std.'-'.$landline_no; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>(e) Mobile No. of the Applicant</td>
											<td><input type="text" value="<?php echo '+91'.$mobile_no; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>2. Name of the Enterprise</td>
											<td><input type="text" value="<?php echo $unit_name; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>3. (a) Is it a New or Existing Business</td>
											<td><input type="text" value="<?php echo $is_business_started; ?>" name="is_business_started" class="form-control text-uppercase"/></td>
											
											<td>(b) Expected Date of Commencement of Business</td>
											<td><input type="text" value="<?php echo date("d-m-Y",strtotime($date_of_commencement)); ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>4. Legal Entity of the Business or Constitution of Business</td>
											<td><input type="text" value="<?php echo $owner_type; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td></td>
											<td></td>
										</tr>
										<?php if($owner_type=="H"){ ?>
											<tr>
												<td colspan="3">5. For Hindu Undivided Family</td>
											</tr>
											<tr>
												<td>Name of the karta</td>
												<td><?php echo strtoupper($owners[0]); ?></td>
											</tr>
											<tr>
												<td>Name of the other members</td>
												<td>
												<table>						
												<?php for($i=1; $i < count($owners); $i++) { ?>
															<tr>
																<td><?php echo strtoupper($owners[$i]); ?></td>								
															</tr>';
												<?php 	}  ?>
												</table>
												</td>
											</tr>
										<?php }else if($owner_type=="PSU"){ ?>
											<tr>
												<td colspan="3">5. For Public Sector Undertaking</td>
											</tr>
											<tr>
												<td>Name of the Chief Managing Director</td>
												<td><?php echo strtoupper($owners[0]); ?></td>
											</tr>
											<tr>
												<td>Name of the other Directors</td>
												<td>
														<table>
														<?php for($i=1; $i < count($owners); $i++) { ?>
															<tr>
																<td><?php echo strtoupper($owners[$i]); ?></td>								
															</tr>
														<?php }  ?>
														</table>
												</td>
											</tr>
										<?php }else if($owner_type=="PP" || $owner_type=="LLP"){ ?>
											<tr>
												<td valign="top" >5.(a) Name of the Partners  : </td>
												<td>	<?php echo strtoupper($row["owner_names"]); ?>           </td>
											</tr>
										<?php if($owner_type=="LLP"){ ?>	
											<tr>
												<td valign="top"> LLPIN of the Enterprise : </td>
												<td width="50%"> <?php echo strtoupper($cin_llpin); ?></td>
											</tr>										
										<?php }
										}else if($owner_type=="PTLC" || $owner_type=="PBLC"){ ?>
										<tr>
											<td valign="top" >5.(a) Name of the Directors  : </td>
											<td>		<?php echo strtoupper($row["owner_names"]); ?>	</td>
										</tr>
										<tr>
											<td valign="top"> CIN of the Enterprise : </td>
											<td width="50%"><?php echo strtoupper($cin_llpin); ?></td>
										</tr>
									<?php }else{ ?>
										<tr>
											<td valign="top" >5.(a) Name of the <?php echo strtoupper($legal_entity); ?>  : </td>
											<td>			<?php echo strtoupper($owner_names);  ?>         </td>
										</tr>
										<?php }		 ?>	
										
										<tr>
											<td>6. (a) Type of unit for which NOC is being filled</td>
											<td><input type="text" value="<?php echo $unit_type; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">(b) Address of the unit for which NOC is being filled </td>
										</tr>
										<tr>
											<td>House No./Building Name</td>
											<td><input type="text" value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>Street/Locality</td>
											<td><input type="text" value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>Village/ Town</td>
											<td><input type="text" value="<?php echo $b_vill; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>District</td>
											<td><input type="text" value="<?php echo $b_dist; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>Block/ Ward No.</td>
											<td><input type="text" value="<?php echo $b_block; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>Pin Code</td>
											<td><input type="text" value="<?php echo $b_pincode; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>Revenue Circle</td>
											<td><input type="text" value="<?php echo $circle; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">7. Location of the Enterprise/Registered Office</td>
										</tr>
										<tr>
											<td>House No./Building Name</td>
											<td><input type="text" value="<?php echo $street_name1; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>Street/Locality</td>
											<td><input type="text" value="<?php echo $street_name2; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>Village/ Town</td>
											<td><input type="text" value="<?php echo $vill; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>State</td>
											<td><input type="text" value="<?php echo $state; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>District</td>
											<td><input type="text" value="<?php echo $dist; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>Pin Code</td>
											<td><input type="text" value="<?php echo $pincode; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>8.(a) Landline No.</td>
											<td><input type="text" value="<?php echo $b_landline_std.'-'.$b_landline_no; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>b) Mobile No.</td>
											<td><input type="text" value="<?php echo $b_mobile_no; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>(c) Email-ID.</td>
											<td><input type="text" value="<?php echo $b_email; ?>" class="form-control" disabled="disabled"/></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>9. Size of Current Investment</td>
											<td><input type="text" value="<?php echo $investment_size; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td></td>
											<td></td>
										</tr>
										<tr>									
											<td>10.(a) Select Your Sector of Operation</td>
											<td><input type="text" value="<?php echo $operation_sector; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>(b) Select your business type</td>
											<td><input type="text" value="<?php echo $business_type; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>11. Category of Enterprise based on pollution</td>
											<td><input type="text" value="<?php echo $c_o_Enterprise; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>12. Type of Area</td>
											<td><input type="text" value="<?php echo $t_o_area; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>13. Status of Land/Building/Premises</td>
											<td><input type="text" value="<?php echo $land_status; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>14. (a) Type of Land</td>
											<td><input type="text" value="<?php echo $land_type; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>(b) Dag No</td>
											<td><input type="text" value="<?php echo $dag_no; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>(c) Patta No</td>
											<td><input type="text" value="<?php echo $patta_no; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
											<td>(d) Mouza</td>
											<td><input type="text" value="<?php echo $mouza; ?>" class="form-control text-uppercase" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>15. Holding No of Property</td>
											<td><input type="text" value="<?php echo $holding_no; ?>" name="holding_no" class="form-control text-uppercase"/></td>
											<td>16. Power requirement (in HP)</td>
											<td><input type="text" value="<?php echo $power; ?>" name="power" class="form-control text-uppercase"/></td>
										</tr>
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
				</div>
			</section>
		</div>
		<!-- /.content-wrapper -->
	<?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>