 <?php
 if(isset($_POST["submit"])){
	$applied=clean($_POST["applied"]);$received=clean($_POST["received"]);$commission_date=clean($_POST["commission_date"]);$certificate_no=clean($_POST["certificate_no"]);$certificate_date=clean($_POST["certificate_date"]);$uain=clean($_POST["uain"]);
	
	$query=$formFunctions->executeQuery($dept,"insert into pcb_details(applied,received,commission_date,certificate_no,certificate_date,uain) values ('$applied','$received','$commission_date', '$certificate_no', '$certificate_date', '$uain')");
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'megha_pcb.php';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !');
			window.location.href = 'megha_pcb.php';
		</script>";
	}	
}

/* ------ pcb form 1 start ------*/
if(isset($_POST["save1a"])){
	$enterprise_category=clean($_POST["enterprise_category"]);$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,enterprise_category,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$enterprise_category', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php';
                </script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', enterprise_category='$enterprise_category', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		
	}
	if($query){		
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
	}else{
		$budget_calc=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save1d"])) {
	$is_mixed=clean($_POST["is_mixed"]);			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;
	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save1e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);	
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save1f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);
		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
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
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);
	$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg', to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,dg_name,dg_pro_id,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,dg_acoustic_e) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}

/* ------ pcb form 2 start ------*/
if(isset($_POST["save2a"])){
	$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		
	}
	if($query){		
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
	}else{
		$budget_calc=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form2.php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save2d"])) {
	$is_mixed=clean($_POST["is_mixed"]);			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;
	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form2.php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save2e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);	
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form2.php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save2f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);
		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
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
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);
	$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg', to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,dg_name,dg_pro_id,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,dg_acoustic_e) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}


/* ------ pcb form 3 start ------*/
if(isset($_POST["save3a"])){
	$enterprise_category=clean($_POST["enterprise_category"]);$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,enterprise_category,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$enterprise_category', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form3.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', enterprise_category='$enterprise_category', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form3.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'pcb_form3.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form3.php';
		</script>";
	}					
}
if(isset($_POST["save3b"])){
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form3.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		
	}
	if($query){		
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'pcb_form3.php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form3.php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save3c"])) {
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
	}else{
		$budget_calc=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form3.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form3.php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form3.php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save3d"])) {
	$is_mixed=clean($_POST["is_mixed"]);			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;
	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form3.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form3.php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form3.php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save3e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);	
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form3.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form3.php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form3.php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save3f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);
		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form3.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form3.php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form3.php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save3g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);
	$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form3.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg', to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form3.php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,dg_name,dg_pro_id,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,dg_acoustic_e) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}

/* ------ pcb form 47 start ------ */
if(isset($_POST["save47a"])){
	$enterprise_category=clean($_POST["enterprise_category"]);$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,enterprise_category,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$enterprise_category', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form47.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', enterprise_category='$enterprise_category', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form47.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'pcb_form47.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form47.php';
		</script>";
	}					
}
if(isset($_POST["save47b"])){
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form47.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		
	}
	if($query){		
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'pcb_form47.php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form47.php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save47c"])) {
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
	}else{
		$budget_calc=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form47.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form47.php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form47.php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save47d"])) {
	$is_mixed=clean($_POST["is_mixed"]);			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;
	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form47.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form47.php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form47.php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save47e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);	
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form47.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form47.php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form47.php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save47f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);
		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form47.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form47.php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form47.php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save47g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);
	$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form47.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg', to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form47.php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,dg_name,dg_pro_id,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,dg_acoustic_e) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}

/* ------------ pcb form 48 --------------- */
if(isset($_POST["save48a"])){
	$enterprise_category=clean($_POST["enterprise_category"]);$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,enterprise_category,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$enterprise_category', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form48.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', enterprise_category='$enterprise_category', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form48.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'pcb_form48.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form48.php';
		</script>";
	}					
}
if(isset($_POST["save48b"])){
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}		
	}	
	if($query){		
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save48c"])){
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
	}else{
		$budget_calc=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save48d"])) {
	$is_mixed=clean($_POST["is_mixed"]);
			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;
	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){			
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save48e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);
		
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save48f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save48g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);
	$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg', to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){			
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,dg_name,dg_pro_id,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,dg_acoustic_e) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}

/* ------------ pcb form 49 --------------- */
if(isset($_POST["save49a"])){		
	$land_premises=clean($_POST["land_premises"]);$natio_nality=clean($_POST["natio_nality"]);$l_o_business_val=clean($_POST["l_o_business_val"]);$survey_no=clean($_POST["survey_no"]);$khasra_no=clean($_POST["khasra_no"]);$approximate_date=clean($_POST["approximate_date"]);
	$expected_date=clean($_POST["expected_date"]);  $total_no_employee=clean($_POST["total_no_employee"]);$is_licence=clean($_POST["is_licence"]);$is_licence_details=clean($_POST["is_licence_details"]);$person_authorised=clean($_POST["person_authorised"]);
	$licence_annual_capacity=clean($_POST["licence_annual_capacity"]);$dome_stic=clean($_POST["dome_stic"]);  $indus_trial=clean($_POST["indus_trial"]);$quality_of_effluent=clean($_POST["quality_of_effluent"]);$monitoring_arrangemen=clean($_POST["monitoring_arrangemen"]);
	$is_treatment_plant=clean($_POST["is_treatment_plant"]);$investment_cost=clean($_POST["investment_cost"]);
	$hidden_value=clean($_POST["hidden_value"]);
	
	if(!empty($_POST["wc_values"]))  $wc_values=json_encode($_POST["wc_values"]);
	else	$wc_values=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){ 		
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,investment_cost,land_premises,natio_nality,survey_no,khasra_no,approximate_date,expected_date,total_no_employee,is_licence,is_licence_details,person_authorised,licence_annual_capacity,dome_stic,indus_trial,quality_of_effluent,monitoring_arrangemen,is_treatment_plant,wc_values) values('$swr_id','$today','$investment_cost','$land_premises','$natio_nality','$survey_no','$khasra_no','$approximate_date','$expected_date','$total_no_employee','$is_licence','$is_licence_details','$person_authorised','$licence_annual_capacity','$dome_stic','$indus_trial','$quality_of_effluent','$monitoring_arrangemen','$is_treatment_plant','$wc_values')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
		}
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',investment_cost='$investment_cost',land_premises='$land_premises',natio_nality='$natio_nality',survey_no='$survey_no',khasra_no='$khasra_no',approximate_date='$approximate_date',expected_date='$expected_date',total_no_employee='$total_no_employee',is_licence='$is_licence',is_licence_details='$is_licence_details', person_authorised='$person_authorised',licence_annual_capacity='$licence_annual_capacity',dome_stic='$dome_stic',indus_trial='$indus_trial',quality_of_effluent='$quality_of_effluent',monitoring_arrangemen='$monitoring_arrangemen',is_treatment_plant='$is_treatment_plant',wc_values='$wc_values' WHERE form_id='$form_id'");	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'");
		} 
    }
	
	if($query==true && $query1==true){	
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'pcb_form49.php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form49.php?tab=1';
		</script>";
	}
}	 
if(isset($_POST["save49b"])){	
	if(!empty($_POST["sold_wastes"]))	 $sold_wastes=json_encode($_POST["sold_wastes"]);
	else	$sold_wastes=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = 'pcb_form49.php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',sold_wastes='$sold_wastes' WHERE form_id='$form_id'");	
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form49.php?tab=2';
		</script>";
	}
}

/* ------------ pcb form 50 --------------- */
if(isset($_POST["save50a"])){
	$enterprise_category=clean($_POST["enterprise_category"]);$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,enterprise_category,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$enterprise_category', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form50.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', enterprise_category='$enterprise_category', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form50.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'pcb_form50.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form50.php';
		</script>";
	}					
}
if(isset($_POST["save50b"])){
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form50.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}	
	}	
	if($query){	
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'pcb_form50.php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form50.php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save50c"])) {
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
	}else{
		$budget_calc=NULL;
	}	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form50.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form50.php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form50.php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save50d"])) {	
	$is_mixed=clean($_POST["is_mixed"]);			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form50.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form50.php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form50.php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save50e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);		
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form50.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form50.php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form50.php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save50f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form50.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form50.php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form50.php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save50g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form50.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg',to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form50.php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,dg_name,dg_pro_id,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,dg_acoustic_e) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}

/* ------------ pcb form 58 --------------- */
if(isset($_POST["save58a"])){
	$enterprise_category=clean($_POST["enterprise_category"]);$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,enterprise_category,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$enterprise_category', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form58.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', enterprise_category='$enterprise_category', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form58.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'pcb_form58.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form58.php';
		</script>";
	}					
}
if(isset($_POST["save58b"])){
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form58.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}	
	}	
	if($query){	
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'pcb_form58.php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form58.php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save58c"])) {
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
	}else{
		$budget_calc=NULL;
	}	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form58.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form58.php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form58.php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save58d"])) {	
	$is_mixed=clean($_POST["is_mixed"]);			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form58.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form58.php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form58.php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save58e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);		
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form58.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form58.php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form58.php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save58f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form58.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'pcb_form58.php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form58.php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save58g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'pcb_form58.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg',to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form58.php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,site_id,engine_no,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,location_address) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}

/* ------------ pcb form 59 --------------- */
if(isset($_POST["save59a"])){
	$enterprise_category=clean($_POST["enterprise_category"]);$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,enterprise_category,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$enterprise_category', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form59.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', enterprise_category='$enterprise_category', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form59.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'pcb_form59.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form59.php';
		</script>";
	}					
}
if(isset($_POST["save59b"])){
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}	
	}	
	if($query){	
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save59c"])) {
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
	}else{
		$budget_calc=NULL;
	}	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save59d"])) {	
	$is_mixed=clean($_POST["is_mixed"]);			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save59e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);		
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save59f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save59g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg',to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,site_id,engine_no,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,location_address) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}
/* ------------ pcb form 60 --------------- */
if(isset($_POST["save60a"])){
	$enterprise_category=clean($_POST["enterprise_category"]);$revenue_survey_no=clean($_POST["revenue_survey_no"]);$lb_name=clean($_POST["lb_name"]);$lb_auth_name=clean($_POST["lb_auth_name"]);$md_name=clean($_POST["md_name"]);$is_registered=clean($_POST["is_registered"]);$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	if(isset($_POST["reg_no"]) && isset($_POST["reg_date"])){				
		$reg_no=$_POST["reg_no"];$reg_date=$_POST["reg_date"];
	}else{
		$reg_no=NULL;$reg_date=NULL;
	}	
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}	
	if(!empty($_POST["plan_details"])){
		$plan_details=json_encode($_POST["plan_details"]);
		$plan_details_decode=json_decode($plan_details);
	}else{
		$plan_details=NULL;
	}
	
	if(!empty($_POST["md_address"]))	$md_address=json_encode($_POST["md_address"]);
	else	$md_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,revenue_survey_no,plan_details,lb_name,lb_auth_name,md_name,md_address,is_registered,reg_no,reg_date,enterprise_category,from_year,to_year) values ('$swr_id','$today', '$revenue_survey_no', '$plan_details', '$lb_name', '$lb_auth_name', '$md_name', '$md_address', '$is_registered', '$reg_no', '$reg_date', '$enterprise_category', '$from_year', '$to_year')");
		
		$form_id=$query;
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form60.php';
			</script>";
		}
	}else{				
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',revenue_survey_no='$revenue_survey_no', plan_details='$plan_details', lb_name='$lb_name', lb_auth_name='$lb_auth_name',md_name='$md_name', md_address='$md_address', is_registered='$is_registered', reg_no='$reg_no', reg_date='$reg_date', enterprise_category='$enterprise_category', from_year='$from_year',to_year='$to_year' where form_id='$form_id'");
		
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values ('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part2(form_id) values ('$form_id')");
		$query4=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values ('$form_id')");
		if($query2==false || $query3==false || $query4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form60.php';
			</script>";
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'pcb_form60.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form60.php';
		</script>";
	}					
}
if(isset($_POST["save60b"])){
	$wb_name=clean($_POST["wb_name"]);$loc_feedback=clean($_POST["loc_feedback"]);$is_situated=clean($_POST["is_situated"]);$is_provided=clean($_POST["is_provided"]);$staff_nos=clean($_POST["staff_nos"]);$is_res_colony=clean($_POST["is_res_colony"]);
	$investment_cost=clean($_POST["investment_cost"]);
	$input_size1=clean($_POST["hiddenval"]);
	$input_size2=clean($_POST["hiddenval2"]);
	if($is_provided=="Y"){
		$is_use=clean($_POST["is_use"]);
	}else{
		$is_use="";
	}
	
	if(!empty($_POST["site_distance"]))	$site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	if(!empty($_POST["total_area"]))	$total_plot_area=json_encode($_POST["total_area"]);
		else	$total_plot_area=NULL;
		
	if(!empty($_POST["commission_my"]))	$commission_my=json_encode($_POST["commission_my"]);
	else $commission_my=NULL;
	
	if(!empty($_POST["colony_details"]))	$colony_details=json_encode($_POST["colony_details"]);
	else	$colony_details=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET investment_cost='$investment_cost',site_distance='$site_distance',wb_name='$wb_name',loc_feedback='$loc_feedback',is_situated='$is_situated',is_provided='$is_provided',is_use='$is_use',staff_nos='$staff_nos',is_res_colony='$is_res_colony',total_plot_area='$total_plot_area',commission_my='$commission_my',colony_details='$colony_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
		
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_products where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_products(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_materials where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["textA".$i];	*/		
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];
			$vale=$_POST["textE".$i];		
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_materials(form_id,slno,name,material_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}	
	}	
	if($query){	
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save60c"])) {
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
	}else{
		$budget_calc=NULL;
	}	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");			
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET water_source='$water_source',budget_calc='$budget_calc',sewage_treatment='$sewage_treatment',wc_values='$wc_values',ww_qty='$ww_qty' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=4';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}
	}		
}
if(isset($_POST["save60d"])) {	
	$is_mixed=clean($_POST["is_mixed"]);			
	if(!empty($_POST["sump_capacity"]) && $_POST["sump_capacity_radio"]=="Y")	$sump_capacity=json_encode($_POST["sump_capacity"]);
	else $sump_capacity=NULL;
	if(!empty($_POST["yes_detail"]) && $_POST["is_mixed"]=="Y")	$yes_detail=$_POST["yes_detail"];
	else $yes_detail=NULL;	
	if(!empty($_POST["effluents_quality"]))	$effluents_quality=json_encode($_POST["effluents_quality"]);
	else $effluents_quality=NULL;
	if(!empty($_POST["disposal_mode"]))	$disposal_mode=json_encode($_POST["disposal_mode"]);
	else $disposal_mode=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_mixed='$is_mixed',yes_detail='$yes_detail',sump_capacity='$sump_capacity',effluents_quality='$effluents_quality', disposal_mode='$disposal_mode' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=5';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}
	}		
}
if(isset($_POST["save60e"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_odoriferous=clean($_POST["is_odoriferous"]);$is_adq_facility=clean($_POST["is_adq_facility"]);		
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
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET is_odoriferous='$is_odoriferous',is_adq_facility='$is_adq_facility', fuel_consumption='$fuel_consumption', stack_details='$stack_details' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=6';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
		}
	}	 
}
if(isset($_POST["save60f"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_hazardous=clean($_POST["is_hazardous"]);$haz_qty=clean($_POST["haz_qty"]);$storage_mode=clean($_POST["storage_mode"]);$haz_pres_treatment=clean($_POST["haz_pres_treatment"]);		
	if(!empty($_POST["haz_cat_no"]) && $_POST["is_hazardous"]=='Y')	$haz_cat_no=$_POST["haz_cat_no"];
	else	$haz_cat_no=NULL;		
	if(!empty($_POST["auth_req"]))		$auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;
	if(!empty($_POST["haz_qty_dispose"])){
		$haz_qty_dispose=json_encode($_POST["haz_qty_dispose"]);
		$haz_qty_dispose_decode=json_decode($haz_qty_dispose);
	}else{
		$haz_qty_dispose=NULL;
	}	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_hazardous='$is_hazardous',haz_cat_no='$haz_cat_no', haz_qty='$haz_qty', storage_mode='$storage_mode', haz_pres_treatment='$haz_pres_treatment',auth_req='$auth_req',haz_qty_dispose='$haz_qty_dispose' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '".$table_name.".php?tab=7';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=6';
			</script>";
		}
	}	 
}
if(isset($_POST["save60g"])) {
	//fuel_consumption json 	stack_details json 	is_odoriferous	is_adq_facility
	$is_sys_upg=clean($_POST["is_sys_upg"]);$nonhaz_details=clean($_POST["nonhaz_details"]);$haz_chemicals=clean($_POST["haz_chemicals"]);$other_info=clean($_POST["other_info"]);$public_hearing_doc=clean($_POST["public_hearing_doc"]);$dg_set=clean($_POST["dg_set"]);$input_size3=clean($_POST["hiddenval3"]);

	if(!empty($_POST["sys_upg_details"]) && $_POST["is_sys_upg"]=='Y')	$sys_upg_details=$_POST["sys_upg_details"];
	else	$sys_upg_details=NULL;				
	if(!empty($_POST["haz_chemicals_details"]))		$haz_chemicals_details=json_encode($_POST["haz_chemicals_details"]);
	else	$haz_chemicals_details=NULL;		
	if(!empty($_POST["to_which"]))		$to_which=json_encode($_POST["to_which"]);
	else	$to_which=NULL;
	if(!empty($_POST["dgset_items"]))		$dgset_items=json_encode($_POST["dgset_items"]);
	else	$dgset_items=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET dg_set='$dg_set' WHERE form_id='$form_id'");
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part2 SET is_sys_upg='$is_sys_upg',to_which='$to_which', dgset_items='$dgset_items', nonhaz_details='$nonhaz_details', haz_chemicals='$haz_chemicals', other_info='$other_info',sys_upg_details='$sys_upg_details',haz_chemicals_details='$haz_chemicals_details', public_hearing_doc='$public_hearing_doc' WHERE form_id='$form_id'");
		
		if($savequery){
			echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=7';
			</script>";
		}
        if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_dgsets where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			/*$vala=$_POST["txxtA".$i];	*/		
			$valb=$_POST["txxtB".$i];
			$valc=$_POST["txxtC".$i];
			$vald=$_POST["txxtD".$i];
			$vale=$_POST["txxtE".$i];
			$valf=$_POST["txxtF".$i];
			$valg=$_POST["txxtG".$i];
			$valh=$_POST["txxtH".$i];
			$vali=$_POST["txxtI".$i];
			$valj=$_POST["txxtJ".$i];			
			$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_dgsets(form_id,site_id,engine_no,dg_maker,dg_cap,dg_invest,dg_fuel_q,dg_stack_h,dg_c_equip,location_address) VALUES ('$form_id','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
	}	 
}

if(isset($_POST["save66"])){
	
	$date_acci=clean($_POST["date_acci"]);$event_seq=clean($_POST["event_seq"]);$type_construction=clean($_POST["type_construction"]);$effects_accidents=clean($_POST["effects_accidents"]);$emergency_measure=clean($_POST["emergency_measure"]);
	
	if(!empty($_POST["steps"])) $steps=json_encode($_POST["steps"]);
	else $steps=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_acci,event_seq,type_construction,effects_accidents,emergency_measure,steps) values ('$swr_id','$today','$date_acci','$event_seq','$type_construction','$effects_accidents','$emergency_measure','$steps')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_acci='$date_acci', event_seq='$event_seq', type_construction='$type_construction', effects_accidents='$effects_accidents',emergency_measure='$emergency_measure',steps='$steps' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($form,$dept); //pcb-- dept name and 68 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}

if(isset($_POST["save67"])){
	$address_authority=clean($_POST["address_authority"]);$appeal_made=clean($_POST["appeal_made"]);$sought_for=clean($_POST["sought_for"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,address_authority,appeal_made,sought_for) values ('$swr_id','$today','$address_authority','$appeal_made','$sought_for')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',address_authority='$address_authority',appeal_made='$appeal_made',sought_for='$sought_for' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($form,$dept); //pcb-- dept name and 68 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}

if(isset($_POST["save68"])){
	   
	$date_acci=clean($_POST["date_acci"]);$event_seq=clean($_POST["event_seq"]);$type_construction=clean($_POST["type_construction"]);$effects_accidents=clean($_POST["effects_accidents"]);$emergency_measure=clean($_POST["emergency_measure"]);$monthly_health=clean($_POST["monthly_health"]);$is_processing=clean($_POST["is_processing"]);$is_collection=clean($_POST["is_collection"]);
	
	
	if(!empty($_POST["steps"])) $steps=json_encode($_POST["steps"]);
	else $steps=NULL;
	if(!empty($_POST["collection"]))	$collection=json_encode($_POST["collection"]);
	else	$collection=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_acci,event_seq,type_construction,effects_accidents,emergency_measure,steps,monthly_health,is_processing,is_collection,collection) values ('$swr_id','$today','$date_acci', '$event_seq','$type_construction','$effects_accidents','$emergency_measure','$steps','$monthly_health','$is_processing','$is_collection','$collection')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_acci='$date_acci', event_seq='$event_seq', type_construction='$type_construction', effects_accidents='$effects_accidents',emergency_measure='$emergency_measure',steps='$steps',is_processing='$is_processing',is_collection='$is_collection',collection='$collection' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($form,$dept); //pcb-- dept name and 68 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}


if(isset($_POST["save69"])){
	$input_size1=clean($_POST["hiddenval"]);		
	$reporting_period=clean($_POST["reporting_period"]);$name_city=clean($_POST["name_city"]);$city_population=clean($_POST["city_population"]);$area_kilometer=clean($_POST["area_kilometer"]);$summmechanisms=clean($_POST["summmechanisms"]);$details_manpower=clean($_POST["details_manpower"]);$details_contractor=clean($_POST["details_contractor"]);$is_difficulties=clean($_POST["is_difficulties"]);$is_prepared=clean($_POST["is_prepared"]);$facilities_validity=clean($_POST["facilities_validity"]);$facility2_valid=clean($_POST["facility2_valid"]);
	
	if(!empty($_POST["details_difficulties"]) && $_POST["is_difficulties"]=='Y')	$details_difficulties=$_POST["details_difficulties"];
	else	$details_difficulties=NULL;
	
	
	if(!empty($_POST["nmaddress"]))	  $nmaddress=json_encode($_POST["nmaddress"]);
	else	$nmaddress=NULL;
	if(!empty($_POST["totalnum"]))	$totalnum=json_encode($_POST["totalnum"]);
	else	$totalnum=NULL;
	if(!empty($_POST["quantity"]))	$quantity=json_encode($_POST["quantity"]);
	else	$quantity=NULL;
	if(!empty($_POST["facilities"]))	$facilities=json_encode($_POST["facilities"]);
	else	$facilities=NULL;
	if(!empty($_POST["facility2"]))	$facility2=json_encode($_POST["facility2"]);
	else	$facility2=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,reporting_period,name_city,city_population,area_kilometer,summmechanisms,details_manpower,details_contractor,is_difficulties,details_difficulties,is_prepared,nmaddress,totalnum,quantity,facilities,facilities_validity,facility2_valid,facility2) values ('$swr_id','$today','$reporting_period','$name_city','$city_population','$area_kilometer','$summmechanisms','$details_manpower','$details_contractor','$is_difficulties','$details_difficulties','$is_prepared','$nmaddress','$totalnum','$quantity','$facilities','$facilities_validity','$facility2_valid','$facility2')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery( $dept,"update ".$table_name." set sub_date='$today',reporting_period='$reporting_period',name_city='$name_city',city_population='$city_population',area_kilometer='$area_kilometer',summmechanisms='$summmechanisms',details_manpower='$details_manpower',details_contractor='$details_contractor',is_difficulties='$is_difficulties',details_difficulties='$details_difficulties',is_prepared='$is_prepared',nmaddress='$nmaddress',totalnum='$totalnum',quantity='$quantity',facilities='$facilities',facilities_validity='$facilities_validity',facility2_valid='$facility2_valid',facility2='$facility2' where form_id=$form_id" );			
	}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];
				$vali=$_POST["txtI".$i];
				$valj=$_POST["txtJ".$i];
				$valk=$_POST["txtK".$i];
				$vall=$_POST["txtL".$i];
				$valm=$_POST["txtM".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name_spc,estimated_plastic,plastic_units,compostable_plastic,multilayer_plastic,no_unregistered,waste_management,complete_ban_usages,status_marking,explicit,details_meeting,no_violations) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj','$valk','$vall','$valm')") ;
			}
		}	
			
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save70"])){
	
	$input_size1=clean($_POST["hiddenval"]);$issuance_dt=clean($_POST["issuance_dt"]);$ref_no=clean($_POST["ref_no"]);$description_management=clean($_POST["description_management"]);$environmental_dt=clean($_POST["environmental_dt"]);
	
	
	if(!empty($_POST["facility"])) $facility=json_encode($_POST["facility"]);
	else $facility=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,facility,issuance_dt,ref_no,description_management,environmental_dt) values ('$swr_id','$today','$facility', '$issuance_dt','$ref_no','$description_management','$environmental_dt')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',facility='$facility', issuance_dt='$issuance_dt', ref_no='$ref_no', description_management='$description_management',environmental_dt='$environmental_dt' where form_id=$form_id");		
	}				
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,date,waste_category,received) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
			}
		}
		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}


if(isset($_POST["save73"])){
	$address_authority=clean($_POST["address_authority"]);$appeal_made=clean($_POST["appeal_made"]);$email=clean($_POST["email"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,address_authority,appeal_made,email) values ('$swr_id','$today','$address_authority','$appeal_made','$email')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',address_authority='$address_authority',appeal_made='$appeal_made',email='$email' where form_id=$form_id");		
	}				
	if($query){
		
		$formFunctions->insert_incomplete_forms($form,$dept); //pcb-- dept name and 73 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}


?>