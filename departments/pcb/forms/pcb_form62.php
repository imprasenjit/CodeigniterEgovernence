<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="62";
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
		$trader_name=$results['trader_name'];$tin_num=$results['tin_num'];$waste_desc=$results['waste_desc'];$waste_qty=$results['waste_qty'];$storage=$results['storage'];
		
		if(!empty($results["address"])){
			$address=json_decode($results["address"]);
			$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_vill=$address->vill;$address_dist=$address->dist;$address_pin=$address->pin;$address_mobile=$address->mobile;$address_tel=$address->tel;$address_fax=$address->fax;$address_email=$address->email;
		}else{				
			$address_sn1="";$address_sn2="";$address_vill="";$address_dist="";$address_pin="";$address_mobile="";$address_tel="";$address_fax="";$address_email="";
		}	
	}else{
		$form_id="";$trader_name="";$tin_num="";$waste_desc="";$waste_qty="";$storage="";
		$address_sn1="";$address_sn2="";$address_vill="";$address_dist="";$address_pin="";$address_mobile="";$address_tel="";$address_fax="";$address_email="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$trader_name=$results['trader_name'];$tin_num=$results['tin_num'];$waste_desc=$results['waste_desc'];$waste_qty=$results['waste_qty'];$storage=$results['storage'];
		
	if(!empty($results["address"])){
		$address=json_decode($results["address"]);
		$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_vill=$address->vill;$address_dist=$address->dist;$address_pin=$address->pin;$address_mobile=$address->mobile;$address_tel=$address->tel;$address_fax=$address->fax;$address_email=$address->email;
	}else{				
		$address_sn1="";$address_sn2="";$address_vill="";$address_dist="";$address_pin="";$address_mobile="";$address_tel="";$address_fax="";$address_email="";
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
											<td width="25%">1. Name of trader : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="trader_name" value="<?php echo $trader_name;?>" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">2. Address of trader : </td>									
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="address[sn1]" value="<?php echo $address_sn1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="address[sn2]" value="<?php echo $address_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="address[vill]" value="<?php echo $address_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="address[dist]" value="<?php echo $address_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="address[pin]" validate="pincode" maxlength="6" value="<?php echo $address_pin; ?>" ></td>
											<td>Mobile No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="address[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $address_mobile; ?>" ></td>
										</tr>
										<tr>
											<td>Telephone No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="address[tel]" value="<?php echo $address_tel; ?>" ></td>
											<td>Fax No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="address[fax]" value="<?php echo $address_fax; ?>" ></td>
										</tr>
										<tr>
											<td>Email Id : </td>
											<td><input type="email" class="form-control" name="address[email]" value="<?php echo $address_email;?>" validate="email" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>3. TIN/VAT Number/Import/ Export Code : </td>
											<td><input type="text" class="form-control text-uppercase" name="tin_num" value="<?php echo $tin_num;?>" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="2">4. Description and quantity of other waste to be imported : </td>
											<td><input type="text" class="form-control text-uppercase" name="waste_desc" value="<?php echo $waste_desc;?>" placeholder="Description" ></td>
											<td><input type="text" class="form-control text-uppercase" name="waste_qty" value="<?php echo $waste_qty;?>" placeholder="Quantity" ></td>
										</tr>
										<tr>
											<td>5. Details of storage, if any : </td>
											<td><input type="text" class="form-control text-uppercase" name="storage" value="<?php echo $storage;?>" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>6. Names and address of authorised actual user (s) :</td>
											<td><input type="text" class="form-control text-uppercase"  disabled="disabled"  value="<?php echo $key_person; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">Address :</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>	
										<tr>
											<td colspan="2" align="left"><br/> Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/> Place : <strong><?php echo $dist;?></strong></td>
											<td colspan="2" align="right"><br/> Signature of the authorized person : <strong><?php echo strtoupper($key_person)?></strong></td>
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