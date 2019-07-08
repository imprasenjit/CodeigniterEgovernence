<?php
if(isset($_POST["save1a"])){
   $education_stage=implode(",",$_POST["education_stage"]);	
	$ins_name=clean($_POST["ins_name"]);$inst_location=clean($_POST["inst_location"]);$instutition_names=clean($_POST["instutition_names"]);$measure_land=clean($_POST["measure_land"]);$land_status=clean($_POST["land_status"]);$is_registration=clean($_POST["is_registration"]);
	$hidden_value=clean($_POST["hidden_value"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,education_stage,is_registration,ins_name,inst_location,instutition_names,measure_land,land_status) values ('$swr_id','$today', '$education_stage', '$is_registration', '$ins_name', '$inst_location','$instutition_names', '$measure_land', '$land_status')");
		$form_id=$query;
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$address','$pincode','$contact')");				
		}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', education_stage='$education_stage', is_registration='$is_registration', ins_name='$ins_name', inst_location='$inst_location',instutition_names='$instutition_names', measure_land='$measure_land', land_status='$land_status' where form_id=$form_id");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];			
			$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
if(isset($_POST["save1b"])){
		
	$proposed_scheme=clean($_POST["proposed_scheme"]);$capacity=clean($_POST["capacity"]);$is_residential=clean($_POST["is_residential"]);$time_frame=clean($_POST["time_frame"]);$academic=clean($_POST["academic"]);$project_cost=clean($_POST["project_cost"]);$funds=clean($_POST["funds"]);$fee_structure=clean($_POST["fee_structure"]);$finan_status=clean($_POST["finan_status"]);
	if(!empty($_POST["is_nonResidential"]))	 $is_nonResidential=json_encode($_POST["is_nonResidential"]);
	else	$is_nonResidential=NULL;
	if(!empty($_POST["semi_residential"]))	 $semi_residential=json_encode($_POST["semi_residential"]);
	else	$semi_residential=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,proposed_scheme,capacity,is_residential,time_frame,academic,project_cost,funds,fee_structure,finan_status,is_nonResidential) values ('$swr_id','$today', '$proposed_scheme', '$capacity', '$is_residential','$time_frame', '$academic', '$project_cost', '$funds','$fee_structure','$finan_status','$fee_max','$is_nonResidential','$semi_residential)");			
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', proposed_scheme='$proposed_scheme', capacity='$capacity', is_residential='$is_residential',time_frame='$time_frame', academic='$academic', project_cost='$project_cost', funds='$funds', fee_structure='$fee_structure', finan_status='$finan_status' , is_nonResidential='$is_nonResidential', semi_residential='$semi_residential' where form_id=$form_id");
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

if(isset($_POST["save2a"])){
     $education_stage=implode(",",$_POST["education_stage"]);
	 
	$inst_location=clean($_POST["inst_location"]);$affil=clean($_POST["affil"]);$land_status=clean( $_POST["land_status"]);$instruct=clean($_POST["instruct"]);$is_scheme=clean($_POST["is_scheme"]);$edu_level=clean($_POST["edu_level"]);

	if(!empty($_POST["is_comm_act"]))	 $is_comm_act=json_encode($_POST["is_comm_act"]);
	else	$is_comm_act=NULL;
	if(!empty($_POST["recog"]))	 $recog=json_encode($_POST["recog"]);
	else	$recog=NULL;
	if(!empty($_POST["is_inst_estd"]))	 $is_inst_estd=json_encode($_POST["is_inst_estd"]);
	else	$is_inst_estd=NULL;
	if(!empty($_POST["land"]))	 $land=json_encode($_POST["land"]);
	else	$land=NULL;
	if((isset($is_comm_act_a) && $is_comm_act_a=='Y')){
		$is_comm_act_b=clean($_POST["is_comm_act_b"]);
	}else{
		$is_comm_act_b="";
	}
	if((isset($is_inst_estd_a) && $is_inst_estd_a=='Y')){
		$is_inst_estd_b=clean($_POST["is_inst_estd_b"]);
	}else{
		$is_inst_estd_b="";
	}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,inst_location,affil,instruct,is_comm_act,is_inst_estd,land_status,is_scheme,recog,education_stage,edu_level,land) values ('$swr_id','$today', '$inst_location', '$affil','$instruct', '$is_comm_act', '$is_inst_estd', '$land_status', '$is_scheme', '$recog','$education_stage','$edu_level', '$land')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', inst_location='$inst_location', affil='$affil',instruct='$instruct', is_comm_act='$is_comm_act', is_inst_estd='$is_inst_estd', land_status='$land_status', is_scheme='$is_scheme', recog='$recog',education_stage='$education_stage',edu_level='$edu_level', land='$land' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
if(isset($_POST["save2b"])){		
	$intake_cap=clean($_POST["intake_cap"]);$no_students=clean($_POST["no_students"]);$is_available=clean($_POST["is_available"]);$is_water=clean($_POST["is_water"]);$managing_comm=clean($_POST["managing_comm"]);$play_material=clean($_POST["play_material"]);$teaching_aid=clean($_POST["teaching_aid"]);$no_books=clean($_POST["no_books"]);$co_curricular=clean($_POST["co_curricular"]);$is_commercial=clean($_POST["is_commercial"]);$is_commercial=clean($_POST["is_commercial"]);$other_info=clean($_POST["other_info"]);$fire_safety=clean($_POST["fire_safety"]);$lab_facility=clean($_POST["lab_facility"]);$is_admission=clean($_POST["is_admission"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$input_size3=$_POST["hiddenval3"];
	
	if(!empty($_POST["inst_loc"]))	 $inst_loc=json_encode($_POST["inst_loc"]);
	else	$inst_loc=NULL;
	if(!empty($_POST["board_result"]))	 $board_result=json_encode($_POST["board_result"]);
	else	$board_result=NULL;
	if(!empty($_POST["semi_residential"]))	 $semi_residential=json_encode($_POST["semi_residential"]);
	else	$semi_residential=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,intake_cap,no_students,board_result,is_available,is_water,managing_comm,play_material,teaching_aid,no_books,fire_safety,co_curricular,inst_loc,is_commercial,other_info,lab_facility,is_admission) values ('$swr_id','$today', '$intake_cap', '$no_students', '$board_result','$is_available', '$is_water', '$managing_comm', '$play_material','$teaching_aid','$no_books','$fire_safety','$co_curricular','$inst_loc','$is_commercial','$other_info','$lab_facility','$is_admission')");			
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', intake_cap='$intake_cap', no_students='$no_students', board_result='$board_result',is_available='$is_available', is_water='$is_water', managing_comm='$managing_comm', play_material='$play_material', teaching_aid='$teaching_aid', no_books='$no_books' , fire_safety='$fire_safety', co_curricular='$co_curricular', is_commercial='$is_commercial', other_info='$other_info', lab_facility='$lab_facility' , is_admission='$is_admission', inst_loc='$inst_loc' where form_id=$form_id");
	}		
	if($query){
		if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,no,size) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];				
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,particulars,fees) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];				
				$vald=$_POST["ttxtD".$i];				
				$vale=$_POST["ttxtE".$i];				
				$valf=$_POST["ttxtF".$i];				
				$valg=$_POST["ttxtG".$i];				
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,name,dob,qualification,dt_appt,salary,time) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
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

if(isset($_POST["save3a"])){		
	$name_of_indiv=clean($_POST["name_of_indiv"]);$location=clean( $_POST["location"]);$date_of_prior=clean($_POST["date_of_prior"]);$date_of_reg=clean($_POST["date_of_reg"]);$stage_of_edu=clean($_POST["stage_of_edu"]);$steam_n_subjects=clean($_POST["steam_n_subjects"]);$medium_of_ins=clean($_POST["medium_of_ins"]);$recognized_school=clean($_POST["recognized_school"]);
	
	 $education_stage=implode(",",$_POST["education_stage"]);
	
	if(!empty($_POST["authority"]))	 $authority=json_encode($_POST["authority"]);
	else	$authority=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,authority,name_of_indiv,location,date_of_prior,date_of_reg,education_stage,stage_of_edu,steam_n_subjects,medium_of_ins,recognized_school) values ('$swr_id','$today', '$authority', '$name_of_indiv','$location', '$date_of_prior', '$date_of_reg', '$education_stage', '$stage_of_edu', '$steam_n_subjects', '$medium_of_ins', '$recognized_school')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', authority='$authority', name_of_indiv='$name_of_indiv',location='$location', date_of_prior='$date_of_prior', date_of_reg='$date_of_reg',education_stage='$education_stage', stage_of_edu='$stage_of_edu', steam_n_subjects='$steam_n_subjects', medium_of_ins='$medium_of_ins', recognized_school='$recognized_school' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
if(isset($_POST["save3b"])){		
	$is_institution=clean($_POST["is_institution"]);$constitution=clean($_POST["constitution"]);$is_scheme=clean($_POST["is_scheme"]);$camp_area=clean($_POST["camp_area"]);$type_of_building=clean($_POST["type_of_building"]);$accomodation=clean($_POST["accomodation"]);$no_n_size=clean($_POST["no_n_size"]);$drinking_water=clean($_POST["drinking_water"]);$total_area=clean($_POST["total_area"]);$sources_of_fund=clean($_POST["sources_of_fund"]);$reserved_fund=clean($_POST["reserved_fund"]);$mothly_income=clean($_POST["mothly_income"]);$monthly_expen=clean($_POST["monthly_expen"]);
	
	if(!empty($_POST["classroom"]))	 $classroom=json_encode($_POST["classroom"]);
	else	$classroom=NULL;	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_institution,constitution,is_scheme,camp_area,type_of_building,accomodation,no_n_size,drinking_water,classroom,total_area,total_area,sources_of_fund,reserved_fund,mothly_income,monthly_expen) values ('$swr_id','$today', '$is_institution', '$constitution', '$is_scheme','$camp_area', '$type_of_building', '$accomodation', '$no_n_size','$drinking_water','$classroom','$total_area','$total_area','$sources_of_fund','$reserved_fund','$mothly_income','$monthly_expen')");			
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_institution='$is_institution', constitution='$constitution', is_scheme='$is_scheme',camp_area='$camp_area', type_of_building='$type_of_building', accomodation='$accomodation', no_n_size='$no_n_size', drinking_water='$drinking_water', classroom='$classroom' , total_area='$total_area', sources_of_fund='$sources_of_fund', reserved_fund='$reserved_fund', mothly_income='$mothly_income', monthly_expen='$monthly_expen'  where form_id=$form_id");
	}
	if($query){
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save3c"])){		
	$is_admission=clean($_POST["is_admission"]);$is_religious=clean($_POST["is_religious"]);
	$details_of_curriculm=clean($_POST["details_of_curriculm"]);$facility_available=clean($_POST["facility_available"]);$is_manage=clean($_POST["is_manage"]);$charges=clean($_POST["charges"]);$no_f_student=clean($_POST["no_f_student"]);$physical_education=clean($_POST["physical_education"]);$medical_facility=clean($_POST["medical_facility"]);$co_curricular=clean($_POST["co_curricular"]);$other_info=clean($_POST["other_info"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_admission,is_religious,details_of_curriculm,facility_available,is_manage,charges,no_f_student,physical_education,medical_facility,co_curriercular,other_info) values ('$swr_id','$today', '$is_admission', '$is_religious', '$details_of_curriculm','$facility_available', '$is_manage', '$charges', '$no_f_student','$physical_education','$medical_facility','$co_curriercular','$other_info')");					
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_admission='$is_admission', is_religious='$is_religious', details_of_curriculm='$details_of_curriculm',facility_available='$facility_available', is_manage='$is_manage', charges='$charges', no_f_student='$no_f_student', physical_education='$physical_education', medical_facility='$medical_facility' , co_curricular='$co_curricular', other_info='$other_info' where form_id=$form_id");
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,section,no_f_student,avg_attendance) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];				
				$vald=$_POST["textD".$i];				
				$vale=$_POST["textE".$i];				
				$valf=$_POST["textF".$i];				
				$valg=$_POST["textG".$i];				
				$valh=$_POST["textH".$i];				
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,dob,qualification,subject,date_of_appoin,present_pay,time) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')");
			}
		}
		if((isset($part1) && $part1==false) || (isset($part2) && $part2==false)){
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
		}else{
		 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";	
		}
	}else{
		   echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			   </script>";
	}	
}
?>