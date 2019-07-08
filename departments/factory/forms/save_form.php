<?php
if(isset($_POST["save1"])){		
	$fac_situation=clean($_POST["fac_situation"]);$province=clean($_POST["province"]);$vill3=clean($_POST["vill3"]);$dist3=clean($_POST["dist3"]);$pin3=clean($_POST["pin3"]);$m_no=clean($_POST["m_no"]);$n_rail_station=clean($_POST["n_rail_station"]);$particulars=clean($_POST["particulars"]);$is_hazardous=clean($_POST["is_hazardous"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from factory_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into factory_form1(user_id,sub_date,fac_situation,province,vill3,dist3,pin3,m_no,n_rail_station,particulars,is_hazardous) values ('$swr_id','$today', '$fac_situation', '$province', '$vill3','$dist3', '$pin3', '$m_no', '$n_rail_station', '$particulars','$is_hazardous')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update factory_form1 set sub_date='$today',fac_situation='$fac_situation',province='$province', vill3='$vill3',dist3='$dist3', pin3='$pin3',m_no='$m_no',n_rail_station='$n_rail_station',particulars='$particulars',is_hazardous='$is_hazardous' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($is_hazardous=="Y"){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'factory_form3.php';
		</script>";	
		}else{
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
		}				
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}							
}

if(isset($_POST["save2a"])){
    $risk_category=clean($_POST["risk_category"]);				
	if(!empty($_POST["manuf_process"])) $manuf_process=json_encode($_POST["manuf_process"]);
	else $manuf_process=NULL;
	if(!empty($_POST["manuf_prod"])) $manuf_prod=json_encode($_POST["manuf_prod"]);
	else $manuf_prod=NULL;
	if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
	else	$power=NULL;
	if(!empty($_POST["manager"]))	 $manager=json_encode($_POST["manager"]);
	else	$manager=NULL;
	if(!empty($_POST["communication_address"]))	 $communication_address=json_encode($_POST["communication_address"]);
	else	$communication_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from factory_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows == 0){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into factory_form2(user_id,sub_date,communication_address,manuf_process,manuf_prod,power,manager,risk_category) values ('$swr_id','$today','$communication_address','$manuf_process','$manuf_prod', '$power', '$manager','$risk_category')");		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update factory_form2 set sub_date='$today',communication_address='$communication_address',  manuf_process='$manuf_process', manuf_prod='$manuf_prod', power='$power', manager='$manager',risk_category='$risk_category' where form_id=$form_id");
	}
	if($query){
		$formFunctions->insert_incomplete_forms('factory','2'); //factory-- dept name and 2 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'factory_form2.php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'factory_form2.php?tab=1';
		</script>";
	}					
}
if(isset($_POST["save2b"])){	
	$managing_agents=clean($_POST['managing_agents']);$cah=clean($_POST["cah"]);	
	if(!empty($_POST["owner"]))	 $owner=json_encode($_POST["owner"]);
	else	$owner=NULL;
	if(!empty($_POST["ref_no"]))	 $ref_no=json_encode($_POST["ref_no"]);
	else	$ref_no=NULL;
	if(!empty($_POST["occupier"]))	 $occupier=json_encode($_POST["occupier"]);
	else	$occupier=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from factory_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into factory_form2(user_id,sub_date,occupier,managing_agents,cah,owner,ref_no) values ('$swr_id','$today','$occupier','$managing_agents','$cah','$owner','$ref_no')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update factory_form2 set sub_date='$today',occupier='$occupier',managing_agents='$managing_agents',cah='$cah',owner='$owner',ref_no='$ref_no' where user_id='$swr_id' and form_id=$form_id");				
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

if(isset($_POST["save3a"])) {
	if(!empty($_POST["ownership_data"])) $ownership_data=json_encode($_POST["ownership_data"]);
	else $ownership_data=NULL;
	if(!empty($_POST["site_plan"]))	 $site_plan=json_encode($_POST["site_plan"]);
	else	$site_plan=NULL;
	if(!empty($_POST["project_report"])) $project_report=json_encode($_POST["project_report"]);
	else $project_report=NULL;
	if(!empty($_POST["org_structure"]))	 $org_structure=json_encode($_POST["org_structure"]);
	else	$org_structure=NULL;
	if(!empty($_POST["supply"]))	 $supply=json_encode($_POST["supply"]);
	else	$supply=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select * from factory_form3 where form_id='$form_id'");			
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into factory_form3(form_id,ownership_data,site_plan,project_report,org_structure,supply) values ('$form_id', '$ownership_data', '$site_plan', '$project_report', '$org_structure', '$supply')");
	}else{  ////////////table is not empty//////////////	
		$query=$formFunctions->executeQuery($dept,"update factory_form3 set ownership_data='$ownership_data', site_plan='$site_plan', project_report='$project_report', org_structure='$org_structure', supply='$supply' where form_id=$form_id");				
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'factory_form3.php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'factory_form3.php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save3b"])){
	$form_id=$formFunctions->executeQuery($dept,"select form_id from factory_form1 where user_id='$swr_id' and active='1'")->fetch_object()->form_id;
	$other_info=clean($_POST["other_info"]);
	if(!empty($_POST["comm_link"]))	$comm_link=json_encode($_POST["comm_link"]);
	else	$comm_link=NULL;		
	
	$sql=$formFunctions->executeQuery($dept,"select * from factory_form3 where form_id='$form_id'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into factory_form3(form_id,other_info,comm_link) values ('$form_id','$other_info','$comm_link')");
	}else{			
		$query=$formFunctions->executeQuery($dept,"UPDATE factory_form3 SET other_info='$other_info', comm_link='$comm_link' WHERE form_id='$form_id'");
	}
	if($query){
		 echo "<script>
		   alert('Successfully Saved.');
		   window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=1';
		</script>";					
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = 'factory_form3.php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save4a"])){		
	$license_no=clean($_POST["license_no"]);
	$risk_category=clean($_POST["risk_category"]);	
	if(!empty($_POST["manuf_process"])) $manuf_process=json_encode($_POST["manuf_process"]);
	else $manuf_process=NULL;
	if(!empty($_POST["manuf_prod"])) $manuf_prod=json_encode($_POST["manuf_prod"]);
	else $manuf_prod=NULL;	
	if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
	else	$power=NULL;	
	if(!empty($_POST["manager"]))	 $manager=json_encode($_POST["manager"]);
	else	$manager=NULL;	
	if(!empty($_POST["communication_address"]))	 $communication_address=json_encode($_POST["communication_address"]);
	else	$communication_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from factory_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into factory_form4(user_id,sub_date,license_no,manuf_process,manuf_prod,power,manager,risk_category,communication_address) values ('$swr_id','$today', '$license_no','$manuf_process', '$manuf_prod', '$power', '$manager','$risk_category','$communication_address')");				
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update factory_form4 set sub_date='$today', license_no='$license_no',  manuf_process='$manuf_process', manuf_prod='$manuf_prod', power='$power', manager='$manager',risk_category='$risk_category',communication_address='$communication_address' where form_id=$form_id");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //factory-- dept name and 2 -- form no
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'factory_form4.php?tab=2';
		</script>";					
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'factory_form4.php?tab=1';
		</script>";
	}
}
if(isset($_POST["save4b"])){
	$managing_agents=clean($_POST['managing_agents']);$cah=clean($_POST['cah']);
	if(!empty($_POST["owner"]))	 $owner=json_encode($_POST["owner"]);
	else	$owner=NULL;
	if(!empty($_POST["ref_no"]))	 $ref_no=json_encode($_POST["ref_no"]);
	else	$ref_no=NULL;			
	if(!empty($_POST["occupier"]))	 $occupier=json_encode($_POST["occupier"]);
	else	$occupier=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from factory_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into factory_form4(user_id,sub_date,occupier,managing_agents,cah,owner,ref_no) values ('$swr_id','$today','$occupier','$managing_agents','$cah','$owner','$ref_no')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update factory_form4 set sub_date='$today',occupier='$occupier',managing_agents='$managing_agents',cah='$cah',owner='$owner',ref_no='$ref_no' where user_id='$swr_id' and form_id=$form_id");				
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

if(isset($_POST["save5"])){
	$occupier_name=clean($_POST["occupier_name"]);$manager_name=clean($_POST["manager_name"]);$sub_division=clean($_POST["sub_division"]);$nature=clean($_POST["nature"]);$no_of_days=clean($_POST["no_of_days"]);
	
	if(!empty($_POST["mandays"])) $mandays=json_encode($_POST["mandays"]);
	else $mandays=NULL;	
	if(!empty($_POST["workers"])) $workers=json_encode($_POST["workers"]);
	else $workers=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		 $query =$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,occupier_name,manager_name,sub_division,nature,no_of_days,mandays,workers) values ('$swr_id','$today','$occupier_name','$manager_name','$sub_division','$nature','$no_of_days','$mandays','$workers')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',occupier_name='$occupier_name',manager_name='$manager_name',sub_division='$sub_division',nature='$nature',no_of_days='$no_of_days',mandays='$mandays',workers='$workers' where form_id=$form_id");		
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

if(isset($_POST["save6a"])){
    $year_ending=clean($_POST["year_ending"]);$reg_no=clean($_POST["reg_no"]);$district=clean($_POST["district"]);$sub_division=clean($_POST["sub_division"]);$industry_nature=clean($_POST["industry_nature"]);$is_factory=clean($_POST["is_factory"]);$input_size1=$_POST["hiddenval"];
	
	if(!empty($_POST["name"])) $name=json_encode($_POST["name"]);
	else $name=NULL;	
	if(!empty($_POST["day"])) $day=json_encode($_POST["day"]);
	else $day=NULL;	
	if(!empty($_POST["adult"])) $adult=json_encode($_POST["adult"]);
	else $adult=NULL;	
	if(!empty($_POST["adole"])) $adole=json_encode($_POST["adole"]);
	else $adole=NULL;	
	if(!empty($_POST["children"])) $children=json_encode($_POST["children"]);
	else $children=NULL;	
	if(!empty($_POST["hours1"])) $hours1=json_encode($_POST["hours1"]);
	else $hours1=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows == 0){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,year_ending,reg_no,district,sub_division,name,industry_nature,day,adult,adole,children,hours1,is_factory) values ('$swr_id','$today','$year_ending','$reg_no','$district','$sub_division','$name','$industry_nature','$day','$adult','$adole','$children','$hours1','$is_factory')");
        $form_id=$query;	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',year_ending='$year_ending',reg_no='$reg_no',district='$district',sub_division='$sub_division',name='$name',industry_nature='$industry_nature',day='$day',adult='$adult',adole='$adole',children='$children',hours1='$hours1',is_factory='$is_factory' where form_id=$form_id");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,dangerous_process,avg_num_person) VALUES ('','$form_id','$i','$valb','$valc')") ;
			}
		}
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
if(isset($_POST["save6b"])){	
	$number_workers=clean($_POST["number_workers"]);$is_ambulance=clean($_POST["is_ambulance"]);$is_provided=clean($_POST["is_provided"]);$departmental=clean($_POST["departmental"]);$contractor=clean($_POST["contractor"]);$is_adequate=clean($_POST["is_adequate"]);$is_creche=clean($_POST["is_creche"]);$number_acci=clean($_POST["number_acci"]);$is_suggestion=clean($_POST["is_suggestion"]);$num_suggestion=clean($_POST["num_suggestion"]);$case_prize=clean($_POST["case_prize"]);$mondays_lost=clean($_POST["mondays_lost"]);
	
	if(!empty($_POST["hours"])) $hours=json_encode($_POST["hours"]);
	else $hours=NULL;	
	if(!empty($_POST["number"])) $number=json_encode($_POST["number"]);
	else $number=NULL;	
	if(!empty($_POST["welfare"])) $welfare=json_encode($_POST["welfare"]);
	else $welfare=NULL;	
	if(!empty($_POST["accidents"])) $accidents=json_encode($_POST["accidents"]);
	else $accidents=NULL;	
	if(!empty($_POST["previous"])) $previous=json_encode($_POST["previous"]);
	else $previous=NULL;
	if(!empty($_POST["thisyr"])) $thisyr=json_encode($_POST["thisyr"]);
	else $thisyr=NULL;	
	if(!empty($_POST["awarded"])) $awarded=json_encode($_POST["awarded"]);
	else $awarded=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,hours,number_workers,number,is_ambulance,is_provided,departmental,contractor,is_adequate,is_creche,welfare,accidents,number_acci,mondays_lost,previous,thisyr,is_suggestion,num_suggestion,case_prize,awarded) values ('$swr_id','$today','$hours','$number_workers','$number','$is_ambulance','$is_provided','$departmental','$contractor','$is_adequate','$is_creche','$welfare','$accidents','$number_acci','$mondays_lost','$previous','$thisyr','$is_suggestion','$num_suggestion','$case_prize','$awarded')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',hours='$hours',number_workers='$number_workers',number='$number',is_ambulance='$is_ambulance',is_provided='$is_provided',departmental='$departmental',contractor='$contractor',is_adequate='$is_adequate',is_creche='$is_creche',welfare='$welfare',accidents='$accidents',number_acci='$number_acci',mondays_lost='$mondays_lost',previous='$previous',thisyr='$thisyr',is_suggestion='$is_suggestion',num_suggestion='$num_suggestion',case_prize='$case_prize',awarded='$awarded' where form_id=$form_id");				
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

if(isset($_POST["save7"])){
	$nature_of_industry=clean($_POST["nature_of_industry"]);$name_patient=clean($_POST["name_patient"]);$works_no_patient=clean($_POST["works_no_patient"]);$sex=clean($_POST["sex"]);$age=clean($_POST["age"]);$occupation=clean($_POST["occupation"]);$nature_of_poison=clean($_POST["nature_of_poison"]);$is_reported=clean($_POST["is_reported"]);	
	
	if(!empty($_POST["patient"])) $patient=json_encode($_POST["patient"]);
	else $patient=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,nature_of_industry,name_patient,works_no_patient,patient,sex,age,occupation,nature_of_poison,is_reported) values ('$swr_id','$today','$nature_of_industry','$name_patient','$works_no_patient','$patient','$sex','$age','$occupation','$nature_of_poison','$is_reported')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',nature_of_industry='$nature_of_industry',name_patient='$name_patient',works_no_patient='$works_no_patient',patient='$patient',sex='$sex',age='$age',occupation='$occupation',nature_of_poison='$nature_of_poison',is_reported='$is_reported' where form_id=$form_id");		
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

if(isset($_POST["save8"])){
	$input_size1=$_POST["hiddenval"];
	$department=clean($_POST["department"]);$mark=clean($_POST["mark"]);$position=clean($_POST["position"]);
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,department,mark,position) values ('$swr_id','$today','$department','$mark','$position')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',department='$department',mark='$mark',position='$position' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");		
			for($i=1;$i<$input_size1;$i++){
				$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];
				$vali=$_POST["txtI".$i];
				$valj=$_POST["txtJ".$i];
	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,dt_mon,year,dry1,wet1,dry2,wet2,dry3,wet3,humidity,remarks) VALUES ('','$form_id','$vala','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");	
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

if(isset($_POST["save9"])){
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	$serial_no=clean($_POST["serial_no"]);$works_no=clean($_POST["works_no"]);$worker_name=clean($_POST["worker_name"]);$sex=clean($_POST["sex"]);$age=clean($_POST["age"]);$employ_date=clean($_POST["employ_date"]);$leave_date=clean($_POST["leave_date"]);$reason=clean($_POST["reason"]);$nature=clean($_POST["nature"]);$raw_material=clean($_POST["raw_material"]);$sus_period=clean($_POST["sus_period"]);$sus_reason=clean($_POST["sus_reason"]);$resume_dt=clean($_POST["resume_dt"]);$is_issued=clean($_POST["is_issued"]);$surgeon_sign=clean($_POST["surgeon_sign"]);	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,serial_no,works_no,worker_name,sex,age,employ_date,leave_date,reason,nature,raw_material,sus_period,sus_reason,resume_dt,is_issued,surgeon_sign) values ('$swr_id','$today','$serial_no','$works_no','$worker_name','$sex','$age','$employ_date','$leave_date','$reason','$nature','$raw_material','$sus_period','$sus_reason','$resume_dt','$is_issued','$surgeon_sign')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',serial_no='$serial_no',works_no='$works_no',worker_name='$worker_name',sex='$sex',age='$age',employ_date='$employ_date',leave_date='$leave_date',reason='$reason',nature='$nature',raw_material='$raw_material',sus_period='$sus_period',sus_reason='$sus_reason',resume_dt='$resume_dt',is_issued='$is_issued',surgeon_sign='$surgeon_sign' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,from_dt,to_dt) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,exam_dt,result) VALUES ('','$form_id','$i','$valb','$valc')") ;
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

if(isset($_POST["save10"])){
	$input_size1=$_POST["hiddenval"];$manager_sign=clean($_POST["manager_sign"]);	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,manager_sign) values ('$swr_id','$today','$manager_sign')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',manager_sign='$manager_sign' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,parts,treat,treat_date,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") ;
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

if(isset($_POST["save11"])){											
	$occupier_name=clean($_POST["occupier_name"]);$situation=clean($_POST["situation"]);$nature=clean($_POST["nature"]);$is_expose=clean($_POST["is_expose"]);$inaccessible=clean($_POST["inaccessible"]);$exam=clean($_POST["exam"]);$is_provided=clean($_POST["is_provided"]);$is_maintain=clean($_POST["is_maintain"]);$working_pressure=clean($_POST["working_pressure"]);$certify=clean($_POST["certify"]);$sign=clean($_POST["sign"]);$qual=clean($_POST["qual"]);$address=clean($_POST["address"]);
	
	if(!empty($_POST["vessel"])) $vessel=json_encode($_POST["vessel"]);
	else $vessel=NULL;
	if(!empty($_POST["manuf"])) $manuf=json_encode($_POST["manuf"]);
	else $manuf=NULL;
	if(!empty($_POST["particulars"]))	 $particulars=json_encode($_POST["particulars"]);
	else	$particulars=NULL;
	if(!empty($_POST["test"]))	 $test=json_encode($_POST["test"]);
	else	$test=NULL;
	if(!empty($_POST["conditions"]))	 $conditions=json_encode($_POST["conditions"]);
	else	$conditions=NULL;
	if(!empty($_POST["safe"]))	 $safe=json_encode($_POST["safe"]);
	else	$safe=NULL;
	if(!empty($_POST["pressure"]))	 $pressure=json_encode($_POST["pressure"]);
	else	$pressure=NULL;
	if(!empty($_POST["employ"]))	 $employ=json_encode($_POST["employ"]);
	else	$employ=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,occupier_name,situation,nature,is_expose,inaccessible,exam,is_provided,is_maintain,working_pressure,certify,sign,qual,address,vessel,manuf,particulars,test,conditions,safe,pressure,employ) values ('$swr_id','$today','$occupier_name','$situation','$nature','$is_expose','$inaccessible','$exam','$is_provided','$is_maintain','$working_pressure','$certify','$sign','$qual','$address','$vessel','$manuf','$particulars','$test','$conditions','$safe','$pressure','$employ')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',occupier_name='$occupier_name',situation='$situation',nature='$nature',is_expose='$is_expose',inaccessible='$inaccessible',exam='$exam',is_provided='$is_provided',is_maintain='$is_maintain',working_pressure='$working_pressure',certify='$certify',sign='$sign',qual='$qual',address='$address',vessel='$vessel',manuf='$manuf',particulars='$particulars',test='$test',conditions='$conditions',safe='$safe',pressure='$pressure',employ='$employ' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST["save12"])){
	$serial_no=clean($_POST["serial_no"]);$register=clean($_POST["register"]);$group_no=clean($_POST["group_no"]);$lost_days=clean($_POST["lost_days"]);$remarks=clean($_POST["remarks"]);
	
	if(!empty($_POST["worker"])) $worker=json_encode($_POST["worker"]);
	else $worker=NULL;
	if(!empty($_POST["exempt"])) $exempt=json_encode($_POST["exempt"]);
	else $exempt=NULL;
	if(!empty($_POST["days"]))	 $days=json_encode($_POST["days"]);
	else	$days=NULL;
	if(!empty($_POST["holiday"]))	 $holiday=json_encode($_POST["holiday"]);
	else	$holiday=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,serial_no,register,group_no,lost_days,remarks,worker,exempt,days,holiday) values ('$swr_id','$today','$serial_no','$register','$group_no','$lost_days','$remarks','$worker','$exempt','$days','$holiday')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',serial_no='$serial_no',register='$register',group_no='$group_no',lost_days='$lost_days',remarks='$remarks',worker='$worker',exempt='$exempt',days='$days',holiday='$holiday' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST["save13"])){
	$register_no=clean($_POST["register_no"]);$department=clean($_POST["department"]);$hours=clean($_POST["hours"]);$normal_rate=clean($_POST["normal_rate"]);$over_rate=clean($_POST["over_rate"]);$cash=clean($_POST["cash"]);$payment_dt=clean($_POST["payment_dt"]);	
	if(!empty($_POST["worker"])) $worker=json_encode($_POST["worker"]);
	else $worker=NULL;
	if(!empty($_POST["overtime"])) $overtime=json_encode($_POST["overtime"]);
	else $overtime=NULL;
	if(!empty($_POST["earning"]))	 $earning=json_encode($_POST["earning"]);
	else	$earning=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,register_no,department,hours,normal_rate,over_rate,cash,payment_dt,worker,overtime,earning) values ('$swr_id','$today','$register_no','$department','$hours','$normal_rate','$over_rate','$cash','$payment_dt','$worker','$overtime','$earning')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',register_no='$register_no',department='$department',hours='$hours',normal_rate='$normal_rate',over_rate='$over_rate',cash='$cash',payment_dt='$payment_dt',worker='$worker',overtime='$overtime',earning='$earning' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST["save15"])){
	$serial_no=clean($_POST["serial_no"]);$father_name=clean($_POST["father_name"]);$work_name=clean($_POST["work_name"]);$letter=clean($_POST["letter"]);$remarks=clean($_POST["remarks"]);$relay_no=clean($_POST["relay_no"]);$token_no=clean($_POST["token_no"]);
	
	if(!empty($_POST["worker"])) $worker=json_encode($_POST["worker"]);
	else $worker=NULL;
	if(!empty($_POST["certificate"])) $certificate=json_encode($_POST["certificate"]);
	else $certificate=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,serial_no,father_name,work_name,letter,remarks,worker,certificate,relay_no,token_no) values ('$swr_id','$today','$serial_no','$father_name','$work_name','$letter','$remarks','$worker','$certificate','$relay_no','$token_no')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',serial_no='$serial_no',father_name='$father_name',work_name='$work_name',letter='$letter',remarks='$remarks',worker='$worker',certificate='$certificate',relay_no='$relay_no',token_no='$token_no' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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