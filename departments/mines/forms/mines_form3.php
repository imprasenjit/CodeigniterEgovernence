<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="3";
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
				
			$form_id=$results["form_id"];$profession=$results["profession"];$prospecting_lic=$results["prospecting_lic"];$p_renewal=$results["p_renewal"];$Reasons_pros_lic=$results["Reasons_pros_lic"];$arrr_renewal=$results["arrr_renewal"];$area_renewal=$results["area_renewal"];$nature=$results["nature"];
			$is_residential=$results["is_residential"];$is_renewal=$results["is_renewal"];
			
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
			$form_id="";$profession="";$prospecting_lic=""; $p_renewal="";$Reasons_pros_lic="";
			$arrr_renewal=""; $area_renewal=""; $nature="";$is_residential="";
			
			$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			$clearance_dt="";$clearance_num="";
			$period_from_dt="";$period_to_dt="";
			$particulars_a="";$particulars_b="";$particulars_c="";
			$is_renewal="";
		}
	}else{	
            $results=$q->fetch_array();		
			$form_id=$results["form_id"];$profession=$results["profession"];$prospecting_lic=$results["prospecting_lic"];$p_renewal=$results["p_renewal"];$Reasons_pros_lic=$results["Reasons_pros_lic"];$arrr_renewal=$results["arrr_renewal"];$area_renewal=$results["area_renewal"];$nature=$results["nature"];
			$is_residential=$results["is_residential"];$is_renewal=$results["is_renewal"];
			
			
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
											<td colspan="4">Full Postal Address with Pin code and contact telephone No :</td>
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
										<td>Email :</td>
											<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
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
											<td>(a) an individual, his nationality :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant[nation]" value="<?php echo $applicant_nation; ?>"></td>
											<td>(b) a company, an attested copy of the certificate of registration of the company shall be enclosed :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant[reg_number]"  value="<?php echo $applicant_reg_number; ?>"></td>
										</tr>
										<tr>
											<td>(c) firm or association, the nationality of all the Partners of the firm or members of the association :</td>
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
											<td>5. No. and date of the valid clearance certificate of payment of mining dues(copy attached) :</td>
										</tr>
										<tr>
											<td>Number :</td>
											<td><input type="text" class="form-control text-uppercase" name="clearance[num]"  value="<?php echo $clearance_num; ?>"></td>
											<td>Date :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="clearance[dt]" readonly="readonly" value="<?php echo $clearance_dt; ?>"></td>
										</tr>
										<tr>
											<td width="25%">6.(a) Particulars of the prospecting licence of which renewal is desired. :</td>
											<td><textarea class="form-control text-uppercase" name="prospecting_lic" ><?php echo $prospecting_lic; ?></textarea></td>
											<td width="25%">(b) Details of previous renewal/renewals granted, if any. :</td>
											<td><textarea class="form-control text-uppercase" name="p_renewal" ><?php echo $p_renewal; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="3">7. Reasons in detail for asking for renewal of prospecting license along with a report on the prospecting already done. :</td>
											<td><textarea class="form-control text-uppercase" name="Reasons_pros_lic"> <?php echo $Reasons_pros_lic; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="3">8.Period for which renewal of prospecting license is desired. :</td>
										</tr>
										<tr>
										    <td>From </td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period[from_dt]" placeholder="Form Date" value="<?php echo $period_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[to_dt]" placeholder="To Date" value="<?php echo $period_to_dt; ?>"></td>
										</tr>
										<tr>
											<td colspan="3">9. Whether renewal is desired for the whole or part of the area held under prospecting license. :</td>
										    <td colspan="1"><label class="radio-inline"><input type="radio" value="W" <?php if($is_renewal =="W" || $is_renewal =="") echo "checked"; ?> id="inlineRadio2" name="is_renewal"> Whole area </label>
											<label class="radio-inline"><input type="radio" value="P" <?php if($is_renewal=="P") echo "checked"; ?> id="inlineRadio2" name="is_renewal">Part of the area </label></td>
											
										</tr>
										
										<tr>
											<td>(a) The area applied for renewal :</td>
											<td><input type="text" class="form-control text-uppercase" name="arrr_renewal" <?php echo  $arrr_renewal; ?> ></td>
											<td>(b) Description of the area applied for renewal (description should be adequate for the purpose of demarcating the plot). :</td>
											<td><textarea class="form-control text-uppercase" name="area_renewal"> <?php echo $area_renewal; ?></textarea></td>
									    </tr>
										<tr>
											<td colspan="3">10. Does the applicant continue to have the surface rights over the areas of the land for which he requires renewal of the prospecting license :</td>
										   <td colspan="1"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_residential=="Y" || $is_residential=="") echo "checked"; ?> id="inlineRadio1" name="is_residential"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_residential=="N") echo "checked"; ?> id="inlineRadio1" name="is_residential"> No </label></td>
									
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
											<td colspan="4">11. Particulars of the area mineral-wise in each State only supported by an affidavit for which the applicant or any person jointly in interest with him- :</td>
										</tr>
										<tr>
											<td width="25%">(a) Already holds under prospecting license </td>
											<td width="25%"><input type="text" name="particulars[a]"  value="<?php echo $particulars_a; ?>" class="form-control text-uppercase"></td>
											<td width="25%">(b) Has already applied for but not granted </td>
											<td width="25%"><input type="text" name="particulars[b]"  value="<?php echo $particulars_b; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td width="25%">(c) Being applied for simultaneously </td>
											<td width="25%"><input type="text" name="particulars[c]"  value="<?php echo $particulars_c; ?>" class="form-control text-uppercase"></td>
											
										</tr>
										<tr>
											<td colspan="2%">12. Any other particulars which the applicant may wish to furnish :</td>
											<td><textarea class="form-control text_uppercase" name="nature"><?php echo $nature;?></textarea></td>
										</tr>
									
											
										<tr>
											<td width="25%">Date </td>
											<td width="25%"><label ><?php echo $today;?></label></td>
											<td width="25%">Signature of the Applicant</td>
											<td width="25%"><strong><?php echo strtoupper($key_person)?></strong></td>
										</tr>
										<tr>
											<td width="25%">Place</td>
											<td width="25%"><label ><?php echo $dist;?></label></td>
											<td width="25%">Designation of the Applicant</td>
											<td width="25%"><strong><?php echo strtoupper($status_applicant)?></strong></td>
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