<?php
if(isset($_POST['save1a'])){
	$firm_duration=clean($_POST['firm_duration']);$business_nature=clean($_POST['business_nature']);$po_name=clean($_POST["po_name"]);$ps_name=clean($_POST["ps_name"]);$is_different=clean($_POST["is_different"]);$o_land_type=clean($_POST["o_land_type"]);
	if(!empty($_POST["other_address"]))  $other_address=json_encode($_POST["other_address"]);
	else	$other_address=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,firm_duration,business_nature,po_name,ps_name,is_different,o_land_type,other_address) values ('$swr_id','$today','$firm_duration','$business_nature', '$po_name', '$ps_name', '$is_different', '$o_land_type', '$other_address')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', firm_duration='$firm_duration', business_nature='$business_nature',po_name='$po_name', ps_name='$ps_name', is_different='$is_different', o_land_type='$o_land_type' , other_address='$other_address' where form_id='$form_id'");
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
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") ;
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		 echo "<script>
		   alert('Please fill up the first part of the form !!!');
		   window.location.href = '".$table_name.".php';
		</script>";		
	}else{
		$form_id=$row["form_id"];
		$hidden_value=$_POST["hiddenval1"];		
		if($hidden_value>0){
			$sql1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($gumo=1; $gumo<$hidden_value; $gumo++){
				$member_name=$_POST["txxtB".$gumo.""];$member_address=$_POST["txxtC".$gumo.""];$date_f_joining=$_POST["txxtD".$gumo.""];
				if(isset($_POST["upload_pan".$gumo.""]) && $_POST["upload_pan".$gumo.""]!=""){
					$upload_pan=$_POST["upload_pan".$gumo.""];
				}else{
					$upload_pan="";
				}
				//Uploading Member Photo 
				if(isset($_POST["member-photo".$gumo]) && $_POST["member-photo".$gumo.""]!=""){
					$image_data=$_POST["member-photo".$gumo];
					$data = str_replace('data:image/png;base64,', '', $image_data);
					$data = str_replace(' ', '+', $data);
					$data = base64_decode($data);
					$member_photo_name=uniqid(rand()) . '.png';
					$file = 'upload/'.$member_photo_name;
					$success = file_put_contents($file, $data);				
					
				}else{
					$member_photo_name="";					
				}
				if(isset($_POST["member-sign".$gumo]) && $_POST["member-sign".$gumo.""]!=""){
					//Uploading Member Signature 
					$image_data2=$_POST["member-sign".$gumo];
					$data2 = str_replace('data:image/png;base64,', '', $image_data2);
					$data2 = str_replace(' ', '+', $data2);
					$data2 = base64_decode($data2);
					$member_sign_name=uniqid(rand()) . '.png';
					$file2 = 'upload/'.$member_sign_name;
					$success2 = file_put_contents($file2, $data2);
				}else{
					$member_sign_name="";
				}
					
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,member_name,member_address,date_f_joining,upload_photo,upload_signature,upload_pan) VALUES ('','$form_id','$gumo','$member_name','$member_address','$date_f_joining','$member_photo_name','$member_sign_name','$upload_pan')");
			}		
		}
		/* echo "<pre>";
		print_r($_POST);
		die(); */
		
	}
	if($query1){
		
		echo "<script>
				    alert('Successfully Saved.');
				    window.location.href ='".$table_name.".php?tab=3';
			    </script>";
	}else{
		
		echo "<script>
			alert('Something went wrong!!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}
if(isset($_POST['save1c'])){
	if(!empty($_POST["reg_deed"]))  $reg_deed=json_encode($_POST["reg_deed"]);
	else	$reg_deed=NULL;
	if(!empty($_POST["tax"]))  $tax=json_encode($_POST["tax"]);
	else	$tax=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		 echo "<script>
		   alert('Please fill up the first part of the form !!!');
		   window.location.href = '".$table_name.".php';
		</script>";				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', reg_deed='$reg_deed', tax='$tax' where form_id='$form_id'");
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

if(isset($_POST['save2a'])){
	$reg_uain=clean($_POST['reg_uain']);$date_f_alt=clean($_POST['date_f_alt']);$firm_name_alt=clean($_POST['firm_name_alt']);
	
	if(!empty($_POST["alteration_address"]))  $alteration_address=json_encode($_POST["alteration_address"]);
	else	$alteration_address=NULL;
	if(!empty($_POST["other_address"]))  $other_address=json_encode($_POST["other_address"]);
	else	$other_address=NULL;
	if(!empty($_POST["registration_deed"]))  $registration_deed=json_encode($_POST["registration_deed"]);
	else	$registration_deed=NULL;
	if(!empty($_POST["rectification_reg"]))  $rectification_reg=json_encode($_POST["rectification_reg"]);
	else	$rectification_reg=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,reg_uain,date_f_alt,firm_name_alt,alteration_address,other_address,registration_deed,rectification_reg) values ('$swr_id','$today','$reg_uain','$date_f_alt','$firm_name_alt', '$alteration_address', '$other_address', '$registration_deed', '$rectification_reg')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', reg_uain='$reg_uain',date_f_alt='$date_f_alt',firm_name_alt='$firm_name_alt', alteration_address='$alteration_address', other_address='$other_address', registration_deed='$registration_deed', rectification_reg='$rectification_reg' where form_id='$form_id'");			
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
if(isset($_POST["save2b"])){
	$hidden_value=clean($_POST["hiddenval1"]);
	if(!empty($_POST["tax"]))  $tax=json_encode($_POST["tax"]);
	else	$tax=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,tax) values ('$swr_id','$today','$tax')");					
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',tax='$tax' where form_id='$form_id'");			
	}	
		 if($hidden_value>0){
			$sql1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'") ;
			for($i=1; $i<$hidden_value; $i++){
				$member_name=$_POST["txxtB".$i.""];
				
				//Uploading Member Photo 
				if(isset($_POST["member-photo".$i]) && $_POST["member-photo".$i.""]!=""){
					$image_data=$_POST["member-photo".$i];
					$data = str_replace('data:image/png;base64,', '', $image_data);
					$data = str_replace(' ', '+', $data);
					$data = base64_decode($data);
					$member_photo_name=uniqid(rand()) . '.png';
					$file = 'upload/'.$member_photo_name;
					$success = file_put_contents($file, $data);				
					
				}else{
					$member_photo_name="";					
				}
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,member_name,upload_photo) VALUES ('','$form_id','$i','$member_name','$member_photo_name')");
			}		
		}

    if($query && $query1){
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

if(isset($_POST['save3a'])){
	$reg_uain=clean($_POST["reg_uain"]);
	if(!empty($_POST["closing_place"]))  $closing_place=json_encode($_POST["closing_place"]);
	else	$closing_place=NULL;
	if(!empty($_POST["opening_place"]))  $opening_place=json_encode($_POST["opening_place"]);
	else	$opening_place=NULL;
	if(!empty($_POST["registration_deed"]))  $registration_deed=json_encode($_POST["registration_deed"]);
	else	$registration_deed=NULL;
	if(!empty($_POST["rectification_reg"]))  $rectification_reg=json_encode($_POST["rectification_reg"]);
	else	$rectification_reg=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") ;
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,reg_uain,closing_place,opening_place,registration_deed,rectification_reg) values ('$swr_id','$today','$reg_uain','$closing_place','$opening_place', '$registration_deed', '$rectification_reg')") ;				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', reg_uain='$reg_uain', closing_place='$closing_place',opening_place='$opening_place', registration_deed='$registration_deed', rectification_reg='$rectification_reg' where form_id='$form_id'");			
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
if(isset($_POST["save3b"])){
	$hidden_value=clean($_POST["hiddenval1"]);
	if(!empty($_POST["tax"]))  $tax=json_encode($_POST["tax"]);
	else	$tax=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,tax) values ('$swr_id','$today','$tax')");					
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',tax='$tax' where form_id='$form_id'");			
	}	
		 if($hidden_value>0){
			$sql1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'") ;
			for($i=1; $i<$hidden_value; $i++){
				$member_name=$_POST["txxtB".$i.""];
				
				//Uploading Member Photo 
				if(isset($_POST["member-photo".$i]) && $_POST["member-photo".$i.""]!=""){
					$image_data=$_POST["member-photo".$i];
					$data = str_replace('data:image/png;base64,', '', $image_data);
					$data = str_replace(' ', '+', $data);
					$data = base64_decode($data);
					$member_photo_name=uniqid(rand()) . '.png';
					$file = 'upload/'.$member_photo_name;
					$success = file_put_contents($file, $data);				
					
				}else{
					$member_photo_name="";					
				}
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,member_name,upload_photo) VALUES ('','$form_id','$i','$member_name','$member_photo_name')") ;
			}		
		}

    if($query && $query1){
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
	$hidden_value=clean($_POST["hiddenval1"]);
	if(!empty($_POST["registration_deed"]))  $registration_deed=json_encode($_POST["registration_deed"]);
	else	$registration_deed=NULL;
	if(!empty($_POST["rectification_reg"]))  $rectification_reg=json_encode($_POST["rectification_reg"]);
	else	$rectification_reg=NULL;
	if(!empty($_POST["tax"]))  $tax=json_encode($_POST["tax"]);
	else	$tax=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") ;
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,registration_deed,rectification_reg,tax) values ('$swr_id','$today','$registration_deed','$rectification_reg','$tax')");					
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',registration_deed='$registration_deed', rectification_reg='$rectification_reg',tax='$tax' where form_id='$form_id'");			
	}
			
	   if($hidden_value>0){
			$sql1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1; $i<$hidden_value; $i++){
				$member_f_name=$_POST["txxtB".$i.""];$member_f_address=$_POST["txxtC".$i.""];$member_p_name=$_POST["txxtD".$i.""];$member_p_address=$_POST["txxtE".$i.""];$remarks=$_POST["txxtF".$i.""];
				
				//Uploading Member Photo 
				if(isset($_POST["member-photo".$i]) && $_POST["member-photo".$i.""]!=""){
					$image_data=$_POST["member-photo".$i];
					$data = str_replace('data:image/png;base64,', '', $image_data);
					$data = str_replace(' ', '+', $data);
					$data = base64_decode($data);
					$member_photo_name=uniqid(rand()) . '.png';
					$file = 'upload/'.$member_photo_name;
					$success = file_put_contents($file, $data);				
					
				}else{
					$member_photo_name="";					
				}
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,slno,member_f_name,member_f_address,member_p_name,member_p_address,remarks,upload_photo) VALUES ('','$form_id','$i','$member_f_name','$member_f_address','$member_p_name','$member_p_address',
				'$remarks','$member_photo_name')");
			}		
		}

		
    if($query && $query1){
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

if(isset($_POST['save5'])){
	if(!empty($_POST["registration_deed"]))  $registration_deed=json_encode($_POST["registration_deed"]);
	else	$registration_deed=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,registration_deed) values ('$swr_id','$today','$registration_deed')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',registration_deed='$registration_deed' where form_id='$form_id'") ;			
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

if(isset($_POST['save6'])){
	$fathers_name=clean($_POST["fathers_name"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);
	
	if(!empty($_POST["registration_deed"]))  $registration_deed=json_encode($_POST["registration_deed"]);
	else	$registration_deed=NULL;
	if(!empty($_POST["rectification_reg"]))  $rectification_reg=json_encode($_POST["rectification_reg"]);
	else	$rectification_reg=NULL;
	if(!empty($_POST["tax"]))  $tax=json_encode($_POST["tax"]);
	else	$tax=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fathers_name,post_office,police_station,registration_deed,rectification_reg,tax) values ('$swr_id','$today','$fathers_name','$post_office','$police_station','$registration_deed','$rectification_reg', '$tax')") ;				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',fathers_name='$fathers_name',post_office='$post_office',police_station='$police_station',registration_deed='$registration_deed', rectification_reg='$rectification_reg', tax='$tax' where form_id='$form_id'");			
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

if(isset($_POST["save7a"])){
	$soc_reg_no=clean($_POST['soc_reg_no']);$date_of_registration=clean($_POST["date_of_registration"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);
	
	if(!empty($_POST["society"]))  $society=json_encode($_POST["society"]);
	else	$society=NULL;
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,soc_reg_no,date_of_registration,post_office,police_station,society) values ('$swr_id','$today','$soc_reg_no','$date_of_registration','$post_office','$police_station','$society')");	
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',soc_reg_no='$soc_reg_no', date_of_registration='$date_of_registration',post_office='$post_office',police_station='$police_station',society='$society' where form_id='$form_id'");
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
if(isset($_POST["save7b"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$date_of_estab=clean($_POST["date_of_estab"]);$operation_area=clean($_POST["operation_area"]);
	if(!empty($_POST["objects"]))  $objects=json_encode($_POST["objects"]);
	else	$objects=NULL;
	if(!empty($_POST["objects_of_society"]))  $objects_of_society=json_encode($_POST["objects_of_society"]);
	else	$objects_of_society=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		 echo "<script>
		   alert('Please fill up the first part of the form !!!');
		   window.location.href = '".$table_name.".php';
		</script>";		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today' where form_id='$form_id'");		
		$sql1=$formFunctions->executeQuery($dept,"select form_id from ".$table_name."_members where form_id='$form_id'");
		if($sql1->num_rows>0){
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',objects='$objects',date_of_estab='$date_of_estab',operation_area='$operation_area',objects_of_society='$objects_of_society' where form_id='$form_id'");
			$form_id=$query;
			
		}else{
			$form_id=$row["form_id"];
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',objects='$objects',date_of_estab='$date_of_estab',operation_area='$operation_area',objects_of_society='$objects_of_society' where form_id='$form_id'");	
			$form_id=$row["form_id"];
			
		}		
	}
	if($query){
		if($input_size1!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];	
					
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,signature,address,occupation,designation) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from rfs_form".$form."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$valaa=$_POST["txtA".$i];	*/		
				$valbb=$_POST["txxtB".$i];
				$valcc=$_POST["txxtC".$i];
				$valdd=$_POST["txxtD".$i];
				$valee=$_POST["txxtE".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO rfs_form".$form."_t2(form_id,sl_no,member_name,member_address,member_occupation,member_designation) VALUES ('$form_id','$i','$valbb','$valcc','$valdd','$valee')");
			}
		}
		
	  if(isset($part1) && $part1==false && isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";	
		}
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}				
}
if(isset($_POST["save7c"])){
	$proced=clean($_POST["proced"]);$quorum=clean($_POST["quorum"]);$election=clean($_POST["election"]);$short_desc=clean($_POST["short_desc"]);$term=clean($_POST["term"]);$re_election=clean($_POST["re_election"]);$procedure_f_meet=clean($_POST["procedure_f_meet"]);$quorum_f_meet=clean($_POST["quorum_f_meet"]);$expulsion=clean($_POST["expulsion"]);$auditor=clean($_POST["auditor"]);$legal_procedure=clean($_POST["legal_procedure"]);$dissolution=clean($_POST["dissolution"]);
	
	if(!empty($_POST["members"]))  $members=json_encode($_POST["members"]);
	else	$members=NULL;
	if(!empty($_POST["general_meeting"]))  $general_meeting=json_encode($_POST["general_meeting"]);
	else	$general_meeting=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,members,proced,quorum,election,short_desc,term,re_election,procedure_f_meet,quorum_f_meet,expulsion,auditor,legal_procedure,dissolution,general_meeting) values ('$swr_id','$today','$members','$proced','$quorum','$election','$short_desc','$term','$re_election','$procedure_f_meet','$quorum_f_meet','$expulsion','$auditor','$legal_procedure','$dissolution','$general_meeting')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',members='$members',proced='$proced',quorum='$quorum',election='$election',short_desc='$short_desc',term='$term',re_election='$re_election', procedure_f_meet='$procedure_f_meet', quorum_f_meet='$quorum_f_meet', expulsion='$expulsion',auditor='$auditor',legal_procedure='$legal_procedure',dissolution='$dissolution',general_meeting='$general_meeting' where form_id='$form_id'");
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

if(isset($_POST['save8'])){
	$date_of_registration=clean($_POST["date_of_registration"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);
	if(!empty($_POST["society"]))  $society=json_encode($_POST["society"]);
	else	$society=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") ;
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_of_registration,post_office,police_station,society) values ('$swr_id','$today','$date_of_registration','$post_office','$police_station','$society')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_of_registration='$date_of_registration',post_office='$post_office',police_station='$police_station', society='$society' where form_id='$form_id'");			
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

if(isset($_POST['save9'])){
	$date_of_registration=clean($_POST["date_of_registration"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_of_registration,post_office,police_station) values ('$swr_id','$today','$date_of_registration','$post_office','$police_station')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_of_registration='$date_of_registration',post_office='$post_office',police_station='$police_station' where form_id='$form_id'");			
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

if(isset($_POST['save10'])){
	$date_of_registration=clean($_POST["date_of_registration"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);$proposed_society=clean($_POST["proposed_society"]);
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_of_registration,post_office,police_station,proposed_society) values ('$swr_id','$today','$date_of_registration','$post_office','$police_station','$proposed_society')");		
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_of_registration='$date_of_registration',post_office='$post_office',police_station='$police_station', proposed_society='$proposed_society' where form_id='$form_id'");			
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

if(isset($_POST['save11'])){
	$date_of_registration=clean($_POST["date_of_registration"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_of_registration,post_office,police_station) values ('$swr_id','$today','$date_of_registration','$post_office','$police_station')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_of_registration='$date_of_registration',post_office='$post_office',police_station='$police_station' where form_id='$form_id'");			
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

if(isset($_POST["save12"])){
	$input_size2=clean($_POST["hiddenval1"]);$date_of_registration=clean($_POST["date_of_registration"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);
		
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_of_registration,post_office,police_station) values ('$swr_id','$today','$date_of_registration','$post_office','$police_station')");	
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_of_registration='$date_of_registration',post_office='$post_office',police_station='$police_station' where form_id='$form_id'");
	}
   if($query){
	    $formFunctions->insert_incomplete_forms($dept,$form); 
	if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from rfs_form".$form."_members where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$valaa=$_POST["txtA".$i];	*/		
				$valbb=$_POST["txxtB".$i];
				$valcc=$_POST["txxtC".$i];
				$valdd=$_POST["txxtD".$i];
				$valee=$_POST["txxtE".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO rfs_form".$form."_members(form_id,sl_no,member_name,member_address,member_occupation,member_designation) VALUES ('$form_id','$i','$valbb','$valcc','$valdd','$valee')");
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

if(isset($_POST["save13"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$soc_reg_no=clean($_POST["soc_reg_no"]);
	$date_of_registration=clean($_POST["date_of_registration"]);$meeting_date=clean($_POST["meeting_date"]);
	if($date_of_registration!="00-00-0000" && $date_of_registration!=""){
		$date_of_registration=date('Y-m-d',strtotime($date_of_registration));
	}else{
		 $date_of_registration="";
	}
	if($meeting_date!="00-00-0000" && $meeting_date!=""){
		$meeting_date=date('Y-m-d',strtotime($meeting_date));
	}else{
		 $meeting_date="";
	}
	$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);$photo_president=clean($_POST["photo_president"]);$photo_secretary=clean($_POST["photo_secretary"]);
	//die($photo_president."asd".$photo_secretary);photo_secretary photo_president
	
	if(!empty($_POST["bank_detail"]))  $bank_detail=json_encode($_POST["bank_detail"]);
	else	$bank_detail=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_of_registration,post_office,police_station,bank_detail,photo_president,photo_secretary,soc_reg_no,meeting_date) values ('$swr_id','$today','$date_of_registration','$post_office','$police_station','$bank_detail','$photo_president','$photo_secretary','$soc_reg_no','$meeting_date')");	
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_of_registration='$date_of_registration',post_office='$post_office',police_station='$police_station',bank_detail='$bank_detail',photo_president='$photo_president', photo_secretary='$photo_secretary', soc_reg_no='$soc_reg_no', meeting_date='$meeting_date' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];	
				$valf=$_POST["txtF".$i];	
				$valg=$_POST["txtG".$i];	
				$valh=$_POST["txtH".$i];	
				$vali=$_POST["txtI".$i];	
				$valj=$_POST["txtJ".$i];	
				$valk=$_POST["txtK".$i];	
				$vall=$_POST["txtL".$i];	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,letter_no,letter_date,scheme_name,obj_of_scheme,fund_release,opening_balance,amount_sanc,amount_release,total_fund,total_exp,remarks) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj','$valk','$vall')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from rfs_form".$form."_members where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$valaa=$_POST["txtA".$i];	*/		
				$valbb=$_POST["txxtB".$i];
				$valcc=$_POST["txxtC".$i];
				$valdd=$_POST["txxtD".$i];
				$valee=$_POST["txxtE".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO rfs_form".$form."_members(form_id,sl_no,member_name,member_address,member_occupation,member_designation) VALUES ('$form_id','$i','$valbb','$valcc','$valdd','$valee')");
			}
		}
		if(isset($part1) && $part1==false && isset($part2) && $part2==false){
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";	
		}
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		   </script>";
	}				
}

if(isset($_POST["save15"])){
	$input_size2=clean($_POST["hiddenval2"]);$input_size1=clean($_POST["hiddenval"]);
	$specimen=clean($_POST["specimen"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);$photo_president=clean($_POST["photo_president"]);$photo_secretary=clean($_POST["photo_secretary"]);$date_general_meeting=clean($_POST["date_general_meeting"]);
	if($date_general_meeting!="00-00-0000" && $date_general_meeting!=""){
		$date_general_meeting=date('Y-m-d',strtotime($date_general_meeting));
	}else{
		 $date_general_meeting="";
	}
	//die($photo_president."asd".$photo_secretary);photo_secretary photo_president
	
	if(!empty($_POST["bank_detail"]))  $bank_detail=json_encode($_POST["bank_detail"]);
	else	$bank_detail=NULL;
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,specimen,post_office,police_station,bank_detail,photo_president,photo_secretary,date_general_meeting) values ('$swr_id','$today','$specimen','$post_office','$police_station','$bank_detail','$photo_president','$photo_secretary','date_general_meeting')");	
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',specimen='$specimen',post_office='$post_office',police_station='$police_station',bank_detail='$bank_detail',photo_president='$photo_president', photo_secretary='$photo_secretary', date_general_meeting='$date_general_meeting' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //rfs -- dept name and 12 -- form no
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size1;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$vale=$_POST["txtE".$i];	
					$valf=$_POST["txtF".$i];	
					$valg=$_POST["txtG".$i];	
					$valh=$_POST["txtH".$i];	
					$vali=$_POST["txtI".$i];	
					$valj=$_POST["txtJ".$i];	
					$valk=$_POST["txtK".$i];	
					$vall=$_POST["txtL".$i];	
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,letter_no,letter_date,scheme_name,obj_of_scheme,fund_release,opening_balance,amount_sanc,amount_release,total_fund,total_exp,remarks) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj','$valk','$vall')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from rfs_form".$form."_members where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$valaa=$_POST["txtA".$i];	*/		
				$valbb=$_POST["txxtB".$i];
				$valcc=$_POST["txxtC".$i];
				$valdd=$_POST["txxtD".$i];
				$valee=$_POST["txxtE".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO rfs_form".$form."_members(form_id,sl_no,member_name,member_address,member_occupation,member_designation) VALUES ('$form_id','$i','$valbb','$valcc','$valdd','$valee')");
			}
		}
		if(isset($part1) && $part1==false && isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";	
		}
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		   </script>";
	}				
}



?>