<?php
  
	
	$dept="fire";
	$form=$formFunctions->get_uainForm($uain);
	$form_name=$formFunctions->get_formName($dept,$form);
	
	/************************************* TRACK APPLICATION **************************************/
	$table=$formFunctions->getTableName($dept,$form);
	
 $file=$fire->query("select * from ".$table."_certificate where user_id='$swr_id'");
	$file_path=$file->fetch_array();
	echo $noc=$file_path['file_path'];
?>
