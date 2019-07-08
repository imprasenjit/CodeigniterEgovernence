<?php  require_once "../../requires/login_session.php"; 
$dept="clm";
$form="8";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_clm_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$details_f_pack=$results['details_f_pack'];$imp_country=$results['imp_country'];
			if(!empty($results["warehouse_addr"]))
			{
				$warehouse_addr=json_decode($results["warehouse_addr"]);
				$warehouse_addr_sn1=$warehouse_addr->sn1;$warehouse_addr_sn2=$warehouse_addr->sn2;$warehouse_addr_v=$warehouse_addr->v;$warehouse_addr_d=$warehouse_addr->d;$warehouse_addr_p=$warehouse_addr->p;$warehouse_addr_m=$warehouse_addr->m;$warehouse_addr_e=$warehouse_addr->e;
			}else{
				$warehouse_addr_sn1="";$warehouse_addr_sn2="";$warehouse_addr_v="";$warehouse_addr_d="";$warehouse_addr_p="";$warehouse_addr_m="";$warehouse_addr_e="";
			}
		}else{		
			$form_id="";
			$details_f_pack="";$imp_country="";
			$warehouse_addr_sn1="";$warehouse_addr_sn2="";$warehouse_addr_v="";$warehouse_addr_d="";$warehouse_addr_p="";$warehouse_addr_m="";$warehouse_addr_e="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$details_f_pack=$results['details_f_pack'];$imp_country=$results['imp_country'];
		if(!empty($results["warehouse_addr"]))
		{
			$warehouse_addr=json_decode($results["warehouse_addr"]);
			$warehouse_addr_sn1=$warehouse_addr->sn1;$warehouse_addr_sn2=$warehouse_addr->sn2;$warehouse_addr_v=$warehouse_addr->v;$warehouse_addr_d=$warehouse_addr->d;$warehouse_addr_p=$warehouse_addr->p;$warehouse_addr_m=$warehouse_addr->m;$warehouse_addr_e=$warehouse_addr->e;
		}else{
			$warehouse_addr_sn1="";$warehouse_addr_sn2="";$warehouse_addr_v="";$warehouse_addr_d="";$warehouse_addr_p="";$warehouse_addr_m="";$warehouse_addr_e="";
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
							</br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">
									<tr>
										<td colspan="4">1. Name and address of the Importer</td>					
									</tr>
									<tr>
										<td width="25%">Name </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $mobile_no;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">a. Registered office Address</td>
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
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">b. Address of Warehouse where the goods are imported and kept</td>
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="warehouse_addr[sn1]" value="<?php echo $warehouse_addr_sn1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="warehouse_addr[sn2]" value="<?php echo $warehouse_addr_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="warehouse_addr[v]" value="<?php echo $warehouse_addr_v;?>"></td>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="warehouse_addr[d]" value="<?php echo $warehouse_addr_d;?>"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="warehouse_addr[p]" maxlength="6" validate="pincode" value="<?php echo $warehouse_addr_p;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="warehouse_addr[m]" maxlength="10" validate="mobileNumber" value="<?php echo $warehouse_addr_m;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="warehouse_addr[e]" value="<?php echo $warehouse_addr_e;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan=4>2. Name &amp; Address of Directors of the Firm etc.</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr >
												<th>Sl. No.</th>
												<th>Name</th>
												<th>Father&apos;s/Spouse&apos;s Name</th>
												<th>Address</th>
												<th>Pincode</th>
												<th>Contact No</th>
											</tr>
										</thead>	
											<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$clm->error);
										
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" value="" validate="letters" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="mem_pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="<?php echo $rows->family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" /></td>
												<td><input type="text" name="mem_pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->mem_pincode; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="<?php echo $rows->contact; ?>"/></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										</td>
										</tr>
										</table></td> 
									</tr>
									<tr>
										<td width="25%">3. i) Details of Packaged Commodities being/ to be imported</td>
										<td width="25%"><textarea type="text" class="form-control text-uppercase" maxlength="255" name="details_f_pack"><?php echo $details_f_pack;?></textarea>255 Characters Only</td>
										<td width="25%">ii) Name of the Country from where import is made</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="imp_country" value="<?php echo $imp_country;?>"></td>
									</tr>
									<tr>
										<td>Date : <strong><?php echo date('d-m-Y',strtotime($today));?></strong><br/>
										Place : <strong><?php echo strtoupper($dist);?></strong></td>
										<td></td>
										<td></td>
										<td align="right">Signature : <strong><?php echo strtoupper($key_person);?></strong><br/>
										Designation : <strong><?php echo strtoupper($status_applicant);?></strong></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save<?php echo $form; ?>" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	<?php if($is_applied=="N"){ ?>
	$('#is_applied_details').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_applied"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_applied_details').attr('disabled', 'disabled');
		else
			$('#is_applied_details').removeAttr('disabled');
	});
</script>