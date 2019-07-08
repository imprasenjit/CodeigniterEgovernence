<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="59";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form4.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$cosmetics_names=$results["cosmetics_names"];$co_name=$results["co_name"];$auth_person=$results["auth_person"];
		}else{
			$form_id="";$cosmetics_names="";$co_name="";$auth_person="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$cosmetics_names=$results["cosmetics_names"];$co_name=$results["co_name"];$auth_person=$results["auth_person"];
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
												<td colspan="4">1.I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp; of &nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>">&nbsp;hereby apply for grant/renewal of a loan licence to manufacture cosmetics, for sale, on the premises situated at&nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>">&nbsp;C/O&nbsp;<input type="text"  class="form-control text-uppercase" name="co_name" value="<?php echo $co_name;?>">&nbsp;the following cosmetics.</td>
											</tr>
											<tr>
												<td width="25%">2.  Names of cosmetics :</td>
												<td width="25%"><textarea class="form-control text-uppercase" name="cosmetics_names"><?php echo $cosmetics_names;?></textarea></td>
												<td width="25%">&nbsp;</td>
												<td width="25%">&nbsp;</td>
											</tr>
											<tr>
												<td colspan="4">3. The names, qualifications and experience of the staff actually connected with the manufacturing and testing of the specified products in the manufacturing premises :
												<table name="objectTable1" id="objectTable1" class="table table-responsive text-center" >
													<tr>
														<th width="10%">Slno</th>
														<th width="25%">Name</th>
														<th width="20%">Qualifications</th>
														<th width="20%">Experience</th>
														<th width="20%">Responsible<span class="mandatory_field">*</span></th>
													</tr>
													<?php
														$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num1 = $part1->num_rows;
														if($num1>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["experience"]; ?>" id="txtD<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																<td><select required="required" id="txtE<?php echo $count;?>" name="txtE<?php echo $count;?>" class="form-control text-uppercase">
																<option value='' >Select Type</option>
																<option <?php if($row_1["responsible"]=="T") echo "selected"; ?> value='T' >Testing</option>
																<option <?php if($row_1["responsible"]=="M") echo "selected"; ?> value='M' >Manufacture</option>
																</select>									
																</td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
															<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
															<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>
															<td><select required="required" d="txtE1" name="txtE1" class="form-control text-uppercase">
																<option value='' >Select Type</option>
																<option value='T' >Testing</option>
																<option value='M' >Manufacture</option>
															</select></td>
														</tr>
														<?php }?>												
													</table>
												<div>													
													<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
													<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<tr >
												<td colspan="4">4. I/We enclose </td>
											</tr>
											<tr >
												<td colspan="4">(a)  A true copy of a letter from me/us to the manufacturing concern whose manufacturing capacity is intended to be utilised by me/us.</td>
											</tr>
											<tr >
												<td colspan="4">(b)  A true copy of a letter from the *manufacturing concern that they agree to lend the services of their expert staff, equipment and premises for the manufacture of each item required by me/us and they will analyse every batch of and maintain registers of raw materials, finished products and reports of analysis separately in this behalf.</td>
											</tr>
											<tr >
												<td colspan="4">(c)  Specimens of labels, cartons of the products proposed to be manufactured.</td>
											</tr>
											<tr>
												<td>Date :</td>
												<td><label ><?php echo $today;?></label></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>Signature :</td>
												<td><label><?php echo strtoupper($key_person)?></label></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>	  
											<tr>
												<td></td>
												<td class="text-center" colspan="2">
													<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>" class="btn btn-success">Save and Next</button>
												</td>
												<td></td>
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>

</script>