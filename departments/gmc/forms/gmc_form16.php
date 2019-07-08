<?php  require_once "../../requires/login_session.php";
$dept="gmc";
$form="16";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";
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
		$form_id=$results["form_id"];
		$father_name=$results["father_name"];$ward_no=$results["ward_no"];$house_no=$results["house_no"];$road_name=$results["road_name"];$const_year=$results["const_year"];$is_pipe=$results["is_pipe"];$is_use=$results["is_use"];	
		
		if(!empty($results["plinth"])){
			$plinth=json_decode($results["plinth"]);
			$plinth_base=$plinth->base;$plinth_muzz=$plinth->muzz;$plinth_ground=$plinth->ground;$plinth_first=$plinth->first;$plinth_second=$plinth->second;$plinth_third=$plinth->third;$plinth_fourth=$plinth->fourth;$plinth_fifth=$plinth->fifth;
		}else{				
			$plinth_base="";$plinth_muzz="";$plinth_ground="";$plinth_first="";$plinth_second="";$plinth_third="";$plinth_fourth="";$plinth_fifth="";
		}
		if(!empty($results["area"])){
			$area=json_decode($results["area"]);
			$area_land=$area->land;$area_dag=$area->dag;$area_patta=$area->patta;$area_vill=$area->vill;$area_mouza=$area->mouza;
		}else{				
			$area_land="";$area_dag="";$area_patta="";$area_vill="";$area_mouza="";
		}
		if(!empty($results["holdings"])){
			$holdings=json_decode($results["holdings"]);
			$holdings_no=$holdings->no;$holdings_arv=$holdings->arv;$holdings_owner=$holdings->owner;
		}else{				
			$holdings_no="";$holdings_arv="";$holdings_owner="";
		}
		if(!empty($results["owner"])){
			$owner=json_decode($results["owner"]);
			$owner_certify=$owner->certify;$owner_sign=$owner->sign;$owner_contact=$owner->contact;
		}else{				
			$owner_certify="";$owner_sign="";$owner_contact="";
		}
	}else{			
		$form_id="";
		$father_name="";$ward_no="";$house_no="";$road_name="";$const_year="";$is_pipe="";$is_use="";
		$plinth_base="";$plinth_muzz="";$plinth_ground="";$plinth_first="";$plinth_second="";$plinth_third="";$plinth_fourth="";$plinth_fifth="";
		$area_land="";$area_dag="";$area_patta="";$area_vill="";$area_mouza="";
		$holdings_no="";$holdings_arv="";$holdings_owner="";
		$owner_certify="";$owner_sign="";$owner_contact="";
	}	
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$father_name=$results["father_name"];$ward_no=$results["ward_no"];$house_no=$results["house_no"];$road_name=$results["road_name"];$const_year=$results["const_year"];$is_pipe=$results["is_pipe"];$is_use=$results["is_use"];	
		
	if(!empty($results["plinth"])){
		$plinth=json_decode($results["plinth"]);
		 if(isset($plinth->base)) $plinth_base=$plinth->base; else $plinth_base="";
        if(isset($plinth->muzz)) $plinth_muzz=$plinth->muzz; else $plinth_muzz="";
        if(isset($plinth->ground)) $plinth_ground=$plinth->ground; else $plinth_ground="";
        if(isset($plinth->first)) $plinth_first=$plinth->first; else $plinth_first="";
        if(isset($plinth->second)) $plinth_second=$plinth->second; else $plinth_second="";
        if(isset($plinth->third)) $plinth_third=$plinth->third; else $plinth_third="";
        if(isset($plinth->fourth)) $plinth_fourth=$plinth->fourth; else $plinth_fourth="";
        if(isset($plinth->fifth)) $plinth_fifth=$plinth->fifth; else $plinth_fifth="";
	}else{				
		$plinth_base="";$plinth_muzz="";$plinth_ground="";$plinth_first="";$plinth_second="";$plinth_third="";$plinth_fourth="";$plinth_fifth="";
	}
	if(!empty($results["area"])){
		$area=json_decode($results["area"]);
		$area_land=$area->land;$area_dag=$area->dag;$area_patta=$area->patta;$area_vill=$area->vill;$area_mouza=$area->mouza;
	}else{				
		$area_land="";$area_dag="";$area_patta="";$area_vill="";$area_mouza="";
	}
	if(!empty($results["holdings"])){
		$holdings=json_decode($results["holdings"]);
		$holdings_no=$holdings->no;$holdings_arv=$holdings->arv;$holdings_owner=$holdings->owner;
	}else{				
		$holdings_no="";$holdings_arv="";$holdings_owner="";
	}
	if(!empty($results["owner"])){
		$owner=json_decode($results["owner"]);
		$owner_certify=$owner->certify;$owner_sign=$owner->sign;$owner_contact=$owner->contact;
	}else{				
		$owner_certify="";$owner_sign="";$owner_contact="";
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform14" id="myformFT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td width="25%">1. Name of the Owners : </td>
											<td width="25%"><input class="form-control text-uppercase" type="text"  value="<?php echo $owner_names; ?>" disabled="disabled"></td>
											<td width="25%">2. Father/Husband's Name : </td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="father_name" value="<?php echo $father_name; ?>"></td>
										</tr>
										<tr>
											<td>3.(a) Ward No : </td>
											<td><input class="form-control text-uppercase" type="text" name="ward_no" value="<?php echo $ward_no; ?>"></td>
											<td>(b) House No. (If any) : </td>
											<td><input class="form-control text-uppercase" type="text" name="house_no" value="<?php echo $house_no; ?>"></td>
										</tr>
										<tr>
											<td>4. Name of the Road : </td>
											<td><input class="form-control text-uppercase" type="text" name="road_name" value="<?php echo $road_name; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">5. Plinth area of the building, (Floor wise area in case of multi storied buildings) : </td>
										</tr>
										<tr>
											<td>(i) Basement Floor : </td>
											<td><input class="form-control text-uppercase" type="text" name="plinth[base]" value="<?php echo $plinth_base; ?>"></td>
											<td>(ii) Muzzling Floor : </td>
											<td><input class="form-control text-uppercase" type="text" name="plinth[muzz]" value="<?php echo $plinth_muzz; ?>"></td>											
										</tr>
										<tr>
											<td>(iii) Ground Floor : </td>
											<td><input class="form-control text-uppercase" type="text" name="plinth[ground]" value="<?php echo $plinth_ground; ?>"></td>
											<td>(iv) First Floor : </td>
											<td><input class="form-control text-uppercase" type="text" name="plinth[first]" value="<?php echo $plinth_first; ?>"></td>											
										</tr>
										<tr>
											<td>(v) 2nd Floor : </td>
											<td><input class="form-control text-uppercase" type="text" name="plinth[second]" value="<?php echo $plinth_second; ?>"></td>
											<td>(vi) 3rd Floor : </td>
											<td><input class="form-control text-uppercase" type="text" name="plinth[third]" value="<?php echo $plinth_third; ?>"></td>											
										</tr>
										<tr>
											<td>(vii) 4th Floor : </td>
											<td><input class="form-control text-uppercase" type="text" name="plinth[fourth]" value="<?php echo $plinth_fourth; ?>"></td>
											<td>(viii) 5th Floor : </td>
											<td><input class="form-control text-uppercase" type="text" name="plinth[fifth]" value="<?php echo $plinth_fifth; ?>"></td>											
										</tr>										
										<tr>
											<td>6. Year of Construction : </td>
											<td><input class="form-control text-uppercase" type="text" name="const_year" value="<?php echo $const_year; ?>" maxlength="4" validate="onlyNumbers" placeholder="YYYY"></td>
											<td>7. Water Pipe Connection : </td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_pipe" value="Y"  <?php if(isset($is_pipe) && $is_pipe=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" value="N"  name="is_pipe" <?php if(isset($is_pipe) && ($is_pipe=='N' || $is_pipe=='')) echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td>8. Use of the building : </td>
											<td colspan="3">
												<label class="radio-inline"><input type="radio" name="is_use"  value="S" <?php if(isset($is_use) && ($is_use=='S' || $is_use=='')) echo 'checked'; ?> required="required"/> Self used Residence </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" name="is_use"  value="R"  <?php if(isset($is_use) && $is_use=='R') echo 'checked'; ?>/> Rented for residence </label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" name="is_use"  value="C"  <?php if(isset($is_use) && $is_use=='C') echo 'checked'; ?>/> Commercial use </label>
											</td>
										</tr>
										<tr>
											<td>9. (a) Area of Land : </td>
											<td><input class="form-control text-uppercase" type="text" name="area[land]" value="<?php echo $area_land; ?>"></td>
											<td>(b) Dag No. : </td>
											<td><input class="form-control text-uppercase" type="text" name="area[dag]" value="<?php echo $area_dag; ?>"></td>
										</tr>
										<tr>
											<td>(c) Patta No : </td>
											<td><input class="form-control text-uppercase" type="text" name="area[patta]" value="<?php echo $area_patta; ?>"></td>
											<td>(d) Village : </td>
											<td><input class="form-control text-uppercase" type="text" name="area[vill]" value="<?php echo $area_vill; ?>"></td>
										</tr>
										<tr>
											<td>(e) Mouza : </td>
											<td><input class="form-control text-uppercase" type="text" name="area[mouza]" value="<?php echo $area_mouza; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">10. No. of Holdings if any : </td>
										</tr>
										<tr>
											<td>(a) Holding No : </td>
											<td><input class="form-control text-uppercase" type="text" name="holdings[no]" value="<?php echo $holdings_no; ?>"></td>
											<td>(b) Old A.R.V. : </td>
											<td><input class="form-control text-uppercase" type="text" name="holdings[arv]" value="<?php echo $holdings_arv; ?>"></td>											
										</tr>
										<tr>
											<td>(c) Name of the Owner of the Holding : </td>
											<td><input class="form-control text-uppercase" type="text" name="holdings[owner]" value="<?php echo $holdings_owner; ?>"></td>
											<td colspan="2"></td>											
										</tr>
										<tr>
											<td colspan="2">11. Copy of the Building Permission (If any) : </td>
											<td colspan="2">Upload later in upload section </td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">I, &nbsp;<input type="text"  class="form-control text-uppercase" name="owner[certify]" value="<?php echo $owner_certify;?>">&nbsp; submitting the above information to the Corporation, as required under section 163 of the Guwahati Municipal Corporation Act, 1969 and I certify that above particulars furnished by me is true to the best of my knowledge and belief.</td>
										</tr>										
										<tr class="form-inline">
											<td colspan="2"><strong>Date : <?php echo date('d-m-Y',strtotime($today));?></strong></td>
											<td colspan="2" align="right">Signature of the Owner of the Holdings : &nbsp;<input type="text"  class="form-control text-uppercase" name="owner[sign]" value="<?php echo $owner_sign;?>"><br/>Contact No. : &nbsp;<input type="text"  class="form-control text-uppercase" name="owner[contact]" value="<?php echo $owner_contact;?>" validate="mobileNumber" maxlength="10"></td>
										</tr>	
										<tr>
											<td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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