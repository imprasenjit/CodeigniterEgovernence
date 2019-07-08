<?php
if(isset($_POST["save18"])){
	$product=clean($_POST["product"]);$add_info=clean($_POST["add_info"]);$local_agency=clean($_POST["local_agency"]);
					
	if(!empty($_POST["nodal_off"])) $nodal_off=json_encode($_POST["nodal_off"]);
	else $nodal_off=NULL;
	if(!empty($_POST["auth_req"]))	 $auth_req=json_encode($_POST["auth_req"]);
	else	$auth_req=NULL;
	if(!empty($_POST["quantity"]))	 $quantity=json_encode($_POST["quantity"]);
	else	$quantity=NULL;
	if(!empty($_POST["measure"]))	 $measure=json_encode($_POST["measure"]);
	else	$measure=NULL;
	if(!empty($_POST["disposal"]))	 $disposal=json_encode($_POST["disposal"]);
	else	$disposal=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	if($sql->num_rows<1){   ////////////table is empty//////////////				
       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,local_agency,product,add_info,nodal_off,auth_req,quantity,measure,disposal) values ('$swr_id','$today', '$local_agency','$product','$add_info', '$nodal_off', '$auth_req', '$quantity', '$measure', '$disposal')");
	   $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$sql->fetch_object()->form_id;
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',local_agency='$local_agency',product='$product',add_info='$add_info', nodal_off='$nodal_off', auth_req='$auth_req', quantity='$quantity', measure='$measure', disposal='$disposal' where user_id='$swr_id' and form_id='$form_id'");		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //pcb-- dept name and 18 -- form no
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

if(isset($_POST["save19"])) {
	$seq_of_events=clean($_POST["seq_of_events"]);$accident_waste=clean($_POST["accident_waste"]);$effects_of_accidents=clean($_POST["effects_of_accidents"]);$measures_taken=clean($_POST["measures_taken"]);$steps_taken_all=clean($_POST["steps_taken_all"]);$steps_taken_prevent=clean($_POST["steps_taken_prevent"]);

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,seq_of_events,accident_waste,effects_of_accidents,measures_taken,steps_taken_all,steps_taken_prevent) values ('$swr_id','$today', '$seq_of_events', '$accident_waste', '$effects_of_accidents', '$measures_taken', '$steps_taken_all', '$steps_taken_prevent')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',save_mode='D', seq_of_events='$seq_of_events',accident_waste='$accident_waste',effects_of_accidents='$effects_of_accidents',measures_taken='$measures_taken',steps_taken_all='$steps_taken_all',steps_taken_prevent='$steps_taken_prevent' where user_id='$swr_id' and form_id='$form_id'");		
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

?>