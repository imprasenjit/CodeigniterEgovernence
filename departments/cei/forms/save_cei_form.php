<?php
if(isset($_POST["save1"])){		
	$applicant_dob=clean($_POST["applicant_dob"]);$general_edu=clean($_POST["general_edu"]);$total_period=clean($_POST["total_period"]);$apprentice_period=clean($_POST["apprentice_period"]);
	if(!empty($_POST["father"])) $father=json_encode($_POST["father"]);
	else	$father=NULL;
	if(!empty($_POST["present_addr"]))	 $present_addr=json_encode($_POST["present_addr"]);
	else	$present_addr=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant_dob,father,present_addr,general_edu,total_period,apprentice_period) values ('$swr_id','$today', '$applicant_dob', '$father', '$present_addr','$general_edu', '$total_period', '$apprentice_period')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', applicant_dob='$applicant_dob', father='$father', present_addr='$present_addr',general_edu='$general_edu', total_period='$total_period', apprentice_period='$apprentice_period' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}						
}

if(isset($_POST["save2a"])){		
	$father_name=clean($_POST["father_name"]);$name_of_person=clean($_POST["name_of_person"]);$applicant_relation=clean($_POST["applicant_relation"]);
	if(!empty($_POST["present_addr"]))	 $present_addr=json_encode($_POST["present_addr"]);
	else	$present_addr=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,present_addr,name_of_person,applicant_relation) values ('$swr_id','$today', '$father_name', '$present_addr','$name_of_person', '$applicant_relation')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name',present_addr='$present_addr',name_of_person='$name_of_person', applicant_relation='$applicant_relation' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 1 -- form no 
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
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);
		$class_of_license=clean($_POST['class_of_license']);$particular_details=clean($_POST['particular_details']);
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
		}else{  ////////////table is not empty//////////////
				$form_id=$row["form_id"];
					$save_query="UPDATE ".$table_name." SET class_of_license='$class_of_license',particular_details='$particular_details' WHERE form_id='$form_id'";
					$query = $formFunctions->executeQuery($dept,$save_query) ;	
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
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,name,permanent_address,age,detail) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')") ;
				}
			}
			if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					/*$vala=$_POST["txxtA".$i];	*/		
					$valb=$_POST["txxtB".$i];
					$valc=$_POST["txxtC".$i];
					$vald=$_POST["txxtD".$i];
					$vale=$_POST["txxtE".$i];	
					$valf=$_POST["txxtF".$i];	
					$valg=$_POST["txxtG".$i];	
					$valh=$_POST["txxtH".$i];	
					$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,sl_no,name,permanent_address,joining_date,class,issue_date,expiry_date,fulltime) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')") ;
				}
			}
			if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
				for($i=1;$i<$input_size3;$i++){
					/*$vala=$_POST["txttA".$i];	*/		
					$valb=$_POST["txttB".$i];
					$valc=$_POST["txttC".$i];
					$vald=$_POST["txttD".$i];
					$vale=$_POST["txttE".$i];	
					$valf=$_POST["txttF".$i];	
					$valg=$_POST["txttG".$i];		
					$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,sl_no,name,makers_name,capacity,year,ins_no,quantitative) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") ;
				}
			}
			if(isset($part1) && $part1==false){
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=1';
				</script>";
			}else if(isset($part2) && $part2==false){
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=1';
				</script>";
			}else if(isset($part3) && $part3==false){
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=1';
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

if(isset($_POST["save3a"])){
			$use_of_building=clean($_POST["use_of_building"]);
			$builder_name=clean($_POST["builder_name"]);		
			$owner_name=clean($_POST["owner_name"]);		
			if(!empty($_POST["builder_address"])) $builder_address=json_encode($_POST["builder_address"]);
			else $builder_address=NULL;
			if(!empty($_POST["owner_address"]))	 $owner_address=json_encode($_POST["owner_address"]);
			else	$owner_address=NULL;
			if(!empty($_POST["mb_address"]))	 $mb_address=json_encode($_POST["mb_address"]);
			else	$mb_address=NULL;
			if(!empty($_POST["particular"]))	 $particular=json_encode($_POST["particular"]);
			else	$particular=NULL;
			
			$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
			$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,use_of_building,builder_name,builder_address,owner_name,owner_address,mb_address,particular) values ('$swr_id','$today','$today', '$use_of_building','$builder_name', '$builder_address', '$owner_name','$owner_address','$mb_address','$particular')") ;
		
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' , use_of_building='$use_of_building', builder_name='$builder_name',builder_address='$builder_address', owner_name='$owner_name', owner_address='$owner_address', mb_address='$mb_address', particular='$particular' where user_id='$swr_id' and form_id='$form_id'") ;
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 3 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}
if(isset($_POST["save3b"])){
			$is_applied=clean($_POST["is_applied"]);	
			if(!empty($_POST["elect_inst"])) $elect_inst=json_encode($_POST["elect_inst"]);
			else $elect_inst=NULL;
			if(!empty($_POST["control_room"]))	 $control_room=json_encode($_POST["control_room"]);
			else $control_room=NULL;
			
			$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
			$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,is_applied,elect_inst,control_room) values ('$swr_id','$today','$today','$is_applied','$elect_inst','$control_room')") ;

	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' , is_applied='$is_applied',elect_inst='$elect_inst', control_room='$control_room' where user_id='$swr_id' and form_id='$form_id'") ;
	}
	if($query){
		echo "<script>
				alert('Successfully saved.');
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
	$name_contractor=clean($_POST["name_contractor"]);
	$is_generator_plan=clean($_POST["is_generator_plan"]);$is_generator=clean($_POST["is_generator"]);$is_generator_plan1=clean($_POST["is_generator_plan1"]);$is_generator_plan2=clean($_POST["is_generator_plan2"]);
	if(!empty($_POST["contractor_address"])) $contractor_address=json_encode($_POST["contractor_address"]);
	else $contractor_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,courier_details,name_contractor,contractor_address,is_generator,is_generator_plan,is_generator_plan1,is_generator_plan2) values ('$swr_id','$today','$today',NULL,'$name_contractor','$contractor_address','$is_generator','$is_generator_plan','$is_generator_plan1','$is_generator_plan2')") ;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' , courier_details=NULL,name_contractor='$name_contractor',contractor_address='$contractor_address', is_generator='$is_generator', is_generator_plan='$is_generator_plan', is_generator_plan1='$is_generator_plan1',is_generator_plan2='$is_generator_plan2'  where user_id='$swr_id' and form_id='$form_id'") ;
	}
	if($query){
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}			
}

if(isset($_POST["save4a"])){		
	$father_name=clean($_POST["father_name"]);$name_of_license=clean($_POST["name_of_license"]);$applicant_relation=clean($_POST["applicant_relation"]);$dt_of_renew=clean($_POST["dt_of_renew"]);$dt_of_validity=clean($_POST["dt_of_validity"]);$any_other_info=clean($_POST["any_other_info"]);$license_detail_reg=clean($_POST["license_detail_reg"]);$license_detail_clas=clean($_POST["license_detail_clas"]);
	if(!empty($_POST["present_addr"]))	 $present_addr=json_encode($_POST["present_addr"]);
	else	$present_addr=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,present_addr,name_of_license,license_detail_reg,license_detail_clas,applicant_relation,dt_of_renew,dt_of_validity,any_other_info) values ('$swr_id','$today', '$father_name', '$present_addr','$name_of_license', '$license_detail_reg', '$license_detail_clas', '$applicant_relation', '$dt_of_renew', '$dt_of_validity', '$any_other_info')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', father_name='$father_name',present_addr='$present_addr',name_of_license='$name_of_license', license_detail_reg='$license_detail_reg',license_detail_clas='$license_detail_clas', applicant_relation='$applicant_relation', dt_of_renew='$dt_of_renew', dt_of_validity='$dt_of_validity', any_other_info='$any_other_info' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 4 -- form no 
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
if(isset($_POST["save4b"])){		
		$input_size1=clean($_POST["hiddenval"]);
		if(!empty($_POST["superviror_detail"]))	 $superviror_detail=json_encode($_POST["superviror_detail"]);
		else	$superviror_detail=NULL;
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,superviror_detail) values ('$swr_id','$today', '$superviror_detail')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', superviror_detail='$superviror_detail' where form_id=$form_id") ;	
		}
		if($query){
			if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_enclosure4 where form_id='$form_id'");
				for($i=1;$i<$input_size1;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$vale=$_POST["txtE".$i];	
					$valf=$_POST["txtF".$i];	
					$valg=$_POST["txtG".$i];	
					$valh=$_POST["txtH".$i];	
					$vali=$_POST["txtI".$i];		
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_enclosure4(form_id,sl_no,name,desig,supervisor,workman,apprentice,reg_no,parts,dt_of_val) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali')") ;
				}
			}
			
			if(isset($part1) && $part1==false){
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=3';
				</script>";
			}else{
				 echo "<script>
					alert('Successfully Saved..');
					window.location.href = '".$table_name.".php?tab=3';
				</script>";	
			}
		}
}
if(isset($_POST["save4c"])){		
		$input_size2=clean($_POST["hiddenval2"]);$year_to=clean($_POST["year_to"]);$year_from=clean($_POST["year_from"]);
		if(!empty($_POST["work_return"]))	 $work_return=json_encode($_POST["work_return"]);
		else	$work_return=NULL;
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,year_to,year_from,work_return) values ('$swr_id','$today','$year_to','$year_from', '$work_return')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',year_to='$year_to',year_from='$year_from', work_return='$work_return' where form_id=$form_id") ;	
		}
		if($query){
			if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_enclosure5 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					/*$vala=$_POST["txxtA".$i];	*/		
					$valb=$_POST["txxtB".$i];
					$valc=$_POST["txxtC".$i];
					$vald=$_POST["txxtD".$i];
					$vale=$_POST["txxtE".$i];	
					$valf=$_POST["txxtF".$i];	
					$valg=$_POST["txxtG".$i];	
					$valh=$_POST["txxtH".$i];	
					$vali=$_POST["txxtI".$i];		
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_enclosure5(form_id,sl_no,ref_no,address,certificate,workman,apprentice,dt_of_com,test_report,report) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali')") ;
				}
			}
			
			if(isset($part2) && $part2==false){
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
		}
}

if(isset($_POST["save5"])){		
	$ref=clean($_POST["ref"]);$year_no=clean($_POST["year_no"]);$ref_date=clean($_POST["ref_date"]);$work_done=clean($_POST["work_done"]);$contractor_reg=clean($_POST["contractor_reg"]);$class_of_contract=clean($_POST["class_of_contract"]);$con_valid_dt=clean($_POST["con_valid_dt"]);$sup_name=clean($_POST["sup_name"]);$sup_reg=clean($_POST["sup_reg"]);$workman_name=clean($_POST["workman_name"]);$workman_reg=clean($_POST["workman_reg"]);$work_details=clean($_POST["work_details"]);$expected_com_date=clean($_POST["expected_com_date"]);$expected_sub_date=clean($_POST["expected_sub_date"]);

	if(!empty($_POST["work_address"]))	 $work_address=json_encode($_POST["work_address"]);
	else	$work_address=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref,year_no,ref_date,work_done,contractor_reg,class_of_contract,con_valid_dt,sup_name,sup_reg,workman_name,workman_reg,work_address,work_details,expected_com_date,expected_sub_date) values ('$swr_id','$today', '$ref', '$year_no', '$ref_date','$work_done', '$contractor_reg', '$class_of_contract', '$con_valid_dt','$sup_name','$sup_reg','$workman_name','$workman_reg','$work_address','$work_details','$expected_com_date','$expected_sub_date')") ;
	}else{
		$form_id=$row["form_id"];
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', ref='$ref', year_no='$year_no', ref_date='$ref_date',work_done='$work_done', contractor_reg='$contractor_reg', class_of_contract='$class_of_contract', con_valid_dt='$con_valid_dt', sup_name='$sup_name', sup_reg='$sup_reg', workman_name='$workman_name', workman_reg='$workman_reg', work_address='$work_address', work_details='$work_details',expected_com_date='$expected_com_date',expected_sub_date='$expected_sub_date' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 5 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}						
}

if(isset($_POST["save6a"])){		
	$lift_details=clean($_POST["lift_details"]);
	if(isset($_POST["local_agent"])) $local_agent=json_encode($_POST["local_agent"]);
	else $local_agent="";
	if(isset($_POST["premise_addr"])) $premise_addr=json_encode($_POST["premise_addr"]);
	else $premise_addr="";
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,local_agent,premise_addr,lift_details) values ('$swr_id','$today', '$local_agent', '$premise_addr', '$lift_details')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', local_agent='$local_agent', premise_addr='$premise_addr', lift_details='$lift_details' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 6 -- form no 
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
	$num_of_lift=clean($_POST["num_of_lift"]);$rated_speed=clean($_POST["rated_speed"]);$counter_details=clean($_POST["counter_details"]);$car_frame=clean($_POST["car_frame"]);$travel_dist=clean($_POST["travel_dist"]);$control_method=clean($_POST["control_method"]);$machine_details=clean($_POST["machine_details"]);
	
	if(isset($_POST["install_person"])) $install_person=json_encode($_POST["install_person"]);
	else $install_person="";
	if(isset($_POST["makers_addr"])) $makers_addr=json_encode($_POST["makers_addr"]);
	else $makers_addr="";
	if(isset($_POST["related_load"])) $related_load=json_encode($_POST["related_load"]);
	else $related_load="";
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,install_person,makers_addr,num_of_lift,related_load,rated_speed,travel_dist,control_method,machine_details,counter_details,car_frame) values ('$swr_id','$today', '$install_person', '$makers_addr', '$num_of_lift', '$related_load', '$rated_speed','$travel_dist', '$control_method', '$machine_details', '$counter_details', '$car_frame')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', install_person='$install_person', makers_addr='$makers_addr', num_of_lift='$num_of_lift', related_load='$related_load', rated_speed='$rated_speed', travel_dist='$travel_dist' , control_method='$control_method', machine_details='$machine_details', counter_details='$counter_details', car_frame='$car_frame' where form_id=$form_id") ;	
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
if(isset($_POST["save6c"])){		
	$weight_clearence=clean($_POST["weight_clearence"]);$locking_arrange=clean($_POST["locking_arrange"]);$emergency_details=clean($_POST["emergency_details"]);$lifting_beam=clean($_POST["lifting_beam"]);$speed_governor=clean($_POST["speed_governor"]);$retiring_details=clean($_POST["retiring_details"]);$safety_details=clean($_POST["safety_details"]);$sheave_details=clean($_POST["sheave_details"]);$rope_details=clean($_POST["rope_details"]);$head_room_dist=clean($_POST["head_room_dist"]);$travel_distance=clean($_POST["travel_distance"]);$car_clearence=clean($_POST["car_clearence"]);$alarm_system=clean($_POST["alarm_system"]);$detail_of_earthing=clean($_POST["detail_of_earthing"]);$emergency_signal=clean($_POST["emergency_signal"]);
	$detail_of_dimen=clean($_POST["detail_of_dimen"]);$power_details=clean($_POST["power_details"]);$construction_details=clean($_POST["construction_details"]);$commencement_dt=clean($_POST["commencement_dt"]);$completion_dt=clean($_POST["completion_dt"]);

	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,weight_clearence,locking_arrange,emergency_details,lifting_beam,speed_governor,retiring_details,safety_details,sheave_details,rope_details,head_room_dist,travel_distance,car_clearence,alarm_system,detail_of_earthing,emergency_signal,detail_of_dimen,power_details,construction_details,commencement_dt,completion_dt) values ('$swr_id','$today', '$weight_clearence', '$locking_arrange', '$emergency_details', '$lifting_beam', '$speed_governor', '$retiring_details', '$safety_details', '$sheave_details', '$rope_details', '$head_room_dist', '$travel_distance', '$car_clearence', '$alarm_system', '$detail_of_earthing', '$emergency_signal', '$detail_of_dimen', '$power_details', '$construction_details', '$commencement_dt', '$completion_dt')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', weight_clearence='$weight_clearence', locking_arrange='$locking_arrange', emergency_details='$emergency_details', lifting_beam='$lifting_beam' , speed_governor='$speed_governor', retiring_details='$retiring_details', safety_details='$safety_details', sheave_details='$sheave_details', rope_details='$rope_details', head_room_dist='$head_room_dist', travel_distance='$travel_distance' , car_clearence='$car_clearence', alarm_system='$alarm_system', detail_of_earthing='$detail_of_earthing', emergency_signal='$emergency_signal', detail_of_dimen='$detail_of_dimen', power_details='$power_details', construction_details='$construction_details', commencement_dt='$commencement_dt' , completion_dt='$completion_dt' where form_id=$form_id") ;	
	}				
	if($query){		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}						
}

if(isset($_POST["save7a"])){		
	$lift_details=clean($_POST["lift_details"]);
	
	if(isset($_POST["local_agent"])) $local_agent=json_encode($_POST["local_agent"]);
	else $local_agent="";
	if(isset($_POST["premise_addr"])) $premise_addr=json_encode($_POST["premise_addr"]);
	else $premise_addr="";
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,local_agent,premise_addr,lift_details) values ('$swr_id','$today', '$local_agent', '$premise_addr', '$lift_details')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', local_agent='$local_agent', premise_addr='$premise_addr', lift_details='$lift_details' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 7 -- form no 
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
if(isset($_POST["save7b"])){		
	$num_of_lift=clean($_POST["num_of_lift"]);$rated_speed=clean($_POST["rated_speed"]);$travel_dist=clean($_POST["travel_dist"]);$control_method=clean($_POST["control_method"]);$machine_details=clean($_POST["machine_details"]);$counter_details=clean($_POST["counter_details"]);$car_frame=clean($_POST["car_frame"]);
	
	if(isset($_POST["install_person"])) $install_person=json_encode($_POST["install_person"]);
	else $install_person="";
	if(isset($_POST["makers_addr"])) $makers_addr=json_encode($_POST["makers_addr"]);
	else $makers_addr="";
	if(isset($_POST["related_load"])) $related_load=json_encode($_POST["related_load"]);
	else $related_load="";
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,install_person,makers_addr,num_of_lift,related_load,rated_speed,travel_dist,control_method,machine_details,counter_details,car_frame) values ('$swr_id','$today', '$install_person', '$makers_addr', '$num_of_lift', '$related_load', '$rated_speed','$travel_dist', '$control_method', '$machine_details', '$counter_details', '$car_frame')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', install_person='$install_person', makers_addr='$makers_addr', num_of_lift='$num_of_lift', related_load='$related_load', rated_speed='$rated_speed', travel_dist='$travel_dist' , control_method='$control_method', machine_details='$machine_details', counter_details='$counter_details', car_frame='$car_frame' where form_id=$form_id") ;	
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
if(isset($_POST["save7c"])){		
	$weight_clearence=clean($_POST["weight_clearence"]);$locking_arrange=clean($_POST["locking_arrange"]);$emergency_details=clean($_POST["emergency_details"]);$lifting_beam=clean($_POST["lifting_beam"]);$speed_governor=clean($_POST["speed_governor"]);$retiring_details=clean($_POST["retiring_details"]);$safety_details=clean($_POST["safety_details"]);$sheave_details=clean($_POST["sheave_details"]);$rope_details=clean($_POST["rope_details"]);$head_room_dist=clean($_POST["head_room_dist"]);$travel_distance=clean($_POST["travel_distance"]);$car_clearence=clean($_POST["car_clearence"]);$alarm_system=clean($_POST["alarm_system"]);$detail_of_earthing=clean($_POST["detail_of_earthing"]);$emergency_signal=clean($_POST["emergency_signal"]);
	$detail_of_dimen=clean($_POST["detail_of_dimen"]);$power_details=clean($_POST["power_details"]);$construction_details=clean($_POST["construction_details"]);$commencement_dt=clean($_POST["commencement_dt"]);$completion_dt=clean($_POST["completion_dt"]);

	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,weight_clearence,locking_arrange,emergency_details,lifting_beam,speed_governor,retiring_details,safety_details,sheave_details,rope_details,head_room_dist,travel_distance,car_clearence,alarm_system,detail_of_earthing,emergency_signal,detail_of_dimen,power_details,construction_details,commencement_dt,completion_dt) values ('$swr_id','$today', '$weight_clearence', '$locking_arrange', '$emergency_details', '$lifting_beam', '$speed_governor', '$retiring_details', '$safety_details', '$sheave_details', '$rope_details', '$head_room_dist', '$travel_distance', '$car_clearence', '$alarm_system', '$detail_of_earthing', '$emergency_signal', '$detail_of_dimen', '$power_details', '$construction_details', '$commencement_dt', '$completion_dt')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', weight_clearence='$weight_clearence', locking_arrange='$locking_arrange', emergency_details='$emergency_details', lifting_beam='$lifting_beam' , speed_governor='$speed_governor', retiring_details='$retiring_details', safety_details='$safety_details', sheave_details='$sheave_details', rope_details='$rope_details', head_room_dist='$head_room_dist', travel_distance='$travel_distance' , car_clearence='$car_clearence', alarm_system='$alarm_system', detail_of_earthing='$detail_of_earthing', emergency_signal='$emergency_signal', detail_of_dimen='$detail_of_dimen', power_details='$power_details', construction_details='$construction_details', commencement_dt='$commencement_dt' , completion_dt='$completion_dt' where form_id=$form_id") ;	
	}				
	if($query){		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}						
}

if(isset($_POST["save8"])){		
	$escalator_detail=clean($_POST["escalator_detail"]);
	
	if(isset($_POST["local_agent"])) $local_agent=json_encode($_POST["local_agent"]);
	else $local_agent="";
	if(isset($_POST["escalator_install"])) $escalator_install=json_encode($_POST["escalator_install"]);
	else $escalator_install="";
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,local_agent,escalator_install,escalator_detail) values ('$swr_id','$today', '$local_agent', '$escalator_install', '$escalator_detail')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', local_agent='$local_agent',  escalator_install='$escalator_install', escalator_detail='$escalator_detail' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 8 -- form no 
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
if(isset($_POST["save8a"])){		
	$rated_speed=clean($_POST["rated_speed"]);$rated_load=clean($_POST["rated_load"]);$num_of_person=clean($_POST["num_of_person"]);$angle_of_incline=clean($_POST["angle_of_incline"]);$wd_of_escalator=clean($_POST["wd_of_escalator"]);$vertical_rise=clean($_POST["vertical_rise"]);$drive_claim=clean($_POST["drive_claim"]);$cons_detail=clean($_POST["cons_detail"]);$commencement_dt=clean($_POST["commencement_dt"]);$completion_dt=clean($_POST["completion_dt"]);
	
	if(isset($_POST["install_person"])) $install_person=json_encode($_POST["install_person"]);
	else $install_person="";
	if(isset($_POST["makers_addr"])) $makers_addr=json_encode($_POST["makers_addr"]);
	else $makers_addr="";
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,install_person,makers_addr,rated_speed,rated_load,num_of_person,angle_of_incline,wd_of_escalator,vertical_rise,drive_claim,cons_detail,commencement_dt,completion_dt) values ('$swr_id','$today', '$install_person', '$makers_addr', '$rated_speed', '$rated_load', '$num_of_person', '$angle_of_incline', '$wd_of_escalator', '$vertical_rise', '$drive_claim', '$cons_detail', '$commencement_dt', '$completion_dt')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', install_person='$install_person', makers_addr='$makers_addr',rated_speed='$rated_speed', rated_load='$rated_load', num_of_person='$num_of_person', angle_of_incline='$angle_of_incline', wd_of_escalator='$wd_of_escalator', vertical_rise='$vertical_rise', drive_claim='$drive_claim', cons_detail='$cons_detail', commencement_dt='$commencement_dt', completion_dt='$completion_dt' where form_id='$form_id'") ;	
	}				
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}						
}

if(isset($_POST["save9"])){		
	$escalator_detail=clean($_POST["escalator_detail"]);
	
	if(isset($_POST["local_agent"])) $local_agent=json_encode($_POST["local_agent"]);
	else $local_agent="";
	if(isset($_POST["lift_install"])) $lift_install=json_encode($_POST["lift_install"]);
	else $lift_install="";
	if(isset($_POST["escalator_install"])) $escalator_install=json_encode($_POST["escalator_install"]);
	else $escalator_install="";
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,local_agent,lift_install,escalator_install,escalator_detail) values ('$swr_id','$today', '$local_agent', '$lift_install', '$escalator_install', '$escalator_detail')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', local_agent='$local_agent', lift_install='$lift_install', escalator_install='$escalator_install', escalator_detail='$escalator_detail' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 9 -- form no 
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
if(isset($_POST["save9a"])){		
	$rated_speed=clean($_POST["rated_speed"]);$rated_load=clean($_POST["rated_load"]);$num_of_person=clean($_POST["num_of_person"]);$angle_of_incline=clean($_POST["angle_of_incline"]);$wd_of_escalator=clean($_POST["wd_of_escalator"]);$vertical_rise=clean($_POST["vertical_rise"]);$drive_claim=clean($_POST["drive_claim"]);$cons_detail=clean($_POST["cons_detail"]);$commencement_dt=clean($_POST["commencement_dt"]);$completion_dt=clean($_POST["completion_dt"]);

	if(isset($_POST["install_person"])) $install_person=json_encode($_POST["install_person"]);
	else $install_person="";
	if(isset($_POST["makers_addr"])) $makers_addr=json_encode($_POST["makers_addr"]);
	else $makers_addr="";
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,install_person,makers_addr,rated_speed,rated_load,num_of_person,angle_of_incline,wd_of_escalator,vertical_rise,drive_claim,cons_detail,commencement_dt,completion_dt) values ('$swr_id','$today', '$install_person', '$makers_addr', '$rated_speed', '$rated_load', '$num_of_person', '$angle_of_incline', '$wd_of_escalator', '$vertical_rise', '$drive_claim', '$cons_detail', '$commencement_dt', '$completion_dt')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', install_person='$install_person', makers_addr='$makers_addr',rated_speed='$rated_speed', rated_load='$rated_load', num_of_person='$num_of_person', angle_of_incline='$angle_of_incline', wd_of_escalator='$wd_of_escalator', vertical_rise='$vertical_rise', drive_claim='$drive_claim', cons_detail='$cons_detail', commencement_dt='$commencement_dt', completion_dt='$completion_dt' where form_id='$form_id'") ;	
	}				
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}						
}

if(isset($_POST["save10"])){	
		$is_lift_esc=clean($_POST["is_lift_esc"]);$auth_person=clean($_POST["auth_person"]);$auth_no=clean($_POST["auth_no"]);
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_lift_esc,auth_person,auth_no) values ('$swr_id','$today','$is_lift_esc', '$auth_person', '$auth_no')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',is_lift_esc='$is_lift_esc', auth_person='$auth_person', auth_no='$auth_no' where form_id=$form_id") ;	
		}
		if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 10 -- form no 
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

if(isset($_POST["save11"])){	

	$letter_no=clean($_POST["letter_no"]);$letter_dt=clean($_POST["letter_dt"]);$completed_on=clean($_POST["completed_on"]);
	$rated_speed=clean($_POST["rated_speed"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,letter_no,letter_dt,completed_on,rated_speed) values ('$swr_id','$today','$letter_no', '$letter_dt','$completed_on', '$rated_speed')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', letter_no='$letter_no', letter_dt='$letter_dt', completed_on='$completed_on', rated_speed='$rated_speed' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 11 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}						
}

if(isset($_POST["save12"])){	
		$is_lift_esc=clean($_POST["is_lift_esc"]);$auth_person=clean($_POST["auth_person"]);$auth_no=clean($_POST["auth_no"]);
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_lift_esc,auth_person,auth_no) values ('$swr_id','$today','$is_lift_esc', '$auth_person', '$auth_no')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',is_lift_esc='$is_lift_esc', auth_person='$auth_person', auth_no='$auth_no' where form_id=$form_id") ;	
		}
		if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 12 -- form no 
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

if(isset($_POST["save13a"])){
	    $letter_no=clean($_POST["letter_no"]);$letter_dt=clean($_POST["letter_dt"]);$completed_on=clean($_POST["completed_on"]);
		
		if(!empty($_POST["local_agent"]))	 $local_agent=json_encode($_POST["local_agent"]);
		else	$local_agent=NULL;
		if(!empty($_POST["premise_address"]))	 $premise_address=json_encode($_POST["premise_address"]);
		else	$premise_address=NULL;
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,letter_no,letter_dt,completed_on,local_agent,premise_address) values ('$swr_id','$today','$letter_no', '$letter_dt','$completed_on','$local_agent', '$premise_address')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',letter_no='$letter_no',letter_dt='$letter_dt',completed_on='$completed_on',local_agent='$local_agent', premise_address='$premise_address' where form_id=$form_id") ;	
		}
		if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 13 -- form no 
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
if(isset($_POST["save13b"])){		
		$type_of_lift=clean($_POST["type_of_lift"]);$rated_load=clean($_POST["rated_load"]);$rated_speed=clean($_POST["rated_speed"]);$total_lift_weight=clean($_POST["total_lift_weight"]);$counter_weight=clean($_POST["counter_weight"]);$suspension_rope=clean($_POST["suspension_rope"]);$pit_depth=clean($_POST["pit_depth"]);$travel=clean($_POST["travel"]);$head_room=clean($_POST["head_room"]);$auth_person=clean($_POST["auth_person"]);$auth_no=clean($_POST["auth_no"]);
		
		if(!empty($_POST["auth_address"]))	 $auth_address=json_encode($_POST["auth_address"]);
		else	$auth_address=NULL;
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_address,type_of_lift,rated_load,rated_speed,total_lift_weight,counter_weight,suspension_rope,pit_depth,travel,head_room,auth_person,auth_no) values ('$swr_id','$today', '$auth_address', '$type_of_lift', '$rated_load', '$rated_speed', '$total_lift_weight', '$counter_weight', '$suspension_rope', '$pit_depth', '$travel', '$head_room', '$auth_person', '$auth_no')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_address='$auth_address', type_of_lift='$type_of_lift', rated_load='$rated_load', rated_speed='$rated_speed', total_lift_weight='$total_lift_weight', counter_weight='$counter_weight', suspension_rope='$suspension_rope', pit_depth='$pit_depth', travel='$travel', head_room='$head_room', auth_person='$auth_person', auth_no='$auth_no' where form_id=$form_id") ;	
		}
		if($query){		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}

if(isset($_POST["save14a"])){
        $letter_no=clean($_POST["letter_no"]);$letter_dt=clean($_POST["letter_dt"]);$completed_on=clean($_POST["completed_on"]);
     	
		if(!empty($_POST["local_agent"]))	 $local_agent=json_encode($_POST["local_agent"]);
		else	$local_agent=NULL;
		if(!empty($_POST["premise_address"]))	 $premise_address=json_encode($_POST["premise_address"]);
		else	$premise_address=NULL;
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,letter_no,letter_dt,completed_on,local_agent,premise_address) values ('$swr_id','$today','$letter_no', '$letter_dt','$completed_on','$local_agent','$premise_address')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',letter_no='$letter_no',letter_dt='$letter_dt',completed_on='$completed_on',local_agent='$local_agent', premise_address='$premise_address' where form_id=$form_id") ;	
		}
		if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 14 -- form no 
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
if(isset($_POST["save14b"])){		
		$type_of_esc=clean($_POST["type_of_esc"]);$rated_load=clean($_POST["rated_load"]);$rated_speed=clean($_POST["rated_speed"]);$num_of_person=clean($_POST["num_of_person"]);$angle_of_inclin=clean($_POST["angle_of_inclin"]);$esc_width=clean($_POST["esc_width"]);$vertical_rise=clean($_POST["vertical_rise"]);$drive_chain=clean($_POST["drive_chain"]);$head_room=clean($_POST["head_room"]);$cons_detail=clean($_POST["cons_detail"]);$approx_reaction=clean($_POST["approx_reaction"]);$auth_person=clean($_POST["auth_person"]);$auth_no=clean($_POST["auth_no"]);
		
		if(!empty($_POST["auth_address"]))	 $auth_address=json_encode($_POST["auth_address"]);
		else	$auth_address=NULL;
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,type_of_esc,auth_address,rated_load,rated_speed,num_of_person,angle_of_inclin,esc_width,vertical_rise,drive_chain,head_room,cons_detail,approx_reaction,auth_person,auth_no) values ('$swr_id','$today', '$type_of_esc','$auth_address', '$type_of_lift', '$rated_load', '$rated_speed', '$num_of_person', '$angle_of_inclin', '$esc_width', '$vertical_rise', '$drive_chain', '$head_room', '$cons_detail', '$approx_reaction', '$auth_person', '$auth_no')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',type_of_esc='$type_of_esc',auth_address='$auth_address',  rated_load='$rated_load', rated_speed='$rated_speed', num_of_person='$num_of_person', angle_of_inclin='$angle_of_inclin', esc_width='$esc_width', vertical_rise='$vertical_rise', drive_chain='$drive_chain', head_room='$head_room', cons_detail='$cons_detail', approx_reaction='$approx_reaction', auth_person='$auth_person', auth_no='$auth_no' where form_id='$form_id'") ;	
		}
		if($query){		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}

if(isset($_POST["save15"])){		
		$install_at=clean($_POST["install_at"]);$install_lift=clean($_POST["install_lift"]);	
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,install_at,install_lift) values ('$swr_id','$today','$install_at','$install_lift')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', install_at='$install_at', install_lift='$install_lift' where form_id=$form_id") ;	
		}
		if($query){
			$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 15 -- form no 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";		
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}		
}

if(isset($_POST["save16"])){		
		$install_at=clean($_POST["install_at"]);$install_lift=clean($_POST["install_lift"]);
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,install_at,install_lift) values ('$swr_id','$today', '$install_at', '$install_lift')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', install_at='$install_at', install_lift='$install_lift' where form_id=$form_id") ;	
		}
		if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 16 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}

if(isset($_POST["save17"])){		
		$lift=clean($_POST["lift"]);$owned=clean($_POST["owned"]);$auth_person=clean($_POST["auth_person"]);$auth_no=clean($_POST["auth_no"]);
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,lift,owned,auth_person,auth_no) values ('$swr_id','$today', '$lift', '$owned', '$auth_person', '$auth_no')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', lift='$lift', owned='$owned', auth_person='$auth_person', auth_no='$auth_no' where form_id=$form_id") ;	
		}
		if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 17 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}

if(isset($_POST["save18"])){		
		$lift=clean($_POST["lift"]);$owned=clean($_POST["owned"]);$auth_person=clean($_POST["auth_person"]);$auth_no=clean($_POST["auth_no"]);
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,lift,owned,auth_person,auth_no) values ('$swr_id','$today', '$lift', '$owned', '$auth_person', '$auth_no')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', lift='$lift', owned='$owned', auth_person='$auth_person', auth_no='$auth_no' where form_id=$form_id") ;	
		}
		if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 18 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}

if(isset($_POST["save19"])){
	$is_certificate=clean($_POST["is_certificate"]);
	if($is_certificate=='Y'){
	$certificate_number=clean($_POST["certificate_number"]);
	$certificate_date=clean($_POST["certificate_date"]);
	}else{
		$certificate_number='';$certificate_date='';
	}
	$is_lift_esc=clean($_POST["is_lift_esc"]);$maintance=clean($_POST["maintance"]);$contract_reg_no=clean($_POST["contract_reg_no"]);$is_solvency=clean($_POST["is_solvency"]);$details_of_staff=clean($_POST["details_of_staff"]);$workshop_details=clean($_POST["workshop_details"]);$testing_details=clean($_POST["testing_details"]);$safety_details=clean($_POST["safety_details"]);$facility_details=clean($_POST["facility_details"]);$remarks=clean($_POST["remarks"]);	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,is_lift_esc,is_certificate,certificate_number,certificate_date,maintance,contract_reg_no,is_solvency,details_of_staff,workshop_details,testing_details,safety_details,facility_details,remarks) values ('$swr_id','$today','$today','$is_lift_esc','$is_certificate', '$certificate_number', '$certificate_date','$maintance','$contract_reg_no','$is_solvency','$details_of_staff','$workshop_details','$testing_details','$safety_details','$facility_details','$remarks')") ;
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today', is_lift_esc='$is_lift_esc', is_certificate='$is_certificate',certificate_number='$certificate_number', certificate_date='$certificate_date', maintance='$maintance', contract_reg_no='$contract_reg_no',is_solvency='$is_solvency',details_of_staff='$details_of_staff',workshop_details='$workshop_details',testing_details='$testing_details',safety_details='$safety_details',facility_details='$facility_details',remarks='$remarks' where user_id='$swr_id' and form_id='$form_id'") ;
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 19 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save20"])){
	$is_certificate=clean($_POST["is_certificate"]);
	if($is_certificate=='Y'){
	$certificate_number=clean($_POST["certificate_number"]);
	$certificate_date=clean($_POST["certificate_date"]);
	}else{
		$certificate_number='';$certificate_date='';
	}
	$is_lift_esc=clean($_POST["is_lift_esc"]);$maintance=clean($_POST["maintance"]);$contract_reg_no=clean($_POST["contract_reg_no"]);$is_solvency=clean($_POST["is_solvency"]);$details_of_staff=clean($_POST["details_of_staff"]);$workshop_details=clean($_POST["workshop_details"]);$testing_details=clean($_POST["testing_details"]);$safety_details=clean($_POST["safety_details"]);$facility_details=clean($_POST["facility_details"]);$remarks=clean($_POST["remarks"]);			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,is_lift_esc,is_certificate,certificate_number,certificate_date,maintance,contract_reg_no,is_solvency,details_of_staff,workshop_details,testing_details,safety_details,facility_details,remarks) values ('$swr_id','$today','$today', '$is_lift_esc','$is_certificate', '$certificate_number', '$certificate_date','$maintance','$contract_reg_no','$is_solvency','$details_of_staff','$workshop_details','$testing_details','$safety_details','$facility_details','$remarks')") ;
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' , is_lift_esc='$is_lift_esc',is_certificate='$is_certificate',certificate_number='$certificate_number', certificate_date='$certificate_date', maintance='$maintance', contract_reg_no='$contract_reg_no',is_solvency='$is_solvency',details_of_staff='$details_of_staff',workshop_details='$workshop_details',testing_details='$testing_details',safety_details='$safety_details',facility_details='$facility_details',remarks='$remarks' where user_id='$swr_id' and form_id='$form_id'") ;
	}
	if($query){
		
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 20 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save21"])){
	$is_certificate=clean($_POST["is_certificate"]);
	if($is_certificate=='Y'){
		$certificate_number=clean($_POST["certificate_number"]);
		$certificate_date=clean($_POST["certificate_date"]);
	}else{
		$certificate_number='';$certificate_date='';
	}
	$is_lift_esc=clean($_POST["is_lift_esc"]);
	if($is_lift_esc=='L'){
		$rated_speed=clean($_POST["rated_speed"]);
	}else{
		$rated_speed='';
	}
	$maintance=clean($_POST["maintance"]);$details_of_staff=clean($_POST["details_of_staff"]);	
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,is_lift_esc,is_certificate,certificate_number,certificate_date,maintance,details_of_staff,rated_speed) values ('$swr_id','$today','$today','$is_lift_esc','$is_certificate', '$certificate_number', '$certificate_date','$maintance','$details_of_staff','$rated_speed')") ;
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' ,is_lift_esc='$is_lift_esc',is_certificate='$is_certificate',certificate_number='$certificate_number', certificate_date='$certificate_date', maintance='$maintance',details_of_staff='$details_of_staff',rated_speed='$rated_speed' where user_id='$swr_id' and form_id='$form_id'") ;
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 21 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save22a"])){		
		$accident_datetime=clean($_POST["accident_datetime"]);$accident_place=clean($_POST["accident_place"]);$victim_sex=clean($_POST["victim_sex"]);$victim_designation=clean($_POST["victim_designation"]);$brief_desc=clean($_POST["brief_desc"]);$work_on=clean($_POST["work_on"]);$s1=clean($_POST["s1"]);$reg_no=clean($_POST["reg_no"]);$auth_no=clean($_POST["auth_no"]);$auth_person_name=clean($_POST["auth_person_name"]);
		if(!empty($_POST["victim"]))	 $victim=json_encode($_POST["victim"]);
		else	$victim=NULL;
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,accident_datetime,accident_place,victim,victim_sex,victim_designation,brief_desc,work_on,s1,reg_no,auth_no,auth_person_name) values ('$swr_id','$today', '$accident_datetime', '$accident_place', '$victim', '$victim_sex','$victim_designation', '$brief_desc', '$work_on', '$s1', '$reg_no', '$auth_no', '$auth_person_name')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', accident_datetime='$accident_datetime', accident_place='$accident_place', victim='$victim', victim_sex='$victim_sex',victim_designation='$victim_designation', brief_desc='$brief_desc', work_on='$work_on', s1='$s1', reg_no='$reg_no', auth_no='$auth_no', auth_person_name='$auth_person_name' where form_id=$form_id") ;	
		}
		if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 22 -- form no 
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
if(isset($_POST["save22b"])){		
		$other_injuries=clean($_POST["other_injuries"]);$postmortem=clean($_POST["postmortem"]);$detail_cause=clean($_POST["detail_cause"]);$action_taken=clean($_POST["action_taken"]);$is_notified=clean($_POST["is_notified"]);$steps_taken=clean($_POST["steps_taken"]);$any_remarks=clean($_POST["any_remarks"]);
		if($is_notified=='Y'){
		$notified_details=clean($_POST["notified_details"]);
		}else{			
			$notified_details='';
		}
		if(!empty($_POST["auth_address"]))	 $auth_address=json_encode($_POST["auth_address"]);
		else	$auth_address=NULL;
		if(!empty($_POST["assisting_p"]))	 $assisting_p=json_encode($_POST["assisting_p"]);
		else	$assisting_p=NULL;
		if(!empty($_POST["supervising_p"]))	 $supervising_p=json_encode($_POST["supervising_p"]);
		else	$supervising_p=NULL;
		if(!empty($_POST["witness"]))	 $witness=json_encode($_POST["witness"]);
		else	$witness=NULL;
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,auth_address,other_injuries,postmortem,victim_designation,action_taken,is_notified,notified_details,steps_taken,assisting_p,supervising_p,witness,any_remarks) values ('$swr_id','$today','$auth_address', '$other_injuries', '$postmortem',  '$detail_cause', '$action_taken', '$is_notified', '$notified_details', '$steps_taken', '$assisting_p', '$supervising_p', '$witness', '$any_remarks')") ;
		}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',auth_address='$auth_address', other_injuries='$other_injuries', postmortem='$postmortem',detail_cause='$detail_cause', action_taken='$action_taken', is_notified='$is_notified', notified_details='$notified_details', steps_taken='$steps_taken', assisting_p='$assisting_p', supervising_p='$supervising_p', witness='$witness', any_remarks='$any_remarks' where form_id=$form_id") ;	
		}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}

if(isset($_POST["save24"])){ 		
	$examination_test=clean($_POST["examination_test"]);$class_of_certificate=clean($_POST["class_of_certificate"]);$applicant_name=clean($_POST["applicant_name"]);$place=clean($_POST["place"]);$applicant_dob=clean($_POST["applicant_dob"]);$citizen=clean($_POST["citizen"]);$nationality=clean($_POST["nationality"]);$technical_qualication=clean($_POST["technical_qualication"]);$regd_no_competency=clean($_POST["regd_no_competency"]);$regd_no_permit=clean($_POST["regd_no_permit"]);$details_of_past=clean($_POST["details_of_past"]);$centre=clean($_POST["centre"]);$language=clean($_POST["language"]);$candidate_for=clean($_POST["candidate_for"]);$present_addr_dist=clean($_POST["present_addr_dist"]);
	if(!empty($_POST["home_address"])) $home_address=json_encode($_POST["home_address"]);
	else	$home_address=NULL;
	if(!empty($_POST["present_addr"]))	 $present_addr=json_encode($_POST["present_addr"]);
	else	$present_addr=NULL;
	if(!empty($_POST["issue_certificate"]))  $issue_certificate=json_encode($_POST["issue_certificate"]);
	else	$issue_certificate=NULL;
	

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,examination_test,class_of_certificate,applicant_name,place,applicant_dob,home_address,present_addr,present_addr_dist,citizen,nationality,technical_qualication,regd_no_competency,regd_no_permit,issue_certificate,details_of_past,centre,language,candidate_for) values ('$swr_id','$today', '$examination_test', '$class_of_certificate', '$applicant_name','$place','$applicant_dob', '$home_address', '$present_addr','$present_addr_dist',  '$citizen', '$nationality', '$technical_qualication', '$regd_no_competency', '$regd_no_permit', '$issue_certificate', '$details_of_past', '$centre', '$language', '$candidate_for')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', examination_test='$examination_test', class_of_certificate='$class_of_certificate', applicant_name='$applicant_name',place='$place',applicant_dob='$applicant_dob', home_address='$home_address', present_addr='$present_addr',present_addr_dist='$present_addr_dist',citizen='$citizen',nationality='$nationality',technical_qualication='$technical_qualication',regd_no_competency='$regd_no_competency' ,regd_no_permit='$regd_no_permit',issue_certificate='$issue_certificate',details_of_past='$details_of_past',centre='$centre',language='$language',candidate_for='$candidate_for' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 24 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}						
}

if(isset($_POST["save25a"])){		
	$Voltage=clean($_POST["Voltage"]);$Location=clean($_POST["Location"]);
	$point_from_pt=clean($_POST["point_from_pt"]);$point_to_pt=clean($_POST["point_to_pt"]);$pur_constructed=clean($_POST["pur_constructed"]);
	$length=clean($_POST["length"]);$Quantum=clean($_POST["Quantum"]);$no_Spans=clean($_POST["no_Spans"]);$length_Spans=clean($_POST["length_Spans"]);
	$max_len_Spans=clean($_POST["max_len_Spans"]);$Type_conductor=clean($_POST["Type_conductor"]);$size_conductor=clean($_POST["size_conductor"]);$Type_Support=clean($_POST["Type_Support"]);
    $Materials=clean($_POST["Materials"]);$t_Supports=clean($_POST["t_Supports"]);$Type_Cross=clean($_POST["Type_Cross"]);
	$Cross_size=clean($_POST["Cross_size"]);$acr_street=clean($_POST["acr_street"]);$a_street=clean($_POST["a_street"]);$Elsewhere=clean($_POST["Elsewhere"]);
	
	if(!empty($_POST["type_insulator"]))	$type_insulator=json_encode($_POST["type_insulator"]);
		else	$type_insulator=NULL;
	
	if(!empty($_POST["clearance"]))	 $clearance=json_encode($_POST["clearance"]);
	else	$clearance=NULL;
	
	//if(!empty($_POST["point"]))	 $period=json_encode($_POST["point"]);
	//else	$point=NULL;
    

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,Voltage,Location,point_from_pt,point_to_pt,pur_constructed,length,Quantum,no_Spans,length_Spans,max_len_Spans,Type_conductor,size_conductor,Type_Support,Materials,t_Supports,type_insulator,Type_Cross,Cross_size,acr_street,a_street,Elsewhere,clearance) values ('$swr_id','$today','$Voltage','$Location','$point_from_pt','$point_to_pt','$pur_constructed','$length','$Quantum','$no_Spans','$length_Spans','$max_len_Spans','$Type_conductor','$size_conductor','$Type_Support','$Materials','$t_Supports','$type_insulator','$Type_Cross','$Cross_size','$acr_street','$a_street','$Elsewhere','$clearance')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',Voltage='$Voltage',Location='$Location',point_from_pt='$point_from_pt',point_to_pt='$point_to_pt',pur_constructed='$pur_constructed',length='$length',Quantum='$Quantum',no_Spans='$no_Spans',length_Spans='$length_Spans',max_len_Spans='$max_len_Spans',Type_conductor='$Type_conductor',size_conductor='$size_conductor',Type_Support='$Type_Support',Materials='$Materials',t_Supports='$t_Supports',type_insulator='$type_insulator',Type_Cross='$Type_Cross',Cross_size='$Cross_size',acr_street='$acr_street',a_street='$a_street',Elsewhere='$Elsewhere',clearance='$clearance' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 25 -- form no 
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
if(isset($_POST["save25b"])){
	
	    $leak_volt=clean($_POST["leak_volt"]);$is_cradle_g=clean($_POST["is_cradle_g"]);$menti_vol=clean($_POST["menti_vol"]);$h_izontal=clean($_POST["h_izontal"]);
	    $v_ertical=clean($_POST["v_ertical"]);$is_h_guard=clean($_POST["is_h_guard"]);
	    $angle_crossing=clean($_POST["angle_crossing"]);$overhead_line=clean($_POST["overhead_line"]);
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,leak_volt,is_cradle_g,menti_vol,h_izontal,v_ertical,is_h_guard,angle_crossing,overhead_line) values ('$swr_id','$today','$leak_volt','$is_cradle_g','$menti_vol','$h_izontal','$v_ertical','$is_h_guard','$angle_crossing','$overhead_line')");
	   }else{
		   $form_id=$row["form_id"];
		   $query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." set sub_date='$today',leak_volt='$leak_volt',is_cradle_g='$is_cradle_g',menti_vol='$menti_vol',h_izontal='$h_izontal',v_ertical='$v_ertical',is_h_guard='$is_h_guard',angle_crossing='$angle_crossing',overhead_line='$overhead_line' where form_id='$form_id'");	
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
if(isset($_POST["save25c"])){		
    $voltage_Insulation=clean($_POST["voltage_Insulation"]);$type_size_guard=clean($_POST["type_size_guard"]);$is_continuous=clean($_POST["is_continuous"]);$intervals_earth_wire=clean($_POST["intervals_earth_wire"]);$metallic_supports=clean($_POST["metallic_supports"]);$permanently_earthed=clean($_POST["permanently_earthed"]);
	$overhead_line_electricity=clean($_POST["overhead_line_electricity"]);
	
	$Specifications=clean($_POST["Specifications"]);$Make=clean($_POST["Make"]);$protection=clean($_POST["protection"]);$Normal_setting=clean($_POST["Normal_setting"]);
	
	if(!empty($_POST["phase_earth"])){
		$phase_earth=json_encode($_POST["phase_earth"]);
	}else{
		$phase_earth=NULL;
	}

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,phase_earth,voltage_Insulation,type_size_guard,is_continuous,intervals_earth_wire,metallic_supports,permanently_earthed,overhead_line_electricity,Make,Specifications,,protection,Normal_setting) values ('$swr_id','$today','$phase_earth','$voltage_Insulation','$type_size_guard','$is_continuous','$intervals_earth_wire','$metallic_supports','$permanently_earthed','$overhead_line_electricity','$Make','$Specifications','$protection','$Normal_setting')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',phase_earth='$phase_earth',voltage_Insulation='$voltage_Insulation',type_size_guard='$type_size_guard',is_continuous='$is_continuous',intervals_earth_wire='$intervals_earth_wire',metallic_supports='$metallic_supports', permanently_earthed='$permanently_earthed',overhead_line_electricity='$overhead_line_electricity',Make='$Make',Specifications='$Specifications',protection='$protection',Normal_setting='$Normal_setting' where form_id=$form_id");
	}				
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}						
}
if(isset($_POST["save25d"])){		
	$anti_climbing=clean($_POST["anti_climbing"]);
	
	if(!empty($_POST["lightning"]))	$lightning=json_encode($_POST["lightning"]);
	else	$lightning=NULL;
	$is_isolator=clean($_POST["is_isolator"]);
	$in_location=clean($_POST["in_location"]);$gang_switches=clean($_POST["gang_switches"]);$is_gang_switches=clean($_POST["is_gang_switches"]);$efficiently_earthed=clean($_POST["efficiently_earthed"]);$is_caution=clean($_POST["is_caution"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,anti_climbing,lightning,is_isolator,in_location,gang_switches,is_gang_switches,efficiently_earthed,is_caution) values('$swr_id','$today','$anti_climbing','$lightning','$is_isolator','$in_location','$gang_switches','$is_gang_switches','$efficiently_earthed','$is_caution')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',anti_climbing='$anti_climbing',lightning='$lightning',is_isolator='$is_isolator',in_location='$in_location',gang_switches='$gang_switches',is_gang_switches='$is_gang_switches',efficiently_earthed='$efficiently_earthed',is_caution='$is_caution' where form_id=$form_id")OR die("Error : ".$cei->error);
	}				
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}						
}

if(isset($_POST["save26a"])){
	
		$supplier_name=clean($_POST["supplier_name"]);	
		$name_trans_line=clean($_POST["name_trans_line"]);$primary_sub_stn=clean($_POST["primary_sub_stn"]);$secondary_sub_stn=clean($_POST["secondary_sub_stn"]);$capacity=clean($_POST["capacity"]);$sub_stn_type=clean($_POST["sub_stn_type"]);
		
			if(!empty($_POST["supplier_address"])) $supplier_address=json_encode($_POST["supplier_address"]);
			else $supplier_address=NULL;
			if(!empty($_POST["sub_stn"])) $sub_stn=json_encode($_POST["sub_stn"]);
			else $sub_stn=NULL;
			
			$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
			$row=$sql->fetch_array();
			
				if($sql->num_rows<1){   ////////////table is empty//////////////				
					$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,supplier_name,supplier_address,name_trans_line,primary_sub_stn,secondary_sub_stn,capacity,sub_stn_type,sub_stn) values ('$swr_id','$today','$supplier_name', '$supplier_address', '$name_trans_line','$primary_sub_stn','$secondary_sub_stn','$capacity','$sub_stn_type','$sub_stn')") ;
					$form_id=$query;
				}else{
					$form_id=$row["form_id"];	
					$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', supplier_name='$supplier_name',supplier_address='$supplier_address', name_trans_line='$name_trans_line', primary_sub_stn='$primary_sub_stn', secondary_sub_stn='$secondary_sub_stn',capacity='$capacity',sub_stn_type='$sub_stn_type',sub_stn='$sub_stn' where user_id='$swr_id' and form_id='$form_id'") ;	
				}				
				if($query){
					$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 27 -- form no 
					echo "<script>
						alert('Successfully Saved..');
						window.location.href = '".$table_name.".php?tab=2';
					</script>";
					
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = '".$table_name.".php?tab=2';
					</script>";
				}						

}
if(isset($_POST["save26b"])){
		
		if(!empty($_POST["specification"])) $specification=json_encode($_POST["specification"]);
			else $specification=NULL;
		if(!empty($_POST["in_test_res"])) $in_test_res=json_encode($_POST["in_test_res"]);
			else $in_test_res=NULL;
		if(!empty($_POST["cont_test_res"])) $cont_test_res=json_encode($_POST["cont_test_res"]);
			else $cont_test_res=NULL;
		if(!empty($_POST["insulation"])) $insulation=json_encode($_POST["insulation"]);
			else $insulation=NULL;		
			$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
			$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,specification,in_test_res,cont_test_res,insulation) values ('$swr_id','$today','$specification','$in_test_res','$cont_test_res','$insulation')") ;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set courier_details='1',sub_date='$today',  specification='$specification',in_test_res='$in_test_res',cont_test_res='$cont_test_res',insulation='$insulation' where user_id='$swr_id' and form_id='$form_id'") ;
	}
	if($query){
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save26c"])){
	
	$pad_mounted=clean($_POST["pad_mounted"]);$fencing_height=clean($_POST["fencing_height"]);$indoor_sub_stn=clean($_POST["indoor_sub_stn"]);$sub_stn_filled=clean($_POST["sub_stn_filled"]);
	$cond_arr=clean($_POST["cond_arr"]);$l_arrestors=clean($_POST["l_arrestors"]);
	
	if(!empty($_POST["protection"])) $protection=json_encode($_POST["protection"]);
	else $protection=NULL;	
	if(!empty($_POST["spec"])) $spec=json_encode($_POST["spec"]);
	else $spec=NULL;	
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,insulation,protection,spec,pad_mounted,fencing_height,indoor_sub_stn,sub_stn_filled,cond_arr ,l_arrestors) values ('$swr_id','$today','$insulation','$protection','$spec', '$pad_mounted','$fencing_height','$indoor_sub_stn','$sub_stn_filled','$cond_arr','$l_arrestors')") ;
		}else{	////////////table is not empty//////////////			
			$form_id=$row["form_id"];		
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',protection='$protection', spec='$spec', pad_mounted='$pad_mounted', fencing_height='$fencing_height',indoor_sub_stn='$indoor_sub_stn',sub_stn_filled='$sub_stn_filled',cond_arr='$cond_arr',l_arrestors='$l_arrestors'  where user_id='$swr_id' and form_id='$form_id'") ;
		}
	if($query){
			echo "<script>
				alert('Successfully saved.');
				window.location.href ='".$table_name.".php?tab=4';
			</script>";
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}			
}
if(isset($_POST["save26d"])){
		
		$type_LA=clean($_POST["type_LA"]);$pro_earthed=clean($_POST["pro_earthed"]);									
		$sub_stn_provision=clean($_POST["sub_stn_provision"]);$sub_stn_equip=clean($_POST["sub_stn_equip"]);
		$furnish_det=clean($_POST["furnish_det"]);									
		$s_provision=clean($_POST["s_provision"]);									
		$name_person=clean($_POST["name_person"]);
		if(!empty($_POST["testing"])) $testing=json_encode($_POST["testing"]);
		else $testing=NULL;
	
		$sql=$formFunctions->executeQuery($dept,"select form_id from cei_form26 where user_id='$swr_id' and active='1' and save_mode='D'");
		$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,type_LA,pro_earthed,sub_stn_provision,sub_stn_equip,furnish_det,s_provision,name_person,testing) values ('$swr_id','$today','$type_LA','$pro_earthed','$sub_stn_provision', '$sub_stn_equip', '$furnish_det','$s_provision','$name_person','$testing')") ;

	}else{	////////////table is not empty//////////////			
			$form_id=$row["form_id"];	
		
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',type_LA='$type_LA',pro_earthed='$pro_earthed', sub_stn_provision='$sub_stn_provision', sub_stn_equip='$sub_stn_equip', furnish_det='$furnish_det', s_provision='$s_provision',name_person='$name_person',testing='$testing' where user_id='$swr_id' and form_id='$form_id'") ;
	}
	
	if($query){
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
	}			
}

if(isset($_POST["save27"])){	

	$letter_no=clean($_POST["letter_no"]);$letter_dt=clean($_POST["letter_dt"]);$completed_on=clean($_POST["completed_on"]);
	$rated_speed=clean($_POST["rated_speed"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,letter_no,letter_dt,completed_on,rated_speed) values ('$swr_id','$today','$letter_no', '$letter_dt','$completed_on', '$rated_speed')") ;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', letter_no='$letter_no', letter_dt='$letter_dt', completed_on='$completed_on', rated_speed='$rated_speed' where form_id=$form_id") ;	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //cei-- dept name and 27 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}						
}

if(isset($_POST["save28a"])){
			$manager_name=clean($_POST["manager_name"]);
			$location_details=clean($_POST["location_details"]);
			$input_size1=clean($_POST["hiddenval"]);
			
			$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
			$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,manager_name,location_details) values ('$swr_id','$today','$today', '$manager_name','$location_details')") ;
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' , manager_name='$manager_name',location_details='$location_details' where user_id='$swr_id' and form_id='$form_id'") ;
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
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,capacity,voltage,alternator,engine,serial_no) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')") ;
				}
			}
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}
if(isset($_POST["save28b"])){
	
	$is_apdcl=clean($_POST["is_apdcl"]);$connected_load=clean($_POST["connected_load"]);$sanction_load=clean($_POST["sanction_load"]);$name_authority=clean($_POST["name_authority"]);$sanction_dt=clean($_POST["sanction_dt"]);$ref_sanction=clean($_POST["ref_sanction"]);$sub_division=clean($_POST["sub_division"]);$e_division=clean($_POST["e_division"]);$proposed_load=clean($_POST["proposed_load"]);$interlock_changeover=clean($_POST["interlock_changeover"]);
	
	if(!empty($_POST["generator"])) $generator=json_encode($_POST["generator"]);
	else $generator=NULL;
	if(!empty($_POST["other_speci"]))	 $other_speci=json_encode($_POST["other_speci"]);
	else $other_speci=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET is_apdcl='$is_apdcl',connected_load='$connected_load', sanction_load='$sanction_load',name_authority='$name_authority',sanction_dt='$sanction_dt',ref_sanction='$ref_sanction',sub_division='$sub_division',e_division='$e_division', proposed_load='$proposed_load',interlock_changeover='$interlock_changeover',generator='$generator',other_speci='$other_speci' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
	}	
	if($query){
	
		echo "<script>
				alert('Successfully saved.');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save28c"])){
	
	$isolated_mode=clean($_POST["isolated_mode"]);
	$protection_generator=clean($_POST["protection_generator"]);$designation_competency=clean($_POST["designation_competency"]);$is_installation=clean($_POST["is_installation"]);$is_installation_details=clean($_POST["is_installation_details"]);$contractor_person=clean($_POST["contractor_person"]);
	
	if(!empty($_POST["installation"])) $installation=json_encode($_POST["installation"]);
	else $installation=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET isolated_mode='$isolated_mode',protection_generator='$protection_generator',installation='$installation',contractor_person='$contractor_person',designation_competency='$designation_competency',is_installation='$is_installation',is_installation_details='$is_installation_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
	}	
	if($query){
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}			
}

if(isset($_POST["save29"])){
	
	        $year=clean($_POST["year"]);
			$reg_no=clean($_POST["reg_no"]);
			$class=clean($_POST["class"]);$lic_valid_upto=clean($_POST["lic_valid_upto"]);
			$from_date=clean($_POST["from_date"]);$to_date=clean($_POST["to_date"]);
			
			$input_size1=clean($_POST["hiddenval"]);
			
			$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
			$row=$sql->fetch_array();

	 if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,year,reg_no,class,lic_valid_upto,from_date,to_date) values ('$swr_id','$today','$today','$year','$reg_no','$class','$lic_valid_upto','$from_date','$to_date')") ;
		$form_id=$query;
	 }else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' , year='$year' where user_id='$swr_id' and form_id='$form_id'") ;
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
					$valh=$_POST["txtH".$i];
					$vali=$_POST["txtI".$i];
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,ref_no,name_address,name_supervisor,nm_entrusted,nm_apprecentice,date_completion,reference_test_report,report_sub) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali')") ;
				}
			}
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
	}			
}

if(isset($_POST["save30"])){
	$input_size1=clean($_POST["hiddenval"]);
	$regn_no=clean($_POST["regn_no"]);$license_class=clean($_POST["license_class"]);$license_date=clean($_POST["license_date"]);
	
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,regn_no,license_class,period,license_date) values ('$swr_id','$today','$regn_no','$license_class','$period','$license_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',regn_no='$regn_no',license_class='$license_class',period='$period',license_date='$license_date' where form_id=$form_id");		
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
	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,designation,supervisor,workmen,apprentice,permit_no,parts,validity) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali')");	
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

if(isset($_POST["save31"])){
	$input_size1=clean($_POST["hiddenval"]);	
	$exam_name=clean($_POST["exam_name"]);$certificate_class=clean($_POST["certificate_class"]);$applicant_name=clean($_POST["applicant_name"]);$birth_place=clean($_POST["birth_place"]);$birth_date=clean($_POST["birth_date"]);$is_citizen=clean($_POST["is_citizen"]);$is_citizen_details=clean($_POST["is_citizen_details"]);$father_name=clean($_POST["father_name"]);$father_nationality=clean($_POST["father_nationality"]);$centre=clean($_POST["centre"]);$language=clean($_POST["language"]);$test_name=clean($_POST["test_name"]);$challan=clean($_POST["challan"]);$challan_date=clean($_POST["challan_date"]);$amount=clean($_POST["amount"]);$rupees=clean($_POST["rupees"]);$treasury=clean($_POST["treasury"]);
	
	if(!empty($_POST["home"]))	  $home=json_encode($_POST["home"]);
	else	$home=NULL;
	if(!empty($_POST["present"]))	 $present=json_encode($_POST["present"]);
	else	$present=NULL;
	if(!empty($_POST["details"]))	 $details=json_encode($_POST["details"]);
	else	$details=NULL;
	if(!empty($_POST["service"]))	 $service=json_encode($_POST["service"]);
	else	$service=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,exam_name,certificate_class,applicant_name,birth_place,birth_date,is_citizen,is_citizen_details,father_name,father_nationality,centre,language,test_name,challan,challan_date,amount,rupees,treasury,home,present,details,service) values ('$swr_id','$today','$exam_name','$certificate_class','$applicant_name','$birth_place','$birth_date','$is_citizen','$is_citizen_details','$father_name','$father_nationality','$centre','$language','$test_name','$challan','$challan_date','$amount','$rupees','$treasury','$home','$present','$details','$service')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',exam_name='$exam_name',certificate_class='$certificate_class',applicant_name='$applicant_name',birth_place='$birth_place',birth_date='$birth_date',is_citizen='$is_citizen',is_citizen_details='$is_citizen_details',father_name='$father_name',father_nationality='$father_nationality',centre='$centre',language='$language',test_name='$test_name',challan='$challan',challan_date='$challan_date',amount='$amount',rupees='$rupees',treasury='$treasury',home='$home',present='$present',details='$details',service='$service' where form_id=$form_id");		
	}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,commencement,termination) VALUES ('','$form_id','$i','$valb','$valc')");	
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

?>