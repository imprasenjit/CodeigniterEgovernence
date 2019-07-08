<?php  require_once "../../requires/login_session.php"; 
$dept="doa";
$form="22";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form1.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
		 $results=$p->fetch_assoc();
          $form_id=$results['form_id'];
		##### part 1 ######	
	    $name_concern=$results["name_concern"];
		$relevant_detail=$results["relevant_detail"];
		$is_renewal=$results["is_renewal"];
		$fertilizer_type=$results["fertilizer_type"];
		
		if(!empty($results["sale"])){
			$sale=json_decode($results["sale"]);
			$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_d=$sale->d;$sale_p=$sale->p;$sale_mno=$sale->mno;
		}else{
			$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
		}
		if(!empty($results["storage"])){
			$storage=json_decode($results["storage"]);
			$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_d=$storage->d;$storage_p=$storage->p;$storage_mno=$storage->mno;
		}else{
			$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
		}
		
		if(!empty($results["manufac_importer"])){
				$manufac_importer=json_decode($results["manufac_importer"]);
				if(isset($manufac_importer->a)) $manufac_importer_a=$manufac_importer->a; else $manufac_importer_a="";
				if(isset($manufac_importer->b)) $manufac_importer_b=$manufac_importer->b; else $manufac_importer_b="";
				if(isset($manufac_importer->c)) $manufac_importer_c=$manufac_importer->c; else $manufac_importer_c="";
				if(isset($manufac_importer->d)) $manufac_importer_d=$manufac_importer->d; else $manufac_importer_d="";
				if(isset($manufac_importer->e)) $manufac_importer_e=$manufac_importer->e; else $manufac_importer_e="";
			}else{
				$manufac_importer_a="";$manufac_importer_b="";$manufac_importer_c="";$manufac_importer_d="";$manufac_importer_e="";
				 
			}
		
	}else{		 
		$form_id="";
		##### part 1 ######
		$name_concern="";
		$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
		$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";$relevant_detail="";$is_renewal="";$manufac_importer_a="";$manufac_importer_b="";$manufac_importer_c="";$manufac_importer_d="";$manufac_importer_e="";$fertilizer_type="";
	  }
		
}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		##### part 1 ######	
		$name_concern=$results["name_concern"];
		$relevant_detail=$results["relevant_detail"];
		$is_renewal=$results["is_renewal"];
		$fertilizer_type=$results["fertilizer_type"];
		
		if(!empty($results["sale"])){
			$sale=json_decode($results["sale"]);
			$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_d=$sale->d;$sale_p=$sale->p;$sale_p=$sale->p;$sale_mno=$sale->mno;
		}else{
			$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
		}
		if(!empty($results["storage"])){
			$storage=json_decode($results["storage"]);
			$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_d=$storage->d;$storage_p=$storage->p;$storage_mno=$storage->mno;
		}else{
			$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
		}
		
		if(!empty($results["manufac_importer"])){
				$manufac_importer=json_decode($results["manufac_importer"]);
				if(isset($manufac_importer->a)) $manufac_importer_a=$manufac_importer->a; else $manufac_importer_a="";
				if(isset($manufac_importer->b)) $manufac_importer_b=$manufac_importer->b; else $manufac_importer_b="";
				if(isset($manufac_importer->c)) $manufac_importer_c=$manufac_importer->c; else $manufac_importer_c="";
				if(isset($manufac_importer->d)) $manufac_importer_d=$manufac_importer->d; else $manufac_importer_d="";
				if(isset($manufac_importer->e)) $manufac_importer_e=$manufac_importer->e; else $manufac_importer_e="";
			}else{
				$manufac_importer_a="";$manufac_importer_b="";$manufac_importer_c="";$manufac_importer_d="";$manufac_importer_e="";
				 
			}
		
    }
#### PART II #####
	$q2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_part1 where form_id='$form_id'");
	if($q2->num_rows<1){
		$p1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_part1 where form_id='$form_id' ORDER BY form_id DESC LIMIT 1");
		if($p1->num_rows>0){
		 $results2=$p1->fetch_assoc();
		 
			$is_micro_nutrient=$results2["is_micro_nutrient"];
			$period_validity=$results2["period_validity"];$is_applicant=$results2["is_applicant"];
			$is_corner=$results2["is_corner"];
			
			
			if(!empty($results2["particulars"])){
				$particulars=json_decode($results2["particulars"]);
				$particulars_speci=$particulars->speci;$particulars_certi=$particulars->certi;
			}else{
				$particulars_speci="";$particulars_certi="";
			}
			if(!empty($results2["applicant"])){
				$applicant=json_decode($results2["applicant"]);
				$applicant_quantity1=$applicant->quantity1;$applicant_quantity2=$applicant->quantity2;$applicant_quantity3=$applicant->quantity3;$applicant_situation=$applicant->situation;
			}else{
				$applicant_quantity1="";$applicant_quantity2="";$applicant_quantity3="";$applicant_situation="";
			}
			if(!empty($results2["fertilisers"])){
				$fertilisers=json_decode($results2["fertilisers"]);
				$fertilisers_nm=$fertilisers->nm;$fertilisers_sn1=$fertilisers->sn1;$fertilisers_sn2=$fertilisers->sn2;$fertilisers_v=$fertilisers->v;$fertilisers_d=$fertilisers->d;$fertilisers_p=$fertilisers->p;$fertilisers_mno=$fertilisers->mno;
			}else{
				$fertilisers_nm="";$fertilisers_sn1="";$fertilisers_sn2="";$fertilisers_v="";$fertilisers_d="";$fertilisers_p="";$fertilisers_mno="";
			}
		 
		}else{			
			$is_corner="";$is_applicant="";$is_micro_nutrient="";$period_validity="";$particulars_speci="";$particulars_certi="";$applicant_quantity1="";$applicant_quantity2="";$applicant_quantity3="";$applicant_situation="";$fertilisers_nm="";$fertilisers_sn1="";$fertilisers_sn2="";$fertilisers_v="";$fertilisers_d="";$fertilisers_p="";$fertilisers_mno="";
		}
			
	}else{		
			$results2=$q2->fetch_assoc();
			$is_micro_nutrient=$results2["is_micro_nutrient"];
			$period_validity=$results2["period_validity"];$is_applicant=$results2["is_applicant"];
			$is_corner=$results2["is_corner"];
			
			if(!empty($results2["particulars"])){
				$particulars=json_decode($results2["particulars"]);
				$particulars_speci=$particulars->speci;$particulars_certi=$particulars->certi;
			}else{
				$particulars_speci="";$particulars_certi="";
			}
			if(!empty($results2["applicant"])){
				$applicant =json_decode($results2["applicant"]);
				$applicant_quantity1=$applicant->quantity1;$applicant_quantity2=$applicant->quantity2;$applicant_quantity3=$applicant->quantity3;$applicant_situation=$applicant->situation;
			}else{
				$applicant_quantity1="";$applicant_quantity2="";$applicant_quantity3="";$applicant_situation="";
			}
			if(!empty($results2["fertilisers"])){
				$fertilisers=json_decode($results2["fertilisers"]);
				$fertilisers_nm=$fertilisers->nm;$fertilisers_sn1=$fertilisers->sn1;$fertilisers_sn2=$fertilisers->sn2;$fertilisers_v=$fertilisers->v;$fertilisers_d=$fertilisers->d;$fertilisers_p=$fertilisers->p;$fertilisers_mno=$fertilisers->mno;
			}else{
				$fertilisers_nm="";$fertilisers_sn1="";$fertilisers_sn2="";$fertilisers_v="";$fertilisers_d="";$fertilisers_p="";$fertilisers_mno="";
			}
			
		}
	
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	$tabbtn5 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 7 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
		$tabbtn5 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
		$tabbtn5 = "";
	}
	if ($showtab == 5) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "active";
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
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a  href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a  href="#table3">PART III</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">		
									<tr>
										<td colspan="4">To<br/>
										&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority ,<br/><br/>
										 <select class="form-control" style="width:300px" name="office_id" required>
                                        <option value="">Please Select</option>
										<?php
										$rows = $formFunctions->getOffices($dept);
                                        foreach($rows as $key => $values ){
											if($values["id"]!=6 && $values["id"]!=1){
												$jurisdiction = $values["jurisdiction"];
												$jurisdiction_array = explode(",",$jurisdiction); 
												//print_r($jurisdiction_array);echo "<br/><br/>";
												if(in_array(strtoupper($b_dist),$jurisdiction_array)){
													$address = $values["street1"]." ".$values["street2"].", ".$values["district"]." - ".$values["pin"];
													echo '<option value="'.$values["id"].'">'.$values["office_name"].', '.$address.'</option>';
												}												
											}												
										}
										?>											
									</select>
										<br/></td>
									</tr>
									<tr>
										 <td colspan="4"></td>
									</tr>
									<tr>
										<td width="25%"></td>
										<td width="25%">Select Type of Fertilizer</td>
										<td width="25%">
											<label class="radio-inline"><input type="radio" name="fertilizer_type" value="G"  <?php if(isset($fertilizer_type) && $fertilizer_type=='G') echo 'checked'; ?> required="required" /> General</label>
											<label class="radio-inline"><input type="radio" name="fertilizer_type"  value="O"  <?php if(isset($fertilizer_type) && $fertilizer_type=='O') echo 'checked'; ?>/> Others </label>
										</td>
										<td width="25%"></td>
									</tr>
									<!--<tr>
										 <td width="25%"></td>
										 <td width="25%"></td>
										 <td colspan="2">
											<div id="other_fertizers">
												<label class="checkbox-inline"><input type="checkbox" value="PHYSICAL" name="fertilizer_description">PHYSICAL</label><br/>
												<label class="checkbox-inline"><input type="checkbox" value="GRANULATED" name="fertilizer_description">GRANULATED</label><br/>
												<label class="checkbox-inline"><input type="checkbox" value="SPECIAL MIXTURE OF FERTHLISER" name="fertilizer_description">SPECIAL MIXTURE OF FERTHLISER</label><br/>
												<label class="checkbox-inline"><input type="checkbox" value="ORGANIC FERTHLISER" name="fertilizer_description">ORGANIC FERTHLISER</label><br/>
												<label class="checkbox-inline"><input type="checkbox" value="BIOFERTILISER" name="fertilizer_description">BIOFERTILISER</label><br/>
											</div>											
										</td>
									</tr>--->					
									<tr>
										 <td colspan="4"></td>
									</tr>								
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
							</form>
							</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="general_fertilizer" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
								<tr>
									    <td>1. Details of the application :</td>
								</tr>
								<tr>
									   <td width="25%">(a) Name of the applicant :</td>
									   <td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									   <td width="25%">(b) Name of the concern :</td>
									   <td width="25%"><input type="text" name="name_concern" value="<?php echo $name_concern; ?>" class="form-control text-uppercase"></td>		
								</tr>
								<tr>
									 <td colspan="4">(c) Address with telephone number :</td>				 
								</tr>
								<tr>
									<td width="25%">Street name 1 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									<td width="25%">Street name 2 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>	
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
									<td>District :</td>
									<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
									<td>Mobile No. :</td>
									<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id :</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td></td>
									<td></td>									
								</tr>
								<tr>
									<td colspan="4">2. Place of business (Please give full address ) : </td>
								</tr>
								<tr>
									<td colspan="4"> i. For sale  : </td>
								</tr>
								<tr>
									<td> Street Name 1  :</td>
									<td><input type="text" class="form-control text-uppercase" name="sale[sn1]" value="<?php echo $sale_sn1;?>" /></td>
									<td> Street Name 2 :</td>
									<td><input type="text" class="form-control text-uppercase" name="sale[sn2]" value="<?php echo $sale_sn2;?>" /></td>
								</tr>
								<tr>
									<td> Village/ Town :</td>
									<td><input type="text" class="form-control text-uppercase" name="sale[v]" value="<?php echo $sale_v;?>"/></td>
									<td>District :<span class="mandatory_field">*</span></td>
                                    <td><input type="text" class="form-control text-uppercase" name="sale[d]" id="sale_d" value="<?php echo $sale_d;?>"/></td>
									
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" class="form-control text-uppercase"  name="sale[p]" validate="pincode" maxlength="6" value="<?php echo $sale_p;?>"></td>
									<td>Mobile No. :</td>
									<td><input type="text" name="sale[mno]" validate="mobileNumber" maxlength="10" value="<?php echo $sale_mno; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td colspan="4">  ii. For Storage : </td>
								</tr>
								<tr>
									<td> Street Name 1  :</td>
									<td><input type="text" class="form-control text-uppercase" name="storage[sn1]" value="<?php echo $storage_sn1;?>" /></td>
									<td> Street Name 2 :</td>
									<td><input type="text" class="form-control text-uppercase" value="<?php echo $storage_sn2;?>" name="storage[sn2]" /></td>
								</tr>
								<tr>
									<td> Village/ Town :</td>
									<td><input type="text" class="form-control text-uppercase"  name="storage[v]" value="<?php echo $storage_v;?>" /></td>
									<td>District :<span class="mandatory_field">*</span></td>
                                    <td><input type="text" class="form-control text-uppercase"  name="storage[d]" id="storage_d" value="<?php echo $storage_d;?>" /></td>
									
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" validate="pincode" maxlength="6" value="<?php echo $storage_p; ?>" class="form-control text-uppercase" name="storage[p]"></td>
									<td>Mobile No. :</td>
									<td><input validate="mobileNumber" maxlength="10"   type="text" name="storage[mno]" value="<?php echo $storage_mno; ?>" class="form-control"></td>
								</tr>
								<tr>
								   <td>3. Whether the application is for - </td>
									<td colspan="3">
									<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_a=="M") echo "checked"; ?> name="manufac_importer[a]" value="M">Manufacturer&nbsp;&nbsp; </label></br>
									<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_b=="I") echo "checked"; ?> name="manufac_importer[b]" value="I">Importer&nbsp;&nbsp; </label></br>
									<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_c=="P") echo "checked"; ?> name="manufac_importer[c]" value="P">Pool Handling Agency  &nbsp;&nbsp; </label></br>
									<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_d=="W") echo "checked"; ?> name="manufac_importer[d]" value="W">Wholesale Dealer&nbsp;&nbsp; </label></br>
									<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_e=="R") echo "checked"; ?> name="manufac_importer[e]" value="R">Retail Dealer&nbsp;&nbsp; </label></br>
									</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
										<td colspan="4">4. Details of fertilizer and their source in Form "O" 
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="20%">Sl. No.</th>
													<th width="40%">Name of fertilizer</th>
													<th width="40%">Whether certificate of source in Form 'O' is attached</th>
													
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
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["fertilizer"]; ?>" name="txtB<?php echo $count;?>"  size="10"></td>
															<td><input id="txtC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["is_certificate"]; ?>" name="txtC<?php echo $count;?>"  placeholder="YES/NO"></td>
														</tr>	
													<?php $count++; } 
													}else{	
														$i=1; ?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														
														<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
                                                  <td><input id="txtC1" size="10" class="form-control text-uppercase" name="txtC1" placeholder="YES/NO"></td>														
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
											</div>
										</td>
								</tr>
								<tr>
									<td colspan="3">5. Whether the intimation is for an authorization letter or a renewal thereof . ( Note: In case the intimation is for renewal of authorization letter, the acknowledgment in From A2 should submitted for necessary endorsement thereon.)</td>
									<td><label class="radio-inline"><input type="radio" name="is_renewal" required="required" class="is_renewal" value="Y"  <?php if(isset($is_renewal) && $is_renewal=='Y') echo 'checked'; ?> /> Yes</label>
									<label class="radio-inline"><input type="radio" class="is_renewal"  value="N"  name="is_renewal" <?php if(isset($is_renewal) && ($is_renewal=='N' || $is_renewal=='')) echo 'checked'; ?>/> No</label></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>6. Any other relevant information. :</td>
									<td><textarea class="form-control text-uppercase" name="relevant_detail"><?php echo $relevant_detail;?></textarea></td>
									<td></td>
									<td></td>
								</tr>
								<table class="table table-responsive table-bordered">
									<tr>
										<td><u>Declaration</u></td>
									</tr>
									<tr>
										<td colspan="3">(a) I have deposited the prescribed registration certificate fee / renewal fee.</td>
										
									</tr>
									<tr>
										<td colspan="3">(c) I/We have carefully read the terms and conditions of the certificate of the manufacture given in From F appended to the Fertiliser ( Control ) Order , 1985 and agree to abide by them.</td>
									</tr>
									<tr>
										<td colspan="3">(d) I/We declare that the physical/granulated/special mixture of fertiliser/organic
										fertiliser/biofertiliser for which certificate of manufacture is applied for shall be
										prepared by me/us or by a person having such qualifications as may be prepared by the
										State Government from time to time or by any other person under my/our direction,
										supervision and control or under the direction ,supervision and control or person
										having the said qualification.
									</tr>
									<tr>
										<td colspan="3">(e) I/We declare that the requisite laboratory facility specified by the controller, under this Order is possessed by me/us.</td>
									</tr>
									<tr>
										<td colspan="3">(f) In case of special mixtures of fertilisers.</td>
									</tr>
								</table>
								<table class="table table-responsive table-bordered">
								<tr>
									<td>
										Place :&nbsp;<b><?php echo strtoupper($dist); ?></b><br/>
										Date :&nbsp;<b><?php echo date('d-m-Y',strtotime($today)); ?></b> 
									</td>
									<td></td>
									<td></td>
									<td align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>Designation : <strong><?php echo strtoupper($status_applicant); ?></strong></td>
								</tr>
                             </table>
							 <table class="table table-responsive table-bordered">
								<tr>										
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back &amp; Edit</a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
									</td>									
								</tr>
							 </table>
							 </table>
							</form>
							</div>
							<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" class="submit1" id="other_fertilizer" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
							<table class="table table-responsive table-bordered">
								<tr>
									   <td width="25%">The Registering Authority<br/>Government of Assam</td>
									   <td width="25%"></td>
									   <td width="25%">Place :</td>
									   <td width="25%"><label disabled class="form-control text-uppercase"><?php echo $dist; ?></label></td>								
								</tr>
								<tr>
									<td width="25%">1. i. Name of the applicant :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									<td width="25%"></td>
									<td width="25%"></td>		
								</tr>
								<tr>
									 <td colspan="4">ii. Postal address of the applicant :</td>				 
								</tr>
								<tr>
									<td width="25%">Street name 1 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									<td width="25%">Street name 2 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>	
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
									<td>District :</td>
									<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
									<td>Mobile No. :</td>
									<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id :</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td></td>
									<td></td>									
								</tr>		
								<tr>
										<td>(2) Does applicant possess the qualification prescribed by the state Government under sub -clause (1) of clause 14 of the Fertiliser (Control) Order 1985.</td>
										<td><label class="radio-inline"><input type="radio" name="is_applicant" class="is_applicant" value="Y"  <?php if(isset($is_applicant) && $is_applicant=='Y') echo 'checked'; ?> /> Yes</label>
									    <label class="radio-inline"><input type="radio" class="is_applicant"  value="N"  name="is_applicant" <?php if(isset($is_applicant) && ($is_applicant=='N' || $is_applicant=='')) echo 'checked'; ?>/> No</label></td>
										<td>(3). Is the applicant a new corner? (yes or no)</td>
										<td><label class="radio-inline"><input type="radio" name="is_corner" class="is_corner" value="Y"  <?php if(isset($is_corner) && $is_corner=='Y') echo 'checked'; ?> /> Yes</label>
									    <label class="radio-inline"><input type="radio" class="is_corner"  value="N"  name="is_corner" <?php if(isset($is_corner) && ($is_corner=='N' || $is_corner=='')) echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td>(4). Situation of the applicant's premises where physical/ granulated/ special mixture of fentilisers organic fertiliser/ biofertiliser will be prepared :</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant[situation]" value="<?php echo $applicant_situation;?>"></td>
									    <td>(5) Full particulars regarding specifications of the physical/ granulated /special mixture of fertilisers/organic fertliser /biofertiliser for which in the certificate is required and the raw materials used in making the mixture.</td>
									    <td><textarea class="form-control text-uppercase" name="particulars[speci]"><?php echo $particulars_speci;?></textarea></td>
								   </tr>
									
									<tr>
										<td width="25%">(6). Full particulars of any other certificate of manufacture , if any issued by any other Registering Authority:</td>
										<td><textarea class="form-control text-uppercase" name="particulars[certi]"><?php echo $particulars_certi;?></textarea></td>
										<td width="25%">(7). How long has the applicant been carrying on the business of preparing physical/granulated/special mixture of fertilisers/ organic fertiliser /bio fertiliser / mixture of micro nutrient fertilisers?</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="is_micro_nutrient" value="<?php echo $is_micro_nutrient;?>"></td>
									</tr>
									<tr>
										<td width="25%">(8). Quantities of each physical /granulated /special mixture of fertilisers mixture of fertilisers mixture of micro nutrient fertilisers/ organic fertilisers/ biofertilisers(in tonnes) in any /our possession on the date of the application and held at different addresses noted against each;</td>
										<td><textarea class="form-control text-uppercase" name="applicant[quantity1]"><?php echo $applicant_quantity1;?></textarea></td>
										<td width="25%">9. (i) If the applicant has been carrying on the business of preparing physical /granulated/special mixtures of fertilisers/mixture of microelectronic fertilisers /organic fertilisers/ mixture of particulars of such mixtures handled the period and the place (s) of which the mixing of fetilisers was done:</td>
										<td><textarea class="form-control text-uppercase" name="applicant[quantity2]"><?php echo $applicant_quantity2;?></textarea></td>
									</tr>
								<tr>
										<td>(ii) Also give the quantities of physical/granulated/ special mixture of fertiliser /organic fertiliser/biofertiliser handled during the past calendar years:</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant[quantity3]" value="<?php echo $applicant_quantity3;?>"></td>
										<td>10 If the application is for indicate briefly why the original certificate could not be acted on within the period of its validity :</td>
										<td><input type="text" class="form-control text-uppercase" name="period_validity" value="<?php echo $period_validity;?>"></td>
								</tr>
								<tr>
									  <td colspan="2">11.In case of special mixture of fertilisers (Name and address of the person requiring the special mixture of fertilisers) :</td>
							   </tr>
							   
								<tr>
									<td width="25%">1. i. Name of the person :</td>
									<td><input type="text" class="form-control text-uppercase" validate="letters" name="fertilisers[nm]" value="<?php echo $fertilisers_nm;?>" /></td>	
								</tr>
								<tr>
									 <td colspan="4">ii.Address of the person :</td>				 
								</tr>
								<tr>
									 <td> Street Name 1  :</td>
									 <td><input type="text" class="form-control text-uppercase" name="fertilisers[sn1]" value="<?php echo $fertilisers_sn1;?>" /></td>
									<td> Street Name 2 :</td>
									<td><input type="text" class="form-control text-uppercase"  name="fertilisers[sn2]" value="<?php echo $fertilisers_sn2;?>" /></td>
								</tr>
								<tr>
									<td> Village/ Town :</td>
									<td><input type="text" class="form-control text-uppercase"   name="fertilisers[v]" value="<?php echo $fertilisers_v;?>"/></td>
									<td>District :<span class="mandatory_field">*</span></td>
									<td><input type="text" class="form-control text-uppercase"   name="fertilisers[d]" value="<?php echo $fertilisers_d;?>"/></td>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" class="form-control text-uppercase"  name="fertilisers[p]" validate="pincode" maxlength="6" value="<?php echo $fertilisers_p;?>"></td>
									<td>Mobile No. :</td>
									<td><input type="text" name="fertilisers[mno]" validate="mobileNumber" maxlength="10" value="<?php echo $fertilisers_mno; ?>" class="form-control"></td>
								</tr>
								<table class="table table-responsive table-bordered">
									<tr>
										<td><u>Declaration</u></td>
									</tr>
									<tr>
										<td colspan="3">(a) I have deposited the prescribed registration certificate fee / renewal fee.</td>
										
									</tr>
									<tr>
										<td colspan="3">(c) I/We have carefully read the terms and conditions of the certificate of the manufacture given in From F appended to the Fertiliser ( Control ) Order , 1985 and agree to abide by them.</td>
									</tr>
									<tr>
										<td colspan="3">(d) I/We declare that the physical/granulated/special mixture of fertiliser/organic
										fertiliser/biofertiliser for which certificate of manufacture is applied for shall be
										prepared by me/us or by a person having such qualifications as may be prepared by the
										State Government from time to time or by any other person under my/our direction,
										supervision and control or under the direction ,supervision and control or person
										having the said qualification.
									</tr>
									<tr>
										<td colspan="3">(e) I/We declare that the requisite laboratory facility specified by the controller, under this Order is possessed by me/us.</td>
									</tr>
									<tr>
										<td colspan="3">(f) In case of special mixtures of fertilisers.</td>
									</tr>
								</table>
								<table class="table table-responsive table-bordered">
								<tr>
									<td>
										Place :&nbsp;<b><?php echo strtoupper($dist); ?></b><br/>
										Date :&nbsp;<b><?php echo date('d-m-Y',strtotime($today)); ?></b> 
									</td>
									<td></td>
									<td></td>
									<td align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>Designation : <strong><?php echo strtoupper($status_applicant); ?></strong></td>
								</tr>
                             </table>
                             <table class="table table-responsive table-bordered">							 
								<tr>										
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back &amp; Edit</a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
									</td>									
								</tr>
								</table>
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
	$('.capitalInv').on('change', function(){
		var sum1=0;
		$('.capitalInv').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum1 = sum1 + parseInt($(this).val());
			}
			$('#capitalInvTotal').val(sum1);
		});		
	});
	$('.financeSource').on('change', function(){
		var sum2=0;
		$('.financeSource').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum2 = sum2 + parseInt($(this).val());
			}
			$('#financeSourceTotal').val(sum2);
		});		
	});
	
	$("#other_fertizers").hide();
	$('input[name="fertilizer_type"]').on('change', function(){
		var val=$(this).val();
		if(val=="O"){
			$("#other_fertizers").show();
		}else{
			$("#other_fertizers").hide();
		}	
	});
	

	/* ----------------------------------------------------- */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>