<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
$form="12";
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
				$form_id=$results['form_id'];	
				$caller_name=$results["caller_name"];  $description=$results["description"]; $caller_no=$results["caller_no"];
				$occured_date=$results["occured_date"]; $ocured_time=$results["ocured_time"];$nearest_station =$results["nearest_station"];$distance_fire =$results["distance_fire"];
				$descript_property =$results["descript_property"];$property_insured =$results["property_insured"];$property_uninsured =$results["property_uninsured"];$human_life =$results["human_life"];	
				$holding_no=$results['holding_no'];$insurance=$results['insurance'];$noc=$results['noc'];	
					  
				if(!empty($results["place_occurrence"])){
					$place_occurrence=json_decode($results["place_occurrence"]);
					$place_occurrence_vt=$place_occurrence->vt;$place_occurrence_w=$place_occurrence->w;$place_occurrence_h=$place_occurrence->h;
					$place_occurrence_p=$place_occurrence->p;$place_occurrence_d=$place_occurrence->d;				
				}else{
					$place_occurrence_vt="";$place_occurrence_w="";$place_occurrence_h="";$place_occurrence_p="";$place_occurrence_d="";
				}
				if(!empty($results["owner_address"])){
					$owner_address=json_decode($results["owner_address"]);
					$owner_address_name=$owner_address->name;$owner_address_vt=$owner_address->vt;$owner_address_w=$owner_address->w;$owner_address_h=$owner_address->h;$owner_address_p=$owner_address->p;$owner_address_d=$owner_address->d;
				}else{
					$owner_address_name="";$owner_address_vt="";$owner_address_w="";$owner_address_h="";$owner_address_p="";$owner_address_d="";
				}
				if(!empty($results["occupant_address"])){
					$occupant_address=json_decode($results["occupant_address"]);
					$occupant_address_name=$occupant_address->name;$occupant_address_vt=$occupant_address->vt;$occupant_address_w=$occupant_address->w;$occupant_address_h=$occupant_address->h;$occupant_address_p=$occupant_address->p;$occupant_address_d=$occupant_address->d;
				}else{
					$occupant_address_name="";$occupant_address_vt="";$occupant_address_w="";$occupant_address_h="";$occupant_address_p="";$occupant_address_d="";
				}
				if(!empty($results["fire_desc"]))
				{
					$fire_desc=json_decode($results["fire_desc"]);
					$fire_desc_a=$fire_desc->a;$fire_desc_b=$fire_desc->b;$fire_desc_c=$fire_desc->c;$fire_desc_d=$fire_desc->d;
				}
				else
				{
					$fire_desc_a="";$fire_desc_b="";$fire_desc_c="";$fire_desc_d="";
					$fire_desc_e="";	
				}
			}else{
				$form_id="";		  
				$caller_name="";$caller_no="";$occured_date="";$ocured_time="";$nearest_station="";$distance_fire="";$descript_property="";$property_insured="";$property_uninsured="";$human_life="";$place_occurrence_vt="";$place_occurrence_w="";$place_occurrence_h="";$place_occurrence_p="";$place_occurrence_d="";$description="";$owner_address_name="";$owner_address_vt="";$owner_address_w="";$owner_address_h="";$owner_address_p="";$owner_address_d="";$occupant_address_name="";$occupant_address_vt="";$occupant_address_w="";$occupant_address_h="";$occupant_address_p="";$occupant_address_d="";$fire_desc_a="";$fire_desc_b="";$fire_desc_c="";$fire_desc_d="";$fire_desc_e="";
				$holding_no="";$insurance="";$noc="";
			}
		}else{
				$results=$q->fetch_array();
				$form_id=$results['form_id'];	
				$caller_name=$results["caller_name"];  $description=$results["description"]; $caller_no=$results["caller_no"];
				$occured_date=$results["occured_date"]; $ocured_time=$results["ocured_time"];$nearest_station =$results["nearest_station"];$distance_fire =$results["distance_fire"];
				$descript_property =$results["descript_property"];$property_insured =$results["property_insured"];$property_uninsured =$results["property_uninsured"];$human_life =$results["human_life"];	
				$holding_no=$results['holding_no'];$insurance=$results['insurance'];$noc=$results['noc'];	
					  
				if(!empty($results["place_occurrence"]))
				{
					$place_occurrence=json_decode($results["place_occurrence"]);
					$place_occurrence_vt=$place_occurrence->vt;$place_occurrence_w=$place_occurrence->w;$place_occurrence_h=$place_occurrence->h;
					$place_occurrence_p=$place_occurrence->p;$place_occurrence_d=$place_occurrence->d;
					
				}
				else
				{
					$place_occurrence_vt="";$place_occurrence_w="";$place_occurrence_h="";$place_occurrence_p="";$place_occurrence_d="";
				}
				if(!empty($results["owner_address"]))
				{
					$owner_address=json_decode($results["owner_address"]);
					$owner_address_name=$owner_address->name;$owner_address_vt=$owner_address->vt;$owner_address_w=$owner_address->w;$owner_address_h=$owner_address->h;$owner_address_p=$owner_address->p;$owner_address_d=$owner_address->d;
				}
				else
				{
					$owner_address_name="";$owner_address_vt="";$owner_address_w="";$owner_address_h="";$owner_address_p="";$owner_address_d="";
				}
				if(!empty($results["occupant_address"]))
				{
					$occupant_address=json_decode($results["occupant_address"]);
					$occupant_address_name=$occupant_address->name;$occupant_address_vt=$occupant_address->vt;$occupant_address_w=$occupant_address->w;$occupant_address_h=$occupant_address->h;$occupant_address_p=$occupant_address->p;$occupant_address_d=$occupant_address->d;
				}
				else
				{
					$occupant_address_name="";$occupant_address_vt="";$occupant_address_w="";$occupant_address_h="";$occupant_address_p="";$occupant_address_d="";
				}
				if(!empty($results["fire_desc"]))
				{
					$fire_desc=json_decode($results["fire_desc"]);
					$fire_desc_a=$fire_desc->a;$fire_desc_b=$fire_desc->b;$fire_desc_c=$fire_desc->c;$fire_desc_d=$fire_desc->d;
				}
				else
				{
					$fire_desc_a="";$fire_desc_b="";$fire_desc_c="";$fire_desc_d="";
					$fire_desc_e="";	
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
									<h4 class="text-center" >
										<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
									</h4>	
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
									  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART 2</a></li>
									</ul>
									<br>
									<div class="tab-content">
					<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
					<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">	
						<table id="" class="table table-responsive">
							<tr>
										<td colspan="4">1. Name of caller with Telephone Number :<span class="mandatory_field">*</span></td>
							</tr>
							<tr>
									<td width="25%">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td width="25%">
									   <input type="text" name="caller_name" validate="letters" class="form-control text-uppercase" required="required" value="<?php echo $caller_name; ?>" /></td>
									<td width="25%">Mobile No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td width="25%">
									<input type="text" id="textfield3_phone" class="form-control text-uppercase" required="required" maxlength="10" name="caller_no" value="<?php echo $caller_no; ?>" validate="mobileNumber" placeholder="Mobile Number" /></td>
										   
							</tr>
											 
							<tr>
									<td>2. Date of Occurence :<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td><input type="text" class="dob form-control text-uppercase" name="occured_date" id="date_occurrence" value="<?php if(!empty($occured_date)) echo date('d-m-Y',strtotime($occured_date)); else echo date("d-m-Y"); ?>" required="required" readonly="readonly" />
									</td>
									<td> Time of Occurence :</td>
									<td>
									<input type="" class="form-control text-uppercase" id="time_occurrence" name="ocured_time" value="<?php if(empty($ocured_time)){echo date('H:m');} else {echo $ocured_time;} ?>" class="mytime" /></td>
							</tr>
							<tr>
								<td>3. Name of nearest Fire &amp; Emergency Services Station :<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                  <td><?php 
											//$b_dist_id=$formFunctions->get_district_id($b_dist);	
											$fire_stations=$formFunctions->executeQuery($dept,"select * from nearest_fire_stations where district_id='$b_dist_id'"); ?>
											<select name="nearest_station" class="form-control text-uppercase" required="required">
												<option value="">Please Select Nearest Fire Station</option>
												<?php while($rows=$fire_stations->fetch_object()) {
													if(isset($nearest_station) && ($nearest_station==$rows->id)){
														$s='selected'; 
													}else{
														$s='';
													}  ?>
													<option value="<?php echo $rows->id; ?>" <?php echo $s;?>><?php echo $rows->nearest_fire_station; ?></option>
												<?php }		?>
											</select></td>
								

								<td>4. Distance from the Fire &amp; E.S. Station to the place of occurence in KM :<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								</td>
								<td><input type="text" class="form-control text-uppercase" validate="decimal" name="distance_fire" required="required" placeholder="Distance (Km)"  value="<?php echo $distance_fire; ?>"/></td>
							</tr>
							<tr>
								<td colspan="3">5. Place of Occurrence :<span class="mandatory_field">*</span></td>
							</tr>	
							 <tr>
								  <td>Village/Town&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  <td><input type="text" class="form-control text-uppercase" name="place_occurrence[vt]" required="required" id="place_occurrence[vt]" value="<?php echo $place_occurrence_vt;?>" /></td>
								
									<td>Ward No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td><input type="text" class="form-control text-uppercase"  value="<?php echo $place_occurrence_w;?>" required="required" name="place_occurrence[w]" id="place_occurrence[w]" /></td>
							  </tr>
							  <tr>
									 <td>Holding No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									 <td><input type="text" class="form-control text-uppercase" required="required"  name="place_occurrence[h]" value="<?php echo $place_occurrence_h;?>" id="place_occurrence[h]"/></td>
									<td>Police Station </td>
									<td><input type="text" class="form-control text-uppercase"  required="required" name="place_occurrence[p]" value="<?php echo $place_occurrence_p;?>"/></td>
							 </tr>
							 <tr>
									<td>District</td>
                                      <td><input type="text" name="place_occurrence[d]" id="textfield47"  class="form-control text-uppercase" value="<?php  echo $place_occurrence_d; ?>" required="required"/></td>
									
								</tr>
							<tr>
								<td colspan="3" >6. Name &amp; Address of Owner of the Property :<span class="mandatory_field">*</span></td>
							</tr>
							<tr>
								<td>Owner Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td><input type="text" class="form-control text-uppercase" validate="letters" required="required" placeholder="Owner's Name"  name="owner_address[name]" id="owner_name" value="<?php echo $owner_address_name;?>" /></td>
							 
								<td> Village/Town </td>
								<td><input type="text" class="form-control text-uppercase"  name="owner_address[vt]" id="owner_address[vt]" required="required" value="<?php echo $owner_address_vt;?>"/></td>
							 </tr>
							<tr>
								<td>Ward No</td>
								<td><input type="text" class="form-control text-uppercase" name="owner_address[w]" id="owner_address[w]" required="required" value="<?php echo $owner_address_w;?>" /></td>
							 
								<td>Holding No</td>
								<td><input type="text" class="form-control text-uppercase"  name="owner_address[h]" id="owner_address[h]" required="required" value="<?php echo $owner_address_h;?>"/></td>
							 </tr>
							 <tr>
								<td>Police Station</td>
								<td><input type="text" class="form-control text-uppercase" name="owner_address[p]" required="required" value="<?php echo $owner_address_p;?>" /></td>
								<td>District</td>
                                <td><input type="text" name="owner_address[d]" id="textfield47"  class="form-control text-uppercase" value="<?php  echo $owner_address_d; ?>" required="required"/></td>
								
							</tr>
							<tr>						
								<td class="text-center" colspan="4">
									<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
								</td>
								<td></td>
							</tr>
							</table>
							</form>
						</div>
					<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
					<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
					 <table id="" class="table table-responsive">
						 <tr>						
							<td colspan="4">7. Name &amp; Address of the occupants : <span class="mandatory_field">*</span></td>
						</tr>
						<tr>
							<td width="25%">Name :</td>
							<td width="25%"><input type="text" name="occupant_address[name];" class="form-control text-uppercase" validate="letters" id="textfield43" value="<?php  echo $occupant_address_name;; ?>" required="required"  />
							 
							</td>
					
							<td width="25%">Village/Town :</td>
							<td width="25%"><input type="text" name="occupant_address[vt]" class="form-control text-uppercase" id="textfield44" required="required" value="<?php echo $occupant_address_vt; ?>" /></td>
						</tr>
						 <tr>
							<td>Ward No :</td>
							<td><input type="text" name="occupant_address[w]" class="form-control text-uppercase" id="textfield45" value="<?php echo $occupant_address_w; ?>" /></td>
					
							<td>Holding No :</td>
							<td><input type="text" name="occupant_address[h]" class="form-control text-uppercase"id="textfield46" required="required" value="<?php echo $occupant_address_h; ?>" /></td>
						</tr>
					
						 <tr>
							<td>Police Station :</td>
							<td><input ype="text"  class="form-control text-uppercase" name="occupant_address[p]" required="required" value="<?php echo $occupant_address_p; ?>" /></td>
					
							<td>District :</td>
                             <td><input type="text" name="occupant_address[d]" id="textfield47"  class="form-control text-uppercase" value="<?php  echo $occupant_address_d; ?>" required="required"/></td>
							
						</tr>
						<tr>
							<td colspan="2">8. Brief Description of Property involved and gutted in fire : <span class="mandatory_field">*</span></td>
						</tr>
								  
						<tr>
								<td>a. Nature of construction of the building :</td>
								<td><input type="text" name="fire_desc[a];" class="form-control text-uppercase" value="<?php  echo $fire_desc_a; ?>" required="required"  />
								</td>
								<td>b. Height of the building :</td>
								<td><input type="text" name="fire_desc[b]"  class="form-control text-uppercase"id="textfield44" required="required" value="<?php echo $fire_desc_b; ?>" /></td>
						</tr>
						<tr>
								<td>c. Number of Floors :</td>
								<td><input type="text" name="fire_desc[c]"  class="form-control text-uppercase" id="textfield45" validate="onlyNumbers" pattern="[0-9]{1,5}" title="Only Numbers are allowed"value="<?php echo $fire_desc_c; ?>" /></td>
								<td>d. Covered Floor Area :</td>
								<td><input type="text" name="fire_desc[d]" class="form-control text-uppercase"id="textfield46" required="required" value="<?php echo $fire_desc_d; ?>" /></td>
						</tr>
						<tr>
								<td>e. Description of internal contents :</td>
								<td><textarea type="text" name="description" class="form-control text-uppercase" id="description" required="required" /><?php echo $description; ?></textarea></td>
						<tr>
							<td colspan="2">9. Documentary/ Evidential proof of Property gutted / involved in Fire : <span class="mandatory_field">*</span></td>			
						</tr>
						<tr>
								<td>a. Holding No. of the building :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td><input type="text" name="holding_no" class="form-control text-uppercase" id="holding_no" value="<?php  echo $holding_no; ?>" required="required"  />
								</td>
								<td>b. Insurance policy :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td><input type="text" name="insurance" class="form-control text-uppercase" id="insurance" required="required" value="<?php echo $insurance; ?>" /></td>
						</tr>
						<tr>
								<td colspan="3">c. Fire Safety N.O.C./ Trade License/ any other License or Permission etc. from concerned authority :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td><input type="text" name="noc" class="form-control text-uppercase" id="noc" required="required" value="<?php echo $noc; ?>" /></td>
						</tr>
						<tr>	
							<td >10. Description of internal Content/ Property :<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
							<td  ><textarea type="text" required="required" class="form-control text-uppercase" name="descript_property" id="descript_property"><?php echo $descript_property;?></textarea></td>
						</tr>
						<tr>
							<td >11. a. Property Insured :<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td align="left"><textarea type="text" class="form-control text-uppercase"  required="required" name="property_insured" id="property_insured"><?php echo $property_insured;?></textarea></td>
						
							<td >&nbsp;&nbsp;&nbsp;&nbsp; b. Property uninsured :<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td align="left"><textarea type="text"  required="required" class="form-control text-uppercase" name="property_uninsured" id="property_uninsured"><?php echo $property_uninsured;?></textarea></td>
						</tr>
						<tr>
							<td >12. If Human Life or Animal Life injured/lost if any, give details :</td>
							<td align="left"><textarea type="text"  name="human_life" class="form-control text-uppercase" id="human_life"><?php echo $human_life;?></textarea></td>
						</tr>
						 <tr>
							<td class="text-center" colspan="4">
								<a href="<?php echo $table_name;?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>
									<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success submit1">Save and Next</button>
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
</div>
</section>
</div>
  <!-- /.content-wrapper -->
  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
$('#date_occurrence').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});

    $('.time_occurrence').timepicker({ timeFormat: 'h:mm:ss p' });
	
/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	
$('#dist1').change(function(){
	var city=$(this).val();
	$('#block1').empty();
	$.ajax({ 
		type: 'GET',
		url: '../../../ajax/district_blocks.php', 
		data: { city: city },
		beforeSend:function(){
			$("#block1").html("Loading..");
		},
		success:function(data){
			$("#block1").html(data);
		},
		error:function(){ }
	}); //ajax end
});
</script>