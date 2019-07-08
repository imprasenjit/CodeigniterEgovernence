<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="11";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";

if((isset($_GET['Agency']) && !empty($_GET['Agency'])) && (isset($_GET['Name_of_the_infrastructure_with_location']) && !empty($_GET['Name_of_the_infrastructure_with_location'])) && (isset($_GET['district_id']) && !empty($_GET['district_id']))){
	$_SESSION["authority"] = $authority = $_GET['Agency'];
	$_SESSION["indus_land"] = $indus_land = $_GET['Name_of_the_infrastructure_with_location'];
	$_SESSION["district_id"] = $dicc_district_id = $_GET['district_id'];
}elseif(isset($_SESSION["authority"]) && isset($_SESSION["indus_land"]) && isset($_SESSION["district_id"])){	
	$authority = $_SESSION["authority"];
	$indus_land = $_SESSION["indus_land"];
	$dicc_district_id = $_SESSION["district_id"];
}else{	
	echo "<script>	
				alert('Please select a available plot area.');
				window.location.href = '".$server_url."site/landbank/';
		</script>";
}
$get_file_name=basename(__FILE__);
include "save_dic_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
			
				if(isset($_GET['Agency']) && !empty($_GET['Agency'])){
					$authority = $_GET['Agency'];
				}elseif($results["authority"]!=""){
					$authority = $results["authority"];
				}elseif(isset($_SESSION["authority"]) && !empty($_SESSION["authority"])){
					$authority = $_SESSION["authority"];
				}else{
					$authority ="Not Found";
				}
				
				if(isset($_GET['district_id']) && !empty($_GET['district_id'])){
					$dicc_district_id = $_GET['district_id'];
				}elseif($results["dicc_district_id"]!=""){
					$dicc_district_id=$results["dicc_district_id"];
				}elseif(isset($_SESSION["district_id"]) && !empty($_SESSION["district_id"])){
					$dicc_district_id = $_SESSION["district_id"];
				}else{
					
				}
				
				if(isset($_GET['Name_of_the_infrastructure_with_location']) && !empty($_GET['Name_of_the_infrastructure_with_location'])){
					$indus_land = $_GET['Name_of_the_infrastructure_with_location'];
				}elseif($results["indus_land"]!=""){
					$indus_land=$results["indus_land"];
				}elseif(isset($_SESSION["indus_land"]) && !empty($_SESSION["indus_land"])){
					$indus_land = $_SESSION["indus_land"];
				}else{
					$indus_land="Not Found";
				}
				
				$actual_area=$results["actual_area"];
				$lic_no=$results["lic_no"];
				$lic_date=$results["lic_date"];
				$item_name=$results["item_name"];
				$production_capacity=$results["production_capacity"];
				$prod_export=$results["prod_export"];
				$civil_works=$results["civil_works"];
				$plant_n_machinery=$results["plant_n_machinery"];
				$other_fixed_assets=$results["other_fixed_assets"];
				$actual_prod_area=$results["actual_prod_area"];
				$godown=$results["godown"];
				$other_services=$results["other_services"];
				$power_req=$results["power_req"];
				$water_req=$results["water_req"];
				$if_any=$results["if_any"];
				$PI_indicate=$results["PI_indicate"];
				
                if($authority=="AIDC"){
				$authority_name = "Assam Industrial Development Corporation Limited";
				}elseif($authority=="AIIDC"){
					$authority_name = "Assam Industrial Infrastructure Development Corporation Limited";
				}elseif($authority=="ASIDC"){
					$authority_name = "Assam Small Industries Development Corporation Limited";
				}elseif($authority=="DICC"){
					$authority_name = "District Industries & Commerce Center";
				}else{
					$authority_name ="";
				}
				
			}else{
				$form_id=""; 
				$actual_area="";$lic_no="";$lic_date="";$item_name="";$production_capacity="";$prod_export="";$civil_works="";$plant_n_machinery="";$other_fixed_assets="";$actual_prod_area="";$godown="";$other_services="";$power_req="";$water_req="";$if_any="";$PI_indicate="";$authority_name ="";
			}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
			if(isset($_GET['Agency']) && !empty($_GET['Agency'])){
				$authority = $_GET['Agency'];
			}elseif($results["authority"]!=""){
				$authority = $results["authority"];
			}elseif(isset($_SESSION["authority"]) && !empty($_SESSION["authority"])){
				$authority = $_SESSION["authority"];
			}else{
				$authority ="Not Found";
			}
			
			if(isset($_GET['district_id']) && !empty($_GET['district_id'])){
				$dicc_district_id = $_GET['district_id'];
			}elseif($results["dicc_district_id"]!=""){
				$dicc_district_id=$results["dicc_district_id"];
			}elseif(isset($_SESSION["district_id"]) && !empty($_SESSION["district_id"])){
				$dicc_district_id = $_SESSION["district_id"];
			}else{
				
			}
			
			if(isset($_GET['Name_of_the_infrastructure_with_location']) && !empty($_GET['Name_of_the_infrastructure_with_location'])){
				$indus_land = $_GET['Name_of_the_infrastructure_with_location'];
			}elseif($results["indus_land"]!=""){
				$indus_land=$results["indus_land"];
			}elseif(isset($_SESSION["indus_land"]) && !empty($_SESSION["indus_land"])){
				$indus_land = $_SESSION["indus_land"];
			}else{
				$indus_land="Not Found";
			}
			
		$actual_area=$results["actual_area"];
		$lic_no=$results["lic_no"];
		$lic_date=$results["lic_date"];
		$item_name=$results["item_name"];
		$production_capacity=$results["production_capacity"];
		$prod_export=$results["prod_export"];
		$civil_works=$results["civil_works"];
		$plant_n_machinery=$results["plant_n_machinery"];
		$other_fixed_assets=$results["other_fixed_assets"];
		$actual_prod_area=$results["actual_prod_area"];
		$godown=$results["godown"];
		$other_services=$results["other_services"];
		$power_req=$results["power_req"];
		$water_req=$results["water_req"];
		$if_any=$results["if_any"];
		$PI_indicate=$results["PI_indicate"];				
	
		if($authority=="AIDC"){
			$authority_name = "Assam Industrial Development Corporation Limited";
		}elseif($authority=="AIIDC"){
			$authority_name = "Assam Industrial Infrastructure Development Corporation Limited";
		}elseif($authority=="ASIDC"){
			$authority_name = "Assam Small Industries Development Corporation Limited";
		}elseif($authority=="DICC"){
			$authority_name = "District Industries & Commerce Center";
		}else{
			$authority_name ="";
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
								<form name="myform10" id="myformFT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">Choose a District : <span class="mandatory_field">*</span></td>
										<td width="25%">												
											<?php 
											$select_district="SELECT dist_name FROM districts WHERE dist_id='$dicc_district_id'";
											$exec_select_district=$formFunctions->executeQuery("dicc",$select_district);
											if($exec_select_district->num_rows>0){
												$row_district=$exec_select_district->fetch_array();
												$dicc_district=$row_district["dist_name"];
											}else{
												$dicc_district="";
											}
											$dstresult=$formFunctions->executeQuery("dicc","SELECT dist_id, dist_name FROM districts WHERE state_id='4' and dist_name !='' GROUP BY dist_name ASC"); ?>
												<select name="dicc_district_id" id="dicc_district" onchange="select_district()"  class="form-control text-uppercase" required="required">
													<option value=""><?php  if($dicc_district!=""){ echo strtoupper($dicc_district);}else{ echo "Select District";} ?></option>
													<?php while($rows_dist=$dstresult->fetch_object()) {
														if(isset($dicc_district_id) && ($dicc_district_id==$rows_dist->dist_id)){
															$s='selected'; 
														}else{
															$s='';
														}  ?>
														<option value="<?php echo $rows_dist->dist_id;?>" <?php echo $s;?>><?php echo $rows_dist->dist_name; ?></option>
													<?php }		?>
												</select>
										</td>
										<td width="25%">Industrial land available at : <span class="mandatory_field">*</span></td>
										<td width="25%" id="fetch_infra">
											<input class="form-control text-uppercase" type="text" name="indus_land" value="<?=strtoupper($indus_land);?>" readonly="readonly">
										</td>
										<td colspan="2"></td>
									</tr>
									<tr>										
										<td width="25%">Authority : <span class="mandatory_field">*</span></td>
										<td width="25%" id="fetch_auth">
											<input type="text" class="form-control text-uppercase" name="authority_name" value="<?=strtoupper($authority_name);?>" readonly="readonly">
											<input type="hidden" class="form-control text-uppercase" name="authority" value="<?=strtoupper($authority);?>" readonly="readonly">
										</td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td colspan="4">1. Location of land/Shed applied for (Actual name of the industrial property as mentioned):</td>
									</td>
									</tr>
									<tr>
										<td width="25%">Street Name1:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name1	; ?>" disabled></td>
										<td width="25%">Street Name2:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name2	; ?>" disabled></td>
									</tr>
									<tr>
										<td width="25%">Vill/Town:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_vill; ?>" disabled></td>
										<td width="25%">District:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_dist; ?>" disabled></td>
									</tr>
									<tr>
										<td width="25%">PIN Code:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_pincode; ?>" disabled></td>
										<td width="25%">Mobile No:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_mobile_no; ?>" disabled></td>
									</tr>
									<tr>
										<td width="25%">Phone Number:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_landline_std."-".$b_landline_no; ?>" disabled></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">2. Actual area applied for (in terms of sqmeter) :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="actual_area" value="<?php echo $actual_area; ?>" ></td>
										<td width="25%">3. Name of the Industrial Unit :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $unit_name; ?>" disabled></td>
									</tr>
									<tr>
										<td colspan="4">4. Address for communication</td>								
									</tr>
									<tr>
										<td width="25%">Street Name 1:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name1; ?>"disabled></td>
										<td width="25%">Street Name 2:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name2; ?>"disabled></td>
									</tr>
									<tr>
										<td width="25%">Vill/Town:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_vill; ?>"disabled></td>
										<td width="25%">District:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_dist; ?>"disabled></td>
									</tr>
									<tr>
										<td width="25%">PIN Code</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_pincode; ?>" disabled></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									
									<tr>
										<td width="25%">5. Constitution of the Industrial unit:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $Type_of_ownership; ?>" disabled></td>
										<td width="25%">6. Name of the Proprietor/Partner/Board of Directors:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $owner_names; ?>" disabled></td>
									</tr>
									<tr>
										<td width="25%">7. (a)EM-I/EM- II/IEM/Industrial Licence no:</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="lic_no" value="<?php echo $lic_no; ?>" ></td>
										<td width="25%"> (b)Licence date:</td>
										<td width="25%"><input class="dobindia form-control text-uppercase" type="text" name="lic_date" value="<?php if($lic_date!="0000-00-00" && $lic_date!="") echo date("d-m-Y",strtotime($lic_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td width="25%">8. Name of Item/s of manufacture :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="item_name" value="<?php echo $item_name; ?>"></td>
										<td width="25%">9. Proposed Annual Installed Capacity of Production in MT (item-wise) :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="production_capacity" value="<?php echo $production_capacity; ?>"></td>
									</tr>
									<tr>
										<td width="25%">10. Proposed export of product (in terms of MT) :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="prod_export" value="<?php echo $prod_export; ?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td  colspan="4">11. Proposed investment (Rs. in lakh)</td>										
									</tr>
									<tr>
										<td width="25%">(a) Civil works :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="civil_works" value="<?php echo $civil_works; ?>" validate="onlyNumbers"></td>
										<td width="25%">(b) Plant &amp; Machinery :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="plant_n_machinery" value="<?php echo $plant_n_machinery; ?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td width="25%">(c) Other fixed assets :</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="other_fixed_assets" value="<?php echo $other_fixed_assets; ?>" validate="onlyNumbers"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">12. Requirement of Land (sq ft)</td>
									</tr>
									<tr>
										<td width="25%">(a) For actual production area ( sq ft):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="actual_prod_area" value="<?php echo $actual_prod_area; ?>" validate="decimal" validate="decimal"></td>
										<td width="25%">(b) For Godown ( sq ft):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="godown" value="<?php echo $godown; ?>" validate="decimal"></td>
									</tr>
									<tr>
										<td width="25%">(c) Other utility services ( sq ft):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="other_services" value="<?php echo $other_services; ?>" validate="decimal"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">13. Other amenities</td>
										
									</tr>
									<tr>
										<td width="25%">(a) Requirement of Power (HP):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="power_req" value="<?php echo $power_req; ?>"></td>
										<td width="25%">(b) Annual requirement of Water (in KL):</td>
										<td width="25%"><input class="form-control text-uppercase" type="text" name="water_req" value="<?php echo $water_req; ?>"></td>
									</tr>
									<tr>
										<td width="25%">14. If there any effluent problem:<span class="mandatory_field">*</span></td>
										<td width="25%">
											<label class="radio-inline"><input type="radio" required="required" name="if_any" value="Y"  <?php if(isset($if_any) && $if_any=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="if_any"  value="N"  <?php if(isset($if_any) && $if_any=='N') echo 'checked'; ?>/> No</label>
										</td>
										<td width="25%">15. If yes , Please indicate with 50 words:</td>
										<td width="25%"><textarea name="PI_indicate"  id="PI_indicate" class="form-control text-uppercase"  ><?php echo $PI_indicate; ?></textarea></td>
									</tr>
									<tr>
										<td>Date : <label><b><?php echo date('d-m-Y',strtotime($today));?></b></label><br/>
										Place : <label><b><?=strtoupper($dist);?></b></label></td>
										<td></td>
										<td></td>
										<td align="right"><label><b><?php echo strtoupper($key_person); ?></b></label><br/>Signature of the Applicant</td>
									</tr>
									<tr>
										<td colspan="4" align="center">
										<button type="submit" name="save<?php echo $form;?>" class="btn btn-success submit1" title="Save it and go to the next part">Save & Next</button></td>
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
	<?php if($if_any=="N"){ ?>
		$('#PI_indicate').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="if_any"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#PI_indicate').removeAttr('disabled', 'disabled');			
		}else{
			$('#PI_indicate').attr('disabled', 'disabled');			
		}
	});
	
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
		
	/* ------------------------------------------------------ */
	function select_district(){
		 if($("#dicc_district").val()==false){
			alert("Please select a District !");
			$("#dicc_district").focus();
			return ;			
		}else{
			var dicc_district = $("#dicc_district").val();
		}
        
		$.ajax({
            type: "POST",
            url: "name_of_infrastructure_ac_district.php",
            data: { dicc_district: dicc_district},
            beforeSend:function(){
                $("#fetch_infra").html("<img src='../../../images/loading.gif' style='width:200px; height:150px; margin:250px auto'>");
            },
            success:function(data){
                $("#fetch_infra").html(data);
				$('table.search-table').tableSearch({
					searchText:'Search Table',
					searchPlaceHolder:'SEARCH HERE',
					divStyle:'float:right'
				});
            }
        });
	 }
	function select_infra(){
		 if($("#indus_land").val()==false){
			alert("Please select an Infrastructure !");
			$("#indus_land").focus();
			return ;			
		}else{
			var indus_land = $("#indus_land").val();
		}
        
		$.ajax({
            type: "POST",
            url: "fetch_authority.php",
            data: { indus_land: indus_land},
            beforeSend:function(){
                $("#fetch_auth").html("<img src='../../../images/loading.gif' style='width:200px; height:150px; margin:250px auto'>");
            },
            success:function(data){
                $("#fetch_auth").html(data);
				$('table.search-table').tableSearch({
					searchText:'Search Table',
					searchPlaceHolder:'SEARCH HERE',
					divStyle:'float:right'
				});
            }
        });
	 }
</script>