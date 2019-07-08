<?php
if(isset($_POST["save1a"])){	
	$dec1=clean($_POST["dec1"]);
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,dec1) values ('$swr_id','$today', '$dec1')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', dec1='$dec1' where form_id='$form_id'");
         }
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,drugs_name,drugs_det) VALUES ('','$form_id','$i','$valb','$valc')") ;
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
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
if(isset($_POST["save1b"])){	
	$business_carried=clean($_POST["business_carried"]); $is_engaged=clean($_POST["is_engaged"]); $is_engaged_det=clean($_POST["is_engaged_det"]); $business_crri=clean($_POST["business_crri"]); $license_yr=clean($_POST["license_yr"]); $licenses_granted=clean($_POST["licenses_granted"]); $is_rejected=clean($_POST["is_rejected"]); $is_rejected_det=clean($_POST["is_rejected_det"]); $is_selling_goods=clean($_POST["is_selling_goods"]); $is_spirituous_medicinal=clean($_POST["is_spirituous_medicinal"]); $is_spirituous_medicinal_det=clean($_POST["is_spirituous_medicinal_det"]); $is_license_previously=clean($_POST["is_license_previously"]); $rooms_storage=clean($_POST["rooms_storage"]); $floor_area=clean($_POST["floor_area"]); $room_sketch=clean($_POST["room_sketch"]); $is_license_previously_det=clean($_POST["is_license_previously_det"]); $is_agent_distributor=clean($_POST["is_agent_distributor"]); $is_license=clean($_POST["is_license"]);$educational_qualifications=clean($_POST["educational_qualifications"]);$is_agent_distributor_det=clean($_POST["is_agent_distributor_det"]);
	 
	$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["premises_convicted"]))	 $premises_convicted=json_encode($_POST["premises_convicted"]);
	 else	$premises_convicted=NULL;
	if(!empty($_POST["licensing_authority"]))	 $licensing_authority=json_encode($_POST["licensing_authority"]);
	 else	$licensing_authority=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :". $ayush->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,business_carried,educational_qualifications,is_engaged,is_engaged_det,business_crri,is_license,license_yr,licenses_granted,is_rejected,is_rejected_det,is_selling_goods,premises_convicted,is_spirituous_medicinal,is_spirituous_medicinal_det,is_license_previously,is_license_previously_det,is_agent_distributor,is_agent_distributor_det,licensing_authority,rooms_storage,floor_area,room_sketch) values ('$swr_id','$today','$business_carried','$educational_qualifications','$is_engaged','$is_engaged_det','$business_crri','$is_license','$license_yr','$licenses_granted','$is_rejected','$is_rejected_det', '$is_selling_goods','$premises_convicted','$is_spirituous_medicinal','$is_spirituous_medicinal_det','$is_license_previously', '$is_license_previously_det','$is_agent_distributor','$is_agent_distributor_det','$licensing_authority','$rooms_storage','$floor_area','$room_sketch')") ;
		$form_id=$query;
		//die("a");
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") ;
		}
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',business_carried='$business_carried',educational_qualifications='$educational_qualifications', is_engaged='$is_engaged',is_engaged_det='$is_engaged_det', business_crri='$business_crri',is_license='$is_license',license_yr='$license_yr',licenses_granted='$licenses_granted', is_rejected='$is_rejected',is_rejected_det='$is_rejected_det', is_selling_goods='$is_selling_goods', premises_convicted='$premises_convicted',is_spirituous_medicinal='$is_spirituous_medicinal',is_spirituous_medicinal_det='$is_spirituous_medicinal_det', is_license_previously='$is_license_previously', is_license_previously_det='$is_license_previously_det',is_agent_distributor='$is_agent_distributor',is_agent_distributor_det='$is_agent_distributor_det',licensing_authority='$licensing_authority',rooms_storage='$rooms_storage',floor_area='$floor_area',room_sketch='$room_sketch' where form_id='$form_id'");
	
		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'") ;
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") ;
			}			
		}		
	}
	if($query==true && $query1==true){
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
	$spirits_village=clean($_POST["spirits_village"]); $spirits_medicinal=clean($_POST["spirits_medicinal"]); $hours_business=clean($_POST["hours_business"]); $trade_association=clean($_POST["trade_association"]);
	$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];
	 
	if(!empty($_POST["drugs_stocked"]))	 $drugs_stocked=json_encode($_POST["drugs_stocked"]);
	else	$drugs_stocked=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drugs_stocked,spirits_village,spirits_medicinal,hours_business,trade_association) values ('$swr_id','$today', '$premises_part','$drugs_stocked','$spirits_village','$spirits_medicinal','$hours_business','$trade_association')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',drugs_stocked='$drugs_stocked',spirits_village='$spirits_village',spirits_medicinal='$spirits_medicinal', hours_business='$hours_business',trade_association='$trade_association' where form_id='$form_id'");
	}
		
    if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txxxtB".$i];
				$valc=$_POST["txxxtC".$i];
				$vald=$_POST["txxxtD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,address_1,address_2,address_3) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
			}
		}
		if($input_size4!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,class_commo) VALUES ('','$form_id','$i','$valb')") ;
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

if(isset($_POST["save2a"])){	
	$dec1=clean($_POST["dec1"]);
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,dec1) values ('$swr_id','$today', '$dec1')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', dec1='$dec1' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,drugs_name,drugs_det) VALUES ('','$form_id','$i','$valb','$valc')") ;
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
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
if(isset($_POST["save2b"])){	
    $business_carried=clean($_POST["business_carried"]); $is_engaged=clean($_POST["is_engaged"]); $is_engaged_det=clean($_POST["is_engaged_det"]); $business_crri=clean($_POST["business_crri"]); $license_yr=clean($_POST["license_yr"]); $licenses_granted=clean($_POST["licenses_granted"]); $is_rejected=clean($_POST["is_rejected"]); $is_rejected_det=clean($_POST["is_rejected_det"]); $is_selling_goods=clean($_POST["is_selling_goods"]); $is_spirituous_medicinal=clean($_POST["is_spirituous_medicinal"]); $is_spirituous_medicinal_det=clean($_POST["is_spirituous_medicinal_det"]); $is_license_previously=clean($_POST["is_license_previously"]); $rooms_storage=clean($_POST["rooms_storage"]); $floor_area=clean($_POST["floor_area"]); $room_sketch=clean($_POST["room_sketch"]); $is_license_previously_det=clean($_POST["is_license_previously_det"]); $is_agent_distributor=clean($_POST["is_agent_distributor"]); $is_license=clean($_POST["is_license"]);$educational_qualifications=clean($_POST["educational_qualifications"]);$is_agent_distributor_det=clean($_POST["is_agent_distributor_det"]);
	$hidden_value=clean($_POST["hidden_value"]);
	 
	if(!empty($_POST["premises_convicted"]))	 $premises_convicted=json_encode($_POST["premises_convicted"]);
	 else	$premises_convicted=NULL;
	 
	if(!empty($_POST["licensing_authority"]))	 $licensing_authority=json_encode($_POST["licensing_authority"]);
	 else	$licensing_authority=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") ;
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,business_carried,educational_qualifications,is_engaged,is_engaged_det,business_crri,is_license,license_yr,licenses_granted,is_rejected,is_rejected_det,is_selling_goods,premises_convicted,is_spirituous_medicinal,is_spirituous_medicinal_det,is_license_previously,is_license_previously_det,is_agent_distributor,is_agent_distributor_det,licensing_authority,rooms_storage,floor_area,room_sketch) values ('$swr_id','$today','$business_carried','$educational_qualifications','$is_engaged','$is_engaged_det','$business_crri','$is_license','$license_yr','$licenses_granted','$is_rejected','$is_rejected_det', '$is_selling_goods','$premises_convicted','$is_spirituous_medicinal','$is_spirituous_medicinal_det','$is_license_previously', '$is_license_previously_det','$is_agent_distributor','$is_agent_distributor_det','$licensing_authority','$rooms_storage','$floor_area','$room_sketch')") ;
		$form_id=$query;
		die("a");
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") ;
		}
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',business_carried='$business_carried',educational_qualifications='$educational_qualifications', is_engaged='$is_engaged',is_engaged_det='$is_engaged_det', business_crri='$business_crri',is_license='$is_license',license_yr='$license_yr',licenses_granted='$licenses_granted', is_rejected='$is_rejected',is_rejected_det='$is_rejected_det', is_selling_goods='$is_selling_goods', premises_convicted='$premises_convicted',is_spirituous_medicinal='$is_spirituous_medicinal',is_spirituous_medicinal_det='$is_spirituous_medicinal_det', is_license_previously='$is_license_previously', is_license_previously_det='$is_license_previously_det',is_agent_distributor='$is_agent_distributor',is_agent_distributor_det='$is_agent_distributor_det',licensing_authority='$licensing_authority',rooms_storage='$rooms_storage',floor_area='$floor_area',room_sketch='$room_sketch' where form_id='$form_id'");
	
		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'") ;
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") ;
			}			
		}		
	}
	if($query==true && $query1==true){
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
if(isset($_POST["save2c"])){	
	$spirits_village=clean($_POST["spirits_village"]); $spirits_medicinal=clean($_POST["spirits_medicinal"]); $hours_business=clean($_POST["hours_business"]); $trade_association=clean($_POST["trade_association"]);
	$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];
	 
	if(!empty($_POST["drugs_stocked"]))	 $drugs_stocked=json_encode($_POST["drugs_stocked"]);
	else	$drugs_stocked=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drugs_stocked,spirits_village,spirits_medicinal,hours_business,trade_association) values ('$swr_id','$today', '$premises_part','$drugs_stocked','$spirits_village','$spirits_medicinal','$hours_business','$trade_association')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',drugs_stocked='$drugs_stocked',spirits_village='$spirits_village',spirits_medicinal='$spirits_medicinal', hours_business='$hours_business',trade_association='$trade_association' where form_id='$form_id'");
	}
    if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txxxtB".$i];
				$valc=$_POST["txxxtC".$i];
				$vald=$_POST["txxxtD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,address_1,address_2,address_3) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
			}
		}
		if($input_size4!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,class_commo) VALUES ('','$form_id','$i','$valb')") ;
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

if(isset($_POST["save3a"])){	
	$dec1=clean($_POST["dec1"]);
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,dec1) values ('$swr_id','$today', '$dec1')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', dec1='$dec1' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,drugs_name,drugs_det) VALUES ('','$form_id','$i','$valb','$valc')") ;
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
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
if(isset($_POST["save3b"])){	
    $business_carried=clean($_POST["business_carried"]); $is_engaged=clean($_POST["is_engaged"]); $is_engaged_det=clean($_POST["is_engaged_det"]); $business_crri=clean($_POST["business_crri"]); $license_yr=clean($_POST["license_yr"]); $licenses_granted=clean($_POST["licenses_granted"]); $is_rejected=clean($_POST["is_rejected"]); $is_rejected_det=clean($_POST["is_rejected_det"]); $is_selling_goods=clean($_POST["is_selling_goods"]); $is_spirituous_medicinal=clean($_POST["is_spirituous_medicinal"]); $is_spirituous_medicinal_det=clean($_POST["is_spirituous_medicinal_det"]); $is_license_previously=clean($_POST["is_license_previously"]); $rooms_storage=clean($_POST["rooms_storage"]); $floor_area=clean($_POST["floor_area"]); $room_sketch=clean($_POST["room_sketch"]); $is_license_previously_det=clean($_POST["is_license_previously_det"]); $is_agent_distributor=clean($_POST["is_agent_distributor"]); $is_license=clean($_POST["is_license"]);$educational_qualifications=clean($_POST["educational_qualifications"]);$is_agent_distributor_det=clean($_POST["is_agent_distributor_det"]);
	$hidden_value=clean($_POST["hidden_value"]);
	 
	if(!empty($_POST["premises_convicted"]))	 $premises_convicted=json_encode($_POST["premises_convicted"]);
	 else	$premises_convicted=NULL;
	 
	if(!empty($_POST["licensing_authority"]))	 $licensing_authority=json_encode($_POST["licensing_authority"]);
	 else	$licensing_authority=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,business_carried,educational_qualifications,is_engaged,is_engaged_det,business_crri,is_license,license_yr,licenses_granted,is_rejected,is_rejected_det,is_selling_goods,premises_convicted,is_spirituous_medicinal,is_spirituous_medicinal_det,is_license_previously,is_license_previously_det,is_agent_distributor,is_agent_distributor_det,licensing_authority,rooms_storage,floor_area,room_sketch) values ('$swr_id','$today','$business_carried','$educational_qualifications','$is_engaged','$is_engaged_det','$business_crri','$is_license','$license_yr','$licenses_granted','$is_rejected','$is_rejected_det', '$is_selling_goods','$premises_convicted','$is_spirituous_medicinal','$is_spirituous_medicinal_det','$is_license_previously', '$is_license_previously_det','$is_agent_distributor','$is_agent_distributor_det','$licensing_authority','$rooms_storage','$floor_area','$room_sketch')") ;
		$form_id=$query;
		die("a");
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") ;
		}
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',business_carried='$business_carried',educational_qualifications='$educational_qualifications', is_engaged='$is_engaged',is_engaged_det='$is_engaged_det', business_crri='$business_crri',is_license='$is_license',license_yr='$license_yr',licenses_granted='$licenses_granted', is_rejected='$is_rejected',is_rejected_det='$is_rejected_det', is_selling_goods='$is_selling_goods', premises_convicted='$premises_convicted',is_spirituous_medicinal='$is_spirituous_medicinal',is_spirituous_medicinal_det='$is_spirituous_medicinal_det', is_license_previously='$is_license_previously', is_license_previously_det='$is_license_previously_det',is_agent_distributor='$is_agent_distributor',is_agent_distributor_det='$is_agent_distributor_det',licensing_authority='$licensing_authority',rooms_storage='$rooms_storage',floor_area='$floor_area',room_sketch='$room_sketch' where form_id='$form_id'");
	
		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'") ;
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") ;
			}			
		}		
	}
	if($query==true && $query1==true){
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
if(isset($_POST["save3c"])){	
	$spirits_village=clean($_POST["spirits_village"]); $spirits_medicinal=clean($_POST["spirits_medicinal"]); $hours_business=clean($_POST["hours_business"]); $trade_association=clean($_POST["trade_association"]);
	$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];
	 
	if(!empty($_POST["drugs_stocked"]))	 $drugs_stocked=json_encode($_POST["drugs_stocked"]);
	else	$drugs_stocked=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drugs_stocked,spirits_village,spirits_medicinal,hours_business,trade_association) values ('$swr_id','$today', '$premises_part','$drugs_stocked','$spirits_village','$spirits_medicinal','$hours_business','$trade_association')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',drugs_stocked='$drugs_stocked',spirits_village='$spirits_village',spirits_medicinal='$spirits_medicinal', hours_business='$hours_business',trade_association='$trade_association' where form_id='$form_id'");
	}
		
    if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txxxtB".$i];
				$valc=$_POST["txxxtC".$i];
				$vald=$_POST["txxxtD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,address_1,address_2,address_3) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
			}
		}
		if($input_size4!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,class_commo) VALUES ('','$form_id','$i','$valb')") ;
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

if(isset($_POST["save4"])){
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date) values ('$swr_id','$today')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,drugs_name,drugs_det) VALUES ('','$form_id','$i','$valb','$valc')") ;
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
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

if(isset($_POST["save5a"])){	
	$dec1=clean($_POST["dec1"]);
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,dec1) values ('$swr_id','$today', '$dec1')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', dec1='$dec1' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,drugs_name,drugs_det) VALUES ('','$form_id','$i','$valb','$valc')") ;
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
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
if(isset($_POST["save5b"])){	
    $business_carried=clean($_POST["business_carried"]); $is_engaged=clean($_POST["is_engaged"]); $is_engaged_det=clean($_POST["is_engaged_det"]); $business_crri=clean($_POST["business_crri"]); $license_yr=clean($_POST["license_yr"]); $licenses_granted=clean($_POST["licenses_granted"]); $is_rejected=clean($_POST["is_rejected"]); $is_rejected_det=clean($_POST["is_rejected_det"]); $is_selling_goods=clean($_POST["is_selling_goods"]); $is_spirituous_medicinal=clean($_POST["is_spirituous_medicinal"]); $is_spirituous_medicinal_det=clean($_POST["is_spirituous_medicinal_det"]); $is_license_previously=clean($_POST["is_license_previously"]); $rooms_storage=clean($_POST["rooms_storage"]); $floor_area=clean($_POST["floor_area"]); $room_sketch=clean($_POST["room_sketch"]); $is_license_previously_det=clean($_POST["is_license_previously_det"]); $is_agent_distributor=clean($_POST["is_agent_distributor"]); $is_license=clean($_POST["is_license"]);$educational_qualifications=clean($_POST["educational_qualifications"]);$is_agent_distributor_det=clean($_POST["is_agent_distributor_det"]);
	$hidden_value=clean($_POST["hidden_value"]);
	 
	if(!empty($_POST["premises_convicted"]))	 $premises_convicted=json_encode($_POST["premises_convicted"]);
	 else	$premises_convicted=NULL;
	 
	if(!empty($_POST["licensing_authority"]))	 $licensing_authority=json_encode($_POST["licensing_authority"]);
	 else	$licensing_authority=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :". $ayush->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,business_carried,educational_qualifications,is_engaged,is_engaged_det,business_crri,is_license,license_yr,licenses_granted,is_rejected,is_rejected_det,is_selling_goods,premises_convicted,is_spirituous_medicinal,is_spirituous_medicinal_det,is_license_previously,is_license_previously_det,is_agent_distributor,is_agent_distributor_det,licensing_authority,rooms_storage,floor_area,room_sketch) values ('$swr_id','$today','$business_carried','$educational_qualifications','$is_engaged','$is_engaged_det','$business_crri','$is_license','$license_yr','$licenses_granted','$is_rejected','$is_rejected_det', '$is_selling_goods','$premises_convicted','$is_spirituous_medicinal','$is_spirituous_medicinal_det','$is_license_previously', '$is_license_previously_det','$is_agent_distributor','$is_agent_distributor_det','$licensing_authority','$rooms_storage','$floor_area','$room_sketch')") ;
		$form_id=$query;
		die("a");
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") ;
		}
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',business_carried='$business_carried',educational_qualifications='$educational_qualifications', is_engaged='$is_engaged',is_engaged_det='$is_engaged_det', business_crri='$business_crri',is_license='$is_license',license_yr='$license_yr',licenses_granted='$licenses_granted', is_rejected='$is_rejected',is_rejected_det='$is_rejected_det', is_selling_goods='$is_selling_goods', premises_convicted='$premises_convicted',is_spirituous_medicinal='$is_spirituous_medicinal',is_spirituous_medicinal_det='$is_spirituous_medicinal_det', is_license_previously='$is_license_previously', is_license_previously_det='$is_license_previously_det',is_agent_distributor='$is_agent_distributor',is_agent_distributor_det='$is_agent_distributor_det',licensing_authority='$licensing_authority',rooms_storage='$rooms_storage',floor_area='$floor_area',room_sketch='$room_sketch' where form_id='$form_id'");
	
		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'") ;
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") ;
			}			
		}		
	}
	if($query==true && $query1==true){
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
if(isset($_POST["save5c"])){	
	$spirits_village=clean($_POST["spirits_village"]); $spirits_medicinal=clean($_POST["spirits_medicinal"]); $hours_business=clean($_POST["hours_business"]); $trade_association=clean($_POST["trade_association"]);
	$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];
	 
	if(!empty($_POST["drugs_stocked"]))	 $drugs_stocked=json_encode($_POST["drugs_stocked"]);
	else	$drugs_stocked=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drugs_stocked,spirits_village,spirits_medicinal,hours_business,trade_association) values ('$swr_id','$today', '$premises_part','$drugs_stocked','$spirits_village','$spirits_medicinal','$hours_business','$trade_association')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',drugs_stocked='$drugs_stocked',spirits_village='$spirits_village',spirits_medicinal='$spirits_medicinal', hours_business='$hours_business',trade_association='$trade_association' where form_id='$form_id'");
	}
	
    if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txxxtB".$i];
				$valc=$_POST["txxxtC".$i];
				$vald=$_POST["txxxtD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,address_1,address_2,address_3) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
			}
		}
		if($input_size4!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,class_commo) VALUES ('','$form_id','$i','$valb')") ;
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
