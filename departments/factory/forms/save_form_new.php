<?php
  if(isset($_POST["save19"])){
	$input_size1=clean($_POST["hiddenval"]);$appli_sign=clean($_POST["appli_sign"]);		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,appli_sign) values ('$swr_id','$today','$appli_sign')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery( $dept,"update ".$table_name." set sub_date='$today',appli_sign='$appli_sign' where form_id=$form_id" );			
	}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];
				$vali=$_POST["txtI".$i];
				$valj=$_POST["txtJ".$i];
				$valk=$_POST["txtK".$i];
				
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,works,name_worker,sex,age_birthday,nature,employment_dt,occu_date,eye_result,signature,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj','$valk')") ;
			}
		}	
			
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save24"])){
	$input_size1=clean($_POST["hiddenval1"]);$input_size2=clean($_POST["hiddenval2"]);$name_factory=clean($_POST["name_factory"]);$appli_sign=clean($_POST["appli_sign"]);		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,name_factory,appli_sign) values ('$swr_id','$today','$name_factory','$appli_sign')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery( $dept,"update ".$table_name." set sub_date='$today',name_factory='$name_factory',appli_sign='$appli_sign' where form_id=$form_id" );			
	}
	
	if($query){
		
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name_worker,fathers_name,nature_work,period_end,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") ;
			}
		}
	
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];
				$vale=$_POST["txxtE".$i];
				$valf=$_POST["txxtF".$i];
				$valg=$_POST["txxtG".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,injured_person,date_of_accident,date_of_report,nature_accident,date_of_return,number_days) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}	
			
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save25"])){
	
	$serial_no=clean($_POST["serial_no"]);$serial_no_1=clean($_POST["serial_no_1"]);$date_1=clean($_POST["date_1"]);$date_2=clean($_POST["date_2"]);$appli_name=clean($_POST["appli_name"]);$fathers_name=clean($_POST["fathers_name"]);$sex=clean($_POST["sex"]);$resi_dence=clean($_POST["resi_dence"]);$date_of_birth=clean($_POST["date_of_birth"]);$physical_fitness=clean($_POST["physical_fitness"]);$descriptive_marks=clean($_POST["descriptive_marks"]);$descriptive_marks1=clean($_POST["descriptive_marks1"]);	$refusal_certificate=clean($_POST["refusal_certificate"]);$certificate_revoked=clean($_POST["certificate_revoked"]);$name_personally=clean($_POST["name_personally"]);$son_daughter=clean($_POST["son_daughter"]);$residing=clean($_POST["residing"]);$examination=clean($_POST["examination"]);$appli_sign=clean($_POST["appli_sign"]);		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,serial_no,serial_no_1,date_1,date_2,appli_name,fathers_name,sex,resi_dence,date_of_birth,physical_fitness,descriptive_marks,descriptive_marks1,refusal_certificate,certificate_revoked,name_personally,son_daughter,residing,examination,appli_sign) values ('$swr_id','$today','$serial_no','$serial_no_1','$date_1','$date_2','$appli_name','$fathers_name','$sex','$resi_dence','$date_of_birth','$physical_fitness','$descriptive_marks','$descriptive_marks1','$refusal_certificate','$certificate_revoked','$name_personally','$son_daughter','$residing','$examination','$appli_sign')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery( $dept,"update ".$table_name." set sub_date='$today',serial_no='$serial_no',serial_no_1='$serial_no_1',date_1='$date_1',date_2='$date_2',appli_name='$appli_name',fathers_name='$fathers_name',sex='$sex',resi_dence='$resi_dence',date_of_birth='$date_of_birth',physical_fitness='$physical_fitness',descriptive_marks='$descriptive_marks',descriptive_marks1='$descriptive_marks1',refusal_certificate='$refusal_certificate',certificate_revoked='$certificate_revoked',name_personally='$name_personally',son_daughter='$son_daughter',residing='$residing',examination='$examination',appli_sign='$appli_sign' where form_id=$form_id" );			
	}
	
	if($query){
			
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

?>