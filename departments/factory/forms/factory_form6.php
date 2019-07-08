<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="6";

$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
 
include "save_form.php";
	
	$occupier_name=$key_person;$occupier_sn1=$street_name1;$occupier_sn2=$street_name2;$occupier_vill=$vill;$occupier_dist=$dist;$occupier_pin=$pincode;
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	  if($p->num_rows>0){
		$results=$p->fetch_assoc();	
        $form_id=$results['form_id'];
		$year_ending=$results['year_ending'];$reg_no=$results['reg_no'];$district=$results['district'];
		$sub_division=$results['sub_division'];$industry_nature=$results['industry_nature'];$is_factory=$results['is_factory'];
		
		if(!empty($results["name"])){
			$name=json_decode($results["name"]);
			$name_occupier=$name->occupier;$name_manager=$name->manager;
		}else{
			$name_occupier="";$name_manager="";
		}
		if(!empty($results["hours1"])){
			$hours1=json_decode($results["hours1"]);
			$hours1_men=$hours1->men;$hours1_women=$hours1->women;$hours1_children=$hours1->children;$hours1_men1=$hours1->men1;$hours1_women1=$hours1->women1;$hours1_children1=$hours1->children1;$hours1_men2=$hours1->men2;$hours1_women2=$hours1->women2;$hours1_children2=$hours1->children2;
		}else{
			$hours1_men="";$hours1_women="";$hours1_children="";$hours1_men1="";$hours1_women1="";$hours1_children1="";;$hours1_men2="";$hours1_women2="";$hours1_children2="";
		}
		
		if(!empty($results["day"])){
			$day=json_decode($results["day"]);
			$day_total=$day->total;$day_men=$day->men;$day_women=$day->women;$day_children=$day->children;
		}else{
			$day_total="";$day_men="";$day_women="";$day_children="";
		}
		
		if(!empty($results["adult"])){
			$adult=json_decode($results["adult"]);
			$adult_men=$adult->men;$adult_women=$adult->women;
		}else{
			$adult_men="";$adult_women="";
		}
		
		if(!empty($results["adole"])){
			$adole=json_decode($results["adole"]);
			$adole_male=$adole->male;$adole_female=$adole->female;
		}else{
			$adole_male="";$adole_female="";
		}
		
		if(!empty($results["children"])){
			$children=json_decode($results["children"]);
			$children_boys=$children->boys;$children_girls=$children->girls;
		}else{
			$children_boys="";$children_girls="";
		}
		
		
		//TAB2//
		
		$number_workers=$results['number_workers'];	$is_ambulance=$results['is_ambulance'];
		$is_provided=$results['is_provided'];$departmental=$results['departmental'];$contractor=$results['contractor'];$is_adequate=$results['is_adequate'];$is_creche=$results['is_creche'];$number_acci=$results['number_acci'];$mondays_lost=$results['mondays_lost'];$is_suggestion=$results['is_suggestion'];$num_suggestion=$results['num_suggestion'];$case_prize=$results['case_prize'];
		
		if(!empty($results["hours"])){
			$hours=json_decode($results["hours"]);
			$hours_men2=$hours->men2;$hours_women2=$hours->women2;$hours_children2=$hours->children2;$hours_men3=$hours->men3;$hours_women3=$hours->women3;$hours_children3=$hours->children3;
		}else{
			$hours_men2="";$hours_women2="";$hours_children2="";$hours_men3="";$hours_women3="";$hours_children3="";
		}
		if(!empty($results["number"])){
			$number=json_decode($results["number"]);
			$number_wages=$number->wages;$number_officers=$number->officers;$number_safety=$number->safety;
		}else{
			$number_wages="";$number_officers="";$number_safety="";
		}
		
		if(!empty($results["welfare"])){
			$welfare=json_decode($results["welfare"]);
			$welfare_required=$welfare->required;$welfare_appointed=$welfare->appointed;
		}else{
			$welfare_required="";$welfare_appointed="";
		}
		
		if(!empty($results["accidents"])){
			$accidents=json_decode($results["accidents"]);
			$accidents_fatal=$accidents->fatal;$accidents_nonfatal=$accidents->nonfatal;
		}else{
			$accidents_fatal="";$accidents_nonfatal="";
		}
		
		if(!empty($results["previous"])){
			$previous=json_decode($results["previous"]);
			$previous_acci=$previous->acci;$previous_lost=$previous->lost;
		}else{
			$previous_acci="";$previous_lost="";
		}
		if(!empty($results["thisyr"])){
			$thisyr=json_decode($results["thisyr"]);
			$thisyr_acci=$thisyr->acci;$thisyr_lost=$thisyr->lost;
		}else{
			$thisyr_acci="";$thisyr_lost="";
		}
		
		if(!empty($results["awarded"])){
			$awarded=json_decode($results["awarded"]);
			$awarded_amt=$awarded->amt;$awarded_maxcash=$awarded->maxcash;$awarded_mincash=$awarded->mincash;
		}else{
			$awarded_amt="";$awarded_maxcash="";$awarded_mincash="";
		}
		
	}else{
		$form_id="";
		$year_ending="";$reg_no="";$district="";$sub_division="";$is_factory="";$industry_nature="";$name_occupier="";$name_manager="";$day_total="";$day_men="";$day_women="";$day_children="";$adult_men="";$adult_women="";$adole_male="";$adole_female="";$children_boys="";$children_girls="";$hours1_men="";$hours1_women="";$hours1_children="";$hours1_men1="";$hours1_women1="";$hours1_children1="";;$hours1_men2="";$hours1_women2="";$hours1_children2="";
		//TAB 2//
		$number_workers="";$is_ambulance="";$is_provided="";$departmental="";$contractor="";$is_adequate="";$is_creche="";
		$number_acci="";$mondays_lost="";$is_suggestion="";$num_suggestion="";$case_prize="";$hours_men2="";$hours_women2="";$hours_children2="";$hours_men3="";$hours_women3="";$hours_children3="";$number_wages="";$number_officers="";$number_safety="";$welfare_required="";$welfare_appointed="";$accidents_fatal="";$accidents_nonfatal="";$previous_acci="";$previous_lost="";$this_acci="";$this_lost="";$awarded_amt="";$awarded_maxcash="";$awarded_mincash="";$thisyr_acci="";$thisyr_lost="";
        }
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$year_ending=$results['year_ending'];$reg_no=$results['reg_no'];$district=$results['district'];
		$sub_division=$results['sub_division'];	$industry_nature=$results['industry_nature'];$is_factory=$results['is_factory'];
		
		if(!empty($results["name"])){
			$name=json_decode($results["name"]);
			$name_occupier=$name->occupier;$name_manager=$name->manager;
		}else{
			$name_occupier="";$name_manager="";
		}
		if(!empty($results["hours1"])){
			$hours1=json_decode($results["hours1"]);
			$hours1_men=$hours1->men;$hours1_women=$hours1->women;$hours1_children=$hours1->children;$hours1_men1=$hours1->men1;$hours1_women1=$hours1->women1;$hours1_children1=$hours1->children1;$hours1_men2=$hours1->men2;$hours1_women2=$hours1->women2;$hours1_children2=$hours1->children2;
		}else{
			$hours1_men="";$hours1_women="";$hours1_children="";$hours1_men1="";$hours1_women1="";$hours1_children1="";;$hours1_men2="";$hours1_women2="";$hours1_children2="";
		}
		
		if(!empty($results["day"])){
			$day=json_decode($results["day"]);
			$day_total=$day->total;$day_men=$day->men;$day_women=$day->women;$day_children=$day->children;
		}else{
			$day_total="";$day_men="";$day_women="";$day_children="";
		}
		
		if(!empty($results["adult"])){
			$adult=json_decode($results["adult"]);
			$adult_men=$adult->men;$adult_women=$adult->women;
		}else{
			$adult_men="";$adult_women="";
		}
		
		if(!empty($results["adole"])){
			$adole=json_decode($results["adole"]);
			$adole_male=$adole->male;$adole_female=$adole->female;
		}else{
			$adole_male="";$adole_female="";
		}
		
		if(!empty($results["children"])){
			$children=json_decode($results["children"]);
			$children_boys=$children->boys;$children_girls=$children->girls;
		}else{
			$children_boys="";$children_girls="";
		}
		
		
		//TAB//
		
		$number_workers=$results['number_workers'];	$is_ambulance=$results['is_ambulance'];
		$is_provided=$results['is_provided'];$departmental=$results['departmental'];$contractor=$results['contractor'];$is_adequate=$results['is_adequate'];$is_creche=$results['is_creche'];$number_acci=$results['number_acci'];$mondays_lost=$results['mondays_lost'];$is_suggestion=$results['is_suggestion'];$num_suggestion=$results['num_suggestion'];$case_prize=$results['case_prize'];
		
		if(!empty($results["hours"])){
			$hours=json_decode($results["hours"]);
			$hours_men2=$hours->men2;$hours_women2=$hours->women2;$hours_children2=$hours->children2;$hours_men3=$hours->men3;$hours_women3=$hours->women3;$hours_children3=$hours->children3;
		}else{
			$hours_men2="";$hours_women2="";$hours_children2="";$hours_men3="";$hours_women3="";$hours_children3="";
		}
		if(!empty($results["number"])){
			$number=json_decode($results["number"]);
			$number_wages=$number->wages;$number_officers=$number->officers;$number_safety=$number->safety;
		}else{
			$number_wages="";$number_officers="";$number_safety="";
		}
		
		if(!empty($results["welfare"])){
			$welfare=json_decode($results["welfare"]);
			$welfare_required=$welfare->required;$welfare_appointed=$welfare->appointed;
		}else{
			$welfare_required="";$welfare_appointed="";
		}
		
		if(!empty($results["accidents"])){
			$accidents=json_decode($results["accidents"]);
			$accidents_fatal=$accidents->fatal;$accidents_nonfatal=$accidents->nonfatal;
		}else{
			$accidents_fatal="";$accidents_nonfatal="";
		}
		
		if(!empty($results["previous"])){
			$previous=json_decode($results["previous"]);
			$previous_acci=$previous->acci;$previous_lost=$previous->lost;
		}else{
			$previous_acci="";$previous_lost="";
		}
		if(!empty($results["thisyr"])){
			$thisyr=json_decode($results["thisyr"]);
			$thisyr_acci=$thisyr->acci;$thisyr_lost=$thisyr->lost;
		}else{
			$thisyr_acci="";$thisyr_lost="";
		}
		
		if(!empty($results["awarded"])){
			$awarded=json_decode($results["awarded"]);
			$awarded_amt=$awarded->amt;$awarded_maxcash=$awarded->maxcash;$awarded_mincash=$awarded->mincash;
		}else{
			$awarded_amt="";$awarded_maxcash="";$awarded_mincash="";
		}
				
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
	}
	##PHP TAB management ends
	if(isset($_GET["application_type"])) $application_type=$_GET["application_type"]; else $application_type="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li  class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								  
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform2" class="myform1 submit1" id="myform2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="tab1" class="table table-responsive">
									<tr>
										<td width="25%">For the year ending 31st December :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="year_ending" value="<?php echo  $year_ending; ?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>							
									</tr>
									<tr>
										<td>1. Registration Number of Factory :</td>
										<td><input type="text" class="form-control text-uppercase" name="reg_no" value="<?php echo $reg_no; ?>"></td>	
										<td>2. Name of Factory :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $unit_name; ?>"></td>	
									</tr>
									<tr>
										<td>3. Name of the Occupier :</td>
										<td><input type="text" class="form-control text-uppercase" name="name[occupier]" value="<?php echo $name_occupier; ?>"></td>
										<td>4. Name of the Manager :</td>
										<td><input type="text" class="form-control text-uppercase" name="name[manager]" value="<?php echo $name_manager; ?>"></td>
									</tr>
									<tr>
										<td>5. District :</td>
										<td><input type="text" class="form-control text-uppercase" name="district" value="<?php echo $district; ?>"></td>
										<td>6. Sub-Division :</td>
										<td><input type="text" class="form-control text-uppercase" name="sub_division" value="<?php echo $sub_division; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">7. Full postal address of factory :</td>
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
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>8. Nature of Industry :</td>
										<td><input type="text" class="form-control text-uppercase" name="industry_nature" value="<?php echo $industry_nature; ?>"></td>
									</tr>
									<tr>
									   <td colspan="4">Number of workers and particulars of employment :</td>
									</tr>
									<tr>
										<td>9. Number of days worked in the year :</td>
										<td><input type="text" class="form-control text-uppercase" name="day[total]" value="<?php echo $day_total; ?>"></td>
									</tr>
									<tr>
									   <td colspan="4">10. Number of mandays worked in the year :</td>
									</tr>
									<tr>
										<td>( a ) Men </td>
										<td><input type="text" class="form-control text-uppercase" name="day[men]" value="<?php echo $day_men; ?>"></td>
										<td>( b ) Women </td>
										<td><input type="text" class="form-control text-uppercase" name="day[women]" value="<?php echo $day_women; ?>"></td>
									</tr>
									<tr>
										<td>( c ) Children </td>
										<td><input type="text" class="form-control text-uppercase" name="day[children]" value="<?php echo $day_children; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									   <td colspan="4">11.Average number of workers employed daily ( See Explanatory note) :</td>
									</tr>
									<tr>
										<td>( a ) Adults :</td>
									</tr>
									<tr>
									   <td>( I ) Men </td>
									   <td><input type="text" class="form-control text-uppercase" name="adult[men]" value="<?php echo $adult_men; ?>"></td>
									   <td>( II ) Women </td>
									   <td><input type="text" class="form-control text-uppercase" name="adult[women]" value="<?php echo $adult_women; ?>"></td>
									</tr>
									<tr>
										<td>( b ) Adolescents :</td>
									</tr>
									<tr>
									   <td>( I ) Male </td>
									   <td><input type="text" class="form-control text-uppercase" name="adole[male]" value="<?php echo $adole_male; ?>"></td>
									   <td>( II ) Female</td>
									   <td><input type="text" class="form-control text-uppercase" name="adole[female]" value="<?php echo $adole_female; ?>"></td>
									</tr>
									<tr>
										<td>( c ) Children :</td>
									</tr>
									<tr>
									   <td>( I ) Boys </td>
									   <td><input type="text" class="form-control text-uppercase" name="children[boys]" value="<?php echo $children_boys; ?>"></td>
									   <td>( II ) Girls</td>
									   <td><input type="text" class="form-control text-uppercase" name="children[girls]" value="<?php echo $children_girls; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">12. Total number of man-hours worked including over-time. :</td>
									</tr>
									<tr>
									   <td>(a)Men </td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[men]" value="<?php echo $hours1_men; ?>"></td>
									   <td>(b)Women</td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[women]" value="<?php echo $hours1_women; ?>"></td>
									</tr>
									<tr>
									   <td>(c)Children </td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[children]" value="<?php echo $hours1_children; ?>"></td>
									   <td></td>
									   <td></td>
									</tr>
									<tr>
										<td colspan="4">13. Average number of hours worked per week (See explanatory note) :</td>
									</tr>
									<tr>
									   <td>(a)Men </td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[men1]" value="<?php echo $hours1_men1; ?>"></td>
									   <td>(b)Women</td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[women1]" value="<?php echo $hours1_women1; ?>"></td>
									</tr>
									<tr>
									   <td>(c)Children </td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[children1]" value="<?php echo $hours1_children1; ?>"></td>
									   <td></td>
									   <td></td>
									</tr>
									<tr>
										<td colspan="2">14. ( a ) Does the factory carry out any process or operation declared as dangerous under Section 87 ? (See Rule 94)</td>
										<td>
											<label class="radio-inline"><input type="radio" value="Y" name="is_factory" <?php if($is_factory=='Y') echo 'checked'; ?> />&nbsp;YES</label>
											<label class="radio-inline"><input type="radio" value="N" name="is_factory" <?php if($is_factory=='N' || $is_factory=='') echo 'checked'; ?> >&nbsp;NO</label><br/>
										</td>
									</tr>
								    <tr>
										<td colspan="4">( b ) If so, give the following information.</td>
									</tr>
									<tr>
									<td colspan="4">
										<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
											<tr>
												<th width="5%">Slno</th>
												<th width="15%">Name of the dangerous process or operations carried on </th>
												<th width="20%">Average number of persons employed daily in each of the processes or operations given in column 1</th>
											</tr>
											<?php
											$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
											$num = $part1->num_rows;
											if($num>0){
												$count=1;
												while($row_1=$part1->fetch_array()){	?>
												<tr>
													<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
													<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["dangerous_process"]; ?>"  name="txtB<?php echo $count;?>" size="10"></td>
													<td><input value="<?php echo $row_1["avg_num_person"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
												<td><input id="txtB1" size="10"  class="form-control text-uppercase" name="txtB1"></td>
												<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>
											</tr>
											<?php } ?>														
										</table>
										<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
										<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
									 </td>
									</tr>
									<tr>
										<td colspan="4">15. Total number of workers employed during the year. :</td>
									</tr>
									<tr>
									   <td>(a)Men </td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[men2]" value="<?php echo $hours1_men2; ?>"></td>
									   <td>(b)Women</td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[women2]" value="<?php echo $hours1_women2; ?>"></td>
									</tr>
									<tr>
									   <td>(c)Children </td>
									   <td><input type="text" class="form-control text-uppercase" name="hours1[children2]" value="<?php echo $hours1_children2; ?>"></td>
									   <td></td>
									   <td></td>
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
								<form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">16. Number of worker who were entitled to annual leave with wages during the year. :</td>
									</tr>
									<tr>
									   <td width="25%">(a)Men </td>
									   <td width="25%"><input type="text" class="form-control text-uppercase" name="hours[men2]" value="<?php echo $hours_men2; ?>"></td>
									   <td width="25%">(b)Women</td>
									   <td width="25%"><input type="text" class="form-control text-uppercase" name="hours[women2]" value="<?php echo $hours_women2; ?>"></td>
									</tr>
									<tr>
									   <td>(c)Children </td>
									   <td><input type="text" class="form-control text-uppercase" name="hours[children2]" value="<?php echo $hours_children2; ?>"></td>
									   <td></td>
									   <td></td>
									</tr>
									<tr>
										<td colspan="4">17. Number of worker who were granted leave during the year. :</td>
									</tr>
									<tr>
									   <td width="25%">(a)Men </td>
									   <td width="25%"><input type="text" class="form-control text-uppercase" name="hours[men3]" value="<?php echo $hours_men3; ?>"></td>
									   <td width="25%">(b)Women</td>
									   <td width="25%"><input type="text" class="form-control text-uppercase" name="hours[women3]" value="<?php echo $hours_women3; ?>"></td>
									</tr>
									<tr>
									   <td>(c)Children </td>
									   <td><input type="text" class="form-control text-uppercase" name="hours[children3]" value="<?php echo $hours_children3; ?>"></td>
									   <td></td>
									   <td></td>
									</tr>
									<tr>
									   <td>18.( a ) Number of workers who were discharged or dismissed from the service or quit employment or were superannuated or who died while in service during the year :</td>
									   <td><textarea class="form-control text-uppercase" name="number_workers"><?php echo $number_workers;?></textarea></td>
									   <td>( b ) Number of such workers in respect of whom wages in lieu of leave were paid :</td>
									   <td><input type="text" class="form-control text-uppercase" name="number[wages]" value="<?php echo $number_wages; ?>"></td>
									</tr>
									<tr>
									   <td>19. ( a ) Number of Safety Officers required to be appointed as per Notification under Section 40-B :</td>
									   <td><input type="text" class="form-control text-uppercase" name="number[officers]" value="<?php echo $number_officers; ?>"></td>
									   <td>( b ) Number of Safety Officer appointed :</td>
									   <td><input type="text" class="form-control text-uppercase" name="number[safety]" value="<?php echo $number_safety; ?>"></td>
									</tr>
									<tr>
									   <td colspan="2">20. Is there an Ambulance Room provided in the factory as required under Section 45 ?</td>
									   <td>
											<label class="radio-inline"><input type="radio" value="Y" name="is_ambulance" <?php if($is_ambulance=='Y') echo 'checked'; ?> />&nbsp;YES</label>
											<label class="radio-inline"><input type="radio" value="N" name="is_ambulance" <?php if($is_ambulance=='N' || $is_ambulance=='') echo 'checked'; ?> >&nbsp;NO</label><br/>
										</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									   <td colspan="2">21. ( a ) Is there a Canteen provided in the factory as required under Section 46 ?</td>
									   <td>
											<label class="radio-inline"><input type="radio" value="Y" name="is_provided" <?php if($is_provided=='Y') echo 'checked'; ?> />&nbsp;YES</label>
											<label class="radio-inline"><input type="radio" value="N" name="is_provided" <?php if($is_provided=='N' || $is_provided=='') echo 'checked'; ?> >&nbsp;NO</label><br/>
										</td>
									   <td></td>
										<td></td>
									 </tr>
									 <tr>
									    <td colspan="4">( b ) Is the Canteen provided managed/run.</td>
									 </tr>
									 <tr>
									   <td>( I ) Departmentally, or?</td>
									   <td><input type="text" class="form-control text-uppercase" name="departmental" value="<?php echo $departmental; ?>"></td>
									   <td>( ii ) Through a contractor?</td>
									   <td><input type="text" class="form-control text-uppercase" name="contractor" value="<?php echo $contractor; ?>"></td>
									</tr>
									<tr>
									   <td>22. ( a ) Are there adequate and suitable Shelters or Rest Rooms Provided in factory required under Section 47 ?</td>
									   <td>
											<label class="radio-inline"><input type="radio" value="Y" name="is_adequate" <?php if($is_adequate=='Y') echo 'checked'; ?> />&nbsp;YES</label>
											<label class="radio-inline"><input type="radio" value="N" name="is_adequate" <?php if($is_adequate=='N' || $is_adequate=='') echo 'checked'; ?> >&nbsp;NO</label><br/>
										</td>
									   <td>23.Is there a creche provided in the factory as required under Section 48 ?</td>
									   <td>
											<label class="radio-inline"><input type="radio" value="Y" name="is_creche" <?php if($is_creche=='Y') echo 'checked'; ?> />&nbsp;YES</label>
											<label class="radio-inline"><input type="radio" value="N" name="is_creche" <?php if($is_creche=='N' || $is_creche=='') echo 'checked'; ?> >&nbsp;NO</label><br/>
										</td>
									</tr>
									<tr>
									   <td>24.( a ) Number of Welfare Officers to be appointed as required under Section 49 :</td>
									   <td><input type="text" class="form-control text-uppercase" name="welfare[required]" value="<?php echo $welfare_required; ?>"></td>
									   <td>( b ) Number of Welfare Officers appointed :</td>
									   <td><input type="text" class="form-control text-uppercase" name="welfare[appointed]" value="<?php echo $welfare_appointed; ?>"></td>
									</tr>
									<tr>
									   <td colspan="4">25. ( a ) Total number of accidents :</td>
									</tr>
									<tr>
									   <td>( I ) Fatal :</td>
									   <td><input type="text" class="form-control text-uppercase" name="accidents[fatal]" value="<?php echo $accidents_fatal; ?>"></td>
									   <td>( ii ) Non-Fatal :</td>
									   <td><input type="text" class="form-control text-uppercase" name="accidents[nonfatal]" value="<?php echo $accidents_nonfatal; ?>"></td>
									</tr>
									<tr>
									   <td colspan="4">( b ) Accidents in which workers returned to work during the year to which this relates :</td>
									</tr>
									<tr>
									   <td colspan="4">( I ) Accident (workers injured) occurring during the year in which injured workers returned to work during the same year.</td>
									</tr>
									<tr>
									   <td>( a ) Number of accidents :</td>
									   <td><input type="text" class="form-control text-uppercase" name="number_acci" value="<?php echo $number_acci; ?>"></td>
									   <td>( b ) Mondays lost due to accidents :</td>
									   <td><input type="text" class="form-control text-uppercase" name="mondays_lost" value="<?php echo $mondays_lost; ?>"></td>
									</tr>
									<tr>
									   <td colspan="4">( ii ) Accidents (Workers injured) occurring in the previous year in which injured workers returned to work during the year to which this return relates.</td>
									</tr>
									<tr>
									   <td>( a ) Numbers of accidents :</td>
									   <td><input type="text" class="form-control text-uppercase" name="previous[acci]" value="<?php echo $previous_acci; ?>"></td>
									   <td>( b ) Mondays lost due to accidents :</td>
									   <td><input type="text" class="form-control text-uppercase" name="previous[lost]" value="<?php echo $previous_lost; ?>"></td>
									</tr>
									<tr>
									   <td colspan="4">( c ) Accidents (workers injured) occurring during the year in which injured workers did not return to work during the year to which this return relates.</td>
									</tr>
									<tr>
									   <td>( I ) Number of accidents :</td>
									   <td><input type="text" class="form-control text-uppercase" name="thisyr[acci]" value="<?php echo $thisyr_acci; ?>"></td>
									   <td>( ii ) Mondays lost due to accidents :</td>
									   <td><input type="text" class="form-control text-uppercase" name="thisyr[lost]" value="<?php echo $thisyr_lost; ?>"></td>
									</tr>
									<tr>
									   <td>26. ( a ) Is a Suggestion Scheme in operation in the factory :</td>
									   <td>
											<label class="radio-inline"><input type="radio" value="Y" name="is_suggestion" <?php if($is_suggestion=='Y') echo 'checked'; ?> />&nbsp;YES</label>
											<label class="radio-inline"><input type="radio" value="N" name="is_suggestion" <?php if($is_suggestion=='N' || $is_suggestion=='') echo 'checked'; ?> >&nbsp;NO</label><br/>
										</td>
									   <td>( b ) If so, the number of suggestion :</td>
									   <td><input type="text" class="form-control text-uppercase" name="num_suggestion" value="<?php echo $num_suggestion; ?>"></td>
									</tr>
									<tr>
									   <td>(c ) Amount awarded in case prize during the year :</td>
									   <td><input type="text" class="form-control text-uppercase" name="case_prize" value="<?php echo $case_prize; ?>"></td>
									</tr>
									<tr>
									   <td>( I ) Total amount awarded :</td>
									   <td><input type="text" class="form-control text-uppercase" name="awarded[amt]" value="<?php echo $awarded_amt; ?>"></td>
									   <td>( ii ) Value of the maximum cash prize awarded :</td>
									   <td><input type="text" class="form-control text-uppercase" name="awarded[maxcash]" value="<?php echo $awarded_maxcash; ?>"></td>
									</tr>
									<tr>
									   <td>( iii ) Value of the minimum cash prize awarded :</td>
									   <td><input type="text" class="form-control text-uppercase" name="awarded[mincash]" value="<?php echo $awarded_mincash; ?>"></td>
									   <td></td>
									   <td></td>
									</tr>
									<tr>
									   <td>Date : <?php echo date('d-m-Y', strtotime($today)); ?></td>
									   <td>&nbsp;</td>
									   <td>&nbsp;</td>
									   <td>Signature of the Manager : <label id="signature" name="signature" class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
					              <tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save and Next</button>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	<?php if($manuf_process_nat_fac!="OT"){ ?>
	$('.kw').show();			
	$('.hp').hide();
	<?php }else{ ?>
	$('.kw').hide();			
	$('.hp').show();
	<?php } ?>
	$('#nature_fac').on('click',function(){
		if($(this).val() == 'OT'){			
			$('.hp').show();
			$('.kw').hide();			
		}else{
			$('.kw').show();			
			$('.hp').hide();			
		}
	});
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform2 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>