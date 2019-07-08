<?php
if(isset($_POST["save1"])){
	$s_po=clean($_POST["s_po"]);$s_ps=$_POST["s_ps"];$s_con=clean($_POST["s_con"]);$proposed_area=clean($_POST["proposed_area"]);$s_obj=clean($_POST["s_obj"]);
	$hidden_value=11;	
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,s_po,s_ps,s_con,proposed_area,s_obj) values ('$swr_id','$today', '$s_po','$s_ps','$s_con','$proposed_area','$s_obj')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', s_po='$s_po',s_ps='$s_ps',s_con='$s_con',proposed_area='$proposed_area',s_obj='$s_obj' where user_id='$swr_id' and form_id=$form_id");
	}
	
	if($query or $query1){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($hidden_value>0){
			$sql1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1; $i<$hidden_value; $i++){
				$member_name=$_POST["txxtB".$i.""];$member_address=$_POST["txxtC".$i.""];$member_age=$_POST["txxtD".$i.""];$member_phone=$_POST["txxtE".$i.""];
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
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,member_name,member_address,member_age,member_phone,upload_signature) VALUES ('','$form_id','$i','$member_name','$member_address','$member_age','$member_phone','$member_sign_name')") ;
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
	$s_po=clean($_POST["s_po"]);$s_ps=$_POST["s_ps"];$s_con=clean($_POST["s_con"]);$operation_area=clean($_POST["operation_area"]);$s_obj=clean($_POST["s_obj"]);$language=clean($_POST["language"]);$admn_fee=clean($_POST["admn_fee"]);$share_value=clean($_POST["share_value"]);
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,s_po,s_ps,s_con,operation_area,s_obj,language,admn_fee,share_value) values ('$swr_id','$today', '$s_po','$s_ps','$s_con','$operation_area','$s_obj','$language','$admn_fee','$share_value')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',s_po='$s_po',s_ps='$s_ps',s_con='$s_con',operation_area='$operation_area',s_obj='$s_obj',language='$language',admn_fee='$admn_fee',share_value='$share_value' where user_id='$swr_id' and form_id=$form_id");			
	}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?';
		</script>";
	}	
}
if(isset($_POST["save2b"])){
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){
		echo "<script>
			alert('Please fill up the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$hidden_value=11;
		if($hidden_value>0){
			$sql1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'") ;
			for($i=1; $i<$hidden_value; $i++){
				$member_name=$_POST["txxtB".$i.""];$member_fname=$_POST["txxtC".$i.""];$member_age=$_POST["txxtD".$i.""];$member_address=$_POST["txxtE".$i.""];$member_occupation=$_POST["txxtF".$i.""];$member_partition=$_POST["txxtG".$i.""];
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
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,member_name,member_fname,member_address,member_age,member_occupation,member_partition,upload_signature) VALUES ('','$form_id','$i','$member_name','$member_fname','$member_address','$member_age','$member_occupation','$member_partition','$member_sign_name')") ;
			}		
		}	
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

if(isset($_POST["save2c"])){
	echo "<script>
		alert('Successfully saved.');
		window.location.href = '".$table_name.".php?tab=4';
	</script>";	
}
if(isset($_POST["save2d"])){
	echo "<script>
		alert('Successfully saved.');
		window.location.href = '".$table_name.".php?tab=5';
	</script>";	
}
if(isset($_POST["save2e"])){
	echo "<script>
		alert('Successfully Saved..');
		window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
	</script>";	
}
?>