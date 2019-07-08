<?php
//FORM 21 to FORM 33
if(isset($_POST["save28"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save74"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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


if(isset($_POST["save29"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save75"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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


if(isset($_POST["save30"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save76"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save31"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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
if(isset($_POST["save77"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save32"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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
if(isset($_POST["save78"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save33"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save79"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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


if(isset($_POST["save34"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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
if(isset($_POST["save80"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save35"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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
if(isset($_POST["save81"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save36"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save82"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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


if(isset($_POST["save41"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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

if(isset($_POST["save87"])){
	
	$applicant_age=clean($_POST["applicant_age"]);$edu_quali=clean($_POST["edu_quali"]);$proposed_site_name=clean($_POST["proposed_site_name"]);$prev_license_no1=clean($_POST["prev_license_no1"]);$prev_license_no2=clean($_POST["prev_license_no2"]);$is_liabilities=clean($_POST["is_liabilities"]);$is_license=clean($_POST["is_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		if(!empty($_POST["site_loc"]))	 $site_loc=json_encode($_POST["site_loc"]);
		else	$site_loc=NULL;
		if(!empty($_POST["caste_o"]))	 $caste_o=json_encode($_POST["caste_o"]);
		else	$caste_o=NULL;
		if(!empty($_POST["site_distance"]))	 $site_distance=json_encode($_POST["site_distance"]);
		else	$site_distance=NULL;
		
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_age,edu_quali,present_address,site_loc,proposed_site_name,prev_license_no1,prev_license_no2,is_liabilities,site_distance,caste_o,is_license) values ('$swr_id','$today','$applicant_age','$edu_quali','$present_address','$site_loc','$proposed_site_name','$prev_license_no1','$prev_license_no2','$is_liabilities','$site_distance','$caste_o','$is_license')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_age='$applicant_age',edu_quali='$edu_quali',present_address='$present_address',site_loc='$site_loc',proposed_site_name='$proposed_site_name',prev_license_no1='$prev_license_no1',prev_license_no2='$prev_license_no2',is_liabilities='$is_liabilities' ,site_distance='$site_distance',caste_o='$caste_o',is_license='$is_license' where form_id=$form_id");		
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



if(isset($_POST["save42"])){		
	  $name_father=clean($_POST["name_father"]);$applicant_age=clean($_POST["applicant_age"]);$sex_applicant=clean($_POST["sex_applicant"]);$details_of_site=clean($_POST["details_of_site"]);$trade_license_no=clean($_POST["trade_license_no"]);$sales_tax_reg_no=clean($_POST["sales_tax_reg_no"]);$details_of_license=clean($_POST["details_of_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,name_father,applicant_age,sex_applicant,details_of_site,trade_license_no,sales_tax_reg_no,details_of_license,present_address) values ('$swr_id','$today','$name_father','$applicant_age','$sex_applicant','$details_of_site','$trade_license_no','$sales_tax_reg_no','$details_of_license','$present_address')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',name_father='$name_father',applicant_age='$applicant_age',sex_applicant='$sex_applicant',details_of_site='$details_of_site',trade_license_no='$trade_license_no',sales_tax_reg_no='$sales_tax_reg_no',details_of_license='$details_of_license',present_address='$present_address' where form_id=$form_id");		
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
if(isset($_POST["save88"])){		
	  $name_father=clean($_POST["name_father"]);$applicant_age=clean($_POST["applicant_age"]);$sex_applicant=clean($_POST["sex_applicant"]);$details_of_site=clean($_POST["details_of_site"]);$trade_license_no=clean($_POST["trade_license_no"]);$sales_tax_reg_no=clean($_POST["sales_tax_reg_no"]);$details_of_license=clean($_POST["details_of_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,name_father,applicant_age,sex_applicant,details_of_site,trade_license_no,sales_tax_reg_no,details_of_license,present_address) values ('$swr_id','$today','$name_father','$applicant_age','$sex_applicant','$details_of_site','$trade_license_no','$sales_tax_reg_no','$details_of_license','$present_address')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',name_father='$name_father',applicant_age='$applicant_age',sex_applicant='$sex_applicant',details_of_site='$details_of_site',trade_license_no='$trade_license_no',sales_tax_reg_no='$sales_tax_reg_no',details_of_license='$details_of_license',present_address='$present_address' where form_id=$form_id");		
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


if(isset($_POST["save43"])){		
	  $name_father=clean($_POST["name_father"]);$applicant_age=clean($_POST["applicant_age"]);$sex_applicant=clean($_POST["sex_applicant"]);$details_of_site=clean($_POST["details_of_site"]);$trade_license_no=clean($_POST["trade_license_no"]);$sales_tax_reg_no=clean($_POST["sales_tax_reg_no"]);$details_of_license=clean($_POST["details_of_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,name_father,applicant_age,sex_applicant,details_of_site,trade_license_no,sales_tax_reg_no,details_of_license,present_address) values ('$swr_id','$today','$name_father','$applicant_age','$sex_applicant','$details_of_site','$trade_license_no','$sales_tax_reg_no','$details_of_license','$present_address')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',name_father='$name_father',applicant_age='$applicant_age',sex_applicant='$sex_applicant',details_of_site='$details_of_site',trade_license_no='$trade_license_no',sales_tax_reg_no='$sales_tax_reg_no',details_of_license='$details_of_license',present_address='$present_address' where form_id=$form_id");		
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

if(isset($_POST["save89"])){		
	  $name_father=clean($_POST["name_father"]);$applicant_age=clean($_POST["applicant_age"]);$sex_applicant=clean($_POST["sex_applicant"]);$details_of_site=clean($_POST["details_of_site"]);$trade_license_no=clean($_POST["trade_license_no"]);$sales_tax_reg_no=clean($_POST["sales_tax_reg_no"]);$details_of_license=clean($_POST["details_of_license"]);
		
		if(!empty($_POST["present_address"]))	 $present_address=json_encode($_POST["present_address"]);
		else	$present_address=NULL;
		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,name_father,applicant_age,sex_applicant,details_of_site,trade_license_no,sales_tax_reg_no,details_of_license,present_address) values ('$swr_id','$today','$name_father','$applicant_age','$sex_applicant','$details_of_site','$trade_license_no','$sales_tax_reg_no','$details_of_license','$present_address')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',name_father='$name_father',applicant_age='$applicant_age',sex_applicant='$sex_applicant',details_of_site='$details_of_site',trade_license_no='$trade_license_no',sales_tax_reg_no='$sales_tax_reg_no',details_of_license='$details_of_license',present_address='$present_address' where form_id=$form_id");		
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


if(isset($_POST["save93"])){
	
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
if(isset($_POST["save95"])){
	
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



?>