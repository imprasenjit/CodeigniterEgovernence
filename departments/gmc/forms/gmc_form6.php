<?php  require_once "../../requires/login_session.php";
$dept="gmc";
$form="6";
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
			$form_id=$results["form_id"];$father_name=$results["father_name"];$road_name=$results["road_name"];$cons_year=$results["cons_year"];$w_pipe=$results["w_pipe"];$build_use=$results["build_use"];$l_area=$results["l_area"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$l_vill=$results["l_vill"];$mouza=$results["mouza"];$hold_no=$results["hold_no"];$old_arv=$results["old_arv"];$b_owner_name=$results["b_owner_name"];
			if(!empty($results["plinth"])){
				$plinth=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["plinth"]));
                if(isset($plinth->base)) $plinth_base=$plinth->base; else $plinth_base="";
                if(isset($plinth->muzzl)) $plinth_muzzl=$plinth->muzzl; else $plinth_muzzl="";
                if(isset($plinth->ground)) $plinth_ground=$plinth->ground; else $plinth_ground="";
                if(isset($plinth->first)) $plinth_first=$plinth->first; else $plinth_first="";
                if(isset($plinth->sec)) $plinth_sec=$plinth->sec; else $plinth_sec="";
                if(isset($plinth->third)) $plinth_third=$plinth->third; else $plinth_third="";
                if(isset($plinth->forth)) $plinth_forth=$plinth->forth; else $plinth_forth="";
                if(isset($plinth->fifth)) $plinth_fifth=$plinth->muzzl; else $plinth_fifth="";
				
			}else{
				$plinth_base="";$plinth_muzzl="";$plinth_ground="";$plinth_first="";$plinth_sec="";$plinth_third="";$plinth_forth="";$plinth_fifth="";
			}
		}else{
			$form_id="";$father_name="";$road_name="";$cons_year="";$w_pipe="";$build_use="";$l_area="";$dag_no="";$patta_no="";$l_vill="";$mouza="";$hold_no="";$old_arv="";$b_owner_name="";$plinth_base="";$plinth_muzzl="";$plinth_ground="";$plinth_first="";$plinth_sec="";$plinth_third="";$plinth_forth="";$plinth_fifth="";
		}
	}else{	
		$results=$q->fetch_array();		
		$form_id=$results["form_id"];$father_name=$results["father_name"];$road_name=$results["road_name"];$cons_year=$results["cons_year"];$w_pipe=$results["w_pipe"];$build_use=$results["build_use"];$l_area=$results["l_area"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$l_vill=$results["l_vill"];$mouza=$results["mouza"];$hold_no=$results["hold_no"];$old_arv=$results["old_arv"];$b_owner_name=$results["b_owner_name"];
		if(!empty($results["plinth"])){
			$plinth=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["plinth"]));
             if(isset($plinth->base)) $plinth_base=$plinth->base; else $plinth_base="";
                if(isset($plinth->muzzl)) $plinth_muzzl=$plinth->muzzl; else $plinth_muzzl="";
                if(isset($plinth->ground)) $plinth_ground=$plinth->ground; else $plinth_ground="";
                if(isset($plinth->first)) $plinth_first=$plinth->first; else $plinth_first="";
                if(isset($plinth->sec)) $plinth_sec=$plinth->sec; else $plinth_sec="";
                if(isset($plinth->third)) $plinth_third=$plinth->third; else $plinth_third="";
                if(isset($plinth->forth)) $plinth_forth=$plinth->forth; else $plinth_forth="";
                if(isset($plinth->fifth)) $plinth_fifth=$plinth->muzzl; else $plinth_fifth="";
			
		}else{
			$plinth_base="";$plinth_muzzl="";$plinth_ground="";$plinth_first="";$plinth_sec="";$plinth_third="";$plinth_forth="";$plinth_fifth="";
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
								<input type="hidden" class="form-control text-uppercase" name="gmc_zone" value="<?php echo $gmc_zone; ?>" />
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1. Name of the owners :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $owner_names; ?>" disabled="disabled" /></td>
											<td width="25%">2. Father&apos;/ Husband&apos;s name :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="father_name" value="<?php echo $father_name; ?>" /></td>
										</tr>
										<tr>
											<td>3.(a) Ward No. :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $gmc_zone; ?>" /></td>
											<td>(b) House No.(If any) :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>" /></td>
										</tr>
										<tr>
											<td>4. Name of the road :</td>
											<td><input type="text" class="form-control text-uppercase" name="road_name" value="<?php echo $road_name; ?>" /></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">5. Plinth area of the building, (Floor wise area in case of multi storied buildings) :</td>
										</tr>
										<tr>
											<td>i. Basement Floor </td>
											<td><input type="text" class="form-control text-uppercase" name="plinth[base]" value="<?php echo $plinth_base; ?>" /></td>
											<td>ii. Muzzling Floor </td>
											<td><input type="text" class="form-control text-uppercase" name="plinth[muzzl]" value="<?php echo $plinth_muzzl; ?>" /></td>
										</tr>
										<tr>
											<td>iii. Ground Floor </td>
											<td><input type="text" class="form-control text-uppercase" name="plinth[ground]" value="<?php echo $plinth_ground; ?>" /></td>
											<td>iv. First Floor </td>
											<td><input type="text" class="form-control text-uppercase" name="plinth[first]" value="<?php echo $plinth_first; ?>" /></td>
										</tr>
										<tr>
											<td>v. 2 nd Floor </td>
											<td><input type="text" class="form-control text-uppercase" name="plinth[sec]" value="<?php echo $plinth_sec; ?>" /></td>
											<td>vi. 3 rd Floor </td>
											<td><input type="text" class="form-control text-uppercase" name="plinth[third]" value="<?php echo $plinth_third; ?>" /></td>
										</tr>
										<tr>
											<td>vii. 4 Th Floor </td>
											<td><input type="text" class="form-control text-uppercase" name="plinth[forth]" value="<?php echo $plinth_forth; ?>" /></td>
											<td>viii. 5 Th Floor </td>
											<td><input type="text" class="form-control text-uppercase" name="plinth[fifth]" value="<?php echo $plinth_fifth; ?>" /></td>
										</tr>
										<tr>
											<td>6. Year of Construction :</td>
											<td><input type="text" class="form-control text-uppercase" name="cons_year" value="<?php echo $cons_year;?>" /></td>
											<td>7.Water Pipe Connection :</td>
											<td>
												<label class="radio-inline"><input checked type="radio" <?php if($w_pipe=="Y" || $w_pipe=="") echo "checked"; ?> value="Y" name="w_pipe"> Yes </label>
												<label class="radio-inline"><input type="radio" <?php if($w_pipe=="N") echo "checked"; ?> value="N" name="w_pipe"> No </label>
											</td>
										</tr>
										<tr>
											<td>8. Use of the building :</td>
											<td>
												<select name="build_use" class="form-control text-uppercase" required="required">
													<option value="">Please Select</option>
													<option <?php if($build_use=="S" || $build_use=="") echo "selected"; ?> value="S">Self used Residence</option>
													<option <?php if($build_use=="R") echo "selected"; ?> value="R">Rented for residence</option>
													<option <?php if($build_use=="C") echo "selected"; ?> value="C">Commercial use</option>						
												</select>
											</td>
											<td>9. Area of Land :</td>
											<td><input type="text" class="form-control text-uppercase" name="l_area" value="<?php echo $l_area;?>" /></td>
										</tr>
										<tr>
											<td>Dag No.</td>
											<td><input type="text" class="form-control text-uppercase" name="dag_no" value="<?php echo $dag_no;?>" /></td>
											<td>Patta No.</td>
											<td><input type="text" class="form-control text-uppercase" name="patta_no"  value="<?php echo $patta_no;?>" /></td>
										</tr>
										<tr>
											<td>Village</td>
											<td><input type="text" class="form-control text-uppercase" name="l_vill" value="<?php echo $l_vill;?>" /></td>
											<td>Mouza</td>
											<td><input type="text" class="form-control text-uppercase" name="mouza" value="<?php echo $mouza;?>" /></td>
										</tr>
										<tr>
											<td colspan="4">10. No. Of Holdings if any :</td>
										</tr>
										<tr>
											<td>(a) Holding No :</td>
											<td><input type="text" class="form-control text-uppercase" name="hold_no" value="<?php echo $hold_no;?>" /></td>
											<td>(b) Old A.R.V. :</td>
											<td><input type="text" class="form-control text-uppercase" name="old_arv" value="<?php echo $old_arv;?>" /></td>
										</tr>
										<tr>
											<td>(c) Name of the Owner of the Holding :</td>
											<td><input type="text" class="form-control text-uppercase" name="b_owner_name" value="<?php echo $b_owner_name;?>" /></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>11. Copy of the Building Permission (If any) :</td>
											<td>Upload later in Upload Section</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">I <input type="text" class="form-control1 text-uppercase" value="<?php echo $key_person;?>" disabled="disabled" /> submitting the above information to the Corporation,as required under section 163 of the Guwahati Municipal Corporation Act. 1969 and I certify that above particulars furnished by me is true to the best of my knowledge and belief.</td>
										</tr>
										<tr>
											<td>Date</td>
											<td><?php echo date('d-m-Y',strtotime($today)); ?></td>
											<td>Signature of the Owner of the Holdings.</td>
											<td><?php echo strtoupper($key_person); ?></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td>Contact No.</td>
											<td><?php echo strtoupper($mobile_no);?></td>
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>