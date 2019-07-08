<?php
if(isset($_POST["save61"])){
	$agency_name=clean($_POST["agency_name"]);$municipal_auth=clean($_POST["municipal_auth"]);$officer_name=clean($_POST["officer_name"]);$officer_desgn=clean($_POST["officer_desgn"]);$applied_auth=clean($_POST["applied_auth"]);
	
	if(!empty($_POST["corr_add"]))	 $corr_add=json_encode($_POST["corr_add"]);
	else	$corr_add=NULL;
	if(!empty($_POST["proposal"]))	 $proposal=json_encode($_POST["proposal"]);
	else	$proposal=NULL;
	if(!empty($_POST["plan"]))	 $plan=json_encode($_POST["plan"]);
	else	$plan=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   //////////// Table is empty //////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,agency_name,municipal_auth,officer_name,officer_desgn,applied_auth,corr_add,proposal,plan) values ('$swr_id','$today','$agency_name','$municipal_auth','$officer_name','$officer_desgn', '$applied_auth', '$corr_add','$proposal','$plan')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',agency_name='$agency_name',municipal_auth='$municipal_auth',officer_name='$officer_name',officer_desgn='$officer_desgn',applied_auth='$applied_auth',corr_add='$corr_add',proposal='$proposal',plan='$plan' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save62"])){
	$trader_name=clean($_POST["trader_name"]);$tin_num=clean($_POST["tin_num"]);$waste_desc=clean($_POST["waste_desc"]);$waste_qty=clean($_POST["waste_qty"]);$storage=clean($_POST["storage"]);
	
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,trader_name,tin_num,waste_desc,waste_qty,storage,address) values ('$swr_id','$today','$trader_name','$tin_num','$waste_desc','$waste_qty', '$storage', '$address')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',trader_name='$trader_name',tin_num='$tin_num',waste_desc='$waste_desc',waste_qty='$waste_qty',storage='$storage',address='$address' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save63"])){
	$auth_num=clean($_POST["auth_num"]);$auth_date=clean($_POST["auth_date"]);$validity=clean($_POST["validity"]);
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_num,auth_date,validity) values ('$swr_id','$today','$auth_num','$auth_date','$validity')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_num='$auth_num',auth_date='$auth_date',validity='$validity' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save64"])){
	$facilities=clean($_POST["facilities"]);
	
	if(!empty($_POST["contact"]))	 $contact=json_encode($_POST["contact"]);
	else	$contact=NULL;
	if(!empty($_POST["ewaste"]))	 $ewaste=json_encode($_POST["ewaste"]);
	else	$ewaste=NULL;
	if(!empty($_POST["authorization"]))	 $authorization=json_encode($_POST["authorization"]);
	else	$authorization=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,facilities,contact,ewaste,authorization) values ('$swr_id','$today','$facilities','$contact','$ewaste','$authorization')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',facilities='$facilities',contact='$contact',ewaste='$ewaste',authorization='$authorization' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save65"])){
	$owner_name=clean($_POST["owner_name"]);$occupier_name=clean($_POST["occupier_name"]);
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,occupier_name) values ('$swr_id','$today','$owner_name','$occupier_name')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_name='$owner_name',occupier_name='$occupier_name' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save71"])){
	$input_size=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
 	$comm_date=clean($_POST["comm_date"]);$no_of_workers=clean($_POST["no_of_workers"]);$water_valid=clean($_POST["water_valid"]);$air_valid=clean($_POST["air_valid"]);$auth_valid=clean($_POST["auth_valid"]);$ewaste_details=clean($_POST["ewaste_details"]);$safety=clean($_POST["safety"]);$facilities=clean($_POST["facilities"]);
	
	if(!empty($_POST["contact"]))	 $contact=json_encode($_POST["contact"]);
	else	$contact=NULL;
	if(!empty($_POST["waste"]))	 $waste=json_encode($_POST["waste"]);
	else	$waste=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,comm_date,no_of_workers,water_valid,air_valid,auth_valid,ewaste_details,safety,facilities,contact,waste) values ('$swr_id','$today','$comm_date','$no_of_workers','$water_valid','$air_valid', '$auth_valid','$ewaste_details','$safety','$facilities','$contact','$waste')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',comm_date='$comm_date',no_of_workers='$no_of_workers',water_valid='$water_valid',air_valid='$air_valid',auth_valid='$auth_valid',ewaste_details='$ewaste_details',safety='$safety',facilities='$facilities',contact='$contact',waste='$waste' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");		
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,products,capacity) VALUES ('','$form_id','$i','$valb','$valc')");				
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,year,product,qty) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save72"])){
	$facility_name=clean($_POST["facility_name"]);$officer_name=clean($_POST["officer_name"]);$officer_desgn=clean($_POST["officer_desgn"]);$info=clean($_POST["info"]);
	
	if(!empty($_POST["corr_add"]))	 $corr_add=json_encode($_POST["corr_add"]);
	else	$corr_add=NULL;
	if(!empty($_POST["waste"]))	 $waste=json_encode($_POST["waste"]);
	else	$waste=NULL;
	if(!empty($_POST["disposal"]))	 $disposal=json_encode($_POST["disposal"]);
	else	$disposal=NULL;
	if(!empty($_POST["authorization"]))	 $authorization=json_encode($_POST["authorization"]);
	else	$authorization=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,facility_name,officer_name,officer_desgn,info,corr_add,waste,disposal,authorization) values ('$swr_id','$today','$facility_name','$officer_name','$officer_desgn','$info','$corr_add','$waste','$disposal','$authorization')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',facility_name='$facility_name',officer_name='$officer_name',officer_desgn='$officer_desgn',info='$info',corr_add='$corr_add',waste='$waste',disposal='$disposal',authorization='$authorization' where form_id=$form_id");		
	}		
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save74"])){
	$facilities=clean($_POST["facilities"]);$prev_auth_num=clean($_POST["prev_auth_num"]);$prev_auth_dt=clean($_POST["prev_auth_dt"]);$annual_returns=clean($_POST["annual_returns"]);
	
	if(!empty($_POST["contact"]))	 $contact=json_encode($_POST["contact"]);
	else	$contact=NULL;
	if(!empty($_POST["ewaste"]))	 $ewaste=json_encode($_POST["ewaste"]);
	else	$ewaste=NULL;
	if(!empty($_POST["authorization"]))	 $authorization=json_encode($_POST["authorization"]);
	else	$authorization=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,facilities,prev_auth_num,prev_auth_dt,annual_returns,contact,ewaste,authorization) values ('$swr_id','$today','$facilities','$prev_auth_num','$prev_auth_dt','$annual_returns','$contact','$ewaste','$authorization')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',facilities='$facilities',prev_auth_num='$prev_auth_num',prev_auth_dt='$prev_auth_dt',annual_returns='$annual_returns',contact='$contact',ewaste='$ewaste',authorization='$authorization' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save75"])){
	$agency_name=clean($_POST["agency_name"]);$municipal_auth=clean($_POST["municipal_auth"]);$officer_name=clean($_POST["officer_name"]);$officer_desgn=clean($_POST["officer_desgn"]);$applied_auth=clean($_POST["applied_auth"]);
	
	if(!empty($_POST["corr_add"]))	 $corr_add=json_encode($_POST["corr_add"]);
	else	$corr_add=NULL;
	if(!empty($_POST["proposal"]))	 $proposal=json_encode($_POST["proposal"]);
	else	$proposal=NULL;
	if(!empty($_POST["plan"]))	 $plan=json_encode($_POST["plan"]);
	else	$plan=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,agency_name,municipal_auth,officer_name,officer_desgn,applied_auth,corr_add,proposal,plan) values ('$swr_id','$today','$agency_name','$municipal_auth','$officer_name','$officer_desgn', '$applied_auth', '$corr_add','$proposal','$plan')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',agency_name='$agency_name',municipal_auth='$municipal_auth',officer_name='$officer_name',officer_desgn='$officer_desgn',applied_auth='$applied_auth',corr_add='$corr_add',proposal='$proposal',plan='$plan' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save76"])){
	$input_size=clean($_POST["hiddenval"]);		
	$city_name=clean($_POST["city_name"]);$population=clean($_POST["population"]);$auth_name=clean($_POST["auth_name"]);$officer_name=clean($_POST["officer_name"]);$officer_desgn=clean($_POST["officer_desgn"]);$waste_used=clean($_POST["waste_used"]);$is_practice=clean($_POST["is_practice"]);$lift_bin_equip=clean($_POST["lift_bin_equip"]);$improve=clean($_POST["improve"]);$efforts=clean($_POST["efforts"]);$slums=clean($_POST["slums"]);$is_action=clean($_POST["is_action"]);$is_action_details=clean($_POST["is_action_details"]);
	
	/* for disabled select box */
	if(isset($_POST["is_practice_details"])) $is_practice_details=clean($_POST["is_practice_details"]); 
	else $is_practice_details=""; 
	
	if(!empty($_POST["auth"]))	  $auth=json_encode($_POST["auth"]);
	else	$auth=NULL;
	if(!empty($_POST["generate"]))	 $generate=json_encode($_POST["generate"]);
	else	$generate=NULL;
	if(!empty($_POST["recycle"]))	  $recycle=json_encode($_POST["recycle"]);
	else	$recycle=NULL;
	if(!empty($_POST["dispose"]))	 $dispose=json_encode($_POST["dispose"]);
	else	$dispose=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;	
	if(!empty($_POST["lift_bin"]))	 $lift_bin=json_encode($_POST["lift_bin"]);
	else	$lift_bin=NULL;
	if(!empty($_POST["required"]))	  $required=json_encode($_POST["required"]);
	else	$required=NULL;
	if(!empty($_POST["technologies"]))	  $technologies=json_encode($_POST["technologies"]);
	else	$technologies=NULL;
	if(!empty($_POST["provisions"]))	  $provisions=json_encode($_POST["provisions"]);
	else	$provisions=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,city_name,population,auth_name,officer_name,officer_desgn,waste_used,is_practice,is_practice_details,lift_bin_equip,auth,generate,recycle,dispose,storage,lift_bin,required,improve,efforts,technologies,slums,is_action,is_action_details,provisions) values ('$swr_id','$today','$city_name','$population','$auth_name','$officer_name','$officer_desgn','$waste_used','$is_practice','$is_practice_details','$lift_bin_equip','$auth','$generate','$recycle','$dispose','$storage','$lift_bin','$required','$improve','$efforts','$technologies','$slums','$is_action','$is_action_details','$provisions')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',city_name='$city_name',population='$population',auth_name='$auth_name',officer_name='$officer_name',officer_desgn='$officer_desgn',waste_used='$waste_used',is_practice='$is_practice',is_practice_details='$is_practice_details',lift_bin_equip='$lift_bin_equip',auth='$auth',generate='$generate',recycle='$recycle',dispose='$dispose',storage='$storage',lift_bin='$lift_bin',required='$required',improve='$improve',efforts='$efforts',technologies='$technologies',slums='$slums',is_action='$is_action',is_action_details='$is_action_details',provisions='$provisions' where form_id=$form_id");			
	}
	if($query){		
		$formFunctions->insert_incomplete_forms($dept,$form); 		
		if($input_size!=0){	
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");		
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,specification,existing_no,future) VALUES('','$form_id','$i','$valb','$valc','$vald')");	
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

if(isset($_POST["save77"])){
	$owner_name=clean($_POST["owner_name"]);$occupier_name=clean($_POST["occupier_name"]);
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,occupier_name) values ('$swr_id','$today','$owner_name','$occupier_name')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_name='$owner_name',occupier_name='$occupier_name' where form_id=$form_id");		
	}		
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save78a"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	$comm_date=clean($_POST["comm_date"]);$no_of_workers=clean($_POST["no_of_workers"]);$water_valid=clean($_POST["water_valid"]);$air_valid=clean($_POST["air_valid"]);$auth_valid=clean($_POST["auth_valid"]);$capacity=clean($_POST["capacity"]);$water_cess=clean($_POST["water_cess"]);
	
	if(!empty($_POST["contact"]))	 $contact=json_encode($_POST["contact"]);
	else	$contact=NULL;
	if(!empty($_POST["water_consume"]))	$water_consume=json_encode($_POST["water_consume"]);
	else	$water_consume=NULL;
	if(!empty($_POST["water_gen"]))	 $water_gen=json_encode($_POST["water_gen"]);
	else	$water_gen=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,comm_date,no_of_workers,water_valid,air_valid,auth_valid,capacity,water_cess,contact,water_consume,water_gen)values('$swr_id','$today','$comm_date','$no_of_workers','$water_valid','$air_valid','$auth_valid','$capacity','$water_cess','$contact','$water_consume','$water_gen')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',comm_date='$comm_date',no_of_workers='$no_of_workers',water_valid='$water_valid',air_valid='$air_valid',auth_valid='$auth_valid',capacity='$capacity',water_cess='$water_cess',contact='$contact',water_consume='$water_consume',water_gen='$water_gen' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,year1,year2,year3) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");				
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
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,name,year1,year2,year3) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}
if(isset($_POST["save78b"])){
	$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);$air_facilities=clean($_POST["air_facilities"]);
	
	if(!empty($_POST["waste"]))	$waste=json_encode($_POST["waste"]);
	else	$waste=NULL;	
	if(!empty($_POST["water_treat"]))	 $water_treat=json_encode($_POST["water_treat"]);
	else	$water_treat=NULL;
	if(!empty($_POST["discharge"]))	$discharge=json_encode($_POST["discharge"]);
	else	$discharge=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,air_facilities,waste,water_treat,discharge)values('$swr_id','$air_facilities','$waste','$water_treat','$discharge')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set air_facilities='$air_facilities',waste='$waste',water_treat='$water_treat',discharge='$discharge' where form_id=$form_id");		
	}				
	if($query){		
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["text1A".$i];	
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["text2A".$i];	
				$valb=$_POST["text2B".$i];
				$valc=$_POST["text2C".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,sl_no,stack,emission) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["text3A".$i];	
				$valb=$_POST["text3B".$i];
				$valc=$_POST["text3C".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,sl_no,loc,result) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["text4A".$i];	
				$valb=$_POST["text4B".$i];
				$valc=$_POST["text4C".$i];
				$vald=$_POST["text4D".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,sl_no,name,category,qty) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
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
if(isset($_POST["save78c"])){	
 	$occ_safety=clean($_POST["occ_safety"]);$is_pollution=clean($_POST["is_pollution"]);$is_pollution_details=clean($_POST["is_pollution_details"]);$is_compliance=clean($_POST["is_compliance"]);$is_operation=clean($_POST["is_operation"]);$is_conditions=clean($_POST["is_conditions"]);$is_leachate=clean($_POST["is_leachate"]);$info=clean($_POST["info"]);
	
	if(!empty($_POST["auction"]))	 $auction=json_encode($_POST["auction"]);
	else	$auction=NULL;
	if(!empty($_POST["cost"]))	 $cost=json_encode($_POST["cost"]);
	else	$cost=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,occ_safety,is_pollution,is_pollution_details,is_compliance,is_operation,is_conditions,is_leachate,info,auction,cost)values('$swr_id','$occ_safety','$is_pollution','$is_pollution_details','$is_compliance','$is_operation','$is_conditions','$is_leachate','$info','$auction','$cost')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set occ_safety='$occ_safety',is_pollution='$is_pollution',is_pollution_details='$is_pollution_details',is_compliance='$is_compliance',is_operation='$is_operation',is_conditions='$is_conditions',is_leachate='$is_leachate',info='$info',auction='$auction',cost='$cost' where form_id=$form_id");		
	}				
	if($query){	
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

if(isset($_POST["save79a"])){
	$city_name=clean($_POST["city_name"]);$state_name=clean($_POST["state_name"]);$population=clean($_POST["population"]);$area=clean($_POST["area"]);
	
	if(!empty($_POST["local"]))	 $local=json_encode($_POST["local"]);
	else	$local=NULL;
	if(!empty($_POST["operator"]))	 $operator=json_encode($_POST["operator"]);
	else	$operator=NULL;
	if(!empty($_POST["officer"]))	 $officer=json_encode($_POST["officer"]);
	else	$officer=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,city_name,state_name,population,area,local,operator,officer) values ('$swr_id','$today','$city_name','$state_name','$population','$area','$local','$operator','$officer')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',city_name='$city_name',state_name='$state_name',population='$population',area='$area',local='$local',operator='$operator',officer='$officer' where form_id=$form_id");		
	}		
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save79b"])){
	$household_no=clean($_POST["household_no"]);$premise_no=clean($_POST["premise_no"]);$election_no=clean($_POST["election_no"]);$source=clean($_POST["source"]);$is_stored=clean($_POST["is_stored"]);$is_segregated=clean($_POST["is_segregated"]);$is_segregated_details=clean($_POST["is_segregated_details"]);$is_d2d=clean($_POST["is_d2d"]);
	
	if(!empty($_POST["quantity"]))	$quantity=json_encode($_POST["quantity"]);
	else	$quantity=NULL;	
	if(!empty($_POST["bins"]))	 $bins=json_encode($_POST["bins"]);
	else	$bins=NULL;
	if(!empty($_POST["d2d"]))	$d2d=json_encode($_POST["d2d"]);
	else	$d2d=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,household_no,premise_no,election_no,source,is_stored,is_segregated,is_segregated_details,is_d2d,quantity,bins,d2d)values('$swr_id','$household_no','$premise_no','$election_no','$source','$is_stored','$is_segregated','$is_segregated_details','$is_d2d','$quantity','$bins','$d2d')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set household_no='$household_no',premise_no='$premise_no',election_no='$election_no',source='$source',is_stored='$is_stored',is_segregated='$is_segregated',is_segregated_details='$is_segregated_details',is_d2d='$is_d2d',quantity='$quantity',bins='$bins',d2d='$d2d' where form_id=$form_id");		
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
if(isset($_POST["save79c"])){
	$input_size1=clean($_POST["hiddenval"]);
	$length=clean($_POST["length"]);$ratio=clean($_POST["ratio"]);
	if(!empty($_POST["percent"]))	 $percent=json_encode($_POST["percent"]);
	else	$percent=NULL;
	if(!empty($_POST["tools"]))	$tools=json_encode($_POST["tools"]);
	else	$tools=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,length,ratio,percent,tools,storage)values('$swr_id','$length','$ratio','$percent','$tools','$storage')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set length='$length',ratio='$ratio',percent='$percent',tools='$tools',storage='$storage' where form_id=$form_id");		
	}				
	if($query){
		if($input_size1!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,number,capacity) VALUES ('','$form_id','$i','$valb','$valc')");				
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
}
if(isset($_POST["save79d"])){
	$total_storage=clean($_POST["total_storage"]);$total_waste=clean($_POST["total_waste"]);$is_facility=clean($_POST["is_facility"]);
	
	if(!empty($_POST["ward"]))	$ward=json_encode($_POST["ward"]);
	else	$ward=NULL;	
	if(!empty($_POST["frequency"]))	 $frequency=json_encode($_POST["frequency"]);
	else	$frequency=NULL;
	if(!empty($_POST["number"]))	$number=json_encode($_POST["number"]);
	else	$number=NULL;
	if(!empty($_POST["lifting"]))	$lifting=json_encode($_POST["lifting"]);
	else	$lifting=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,total_storage,total_waste,is_facility,ward,frequency,number,lifting)values('$swr_id','$total_storage','$total_waste','$is_facility','$ward','$frequency','$number','$lifting')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set total_storage='$total_storage',total_waste='$total_waste',is_facility='$is_facility',ward='$ward',frequency='$frequency',number='$number',lifting='$lifting' where form_id=$form_id");		
	}				
	if($query){		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}	
}
if(isset($_POST["save79e"])){
	$input_size2=clean($_POST["hiddenval2"]);
	$waste_treatment=clean($_POST["waste_treatment"]);$waste_process=clean($_POST["waste_process"]);$waste_process_qty=clean($_POST["waste_process_qty"]);
	if(!empty($_POST["vehicles"]))	 $vehicles=json_encode($_POST["vehicles"]);
	else	$vehicles=NULL;
	if(!empty($_POST["transport"]))	$transport=json_encode($_POST["transport"]);
	else	$transport=NULL;
	if(!empty($_POST["process"]))	 $process=json_encode($_POST["process"]);
	else	$process=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,waste_treatment,waste_process,waste_process_qty,vehicles,transport,process)values('$swr_id','$waste_treatment','$waste_process','$waste_process_qty','$vehicles','$transport','$process')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set waste_treatment='$waste_treatment',waste_process='$waste_process',waste_process_qty='$waste_process_qty',vehicles='$vehicles',transport='$transport',process='$process' where form_id=$form_id");		
	}	
	if($query){	
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,waste,trips) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=6';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}	
}
if(isset($_POST["save79f"])){
	$co_process_raw=clean($_POST["co_process_raw"]);
	if(!empty($_POST["compost"]))	 $compost=json_encode($_POST["compost"]);
	else	$compost=NULL;
	if(!empty($_POST["vermi"]))	 $vermi=json_encode($_POST["vermi"]);
	else	$vermi=NULL;
	if(!empty($_POST["bio"]))	 $bio=json_encode($_POST["bio"]);
	else	$bio=NULL;
	if(!empty($_POST["fuel"]))	 $fuel=json_encode($_POST["fuel"]);
	else	$fuel=NULL;
	if(!empty($_POST["energy"]))	 $energy=json_encode($_POST["energy"]);
	else	$energy=NULL;
	if(!empty($_POST["combustible"]))	 $combustible=json_encode($_POST["combustible"]);
	else	$combustible=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,co_process_raw,compost,vermi,bio,fuel,energy,combustible)values('$swr_id','$co_process_raw','$compost','$vermi','$bio','$fuel','$energy','$combustible')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set co_process_raw='$co_process_raw',compost='$compost',vermi='$vermi',bio='$bio',fuel='$fuel',energy='$energy',combustible='$combustible' where form_id=$form_id");		
	}	
	if($query){		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=7';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=6';
		</script>";
	}	
}
if(isset($_POST["save79g"])){
	$others_s_details=clean($_POST["others_s_details"]);$others_t_details=clean($_POST["others_t_details"]);$action_plan=clean($_POST["action_plan"]);$slums=clean($_POST["slums"]);$manpower=clean($_POST["manpower"]);$difficulties=clean($_POST["difficulties"]);$innovative=clean($_POST["innovative"]);
	
	if(!empty($_POST["others"]))	  $others=json_encode($_POST["others"]);
	else	$others=NULL;
	if(!empty($_POST["provisions"]))	 $provisions=json_encode($_POST["provisions"]);
	else	$provisions=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,others_s_details,others_t_details,action_plan,slums,manpower,difficulties,innovative,others,provisions) values ('$swr_id','$others_s_details','$others_t_details','$action_plan','$slums','$manpower','$difficulties','$innovative','$others','$provisions',)");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set others_s_details='$others_s_details',others_t_details='$others_t_details',action_plan='$action_plan',slums='$slums',manpower='$manpower',difficulties='$difficulties',innovative='$innovative',others='$others',provisions='$provisions' where form_id=$form_id");			
	}
	if($query){		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=7';
		</script>";
	}	
}

if(isset($_POST["save80a"])){
	$city_name=clean($_POST["city_name"]);$state_name=clean($_POST["state_name"]);$population=clean($_POST["population"]);$area=clean($_POST["area"]);
	
	if(!empty($_POST["local"]))	 $local=json_encode($_POST["local"]);
	else	$local=NULL;
	if(!empty($_POST["no"]))	 $no=json_encode($_POST["no"]);
	else	$no=NULL;
	if(!empty($_POST["officer"]))	 $officer=json_encode($_POST["officer"]);
	else	$officer=NULL;
	if(!empty($_POST["quantity"]))	$quantity=json_encode($_POST["quantity"]);
	else	$quantity=NULL;	
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,city_name,state_name,population,area,local,no,officer,quantity) values ('$swr_id','$today','$city_name','$state_name','$population','$area','$local','$no','$officer','$quantity')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',city_name='$city_name',state_name='$state_name',population='$population',area='$area',local='$local',no='$no',officer='$officer',quantity='$quantity' where form_id=$form_id");		
	}		
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save80b"])){
	$source=clean($_POST["source"]);$is_stored=clean($_POST["is_stored"]);$is_segregated=clean($_POST["is_segregated"]);$is_segregated_details=clean($_POST["is_segregated_details"]);$is_d2d=clean($_POST["is_d2d"]);$length=clean($_POST["length"]);
	
	if(!empty($_POST["bins"]))	 $bins=json_encode($_POST["bins"]);
	else	$bins=NULL;
	if(!empty($_POST["d2d"]))	$d2d=json_encode($_POST["d2d"]);
	else	$d2d=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,source,is_stored,is_segregated,is_segregated_details,is_d2d,length,bins,d2d)values('$swr_id','$source','$is_stored','$is_segregated','$is_segregated_details','$is_d2d','$length','$bins','$d2d')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set source='$source',is_stored='$is_stored',is_segregated='$is_segregated',is_segregated_details='$is_segregated_details',is_d2d='$is_d2d',length='$length',bins='$bins',d2d='$d2d' where form_id=$form_id");		
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
if(isset($_POST["save80c"])){
	$input_size1=clean($_POST["hiddenval"]);
	$ratio=clean($_POST["ratio"]);$total_storage=clean($_POST["total_storage"]);$total_waste=clean($_POST["total_waste"]);
	
	if(!empty($_POST["percent"]))	 $percent=json_encode($_POST["percent"]);
	else	$percent=NULL;
	if(!empty($_POST["tools"]))	$tools=json_encode($_POST["tools"]);
	else	$tools=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	if(!empty($_POST["ward"]))	$ward=json_encode($_POST["ward"]);
	else	$ward=NULL;	
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,ratio,total_storage,total_waste,percent,tools,storage,ward)values('$swr_id','$ratio','$total_storage','$total_waste','$percent','$tools','$storage','$ward')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set ratio='$ratio',total_storage='$total_storage',total_waste='$total_waste',percent='$percent',tools='$tools',storage='$storage',ward='$ward' where form_id=$form_id");		
	}				
	if($query){
		if($input_size1!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,number,capacity) VALUES ('','$form_id','$i','$valb','$valc')");				
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
}
if(isset($_POST["save80d"])){
	$input_size2=clean($_POST["hiddenval2"]);$is_facility=clean($_POST["is_facility"]);
	
	if(!empty($_POST["frequency"]))	 $frequency=json_encode($_POST["frequency"]);
	else	$frequency=NULL;
	if(!empty($_POST["number"]))	$number=json_encode($_POST["number"]);
	else	$number=NULL;
	if(!empty($_POST["lifting"]))	$lifting=json_encode($_POST["lifting"]);
	else	$lifting=NULL;
	if(!empty($_POST["vehicles"]))	 $vehicles=json_encode($_POST["vehicles"]);
	else	$vehicles=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,vehicles,is_facility,frequency,number,lifting)values('$swr_id','$vehicles','$is_facility','$frequency','$number','$lifting')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set vehicles='$vehicles',is_facility='$is_facility',frequency='$frequency',number='$number',lifting='$lifting' where form_id=$form_id");		
	}				
	if($query){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,waste,trips) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}	
}
if(isset($_POST["save80e"])){
	$waste_treatment=clean($_POST["waste_treatment"]);$waste_process=clean($_POST["waste_process"]);$waste_process_qty=clean($_POST["waste_process_qty"]);$co_process_raw=clean($_POST["co_process_raw"]);$treatment_by=clean($_POST["treatment_by"]);
	
	if(!empty($_POST["transport"]))	$transport=json_encode($_POST["transport"]);
	else	$transport=NULL;
	if(!empty($_POST["process"]))	 $process=json_encode($_POST["process"]);
	else	$process=NULL;
	if(!empty($_POST["compost"]))	 $compost=json_encode($_POST["compost"]);
	else	$compost=NULL;
	if(!empty($_POST["vermi"]))	 $vermi=json_encode($_POST["vermi"]);
	else	$vermi=NULL;
	if(!empty($_POST["bio"]))	 $bio=json_encode($_POST["bio"]);
	else	$bio=NULL;
	if(!empty($_POST["fuel"]))	 $fuel=json_encode($_POST["fuel"]);
	else	$fuel=NULL;
	if(!empty($_POST["energy"]))	 $energy=json_encode($_POST["energy"]);
	else	$energy=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,waste_treatment,waste_process,waste_process_qty,transport,process,co_process_raw,treatment_by,compost,vermi,bio,fuel,energy)values('$swr_id','$waste_treatment','$waste_process','$waste_process_qty','$transport','$process','$co_process_raw','$treatment_by','$compost','$vermi','$bio','$fuel','$energy')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set waste_treatment='$waste_treatment',waste_process='$waste_process',waste_process_qty='$waste_process_qty',transport='$transport',process='$process',co_process_raw='$co_process_raw',treatment_by='$treatment_by',compost='$compost',vermi='$vermi',bio='$bio',fuel='$fuel',energy='$energy' where form_id=$form_id");		
	}	
	if($query){			
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=6';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}	
}
if(isset($_POST["save80f"])){
	$others_s_details=clean($_POST["others_s_details"]);$others_t_details=clean($_POST["others_t_details"]);$action_plan=clean($_POST["action_plan"]);$slums=clean($_POST["slums"]);$manpower=clean($_POST["manpower"]);$difficulties=clean($_POST["difficulties"]);$innovative=clean($_POST["innovative"]);
	
	if(!empty($_POST["combustible"]))	 $combustible=json_encode($_POST["combustible"]);
	else	$combustible=NULL;
	if(!empty($_POST["others"]))	  $others=json_encode($_POST["others"]);
	else	$others=NULL;
	if(!empty($_POST["provisions"]))	 $provisions=json_encode($_POST["provisions"]);
	else	$provisions=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();	
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,combustible,others_s_details,others_t_details,action_plan,slums,manpower,difficulties,innovative,others,provisions) values ('$swr_id','$combustible','$others_s_details','$others_t_details','$action_plan','$slums','$manpower','$difficulties','$innovative','$others','$provisions',)");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set combustible='$combustible',others_s_details='$others_s_details',others_t_details='$others_t_details',action_plan='$action_plan',slums='$slums',manpower='$manpower',difficulties='$difficulties',innovative='$innovative',others='$others',provisions='$provisions' where form_id=$form_id");			
	}
	if($query){		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=6';
		</script>";
	}	
}

if(isset($_POST["save81a"])){
	$owner_name=clean($_POST["owner_name"]);	
	if(!empty($_POST["applicant"]))	 $applicant=json_encode($_POST["applicant"]);
	else	$applicant=NULL;
	if(!empty($_POST["details"]))	$details=json_encode($_POST["details"]);
	else	$details=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,applicant,details)values('$swr_id','$today','$owner_name','$applicant','$details')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_name='$owner_name',applicant='$applicant',details='$details' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}
if(isset($_POST["save81b"])){
	$input_size1=clean($_POST["hiddenval"]);
	$indus_add=clean($_POST["indus_add"]);$no_of_employee=clean($_POST["no_of_employee"]);$licence=clean($_POST["licence"]);$auth_name=clean($_POST["auth_name"]);$capacity=clean($_POST["capacity"]);$is_treat=clean($_POST["is_treat"]);
	
	if(!empty($_POST["comm"]))	$comm=json_encode($_POST["comm"]);
	else	$comm=NULL;	
	if(!empty($_POST["daily"]))	 $daily=json_encode($_POST["daily"]);
	else	$daily=NULL;
	if(!empty($_POST["effluent"]))	$effluent=json_encode($_POST["effluent"]);
	else	$effluent=NULL;
	if(!empty($_POST["solid"]))	$solid=json_encode($_POST["solid"]);
	else	$solid=NULL;
	if(!empty($_POST["draft"]))	$draft=json_encode($_POST["draft"]);
	else	$draft=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,indus_add,no_of_employee,licence,auth_name,capacity,is_treat,comm,daily,effluent,solid,draft)values('$swr_id','$indus_add','$no_of_employee','$licence','$auth_name','$capacity','$is_treat','$comm','$daily','$effluent','$solid','$draft')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set indus_add='$indus_add',no_of_employee='$no_of_employee',licence='$licence',auth_name='$auth_name',capacity='$capacity',is_treat='$is_treat',comm='$comm',daily='$daily',effluent='$effluent',solid='$solid',draft='$draft' where form_id=$form_id");		
	}				
	if($query){		
		if($input_size1!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,address,phone,tenure,office) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");				
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

if(isset($_POST["save82"])){
	$input_size1=clean($_POST["hiddenval"]);
	$scheme_details=clean($_POST["scheme_details"]);$scheme_list=clean($_POST["scheme_list"]);$budget=clean($_POST["budget"]);$programme=clean($_POST["programme"]);$is_comply=clean($_POST["is_comply"]);
	if(!empty($_POST["producer"]))	 $producer=json_encode($_POST["producer"]);
	else	$producer=NULL;
	if(!empty($_POST["auth"]))	$auth=json_encode($_POST["auth"]);
	else	$auth=NULL;
	if(!empty($_POST["organization"]))	$organization=json_encode($_POST["organization"]);
	else	$organization=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,scheme_details,scheme_list,budget,programme,is_comply,producer,auth,organization) values ('$swr_id','$today','$scheme_details','$scheme_list','$budget','$programme', '$is_comply','$producer','$auth','$organization')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',scheme_details='$scheme_details',scheme_list='$scheme_list',budget='$budget',programme='$programme',is_comply='$is_comply',producer='$producer',auth='$auth',organization='$organization' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,item,num1,weight1,num2,weight2) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");				
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

?>