<?php
if(isset($_POST["save1"])){
	$fat_name=clean($_POST["fat_name"]);$input_size=$_POST["hiddenval"];
	if(!empty($_POST["fat_address"])) $fat_address=json_encode($_POST["fat_address"]); 
	else $fat_address=NULL;
	if(!empty($_POST["patt_details"])) $patt_details=json_encode($_POST["patt_details"]);
	else $patt_details=NULL;
	if(!empty($_POST["details_plantation"])) $details_plantation=json_encode($_POST["details_plantation"]);
	else $details_plantation=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fat_name,fat_address,patt_details,details_plantation) values ('$swr_id','$today', '$fat_name', '$fat_address', '$patt_details','$details_plantation')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', fat_name='$fat_name', fat_address='$fat_address', patt_details='$patt_details',details_plantation='$details_plantation' where user_id='$swr_id' and form_id=$form_id");			
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,species,spacing,trees) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
	
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

if(isset($_POST["save2"])){		
	$forest_division=clean($_POST["forest_division"]);$post_office=clean($_POST["post_office"]);$fat_name=clean($_POST["fat_name"]);$input_size=$_POST["hiddenval"];$no_trees=clean($_POST["no_trees"]);$is_registered=clean($_POST["is_registered"]);$other_tree=clean($_POST["other_tree"]);
	if(isset($_POST["is_registered_regno"])) $is_registered_regno=clean($_POST["is_registered_regno"]);
	else $is_registered_regno=NULL;
	
	if(!empty($_POST["fat_address"])) $fat_address=json_encode($_POST["fat_address"]);
	else $fat_address=NULL;
	if(!empty($_POST["patt_details"])) $patt_details=json_encode($_POST["patt_details"]);
	else $patt_details=NULL;
	if(!empty($_POST["replant"])) $replant=json_encode($_POST["replant"]);
	else $replant=NULL;
	if(!empty($_POST["under_take"])) $under_take=json_encode($_POST["under_take"]);
	else $under_take=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,forest_division,post_office,fat_name,fat_address,is_registered,is_registered_regno,patt_details,no_trees,replant,under_take, other_tree) values ('$swr_id','$today','$forest_division','$post_office','$fat_name','$fat_address','$is_registered', '$is_registered_regno','$patt_details', '$no_trees','$replant','$under_take','$other_tree')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', forest_division='$forest_division', post_office='$post_office', fat_name='$fat_name', fat_address='$fat_address', is_registered='$is_registered', is_registered_regno='$is_registered_regno', patt_details='$patt_details', no_trees='$no_trees', replant='$replant', under_take='$under_take', other_tree='$other_tree' where user_id='$swr_id' and form_id=$form_id");	
	}		
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,species,height,remarks) VALUES ('','$form_id','$vala','$valb','$valc','$vald')");
			}
		}
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
	$wood_type=clean($_POST["wood_type"]);$industry=clean($_POST["industry"]);$location=clean($_POST["location"]);$legal_stat=clean($_POST["legal_stat"]);$capital=clean($_POST["capital"]);$capacity=clean($_POST["capacity"]);$source=clean($_POST["source"]);$ratio=clean($_POST["ratio"]);$regular=clean($_POST["regular"]);$daily=clean($_POST["daily"]);$investment=clean($_POST["investment"]);$power=clean($_POST["power"]);$offense=clean($_POST["offense"]);$other_details=clean($_POST["other_details"]);$police_station=clean($_POST["police_station"]);$raw_mat=clean($_POST["raw_mat"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,wood_type,industry,location,legal_stat,capital,capacity,source,ratio,regular,daily,investment,power,offense,other_details,police_station,raw_mat) values ('$swr_id','$today','$today','$wood_type','$industry','$location','$legal_stat','$capital','$capacity','$source','$ratio','$regular','$daily','$investment','$power','$offense','$other_details','$police_station','$raw_mat')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today', wood_type='$wood_type',industry='$industry',location='$location',legal_stat='$legal_stat',capital='$capital',capacity='$capacity',source='$source',ratio='$ratio',regular='$regular',daily='$daily',investment='$investment',power='$power',offense='$offense',other_details='$other_details',police_station='$police_station',raw_mat='$raw_mat'  where form_id=$form_id");
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

if(isset($_POST["submit_tp"])){
	/* print_r($_POST);die();
	input_size */
	$ref_uain=clean($_POST["ref_uain"]);
	$input_size=clean($_POST["hiddenval"]);
	
	$permit_no=clean($_POST["permit_no"]);$permit_date=clean($_POST["permit_date"]);$locality_whence_collected=clean($_POST["locality_whence_collected"]);$transported_place=clean($_POST["transported_place"]);$destination=clean($_POST["destination"]);$transport_route=clean($_POST["transport_route"]);$transport_date=clean($_POST["transport_date"]);$expire_date=clean($_POST["expire_date"]);
	
	$permit_date=date("Y-m-d",strtotime($permit_date));
	$transport_date=date("Y-m-d",strtotime($transport_date));
	$expire_date=date("Y-m-d",strtotime($expire_date));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_uain,permit_no,permit_date,locality_whence_collected,transported_place,destination,transport_route,transport_date,expire_date) values ('$swr_id','$today','$ref_uain','$permit_no','$permit_date','$locality_whence_collected','$transported_place', '$destination','$transport_route', '$transport_date','$expire_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', ref_uain='$ref_uain',permit_no='$permit_no', permit_date='$permit_date', locality_whence_collected='$locality_whence_collected', transported_place='$transported_place', destination='$destination', transport_route='$transport_route', transport_date='$transport_date', expire_date='$expire_date' where user_id='$swr_id' and form_id=$form_id");	
	}		
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,species_id,forest_produce,no_of_pieces,measurement,marks_hammar,rate,amt_paid) VALUES ('','$form_id','$vala','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		
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
?>