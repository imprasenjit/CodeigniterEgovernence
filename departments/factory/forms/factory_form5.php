<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="5";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$occupier_name=$results['occupier_name'];$manager_name=$results['manager_name'];$sub_division=$results['sub_division'];$nature=$results['nature'];$no_of_days=$results['no_of_days'];
 
		if(!empty($results["mandays"])){
			$mandays=json_decode($results["mandays"]);
			$mandays_adult=$mandays->adult;$mandays_men=$mandays->men;$mandays_women=$mandays->women;$mandays_adolescents=$mandays->adolescents;$mandays_male=$mandays->male;$mandays_female=$mandays->female;$mandays_children=$mandays->children;$mandays_boys=$mandays->boys;$mandays_girls=$mandays->girls;
		}else{				
			$mandays_adult="";$mandays_men="";$mandays_women="";$mandays_adolescents="";$mandays_male="";$mandays_female="";$mandays_children="";$mandays_boys="";$mandays_girls="";
		}	
		
		if(!empty($results["workers"])){
			$workers=json_decode($results["workers"]);
			$workers_adult=$workers->adult;$workers_men=$workers->men;$workers_women=$workers->women;$workers_adolescents=$workers->adolescents;$workers_male=$workers->male;$workers_female=$workers->female;$workers_children=$workers->children;$workers_boys=$workers->boys;$workers_girls=$workers->girls;
		}else{				
			$workers_adult="";$workers_men="";$workers_women="";$workers_adolescents="";$workers_male="";$workers_female="";$workers_children="";$workers_boys="";$workers_girls="";
		}
	}else{
		$form_id="";$occupier_name="";$manager_name="";$sub_division="";$nature="";$no_of_days="";
		$mandays_adult="";$mandays_men="";$mandays_women="";$mandays_adolescents="";$mandays_male="";$mandays_female="";$mandays_children="";$mandays_boys="";$mandays_girls="";
		$workers_adult="";$workers_men="";$workers_women="";$workers_adolescents="";$workers_male="";$workers_female="";$workers_children="";$workers_boys="";$workers_girls="";
	}
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$occupier_name=$results['occupier_name'];$manager_name=$results['manager_name'];$sub_division=$results['sub_division'];$nature=$results['nature'];$no_of_days=$results['no_of_days'];
 
	if(!empty($results["mandays"])){
		$mandays=json_decode($results["mandays"]);
		$mandays_adult=$mandays->adult;$mandays_men=$mandays->men;$mandays_women=$mandays->women;$mandays_adolescents=$mandays->adolescents;$mandays_male=$mandays->male;$mandays_female=$mandays->female;$mandays_children=$mandays->children;$mandays_boys=$mandays->boys;$mandays_girls=$mandays->girls;
	}else{				
		$mandays_adult="";$mandays_men="";$mandays_women="";$mandays_adolescents="";$mandays_male="";$mandays_female="";$mandays_children="";$mandays_boys="";$mandays_girls="";
	}	
	
	if(!empty($results["workers"])){
		$workers=json_decode($results["workers"]);
		$workers_adult=$workers->adult;$workers_men=$workers->men;$workers_women=$workers->women;$workers_adolescents=$workers->adolescents;$workers_male=$workers->male;$workers_female=$workers->female;$workers_children=$workers->children;$workers_boys=$workers->boys;$workers_girls=$workers->girls;
	}else{				
		$workers_adult="";$workers_men="";$workers_women="";$workers_adolescents="";$workers_male="";$workers_female="";$workers_children="";$workers_boys="";$workers_girls="";
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
											<td width="25%">1. Name of the Factory :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $unit_name; ?>"></td>
											<td width="25%">2. Name of the Occupier :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="occupier_name" value="<?php echo $occupier_name; ?>"></td>							
										</tr>
										<tr>
											<td>3. Name of the Manager :</td>
											<td><input type="text" class="form-control text-uppercase" name="manager_name" value="<?php echo $manager_name; ?>"></td>	
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>4. Postal Address :</td>
											<td><textarea class="form-control text-uppercase" disabled="disabled" ><?php echo $unit_details; ?></textarea></td>
											<td>5. District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>6. Sub-Division :</td>
											<td><input type="text" class="form-control text-uppercase" name="sub_division" value="<?php echo $sub_division; ?>"></td>	
											<td>7. Nature of Industry :</td>
											<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>	
										</tr>
										<tr>
											<td>8. Number of days worked during the half yearly ending 30th june  :</td>
											<td><input type="text" class="form-control text-uppercase" name="no_of_days" value="<?php echo $no_of_days; ?>" validate="onlyNumbers"></td>	
											<td colspan="2"></td>	
										</tr>
										<tr>
											<td colspan="4">9. Number of mandays worked during the half yearly ending 30th June :</td>
										</tr>      
										<tr>
											<td>Adult :</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[adult]" value="<?php echo $mandays_adult; ?>" validate="onlyNumbers"></td>
											<td>Men</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[men]" validate="onlyNumbers" value="<?php echo $mandays_men; ?>"></td>
										</tr>
										<tr>
											<td>Women :</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[women]" validate="onlyNumbers" value="<?php echo $mandays_women; ?>"></td>
											<td>Adolescents</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[adolescents]" validate="onlyNumbers" value="<?php echo $mandays_adolescents; ?>"></td>
										</tr>
										<tr>
											<td>Male :</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[male]" validate="onlyNumbers" value="<?php echo $mandays_male; ?>"></td>
											<td>Female</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[female]" validate="onlyNumbers" value="<?php echo $mandays_female; ?>"></td>
										</tr>
										<tr>
											<td>Children :</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[children]" validate="onlyNumbers" value="<?php echo $mandays_children; ?>"></td>
											<td>Boys</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[boys]" validate="onlyNumbers" value="<?php echo $mandays_boys; ?>"></td>
										</tr>
										<tr>
											<td>Girls :</td>
											<td><input type="text" class="form-control text-uppercase" name="mandays[girls]" validate="onlyNumbers" value="<?php echo $mandays_girls; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">10. Average number of workers employed daily :</td>
										</tr>      
										<tr>
											<td>Adult :</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[adult]" validate="onlyNumbers" value="<?php echo $workers_adult; ?>"></td>
											<td>Men</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[men]" validate="onlyNumbers" value="<?php echo $workers_men; ?>"></td>
										</tr>
										<tr>
											<td>Women :</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[women]" validate="onlyNumbers" value="<?php echo $workers_women; ?>"></td>
											<td>Adolescents</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[adolescents]" validate="onlyNumbers" value="<?php echo $workers_adolescents; ?>"></td>
										</tr>
										<tr>
											<td>Male :</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[male]" validate="onlyNumbers" value="<?php echo $workers_male; ?>"></td>
											<td>Female</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[female]" validate="onlyNumbers" value="<?php echo $workers_female; ?>"></td>
										</tr>
										<tr>
											<td>Children :</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[children]" validate="onlyNumbers" value="<?php echo $workers_children; ?>"></td>
											<td>Boys</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[boys]" validate="onlyNumbers" value="<?php echo $workers_boys; ?>"></td>
										</tr>
										<tr>
											<td>Girls :</td>
											<td><input type="text" class="form-control text-uppercase" name="workers[girls]" validate="onlyNumbers" value="<?php echo $workers_girls; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="2" align="left">Signature of Occupier : &nbsp;&nbsp;<strong><?php echo strtoupper($occupier_name)?></strong><br/> Date : &nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/></td>
											<td colspan="2" align="left">Signature of Manager : &nbsp;&nbsp;<strong><?php echo strtoupper($manager_name)?></strong><br/> Date : &nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/></td>
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