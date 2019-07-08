<?php 
if(isset($_POST["save62"])){		
	$auth_person=clean($_POST["auth_person"]);$input_size=$_POST["hiddenval"];
	if(!empty($_POST["drug"]))	 $drug=json_encode($_POST["drug"]);
	else	$drug=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug) values ('$swr_id','$today','$auth_person','$drug')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug='$drug' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name_of_product,coposition,strength,claim,existing_brand) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
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

if(isset($_POST["save63"])){
	$auth_person=clean($_POST["auth_person"]);$input_size=$_POST["hiddenval"];
	if(!empty($_POST["drug"]))	 $drug=json_encode($_POST["drug"]);
	else	$drug=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug) values ('$swr_id','$today','$auth_person','$drug')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug='$drug' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name_of_product,coposition,strength,claim,existing_brand) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
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

if(isset($_POST["save66"])){	
	$input_size=$_POST["hiddenval"];$auth_person=clean($_POST["auth_person"]);    
	if(!empty($_POST["drug"]))	 $drug=json_encode($_POST["drug"]);
	else	$drug=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug) values ('$swr_id','$today','$auth_person','$drug')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug='$drug' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name_of_product,coposition,strength,claim,existing_brand) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
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

if(isset($_POST["save67"])){	
	$input_size=$_POST["hiddenval"];$auth_person=clean($_POST["auth_person"]);    
	if(!empty($_POST["drug"]))	 $drug=json_encode($_POST["drug"]);
	else	$drug=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug) values ('$swr_id','$today','$auth_person','$drug')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug='$drug' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name_of_product,coposition,strength,claim,existing_brand) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
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

if(isset($_POST["save68"])){	
	$input_size=$_POST["hiddenval"];$auth_person=clean($_POST["auth_person"]);    
	if(!empty($_POST["drug"]))	 $drug=json_encode($_POST["drug"]);
	else	$drug=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug) values ('$swr_id','$today','$auth_person','$drug')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug='$drug' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name_of_product,coposition,strength,claim,existing_brand) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
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

if(isset($_POST["save72"])){		
	$auth_person=clean($_POST["auth_person"]);$input_size=$_POST["hiddenval"];
	if(!empty($_POST["pre"]))	 $pre=json_encode($_POST["pre"]);
	else	$pre=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,pre,auth_person) values ('$swr_id','$today', '$pre', '$auth_person')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  pre='$pre',  auth_person='$auth_person' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,formula_details,pack_size) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

?>