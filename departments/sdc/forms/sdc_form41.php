<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="41";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form3.php";
		
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$auth_person=$results["auth_person"];$co_name=$results["co_name"];$drug_name=$results["drug_name"];$prev_lic_no=$results["prev_lic_no"];
			if($results["prev_issue_date"]!="" || $results["prev_issue_date"]!='00-00-0000' || $results["prev_issue_date"]!='0000-00-00'){
				$prev_issue_date=date('d-m-Y',strtotime($results["prev_issue_date"]));
			}else{
				$prev_issue_date="";
			}
		}else{
			$form_id="";$auth_person="";$co_name="";$drug_name="";$prev_lic_no="";$prev_issue_date="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$co_name=$results["co_name"];$drug_name=$results["drug_name"];$prev_lic_no=$results["prev_lic_no"];
		if($results["prev_issue_date"]!="" || $results["prev_issue_date"]!='00-00-0000' || $results["prev_issue_date"]!='0000-00-00'){
			$prev_issue_date=date('d-m-Y',strtotime($results["prev_issue_date"]));
		}else{
			$prev_issue_date="";
		}
	}
?>
<?php require_once "../../requires/header.php";   ?>
	<?php include ("".$table_name."_Addmore.php"); ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../../requires/banner.php'; ?>
				<div class="row">
					<div class="col-md-41">
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
												<td colspan="4">1.I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp;of&nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>">&nbsp;hereby apply for the grant/ renewal of loan licence to manufacture on the premises situated at&nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>">&nbsp;C/o.&nbsp;<input type="text"  class="form-control text-uppercase" name="co_name" value="<?php echo $co_name;?>">&nbsp;the undermentioned drugs, being drugs specified in Schedules C and C(1) [excluding those specified in [Part XB and] Sch. X] to the Drugs and Cosmetics Rules, 1945.</td>
											</tr>
											<tr>
												<td>2. Names of drugs. (each item to be separately specified):</td>
												<td width="25%"><textarea name="drug_name" class="form-control text-uppercase"><?php echo  $drug_name; ?></textarea></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td colspan="4">3.The names, qualifications and experience of the expert staff actually connected with the manufacture and testing of the specified products in the manufacturing premises.:
												<table name="objectTable1" id="objectTable1" class="table table-responsive text-center" >
													<tr>
														<th width="10%">Slno</th>
														<th width="25%">Name</th>
														<th width="25%">Qualifications</th>
														<th width="25%">Experience</th>
														<th width="25%">Manufacture/Testing<span class="mandatory_field">*</span></th>
													</tr>
													<?php
														$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["experience"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																<td><select required="required" id="txtE<?php echo $count;?>" name="txtE<?php echo $count;?>" class="form-control text-uppercase">
																<option value='' >Select unit</option>
																<option <?php if($row_1["responsible"]=="T") echo "selected"; ?> value='T' >Testing</option>
																<option <?php if($row_1["responsible"]=="M") echo "selected"; ?> value='M' >Manufacture</option>
																</select>									
																</td>
															</tr>												
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1" validate="letters"></td>
															<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
															<td><input id="txtD1" size="10"  class="form-control text-uppercase" name="txtD1"></td>	
															<td><select required="required" id="txtE1" name="txtE1" class="form-control text-uppercase">
																<option value='' >Select Type</option>
																<option value='T' >Testing</option>
																<option value='M' >Manufacture</option>
															</select></td>
														</tr>
														<?php }?>												
													</table>
												</td>
											</tr>
											<tr>
												<td colspan="4">													
													<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
													<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
												</td>
											</tr>
											<tr>
												<td>Licence No.</td>
												<td><input class="form-control text-uppercase" name="prev_lic_no" value="<?=$prev_lic_no;?>" required="required"/></td>
												<td>Issue date :</td>
												<td><input class="dobindia form-control text-uppercase" name="prev_issue_date" value="<?=$prev_issue_date;?>" required="required"/></td>
											</tr>
											<tr>
												<td>Date :</td>
												<td><label ><?php echo $today;?></label></td>	
												<td>Signature :</td>
												<td><label><?php echo strtoupper($key_person)?></label></td>						
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>Designation :</td>
												<td><label><?php echo strtoupper($status_applicant)?></label><td>
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