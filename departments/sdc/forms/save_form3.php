<?php 
if(isset($_POST["save31"])){		
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,situated,drug_name,particulars,dealer,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$location', '$situated', '$drug_name', '$particulars', '$dealer','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer',prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save32"])){		
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,situated,drug_name,particulars,dealer, prev_lic_no,prev_issue_date) values ('$swr_id','$today','$auth_person','$location', '$situated', '$drug_name', '$particulars', '$dealer', '$prev_lic_no', '$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer',prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save33"])){		
	$auth_person=clean($_POST["auth_person"]);$licence=clean($_POST["licence"]);$name_incharge=clean($_POST["name_incharge"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,licence,name_incharge,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person', '$licence', '$name_incharge', '$prev_lic_no', '$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person',licence='$licence',  name_incharge='$name_incharge', prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save34"])){		
	$auth_person=clean($_POST["auth_person"]);$licence=clean($_POST["licence"]);$name_incharge=clean($_POST["name_incharge"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,licence,name_incharge, prev_lic_no, prev_issue_date) values ('$swr_id','$today', '$auth_person','$licence', '$name_incharge', '$prev_lic_no', '$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person',licence='$licence',  name_incharge='$name_incharge',  prev_lic_no='$prev_lic_no',  prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save35"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	$input_size=$_POST["hiddenval"];
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,prev_lic_no, prev_issue_date)  values ('$swr_id','$today','$auth_person','$drug_name', '$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person',drug_name='$drug_name', prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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

if(isset($_POST["save36"])){		
	$auth_person=clean($_POST["auth_person"]);$co_name=clean($_POST["co_name"]);$drug_name=clean( $_POST["drug_name"]);$prev_lic_no=clean($_POST["prev_lic_no"]);	
	$input_size=$_POST["hiddenval"];
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,co_name,drug_name,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$co_name', '$drug_name','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person',co_name='$co_name', drug_name='$drug_name',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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

if(isset($_POST["save37"])) {	
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$names_of_drugs=clean($_POST["names_of_drugs"]);$input_size=$_POST["hiddenval"];
	$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,names_of_drugs,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$location','$names_of_drugs','$prev_lic_no','$prev_issue_date')");
		   $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person',location='$location', names_of_drugs='$names_of_drugs',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save38"])) {	
	$auth_person=clean($_POST["auth_person"]);$location=clean($_POST["location"]);$homoeopathic=clean($_POST["homoeopathic"]);$input_size=$_POST["hiddenval"];$prev_lic_no=clean($_POST["prev_lic_no"]);
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,location,homoeopathic,prev_lic_no,prev_issue_date) values ('$swr_id','$today','$auth_person','$location','$homoeopathic', '$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', auth_person='$auth_person',location='$location', homoeopathic='$homoeopathic',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save39"])) {	
	$auth_person=clean($_POST["auth_person"]);$drug=clean($_POST["drug"]);$input_size=$_POST["hiddenval"];$prev_lic_no=clean($_POST["prev_lic_no"]);	
	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	   $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug,prev_lic_no,prev_issue_date) values ('$swr_id','$today','$auth_person','$drug', '$prev_lic_no', '$prev_issue_date')");
	  $form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', drug='$drug', prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");
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

if(isset($_POST["save40"])){
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$inspection_date=clean( $_POST["inspection_date"]);$input_size=$_POST["hiddenval"];$prev_lic_no=clean($_POST["prev_lic_no"]);
	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,inspection_date,prev_lic_no,prev_issue_date) values ('$swr_id','$today','$auth_person','$drug_name','$inspection_date', '$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug_name='$drug_name',inspection_date='$inspection_date',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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

if(isset($_POST["save41"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$co_name=clean( $_POST["co_name"]);$input_size=$_POST["hiddenval"];$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,co_name,prev_lic_no,prev_issue_date) values ('$swr_id','$today','$auth_person','$drug_name','$co_name','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',drug_name='$drug_name',auth_person='$auth_person',co_name='$co_name',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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

if(isset($_POST["save42"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$staff_manuf=clean( $_POST["staff_manuf"]);$input_size=$_POST["hiddenval"];$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,staff_manuf,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$drug_name','$staff_manuf','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug_name='$drug_name',staff_manuf='$staff_manuf', prev_lic_no='$prev_lic_no', prev_issue_date='$prev_issue_date' where form_id=$form_id");			
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

if(isset($_POST["save43"])){		
	$auth_person=clean($_POST["auth_person"]);$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,license_no,license_date,staff_manuf) values ('$swr_id','$today','$auth_person','$license_no','$license_date','$staff_manuf')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person', license_no='$license_no',license_date='$license_date',staff_manuf='$staff_manuf' where form_id=$form_id");		
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
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
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

if(isset($_POST["save44"])){		
	$auth_person=clean($_POST["auth_person"]);$drug_name=clean($_POST["drug_name"]);$inspection_on=clean( $_POST["inspection_on"]);
	$input_size=$_POST["hiddenval"];$prev_lic_no=clean($_POST["prev_lic_no"]);	
	if($_POST["prev_issue_date"]!=""){
		$prev_issue_date=date('Y-m-d',strtotime($_POST["prev_issue_date"]));
	}else{
		$prev_issue_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_person,drug_name,inspection_on,prev_lic_no,prev_issue_date) values ('$swr_id','$today', '$auth_person','$drug_name','$inspection_on','$prev_lic_no','$prev_issue_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_person='$auth_person',drug_name='$drug_name',inspection_on='$inspection_on',prev_lic_no='$prev_lic_no',prev_issue_date='$prev_issue_date' where form_id=$form_id");		
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

if(isset($_POST["save45"])){		
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

?>