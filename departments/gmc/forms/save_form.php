<?php
if(isset($_POST["save1a"])){		
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
if(isset($_POST["save1b"])){		
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
if(isset($_POST["save1c"])){		
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
if(isset($_POST["save1d"])){	
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
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
			}				
		}	
	}
}

if(isset($_POST["save2a"])){		
	$from_year=$_POST["from_year"];$to_year=$_POST["to_year"];$fat_name=clean($_POST["fat_name"]);$is_factory_license=clean($_POST["is_factory_license"]);$reg_no=clean($_POST["reg_no"]);$reg_date=clean($_POST["reg_date"]);$site_details=clean($_POST["site_details"]);$com_date=clean($_POST["com_date"]);
	$is_license=Array();
	if($is_factory_license=="Y"){
		$is_license_array=array($reg_no, $reg_date); 
		$is_license=implode("//",$is_license_array);
	}else{
		$is_license_array=array($site_details, $com_date); 
		$is_license=implode("//",$is_license_array);
	}
	
	if(!empty($_POST["factory"]))	 $factory=json_encode($_POST["factory"]);
	else	$factory=NULL;
	if(!empty($_POST["worker"]))	 $worker=json_encode($_POST["worker"]);
	else	$worker=NULL;
	if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
	else	$power=NULL;
	if(!empty($_POST["owner"]))	 $owner=json_encode($_POST["owner"]);
	else	$owner=NULL;
	if(!empty($_POST["fact_const"]))	 $fact_const=json_encode($_POST["fact_const"]);
	else	$fact_const=NULL;
	if(!empty($_POST["property_tax"]))	 $property_tax=json_encode($_POST["property_tax"]);
	else	$property_tax=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,sub_date,from_year,to_year,fat_name,is_factory_license,is_license,factory,worker,power,owner,fact_const,property_tax) values ('$swr_id','$today','$from_year','$to_year','$fat_name','$is_factory_license','$is_license','$factory','$worker','$power','$owner','$fact_const','$property_tax')");	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', from_year='$from_year', to_year='$to_year', fat_name='$fat_name', is_factory_license='$is_factory_license', is_license='$is_license', factory='$factory', worker='$worker',power='$power', owner='$owner', fact_const='$fact_const' , property_tax='$property_tax' where form_id='$form_id'");
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
	$prop_dispose=clean($_POST["prop_dispose"]);$date_fac=clean($_POST["date_fac"]);$plant_par=clean($_POST["plant_par"]);$rent_details=clean($_POST["rent_details"]);$trade_premises=clean($_POST["trade_premises"]);
	if(isset($_POST["company"])) $company=json_encode($_POST["company"]);
	else $company=NULL;
	if(!empty($_POST["godown"]))	 $godown=json_encode($_POST["godown"]);
	else	$godown=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,prop_dispose,plant_par,rent_details,trade_premises,company,godown,app_fee,app_date) values ('$swr_id','$today','$prop_dispose', '$plant_par', '$rent_details', '$trade_premises', '$company', '$godown', '$date_fac')");	
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', prop_dispose='$prop_dispose', plant_par='$plant_par', rent_details='$rent_details', trade_premises='$trade_premises', company='$company', godown='$godown' , date_fac='$date_fac' where form_id='$form_id'");				
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

if(isset($_POST["save3a"])){		
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
if(isset($_POST["save3b"])){		
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
if(isset($_POST["save3c"])){		
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
if(isset($_POST["save3d"])){	
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
		if(!empty($row["from_year"]) && !empty($row["premises"]) && !empty($row["old_trade"]))
		{
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set annual_income='$annual_income', it_payable='$it_payable', license_type='$license_type' where form_id='$form_id'");	
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
	}
}

if(isset($_POST["save4a"])){		
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
				window.location.href = '".$table_name.".php';
			</script>";
	}		
}
if(isset($_POST["save4b"])){		
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
			window.location.href = '".$table_name.".php';
		</script>";
	}		
}
if(isset($_POST["save4c"])){		
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
			window.location.href = '".$table_name.".php';
		</script>";
	}		
}
if(isset($_POST["save4d"])){	
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
		if(!empty($row["from_year"]) && !empty($row["premises"]) && !empty($row["old_trade"])){
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set annual_income='$annual_income', it_payable='$it_payable', license_type='$license_type' where form_id='$form_id'");	
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
    }
}

if(isset($_POST["save5"])){		
	$holding_no=$_POST["holding_no"];$power=$_POST["power"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,holding_no,power) values ('$swr_id','$holding_no','$power')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set holding_no='$holding_no',power='$power' where form_id='$form_id'");	
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

if(isset($_POST["save6"])){		
	$father_name=$_POST["father_name"];$gmc_zone=$_POST["gmc_zone"];$road_name=$_POST["road_name"];$cons_year=$_POST["cons_year"];$w_pipe=$_POST["w_pipe"];$build_use=$_POST["build_use"];$l_area=$_POST["l_area"];$dag_no=$_POST["dag_no"];$patta_no=$_POST["patta_no"];$l_vill=$_POST["l_vill"];$mouza=$_POST["mouza"];$hold_no=$_POST["hold_no"];$old_arv=$_POST["old_arv"];$b_owner_name=$_POST["b_owner_name"];
	if(!empty($_POST["plinth"]))	 $plinth=json_encode($_POST["plinth"]);
	else	$plinth=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,father_name,gmc_zone,road_name,plinth,cons_year,w_pipe,build_use,l_area,dag_no,patta_no,l_vill,mouza,hold_no,old_arv,b_owner_name) values ('$swr_id','$father_name','$gmc_zone','$road_name','$plinth','$cons_year','$w_pipe','$build_use','$l_area','$dag_no','$patta_no','$l_vill','$mouza','$hold_no','$old_arv','$b_owner_name')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set father_name='$father_name', gmc_zone='$gmc_zone', road_name='$road_name',plinth='$plinth',cons_year='$cons_year',w_pipe='$w_pipe',build_use='$build_use',l_area='$l_area' ,dag_no='$dag_no' ,patta_no='$patta_no' ,l_vill='$l_vill',mouza='$mouza',hold_no='$hold_no',old_arv='$old_arv',b_owner_name='$b_owner_name' where form_id='$form_id'");	
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
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
}

if(isset($_POST["save11"])){
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);
	if(!empty($_POST["eng"]))	 $eng=json_encode($_POST["eng"]);
	else	$eng=NULL;
	if(!empty($_POST["dev"]))	 $dev=json_encode($_POST["dev"]);
	else	$dev=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_no,submit_dt,eng,dev) values ('$swr_id','$today','$ref_no','$submit_dt','$eng','$dev')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',ref_no='$ref_no',submit_dt='$submit_dt',eng='$eng',dev='$dev' where form_id=$form_id");		
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
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);
	if(!empty($_POST["eng"]))	 $eng=json_encode($_POST["eng"]);
	else	$eng=NULL;
	if(!empty($_POST["dev"]))	 $dev=json_encode($_POST["dev"]);
	else	$dev=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_no,submit_dt,eng,dev) values ('$swr_id','$today','$ref_no','$submit_dt','$eng','$dev')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',ref_no='$ref_no',submit_dt='$submit_dt',eng='$eng',dev='$dev' where form_id=$form_id");		
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
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);$storey=clean($_POST["storey"]);
	if(!empty($_POST["eng"]))	 $eng=json_encode($_POST["eng"]);
	else	$eng=NULL;
	if(!empty($_POST["dev"]))	 $dev=json_encode($_POST["dev"]);
	else	$dev=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_no,submit_dt,storey,eng,dev) values ('$swr_id','$today','$ref_no','$submit_dt','$storey','$eng','$dev')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',ref_no='$ref_no',submit_dt='$submit_dt',storey='$storey',eng='$eng',dev='$dev' where form_id=$form_id");		
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

if(isset($_POST["save14"])){
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);$storey=clean($_POST["storey"]);
	if(!empty($_POST["eng"]))	 $eng=json_encode($_POST["eng"]);
	else	$eng=NULL;
	if(!empty($_POST["dev"]))	 $dev=json_encode($_POST["dev"]);
	else	$dev=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ref_no,submit_dt,storey,eng,dev) values ('$swr_id','$today','$ref_no','$submit_dt','$storey','$eng','$dev')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',ref_no='$ref_no',submit_dt='$submit_dt',storey='$storey',eng='$eng',dev='$dev' where form_id=$form_id");		
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

if(isset($_POST["save16"])){
	$father_name=clean($_POST["father_name"]);$ward_no=clean($_POST["ward_no"]);$house_no=clean($_POST["house_no"]);$road_name=clean($_POST["road_name"]);$const_year=clean($_POST["const_year"]);$is_pipe=clean($_POST["is_pipe"]);$is_use=clean($_POST["is_use"]);
	
	if(!empty($_POST["plinth"]))	 $plinth=json_encode($_POST["plinth"]);
	else	$plinth=NULL;
	if(!empty($_POST["area"]))	 $area=json_encode($_POST["area"]);
	else	$area=NULL;
	if(!empty($_POST["holdings"]))	 $holdings=json_encode($_POST["holdings"]);
	else	$holdings=NULL;
	if(!empty($_POST["owner"]))	 $owner=json_encode($_POST["owner"]);
	else	$owner=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,ward_no,house_no,road_name,const_year,is_pipe,is_use,plinth,area,holdings,owner) values ('$swr_id','$today','$father_name','$ward_no','$house_no','$road_name','$const_year','$is_pipe','$is_use','$plinth','$area','$holdings','$owner')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',father_name='$father_name',ward_no='$ward_no',house_no='$house_no',road_name='$road_name',const_year='$const_year',is_pipe='$is_pipe',is_use='$is_use',plinth='$plinth',area='$area',holdings='$holdings',owner='$owner' where form_id=$form_id");		
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