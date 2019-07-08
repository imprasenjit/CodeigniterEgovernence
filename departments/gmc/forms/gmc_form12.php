<?php  require_once "../../requires/login_session.php";
$dept="gmc";
$form="12";
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
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results["form_id"];$ref_no=$results["ref_no"];$submit_dt=$results["submit_dt"];	
		if(!empty($results["eng"])){
			$eng=json_decode($results["eng"]);
			$eng_sign=$eng->sign;$eng_name=$eng->name;$eng_address=$eng->address;
		}else{				
			$eng_sign="";$eng_name="";$eng_address="";
		}
		if(!empty($results["dev"])){
			$dev=json_decode($results["dev"]);
			$dev_sign=$dev->sign;$dev_name=$dev->name;$dev_address=$dev->address;
		}else{				
			$dev_sign="";$dev_name="";$dev_address="";
		}
	}else{			
		$form_id="";$ref_no="";$submit_dt="";$eng_sign="";$eng_name="";$eng_address="";$dev_sign="";$dev_name="";$dev_address="";
	}	
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];$ref_no=$results["ref_no"];$submit_dt=$results["submit_dt"];	
	if(!empty($results["eng"])){
		$eng=json_decode($results["eng"]);
		$eng_sign=$eng->sign;$eng_name=$eng->name;$eng_address=$eng->address;
	}else{				
		$eng_sign="";$eng_name="";$eng_address="";
	}
	if(!empty($results["dev"])){
		$dev=json_decode($results["dev"]);
		$dev_sign=$dev->sign;$dev_name=$dev->name;$dev_address=$dev->address;
	}else{				
		$dev_sign="";$dev_name="";$dev_address="";
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform14" id="myformFT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td width="25%">Reference No. : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="ref_no" value="<?php echo $ref_no; ?>"></td>
											<td width="25%">Submitted on : </td>
											<td width="25%"><input type="date" class="dob form-control" name="submit_dt" value="<?php echo $submit_dt; ?>" placeholder="Date"></td>
										</tr>
										<tr>
											<td>Owner's Name : </td>
											<td><input class="form-control text-uppercase" type="text" value="<?php echo $key_person; ?>" disabled="disabled"></td>
											<td>Location : </td>
											<td><input class="form-control text-uppercase" type="text" value="<?php echo $b_dist; ?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td colspan="4"><br/>Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;We hereby inform you that the work of execution of the building as per approved plan, working drawing and structural drawings has reached the first storey level and is executed under our supervision.<br/>We declare that the amended plan is not necessary at this stage.<br/><br/>Yours faithfully,</td>
										</tr>
										<tr>
											<td>Signature of the Construction Engineer on Record : </td>
											<td><input type="text" class="form-control text-uppercase" name="eng[sign]" value="<?php echo $eng_sign; ?>"></td>
											<td align="right">Signature of the Owner/ Developer/ Builder : </td>
											<td><input type="text" class="form-control text-uppercase" name="dev[sign]" value="<?php echo $dev_sign; ?>"></td>
										</tr>
										<tr>
											<td colspan="2"><strong>Date : <?php echo date('d-m-Y',strtotime($today));?></strong></td>
											<td colspan="2" align="right"><strong>Date : <?php echo date('d-m-Y',strtotime($today));?></strong></td>
										</tr>
										<tr>
											<td>Name : </td>
											<td><input type="text" class="form-control text-uppercase" name="eng[name]" value="<?php echo $eng_name;?>" placeholder="Name of Construction Engineer on Record"></td>
											<td align="right">Name : </td>
											<td><input type="text" class="form-control text-uppercase" name="dev[name]" value="<?php echo $dev_name;?>" placeholder="Name of Owner/ Developer/ Builder"></td>
										</tr>
										<tr>
											<td>Address : </td>
											<td><textarea class="form-control text-uppercase" name="eng[address]" placeholder="Address of Construction Engineer on Record"><?php echo $eng_address;?></textarea></td>
											<td align="right">Address : </td>
											<td><textarea class="form-control text-uppercase" name="dev[address]" placeholder="Address of Owner/ Developer/ Builder"><?php echo $dev_address;?></textarea></td>
										</tr>
										<tr>
											<td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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