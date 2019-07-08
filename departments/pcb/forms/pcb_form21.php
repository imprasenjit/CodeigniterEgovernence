<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="21";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_hw_form.php";

		
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();	
		$form_id=$results['form_id'];
		####### PART I #######
		$year_of_comm=$results['year_of_comm'];
		if(!empty($results["occupier_add"])){
			$occupier_add=json_decode($results["occupier_add"]);
			$occupier_add_name=$occupier_add->name;$occupier_add_desig=$occupier_add->desig;$occupier_add_mob_no=$occupier_add->mob_no;$occupier_add_email=$occupier_add->email;
		}else{
			$occupier_add_name="";$occupier_add_desig="";$occupier_add_mob_no="";$occupier_add_email="";
		}
		if(!empty($results["auth_req"])){
			$auth_req=json_decode($results["auth_req"]);
			if(isset($auth_req->gen)) $auth_req_gen=$auth_req->gen;
			else $auth_req_gen="";
			if(isset($auth_req->col)) $auth_req_col=$auth_req->col;
			else $auth_req_col="";
			if(isset($auth_req->str)) $auth_req_str=$auth_req->str;
			else $auth_req_str="";				
			if(isset($auth_req->transport)) $auth_req_transport=$auth_req->transport;
			else $auth_req_transport="";
			if(isset($auth_req->recept)) $auth_req_recept=$auth_req->recept;
			else $auth_req_recept="";
			if(isset($auth_req->reuse)) $auth_req_reuse=$auth_req->reuse;
			else $auth_req_reuse="";
			if(isset($auth_req->recycle)) $auth_req_recycle=$auth_req->recycle;
			else $auth_req_recycle="";
			if(isset($auth_req->rec)) $auth_req_rec=$auth_req->rec;
			else $auth_req_rec="";
			if(isset($auth_req->pre)) $auth_req_pre=$auth_req->pre;
			else $auth_req_pre="";
			if(isset($auth_req->co)) $auth_req_co=$auth_req->co;
			else $auth_req_co="";
			if(isset($auth_req->uti)) $auth_req_uti=$auth_req->uti;
			else $auth_req_uti="";
			if(isset($auth_req->treat)) $auth_req_treat=$auth_req->treat;
			else $auth_req_treat="";
			if(isset($auth_req->disp)) $auth_req_disp=$auth_req->disp;
			else $auth_req_disp="";
			if(isset($auth_req->inci)) $auth_req_inci=$auth_req->inci;
			else $auth_req_inci="";
		}else{
			$auth_req_gen="";$auth_req_col="";$auth_req_str="";$auth_req_transport="";$auth_req_recept="";$auth_req_reuse="";$auth_req_recycle="";$auth_req_rec="";$auth_req_pre="";$auth_req_co="";$auth_req_uti="";$auth_req_treat="";$auth_req_disp="";$auth_req_inci="";
		}	
		if(!empty($results["ren_auth"])){
			$ren_auth=json_decode($results["ren_auth"]);
			$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
		}else{
			$ren_auth_no="";$ren_auth_dt="";
		}		
		if(!empty($results["ind_work"])){
			$ind_work=json_decode($results["ind_work"]);
			if(isset($ind_work->one)) $ind_work_one=$ind_work->one;
			else $ind_work_one="";
			if(isset($ind_work->two)) $ind_work_two=$ind_work->two;
			else $ind_work_two="";
			if(isset($ind_work->clock)) $ind_work_clock=$ind_work->clock;
			else $ind_work_clock="";				
		}else{
			$ind_work_one="";$ind_work_two="";$ind_work_clock="";
		}
		##### PART II ######
		$is_generator=$results['is_generator'];$env_details=$results['env_details'];
		if(!empty($results["mode_of_manage"])){
			$mode_of_manage=json_decode($results["mode_of_manage"]);
			$mode_of_manage_cap=$mode_of_manage->cap;$mode_of_manage_plant=$mode_of_manage->plant;$mode_of_manage_waste=$mode_of_manage->waste;$mode_of_manage_arrange=$mode_of_manage->arrange;
		}else{
			$mode_of_manage_cap="";$mode_of_manage_plant="";$mode_of_manage_waste="";$mode_of_manage_arrange="";
		}			
		##### PART III ######
		$is_operator=$results['is_operator'];$incineration=$results['incineration'];$leachate=$results['leachate'];$fire_system=$results['fire_system'];$trans_arrangement=$results['trans_arrangement'];$facility_detail=$results['facility_detail'];		
		##### PART IV ######
		$is_recycler=$results['is_recycler'];$storage_detail=$results['storage_detail'];$process_desc=$results['process_desc'];$pcs_detail=$results['pcs_detail'];$health_details=$results['health_details'];$pcb_guidelines=$results['pcb_guidelines'];$trans_arrange=$results['trans_arrange'];
		
		if(!empty($results["ins_capacity"])){
			$ins_capacity=json_decode($results["ins_capacity"]);
			$ins_capacity_qty=$ins_capacity->qty;$ins_capacity_unit=$ins_capacity->unit;
		}else{
			$ins_capacity_qty="";$ins_capacity_unit="";
		}
	}else{		
		$form_id=""; 
		###### PARTI ######
		$year_of_comm="";
		$occupier_add_name="";$occupier_add_desig="";$occupier_add_mob_no="";$occupier_add_email="";			
		$auth_req_gen="";$auth_req_col="";$auth_req_str="";$auth_req_transport="";$auth_req_recept="";$auth_req_reuse="";$auth_req_recycle="";$auth_req_rec="";$auth_req_pre="";$auth_req_co="";$auth_req_uti="";$auth_req_treat="";$auth_req_disp="";$auth_req_inci="";
		$ren_auth_no="";$ren_auth_dt="";	
		$ind_work_one="";$ind_work_two="";$ind_work_clock="";
		###### PARTII ######
		$is_generator="";
		$mode_of_manage_cap="";$mode_of_manage_plant="";$mode_of_manage_waste="";$mode_of_manage_arrange="";
		###### PARTIII ######
		$is_operator="";$incineration="";$leachate="";$fire_system="";$trans_arrangement="";$facility_detail="";
		###### PARTIV ######
		$is_recycler="";$storage_detail="";$process_desc="";$pcs_detail="";$health_details="";$pcb_guidelines="";$trans_arrange=""; 
		$ins_capacity_qty="";$ins_capacity_unit="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	####### PART I #######
	$year_of_comm=$results['year_of_comm'];
	if(!empty($results["occupier_add"])){
		$occupier_add=json_decode($results["occupier_add"]);
		$occupier_add_name=$occupier_add->name;$occupier_add_desig=$occupier_add->desig;$occupier_add_mob_no=$occupier_add->mob_no;$occupier_add_email=$occupier_add->email;
	}else{
		$occupier_add_name="";$occupier_add_desig="";$occupier_add_mob_no="";$occupier_add_email="";
	}
	if(!empty($results["auth_req"])){
		$auth_req=json_decode($results["auth_req"]);
		if(isset($auth_req->gen)) $auth_req_gen=$auth_req->gen;
		else $auth_req_gen="";
		if(isset($auth_req->col)) $auth_req_col=$auth_req->col;
		else $auth_req_col="";
		if(isset($auth_req->str)) $auth_req_str=$auth_req->str;
		else $auth_req_str="";				
		if(isset($auth_req->transport)) $auth_req_transport=$auth_req->transport;
		else $auth_req_transport="";
		if(isset($auth_req->recept)) $auth_req_recept=$auth_req->recept;
		else $auth_req_recept="";
		if(isset($auth_req->reuse)) $auth_req_reuse=$auth_req->reuse;
		else $auth_req_reuse="";
		if(isset($auth_req->recycle)) $auth_req_recycle=$auth_req->recycle;
		else $auth_req_recycle="";
		if(isset($auth_req->rec)) $auth_req_rec=$auth_req->rec;
		else $auth_req_rec="";
		if(isset($auth_req->pre)) $auth_req_pre=$auth_req->pre;
		else $auth_req_pre="";
		if(isset($auth_req->co)) $auth_req_co=$auth_req->co;
		else $auth_req_co="";
		if(isset($auth_req->uti)) $auth_req_uti=$auth_req->uti;
		else $auth_req_uti="";
		if(isset($auth_req->treat)) $auth_req_treat=$auth_req->treat;
		else $auth_req_treat="";
		if(isset($auth_req->disp)) $auth_req_disp=$auth_req->disp;
		else $auth_req_disp="";
		if(isset($auth_req->inci)) $auth_req_inci=$auth_req->inci;
		else $auth_req_inci="";
	}else{
		$auth_req_gen="";$auth_req_col="";$auth_req_str="";$auth_req_transport="";$auth_req_recept="";$auth_req_reuse="";$auth_req_recycle="";$auth_req_rec="";$auth_req_pre="";$auth_req_co="";$auth_req_uti="";$auth_req_treat="";$auth_req_disp="";$auth_req_inci="";
	}	
	if(!empty($results["ren_auth"])){
		$ren_auth=json_decode($results["ren_auth"]);
		$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
	}else{
		$ren_auth_no="";$ren_auth_dt="";
	}		
	if(!empty($results["ind_work"])){
		$ind_work=json_decode($results["ind_work"]);
		if(isset($ind_work->one)) $ind_work_one=$ind_work->one;
		else $ind_work_one="";
		if(isset($ind_work->two)) $ind_work_two=$ind_work->two;
		else $ind_work_two="";
		if(isset($ind_work->clock)) $ind_work_clock=$ind_work->clock;
		else $ind_work_clock="";				
	}else{
		$ind_work_one="";$ind_work_two="";$ind_work_clock="";
	}
	##### PART II ######
	$is_generator=$results['is_generator'];$env_details=$results['env_details'];
	if(!empty($results["mode_of_manage"])){
		$mode_of_manage=json_decode($results["mode_of_manage"]);
		$mode_of_manage_cap=$mode_of_manage->cap;$mode_of_manage_plant=$mode_of_manage->plant;$mode_of_manage_waste=$mode_of_manage->waste;$mode_of_manage_arrange=$mode_of_manage->arrange;
	}else{
		$mode_of_manage_cap="";$mode_of_manage_plant="";$mode_of_manage_waste="";$mode_of_manage_arrange="";
	}			
	##### PART III ######
	$is_operator=$results['is_operator'];$incineration=$results['incineration'];$leachate=$results['leachate'];$fire_system=$results['fire_system'];$trans_arrangement=$results['trans_arrangement'];$facility_detail=$results['facility_detail'];		
	##### PART IV ######
	$is_recycler=$results['is_recycler'];$storage_detail=$results['storage_detail'];$process_desc=$results['process_desc'];$pcs_detail=$results['pcs_detail'];$health_details=$results['health_details'];$pcb_guidelines=$results['pcb_guidelines'];$trans_arrange=$results['trans_arrange'];
	
	if(!empty($results["ins_capacity"])){
		$ins_capacity=json_decode($results["ins_capacity"]);
		$ins_capacity_qty=$ins_capacity->qty;$ins_capacity_unit=$ins_capacity->unit;
	}else{
		$ins_capacity_qty="";$ins_capacity_unit="";
	}
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
  <?php include ("".$table_name."_addmore.php"); ?>
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
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
								<li class="<?php echo $tabbtn4; ?>"><a href="#table4">PART IV</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									     <td colspan="4"><h4 class="text-center" ><strong>Part A: General (To be filled by all)</strong></h4></td>
									</tr>
									<tr>
									    <td colspan="4">1. (a) Name and address of the unit and location of facility :</td>	
									</tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
										<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
										<td>Pincode:</td>
										<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>Phone No:</td>
										<td><input type="text" disabled value="<?php echo $b_landline_std.'-'.$b_landline_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Email Id:</td>
										<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Name of the occupier of the facility or operator of disposal facility with designation,Tel and e-mail:</td>	
									</tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" name="occupier_add[name]" value="<?php echo $occupier_add_name; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Designation:</td>
									     <td width="25%"><input type="text" name="occupier_add[desig]" value="<?php echo $occupier_add_desig; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="occupier_add[mob_no]" value="<?php echo $occupier_add_mob_no; ?>" class="form-control text-uppercase" validate="mobileNumber" maxlength="10"></td>
										<td>Email Id:</td>
										<td><input type="email" name="occupier_add[email]" value="<?php echo $occupier_add_email; ?>" class="form-control"></td>
									</tr>									
									<tr>
									     <td colspan="4">(c) Authorisation required for (Please tick mark appropriate activity or activities)<font color="red">*</font>:</td>							     
									</tr>
									<tr>								
										<td><input type="checkbox" name="auth_req[gen]" value="Generation" <?php if(isset($auth_req_gen) && $auth_req_gen=='Generation') echo 'checked'; ?>>Generation </td>
										<td><input type="checkbox" name="auth_req[col]" value="Collection" <?php if(isset($auth_req_col) && $auth_req_col=='Collection') echo 'checked'; ?>> Collection </td>
										<td><input type="checkbox" name="auth_req[str]" value="Storage" <?php if(isset($auth_req_str) && $auth_req_str=='Storage') echo 'checked'; ?>> Storage</td>
										<td><input type="checkbox" name="auth_req[transport]" value="Transportation" <?php if(isset($auth_req_transport) && $auth_req_transport=='Transportation') echo 'checked'; ?>> Transportation </td>									
									</tr>
									<tr>								
										<td><input type="checkbox" name="auth_req[recept]" value="Reception" <?php if(isset($auth_req_recept) && $auth_req_recept=='Reception') echo 'checked'; ?>> Reception </td>
										<td><input type="checkbox" name="auth_req[reuse]" value="Reuse" <?php if(isset($auth_req_reuse) && $auth_req_reuse=='Reuse') echo 'checked'; ?>>Reuse </td>
										<td><input type="checkbox" name="auth_req[recycle]" value="Recycling" <?php if(isset($auth_req_recycle) && $auth_req_recycle=='Recycling') echo 'checked'; ?>> Recycling</td>
										<td><input type="checkbox"name="auth_req[rec]" value="Recovery" <?php if(isset($auth_req_rec) && $auth_req_rec=='Recovery') echo 'checked'; ?>> Recovery </td>									
									</tr>
									<tr>								
										<td><input type="checkbox" name="auth_req[pre]" value="Pre-processing" <?php if(isset($auth_req_pre) && $auth_req_pre=='Pre-processing') echo 'checked'; ?>> Pre-processing </td>
										<td><input type="checkbox" name="auth_req[co]" value="Co-processing" <?php if(isset($auth_req_co) && $auth_req_co=='Co-processing') echo 'checked'; ?>>Co-processing </td>
										<td><input type="checkbox" name="auth_req[uti]" value="Utilisation" <?php if(isset($auth_req_uti) && $auth_req_uti=='Utilisation') echo 'checked'; ?>> Utilisation</td>
										<td><input type="checkbox"name="auth_req[treat]" value="Treatment" <?php if(isset($auth_req_treat) && $auth_req_treat=='Treatment') echo 'checked'; ?>> Treatment</td>									
									</tr>
									<tr>								
										<td><input type="checkbox" name="auth_req[disp]" value="Disposal" <?php if(isset($auth_req_disp) && $auth_req_disp=='Disposal') echo 'checked'; ?>> Disposal </td>
										<td><input type="checkbox" name="auth_req[inci]" value="Incineration" <?php if(isset($auth_req_inci) && $auth_req_inci=='Incineration') echo 'checked'; ?>>Incineration </td>
										<td></td>
										<td></td>									
									</tr>
									<tr>
										<td colspan="4">(d) In case of renewal of authorisation previous authorisation numbers and dates and provide copies of annual returns of last three years including the compliance reports with respect to the conditions of Prior Environmental Clearance, wherever applicable: <b>(Upload Later in Upload Section )</b></td>
									</tr>
									<tr>
										<td>Authorization No:</td>
										<td><input type="text" name="ren_auth[no]" placeholder="AUTHORIZATION NO" value="<?php echo $ren_auth_no; ?>" class="form-control text-uppercase"></td>
										<td>Authorization Date:</td>
										<td><input type="datetime"  name="ren_auth[dt]" value="<?php echo $ren_auth_dt; ?>" readonly="readonly" class="dob form-control" placeholder="DD/MM/YYYY"></td>
												
									</tr>
									<tr>
										<td colspan="4">2.(a) Nature and quantity of waste handled per annum (in metric tonne or kilo litre):</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable1" class=" table table-responsive table-bordered text-center "id="objectTable1" >
											<thead>
											<tr>
												<th>Sl No</th>
												<th>Particulars</th>
												<th>Nature</th>
												<th>Quantity</th>
												<th>Units</th>	
											</tr>
											</thead>
											<?php
											$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
											$num = $part1->num_rows;
											if($num>0){
											$count=1;
											while($row_1=$part1->fetch_array()){	?>
											<tr>
												<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
												<td><input  id="txtB<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_1["particular"]; ?>" name="txtB<?php echo $count;?>" size="20"></td>
												<td><input value="<?php echo $row_1["nature"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txtC<?php echo $count;?>" class="form-control text-uppercase"; name="txtC<?php echo $count;?>"></td>			
												<td><input value="<?php echo $row_1["qty"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase"; name="txtD<?php echo $count;?>"></td>
												<td>
												<select  id="txtE<?php echo $count;?>" name="txtE<?php echo $count;?>" class="form-control text-uppercase">
													<option value='' >Select unit</option>
													<option <?php if($row_1["unit"]=="MT") echo "selected"; ?> value='MT' >in metric tonnes / month</option>
													<option <?php if($row_1["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
												</select></td>
											</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input  readonly value="1" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
												<td><input  id="txtB1" size="20" class="form-control text-uppercase"; name="txtB1"></td>
												<td><input id="txtC1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="txtC1"></td>					
												<td><input id="txtD1" class="form-control text-uppercase"; name="txtD1"></td>
												<td>														
												<select  id="txtE1" name="txtE1" class="form-control text-uppercase">
													<option value='' >Select unit</option>
													<option value='MT' >in metric tonnes / month</option>
													<option value='K' >in kl / month</option>
													</select>
												</td>
											</tr>
											<?php } ?>
										</table>	
										<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
										<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>									
									</tr>
									<tr>
										<td colspan="4">(b) Nature and quantity of waste stored at any time (in metric tonne or kilo litre):</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable2" class=" table table-responsive table-bordered text-center " id="objectTable2" >
											<thead>
											<tr>
												<th>SL No</th>
												<th>Particulars</th>
												<th>Nature</th>
												<th>Quantity</th>
												<th>Units</th>	
											</tr>
											</thead>
											<?php
											$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
											$num2 = $part2->num_rows;
											if($num2>0){
											$count=1;
											while($row_1=$part2->fetch_array()){	?>
											<tr>
												<td><input readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_1["sl_no"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
												<td><input  id="txttB<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_1["particulars"]; ?>" name="txttB<?php echo $count;?>" size="20"></td>
												<td><input value="<?php echo $row_1["nature"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txttC<?php echo $count;?>" class="form-control text-uppercase"; name="txttC<?php echo $count;?>"></td>				
												<td><input value="<?php echo $row_1["qty"]; ?>" id="txttD<?php echo $count;?>" class="form-control text-uppercase"; name="txttD<?php echo $count;?>"></td>
												<td>
												<select  id="txttE<?php echo $count;?>" name="txttE<?php echo $count;?>" class="form-control text-uppercase">
													<option value='' >Select unit</option>
													<option <?php if($row_1["unit"]=="MT") echo "selected"; ?> value='MT' >in metric tonnes / month</option>
													<option <?php if($row_1["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
													
												</select></td>
											</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input  readonly value="1" id="txttA1" size="1" class="form-control text-uppercase"; name="txttA1"></td>
												<td><input  id="txttB1" size="20" class="form-control text-uppercase"; name="txttB1"></td>
												<td><input id="txttC1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="txttC1"></td>					
												<td><input id="txttD1" class="form-control text-uppercase"; name="txttD1"></td>
												<td>														
												<select  id="txttE1" name="txttE1" class="form-control text-uppercase">
													<option value='' >Select unit</option>
													<option value='MT' >in metric tonnes / month</option>
													<option value='K' >in kl / month</option>
												</select>
												</td>
											</tr>
											<?php } ?>
										</table>	
										<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
										<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
										<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>									
									</tr>
									<tr>
										<td>3. (a) Year of commissioning and commencement of production:</td>
										<td><input type="number" id="Year" name="year_of_comm" min="1970" class="form-control text-uppercase" value="<?php echo $year_of_comm?>"></td>
										<td>(b) Whether the industry works:</td>
										<td>
											<input type="checkbox" name="ind_work[one]" value="01 shift" <?php if(isset($ind_work_one) && $ind_work_one=='01 shift') echo 'checked'; ?>> 01 Shift <br/>
											<input type="checkbox" name="ind_work[two]" value="02 Shifts" <?php if(isset($ind_work_two) && $ind_work_two=='02 Shifts') echo 'checked'; ?>> 02 Shifts <br/>
											<input type="checkbox" name="ind_work[clock]" value="Round the clock" <?php if(isset($ind_work_clock) && $ind_work_clock=='Round the clock') echo 'checked'; ?>> Round the clock<br/>
										</td> 			
									</tr>									
									<tr>
										<td>4. Provide copy of the Emergency Response Plan (ERP)</td>
										<td><button class="btn btn-md btn-primary" title="" data-toggle="popover" data-placement="right" type="button"  data-original-title="Emergency Response Plan (ERP)" data-content="Emergency Response Plan (ERP) which should address procedures for dealing with emergency situations (viz. Spillage or release or fire) as specified in the guidelines of Central Pollution Control Board. Such ERP shall comprise the following, but not limited to:<br/>
										<ul>
											<li>Containing and controlling incidents so as to minimise the effects and to limit danger to the persons, environment and property.</li>
											<li>Implementing the measures necessary to protect persons and the environment</li>
											<li>Description of the actions which should be taken to control the conditions at events and to limit their consequences, including a description of the safety equipment and resources available</li>
											<li>Arrangements for training staff in the duties which they are expected to perform</li>
											<li>Arrangements for informing concerned authorities and emergency services</li>
											<li>Arrangements for providing assistance with off-site mitigatory action.</li>
										</ul>" >Know More</button></td>
										<td>Upload later in Upload Section</td>
										<td></td>										
									</tr>
									<tr>
										<td colspan="2">5. Provide undertaking or declaration to comply with all provisions including the scope of submitting bank guarantee in the event of spillage, leakage or fire while handling the hazardous and other waste.</td>
										<td colspan="2">Upload later in Upload Section</td>										
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>										
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											 <td colspan="4"><p><h4 class="text-center" ><strong>Part B: To be filled by hazardous waste generators </strong></h4></p></td>
										</tr>
										<tr>
											<td colspan="2">Are You a Generator of Hazardous Waste?</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" name="is_generator" value="Y"  <?php if(isset($is_generator) && $is_generator=='Y') echo 'checked'; ?> required="required" /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_generator"  value="N"  <?php if(isset($is_generator) && $is_generator=='N') echo 'checked'; ?>/> No</label></td>
										</tr>
									</table>
									<table id="is_generator_yes" class="table table-responsive">
										<tr>
											<td colspan="4">1. (a) Products and by-products manufactured (names and product wise quantity per annum): </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable3" class=" table table-responsive table-bordered text-center "id="objectTable3" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Name</th>
													<th>Type</th>
													<th>Quantity</th>
													<th>Units</th>	
												</tr>
												</thead>
												<?php
												$part3=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t3 where form_id='$form_id'");
												$num3 = $part3->num_rows;
												if($num3>0){
												$count=1;
												while($row_3=$part3->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="txxtA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_3["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_3["name"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txxtB<?php echo $count;?>" class="form-control text-uppercase"; name="txxtB<?php echo $count;?>"></td>
													<td>
													<select id="txxtC<?php echo $count;?>" name="txxtC<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option <?php if($row_3["product_type"]=="P") echo "selected"; ?> value='P' >Product</option>
														<option <?php if($row_3["product_type"]=="B") echo "selected"; ?> value='B' >By-product</option>
													</select>
													</td>				
													<td><input value="<?php echo $row_3["qty"]; ?>" id="txxtD<?php echo $count;?>" class="form-control text-uppercase"; name="txxtD<?php echo $count;?>"></td>
													<td>
													<select id="txxtE<?php echo $count;?>" name="txxtE<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option <?php if($row_3["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
														<option <?php if($row_3["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
														<option <?php if($row_3["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="txxtA1" size="1" class="form-control text-uppercase"; name="txxtA1"></td>
													<td><input id="txxtB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="txxtB1"></td>					
													<td><select id="txxtC1" name="txxtC1" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option value='P' >Product</option>
														<option value='B' >By-product</option>
													</select></td>
													<td><input id="txxtD1" class="form-control text-uppercase"; name="txxtD1" ></td>
													<td>														
													<select  id="txxtE1" name="txxtE1" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option value='T' >in tonnes / month</option>
														<option value='K' >in kl / month</option>
														<option value='N' >in numbers / month</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction3()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
											</td>									
										</tr>
										<tr>
											<td colspan="3">(b) Process description including process flow sheet indicating inputs and outputs (raw materials, chemicals, products, by-products, wastes, emissions, waste water etc.) </td>
											<td>Upload later in upload section</td>
										</tr>									
										<tr>
											<td colspan="4">(c) Characteristics (waste-wise) and Quantity of waste generation per annum</td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable4" class=" table table-responsive table-bordered text-center "id="objectTable4" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Particulars of Waste</th>
													<th>Characteristics</th>
													<th>Quantity</th>
													<th>Units</th>	
												</tr>
												</thead>
												<?php
												$part4=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t4 where form_id='$form_id'");
												$num4 = $part4->num_rows;
												if($num4>0){
												$count=1;
												while($row_4=$part4->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_4["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_4["particulars"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="textB<?php echo $count;?>" class="form-control text-uppercase"; name="textB<?php echo $count;?>"></td>
													<td>
													<input value="<?php echo $row_4["characteristics"]; ?>" id="textC<?php echo $count;?>" name="textC<?php echo $count;?>" class="form-control text-uppercase">
													</td>					
													<td><input value="<?php echo $row_4["qty"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase"; name="textD<?php echo $count;?>" ></td>
													<td>
													<select  id="textE<?php echo $count;?>" name="textE<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option <?php if($row_4["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
														<option <?php if($row_4["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
														<option <?php if($row_4["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase"; name="textA1"></td>
													<td><input id="textB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="textB1"></td>					
													<td><input id="textC1" name="textC1" class="form-control text-uppercase"></td>
													<td><input id="textD1" class="form-control text-uppercase" name="textD1" ></td>
													<td>														
													<select id="textE1" name="textE1" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option value='T' >in tonnes / month</option>
														<option value='K' >in kl / month</option>
														<option value='N' >in numbers / month</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction4()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
											</td>									
										</tr>
										<tr>
											<td colspan="4">(d) Mode of management of (c) above: </td>
										</tr>
										<tr>
											<td width="25%">i. Capacity and mode of secured storage within the plant:</td>
											<td width="25%"><textarea name="mode_of_manage[cap]"  class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $mode_of_manage_cap; ?></textarea>255 Characters Only</td>
											<td width="25%">ii. Utilisation within the plant (provide details):</td>
											<td width="25%"><textarea type="text" name="mode_of_manage[plant]" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $mode_of_manage_plant; ?></textarea>255 Characters Only</td>
										</tr>									
										<tr>
										   <td>iii. If not utilised within the plant, please provide details of what is done with this waste: </td>
										   <td><textarea name="mode_of_manage[waste]" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $mode_of_manage_waste; ?></textarea>255 Characters Only</td>
										   <td>iv. Arrangement for transportation to actual users/ TSDF: </td>
										   <td><textarea name="mode_of_manage[arrange]" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $mode_of_manage_arrange; ?></textarea>255 Characters Only</td>									   
										</tr>
										<tr>
											<td>(e) Details of the environmental safeguards and environmental facilities provided for safe handling of all the wastes at point (c) above:</td>
											<td><textarea name="env_details" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $env_details; ?></textarea >255 characters Only</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">2. Hazardous and other wastes generated as per these rules from storage of hazardous chemicals as defined under the Manufacture, Storage and Import of Hazardous Chemicals Rules, 1989 </td>					
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable5" class=" table table-responsive table-bordered text-center "id="objectTable5" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Particulars</th>
													<th>Nature</th>
													<th>Quantity</th>
													<th>Units</th>	
												</tr>
												</thead>
												<?php
												$part5=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t5 where form_id='$form_id'");
												$num5 = $part5->num_rows;
												if($num5>0){
												$count=1;
												while($row_5=$part5->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="text1A<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_5["slno"]; ?>" name="text1A<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_5["particulars"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="text1B<?php echo $count;?>" class="form-control text-uppercase"; name="text1B<?php echo $count;?>"></td>
													<td>
													<select id="text1C<?php echo $count;?>" name="text1C<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option <?php if($row_5["nature_type"]=="HW") echo "selected"; ?> value='HW' >Hazardous Waste</option>
														<option <?php if($row_5["nature_type"]=="OW") echo "selected"; ?> value='OW' >Other Waste</option>
													</select>
													</td>				
													<td><input value="<?php echo $row_5["qty"]; ?>" id="text1D<?php echo $count;?>" class="form-control text-uppercase"; name="text1D<?php echo $count;?>" ></td>
													<td>
													<select  id="text1E<?php echo $count;?>" name="text1E<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option <?php if($row_5["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
														<option <?php if($row_5["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
														<option <?php if($row_5["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="text1A1" size="1" class="form-control text-uppercase"; name="text1A1"></td>
													<td><input id="text1B1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="text1B1"></td>					
													<td><select  id="text1C1" name="text1C1" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option value='HW' >Hazardous Waste</option>
														<option value='OW' >Other Waste</option>
													</select></td>
													<td><input id="text1D1" class="form-control text-uppercase" name="text1D1" ></td>
													<td>														
													<select id="text1E1" name="text1E1" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option value='T' >in tonnes / month</option>
														<option value='K' >in kl / month</option>
														<option value='N' >in numbers / month</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction5()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
											</td>									
										</tr>
									</table>
									<table id="" class="table table-responsive">	
										<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>							
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>										
										</tr>
									</table>
									</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											 <td colspan="4"><p><h4 class="text-center" ><strong>Part C: To be filled by Treatment, storage and disposal facility operators</strong></h4></p></td>
										</tr>
										<tr>
											<td colspan="2">Are you a Treatment, storage and disposal facility operators?</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" name="is_operator" value="Y"  <?php if(isset($is_operator) && $is_operator=='Y') echo 'checked'; ?> required="required" /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_operator"  value="N"  <?php if(isset($is_operator) && $is_operator=='N') echo 'checked'; ?>/> No</label>
											</td>
										</tr>
									</table>
									<table id="is_operator_yes" class="table table-responsive">
										<tr>
											<td colspan="4">1. Provide details of the facility including: </td>					
										</tr>									
										<tr>
											<td width="25%">(i). Location of site with layout map: </td>
											<td width="30%">Upload later in upload section</td>
											</tr>
										<tr>
											<td colspan="4">(ii). Safe storage of the waste and storage capacity:</td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable6" class=" table table-responsive table-bordered text-center "id="objectTable6" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Particulars </th>
													<th>Capacity</th>
													<th>Units</th>	
												</tr>
												</thead>
												<?php
												$part6=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t6 where form_id='$form_id'");
												$num6 = $part6->num_rows;
												if($num6>0){
												$count=1;
												while($row_6=$part6->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_6["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_6["particulars"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="textB<?php echo $count;?>" class="form-control text-uppercase"; name="textB<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_6["capacity"]; ?>" id="textC<?php echo $count;?>" name="textC<?php echo $count;?>" class="form-control text-uppercase" ></td>					
													<td>
													<select  id="textD<?php echo $count;?>" name="textD<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option <?php if($row_6["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
														<option <?php if($row_6["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
														<option <?php if($row_6["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase"; name="textA1"></td>
													<td><input id="textB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="textB1"></td>					
													<td><input id="textC1" name="textC1" class="form-control text-uppercase"></td>
													<td>														
													<select  id="textD1" name="textD1" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option value='T' >in tonnes / month</option>
														<option value='K' >in kl / month</option>
														<option value='N' >in numbers / month</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction6()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction6()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/></div>
											</td>									
										</tr>
										<tr>
											<td>(iii) The treatment processes and their capacities: </td>
											<td width="30%">Upload later in upload section</td></tr>
										<tr>
											<td>(iv) Secured landfills:  </td>
											<td width="30%">Upload later in upload section</td></tr>
										<tr>
											<td>(v). Incineration , if any:</td>
											<td><textarea name="incineration" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $incineration; ?></textarea >255 Characters Only</td>
											<td>(vi) Leachate collection and treatment system:</td>
											<td><textarea name="leachate" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $leachate; ?></textarea >255 Characters Only</td></tr>
										<tr>
											<td>(vii) Fire fighting systems: </td>
											<td><textarea name="fire_system" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $fire_system; ?></textarea >255 Characters Only</td>
											<td></td>
											<td></td>																			
										</tr>
										<tr>
											<td>(viii) Environmental management plan including monitoring: </td>
											<td width="30%">Upload later in upload section</td>							
										</tr>									
										<tr>
											<td>(ix) Arrangement for transportation of waste from generators: </td>
											<td><textarea name="trans_arrangement" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $trans_arrangement; ?></textarea >255 Characters Only</td>
											<td></td>
											<td></td>											
										</tr>									
										<tr>
											<td>2. Provide details of any other activities undertaken at the Treatment, storage and disposal facility site: </td>
											<td><textarea name="facility_detail" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $facility_detail; ?></textarea >255 Characters Only</td>
											<td>Upload later in upload section(Optional) </td>	
											<td></td>
										</tr>
										<tr>
											<td>3. Attach a copy of prior Environmental Clearance:</td>
											<td width="30%">Upload later in upload section(Optional) </td>	
										</tr>
									</table>
									<table id="" class="table table-responsive">	
										<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>							
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>										
										</tr>
									</table>
									</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											 <td colspan="4"><p><h4 class="text-center" ><strong>Part D: To be filled by recyclers or pre-processors or co-processors or users of hazardous or other wastes </strong></h4></p></td>
										</tr>
										<tr>
											<td colspan="2">Are you a recyclers or pre-processors or co-processors or users of hazardous or other wastes?</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" name="is_recycler" value="Y"  <?php if(isset($is_recycler) && $is_recycler=='Y') echo 'checked'; ?> required="required" /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_recycler"  value="N"  <?php if(isset($is_recycler) && $is_recycler=='N') echo 'checked'; ?>/> No</label>
											</td>
										</tr>
									</table>
									<table id="is_recycler_yes" class="table table-responsive">
										<tr>
											<td colspan="4">1. Nature and quantity of different wastes received per annum from domestic sources or imported or both: </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable7" class=" table table-responsive table-bordered text-center" id="objectTable7" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Particulars</th>
													<th>Nature</th>
													<th>Quantity</th>
													<th>Units</th>
													<th>Source</th>
												</tr>
												</thead>
												<?php
												$part7=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t7 where form_id='$form_id'");
												$num7 = $part7->num_rows;
												if($num7>0){
												$count=1;
												while($row_7=$part7->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_7["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_7["particulars"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="textB<?php echo $count;?>" class="form-control text-uppercase"; name="textB<?php echo $count;?>"></td>
													<td>
													<input value="<?php echo $row_7["nature"]; ?>" id="textC<?php echo $count;?>" name="textC<?php echo $count;?>" class="form-control text-uppercase"></td>				
													<td><input value="<?php echo $row_7["qty"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase"; name="textD<?php echo $count;?>" ></td>	
													<td><input value="<?php echo $row_7["unit"]; ?>" id="textE<?php echo $count;?>" class="form-control text-uppercase"; name="textE<?php echo $count;?>" ></td>
													<td>
													<select  id="textF<?php echo $count;?>" name="textF<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select source</option>
														<option <?php if($row_7["source"]=="D") echo "selected"; ?> value='D' >Domestic</option>
														<option <?php if($row_7["source"]=="I") echo "selected"; ?> value='I' >Imported</option>
														<option <?php if($row_7["source"]=="B") echo "selected"; ?> value='B' >Both</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase"; name="textA1"></td>
													<td><input id="textB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="textB1"></td>					
													<td><input id="textC1" name="textC1" class="form-control text-uppercase"></td>
													<td><input id="textD1" class="form-control text-uppercase" name="textD1" ></td>
													<td><input id="textE1" class="form-control text-uppercase" name="textE1"></td>
													<td>														
													<select  id="textF1" name="textF1" class="form-control text-uppercase">
														<option value='' >Select source</option>
														<option value='T' >Domestic</option>
														<option value='K' >Imported</option>
														<option value='N' >Both</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction7()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction7()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval7" name="hiddenval7" value="<?php echo $hiddenval7; ?>"/></div>
											</td>										
										</tr>
										<tr>
											<td colspan="4">2. Installed capacity as per registration issued by the District Industries Centre or any other authorised Government agency. Provide copy: </td>
										</tr>
										<tr>
											<td width="25%">Quantity </td>
											<td width="25%"><input type="text" name="ins_capacity[qty]" value="<?php echo $ins_capacity_qty; ?>" class="form-control text-uppercase" validate="onlyNumbers"></td>	
											<td width="25%">Unit</td>
											<td width="25%"><input type="text" name="ins_capacity[unit]" value="<?php echo $ins_capacity_unit; ?>" class="form-control text-uppercase" ></td>	
										</tr>
										<tr>
											<td>Upload later in upload section</td>											
										</tr>
										<tr>
											<td colspan="2">3. Provide details of secured storage of wastes including the storage capacity:</td>
											<td><textarea name="storage_detail" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $storage_detail; ?></textarea>255 Characters Only</td>
											<td>Upload later in upload section</td>
											
										</tr>
										
										<tr>
											<td colspan="2">4. Process description including process flow sheet indicating equipment details, inputs and outputs (input wastes, chemicals, products, by-products, waste generated, emissions, waste water, etc.):</td>
											<td><textarea name="process_desc" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $process_desc; ?></textarea>255 Characters Only</td>
											<td>Upload later in upload section</td>
										</tr>
										
										<tr>
											<td colspan="4">5. Provide details of end users of products or by-products:</td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable8" class=" table table-responsive table-bordered text-center "id="objectTable8" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Name</th>
													<th>Type</th>
													<th>Quantity</th>
													<th>Units</th>	
												</tr>
												</thead>
												<?php
												$part8=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t8 where form_id='$form_id'");
												$num8 = $part8->num_rows;
												if($num8>0){
												$count=1;
												while($row_8=$part8->fetch_array()){	?>
												<tr>
													<td><input readonly="readonly" id="txxtA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_8["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_8["name"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txxtB<?php echo $count;?>" class="form-control text-uppercase"; name="txxtB<?php echo $count;?>"></td>
													<td>
													<select  id="txxtC<?php echo $count;?>" name="txxtC<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option <?php if($row_8["product_type"]=="P") echo "selected"; ?> value='P' >Product</option>
														<option <?php if($row_8["product_type"]=="B") echo "selected"; ?> value='B' >By-product</option>
													</select>
													</td>				
													<td><input value="<?php echo $row_8["qty"]; ?>" id="txxtD<?php echo $count;?>" class="form-control text-uppercase"; name="txxtD<?php echo $count;?>" ></td>
													<td>
													<select  id="txxtE<?php echo $count;?>" name="txxtE<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option <?php if($row_8["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
														<option <?php if($row_8["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
														<option <?php if($row_8["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
													</select></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly="readonly" id="txxtA1" size="1" class="form-control text-uppercase"; name="txxtA1"></td>
													<td><input id="txxtB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="txxtB1"></td>					
													<td><select  id="txxtC1" name="txxtC1" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option value='P' >Product</option>
														<option value='B' >By-product</option>
													</select></td>
													<td><input id="txxtD1" class="form-control text-uppercase"; name="txxtD1" ></td>
													<td>														
													<select  id="txxtE1" name="txxtE1" class="form-control text-uppercase">
														<option value='' >Select unit</option>
														<option value='T' >in tonnes / month</option>
														<option value='K' >in kl / month</option>
														<option value='N' >in numbers / month</option>
													</select>
													</td>
												</tr>
												<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction8()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction8()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval8" name="hiddenval8" value="<?php echo $hiddenval8; ?>"/></div>
											</td>									
										</tr>
										<tr>
											<td colspan="2">6. Provide details of pollution control systems such as Effluent Treatment Plant, scrubbers, etc. including mode of disposal of waste:</td>
											<td><textarea name="pcs_detail" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $pcs_detail; ?></textarea> 255 Characters Only</td>
											<td>Upload later in upload section</td>
											
										</tr>
										
										<tr>
										   <td colspan="2">7. Provide details of occupational health and safety measures: </td>
										   <td><textarea name="health_details" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $health_details; ?></textarea>255 Characters Only</td>
										   <td>Upload later in upload section</td>
										</tr>
										
										<tr>
											<td>8.(a) Has the facility been set up as per Central Pollution Control Board guidelines?</td>
											<td><label class="radio-inline"><input type="radio" value="Y" <?php if($pcb_guidelines != 'N' && $pcb_guidelines != '') echo 'checked'; ?> id="inlineRadio1" name="pcb_guidelines"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($pcb_guidelines == 'N' || $pcb_guidelines == '') echo 'checked'; ?> id="inlineRadio1" name="pcb_guidelines"> No </label></td>
											<td>(b) If yes, provide a report on the compliance with the guidelines:</td>
											<td>Upload later in upload section</td>
										</tr>
										
										<tr>
											<td colspan="2">9. Arrangements for transportation of waste to the facility:</td>
											<td><textarea name="trans_arrange" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $trans_arrange; ?></textarea>255 Characters Only</td>
											<td>Upload later in upload section</td>
											
										</tr>
										
									</table>
									<table id="" class="table table-responsive">
										<tr>
											<td class="text-center" colspan="4">
												<a href="<?php echo $table_name; ?>.php?tab=3" type="button" class="btn btn-primary">Go Back & Edit</a>							
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>d" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	<?php if($pcb_guidelines == 'N' || $pcb_guidelines == '') echo "$('#prov_report_id').hide();"; ?>
	$('input[name="pcb_guidelines"]').on('change', function(){
		if($(this).val() == 'N')
			$('#prov_report_id').hide();
		else
			$('#prov_report_id').show();
	});
	/* ----------------------------------------------------- */
	$('#is_generator_yes').css('display','table');	 
	<?php if($is_generator == 'N' || $is_generator == '') echo "$('#is_generator_yes').css('display','none');"; ?>
	
	$('input[name="is_generator"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_generator_yes').css('display','table');			
		}else{
			$('#is_generator_yes').css('display','none');			
		}
	});
	$('#is_operator_yes').css('display','table');	 
	<?php if($is_operator == 'N' || $is_operator == '') echo "$('#is_operator_yes').css('display','none');"; ?>
	
	$('input[name="is_operator"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_operator_yes').css('display','table');			
		}else{
			$('#is_operator_yes').css('display','none');			
		}
	});
	$('#is_recycler_yes').css('display','table');	 
	<?php if($is_recycler == 'N' || $is_recycler == '') echo "$('#is_recycler_yes').css('display','none');"; ?>
	
	$('input[name="is_recycler"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_recycler_yes').css('display','table');			
		}else{
			$('#is_recycler_yes').css('display','none');			
		}
	});
	/* ------------------------------------------------------ */
	$(document).ready(function(){
    $('[data-toggle="popover"]').popover({html:true});   
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('#Year').on('click', function(){
		var i, d = new Date();
		d.getFullYear();
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-15; i<d.getFullYear()+15; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>