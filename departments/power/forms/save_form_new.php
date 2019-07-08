<?php 
if(isset($_POST['save2a'])){
	
		$str_name1=clean($_POST['str_name1']);$str_name2=clean($_POST['str_name2']);$b_str_name1=clean($_POST['b_str_name1']);$b_str_name2=clean($_POST['b_str_name2']);$applicant_name=clean($_POST['applicant_name']);$organization_name=clean($_POST['organization_name']);$contact_no=clean($_POST['contact_no']);$appli_email=clean($_POST['appli_email']);$appli_postofice=clean($_POST['appli_postofice']);$premises_postofc=clean($_POST['premises_postofc']);$situated_area=clean($_POST['situated_area']);$constructed_land=clean($_POST['constructed_land']);$height_tower=clean($_POST['height_tower']);$is_dedicated=clean($_POST['is_dedicated']);$is_owner=clean($_POST['is_owner']);$is_co_owner=clean($_POST['is_co_owner']);$is_lease=clean($_POST['is_lease']);$is_legal=clean($_POST['is_legal']);$is_electricity=clean($_POST['is_electricity']);$input_size=$_POST["hiddenval"];
		
		if(!empty($_POST["dedicated_details"]) && $_POST["is_dedicated"]=="Y")	$dedicated_details=$_POST["dedicated_details"];
	    else $dedicated_details=NULL;
	
	   if(!empty($_POST["details_electricity"]) && $_POST["is_electricity"]=="Y")	$details_electricity=$_POST["details_electricity"];
	   else $details_electricity=NULL;
		
		
	  if(!empty($_POST["permanent_disconnection"]))	$permanent_disconnection=json_encode($_POST["permanent_disconnection"]);
	  else	 $permanent_disconnection=NULL;
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
			
	if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,str_name1,str_name2,b_str_name1,b_str_name2,applicant_name,organization_name,contact_no,appli_email,appli_postofice,premises_postofc,situated_area,constructed_land,height_tower,is_dedicated,dedicated_details,is_owner,is_co_owner,is_lease,is_legal,is_electricity,details_electricity,permanent_disconnection) values ('$swr_id','$today','$str_name1','$str_name2','$b_str_name1','$b_str_name2','$applicant_name','$organization_name', '$contact_no','$appli_email','$appli_postofice','$premises_postofc','$situated_area','$constructed_land','$height_tower','$is_dedicated','$dedicated_details','$is_owner','$is_co_owner','$is_lease','$is_legal','$is_electricity','$details_electricity','$permanent_disconnection')");	
			$form_id=$query;
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',str_name1='$str_name1',str_name2='$str_name2',b_str_name1='$b_str_name1',b_str_name2='$b_str_name2',applicant_name='$applicant_name',organization_name='$organization_name',contact_no='$contact_no',appli_email='$appli_email',appli_postofice='$appli_postofice',premises_postofc='$premises_postofc',situated_area='$situated_area', constructed_land='$constructed_land',height_tower='$height_tower',is_dedicated='$is_dedicated',dedicated_details='$dedicated_details',is_owner='$is_owner',is_co_owner='$is_co_owner',is_lease='$is_lease',is_legal='$is_legal',is_electricity='$is_electricity',details_electricity='$details_electricity',permanent_disconnection='$permanent_disconnection' where form_id='$form_id'");	
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
				$vale=$_POST["txtE".$i];
				
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1 (form_id,slno,consumer_name,consumer_number,category,current_load) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
				}
			}
			
	
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

if(isset($_POST['save2b'])){
	
	$is_connection=clean($_POST['is_connection']);$esd=clean($_POST['esd']);$approx_distance=clean($_POST['approx_distance']);$proposed_distance=clean($_POST['proposed_distance']);$is_road_crossing=clean($_POST['is_road_crossing']);$road_crossing=clean($_POST['road_crossing']);
	
    if(!empty($_POST["details_connection"]) && $_POST["is_connection"]=="Y")	$details_connection=$_POST["details_connection"];
	else $details_connection=NULL;
	
	if(!empty($_POST["details_crossing"]) && $_POST["is_road_crossing"]=="Y")	$details_crossing=$_POST["details_crossing"];
	else $details_crossing=NULL;
	
	if(!empty($_POST["nos_road"]) && $_POST["road_crossing"]=="Y")	$nos_road=$_POST["nos_road"];
	else $nos_road=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
		
	if($sql->num_rows<1){   
			
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
			
	}else{  
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_connection='$is_connection',details_connection='$details_connection',esd='$esd',approx_distance='$approx_distance',proposed_distance='$proposed_distance',road_crossing='$road_crossing',nos_road='$nos_road',is_road_crossing='$is_road_crossing',details_crossing='$details_crossing' where form_id='$form_id'");				
	}	
	if($query){
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}						
}

if(isset($_POST['save3a'])){
	
		$str_name1=clean($_POST['str_name1']);$str_name2=clean($_POST['str_name2']);$b_str_name1=clean($_POST['b_str_name1']);$b_str_name2=clean($_POST['b_str_name2']);$applicant_name=clean($_POST['applicant_name']);$organization_name=clean($_POST['organization_name']);$contact_no=clean($_POST['contact_no']);$appli_email=clean($_POST['appli_email']);$appli_postofice=clean($_POST['appli_postofice']);$premises_postofc=clean($_POST['premises_postofc']);$situated_area=clean($_POST['situated_area']);$constructed_land=clean($_POST['constructed_land']);$height_tower=clean($_POST['height_tower']);$is_dedicated=clean($_POST['is_dedicated']);$is_owner=clean($_POST['is_owner']);$is_co_owner=clean($_POST['is_co_owner']);$is_lease=clean($_POST['is_lease']);$is_legal=clean($_POST['is_legal']);$is_electricity=clean($_POST['is_electricity']);$input_size=$_POST["hiddenval"];
		
		if(!empty($_POST["dedicated_details"]) && $_POST["is_dedicated"]=="Y")	$dedicated_details=$_POST["dedicated_details"];
	    else $dedicated_details=NULL;
	
	   if(!empty($_POST["details_electricity"]) && $_POST["is_electricity"]=="Y")	$details_electricity=$_POST["details_electricity"];
	   else $details_electricity=NULL;
		
		
	  if(!empty($_POST["permanent_disconnection"]))	$permanent_disconnection=json_encode($_POST["permanent_disconnection"]);
	  else	 $permanent_disconnection=NULL;
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
			
	if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,str_name1,str_name2,b_str_name1,b_str_name2,applicant_name,organization_name,contact_no,appli_email,appli_postofice,premises_postofc,situated_area,constructed_land,height_tower,is_dedicated,dedicated_details,is_owner,is_co_owner,is_lease,is_legal,is_electricity,details_electricity,permanent_disconnection) values ('$swr_id','$today','$str_name1','$str_name2','$b_str_name1','$b_str_name2','$applicant_name','$organization_name', '$contact_no','$appli_email','$appli_postofice','$premises_postofc','$situated_area','$constructed_land','$height_tower','$is_dedicated','$dedicated_details','$is_owner','$is_co_owner','$is_lease','$is_legal','$is_electricity','$details_electricity','$permanent_disconnection')");	
			$form_id=$query;
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',str_name1='$str_name1',str_name2='$str_name2',b_str_name1='$b_str_name1',b_str_name2='$b_str_name2',applicant_name='$applicant_name',organization_name='$organization_name',contact_no='$contact_no',appli_email='$appli_email',appli_postofice='$appli_postofice',premises_postofc='$premises_postofc',situated_area='$situated_area', constructed_land='$constructed_land',height_tower='$height_tower',is_dedicated='$is_dedicated',dedicated_details='$dedicated_details',is_owner='$is_owner',is_co_owner='$is_co_owner',is_lease='$is_lease',is_legal='$is_legal',is_electricity='$is_electricity',details_electricity='$details_electricity',permanent_disconnection='$permanent_disconnection' where form_id='$form_id'");	
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
				$vale=$_POST["txtE".$i];
				
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1 (form_id,slno,consumer_name,consumer_number,category,current_load) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
				}
			}
			
	
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

if(isset($_POST['save3b'])){
	
	$is_connection=clean($_POST['is_connection']);$esd=clean($_POST['esd']);$approx_distance=clean($_POST['approx_distance']);$proposed_distance=clean($_POST['proposed_distance']);$is_road_crossing=clean($_POST['is_road_crossing']);$road_crossing=clean($_POST['road_crossing']);
	
    if(!empty($_POST["details_connection"]) && $_POST["is_connection"]=="Y")	$details_connection=$_POST["details_connection"];
	else $details_connection=NULL;
	
	if(!empty($_POST["details_crossing"]) && $_POST["is_road_crossing"]=="Y")	$details_crossing=$_POST["details_crossing"];
	else $details_crossing=NULL;
	
	if(!empty($_POST["nos_road"]) && $_POST["road_crossing"]=="Y")	$nos_road=$_POST["nos_road"];
	else $nos_road=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
		
	if($sql->num_rows<1){   
			
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
			
	}else{  
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_connection='$is_connection',details_connection='$details_connection',esd='$esd',approx_distance='$approx_distance',proposed_distance='$proposed_distance',road_crossing='$road_crossing',nos_road='$nos_road',is_road_crossing='$is_road_crossing',details_crossing='$details_crossing' where form_id='$form_id'");				
	}	
	if($query){
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}						
}


if(isset($_POST["save4"])){
	$applicant_name=clean($_POST["applicant_name"]);$organization_name=clean($_POST["organization_name"]);$voltage_supply=clean($_POST["voltage_supply"]);$total_load=clean($_POST["total_load"]);$category_tariff=clean($_POST["category_tariff"]);
	$is_capacity=clean($_POST["is_capacity"]);$is_industry=clean($_POST["is_industry"]);$is_electricity=clean($_POST["is_electricity"]);$is_connection=clean($_POST["is_connection"]);$is_director=clean($_POST["is_director"]);
	
	$input_size=$_POST["hiddenval"];
	
	if(!empty($_POST["capacity_details"]) && $_POST["is_capacity"]=="Y")	$capacity_details=$_POST["capacity_details"];
	else $capacity_details=NULL;
	
	if(!empty($_POST["industry_details"]) && $_POST["is_industry"]=="Y")	$industry_details=$_POST["industry_details"];
	else $industry_details=NULL;
	
	if(!empty($_POST["details_connection"]) && $_POST["is_connection"]=="Y")	$details_connection=$_POST["details_connection"];
	else $details_connection=NULL;
	
	if(!empty($_POST["details_electricity"]) && $_POST["is_electricity"]=="Y")	$details_electricity=$_POST["details_electricity"];
	else $details_electricity=NULL;
	
	if(!empty($_POST["details_director"]) && $_POST["is_director"]=="Y")	$details_director=$_POST["details_director"];
	else $details_director=NULL;
	
	
	if(!empty($_POST["consumer"]))	 $consumer=json_encode($_POST["consumer"]);
	else	$consumer=NULL;
	if(!empty($_POST["existing"]))	 $existing=json_encode($_POST["existing"]);
	else	$existing=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,save_mode,sub_date,applicant_name,organization_name,consumer,existing,voltage_supply,total_load,category_tariff,is_capacity,capacity_details,is_industry,industry_details,is_electricity,details_electricity,is_connection,details_connection,is_director,details_director) values ('$swr_id','D','$today','$applicant_name','$organization_name','$consumer','$existing','$voltage_supply','$total_load','$category_tariff','$is_capacity','$capacity_details','$is_industry','$industry_details','$is_electricity','$details_electricity','$is_connection','$details_connection','$is_director','$details_director')");
        $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',applicant_name='$applicant_name',organization_name='$organization_name',consumer='$consumer',existing='$existing',voltage_supply='$voltage_supply',total_load='$total_load',category_tariff='$category_tariff',is_capacity='$is_capacity',capacity_details='$capacity_details',is_industry='$is_industry',industry_details='$industry_details',is_electricity='$is_electricity',details_electricity='$details_electricity',is_connection='$is_connection',details_connection='$details_connection',is_director='$is_director',details_director='$details_director' where form_id='$form_id'");	
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
				
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1 (form_id,slno,cd_reqd,tentative_dt,remarks) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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