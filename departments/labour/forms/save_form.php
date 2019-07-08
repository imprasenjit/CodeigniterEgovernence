<?php
if(isset($_POST["save1a"])){
	if(!empty($_POST["situation"])) $situation=json_encode($_POST["situation"]);
	else $situation=NULL;	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,situation) values ('$swr_id','$today','$situation')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',situation='$situation' where user_id='$swr_id' and form_id='$form_id'");		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_reg_form1.php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_reg_form1.php?tab=1';
		</script>";
	}							
}
if(isset($_POST["save1b"])){
	$manager_name=$dbconnect->clean($_POST["manager_name"]);
	if(isset($_POST["hiddenval2"])) $input_size=$_POST["hiddenval2"]; 
		else $input_size=0;
	if(!empty($_POST["manager_address"])) $manager_address=json_encode($_POST["manager_address"]);
		else $manager_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'lc_reg_form1.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', manager_name='$manager_name', manager_address='$manager_address' where form_id=$form_id");	
	}		
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];			
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'lc_reg_form1.php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_reg_form1.php?tab=2';
		</script>";
	}						
}
if(isset($_POST["save1c"])){
	$estab_category=$dbconnect->clean($_POST["estab_category"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);
	if(isset($_POST["hiddenval2"])) $input_size2=$_POST["hiddenval2"]; else $input_size2=0;
	if(isset($_POST["hiddenval3"])) $input_size3=$_POST["hiddenval3"]; else $input_size3=0;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'lc_reg_form1.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', estab_category='$estab_category',max_workers='$max_workers' where form_id=$form_id");
	}			
	if($query){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_reg_form1.php?tab=4';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_reg_form1.php?tab=3';
		</script>";
	}					
}
if(isset($_POST["save1d"])){
	$input_size4=$_POST["hiddenval4"];$input_size5=$_POST["hiddenval5"];$input_size6=$_POST["hiddenval6"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty/////////////
		echo "<script>
				alert('Please fill up the first section of the form');
				window.location.href = 'lc_reg_form1.php?tab=1';
			</script>";				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txtttB".$i];
				$valc=$_POST["txtttC".$i];
				$vald=$_POST["txtttD".$i];
				$vale=$_POST["txtttE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttttB".$i];
				$valc=$_POST["txttttC".$i];
				$vald=$_POST["txttttD".$i];
				$vale=$_POST["txttttE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txtttttB".$i];
				$valc=$_POST["txtttttC".$i];
				$vald=$_POST["txtttttD".$i];
				$vale=$_POST["txtttttE".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_reg_form1.php?tab=4';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_reg_form1.php?tab=4';
			</script>";
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_reg_form1.php?tab=4';
			</script>";
		}else{
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
		}					
	}				
}

if(isset($_POST["save2"])){		
	$nature_work=$dbconnect->clean($_POST["nature_work"]);$father_name=$dbconnect->clean($_POST["father_name"]);
	$max_workers=$dbconnect->clean($_POST["max_workers"]);$nature_w_emp=$dbconnect->clean($_POST["nature_w_emp"]);
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
	else $manager=NULL;
	if(!empty($_POST["enclose"])) $enclose=json_encode($_POST["enclose"]);
	else $enclose=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,manager,nature_work,nature_w_emp,max_workers,enclose) values ('$swr_id','$today','$father_name','$manager','$nature_work','$nature_w_emp','$max_workers','$enclose')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', manager='$manager',nature_work='$nature_work',nature_w_emp='$nature_w_emp',max_workers='$max_workers', enclose='$enclose' where form_id=$form_id");	
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
		   window.location.href = 'lc_reg_form2.php?';
		</script>";
	}		
}

if(isset($_POST["save3"])){		
	$nature_work=$dbconnect->clean($_POST["nature_work"]);$father_name=$dbconnect->clean($_POST["father_name"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);
	$input_size1=$dbconnect->clean($_POST["hiddenval"]);$input_size2=$dbconnect->clean($_POST["hiddenval2"]);
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
	else $manager=NULL;
	if(!empty($_POST["contractor"])) $contractor=json_encode($_POST["contractor"]);
	else $contractor=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,nature_work,father_name,manager,contractor,max_workers) values ('$swr_id','$today','$nature_work','$father_name', '$manager','$contractor','$max_workers')");
		$form_id=$query;
	}else{
		$form_id=$query;	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',nature_work='$nature_work', father_name='$father_name', manager='$manager',contractor='$contractor',max_workers='$max_workers' where user_id='$swr_id' and form_id=$form_id");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
	    if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
	        }
	    }
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$valf=$_POST["txttF".$i];
				$valg=$_POST["txttG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
		    }
		}		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_reg_form3.php';
		</script>";
	}	
}			

if(isset($_POST["save4"])){
	$total_grant=$dbconnect->clean($_POST["total_grant"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);$input_size=$dbconnect->clean($_POST["hiddenval"]);$input_size2=$dbconnect->clean($_POST["hiddenval2"]);$input_size3=$dbconnect->clean($_POST["hiddenval3"]);$input_size4=$dbconnect->clean($_POST["hiddenval4"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,total_grant,max_workers) values ('$swr_id','$today','$total_grant', '$max_workers')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', total_grant='$total_grant', max_workers='$max_workers' where form_id=$form_id");
	}		
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];		
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") ;
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$valf=$_POST["txttF".$i];
				$valg=$_POST["txttG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["textA".$i];	*/						
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["texttB".$i];
				$valc=$_POST["texttC".$i];
				$vald=$_POST["texttD".$i];
				$vale=$_POST["texttE".$i];
				$valf=$_POST["texttF".$i];
				$valg=$_POST["texttG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		$formFunctions->insert_incomplete_forms($dept,$form);
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_reg_form4.php';
		</script>";
	}	
}

if(isset($_POST["save5"])){		
	$father_name=$dbconnect->clean($_POST["father_name"]);$nature_work=$dbconnect->clean($_POST["nature_work"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);$commencement_date=$dbconnect->clean($_POST["commencement_date"]);$completion_date=$dbconnect->clean($_POST["completion_date"]);
	if(!empty($_POST["particular"])) $particular=json_encode($_POST["particular"]);
		else $particular=NULL;
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
		else $manager=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,nature_work,max_workers,commencement_date,manager,completion_date,particular) values ('$swr_id','$today','$father_name', '$nature_work','$max_workers','$commencement_date','$manager','$completion_date','$particular')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name', nature_work='$nature_work',max_workers='$max_workers',commencement_date='$commencement_date',manager='$manager',completion_date='$completion_date',particular='$particular' where form_id=$form_id");	
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
		   window.location.href = 'lc_reg_form5.php?';
		</script>";
	}	
}

if(isset($_POST["save6a"])){
	$fa_sp_name=$dbconnect->clean($_POST["fa_sp_name"]);$employer_name=$dbconnect->clean($_POST["employer_name"]);$dob_con=$dbconnect->clean($_POST["dob_con"]);$age_con=$dbconnect->clean($_POST["age_con"]);
	$dob_con=date("y-m-d",strtotime($dob_con));	
	$num_of_cert_reg=$dbconnect->clean($_POST["num_of_cert_reg"]);$date_of_cert_reg=$dbconnect->clean($_POST["date_of_cert_reg"]);
	$date_of_cert_reg=date("Y-m-d",strtotime($date_of_cert_reg));	
	if(!empty($_POST["employ_address"]))	 $employ_address=json_encode($_POST["employ_address"]);
	else	$employ_address=NULL;		
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fa_sp_name,dob_con,age_con,num_of_cert_reg,date_of_cert_reg,employer_name,employ_address) values ('$swr_id','$today', '$fa_sp_name', '$dob_con', '$age_con','$num_of_cert_reg','$date_of_cert_reg','$employer_name','$employ_address')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', fa_sp_name='$fa_sp_name', dob_con='$dob_con', age_con='$age_con',num_of_cert_reg='$num_of_cert_reg',date_of_cert_reg='$date_of_cert_reg',employer_name='$employer_name' ,employ_address='$employ_address' where form_id=$form_id");				
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_license_form6.php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_license_form6.php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save6b"])){	
    $max_workers=$dbconnect->clean($_POST["max_workers"]);$is_contractor_convict=$dbconnect->clean($_POST["is_contractor_convict"]);
    if(!empty($_POST["contract_labour"])) $contract_labour=json_encode($_POST["contract_labour"]);
		else $contract_labour=NULL;		
    if(!empty($_POST["manager_address"])) $manager_address=json_encode($_POST["manager_address"]);
		else $manager_address=NULL;		
			
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', max_workers='$max_workers',is_contractor_convict='$is_contractor_convict',contract_labour='$contract_labour',manager_address='$manager_address' where form_id=$form_id");				
	}
	if($query){
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_license_form6.php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_license_form6.php?tab=2';
		</script>";
	}	
}
if(isset($_POST["save6c"])){	
    $is_contractor_revok=$dbconnect->clean($_POST["is_contractor_revok"]);$is_contractor_work=$dbconnect->clean($_POST["is_contractor_work"]);$is_cert_enclose=$dbconnect->clean($_POST["is_cert_enclose"]);	
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',is_contractor_revok='$is_contractor_revok',is_contractor_work='$is_contractor_work',is_cert_enclose='$is_cert_enclose' where user_id='$swr_id'");				
	}	
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = 'lc_license_form6.php?';
		</script>";
	}		
}

if(isset($_POST["save7a"])){	
    $fa_sp_name=$dbconnect->clean($_POST["fa_sp_name"]);$dob_con=$dbconnect->clean($_POST["dob_con"]);$age_con=$dbconnect->clean($_POST["age_con"]);$type_of_business=$dbconnect->clean($_POST["type_of_business"]);
	$num_of_cert_reg=$dbconnect->clean($_POST["num_of_cert_reg"]);$date_of_cert_reg=$dbconnect->clean($_POST["date_of_cert_reg"]);
	$date_of_cert_reg=date("Y-m-d",strtotime($date_of_cert_reg));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fa_sp_name,dob_con,age_con,type_of_business,num_of_cert_reg,date_of_cert_reg) values ('$swr_id','$today', '$fa_sp_name', '$dob_con', '$age_con', '$type_of_business', '$num_of_cert_reg', '$date_of_cert_reg')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', fa_sp_name='$fa_sp_name', dob_con='$dob_con', age_con='$age_con', type_of_business='$type_of_business',num_of_cert_reg='$num_of_cert_reg',date_of_cert_reg='$date_of_cert_reg' where form_id=$form_id");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_license_form7.php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_license_form7.php?tab=1';
		</script>";
	}		
}
if(isset($_POST["save7b"])){
	$input_size=$dbconnect->clean($_POST["hiddenval"]);$input_size2=$dbconnect->clean($_POST["hiddenval2"]);
	$max_workers=$dbconnect->clean($_POST["max_workers"]);
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
	else $manager=NULL;
	if(!empty($_POST["mig_workmen"])) $mig_workmen=json_encode($_POST["mig_workmen"]);
	else $mig_workmen=NULL;		
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'lc_licence_form7.php';
			</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', manager='$manager',mig_workmen='$mig_workmen',max_workers='$max_workers' where form_id=$form_id");	
	}		
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];			
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}		
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_license_form7.php?tab=2';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_license_form7.php?tab=2';
			</script>";
		}else{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_license_form7.php?tab=3';
		</script>";
		}			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_license_form7.php?tab=2';
			</script>";
	}					
}
if(isset($_POST["save7c"])){	
    $cont_offence=$dbconnect->clean($_POST["cont_offence"]);$dob3=$dbconnect->clean($_POST["dob3"]);$work_con=$dbconnect->clean($_POST["work_con"]);$enclosed_cert=$dbconnect->clean($_POST["enclosed_cert"]);
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', cont_offence='$cont_offence', dob3='$dob3', work_con='$work_con', enclosed_cert='$enclosed_cert' where form_id=$form_id");
	}	
	if($query){ 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = 'lc_license_form7.php?';
		</script>";
	}	
}

if(isset($_POST["save8a"])){	
    $fa_sp_name=$dbconnect->clean($_POST["fa_sp_name"]);$dob_con=$dbconnect->clean($_POST["dob_con"]);$age_con=$dbconnect->clean($_POST["age_con"]);$type_of_business=$dbconnect->clean($_POST["type_of_business"]);
	$num_of_cert_reg=$dbconnect->clean($_POST["num_of_cert_reg"]);$date_of_cert_reg=$dbconnect->clean($_POST["date_of_cert_reg"]);
	$date_of_cert_reg=date("Y-m-d",strtotime($date_of_cert_reg));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fa_sp_name,dob_con,age_con,type_of_business,num_of_cert_reg,date_of_cert_reg) values ('$swr_id','$today', '$fa_sp_name', '$dob_con', '$age_con', '$type_of_business', '$num_of_cert_reg', '$date_of_cert_reg')") ;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', fa_sp_name='$fa_sp_name', dob_con='$dob_con', age_con='$age_con', type_of_business='$type_of_business', num_of_cert_reg='$num_of_cert_reg', date_of_cert_reg='$date_of_cert_reg'  where user_id='$swr_id' and form_id=$form_id") ;	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_license_form8.php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_license_form8.php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save8b"])){ 
	$input_size1=$dbconnect->clean($_POST["hiddenval"]);$input_size2=$dbconnect->clean($_POST["hiddenval2"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
	else $manager=NULL;
	if(!empty($_POST["mig_workmen"])) $mig_workmen=json_encode($_POST["mig_workmen"]);
	else $mig_workmen=NULL;		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', manager='$manager',mig_workmen='$mig_workmen' ,max_workers='$max_workers' where user_id='$swr_id' and form_id=$form_id");				
    }
	if($query){
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$valf=$_POST["txttF".$i];
				$valg=$_POST["txttG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_license_form8.php?tab=2';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_license_form8.php?tab=2';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_license_form8.php?tab=3';
			</script>";
	    }	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_license_form8.php?tab=2';
		   </script>";
	   }					
}
if(isset($_POST["save8c"])){
	$cont_offence=$dbconnect->clean($_POST["cont_offence"]);$dob3=$dbconnect->clean($_POST["dob3"]);$work_con=$dbconnect->clean($_POST["work_con"]);$enclosed_cert=$dbconnect->clean($_POST["enclosed_cert"]);
					
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', cont_offence='$cont_offence', dob3='$dob3', work_con='$work_con', enclosed_cert='$enclosed_cert' where user_id='$swr_id' and form_id=$form_id");		
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = 'lc_license_form8.php?';
		</script>";
	}		
}

if(isset($_POST["save9a"])){
	if(!empty($_POST["situation"])) $situation=json_encode($_POST["situation"]);
	else $situation=NULL;
	$cert_number=$dbconnect->clean($_POST["cert_number"]);
	$cert_date=$dbconnect->clean($_POST["cert_date"]);
	if($cert_date!=""){
		$cert_date=date("Y-m-d",strtotime($cert_date));
	}else{
		$cert_date=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,cert_number,cert_date,situation) values ('$swr_id','$today','$cert_number', '$cert_date','$situation')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', cert_number='$cert_number', cert_date='$cert_date',situation='$situation' where user_id='$swr_id' and form_id='$form_id'");		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_renewal_form9.php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'lc_renewal_form9.php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save9b"])){
	$manager_name=$dbconnect->clean($_POST["manager_name"]);
	if(isset($_POST["hiddenval"]))	$input_size=$_POST["hiddenval"];
	else $input_size=0;	
	if(!empty($_POST["manager_address"])) $manager_address=json_encode($_POST["manager_address"]);
	else $manager_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'lc_renewal_form9.php';
			</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', manager_name='$manager_name', manager_address='$manager_address' where form_id=$form_id");	
	}		
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];			
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_renewal_form9.php?tab=2';
			</script>";
		}else{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_renewal_form9.php?tab=3';
		</script>";
		}			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_renewal_form9.php?tab=2';
			</script>";
	}					
}
if(isset($_POST["save9c"])){
	$estab_category=$dbconnect->clean($_POST["estab_category"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);
	if(isset($_POST["hiddenval2"])) $input_size2=$_POST["hiddenval2"]; else $input_size2=0;
	if(isset($_POST["hiddenval3"])) $input_size3=$_POST["hiddenval3"]; else $input_size3=0;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'lc_renewal_form9.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', estab_category='$estab_category', max_workers='$max_workers' where form_id=$form_id");
	}			
	if($query){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_renewal_form9.php?tab=3';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_renewal_form9.php?tab=3';
			</script>";
		}else{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'lc_renewal_form9.php?tab=4';
		</script>";
		}		
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_renewal_form9.php?tab=3';
			</script>";
	}			
}
if(isset($_POST["save9d"])){
	$input_size4=$_POST["hiddenval4"];$input_size5=$_POST["hiddenval5"];$input_size6=$_POST["hiddenval6"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){   ////////////table is empty/////////////
		echo "<script>
				alert('Please fill up the first section of the form');
				window.location.href = 'lc_renewal_form9.php?tab=1';
			</script>";				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txtttB".$i];
				$valc=$_POST["txtttC".$i];
				$vald=$_POST["txtttD".$i];
				$vale=$_POST["txtttE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttttB".$i];
				$valc=$_POST["txttttC".$i];
				$vald=$_POST["txttttD".$i];
				$vale=$_POST["txttttE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txtttttB".$i];
				$valc=$_POST["txtttttC".$i];
				$vald=$_POST["txtttttD".$i];
				$vale=$_POST["txtttttE".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_renewal_form9.php?tab=4';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_renewal_form9.php?tab=4';
			</script>";
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'lc_renewal_form9.php?tab=4';
			</script>";
		}else{
			 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		}					
	}				
}

if(isset($_POST["save10"])){		
	$prev_lic_date=$dbconnect->clean($_POST["prev_lic_date"]);$is_suspended=$dbconnect->clean($_POST["is_suspended"]);$particulars=$dbconnect->clean($_POST["particulars"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);
	if(!empty($_POST["license"])) $license=json_encode($_POST["license"]);
		else $license=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,prev_lic_date,is_suspended,particulars,max_workers,license) values ('$swr_id','$today','$prev_lic_date','$is_suspended','$particulars','$max_workers','$license')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  prev_lic_date='$prev_lic_date',is_suspended='$is_suspended',particulars='$particulars',max_workers='$max_workers', license='$license' where form_id=$form_id");	
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
		   window.location.href = 'lc_renewal_form10.php?';
		</script>";
	}		
}
 
if(isset($_POST["save11"])){		
	$prev_lic_date=$dbconnect->clean($_POST["prev_lic_date"]);$is_suspended=$dbconnect->clean($_POST["is_suspended"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);
	if(!empty($_POST["license"])) $license=json_encode($_POST["license"]);
		else $license=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,prev_lic_date,is_suspended,license,max_workers) values ('$swr_id','$today', '$prev_lic_date','$is_suspended','$license','$max_workers')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', prev_lic_date='$prev_lic_date',is_suspended='$is_suspended', license='$license', max_workers='$max_workers' where  form_id=$form_id");	
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
		   window.location.href = 'lc_renewal_form11.php?';
		</script>";
	}	
}

if(isset($_POST["save12"])){		
	$motor_trns_name=$dbconnect->clean($_POST["motor_trns_name"]);$nature=$dbconnect->clean($_POST["nature"]);$tot_no=$dbconnect->clean($_POST["tot_no"]);$tot_route=$dbconnect->clean($_POST["tot_route"]);$tot_n_motor=$dbconnect->clean($_POST["tot_n_motor"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);$gm_name=$dbconnect->clean($_POST["gm_name"]);$director_name=$dbconnect->clean($_POST["director_name"]);$hidden_value=$dbconnect->clean($_POST["hidden_value"]);
	if(!empty($_POST["mt_address"])) $mt_address=json_encode($_POST["mt_address"]);
		else $mt_address=NULL;
	if(!empty($_POST["gm_address"])) $gm_address=json_encode($_POST["gm_address"]);
		else $gm_address=NULL;
	if(!empty($_POST["director_address"])) $director_address=json_encode($_POST["director_address"]);
		else $director_address=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,motor_trns_name,mt_address,nature,tot_no,tot_route,tot_n_motor,max_workers,gm_name,gm_address,director_name,director_address) values ('$swr_id','$today','$motor_trns_name','$mt_address','$nature','$tot_no','$tot_route','$tot_n_motor','$max_workers','$gm_name','$gm_address','$director_name','$director_address')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
				
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,slno,name,sn1,sn2,v,d,p) VALUES ('$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')");
		}
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  motor_trns_name='$motor_trns_name',mt_address='$mt_address',tot_no='$tot_no',nature='$nature', tot_route='$tot_route', tot_n_motor='$tot_n_motor', max_workers='$max_workers', gm_name='$gm_name', gm_address='$gm_address', director_name='$director_name', director_address='$director_address' where form_id=$form_id");	
			
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,slno,name,sn1,sn2,v,d,p) VALUES ('$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')");
		}
	}					
	if($query && $query1){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = 'lc_renewal_form12.php';
		</script>";
	}	
}

if(isset($_POST["save13"])){		
	$motor_trns_name=$dbconnect->clean($_POST["motor_trns_name"]);$nature=$dbconnect->clean($_POST["nature"]);$tot_no=$dbconnect->clean($_POST["tot_no"]);$tot_route=$dbconnect->clean($_POST["tot_route"]);$tot_n_motor=$dbconnect->clean($_POST["tot_n_motor"]);$max_workers=$dbconnect->clean($_POST["max_workers"]);$gm_name=$dbconnect->clean($_POST["gm_name"]);$director_name=$dbconnect->clean($_POST["director_name"]);$hidden_value=$dbconnect->clean($_POST["hidden_value"]);		
	if(!empty($_POST["mt_address"])) $mt_address=json_encode($_POST["mt_address"]);
	else $mt_address=NULL;	
	if(!empty($_POST["gm_address"])) $gm_address=json_encode($_POST["gm_address"]);
	else $gm_address=NULL;	
	if(!empty($_POST["director_address"])) $director_address=json_encode($_POST["director_address"]);
	else $director_address=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into 	".$table_name. "(user_id,sub_date,motor_trns_name,mt_address,nature,tot_no,tot_route,tot_n_motor,max_workers,gm_name,gm_address,director_name,director_address) values ('$swr_id','$today','$motor_trns_name','$mt_address','$nature','$tot_no','$tot_route','$tot_n_motor','$max_workers','$gm_name','$gm_address','$director_name','$director_address')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,slno,name,sn1,sn2,v,d,p) VALUES ('$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')");
			}
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  motor_trns_name='$motor_trns_name',mt_address='$mt_address',tot_no='$tot_no',nature='$nature', tot_route='$tot_route', tot_n_motor='$tot_n_motor', max_workers='$max_workers', gm_name='$gm_name', gm_address='$gm_address', director_name='$director_name', director_address='$director_address' where form_id=$form_id");	
		
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,slno,name,sn1,sn2,v,d,p) VALUES ('$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')");
		}
	}
	if($query && $query1){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}
	else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = 'lc_reg_form13.php';
		</script>";
	}	
}

if(isset($_POST["save14"])){	
	$notification_no=$dbconnect->clean($_POST["notification_no"]);$notification_date=$dbconnect->clean($_POST["notification_date"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ///// table is empty /////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,notification_no,notification_date) values ('$swr_id','$today','$notification_no','$notification_date')");
	}else{  ///// table is not empty /////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', notification_no='$notification_no', notification_date='$notification_date' where form_id=$form_id");	
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
		   window.location.href = 'lc_form14.php';
		</script>";
	}	
}
if(isset($_POST["save15a"])){
	$manager_name=$dbconnect->clean($_POST["manager_name"]);$registration_no=$dbconnect->clean($_POST["registration_no"]);$reg_year=$dbconnect->clean($_POST["reg_year"]);$nature_of_business=$dbconnect->clean($_POST["nature_of_business"]);	
	if(!empty($_POST["manager_address"])) $manager_address=json_encode($_POST["manager_address"]);
	else $manager_address=NULL;	
	if(!empty($_POST["type_of_worker"])) $type_of_worker=json_encode($_POST["type_of_worker"]);
	else $type_of_worker=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,manager_name,manager_address,registration_no,reg_year,nature_of_business,type_of_worker) values ('$swr_id','$today','$manager_name','$manager_address','$registration_no','$reg_year','$nature_of_business','$type_of_worker')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', manager_name='$manager_name', manager_address='$manager_address',registration_no='$registration_no',reg_year='$reg_year',nature_of_business='$nature_of_business', type_of_worker='$type_of_worker' where form_id=$form_id");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'labour_form15.php?tab=2';
		</script>";						
	}else{
		echo "<script>
		  alert('Something went wrong !!!');
			window.location.href = 'labour_form15.php?tab=1';
		</script>";
	}		
}
if(isset($_POST["save15b"])){
	$no_of_days=$dbconnect->clean($_POST["no_of_days"]);$no_of_mandays=$dbconnect->clean($_POST["no_of_mandays"]);$max_no_employees=$dbconnect->clean($_POST["max_no_employees"]);$average_employees=$dbconnect->clean($_POST["average_employees"]);$service_card_no=$dbconnect->clean($_POST["service_card_no"]);$total_wages_a=$dbconnect->clean($_POST["total_wages_a"]);$total_wages_b=$dbconnect->clean($_POST["total_wages_b"]);$total_fine_a=$dbconnect->clean($_POST["total_fine_a"]);$total_fine_b=$dbconnect->clean($_POST["total_fine_b"]);$total_deduction_a=$dbconnect->clean($_POST["total_deduction_a"]);$total_deduction_b=$dbconnect->clean($_POST["total_deduction_b"]);$percentage_bonus=$dbconnect->clean($_POST["percentage_bonus"]);$eligible_beneficiaries=$dbconnect->clean($_POST["eligible_beneficiaries"]);$amount_bonus_paid=$dbconnect->clean($_POST["amount_bonus_paid"]);$payment_date=$dbconnect->clean($_POST["payment_date"]);$reasons=$dbconnect->clean($_POST["reasons"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,no_of_days,no_of_mandays,max_no_employees,average_employees,service_card_no,total_wages_a,total_wages_b,total_fine_a,total_fine_b,total_deduction_a,total_deduction_b,percentage_bonus,eligible_beneficiaries,amount_bonus_paid,payment_date,reasons) values ('$swr_id','$today','$no_of_days','$no_of_mandays','$max_no_employees','$average_employees','$service_card_no','$total_wages_a','$total_wages_b','$total_fine_a','$total_fine_b','$total_deduction_a','$total_deduction_b','$percentage_bonus','$eligible_beneficiaries','$amount_bonus_paid','$payment_date','$reasons')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', no_of_days='$no_of_days', no_of_mandays='$no_of_mandays',max_no_employees='$max_no_employees',average_employees='$average_employees',service_card_no='$service_card_no',total_wages_a='$total_wages_a',total_wages_b='$total_wages_b',total_fine_a='$total_fine_a',total_fine_b='$total_fine_b',total_deduction_a='$total_deduction_a',total_deduction_b='$total_deduction_b',percentage_bonus='$percentage_bonus',eligible_beneficiaries='$eligible_beneficiaries',amount_bonus_paid='$amount_bonus_paid',payment_date='$payment_date',reasons='$reasons' where form_id=$form_id");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'labour_form15.php?tab=3';
		</script>";						
	}else{
		echo "<script>
		  alert('Something went wrong !!!');
			window.location.href = 'labour_form15.php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save15c"])){
	$nature=$dbconnect->clean($_POST["nature"]);$details_furnished=$dbconnect->clean($_POST["details_furnished"]);$annual_return=$dbconnect->clean($_POST["annual_return"]);$duration_contract=$dbconnect->clean($_POST["duration_contract"]);$avg_no_contract=$dbconnect->clean($_POST["avg_no_contract"]);$is_canteen=$dbconnect->clean($_POST["is_canteen"]);$is_rest_room=$dbconnect->clean($_POST["is_rest_room"]);$is_drinking_water=$dbconnect->clean($_POST["is_drinking_water"]);$is_creche=$dbconnect->clean($_POST["is_creche"]);$is_first_aid=$dbconnect->clean($_POST["is_first_aid"]);	
	if(!empty($_POST["total"])) $total=json_encode($_POST["total"]);
	else $total=NULL;
	if(!empty($_POST["details"])) $details=json_encode($_POST["details"]);
	else $details=NULL;
	if(!empty($_POST["total_calculation"])) $total_calculation=json_encode($_POST["total_calculation"]);
	else $total_calculation=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,nature,details_furnished,annual_return,duration_contract,avg_no_contract,is_canteen,is_rest_room,is_drinking_water,is_creche,is_first_aid,total,details,total_calculation) values ('$swr_id','$today','$nature','$details_furnished','$annual_return','$duration_contract','$avg_no_contract','$is_canteen','$is_rest_room','$is_drinking_water','$is_creche','$is_first_aid','$total','$details','$total_calculation')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', nature='$nature', details_furnished='$details_furnished',annual_return='$annual_return',duration_contract='$duration_contract',avg_no_contract='$avg_no_contract', is_canteen='$is_canteen', is_rest_room='$is_rest_room', is_drinking_water='$is_drinking_water', is_creche='$is_creche', is_first_aid='$is_first_aid', total='$total', details='$details', total_calculation='$total_calculation' where form_id=$form_id");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		  alert('Something went wrong !!!');
			window.location.href = 'labour_form15.php?tab=3';
		</script>";
	}		
}

if(isset($_POST["save16"])){	
	$notification_no=$dbconnect->clean($_POST["notification_no"]);$notification_date=$dbconnect->clean($_POST["notification_date"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ///// table is empty /////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,notification_no,notification_date) values ('$swr_id','$today','$notification_no','$notification_date')");
	}else{  ///// table is not empty /////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', notification_no='$notification_no', notification_date='$notification_date' where form_id=$form_id");	
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
		   window.location.href = 'lc_form14.php';
		</script>";
	}	
}
?>