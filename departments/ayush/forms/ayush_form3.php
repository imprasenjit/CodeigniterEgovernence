<?php  require_once "../../requires/login_session.php"; 
$dept="ayush";
$form="3";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
	
   
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	if($q->num_rows<1){
		$p1=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p1->num_rows>0){
			$results=$p1->fetch_assoc();
			$form_id=$results['form_id'];
			$dec1=$results['dec1'];
			//tab2//
			if(!empty($results["premises_convicted"])){
				$premises_convicted=json_decode($results["premises_convicted"]);
				$premises_convicted_a=$premises_convicted->a;
			}else{
				$premises_convicted_a="";
			}
			if(!empty($results["licensing_authority"])){
				$licensing_authority=json_decode($results["licensing_authority"]);
				$licensing_authority_b=$licensing_authority->b;
			}else{
				$licensing_authority_b="";
			}
			
			$business_carried=$results["business_carried"];$is_license=$results["is_license"];$is_engaged=$results["is_engaged"];$is_engaged_det=$results["is_engaged_det"];$business_crri=$results["business_crri"];$license_yr=$results["license_yr"];$licenses_granted=$results["licenses_granted"];$is_rejected=$results["is_rejected"];$is_rejected_det=$results["is_rejected_det"];$is_selling_goods=$results["is_selling_goods"];$is_spirituous_medicinal=$results["is_spirituous_medicinal"];$is_spirituous_medicinal_det=$results["is_spirituous_medicinal_det"];$is_license_previously=$results["is_license_previously"];$is_license_previously_det=$results["is_license_previously_det"];$is_agent_distributor=$results["is_agent_distributor"];$is_agent_distributor_det=$results["is_agent_distributor_det"];$rooms_storage=$results["rooms_storage"];$floor_area=$results["floor_area"];$room_sketch=$results["room_sketch"];$educational_qualifications=$results["educational_qualifications"];
			
			//tab3//
			if(!empty($results["drugs_stocked"])){
				$drugs_stocked=json_decode($results["drugs_stocked"]);
				$drugs_stocked_p=$drugs_stocked->p;$drugs_stocked_inj=$drugs_stocked->inj;$drugs_stocked_oral=$drugs_stocked->oral;$drugs_stocked_hous=$drugs_stocked->hous;$drugs_stocked_spirit=$drugs_stocked->spirit;
			}else{
				$drugs_stocked_p="";$drugs_stocked_inj="";$drugs_stocked_oral="";$drugs_stocked_hous="";$drugs_stocked_spirit="";
			}
			$spirits_village=$results["spirits_village"];$spirits_medicinal=$results["spirits_medicinal"];$hours_business=$results["hours_business"];$trade_association=$results["trade_association"];	
		
		}else{
			
			$form_id="";$dec1="";
			
			//tab2//
			$is_license="";
			$business_carried="";$educational_qualifications="";$is_engaged="";$is_engaged_det="";$business_crri="";$license_yr="";$licenses_granted="";$is_rejected="";$is_rejected_det="";$is_selling_goods="";$premises_convicted="";$is_spirituous_medicinal="";$is_spirituous_medicinal_det="";$is_spirituous_medicinal="";$is_spirituous_medicinal_det="";$is_license_previously="";$is_license_previously_det="";$is_agent_distributor ="";$is_agent_distributor_det="";$licensing_authority="";
			$rooms_storage="";$floor_area="";$room_sketch="";$premises_convicted_a="";$licensing_authority_b="";
			
			//tab=3//
			 $drugs_stocked_p="";$drugs_stocked_inj="";$drugs_stocked_oral="";$drugs_stocked_hous="";
			 $drugs_stocked_spirit=""; 
			 $spirits_village="";$spirits_medicinal="";$hours_business=""; $trade_association="";	
		}
	
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$dec1=$results['dec1'];
		//tab2//
		if(!empty($results["premises_convicted"])){
			$premises_convicted=json_decode($results["premises_convicted"]);
			$premises_convicted_a=$premises_convicted->a;
		}else{
			$premises_convicted_a="";
		}
		if(!empty($results["licensing_authority"])){
			$licensing_authority=json_decode($results["licensing_authority"]);
			$licensing_authority_b=$licensing_authority->b;
		}else{
			$licensing_authority_b="";
		}
		
		$business_carried=$results["business_carried"];$is_license=$results["is_license"];$is_engaged=$results["is_engaged"];$is_engaged_det=$results["is_engaged_det"];$business_crri=$results["business_crri"];$license_yr=$results["license_yr"];$licenses_granted=$results["licenses_granted"];$is_rejected=$results["is_rejected"];$is_rejected_det=$results["is_rejected_det"];$is_selling_goods=$results["is_selling_goods"];$is_spirituous_medicinal=$results["is_spirituous_medicinal"];$is_spirituous_medicinal_det=$results["is_spirituous_medicinal_det"];$is_license_previously=$results["is_license_previously"];$is_license_previously_det=$results["is_license_previously_det"];$is_agent_distributor=$results["is_agent_distributor"];$is_agent_distributor_det=$results["is_agent_distributor_det"];$rooms_storage=$results["rooms_storage"];$floor_area=$results["floor_area"];$room_sketch=$results["room_sketch"];$educational_qualifications=$results["educational_qualifications"];
		
		//tab3//
		if(!empty($results["drugs_stocked"])){
			$drugs_stocked=json_decode($results["drugs_stocked"]);
			$drugs_stocked_p=$drugs_stocked->p;$drugs_stocked_inj=$drugs_stocked->inj;$drugs_stocked_oral=$drugs_stocked->oral;$drugs_stocked_hous=$drugs_stocked->hous;$drugs_stocked_spirit=$drugs_stocked->spirit;
		}else{
			$drugs_stocked_p="";$drugs_stocked_inj="";$drugs_stocked_oral="";$drugs_stocked_hous="";$drugs_stocked_spirit="";
		}
		$spirits_village=$results["spirits_village"];$spirits_medicinal=$results["spirits_medicinal"];$hours_business=$results["hours_business"];$trade_association=$results["trade_association"];			
}

    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
	}
	##PHP TAB management ends
?>
<?php require_once "../../requires/header.php";   ?>
	  <?php include ("".$table_name."_Addmore.php"); ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">								
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">	
									<tr>
									
									   <td colspan="4">
										1. I/We &nbsp;&nbsp;<?php echo strtoupper($owner_names); ?> &nbsp;&nbsp;of &nbsp;&nbsp;<?php echo strtoupper($unit_name); ?>  &nbsp;&nbsp;Hereby apply for the grant/renewal of a license to manufacture Ayurvedic(including Siddha) or Unani drugs on the premises situated at &nbsp;&nbsp;<?php echo strtoupper($vill); ?>
										</td>
									</tr>
									<tr>
									<td colspan="4">2. Name of Drugs to be manufactured. :
										<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="45%">Name</th>
													<th width="45%">Details</th>
													
												</tr>
												</thead>
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["drugs_name"]; ?>" name="textB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_1["drugs_det"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
														<td><input id="textC1" size="10"   class="form-control text-uppercase" name="textC1"></td>	
														
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
								</tr>
								<tr>
									<td colspan="4">3. Names, Qualification and Experience of technical staff employed for manufacture and testing of Ayurvedic(including Siddha) or Unani Drugs. :
										<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="30%">Name</th>
													<th width="30%">Qualification</th>
													<th width="30%">Experience</th>
													
												</tr>
												</thead>
												<?php
													$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
													  $count=1;
													  while($row_2=$part2->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_2["qualification"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["experience"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>
																												
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
								</tr>
								<tr>
									<td colspan="4"><b>Declaration</b><span class="mandatory_field">*</span><br/></td>
								</tr>
								<tr>
								    <tr class="form-inline">
									<td colspan="4">1.I, <?php echo strtoupper($key_person); ?>, <?php echo strtoupper($status_applicant); ?>  hereby declare that the words "Ayurvedic/Unani/Proprietary medicine" shall be printed prominently one each label of Ayurvedic/Unani Medicine which will be manufactured by M/S. <?php echo strtoupper($unit_name); ?></td>
								</tr>
								<tr>
								   <tr class="form-inline">
									<td colspan="4">2. a. Certified that there is no resemblance of the product of M/S <?php echo strtoupper($unit_name); ?>.<br/>
									b. <input type="text" id="dec1" class="form-control text-uppercase" name="dec1" value="<?php echo $dec1; ?>" > With other drugs of any system of medicine and there is no drug in the market with the same name and also does not bear any resemblance to any other brand name.</td>
								</tr>
								<tr>
									<td colspan="4">3. Certified that I will abide by the D &amp; C Act., 1940 and D &amp; C Rules 1945 and I will not violate the DMR &amp; objectionable Advertisement Act. 1954 and I follow G.M.P. Guidelines.</td>
								</tr>
								
								<tr>
									<td colspan="4">4. Certified that, the information given in this application is true and correct to the best of my knowledge and I have not furnished any false information with a view to obtain Ayurvedic/Unani drug manufacturing license.</td>
								</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
							</table>
							</form>
							</div>
					       <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="my_form" id="my_form" class="submit1" method="post" ction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table  class="table table-responsive">
								<tr>
										<td colspan="4">1. Names of all partners of Directors, products,etc and full residential address of each :-</td>
									</tr>
									<tr>
										<td colspan="4">
										<table  class="table table-responsive">
										<thead>
											<tr>
										<th width="5%">Sl. No.</th>
										<th width="25%">Partners/Directors Name</th>
										<th width="20%">Street Name 1</th>
										<th width="15%">Street Name 2</th>
										<th width="15%">Village/Town</th>
										<th width="10%">District</th>
										<th width="10%">Pincode</th>
												
											</tr>
										</thead>	
										<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$ayush->error);
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>

											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->vill; ?>" /></td>
												<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->dist; ?>" /></td>
												<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pin; ?>" maxlength="6" validate="pincode" ></td>
												
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										
										</td>
										</tr>
										
										</table></td>
									</tr>
								
									<tr>
									   <td>2. What are the educational qualifications of the applicant (b) person in-charge of the premises for which license is applied for.</td>
									  <td><textarea  name="educational_qualifications" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $educational_qualifications; ?></textarea>255 Characters Only</td>
									  <td>3. What are the business carried on by the applicant within last three years ?</td>
									  <td><textarea  name="business_carried" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $business_carried; ?></textarea>255 Characters Only</td>
									</tr>
									 <tr>
										<td>4. Has the applicant ever engaged himself or on behalf of any other person in selling drugs any time prior to this application ?  </td>
									   <td>
										<label class="radio-inline"><input type="radio" name="is_engaged" class="is_engaged" value="Y"  <?php if(isset($is_engaged) && $is_engaged=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" class="is_engaged" name="is_engaged"  value="N"  <?php if(isset($is_engaged) && ($is_engaged=='N' || $is_engaged=='')) echo 'checked'; ?>/> No</label>
										</td>										
										<td>If so dates together with necessary documentary evidence may be supplied.</td>
										<td><textarea  name="is_engaged_det"  id="is_engaged_det" <?php if($is_engaged=='N' || $is_engaged=='') echo "readonly='readonly'"; ?> class="form-control text-uppercase" validate="textarea" ><?php echo $is_engaged_det; ?></textarea></td>
									</tr>
                                <tr>
									  <td>5. What other business is carried on by the applicant at present ?</td>
									  <td><textarea  name="business_crri" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $business_crri; ?></textarea>255 Characters Only</td>
								     <td>6. Is the application for fresh license or renewal? </td>
									 <td><label class="radio-inline"><input type="radio" name="is_license" id="is_license_y" <?php if($is_license=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" class="radio-inline" name="is_license" <?php if($is_license=="N" || $is_license=="") echo "checked"; ?> id="is_license_n" value="N"/> No</label></td>
								 </tr>
                             <tr>									
									<td>7. Year in which license was first granted :</td>
									<td><input type="text" name="license_yr" value="<?php echo $license_yr; ?>" class=" form-control"></td>
									<td>8. Particulars of licenses granted License No.from date of issue Drugs Rules.</td>
									<td><textarea  name="licenses_granted" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $licenses_granted; ?></textarea>255 Characters Only</td>
								</tr>	
								<tr>
										<td width="25%">9. Was the application ever rejected or license previously cancelled or surrendered ? </td>
									   <td width="25%">
										<label class="radio-inline"><input type="radio" name="is_rejected" class="is_rejected" value="Y"  <?php if(isset($is_rejected) && $is_rejected=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" class="is_rejected" name="is_rejected"  value="N"  <?php if(isset($is_rejected) && ($is_rejected=='N' || $is_rejected=='')) echo 'checked'; ?>/> No</label>
										</td>	
										<td width="25%"> If so what reason ? </td>
										<td width="25%"><textarea  name="is_rejected_det"  id="is_rejected_det" <?php if($is_rejected=='N' || $is_rejected=='') echo "readonly='readonly'"; ?> class="form-control text-uppercase" validate="textarea" ><?php echo $is_rejected_det; ?></textarea></td>
									</tr>	
                                <tr>
										<td>10. Was the applicant ever warned for selling goods which were not of standard quality ?</td>
									   <td>
										<label class="radio-inline"><input type="radio" name="is_selling_goods" class="is_selling_goods" value="Y"  <?php if(isset($is_selling_goods) && $is_selling_goods=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" class="is_selling_goods" name="is_selling_goods"  value="N"  <?php if(isset($is_selling_goods) && ($is_selling_goods=='N' || $is_selling_goods=='')) echo 'checked'; ?>/> No</label>
										</td>
									  <td>11. Was the applicant or any person employed by him on these premises ever convicted and sentenced under :-<span class="mandatory_field"> *</span></td>
									  <td><select name="premises_convicted[a]" required="required" class="form-control text-uppercase">
									  <option value='p_act1' <?php if($premises_convicted_a=='p_act1') echo "selected"; ?> >(a) Drugs Act, 1940.</option>
									  <option value='p_act2' <?php if($premises_convicted_a=='p_act2') echo "selected"; ?> >(b) Dangerous Drugs Act, 1930.</option>
									  <option value='p_act3' <?php if($premises_convicted_a=='p_act3') echo "selected"; ?> >(c) The Poisons Act, 1919.</option>
									  <option value='p_act4' <?php if($premises_convicted_a=='p_act4') echo "selected"; ?> >(d) The Pharmacy Act, 1948.</option>
									  <option value='p_act5' <?php if($premises_convicted_a=='p_act5') echo "selected"; ?> >(e) Any other Act.</option>
																										
									 </select>
									 </td>
									</tr>	
									<tr>
										<td>12.(A) Has the applicant ever imported spirituous Medicinal or toilet preparations from other states ? </td>
									   <td>
										<label class="radio-inline"><input type="radio" name="is_spirituous_medicinal" class="is_spirituous_medicinal" value="Y"  <?php if(isset($is_spirituous_medicinal) && $is_spirituous_medicinal=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" class="is_spirituous_medicinal" name="is_spirituous_medicinal"  value="N"  <?php if(isset($is_spirituous_medicinal) && ($is_spirituous_medicinal=='N' || $is_spirituous_medicinal=='')) echo 'checked'; ?>/> No</label>
										</td>	
										<td> If so a statement of the names of the manufacturers. </td>
										<td><textarea  name="is_spirituous_medicinal_det"  id="is_spirituous_medicinal_det" <?php if($is_spirituous_medicinal=='N' || $is_spirituous_medicinal=='') echo "readonly='readonly'"; ?> class="form-control text-uppercase" validate="textarea" ><?php echo $is_spirituous_medicinal_det; ?></textarea></td>
									</tr>
									<tr>
									  <td>OR</td>
									  <td></td>
									  <td></td>
									  <td></td>
									</tr>
									<tr>
										<td> (B) Was the application ever rejected or license previously cancelled or surrendered ? </td>
									   <td>
										<label class="radio-inline"><input type="radio" name="is_license_previously" class="is_license_previously" value="Y"  <?php if(isset($is_license_previously) && $is_license_previously=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" class="is_license_previously" name="is_license_previously"  value="N"  <?php if(isset($is_license_previously) && ($is_license_previously=='N' || $is_license_previously=='')) echo 'checked'; ?>/> No</label>
										</td>	
										<td> If so what reason ? </td>
										<td><textarea  name="is_license_previously_det"  id="is_license_previously_det" <?php if($is_license_previously=='N' || $is_license_previously=='') echo "readonly='readonly'"; ?> class="form-control text-uppercase" validate="textarea" ><?php echo $is_license_previously_det; ?></textarea></td>
									</tr>
                                <tr>
										<td>13. Is the applicant an agent or distributor of any drug manufacturing concern ?</td>
									   <td>
										<label class="radio-inline"><input type="radio" name="is_agent_distributor" class="is_agent_distributor" value="Y"  <?php if(isset($is_agent_distributor) && $is_agent_distributor=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" class="is_agent_distributor" name="is_agent_distributor"  value="N"  <?php if(isset($is_agent_distributor) && ($is_agent_distributor=='N' || $is_agent_distributor=='')) echo 'checked'; ?>/> No</label>
										</td>	
										<td>If so the area of distribution and date of appointment should be stated with full particulars. </td>
										<td><textarea  name="is_agent_distributor_det"  id="is_agent_distributor_det" <?php if($is_agent_distributor=='N' || $is_agent_distributor=='') echo "readonly='readonly'"; ?> class="form-control text-uppercase" validate="textarea" ><?php echo $is_agent_distributor_det; ?></textarea></td>
									</tr>
									<tr>
									  <td>The applicant shall inform the Licensing Authority if the agency is terminated any time during which the license in force.</td>
									</tr>
									<tr>
									  <td>14. Is the Firm or Company :-<span class="mandatory_field"> *</span></td>
									  <td><select name="licensing_authority[b]" required="required" class="form-control text-uppercase">
									  
									  <option value='Restaurant' <?php if($licensing_authority_b=='Restaurant') echo "selected"; ?> >(a) Restaurant</option>
									  <option value='Grocer' <?php if($licensing_authority_b=='Grocer') echo "selected"; ?> >(b) Grocer</option>
									  <option value='Panbidi_shop' <?php if($licensing_authority_b=='Panbidi_shop') echo "selected"; ?> >(c) Panbidi shop</option>
									  <option value='General_Marchant' <?php if($licensing_authority_b=='General_Marchant') echo "selected"; ?> >(d) General Marchant.</option>
									  <option value='Drug_Stores' <?php if($licensing_authority_b=='Drug_Stores') echo "selected"; ?> >(e) Drug Stores.</option>
									  <option value='Chemist_and_Druggist' <?php if($licensing_authority_b=='Chemist_and_Druggist') echo "selected"; ?> >(f) Chemist and Druggist</option>
									  <option value='Despensing_Chemist' <?php if($licensing_authority_b=='Despensing_Chemist') echo "selected"; ?> >(g) Despensing Chemist ?</option>
									  <option value='Distributing_Agency' <?php if($licensing_authority_b=='Distributing_Agency') echo "selected"; ?> >(h) Distributing Agency ?</option>
									  <option value='Commission_Agent' <?php if($licensing_authority_b=='Commission_Agent') echo "selected"; ?> >(i) Commission Agent ?</option>
									  <option value='Importer' <?php if($licensing_authority_b=='Importer') echo "selected"; ?> >(j) Importer ?</option>									
									 </select>
									 </td>
									 <td>15.(a) The applicant has in all rooms for storage and sale of drugs</td>
									<td><input type="text" class="form-control text-uppercase"  name="rooms_storage" value="<?php echo  $rooms_storage; ?>"></td>
								</tr>
								<tr>
								   <td>(b).The floor area in square feet of each room for storage and sale of drugs.</td>
									<td><input type="text" class="form-control text-uppercase"  name="floor_area" value="<?php echo  $floor_area; ?>"></td>
								   <td>(c).The floor area in square feet of each room must be given with a sketch.</td>
									<td><input type="text" class="form-control text-uppercase"  name="room_sketch" value="<?php echo  $room_sketch; ?>"></td>
								</tr>
								<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save and Next</button>
										</td>
									</tr>
								</table>
							</form>
							</div>
								
							<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform" class="submit1" id="myform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">	
							<table class="table table-responsive table-bordered">								
								<tr>
									<td colspan="4">16. The applicant does/does not stocker sell drugs at any other premises for which this application is applied for:-
										<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="30%">Address 1</th>
													<th width="30%">Address 2</th>
													<th width="30%">Address 3</th>
													
												</tr>
												</thead>
												<?php
													$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
													$num3 = $part3->num_rows;
													if($num3>0){
													  $count=1;
													  while($row_3=$part3->fetch_array()){	?>
														<tr>
															<td><input readonly id="txxxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="txxxtA<?php echo $count;?>" size="1"></td>
															<td><input id="txxxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["address_1"]; ?>" name="txxxtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_3["address_2"]; ?>" id="txxxtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txxxtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_3["address_3"]; ?>" id="txxxtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txxxtD<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txxxtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txxxtA1"></td>
														<td><input id="txxxtB1" size="10"  class="form-control text-uppercase" name="txxxtB1"></td>
														<td><input id="txxxtC1" size="10"   class="form-control text-uppercase" name="txxxtC1"></td>	
														<td><input id="txxxtD1" size="10"   class="form-control text-uppercase" name="txxxtD1"></td>
																												
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
										</td>
								       </tr>		
											<tr>
											   <td>17. What class of drugs are stocked sold or distributed :-</td>
											 </tr>
											 <tr>
											   <td width="25%">(a) Poisons</td>
											   <td width="25%"><input type="text" class="form-control text-uppercase"  name="drugs_stocked[p]" value="<?php echo  $drugs_stocked_p; ?>"></td>
											   <td width="25%">(b) Injections</td>
											   <td width="25%"><input type="text" class="form-control text-uppercase"  name="drugs_stocked[inj]" value="<?php echo  $drugs_stocked_inj; ?>"></td>
											</tr>
											<tr>
											   <td width="25%">(c) Oral vitamin Products</td>
											   <td width="25%"><input type="text" class="form-control text-uppercase"  name="drugs_stocked[oral]" value="<?php echo  $drugs_stocked_oral; ?>"></td>
											   <td width="25%">(d) Household remedies</td>
											   <td width="25%"><input type="text" class="form-control text-uppercase"  name="drugs_stocked[hous]" value="<?php echo  $drugs_stocked_hous; ?>"></td>
											</tr>
											<tr>
											   <td width="25%">(e) Tinctures and other Spirituous Preparations</td>
											   <td width="25%"><input type="text" class="form-control text-uppercase"  name="drugs_stocked[spirit]" value="<?php echo  $drugs_stocked_spirit; ?>"></td>
											   <td width="25%"></td>
											   <td width="25%"></td>
											</tr> 
                                   
                              									
									<tr>
									<td colspan="4">18. The applicant deals in the following class of commodities only besides drugs on these premises viz. :-
										<table name="objectTable4" id="objectTable4" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="30%">Sl. No.</th>
													<th width="70%">Class of commodities </th>
												</tr>
												</thead>
												<?php
													$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
													$num4 = $part4->num_rows;
													if($num4>0){
													  $count=1;
													  while($row_4=$part4->fetch_array()){	?>
														<tr>
															<td><input readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
															<td><input id="txxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["class_commo"]; ?>" validate="letters" name="txxtB<?php echo $count;?>" size="10"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txxtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txxtA1"></td>
														<td><input id="txxtB1" size="10" validate="letters" class="form-control text-uppercase" name="txxtB1"></td>
														
																												
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore4()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
										</td>
								    </tr>
                                    <tr>
											  <td>19. The applicant was/was not dealing in Spirits/Wine/Country Liquor prior to introductions of Prohibition Act. In the applicants Village or town.</td>
											  <td><input type="text" class="form-control text-uppercase"  name="spirits_village" value="<?php echo  $spirits_village; ?>"></td>
										
											  <td>20. The applicant will deal/will not deal in any spirituous Medicinal or toilet preparations which are liable to be misused for other that bona-fide medicinal purposes.</td>
											  <td><input type="text" class="form-control text-uppercase"  name="spirits_medicinal" value="<?php echo  $spirits_medicinal; ?>"></td>
							          </tr>
									   <tr>
											 <td>21. Hours of business and working day.</td>
											 <td><input type="text" class="form-control text-uppercase"  name="hours_business"value="<?php echo  $hours_business; ?>"></td>
										
											<td>22. Name of the trade or professional Association of which applicant is a member and the date of commencement of membership.</td>
											<td><input type="text" class="form-control text-uppercase"  name="trade_association" value="<?php echo  $trade_association; ?>"></td>
									   </tr>
									    
                                    									
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	$('.fixedCapitala').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitala').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitala').val(sum);
		});
	});
	$('.fixedCapitalb').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitalb').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitalb').val(sum);
		});
	});
	$('.fixedCapitalc').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitalc').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitalc').val(sum);
		});
	});
	
	$("input:radio[name='is_rejected']").change(function(){
		var is_recogn_req_value = $(this).val();
		if(is_recogn_req_value=="Y"){
			$("#is_rejected_det").removeAttr("readonly","readonly");
		}else{
			$("#is_rejected_det").attr("readonly","readonly");
			$("#is_rejected_det").val("");
		}
	});
	$("input:radio[name='is_spirituous_medicinal']").change(function(){
		var is_recogn_req_value = $(this).val();
		if(is_recogn_req_value=="Y"){
			$("#is_spirituous_medicinal_det").removeAttr("readonly","readonly");
		}else{
			$("#is_spirituous_medicinal_det").attr("readonly","readonly");
			$("#is_spirituous_medicinal_det").val("");
		}
	});
	$("input:radio[name='is_license_previously']").change(function(){
		var is_recogn_req_value = $(this).val();
		if(is_recogn_req_value=="Y"){
			$("#is_license_previously_det").removeAttr("readonly","readonly");
		}else{
			$("#is_license_previously_det").attr("readonly","readonly");
			$("#is_license_previously_det").val("");
		}
	});
	$("input:radio[name='is_agent_distributor']").change(function(){
		var is_recogn_req_value = $(this).val();
		if(is_recogn_req_value=="Y"){
			$("#is_agent_distributor_det").removeAttr("readonly","readonly");
		}else{
			$("#is_agent_distributor_det").attr("readonly","readonly");
			$("#is_agent_distributor_det").val("");
		}
	});
	$("input:radio[name='is_engaged']").change(function(){
		var is_recogn_req_value = $(this).val();
		if(is_recogn_req_value=="Y"){
			$("#is_engaged_det").removeAttr("readonly","readonly");
		}else{
			$("#is_engaged_det").attr("readonly","readonly");
			$("#is_engaged_det").val("");
		}
	});
	
	/* ----------------------------------------------------- */
	$('.dob2').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------- */
</script>