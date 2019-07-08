<?php
if(isset($_POST["save37a"])){
	$manuf_capacity=clean($_POST["manuf_capacity"]);$is_reg_dcssi=clean($_POST["is_reg_dcssi"]);$water_valid_consent=clean($_POST["water_valid_consent"]);$air_valid_consent=clean($_POST["air_valid_consent"]);$is_compliance=clean($_POST["is_compliance"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];

	if(!empty($_POST["reg_manufacture"])) $reg_manufacture=json_encode($_POST["reg_manufacture"]);
	else $reg_manufacture=NULL;
	if(!empty($_POST["old_reg_details"])) $old_reg_details=json_encode($_POST["old_reg_details"]);
	else	$old_reg_details=NULL;
	if(!empty($_POST["proj_invested"])) $proj_invested=json_encode($_POST["proj_invested"]);
	else $proj_invested=NULL;
	if(!empty($_POST["solid_waste"]))	 $solid_waste=json_encode($_POST["solid_waste"]);
	else	$solid_waste=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,manuf_capacity,is_reg_dcssi,water_valid_consent,air_valid_consent,reg_manufacture,old_reg_details,proj_invested,is_compliance,solid_waste) values ('$swr_id','$today','$today','$manuf_capacity', '$is_reg_dcssi','$water_valid_consent', '$air_valid_consent', '$reg_manufacture', '$old_reg_details', '$proj_invested', '$is_compliance','$solid_waste')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today',manuf_capacity='$manuf_capacity', is_reg_dcssi='$is_reg_dcssi', water_valid_consent='$water_valid_consent', air_valid_consent='$air_valid_consent', reg_manufacture='$reg_manufacture', old_reg_details='$old_reg_details', proj_invested='$proj_invested', is_compliance='$is_compliance', solid_waste='$solid_waste' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtaB".$i];
				$valc=$_POST["txtaC".$i];
				$vald=$_POST["txtaD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,type,quantum) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,raw,quantum) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
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
if(isset($_POST["save37b"])){
	$is_reg_dis=clean($_POST["is_reg_dis"]);$tot_capital_b=clean($_POST["tot_capital_b"]);$year_comm_b=clean($_POST["year_comm_b"]);$water_valid_radio=clean($_POST["water_valid_radio"]);$air_valid_radio=clean($_POST["air_valid_radio"]);
	$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];
	
	if(!empty($_POST["old_reg_details1"])) $old_reg_details1=json_encode($_POST["old_reg_details1"]);
	else $old_reg_details1=NULL;			
	if(!empty($_POST["solid_wasteb"])) $solid_wasteb=json_encode($_POST["solid_wasteb"]);
	else $solid_wasteb=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty/////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,is_reg_dis,tot_capital_b,old_reg_details1,year_comm_b,water_valid_radio,air_valid_radio,solid_wasteb) values ('$swr_id','$today','$today','$is_reg_dis','$tot_capital_b','$old_reg_details1','$year_comm_b','$water_valid_radio','$air_valid_radio','$solid_wasteb')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', received_date='$today',is_reg_dis='$is_reg_dis',tot_capital_b='$tot_capital_b',old_reg_details1='$old_reg_details1',year_comm_b='$year_comm_b',water_valid_radio='$water_valid_radio',air_valid_radio='$air_valid_radio',solid_wasteb='$solid_wasteb' where user_id='$swr_id' and form_id='$form_id'");
	}
	
	if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txttA".$i];			
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,name,type,quantum) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["texttA".$i];			
				$valb=$_POST["texttB".$i];
				$valc=$_POST["texttC".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,raw,quantum) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
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

if(isset($_POST["save38"])){ 
	$com_date=clean($_POST["com_date"]);$no_worker=clean($_POST["no_worker"]);$facilities_detail=clean($_POST["facilities_detail"]);$disposal_detail=clean($_POST["disposal_detail"]);$is_indus_provided=clean($_POST["is_indus_provided"]);$is_compliance=clean($_POST["is_compliance"]);$is_condition=clean($_POST["is_condition"]);$is_processed=clean($_POST["is_processed"]);$other_info=clean($_POST["other_info"]);	
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$input_size3=$_POST["hiddenval3"];
	
	if(!empty($_POST["contact_person"])) $contact_person=json_encode($_POST["contact_person"]);
		else $contact_person=NULL;
	if(!empty($_POST["const_validate"])) $const_validate=json_encode($_POST["const_validate"]);
		else $const_validate=NULL;
	if(!empty($_POST["plastic_waste"])) $plastic_waste=json_encode($_POST["plastic_waste"]);
		else $plastic_waste=NULL;
	if(isset($_POST["adq_system"])) $adq_system=clean($_POST["adq_system"]);
		else $adq_system="";
	if(isset($is_indus_provided) && $is_indus_provided=="N"){
		$adq_system="";
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,com_date,contact_person,no_worker,const_validate,disposal_detail,facilities_detail,plastic_waste,is_indus_provided,adq_system,is_compliance,is_condition,is_processed,other_info) values ('$swr_id','$today','$today','$com_date','$contact_person','$no_worker','$const_validate','$disposal_detail','$facilities_detail','$plastic_waste','$is_indus_provided','$adq_system','$is_compliance','$is_condition','$is_processed','$other_info')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',com_date='$com_date',contact_person='$contact_person', no_worker='$no_worker', disposal_detail='$disposal_detail', facilities_detail='$facilities_detail', plastic_waste='$plastic_waste', is_indus_provided='$is_indus_provided', adq_system='$adq_system', is_compliance='$is_compliance' , is_condition='$is_condition', is_processed='$is_processed', const_validate='$const_validate', other_info='$other_info' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,product,capacity) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,type,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txttA".$i];			
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,type,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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

if(isset($_POST["save39"])){
	$is_unit_registered=clean($_POST["is_unit_registered"]);$input_size=$_POST["hiddenval"];
	if(!empty($_POST["project"]))	 $project=json_encode($_POST["project"]);
	else	$project=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,is_unit_registered,project) values ('$swr_id','$today','$today','$is_unit_registered', '$project')");
		$form_id=$query;
	}else{				
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_unit_registered='$is_unit_registered', project='$project' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,producers,quantum) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
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

if(isset($_POST["save40"])){
	$capacity=clean($_POST["capacity"]);$tecno=clean($_POST["tecno"]);$quantity=clean($_POST["quantity"]);$qty_sent=clean($_POST["qty_sent"]);
						
	if(!empty($_POST["officer"])) $officer=json_encode($_POST["officer"]);
	else $officer=NULL;
	if(!empty($_POST["qty_p_w"]))	 $qty_p_w=json_encode($_POST["qty_p_w"]);
	else	$qty_p_w=NULL;
	if(!empty($_POST["facility"]))	 $facility=json_encode($_POST["facility"]);
	else	$facility=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,capacity,tecno,quantity,qty_sent,officer,qty_p_w,facility) values ('$swr_id','$today','$today','$capacity', '$tecno', '$quantity', '$qty_sent', '$officer', '$qty_p_w', '$facility')");
		$form_id=$query;
	}else{				
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today', capacity='$capacity',tecno='$tecno',qty_sent='$qty_sent', officer='$officer' ,  quantity='$quantity' , qty_p_w='$qty_p_w', facility='$facility' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST["save41"])){
	$is_reg_dcssi=clean($_POST["is_reg_dcssi"]);
	$water_valid_consent=clean($_POST["water_valid_consent"]);
	$air_valid_consent=clean($_POST["air_valid_consent"]);
	$manuf_capacity=clean($_POST["manuf_capacity"]);$min_sizes_cb=clean($_POST["min_sizes_cb"]);$compliance_status=clean($_POST["compliance_status"]);
	
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];			
	if(!empty($_POST["reg_manufacture"])) $reg_manufacture=json_encode($_POST["reg_manufacture"]);
		else $reg_manufacture=NULL;
				
	if(!empty($_POST["old_reg_details"])) $old_reg_details=json_encode($_POST["old_reg_details"]);
		else	$old_reg_details=NULL;
				
	if(!empty($_POST["proj_invested"])) $proj_invested=json_encode($_POST["proj_invested"]);
		else $proj_invested=NULL;
				
	if(!empty($_POST["solid_waste"]))	 $solid_waste=json_encode($_POST["solid_waste"]);
		else	$solid_waste=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,received_date,manuf_capacity,is_reg_dcssi,min_sizes_cb,compliance_status,water_valid_consent,air_valid_consent,reg_manufacture,old_reg_details,proj_invested,solid_waste) values ('$swr_id','$today','$today', '$manuf_capacity', '$is_reg_dcssi', '$min_sizes_cb', '$compliance_status','$water_valid_consent', '$air_valid_consent', '$reg_manufacture', '$old_reg_details', '$proj_invested','$solid_waste')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',manuf_capacity='$manuf_capacity', is_reg_dcssi='$is_reg_dcssi', min_sizes_cb='$min_sizes_cb', compliance_status='$compliance_status',water_valid_consent='$water_valid_consent', air_valid_consent='$air_valid_consent', reg_manufacture='$reg_manufacture', old_reg_details='$old_reg_details', proj_invested='$proj_invested', solid_waste='$solid_waste' where user_id='$swr_id' and form_id='$form_id'");
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,ty_pe,quantum) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,raw,quantum) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
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
if(isset($_POST["save56"])){ 
	$com_date=clean($_POST["com_date"]);$no_worker=clean($_POST["no_worker"]);$facilities_detail=clean($_POST["facilities_detail"]);$disposal_detail=clean($_POST["disposal_detail"]);$is_indus_provided=clean($_POST["is_indus_provided"]);$is_compliance=clean($_POST["is_compliance"]);$is_condition=clean($_POST["is_condition"]);$is_processed=clean($_POST["is_processed"]);$other_info=clean($_POST["other_info"]);	
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$input_size3=$_POST["hiddenval3"];
	
	if(!empty($_POST["contact_person"])) $contact_person=json_encode($_POST["contact_person"]);
		else $contact_person=NULL;
	if(!empty($_POST["const_validate"])) $const_validate=json_encode($_POST["const_validate"]);
		else $const_validate=NULL;
	if(!empty($_POST["plastic_waste"])) $plastic_waste=json_encode($_POST["plastic_waste"]);
		else $plastic_waste=NULL;
	if(isset($_POST["adq_system"])) $adq_system=clean($_POST["adq_system"]);
		else $adq_system="";
	if(isset($is_indus_provided) && $is_indus_provided=="N"){
		$adq_system="";
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,received_date,com_date,contact_person,no_worker,const_validate,disposal_detail,facilities_detail,plastic_waste,is_indus_provided,adq_system,is_compliance,is_condition,is_processed,other_info) values ('$swr_id','$today','$today','$com_date','$contact_person','$no_worker','$const_validate','$disposal_detail','$facilities_detail','$plastic_waste','$is_indus_provided','$adq_system','$is_compliance','$is_condition','$is_processed','$other_info')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',com_date='$com_date',contact_person='$contact_person', no_worker='$no_worker', disposal_detail='$disposal_detail', facilities_detail='$facilities_detail', plastic_waste='$plastic_waste', is_indus_provided='$is_indus_provided', adq_system='$adq_system', is_compliance='$is_compliance' , is_condition='$is_condition', is_processed='$is_processed', const_validate='$const_validate', other_info='$other_info' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,product,capacity) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,type,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txttA".$i];			
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,type,category,qty) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
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

if(isset($_POST["save57"])){
	$is_unit_registered=clean($_POST["is_unit_registered"]);$input_size=$_POST["hiddenval"];
	
	if(!empty($_POST["pre_reg"])) $pre_reg=json_encode($_POST["pre_reg"]);
	else $pre_reg=NULL;
	if(!empty($_POST["project"]))	 $project=json_encode($_POST["project"]);
	else	$project=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,received_date,is_unit_registered,pre_reg,project) values ('$swr_id','$today','$today','$is_unit_registered', '$pre_reg', '$project')");
		$form_id=$query;
	}else{				
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_unit_registered='$is_unit_registered', pre_reg='$pre_reg', project='$project' where form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,producers,quantum) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
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


if(isset($_POST["save55a"])){
	$manuf_capacity=clean($_POST["manuf_capacity"]);$is_reg_dcssi=clean($_POST["is_reg_dcssi"]);$water_valid_consent=clean($_POST["water_valid_consent"]);$air_valid_consent=clean($_POST["air_valid_consent"]);$is_compliance=clean($_POST["is_compliance"]);$plastic_wastes=clean($_POST["plastic_wastes"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$input_size5=$_POST["hiddenval5"];$input_size6=$_POST["hiddenval6"];

	if(!empty($_POST["reg_manufacture"])) $reg_manufacture=json_encode($_POST["reg_manufacture"]);
	else $reg_manufacture=NULL;
	if(!empty($_POST["old_reg_details"])) $old_reg_details=json_encode($_POST["old_reg_details"]);
	else	$old_reg_details=NULL;
	if(!empty($_POST["proj_invested"])) $proj_invested=json_encode($_POST["proj_invested"]);
	else $proj_invested=NULL;
	if(!empty($_POST["solid_waste"]))	 $solid_waste=json_encode($_POST["solid_waste"]);
	else	$solid_waste=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,received_date,manuf_capacity,is_reg_dcssi,water_valid_consent,air_valid_consent,reg_manufacture,old_reg_details,proj_invested,is_compliance,solid_waste,plastic_wastes) values ('$swr_id','$today','$today','$manuf_capacity', '$is_reg_dcssi','$water_valid_consent', '$air_valid_consent', '$reg_manufacture', '$old_reg_details', '$proj_invested', '$is_compliance','$solid_waste','$plastic_wastes')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today',manuf_capacity='$manuf_capacity', is_reg_dcssi='$is_reg_dcssi', water_valid_consent='$water_valid_consent', air_valid_consent='$air_valid_consent', reg_manufacture='$reg_manufacture', old_reg_details='$old_reg_details', proj_invested='$proj_invested', is_compliance='$is_compliance', solid_waste='$solid_waste',plastic_wastes='$plastic_wastes' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtaB".$i];
				$valc=$_POST["txtaC".$i];
				$vald=$_POST["txtaD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,type,quantum) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,raw,quantum) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["tbB".$i];
			$valc=$_POST["tbC".$i];
			$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,name12,address12) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["txxxtB".$i];
			$valc=$_POST["txxxtC".$i];
			$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,slno,name1,address1) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
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

if(isset($_POST["save55b"])){
	$is_reg_dis=clean($_POST["is_reg_dis"]);$tot_capital_b=clean($_POST["tot_capital_b"]);$year_comm_b=clean($_POST["year_comm_b"]);$water_valid_radio=clean($_POST["water_valid_radio"]);$air_valid_radio=clean($_POST["air_valid_radio"]);$plastic_wastes1=clean($_POST["plastic_wastes1"]);
	$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];$input_size7=$_POST["hiddenval7"];
	
	if(!empty($_POST["old_reg_details1"])) $old_reg_details1=json_encode($_POST["old_reg_details1"]);
	else $old_reg_details1=NULL;			
	if(!empty($_POST["solid_wasteb"])) $solid_wasteb=json_encode($_POST["solid_wasteb"]);
	else $solid_wasteb=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty/////////////
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,received_date,is_reg_dis,tot_capital_b,old_reg_details1,year_comm_b,water_valid_radio,air_valid_radio,solid_wasteb,plastic_wastes1) values ('$swr_id','$today','$today','$is_reg_dis','$tot_capital_b','$old_reg_details1','$year_comm_b','$water_valid_radio','$air_valid_radio','$solid_wasteb','$plastic_wastes1')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today',is_reg_dis='$is_reg_dis',tot_capital_b='$tot_capital_b',old_reg_details1='$old_reg_details1',year_comm_b='$year_comm_b',water_valid_radio='$water_valid_radio',air_valid_radio='$air_valid_radio',solid_wasteb='$solid_wasteb',plastic_wastes1='$plastic_wastes1' where user_id='$swr_id' and form_id='$form_id'");
	}
	
	if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txttA".$i];			
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,name,type,quantum) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["texttA".$i];			
				$valb=$_POST["texttB".$i];
				$valc=$_POST["texttC".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,raw,quantum) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["texttA".$i];			
				$valb=$_POST["tattB".$i];
				$valc=$_POST["tattC".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(form_id,slno,name2,address2) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
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

?>