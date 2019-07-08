<?php
if(isset($_POST["save11"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);	
	$lease_with_respect=clean($_POST["lease_with_respect"]);$land_measure=clean($_POST["land_measure"]);
	
	$is_statutory=clean($_POST["is_statutory"]);$is_statutory_details1=clean($_POST["is_statutory_details1"]);$is_statutory_details2=clean($_POST["is_statutory_details2"]);
	
	$applicant_profession=clean($_POST["applicant_profession"]);$applicant_nature=clean($_POST["applicant_nature"]);
	$items=clean($_POST["items"]);$period_of_license=clean($_POST["period_of_license"]);$area_extent=clean($_POST["area_extent"]);
	if(!empty($_POST["details"]))	 $details=json_encode($_POST["details"]);
	else	$details=NULL;
	if(!empty($_POST["applied_area"]))	 $applied_area=json_encode($_POST["applied_area"]);
	else	$applied_area=NULL;
	
	$area_description=clean($_POST["area_description"]);$proposed_area=clean($_POST["proposed_area"]);
	$area_mining_lease_a=clean($_POST["area_mining_lease_a"]);
	$start_mining_date=clean($_POST["start_mining_date"]);$targeted_production=clean($_POST["targeted_production"]);$any_particulars=clean($_POST["any_particulars"]);
	
	$start_mining_date=date("Y-m-d",strtotime($start_mining_date));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,lease_with_respect,land_measure,is_statutory,is_statutory_details1,is_statutory_details2,applicant_profession,applicant_nature,items,period_of_license,area_extent,details,applied_area,area_description,proposed_area,area_mining_lease_a,start_mining_date,targeted_production,any_particulars) values ('$swr_id','$today','$lease_with_respect','$land_measure','$is_statutory','$is_statutory_details1', '$is_statutory_details2','$applicant_profession','$applicant_nature','$items','$period_of_license','$area_extent','$details','$applied_area','$area_description','$proposed_area','$area_mining_lease_a','$start_mining_date','$targeted_production','$any_particulars')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',lease_with_respect='$lease_with_respect',land_measure='$land_measure',is_statutory='$is_statutory',is_statutory_details1='$is_statutory_details1',is_statutory_details2='$is_statutory_details2',applicant_profession='$applicant_profession',applicant_nature='$applicant_nature',items='$items',period_of_license='$period_of_license',area_extent='$area_extent',details='$details',applied_area='$applied_area',area_description='$area_description',proposed_area='$proposed_area',area_mining_lease_a='$area_mining_lease_a',start_mining_date='$start_mining_date',targeted_production='$targeted_production',any_particulars='$any_particulars' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 12 -- form no 
		if($input_size1!=0){
				
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,address) VALUES ('','$form_id','$i','$valb','$valc')");
				
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,designation,address) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save12"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);	
	$lease_with_respect=clean($_POST["lease_with_respect"]);$land_measure=clean($_POST["land_measure"]);
	
	$is_statutory=clean($_POST["is_statutory"]);$is_statutory_details1=clean($_POST["is_statutory_details1"]);$is_statutory_details2=clean($_POST["is_statutory_details2"]);
	
	$applicant_profession=clean($_POST["applicant_profession"]);$applicant_nature=clean($_POST["applicant_nature"]);
	$items=clean($_POST["items"]);$period_of_license=clean($_POST["period_of_license"]);$area_extent=clean($_POST["area_extent"]);
	if(!empty($_POST["details"]))	 $details=json_encode($_POST["details"]);
	else	$details=NULL;
	if(!empty($_POST["applied_area"]))	 $applied_area=json_encode($_POST["applied_area"]);
	else	$applied_area=NULL;
	
	$area_description=clean($_POST["area_description"]);$proposed_area=clean($_POST["proposed_area"]);
	$area_mining_lease_a=clean($_POST["area_mining_lease_a"]);
	$start_mining_date=clean($_POST["start_mining_date"]);$targeted_production=clean($_POST["targeted_production"]);$any_particulars=clean($_POST["any_particulars"]);
	
	$start_mining_date=date("Y-m-d",strtotime($start_mining_date));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,lease_with_respect,land_measure,is_statutory,is_statutory_details1,is_statutory_details2,applicant_profession,applicant_nature,items,period_of_license,area_extent,details,applied_area,area_description,proposed_area,area_mining_lease_a,start_mining_date,targeted_production,any_particulars) values ('$swr_id','$today','$lease_with_respect','$land_measure','$is_statutory','$is_statutory_details1', '$is_statutory_details2','$applicant_profession','$applicant_nature','$items','$period_of_license','$area_extent','$details','$applied_area','$area_description','$proposed_area','$area_mining_lease_a','$start_mining_date','$targeted_production','$any_particulars')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',lease_with_respect='$lease_with_respect',land_measure='$land_measure',is_statutory='$is_statutory',is_statutory_details1='$is_statutory_details1',is_statutory_details2='$is_statutory_details2',applicant_profession='$applicant_profession',applicant_nature='$applicant_nature',items='$items',period_of_license='$period_of_license',area_extent='$area_extent',details='$details',applied_area='$applied_area',area_description='$area_description',proposed_area='$proposed_area',area_mining_lease_a='$area_mining_lease_a',start_mining_date='$start_mining_date',targeted_production='$targeted_production',any_particulars='$any_particulars' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 12 -- form no 
		if($input_size1!=0){
				
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,address) VALUES ('','$form_id','$i','$valb','$valc')");
				
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,designation,address) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save13"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);	
	$lease_with_respect=clean($_POST["lease_with_respect"]);$land_measure=clean($_POST["land_measure"]);
	
	$is_statutory=clean($_POST["is_statutory"]);$is_statutory_details1=clean($_POST["is_statutory_details1"]);$is_statutory_details2=clean($_POST["is_statutory_details2"]);
	
	$applicant_profession=clean($_POST["applicant_profession"]);$applicant_nature=clean($_POST["applicant_nature"]);
	$items=clean($_POST["items"]);$period_of_license=clean($_POST["period_of_license"]);$area_extent=clean($_POST["area_extent"]);
	if(!empty($_POST["details"]))	 $details=json_encode($_POST["details"]);
	else	$details=NULL;
	if(!empty($_POST["applied_area"]))	 $applied_area=json_encode($_POST["applied_area"]);
	else	$applied_area=NULL;
	
	$area_description=clean($_POST["area_description"]);$proposed_area=clean($_POST["proposed_area"]);
	$area_mining_lease_a=clean($_POST["area_mining_lease_a"]);
	$start_mining_date=clean($_POST["start_mining_date"]);$targeted_production=clean($_POST["targeted_production"]);$any_particulars=clean($_POST["any_particulars"]);
	
	$start_mining_date=date("Y-m-d",strtotime($start_mining_date));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,lease_with_respect,land_measure,is_statutory,is_statutory_details1,is_statutory_details2,applicant_profession,applicant_nature,items,period_of_license,area_extent,details,applied_area,area_description,proposed_area,area_mining_lease_a,start_mining_date,targeted_production,any_particulars) values ('$swr_id','$today','$lease_with_respect','$land_measure','$is_statutory','$is_statutory_details1', '$is_statutory_details2','$applicant_profession','$applicant_nature','$items','$period_of_license','$area_extent','$details','$applied_area','$area_description','$proposed_area','$area_mining_lease_a','$start_mining_date','$targeted_production','$any_particulars')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',lease_with_respect='$lease_with_respect',land_measure='$land_measure',is_statutory='$is_statutory',is_statutory_details1='$is_statutory_details1',is_statutory_details2='$is_statutory_details2',applicant_profession='$applicant_profession',applicant_nature='$applicant_nature',items='$items',period_of_license='$period_of_license',area_extent='$area_extent',details='$details',applied_area='$applied_area',area_description='$area_description',proposed_area='$proposed_area',area_mining_lease_a='$area_mining_lease_a',start_mining_date='$start_mining_date',targeted_production='$targeted_production',any_particulars='$any_particulars' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 12 -- form no 
		if($input_size1!=0){
				
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,address) VALUES ('','$form_id','$i','$valb','$valc')");
				
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,designation,address) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save14"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);	
	$lease_with_respect=clean($_POST["lease_with_respect"]);$land_measure=clean($_POST["land_measure"]);
	
	$is_statutory=clean($_POST["is_statutory"]);$is_statutory_details1=clean($_POST["is_statutory_details1"]);$is_statutory_details2=clean($_POST["is_statutory_details2"]);
	
	$applicant_profession=clean($_POST["applicant_profession"]);$applicant_nature=clean($_POST["applicant_nature"]);
	$items=clean($_POST["items"]);$period_of_license=clean($_POST["period_of_license"]);$area_extent=clean($_POST["area_extent"]);
	if(!empty($_POST["details"]))	 $details=json_encode($_POST["details"]);
	else	$details=NULL;
	if(!empty($_POST["applied_area"]))	 $applied_area=json_encode($_POST["applied_area"]);
	else	$applied_area=NULL;
	
	$area_description=clean($_POST["area_description"]);$proposed_area=clean($_POST["proposed_area"]);
	$area_mining_lease_a=clean($_POST["area_mining_lease_a"]);
	$start_mining_date=clean($_POST["start_mining_date"]);$targeted_production=clean($_POST["targeted_production"]);$any_particulars=clean($_POST["any_particulars"]);
	
	$start_mining_date=date("Y-m-d",strtotime($start_mining_date));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,lease_with_respect,land_measure,is_statutory,is_statutory_details1,is_statutory_details2,applicant_profession,applicant_nature,items,period_of_license,area_extent,details,applied_area,area_description,proposed_area,area_mining_lease_a,start_mining_date,targeted_production,any_particulars) values ('$swr_id','$today','$lease_with_respect','$land_measure','$is_statutory','$is_statutory_details1', '$is_statutory_details2','$applicant_profession','$applicant_nature','$items','$period_of_license','$area_extent','$details','$applied_area','$area_description','$proposed_area','$area_mining_lease_a','$start_mining_date','$targeted_production','$any_particulars')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',lease_with_respect='$lease_with_respect',land_measure='$land_measure',is_statutory='$is_statutory',is_statutory_details1='$is_statutory_details1',is_statutory_details2='$is_statutory_details2',applicant_profession='$applicant_profession',applicant_nature='$applicant_nature',items='$items',period_of_license='$period_of_license',area_extent='$area_extent',details='$details',applied_area='$applied_area',area_description='$area_description',proposed_area='$proposed_area',area_mining_lease_a='$area_mining_lease_a',start_mining_date='$start_mining_date',targeted_production='$targeted_production',any_particulars='$any_particulars' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 14 -- form no 
		if($input_size1!=0){
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,address) VALUES ('','$form_id','$i','$valb','$valc')");
				
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,designation,address) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save16"])){
	   
	$brick_category=clean($_POST["brick_category"]);$area_applied=clean($_POST["area_applied"]);$status_land=clean($_POST["status_land"]);$brick_quantity=clean($_POST["brick_quantity"]);$advance_amount=clean($_POST["advance_amount"]);$secu_rity=clean($_POST["secu_rity"]);
	
	if(!empty($_POST["brick_location"]))	 $brick_location=json_encode($_POST["brick_location"]);
	else	$brick_location=NULL;
	if(!empty($_POST["brick_earth"]))	 $brick_earth=json_encode($_POST["brick_earth"]);
	else	$brick_earth=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,brick_location,brick_category,brick_earth,area_applied,status_land,brick_quantity,advance_amount,secu_rity) values ('$swr_id','$today','$brick_location','$brick_category','$brick_earth','$area_applied','$status_land','$brick_quantity','$advance_amount','$secu_rity')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',brick_location='$brick_location',brick_category='$brick_category',brick_earth='$brick_earth',area_applied='$area_applied',status_land='$status_land',brick_quantity='$brick_quantity',advance_amount='$advance_amount',secu_rity='$secu_rity' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 16 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}
if(isset($_POST["save17"])){
	
	$land_measure=clean($_POST["land_measure"]);$details_of_dag=clean($_POST["details_of_dag"]);$area_location=clean($_POST["area_location"]);$purpose=clean($_POST["purpose"]);$total_area=clean($_POST["total_area"]);$extent_area_l=clean($_POST["extent_area_l"]);$extent_area_b=clean($_POST["extent_area_b"]);$extent_area_d=clean($_POST["extent_area_d"]);$qty_of_clay_removed=clean($_POST["qty_of_clay_removed"]);$qty_of_clay_disposed=clean($_POST["qty_of_clay_disposed"]);$existing_status=clean($_POST["existing_status"]);$advance_royalty=clean($_POST["advance_royalty"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,land_measure,details_of_dag,area_location,purpose,total_area,extent_area_l,extent_area_b,extent_area_d,qty_of_clay_removed,qty_of_clay_disposed,existing_status,advance_royalty) values ('$swr_id','$today','$land_measure','$details_of_dag','$area_location', '$purpose','$total_area','$extent_area_l','$extent_area_b','$extent_area_d','$qty_of_clay_removed','$qty_of_clay_disposed','$existing_status','$advance_royalty')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',land_measure='$land_measure',details_of_dag='$details_of_dag',area_location='$area_location',purpose='$purpose',total_area='$total_area',extent_area_l='$extent_area_l',extent_area_b='$extent_area_b', extent_area_d='$extent_area_d', qty_of_clay_removed='$qty_of_clay_removed',qty_of_clay_disposed='$qty_of_clay_disposed',existing_status='$existing_status',advance_royalty='$advance_royalty' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 17 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}
if(isset($_POST["save19a"])){
	$nationality=clean($_POST["nationality"]);$place_of_business=clean($_POST["place_of_business"]);$name_of_minerals=clean($_POST["name_of_minerals"]);$map_description=clean($_POST["map_description"]);$is_renewal_applied=clean($_POST["is_renewal_applied"]);$minerals_raised=clean($_POST["minerals_raised"]);$year_wise_qty=clean($_POST["year_wise_qty"]);
	
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	if(!empty($_POST["utilization"]))	 $utilization=json_encode($_POST["utilization"]);
	else	$utilization=NULL;
	if(!empty($_POST["statement"]))	 $statement=json_encode($_POST["statement"]);
	else	$statement=NULL;
	if(!empty($_POST["period_renewal"]))	 $period_renewal=json_encode($_POST["period_renewal"]);
	else	$period_renewal=NULL;
	if(!empty($_POST["renewal_applied"]))	 $renewal_applied=json_encode($_POST["renewal_applied"]);
	else	$renewal_applied=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,nationality,place_of_business,name_of_minerals,period,utilization,map_description,statement,period_renewal,is_renewal_applied,renewal_applied,minerals_raised,year_wise_qty) values ('$swr_id','$today', '$nationality','$place_of_business','$name_of_minerals', '$period', '$utilization','$map_description','$statement','$period_renewal','$is_renewal_applied','$renewal_applied','$minerals_raised','$year_wise_qty')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', nationality='$nationality',place_of_business='$place_of_business', name_of_minerals='$name_of_minerals', period='$period',utilization='$utilization',map_description='$map_description',statement='$statement',period_renewal='$period_renewal',is_renewal_applied='$is_renewal_applied',renewal_applied='$renewal_applied',minerals_raised='$minerals_raised',year_wise_qty='$year_wise_qty' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 19 -- form no 
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
if(isset($_POST["save19b"])){
	$minerals_available=clean($_POST["minerals_available"]);$details_of_explorations=clean($_POST["details_of_explorations"]);$details_of_area=clean($_POST["details_of_area"]);$details_of_site=clean($_POST["details_of_site"]);
	$details_of_defaults=clean($_POST["details_of_defaults"]);$details_of_investment=clean($_POST["details_of_investment"]);$any_particulars=clean($_POST["any_particulars"]);$name_of_village=clean($_POST["name_of_village"]);$sub_division=clean($_POST["sub_division"]);$schedule_district1=clean($_POST["schedule_district1"]);$name_of_range=clean($_POST["name_of_range"]);$schedule_patta_no=clean($_POST["schedule_patta_no"]);$schedule_area=clean($_POST["schedule_area"]);$schedule_desc=clean($_POST["schedule_desc"]);$schedule_felling_series=clean($_POST["schedule_felling_series"]);$schedule_district2=clean($_POST["schedule_district2"]);
	
	if(!empty($_POST["compliance"]))	 $compliance=json_encode($_POST["compliance"]);
	else	$compliance=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,minerals_available,details_of_explorations,details_of_area,details_of_site,compliance,details_of_defaults,details_of_investment,any_particulars,name_of_village,sub_division,schedule_district1,name_of_range,schedule_patta_no,schedule_area,schedule_desc,schedule_felling_series,schedule_district2) values ('$swr_id','$today', '$minerals_available','$details_of_explorations','$details_of_area', '$details_of_site', '$compliance','$details_of_defaults','$details_of_investment','$any_particulars','$name_of_village','$sub_division','$schedule_district1','$name_of_range','$schedule_patta_no','$schedule_area','$schedule_desc','$schedule_felling_series','$schedule_district2')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', minerals_available='$minerals_available',details_of_explorations='$details_of_explorations', details_of_area='$details_of_area', details_of_site='$details_of_site',compliance='$compliance',details_of_defaults='$details_of_defaults',details_of_investment='$details_of_investment',any_particulars='$any_particulars',name_of_village='$name_of_village',sub_division='$sub_division',schedule_district1='$schedule_district1',name_of_range='$name_of_range',schedule_patta_no='$schedule_patta_no',schedule_area='$schedule_area',schedule_desc='$schedule_desc',schedule_felling_series='$schedule_felling_series',schedule_district2='$schedule_district2' where form_id=$form_id");
	}				
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}						
}
if(isset($_POST["save20a"])){
	$nationality=clean($_POST["nationality"]);$place_of_business=clean($_POST["place_of_business"]);$name_of_minerals=clean($_POST["name_of_minerals"]);$map_description=clean($_POST["map_description"]);$is_renewal_applied=clean($_POST["is_renewal_applied"]);$minerals_raised=clean($_POST["minerals_raised"]);$year_wise_qty=clean($_POST["year_wise_qty"]);
	
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	if(!empty($_POST["utilization"]))	 $utilization=json_encode($_POST["utilization"]);
	else	$utilization=NULL;
	if(!empty($_POST["statement"]))	 $statement=json_encode($_POST["statement"]);
	else	$statement=NULL;
	if(!empty($_POST["period_renewal"]))	 $period_renewal=json_encode($_POST["period_renewal"]);
	else	$period_renewal=NULL;
	if(!empty($_POST["renewal_applied"]))	 $renewal_applied=json_encode($_POST["renewal_applied"]);
	else	$renewal_applied=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,nationality,place_of_business,name_of_minerals,period,utilization,map_description,statement,period_renewal,is_renewal_applied,renewal_applied,minerals_raised,year_wise_qty) values ('$swr_id','$today', '$nationality','$place_of_business','$name_of_minerals', '$period', '$utilization','$map_description','$statement','$period_renewal','$is_renewal_applied','$renewal_applied','$minerals_raised','$year_wise_qty')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', nationality='$nationality',place_of_business='$place_of_business', name_of_minerals='$name_of_minerals', period='$period',utilization='$utilization',map_description='$map_description',statement='$statement',period_renewal='$period_renewal',is_renewal_applied='$is_renewal_applied',renewal_applied='$renewal_applied',minerals_raised='$minerals_raised',year_wise_qty='$year_wise_qty' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 19 -- form no 
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
if(isset($_POST["save20b"])){
	$minerals_available=clean($_POST["minerals_available"]);$details_of_explorations=clean($_POST["details_of_explorations"]);$details_of_area=clean($_POST["details_of_area"]);$details_of_site=clean($_POST["details_of_site"]);
	$details_of_defaults=clean($_POST["details_of_defaults"]);$details_of_investment=clean($_POST["details_of_investment"]);$any_particulars=clean($_POST["any_particulars"]);$name_of_village=clean($_POST["name_of_village"]);$name_of_range=clean($_POST["name_of_range"]);$schedule_patta_no=clean($_POST["schedule_patta_no"]);$schedule_area=clean($_POST["schedule_area"]);$schedule_desc=clean($_POST["schedule_desc"]);$schedule_felling_series=clean($_POST["schedule_felling_series"]);$schedule_district2=clean($_POST["schedule_district2"]);
	
	if(!empty($_POST["compliance"]))	 $compliance=json_encode($_POST["compliance"]);
	else	$compliance=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,minerals_available,details_of_explorations,details_of_area,details_of_site,compliance,details_of_defaults,details_of_investment,any_particulars,name_of_village,name_of_range,schedule_patta_no,schedule_area,schedule_desc,schedule_felling_series,schedule_district2) values ('$swr_id','$today', '$minerals_available','$details_of_explorations','$details_of_area', '$details_of_site', '$compliance','$details_of_defaults','$details_of_investment','$any_particulars','$name_of_village','$name_of_range','$schedule_patta_no','$schedule_area','$schedule_desc','$schedule_felling_series','$schedule_district2')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', minerals_available='$minerals_available',details_of_explorations='$details_of_explorations', details_of_area='$details_of_area', details_of_site='$details_of_site',compliance='$compliance',details_of_defaults='$details_of_defaults',details_of_investment='$details_of_investment',any_particulars='$any_particulars',name_of_village='$name_of_village',name_of_range='$name_of_range',schedule_patta_no='$schedule_patta_no',schedule_area='$schedule_area',schedule_desc='$schedule_desc',schedule_felling_series='$schedule_felling_series',schedule_district2='$schedule_district2' where form_id=$form_id");
	}				
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}						
}

?>