<?php
if(isset($_POST["save46"])){		
	$auth_person=clean($_POST["auth_person"]);$co_name=clean($_POST["co_name"]);$drug_name=clean( $_POST["drug_name"]);
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,co_name,drug_name) values ('$swr_id','$today','$auth_person','$co_name', '$drug_name')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person', co_name='$co_name', drug_name='$drug_name' where form_id=$form_id");		
	}				
	if($query){
		if($input_size!=0){	
		$formFunctions->insert_incomplete_forms($dept,$form);
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

if(isset($_POST["save47"])){		
	$auth_person=clean($_POST["auth_person"]);$cosmetics_names=clean($_POST["cosmetics_names"]);$prev_lic_no=clean($_POST["prev_lic_no"]);$input_size=$_POST["hiddenval"];
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,cosmetics_names,prev_lic_no,prev_issue_date) values ('$swr_id','$today','$auth_person','$cosmetics_names','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',cosmetics_names='$cosmetics_names',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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
	
if(isset($_POST["save48"])){		
	$auth_person=clean($_POST["auth_person"]);$cosmetics_names=clean($_POST["cosmetics_names"]);$co_name=clean($_POST["co_name"]);$input_size=$_POST["hiddenval"];
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,cosmetics_names,co_name,prev_issue_date) values ('$swr_id','$today','$auth_person','$cosmetics_names','$co_name','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  auth_person='$auth_person',cosmetics_names='$cosmetics_names',co_name='$co_name', prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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

if(isset($_POST["save49"])){		
	$auth_person=clean($_POST["auth_person"]);$crude_drugs=clean($_POST["crude_drugs"]);$mech_cont=clean($_POST["mech_cont"]);$sur_dressing=clean($_POST["sur_dressing"]);$chromatography=clean($_POST["chromatography"]);$disinfectants=clean($_POST["disinfectants"]);$other_drugs=clean($_POST["other_drugs"]);$products=clean($_POST["products"]);$antibiotics=clean($_POST["antibiotics"]);$vitamins=clean($_POST["vitamins"]);$parental=clean($_POST["parental"]);$suture=clean($_POST["suture"]);$photometer=clean($_POST["photometer"]);$test_animal=clean($_POST["test_animal"]);$microbiological=clean($_POST["microbiological"]);$microbiological=clean($_POST["microbiological"]);$cosmetics=clean($_POST["cosmetics"]);$testing=clean($_POST["testing"]);$drugs=clean($_POST["drugs"]);	$homoeopathic=clean($_POST["homoeopathic"]);$prev_apprv_no=clean($_POST["prev_apprv_no"]);
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}	
	$input_size=$_POST["hiddenval"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,crude_drugs,mech_cont, sur_dressing, chromatography, disinfectants, other_drugs,products,antibiotics,vitamins,parental, suture,photometer,test_animal,microbiological,homoeopathic,cosmetics,testing,drugs,prev_apprv_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$crude_drugs','$mech_cont', '$sur_dressing', '$chromatography', '$disinfectants', '$other_drugs', '$products', '$antibiotics', '$vitamins','$parental','$suture','$photometer','$test_animal','$microbiological','$homoeopathic','$cosmetics','$testing','$drugs','$prev_apprv_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  auth_person='$auth_person', crude_drugs='$crude_drugs',mech_cont='$mech_cont', sur_dressing='$sur_dressing', chromatography='$chromatography', disinfectants='$disinfectants', other_drugs='$other_drugs', products='$products', antibiotics='$antibiotics', vitamins='$vitamins',parental='$parental',suture='$suture',photometer='$photometer',test_animal='$test_animal',microbiological='$microbiological',homoeopathic='$homoeopathic',cosmetics='$cosmetics',testing='$testing',drugs='$drugs',prev_apprv_no='$prev_apprv_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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

if(isset($_POST["save50"])){		
	$drugs_name=clean($_POST["drugs_name"]);$auth_person=clean($_POST["auth_person"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drugs_name,auth_person) values ('$swr_id','$today', '$drugs_name', '$auth_person')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', drugs_name='$drugs_name', auth_person='$auth_person' where form_id=$form_id");
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

if(isset($_POST["save51"])){
	$drugs_name=clean($_POST["drugs_name"]);$auth_person=clean($_POST["auth_person"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drugs_name,auth_person,prev_lic_no,prev_issue_date) values ('$swr_id','$today','$drugs_name','$auth_person','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', drugs_name='$drugs_name', auth_person='$auth_person',prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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

if(isset($_POST["save52"])){		
	$co_name=clean($_POST["co_name"]);$drug_name=clean( $_POST["drug_name"]);
	$auth_person=clean($_POST["auth_person"]);
	$input_size=$_POST["hiddenval"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,co_name,drug_name,auth_person) values ('$swr_id','$today', '$co_name', '$drug_name', '$auth_person')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', co_name='$co_name', drug_name='$drug_name', auth_person='$auth_person' where form_id=$form_id");		
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

if(isset($_POST["save53"])){	
	$drug=clean($_POST["drug"]);$auth_person=clean($_POST["auth_person"]);$input_size=$_POST["hiddenval"];
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	   $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drug,auth_person) values ('$swr_id','$today', '$drug','$auth_person')");
	   $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', drug='$drug', auth_person='$auth_person' where form_id=$form_id");
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

if(isset($_POST["save54"])){
	
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

if(isset($_POST["save55"])){		
	$drug_name=clean($_POST["drug_name"]);$co_name=clean( $_POST["co_name"]);$auth_person=clean($_POST["auth_person"]);
	$input_size=$_POST["hiddenval"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drug_name,co_name,auth_person) values ('$swr_id','$today', '$drug_name','$co_name','$auth_person')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',drug_name='$drug_name',co_name='$co_name',auth_person='$auth_person' where form_id=$form_id");		
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

if(isset($_POST["save56"])){		
	$drug_name=clean($_POST["drug_name"]);$staff_manuf=clean( $_POST["staff_manuf"]);$auth_person=clean($_POST["auth_person"]);
	$input_size=$_POST["hiddenval"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drug_name,staff_manuf,auth_person) values ('$swr_id','$today', '$drug_name','$staff_manuf','$auth_person')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  drug_name='$drug_name',staff_manuf='$staff_manuf',auth_person='$auth_person' where form_id=$form_id");			
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

if(isset($_POST["save57"])){		
	$drug_name=clean($_POST["drug_name"]);$inspection_on=clean( $_POST["inspection_on"]);$auth_person=clean($_POST["auth_person"]);
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,drug_name,inspection_on,auth_person) values ('$swr_id','$today', '$drug_name','$inspection_on','$auth_person')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', drug_name='$drug_name',inspection_on='$inspection_on',auth_person='$auth_person' where form_id=$form_id");		
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

if(isset($_POST["save58"])){		
	$auth_person=clean($_POST["auth_person"]);
	$input_size=$_POST["hiddenval"];
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

if(isset($_POST["save59"])){		
	$cosmetics_names=clean($_POST["cosmetics_names"]);$co_name=clean($_POST["co_name"]);$auth_person=clean($_POST["auth_person"]);
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,cosmetics_names,co_name,auth_person) values ('$swr_id','$today', '$cosmetics_names','$co_name','$auth_person')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  cosmetics_names='$cosmetics_names',co_name='$co_name',auth_person='$auth_person' where form_id=$form_id");		
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

if(isset($_POST["save60"])){		
	$reg_no=clean($_POST["reg_no"]);$catrgories=clean($_POST["catrgories"]);$storage_acc=clean($_POST["storage_acc"]);$auth_person=clean($_POST["auth_person"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;$prev_lic_no=clean($_POST["prev_lic_no"]);
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////	
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,reg_no,catrgories,storage_acc,prev_lic_no,prev_issue_date,auth_person) values ('$swr_id','$today', '$reg_no', '$catrgories','$storage_acc','$prev_lic_no','$prev_issue_date','$auth_person')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',reg_no='$reg_no',catrgories='$catrgories',storage_acc='$storage_acc',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date',auth_person='$auth_person' where form_id=$form_id");
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

if(isset($_POST["save61"])){		
	$reg_no=clean($_POST["reg_no"]);$catrgories=clean($_POST["catrgories"]);$storage_acc=clean($_POST["storage_acc"]);$prev_lic_no=clean($_POST["prev_lic_no"]);$auth_person=clean($_POST["auth_person"]);
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
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,reg_no,catrgories,storage_acc,prev_lic_no,prev_issue_date,auth_person) values ('$swr_id','$today', '$reg_no', '$catrgories','$storage_acc','$prev_lic_no','$prev_issue_date','$auth_person')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', reg_no='$reg_no',  catrgories='$catrgories',storage_acc='$storage_acc',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date',auth_person='$auth_person' where form_id=$form_id");
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