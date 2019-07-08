<?php
if(isset($_POST["save1"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$business_p_s=clean($_POST["business_p_s"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$suspension=clean($_POST["suspension"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business_p_s, is_lic_prev, licence,trading,stocks,suspension) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business_p_s', '$is_lic_prev', '$licence','$trading', '$stocks',  '$suspension')");
		$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business_p_s='$business_p_s', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks',  suspension='$suspension' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
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

if(isset($_POST["save2"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
		$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save3"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
		
		$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
		
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save4"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
		$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save5"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
		$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save6"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
        $form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save7"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
		$form_id=$query;
		
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
		}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
			$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
		}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save8"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
        $form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save9"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
        $form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save10"])) {	
	$stock_point=clean($_POST["stock_point"]);$lice_type=clean($_POST["lice_type"]);$lice_type_other=clean($_POST["lice_type_other"]);
	
	if(!empty($_POST["supplier"]))	 $supplier=json_encode($_POST["supplier"]);
	else	$supplier=NULL;
	if($lice_type=='NL'){
			$lice_type='NL';
		}else if($lice_type=='R'){
			$lice_type='R';
		}else{
			$lice_type=$lice_type_other;
		}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,supplier,stock_point,lice_type) values ('$swr_id','$today','$supplier', '$stock_point', '$lice_type')");
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  supplier='$supplier', stock_point='$stock_point', lice_type='$lice_type' where form_id=$form_id");		
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

if(isset($_POST["save11"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
		$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save12"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')");
       $form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save13"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$business_p_s=clean($_POST["business_p_s"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$suspension=clean($_POST["suspension"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business_p_s, is_lic_prev, licence,trading,stocks,suspension) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business_p_s', '$is_lic_prev', '$licence','$trading', '$stocks',  '$suspension')");
        $form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business_p_s='$business_p_s', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks',  suspension='$suspension' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save14"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$business_p_s=clean($_POST["business_p_s"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$suspension=clean($_POST["suspension"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,age,caste,name_lic,	business_p_s, is_lic_prev, licence,trading,stocks,suspension) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business_p_s', '$is_lic_prev', '$licence','$trading', '$stocks',  '$suspension')");
        $form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business_p_s='$business_p_s', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks',  suspension='$suspension' where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");			
			}	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')") ;
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

if(isset($_POST["save15"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action')");
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action' where form_id=$form_id");		
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

if(isset($_POST["save16"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
    if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action','$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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
			
if(isset($_POST["save17"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);    if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save18"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save19"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save20"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')") ;
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

if(isset($_POST["save21"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
	      
          $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')") ;
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

if(isset($_POST["save22"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')") ;
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

if(isset($_POST["save23"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')") ;
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

if(isset($_POST["save24"])) {	
	$stock_point=clean($_POST["stock_point"]);$lice_type=clean($_POST["lice_type"]);$lice_type_other=clean($_POST["lice_type_other"]);
	
	if(!empty($_POST["supplier"]))	 $supplier=json_encode($_POST["supplier"]);
	else	$supplier=NULL;
	if($lice_type=='NL'){
			$lice_type='NL';
		}else if($lice_type=='R'){
			$lice_type='R';
		}else{
			$lice_type=$lice_type_other;
		}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,supplier,stock_point,lice_type) values ('$swr_id','$today','$today','$supplier', '$stock_point', '$lice_type')");
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', received_date='$today',  supplier='$supplier', stock_point='$stock_point', lice_type='$lice_type' where form_id=$form_id");		
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

if(isset($_POST["save25"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
    if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save26"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
    $input_size=$_POST["hiddenval"];
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	      $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action,address) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action', '$address')");
           $form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action', address='$address' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,wholesaler,impoter,retailer) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save27"])){
	$auth_address=clean($_POST["auth_address"]);$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_address,license_no,expiry_date,license_stands,	renewal_desired, details_action) values ('$swr_id','$today','$auth_address', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action')");			
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_address='$auth_address', license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action' where form_id='$form_id'");	
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

if(isset($_POST["save28"])) {	
	$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,expiry_date,license_stands,renewal_desired,details_action) values ('$swr_id','$today', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action')");
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action' where form_id=$form_id");		
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