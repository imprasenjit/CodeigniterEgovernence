<?php
/************************** FORM 1 CTE *********************************/
/**************************  SAVE FORM 1 START *********************************/
/***********************************************************/
/***********************************************************/

if(isset($_POST["save1a"])){		
	$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
		$file=$plan_details_decode->upload;
	}else{
		$plan_details=NULL;$file="NA";
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){			
		$query=$pcb->query("insert into pcb_form1(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date')") OR die("Error: ".$pcb->error);
		$form_id=$pcb->insert_id;
		$query2=$pcb->query("insert into pcb_form1_part1(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		$query3=$pcb->query("insert into pcb_form1_part2(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		$query4=$pcb->query("insert into pcb_form1_upload(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];				
		$query=$pcb->query("update pcb_form1 set sub_date='$today', revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date' where form_id='$form_id'") OR die("Error: ".$pcb->error);
		$query2=$pcb->query("insert into pcb_form1_part1(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		$query3=$pcb->query("insert into pcb_form1_part2(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		$query4=$pcb->query("insert into pcb_form1_upload(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->file_update($file);
		$formFunctions->insert_incomplete_forms('pcb','1'); //pcb-- dept name and 1 -- form no
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'form1.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'form1.php';
		</script>";
	}					
}
if(isset($_POST["save1b"])){
	$investment_certificate=clean($_POST["investment_certificate"]);$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$process_desc=clean($_POST["process_desc"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
		$is_not_details="";
	}else{
		$is_not_details=clean($_POST["is_not_details"]);
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["investment_cost"]))	$investment_cost=json_encode($_POST["investment_cost"]);
		else	$investment_cost=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;
	
	
	$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");
	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE pcb_form1 SET investment_certificate='$investment_certificate',investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_provided='$is_provided',is_use='$is_use',is_not_details='$is_not_details',staff_nos='$staff_nos',is_res_colony='$is_res_colony',process_desc='$process_desc',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $pcb->query($save_query) OR die("Error: ".$pcb->error);
		
		if($input_size1!=0){					
			$k=$pcb->query("delete from pcb_form1_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];
			
			$part1=$pcb->query("INSERT INTO pcb_form1_products(id,form_id,slno,name,product_type,qty,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($pcb->error);
			}
		}
		if($input_size2!=0){					
			$k=$pcb->query("delete from pcb_form1_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];
		
			$part2=$pcb->query("INSERT INTO pcb_form1_materials(id,form_id,slno,name,material_type,qty,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($pcb->error);
			}
		}
		
	}
	if($query){
		$file1=$investment_certificate;$file2=$is_not_details;$file3=$process_desc;
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'form1.php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'form1.php?tab=2';
		</script>";
	}		
}

if(isset($_POST["save1c"])) {
	$sewage_treatment=clean($_POST["sewage_treatment"]);
			
	if(!empty($_POST["wc_values"]))	$wc_values=json_encode($_POST["wc_values"]);
	else $wc_values=NULL;
	
	if(!empty($_POST["water_source"]))	$water_source=json_encode($_POST["water_source"]);
	else	$water_source=NULL;
	
	if(!empty($_POST["ww_qty"]))	$ww_qty=json_encode($_POST["ww_qty"]);
	else	$ww_qty=NULL;
	
	if(!empty($_POST["budget_calc"])){
		$budget_calc=json_encode($_POST["budget_calc"]);
		$budget_calc_decode=json_decode($budget_calc);
		$file=$budget_calc_decode->b;
	}else{
		$budget_calc=NULL;$file="NA";
	}
	
	$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		
		$savequery=$pcb->query("UPDATE pcb_form1_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($file);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=2';
			</script>";
		}
	}		
}
if(isset($_POST["save1d"])) {
	
	$trade_treatment=clean($_POST["trade_treatment"]);$is_mixed=clean($_POST["is_mixed"]);$laboratory_report=clean($_POST["laboratory_report"]);
			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;
	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$pcb->query("UPDATE pcb_form1_part1 SET trade_treatment='$trade_treatment',is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality',laboratory_report='$laboratory_report', disposal_mode='$disposal_mode' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($laboratory_report);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=2';
			</script>";
		}
	}		
}
if(isset($_POST["save1e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$spec_residue_report=clean($_POST["spec_residue_report"]);$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);$gas_quality=clean($_POST["gas_quality"]);
		
	if(!empty($_POST["fc"])){
		$fuel_consumption=json_encode($_POST["fc"]);
	}else{
		$fuel_consumption=NULL;
	}
	
	if(!empty($_POST["sd"])){
		$stack_details=json_encode($_POST["sd"]);
	}else{
		$stack_details=NULL;
	}
			
	$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$pcb->query("UPDATE pcb_form1_part1 SET spec_residue_report='$spec_residue_report',is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details', gas_quality='$gas_quality' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($spec_residue_report);$formFunctions->file_update($gas_quality);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save1f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$haz_character=clean($_POST["haz_character"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);
		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
		$haz_qty_dispose_file=$haz_qty_dispose_decode->c;
	}else{
		$haz_qty_dispose=NULL;
		$haz_qty_dispose_file="NA";
	}	
	
	$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$pcb->query("UPDATE pcb_form1_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', haz_character='$haz_character', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($haz_character);$formFunctions->file_update($haz_qty_dispose_file);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save1g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$om_expens=clean($_POST["om_expens"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$tree_plant=clean($_POST["tree_plant"]);$scheme_info=clean($_POST["scheme_info"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$pcb->query("UPDATE pcb_form1_part2 SET is_sys_upg='$is_sys_upg',om_expens='$om_expens', to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals',tree_plant='$tree_plant',scheme_info='$scheme_info', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($om_expens);$formFunctions->file_update($tree_plant);$formFunctions->file_update($scheme_info);
			if($public_hearing_doc!="N" && $public_hearing_doc!="Y") $formFunctions->file_update($public_hearing_doc);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=8';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=7';
			</script>";
		}
	}	 
}
if(isset($_POST["save1h"])){	
	if((isset($_POST["mfile16"]) && empty($_POST["mfile16"])) || (isset($_POST["mfile17"]) && empty($_POST["mfile17"])) || (isset($_POST["mfile18"]) && empty($_POST["mfile18"])) || (isset($_POST["mfile19"]) && empty($_POST["mfile19"])) || (isset($_POST["mfile20"]) && empty($_POST["mfile20"])) || (isset($_POST["mfile21"]) && empty($_POST["mfile21"])) || (isset($_POST["mfile22"]) && empty($_POST["mfile22"])) || (isset($_POST["mfile23"]) && empty($_POST["mfile23"])) || (isset($_POST["mfile24"]) && empty($_POST["mfile24"])) || (isset($_POST["mfile16"]) && $_POST["mfile16"]=='2') || (isset($_POST["mfile17"]) && $_POST["mfile17"]=='2') || (isset($_POST["mfile18"]) && $_POST["mfile18"]=='2') || (isset($_POST["mfile19"]) && $_POST["mfile19"]=='2') || (isset($_POST["mfile20"]) && $_POST["mfile20"]=='2') || (isset($_POST["mfile21"]) && $_POST["mfile21"]=='2') || (isset($_POST["mfile22"]) && $_POST["mfile22"]=='2') || (isset($_POST["mfile23"]) && $_POST["mfile23"]=='2') || (isset($_POST["mfile24"]) && $_POST["mfile24"]=='2') || (isset($_POST["mfile16"]) && $_POST["mfile16"]=='3') || (isset($_POST["mfile17"]) && $_POST["mfile17"]=='3') || (isset($_POST["mfile18"]) && $_POST["mfile18"]=='3') || (isset($_POST["mfile19"]) && $_POST["mfile19"]=='3') || (isset($_POST["mfile20"]) && $_POST["mfile20"]=='3') || (isset($_POST["mfile21"]) && $_POST["mfile21"]=='3') || (isset($_POST["mfile22"]) && $_POST["mfile22"]=='3') || (isset($_POST["mfile23"]) && $_POST["mfile23"]=='3') || (isset($_POST["mfile24"]) && $_POST["mfile24"]=='3')){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'form1.php?tab=8';
		</script>";
	}else{
		$file1=$_POST["mfile16"];$file2=$_POST["mfile17"];$file3=$_POST["mfile18"];$file4=$_POST["mfile19"];$file5=$_POST["mfile20"];$file6=$_POST["mfile21"];$file7=$_POST["mfile22"];$file8=$_POST["mfile23"];$file9=$_POST["mfile24"];
	
		if(isset($_POST["courier_details"]) && !empty($_POST["courier_details"])){
			$courier_details=json_encode($_POST["courier_details"]);
		}else $courier_details=NULL;
		
		$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'form1.php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];
			$savequery=$pcb->query("update pcb_form1_upload set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8',file9='$file9' where form_id='$form_id'") or die($pcb->error);
		}		
		if($savequery){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);$formFunctions->file_update($file8);$formFunctions->file_update($file9);
			$uain=$formFunctions->create_uain($form_id,'pcb','1');
			if($courier_details==NULL){
				$save_query=$pcb->query("update pcb_form1 set uain='$uain',courier_details='$courier_details', sub_date='$today', received_date='$today' where form_id='$form_id'") or die($pcb->error);
			}else{
				$save_query=$pcb->query("update pcb_form1 set uain='$uain', courier_details='$courier_details', sub_date='$today' where form_id='$form_id'") or die($pcb->error);
			}
			if($save_query){
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'form1.php?tab=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form1.php?tab=8';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=7';
			</script>";
		}
		//preview.php?token=1
	}
	
}
if(isset($_POST["save1i"]))
{
	echo "<script>
				alert('Successfully submitted!!!');
				window.location.href = 'preview.php?token=1';
			</script>";
}

if(isset($_POST["payment"])){
	
	if($_POST["payment_mode"]==1){
		echo "<script>
				alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
				window.location.href = 'form_payment.php?token=cte';
			</script>";
	}else if($_POST["payment_mode"]==0){
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form1.php?tab=10';
			</script>";
		}else{
			$sql=$pcb->query("select form_id from pcb_form1 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();			
			if($sql->num_rows>0){
				$form_id=$row["form_id"];				
				$offline_challan=$_POST["offline_challan"];$payment_mode=$_POST["payment_mode"];
				$save_query=$pcb->query("update pcb_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($pcb->error);
				
				if($save_query){
					$uain=$pcb->query("select uain from pcb_form1 where form_id='$form_id'")->fetch_object()->uain;
					
					$formFunctions->insert_applications($uain);
					$str=$formFunctions->getEmail_str($uain);
					/*----------------SEND MAIL-----------------*/
					$user_email=$formFunctions->get_usermail($swr_id);
					$dept_email="esgoa.pollution@gmail.com";
					
					require_once "form1_print.php"; 
					$mypdf=uniqid(rand()).".pdf";
					/*---------mpdf logic-----------*/
					require_once "../../../mpdf60/mpdf.php"; 
					$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
					$mpdf->SetDisplayMode('fullpage');
					// 1 or 0 - whether to indent the first level of a list 
					$mpdf->list_indent_first_level = 0;
					$mpdf->WriteHTML($printContents);         
					$mpdf->Output($mypdf,'F');
					require_once "../../../mailsending/sendAttachment.php";		
					$emal=$dept_email.",".$user_email;
					send_attachment($emal,$str,$mypdf);
					unlink($mypdf);
					
					echo "<script>
						alert('Successfully Submitted....');
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=pcb';
					</script>";
				}else{
					echo "<script>alert('Something went wrong !!!');window.location.href = 'form1.php?tab=9';</script>";
				}
			}else{
				echo "<script>alert('Something went wrong !!!');window.location.href = 'form1.php?tab=9';</script>";
			}
		}								
	}else{
		echo "<script>alert('Something went wrong !!!');window.location.href = 'form1.php?tab=9';</script>";
	}
}
/************************** FORM 1 END *********************************/
/************************** FORM 2 CTO *********************************/
/************************** SAVE FORM 2 START *********************************/
/********************************************************/
/***********************************************************/

if(isset($_POST["save2a"])){		
	$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}
	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
		$file=$plan_details_decode->upload;
	}else{
		$plan_details=NULL;$file="NA";
	}
	
	if(!empty($_POST["md_address"]))	 $md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){			
		$query=$pcb->query("insert into pcb_form2(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date')") OR die("Error: ".$pcb->error);
		$form_id=$pcb->insert_id;
		$query2=$pcb->query("insert into pcb_form2_part1(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		$query3=$pcb->query("insert into pcb_form2_part2(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		$query4=$pcb->query("insert into pcb_form2_upload(form_id) values ('$form_id')") OR die("Error: ".$pcb->error);
		
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];				
		$query=$pcb->query("update pcb_form2 set sub_date='$today', revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date' where form_id='$form_id'") OR die("Error: ".$pcb->error);
	}	
	if($query){
		$formFunctions->file_update($file);
		$formFunctions->insert_incomplete_forms('pcb','2'); //pcb-- dept name and 2 -- form no
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'form2.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'form2.php';
		</script>";
	}					
}

if(isset($_POST["save2b"])){
	$investment_certificate=clean($_POST["investment_certificate"]);$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$process_desc=clean($_POST["process_desc"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
		$is_not_details="";
	}else{
		$is_not_details=clean($_POST["is_not_details"]);
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["investment_cost"]))	$investment_cost=json_encode($_POST["investment_cost"]);
		else	$investment_cost=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;	
	
	$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");
	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE pcb_form2 SET investment_certificate='$investment_certificate',investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_provided='$is_provided',is_use='$is_use',is_not_details='$is_not_details',staff_nos='$staff_nos',is_res_colony='$is_res_colony',process_desc='$process_desc',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $pcb->query($save_query) OR die("Error: ".$pcb->error);
		
		if($input_size1!=0){					
			$k=$pcb->query("delete from pcb_form2_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];
			
			$part1=$pcb->query("INSERT INTO pcb_form2_products(id,form_id,slno,name,product_type,qty,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($pcb->error);
			}
		}
		if($input_size2!=0){					
			$k=$pcb->query("delete from pcb_form2_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];
		
			$part2=$pcb->query("INSERT INTO pcb_form2_materials(id,form_id,slno,name,material_type,qty,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($pcb->error);
			}
		}		
	}
	if($query){
		$file1=$investment_certificate;$file2=$is_not_details;$file3=$process_desc;
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'form2.php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'form2.php?tab=2';
		</script>";
	}		
}

if(isset($_POST["save2c"])) {
	$sewage_treatment=clean($_POST["sewage_treatment"]);
			
	if(!empty($_POST["wc_values"]))	$wc_values=json_encode($_POST["wc_values"]);
	else $wc_values=NULL;
	
	if(!empty($_POST["water_source"]))	$water_source=json_encode($_POST["water_source"]);
	else	$water_source=NULL;
	
	if(!empty($_POST["ww_qty"]))	$ww_qty=json_encode($_POST["ww_qty"]);
	else	$ww_qty=NULL;
	
	if(!empty($_POST["budget_calc"])){
		$budget_calc=json_encode($_POST["budget_calc"]);
		$budget_calc_decode=json_decode($budget_calc);
		$file=$budget_calc_decode->b;
	}else{
		$budget_calc=NULL;$file="NA";
	}
	
	$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		
		$savequery=$pcb->query("UPDATE pcb_form2_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($file);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form2.php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=2';
			</script>";
		}
	}		
}
if(isset($_POST["save2d"])) {
	
	$trade_treatment=clean($_POST["trade_treatment"]);$is_mixed=clean($_POST["is_mixed"]);$laboratory_report=clean($_POST["laboratory_report"]);
			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;
	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$pcb->query("UPDATE pcb_form2_part1 SET trade_treatment='$trade_treatment',is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality',laboratory_report='$laboratory_report', disposal_mode='$disposal_mode' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($laboratory_report);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form2.php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=2';
			</script>";
		}
	}		
}
if(isset($_POST["save2e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$spec_residue_report=clean($_POST["spec_residue_report"]);$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);$gas_quality=clean($_POST["gas_quality"]);
		
	if(!empty($_POST["fc"])){
		$fuel_consumption=json_encode($_POST["fc"]);
	}else{
		$fuel_consumption=NULL;
	}
	
	if(!empty($_POST["sd"])){
		$stack_details=json_encode($_POST["sd"]);
	}else{
		$stack_details=NULL;
	}
			
	$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$pcb->query("UPDATE pcb_form2_part1 SET spec_residue_report='$spec_residue_report',is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details', gas_quality='$gas_quality' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($spec_residue_report);$formFunctions->file_update($gas_quality);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form2.php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save2f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$haz_character=clean($_POST["haz_character"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);
		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
		$haz_qty_dispose_file=$haz_qty_dispose_decode->c;
	}else{
		$haz_qty_dispose=NULL;
		$haz_qty_dispose_file="NA";
	}	
	
	$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$pcb->query("UPDATE pcb_form2_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', haz_character='$haz_character', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($haz_character);$formFunctions->file_update($haz_qty_dispose_file);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form2.php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save2g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$om_expens=clean($_POST["om_expens"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$tree_plant=clean($_POST["tree_plant"]);$scheme_info=clean($_POST["scheme_info"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$pcb->query("UPDATE pcb_form2_part2 SET is_sys_upg='$is_sys_upg',om_expens='$om_expens', to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals',tree_plant='$tree_plant',scheme_info='$scheme_info', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);
		
		if($savequery){
			$formFunctions->file_update($om_expens);$formFunctions->file_update($tree_plant);$formFunctions->file_update($scheme_info);
			if($public_hearing_doc!="N" && $public_hearing_doc!="Y") $formFunctions->file_update($public_hearing_doc);
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form2.php?tab=8';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=7';
			</script>";
		}
	}	 
}
if(isset($_POST["save2h"])){	
	if((isset($_POST["mfile16"]) && empty($_POST["mfile16"])) || (isset($_POST["mfile17"]) && empty($_POST["mfile17"])) || (isset($_POST["mfile18"]) && empty($_POST["mfile18"])) || (isset($_POST["mfile19"]) && empty($_POST["mfile19"])) || (isset($_POST["mfile16"]) && $_POST["mfile16"]=='2') || (isset($_POST["mfile17"]) && $_POST["mfile17"]=='2') || (isset($_POST["mfile18"]) && $_POST["mfile18"]=='2') || (isset($_POST["mfile19"]) && $_POST["mfile19"]=='2') || (isset($_POST["mfile16"]) && $_POST["mfile16"]=='3') || (isset($_POST["mfile17"]) && $_POST["mfile17"]=='3') || (isset($_POST["mfile18"]) && $_POST["mfile18"]=='3') || (isset($_POST["mfile19"]) && $_POST["mfile19"]=='3')){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'form2.php?tab=8';
		</script>";
	}else{
		$file1=$_POST["mfile16"];$file2=$_POST["mfile17"];$file3=$_POST["mfile18"];$file4=$_POST["mfile19"];
	
		if(isset($_POST["courier_details"]) && !empty($_POST["courier_details"])){
			$courier_details=json_encode($_POST["courier_details"]);
		}else $courier_details=NULL;
		
		$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'form2.php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];
			$savequery=$pcb->query("update pcb_form2_upload set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'") or die($pcb->error);
		}		
		if($savequery){
			$uain=$formFunctions->create_uain($form_id,'pcb','2');
			if($courier_details==NULL){
				$save_query=$pcb->query("update pcb_form2 set uain='$uain',courier_details='$courier_details', sub_date='$today', received_date='$today' where form_id='$form_id'") or die($pcb->error);
			}else{
				$save_query=$pcb->query("update pcb_form2 set uain='$uain', courier_details='$courier_details', sub_date='$today' where form_id='$form_id'") or die($pcb->error);
			}
			if($save_query){
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'preview.php?token=2';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form2.php?tab=8';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=7';
			</script>";
		}
	}
}
if(isset($_POST["submit2"])){
	if($_POST["payment_mode"]==1){
		echo "<script>
				alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
				window.location.href = 'form_payment.php?token=cto';
			</script>";
	}else if($_POST["payment_mode"]==0){
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form2.php?tab=9';
			</script>";
		}else{
			$sql=$pcb->query("select form_id from pcb_form2 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();			
			if($sql->num_rows>0){
				$form_id=$row["form_id"];				
				$offline_challan=$_POST["offline_challan"];$payment_mode=$_POST["payment_mode"];
				$save_query=$pcb->query("update pcb_form2 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($pcb->error);
				
				if($save_query){
					$uain=$pcb->query("select uain from pcb_form2 where form_id='$form_id'")->fetch_object()->uain;
					
					$formFunctions->insert_applications($uain);
					$str=$formFunctions->getEmail_str($uain);
					/*----------------SEND MAIL-----------------*/
					$user_email=$formFunctions->get_usermail($swr_id);
					$dept_email="esgoa.pollution@gmail.com";
					
					require_once "form2_print.php"; 
					$mypdf=uniqid(rand()).".pdf";
					/*---------mpdf logic-----------*/
					require_once "../../../mpdf60/mpdf.php"; 
					$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
					$mpdf->SetDisplayMode('fullpage');
					// 1 or 0 - whether to indent the first level of a list 
					$mpdf->list_indent_first_level = 0;
					$mpdf->WriteHTML($printContents);         
					$mpdf->Output($mypdf,'F');
					require_once "../../../mailsending/sendAttachment.php";		
					$emal=$dept_email.",".$user_email;
					send_attachment($emal,$str,$mypdf);
					unlink($mypdf);
					
					echo "<script>
						alert('Successfully Submitted....');
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=pcb';
					</script>";
				}else{
					echo "<script>alert('Something went wrong !!!');window.location.href = 'form2.php?tab=9';</script>";
				}
			}else{
				echo "<script>alert('Something went wrong !!!');window.location.href = 'form2.php?tab=9';</script>";
			}
		}								
	}else{
		echo "<script>alert('Something went wrong !!!');window.location.href = 'form2.php?tab=9';</script>";
	}
}
?>