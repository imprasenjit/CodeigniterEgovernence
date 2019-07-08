<?php
if(isset($_POST["save42"])) {
	$accident_type=clean($_POST["accident_type"]);
	$seq_of_events=clean($_POST["seq_of_events"]);$is_auth_informed=clean($_POST["is_auth_informed"]);$accident_waste_type=clean($_POST["accident_waste_type"]);$effects_of_accidents=clean($_POST["effects_of_accidents"]);$measures_taken=clean($_POST["measures_taken"]);$steps_taken_all=clean($_POST["steps_taken_all"]);$steps_taken_prevent=clean($_POST["steps_taken_prevent"]);
	$is_facilities_details=clean($_POST["is_facilities_details"]);$is_facilities=clean($_POST["is_facilities"]);

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,accident_type,seq_of_events,is_auth_informed,accident_waste_type,effects_of_accidents,measures_taken,steps_taken_all,steps_taken_prevent,is_facilities_details,is_facilities) values ('$swr_id','$today','$accident_type', '$seq_of_events','$is_auth_informed', '$accident_waste_type', '$effects_of_accidents', '$measures_taken', '$steps_taken_all', '$steps_taken_prevent', '$is_facilities_details', '$is_facilities')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',save_mode='D',accident_type='$accident_type', seq_of_events='$seq_of_events',is_auth_informed='$is_auth_informed',accident_waste_type='$accident_waste_type',effects_of_accidents='$effects_of_accidents',measures_taken='$measures_taken',steps_taken_all='$steps_taken_all',steps_taken_prevent='$steps_taken_prevent',is_facilities_details='$is_facilities_details',is_facilities='$is_facilities' where user_id='$swr_id' and form_id='$form_id'");		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}						
}

if(isset($_POST["save43a"])){
	$facility_name=clean($_POST["facility_name"]);$applic_tele_no=clean($_POST["applic_tele_no"]);$applic_fax_no=clean($_POST["applic_fax_no"]);$applic_web_addr=clean($_POST["applic_web_addr"]);$fresh_renew=clean($_POST["fresh_renew"]);$if_applied=clean($_POST["if_applied"]);$prev_auth_no=clean($_POST["prev_auth_no"]);$renew_date=clean($_POST["renew_date"]);$under_water=clean($_POST["under_water"]);$under_air=clean($_POST["under_air"]);
	
	if(!empty($_POST["auth_sght"]))	$auth_sght=json_encode($_POST["auth_sght"]);
	else	$auth_sght=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,facility_name,applic_tele_no,applic_fax_no,applic_web_addr,auth_sght,fresh_renew,if_applied,prev_auth_no,renew_date,under_water,under_air) values('$swr_id','$facility_name','$applic_tele_no','$applic_fax_no','$applic_web_addr','$auth_sght','$fresh_renew','$if_applied','$prev_auth_no','$renew_date','$under_water','$under_air')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',facility_name='$facility_name',applic_tele_no='$applic_tele_no',applic_fax_no='$applic_fax_no',applic_web_addr='$applic_web_addr',auth_sght='$auth_sght',fresh_renew='$fresh_renew', if_applied='$if_applied', prev_auth_no='$prev_auth_no',renew_date='$renew_date',under_water='$under_water',under_air='$under_air' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save43b"])){
	$facility_coord=clean($_POST["facility_coord"]);$recycl_waste_quantity=clean($_POST["recycl_waste_quantity"]);$recycl_waste_method=clean($_POST["recycl_waste_method"]);$waste_sharp_quantity=clean($_POST["waste_sharp_quantity"]);$waste_sharp_method=clean($_POST["waste_sharp_method"]);
	
	if(!empty($_POST["health_care"]))	$health_care=json_encode($_POST["health_care"]);
	else	$health_care=NULL;
	if(!empty($_POST["hcf"]))	$hcf=json_encode($_POST["hcf"]);
	else	$hcf=NULL;
	if(!empty($_POST["cbmwtf"]))	$cbmwtf=json_encode($_POST["cbmwtf"]);
	else	$cbmwtf=NULL;
	if(!empty($_POST["yellow_qnt"]))	$yellow_qnt=json_encode($_POST["yellow_qnt"]);
	else	$yellow_qnt=NULL;
	if(!empty($_POST["yellow_meth"]))	$yellow_meth=json_encode($_POST["yellow_meth"]);
	else	$yellow_meth=NULL;
	if(!empty($_POST["blue_qnt"]))	$blue_qnt=json_encode($_POST["blue_qnt"]);
	else	$blue_qnt=NULL;
	if(!empty($_POST["blue_meth"]))	$blue_meth=json_encode($_POST["blue_meth"]);
	else	$blue_meth=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,health_care,facility_coord,hcf,cbmwtf,yellow_qnt,yellow_meth,recycl_waste_quantity,recycl_waste_method,waste_sharp_quantity,waste_sharp_method,blue_qnt,blue_meth) values('$swr_id','$health_care','$facility_coord','$hcf','$cbmwtf','$yellow_qnt','$yellow_meth','$recycl_waste_quantity','$recycl_waste_method','$waste_sharp_quantity','$waste_sharp_method','$blue_qnt','$blue_meth')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', health_care='$health_care',facility_coord='$facility_coord',hcf='$hcf',cbmwtf='$cbmwtf',yellow_qnt='$yellow_qnt',yellow_meth='$yellow_meth',recycl_waste_quantity='$recycl_waste_quantity',recycl_waste_method='$recycl_waste_method',waste_sharp_quantity='$waste_sharp_quantity',waste_sharp_method='$waste_sharp_method',blue_qnt='$blue_qnt',blue_meth='$blue_meth' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}
if(isset($_POST["save43c"])){
	$mode_trans=clean($_POST["mode_trans"]);$auth_details=clean($_POST["auth_details"]);
	
	if(!empty($_POST["num"]))	$num=json_encode($_POST["num"]);
	else	$num=NULL;
	if(!empty($_POST["capacity"]))	$capacity=json_encode($_POST["capacity"]);
	else	$capacity=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,mode_trans,num,capacity,auth_details) values('$swr_id','$mode_trans','$num','$capacity','$auth_details')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', mode_trans='$mode_trans',num='$num',capacity='$capacity',auth_details='$auth_details' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}
}

if(isset($_POST["save44a"])){
	$facility_name=clean($_POST["facility_name"]);$applic_tele_no=clean($_POST["applic_tele_no"]);$applic_fax_no=clean($_POST["applic_fax_no"]);$applic_web_addr=clean($_POST["applic_web_addr"]);$fresh_renew=clean($_POST["fresh_renew"]);$if_applied=clean($_POST["if_applied"]);$prev_auth_no=clean($_POST["prev_auth_no"]);$renew_date=clean($_POST["renew_date"]);$under_water=clean($_POST["under_water"]);$under_air=clean($_POST["under_air"]);
	
	if(!empty($_POST["auth_sght"]))	$auth_sght=json_encode($_POST["auth_sght"]);
	else	$auth_sght=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,facility_name,applic_tele_no,applic_fax_no,applic_web_addr,auth_sght,fresh_renew,if_applied,prev_auth_no,renew_date,under_water,under_air) values('$swr_id','$facility_name','$applic_tele_no','$applic_fax_no','$applic_web_addr','$auth_sght','$fresh_renew','$if_applied','$prev_auth_no','$renew_date','$under_water','$under_air')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',facility_name='$facility_name',applic_tele_no='$applic_tele_no',applic_fax_no='$applic_fax_no',applic_web_addr='$applic_web_addr',auth_sght='$auth_sght',fresh_renew='$fresh_renew', if_applied='$if_applied', prev_auth_no='$prev_auth_no',renew_date='$renew_date',under_water='$under_water',under_air='$under_air' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save44b"])){
	$facility_coord=clean($_POST["facility_coord"]);$recycl_waste_quantity=clean($_POST["recycl_waste_quantity"]);$recycl_waste_method=clean($_POST["recycl_waste_method"]);$waste_sharp_quantity=clean($_POST["waste_sharp_quantity"]);$waste_sharp_method=clean($_POST["waste_sharp_method"]);
	
	if(!empty($_POST["health_care"]))	$health_care=json_encode($_POST["health_care"]);
	else	$health_care=NULL;
	if(!empty($_POST["hcf"]))	$hcf=json_encode($_POST["hcf"]);
	else	$hcf=NULL;
	if(!empty($_POST["cbmwtf"]))	$cbmwtf=json_encode($_POST["cbmwtf"]);
	else	$cbmwtf=NULL;
	if(!empty($_POST["yellow_qnt"]))	$yellow_qnt=json_encode($_POST["yellow_qnt"]);
	else	$yellow_qnt=NULL;
	if(!empty($_POST["yellow_meth"]))	$yellow_meth=json_encode($_POST["yellow_meth"]);
	else	$yellow_meth=NULL;
	if(!empty($_POST["blue_qnt"]))	$blue_qnt=json_encode($_POST["blue_qnt"]);
	else	$blue_qnt=NULL;
	if(!empty($_POST["blue_meth"]))	$blue_meth=json_encode($_POST["blue_meth"]);
	else	$blue_meth=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,health_care,facility_coord,hcf,cbmwtf,yellow_qnt,yellow_meth,recycl_waste_quantity,recycl_waste_method,waste_sharp_quantity,waste_sharp_method,blue_qnt,blue_meth) values('$swr_id','$health_care','$facility_coord','$hcf','$cbmwtf','$yellow_qnt','$yellow_meth','$recycl_waste_quantity','$recycl_waste_method','$waste_sharp_quantity','$waste_sharp_method','$blue_qnt','$blue_meth')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', health_care='$health_care',facility_coord='$facility_coord',hcf='$hcf',cbmwtf='$cbmwtf',yellow_qnt='$yellow_qnt',yellow_meth='$yellow_meth',recycl_waste_quantity='$recycl_waste_quantity',recycl_waste_method='$recycl_waste_method',waste_sharp_quantity='$waste_sharp_quantity',waste_sharp_method='$waste_sharp_method',blue_qnt='$blue_qnt',blue_meth='$blue_meth' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}
if(isset($_POST["save44c"])){
	$mode_trans=clean($_POST["mode_trans"]);$auth_details=clean($_POST["auth_details"]);
	
	if(!empty($_POST["num"]))	$num=json_encode($_POST["num"]);
	else	$num=NULL;
	if(!empty($_POST["capacity"]))	$capacity=json_encode($_POST["capacity"]);
	else	$capacity=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,mode_trans,num,capacity,auth_details) values('$swr_id','$mode_trans','$num','$capacity','$auth_details')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', mode_trans='$mode_trans',num='$num',capacity='$capacity',auth_details='$auth_details' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}
}

if(isset($_POST["save45a"])){
	$hcf_name=clean($_POST["hcf_name"]);$fax_no=clean($_POST["fax_no"]);$web_url=clean($_POST["web_url"]);$gps_coord=clean($_POST["gps_coord"]);$owner=clean($_POST["owner"]);$water_act=clean($_POST["water_act"]);
	
	if(!empty($_POST["bmw"]))	$bmw=json_encode($_POST["bmw"]);
	else	$bmw=NULL;
	if(!empty($_POST["hcf_type"]))	$hcf_type=json_encode($_POST["hcf_type"]);
	else	$hcf_type=NULL;
	if(!empty($_POST["cbmwtf_details"]))	$cbmwtf_details=json_encode($_POST["cbmwtf_details"]);
	else	$cbmwtf_details=NULL;
	if(!empty($_POST["wasteq"]))	$wasteq=json_encode($_POST["wasteq"]);
	else	$wasteq=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,hcf_name,fax_no,web_url,gps_coord,owner,bmw,water_act,hcf_type,cbmwtf_details,wasteq) values('$swr_id','$hcf_name','$fax_no','$web_url','$gps_coord','$owner','$bmw','$water_act','$hcf_type','$cbmwtf_details','$wasteq')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',hcf_name='$hcf_name',fax_no='$fax_no',web_url='$web_url',gps_coord='$gps_coord',owner='$owner', bmw='$bmw',water_act='$water_act', hcf_type='$hcf_type',cbmwtf_details='$cbmwtf_details', wasteq='$wasteq' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save45b"])){
	$quant_recycle=clean($_POST["quant_recycle"]);$num_vehicle=clean($_POST["num_vehicle"]);$cbmwtf_op_nam=clean($_POST["cbmwtf_op_nam"]);
	
	if(!empty($_POST["details_ossf"]))	$details_ossf=json_encode($_POST["details_ossf"]);
	else	$details_ossf=NULL;
	if(!empty($_POST["num"]))	$num=json_encode($_POST["num"]);
	else	$num=NULL;
	if(!empty($_POST["capacity"]))	$capacity=json_encode($_POST["capacity"]);
	else	$capacity=NULL;
	if(!empty($_POST["quantity"]))	$quantity=json_encode($_POST["quantity"]);
	else	$quantity=NULL;
	if(!empty($_POST["quant_gen"]))	$quant_gen=json_encode($_POST["quant_gen"]);
	else	$quant_gen=NULL;
	if(!empty($_POST["whr_disposed"]))	$whr_disposed=json_encode($_POST["whr_disposed"]);
	else	$whr_disposed=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,details_ossf,num,capacity,quantity,quant_recycle,num_vehicle,quant_gen,whr_disposed,cbmwtf_op_nam,hcf_not_handed) values('$swr_id','$details_ossf','$num','$capacity','$quantity','$quant_recycle','$num_vehicle','$quant_gen','$whr_disposed','$cbmwtf_op_nam')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', details_ossf='$details_ossf',num='$num',capacity='$capacity',quantity='$quantity',quant_recycle='$quant_recycle',num_vehicle='$num_vehicle',quant_gen='$quant_gen',whr_disposed='$whr_disposed',cbmwtf_op_nam='$cbmwtf_op_nam' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}
if(isset($_POST["save45c"])){
	$do_you_bmw=clean($_POST["do_you_bmw"]);$avail=clean($_POST["avail"]);$are_you=clean($_POST["are_you"]);$std_not_met=clean($_POST["std_not_met"]);$details_coemsi=clean($_POST["details_coemsi"]);$waste_gen_meth=clean($_POST["waste_gen_meth"]);$std_not_met_year=clean($_POST["std_not_met_year"]);$is_met=clean($_POST["is_met"]);$std_not_met_year2=clean($_POST["std_not_met_year2"]);$other_info=clean($_POST["other_info"]);$name_hod=clean($_POST["name_hod"]);$sign_hod=clean($_POST["sign_hod"]);
	
	if(!empty($_POST["bmw_details"]))	$bmw_details=json_encode($_POST["bmw_details"]);
	else	$bmw_details=NULL;
	if(!empty($_POST["accid_details"]))	$accid_details=json_encode($_POST["accid_details"]);
	else	$accid_details=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,do_you_bmw,bmw_details,avail,accid_details,are_you,std_not_met,details_coemsi,waste_gen_meth,std_not_met_year,is_met,std_not_met_year2,other_info,name_hod,sign_hod) values('$swr_id','$do_you_bmw','$bmw_details','$avail','$accid_details','$are_you','$std_not_met','$details_coemsi','$waste_gen_meth','$std_not_met_year','$is_met','$std_not_met_year2','$other_info','$name_hod','$sign_hod')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', do_you_bmw='$do_you_bmw',bmw_details='$bmw_details',avail='$avail',accid_details='$accid_details',are_you='$are_you',std_not_met='$std_not_met',details_coemsi='$details_coemsi',waste_gen_meth='$waste_gen_meth',std_not_met_year='$std_not_met_year',is_met='$is_met',std_not_met_year2='$std_not_met_year2',other_info='$other_info',name_hod='$name_hod',sign_hod='$sign_hod' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}
}

?>
