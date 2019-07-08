<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="54";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form4.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;// For reccuring form fill ups
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$auth_person=$results["auth_person"];
			
			if(!empty($results["drug"])){
				$drug=json_decode($results["drug"]);
				$drug_licence_no=$drug->licence_no;$drug_form_no=$drug->form_no;$drug_validity=$drug->validity;$drug_doissue=$drug->doissue;
			}else{
				$drug_licence_no="";$drug_form_no="";$drug_validity="";$drug_doissue="";
			}
		}else{
			$form_id="";$auth_person="";$drug_licence_no="";$drug_form_no="";$drug_validity="";$drug_doissue="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];
			
			if(!empty($results["drug"])){
				$drug=json_decode($results["drug"]);
				$drug_licence_no=$drug->licence_no;$drug_form_no=$drug->form_no;$drug_validity=$drug->validity;$drug_doissue=$drug->doissue;
			}else{
				$drug_licence_no="";$drug_form_no="";$drug_validity="";$drug_doissue="";
			}
	}
?>
<?php require_once "../../requires/header.php";   ?>
	<?php include ("".$table_name."_addmore.php"); ?>
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
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr class="form-inline">
												<td colspan="4">1.I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp;of  M/S&nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>">&nbsp;hereby apply  to manufacturer additional products of Drugs for sale on the premises situated at&nbsp;<input type="text"  class="form-control text-uppercase" value="<?php echo $b_dist;?>" disabled></td>
											</tr>
											<tr class="form-inline">
												<td colspan="4">2. Drug Licence No. <input type="text" class="form-control text-uppercase" name="drug[licence_no]" value="<?=$drug_licence_no?>"/> Form <input type="text" class="form-control text-uppercase" name="drug[form_no]" value="<?=$drug_form_no?>" /> validity <input type="text" class="dob form-control text-uppercase" name="drug[validity]" value="<?=$drug_validity?>" /> date of issue <input type="text" class="dob form-control text-uppercase" name="drug[doissue]" value="<?=$drug_doissue?>" />.</td>
											</tr>
											<tr>
												<td colspan="4">3. Name of the products (Maximum 10 products) :
												<table name="objectTable1" id="objectTable1" class="table table-responsive text-center" >
													<tr>
														<th width="5%">Slno</th>
														<th width="20%">Name of the product</th>
														<th width="20%">Composition</th>
														<th width="20%">Strength</th>
														<th width="20%">Claim</th>
														<th width="15%">Existing brand/From 46</th>
													</tr>
													<?php
														$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name_of_product"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_1["coposition"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["strength"]; ?>" id="txtD<?php echo $count;?>"  class="onlyNumbers form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["claim"]; ?>" id="txtE<?php echo $count;?>"  class="onlyNumbers form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["existing_brand"]; ?>" id="txtF<?php echo $count;?>"  class="onlyNumbers form-control text-uppercase" size="10" name="txtF<?php echo $count;?>"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" class="form-control text-uppercase" validate="letters" name="txtB1"></td>
															<td><input id="txtC1" size="10"  class="form-control text-uppercase" name="txtC1"></td>	
															<td><input id="txtD1" size="10"  class="form-control text-uppercase" name="txtD1"></td>	
															<td><input id="txtE1" size="10"  class="form-control text-uppercase" name="txtE1"></td>	
															<td><input id="txtF1" size="10"  class="form-control text-uppercase" name="txtF1"></td>	
														</tr>
														<?php } ?>														
													</table>
												   <div>													
														<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
														<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
														<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">Date :&nbsp;<label ><?php echo $today;?></label></td>
												<td colspan="2" align="right">Signature :&nbsp;<label><?php echo strtoupper($key_person)?></label></td>
											</tr>	  
											<tr>
												<td class="text-center" colspan="4">
													<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>" class="btn btn-success">Save and Next</button>
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
	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
	/* ---------------------Block all after submit operation-------------------- */
	
</script>