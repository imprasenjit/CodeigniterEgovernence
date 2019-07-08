<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="2";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_dic_form.php";
$equity_rs="";$equity_per="";
	
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$power=$results['power'];$raw_meterial=$results['raw_meterial'];$total_investment=$results['total_investment'];
			##### Part A #######
			if(!empty($results["ack"])){
				$ack=json_decode($results["ack"]);
				$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_lic_no=$ack->lic_no;
			}else{
				$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
			}
			##### Part B #######
			if(!empty($results["fixed_amount"])){
				$fixed_amount=json_decode($results["fixed_amount"]);
				$fixed_amount_land=$fixed_amount->land;$fixed_amount_site_dev=$fixed_amount->site_dev;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;
			}else{
				$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";
			}
			if(!empty($results["proposed"])){
				$proposed=json_decode($results["proposed"]);
				$proposed_managerial=$proposed->managerial;
				$proposed_skilled=$proposed->skilled;$proposed_semi_skilled=$proposed->semi_skilled;$proposed_unskilled=$proposed->unskilled;$proposed_ss=$proposed->ss;
				$proposed_others=$proposed->others;
			}else{
				$proposed_managerial="";$proposed_skilled="";$proposed_unskilled="";$proposed_semi_skilled="";$proposed_ss="";$proposed_others="";
			}
		}else{
			$form_id="";
			$power="";$raw_meterial="";$total_investment="";
			##### Part A #######
			$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
			##### Part B #######
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_tot="";
			$proposed_managerial="";$proposed_skilled="";$proposed_unskilled="";$proposed_semi_skilled="";$proposed_ss="";$proposed_others="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$power=$results['power'];$raw_meterial=$results['raw_meterial'];$total_investment=$results['total_investment'];
		##### Part A #######
		if(!empty($results["ack"])){
			$ack=json_decode($results["ack"]);
			$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_lic_no=$ack->lic_no;
		}else{
			$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
		}
		##### Part B #######
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
			$fixed_amount_land=$fixed_amount->land;$fixed_amount_site_dev=$fixed_amount->site_dev;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";
		}
		if(!empty($results["proposed"])){
			$proposed=json_decode($results["proposed"]);
			$proposed_managerial=$proposed->managerial;
			$proposed_skilled=$proposed->skilled;$proposed_semi_skilled=$proposed->semi_skilled;$proposed_unskilled=$proposed->unskilled;$proposed_ss=$proposed->ss;
			$proposed_others=$proposed->others;
		}else{
			$proposed_managerial="";$proposed_skilled="";$proposed_unskilled="";$proposed_semi_skilled="";$proposed_ss="";$proposed_others="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
										<td width="25%">1. (a) Name of the Industrial unit :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td width="25%">&nbsp;</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4"> (b) Complete address with telephone No. :  </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Block</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block;?>"></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
									</tr>	
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
									</tr>				
									</tr>
									<tr>
										<td width="25%">2. (a) Constitution of the unit</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $Type_of_ownership;?>"></td>
										<td width="25%">&nbsp;</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td colspan=4>(b) Name(s), address(es), of the Proprietor / Partners / Directors of Board of Directors / Secretary and  President of the Cooperative Society : </td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable2" id="objectTable2" class="table table-responsive">
										<thead>
											<tr >
												<th width="10%">Sl. No.</th>
												<th width="20%">Partners/Directors Name</th>
												<th width="10%" >Street Name 1</th>
												<th width="10%">Street Name 2</th>
												<th width="10%">Village/Town</th>
												<th width="10%">District</th>
												<th width="10%">Pincode</th>
											</tr>
										</thead>	
											<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$dic->error);
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->v; ?>" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->d; ?>" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->p; ?>" maxlength="6" validate="pincode" ></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										</td>
										</tr>
										</table></td>
									</tr>
									<tr>
										<td>3. Proposed date of commencement of commercial production of unit :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo date('d-m-Y',strtotime($date_of_commencement));?>"></td>
										<td>4. Whether the industrial unit falls under Manufacturing sector OR Service sector :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $business_type; ?>"></td>
									</tr>	
									<tr>
										<td colspan="4">5. Details of Registration with the concerned Department<br>(A). If Manufacturing Sector, please indicate :</td>
									<tr>
									<tr>
										<td colspan="4">  (i) Acknowledgement No. / Date of Entrepreneur Memorandum (EM), Part-1 (if any) of MSME :</td>
									</tr>
									<tr>
										<td>Acknowledgement No.</td>
										<td><input type="text" class="form-control text-uppercase"  name="ack[pm_no]" value="<?php echo $ack_pm_no;?>"></td>
										<td>Date of Entrepreneur Memorandum (EM):</td>
										<td><input type="text" class="dobindia form-control text-uppercase"  name="ack[pm_dt]" value="<?php if($ack_pm_dt!="0000-00-00" && $ack_pm_dt!="") echo date("d-m-Y",strtotime($ack_pm_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">   (ii) Acknowledgement No. / Date of Industrial Entrepreneur Memorandum (EM) (if any) of DIPP :</td>
									</tr>
									<tr>
										<td>Acknowledgement No. :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class=" form-control text-uppercase" name="ack[ind_no]" required="required" value="<?php echo $ack_ind_no;?>"></td>
										<td>Date of Industrial Entrepreneur Memorandum (EM) :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="ack[ind_dt]" required="required" value="<?php if($ack_ind_dt!="0000-00-00" && $ack_ind_dt!="") echo date("d-m-Y",strtotime($ack_ind_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
				 					</tr>	
									<tr>
										<td colspan="3">(B) If Service Sector, please indicate requisite Registration / License No. from the concerned  Department (if any)  : </td>
										<td><input type="text" class="form-control text-uppercase" name="ack[lic_no]" value="<?php echo $ack_lic_no;?>"></td>
									</tr>																	
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
										<td colspan="4">6. Particulars / Details of Fixed Capital Investment proposed (Amount in Rs.) : </td>
									</tr>
									<tr>
										<td width="25%"> (a) Land :</td>
										<td width="25%"><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[land]" value="<?php echo $fixed_amount_land;?>"></td>
										<td width="25%">(b) Site Development :</td>
										<td width="25%"><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[site_dev]" value="<?php echo $fixed_amount_site_dev;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(c) Building</td>
									</tr>
									<tr>
										<td>(i) Factory Building :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[fb]" value="<?php echo$fixed_amount_fb;?>"></td>
										<td>(ii) Office Building :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[ob]" value="<?php echo $fixed_amount_ob;?>"></td>
									</tr>
									<tr>
										<td>(d) Plant and Machinery / Component / Items : </td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[pm]" value="<?php echo $fixed_amount_pm;?>" ></td>
										<td>(e) Electrical Installation :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[ei]" value="<?php echo $fixed_amount_ei;?>" ></td>
									</tr>
									<tr>
										<td>(f) Preliminary & pre-operative expenses : </td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[pe]" value="<?php echo $fixed_amount_pe;?>" ></td>
										<td> (g) Miscellaneous fixed assets :</td>
										<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[m]" value="<?php echo $fixed_amount_m;?>" ></td>
									</tr>
									<tr>
										<td>Total : </td>
										<td><input  type="text" class="form-control text-uppercase" id="fixed_amount_total"  name="total_investment" value="<?php echo $total_investment;?>" readonly="readonly" ></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>7. Proposed requirement of Power / Electricity (KW/MW) : </td>
										<td><input  type="text" class="form-control text-uppercase"  name="power" value="<?php echo $power;?>" ></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">8. Annual Production Capacity proposed :</td>
									</tr>
								<tr>
									<td colspan="4"> 
									<table name="objectTable1" id="objectTable1" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Name of the Product(s)/Services rendered</td>
										   <td align="center">Quantity</td>
										   <td align="center">Value in Rupees</td>
										</tr>
									   <?php
										$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
										  $count=1;
										  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["quantity"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtC<?php echo $count;?>" onkeyup="onlyNumbers" validate="onlyNumbers"></td>
											<td><input value="<?php echo $row_1["rupees"]; ?>" validate="onlyNumbers" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1" size="1"></td>
										<td><input id="txtB1" size="20"  class="form-control text-uppercase" name="txtB1"></td>
										<td><input  id="txtC1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txtC1"></td>					
										<td><input  id="txtD1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txtD1"></td>
									</tr>
									<?php } ?>
									<tbody>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
									</td>
								</tr>								
								<tr>
									<td>9. Name(s) of Raw Materials used :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="raw_meterial"  value="<?php echo $raw_meterial;?>"></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>								
								<tr>
									<td colspan="4">10. Proposed Employment Generation in the unit in various fields of work</td>
								</tr>								
								<tr>
									<td>(a) Managerial :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[managerial]"  value="<?php echo $proposed_managerial;?>"></td>
									<td>(b) Supervisory Staff :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[ss]" value="<?php echo $proposed_ss;?>"></td>
								</tr>								
								<tr>
									<td>(c) Skilled Worker :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[skilled]"  value="<?php echo $proposed_skilled;?>"></td>
									<td> (d) Semi Skilled Worker :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[semi_skilled]" value="<?php echo $proposed_semi_skilled;?>"></td>
								</tr>								
								<tr>
									<td>(e) Unskilled Worker :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[unskilled]"  value="<?php echo $proposed_unskilled;?>"></td>
									<td>(f) Others :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="proposed[others]" value="<?php echo $proposed_others;?>"></td>
								</tr>
								<tr>
									<td>11. Name of the Applicant(s) :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $owner_names;?>"></td>
									<td> &nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td >Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b> <br/> Place : <label><?php echo strtoupper($dist);?> </label></td>
									<td></td><td></td>
									<td align="right"><label><b><?php echo strtoupper($key_person); ?></b></label><br/>Signature of the Applicant</td>	
								</tr>																					
								<tr>										
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary text-bold">Go Back & Edit</a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	$('.addTotal').on('change', function(){
		var sum = 0;
		$('.addTotal').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#fixed_amount_total').val(sum);
		});
	});
	/* ----------------------------------------------------- */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>