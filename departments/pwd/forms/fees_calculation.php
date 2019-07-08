<?php 
$reg_fees=0;
if($form==2){
	$category_class_query="select category_class from ".$table_name." where user_id='$swr_id' and active='1'";
	$category_class_results=$formFunctions->executeQuery($dept,$category_class_query);
	if($category_class_results->num_rows>0){
		$category_class=$category_class_results->fetch_object()->category_class;
	}else{
		$category_class="A";
	}
	if($category_class=="A"){
		$reg_fees=15000;
	}else if($category_class=="B"){
		$reg_fees=10000;
	}else{
		$reg_fees=5000;
	}
}else if($form==3){
	$reg_fees=2000;
}else if($form==4){
	$reg_fees=500;
}else{
	
}


?>