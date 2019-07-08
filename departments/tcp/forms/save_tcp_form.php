<?php
if(isset($_POST["save1a"])){		
	$app_cat=clean($_POST["app_cat"]);$fm_name=clean($_POST["fm_name"]);$spouse_nm=clean($_POST["spouse_nm"]);			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,app_cat,fm_name,spouse_nm) values ('$swr_id','$today','$app_cat','$fm_name','$spouse_nm')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', app_cat='$app_cat',fm_name='$fm_name', spouse_nm='$spouse_nm' where form_id=$form_id");	
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
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save1b"])){
	$own_name=clean($_POST["own_name"]);$j_own_name=clean($_POST["j_own_name"]);$vill_revenue=clean($_POST["vill_revenue"]);$locality=clean($_POST["locality"]);$land_use=clean($_POST["land_use"]);$road_name=clean($_POST["road_name"]);$road_width=clean($_POST["road_width"]);	
	if(!empty($_POST["prop"]))	 $prop=json_encode($_POST["prop"]);
		else	$prop=NULL;
	if(!empty($_POST["adjoin"]))	 $adjoin=json_encode($_POST["adjoin"]);
		else	$adjoin=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////If first part is filled up////////////// 
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (sub_date,own_name,j_own_name,prop,vill_revenue,locality,land_use,road_name,road_width,adjoin) values('$today','$own_name','$j_own_name','$prop','$vill_revenue','$locality','$land_use','$road_name','$road_width','$adjoin')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',own_name='$own_name',j_own_name='$j_own_name',prop='$prop',vill_revenue='$vill_revenue',locality='$locality',land_use='$land_use',road_name='$road_name',road_width='$road_width',adjoin='$adjoin' WHERE user_id='$swr_id' AND form_id='$form_id'");
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
if(isset($_POST["save1c"])){
	$build_cat=clean($_POST["build_cat"]);$prop_use=clean($_POST["prop_use"]);$plot_area=clean($_POST["plot_area"]);$build_area=clean($_POST["build_area"]);$con_type=clean($_POST["con_type"]);$no_of_floor=clean($_POST["no_of_floor"]);$total_area=clean($_POST["total_area"]);$b_wall=clean($_POST["b_wall"]);$length=clean($_POST["length"]);$height=clean($_POST["height"]);$is_v_ext=clean($_POST["is_v_ext"]);$is_h_ext=clean($_POST["is_h_ext"]);$reg_no=clean($_POST["reg_no"]);$rtp_name=clean($_POST["rtp_name"]);$tp_mobile_no=clean($_POST["tp_mobile_no"]);$tp_email=clean($_POST["tp_email"]);
	$building_height=clean($_POST["building_height"]);$premise_use=clean($_POST["premise_use"]);
	$abutting_road_width=clean($_POST["abutting_road_width"]);$material_storage=clean($_POST["material_storage"]);
	($is_v_ext=="Y")?$v_no_floor=clean($_POST["v_no_floor"]):$v_no_floor="";
	($is_h_ext=="Y")?$h_no_floor=clean($_POST["h_no_floor"]):$h_no_floor="";

	if(!empty($_POST["margin"]))	 $margin=json_encode($_POST["margin"]);
		else	$margin=NULL;
	if(!empty($_POST["canti"]))	 $canti=json_encode($_POST["canti"]);
		else	$canti=NULL;
	if(!empty($_POST["park_no"]))	 $park_no=json_encode($_POST["park_no"]);
		else	$park_no=NULL;
	if(!empty($_POST["park_area"]))	 $park_area=json_encode($_POST["park_area"]);
		else	$park_area=NULL;
	if(!empty($_POST["area"]))	 $area=json_encode($_POST["area"]);
		else	$area=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////If first part is filled up////////////// 
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (sub_date,build_cat,prop_use,plot_area,build_area,con_type,no_of_floor,total_area,b_wall,length,height,is_v_ext,v_no_floor,is_h_ext,h_no_floor,reg_no,rtp_name,tp_mobile_no,tp_email,margin,canti,park_no,park_area,area,building_height,premise_use,abutting_road_width,material_storage) values('$today','$build_cat','$prop_use','$plot_area','$build_area','$con_type','$no_of_floor','$total_area','$b_wall','$length','$height','$is_v_ext','$v_no_floor','$is_h_ext','$h_no_floor','$reg_no','$rtp_name','$tp_mobile_no','$tp_email','$margin','$canti','$park_no','$park_area','$area','$building_height','$premise_use','$abutting_road_width','$material_storage')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',build_cat='$build_cat',prop_use='$prop_use',plot_area='$plot_area',build_area='$build_area',con_type='$con_type',no_of_floor='$no_of_floor',total_area='$total_area',b_wall='$b_wall',length='$length',height='$height',is_v_ext='$is_v_ext',v_no_floor='$v_no_floor',is_h_ext='$is_h_ext',h_no_floor='$h_no_floor',reg_no='$reg_no',rtp_name='$rtp_name',tp_mobile_no='$tp_mobile_no',tp_email='$tp_email',margin='$margin',canti='$canti',park_no='$park_no',park_area='$park_area',area='$area',building_height='$building_height',premise_use='$premise_use',abutting_road_width='$abutting_road_width',material_storage='$material_storage' WHERE user_id='$swr_id' AND form_id='$form_id'");
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save2"])){	
	$ref_uain=clean($_POST["ref_uain"]);$ownername=clean($_POST["ownername"]);$location=clean($_POST["location"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$development_name=clean($_POST["development_name"]);$development_address=clean($_POST["development_address"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and ref_uain='$ref_uain'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_uain,ownername,location,submit_dt,receive_dt,engineer,engineer_address,development_name,development_address) values ('$swr_id','$today','$ref_uain','$ownername','$location','$submit_dt','$receive_dt','$engineer','$engineer_address','$development_name','$development_address')");
	 $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', ref_uain='$ref_uain',ownername='$ownername',location='$location',submit_dt='$submit_dt',receive_dt='$receive_dt',engineer='$engineer',engineer_address='$engineer_address',development_name='$development_name',development_address='$development_address' where form_id=$form_id");	
	}					
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save3"])){		
	$ref_uain=clean($_POST["ref_uain"]);$ownername=clean($_POST["ownername"]);$location=clean($_POST["location"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$development_name=clean($_POST["development_name"]);$development_address=clean($_POST["development_address"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and ref_uain='$ref_uain'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_uain,ownername,location,submit_dt,receive_dt,engineer,engineer_address,development_name,development_address) values ('$swr_id','$today','$ref_uain','$ownername','$location','$submit_dt','$receive_dt','$engineer','$engineer_address','$development_name','$development_address')");
	   $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', ref_uain='$ref_uain',ownername='$ownername',location='$location',submit_dt='$submit_dt',receive_dt='$receive_dt',engineer='$engineer',engineer_address='$engineer_address',development_name='$development_name',development_address='$development_address' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save4"])){		
	$drawings=clean($_POST["drawings"]);
	$ref_uain=clean($_POST["ref_uain"]);$ownername=clean($_POST["ownername"]);$location=clean($_POST["location"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$development_name=clean($_POST["development_name"]);$development_address=clean($_POST["development_address"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and ref_uain='$ref_uain'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_uain,ownername,location,submit_dt,receive_dt,engineer,engineer_address,development_name,development_address,drawings) values ('$swr_id','$today','$ref_uain','$ownername','$location','$submit_dt','$receive_dt','$engineer','$engineer_address','$development_name','$development_address','$drawings')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', ref_uain='$ref_uain',ownername='$ownername',location='$location',submit_dt='$submit_dt',receive_dt='$receive_dt',engineer='$engineer',engineer_address='$engineer_address',development_name='$development_name',development_address='$development_address',drawings='$drawings' where form_id=$form_id");	
	}			
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save5"])){		
	$drawings=clean($_POST["drawings"]);
	$ref_uain=clean($_POST["ref_uain"]);$ownername=clean($_POST["ownername"]);$location=clean($_POST["location"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$development_name=clean($_POST["development_name"]);$development_address=clean($_POST["development_address"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and ref_uain='$ref_uain'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_uain,ownername,location,submit_dt,receive_dt,engineer,engineer_address,development_name,development_address,drawings) values ('$swr_id','$today','$ref_uain','$ownername','$location','$submit_dt','$receive_dt','$engineer','$engineer_address','$development_name','$development_address','$drawings')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', ref_uain='$ref_uain',ownername='$ownername',location='$location',submit_dt='$submit_dt',receive_dt='$receive_dt',engineer='$engineer',engineer_address='$engineer_address',development_name='$development_name',development_address='$development_address',drawings='$drawings' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save6"])){		
	$drawings=clean($_POST["drawings"]);
	$ref_uain=clean($_POST["ref_uain"]);$ownername=clean($_POST["ownername"]);$location=clean($_POST["location"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$development_name=clean($_POST["development_name"]);$development_address=clean($_POST["development_address"]);$p_plot_no=clean($_POST["p_plot_no"]);$p_block_no=clean($_POST["p_block_no"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and ref_uain='$ref_uain'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	   $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_uain,ownername,location,submit_dt,receive_dt,engineer,engineer_address,development_name,development_address,drawings,p_plot_no,p_block_no) values ('$swr_id','$today','$ref_uain','$ownername','$location','$submit_dt','$receive_dt','$engineer','$engineer_address','$development_name','$development_address','$drawings','$p_plot_no','$p_block_no')");
	   $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', ref_uain='$ref_uain',ownername='$ownername',location='$location',submit_dt='$submit_dt',receive_dt='$receive_dt',engineer='$engineer',engineer_address='$engineer_address',development_name='$development_name',development_address='$development_address',drawings='$drawings',p_plot_no='$p_plot_no',p_block_no='$p_block_no' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save7"])){		
	$address=clean($_POST["address"]);$conforms_to=clean($_POST["conforms_to"]);$inst_address=clean($_POST["inst_address"]);$zone=clean($_POST["zone"]);	

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,address,conforms_to,inst_address,zone) values ('$swr_id','$today','$address','$conforms_to','$inst_address','$zone')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', address='$address',conforms_to='$conforms_to', inst_address='$inst_address', zone='$zone' where form_id=$form_id");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save8"])){		
	$supervision=clean($_POST["supervision"]);$name=clean($_POST["name"]);$edu_quali=clean($_POST["edu_quali"]);$past_exp=clean($_POST["past_exp"]);$father_name=clean($_POST["father_name"]);$pan=clean($_POST["pan"]);$dob=clean($_POST["dob"]);$owner_age=clean($_POST["owner_age"]);
	if(!empty($_POST["authority_addres"]))	 $authority_addres=json_encode($_POST["authority_addres"]);
	else	$authority_addres=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["fees"]))	 $fees=json_encode($_POST["fees"]);
	else	$fees=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,authority_addres,supervision,name,edu_quali,past_exp,father_name,pan,dob,owner_age,pre_add,fees) values ('$swr_id','$today','$authority_addres','$supervision','$name','$edu_quali','$past_exp','$father_name','$pan','$dob','$owner_age','$pre_add','$fees')");
	  $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', authority_addres='$authority_addres',supervision='$supervision', name='$name', edu_quali='$edu_quali', past_exp='$past_exp', father_name='$father_name', pan='$pan', dob='$dob', owner_age='$owner_age', pre_add='$pre_add', fees='$fees' where form_id=$form_id");	
	}					
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save9"])){		
	$supervision=clean($_POST["supervision"]);$agency=clean($_POST["agency"]);$pan=clean($_POST["pan"]);
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["authority_addres"]))	 $authority_addres=json_encode($_POST["authority_addres"]);
	else	$authority_addres=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,authority_addres,supervision,agency,pan,pre_add) values ('$swr_id','$today','$authority_addres','$supervision','$agency','$pan','$pre_add')");
	  $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', authority_addres='$authority_addres',supervision='$supervision', agency='$agency', pan='$pan',  pre_add='$pre_add' where form_id=$form_id");	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,personal_cap,rank) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}
?>