<?php  require_once "../../requires/login_session.php";
$dept="gmc";
$form="3";
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
			$form_id=$results["form_id"];$family_name=$results["family_name"];$premises=$results["premises"];$godown=$results["godown"];$old_trade=$results["old_trade"];$annual_income=$results["annual_income"];$it_payable=$results["it_payable"];$license_type=$results["license_type"];
			if($godown=="Y"){
				if(!empty($results["godown_details"])){
					$godown_details=json_decode($results["godown_details"]);
					$godown_details_b=$godown_details->b;$godown_details_c=$godown_details->c;
				}else{
					$godown_details_a="";$godown_details_b="";$godown_details_c="";
				}
			}else{
				$godown_details_a="";$godown_details_b="";$godown_details_c="";
			}
			if($old_trade=="Y"){
				if(!empty($results["old_trade_details"])){
					$old_trade_details=json_decode($results["old_trade_details"]);
					
					$old_trade_details_a=$old_trade_details->a;$old_trade_details_b=$old_trade_details->b;$old_trade_details_c=$old_trade_details->c;
				}else{
					$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
				}
			}else{
				$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
			}
			if(!empty($results["premises_details"])){
				$premises_details=json_decode($results["premises_details"]);
				$premises_details_a=$premises_details->a;$premises_details_b=$premises_details->b;$premises_details_c=$premises_details->c;$premises_details_d=$premises_details->d;$premises_details_e=$premises_details->e;	
			}else{				
				$premises_details_a="";$premises_details_b="";$premises_details_c="";$premises_details_d="";$premises_details_e="";
			}				
			$dob=$results["dob"];$owner_age=$results["owner_age"];
		}else{
			$form_id="";$family_name="";$premises="";$godown="";$old_trade="";$annual_income="";$it_payable="";$license_type="";$horse_power="";$parking="";			
			$dob="";$owner_age="";$street_name_3="";$street_name_4="";$vill2="";$dist2="";$pin2="";$parking="";
			$premises_details_a="";$premises_details_b="";$premises_details_c="";$premises_details_d="";$premises_details_e="";
			$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
			$godown_details_a="";$godown_details_b="";$godown_details_c="";
		}
	}else{
		$results=$q->fetch_array();			
		$form_id=$results["form_id"];$family_name=$results["family_name"];$premises=$results["premises"];$godown=$results["godown"];$old_trade=$results["old_trade"];$annual_income=$results["annual_income"];$it_payable=$results["it_payable"];$license_type=$results["license_type"];
		if($godown=="Y"){
			if(!empty($results["godown_details"])){
				$godown_details=json_decode($results["godown_details"]);
				$godown_details_b=$godown_details->b;$godown_details_c=$godown_details->c;
			}else{
				$godown_details_a="";$godown_details_b="";$godown_details_c="";
			}
		}else{
			$godown_details_a="";$godown_details_b="";$godown_details_c="";
		}
		if($old_trade=="Y"){
			if(!empty($results["old_trade_details"])){
				$old_trade_details=json_decode($results["old_trade_details"]);
				
				$old_trade_details_a=$old_trade_details->a;$old_trade_details_b=$old_trade_details->b;$old_trade_details_c=$old_trade_details->c;
			}else{
				$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
			}
		}else{
			$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
		}
		if(!empty($results["premises_details"])){
			$premises_details=json_decode($results["premises_details"]);
			$premises_details_a=$premises_details->a;$premises_details_b=$premises_details->b;$premises_details_c=$premises_details->c;$premises_details_d=$premises_details->d;$premises_details_e=$premises_details->e;	
		}else{				
			$premises_details_a="";$premises_details_b="";$premises_details_c="";$premises_details_d="";$premises_details_e="";
		}				
		$dob=$results["dob"];$owner_age=$results["owner_age"];
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
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
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Details of Trade/owner</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Type of Premises</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a  href="javascript:void(0)">Old Trade License Details</a></li>
								  <li class="<?php echo $tabbtn4; ?>"><a  href="javascript:void(0)">Other Details</a></li>
								 
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td>For The Year :<span class="mandatory_field">*</span></td>
											<td colspan="2">1st April of  &nbsp;<select id="Year" name="from_year" required="required" class="text-uppercase" >
													<?php if(empty($from_year)) echo "<option value=''>Choose a year</option>"; else echo "<option selected>".$from_year."</option>"; ?>
												</select>
												&nbsp;&nbsp; To &nbsp;&nbsp;31st March of &nbsp;<select id="Year2" name="to_year" required="required" class="text-uppercase">
													<?php if(empty($to_year)) echo "<option value=''>Choose a year</option>"; else echo "<option selected>".$to_year."</option>"; ?>
												</select>
											</td>
										</tr>
										<tr>
											<td>1 (a). Applicant's Name</td>
											<td><input validate="specialChar" type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
											<td>1 (b). <?php if($owner_type=="PR") echo "Proprietor's PAN :"; else echo "Enterprise's PAN :"; ?> </td>
											<td><input type="text" value="<?php echo $pan_no; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td>2. Name of trade / shop</td>
											<td><input type="text" value="<?php echo $trade_name; ?>" id="trade_name" class="form-control text-uppercase" disabled></td>
											<td>3. Owner's Type</td>
											<td><input type="text" value="<?php echo $owner_type_name; ?>" class="form-control text-uppercase"disabled></td>
										</tr>
										<tr>
											<td>4. Owner's Name</td>
											<td><input validate="specialChar" type="text" value="<?php echo $owner_names; ?>" class="form-control text-uppercase"disabled></td>
											<td>5. Father's / Spouse's name</td>
											<td><input validate="letters" type="text" placeholder="Applicant's Father's / Spouse's name" name="family_name" value="<?php echo $family_name; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>6. Ward No.(GMC Zone)</td>
											<td><input type="text" value="<?php echo $gmc_zone." - (".$gmc_zone_name.")"; ?>" class="form-control text-uppercase" disabled></td>
											
										</tr>
										<tr>
											<td>7 (a). Applicant's Date of Birth<span class="mandatory_field">*</span></td>
											<td><input type="datetime" name="dob" value="<?php echo $dob; ?>" id="dob" class="form-control text-uppercase" onchange="date_of_birth(this.id)" placeholder="DD/MM/YYYY" required="required" ></td>
											<td>7 (b). Applicant's Age</td>
											<td><input validate="onlyNumbers" type="number" readonly="readonly" id="owner_age" value="<?php echo $owner_age; ?>" name="owner_age" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="4">8. Address of the Trade</td>
										</tr>
										<tr>
											<td>Street 1</td>
											<td><input type="text" value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase" disabled></td>
											<td>Street 2</td>
											<td><input type="text" value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" value="<?php echo $b_vill; ?>" class="form-control text-uppercase" disabled></td>
											<td>District</td>
											<td><input type="text" value="<?php echo $b_dist; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td>Block/Ward No.</td>
											<td><input type="text" value="<?php echo $gmc_zone; ?>" class="form-control text-uppercase" disabled></td>
											<td>Pincode</td>
											<td><input validate="pincode" type="text" value="<?php echo $b_pincode; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td colspan="2">9. Address of the Applicant</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Street 1</td>
											<td><input type="text" value="<?php echo $street_name1; ?>" name="street_name1" class="form-control text-uppercase" disabled></td>
											<td>Street 2</td>
											<td><input type="text" value="<?php echo $street_name2; ?>" name="street_name2" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" value="<?php echo $vill; ?>" name="vill" class="form-control text-uppercase" disabled></td>
											<td>District</td>
											<td><input type="text" value="<?php echo $dist; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td>Block/Ward No.</td>
											<td><input type="text" value="<?php echo $block; ?>" class="form-control text-uppercase" disabled></td>
											<td>Pincode</td>
											<td><input validate="pincode" type="text" class="form-control text-uppercase" id="pincode" onchange="checkPin(this.id)" pattern="[0-9]{6,6}" value="<?php echo $pincode; ?>" name="pincode" disabled></td>
										</tr>
										<tr>
											<td>10 (a). Phone No.</td>
											<td><input type="text" class="form-control text-uppercase" name="mobile_no" value="<?php echo $landline_std." - ".$landline_no; ?>" disabled></td>
											<td>10 (b). Mobile No.</td>
											<td><input validate="mobileNumber" type="text" class="form-control text-uppercase" name="mobile_no" value="<?php echo $mobile_no; ?>" disabled></td>
										</tr>
										
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>a" class="btn btn-success submit1">Save and Next</button>
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
											<td>Type of premises ?</td>
											<td>
												<label class="radio-inline"><input checked type="radio" <?php if($premises=="R" || $premises=="") echo "checked"; ?> value="R" name="premises"> Rented </label>
												<label class="radio-inline"><input type="radio" <?php if($premises=="O") echo "checked"; ?> value="O" name="premises"> Own </label>
											</td>
											<td></td>
											<td></td>									
										</tr>
										<tr class="Own">
											<td>11. GMC Holding No.<span class="mandatory_field">*</span></td>
											<td><input type="text" name="premises_details[a]" required="required" value="<?php echo $premises_details_a; ?>" class="form-control text-uppercase"></td>
											<td>12. <span id="oname">Owner's name<span class="mandatory_field">*</span></span><span id="pname"><?php if($owner_type=="PR") echo "Proprietor's Name :"; else echo "Enterprise's Name :"; ?></span> </td>
											<td><input type="text" validate="letters" id="premises_details_b" required="required" name="premises_details[b]" value="<?php if($premises=="O" && $owner_type!="PR") echo $trade_name; else if($premises=="O" && $owner_type=="PR") echo $owner_names; else echo $premises_details_b; ?>" class="form-control text-uppercase"></td>										
										</tr>
										<tr class="Own">
											<td>13. (a) Rent Per Month<span class="mandatory_field">*</span> <span id="per_value"> / value </span></td>
											<td id="rpm"><input type="text" required="required" value="<?php echo $premises_details_c; ?>" name="premises_details[c]" class="form-control text-uppercase"></td>
											<td>(b) Does premises have parking space ? </td>
											<td><label class="radio-inline"><input <?php if($premises_details_d=="" || $premises_details_d=="YES") echo "checked"; ?> type="radio" value="YES" id="" name="premises_details[d]"> Yes </label>
												<label class="radio-inline"><input type="radio" <?php if($premises_details_d=="NO") echo "checked"; ?> value="NO" id="" name="premises_details[d]"> No </label></td>
										</tr>
										<tr>
											<td>14. Owner's <span id="resid"> Residence </span>Address<span class="mandatory_field">*</span></td>
											<td><textarea name="premises_details[e]" required="required" placeholder="Address of the Owner of the Premises" class="form-control text-uppercase"><?php echo $premises_details_e; ?></textarea></td>
											<td></td>
											<td></td>
										<tr>
										<tr>
											<td>Does Godown Exist in the same premises ?</td>
											<td>
												<label class="radio-inline"><input <?php if($godown=="" || $godown=="Y") echo "checked"; ?> type="radio" value="Y" name="godown"> Yes </label>
												<label class="radio-inline"><input type="radio" <?php if($godown=="N") echo "checked"; ?> value="N" name="godown"> No </label>
											</td>
											<td></td>
											<td></td>									
										</tr>
										<tr class="GodownExists">
											<td>15. Godown Address :</td>
											<td><input type="text" name="godown_details[a]" value="Same Premises" class="form-control text-uppercase" disabled></td>
											<td>16 (a). Rent per annum:<span class="mandatory_field">*</span></td>
											<td><input type="text" name="godown_details[b]" id="godown_details_b" value="<?php echo $godown_details_b; ?>" class="form-control text-uppercase"></td>									
										</tr>
										<tr class="GodownExists">
											<td>16 (b). Does godown have parking space ? </td>
											<td>
												<label class="radio-inline"><input <?php if($godown_details_c=="Y" || $godown_details_c=="") echo "checked"; ?> type="radio" value="Y" id="" name="godown_details[c]"> Yes </label>
												<label class="radio-inline"><input <?php if($godown_details_c=="N") echo "checked"; ?> type="radio" value="N" id="" name="godown_details[c]"> No </label>
											</td>
											<td></td>
											<td></td>	
										</tr>
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>
												&nbsp;<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>b" class="btn btn-success">Save and Next</button>
											</td>
											<td></td>
										</tr>
									</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td style="width:25%">Do you have existing Trade License ? </td>
											<td style="width:25%">
												<label class="radio-inline"><input  required="required" type="radio" value="Y" <?php if($old_trade=='Y' || $old_trade=='') echo 'checked';?> name="old_trade"> Yes </label>
												<label class="radio-inline"><input required="required" <?php if($old_trade=='N') echo 'checked';?> type="radio" value="N"  name="old_trade"> No </label>
											</td>
											<td style="width:25%"></td>
											<td style="width:25%"></td>									
										</tr>
										<tr class="oldTrade">
											<td>17. License Number<span class="mandatory_field">*</span></td>
											<td><input type="text" value="<?php echo $old_trade_details_a;?>" name="old_trade_details[a]" class="form-control text-uppercase old_trade_details"></td>
											<td>18. Date of Issue (Most Recent)</td>
											<td><input type="text" value="<?php echo $old_trade_details_b;?>" name="old_trade_details[b]" class="dob form-control text-uppercase old_trade_details" readonly="readonly"></td>
										</tr>
										<tr class="oldTrade">
											<td>19. 1st License Issue Date :</td>
											<td><input type="text" value="<?php echo $old_trade_details_c;?>" name="old_trade_details[c]" class="dob form-control text-uppercase old_trade_details" readonly="readonly"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
											<a type="button" href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>
											&nbsp;<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>c" class="btn btn-success">Save and Next</button>
											</td>
											<td></td>
										</tr>
									</table>
								</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id=""  class="table table-responsive">
										<tr>
											<td>20. Type of business</td>
											<td><input type="text" value="<?php echo $business_type; ?>" class="form-control text-uppercase" disabled></td>
											<td>21. Capital Investment</td>
											<td><input type="text" value="<?php echo $cap_investment; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td>22. Annual Income for the previous<br/>financial year (in Rupees)<span class="mandatory_field">*</span></td>
											<td><input type="number" name="annual_income" validate="onlyNumbers" required="required" value="<?php echo $annual_income; ?>" class="form-control text-uppercase"></td>
											<td>23. Income Tax Payable / Paid for <br/>the previous financial year (in Rupees)</td>
											<td><input type="number" value="<?php echo $it_payable; ?>" validate="onlyNumbers" name="it_payable" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td>24. License</td>
											<td>
												<select name="license_type" class="form-control text-uppercase">
													<option <?php if($license_type=="G" || $license_type=="") echo "selected"; ?>>Regular(1 Year)</option>
													<option <?php if($license_type=="P") echo "selected"; ?>>Provisional(1 year)</option>						
												</select>
											</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<a type="button" href="<?php echo $table_name;?>.php?tab=3" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>d" class="btn btn-success">Save and Next</button>
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
	$('#resid').hide();
	$('#per_value').hide();
	$('#oname').show();
	$('#pname').hide();
	<?php if($premises=="O"){ ?>
	$('#resid').show();
	$('#per_value').show();
	$('#oname').hide();
	$('#pname').show();
	<?php } ?>
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
			$('#per_value').show();
			$('#oname').hide();
			$('#pname').show();
			$('#premises_details_b').val('<?php if($owner_type=="PR") echo $owner_names; else echo $trade_name; ?>');
		}else{
			$('#resid').hide();
			$('#per_value').hide();
			$('#pname').hide();
			$('#oname').show();
			$('#premises_details_b').val('');
		}
	});	
	/* ------------------------------------------------------ */
	$('#godown_details_b').attr('required','required');
	<?php if($godown=="N"){ ?> 
	$('.GodownExists').css('display', 'none');
	$('#godown_details_b').removeAttr('required','required');
	<?php } ?>
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');
			$('#godown_details_b').attr('required','required');			
		}else{
			$('.GodownExists').css('display', 'none');
			$('#godown_details_b').removeAttr('required','required');			
		}
	});
	/* ------------------------------------------------------ */
	$('.old_trade_details').attr('required','required');
	<?php if($old_trade=="N"){ ?>
	$('.oldTrade').hide();
	$('.old_trade_details').removeAttr('required','required');
	<?php } ?>
	
	$('input[name="old_trade"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.oldTrade').show();
			$('.old_trade_details').attr('required','required');
		}else{
			$('.oldTrade').hide();
			$('.old_trade_details').removeAttr('required','required');
		}
	});
	
	/* ------------------------------------------------------ */
	$('#Year, #Year2').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */	
	function calculateAge()
	{
		var dob = new Date(y,m.d);
		alert();
		dob.setFullYear(y, m-1, d);
		
		var today = new Date();
		today.setFullYear(today.getFullYear());
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		return age;
	}

	function date_of_birth(obj){
		
		var str2=$('#'+obj).val();
		var str3 = str2.replace('-','');
		var str = str3.replace('-','');
		
		var day=Number(str.substr(0,2));		
		var month=Number(str.substr(2,2))-1;
		var year=Number(str.substr(4,4));
		
		var today=new Date();
		var age=today.getFullYear()-year;
		
		
		if((today.getMonth()< month) || (today.getMonth()==month && today.getDate()<day))
		{
			age--;
		}
		if(age<18)
		{
			alert('Your age must be greater than 18 to fill up this form');
			$('#owner_age').val('');
			$('.dob').val('');
			
		}
		else
		{
			$('#owner_age').val(age);
			
		}	
	}
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