<?php
if(isset($_POST["save1a"])){		
	$profession=clean($_POST["profession"]);$permit=clean($_POST["permit"]);$minerals=clean($_POST["minerals"]);$prospect=clean($_POST["prospect"]);
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["applicant"]))	 $applicant=json_encode($_POST["applicant"]);
	else	$applicant=NULL;
	if(!empty($_POST["clearance"]))	 $clearance=json_encode($_POST["clearance"]);
	else	$clearance=NULL;
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant,profession,clearance,permit,minerals,prospect,period) values ('$swr_id','$today', '$applicant','$profession', '$clearance', '$permit', '$minerals','$prospect','$period')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', applicant='$applicant',profession='$profession', clearance='$clearance', permit='$permit', minerals='$minerals',prospect='$prospect',period='$period' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 1 -- form no 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,dist,taluq,area) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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
if(isset($_POST["save1b"])){		
	$nature=clean($_POST["nature"]);$details=clean($_POST["details"]);$resources=clean($_POST["resources"]);$annual_target=clean($_POST["annual_target"]);$area_scheme=clean($_POST["area_scheme"]);$anticipated=clean($_POST["anticipated"]);$other_details=clean($_POST["other_details"]);
	
	if(!empty($_POST["particulars"]))	 $particulars=json_encode($_POST["particulars"]);
	else	$particulars=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,particulars,nature,details,resources,annual_target,area_scheme,anticipated,other_details) values ('$swr_id','$today', '$particulars', '$nature', '$details','$resources', '$annual_target', '$area_scheme', '$anticipated','$other_details')");			
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', particulars='$particulars', nature='$nature', details='$details',resources='$resources', annual_target='$annual_target', area_scheme='$area_scheme', anticipated='$anticipated', other_details='$other_details' where form_id=$form_id");
	}				
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save2a"])){
	$profession=clean($_POST["profession"]);$permit=clean($_POST["permit"]);$minerals=clean($_POST["minerals"]);

	if(!empty($_POST["applicant"]))	 $applicant=json_encode($_POST["applicant"]);
	else	$applicant=NULL;
	if(!empty($_POST["clearance"]))	 $clearance=json_encode($_POST["clearance"]);
	else	$clearance=NULL;
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant,profession,clearance,permit,minerals,period) values ('$swr_id','$today', '$applicant','$profession','$clearance', '$permit', '$minerals','$period')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', applicant='$applicant',profession='$profession', permit='$permit', minerals='$minerals',period='$period' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 2 -- form no 
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
		$prospect=clean($_POST['prospect']);$is_residential=clean($_POST['is_residential']);
		$circle_name=clean($_POST['circle_name']);$forest_range=clean($_POST['forest_range']);$felling_series=clean($_POST['felling_series']);$nature_joint=clean($_POST['nature_joint']);$resource=clean($_POST['resource']);
		
		$input_size1=$_POST["hiddenval1"];$input_size2=$_POST["hiddenval2"];
		
		if(!empty($_POST["particulars"]))	 $particulars=json_encode($_POST["particulars"]);
		else	$particulars=NULL;
		if(!empty($_POST["area"]))	 $area=json_encode($_POST["area"]);
		else	$area=NULL;
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
		}else{  ////////////table is not empty//////////////
				$form_id=$row["form_id"];
				$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET prospect='$prospect',is_residential='$is_residential',area='$area',circle_name='$circle_name',forest_range='$forest_range',felling_series='$felling_series',particulars='$particulars',nature_joint='$nature_joint',resource='$resource' WHERE form_id='$form_id'");
			}
		if($query){
			if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size1;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["textB".$i];
					$valc=$_POST["textC".$i];
					$vald=$_POST["textD".$i];
					$vale=$_POST["textE".$i];
					$valf=$_POST["textF".$i];	
					$valg=$_POST["textG".$i];	
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,district,taluq,village,khasra_no,plot_no,area) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
				}
			}
			if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];						
					$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,sl_no,name,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save3a"])){			
	$profession=clean($_POST["profession"]);$prospecting_lic=clean($_POST["prospecting_lic"]);$p_renewal=clean($_POST["p_renewal"]);$Reasons_pros_lic=clean($_POST["Reasons_pros_lic"]);$arrr_renewal=clean($_POST["arrr_renewal"]);$area_renewal=clean($_POST["area_renewal"]);
	
	$is_residential=clean($_POST["is_residential"]);
	$is_renewal=clean($_POST["is_renewal"]);
	
	if(!empty($_POST["applicant"]))	 $applicant=json_encode($_POST["applicant"]);
	else	$applicant=NULL;
	if(!empty($_POST["clearance"]))	 $clearance=json_encode($_POST["clearance"]);
	else	$clearance=NULL;
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
    
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant,profession,clearance,prospecting_lic,p_renewal,Reasons_pros_lic,period,is_renewal,arrr_renewal,area_renewal,is_residential) values ('$swr_id','$today', '$applicant','$profession', '$clearance', '$prospecting_lic', '$p_renewal','$Reasons_pros_lic','$period','$is_renewal','$arrr_renewal','$area_renewal','$is_residential' )");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', applicant='$applicant', profession='$profession',clearance='$clearance', prospecting_lic='$prospecting_lic', p_renewal='$p_renewal', Reasons_pros_lic='$Reasons_pros_lic', period='$period', is_renewal='$is_renewal', arrr_renewal='$arrr_renewal',  area_renewal='$area_renewal',is_residential='$is_residential' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 1 -- form no 
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
		$nature=clean($_POST["nature"]);
	
	    if(!empty($_POST["particulars"]))	 $particulars=json_encode($_POST["particulars"]);
		else	$particulars=NULL;
		
	   $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	   $row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";	
		}else{  ////////////table is not empty//////////////
				$form_id=$row["form_id"];
				
					//$courier_details=NULL;
				$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET nature='$nature',particulars='$particulars' WHERE form_id='$form_id'");
			}
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}
}


if(isset($_POST["save4a"])){		
	$profession=clean($_POST["profession"]);$minerals=clean($_POST["minerals"]);$prospect=clean($_POST["prospect"]);
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["applicant"]))	 $applicant=json_encode($_POST["applicant"]);
	else	$applicant=NULL;
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	if(!empty($_POST["is_grant"]))	 $is_grant=json_encode($_POST["is_grant"]);
	else	$is_grant=NULL;
	if(!empty($_POST["situation"]))	 $situation=json_encode($_POST["situation"]);
	else	$situation=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,applicant,minerals,period,prospect,profession,is_grant,situation) values ('$swr_id','$today', '$applicant','$minerals','$period','$prospect','$profession','$is_grant','$situation')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', applicant='$applicant',minerals='$minerals',period='$period',prospect='$prospect',profession='$profession', is_grant='$is_grant', situation='$situation' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 4 -- form no 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,dist,taluq,village,khasra_no,plot_no,area,owner) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')");
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
if(isset($_POST["save4b"])){		
	$nature=clean($_POST["nature"]);$manner=clean($_POST["manner"]);$coal=clean($_POST["coal"]);
	$input_size2=$_POST["hiddenval2"];$input_size3=$_POST["hiddenval3"];
	
	if(!empty($_POST["particulars"]))	 $particulars=json_encode($_POST["particulars"]);
	else	$particulars=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["parameters"]))	 $parameters=json_encode($_POST["parameters"]);
	else	$parameters=NULL;
	if(!empty($_POST["mine"]))	 $mine=json_encode($_POST["mine"]);
	else	$mine=NULL;
	if(!empty($_POST["captive"]))	 $captive=json_encode($_POST["captive"]);
	else	$captive=NULL;
	if(!empty($_POST["foreign_people"]))	 $foreign_people=json_encode($_POST["foreign_people"]);
	else	$foreign_people=NULL;
	if(!empty($_POST["country"]))	 $country=json_encode($_POST["country"]);
	else	$country=NULL;
	if(!empty($_POST["person"]))	 $person=json_encode($_POST["person"]);
	else	$person=NULL;
	if(!empty($_POST["app_resources"]))	 $app_resources=json_encode($_POST["app_resources"]);
	else	$app_resources=NULL;
	if(!empty($_POST["is_carried"]))	 $is_carried=json_encode($_POST["is_carried"]);
	else	$is_carried=NULL;
	if(!empty($_POST["feasibility"]))	 $feasibility=json_encode($_POST["feasibility"]);
	else	$feasibility=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,particulars,nature,licence,parameters,mine,manner,captive,foreign_people,country,coal,person,app_resources,feasibility,is_carried) values ('$swr_id','$today', '$particulars','$nature', '$licence', '$parameters', '$mine','$manner','$captive','$foreign_people','$country','$coal','$person','$app_resources','$feasibility','$is_carried')");			
	}else{
		$form_id=$row["form_id"];	
		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', particulars= '$particulars', nature='$nature', licence='$licence', parameters= '$parameters', mine='$mine', manner='$manner', captive='$captive',  foreign_people='$foreign_people', country='$country', coal='$coal', person='$person', app_resources='$app_resources', feasibility='$feasibility', is_carried='$is_carried' where form_id=$form_id");
	}				
	if($query){
		if($input_size2!=0){	
			$k=$formFunctions->executeQuery($dept,"delete from  ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name,y1,y2,y3,y4,y5) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
				}
			}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,name,annual) VALUES ('$form_id','$i','$valb','$valc')");
				}
			}
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	  
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}
if(isset($_POST["save5"])){
	   
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
		$formFunctions->insert_incomplete_forms($form,$dept); //mines-- dept name and 5 -- form no 
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
if(isset($_POST["save6"])){
	
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
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 6 -- form no 
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

if(isset($_POST["save7"])){
	   
	$grant_excavation=clean($_POST["grant_excavation"]);$tonnes_cubic=clean($_POST["tonnes_cubic"]);$minor_mineral=clean($_POST["minor_mineral"]);$disposal_mineral=clean($_POST["disposal_mineral"]);$periodfrm_dt=clean($_POST["periodfrm_dt"]);$periodto_dt=clean($_POST["periodto_dt"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,grant_excavation,tonnes_cubic,minor_mineral,disposal_mineral,periodfrm_dt,periodto_dt) values ('$swr_id','$today','$grant_excavation','$tonnes_cubic','$minor_mineral','$disposal_mineral','$periodfrm_dt','$periodto_dt')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',grant_excavation='$grant_excavation',tonnes_cubic='$tonnes_cubic',minor_mineral='$minor_mineral',disposal_mineral='$disposal_mineral',periodfrm_dt='$periodfrm_dt',periodto_dt='$periodto_dt' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 7 -- form no 
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='".$table_name.".php';
					</script>";
				}	
				
	}
	
if(isset($_POST["save8"])){
	
	$land_measure=clean($_POST["land_measure"]);$details_of_dag=clean($_POST["details_of_dag"]);$revenue_estate=clean($_POST["revenue_estate"]);$permission_from=clean($_POST["permission_from"]);$permission_to=clean($_POST["permission_to"]);$permission_year=clean($_POST["permission_year"]);
	
	$permission_from=date("Y-m-d",strtotime($permission_from));
	$permission_to=date("Y-m-d",strtotime($permission_to));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,land_measure,details_of_dag,revenue_estate,permission_from,permission_to,permission_year) values ('$swr_id','$today','$land_measure','$details_of_dag','$revenue_estate', '$permission_from','$permission_to','$permission_year')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',land_measure='$land_measure',details_of_dag='$details_of_dag',revenue_estate='$revenue_estate',permission_from='$permission_from',permission_to='$permission_to',permission_year='$permission_year' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 8 -- form no 
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

if(isset($_POST["save9a"])){
	
	$indenture_dt=clean($_POST["indenture_dt"]);$acting_through=clean($_POST["acting_through"]);$bid_rs=clean($_POST["bid_rs"]);$words_rupees=clean($_POST["words_rupees"]);$auction_dt=clean($_POST["auction_dt"]);$mining_contract=clean($_POST["mining_contract"]);
	$words_mining=clean($_POST["words_mining"]);$officer_rs=clean($_POST["officer_rs"]);$officer_rupees=clean($_POST["officer_rupees"]);$security_name=clean($_POST["security_name"]);$shri=clean($_POST["shri"]);$resident=clean($_POST["resident"]);$re_district=clean($_POST["re_district"]);$hidden_value=clean($_POST["hidden_value"]);
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,indenture_dt,acting_through,bid_rs,words_rupees,auction_dt,mining_contract,words_mining,officer_rs,officer_rupees,security_name,shri,resident,re_district) values('$swr_id','$indenture_dt','$acting_through','$bid_rs','$words_rupees','$auction_dt','$mining_contract','$words_mining','$officer_rs','$officer_rupees','$security_name','$shri','$resident','$re_district')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',indenture_dt='$indenture_dt',acting_through='$acting_through',bid_rs='$bid_rs',words_rupees='$words_rupees',auction_dt='$auction_dt',mining_contract='$mining_contract',words_mining='$words_mining',officer_rs='$officer_rs',officer_rupees='$officer_rupees',security_name='$security_name',shri='$shri',resident='$resident',re_district='$re_district' WHERE form_id='$form_id'");
		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'");
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
			}			
		}		
	}
	if($query==true && $query1==true){
			
			$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 9 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}
}
if(isset($_POST["save9b"])){
	
	$veins_seam=clean($_POST["veins_seam"]);$village_situated=clean($_POST["village_situated"]);$sub_division=clean($_POST["sub_division"]);$land_district=clean($_POST["land_district"]);$dag_no=clean($_POST["dag_no"]);$patta_no=clean($_POST["patta_no"]);$north=clean($_POST["north"]);$south=clean($_POST["south"]);
	$east=clean($_POST["east"]);$west=clean($_POST["west"]);$premises_dt=clean($_POST["premises_dt"]);$for_term=clean($_POST["for_term"]);$rs_occupied=clean($_POST["rs_occupied"]);$rent_rupees=clean($_POST["rent_rupees"]);$contra_sig=clean($_POST["contra_sig"]);$governor_assm=clean($_POST["governor_assm"]);$surety_sig=clean($_POST["surety_sig"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET veins_seam='$veins_seam',village_situated='$village_situated',sub_division='$sub_division',land_district='$land_district',dag_no='$dag_no',patta_no='$patta_no',north='$north',south='$south',east='$east',west='$west',premises_dt='$premises_dt',for_term='$for_term',rs_occupied='$rs_occupied',rent_rupees='$rent_rupees',contra_sig='$contra_sig',governor_assm='$governor_assm',surety_sig='$surety_sig'   WHERE form_id='$form_id'");	
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


	
if(isset($_POST["save10"])){
	   
	$indenture_dt=clean($_POST["indenture_dt"]);$acting_through=clean($_POST["acting_through"]);$firstshri=clean($_POST["firstshri"]);$son_shri=clean($_POST["son_shri"]);$resi_dent=clean($_POST["resi_dent"]);$dist_rict=clean($_POST["dist_rict"]);
	$adminis_trators=clean($_POST["adminis_trators"]);$second_part=clean($_POST["second_part"]);$resident_of=clean($_POST["resident_of"]);$dist_second=clean($_POST["dist_second"]);$permit_h=clean($_POST["permit_h"]);$hol_words=clean($_POST["hol_words"]);$cubic_metre=clean($_POST["cubic_metre"]);$divi_sion=clean($_POST["divi_sion"]);$district_second=clean($_POST["district_second"]);$holder_rs=clean($_POST["holder_rs"]);$hold_rupees=clean($_POST["hold_rupees"]);$instal_lment=clean($_POST["instal_lment"]);$installment_rs=clean($_POST["installment_rs"]);$install_rupees=clean($_POST["install_rupees"]);
	
	if(!empty($_POST["permit_holder"]))	 $permit_holder=json_encode($_POST["permit_holder"]);
	else	$permit_holder=NULL;
	if(!empty($_POST["suretyaddres"]))	 $suretyaddres=json_encode($_POST["suretyaddres"]);
	else	$suretyaddres=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,permit_holder,suretyaddres,indenture_dt,acting_through,firstshri,son_shri,resi_dent,dist_rict,adminis_trators,second_part,resident_of,dist_second,permit_h,hol_words,cubic_metre,divi_sion,district_second,holder_rs,hold_rupees,instal_lment,installment_rs,install_rupees) values ('$swr_id','$today','$permit_holder','$suretyaddres','$indenture_dt','$acting_through','$firstshri','$son_shri','$resi_dent','$dist_rict','$adminis_trators','$second_part','$resident_of','$dist_second','$permit_h','$hol_words','$cubic_metre','$divi_sion','$district_second','$holder_rs','$hold_rupees','$instal_lment','$installment_rs','$install_rupees')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',permit_holder='$permit_holder',suretyaddres='$suretyaddres',indenture_dt='$indenture_dt',acting_through='$acting_through',firstshri='$firstshri',son_shri='$son_shri',resi_dent='$resi_dent',dist_rict='$dist_rict',adminis_trators='$adminis_trators',second_part='$second_part',resident_of='$resident_of',dist_second='$dist_second',permit_h='$permit_h',hol_words='$hol_words',cubic_metre='$cubic_metre',divi_sion='$divi_sion',district_second='$district_second',holder_rs='$holder_rs',hold_rupees='$hold_rupees',instal_lment='$instal_lment',installment_rs='$installment_rs',install_rupees='$install_rupees' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 10 -- form no 
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

if(isset($_POST["save15a"])){
	
	$indenture_dt=clean($_POST["indenture_dt"]);$acting_through=clean($_POST["acting_through"]);$bid_rs=clean($_POST["bid_rs"]);$words_rupees=clean($_POST["words_rupees"]);$auction_dt=clean($_POST["auction_dt"]);$mining_contract=clean($_POST["mining_contract"]);
	$words_mining=clean($_POST["words_mining"]);$cubic_metres=clean($_POST["cubic_metres"]);$officer_rs=clean($_POST["officer_rs"]);$officer_rupees=clean($_POST["officer_rupees"]);$security_name=clean($_POST["security_name"]);$shri=clean($_POST["shri"]);$resident=clean($_POST["resident"]);$re_district=clean($_POST["re_district"]);$hidden_value=clean($_POST["hidden_value"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,indenture_dt,acting_through,bid_rs,words_rupees,auction_dt,mining_contract,words_mining,cubic_metres,officer_rs,officer_rupees,security_name,shri,resident,re_district) values('$swr_id','$indenture_dt','$acting_through','$bid_rs','$words_rupees','$auction_dt','$mining_contract','$words_mining','$cubic_metres','$officer_rs','$officer_rupees','$security_name','$shri','$resident','$re_district')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',indenture_dt='$indenture_dt',acting_through='$acting_through',bid_rs='$bid_rs',words_rupees='$words_rupees',auction_dt='$auction_dt',mining_contract='$mining_contract',words_mining='$words_mining',cubic_metres='$cubic_metres',officer_rs='$officer_rs',officer_rupees='$officer_rupees',security_name='$security_name',shri='$shri',resident='$resident',re_district='$re_district' WHERE form_id='$form_id'");
		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'");
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
			}			
		}		
	}
	if($query==true && $query1==true){
			
			$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 15 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}
}
if(isset($_POST["save15b"])){
	
	$veins_seam=clean($_POST["veins_seam"]);$village_situated=clean($_POST["village_situated"]);$sub_division=clean($_POST["sub_division"]);$land_district=clean($_POST["land_district"]);$dag_no=clean($_POST["dag_no"]);$patta_no=clean($_POST["patta_no"]);$an_area=clean($_POST["an_area"]);$north=clean($_POST["north"]);$south=clean($_POST["south"]);
	$east=clean($_POST["east"]);$west=clean($_POST["west"]);$premises_dt=clean($_POST["premises_dt"]);$for_term=clean($_POST["for_term"]);$rs_occupied=clean($_POST["rs_occupied"]);$rent_rupees=clean($_POST["rent_rupees"]);$contra_sig=clean($_POST["contra_sig"]);$governor_assm=clean($_POST["governor_assm"]);$surety_sig=clean($_POST["surety_sig"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET veins_seam='$veins_seam',village_situated='$village_situated',sub_division='$sub_division',land_district='$land_district',dag_no='$dag_no',patta_no='$patta_no',an_area='$an_area',north='$north',south='$south',east='$east',west='$west',premises_dt='$premises_dt',for_term='$for_term',rs_occupied='$rs_occupied',rent_rupees='$rent_rupees',contra_sig='$contra_sig',governor_assm='$governor_assm',surety_sig='$surety_sig'   WHERE form_id='$form_id'");	
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


if(isset($_POST["save18a"])){
	
	$indenture_dt=clean($_POST["indenture_dt"]);$acting_through=clean($_POST["acting_through"]);$bid_rs=clean($_POST["bid_rs"]);$words_rupees=clean($_POST["words_rupees"]);$auction_dt=clean($_POST["auction_dt"]);$mining_contract=clean($_POST["mining_contract"]);$officer_rs=clean($_POST["officer_rs"]);$officer_rupees=clean($_POST["officer_rupees"]);$security_name=clean($_POST["security_name"]);$shri=clean($_POST["shri"]);$resident=clean($_POST["resident"]);$re_district=clean($_POST["re_district"]);$hidden_value=clean($_POST["hidden_value"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,indenture_dt,acting_through,bid_rs,words_rupees,auction_dt,mining_contract,officer_rs,officer_rupees,security_name,shri,resident,re_district) values('$swr_id','$indenture_dt','$acting_through','$bid_rs','$words_rupees','$auction_dt','$mining_contract','$officer_rs','$officer_rupees','$security_name','$shri','$resident','$re_district')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',indenture_dt='$indenture_dt',acting_through='$acting_through',bid_rs='$bid_rs',words_rupees='$words_rupees',auction_dt='$auction_dt',mining_contract='$mining_contract',officer_rs='$officer_rs',officer_rupees='$officer_rupees',security_name='$security_name',shri='$shri',resident='$resident',re_district='$re_district' WHERE form_id='$form_id'");
		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'");
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
			}			
		}		
	}
	if($query==true && $query1==true){
			
			$formFunctions->insert_incomplete_forms($dept,$form); //mines-- dept name and 15 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}
}
if(isset($_POST["save18b"])){
	
	$veins_seam=clean($_POST["veins_seam"]);$village_situated=clean($_POST["village_situated"]);$sub_division=clean($_POST["sub_division"]);$land_district=clean($_POST["land_district"]);$dag_no=clean($_POST["dag_no"]);$patta_no=clean($_POST["patta_no"]);$an_area=clean($_POST["an_area"]);$north=clean($_POST["north"]);$south=clean($_POST["south"]);
	$east=clean($_POST["east"]);$west=clean($_POST["west"]);$premises_dt=clean($_POST["premises_dt"]);$for_term=clean($_POST["for_term"]);$contra_sig=clean($_POST["contra_sig"]);$governor_assm=clean($_POST["governor_assm"]);$surety_sig=clean($_POST["surety_sig"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET veins_seam='$veins_seam',village_situated='$village_situated',sub_division='$sub_division',land_district='$land_district',dag_no='$dag_no',patta_no='$patta_no',an_area='$an_area',north='$north',south='$south',east='$east',west='$west',premises_dt='$premises_dt',for_term='$for_term',contra_sig='$contra_sig',governor_assm='$governor_assm',surety_sig='$surety_sig'   WHERE form_id='$form_id'");	
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