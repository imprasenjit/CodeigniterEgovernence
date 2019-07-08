<?php
if(isset($_POST["save1a"])){
		$reg_no=clean($_POST["reg_no"]);$patient_age=clean($_POST["patient_age"]);$fathers_name=clean($_POST["fathers_name"]);$doc_full_name=clean($_POST["doc_full_name"]);$ref_reg_no=clean($_POST["ref_reg_no"]);
		$last_menstrual_details=clean($_POST["last_menstrual_details"]);$prev_child_with=clean($_POST["prev_child_with"]);$maternal_age=clean($_POST["maternal_age"]);$genetic_disease=clean($_POST["genetic_disease"]);$other_indication=clean($_POST["other_indication"]);
		
		if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
			else	$address=NULL;
		if(!empty($_POST["history"]))	 $history=json_encode($_POST["history"]);
			else	$history=NULL;
		if(!empty($_POST["indication"]))	 $indication=json_encode($_POST["indication"]);
			else	$indication=NULL;
		
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,reg_no,patient_age,fathers_name,doc_full_name,ref_reg_no,address,last_menstrual_details,history,prev_child_with,indication,maternal_age,genetic_disease,other_indication) values ('$swr_id','$today','$reg_no', '$patient_age', '$fathers_name', '$doc_full_name', '$ref_reg_no', '$address', '$last_menstrual_details', '$history', '$prev_child_with', '$indication', '$maternal_age', '$genetic_disease', '$other_indication')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', reg_no='$reg_no', patient_age='$patient_age',  fathers_name='$fathers_name',doc_full_name='$doc_full_name', ref_reg_no='$ref_reg_no', address='$address', last_menstrual_details='$last_menstrual_details', history='$history', prev_child_with='$prev_child_with', indication='$indication', maternal_age='$maternal_age', genetic_disease='$genetic_disease', other_indication='$other_indication' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //pcpndt-- dept name and 1 -- form no 
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
if(isset($_POST["submit1"])){
		$is_result_details=clean($_POST["is_result_details"]);$is_result=clean($_POST["is_result"]);$is_MTP_advised=clean($_POST["is_MTP_advised"]);$commencement_date=clean($_POST["commencement_date"]);$completion_date=clean($_POST["completion_date"]);
		$commencement_date=date("Y-m-d",strtotime($commencement_date));
		$completion_date=date("Y-m-d",strtotime($completion_date));
		
		if(!empty($_POST["procedure_advised"]))	 $procedure_advised=json_encode($_POST["procedure_advised"]);
			else	$procedure_advised=NULL;
		if(!empty($_POST["lab_tests"]))	 $lab_tests=json_encode($_POST["lab_tests"]);
			else	$lab_tests=NULL;
		if(!empty($_POST["referred_address"]))	 $referred_address=json_encode($_POST["referred_address"]);
			else	$referred_address=NULL;
		
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,procedure_advised,lab_tests,is_result_details,is_result,is_MTP_advised,referred_address,commencement_date,completion_date) values ('$swr_id','$today', '$procedure_advised', '$lab_tests', '$is_result_details', '$is_result', '$is_MTP_advised', '$referred_address', '$commencement_date', '$completion_date')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', procedure_advised='$procedure_advised', lab_tests='$lab_tests', is_result_details='$is_result_details', is_result='$is_result', is_MTP_advised='$is_MTP_advised', referred_address='$referred_address', commencement_date='$commencement_date', completion_date='$completion_date' where form_id=$form_id");		
	}				
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}			
}
if(isset($_POST["save2"])){
	$input_size1=clean($_POST["hiddenval"]);$fees_description=clean($_POST["fees_description"]);
	$facilities_avail=clean($_POST["facilities_avail"]);$state_details=clean($_POST["state_details"]);
	
	if(!empty($_POST["facility_type"]))	 $facility_type=json_encode($_POST["facility_type"]);
	else	$facility_type=NULL;
	if(!empty($_POST["type_of"]))	 $type_of=json_encode($_POST["type_of"]);
	else	$type_of=NULL;
	if(!empty($_POST["specific_invasive"]))	 $specific_invasive=json_encode($_POST["specific_invasive"]);
	else	$specific_invasive=NULL;
	if(!empty($_POST["specific_non_invasive"]))	 $specific_non_invasive=json_encode($_POST["specific_non_invasive"]);
	else	$specific_non_invasive=NULL;
	if(!empty($_POST["test_facility"]))	 $test_facility=json_encode($_POST["test_facility"]);
	else	$test_facility=NULL;
	if(!empty($_POST["lab_facility"]))	 $lab_facility=json_encode($_POST["lab_facility"]);
	else	$lab_facility=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////	
		$sql_query="insert into ".$table_name."(user_id,sub_date,facility_type,fees_description,type_of,specific_invasive,specific_non_invasive,facilities_avail,test_facility,lab_facility,state_details) values ('$swr_id','$today','$facility_type','$fees_description','$type_of','$specific_invasive','$specific_non_invasive','$facilities_avail','$test_facility','$lab_facility','$state_details')";
		$query=$formFunctions->executeQuery($dept,$sql_query);
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', facility_type='$facility_type', fees_description='$fees_description', type_of='$type_of', specific_invasive='$specific_invasive',specific_non_invasive='$specific_non_invasive',facilities_avail='$facilities_avail',test_facility='$test_facility',lab_facility='$lab_facility',state_details='$state_details' where form_id=$form_id");
	}		
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //pcpndt-- dept name and 2 -- form no 
		if($input_size1!=0){
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,address,contact_no) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
				
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save3"])){
	$input_size1=clean($_POST["hiddenval"]);$fees_description=clean($_POST["fees_description"]);
	$facilities_avail=clean($_POST["facilities_avail"]);$state_details=clean($_POST["state_details"]);$reg_no=clean($_POST["reg_no"]);
	
	if(!empty($_POST["facility_type"]))	 $facility_type=json_encode($_POST["facility_type"]);
	else	$facility_type=NULL;
	if(!empty($_POST["type_of"]))	 $type_of=json_encode($_POST["type_of"]);
	else	$type_of=NULL;
	if(!empty($_POST["specific_invasive"]))	 $specific_invasive=json_encode($_POST["specific_invasive"]);
	else	$specific_invasive=NULL;
	if(!empty($_POST["specific_non_invasive"]))	 $specific_non_invasive=json_encode($_POST["specific_non_invasive"]);
	else	$specific_non_invasive=NULL;
	if(!empty($_POST["test_facility"]))	 $test_facility=json_encode($_POST["test_facility"]);
	else	$test_facility=NULL;
	if(!empty($_POST["lab_facility"]))	 $lab_facility=json_encode($_POST["lab_facility"]);
	else	$lab_facility=NULL;
	
	if(!empty($_POST["reg_date"])) $reg_date=json_encode($_POST["reg_date"]);else $reg_date=NULL;
	//$reg_date=date("Y-m-d",strtotime($reg_date));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////	
		$sql_query="insert into ".$table_name."(user_id,sub_date,facility_type,fees_description,type_of,specific_invasive,specific_non_invasive,facilities_avail,test_facility,lab_facility,state_details,reg_no,reg_date) values ('$swr_id','$today','$facility_type','$fees_description','$type_of','$specific_invasive','$specific_non_invasive','$facilities_avail','$test_facility','$lab_facility','$state_details','$reg_no','$reg_date')";
		$query=$formFunctions->executeQuery($dept,$sql_query);
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', facility_type='$facility_type', fees_description='$fees_description', type_of='$type_of', specific_invasive='$specific_invasive',specific_non_invasive='$specific_non_invasive',facilities_avail='$facilities_avail',test_facility='$test_facility',lab_facility='$lab_facility',state_details='$state_details',reg_no='$reg_no',reg_date='$reg_date' where form_id=$form_id");		
	}		
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //pcpndt-- dept name and 3 -- form no 
		if($input_size1!=0){
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,address,contact_no) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
				
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
?>