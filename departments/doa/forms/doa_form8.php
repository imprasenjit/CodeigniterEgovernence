<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="8";
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
			$form_id=$results["form_id"];$auth_desig=$results["auth_desig"];$place=$results["place"];$state=$results["state"];$concern=$results["concern"];$is_intimate=$results["is_intimate"];$other=$results["other"];
			
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
		}else{
			 
			$form_id="";$auth_desig="";$place="";$state="";$concern=""; $is_intimate="";$other="";
			$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
			$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
		}
	}else{			
			$results=$q->fetch_array();
			$form_id=$results["form_id"];$auth_desig=$results["auth_desig"];$place=$results["place"];$state=$results["state"];$concern=$results["concern"];$is_intimate=$results["is_intimate"];$other=$results["other"];
			
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
	}
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
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
											<td colspan="4">1. Details of the Notified Authority to whom applicant is submitted </td>
										</tr>
										<tr>
											<td>Designation of Notified Authority</td>
											<td><input  type="text" name="auth_desig" value="<?php echo $auth_desig; ?>" class="form-control text-uppercase"></td>
											<td>Place</td>
											<td><input  type="text" value="<?php echo $place; ?>" name="place" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td>State of</td>
											<td><input  type="text" value="<?php echo $state; ?>" name="state" class="form-control text-uppercase" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">2. Details of the applicant</td>
										</tr>
										<tr>
											<td width="25%">a. Name of the applicant</td>
											<td width="25%"><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
											<td width="25%">b. Name of the concern</td>
											<td width="25%"><input  type="text" value="<?php echo $concern; ?>" class="form-control text-uppercase" name="concern"></td>
										</tr>
										<tr>
											<td colspan="4">c. Postal address with telephone number</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">3. Place of business (Please give full address)</td>
										</tr>
										<tr>
											<td colspan="4"> i. For sale  : </td>
										</tr>
										<tr>
											<td> Street Name 1  :</td>
											<td><input type="text" class="form-control text-uppercase" name="sale[sn1]" value="<?php echo $sale_sn1;?>" /></td>
											<td> Street Name 2 :</td>
											<td><input type="text" class="form-control text-uppercase"  name="sale[sn2]" value="<?php echo $sale_sn2;?>" /></td>
										</tr>
										<tr>
											<td> Village/ Town :</td>
											<td><input type="text" class="form-control text-uppercase"   name="sale[v]" value="<?php echo $sale_v;?>"/></td>
											<td>District :<span class="mandatory_field">*</span></td>
                                            <td><input type="text" class="form-control text-uppercase"   name="sale[d]" id="sale" value="<?php echo $sale_d;?>"/></td>
											
										</tr>
										<tr>
											<td>Pincode :</td>
											<td><input type="text" class="form-control text-uppercase"  name="sale[p]" value="<?php echo $sale_p;?>" maxlength="6" validate="pincode"></td>
											<td>Mobile No. :</td>
											<td><input  type="text" name="sale[mno]" value="<?php echo $sale_mno; ?>" class="form-control" maxlength="10" validate="mobileNumber"></td>
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
                                            <td><input type="text" class="form-control text-uppercase"  name="storage[d]" id="storage" value="<?php echo $storage_d;?>" /></td>
											
										</tr>
										<tr>
											<td>Pincode :</td>
											<td><input type="text" value="<?php echo $storage_p; ?>" class="form-control text-uppercase" name="storage[p]" maxlength="6" validate="pincode"></td>
											<td>Mobile No. :</td>
											<td><input  type="text" name="storage[mno]" value="<?php echo $storage_mno; ?>" class="form-control" maxlength="10" validate="mobileNumber"></td>
										</tr>
										<tr>
											<td colspan="4">4. Details of fertilizer and their source in Form "O"</td>
										</tr>
										<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
												<tr>
													<th width="5%">Slno</th>
													<th width="15%">Name of fertilizer</th>
													<th width="20%">Whether certificate of source in Form "O" is attached</th>
												</tr>
											<?php
												$part1=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t1 WHERE form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["firm"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
														<td><input type="text" value="<?php echo $row_1["stock"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>" placeholder="YES/NO"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
													<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
													<td><input type="text" id="txtC1" size="10" class="form-control text-uppercase" name="txtC1" placeholder="YES/NO"></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
										<tr>
											<td colspan="3">5. Whether the intimation is for an authorization letter or a renewal thereof. (Note: In case the intimation is for renewal of authorization letter, the acknowledgement in Form A2 should be submitted for necessary endorsement their on).</td>
											<td><label class="radio-inline"><input type="radio" name="is_intimate" class="is_intimate" value="Y"  <?php if(isset($is_intimate) && $is_intimate=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_intimate"  value="N"  name="is_intimate" <?php if(isset($is_intimate) && ($is_intimate=='N' || $is_intimate=='')) echo 'checked'; ?>/> No</label></td>
										</tr>
										<tr>
											<td>6. Any other relevant information</td>
											<td><textarea type="text" name="other" class="form-control text-uppercase" maxlength="255"><?php echo $other; ?></textarea></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="2" width="50%">Date :<label ><?php echo $today;?></label><br/>
											Place:<label ><?php echo $dist;?></label></td>
											<td colspan="2" width="50%">Signature of the Applicant: <strong><?php echo strtoupper($key_person)?></strong></td>
											<td></td>
										</tr>	
										<tr>
										<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>	
</script>