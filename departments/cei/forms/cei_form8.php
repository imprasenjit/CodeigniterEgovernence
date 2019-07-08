<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="8";
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
			$form_id=$results['form_id'];	
			$escalator_detail=$results['escalator_detail'];$rated_speed=$results['rated_speed'];$rated_load=$results['rated_load'];$num_of_person=$results['num_of_person'];$angle_of_incline =$results['angle_of_incline'];$wd_of_escalator =$results['wd_of_escalator'];$vertical_rise =$results['vertical_rise'];$drive_claim =$results['drive_claim'];$cons_detail =$results['cons_detail'];$commencement_dt =$results['commencement_dt'];$completion_dt =$results['completion_dt'];	
			
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["escalator_install"]))
			{
				$escalator_install=json_decode($results["escalator_install"]);
				$escalator_install_st1=$escalator_install->st1;$escalator_install_st2=$escalator_install->st2;$escalator_install_vt=$escalator_install->vt;$escalator_install_dist=$escalator_install->dist;$escalator_install_pin=$escalator_install->pin;$escalator_install_mob=$escalator_install->mob;$escalator_install_email=$escalator_install->email;
			}else{
				$escalator_install_name="";$escalator_install_st1="";$escalator_install_st2="";$escalator_install_vt="";$escalator_install_dist="";$escalator_install_pin="";$escalator_install_mob="";$escalator_install_email="";
			}		
			if(!empty($results["install_person"]))
			{
				$install_person=json_decode($results["install_person"]);
				$install_person_name=$install_person->name;$install_person_st1=$install_person->st1;$install_person_st2=$install_person->st2;$install_person_vt=$install_person->vt;$install_person_dist=$install_person->dist;$install_person_pin=$install_person->pin;$install_person_mob=$install_person->mob;$install_person_email=$install_person->email;
			}else{
				$install_person_name="";$install_person_st1="";$install_person_st2="";$install_person_vt="";$install_person_dist="";$install_person_pin="";$install_person_mob="";$install_person_email="";
			}	
			if(!empty($results["makers_addr"]))
			{
				$makers_addr=json_decode($results["makers_addr"]);
				$makers_addr_name=$makers_addr->name;$makers_addr_st1=$makers_addr->st1;$makers_addr_st2=$makers_addr->st2;$makers_addr_vt=$makers_addr->vt;$makers_addr_dist=$makers_addr->dist;$makers_addr_pin=$makers_addr->pin;$makers_addr_mob=$makers_addr->mob;$makers_addr_email=$makers_addr->email;
			}else{
				$makers_addr_name="";$makers_addr_st1="";$makers_addr_st2="";$makers_addr_vt="";$makers_addr_dist="";$makers_addr_pin="";$makers_addr_mob="";$makers_addr_email="";
			}	
			if(!empty($results["related_load"]))
			{
				$related_load=json_decode($results["related_load"]);
				$related_load_no=$related_load->no;$related_load_kg=$related_load->kg;
			}else{
				$related_load_no="";$related_load_kg="";
			}	
				
		}else{
			$form_id="";
			$escalator_detail="";$rated_speed="";$rated_load="";$num_of_person="";$angle_of_incline="";$wd_of_escalator="";$vertical_rise="";$drive_claim="";$cons_detail="";$commencement_dt="";$completion_dt="";
			$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			
			$escalator_install_st1="";$escalator_install_st2="";$escalator_install_vt="";$escalator_install_dist="";$escalator_install_pin="";$escalator_install_mob="";$escalator_install_email="";
			$install_person_name="";$install_person_st1="";$install_person_st2="";$install_person_vt="";$install_person_dist="";$install_person_pin="";$install_person_mob="";$install_person_email="";
			$makers_addr_name="";$makers_addr_st1="";$makers_addr_st2="";$makers_addr_vt="";$makers_addr_dist="";$makers_addr_pin="";$makers_addr_mob="";$makers_addr_email="";
			$related_load_no="";$related_load_kg="";
			
		}
			      
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$escalator_detail=$results['escalator_detail'];$rated_speed=$results['rated_speed'];$rated_load=$results['rated_load'];$num_of_person=$results['num_of_person'];$angle_of_incline =$results['angle_of_incline'];$wd_of_escalator =$results['wd_of_escalator'];$vertical_rise =$results['vertical_rise'];$drive_claim =$results['drive_claim'];$cons_detail =$results['cons_detail'];$commencement_dt =$results['commencement_dt'];$completion_dt =$results['completion_dt'];	
			
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["escalator_install"]))
			{
				$escalator_install=json_decode($results["escalator_install"]);
				$escalator_install_st1=$escalator_install->st1;$escalator_install_st2=$escalator_install->st2;$escalator_install_vt=$escalator_install->vt;$escalator_install_dist=$escalator_install->dist;$escalator_install_pin=$escalator_install->pin;$escalator_install_mob=$escalator_install->mob;$escalator_install_email=$escalator_install->email;
			}else{
				$escalator_install_name="";$escalator_install_st1="";$escalator_install_st2="";$escalator_install_vt="";$escalator_install_dist="";$escalator_install_pin="";$escalator_install_mob="";$escalator_install_email="";
			}		
			if(!empty($results["install_person"]))
			{
				$install_person=json_decode($results["install_person"]);
				$install_person_name=$install_person->name;$install_person_st1=$install_person->st1;$install_person_st2=$install_person->st2;$install_person_vt=$install_person->vt;$install_person_dist=$install_person->dist;$install_person_pin=$install_person->pin;$install_person_mob=$install_person->mob;$install_person_email=$install_person->email;
			}else{
				$install_person_name="";$install_person_st1="";$install_person_st2="";$install_person_vt="";$install_person_dist="";$install_person_pin="";$install_person_mob="";$install_person_email="";
			}	
			if(!empty($results["makers_addr"]))
			{
				$makers_addr=json_decode($results["makers_addr"]);
				$makers_addr_name=$makers_addr->name;$makers_addr_st1=$makers_addr->st1;$makers_addr_st2=$makers_addr->st2;$makers_addr_vt=$makers_addr->vt;$makers_addr_dist=$makers_addr->dist;$makers_addr_pin=$makers_addr->pin;$makers_addr_mob=$makers_addr->mob;$makers_addr_email=$makers_addr->email;
			}else{
				$makers_addr_name="";$makers_addr_st1="";$makers_addr_st2="";$makers_addr_vt="";$makers_addr_dist="";$makers_addr_pin="";$makers_addr_mob="";$makers_addr_email="";
			}	
			if(!empty($results["related_load"]))
			{
				$related_load=json_decode($results["related_load"]);
				$related_load_no=$related_load->no;$related_load_kg=$related_load->kg;
			}else{
				$related_load_no="";$related_load_kg="";
			}	
		}else{
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];	
			$escalator_detail=$results['escalator_detail'];$rated_speed=$results['rated_speed'];$rated_load=$results['rated_load'];$num_of_person=$results['num_of_person'];$angle_of_incline =$results['angle_of_incline'];$wd_of_escalator =$results['wd_of_escalator'];$vertical_rise =$results['vertical_rise'];$drive_claim =$results['drive_claim'];$cons_detail =$results['cons_detail'];$commencement_dt =$results['commencement_dt'];$completion_dt =$results['completion_dt'];	
			
			if(!empty($results["local_agent"]))
			{
				$local_agent=json_decode($results["local_agent"]);
				$local_agent_name=$local_agent->name;$local_agent_st1=$local_agent->st1;$local_agent_st2=$local_agent->st2;$local_agent_vt=$local_agent->vt;$local_agent_dist=$local_agent->dist;$local_agent_pin=$local_agent->pin;$local_agent_mob=$local_agent->mob;$local_agent_email=$local_agent->email;
			}else{
				$local_agent_name="";$local_agent_st1="";$local_agent_st2="";$local_agent_vt="";$local_agent_dist="";$local_agent_pin="";$local_agent_mob="";$local_agent_email="";
			}
			if(!empty($results["escalator_install"]))
			{
				$escalator_install=json_decode($results["escalator_install"]);
				$escalator_install_st1=$escalator_install->st1;$escalator_install_st2=$escalator_install->st2;$escalator_install_vt=$escalator_install->vt;$escalator_install_dist=$escalator_install->dist;$escalator_install_pin=$escalator_install->pin;$escalator_install_mob=$escalator_install->mob;$escalator_install_email=$escalator_install->email;
			}else{
				$escalator_install_name="";$escalator_install_st1="";$escalator_install_st2="";$escalator_install_vt="";$escalator_install_dist="";$escalator_install_pin="";$escalator_install_mob="";$escalator_install_email="";
			}		
			if(!empty($results["install_person"]))
			{
				$install_person=json_decode($results["install_person"]);
				$install_person_name=$install_person->name;$install_person_st1=$install_person->st1;$install_person_st2=$install_person->st2;$install_person_vt=$install_person->vt;$install_person_dist=$install_person->dist;$install_person_pin=$install_person->pin;$install_person_mob=$install_person->mob;$install_person_email=$install_person->email;
			}else{
				$install_person_name="";$install_person_st1="";$install_person_st2="";$install_person_vt="";$install_person_dist="";$install_person_pin="";$install_person_mob="";$install_person_email="";
			}	
			if(!empty($results["makers_addr"]))
			{
				$makers_addr=json_decode($results["makers_addr"]);
				$makers_addr_name=$makers_addr->name;$makers_addr_st1=$makers_addr->st1;$makers_addr_st2=$makers_addr->st2;$makers_addr_vt=$makers_addr->vt;$makers_addr_dist=$makers_addr->dist;$makers_addr_pin=$makers_addr->pin;$makers_addr_mob=$makers_addr->mob;$makers_addr_email=$makers_addr->email;
			}else{
				$makers_addr_name="";$makers_addr_st1="";$makers_addr_st2="";$makers_addr_vt="";$makers_addr_dist="";$makers_addr_pin="";$makers_addr_mob="";$makers_addr_email="";
			}	
			if(!empty($results["related_load"]))
			{
				$related_load=json_decode($results["related_load"]);
				$related_load_no=$related_load->no;$related_load_kg=$related_load->kg;
			}else{
				$related_load_no="";$related_load_kg="";
			}	
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
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
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
									    <td colspan="4">1. Full name and permanent address of the owner/applicant.</td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   disabled value="<?php echo $key_person; ?>" ></td>
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
									    <td colspan="4">2. Name and address of the local agent of the owner, if any (appointed under section 14)</td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   name="local_agent[name]" validate="letters" value="<?php echo $local_agent_name; ?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[st1]"  value="<?php echo $local_agent_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[st2]"  value="<?php echo $local_agent_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[vt]"  value="<?php echo $local_agent_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($local_agent_dist);?>"   name="local_agent[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[pin]"   value="<?php echo $local_agent_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="local_agent[mob]"  value="<?php echo $local_agent_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" name="local_agent[email]"  value="<?php echo  $local_agent_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
										<td colspan="4">3.  Address of the premises  where the escalator is to be installed or  additions or alternations are proposed. </td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="escalator_install[st1]"  value="<?php echo $escalator_install_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="escalator_install[st2]"   value="<?php echo $escalator_install_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="escalator_install[vt]"  value="<?php echo $escalator_install_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($escalator_install_dist);?>"   name="escalator_install[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="escalator_install[pin]"  value="<?php echo $escalator_install_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="escalator_install[mob]" value="<?php echo $escalator_install_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" name="escalator_install[email]" value="<?php echo  $escalator_install_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">4. Whether  an  escalator  has  been  previously  erected  and  a  licence  has  been  granted (Details to be given)  </td>
										<td><textarea class="form-control text-uppercase" name="escalator_detail" maxlength="255" ><?php echo  $escalator_detail; ?></textarea></td>
									</tr>															
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">	
									<tr>
										<td colspan="4">5. Name  and  address  of  the  person  (authorized  under  section  13)  who  will  install  the escalator or make additions or alterations:- </td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="install_person[name]" validate="letters" value="<?php echo $install_person_name; ?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="install_person[st1]"  value="<?php echo $install_person_st1; ?>"></td>
										<td width="25%">Street Name2:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="install_person[st2]"   value="<?php echo $install_person_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[vt]"  value="<?php echo $install_person_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($install_person_dist);?>"   name="install_person[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[pin]"  value="<?php echo $install_person_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="install_person[mob]" value="<?php echo $install_person_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" name="install_person[email]" value="<?php echo  $install_person_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>		
									<tr>
										<td colspan="4">6. Maker’s name and address</td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   name="makers_addr[name]" validate="letters" value="<?php echo $makers_addr_name; ?>" ></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[st1]"  value="<?php echo $makers_addr_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[st2]"  value="<?php echo $makers_addr_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[vt]"  value="<?php echo $install_person_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($makers_addr_dist);?>"   name="makers_addr[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[pin]"  value="<?php echo $makers_addr_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="makers_addr[mob]" value="<?php echo $makers_addr_mob; ?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" name="makers_addr[email]" value="<?php echo  $makers_addr_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>7. The rated speed of the escalator(meter per second)</td>
										<td><input type="text" class="form-control text-uppercase" name="rated_speed"  validate="decimal" value="<?php echo  $rated_speed; ?>"> </td>
										<td>8. The rated load of the escalator in Kilograms</td>
										<td ><input type="text" class="form-control text-uppercase" name="rated_load" validate="decimal" value="<?php echo  $rated_load; ?>"></td>
									</tr>
									<tr>
										<td>9. The maximum number of persons which the escalator can carry </td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="num_of_person"   value="<?php echo  $num_of_person; ?>"></td>
										<td>10. The angle of inclination of the escalator with the horizontal </td>
										<td ><input type="text" class="form-control text-uppercase" name="angle_of_incline"   value="<?php echo  $angle_of_incline; ?>"></td>
									</tr>
									<tr>
										<td>11. The width of escalator.</td>
										<td><input type="text" class="form-control text-uppercase" name="wd_of_escalator"  validate="onlyNumbers" value="<?php echo  $wd_of_escalator; ?>"></td>
										<td>12. The vertical rise of the escalator.</td>
										<td ><input type="text" class="form-control text-uppercase" name="vertical_rise"   value="<?php echo  $vertical_rise; ?>"></td>
									</tr>
									<tr>
										<td>13. The  number, description,  weight  and  size  main  drive  chain,  handrail  drive  chain  and governor drive claim. </td>
										<td><input type="text" class="form-control text-uppercase" name="drive_claim"  value="<?php echo  $drive_claim; ?>"> </td>
										<td>14.  Details  of  construction  of  the  stresses  and  step  treads  together  with  the  weight  and size of all structural members and supporting beams in connection therewith. </td>
										<td ><textarea class="form-control text-uppercase" name="cons_detail" maxlength="255"  ><?php echo  $cons_detail; ?></textarea></td>
									</tr>
									<tr>
										<td>15. Proposed date of commencement of work</td>
										<td><input type="text" class="dob form-control text-uppercase" name="commencement_dt"  value="<?php echo  $commencement_dt; ?>"> </td>
										<td>16. Proposed date of completion of work </td>
										<td ><input type="text" class="dob form-control text-uppercase" name="completion_dt"  value="<?php echo  $completion_dt; ?>"></td>
									</tr>
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>
										 Signature of the applicant</td>
									</tr>	
									<tr>
										<td class="text-center" colspan="4">
											<a href="cei_form8.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>