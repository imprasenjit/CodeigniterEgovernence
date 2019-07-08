<?php  require_once "../../requires/login_session.php";

$dept="gmc";
$form="7";

$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";

	if(strtoupper($b_dist)!="KAMRUP METROPOLITAN"){ 
		echo "<script>
				alert('Since your business is not situated in Kamrup Metropolitan so you are not allowed to fill up the application form under Guwahati Municipal Corporation.');
				window.location.href = '".$server_url."user_area/';
		</script>";	
	}
	

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			
			$form_id=$results["form_id"];$dag_number=$results["dag_number"];$pp_no=$results["pp_no"];$vil_lage=$results["vil_lage"];$mou_za=$results["mou_za"];$sign_attorney_holder=$results["sign_attorney_holder"];
			
	//tab2//
		if(!empty($results["appli"])){
			$appli=json_decode($results["appli"]);
			$appli_nm=$appli->nm;$appli_address=$appli->address;$appli_contactno=$appli->contactno;$appli_emailid=$appli->emailid;
		}else{
			$appli_nm="";$appli_address="";$appli_contactno="";$appli_emailid="";
		}
		if(!empty($results["full"])){
			$full=json_decode($results["full"]);
			$full_dagno=$full->dagno;$full_divno=$full->divno;$full_town=$full->town;$full_mouza=$full->mouza;$full_area=$full->area;
		}else{
			$full_dagno="";$full_divno="";$full_town="";$full_mouza="";$full_area="";
		}
		$is_adjoining=$results["is_adjoining"];$details_adjoining=$results["details_adjoining"];$present_land=$results["present_land"];$previous_land=$results["previous_land"];$number_dwelling=$results["number_dwelling"];$is_felling=$results["is_felling"];$details_felling=$results["details_felling"];$is_erection=$results["is_erection"];$details_erection=$results["details_erection"];$hindu_religious=$results["hindu_religious"];$signed_application=$results["signed_application"];$signed_architect=$results["signed_architect"];$owner_sign=$results["owner_sign"];
		
        if(!empty($results["extentland"])){
			$extentland=json_decode($results["extentland"]);
			$extentland_residential=$extentland->residential;$extentland_commercial=$extentland->commercial;$extentland_industrial=$extentland->industrial;$extentland_institutional=$extentland->institutional;$extentland_park=$extentland->park;$extentland_roads=$extentland->roads;
		}else{
			$extentland_residential="";$extentland_commercial="";$extentland_industrial="";$extentland_institutional="";$extentland_park="";$extentland_roads="";
		}
		
		if(!empty($results["architect"])){
			$architect=json_decode($results["architect"]);
			$architect_address=$architect->address;$architect_email=$architect->email;$architect_cont=$architect->cont;$architect_sign=$architect->sign;
		}else{
			$architect_address="";$architect_email="";$architect_cont="";$architect_sign="";
		}
			
	 }else{
			$form_id="";$dag_number="";$pp_no="";$vil_lage="";$mou_za="";$sign_attorney_holder="";
			$appli_nm="";$appli_address="";$appli_contactno="";$appli_emailid="";
			$full_dagno="";$full_divno="";$full_town="";$full_mouza="";$full_area="";
			$extentland_residential="";$extentland_commercial="";$extentland_industrial="";$extentland_institutional="";$extentland_park="";$extentland_roads="";
			
			$is_adjoining="";$details_adjoining="";$present_land="";$previous_land="";$number_dwelling="";$is_felling="";$details_felling="";$is_erection="";$details_erection="";$hindu_religious="";$signed_application="";$signed_architect="";$owner_sign="";
			$architect_address="";$architect_email="";$architect_cont="";$architect_sign="";
		}
	}else{	
		$results=$q->fetch_array();		
		$form_id=$results["form_id"];$dag_number=$results["dag_number"];$pp_no=$results["pp_no"];$vil_lage=$results["vil_lage"];$mou_za=$results["mou_za"];$sign_attorney_holder=$results["sign_attorney_holder"];
			
			//tab2//
		if(!empty($results["appli"])){
			$appli=json_decode($results["appli"]);
			$appli_nm=$appli->nm;$appli_address=$appli->address;$appli_contactno=$appli->contactno;$appli_emailid=$appli->emailid;
		}else{
			$appli_nm="";$appli_address="";$appli_contactno="";$appli_emailid="";
		}
		if(!empty($results["full"])){
			$full=json_decode($results["full"]);
			$full_dagno=$full->dagno;$full_divno=$full->divno;$full_town=$full->town;$full_mouza=$full->mouza;$full_area=$full->area;
		}else{
			$full_dagno="";$full_divno="";$full_town="";$full_mouza="";$full_area="";
		}
		$is_adjoining=$results["is_adjoining"];$details_adjoining=$results["details_adjoining"];$present_land=$results["present_land"];$previous_land=$results["previous_land"];$number_dwelling=$results["number_dwelling"];$is_felling=$results["is_felling"];$details_felling=$results["details_felling"];$is_erection=$results["is_erection"];$details_erection=$results["details_erection"];$hindu_religious=$results["hindu_religious"];$signed_application=$results["signed_application"];$signed_architect=$results["signed_architect"];$owner_sign=$results["owner_sign"];
		
        if(!empty($results["extentland"])){
			$extentland=json_decode($results["extentland"]);
			$extentland_residential=$extentland->residential;$extentland_commercial=$extentland->commercial;$extentland_industrial=$extentland->industrial;$extentland_institutional=$extentland->institutional;$extentland_park=$extentland->park;$extentland_roads=$extentland->roads;
		}else{
			$extentland_residential="";$extentland_commercial="";$extentland_industrial="";$extentland_institutional="";$extentland_park="";$extentland_roads="";
		}
		
		if(!empty($results["architect"])){
			$architect=json_decode($results["architect"]);
			$architect_address=$architect->address;$architect_email=$architect->email;$architect_cont=$architect->cont;$architect_sign=$architect->sign;
		}else{
			$architect_address="";$architect_email="";$architect_cont="";$architect_sign="";
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
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li  class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
									    	<td colspan="4">To,<br/>
									    	<b>The Chief Executive Officer,</b><br/>Guwahati Metropolitan Development Authority,</br>Bhangagarh, Guwahati.</td>
									    </tr>
									    <tr>
									    	<td colspan="4">Sir,<br/>I hereby apply for Planning Permission for laying out of my land in Dag No&nbsp;&nbsp;<input type="text" value="<?php echo $dag_number; ?>" name="dag_number" >&nbsp;&nbsp;PP No &nbsp;&nbsp;<input type="text" value="<?php echo $pp_no; ?>" name="pp_no" >&nbsp;&nbsp;Village &nbsp;&nbsp;<input type="text" value="<?php echo $vil_lage; ?>" name="vil_lage" >&nbsp;&nbsp; Mouza &nbsp;&nbsp;<input type="text" value="<?php echo $mou_za; ?>" name="mou_za" >&nbsp;&nbsp;for building purposes/desire to find out whether under noted development is permissible.</td>
									    </tr>
										<tr>
									    	<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;I forward herewith the following particulars in quadruplicate duly signed by the Registered Technical Person and me.</td>
									    </tr>
										<tr>
										 <td colspan="4">
										 <ul>
										  <ol type="a">
										   <li>A key map of the site showing adjoining areas of the proposed layout under reference, marking clearly therein the boundaries of the proposed layout in colour, existing roads, structures, landmarks, streams, H.T. or L.T. Power Lines, drains to passing through layout and levels of the site.</li>
										   <li>A detailed site plan to a scale of not less than 1:200 showing the proposed layout indicating size of plots, width of the proposed roads, open spaces and amenities provided and type of buildings be built, if any, and</li>
										   <li>The Trace map of the area. required under building byelaws.</li>
										   <li>Other documents, maps and drawings as required under building byelaws.</li>
										  </ol>
										 </ul>
										 </td>
										</tr>
										<tr>
											<td colspan="4">&nbsp;&nbsp;I/We the owner/legal representative of the land to which the accompanying application relates request that the layout may be approved and Planning Permission may be accorded.</td>
										</tr>
										<tr>
											<td>Date :<?php echo date('d-m-Y',strtotime($today)); ?></td>
											<td align="right">Signature of the Owner of the land/Power of attorney holder/Lease Holder :
											<td><input type="text" name="sign_attorney_holder"  value="<?php echo $sign_attorney_holder; ?>" class="form-control text-uppercase"></td>
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
								  <td colspan="4"><b>TO BE COMPLETED BY THE OWNER OF THE LAND / POWER OF ATTORNEY HOLDER / LEASE HOLDER</b></td>
								</tr>
								<tr>
										<td colspan="4">1. Applicant Details(in block capital) :</td>
								</tr>
								<tr>
										<td width="25%"> Name: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="appli[nm]" value="<?php echo  $appli_nm; ?>"></td>
										<td width="25%">Communication address:</td>
										<td width="25%"><textarea class="form-control text-uppercase" id="state_details" name="appli[address]"><?php echo $appli_address; ?></textarea></td>
								</tr>
								<tr>
									<td>Contact No :</td>
									<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="appli[contactno]" value="<?php echo  $appli_contactno; ?>"></td>
									<td>Email ID :</td>
									<td><input type="email" class="form-control" validate="emailid" name="appli[emailid]" value="<?php echo  $appli_emailid; ?>"></td>
								</tr>
								<tr>
								  <td colspan="4"><b>Particulars of proposal for which permission or approval is sought</b></td>
								</tr>
								<tr>
									<td colspan="4">2. (a) Full address or location of the land to which this application relates and site area :</td>
								</tr>
								<tr>
									<td>Dag No./PP No :</td>
									<td><input type="text" class="form-control text-uppercase"  name="full[dagno]" value="<?php echo $full_dagno; ?>"></td>
									<td>Division No./Ward No :</td>
									<td><input type="text" class="form-control text-uppercase" name="full[divno]" value="<?php echo $full_divno; ?>"></td>
								</tr>
								<tr>
									<td>Name of Town or village :</td>
									<td><input type="text" class="form-control text-uppercase"  name="full[town]" value="<?php echo $full_town; ?>"></td>
									<td>Mouza :</td>
									<td><input type="text" class="form-control text-uppercase" name="full[mouza]" value="<?php echo $full_mouza; ?>"></td>
								</tr>
								<tr>
									<td>Land area :</td>
									<td><input type="text" class="form-control text-uppercase"  name="full[area]" value="<?php echo $full_area; ?>"></td>
								</tr>
								<tr>
									<td colspan="2">(b) State whether the applicant owns or controls any adjoining land. If so give its location and extent.:</td>
									<td>
											<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_adjoining=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_adjoining" required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_adjoining=='N' || $is_adjoining=='') echo 'checked'; ?> id="inlineRadio1" name="is_adjoining"> No </label></td>
										</td>
								</tr>
								<tr>
									 <td>Give its location and extent :</td>
									 <td><textarea type="text"  name="details_adjoining" id="details_adjoining" <?php if($is_adjoining == 'N' || $is_adjoining == '' ) echo 'disabled="disabled"'; ?> class="details_adjoining form-control text-uppercase"/><?php echo $details_adjoining; ?></textarea></td>
								</tr>
								<tr>
									<td colspan="4">3. Particulars of present and previous use of land :</td>
								</tr>
								<tr>
									<td>(i) Present use of land: </td>
									<td><input type="text" class="form-control text-uppercase" name="present_land" value="<?php echo $present_land; ?>"></td>
									<td>(ii) If vacant, the last previous use:</td>
									<td><input type="text" class="form-control text-uppercase" name="previous_land" value="<?php echo $previous_land; ?>"></td>
								</tr>
								<tr>
									<td colspan="4">4. Information regarding the proposed use :</td>
								</tr>
								<tr>
									<td colspan="2">(i) State number and type of dwelling units : (whether bungalows, houses, flats, etc.) factories Shops, institutions, parks & play fields etc. proposed.</td>
									<td><textarea class="form-control text-uppercase" id="number_dwelling" name="number_dwelling"><?php echo $number_dwelling; ?></textarea></td>
								</tr>
								<tr>
									<td colspan="4">(ii) Extent of land use proposed : (extent in hectares) </td>
								</tr>
								<tr>
									<td>(a) Land allotted for residential purpose :</td>
									<td><input type="text" class="form-control text-uppercase" name="extentland[residential]" value="<?php echo $extentland_residential; ?>"></td>
									<td>(b) Land allotted for commercial purpose :</td>
									<td><input type="text" class="form-control text-uppercase" name="extentland[commercial]" value="<?php echo $extentland_commercial; ?>"></td>
								</tr>
								<tr>
									<td>(c) Land allotted for industrial purpose :</td>
									<td><input type="text" class="form-control text-uppercase" name="extentland[industrial]" value="<?php echo $extentland_industrial; ?>"></td>
									<td>(d) Land allotted for institutional purpose :</td>
									<td><input type="text" class="form-control text-uppercase" name="extentland[institutional]" value="<?php 
									echo $extentland_institutional; ?>"></td>
								</tr>
								<tr>
									<td>(e) Land allotted for park and play fields:</td>
									<td><input type="text" class="form-control text-uppercase" name="extentland[park]" value="<?php echo $extentland_park; ?>"></td>
									<td>(f) Land allotted for roads and pathways :</td>
									<td><input type="text" class="form-control text-uppercase" name="extentland[roads]" value="<?php echo $extentland_roads; ?>"></td>
								</tr>
								<tr>
									<td>5. Does the proposed development involve felling of any trees?If yes, indicate the position on plan.</td>
									<td>
											<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_felling=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_felling" required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_felling=='N' || $is_felling=='') echo 'checked'; ?> id="inlineRadio1" name="is_felling"> No </label></td>
										</td>
								</tr>
								<tr>
									 <td>Indicate the position on plan :</td>
									 <td><textarea type="text"  name="details_felling" id="details_felling" <?php if($is_felling == 'N' || $is_felling == '' ) echo 'disabled="disabled"'; ?> class="details_felling form-control text-uppercase"/><?php echo $details_felling; ?></textarea></td>
								</tr>
								<tr>
									<td>6. Does the proposed development involve erection of any advertisement board? If yes, indicate its position on plan and type of the Advertisement board to be erected.</td>
									<td>
											<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_erection=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_erection" required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_erection=='N' || $is_erection=='') echo 'checked'; ?> id="inlineRadio1" name="is_erection"> No </label></td>
										</td>
								</tr>
								<tr>
									 <td>Give Details</td>
									 <td><textarea type="text"  name="details_erection" id="details_erection" <?php if($is_erection == 'N' || $is_erection == '' ) echo 'disabled="disabled"'; ?> class="details_erection form-control text-uppercase"/><?php echo $details_erection; ?></textarea></td>
								</tr>
								<tr>
									<td colspan="2">7. Whether the land in question is property belonging to a Wakf or a Hindu Religious Institution and if so whether proper prior approval or authority clearance has been obtained for the proposed development.</td>
									<td><textarea class="form-control text-uppercase" id="hindu_religious" name="hindu_religious"><?php echo $hindu_religious; ?></textarea></td>
								</tr>
								<tr>
									<td colspan="4">CONDITIONS</td>
								</tr>
								<tr>
									<td colspan="4">
										<ul>
										  <ol type="i">
										   <li>I agree not to proceed with laying out of land for building purposes until the planning permission is granted by the Authority under relevant provision of building byelaws and Guwahati Building Construction (Regulation) Act 2010.</li>
										   <li>I agree not to do any development otherwise than in accordance with the layout plan, specifications which have been approved or in contravention of any provision of the building byelaws, order or other declaration made there under or of any direction or requisition lawfully given or made under the said Act rules or by laws.</li>
										   <li>I agree to make any modification which may be required by any notice issued by any order confirmed by the Authority.</li>
										   <li>I agree to keep one copy of the approved layout plans at the site at all reasonable times when development is in progress and also agree to see that the plan is available and the site is open at all reasonable times for the inspection of the Authority or any officer authorized by him in that behalf.</li>
										   <li>I agree to furnish a set of completion plans within fifteen days from the date of completion of the development.</li>
										   <li>I agree to hand over all the proposed roads after duly forming them to the satisfaction of the local authority concerned and sites reserved for parks, play grounds, open spaces for public purpose free of cost to the local authority concerned in which the site falls when so directed by the authority.</li>
										  </ol>
										 </ul>
									</td>
								</tr>
								<tr>
									   <td colspan="4">I<input type="text" value="<?php echo $signed_application; ?>" name="signed_application" >&nbsp;&nbsp;have signed this application in my capacity as the Owner/Power of Attorney Holder/Lease Holder and declare that the checklist and statement made therein are true to the best of my knowledge and belief.</td>
								</tr>
								<tr>
									   <td colspan="4">I<input type="text" value="<?php echo $signed_architect; ?>" name="signed_architect">&nbsp;&nbsp;have signed this Architect/RTP of Attorney Holder/Lease Holder and declare that the checklist and statement made therein are true to the best of my knowledge and belief.</td>
								</tr>
								<tr>
										<td>Address Details of the Architect/RTP :</td>
										<td colspan="3"></td>
								</tr>
								<tr>
										<td>Address</td>
										 <td><textarea class="form-control text-uppercase" id="architect_address" name="architect[address]"><?php echo $architect_address; ?></textarea></td>
										<td>Email id</td>
										<td><input type="email" name="architect[email]"  validate="emailid" value="<?php echo $architect_email; ?>" class="form-control"></td>
								</tr>
								<tr>
										<td>Contact No.</td>
										<td><input type="text" name="architect[cont]"  value="<?php echo $architect_cont; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
								       <td>Signature of the Architect/RTP</td>
										<td><input type="text" name="architect[sign]"  value="<?php echo $architect_sign; ?>" class="form-control text-uppercase"></td>
										<td>Signature of the Owner of the Land /Power of attorney holder / Lease holder</td>
										<td><input type="text" name="owner_sign"  value="<?php echo $owner_sign; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
										<td>Date :<?php echo date('d-m-Y',strtotime($today)); ?></td>
										<td colspan="3" align="right">Place :<?php echo $dist; ?></td>
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	$('input[name="is_adjoining"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_adjoining').attr('disabled', 'disabled');
		else
			$('#details_adjoining').removeAttr('disabled');
	});
	$('input[name="is_felling"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_felling').attr('disabled', 'disabled');
		else
			$('#details_felling').removeAttr('disabled');
	});
	$('input[name="is_erection"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_erection').attr('disabled', 'disabled');
		else
			$('#details_erection').removeAttr('disabled');
	});
</script>