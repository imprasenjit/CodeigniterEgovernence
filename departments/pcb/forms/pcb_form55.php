<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="55";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_plastic_form.php";

		
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results["form_id"];$manuf_capacity=$results["manuf_capacity"];$is_reg_dcssi=$results["is_reg_dcssi"];$water_valid_consent=$results["water_valid_consent"];$air_valid_consent=$results["air_valid_consent"];$is_compliance=$results["is_compliance"];$plastic_wastes=$results["plastic_wastes"];
		if(!empty($results["reg_manufacture"])){
			$reg_manufacture=json_decode($results["reg_manufacture"]);
			if(isset($reg_manufacture->a)) $reg_manufacture_a=$reg_manufacture->a;
			if(isset($reg_manufacture->b)) $reg_manufacture_b=$reg_manufacture->b;
			if(isset($reg_manufacture->c)) $reg_manufacture_c=$reg_manufacture->c;
		}else{
			$reg_manufacture_a="";$reg_manufacture_b="";$reg_manufacture_c="";
		}	
		if(!empty($results["old_reg_details"])){
			$old_reg_details=json_decode($results["old_reg_details"]);
			$old_reg_details_no=$old_reg_details->no;$old_reg_details_dt=$old_reg_details->dt;
		}else{
			$old_reg_details_no="";$old_reg_details_dt="";
		}
		if(!empty($results["proj_invested"])){
			$proj_invested=json_decode($results["proj_invested"]);
			$proj_invested_cap=$proj_invested->cap;$proj_invested_year=$proj_invested->year;
		}else{
			$proj_invested_cap="";$proj_invested_year="";
		}				
		if(!empty($results["solid_waste"])){
			$solid_waste=json_decode($results["solid_waste"]);
			$solid_waste_a=$solid_waste->a;$solid_waste_b=$solid_waste->b;$solid_waste_c=$solid_waste->c;
		}else{
			$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";
		}		
		/////////Brand owners///////////
		$is_reg_dis=$results["is_reg_dis"];$tot_capital_b=$results["tot_capital_b"];$year_comm_b=$results["year_comm_b"];$water_valid_radio=$results["water_valid_radio"];$air_valid_radio=$results["air_valid_radio"];$plastic_wastes1=$results["plastic_wastes1"];
		if(!empty($results["old_reg_details1"])){
			$old_reg_details1=json_decode($results["old_reg_details1"]);
			$old_reg_details1_no=$old_reg_details1->no;$old_reg_details1_dt=$old_reg_details1->dt;
		}else{
			$old_reg_details1_no="";$old_reg_details1_dt="";
		}	
		if(!empty($results["solid_wasteb"])){
			$solid_wasteb=json_decode($results["solid_wasteb"]);
			$solid_wasteb_a=$solid_wasteb->a;$solid_wasteb_b=$solid_wasteb->b;$solid_wasteb_c=$solid_wasteb->c;
		}else{
			$solid_wasteb_a="";$solid_wasteb_b="";$solid_wasteb_c="";
		}
	}else{		
		$form_id="";
		/////////Procedures///////////
		$manuf_capacity="";$is_reg_dcssi="";$water_valid_consent="";$air_valid_consent="";$is_compliance="";
		$reg_manufacture_a="";$reg_manufacture_b="";$reg_manufacture_c="";
		$old_reg_details_no="";$old_reg_details_dt="";
		$proj_invested_cap="";$proj_invested_year="";
		$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";$plastic_wastes="";
		/////////Brand owners///////////
		$is_reg_dis="";$tot_capital_b="";$year_comm_b="";$water_valid_radio="";$air_valid_radio="";
		$old_reg_details1_no="";$old_reg_details1_dt="";
		$solid_wasteb_a="";$solid_wasteb_b="";$solid_wasteb_c="";$plastic_wastes1="";
	}
}else{
	/////////Procedures///////////
	$results=$q->fetch_assoc();
	$form_id=$results["form_id"];$manuf_capacity=$results["manuf_capacity"];$is_reg_dcssi=$results["is_reg_dcssi"];$water_valid_consent=$results["water_valid_consent"];$air_valid_consent=$results["air_valid_consent"];$is_compliance=$results["is_compliance"];$plastic_wastes=$results["plastic_wastes"];
	if(!empty($results["reg_manufacture"])){
		$reg_manufacture=json_decode($results["reg_manufacture"]);
		if(isset($reg_manufacture->a)) $reg_manufacture_a=$reg_manufacture->a;
		if(isset($reg_manufacture->b)) $reg_manufacture_b=$reg_manufacture->b;
		if(isset($reg_manufacture->c)) $reg_manufacture_c=$reg_manufacture->c;
	}else{
		$reg_manufacture_a="";$reg_manufacture_b="";$reg_manufacture_c="";
	}	
	if(!empty($results["old_reg_details"])){
		$old_reg_details=json_decode($results["old_reg_details"]);
		$old_reg_details_no=$old_reg_details->no;$old_reg_details_dt=$old_reg_details->dt;
	}else{
		$old_reg_details_no="";$old_reg_details_dt="";
	}
	if(!empty($results["proj_invested"])){
		$proj_invested=json_decode($results["proj_invested"]);
		$proj_invested_cap=$proj_invested->cap;$proj_invested_year=$proj_invested->year;
	}else{
		$proj_invested_cap="";$proj_invested_year="";
	}				
	if(!empty($results["solid_waste"])){
		$solid_waste=json_decode($results["solid_waste"]);
		$solid_waste_a=$solid_waste->a;$solid_waste_b=$solid_waste->b;$solid_waste_c=$solid_waste->c;
	}else{
		$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";
	}	
	/////////Brand owners///////////
	$is_reg_dis=$results["is_reg_dis"];$tot_capital_b=$results["tot_capital_b"];$year_comm_b=$results["year_comm_b"];$water_valid_radio=$results["water_valid_radio"];$air_valid_radio=$results["air_valid_radio"];$plastic_wastes1=$results["plastic_wastes1"];
	if(!empty($results["old_reg_details1"])){
		$old_reg_details1=json_decode($results["old_reg_details1"]);
		$old_reg_details1_no=$old_reg_details1->no;$old_reg_details1_dt=$old_reg_details1->dt;
	}else{
		$old_reg_details1_no="";$old_reg_details1_dt="";
	}	
	if(!empty($results["solid_wasteb"])){
		$solid_wasteb=json_decode($results["solid_wasteb"]);
		$solid_wasteb_a=$solid_wasteb->a;$solid_wasteb_b=$solid_wasteb->b;$solid_wasteb_c=$solid_wasteb->c;
	}else{
		$solid_wasteb_a="";$solid_wasteb_b="";$solid_wasteb_c="";
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
							    
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
							   <li class="<?php echo $tabbtn1; ?>"><a href="#table1">Producer</a></li>
							   <li class="<?php echo $tabbtn2; ?>"><a href="#table2">Brand Owners</a></li>					    
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive "> 
								    <tr>
										<td colspan="4" align="center"><b>1. Producers :<br/> PART - A<br/>GENERAL</b></td>
									</tr>
									<tr>
										<td colspan="4">1.Name and location of the unit</td>
								    </tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Location :</td>
									     <td width="25%"><input type="text" value="<?php echo $b_dist; ?>" disabled="disabled" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Address of the unit :</td>
									</tr>
									<tr>
									    <td>Street Name 1 :</td>
									    <td><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
									    <td>Street Name 2 :</td>
										<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" disabled value="<?php echo $b_vill; ?>" class="form-control text-uppercase"></td>
									    <td>District :</td>
										<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pincode :</td>
										<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
									    <td>Mobile No :</td>
										<td><input type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Phone No :</td>
										<td><input type="text" disabled value="<?php echo $b_landline_std.-$b_landline_no; ?>" class="form-control text-uppercase"></td>
									    <td>Email Id :</td>
										<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
									</tr>
									<tr>
									   <td >(c) Registration required for manufacturing of :</td>
									   <td><input type="checkbox"  name="reg_manufacture[a]" value="Carry bag petro- based" <?php if(isset($reg_manufacture_a) && $reg_manufacture_a=='Carry bag petro- based') echo 'checked'; ?> />(i) Carry bag petro - based</td>
							           <td><input type="checkbox" name="reg_manufacture[b]" value="Carry bag Compostable" <?php if(isset($reg_manufacture_b) && $reg_manufacture_b=='Carry bag Compostable') echo 'checked'; ?> />(ii) Carry bag Compostable</td>
							           <td><input type="checkbox" name="reg_manufacture[c]" value="Multilayered plastics" <?php if(isset($reg_manufacture_c) && $reg_manufacture_c=='Multilayered plastics') echo 'checked'; ?> />(iii) Multilayered plastics </td>
									</tr>									
									<tr>
									     <td>(d)Manufacturing capacity :</td>
									     <td><input type="text" name="manuf_capacity" value="<?php echo $manuf_capacity; ?>" class="form-control text-uppercase"></td>
									     <td></td>
									     <td></td>
									</tr>
									<tr>
									    <td colspan="4">(e)In case of renewal of Registration previous Registration number and date</td>
									</tr>
									<tr>
										<td>Registration Number :</td>
									    <td><input type="text" class="form-control text-uppercase" name="old_reg_details[no]" placeholder="Reg. No." value="<?php echo $old_reg_details_no; ?>" /></td>
										<td>Date :</td>
										<td><input type="text" class="dob form-control" name="old_reg_details[dt]"  placeholder="Date" value="<?php echo $old_reg_details_dt; ?>" readonly="readonly" /></td>
									</tr>
									<tr>
						                <td colspan="3">2.Is the unit registered with the District Industries Centre of the StateGovernment or Union Territory? If yes, attach a copy in upload section.<span class="mandatory_field">*</span></td>
						                <td><input type="radio" name="is_reg_dcssi" value="Y" <?php if(isset($is_reg_dcssi) && $is_reg_dcssi=='Y') echo 'checked'; ?> required="required" />&nbsp;Yes &nbsp;&nbsp;&nbsp; <input type="radio" name="is_reg_dcssi" value="N" <?php if(isset($is_reg_dcssi) && $is_reg_dcssi=='N') echo 'checked'; ?> required="required"/>&nbsp;No</td>
									</tr>									
						           <tr>
						                <td valign="top">3.(a) Total capital invested on the project</td>
						                <td><input type="text" class="form-control text-uppercase" name="proj_invested[cap]" value="<?php echo $proj_invested_cap; ?>" /></td>
						                <td>(b) Year of commencement of production</td>
						                <td><input type="number" class="form-control text-uppercase" name="proj_invested[year]"  min="1960" max="2020" value="<?php echo $proj_invested_year; ?>" /></td>
					              </tr>			
									<tr>
						              <td colspan="4">4.(a) List and quantum of products and byproducts.
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
										<tbody>
											<tr>
											   <td align="center" width="10%">Sl No.</td>
											   <td align="center" width="50%">Name</td>
											   <td align="center">Type</td>
											   <td align="center">Quantum</td>
											</tr>
											<?php
											$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
											$num1 = $part1->num_rows;
											if($num1>0){
											  $count=1;
											  while($row_1=$part1->fetch_array()){	?>
												<tr>
													<td><input readonly  id="txtaA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtaA<?php echo $count;?>" size="1"></td>
													<td><input id="txtaB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" name="txtaB<?php echo $count;?>" size="10"></td>
													<td><select required="required" id="txtaC<?php echo $count;?>" name="txtaC<?php echo $count;?>" class="form-control text-uppercase">
														<option value='' >Select Type</option> 
														<option <?php if($row_1["type"]=="Product") echo "selected"; ?> value='Product' >Product</option>
														<option <?php if($row_1["type"]=="Byproduct") echo "selected"; ?> value='Byproduct' >By-product</option>
													</select></td>
													<td><input value="<?php echo $row_1["quantum"]; ?>" id="txtaD<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txtaD<?php echo $count;?>"></td>
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input  value="1" id="txtaA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtaA1"></td>
												<td><input id="txtaB1" size="10" class="form-control text-uppercase" name="txtaB1"></td>
												<td><select required="required" name="txtaC1" id="txtaC1" class="form-control text-uppercase">
														<option value='' >Select Type</option>
														<option value='Product' >Product</option>
														<option value='Byproduct' >By-product</option>
													</select></td>
												<td><input id="txtaD1" size="10" class="form-control text-uppercase" name="txtaD1"></td>
											</tr>
											<?php } ?>
										</tbody>
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
					  			       <td colspan="4">(b) List and quantum of raw materials used
										<table name="objectTable2" id="objectTable2" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
											   <td align="center">Raw Materials</td>
											   <td align="center">Quantum</td>
											</tr>
										   <?php
											$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
											$num = $part2->num_rows;
											if($num>0){
											  $count=1;
											  while($row_2=$part2->fetch_array()){	?>
											<tr>
												<td><input readonly  id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_2["raw"]; ?>" id="textB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_2["quantum"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>	
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
											<td><input id="textB1" size="20"   class="form-control text-uppercase" name="textB1"></td>					
											<td><input  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore2()" value="">Add More</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
										</td>
									</tr>
									<tr>
											<td colspan="2">5.Furnish a flow diagram of manufacturing process showing input and output in terms of products and waste generated including for captive power generation and water.</td>
											<td>Upload later in upload section</td>
									</tr>
																	
									<tr>
									   <td colspan="3">6. Status of compliance with these rules- Thickness – fifty micron:<span class="mandatory_field">*</span></td>
									   <td><input type="radio" name="is_compliance" value="Y" <?php if(isset($is_compliance) && $is_compliance=='Y') echo 'checked'; ?> required="required"/>&nbsp;Yes &nbsp;&nbsp;&nbsp; <input type="radio" name="is_compliance" value="N" <?php if(isset($is_compliance) && $is_compliance=='N') echo 'checked'; ?> required="required"/>&nbsp;No</td>
									</tr>
									<tr>
										<td colspan="4" align="center"><b>PART - B<br/>PERTAINING TO LIQUID EFFLUENT AND GASEOUS EMISSIONS</b></td>
									</tr>
									<tr>
										<td colspan="3">7.(a) Does the unit have a valid consent under the Water (Prevention and control of Pollution) Act, 1974 (6 of 1974)?
                                    <span class="mandatory_field">*</span></br>If yes, attach a copy in upload section</td>
										<td><input type="radio" name="water_valid_consent" value="Y" <?php if(isset($water_valid_consent) && $water_valid_consent=='Y') echo 'checked'; ?> required="required" >&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="water_valid_consent" value="N" <?php if(isset($water_valid_consent) && $water_valid_consent=='N') echo 'checked'; ?> required="required">&nbsp;No</td>
									</tr>									
									<tr>
			     						<td colspan="3"> (b) Does the unit have a valid consent under the Air (Prevention and Control of Pollution) Act, 1981 (14 of 1981)? <span class="mandatory_field">*</span></br>If yes, attach a copy in upload section</td>	
			     				    	<td><input type="radio" name="air_valid_consent" value="Y" <?php if(isset($air_valid_consent) && $air_valid_consent=='Y') echo 'checked'; ?> required="required">&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="air_valid_consent" value="N" <?php if(isset($air_valid_consent) && $air_valid_consent=='N') echo 'checked'; ?> required="required">&nbsp;No</td>
									</tr>									
									<tr>
										<td colspan="4" align="center"><b>PART - C<br/>PERTAINTING TO WASTE</b></td> 
									</tr>
									<tr>
										<td colspan="4">8. Solid Wastes :</td>
									</tr>
									<tr>
										<td>(a) Total quantum of waste generated :</td>
										<td><input type="text" class="form-control text-uppercase" name="solid_waste[a]" id="textfield19" placeholder="Quantum" value="<?php echo $solid_waste_a; ?>" /></td>
										<td>(b) Mode of storage within the plant :</td>
										<td><input type="text" class="form-control text-uppercase" name="solid_waste[b]" id="textfield20" placeholder="Mode of storage" value="<?php echo $solid_waste_b; ?>" /></td>
									</tr>
					              <tr>
					                   <td>(c) Provision made for disposal of wastes :</td>	
							            <td><input type="text" class="form-control text-uppercase" name="solid_waste[c]"  placeholder="Provision for disposal" value="<?php echo $solid_waste_c; ?>" /></td>
							            <td></td>
							            <td></td>
						           </tr>
								   
								   <tr>
					  			       <td colspan="4">9. List of person supplying plastic to be used as raw material to manufacture carry bags or plastic sheet of like or multilayered packaging
										<table name="objectTable5" id="objectTable5" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
											   <td align="center">Name</td>
											   <td align="center">Address Details</td>
											</tr>
										   <?php
											$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
											$num5 = $part5->num_rows;
											if($num5>0){
											  $count=1;
											  while($row_5=$part5->fetch_array()){	?>
											<tr>
												<td><input readonly  id="tbA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="tbA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_5["name12"]; ?>" id="tbB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="tbB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_5["address12"]; ?>" id="tbC<?php echo $count;?>" class="form-control text-uppercase" name="tbC<?php echo $count;?>" size="20"></td>	
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="tbA1" size="1" class="form-control text-uppercase" name="tbA1"></td>
											<td><input id="tbB1" size="20"   class="form-control text-uppercase" name="tbB1"></td>					
											<td><input  id="tbC1" size="20" class="form-control text-uppercase"  name="tbC1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction5()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore5()" value="">Add More</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/>
										</td>
									</tr>
								   <tr>
					  			       <td colspan="4">10.List of personnel or Brand Owners to whom the products will be supplied
										<table name="objectTable6" id="objectTable6" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
											   <td align="center">Name</td>
											   <td align="center">Address Details</td>
											</tr>
										   <?php
											$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
											$num6 = $part6->num_rows;
											if($num6>0){
											  $count=1;
											  while($row_6=$part6->fetch_array()){	?>
											<tr>
												<td><input readonly  id="txxxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["slno"]; ?>" name="txxxtA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_6["name1"]; ?>" id="txxxtB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="txxxtB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_6["address1"]; ?>" id="txxxtC<?php echo $count;?>" class="form-control text-uppercase" name="txxxtC<?php echo $count;?>" size="20"></td>	
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="txxxtA1" size="1" class="form-control text-uppercase" name="txxxtA1"></td>
											<td><input id="txxxtB1" size="20"   class="form-control text-uppercase" name="txxxtB1"></td>					
											<td><input  id="txxxtC1" size="20" class="form-control text-uppercase"  name="txxxtC1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction6()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore6()" value="">Add More</button>
											<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/>
										</td>
									</tr>
									<tr>
									   <td colspan="2">11.Action plan on collecting back the plastic wastes:</td>
									   <td><input class="form-control text-uppercase" name="plastic_wastes"  value="<?php echo $plastic_wastes; ?>" /></td>
									</tr>
									<tr>
				                       <td align="left">Place : <b><?php echo strtoupper($dist); ?></b><br/>
				                       Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
				                       <td></td>
				                       <td></td>
				                       <td align="right">
				                        Signature: <label><?php  echo strtoupper($key_person) ?></label><br/>
                                      Designation:<label><?php echo strtoupper($status_applicant) ?></label></td>
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
								<table class="table table-responsive"> 
								<tr>
									<td colspan="4" align="center"><b>II Brand Owners: <br/>PART - A<br/>GENERAL</b></td>
								</tr>
								<tr>
									<td colspan="4">1.Name, Address and Contact number </td>
								</tr>
								<tr>
									 <td width="25%">Name :</td>
									 <td width="25%"><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
									 <td width="25%">Street Name 1 :</td>
									 <td width="25%"><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Street Name 2 :</td>
									<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
									<td>Village/Town :</td>
									<td><input type="text" disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>District :</td>
									<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
									<td>Pincode :</td>
									<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>Mobile No :</td>
									<td><input type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control text-uppercase"></td>
									<td>Phone No :</td>
									<td><input type="text" disabled value="<?php echo $b_landline_std.-$b_landline_no; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Email Id :</td>
									<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">2. In case of renewal, previous registration number and date of registration :</td>
								</tr>
								<tr>
									<td>Previous Registration Number :</td>
									<td><input type="text" class="form-control text-uppercase" name="old_reg_details1[no]" placeholder="Reg. No." value="<?php echo $old_reg_details1_no; ?>" />
									<td>Date :</td>
									<td><input type="text" class="dob form-control" readonly="readonly" name="old_reg_details1[dt]"  placeholder="Date" value="<?php echo $old_reg_details1_dt; ?>" /></td>
								</tr>
								<tr>
									<td colspan="3">3. Is the unit registered with the District Industries Centre of the State Government or Union Territory? <span class="mandatory_field">*</span></td>
									<td><input type="radio" name="is_reg_dis" value="Y" <?php if(isset($is_reg_dis) && $is_reg_dis=='Y') echo 'checked'; ?> required="required"/>&nbsp;Yes &nbsp;&nbsp;&nbsp; <input type="radio" name="is_reg_dis" value="N" <?php if(isset($is_reg_dis) && $is_reg_dis=='N') echo 'checked'; ?> required="required"/>&nbsp;No</td>
								</tr>								
								<tr>
									 <td>4.(a)Total capital invested on the project</td>
									 <td><input type="text"  class="form-control text-uppercase" name="tot_capital_b" value="<?php echo $tot_capital_b;?>" validate="onlyNumbers"></td>
									 <td> (b) Year of commencement of production</td>
									 <td><input type="text"  class="form-control text-uppercase"  min="1960" max="2020" name="year_comm_b" validate="onlyNumbers" value="<?php echo $year_comm_b;?>"></td>
								</tr>
								 <tr>
						             <td colspan="4">5.(a) List and quantum of products and byproducts.
										<table name="objectTable3" id="objectTable3" class="table table-responsive">
										<tbody>
											<tr>
											   <td align="center" width="10%">Sl No.</td>
											   <td align="center" width="50%">Name</td>
											   <td align="center">Type</td>
											   <td align="center">Quantum</td>
											</tr>
											<?php
									$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
									$num3 = $part3->num_rows;
									if($num3>0){
									  $count=1;
									  while($row_3=$part3->fetch_array()){	?>
										<tr>
											<td><input readonly  id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
											<td><input id="txttB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["name"]; ?>" name="txttB<?php echo $count;?>" size="10"></td>
											<td><select required="required" id="txttC<?php echo $count;?>" name="txttC<?php echo $count;?>" class="form-control text-uppercase">
												<option value='' >Select Type</option> 
												<option <?php if($row_3["type"]=="Product") echo "selected"; ?> value='Product' >Product</option>
												<option <?php if($row_3["type"]=="Byproduct") echo "selected"; ?> value='Byproduct' >By-product</option>
											</select></td>
											<td><input value="<?php echo $row_3["quantum"]; ?>" id="txttD<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txttD<?php echo $count;?>"></td>
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input  value="1" id="txttA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txttA1"></td>
										<td><input id="txttB1" size="10" class="form-control text-uppercase" name="txttB1"></td>
										<td><select  name="txttC1" id="txttC1" class="form-control text-uppercase">
												<option value='' >Select Type</option>
												<option value='Product' >Product</option>
												<option value='Byproduct' >By-product</option>
											</select></td>
										<td><input id="txttD1" size="10" class="form-control text-uppercase" name="txttD1"></td>
									</tr>
									<?php } ?>
									</tbody>
									</table>										
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction3()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore3()" value="">Add More</button>
										<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/>
									</td>
								</tr>	
								<tr>
					  			    <td colspan="4">(b) List and quantum of raw materials used
									<table name="objectTable4" id="objectTable4" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Raw Materials</td>
										   <td align="center">Quantum</td>
										</tr>
									   <?php
										$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
										$num4 = $part4->num_rows;
										if($num4>0){
										  $count=1;
										  while($row_4=$part4->fetch_array()){	?>
										<tr>
											<td><input readonly  id="texttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4[ "slno"]; ?>" name="texttA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_4["raw"]; ?>" id="texttB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="texttB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_4["quantum"]; ?>" id="texttC<?php echo $count;?>" class="form-control text-uppercase" name="texttC<?php echo $count;?>" size="20"></td>	
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="texttA1" size="1" class="form-control text-uppercase" name="texttA1"></td>
										<td><input id="texttB1" size="20"   class="form-control text-uppercase" name="texttB1"></td>					
										<td><input  id="texttC1" size="20" class="form-control text-uppercase"  name="texttC1"></td>
									</tr>
									<?php } ?>
									</tbody>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction4()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore4()" value="">Add More</button>
										<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/>
									</td>
								</tr> 	
								<tr>
									<td colspan="4" align="center"><b>PART - B<br/>PERTAINING TO LIQUID EFFLUENT AND GASEOUS EMISSIONS</b></td>
								</tr>
								<tr>
									<td colspan="3">5. Does the unit have a valid consent under the Water (Prevention and control of Pollution) Act, 1974 (6 of 1974)? <span class="mandatory_field">*</span> </br>If yes, attach a copy in upload section.</td>
									<td><input type="radio" name="water_valid_radio" value="Y" <?php if(isset($water_valid_radio) && $water_valid_radio=='Y') echo 'checked'; ?> required="required">&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="water_valid_radio" value="N" <?php if(isset($water_valid_radio) && $water_valid_radio=='N') echo 'checked'; ?> required="required">&nbsp;No</td>	
								</tr>
								<tr>
									<td colspan="3">6. Does the unit have a valid consent under the Air (Prevention and Control of Pollution) Act, 1981 (14 of 1981)? <span class="mandatory_field">*</span></br>If yes, attach a copy in upload section.</td>	
									<td><input type="radio" name="air_valid_radio" value="Y" <?php if(isset($air_valid_radio) && $air_valid_radio=='Y') echo 'checked'; ?>  required="required">&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="air_valid_radio" value="N" <?php if(isset($air_valid_radio) && $air_valid_radio=='N') echo 'checked'; ?> required="required">&nbsp;No</td>
								</tr>
								<tr>
									<td colspan="4" align="center"><b>PART - C<br/>PERTAINTING TO WASTE</b></td> 
								</tr>
								<tr>
									<td colspan="4">7. Solid Wastes or rejects : </td>
								</tr>
								<tr>
									<td>(a) Total quantum of generation :</td>
									<td><input type="text" class="form-control text-uppercase" name="solid_wasteb[a]" id="textfield19" placeholder="Quantum" value="<?php echo $solid_wasteb_a; ?>" /></td>
									<td>(b) MMode of storage within the plant :</td>
									<td><input type="text" class="form-control text-uppercase" name="solid_wasteb[b]" id="textfield20" placeholder="Mode of storage" value="<?php echo $solid_wasteb_b; ?>" /></td>
								</tr>
								<tr>
									<td>(c) Provision made for disposal of wastes :</td>	
									<td><input type="text" class="form-control text-uppercase" name="solid_wasteb[c]"  placeholder="Provision for disposal" value="<?php echo $solid_wasteb_c; ?>" /></td>
								</tr>
								<tr>
					  			    <td colspan="4">8.List of person supplying plastic material
									<table name="objectTable7" id="objectTable7" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Name</td>
										   <td align="center">Address</td>
										</tr>
									   <?php
										$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
										$num7 = $part7->num_rows;
										if($num7>0){
										  $count=1;
										  while($row_7=$part7->fetch_array()){	?>
										<tr>
											<td><input readonly  id="tattA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7[ "slno"]; ?>" name="tattA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_7["name2"]; ?>" id="tattB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="tattB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_7["address2"]; ?>" id="tattC<?php echo $count;?>" class="form-control text-uppercase" name="tattC<?php echo $count;?>" size="20"></td>	
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="tattA1" size="1" class="form-control text-uppercase" name="tattA1"></td>
										<td><input id="tattB1" size="20"   class="form-control text-uppercase" name="tattB1"></td>					
										<td><input  id="tattC1" size="20" class="form-control text-uppercase"  name="tattC1"></td>
									</tr>
									<?php } ?>
									</tbody>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction7()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore7()" value="">Add More</button>
										<input type="hidden" id="hiddenval7" name="hiddenval7" value="<?php echo $hiddenval7; ?>"/>
									</td>
								</tr>
								<tr>
								   <td colspan="2">9.Action plan on collecting back the plastic wastes :</td>
								   <td><input class="form-control text-uppercase" name="plastic_wastes1"  value="<?php echo $plastic_wastes1; ?>" /></td>
								</tr>
								<tr>
								   <td align="left">Place : <b><?php echo strtoupper($dist); ?></b><br/>
								   Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
								   <td></td>
								   <td></td>
								   <td align="right">
									Signature: <label><?php  echo strtoupper($key_person) ?></label><br/>
									Designation: <label><?php echo strtoupper($status_applicant) ?></label></td>
							   </tr>
								<tr>									
									<td class="text-center" colspan="5">
										<a href="<?php echo $table_name; ?>.php?tab=1" class="btn btn-primary">Go Back &amp; Edit </a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	$('#is_reg_dis_upload').show();
	<?php if($is_reg_dis=="N" || $is_reg_dis==" "){ ?>
		$('#is_reg_dis_upload').attr('disabled', 'disabled');
		$('#is_reg_dis_upload').hide();
	<?php }?>
	$('input[name="is_reg_dis"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_reg_dis_upload').removeAttr('disabled', 'disabled');			
			$('#is_reg_dis_upload').show();			
		}else{
			$('#is_reg_dis_upload').attr('disabled', 'disabled');	
			$('#is_reg_dis_upload').hide();			
		}
	});
	/* ------------------------------------------------------ */
	$('#water_valid_upload').show();
	<?php if($water_valid_radio=="N" || $water_valid_radio==" "){ ?>
		$('#water_valid_upload').attr('disabled', 'disabled');
		$('#water_valid_upload').hide();
	<?php }?>
	$('input[name="water_valid_radio"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#water_valid_upload').removeAttr('disabled', 'disabled');			
			$('#water_valid_upload').show();			
		}else{
			$('#water_valid_upload').attr('disabled', 'disabled');	
			$('#water_valid_upload').hide();			
		}
	});
	/* ------------------------------------------------------ */
	$('#air_valid_upload').hide();
	<?php if($air_valid_radio=="N" || $air_valid_radio==" "){ ?>
		$('#air_valid_upload').attr('disabled', 'disabled');
		$('#air_valid_upload').hide();
	<?php }?>
	$('input[name="air_valid_radio"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#air_valid_upload').removeAttr('disabled', 'disabled');			
			$('#air_valid_upload').show();			
		}else{
			$('#air_valid_upload').attr('disabled', 'disabled');	
			$('#air_valid_upload').hide();			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ----------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>