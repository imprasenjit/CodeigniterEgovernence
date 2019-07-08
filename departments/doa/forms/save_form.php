<?php
if(isset($_POST["save1"])){
	$is_convicted=clean($_POST["is_convicted"]);$is_convicted_details=clean($_POST["is_convicted_details"]);$seeds_detail=clean($_POST["seeds_detail"]);$office_id=clean($_POST["office_id"]);
	$hidden_value=clean($_POST["hidden_value"]); 
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
    
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
    
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id; 
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}
	if($is_convicted=="Y"){
			$is_convicted_details=clean($_POST["is_convicted_details"]);
		}else{
			$is_convicted_details=" ";			
		}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,is_convicted,is_convicted_details,seeds_detail,sale,storage) values ('$swr_id','$today','$office_id','$officer_id','$is_convicted','$is_convicted_details', '$seeds_detail', '$sale', '$storage')") ;
		$form_id=$query;
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,address,contact) VALUES ('','$form_id','$i','$name','$address','$contact')");				
			}						
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',is_convicted='$is_convicted', is_convicted_details='$is_convicted_details',seeds_detail='$seeds_detail',sale='$sale',storage='$storage'  where form_id='$form_id'") ;
           $members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		   if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");
              }	
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,address,contact) VALUES ('$form_id','$i','$name','$address','$contact')");
			}  
		}	  
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
	$is_registration=clean($_POST["is_registration"]);$is_registration_details=clean($_POST["is_registration_details"]);$is_facilities=clean($_POST["is_facilities"]);$is_facilities_details=clean($_POST["is_facilities_details"]);$father_name=clean($_POST["father_name"]);$capacity=clean($_POST["capacity"]);$virtue=clean($_POST["virtue"]);$office_id=clean($_POST["office_id"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
     
     $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,is_registration,is_registration_details,is_facilities,is_facilities_details,	father_name,capacity,virtue) values ('$swr_id','$today','$office_id','officer_id','$is_registration', '$is_registration_details', '$is_facilities', '$is_facilities_details', '$father_name', '$capacity', '$virtue')") ;
		$form_id=$query;
							
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', office_id='$office_id',  officer_id='$officer_id',is_registration='$is_registration', is_registration_details='$is_registration_details', is_facilities='$is_facilities', is_facilities_details='$is_facilities_details', father_name='$father_name', capacity='$capacity' , virtue='$virtue' where form_id='$form_id'") ;
				
	}	
			
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
				if($input_size!=0){					
				$k=$formFunctions->executeQuery($dept,"delete from  ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size;$i++){
					//$vala=$_POST["txtA".$i];		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,reg_no,date) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
					}
				}
				if($input_size2!=0){					
				$k1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					//$vala=$_POST["txtA".$i];		
					$valb=$_POST["textB".$i];
					$valc=$_POST["textC".$i];
					$vald=$_POST["textD".$i];
					$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
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
if(isset($_POST["save3"])){
	$licence_no=clean($_POST["licence_no"]);$licence_dt=clean($_POST["licence_dt"]);$father_name=clean($_POST["father_name"]);$virtue=clean($_POST["virtue"]);$office_id=clean($_POST["office_id"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from  ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into  ".$table_name."(user_id,sub_date,office_id,officer_id,licence_no,licence_dt,father_name,virtue) values ('$swr_id','$today','$office_id','officer_id','$licence_no','$licence_dt','$father_name','$virtue')") ;
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update  ".$table_name." set sub_date='$today', office_id='$office_id', officer_id='$officer_id',licence_no='$licence_no', licence_dt='$licence_dt',  father_name='$father_name',  virtue='$virtue' where form_id='$form_id'") ;
	}		
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
	$is_corner=clean($_POST["is_corner"]);$insecticides=clean($_POST["insecticides"]);$particulars=clean($_POST["particulars"]);$office_id=clean($_POST["office_id"]);
	if(!empty($_POST["sold"]))	 $sold=json_encode($_POST["sold"]);
	else	$sold=NULL;
	if(!empty($_POST["stored"]))	 $stored=json_encode($_POST["stored"]);
	else	$stored=NULL;
	if($is_corner=="Y"){
			$is_corner_details=clean($_POST["is_corner_details"]);
		}else{
			$is_corner_details=" ";			
		}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,is_corner,is_corner_details,insecticides,particulars,sold,stored) values ('$swr_id','$today','$office_id','$officer_id','$is_corner','$is_corner_details','$insecticides','$particulars','$sold','$stored')") ;
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', office_id='$office_id',officer_id='$officer_id',is_corner='$is_corner', is_corner_details='$is_corner_details', insecticides='$insecticides',  particulars='$particulars',  stored='$stored',  stored='$stored' where form_id='$form_id'") ;
	}
			
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST["save5"])){
	$categories=clean($_POST["categories"]);$day=clean($_POST["day"]);$year=clean($_POST["year"]);$licence_no=clean($_POST["licence_no"]);$licence_dt=clean($_POST["licence_dt"]);$cat_operation=clean($_POST["cat_operation"]);$expert_staff=clean($_POST["expert_staff"]);$insecticides=clean($_POST["insecticides"]);$stocking=clean($_POST["stocking"]);$is_grant=clean($_POST["is_grant"]);$other=clean($_POST["other"]);$father_name=clean($_POST["father_name"]);$office_id=clean($_POST["office_id"]);
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,categories,day,year,licence_no,	licence_dt,cat_operation,expert_staff,insecticides,stocking,address,is_grant,other,father_name) values ('$swr_id','$today','$office_id','$officer_id','$categories', '$day', '$year', '$licence_no', '$licence_dt', '$cat_operation', '$expert_staff','$insecticides', '$stocking', '$address', '$is_grant', '$other', '$father_name')") ;
		$form_id=$query;	
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',categories='$categories', day='$day', year='$year', licence_no='$licence_no', licence_dt='$licence_dt', cat_operation='$cat_operation' , expert_staff='$expert_staff', insecticides='$insecticides', stocking='$stocking', address='$address', is_grant='$is_grant', other='$other', father_name='$father_name' where form_id='$form_id'") ;
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST["save6"])){
	$stock=clean($_POST["stock"]);$state=clean($_POST["state"]);$licence_no=clean($_POST["licence_no"]);$licence_no=clean($_POST["licence_no"]);$year=clean($_POST["year"]);$pesticides=clean($_POST["pesticides"]);$principals=clean($_POST["principals"]);$office_id=clean($_POST["office_id"]);
	if(!empty($_POST["sold"]))	 $sold=json_encode($_POST["sold"]);
	else	$sold=NULL;
	if(!empty($_POST["stored"]))	 $stored=json_encode($_POST["stored"]);
	else	$stored=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from  ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into  ".$table_name."(user_id,sub_date,office_id,officer_id,stock,state,licence_no,year,pesticides,principals,sold,stored) values ('$swr_id','$today','$office_id','$officer_id','$stock', '$state', '$licence_no', '$year', '$pesticides', '$principals', '$sold', '$stored')") ;
		$form_id=$query;	
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update  ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id', stock='$stock', state='$state', licence_no='$licence_no', licence_no='$licence_no', year='$year', pesticides='$pesticides' , principals='$principals',  sold='$sold', stored='$stored' where form_id='$form_id'") ;
	}	
			
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST["save7"])){		
	$auth_desig=clean($_POST["auth_desig"]);$place=clean($_POST["place"]);$state=clean($_POST["state"]);$concern=clean($_POST["concern"]);$is_intimate=clean($_POST["is_intimate"]);$other=clean($_POST["other"]);$office_id=clean($_POST["office_id"]);
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,auth_desig,place,state,concern,sale,storage,is_intimate,other) values ('$swr_id','$today', '$office_id','$officer_id','$auth_desig', '$place', '$state', '$concern', '$sale', '$storage', '$is_intimate', '$other')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  office_id='$office_id',officer_id='$officer_id', auth_desig='$auth_desig', place='$place',  state='$state',concern='$concern', sale='$sale', storage='$storage', is_intimate='$is_intimate', other='$other' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,firm,stock) VALUES ('','$form_id','$i','$valb','$valc')");
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

if(isset($_POST["save8"])){		
	$auth_desig=clean($_POST["auth_desig"]);$place=clean($_POST["place"]);$state=clean($_POST["state"]);$concern=clean($_POST["concern"]);$is_intimate=clean($_POST["is_intimate"]);$other=clean($_POST["other"]);$office_id=clean($_POST["office_id"]);
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,auth_desig,place,state,concern,sale,storage,is_intimate,other) values ('$swr_id','$today', '$office_id','officer_id','$auth_desig', '$place', '$state', '$concern', '$sale', '$storage', '$is_intimate', '$other')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  office_id='$office_id',officer_id='$officer_id',auth_desig='$auth_desig', place='$place',  state='$state',concern='$concern', sale='$sale', storage='$storage', is_intimate='$is_intimate', other='$other' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,firm,stock) VALUES ('','$form_id','$i','$valb','$valc')");
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

if(isset($_POST["save9"])){		
	$auth_desig=clean($_POST["auth_desig"]);$place=clean($_POST["place"]);$state=clean($_POST["state"]);$concern=clean($_POST["concern"]);$is_intimate=clean($_POST["is_intimate"]);$other=clean($_POST["other"]);$office_id=clean($_POST["office_id"]);
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,auth_desig,place,state,concern,sale,storage,is_intimate,other) values ('$swr_id','$today', '$office_id','$officer_id','$auth_desig', '$place', '$state', '$concern', '$sale', '$storage', '$is_intimate', '$other')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  office_id='$office_id',officer_id='$officer_id',auth_desig='$auth_desig', place='$place',  state='$state',concern='$concern', sale='$sale', storage='$storage', is_intimate='$is_intimate', other='$other' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,firm,stock) VALUES ('','$form_id','$i','$valb','$valc')") ;
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

if(isset($_POST["save10"])){		
	$auth_desig=clean($_POST["auth_desig"]);$place=clean($_POST["place"]);$state=clean($_POST["state"]);$concern=clean($_POST["concern"]);$is_intimate=clean($_POST["is_intimate"]);$other=clean($_POST["other"]);$office_id=clean($_POST["office_id"]);
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,auth_desig,place,state,concern,sale,storage,is_intimate,other) values ('$swr_id','$today','$office_id','$officer_id', '$auth_desig', '$place', '$state', '$concern', '$sale', '$storage', '$is_intimate', '$other')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id', auth_desig='$auth_desig', place='$place',  state='$state',concern='$concern', sale='$sale', storage='$storage', is_intimate='$is_intimate', other='$other' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,firm,stock) VALUES ('','$form_id','$i','$valb','$valc')");
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
