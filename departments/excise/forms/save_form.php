<?php
if(isset($_POST["save1"])){
	$owner_age=clean($_POST["owner_age"]);$plant_proposed=clean($_POST["plant_proposed"]);$building_proposed=clean($_POST["building_proposed"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["site_high"]))	 $site_high=json_encode($_POST["site_high"]);
	else	$site_high=NULL;
	
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,state,edu_quali,site_loc,plant_proposed,building_proposed,site_distance,site_high) values ('$swr_id','$today','$owner_age','$state','$edu_quali','$site_loc','$plant_proposed','$building_proposed','$site_distance','$site_high')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',state='$state',edu_quali='$edu_quali',site_loc='$site_loc',plant_proposed='$plant_proposed',building_proposed='$building_proposed',site_distance='$site_distance',site_high='$site_high' where form_id=$form_id");		
	}				
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save2"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save90"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save3"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save91"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save4"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save92"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save8"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["capacity_p"]))	 $capacity_p=json_encode($_POST["capacity_p"]);
		else	$capacity_p=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,capacity_p,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$capacity_p','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',capacity_p='$capacity_p',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save54"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["capacity_p"]))	 $capacity_p=json_encode($_POST["capacity_p"]);
		else	$capacity_p=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,capacity_p,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$capacity_p','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',capacity_p='$capacity_p',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save9"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["capacity_p"]))	 $capacity_p=json_encode($_POST["capacity_p"]);
		else	$capacity_p=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,capacity_p,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$capacity_p','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',capacity_p='$capacity_p',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save55"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["capacity_p"]))	 $capacity_p=json_encode($_POST["capacity_p"]);
		else	$capacity_p=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,capacity_p,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$capacity_p','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',capacity_p='$capacity_p',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save10"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["capacity_p"]))	 $capacity_p=json_encode($_POST["capacity_p"]);
		else	$capacity_p=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,capacity_p,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$capacity_p','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',capacity_p='$capacity_p',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save56"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["capacity_p"]))	 $capacity_p=json_encode($_POST["capacity_p"]);
		else	$capacity_p=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,capacity_p,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$capacity_p','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',capacity_p='$capacity_p',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save11"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["bond_limit"]))	 $bond_limit=json_encode($_POST["bond_limit"]);
		else	$bond_limit=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,bond_limit,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$bond_limit','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',bond_limit='$bond_limit',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save57"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["bond_limit"]))	 $bond_limit=json_encode($_POST["bond_limit"]);
		else	$bond_limit=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,bond_limit,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$bond_limit','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',bond_limit='$bond_limit',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save12"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save58"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save13"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save59"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save14"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save60"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
}


if(isset($_POST["save15"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save62"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save16"])){
	
   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);
  
   $sex_applicant=clean($_POST["sex_applicant"]); $edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);
   
   $plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
}
if(isset($_POST["save61"])){
	
   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);
  
   $sex_applicant=clean($_POST["sex_applicant"]); $edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);
   
   $plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save17"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
}
if(isset($_POST["save63"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
}



if(isset($_POST["save18"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
}
if(isset($_POST["save64"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}


if(isset($_POST["save19"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save65"])){

	   $owner_age=clean($_POST["owner_age"]);$name_father=clean($_POST["name_father"]);$sex_applicant=clean($_POST["sex_applicant"]);$edu_quali=clean($_POST["edu_quali"]);$state=clean($_POST["state"]);$pre_past_occupation=clean($_POST["pre_past_occupation"]);$is_citizen=clean($_POST["is_citizen"]);$is_criminal=clean($_POST["is_criminal"]);$proposed_plant=clean($_POST["proposed_plant"]);$plant_site=clean($_POST["plant_site"]);$apparatus_description=clean($_POST["apparatus_description"]);$ten_date=clean($_POST["ten_date"]);$esti_quantity=clean($_POST["esti_quantity"]);$is_pollution=clean($_POST["is_pollution"]);$is_servant=clean($_POST["is_servant"]);
		
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,name_father,sex_applicant,edu_quali,state,pre_past_occupation,is_citizen,is_criminal,proposed_plant,site_loc,plant_site,apparatus_description,ten_date,esti_quantity,is_pollution,site_distance,is_servant) values ('$swr_id','$today','$owner_age','$name_father','$sex_applicant','$edu_quali','$state','$pre_past_occupation','$is_citizen','$is_criminal','$proposed_plant','$site_loc','$plant_site','$apparatus_description','$ten_date','$esti_quantity','$is_pollution','$site_distance','$is_servant')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_age='$owner_age',name_father='$name_father',sex_applicant='$sex_applicant',edu_quali='$edu_quali',state='$state',pre_past_occupation='$pre_past_occupation',is_citizen='$is_citizen',is_criminal='$is_criminal',proposed_plant='$proposed_plant',site_loc='$site_loc',plant_site='$plant_site',apparatus_description='$apparatus_description',ten_date='$ten_date',esti_quantity='$esti_quantity',is_pollution='$is_pollution',site_distance='$site_distance',is_servant='$is_servant' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save22"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$event_license=clean($_POST["event_license"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,event_license,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$event_license','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', event_license='$event_license',pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save68"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$event_license=clean($_POST["event_license"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,event_license,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$event_license','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', event_license='$event_license',pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save23"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$event_license=clean($_POST["event_license"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,event_license,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$event_license','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', event_license='$event_license',pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save69"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$event_license=clean($_POST["event_license"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,event_license,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$event_license','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', event_license='$event_license',pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save24"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$event_license=clean($_POST["event_license"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,event_license,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$event_license','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', event_license='$event_license',pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save70"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$event_license=clean($_POST["event_license"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,event_license,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$event_license','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', event_license='$event_license',pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save25"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$event_license=clean($_POST["event_license"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,event_license,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$event_license','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', event_license='$event_license',pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save71"])){
	
	$owner_age=clean($_POST["owner_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site=clean($_POST["proposed_site"]);$event_license=clean($_POST["event_license"]);$pre_license_no=clean($_POST["pre_license_no"]);$previ_licno_validity=clean($_POST["previ_licno_validity"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
	
	if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
	else	$site_loc=NULL;
	if(!empty($_POST["area_type"]))	 $area_type=json_encode($_POST["area_type"]);
	else	$area_type=NULL;
	if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
	else	$site_distance=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
	else	$caste_o=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_age,edu_quali,pre_add,site_loc,area_type,proposed_site,event_license,pre_license_no,previ_licno_validity,is_liabilities,is_license,site_distance,caste_o) values ('$swr_id','$today','$owner_age','$edu_quali','$pre_add', '$site_loc','$area_type','$proposed_site','$event_license','$pre_license_no','$previ_licno_validity', '$is_liabilities','$is_license','$site_distance','$caste_o')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_age='$owner_age',edu_quali='$edu_quali',pre_add='$pre_add',site_loc='$site_loc',area_type='$area_type',proposed_site='$proposed_site', event_license='$event_license',pre_license_no='$pre_license_no',previ_licno_validity='$previ_licno_validity',is_liabilities='$is_liabilities',is_license='$is_license',site_distance='$site_distance',caste_o='$caste_o' where form_id=$form_id");		
	}		
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
?>