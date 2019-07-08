<?php

if(isset($_POST['save16'])){
	$firm_duration=clean($_POST['firm_duration']);$business_details=clean($_POST['business_details']);$regn_no=clean($_POST["regn_no"]);$is_different=clean($_POST["is_different"]);$nature_busi=clean($_POST["nature_busi"]);
	$hidden_value=$_POST["hiddenval1"];
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,firm_duration,nature_busi,business_details,regn_no,is_different) values ('$swr_id','$today','$firm_duration','$nature_busi','$business_details','$regn_no','$is_different')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',firm_duration='$firm_duration',nature_busi='$nature_busi',regn_no='$regn_no',business_details='$business_details',is_different='$is_different' where form_id='$form_id'");
	}
	
   if($query or $query1){
	$formFunctions->insert_incomplete_forms($dept,$form); 
    if($hidden_value>0){
            $form_id=$row["form_id"];
			$sql1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'") ;
			for($i=1; $i<$hidden_value; $i++){
				$member_name=$_POST["txxtB".$i.""];$member_address=$_POST["txxtC".$i.""];$member_name1=$_POST["txxtD".$i.""];$member_address1=$_POST["txxtE".$i.""];
				if(isset($_POST["upload_pan".$i.""]) && $_POST["upload_pan".$i.""]!=""){
					$upload_pan=$_POST["upload_pan".$i.""];
				}else{
					$upload_pan="";
				}
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
				if(isset($_POST["member-sign".$i]) && $_POST["member-sign".$i.""]!=""){
					//Uploading Member Signature 
					$image_data2=$_POST["member-sign".$i];
					$data2 = str_replace('data:image/png;base64,', '', $image_data2);
					$data2 = str_replace(' ', '+', $data2);
					$data2 = base64_decode($data2);
					$member_sign_name=uniqid(rand()) . '.png';
					$file2 = 'upload/'.$member_sign_name;
					$success2 = file_put_contents($file2, $data2);
				}else{
					$member_sign_name="";
				}
					
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,member_name,member_address,member_name1,member_address1,upload_photo,upload_signature,upload_pan) VALUES ('','$form_id','$i','$member_name','$member_address','$member_name1','$member_address1','$member_photo_name','$member_sign_name','$upload_pan')") ;
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


if(isset($_POST['save17'])){
	
	$firm_duration=clean($_POST['firm_duration']);$business_details=clean($_POST['business_details']);$regn_no=clean($_POST["regn_no"]);$is_different=clean($_POST["is_different"]);$nature_busi=clean($_POST["nature_busi"]);
	
	$hidden_value=$_POST["hiddenval1"];$input_size2=$_POST["hiddenval2"];
	
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,firm_duration,nature_busi,business_details,regn_no,is_different) values ('$swr_id','$today','$firm_duration','$nature_busi','$business_details','$regn_no','$is_different')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',firm_duration='$firm_duration',nature_busi='$nature_busi',business_details='$business_details',regn_no='$regn_no',is_different='$is_different' where form_id='$form_id'");
	}
	
   if($query or $query1){
	$formFunctions->insert_incomplete_forms($dept,$form); 
    if($hidden_value>0){
			$sql1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1; $i<$hidden_value; $i++){
				$member_name=$_POST["txxtB".$i.""];$member_address=$_POST["txxtC".$i.""];$date_of_joining=$_POST["txxtD".$i.""];
				
				if(isset($_POST["upload_pan".$i.""]) && $_POST["upload_pan".$i.""]!=""){
					$upload_pan=$_POST["upload_pan".$i.""];
				}else{
					$upload_pan="";
				}
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
				if(isset($_POST["member-sign".$i]) && $_POST["member-sign".$i.""]!=""){
					//Uploading Member Signature 
					$image_data2=$_POST["member-sign".$i];
					$data2 = str_replace('data:image/png;base64,', '', $image_data2);
					$data2 = str_replace(' ', '+', $data2);
					$data2 = base64_decode($data2);
					$member_sign_name=uniqid(rand()) . '.png';
					$file2 = 'upload/'.$member_sign_name;
					$success2 = file_put_contents($file2, $data2);
				}else{
					$member_sign_name="";
				}
					
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,member_name,member_address,date_of_joining,upload_photo,upload_signature,upload_pan) VALUES ('','$form_id','$i','$member_name','$member_address','$date_of_joining','$member_photo_name','$member_sign_name','$upload_pan')");
			}		
		}

	    if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$valaa=$_POST["txtA".$i];	*/		
				$valbb=$_POST["txtB".$i];
				$valcc=$_POST["txtC".$i];
				$valdd=$_POST["txtD".$i];
				$valee=$_POST["txtE".$i];
				$valff=$_POST["txtF".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,sl_no,date_alteration,former_name,present_name,former_address,present_address) VALUES ('$form_id','$i','$valbb','$valcc','$valdd','$valee','$valff')");
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

if(isset($_POST["save19"])){
	$input_size2=clean($_POST["hiddenval2"]);$input_size1=clean($_POST["hiddenval"]);
	
	$regn_no=clean($_POST["regn_no"]);$date_registration=clean($_POST["date_registration"]);
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,regn_no,date_registration) values ('$swr_id','$today','$regn_no','$date_registration')");	
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',regn_no='$regn_no',date_registration='$date_registration' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //rfs -- dept name and 12 -- form no
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size1;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,old_address,address_socity) VALUES ('$form_id','$i','$valb','$valc')");
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
