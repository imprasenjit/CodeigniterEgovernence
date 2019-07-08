<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="22";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			##### PartI ####
			$accident_datetime=$results['accident_datetime'];$accident_place=$results['accident_place'];$victim_designation=$results['victim_designation'];;$victim_sex=$results['victim_sex'];$brief_desc=$results['brief_desc'];$work_on =$results['work_on'];$s1 =$results['s1'];$reg_no =$results['reg_no'];$auth_no =$results['auth_no'];$auth_person_name =$results['auth_person_name'];			
			if(!empty($results["victim"])){
				$victim=json_decode($results["victim"]);
				$victim_address=$victim->address;
				$victim_name=$victim->name;$victim_fname=$victim->fname;$victim_age=$victim->age;$victim_fatal=$victim->fatal;
				$victim_address_st1=$victim_address->st1;$victim_address_st2=$victim_address->st2;$victim_address_vt=$victim_address->vt;$victim_address_dist=$victim_address->dist;$victim_address_pin=$victim_address->pin;$victim_address_mob=$victim_address->mob;$victim_address_em=$victim_address->em;
			}else{
				$victim_name="";$victim_fname="";$victim_age="";$victim_fatal="";
				$victim_address_st1="";$victim_address_st2="";$victim_address_vt="";$victim_address_dist="";$victim_address_pin="";$victim_address_mob="";$victim_address_em="";
			}
			### Part II	###	
			$other_injuries=$results["other_injuries"];$postmortem=$results["postmortem"];$detail_cause=$results["detail_cause"];$action_taken=$results["action_taken"];$is_notified=$results["is_notified"];$notified_details=$results["notified_details"];$steps_taken=$results["steps_taken"];$any_remarks=$results["any_remarks"];
			if($notified_details=='N')
			{$notified_details='';}else{$notified_details=$notified_details;}
			if(!empty($results["auth_address"])){
				$auth_address=json_decode($results["auth_address"]);
				$auth_address_st1=$auth_address->st1;$auth_address_st2=$auth_address->st2;$auth_address_vt=$auth_address->vt;$auth_address_dist=$auth_address->dist;$auth_address_pin=$auth_address->pin;$auth_address_mob=$auth_address->mob;$auth_address_email=$auth_address->email;
			}else{
				$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
			}
			if(!empty($results["assisting_p"])){
				$assisting_p=json_decode($results["assisting_p"]);
				$assisting_p_name=$assisting_p->name;$assisting_p_desig=$assisting_p->desig;
			}else{
				$assisting_p_name="";$assisting_p_desig="";
			}
			if(!empty($results["supervising_p"])){
				$supervising_p=json_decode($results["supervising_p"]);
				$supervising_p_name=$supervising_p->name;$supervising_p_desig=$supervising_p->desig;
			}else{
				$supervising_p_name="";$supervising_p_desig="";
			}
			if(!empty($results["witness"])){
				$witness=json_decode($results["witness"]);
				$witness_name=$witness->name;$witness_desig=$witness->desig;
			}else{
				$witness_name="";$witness_desig="";
			}	
		
			
		}else{
			$form_id="";
			#### Part II ###
			$accident_datetime="";$accident_place="";$victim_designation="";$victim_sex="";$brief_desc="";$work_on="";$s1="";$reg_no="";$auth_no="";$auth_person_name="";$auth_person_name="";
			$victim_name="";$victim_fname="";$victim_age="";$victim_fatal="";
			$victim_address_st1="";$victim_address_st2="";$victim_address_vt="";$victim_address_dist="";$victim_address_pin="";$victim_address_mob="";$victim_address_em="";
			#### Part II ###
			$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
			$other_injuries="";$postmortem="";$detail_cause="";$action_taken="";$is_notified="";$notified_details="";$steps_taken="";$steps_taken="";$any_remarks="";
			$assisting_p_name="";$assisting_p_desig="";
			$supervising_p_name="";$supervising_p_desig="";
			$witness_name="";$witness_desig="";
				
		}
		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		##### PartI ####
		$accident_datetime=$results['accident_datetime'];$accident_place=$results['accident_place'];$victim_designation=$results['victim_designation'];;$victim_sex=$results['victim_sex'];$brief_desc=$results['brief_desc'];$work_on =$results['work_on'];$s1 =$results['s1'];$reg_no =$results['reg_no'];$auth_no =$results['auth_no'];$auth_person_name =$results['auth_person_name'];			
		if(!empty($results["victim"])){
			$victim=json_decode($results["victim"]);
            if(isset($victim->address))  $victim_address=$victim->address; else $victim_address=""; 
            if(isset($victim->name))  $victim_name=$victim->name; else $victim_name=""; 
            if(isset($victim->fname))  $victim_fname=$victim->fname; else $victim_fname=""; 
            if(isset($victim->age))  $victim_age=$victim->age; else $victim_age=""; 
            if(isset($victim->fatal))  $victim_fatal=$victim->fatal; else $victim_fatal=""; 
            if(isset($victim_address->st1))  $victim_address_st1=$victim_address->st1; else $victim_address_st1=""; 
            if(isset($victim_address->st2))  $victim_address_st2=$victim_address->st2; else $victim_address_st2=""; 
            if(isset($victim_address->vt))  $victim_address_vt=$victim_address->vt; else $victim_address_vt=""; 
            if(isset($victim_address->dist))  $victim_address_dist=$victim_address->dist; else $victim_address_dist=""; 
            if(isset($victim_address->pin))  $victim_address_pin=$victim_address->pin; else $victim_address_pin=""; 
            if(isset($victim_address->mob))  $victim_address_mob=$victim_address->mob; else $victim_address_mob=""; 
            if(isset($victim_address->em))  $victim_address_em=$victim_address->em; else $victim_address_em=""; 
            
			
		}else{
			$victim_name="";$victim_fname="";$victim_age="";$victim_fatal="";
			$victim_address_st1="";$victim_address_st2="";$victim_address_vt="";$victim_address_dist="";$victim_address_pin="";$victim_address_mob="";$victim_address_em="";
		}
		### Part II	###	
		$other_injuries=$results["other_injuries"];$postmortem=$results["postmortem"];$detail_cause=$results["detail_cause"];$action_taken=$results["action_taken"];$is_notified=$results["is_notified"];$notified_details=$results["notified_details"];$steps_taken=$results["steps_taken"];$any_remarks=$results["any_remarks"];
		if($notified_details=='N')
		{$notified_details='';}else{$notified_details=$notified_details;}
		if(!empty($results["auth_address"])){
			$auth_address=json_decode($results["auth_address"]);
			$auth_address_st1=$auth_address->st1;$auth_address_st2=$auth_address->st2;$auth_address_vt=$auth_address->vt;$auth_address_dist=$auth_address->dist;$auth_address_pin=$auth_address->pin;$auth_address_mob=$auth_address->mob;$auth_address_email=$auth_address->email;
		}else{
			$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
		}
		if(!empty($results["assisting_p"])){
			$assisting_p=json_decode($results["assisting_p"]);
			$assisting_p_name=$assisting_p->name;$assisting_p_desig=$assisting_p->desig;
		}else{
			$assisting_p_name="";$assisting_p_desig="";
		}
		if(!empty($results["supervising_p"])){
			$supervising_p=json_decode($results["supervising_p"]);
			$supervising_p_name=$supervising_p->name;$supervising_p_desig=$supervising_p->desig;
		}else{
			$supervising_p_name="";$supervising_p_desig="";
		}
		if(!empty($results["witness"])){
			$witness=json_decode($results["witness"]);
			$witness_name=$witness->name;$witness_desig=$witness->desig;
		}else{
			$witness_name="";$witness_desig="";
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
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">						
									<tr>
										<td width="25%">1. Date of accident </td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="accident_datetime"   value="<?php echo $accident_datetime; ?>" ></td>
										<td width="25%">2. Place of accident</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="accident_place"   value="<?php echo $accident_place; ?>" ></td>								
									</tr>
									<tr>
										<td>3. Name of owner </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $owner_names; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">4. Details of victim</td>
									</tr>
									<tr>
										<td>(a) Name </td>
										<td><input type="text" class="form-control text-uppercase" name="victim[name]" value="<?php echo $victim_name; ?>" validate="letters"></td>
										<td>(b) Father’s name </td>
										<td><input type="text" class="form-control text-uppercase" name="victim[fname]"  value="<?php echo $victim_fname; ?>" validate="letters"></td>
									</tr>
									<tr>
										<td>(c) Sex of victim<span class="mandatory_field">*</span></td>
										<td><label class="radio-inline"><input type="radio" name="victim_sex" value="M"  <?php if((isset($victim_sex) ) AND ($victim_sex=='M')) echo 'checked'; ?> required="required" /> Male</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="victim_sex"  value="F"  <?php if((isset($victim_sex) ) AND ($victim_sex=='F')) echo 'checked'; ?>/> Female</label></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">(d) Full postal address </td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="victim[address][st1]"    value="<?php echo $victim_address_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="victim[address][st2]"   value="<?php echo $victim_address_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="victim[address][vt]"  value="<?php echo $victim_address_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($victim_address_dist);?>"   name="victim[address][dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="victim[address][pin]" value="<?php echo $victim_address_pin; ?>" maxlength="6" validate="pincode"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="victim[address][mob]" value="<?php echo $victim_address_mob; ?>" maxlength="10" validate="mobileNumber"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" validate="jsonObj" name="victim[address][em]" value="<?php echo  $victim_address_em; ?>"></td>
										<td></td>
										<td></td>
										
									</tr>
									<tr>
										<td>(e) Approximate age</td>
										<td><input type="text" class="form-control text-uppercase" name="victim[age]"  value="<?php echo $victim_age; ?>" validate="onlyNumbers"></td>
										<td>(e) Fatal/non fatal </td>
										<td><input type="text" class="form-control text-uppercase"  name="victim[fatal]" value="<?php echo $victim_fatal; ?>" ></td>
									</tr>
									<tr>
										<td colspan="4">5. In case the victim is an employee of the person authorized under section 13</td>
									</tr>						
									<tr>
										<td>(a) Designation of such person </td>
										<td><input type="text" class="form-control text-uppercase" name="victim_designation"  value="<?php echo $victim_designation; ?>" ></td>
										<td>(b) Brief description of the job undertaken </td>
										<td><textarea class="form-control text-uppercase" name="brief_desc" maxlength="255" ><?php echo  $brief_desc; ?></textarea></td>
									</tr>
									<tr>
										<td>(c) Whether such person was allowed to work on the job </td>
										<td><input type="text" class="form-control text-uppercase" name="work_on"  value="<?php echo $work_on; ?>" ></td>
										<td> </td>
										<td></td>
									</tr>
									<tr>
										<td>6. Type of the lift/escalator</td>
										<td><select name="s1" class="form-control text-uppercase">
												<option value="Passenger" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Passenger") echo 'selected'; ?>>Passenger</option>
												<option value="Hospital"  class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Hospital") echo 'selected'; ?>>Hospital</option>
												<option value="Goods" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Goods") echo 'selected'; ?>>Goods</option>
												<option value="Service" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Service") echo 'selected'; ?>>Service</option>
						                  </select>
					                    </td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="4">7.  Registration  number  of  the  licence  of lift/escalator  along  with  the  name,  address  and authorization  number  of  the  authorized  person  by  whom  the  lift/escalator  is  erected  or maintained. </td>			
									</tr>
									<tr>
										<td>(a) Registration Number</td>
										<td><input type="text" class="form-control text-uppercase" name="reg_no"  value="<?php echo $reg_no; ?>"></td>
										<td>(b) Authorization Number</td>
										<td><input type="text" class="form-control text-uppercase" name="auth_no"   value="<?php echo $auth_no; ?>" ></td>
									</tr>
									<tr>
										<td>(c)Name</td>
										<td><input type="text" class="form-control text-uppercase" name="auth_person_name"  value="<?php echo $auth_person_name; ?>" validate="letters"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>					
									</tr>		
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">(d) Address</td>
									</tr>
									<tr>
										<td width="25%">Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="auth_address[st1]"   value="<?php echo $auth_address_st1; ?>"></td>
										<td width="25%">Street Name2:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="auth_address[st2]"   value="<?php echo $auth_address_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="auth_address[vt]"  value="<?php echo $auth_address_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($auth_address_dist);?>"   name="auth_address[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="auth_address[pin]" value="<?php echo $auth_address_pin; ?>" maxlength="6" validate="pincode"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="auth_address[mob]" value="<?php echo $auth_address_mob; ?>" maxlength="10" validate="mobileNumber"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control"  name="auth_address[email]" validate="jsonObj" value="<?php echo  $auth_address_email; ?>"></td>
										<td></td>
										<td></td>
										
									</tr>
									<tr>
										<td>8. (a) Describe fully the nature and extent of injuries, e.g. fatal/disablement (permanent or temporary) of any portion of the body or burns or other injuries. </td>
										<td><textarea class="form-control text-uppercase" name="other_injuries" maxlength="255" ><?php echo  $other_injuries; ?></textarea></td>
										<td>(b) In case of fatal accident, was the postmortem performed?</td>
										<td><textarea class="form-control text-uppercase" name="postmortem" maxlength="255" ><?php echo  $postmortem; ?></textarea></td>
									</tr>
									<tr>
										<td>9. Detailed causes leading to the accident.</td>
										<td><textarea class="form-control text-uppercase" name="detail_cause" maxlength="255" > <?php echo  $detail_cause; ?></textarea></td>
										<td>10.  Action  taken  regarding  first-aid,  medical  attendance  etc.  immediately  after  the occurrence of the accident (give details) </td>
										<td><textarea class="form-control text-uppercase" name="action_taken" maxlength="255" ><?php echo  $action_taken; ?></textarea></td>
									</tr>
									<tr>
										<td>11. (a) Whether  the  District  Magistrate  and  Police  Station  concerned  have  been  notified  of the accident<span class="mandatory_field">*</span></td>
										<td><label class="radio-inline"><input type="radio" checked="checked" name="is_notified" value="Y"  <?php if((isset($is_notified) ) AND ($is_notified=='Y')) echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="is_notified"  value="N"  <?php if((isset($is_notified) ) AND ($is_notified=='N')) echo 'checked'; ?>/> No</label></td>
										<td>(b)If so, give details </td>
										<td><textarea class="notify form-control text-uppercase" name="notified_details" maxlength="255" ><?php echo  $notified_details; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="3">12.  Steps  taken  to  preserve  the  evidence  in  connection  with  the  accident  to  the  extent possible  </td>
										<td><textarea class="form-control text-uppercase" name="steps_taken" maxlength="255" ><?php echo  $steps_taken; ?></textarea></td>
										
									</tr>	
									<tr>
										<td colspan="4">13.(a) Name and designation of the person assisting the person killed or injured. </td>
									</tr>
									<tr>
										<td>(a) Name</td>
										<td><input type="text" class="form-control text-uppercase" name="assisting_p[name]" value="<?php echo $assisting_p_name; ?>" validate="letters"></td>
										<td>(b)Designation</td>
										<td><input type="text" class="form-control text-uppercase" name="assisting_p[desig]"  value="<?php echo $assisting_p_desig; ?>" ></td>
									</tr>
									<tr>
										<td colspan="4">13.(b) Name and designation of the person supervising the person killed or injured. </td>
									</tr>
									<tr>
										<td>(a) Name</td>
										<td><input type="text" class="form-control text-uppercase" name="supervising_p[name]" value="<?php echo $supervising_p_name; ?>" validate="letters"></td>
										<td>(b)Designation</td>
										<td><input type="text" class="form-control text-uppercase" name="supervising_p[desig]"  value="<?php echo $supervising_p_desig; ?>" ></td>
									</tr>
									<tr>
										<td colspan="4">14. Name and designation of the persons present at and witnessed the accident</td>
									</tr>
									<tr>
										<td>(a) Name</td>
										<td><input type="text" class="form-control text-uppercase" name="witness[name]" value="<?php echo $witness_name; ?>" validate="letters"></td>
										<td>(b)Designation</td>
										<td><input type="text" class="form-control text-uppercase" name="witness[desig]"  value="<?php echo $witness_desig; ?>" ></td>
									</tr>	
									<tr>
										<td>15. Any other information/remarks </td>
										<td><textarea class="form-control text-uppercase" name="any_remarks" ><?php echo  $any_remarks; ?></textarea></td>
										<td></td>
										<td></td>
									</tr>	
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?><b><br/>
										Place : <b><?php echo strtoupper($dist); ?></b></td>
										<td colspan="2" align="right">
										Signature :<label><?php echo strtoupper($key_person) ?></label><br/>
										Name :<label><?php echo strtoupper($key_person) ?></label><br/>
										Designation :<label><?php echo strtoupper($status_applicant) ?></label><br/></td>
									</tr>	
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
    $("input").prop('required',true);
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
	<?php if($is_notified=="N"){ ?>
	$('.notify').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_notified"]').on('change', function(){
		if($(this).val() == 'N')
			$('.notify').attr('disabled', 'disabled');
		else
			$('.notify').removeAttr('disabled');
	});
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>