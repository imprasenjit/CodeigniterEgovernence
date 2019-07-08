<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="13";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ;// For reccuring form fill ups
	
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];$letter_no=$results['letter_no'];$letter_dt=$results['letter_dt'];$completed_on=$results['completed_on'];	
			$type_of_lift=$results['type_of_lift'];$rated_speed=$results['rated_speed'];$rated_load=$results['rated_load'];$total_lift_weight=$results['total_lift_weight'];$counter_weight =$results['counter_weight'];$suspension_rope =$results['suspension_rope'];$pit_depth =$results['pit_depth'];$travel =$results['travel'];$head_room =$results['head_room'];$auth_person =$results['auth_person'];$auth_no =$results['auth_no'];
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["premise_address"]))
			{
				$premise_address=json_decode($results["premise_address"]);
				$premise_address_st1=$premise_address->st1;$premise_address_st2=$premise_address->st2;$premise_address_vt=$premise_address->vt;$premise_address_dist=$premise_address->dist;$premise_address_pin=$premise_address->pin;$premise_address_mob=$premise_address->mob;$premise_address_email=$premise_address->email;
			}else{
				$premise_address_st1="";$premise_address_st2="";$premise_address_vt="";$premise_address_dist="";$premise_address_pin="";$premise_address_mob="";$premise_address_email="";
			}	
			if(!empty($results["auth_address"]))
			{
				$auth_address=json_decode($results["auth_address"]);
				$auth_address_name=$auth_address->name;$auth_address_st1=$auth_address->st1;$auth_address_st2=$auth_address->st2;$auth_address_vt=$auth_address->vt;$auth_address_dist=$auth_address->dist;$auth_address_pin=$auth_address->pin;$auth_address_mob=$auth_address->mob;$auth_address_email=$auth_address->email;
			}
			else
			{
				$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
			}		
			
		}else{
			$form_id="";$letter_no="";$letter_dt="";$completed_on="";
			$type_of_lift="";$rated_speed="";$rated_load="";$total_lift_weight="";$counter_weight="";$suspension_rope="";$pit_depth="";$travel="";$head_room="";$auth_person="";$auth_no="";
			$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			$premise_address_st1="";$premise_address_st2="";$premise_address_vt="";$premise_address_dist="";$premise_address_pin="";$premise_address_mob="";$premise_address_email="";
			$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
		}
	
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			
			$form_id=$results['form_id'];$letter_no=$results['letter_no'];$letter_dt=$results['letter_dt'];$completed_on=$results['completed_on'];	
			$type_of_lift=$results['type_of_lift'];$rated_speed=$results['rated_speed'];$rated_load=$results['rated_load'];$total_lift_weight=$results['total_lift_weight'];$counter_weight =$results['counter_weight'];$suspension_rope =$results['suspension_rope'];$pit_depth =$results['pit_depth'];$travel =$results['travel'];$head_room =$results['head_room'];$auth_person =$results['auth_person'];$auth_no =$results['auth_no'];
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["premise_address"]))
			{
				$premise_address=json_decode($results["premise_address"]);
				$premise_address_st1=$premise_address->st1;$premise_address_st2=$premise_address->st2;$premise_address_vt=$premise_address->vt;$premise_address_dist=$premise_address->dist;$premise_address_pin=$premise_address->pin;$premise_address_mob=$premise_address->mob;$premise_address_email=$premise_address->email;
			}else{
				$premise_address_st1="";$premise_address_st2="";$premise_address_vt="";$premise_address_dist="";$premise_address_pin="";$premise_address_mob="";$premise_address_email="";
			}	
			if(!empty($results["auth_address"]))
			{
				$auth_address=json_decode($results["auth_address"]);
				$auth_address_name=$auth_address->name;$auth_address_st1=$auth_address->st1;$auth_address_st2=$auth_address->st2;$auth_address_vt=$auth_address->vt;$auth_address_dist=$auth_address->dist;$auth_address_pin=$auth_address->pin;$auth_address_mob=$auth_address->mob;$auth_address_email=$auth_address->email;
			}
			else
			{
				$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
			}		
			
		}else{
			
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];$letter_no=$results['letter_no'];$letter_dt=$results['letter_dt'];$completed_on=$results['completed_on'];	
			$type_of_lift=$results['type_of_lift'];$rated_speed=$results['rated_speed'];$rated_load=$results['rated_load'];$total_lift_weight=$results['total_lift_weight'];$counter_weight =$results['counter_weight'];$suspension_rope =$results['suspension_rope'];$pit_depth =$results['pit_depth'];$travel =$results['travel'];$head_room =$results['head_room'];$auth_person =$results['auth_person'];$auth_no =$results['auth_no'];
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["premise_address"]))
			{
				$premise_address=json_decode($results["premise_address"]);
				$premise_address_st1=$premise_address->st1;$premise_address_st2=$premise_address->st2;$premise_address_vt=$premise_address->vt;$premise_address_dist=$premise_address->dist;$premise_address_pin=$premise_address->pin;$premise_address_mob=$premise_address->mob;$premise_address_email=$premise_address->email;
			}else{
				$premise_address_st1="";$premise_address_st2="";$premise_address_vt="";$premise_address_dist="";$premise_address_pin="";$premise_address_mob="";$premise_address_email="";
			}	
			if(!empty($results["auth_address"]))
			{
				$auth_address=json_decode($results["auth_address"]);
				$auth_address_name=$auth_address->name;$auth_address_st1=$auth_address->st1;$auth_address_st2=$auth_address->st2;$auth_address_vt=$auth_address->vt;$auth_address_dist=$auth_address->dist;$auth_address_pin=$auth_address->pin;$auth_address_mob=$auth_address->mob;$auth_address_email=$auth_address->email;
			}
			else
			{
				$auth_address_name="";$auth_address_st1="";$auth_address_st2="";$auth_address_vt="";$auth_address_dist="";$auth_address_pin="";$auth_address_mob="";$auth_address_email="";
			}		
		}
		
		
	}
	
    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 8 || is_numeric($showtab) == false) {
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
								<h4 class="text-center">
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
									    <td colspan="4" class="form-inline">To,<br/>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Inspector of Lift and Escalators,<br/><br/>
											Sub : Installation of Lift at <?php echo strtoupper($unit_name); ?><br/><br/>
											Dear Sir,<br/><br/>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With reference to letter No&nbsp;<input type="text" class="form-control text-uppercase"  name="letter_no" value="<?php echo $letter_no; ?>">&nbsp;dated &nbsp;<input type="text" class="dob form-control text-uppercase" name="letter_dt" readonly="readonly" value="<?php echo $letter_dt; ?>">&nbsp;of your office granting permission to install a lift at the above mentioned premises, I/We have to state that the work of installation of the lift has been completed on &nbsp;<input type="text" class="dob form-control text-uppercase" readonly="readonly" name="completed_on" value="<?php echo $completed_on; ?>">.<br/> 
											
										</td>
									</tr>								
									<tr>
									    <td colspan="4">1. Full name and address of the applicant </td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   value="<?php echo $key_person; ?>" disabled="disabled" readonly="readonly"></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
										<td>Email Id:</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
									</tr>
									<tr>
									    <td colspan="4">2. Name and address of the local agent, if any : </td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   name="local_agent[name]" value="<?php echo $local_agent_name; ?>" validate="letters"></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text"  class="form-control text-uppercase" name="local_agent[st1]" value="<?php echo $local_agent_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text"  class="form-control text-uppercase" name="local_agent[st2]" value="<?php echo $local_agent_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text"  class="form-control text-uppercase" name="local_agent[vt]" value="<?php echo $local_agent_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($local_agent_dist);?>"   name="local_agent[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[pin]"  value="<?php echo $local_agent_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[mob]" value="<?php echo $local_agent_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email"  class="form-control" name="local_agent[email]" value="<?php echo  $local_agent_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">3.  Address of the premises where the lift has been erected together with the name of the owner thereof : </td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text"  class="form-control text-uppercase" name="premise_address[st1]" value="<?php echo $premise_address_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text"  class="form-control text-uppercase" name="premise_address[st2]"  value="<?php echo $premise_address_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text"  class="form-control text-uppercase" name="premise_address[vt]" value="<?php echo $premise_address_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($premise_address_dist);?>"   name="premise_address[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="premise_address[pin]"  value="<?php echo $premise_address_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="premise_address[mob]" value="<?php echo $premise_address_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email"  class="form-control" name="premise_address[email]" value="<?php echo  $premise_address_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>																					
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">	
									<tr>
										<td colspan="4">4. Name and address of the person (authorized under section 13) who is going to maintain the lift.  </td>
									</tr>
									<tr>
										<td width="25%">Name :<span class="mandatory_field">*</span></td>
										<td width="25%"><input type="text" required="required" class="form-control text-uppercase" validate="letters" name="auth_address[name]" value="<?php echo $auth_address_name; ?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Street Name1 :<span class="mandatory_field">*</span></td>
										<td width="25%"><input type="text" required="required" class="form-control text-uppercase" name="auth_address[st1]" value="<?php echo $auth_address_st1; ?>"></td>
										<td width="25%">Street Name2:<span class="mandatory_field">*</span></td>
										<td width="25%"><input type="text" required="required"  class="form-control text-uppercase" name="auth_address[st2]"  value="<?php echo $auth_address_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :<span class="mandatory_field">*</span></td>
										<td><input type="text" required="required"  class="form-control text-uppercase" name="auth_address[vt]" value="<?php echo $auth_address_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($auth_address_dist);?>"   name="auth_address[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :<span class="mandatory_field">*</span></td>
										<td><input type="text" required="required" class="form-control text-uppercase" name="auth_address[pin]"  value="<?php echo $auth_address_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:<span class="mandatory_field">*</span></td>
										<td><input type="text" required="required" class="form-control text-uppercase" name="auth_address[mob]" value="<?php echo $auth_address_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email"  class="form-control" name="auth_address[email]" value="<?php echo  $auth_address_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>		
									<tr>
										<td>5. Type of lift : </td>
										<td><input type="text"  class="form-control text-uppercase" name="type_of_lift" value="<?php echo  $type_of_lift; ?>"></td>
										<td>6. The rated load of the lift (in Kilograms) : </td>
										<td><input type="text" validate="decimal" class="form-control text-uppercase" name="rated_load" value="<?php echo  $rated_load; ?>"></td>
									</tr>
									<tr>
										<td>7. The rated speed of the lift (meters/second) :<span class="mandatory_field">*</span>  </td>
										<td><input type="text" class="form-control text-uppercase" name="rated_speed" value="<?php echo  $rated_speed; ?>" validate="decimal" required="required"></td>
										<td>8. The total weight of the lift car including the rated load : </td>
										<td><input type="text"  class="form-control text-uppercase" name="total_lift_weight" value="<?php echo  $total_lift_weight; ?>"></td>
									</tr>
									<tr>
										<td>9. The total weight of the counterweight   </td>
										<td><input type="text"  class="form-control text-uppercase" name="counter_weight" value="<?php echo  $counter_weight; ?>"></td>
										<td>10. The number, description, weight and size of the suspension ropes     </td>
										<td><input type="text"  class="form-control text-uppercase" name="suspension_rope" value="<?php echo  $suspension_rope; ?>"></td>
									</tr>
									<tr>
										<td>11. The pit depth   </td>
										<td><input type="text"  class="form-control text-uppercase" name="pit_depth" value="<?php echo  $pit_depth; ?>"></td>
										<td>12. Travel and the number of floors served   </td>
										<td><input type="text" class="form-control text-uppercase" name="travel" value="<?php echo  $travel; ?>"></td>
									</tr>	
									<tr>
										<td>13. The total head room </td>
										<td><input type="text"  class="form-control text-uppercase" name="head_room" value="<?php echo  $head_room; ?>"></td>
										<td></td>
										<td></td>
									</tr>			
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b><br/>
										Name of the authorized person <input type="text" validate="letters" class="form-control1 text-uppercase" name="auth_person" value="<?php echo $auth_person; ?>"> <br/>
										Authorization number<input type="text"  class="form-control1 text-uppercase" name="auth_no" value="<?php echo $auth_no; ?>"> </td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>Signature of the applicant</td>
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>