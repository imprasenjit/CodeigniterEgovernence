<?php
$dept="pcb";
$form="21";
$table_name=getTableName($dept,$form);

	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	}

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where  user_id='$swr_id' and active='1'");
	if($q->num_rows>0){
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
	
		if($is_generator=="Y") $is_generator="YES";
		else $is_generator="NO";
		if($is_operator=="Y") $is_operator="YES";
		else $is_operator="NO";
		if($is_recycler=="Y") $is_recycler="YES";
		else $is_recycler="NO";
	
		$mode_of_manage_cap = wordwrap($mode_of_manage_cap, 50, "<br/>", true);
		$mode_of_manage_plant = wordwrap($mode_of_manage_plant, 50, "<br/>", true);
		$mode_of_manage_waste = wordwrap($mode_of_manage_waste, 50, "<br/>", true);		
		$mode_of_manage_arrange = wordwrap($mode_of_manage_arrange, 50, "<br/>", true);		
		$env_details = wordwrap($env_details, 50, "<br/>", true);		
		$incineration = wordwrap($incineration, 50, "<br/>", true);		
		$leachate = wordwrap($leachate, 50, "<br/>", true);		
		$fire_system = wordwrap($fire_system, 50, "<br/>", true);		
		$trans_arrangement = wordwrap($trans_arrangement, 50, "<br/>", true);		
		$facility_detail = wordwrap($facility_detail, 50, "<br/>", true);		
		$storage_detail = wordwrap($storage_detail, 50, "<br/>", true);		
		$process_desc = wordwrap($process_desc, 50, "<br/>", true);		
		$pcs_detail = wordwrap($pcs_detail, 50, "<br/>", true);		
		$health_details = wordwrap($health_details, 50, "<br/>", true);		
		$trans_arrange = wordwrap($trans_arrange, 50, "<br/>", true);		
	}
   
$form_name=$formFunctions->get_formName($dept,$form);
//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

if(!isset($css)){

$printContents='
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form  '.$form.'</title>
<style>
input, textarea { 
  text-transform: uppercase;
}
.header{
  width: 100%;
  height: 130px;
  font-weight: bold;
}
.main_body {
  height: 700px;
  width: 100%;
}
#form1 table {
  vertical-align: middle;
}
table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
</head>
<body>';
       
}else{
    $printContents='';
}

if(!empty($results["uain"])){
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
    <div style="text-align:center">
        <h4>'.$form_name.'</h4>
    </div>
	<br/>
    <table class="table table-bordered table-responsive">  
		<tr>
			<td colspan="2" align="center"><b>Part A: General (To be filled by all)</b></td>
		</tr>
		<tr>
			<td valign="top">1. (a) Name and address of the unit and location of facility :</td>
			<td>
				<table class="table table-bordered table-responsive"> 
				<tr>
						<td>Name</td>
						<td>'.strtoupper($unit_name).'</td>
				</tr>
				<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($b_street_name1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($b_street_name2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($b_dist).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($b_pincode).'</td>
				</tr>
				<tr>
						<td>Mobile</td>
						<td>+91'.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
						<td>Phone Number</td>
						<td>'.strtoupper($b_landline_std).' '.strtoupper($b_landline_no).'</td>
				</tr>
				
				<tr>
						<td>Email-id</td>
						<td>'.$b_email.'</td>
				</tr>
				</table>
			</td>
		</tr> 
       	<tr>
			<td valign="top">(b) Name of the occupier of the facility or operator of disposal facility with designation,Tel and e-mail:</td>
			<td>
				<table class="table table-bordered table-responsive"> 
					<tr>
							<td >Name</td>
							<td>'.strtoupper($occupier_add_name).'</td>
					</tr>
					<tr>
							<td>Designation</td>
							<td>'.strtoupper($occupier_add_desig).'</td>
					</tr>
					<tr>
							<td>Mobile No</td>
							<td>'.strtoupper($occupier_add_mob_no).'</td>
					</tr>
					<tr>
							<td>Email Id</td>
							<td>'.strtolower($occupier_add_email).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top" >(c) Authorisation required for (Please tick mark appropriate activity or activities)<font color="red">*</font>:
			</td>
			<td>
				'.strtoupper($auth_req_gen).'&nbsp;
				'.strtoupper($auth_req_col).'&nbsp;
				'.strtoupper($auth_req_str).'&nbsp;
				'.strtoupper($auth_req_transport).'&nbsp;
				'.strtoupper($auth_req_recept).'&nbsp;
				'.strtoupper($auth_req_reuse).'&nbsp;
				'.strtoupper($auth_req_recycle).'&nbsp;
				'.strtoupper($auth_req_rec).'&nbsp;
				'.strtoupper($auth_req_pre).'&nbsp;
				'.strtoupper($auth_req_co).'&nbsp;
				'.strtoupper($auth_req_uti).'&nbsp;
				'.strtoupper($auth_req_treat).'&nbsp;
				'.strtoupper($auth_req_disp).'&nbsp;
				'.strtoupper($auth_req_inci).'
			</td>
		</tr>
		<tr>
			<td valign="top">(d) In case of renewal of authorisation previous authorisation numbers and dates and provide copies of annual returns of last three years including the compliance reports with respect to the conditions of Prior Environmental Clearance, wherever applicable:</td>
			<td>Authorization no. :'.strtoupper($ren_auth_no).'<br/>
			   Authorization date :'.strtoupper($ren_auth_dt).'</td>
		</tr>
		<tr>
			<td valign="top" colspan="2">2.(a) Nature and quantity of waste handled per annum (in metric tonne or kilo litre):</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive"> 		
				<thead>
				<tr>
					<th width="5%" align="center">Sl No</th>
					<th width="25%" align="center">Particulars</th>
					<th width="25%" align="center">Nature</th>
					<th width="20%" align="center">Quantity</th>
					<th width="25%" align="center">Units</th>
				</tr>
				</thead>';					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
							if($row_1["unit"]=="MT"){
								$fullunit="in metric tonnes / month";
							}else if($row_1["unit"]=="K"){
								$fullunit="in kl / month";
							}else if($row_1["unit"]=="T"){
								$fullunit="in tonnes / month";
							}else{
								$fullunit="in numbers / month";
							} 
							
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["particular"]).'</td>
							<td>'.strtoupper($row_1["nature"]).'</td>
							<td>'.strtoupper($row_1["qty"]).'</td>
							<td>'.strtoupper($fullunit).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">(b) Nature and quantity of waste stored at any time (in metric tonne or kilo litre):</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive"> 		
				<thead>
				<tr>
					<th width="5%" align="center">Sl No</th>
					<th width="25%" align="center">Particulars</th>
					<th width="25%" align="center">Nature</th>
					<th width="20%" align="center">Quantity</th>
					<th width="25%" align="center">Units</th>
				</tr>
				</thead>';
					
					$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
						while($row_2=$part2->fetch_array()){
							if($row_2["unit"]=="MT"){
								$fullunit="in metric tonnes / month";
							}else if($row_2["unit"]=="K"){
								$fullunit="in kl / month";
							}else if($row_2["unit"]=="T"){
								$fullunit="in tonnes / month";
							}else{
								$fullunit="in numbers / month";
							} 
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_2["sl_no"]).'</td>
							<td>'.strtoupper($row_2["particulars"]).'</td>
							<td>'.strtoupper($row_2["nature"]).'</td>
							<td>'.strtoupper($row_2["qty"]).'</td>
							<td>'.strtoupper($fullunit).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">3. (a) Year of commissioning and commencement of production:</td>
			<td>'.strtoupper($year_of_comm).'</td>
		</tr>
		<tr>
			<td valign="top"> (b) Whether the industry works:</td>
			<td>'.strtoupper($ind_work_one).'<br/>
				'.strtoupper($ind_work_two).'<br/>
				'.strtoupper($ind_work_clock).'<br/>
			</td>
		</tr>
		<tr>
			<td valign="top">4. Provide copy of the Emergency Response Plan (ERP)</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td valign="top">5. Provide undertaking or declaration to comply with all provisions including the scope of submitting bank guarantee in the event of spillage, leakage or fire while handling the hazardous and other waste.</td>
			<td>Document is attached</td>
		</tr>  
		<tr>
			<td colspan="2" align="center"><b>Part B: To be filled by hazardous waste generators</b></td>
		</tr>
		<tr>
			<td>Are you a Generator of Hazardous Waste?</td>
			<td>'.strtoupper($is_generator).'</td>
		</tr>
		';
		if($is_generator=="YES"){
			$printContents=$printContents.'
		 <tr>
			<td colspan="2">1. (a) Products and by-products manufactured (names and product wise quantity per annum): </td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">		
				<thead>
				<tr>
					<th width="5%" align="center">Sl No</th>
					<th width="25%" align="center">Name</th>
					<th width="25%" align="center">Type</th>
					<th width="20%" align="center">Quantity</th>
					<th width="25%" align="center">Units</th>
				</tr>
				</thead>';
					
					$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
						while($row_3=$part3->fetch_array()){
							if($row_3["unit"]=="MT"){
								$fullunit="in metric tonnes / month";
							}else if($row_3["unit"]=="K"){
								$fullunit="in kl / month";
							}else if($row_3["unit"]=="T"){
								$fullunit="in tonnes / month";
							}else{
								$fullunit="in numbers / month";
							} 
							if($row_3["product_type"]=="P"){
								$product_type="Product";
							}else if($row_3["product_type"]=="B"){
								$product_type="By-Product";
							}
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_3["slno"]).'</td>
							<td>'.strtoupper($row_3["name"]).'</td>
							<td>'.strtoupper($product_type).'</td>
							<td>'.strtoupper($row_3["qty"]).'</td>
							<td>'.strtoupper($fullunit).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td>(b) Process description including process flow sheet indicating inputs and outputs (raw materials, chemicals, products, by-products, wastes, emissions, waste water etc.)</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td colspan="2">(c) Characteristics (waste-wise) and Quantity of waste generation per annum</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="5%" align="center">Sl No</th>
					<th width="25%" align="center">Particulars of Waste</th>
					<th width="25%" align="center">Characteristics</th>
					<th width="20%" align="center">Quantity</th>
					<th width="25%" align="center">Units</th>
				</tr>
				</thead>';
					
					$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
						while($row_4=$part4->fetch_array()){
							if($row_4["unit"]=="MT"){
								$fullunit="in metric tonnes / month";
							}else if($row_4["unit"]=="K"){
								$fullunit="in kl / month";
							}else if($row_4["unit"]=="T"){
								$fullunit="in tonnes / month";
							}else{
								$fullunit="in numbers / month";
							}
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_4["slno"]).'</td>
							<td>'.strtoupper($row_4["particulars"]).'</td>
							<td>'.strtoupper($row_4["characteristics"]).'</td>
							<td>'.strtoupper($row_4["qty"]).'</td>
							<td>'.strtoupper($fullunit).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">(d) Mode of management of (c) above:</td>
		</tr>
		<tr>
			<td width="60%" valign="top">i. Capacity and mode of secured storage within the plant:</td>
			<td>'.strtoupper($mode_of_manage_cap).'</td>
		</tr>
		<tr>
			<td valign="top">ii. Utilisation within the plant (provide details):</td>
			<td>'.strtoupper($mode_of_manage_plant).'</td>
		</tr>
		<tr>
			<td valign="top">iii. If not utilised within the plant, please provide details of what is done with this waste:</td>
			<td>'.strtoupper($mode_of_manage_waste).'</td>
		</tr>
		<tr>
			<td valign="top">iv. Arrangement for transportation to actual users/ TSDF:</td>
			<td>'.strtoupper($mode_of_manage_arrange).'</td>
		</tr>
		<tr>
			<td valign="top">(e) Details of the environmental safeguards and environmental facilities provided for safe handling of all the wastes at point (c) above:</td>
			<td>'.strtoupper($env_details).'</td>
		</tr>
		<tr>
			<td colspan="2">2. Hazardous and other wastes generated as per these rules from storage of hazardous chemicals as defined under the Manufacture, Storage and Import of Hazardous Chemicals Rules, 1989 </td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="5%" align="center">Sl No</th>
					<th width="25%" align="center">Particulars</th>
					<th width="25%" align="center">Nature</th>
					<th width="20%" align="center">Quantity</th>
					<th width="25%" align="center">Units</th>
				</tr>
				</thead>';
					
					$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
						while($row_5=$part5->fetch_array()){
							if($row_5["unit"]=="MT"){
								$fullunit="in metric tonnes / month";
							}else if($row_5["unit"]=="K"){
								$fullunit="in kl / month";
							}else if($row_5["unit"]=="T"){
								$fullunit="in tonnes / month";
							}else{
								$fullunit="in numbers / month";
							}
							
							if($row_5["nature_type"]=="HW"){
								$nature_type="Hazardous Waste";
							}else if($row_5["nature_type"]=="OW"){
								$nature_type="Other Waste";
							}
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_5["slno"]).'</td>
							<td>'.strtoupper($row_5["particulars"]).'</td>
							<td>'.strtoupper($nature_type).'</td>
							<td>'.strtoupper($row_5["qty"]).'</td>
							<td>'.strtoupper($fullunit).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>';
			}
			$printContents=$printContents.'
			<tr>
			<td colspan="2" align="center"><b>Part C: To be filled by Treatment, storage and disposal facility operators</b></td>
		</tr>
		<tr>
			<td>Are you a Treatment, storage and disposal facility operators?</td>
			<td>'.strtoupper($is_operator).'</td>
		</tr>';
			if($is_operator=="YES"){
				$printContents=$printContents.'
		<tr>
			<td colspan="2">1. Provide details of the facility including:</td>
		</tr>
		<tr>
			<td width="60%" valign="top">(i). Location of site with layout map:</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td colspan="2" valign="top">(ii). Safe storage of the waste and storage capacity:</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive"> 			
				<thead>
				<tr>
					<th width="10%" align="center">Sl No</th>
					<th width="30%" align="center">Particulars of Waste</th>
					<th width="30%" align="center">Capacity</th>
					<th width="35%" align="center">Units</th>
				</tr>
				</thead>';
					
					$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
						while($row_6=$part6->fetch_array()){
							if($row_6["unit"]=="MT"){
								$fullunit="in metric tonnes / month";
							}else if($row_6["unit"]=="K"){
								$fullunit="in kl / month";
							}else if($row_6["unit"]=="T"){
								$fullunit="in tonnes / month";
							}else{
								$fullunit="in numbers / month";
							}
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_6["slno"]).'</td>
							<td>'.strtoupper($row_6["particulars"]).'</td>
							<td>'.strtoupper($row_6["capacity"]).'</td>
							<td>'.strtoupper($fullunit).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td>(iii) The treatment processes and their capacities: </td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td>(iv) Secured landfills: </td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td valign="top">(v). Incineration , if any: </td>
			<td>'.strtoupper($incineration).'</td>
		</tr>
		<tr>
			<td valign="top">(vi) Leachate collection and treatment system: </td>
			<td>'.strtoupper($leachate).'</td>
		</tr>
		<tr>
			<td valign="top">(vii) Fire fighting systems: </td>
			<td>'.strtoupper($fire_system).'</td>
		</tr>
		<tr>
			<td>(viii) Environmental management plan including monitoring:</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td valign="top">(ix) Arrangement for transportation of waste from generators: </td>
			<td>'.strtoupper($trans_arrangement).'</td>
		</tr>
		<tr>
			<td valign="top">2. Provide details of any other activities undertaken at the Treatment, storage and disposal facility site: </td>
			<td>'.strtoupper($facility_detail).'</td>
		</tr>
		<tr>
			<td>3. Attach a copy of prior Environmental Clearance: </td>
			<td>Document is attached</td>
		</tr>';
			}
			$printContents=$printContents.'
	
		<tr>
			<td colspan="2" align="center"><b>Part D: To be filled by recyclers or pre-processors or co-processors or users of hazardous or other wastes</b></td>
		</tr>
		<tr>
			<td>Are you a recyclers or pre-processors or co-processors or users of hazardous or other wastes?</td>
			<td>'.strtoupper($is_recycler).'</td>
		</tr>';
			if($is_recycler=="YES"){
				$printContents=$printContents.'
		<tr>
			<td colspan="2">1. Nature and quantity of different wastes received per annum from domestic sources or imported or both:</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="5%" align="center">Sl No</th>
					<th width="25%" align="center">Particulars</th>
					<th width="25%" align="center">Nature</th>
					<th width="20%" align="center">Quantity</th>
					<th width="25%" align="center">Units</th>
					<th width="25%" align="center">Source</th>
				</tr>
				</thead>';
					
					$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
						while($row_7=$part7->fetch_array()){
							if($row_7["source"]=="D"){
								$source="Domestic";
							}else if($row_7["source"]=="I"){
								$source="Imported";
							}else{
								$source="Both";
							}
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_7["slno"]).'</td>
							<td>'.strtoupper($row_7["particulars"]).'</td>
							<td>'.strtoupper($row_7["nature"]).'</td>
							<td>'.strtoupper($row_7["qty"]).'</td>
							<td>'.strtoupper($row_7["unit"]).'</td>
							<td>'.strtoupper($source).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">2.Installed capacity as per registration issued by the District Industries Centre or any other authorised Government agency. Provide copy</td>
		</tr>
		<tr>
			<td width="60%" valign="top">Quantity</td>
			<td>'.strtoupper($ins_capacity_qty).'</td>
		</tr>
		<tr>
			<td valign="top">Unit</td>
			<td>'.strtoupper($ins_capacity_unit).'</td>
		</tr>
		<tr>
			<td colspan="2">Document is attached</td>
		</tr>
		<tr>
			<td valign="top">3. Provide details of secured storage of wastes including the storage capacity:</td>
			<td>'.strtoupper($storage_detail).'</td>
		</tr>
		<tr>
			<td colspan="2">Document is attached</td>
		</tr>
		<tr>
			<td valign="top">4. Process description including process flow sheet indicating equipment details, inputs and outputs (input wastes, chemicals, products, by-products, waste generated, emissions, waste water, etc.):</td>
			<td>'.strtoupper($process_desc).'</td>
		</tr>
		<tr>
			<td colspan="2">Document is attached</td>
		</tr>
		<tr>
			<td colspan="2">5. Provide details of end users of products or by-products:</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="5%" align="center">Sl No</th>
					<th width="25%" align="center">Name</th>
					<th width="25%" align="center">Type</th>
					<th width="20%" align="center">Quantity</th>
					<th width="25%" align="center">Units</th>
				</tr>
				</thead>';
					
					$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
						while($row_8=$part8->fetch_array()){
							if($row_8["unit"]=="MT"){
								$fullunit="in metric tonnes / month";
							}else if($row_8["unit"]=="K"){
								$fullunit="in kl / month";
							}else if($row_8["unit"]=="T"){
								$fullunit="in tonnes / month";
							}else{
								$fullunit="in numbers / month";
							}
							if($row_8["product_type"]=="P"){
								$product_type="Product";
							}else if($row_8["product_type"]=="B"){
								$product_type="By-Product";
							}
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_8["slno"]).'</td>
							<td>'.strtoupper($row_8["name"]).'</td>
							<td>'.strtoupper($product_type).'</td>
							<td>'.strtoupper($row_8["qty"]).'</td>
							<td>'.strtoupper($fullunit).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td>6. Provide details of pollution control systems such as Effluent Treatment Plant, scrubbers, etc. including mode of disposal of waste:</td>
			<td>'.strtoupper($pcs_detail).'</td>
		</tr>
		<tr>
			<td colspan="2">Document is attached</td>
		</tr>
		<tr>
			<td valign="top">7. Provide details of occupational health and safety measures:</td>
			<td>'.strtoupper($health_details).'</td>
		</tr>
		<tr>
			<td colspan="2">Document is attached</td>
		</tr>
		<tr>
			<td>8.(a) Has the facility been set up as per Central Pollution Control Board guidelines?</td>
			<td>'.strtoupper($pcb_guidelines).'</td>
		</tr>
		<tr>
			<td>(b) If yes, provide a report on the compliance with the guidelines:</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td valign="top">9. Arrangements for transportation of waste to the facility:</td>
			<td>'.strtoupper($trans_arrange).'</td>
		</tr>
		<tr>
			<td colspan="2">Document is attached</td>
		</tr>';
			}
						
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 			
       
		<tr>
            <td>Place: <b>'.strtoupper($dist).'</b><br/> Date : <b>'.strtoupper($results["sub_date"]).'</b></td>
            <td align="right">
                Signature : <b>'.strtoupper($key_person).'</b><br/>
                Designation : <b>'.strtoupper($status_applicant).'</b></td>
        </tr> 
	</table>';

?>