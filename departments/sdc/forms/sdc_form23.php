<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="23";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form2.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$auth_person=$results["auth_person"];$crude_drugs=$results["crude_drugs"];$mech_cont=$results["mech_cont"];$sur_dressing=$results["sur_dressing"];$chromatography=$results["chromatography"];$disinfectants=$results["disinfectants"];$other_drugs=$results["other_drugs"];$products=$results["products"];$antibiotics=$results["antibiotics"];$vitamins=$results["vitamins"];$parental=$results["parental"];$suture=$results["suture"];$test_animal=$results["test_animal"];$microbiological=$results["microbiological"];$homoeopathic=$results["homoeopathic"];$photometer=$results["photometer"];$cosmetics=$results["cosmetics"];$testing=$results["testing"];$drugs=$results["drugs"];
		}else{
			$form_id="";$auth_person="";$crude_drugs="";$mech_cont="";$sur_dressing="";$chromatography="";$disinfectants="";
			$other_drugs="";$products="";$antibiotics="";$vitamins="";$parental="";$suture="";$photometer="";$test_animal="";$microbiological="";$homoeopathic="";$cosmetics="";$testing="";$drugs="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$crude_drugs=$results["crude_drugs"];$mech_cont=$results["mech_cont"];$sur_dressing=$results["sur_dressing"];$chromatography=$results["chromatography"];$disinfectants=$results["disinfectants"];$other_drugs=$results["other_drugs"];$products=$results["products"];$antibiotics=$results["antibiotics"];$vitamins=$results["vitamins"];$parental=$results["parental"];$suture=$results["suture"];$test_animal=$results["test_animal"];$microbiological=$results["microbiological"];$homoeopathic=$results["homoeopathic"];$photometer=$results["photometer"];$cosmetics=$results["cosmetics"];$testing=$results["testing"];$drugs=$results["drugs"];
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
												<td colspan="4">1.I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp; of &nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dist;?>">&nbsp;hereby apply for the grant or renewal of approval for carrying out tests of identity, purity, quality and strength on the following categories of drugs/items of cosmetics or raw materials used in the manufacture thereof on behalf of licensees for manufacture for sale of drugs/cosmetics.</td> 
											</tr>  
											<tr>
												<td colspan="4">2. Categories of drugs, items of cosmetics :</td>
											</tr>
											<tr>
												<td colspan="4">a) Drugs other than those specified in Schedules C and C(1)  and also excluding Homoeopathic Drugs :</td>
											</tr>
											<tr>
												<td width="25%">Crude vegetable drugs.</td>
												<td width="25%"><textarea class="form-control text-uppercase" name="crude_drugs"><?php echo $crude_drugs;?></textarea></td>
												<td width="25%">Mechanical contraceptives</td>
												<td width="25%"><textarea class="form-control text-uppercase" name="mech_cont"><?php echo $mech_cont;?></textarea></td>
											</tr>
											<tr>
												<td>Surgical dressings.</td>
												<td><textarea class="form-control text-uppercase" name="sur_dressing"><?php echo $sur_dressing;	?></textarea></td>
												<td>Drugs requiring the use ultraviolet/Intra Red Spectro- photometer or Chromatography.</td>
												<td><textarea class="form-control text-uppercase" name="chromatography"><?php echo $chromatography;?></textarea></td>
											</tr>
											<tr>
												<td>Disinfectants.</td>
												<td><textarea class="form-control text-uppercase" name="disinfectants"><?php echo $disinfectants;?></textarea></td>
												<td>Other drugs.</td>
												<td><textarea class="form-control text-uppercase" name="other_drugs"><?php echo $other_drugs;?></textarea></td>
											</tr>
											<tr>
												<td colspan="4">(b)  Drugs specified in Schedules C and C(1) :</td>
											</tr>
											<tr>
												<td>Sera, Vaccines, Antigens, Toxins, Antitoxins, Toxoids, Bacteriophages and similar Immunological Products :</td>
												<td><textarea class="form-control text-uppercase" name="products"><?php echo $products;?></textarea></td>
												<td>Antibiotics : </td>
												<td><textarea class="form-control text-uppercase" name="antibiotics"><?php echo $antibiotics;?></textarea></td>
											</tr>
											<tr>
												<td>Vitamins :</td>
												<td><textarea class="form-control text-uppercase" name="vitamins"><?php echo $vitamins;?></textarea></td>
												<td>Parenteral preparations : </td>
												<td><textarea class="form-control text-uppercase" name="parental"><?php echo $parental;?></textarea></td>
											</tr>
											<tr>
												<td>Sterilised surgical ligature/suture :</td>
												<td><textarea class="form-control text-uppercase" name="suture"><?php echo $suture;?></textarea></td>
												<td>Drugs requiring the use of animals for the test : </td>
												<td><textarea class="form-control text-uppercase" name="test_animal"><?php echo $test_animal;?></textarea></td>
											</tr>
											<tr>
												<td>Drugs requiring microbiological tests :</td>
												<td><textarea class="form-control text-uppercase" name="microbiological"><?php echo $microbiological;?></textarea></td>
												<td>Drugs requiring the use of Ultraviolet/Infra Red Spectro-photometer or Chromatography : </td>
												<td><textarea class="form-control text-uppercase" name="photometer"><?php echo $photometer;?></textarea></td>
											</tr>
											<tr>
												<td>Other drugs :</td>
												<td><textarea class="form-control text-uppercase" name="drugs"><?php echo $drugs;?></textarea></td>
												<td>&nbsp; </td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>(c)  Homoeopathic drugs :</td>
												<td><textarea class="form-control text-uppercase" name="homoeopathic"><?php echo $homoeopathic;?></textarea></td>
												<td>(d)  Cosmetics : </td>
												<td><textarea class="form-control text-uppercase" name="cosmetics"><?php echo $cosmetics;?></textarea></td>
											</tr>
											<tr>
												<td colspan="4">3.Names, qualifications and experience of expert staff employed for testing and the person-incharge of testing :
												<table name="objectTable1" id="objectTable1" class="table table-responsive text-center" >
													<tr>
														<th width="10%">Slno</th>
														<th width="25%">Name</th>
														<th width="25%">Qualifications</th>
														<th width="25%">Experience</th>
														<th width="25%">Person-Incharge</th>
													</tr>
													<?php
														$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["experience"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["incharge"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1" validate="letters"></td>
															<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
															<td><input id="txtD1" size="10"  class="form-control text-uppercase" name="txtD1"></td>	
															<td><input id="txtE1" size="10"  class="form-control text-uppercase" name="txtE1"></td>	
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
											<tr >
												<td >4.  List of testing equipment provided. 
												<td><textarea class="form-control text-uppercase" name="testing"><?php echo $testing;?></textarea> </td>
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