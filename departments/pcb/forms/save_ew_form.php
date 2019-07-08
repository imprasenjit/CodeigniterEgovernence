<?php
if(isset($_POST["save13"])){
	
	$contact_person_name=clean($_POST["contact_person_name"]);$contact_person_desig=clean($_POST["contact_person_desig"]);
	if(!empty($_POST["contact_person_add"])) $contact_person_add=json_encode($_POST["contact_person_add"]);else $contact_person_add=NULL;
	if(!empty($_POST["auth_req"])) $auth_req=json_encode($_POST["auth_req"]);else $auth_req=NULL;	
	if(!empty($_POST["ew_details"])) $ew_details=json_encode($_POST["ew_details"]);else $ew_details=NULL;
	
	$details_facilities=clean($_POST["details_facilities"]);
	
	if(!empty($_POST["ren_auth"]))	 $ren_auth=json_encode($_POST["ren_auth"]);else	$ren_auth=NULL;
			
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$q->fetch_array();
	if($q->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,contact_person_name,contact_person_desig,contact_person_add,auth_req,ew_details,details_facilities,ren_auth) values ('$swr_id','$today', '$contact_person_name', '$contact_person_desig', '$contact_person_add', '$auth_req','$ew_details','$details_facilities','$ren_auth')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', contact_person_name='$contact_person_name', contact_person_desig='$contact_person_desig', contact_person_add='$contact_person_add', auth_req='$auth_req',ew_details='$ew_details',details_facilities='$details_facilities',ren_auth='$ren_auth' where user_id='$swr_id' and form_id=$form_id");
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

if(isset($_POST["save14"])) {	    
	$s1=clean($_POST["s1"]);$auth_issue_dt=clean($_POST["auth_issue_dt"]);$auth_val_dt=clean($_POST["auth_val_dt"]);		
	if(!empty($_POST["ew_handle"])) $ew_handle=json_encode($_POST["ew_handle"]);	else	$ew_handle=NULL;		
	if(!empty($_POST["ew_store"]))	$ew_store=json_encode($_POST["ew_store"]);		else $ew_store=NULL;		
	if(!empty($_POST["ew_auth_collection"]))	$ew_auth_collection=json_encode($_POST["ew_auth_collection"]);		else	$ew_auth_collection=NULL;		
	if(!empty($_POST["ew_transport"]))	$ew_transport=json_encode($_POST["ew_transport"]);		else	$ew_transport=NULL;		
	if(!empty($_POST["ew_refur"]))	$ew_refur=json_encode($_POST["ew_refur"]);		else	$ew_refur=NULL;			
	if(!empty($_POST["ew_dismant"]))	$ew_dismant=json_encode($_POST["ew_dismant"]);		else $ew_dismant=NULL;		
	if(!empty($_POST["ew_recycle"]))	$ew_recycle=json_encode($_POST["ew_recycle"]);		else	$ew_recycle=NULL;		
	if(!empty($_POST["ew_recover"]))	$ew_recover=json_encode($_POST["ew_recover"]);		else	$ew_recover=NULL;		
	if(!empty($_POST["ew_treated"]))	$ew_treated=json_encode($_POST["ew_treated"]);		else	$ew_treated=NULL;		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,s1,auth_issue_dt,auth_val_dt,ew_handle,ew_store,ew_auth_collection,ew_transport,ew_refur,ew_dismant,ew_recycle,ew_recover,ew_treated) values('$swr_id','$s1','$auth_issue_dt','$auth_val_dt','$ew_handle','$ew_store','$ew_auth_collection','$ew_transport','$ew_refur','$ew_dismant','$ew_recycle','$ew_recover','$ew_treated')");
		$form_id=$query;		
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', s1='$s1',auth_issue_dt='$auth_issue_dt',auth_val_dt='$auth_val_dt',ew_handle='$ew_handle',ew_store='$ew_store',ew_auth_collection='$ew_auth_collection',ew_transport='$ew_transport',ew_refur='$ew_refur',ew_dismant='$ew_dismant',ew_recycle='$ew_recycle',ew_recover='$ew_recover',ew_treated='$ew_treated' WHERE user_id='$swr_id' AND form_id='$form_id'");	
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

if(isset($_POST["save15"])) {
	$s1=clean($_POST["s1"]);		
	if(!empty($_POST["total_qty"]))	$total_qty=json_encode($_POST["total_qty"]);		else $total_qty=NULL;				
	if(!empty($_POST["destn_add"]))	$destn_add=json_encode($_POST["destn_add"]);		else	$destn_add=NULL;			
	if(!empty($_POST["mat_seg_rcvr"]))	$mat_seg_rcvr=json_encode($_POST["mat_seg_rcvr"]);		else	$destn_add=NULL;		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,s1,total_qty,destn_add,mat_seg_rcvr) values ('$swr_id','$s1','$total_qty','$destn_add','$mat_seg_rcvr')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',s1='$s1', total_qty='$total_qty',destn_add='$destn_add',mat_seg_rcvr='$mat_seg_rcvr' WHERE form_id='$form_id' and user_id='$swr_id'");
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

if(isset($_POST["save16a"])) {
	$dt_of_comm=clean($_POST["dt_of_comm"]);$no_of_workers=clean($_POST["no_of_workers"]);$auth_val=clean($_POST["auth_val"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$input_size3=$_POST["hiddenval3"];				
	if(!empty($_POST["consent_val"]))	$consent_val=json_encode($_POST["consent_val"]);
	else $consent_val=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,dt_of_comm,no_of_workers,auth_val,consent_val) values ('$swr_id','$today','$dt_of_comm','$no_of_workers', '$auth_val', '$consent_val')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',dt_of_comm='$dt_of_comm',no_of_workers='$no_of_workers', auth_val='$auth_val', consent_val='$consent_val' where form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,product,capacity) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,year,product,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["ttxtB".$i];
			$valc=$_POST["ttxtC".$i];
			$vald=$_POST["ttxtD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,year,product,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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
if(isset($_POST["save16b"])) {
	$treatment_storage=clean($_POST["treatment_storage"]);
	$input_size4=$_POST["hiddenval4"];$input_size5=$_POST["hiddenval5"];$input_size6=$_POST["hiddenval6"];
	$input_size7=$_POST["hiddenval7"];$input_size8=$_POST["hiddenval8"];
	if(!empty($_POST["water_cs"]))	$water_cs=json_encode($_POST["water_cs"]);
	else $water_cs=NULL;
							
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){	
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,treatment_storage,water_cs) values ('$swr_id','$treatment_storage','$water_cs')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];			
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET treatment_storage='$treatment_storage',water_cs='$water_cs' WHERE form_id='$form_id'");
	}	
	if($query){
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,fuel,quantity) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,stack,emission) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,slno,location,parameter) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(form_id,slno,type,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["ttextB".$i];
				$valc=$_POST["ttextC".$i];
				$vald=$_POST["ttextD".$i];
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(form_id,slno,type,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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
if(isset($_POST["save16c"])) {
	$is_indus_provided=clean($_POST["is_indus_provided"]);$is_indus_compli=clean($_POST["is_indus_compli"]);
	$input_size9=$_POST["hiddenval9"];
	if(isset($_POST["adq_system"])) $adq_system=$_POST["adq_system"];
	else $adq_system=NULL;
	if(!empty($_POST["any_other_info"]))	$any_other_info=json_encode($_POST["any_other_info"]);
	else $any_other_info=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,is_indus_provided,adq_system,is_indus_compli,any_other_info) values ('$swr_id','$is_indus_provided','$adq_system','$is_indus_compli','$any_other_info')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET is_indus_provided='$is_indus_provided',adq_system='$adq_system',is_indus_compli='$is_indus_compli',any_other_info='$any_other_info' WHERE form_id='$form_id' ");
	}
	if($query){
		if($input_size9!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];				
				$part9=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t9(form_id,slno,name,qty,baselno) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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

if(isset($_POST["save17"])) {		
	if(!empty($_POST["total_qty"]))	$total_qty=json_encode($_POST["total_qty"]);		else $total_qty=NULL;				
	if(!empty($_POST["destn_add"]))	$destn_add=json_encode($_POST["destn_add"]);		else	$destn_add=NULL;			
	if(!empty($_POST["mat_seg_rcvr"]))	$mat_seg_rcvr=json_encode($_POST["mat_seg_rcvr"]);		else	$destn_add=NULL;		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,total_qty,destn_add,mat_seg_rcvr) values ('$swr_id','$total_qty','$destn_add','$mat_seg_rcvr')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',total_qty='$total_qty',destn_add='$destn_add',mat_seg_rcvr='$mat_seg_rcvr' WHERE form_id='$form_id' and user_id='$swr_id'");
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

if(isset($_POST["save53a"])) {
	$dt_of_comm=clean($_POST["dt_of_comm"]);$no_of_workers=clean($_POST["no_of_workers"]);$auth_val=clean($_POST["auth_val"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$input_size3=$_POST["hiddenval3"];				
	if(!empty($_POST["consent_val"]))	$consent_val=json_encode($_POST["consent_val"]);
	else $consent_val=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,dt_of_comm,no_of_workers,auth_val,consent_val) values ('$swr_id','$today','$dt_of_comm','$no_of_workers', '$auth_val', '$consent_val')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',dt_of_comm='$dt_of_comm',no_of_workers='$no_of_workers', auth_val='$auth_val', consent_val='$consent_val' where form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,product,capacity) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,year,product,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["ttxtB".$i];
			$valc=$_POST["ttxtC".$i];
			$vald=$_POST["ttxtD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,year,product,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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
if(isset($_POST["save53b"])) {
	$treatment_storage=clean($_POST["treatment_storage"]);
	$input_size4=$_POST["hiddenval4"];$input_size5=$_POST["hiddenval5"];$input_size6=$_POST["hiddenval6"];
	$input_size7=$_POST["hiddenval7"];$input_size8=$_POST["hiddenval8"];
	if(!empty($_POST["water_cs"]))	$water_cs=json_encode($_POST["water_cs"]);
	else $water_cs=NULL;
							
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){	
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,treatment_storage,water_cs) values ('$swr_id','$treatment_storage','$water_cs')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];			
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET treatment_storage='$treatment_storage',water_cs='$water_cs' WHERE form_id='$form_id'");
	}	
	if($query){
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,fuel,quantity) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,stack,emission) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,slno,location,parameter) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(form_id,slno,type,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["ttextB".$i];
				$valc=$_POST["ttextC".$i];
				$vald=$_POST["ttextD".$i];
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(form_id,slno,type,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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
if(isset($_POST["save53c"])) {
	$is_indus_provided=clean($_POST["is_indus_provided"]);$is_indus_compli=clean($_POST["is_indus_compli"]);
	$input_size9=$_POST["hiddenval9"];
	if(isset($_POST["adq_system"])) $adq_system=$_POST["adq_system"];
	else $adq_system=NULL;
	if(!empty($_POST["any_other_info"]))	$any_other_info=json_encode($_POST["any_other_info"]);
	else $any_other_info=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,is_indus_provided,adq_system,is_indus_compli,any_other_info) values ('$swr_id','$is_indus_provided','$adq_system','$is_indus_compli','$any_other_info')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET is_indus_provided='$is_indus_provided',adq_system='$adq_system',is_indus_compli='$is_indus_compli',any_other_info='$any_other_info' WHERE form_id='$form_id' ");
	}
	if($query){
		if($input_size9!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];				
				$part9=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t9(form_id,slno,name,qty,baselno) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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
if(isset($_POST["save54"])){
	
	$contact_person_name=clean($_POST["contact_person_name"]);$contact_person_desig=clean($_POST["contact_person_desig"]);
	if(!empty($_POST["contact_person_add"])) $contact_person_add=json_encode($_POST["contact_person_add"]);else $contact_person_add=NULL;
	if(!empty($_POST["auth_req"])) $auth_req=json_encode($_POST["auth_req"]);else $auth_req=NULL;	
	if(!empty($_POST["ew_details"])) $ew_details=json_encode($_POST["ew_details"]);else $ew_details=NULL;
	
	$details_facilities=clean($_POST["details_facilities"]);
	
	if(!empty($_POST["ren_auth"]))	 $ren_auth=json_encode($_POST["ren_auth"]);else	$ren_auth=NULL;
			
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$q->fetch_array();
	if($q->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,contact_person_name,contact_person_desig,contact_person_add,auth_req,ew_details,details_facilities,ren_auth) values ('$swr_id','$today', '$contact_person_name', '$contact_person_desig', '$contact_person_add', '$auth_req','$ew_details','$details_facilities','$ren_auth')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', contact_person_name='$contact_person_name', contact_person_desig='$contact_person_desig', contact_person_add='$contact_person_add', auth_req='$auth_req',ew_details='$ew_details',details_facilities='$details_facilities',ren_auth='$ren_auth' where user_id='$swr_id' and form_id=$form_id");
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