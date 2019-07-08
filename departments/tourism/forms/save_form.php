<?php
if(isset($_POST["save1a"])){
	$applicant_refuse_radio=clean($_POST["applicant_refuse_radio"]);$film_public_radio=clean($_POST["film_public_radio"]);$any_visit_radio=clean($_POST["any_visit_radio"]);$film_title=clean($_POST["film_title"]);$film_type=$_POST["film_type"];$feature_film=clean($_POST["feature_film"]);$any_feature=clean($_POST["any_feature"]);$duration=clean($_POST["duration"]);$dt_of_comm=clean($_POST["dt_of_comm"]);$general_info=clean($_POST["general_info"]);
	
	if($applicant_refuse_radio=="Y") $applicant_refuse=clean($_POST["applicant_refuse"]);
			else $applicant_refuse="";
	if($film_public_radio=="Y") $film_public=clean($_POST["film_public"]);
			else $film_public="";
	if($any_visit_radio=="Y") $any_visit=clean($_POST["any_visit"]);
			else $any_visit="";
	
	if(!empty($_POST["film_details"])) $film_details=json_encode($_POST["film_details"]);
	else $film_details=NULL;
	
	if(!empty($_POST["rep_details"])) $rep_details=json_encode($_POST["rep_details"]);
	else $rep_details=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,film_title,film_type,film_details,rep_details,feature_film,any_feature,applicant_refuse_radio,applicant_refuse,film_public_radio,film_public,any_visit_radio,any_visit,duration,dt_of_comm,general_info) values ('$swr_id','$today', '$film_title', '$film_type', '$film_details','$rep_details','$feature_film','$any_feature','$applicant_refuse_radio','$applicant_refuse','$film_public_radio','$film_public','$any_visit_radio','$any_visit','$duration','$dt_of_comm','$general_info')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', film_title='$film_title', film_type='$film_type', film_details='$film_details',rep_details='$rep_details',feature_film='$feature_film',any_feature='$any_feature',applicant_refuse_radio='$applicant_refuse_radio',applicant_refuse='$applicant_refuse',film_public_radio='$film_public_radio',film_public='$film_public',any_visit='$any_visit',any_visit_radio='$any_visit_radio',duration='$duration',dt_of_comm='$dt_of_comm',general_info='$general_info' where user_id='$swr_id' and form_id=$form_id");			
	}
	if($query) {
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}		
}
if(isset($_POST["save1b"])){
	$input_size=$_POST["hiddenval"];$cameraman_name=clean($_POST["cameraman_name"]);$editor_name=clean($_POST["editor_name"]);$recordist_name=clean($_POST["recordist_name"]);$film_info=clean($_POST["film_info"]);$wish_to_hire=($_POST["wish_to_hire"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,wish_to_hire,cameraman_name,editor_name,recordist_name,film_info) values ('$swr_id','$today', '$wish_to_hire', '$cameraman_name','$editor_name','$recordist_name','$film_info')"); 
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', wish_to_hire='$wish_to_hire', cameraman_name='$cameraman_name',editor_name='$editor_name',recordist_name='$recordist_name',film_info='$film_info' where user_id='$swr_id' and form_id=$form_id");			
	}
	if($query) {
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,name,hire_from,hire_to,location,call_time) VALUES ('','$form_id','$vala','$valb','$valc','$vald','$vale')");
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
if(isset($_POST["save1c"])){
	$forest_area=clean($_POST["forest_area"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){  ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,forest_area) values ('$swr_id','$today', '$forest_area')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', forest_area='$forest_area' where user_id='$swr_id' and form_id=$form_id");			
	}
	if($query){
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
if(isset($_POST["save1d"])){
	$temp_film=clean($_POST["temp_film"]);$total_area=clean($_POST["total_area"]);$nature=clean($_POST["nature"]);$electric_dist=clean($_POST["electric_dist"]);$height_of_ceiling=clean($_POST["height_of_ceiling"]);$fire_details=clean($_POST["fire_details"]);$water_detail=clean($_POST["water_detail"]);$fire_info=clean($_POST["fire_info"]);
	
	if(!empty($_POST["access_premise"])) $access_premise=json_encode($_POST["access_premise"]);
	else $access_premise=NULL;
	if(!empty($_POST["sur_property"])) $sur_property=json_encode($_POST["sur_property"]);
	else $sur_property=NULL;
	if(!empty($_POST["open_space"])) $open_space=json_encode($_POST["open_space"]); 
	else $open_space=NULL;
	if(!empty($_POST["arrangement_details"])) $arrangement_details=json_encode($_POST["arrangement_details"]); 
	else $arrangement_details=NULL;
	if(!empty($_POST["fire_st"])) $fire_st=json_encode($_POST["fire_st"]); 
	else $fire_st=NULL;
	if(!empty($_POST["personnel_detail"])) $personnel_detail=json_encode($_POST["personnel_detail"]); 
	else $fire_st=NULL;
	if(!empty($_POST["electrician_detail"])) $electrician_detail=json_encode($_POST["electrician_detail"]); 
	else $electrician_detail=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,temp_film,total_area,nature,access_premise,sur_property,open_space,arrangement_details,electric_dist,height_of_ceiling,fire_st,fire_details,water_detail,personnel_detail,electrician_detail,fire_info) values ('$swr_id','$today', '$temp_film', '$total_area', '$nature','$access_premise','$sur_property','$open_space','$arrangement_details','$electric_dist','$height_of_ceiling','$fire_st','$fire_details','$water_detail','$personnel_detail','$electrician_detail','$fire_info')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', temp_film='$temp_film', total_area='$total_area', nature='$nature',access_premise='$access_premise',sur_property='$sur_property',open_space='$open_space',arrangement_details='$arrangement_details',electric_dist='$electric_dist',height_of_ceiling='$height_of_ceiling',fire_st='$fire_st',fire_details='$fire_details',water_detail='$water_detail',personnel_detail='$personnel_detail',electrician_detail='$electrician_detail',fire_info='$fire_info' where user_id='$swr_id' and form_id=$form_id");			
	}
	if($query) {
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
if(isset($_POST["save1e"])){
	$film_arch=clean($_POST["film_arch"]);$monument_name=clean($_POST["monument_name"]);$monument_part=clean($_POST["monument_part"]);$arch_info=clean($_POST["arch_info"]);	
	if(!empty($_POST["arch_address"])) $arch_address=json_encode($_POST["arch_address"]);
	else $arch_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,film_arch,monument_name,arch_address,monument_part,arch_info) values ('$swr_id','$today', '$film_arch', '$monument_name', '$arch_address','$monument_part','$arch_info')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', film_arch='$film_arch', monument_name='$monument_name', arch_address='$arch_address',monument_part='$monument_part',arch_info='$arch_info' where user_id='$swr_id' and form_id=$form_id");			
	}
	if($query) {
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

if(isset($_POST["submit1"])){
	echo "<script>
		alert('Successfully Saved..');
		window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
	</script>";		
}
?>