<?php
if(isset($_POST["save10"])){		
	$purpose_name=$_POST["purpose_name"];$reference_no=$_POST["reference_no"];$submitted_date=$_POST["submitted_date"];$received_dt=$_POST["received_dt"];$to_the=$_POST["to_the"];
	if(!empty($_POST["developer"]))	 $developer=json_encode($_POST["developer"]);
	else	$developer=NULL;
	if(!empty($_POST["owner1"]))	 $owner1=json_encode($_POST["owner1"]);
	else	$owner1=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,reference_no,submitted_date,received_dt,to_the,purpose_name,developer,owner1) values ('$swr_id','$today','$reference_no','$submitted_date','$received_dt','$to_the','$purpose_name','$developer','$owner1')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',reference_no='$reference_no',submitted_date='$submitted_date',received_dt='$received_dt',to_the='$to_the',purpose_name='$purpose_name',developer='$developer',owner1='$owner1' where form_id='$form_id'");	
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

if(isset($_POST["save7a"])){	

	$dag_number=$_POST["dag_number"];$pp_no=$_POST["pp_no"];$vil_lage=clean($_POST["vil_lage"]);$mou_za=clean($_POST["mou_za"]);
	$sign_attorney_holder=clean($_POST["sign_attorney_holder"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,sub_date,dag_number,pp_no,vil_lage,mou_za,sign_attorney_holder) values ('$swr_id','$today','$dag_number','$pp_no','$vil_lage','$mou_za','$sign_attorney_holder')");	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', dag_number='$dag_number',pp_no='$pp_no', vil_lage='$vil_lage', mou_za='$mou_za',sign_attorney_holder='$sign_attorney_holder' where form_id='$form_id'");
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
if(isset($_POST["save7b"])){
	
	$is_adjoining=clean($_POST["is_adjoining"]);$present_land=clean($_POST["present_land"]);$previous_land=clean($_POST["previous_land"]);$number_dwelling=clean($_POST["number_dwelling"]);
	$is_felling=clean($_POST["is_felling"]);$is_erection=clean($_POST["is_erection"]);$hindu_religious=clean($_POST["hindu_religious"]);$signed_application=clean($_POST["signed_application"]);$signed_architect=clean($_POST["signed_architect"]);$owner_sign=clean($_POST["owner_sign"]);
	
	  if(!empty($_POST["details_erection"]) && $_POST["is_erection"]=="Y")	$details_erection=$_POST["details_erection"];
	    else $details_erection=NULL;
		
		if(!empty($_POST["details_felling"]) && $_POST["is_felling"]=="Y")	$details_felling=$_POST["details_felling"];
	    else $details_felling=NULL;
		
		if(!empty($_POST["details_adjoining"]) && $_POST["is_adjoining"]=="Y")	$details_adjoining=$_POST["details_adjoining"];
	    else $details_adjoining=NULL;
	
	if(isset($_POST["appli"])) $appli=json_encode($_POST["appli"]);
	else $appli=NULL;
	if(!empty($_POST["full"]))	 $full=json_encode($_POST["full"]);
	else	$full=NULL;
	if(!empty($_POST["extentland"]))	 $extentland=json_encode($_POST["extentland"]);
	else	$extentland=NULL;
	if(!empty($_POST["architect"]))	 $architect=json_encode($_POST["architect"]);
	else	$architect=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,appli,full,is_adjoining,details_adjoining,present_land,previous_land,number_dwelling,extentland,is_felling,details_felling,is_erection,details_erection,hindu_religious,architect,signed_application,signed_architect,owner_sign) values ('$swr_id','$today','$appli', '$full', '$is_adjoining', '$details_adjoining', '$present_land','$previous_land','$number_dwelling','$extentland','$is_felling','$details_felling','$is_erection','$details_erection','$hindu_religious','$architect','$signed_application','$signed_architect','$owner_sign')");	
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', appli='$appli', full='$full', is_adjoining='$is_adjoining', details_adjoining='$details_adjoining', present_land='$present_land', previous_land='$previous_land',number_dwelling='$number_dwelling',extentland='$extentland',is_felling='$is_felling',details_felling='$details_felling',is_erection='$is_erection',details_erection='$details_erection',hindu_religious='$hindu_religious',architect='$architect',signed_application='$signed_application',signed_architect='$signed_architect',owner_sign='$owner_sign' where form_id='$form_id'");				
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

if(isset($_POST["save8"])){
	
	$house_number=clean($_POST["house_number"]);$situ_road=clean($_POST["situ_road"]);$of=clean($_POST["of"]);$area_ward=clean($_POST["area_ward"]);$dag_no=clean($_POST["dag_no"]);
	$patta_no=clean($_POST["patta_no"]);$rev_village=clean($_POST["rev_village"]);$mouza=clean($_POST["mouza"]);$signed=clean($_POST["signed"]);$regis_no=clean($_POST["regis_no"]);$no_floors=clean($_POST["no_floors"]);
	
	if(isset($_POST["provision"])) $provision=json_encode($_POST["provision"]);
	else $provision=NULL;
	if(isset($_POST["total"])) $total=json_encode($_POST["total"]);
	else $total=NULL;
	if(isset($_POST["appli"])) $appli=json_encode($_POST["appli"]);
	else $appli=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,house_number,situ_road,of,area_ward,dag_no,patta_no,rev_village,mouza,signed,regis_no,total,provision,appli,no_floors) values ('$swr_id','$house_number','$situ_road','$of','$area_ward','$dag_no','$patta_no','$rev_village','$mouza','$signed','$regis_no','$total','$provision','$appli','$no_floors')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set house_number='$house_number',situ_road='$situ_road',of='$of',area_ward='$area_ward',dag_no='$dag_no',patta_no='$patta_no',rev_village='$rev_village',mouza='$mouza',signed='$signed',regis_no='$regis_no',total='$total',provision='$provision',appli='$appli',no_floors='$no_floors' where form_id='$form_id'");	
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

if(isset($_POST["save9"])){
	
	$house_number=clean($_POST["house_number"]);$situ_road=clean($_POST["situ_road"]);$of=clean($_POST["of"]);$area_ward=clean($_POST["area_ward"]);$dag_no=clean($_POST["dag_no"]);
	$patta_no=clean($_POST["patta_no"]);$rev_village=clean($_POST["rev_village"]);$mouza=clean($_POST["mouza"]);$signed=clean($_POST["signed"]);$regis_no=clean($_POST["regis_no"]);$no_floors=clean($_POST["no_floors"]);
	
	if(isset($_POST["provision"])) $provision=json_encode($_POST["provision"]);
	else $provision=NULL;
	if(isset($_POST["total"])) $total=json_encode($_POST["total"]);
	else $total=NULL;
	if(isset($_POST["appli"])) $appli=json_encode($_POST["appli"]);
	else $appli=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,house_number,situ_road,of,area_ward,dag_no,patta_no,rev_village,mouza,signed,regis_no,total,provision,appli,no_floors) values ('$swr_id','$house_number','$situ_road','$of','$area_ward','$dag_no','$patta_no','$rev_village','$mouza','$signed','$regis_no','$total','$provision','$appli','$no_floors')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set house_number='$house_number',situ_road='$situ_road',of='$of',area_ward='$area_ward',dag_no='$dag_no',patta_no='$patta_no',rev_village='$rev_village',mouza='$mouza',signed='$signed',regis_no='$regis_no',total='$total',provision='$provision',appli='$appli',no_floors='$no_floors' where form_id='$form_id'");	
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

if(isset($_POST["save15"])){
	
	$house_number=clean($_POST["house_number"]);$situ_road=clean($_POST["situ_road"]);$of=clean($_POST["of"]);$area_ward=clean($_POST["area_ward"]);$dag_no=clean($_POST["dag_no"]);
	$patta_no=clean($_POST["patta_no"]);$rev_village=clean($_POST["rev_village"]);$mouza=clean($_POST["mouza"]);$signed=clean($_POST["signed"]);$regis_no=clean($_POST["regis_no"]);$no_floors=clean($_POST["no_floors"]);
	
	if(isset($_POST["provision"])) $provision=json_encode($_POST["provision"]);
	else $provision=NULL;
	if(isset($_POST["total"])) $total=json_encode($_POST["total"]);
	else $total=NULL;
	if(isset($_POST["appli"])) $appli=json_encode($_POST["appli"]);
	else $appli=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,house_number,situ_road,of,area_ward,dag_no,patta_no,rev_village,mouza,signed,regis_no,total,provision,appli,no_floors) values ('$swr_id','$house_number','$situ_road','$of','$area_ward','$dag_no','$patta_no','$rev_village','$mouza','$signed','$regis_no','$total','$provision','$appli','$no_floors')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set house_number='$house_number',situ_road='$situ_road',of='$of',area_ward='$area_ward',dag_no='$dag_no',patta_no='$patta_no',rev_village='$rev_village',mouza='$mouza',signed='$signed',regis_no='$regis_no',total='$total',provision='$provision',appli='$appli',no_floors='$no_floors' where form_id='$form_id'");	
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

if(isset($_POST["save17a"])){	

	$dag_number=$_POST["dag_number"];$pp_no=$_POST["pp_no"];$vil_lage=clean($_POST["vil_lage"]);$mou_za=clean($_POST["mou_za"]);
	$sign_attorney_holder=clean($_POST["sign_attorney_holder"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,sub_date,dag_number,pp_no,vil_lage,mou_za,sign_attorney_holder) values ('$swr_id','$today','$dag_number','$pp_no','$vil_lage','$mou_za','$sign_attorney_holder')");	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', dag_number='$dag_number',pp_no='$pp_no', vil_lage='$vil_lage', mou_za='$mou_za',sign_attorney_holder='$sign_attorney_holder' where form_id='$form_id'");
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
if(isset($_POST["save17b"])){
	
	$is_adjoining=clean($_POST["is_adjoining"]);$present_land=clean($_POST["present_land"]);$previous_land=clean($_POST["previous_land"]);$number_dwelling=clean($_POST["number_dwelling"]);
	$is_felling=clean($_POST["is_felling"]);$is_erection=clean($_POST["is_erection"]);$hindu_religious=clean($_POST["hindu_religious"]);$signed_application=clean($_POST["signed_application"]);$signed_architect=clean($_POST["signed_architect"]);$owner_sign=clean($_POST["owner_sign"]);
	
	  if(!empty($_POST["details_erection"]) && $_POST["is_erection"]=="Y")	$details_erection=$_POST["details_erection"];
	    else $details_erection=NULL;
		
		if(!empty($_POST["details_felling"]) && $_POST["is_felling"]=="Y")	$details_felling=$_POST["details_felling"];
	    else $details_felling=NULL;
		
		if(!empty($_POST["details_adjoining"]) && $_POST["is_adjoining"]=="Y")	$details_adjoining=$_POST["details_adjoining"];
	    else $details_adjoining=NULL;
	
	if(isset($_POST["appli"])) $appli=json_encode($_POST["appli"]);
	else $appli=NULL;
	if(!empty($_POST["full"]))	 $full=json_encode($_POST["full"]);
	else	$full=NULL;
	if(!empty($_POST["extentland"]))	 $extentland=json_encode($_POST["extentland"]);
	else	$extentland=NULL;
	if(!empty($_POST["architect"]))	 $architect=json_encode($_POST["architect"]);
	else	$architect=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,appli,full,is_adjoining,details_adjoining,present_land,previous_land,number_dwelling,extentland,is_felling,details_felling,is_erection,details_erection,hindu_religious,architect,signed_application,signed_architect,owner_sign) values ('$swr_id','$today','$appli', '$full', '$is_adjoining', '$details_adjoining', '$present_land','$previous_land','$number_dwelling','$extentland','$is_felling','$details_felling','$is_erection','$details_erection','$hindu_religious','$architect','$signed_application','$signed_architect','$owner_sign')");	
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', appli='$appli', full='$full', is_adjoining='$is_adjoining', details_adjoining='$details_adjoining', present_land='$present_land', previous_land='$previous_land',number_dwelling='$number_dwelling',extentland='$extentland',is_felling='$is_felling',details_felling='$details_felling',is_erection='$is_erection',details_erection='$details_erection',hindu_religious='$hindu_religious',architect='$architect',signed_application='$signed_application',signed_architect='$signed_architect',owner_sign='$owner_sign' where form_id='$form_id'");				
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

if(isset($_POST["save18a"])){		
	$from_year=$_POST["from_year"];$to_year=$_POST["to_year"];$family_name=$_POST["family_name"];$dob=$_POST["dob"];$owner_age=$_POST["owner_age"];	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,from_year,to_year,family_name,dob,owner_age) values ('$swr_id','$from_year','$to_year','$family_name','$dob','$owner_age')");	
	}else{				
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set from_year='$from_year', to_year='$to_year',family_name='$family_name', dob='$dob',owner_age='$owner_age' where form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
			</script>";					
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=1';
			</script>";
	}		
}
if(isset($_POST["save18b"])){		
	$premises=$_POST["premises"];$godown=$_POST["godown"];			
	if(!empty($_POST["premises_details"])) $premises_details=json_encode($_POST["premises_details"]);
	else $premises_details=NULL;
	if(!empty($_POST["godown_details"])) $godown_details=json_encode($_POST["godown_details"]);
	else $godown_details=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(premises,premises_details,godown,godown_details) values ('$sid','$premises','$premises_details','$godown','$godown_details')");
	}else{				
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set premises='$premises',godown='$godown',premises_details='$premises_details',godown_details='$godown_details' where form_id='$form_id'");		
	}
	if($query){					
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=3';
			</script>";					
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}		
}
if(isset($_POST["save18c"])){		
	$old_trade=$_POST["old_trade"];	
	if(!empty($_POST["old_trade_details"]))	 $old_trade_details=json_encode($_POST["old_trade_details"]);
	else	$old_trade_details=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,old_trade,old_trade_details) values ('$swr_id','$old_trade', '$old_trade_details')");				
	}else{				
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set old_trade='$old_trade', old_trade_details='$old_trade_details' where form_id='$form_id'");			
	}
	if($query){					
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";					
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}		
}
if(isset($_POST["save18d"])){	
	$annual_income=$_POST["annual_income"];$it_payable=$_POST["it_payable"];$license_type=$_POST["license_type"];		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id,from_year,premises,old_trade from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
		echo "<script>
			alert('Invalid Entry, please fill up all the parts of the form');
			window.location.href = '".$table_name.".php';
		</script>";				
	}else{
		$form_id=$row["form_id"];				
		if(!empty($row["from_year"]) && !empty($row["premises"]) && !empty($row["old_trade"])) {
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set annual_income='$annual_income', it_payable='$it_payable', license_type='$license_type' where form_id='$form_id'");	
			if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";	
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=4';
				</script>";
			}				
		}	
	}
}

if(isset($_POST["save19"])){
	
	$house_number=clean($_POST["house_number"]);$situ_road=clean($_POST["situ_road"]);$of=clean($_POST["of"]);$area_ward=clean($_POST["area_ward"]);$dag_no=clean($_POST["dag_no"]);
	$patta_no=clean($_POST["patta_no"]);$rev_village=clean($_POST["rev_village"]);$mouza=clean($_POST["mouza"]);$signed=clean($_POST["signed"]);$regis_no=clean($_POST["regis_no"]);$no_floors=clean($_POST["no_floors"]);
	
	if(isset($_POST["provision"])) $provision=json_encode($_POST["provision"]);
	else $provision=NULL;
	if(isset($_POST["total"])) $total=json_encode($_POST["total"]);
	else $total=NULL;
	if(isset($_POST["appli"])) $appli=json_encode($_POST["appli"]);
	else $appli=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,house_number,situ_road,of,area_ward,dag_no,patta_no,rev_village,mouza,signed,regis_no,total,provision,appli,no_floors) values ('$swr_id','$house_number','$situ_road','$of','$area_ward','$dag_no','$patta_no','$rev_village','$mouza','$signed','$regis_no','$total','$provision','$appli','$no_floors')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set house_number='$house_number',situ_road='$situ_road',of='$of',area_ward='$area_ward',dag_no='$dag_no',patta_no='$patta_no',rev_village='$rev_village',mouza='$mouza',signed='$signed',regis_no='$regis_no',total='$total',provision='$provision',appli='$appli',no_floors='$no_floors' where form_id='$form_id'");	
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

?>