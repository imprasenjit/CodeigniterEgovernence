<?php  require_once "../../requires/login_session.php";
$dept="health";
$form="2";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";
   
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$website_name=$results["website_name"];$no_bed=$results["no_bed"];
			$owner_name=$results["owner_name"];$o_street_name1=$results["o_street_name1"];$o_street_name2=$results["o_street_name2"];$location_type=$results["location_type"];$fees_description=$results["fees_description"];
			$o_vill=$results["o_vill"];$o_block=$results["o_block"];
			$o_pin=$results["o_pin"];$o_mobile_no=$results["o_mobile_no"];  $o_email=$results["o_email"];$o_dist=$results["o_dist"];$any_other=$results["any_other"];
			if(!empty($results["ownership"])){
				$ownership=json_decode($results["ownership"]);
				if(isset($ownership->a)) $ownership_a=$ownership->a; else $ownership_a="";
				if(isset($ownership->b)) $ownership_b=$ownership->b; else $ownership_b="";
				if(isset($ownership->c)) $ownership_c=$ownership->c; else $ownership_c="";
				if(isset($ownership->d)) $ownership_d=$ownership->d; else $ownership_d="";
				if(isset($ownership->e)) $ownership_e=$ownership->e; else $ownership_e="";
				if(isset($ownership->f)) $ownership_f=$ownership->f; else $ownership_f="";
				if(isset($ownership->g)) $ownership_g=$ownership->g; else $ownership_g="";
			}else{
				$ownership_a="";$ownership_b="";$ownership_c="";$ownership_d="";$ownership_e="";$ownership_f="";$ownership_g="";
				 
			}
			if(!empty($results["ownership2"])){
				$ownership2=json_decode($results["ownership2"]);
				if(isset($ownership2->a)) $ownership2_a=$ownership2->a; else $ownership2_a="";
				if(isset($ownership2->b)) $ownership2_b=$ownership2->b; else $ownership2_b="";
				if(isset($ownership2->c)) $ownership2_c=$ownership2->c; else $ownership2_c="";
				if(isset($ownership2->d)) $ownership2_d=$ownership2->d; else $ownership2_d="";
			}else{
				$ownership2_a="";$ownership2_b="";$ownership2_c="";$ownership2_d="";
				 
			}
			if(!empty($results["system"])){
				$system=json_decode($results["system"]);
				if(isset($system->a)) $system_a=$system->a; else $system_a="";
				if(isset($system->b)) $system_b=$system->b; else $system_b="";
				if(isset($system->c)) $system_c=$system->c; else $system_c="";
				if(isset($system->d)) $system_d=$system->d; else $system_d="";
				if(isset($system->e)) $system_e=$system->e; else $system_e="";
				if(isset($system->f)) $system_f=$system->f; else $system_f="";
				if(isset($system->g)) $system_g=$system->g; else $system_g="";
				if(isset($system->h)) $system_h=$system->h; else $system_h="";
			}else{
				$system_a="";$system_b="";$system_c="";$system_d="";$system_e="";$system_f="";$system_g="";$system_h="";
			}
			if(!empty($results["clinical"])){
				$clinical=json_decode($results["clinical"]);
				if(isset($clinical->a)) $clinical_a=$clinical->a; else $clinical_a="";
				if(isset($clinical->b)) $clinical_b=$clinical->b; else $clinical_b="";
				if(isset($clinical->c)) $clinical_c=$clinical->c; else $clinical_c="";
				if(isset($clinical->d)) $clinical_d=$clinical->d; else $clinical_d="";
				if(isset($clinical->any_other)) $clinical_any_other=$clinical->any_other; else $clinical_any_other="";
			}else{
				$clinical_a="";$clinical_b="";$clinical_c="";$clinical_d="";$clinical_any_other="";
			}
			if(!empty($results["clinical_est"])){
				$clinical_est=json_decode($results["clinical_est"]);
				if(isset($clinical_est->a)) $clinical_est_a=$clinical_est->a; else $clinical_est_a="";
				if(isset($clinical_est->b)) $clinical_est_b=$clinical_est->b; else $clinical_est_b="";
				if(isset($clinical_est->c)) $clinical_est_c=$clinical_est->c; else $clinical_est_c="";
				if(isset($clinical_est->d)) $clinical_est_d=$clinical_est->d; else $clinical_est_d="";
				if(isset($clinical_est->any_other)) $clinical_est_any_other=$clinical_est->any_other; else $clinical_est_any_other="";
			}else{
				$clinical_est_a="";$clinical_est_b="";$clinical_est_c="";$clinical_est_d="";$clinical_est_any_other="";
			}
			if(!empty($results["inpatient"])){
				$inpatient=json_decode($results["inpatient"]);
				if(isset($inpatient->a)) $inpatient_a=$inpatient->a; else $inpatient_a="";
				if(isset($inpatient->b)) $inpatient_b=$inpatient->b; else $inpatient_b="";
				if(isset($inpatient->c)) $inpatient_c=$inpatient->c; else $inpatient_c="";
				if(isset($inpatient->d)) $inpatient_d=$inpatient->d; else $inpatient_d="";
				if(isset($inpatient->e)) $inpatient_e=$inpatient->e; else $inpatient_e="";
				if(isset($inpatient->f)) $inpatient_f=$inpatient->f; else $inpatient_f="";
				if(isset($inpatient->g)) $inpatient_g=$inpatient->g; else $inpatient_g="";
				if(isset($inpatient->any_other)) $inpatient_any_other=$inpatient->any_other; else $inpatient_any_other="";
				}else{
				$inpatient_a="";$inpatient_b="";$inpatient_c="";$inpatient_d="";$inpatient_e="";$inpatient_f="";$inpatient_g="";$inpatient_any_other="";
			}
			if(!empty($results["outpatient"])){
				$outpatient=json_decode($results["outpatient"]);
				if(isset($outpatient->a)) $outpatient_a=$outpatient->a; else $outpatient_a="";
				if(isset($outpatient->b)) $outpatient_b=$outpatient->b; else $outpatient_b="";
				if(isset($outpatient->c)) $outpatient_c=$outpatient->c; else $outpatient_c="";
				if(isset($outpatient->d)) $outpatient_d=$outpatient->d; else $outpatient_d="";
				if(isset($outpatient->e)) $outpatient_e=$outpatient->e; else $outpatient_e="";
				if(isset($outpatient->f)) $outpatient_f=$outpatient->f; else $outpatient_f="";
				if(isset($outpatient->g)) $outpatient_g=$outpatient->g; else $outpatient_g="";
				if(isset($outpatient->h)) $outpatient_h=$outpatient->h; else $outpatient_h="";
				if(isset($outpatient->i)) $outpatient_i=$outpatient->i; else $outpatient_i="";
				if(isset($outpatient->j)) $outpatient_j=$outpatient->j; else $outpatient_j="";
				if(isset($outpatient->any_other)) $outpatient_any_other=$outpatient->any_other; else $outpatient_any_other="";
				}else{
				$outpatient_a="";$outpatient_b="";$outpatient_c="";$outpatient_d="";$outpatient_e="";$outpatient_f="";$outpatient_g="";$outpatient_h="";$outpatient_i="";$outpatient_j="";$outpatient_any_other="";
			}
			if(!empty($results["laboratory"])){
				$laboratory=json_decode($results["laboratory"]);
				if(isset($laboratory->a)) $laboratory_a=$laboratory->a; else $laboratory_a="";
				if(isset($laboratory->b)) $laboratory_b=$laboratory->b; else $laboratory_b="";
				if(isset($laboratory->c)) $laboratory_c=$laboratory->c; else $laboratory_c="";
				if(isset($laboratory->d)) $laboratory_d=$laboratory->d; else $laboratory_d="";
				if(isset($laboratory->e)) $laboratory_e=$laboratory->e; else $laboratory_e="";
				if(isset($laboratory->any_other)) $laboratory_any_other=$laboratory->any_other; else $laboratory_any_other="";
			}else{
				$laboratory_a="";$laboratory_b="";$laboratory_c="";$laboratory_d="";$laboratory_e="";$laboratory_any_other="";
			}
			if(!empty($results["imaging_center"])){
				$imaging_center=json_decode($results["imaging_center"]);
				if(isset($imaging_center->a)) $imaging_center_a=$imaging_center->a; else $imaging_center_a="";
				if(isset($imaging_center->b)) $imaging_center_b=$imaging_center->b; else $imaging_center_b="";
				if(isset($imaging_center->c)) $imaging_center_c=$imaging_center->c; else $imaging_center_c="";
				if(isset($imaging_center->d)) $imaging_center_d=$imaging_center->d; else $imaging_center_d="";
				if(isset($imaging_center->e)) $imaging_center_e=$imaging_center->e; else $imaging_center_e="";
				if(isset($imaging_center->any_other)) $imaging_center_any_other=$imaging_center->any_other; else $imaging_center_any_other="";
			}else{
				$imaging_center_a="";$imaging_center_b="";$imaging_center_c="";$imaging_center_d="";$imaging_center_e="";$imaging_center_any_other="";
			}
		}else{			
			$form_id="";		
			$website_name="";$starting_date="";$location_type="";$fees_description="";
			$owner_name="";$o_street_name1="";$o_street_name2="";$o_vill="";$o_block="";$o_pin="";$o_landline_no="";$o_mobile_no="";$o_email="";$o_dist="";$any_other="";
			
			$location_a="";$location_b="";$location_c="";$location_d="";
			 
			$ownership_a="";$ownership_b="";$ownership_c="";$ownership_d="";$ownership_e="";$ownership_f="";$ownership_g="";
			$ownership2_a="";$ownership2_b="";$ownership2_c="";$ownership2_d="";$no_bed="";
			$system_a="";$system_b="";$system_c="";$system_d="";$system_e="";$system_f="";$system_g="";$system_h="";
			$clinical_a="";$clinical_b="";$clinical_c="";$clinical_d="";$clinical_any_other="";
			$clinical_est_a="";$clinical_est_b="";$clinical_est_c="";$clinical_est_d="";$clinical_est_any_other="";
			$inpatient_a="";$inpatient_b="";$inpatient_c="";$inpatient_d="";$inpatient_e="";$inpatient_f="";$inpatient_g="";$inpatient_any_other="";
			$outpatient_a="";$outpatient_b="";$outpatient_c="";$outpatient_d="";$outpatient_e="";$outpatient_f="";$outpatient_g="";$outpatient_h="";$outpatient_i="";$outpatient_j="";$outpatient_any_other="";
			$laboratory_a="";$laboratory_b="";$laboratory_c="";$laboratory_d="";$laboratory_e="";$laboratory_any_other="";
			$imaging_center_a="";$imaging_center_b="";$imaging_center_c="";$imaging_center_d="";$imaging_center_e="";$imaging_center_any_other="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$website_name=$results["website_name"];$no_bed=$results["no_bed"];
		$owner_name=$results["owner_name"];$o_street_name1=$results["o_street_name1"];$o_street_name2=$results["o_street_name2"];
		$o_vill=$results["o_vill"];$o_block=$results["o_block"];
		$o_pin=$results["o_pin"];$o_mobile_no=$results["o_mobile_no"];  $o_email=$results["o_email"];$o_dist=$results["o_dist"];$any_other=$results["any_other"];$location_type=$results["location_type"];$fees_description=$results["fees_description"];
		if(!empty($results["ownership"])){
			$ownership=json_decode($results["ownership"]);
			if(isset($ownership->a)) $ownership_a=$ownership->a; else $ownership_a="";
			if(isset($ownership->b)) $ownership_b=$ownership->b; else $ownership_b="";
			if(isset($ownership->c)) $ownership_c=$ownership->c; else $ownership_c="";
			if(isset($ownership->d)) $ownership_d=$ownership->d; else $ownership_d="";
			if(isset($ownership->e)) $ownership_e=$ownership->e; else $ownership_e="";
			if(isset($ownership->f)) $ownership_f=$ownership->f; else $ownership_f="";
			if(isset($ownership->g)) $ownership_g=$ownership->g; else $ownership_g="";
		}else{
			$ownership_a="";$ownership_b="";$ownership_c="";$ownership_d="";$ownership_e="";$ownership_f="";$ownership_g="";
			 
		}
		if(!empty($results["ownership2"])){
			$ownership2=json_decode($results["ownership2"]);
			if(isset($ownership2->a)) $ownership2_a=$ownership2->a; else $ownership2_a="";
			if(isset($ownership2->b)) $ownership2_b=$ownership2->b; else $ownership2_b="";
			if(isset($ownership2->c)) $ownership2_c=$ownership2->c; else $ownership2_c="";
			if(isset($ownership2->d)) $ownership2_d=$ownership2->d; else $ownership2_d="";
		}else{
			$ownership2_a="";$ownership2_b="";$ownership2_c="";$ownership2_d="";
			 
		}
		if(!empty($results["system"])){
			$system=json_decode($results["system"]);
			if(isset($system->a)) $system_a=$system->a; else $system_a="";
			if(isset($system->b)) $system_b=$system->b; else $system_b="";
			if(isset($system->c)) $system_c=$system->c; else $system_c="";
			if(isset($system->d)) $system_d=$system->d; else $system_d="";
			if(isset($system->e)) $system_e=$system->e; else $system_e="";
			if(isset($system->f)) $system_f=$system->f; else $system_f="";
			if(isset($system->g)) $system_g=$system->g; else $system_g="";
			if(isset($system->h)) $system_h=$system->h; else $system_h="";
		}else{
			$system_a="";$system_b="";$system_c="";$system_d="";$system_e="";$system_f="";$system_g="";$system_h="";
		}
		if(!empty($results["clinical"])){
			$clinical=json_decode($results["clinical"]);
			if(isset($clinical->a)) $clinical_a=$clinical->a; else $clinical_a="";
			if(isset($clinical->b)) $clinical_b=$clinical->b; else $clinical_b="";
			if(isset($clinical->c)) $clinical_c=$clinical->c; else $clinical_c="";
			if(isset($clinical->d)) $clinical_d=$clinical->d; else $clinical_d="";
			if(isset($clinical->any_other)) $clinical_any_other=$clinical->any_other; else $clinical_any_other="";
		}else{
			$clinical_a="";$clinical_b="";$clinical_c="";$clinical_d="";$clinical_any_other="";
		}
		if(!empty($results["clinical_est"])){
			$clinical_est=json_decode($results["clinical_est"]);
			if(isset($clinical_est->a)) $clinical_est_a=$clinical_est->a; else $clinical_est_a="";
			if(isset($clinical_est->b)) $clinical_est_b=$clinical_est->b; else $clinical_est_b="";
			if(isset($clinical_est->c)) $clinical_est_c=$clinical_est->c; else $clinical_est_c="";
			if(isset($clinical_est->d)) $clinical_est_d=$clinical_est->d; else $clinical_est_d="";
			if(isset($clinical_est->any_other)) $clinical_est_any_other=$clinical_est->any_other; else $clinical_est_any_other="";
		}else{
			$clinical_est_a="";$clinical_est_b="";$clinical_est_c="";$clinical_est_d="";$clinical_est_any_other="";
		}
		if(!empty($results["inpatient"])){
			$inpatient=json_decode($results["inpatient"]);
			if(isset($inpatient->a)) $inpatient_a=$inpatient->a; else $inpatient_a="";
			if(isset($inpatient->b)) $inpatient_b=$inpatient->b; else $inpatient_b="";
			if(isset($inpatient->c)) $inpatient_c=$inpatient->c; else $inpatient_c="";
			if(isset($inpatient->d)) $inpatient_d=$inpatient->d; else $inpatient_d="";
			if(isset($inpatient->e)) $inpatient_e=$inpatient->e; else $inpatient_e="";
			if(isset($inpatient->f)) $inpatient_f=$inpatient->f; else $inpatient_f="";
			if(isset($inpatient->g)) $inpatient_g=$inpatient->g; else $inpatient_g="";
			if(isset($inpatient->any_other)) $inpatient_any_other=$inpatient->any_other; else $inpatient_any_other="";
			}else{
			$inpatient_a="";$inpatient_b="";$inpatient_c="";$inpatient_d="";$inpatient_e="";$inpatient_f="";$inpatient_g="";$inpatient_any_other="";
		}
		if(!empty($results["outpatient"])){
			$outpatient=json_decode($results["outpatient"]);
			if(isset($outpatient->a)) $outpatient_a=$outpatient->a; else $outpatient_a="";
			if(isset($outpatient->b)) $outpatient_b=$outpatient->b; else $outpatient_b="";
			if(isset($outpatient->c)) $outpatient_c=$outpatient->c; else $outpatient_c="";
			if(isset($outpatient->d)) $outpatient_d=$outpatient->d; else $outpatient_d="";
			if(isset($outpatient->e)) $outpatient_e=$outpatient->e; else $outpatient_e="";
			if(isset($outpatient->f)) $outpatient_f=$outpatient->f; else $outpatient_f="";
			if(isset($outpatient->g)) $outpatient_g=$outpatient->g; else $outpatient_g="";
			if(isset($outpatient->h)) $outpatient_h=$outpatient->h; else $outpatient_h="";
			if(isset($outpatient->i)) $outpatient_i=$outpatient->i; else $outpatient_i="";
			if(isset($outpatient->j)) $outpatient_j=$outpatient->j; else $outpatient_j="";
			if(isset($outpatient->any_other)) $outpatient_any_other=$outpatient->any_other; else $outpatient_any_other="";
			}else{
			$outpatient_a="";$outpatient_b="";$outpatient_c="";$outpatient_d="";$outpatient_e="";$outpatient_f="";$outpatient_g="";$outpatient_h="";$outpatient_i="";$outpatient_j="";$outpatient_any_other="";
		}
		if(!empty($results["laboratory"])){
			$laboratory=json_decode($results["laboratory"]);
			if(isset($laboratory->a)) $laboratory_a=$laboratory->a; else $laboratory_a="";
			if(isset($laboratory->b)) $laboratory_b=$laboratory->b; else $laboratory_b="";
			if(isset($laboratory->c)) $laboratory_c=$laboratory->c; else $laboratory_c="";
			if(isset($laboratory->d)) $laboratory_d=$laboratory->d; else $laboratory_d="";
			if(isset($laboratory->e)) $laboratory_e=$laboratory->e; else $laboratory_e="";
			if(isset($laboratory->any_other)) $laboratory_any_other=$laboratory->any_other; else $laboratory_any_other="";
		}else{
			$laboratory_a="";$laboratory_b="";$laboratory_c="";$laboratory_d="";$laboratory_e="";$laboratory_any_other="";
		}
		if(!empty($results["imaging_center"])){
			$imaging_center=json_decode($results["imaging_center"]);
			if(isset($imaging_center->a)) $imaging_center_a=$imaging_center->a; else $imaging_center_a="";
			if(isset($imaging_center->b)) $imaging_center_b=$imaging_center->b; else $imaging_center_b="";
			if(isset($imaging_center->c)) $imaging_center_c=$imaging_center->c; else $imaging_center_c="";
			if(isset($imaging_center->d)) $imaging_center_d=$imaging_center->d; else $imaging_center_d="";
			if(isset($imaging_center->e)) $imaging_center_e=$imaging_center->e; else $imaging_center_e="";
			if(isset($imaging_center->any_other)) $imaging_center_any_other=$imaging_center->any_other; else $imaging_center_any_other="";
		}else{
			$imaging_center_a="";$imaging_center_b="";$imaging_center_c="";$imaging_center_d="";$imaging_center_e="";$imaging_center_any_other="";
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
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong><br/>
								</h4>
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td>1. Name of the Clinical Establishment:</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">2. Address:</td>					
											</tr>
											<tr>
												<td width="25%">Street Name 1</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>"></td>
												<td width="25%">Street Name 2</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town/city</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>"></td>
												<td>block</td>
												<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_block; ?>"></td>
											</tr>
											<tr>
											<td>District</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"></td>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"></td>
												
											</tr>
											<tr>										
												<td>Mobile No.</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no; ?>"></td>
												<td>E-Mail ID</td>
												<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email; ?>"></td>
											</tr>	
											<tr>										
												<td>Website (if any) :</td>
												<td><input type="text" class="form-control" name="website_name" value="<?php echo $website_name; ?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>3. Name of the owner:</td>	
												<td width="25%"><input type="text" class="form-control text-uppercase" name="owner_name"  value="<?php echo $owner_name; ?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td width="25%">Street Name 1</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="o_street_name1"  value="<?php echo $o_street_name1; ?>"></td>
												<td width="25%">Street Name 2</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="o_street_name2"  value="<?php echo $o_street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town/city</td>
												<td><input type="text" class="form-control text-uppercase" name="o_vill" value="<?php echo $o_vill; ?>"></td>
												<td>block</td>
												<td><input type="text" class="form-control text-uppercase" name="o_block" value="<?php echo $o_block; ?>"></td>
											</tr>
											<tr>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase" name="o_dist"  value="<?php echo $o_dist; ?>"></td>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" name="o_pin" value="<?php echo $o_pin; ?>"></td>									
											</tr>
											<tr>										
												<td>Mobile No.</td>
												<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="o_mobile_no" value="<?php echo $o_mobile_no; ?>"></td>
												<td>E-Mail ID</td>
												<td><input type="email" class="form-control" name="o_email" value="<?php echo $o_email; ?>"></td>
											</tr>	
											<tr>
												<td colspan="4">4. Name, Designation and Qualification of person in-charge of the clinical establishment: <span class="mandatory_field">*</span></td>
											</tr>
											<tr>
												<td colspan="4">
													<table name="objectTable1" id="objectTable1"  class="table table-responsive table-bordered">
													<thead>
														<tr>
															<th width="10%" align="center">Sl no</th>
															<th width="10%" align="center">Name</th>
															<th width="10%" align="center">Designation</th>
															<th width="10%" align="center">Qualification</th>
															<th width="10%" align="center">Registration Number</th>
															<th width="15%" align="center">Name of Central/State Council(with which registered)</th>
															<th width="15%" align="center">Mobile</th>
															<th width="20%" align="center">E-mail ID</th>
														</tr>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'") or die("Error : ".$health->error);
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tbody>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $count; ?>" required="required" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["name"]; ?>" class="form-control text-uppercase" validate="letter" title="No special characters are allowed except Dot" requried="requried" id="txtB<?php echo $count;?>" name="txtB<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["designation"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" requried="requried" ></td>				
														<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtD<?php echo $count;?>" requried="requried" class="form-control text-uppercase" name="txtD<?php echo $count;?>"validate="decimal"  requried="requried" ></td>
														<td><input class="form-control text-uppercase" value="<?php echo $row_1["reg_no"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["name_of_central"]; ?>" id="txtF<?php echo $count;?>" requried="requried" class="form-control text-uppercase" name="txtF<?php echo $count;?>" ></td>	
														<td><input value="<?php echo $row_1["mobile"]; ?>" id="txtG<?php echo $count;?>" requried="requried" validate="mobileNumber"  maxlength="10" class="form-control text-uppercase" name="txtG<?php echo $count;?>" ></td>													
														 <td><input value="<?php echo $row_1["email"]; ?>" id="txtH<?php echo $count;?>" requried="requried" class="form-control" name="txtH<?php echo $count;?>" ></td>	
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" readonly="readonly"  id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" required="required"   title="No special characters are allowed except Dot" validate="letter" class="form-control text-uppercase" name="txtB1"></td>
														<td><input  id="txtC1" required="required"  class="form-control text-uppercase" name="txtC1"></td>
														<td><input id="txtD1" required="required" class="form-control text-uppercase" name="txtD1"></td>
														<td><input id="txtE1"  required="required"   class="form-control text-uppercase" name="txtE1"></td>
														<td><input  id="txtF1" required="required" class="form-control text-uppercase" name="txtF1"></td>
														<td><input id="txtG1" required="required"  validate="mobileNumber" maxlength="10" class="form-control text-uppercase" name="txtG1"></td>
														<td><input id="txtH1"  required="required"  class="form-control" name="txtH1"></td>
													</tr>
													<?php } ?>
													</tbody>											
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>	
										<tr>
												<td colspan="4">(From 5 to 8 mark all whichever are applicable)</td>
										</tr>
                                    <tr>
											<td>Location: </td>
											<td><select class="form-control text-uppercase" name="location_type" required="required">
											<option value="">Please Select</option>
											<option value="R" <?php if($location_type=="R") echo "selected";?>>Rural</option>
											<option value="M" <?php if($location_type=="M") echo "selected";?>>Metro</option>
											<option value="U" <?php if($location_type=="U") echo "selected";?>>Urban</option>
											<option value="N" <?php if($location_type=="N") echo "selected";?>>Notified / inaccessible areas (including Hilly / tribal areas)</option>
											</select></td>
											<td>Description</td>
											<td><select class="form-control text-uppercase" name="fees_description" required="required">
											<option value="">Please Select</option>
											
											<?php 
											$fees_query="select * from fees_details_urban";
											$fees_query_details=$formFunctions->executeQuery($dept,$fees_query);
										
											while($rows=$fees_query_details->fetch_object()){
												$s="";
												if( $fees_description==$rows->id ) $s="selected";
												echo '<option value="'. $rows->id .'" '.$s.'>'. $rows->fees_description .'</option>';
											}
											?>
											</select>
											</td>
										 </tr>									
										<tr>
											<td colspan="4">5. Ownership of Services : </td>
										</tr>
										<tr>
												<td><u>Government/Public Sector</u> </td>
												<td colspan="3">
													<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_a=="C") echo "checked"; ?> name="ownership[a]" value="C">Central government&nbsp;&nbsp; </label> &nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_b=="S") echo "checked"; ?> name="ownership[b]" value="S">State government&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_c=="L") echo "checked"; ?> name="ownership[c]" value="L">Local government (Municipality, Zilla parishad, etc)  &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_d=="PS") echo "checked"; ?> name="ownership[d]" value="PS">Public Sector Undertaking&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_e=="O") echo "checked"; ?> name="ownership[e]" value="O">Other ministries and departments (Railways, Police, etc.) &nbsp;&nbsp; </label><br/><br/>
													<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_f=="E") echo "checked"; ?> name="ownership[f]" value="E">Employee State Insurance Corporation&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_g=="A") echo "checked"; ?> name="ownership[g]" value="A">Autonomous organization under Government&nbsp;&nbsp; </label>
												</td>
											</tr>	
											<tr>
												<td><u>Non-Government / Private Sector</u> </td>
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership2_a=="I") echo "checked"; ?> name="ownership2[a]" value="I">Individual Proprietorship&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership2_b=="P") echo "checked"; ?> name="ownership2[b]" value="P">Partnership&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership2_c=="R") echo "checked"; ?> name="ownership2[c]" value="R">Registered companies (registered under central/provincial/state Act) &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership2_d=="S") echo "checked"; ?> name="ownership2[d]" value="S">Society/trust (Registered under central/provincial/state Act)&nbsp;&nbsp; </label>
												</td>
											</tr>
											<tr>
												<td>6. System of Medicine: (please tick whichever is applicable) </td>
												<td colspan="3">										
													<label class="checkbox-inline"><input type="checkbox" <?php if($system_a=="A") echo "checked"; ?> name="system[a]" value="A">Allopathy&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($system_b=="AY") echo "checked"; ?> name="system[b]" value="AY">Ayurveda&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($system_c=="U") echo "checked"; ?> name="system[c]" value="U">Unani &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($system_d=="S") echo "checked"; ?> name="system[d]" value="S">Siddha&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($system_e=="H") echo "checked"; ?> name="system[e]" value="H">Homoeopathy &nbsp;&nbsp; </label><br/><br/>
													<label class="checkbox-inline"><input type="checkbox" <?php if($system_f=="Y") echo "checked"; ?> name="system[f]" value="Y">Yoga&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($system_g=="N") echo "checked"; ?> name="system[g]" value="N">Naturopathy&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($system_h=="SR") echo "checked"; ?> name="system[h]" value="SR">Sowa-Rigpa&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
											</tr>
											<tr>
												<td>7. Type of Clinical Services: </td>
												<td colspan="3">										
													<label class="checkbox-inline"><input type="checkbox" <?php if($clinical_a=="G") echo "checked"; ?> name="clinical[a]" value="G">General&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($clinical_b=="S") echo "checked"; ?> name="clinical[b]" value="S">Single Specialty&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($clinical_c=="M") echo "checked"; ?> name="clinical[c]" value="M">Multi Specialty &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($clinical_d=="SUS") echo "checked"; ?> name="clinical[d]" value="SUS">Super Specialty&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
											</tr>
											<tr>
												<td></td>
												<td>Any other (please specify):</td>
												<td><input type="text" class="form-control text-uppercase" name="clinical[any_other]" value="<?php echo $clinical_any_other;?>"></td>
												<td></td>
											</tr>
											<tr>
											   <td colspan="4">8. Type of Clinical Establishment: (please tick whichever is applicable)</td>
											</tr>
											<tr>
												<td>(a)</td>
												<td colspan="3">										
													<label class="checkbox-inline"><input type="checkbox" <?php if($clinical_est_a=="I") echo "checked"; ?> name="clinical_est[a]" value="I">Inpatient&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($clinical_est_b=="O") echo "checked"; ?> name="clinical_est[b]" value="O">Outpatient&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($clinical_est_c=="L") echo "checked"; ?> name="clinical_est[c]" value="L">Laboratory&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($clinical_est_d=="IM") echo "checked"; ?> name="clinical_est[d]" value="IM">imaging&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
											</tr>
											<tr>
												<td></td>
												<td>Any other (please specify):</td>
												<td><input type="text" class="form-control text-uppercase" name="clinical_est[any_other]" value="<?php echo $clinical_est_any_other;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td>(b) <u>i) Inpatient:</u> </td>
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($inpatient_a=="H") echo "checked"; ?> name="inpatient[a]" value="H">Hospital&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($inpatient_b=="NH") echo "checked"; ?> name="inpatient[b]" value="NH">Nursing Home&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($inpatient_c=="MH") echo "checked"; ?> name="inpatient[c]" value="MH">Maternity Home (Municipality, Zilla parishad, etc)  &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($inpatient_d=="S") echo "checked"; ?> name="inpatient[d]" value="S">Sanatorium&nbsp;&nbsp; </label><br/><br/>
												<label class="checkbox-inline"><input type="checkbox" <?php if($inpatient_e=="PC") echo "checked"; ?> name="inpatient[e]" value="PC">Palliative Care  &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($inpatient_f=="PHC") echo "checked"; ?> name="inpatient[f]" value="PHC">Primary Health Centre&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($inpatient_g=="CHC") echo "checked"; ?> name="inpatient[g]" value="CHC">Community Health Centre &nbsp;&nbsp; </label>
												
												</td>
											</tr>
											<tr>
												<td></td>
												<td>Any other (please specify):</td>
												<td><input type="text" class="form-control text-uppercase"  name="inpatient[any_other]" value="<?php echo $inpatient_any_other;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td><u>ii) Number of Beds:</u></td>
												<td><input type="text" class="form-control text-uppercase" name="no_bed"  value="<?php echo $no_bed;?>"></td>
												<td colspan="3">
											</tr>
											<tr>
												<td><u>iii) Outpatient:</u> </td>
												<td colspan="3">
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_a=="SP") echo "checked"; ?> name="outpatient[a]" value="SP">Single practitioner&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_b=="D") echo "checked"; ?> name="outpatient[b]" value="D">Dispensary&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_c=="P") echo "checked"; ?> name="outpatient[c]" value="P">Polyclinic &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_d=="DC") echo "checked"; ?> name="outpatient[d]" value="DC">Dental Clinic&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_e=="PO") echo "checked"; ?> name="outpatient[e]" value="PO">Physiotherapy / Occupational Therapy Clinic  &nbsp;&nbsp; </label><br/><br/>
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_f=="IC") echo "checked"; ?> name="outpatient[f]" value="IC">Infertility Clinic&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_g=="DC") echo "checked"; ?> name="outpatient[g]" value="DC">Dialysis Centre&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_h=="DCC") echo "checked"; ?> name="outpatient[h]" value="DCC">Day Care centre&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_i=="SC") echo "checked"; ?> name="outpatient[i]" value="SC">Sub-Centre  &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="checkbox-inline"><input type="checkbox" <?php if($outpatient_j=="MC") echo "checked"; ?> name="outpatient[j]" value="MC">Mobile Clinic&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
											</tr>
											<tr>
												<td></td>
												<td width="25%">Any other (please specify):</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="outpatient[any_other]" value="<?php echo $outpatient_any_other;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td><u>iv) Laboratory:</u> </td>
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($laboratory_a=="P") echo "checked"; ?> name="laboratory[a]" value="P">Pathology&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($laboratory_b=="H") echo "checked"; ?> name="laboratory[b]" value="H">Haematology&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($laboratory_c=="B") echo "checked"; ?> name="laboratory[c]" value="B">Biochemistry &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($laboratory_d=="M") echo "checked"; ?> name="laboratory[d]" value="M">Microbiology&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($laboratory_e=="G") echo "checked"; ?> name="laboratory[e]" value="G">Genetics  &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
											</tr>
											<tr>
												<td></td>
												<td width="25%">Any other (please specify):</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="laboratory[any_other]" value="<?php echo $laboratory_any_other;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td><u>v) Imaging Centre:</u> </td>
										
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($imaging_center_a=="X") echo "checked"; ?> name="imaging_center[a]" value="X">X ray&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($imaging_center_b=="ECG") echo "checked"; ?> name="imaging_center[b]" value="ECG">Electro Cardio Graph (ECG)&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($imaging_center_c=="U") echo "checked"; ?> name="imaging_center[c]" value="U">Ultrasound&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($imaging_center_d=="CT") echo "checked"; ?> name="imaging_center[d]" value="CT">CT Scan&nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($imaging_center_e=="MRI") echo "checked"; ?> name="imaging_center[e]" value="MRI">Magnetic Resonance Imaging (MRI) &nbsp;&nbsp; </label>&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
											</tr>
											<tr>
												<td></td>
												<td width="25%">Any other (please specify):</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="imaging_center[any_other]" value="<?php echo $imaging_center_any_other;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td><u>vi) Any other (please specify):</u> </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="any_other"  value="<?php echo $any_other;?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby declare that the statements made above are correct and true to the best of my knowledge. I shall abide by all the provisions of the Clinical Establishments (Registration and Regulation) Act, 2010 and the rules made there under. I shall intimate to the District Registering Authority, any change in the particulars given above.</td>
											</tr>
											<tr>
											   <td>Date:</td>
												<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
												<td>Signature of the Owner/Person in charge</td>
												<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td>Place:</td>
												<td>
													<label disabled class="form-control text-uppercase" ><?php echo $dist; ?></label>
												</td>
												<td></td>
												<td></td>								
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
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
