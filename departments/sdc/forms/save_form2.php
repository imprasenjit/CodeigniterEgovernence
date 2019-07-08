<?php 
if(isset($_POST["save16"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	$input_size=$_POST["hiddenval"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,staff_manuf) values ('$swr_id','$today','$auth_person','$drug_name','$staff_manuf')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug_name='$drug_name',staff_manuf='$staff_manuf' where form_id=$form_id");			
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
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

if(isset($_POST["save17"])){		
	$auth_person=clean($_POST["auth_person"]);$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	$input_size=$_POST["hiddenval"];$input_size1=$_POST["hiddenval2"];
    
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,license_no,license_date,staff_manuf) values ('$swr_id','$today', '$auth_person','$license_no','$license_date','$staff_manuf')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQueryInsertID($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',license_no='$license_no',license_date='$license_date',staff_manuf='$staff_manuf' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name) VALUES ('$form_id','$i','$valb')");
			}
		}
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
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

if(isset($_POST["save18"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$inspection_on=clean( $_POST["inspection_on"]);
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,inspection_on) values ('$swr_id','$today', '$auth_person','$drug_name','$inspection_on')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug_name='$drug_name',inspection_on='$inspection_on' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
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

if(isset($_POST["save19"])){		
	$auth_person=clean($_POST["auth_person"]);$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$inspection=clean( $_POST["inspection"]);
	$input_size=$_POST["hiddenval"];$input_size1=$_POST["hiddenval2"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,license_no,license_date,inspection) values ('$swr_id','$today','$auth_person','$license_no','$license_date','$inspection')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',license_no='$license_no',license_date='$license_date',inspection='$inspection' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name) VALUES ('$form_id','$i','$valb')");
			}
		}
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
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

if(isset($_POST["save20"])){		
	
	$auth_person=clean($_POST["auth_person"]);
	$input_size=$_POST["hiddenval"];
    
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

if(isset($_POST["save21"])){		
	$cosmetics_names=clean($_POST["cosmetics_names"]);$auth_person=clean($_POST["auth_person"]);
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,cosmetics_names,auth_person) values ('$swr_id','$today', '$cosmetics_names','$auth_person')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  cosmetics_names='$cosmetics_names',auth_person='$auth_person' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
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

if(isset($_POST["save22"])){		
	$auth_person=clean($_POST["auth_person"]);$cosmetics_names=clean($_POST["cosmetics_names"]);$co_name=clean($_POST["co_name"]);
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,cosmetics_names,co_name) values ('$swr_id','$today','$auth_person','$cosmetics_names','$co_name')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  auth_person='$auth_person',cosmetics_names='$cosmetics_names',co_name='$co_name' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,responsible) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
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

if(isset($_POST["save23"])){		
	$auth_person=clean($_POST["auth_person"]);$crude_drugs=clean($_POST["crude_drugs"]);$mech_cont=clean($_POST["mech_cont"]);$sur_dressing=clean($_POST["sur_dressing"]);$chromatography=clean($_POST["chromatography"]);$disinfectants=clean($_POST["disinfectants"]);$other_drugs=clean($_POST["other_drugs"]);$products=clean($_POST["products"]);$antibiotics=clean($_POST["antibiotics"]);$vitamins=clean($_POST["vitamins"]);$parental=clean($_POST["parental"]);$suture=clean($_POST["suture"]);$photometer=clean($_POST["photometer"]);$test_animal=clean($_POST["test_animal"]);$microbiological=clean($_POST["microbiological"]);$microbiological=clean($_POST["microbiological"]);$cosmetics=clean($_POST["cosmetics"]);$testing=clean($_POST["testing"]);$drugs=clean($_POST["drugs"]);	$homoeopathic=clean($_POST["homoeopathic"]);	
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,crude_drugs,mech_cont, sur_dressing, chromatography, disinfectants, other_drugs,products,antibiotics,vitamins,parental, suture,photometer,test_animal,microbiological,homoeopathic,cosmetics,testing,drugs) values ('$swr_id','$today','$auth_person','$crude_drugs','$mech_cont', '$sur_dressing', '$chromatography', '$disinfectants', '$other_drugs', '$products', '$antibiotics', '$vitamins','$parental','$suture','$photometer','$test_animal','$microbiological','$homoeopathic','$cosmetics','$testing','$drugs')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',crude_drugs='$crude_drugs',mech_cont='$mech_cont', sur_dressing='$sur_dressing', chromatography='$chromatography', disinfectants='$disinfectants', other_drugs='$other_drugs', products='$products', antibiotics='$antibiotics', vitamins='$vitamins',parental='$parental',suture='$suture',photometer='$photometer',test_animal='$test_animal',microbiological='$microbiological',homoeopathic='$homoeopathic',cosmetics='$cosmetics',testing='$testing',drugs='$drugs' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,qualification,experience,incharge) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
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

if(isset($_POST["save24"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$dosage_form=clean($_POST["dosage_form"]);$pharma_drug=clean($_POST["pharma_drug"]);$indication=clean($_POST["indication"]);$raw_mat=clean($_POST["raw_mat"]);$patent=clean($_POST["patent"]);$chemical=clean($_POST["chemical"]);$animal=clean($_POST["animal"]);$toxicology=clean($_POST["toxicology"]);$human=clean($_POST["human"]);$clinical_p1=clean($_POST["clinical_p1"]);$clinical_p2=clean($_POST["clinical_p2"]);$dissolution=clean($_POST["dissolution"]);$reg_status=clean($_POST["reg_status"]);$test_licence=clean($_POST["test_licence"]);
	if(!empty($_POST["test_spec"]))	 $test_spec=json_encode($_POST["test_spec"]);
	else	$test_spec=NULL;
	if(!empty($_POST["marketing"]))	 $marketing=json_encode($_POST["marketing"]);
	else	$marketing=NULL;
	if(!empty($_POST["formulation"]))	 $formulation=json_encode($_POST["formulation"]);
	else	$formulation=NULL;
	if(!empty($_POST["raw_material"]))	 $raw_material=json_encode($_POST["raw_material"]);
	else	$raw_material=NULL;
	if(!empty($_POST["fix_approval"]))	 $fix_approval=json_encode($_POST["fix_approval"]);
	else	$fix_approval=NULL;
	if(!empty($_POST["sub_approval"]))	 $sub_approval=json_encode($_POST["sub_approval"]);
	else	$sub_approval=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,dosage_form,pharma_drug,indication,raw_mat,patent,chemical,animal,toxicology,human,clinical_p1, clinical_p2,dissolution,reg_status,test_licence,test_spec,marketing,formulation,raw_material,fix_approval,sub_approval) values ('$swr_id','$today', '$auth_person','$drug_name', '$dosage_form', '$pharma_drug', '$indication', '$raw_mat', '$patent', '$chemical', '$animal', '$toxicology', '$human', '$clinical_p1', '$clinical_p2', '$dissolution', '$reg_status', '$test_licence', '$test_spec', '$marketing', '$formulation', '$raw_material', '$fix_approval', '$sub_approval')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person',drug_name='$drug_name', dosage_form='$dosage_form',  pharma_drug='$pharma_drug',raw_mat='$raw_mat', patent='$patent', chemical='$chemical', animal='$animal', toxicology='$toxicology', human='$human', clinical_p1='$clinical_p1', clinical_p2='$clinical_p2', dissolution='$dissolution', reg_status='$reg_status', test_licence='$test_licence', test_spec='$test_spec', marketing='$marketing', formulation='$formulation', raw_material='$raw_material',fix_approval='$fix_approval',sub_approval='$sub_approval' where form_id=$form_id");
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

if(isset($_POST["save25"])){		
	$auth_person=clean($_POST["auth_person"]);$reg_no=clean($_POST["reg_no"]);$catrgories=clean($_POST["catrgories"]);$storage_acc=clean($_POST["storage_acc"]);$prev_lic_no=clean($_POST["prev_lic_no"]);
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////	
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,reg_no,catrgories,storage_acc,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person', '$reg_no', '$catrgories','$storage_acc','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', reg_no='$reg_no',catrgories='$catrgories',storage_acc='$storage_acc',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save26"])){		
	$auth_person=clean($_POST["auth_person"]);$reg_no=clean($_POST["reg_no"]);$catrgories=clean($_POST["catrgories"]);$storage_acc=clean($_POST["storage_acc"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////	
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,reg_no,catrgories,storage_acc,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$reg_no', '$catrgories','$storage_acc','prev_lic_no','prev_issue_date')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',reg_no='$reg_no',catrgories='$catrgories',storage_acc='$storage_acc', prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save27"])) {	
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	   $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,supervision,category,particulars,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$location','$supervision', '$category', '$particulars','$prev_lic_no','$prev_issue_date')");
	  $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',location='$location', supervision='$supervision',category='$category',particulars='$particulars',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");
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
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	   $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,supervision,category,particulars,prev_lic_no,prev_issue_date) values ('$swr_id','$today','$auth_person','$location','$supervision','$category','$particulars','$prev_lic_no','$prev_issue_date')");
	  $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',location='$location', supervision='$supervision',category='$category',particulars='$particulars',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save29"])){		
	$auth_person=clean($_POST["auth_person"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,category,supervision,particulars,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$category', '$supervision', '$particulars', '$prev_lic_no', '$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',  category='$category', supervision='$supervision',  particulars='$particulars', prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save30"])){		
	$auth_person=clean($_POST["auth_person"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,category,supervision,particulars,prev_lic_no,prev_issue_date) values ('$swr_id','$today','$auth_person','$category', '$supervision','$particulars','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', category='$category',supervision='$supervision',particulars='$particulars',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");
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
