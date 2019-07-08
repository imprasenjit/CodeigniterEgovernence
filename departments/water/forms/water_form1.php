<?php  require_once "../../requires/login_session.php";
$dept="water";
$form="1";
$ci->load->helper('get_uain_details');
$table_name=getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";



$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'and active='1'");
if($q->num_rows<1){	
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results["form_id"];
		$residential="";$residential_other="";  $institutional=""; $commercial=""; $industrial="";$other="";
		####### Part 1######
		$fat_name=$results["fat_name"];$documents=$results["documents"];$property_type=$results["property_type"];$property_type_sub_category=$results["property_type_sub_category"];$occu_pro=$results["occu_pro"];$occu_pro=$results["occu_pro"];$tot_per=$results["tot_per"];
		if($property_type=="R"){
			$residential=$property_type_sub_category;
			if(strlen($residential)>3){
				$residential_other=substr($residential, 8);
			}
		}else if($property_type=="I"){
			$institutional=$property_type_sub_category;
		}else if($property_type=="C") $commercial=$property_type_sub_category;
		else if($property_type=="IN") $industrial=$property_type_sub_category;
		else if(strlen($property_type)>3) $other=substr($property_type, 8);
		else {}
		if(!empty($results["pro_add"])){
			$pro_add=json_decode($results["pro_add"]);
			$pro_add_byelane=$pro_add->byelane;$pro_add_area=$pro_add->area;$pro_add_col_name=$pro_add->col_name;$pro_add_nl=$pro_add->nl;$pro_add_road=$pro_add->road;$pro_add_holding_no=$pro_add->holding_no;
		}else{				
			$pro_add_byelane="";$pro_add_area="";$pro_add_col_name="";$pro_add_nl="";$pro_add_road="";$pro_add_holding_no="";
		}
		if(!empty($results["b_add"])){
			$b_add=json_decode($results["b_add"]);				
			$bill_house=$b_add->a;$bill_locality=$b_add->b;$b_byelane=$b_add->c;$bill_ward=$b_add->d;$bill_dag=$b_add->e;$bill_patta=$b_add->f;$bill_mouza=$b_add->g;$bill_society=$b_add->h;$bill_road=$b_add->i;$bill_area=$b_add->j;$bill_landmark=$b_add->k;$bill_vill=$b_add->l;$bill_pincode=$b_add->m;$bill_mobile=$b_add->n;
		}else{				
			$bill_house="";$bill_locality="";$b_byelane="";$bill_ward="";$bill_dag="";$bill_patta="";$bill_mouza="";$bill_society="";$bill_road="";$bill_area="";$bill_landmark="";$bill_vill="";$bill_pincode="";$bill_mobile="";
		}
		if(!empty($results["tot_per"])){
			$tot_per=json_decode($results["tot_per"]);
			$tot_per_a=$tot_per->a;$tot_per_m=$tot_per->m;
		}else{				
			$tot_per_a="";$tot_per_m="";
		}		
		########## Part 2#####
		$connect_type=$results["connect_type"];$comm_mode=$results["comm_mode"];$gps_point=$results["gps_point"];
		if(!empty($results["is_connection"])){
			$is_connection=json_decode($results["is_connection"]);  
			if(isset($is_connection->a)) $is_connection_a=$is_connection->a; else $is_connection_a="";
			if(isset($is_connection->b)) $is_connection_b=$is_connection->b; else $is_connection_b="";
		}else{				
			$is_connection_a="";$is_connection_b="";
		}
		//echo $is_connection_a."//".$is_connection_b;die();
		if(!empty($results["is_arrear"])){
			$is_arrear=json_decode($results["is_arrear"]);
			if(isset($is_arrear->a)) $is_arrear_a=$is_arrear->a; else $is_arrear_a="";
			if(isset($is_arrear->b)) $is_arrear_b=$is_arrear->b; else $is_arrear_b="";
		}else{				
			$is_arrear_a="";$is_arrear_b="";
		}
		if(!empty($results["declaration"])){
			$declaration=json_decode($results["declaration"]);
			$declaration_a=$declaration->a; $declaration_b=$declaration->b;$declaration_c=$declaration->c;  $declaration_d=$declaration->d; $declaration_e=$declaration->e; 
		}else{				
			$declaration_a="";$declaration_b="";$declaration_c="";$declaration_d="";$declaration_e="";
		}
	}else{
		$form_id="";
		####### Part 1######
		$fat_name="";$documents="";$institutional="";$commercial="";$industrial="";$other="";$occu_pro="";$pro_add_byelane="";$pro_add_area="";$pro_add_col_name="";$pro_add_nl="";$pro_add_road="";$pro_add_holding_no="";$property_type="";$property_type_sub_category="";$residential="";$residential_other="";  $institutional=""; $commercial=""; $industrial="";$other="";$tot_per_a="";$tot_per_m="";
		########## Part 2#####
		$connect_type="";$comm_mode="";$gps_point="";$is_connection_a="";$is_connection_b="";$is_arrear_a="";$is_arrear_b="";$declaration_a="";$declaration_b="";$declaration_c="";$declaration_d="";$declaration_e="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$residential="";$residential_other="";  $institutional=""; $commercial=""; $industrial="";$other="";
	####### Part 1######
	$fat_name=$results["fat_name"];$documents=$results["documents"];$property_type=$results["property_type"];$property_type_sub_category=$results["property_type_sub_category"];$occu_pro=$results["occu_pro"];$occu_pro=$results["occu_pro"];$tot_per=$results["tot_per"];	
	if($property_type=="R"){
		$residential=$property_type_sub_category;
		if(strlen($residential)>3){
			$residential_other=substr($residential, 8);
		}
	}else if($property_type=="I"){
		$institutional=$property_type_sub_category;
	}else if($property_type=="C") $commercial=$property_type_sub_category;
	else if($property_type=="IN") $industrial=$property_type_sub_category;
	else if(strlen($property_type)>3) $other=substr($property_type, 8);
	else {}
	if(!empty($results["pro_add"])){
		$pro_add=json_decode($results["pro_add"]);
		$pro_add_byelane=$pro_add->byelane;$pro_add_area=$pro_add->area;$pro_add_col_name=$pro_add->col_name;$pro_add_nl=$pro_add->nl;$pro_add_road=$pro_add->road;$pro_add_holding_no=$pro_add->holding_no;
	}else{				
		$pro_add_byelane="";$pro_add_area="";$pro_add_col_name="";$pro_add_nl="";$pro_add_road="";$pro_add_holding_no="";
	}
	if(!empty($results["b_add"])){
		$b_add=json_decode($results["b_add"]);				
		$bill_house=$b_add->a;$bill_locality=$b_add->b;$b_byelane=$b_add->c;$bill_ward=$b_add->d;$bill_dag=$b_add->e;$bill_patta=$b_add->f;$bill_mouza=$b_add->g;$bill_society=$b_add->h;$bill_road=$b_add->i;$bill_area=$b_add->j;$bill_landmark=$b_add->k;$bill_vill=$b_add->l;$bill_pincode=$b_add->m;$bill_mobile=$b_add->n;
	}else{				
		$bill_house="";$bill_locality="";$b_byelane="";$bill_ward="";$bill_dag="";$bill_patta="";$bill_mouza="";$bill_society="";$bill_road="";$bill_area="";$bill_landmark="";$bill_vill="";$bill_pincode="";$bill_mobile="";
	}
	if(!empty($results["tot_per"])){
		$tot_per=json_decode($results["tot_per"]);
		$tot_per_a=$tot_per->a;$tot_per_m=$tot_per->m;
	}else{				
		$tot_per_a="";$tot_per_m="";
	}
	########## Part 2#####
	$connect_type=$results["connect_type"];$comm_mode=$results["comm_mode"];$gps_point=$results["gps_point"];
	if(!empty($results["is_connection"])){
		$is_connection=json_decode($results["is_connection"]);  
		if(isset($is_connection->a)) $is_connection_a=$is_connection->a; else $is_connection_a="";
		if(isset($is_connection->b)) $is_connection_b=$is_connection->b; else $is_connection_b="";
	}else{				
		$is_connection_a="";$is_connection_b="";
	}
	//echo $is_connection_a."//".$is_connection_b;die();
	if(!empty($results["is_arrear"])){
		$is_arrear=json_decode($results["is_arrear"]);
		if(isset($is_arrear->a)) $is_arrear_a=$is_arrear->a; else $is_arrear_a="";
		if(isset($is_arrear->b)) $is_arrear_b=$is_arrear->b; else $is_arrear_b="";
	}else{				
		$is_arrear_a="";$is_arrear_b="";
	}
	if(!empty($results["declaration"])){
		$declaration=json_decode($results["declaration"]);
		$declaration_a=$declaration->a; $declaration_b=$declaration->b;$declaration_c=$declaration->c;  $declaration_d=$declaration->d; $declaration_e=$declaration->e; 
	}else{				
		$declaration_a="";$declaration_b="";$declaration_c="";$declaration_d="";$declaration_e="";
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
							  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
							  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part 2</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td colspan="4">1. Details of Applicant :  </td>
											</tr>
											<tr>
												<td width="25%">a) Name :</td>
												<td width="25%"><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
												<td width="25%">b) Father/Husband Name :</td>
												<td width="25%"><input  type="text" value="<?php echo $fat_name; ?>" class="form-control text-uppercase" validate="letters" name="fat_name"></td>
											</tr>
											<tr>
												<td>c) Designation :</td>
												<td><input  type="text" value="<?php echo $status_applicant; ?>" class="form-control text-uppercase" disabled></td>
												<td>d) Please select the relevant option and furnish supporting document for the same :<span class="mandatory_field">*</span></td>
												<td><select class="form-control text-uppercase" name="documents" value="<?php echo $documents;?>" required="required">
													<option value="">Please Select</option>
													<option value="GO" <?php if($documents=="GO") echo "selected"; ?>>Govt. Organization</option>
													<option value="HCF" <?php if($documents=="HCF") echo "selected"; ?>>Health Care Facility</option>
													<option value="EI" <?php if($documents=="EI") echo "selected"; ?>>Govt. or Govt. aided Educational Institute</option>
													<option value="PEI" <?php if($documents=="PEI") echo "selected"; ?>>Private Educational Institute</option>
													<option value="RP" <?php if($documents=="RP") echo "selected"; ?>>Religious places</option>
													</select></td>
											</tr>
											<tr>
												<td colspan="4">2. Contact Details :</td>
											</tr>
											<tr>
												<td>a) Mobile NO. :</td>
												<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $mobile_no;?>"></td>
												<td>b) Office No. :</td>
												<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_mobile_no;?>"></td>
											</tr>
											<tr>
												<td colspan="4">3. Property Address :</td>
											</tr>
											<tr>
												<td>House No.</td>
												<td><input type="text" class="form-control text-uppercase" id="house" readonly="readonly" value="<?php echo $b_street_name1;?>"/></td>
												<td>Locality</td>
												<td><input type="text" class="form-control text-uppercase" id="locality" readonly="readonly" value="<?php echo $b_street_name2;?>"/></td>
											</tr>
											<tr>
												<td>Bye-lane</td>
												<td><input type="text"  class="form-control text-uppercase" id="byelane" name="pro_add[byelane]" value="<?php echo $pro_add_byelane;?>"></td>
												<td>Ward No.</td>
												<td><input type="text"  class="form-control text-uppercase" id="wardno" readonly="readonly" value="<?php echo $b_block;?>"></td>
											</tr>
											<tr>
												<td>Dag No.</td>
												<td><input type="text"  class="form-control text-uppercase" id="dag" readonly="readonly" value="<?php echo $dag_no;?>"></td>
												<td>Patta No.</td>
												<td><input type="text"  class="form-control text-uppercase" id="patta" readonly="readonly" value="<?php echo $patta_no;?>"></td>
											</tr>
											<tr>
												<td>Mouza</td>
												<td><input type="text"  class="form-control text-uppercase" id="mouza" readonly="readonly" value="<?php echo $mouza;?>"></td>
												<td>Society / Colony Name</td>
												<td><input type="text"  class="form-control text-uppercase" id="society" name="pro_add[col_name]" value="<?php echo $pro_add_col_name;?>"></td>
											</tr>
											<tr>
												<td>Road</td>
												<td><input type="text"  class="form-control text-uppercase" id="road" name="pro_add[road]" value="<?php echo $pro_add_road;?>"></td>
												<td>Area</td>
												<td><input type="text"  class="form-control text-uppercase" id="area" name="pro_add[area]" value="<?php echo $pro_add_area;?>"></td>
											</tr>
											<tr>
												<td>Nearest Landmark 	</td>
												<td><input type="text"  class="form-control text-uppercase" id="landmark" name="pro_add[nl]" value="<?php echo $pro_add_nl;?>"></td>
												<td>Village</td>
												<td><input type="text"  class="form-control text-uppercase" id="vill" readonly="readonly" value="<?php echo $b_vill;?>"></td>
											</tr>
											<tr>
												<td>Holding No</td>
												<td><input type="text"  class="form-control text-uppercase" id="holding_no" name="pro_add[holding_no]" value="<?php echo $pro_add_holding_no;?>"></td>
												<td>Pincode</td>
												<td><input type="text"  class="form-control text-uppercase" id="pincode" readonly="readonly" value="<?php echo $b_pincode;?>"></td>
											</tr>
											<tr>
												<td>Mobile no.</td>
												<td><input type="text" class="form-control text-uppercase" id="mobile" readonly="readonly" value="<?php echo $b_mobile_no;?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>4. (a) Type of Property as per use :</td>
												<td>
													<select name="property_type" onchange="getval(this);" class="form-control text-uppercase" >
														<option value="">Please Select</option>
														<option value="R" <?php if($property_type=="R") echo "selected";?>>Residential</option>
														<option value="I" <?php if($property_type=="I") echo "selected";?>>Institutional</option>
														<option value="C" <?php if($property_type=="C") echo "selected";?>>Commercial Place</option>
														<option value="IND" <?php if($property_type=="IND") echo "selected";?>>Industrial</option>
														<option value="O" <?php if(strlen($property_type)>3) echo "selected";?>>Other, Please Specify</option>
													</select>
												</td>
												<td>
													<select name="property_type_sub_category_residential" onchange="getotherval(this);" id="residential" class="form-control text-uppercase" > 
														<option value="">Please Select</option>
														<option value="IH" <?php if($residential=="IH") echo "selected";?> >Independent House</option>
														<option value="CD" <?php if($residential=="CD") echo "selected";?>>Collective Dwelling (Old age home, Orphanage, Destitute home included)</option>
														<option value="R" <?php if($residential=="R") echo "selected";?>>Residence cum other use</option>
														<option value="A" <?php if($residential=="A") echo "selected";?>>Apartment</option>
														<option value="O" <?php if(strlen($residential)>3) echo "selected";?>>Other, Please Specify</option>
													</select>
													<select name="property_type_sub_category_institutional" id="institutional" class="form-control text-uppercase" >
														<option value="">Please Select</option>
														<option value="HCF" <?php if($institutional=="HCF") echo "selected";?> >Health Care Facility</option>
														<option value="EI" <?php if($institutional=="EI") echo "selected";?>>Educational Institute</option>
														<option value="PAO" <?php if($institutional=="PAO") echo "selected";?>>Public Administration Office</option>
														<option value="R" <?php if($institutional=="R") echo "selected";?>>Religious Place</option>
													</select>
													<select name="property_type_sub_category_commercial" id="commercial" class="form-control text-uppercase" >
														<option value="">Please Select</option>
														<option value="O" <?php if($commercial=="O") echo "selected";?> >Office</option>
														<option value="S" <?php if($commercial=="S") echo "selected";?>>Shop</option>
														<option value="SC" <?php if($commercial=="SC") echo "selected";?>>Shopping Complex</option>
														<option value="SM" <?php if($commercial=="SM") echo "selected";?>>Shopping Mall</option>
														<option value="R" <?php if($commercial=="R") echo "selected";?>>Restaurant</option>
														<option value="HO" <?php if($commercial=="HO") echo "selected";?>>Hotel</option>
														<option value="G" <?php if($commercial=="G") echo "selected";?>>Guesthouse</option>
														<option value="H" <?php if($commercial=="H") echo "selected";?>>Hostel</option>
													</select>
													<select name="property_type_sub_category_industrial" id="industrial" class="form-control text-uppercase" >
														<option value="">Please Select</option>
														<option value="W" <?php if($industrial=="W") echo "selected";?> >Workshops</option>
														<option value="F" <?php if($industrial=="F") echo "selected";?>>Factories</option>
														<option value="I" <?php if($industrial=="I") echo "selected";?>>Industries</option>
													</select>
													<div class="form-group">
														<input type="text" class="form-control text-uppercase" placeholder="Please Specify" id="other" name="other" value="<?php echo $other;?>" validate="letters" />
													</div>
												</td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control text-uppercase" placeholder="Please Specify" id="residential_other" name="residential_other" value="<?php echo $residential_other;?>" validate="letters" />
													</div>
												</td>
											</tr>
											<tr>											
												<td>(b) Occupant of the Property :</td>
												<td>
													<select name="occu_pro" value="<?php echo $occu_pro;?>" class="form-control text-uppercase" >
														<option value="">Please Select</option>
														<option value="O" <?php if($occu_pro=="O") echo "selected";?> >Owner</option>
														<option value="T" <?php if($occu_pro=="T") echo "selected";?>>Tenant</option>
														<option value="L" <?php if($occu_pro=="L") echo "selected";?>>Lessee</option>
													</select>
												</td>											
												<td>(c) Total number of persons actually living in the property including tenants :</td>
												<td>
													i. Adults : <input type="text" value="<?php echo $tot_per_a; ?>" class="form-control text-uppercase" placeholder="Adults" name="tot_per[a]" validate="onlyNumbers">
													ii. Minors : <input type="text" value="<?php echo $tot_per_m; ?>" class="form-control text-uppercase" placeholder="Minors" name="tot_per[m]" validate="onlyNumbers">												
												</td>
											</tr>
											<tr >
												<td colspan="4" class="form-inline">5. Billing Address (For future use)<br/>
												<input type="checkbox" id="same_as_above" name="billing_address" value="1"/>Tick if same as property address</td>
											</tr>
											<tr>
												<td>House No.</td>
												<td><input type="text" id="bill_house" class="form-control text-uppercase" name="b_add[a]" value="<?php if(empty($bill_house)) echo $b_street_name1; else echo $bill_house; ?>"/></td>
												<td>Locality</td>
												<td><input type="text" id="bill_locality" class="form-control text-uppercase" name="b_add[b]" value="<?php if(empty($bill_locality)) echo $b_street_name2; else echo $bill_locality ?>"/></td>
											</tr>
											<tr>
												<td>Bye-lane</td>
												<td><input type="text" id="b_byelane" class="form-control text-uppercase" name="b_add[c]" value="<?php if(empty($b_byelane)) echo $pro_add_byelane; else echo $b_byelane; ?>"></td>
												<td>Ward No.</td>
												<td><input type="text" id="bill_ward" class="form-control text-uppercase" name="b_add[d]" value="<?php if(empty($bill_ward)) echo $b_block; else echo $bill_ward; ?>"/></td>
											</tr>
											<tr>
												<td>Dag No.</td>
												<td><input type="text" id="bill_dag" class="form-control text-uppercase" name="b_add[e]" value="<?php if(empty($bill_dag))  echo $dag_no; else echo $bill_dag; ?>"></td>
												<td>Patta No.</td>
												<td><input type="text" id="bill_patta" class="form-control text-uppercase" name="b_add[f]" value="<?php if(empty($bill_patta)) echo $patta_no; else echo $bill_patta; ?>"></td>
											</tr>
											<tr>
												<td>Mouza</td>
												<td><input type="text" id="bill_mouza" class="form-control text-uppercase" name="b_add[g]" value="<?php if(empty($bill_mouza)) echo $mouza; else echo $bill_mouza?>"></td>
												<td>Society / Colony Name</td>
												<td><input type="text" id="bill_society" class="form-control text-uppercase" name="b_add[h]" value="<?php if(empty($bill_society)) echo $pro_add_col_name; else echo $bill_society?>"></td>
											</tr>
											<tr>
												<td>Road</td>
												<td><input type="text" id="bill_road" class="form-control text-uppercase" name="b_add[i]" value="<?php if(empty($bill_road)) echo $pro_add_road; else echo $bill_road; ?>"</td>
												<td>Area</td>
												<td><input type="text" id="bill_area" class="form-control text-uppercase" name="b_add[j]" value="<?php if(empty($bill_road)) echo $pro_add_area; else echo $bill_area; ?>"></td>
											</tr>
											<tr>
												<td>Nearest Landmark 	</td>
												<td><input type="text" id="bill_landmark" class="form-control text-uppercase" name="b_add[k]" value="<?php if(empty($bill_landmark)) echo $pro_add_nl; else echo $bill_landmark;?> "></td>
												<td>Village</td>
												<td><input type="text" id="bill_vill" class="form-control text-uppercase" name="b_add[l]" value="<?php if(empty($bill_vill)) echo $b_vill; else echo $bill_vill;?>"></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" id="bill_pincode" class="form-control text-uppercase" name="b_add[m]" value="<?php if(empty($bill_vill)) echo $b_pincode; else echo $bill_pincode; ?>" validate="pincode" maxlength="6"></td>
												<td>Mobile no.</td>
												<td><input type="text" id="bill_mobile" class="form-control text-uppercase" name="b_add[n]" value="<?php if(empty($bill_mobile))  echo $b_mobile_no; else echo $bill_mobile; ?>" validate="mobileNumber" maxlength="10"></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td width="25%">6. Type of Connection needed :</td>
												<td width="25%"><select name="connect_type" value="<?php echo $connect_type;?>" class="form-control text-uppercase" >
													<option value="">Please Select</option>
													<option value="T" <?php if($connect_type=="T") echo "selected";?> >Temporary</option>
													<option value="P" <?php if($connect_type=="P") echo "selected";?>>Permanent</option>
													<option value="A" <?php if($connect_type=="A") echo "selected";?>>Alteration to existing connection</option>
												</select></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td width="25%">7. Whether there is already a connection to the premises from GMC,PHED or AUWSSB :</td>
												<td width="25%">
													<label class="radio-inline"><input type="radio" name="is_connection[a]" class="is_connection_a" value="Y" <?php if (isset($is_connection_a) && ($is_connection_a=='Y')) echo 'checked'; ?> > Yes </label>
													<label class="radio-inline"><input type="radio" name="is_connection[a]" class="is_connection_a" value="N" <?php if(isset($is_connection_a) && (($is_connection_a=='N') || ($is_connection_a==''))) echo 'checked'; ?> >&nbsp;No </label></td>
												<td width="25%">Please specify along with Consumer No.: </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="is_connection[b]" id="is_connection_b" value="<?php echo $is_connection_b;?>"></td>
											</tr>
											<tr>
												<td>8. Is there any arrear fee outstanding against previous water supply connection? :</td>
												<td><label class="radio-inline"><input type="radio" name="is_arrear[a]" class="is_arrear_a" value="Y" <?php if (isset($is_arrear_a) || ($is_arrear_a=='Y')) echo 'checked'; ?> > Yes </label>
												<label class="radio-inline"><input type="radio" name="is_arrear[a]" class="is_arrear_a" value="N" <?php if(isset($is_arrear_a) && (($is_arrear_a=='N') || ($is_arrear_a==''))) echo 'checked'; ?> >&nbsp;No </label></td>
												<td>Please provide details: </td>
												<td><input type="text" class="form-control text-uppercase" name="is_arrear[b]" id="is_arrear_b" validate="textarea" value="<?php echo $is_arrear_b;?>"></td>			
											</tr>
											<tr>
												<td colspan="4">9. Other details :</td>
											</tr>
											<tr>
												
												<td> Preferred Mode of Communication : </td>		
												<td><select name="comm_mode" value="<?php echo $comm_mode;?>" class="form-control text-uppercase" >
													<option value="">Please Select</option>
													<option value="ES" <?php if($comm_mode=="ES") echo "selected";?> >Email and SMS</option>
													<option value="PS" <?php if($comm_mode=="PS") echo "selected";?>>Paper Format and SMS</option>
												</select></td>
											</tr>
											<tr>
												<td colspan="4">11. Declaration : </td>
											</tr>
											<tr>
												<td colspan="4" class="form-inline">a) I / We certify that the above information is correct and true to the best of my /our knowledge.<br/>
												b) I / We undertake to abide by the &nbsp;<input type="text" class="form-control text-uppercase" name="declaration[a]" value="<?php echo $declaration_a;?>"/>&nbsp; as amended to from time to time and all other relevant orders and notifications that would come up from time to time in future.<br/>
												c) I / We undertake to pay to &nbsp;<input type="text" class="form-control text-uppercase" name="declaration[b]" value="<?php echo $declaration_b;?>"/>&nbsp; all such fees / charges as are applicable for the purpose.<br/>
												d) I / We undertake that in future if no bill is received by me / us by the prescribed time of the month towards user fee / charges, it would be my/our responsibility to contact the Officer-in- charge of the  &nbsp;<input type="text" class="form-control text-uppercase" name="declaration[c]" value="<?php echo $declaration_c;?>"/>&nbsp; in the are to the collect the bill and pay up the latest updated water bill(s) against my / our premises by the date(s) prescribed in the bill(s), failing which the  &nbsp;<input type="text" class="form-control text-uppercase" name="declaration[d]" value="<?php echo $declaration_d;?>"/>&nbsp; will have the right to take appropriate action in the matter including disconnecting the service if so needed.<br/>
												e) I / We understand that a sanction for water connection to the above mentioned premises by the  &nbsp;<input type="text" class="form-control text-uppercase" name="declaration[e]" value="<?php echo $declaration_e;?>"/>&nbsp; will be restricted only to water service provision and that such a sanction of house connection will have no implication in any form including legality on ownership of the property.</td>
											</tr>
											<tr >
												<td>GPS Point :</td>
												<td><input type="text" class="form-control text-uppercase" name="gps_point" value="<?php echo $gps_point;?>"/></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>Date :</td>
												<td><label class="text-uppercase"> <?php echo $today;?></label></td>
												<td>Signature of the Applicant :</td>
												<td><label class="text-uppercase"> <?php echo $key_person;?></label></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success">Save and Next</button>
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
	$('#is_connection_b').attr('disabled', 'disabled');
	<?php if($is_connection_a=="Y"){ ?>
				$('#is_connection_b').removeAttr('disabled');
	<?php } ?>
	$('.is_connection_a').on('change', function(){
		if($(this).val() == 'N'){
			$('#is_connection_b').attr('disabled', 'disabled');
		}else{
			$('#is_connection_b').removeAttr('disabled');
		}			
	});
	
	/* Same as above */
	$('#same_as_above').click(function(){
		if ($(this).prop('checked')==true){ 
			var house=$('#house').val();
			var locality=$('#locality').val();
			var byelane=$('#byelane').val();
			var wardno=$('#wardno').val();
			var dag=$('#dag').val();
			var patta=$('#patta').val();
			var mouza=$('#mouza').val();
			var society=$('#society').val();
			var road=$('#road').val();
			var area=$('#area').val();
			var landmark=$('#landmark').val();
			var vill=$('#vill').val();
			var pincode=$('#pincode').val();
			var mobile=$('#mobile').val();
			
			/*new*/
			$('#bill_house').val(house);
			$('#bill_locality').val(locality);
			$('#bill_byelane').val(byelane);
			$('#bill_wardno').val(wardno);
			$('#bill_dag').val(dag);
			$('#bill_patta').val(patta);
			$('#bill_mouza').val(mouza);
			$('#bill_society').val(society);
			$('#bill_road').val(road);
			$('#bill_area').val(area);
			$('#bill_landmark').val(landmark);
			$('#bill_pincode').val(pincode);
			$('#bill_mobile').val(mobile);
			
		}else{
			$('#bill_house').val('');
			$('#bill_locality').val('');
			$('#bill_byelane').val('');
			$('#bill_wardno').val('');
			$('#bill_dag').val('');
			$('#bill_patta').val('');
			$('#bill_mouza').val('');
			$('#bill_society').val('');
			$('#bill_road').val('');
			$('#bill_area').val('');
			$('#bill_landmark').val('');
			$('#bill_pincode').val('');
			$('#bill_mobile').val('');
		}
	});
	/* ------------------------------------------------------ */
	$('#is_arrear_b').attr('disabled', 'disabled');
	<?php if($is_arrear_a=="Y"){ ?>
				$('#is_arrear_b').removeAttr('disabled');
	<?php } ?>
	$('.is_arrear_a').on('change', function(){
		if($(this).val() == 'N'){
			$('#is_arrear_b').attr('disabled', 'disabled');
		}else{
			$('#is_arrear_b').removeAttr('disabled');
		}			
	});
	
	<?php 	
		if($property_type!="R") echo "$('#residential').hide();";
		if($property_type!="I") echo "$('#institutional').hide();";
		if($property_type!="C") echo "$('#commercial').hide();";
		if($property_type!="IN") echo "$('#industrial').hide();";
		if(strlen($property_type)>3) echo "$('#other').show();"; else echo "$('#other').hide();";
		if(strlen($residential)>3) echo "$('#residential_other').show();"; else echo "$('#residential_other').hide();";
	?>
	function getval(sel){
		//alert(sel.value);
		var select_val=sel.value;		
		if(select_val == "R"){						
			$('#residential').show("fast");
			$('#institutional').hide();	
			$('#commercial').hide();	
			$('#industrial').hide();	
			$('#other').hide();
			$('#residential_other').hide("fast");
		}else if(select_val == "I"){						
			$('#institutional').show("fast");
			$('#residential').hide();
			$('#commercial').hide();	
			$('#industrial').hide();	
			$('#other').hide();
			$('#residential_other').hide();
		}else if(select_val == "C"){						
			$('#commercial').show("fast");
			$('#institutional').hide();
			$('#residential').hide();		
			$('#industrial').hide();	
			$('#other').hide();
			$('#residential_other').hide();
		}else if(select_val == "IND"){						
			$('#industrial').show("fast");
			$('#residential').hide();	
			$('#institutional').hide();	
			$('#commercial').hide();	
			$('#other').hide();
			$('#residential_other').hide();
		}else{
			$('#other').show("fast");
			$('#residential_other').hide();
			$('#residential').hide();	
			$('#institutional').hide();	
			$('#commercial').hide();	
			$('#industrial').hide();
		}
	}
	function getotherval(sel){
		//alert(sel.value);
		var select_val_other=sel.value;
		if(select_val_other == "O"){
			$('#residential_other').show("fast");
		}else{
			$('#residential_other').hide("fast");
		}			
	}
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>