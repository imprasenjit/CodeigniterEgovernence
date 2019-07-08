<?php  require_once "../../requires/login_session.php";
$dept="mines";
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
		$results=$p->fetch_array();
			$form_id=$results["form_id"];$profession=$results["profession"];$permit=$results["permit"];$minerals=$results["minerals"];$prospect=$results["prospect"];$nature=$results["nature"];$details=$results["details"];$resources=$results["resources"];$annual_target=$results["annual_target"];$area_scheme=$results["area_scheme"];$anticipated=$results["anticipated"];$other_details=$results["other_details"];	
			
			if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}				
			if(!empty($results["clearance"])){
				$clearance=json_decode($results["clearance"]);
				$clearance_dt=$clearance->dt;$clearance_num=$clearance->num; 
			}else{				
				$clearance_dt="";$clearance_num="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}				
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
			}
		}else{
			$form_id="";$profession="";$permit="";$minerals="";$prospect="";$nature="";$details="";$resources="";$annual_target="";$area_scheme="";$anticipated="";$other_details="";
			$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			$clearance_dt="";$clearance_num="";
			$period_from_dt="";$period_to_dt="";
			$particulars_a="";$particulars_b="";$particulars_c="";
		}
	}else{	
            $results=$q->fetch_array();		
			$form_id=$results["form_id"];$profession=$results["profession"];$permit=$results["permit"];$minerals=$results["minerals"];$prospect=$results["prospect"];$nature=$results["nature"];$details=$results["details"];$resources=$results["resources"];$annual_target=$results["annual_target"];$area_scheme=$results["area_scheme"];$anticipated=$results["anticipated"];$other_details=$results["other_details"];	
			
			if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}				
			if(!empty($results["clearance"])){
				$clearance=json_decode($results["clearance"]);
				$clearance_dt=$clearance->dt;$clearance_num=$clearance->num; 
			}else{				
				$clearance_dt="";$clearance_num="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}				
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
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
											<td>2. Is the applicant a private individual/private company/public company/firm or association? </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $Type_of_ownership; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">3. In case applicant is :</td>
										</tr>
										<tr>
											<td>(a) An individual, his nationality :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant[nation]" value="<?php echo $applicant_nation; ?>"></td>
											<td>(b) A company, an attested copy of the certificate of registration of the company shall be enclosed :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant[reg_number]"  value="<?php echo $applicant_reg_number; ?>"></td>
										</tr>
										<tr>
											<td>(c) Firm or association, the nationality of all the Partners of the firm or members of the association :</td>
											<td><textarea class="form-control text-uppercase" name="applicant[firm_asso]" ><?php echo $applicant_firm_asso; ?></textarea></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>4. Profession or nature of business of applicant :</td>
											<td><input type="text" class="form-control text-uppercase" name="profession" value="<?php echo $profession; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">5. No. and date of the valid clearance certificate of payment of mining dues(copy attached) :</td>
										</tr>
										<tr>
											<td>Number :</td>
											<td><input type="text" class="form-control text-uppercase" name="clearance[num]"  value="<?php echo $clearance_num; ?>"></td>
											<td>Date :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="clearance[dt]"  value="<?php echo $clearance_dt; ?>"></td>
										</tr>
										<tr>
											<td colspan="3">6. If on the date of application the applicant does not hold a reconnaissance permit, it should be stated whether an affidavit to this effect has been furnished to the satisfaction of the State government :</td>
											<td><textarea class="form-control text-uppercase" name="permit" ><?php echo $permit; ?></textarea></td>
										</tr>
										<tr>
											<td>7. Mineral or minerals which the applicant intends to prospect :</td>
											<td><input type="text" class="form-control text-uppercase" name="minerals"  value="<?php echo $minerals; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>8. Period for which the reconnaissance permit is required :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[from_dt]" placeholder="Form Date" value="<?php echo $period_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[to_dt]" placeholder="To Date" value="<?php echo $period_to_dt; ?>"></td>
										</tr>
										<tr>
											<td>9. Extent of the area the applicant wants to prospect :</td>
											<td><input type="text" class="form-control text-uppercase" name="prospect" value="<?php echo $prospect; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">10. Details of the area in respect of which reconnaissance permit is required :
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="30%">District</th>
													<th width="30">Taluq</th>
													<th width="30%">Area</th>
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
															<td><input value="<?php echo $row_1["area"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
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
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
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
											<td colspan="4">11. Particulars of the areas mineral-wise within the jurisdiction of the State Government for which the applicant or any person joint in interest with him :</td>
										</tr>
										<tr>
											<td width="25%">1. Already holds under reconnaissance permit :</td>
											<td width="25%"><input type="text" name="particulars[a]" value="<?php echo $particulars_a; ?>" class="form-control text-uppercase"></td>
											<td width="25%">2. Has already applied for but not granted :</td>
											<td width="25%"><input type="text" name="particulars[b]" value="<?php echo $particulars_b; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>3. Being applied for simultaneously :</td>
											<td><input type="text" name="particulars[c]"  value="<?php echo $particulars_c; ?>" class="form-control text-uppercase"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>12. Nature of joint interest, if any :</td>
											<td><textarea name="nature"  id="nature" class="form-control text-uppercase"><?php echo $nature; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="3">13. If the applicant intends to supervise the works, his previous experience of reconnaissance, prospecting and mining operations should be explained; if he intends to appoint a manager, the name of such manager, his qualifications, nature and extent of his previous experience should be specified and his consent letter should be attached : </td><td><textarea name="details"  id="details" class="form-control text-uppercase"><?php echo $details; ?></textarea></td>		
										</tr>
										<tr>
											<td>14. Financial resources of the applicant :</td>
											<td><input  type="text" name="resources"  value="<?php echo $resources; ?>" class="form-control text-uppercase"></td>
											<td>15.	The works proposed to be undertaken along with their physical annual targets :</td>
											<td><input  type="text" name="annual_target"  value="<?php echo $annual_target; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>16.	The scheme of relinquishment of the area :</td>
											<td><input type="text" name="area_scheme" value="<?php echo $area_scheme; ?>" class="time form-control text-uppercase" ></td>
											<td>17.	Anticipated minimum annual expenditure (activity of work wise) :</td>
											<td><input type="text" name="anticipated" value="<?php echo $anticipated; ?>" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td>18.	Any other particulars or sketch map which the applicant wishes to furnish :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $other_details; ?>" name="other_details" ></td>
										</tr>
										<tr>
											
											<td>Date : <label ><?php echo $today;?></label></td>
											<td></td>
											<td></td>
											<td>Signature of the Applicant : <strong><?php echo strtoupper($key_person)?></strong></td>
										</tr>
										<tr>
											<td>Place : <label ><?php echo $dist;?></label></td>
											<td></td>
											<td></td>
											<td>Designation of the Applicant : <strong><?php echo strtoupper($key_person)?></strong></td>
											
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

</script>