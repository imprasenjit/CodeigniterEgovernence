<?php
if(isset($_POST["save1a"])){		
	$fat_name=$_POST["fat_name"];$documents=$_POST["documents"];$occu_pro=$_POST["occu_pro"];
	if(!empty($_POST["pro_add"])) $pro_add=json_encode($_POST["pro_add"]);
	else $pro_add=NULL;	
	if(!empty($_POST["tot_per"])) $tot_per=json_encode($_POST["tot_per"]);
	else $tot_per=NULL;
	if(!empty($_POST["b_add"])) $b_add=json_encode($_POST["b_add"]);
	else $b_add=NULL;
	$property_type=$_POST["property_type"];	
	if($property_type=="R"){
		$property_type_sub_category=$_POST["property_type_sub_category_residential"];
	}else if($property_type=="I"){
		$property_type_sub_category=$_POST["property_type_sub_category_institutional"];
	}else if($property_type=="C"){
		$property_type_sub_category=$_POST["property_type_sub_category_commercial"];
	}else if($property_type=="IND"){
		$property_type_sub_category=$_POST["property_type_sub_category_industrial"];
	}else{
		$property_type="Others -".$_POST["other"];
		$property_type_sub_category="";
	}
	if($property_type=="R" && $property_type_sub_category=="O"){
		$property_type_sub_category="Others - ".$_POST["residential_other"];
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){	
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fat_name,documents,occu_pro,pro_add,b_add,property_type,property_type_sub_category,tot_per) values ('$swr_id','$today','$fat_name','$documents','$occu_pro','$pro_add','$b_add','$property_type','$property_type_sub_category','$tot_per')");
		$form_id=$query;
	}else{	
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',fat_name='$fat_name',documents='$documents',property_type='$property_type',property_type_sub_category='$property_type_sub_category' ,occu_pro='$occu_pro',pro_add='$pro_add',b_add='$b_add',tot_per='$tot_per' where form_id='$form_id'");
	}
	if($query) {
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
	$connect_type=$_POST["connect_type"];$comm_mode=$_POST["comm_mode"];	$gps_point=$_POST["gps_point"];
	if(!empty($_POST["is_connection"])) $is_connection=json_encode($_POST["is_connection"]);
	else $is_connection=NULL;		
	if(!empty($_POST["is_arrear"])) $is_arrear=json_encode($_POST["is_arrear"]);
	else $is_arrear=NULL;		
	if(!empty($_POST["declaration"])) $declaration=json_encode($_POST["declaration"]);
	else $declaration=NULL;	
	if(isset($is_connection_a) && ($is_connection_a=="Y")){
		$is_connection_b=clean($_POST["is_connection_b"]);
	}else{
		$is_connection_b="";
	}
	if(isset($is_arrear_a) && ($is_arrear_a=="Y")){
		$is_arrear_b=clean($_POST["is_arrear_b"]);
	}else{
		$is_arrear_b="";
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array(); 
	if($sql->num_rows<1){			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(sub_date,connect_type,is_connection,is_arrear,comm_mode,gps_point,declaration) values ('$today','$connect_type','$is_connection','$is_arrear','$comm_mode','$gps_point','$declaration')");
	}else{				
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', connect_type='$connect_type',is_connection='$is_connection',is_arrear='$is_arrear', comm_mode='$comm_mode', gps_point='$gps_point', declaration='$declaration' where form_id='$form_id'");
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
?>