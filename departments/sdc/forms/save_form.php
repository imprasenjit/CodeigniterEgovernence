<?php
if(isset($_POST["save_sdc_retention"])){
	
	$prev_lic_no=clean($_POST["prev_lic_no"]);$prev_issue_date=clean($_POST["prev_issue_date"]);$qualified_person_name=clean($_POST["qualified_person_name"]);$qualified_reg_no=clean($_POST["qualified_reg_no"]);
	if($form==27 || $form==28 || $form==31){
		$prev_lic_no2=clean($_POST["prev_lic_no2"]);
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,prev_lic_no,prev_lic_no2,prev_issue_date,qualified_person_name,qualified_reg_no) values ('$swr_id','$today','$prev_lic_no','$prev_lic_no2','$prev_issue_date','$qualified_person_name','$qualified_reg_no')");
			$form_id=$query;
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',prev_lic_no='$prev_lic_no',prev_lic_no2='$prev_lic_no2',prev_issue_date='$prev_issue_date',qualified_person_name='$qualified_person_name',qualified_reg_no='$qualified_reg_no' where form_id=$form_id");
		}
	}else{
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,prev_lic_no,prev_issue_date,qualified_person_name,qualified_reg_no) values ('$swr_id','$today','$prev_lic_no','$prev_issue_date','$qualified_person_name','$qualified_reg_no')");
			$form_id=$query;
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date',qualified_person_name='$qualified_person_name',qualified_reg_no='$qualified_reg_no' where form_id=$form_id");
		}		
	}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !');
			window.location.href = 'sdc_retention.php';
		</script>";
	}	
}


if(isset($_POST["save_sdc_retention_retail"])){
	
	$drug_licence_no=clean($_POST["drug_licence_no"]);$issue_dt=clean($_POST["issue_dt"]);
	$expiry_dt=clean($_POST["expiry_dt"]);$nm_person_incharge=clean($_POST["nm_person_incharge"]);$edu_qualification=clean($_POST["edu_qualification"]);$pharmacist_incharge=clean($_POST["pharmacist_incharge"]);$pharmacist_reg_no=clean($_POST["pharmacist_reg_no"]);$reg_no_validity=clean($_POST["reg_no_validity"]);
	
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drug_licence_no,issue_dt,expiry_dt,nm_person_incharge,edu_qualification,pharmacist_incharge,pharmacist_reg_no,reg_no_validity) values ('$swr_id','$today','$drug_licence_no','$issue_dt','$expiry_dt','$nm_person_incharge','$edu_qualification','$pharmacist_incharge','$pharmacist_reg_no','$reg_no_validity')");
			$form_id=$query;
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',drug_licence_no='$drug_licence_no',issue_dt='$issue_dt',expiry_dt='$expiry_dt',nm_person_incharge='$nm_person_incharge',edu_qualification='$edu_qualification',pharmacist_incharge='$pharmacist_incharge',pharmacist_reg_no='$pharmacist_reg_no',reg_no_validity='$reg_no_validity' where form_id=$form_id");
		}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !');
			window.location.href = 'sdc_retention_retail.php';
		</script>";
	}	
}



if(isset($_POST["save_sdc_retention_manufacture"])){
	
	
	$drug_licence_no=clean($_POST["drug_licence_no"]);$issue_dt=clean($_POST["issue_dt"]);
	$expiry_dt=clean($_POST["expiry_dt"]);$mfg_chemist=clean($_POST["mfg_chemist"]);$testing_chemist=clean($_POST["testing_chemist"]);
	
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drug_licence_no,issue_dt,expiry_dt,mfg_chemist,testing_chemist) values ('$swr_id','$today','$drug_licence_no','$issue_dt','$expiry_dt','$mfg_chemist','$testing_chemist')");
			$form_id=$query;
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',drug_licence_no='$drug_licence_no',issue_dt='$issue_dt',expiry_dt='$expiry_dt',mfg_chemist='$mfg_chemist',testing_chemist='$testing_chemist' where form_id=$form_id");
		}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !');
			window.location.href = 'sdc_retention_manufacture.php';
		</script>";
	}	
}


/* ------ sdc form 1 start ------*/

if(isset($_POST["save1"])){	
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	    $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,supervision,category,particulars) values ('$swr_id','$today', '$auth_person','$location','$supervision', '$category', '$particulars')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',location='$location', supervision='$supervision', category='$category', particulars='$particulars' where form_id=$form_id");
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

if(isset($_POST["save2"])){	
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	   $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,supervision,category,particulars) values ('$swr_id','$today','$auth_person','$location','$supervision', '$category', '$particulars')");
	  $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',location='$location', supervision='$supervision', category='$category', particulars='$particulars' where form_id=$form_id");
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

if(isset($_POST["save3"])){		
	$auth_person=clean($_POST["auth_person"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,category,supervision,particulars) values ('$swr_id','$today','$auth_person','$category', '$supervision', '$particulars')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',category='$category', supervision='$supervision',  particulars='$particulars' where form_id=$form_id");
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

if(isset($_POST["save4"])){		
	$auth_person=clean($_POST["auth_person"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,category,supervision,particulars) values ('$swr_id','$today', '$auth_person','$category', '$supervision', '$particulars')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  auth_person='$auth_person',category='$category', supervision='$supervision',  particulars='$particulars' where form_id=$form_id");
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

if(isset($_POST["save5"])){		
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,situated,drug_name,particulars,dealer) values ('$swr_id','$today', '$auth_person','$location', '$situated', '$drug_name', '$particulars', '$dealer')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer' where form_id=$form_id");
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

if(isset($_POST["save6"])){		
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,situated,drug_name,particulars,dealer) values ('$swr_id','$today','$auth_person','$location','$situated', '$drug_name', '$particulars', '$dealer')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer' where form_id=$form_id");
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

if(isset($_POST["save7"])){		
	$auth_person=clean($_POST["auth_person"]);$licence=clean($_POST["licence"]);$name_incharge=clean($_POST["name_incharge"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,licence,name_incharge) values ('$swr_id','$today','$auth_person','$licence', '$name_incharge')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',licence='$licence', name_incharge='$name_incharge' where form_id=$form_id");
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

if(isset($_POST["save8"])){		
	$auth_person=clean($_POST["auth_person"]);$licence=clean($_POST["licence"]);$name_incharge=clean($_POST["name_incharge"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,licence,name_incharge) values ('$swr_id','$today', '$auth_person','$licence', '$name_incharge')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person', licence='$licence',  name_incharge='$name_incharge' where form_id=$form_id");
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

if(isset($_POST["save9"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);
	$input_size=$_POST["hiddenval"];

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name) values ('$swr_id','$today', '$auth_person', '$drug_name')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person', drug_name='$drug_name' where form_id=$form_id");		
	}				
	if($query){
		if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		for($i=1;$i<$input_size;$i++){
			//$vala=$_POST["txtA".$i];		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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

if(isset($_POST["save10"])){		
	$auth_person=clean($_POST["auth_person"]);$co_name=clean($_POST["co_name"]);$drug_name=clean( $_POST["drug_name"]);
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,co_name,drug_name) values ('$swr_id','$today', '$auth_person','$co_name', '$drug_name')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', co_name='$co_name', drug_name='$drug_name' where form_id=$form_id");		
	}				
	if($query){
	   if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		for($i=1;$i<$input_size;$i++){
			//$vala=$_POST["txtA".$i];		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$names_of_drugs=clean($_POST["names_of_drugs"]);$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	   $query=$formFunctions->executeQueryInsertID($dept,"INSERT INTO ".$table_name."(user_id,sub_date,auth_person,location,names_of_drugs) values ('$swr_id','$today', '$auth_person', '$location','$names_of_drugs')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person', location='$location', names_of_drugs='$names_of_drugs' where form_id=$form_id");
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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
	$auth_person=clean($_POST["auth_person"]);$licence_no=clean($_POST["licence_no"]);$location=clean($_POST["location"]);$homoeopathic=clean($_POST["homoeopathic"]);$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,licence_no,location,homoeopathic) values ('$swr_id','$today', '$auth_person', '$licence_no','$location','$homoeopathic')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person', licence_no='$licence_no', location='$location', homoeopathic='$homoeopathic' where form_id='$form_id'");
	}	
	if($query){
		if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
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

if(isset($_POST["save13"])){	
	$auth_person=clean($_POST["auth_person"]);$drug=clean($_POST["drug"]);$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	   $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug) values ('$swr_id','$today', '$auth_person', '$drug')");
	   $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person', drug='$drug' where form_id=$form_id");
	}	
	if($query){
		if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
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

if(isset($_POST["save14"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$inspection_date=clean( $_POST["inspection_date"]);
	$input_size=$_POST["hiddenval"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,inspection_date) values ('$swr_id','$today', '$auth_person', '$drug_name','$inspection_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug_name='$drug_name',inspection_date='$inspection_date' where form_id=$form_id");		
	}				
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
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

if(isset($_POST["save15"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$co_name=clean( $_POST["co_name"]);
	$input_size=$_POST["hiddenval"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,co_name) values ('$swr_id','$today','$auth_person','$drug_name','$co_name')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', drug_name='$drug_name',co_name='$co_name' where form_id=$form_id");		
	}				
	if($query){
		if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
				}
			}
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