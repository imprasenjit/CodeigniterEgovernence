<?php
if(isset($_POST["save1a"])){
	if(!empty($_POST["situation"])) $situation=json_encode($_POST["situation"]);
	else $situation=NULL;
	
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,situation) values ('$swr_id','$today','$situation')") OR die("Error: ".$labour->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today',situation='$situation' where user_id='$swr_id' and form_id='$form_id'") OR die("Error: ".$labour->error);		
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
	$manager_name=clean($_POST["manager_name"]);
	if(isset($_POST["hiddenval2"])) $input_size=$_POST["hiddenval2"]; 
		else $input_size=0;
	if(!empty($_POST["manager_address"])) $manager_address=json_encode($_POST["manager_address"]);
		else $manager_address=NULL;
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'lc_reg_form1.php';
			</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', manager_name='$manager_name', manager_address='$manager_address' where form_id=$form_id") OR die("Error: ".$labour->error);	
	}		
	if($query){
		if($input_size!=0){					
			$k=$labour->query("delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];			
				$part1=$labour->query("INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
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
	$estab_category=clean($_POST["estab_category"]);$max_workers=clean($_POST["max_workers"]);
	if(isset($_POST["hiddenval2"])) $input_size2=$_POST["hiddenval2"]; else $input_size2=0;
	if(isset($_POST["hiddenval3"])) $input_size3=$_POST["hiddenval3"]; else $input_size3=0;	
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'lc_reg_form1.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$query=$labour->query("update ".$table_name." set sub_date='$today', estab_category='$estab_category',max_workers='$max_workers' where form_id=$form_id") OR die("Error: ".$labour->error);
	}			
	if($query){
		if($input_size2!=0){					
			$k=$labour->query("delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
			}
		}
		if($input_size3!=0){					
			$k=$labour->query("delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$part2=$labour->query("INSERT INTO ".$table_name."_t3(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") or die($labour->error);
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
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty/////////////
		echo "<script>
				alert('Please fill up the first section of the form');
				window.location.href = 'lc_reg_form1.php?tab=1';
			</script>";				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		if($input_size4!=0){					
			$k=$labour->query("delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txtttB".$i];
				$valc=$_POST["txtttC".$i];
				$vald=$_POST["txtttD".$i];
				$vale=$_POST["txtttE".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t4(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") or die($mysqli->error);
			}
		}
		if($input_size5!=0){					
			$k=$labour->query("delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttttB".$i];
				$valc=$_POST["txttttC".$i];
				$vald=$_POST["txttttD".$i];
				$vale=$_POST["txttttE".$i];
				$part2=$labour->query("INSERT INTO ".$table_name."_t5(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") or die($labour->error);
			}
		}
		if($input_size6!=0){					
			$k=$labour->query("delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txtttttB".$i];
				$valc=$_POST["txtttttC".$i];
				$vald=$_POST["txtttttD".$i];
				$vale=$_POST["txtttttE".$i];
				$part3=$labour->query("INSERT INTO ".$table_name."_t6(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") or die($labour->error);
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
	$nature_work=clean($_POST["nature_work"]);$father_name=clean($_POST["father_name"]);
	$max_workers=clean($_POST["max_workers"]);$nature_w_emp=clean($_POST["nature_w_emp"]);
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
	else $manager=NULL;
	if(!empty($_POST["enclose"])) $enclose=json_encode($_POST["enclose"]);
	else $enclose=NULL;

	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :".$labour->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,father_name,manager,nature_work,nature_w_emp,max_workers,enclose) values ('$swr_id','$today','$father_name','$manager','$nature_work','$nature_w_emp','$max_workers','$enclose')") OR die("Error: ".$labour->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', father_name='$father_name', manager='$manager',nature_work='$nature_work',nature_w_emp='$nature_w_emp',max_workers='$max_workers', enclose='$enclose' where form_id=$form_id") OR die("Error: ".$labour->error);	
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
	$nature_work=clean($_POST["nature_work"]);$father_name=clean($_POST["father_name"]);$max_workers=clean($_POST["max_workers"]);
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
	else $manager=NULL;
	if(!empty($_POST["contractor"])) $contractor=json_encode($_POST["contractor"]);
	else $contractor=NULL;
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,nature_work,father_name,manager,contractor,max_workers) values ('$swr_id','$today','$nature_work','$father_name', '$manager','$contractor','$max_workers')") OR die("Error: ".$labour->error);
		$form_id = $labour->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today',nature_work='$nature_work', father_name='$father_name', manager='$manager',contractor='$contractor',max_workers='$max_workers' where user_id='$swr_id' and form_id=$form_id") OR die("Error: ".$labour->error);
	}
	if($query){
	    if($input_size1!=0){					
			$k=$labour->query("delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
	        }
	    }
		if($input_size2!=0){					
			$k=$labour->query("delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$valf=$_POST["txttF".$i];
				$valg=$_POST["txttG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
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
			window.location.href = 'lc_reg_form3.php';
		</script>";
	}	
}			

if(isset($_POST["save4"])){
	$total_grant=clean($_POST["total_grant"]);$max_workers=clean($_POST["max_workers"]);$input_size=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);	
	if(!empty($_POST["tr"])) $tr=json_encode($_POST["tr"]);
	else $tr=NULL;
	
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){				
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,total_grant,max_workers,tr) values ('$swr_id','$today','$total_grant', '$max_workers','$tr')") OR die("Error: 1".$labour->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', total_grant='$total_grant', max_workers='$max_workers',tr='$tr'where form_id=$form_id") OR die("Error: 2 ".$labour->error);
	}		
	if($query){
		if(!isset($form_id)) $form_id = $labour->insert_id;
		if($input_size!=0){					
			$k=$labour->query("delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];		
				$part1=$labour->query("INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')")  OR die("Error: 1".$labour->error);
			}
		}
		if($input_size2!=0){					
			$k=$labour->query("delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$valf=$_POST["txttF".$i];
				$valg=$_POST["txttG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')")  OR die("Error: 2".$labour->error);
			}
		}
		if($input_size3!=0){					
			$k=$labour->query("delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["textA".$i];	*/						
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t3(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
			}
		}
		if($input_size4!=0){					
			$k=$labour->query("delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["texttB".$i];
				$valc=$_POST["texttC".$i];
				$vald=$_POST["texttD".$i];
				$vale=$_POST["texttE".$i];
				$valf=$_POST["texttF".$i];
				$valg=$_POST["texttG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t4(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
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
	$father_name=clean($_POST["father_name"]);$nature_work=clean($_POST["nature_work"]);$max_workers=clean($_POST["max_workers"]);$commencement_date=clean($_POST["commencement_date"]);$completion_date=clean($_POST["completion_date"]);
	if(!empty($_POST["particular"])) $particular=json_encode($_POST["particular"]);
		else $particular=NULL;
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
		else $manager=NULL;
			
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :".$labour->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,father_name,nature_work,max_workers,commencement_date,manager,completion_date,particular) values ('$swr_id','$today','$father_name', '$nature_work','$max_workers','$commencement_date','$manager','$completion_date','$particular')") OR die("Error: ".$labour->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', father_name='$father_name', nature_work='$nature_work',max_workers='$max_workers',commencement_date='$commencement_date',manager='$manager',completion_date='$completion_date',particular='$particular' where form_id=$form_id") OR die("Error: ".$labour->error);	
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
	$fa_sp_name=clean($_POST["fa_sp_name"]);$employer_name=clean($_POST["employer_name"]);$dob_con=clean($_POST["dob_con"]);$age_con=clean($_POST["age_con"]);
	$dob_con=date("y-m-d",strtotime($dob_con));
	if(!empty($_POST["employ_address"]))	 $employ_address=json_encode($_POST["employ_address"]);
	else	$employ_address=NULL;		
		
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,fa_sp_name,dob_con,age_con,employer_name,employ_address) values ('$swr_id','$today', '$fa_sp_name', '$dob_con', '$age_con','$employer_name','$employ_address')") OR die("Error: ".$labour->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', fa_sp_name='$fa_sp_name', dob_con='$dob_con', age_con='$age_con',employer_name='$employer_name' ,employ_address='$employ_address' where form_id=$form_id") OR die("Error: ".$labour->error);				
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
    $max_workers=clean($_POST["max_workers"]);$is_contractor_convict=clean($_POST["is_contractor_convict"]);
    if(!empty($_POST["contract_labour"])) $contract_labour=json_encode($_POST["contract_labour"]);
		else $contract_labour=NULL;		
    if(!empty($_POST["manager_address"])) $manager_address=json_encode($_POST["manager_address"]);
		else $manager_address=NULL;		
			
    $sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];				
		$query=$labour->query("update ".$table_name." set sub_date='$today', max_workers='$max_workers',is_contractor_convict='$is_contractor_convict',contract_labour='$contract_labour',manager_address='$manager_address' where form_id=$form_id") OR die("Error: ".$labour->error);				
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
    $is_contractor_revok=clean($_POST["is_contractor_revok"]);$is_contractor_work=clean($_POST["is_contractor_work"]);$is_cert_enclose=clean($_POST["is_cert_enclose"]);
	if(!empty($_POST["treasury_challan"])) $treasury_challan=json_encode($_POST["treasury_challan"]);
		else $treasury_challan=NULL;		
	if(!empty($_POST["security_deposit"])) $security_deposit=json_encode($_POST["security_deposit"]);
		else $security_deposit=NULL;		
			
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];				
		$query=$labour->query("update ".$table_name." set sub_date='$today',is_contractor_revok='$is_contractor_revok',is_contractor_work='$is_contractor_work',is_cert_enclose='$is_cert_enclose',treasury_challan='$treasury_challan',security_deposit='$security_deposit' where user_id='$swr_id'") OR die("Error: ".$labour->error);				
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
    $fa_sp_name=clean($_POST["fa_sp_name"]);$dob_con=clean($_POST["dob_con"]);$age_con=clean($_POST["age_con"]);$type_of_business=clean($_POST["type_of_business"]);
	if(!empty($_POST["employ"]))	 $employ=json_encode($_POST["employ"]);
		else	$employ=NULL;
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,fa_sp_name,dob_con,age_con,type_of_business,employ) values ('$swr_id','$today', '$fa_sp_name', '$dob_con', '$age_con', '$type_of_business','$employ')") OR die("Error: ".$labour->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', fa_sp_name='$fa_sp_name', dob_con='$dob_con', age_con='$age_con', type_of_business='$type_of_business',employ='$employ' where form_id=$form_id") OR die("Error: ".$labour->error);	
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
	$input_size=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$max_workers=clean($_POST["max_workers"]);
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
	else $manager=NULL;
	if(!empty($_POST["mig_workmen"])) $mig_workmen=json_encode($_POST["mig_workmen"]);
	else $mig_workmen=NULL;		
			
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'lc_licence_form7.php';
			</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', manager='$manager',mig_workmen='$mig_workmen',max_workers='$max_workers' where form_id=$form_id") OR die("Error: ".$labour->error);	
	}		
	if($query){
		if($input_size!=0){					
			$k=$labour->query("delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];			
				$part1=$labour->query("INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
			}
		}
		if($input_size2!=0){					
			$k=$labour->query("delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
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
    $cont_offence=clean($_POST["cont_offence"]);$dob3=clean($_POST["dob3"]);$work_con=clean($_POST["work_con"]);$enclosed_cert=clean($_POST["enclosed_cert"]);
		
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', cont_offence='$cont_offence', dob3='$dob3', work_con='$work_con', enclosed_cert='$enclosed_cert' where form_id=$form_id") OR die("Error: ".$labour->error);
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
    $fa_sp_name=clean($_POST["fa_sp_name"]);$dob_con=clean($_POST["dob_con"]);$age_con=clean($_POST["age_con"]);$type_of_business=clean($_POST["type_of_business"]);

	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,fa_sp_name,dob_con,age_con,type_of_business) values ('$swr_id','$today', '$fa_sp_name', '$dob_con', '$age_con', '$type_of_business')") OR die("Error1: ".$labour->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', fa_sp_name='$fa_sp_name', dob_con='$dob_con', age_con='$age_con', type_of_business='$type_of_business'  where user_id='$swr_id' and form_id=$form_id") OR die("Error2: ".$labour->error);	
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
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$max_workers=clean($_POST["max_workers"]);
	if(!empty($_POST["manager"])) $manager=json_encode($_POST["manager"]);
	else $manager=NULL;
	if(!empty($_POST["mig_workmen"])) $mig_workmen=json_encode($_POST["mig_workmen"]);
	else $mig_workmen=NULL;		
	
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', manager='$manager',mig_workmen='$mig_workmen' ,max_workers='$max_workers' where user_id='$swr_id' and form_id=$form_id") OR die("Error: ".$labour->error);				
    }
	if($query){
		if($input_size1!=0){					
			$k=$labour->query("delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
			}
		}
		if($input_size2!=0){					
			$k=$labour->query("delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$valf=$_POST["txttF".$i];
				$valg=$_POST["txttG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
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
	$cont_offence=clean($_POST["cont_offence"]);$dob3=clean($_POST["dob3"]);$work_con=clean($_POST["work_con"]);$enclosed_cert=clean($_POST["enclosed_cert"]);
					
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', cont_offence='$cont_offence', dob3='$dob3', work_con='$work_con', enclosed_cert='$enclosed_cert' where user_id='$swr_id' and form_id=$form_id") OR die("Error: ".$labour->error);		
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
	$cert_number=clean($_POST["cert_number"]);
	$cert_date=clean($_POST["cert_date"]);
	if($cert_date!=""){
		$cert_date=date("Y-m-d",strtotime($cert_date));
	}else{
		$cert_date=NULL;
	}
	
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,cert_number,cert_date,situation) values ('$swr_id','$today','$cert_number', '$cert_date','$situation')") OR die("Error: ".$labour->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', cert_number='$cert_number', cert_date='$cert_date',situation='$situation' where user_id='$swr_id' and form_id='$form_id'") OR die("Error: ".$labour->error);		
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
	$manager_name=clean($_POST["manager_name"]);
	if(isset($_POST["hiddenval"]))	$input_size=$_POST["hiddenval"];
	else $input_size=0;	
	if(!empty($_POST["manager_address"])) $manager_address=json_encode($_POST["manager_address"]);
	else $manager_address=NULL;
	
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'lc_renewal_form9.php';
			</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', manager_name='$manager_name', manager_address='$manager_address' where form_id=$form_id") OR die("Error: ".$labour->error);	
	}		
	if($query){
		if($input_size!=0){					
			$k=$labour->query("delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];			
				$part1=$labour->query("INSERT INTO ".$table_name."_t1(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
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
	$estab_category=clean($_POST["estab_category"]);$max_workers=clean($_POST["max_workers"]);
	if(isset($_POST["hiddenval2"])) $input_size2=$_POST["hiddenval2"]; else $input_size2=0;
	if(isset($_POST["hiddenval3"])) $input_size3=$_POST["hiddenval3"]; else $input_size3=0;	
	
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'lc_renewal_form9.php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$query=$labour->query("update ".$table_name." set sub_date='$today', estab_category='$estab_category', max_workers='$max_workers' where form_id=$form_id") OR die("Error: ".$labour->error);
	}			
	if($query){
		if($input_size2!=0){					
			$k=$labour->query("delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t2(form_id,field1,field2,field3,field4,field5,field6,field7) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($labour->error);
			}
		}
		if($input_size3!=0){					
			$k=$labour->query("delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];
				$part2=$labour->query("INSERT INTO ".$table_name."_t3(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") or die($labour->error);
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
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty/////////////
		echo "<script>
				alert('Please fill up the first section of the form');
				window.location.href = 'lc_renewal_form9.php?tab=1';
			</script>";				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		if($input_size4!=0){					
			$k=$labour->query("delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txtttB".$i];
				$valc=$_POST["txtttC".$i];
				$vald=$_POST["txtttD".$i];
				$vale=$_POST["txtttE".$i];
				$part1=$labour->query("INSERT INTO ".$table_name."_t4(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") or die($mysqli->error);
			}
		}
		if($input_size5!=0){					
			$k=$labour->query("delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txttttB".$i];
				$valc=$_POST["txttttC".$i];
				$vald=$_POST["txttttD".$i];
				$vale=$_POST["txttttE".$i];
				$part2=$labour->query("INSERT INTO ".$table_name."_t5(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") or die($labour->error);
			}
		}
		if($input_size6!=0){					
			$k=$labour->query("delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["txtttttB".$i];
				$valc=$_POST["txtttttC".$i];
				$vald=$_POST["txtttttD".$i];
				$vale=$_POST["txtttttE".$i];
				$part3=$labour->query("INSERT INTO ".$table_name."_t6(form_id,field1,field2,field3,field4,field5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") or die($labour->error);
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
	$prev_lic_date=clean($_POST["prev_lic_date"]);$is_suspended=clean($_POST["is_suspended"]);$particulars=clean($_POST["particulars"]);$max_workers=clean($_POST["max_workers"]);
	if(!empty($_POST["license"])) $license=json_encode($_POST["license"]);
		else $license=NULL;

	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :".$labour->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,prev_lic_date,is_suspended,particulars,max_workers,license) values ('$swr_id','$today','$prev_lic_date','$is_suspended','$particulars','$max_workers','$license')") OR die("Error: ".$labour->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today',  prev_lic_date='$prev_lic_date',is_suspended='$is_suspended',particulars='$particulars',max_workers='$max_workers', license='$license', treasury='$treasury' where form_id=$form_id") OR die("Error: ".$labour->error);	
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
	$prev_lic_date=clean($_POST["prev_lic_date"]);$is_suspended=clean($_POST["is_suspended"]);$max_workers=clean($_POST["max_workers"]);
	if(!empty($_POST["license"])) $license=json_encode($_POST["license"]);
		else $license=NULL;
			
	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,prev_lic_date,is_suspended,license,max_workers) values ('$swr_id','$today', '$prev_lic_date','$is_suspended','$license','$max_workers')") OR die("Error: ".$labour->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today', prev_lic_date='$prev_lic_date',is_suspended='$is_suspended', license='$license', max_workers='$max_workers' where  form_id=$form_id") OR die("Error: ".$labour->error);	
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
	$motor_trns_name=clean($_POST["motor_trns_name"]);$nature=clean($_POST["nature"]);$tot_no=clean($_POST["tot_no"]);$tot_route=clean($_POST["tot_route"]);$tot_n_motor=clean($_POST["tot_n_motor"]);$max_workers=clean($_POST["max_workers"]);$gm_name=clean($_POST["gm_name"]);$director_name=clean($_POST["director_name"]);$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["mt_address"])) $mt_address=json_encode($_POST["mt_address"]);
		else $mt_address=NULL;
	if(!empty($_POST["gm_address"])) $gm_address=json_encode($_POST["gm_address"]);
		else $gm_address=NULL;
	if(!empty($_POST["director_address"])) $director_address=json_encode($_POST["director_address"]);
		else $director_address=NULL;

	$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :".$labour->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$labour->query("insert into ".$table_name."(user_id,sub_date,motor_trns_name,mt_address,nature,tot_no,tot_route,tot_n_motor,max_workers,gm_name,gm_address,director_name,director_address) values ('$swr_id','$today','$motor_trns_name','$mt_address','$nature','$tot_no','$tot_route','$tot_n_motor','$max_workers','$gm_name','$gm_address','$director_name','$director_address')") OR die("Error: ".$labour->error);
		$form_id=$labour->insert_id;

		$k=$labour->query("delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
				
			$query1=$labour->query("INSERT INTO ".$table_name."_members(form_id,slno,name,sn1,sn2,v,d,p) VALUES ('$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')") or die($labour->error);
		}
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$labour->query("update ".$table_name." set sub_date='$today',  motor_trns_name='$motor_trns_name',mt_address='$mt_address',tot_no='$tot_no',nature='$nature', tot_route='$tot_route', tot_n_motor='$tot_n_motor', max_workers='$max_workers', gm_name='$gm_name', gm_address='$gm_address', director_name='$director_name', director_address='$director_address' where form_id=$form_id") OR die("Error: ".$labour->error);	
			
		$k=$labour->query("delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$labour->query("INSERT INTO ".$table_name."_members(form_id,slno,name,sn1,sn2,v,d,p) VALUES ('$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')") or die($labour->error);
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
		$motor_trns_name=clean($_POST["motor_trns_name"]);$nature=clean($_POST["nature"]);$tot_no=clean($_POST["tot_no"]);$tot_route=clean($_POST["tot_route"]);$tot_n_motor=clean($_POST["tot_n_motor"]);$max_workers=clean($_POST["max_workers"]);$gm_name=clean($_POST["gm_name"]);$director_name=clean($_POST["director_name"]);$hidden_value=clean($_POST["hidden_value"]);
		$reg_fees=40;			
		if(!empty($_POST["mt_address"])) $mt_address=json_encode($_POST["mt_address"]);
		else $mt_address=NULL;
		
		if(!empty($_POST["gm_address"])) $gm_address=json_encode($_POST["gm_address"]);
		else $gm_address=NULL;
		
		if(!empty($_POST["director_address"])) $director_address=json_encode($_POST["director_address"]);
		else $director_address=NULL;

		$sql=$labour->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :".$labour->error);
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
			$query=$labour->query("insert into 	".$table_name. "(user_id,sub_date,motor_trns_name,mt_address,nature,tot_no,tot_route,tot_n_motor,max_workers,gm_name,gm_address,director_name,director_address) values ('$swr_id','$today','$motor_trns_name','$mt_address','$nature','$tot_no','$tot_route','$tot_n_motor','$max_workers','$gm_name','$gm_address','$director_name','$director_address')") OR die("Error: ".$labour->error);
			$form_id=$labour->insert_id;
			$k=$labour->query("delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
				
				$query1=$labour->query("INSERT INTO ".$table_name."_members(form_id,slno,name,sn1,sn2,v,d,p) VALUES ('$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')") or die($labour->error);
				}
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$labour->query("update ".$table_name." set sub_date='$today',  motor_trns_name='$motor_trns_name',mt_address='$mt_address',tot_no='$tot_no',nature='$nature', tot_route='$tot_route', tot_n_motor='$tot_n_motor', max_workers='$max_workers', gm_name='$gm_name', gm_address='$gm_address', director_name='$director_name', director_address='$director_address' where form_id=$form_id") OR die("Error: ".$labour->error);	
			
			$k=$labour->query("delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
				
				$query1=$labour->query("INSERT INTO ".$table_name."_members(form_id,slno,name,sn1,sn2,v,d,p) VALUES ('$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')") or die($labour->error);
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
?>