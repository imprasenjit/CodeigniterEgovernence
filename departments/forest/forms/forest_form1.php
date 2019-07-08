<?php  require_once "../../requires/login_session.php";
$dept="forest";
$form="1";
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
			$fat_name=$results['fat_name'];

			if(!empty($results["fat_address"])){
				$fat_address=json_decode($results["fat_address"]);
				$fat_address_s1=$fat_address->s1;$fat_address_s2=$fat_address->s2;$fat_address_v=$fat_address->v;$fat_address_d=$fat_address->d;$fat_address_pin=$fat_address->pin;
			}else{
				$fat_address_s1="";$fat_address_s2="";$fat_address_v="";$fat_address_d="";$fat_address_pin="";
			}
			if(!empty($results["patt_details"])){
				$patt_details=json_decode($results["patt_details"]);
				$patt_details_dag_no=$patt_details->dag_no;$patt_details_mouza=$patt_details->mouza;$patt_details_patta_no=$patt_details->patta_no;$patt_details_rc=$patt_details->rc;$patt_details_area_plot=$patt_details->area_plot;$patt_details_nature=$patt_details->nature;$patt_details_year_patta=$patt_details->year_patta;
			}else{
				$patt_details_dag_no="";$patt_details_mouza="";$patt_details_patta_no="";$patt_details_rc="";$patt_details_area_plot="";$patt_details_nature="";$patt_details_year_patta="";
			}
			if(!empty($results["details_plantation"])){
				$details_plantation=json_decode($results["details_plantation"]);
				$details_plantation_area=$details_plantation->area;$details_plantation_avg_girth=$details_plantation->avg_girth;$details_plantation_avg_height=$details_plantation->avg_height;$details_plantation_bound_desc=$details_plantation->bound_desc;$details_plantation_year=$details_plantation->year;
			}else{
				$details_plantation_area="";$details_plantation_avg_girth="";$details_plantation_avg_height="";$details_plantation_bound_desc="";$details_plantation_year="";
			}
		}else{
			$form_id="";
			$fat_name="";
			$fat_address_s1="";$fat_address_s2="";$fat_address_v="";$fat_address_d="";$fat_address_pin="";
			$patt_details_dag_no="";$patt_details_mouza="";$patt_details_patta_no="";$patt_details_rc="";$patt_details_area_plot="";$patt_details_nature="";$patt_details_year_patta="";
			$details_plantation_area="";$details_plantation_avg_girth="";$details_plantation_avg_height="";$details_plantation_bound_desc="";$details_plantation_year="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$fat_name=$results['fat_name'];

		if(!empty($results["fat_address"])){
			$fat_address=json_decode($results["fat_address"]);
			$fat_address_s1=$fat_address->s1;$fat_address_s2=$fat_address->s2;$fat_address_v=$fat_address->v;$fat_address_d=$fat_address->d;$fat_address_pin=$fat_address->pin;
		}else{
			$fat_address_s1="";$fat_address_s2="";$fat_address_v="";$fat_address_d="";$fat_address_pin="";
		}
		if(!empty($results["patt_details"])){
			$patt_details=json_decode($results["patt_details"]);
			$patt_details_dag_no=$patt_details->dag_no;$patt_details_mouza=$patt_details->mouza;$patt_details_patta_no=$patt_details->patta_no;$patt_details_rc=$patt_details->rc;$patt_details_area_plot=$patt_details->area_plot;$patt_details_nature=$patt_details->nature;$patt_details_year_patta=$patt_details->year_patta;
		}else{
			$patt_details_dag_no="";$patt_details_mouza="";$patt_details_patta_no="";$patt_details_rc="";$patt_details_area_plot="";$patt_details_nature="";$patt_details_year_patta="";
		}
		if(!empty($results["details_plantation"])){
			$details_plantation=json_decode($results["details_plantation"]);
			$details_plantation_area=$details_plantation->area;$details_plantation_avg_girth=$details_plantation->avg_girth;$details_plantation_avg_height=$details_plantation->avg_height;$details_plantation_bound_desc=$details_plantation->bound_desc;$details_plantation_year=$details_plantation->year;
		}else{
			$details_plantation_area="";$details_plantation_avg_girth="";$details_plantation_avg_height="";$details_plantation_bound_desc="";$details_plantation_year="";
		}
	}
?>
<?php require_once "../../requires/header.php";   ?>

        <?php include ("".$table_name."_Addmore-operation.php"); ?>
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4" class="form-inline">To,<br/>
										&emsp;&emsp;The Divisional Forest Officer<br/>
										&emsp;&emsp;<input type="text" disabled  value="<?php echo $b_block; ?>" class="form-control text-uppercase"> &nbsp;Division;<br/>
										&emsp;&emsp;<input type="text" disabled  value="<?php echo $b_dist; ?>" class="form-control text-uppercase" > 
										</td>
										
									</tr>
									<tr>
										<td colspan="4">Sub: <strong>Request for Registration of Plantation raised on my/our non-forest land.</strong></td>
									</tr>
									<tr>
										<td colspan="4">Sir,<br/>
										&emsp;&emsp;&emsp;&emsp;I/We would request you to kindly register the plantation of trees raised on my/our Pattaland. The details of the land and plantation along with the required documents are furnished below:</td>
									</tr>
									<tr>
										<td colspan="4">1. Name and address of the Pattader :</td>
									</tr>
									<tr>
										<td width="25%">Name</td>
										<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
										<td>Street Name 2</td>
										<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
										<td>District</td>
										<td><input type="text" disabled value="<?php echo $dist; ?>"  class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
										<td>Mobile</td>
										<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>Phone Number</td>
										<td><input type="text" disabled value="<?php echo $b_landline_std.'-'.$b_landline_no; ?>" class="form-control"></td>
										<td>Email-id</td>
										<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td colspan="4">2. Father's name and address :<span class="mandatory_field">*</span></td>
									</tr>
									<tr>
										<td>Father Name</td>
										<td><input type="text" required  name="fat_name" validate="letters" value="<?php echo $fat_name; ?>" class="form-control text-uppercase"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" name="fat_address[s1]" required value="<?php echo $fat_address_s1; ?>" class="form-control text-uppercase"></td>
										<td>Street Name 2</td>
										<td><input type="text"  name="fat_address[s2]" required value="<?php echo $fat_address_s2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" name="fat_address[v]" required value="<?php echo $fat_address_v; ?>" class="form-control text-uppercase"></td>
										<td>District</td>
                                        <td><input type="text" name="fat_address[d]" id="dist" required value="<?php echo $fat_address_d; ?>" class="form-control text-uppercase"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text"  name="fat_address[pin]" validate="pincode" value="<?php echo $fat_address_pin; ?>" maxlength="6" class="form-control"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">3. Details of the Pattaland over which the plantation has been raised :<span class="mandatory_field">*</span></td>
									</tr>
									<tr>
										<td>Dag No</td>
										<td><input type="text"  required  name="patt_details[dag_no]" value="<?php echo $patt_details_dag_no; ?>" class="form-control text-uppercase"></td>
										<td>Patta No</td>
										<td><input type="text"  name="patt_details[patta_no]" required value="<?php echo $patt_details_patta_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Mouza</td>
										<td><input type="text" name="patt_details[mouza]" required value="<?php echo $patt_details_mouza; ?>" class="form-control text-uppercase"></td>
										<td>Revenue Circle</td>
										<td><input type="text" name="patt_details[rc]" required  value="<?php echo $patt_details_rc; ?>" class="form-control text-uppercase" ></td>
									</tr>
									<tr>
										<td>Area of Plot(in Bigha or Hect)</td>
										<td><input type="text" name="patt_details[area_plot]" required value="<?php echo $patt_details_area_plot; ?>"  class="form-control text-uppercase"></td>
										<td>Year of issue of Patta</td>
										<td>
											<select id="issue_patta" class="form-control text-uppercase"  name="patt_details[year_patta]" value="<?php echo $patt_details_year_patta; ?>">
											<?php
											$curyear=date('Y');
											for($i=1951;$i<=$curyear;$i++){
												if($patt_details_year_patta==true){
												   if($patt_details_year_patta==$i){
												   echo "<option value=".$i." selected>".$i."</option>";
												   }else{
													echo "<option value=".$i.">".$i."</option>";
																	}
																   
													}else{
													echo "<option value=".$i.">".$i."</option>";
																}
												}
											?>
											</select>
										</td>
									</tr>
									<tr>
										<td>Nature of Patta(Annual/Periodic/Special grant)</td>
										<td>
											<select required class="form-control text-uppercase" name="patt_details[nature]" id="nature" value="<?php echo $patt_details_nature; ?>">
											<option value="A" <?php if($patt_details_nature=='' or $patt_details_nature=='A') echo 'selected';?>>Annual</option>
											<option value="P" <?php if($patt_details_nature=='P') echo 'selected';?>>Periodic</option>
											<option value="SG" <?php if($patt_details_nature=='SG') echo 'selected';?>>Special Grant</option>
											</select>
										</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">4.Details of the Plantation :<span class="mandatory_field">*</span></td>
									</tr>
									<tr>
										<td>(a) Years of Creation :</td>
										<td><input type="text" name="details_plantation[year]" validate="onlyNumbers" value="<?php echo $details_plantation_year; ?>" required class="form-control text-uppercase"></td>
										<td>(b) Area :</td>
										<td><input type="text" name="details_plantation[area]" value="<?php echo $details_plantation_area; ?>" required class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4">(c) Species wise no. of trees planted and Spacing :</td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
											<thead>
												<tr>
													<th width="5%" align="center">Sl. No.</th>
													<th width="20%" align="center">Name of the Species (Locale/Botanical)</th>
													<th width="20%" align="center">Approximate Spacing</th>
													<th width="20%" align="center">No. of trees planted</th>
												</tr>
											</thead>
												<?php
												 $part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
														$count=1;
														while($row_1=$part1->fetch_array())
													   {	?>
												<tbody>
												<tr>								
													<td  align="center"><input type="text" class="form-control text-uppercase" readonly="readonly" id="txtA<?php echo $count;?>" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1" ></td>
													<td  align="center"><input type="text" class="form-control text-uppercase" size="20"value="<?php echo $row_1["species"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txtB <?php echo $count;?>" name="txtB<?php echo $count;?>"></td>
													<td  align="center"><input type="text" class="form-control text-uppercase" size="15" value="<?php echo $row_1["spacing"]; ?>" id="txtC<?php echo $count;?>" name="txtC<?php echo $count;?>"></td>
													<td  align="center"><input type="number" min="1" class="form-control text-uppercase" size="15" value="<?php echo $row_1["trees"]; ?>" id="txtD<?php echo $count;?>" name="txtD<?php echo $count;?>" ></td>
												</tr>
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" class="form-control text-uppercase" readonly="readonly" id="txtA1"  name="txtA1"></td>
													<td><input id="txtB1" class="form-control text-uppercase" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+"  name="txtB1"></td>	
													<td><input  id="txtC1"class="form-control text-uppercase" name="txtC1"></td>
													<td><input type="text" min="1"validate="onlyNumbers"  class="form-control text-uppercase" id="txtD1" name="txtD1"></td>
												</tr>
												<?php } ?>
												<tbody>
											</table>
										</td>
									</tr>							
									<tr>
									   <td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#" onclick="mydelfunction4()" value="">Delete</button>
											 <button type="button"  class="btn btn-default pull-right" onclick="addmore()" value="">Add More</button>	
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</td>
									</tr>
									<tr>
										<td>(d) Average Height :</td>
										<td><input type="text" name="details_plantation[avg_height]" value="<?php  echo $details_plantation_avg_height;?>" class="form-control text-uppercase"></td>
										<td>(e) Average girth :</td>
										<td><input type="text" name="details_plantation[avg_girth]" value="<?php echo $details_plantation_avg_girth; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(f) Boundary description of the plantation area :</td>
										<td><input type="text" name="details_plantation[bound_desc]" value="<?php echo $details_plantation_bound_desc; ?>" class="form-control text-uppercase"></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="4">Signature of the Pattadar with Date :</td>
									</tr>
									<tr>
										<td>Date :</td>
										<td><label class="text-uppercase"><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
										<td>Signature of the Pattadar :</td>
										<td> <label class="text-uppercase"><?php echo $key_person; ?></label></td>
										
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">Save & Next</button>
										</td>
									</tr>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>