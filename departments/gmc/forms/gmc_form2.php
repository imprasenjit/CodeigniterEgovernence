<?php  require_once "../../requires/login_session.php";
$dept="gmc";
$form="2";
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
			$form_id=$results["form_id"];$fat_name=$results["fat_name"];$is_factory_license=$results["is_factory_license"];$property_tax=$results["property_tax"];$prop_dispose=$results["prop_dispose"];$plant_par=$results["plant_par"];$rent_details=$results["rent_details"];$trade_premises=$results["trade_premises"];$date_fac=$results["date_fac"];$app_fee=$results["app_fee"];$app_date=$results["app_date"];			
			if(!empty($results["factory"])){
				$factory=json_decode($results["factory"]);
				$factory_name=$factory->name;$factory_nature=$factory->nature;$factory_trade_premises=$factory->trade_premises;	
			}else{				
				$factory_name="";$factory_nature="";$factory_trade_premises="";
			}
			if(!empty($results["property_tax"])){
				$property_tax=json_decode($results["property_tax"]);
				$property_tax_payment_date=$property_tax->payment_date;$property_tax_receipt_no=$property_tax->receipt_no;	
			}else{				
				$property_tax_payment_date="";$property_tax_receipt_no="";
			}			
			if(!empty($results["worker"])){
				$worker=json_decode($results["worker"]);
				$worker_year=$worker->year;$worker_month=$worker->month;$worker_employed=$worker->employed;
			}else{
				$worker_year="";$worker_month="";$worker_employed="";
			}		
			if(!empty($results["is_license"])){
				$is_license=Array();
				$is_license=explode("//",$results["is_license"]);
				$is_license_a=$is_license[0];$is_license_b=$is_license[1];
			}else{
				$is_license_a="";$is_license_b="";
			}	
			if(!empty($results["power"])){
				$power=json_decode($results["power"]);
				$power_nature=$power->nature;$power_amount=$power->amount;
			}else{
				$power_nature="";$power_amount="";
			}	
			if(!empty($results["owner"])){
				$owner=json_decode($results["owner"]);
				$owner_name=$owner->name;$owner_sn1=$owner->sn1;$owner_sn2=$owner->sn2;$owner_d=$owner->d;$owner_v=$owner->v;$owner_p=$owner->p;
			}else{
				$owner_name="";$owner_sn1="";$owner_sn2="";$owner_v="";$owner_d="";$owner_p="";
			}
			if(!empty($results["company"])){
				$company=json_decode($results["company"]);
				$company_capital=$company->capital;$company_income_tax=$company->income_tax;
			}else{
				$company_capital="";$company_income_tax="";
			}
			if(!empty($results["godown"])){
				$godown=json_decode($results["godown"]);
				$godown_premises=$godown->premises;$godown_outside=$godown->outside;
			}else{
				$godown_premises="";$godown_outside="";
			}	
			if(!empty($results["fact_const"])){
				$fact_const=json_decode($results["fact_const"]);
				$fact_const_date_approval=$fact_const->date_approval;$fact_const_ref_no=$fact_const->ref_no;
			}else{
				$fact_const_date_approval="";$fact_const_ref_no="";
			}
		}else{
			$form_id="";$fat_name="";$prop_dispose="";$plant_par="";$rent_details="";$trade_premises="";$date_fac="";$app_fee="";$app_date="";
			$factory_name="";$factory_nature="";$factory_trade_premises="";
			$worker_year="";$worker_month="";$worker_employed="";
			$is_factory_license="";$is_license_a="";$is_license_b="";
			$power_nature="";$power_amount="";
			$owner_name="";$owner_sn1="";$owner_sn2="";$owner_v="";$owner_d="";$owner_p="";
			$company_capital="";$company_income_tax="";
			$godown_premises="";$godown_outside="";
			$fact_const_date_approval="";$fact_const_ref_no="";
			$property_tax_payment_date="";$property_tax_receipt_no="";
		}
	}else{	
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$fat_name=$results["fat_name"];$is_factory_license=$results["is_factory_license"];$property_tax=$results["property_tax"];$prop_dispose=$results["prop_dispose"];$plant_par=$results["plant_par"];$rent_details=$results["rent_details"];$trade_premises=$results["trade_premises"];$date_fac=$results["date_fac"];$app_fee=$results["app_fee"];$app_date=$results["app_date"];			
		if(!empty($results["factory"])){
			$factory=json_decode($results["factory"]);
			$factory_name=$factory->name;$factory_nature=$factory->nature;$factory_trade_premises=$factory->trade_premises;	
		}else{				
			$factory_name="";$factory_nature="";$factory_trade_premises="";
		}
		if(!empty($results["property_tax"])){
			$property_tax=json_decode($results["property_tax"]);
			$property_tax_payment_date=$property_tax->payment_date;$property_tax_receipt_no=$property_tax->receipt_no;	
		}else{				
			$property_tax_payment_date="";$property_tax_receipt_no="";
		}			
		if(!empty($results["worker"])){
			$worker=json_decode($results["worker"]);
			$worker_year=$worker->year;$worker_month=$worker->month;$worker_employed=$worker->employed;
		}else{
			$worker_year="";$worker_month="";$worker_employed="";
		}		
		if(!empty($results["is_license"])){
			$is_license=Array();
			$is_license=explode("//",$results["is_license"]);
			$is_license_a=$is_license[0];$is_license_b=$is_license[1];
		}else{
			$is_license_a="";$is_license_b="";
		}	
		if(!empty($results["power"])){
			$power=json_decode($results["power"]);
			$power_nature=$power->nature;$power_amount=$power->amount;
		}else{
			$power_nature="";$power_amount="";
		}	
		if(!empty($results["owner"])){
			$owner=json_decode($results["owner"]);
			$owner_name=$owner->name;$owner_sn1=$owner->sn1;$owner_sn2=$owner->sn2;$owner_d=$owner->d;$owner_v=$owner->v;$owner_p=$owner->p;
		}else{
			$owner_name="";$owner_sn1="";$owner_sn2="";$owner_v="";$owner_d="";$owner_p="";
		}
		if(!empty($results["company"])){
			$company=json_decode($results["company"]);
			$company_capital=$company->capital;$company_income_tax=$company->income_tax;
		}else{
			$company_capital="";$company_income_tax="";
		}
		if(!empty($results["godown"])){
			$godown=json_decode($results["godown"]);
			$godown_premises=$godown->premises;$godown_outside=$godown->outside;
		}else{
			$godown_premises="";$godown_outside="";
		}	
		if(!empty($results["fact_const"])){
			$fact_const=json_decode($results["fact_const"]);
			$fact_const_date_approval=$fact_const->date_approval;$fact_const_ref_no=$fact_const->ref_no;
		}else{
			$fact_const_date_approval="";$fact_const_ref_no="";
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
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li  class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
								
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
									    <tr>
									    	<td colspan="4">To,<br/>
									    	The Commissioner,<br/>GUWAHATI MUNICIPAL CORPORATION<br/>GUWAHATI.</td>
									    </tr>
									    <tr>
									    	<td colspan="4">Application for granting or renewal of licence for Factories, Workshop or trade premises in which steam, electricity water or other mechanical power is intended to employ U/S 273 read with Section 378 of the Guwahati Municipal Corporation Act 1969.</td>
									    </tr>
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
											<td>1. Full Name of the Factory :  </td>
											<td colspan="2"><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $unit_name; ?>"></td>
											<td></td>
										</tr>
										<tr>
											<td style="width:25%">2. (a) Name of the owner :</td>
											<td style="width:25%"><input  type="text"  class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"  ></td>
											<td style="width:25%">(b) Father&#39;s Name :<span class="mandatory_field">*</span></td>
											<td style="width:25%"><input type="text" class="form-control text-uppercase" name="fat_name" required="required" validate="letters" value="<?php echo  $fat_name; ?>" /></td>
										</tr>
										<tr>
											<td colspan="4">3. Full Address and situation of factory with ward No. :</td>
										</tr>
										<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_pincode; ?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_landline_std." - ".$b_landline_no; ?>"></td>
										<td>Ward No.:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_block; ?>"></td>
									</tr>
										<tr>
											<td>4. Factory licence already obtained ? </td>
											<td colspan="3"><label class="radio-inline"><input type="radio" name="is_factory_license" value="Y" <?php if($is_factory_license=="Y" || $is_factory_license=="") echo "checked"; ?>>Yes</label>  <label class="radio-inline"><input type="radio" name="is_factory_license" <?php if($is_factory_license=="N") echo "checked"; ?> value="N">No</label></td>
										</tr>
										<tr id="reg_no_row">
											<td>Registration No.</td>
											<td><input type="text" id="reg_no" class="form-control text-uppercase" name="reg_no" value="<?php echo $is_license_a; ?>"></td>
											<td>Date and Year :</td>
											<td><input type="text" id="dateyear" class="regdob form-control text-uppercase" name="reg_date" readonly="readonly" value="<?php echo $is_license_b; ?>"></td>
										</tr>
										<tr id="site_row">
											<td>State the details of the site plan :</td>
											<td><textarea class="form-control text-uppercase" id="state_details" name="site_details"><?php echo $is_license_a; ?></textarea></td>
											<td>Date of commencement :</td>
											<td><input type="text" id="com_dateyear" class="comdob form-control text-uppercase" name="com_date" readonly="readonly" value="<?php echo $is_license_b; ?>"></td>
											
										</tr>
										<tr>
											<td>5. (a) Name of the principal products manufactured during the last 12 months :</td>
											<td><input type="text"  class="form-control text-uppercase" name="factory[name]" value="<?php echo $factory_name;?>" ></td>
											<td>(b) If it is a workshop state nature of work done :</td>
											<td><input type="text"  class="form-control text-uppercase"  name="factory[nature]" value="<?php echo $factory_nature;?>"></td>
										</tr>
										<tr>
											<td>(c) If it is a trade premises state the particular of products deal in. :</td>
											<td><input type="text" class="form-control text-uppercase"  name="factory[trade_premises]" value="<?php echo $factory_trade_premises;?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>6. (a) Maximum number of workers proposed to<br/> be employed on any during the year :</td>
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="worker[year]" value="<?php echo $worker_year?>" ></td>
											<td>(b) Minimum number of workers on<br/> any day during the last 12 months.</td>
											<td><input validate="onlyNumbers" type="text" class="form-control text-uppercase" name="worker[month]" value="<?php echo $worker_month?>"></td>
										</tr>
										<tr>
											<td>(c) Number of workers to be ordinarily employed :</td>
											<td><input validate="onlyNumbers" type="text"  class="form-control text-uppercase" name="worker[employed]" value="<?php echo $worker_employed?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">7. (a) Nature and total amount of power (H.P) installed. : </td>
										</tr>
										<tr>
										    <td>Nature:</td>
											<td><input type="text" class="form-control text-uppercase" name="power[nature]" value="<?php echo $power_nature?>"></td>
											<td>Total amount:</td>
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers"  name="power[amount]" value="<?php echo $power_amount?>"></td>
										</tr>
										<tr>
											<td colspan="4">8. Full Name of the owner of the building and address of the premises :</td>
										</tr>
									<tr>
									    <td>Full Name :<span class="mandatory_field">*</span></td>
									    <td><input type="text" class="form-control text-uppercase"  name="owner[name]" validate="letters" value="<?php echo $owner_name; ?>" required="required"></td>
										<td>Street Name 1 :<span class="mandatory_field">*</span></td>
									    <td><input type="text" class="form-control text-uppercase"  name="owner[sn1]" value="<?php echo $owner_sn1; ?>"  required="required"></td>
									</tr>
									<tr>
									    <td>Street Name 2 :</td>
									    <td><input type="text" class="form-control text-uppercase"  name="owner[sn2]" value="<?php echo $owner_sn2; ?>"  ></td>
										<td>Village/Town :<span class="mandatory_field">*</span></td>
									    <td><input type="text" class="form-control text-uppercase" name="owner[v]" value="<?php echo $owner_v; ?>"  required="required"></td>
									</tr>
									<tr>
									    <td>District :</td>
                                        <td><input type="text" class="form-control text-uppercase" name="owner[d]" id="dist2" value="<?php echo $owner_d; ?>"  required="required"></td>
									    
										<td>Pin Code :<span class="mandatory_field">*</span></td>
									    <td><input type="text" class="form-control text-uppercase" maxlength="6" validate="pincode" name="owner[p]" value="<?php echo $owner_p; ?>"  required="required"></td>
									</tr>
										<tr>
											<td colspan="4">9. In the case of Factory constructed or extended after the date of the commencement of the building by law give reference number &amp; date of approval of the site plan by the Guwahati Municipal Corporation. :</td>
										</tr>
										<tr>
											<td>a) Reference No.:</td>
											<td><input type="text" class="form-control text-uppercase" name="fact_const[ref_no]" value="<?php echo $fact_const_ref_no;?>" ></td>
											<td>b) Date of Approval :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="fact_const[date_approval]" value="<?php echo $fact_const_date_approval;?>" ></td>
										</tr>
										<tr>
											<td colspan="4">10. If the building is assessed to the property tax mention the receipt no. and date of payment of tax :</td>
										</tr>
										<tr>
											<td>a) Receipt No. :</td>
											<td><input type="text"  class="form-control text-uppercase"  name="property_tax[receipt_no]" value="<?php echo $property_tax_receipt_no;?>"></td>
											<td>b) Payment Date :</td>
											<td><input type="text"  class="dob form-control text-uppercase"  name="property_tax[payment_date]" value="<?php echo $property_tax_payment_date;?>"></td>
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
											<td colspan="3">11. How do u propose to dispose trade waste and effluent and whether approval from the Municipal Authority has been sought for or applied :</td>
											<td><textarea validate="textarea" class="form-control text-uppercase" name="prop_dispose"><?php echo $prop_dispose;?></textarea></td>
										</tr>
										<tr>
											<td colspan="3">12. Particular of plants installed or proposed to be installed.</td>
											<td><textarea validate="textarea" class="form-control text-uppercase" name="plant_par" ><?php echo $plant_par;?></textarea></td>
										</tr>
										<tr>
											<td colspan="3">13. If rented, state the actual rent per months if not, State the prevailing market rent of the premises.</td>
											<td><input type="text"  class="form-control text-uppercase" name="rent_details" value="<?php echo $rent_details;?>" ></td>
										</tr>
										<tr>
											<td colspan="3">14. Income from the Factory/Workshop/ or Trade premises.</td>
											<td><input  type="text" class="form-control text-uppercase" name="trade_premises" value="<?php echo $trade_premises;?>"  ></td>
										</tr>
										<tr>
											<td colspan="4">15. If it is Company-</td>
										</tr>
										<tr>
											<td width="25%">(a) Paid up capital-</td>
											<td width="25%"><input type="text"   class="form-control text-uppercase" name="company[capital]" value="<?php echo $company_capital;?>" ></td>
											<td width="25%">(b) Income Tax paid for last two years.</td>
											<td width="25%"><input type="text"   class="form-control text-uppercase" name="company[income_tax]" value="<?php echo $company_income_tax;?>" ></td>
										</tr>
										<tr>
											<td colspan="4">16. Godown-</td>
										</tr>
										<tr>
											<td>(a) Situated in the same premises</td>
											<td><input type="text"  class="form-control text-uppercase" name="godown[premises]" value="<?php echo $godown_premises;?>"  ></td>
											<td>(b) Situated outside premises, and give location and its rent.</td>
											<td><input type="text" class="form-control text-uppercase" name="godown[outside]" value="<?php echo $godown_outside;?>"  ></td>
										</tr>
										<tr>
											<td colspan="3">17. Date of the establishment of the factory/workshop/or trade premise.</td>
											<td><input type="text" class="dob form-control text-uppercase" placeholder="yyyy-mm-dd" name="date_fac" value="<?php if($date_fac=="0000-00-00") echo ""; else echo $date_fac;?>"></td>
										</tr>
										<tr>
											<td colspan="4" class="form-inline">I, Shri &nbsp;<input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person;?>"> solemnly affirm and state that the above statement made by me is true to my knowledge and belief..</td>
										</tr>
										<tr>										
										    <td class="text-center" colspan="4">
												<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	$('#offlinePayDetials').hide();
	$(document).ready(function(){
		$('input[name="payment_mode"]').on('change', function(){
			if($(this).val() == 0){						
				$('#offlinePayDetials').show("fast");						
			}else{
				$('#offlinePayDetials').hide("slow");
			}	
			
		});
		$('.regdob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50", maxDate: 0});
		$('.comdob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50", minDate: 0});
		<?php if($is_factory_license=="Y"){  ?>
				$('#site_row').hide();
		<?php }else{ ?>
				$('#reg_no_row').hide();
		<?php }  ?>
		
		$('input[name="is_factory_license"]').on('change', function(){
			if($(this).val() == "Y"){						
				$('#reg_no').attr('required','required');						
				$('#dateyear').attr('required','required');						
				$('#state_details').removeAttr('required','required');
				$('#com_dateyear').removeAttr('required','required');
				$('#reg_no').val('');				
				$('#dateyear').val('');
				$('#reg_no_row').show();				
				$('#site_row').hide();				
			}else{
				$('#reg_no').removeAttr('required','required');								
				$('#dateyear').removeAttr('required','required');
				$('#state_details').val('');				
				$('#com_dateyear').val('');
				$('#state_details').attr('required','required');
				$('#com_dateyear').attr('required','required');
				$('#reg_no_row').hide();
				$('#site_row').show();
			}	
			
		});
	});
/* ---------------------upload S/C click operation-------------------- */
	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	
</script>