<?php 
if(isset($_POST["save"])){
	$required_power=clean($_POST["required_power"]);$service_requested=clean($_POST["service_requested"]);$consumer_category=clean($_POST["consumer_category"]);$mouza_no=clean($_POST["mouza_no"]);$dag_no=clean($_POST["dag_no"]);
	$exist_con_no=clean($_POST["exist_con_no"]);
	$extract_exist_con_no=substr($exist_con_no, 0, 3);
	$results=$formFunctions->executeQuery($dept,"SELECT * FROM nearest_cons_esd WHERE cons_no='$extract_exist_con_no'");
	if($results->num_rows == 0){ 
		$esd="";
	}else{
		$esd=$results->fetch_object()->consumer_loc; 
	} 
	if(!empty($_POST["billing"]))	 $billing=json_encode($_POST["billing"]);
	else	$billing=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,save_mode,sub_date,required_power,consumer_category,service_requested,exist_con_no,esd,billing,mouza_no,dag_no) values ('$swr_id','D','$today', '$required_power','$consumer_category', '$service_requested', '$exist_con_no','$esd', '$billing','$mouza_no','$dag_no')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', required_power='$required_power',consumer_category='$consumer_category', service_requested='$service_requested', exist_con_no='$exist_con_no',esd='$esd', billing='$billing', mouza_no='$mouza_no', dag_no='$dag_no' where form_id='$form_id'");	
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
?>