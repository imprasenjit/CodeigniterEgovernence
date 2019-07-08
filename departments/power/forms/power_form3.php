<?php  require_once "../../requires/login_session.php";
$dept="power";
$form="3";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form_new.php";
	

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){		
	 $p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") or die($power->error);
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
			$applicant_name=$results["applicant_name"];$str_name1=$results["str_name1"];$str_name2=$results["str_name2"];$b_str_name1=$results["b_str_name1"];$b_str_name2=$results["b_str_name2"];
			$organization_name=$results["organization_name"];
			$contact_no=$results["contact_no"];
			$appli_email=$results["appli_email"];$appli_postofice=$results["appli_postofice"];$premises_postofc=$results["premises_postofc"];
			$situated_area=$results["situated_area"];$constructed_land=$results["constructed_land"];$height_tower=$results["height_tower"];$is_dedicated=$results["is_dedicated"];$dedicated_details=$results["dedicated_details"];$is_owner=$results["is_owner"];$is_co_owner=$results["is_co_owner"];$details_dedicated=$results["details_dedicated"];$is_lease=$results["is_lease"];$is_legal=$results["is_legal"];$is_electricity=$results["is_electricity"];$details_electricity=$results["details_electricity"];
			
			if(!empty($results["billing"])){
				$billing=json_decode($results["billing"]);
				$billing_sn1=$billing->sn1;$billing_sn2=$billing->sn2;$billing_town=$billing->town;$billing_d=$billing->d;$billing_pin=$billing->pin;$billing_mobile=$billing->mobile;
			}else{
				$billing_sn1="";$billing_sn2="";$billing_town="";$billing_po="";$billing_d="";$billing_pin="";$billing_mobile="";
			}
			
			$permanent_disconnection=$results["permanent_disconnection"];
			if(!empty($results["permanent_disconnection"])){
				$permanent_disconnection=json_decode($results["permanent_disconnection"]);
				$permanent_disconnection_a=$permanent_disconnection->a;$permanent_disconnection_b=$permanent_disconnection->b;
			}else{
				$permanent_disconnection_a="";$permanent_disconnection_b="";
			}
			
			if(!empty($results["contract_demand"])){
				$contract_demand=json_decode($results["contract_demand"]);
				$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
			}else{
				$contract_demand_num="";$contract_demand_unit="";
			}
			//TAB2//
			
			$is_connection=$results["is_connection"];$details_connection=$results["details_connection"];$esd=$results["esd"];$approx_distance=$results["approx_distance"];$proposed_distance=$results["proposed_distance"];$road_crossing=$results["road_crossing"];$nos_road=$results["nos_road"];$is_road_crossing=$results["is_road_crossing"];$details_crossing=$results["details_crossing"];
			
		}else{
			$form_id="";$b_str_name1="";$b_str_name2="";$applicant_name="";$organization_name="";$str_name1="";$str_name2="";$contact_no="";$appli_email="";			
			$appli_postofice="";$premises_postofc="";$situated_area="";$constructed_land="";$height_tower="";$is_dedicated="";$dedicated_details="";$is_owner="";$is_co_owner="";$is_lease="";$is_legal="";$is_electricity="";$permanent_disconnection="";$permanent_disconnection_a="";$permanent_disconnection_b="";$details_electricity="";
			
			//TAB2//
			$is_connection="";$details_connection="";$esd="";$approx_distance="";$proposed_distance="";$road_crossing="";$nos_road="";$is_road_crossing="";$details_crossing="";
		 }
	}else{			
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$b_str_name1=$results["b_str_name1"];$b_str_name2=$results["b_str_name2"];$applicant_name=$results["applicant_name"];$str_name1=$results["str_name1"];$str_name2=$results["str_name2"];
		$organization_name=$results["organization_name"];
		$contact_no=$results["contact_no"];
		$appli_email=$results["appli_email"];$appli_postofice=$results["appli_postofice"];$premises_postofc=$results["premises_postofc"];
		$situated_area=$results["situated_area"];$constructed_land=$results["constructed_land"];$height_tower=$results["height_tower"];$is_dedicated=$results["is_dedicated"];$dedicated_details=$results["dedicated_details"];$is_owner=$results["is_owner"];$is_co_owner=$results["is_co_owner"];$is_lease=$results["is_lease"];$is_legal=$results["is_legal"];$is_electricity=$results["is_electricity"];$details_electricity=$results["details_electricity"];
		
		if(!empty($results["billing"])){
			$billing=json_decode($results["billing"]);
			$billing_sn1=$billing->sn1;$billing_sn2=$billing->sn2;$billing_town=$billing->town;$billing_d=$billing->d;$billing_pin=$billing->pin;$billing_mobile=$billing->mobile;
		}else{
			$billing_sn1="";$billing_sn2="";$billing_town="";$billing_po="";$billing_d="";$billing_pin="";$billing_mobile="";
		}
		
		 $permanent_disconnection=$results["permanent_disconnection"];
			if(!empty($results["permanent_disconnection"])){
				$permanent_disconnection=json_decode($results["permanent_disconnection"]);
				$permanent_disconnection_a=$permanent_disconnection->a;$permanent_disconnection_b=$permanent_disconnection->b;
			}else{
				$permanent_disconnection_a="";$permanent_disconnection_b="";
			}
		
		if(!empty($results["contract_demand"])){
			$contract_demand=json_decode($results["contract_demand"]);
			$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
		}else{
			$contract_demand_num="";$contract_demand_unit="";
		}
		
		//TAB2//
		$is_connection=$results["is_connection"];$details_connection=$results["details_connection"];$esd=$results["esd"];$approx_distance=$results["approx_distance"];$proposed_distance=$results["proposed_distance"];$road_crossing=$results["road_crossing"];$nos_road=$results["nos_road"];$is_road_crossing=$results["is_road_crossing"];$details_crossing=$results["details_crossing"];
		
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>		
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li  class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								 <table id="" class="table table-responsive">
									<tr>
										<td width="25%">1.Name of the applicant (In block letter):</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="onlyLetters" name="applicant_name"  value="<?php echo $applicant_name; ?>"/></td>
										<td width="25%">2.Name of the organization (with designation of the applicant):</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="organization_name"><?php echo $organization_name; ?></textarea></td>
									</tr>
									<tr>
										<td>3. Contact no:</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="contact_no"  value="<?php echo $contact_no; ?>"/></td>
										<td>4. Email ID:</td>
										<td><input type="email" class="form-control" validate="emailid" name="appli_email" value="<?php echo $appli_email; ?>" ></td>
									</tr>
									<tr>
										<td colspan="4">5. Address for correspondence and sending bills: </td>
									</tr>
									<tr>
										<td><strong>Address of the Applicant </strong></td>
									</tr>
									<tr>
										<td>House No/ Plot No. :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $street_name1 ?>"></td>
										<td>Road :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Lane:</td>
										<td><input type="text" class="form-control text-uppercase"  name="str_name1" value="<?php echo $str_name1 ?>"></td>
										<td>Area/Colony :</td>
										<td><input type="text" class="form-control text-uppercase" name="str_name2" value="<?php echo $str_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Town/Village :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"> </td>
									</tr>
									<tr>
										<td> Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $pincode; ?>" ></td>
										<td>Mobile No. :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $mobile_no; ?>" ></td>
									</tr>
									<tr>
										<td>Post office:</td>
										<td><input type="text" class="form-control text-uppercase"  name="appli_postofice" value="<?php echo $appli_postofice; ?>" ></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									  <td>6. Address of the premises where service connection is applied for:</td>
									</tr>
									<tr>
										<td>House No. /Plot No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1 ?>"></td>
										<td>Road:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Lane:</td>
										<td><input type="text" class="form-control text-uppercase" name="b_str_name1" value="<?php echo $b_str_name1 ?>"></td>
										<td>Area/Colony:</td>
										<td><input type="text" class="form-control text-uppercase" name="b_str_name2" value="<?php echo $b_str_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Town/Village :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"> </td>
									</tr>
									<tr>
										<td> Pin :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_pincode; ?>" ></td>
										<td>Mobile No. :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_mobile_no; ?>" ></td>
									</tr>
									<tr>
										<td>Post office:</td>
										<td><input type="text" class="form-control text-uppercase" name="premises_postofc" value="<?php echo $premises_postofc; ?>" ></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>7. Premises is situated in plain/hilly area :</td>
										<td><select class="form-control text-uppercase" name="situated_area" required="required" id="situated_area">
											<option value="">Please Select</option>
											<option <?php if($situated_area=="Plain area") echo "selected";?> value="Plain area">Plain area</option>
											<option <?php if($situated_area=="Hilly area") echo "selected";?> value="Hilly area">Hilly area</option>
										</select></td>
										<td>8. Premises is constructed at : Myadi land/Govt. land :</td>
										<td><select class="form-control text-uppercase" name="constructed_land" required="required" id="constructed_land">
											<option value="">Please Select</option>
											<option <?php if($constructed_land=="Myadi land") echo "selected";?> value="Myadi land">Myadi land</option>
											<option <?php if($constructed_land=="Govt. land") echo "selected";?> value="Govt. land">Govt. land</option>
										</select></td>
									</tr>
									<tr>
										<td colspan="4">9. Structural details :</td>
									</tr>
									<tr>
										<td>Height of the tower :</td>
										<td><input type="text" class="form-control text-uppercase"  name="height_tower" value="<?php echo $height_tower; ?>" ></td>
										</td>
									</tr>
									<tr>
										<td colspan="4">10. Please give details of the existing connections of the premises where the connection is applied for :
										<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<tr>
													<th width="20%">Slno</th>
													<th width="20%">Consumer name</th>
													<th width="20%">Consumer number</th>
													<th width="20%">Category</th>
													<th width="20%">Load</th>
												</tr>
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["consumer_name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" ></td>
															<td><input value="<?php echo $row_1["consumer_number"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["category"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["current_load"]; ?>" id="txtE<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1" validate="letters"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10" class="form-control text-uppercase" name="txtD1"></td>
														<td><input id="txtE1" size="10" class="form-control text-uppercase" name="txtE1"></td>	
													</tr>
													<?php } ?>														
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
										<td>11. Whether there is any dedicated 11/0.440 KV sub-station at the premises?</td>
										<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_dedicated=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_dedicated" required="required"> Yes </label>
										<label class="radio-inline"><input type="radio" value="N" <?php if($is_dedicated=='N' || $is_dedicated=='') echo 'checked'; ?> id="inlineRadio1" name="is_dedicated"> No </label></td>
									  <td>12. If yes, capacity of the existing 11/0.440 KV sub-station at the premises.?</td>
									  <td><textarea type="text"  name="dedicated_details" placeholder="KVA" id="dedicated_details" <?php if($is_dedicated == 'N' || $is_dedicated == '' ) echo 'disabled="disabled"'; ?> class="dedicated_details form-control text-uppercase"/><?php echo $dedicated_details; ?></textarea></td>
								</tr>
								<tr>
									<td colspan="2">13. Whether the applicant is the owner of the premises?</td>
									<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_owner=="Y" || $is_owner=="") echo "checked"; ?> id="inlineRadio1" name="is_owner"> Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_owner=="N") echo "checked"; ?> id="inlineRadio1" name="is_owner"> No </label></td>
								</tr>
								<tr>
									<td colspan="4">14. If the applicant is not the owner/sole owner of the premises,</td>
								</tr>
								<tr>
									<td colspan="2">(i) Whether the owner/co owner will provide NOC?</td>
									<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_co_owner=="Y" || $is_co_owner=="") echo "checked"; ?> id="inlineRadio1" name="is_co_owner"> Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_co_owner=="N") echo "checked"; ?> id="inlineRadio1" name="is_co_owner"> No </label></td>
								</tr>
								<tr>
									<td colspan="2">(ii) Is there any lease agreement with the owner?</td>
									<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_lease=="Y" || $is_lease=="") echo "checked"; ?> id="inlineRadio1" name="is_lease"> Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_lease=="N") echo "checked"; ?> id="inlineRadio1" name="is_lease"> No </label></td>
								</tr>
								<tr>
									<td colspan="2">(iii) Whether there is any legal dispute with the owner?</td>
									<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_legal=="Y" || $is_legal=="") echo "checked"; ?> id="inlineRadio1" name="is_legal"> Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_legal=="N") echo "checked"; ?> id="inlineRadio1" name="is_legal"> No </label></td>
								</tr>
								<tr>
									<td colspan="2">15. If there is any permanent disconnection due to non-payment in the land or premises?<br/>If yes, please give details of the permanently disconnected connection(s)</td>
									<td><label class="radio-inline"><input type="radio" <?php if($permanent_disconnection!=NULL) echo "checked"; ?> value="Y" id="inlineRadio1" name="permanent_disconnection_radio"> Yes </label>
									<label class="radio-inline"><input type="radio" <?php if($permanent_disconnection==NULL) echo "checked"; ?> value="N" id="inlineRadio1" name="permanent_disconnection_radio"> No </label></td>
								</tr>
								<tr>
								   <td>(i) Consumer name(s)</td>
									<td style="width:25%"><input type="text" name="permanent_disconnection[a]" value="<?php echo $permanent_disconnection_a; ?>" <?php if($permanent_disconnection==NULL) echo "disabled='disabled'"; ?>  class="form-control text-uppercase permanent_disconnection"></td>
									<td>(ii) Consumer number(s)</td>
									<td style="width:25%"><input type="text" name="permanent_disconnection[b]"  value="<?php echo $permanent_disconnection_b; ?>" <?php if($permanent_disconnection==NULL) echo "disabled='disabled'"; ?> class="form-control text-uppercase permanent_disconnection"></td>
								</tr>
								<tr>
									<td>16. Is there any electricity due outstanding in Licensee's area of operation in the applicant's name?</td>
									
										<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_electricity=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_electricity" > Yes </label>
										<label class="radio-inline"><input type="radio" value="N" <?php if($is_electricity=='N' || $is_electricity=='') echo 'checked'; ?> id="inlineRadio1" name="is_electricity"> No </label></td>
								</tr>
								<tr>
									 <td>Give Details :</td>
									 <td><textarea type="text"  name="details_electricity" id="details_electricity" <?php if($is_electricity == 'N' || $is_electricity == '' ) echo 'disabled="disabled"'; ?> class="details_electricity form-control text-uppercase"/><?php echo $details_electricity; ?></textarea></td>
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
								<tr>
									<td width="25%">17. Any electricity dues outstanding for the premises for which connection applied for:</td>
									<td width="25%"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_connection=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_connection" required="required"> Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_connection=='N' || $is_connection=='') echo 'checked'; ?> id="inlineRadio1" name="is_connection"> No </label></td>
									<td width="25%">Give Details :</td>
									 <td><textarea type="text"  name="details_connection" id="details_connection" <?php if($is_connection == 'N' || $is_connection == '' ) echo 'disabled="disabled"'; ?> class="details_connection form-control text-uppercase"/><?php echo $details_connection; ?></textarea></td>
								</tr>
								<tr>
										<td width="25%">18. Name of the electrical sub-division :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="esd" id="esd" value="<?php echo $esd; ?>"></td>
										<td width="25%">19. Approximate distance of the nearest 33/11KV sub-station from the premises in meters along the right of way:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="approx_distance" value="<?php echo $approx_distance; ?>"> </td>
								</tr>
								<tr>
										<td width="25%">20. Proposed distance of the nearest 11KV line (from where the spur line can be constructed) from the premises in meters along the right of way:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="proposed_distance" value="<?php echo $proposed_distance; ?>"></td>
								</tr>
								<tr>
									<td>21. Is there any electricity due outstanding in Licensee's area of operation in the applicant's name?</td>
									
										<td><label class="radio-inline"><input type="radio" value="Y" <?php if($road_crossing=='Y') echo 'checked'; ?> id="inlineRadio1" name="road_crossing" > Yes </label>
										<label class="radio-inline"><input type="radio" value="N" <?php if($road_crossing=='N' || $road_crossing=='') echo 'checked'; ?> id="inlineRadio1" name="road_crossing"> No </label></td>
								
									 <td>22. If required, nos. of road crossings :</td>
									 <td><textarea type="text"  name="nos_road" id="nos_road" <?php if($road_crossing == 'N' || $road_crossing == '' ) echo 'disabled="disabled"'; ?> class="nos_road form-control text-uppercase"/><?php echo $nos_road; ?></textarea></td>
								</tr>
								<tr>
									<td>21. Whether road crossing is required along the right of way? : Required/Not required:</td>
									<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_road_crossing=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_road_crossing" > Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_road_crossing=='N' || $is_road_crossing=='') echo 'checked'; ?> id="inlineRadio1" name="is_road_crossing"> No </label></td>
								</tr>
								<tr>
									 <td width="25%">If yes, nos. of HT crossing.<td>
									 <td width="25%"><textarea type="text"  name="details_crossing" id="details_crossing" <?php if($is_road_crossing == 'N' || $is_road_crossing == '' ) echo 'disabled="disabled"'; ?> class="details_crossing form-control text-uppercase"/><?php echo $details_crossing; ?></textarea></td>
								</tr>
								<tr>
								   <td colspan="4">&nbsp;&nbsp;I/we declare that the information given above is true to the best of my/our knowledge and belief. I/we will provide right of way for laying 11 KV line and service connection wire/cable.</td>
								</tr>
								<tr>
								   <td colspan="4">&nbsp;&nbsp;If any information furnished above is found wrong, the licensee will be at liberty to stop or discontinue the service connection procedure.</td>
								</tr>
								<tr>
									<td>Date :<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
									<td align="right" colspan="3">Signature of the Applicant: <strong><?php echo $key_person; ?></strong></td>
								</tr>
								<tr>										
									<td class="text-center" colspan="4">
										<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	$('input[name="billing_details"]').on('change', function(){
		if($(this).val() == 'A'){
			$('#hno').val('<?php echo $street_name1; ?>');		
			$('#road').val('<?php echo $street_name2; ?>');			
			$('#town').val('<?php echo $vill; ?>');			
			$('#district').val('<?php echo $dist; ?>');			
			$('#pin').val('<?php echo $pincode; ?>');		
			$('#mobile').val('<?php echo $mobile_no; ?>');		
		}else if($(this).val() == 'E'){
			$('#hno').val('<?php echo $b_street_name1; ?>');	
			$('#road').val('<?php echo $b_street_name2; ?>');			
			$('#town').val('<?php echo $b_vill; ?>');			
			$('#district').val('<?php echo $b_dist; ?>');			
			$('#pin').val('<?php echo $b_pincode; ?>');
			$('#mobile').val('<?php echo $b_mobile_no; ?>');
		}else{
			$('#hno').val('');
			$('#road').val('');			
			$('#town').val('');			
			$('#district').val('');			
			$('#pin').val('');
			$('#mobile').val('');
		}
	});
	$('#loading_image').hide();
	$('#exist_con_no').change(function(){
		/* 
		var specials=/\d{11,12}/;	
        
		var pattern = new RegExp(specials);
		var res = pattern.exec(exist_con_no); */
		var exist_con_no=$(this).val();
		if((exist_con_no.length != 11 && exist_con_no.length != 12) || res == null){
			$("#wrong_esd").html("Please enter 11 or 12 digit consumer number. ");
			$("#exist_con_no").focus();
			$('#esd').val("");
		}else{
			$("#wrong_esd").html("");
			$('#esd').val("");
			
			$.ajax({ 
				type: 'GET',
				url: '../../../ajax/power_esd.php', 
				data: { exist_con_no: exist_con_no },
				beforeSend:function(){
					$("#esd").html("Loading..");
					$('#loading_image').show();
				},
				success:function(data){
					if(data==false){
						$("#esd").val("To be allocated.");
						alert("Please Note : Online payment can not be done since this Electrical Subdivision does not accept online payment.Kindly go to your nearest electrical subdivision and do the payment. Thank you.");
						$('#loading_image').hide();
					}else{
						$("#esd").val(data);
						alert("Electrical Sub-division : " + data);
						$('#loading_image').hide();
					}                
				},
				error:function(){ }
			}); //ajax end
		}		
    });
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	//$('required_power').on({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$("#consumer_category").attr("readonly","readonly");
	$("#consumer_category option[value='LT Commercial']").hide();
	$("#consumer_category option[value='LT General Purpose']").hide();
	$("#consumer_category option[value='LT Small Industries']").hide();
	$("#consumer_category option[value='HT Industries I']").hide();
	$("#consumer_category option[value='HT Industries II']").hide();
	$("#consumer_category option[value='HT Small Industries']").hide();
	$('input[name="required_power"]').on('change', function(){
		$("#consumer_category").removeAttr("readonly","readonly");
		var value=$(this).val();
		if(value < 20){			
			$("#consumer_category option[value='HT Small Industries']").hide();
			$("#consumer_category option[value='HT Industries I']").hide();	
			$("#consumer_category option[value='HT Industries II']").hide();
			$("#consumer_category option[value='LT Commercial']").show();
			$("#consumer_category option[value='LT General Purpose']").show();
			$("#consumer_category option[value='LT Small Industries']").show();				
		}else if(value > 20 && value < 40){
			$("#consumer_category option[value='HT Small Industries']").show();
			$("#consumer_category option[value='HT Industries I']").hide();	
			$("#consumer_category option[value='HT Industries II']").hide();
			$("#consumer_category option[value='LT Commercial']").hide();
			$("#consumer_category option[value='LT General Purpose']").hide();
			$("#consumer_category option[value='LT Small Industries']").hide();			
		}else if(value > 40 && value < 120){
			$("#consumer_category option[value='LT Commercial']").hide();
			$("#consumer_category option[value='LT General Purpose']").hide();
			$("#consumer_category option[value='LT Small Industries']").hide();
			$("#consumer_category option[value='HT Industries I']").show();
			$("#consumer_category option[value='HT Industries II']").hide();
			$("#consumer_category option[value='HT Small Industries']").hide();
		}else if(value > 120){
			$("#consumer_category option[value='LT Commercial']").hide();
			$("#consumer_category option[value='LT General Purpose']").hide();
			$("#consumer_category option[value='LT Small Industries']").hide();
			$("#consumer_category option[value='HT Industries I']").hide();
			$("#consumer_category option[value='HT Industries II']").show();
			$("#consumer_category option[value='HT Small Industries']").hide();
		}else{
			$("#consumer_category").attr("readonly","readonly");
		}
	});
	/*
	UPTO 20 kw - Commercial or General Purpose or Small Industries
	20<value<40 -- HT Small Industries
	40-120 --- HT Industries I
	120 KW - above - HT Industries II 
	*/
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	
	$('input[name="is_dedicated"]').on('change', function(){
		if($(this).val() == 'N')
			$('#dedicated_details').attr('disabled', 'disabled');
		else
			$('#dedicated_details').removeAttr('disabled');
	});
	
	$('input[name="road_crossing"]').on('change', function(){
		if($(this).val() == 'N')
			$('#nos_road').attr('disabled', 'disabled');
		else
			$('#nos_road').removeAttr('disabled');
	});
	
	$('input[name="permanent_disconnection_radio"]').on('change', function(){
		if($(this).val() == 'N')
			$('.permanent_disconnection').attr('disabled', 'disabled');
		else
			$('.permanent_disconnection').removeAttr('disabled');
	}); 
	
	$('input[name="is_electricity"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_electricity').attr('disabled', 'disabled');
		else
			$('#details_electricity').removeAttr('disabled');
	});
	
	$('input[name="is_connection"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_connection').attr('disabled', 'disabled');
		else
			$('#details_connection').removeAttr('disabled');
	});
	
	$('input[name="is_road_crossing"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_crossing').attr('disabled', 'disabled');
		else
			$('#details_crossing').removeAttr('disabled');
	});
</script>