<?php
if(isset($_POST["save1"])){
	if(!empty($_POST["mailing_address"]))	 $mailing_address=json_encode($_POST["mailing_address"]);
	else	$mailing_address=NULL;
	$constitution=clean($_POST["constitution"]);$objectives=clean($_POST["objectives"]);
	if(!empty($_POST["reg"]))	 $reg=json_encode($_POST["reg"]);
	else	$reg=NULL;
	if(!empty($_POST["permission"]))	 $permission=json_encode($_POST["permission"]);
	else	$permission=NULL;
	if(!empty($_POST["affliation"]))	 $affliation=json_encode($_POST["affliation"]);
	else	$affliation=NULL;
	if(!empty($_POST["banker"]))	 $banker=json_encode($_POST["banker"]);
	else	$banker=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,mailing_address,constitution,objectives,reg,banker,affliation,permission) values ('$swr_id','$today','$mailing_address', '$constitution', '$objectives', '$reg', '$banker',  '$affliation', '$permission')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', mailing_address='$mailing_address', constitution='$constitution',  objectives='$objectives',reg='$reg', banker='$banker',  affliation='$affliation', permission='$permission' where form_id=$form_id");		
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
	if(!empty($_POST["mailing_address"]))	 $mailing_address=json_encode($_POST["mailing_address"]);
	else	$mailing_address=NULL;
	$constitution=clean($_POST["constitution"]);$objectives=clean($_POST["objectives"]);
	if(!empty($_POST["reg"]))	 $reg=json_encode($_POST["reg"]);
	else	$reg=NULL;
	if(!empty($_POST["permission"]))	 $permission=json_encode($_POST["permission"]);
	else	$permission=NULL;
	if(!empty($_POST["affliation"]))	 $affliation=json_encode($_POST["affliation"]);
	else	$affliation=NULL;
	if(!empty($_POST["banker"]))	 $banker=json_encode($_POST["banker"]);
	else	$banker=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,mailing_address,constitution,objectives,reg,banker,affliation,permission) values ('$swr_id','$today','$mailing_address', '$constitution', '$objectives', '$reg', '$banker',  '$affliation', '$permission')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', mailing_address='$mailing_address', constitution='$constitution',  objectives='$objectives',reg='$reg', banker='$banker',  affliation='$affliation', permission='$permission' where form_id=$form_id");		
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

if(isset($_POST["save3"])){
	if(!empty($_POST["mailing_address"]))	 $mailing_address=json_encode($_POST["mailing_address"]);
	else	$mailing_address=NULL;
	$constitution=clean($_POST["constitution"]);$objectives=clean($_POST["objectives"]);
	if(!empty($_POST["reg"]))	 $reg=json_encode($_POST["reg"]);
	else	$reg=NULL;
	if(!empty($_POST["permission"]))	 $permission=json_encode($_POST["permission"]);
	else	$permission=NULL;
	if(!empty($_POST["affliation"]))	 $affliation=json_encode($_POST["affliation"]);
	else	$affliation=NULL;
	if(!empty($_POST["banker"]))	 $banker=json_encode($_POST["banker"]);
	else	$banker=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,mailing_address,constitution,objectives,reg,banker,affliation,permission) values ('$swr_id','$today','$mailing_address', '$constitution', '$objectives', '$reg', '$banker',  '$affliation', '$permission')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', mailing_address='$mailing_address', constitution='$constitution',  objectives='$objectives',reg='$reg', banker='$banker',  affliation='$affliation', permission='$permission' where form_id=$form_id");		
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

?>