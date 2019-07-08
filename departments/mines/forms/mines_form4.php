<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="4";
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
			$form_id=$results["form_id"];$profession=$results["profession"];$minerals=$results["minerals"];$prospect=$results["prospect"];$nature=$results["nature"];$coal=$results["coal"];$manner=$results["manner"];
			
			if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;$applicant_non_indian=$applicant->non_indian;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}			
			if(!empty($results["is_grant"])){
				$is_grant=json_decode($results["is_grant"]);
				$is_grant_a=$is_grant->a;$is_grant_b=$is_grant->b;
			}else{				
				$is_grant_a="";$is_grant_b="";
			}		
			if(!empty($results["is_carried"])){
				$is_carried=json_decode($results["is_carried"]);
				$is_carried_a=$is_carried->a;$is_carried_b=$is_carried->b;
			}else{				
				$is_carried_a="";$is_carried_b="";
			}					
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
			}				
			if(!empty($results["licence"])){
				$licence=json_decode($results["licence"]);
				$licence_a=$licence->a;$licence_b=$licence->b;$licence_c=$licence->c;$licence_d=$licence->d;
			}else{				
				$licence_a="";$licence_b="";$licence_c="";$licence_d="";
			}					
			if(!empty($results["situation"])){
				$situation=json_decode($results["situation"]);
				$situation_a=$situation->a;$situation_b=$situation->b;$situation_c=$situation->c;$situation_d=$situation->d;$situation_e=$situation->e;$situation_f=$situation->f;$situation_g=$situation->g;$situation_h=$situation->h;
			}else{				
				$situation_a="";$situation_b="";$situation_c="";$situation_d="";$situation_e="";$situation_f="";$situation_g="";$situation_h="";
			}					
			if(!empty($results["parameters"])){
				$parameters=json_decode($results["parameters"]);
				$parameters_a=$parameters->a;$parameters_b=$parameters->b;$parameters_c=$parameters->c;$parameters_d=$parameters->d;$parameters_e=$parameters->e;
			}else{				
				$parameters_a="";$parameters_b="";$parameters_c="";$parameters_d="";$parameters_e="";
			}					
			if(!empty($results["mine"])){
				$mine=json_decode($results["mine"]);
				$mine_a=$mine->a;$mine_b=$mine->b;$mine_c=$mine->c;$mine_d=$mine->d;
			}else{				
				$mine_a="";$mine_b="";$mine_c="";$mine_d="";
			}					
			if(!empty($results["country"])){
				$country=json_decode($results["country"]);
				$country_a=$country->a;$country_b=$country->b;$country_c=$country->c;
			}else{				
				$country_a="";$country_b="";$country_c="";
			}					
			if(!empty($results["resources"])){
				$resources=json_decode($results["resources"]);
				$resources_a=$resources->a;$resources_b=$resources->b;
			}else{				
				$resources_a="";$resources_b="";
			}					
			if(!empty($results["captive"])){
				$captive=json_decode($results["captive"]);
				$captive_a=$captive->a;$captive_b=$captive->b;
			}else{				
				$captive_a="";$captive_b="";
			}					
			if(!empty($results["person"])){
				$person=json_decode($results["person"]);
				$person_a=$person->a;$person_b=$person->b;$person_c=$person->c;
			}else{				
				$person_a="";$person_b="";$person_c="";
			}					
			if(!empty($results["foreign_people"])){
				$foreign_people=json_decode($results["foreign_people"]);
				$foreign_people_a=$foreign_people->a;$foreign_people_b=$foreign_people->b;
			}else{				
				$foreign_people_a="";$foreign_people_b="";
			}					
			if(!empty($results["app_resources"])){
				$app_resources=json_decode($results["app_resources"]);
				$app_resources_a=$app_resources->a;$app_resources_b=$app_resources->b;
			}else{				
				$app_resources_a="";$app_resources_b="";
			}					
			if(!empty($results["feasibility"])){
				$feasibility=json_decode($results["feasibility"]);
				$feasibility_a=$feasibility->a;$feasibility_b=$feasibility->b;
			}else{				
				$feasibility_a="";$feasibility_b="";
			}
		}else{
			$form_id="";$profession="";$permit="";$minerals="";$prospect="";$nature="";$coal="";$manner="";
			$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";$applicant_non_indian="";
			$period_from_dt="";$period_to_dt="";
			$particulars_a="";$particulars_b="";$particulars_c="";
			$is_grant_a="";$is_grant_b="";
			$situation_a="";$situation_b="";$situation_c="";$situation_d="";$situation_e="";$situation_f="";$situation_g="";$situation_h="";
			$is_carried_a="";$is_carried_b="";
			$licence_a="";$licence_b="";$licence_c="";$licence_d="";
			$parameters_a="";$parameters_b="";$parameters_c="";$parameters_d="";$parameters_e="";
			$mine_a="";$mine_b="";$mine_c="";$mine_d="";
			$resources_a="";$resources_b="";
			$person_a="";$person_b="";$person_c="";
			$foreign_people_a="";$foreign_people_b="";
			$country_a="";$country_b="";$country_c="";
			$captive_a="";$captive_b="";
			$app_resources_a="";$app_resources_b="";
			$feasibility_a="";$feasibility_b="";
		}
	}else{
            $results=$q->fetch_array();			
			$form_id=$results["form_id"];$profession=$results["profession"];$minerals=$results["minerals"];$prospect=$results["prospect"];$nature=$results["nature"];$coal=$results["coal"];$manner=$results["manner"];
			
			if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;$applicant_non_indian=$applicant->non_indian;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}			
			if(!empty($results["is_grant"])){
				$is_grant=json_decode($results["is_grant"]);
				$is_grant_a=$is_grant->a;$is_grant_b=$is_grant->b;
			}else{				
				$is_grant_a="";$is_grant_b="";
			}		
			if(!empty($results["is_carried"])){
				$is_carried=json_decode($results["is_carried"]);
				$is_carried_a=$is_carried->a;$is_carried_b=$is_carried->b;
			}else{				
				$is_carried_a="";$is_carried_b="";
			}					
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
			}				
			if(!empty($results["licence"])){
				$licence=json_decode($results["licence"]);
				$licence_a=$licence->a;$licence_b=$licence->b;$licence_c=$licence->c;$licence_d=$licence->d;
			}else{				
				$licence_a="";$licence_b="";$licence_c="";$licence_d="";
			}					
			if(!empty($results["situation"])){
				$situation=json_decode($results["situation"]);
				$situation_a=$situation->a;$situation_b=$situation->b;$situation_c=$situation->c;$situation_d=$situation->d;$situation_e=$situation->e;$situation_f=$situation->f;$situation_g=$situation->g;$situation_h=$situation->h;
			}else{				
				$situation_a="";$situation_b="";$situation_c="";$situation_d="";$situation_e="";$situation_f="";$situation_g="";$situation_h="";
			}					
			if(!empty($results["parameters"])){
				$parameters=json_decode($results["parameters"]);
				$parameters_a=$parameters->a;$parameters_b=$parameters->b;$parameters_c=$parameters->c;$parameters_d=$parameters->d;$parameters_e=$parameters->e;
			}else{				
				$parameters_a="";$parameters_b="";$parameters_c="";$parameters_d="";$parameters_e="";
			}					
			if(!empty($results["mine"])){
				$mine=json_decode($results["mine"]);
				$mine_a=$mine->a;$mine_b=$mine->b;$mine_c=$mine->c;$mine_d=$mine->d;
			}else{				
				$mine_a="";$mine_b="";$mine_c="";$mine_d="";
			}					
			if(!empty($results["country"])){
				$country=json_decode($results["country"]);
				$country_a=$country->a;$country_b=$country->b;$country_c=$country->c;
			}else{				
				$country_a="";$country_b="";$country_c="";
			}					
			if(!empty($results["resources"])){
				$resources=json_decode($results["resources"]);
				$resources_a=$resources->a;$resources_b=$resources->b;
			}else{				
				$resources_a="";$resources_b="";
			}					
			if(!empty($results["captive"])){
				$captive=json_decode($results["captive"]);
				$captive_a=$captive->a;$captive_b=$captive->b;
			}else{				
				$captive_a="";$captive_b="";
			}					
			if(!empty($results["person"])){
				$person=json_decode($results["person"]);
				$person_a=$person->a;$person_b=$person->b;$person_c=$person->c;
			}else{				
				$person_a="";$person_b="";$person_c="";
			}					
			if(!empty($results["foreign_people"])){
				$foreign_people=json_decode($results["foreign_people"]);
				$foreign_people_a=$foreign_people->a;$foreign_people_b=$foreign_people->b;
			}else{				
				$foreign_people_a="";$foreign_people_b="";
			}					
			if(!empty($results["app_resources"])){
				$app_resources=json_decode($results["app_resources"]);
				$app_resources_a=$app_resources->a;$app_resources_b=$app_resources->b;
			}else{				
				$app_resources_a="";$app_resources_b="";
			}					
			if(!empty($results["feasibility"])){
				$feasibility=json_decode($results["feasibility"]);
				$feasibility_a=$feasibility->a;$feasibility_b=$feasibility->b;
			}else{				
				$feasibility_a="";$feasibility_b="";
			}	
			
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
	}
	##PHP TAB management ends
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
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part 2</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1. Name of the applicant with complete address. :</td>
											<td width="25%">&nbsp;</td>
											<td width="25%">Applicant Name:</td>
											<td width="25%"><input type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td colspan="4">Complete Address :</td>
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
											<td>Status of the applicant :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $status_applicant; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>2. Is the applicant a private individual/co-operative/firm/association/private company/ public company/public sector undertaking/joint sector undertaking or any other :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $Type_of_ownership; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">3. In case applicant is :</td>
										</tr>
										<tr>
											<td>(a) An individual, his nationality, qualifications and experience relating to mining. :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant[nation]" value="<?php echo $applicant_nation; ?>"></td>
											<td>(b) A company, an attested copy of the certificate of registration of the company shall be enclosed. :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant[reg_number]"  value="<?php echo $applicant_reg_number; ?>"></td>
										</tr>
										<tr>
											<td>(c) Firm or Association, the nationality of all the partners of the firm or members of the association, and :</td>
											<td><input type="text" class="form-control text-uppercase"  name="applicant[firm_asso]" value="<?php echo $applicant_firm_asso; ?>" /></td>
											<td>(d) A co-operative the nationality of non-Indian members, if any along with place of registration and a copy of the certificate of registration. :</td>
											<td><input type="text" class="form-control text-uppercase"  name="applicant[non_indian]" value="<?php echo $applicant_non_indian; ?>" /></td>
										</tr>
										<tr>
											<td>4. Profession or nature of business of applicant :</td>
											<td><input type="text" class="form-control text-uppercase" name="profession" value="<?php echo $profession; ?>"></td>
											<td>5. Mineral or minerals which the applicant intends to prospect :</td>
											<td><input type="text" class="form-control text-uppercase" name="minerals"  value="<?php echo $minerals; ?>"></td>
										</tr>
										<tr>
											<td>6. Period for which mining lease is required Datet From :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[from_dt]" placeholder="Form Date" value="<?php echo $period_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[to_dt]" placeholder="To Date" value="<?php echo $period_to_dt; ?>"></td>
										</tr>
										<tr>
										<td>7. Extent of the area the applicant wants to prospect :</td>
											<td><input type="text" class="form-control text-uppercase" name="prospect" value="<?php echo $prospect; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">8. Details of the area in respect of which mining lease is required :
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="10%">District</th>
													<th width="15">Taluq</th>
													<th width="15%">Village</th>
													<th width="15%">Khasra No.</th>
													<th width="10%">Plot No.</th>
													<th width="15%">Area</th>
													<th width="15%">Ownership-Occupancy</th>
												</tr>
												</thead> 
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["dist"]; ?>" validate="specialChar" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_1["taluq"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["village"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["khasra_no"]; ?>" id="txtE<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["plot_no"]; ?>" id="txtF<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtF<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["area"]; ?>" id="txtG<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtG<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["owner"]; ?>" id="txtH<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtH<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>	
														<td><input id="txtE1" size="10"   class="form-control text-uppercase" name="txtE1"></td>	
														<td><input id="txtF1" size="10"   class="form-control text-uppercase" name="txtF1"></td>	
														<td><input id="txtG1" size="10"   class="form-control text-uppercase" name="txtG1"></td>	
														<td><input id="txtH1" size="10"   class="form-control text-uppercase" name="txtH1"></td>	
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td colspan="4">9. Brief description of the area with particular reference to the following :</td>
									</tr>
									<tr>
										<td colspan="3">Does the applicant have surface rights over the area for which he is making an application for grant of a mining lease?</td>
										<td><label class="radio-inline"><input type="radio" name="is_grant[a]" class="is_grant_a" value="Y"  <?php if(isset($is_grant_a) && $is_grant_a=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" class="is_grant_a"  value="N"  name="is_grant[a]" <?php if(isset($is_grant_a) && ($is_grant_a=='N' || $is_grant_a=='')) echo 'checked'; ?>/> No</label>
									</tr>
									<tr>
										<td colspan="3">If not, has he obtained the consent of the owner, and the occupier of the land for undertaking mining operation? If so, the consent of the owner and occupier of the land be obtained in writing and be filed :</td>
										<td><input  type="text" name="is_grant[b]" id="is_grant_b" value="<?php echo $is_grant_b; ?>" class="form-control text-uppercase"></td>
									</tr>
										<tr>
											<td colspan="3">10.(a) The situation of the area in respect of natural features such as streams or lakes :</td>
											<td><input type="text" name="situation[a]" value="<?php echo $situation_a; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td width="25%" colspan="4">(b) In the case of village areas, :</td>
										</tr>
										<tr>
											<td width="25%">(i)The name of the village :</td>
											<td width="25%"><input type="text" name="situation[b]" value="<?php echo $situation_b; ?>" class="form-control text-uppercase"></td>
											<td>(ii)The Khasra number :</td>
											<td><input type="text" name="situation[c]"  value="<?php echo $situation_c; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="2">(iii)The area in hectares of each field or part thereof applied for :</td>
											<td><input type="text" name="situation[d]"  value="<?php echo $situation_d; ?>" class="form-control text-uppercase"></td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="4">(c)In case the area applied for is under forest, then the following particulars are given :</td>
										</tr>
										<tr>
											<td>(i)Forest division, Block and Range :</td>
											<td><input type="text" name="situation[e]"  value="<?php echo $situation_e; ?>" class="form-control text-uppercase"></td>
											<td>(ii)Legal status of the forest (namely reserved, protected, unclassified etc.) :</td>
											<td><input type="text" name="situation[f]"  value="<?php echo $situation_f; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>(iii)Whether it forms part of a National Park or Wild-life Sanctuary :</td>
											<td><input type="text" name="situation[g]"  value="<?php echo $situation_g; ?>" class="form-control text-uppercase"></td>
											<td>(iv)Type and extent of vegetation in the area :</td>
											<td><input type="text" name="situation[h]"  value="<?php echo $situation_h; ?>" class="form-control text-uppercase"></td>
										</tr>														
									<tr>										
										  <td class="text-center" colspan="4">
										  <button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
										</td>									
									</tr>
									</table>
									</form> 
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										
										<tr>
											<td colspan="4">11. Particulars of the area mineral-wise in each State duly supported by an affidavit for which the applicant or any person joint in interest with him. :</td>
										</tr>
										<tr>
											<td width="25%">1. Already holds under reconnaissance permit :</td>
											<td width="25%"><input type="text" name="particulars[a]" value="<?php echo $particulars_a; ?>" class="form-control text-uppercase"></td>
											<td width="25%">2. Has already applied for but not granted :</td>
											<td width="25%"><input type="text" name="particulars[b]" value="<?php echo $particulars_b; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>3. being applied for simultaneously :</td>
											<td><input type="text" name="particulars[c]"  value="<?php echo $particulars_c; ?>" class="form-control text-uppercase"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>12. Nature of joint interest, if any :</td>
											<td><textarea class="form-control text_uppercase" name="nature"><?php echo $nature;?></textarea></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2">13. (a) Does the applicant hold a prospecting licence over the area mentioned at (xi) above?  </td>		
											<td colspan="2"><label class="radio-inline"><input type="radio" name="licence[a]" class="licence_a" value="Y"  <?php if(isset($licence_a) && $licence_a=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_grant_a"  value="N"  name="licence[a]" <?php if(isset($licence_a) && ($licence_a=='N' || $licence_a=='')) echo 'checked'; ?>/> No</label></td>
										</tr>
										<tr>
											<td colspan="4" class="form-inline">If yes, mention its Number&nbsp;&nbsp;&nbsp;<input  type="text" name="licence[b]" id="licence_b" value="<?php echo $licence_b; ?>" class="form-control text-uppercase">&nbsp;&nbsp;&nbsp; Date of grant&nbsp;&nbsp;<input  type="text" name="licence[c]"  id="licence_c" value="<?php echo $licence_c; ?>" class="dob form-control text-uppercase">&nbsp;&nbsp;&nbsp;and the Date of expiry&nbsp;&nbsp;<input  type="text" name="licence[d]" id="licence_d"  value="<?php echo $licence_d; ?>" class="dob form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="3">(b)Has the applicant carried out the prospecting operations over the area held under prospecting licence and sent his report to the State Government, as required by rule 16 of the Mineral Concession Rules, 1960? </td>
											<td>
											<label class="radio-inline"><input type="radio" name="is_carried[a]" class="is_carried_a" value="Y"  <?php if(isset($is_carried_a) && $is_carried_a=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_carried_a"  value="N"  name="is_carried[a]" <?php if(isset($is_carried_a) && ($is_carried_a=='N' || $is_carried_a=='')) echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td colspan="2">If not, state reasons for not doing so :</td>
											<td colspan="2"><input  type="text" name="is_carried[b]" id="is_carried_b" value="<?php echo $is_carried_b; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="4">14.	Broad parameters of the mineral/ore body/bodies. :</td>
										</tr>
										<tr>
											<td>(i)Strike length, average width and dip :</td>
											<td><input type="text" name="parameters[a]" value="<?php echo $parameters_a; ?>" class="form-control text-uppercase" ></td>
											<td>(ii)Wall rocks on hanging and foot wall sides :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $parameters_b; ?>" name="parameters[b]" ></td>
										</tr>
										<tr>
											<td colspan="3">(iii)Whether area is considerably disturbed geologically or is comparatively free of geological disturbance? (Copy of geological map of the area is to be attached.) :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $parameters_c; ?>" name="parameters[c]" ></td>
										</tr>
										<tr>
											<td colspan="3">(iv)Reserves assessed with their grade(s) (chemical analysis reports of representative samples are to be attached) :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $parameters_d; ?>" name="parameters[d]" ></td>
										</tr>
										<tr>
											<td colspan="3">Whether the area is virgin? If not, the extent to which it has already been worked, in case there are old workings, their locations are to be shown on the geological map of the area :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $parameters_e; ?>" name="parameters[e]" ></td>
										</tr>
										<tr>
											<td>15. Broad parameters of the mine. :</td>
											<td colspan="2">&nbsp;&nbsp;(a)Proposed date of commencement of the mining operations. :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $mine_a; ?>" name="mine[a]" ></td>
										</tr>
										<tr>
											<td colspan="4">(b) Proposed rate of mineral production during the first 5 years (year-wise). (Take count from field iv) :
											<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="40%">Name of minerals</th>
													<th width="50" colspan="5">Years</th>
												</tr>
												<tr>
													<th width="10%"></th>
													<th width="40%"></th>
													<th width="10">Y1</th>
													<th width="10%">Y2</th>
													<th width="10%">Y3</th>
													<th width="10%">Y4</th>
													<th width="10%">Y5</th>
												</tr>
												</thead>
												<?php
													$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
													$num = $part2->num_rows;
													if($num>0){
													  $count=1;
													  while($row_2=$part2->fetch_array()){	?>
														<tr>
															<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" name="textB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_2["y1"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["y2"]; ?>" id="textD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textD<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["y3"]; ?>" id="textE<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textE<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["y4"]; ?>" id="textF<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textF<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["y5"]; ?>" id="textG<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textG<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
														<td><input id="textC1" size="10"   class="form-control text-uppercase" name="textC1"></td>	
														<td><input id="textD1" size="10"   class="form-control text-uppercase" name="textD1"></td>	
														<td><input id="textE1" size="10"   class="form-control text-uppercase" name="textE1"></td>	
														<td><input id="textF1" size="10"   class="form-control text-uppercase" name="textF1"></td>	
														<td><input id="textG1" size="10"   class="form-control text-uppercase" name="textG1"></td>	
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
									</tr>
										<tr>
											<td colspan="4">(c) Proposed rate of production when mine is fully developed.
											<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="45%">Name of Mineral</th>
													<th width="45">Annual Return</th>
												</tr>
												</thead>
												<?php
													$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
													$num= $part3->num_rows;
													if($num>0){
													  $count=1;
													  while($row_3=$part3->fetch_array()){	?>
														<tr>
															<td><input readonly id="ttxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="ttxtA<?php echo $count;?>" size="1"></td>
															<td><input id="ttxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["name"]; ?>"  name="ttxtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_3["annual"]; ?>" id="ttxtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="ttxtC<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="ttxtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="ttxtA1"></td>
														<td><input id="ttxtB1" size="10"  class="form-control text-uppercase" name="ttxtB1"></td>
														<td><input id="ttxtC1" size="10"   class="form-control text-uppercase" name="ttxtC1"></td>	
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
										</td>
									</tr>
										<tr>
											<td>(d) Anticipated life of the mine :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $mine_b; ?>" name="mine[b]" ></td>
											<td>(e) Proposed method of mining :</td>
											<td><select class="form-control text-uppercase" name="mine[c]" >
													<option value="disabled">Select Option</option>
													<option value="Underground" <?php if($mine_c=="Underground") echo "selected";?> >Underground</option>
													<option value="Opencast" <?php if($mine_c=="Opencast") echo "selected";?> >Opencast</td>
												</select></td>
										</tr>
										<tr>
											<td colspan="2">1. If underground, the method of approach to the deposit mineral/ore whether through inclines or shafts.</td>
											<td colspan="2">2. If opencast, the over-burden to ore ratio and overall pit stope.</td>
										</tr>
										<tr>
											<td colspan="3">(f) Nature of the land chosen for dumping over burden/waste and tailings (that is type of land whether agricultural, grazing land, barren, saline land etc.) and whether proposed site has been shown on the mine working plan. Give also the extent of area in hectares set apart for dumping of waste and tailings :</td>
											<td><textarea name="mine[d]" class="form-control text-uppercase"><?php echo $mine_d; ?></textarea> </td>
										</tr>
										<tr>
											<td colspan="2">16. Manner in which the mineral raised is to be utilised. :</td>
											<td><select class="form-control text-uppercase" name="manner" >
											<option value="disabled">Please Select</option>
											<option value="Indian" <?php if($manner=="Indian") echo "selected";?> >Within India</option>
											<option value="NotIndian" <?php if($manner=="NotIndian") echo "selected";?>>Outside India</option>
											</select></td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td >(a) (i) If for captive use, the location of plant and industry :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $captive_a; ?>" name="captive[a]" ></td>
											<td >(ii) For sale for indigenous consumption :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $captive_b; ?>" name="captive[b]" ></td>
										</tr>
										<tr>
											<td colspan="3">(b) If for exports to foreign countries indicate,<br/>(i) Names of the countries to which it is likely to be exported where the mine is being set up on 100% export oriented or tied-up basis :</td>
											<td><textarea name="foreign_people[a]" class="form-control text-uppercase"><?php echo $foreign_people_a; ?></textarea> </td>
										</tr>
										<tr>
											<td colspan="3">(ii) Whether mineral will be exported in raw form or after processing. Also indicate the stage of processing, whether intermediate stage or final stage of the end-product :</td>
											<td><textarea name="foreign_people[b]" class="form-control text-uppercase"><?php echo $foreign_people_b; ?></textarea> </td>
										</tr>
										<tr>
											<td colspan="4">(c) If it is to be used within the country, indicate :</td>
										</tr>
										<tr>
											<td >(i) The industry/industries in which it would be used :</td>
											<td><input type="text" name="country[a]" class="form-control text-uppercase" value="<?php echo $country_a; ?>"/> </td>
											<td >(ii) Whether it will be supplied in raw form or after processing (crushing/grinding/ beneficiation/ calcining) :</td>
											<td><input type="text" name="country[b]" class="form-control text-uppercase" value="<?php echo $country_b; ?>"/> </td>
										</tr>
										<tr>
											<td colspan="3">(iii) Whether it would need upgradation and if so, whether it is proposed to set up beneficiation plant. Also indicate the capacity of such plant and the time by which it would be set up :</td>
											<td><input type="text" name="country[c]" class="form-control text-uppercase" value="<?php echo $country_c; ?>"/> </td>
										</tr>
										<tr>
											<td colspan="3">(d) In case of coal, or other high bulk minerals/ores details of existing railway transport facility available and additional transport facility, if any, required :</td>
											<td><textarea name="coal" class="form-control text-uppercase"><?php echo $coal; ?></textarea> </td>
										</tr>
										<tr>
											<td >17. (i). Name of the technical person :</td>
											<td ><input type="text" class="form-control text-uppercase" name="person[a]" value="<?php echo $person_a;?>"/></td>
											<td >(ii). Qualification :</td>
											<td><input type="text" name="person[b]" class="form-control text-uppercase" value="<?php echo $person_b; ?>"/> </td>
										</tr>
										<tr>
											<td >(iii). Experience of the Technical Personnel available for supervising the mines :</td>
											<td><input type="text" name="person[c]" class="form-control text-uppercase" value="<?php echo $person_c; ?>"/> </td>
											<td ></td>
											<td></td>
										</tr>
										<tr>
											<td >18. (i) Financial resources of the applicant :</td>
											<td><input type="text" name="app_resources[a]" class="form-control text-uppercase" value="<?php echo $app_resources_a; ?>"/> </td>
											<td >(ii) Anticipated yearly financial investment during the course of mine construction and aggregate investment upto the stage of commencement of commercial production :</td>
											<td><textarea name="app_resources[b]" class="form-control text-uppercase"><?php echo $app_resources_b; ?></textarea> </td>
										</tr>
										<tr>
											<td colspan="3">19. (a) Nature of waste water, (e.g. whether acidic). If so, expected pH value :</td>
											<td ><input type="text" class="form-control text-uppercase" name="feasibility[a]" value="<?php echo $feasibility_a?>"/></td>
										</tr>
										<tr>
											<td colspan="3">(b) The application form should be accompanied by a statement of the salient features of the scheme of mining. This should be generally on the lines of the &quot;Project at a Glance&quot; given in a mining feasibility report including features relating to the protection of environment :</td>
											<td><textarea name="feasibility[b]" class="form-control text-uppercase"><?php echo $feasibility_b; ?></textarea> </td>
										</tr>
										<tr>
											<td>Date :</td>
											<td><label ><?php echo $today;?></label></td>
											<td>Signature of the Applicant</td>
											<td><strong><?php echo strtoupper($key_person)?></strong></td>
										</tr>
										<tr>
											<td>Place :</td>
											<td><label ><?php echo $dist;?></label></td>
											<td>Designation of the Applicant</td>
											<td><strong><?php echo strtoupper($key_person)?></strong></td>
										</tr>	  
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>
									</tr>
									</table>
								</form>
								</div>
					
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
	$('#offlinePayDetials').hide();
	$(document).ready(function(){
		$('input[name="payment_mode"]').on('change', function(){
			if($(this).val() == 0){						
				$('#offlinePayDetials').show("fast");						
			}else{
				$('#offlinePayDetials').hide("slow");
			}	
			
		});
	});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
$('#licence_b').attr('readonly','readonly');
	<?php if($licence_a == 'Y') echo "$('#licence_b').removeAttr('readonly','readonly');"; ?>
	$('.licence_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#licence_b').removeAttr('readonly','readonly');
		}else{
			$('#licence_b').attr('readonly','readonly');
			$('#licence_b').val('');
		}			
	});
$('#licence_c').attr('readonly','readonly');
	<?php if($licence_a == 'Y') echo "$('#licence_c').removeAttr('readonly','readonly');"; ?>
	$('.licence_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#licence_c').removeAttr('readonly','readonly');
		}else{
			$('#licence_c').attr('readonly','readonly');
			$('#licence_c').val('');
		}			
	});	
    $('#licence_d').attr('readonly','readonly');
	<?php if($licence_a == 'Y') echo "$('#licence_d').removeAttr('readonly','readonly');"; ?>
	$('.licence_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#licence_d').removeAttr('readonly','readonly');
		}else{
			$('#licence_d').attr('readonly','readonly');
			$('#licence_d').val('');
		}			
	});	
$('#is_carried_b').attr('readonly','readonly');
	<?php if($is_carried_a == 'Y') echo "$('#is_carried_b').removeAttr('readonly','readonly');"; ?>
	$('.is_carried_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_carried_b').removeAttr('readonly','readonly');
		}else{
			$('#is_carried_b').attr('readonly','readonly');
			$('#is_carried_b').val('');
		}			
	});
$('#is_grant_b').attr('readonly','readonly');
	<?php if($is_grant_a == 'Y') echo "$('#is_grant_b').removeAttr('readonly','readonly');"; ?>
	$('.is_grant_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_grant_b').removeAttr('readonly','readonly');
		}else{
			$('#is_grant_b').attr('readonly','readonly');
			$('#is_grant_b').val('');
		}			
	});
	

</script>