<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="26";
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
		$applicant_ref_no=$results["applicant_ref_no"];$im_ex_country=$results["im_ex_country"];$spec_hndl_req=$results["spec_hndl_req"];$ship_date=$results["ship_date"];$total_qn=$results["total_qn"];$trans_means=$results["trans_means"];$transfer_date=$results["transfer_date"];$rep_sign=$results["rep_sign"];$export_date=$results["export_date"];$exporter_sign=$results["exporter_sign"];$exporter_name2=$results["exporter_name2"];$received_by=$results["received_by"];$quantity_rcvd=$results["quantity_rcvd"];$rcvd_date=$results["rcvd_date"];$importer_name=$results["importer_name"];$importer_sign=$results["importer_sign"];$recovery_method=$results["recovery_method"];$r_code=$results["r_code"];$employed_tech=$results["employed_tech"];$importer_sign2=$results["importer_sign2"];$import_date2=$results["import_date2"];
		
		if(!empty($results["exporter"])){
			$exporter=json_decode($results["exporter"]);
			$exporter_name=$exporter->name;$exporter_sn1=$exporter->sn1;$exporter_sn2=$exporter->sn2;$exporter_vt=$exporter->vt;$exporter_dist=$exporter->dist;$exporter_pin=$exporter->pin;$exporter_mob=$exporter->mob;$exporter_email=$exporter->email;$exporter_cp=$exporter->cp;
		}else{
			$exporter_name="";$exporter_sn1="";$exporter_sn2="";$exporter_vt="";$exporter_dist="";$exporter_pin="";$exporter_mob="";$exporter_email="";$exporter_cp="";
		}
		if(!empty($results["generator"])){
			$generator=json_decode($results["generator"]);
			$generator_name=$generator->name;$generator_sn1=$generator->sn1;$generator_sn2=$generator->sn2;$generator_vt=$generator->vt;$generator_pin=$generator->pin;$generator_dist=$generator->dist;$generator_mob=$generator->mob;$generator_email=$generator->email;$generator_cp=$generator->cp;$generator_sg=$generator->sg;
		}else{
			$generator_name="";$generator_sn1="";$generator_sn2="";$generator_vt="";$generator_dist="";$generator_pin="";$generator_mob="";$generator_email="";$generator_cp="";$generator_sg="";
		}
		if(!empty($results["trader"])){
			$trader=json_decode($results["trader"]);
			$trader_name=$trader->name;$trader_sn1=$trader->sn1;$trader_sn2=$trader->sn2;$trader_vt=$trader->vt;$trader_pin=$trader->pin;$trader_mob=$trader->mob;$trader_dist=$trader->dist;$trader_email=$trader->email;$trader_cp=$trader->cp;
		}else{
			$trader_name="";$trader_sn1="";$trader_sn2="";$trader_vt="";$trader_dist="";$trader_pin="";$trader_mob="";$trader_email="";$trader_cp="";
		}
		if(!empty($results["actual"])){
			$actual=json_decode($results["actual"]);
			$actual_name=$actual->name;$actual_sn1=$actual->sn1;$actual_sn2=$actual->sn2;$actual_vt=$actual->vt;$actual_dist=$actual->dist;$actual_pin=$actual->pin;$actual_mob=$actual->mob;$actual_email=$actual->email;
		}else{
			$actual_name="";$actual_sn1="";$actual_sn2="";$actual_vt="";$actual_dist="";$actual_pin="";$actual_mob="";$actual_email="";
		}
		if(!empty($results["waste"])){
			$waste=json_decode($results["waste"]);
			$waste_qn=$waste->qn;$waste_phychar=$waste->phychar;$waste_bn=$waste->bn;$waste_ship_name=$waste->ship_name;$waste_cls=$waste->cls;$waste_no=$waste->no;$waste_hnum=$waste->hnum;$waste_ynum=$waste->ynum;$waste_itc=$waste->itc;$waste_customs=$waste->customs;$waste_other=$waste->other;
		}else{
			$waste_qn="";$waste_phychar="";$waste_bn="";$waste_ship_name="";$waste_cls="";$waste_no="";$waste_hnum="";$waste_ynum="";$waste_itc="";$waste_customs="";$waste_other="";
		}
		if(!empty($results["receiver"])){
			$receiver=json_decode($results["receiver"]);
			$receiver_authtype=$receiver->authtype;$receiver_no=$receiver->no;
		}else{
			$receiver_authtype="";$receiver_no="";
		}
		if(!empty($results["transporter"])){
			$transporter=json_decode($results["transporter"]);
			$transporter_name=$transporter->name;$transporter_sn1=$transporter->sn1;$transporter_sn2=$transporter->sn2;$transporter_vt=$transporter->vt;$transporter_pin=$transporter->pin;$transporter_dist=$transporter->dist;$transporter_mob=$transporter->mob;$transporter_email=$transporter->email;$transporter_cp=$transporter->cp;$transporter_regno=$transporter->regno;
		}else{
			$transporter_name="";$transporter_sn1="";$transporter_sn2="";$transporter_vt="";$transporter_dist="";$transporter_pin="";$transporter_mob="";$transporter_email="";$transporter_cp="";$transporter_regno="";
		}
	}else{ 
		$form_id="";
		$exporter_name="";$exporter_sn1="";$exporter_sn2="";$exporter_vt="";$exporter_dist="";$exporter_pin="";$exporter_mob="";$exporter_email="";$exporter_cp="";
		$generator_name="";$generator_sn1="";$generator_sn2="";$generator_vt="";$generator_dist="";$generator_pin="";$generator_mob="";$generator_email="";$generator_cp="";$generator_sg="";
		$trader_name="";$trader_sn1="";$trader_sn2="";$trader_vt="";$trader_dist="";$trader_pin="";$trader_mob="";$trader_email="";$trader_cp="";
		$actual_name="";$actual_sn1="";$actual_sn2="";$actual_vt="";$actual_dist="";$actual_pin="";$actual_mob="";$actual_email="";
		$applicant_ref_no="";$im_ex_country="";
		$waste_qn="";$waste_phychar="";$waste_bn="";$waste_ship_name="";$waste_cls="";$waste_no="";$waste_hnum="";$waste_ynum="";$waste_itc="";$waste_customs="";$waste_other="";
		$receiver_authtype="";$receiver_no="";
		$spec_hndl_req="";$ship_date="";$total_qn="";
		$transporter_name="";$transporter_sn1="";$transporter_sn2="";$transporter_vt="";$transporter_dist="";$transporter_pin="";$transporter_mob="";$transporter_email="";$transporter_cp="";$transporter_regno="";
		$trans_means="";$transfer_date="";$rep_sign="";$export_date="";$exporter_sign="";$exporter_name2="";
		$received_by="";$quantity_rcvd="";$rcvd_date="";$importer_name="";$importer_sign="";$recovery_method="";$r_code="";$employed_tech="";$importer_sign2="";$import_date2="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$applicant_ref_no=$results["applicant_ref_no"];$im_ex_country=$results["im_ex_country"];$spec_hndl_req=$results["spec_hndl_req"];$ship_date=$results["ship_date"];$total_qn=$results["total_qn"];$trans_means=$results["trans_means"];$transfer_date=$results["transfer_date"];$rep_sign=$results["rep_sign"];$export_date=$results["export_date"];$exporter_sign=$results["exporter_sign"];$exporter_name2=$results["exporter_name2"];$received_by=$results["received_by"];$quantity_rcvd=$results["quantity_rcvd"];$rcvd_date=$results["rcvd_date"];$importer_name=$results["importer_name"];$importer_sign=$results["importer_sign"];$recovery_method=$results["recovery_method"];$r_code=$results["r_code"];$employed_tech=$results["employed_tech"];$importer_sign2=$results["importer_sign2"];$import_date2=$results["import_date2"];
	
	if(!empty($results["exporter"])){
		$exporter=json_decode($results["exporter"]);
		$exporter_name=$exporter->name;$exporter_sn1=$exporter->sn1;$exporter_sn2=$exporter->sn2;$exporter_vt=$exporter->vt;$exporter_dist=$exporter->dist;$exporter_pin=$exporter->pin;$exporter_mob=$exporter->mob;$exporter_email=$exporter->email;$exporter_cp=$exporter->cp;
	}else{
		$exporter_name="";$exporter_sn1="";$exporter_sn2="";$exporter_vt="";$exporter_dist="";$exporter_pin="";$exporter_mob="";$exporter_email="";$exporter_cp="";
	}
	if(!empty($results["generator"])){
		$generator=json_decode($results["generator"]);
		$generator_name=$generator->name;$generator_sn1=$generator->sn1;$generator_sn2=$generator->sn2;$generator_vt=$generator->vt;$generator_pin=$generator->pin;$generator_dist=$generator->dist;$generator_mob=$generator->mob;$generator_email=$generator->email;$generator_cp=$generator->cp;$generator_sg=$generator->sg;
	}else{
		$generator_name="";$generator_sn1="";$generator_sn2="";$generator_vt="";$generator_dist="";$generator_pin="";$generator_mob="";$generator_email="";$generator_cp="";$generator_sg="";
	}
	if(!empty($results["trader"])){
		$trader=json_decode($results["trader"]);
		$trader_name=$trader->name;$trader_sn1=$trader->sn1;$trader_sn2=$trader->sn2;$trader_vt=$trader->vt;$trader_pin=$trader->pin;$trader_mob=$trader->mob;$trader_dist=$trader->dist;$trader_email=$trader->email;$trader_cp=$trader->cp;
	}else{
		$trader_name="";$trader_sn1="";$trader_sn2="";$trader_vt="";$trader_dist="";$trader_pin="";$trader_mob="";$trader_email="";$trader_cp="";
	}
	if(!empty($results["actual"])){
		$actual=json_decode($results["actual"]);
		$actual_name=$actual->name;$actual_sn1=$actual->sn1;$actual_sn2=$actual->sn2;$actual_vt=$actual->vt;$actual_dist=$actual->dist;$actual_pin=$actual->pin;$actual_mob=$actual->mob;$actual_email=$actual->email;
	}else{
		$actual_name="";$actual_sn1="";$actual_sn2="";$actual_vt="";$actual_dist="";$actual_pin="";$actual_mob="";$actual_email="";
	}
	if(!empty($results["waste"])){
		$waste=json_decode($results["waste"]);
		$waste_qn=$waste->qn;$waste_phychar=$waste->phychar;$waste_bn=$waste->bn;$waste_ship_name=$waste->ship_name;$waste_cls=$waste->cls;$waste_no=$waste->no;$waste_hnum=$waste->hnum;$waste_ynum=$waste->ynum;$waste_itc=$waste->itc;$waste_customs=$waste->customs;$waste_other=$waste->other;
	}else{
		$waste_qn="";$waste_phychar="";$waste_bn="";$waste_ship_name="";$waste_cls="";$waste_no="";$waste_hnum="";$waste_ynum="";$waste_itc="";$waste_customs="";$waste_other="";
	}
	if(!empty($results["receiver"])){
		$receiver=json_decode($results["receiver"]);
		$receiver_authtype=$receiver->authtype;$receiver_no=$receiver->no;
	}else{
		$receiver_authtype="";$receiver_no="";
	}
	if(!empty($results["transporter"])){
		$transporter=json_decode($results["transporter"]);
		$transporter_name=$transporter->name;$transporter_sn1=$transporter->sn1;$transporter_sn2=$transporter->sn2;$transporter_vt=$transporter->vt;$transporter_pin=$transporter->pin;$transporter_dist=$transporter->dist;$transporter_mob=$transporter->mob;$transporter_email=$transporter->email;$transporter_cp=$transporter->cp;$transporter_regno=$transporter->regno;
	}else{
		$transporter_name="";$transporter_sn1="";$transporter_sn2="";$transporter_vt="";$transporter_dist="";$transporter_pin="";$transporter_mob="";$transporter_email="";$transporter_cp="";$transporter_regno="";
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
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>				
							</ul>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									    <td colspan="4">1. Exporter (Name and Address):</td>
									</tr>
									<tr>
                                        <td width="25%">Name:</td>
									     <td width="25%"><input type="text" name="exporter[name]" value="<?php echo $exporter_name; ?>" validate="letters" class="form-control text-uppercase" ></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" name="exporter[sn1]" value="<?php echo $exporter_sn1; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" name="exporter[sn2]" value="<?php echo $exporter_sn2; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="exporter[vt]" value="<?php echo $exporter_vt; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($exporter_dist);?>"   name="exporter[dist]">    
                                        </td>
										
										<td>Pincode:</td>
										<td><input type="text" name="exporter[pin]" maxlength="6" value="<?php echo $exporter_pin; ?>" validate="pincode" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" maxlength="10" name="exporter[mob]" value="<?php echo $exporter_mob; ?>" validate="mobileNumber" class="form-control text-uppercase"></td>
									    <td>Email Id:</td>
										<td><input type="email" name="exporter[email]" value="<?php echo $exporter_email; ?>" validate="jsonObj" class="form-control "></td>
									</tr>
									<tr>
									    <td>Contact person:</td>
										<td><input type="text" name="exporter[cp]" value="<?php echo $exporter_cp; ?>" validate="jsonObj"  class="form-control text-uppercase"></td>
									    <td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">2. Generator(s) of the waste (Name and Address):</td>
									</tr>
									<tr>
									     <td width="25%">Name:</td>
									     <td width="25%"><input type="text" name="generator[name]" value="<?php echo $generator_name; ?>" class="form-control text-uppercase" validate="letters"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" name="generator[sn1]" value="<?php echo $generator_sn1; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" name="generator[sn2]" value="<?php echo $generator_sn2; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="generator[vt]" value="<?php echo $generator_vt; ?>"validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($generator_dist);?>"   name="generator[dist]">    
                                        </td>
										
										<td>Pincode:</td>
										<td><input type="text" name="generator[pin]" maxlength="6" value="<?php echo $generator_pin; ?>" validate="pincode" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="generator[mob]" maxlength="10" value="<?php echo $generator_mob; ?>" validate="mobileNumber" class="form-control text-uppercase"></td>
									    <td>Email Id:</td>
										<td><input type="email" name="generator[email]" value="<?php echo $generator_email; ?>" validate="jsonObj" class="form-control "></td>
									</tr><tr>
									    <td>Contact person:</td>
										<td><input type="text" name="generator[cp]" value="<?php echo $generator_cp; ?>" validate="jsonObj"  validate="specialChar" class="form-control text-uppercase"></td>
									    <td>Site of generation:</td>
										<td><input type="text" name="generator[sg]" value="<?php echo $generator_sg; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td colspan="4">3. Importer or Actual user (Name and Address):</td>
									</tr>
									<tr>
									     <td width="25%">Name:</td>
									     <td width="25%"><input type="text" name="unit_name" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase" ></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" name="b_street_name1" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" name="b_street_name2" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="b_vill" disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
										<td><input type="text" name="b_dist" disabled value="<?php echo $b_dist; ?>"class="form-control text-uppercase"></td>
										<td>Pincode:</td>
										<td><input type="text" name="b_pincode" maxlength="6" disabled value="<?php echo $b_pincode; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="b_mobile_no" maxlength="10" disabled value="<?php echo $b_mobile_no; ?>" class="form-control text-uppercase" ></td>
									    <td>Email Id:</td>
										<td><input type="email" name="b_email" disabled value="<?php echo $b_email; ?>" class="form-control" ></td>
									</tr>
									<tr>
									    <td>Contact person:</td>
										<td><input class="form-control text-uppercase" type="text" name="key_person" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									    <td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">4.i) Trader (Name and Address):</td>
									</tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" name="trader[name]" value="<?php echo $trader_name; ?>" validate="letters" class="form-control text-uppercase"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" name="trader[sn1]" value="<?php echo $trader_sn1; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" name="trader[sn2]" value="<?php echo $trader_sn2; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="trader[vt]" value="<?php echo $trader_vt; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($trader_dist);?>"   name="trader[dist]">    
                                        </td>
										
										<td>Pincode:</td>
										<td><input type="text" name="trader[pin]" maxlength="6" value="<?php echo $trader_pin; ?>" validate="pincode" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="trader[mob]" value="<?php echo $trader_mob; ?>" validate="mobileNumber" maxlength="10" class="form-control text-uppercase"></td>
									    <td>Email Id:</td>
										<td><input type="email" name="trader[email]" value="<?php echo $trader_email; ?>" validate="jsonObj" class="form-control "></td>
									</tr>
									<tr>
									    <td>Contact person:</td>
										<td><input class="form-control text-uppercase" type="text" name="trader[cp]" value="<?php echo $trader_cp; ?>"  ></td>
									    <td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">ii) Details of actual user (Name, Address, Telephone and email)</td>
									</tr>
									<tr>
									     <td width="25%">Name:</td>
									     <td width="25%"><input class="form-control text-uppercase" type="text" name="actual[name]" value="<?php echo $actual_name; ?>" validate="letters" ></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input class="form-control text-uppercase" type="text" name="actual[sn1]" value="<?php echo $actual_sn1; ?>" validate="jsonObj" ></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input class="form-control text-uppercase" type="text" name="actual[sn2]" value="<?php echo $actual_sn2; ?>" validate="jsonObj" ></td>
										<td>Village/Town:</td>
										<td><input class="form-control text-uppercase" type="text" name="actual[vt]" value="<?php echo $actual_vt; ?>" validate="jsonObj"></td>
									</tr>
									<tr>
									    <td>District:</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($actual_dist);?>"   name="actual[dist]">    
                                        </td>
										
										<td>Pincode:</td>
										<td><input type="text" name="actual[pin]" value="<?php echo $actual_pin; ?>" class="form-control" maxlength="6" validate="pincode"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="actual[mob]" value="<?php echo $actual_mob; ?>" class="form-control" maxlength="10" validate="mobileNumber" ></td>
										<td>Email Id:</td>
										<td><input type="email" name="actual[email]" value="<?php echo $actual_email; ?>" validate="jsonObj" class="form-control"></td>
									</tr>
									<tr>
									    <td>5. Corresponding to applicant Ref. No., If any:</td>
										<td><input type="text" name="applicant_ref_no" value="<?php echo $applicant_ref_no; ?>" class="form-control text-uppercase"></td>
										<td>6. Bill of lading:</td>
										<td>Upload later in Upload section</td>
									</tr>									
									<tr>
									    <td>7. Country of import/export:</td>
										<td><input class="form-control text-uppercase" type="text" name="im_ex_country" value="<?php echo $im_ex_country; ?>"></td>
										<td></td>
										<td></td>
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
										<td colspan="4">8. General description of waste:</td>
									</tr>
									<tr>
									     <td width="25%">(a) Quantity:</td>
									     <td width="25%"><input type="text" name="waste[qn]" value="<?php echo $waste_qn; ?>" class="form-control text-uppercase" validate="onlyNumbers" ></td>
									     <td width="25%">(b) Physical characteristics:</td>
									     <td width="25%"><input type="text" name="waste[phychar]" value="<?php echo $waste_phychar; ?>"  class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>(c) Chemical composition of waste (attach details), where applicable:</td>
										<td>Upload later in Upload Section</td>
										<td>(d) Basel No.:</td>
										<td><input type="text" name="waste[bn]" value="<?php echo $waste_bn; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>(e) UN Shipping name:</td>
										<td><input type="text" name="waste[ship_name]" value="<?php echo $waste_ship_name; ?>" class="form-control text-uppercase"></td>
										<td>(f) UN Class:</td>
										<td><input class="form-control text-uppercase" type="text" name="waste[cls]" value="<?php echo $waste_cls; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>(g) UN No:</td>
										<td><input type="text" name="waste[no]" value="<?php echo $waste_no; ?>" class="form-control text-uppercase"></td>
										<td>(h) H Number:</td>
										<td><input type="text" name="waste[hnum]" value="<?php echo $waste_hnum; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>(i) Y Number:</td>
										<td><input type="text" name="waste[ynum]" value="<?php echo $waste_ynum; ?>" class="form-control text-uppercase"></td>
										<td>(j) ITC (HS):</td>
										<td><input type="text" name="waste[itc]" value="<?php echo $waste_itc; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>(k) Customs Code (H.S.):</td>
										<td><input type="text" name="waste[customs]" value="<?php echo $waste_customs; ?>" class="form-control text-uppercase"></td>
										<td>(l) Other (specify):</td>
										<td><input type="text" name="waste[other]" value="<?php echo $waste_other; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>9.(a) Type of packages:</td>
										<td><input type="text" name="receiver[authtype]" value="<?php echo $receiver_authtype; ?>" class="form-control text-uppercase"></td>
										<td>(b) Number:</td>
										<td><input type="text" name="receiver[no]" value="<?php echo $receiver_no; ?>" validate="onlyNumbers" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>10. Special handling requirements including emergency provision in case of accidents:</td>
										<td><input type="text" name="spec_hndl_req" value="<?php echo $spec_hndl_req; ?>" class="form-control text-uppercase"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">11. Movement subject to single/multiple consignment<br/>
										In case of multiple movement-</td>
									</tr>
									<tr>
									    <td>(a) Expected dates of each shipment or expected frequency of the shipments:</td>
										<td><input type="text" readonly="readonly" name="ship_date" value="<?php echo $ship_date; ?>" class="dob form-control  text-uppercase"></td>
										<td>(b) Estimated total quantity and quantities for each individual shipment:</td>
										<td><input type="text" name="total_qn" value="<?php echo $total_qn; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4">12. (a)Transporter of waste (Name and Address):</td>
									</tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" name="transporter[name]" value="<?php echo $transporter_name; ?>" validate="jsonObj" validate="letters" class="form-control text-uppercase"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" name="transporter[sn1]" value="<?php echo $transporter_sn1; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" name="transporter[sn2]" value="<?php echo $transporter_sn2; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="transporter[vt]" value="<?php echo $transporter_vt; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($transporter_dist);?>"   name="transporter[dist]">    
                                        </td>
										
										<td>Pincode:</td>
										<td><input type="text" name="transporter[pin]" value="<?php echo $transporter_pin; ?>" validate="pincode" maxlength="6" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="transporter[mob]" value="<?php echo $transporter_mob; ?>" validate="mobileNumber" maxlength="10" class="form-control text-uppercase"></td>
										<td>Email Id:</td>
										<td><input type="email" name="transporter[email]" value="<?php echo $transporter_email; ?>" validate="jsonObj" class="form-control"></td>
									</tr>
									<tr>
									    <td>Contact person:</td>
										<td><input type="text" name="transporter[cp]" value="<?php echo $transporter_cp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td>Registration number:</td>
										<td><input type="text" name="transporter[regno]" value="<?php echo $transporter_regno; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>(b) Means of transport (road, rail, inland waterway, sea, air):</td>
										<td><input type="text" name="trans_means" value="<?php echo $trans_means; ?>" class="form-control text-uppercase"></td>
										<td>(c) Date of Transfer:</td>
										<td><input type="text" readonly="readonly" name="transfer_date" value="<?php echo $transfer_date; ?>" class="dob form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>(d) Signature of Carrier’s representative:</td>
										<td><input type="text" name="rep_sign" value="<?php echo $rep_sign; ?>" class="form-control text-uppercase"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">13. Exporter’s declaration for hazardous and other waste:</td>
									</tr>
									<tr>
										<td colspan="4">I certify that the information in Sl. Nos. 1 to 12 above are complete and correct to my best knowledge. I also certify that legally-enforceable written contractual obligations have been entered into and are in force covering the transboundary movement regulations/rules.</td>
									</tr>
									<tr>
										<td>Date:</td>
										<td><input type="text" readonly="readonly" name="export_date" value="<?php echo $export_date; ?>" class="dob form-control text-uppercase"></td>
										<td>Signature:</td>
										<td><input type="text" name="exporter_sign" value="<?php echo $exporter_sign; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Name:</td>
										<td><input type="text" name="exporter_name2" value="<?php echo $exporter_name2; ?>" validate="letters" class="form-control text-uppercase"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4"><b>TO BE COMPLETED BY IMPORTER (ACTUAL USER OR TRADER)</b></td>
									</tr>
									<tr>
										<td>14. (a)Shipment received by importer/ actual user/trader:</td>
										<td><input type="text" name="received_by" value="<?php echo $received_by; ?>" class="form-control text-uppercase"></td>
										<td>(b)Quantity received(Kg/litres):</td>
										<td><input type="text" name="quantity_rcvd" value="<?php echo $quantity_rcvd; ?>" validate="decimal" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td >Date:</td>
										<td><input type="text" readonly="readonly" name="rcvd_date" value="<?php echo $rcvd_date; ?>" class="dob form-control text-uppercase"></td>
										<td>Name:</td>
										<td><input type="text" name="importer_name" value="<?php echo $importer_name; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Signature:</td>
										<td> <input type="text" name="importer_sign" value="<?php echo $importer_sign; ?>" class="form-control text-uppercase"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>15. (a)Methods of recovery:</td>
										<td><input type="text" name="recovery_method" value="<?php echo $recovery_method; ?>" class="form-control text-uppercase"></td>
										<td>(b) R code: <span class="mandatory_field">*</span></td>
										<td><input type="text" name="r_code" value="<?php echo $r_code; ?>" class="form-control text-uppercase" required></td>
									</tr>
									<tr>
										<td> (c)Technology employed (Attached details later in Upload Section if necessary):</td>
										<td><input type="text" name="employed_tech" value="<?php echo $employed_tech; ?>" class="form-control text-uppercase"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">
										16. I certify that nothing other than declared goods covered as per these rules is intended to be imported in the above referred consignment and will be recycled /utilized.</td>
									</tr>
									<tr>
										<td>Signature:</td>
										<td><input type="text" name="importer_sign2" value="<?php echo $importer_sign2; ?>" class="form-control text-uppercase"></td>
										<td>Date:</td>
										<td><input type="text" readonly="readonly" name="import_date2" value="<?php echo $import_date2;?>" class="dob form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>17. SPECIFIC CONDITIONS ON CONSENTING TO THE MOVEMENT if applicable.</td>
										<td>Upload later in Upload Section</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today)); ?></label><br/>
														Place: <label><?php echo strtoupper($dist)?></label>
										</td>
										<td colspan="2" align="right">Signature:<label><?php echo strtoupper($key_person)?>
										</label><br/>Designation:<label><?php echo strtoupper($status_applicant)?></label> </td>
																					
									</tr>			
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>