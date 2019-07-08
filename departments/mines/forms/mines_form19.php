<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="19";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form1.php";
	
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();		
			$form_id=$results["form_id"];
			$nationality=$results["nationality"];$place_of_business=$results["place_of_business"];$name_of_minerals=$results["name_of_minerals"];$map_description=$results["map_description"];$is_renewal_applied=$results["is_renewal_applied"];$minerals_raised=$results["minerals_raised"];$year_wise_qty=$results["year_wise_qty"];
			
			$minerals_available=$results["minerals_available"];$details_of_explorations=$results["details_of_explorations"];
			$details_of_area=$results["details_of_area"];$details_of_site=$results["details_of_site"];$details_of_defaults=$results["details_of_defaults"];$details_of_investment=$results["details_of_investment"];$any_particulars=$results["any_particulars"];$name_of_village=$results["name_of_village"];$sub_division=$results["sub_division"];$schedule_district1=$results["schedule_district1"];$name_of_range=$results["name_of_range"];$schedule_patta_no=$results["schedule_patta_no"];$schedule_area=$results["schedule_area"];$schedule_desc=$results["schedule_desc"];$schedule_felling_series=$results["schedule_felling_series"];$schedule_district2=$results["schedule_district2"];
			
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}			
			if(!empty($results["utilization"])){
				$utilization=json_decode($results["utilization"]);
				$utilization_a=$utilization->a;$utilization_b=$utilization->b;$utilization_c=$utilization->c;
			}else{				
				$utilization_a="";$utilization_b="";$utilization_c="";
			}			
			if(!empty($results["statement"])){
				$statement=json_decode($results["statement"]);
				$statement_a=$statement->a;$statement_b=$statement->b;$statement_c=$statement->c;
			}else{				
				$statement_a="";$statement_b="";$statement_c="";
			}				
			if(!empty($results["period_renewal"])){
				$period_renewal=json_decode($results["period_renewal"]);
				$period_renewal_from_dt=$period_renewal->from_dt;$period_renewal_to_dt=$period_renewal->to_dt;
			}else{				
				$period_renewal_from_dt="";$period_renewal_to_dt="";
			}			
			if(!empty($results["renewal_applied"])){
				$renewal_applied=json_decode($results["renewal_applied"]);
				$renewal_applied_area=$renewal_applied->area;$renewal_applied_desc=$renewal_applied->desc;
			}else{				
				$renewal_applied_area="";$renewal_applied_desc="";
			}
			if(!empty($results["compliance"])){
				$compliance=json_decode($results["compliance"]);
				$compliance_env_clearance=$compliance->env_clearance;$compliance_mining_plan=$compliance->mining_plan;$compliance_provisions=$compliance->provisions;$compliance_conditions=$compliance->conditions;
			}else{				
				$compliance_env_clearance="";$compliance_mining_plan="";$compliance_provisions="";$compliance_conditions="";
			}
			  
		}else{
		  	$form_id="";
			$nationality="";$place_of_business="";$name_of_minerals="";$period_from_dt="";$period_to_dt="";
			$utilization_a="";$utilization_b="";$utilization_c="";
			$map_description="";
			$statement_a="";$statement_b="";$statement_c="";
			$period_renewal_from_dt="";$period_renewal_to_dt="";
			$is_renewal_applied="";
			$renewal_applied_area="";$renewal_applied_desc="";
			$minerals_raised="";$year_wise_qty="";
			
			$minerals_available="";$details_of_explorations="";$details_of_area="";$details_of_site="";
			$compliance_env_clearance="";$compliance_mining_plan="";$compliance_provisions="";$compliance_conditions="";
			$details_of_defaults="";$details_of_investment="";$any_particulars="";
			$name_of_village="";$sub_division="";$schedule_district1="";$name_of_range="";$schedule_patta_no="";$schedule_area="";$schedule_desc="";$schedule_felling_series="";$schedule_district2="";
		}
	}else{	
            $results=$q->fetch_array();		
			$form_id=$results["form_id"];
			$nationality=$results["nationality"];$place_of_business=$results["place_of_business"];$name_of_minerals=$results["name_of_minerals"];$map_description=$results["map_description"];$is_renewal_applied=$results["is_renewal_applied"];$minerals_raised=$results["minerals_raised"];$year_wise_qty=$results["year_wise_qty"];
			
			$minerals_available=$results["minerals_available"];$details_of_explorations=$results["details_of_explorations"];
			$details_of_area=$results["details_of_area"];$details_of_site=$results["details_of_site"];$details_of_defaults=$results["details_of_defaults"];$details_of_investment=$results["details_of_investment"];$any_particulars=$results["any_particulars"];$name_of_village=$results["name_of_village"];$sub_division=$results["sub_division"];$schedule_district1=$results["schedule_district1"];$name_of_range=$results["name_of_range"];$schedule_patta_no=$results["schedule_patta_no"];$schedule_area=$results["schedule_area"];$schedule_desc=$results["schedule_desc"];$schedule_felling_series=$results["schedule_felling_series"];$schedule_district2=$results["schedule_district2"];
			
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}			
			if(!empty($results["utilization"])){
				$utilization=json_decode($results["utilization"]);
				$utilization_a=$utilization->a;$utilization_b=$utilization->b;$utilization_c=$utilization->c;
			}else{				
				$utilization_a="";$utilization_b="";$utilization_c="";
			}			
			if(!empty($results["statement"])){
				$statement=json_decode($results["statement"]);
				$statement_a=$statement->a;$statement_b=$statement->b;$statement_c=$statement->c;
			}else{				
				$statement_a="";$statement_b="";$statement_c="";
			}				
			if(!empty($results["period_renewal"])){
				$period_renewal=json_decode($results["period_renewal"]);
				$period_renewal_from_dt=$period_renewal->from_dt;$period_renewal_to_dt=$period_renewal->to_dt;
			}else{				
				$period_renewal_from_dt="";$period_renewal_to_dt="";
			}			
			if(!empty($results["renewal_applied"])){
				$renewal_applied=json_decode($results["renewal_applied"]);
				$renewal_applied_area=$renewal_applied->area;$renewal_applied_desc=$renewal_applied->desc;
			}else{				
				$renewal_applied_area="";$renewal_applied_desc="";
			}
			if(!empty($results["compliance"])){
				$compliance=json_decode($results["compliance"]);
				$compliance_env_clearance=$compliance->env_clearance;$compliance_mining_plan=$compliance->mining_plan;$compliance_provisions=$compliance->provisions;$compliance_conditions=$compliance->conditions;
			}else{				
				$compliance_env_clearance="";$compliance_mining_plan="";$compliance_provisions="";$compliance_conditions="";
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
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part II</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1. Name of applicant individual/firm/company or society :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly"  value="<?php echo $key_person; ?>" ></td>
											<td width="25%">2. Nationality of the individual or place of registration or incorporation of firm, company or society :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="nationality"  value="<?php echo $nationality; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">3. Profession or nature of business of individual or firm or company and place of business :</td>
										</tr>
										<tr>
											<td>Profession or nature of business of individual or firm or company :</td>
											<td><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly"  value="<?php echo $status_applicant; ?>" ></td>
											<td>Place of business :</td>
											<td><input type="text" class="form-control text-uppercase" name="place_of_business"  value="<?php echo $place_of_business; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">4. Address of the individual/ firm/ company or society :</td>
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
											<td colspan="3">5. Name of Minor Mineral which the applicant intends to mine :</td>
											<td><input type="text" class="form-control text-uppercase" name="name_of_minerals"  value="<?php echo $name_of_minerals; ?>"></td>
										</tr>
										<tr>
											<td>6. Period for which the original lease was granted :<span class="mandatory_field">*</span></td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period[from_dt]" placeholder="Form Date" value="<?php echo $period_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period[to_dt]" placeholder="To Date" value="<?php echo $period_to_dt; ?>"></td>
										</tr>
										
										<tr>
											<td colspan="4">7. Manner in which the Minor Mineral(s) is to be utilized (In case of manufacture, the industries in connection with which it is required should be specified) :</td>
										</tr>
										<tr>
											<td >a. For manufacture :</td>
											<td ><input type="text" class="form-control text-uppercase" name="utilization[a]" value="<?php echo $utilization_a; ?>"></td>
											<td >b. For sale :</td>
											<td ><input type="text" class="form-control text-uppercase" name="utilization[b]" value="<?php echo $utilization_b; ?>"></td>
										</tr>			
										<tr>
											<td >c. Any other purpose :</td>
											<td ><input type="text" class="form-control text-uppercase" name="utilization[c]" value="<?php echo $utilization_c; ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>		
										<tr>
											<td colspan="3">8. A description illustrated by a map or plan ( in triplicate) showing as accurate as possible the situation, boundaries and area of land in respect of which the lease is required and where the area us un-surveyed the location of the area should be shown by some permanent physical features ie, roads, tanks etc. :</td>
											<td><textarea class="form-control text-uppercase" name="map_description" ><?php echo $map_description; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="4">9. A statement showing all the areas within jurisdiction of the Government :</td>
										</tr>
										<tr>
											<td>(a) Already held by me/us in my/our name/names ( and jointly with others) under quarrying leases specifying the names of minor :</td>
											<td><input  type="text" name="statement[a]" value="<?php echo $statement_a; ?>" class="form-control text-uppercase" ></td>
											<td>(b) Already applied for but not yet granted :</td>
											<td><input  type="text" name="statement[b]" value="<?php echo $statement_b; ?>" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td>(c) Applied for simultaneously or being applied for in the state :</td>
											<td><input  type="text" name="statement[c]" value="<?php echo $statement_c; ?>" class="form-control text-uppercase" ></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>10. Period for which renewal of mining lease is required :<span class="mandatory_field">*</span></td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period_renewal[from_dt]" placeholder="Form Date" value="<?php echo $period_renewal_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period_renewal[to_dt]" placeholder="To Date" value="<?php echo $period_renewal_to_dt; ?>"></td>
										</tr>
										<tr>
											<td colspan="3">11. Whether renewal is applied for the whole or part of the lease held ?</td>
											<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_renewal_applied=="Y") echo "checked"; ?> id="inlineRadio1" name="is_renewal_applied"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_renewal_applied=="N" || $is_renewal_applied=="") echo "checked"; ?> id="inlineRadio1" name="is_renewal_applied"> No </label></td>
										</tr>									
										<tr>
											<td colspan="4">12. In case the renewal applied for is only for part if the lease held :</td>
										</tr>
										<tr>
											<td>(a) The area applied for renewal :</td>
											<td><input type="text" class="form-control text-uppercase" name="renewal_applied[area]" value="<?php echo $renewal_applied_area; ?>"></td>
											<td>(b) Description of the area applied for renewal :</td>
											<td><input type="text" class="form-control text-uppercase" name="renewal_applied[desc]"  value="<?php echo $renewal_applied_desc; ?>"></td>
										</tr>
										<tr>
											<td colspan="3">(c) Map ( in triplicate) of the lease held with area applied for renewal clearly marked on it ( copy of map attached) :</td>
											<td>To be Uploaded in Upload Section</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>13. Means by which the minor mineral is to be raised ie. by hand, labour or mechanical or electric power :</td>
											<td><input type="text" class="form-control text-uppercase" name="minerals_raised" value="<?php echo $minerals_raised; ?>"></td>
											<td>14. Year-wise quantity of the mineral(s) excavated along with royalty paid in each year since grant if lease. (attached no due certificate of concerned Officer - In - Charge) :</td>
											<td><input type="text" class="form-control text-uppercase" name="year_wise_qty"  value="<?php echo $year_wise_qty; ?>"></td>
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
											<td width="25%">15. Mineral reserves available :</td>
											<td width="25%"><textarea class="form-control text-uppercase" name="minerals_available" ><?php echo $minerals_available; ?></textarea></td>
											<td width="25%">16. Details of explorations undertaken, if any :</td>
											<td width="25%"><textarea class="form-control text-uppercase" name="details_of_explorations" ><?php echo $details_of_explorations; ?></textarea></td>
										</tr>
										<tr>
											<td>17. Details of the mined out areas restored/reclaimed/rehabilitated as per progressive mine closure plan :</td>
											<td><textarea class="form-control text-uppercase" name="details_of_area" ><?php echo $details_of_area; ?></textarea></td>
											<td>18. Details of the sites of overburden restored :</td>
											<td><textarea class="form-control text-uppercase" name="details_of_site" ><?php echo $details_of_site; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="4">19. Details of the compliance of :</td>
										</tr>
										<tr>
											<td>(i). Environmental Clearance :</td>
											<td><input type="text" class="form-control text-uppercase" name="compliance[env_clearance]" value="<?php echo $compliance_env_clearance; ?>"></td>
											<td>(ii). Mining plan / scheme of mining :</td>
											<td><input type="text" class="form-control text-uppercase" name="compliance[mining_plan]"  value="<?php echo $compliance_mining_plan; ?>"></td>
										</tr>
										<tr>
											<td>(iii). Safety provisions as per the Mines Act, 1952 and the rules and regulations framed thereunder :</td>
											<td><input type="text" class="form-control text-uppercase" name="compliance[provisions]"  value="<?php echo $compliance_provisions; ?>"></td>
											<td>(iv). Other relevant laws and terms and conditions applicable on Mines and Minerals :</td>
											<td><input type="text" class="form-control text-uppercase" name="compliance[conditions]"  value="<?php echo $compliance_conditions; ?>"></td>
										</tr>
										<tr>
											<td>20. Details of defaults, if any, in submission of production returns, payment of royalty/dead rent and found wanting in taking adequate measures for labour safety :</td>
											<td><textarea class="form-control text-uppercase" name="details_of_defaults" ><?php echo $details_of_defaults; ?></textarea></td>
											<td>21. Details of investment made in development of mine, plant and machinery with a long term perspective and optimal benefit of the same could not have derived during the original period of lease :</td>
											<td><textarea class="form-control text-uppercase" name="details_of_investment" ><?php echo $details_of_investment; ?></textarea></td>
										</tr>
										<tr>
											<td>22. Any other particulars which the applicant wishes to furnish :</td>
											<td><textarea class="form-control text-uppercase" name="any_particulars" ><?php echo $any_particulars; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="4"><strong>Schedule giving description of the area applied for</strong></td>
										</tr>
										<tr>
											<td colspan="4">1. Name of village, Sub-Division and District :</td>
										</tr>
										<tr>
											<td>Name of village :</td>
											<td><input  type="text" name="name_of_village" value="<?php echo $name_of_village; ?>" class="form-control text-uppercase" ></td>
											<td>Sub-Division :</td>
											<td><input  type="text" name="sub_division" value="<?php echo $sub_division; ?>" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td>District :</td>
											<td><input  type="text" name="schedule_district1" value="<?php echo $schedule_district1; ?>" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td colspan="3">2. In the case of forest land, the name of the range and Division :</td>
											<td><input  type="text" name="name_of_range" value="<?php echo $name_of_range; ?>" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td colspan="4">3. Dag and Patta Numbers and area of each field or part thereof :</td>
										</tr>
										<tr>
											<td>3.1. Patta No :</td>
											<td><textarea class="form-control text-uppercase" name="schedule_patta_no" ><?php echo $schedule_patta_no; ?></textarea></td>
											<td>Area :</td>
											<td><textarea class="form-control text-uppercase" name="schedule_area" ><?php echo $schedule_area; ?></textarea></td>
										</tr>
										<tr>
											<td>3.2. Full description of the area applied for with regard to its natural features :</td>
											<td><textarea class="form-control text-uppercase" name="schedule_desc" ><?php echo $schedule_desc; ?></textarea></td>
											<td>3.3. Felling series and working circle, if any :</td>
											<td><textarea class="form-control text-uppercase" name="schedule_felling_series" ><?php echo $schedule_felling_series; ?></textarea></td>
										</tr>
										<tr>
											<td>3.4. District :</td>
											<td><input  type="text" name="schedule_district2" value="<?php echo $schedule_district2; ?>" class="form-control text-uppercase" ></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>						
									<tr>
										<td>Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/>
											Place : <strong><?php echo strtoupper($dist)?></strong></td>
										<td colspan="4" align="right">Designation of the Applicant&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($status_applicant)?></strong><br>
										Signature of the Applicant&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong><br/></td>
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