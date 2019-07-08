<?php
if(isset($_POST["save4"])){
	$submitted_by=$_POST["submitted_by"];
	$submitted_by_array=Array();
	$submitted_by_array=implode(",",$submitted_by);
	$used_bat=clean($_POST["used_bat"]);
	if(!empty($_POST["total_no_batteries"])) $total_no_batteries=json_encode($_POST["total_no_batteries"]);
	else $total_no_batteries=NULL;
	if(!empty($_POST["collection_center"]))	 $collection_center=json_encode($_POST["collection_center"]);
	else	$collection_center=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,submitted_by,used_bat,total_no_batteries,collection_center) values ('$swr_id','$today','$today','$submitted_by_array', '$used_bat', '$total_no_batteries','$collection_center')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today', submitted_by='$submitted_by_array',used_bat='$used_bat', total_no_batteries='$total_no_batteries', collection_center='$collection_center' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}			
}

if(isset($_POST["save5"])) {	
	$imprt_license_no=clean($_POST["imprt_license_no"]);$occupier_name=clean($_POST["occupier_name"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,imprt_license_no,occupier_name) values ('$swr_id','$today', '$imprt_license_no', '$occupier_name')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',save_mode='D', imprt_license_no='$imprt_license_no',occupier_name='$occupier_name' where user_id='$swr_id' and form_id='$form_id'");		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //pcb-- dept name and 5 -- form no
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

if(isset($_POST["save6"])) {
	$import_process=clean($_POST["import_process"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,import_process) values ('$swr_id','$today', '$import_process')");
	   $form_id=$query;
	}else{  
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',save_mode='D', import_process='$import_process' where user_id='$swr_id' and form_id='$form_id'");		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //pcb-- dept name and 6 -- form no
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

if(isset($_POST["save7"])){
	$total_batt_impt=clean($_POST["total_batt_impt"]);$used_batteries=clean($_POST["used_batteries"]);
	if(!empty($_POST["new_batteries"])) $new_batteries=json_encode($_POST["new_batteries"]);
	else $new_batteries=NULL;
	if(!empty($_POST["collection_center"]))	 $collection_center=json_encode($_POST["collection_center"]);
	else	$collection_center=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,total_batt_impt,used_batteries,new_batteries,collection_center) values ('$swr_id','$today','$total_batt_impt', '$used_batteries', '$new_batteries', '$collection_center')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',total_batt_impt='$total_batt_impt',used_batteries='$used_batteries', new_batteries='$new_batteries', collection_center='$collection_center' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  //pcb-- dept name and 7 -- form no
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save8"])){
	$tot_used_batteries=clean($_POST["tot_used_batteries"]);
	if(!empty($_POST["new_batteries"])) $new_batteries=json_encode($_POST["new_batteries"]);
	else $new_batteries=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,new_batteries,tot_used_batteries) values ('$swr_id','$today','$today','$new_batteries','$tot_used_batteries')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' ,new_batteries='$new_batteries', tot_used_batteries='$tot_used_batteries' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //pcb-- dept name and 8 -- form no
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}			
}	

if(isset($_POST["save9a"])){
	///////battery form 9_a/////
	$com_date=clean($_POST["com_date"]);$no_workers=clean($_POST["no_workers"]);$validity_haz_waste=clean($_POST["validity_haz_waste"]);$prod_capacity=clean($_POST["prod_capacity"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];		
	if(!empty($_POST["consent_validate"])) $consent_validity=json_encode($_POST["consent_validate"]);
		else $consent_validity=NULL;

		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){ ////////IF table is empty////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,com_date,no_workers,validity_haz_waste,prod_capacity,consent_validity) values ('$swr_id','$today', '$com_date', '$no_workers', '$validity_haz_waste', '$prod_capacity','$consent_validity')");	
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', com_date='$com_date',no_workers='$no_workers', validity_haz_waste='$validity_haz_waste', prod_capacity='$prod_capacity', consent_validity='$consent_validity' where form_id='$form_id'");
	}			
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,product_name,year1,year2,year3) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,product_name,year1,year2,year3) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		$formFunctions->insert_incomplete_forms($dept,$form); //pcb-- dept name and 9 -- form no
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}
}					
if(isset($_POST["save9b"])){
	////////battery form 9_b///////
	$water_fee=clean($_POST["water_fee"]);$air_fug_emission=clean($_POST["air_fug_emission"]);$is_faci_provided=clean($_POST["is_faci_provided"]);$disp_detail=clean($_POST["disp_detail"]);
	$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];	$input_size5=$_POST["hiddenval5"];$input_size6=$_POST["hiddenval6"];$input_size7=$_POST["hiddenval7"];$input_size8=$_POST["hiddenval8"];	
	if(!empty($_POST["water_consption"])) $water_consption=json_encode($_POST["water_consption"]);
	else $water_consption=NULL;
	if(!empty($_POST["waste_water"]))	 $waste_water=json_encode($_POST["waste_water"]);
	else	$waste_water=NULL;
	if(!empty($_POST["waste_wat_dis"]))	 $waste_wat_dis=json_encode($_POST["waste_wat_dis"]);
	else	$waste_wat_dis=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){ 
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,water_fee,air_fug_emission, is_faci_provided, water_consption, waste_water, waste_wat_dis,disp_detail) values ('$swr_id','$today','$water_fee', '$air_fug_emission', '$is_faci_provided','$water_consption', '$waste_water','$waste_wat_dis','$disp_detail')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', water_fee='$water_fee',air_fug_emission='$air_fug_emission', is_faci_provided='$is_faci_provided', water_consption='$water_consption', waste_water='$waste_water', waste_wat_dis='$waste_wat_dis', disp_detail='$disp_detail' where form_id='$form_id'");
	}			
	if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,fuel,quantity) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,stack,quantity) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,location,result) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["texttB".$i];
				$valc=$_POST["texttC".$i];
				$vald=$_POST["texttD".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,slno,name,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtttB".$i];
				$valc=$_POST["txtttC".$i];
				$vald=$_POST["txtttD".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(form_id,slno,name,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];
				$vald=$_POST["ttxtD".$i];				
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(form_id,slno,name,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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
if(isset($_POST["save9c"])){
	////////battery form 9_c///////
	$is_adequate_prov=clean($_POST["is_adequate_prov"]);$is_compliance=clean($_POST["is_compliance"]);$is_satisfactory=clean($_POST["is_satisfactory"]);$is_condition=clean($_POST["is_condition"]);$is_material_handled=clean($_POST["is_material_handled"]);
	if($is_adequate_prov=="Y") $yes_adeq_detail=clean($_POST["yes_adeq_detail"]);
	else $yes_adeq_detail="";
	if(!empty($_POST["waste_proposed"])) $waste_proposed=json_encode($_POST["waste_proposed"]);
	else $waste_proposed=NULL;
	if(!empty($_POST["cost_pollution"]))	 $cost_pollution=json_encode($_POST["cost_pollution"]);
	else	$cost_pollution=NULL;
	if(!empty($_POST["other_info"]))	 $other_info=json_encode($_POST["other_info"]);
	else	$other_info=NULL;	
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){ ////////IF table is empty////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_adequate_prov,yes_adeq_detail,is_compliance,is_satisfactory,is_condition,is_material_handled,waste_proposed,cost_pollution,other_info) values ('$swr_id','$today','$is_adequate_prov', '$yes_adeq_detail', '$is_compliance','$is_satisfactory','$is_condition','$is_material_handled','$waste_proposed','$cost_pollution,'$other_info')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_adequate_prov='$is_adequate_prov',yes_adeq_detail='$yes_adeq_detail',is_compliance='$is_compliance',is_satisfactory='$is_satisfactory',is_condition='$is_condition',is_material_handled='$is_material_handled',waste_proposed='$waste_proposed',cost_pollution='$cost_pollution',other_info='$other_info' where  form_id='$form_id'");
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

if(isset($_POST["save10"])){
	$annual_cap=clean($_POST["annual_cap"]);$qnty_recovd_scrap=clean($_POST["qnty_recovd_scrap"]);
	if(!empty($_POST["total_qnty"])) $total_qnty=json_encode($_POST["total_qnty"]);
	else $total_qnty=NULL;
	if(!empty($_POST["qnty_recved"]))	 $qnty_recved=json_encode($_POST["qnty_recved"]);
	else	$collection_center=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,annual_cap,total_qnty,qnty_recovd_scrap,qnty_recved) values ('$swr_id','$today','$today','$annual_cap','$total_qnty', '$qnty_recovd_scrap','$qnty_recved')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' ,annual_cap='$annual_cap',total_qnty='$total_qnty', qnty_recovd_scrap='$qnty_recovd_scrap',  qnty_recved='$qnty_recved' where user_id='$swr_id' and form_id='$form_id'");
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

if(isset($_POST["save11"])){
	$no_used_batt=clean($_POST["no_used_batt"]);
	if(!empty($_POST["new_batteries"])) $new_batteries=json_encode($_POST["new_batteries"]);
	else $new_batteries=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,sub_date,received_date,new_batteries,no_used_batt) values ('$swr_id','$today','$today','$new_batteries', '$no_used_batt')");
		$form_id=$query;
	}else{	
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' ,new_batteries='$new_batteries', no_used_batt='$no_used_batt' where user_id='$swr_id' and form_id='$form_id'");
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

if(isset($_POST["save12"])){	
	$used_batt_scrap=clean($_POST["used_batt_scrap"]);
	if(!empty($_POST["num_used_batt"])) $num_used_batt=json_encode($_POST["num_used_batt"]);
	else $num_used_batt=NULL;
	if(!empty($_POST["num_auct_batteries"])) $num_auct_batteries=json_encode($_POST["num_auct_batteries"]);
	else $num_auct_batteries=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,num_used_batt,num_auct_batteries,used_batt_scrap) values ('$swr_id','$today','$today','$num_used_batt', '$num_auct_batteries','$used_batt_scrap')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' ,num_used_batt='$num_used_batt',num_auct_batteries='$num_auct_batteries',used_batt_scrap='$used_batt_scrap' where user_id='$swr_id' and form_id='$form_id'");
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

?>